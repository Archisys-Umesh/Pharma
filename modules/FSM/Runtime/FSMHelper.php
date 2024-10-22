<?php declare(strict_types = 1);

namespace Modules\FSM\Runtime;

use App\System\App;
use entities\Outlets;
use entities\OutletsQuery;
use entities\EmployeeQuery;
use entities\OutletStockQuery;
use entities\OutletMappingQuery;
use Modules\HR\Runtime\HrHelper;
use entities\OutletAssignmentQuery;
use entities\OutletMapping;
use Modules\System\Processes\WorkflowManager;
use Exception;

class FSMHelper {
    //put your code here
    protected $app;
        
    public  function __construct(App $app)
    {
        $this->app = $app;
    }
    
    
    public function getAllOutletDump($emp_id)
    {
        
        if($this->app->Auth()->checkPerm("dump_full_territory"))
        {
            return $this->fullDump();

        }
        else {
                        
            $empObject = EmployeeQuery::create()->findPk($emp_id);
            $empUnder = [];
            if($empObject->getPositionId() != null && $empObject->getPositionId() > 0)
            {
                $empUnder = HrHelper::findEmpsUnder($empObject->getPositionId());
            }

            // stopping for managers , to get all beats
            array_push($empUnder,$emp_id);

            $beats = \entities\BeatsQuery::create()
            ->filterByEmployeeId($empUnder)->select(["BeatId"])                
            ->find()->toArray(); 
            
            return $this->getBeatDump($beats);
            
//            if(count($beats) > 50){
//                throw new Exception("More than 50 beats!",999);
//                exit;
//            }else{
//                return $this->getBeatDump($beats);
//            }
        }
    }
    
    public function fullDump()
    {
        $companyid = $this->app->Auth()->CompanyId();                
        
        $outlets = [];        
        $primaryOutlets = [];
        $pricebooks = [];
        $stocks = [];
        $mappingCache = [];
        $primaryOutletsIds = [];
        
        $products = \entities\CategoriesQuery::create()                       
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->joinWithProducts()
                             ->findByCompanyId($companyid)->toArray();

        $AllOutlets = OutletsQuery::create()
            ->filterByTerritoryId($this->app->Auth()->getUser()->getEmployee()->getTerritoryId())
            ->find();

        foreach($AllOutlets as $outlet)
        {
        array_push($outletIdCollection,$outlet->getPrimaryKey());
        }

        $mappingCache = OutletMappingQuery::create()->filterBySecondaryOutletId($outletIdCollection)->find();
    

        foreach($AllOutlets as $outlet)
        {
            $this->_outletMetaData($outlet,$outlets,$primaryOutlets,$pricebooks,$primaryOutletsIds,$mappingCache);
        }

        $outletType = \entities\Base\OutletTypeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->findByCompanyId($companyid)->toArray();
        
        $unitType = \entities\UnitmasterQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->find()->toArray();
        
        $stocks = OutletStockQuery::create()
        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        ->filterByOutletId($primaryOutletsIds)->find()->toArray();

        return 
        [
            "Products" => $products,
            "Outlets" => $outlets,            
            "PrimaryOutlets" => $primaryOutlets,
            "PriceBooks" => $pricebooks,     
            "OutletTypes" => $outletType,
            "Units" => $unitType,            
            "Stocks" => $stocks
        ];

    }
    public function getBeatDump($beat_id)
    {
        $companyid = $this->app->Auth()->CompanyId();                
        
        $outlets = [];        
        $primaryOutlets = [];
        $pricebooks = [];
        $stocks = [];
        $outletIdCollection = [];
        $primaryOutletsIds = [];
        
        $products = \entities\CategoriesQuery::create()                       
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->joinWithProducts()
                             ->findByCompanyId($companyid)->toArray();
        
        $outletsList = \entities\BeatOutletsQuery::create()                                
                ->joinWithOutlets()
                ->filterByBeatId($beat_id)
                ->filterByCompanyId($companyid)
                ->find();
        
        foreach($outletsList as $mapping)
        {
            array_push($outletIdCollection,$mapping->getOutletId());
        }

        $assigned = OutletAssignmentQuery::create()
        ->filterByCompanyId($companyid)
        ->filterByEmpId($this->app->Auth()->getUser()->getEmployeeId())
        ->find();

        foreach($assigned as $assignedOutlet)
        {
        array_push($outletIdCollection,$assignedOutlet->getOutletId());
        }

        $mappingCache = OutletMappingQuery::create()->filterBySecondaryOutletId($outletIdCollection)->find();

        foreach($outletsList as $mapping)
        {            
            $this->_outletMetaData($mapping->getOutlets(),$outlets,$primaryOutlets,$pricebooks,$primaryOutletsIds,$mappingCache);            
        }
        
        foreach($assigned as $assign)
        {
            $this->_outletMetaData($assign->getOutlets(),$outlets,$primaryOutlets,$pricebooks,$primaryOutletsIds,$mappingCache);
        }
                

        $outletType = \entities\Base\OutletTypeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->findByCompanyId($companyid)->toArray();
        
        $unitType = \entities\UnitmasterQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->find()->toArray();
        
        $stocks = OutletStockQuery::create()
        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        ->filterByOutletId($primaryOutletsIds)->find()->toArray();

        return 
        [
            "Products" => $products,
            "Outlets" => $outlets,            
            "PrimaryOutlets" => $primaryOutlets,
            "PriceBooks" => $pricebooks,     
            "OutletTypes" => $outletType,
            "Units" => $unitType,            
            "Stocks" => $stocks
        ];
        
    }

    private function _outletMetaData(Outlets $outletRec, &$outlets, &$primaryOutlets,&$pricebooks,&$primaryOutletsIds,&$outletMapping)
    {
        if(!isset($outlets[$outletRec->getPrimaryKey()]))
        {
            $outlets[$outletRec->getPrimaryKey()] = $outletRec->toArray();
            /*
            $parents = OutletMappingQuery::create()
                    ->joinWithPricebooks()
                    ->filterBySecondaryOutletId($outletRec->getPrimaryKey())
                    ->find();                        
            */
            $parents = $this->findMappingBySecondary($outletMapping,$outletRec->getPrimaryKey());
            $outlets[$outletRec->getPrimaryKey()]["Mapping"] = [];
            $outlets[$outletRec->getPrimaryKey()]["PriceBook"] = [];
            $outlets[$outletRec->getPrimaryKey()]["Classification"] = [];
            
            foreach($parents as $parent)
            {                
                array_push($outlets[$outletRec->getPrimaryKey()]["Mapping"],$parent->toArray());               
                
                
                // Add Parent Outlet
                if(!isset($primaryOutlets[$parent->getPrimaryOutletId()]))
                {
                    array_push($primaryOutletsIds,$parent->getPrimaryOutletId());
                    $primaryoutlet = \entities\OutletsQuery::create()
                                 //->joinWithOutletStock()
                                ->findById($parent->getPrimaryOutletId());                    
                    $primaryOutlets[$parent->getPrimaryOutletId()] = $primaryoutlet->toArray();
                }
                
                // Add PriceBook
                if(!isset($pricebooks[$parent->getPricebookId()]))
                {
                    if($parent->getPricebooks()) {
                        $pricebooks[$parent->getPricebookId()][$parent->getPricebooks()->getPricebookName()] = $parent->getPricebooks()->getPricebookliness()->toArray();
                        
                    }
                }
                                                                
            }
        }
    }

    static function eventStartEndDate($status,$reqs=array(),$employeeid = 0){
        $eventdatearray = array();
        if($status == "A"){
            $eventdate = \entities\EventsQuery::create()
                    ->filterByEmployeeId($reqs)
                    ->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)->find();
            if($eventdate){
                foreach($eventdate as $td){
                    if (!isset($eventdatearray[$td->getEventDate()->format('Y-m')])) {
                        $eventdatearray[$td->getEventDate()->format('Y-m')] = $td->getEventDate()->format('M-Y');
                    }
                }
            }
        }else{
            $eventdate = \entities\EventsQuery::create()
                    ->filterByEventId($reqs)
                    ->filterByEmployeeId($employeeid,\Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                    ->find();
            if($eventdate){
                foreach($eventdate as $td){
                    if (!isset($eventdatearray[$td->getEventDate()->format('Y-m')])) {
                        $eventdatearray[$td->getEventDate()->format('Y-m')] = $td->getEventDate()->format('M-Y');
                    }
                }
            }
        }
        return $eventdatearray;
    }
    
    static function getallEventListnew($filter,$filterdate,$reqs,$emp,$pageNo = -1,$perPage = 0,$status = 0) {
        $records = [];
        if($perPage == 0){            
            $EventStartMonth = date("Y-m-01 00:00:01", strtotime($filterdate));
            $EventEndMonth  = date("Y-m-t 23:59:59", strtotime($filterdate));            
        }
        
        if($filter == "A") {
             $records = \entities\EventsQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                //->joinWithCurrencies()
                ->filterByEmployeeId($emp)
                ->joinWithEventTypes()
                ->joinWithEmployeeRelatedByEmployeeId();
             
                if($perPage == 0){
                    $records->filterByEventDate($EventStartMonth,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)     
                    ->filterByEventDate($EventEndMonth,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC);     
                }else{
                    $records->setOffset($pageNo);
                    $records->setLimit($perPage);
                    $records->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC);
                }
                if($status > 0){
                    $records->filterByEventStatus($status);
                }
                $records = $records->find()->toArray();
        }
        else{
            $records = \entities\EventsQuery::create()  
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployeeRelatedByEmployeeId()
                ->filterByEmployeeId($emp, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByPrimaryKeys($reqs);
                if($pageNo < 0){
                    $records->filterByEventDate($EventStartMonth,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)     
                    ->filterByEventDate($EventEndMonth,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC);
                }else{
                    $records->setOffset($pageNo);
                    $records->setLimit($perPage);
                    $records->orderByEventDate(\Propel\Runtime\ActiveQuery\Criteria::DESC);
                }
                if($status > 0){
                    $records->filterByEventStatus($status);
                }
                $records = $records->find()->toArray(); 
        }
        return $records;
    }
    
    static function deleteEvent($pk,$company_id)
    {
        $event = \entities\EventsQuery::create()
                //->filterByCompanyId($company_id)                
                ->findPk($pk);
        if($event) {            
            
            
            // delete related records - Like Tourplan becomes unplanned
            
            $wf = new WorkflowManager();
            $wf->deleteEntity('Events', $event);
            $event->delete();
            
            return TRUE;
        }
        else 
        {
            return false;
        }
    }
    
    static function BlockTourPlan(\entities\Events $event)
    {
        if($event->getEventStatus() == 2) // If Approved
        {
            $tourplan = \entities\TourplansQuery::create()
                    ->filterByEmployeeId($event->getEmployeeId())
                    ->filterByTpDate($event->getEventDate())
                    ->findOne();
            if($tourplan == null)
            {
                $tourplan = new \entities\Tourplans();
                $tourplan->setEmployeeId($event->getEmployeeId());
                $tourplan->setTpDate($event->getEventDate());
                $tourplan->setCompanyId($event->getCompanyId());
            }
            
                $tourplan->setBeatId(null);
                $tourplan->setTpState($event->getEventTypes()->getEventTypeName());
                $tourplan->setTpRemark($event->getEventRemark());
                $tourplan->setTpStatus(1);
                $tourplan->save();
        }
    }

    public function findMappingBySecondary(&$outletMappingArray = [] ,$secondaryOutletID = 0)
    {
        $mappings = [];
        foreach($outletMappingArray as $outletMapping)
        {
            if($outletMapping->getSecondaryOutletId() ==$secondaryOutletID  )
            {
                array_push($mappings,$outletMapping);
            }
        }
        return $mappings;
    }

  
}


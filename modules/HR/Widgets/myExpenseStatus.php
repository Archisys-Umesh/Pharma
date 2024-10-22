<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class myExpenseStatus implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "expensesApproval";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "myExpenseStatus";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        
        $bc = new \App\Core\BaseController();
        
        $month = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(3);
        
        $monthKays = array_keys($month);

        $start = end($monthKays);
        $end = reset($monthKays);

        $startMonth = explode("|", $start);
        $endMonth = explode("|", $end);
        
        $ratecount = [];
        
        $employeeid = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
        
        //Expenses
        
        $Start = date("Y-m-01 00:00:00", strtotime($endMonth[0]));
        $End  = date('Y-m-t 23:59:59', strtotime($endMonth[1]));        
        
        $entity = \entities\ExpensesQuery::create()
                ->filterByEmployeeId($employeeid)
                ->filterByExpenseDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)     
                ->filterByExpenseStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->find();
        
        $payoutdata = array();
        
        if($entity){
        foreach ($entity as $e){

                $statusId = $e->getExpenseStatus();
                
                $status = \entities\WfStatusQuery::create()
                ->filterByWfId(2)
                ->filterByWfStatusId($statusId)                                                      
                ->findOne()->getWfStatusName();
                
                if(!isset($payoutdata[$status])){
                    $payoutdata[$status]  = 0;
                }
                    $payoutdata[$status] += 1;                                
                } 
        }
                    
                   foreach($payoutdata as $row){
                        $this->data['exp']['color'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    }

                    $this->data['exp']['data'] = $payoutdata;
                    
                    
        //Trip
                    
        $entity = \entities\TripsQuery::create()                
                ->filterByEmployeeId($employeeid)                
                ->filterByTripStartDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByTripStartDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByTripStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->find();
        
        $payoutdata = array();
        
        if($entity){
        foreach ($entity as $e){

                $statusId = $e->getTripStatus();
                
                $status = \entities\WfStatusQuery::create()
                ->filterByWfId(1)
                ->filterByWfStatusId($statusId)                                                      
                ->findOne()->getWfStatusName();
                
                if(!isset($payoutdata[$status])){
                    $payoutdata[$status]  = 0;
                }
                    $payoutdata[$status] += 1;                                
                } 
        }
                    
        foreach($payoutdata as $row){
             $this->data['trip']['color'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
         }

         $this->data['trip']['data'] = $payoutdata;
         
        if(!$this->app->Auth()->checkPerm("ess_org_admin")){
            
            return $this->app->Renderer()->render("hr/homeWidget/myExpenseStatus.twig",$this->data,FALSE);
        }
    }
   

    public function parameters($params) {
        
    }

}    
<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\OutletStock as EntitiesOutletStock;
use entities\OutletStockQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletStock implements OfflineModelInterface {

    protected $User;
    protected $log = [];

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee(); 
        $terr = OrgManager::getMyTerritories($empRec);
        $terr = implode(',', $terr);
        $terr = !empty($terr) ? $terr : '0';

        $retunDB = new WDBTable();
        $retunDB->tableName = "OutletStock";
        $retunDB->idColName = "OutletStockId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        

        $retunDB->created = OutletStockQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
                                ->filterByCompanyId($empRec->getCompanyId())
                                ->filterByOrgunitid($empRec->getOrgUnitId())
                                ->addjoin('outlet_stock.outlet_org_id', 'outlet_view.outlet_org_id', Criteria::INNER_JOIN)
                                ->where('outlet_view.territory_id in (' . $terr . ')')
                                ->find()->toArray();

        $retunDB->updated = OutletStockQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                            ->filterByCreatedAt($date,Criteria::LESS_THAN)
                            ->filterByCompanyId($empRec->getCompanyId())
                            ->filterByOrgunitid($empRec->getOrgUnitId())
                            ->addjoin('outlet_stock.outlet_org_id', 'outlet_view.outlet_org_id', Criteria::INNER_JOIN)
                            ->where('outlet_view.territory_id in (' . $terr . ')')
                            ->find()->toArray();


        return $retunDB;
    }
    
    public function getTableName()
    {
        return "OutletStock";
    }

    public function doRecordsToReceive($date,WDBTable $data)
    {
        
        foreach($data->created as &$created)
        {
            
            // will not create any new record from here, it will do from EOD job only

            // $wbtable = $data->LogUpdate("created",$created,
            //             $this->User->getPrimaryKey(),
            //             $this->User->getCompanyId());

            // unset($created["OutletStockId"]); // Remove PK

            // try {

            //     $stock = new EntitiesOutletStock();
            //     $stock->fromArray($created);
            //     $stock->setCompanyId($this->User->getCompanyId());
            //     $stock->save();

            //     $wbtable->setNewpk($stock->getPrimaryKey());
            //     $wbtable->setResMessage("New Rec Created");
            //     $wbtable->save();

            //     $this->log[$created["id"]] = "Saved";

            // }
            // catch(\Exception $e)
            // {             
            //     $this->log[$created["id"]] = $e->getMessage();
            //     $wbtable->setResMessage($e->getPrevious()->getMessage());
            //     $wbtable->save();
            // }

        }

        foreach($data->updated as &$updated)
        {
            
            $wbtable = $data->LogUpdate("updated",$updated,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());            
            try {

                $Leads = OutletStockQuery::create()->findPk($updated["OutletStockId"]);
                $Leads->fromArray($updated);
                $Leads->setCompanyId($this->User->getCompanyId());
                $Leads->save();
                
                $wbtable->setResMessage("Update");
                $wbtable->save();

                $this->log[$updated["id"]] = "Update";

            }
            catch(\Exception $e)
            {             
                $this->log[$updated["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }
    }
            
    // Deactivate the controller 
    public function canRun()
    {
        return true;
    }
    
    // Bool flag in error occured
    public function hadError()
    {

    }
    
    // Get array of error per record. 
    public function getErrorMessage()
    {

    }
    
    // Get full log 
    public function getLog()
    {
        return $this->log;
    }

}

<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\DayplanQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class DayPlan implements OfflineModelInterface {

      protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "DayPlan";
        $retunDB->idColName = "DayplanId";

        $start_date = date('Y-m-d');
        $from_date = date('Y-m-d', strtotime("-150 days"));
        
        $created = DayplanQuery::create()            
            ->leftJoinWithAgendatypes()            
            ->leftJoinWithGeoTowns()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)            
            ->filterByPositionId($empRec->getPositionId())
            ->filterByTpDate($from_date,Criteria::GREATER_EQUAL)
            ->find()->toArray();

        
        $created = $this->straightener($created);
        $retunDB->created = $created;

        $updated = DayplanQuery::create()            
                    ->leftJoinWithAgendatypes()            
                    ->leftJoinWithGeoTowns()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                    ->filterByCreatedAt($date,Criteria::LESS_THAN)
                    ->filterByTpDate($from_date,Criteria::GREATER_EQUAL)
                    ->filterByPositionId($empRec->getPositionId())
                    ->find()->toArray();

        $updated = $this->straightener($updated);
        $retunDB->updated = $updated;

        return $retunDB;
    }

    public function straightener($records)
    {
        foreach($records as &$c)
        {
            if(isset($c["Agendatypes"]["Agendname"]))
            {
                $c["Agendname"] = $c["Agendatypes"]["Agendname"];
                unset($c["Agendatypes"]);
            }
            if(isset($c["GeoTowns"]["Stownname"]))
            {
                $c["Stownname"] = $c["GeoTowns"]["Stownname"];
                unset($c["GeoTowns"]);
            }
            if(isset($c["CampaignVisitPlanId"]))
            {
                $c["CampaignVisitPlanId"] = (int)$c["CampaignVisitPlanId"];
            }
            
        }

        return $records;
    }
    public function getTableName()
    {
        return "DayPlan";
    }
    
    public function doRecordsToReceive($date,WDBTable $data)
    {
        foreach($data->created as &$created)
        {
            // is wdb key is duplicate
            if($data->isSyncDuplicate("created",$created,$this->User->getPrimaryKey(),$this->User->getCompanyId()))
            {
                continue;
            }

            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["DayplanId"]); // Remove PK

            try {
                if($created['Agendacontroltype'] == 'FW'){
                    $Dayplan = \entities\DayplanQuery::create()
                            ->filterByCompanyId($this->User->getCompanyId())
                            ->filterByTpDate($created['TpDate'])
                            ->filterByOutletOrgDataId($created['OutletOrgDataId'])
                            ->filterByPositionId($created['PositionId'])
                            ->findOne();
                }else if($created['Agendacontroltype'] == 'NCA'){
                    $Dayplan = null;
                }
                if($Dayplan == NULL){
                    $Dayplan = new \entities\Dayplan();
                    $Dayplan->fromArray($created);
                    $Dayplan->setCompanyId($this->User->getCompanyId());
                    $Dayplan->save();

                    $wbtable->setNewpk($Dayplan->getPrimaryKey());
                    $wbtable->setResMessage("New Rec Created");
                    $wbtable->save();

                    $this->log[$created["id"]] = "Saved";
                }else{

                    $wbtable->setNewpk(null);
                    $wbtable->setResMessage("Rec already exists!");
                    $wbtable->save();

                    $this->log[$created["id"]] = "Error";

                }
            }
            catch(\Exception $e)
            {             
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }

        foreach($data->updated as &$updated)
        {
            
            $wbtable = $data->LogUpdate("updated",$updated,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());            
            try {

                $Dayplan = DayplanQuery::create()->findPk($updated["DayplanId"]);
                if($Dayplan != null)
                {
                    $Dayplan->fromArray($updated);
                    $Dayplan->setCompanyId($this->User->getCompanyId());
                    $Dayplan->save();
                
                    $wbtable->setResMessage("Update");
                    $wbtable->save();

                    $this->log[$updated["id"]] = "Update";
                }
                else 
                {
                    $wbtable->setNewpk(null);
                    $wbtable->setResMessage("Rec not found");
                    $wbtable->save();

                    $this->log[$updated["id"]] = "Error";
                }                
            

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


<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;

use BI\manager\OrgManager;
use entities\EdPlaylistQuery;
use entities\TerritoriesQuery;

use entities\EdPresentationsQuery;
use entities\EdStatsQuery;
use entities\Users;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class EdStats implements OfflineModelInterface
{

      protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "EdStats";
        $retunDB->idColName = "EdStatsId";
        
        $under = OrgManager::getMyPositions($empRec);
        //$under[] = $empRec->getPositionId();

        $from_date = date('Y-m-d h:m', strtotime("-120 minutes")); 
        
        $retunDB->created = EdStatsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            //->filterByOrgunitid ($empRec->getOrgUnitId())
            //->filterByPositionId($under)
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();

        $retunDB->updated = EdStatsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            //->filterByPositionId($under)
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "EdStats";
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

            unset($created["EdStatsId"]); // Remove PK

            try {

                $EdStats = new \entities\EdStats();
                $EdStats->fromArray($created);

                try {
                    $duration = $EdStats->getDeviceEndTime()->getTimestamp() - $EdStats->getDeviceStartTime()->getTimestamp();
                    $EdStats->setDuration($duration);
                } catch(Exception $e) {}

                $EdStats->setCompanyId($this->User->getCompanyId());
                $EdStats->save();
                
                $wbtable->setNewpk($EdStats->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

            }            
            catch(Exception $e)
            {                                             
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getMessage());
                $wbtable->save();                
            }

        }

        foreach($data->updated as &$updated)
        {
            
            $wbtable = $data->LogUpdate("updated",$updated,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());            
            try {

                $EdStats = EdStatsQuery::create()->findPk($updated["EdStatsId"]);
                $EdStats->fromArray($updated);
                $EdStats->setCompanyId($this->User->getCompanyId());
                $EdStats->save();
                
                $wbtable->setResMessage("Update");
                $wbtable->save();

                $this->log[$updated["id"]] = "Update";

            }
            catch(\Exception $e)
            {             
                $this->log[$updated["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getMessage());
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

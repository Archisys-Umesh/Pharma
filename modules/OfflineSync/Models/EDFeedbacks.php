<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\EdFeedbacksQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class EDFeedbacks implements OfflineModelInterface
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
        $retunDB->tableName = "EdFeedbacks";
        $retunDB->idColName = "EdFeedbackId";
        
        //$under = OrgManager::getMyTeam($empRec);
        //$under[] = $empRec->getPositionId();
        $from_date = date('Y-m-d', strtotime("-90 days"));
        
        $retunDB->created = EdFeedbacksQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();

        $retunDB->updated = EdFeedbacksQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "EdFeedbacks";
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
           
            unset($created["EdFeedbackId"]); // Remove PK
           
            try {

                $EdFeedbacks = new \entities\EdFeedbacks();
                $EdFeedbacks->fromArray($created);
                $EdFeedbacks->setEmployeeId($this->User->getEmployeeId());
                $EdFeedbacks->setCompanyId($this->User->getCompanyId());
                $EdFeedbacks->save();

                $wbtable->setNewpk($EdFeedbacks->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

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

                $EdFeedbacks = EdFeedbacksQuery::create()->findPk($updated["EdFeedbackId"]);
                $EdFeedbacks->fromArray($updated);
                $EdFeedbacks->setCompanyId($this->User->getCompanyId());
                $EdFeedbacks->save();
                
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

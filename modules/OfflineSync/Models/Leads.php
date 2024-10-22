<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;

use entities\LeadsQuery;
use BI\manager\OrgManager;
use entities\Leads as EntitiesLeads;
use entities\Users;

;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class Leads implements OfflineModelInterface
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
        $retunDB->tableName = "Leads";
        $retunDB->idColName = "LeadId";
        
        $from_date = date('Y-m-d', strtotime("-3 days"));

        
        $retunDB->created = LeadsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                                        
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)
            ->filterByPositionId($empRec->getPositionId())
            ->find()->toArray();

        $retunDB->updated = LeadsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByPositionId($empRec->getPositionId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "Leads";
    }

    public function doRecordsToReceive($date,WDBTable $data)
    {
        foreach($data->created as &$created)
        {
            
            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["LeadId"]); // Remove PK

            try {

                $Leads = new EntitiesLeads();
                $Leads->fromArray($created);
                $Leads->setCompanyId($this->User->getCompanyId());
                $Leads->save();

                $wbtable->setNewpk($Leads->getPrimaryKey());
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

                $Leads = LeadsQuery::create()->findPk($updated["LeadId"]);
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

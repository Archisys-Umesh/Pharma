<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use Exception;

use App\System\App;
use entities\EdSession;
use BI\manager\OrgManager;
use entities\EdStatsQuery;
use entities\EdSessionQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class EdSessions implements OfflineModelInterface
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
        $retunDB->tableName = "EdSession";
        $retunDB->idColName = "EdSessionId";
        
        
        $from_date = date('Y-m-d', strtotime("-3 days"));

        
        $retunDB->created = EdSessionQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                                        
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();

        $retunDB->updated = EdSessionQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "EdSession";
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

            unset($created["EdSessionId"]); // Remove PK

            try {

                $dataValidation = json_decode($created['EdSummary']);
                foreach($dataValidation as $dv)
                {
                    if($dv->Duration == 0)
                    {
                        $dv->Duration = 1;
                    }
                }

                $created['EdSummary'] = json_encode($dataValidation);
                

                $EdSession = new EdSession();
                $EdSession->fromArray($created);
                
                $EdSession->setCompanyId($this->User->getCompanyId());
                $EdSession->save();
                
                $wbtable->setNewpk($EdSession->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

            }            
            catch(Exception $e)
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

                $EdSession = EdSessionQuery::create()->findPk($updated["EdSessionId"]);
                $EdSession->fromArray($updated);
                $EdSession->setCompanyId($this->User->getCompanyId());
                $EdSession->save();
                
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

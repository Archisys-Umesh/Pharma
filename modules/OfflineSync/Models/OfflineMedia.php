<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\OfflineMediaQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OfflineMedia implements OfflineModelInterface
{

    protected $log = [];
    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {

        $empRec = $this->User->getEmployee();

        $retunDB = new WDBTable();

        $retunDB->tableName = "OfflineMedia";

        $retunDB->idColName = "OfflineMediaId";

        $retunDB->created = OfflineMediaQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->find()->toArray();

        $retunDB->updated = OfflineMediaQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "OfflineMedia";
    }

    public function doRecordsToReceive($date, WDBTable $data)
    {
        foreach($data->created as &$created){
            // is wdb key is duplicate
            if($data->isSyncDuplicate("created",$created,$this->User->getPrimaryKey(),$this->User->getCompanyId()))
            {
                continue;
            }

            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["OfflineMediaId"]); // Remove PK

            try {
                
                $OfflineMedia = new \entities\OfflineMedia();
                $OfflineMedia->fromArray($created);            
                $OfflineMedia->save();

                $wbtable->setNewpk($OfflineMedia->getPrimaryKey());
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

    }

}

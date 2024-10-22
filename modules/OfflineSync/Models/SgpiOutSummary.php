<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\SgpiTransQuery;
use entities\SgpiAccountsQuery;
use entities\SgpiEmployeeBalanceQuery;
use entities\SgpiOutSummaryQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class SgpiOutSummary implements OfflineModelInterface {

    protected $User;
    protected $log = [];
    protected $perms = [];

    public function setApp(Users $user)
    {
        $this->User = $user;
        $this->perms = explode(",", $user->getRoles()->getRolePermissions());
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "SgpiOutSummary";
        $retunDB->idColName = "Uniqueid";

        if (in_array("disable_orders", $this->perms) || $empRec->getPositionsRelatedByPositionId()->getReportingTo() == NULL) {
            return $retunDB;
        }

        $terr = OrgManager::getMyTerritories($empRec);

        $retunDB->created = [];
        $retunDB->updated = SgpiOutSummaryQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByLastcreate($date,Criteria::GREATER_EQUAL)                            
                            ->filterByTerritoryId($terr)
                            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "SgpiOutSummary";
    }
    
    public function doRecordsToReceive($date,WDBTable $data)
    {

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

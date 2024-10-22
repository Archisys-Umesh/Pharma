<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\DarViewQuery;
use entities\RcpaRetailerViewQuery;
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
class RcpaRetailSummary implements OfflineModelInterface {

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
        $retunDB->tableName = "RcpaRetailSummary";
        $retunDB->idColName = "Uniqueid";
        
        if (in_array("disable_orders", $this->perms) || $empRec->getPositionsRelatedByPositionId()->getReportingTo() == NULL) {
            return $retunDB;
        }

        $from_date = date('Y-m-d', strtotime("-90 days"));
        
        $terr = OrgManager::getMyTerritories($empRec);
        

        $retunDB->created = RcpaRetailerViewQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)       
                                ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
                                ->filterbyTerritoryId($terr)
                                ->find()->toArray();

        $retunDB->updated = RcpaRetailerViewQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                                ->filterByCreatedAt($date,Criteria::LESS_THAN)
                                ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
                                ->filterbyTerritoryId($terr)
                                ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "RcpaRetailSummary";
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

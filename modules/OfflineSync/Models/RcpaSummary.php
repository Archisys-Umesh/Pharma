<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\OutletViewQuery;
use entities\RcpaSummaryQuery;
use entities\TerritoriesQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class RcpaSummary implements OfflineModelInterface {

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

        $terr = OrgManager::getMyTerritories($empRec);
        
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY. 

        $retunDB = new WDBTable();
        $retunDB->tableName = "RcpaSummary";
        $retunDB->idColName = "Uniqueid";

        if (in_array("disable_orders", $this->perms) || $empRec->getPositionsRelatedByPositionId()->getReportingTo() == NULL) {
            return $retunDB;
        }

        $from_date = date('Y-m-d', strtotime("-90 days"));

        $retunDB->created = RcpaSummaryQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByLastcreated($date,Criteria::GREATER_EQUAL)                        
                            ->filterByTerritoryId($terr)
                            ->find()->toArray();
        $retunDB->updated = RcpaSummaryQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByLastcreated($date,Criteria::LESS_THAN)                        
                            ->filterByLastupdated($date,Criteria::GREATER_EQUAL)                        
                            ->filterByTerritoryId($terr)
                            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "RcpaSummary";
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

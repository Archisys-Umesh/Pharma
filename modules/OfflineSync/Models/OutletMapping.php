<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use DateInterval;
use App\System\App;
use entities\Users;
use entities\BeatsQuery;
use BI\manager\OrgManager;
use entities\CategoriesQuery;
use entities\OutletTagsQuery;
use entities\OutletTypeQuery;
use entities\AgendatypesQuery;
use entities\OutletMappingQuery;
use entities\OutletMappingViewQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletMapping implements OfflineModelInterface {

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
        $retunDB->tableName = "OutletMappingView";
        $retunDB->idColName = "MappingId";

        
        if (in_array("disable_orders", $this->perms) || $empRec->getPositionsRelatedByPositionId()->getReportingTo() == NULL) {
            return $retunDB;
        }
        

        // Go Back 1 day - EOD Jobs
        $date = $date->sub(new DateInterval("P2D"));
        
        $terr = OrgManager::getMyTerritories($empRec);

        $retunDB->created = OutletMappingViewQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)                                
                                ->filterByTerritoryId($terr)
                                ->filterByOrgUnitId($empRec->getOrgUnitId())
                                ->find()->toArray();    
                                    
        $retunDB->updated = OutletMappingViewQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                            ->filterByCreatedAt($date,Criteria::LESS_THAN)
                            ->filterByTerritoryId($terr)
                            ->filterByOrgUnitId($empRec->getOrgUnitId())
                            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "OutletMappingView";
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

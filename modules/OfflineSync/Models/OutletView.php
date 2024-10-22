<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use DateInterval;
use App\System\App;
use entities\Users;
use BI\manager\OrgManager;
use entities\OutletViewQuery;
use entities\TerritoriesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletView implements OfflineModelInterface {

       protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();

        $terr = OrgManager::getMyTerritories($empRec);
        
        // Go Back 1 day - EOD Jobs
        $date = $date->sub(new DateInterval("P1D"));

        $retunDB = new WDBTable();

        $retunDB->tableName = "OutletView";
        $retunDB->idColName = "OutletOrgId";

        $retunDB->created = OutletViewQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)                        
                            ->filterByTerritoryId($terr)
                            ->filterByOutletStatus('active')
                            ->find()->toArray();
        $retunDB->updated = OutletViewQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByCreatedAt($date,Criteria::LESS_THAN)                        
                            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)                        
                            ->filterByTerritoryId($terr)
                            ->filterByOutletStatus('active')
                            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "OutletView";
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

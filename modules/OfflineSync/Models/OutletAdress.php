<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use DateInterval;
use App\System\App;
use entities\Users;
use BI\manager\OrgManager;
use entities\OutletViewQuery;
use entities\TerritoriesQuery;
use entities\OutletAddressQuery;
use entities\Base\OutletAddressView;
use Propel\Runtime\ActiveQuery\Criteria;
use entities\Base\OutletAddressViewQuery;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletAdress implements OfflineModelInterface {

       protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();

        //var_dump($empRec->toArray());exit;
        
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY. 

        $retunDB = new WDBTable();

        $retunDB->tableName = "OutletAddressView";
        $retunDB->idColName = "OutletAddressId";

         // Go Back 1 day - EOD Jobs
         $date = $date->sub(new DateInterval("P2D"));

        $terr = OrgManager::getMyTerritories($empRec);

        $retunDB->created = OutletAddressViewQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)                        
                            ->filterByTerritoryId($terr)
                            ->find()->toArray();
        $retunDB->updated = OutletAddressViewQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                            ->filterByCreatedAt($date,Criteria::LESS_THAN)
                            ->filterByTerritoryId($terr)
                            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "OutletAddressView";
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

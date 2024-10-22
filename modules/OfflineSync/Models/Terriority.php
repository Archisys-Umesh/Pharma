<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\BeatsQuery;
use BI\manager\OrgManager;
use entities\ProductsQuery;
use entities\PositionsQuery;
use entities\CategoriesQuery;
use entities\AgendatypesQuery;
use entities\TerritoriesQuery;
use entities\DesignationsQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class Terriority implements OfflineModelInterface
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
        $retunDB->tableName = "Territories";
        $retunDB->idColName = "TerritoryId";
        
        $terr = OrgManager::getMyTerritories($empRec);

        
        $retunDB->created = TerritoriesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByTerritoryId($terr)
            ->find()->toArray();

        $retunDB->updated = TerritoriesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByTerritoryId($terr)
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "Territories";
    }
    

    public function doRecordsToReceive($date, WDBTable $data)
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

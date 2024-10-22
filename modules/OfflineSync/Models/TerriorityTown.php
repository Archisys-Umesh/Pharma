<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\BeatsQuery;
use entities\Territories;
use BI\manager\OrgManager;
use entities\ProductsQuery;
use entities\PositionsQuery;
use entities\CategoriesQuery;
use entities\AgendatypesQuery;
use entities\TerritoriesQuery;
use entities\DesignationsQuery;
use entities\TerritoryTownsQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class TerriorityTown implements OfflineModelInterface
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
        $retunDB->tableName = "TerritoryTowns";
        $retunDB->idColName = "TerritoryTownsId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         

        $terr = OrgManager::getMyTerritories($empRec);


        $created = TerritoryTownsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByTerritoryId($terr)
            ->filterByCompanyId($empRec->getCompanyId())
            ->joinWithGeoTowns()            
            ->groupByItownid()
            ->find()->toArray();


        foreach ($created as &$c) {
            $c["Stownname"] = $c["GeoTowns"]["Stownname"];
            unset($c["GeoTowns"]);
        }
        $retunDB->created = $created;

        $updated = TerritoryTownsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByTerritoryId($terr)
            ->filterByCompanyId($empRec->getCompanyId())
            ->joinWithGeoTowns()            
            ->groupByItownid()
            ->find()->toArray();

        foreach ($updated as &$u) {
            $u["Stownname"] = $u["GeoTowns"]["Stownname"];
            unset($u["GeoTowns"]);
        }
        $retunDB->updated = $updated;

        return $retunDB;
    }

    public function getTableName()
    {
        return "TerritoryTowns";
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

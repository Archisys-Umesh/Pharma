<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\EdPlaylistTypesQuery;
use entities\EdPresentationsQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class EdPlaylistTypes implements OfflineModelInterface
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
        $retunDB->tableName = "EdPlaylistTypes";
        $retunDB->idColName = "EdPlaylistTypeId";
        
        //$terr = OrgManager::getMyTerritories($empRec);

        
        $retunDB->created = EdPlaylistTypesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();

        $retunDB->updated = EdPlaylistTypesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "EdPlaylistType";
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

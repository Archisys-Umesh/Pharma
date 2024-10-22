<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;

use BI\manager\OrgManager;
use entities\EdPlaylistQuery;
use entities\TerritoriesQuery;

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
class EdPresentations implements OfflineModelInterface
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
        $retunDB->tableName = "EdPresentations";
        $retunDB->idColName = "PresentationId";
        
        //$terr = OrgManager::getMyTerritories($empRec);
        
        $lan = explode(',',$empRec->getEmployeeSpokenLanguage());
        
        $retunDB->created = EdPresentationsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByOrgunitId ($empRec->getOrgUnitId())
            ->filterByPresentationLanguageId($lan)
            ->orderByPresentationName()
            ->find()->toArray();

        $retunDB->updated = EdPresentationsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByPresentationLanguageId($lan)
            ->filterByOrgunitId ($empRec->getOrgUnitId())
            ->orderByPresentationName()
            ->find()->toArray();
        
        return $retunDB;
    }

    public function getTableName()
    {
        return "EdPresentations";
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

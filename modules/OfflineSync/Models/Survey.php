<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\SurveyCategoryQuery;
use entities\SurveyQuery;
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
class Survey implements OfflineModelInterface
{

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {

        $empRec = $this->User->getEmployee();

        $retunDB = new WDBTable();

        $retunDB->tableName = "Survey";

        $retunDB->idColName = "SurveyId";

        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.
        $orgUnitId = $empRec->getOrgUnitId();

        $startDate = date('Y-m-d');



        $retunDB->created = SurveyQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByStartDate($startDate,Criteria::LESS_EQUAL)
            ->filterByEndDate($startDate,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByOrgunitid($orgUnitId)
            ->find()->toArray();

        $retunDB->updated = SurveyQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByStartDate($startDate,Criteria::LESS_EQUAL)
            ->filterByEndDate($startDate,Criteria::GREATER_EQUAL)
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByOrgunitid($orgUnitId)
            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "Survey";
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

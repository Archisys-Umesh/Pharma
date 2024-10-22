<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\SurveyCategoryQuery;
use entities\SurveyQuery;
use entities\SurveyQuestionQuery;
use entities\TerritoriesQuery;
use entities\Users;
use function Illuminate\Support\dd;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class SurveyQuestion implements OfflineModelInterface
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

        $retunDB->tableName = "SurveyQuestion";

        $retunDB->idColName = "Surveyquesid";

        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.
        $orgUnitId = $empRec->getOrgUnitId();
        $startDate = date('Y-m-d');
        $surveyIds = SurveyQuery::create()
//            ->select('SurveyId')
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByOrgunitid($orgUnitId)
            ->find()->toArray();

        $surveyIdArr = [];

        foreach ($surveyIds as $surveyId){
            $surveyIdArr[] = $surveyId['SurveyId'];
        }

//        foreach ()

        $retunDB->created = SurveyQuestionQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterBySurveyId($surveyIdArr)
            ->filterByStatus('Active')
            ->find()->toArray();

        $retunDB->updated = SurveyQuestionQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterBySurveyId($surveyIdArr)
            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "SurveyQuestion";
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

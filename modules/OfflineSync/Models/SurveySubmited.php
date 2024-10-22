<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\BrandRcpaQuery;
use entities\SurveyCategoryQuery;
use entities\SurveyQuery;
use entities\SurveyQuestionQuery;
use entities\SurveySubmitedAnswer;
use entities\SurveySubmitedAnswerQuery;
use entities\SurveySubmitedQuery;
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
class SurveySubmited implements OfflineModelInterface
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

        $retunDB->tableName = "SurveySubmited";

        $retunDB->idColName = "SurverySubmitId";

        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.


        $surveySubmiteds = SurveySubmitedQuery::create()
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->leftJoinWithBrandCampiagnVisitPlan()
            ->leftJoinWithDailycalls()
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->filterByCompanyId($empRec->getCompanyId())
            ->find();

        $response = [];

        foreach ($surveySubmiteds as $surveySubmited) {
            // Query surveySubmitedAnswer table for each surveySubmited
            $surveySubmitedAnswers = SurveySubmitedAnswerQuery::create()
                ->filterBySurveySubmitedId($surveySubmited->getSurverySubmitId())
                ->find();

            $queAnsJson = [];

            foreach ($surveySubmitedAnswers as $surveySubmitedAnswer) {
                $queAnsJson[] = [
                    'QuestionId' => $surveySubmitedAnswer->getSurveryQuestionId(),
                    'SurveyAnswer' => json_decode($surveySubmitedAnswer->getSurveyAnswer(), true)
                ];
            }
            if ($surveySubmited->getSubmitDate()!=null){
                $submitDate = $surveySubmited->getSubmitDate()->format('Y-m-d');
            } else {
                $submitDate = null;
            }

            $response[] = [
                'SurverySubmitId' => $surveySubmited->getSurverySubmitId(), // format the date as needed
                'SubmitDate' => $submitDate, // format the date as needed
                'OutletId' => $surveySubmited->getOutletId(),
                'SurveyId' => $surveySubmited->getSurveyId(),
                'BrandCampaign' => $surveySubmited->getBrandCampiagnVisitPlan(),
                'DCR' => $surveySubmited->getDailycalls(),
                'EmployeeId' => intval($surveySubmited->getEmployeeId()),
                'ForEmployeeId' => intval($surveySubmited->getForEmployeeId()),
                'ShortCode' => $surveySubmited->getShortCode(),
                'Status' => $surveySubmited->getStatus(),
                'AudienceType' => $surveySubmited->getAudienceType(),
//                'CreatedAt'             => $surveySubmited->getCreatedAt()->format('Y-m-d H:i:s'),
//                'UpdatedAt'             => $surveySubmited->getUpdatedAt()->format('Y-m-d H:i:s'),
                'SurveyQuestionAnswer' => json_encode($queAnsJson)
            ];
        }

        $retunDB->created = $response;

        $retunDB->updated = [];

        return $retunDB;
    }

    public function getTableName()
    {
        return "SurveySubmited";
    }

    public function doRecordsToReceive($date, WDBTable $data)
    {
        $empRec = $this->User->getEmployee();
        foreach ($data->created as &$created) {
            // is wdb key is duplicate
            if ($data->isSyncDuplicate("created", $created, $this->User->getPrimaryKey(), $this->User->getCompanyId())) {
                continue;
            }
            $wbtable = $data->LogUpdate("created", $created,
                $this->User->getPrimaryKey(),
                $this->User->getCompanyId());

            unset($created["SurverySubmitId"]); // Remove PK

            try {
                // Brand campaign visit plan id
                $brandCampaignVisitPlan = \entities\BrandCampiagnVisitPlanQuery::create()
                    ->filterBySurveyId($created['SurveyId'])
                    ->findOne();

                $surveySubmited = SurveySubmitedQuery::create()
                    ->filterBySurveyId($created['SurveyId']);


                if ($created['AudienceType']=="Employee"){
                    $surveySubmited->filterByEmployeeId($this->User->getEmployeeId())->filterByForEmployeeId($created['ForEmployeeId']);
                }

                if ($created['AudienceType']=="Customer"){
                    $surveySubmited ->filterByOutletId($created['OutletId'])->filterBySubmitDate($created['SubmitDate']);
                }

                $surveySubmited = $surveySubmited->findOne();


                if ($surveySubmited == null) {
                    $surveySubmited = new \entities\SurveySubmited();
                }

                $surveySubmited->setEmployeeId($this->User->getEmployeeId());
                $surveySubmited->setOutletId($created['OutletId']);
                $surveySubmited->setSurveyId($created['SurveyId']);
                $surveySubmited->setSubmitDate($created['SubmitDate']);
                $surveySubmited->setShortCode($created['ShortCode']);
                $surveySubmited->setStatus($created['Status']);
                $surveySubmited->setAudienceType($created['AudienceType']);
                $surveySubmited->setForEmployeeId($created['ForEmployeeId']);
                $surveySubmited->setCompanyId($empRec->getCompanyId());
                if ($brandCampaignVisitPlan != null && $brandCampaignVisitPlan != '') {
                    if ($brandCampaignVisitPlan->getBrandCampiagnVisitPlanId() != null) {
                        $surveySubmited->setBrandcampaignVisitPlanId($brandCampaignVisitPlan->getBrandCampiagnVisitPlanId());
                    }
                }
                $surveySubmited->save();

                $surveySubmitedAnswer = SurveySubmitedAnswerQuery::create()
                    ->filterBySurveySubmitedId($surveySubmited->getSurverySubmitId())->find();

                foreach ($surveySubmitedAnswer as $surveySubmitedAns) {
                    $surveySubmitedAns->delete();
                }
                $answerData = json_decode($created['SurveyQuestionAnswer'], true);
                foreach ($answerData as &$answer) {
                    $surveyAnswer = new \entities\SurveySubmitedAnswer();
                    $surveyAnswer->setSurveryQuestionId($answer['QuestionId']);
                    $surveyAnswer->setSurveySubmitedId($surveySubmited->getSurverySubmitId());
                    $surveyAnswer->setSurveyAnswer(json_encode($answer['SurveyAnswer']));
                    $surveyAnswer->save();
                }

                $wbtable->setNewpk($surveySubmited->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

            } catch (\Exception $e) {
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }

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

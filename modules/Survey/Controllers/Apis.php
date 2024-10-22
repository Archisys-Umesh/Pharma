<?php

declare(strict_types=1);

namespace Modules\Survey\Controllers;

use App\System\App;
use App\Utils\ImageUploader;
use entities\Survey;
use entities\SurveyCategory;
use entities\SurveyQuestion;
use entities\SurveyQuestionQuery;
use entities\SurveySubmited;
use entities\SurveySubmitedAnswer;
use entities\SurveySubmitedAnswerQuery;
use entities\SurveyUser;
use entities\SurveyuserAnswer;

/**
 * Description of API
 *
 * @author Plus91Labs-01
 */
class Apis extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @OA\Get(
     *     path="/api/getTicketTypes",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all ticket types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTicketTypes()
    {

        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $ticketTypes = \entities\TicketTypeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toArray();
                $this->apiResponse($ticketTypes, 200, "Get all ticket types successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getsurveycategoies",
     *     tags={"Survey API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all Survey Category successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSurveyCategory()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $categoryId = $this->app->Request()->getParameter("category_id");
                $surveys = \entities\SurveyCategoryQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
//                    ->filterByOutletTypeId($outletId)

                    ->find()
                    ->toArray();
//                var_dump($this->app->Auth()->CompanyId());
                $this->apiResponse($surveys, 200, "Get all Survey Category successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getsurvey",
     *     tags={"Survey API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         description="Category Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
    @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="Get all ticket types successfully!",
     *         @OA\JsonContent()
     *     ),
     * @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getsurvey()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $categoryId = $this->app->Request()->getParameter("category_id");
                $outletTypeId = $this->app->Request()->getParameter("outlet_type_id");
                $surveys = \entities\SurveyQuery::create()
                    ->filterBySurveyCatid($categoryId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutletTypeId($outletTypeId)
                    ->filterByOrgunitid($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
                    ->find()
                    ->toArray();
                $surveyData = [];

                foreach ($surveys as $survey) {
                    if ($survey['IsMultiple'] == false) {
                        $question = SurveyQuestionQuery::create()
                            ->filterBySurveyId($survey['SurveyId'])
                            ->findOne();
                        if ($question != null) {

                            $answer = SurveySubmitedAnswerQuery::create()
                                ->joinWithSurveySubmited()
                                ->filterBySurveryQuestionId($question->getSurveyquesid())
                                ->findOne();
                            if ($answer != null) {
                                if ($answer->getSurveySubmited()->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()) {
                                    continue;
                                }
                            }
                        }
                        $surveyData[] = $survey;
                    } else {

                        $surveyData[] = $survey;
                    }
                }

                $this->apiResponse($surveyData, 200, "Get all Survey successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/surveyquestions",
     *     tags={"Survey API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="survey_id",
     *         in="query",
     *         description="Survey Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all ticket types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function SurveyQuestions()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $categoryId = $this->app->Request()->getParameter("survey_id");
                $surveys = \entities\SurveyQuestionQuery::create()
                    ->filterBySurveyId($categoryId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->orderBySurveyquesid(\Propel\Runtime\ActiveQuery\ModelCriteria::ASC)
//                    ->filterByOutletTypeId($outletId)
                    ->find()
                    ->toArray();
               //var_dump( $surveys);die;
                $this->apiResponse($surveys, 200, "Get all Survey Question successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/generatesurveybyid",
     *     tags={"Survey API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Survey Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="surveycatId",
     *         in="query",
     *         description="Survey Category Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="multiple",
     *         in="query",
     *         description="Multiple",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function generatesurveybyid()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $surveyId = $this->app->Request()->getParameter("surveyId");
                $name = $this->app->Request()->getParameter("name");
                $surveycatId = $this->app->Request()->getParameter("surveycatId");
                $multiple = $this->app->Request()->getParameter("multiple");
                $status = $this->app->Request()->getParameter("status");
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $orgunitId = $this->app->Request()->getParameter("org_unit_id");

                try {
//                    var_dump($name,intval($surveycatId),boolval($multiple),$status,intval($outletId),$this->app->Auth()->getUser()->getCompanyId(),$this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());exit;
                    $survey = new Survey();
                    $survey->setSurveyName($name);
                    $survey->setSurveycatId(intval($surveycatId));
                    $survey->setIsMultiple($multiple);
                    $survey->setStatus($status);
                    $survey->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $survey->setOutletTypeId(intval($outletId));
                    $survey->setOrgunitid($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
                    $survey->save();

                    $this->apiResponse($survey->toArray(), 200, "Survey add successfully!");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getsurveyanswer",
     *     tags={"Survey API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *          @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="Create User Answer",
     *          @OA\JsonContent(
     *
     *              @OA\Property(
     *                  property="user_answer",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example={
     *                          {
     *                              "question_id":"1",
     *                              "answer":"3"
     *                          },
     *                          {
     *                              "question_id":"2",
     *                              "answer":"5"
     *                          },
     *                      },
     *                  )
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getsurveyanswer()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $answers = $this->app->Request()->getParameter("user_answer");

                $outletId = $this->app->Request()->getParameter("outlet_id");
                /*$surveyQuesType = $this->app->Request()->getParameter("surveyQuesType");
                $question = $this->app->Request()->getParameter("question");
                $surveyQuestionOpt = $this->app->Request()->getParameter("surveyQuestionOpt");
                $surveyId = $this->app->Request()->getParameter("surveyId");
//                $companyId = $this->app->Request()->getParameter("companyId");
                $status = $this->app->Request()->getParameter("status");
                $questionNumber = $this->app->Request()->getParameter("question_number");*/

                try {

                    $submit = new SurveySubmited();
                    $submit->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                    $submit->setSubmitDate(date('Y-m-d'));
                    $submit->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $submit->setOutletId(intval($outletId));
                    $submit->save();
                    $answerData = [];
                    foreach ($answers as $data) {
                        foreach ($data as $d) {
                            $ans = new SurveySubmitedAnswer();
//                            var_dump($d->answer);exit;
                            $ans->setSurveyAnswer($d->answer);
                            $ans->setSurveryQuestionId($d->question_id);
                            $ans->setSurveySubmitedId($submit->getSurverySubmitId());
                            $ans->save();
                            $answerData[] = $ans;
                        }
                    }


                    $this->apiResponse($submit->toArray(), 200, "Survey Answer add successfully!");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }


}

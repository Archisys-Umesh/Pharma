<?php declare(strict_types=1);

namespace Modules\Survey\Controllers;

use App\System\App;
use App\Utils\FormMgr;

use App\Core\MediaManager;
use entities\OrgUnitQuery;
use entities\OutletTypeQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Masters extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function surveyCategory()
    {


        $this->data['title'] = "Survey Category";
        $this->data['form_name'] = "Surveycategory";
        $this->data['cols'] = [
            "Survey Cat Name" => "SurveyCatName",
        ];

        $this->data['pk'] = "SurveyCatid";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SurveyCategoryQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterBySurveyCatName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
                break;
            case "form":

                $orgUnits = OrgUnitQuery::create()->find()->toKeyValue("Orgunitid", "UnitName");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'SurveyCatName' => FormMgr::text()->label('Name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Orgunitid' => FormMgr::select()->options($orgUnits)->label('Org Unit')->class("multi-select")->multiple("multiple")->required()

                ]);
                $surveycat = new \entities\SurveyCategory();
                $this->data['form_name'] = "Add Survey Category";
                if ($pk > 0) {
                    $surveycat = \entities\SurveyCategoryQuery::create()
                        ->findPk($pk);
                    if ($surveycat->getOrgunitid()!=null){
                        $f["Orgunitid"]->val(explode(",", $surveycat->getOrgunitid()));
                    }


                    $f->val($surveycat->toArray());
                    $this->data['form_name'] = "Edit Survey Category";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {

                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $surveycat->delete();
                    } else {
                        $orgunits = implode(",", $_POST['Orgunitid']);
                        unset($_POST['Orgunitid']);
                        $surveycat->fromArray($_POST);
                        $surveycat->setOrgunitid($orgunits);
                        $surveycat->setCompanyId($this->app->Auth()->CompanyId());
                        $surveycat->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;

        endswitch;
    }

    public function surveyQuestion($id)
    {
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Survey Question ";
        $this->data['form_name'] = "surveyQuestion";
        $this->data['cols'] = [
            "Survey Question Type" => "Surveyquestype",
            "Survey Question Option" => "Surveyquestionopt",
            "Survey Question" => "Question",
            "Survey" => "SurveyId",
            "Status" => "Status",
        ];

        $this->data['pk'] = "Surveyquesid";
        $this->data['mediaCol'] = "MediaId";

        $survey = \entities\SurveyQuery::create()
            ->findByCompanyId($this->app->Auth()->CompanyId());
        $res = [];
        foreach ($survey as $surve) {
            $res[$surve->getPrimaryKey()] = $surve->getSurveyName();
        }
        $this->data['valKeys'] = ["SurveyId" => $res];


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SurveyQuestionQuery::create()->filterBySurveyId($id)->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterBySurveyId($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithSurvey()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;

                break;
            case "form":
                $surveyId = \entities\SurveyQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("SurveyId", "SurveyName");
                $datachange = $this->app->Request()->getParameter("datachange");
                $html = FormMgr::text()->label('Surveyquestionopt *')->id("Surveyquestionopt")->required();
                if ($datachange == "changeOrgUnitId") {
                    $OrgUnitId = $this->app->Request()->getParameter("Surveyquestype");
                    if ($OrgUnitId == "TextBox") {
                        $html = FormMgr::text()->label('Surveyquestionopt')->id("Surveyquestionopt");
                    } else {
                        $html = FormMgr::text()->label('Surveyquestionopt *')->id("Surveyquestionopt");
                    }

                    $this->json(["Surveyquestionopt" => $html]);
                    return;
                }
                $types = $this->getConfig("Survey", "SurveyQuesTypes");
                $status = $this->getConfig("Survey", "Status");
                $required = $this->getConfig("Survey", "Required");


                $f = FormMgr::formHorizontal();
                $f->add([
                    'SurveyId' => FormMgr::hidden()->val($id),
                    'Surveyquestype' => FormMgr::select()->options($types)->label('Survey Question Type *')->required()->datachange("changeOrgUnitId"),
                    'Surveyquestionopt' => $html,
                    'Question' => FormMgr::text()->label('Question *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Status' => FormMgr::select()->options($status)->label('Status *')->required(),
                    'IsRequired' => FormMgr::select()->options($required)->label('Is Required *')->required(),

                ]);

                $surveyques = new \entities\SurveyQuestion();

                $this->data['form_name'] = "Add Survey Question";
                if ($pk > 0) {
                    $surveyques = \entities\SurveyQuestionQuery::create()
                        ->findPk($pk);
                    $f->val($surveyques->toArray());
                    $this->data['form_name'] = "Edit Survey Question";
                    $this->data['canDelete'] = true;

                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $surveyques->delete();
                    } else {
                        $json = json_encode($_POST['Surveyquestionopt']);
                        $surveyques->fromArray($_POST);
                        $surveyques->setSurveyquestionopt($json);
                        $surveyques->setCompanyId($this->app->Auth()->CompanyId());
                        $surveyques->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId", "Media", [$surveyques->getMediaId()], 10);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function survey()
    {
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Survey";
        $this->data['form_name'] = "Survey";
        $this->data['cols'] = [
            "Survey Name" => "SurveyName",
            "Survey Category" => "SurveyCategory.SurveyCatName",
//            "OutletTypeId" => "OutletType.OutlettypeName",
            "Multiple" => "IsMultiple",
            "Status" => "Status",
            "StartDate" => "StartDate",
            "EndDate" => "EndDate",
            "AudienceType" => "AudienceType",
        ];

        $this->data['pk'] = "SurveyId";
        $this->data['mediaCol'] = "MediaId";
        $this->data['rowButtons'] = ["survey_question" => "zmdi zmdi-layers"];

        $surveyCategory = \entities\SurveyCategoryQuery::create()
            ->findByCompanyId($this->app->Auth()->CompanyId());

        $outlets = OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
        $res = [];
        foreach ($surveyCategory as $surveyCat) {
            $res[$surveyCat->getPrimaryKey()] = $surveyCat->getSurveyCatName();
        }
        $this->data['valKeys'] = ["Surveycatid" => $res];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SurveyQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterBySurveycatid($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithSurveyCategory()->joinOutletType()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $surveyCateId = \entities\SurveyCategoryQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Surveycatid", "SurveyCatName");
                $orgUnits = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                $outlets = OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("OutlettypeId", "OutlettypeName");
                $status = $this->getConfig("Survey", "Status");
                $multiple = $this->getConfig("Survey", "Multiple");
                $audienceType = $this->getConfig("Survey", "AudienceType");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'SurveyName' => FormMgr::text()->label('Name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'StartDate' => FormMgr::date()->label('Start Date *')->required(),
                    'EndDate' => FormMgr::date()->label('End Date *')->required(),
                    'SurveyCatid' => FormMgr::select()->options($surveyCateId)->label('Survey Category Type *')->required(),
                    'Orgunitid' => FormMgr::select()->options($orgUnits)->label('Org Unit *')->required(),
                    'IsMultiple' => FormMgr::select()->options($multiple)->label('Is Multiple *')->required(),
                    'OutletTypeId' => FormMgr::select()->options($outlets)->label('Outlet Type *')->required(),
                    'Status' => FormMgr::select()->options($status)->label('Status *')->required(),
                    'AudienceType' => FormMgr::select()->options($audienceType)->label('Audience Type *')->required(),
                    'ShortCode' => FormMgr::text()->label('Short Code *'),

                ]);
                $survey = new \entities\Survey();
                $this->data['form_name'] = "Add Survey";
                if ($pk > 0) {
                    $survey = \entities\SurveyQuery::create()
                        ->findPk($pk);
                    $f->val($survey->toArray());
                    $this->data['form_name'] = "Edit Survey";
//                    $this->data['canDelete'] = true;

                }
                if ($this->app->isPost() && $f->validate()) {

                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $survey->delete();
                    } else {
                        if ($_POST['MediaId']!=null){
                            $mediaId = explode(',',$_POST['MediaId']);
                            $media = $mediaId[0];
                        } else {
                            $media = null;
                        }

                        $existingSurvey = \entities\SurveyQuery::create()
                            ->filterByAudienceType($_POST['AudienceType'])
                            ->filterByOrgunitid($_POST['Orgunitid'])
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->findOne();

                        if ($existingSurvey && $pk == 0) {
                            // If survey already exists and it's not an edit (pk = 0), show an alert box
                            $this->runModalScript("alert('Survey with the same Audience Type and Org Unit already exists!');");
                            return;
                        }

                        $survey->fromArray($_POST);
                        if ($_POST['AudienceType']=="Employee"){
                            $survey->setShortCode("JW_Survey");
                        }
                        $survey->setCompanyId($this->app->Auth()->CompanyId());
                        $survey->setMediaId($media);
                        $survey->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId", "Media", [$survey->getMediaId()], 1);
                $this->data['form'] = $form . $mediaInput;

                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function surveySubmitted()
    {
        $this->data['title'] = "SurveySubmited";
        $this->data['form_name'] = "SurveySubmited";
        $this->data['cols'] = [
            "Survey Submit Date" => "SubmitDate",
            "Employee" => "Employee.FirstName",
        ];

        $this->data['pk'] = "SurverySubmitId";
        $this->data['rowButtons'] = ["survey_answer" => "zmdi zmdi-layers"];

        $submittedAnswer = \entities\SurveySubmitedQuery::create()
            ->findOne();

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\SurveySubmitedQuery::create()
                    ->joinWithEmployee()
                    ->find()->toArray()]);

                break;

        endswitch;

    }

    public function surveyAnswer($id)
    {
        $this->data['title'] = "SurveySubmitedAnswer";
        $this->data['form_name'] = "SurveyAnswer";
        $this->data['cols'] = [
            "Survey Question" => "SurveyQuestion.Question",
            "Survey Answer" => "SurveyAnswer",
        ];

        $this->data['pk'] = "SurverySubmitedAnsId";

        $surveyCategory = \entities\SurveySubmitedAnswerQuery::create()
            ->filterBySurveySubmitedId($id)
            ->findOne();

        $outlets = OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\SurveySubmitedAnswerQuery::create()
                    ->filterBySurveySubmitedId($id)
                    ->joinWithSurveyQuestion()
                    ->find()->toArray()]);

                break;

        endswitch;
    }
}


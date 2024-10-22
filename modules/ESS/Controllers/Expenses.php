<?php

declare(strict_types=1);
//\Modules\ESS\Runtime\EssHelper::

namespace Modules\ESS\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use BI\manager\NotificationManager;
use DateTime;
use entities\AttendanceQuery;
use entities\Base\PositionsQuery;
use entities\EmployeeQuery;
use entities\ExpenseNotification;
use entities\ExpenseNotificationQuery;
use entities\ExpensesQuery;
use entities\MediaFiles;
use entities\SurveySubmitedAnswer;
use Modules\System\Processes\Notification;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Runtime\PolicyRequest;
use Modules\System\Processes\PolicyChecker;
use Modules\System\Processes\WorkflowManager;
use App\Core\MediaManager;

class Expenses extends \App\Core\BaseController implements \Modules\System\Interfaces\Document
{
    protected $app;
    private $WfDoc = "Expenses";
    private $logger;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->logger = new \Monolog\Logger(_SESSIONKEY);

        $this->logger->pushHandler(
            new \Monolog\Handler\StreamHandler(__DIR__ . "/../../../log/appLog.log")
        );

    }

    /*
    public function getList_removed_depricated() {

        $action = $this->app->Request()->getParameter("action","");
        $pk = $this->app->Request()->getParameter("pk",0);
        $status = $this->app->Request()->getParameter("status",1);

        $this->data['start'] = date('m-01-Y',strtotime('this month'));
        $this->data['end'] = date('m-t-Y',strtotime('this month'));

        $dr = $this->app->Request()->getParameter("dr",$this->data['start']." - ".$this->data['end']);

        $daterange = explode(" - ", $dr);

        switch ($action) :
            case "":

                $this->app->Renderer()->render("ess/expenseList.twig",$this->data);
                break;
            case "list" :
                if( ! in_array($status,["P","A"])) {
                $expenses = \entities\ExpensesQuery::create()
                    ->filterByEmployee($this->app->Auth()->getUser()->getEmployee())
                    ->filterByExpenseStatus($status)
                    ->filterByExpenseDate($daterange[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($daterange[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toKeyIndex();
                }
                else if ($status == "P")
                {
                    $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
                    $expenses = \entities\ExpensesQuery::create()
                    ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->filterByExpenseDate($daterange[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($daterange[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPrimaryKeys($pendingAction)->find()->toKeyIndex();
                }
                else if ($status == "A")
                {
                    $expenses = \entities\ExpensesQuery::create()
                    ->filterByEmployee($this->app->Auth()->getUser()->getEmployee())
                    ->filterByExpenseStatus(5, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                    ->filterByExpenseDate($daterange[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($daterange[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toKeyIndex();
                }

                $this->json($expenses);
                break;
            case "v" :
                $exp = \entities\ExpensesQuery::create()
                    ->findPk($pk);
                $status = \Modules\System\Processes\WorkflowManager::getStatusList($this->WfDoc, "". $exp->getExpenseStatus());

                $this->data['exp'] = $exp;
                $this->data['emp'] = $exp->getEmployee();
                $this->data['status'] = $status[$exp->getExpenseStatus()];
                $this->data['exp_actions'] = WorkflowManager::getActions($this->WfDoc, $pk, $exp->getExpenseStatus(), $this->app, 2);
                $this->app->Renderer()->render("ess/expenseCard.twig",$this->data);

        endswitch;

    }
    */

    public function getList($id = 0)
    {
        $emp = $id;
        if ($this->app->Request()->getParameter("page", "") == 'P') {
            \Modules\System\Runtime\UserTriggers::checkOnce("firstTimeApproval", $this->app->Auth()->getUser()->getUserId());
        }
        $action = $this->app->Request()->getParameter("action", "");
        $data = [];
        $isOwner = $this->app->Auth()->checkPerm('hr');

        switch ($action) :

            case "":
                $this->data['defaultEmp'] = $emp;
                $this->data['monthlySubmissions'] = ($this->app->Auth()->getUser()->getCompany()->getCurrentmonthsubmit() == 1);
                //$this->data['submitCurrentMonth'] = $this->getConfig("ESS", "submitCurrentMonth");

                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths()))
                    ->html();
                $this->data['monthLists'] = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
                if ($emp == 0) {
                    $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);


                    $exp = \entities\ExpensesQuery::create()
                        ->select(["EmployeeId"])
                        ->filterByExpId($pendingAction)
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->find()->toArray();


                    $emp = \entities\EmployeeQuery::create()
                        ->filterByEmployeeId($exp)
                        ->find();

                    foreach ($emp as $e) {

                        $data[] = [
                            'name' => $e->getFirstName() . " " . $e->getLastName() . " | " . $e->getEmployeeCode(),
                            'id'   => $e->getEmployeeId()
                        ];

                    }
                    $org = \entities\OrgUnitQuery::create()
                        ->find();

                    foreach ($org as $o) {

                        $data1[] = [
                            'name' => $o->getUnitName() . " | " . $o->getOrgunitid(),
                            'id'   => $o->getOrgunitid()
                        ];
                    }
                    $this->data['OrgUnit'] = $data1;
                    if (isset($_GET['id'])) {

                        $expenseselectId = \entities\ExpensesQuery::create()->findPk($_GET['id']);
                        $this->data['empListid'] = $expenseselectId->getBudgetId();
                        $this->data['empList'] = $data;
                    } else {
                        $this->data['empList'] = $data;
                    }

                } else {
                    $this->data["selectedEmployee"] = \entities\EmployeeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findByEmployeeId($emp)->getFirst();
                }
                $this->data['statusList'] = WorkflowManager::getStatusList($this->WfDoc);
                $months = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
                $this->data['setcurrntmonth'] = $months['endDate'];

                if (isset($_GET['id'])) {
                    $this->data['setApprove'] = true;
                    $ExpEmpid = \entities\ExpensesQuery::create()->findPk($_GET['id']);

                    if ($ExpEmpid) {
                        if ($ExpEmpid->getEmployee()->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()) {
                            $this->data['setStatus'] = $ExpEmpid->getExpenseStatus();
                        } else {
                            $this->data['page'] = "P";
                        }
                    }
                }
                if (isset($_GET['setMonth'])) {
                    $this->data['setMonth'] = $_GET['setMonth'];
                    $this->data['emp'] = $_GET['id'];
                }
                if (isset($_GET['page'])) {
                    $this->data['page'] = $_GET['page'];
                }

                $this->data['isNotTop'] = !\Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());
                $this->data['isTopLevel'] = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());


                $this->data["role"] = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $curMonth = date('Y-m');
                $explode = explode('|', $this->data['setcurrntmonth']);
                $selMon = date('Y-m', strtotime($explode[0]));

                if ($curMonth == $selMon) {
                    $aprBtn = 'Yes';
                } else {
                    $aprBtn = 'No';
                }
                $this->data["aprBtn"] = $aprBtn;

                if ($this->app->Auth()->checkPerm('all_emp_perm') == true) {
                    $this->app->Renderer()->render("ess/expenseListbtnView.twig", $this->data);
                } else {
                    $this->app->Renderer()->render("ess/expense.twig", $this->data);
                }
                break;

            case "list":

                $status = $this->app->Request()->getParameter("status");
                $employee = $this->app->Request()->getParameter("employee");
                $OrgUnitId = $this->app->Request()->getParameter("orgdivison");
                $month = explode("|", $this->app->Request()->getParameter("month", "|"));
                $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
                $allowedMonths = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
                $counts = [];
                foreach ($allowedMonths as $a => $b) {
                    $counts[$b] = 0;
                }
                $monthSelected = $allowedMonths[$this->app->Request()->getParameter("month", "|")]; // Backup
                unset($allowedMonths[$this->app->Request()->getParameter("month", "|")]); // Remove month Selected
                if ($status != "P" && $emp == 0) { // Set as Self , when no dropdown
                    $employee = $this->app->Auth()->getUser()->getEmployeeId();
                }
                //print_r($status);die;
                if ($this->app->Auth()->checkPerm('all_emp_perm') == true) {
                    //$OrgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                    $expenses = \Modules\ESS\Runtime\EssHelper::getAllExpenses($status, $OrgUnitId, $month, $pendingAction);

                } else {
                    $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
                }
                //print_r(count($expenses));die;
                $counts[$monthSelected] = count($expenses);
                foreach ($allowedMonths as $mn => $mns) { // Getting count for other months than not selected
                    $d = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, explode("|", $mn), $pendingAction);
                    $counts[$mns] = count($d);
                }
                $AlltipNames = [];


                $curMonth = date('Y-m');
                $selMon = date('Y-m', strtotime($month[0]));

                if ($curMonth == $selMon) {
                    $aprBtn = 'Yes';
                } else {
                    $aprBtn = 'No';
                }
                $role = $this->app->Auth()->getUser()->getRoles()->getRoleName();


                //var_dump($role.' | '.$aprBtn);exit;

                $this->json(["list" => $expenses, "count" => $counts, "trips" => $AlltipNames, "aprBtn" => $aprBtn, "role" => $role]);
                break;

            case "bulk":

                $moveStatus = (int)$this->app->Request()->getParameter("moveStatus");
                $ExpId = $this->app->Request()->getParameter("ExpId", []);
                $employee = $this->app->Request()->getParameter("empId");
                $month = $this->app->Request()->getParameter("month");

                $expMonth = explode('|', $month);

                $expCount = \entities\ExpensesQuery::create()
                    ->filterByExpenseDate($expMonth[0], Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($expMonth[1], Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(2)
                    ->filterByEmployeeId($employee)
                    ->find()->count();
                if (count($ExpId) != $expCount) {
                    return $this->json(["status" => 0]);
                }

                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $expTotal = 0;

                if ($moveStatus == 3) {
                    if ($this->getUser()->getCompany()->getPaymentsystem() == 1 && $this->getUser()->getCompany()->getAutoSettle() == 1) {
                        $advance = new \Modules\HR\Runtime\AdvanceHelper($this->app);
                        if (!$advance->canApprove($ExpId)) {
                            $this->json(["status" => 0]);
                            break;
                        }
                    }
                }
                foreach ($ExpId as $e) {
                    $entity = \entities\ExpensesQuery::create()->findPk($e);
                    $entity->setExpenseApprovedAmt($entity->getExpenseReqAmt());
                    $entity->setExpenseStatus($moveStatus);

                    if ($moveStatus == 4) {
                        $entity->setExpenseApprovedAmt(0);
                    }

                    /*if($moveStatus == 3) {
                        //\Modules\ESS\Runtime\EssHelper::gstToClaimedTax($entity->getPrimaryKey());
                    }*/

                    $expTotal += $entity->getExpenseFinalAmt();
                    $employeeId = $entity->getEmployeeId();

                    $entity->save();
                    $wfManager->process($this->WfDoc, $entity, "");
                }

                // Send Email
                if ($moveStatus == 2 && count($ExpId) > 0) {
                    $me = $this->app->Auth()->getUser()->getEmployee();
                    $manager = $wfManager->getEmployeeLevelUp($me, 1);
                    $this->sendReqApprovalEmail($me, $manager->getEmail());
                }

                if ($moveStatus == 3) {
                    if ($this->getUser()->getCompany()->getPaymentsystem() == 1 && $this->getUser()->getCompany()->getAutoSettle() == 1) {


                        $checkBal = new \Modules\HR\Runtime\AdvanceHelper($this->app);
                        $newBal = $checkBal->processPayment($employeeId, 'Auto settle', date('Y-m-d'), $expTotal, $expTotal);

                        $query = \entities\ExpensesQuery::create()
                            ->filterByExpenseStatus(3)
                            ->filterByExpId($ExpId)->find();
                        $title = "Expense settled Amount";
                        $message = "Your Expense settled Amount : " . $expTotal;
                        foreach ($query as $q) {
                            $q->setSettledAmount($expTotal);
                            $q->setSettledDate(date('Y-m-d'));
                            $q->setSettledDesc('Auto settled');
                            $q->setExpenseStatus(11);
                            $q->save();
                            $manager = $wfManager->createLog("Expenses", $q, $q->getEmployee(), 3, $message, 0);
                        }
                        $notification = NotificationManager::sendNotificationToUser($this->app->Auth()->getUser()->getUserId(), $title, $message);
                    }
                }


                $this->json(["status" => 1]);
                break;

            case "quickView":

                $expid = (int)$this->app->Request()->getParameter("expid");
                $exp = \entities\ExpensesQuery::create()->findPk($expid);

                $this->data['exp'] = $exp;
                $this->data['extstatus'] = $exp->getExpenseStatus();
                $this->data['rows'] = $exp->getExpenseLists();
                $this->data['currencySumbol'] = $exp->getCurrencies()->getSymbol();
                $this->data['level'] = WorkflowManager::getCurrentLevel($this->WfDoc, $expid, $exp->getExpenseStatus(), $this->app);

                $this->app->Renderer()->render("ess/quickExpenseView.twig", $this->data);

                break;
            case "deleteExp":

                $expid = (int)$this->app->Request()->getParameter("expid");

                $exp = \entities\ExpensesQuery::create()
                    //->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($expid);

                //$this->deleteExpense($exp);
                $delete = \Modules\ESS\Runtime\EssHelper::deleteExpense($exp);

                $this->json(["status" => 0]);
                break;
        endswitch;

    }

    public function initForm($id = 0)
    {
        $pk = $id;
        $datachange = $this->app->Request()->getParameter("datachange", "");
        $trip_options = [];
        if ($this->app->Auth()->getUser()->getCompany()->getExpenseonlyontrip() != 1) {
            $trip_options[0] = "HQ";
        }
        $Branch = \entities\EmployeeQuery::create()->filterByEmployeeId($this->app->Auth()->getUser()->getEmployee()->getEmployeeId())->findOne();
        $placeofWork = $Branch->getBranch()->getBranchname() . " | " . $Branch->getGeoTowns()->getStownname();
        if (isset($_GET['error'])) {
            $this->app->Session()->setFlash("error", $_GET['error']);
        }

        if ($datachange == "updateTrip") {
            $date = $this->app->Request()->getParameter("ExpenseDate");
            if ($date == "") {
                $this->app->Session()->setFlash("error", "Date Empty.");
            } else {
                $emp = $this->app->Auth()->getUser()->getEmployee();
                $gradeId = $this->app->Auth()->getUser()->getEmployee()->getGradeId();
                //$updateTrip = \Modules\ESS\Runtime\EssHelper::updateTrip($date,$emp,$gradeId,"system");
                //$this->json($updateTrip);
                return;
            }
        }

        $budgetId = \entities\BudgetGroupQuery::create()
            ->filterBYCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Bgid", "GroupName");

        $f = FormMgr::formHorizontal();
        $dateRange = \Modules\ESS\Runtime\EssHelper::getRangeAllowedMonth($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());

        $f->add([
            'ExpenseDate'     => FormMgr::text()->label('Date')->direction("range")->class('datepicker')->dmin("-3M")->dmax("+1W")->autocomplete("off")->readonly("readonly"),
            'ExpenseTrip'     => FormMgr::select()->options($trip_options)->label('Working at')->id("ExpenseTrip")->required(),
            'BudgetId'        => FormMgr::select()->options($budgetId)->label('Purpose')->required(),
            'ExpensePlacewrk' => FormMgr::text()->label("Place of work *")->required()->value($placeofWork)->id("ExpensePlacewrk")->ExpensePlacewrk($placeofWork)
        ]);

        if (isset($_GET['date'])) {
            $f['ExpenseDate']->val($_GET['date']);
        }

        $entity = new \entities\Expenses();

        if ($pk > 0) {
            $entity = \entities\ExpensesQuery::create()->findPk($pk);
            $f->val($entity->toArray());

        }
        if ($this->app->isPost() && $f->validate()) {
            $cnvDate = explode("/", $_POST['ExpenseDate']);
            $_POST['ExpenseDate'] = $cnvDate[2] . "-" . $cnvDate[1] . "-" . $cnvDate[0];
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $OrgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
            if ($pk == 0) {
                $hasClaim = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $trip_options, $_POST, $employee, $OrgUnitId, 'case1');

                if ($hasClaim) {
                    $url = $this->app->Router()->getPath("ess_expenseSingle", ["id" => $hasClaim->getPrimaryKey()]);
                    $this->app->Response()->redirect($url);
                    return;
                }
            }

            $heads = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $trip_options, $_POST, $employee, $OrgUnitId, 'case2');

            if (count($heads) > 0) {
                $expId = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $trip_options, $_POST, $employee, $OrgUnitId, 'case3');
            } else {
                $this->app->Session()->setFlash("error", "Sorry Cannot add Expenses, No Heads !");
                $this->data['emp'] = $this->app->Auth()->getUser()->getEmployee();
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("ess/addClaimMaster.twig", $this->data);
                return;

            }
            if ($expId > 0) {
                $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
                $entity = \entities\ExpensesQuery::create()->findPk($expId);

                $policyEngine = new PolicyChecker($employee, $_POST['ExpenseDate'], $default_currency);
                $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getGeoState()->getSstatename();
                $expenseslist = \Modules\ESS\Runtime\EssHelper::addExpensesList($expId, $heads, $_POST, $policyEngine, $Branchlocation);
                $entity = \entities\ExpensesQuery::create()->findPk($expId);
            }
            // Repell
            $this->repelExpenses($_POST['ExpenseDate'], $entity->getEmployee());

            if ($pk == 0) {
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process($this->WfDoc, $entity);
            }
            $url = $this->app->Router()->getPath("ess_expenseSingle", ["id" => $entity->getPrimaryKey()]);
            $this->app->Response()->redirect($url);
            //$this->runModalRedirect($url);

            return;


        }
        $this->data['emp'] = $this->app->Auth()->getUser()->getEmployee();
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("ess/addClaimMaster.twig", $this->data);

    }

    public function setNextAction($id, $stepid)
    {

        $entity = \entities\ExpensesQuery::create()->findPk($id);
        $f = FormMgr::formHorizontal();
        $step = \entities\WfStepsQuery::create()->findPk($stepid);


        $allowedStatus = WorkflowManager::getStatusList($this->WfDoc, $step->getWfOutStatus());
        $f->add([
            'ExpenseStatus' => FormMgr::select()->options($allowedStatus)->label('Status'),
            'note'          => FormMgr::text()->label('Note')
        ]);

        if ($this->app->isPost() && $f->validate()) {
            try {
                $entity->fromArray($_POST);

                if ($_POST['ExpenseStatus'] == 2) { // Submit
                    $entity->setExpenseApprovedAmt($entity->getExpenseReqAmt());
                }
                if ($_POST['ExpenseStatus'] == 3) { // Authorised
                    $authorised = 0;
                    $expenseList = $entity->getExpenseLists();
                    foreach ($expenseList as $el) {
                        $authorised = $authorised + $el->getExpFinalAmount();
                    }


                    if ($this->getUser()->getCompany()->getPaymentsystem() == 1 && $this->getUser()->getCompany()->getAutoSettle() == 1) {


                        $checkBal = new \Modules\HR\Runtime\AdvanceHelper($this->app);
                        $canApprove = $checkBal->canApprove(array($id));
                        if (!$canApprove) {
                            throw(new \Exception("Balance is not sufficient to auto settle"));
                        }


                        $newBal = $checkBal->processPayment($entity->getEmployeeId(), 'Auto settle', date('Y-m-d'), $authorised, $authorised);

                        $title = "Expense settled Amount";
                        $message = "Your Expense settled Amount : " . $authorised;

                        $entity->setSettledAmount($authorised);
                        $entity->setSettledDate(date('Y-m-d'));
                        $entity->setSettledDesc('Auto settled');
                        $entity->setExpenseStatus(11);

                        $wfManager = new \Modules\System\Processes\WorkflowManager();
                        $manager = $wfManager->createLog("Expenses", $entity, $entity->getEmployee(), 3, $message, 0);

                        $userSessions = \entities\UserSessionsQuery::create()
                            ->filterByUserId($this->app->Auth()->getUser()->getUserId())
                            ->find();
                        $notification = NotificationManager::sendNotificationToUser($this->app->Auth()->getUser()->getUserId(), $title, $message);
                    }

                    $entity->setExpenseApprovedAmt($authorised);
                    \Modules\ESS\Runtime\EssHelper::gstToClaimedTax($entity->getPrimaryKey());
                }
                if ($_POST['ExpenseStatus'] == 4) { // close Aprroved trip
                    $entity->setExpenseApprovedAmt(0);
                }
                if ($_POST['ExpenseStatus'] == 5) { // Cancelled Approve trip
                    $entity->setExpenseApprovedAmt(0);
                }

                $entity->save();


                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process($this->WfDoc, $entity, $this->app->Request()->getParameter("note", ""));
                if ($_POST['ExpenseStatus'] == 3) { // Authorised

                    $month_start = $entity->getExpenseDate()->format('Y-m-01');
                    $month_end = $entity->getExpenseDate()->format('Y-m-t');

                    $url = $this->app->Router()->getPath("ess_expenses");
                    //$this->runModalRedirect($url."?toApprove=true&id=".$entity->getEmployeeId()."&setMonth=".$month_start."|".$month_end);
                    $this->closeModalWithToast("Expense approved successfully");
                    //$this->runModalRedirect($url."?page=P");
                    return;

                } else {
                    if ($_POST['ExpenseStatus'] == 7) {
                        $this->closeModalWithToast("Expenses have been cancelled");
                    } elseif ($_POST['ExpenseStatus'] == 4) {
                        $this->closeModalWithToast("Expenses have been Rejected");
                    } else {
                        $this->closeModalWithToast("Your expense has been submitted for approval");
                    }
                    return;
                }

            } catch (\Exception $e) {
                $this->app->Session()->setFlash("error", $e->getMessage());
            }

        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

    }

    public function single($id)
    {

        $this->data['pk'] = $id;
        $this->reCalculate($id);
        $action = $this->app->Request()->getParameter("action", "");
        $this->data['monthlySubmissions'] = ($this->app->Auth()->getUser()->getCompany()->getCurrentmonthsubmit() == 1);
        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        $this->data['extstatus'] = $exp->getExpenseStatus();
        // Add more expense


        if ($action == "addMoreExp") {
            $this->addMoreExp($id);
            return;
        } elseif ($action == "delExp") {
            $expenselistid = $this->app->Request()->getParameter("expid", 0);

            $data = \Modules\ESS\Runtime\EssHelper::delExpensesList($expenselistid);

            //$this->json(["status"=>1]);
            return;
        } elseif ($action == "delFile") {
            $ExpFileId = $this->app->Request()->getParameter("ExpFileId", 0);

            $delete = \entities\ExpenseFilesQuery::create()
                ->filterByExpFileId($ExpFileId)
                ->filterByExpId($id)
                ->delete();
            if ($delete) {
                $this->json(["status" => 1]);
                return;
            } else {
                $this->json(["status" => 0]);
                return;
            }
        } elseif ($action == "cancelExpenseUrl") {
            $ExpId = $this->app->Request()->getParameter("ExpId", 0);
            $employee = $this->app->Auth()->getUser()->getEmployee();

            $delete = \entities\ExpensesQuery::create()->findPk($ExpId);
            $delete->setExpenseStatus(7);
            $delete->save();
            if ($delete) {
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("Expenses", $delete, $employee, 0, "Creacted Expense Canceled", 0);
                $wfManager->process("Expenses", $delete);
                $this->json(["status" => 1]);
                return;
            } else {
                $this->json(["status" => 0]);
                return;
            }
        } elseif ($action == "getFiles") {
            $files = \entities\ExpenseFilesQuery::create()
                ->filterByExpId($id)
                ->find()
                ->toArray();
            $this->json($files);
            return;
        } elseif ($action == "addFiles") {
            $this->postNewEmpDoc($id);
            return;
        } elseif ($action == "deleteExpense") {

            $expenseid = $this->app->Request()->getParameter("expid");
            $expense = \entities\ExpensesQuery::create()
                ->filterByExpId($expenseid)
                ->findOne();

            $delete = \Modules\ESS\Runtime\EssHelper::deleteExpense($expense);

            $this->json(["status" => 1]);
            return;
        }

        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        $emp = $exp->getEmployee();
        $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
        $currency_name = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencies()->getName();


        $policyEngine = new PolicyChecker($emp, $exp->getExpenseDate()->format("Y-m-d"), $default_currency);
        /*
        if(!$policyEngine->policy)
        {
            if($this->isAjax())
            {
                $req = new PolicyRequest("","");
                $req->setMessage("Policy Not Set");
                $req->setValidated(false);
                $req->setLimit1(0);
                $this->json($req->toArray());
            }
            else {
                $url = $this->app->Router()->getPath("ess_expenseForm",["id"=>0]);
                $this->app->Response()->redirect($url."?error=Policy Not Set");
            }
            return;
            //throw( new \Exception("Policy Not found"));

        }*/

        if ($this->app->isPost()) {
            //var_dump($this->app->Request()->getParameters());exit;
            $expentry = $this->app->Request()->getParameter("ExpQty", []);
            $ilentry = $this->app->Request()->getParameter("ILQty", []);
            $taxentry = $this->app->Request()->getParameter("TaxQty", []);
            $ExpRateQty = $this->app->Request()->getParameter("ExpRateQty", []);
            $ExpRemark = $this->app->Request()->getParameter("ExpRemark", []);
            $ExpRateMode = $this->app->Request()->getParameter("ExpRateMode", []);
            $CmpCard = $this->app->Request()->getParameter("CmpCard", []);
            $remarks = $this->app->Request()->getParameter("remarks");

            $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getGeoState()->getSstatename();

            $head = \Modules\ESS\Runtime\EssHelper::updateHeadValueNew($id, $policyEngine, $expentry, $ilentry, $taxentry, $ExpRateQty, $ExpRemark, $ExpRateMode, $CmpCard, $remarks, $Branchlocation);

            $this->data['toster_info'] = "Expenses saved";

            //$this->app->Session()->setFlash('info', "Expense saved");
        }

        if ($action == "validateExp") {
            $expId = $this->app->Request()->getParameter("expId", "");
            $value = $this->app->Request()->getParameter("val", 0);
            $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
            $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getGeoState()->getSstatename();

            $pr = \Modules\ESS\Runtime\EssHelper::validateExp($expId, $value, $policyEngine, $exp, $Branchlocation, $employeeId);
            $this->json($pr->toArray());

            return;
        }

        $rows = \entities\ExpenseListQuery::create()->findByExpId($id);

        $this->data['exp'] = $exp;
        $this->data['emp'] = $emp;
        $this->data['rows'] = $rows;

        $currentMonth = $exp->getExpenseDate()->format('m');
        $nextMonth = Date("m");


        $statuscreate = $exp->getExpenseStatus();

        $this->data['exp_log'] = WorkflowManager::getLog($this->WfDoc, $id, $exp->getExpenseStatus(), $this->app);

        if ($currentMonth != $nextMonth) {

            $this->data['exp_actions'] = WorkflowManager::getActions($this->WfDoc, $id, $exp->getExpenseStatus(), $this->app);
        } else {
            if ($this->getConfig("ESS", "submitCurrentMonth") & $exp->getExpenseFinalAmt() > $this->getConfig("ESS", "minimumClaimAmount")) {
                $this->data['exp_actions'] = WorkflowManager::getActions($this->WfDoc, $id, $exp->getExpenseStatus(), $this->app);


            }

        }
        $nextmonth = \DateTime::createFromFormat("+1 month", $exp->getExpenseDate()->format('m'));

        $this->data['level'] = WorkflowManager::getCurrentLevel($this->WfDoc, $id, $exp->getExpenseStatus(), $this->app);

        if ($exp->getExpenseStatus() == 5) {
            $this->data['audit'] = $this->app->Auth()->checkPerm("ess_audit");
        }
        $this->data['maxAttachments'] = $this->getConfig("ESS", "maxAttachments");
        $this->data['Currency'] = $currency_name;
        $this->data["pc"] = $policyEngine;
        $this->data["role"] = $this->app->Auth()->getUser()->getRoles()->getRoleName();

        $this->app->Renderer()->render("ess/expenseSingle.twig", $this->data);
    }

    public function multipleExpense($pk = 0)
    {

        $expense_list_id = $this->app->Request()->getParameter("explistid");
        $f = FormMgr::formHorizontal();
        $action = $this->app->Request()->getParameter("action");
        $level = $this->app->Request()->getParameter("level");
        switch ($action) :

            case "list":
                $amountExpDet = 0;
                // Get expense level 2 list in object from ess helper (1)
                $expList = \Modules\ESS\Runtime\EssHelper::getMultipleExpenseDetails($expense_list_id);
                $getPreFilledId = \entities\ExpenseListQuery::create()->findPk($expense_list_id);

                $dataexp = array();
                foreach ($expList as $sumAmt) {
                    $amountExpDet += $sumAmt->getAmount();
                    if (strpos($sumAmt->getImage(), ".jpg") !== false) {
                        $image = "data:image/jpeg;base64," . base64_encode(file_get_contents($sumAmt->getImage()));
                    } else {
                        $image1 = \entities\MediaFilesQuery::create()->findPk($sumAmt->getImage());
                        //$image = $image1->getMediaData();

                        $image = $url = $_ENV['STACKHERO_MINIO_HOST'] . '/' . $_ENV['STACKHERO_MINIO_AWS_BUCKET'] . '/' . rawurlencode($image1->getMediaData());
                        


                    }
                    $this->exp['Image'] = $image;
                    $this->exp['ExpDetId'] = $sumAmt->getExpDetId();
                    $this->exp['Description'] = $sumAmt->getDescription();
                    $this->exp['Amount'] = $sumAmt->getAmount();

                    $dataexp[] = $this->exp;
                }

                $this->data['details'] = $dataexp;
                $this->data['amount'] = $amountExpDet;
                $this->data['expense_list_id'] = $expense_list_id;
                $this->data['level'] = $level;
                //$this->data['IsPrefilledChecked'] = $getPreFilledId->getExpenseMaster()->getIsPrefilled();
                // render html from twig
                $this->app->Renderer()->render("ess/expenseSingleDetail.twig", $this->data);
                return;
                break;
            case "delete":
                $expListDetId = $this->app->Request()->getParameter("explistdetid");
                $deleteExp = \Modules\ESS\Runtime\EssHelper::deleteExpenses($expListDetId);
                $expList = \Modules\ESS\Runtime\EssHelper::getMultipleExpenseDetails($expense_list_id);
                $dataexp = array();
                $amountExpDet = 0;
                foreach ($expList as $sumAmt) {
                    $amountExpDet += $sumAmt->getAmount();
                    if (strpos($sumAmt->getImage(), ".jpg") !== false) {
                        $image = "data:image/jpeg;base64," . base64_encode(file_get_contents($sumAmt->getImage()));
                    } else {
                        $image1 = \entities\MediaFilesQuery::create()->findPk($sumAmt->getImage());
                        //$image = $image1->getMediaData();

                        $image = $url = $_ENV['STACKHERO_MINIO_HOST'] . '/' . $_ENV['STACKHERO_MINIO_AWS_BUCKET'] . '/' . rawurlencode($image1->getMediaData());



                    }
                    $this->exp['Image'] = $image;
                    $this->exp['ExpDetId'] = $sumAmt->getExpDetId();
                    $this->exp['Description'] = $sumAmt->getDescription();
                    $this->exp['Amount'] = $sumAmt->getAmount();

                    $dataexp[] = $this->exp;
                }
                $this->data['details'] = $dataexp;
                $this->data['expense_list_id'] = $expense_list_id;
                $this->app->Renderer()->render("ess/expenseSingleDetail.twig", $this->data);
                return;
                break;
            case "form":
                $method = $this->app->Request()->getMethod();
                $expDetId = $this->app->Request()->getQueryParameter("expdetid", 0);
                switch ($method) :
                    case "GET":
                        $f->add([
                            'Image'       => FormMgr::file()->class('image')->label('Image *'),
                            'Description' => FormMgr::text()->label('Description *')->required(),
                            'Amount'      => FormMgr::text()->label('Amount *')->required(),
                        ]);
                        $this->data['form_name'] = "Add Expense";
                        if ($expDetId > 0) {
                            $Expedit = \entities\ExpenseListDetailsQuery::create()
                                ->findPk($expDetId);

                            $f->val($Expedit->toArray());
                            $this->data['form_name'] = "Edit Expense";
                            $f->val(['ExpListId' => $Expedit->getExpListId()]);
                            $f['Image']->val($Expedit->getImage());
                            $f['Description']->val($Expedit->getDescription());
                            $f['Amount']->val($Expedit->getAmount());
                        }
                        $this->data['form'] = $f->html();
                        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                    // no break
                    case "POST":
                        $media = null;
                        if ($this->app->isPost() && $f->validate()) {
                            $ExpListId = $this->app->Request()->getParameter("explistid", 0);
                            $des = $this->app->Request()->getParameter("Description");
                            $amount = $this->app->Request()->getParameter("Amount");
                            if (!empty($_FILES["Image"]["name"])) {
                                // Get file info
                                $fileName = basename($_FILES["Image"]["name"]);
                                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                                // Allow certain file formats
                                $allowTypes = array('jpg', 'png', 'jpeg', 'gif','JPG','PNG','JPEG','GIF');
                                if (in_array($fileType, $allowTypes)) {
                                    $image = $_FILES['Image']['tmp_name'];
                                    $fileMime = $_FILES["Image"]["type"];
                                    $imgContent = file_get_contents($image);

                                    // $file = base64_encode($imgContent);
                                    $base64 = 'data:image/' . $fileMime . ';base64,' . base64_encode($imgContent);
                                    $s3 = WorkflowManager::initializeS3Client();
                                    $bucket = $_ENV['STACKHERO_MINIO_AWS_BUCKET'];

                                    $fullPath = (new \BI\manager\FileManager())->uploadFileIntoS3($bucket, $base64, $fileName);

                                    $media = new MediaFiles();
                                    $media->setMediaName($fileName);
                                    $media->setMediaMime($fileMime);
                                    $media->setMediaData($fullPath);
                                    $media->setFolderId(null);
                                    $media->setCompanyId($this->app->Auth()->CompanyId());
                                    $media->setIss3file(true);
                                    $media->save();




                                }
                            }
                            if ($media!=null){
                                $mediaId = $media->getMediaId();
                            } else {
                                $mediaId = null;
                            }

                            \Modules\ESS\Runtime\EssHelper::AUExpenseDetail($des, $amount, $mediaId, $ExpListId, $expDetId);
                            $this->closeModalWithToast("Details Updated Successful.", "quickExpView($expense_list_id)");
                        }
                endswitch;
        endswitch;
    }


    public function addMoreExp($id)
    {
        $this->data["form_name"] = "Add More Expense";
        $exp = \entities\Base\ExpensesQuery::create()->findPk($id);
        if ($this->app->isPost()) {
            $ExpMasterId = $this->app->Request()->getParameter("ExpMasterId", []);
            foreach ($ExpMasterId as $e) {
                $expenseRow = new \entities\ExpenseList();
                $expenseRow->setCompanyId($this->app->Auth()->CompanyId());
                $expenseRow->setExpMasterId($e);
                $expenseRow->setExpReqAmount(0);
                $expenseRow->setExpAprAmount(0);
                $expenseRow->setExpFinalAmount(0);
                $expenseRow->setExpIlAmount(0);
                $expenseRow->setExpId($id);
                $expenseRow->setExpLimit1(0);
                $expenseRow->setCmpCard(0);
                //$expenseRow->setExpLimit2("");
                $expenseRow->setExpPolicyKey("");
                $expenseRow->setEmployeeId($exp->getEmployeeId());
                $expenseRow->setExpDate($exp->getExpenseDate());

                $expenseRow->save();
            }
            $this->closeModal();
            return;
        }

        $allowedExp = \Modules\ESS\Runtime\EssHelper::addMoreExpenses($id, $this->app->Auth()->getUser()->getEmployeeId(), $exp);

        $perm = FormMgr::group();
        foreach ($allowedExp as $e) {
            $pk = $e->getPrimaryKey();
            if (!isset($rows[$pk])) {

                $perm->add([
                    $pk => FormMgr::checkbox()
                        ->attr("data-toggle", "modal")
                        ->label($e->getExpenseName())
                        ->value($pk)
                ]);
            }
        }


        $f = FormMgr::formHorizontal();
        if (count($perm) > 0) {
            $f["ExpMasterId"] = $perm;
        } else {
            $this->app->Session()->setFlash("error", "Sorry no expnses to add");
        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);


    }

    public function findPolicyKey($expId, \entities\Expenses $exp)
    {
        $expense = \entities\ExpenseMasterQuery::create()->findPk($expId);
        if ($expense->getCheckcity() == 1) {

            $location = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getOrgUnit()->getUnitName();

            $loc = \entities\CitycategoryQuery::create()
                ->filterByScope(0)
                ->findByIcityid($location)->getFirst();

            $ifScope = \entities\CitycategoryQuery::create()
                ->filterByScope(1)
                ->filterByIdentityKey($this->app->Auth()->getUser()->getEmployeeId())
                ->findByIcityid($location)->getFirst();

            if ($ifScope) {
                $loc = $ifScope;
            }
            if (!$loc) {
                return $expense->getDefaultPolicykey();
            } elseif ($loc->getCategory() == "A") {
                return $expense->getPolicykeya();
            } elseif ($loc->getCategory() == "B") {
                return $expense->getPolicykeyb();
            } else {
                return $expense->getPolicykeyc();
            }
        } else {
            return $expense->getDefaultPolicykey();
        }
    }

    public function changeReq($id)
    {
        $expId = $id;
        $action = $this->app->Request()->getParameter("action");
        $entity = \entities\ExpenseListQuery::create()->findPk($expId);

        $f = FormMgr::formHorizontal();

        if ($action == "auth") {
            $f->add([
                "ExpAprAmount" => FormMgr::number()->label('Approved')->min(1)->step(1),    //->max(floatval($entity->getExpLimit2()))
                "ExpNote"      => FormMgr::text()->label('Note *')->required()
            ]);
            if ($entity->getExpAprAmount() == 0) {
                $f["ExpAprAmount"]->val($entity->getExpReqAmount());
            } else {
                $f["ExpAprAmount"]->val($entity->getExpAprAmount());
            }

            $f["ExpNote"]->val($entity->getExpNote());
        } else {
            $netpayble = $entity->getExpIlAmount() + $entity->getExpTaxAmount();
            $totalExp = $netpayble + $entity->getExpReqAmount() - $entity->getExpClaimedTax();
            if ($entity->getExpenseMaster()->getAdditionalText() == 1) {
                $f->add([
                    "ExpAuditAmount" => FormMgr::number()->label('Requested')->readonly(),
                    "ExpTaxAmount"   => FormMgr::number()->label('Final')->value($totalExp)->readonly(),
                    "ExpClaimedTax"  => FormMgr::number()->label('GST')->value($entity->getExpClaimedTax()),
                    "ExpAuditRemark" => FormMgr::text()->label('Note *')->required()

                ]);
            } else {
                $f->add([
                    "ExpAuditAmount" => FormMgr::number()->label('Final'),
                    "ExpAuditRemark" => FormMgr::text()->label('Note *')->required()
                ]);
            }


            if ($entity->getExpAuditAmount() == 0) {
                $f["ExpAuditAmount"]->val($entity->getExpAprAmount());
            } else {
                $f["ExpAuditAmount"]->val($netpayble);
            }

            $f["ExpAuditRemark"]->val($entity->getExpAuditRemark());

        }


        if ($this->app->isPost() && $f->validate()) {
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $data = \Modules\ESS\Runtime\EssHelper::editApprovel($_POST, $expId, $action, $employee);

            $this->closeModalWithToast("Changes Successful.", "reloadExpenseSingle()");
            return;
        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function reCalculate($expId)
    {
        $exps = \entities\Base\ExpenseListQuery::create()
            ->filterByExpId($expId)
            ->find();
        $total = 0;
        $req = 0;
        $approved = 0;
        $tax = 0;
        foreach ($exps as $e) {
            $total = $total + $e->getExpFinalAmount();
            $approved = $approved + $e->getExpAprAmount();
            $req = $req + $e->getExpIlAmount() + $e->getExpTaxAmount() + $e->getExpReqAmount();
            $tax = $tax + $e->getExpTaxAmount();
        }
        $entity = \entities\ExpensesQuery::create()
            ->findPk($expId);
        $entity->setExpenseApprovedAmt($approved);
        $entity->setExpenseFinalAmt($total);
        $entity->setExpenseReqAmt($req);
        $entity->setExpenseTaxAmt($tax);
        $entity->save();
    }

    public function postNewEmpDoc($id = 0)
    {
        $file = new \Upload\File('empDoc_0', $this->app->Storage());
        $new_filename = uniqid();
        $file->setName($new_filename);

        try {
            $doc = new \entities\ExpenseFiles();
            $doc->setExpFileName($new_filename);
            $doc->setExpFullName($file->getNameWithExtension());
            $doc->setExpMime($file->getMimetype());
            $doc->setExpFileSize($file->getSize());
            $doc->setExpId($id);
            $doc->save();
            $file->upload();
            $this->json(["status" => 1]);
        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $this->json(["error" => $errors, "ex" => $e->getMessage()]);

        }
    }

    public function repelExpenses($date, \entities\Employee $emp)
    {
        $exps = \entities\ExpenseListQuery::create()
            ->filterByExpDate($date)
            ->filterByEmployeeId($emp->getPrimaryKey())
            ->find()->toKeyIndex("ExpMasterId");

        $repellents = \entities\ExpenseRepellentQuery::create()->find();

        foreach ($repellents as $r) {

            if (isset($exps[$r->getExpenseId()])) {
                if (isset($exps[$r->getExpenseRepId()])) {

                    $exp_id = $exps[$r->getExpenseId()]->getExpId();
                    $exps[$r->getExpenseId()]->delete();
                    unset($exps[$r->getExpenseId()]);
                    $this->reCalculate($exp_id);

                }
            }
        }

    }


    public function sendReqApprovalEmail(\entities\Employee $user, $email)
    {
        $subject = "Expense Submited for Approval";
        $data = [
            "empDetails" => $user->getFirstName() . " " . $user->getLastName() . " | " . $user->getEmployeeCode() . " | " . $user->getDesignations()->getDesignation(),
            "message"    => "Expenses have been submited for approval",
            "url"        => $this->app->Router()->baseUrl(),
            "linkTitle"  => "Sign in"
        ];
        $body = $this->app->Renderer()->render("email\EmailMessages.twig", $data, false);

        //\App\Utils\Emails::sendEmail($email, $subject, $body,$this->app->Auth()->CompanyId());
    }

    public function getExpenseList($budget, $onlyDaily = true, $date = null)
    {
        $exps = [];
        $s = strtotime($date);
        $start = date('Y-m-01', $s);
        $end = date('Y-m-t', $s);


        $Todaysexps = \entities\ExpenseListQuery::create()
            ->filterByExpDate($date)
            ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
            ->find()->toKeyIndex("ExpMasterId");

        foreach ($budget as $b) {
            $head = $b->getExpenseMaster();
            $showExp = true;

            if (isset($Todaysexps[$head->getPrimaryKey()])) { // Already Claimed once
                $showExp = false;
            }

            if ($showExp) {
                array_push($exps, $head);
            }
        }
        return $exps;
    }

    public function deleteExpenses($id)
    {
        $array = array();
        $array["wflogData"] = array();
        $array["wfrequestData"] = array();
        $array["expenseData"] = array();
        $array["expensesListData"] = array();
        $array["expensesFileData"] = array();

        $expenses = \entities\ExpensesQuery::create()->filterByExpId($id);
        $exp = $expenses->find();

        if ($exp) {
            $wfLog = \entities\WfLogQuery::create()->filterByWfDocPk($id)->find();
            if ($wfLog->toArray()) {
                $array["wflogData"] = $wfLog->toArray();
                $wfLog->delete();

            }
            $wfrequest = \entities\WfRequestsQuery::create()->filterByWfDocPk($id)->find();
            if ($wfrequest->toArray()) {
                $array["wfrequestData"] = $wfrequest->toArray();
                $wfrequest->delete();
            }

            $expensesList = \entities\ExpenseListQuery::create()->filterByExpId($id)->find();
            if ($expensesList->toArray()) {
                $array["expensesListData"] = $expensesList->toArray();
                $expensesList->delete();
            }
            $expensesFile = \entities\ExpenseFilesQuery::create()->filterByExpId($id)->find();
            if ($expensesFile->toArray()) {
                $array["expensesFileData"] = $expensesFile->toArray();
                $expensesFile->delete();
            }
            $array["expenseData"] = $exp->toArray();

            $exp->delete();
            $data = new \entities\DeleteBackup();
            $data->setEmpid($this->app->Auth()->getUser()->getEmployeeId());
            $data->setExpid($id);
            $data->setDeletedata(serialize($array));
            $data->save();
            $array["save"] = "Please Save This Data";
            $this->json($array);
            //$this->array_to_csv_download($array,"Expenses-".$id);


        }
    }

    public function tempGstToClaimegst()
    {
        $entity = \entities\ExpenseListQuery::create()
            ->filterByExpTaxAmount(0, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            ->filterByExpClaimedTax(0)
            ->find();
        foreach ($entity as $e) {
            $gst = $e->getExpTaxAmount();
            $e->setExpClaimedTax($gst);
            $e->save();
        }
    }

    public function geoDistance()
    {
        $this->data['title'] = "GeoDistance";
        $this->data['form_name'] = "GeoDistance";
        $this->data['cols'] = [
            "Belt Name"        => "BeltName",
            "From State"       => "FromStateName",
            "From Town"        => "FromTownName",
            "From Town City"   => "FromTownCityId",
            "To State"         => "ToStateName",
            "To Town"          => "ToTownName",
            "To Town City"     => "ToTownCityID",
            "Distance Km"      => "DistanceKm",
            "Calculation Type" => "CalculationType",
            "Amount"           => "Amount",
            "Remark"           => "Remark",
        ];
        $this->data['pk'] = "GeoDistanceId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        //$policyKey = \entities\PolicykeysQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Pkeys","Pkeys");

        $calculationType = ["K" => "Per KM", "F" => "Flat / Taxi", "" => "-"];

        $this->data['valKeys'] = ["CalculationType" => $calculationType];

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));

                $cities = \entities\GeoCityQuery::create()->find()->toKeyValue('Icityid', 'Scityname');

                $query = \entities\GeoDistanceQuery::create()
                    ->leftJoinGeoTownsRelatedByFromTownId('FromTown')
                    ->addAsColumn('FromTownName', "FromTown.Stownname")
                    ->addAsColumn('FromTownCityId', "FromTown.Icityid")
                    ->innerJoinGeoTownsRelatedByToTownId('ToTown')
                    ->addAsColumn('ToTownName', "ToTown.Stownname")
                    ->addAsColumn('ToTownCityID', "ToTown.Icityid")
                    ->leftJoinGeoStateRelatedByFromStateId('FromState')
                    ->addAsColumn('FromStateName', "FromState.Sstatename")
                    ->innerJoinGeoStateRelatedByToStateId('ToState')
                    ->addAsColumn('ToStateName', "ToState.Sstatename");

                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query->filterByBeltName($search, Criteria::LIKE);
                    //->_or()
                    //->filterBy("FromTownName",$search, Criteria::LIKE);
                    //$query->filterBy("FromTown.Stownname",$search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;


                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();

                foreach ($response['data'] as $key => $data) {
                    $response['data'][$key]['FromTownCityId'] = isset($cities[$data['FromTownCityId']]) ? $cities[$data['FromTownCityId']] : "";
                    $response['data'][$key]['ToTownCityID'] = isset($cities[$data['ToTownCityID']]) ? $cities[$data['ToTownCityID']] : "";
                }

                $this->json($response);

                break;
            case "form":
                $states = \entities\GeoStateQuery::create()->find()->toKeyValue('Istateid', 'Sstatename');
                $f = FormMgr::formHorizontal();
                $f->add([
                    'BeltName'        => FormMgr::text()->label('Belt Name')->required(),
                    'FromStateId'     => FormMgr::select()->options($states)->label('From State *')->required(),
                    'FromTownId'      => FormMgr::text()->label('From Town *')->id("location")->datatoggle("locationAutoComplete")->required(),
                    'ToStateId'       => FormMgr::select()->options($states)->label('To State *')->required(),
                    'ToTownId'        => FormMgr::text()->label('To Town *')->id("location1")->datatoggle("locationAutoComplete")->required(),
                    "CalculationType" => FormMgr::select()->options($calculationType)->label('Type'),
                    'DistanceKm'      => FormMgr::number()->label('Distance In Km *')->required(),
                    'Amount'          => FormMgr::number()->label('Amount*')->required(),
                    'Remark'          => FormMgr::text()->label('Remark *')->required()->class('text-uppercase'),

                ]);

                $geoDistance = new \entities\GeoDistance();
                $this->data['form_name'] = "Add Geo Distance";
                if ($pk > 0) {
                    $geoDistance = \entities\GeoDistanceQuery::create()
                        ->leftJoinGeoTownsRelatedByFromTownId('FromTown')
                        ->addAsColumn('FromTownName', "FromTown.Stownname")
                        ->innerJoinGeoTownsRelatedByToTownId('ToTown')
                        ->addAsColumn('ToTownName', "ToTown.Stownname")
                        ->leftJoinGeoStateRelatedByFromStateId('FromState')
                        ->addAsColumn('FromStateName', "FromState.Sstatename")
                        ->innerJoinGeoStateRelatedByToStateId('ToState')
                        ->addAsColumn('ToStateName', "ToState.Sstatename")
                        ->findPk($pk);
                    $f->val($geoDistance->toArray());
                    $f['FromTownId']->sudoValue($geoDistance->getFromTownName());
                    $f['ToTownId']->sudoValue($geoDistance->getToTownName());
                    $f['FromStateId']->sudoValue($geoDistance->getFromStateName());
                    $f['ToStateId']->sudoValue($geoDistance->getToStateName());

                    $this->data['form_name'] = "Edit Geo Distance";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $geoDistance->fromArray($_POST);
                    $geoDistance->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function notifyExpenses()
    {
        $action = $this->app->Request()->getParameter("action");



        switch ($action) :
            case "":
                $this->data['OrgUnits'] = \entities\OrgUnitQuery::create()
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->find()->toKeyValue('Orgunitid', 'UnitName');
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();

                $this->data['cols'] = [
                    "Unit Name"                    => "UnitName",
                    "Month"                        => "Moye",
                    "Pending Expense For Submit"   => "UniquePendingForSubmit",
                    "Pending Expense For Approved" => "UniquePendingForApprove",
                    "Pending Punch Out"            => "PendingPunchout",

                ];
                $this->data['rowButtons'] = ["ticket_comment" => "zmdi zmdi-layers"];
                $this->data['reportname'] = "expenseNotification";

                $this->app->Renderer()->render("ess/notifyexpenses.twig", $this->data);
                break;
            case "list":
                $month = $this->app->Request()->getParameter("month");
                $orgUnit = $this->app->Request()->getParameter("orgUnit");

                extract($this->DTFilters($_GET));
                $response = [];

                if ($month !== null) {
                    // Split the input string
                    $dateRange = explode("|", $month);

                    // Extract the month and year from the first date
                    $startDate = new DateTime($dateRange[0]);
                    $month = $startDate->format('m-Y');
                }
                $expenseNotification = ExpenseNotificationQuery::create();

                if ($month != null) {
                    $expenseNotification->filterByMoye($month);
                }

                if ($orgUnit != "0") {
                    $expenseNotification->filterByOrgunitId($orgUnit);
                }
                if ($month == null) {
                    $date = date('m-Y');
                    $expenseNotification->filterByMoye($date);
                }

                $expenseNotifications = $expenseNotification->find()->toArray();
                $response = [
                    "draw" => $_GET['draw'],
                    "recordsTotal" => count($expenseNotifications),
                    "recordsFiltered" => count($expenseNotifications),
                    "data" => $expenseNotifications,
                ];

                $this->json($response);
                break;

        endswitch;
    }

    public function sendNotification()
    {
        $month = $this->app->Request()->getParameter("month");
        $orgUnit = $this->app->Request()->getParameter("orgUnit");

        if ($month != null) {
            $extractMonth = explode('|', $month);
            $startDate = new DateTime($extractMonth[0]);
            $month = $startDate->format('m-Y');

        } else {
            $month = date('m-Y');
        }


        $pendingForSubmitMessage = 'expense_pending_for_submit';
        $pendingForApprovedMessage = 'expense_pending_for_approved';
        $pendingForPunchoutMessage = 'pending_punchout';

        $pendingForSubmitData = ExpenseNotificationQuery::create();

        if ($month != null) {
            $pendingForSubmitData->filterByMoye($month);
        }

        if ($orgUnit != "0") {
            $pendingForSubmitData->filterByOrgunitId($orgUnit);
        }

        $pendingForSubmitData = $pendingForSubmitData->findOne();

        $pendingSubmitIds = [];
        $pendingManagerIds = [];
        $pendingPunchOutIds = [];

        if ($pendingForSubmitData->getUniquePendingForSubmitIds() != null) {
            $pendingSubmitIds = explode(',', $pendingForSubmitData->getUniquePendingForSubmitIds());
        }

        if ($pendingForSubmitData->getUniquePendingApprovalManagerIds() != null) {
            $pendingManagerIds = explode(',', $pendingForSubmitData->getUniquePendingApprovalManagerIds());
        }

        if ($pendingForSubmitData->getUniquePendingPunchout() != null) {
            $pendingPunchOutIds = explode(',', $pendingForSubmitData->getUniquePendingPunchout());
        }


        foreach ($pendingSubmitIds as $employee) {
            $emp = EmployeeQuery::create()->filterByEmployeeId($employee)->findOne();
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForSubmitMessage);
            $notification->setToEmployeeId($employee);
            $notification->setCompanyId($emp->getCompanyId());
            $notification->sendNotification();
        }

        foreach ($pendingManagerIds as $employee) {
            $emp = EmployeeQuery::create()->filterByEmployeeId($employee)->findOne();
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForApprovedMessage);
            $notification->setToEmployeeId($employee);
            $notification->setCompanyId($emp->getCompanyId());
            $notification->sendNotification();
        }

        foreach ($pendingPunchOutIds as $employee) {
            $emp = EmployeeQuery::create()->filterByEmployeeId($employee)->findOne();
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForPunchoutMessage);
            $notification->setToEmployeeId($employee);
            $notification->setCompanyId($emp->getCompanyId());
            $notification->sendNotification();
        }

        foreach ($pendingForSubmitData as $data) {
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForSubmitMessage);
            $notification->setToEmployeeId($data['EmployeeId']);
            $notification->setCompanyId($data['CompanyId']);
            $notification->sendNotification();
        }


        $pendingForApproveData = ExpensesQuery::create()
            ->select(['EmployeeId'])
            ->filterByExpenseDate($extractMonth[0], Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($extractMonth[1], Criteria::LESS_EQUAL)
            ->filterByExpenseStatus(2)
            ->filterByOrgunitId($orgUnit)
            ->groupByEmployeeId()
            ->groupByCompanyId()
            ->find()->toArray();

        $positionIds = EmployeeQuery::create()->select(['PositionId'])->filterByEmployeeId($pendingForApproveData)->find()->toArray();

        $reportingTo = PositionsQuery::create()->select(['ReportingTo'])->filterByPositionId($positionIds)->groupByReportingTo()->find()->toArray();

        $managers = EmployeeQuery::create()->select(['EmployeeId', 'CompanyId'])->filterByPositionId($reportingTo)->find()->toArray();

        foreach ($managers as $manager) {
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForApprovedMessage);
            $notification->setToEmployeeId($manager['EmployeeId']);
            $notification->setCompanyId($manager['CompanyId']);
            $notification->sendNotification();
        }


        $pendingPunchoutData = AttendanceQuery::create()
            ->select(['EmployeeId', 'CompanyId'])
            ->joinWithEmployee()
            ->filterByAttendanceDate($extractMonth[0], Criteria::GREATER_EQUAL)
            ->filterByAttendanceDate($extractMonth[1], Criteria::LESS_EQUAL)
            ->filterByStatus(0)
            ->useEmployeeQuery()
            ->filterByOrgUnitId($orgUnit)
            ->endUse()->groupByEmployeeId()->groupByCompanyId()->find()->toArray();

        foreach ($pendingPunchoutData as $punchout) {
            $notification = new \Modules\System\Processes\Notification;
            $notification->setEmailSent(false);
            $notification->setSmsSent(false);
            $notification->setPushSent(true);
            $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
            $notification->setTemplateKey($pendingForPunchoutMessage);
            $notification->setToEmployeeId($punchout['EmployeeId']);
            $notification->setCompanyId($punchout['CompanyId']);
            $notification->sendNotification();
        }
        return $this->json(["status" => 1]);


    }

    function expenseGroups()
    {

        $this->data['title'] = "ExpenseGroups";
        $this->data['form_name'] = "ExpenseGroups";
        $this->data['cols'] = [
            "GroupName" => "GroupName",
            "SortOrder" => "SortOrder",

        ];
        $this->data['pk'] = "ExpenseGroupId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = ExpenseG::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId())->orderById("Desc");

                if ($this->app->Auth()->checkPerm("admin")) {
                    $query = $query->filterByAllocatedTo($empId);
                }

                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByDescription($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOutlets()->joinWithTicketType()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();
                $tickettypes = \entities\TicketTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Id", "TicketType");
                //$outlets = \entities\OutletsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Id","OutletName");
                $status = $this->getConfig("Ticket", "ticketStatus");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'TicketTypeId' => FormMgr::select()->options($tickettypes)->label('Ticket Type'),
                    'OutletId'     => FormMgr::text()->label('Customer *')->required()->datatoggle('CommonAutoComplete')->href($this->app->Router()->getPath("outletAutoComplete")),
                    'Description'  => FormMgr::text()->label('Description *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Status'       => FormMgr::select()->options($status)->label('Status'),

                ]);
                $ticket = new \entities\Tickets();
                $this->data['form_name'] = "Add Ticket";
                if ($pk > 0) {
                    $ticket = \entities\TicketsQuery::create()
                        ->findPk($pk);
                    $f->val($ticket->toArray());
                    $f["OutletId"]->sudoValue($ticket->getOutlets()->getOutletName());
                    $this->data['form_name'] = "Edit Ticket";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $ticketType = \entities\TicketTypeQuery::create()
                        ->findOneById($this->app->Request()->getParameter("TicketTypeId"));
                    if ($pk == 0)  // When new Ticket
                    {
                        $ticket->fromArray($_POST);
                        $ticket->setAllocatedTo($ticketType->getEmployeeId());
                        $ticket->setEmployeeId($empId);
                        $ticket->setCompanyId($this->app->Auth()->CompanyId());
                        $ticket->save();
                        $emp = EmployeeQuery::create()->filterByEmployeeId($empId)->findOne();

                        $to = [$emp->getEmail()];
                        $subject = 'Ticket Create mail';
                        $body = "Your ticket created Successfully Please Check!";
                        \App\Utils\SendMail::smtpSendMail($to, $subject, $body);
                        $title = "Create Ticket";
                        $message = "Create Ticket Successfully";
                        $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp->getEmployeeId(), $title, $message);

                    } else {
                        $ticket->fromArray($_POST);
                        $ticket->setAllocatedTo($ticketType->getEmployeeId());
                        $ticket->setCompanyId($this->app->Auth()->CompanyId());
                        $ticket->setEmployeeId($empId);
                        $ticket->save();
                    }

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId", "Media", [$ticket->getMediaId()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }


}

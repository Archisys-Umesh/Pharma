<?php

declare(strict_types=1);

namespace Modules\ESS\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use BI\manager\LeaveManager;
use BI\manager\NotificationManager;
use Modules\ESS\Runtime\EssHelper;
use Modules\System\Processes\WorkflowManager;
use DateTime;
use Propel\Runtime\ActiveQuery\Criteria;

class Leaves extends \App\Core\BaseController implements \Modules\System\Interfaces\Document
{
    protected $app;
    protected $WfDoc = "LeaveRequest";


    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function initForm($id = 0)
    {
        $pk = $id;
        $datachange = $this->app->Request()->getParameter("datachange", "");

        $leaveTypes = \entities\LeaveTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue("ShortCode","LeaveType");
        
        $this->data['form_name'] = "Leave Request";
        $f = FormMgr::formHorizontal();
        $f->add([
            'LeaveType' => FormMgr::select()->options($leaveTypes)->label('Type *')->required(),
            'LeaveReason' => FormMgr::text()->label('Reason *')->required(),
            'LeaveFrom' => FormMgr::text()->label('Start Date *')->required()->class('datepicker'),
            'LeaveTo' => FormMgr::text()->label('End Date *')->required()->class('datepicker'),
        ]);
        $entity = new \entities\LeaveRequest();
        $this->data['form_name'] = "Request Leave";
        if ($pk > 0) {
            $entity = \entities\LeaveRequestQuery::create()->findPk($pk);

            $f->val($entity->toArray());
            $this->data['form_name'] = "Edit Leave Request";
            $f['LeaveFrom']->val($entity->getLeaveFrom("d/m/Y"));
            $f['LeaveTo']->val($entity->getLeaveTo("d/m/Y"));
        }

        if ($this->app->isPost() && $f->validate()) {

            $LeaveStartDate = \DateTime::createFromFormat("d/m/Y", $_POST['LeaveFrom']);
            $LeaveEndDate = \DateTime::createFromFormat("d/m/Y", $_POST['LeaveTo']);

            if ($LeaveStartDate > $LeaveEndDate) {
                $this->app->Session()->setFlash("error", "Start date needs to be earlier");
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                return;
            }
            $empId = $this->app->Auth()->getUser()->getEmployeeId();
            $employee = $this->app->Auth()->getUser()->getEmployee();

            if ($pk == 0 && LeaveManager::leaveRequestExists($empId, $LeaveStartDate, $LeaveEndDate)) {
                $this->app->Session()->setFlash("error", "There is a Leave that coincide with these dates");
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                return;
            }

            $LeaveType = $_POST["LeaveType"];
            $LeaveReason = $_POST["LeaveReason"];
            if ($employee->getReportingTo() != 0) {
                $employeeRep = \entities\EmployeeQuery::create()
                    ->filterByStatus(1)
                    ->filterByPositionId($employee->getReportingTo())
                    ->findByCompanyId($this->app->Auth()->CompanyId())->getFirst();
                if ($employeeRep != null) {
                    $entity = LeaveManager::createLeaveRequest($pk, $employee, $LeaveType, $LeaveReason, $LeaveStartDate, $LeaveEndDate);
                    if ($entity == false) {
                        $this->app->Session()->setFlash("error", "There is not enough leave balance for " . $LeaveType . ".");
                        $this->data['form'] = $f->html();
                        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                        return;
                    }
                } else {
                    $this->app->Session()->setFlash("error", "Reporting manager not found!!");
                    $this->data['form'] = $f->html();
                    $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                    return;
                }
            } else {
                $this->app->Session()->setFlash("error", "Reached Top !!");
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                return;
            }
            $leaveStatus = 0;
            if (isset($_POST['LeaveStatus'])) {
                $leaveStatus = $_POST['LeaveStatus'];
            }
            $tosat = self::statusMsg(1, $leaveStatus);

            $title = "Leave Request Created";
            $message = "Your Leave request created!";
            $notification = NotificationManager::sendNotificationToUser($this->app->Auth()->getUser()->getUserId(), $title, $message);
            $this->runModalScript("loadGrid('" . $tosat . "')");
            return;
        }
        //
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    // public function getleaveReort($leave_id){
    //     $images = array();
    //     $totalExp = 0;
    //     $leave = \entities\leavesQuery::create()
    //                         ->filterByleaveId($leave_id)->findOne();
    //     $exp_id = \entities\ExpensesQuery::create()
    //                     ->select('ExpId')
    //                     ->filterByExpenseleave($leave_id)
    //                     ->find()->toArray();
    //     $leaveWorklog = \entities\EmployeeWorkLogQuery::create()
    //                     ->filterByExpId($exp_id)
    //                     ->find();
    //     $expense = \entities\ExpenseListQuery::create()
    //             ->filterByExpId($exp_id)
    //             ->find();
    //     $attachement = \entities\ExpenseFilesQuery::create()
    //             ->filterByExpId($exp_id)
    //             ->find();
    //     foreach($expense as $exp){
    //         if($exp->getExpenses()->getExpenseStatus() == 6){
    //             $totalExp += $exp->getExpAprAmount();
    //         }            
    //     }
    //     $this->data['leaveUser'] = \entities\EmployeeQuery::create()
    //                                 ->filterByEmployeeId($leave->getEmployeeId())
    //                                 ->findOne();
    //     $this->data['leaveEexpense'] = $expense;
    //     $this->data['leaveWorklog'] = $leaveWorklog;
    //     $this->data['leave'] = $leave;
    //     $this->data['expCategory'] = \entities\Base\ExpenseMasterQuery::create()->find()->toKeyValue("expenseId","expenseName");
    //     $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L','setAutoTopMargin' => '400']);
    //     $path = __DIR__.'/../../../'._UPLOADS."/".$this->app->Auth()->getUser()->getCompanyId()."/"; 
    //     foreach ($attachement as $a){
    //         array_push($images, $path.$a->getExpFullName());
    //     }
    //     define('ROOT_DIR', __DIR__.'/../../../public/images/');
    //     $this->data['company_logo'] = ROOT_DIR.'logo.png';
    //     $this->data['barcode_logo'] = ROOT_DIR.'barcode.png';
    //     $this->data['voucher_img'] = ROOT_DIR;
    //     $this->data['arrow_logo'] = ROOT_DIR.'arrow.png';
    //     $this->data['images'] = $images;
    //     $this->data['totalExp'] = $totalExp;
    //      $html = $this->app->Renderer()->render("ess/reports/leaveReport.twig",$this->data,false);
    //         $mpdf->SetTitle('Report');
    //         $mpdf->SetAuthor("Xpensys");            
    //         $mpdf->SetDisplayMode('fullpage');
    //         $mpdf->WriteHTML($html); 
    //         $mpdf->Output();
    //         exit;
    // }

    public function getList($id = 0)
    {
        $emp = $id;
        if ($this->app->Request()->getParameter("page", "") == 'P') {
            \Modules\System\Runtime\UserTriggers::checkOnce("firstTimeApproval", $this->app->Auth()->getUser()->getUserId());
        }

        $leaveActionId = $this->app->Request()->getParameter("id", -1);
        if ($leaveActionId > 0) {
            $this->app->Response()->redirect($this->app->Router()->getPath("ess_leavesingle", ["id" => $leaveActionId]));
        }

        $this->data['title'] = "Leave Request";
        $this->data['form_name'] = "LeaveRequest";
        $this->data['cols'] = [
            "Start Date" => "LeaveFrom",
            "End Date" => "LeaveTo",
            "EmployeeCode" => "Employee.EmployeeCode",
            "FirstName" => "Employee.FirstName",
            "LastName" => "Employee.LastName",
            "HQ" => "Employee.GeoTowns.Stownname",
            "Division" => "Employee.OrgUnit.UnitName",
            "Type" => "LeaveType",
            "Reason" => "LeaveReason",
            "Status" => "LeaveStatus",

        ];
        $this->data['colorRows'] = [
            1 => "#ffffff",
            2 => "#9dddea",
            3 => "#ef9292",
            4 => "#ef9292",
            5 => "#ef9292",
        ];
        $this->data['dateFields'] = ['LeaveFrom', 'LeaveTo'];

        $this->data['pk'] = "LeaveReqId";
        $this->data['actionFunc'] = "ess_leaveForm";
        //$this->data['singleFunc'] = "ess_leaveSingle";
        //$this->data['rowButtons'] = ["ess_leavesingle" => "zmdi zmdi-eye"];
        $this->data['canEditIf'] = ["col" => "leaveStatus", "val" => "1"];
        $this->data['valKeys'] = [
            "LeaveType" => $this->getConfig("ESS", "leaveType"),
            "LeaveStatus" => WorkflowManager::getStatusList($this->WfDoc)
        ];

        //$this->data['filters'] = $this->getConfig("ESS", "tripFilters");

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            if (isset($_GET['id'])) {
                $leaveEmpId = \entities\LeaveRequestQuery::create()->findPk($_GET['id']);
                if ($leaveEmpId) {
                    if ($leaveEmpId->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()) {
                        $page = "A";
                    } else {
                        $page = "P";
                    }
                } else {
                    $page = "P";
                }
            } else {
                $page = "A";
            }
        }
        $istop = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());

        if ($istop) {
            $page = "P";
        }
        $this->data['isNotTop'] = !$istop;
        $this->data['page'] = $page;
        $this->data['rowButtons'] = ["ess_leavesingle" => "zmdi zmdi-eye"];

        if ($emp == 0) {
            if ($page == "P") {
                $reqs = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
            } else {
                $reqs = $this->app->Auth()->getUser()->getEmployeeId();
            }
            $leavedatearray = LeaveManager::LeaveStartEndDate($page, $reqs, $this->app->Auth()->getUser()->getEmployeeId());
        } else {
            $leavedatearray = LeaveManager::LeaveStartEndDate('A', $emp, $emp);
        }

        $this->data['leaveFilterDate'] = $leavedatearray;
        $this->data['monthLists'] = \Modules\ESS\Runtime\EssHelper::getUpcomingAndPreviousMonth($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
        $this->data['setMonth'] = date('Y-m-01|Y-m-t');

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action):
            case "":
                $this->data['defaultOrderIdx'] = 0;
                if ($emp == 0) {
                    $this->data['showStatus'] = 1;
                } else {
                    $this->data['showStatus'] = 0;
                }

                $this->app->Renderer()->render('ess/leavelist.twig', $this->data);
                break;
            case "list":
                $filter = $this->app->Request()->getParameter("filter");
                $fromDate = $this->app->Request()->getParameter("fromdate", date('Y-m-d'));
                $toDate = $this->app->Request()->getParameter("todate", date('Y-m-d'));
                $fDate = date('Y-m-d', strtotime($fromDate));
                $tDate = date('Y-m-d', strtotime($toDate));

                $date = $this->app->Request()->getParameter("filterdate");
                if ($date != null) {
                    $filDate = explode('|', $date);
                    $filterdate = $filDate[0];
                } else {
                    $filterdate = date('Y-m-d');
                }

                if ($this->app->Auth()->getUser()->getRoles()->getRoleName() == 'Admin') {
                    $pks = \entities\LeaveRequestQuery::create()
                        ->select(['LeaveReqId']);
                    if ($filter != 'P' && $filter != 'A') {
                        $pks->filterByLeaveStatus($filter);
                    }
                    $pks->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toArray();
                    $emp = $this->app->Auth()->getUser()->getEmployee();
                } else {
                    $pks = WorkflowManager::getPendingData($this->WfDoc, $this->app);

                    if ($emp == 0) {
                        $emp = $this->app->Auth()->getUser()->getEmployee();
                    } else {
                        //$emp = \entities\EmployeeQuery::create()->findPk($emp);
                        $filter = 'A';
                    }
                }
                $records = LeaveManager::getallLeaveListnew($filter, $fDate, $tDate, $filterdate, $pks, $emp);

                $this->json(["data" => $records]);
                break;
            case "datefilter":
                $filter = $this->app->Request()->getParameter("filter");
                $reqs = [];
                if ($filter == "P") {
                    $reqs = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
                } else {
                    array_push($reqs, $this->app->Auth()->getUser()->getEmployeeId());
                }
                if (count($reqs) > 0) {
                    $leavedatearray = LeaveManager::LeaveStartEndDate($filter, $reqs, $this->app->Auth()->getUser()->getEmployeeId());
                }
                $this->json($leavedatearray);
                break;
            case "quickView":
                $this->quickleaveView($this->app->Request()->getParameter("leaveid"));
                break;
            case "deleteleave":
                LeaveManager::deleteleave($this->app->Request()->getParameter("leaveid"), $this->app->Auth()->CompanyId());
                $this->json(["status" => 0]);
                break;
        endswitch;
    }

    public function setNextAction($id, $stepid)
    {
        $entity = \entities\LeaveRequestQuery::create()->findPk($id);

        $this->data['form_name'] = "Leave Request";
        $f = FormMgr::formHorizontal();
        $step = \entities\WfStepsQuery::create()->findPk($stepid);

        switch ($step->getWfStepLevel()):
            case 0:
                $f->add([
                    'LeaveReason' => FormMgr::text()->label('Reason'),
                ]);

                break;

        endswitch;

        $allowedStatus = WorkflowManager::getStatusList($this->WfDoc, $step->getWfOutStatus());
        $f->add([
            'LeaveStatus' => FormMgr::select()->options($allowedStatus)->label('Status'),
            'note' => FormMgr::text()->label('Note <span style="color: red;">*</span>')->placeholder('Enter your note here')->required(),
        ]);

        $f->val($entity->toArray());

        //        if($step->getWfStepLevel() == 0) {
        //            $f['LeaveFrom']->val($entity->getLeaveFrom("d/m/Y"));
        //            $f['LeaveTo']->val($entity->getLeaveTo("d/m/Y"));
        //        }

        if ($this->app->isPost() && $f->validate()) {
            $remark = $_POST['note'];

            //            if($step->getWfStepLevel() == 0) {
            //                $leaveStartDate =  \DateTime::createFromFormat("d/m/Y", $_POST['LeaveFrom']);
            //                $leaveEndDate = \DateTime::createFromFormat("d/m/Y", $_POST['LeaveTo']);
            //                $entity->setLeaveFrom($leaveStartDate->format('Y-m-d'));
            //                $entity->setLeaveTo($leaveEndDate->format('Y-m-d'));
            //                unset($_POST['LeaveFrom']);
            //                unset($_POST['LeaveTo']);
            //                
            //             }

            $FromDate = $entity->getLeaveFrom();
            $ToDate = $entity->getLeaveTo();
            $pos_diff = $FromDate->diff($ToDate)->format("%r%a");
            $dates = EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));
            $employee = \entities\EmployeeQuery::create()
                ->filterByEmployeeId($entity->getEmployeeId())
                ->findOne();

            $leaveClearDates = [];

            // Holidays Check
            $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
            $holidaydate = [];
            $stateId = $employee->getBranch()->getIstateid();
            foreach ($holidays as $holiday) {
                if ($holiday->getIstateid() != null) {
                    $holidayState = explode(",", (string)$holiday->getIstateid());
                    if (in_array($stateId, $holidayState)) {
                        $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                    }
                }
            }

            //Sunday Check
            foreach ($dates as $date) {
                $day = $date;
                $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                if ($currentDate->format("N") == 7) { // Sunday
                    continue;
                }
                if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                    continue;
                }
                $leaveClearDates[] = $day;
            }

            $clearDatesCount = count($leaveClearDates);
            //var_dump(count($leaveClearDates));exit;

            $daysTotal = $pos_diff + 1;
            $leavesPoint = \entities\LeavesQuery::create()
                ->select(['Leaves'])
                ->withColumn('SUM(leave_points)', 'Leaves')
                ->filterByEmployeeId($entity->getEmployeeId())
                ->filterByLeaveType($entity->getLeaveType())
                ->filterByLeavePoints(-1, Criteria::NOT_EQUAL)
                ->find()->toArray();
            $leaves = \entities\LeavesQuery::create()
                ->filterByEmployeeId($entity->getEmployeeId())
                ->filterByLeaveType($entity->getLeaveType())
                ->filterByLeavePoints(-1, Criteria::EQUAL)
                ->find()->count();


            if (isset($leavesPoint[0]) && $leavesPoint[0] > $leaves) {
                $pendingLeave = $leavesPoint[0] - $leaves;
            } else {
                $pendingLeave = 0;
            }

            if ($_POST['LeaveStatus'] == 2) {
                $leaveExsist = \entities\LeavesQuery::create()
                    ->select(['leave_date'])
                    ->filterByLeaveDate($entity->getLeaveFrom(), Criteria::GREATER_EQUAL)
                    ->filterByLeaveDate($entity->getLeaveTo(), Criteria::LESS_EQUAL)
                    ->filterByEmployeeId($entity->getEmployeeId())
                    ->filterByLeaveRequestId($entity->getLeaveReqId())
                    ->filterByLeaveType($entity->getLeaveType())
                    ->find()->toArray(); //->count();

                if (empty($leaveExsist)) {

                    if ($entity->getLeaveType() == 'LWP') {
                        $lrRequest = new \entities\LeaveRequest();
                        $lrRequest->setEmployeeId($entity->getEmployeeId());
                        $lrRequest->setLeaveType($entity->getLeaveType());
                        $lrRequest->setLeaveFrom($FromDate);
                        $lrRequest->setLeaveTo($ToDate);
                        $lrRequest->setLeaveStatus(2);
                        $lrRequest->setCompanyId($employee->getCompanyId());
                        $lrRequest->setLeaveReason($remark);
                        $lrRequest->save();
                        if ($lrRequest->getLeaveReqId() != null) {
                            $dates = EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));
                            $clearDates = [];

                            // Holidays Check
                            $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                            $holidaydate = [];
                            $stateId = $employee->getBranch()->getIstateid();
                            foreach ($holidays as $holiday) {
                                if ($holiday->getIstateid() != null) {
                                    $holidayState = explode(",", (string)$holiday->getIstateid());
                                    if (in_array($stateId, $holidayState)) {
                                        $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                                    }
                                }
                            }

                            //Sunday Check
                            foreach ($dates as $date) {
                                $day = $date;
                                $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                                if ($currentDate->format("N") == 7) { // Sunday
                                    continue;
                                }
                                if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                                    continue;
                                }
                                $clearDates[] = $day;
                            }

                            for ($i = 0; $i < $daysTotal; $i++) {
                                if (isset($clearDates[$i])) {
                                    $leaveEntity = new \entities\Leaves();
                                    $leaveEntity->setEmployeeId($entity->getEmployeeId());
                                    $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                                    $leaveEntity->setLeaveDate($clearDates[$i]);
                                    $leaveEntity->setLeaveType($entity->getLeaveType());
                                    $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                                    $leaveEntity->setLeavePoints(-1);
                                    $leaveEntity->setCompanyId($employee->getCompanyId());
                                    if ($leaveEntity->save()) {
                                        // $title = "Leave Approved";
                                        // $message = "Your leave approved!";
                                        // $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                                        $positionId = $entity->getEmployee()->getPositionId();
                                        $mtpBlock = \entities\MtpDayQuery::create()
                                            ->filterByMtpDayDate($clearDates[$i])
                                            ->findOne();
                                        if ($mtpBlock != null) {
                                            // if mtp is nto appoved
                                            $mtp = \entities\MtpQuery::create()
                                                ->filterByMtpId($mtpBlock->getMtpId())
                                                ->filterByPositionId($positionId)
                                                ->filterByMtpStatus('approved', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                                                ->findOne();
                                            if ($mtp != null) {
                                                // Delete all Tourplan for that mtpday
                                                $tourPlanDelete = \entities\TourplansQuery::create()
                                                    ->filterByTpDate($clearDates[$i])
                                                    ->filterByPositionId($positionId)
                                                    ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                    ->delete();
                                                // Delete mtp day
                                                $mtpDay = \entities\MtpDayQuery::create()
                                                    ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                    ->delete();
                                                // run AGAIN Summary
                                                $manager = new \BI\manager\MTPManager();
                                                $mtp = $manager->getMTPById($mtp->getMtpId());
                                            }
                                            //MTP is approved
                                            // chintan needs to ask sachin.
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        // if ($clearDatesCount > $pendingLeave) {
                        //     $this->app->Session()->setFlash("error", "You have only" . ' ' . $pendingLeave . ' ' . "leaves.!!");
                        //     $this->data['form'] = $f->html();
                        //     $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                        //     return;
                        // }

                        $LeaveRequest = \entities\LeaveRequestQuery::create()
                            ->filterByLeaveFrom($ToDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByLeaveTo($FromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByEmployeeId($entity->getEmployeeId())
                            ->filterByLeaveStatus(2)
                            ->find()->count();
                        if ($LeaveRequest > 0) {
                            $this->app->Session()->setFlash("error", "These date range in already approved leave.!!");
                            $this->data['form'] = $f->html();
                            $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                            return;
                        }

                        // $empl = \entities\EmployeeQuery::create()->findPk($entity->getEmployeeId());
                        // $clearDates = [];
                        // $holidays = \entities\HolidaysQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
                        // $holidaydate = [];
                        // $stateId = $empl->getBranch()->getIstateid();
                        // foreach ($holidays as $holiday) {
                        //     if ($holiday->getIstateid() != null) {
                        //         $holidayState = explode(",", (string)$holiday->getIstateid());
                        //         if (in_array($stateId, $holidayState)) {
                        //             $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                        //         }
                        //     }
                        // }
                        // foreach ($dates as $date) {
                        //     $day = $date;
                        //     $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                        //     if ($currentDate->format("N") == 7) { // Sunday
                        //         continue;
                        //     }
                        //     if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                        //         continue;
                        //     }
                        //     $clearDates[] = $day;
                        // }

                        $entity->setLeaveStatus(2);
                        $entity->save();

                        // $totalLeaveDays = $pos_diff + 1;

                        // for ($i = 0; $i < $totalLeaveDays; $i++) {
                        //     if (isset($clearDates[$i])) {
                        //         $leaveEntity = new \entities\Leaves();
                        //         $leaveEntity->setEmployeeId($entity->getEmployeeId());
                        //         $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                        //         $leaveEntity->setLeaveDate($clearDates[$i]);
                        //         $leaveEntity->setLeaveType($entity->getLeaveType());
                        //         $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                        //         $leaveEntity->setLeavePoints(-1);
                        //         $leaveEntity->setCompanyId($this->app->Auth()->CompanyId());
                        //         if ($leaveEntity->save()) {
                        //             $title = "Leave Approved";
                        //             $message = "Your leave approved!";
                        //             $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                        //             $positionId = $entity->getEmployee()->getPositionId();
                        //             $mtpBlock = \entities\MtpDayQuery::create()
                        //                 ->filterByMtpDayDate($clearDates[$i])
                        //                 ->findOne();
                        //             if ($mtpBlock != null) {
                        //                 // if mtp is nto appoved
                        //                 $mtp = \entities\MtpQuery::create()
                        //                     ->filterByMtpId($mtpBlock->getMtpId())
                        //                     ->filterByPositionId($positionId)
                        //                     ->filterByMtpStatus('approved', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        //                     ->findOne();
                        //                 if ($mtp != null) {
                        //                     // Delete all Tourplan for that mtpday
                        //                     $tourPlanDelete = \entities\TourplansQuery::create()
                        //                         ->filterByTpDate($clearDates[$i])
                        //                         ->filterByPositionId($positionId)
                        //                         ->filterByMtpDayId($mtpBlock->getMtpDayId())
                        //                         ->delete();
                        //                     // Delete mtp day
                        //                     $mtpDay = \entities\MtpDayQuery::create()
                        //                         ->filterByMtpDayId($mtpBlock->getMtpDayId())
                        //                         ->delete();
                        //                     // run AGAIN Summary
                        //                     $manager = new \BI\manager\MTPManager();
                        //                     $mtp = $manager->getMTPById($mtp->getMtpId());
                        //                 }
                        //                 //MTP is approved
                        //                 // chintan needs to ask sachin.
                        //             }
                        //         }
                        //     }
                        // }
                    }



                    $title = "Leave Approved";
                    $message = "Your leave approved!";
                    $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                } else {
                    // if($entity->getLeaveType() != 'LWP'){
                    //     if ($clearDatesCount > $pendingLeave){

                    //         $this->app->Session()->setFlash("error", "You have only" . ' ' . $pendingLeave . ' ' . "leaves !!");
                    //         $this->data['form'] = $f->html();
                    //         $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                    //         return;

                    //     }
                    // }
                    $attenadances = \entities\AttendanceQuery::create()
                        ->filterByEmployeeId($employee->getEmployeeId())
                        ->filterByAttendanceDate($leaveExsist, Criteria::IN)
                        ->find()->toArray();
                    if ($attenadances) {
                        foreach ($attenadances as $att) {
                            if ($att['Status'] == 0 || $att['Status'] == -1) {
                                $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                                $attenadance->setStatus(4);
                                $attenadance->setEndTime('00:00:00');
                                $attenadance->setRemark('Punch Leave - 666');
                                $attenadance->save();
                            }
                            if ($att['Status'] == 1) {
                                $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                                $attenadance->setStatus(4);
                                $attenadance->setRemark('Punch Leave - 673');
                                $attenadance->setExpenseId(null);
                                $attenadance->save();

                                $exp = \entities\ExpensesQuery::create()
                                    ->filterByEmployeeId($att['EmployeeId'])
                                    ->filterByExpenseDate($att['AttendanceDate'])
                                    ->findOne();
                                if ($exp) {
                                    $explist = \entities\ExpenseListQuery::create()
                                        ->filterByExpId($exp->getExpId())
                                        ->find();
                                    if (!$explist->isEmpty()) 
                                    {
                                        foreach ($explist as $expenseItem) {
                                        $expenseDetails = \entities\ExpenseListDetailsQuery::create()
                                            ->filterByExpListId($expenseItem->getExpListId())
                                            ->find();
                                        if (!$expenseDetails->isEmpty()) {    
                                            foreach ($expenseDetails as $detail) {
                                                $detail->delete();
                                            }
                                        }
                                        // Delete the current ExpenseList record
                                        $expenseItem->delete();
                                        }
                                    }
                                    // Finally, delete the Expense record
                                    $exp->delete();
                                }
                            }
                        }
                    }

                    $entity->setLeaveStatus(2);
                    $entity->save();

                    $title = "Leave Approved";
                    $message = "Your leave approved!";
                    $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                }
            }
            if ($_POST['LeaveStatus'] == 3) {

                $entity->setLeaveRejectRemark($_POST['note']);
                $entity->setLeaveStatus(3);
                $entity->save();
                if ($entity->getLeaveReqId() != null) {
                    // $pendingLeaveCount = \entities\EmployeeLeaveBalanceQuery::create()
                    //                         ->filterByEmployeeId($entity->getEmployeeId())
                    //                         ->filterByLeaveType($entity->getLeaveType())
                    //                         ->findOne();
                    $leaves = \entities\LeavesQuery::create()
                        ->filterByLeaveRequestId($entity->getLeaveReqId())
                        ->filterByLeavePoints(-1)
                        ->filterByLeaveType($entity->getLeaveType())
                        ->find();

                    if ($leaves != null) {
                        // $leaveIncre = \entities\LeavesQuery::create()
                        //                 ->filterByEmployeeId($entity->getEmployeeId())
                        //                 ->filterByLeaveType($entity->getLeaveType())
                        //                 ->filterByLeaveTranMode('Opening')
                        //                 ->findOne();
                        // if($leaveIncre != null){
                        //     $leavePo = $pendingLeaveCount->getBalance() + $leaves->count();
                        //     $leaveIncre->setLeavePoints($leavePo);
                        //     $leaveIncre->save();
                        // }
                    }
                    $leaves->delete();

                    $title = "Leave Rejected";
                    $message = "Your Leave Request have been Rejected!";
                    $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                }
            }
            if ($_POST['LeaveStatus'] == 4) {
                $entity = \entities\LeaveRequestQuery::create()->findPk($id);
                $entity->setLeaveStatus(4);
                $entity->save();
                if ($entity->getLeaveReqId() != null) {
                    // $pendingLeaveCount = \entities\EmployeeLeaveBalanceQuery::create()
                    //                         ->filterByEmployeeId($entity->getEmployeeId())
                    //                         ->filterByLeaveType($entity->getLeaveType())
                    //                         ->findOne();
                    $leaves = \entities\LeavesQuery::create()
                        ->filterByLeaveRequestId($entity->getLeaveReqId())
                        ->filterByLeavePoints(-1)
                        ->filterByLeaveType($entity->getLeaveType())
                        ->find();

                    if ($leaves != null) {
                        // $leaveIncre = \entities\LeavesQuery::create()
                        //                 ->filterByEmployeeId($entity->getEmployeeId())
                        //                 ->filterByLeaveType($entity->getLeaveType())
                        //                 ->filterByLeaveTranMode('Opening')
                        //                 ->findOne();
                        // if($leaveIncre != null){
                        //     $leavePo = $pendingLeaveCount->getBalance() + $leaves->count();
                        //     $leaveIncre->setLeavePoints($leavePo);
                        //     $leaveIncre->save();
                        // }
                    }
                    $leaves->delete();

                    $title = "Leave Cancelled";
                    $message = "Your Leave Request have been Cancelled!";
                    $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                }
            }
            $entity->fromArray($_POST);
            $entity->save();

            $wfManager = new \Modules\System\Processes\WorkflowManager();
            $wfManager->process($this->WfDoc, $entity, $this->app->Request()->getParameter("note", ""));

            $this->closeModalWithToast(self::statusMsg(1, $_POST['LeaveStatus']));
            return;
        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function single($id)
    {
        $this->data['pk'] = $id;
        $role =  $this->app->Auth()->getUser()->getRoles()->getRoleName();
        $leave = \entities\LeaveRequestQuery::create()
            ->filterByLeaveReqId($id)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findOne();
        $action = $this->app->Request()->getParameter("action", "");
        $this->data['leave'] = $leave;
        if (in_array($leave->getLeaveStatus(), [1, 2]) && $leave->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()) {
            $this->data['getleaveStatus'] = $leave->getLeaveStatus();
        }
        $leaveRequests = \entities\LeaveRequestQuery::create()
            ->filterByLeaveReqId($id)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findOne();
        $this->data['leave'] = $leaveRequests;
        $date1 = new DateTime($leaveRequests->getLeaveFrom()->format('Y-m-d')); // Replace with your first date
        $date2 = new DateTime($leaveRequests->getLeaveTo()->format('Y-m-d')); // Replace with your second date

        // Calculate the interval between the two dates
        $interval = $date1->diff($date2);
        //        var_dump($interval->days);exit;

        // Get the number of days from the interval
        $this->data['difference'] = $interval->days + 1;
        $this->data['leavesStatus'] = WorkflowManager::getStatusList("LeaveRequest");
        $this->data['leave_log'] = \Modules\System\Processes\WorkflowManager::getLog($this->WfDoc, $id, $leave->getLeaveStatus(), $this->app);
        //$this->data['leave_actions'] = \Modules\System\Processes\WorkflowManager::getActions($this->WfDoc, $id, $leave->getLeaveStatus(), $this->app, 2);
        $this->data['leaveType'] = $this->getConfig("ESS", "leaveType");
        $this->data['firstleaveSingleIntro'] = \Modules\System\Runtime\UserTriggers::checkOnce("firstleaveSingleIntro", $this->app->Auth()->getUser()->getUserId());
        $this->data['leave_actions'] = WorkflowManager::getActions($this->WfDoc, $id, $leaveRequests->getLeaveStatus(), $this->app);
        if ($leave->getLeaveStatus() == 2 && $role == 'NSM') {
            $this->data['leave_actions'] = '';
        }
        $this->app->Renderer()->render("ess/leaveSingle.twig", $this->data);
        if ($action == "approveLeave") {
            $leaveId = $this->app->Request()->getParameter("LeaveId", 0);
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $entity = \entities\LeaveRequestQuery::create()->findPk($leaveId);

            if ($entity) {
                $FromDate = $entity->getLeaveFrom();
                $ToDate = $entity->getLeaveTo();
                $pos_diff = $FromDate->diff($ToDate)->format("%r%a");
                $dates = EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));

                if (LeaveManager::leaveRequestExists($entity->getEmployeeId(), $FromDate, $ToDate)) {

                    $this->json(["status" => 0]);
                    return;
                }

                $empl = \entities\EmployeeQuery::create()->findPk($entity->getEmployeeId());
                $clearDates = [];
                $holidays = \entities\HolidaysQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId());
                $holidaydate = [];
                $stateId = $empl->getBranch()->getIstateid();

                foreach ($holidays as $holiday) {
                    if ($holiday->getIstateid() != null) {
                        $holidayState = explode(",", (string)$holiday->getIstateid());
                        if (in_array($stateId, $holidayState)) {
                            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                        }
                    }
                }
                foreach ($dates as $date) {
                    $day = $date;
                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);

                    if ($currentDate->format("N") == 7) // Sunday
                    {
                        continue;
                    }
                    if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                        continue;
                    }
                    $clearDates[] = $day;
                }
                $attenadances = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($employee->getEmployeeId())
                    ->filterByAttendanceDate($FromDate, Criteria::GREATER_EQUAL)
                    ->filterByAttendanceDate($ToDate, Criteria::LESS_EQUAL)
                    ->find()->toArray();

                if ($attenadances) {
                    foreach ($attenadances as $att) {
                        if ($att['Status'] == 0 || $att['Status'] == -1) {
                            $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                            $attenadance->setStatus(4);
                            $attenadance->setEndTime('00:00:00');
                            $attenadance->setRemark('Punch Leave');
                            $attenadance->save();
                        }
                        if ($att['Status'] == 1) {
                            $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                            $attenadance->setStatus(4);
                            $attenadance->setRemark('Punch Leave');
                            $attenadance->save();

                            $exp = \entities\ExpensesQuery::create()
                                ->filterByEmployeeId($att['EmployeeId'])
                                ->filterByExpenseDate($att['AttendanceDate'])
                                ->findOne();
                            if ($exp) {
                                $exp->setExpenseNote('Leave Approved');
                                $exp->save();
                            }
                        }
                    }
                }

                $entity->setLeaveStatus(2);
                $entity->save();

                for ($i = 0; $i <= $pos_diff; $i++) {
                    $leaveEntity = new \entities\Leaves();
                    $leaveEntity->setEmployeeId($entity->getEmployeeId());
                    $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                    $leaveEntity->setLeaveDate($clearDates[$i]);
                    $leaveEntity->setLeaveType($entity->getLeaveType());
                    $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                    $leaveEntity->setLeavePoints(-1);
                    $leaveEntity->setCompanyId($this->app->Auth()->CompanyId());
                    if ($leaveEntity->save()) {
                        $positionId = $entity->getEmployee()->getPositionId();
                        $mtpBlock = \entities\MtpDayQuery::create()
                            ->filterByMtpDayDate($clearDates[$i])
                            ->findOne();
                        if ($mtpBlock != null) {
                            // if mtp is nto appoved
                            $mtp = \entities\MtpQuery::create()
                                ->filterByMtpId($mtpBlock->getMtpId())
                                ->filterByPositionId($positionId)
                                ->filterByMtpStatus('approved', Criteria::NOT_EQUAL)
                                ->findOne();
                            if ($mtp != null) {
                                // Delete all Tourplan for that mtpday
                                $tourPlanDelete = \entities\TourplansQuery::create()
                                    ->filterByTpDate($clearDates[$i])
                                    ->filterByPositionId($positionId)
                                    ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                    ->delete();
                                // Delete mtp day
                                $mtpDay = \entities\MtpDayQuery::create()
                                    ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                    ->delete();
                                // run AGAIN Summary
                                $manager = new \BI\manager\MTPManager();
                                $mtp = $manager->getMTPById($mtp->getMtpId());
                            }
                            //MTP is approved
                            // chintan needs to ask sachin.
                        }
                    }
                }
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Approved", 0);
                $wfManager->process("LeaveRequest", $entity);

                $title = "Leave Approved";
                $message = "Your leave approved!";
                $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                $this->json(["status" => 1]);
                return;
            } else {
                $this->json(["status" => 0]);
                return;
            }
        }
        if ($action == "rejectLeave") {
            $this->data['form_name'] = "Reject Leave";
            $f = FormMgr::formHorizontal();
            $f->add([
                'LeaveReason' => FormMgr::text()->label('Reason *')->required(),
            ]);
            if ($this->app->isPost() && $f->validate()) {
                $leaveId = $this->app->Request()->getParameter("leaveid", 0);
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $leaveRemark = $_POST['LeaveReason'];

                $entity = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($leaveId)
                    ->findOne();
                $entity->setLeaveRejectRemark($leaveRemark);
                $entity->setLeaveStatus(3);
                $entity->save();

                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Rejected", 0);
                $wfManager->process("LeaveRequest", $entity);


                $title = "Leave Rejected";
                $message = "Your leave rejected!";
                $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                $this->closeModalWithToast(self::statusMsg(3, 'Rejected'));
                return;
            }
            $this->data['form'] = $f->html();
            $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
        }
        // if($action == 'cancelLeave'){
        //     $this->data['form_name'] = "Cancell Leave";
        //     $f = FormMgr::formHorizontal();
        //     $f->add([                        
        //         'LeaveReason' => FormMgr::text()->label('Reason *')->required(),                                
        //     ]);
        //      if($this->app->isPost() && $f->validate()){
        //         $leaveId = $this->app->Request()->getParameter("leaveid", 0);
        //         $entity = \entities\LeaveRequestQuery::create()
        //             ->filterByLeaveReqId($leaveId)
        //             ->findOne();
        //         $entity->setLeaveRejectRemark($leaveRemark);
        //         $entity->setLeaveStatus(4);
        //         $entity->save();

        //         $wfManager = new \Modules\System\Processes\WorkflowManager();
        //         $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Cancelled", 0);
        //         $wfManager->process("LeaveRequest", $entity);


        //         $title = "Leave Cancelled";
        //         $message = "Your leave cancelled!";
        //         $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(),$title,$message);

        //         $this->closeModalWithToast(self::statusMsg(4,'Cancelled'));
        //         return; 
        //      }
        //     $this->data['form'] = $f->html();
        //     $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
        // }
    }

    static function statusMsg($type, $status)
    {
        if ($type == 1) {
            switch ($status):
                case "0":
                    return "Leave Request Submitted successfully";
                    break;
                case "1":
                    return "Leave Request raised successfully";
                    break;
                case "2":
                    return "Leave Request approved successfully";
                    break;
                case "3":
                    return "Leave Request rejected successfully";
                    break;
                case "4":
                    return "Leave Request cancelled successfully";
                    break;
                case "5":
                    return "Leave Request closed successfully";
                    break;
            endswitch;
        }
    }

    public function quickleaveView($pk)
    {
        $leave = \entities\LeaveRequestQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($pk);
        $this->data['leave'] = $leave;
        if (in_array($leave->getleaveStatus(), [1, 2]) && $leave->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()) {
            $this->data['getleaveStatus'] = $leave->getleaveStatus();
        }
        $this->data['leave_actions'] = \Modules\System\Processes\WorkflowManager::getActions($this->WfDoc, $pk, $leave->getleaveStatus(), $this->app, 2);
        $this->app->Renderer()->render("ess/leaveQuickView.twig", $this->data);
    }

    public function employeeLeaves()
    {
        $this->data['title'] = "Employee Leaves";
        $this->data['form_name'] = "EmployeeLeaves";
        $this->data['cols'] = [
            "Employee Name" => "Employee.FirstName",
            "Leave Type" => "LeaveType",
            "Leave Points" => "LeavePoints",
            "Leave Transation" => "LeaveTranMode",
        ];

        $this->data['pk'] = "LeaveId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                // $this->json(["data" => \entities\LeavesQuery::create()
                //     ->joinWithEmployee()
                //     ->filterByLeaveRequestId(NULL)
                //     ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\LeavesQuery::create()
                    ->joinWithEmployee()
                    ->filterByLeaveRequestId(NULL)
                    ->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);

                break;
            case "form":
                $employees = \entities\EmployeeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                $empArray = [];
                foreach ($employees as $emp) {
                    $empArray[$emp->getPrimaryKey()] = $emp->getFirstName() . " " . $emp->getLastName();
                }

                $f = FormMgr::formHorizontal();
                $f->add([
                    'EmployeeId' => FormMgr::select()->options($empArray)->label('Employee *'),
                    'LeaveType' => FormMgr::select()->options($this->getConfig("ESS", "leaveType"))->label('Leave Type *')->required(),
                    'LeavePoints' => FormMgr::number()->label('Leave Points *')->required(),
                    'LeaveTranMode' => FormMgr::select()->options($this->getConfig("ESS", "leaveTranMod"))->label('Leave Transation *')->required(),
                ]);

                $leaves = new \entities\Leaves();

                $this->data['form_name'] = "Add Employee Leave";
                if ($pk > 0) {
                    $leaves = \entities\LeavesQuery::create()->findPk($pk);

                    $f->val($leaves->toArray());
                    $f['EmployeeId']->sudoValue($leaves->getEmployee()->getFirstName() . " " . $leaves->getEmployee()->getLastName());

                    $this->data['form_name'] = "Edit Employee Leave";
                }
                if ($this->app->isPost() && $f->validate()) {

                    $leaves->fromArray($_POST);
                    $leaves->setLeaveDate(date('Y-m-d'));
                    $leaves->setCompanyId($this->app->Auth()->CompanyId());
                    $leaves->setCreatedAt(date('Y-m-d H:i:s'));
                    $leaves->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }

                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function leaveConfiguration()
    {
        $this->data['title'] = "Leave Configuration";
        $this->data['form_name'] = "LeaveConfigurations";
        $this->data['cols'] = [
            "Name" => "Name",
            "LeaveType" => "LeaveType",
            "PolicyYear" => "PolicyYear",
            "ApplyDate" => "ApplyDate",
            "LeavePoints" => "LeavePoints",
            "IsActive" => "IsActive",
            "Orgunitids" => "Orgunitids",
        ];

        $this->data['pk'] = "Id";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\LeaveConfigurationsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter');
                $count = $query->count();
                $response["recordsTotal"] = $count ?? 0;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    // $query = $query->filterByTerritoryName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count ?? 0;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $grade = \entities\GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName");
                $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");

                $f->add([
                    'Name' => FormMgr::text()->label('Name *')->class("text-uppercase")->required()->minlength(2)->pattern(__NOSPACE_PATERN),
                    'GradeId' => FormMgr::select()->options($grade)->label('Grade')->id("grade"),
                    'PolicyYear' => FormMgr::text()->label('Policy Year *')->required()->class('datepicker'),
                    'LeaveType' => FormMgr::select()->options($this->getConfig("ESS", "leaveType"))->label('Leave Type *')->required(),
                    'LeavePoints' => FormMgr::number()->label('Leave Points *')->required(),
                    'ApplyDate' => FormMgr::text()->label('Apply Date *')->required()->class('datepicker'),
                    'Orgunitids' => FormMgr::select()->options($OrgUnitId)->label('Org Unit')->class("multi-select")->multiple("multiple")->required(),
                    'IsActive' => FormMgr::checkbox()->label('Is active?'),
                ]);
                $entity = new \entities\LeaveConfigurations();

                if ($pk > 0) {
                    $this->data['form_name'] = "Edit Configuration";
                    $entity = \entities\LeaveConfigurationsQuery::create()->findPk($pk);
                    $f->val($entity->toArray());

                    $f["Orgunitids"]->val(explode(",", $entity->getOrgunitids()));
                    $f['ApplyDate']->val($entity->getApplyDate("d/m/Y"));
                }


                if ($this->app->isPost() && $f->validate()) {
                    $data = $_POST;
                    $data['PolicyYear'] = date('Y', strtotime($data['PolicyYear']));
                    $data['Orgunitids'] = implode(',', $data['Orgunitids']);
                    $entity->fromArray($data);
                    $entity->setCompanyId($this->app->Auth()->CompanyId());
                    $entity->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function leaveTypes()
    {
        $this->data['title'] = "Leave Types";
        $this->data['form_name'] = "LeaveType";
        $this->data['cols'] = [
            "LeaveType" => "LeaveType",
            "ShortCode" => "ShortCode",
        ];

        $this->data['pk'] = "LeaveTypeId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\LeaveTypeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);

                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    "LeaveType" => FormMgr::text()->label("Leave Type*")->id("LeaveType")->required(),
                    "ShortCode" => FormMgr::text()->label("Leave Short Code*")->id("LeaveShortCode")->required(),
                ]);

                $leaveType = new \entities\LeaveType();

                $this->data['form_name'] = "Add Leave Type";
                if ($pk > 0) {
                    $leaveType = \entities\LeaveTypeQuery::create()->findPk($pk);

                    $f->val($leaveType->toArray());

                    $this->data['form_name'] = "Edit Leave Type";
                }
                if ($this->app->isPost() && $f->validate()) {

                    $leaveType->fromArray($_POST);
                    $leaveType->setCompanyId($this->app->Auth()->CompanyId());
                    $leaveType->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }

                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }
}

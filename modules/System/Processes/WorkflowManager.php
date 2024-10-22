<?php

declare(strict_types=1);

namespace Modules\System\Processes;

use App\System\App;
use App\Utils\FormMgr;
use entities\Employee;
use BI\manager\NotificationManager;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Aws\S3\S3Client;

class WorkflowManager extends \App\Core\Process
{

    protected $app;
    private $WfDoc = "Expenses";
    private $logger;

    function __construct()
    {
        $this->logger = new \Monolog\Logger(_SESSIONKEY);
        $this->logger->pushHandler(
            new \Monolog\Handler\StreamHandler(__DIR__ . "/../../../log/appLog.log")
        );
    }

    public function process($docname, ActiveRecordInterface $entity, $note = "")
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $master = \entities\WfMasterQuery::create()->findPk($document->getWfId());
        $status_id = $entity->getByName($document->getWfStatusKey());
        $employee = \entities\EmployeeQuery::create()->findPk($entity->getByName('EmployeeId'));
        $status = \entities\WfStatusQuery::create()
            ->filterByWfStatusId($status_id)
            ->filterByWfMaster($master)
            ->find()->getFirst();
        $steps = \entities\WfStepsQuery::create()->findByWfId($document->getWfId());
        $pendingRequests = \entities\WfRequestsQuery::create()
            ->filterByWfDocuments($document)
            ->filterByWfDocPk($entity->getByName($document->getWfPkName()))
            ->filterByWfReqStatus(0)
            ->find();
        foreach ($pendingRequests as $req) {
            $req->setWfReqStatus(1); // Gone Void
            $req->save();
        }
        $noNextAction = true;
        //$notification = new \App\Utils\Notifications(\App\Abstracts\NotificationType::URLRedirect, "", []);
        $notiMgr = new NotificationManager();
        foreach ($steps as $step) {
            $inStatus = explode(",", $step->getWfInStatus());
            $escalationDate = strtotime("+7 day", strtotime(date("Y-m-d")));
            if (in_array($status_id, $inStatus)) {
                $actionTo = $this->getEmployeeLevelUp($employee, $step->getRequestUp());
                $request = new \entities\WfRequests();
                $request->setWfMaster($master);
                $request->setWfDocuments($document);
                $request->setWfDocPk($entity->getByName($document->getWfPkName()));
                $request->setWfDocStatus($status_id);
                $request->setWfEntityName($docname);
                $request->setWfOriginEmployee($employee->getPrimaryKey());
                $request->setWfStepId($step->getPrimaryKey());
                $request->setWfStepLevel($step->getWfStepLevel());
                $request->setWfReqStatus(0);
                $request->setWfReqEmployee($actionTo->getPrimaryKey());
                $request->setWfDesc($step->getWfRequestDesc());
                $request->setWfRoute($document->getWfActionRoute());
                $request->setWfCompanyId($employee->getCompanyId());
                $request->setWfEscalationDate($escalationDate);
                $request->save();
                $this->createLog($docname, $entity, $actionTo, 0, $step->getWfRequestDesc() . " :: " . $note, $request->getPrimaryKey());
                $noNextAction = false;
                if ($step->getWfStepLevel() == 1) {
                    $msg = $employee->getFirstName() . ": " . $step->getWfRequestDesc() . " in " . $docname;
                } else {
                    $msg = "Your " . $docname . " have been " . $status->getWfStatusName();
                }
                $user = \entities\UsersQuery::create()->findByEmployeeId($actionTo->getEmployeeId());
                // If User exists and Step has Notification enabled
                if ($user && $step->getNotificationStatus() == 1) {

                    $notiMgr->sendNotificationToEmployee($actionTo->getEmployeeId(), $msg, $msg, $request->toArray());

                    // $url = \App\Utils\Router::getNoCheckRoute($document->getWfActionRoute(), ["id" => $entity->getByName($document->getWfPkName())]);
                    // $notification->setMessage($msg);
                    // $notification->setData($request->toArray());
                    // $notification->setRedirectUrl($url);
                    // foreach ($user as $u) {
                    //     //$notification->setFCMToken($u->getFcmToken());                    
                    //     //$a = $notification->sendFCMNotification();        
                    //     //$this->logger->addRecord(1,$a,$notification->toArray());
                    // }
                }
                $email = $actionTo->getEmail();
                if ($email != "") {
                    $body = "--";
                    //\App\Utils\Emails::sendEmail($email, $employee->getFirstName()." has ".$step->getWfRequestDesc()." a ".$docname, $body);
                }
            }
        }
        if ($noNextAction) {
            $this->createLog($docname, $entity, $employee, 0, $note, 0);

            $msg = "Your " . $docname . " have been " . $status->getWfStatusName();
            $notiMgr->sendNotificationToEmployee($employee->getEmployeeId(), $msg, $msg, $entity->toArray());


            //$user = $employee->getUserss();
            // if ($user) {
            //     $notification->setMessage("Your " . $docname . " have been " . $status->getWfStatusName());
            //     $notification->setData($entity->toArray());
            //     $notification->setRedirectUrl($docname);
            //     foreach ($user as $u) {
            //         $notification->setFCMToken($u->getFcmToken());
            //         $a = $notification->sendFCMNotification();
            //         //$this->logger->addInfo($a,$notification->toArray());
            //     }
            // }
        }
    }

    static function createLog($docname, ActiveRecordInterface $entity, Employee $currentEmp, $oldStatus, $note, $wf_request_id)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $status_id = $entity->getByName($document->getWfStatusKey());
        $status = \entities\WfStatusQuery::create()
            ->filterByWfStatusId($status_id)
            ->filterByWfMaster($document->getWfMaster())
            ->find()->getFirst();
        $log = new \entities\WfLog();
        $log->setWfDocuments($document);
        $log->setWfDocPk($entity->getByName($document->getWfPkName()));
        $log->setWfStatusId($status_id);
        //$log->setWfLevel($status->getWfLevel());
        $log->setWfOldStatusId($oldStatus);
        $log->setWfEmployeeId($currentEmp->getPrimaryKey());
        $log->setWfTitle($status->getWfStatusName());
        $log->setWfNote($note);
        $log->setWfRequestId($wf_request_id);
        $log->save();
    }

    public function getEmployeeLevelUp(Employee $employee, $level)
    {
        if ($level == 0) { // Same Level
            return $employee;
        } else {
            $position = \entities\PositionsQuery::create()
                    ->filterByPositionId($employee->getPositionId())
                    ->findOne();
                    
            $cavUpPositions = explode(',',$position->getCavPositionsUp());
            
            if(count($cavUpPositions) > 0){
                foreach($cavUpPositions as $cavUpPosition){
                    if($cavUpPosition != null && $cavUpPosition != ''){
                        $emp = \entities\EmployeeQuery::create()
                                ->filterByPositionId($cavUpPosition)
                                ->findOne();
                        if($emp == null && $emp == ''){
                            continue;
                        }else{
                            return $this->climbUpPositions($emp->getPositionId(), $level, $employee->getCompanyId());
                        }
                    }else{
                        $emp = \entities\EmployeeQuery::create()
                                ->filterByPositionId($employee->getOrgUnit()->getOrgunitAdminPosition())
                                ->findOne();
                        return $this->climbUpPositions($emp->getPositionId(), $level, $employee->getCompanyId());
                    }
                }
            }else{
                $emp = \entities\EmployeeQuery::create()
                                ->filterByPositionId($employee->getOrgUnit()->getOrgunitAdminPosition())
                                ->findOne();
                return $this->climbUpPositions($emp->getPositionId(), $level, $employee->getCompanyId());
            }   

            // if ($employee->getReportingTo() == null && $employee->getReportingTo() == '') {
            //         $position = \entities\PositionsQuery::create()
            //                         ->filterByPositionId($employee->getPositionId())
            //                         ->findOne();
            //         if($position->getReportingTo() == null){
            //             return $this->climbUpPositions($position->getPositionId(), $level, $employee->getCompanyId());
            //         }else{
            //             return $this->climbUpPositions($position->getReportingTo(), $level, $employee->getCompanyId());
            //         }
            // } else {
            //     return $this->climbUpPositions($employee->getReportingTo(), $level, $employee->getCompanyId());
            // }
        }
    }

    private function climbUpPositions($position_id, $level_default, $company_id): \entities\Employee
    {
        $level = 1;
        $employee = false;
        while (!$employee) {
            if ($position_id == 0 || $position_id == '') {
                throw (new \Exception("Reached Top !!"));
            } else {
                $employee = \entities\EmployeeQuery::create()
                    ->filterByStatus(1)
                    ->filterByPositionId($position_id)
                    ->findByCompanyId($company_id)->getFirst();
                if ($employee && $level_default <= $level) {
                    continue;
                } else {
                    $employee = false;
                    $level = $level + 1;
                    $position_id = \entities\PositionsQuery::create()->findPk($position_id)->getReportingTo();
                }
            }
        }
        return $employee;
    }

    static public function getLog($docname, $pk, $current_status, \App\System\App $app)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $status = \entities\WfStatusQuery::create()
            ->filterByWfId($document->getWfId())
            ->findByWfStatusId($current_status)->getFirst();
        $log = \entities\WfLogQuery::create()
            ->filterByWfDocuments($document)
            ->filterByWfDocPk($pk)
            ->joinWithEmployee()
            ->orderByCreatedAt(\Propel\Runtime\ActiveQuery\Criteria::DESC)
            ->find();
        return $app->Renderer()->render("system/wfLogWidget.twig", ["logs" => $log, "status" => $status], false);
    }

    static public function getLogData($docname, $pk)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $log = \entities\WfLogQuery::create()
            ->filterByWfDocuments($document)
            ->filterByWfDocPk($pk)
            ->joinWithEmployee()
            ->orderByCreatedAt(\Propel\Runtime\ActiveQuery\Criteria::DESC)
            ->find();
        return $log;
    }

    static public function getActions($docname, $pk, $current_status, \App\System\App $app, $type = 1)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $actions = \entities\WfRequestsQuery::create()
            ->filterByWfDocuments($document)
            ->filterByWfDocPk($pk)
            ->filterByEmployee($app->Auth()->getUser()->getEmployee())
            ->filterByWfReqStatus(0)
            ->joinWithWfSteps()
            ->find();
        $actButtons = [];
        $cancelbtn = FALSE;

        if ($app->Auth()->getUser()->getRoles()->getRoleName() == 'Admin') {
            $wfStep = \entities\WfStepsQuery::create()
                ->filterByWfId(1)
                ->findOne();
            $actButtons[8] = $wfStep;
        } else {
            foreach ($actions as $action) {
                $inStatus = explode(",", $action->getWfSteps()->getWfInStatus());
                if (in_array($current_status, $inStatus)) {
                    $actButtons[$action->getWfSteps()->getPrimaryKey()] = $action->getWfSteps();
                }
            }
        }

        if ($docname == "LeaveRequest") {
            //$cancelbtn = TRUE;
        }
        if ($type == 3) {
            return $actButtons;
        } else {
            return $app->Renderer()->render("system/wfNextActions.twig", ["steps" => $actButtons, "pk" => $pk, "stepRoute" => $document->getWfStepsRoute(), "type" => $type, "cancelbtn" => $cancelbtn], false);
        }
    }

    static public function getCurrentLevel($docname, $pk, $current_status, \App\System\App $app)
    {
        $action = WorkflowManager::getActions($docname, $pk, $current_status, $app, 3);
        $level = -1;
        foreach ($action as $k => $v) {
            if ($level < $v->getWfStepLevel()) {
                $level = $v->getWfStepLevel();
            }
        }
        return $level;
    }

    static public function getStatusList($docname, $matching = null)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $status = \entities\WfStatusQuery::create()
            ->findByWfId($document->getWfId())
            ->toKeyValue("WfStatusId", "WfStatusName");
        if ($matching == null) {
            return $status;
        } else {
            $newStatus = [];
            $match = explode(",", $matching);
            foreach ($status as $stat => $desc) {
                if (in_array($stat, $match)) {
                    $newStatus[$stat] = $desc;
                }
            }
            return $newStatus;
        }
    }


    static public function getPendingRequestPks($docname, \App\System\App $app)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $actions = \entities\WfRequestsQuery::create()
            ->filterByWfDocuments($document)
            ->filterByEmployee($app->Auth()->getUser()->getEmployee())
            ->filterByWfReqStatus(0)
            ->find();
        $pks = [];
        foreach ($actions as $action) {
            array_push($pks, $action->getWfDocPk());
        }
        return $pks;
    }

    static public function getPendingData($docname, \App\System\App $app)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $actions = \entities\WfRequestsQuery::create()
            ->filterByWfDocuments($document)
            ->filterByEmployee($app->Auth()->getUser()->getEmployee())
            ->find();
        $pks = [];
        foreach ($actions as $action) {
            array_push($pks, $action->getWfDocPk());
        }
        return $pks;
    }

    static public function getNotifications($employee, $sortBy = 0, $filterBy = null)
    {
        $month = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        $actions = [];
        $actions = \entities\WfRequestsQuery::create()
            ->filterByWfReqEmployee($employee->getEmployeeId())
            ->filterByCreatedAt($month['SMstartDate'] . " 00:00:00", \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($month['EMendDate'] . " 23:59:59", \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByWfReqStatus(0)
            ->filterByWfStepLevel(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
            ->joinWithEmployee();
        if ($sortBy == 0) {
            $actions->orderByCreatedAt(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            $actions->filterByWfEntityName($filterBy . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE);
        } else if ($sortBy == 1) {
            $actions->orderByWfEntityName(\Propel\Runtime\ActiveQuery\Criteria::ASC);
            $actions->filterByWfEntityName($filterBy . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE);
        } else if ($sortBy == 2) {
            $actions->orderByWfEntityName(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            $actions->filterByWfEntityName($filterBy . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE);
        } else if ($sortBy == 3) {
            $actions->orderByCreatedAt(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            $actions->filterByWfEntityName($filterBy . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE);
        }
        $actions->find();
        if ($actions) {
            $origins = [];
            $stackFile = [];
            $result = [];
            foreach ($actions as $a) {
                $key = $a->getWfOriginEmployee() . "|" . $a->getWfDocId();
                if (!in_array($key, $stackFile)) {
                    array_push($stackFile, $key);
                    array_push($origins, $a->getWfOriginEmployee());
                    array_push($result, $a);
                }
            }
            //$emps = \entities\EmployeeQuery::create()->findPks(implode(",", $origins))->toKeyIndex();                        
            $emps = \entities\EmployeeQuery::create()->findPks($origins)->toKeyIndex();

            return ["actions" => $result, "emps" => $emps];
        } else {
            return ["actions" => [], "emps" => []];
        }
    }

    public function deleteEntity($docname, ActiveRecordInterface $entity)
    {
        $document = \entities\WfDocumentsQuery::create()->findByWfDocName($docname)->getFirst();
        $pendingRequests = \entities\WfRequestsQuery::create()
            ->filterByWfDocuments($document)
            ->filterByWfDocPk($entity->getByName($document->getWfPkName()))
            ->filterByWfReqStatus(0)
            ->find();
        $pendingRequests->delete();
        //$this->logger->addWarning("Deleted",$entity->toArray());
    }

    ///////////s3 initialization////////////////
    static public function initializeS3Client()
    { 
        return new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'endpoint' => $_ENV['STACKHERO_MINIO_HOST'],
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => $_ENV['STACKHERO_MINIO_ROOT_ACCESS_KEY'],
                'secret' => $_ENV['STACKHERO_MINIO_ROOT_SECRET_KEY'],
            ],
            'http' => [
                'verify' => false,
            ],
        ]);
    }

}

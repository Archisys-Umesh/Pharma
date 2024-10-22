<?php declare(strict_types = 1);

namespace Modules\System\Processes;

use entities\UsersQuery;
use entities\EmployeeQuery;
use entities\Notifications;
use entities\NotificationsQuery;
use entities\NotificationTemplatesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Respect\Validation\Rules\LessThan;

class Notification implements \Modules\System\Interfaces\Notification 
{
    private $emailConstants, $smsConstants, $pushConstants, $pushNotificationData, $ccEmployeeIds;
    private $sentEmail, $sentPush, $sentSms;
    private $schduleDateTime, $templateKey, $toEmployeeId, $companyId;
    private $maxAllowedEmailAttempts, $maxAllowedSmsAttempts, $maxAllowedPushAttempts;

    public function __construct() {
        $this->emailConstants = $this->smsConstants = $this->pushConstants = $this->pushNotificationData = $this->ccEmployeeIds = [];
        $this->sentEmail = $this->sentPush = $this->sentSms = false;
        $this->templateKey = '';
        $this->toEmployeeId = 1;
        $this->schduleDateTime = date('Y-m-d H:i:s');
        $this->companyId = 1;
        $this->maxAllowedEmailAttempts = $this->maxAllowedSmsAttempts = $this->maxAllowedPushAttempts = 3;
    }

    public function sendNotification() {
        $data = [
            'emailConstants' => $this->emailConstants,
            'smsConstants' => $this->smsConstants,
            'pushConstants' => $this->pushConstants,
            'pushNotificationData' => $this->pushNotificationData
        ];

        $scheduleNotification = new Notifications;
        $scheduleNotification->setToEmployeeId($this->toEmployeeId);
        $scheduleNotification->setCcEmployeeIds(implode(',', $this->ccEmployeeIds));
        $scheduleNotification->setTemplateKey($this->templateKey);
        $scheduleNotification->setDataDump(json_encode($data));
        $scheduleNotification->setSendEmail($this->sentEmail);
        $scheduleNotification->setSendPush($this->sentPush);
        $scheduleNotification->setSendSms($this->sentSms);
        $scheduleNotification->setScheduleAt($this->schduleDateTime);
        $scheduleNotification->setCompanyId($this->companyId);
        $scheduleNotification->setEmailSentAttempts(0);
        $scheduleNotification->setSmsSentAttempts(0);
        $scheduleNotification->setPushSentAttempts(0);
        $scheduleNotification->save();
    }

    public function setEmailConstants($constants) {
        $this->emailConstants = $constants;
    }

    public function setSmsConstants($constants) {
        $this->smsConstants = $constants;
    }

    public function setPushConstants($constants) {
        $this->pushConstants = $constants;
    }

    public function setPushNotificationData($data) {
        $this->pushNotificationData = $data;
    }

    public function setEmailSent($sent) {
        $this->sentEmail = $sent;
    }

    public function setSmsSent($sent) {
        $this->sentSms = $sent;
    }

    public function setPushSent($sent) {
        $this->sentPush = $sent;
    }

    public function setSchduleDateTime($dateTime) {
        $this->schduleDateTime = $dateTime;
    }

    public function setTemplateKey($key) {
        $this->templateKey = $key;
    }

    public function setCcEmployeeIds($employeeIds) {
        $this->ccEmployeeIds = $employeeIds;
    }

    public function setToEmployeeId($employeeId) {
        $this->toEmployeeId = $employeeId;
    }

    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
    }

    public function getEmailNotifications() {
        return NotificationsQuery::create()
                ->filterBySendEmail(true)
                ->filterByEmailSentStatus(false)
                ->filterByScheduleAt(date('Y-m-d H:i:s'), Criteria::LESS_EQUAL)
                ->filterByEmailSentAttempts($this->maxAllowedEmailAttempts, Criteria::LESS_THAN)
                ->find();
    }

    public function getSmsNotifications() {
        return NotificationsQuery::create()
                ->filterBySendSms(true)
                ->filterBySmsSentStatus(false)
                ->filterByScheduleAt(date('Y-m-d H:i:s'), Criteria::LESS_EQUAL)
                ->filterBySmsSentAttempts($this->maxAllowedSmsAttempts, Criteria::LESS_THAN)
                ->find();
    }

    public function getPushNotifications() {
        return NotificationsQuery::create()
                ->filterBySendPush(true)
                ->filterByPushSentStatus(false)
                ->filterByScheduleAt(date('Y-m-d H:i:s'), Criteria::LESS_EQUAL)
                ->filterByPushSentAttempts($this->maxAllowedPushAttempts, Criteria::LESS_THAN)
                ->find();
    }

    public function getTemplate($key) {
        return NotificationTemplatesQuery::create()
                    ->filterByTemplateKey($key)
                    ->findOne();
    }

    public function getToEmployeeColumn($toEmployeeId, $column) {
        return EmployeeQuery::create()
                ->filterByEmployeeId($toEmployeeId)
                ->select($column)
                ->findOne();
    }

    public function getCcEmailAddresses($ccEmployeeIds) {
        $ccEmails = [];

        if (!empty($ccEmployeeIds)) {
            $ccEmployeeIds = explode(',', $ccEmployeeIds);
            if (count($ccEmployeeIds)) {
                $ccEmails = EmployeeQuery::create()
                                ->filterByEmployeeId($ccEmployeeIds)
                                ->select('Email')
                                ->find()
                                ->toArray();
            }
        }

        return $ccEmails;
    }

    public function getToEmployeeFcmTokens($toEmployeeId) {
        $user = UsersQuery::create()->filterByEmployeeId($toEmployeeId)->findOne();
        $userSessions = [];
        if (!empty($user)) {
            $userSessions = \entities\UserSessionsQuery::create()
                                ->select('FcmToken')
                                ->filterByUserId($user->getUserId())
                                ->filterByFcmToken(null,Criteria::NOT_EQUAL)
                                ->find()
                                ->toArray();
        }

        return $userSessions;
    }

    public function recordEmailResponse($notification, $response) {
        $notification->setEmailSentAttempts($notification->getEmailSentAttempts() + 1);
        $notification->setEmailSentDatetime(date('Y-m-d H:i:s'));
        $notification->setEmailSentStatus($response['isSent']);
        $notification->setEmailTransId($response['isSent'] ? $response['transactionId'] : null);
        $notification->save();
    }

    public function recordSmsResponse($notification, $response) {
        $notification->setSmsSentAttempts($notification->getSmsSentAttempts() + 1);
        $notification->setSmsSentDatetime(date('Y-m-d H:i:s'));
        $notification->setSmsSentStatus($response['isSent']);
        $notification->setSmsTransId($response['isSent'] ? $response['transactionId'] : null);
        $notification->save();
    }

    public function recordPushResponse($notification, $response) {
        $notification->setPushSentAttempts($notification->getPushSentAttempts() + 1);
        $notification->setPushSentDatetime(date('Y-m-d H:i:s'));
        $notification->setPushSentStatus($response['isSent']);
        $notification->setPushTransId($response['isSent'] ? $response['transactionId'] : null);
        $notification->save();
    }

    public function getPushDataDump($notification) {
        $pushData = [];

        $data = $notification->getDataDump();
        if (!empty($data)) {
            $data = json_decode($data, true);
            $pushData = (isset($data['pushNotificationData']) ? $data['pushNotificationData'] : []);
        }

        return $pushData;
    }

    public function getFilteredText($data, $type, $text) {
        $constantData = [];

        if (!empty($data)) {
            $data = json_decode($data, true);

            if ($type == 'email') {
                $constantData = (isset($data['emailConstants']) ? $data['emailConstants'] : []);
                if (str_contains($text, '.twig')) {
                    $loader = new \Twig\Loader\FilesystemLoader();
                    $loader->addPath(dirname(__DIR__) . '/../../templates');
                    $twig = new \Twig\Environment($loader);
                    return $twig->render($text, $constantData);
                }
            } elseif ($type == 'sms') {
                $constantData = (isset($data['smsConstants']) ? $data['smsConstants'] : []);
            } elseif ($type == 'push') {
                $constantData = (isset($data['pushConstants']) ? $data['pushConstants'] : []);
            }

            if (count($constantData) > 0) {
                foreach ($constantData as $key => $value) {
                    if (gettype($key) == gettype($value)) {
                        $text = str_replace($key, $value, $text);
                    }
                }
            }
        }

        return $text;
    }
}
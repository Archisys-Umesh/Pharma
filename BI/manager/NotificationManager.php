<?php

namespace BI\manager;

use App\Utils\Emails;
use App\Utils\SendSms;
use entities\UsersQuery;
use entities\EmployeeQuery;
use entities\PositionsQuery;
use App\Utils\OneSignalNotification;
use entities\EmailNotificationsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Processes\Notification;
/**
 * Description of Notification Manager
 *
 * @author archisys8
 */
class NotificationManager 
{
    use \App\Traits\AdminNotifications;

    static function sendNotificationToEmployee($employeeId,$title, $message,$data=[]){
        $user = UsersQuery::create()->filterByEmployeeId($employeeId)->findOne();
        if($user != null && $user != ''){
            $userSessions = \entities\UserSessionsQuery::create()
                ->filterByUserId($user->getUserId())
                ->filterByFcmToken(null,Criteria::NOT_EQUAL)
                ->find(); 
            if($userSessions != null && !empty($userSessions)){
                $UserSessionTokens = array();
                foreach($userSessions as $userSession){
                    if($userSession->getFcmToken() != 'null'){
                        array_push($UserSessionTokens,$userSession->getFcmToken());
                    }
                }            
            \App\Utils\OneSignalNotification::sendnotification($UserSessionTokens, $title, $message,$data);
            }
        } 
    }

    static function sendNotificationToUser($userId,$title, $message,$data=[]){
        $userSessions = \entities\UserSessionsQuery::create()
                            ->filterByUserId($userId)
                            ->find(); 
        if(!empty($userSessions)){
            $UserSessionTokens = array();
            foreach($userSessions as $userSession){
                if($userSession->getFcmToken() != 'null'){
                    array_push($UserSessionTokens,$userSession->getFcmToken());
                }
            }
            \App\Utils\OneSignalNotification::sendnotification($UserSessionTokens, $title, $message,$data=[]);
        } 
    }

    static function sendNotificationToPosition($positionId,$title, $message,$data=[]){
        $employees = EmployeeQuery::create()->filterByPositionId($positionId)
                                ->filterByStatus(1)
                                ->find();
        if(!empty($employees)){
            $employeeIds = [];
            foreach($employees as $emp){
                array_push($employeeIds,$emp->getEmployeeId());
            }
            $userIds = [];
            foreach($employeeIds as $employeeId){
                $user = UsersQuery::create()->filterByEmployeeId($employeeId)->findOne();
                array_push($userIds,$user->getUserId());
            }
            $userSessions = \entities\UserSessionsQuery::create()
                            ->filterByUserId($userIds)
                            ->find(); 
            if(!empty($userSessions)){
                $UserSessionTokens = array();
                foreach($userSessions as $userSession){
                    if($userSession->getFcmToken() != 'null'){
                        array_push($UserSessionTokens,$userSession->getFcmToken());
                    }
                }
                \App\Utils\OneSignalNotification::sendnotification($UserSessionTokens, $title, $message,$data=[]);
            }
        }  
    }

    public function sendScheduledNotifications() {
        // $this->sendTestNotification();
        // set_time_limit(0);
        // while (true) {
            echo "Checking for new notifications... : Start" . PHP_EOL;
            $this->checkForEmailNotifications();
            $this->checkForSmsNotifications();
            $this->checkForPushNotifications();
            $this->checkForAdminScheduleNotification();
            $this->checkForAdminEmailNotification();
            echo "Checking for new notifications... : Done" . PHP_EOL;
            // sleep(60);
        // }
    }

    private function checkForEmailNotifications() {
        echo "Checking for email notifications... : Start" . PHP_EOL;

        $manager = new Notification;
        $notifications = $manager->getEmailNotifications();

        foreach($notifications as $notification) {
            echo "Found Email notification... : " . $notification->getPrimaryKey() . PHP_EOL;

            $to = $manager->getToEmployeeColumn($notification->getToEmployeeId(), 'Email');

            if (!empty($to)) {
                $template = $manager->getTemplate($notification->getTemplateKey());

                if (!empty($template)) {
                    $subject = $manager->getFilteredText($notification->getDataDump(), 'email', $template->getEmailSubject());
                    $body = $manager->getFilteredText($notification->getDataDump(), 'email', $template->getEmailBody());
                    $ccEmails = $manager->getCcEmailAddresses($notification->getCcEmployeeIds());

                    $response = Emails::sendNotificationEmail($to, $subject, $body, $ccEmails);
                    $manager->recordEmailResponse($notification, $response);

                    if ($response['isSent'] == false) {
                        echo "Mail sending failed : " . $response['errorMessage'] . PHP_EOL;
                    }
                }
            }
        }

        echo "Checking for email notifications... : End" . PHP_EOL;
    }

    private function checkForSmsNotifications() {
        echo "Checking for sms notifications... : Start" . PHP_EOL;

        $manager = new Notification;
        $notifications = $manager->getSmsNotifications();

        foreach($notifications as $notification) {
            echo "Found SMS notification... : " . $notification->getPrimaryKey() . PHP_EOL;

            $to = $manager->getToEmployeeColumn($notification->getToEmployeeId(), 'Phone');

            if (!empty($to)) {
                $template = $manager->getTemplate($notification->getTemplateKey());

                if (!empty($template)) {
                    $message = $manager->getFilteredText($notification->getDataDump(), 'sms', $template->getSmsMessage());
                    $type = $template->getSmsType();
                    $dlr = $template->getSmsDlr();

                    $response = SendSms::sendRmlNotificationMessage($to, $type, $dlr, $message);
                    $manager->recordSmsResponse($notification, $response);

                    if ($response['isSent'] == false) {
                        echo "SMS sending failed : " . $response['errorMessage'] . PHP_EOL;
                    }
                } else {
                    echo "Template not found..." . PHP_EOL;
                }
            } else {
                echo "Phone number not found..." . PHP_EOL;
            }
        }

        echo "Checking for sms notifications... : End" . PHP_EOL;
    }

    private function checkForPushNotifications() {
        echo "Checking for push notifications... : Start" . PHP_EOL;

        $manager = new Notification;
        $notifications = $manager->getPushNotifications();

        foreach($notifications as $notification) {
            echo "Found Push notification... : " . $notification->getPrimaryKey() . PHP_EOL;

            $to = $manager->getToEmployeeFcmTokens($notification->getToEmployeeId());

            if (!empty($to)) {
                $template = $manager->getTemplate($notification->getTemplateKey());

                if (!empty($template)) {
                    $message = $manager->getFilteredText($notification->getDataDump(), 'push', $template->getPushMessage());
                    $title = $manager->getFilteredText($notification->getDataDump(), 'push', $template->getPushTitle());
                    $data = $manager->getPushDataDump($notification);

                    $response = OneSignalNotification::sendNotificationPush($to, $title, $message, $data);
                    $manager->recordPushResponse($notification, $response);

                    if ($response['isSent'] == false) {
                        echo "Push sending failed : " . $response['errorMessage'] . PHP_EOL;
                    }
                } else {
                    echo "Push sending failed : Template not found" . PHP_EOL;
                    $response = ['isSent' => false];
                    $manager->recordPushResponse($notification, $response);
                }
            } else {
                echo "Push sending failed : FCM Token not found" . PHP_EOL;
                $response = ['isSent' => false];
                $manager->recordPushResponse($notification, $response);
            }
        }

        echo "Checking for push notifications... : End" . PHP_EOL;
    }

    private function checkForAdminEmailNotification() {
        echo "Checking for admin email notifications... : Start" . PHP_EOL;

        $notifications = EmailNotificationsQuery::create()
                            ->filterByEmailSentStatus(false)
                            ->filterByScheduleAt(date('Y-m-d H:i:s'), Criteria::LESS_EQUAL)
                            ->filterByEmailSentAttempts(4, Criteria::LESS_THAN)
                            ->find();
        
        foreach ($notifications as $notification) {
            $toEmails = array_unique(explode(',', $notification->getToEmails()));
            $ccEmails = array_unique(explode(',', $notification->getCcEmails()));
            $subject = $notification->getEmailSubject();
            $body = $notification->getEmailBody();
            $emailConstats = $notification->getEmailConstants();

            if (!empty($emailConstats)) {
                $emailData = json_encode(['emailConstants' => json_decode($emailConstats, true)]);
            } else {
                $emailData = null;
            }

            $manager = new Notification;
            $subject = $manager->getFilteredText($emailData, 'email', $subject);
            $body = $manager->getFilteredText($emailData, 'email', $body);

            $response = Emails::sendNotificationEmail($toEmails, $subject, $body, $ccEmails);
            $manager->recordEmailResponse($notification, $response);
        }

        echo "Checking for admin email notifications... : End" . PHP_EOL;
    }

    private function sendTestNotification() {
        $notification = new \Modules\System\Processes\Notification;
        $notification->setEmailConstants(['{{USERNAME}}' => 'Chirag Patel']);
        $notification->setSmsConstants(['{{USERNAME}}' => 'Chirag Patel']);
        $notification->setPushConstants(['{{USERNAME}}' => 'Chirag Patel']);
        $notification->setPushNotificationData([]);
        $notification->setEmailSent(false);
        $notification->setSmsSent(false);
        $notification->setPushSent(true);
        $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
        $notification->setTemplateKey('template_1');
        $notification->setCcEmployeeIds([]);
        $notification->setToEmployeeId(477);
        $notification->setCompanyId(9);
        $notification->sendNotification();

        exit;
    }
}
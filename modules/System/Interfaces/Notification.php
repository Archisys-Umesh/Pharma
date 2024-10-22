<?php declare(strict_types = 1);

namespace Modules\System\Interfaces;

interface Notification
{
    public function sendNotification();

    public function setEmailConstants($constants);

    public function setSmsConstants($constants);

    public function setPushConstants($constants);

    public function setEmailSent($sent);

    public function setSmsSent($sent);

    public function setPushSent($sent);

    public function setToEmployeeId($employeeId);

    public function setTemplateKey($key);
}
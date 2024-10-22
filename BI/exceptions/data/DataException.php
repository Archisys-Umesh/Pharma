<?php

namespace BI\exceptions\data;

use entities\ConfigurationQuery;
use entities\DataExceptionLogs;
use entities\EmailNotifications;

abstract class DataException {
    protected $exceptionId, $exceptionFound, $toEmails, $ccEmails, $emailSubject, $emailBody, $emailData, $emailType, $companyId;

    public function __construct($exceptionId, $companyId, $loggerName, $subject, $emails) {
        $this->setExceptionId($exceptionId);
        $this->setCompanyId($companyId);
        $this->setEmailType($loggerName);
        $this->setEmailSubject($subject);
        $this->setToEmailAddress($emails);
    }

    abstract protected function handle();
    abstract protected function setEmailBody();

    protected function setExceptionId(int $exceptionId) {
        $this->exceptionId = $exceptionId;

        return $this;
    }

    protected function setEmailSubject(String $subject) {
        $this->emailSubject = $_ENV['APP_NAME'] . ' - ' . $subject;

        return $this;
    }

    protected function setEmailType(String $loggerName) {
        $this->emailType = $loggerName;

        return $this;
    }

    protected function setCompanyId(int $companyId) {
        $this->companyId = $companyId;

        return $this;
    }

    protected function setExceptionFound(Bool $found) {
        $this->exceptionFound = $found;

        return $this;
    }

    protected function setEmailData(Array $data) {
        $this->emailData = $data;

        return $this;
    }

    protected function setToEmailAddress(String $emails) {
        $this->toEmails = $emails;

        return $this;
    }

    protected function setccEmailAddress() {
        $this->ccEmails = null;

        return $this;
    }

    protected function getCompanyId() : int {
        return $this->companyId ?? 9;
    }

    protected function getExceptionFound() : Bool {
        return $this->exceptionFound ?? false;
    }

    protected function getToEmailAddress() : String | null {
        return $this->toEmails ?? null;
    }

    protected function getccEmailAddress() : String | null {
        return $this->ccEmails ?? null;
    }

    protected function getEmailSubject() : String | null {
        return $this->emailSubject ?? null;
    }

    protected function getEmailBody() : String | null {
        return $this->emailBody ?? null;
    }

    protected function getEmailData() : Array | null {
        return $this->emailData ?? null;
    }

    protected function getEmailType() : String | null {
        return $this->emailType ?? null;
    }

    protected function getExceptionId() : int {
        return $this->exceptionId;
    }

    protected function handleException() {
        if ($this->getExceptionFound()) {
            $this->setEmailBody()->sendEmailNotification();
        }

        $dataExceptionlog = new DataExceptionLogs;
        $dataExceptionlog->setDataExceptionId($this->getExceptionId());
        $dataExceptionlog->setDate(date('Y-m-d'));
        $dataExceptionlog->setHasException($this->getExceptionFound());
        $dataExceptionlog->setExceptionData(json_encode($this->getEmailData()));
        $dataExceptionlog->setCompanyId($this->getCompanyId());
        $dataExceptionlog->save();
    }

    protected function sendEmailNotification() {
        $notification = new EmailNotifications;
        $notification->setToEmails($this->getToEmailAddress());
        $notification->setCcEmails($this->getccEmailAddress());
        $notification->setEmailSubject($this->getEmailSubject());
        $notification->setEmailBody($this->getEmailBody());
        $notification->setScheduleAt(date('Y-m-d H:i:s'));
        $notification->setEmailSentStatus(false);
        $notification->setEmailConstants(json_encode($this->getEmailData()));
        $notification->setEmailType($this->getEmailType());
        $notification->setEmailSentAttempts(0);
        $notification->setCompanyId($this->getCompanyId());
        $notification->save();
    }
}
<?php

namespace BI\manager;

use entities\DataExceptionLogsQuery;
use entities\DataExceptionsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class DataExceptionManager
{
    public function runner() {
        echo "Checking for new data exception... : Start" . PHP_EOL;
        $this->checkForDataException();
        echo "Checking for new data exception... : End" . PHP_EOL;
    }

    private function checkForDataException() {
        $dataExceptions = DataExceptionsQuery::create()
                            ->filterByActive(true)
                            ->find();

        foreach ($dataExceptions as $dataException) {
            if (($dataException->getScheduleTime()->format('H:i') < date('H:i')) && !$this->alreadyCheckException($dataException)) {
                echo "Checking for new exception... : " . $dataException->getExceptionName() . PHP_EOL;

                $class = $dataException->getClassPath();
                $exceptionId = $dataException->getPrimaryKey();
                $compnayId = $dataException->getCompanyId();
                $loggerName = $dataException->getLoggerName();
                $subject = $dataException->getSubject();
                $clientEmails = explode(',', $dataException->getClientEmails());
                $teamEmails = explode(',', $dataException->getTeamEmails());
                $emails = implode(',', array_unique(array_merge($clientEmails, $teamEmails)));
                call_user_func([new $class($exceptionId, $compnayId, $loggerName, $subject, $emails), 'handle']);

                echo "Checking for new exception... : " . $dataException->getExceptionName() . PHP_EOL;
            }
        }
    }

    private function alreadyCheckException($dataException) {
        $count = DataExceptionLogsQuery::create()
                    ->filterByDataExceptionId($dataException->getPrimaryKey())
                    ->filterByDate(date('Y-m-d'))
                    ->count();

        return $count > 0 ? true : false;
    }
}
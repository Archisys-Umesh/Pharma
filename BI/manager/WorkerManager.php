<?php

namespace BI\manager;

class WorkerManager
{
    protected $lowLevelworkers, $mediumLevelworkers, $highLevelWorkers;
    protected $highLevelMultipleInstanceWorkers, $mediumLevelMultipleInstanceWorkers;

    public function __construct() {
        $this->lowLevelworkers = $this->mediumLevelworkers = $this->highLevelWorkers = [];
        $this->highLevelMultipleInstanceWorkers = $this->mediumLevelMultipleInstanceWorkers = [];
        $this->setLowLevelWorkers();
        $this->setMediumLevelWorkers();
        $this->setHighLevelWorkers();
        $this->setHighLevelMultipleInstanceWorkers();
        $this->setMediumLevelMultipleInstanceWorkers();
    }
    
    private function setLowLevelWorkers() {
        $this->lowLevelworkers[] = ['class' => '\BI\manager\LeaveManager', 'function' => 'allocateLeavesToEmployee', 'sleepTime' => 3600, 'lastCall' => 0];
        $this->lowLevelworkers[] = ['class' => '\Modules\System\Processes\FTPRunner', 'function' => 'addWatcher', 'sleepTime' => 10, 'lastCall' => 0];
        $this->lowLevelworkers[] = ['class' => '\Modules\System\Processes\FTPExportRunner', 'function' => 'addWatcher', 'sleepTime' => 10, 'lastCall' => 0];
        // $this->lowLevelworkers[] = ['class' => '\BI\manager\LeaveManager', 'function' => 'attendanceLeave', 'sleepTime' => 3600, 'lastCall' => 0];
    }

    private function setMediumLevelWorkers() {
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\NotificationManager', 'function' => 'sendScheduledNotifications', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\FileManager', 'function' => 'checkForS3Files', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\ExpenseManager', 'function' => 'autoExpenseGenerateRunner', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\OnBoardManager', 'function' => 'createCustomerFromRequest', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\DataExceptionManager', 'function' => 'runner', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\CronCommandManager', 'function' => 'runner', 'sleepTime' => 60, 'lastCall' => 0];
        // $this->mediumLevelworkers[] = ['class' => '\BI\manager\SGPIManager', 'function' => 'rcpaSummaryWorker', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\BrandCampaignManager', 'function' => 'createCampaignOutlets', 'sleepTime' => 60, 'lastCall' => 0];
        // $this->mediumLevelworkers[] = ['class' => '\BI\manager\AnnouncementManager', 'function' => 'mapEmployeeToAnnouncement', 'sleepTime' => 60, 'lastCall' => 0];
        $this->mediumLevelworkers[] = ['class' => '\BI\manager\MTPManager', 'function' => 'generateMtpDaysPlan', 'sleepTime' => 60, 'lastCall' => 0];
        if($_ENV['CaptureGeoLocation'] == "Yes"){
            $this->mediumLevelworkers[] = ['class' => '\BI\manager\AttendanceManager', 'function' => 'attendanceLatLongToAddress', 'sleepTime' => 60, 'lastCall' => 0];
            $this->mediumLevelworkers[] = ['class' => '\BI\manager\AttendanceManager', 'function' => 'dailycallsLatLongToAddress', 'sleepTime' => 60, 'lastCall' => 0];
            $this->mediumLevelworkers[] = ['class' => '\BI\manager\AttendanceManager', 'function' => 'brandRcpaLatLongToAddress', 'sleepTime' => 60, 'lastCall' => 0];
        }
    }

    private function setMediumLevelMultipleInstanceWorkers() {
        $this->mediumLevelMultipleInstanceWorkers[] = ['class' => '\BI\manager\MTPCreationManager', 'function' => 'runner', 'sleepTime' => 10, 'lastCall' => 0];
    }

    private function setHighLevelWorkers() {
        $this->highLevelWorkers[] = ['class' => '\Modules\System\Processes\FTPRunner', 'function' => 'addLogWatcher', 'sleepTime' => 10, 'lastCall' => 0];
        $this->highLevelWorkers[] = ['class' => '\BI\manager\DataChangeRequestManager', 'function' => 'runner', 'sleepTime' => 60, 'lastCall' => 0];
    }

    private function setHighLevelMultipleInstanceWorkers() {
        $this->highLevelMultipleInstanceWorkers[] = ['class' => '\Modules\System\Processes\FTPExportRunner', 'function' => 'addLogWatcher', 'sleepTime' => 10, 'lastCall' => 0];
    }

    public function startWorkerRunner($level) {
        switch ($level) {
            case 'low':
                $this->startRunner($this->lowLevelworkers);
                break;

            case 'medium':
                $this->startRunner($this->mediumLevelworkers);
                break;

            case 'high':
                $this->startRunner($this->highLevelWorkers);
                break;

            case 'highMultipleInstance':
                $this->startRunner($this->highLevelMultipleInstanceWorkers);
                break;

            case 'mediumMultipleInstance':
                $this->startRunner($this->mediumLevelMultipleInstanceWorkers);
                break;
            
            default:
                echo "Level not defined yet, please contact developer..." . PHP_EOL;
                break;
        }
    }

    function startRunner(&$workers) {
        set_time_limit(0);

        while (true) {
            foreach ($workers as &$worker) {
                $this->startWorker($worker);
            }
        }
    }

    function startWorker(&$worker) {
        $canStart = false;

        if ($worker['lastCall'] > 0) {
            $different = time() - $worker['lastCall'];
            if ($different > $worker['sleepTime']) {
                $canStart = true;
            }
        } else {
            $canStart = true;
        }

        if ($canStart) {
            echo "Start Worker : " . $worker['class'] . ' - ' . $worker['function'] . PHP_EOL;
            call_user_func([new $worker['class'](), $worker['function']]);
            $worker['lastCall'] = time();
            echo "End Worker : " . $worker['class'] . ' - ' . $worker['function'] . PHP_EOL;
        }
    }
}
<?php

namespace BI\manager;

use entities\CronCommandLogs;
use entities\CronCommandLogsQuery;
use entities\CronCommandsQuery;
use Modules\SAPIntegration\Controllers\ManageDataFromSap;
use Propel\Runtime\ActiveQuery\Criteria;

class CronCommandManager
{
    public function runner() {
        echo "Checking for new cron commands... : Start" . PHP_EOL;
        $this->checkForCronCommands();
        echo "Checking for new cron commands... : End" . PHP_EOL;
    }

    private function checkForCronCommands() {
        $commands = CronCommandsQuery::create()
                            ->filterByIsActive(true)
                            ->orderById()
                            ->find();

        foreach ($commands as $command) {
            if (($command->getScheduleTime()->format('H:i') < date('H:i')) && !$this->alreadyCommandExecute($command)) {
                echo "Executing the cron command... Start : " . $command->getCommandKey() . PHP_EOL;
                $this->executeTheCommand($command);
                echo "Executing the cron command... End : " . $command->getCommandKey() . PHP_EOL;
            }
        }
    }

    private function alreadyCommandExecute($command) {
        $count = CronCommandLogsQuery::create()
                    ->filterByCronCommandId($command->getPrimaryKey())
                    ->filterByDate(date('Y-m-d'))
                    ->count();

        return $count > 0 ? true : false;
    }

    private function addLogForCommand($command) {
        $log = new CronCommandLogs;
        $log->setCronCommandId($command->getPrimaryKey());
        $log->setDate(date('Y-m-d'));
        $log->setCommandKey($command->getCommandKey());
        $log->setStartTime(date('Y-m-d H:i:s'));
        $log->setCompanyId($command->getCompanyId());
        $log->save();

        return $log;
    }

    private function updateEndTimeToLog($log) {
        $log->setEndTime(date('Y-m-d H:i:s'));
        $log->save();
    }

    private function executeTheCommand($command) {
        switch ($command->getCommandKey()) {
            case 'do_day_locking':
                $this->doDayLocking($command);
                break;

            case 'genrate_sgpi_accounts':
                $this->doGenerateSgpiAccounts($command);
                break;

            case 'do_resign_employees':
                $this->doResignEmployees($command);
                break;

            case 'refresh_outlet_view':
                $this->doRefreshOutletView($command);
                break;

            case 'refresh_outlet_mapping_view':
                $this->doRefreshOutletMappingView($command);
                break;

            case 'refresh_outlet_address_view':
                $this->doRefreshOutletAddressView($command);
                break;

            case 'refresh_outlet_sgpi_compliant_view':
                $this->doRefreshOutletSgpiCompliantView($command);
                break;

            case 'refresh_dar_view':
                $this->doRefreshDarView($command);
                break;

            case 'refresh_outlet_visits_view':
                $this->doRefreshOutletVisitView($command);
                break;

            case 'do_eod_tasks':
                $this->doEodTasks($command);
                break;

            case 'do_housekeeping_process':
                $this->doHousekeepingProcess($command);
                break;

            case 'refresh_export_outlet_mapping_view_data':
                $this->refreshExportOoutletMappingViewData($command);
                break;

            case 'natco_refresh_opening_stock_distributor_wise':
                $this->doNatcoRefreshOpeningStockDistributorWise($command);
                break;

            case 'refresh_mtp_deviation_view':
                $this->refreshMtpDeviationViewData($command);
                break;
            
            default:
                echo "Error : No command developed, Please contact developers." . PHP_EOL;
                break;
        }
    }

    private function doDayLocking($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_day_locking(2)");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);

        $att = new AttendanceManager();
        $att->notifyEmployeesLock();
    }

    private function doGenerateSgpiAccounts($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call genrate_sgpi_accounts()");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doResignEmployees($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_resign_employees()");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshOutletView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view outlet_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshOutletMappingView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view outlet_mapping_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshOutletAddressView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view outlet_address_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshOutletSgpiCompliantView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view outlet_sgpi_compliant_view_yestdayday_only");
        $serviceContainer->closeConnections();
        $serviceContainer->getConnection()->exec("call do_refresh_outlet_sgpi_compliant_view()");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshDarView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view dar_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }
    
    private function doRefreshOutletVisitView($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view outlet_visits_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }

    private function doEodTasks($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_eod_tasks()");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }

    private function doHousekeepingProcess($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_housekeeping_process()");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }

    private function refreshExportOoutletMappingViewData($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view export_outlet_mapping_view_data");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }

    private function refreshMtpDeviationViewData($command) {
        $log = $this->addLogForCommand($command);
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("refresh materialized view mtp_deviation_view");
        $serviceContainer->closeConnections();
        $this->updateEndTimeToLog($log);
    }

    private function doNatcoRefreshOpeningStockDistributorWise($command) {
        $log = $this->addLogForCommand($command);
        $sapObj = new ManageDataFromSap($command->getCompanyId());
        $sapObj->getOpeningStockDistributorWise();
        $this->updateEndTimeToLog($log);
    }
}
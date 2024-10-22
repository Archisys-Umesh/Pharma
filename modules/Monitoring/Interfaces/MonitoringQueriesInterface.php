<?php declare(strict_types = 1);

namespace Modules\Monitoring\Interfaces;

interface MonitoringQueriesInterface {
    // Set Table Columns
    public function getTableColumns();

    // Set Query Data
    public function getData();

    // Deactivate the controller 
    public function canRun();

    // Get Label
    public function getLabel();

    public function getUniqueKey();
}
<?php

declare(strict_types=1);

namespace Modules\Reports\Controllers;

use App\System\App;
use koolreport\KoolReport;
use Modules\Reports\KoolReportModel;

class KoolReports extends KoolReport {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function DarReport() {
        $darreport = new KoolReportModel\DarReport();
        $darreport->run()->render();        
        
        
    }

}

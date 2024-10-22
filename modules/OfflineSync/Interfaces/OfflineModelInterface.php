<?php

declare(strict_types = 1);

namespace Modules\OfflineSync\Interfaces;

use DateTime;
use App\System\App;
use entities\Users;
use Modules\OfflineSync\Classes\WDBTable;

interface OfflineModelInterface {

    // Set App Object
    public function setApp(Users $user);

    
    // Get data from DB to WatermelonDB
    public function doRecordsToSend($date) : WDBTable;
    
    // Receive data from WatermelonDB to DB 
    public function doRecordsToReceive($date,WDBTable $data);
            
    // Deactivate the controller 
    public function canRun();
    
    // Bool flag in error occured
    public function hadError();
    
    // Get array of error per record. 
    public function getErrorMessage();
    
    // Get full log 
    public function getLog();

    // Get table Name
    public function getTableName();
    
    
}

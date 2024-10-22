<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\EmployeeQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class Employee implements OfflineModelInterface {

       protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empId = $this->User->getEmployeeId();        
        $retunDB = new WDBTable();
        $retunDB->tableName = "Employee";
        $retunDB->idColName = "EmployeeId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        
        $empRecCreated = EmployeeQuery::create()                    
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByEmployeeId($empId)
                        ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
                        ->find()->toArray();

        $empRecUpdated = EmployeeQuery::create()                    
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByEmployeeId($empId)
                        ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                        ->filterByCreatedAt($date,Criteria::LESS_THAN)
                        ->find()->toArray();

        $retunDB->created = $empRecCreated;        
        $retunDB->updated = $empRecUpdated;

        return $retunDB;
    }

    public function getTableName()
    {
        return "Employee";
    }
    
    public function doRecordsToReceive($date,WDBTable $data)
    {

    }
            
    // Deactivate the controller 
    public function canRun()
    {
        return true;
    }
    
    // Bool flag in error occured
    public function hadError()
    {

    }
    
    // Get array of error per record. 
    public function getErrorMessage()
    {

    }
    
    // Get full log 
    public function getLog()
    {

    }

}

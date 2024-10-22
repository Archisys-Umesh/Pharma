<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\Users;
use entities\SystemConfigsQuery;
use Modules\OfflineSync\Classes\WDBTable;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;

/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class SystemConfigs implements OfflineModelInterface {
    protected $User;
    protected $log = [];

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $orgUnitId = $this->User->getEmployee()->getOrgUnitId();
        $companyId = $this->User->getEmployee()->getCompanyId();   

        $retunDB = new WDBTable();
        $retunDB->tableName = "SystemConfigs";
        $retunDB->idColName = "ConfigId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        
        $configRecCreated = SystemConfigsQuery::create()                    
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByCompanyId($companyId)
                        ->filterByIsApp(true)
                        ->filterByOrgunitId($orgUnitId)
                        ->_or()
                        ->filterByOrgunitId(null)
                        ->find()->toArray();

        $configRecUpdated = SystemConfigsQuery::create()                    
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByCompanyId($companyId)
                        ->filterByCreatedAt($date,Criteria::LESS_THAN)
                        ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                        ->filterByIsApp(true)
                        ->filterByOrgunitId($orgUnitId)
                        ->_or()
                        ->filterByOrgunitId(null)
                        ->find()->toArray();

        $retunDB->created = $configRecCreated;        
        $retunDB->updated = $configRecUpdated;

        return $retunDB;
    }

    public function getTableName()
    {
        return "SystemConfigs";
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
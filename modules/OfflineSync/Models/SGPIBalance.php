<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\SgpiAccountsQuery;
use entities\SgpiEmployeeBalanceQuery;
use entities\SgpiTransQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class SGPIBalance implements OfflineModelInterface {

       protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "SGPIBalance";
        $retunDB->idColName = "Uniquecode";

        $retunDB->created = [];

        $account = SgpiAccountsQuery::create()->findOneByEmployeeId($empRec->getEmployeeId());
        if($account != null)
        {
        
            $accountid =  $account->getSgpiAccountId();

            $sgpis = SgpiTransQuery::create()->select(["SgpiId"])                            
                            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
                            ->filterBySgpiAccountId($accountid)
                            ->find()->toArray();
                            
            if($sgpis != null && count($sgpis) > 0) {

            $sgpis = array_unique($sgpis);

            $balance = SgpiEmployeeBalanceQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByEmployeeId($empRec->getEmployeeId())
                    ->filterBySgpiId($sgpis)
                    ->find()->toArray();

        
            $retunDB->updated = $balance;
        }

        

        }


        return $retunDB;
    }

    public function getTableName()
    {
        return "SGPIBalance";
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

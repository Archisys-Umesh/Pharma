<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\CategoriesQuery;
use entities\OutletTagsQuery;
use entities\OutletTypeQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletType implements OfflineModelInterface {

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
        $retunDB->tableName = "OutletType";
        $retunDB->idColName = "OutlettypeId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.

        $orgUnitId = $empRec->getOrgUnitId();

        $createdOutletType = OutletTypeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();

        $createdArr = [];

        foreach ($createdOutletType as $outletType){
            $orgUnitIds = $outletType['OrgUnitId'];
            if ($orgUnitIds === null) {
                continue;
            }
            $orgUnits = explode(",",$outletType['OrgUnitId']);
            foreach ($orgUnits as $orgUnit){
                if ($orgUnitId==$orgUnit){
                    $createdArr[] = $outletType;
                }
            }
        }

        $updatedOutletType = OutletTypeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();

        $updatedArr = [];

        foreach ($updatedOutletType as $updatedoutletType){
            $orgUnitIds = $updatedoutletType['OrgUnitId'];
            if ($orgUnitIds === null) {
                continue;
            }
            $orgUnits = explode(",",$updatedoutletType['OrgUnitId']);
            foreach ($orgUnits as $orgUnit){
                if ($orgUnitId==$orgUnit){
                    $updatedArr[] = $updatedoutletType;
                }
            }
        }
        

        $retunDB->created = $createdArr;
                                    
        $retunDB->updated = $updatedArr;

        return $retunDB;
    }

    public function getTableName()
    {
        return "OutletType";
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

<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\SurveyCategoryQuery;
use entities\TerritoriesQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class SurveyCategory implements OfflineModelInterface {

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {

        $empRec = $this->User->getEmployee();

        $retunDB = new WDBTable();

        $retunDB->tableName = "SurveyCategory";

        $retunDB->idColName = "SurveyCatid";

        $orgUnitId = $empRec->getOrgUnitId();

        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
       
        $createdSurveyCategory = SurveyCategoryQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();
        $createdArr = [];
        foreach ($createdSurveyCategory as $category){
            if ($category['Orgunitid']!=null){
                $totalCategory = explode(',',$category['Orgunitid']);
                if (in_array($orgUnitId,$totalCategory)){
                    $createdArr[] =  $category;
                }
            }

        }

        $updatedSurveyCategory = SurveyCategoryQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();

        $updatedArr = [];
        foreach ($updatedSurveyCategory as $upcategory){
            if($upcategory['Orgunitid']!=null){
                $totalCategory = explode(',',$upcategory['Orgunitid']);
                if (in_array($orgUnitId,$totalCategory)){
                    $updatedArr[] =  $upcategory;
                }
            }

        }

        $retunDB->created = $createdArr;

        $retunDB->updated = $updatedArr;

        return $retunDB;
    }
    
    public function getTableName()
    {
        return "SurveyCategory";
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

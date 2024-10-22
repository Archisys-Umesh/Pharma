<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\BrandCompetitionQuery;
use entities\BrandsQuery;
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
class BrandCompetition implements OfflineModelInterface {

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "BrandCompetition";
        $retunDB->idColName = "CompetitorId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.

        $states = BrandCompetitionQuery::create()
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)            
            ->filterByOrgunitid($empRec->getOrgUnitId())
            ->filterByCompanyId($empRec->getCompanyId())
            ->find();

        $competitiorState = [];
        $stateId = $this->User->getEmployee()->getBranch()->getIstateid();

        foreach ($states as $state){
            if($state->getIstateids() != null) {
            $holidayState = explode(",",$state->getIstateids());

            if (in_array($stateId,$holidayState)){
                $competitiorState[] = $state->toArray();
            }
            }
        }
       
        $retunDB->created = $competitiorState;
        $updatedcompetitiorState = [];

        $updatedStates = BrandCompetitionQuery::create()
            ->filterByOrgunitid($empRec->getOrgUnitId())            
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find();

        foreach ($updatedStates as $state){
            $holidayState = explode(",",$state->getIstateids());

            if (in_array($stateId,$holidayState)){
                $updatedcompetitiorState[] = $state->toArray();
            }
        }
        $retunDB->updated = $updatedcompetitiorState;


//        $retunDB->created = BrandCompetitionQuery::create()
//            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
//            ->filterByOrgunitid($empRec->getOrgUnitId())
//            ->filterByCompanyId($empRec->getCompanyId())
//            ->find()->toArray();

        /*$retunDB->updated = BrandCompetitionQuery::create()
            ->filterByOrgunitid($empRec->getOrgUnitId())
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find()->toArray();*/

        return $retunDB;
    }

    public function getTableName()
    {
        return "BrandCompetition";
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

<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\BrandCampiagnVisitsQuery;
use entities\CategoriesQuery;
use entities\DesignationsQuery;
use entities\PositionsQuery;
use entities\ProductsQuery;
use entities\Users;
use BI\manager\OrgManager;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class BrandCampiagnVisit implements OfflineModelInterface
{

    protected $User;
    protected $log = [];

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "BrandCampiagnVisit";
        $retunDB->idColName = "BrandCampiagnVisitId";
        $retunDB->customIdName = 'BCV';
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.

        // $brandCampaignIds = array();
        // $brandCamapgins = \entities\BrandCampiagnQuery::create()
        //                     ->filterByOrgUnitId($empRec->getOrgUnitId())
        //                     ->filterByStatus('Started')
        //                     ->find()->toArray();
        // if(count($brandCamapgins) > 0){
        //     foreach($brandCamapgins as $brandCamapgin){
        //         if($brandCamapgin['Position'] != null){
        //             $positionExplode = explode(',',$brandCamapgin['Position']);
        //             if (in_array($empRec->getPositionId(), $positionExplode)){
        //                 array_push($brandCampaignIds, $brandCamapgin['BrandCampiagnId']);
        //             }
        //         }
        //     }
        // }

        $pos = OrgManager::getUnderPositions($empRec->getPositionId());
        $data = array_merge($pos,[$empRec->getPositionId()]); 

        $retunDB->created = BrandCampiagnVisitsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByPositionId($data)
            ->joinWith('BrandCampiagnVisitPlan')
            ->joinWithBrandCampiagn()
            ->withColumn('BrandCampiagnVisitPlan.StepLevel', 'StepLevel')
            ->withColumn('BrandCampiagnVisitPlan.StepLevel', 'StepName')
            ->withColumn('BrandCampiagnVisitPlan.StepName', 'StepNameNew')
            ->withColumn('BrandCampiagnVisitPlan.Moye', 'Moye')
            ->withColumn('BrandCampiagnVisitPlan.Description', 'Description')
            ->withColumn('BrandCampiagnVisitPlan.AgendaType', 'AgendaType')
            ->withColumn('BrandCampiagnVisitPlan.AgendaSubTypeId', 'AgendaSubTypeId')
            ->withColumn('BrandCampiagnVisitPlan.SurveyId', 'SurveyId')
            ->withColumn('BrandCampiagn.CampiagnName', 'CampiagnName')
            ->withColumn('BrandCampiagnVisitPlan.SgpiId', 'SgpiIdNew')
            ->withColumn('BrandCampiagn.StartDate', 'StartDate')
            ->withColumn('BrandCampiagn.EndDate', 'EndDate')
            ->withColumn('BrandCampiagn.LockingDate', 'LockingDate')
            ->useBrandCampiagnQuery()
                ->filterByOrgunitid($empRec->getOrgUnitId())
                ->filterByStatus('Started')
            ->endUse()
            ->find()->toArray();


        $retunDB->updated = BrandCampiagnVisitsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByPositionId($data)
            ->joinWith('BrandCampiagnVisitPlan')
            ->joinWithBrandCampiagn()
            ->withColumn('BrandCampiagnVisitPlan.StepLevel', 'StepLevel')
            ->withColumn('BrandCampiagnVisitPlan.StepLevel', 'StepName')
            ->withColumn('BrandCampiagnVisitPlan.Moye', 'Moye')
            ->withColumn('BrandCampiagnVisitPlan.Description', 'Description')
            ->withColumn('BrandCampiagnVisitPlan.AgendaType', 'AgendaType')
            ->withColumn('BrandCampiagnVisitPlan.AgendaSubTypeId', 'AgendaSubTypeId')
            ->withColumn('BrandCampiagnVisitPlan.SurveyId', 'SurveyId')
            ->withColumn('BrandCampiagn.CampiagnName', 'CampiagnName')
            ->withColumn('BrandCampiagnVisitPlan.SgpiId', 'SgpiIdNew')
            ->withColumn('BrandCampiagn.StartDate', 'StartDate')
            ->withColumn('BrandCampiagn.EndDate', 'EndDate')
            ->withColumn('BrandCampiagn.LockingDate', 'LockingDate')
            ->useBrandCampiagnQuery()
                ->filterByOrgunitid($empRec->getOrgUnitId())
                ->filterByStatus('Started')
            ->endUse()
            ->find()->toArray();

        foreach ($retunDB->created as $key => $object) {
            unset($retunDB->created[$key]['BrandCampiagnVisitPlan']);
            unset($retunDB->created[$key]['BrandCampiagn']);
        }

        foreach ($retunDB->updated as $key => $object) {
            unset($retunDB->updated[$key]['BrandCampiagnVisitPlan']);
            unset($retunDB->updated[$key]['BrandCampiagn']);
        }

        return $retunDB;
    }

    public function getTableName()
    {
        return "BrandCampiagnVisits";
    }

    public function doRecordsToReceive($date, WDBTable $data)
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

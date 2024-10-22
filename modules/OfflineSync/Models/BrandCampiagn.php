<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\BrandCampiagnQuery;
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
class BrandCampiagn implements OfflineModelInterface
{

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "BrandCampiagn";
        $retunDB->idColName = "BrandCampiagnId";
        $retunDB->customIdName = 'BRC';
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.

        $created = BrandCampiagnQuery::create()
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByOrgUnitId($empRec->getOrgUnitId())
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByIsSuspended(false)
            ->filterByStatus('Started')
            ->orderByCampiagnName()->find()->toArray();

        $pos = OrgManager::getUnderPositions($empRec->getPositionId());
        $data = array_merge($pos,[$empRec->getPositionId()]); 

        $createdArr = array();
        foreach ($created as $c) {
            if($c['Position'] != null && $c['Position'] != ''){
                $outlets = \entities\BrandCampiagnDoctorsQuery::create()
                                    ->select(['OutletOrgDataId'])
                                    ->filterByBrandCampiagnId($c['BrandCampiagnId'])
                                    ->filterBySelected(true)
                                    ->filterByPositionId($data)
                                    ->find()->toArray();
                $c['OutletId'] = implode(',',$outlets);
            }
            $campaignClassification = \entities\BrandCampiagnClassificationQuery::create()
                                            ->select(['Classification.Classification'])
                                            ->joinWithClassification()
                                            ->filterByBrandCampiagnId($c['BrandCampiagnId'])
                                            ->find()->toArray();
            if(count($campaignClassification) > 0){
                $class = implode(',',$campaignClassification);
            }else{
                $class = null;
            }
            $c['Classifications'] = $class;
            array_push($createdArr,$c);
        } 

        $updated = BrandCampiagnQuery::create()
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByOrgUnitId($empRec->getOrgUnitId())
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByIsSuspended(false)
            ->filterByStatus('Started')
            ->orderByCampiagnName()->find()->toArray();

        $updatedArr = array();
        foreach ($updated as $c) {
            if($c['Position'] != null && $c['Position'] != ''){
                $outlets = \entities\BrandCampiagnDoctorsQuery::create()
                                    ->select(['OutletOrgDataId'])
                                    ->filterByBrandCampiagnId($c['BrandCampiagnId'])
                                    ->filterBySelected(true)
                                    ->filterByPositionId($data)
                                    ->find()->toArray();
                $c['OutletId'] = implode(',',$outlets);
            }
            $campaignClassification = \entities\BrandCampiagnClassificationQuery::create()
                                            ->select(['Classification.Classification'])
                                            ->joinWithClassification()
                                            ->filterByBrandCampiagnId($c['BrandCampiagnId'])
                                            ->find()->toArray();
                                            
            if(count($campaignClassification) > 0){
                $class = implode(',',$campaignClassification);
            }else{
                $class = null;
            }
            $c['Classifications'] = $class;
            array_push($updatedArr,$c);
        }

        $retunDB->created = $createdArr;
        $retunDB->updated = $updatedArr;

        return $retunDB;
    }

    public function doRecordsToReceive($date, WDBTable $data)
    {

    }

    public function getTableName()
    {
        return "BrandCampiagn";
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

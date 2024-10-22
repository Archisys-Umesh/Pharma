<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use BI\manager\DailyCallsManager;
use DateTime;
use App\System\App;
use entities\BrandCampiagnVisitQuery;
use entities\BrandCampiagnVisitsQuery;
use entities\Dailycalls as EntitiesDailycalls;
use entities\DailycallsQuery;
use entities\DayplanQuery;
use entities\OutletOrgDataQuery;
use entities\OutletViewQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;
use Symfony\Component\Validator\Constraints\Cidr;

/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class DailyCalls implements OfflineModelInterface
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
        $retunDB->tableName = "Dailycalls";
        $retunDB->idColName = "DcrId";

        $from_date = date('Y-m-d', strtotime("-90 days"));

        $retunDB->created = \entities\DailycallsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByPositionId($empRec->getPositionId())
            ->find()->toArray();

        $retunDB->updated = \entities\DailycallsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date, Criteria::GREATER_EQUAL)
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByPositionId($empRec->getPositionId())
            ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "Dailycalls";
    }

    public function doRecordsToReceive($date, WDBTable $data)
    {
        foreach ($data->created as &$created) {
            // is wdb key is duplicate
            if ($data->isSyncDuplicate("created", $created, $this->User->getPrimaryKey(), $this->User->getCompanyId())) {
                
                continue;
            }
            $wbtable = $data->LogUpdate("created", $created,
                $this->User->getPrimaryKey(),
                $this->User->getCompanyId());

            unset($created["DcrId"]); // Remove PK

            try {
                /*$outletView = OutletOrgDataQuery::create()->filterByOutletOrgId($created['OutletOrgDataId'])->findOne();

                if ($created['CampiagnId'] != null && $created['VisitPlanId'] != null) {
                    $brandCampiagn = BrandCampiagnVisitQuery::create()
                        ->filterByBrandCampiagnId($created['CampiagnId'])
                        ->filterByVisitPlanId($created['VisitPlanId'])
                        ->filterByOutletId($outletView->getOutletId())
                        ->findOne();

                    if ($brandCampiagn != null) {
                        $brandCampiagn->setIsVisit(true);
                        $brandCampiagn->save();
                    }
                }*/

                // Don't allow duplicate calls.
                $dailycalls = DailycallsQuery::create()
                    ->filterByPositionId($created['PositionId'])
                    ->filterByDcrDate($created['DcrDate'])
                    ->filterByEmployeeId($created['EmployeeId'])
                    ->filterByOutletOrgDataId($created['OutletOrgDataId'])
                    ->findOne();
                if ($dailycalls != null) {
                    
                    
                    $wbtable->setResMessage("duplicateCalls");
                    $wbtable->save();

                    $this->log[$created["id"]] = "duplicateCalls";
                }
                else 
                {
                    $dailyCalls = new \entities\Dailycalls();
                    $dailyCalls->fromArray($created);
                    $dailyCalls->setCompanyId($this->User->getCompanyId());
                    $dailyCalls->save();

                    $manager = new DailyCallsManager();
                    $manager->processSingleDCR($dailyCalls);
                    //$status = $this->setDayplanCompleted($dailyCalls);
                    //$this->setCampiagnVisitCompleted($dailyCalls);

                    $wbtable->setNewpk($dailyCalls->getPrimaryKey());
                    $wbtable->setResMessage("New Rec Created ");
                    $wbtable->save();

                    $this->log[$created["id"]] = "Saved";
                }

                

            } catch (\Exception $e) {
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }

        foreach ($data->updated as &$updated) {

            $wbtable = $data->LogUpdate("updated", $updated,
                $this->User->getPrimaryKey(),
                $this->User->getCompanyId());
            try {

                $dailyCalls = DailycallsQuery::create()->findPk($updated["DcrId"]);
                $dailyCalls->fromArray($updated);
                $dailyCalls->setCompanyId($this->User->getCompanyId());
                $dailyCalls->save();

                //$status = $this->setDayplanCompleted($dailyCalls);
                //$this->setCampiagnVisitCompleted($dailyCalls);

                $wbtable->setResMessage("Update");
                $wbtable->save();

                $this->log[$updated["id"]] = "Update";

            } catch (\Exception $e) {
                $this->log[$updated["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }
    }

    public function setDayplanCompleted(\entities\Dailycalls $dailyCall)
    {
        $dayplan = DayplanQuery::create()
            ->filterByOutletOrgDataId($dailyCall->getOutletOrgDataId())
            ->filterByTpDate($dailyCall->getDcrDate())
            ->filterByPositionId($dailyCall->getPositionId())
            ->filterByStatus("completed", Criteria::NOT_EQUAL)
            ->findOne();
        if ($dayplan != null) {
            $dayplan->setStatus("completed");
            $dayplan->save();
            return "DP-D";
        } else {
            return "DP-U";
        }
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
        return $this->log;
    }

    // function setCampiagnVisitCompleted(\entities\Dailycalls $dailyCall) {
    //     if ($dailyCall->getCampiagnId() != null && $dailyCall->getVisitPlanId() != null) {
    //         $visit = BrandCampiagnVisitsQuery::create()
    //                     ->filterByBrandCampiagnId($dailyCall->getCampiagnId())
    //                     ->filterByBrandCampiagnVisitPlanId($dailyCall->getVisitPlanId())
    //                     ->filterByOutletOrgDataId($dailyCall->getOutletOrgDataId())
    //                     ->findOne();
                        
    //         if ($visit != null) {
    //             $visit->setIsVisited(true);
    //             $visit->setVisitedDatetime(date('Y-m-d H:i:s', strtotime($dailyCall->getDcrDate())));
    //             $visit->save();
    //         }
    //     }
    // }
}

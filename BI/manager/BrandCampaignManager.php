<?php

namespace BI\manager;

use entities\BrandCampiagnClassificationQuery;
use entities\BrandCampiagnQuery;
use entities\BrandCampiagnVisits;
use entities\TerritoriesQuery;
use BI\manager\OrgManager;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of BrandCampaign Manager
 *
 * @author Chintan
 */

class BrandCampaignManager
{

    public function createCampaignOutlets()
    {

        // set_time_limit(0);
        // while (true) {
        echo "Checking for brand campaign add outlets... : Start" . PHP_EOL;
        $this->addCampaignOutlets();
        echo "Checking for brand campaign add outlets... : Done" . PHP_EOL;
        // }
    }

    public function addCampaignOutlets()
    {
        $campaigns = BrandCampiagnQuery::create()
            ->filterByStatus(['Started', 'Published'])
            ->filterByIsSuspended(false)
            ->orderByBrandCampiagnId(Criteria::ASC)
            ->find()->toArray();

        echo count($campaigns) . "this brand campaign status changes to start." . PHP_EOL;

        if (count($campaigns) > 0) {
            foreach ($campaigns as $campaign) {

                // Campaign Start
                if ($campaign['StartDate'] == date('Y-m-d')) {
                    $campaignOut = \entities\BrandCampiagnQuery::create()
                        ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                        ->filterByIsSuspended(false)
                        ->findOne();

                    if ($campaignOut->getStatus() == 'Published') {
                        $campaignOut->setStatus('Started');
                        $campaignOut->save();

                        echo $campaign['BrandCampiagnId'] . "this brand campaign status changes to start." . PHP_EOL;
                    }
                }


                // Campaign Close
                if ($campaign['EndDate'] == date('Y-m-d')) {
                    $campaignEnd = \entities\BrandCampiagnQuery::create()
                        ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                        ->filterByIsSuspended(false)
                        ->findOne();
                    if ($campaignEnd->getStatus() == 'Started') {
                        $campaignEnd->setStatus('Closed');
                        $campaignEnd->save();
                        echo $campaign['BrandCampiagnId'] . "this brand campaign status changes to close." . PHP_EOL;
                    }
                }

                // Generate Outlet Visits
                if ($campaign['LockingDate'] == date('Y-m-d')) {
                    $brandCampaginVisitPlan = \entities\BrandCampiagnVisitPlanQuery::create()
                        ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                        ->find()->toArray();
                    if (count($brandCampaginVisitPlan) > 0) {
                        $this->createOutletVisits($brandCampaginVisitPlan);
                        echo $campaign['BrandCampiagnId'] . "this brand campaign create outlet visit." . PHP_EOL;
                    }
                }

                //Send Notification
                $this->sendBrandCampaignPushNotification($campaign['BrandCampiagnId']);

                $campaignFwSteps = \entities\BrandCampiagnVisitPlanQuery::create()
                    ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                    ->filterByAgendaType('FW')
                    ->find()->toArray();

                $campaignNcaSteps = \entities\BrandCampiagnVisitPlanQuery::create()
                    ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                    ->filterByAgendaType('NCA')
                    ->find()->toArray();

                echo count($campaignFwSteps) . "this brand campaign step count." . PHP_EOL;

                $campaignOutlets = $this->getCampaignOutlets($campaign['BrandCampiagnId'], $campaign['OrgUnitId'], $campaign['OutlettypeId'], $campaign['SgpiBrands']);

                echo "Generate Campaign FW Outlets." . PHP_EOL;

                // if (count($campaignFwSteps) > 0) {
                //     // Generate Campaign FW Outlets
                //     $campaignOutlets = $this->getCampaignOutlets($campaign['BrandCampiagnId'], $campaign['OrgUnitId'], $campaign['OutlettypeId'], $campaign['SgpiBrands']);

                //     echo "Generate Campaign FW Outlets." . PHP_EOL;
                // }
                
                if (count($campaignNcaSteps) > 0) {
                    // Generate Campaign NCA Outlets
                    $this->getCampaignSteps($campaign['BrandCampiagnId']);

                    echo "Generate Campaign NCA Outlets." . PHP_EOL;
                }

                if ($campaignOutlets->count() > 0) {
                    if ($campaignOutlets != null && !empty($campaignOutlets) && $campaignOutlets->count() > 0) {
                        foreach ($campaignOutlets as $campaignOutlet) {
                            $brandCampaignOutlet = \entities\BrandCampiagnDoctorsQuery::create()
                                ->filterByBrandCampiagnId($campaign['BrandCampiagnId'])
                                ->filterByOutletOrgDataId($campaignOutlet->getOutletOrgId())
                                ->findOne();
                            if ($brandCampaignOutlet == null) {
                                $brandCampaignOutlet = new \entities\BrandCampiagnDoctors();
                                $brandCampaignOutlet->setBrandCampiagnId($campaign['BrandCampiagnId']);
                                $brandCampaignOutlet->setOutletId($campaignOutlet->getOutlet_Id());
                                $brandCampaignOutlet->setOutletOrgDataId($campaignOutlet->getOutletOrgId());
                                $brandCampaignOutlet->setCompanyId($campaignOutlet->getCompanyId());
                                $brandCampaignOutlet->setPositionId($campaignOutlet->getPositionId());
                                $brandCampaignOutlet->setClassificationId($campaignOutlet->getOutletClassification());
                                $brandCampaignOutlet->save();
                                echo "Create brand campaign outlet org -" . $campaign['BrandCampiagnId'] . ' - ' . $campaignOutlet->getOutletOrgId() . PHP_EOL;
                            }
                        }
                    } else {
                        echo "Brandcampaign id is" . $campaign['BrandCampiagnId'] . ' - outlet count 0.' . PHP_EOL;
                        continue;
                    }
                }
            }
        } else {
            echo "brand campaign not found" . PHP_EOL;
        }
    }

    public function getCampaignPositions($campaignId)
    {
        $campaigns = BrandCampiagnQuery::create()
            ->filterByBrandCampiagnId($campaignId)
            ->findOne();
        if ($campaigns->getPosition() != null && $campaigns->getPosition() != "") {
            $positions = explode(',', $campaigns->getPosition());

            $pos = OrgManager::getUnderPositions($positions);

            $data = array_merge($pos, $positions);

            return $data;
        } else {
            echo $campaignId . "brand campaign position not found" . PHP_EOL;
        }
    }

    public function getCampaignPositionsTerritories($campaignId)
    {
        $positions = $this->getCampaignPositions($campaignId);
        if ($positions != null && count($positions) > 0) {
            $territoryIds = TerritoriesQuery::create()
                ->select(['TerritoryId'])
                ->filterByPositionId($positions)
                ->find()->toArray();
            return $territoryIds;
        } else {
            echo $campaignId . "brand campaign position territory not found" . PHP_EOL;
        }
    }

    public function getCampaignClassifications($campaignId)
    {
        $campaignClassifications = BrandCampiagnClassificationQuery::create()
            ->filterByBrandCampiagnId($campaignId)
            ->find()->toArray();
        return $campaignClassifications;
    }

    public function getCampaignOutlets($campaignId, $orgUnitId, $outletTypeId, $sgpiBrands)
    {
        $territories = $this->getCampaignPositionsTerritories($campaignId);
        $classifications = $this->getCampaignClassifications($campaignId);

        // Get Classification Ids
        if (count($classifications) > 0) {
            $classificationIdArr = array();
            foreach ($classifications as $classification) {
                array_push($classificationIdArr, $classification["ClassificationId"]);
            }
        } else {
            $classificationIdArr = null;
        }

        // Get SgpiBrands
        if ($sgpiBrands == null) {
            $sgpi = null;
            $sgpiTagged = false;
        } else {
            $sgpiExp = explode(',', $sgpiBrands);
            $sgpiArrFilter = array_search("0", $sgpiExp);
            if ($sgpiArrFilter == 0) {
                $sgpiTagged = true;
            } else {
                $sgpiTagged = false;
            }
            $sgpi = $sgpiBrands;
        }

        // Get Campaign Outlets
        if ($territories != null && count($territories) > 0) {
            $outletView = \entities\OutletViewQuery::create()
                ->filterByOrgUnitId($orgUnitId)
                ->filterByTerritoryId($territories)
                ->filterByOutlettypeId($outletTypeId);
            if ($classificationIdArr != null) {
                $outletView->filterByOutletClassification($classificationIdArr);
            }
            if ($sgpi != null && $sgpi != '' && $sgpiTagged == 0) {
                $outletView->where("array[" . $sgpi . "] && (string_to_array(sgpi_brand_id_map, ',')::integer[])");
            }
            if ($sgpi != null && $sgpi != '' && $sgpiTagged == 1) {
                $outletView->where("array[" . $sgpi . "] && (string_to_array(sgpi_brand_id_map, ',')::integer[])")
                    ->_or()
                    ->filterBySgpiBrandIdMap(null)
                    ->_or()
                    ->filterBySgpiBrandIdMap('');
            }
            // if ($sgpi == null || $sgpiTagged == 1) {
            //     $outletView->filterBySgpiBrandIdMap(null);
            // }
            $outletView->find()->toArray();
            return $outletView;
        }
    }

    public function createOutletVisits($brandCampaginVisitPlan)
    {
        if (count($brandCampaginVisitPlan) > 0) {
            foreach ($brandCampaginVisitPlan as $brandCampaginVisit) {
                if ($brandCampaginVisit["AgendaType"] == 'NCA') {
                    $this->createNCAvisits($brandCampaginVisit);
                } else if ($brandCampaginVisit["AgendaType"] == 'FW') {
                    $this->createFWvisits($brandCampaginVisit);
                }
            }
        }
    }

    public function createNCAvisits($brandCampaginVisit)
    {
        $visitPlan = \entities\BrandCampiagnVisitPlanQuery::create()
            ->filterByBrandCampiagnVisitPlanId($brandCampaginVisit["BrandCampiagnVisitPlanId"])
            ->filterByAgendaType('NCA')
            ->findOne();
        if ($visitPlan != null) {
            $brandCampaignOutlets = \entities\BrandCampiagnDoctorsQuery::create()
                ->filterByBrandCampiagnId($brandCampaginVisit["BrandCampiagnId"])
                ->filterBySelected(true)
                ->filterByOutletId(null)
                ->filterByOutletOrgDataId(null)
                ->filterByClassificationId(null)
                ->find()->toArray();
                
            if (count($brandCampaignOutlets) > 0) {
                foreach ($brandCampaignOutlets as $brandCampaignOutlet) {
                    if ($brandCampaignOutlet["PositionId"] != null  && $visitPlan->getAgendaType() == 'NCA') {
                        $createVisitOutlet = \entities\BrandCampiagnVisitsQuery::create()
                            ->filterByBrandCampiagnId($brandCampaignOutlet["BrandCampiagnId"])
                            ->filterByBrandCampiagnVisitPlanId($visitPlan->getBrandCampiagnVisitPlanId())
                            ->filterByOutletId(null)
                            ->filterByOutletOrgDataId(null)
                            ->filterByPositionId($brandCampaignOutlet["PositionId"])
                            ->findOne();
                        if ($createVisitOutlet == null) {
                            $createVisitOutlet = new BrandCampiagnVisits();
                            $createVisitOutlet->setBrandCampiagnId($brandCampaignOutlet["BrandCampiagnId"]);
                            $createVisitOutlet->setBrandCampiagnVisitPlanId($visitPlan->getBrandCampiagnVisitPlanId());
                            $createVisitOutlet->setOutletId(null);
                            $createVisitOutlet->setOutletOrgDataId(null);
                            $createVisitOutlet->setPositionId($brandCampaignOutlet["PositionId"]);
                            $createVisitOutlet->setIsVisited(false);
                            $createVisitOutlet->save();
                        }
                    }
                }
            }
        }
    }

    public function createFWvisits($brandCampaginVisit)
    {

        $visitPlan = \entities\BrandCampiagnVisitPlanQuery::create()
            ->filterByBrandCampiagnVisitPlanId($brandCampaginVisit["BrandCampiagnVisitPlanId"])
            ->filterByAgendaType('FW')
            ->findOne();
        if ($visitPlan != null) {
            $brandCampaignOutlets = \entities\BrandCampiagnDoctorsQuery::create()
                        ->filterByBrandCampiagnId($brandCampaginVisit["BrandCampiagnId"])
                        ->filterBySelected(true)
                        ->filterByOutletId(null,Criteria::NOT_EQUAL)
                        ->filterByOutletOrgDataId(null,Criteria::NOT_EQUAL)
                        ->filterByClassificationId(null,Criteria::NOT_EQUAL)
                        ->find()->toArray();
                        
            if (count($brandCampaignOutlets) > 0) {
                foreach ($brandCampaignOutlets as $brandCampaignOutlet) {
                    
                    $visitDelete = \entities\BrandCampiagnVisitsQuery::create()
                                        ->filterByBrandCampiagnId($brandCampaignOutlet["BrandCampiagnId"])
                                        ->filterByBrandCampiagnVisitPlanId($brandCampaginVisit["BrandCampiagnVisitPlanId"])
                                        ->filterByOutletId($brandCampaignOutlet["OutletId"])
                                        ->filterByOutletOrgDataId($brandCampaignOutlet["OutletOrgDataId"])
                                        ->filterByPositionId(null)
                                        ->delete();

                    if ($brandCampaignOutlet["PositionId"] != null && $visitPlan->getAgendaType() == 'FW') {
                        $createVisitOutlet = \entities\BrandCampiagnVisitsQuery::create()
                            ->filterByBrandCampiagnId($brandCampaignOutlet["BrandCampiagnId"])
                            ->filterByBrandCampiagnVisitPlanId($brandCampaginVisit["BrandCampiagnVisitPlanId"])
                            ->filterByOutletId($brandCampaignOutlet["OutletId"])
                            ->filterByOutletOrgDataId($brandCampaignOutlet["OutletOrgDataId"])
                            ->filterByPositionId($brandCampaignOutlet["PositionId"])
                            ->findOne();
                            
                        if ($createVisitOutlet == null) {
                            $createVisitOutlet = new BrandCampiagnVisits();
                            $createVisitOutlet->setBrandCampiagnId($brandCampaignOutlet["BrandCampiagnId"]);
                            $createVisitOutlet->setBrandCampiagnVisitPlanId($visitPlan->getBrandCampiagnVisitPlanId());
                            $createVisitOutlet->setOutletId($brandCampaignOutlet["OutletId"]);
                            $createVisitOutlet->setOutletOrgDataId($brandCampaignOutlet["OutletOrgDataId"]);
                            $createVisitOutlet->setPositionId($brandCampaignOutlet["PositionId"]);
                            $createVisitOutlet->setIsVisited(false);
                            $createVisitOutlet->save();
                        }
                    }
                }
            }
        }          
    }

    public function sendBrandCampaignPushNotification($campaginId)
    {
        $brandCampaign = \entities\BrandCampiagnQuery::create()
            ->filterByBrandCampiagnId($campaginId)
            ->findOne();
        if ($brandCampaign != null && $brandCampaign != '' && $brandCampaign->getPosition() != null) {
            $positionExplode = explode(',', $brandCampaign->getPosition());
            $employee = \entities\EmployeeQuery::create()
                ->filterByPositionId($positionExplode)
                ->find()->toArray();

            $lockingDate = $brandCampaign->getLockingDate();
            $beforeLockingDate = date('Y-m-d', strtotime($lockingDate->format('Y-m-d') . ' -1 day'));
            $afterLockingDate = date('Y-m-d', strtotime($lockingDate->format('Y-m-d') . ' +1 day'));

            $closeDate = $brandCampaign->getEndDate();
            $beforeCloseDate = date('Y-m-d', strtotime($closeDate->format('Y-m-d') . ' -1 day'));
            $closeBeforManyDaysDate = date('Y-m-d', strtotime($closeDate->format('Y-m-d') . ' -15 days'));

            $date = date('Y-m-d');

            if (count($employee) > 0) {
                foreach ($employee as $emp) {

                    $template = null;
                    if ($beforeLockingDate == $date) {
                        $template = 'campaign_before_locking';
                    }
                    if ($afterLockingDate == $date) {
                        $template = 'campaign_after_locking';
                    }
                    if ($brandCampaign->getStatus() == 'Published') {
                        $template = 'campaign_published';
                    }
                    if ($brandCampaign->getStatus() == 'Started') {

                        $template = 'campaign_started';
                    }

                    if ($beforeCloseDate == $date) {
                        $template = 'campaign_before_close';
                    }
                    if ($closeBeforManyDaysDate == $date) {
                        $template = 'campaign_before_manydays_close';
                    }
                    if ($brandCampaign->getStatus() == 'Closed') {
                        $template = 'campaign_close';
                    }
                    $notification = null;
                    if ($template != null) {
                        $notification = \entities\NotificationsQuery::create()
                            ->filterByToEmployeeId($emp['EmployeeId'])
                            ->filterByTemplateKey($template)
                            ->filterByPushSentStatus(false)
                            ->findOne();
                    }


                    if ($notification == null) {
                        $notification = new \Modules\System\Processes\Notification;
                        $notification->setEmailSent(false);
                        $notification->setSmsSent(false);
                        $notification->setPushSent(true);
                        $notification->setSchduleDateTime(date('Y-m-d H:i:s'));
                        $notification->setTemplateKey($template);
                        $notification->setToEmployeeId($emp['EmployeeId']);
                        $notification->setCompanyId($emp['CompanyId']);
                        $notification->sendNotification();
                    }
                }
            }
        }
    }

    public function getCampaignSteps($campaginId)
    {
        $brandCampaign = \entities\BrandCampiagnQuery::create()
            ->filterByBrandCampiagnId($campaginId)
            ->findOne();

        $visitPlans = \entities\BrandCampiagnVisitPlanQuery::create()
            ->filterByBrandCampiagnId($brandCampaign->getBrandCampiagnId())
            ->find()->toArray();

        if (count($visitPlans) > 0) {
            foreach ($visitPlans as $visitPlan) {
                if ($visitPlan['AgendaType'] == 'NCA' && $brandCampaign->getPosition() != null) {
                    $positionExplode = explode(',', $brandCampaign->getPosition());
                    if (count($positionExplode) > 0) {
                        foreach ($positionExplode as $positionExpl) {
                            $brandCampaignOutlet = \entities\BrandCampiagnDoctorsQuery::create()
                                ->filterByBrandCampiagnId($brandCampaign->getBrandCampiagnId())
                                ->filterByOutletId(null)
                                ->filterByOutletOrgDataId(null)
                                ->filterByPositionId($positionExpl)
                                ->filterByClassificationId(null)
                                ->findOne();
                            if ($brandCampaignOutlet == null) {
                                $brandCampaignOutlet = new \entities\BrandCampiagnDoctors();
                                $brandCampaignOutlet->setBrandCampiagnId($brandCampaign->getBrandCampiagnId());
                                $brandCampaignOutlet->setOutletId(null);
                                $brandCampaignOutlet->setOutletOrgDataId(null);
                                $brandCampaignOutlet->setCompanyId($brandCampaign->getCompanyId());
                                $brandCampaignOutlet->setPositionId($positionExpl);
                                $brandCampaignOutlet->setClassificationId(null);
                                $brandCampaignOutlet->setSelected(true);
                                $brandCampaignOutlet->save();
                            }
                        }
                    }
                }
            }
        }
    }
}

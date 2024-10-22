<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Outlets\Runtime;

use App\System\App;
use Modules\Outlets\Exceptions\InvalidArgumentException;

/**
 * Description of CheckInHelper
 *
 * @author Plus91Labs-01
 */
class CheckInResponse {

    public $CheckInStatus;
    public $CheckInCode;
    public $CheckInRec;

    public function toArray() {
        return [
            "CheckInStatus" => $this->CheckInStatus,
            "CheckInCode" => $this->CheckInCode,
            "CheckInRec" => $this->CheckInRec->toArray()
        ];
    }

}

class CheckInHelper {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function Check_in($empID, $outletId, $companyID, $checkin_location, $checkin_address, $checkinTime, $beat_id) {
        if ($this->CheckStatusForToday($empID)->CheckInCode == 0 || $this->CheckStatusForToday($empID)->CheckInCode == 2) {
            $outlet = \entities\OutletsQuery::create()->filterById($outletId)->findOne();
            if ($outlet->getOutletGps() != '' && $outlet->getOutletGps() != null) {
                $outletGPS = explode(',', $outlet->getOutletGps());
                $checkInGPS = explode(',', $checkin_location);
                
                // First Timers
                if($outletGPS[0] == 0 && $outletGPS[1] == 0)
                {
                    $outlet->setOutletGps($checkin_location);
                    $outlet->save();
                }
                
                //$distance = $this->getDistance((float) $outletGPS[0], (float) $outletGPS[1], (float) $checkInGPS[0], (float) $checkInGPS[1]);

                //$company = \entities\CompanyQuery::create()->filterByCompanyId($companyID)->findOne();                
                
                $outletCheckIn = new \entities\OutletCheckin();                
                $outletCheckIn->setEmpId($empID);
                $outletCheckIn->setOutletId($outletId);                
                $outletCheckIn->setCompanyId($companyID);
                $outletCheckIn->setCheckinDate(date("Y/m/d"));
                
                $outletCheckIn->setCheckinTime($checkinTime);
                $outletCheckIn->setCheckinLocation($checkin_location);
                $outletCheckIn->setCheckinAddress($checkin_address);
                $outletCheckIn->setCreatedBy($empID);
                $outletCheckIn->setStatus(0);                
                if($beat_id != null && $beat_id != ''){
                    $outletCheckIn->setBeatId($beat_id);
                }
                
                $outletCheckIn->save();
                return $outletCheckIn->toArray();
               
            } else {
                throw new \ErrorException("Outlet not found", 404);
            }
        } else {
            throw new \ErrorException("Already Check in", -1);
        }
    }

    public function Check_out($empID, $outletId, $companyID, $checkout_location, $checkout_address, $checkinOutTime, $checkout_outcome_id, $checkout_remark, $checkout_media) {
        $checkInResp = $this->CheckStatusForToday($empID);
        if ($checkInResp->CheckInCode == 1) {
            $outletCheckIn = $checkInResp->CheckInRec;
            
            $outlet = \entities\OutletsQuery::create()->filterById($outletId)->findOne();
            if ($outlet->getOutletGps() != '' && $outlet->getOutletGps() != null) {
                $outletGPS = explode(',', $outlet->getOutletGps());
                $checkOutGPS = explode(',', $checkout_location);
                //$distance = $this->getDistance((float) $outletGPS[0], (float) $outletGPS[1], (float) $checkOutGPS[0], (float) $checkOutGPS[1]);

                $company = \entities\CompanyQuery::create()->filterByCompanyId($companyID)->findOne();
                
                $startTime = strtotime($outletCheckIn->getCheckinTime()->format("H:i:s"));
                
                $endTime = strtotime($checkinOutTime);
                
                $time = $endTime - $startTime ;
                $outletCheckinTime = date("H:i", $time);
                $outletCheckIn->setCheckoutDate(date("Y/m/d"));
                $outletCheckIn->setCheckoutTime($checkinOutTime);
                $outletCheckIn->setCheckoutLocation($checkout_location);
                $outletCheckIn->setCheckoutAddress($checkout_address);
                $outletCheckIn->setUpdatedBy($empID);
                $outletCheckIn->setOutletOutcome($checkout_outcome_id);
                $outletCheckIn->setCheckoutRemark($checkout_remark);
                if($checkout_media != null && $checkout_media != '' && $checkout_media != 'null'){
                    $outletCheckIn->setCheckoutMedia($checkout_media);
                }
                $outletCheckIn->setCheckinOutMins($outletCheckinTime);
                $outletCheckIn->setStatus(1);
                $outletCheckIn->save();
                return $outletCheckIn->toArray();
               
            } else {
                throw new \ErrorException("Outlet not found", 404);
            }
        } else {
            throw new \ErrorException("CheckIn not found", -1);
        }
    }

    public function CheckStatusForToday($emp_id): CheckInResponse {
        $response = new CheckInResponse();
        $response->CheckInStatus = "Not Checked In";
        $response->CheckInCode = 0;

        $checkIn = \entities\OutletCheckinQuery::create()
                ->filterByEmpId($emp_id)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByCheckinDate(date("Y/m/d"))
                ->filterByStatus(1, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->orderBy("Status", \Propel\Runtime\ActiveQuery\Criteria::ASC)
                ->findOne();

        if ($checkIn) {
            if ($checkIn->getStatus() == 0) {
                $response->CheckInStatus = "Checked in";
                $response->CheckInCode = 1;
            } else {
                $response->CheckInStatus = "Checked Out";
                $response->CheckInCode = 2;
            }

            $response->CheckInRec = $checkIn;
            return $response;
        } else {
            $response->CheckInRec = new \entities\OutletCheckin();
            return $response;
        }
    }

    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));

        $distanceKM = $earth_radius * $c;
        $distanceInMeter = $distanceKM * 1000;

        return $distanceInMeter;
    }

}
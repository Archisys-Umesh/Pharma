<?php

declare(strict_types=1);

namespace Modules\Outlets\Runtime;

use App\Utils\FormMgr;
use App\System\App;
use App\Utils\ImageUploader;
use Modules\Outlets\Exceptions\InvalidArgumentException;

//class OutletCheckInOutResponse {
//
//    public string $OutletCheckInStatus;
//    public int $OutletCheckInCode;
//    public \entities\OutletCheckin $OutletCheckInRec;
//
//    public function toArray() {
//        return [
//            "OutletCheckInStatus" => $this->OutletCheckInStatus,
//            "OutletCheckInCode" => $this->OutletCheckInCode,
//            "OutletCheckInRec" => $this->OutletCheckInRec->toArray()
//        ];
//    }
//
//}

class OutletCheckInOutHelper {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function Check_in($empID, $outletId, $companyID, $checkin_location, $checkin_address) {

        $outlet = \entities\OutletsQuery::create()->filterById($outletId)->findOne();
        if ($outlet->getOutletGps() != '' && $outlet->getOutletGps() != null) {
            $outletGPS = explode(',', $outlet->getOutletGps());
            $checkInGPS = explode(',', $checkin_location);
            $distance = $this->getDistance((float) $outletGPS[0], (float) $outletGPS[1], (float) $checkInGPS[0], (float) $checkInGPS[1]);

            $company = \entities\CompanyQuery::create()->filterByCompanyId($companyID)->findOne();
            if ($distance < $company->getAllowradius()) {

                $outletCheckIn = new \entities\OutletCheckin();
                $outletCheckIn->setEmpId($empID);
                $outletCheckIn->setOutletId($outletId);
                $outletCheckIn->setCompanyId($companyID);
                $outletCheckIn->setCheckinDate(date("Y/m/d"));
                $outletCheckIn->setCheckinTime(date("H:i"));
                $outletCheckIn->setCheckinLocation($checkin_location);
                $outletCheckIn->setCheckinAddress($checkin_address);
                $outletCheckIn->setCreatedBy($empID);
                $outletCheckIn->setStatus(0);
                $outletCheckIn->save();
                return $outletCheckIn->toArray();
            } else {
                throw new \ErrorException("you are not able to check in because you are 50 meters away from your outlet.", 404);
            }
        } else {
            throw new \ErrorException("Outlet not found", 404);
        }
    }

    public function Check_out($empID, $outletId, $companyID, $checkout_location, $checkout_address) {

        $outletCheckOut = \entities\OutletCheckinQuery::create()
                ->filterByEmpId($empID)
                ->filterByOutletId($outletId)
                ->filterByCompanyId($companyID)
                ->filterByCheckinDate(date("Y/m/d"))
                ->filterByStatus(0)
                ->orderByCheckinDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                ->findOne();

        if ($outletCheckOut != '' && $outletCheckOut != null) {
            $outlet = \entities\OutletsQuery::create()->filterById($outletId)->findOne();
            if ($outlet->getOutletGps() != '' && $outlet->getOutletGps() != null) {
                $outletGPS = explode(',', $outlet->getOutletGps());
                $checkOutGPS = explode(',', $checkout_location);
                $distance = $this->getDistance((float) $outletGPS[0], (float) $outletGPS[1], (float) $checkOutGPS[0], (float) $checkOutGPS[1]);

                $company = \entities\CompanyQuery::create()->filterByCompanyId($companyID)->findOne();

                if ($distance < $company->getAllowradius()) {
                    
                    $outletCheckOut->setCheckoutDate(date("Y/m/d"));
                    $outletCheckOut->setCheckoutTime(date("H:i"));
                    $outletCheckOut->setCheckoutLocation($checkout_location);
                    $outletCheckOut->setCheckoutAddress($checkout_address);
                    $outletCheckOut->setUpdatedBy($empID);
                    $outletCheckOut->setStatus(1);
                    $outletCheckOut->save();
                    return $outletCheckOut->toArray();
                } else {
                    throw new \ErrorException("you are not able to check out because you are 50 meters away from your outlet.", 404);
                }
            } else {
                throw new \ErrorException("Outlet not found", 404);
            }
        } else {
            throw new \ErrorException("Checkin not found", 404);
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
    
    public function outletDetails($outletId) {
        $companyid = $this->app->Auth()->CompanyId();

        $outlets = [];
        $primaryOutlets = [];
        $pricebooks = [];
        $stocks = [];

        $products = \entities\CategoriesQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithProducts()
                        ->findByCompanyId($companyid)->toArray();
        
        $outlets[$outletId] = \entities\OutletsQuery::create()
                        ->filterById($outletId)
                        ->find()->toArray();
        
        $outletMapping = \entities\OutletMappingQuery::create()
                        ->filterBySecondaryOutletId($outletId)
                        ->findOne();
        
        $primaryOutlets[$outletMapping->getPrimaryOutletId()] = \entities\OutletsQuery::create()
                        ->filterById($outletMapping->getPrimaryOutletId())
                        ->find()->toArray();
        
        $pricebooks[$outletMapping->getPricebookId()] = \entities\PricebooklinesQuery::create()
                                ->filterByPriceBookId($outletMapping->getPriceBookId())
                                ->find()->toArray();
                
        $outletType = \entities\Base\OutletTypeQuery::create()
                        ->findByCompanyId($companyid)->toArray();

        $unitType = \entities\UnitmasterQuery::create()
                        ->find()->toArray();
        return
                [
                    "Products" => $products,
                    "Outlets" => $outlets,
                    "PrimaryOutlets" => $primaryOutlets,
                    "PriceBooks" => $pricebooks,
                    "OutletTypes" => $outletType,
                    "Units" => $unitType
        ];
    }

}

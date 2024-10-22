<?php

namespace BI\manager;

use entities\AttendanceQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use App\Utils\OlaMaps;

/**
 * Description of Attendance Manager 
 *
 * @author Chintan Parikh
 */
class AttendanceManager
{


    function notifyEmployeesLock()
    {
        $emps = AttendanceQuery::create()
            ->withColumn('COUNT(*)', 'Count')
            ->select(array('EmployeeId', 'Count'))
            ->filterByStatus(-1)
            ->groupByEmployeeId()
            ->find()->toArray();
        foreach ($emps as $emp) {
            if ($emp['Count'] == 3) {
                $EmployeeId = $emp['EmployeeId'];
                if ($EmployeeId > 0) {
                    NotificationManager::sendNotificationToEmployee($EmployeeId, "Lock Warning", "Your Account is about to get Locked , Please submit your attendances");
                }
            }
        }
    }

    public function attendanceLatLongToAddress()
    {
        $attendances = AttendanceQuery::create()
            ->filterByStartLatlng(null, Criteria::NOT_EQUAL)
            ->_or()
            ->filterByStartLatlng('undefined,undefined', Criteria::NOT_EQUAL)
            ->_or()
            ->filterByStartAddress(null, Criteria::EQUAL)
            ->_or()
            ->filterByEndLatlng(null, Criteria::NOT_EQUAL)
            ->_or()
            ->filterByEndLatlng('undefined,undefined', Criteria::NOT_EQUAL)
            ->_or()
            ->filterByEndAddress(null, Criteria::EQUAL)
            ->_or()
            ->filterByEndAddress('', Criteria::EQUAL)
            ->find();

        if (count($attendances) > 0) {
            foreach ($attendances as $attendance) {
                if ($attendance->getStartLatlng() != null || $attendance->getStartLatlng() != 'NA,NA') {
                    
                    $geoAdd = \entities\GeoAddressQuery::create()
                                    ->filterByLatLong($attendance->getStartLatlng())
                                    ->findOne();
                    if($geoAdd == null){
                        $latLongExp = explode(',', $attendance->getStartLatlng());

                        if(isset($latLongExp[0]) && isset($latLongExp[1])){
                            $latitude = $latLongExp[0];
                            $longitude = $latLongExp[1];

                            $reverseGeocode = new OlaMaps();
                            $result = $reverseGeocode->ReverseGeocoding($latitude, $longitude);

                            if (!empty($result["data"])) {
                                $dataDecode = json_decode($result["data"]);
                                if (!empty($dataDecode->results) && isset($dataDecode->results[0])) {
                                    $formattedAddress = $dataDecode->results[0]->formatted_address;
                                    $attendance->setStartAddress($formattedAddress);
                                    $attendance->save();
                                }
                            }
                        }
                    }else{
                        $attendance->setStartAddress($geoAdd->getAddress());
                        $attendance->save();
                    }
                }
                if ($attendance->getEndLatlng() != null || $attendance->getEndLatlng() != 'NA,NA') {
                    
                    $geoAdd = \entities\GeoAddressQuery::create()
                                    ->filterByLatLong($attendance->getEndLatlng())
                                    ->findOne();
                    if($geoAdd == null){
                        $latLongExp = explode(',', $attendance->getEndLatlng());

                        if(isset($latLongExp[0]) && isset($latLongExp[1])){
                            $latitude = $latLongExp[0];
                            $longitude = $latLongExp[1];

                            $reverseGeocode = new OlaMaps();
                            $result = $reverseGeocode->ReverseGeocoding($latitude, $longitude);

                            if (!empty($result["data"])) {
                                $dataDecode = json_decode($result["data"]);
                                if (!empty($dataDecode->results) && isset($dataDecode->results[0])) {
                                    $formattedAddress = $dataDecode->results[0]->formatted_address;
                                    $attendance->setEndAddress($formattedAddress);
                                    $attendance->save();
                                }
                            }
                        }
                    }else{
                        $attendance->setStartAddress($geoAdd->getAddress());
                        $attendance->save();
                    }
                }
            }
        }
    }

    public function dailycallsLatLongToAddress()
    {
        $dailycalls = \entities\DailycallsQuery::create()
            ->filterByDcrLatLong(null, Criteria::NOT_EQUAL)
            ->_or()
            ->filterByDcrLatLong('undefined,undefined', Criteria::NOT_EQUAL)
            ->_or()
            ->filterByDcrAddress(null, Criteria::EQUAL)
            ->_or()
            ->filterByDcrAddress('', Criteria::EQUAL)
            ->find();

        if (count($dailycalls) > 0) {
            foreach ($dailycalls as $dailycall) {
                if ($dailycall->getDcrLatLong() != null || $dailycall->getDcrLatLong() != '') {
                    
                    $geoAdd = \entities\GeoAddressQuery::create()
                                ->filterByLatLong($dailycall->getDcrLatLong())
                                ->findOne();
                    if($geoAdd == null){
                        $latLongExp = explode(',', $dailycall->getDcrLatLong());

                        if(isset($latLongExp[0]) && isset($latLongExp[1])){
                            $latitude = $latLongExp[0];
                            $longitude = $latLongExp[1];

                            $reverseGeocode = new OlaMaps();
                            $result = $reverseGeocode->ReverseGeocoding($latitude, $longitude);

                            if (!empty($result["data"])) {
                                $dataDecode = json_decode($result["data"]);
                                if (!empty($dataDecode->results) && isset($dataDecode->results[0])) {
                                    $formattedAddress = $dataDecode->results[0]->formatted_address;
                                    $dailycall->setDcrAddress($formattedAddress);
                                    $dailycall->save();
                                }
                            }
                        }
                    }else{
                        $dailycall->setDcrAddress($geoAdd->getAddress());
                        $dailycall->save();
                    }
                }
            }
        }
    }

    public function brandRcpaLatLongToAddress()
    {
        $brandRcpas = \entities\BrandRcpaQuery::create()
            ->filterByBrandRcpaLatLong(null, Criteria::NOT_EQUAL)
            ->_or()
            ->filterByBrandRcpaLatLong('undefined,undefined', Criteria::NOT_EQUAL)
            ->_or()
            ->filterByBrandRcpaAddress(null, Criteria::EQUAL)
            ->_or()
            ->filterByBrandRcpaAddress('', Criteria::EQUAL)
            ->find();

        if (count($brandRcpas) > 0) {
            foreach ($brandRcpas as $brandRcpa) {
                if ($brandRcpa->getBrandRcpaLatLong() != null || $brandRcpa->getBrandRcpaLatLong() != '') {
                    
                    $geoAdd = \entities\GeoAddressQuery::create()
                                ->filterByLatLong($brandRcpa->getBrandRcpaLatLong())
                                ->findOne();
                    if($geoAdd == null){
                        $latLongExp = explode(',', $brandRcpa->getBrandRcpaLatLong());

                        if(isset($latLongExp[0]) && isset($latLongExp[1])){
                            $latitude = $latLongExp[0];
                            $longitude = $latLongExp[1];

                            $reverseGeocode = new OlaMaps();
                            $result = $reverseGeocode->ReverseGeocoding($latitude, $longitude);

                            if (!empty($result["data"])) {
                                $dataDecode = json_decode($result["data"]);
                                if (!empty($dataDecode->results) && isset($dataDecode->results[0])) {
                                    $formattedAddress = $dataDecode->results[0]->formatted_address;
                                    $brandRcpa->setBrandRcpaAddress($formattedAddress);
                                    $brandRcpa->save();
                                }
                            }
                        }
                    }else{
                        $brandRcpa->setBrandRcpaAddress($geoAdd->getAddress());
                        $brandRcpa->save();
                    }
                }
            }
        }
    }
    
}

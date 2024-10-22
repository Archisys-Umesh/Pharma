<?php

namespace BI\manager;

use BI\requests\OnBoardRequest;
use BI\manager\NotificationManager;
use Propel\Runtime\ActiveQuery\Criteria;
use DateTime;
use entities\FtpImportLogsQuery;
use Exception;

/**
 * Description of MTP Manager
 *
 * @author Chintan
 */
class OnBoardManager
{
    public function getOnBoardRequestList($positionIds, $status, $outletTypeId)
    {
        $outlets = \entities\OnBoardRequestQuery::create()
            ->leftJoinWithOnBoardRequestAddress()
            ->leftJoinWithOnBoardRequestOutletMapping()
            ->leftJoinWithOnBoardRequestLog()
            ->filterByCreatedByPositionId($positionIds);
        if ($status != null && $status != '') {
            $outlets->filterByStatus($status);
        }
        if ($outletTypeId != null && $outletTypeId != '') {
            $outlets->filterByOutletTypeId($outletTypeId);
        }
        $data = $outlets->find()->toArray();

        $resultData = array();
        if (count($data) > 0) {
            foreach ($data as $outlet) {
                $onBoardAdd = \entities\OnBoardRequestAddressQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOnBoardRequestId($outlet["OnBoardRequestId"])
                    ->find()->toArray();
                $specialityArray = array();
                foreach ($onBoardAdd as $onBoardAd) {
                    if (isset($onBoardAd["Speciality"]) && !empty($onBoardAd["Speciality"])) {
                        $specialityExplode = array_filter(explode(',', $onBoardAd["Speciality"]));
                        if (!empty($specialityExplode)) {
                            $specialityArray = \entities\ClassificationQuery::create()
                                ->filterById($specialityExplode)
                                ->find()->toArray();
                        }
                    }
                }
                $result = [
                    'OnBoardRequestId' => $outlet["OnBoardRequestId"],
                    'OutletId' => $outlet["OutletId"],
                    'Salutation' => $outlet["Salutation"],
                    'FirstName' => $outlet["FirstName"],
                    'LastName' => $outlet["LastName"],
                    'Email' => $outlet["Email"],
                    'Mobile' => $outlet["Mobile"],
                    'Gender' => $outlet["Gender"],
                    'DateOfBirth' => $outlet["DateOfBirth"],
                    'MaritalStatus' => $outlet["MaritalStatus"],
                    'DateOfAnniversary' => $outlet["DateOfAnniversary"],
                    'Qualification' => $outlet["Qualification"],
                    'RegistrationNo' => $outlet["RegistrationNo"],
                    'Status' => $outlet["Status"],
                    'ProfilePic' => $outlet["ProfilePic"],
                    'OutletTypeId' => $outlet["OutletTypeId"],
                    'OutletName' => $outlet["OutletName"],
                    'Speciaality' => $specialityArray,
                    'Address' => $onBoardAdd,
                ];
                array_push($resultData, $result);
            }
        }

        return $resultData;
    }

    public function checkOutletExists($legacyCode = null, $phoneNo = null, $email = null, $registrationNo = null, $OutletTypeId = null)
    {
        $outlets = \entities\OutletViewQuery::create();
        if ($legacyCode != null && $legacyCode != '') {
            $outlets->filterByOutletCode($legacyCode);
        }
        if ($phoneNo != null && $phoneNo != '') {
            $outlets->filterByOutletContactNo($phoneNo);
        }
        if ($registrationNo != null && $registrationNo != '') {
            $outlets->filterByOutletRegno($registrationNo);
        }
        if ($email != null && $email != '') {
            $outlets->filterByOutletEmail($email);
        }
        if ($OutletTypeId != null && $OutletTypeId != '') {
            $outlets->filterByOutletTypeId($OutletTypeId);
        }
        $data = $outlets->find()->toArray();

        return $data;
    }

    public function getOutletById($id)
    {
        $outlet = \entities\OutletsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterById((int)$id)
            ->leftJoinWithOutletAddress()
            ->leftJoinWithOutletMapping()
            ->find()->toArray();

        $outletOrgData = \entities\OutletOrgDataQuery::create()
            ->select(['OutletOrgId'])
            ->filterByOutletId($id)
            ->find()->toArray();

        $beats = \entities\BeatOutletsQuery::create()
            ->filterByBeatOrgOutlet($outletOrgData)
            ->find()->toArray();

        $data = ['Outlet' => $outlet, 'Beats' => $beats];

        return $data;
    }

    public function getRequestById($id)
    {
        $onBoardRequest = \entities\OnBoardRequestQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithOnBoardRequestAddress()
            ->leftJoinWithOnBoardRequestOutletMapping()
            ->leftJoinWithOnBoardRequestLog()
            ->filterByOnBoardRequestId($id)
            ->find()->toArray();

        return $onBoardRequest;
    }

    public function getOutletOrgDataByOutletId($id)
    {
        $outletOrgData = \entities\OutletOrgDataQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByOutletId($id)
            ->leftJoinWithOutletAddress()
            ->find()->toArray();

        return $outletOrgData;
    }

    public function getOnBoardRequestAddress($id)
    {
        $onBoardAddress = \entities\OnBoardRequestAddressQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByOnBoardRequestId($id)
            ->leftJoinWithGeoTowns()
            ->leftJoinWithGeoCity()
            ->leftJoinWithGeoState()
            ->leftJoinWithBeats()
            ->find()->toArray();

        return $onBoardAddress;
    }

    public function createRequest(OnBoardRequest $outlet)
    {
        $onBoard = new \entities\OnBoardRequest();
        $onBoard->setSalutation($outlet->getSalutation());
        $onBoard->setFirstName($outlet->getFirstName());
        $onBoard->setLastName($outlet->getLastName());
        $onBoard->setEmail($outlet->getEmail());
        $onBoard->setMobile($outlet->getMobile());
        $onBoard->setGender($outlet->getGender());
        $onBoard->setDateOfBirth($outlet->getDateOfBirth());
        $onBoard->setMaritalStatus($outlet->getMaritalStatus());
        $onBoard->setDateOfAnniversary($outlet->getDateOfAnniversary());
        $onBoard->setQualification($outlet->getQualification());
        $onBoard->setRegistrationNo($outlet->getRegistrationNo());
        $onBoard->setProfilePic($outlet->getProfilePic());
        $onBoard->setStatus($outlet->getStatus());
        $onBoard->setTerritory($outlet->getTerritory());
        $onBoard->setPosition($outlet->getPosition());
        $onBoard->setCreatedByEmployeeId($outlet->getCreatedByEmployeeId());
        $onBoard->setCreatedByPositionId($outlet->getCreatedByPositionId());
        $onBoard->setCompanyId($outlet->getCompanyId());
        $onBoard->setOutletTypeId($outlet->getOutletTypeId());
        $onBoard->setOutletName($outlet->getOutletName());
        $onBoard->save();

        $this->createLog($onBoard->getOnBoardRequestId(), 1, $onBoard->getCreatedByEmployeeId(), $onBoard->getCreatedByPositionId(), "OnBoard request created successfully!");

        $position = \entities\PositionsQuery::create()
            ->filterByPositionId($outlet->getPosition())
            ->findOne();
        if ($onBoard != null) {
            $employeeId = $outlet->getCreatedByEmployeeId();
            $title = 'Request Created';
            $message = 'Request created successfully!';
            NotificationManager::sendNotificationToEmployee($employeeId, $title, $message, $data = []);
        }
        return $onBoard;
    }

    public function updateRequest(OnBoardRequest $outlet)
    {
        $onBoard = \entities\OnBoardRequestQuery::create()
            ->filterByOnBoardRequestId($outlet->getOnBoardRequestId())
            ->findOne();

        if ($onBoard != null) {
            $onBoard->setSalutation($outlet->getSalutation());
            $onBoard->setFirstName($outlet->getFirstName());
            $onBoard->setLastName($outlet->getLastName());
            $onBoard->setEmail($outlet->getEmail());
            $onBoard->setMobile($outlet->getMobile());
            $onBoard->setGender($outlet->getGender());
            $onBoard->setDateOfBirth($outlet->getDateOfBirth());
            $onBoard->setMaritalStatus($outlet->getMaritalStatus());
            $onBoard->setDateOfAnniversary($outlet->getDateOfAnniversary());
            $onBoard->setQualification($outlet->getQualification());
            $onBoard->setRegistrationNo($outlet->getRegistrationNo());
            $onBoard->setProfilePic($outlet->getProfilePic());
            $onBoard->setStatus($onBoard->getStatus());
            $onBoard->setUpdatedByEmployeeId($outlet->getUpdatedByEmployeeId());
            $onBoard->setUpdatedByPositionId($outlet->getUpdatedByPositionId());
            $onBoard->setCompanyId($outlet->getCompanyId());
            $onBoard->setOutletTypeId($outlet->getOutletTypeId());
            $onBoard->setOutletName($outlet->getOutletName());
            $onBoard->save();

            $this->createLog($onBoard->getOnBoardRequestId(), 1, $onBoard->getUpdatedByEmployeeId(), $onBoard->getUpdatedByPositionId(), "Request updated successfully!");

            return $onBoard;
        }
    }

    public function changeStatus($id, $status, $employee, $description = null)
    {
        $onBoardReq = \entities\OnBoardRequestQuery::create()
            ->filterByOnBoardRequestId($id)
            ->findOne();

        if (isset($onBoardReq)) {
            $onBoardReq->setStatus($status);
            $onBoardReq->setDescriptioin($description);
            $onBoardReq->setUpdatedByEmployeeId($employee->getEmployeeId());
            $onBoardReq->setUpdatedByPositionId($employee->getPositionId());
            $onBoardReq->save();

            $position = \entities\PositionsQuery::create()
                ->filterByPositionId($employee->getPositionId())
                ->findOne();

            $reportingTo = \entities\EmployeeQuery::create()
                ->filterByPositionId($position->getReportingTo())
                ->findOne();

            if ($status == 2) {
                $this->createLog($onBoardReq->getOnBoardRequestId(), 3, $reportingTo->getEmployeeId(), $reportingTo->getPositionId(), "Pending to approve.!");
            }
            if ($description != null) {
                $this->createLog($onBoardReq->getOnBoardRequestId(), $status, $employee->getEmployeeId(), $employee->getPositionId(), $description);
            } else {
                $this->createLog($onBoardReq->getOnBoardRequestId(), $status, $employee->getEmployeeId(), $employee->getPositionId(), "Request status updated successfully!");
            }

            if ($onBoardReq != null) {
                $employeeId = $employee->getEmployeeId();
                $title = 'Request' . $status;
                $message = 'Request ' . $status . ' successfully!';
                NotificationManager::sendNotificationToEmployee($employeeId, $title, $message, $data = []);
            }
        }

        return $onBoardReq;
    }

    public function getPendingRequest($positionIds, $territoryId, $positionId, $employeeId)
    {

        $ownOnBoardRequests = \entities\OnBoardRequestQuery::create()
            ->filterByTerritory($territoryId)
            ->filterByStatus([1, 2])
            ->filterByCreatedByEmployeeId($employeeId)
            ->find()->toArray();

        $teamOnBoardRequests = \entities\OnBoardRequestQuery::create()
            ->filterByPosition($positionIds)
            ->filterByStatus(2);
        if ($territoryId != null && $territoryId != '') {
            $teamOnBoardRequests->filterByTerritory($territoryId);
        }
        $teamOnBoardRequests->filterByCreatedByEmployeeId($employeeId, Criteria::NOT_EQUAL);
        $teamData = $teamOnBoardRequests->find()->toArray();
        // $mergArray= array_merge($ownOnBoardRequests,$teamData);
        $mergArray = array_unique(array_merge($ownOnBoardRequests, $teamData), SORT_REGULAR);
        $resultData = array();
        if (count($mergArray) > 0) {
            foreach ($mergArray as $outlet) {
                $onBoardAdd = \entities\OnBoardRequestAddressQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOnBoardRequestId($outlet["OnBoardRequestId"])
                    ->find()->toArray();
                $specialityArray = array();
                foreach ($onBoardAdd as $onBoardAd) {
                    if (isset($onBoardAd["Speciality"]) && !empty($onBoardAd["Speciality"])) {
                        $specialityExplode = array_filter(explode(',', $onBoardAd["Speciality"]));
                        if (!empty($specialityExplode)) {
                            $specialityArray = \entities\ClassificationQuery::create()
                                ->filterById($specialityExplode)
                                ->find()->toArray();
                        }
                    }
                }
                $result = [
                    'OnBoardRequestId' => $outlet["OnBoardRequestId"],
                    'OutletId' => $outlet["OutletId"],
                    'Salutation' => $outlet["Salutation"],
                    'FirstName' => $outlet["FirstName"],
                    'LastName' => $outlet["LastName"],
                    'Email' => $outlet["Email"],
                    'Mobile' => $outlet["Mobile"],
                    'Gender' => $outlet["Gender"],
                    'DateOfBirth' => $outlet["DateOfBirth"],
                    'MaritalStatus' => $outlet["MaritalStatus"],
                    'DateOfAnniversary' => $outlet["DateOfAnniversary"],
                    'Qualification' => $outlet["Qualification"],
                    'RegistrationNo' => $outlet["RegistrationNo"],
                    'Status' => $outlet["Status"],
                    'ProfilePic' => $outlet["ProfilePic"],
                    'OutletTypeId' => $outlet["OutletTypeId"],
                    'OutletName' => $outlet["OutletName"],
                    'CreatedBy' => $outlet["CreatedByEmployeeId"],
                    'Speciaality' => $specialityArray,
                    'Address' => $onBoardAdd,
                ];
                array_push($resultData, $result);
            }
        }

        return $resultData;
    }

    public function deleteRequest()
    {
        //
    }

    public function getOutletMapping($id)
    {
        $outletMapping = \entities\OutletMappingQuery::create()
            ->filterByPrimaryOutletId($id)
            ->find()->toArray();

        return $outletMapping;
    }

    public function getOnBoardMapping($id)
    {
        $onBoardRequestMapping = \entities\OnBoardRequestOutletMappingQuery::create()
            ->filterByOnBoardRequestId($id)
            ->find()->toArray();

        return $onBoardRequestMapping;
    }

    public function createLog($requestId, $status, $employeeId, $positionId, $description)
    {
        $request = \entities\OnBoardRequestLogQuery::create()
            ->filterByOnBoardRequestId($requestId)
            ->orderByOnBoardRequestLogId('DESC')
            ->findOne();

        if ($request == null && $request == '') {
            $fromStatus = isset($status) ? $status : 1;
        } else {
            $fromStatus = $request->getOnBoardRequestToStatusId();
        }

        $log = new \entities\OnBoardRequestLog();
        $log->setOnBoardRequestId($requestId);
        $log->setOnBoardRequestFromStatusId($fromStatus);
        $log->setOnBoardRequestToStatusId($status);
        $log->setEmployeeId($employeeId);
        $log->setEmployeePositionId($positionId);
        $log->setDescription($description);
        $log->save();
    }

    public function createCustomerFromRequest()
    {
        echo "Checking for new onboard request... : Start" . PHP_EOL;

        // check if FTP file processing
        $checkFile = FtpImportLogsQuery::create()
                        ->useFtpImportBatchesExistsQuery()
                            ->filterByAttachedFunction('importOutletOrgData')
                        ->endUse()
                        ->filterByIsFileProcessed(0)
                        ->filterByIsFileProcessing(true)
                        ->find()->count();
        if ($checkFile) {
            echo "FTP file work in progress ... " . PHP_EOL;
            return false;
        }
        
        $onBoardReqs = \entities\OnBoardRequestQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithOnBoardRequestAddress()
            ->leftJoinWithOnBoardRequestOutletMapping()
            ->leftJoinWithOnBoardRequestLog()
            ->filterByStatus(6)
            ->find()->toArray();
            
        echo "OnBoard request count is " . count($onBoardReqs) . PHP_EOL;

        if (count($onBoardReqs) > 0) {
            foreach ($onBoardReqs as $onBoardReq) {

                echo $onBoardReq['OnBoardRequestId'] . " -----------------------" . PHP_EOL;
                
                $outlet = \entities\OutletsQuery::create()
                    ->filterById($onBoardReq["OutletId"])
                   /* ->_or()
                    ->filterByOutletContactNo($onBoardReq["Mobile"])
                    ->filterByOutlettypeId($onBoardReq["OutletTypeId"])*/
                    ->findOne();
                
                $outletContactFirstName = isset($onBoardReq["FirstName"]) ? $onBoardReq["FirstName"] : null;
                $outletContactLastName = isset($onBoardReq["LastName"]) ? $onBoardReq["LastName"] : null;
                $outletContactPersonName = $outletContactFirstName . '' . $outletContactLastName;
                if ($onBoardReq["MaritalStatus"] == 'Married') {
                    $marital = 'M';
                } else {
                    $marital = 'S';
                }
                if (isset($onBoardReq["OutletName"]) && $onBoardReq["OutletName"] != null) {
                    $outletName = $onBoardReq["OutletName"];
                } else {
                    $outletName = $outletContactPersonName;
                }
                if (isset($onBoardReq["OnBoardRequestAddresses"][0]["Itownid"]) && $onBoardReq["OnBoardRequestAddresses"][0]["Itownid"] != null) {
                    $outletTownId = $onBoardReq["OnBoardRequestAddresses"][0]["Itownid"];
                } else {
                    $outletTownId = null;
                }
                if (isset($onBoardReq["OnBoardRequestAddresses"][0]) && isset($onBoardReq["OnBoardRequestAddresses"][0]["Speciality"]) && $onBoardReq["OnBoardRequestAddresses"][0]["Speciality"] != null) {
                    $specialityId = $onBoardReq["OnBoardRequestAddresses"][0]["Speciality"];
                }else{
                    $specialityId = null;
                }

                try{
                    if($outlet == null && $outlet == ''){
                        $outlet = new \entities\Outlets();
                        $outletCode = $this->generateLagacyCode($onBoardReq);

                        $outlet->setOutletName($outletName);
                        $outlet->setOutletCode($outletCode);
                        $outlet->setOutletEmail(isset($onBoardReq["Email"]) ? $onBoardReq["Email"] : null);
                        $outlet->setOutletSalutation(isset($onBoardReq["Salutation"]) ? $onBoardReq["Salutation"] : null);
                        $outlet->setOutletClassification($specialityId);
                        $outlet->setOutletContactName($outletContactPersonName);
                        $outlet->setOutletContactBday(isset($onBoardReq["DateOfBirth"]) ? $onBoardReq["DateOfBirth"] : null);
                        $outlet->setOutletContactAnniversary(isset($onBoardReq["DateOfAnniversary"]) ? $onBoardReq["DateOfAnniversary"] : null);
                        $outlet->setOutletIsdCode('+91');
                        $outlet->setOutletContactNo(isset($onBoardReq["Mobile"]) ? $onBoardReq["Mobile"] : null);
                        $outlet->setOutletStatus('active');
                        $outlet->setOutlettypeId(isset($onBoardReq["OutletTypeId"]) ? $onBoardReq["OutletTypeId"] : null);
                        $outlet->setCompanyId(isset($onBoardReq["CompanyId"]) ? $onBoardReq["CompanyId"] : null);
                        $outlet->setOutletCreatedBy(isset($onBoardReq["CreatedByEmployeeId"]) ? $onBoardReq["CreatedByEmployeeId"] : null);
                        $outlet->setOutletApprovedBy(isset($onBoardReq["FinalApprovedByEmployeeId"]) ? $onBoardReq["FinalApprovedByEmployeeId"] : null);
                        $outlet->setItownid($outletTownId);
                        $outlet->setOutletQualification(isset($onBoardReq["Qualification"]) ? $onBoardReq["Qualification"] : null);
                        $outlet->setOutletRegno(isset($onBoardReq["RegistrationNo"]) ? $onBoardReq["RegistrationNo"] : null);
                        $outlet->setOutletMaritalStatus($marital);
                        $outlet->setOutletMediaId(isset($onBoardReq["ProfilePic"]) ? $onBoardReq["ProfilePic"] : null);
                        $outlet->save();
                    }

                    $onBoardReqs = \entities\OnBoardRequestQuery::create()
                        ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                        ->findOne();
                    $onBoardReqs->setOutletId($outlet->getId());
                    $onBoardReqs->setStatus(10);
                    $onBoardReqs->save();

                    echo "OnBoard request outlet id is " . $outlet->getId() . PHP_EOL;

                    if ($outlet->getId() != null && $outlet->getId() != '') {
                        if (isset($onBoardReq["OnBoardRequestAddresses"]) && $onBoardReq["OnBoardRequestAddresses"] != null) {
                            foreach ($onBoardReq["OnBoardRequestAddresses"] as $outletOrgData) {

                                if (isset($outletOrgData["Icityid"]) && $outletOrgData["Icityid"] != null) {
                                    $icity = \entities\GeoCityQuery::create()
                                        ->filterByIcityid($outletOrgData["Icityid"])
                                        ->findOne();
                                    $city =  $icity->getScityname();
                                } else {
                                    $city =  null;
                                }
                                if (isset($outletOrgData["Istateid"]) && $outletOrgData["Istateid"] != null) {
                                    $istate = \entities\GeoStateQuery::create()
                                        ->filterByIstateid($outletOrgData["Istateid"])
                                        ->findOne();
                                    $state =  $istate->getSstatename();
                                } else {
                                    $state =  null;
                                }  
                                if (isset($outletOrgData["Address"]) && $outletOrgData["Address"] != null) {
                                    $outletadd = $outletOrgData["Address"];
                                } else {
                                    $outletadd =  null;
                                }
                                if (isset($outletOrgData["Landmark"]) && $outletOrgData["Landmark"] != null) {
                                    $outletlandmark = $outletOrgData["Landmark"];
                                } else {
                                    $outletlandmark =  null;
                                }
                                if (isset($outletOrgData["Pincode"]) && $outletOrgData["Pincode"] != null) {
                                    $outletpincode = $outletOrgData["Pincode"];
                                } else {
                                    $outletpincode =  null;
                                }
                                if (isset($outletOrgData["Itownid"]) && $outletOrgData["Itownid"] != null) {
                                    $outletitownid = $outletOrgData["Itownid"];
                                } else {
                                    $outletitownid =  null;
                                }
                                if (isset($outletOrgData["CompanyId"]) && $outletOrgData["CompanyId"] != null) {
                                    $outletcomid = $outletOrgData["CompanyId"];
                                } else {
                                    $outletcomid =  null;
                                }
                                if(isset($outletOrgData["OutletSubTypeId"]) && $outletOrgData["OutletSubTypeId"] != null && $outletOrgData["OutletSubTypeId"] != ''){
                                    $type = $outletOrgData["OutletSubTypeId"];
                                }else{
                                    if($outlet->getOutlettypeId() == 194){
                                        $type = 201;
                                    }else if($outlet->getOutlettypeId() == 195){
                                        $type = 195;
                                    }
                                    
                                }
                                $outletSubType = \entities\OutletTypeQuery::create()
                                    ->filterByOutlettypeId($type)
                                    ->findOne();
                                $outletType = $outletSubType->getOutlettypeName();

                                $address = \entities\OutletAddressQuery::create()
                                    ->filterByItownid($outletOrgData["Itownid"])
                                    ->filterByAddressName($outletType, Criteria::LIKE)
                                    ->filterByOutletId($outlet->getId())
                                    ->findOne();

                                if($address == null){
                                    $address = new \entities\OutletAddress();
                                    $address->setOutletAddress($outletadd);
                                    $address->setOutletStreetName($outletlandmark);
                                    $address->setOutletCity($city);
                                    $address->setOutletState($state);
                                    $address->setOutletPincode($outletpincode);
                                    $address->setOutletId($outlet->getId());
                                    $address->setCompanyId($outletcomid);
                                    $address->setAddressName($outletType);
                                    $address->setItownid($outletitownid);
                                    $address->save();
                                }else{
                                    $address->setOutletAddress($outletadd);
                                    $address->setOutletStreetName($outletlandmark);
                                    $address->setOutletCity($city);
                                    $address->setOutletState($state);
                                    $address->setOutletPincode($outletpincode);
                                    $address->setAddressName($outletType);
                                    $address->setItownid($outletitownid);
                                    $address->save();
                                }
                                
                                
                                if (isset($outletOrgData["Tags"]) && $outletOrgData["Tags"] != null) {
                                    $outlettag = \entities\OutletTagsQuery::create()
                                        ->filterByOutletTagId($outletOrgData["Tags"])
                                        ->findOne();
                                    $tags =  $outlettag->getTagName();
                                } else {
                                    $tags =  $outletOrgData["Tags"];
                                } 
                                if (isset($outletOrgData["FocusBrand"]) && $outletOrgData["FocusBrand"] != null) {
                                    $focusBrands = \entities\BrandsQuery::create()
                                        ->filterByBrandId($outletOrgData["FocusBrand"])
                                        ->findOne();
                                    $focusBrand =  $focusBrands->getBrandName();
                                } else {
                                    $focusBrand =  $outletOrgData["FocusBrand"];
                                }  
                                if (isset($outletOrgData["OrgUnitId"]) && $outletOrgData["OrgUnitId"] != null) {
                                    $orgunit = $outletOrgData["OrgUnitId"];
                                } else {
                                    $orgunit = null;
                                }
                                if (isset($outletOrgData["VisitFrequency"])  && $outletOrgData["VisitFrequency"] != null) {
                                    $visitFrequency = $outletOrgData["VisitFrequency"];
                                } else {
                                    $visitFrequency =  0;
                                }
                                if (isset($outletOrgData["Potential"])  && $outletOrgData["Potential"] != null) {
                                    $potential = $outletOrgData["Potential"];
                                } else {
                                    $potential =  0;
                                }
                                if (isset($outletOrgData["CompanyId"])  && $outletOrgData["CompanyId"] != null) {
                                    $companyId = $outletOrgData["CompanyId"];
                                } else {
                                    $companyId =  9;
                                }
                                if (isset($outletOrgData["Itownid"])  && $outletOrgData["Itownid"] != null) {
                                    $itownid = $outletOrgData["Itownid"];
                                } else {
                                    $itownid =  $outletOrgData["Itownid"];
                                }

                                $outletOrg = \entities\OutletOrgDataQuery::create()
                                            ->filterByOutletId($outlet->getId())
                                            ->filterByDefaultAddress($address->getOutletAddressId())
                                            ->filterByOrgUnitId($orgunit)
                                            ->findOne();

                                            
                                if($outletOrg == null){
                                    if ($orgunit != null && $orgunit != '') {
                                        $pcode = $this->generatePCode($companyId);

                                        $existPcode = \entities\OutletOrgDataQuery::create()
                                                        ->filterByOutletOrgCode($pcode)
                                                        ->findOne();

                                        if($existPcode != null && $existPcode->getOutletOrgCode() != null){
                                            $onBoardReqs = \entities\OnBoardRequestQuery::create()
                                                ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                                                ->findOne();
                                            $onBoardReqs->setStatus(9);
                                            $onBoardReqs->save();
                                            $this->createLog($onBoardReq['OnBoardRequestId'], 9, $onBoardReqs->getCreatedByEmployeeId(), $onBoardReqs->getCreatedByPositionId(), "Outlet P-Code already exists!");
                                        }else{
                                            if($pcode != false){
                                                $outletOrg = new \entities\OutletOrgData();
                                                $outletOrg->setOutletId($outlet->getId());
                                                $outletOrg->setOrgUnitId($orgunit);
                                                $outletOrg->setTags($tags);
                                                $outletOrg->setVisitFq($visitFrequency);
                                                $outletOrg->setOrgPotential($potential);
                                                $outletOrg->setBrandFocus($focusBrand);
                                                $outletOrg->setCompanyId($companyId);
                                                $outletOrg->setItownid($itownid);
                                                $outletOrg->setDefaultAddress($address->getOutletAddressId());
                                                $outletOrg->setOutletOrgCode($pcode);
                                                $outletOrg->save();
                                            }
                                        }
                                    }
                                }else{
                                    if ($orgunit != null && $orgunit != '') {
                                        $outletOrg->setTags($tags);
                                        $outletOrg->setVisitFq($visitFrequency);
                                        $outletOrg->setOrgPotential($potential);
                                        $outletOrg->setBrandFocus($focusBrand);
                                        $outletOrg->setItownid($itownid);
                                        $outletOrg->setDefaultAddress($address->getOutletAddressId());
                                        $outletOrg->save();
                                    }
                                }

                                if(isset($outletOrgData["Status"]) && $outletOrgData["Status"] != null && $outletOrgData["Status"] == 'Delete'){
                                    $outletBeatsDelete = \entities\BeatOutletsQuery::create()
                                            ->filterByBeatOrgOutlet($outletOrg->getOutletOrgId())
                                            ->findOne();
                                    if($outletBeatsDelete != null){
                                        $outletBeatsDelete->delete();
                                    }

                                    $outletOrg->delete();
                                }
                                
                                if ($outletOrg->getOutletOrgId() != null) {
                                    if (isset($outletOrgData['BeatId'])) {
                                        $outletBeatsDelete = \entities\BeatOutletsQuery::create()
                                            ->filterByBeatOrgOutlet($outletOrg->getOutletOrgId())
                                            ->findOne();
                                        if($outletBeatsDelete != null){
                                            $outletBeatsDelete->delete();
                                        }
                                            
                                        $outletBeats = \entities\BeatOutletsQuery::create()
                                            ->filterByBeatId($outletOrgData['BeatId'])
                                            ->filterByBeatOrgOutlet($outletOrg->getOutletOrgId())
                                            ->findOne();
                                        if ($outletBeats == null) {
                                            $outletBeats = new \entities\BeatOutlets();
                                        }
                                        $outletBeats->setBeatId($outletOrgData['BeatId']);
                                        $outletBeats->setCompanyId($companyId);
                                        $outletBeats->setBeatOrgOutlet($outletOrg->getOutletOrgId());
                                        $outletBeats->save();
                                    }
                                }
                            }
                        }else{
                            $onBoardReqs = \entities\OnBoardRequestQuery::create()
                                        ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                                        ->findOne();
                                    $onBoardReqs->setStatus(9);
                                    $onBoardReqs->save();
                                    $this->createLog($onBoardReq['OnBoardRequestId'], 9, $onBoardReqs->getCreatedByEmployeeId(), $onBoardReqs->getCreatedByPositionId(), "OnBoard request address not found!");
                        }
                        if (count($onBoardReq["OnBoardRequestOutletMappings"]) > 0) {
                            foreach ($onBoardReq["OnBoardRequestOutletMappings"] as $outletMapping) {
                                try {
                                    if (!empty($outletMapping) && $outletMapping["PrimaryOutletId"] != null) {
                                        if ($outletMapping["PrimaryOutletId"] == $outletMapping["OnBoardRequestId"]) {
                                            $primaryOutletId = $outlet->getId();
                                        } else {
                                            $primaryOutletId = $outletMapping["PrimaryOutletId"];
                                        }
                                        if ($outletMapping["SecondaryOutletId"] == $outletMapping["OnBoardRequestId"]) {
                                            $secondaryOutletId = $outlet->getId();
                                        } else {
                                            $secondaryOutletId = $outletMapping["SecondaryOutletId"];
                                        }
                                        $outMapping = \entities\OutletMappingQuery::create()
                                            ->filterByPrimaryOutletId($primaryOutletId)
                                            ->filterBySecondaryOutletId($secondaryOutletId)
                                            ->filterByPricebookId($outletMapping["PricebookId"])
                                            ->findOne();
                                        if ($outMapping == null && $outMapping == '') {
                                            $outMapping = new \entities\OutletMapping();
                                        }
                                        if (isset($outletMapping["Category"]) && $outletMapping["Category"] != null) {
                                            $categoryType = $outletMapping["Category"];
                                        } else {
                                            $categoryType =  'Regular';
                                        }
                                        $outMapping->setPrimaryOutletId($primaryOutletId);
                                        $outMapping->setSecondaryOutletId($secondaryOutletId);
                                        $outMapping->setPricebookId($outletMapping["PricebookId"]);
                                        $outMapping->setIsdefault(0);
                                        $outMapping->setCategoryType($categoryType);
                                        $outMapping->save();
                                    }
                                } catch (Exception $e) {
                                    $onBoardReqs = \entities\OnBoardRequestQuery::create()
                                        ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                                        ->findOne();
                                    $onBoardReqs->setStatus(9);
                                    $onBoardReqs->save();
                                    $this->createLog($onBoardReq['OnBoardRequestId'], 9, $onBoardReqs->getCreatedByEmployeeId(), $onBoardReqs->getCreatedByPositionId(), $e->getPrevious()->getMessage());
                                }
                            }
                        } else {
                            $onBoardReqs = \entities\OnBoardRequestQuery::create()
                                        ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                                        ->findOne();
                                    $onBoardReqs->setStatus(9);
                                    $onBoardReqs->save();
                                    $this->createLog($onBoardReq['OnBoardRequestId'], 9, $onBoardReqs->getCreatedByEmployeeId(), $onBoardReqs->getCreatedByPositionId(), "OnBoard request outlet mapping not found!");
                        }
                    }else{
                        echo "OutletId not found!". PHP_EOL;
                    }
                }catch (\Exception $e) {
                    $onBoardReqs = \entities\OnBoardRequestQuery::create()
                        ->filterByOnBoardRequestId($onBoardReq['OnBoardRequestId'])
                        ->findOne();
                    $onBoardReqs->setStatus(9);
                    $onBoardReqs->save();
                    $this->createLog($onBoardReq['OnBoardRequestId'], 9, $onBoardReqs->getCreatedByEmployeeId(), $onBoardReqs->getCreatedByPositionId(), $e->getPrevious()->getMessage());
                }

                $classificationUpdate = \entities\OutletsQuery::create()
                                                    ->filterByOutletClassification(null)
                                                    ->update(array('OutletClassification' => 579));
            }
        }

        echo "Checking for new onboard request... : end" . PHP_EOL;
    }

    function generateLagacyCode($request)
    {
        $outletType = \entities\OutletTypeQuery::create()
            ->findPk($request["OutletTypeId"]);
        $first_character_outlet_type = mb_substr($outletType->getOutlettypeName(), 0, 1);
        $currentYear =  date('Y');
        $year = substr($currentYear, -2);

        $employee = \entities\EmployeeQuery::create()
            ->findPk($request["CreatedByEmployeeId"]);

        $stateCode = "";
        if (!empty($employee) && $employee->getItownid() != null && $employee->getItownid() != '') {
            $geoTown = \entities\GeoTownsQuery::create()
                ->leftJoinWithGeoCity()
                ->filterByItownid($employee->getItownid())
                ->findOne();
            if ($geoTown != null && $geoTown != '') {
                if($geoTown->getGeoCity() != null && $geoTown->getGeoCity()->getGeoState() != null && $geoTown->getGeoCity()->getGeoState()->getSstatename() != null){
                    $stateName = $geoTown->getGeoCity()->getGeoState()->getSstatename();
                }else{
                    $stateName = 'Alembic';
                }
                $stateCode = mb_substr($stateName, 0, 3);
            }
        }

        $company = \entities\CompanyQuery::create()
            ->filterByCompanyId($request["CompanyId"])
            ->findOne();
        $current_idx = $company->getOrderSeq();
        $newIdx = $current_idx + 1;
        $company->setOrderSeq($newIdx);
        $company->save();

        $reqNo = str_pad((string)$newIdx, 5, '0', STR_PAD_LEFT);

        $code = 'AL-' . $first_character_outlet_type . '-' . $year . '-' . $stateCode . '-' . $reqNo;

        return $code;
    }

    public function generatePCode($request){
        if($request == null && $request == ''){
            $request = 9;
        }
        $company = \entities\CompanyQuery::create()
            ->filterByCompanyId($request)
            ->findOne();
        $current_idx = $company->getShippingorderSeq();
        $newIdx = $current_idx + 1;
        $company->setShippingorderSeq($newIdx);

        if($company->save()){
            $code = $company->getShippingorderSeq();
            return $code;
        }else{
            return false;
        }
        
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function beatCorrection(){
        $beatCorrection = \entities\BeatCorrectionQuery::create()
                                ->filterByStatus(null)
                                ->_or()
                                ->filterByStatus(0)
                                ->find();
        foreach($beatCorrection as $beatCorrect){
            $territory = \entities\TerritoriesQuery::create()
                            ->filterByTerritoryName($beatCorrect->getObraUnitName(),Criteria::LIKE)
                            ->filterByOrgunitid($beatCorrect->getBeatOrgUnitId())
                            ->findOne();
            if($territory != null){
                $territoryId = $territory->getTerritoryId();

                $beat = \entities\BeatsQuery::create()
                            ->filterByTerritoryId($territoryId)
                            ->filterByBeatName($beatCorrect->getCorrectBeatName(),Criteria::LIKE)
                            ->filterByOrgUnitId($beatCorrect->getBeatOrgUnitId())
                            ->findOne();

                if($beat == null && $beat == ''){
                    $beatCorrect->setStatus(0);
                    $beatCorrect->save();
                }else{
                    $beatCorrect->setStatus(1);
                    $beatCorrect->save();

                    $beatOutlets = \entities\BeatOutletsQuery::create()
                                    ->filterByBeatOrgOutlet($beatCorrect->getOnBoardRequestAddressId())
                                    ->findOne();
                    $beatOutlets->setBeatId($beat->getBeatId());
                    $beatOutlets->save();

                    echo "OnBoard request id".$beatOutlets->getBeatOrgOutlet() . PHP_EOL;
                }

                
            }
        }
        // foreach($beatCorrection as $beatCorrect){
        //     $beat = \entities\BeatsQuery::create()
        //                 ->filterByTerritoryId($beatCorrect->getTerritory())
        //                 ->filterByBeatName($beatCorrect->getCorrectBeatName(),Criteria::LIKE)
        //                 ->findOne();
        //     if($beat == null && $beat == ''){
        //         $beatCorrect->setStatus(0);
        //         $beatCorrect->save();
        //     }else{
        //         $beatCorrect->setStatus(1);
        //         $beatCorrect->setBeatOrgUnitId($beat->getOrgUnitId());
        //         $beatCorrect->save();

        //         $obra = \entities\OnBoardRequestAddressQuery::create()
        //                 ->filterByOnBoardRequestAddressId($beatCorrect->getOnBoardRequestAddressId())
        //                 ->findOne();
        //         $obra->setBeatId($beat->getBeatId());
        //         $obra->save();

        //         $obr = \entities\OnBoardRequestQuery::create()
        //                     ->filterByOnBoardRequestId($obra->getOnBoardRequestId())
        //                     ->findOne();
        //         $obr->setStatus(6);
        //         $obr->save();
        //         echo "OnBoard request id".$obra->getOnBoardRequestId() . PHP_EOL;
        //     }
            
        // }
        
    }
}

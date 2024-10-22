<?php

namespace BI\requests;

use DateTime;

/**
 * Description of On Board Request
 *
 * @author UdayPatel
 */
class OnBoardRequest {

    var $OnBoardRequestId;
    var $OutletId;
    var $Salutation;
    var $FirstName;
    var $LastName;
    var $Email;
    var $Mobile;
    var $Gender;
    var $DateOfBirth;
    var $MaritalStatus;
    var $DateOfAnniversary;
    var $Qualification;
    var $RegistrationNo;
    var $ProfilePic;
    var $Status;
    var $Territory;
    var $Position;
    var $CreatedAt;
    var $CreatedByEmployeeId;
    var $CreatedByPositionId;
    var $UpdatedAt;
    var $UpdatedByEmployeeId;
    var $UpdatedByPositionId;
    var $ApprovedAt;
    var $ApprovedByEmployeeId;
    var $ApprovedByPositionId;
    var $FinalApprovedAt;
    var $FinalApprovedByEmployeeId;
    var $FinalApprovedByPositionId;
    var $CompanyId;
    var $Descriptioin;
    var $OutletTypeId;
    var $OutletName;

    public function getOutletId() {
        return $this->OutletId;
    }

    public function getSalutation() {
        return $this->Salutation;
    }

    public function getFirstName() {
        return $this->FirstName;
    }

    public function getLastName() {
        return $this->LastName;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getMobile() {
        return $this->Mobile;
    }

    public function getGender() {
        return $this->Gender;
    }

    public function getDateOfBirth() {
        return $this->DateOfBirth;
    }

    public function getMaritalStatus() {
        return $this->MaritalStatus;
    }

    public function getDateOfAnniversary() {
        return $this->DateOfAnniversary;
    }

    public function getQualification() {
        return $this->Qualification;
    }

    public function getRegistrationNo() {
        return $this->RegistrationNo;
    }

    public function getProfilePic() {
        return $this->ProfilePic;
    }

    public function getStatus() {
        return $this->Status;
    }

    public function getTerritory() {
        return $this->Territory;
    }

    public function getPosition() {
        return $this->Position;
    }

    public function getCreatedAt() {
        return $this->CreatedAt;
    }

    public function getCreatedByEmployeeId() {
        return $this->CreatedByEmployeeId;
    }

    public function getCreatedByPositionId() {
        return $this->CreatedByPositionId;
    }

    public function getUpdatedAt() {
        return $this->UpdatedAt;
    }

    public function getUpdatedByEmployeeId() {
        return $this->UpdatedByEmployeeId;
    }

    public function getUpdatedByPositionId() {
        return $this->UpdatedByPositionId;
    }

    public function getApprovedAt() {
        return $this->ApprovedAt;
    }

    public function getApprovedByEmployeeId() {
        return $this->ApprovedByEmployeeId;
    }

    public function getApprovedByPositionId() {
        return $this->ApprovedByPositionId;
    }

    public function getFinalApprovedAt() {
        return $this->FinalApprovedAt;
    }

    public function getFinalApprovedByEmployeeId() {
        return $this->FinalApprovedByEmployeeId;
    }

    public function getFinalApprovedByPositionId() {
        return $this->FinalApprovedByPositionId;
    }

    public function getCompanyId() {
        return $this->CompanyId;
    }

    public function getDescriptioin() {
        return $this->Descriptioin;
    }

    public function getOutletTypeId() {
        return $this->OutletTypeId;
    }

    public function getOutletName() {
        return $this->OutletName;
    }

    public function getOnBoardRequestId() {
        return $this->OnBoardRequestId;
    }

    public function setOnBoardRequestId($OnBoardRequestId) {
        $this->OnBoardRequestId = $OnBoardRequestId;
    }

    public function setOutletName($OutletName) {
        $this->OutletName = $OutletName;
    }

    public function setOutletId($OutletId) {
        $this->OutletId = $OutletId;
    }

    public function setSalutation($Salutation) {
        $this->Salutation = $Salutation;
    }

    public function setFirstName($FirstName) {
        $this->FirstName = $FirstName;
    }

    public function setLastName($LastName) {
        $this->LastName = $LastName;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setMobile($Mobile) {
        $this->Mobile = $Mobile;
    }

    public function setGender($Gender) {
        $this->Gender = $Gender;
    }

    public function setDateOfBirth($DateOfBirth) {
        $this->DateOfBirth = $DateOfBirth;
    }

    public function setMaritalStatus($MaritalStatus) {
        $this->MaritalStatus = $MaritalStatus;
    }

    public function setDateOfAnniversary($DateOfAnniversary) {
        $this->DateOfAnniversary = $DateOfAnniversary;
    }

    public function setQualification($Qualification) {
        $this->Qualification = $Qualification;
    }

    public function setRegistrationNo($RegistrationNo) {
        $this->RegistrationNo = $RegistrationNo;
    }

    public function setProfilePic($ProfilePic) {
        $this->ProfilePic = $ProfilePic;
    }

    public function setStatus($Status) {
        $this->Status = $Status;
    }

    public function setTerritory($Territory) {
        $this->Territory = $Territory;
    }

    public function setPosition($Position) {
        $this->Position = $Position;
    }

    public function setCreatedAt($CreatedAt) {
        $this->CreatedAt = $CreatedAt;
    }

    public function setCreatedByEmployeeId($CreatedByEmployeeId) {
        $this->CreatedByEmployeeId = $CreatedByEmployeeId;
    }

    public function setCreatedByPositionId($CreatedByPositionId) {
        $this->CreatedByPositionId = $CreatedByPositionId;
    }

    public function setUpdatedAt($UpdatedAt) {
        $this->UpdatedAt = $UpdatedAt;
    }

    public function setUpdatedByEmployeeId($UpdatedByEmployeeId) {
        $this->UpdatedByEmployeeId = $UpdatedByEmployeeId;
    }

    public function setUpdatedByPositionId($UpdatedByPositionId) {
        $this->UpdatedByPositionId = $UpdatedByPositionId;
    }

    public function setApprovedAt($ApprovedAt) {
        $this->ApprovedAt = $ApprovedAt;
    }

    public function setApprovedByEmployeeId($ApprovedByEmployeeId) {
        $this->ApprovedByEmployeeId = $ApprovedByEmployeeId;
    }

    public function setApprovedByPositionId($ApprovedByPositionId) {
        $this->ApprovedByPositionId = $ApprovedByPositionId;
    }

    public function setFinalApprovedAt($FinalApprovedAt) {
        $this->FinalApprovedAt = $FinalApprovedAt;
    }

    public function setFinalApprovedByEmployeeId($FinalApprovedByEmployeeId) {
        $this->FinalApprovedByEmployeeId = $FinalApprovedByEmployeeId;
    }

    public function setFinalApprovedByPositionId($FinalApprovedByPositionId) {
        $this->FinalApprovedByPositionId = $FinalApprovedByPositionId;
    }

    public function setCompanyId($CompanyId) {
        $this->CompanyId = $CompanyId;
    }

    public function setDescriptioin($Descriptioin) {
        $this->Descriptioin = $Descriptioin;
    }

    public function setOutletTypeId($OutletTypeId) {
        $this->OutletTypeId = $OutletTypeId;
    }
}

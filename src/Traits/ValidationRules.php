<?php

namespace App\Traits;

use entities\RolesQuery;
use entities\BranchQuery;
use entities\OrgUnitQuery;
use entities\EmployeeQuery;
use entities\GeoTownsQuery;
use entities\PositionsQuery;
use entities\GradeMasterQuery;
use entities\DesignationsQuery;
use DateTime;

trait ValidationRules {
    public $companyId;
    private $orgUnitListArray, $isSetOrgUnitList;
    private $positionListArray, $isSetPositionList;
    private $employeeListArray, $isSetEmployeeList;
    private $townListArray, $isSetTownList;
    private $roleListArray, $isSetRoleList;
    private $branchListArray, $isSetBranchList;
    private $gradeListArray, $isSetGradeList;
    private $designationListArray, $isSetDesignationList;

    public function __construct() {
        $this->companyId = null;
        $this->orgUnitListArray = $this->positionListArray = $this->employeeListArray = $this->townListArray = $this->roleListArray = $this->branchListArray = $this->gradeListArray = $this->designationListArray = [];
        $this->isSetOrgUnitList = $this->isSetPositionList = $this->isSetEmployeeList = $this->isSetTownList = $this->isSetRoleList = $this->isSetBranchList = $this->isSetGradeList = $this->isSetDesignationList = false;
    }

    private function getOrgUnitsArray() {
        if(!$this->isSetOrgUnitList) {
            echo "Start to get org unit array" . PHP_EOL;
            $orgUnitlist = OrgUnitQuery::create()
                                ->select(["Orgunitid"])
                                ->filterByCompanyId($this->companyId)
                                ->find()->toArray();

            foreach($orgUnitlist as $orgUnit) {
                $this->orgUnitListArray[$orgUnit] = $orgUnit;
                unset($orgUnit);
            }        
            unset($orgUnitlist);
            $this->isSetOrgUnitList = true;
            echo "End to get org unit array : " . count($this->orgUnitListArray) . PHP_EOL;
        }
        

        return $this->orgUnitListArray;
    }

    private function getPositionsArray() {
        if(!$this->isSetPositionList) {
            echo "Start to get positions array" . PHP_EOL;
            $positionlist = PositionsQuery::create()
                                ->select(["PositionId", "PositionCode", "OrgUnitId"])
                                ->filterByCompanyId($this->companyId)
                                ->find()->toArray();
        
            foreach($positionlist as $position) {
                $this->positionListArray[$position['PositionId']] = $position['PositionCode'] . '|' . $position['OrgUnitId'];
                unset($position);
            }        
            unset($positionlist);
            $this->isSetPositionList = true;
            echo "End to get positions array : " . count($this->positionListArray) . PHP_EOL;
        }
        
        return $this->positionListArray;
    }

    private function getEmployeesArray() {
        if(!$this->isSetEmployeeList) {
            echo "Start to get employee array" . PHP_EOL;
            $employeelist = EmployeeQuery::create()
                                ->select(["EmployeeId", "EmployeeCode"])
                                ->filterByCompanyId($this->companyId)
                                ->find()->toArray();

            foreach($employeelist as $employee) {
                $this->employeeListArray[$employee['EmployeeId']] = $employee['EmployeeCode'];
                unset($employee);
            }        
            unset($employeelist);
            $this->isSetEmployeeList = true;
            echo "End to get employee array : " . count($this->employeeListArray) . PHP_EOL;
        }

        return $this->employeeListArray;
    }

    private function getTownsArray() {
        if(!$this->isSetTownList) {
            echo "Start to get town array" . PHP_EOL;
            $townlist = GeoTownsQuery::create()
                ->select(["Itownid", "Stowncode"])
                ->filterBySstatus(1)
                ->find()->toArray();
        
            foreach($townlist as $town)
            {
                $this->townListArray[$town['Itownid']] = $town['Stowncode'];
                unset($town);
            }        
            unset($townlist);
            $this->isSetTownList = true;
            echo "End to get town array : " . count($this->townListArray) . PHP_EOL;
        }
        
        return $this->townListArray;
    }

    private function getRolesArray() {
        if(!$this->isSetRoleList) {
            echo "Start to get roles array" . PHP_EOL;
    
            $roleList = RolesQuery::create()
                ->select(["RoleId","RoleName"])
                ->find()->toArray();

            foreach($roleList as $role)
            {
                $this->roleListArray[$role['RoleId']] = $role['RoleName'];
                unset($role);
            }

            unset($roleList);
            $this->isSetRoleList = true;
            echo "End to get roles array : " . count($this->roleListArray) . PHP_EOL;
        }

        return $this->roleListArray;
    }

    private function getBranchesArray() {
        if(!$this->isSetBranchList) {
            echo "Start to get branches array" . PHP_EOL;
            $branchList = BranchQuery::create()
                ->select(["BranchId","Branchcode"])
                ->filterByCompanyId($this->companyId)
                ->find()->toArray();

            foreach($branchList as $branch)
            {
                $this->branchListArray[$branch['BranchId']] = $branch['Branchcode'];
                unset($branch);
            }

            unset($branchList);
            $this->isSetBranchList = true;
            echo "End to get branches array : " . count($this->branchListArray) . PHP_EOL;
        }

        return $this->branchListArray;
    }

    private function getGradesArray() {
        if(!$this->isSetGradeList) {
            echo "Start to get grades array" . PHP_EOL;
            $gradeList = GradeMasterQuery::create()
                ->select(["Gradeid","GradeName"])
                ->filterByCompanyId($this->companyId)
                ->find()->toArray();

            foreach($gradeList as $grade)
            {
                $this->gradeListArray[$grade['Gradeid']] = $grade['GradeName'];
                unset($grade);
            }

            unset($gradeList);
            $this->isSetGradeList = true;
            echo "End to get grades array : " . count($this->gradeListArray) . PHP_EOL;
        }

        return $this->gradeListArray;
    }

    private function getDesignationsArray() {
        if(!$this->isSetDesignationList) {
            echo "Start to get designation array" . PHP_EOL;
            $designationList = DesignationsQuery::create()
                ->select(["DesignationId","Designation"])
                ->filterByCompanyId($this->companyId)
                ->find()->toArray();

            foreach($designationList as $designation)
            {
                $this->designationListArray[$designation['DesignationId']] = $designation['Designation'];
                unset($designation);
            }

            unset($designationList);
            $this->isSetDesignationList = true;
            echo "End to get designations array : " . count($this->designationListArray) . PHP_EOL;
        }

        return $this->designationListArray;
    }

    public function hasValue($value) {
        return !empty($value) ? true : false;
    }

    public function checkRequiredFields($fields, $data) {
        $pass = true;

        foreach ($fields as $field) {
            if (!$this->hasValue($data[$field])) {
                $pass = false;
                break;
            }
        }

        return $pass;
    }

    public function getOrgUnitRecordByIdFromArray($id) {
        return array_search($id, $this->getOrgUnitsArray());
    }

    public function getPositionRecordByCodeFromArray($code, $orgUnitId) {
        $code = $code . '|' . $orgUnitId;
        return array_search($code, $this->getPositionsArray());
    }

    public function getEmployeeRecordByCodeFromArray($code) {
        return array_search($code, $this->getEmployeesArray());
    }

    public function getTownRecordByCodeFromArray($code) {
        return array_search($code, $this->getTownsArray());
    }

    public function getRoleRecordByCodeFromArray($name) {
        return array_search($name, $this->getRolesArray());
    }

    public function getBranchRecordByCodeFromArray($code) {
        return array_search($code, $this->getBranchesArray());
    }

    public function getGradeRecordByCodeFromArray($name) {
        return array_search($name, $this->getGradesArray());
    }

    public function getDesignationRecordByCodeFromArray($name) {
        return array_search($name, $this->getDesignationsArray());
    }

    public function isValidEmployeeStatus($status) {
        $employeeStatus = ['active', 'terminatted', 'terminated'];
        return in_array(strtolower($status), $employeeStatus) ? true : false;
    }

    private function validateDate($date, $format = 'd-m-Y') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
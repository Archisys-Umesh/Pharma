<?php

namespace App\Traits;

use entities\Users;
use entities\Employee;
use entities\Positions;
use entities\UsersQuery;
use entities\HrUserDates;
use entities\Designations;
use entities\EmployeeQuery;
use entities\PositionsQuery;
use entities\AttendanceQuery;
use entities\EmployeePositionHistory;
use entities\EmployeePositionHistoryQuery;
use entities\HrUserDatesQuery;
use Propel\Runtime\ActiveQuery\Criteria;

trait DataChangesOperations {
    public $companyId;
    
    use \App\Traits\ValidationRules;

    private function setDefaultResponseFormat() : Array {
        return ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];
    }

    private function setDefaultSuccessResponse($id = '') : Array {
        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $id];
    }

    private function addNewDesignation($designationName) {
        $record = new Designations();
        $record->setCompanyId($this->companyId);
        $record->setDesignation($designationName);
        $record->save();

        return $record->getPrimaryKey();
    }

    public function addOrUpdatePositionOperation($data) : Array {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['positionCode', 'positionName', 'orgunitid'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        $orgUnitId = $this->getOrgUnitRecordByIdFromArray($data['orgunitid']);
        if (empty($orgUnitId)) {
            $response['errorMessage'] = 'orgUnitId not found!';
            return $response;
        }

        if ($this->hasValue($data['reportingToPositionCode'])) {
            $reportingToId = $this->getPositionRecordByCodeFromArray($data['reportingToPositionCode'], $orgUnitId);
            if (empty($reportingToId)) {
                $response['errorMessage'] = 'Reporting to not found!';
                return $response;
            }
        } else {
            $reportingToId = 0;
        }

        $position = PositionsQuery::create()
                        ->filterByPositionCode($data['positionCode'])
                        ->filterByOrgUnitId($orgUnitId)
                        ->filterByCompanyId($this->companyId)
                        ->findOne();

        if (empty($position)) {
            $position = new Positions;
            $position->setPositionCode($data['positionCode']);
            $position->setOrgUnitId($orgUnitId);
            $position->setCompanyId($this->companyId);
        }

        $position->setPositionName($data['positionName']);
        $position->setReportingTo($reportingToId);
        $position->save();

        return $this->setDefaultSuccessResponse($position->getPrimaryKey());
    }

    public function addOrUpdateEmployeeOperation($data) : Array {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['employeeCode', 'employeeStatus', 'employeeFirstName', 'employeeMobileNo', 'employeeDesignation', 'employeeRole', 'employeeBranch', 'employeeGrade', 'orgunitid', 'positionCode', 'employeeEmail'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        $orgUnitId = $this->getOrgUnitRecordByIdFromArray($data['orgunitid']);
        if (empty($orgUnitId)) {
            $response['errorMessage'] = 'OrgUnitId not found!';
            return $response;
        }

        $position = PositionsQuery::create()
                        ->filterByPositionCode($data['positionCode'])
                        ->filterByOrgUnitId($orgUnitId)
                        ->findOne();
        if (empty($position)) {
            $response['errorMessage'] = 'Position not found!';
            return $response;
        } else {
            $positionId = $position->getPrimaryKey();
        }

        if (!empty($data['employeeMobileNo']) && !preg_match('/^[0-9]{10}+$/', $data['employeeMobileNo'])) {
            $response['errorMessage'] = "Please enter valid mobile number format!";
            return $response;
        }

        if ($this->hasValue($data['employeeBirthDate']) && !$this->validateDate($data['employeeBirthDate'])) {
            $response['errorMessage'] = "Enter valid birth date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeDateOfJoining']) && !$this->validateDate($data['employeeDateOfJoining'])) {
            $response['errorMessage'] = "Enter valid date of joining : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeProbationDate']) && !$this->validateDate($data['employeeProbationDate'])) {
            $response['errorMessage'] = "Enter valid probation date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeTrainingStartDate']) && !$this->validateDate($data['employeeTrainingStartDate'])) {
            $response['errorMessage'] = "Enter valid training start date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeTrainingEndDate']) && !$this->validateDate($data['employeeTrainingEndDate'])) {
            $response['errorMessage'] = "Enter valid training end date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeConfirmationDate']) && !$this->validateDate($data['employeeConfirmationDate'])) {
            $response['errorMessage'] = "Enter valid confirmation date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeTransferDate']) && !$this->validateDate($data['employeeTransferDate'])) {
            $response['errorMessage'] = "Enter valid transfer date : format: dd-mm-yyyy!";
            return $response;
        }
        
        if ($this->hasValue($data['employeeResignDate']) && !$this->validateDate($data['employeeResignDate'])) {
            $response['errorMessage'] = "Enter valid resign date : format: dd-mm-yyyy!";
            return $response;
        }

        if (!empty($data['employeeResignDate']) && date('Y-m-d', strtotime($data['employeeResignDate'])) <= date('Y-m-d')) {
            $response['errorMessage'] = "The resign date should be future date!";
            return $response;
        }

        if (!$this->isValidEmployeeStatus($data['employeeStatus'])) {
            $response['errorMessage'] = 'Please enter valid employee status!';
            return $response;
        }

        $empStatus = strtolower($data['employeeStatus']) == 'active' ? 1 : 0;

        // if ($this->hasValue($data['employeeTown'])) {
        //     $empTownId = $this->getTownRecordByCodeFromArray($data['employeeTown']);
        //     if (empty($empTownId)) {
        //         $response['errorMessage'] = 'Town not found!';
        //         return $response;
        //     }
        // } else {
        //     $empTownId = 0;
        // }

        if ($this->hasValue($data['employeeBranch'])) {
            $empBranchId = $this->getBranchRecordByCodeFromArray($data['employeeBranch']);
            if (empty($empBranchId)) {
                $response['errorMessage'] = 'Branch not found!';
                return $response;
            }
        } else {
            $empBranchId = 0;
        }

        if ($this->hasValue($data['employeeGrade'])) {
            $empGradeId = $this->getGradeRecordByCodeFromArray($data['employeeGrade']);
            if (empty($empGradeId)) {
                $response['errorMessage'] = 'Grade not found!';
                return $response;
            }
        } else {
            $empGradeId = 0;
        }

        if ($this->hasValue($data['employeeRole'])) {
            $empRoleId = $this->getRoleRecordByCodeFromArray($data['employeeRole']);
            if (empty($empRoleId)) {
                $response['errorMessage'] = 'Role not found!';
                return $response;
            }
        } else {
            $empRoleId = 0;
        }

        if ($this->hasValue($data['employeeDesignation'])) {
            $empDesignationId = $this->getDesignationRecordByCodeFromArray($data['employeeDesignation']);
            if (empty($empDesignationId)) {
                $empDesignationId = $this->addNewDesignation($data['employeeDesignation']);
            }
        } else {
            $empDesignationId = 0;
        }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                    ->filterByEmployeeCode($data['employeeCode'])
                    ->filterByCompanyId($this->companyId)
                    ->findOne();

        $isNewEmployee = false;
        if(empty($employee)) {
            $employee = new Employee;
            $employee->setEmployeeCode($data['employeeCode']);
            $employee->setCompanyId($this->companyId);
            $employee->setIslocked(0);
            $employee->setIseodcheckenabled(0);

            if ($this->hasValue($data['employeeMobileNo'])) {
                $employee->setPhone($data['employeeMobileNo']);
            }

            if(!empty($orgUnitId)) {
                $employee->setOrgUnitId($orgUnitId);
            }
    
            if(!empty($positionId)) {
                $employee->setPositionId($positionId);
            }
    
            if(!empty($position->getReportingTo())) {
                $employee->setReportingTo($position->getReportingTo());
            }

            if (!empty($position->getItownid())) {
                $employee->setItownid($position->getItownid());
            }

            $isNewEmployee = true;
        }

        if ($this->hasValue($data['employeeFirstName'])) {
            $employee->setFirstName($data['employeeFirstName']);
        }

        if ($this->hasValue($data['employeeLastName'])) {
            $employee->setLastName($data['employeeLastName']);
        }

        if ($this->hasValue($data['employeeEmail'])) {
            $employee->setEmail($data['employeeEmail']);
        }

        if ($this->hasValue($data['employeeBaseMonthlyTarget'])) {
            $employee->setBaseMtarget($data['employeeBaseMonthlyTarget']);
        }

        if ($this->hasValue($data['employeeResiAddress'])) {
            $employee->setResiAddress($data['employeeResiAddress']);
        }

        // if(!empty($empTownId)) {
        //     $employee->setItownid($empTownId);
        // }

        if(!empty($empBranchId)) {
            $employee->setBranchId($empBranchId);
        }

        if(!empty($empGradeId)) {
            $employee->setGradeId($empGradeId);
        }

        if(!empty($empDesignationId)) {
            $employee->setDesignationId($empDesignationId);
        }

        $employee->setStatus($empStatus);
        $employee->save();

        $this->addOrUpdateUserDetails($employee->getPrimaryKey(), $data, $empRoleId, $empStatus);
        $this->addOrUpdateHrUserDates($employee->getPrimaryKey(), $data);

        if ($isNewEmployee) {
            $employeePosition = EmployeePositionHistoryQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByPositionId($employee->getPositionId())
                                ->filterByCompanyId($this->companyId)
                                ->findOne();
        
            if (empty($employeePosition)) {
                $employeePosition = new EmployeePositionHistory;
                $employeePosition->setEmployeeId($employee->getPrimaryKey());
                $employeePosition->setPositionId($employee->getPositionId());
                $employeePosition->setCompanyId($this->companyId);
            }

            $employeePosition->setFromDate(date('Y-m-d'));
            $employeePosition->save();
        }

        return $this->setDefaultSuccessResponse($employee->getPrimaryKey());
    }

    private function addOrUpdateUserDetails($employeeID, $data, $empRoleId, $empStatus) {
        $user = UsersQuery::create()
                            ->filterByCompanyId($this->companyId)
                            ->filterByEmployeeId($employeeID)
                            ->findOne();

        if(empty($user)) {
            $user = new Users();
            $user->setCompanyId($this->companyId);
            $user->setName($data['employeeFirstName'] . " " . $data['employeeLastName']);
            $user->setUsername($data['employeeEmail']);
            $user->setEmail($data['employeeEmail']);
            $user->setPhone($data['employeeMobileNo']);
            $user->setOtp(9999);
            $user->setPassword(md5("12345678"));
            $user->setEmployeeId($employeeID);
            $user->setDefaultUser(0);
        }

        $user->setRoleId($empRoleId);
        $user->setStatus($empStatus);
        $user->save();
    }

    private function addOrUpdateHrUserDates($employeeID, $data) {
        $hrUserDateRecord = HrUserDatesQuery::create()
                                ->filterByEmployeeId($employeeID)
                                ->findOne();

        if (empty($hrUserDateRecord)) {
            $hrUserDateRecord = new HrUserDates;
            $hrUserDateRecord->setEmployeeId($employeeID);
        }

        if (isset($data['employeeBirthDate']) && $this->hasValue($data['employeeBirthDate'])) {
            $hrUserDateRecord->setBirthDate($data['employeeBirthDate']);
        }

        if (isset($data['employeeDateOfJoining']) && $this->hasValue($data['employeeDateOfJoining'])) {
            $hrUserDateRecord->setJoinDate($data['employeeDateOfJoining']);
        }

        if (isset($data['employeeProbationDate']) && $this->hasValue($data['employeeProbationDate'])) {
            $hrUserDateRecord->setProbationDate($data['employeeProbationDate']);
        }

        if (isset($data['employeeConfirmationDate']) && $this->hasValue($data['employeeConfirmationDate'])) {
            $hrUserDateRecord->setConfirmationDate($data['employeeConfirmationDate']);
        }

        if (isset($data['employeeTrainingStartDate']) && $this->hasValue($data['employeeTrainingStartDate'])) {
            $hrUserDateRecord->setTrainingStartDate($data['employeeTrainingStartDate']);
        }

        if (isset($data['employeeTrainingEndDate']) && $this->hasValue($data['employeeTrainingEndDate'])) {
            $hrUserDateRecord->setTrainingEndDate($data['employeeTrainingEndDate']);
        }

        if (isset($data['employeeResignDate']) && $this->hasValue($data['employeeResignDate'])) {
            $hrUserDateRecord->setResignDate($data['employeeResignDate']);
        }

        $hrUserDateRecord->save();
    }

    public function employeeConfirmedOperation($data) {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['employeeCode', 'employeeConfirmationDate'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        if ($this->hasValue($data['employeeConfirmationDate']) && !$this->validateDate($data['employeeConfirmationDate'])) {
            $response['errorMessage'] = "Enter valid confirmation date : format: dd-mm-yyyy!";
            return $response;
        }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                        ->filterByEmployeeCode($data['employeeCode'])
                        ->filterByCompanyId($this->companyId)
                        ->findOne();
        
        if (empty($employee)) {
            $response['errorMessage'] = 'Employee not found!';
            return $response;
        }

        $this->addOrUpdateHrUserDates($employee->getPrimaryKey(), ['employeeConfirmationDate' => $data['employeeConfirmationDate']]);
        
        return $this->setDefaultSuccessResponse($employee->getPrimaryKey());
    }

    public function employeeResignedOperation($data) {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['employeeCode', 'employeeResignDate', 'employeeStatus'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        if ($this->hasValue($data['employeeResignDate']) && !$this->validateDate($data['employeeResignDate'])) {
            $response['errorMessage'] = "Enter valid confirmation date : format: dd-mm-yyyy!";
            return $response;
        }

        // if (!$this->isValidEmployeeStatus($data['employeeStatus'])) {
        //     $response['errorMessage'] = 'Please enter valid employee status!';
        //     return $response;
        // }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                        ->filterByEmployeeCode($data['employeeCode'])
                        ->filterByCompanyId($this->companyId)
                        ->findOne();
        
        if (empty($employee)) {
            $response['errorMessage'] = 'Employee not found!';
            return $response;
        }

        $resignDate = date('Y-m-d');
        $attendanceCheck = AttendanceQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByAttendanceDate($resignDate, Criteria::LESS_EQUAL)
                                ->filterByStatus(0)
                                ->findOne();

        if (!empty($attendanceCheck)) {
            $response['errorMessage'] = "Cannot resign | Attendance status - Punch in for ". $attendanceCheck->getAttendanceDate('d-m-Y') ."!";
            return $response;
        }

        // $empStatus = strtolower($data['employeeStatus']) == 'active' ? 1 : 0;
        $empStatus = 0;
        $employee->setStatus($empStatus);
        $employee->save();
        $this->addOrUpdateHrUserDates($employee->getPrimaryKey(), ['employeeResignDate' => $resignDate]);
        
        return $this->setDefaultSuccessResponse($employee->getPrimaryKey());
    }

    public function updateEmployeeCodeOperation($data) {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['employeeCode', 'employeeMobileNo', 'positionCode', 'orgunitid'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        $orgUnitId = $this->getOrgUnitRecordByIdFromArray($data['orgunitid']);
        if (empty($orgUnitId)) {
            $response['errorMessage'] = 'OrgUnitId not found!';
            return $response;
        }

        $positionId = $this->getPositionRecordByCodeFromArray($data['positionCode'], $orgUnitId);
        if (empty($positionId)) {
            $response['errorMessage'] = 'Position not found!';
            return $response;
        }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                        ->filterByPhone($data['employeeMobileNo'])
                        ->filterByPositionId($positionId)
                        ->filterByCompanyId($this->companyId)
                        ->findOne();
        
        if (empty($employee)) {
            $response['errorMessage'] = 'Employee not found!';
            return $response;
        }

        $employee->setEmployeeCode($data['employeeCode']);
        $employee->save();
        
        return $this->setDefaultSuccessResponse($employee->getPrimaryKey());
    }

    public function employeePositionChangeOperation($data) {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['employeeCode', 'positionCode', 'orgunitid', 'employeeTransferDate', 'employeeGrade', 'employeeRole', 'employeeDesignation'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        if ($this->hasValue($data['employeeTransferDate']) && !$this->validateDate($data['employeeTransferDate'])) {
            $response['errorMessage'] = "Enter valid confirmation date : format: dd-mm-yyyy!";
            return $response;
        }

        $orgUnitId = $this->getOrgUnitRecordByIdFromArray($data['orgunitid']);
        if (empty($orgUnitId)) {
            $response['errorMessage'] = 'OrgUnitId not found!';
            return $response;
        }

        // if ($this->hasValue($data['employeeTown'])) {
        //     $empTownId = $this->getTownRecordByCodeFromArray($data['employeeTown']);
        //     if (empty($empTownId)) {
        //         $response['errorMessage'] = 'Town not found!';
        //         return $response;
        //     }
        // } else {
        //     $empTownId = 0;
        // }

        if ($this->hasValue($data['employeeBranch'])) {
            $empBranchId = $this->getBranchRecordByCodeFromArray($data['employeeBranch']);
            if (empty($empBranchId)) {
                $response['errorMessage'] = 'Branch not found!';
                return $response;
            }
        } else {
            $empBranchId = 0;
        }

        if ($this->hasValue($data['employeeGrade'])) {
            $empGradeId = $this->getGradeRecordByCodeFromArray($data['employeeGrade']);
            if (empty($empGradeId)) {
                $response['errorMessage'] = 'Grade not found!';
                return $response;
            }
        } else {
            $empGradeId = 0;
        }

        if ($this->hasValue($data['employeeRole'])) {
            $empRoleId = $this->getRoleRecordByCodeFromArray($data['employeeRole']);
            if (empty($empRoleId)) {
                $response['errorMessage'] = 'Role not found!';
                return $response;
            }
        } else {
            $empRoleId = 0;
        }

        if ($this->hasValue($data['employeeDesignation'])) {
            $empDesignationId = $this->getDesignationRecordByCodeFromArray($data['employeeDesignation']);
            if (empty($empDesignationId)) {
                $empDesignationId = $this->addNewDesignation($data['employeeDesignation']);
            }
        } else {
            $empDesignationId = 0;
        }

        $position = PositionsQuery::create()
                        ->filterByPositionCode($data['positionCode'])
                        ->filterByOrgUnitId($orgUnitId)
                        ->findOne();
        if (empty($position)) {
            $response['errorMessage'] = 'Position not found!';
            return $response;
        } else {
            $positionId = $position->getPrimaryKey();
        }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                        ->filterByEmployeeCode($data['employeeCode'])
                        ->filterByCompanyId($this->companyId)
                        ->findOne();
        
        if (empty($employee)) {
            $response['errorMessage'] = 'Employee not found!';
            return $response;
        }

        $employeeWithPosition = EmployeeQuery::create()
                                    ->filterByPositionId($positionId)
                                    ->filterByStatus(1)
                                    ->findOne();

        if (!empty($employeeWithPosition)) {
            $response['errorMessage'] = 'Position not vacant!';
            return $response;
        }

        // if(!empty($data['employeeTransferDate']))
        //         $transferDate = date('Y-m-d', strtotime($data['employeeTransferDate']));
        // else 
        //     $transferDate = date('Y-m-d');
        $transferDate = date('Y-m-d');

        $attendanceCheck = AttendanceQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByAttendanceDate($transferDate, Criteria::LESS_EQUAL)
                                ->filterByStatus(0)
                                ->findOne();

        if (!empty($attendanceCheck)) {
            $response['errorMessage'] = "Cannot transfer | Attendance status - Punch in for ". $attendanceCheck->getAttendanceDate('d-m-Y') ."!";
            return $response;
        }

        $attendanceCheck = AttendanceQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByAttendanceDate($transferDate, Criteria::LESS_EQUAL)
                                ->filterByStatus(1)
                                ->filterByExpenseId(null, Criteria::ISNULL)
                                ->findOne();

        if (!empty($attendanceCheck)) {
            $response['errorMessage'] = "Cannot transfer | Expense not generated for the date ". $attendanceCheck->getAttendanceDate('d-m-Y') ."!";
            return $response;
        }
        
        $oldPositionId = $employee->getPositionId();
        $employee->setPositionId($positionId);
        $employee->setReportingTo(!empty($position->getReportingTo()) ? $position->getReportingTo() : null);

        // if(!empty($empTownId)) {
        //     $employee->setItownid($empTownId);
        // }

        if(!empty($empBranchId)) {
            $employee->setBranchId($empBranchId);
        }

        if(!empty($empGradeId)) {
            $employee->setGradeId($empGradeId);
        }

        if(!empty($empDesignationId)) {
            $employee->setDesignationId($empDesignationId);
        }

        $empStatus = strtolower($data['employeeStatus']) == 'active' ? 1 : 0;
        $employee->setStatus($empStatus);
        $employee->save();

        $this->addOrUpdateUserDetails($employee->getPrimaryKey(), $data, $empRoleId, $empStatus);
        $this->addOrUpdateHrUserDates($employee->getPrimaryKey(), ['employeeTransferDate' => $transferDate]);

        $employeePosition = EmployeePositionHistoryQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByPositionId($oldPositionId)
                                ->filterByCompanyId($this->companyId)
                                ->findOne();
        
        if (empty($employeePosition)) {
            $employeePosition = new EmployeePositionHistory;
            $employeePosition->setEmployeeId($employee->getPrimaryKey());
            $employeePosition->setPositionId($oldPositionId);
            $employeePosition->setCompanyId($this->companyId);
        }

        $employeePosition->setToDate(date('Y-m-d'));
        $employeePosition->save();

        $employeePosition = EmployeePositionHistoryQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->filterByPositionId($employee->getPositionId())
                                ->filterByCompanyId($this->companyId)
                                ->findOne();
        
        if (empty($employeePosition)) {
            $employeePosition = new EmployeePositionHistory;
            $employeePosition->setEmployeeId($employee->getPrimaryKey());
            $employeePosition->setPositionId($employee->getPositionId());
            $employeePosition->setCompanyId($this->companyId);
        }

        $employeePosition->setFromDate(date('Y-m-d'));
        $employeePosition->save();

        return $this->setDefaultSuccessResponse($employee->getPrimaryKey());
    }

    public function employeePositionCodeChangeOperation($data) {
        $response = $this->setDefaultResponseFormat();

        $this->companyId = $data['companyId'];

        $requiredFields = ['positionCode', 'employeeCode', 'employeeMobileNo', 'orgunitid'];

        if (!$this->checkRequiredFields($requiredFields, $data)) {
            $response['errorMessage'] = 'Required fields not found : ' . implode(', ', $requiredFields);
            return $response;
        }

        // check if Employee record exists or not
        $employee = EmployeeQuery::create()
                        ->filterByEmployeeCode($data['employeeCode'])
                        ->filterByPhone($data['employeeMobileNo'])
                        ->filterByOrgUnitId($data['orgunitid'])
                        ->filterByCompanyId($this->companyId)
                        ->findOne();
        
        if (empty($employee)) {
            $response['errorMessage'] = 'Employee not found!';
            return $response;
        }

        $position = PositionsQuery::create()
                        ->filterByPositionCode($data['positionCode'])
                        ->filterByOrgUnitId($data['orgunitid'])
                        ->filterByPositionId($employee->getPositionId(), Criteria::NOT_EQUAL)
                        ->findOne();

        if (!empty($position)) {
            $response['errorMessage'] = 'Position already exsists with position code!';
            return $response;
        }

        $position = PositionsQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->filterByCompanyId($this->companyId)
                        ->findOne();

        if (empty($position)) {
            $response['errorMessage'] = 'Position not found!';
            return $response;
        }

        if ($this->hasValue($data['reportingToPositionCode'])) {
            $reportingToId = $this->getPositionRecordByCodeFromArray($data['reportingToPositionCode'], $data['orgunitid']);
            if (empty($reportingToId)) {
                $response['errorMessage'] = 'Reporting to not found!';
                return $response;
            }
        } else {
            $reportingToId = 0;
        }

        if ($this->hasValue($data['positionCode'])) {
            $position->setPositionCode($data['positionCode']);
        }

        if ($this->hasValue($reportingToId)) {
            $position->setReportingTo($reportingToId);
        }


        if ($this->hasValue($data['positionName'])) {
            $position->setPositionName($data['positionName']);
        }

        $position->save();

        if ($this->hasValue($reportingToId)) {
            $employee->setReportingTo($reportingToId);
            $employee->save();
        }
        
        return $this->setDefaultSuccessResponse($position->getPrimaryKey());
    }
}
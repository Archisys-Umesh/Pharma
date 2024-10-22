<?php

namespace BI\manager;

use entities\EmployeeQuery;
use entities\DataChangeRequests;
use entities\DataChangeRequestsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class DataChangeRequestManager 
{
    use \App\Traits\DataChangesOperations;
    public $companyId;

    private function setDefaultManagerResponseFormat() {
        return ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];
    }

    private function setDefaultManagerSuccessResponse($successIds = []) {
        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'successIds' => $successIds];
    }

    public function runner() {
        // set_time_limit(0);
        // while (true) {
            echo "Checking for new data change request... : Start" . PHP_EOL;
            $this->checkForNewDataChangeRequests();
            echo "Checking for new data change request... : End" . PHP_EOL;
        //     sleep(60);
        // }
    }

    private function checkForNewDataChangeRequests() {
        $requests = DataChangeRequestsQuery::create()
                        ->filterByStatus('pending')
                        ->filterByScheduleDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                        ->orderByDataChangeRequestId()
                        ->find();
        
        foreach ($requests as $request) {
            echo "Processing request... : " . $request->getPrimaryKey() . PHP_EOL;

            $response = $this->processDataChangeRequest($request->getActionType(), $request->getRequestedData(), $request->getImportTemplate());
            if ($response['status'] == 'success' && $response['hasError'] == 0) {
                $request->setStatus('success');
                $request->setHasError(false);
                $request->setSuccessIds(json_encode($response['successIds']));
                $request->save();
            } else {
                $request->setStatus('failed');
                $request->setHasError(true);
                $request->setErrorMessage($response['errorMessage']);
                $request->save();
            }
        }
    }

    private function processDataChangeRequest(String $action, Array $data, String $template) {
        switch ($action) {
            case 'new_position_with_employee':
                $response = $this->addNewPositionWithEmployee($template, $data);
                break;
                
            case 'new_position_without_employee':
                $response = $this->addNewPositionWithoutEmployee($template, $data);
                break;
                
            case 'update_position':
                $response = $this->updatePositionData($template, $data);
                break;
                
            case 'update_employee_details':
                $response = $this->updateEmployeeDetails($template, $data);
                break;
                
            case 'employee_confirmed':
                $response = $this->updateEmployeeConfirmed($template, $data);
                break;
                
            case 'employee_resigned':
                $response = $this->updateEmployeeResigned($template, $data);
                break;
                
            case 'employee_position_change':
                $response = $this->updateEmployeePosition($template, $data);
                break;
                
            case 'employee_code_change':
                $response = $this->updateEmployeeCode($template, $data);
                break;
                
            case 'position_code_change':
                $response = $this->updatePositionCodeChange($template, $data);
                break;
            
            default:
                $response = $this->setDefaultManagerResponseFormat();
                break;
        }

        return $response;
    }

    private function addNewPositionWithoutEmployee($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $position = $this->getPositionRecordByCodeFromArray($data['positionCode'], $data['orgunitid']);
            if (!empty($position)) {
                $response['errorMessage'] = 'Position already exists!';
                return $response;
            }

            $returnResponse = $this->addOrUpdatePositionOperation($data);
            if ($returnResponse['status'] == 'success') {
                return $this->setDefaultManagerSuccessResponse(['position_id' => $returnResponse['transactionId']]);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }
    }

    private function addNewPositionWithEmployee($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $position = $this->getPositionRecordByCodeFromArray($data['positionCode'], $data['orgunitid']);
            if (!empty($position)) {
                $employeeWithPosition = EmployeeQuery::create()
                                            ->filterByPositionId($position)
                                            ->filterByStatus(1)
                                            ->findOne();

                if (!empty($employeeWithPosition)) {
                    $response['errorMessage'] = 'Position not vacant!';
                    return $response;
                }
                // $response['errorMessage'] = 'Position already exists!';
                // return $response;
            }

            $employee = $this->getEmployeeRecordByCodeFromArray($data['employeeCode']);
            if (!empty($employee)) {
                $response['errorMessage'] = 'Employee already exists!';
                return $response;
            }

            $returnResponse = $this->addOrUpdatePositionOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = ['position_id' => $returnResponse['transactionId']];

                $returnResponse = $this->addOrUpdateEmployeeOperation($data);
                if ($returnResponse['status'] == 'success') {
                    $successIds['employee_id'] = $returnResponse['transactionId'];
                    return $this->setDefaultManagerSuccessResponse($successIds);
                } else {
                    $response['errorMessage'] = $returnResponse['errorMessage'];
                    return $response;
                }
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }
    }

    private function updatePositionData($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $position = $this->getPositionRecordByCodeFromArray($data['positionCode'], $data['orgunitid']);
            if (empty($position)) {
                $response['errorMessage'] = 'Position not found!';
                return $response;
            }

            $returnResponse = $this->addOrUpdatePositionOperation($data);
            if ($returnResponse['status'] == 'success') {
                return $this->setDefaultManagerSuccessResponse(['position_id' => $returnResponse['transactionId']]);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updateEmployeeDetails($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $employee = $this->getEmployeeRecordByCodeFromArray($data['employeeCode']);
            if (empty($employee)) {
                $response['errorMessage'] = 'Employee not found!';
                return $response;
            }

            $returnResponse = $this->addOrUpdateEmployeeOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = [];
                $successIds['employee_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updateEmployeeConfirmed($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $returnResponse = $this->employeeConfirmedOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = [];
                $successIds['employee_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updateEmployeeResigned($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $returnResponse = $this->employeeResignedOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = [];
                $successIds['employee_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updateEmployeePosition($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);
            $successIds = [];

            $position = $this->getPositionRecordByCodeFromArray($data['positionCode'], $data['orgunitid']);
            if (empty($position)) {
                $returnResponse = $this->addOrUpdatePositionOperation($data);
                if ($returnResponse['status'] == 'success') {
                    $successIds['position_id'] = $returnResponse['transactionId'];
                } else {
                    $response['errorMessage'] = $returnResponse['errorMessage'];
                    return $response;
                }
            }

            $returnResponse = $this->employeePositionChangeOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds['employee_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updateEmployeeCode($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $returnResponse = $this->updateEmployeeCodeOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = [];
                $successIds['employee_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function updatePositionCodeChange($template, $data) : Array {
        $response = $this->setDefaultManagerResponseFormat();

        try {
            $data = $this->loadDataAccordingToTemplate($template, $data);

            $returnResponse = $this->employeePositionCodeChangeOperation($data);
            if ($returnResponse['status'] == 'success') {
                $successIds = [];
                $successIds['position_id'] = $returnResponse['transactionId'];
                return $this->setDefaultManagerSuccessResponse($successIds);
            } else {
                $response['errorMessage'] = $returnResponse['errorMessage'];
                return $response;
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
            return $response;
        }

        return $response;
    }

    private function loadDataAccordingToTemplate($template, $data) : Array {
        switch (strtolower($template)) {
            case 'organogram':
                $data = $this->setDataArrayAccordingToOrganogramTemplate($data);
                break;
            
            default:
                $data = [];
                break;
        }

        $this->companyId = $data['companyId'];
        return $data;
    }

    private function setDataArrayAccordingToOrganogramTemplate($data) : Array {
        $newData = [];

        $newData['positionCode'] = isset($data['positionCode']) ? $data['positionCode'] : null;
        $newData['positionName'] = isset($data['positionName']) ? $data['positionName'] : null;
        $newData['reportingToPositionCode'] = isset($data['reportingToPositionCode']) ? $data['reportingToPositionCode'] : null;
        $newData['orgunitid'] = isset($data['positionOrgunitid']) ? $data['positionOrgunitid'] : null;
        $newData['positionIsVacant'] = isset($data['positionIsVacant']) ? $data['positionIsVacant'] : null;
        $newData['employeeCode'] = isset($data['employeeCode']) ? $data['employeeCode'] : null;
        $newData['employeeStatus'] = isset($data['employeeStatus']) ? $data['employeeStatus'] : null;
        $newData['employeeFirstName'] = isset($data['employeeFirstName']) ? $data['employeeFirstName'] : null;
        $newData['employeeLastName'] = isset($data['employeeLastName']) ? $data['employeeLastName'] : null;
        $newData['employeeEmail'] = isset($data['employeeEmail']) ? $data['employeeEmail'] : null;
        $newData['employeeMobileNo'] = isset($data['employeeMobileNo']) ? $data['employeeMobileNo'] : null;
        $newData['employeeDesignation'] = isset($data['employeeDesignation']) ? $data['employeeDesignation'] : null;
        $newData['employeeRole'] = isset($data['employeeRole']) ? $data['employeeRole'] : null;
        $newData['employeeBaseMonthlyTarget'] = isset($data['employeeBaseMonthlyTarget']) ? $data['employeeBaseMonthlyTarget'] : null;
        $newData['employeeTown'] = isset($data['employeeTown']) ? $data['employeeTown'] : null;
        $newData['employeeBranch'] = isset($data['employeeBranch']) ? $data['employeeBranch'] : null;
        $newData['employeeGrade'] = isset($data['employeeGrade']) ? $data['employeeGrade'] : null;
        $newData['employeeResiAddress'] = isset($data['employeeResiAddress']) ? $data['employeeResiAddress'] : null;
        $newData['employeeBirthDate'] = isset($data['employeeBirthDate']) ? $data['employeeBirthDate'] : null;
        $newData['employeeDateOfJoining'] = isset($data['employeeDateOfJoining']) ? $data['employeeDateOfJoining'] : null;
        $newData['employeeProbationDate'] = isset($data['employeeProbationDate']) ? $data['employeeProbationDate'] : null;
        $newData['employeeTrainingStartDate'] = isset($data['employeeTrainingStartDate']) ? $data['employeeTrainingStartDate'] : null;
        $newData['employeeTrainingEndDate'] = isset($data['employeeTrainingEndDate']) ? $data['employeeTrainingEndDate'] : null;
        $newData['employeeConfirmationDate'] = isset($data['employeeConfirmationDate']) ? $data['employeeConfirmationDate'] : null;
        $newData['employeeTransferDate'] = isset($data['employeeTransferDate']) ? $data['employeeTransferDate'] : null;
        $newData['employeeTransferLatterno'] = isset($data['employeeTransferLatterno']) ? $data['employeeTransferLatterno'] : null;
        $newData['employeeResignDate'] = isset($data['employeeResignDate']) ? $data['employeeResignDate'] : null;
        $newData['transactionType'] = isset($data['transactionType']) ? $data['transactionType'] : null;
        $newData['companyId'] = isset($data['companyId']) ? $data['companyId'] : 9;

        return $newData;
    }
}
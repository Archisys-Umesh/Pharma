<?php

declare (strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use entities\MtpQuery;
use entities\ApiKeysQuery;
use entities\EmployeeQuery;
use entities\SgpiTransQuery;
use entities\DailycallsQuery;
use entities\HrUserDatesQuery;
use entities\IntegrationApiLogs;
use entities\SgpiEmployeeBalanceQuery;
use entities\EmployeeLeaveBalanceQuery;
use entities\ExportExpensesSummaryQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class IntegrationApi extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    private function getExpenseStatus($status) {
        if($status == 'Created') {
            $status = 'Draft';
        } elseif($status == 'Submit') {
            $status = 'Submitted';
        } elseif($status == 'Approved') {
            $status = 'Workflow';
        } elseif($status == 'Proceed for Payment') {
            $status = 'Proceed for Payment';
        }

        return $status;
    }

    /**
     * @OA\POST(
     *     path="/api/unlockAccount",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Lock Flag | boolean : true / false",
     *         required=true,
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Parameter(
     *         name="resignation_date",
     *         in="query",
     *         description="Resignation date | valid date - format : yyyy-mm-dd",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="reliving_date",
     *         in="query",
     *         description="Reliving date | valid date - format : yyyy-mm-dd",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="nsm_approve_date",
     *         in="query",
     *         description="NSM Approve date | valid date - format : yyyy-mm-dd",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="resignation_rejected_date",
     *         in="query",
     *         description="Resignation rejected date | valid date - format : yyyy-mm-dd",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="message",
     *         in="query",
     *         description="Message to User | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function unlockAccount()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $message = $this->app->Request()->getParameter("message");
        $secret_key = $this->app->Request()->getParameter("secret_key");
        $resignation_date = $this->app->Request()->getParameter("resignation_date");
        $reliving_date = $this->app->Request()->getParameter("reliving_date");
        $nsm_approve_date = $this->app->Request()->getParameter("nsm_approve_date");
        $resignation_rejected_date = $this->app->Request()->getParameter("resignation_rejected_date");
        $status = $this->app->Request()->getParameter("status");
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if ($employee->getStatus()) {
                        if ($status) {
                            $employee->setIslocked($status);
                            $employee->setLockedreason($message);
                            $employee->setLockeddate(date('Y-m-d'));
                            $employee->save();

                            $hrUserDateRecord = HrUserDatesQuery::create()
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->findOne();

                            if (!empty($resignation_date) && $resignation_date != 'NA') {
                                $hrUserDateRecord->setResignDate($resignation_date);
                            }

                            if (!empty($reliving_date) && $reliving_date != 'NA') {
                                $hrUserDateRecord->setRelivingDate($reliving_date);
                            }

                            if (!empty($nsm_approve_date) && $nsm_approve_date != 'NA') {
                                $hrUserDateRecord->setNsmApproveDate($nsm_approve_date);
                            }

                            if (!empty($resignation_rejected_date) && $resignation_rejected_date != 'NA') {
                                $hrUserDateRecord->setResignationRejectedDate($resignation_rejected_date);
                            }

                            $hrUserDateRecord->save();

                            $response['data'] = ['isAccountLocked' => true];
                            $response['status'] = 200;
                            $response['message'] = "The account locked successfully !!";
                        } else {
                            $count = MtpQuery::create()
                                ->filterByPositionId($employee->getPositionId())
                                ->filterByMtpStatus('approved')
                                ->filterByMonth(date('m-Y'))
                                ->count();

                            if ($count < 0) {
                                $employee->setLockedreason('MTP LOCKED');
                                $employee->setLockeddate(date('Y-m-d'));
                                $employee->save();

                                $response['status'] = 412;
                                $response['message'] = "The account locked by MTP lock !!";
                            } else {
                                $employee->setIslocked($status);
                                $employee->setLockedreason($message);
                                $employee->setLockeddate(null);
                                $employee->save();

                                $hrUserDateRecord = HrUserDatesQuery::create()
                                    ->filterByEmployeeId($employee->getPrimaryKey())
                                    ->findOne();

                                // if (!empty($resignation_date) && $resignation_date != 'NA') {
                                $hrUserDateRecord->setResignDate(null);
                                // }

                                if (!empty($reliving_date) && $reliving_date != 'NA') {
                                    $hrUserDateRecord->setRelivingDate($reliving_date);
                                }

                                if (!empty($nsm_approve_date) && $nsm_approve_date != 'NA') {
                                    $hrUserDateRecord->setNsmApproveDate($nsm_approve_date);
                                }

                                if (!empty($resignation_rejected_date) && $resignation_rejected_date != 'NA') {
                                    $hrUserDateRecord->setResignationRejectedDate($resignation_rejected_date);
                                }

                                $hrUserDateRecord->save();

                                $response['data'] = ['isAccountLocked' => false];
                                $response['status'] = 200;
                                $response['message'] = "The account unlocked successfully !!";
                            }
                        }
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee not activated !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);

        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/setResignationDate",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="resignation_date",
     *         in="query",
     *         description="Resignation date | valid date - format : yyyy-mm-dd",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function setResignationDate()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");
        $resignation_date = $this->app->Request()->getParameter("resignation_date");

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if ($employee->getStatus()) {
                        $hrUserDateRecord = HrUserDatesQuery::create()
                            ->filterByEmployeeId($employee->getPrimaryKey())
                            ->findOne();

                        if (!empty($resignation_date) && $resignation_date != 'NA' && strtotime($resignation_date) > time()) {
                            $hrUserDateRecord->setResignDate($resignation_date);

                            $hrUserDateRecord->save();

                            $response['status'] = 200;
                            $response['message'] = "The resignation date saved successfully !!";
                        } else {
                            $response['status'] = 412;
                            $response['message'] = "Please enter valid date !!";
                        }
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee not activated !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);
        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/employeeReportingDetails",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function employeeReportingDetails()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if ($employee->getStatus()) {
                        $lastDCR = DailycallsQuery::create()
                            ->select(["DcrDate"])
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByDcrStatus(['completed', 'Reported'])
                            ->filterByCompanyId($apiKey->getCompanyId())
                            ->orderByDcrId(Criteria::DESC)
                            ->findOne();

                        $lastDCRDate = (!empty($lastDCR) ? date('d-m-Y', strtotime($lastDCR)) : '');

                        $leaveBalancesData = EmployeeLeaveBalanceQuery::create()
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByLeaveYear(date('Y'))
                            ->find()
                            ->toKeyValue("LeaveType", "Balance");
                        $leaveBalances = [
                            'PL' => (isset($leaveBalancesData['PL']) ? $leaveBalancesData['PL'] : 0),
                            'CL' => (isset($leaveBalancesData['CL']) ? $leaveBalancesData['CL'] : 0),
                            'SL' => (isset($leaveBalancesData['SL']) ? $leaveBalancesData['SL'] : 0),
                        ];

                        $pendingInputCount = SgpiEmployeeBalanceQuery::create()
                            ->select(['Qty'])
                            ->withColumn("SUM(balance)", "Qty")
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByBalance(0, Criteria::GREATER_THAN)
                            ->findOne();
                        $response['data'] = [
                            'lastDcrDate' => $lastDCRDate,
                            'leaveBalances' => $leaveBalances,
                            'pendingInputCount' => $pendingInputCount,
                        ];

                        $response['status'] = 200;
                        $response['message'] = "Employee reporting details fetched successfully !!";
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee not activated !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);
        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/employeePendingInputInventory",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function employeePendingInputInventory()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if ($employee->getStatus()) {
                        $pendingInputs = SgpiEmployeeBalanceQuery::create()
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByBalance(0, Criteria::GREATER_THAN)
                            ->find();

                        $pendingInputData = [];

                        foreach ($pendingInputs as $input) {
                            $pendingInputData[] = [
                                'sgpi_id' => $input->getSgpiId(),
                                'sgpi_name' => $input->getSgpiName(),
                                'sgpi_type' => $input->getSgpiType(),
                                'use_start_date' => $input->getUseStartDate()->format('d-m-Y'),
                                'use_end_date' => $input->getUseEndDate()->format('d-m-Y'),
                                'balance' => $input->getBalance(),
                            ];
                        }

                        $response['data'] = [
                            'inputs' => $pendingInputData,
                        ];

                        $response['status'] = 200;
                        $response['message'] = "Pending inverntories details fetched successfully !!";
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee not activated !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);
        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/fnf/empSgpiSummary",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Employee SGPI Summary details retrieved successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function empSgpiSummary()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if (!$employee->getStatus()) {
                        $empResignDate = HrUserDatesQuery::create()
                                ->select('ResignDate')
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->findOne();
                        
                        if (!empty($empResignDate)) {
                            $sgpiBalances = SgpiEmployeeBalanceQuery::create()
                                                ->select(['sgpi_type', 'count'])
                                                ->withColumn('SUM(balance)', 'count')
                                                ->filterByEmployeeId($employee->getPrimaryKey())
                                                ->groupBySgpiType()
                                                ->find()
                                                ->toKeyValue('sgpi_type', 'count');
                            
                            $data[] = [
                                'employee_code' => $employee->getEmployeeCode(),
                                'mode' => 'Remaining with user',
                                'sample_qty' => isset($sgpiBalances['samples']) ? (int) $sgpiBalances['samples'] : 0, 
                                'gift_qty' => isset($sgpiBalances['gifts']) ? (int) $sgpiBalances['gifts'] : 0,
                                'promo_qty' => isset($sgpiBalances['promo']) ? (int) $sgpiBalances['promo'] : 0
                            ];

                            $transferredSgpis = SgpiTransQuery::create()
                                                    ->select(['SgpiMaster.SgpiType', 'count'])
                                                    ->withColumn('SUM(SgpiTrans.Qty)', 'count')
                                                    ->joinSgpiMaster()
                                                    ->joinSgpiAccounts()
                                                    ->where('SgpiAccounts.EmployeeId = ?', $employee->getPrimaryKey())
                                                    ->filterByCd('D')
                                                    ->where('DATE(SgpiTrans.CreatedAt) > ?', $empResignDate)
                                                    ->where('SgpiTrans.Remark not like ?', 'By DCR %')
                                                    ->groupBy('SgpiMaster.SgpiType')
                                                    ->find()
                                                    ->toKeyValue('SgpiMaster.SgpiType', 'count');

                            $data[] = [
                                'employee_code' => $employee->getEmployeeCode(),
                                'mode' => 'Transferred to manager',
                                'sample_qty' => isset($transferredSgpis['samples']) ? (int) $transferredSgpis['samples'] : 0, 
                                'gift_qty' => isset($transferredSgpis['gifts']) ? (int) $transferredSgpis['gifts'] : 0,
                                'promo_qty' => isset($transferredSgpis['promo']) ? (int) $transferredSgpis['promo'] : 0
                            ];

                            $response['data'] = $data;
                            $response['status'] = 200;
                            $response['message'] = "The employee SGPI summary details retrieved successfully !!";
                        } else {
                            $response['status'] = 412;
                            $response['message'] = "Resign date not found !!";
                        }
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee still activate !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);

        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/fnf/empSgpiDetailsList",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sgpi_type",
     *         in="query",
     *         description="SGPI Type",
     *         required=true,
     *         @OA\Schema(type="string",enum={"samples", "gifts", "promo"},default="samples")
     *     ),
     *     @OA\Parameter(
     *         name="mode",
     *         in="query",
     *         description="Mode",
     *         required=true,
     *         @OA\Schema(type="string",enum={"remaining_to_user", "transferred_to_manager"},default="remaining_to_user")
     *     ),
     *     @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Employee SGPI Summary details retrieved successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function empSgpiDetailsList()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");
        $sgpi_type = $this->app->Request()->getParameter("sgpi_type");
        $mode = $this->app->Request()->getParameter("mode");

        if (empty($sgpi_type)) {
            $sgpi_type = 'samples';
        }

        if (empty($mode)) {
            $mode = 'remaining_to_user';
        }

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if (!$employee->getStatus()) {
                        $empResignDate = HrUserDatesQuery::create()
                                ->select('ResignDate')
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->findOne();
                        
                        if (!empty($empResignDate)) {
                            if ($mode == 'remaining_to_user') {
                                $sgpis = SgpiEmployeeBalanceQuery::create()
                                                ->select(['employee_code', 'sgpi_id', 'sgpi_type', 'sgpi_code', 'sgpi_name', 'mode', 'qty'])
                                                ->withColumn("'" . $employee->getEmployeeCode() . "'", 'employee_code')
                                                ->withColumn("'Remaining with user'", 'mode')
                                                ->withColumn('sgpi_master.sgpi_code', 'sgpi_code')
                                                ->withColumn('balance', 'qty')
                                                ->addJoin('sgpi_employee_balance.sgpi_id', 'sgpi_master.sgpi_id', Criteria::INNER_JOIN)
                                                ->filterByEmployeeId($employee->getPrimaryKey())
                                                ->filterBySgpiType($sgpi_type)
                                                ->filterByBalance(0, Criteria::GREATER_THAN)
                                                ->find()->toArray();
                            } else {
                                $sgpis = SgpiTransQuery::create()
                                                    ->select(['employee_code', 'sgpi_id', 'sgpi_type', 'sgpi_code', 'sgpi_name', 'mode', 'qty'])
                                                    ->withColumn("COALESCE('" . $employee->getEmployeeCode() . "')", 'employee_code')
                                                    ->withColumn("COALESCE('Transferred to manager')", 'mode')
                                                    ->withColumn('SgpiMaster.SgpiId', 'sgpi_id')
                                                    ->withColumn('SgpiMaster.SgpiType', 'sgpi_type')
                                                    ->withColumn('SgpiMaster.SgpiCode', 'sgpi_code')
                                                    ->withColumn('SgpiMaster.SgpiName', 'sgpi_name')
                                                    ->withColumn('sum(SgpiTrans.qty)', 'qty')
                                                    ->joinSgpiMaster()
                                                    ->joinSgpiAccounts()
                                                    ->where('SgpiAccounts.EmployeeId = ?', $employee->getPrimaryKey())
                                                    ->filterByCd('D')
                                                    ->where('DATE(SgpiTrans.CreatedAt) > ?', $empResignDate)
                                                    ->where('SgpiTrans.Remark not like ?', 'By DCR %')
                                                    ->where('SgpiMaster.SgpiType = ?', $sgpi_type)
                                                    ->groupBy('SgpiMaster.SgpiId', 'SgpiMaster.SgpiType', 'SgpiMaster.SgpiCode', 'SgpiMaster.SgpiName')
                                                    ->find()->toArray();
                            }

                            $response['data'] = $sgpis;
                            $response['status'] = 200;
                            $response['message'] = "The employee SGPI details retrieved successfully !!";
                        } else {
                            $response['status'] = 412;
                            $response['message'] = "Resign date not found !!";
                        }
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee still activate !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);

        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }

    /**
     * @OA\POST(
     *     path="/api/fnf/empExpenseSummary",
     *     tags={"Integration API's"},
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code | Numeric",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secret_key",
     *         in="query",
     *         description="Secret Key | String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Employee expense Summary details retrieved successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function empExpenseSummary()
    {
        $emp_code = $this->app->Request()->getParameter("emp_code");
        $secret_key = $this->app->Request()->getParameter("secret_key");

        $apiLog = new IntegrationApiLogs;
        $apiLog->setRequestedParams(json_encode($this->app->Request()->getParameters()));

        $apiKey = ApiKeysQuery::create()
            ->filterByApiKey($secret_key)
            ->findOne();

        $response = ['data' => new \stdClass(), 'status' => 500, 'message' => 'Something went wrong!'];

        if (!empty($apiKey)) {
            $apiLog->setCompanyId($apiKey->getCompanyId());

            if ($apiKey->getIsActive()) {
                $employee = EmployeeQuery::create()->findOneByEmployeeCode($emp_code);
                if (!empty($employee)) {
                    if (!$employee->getStatus()) {
                        $empResignDate = HrUserDatesQuery::create()
                                ->select('ResignDate')
                                ->filterByEmployeeId($employee->getPrimaryKey())
                                ->findOne();
                        
                        if (!empty($empResignDate)) {
                            $expenses = ExportExpensesSummaryQuery::create()
                                        ->filterByEmployeeId($employee->getPrimaryKey())
                                        ->filterByExpenseStatus('Proceed for Payment', Criteria::NOT_EQUAL)
                                        ->find();
                            
                            $data = [];
                            foreach ($expenses as $expense) {
                                $data[] = [
                                    'employee_code' => $employee->getEmployeeCode(),
                                    'employee_position_code' => $expense->getEmpPositionCode(),
                                    'employee_position_name' => $expense->getEmpPositionName(),
                                    'month' => date('m-Y', strtotime($expense->getMonth())),
                                    'requested_amount' => $expense->getRequestedAmount(),
                                    'approved_amunt' => $expense->getApprovedAmount(),
                                    'final_amount' => $expense->getFinalAmount(),
                                    'expense_status' => $this->getExpenseStatus($expense->getExpenseStatus()),
                                    'total_expenses' => $expense->getTotalExpenses(),
                                    'expense_dates' => $expense->getExpenseDates()
                                ];
                            }

                            $response['data'] = $data;
                            $response['status'] = 200;
                            $response['message'] = "The employee SGPI summary details retrieved successfully !!";
                        } else {
                            $response['status'] = 412;
                            $response['message'] = "Resign date not found !!";
                        }
                    } else {
                        $response['status'] = 412;
                        $response['message'] = "Employee still activate !!";
                    }
                } else {
                    $response['status'] = 412;
                    $response['message'] = "Employee not found !!";
                }
            } else {
                $response['status'] = 403;
                $response['message'] = "Secret Key is not activated !!";
            }
        } else {
            $response['status'] = 401;
            $response['message'] = "Secret Key Invalid !!";
        }

        $apiLog->setResponse(json_encode($response));
        $apiLog->setResponseStatus($response['status']);
        $apiLog->save();

        $payload = [
            "data" => $response['data'],
            "statusCode" => $response['status'],
            "message" => $response['message'],
            "timestamp" => new \DateTime(),
        ];

        return $this->json($payload);

        // return $this->apiResponse($response['data'], $response['status'], $response['message']);
    }
}
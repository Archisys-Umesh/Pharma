<?php

namespace BI\manager;

use entities\AttendanceQuery;
use entities\BudgetGroupQuery;
use entities\EmployeeQuery;
use entities\GeoDistanceQuery;
use entities\GeoTownsQuery;
use entities\MonthExpenses;
use Exception;
use Modules\ESS\Runtime\EssHelper;
use Modules\System\Processes\PolicyChecker;
use Propel\Runtime\ActiveQuery\Criteria;
use BI\manager\OnBoardManager;
use BI\manager\BrandCampaignManager;

/**
 * Description of Attendance Manager
 *
 * @author Chintan Parikh
 */
class ExpenseManager
{
    public function autoExpenseGenerateRunner() {
        echo "Checking for new expenses... : Start" . PHP_EOL;
        $this->autoExpenseGenerate();
        echo "Checking for new expenses... : End" . PHP_EOL;
    }

    public function autoExpenseGenerate($employeeId = null)
    {
        $startdate = '2023-08-01';
        $deleteExpenseAttendance = \entities\AttendanceQuery::create()
            ->filterByAttendanceDate($startdate, Criteria::GREATER_EQUAL)
            ->filterByExpenseGenerated(false)
            ->filterByExpenseId(null, Criteria::NOT_EQUAL)
            ->find()->toArray();

        //echo "Expense to delete ".count($deleteExpenseAttendance).PHP_EOL;
        foreach ($deleteExpenseAttendance as $deleteExpenses) {
            $expenses = \entities\ExpensesQuery::create()
                ->filterByExpenseDate($deleteExpenses['AttendanceDate'])
                ->filterByEmployeeId($deleteExpenses['EmployeeId'])
                ->find();
            if (count($expenses) > 0) {
                foreach ($expenses as $expense) {
                    $deleteExpList = \Modules\ESS\Runtime\EssHelper::deleteExpenseWithAttendance($expense);

                    $attendance = AttendanceQuery::create()->filterByAttendanceId($deleteExpenses['AttendanceId'])->findOne();
                    $attendance->setExpenseId(null);
                    $attendance->save();
                }
                $expenses->delete();
            }
        }

        if($_ENV['EXPENSE_ORG_UNITS'] != null){
            $orgExplode = explode(',',$_ENV['EXPENSE_ORG_UNITS']);
        }else{
            $orgExplode = [];
        }

        if ($employeeId != null && $employeeId != '') {
            $attendance = AttendanceQuery::create()
                ->filterByAttendanceDate($startdate, Criteria::GREATER_EQUAL)
                ->filterByEmployeeId($employeeId)
                ->filterByStartItownid(null, Criteria::NOT_EQUAL)
                ->filterByEndItownid(null, Criteria::NOT_EQUAL)
                ->filterByStatus(1)
                ->filterByExpenseGenerated(false);
                if(!empty($orgExplode)){
                    $attendance->useEmployeeQuery()
                        ->filterByOrgUnitId($orgExplode,Criteria::NOT_IN)
                    ->endUse();
                }
                $attendance->orderByAttendanceDate(Criteria::ASC)
                ->find();
        } else {
           
            $attendance = AttendanceQuery::create()
                ->joinWithEmployee()
                ->filterByAttendanceDate($startdate, Criteria::GREATER_EQUAL)
                ->filterByStartItownid(null, Criteria::NOT_EQUAL)
                ->filterByEndItownid(null, Criteria::NOT_EQUAL)
                ->filterByStatus(1)
                ->filterByExpenseGenerated(false);
                if(!empty($orgExplode)){
                    $attendance->useEmployeeQuery()
                        ->filterByOrgUnitId($orgExplode,Criteria::NOT_IN)
                    ->endUse();
                }
                $attendance->orderByAttendanceDate(Criteria::ASC)
                ->find();
                
        }
        //echo "Attendence to process ".count($attendance).PHP_EOL;

        if ($attendance->count() > 0 && count($deleteExpenseAttendance) == 0) {
            foreach ($attendance as $attend) {
                try {
                    $employee = EmployeeQuery::create()
                        ->filterByEmployeeId($attend->getEmployeeId())
                        ->findOne();
                    if ($attend != null && $employee != null) {
                        $this->runTownCorrections($attend, $employee);
                    }

                    //echo $employee->getEmployeeCode().' -- '.$attend->getAttendanceDate()->format('Y-m-d').' '.PHP_EOL;

                    $gradPolicy = \entities\GradePolicyQuery::create()
                        ->joinWithPolicyMaster()
                        ->filterByGradeid($employee->getGradeId())
                        ->findOne();
                    if ($gradPolicy != null && $gradPolicy->getEndDate() < date('Y-m-d') && $gradPolicy->getPolicyMaster()->getEndDate() < date('Y-m-d')) {
                        continue;
                    }else{
                        $createExpense = self::createExpense($attend, $employee);
                        //echo "Create Expense : " . $createExpense->getExpId() . PHP_EOL;
                        if ($createExpense != null) {
                            $attendanceUpdate = \entities\AttendanceQuery::create()->filterByAttendanceId($attend->getAttendanceId())->findOne();
                            $attendanceUpdate->setExpenseId($createExpense->getExpId());
                            $attendanceUpdate->setExpenseGenerated(true);
                            $attendanceUpdate->setExpenseRemark(null);
                            $attendanceUpdate->save();
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo "Attendance not found!" . PHP_EOL;
        }

        // $req = new OnBoardManager();
        // $req->createCustomerFromRequest();

        // $campaign = new BrandCampaignManager();
        // $campaign->addCampaignOutlets();

    }

    public function createExpense($attendance, $employee)
    {
        $employeeGrade = $employee->getGradeId();
        if ($employeeGrade != null) {
            $budgetGrade = \entities\BudgetGradesQuery::create()
                ->filterByGradeId($employeeGrade)
                ->findOne();
            if ($budgetGrade != null && $budgetGrade->getBgid() != null) {
                $budgetId = $budgetGrade->getBgid();
            } else {
                $budget = BudgetGroupQuery::create()
                    ->filterByIsDefault(true)
                    ->filterByCompanyId($employee->getCompanyId())
                    ->findOne();
                $budgetId = $budget->getBgid();
            }
        } else {
            $budget = BudgetGroupQuery::create()
                ->filterByIsDefault(true)
                ->filterByCompanyId($employee->getCompanyId())
                ->findOne();
            $budgetId = $budget->getBgid();
            if ($budgetId == null) {
                throw new Exception("Please select any one default budgets!");
            }
        }

        //echo "budgetId : " . $budgetId . PHP_EOL;

        $startTown = [$attendance->getStartItownid()];
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = [$attendance->getEndItownid()];
        $explodeVisitedTowns = array_filter(array_unique(explode(',', $visitedTown)));
        if (count($explodeVisitedTowns) > 0) {
            $end = end($explodeVisitedTowns);
            $start = reset($explodeVisitedTowns);

            if ((int) $endTown[0] == (int) $end) {
                if (in_array($startTown[0], $explodeVisitedTowns)) {
                    $townIdArray = array_merge($endTown, $explodeVisitedTowns);
                } else {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }
            } else if ((int) $start == (int) $endTown[0] && (int) $start != (int) $startTown[0]) {
                if (in_array($startTown[0], $explodeVisitedTowns)) {
                    $townIdArray = array_merge($endTown, $explodeVisitedTowns);
                } else {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }
            } else if ((int) $end == (int) $endTown[0] && (int) $start == (int) $startTown[0]) {
                $townIdArray = $explodeVisitedTowns;
            } else if ((int) $start == (int) $startTown[0]) {
                $townIdArray = array_merge($explodeVisitedTowns, $endTown);
            } else {
                $townIdArray = array_merge($startTown, $explodeVisitedTowns, $endTown);
            }
        } else {
            $filtered_array = array_filter($explodeVisitedTowns);
            $fAK = (int) $filtered_array;
            $end = end($filtered_array);
            if ((int) $endTown[0] == (int) $end) {
                $townIdArray = array_merge($startTown, $filtered_array);
            } else if ($fAK == (int) $endTown[0] && $fAK != (int) $startTown[0]) {
                $townIdArray = array_merge($startTown, $filtered_array);
            } else if ($end == (int) $endTown[0] && $fAK == (int) $startTown[0]) {
                $townIdArray = $filtered_array;
            } else if ($fAK == (int) $startTown[0]) {
                $townIdArray = array_merge($filtered_array, $endTown);
            } else {
                $townIdArray = array_merge($startTown, $filtered_array, $endTown);
            }
        }

        //print_r($townIdArray);

        $townArray = array();
        foreach ($townIdArray as $explodeVisitedTown) {
            if ($explodeVisitedTown != null && $explodeVisitedTown != '') {
                $town = GeoTownsQuery::create()
                    ->filterByItownid($explodeVisitedTown)
                    ->findOne();
                array_push($townArray, $town->getStownname());
            }
        }
        $townsName = implode(',', $townArray);

        //echo $townsName . PHP_EOL;

        //Get expense TA calculation
        $createExpenseLine = self::getTaExpense($attendance, $employee);

        //echo "createExpenseLine : " . PHP_EOL;
        //print_r($createExpenseLine);

        $_POST['ExpenseNote'] = "TaDa";
        $_POST['CompanyId'] = $employee->getCompanyId();
        $_POST['EmployeeId'] = $employee->getEmployeeId();
        $_POST['ExpenseDate'] = $attendance->getAttendanceDate()->format('Y-m-d');
        $_POST['BudgetId'] = $budgetId;
        $_POST['ExpensePlacewrk'] = $townsName;
        $_POST['ExpenseReqAmt'] = 0;
        $_POST['ExpenseApprovedAmt'] = 0;
        $_POST['ExpenseFinalAmt'] = 0;
        $_POST['ExpenseTaxAmt'] = 0;
        $_POST['ExpenseStatus'] = 1;
        $_POST['TripCurrency'] = 1;
        $_POST['Readflag'] = 0;
        $_POST['ExpenseTrip'] = 0;
        $_POST['ReadOnly'] = true;

        if ($createExpenseLine != null) {

            $expTripType = $createExpenseLine["TripType"];

            $heads = \Modules\ESS\Runtime\EssHelper::addExpenses($pk = 0, $_POST, $expTripType, $employee, $employee->getOrgUnitId(), 'case2');
            //echo "heads : " . count($heads) . PHP_EOL;

            //if (count($heads) > 0) {
            $expId = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $_POST, $expTripType, $employee, $employee->getOrgUnitId(), 'case3');

            //echo "expId : " . $expId . PHP_EOL;

            if ($expId > 0) {
                $default_currency = $employee->getOrgUnit()->getCurrencyId();
                $entity = \entities\ExpensesQuery::create()->findPk($expId);
                $entity->setExpenseNote($createExpenseLine["TaRemark"]);
                $entity->save();

                $policyEngine = new PolicyChecker($employee, $_POST['ExpenseDate'], $default_currency);
                $Branchlocation = $employee->getItownid();
                $expenseslist = \Modules\ESS\Runtime\EssHelper::addExpensesList($expId, $heads, $_POST, $policyEngine, $Branchlocation);
                $expenseListTa = new \entities\ExpenseList();
                $expenseListTa->setExpId($expId);
                //$expenseListTa->setExpNote(null);
                $expenseListTa->setExpNote($createExpenseLine["TaRemark"]);
                $expenseListTa->setExpMasterId($createExpenseLine["TaHead"]);
                $expenseListTa->setExpIlAmount($createExpenseLine['TaAmount']);
                $expenseListTa->setExpAprAmount(0);
                $expenseListTa->setExpFinalAmount($createExpenseLine['TaAmount']);
                $expenseListTa->setExpLimit1(0);
                $expenseListTa->setExpDate($attendance->getAttendanceDate()->format('Y-m-d'));
                $expenseListTa->setExpPolicyKey($createExpenseLine["TaPolicyKeyA"]);
                $expenseListTa->setEmployeeId($employee->getEmployeeId());
                $expenseListTa->setCompanyId($employee->getCompanyId());
                $expenseListTa->setIsReadonly(false);
                $expenseListTa->save();
                EssHelper::reCalculate($expId);
                EssHelper::repelExpenses($_POST['ExpenseDate'], $entity->getEmployee());
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process("Expenses", $entity);
                return $entity;
            } else {
                $attendance = \entities\AttendanceQuery::create()
                    ->findPk($attendance->getAttendanceId());
                $attendance->setExpenseRemark('Expense not found!');
                $attendance->save();
            }
            echo $expId . " : Expense generated" . PHP_EOL;
            //}
        }
    }

    public function getTaExpense($attendance, $employee)
    {
        // Attendance town get
        $startTown = [$attendance->getStartItownid()];
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = [$attendance->getEndItownid()];
        $explodeVisitedTowns = array_filter(array_unique(explode(',', $visitedTown)));

        //Get All toen id's array
        if (count($explodeVisitedTowns) > 0) {
            $end = end($explodeVisitedTowns);
            $start = reset($explodeVisitedTowns);

            if ((int) $endTown[0] == (int) $end) {
                if (in_array($startTown[0], $explodeVisitedTowns)) {
                    $townIdArray = array_merge($endTown, $explodeVisitedTowns);
                } else {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }
            } else if ((int) $start == (int) $endTown[0] && (int) $start != (int) $startTown[0]) {

                if (in_array($startTown[0], $explodeVisitedTowns)) {
                    $townIdArray = array_merge($endTown, $explodeVisitedTowns);
                } else {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }
            } else if ((int) $end == (int) $endTown[0] && (int) $start == (int) $startTown[0]) {
                $townIdArray = $explodeVisitedTowns;
            } else if ((int) $start == (int) $startTown[0]) {
                $townIdArray = array_merge($explodeVisitedTowns, $endTown);
            } else {
                $townIdArray = array_merge($startTown, $explodeVisitedTowns, $endTown);
            }
        } else {
            $filtered_array = array_filter($explodeVisitedTowns);
            $fAK = (int) $filtered_array;
            $end = end($filtered_array);
            if ((int) $endTown[0] == (int) $end) {
                $townIdArray = array_merge($startTown, $filtered_array);
            } else if ($fAK == (int) $endTown[0] && $fAK != (int) $startTown[0]) {
                $townIdArray = array_merge($startTown, $filtered_array);
            } else if ($end == (int) $endTown[0] && $fAK == (int) $startTown[0]) {
                $townIdArray = $filtered_array;
            } else if ($fAK == (int) $startTown[0]) {
                $townIdArray = array_merge($filtered_array, $endTown);
            } else {
                $townIdArray = array_merge($startTown, $filtered_array, $endTown);
            }
        }

        //Get all toen name array
        $townArray = array();
        foreach ($townIdArray as $explodeVisitedTown) {
            if ($explodeVisitedTown != null && $explodeVisitedTown != '') {
                $town = GeoTownsQuery::create()
                    ->filterByItownid($explodeVisitedTown)
                    ->findOne();
                array_push($townArray, $town->getStownname());
            }
        }
        $townsName = implode(',', $townArray);

        $counter = 0;
        $taTotalAmount = 0;
        $taTotalDistance = 0;
        $error = array();
        $msgArray = array();

        for ($i = 0; $i < count($townIdArray); $i++) {
            $arraySlice = array_slice($townIdArray, $counter++, 2);
            if (isset($arraySlice[1])) {
                //Get geo distance
                $distance = \entities\GeoDistanceQuery::create()
                    ->filterByFromTownId((int) $arraySlice[0])
                    ->filterByToTownId((int) $arraySlice[1])
                    ->findOne();
                if ($distance == null) {
                    $distance = \entities\GeoDistanceQuery::create()
                        ->filterByFromTownId((int) $arraySlice[1])
                        ->filterByToTownId((int) $arraySlice[0])
                        ->findOne();
                }

                //Get trip type
                $territoryTown = self::getTripType($attendance, $employee);

                if ($territoryTown == 'HQ') {
                    //Total belt amount
                    if ($distance != null && $distance->getAmount() != null) {
                        $taTotalAmount += $distance->getAmount();
                        $taTotalDistance += $distance->getDistanceKm();
                    } else {
                        $taTotalAmount += 0;
                        $taTotalDistance += 0;
                    }

                    $townArr = array();
                    foreach ($arraySlice as $arraySli) {
                        if ($arraySli != null && $arraySli != '') {
                            $town = GeoTownsQuery::create()
                                ->filterByItownid((int) $arraySli)
                                ->findOne();
                            array_push($townArr, $town->getStownname());
                        }
                    }
                    $townName = implode(',', $townArr);
                    if ($distance != null && $distance->getDistanceKm() != null && $distance->getAmount() != null) {
                        $msg = 'Towns : ' . $townName . ' - Distance : ' . $distance->getDistanceKm() . ' - Amount : ' . $distance->getAmount() . "\r\n";
                    } else {
                        $msg = 'Towns : ' . $townName . ' - Distance : ' . 0 . ' - Amount : ' . 0 . "\r\n";
                    }

                    array_push($msgArray, $msg);
                } else {

                    if ($distance != null) {

                        //Total belt amount
                        $taTotalAmount += $distance->getAmount();
                        $taTotalDistance += $distance->getDistanceKm();

                        $townArr = array();
                        foreach ($arraySlice as $arraySli) {
                            if ($arraySli != null && $arraySli != '') {
                                $town = GeoTownsQuery::create()
                                    ->filterByItownid((int) $arraySli)
                                    ->findOne();
                                array_push($townArr, $town->getStownname());
                            }
                        }
                        $townName = implode(',', $townArr);
                        $msg = 'Towns : ' . $townName . ' - Distance : ' . $distance->getDistanceKm() . ' - Amount : ' . $distance->getAmount() . "\r\n";
                        array_push($msgArray, $msg);
                    } else {

                        $taTotalAmount = 0;
                        $taTotalDistance = 0;

                        $townArr = array();
                        foreach ($arraySlice as $arraySli) {
                            if ($arraySli != null && $arraySli != '') {
                                $town = GeoTownsQuery::create()
                                    ->filterByItownid((int) $arraySli)
                                    ->findOne();
                                array_push($townArr, $town->getStownname());
                            }
                        }
                        $townName = implode(',', $townArr);
                        $msg = 'Towns : ' . $townName . ' - Distance : ' . 0 . ' - Amount : ' . 0 . "\r\n";
                        array_push($msgArray, $msg);
                        // $townArr = array();
                        // foreach ($arraySlice as $arraySli) {
                        //     if ($arraySli != null && $arraySli != '') {
                        //         $town = GeoTownsQuery::create()
                        //             ->leftJoinGeoCity()
                        //             ->filterByItownid((int)$arraySli)
                        //             ->findOne();
                        //         if($town != null && $town->getStownname() != null){
                        //             $townName = $town->getStownname();
                        //         }else{
                        //             $townName = null;
                        //         }
                        //         if($town != null && $town->getGeoCity() != null && $town->getGeoCity()->getScityname() != null){
                        //             $cityName = $town->getGeoCity()->getScityname();
                        //         }else{
                        //             $cityName = null;
                        //         }
                        //         $name = $townName.''.'('.$cityName.')';
                        //         array_push($townArr, $name);
                        //     }
                        // }
                        // if (!empty($townArr) && isset($townArr[0]) && isset($townArr[1])) {
                        //     $towns = $townArr[0] . ' - ' . $townArr[1] . " Geo Distance not found! | ";
                        // } else if (!empty($townArr) && isset($townArr[0])) {
                        //     $towns = $townArr[0] . " Geo Distance not found! | ";
                        // } else {
                        //     $towns = " Geo Distance not found!";
                        // }
                        // array_push($error, $towns);
                    }
                }
            }
        }
        if (count($error) > 0) {
            $msg = implode(",\n", $error);
            $attendance = \entities\AttendanceQuery::create()
                ->findPk($attendance->getAttendanceId());
            $attendance->setExpenseRemark($msg);
            $attendance->save();
        } else {
            $expenseHeadTa = \entities\ExpenseMasterQuery::create()
                ->filterByCompanyId($employee->getCompanyId())
                ->filterByExpenseId($employee->getCompany()->getAutoCalculatedTa())
                ->findOne();
            if (count($msgArray) > 0) {
                $msgArrayImpl = implode(',', $msgArray);
            } else {
                $msgArrayImpl = null;
            }

            $territoryTown = self::getTripType($attendance, $employee);

            if ($territoryTown != null) {
                $data = array(
                    "TaHead" => $expenseHeadTa->getExpenseId(),
                    "TaPolicyKeyA" => $expenseHeadTa->getDefaultPolicykey(),
                    "TaAmount" => $taTotalAmount,
                    //"TaRemark" => "Towns - " . $townsName . "\r\n" . " Trip Type - " . $territoryTown . "\r\n" . " Total Amount - " . $taTotalAmount . "\r\n" . " Town Details - " . $msgArrayImpl,
                    "TaRemark" => "Towns - " . $townsName . "\r\n" . " Town Details - " . $msgArrayImpl . "\r\n" . " Trip Type - " . $territoryTown . "|" . " Total Distance - " . $taTotalDistance . "|" . " Total Amount - " . $taTotalAmount,
                    "TripType" => $territoryTown,
                );
                return $data;
            }
        }
    }

    // public function getTaExpenseOld($attendance, $employee)
    // {
    //     // Get employee policies
    //     $default_currency = $employee->getOrgUnit()->getCurrencyId();
    //     $policyEngine = new PolicyChecker($employee, $attendance->getAttendanceDate()->format('Y-m-d'), $default_currency);

    //     // Attendance town get
    //     $startTown = [$attendance->getStartItownid()];
    //     $visitedTown = $attendance->getVisitedItownid();
    //     $endTown = [$attendance->getEndItownid()];
    //     $explodeVisitedTowns = array_unique(explode(',', $visitedTown));

    //     if ($explodeVisitedTowns[0] != null && $explodeVisitedTowns[0] != '') {
    //         $end = end($explodeVisitedTowns);
    //         if ((int)$endTown[0] == (int)$end) {
    //             $townIdArray = array_merge($startTown, $explodeVisitedTowns);
    //         } else  if ((int)$explodeVisitedTowns[0] == (int)$endTown[0] && (int)$explodeVisitedTowns[0] != (int)$startTown[0]) {
    //             $townIdArray = array_merge($startTown, $explodeVisitedTowns);
    //         } else if ((int)$end  == (int)$endTown[0] && (int)$explodeVisitedTowns[0] == (int)$startTown[0]) {
    //             $townIdArray = $explodeVisitedTowns;
    //         } else if ((int)$explodeVisitedTowns[0] == (int)$startTown[0]) {
    //             $townIdArray = array_merge($explodeVisitedTowns, $endTown);
    //         } else {
    //             $townIdArray = array_merge($startTown, $explodeVisitedTowns, $endTown);
    //         }
    //     } else {
    //         $filtered_array = array_filter($explodeVisitedTowns);
    //         $fAK = (int)$filtered_array;
    //         $end = end($filtered_array);
    //         if ((int)$endTown[0] == (int)$end) {
    //             $townIdArray = array_merge($startTown, $filtered_array);
    //         } else  if ($fAK == (int)$endTown[0] && $fAK != (int)$startTown[0]) {
    //             $townIdArray = array_merge($startTown, $filtered_array);
    //         } else if ($end == (int)$endTown[0] && $fAK == (int)$startTown[0]) {
    //             $townIdArray = $filtered_array;
    //         } else if ($fAK == (int)$startTown[0]) {
    //             $townIdArray = array_merge($filtered_array, $endTown);
    //         } else {
    //             $townIdArray = array_merge($startTown, $filtered_array, $endTown);
    //         }
    //     }

    //     $townArray = array();
    //     foreach ($townIdArray as $explodeVisitedTown) {
    //         if ($explodeVisitedTown != null && $explodeVisitedTown != '') {
    //             $town = GeoTownsQuery::create()
    //                 ->filterByItownid($explodeVisitedTown)
    //                 ->findOne();
    //             array_push($townArray, $town->getStownname());
    //         }
    //     }
    //     $townsName = implode(',', $townArray);
    //     $counter = 0;
    //     $taTotalAmount = 0;
    //     $error = array();
    //     $msgArray = array();
    //     for ($i = 0; $i < count($townIdArray); $i++) {
    //         $arraySlice = array_slice($townIdArray, $counter++, 2);
    //         if (isset($arraySlice[1])) {
    //             $distance = \entities\GeoDistanceQuery::create()
    //                 ->filterByFromTownId((int) $arraySlice[0])
    //                 ->filterByToTownId((int) $arraySlice[1])
    //                 ->findOne();
    //             if ($distance == null) {
    //                 $distance = \entities\GeoDistanceQuery::create()
    //                     ->filterByFromTownId((int) $arraySlice[1])
    //                     ->filterByToTownId((int) $arraySlice[0])
    //                     ->findOne();
    //             }
    //             $territoryTown = self::getTripType($attendance, $employee);
    //             if ($territoryTown == 'HQ') {
    //                 $taConfigurations = \entities\TaConfigurationQuery::create()
    //                     ->filterByCompanyId($employee->getCompanyId())
    //                     ->orderByFromKm(Criteria::ASC)
    //                     ->find();
    //                 $lastDistance = 0;
    //                 $totalTaAmount = 0;
    //                 if ($distance != null && $distance->getDistanceKm() != null) {
    //                     $townDistance = $distance->getDistanceKm();
    //                 } else {
    //                     $townDistance = 0;
    //                 }
    //                 foreach ($taConfigurations as $taConfiguration) {
    //                     $policyRowLimit = $policyEngine->getKeyRecord($taConfiguration->getPolicyKey());
    //                     $remainDistance = $townDistance - $lastDistance;
    //                     if ($remainDistance > 0) {
    //                         $lastDistance = $taConfiguration->getToKm();
    //                         if ($taConfiguration->getFromKm() == 0) {
    //                             $fromTown = $taConfiguration->getFromKm();
    //                         } else {
    //                             $fromTown = $taConfiguration->getFromKm() - 1;
    //                         }
    //                         if ($taConfiguration->getToKm() < $townDistance) {
    //                             $calculateDistance = $taConfiguration->getToKm() - $fromTown;
    //                         } else {
    //                             $calculateDistance = $townDistance - $fromTown;
    //                         }
    //                         $amt = abs($calculateDistance) * $policyRowLimit;
    //                         $totalTaAmount += $amt;
    //                     }
    //                 }
    //                 $taTotalAmount += $totalTaAmount;
    //                 $townArr = array();
    //                 foreach ($arraySlice as $arraySli) {
    //                     if ($arraySli != null && $arraySli != '') {
    //                         $town = GeoTownsQuery::create()
    //                             ->filterByItownid((int)$arraySli)
    //                             ->findOne();
    //                         array_push($townArr, $town->getStownname());
    //                     }
    //                 }
    //                 $townName = implode(',', $townArr);
    //                 $msg = 'Towns : ' . $townName . ' - Distance : ' . $townDistance . ' - Amount : ' . $totalTaAmount;
    //                 array_push($msgArray, $msg);
    //             } else {
    //                 if ($distance != null && $distance->getDistanceKm() != null) {
    //                     $taConfigurations = \entities\TaConfigurationQuery::create()
    //                         ->filterByCompanyId($employee->getCompanyId())
    //                         ->orderByFromKm(Criteria::ASC)
    //                         ->find();
    //                     $lastDistance = 0;
    //                     $totalTaAmount = 0;
    //                     $townDistance = $distance->getDistanceKm();
    //                     foreach ($taConfigurations as $taConfiguration) {
    //                         $policyRowLimit = $policyEngine->getKeyRecord($taConfiguration->getPolicyKey());
    //                         $remainDistance = $townDistance - $lastDistance;
    //                         if ($remainDistance > 0) {
    //                             $lastDistance = $taConfiguration->getToKm();
    //                             if ($taConfiguration->getFromKm() == 0) {
    //                                 $fromTown = $taConfiguration->getFromKm();
    //                             } else {
    //                                 $fromTown = $taConfiguration->getFromKm() - 1;
    //                             }
    //                             if ($taConfiguration->getToKm() < $townDistance) {
    //                                 $calculateDistance = $taConfiguration->getToKm() - $fromTown;
    //                             } else {
    //                                 $calculateDistance = $townDistance - $fromTown;
    //                             }
    //                             $amt = abs($calculateDistance) * $policyRowLimit;
    //                             $totalTaAmount += $amt;
    //                         }
    //                     }
    //                     $taTotalAmount += $totalTaAmount;
    //                     $townArr = array();
    //                     foreach ($arraySlice as $arraySli) {
    //                         if ($arraySli != null && $arraySli != '') {
    //                             $town = GeoTownsQuery::create()
    //                                 ->filterByItownid((int)$arraySli)
    //                                 ->findOne();
    //                             array_push($townArr, $town->getStownname());
    //                         }
    //                     }
    //                     $townName = implode(',', $townArr);
    //                     $msg = 'Towns : ' . $townName . ' - Distance : ' . $distance->getDistanceKm() . ' - Amount : ' . $totalTaAmount . "\r\n";
    //                     array_push($msgArray, $msg);
    //                 } else {
    //                     $townArr = array();
    //                     foreach ($arraySlice as $arraySli) {
    //                         if ($arraySli != null && $arraySli != '') {
    //                             $town = GeoTownsQuery::create()
    //                                 ->filterByItownid((int)$arraySli)
    //                                 ->findOne();
    //                             array_push($townArr, $town->getStownname());
    //                         }
    //                     }
    //                     if (!empty($townArr) && isset($townArr[0]) && isset($townArr[1])) {
    //                         $towns = $townArr[0] . ' - ' . $townArr[1] . " Geo Distance not found! | ";
    //                     } else if (!empty($townArr) && isset($townArr[0])) {
    //                         $towns = $townArr[0] . " Geo Distance not found! | ";
    //                     } else {
    //                         $towns = " Geo Distance not found!";
    //                     }
    //                     array_push($error, $towns);
    //                 }
    //             }
    //         }
    //     }
    //     if (count($error) > 0) {
    //         $msg = implode(",\n", $error);
    //         $attendance = \entities\AttendanceQuery::create()
    //             ->findPk($attendance->getAttendanceId());
    //         $attendance->setExpenseRemark($msg);
    //         $attendance->save();
    //     } else {
    //         $expenseHeadTa = \entities\ExpenseMasterQuery::create()
    //             ->filterByCompanyId($employee->getCompanyId())
    //             ->filterByExpenseId($employee->getCompany()->getAutoCalculatedTa())
    //             ->findOne();
    //         if (count($msgArray) > 0) {
    //             $msgArrayImpl = implode(',', $msgArray);
    //         } else {
    //             $msgArrayImpl = null;
    //         }

    //         $territoryTown = self::getTripType($attendance, $employee);
    //         if ($territoryTown != null) {
    //             $data = array(
    //                 "TaHead" => $expenseHeadTa->getExpenseId(),
    //                 "TaPolicyKeyA" => $expenseHeadTa->getDefaultPolicykey(),
    //                 "TaAmount" => $taTotalAmount,
    //                 "TaRemark" => "Towns - " . $townsName . "\r\n" . " Trip Type - " . $territoryTown . "\r\n" . " Total Amount - " . $taTotalAmount . "\r\n" . " Town Details - " . $msgArrayImpl,
    //                 "TripType" => $territoryTown,
    //             );
    //             return $data;
    //         } else {
    //             $attendance = \entities\AttendanceQuery::create()
    //                 ->findPk($attendance->getAttendanceId());
    //             $geoTown = \entities\GeoTownsQuery::create()
    //                 ->findPk($attendance->getEndItownid());
    //             $attendance->setExpenseRemark($geoTown->getStownname() . ' - Trip type not found!');
    //             $attendance->save();
    //         }
    //     }
    // }

    public static function getTripType($attendance, $employee)
    {
        $startTown = $attendance->getStartItownid();
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = $attendance->getEndItownid();
        $employeeTown = $employee->getItownid();
        $explodeVisitedTowns = array_filter(array_unique(explode(',', $visitedTown)));
        if (count($explodeVisitedTowns) > 0) {
            $visitedTripType = array();
            $startTownType = 'NON-HQ';
            $endTownType = 'NON-HQ';
            $tripType = null;
            foreach ($explodeVisitedTowns as $explodeVisitedTown) {
                if ($employeeTown == (int) $explodeVisitedTown) {
                    $triptype = 'HQ';
                    //}elseif($startTown == $endTown && $endTown == (int) $explodeVisitedTown && $startTown == (int) $explodeVisitedTown){
                    //  $triptype = 'HQ';
                } else {
                    $triptype = 'NON-HQ';
                }
                array_push($visitedTripType, $triptype);
            }

            if (in_array("NON-HQ", $visitedTripType)) {
                $visitedTownType = 'NON-HQ';
            } else {
                $visitedTownType = 'HQ';
            }

            if ($employeeTown == $startTown) {
                $startTownType = 'HQ';
            }
            if ($employeeTown == $endTown) {
                $endTownType = 'HQ';
            }

            //            if($startTown == $endTown){
            //                $endTownType = 'HQ';
            //                $startTownType = 'HQ';
            //            }
            //            if($startTown == $endTown && $endTown == $explodeVisitedTowns){
            //                $visitedTownType = 'HQ';
            //            }

            if ($startTownType == 'HQ' && $visitedTownType == 'HQ' && $endTownType == 'HQ') {
                $tripType = 'HQ';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'LOS';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            } else if ($startTownType == 'HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'EX-HQ';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'HQ' && $endTownType == 'HQ') {
                $tripType = 'LOS';
            } else if ($startTownType == 'HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            } else if ($startTownType == 'HQ' && $visitedTownType == 'HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            }
        } else {
            $startTownType = 'NON-HQ';
            $endTownType = 'NON-HQ';
            $tripType = null;

            if ($employeeTown == $startTown) {
                $startTownType = 'HQ';
            }
            if ($employeeTown == $endTown) {
                $endTownType = 'HQ';
            }
            //            if($startTown == $endTown){
            //                $endTownType = 'HQ';
            //                $startTownType = 'HQ';
            //            }
            if ($startTownType == 'HQ' && $endTownType == 'HQ') {
                $tripType = 'HQ';
            } else if ($startTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'LOS';
            } else if ($startTownType == 'NON-HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            } else if ($startTownType == 'HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            }
        }

        return $tripType;
    }

    public function getTownCorrectionUniuqeId($townId)
    {
        $townCorrection = \entities\TownCorrectionQuery::create()
            ->filterByTownId($townId)
            ->findOne();
        if($townCorrection != null && $townCorrection->getUniqueTownCode() != null){
            return $townCorrection->getUniqueTownCode();
        }else{
            return null;
        }
    }

    public function runTownCorrections($attendance, $employee)
    {
        // Employee town update
        if($employee->getOrgUnitId() != 40 && $employee->getOrgUnitId() != 44){
            $empTown = $this->getTownCorrectionUniuqeId($employee->getItownId());
            if($empTown != null){
                $employee->setItownid($empTown);
                $employee->save();
            }
        }
        

        // OutletOrgData and DailyCalls town update
        $dailycalls = \entities\DailycallsQuery::create()
            ->filterByEmployeeId($attendance->getEmployeeId())
            ->filterByDcrDate($attendance->getAttendanceDate())
            ->find();
        $dailyCallsVisitedTowns = array();
        foreach ($dailycalls as $dailycall) {
            $outletOrgData = \entities\OutletOrgDataQuery::create()
                ->filterByOutletOrgId($dailycall->getOutletOrgDataId())
                ->findOne();
            if ($outletOrgData != null && $outletOrgData->getItownid() != null) {
                if($employee->getOrgUnitId() != 40 && $employee->getOrgUnitId() != 44){
                    // OutletOrgData town update
                    $outletOrgDataTown = $this->getTownCorrectionUniuqeId($outletOrgData->getItownid());
                    if($outletOrgDataTown != null){
                        $outletOrgData->setItownid($outletOrgDataTown);
                        $outletOrgData->save();
                    }

                    // DailyCalls town update
                    $dailycall->setItownid($outletOrgDataTown);
                    $dailycall->save();
                }else if($employee->getOrgUnitId() == 40 && $employee->getOrgUnitId() == 44){
                    // DailyCalls town update
                    $dailycall->setItownid($outletOrgData->getItownid());
                    $dailycall->save();
                }
                
                array_push($dailyCallsVisitedTowns, $outletOrgData->getItownid());
            }
        }

        if($employee->getOrgUnitId() != 40 && $employee->getOrgUnitId() != 44){
            // Attendance start town update
            if ($attendance->getStartItownid() != null) {
                $startTownCorrection = $this->getTownCorrectionUniuqeId($attendance->getStartItownid());
                if ($startTownCorrection != null) {
                    $attendance->setStartItownid($startTownCorrection);
                    $attendance->save();
                }
            }

            // Attendance end town update
            if ($attendance->getEndItownid() != null) {
                $endTownCorrection = $this->getTownCorrectionUniuqeId($attendance->getEndItownid());
                if ($endTownCorrection != null) {
                    $attendance->setEndItownid($endTownCorrection);
                    $attendance->save();
                }
            }
        }
        

        // Attendance visited town update
        $arrayUnique = array_unique($dailyCallsVisitedTowns);
        $arrayUniqueImplode = implode(',', $arrayUnique);
        if ($arrayUniqueImplode != null) {
            $attendance->setVisitedItownid($arrayUniqueImplode);
            $attendance->save();
        }
    }

    public function getBestRoute($attendance_id)
    {
        $attendance = \entities\AttendanceQuery::create()->findPk($attendance_id);
        $startTown = $attendance->getStartItownid() . "";
        $visitedTown = explode(",", $attendance->getVisitedItownid());
        $endTown = $attendance->getEndItownid() . "";
        // NOT START OR END
        $visitedTown = array_diff($visitedTown, [$startTown, $endTown]);
        $totalTowns = array_unique(array_merge([$startTown, $endTown], $visitedTown));
        var_dump($totalTowns);
        $combinations = $this->getAllCombos($visitedTown);
        var_dump($combinations);
        $distArray = [];
        if (count($visitedTown) > 1) {
            $distance = GeoDistanceQuery::create()
                ->filterByFromTownId($totalTowns)
                ->filterByToTownId($totalTowns)
                ->find();
            foreach ($distance as $dist) {
                $key = "";
                if ($dist->getFromTownId() < $dist->getToTownId()) {
                    $key = $dist->getFromTownId() . '-' . $dist->getToTownId();
                } else {
                    $key = $dist->getToTownId() . '-' . $dist->getFromTownId();
                }
                $distArray[$key] = $dist->getDistanceKm();
            }
            var_dump($distArray);
        } else {
            echo "Already Best Route";
        }
    }

    function getAllCombos($arr)
    {
        $combinations = array();
        $words = sizeof($arr);
        $combos = 1;
        for ($i = $words; $i > 0; $i--) {
            $combos *= $i;
        }
        while (sizeof($combinations) < $combos) {
            shuffle($arr);
            $combo = implode("-", $arr);
            if (!in_array($combo, $combinations)) {
                $combinations[] = $combo;
            }
        }
        return $combinations;
    }

    // public function visitedTownCorrection()
    // {
    //     $attendance = \entities\AttendanceQuery::create()
    //         ->filterByVisitedItownid(null, Criteria::NOT_EQUAL)
    //         ->find()->toArray();
    //     if (!empty($attendance)) {
    //         foreach ($attendance as $attend) {
    //             if (isset($attend['VisitedItownid'])) {
    //                 $visitedTownExplode = explode(',', $attend['VisitedItownid']);
    //                 $visitedTownFilter = array_filter($visitedTownExplode);
    //                 $updatedVisitTownArray = array();
    //                 foreach ($visitedTownFilter as $visitedTown) {
    //                     $townCorrection = \entities\TownCorrectionQuery::create()
    //                         ->filterByTownId((int)$visitedTown)
    //                         ->findOne();
    //                     if ($townCorrection != null && $townCorrection->getUniqueTownCode() != null) {
    //                         array_push($updatedVisitTownArray, $townCorrection->getUniqueTownCode());
    //                     }
    //                 }
    //                 $updatedVisitTownArrayImplode = implode(',', $updatedVisitTownArray);
    //                 $attendan = \entities\AttendanceQuery::create()
    //                     ->filterByAttendanceId($attend['AttendanceId'])
    //                     ->findOne();
    //                 $attendan->setVisitedItownid($updatedVisitTownArrayImplode);
    //                 $attendan->save();
    //                 echo $attend['AttendanceId'] . " : Visited town update" . PHP_EOL;
    //             }
    //         }
    //     }
    // }

    public static function generateMonthlyExpenses()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');
        $expenses = \entities\ExpensesQuery::create()
            ->select(['employee_id', 'request_expense_amount', 'approved_expense_amount', 'final_expense_amount', 'employee.employee_code'])
            ->withColumn('sum(expense_req_amt)', 'request_expense_amount')
            ->withColumn('sum(expense_approved_amt)', 'approved_expense_amount')
            ->withColumn('sum(expense_final_amt)', 'final_expense_amount')
            ->joinWithEmployee()
            ->filterByExpenseDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->groupByEmployeeId()
            ->find()->toArray();
        if (count($expenses) > 0) {
            foreach ($expenses as $expense) {
                $expMonth = \entities\MonthExpensesQuery::create()
                    ->filterByEmployeeId($expense["employee_id"])
                    ->filterByExpenseMonth(date('m-Y'))
                    ->findOne();
                if ($expMonth == null) {
                    $expMonth = new MonthExpenses();
                }
                $uniqueCode = date('m-Y') . '/' . $expense["employee_id"] . '/' . $expense["employee.employee_code"];
                $expMonth->setEmployeeId($expense["employee_id"]);
                $expMonth->setEmployeeCode($expense["employee.employee_code"]);
                $expMonth->setExpenseMonth(date('m-Y'));
                $expMonth->setExpenseReqAmt($expense["request_expense_amount"]);
                $expMonth->setExpenseApprovedAmt($expense["approved_expense_amount"]);
                $expMonth->setExpenseFinalAmt($expense["final_expense_amount"]);
                $expMonth->setUniqueCode($uniqueCode);
                $expMonth->save();
            }
        }
    }

    public function escalationOnRequest()
    {
        $currentDate = date('Y-m-d');
        $escalationDate = strtotime($this->getConfig("System", "EscalationDays"), strtotime($currentDate));
        $wfRequests = \entities\WfRequestsQuery::create()
            ->filterByWfEscalationDate($currentDate)
            ->filterByWfReqStatus(1)
            ->find()->toArray();
        if (count($wfRequests) > 0) {
            foreach ($wfRequests as $wfRequest) {
                $request = \entities\WfRequestsQuery::create()
                    ->filterByWfReqId($wfRequest->getWfReqId())
                    ->filterByWfReqEmployee($wfRequest->getWfOriginEmployee(), Criteria::NOT_EQUAL)
                    ->findOne();
                $reportingTo = $request->getEmployee()->getPositionsRelatedByPositionId()->getReportingTo();
                $employee = \entities\EmployeeQuery::create()
                    ->filterByPositionId($reportingTo)
                    ->findOne();
                if ($employee != null && $employee->getEmployeeId() != null) {
                    $wfRequest->setWfReqEmployee($employee->getEmployeeId());
                    $wfRequest->setWfEscalationDate($escalationDate);
                    $wfRequest->save();
                }
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("Escalation", $wfRequest, $employee, 0, $wfRequest->getWfEntityName(), $wfRequest->getWfReqId());
            }
        }
    }
}

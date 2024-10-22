<?php

namespace BI\manager;

use entities\AttendanceQuery as EntitiesAttendanceQuery;
use entities\Base\AttendanceQuery;
use entities\Base\EmployeeQuery;
use entities\BudgetGroupQuery;
use entities\GeoDistanceQuery;
use entities\GeoTownsQuery;
use Exception;
use Modules\ESS\Runtime\EssHelper;
use Modules\System\Processes\PolicyChecker;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Attendance Manager
 *
 * @author Plus91Labs
 */
class AutoExpenseManager
{
    public function attendanceExpenseGenerate(){
        // Attendance old expense delete
        $deleteExpenseAttendance = \entities\AttendanceQuery::create()
                        ->filterByExpenseGenerated(false)
                        ->filterByExpenseId(null, Criteria::NOT_EQUAL)
                        ->find()->toArray();
                        
        foreach($deleteExpenseAttendance as $deleteExpenses){
            $expense = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($deleteExpenses['AttendanceDate'])
                            ->filterByEmployeeId($deleteExpenses['EmployeeId'])
                            ->findOne();
            if($expense != null){
                $deleteExpList = \Modules\ESS\Runtime\EssHelper::deleteExpenseWithAttendance($expense);
                $attendance = AttendanceQuery::create()->filterByAttendanceId($deleteExpenses['AttendanceId'])->findOne();
                $attendance->setExpenseId(null);
                $attendance->save();
                $expense->delete();
            }
        }

        // Get attendance for new expense generate
        if($employeeId != null && $employeeId != ''){
            $attendance = AttendanceQuery::create()
                                ->filterByEmployeeId($employeeId)
                                ->filterByStartItownid(null, Criteria::NOT_EQUAL)
                                ->filterByEndItownid(null, Criteria::NOT_EQUAL)
                                ->filterByStatus(1)
                                ->filterByExpenseGenerated(false)
                                ->orderByAttendanceDate(Criteria::ASC)
                                ->find();
        }else{
            $attendance = AttendanceQuery::create()
                                ->filterByStartItownid(null, Criteria::NOT_EQUAL)
                                ->filterByEndItownid(null, Criteria::NOT_EQUAL)
                                ->filterByStatus(1)
                                ->filterByExpenseGenerated(false)
                                ->orderByAttendanceDate(Criteria::ASC)
                                ->find();
        }

        // Generate new expense
        if (count($attendance->toArray()) > 0) {
            foreach ($attendance as $attend) {
                $employee = EmployeeQuery::create()
                    ->filterByEmployeeId($attend->getEmployeeId())
                    ->findOne();
                if($employee != null){
                    $createExpense = self::createExpense($attend, $employee);
                    if ($createExpense != null) {
                        $attendanceUpdate = \entities\AttendanceQuery::create()->filterByAttendanceId($attend->getAttendanceId())->findOne();
                        $attendanceUpdate->setExpenseId($createExpense->getExpId());
                        $attendanceUpdate->setExpenseGenerated(true);
                        $attendanceUpdate->setExpenseRemark(null);
                        $attendanceUpdate->save();

                        echo $createExpense->getExpId()." : Expense generated".PHP_EOL;
                    }else{
                        echo "Expense not generated!".PHP_EOL;
                    }
                }else{
                    echo "Employee not found!".PHP_EOL;
                }
            }
        } else {
            echo "Attendance not found!".PHP_EOL;
        }
    }

    public function createExpense($attendance, $employee){

        // Get employee budgetId 
        $budgetId = self::getEmployeeBudget($employee);
        if($budgetId != null){
            // Get attendance town Id's
            $townIds = self::getAttendanceTown($attendance);

            // Get town names
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

            //Get expense TA calculation
            $createExpenseLine = self::getTaExpense($attendance, $employee);
        }else{
            echo "Employee budget not found!".PHP_EOL;
        }
    }

    // Get employee budget
    public function getEmployeeBudget($employee){
        if($employee->getGradeId() != null){
            $budgetGrade = \entities\BudgetGradesQuery::create()
                        ->filterByGradeId($employee->getGradeId())
                        ->findOne();
            if($budgetGrade != null && $budgetGrade->getBgid() != null){
                $budgetId = $budgetGrade->getBgid();
            }else{
                $budget = BudgetGroupQuery::create()
                            ->filterByIsDefault(true)
                            ->filterByCompanyId($employee->getCompanyId())
                            ->findOne();
                $budgetId = $budget->getBgid();
            }
        }else{
            $budget = BudgetGroupQuery::create()
                        ->filterByIsDefault(true)
                        ->filterByCompanyId($employee->getCompanyId())
                        ->findOne();
            $budgetId = $budget->getBgid();
        }
        return $budgetId;
    }

    // Get attendance towns
    public function getAttendanceTown($attendance){
        if($attendance != null && $attendance->getStartItownid() != null && $attendance->getEndItownid() != null){
            $startTown = [$attendance->getStartItownid()];
            $visitedTown = $attendance->getVisitedItownid();
            $endTown = [$attendance->getEndItownid()];
            $explodeVisitedTowns = array_filter(array_unique(explode(',', $visitedTown)));

            if (isset($explodeVisitedTowns[0]) && $explodeVisitedTowns[0] != null && $explodeVisitedTowns[0] != '') {
                $endVisitedTown = end($explodeVisitedTowns);
                if ((int)$endTown[0] == (int)$endVisitedTown) {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }else  if ((int)$explodeVisitedTowns[0] == (int)$endTown[0] && (int)$explodeVisitedTowns[0] != (int)$startTown[0]) {
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns);
                }else if ((int)$endVisitedTown  == (int)$endTown[0] && (int)$explodeVisitedTowns[0] == (int)$startTown[0]){
                    $townIdArray = $explodeVisitedTowns;
                }else if ((int)$explodeVisitedTowns[0] == (int)$startTown[0]){
                    $townIdArray = array_merge($explodeVisitedTowns, $endTown);
                }else{
                    $townIdArray = array_merge($startTown, $explodeVisitedTowns, $endTown);
                }
            }else{
                $townIdArray = array_merge($startTown, $endTown);
            }
            return $townIdArray;
        }else{
            echo "Attendance town not found!".PHP_EOL;
        }
    }

    public function getTripType($attendance, $employee){
        $startTown = $attendance->getStartItownid();
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = $attendance->getEndItownid();
        $employeeTown = $employee->getItownid();
        $explodeVisitedTowns = array_filter(array_unique(explode(',', $visitedTown)));

        if(isset($explodeVisitedTowns[0])){
            $startTownType = 'NON-HQ';
            $endTownType = 'NON-HQ';
            $tripType = null;

            // Get visited town types
            $visitedTripType = array();
            foreach ($explodeVisitedTowns as $explodeVisitedTown) {
                if ($employeeTown == (int) $explodeVisitedTown) {
                    $triptype = 'HQ';
                }else {
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
            if($startTown == $endTown){
                $endTownType = 'HQ';
                $startTownType = 'HQ';
            }
            if($startTown == $endTown && $endTown == $explodeVisitedTowns){
                $visitedTownType = 'HQ';
            }

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
        }else{
            $startTownType = 'NON-HQ';
            $endTownType = 'NON-HQ';
            $tripType = null;

            if ($employeeTown == $startTown) {
                $startTownType = 'HQ';
            }
            if ($employeeTown == $endTown) {
                $endTownType = 'HQ';
            }
            if($startTown == $endTown){
                $endTownType = 'HQ';
                $startTownType = 'HQ';
            }
            if ($startTownType == 'HQ' && $endTownType == 'HQ') {
                $tripType = 'HQ';
            } else if ($startTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'LOS';
            } else if ($startTownType == 'NON-HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            }
        }
        return $tripType;
    }
    

    

    

    

    public function createExpense($attendance, $employee)
    {
        

        

        

        $_POST['ExpenseNote'] = "TaDa";
        $_POST['CompanyId'] = $employee->getCompanyId();
        $_POST['EmployeeId'] = $employee->getEmployeeId();
        $_POST['ExpenseDate'] = $attendance->getAttendanceDate()->format('Y-m-d');
        $_POST['BudgetId'] = $budget->getBgid();
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
            if (count($heads) > 0) {
                $expId = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $_POST, $expTripType, $employee, $employee->getOrgUnitId(), 'case3');
                if ($expId > 0) {
                    $default_currency = $employee->getOrgUnit()->getCurrencyId();
                    $entity = \entities\ExpensesQuery::create()->findPk($expId);
                    $policyEngine = new PolicyChecker($employee, $_POST['ExpenseDate'], $default_currency);
                    $Branchlocation = $employee->getItownid();
                    $expenseslist = \Modules\ESS\Runtime\EssHelper::addExpensesList($expId, $heads, $_POST, $policyEngine, $Branchlocation);
                    $expenseListTa = new \entities\ExpenseList();
                    $expenseListTa->setExpId($expId);
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
                    $expenseListTa->setIsReadonly(true);
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
            } else {
                $attendance = \entities\AttendanceQuery::create()
                    ->findPk($attendance->getAttendanceId());
                $attendance->setExpenseRemark("Expense head not found!");
                $attendance->save();
            }
        }
    }

    public function getTaExpense($attendance, $employee)
    {
        // Get employee policies
        $default_currency = $employee->getOrgUnit()->getCurrencyId();
        $policyEngine = new PolicyChecker($employee, $attendance->getAttendanceDate()->format('Y-m-d'), $default_currency);
        
        // Attendance town get
        $startTown = [$attendance->getStartItownid()];
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = [$attendance->getEndItownid()];
        $explodeVisitedTowns = array_unique(explode(',', $visitedTown));
        if ($explodeVisitedTowns[0] != null && $explodeVisitedTowns[0] != '') {
            $end = end($explodeVisitedTowns);
            if ($endTown[0] == (int) $end) {
                $townIdArray = array_merge($startTown, $explodeVisitedTowns);
            } else {
                $townIdArray = array_merge($startTown, $explodeVisitedTowns, $endTown);
            }
        } else {
            $townIdArray = array_merge($startTown, $endTown);
        }
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
        $error = array();
        for ($i = 0; $i < count($townIdArray); $i++) {
            $arraySlice = array_slice($townIdArray, $counter++, 2);
            if (isset($arraySlice[1])) {
                $distance = \entities\GeoDistanceQuery::create()
                    ->filterByFromTownId((int) $arraySlice[0])
                    ->filterByToTownId((int) $arraySlice[1])                    
                    ->findOne();
                if ($distance != null && $distance->getDistanceKm() != null && $distance->getCalculationType() == 'K') {
                    $taConfigurations = \entities\TaConfigurationQuery::create()
                        ->filterByCompanyId($employee->getCompanyId())
                        ->orderByFromKm(Criteria::ASC)
                        ->find();
                    $lastDistance = 0;
                    $totalTaAmount = 0;
                    $townDistance = $distance->getDistanceKm();
                    foreach ($taConfigurations as $taConfiguration) {
                        $policyRowLimit = $policyEngine->getKeyRecord($taConfiguration->getPolicyKey());
                        $remainDistance = $townDistance - $lastDistance;
                        if ($remainDistance > 0) {
                            $lastDistance = $taConfiguration->getToKm();
                            if ($taConfiguration->getFromKm() == 0) {
                                $fromTown = $taConfiguration->getFromKm();
                            } else {
                                $fromTown = $taConfiguration->getFromKm() - 1;
                            }
                            if ($taConfiguration->getToKm() < $townDistance) {
                                $calculateDistance = $taConfiguration->getToKm() - $fromTown;
                            } else {
                                $calculateDistance = $townDistance - $fromTown;
                            }
                            $amt = abs($calculateDistance) * $policyRowLimit;
                            $totalTaAmount += $amt;
                        }
                    }
                    $taTotalAmount += $totalTaAmount;
                }
                else if ($distance != null && $distance->getDistanceKm() != null && $distance->getCalculationType() == 'F') {
                {
                    $taTotalAmount += $distance->getDistanceKm();
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
            $territoryTown = self::getTripType($attendance, $employee);
            if ($territoryTown != null) {
                $data = array(
                    "TaHead" => $expenseHeadTa->getExpenseId(),
                    "TaPolicyKeyA" => $expenseHeadTa->getDefaultPolicykey(),
                    "TaAmount" => $taTotalAmount,
                    "TaRemark" => "Towns - " . $townsName . " / Trip Type - " . $territoryTown . " / Total Amount - " . $taTotalAmount,
                    "TripType" => $territoryTown,
                );
                return $data;
            } else {
                $attendance = \entities\AttendanceQuery::create()
                    ->findPk($attendance->getAttendanceId());
                $attendance->setExpenseRemark('Trip type not found!');
                $attendance->save();
            }
        }
    }

    public static function getTripType($attendance, $employee)
    {
        $startTown = $attendance->getStartItownid();
        $visitedTown = $attendance->getVisitedItownid();
        $endTown = $attendance->getEndItownid();
        $employeeTown = $employee->getItownid();
        $explodeVisitedTowns = array_unique(explode(',', $visitedTown));
        if (count($explodeVisitedTowns) > 0) {
            $visitedTripType = array();
            $startTownType = 'NON-HQ';
            $endTownType = 'NON-HQ';
            $tripType = null;
            foreach ($explodeVisitedTowns as $explodeVisitedTown) {
                if ($employeeTown == (int) $explodeVisitedTown) {
                    $triptype = 'HQ';
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
            if ($startTownType == 'HQ' && $visitedTownType == 'HQ' && $endTownType == 'HQ') {
                $tripType = 'HQ';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'LOS';
            } else if ($startTownType == 'NON-HQ' && $visitedTownType == 'HQ' && $endTownType == 'NON-HQ') {
                $tripType = 'OS';
            } else if ($startTownType == 'HQ' && $visitedTownType == 'NON-HQ' && $endTownType == 'HQ') {
                $tripType = 'EX-HQ';
            }
            return $tripType;
        }
    }

    public function getBestRoute($attendance_id)
    {
        $attendance = EntitiesAttendanceQuery::create()->findPk($attendance_id);
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
}

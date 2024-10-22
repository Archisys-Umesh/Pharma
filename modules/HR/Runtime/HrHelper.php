<?php declare(strict_types = 1);

namespace Modules\HR\Runtime;

use entities\Zones;
use entities\Territories;
use BI\manager\OrgManager;
use entities\AttendanceQuery;
use entities\PositionsQuery;
use Modules\HR\Exceptions\InvalidArgumentException;


class HrHelper
{
    public static function getAllowedUnits(\entities\Employee $emp)
    {                
        //$units = $emp->getAuditEmpUnitss();
        $units = \entities\OrgUnitQuery::create()
                ->filterByCompanyId($emp->getCompanyId())
                ->find();
                           
        //$units->getOrgunitid()
        $list = [];
        foreach($units as $u)
        {
            array_push($list, $u->getOrgunitid());    
        }
        
        
        return $list;
        
    }
    public static function getESSBranchAdminEmployee($branch) {
        $employeeid = \entities\EmployeeQuery::create()
                    ->filterByBranchId($branch)
                    ->select("EmployeeId")
                    ->find()->toArray();
        return $employeeid;
    }
    public static function getESSOrgAdminEmployee($company_id) {
        $employeeid = \entities\EmployeeQuery::create()
                    //->filterByOrgUnitId($orgUnitId)
                    ->filterByCompanyId($company_id)
                    ->select("EmployeeId")
                    ->find()->toArray();
        return $employeeid;
    }
    
    public static function getEmployesForManager($company_id,$branchId) {
        $employeeid = \entities\EmployeeQuery::create()
                    ->filterByBranchId($branchId)
                    ->filterByCompanyId($company_id)
                    ->select("EmployeeId")
                    ->find()->toArray();
        return $employeeid;
    }
    public static function createUser(\entities\Employee $emp,$roleid,$password,$app)
    {
        $userExists = \entities\UsersQuery::create()
                ->findByEmployeeId($emp->getPrimaryKey());
        if($userExists->count() > 0)
        {
            return false;
        }
        else 
        {
            
            $user = new \entities\Users();
            $user
                ->setCompanyId($emp->getCompanyId())
                ->setUsername($emp->getEmail())
                ->setIsdCode('+91')
                ->setName($emp->getFirstName().' '.$emp->getLastName())
                ->setPhone($emp->getPhone())
                ->setRoleId($roleid)
                ->setEmployeeId($emp->getPrimaryKey())
                ->setPassword(md5($password))
                ->setStatus(1)
                ->save();
            
            $event = new \Modules\System\Runtime\userEvents($app);
            $event->inviteUserEvent($emp,$password);
        }
    }
    
    public static function firstDataSetup($company_id,$password,$app,$countryId)
    {
        
        $company = \entities\Base\CompanyQuery::create()
                ->findPk($company_id);        

        if($company->getCompanyFirstSetup() == 0)
        {
            
            // Org Unit
            $orgUnit = new \entities\OrgUnit();
            $orgUnit->setUnitName("My Orginization");

            if($company->getCompanyDefaultCurrency() > 0){
                $orgUnit->setCurrencyId($company->getCompanyDefaultCurrency());
            }else{
                $orgUnit->setCurrencyId(1);
            }
            $orgUnit->setCompanyId($company_id);
            if($countryId == 0){
                $orgUnit ->setCountryId(1);
            }else{
                $orgUnit ->setCountryId($countryId);
            }

            $orgUnit ->save();

            // Position
            $position = new \entities\Positions();
            $position
                ->setPositionCode("CMD")
                ->setCompanyId($company_id)
                ->setPositionName("CMD")
                ->setReportingTo(0)
                ->setOrgUnitId($orgUnit->getPrimaryKey())
                ->save();

            // Designation
            $designation = new \entities\Designations();
            $designation
                ->setDesignation("CMD")                    
                ->setCompanyId($company_id)
                ->save();
            
            (new \entities\Designations())
                    ->setDesignation("Manager")                    
                    ->setCompanyId($company_id)
                    ->save();
            
            (new \entities\Designations())
                    ->setDesignation("MR")                    
                    ->setCompanyId($company_id)
                    ->save();
            
               
            // Branch
            $branch = new \entities\Branch();
            $branch
                ->setBranchname("Head Office")
                ->setBranchcode("HQ")                                
                ->setCompanyId($company_id)
                ->save();
        
            // Grade
            $grade = new \entities\GradeMaster();
            $grade
                ->setGradeName("Class A")
                ->setCompanyId($company_id)
                ->save();

            $policy = new \entities\PolicyMaster();
            $policy->setPolicyName("Class A");
                if($policy->getCurrencyId() == ''){
                $policy->setCurrencyId($company->getCompanyDefaultCurrency());
                }else{
                $policy->setCurrencyId($$company->getCompanyDefaultCurrency());
                }
                $policy->setPolicyCode("A")                    
                ->setOrgUnitId($orgUnit->getPrimaryKey())
                ->setCompanyId($company_id)
                ->save();
            
            (new \entities\GradePolicy())
                    ->setGradeid($grade->getPrimaryKey())
                    ->setPolicyId($policy->getPrimaryKey())
                    ->save();
            
            // Budget
            $budget = new \entities\BudgetGroup();
            $budget
                ->setGroupName("Sales")
                ->setGroupcode("S001")
                ->setMaxlimit(1000000)
                ->setStatus(1)
                ->setCompanyId($company_id)
                ->save();
            
            (new \entities\BudgetGrades())
                    ->setBgid($budget->getPrimaryKey())
                    ->setGradeId($grade->getPrimaryKey())
                    ->save();
            
            // Default Expenses & Keys
            
            $defaultExpensys = ["TA","DA"];
            
            foreach($defaultExpensys as $expense_name)
            {
                (new \entities\Policykeys())
                    ->setCompanyId($company_id)
                    ->setPkeys($expense_name)
                    ->setPgroup("Daily")
                    ->save();
                
                $expenseRecord = new \entities\ExpenseMaster();
                $expenseRecord
                    ->setCompanyId($company_id)
                    ->setExpenseName($expense_name)
                    ->setDefaultPolicykey($expense_name)
                    ->setTrips(0)
                    ->setIsMandatory($expenseRecord->getIsMandatory())
                    ->save();
            
                (new \entities\BudgetExp())
                    ->setBgid($budget->getPrimaryKey())
                    ->setExpenseId($expenseRecord->getPrimaryKey())
                    ->save();                
            }
                                                    
            $employee = new \entities\Employee();
            $employee
                    ->setEmployeeCode("001")
                    ->setFirstName($company->getOwnerName())
                    ->setLastName("")
                    ->setEmail($company->getOwnerEmail())
                    ->setBranch($branch)
                    ->setDesignations($designation)
                    ->setPositionId($position->getPrimaryKey())
                    ->setReportingTo($position->getPrimaryKey())
                    ->setGradeMaster($grade)
                    ->setOrgUnit($orgUnit)                    
                    ->setStatus(1)
                    ->setCompanyId($company->getPrimaryKey())
                    ->save();
            
            $configuration = new \entities\Configuration();
            
            $configuration
                    ->setAdminEmail($company->getOwnerEmail())
                    ->setFromName($company->getOwnerName())
                    ->setMailFrom($company->getOwnerEmail())
                    ->setAdminCc($company->getOwnerEmail())
                    ->setCompanyId($company->getPrimaryKey())
                    ->save();                        
            
            $password = '12345678';
            if(isset($_POST['Password'])){
                $password = $_POST['Password'];
            }
            
            $users = new \entities\Users();
            $users
                    ->setCompanyId($company->getPrimaryKey())
                    ->setUsername($company->getOwnerEmail())
                    ->setName($company->getOwnerName())
                    ->setRoleId(2)
                    ->setDefaultUser(1)
                    ->setEmployeeId($employee->getPrimaryKey())
                    ->setPassword(md5($password))
                    ->setStatus(1)
                    ->save();
                    
                    
            
            $company->setCompanyFirstSetup(1);
            $company->save();
            
            
            $event = new \Modules\System\Runtime\userEvents($app);
            $event->welcomeEvent($company,$password);
            
        }
    }
    
    public static function findEmpsUnder($position_id)
    {
        $position = PositionsQuery::create()->findPk($position_id);
        $team = $position->getCavPositionsDown();
        $currentDate =date('Y-m-d');
        $emps = [];
        if($team != "") {
        
            $positions = explode(",",$team);

            $emps = \entities\EmployeeQuery::create()
                ->select(["EmployeeId"])
                ->useHrUserDatesQuery()
                    ->filterByJoinDate($currentDate,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->endUse()
                ->filterByStatus(1)
                ->findByPositionId($positions)
                ->toArray();
        }
        return $emps;
        
    }
    
   public static function getDayLockedEmployees($company_id)
   {

    $emps = AttendanceQuery::create()
                ->select(['EmployeeId'])                
                ->filterByStatus(-1)
                ->filterByCompanyId($company_id)
                ->find()->toArray();
                
    return array_unique($emps);
   }


}

<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class expensesApproval implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "expensesApproval";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess_branch_admin"];        
    }

    public function getWidgetDesc() {
        return "Add Claims";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        $ratecount = [];
        $month = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(12);
        $monthKays = array_keys($month);

        $start = end($monthKays);
        $end = reset($monthKays);

        $startMonth = explode("|", $start);
        $endMonth = explode("|", $end);
        $employeeid = 0;
        if($this->app->Auth()->checkPerm("ess_branch_admin")){
            $branch = $this->app->Auth()->getUser()->getEmployee()->getBranchId();
            $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($branch);
        }
        if($this->app->Auth()->checkPerm("ess_org_admin")){
            //$orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
            $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
        }
        $entity = \entities\ExpensesQuery::create()
                ->filterByEmployeeId($employeeid)
                ->filterByExpenseStatus([2,3])
                ->filterByExpenseDate($startMonth[0],\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($endMonth[1],\Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
                ->find();
        if($entity){
            foreach ($entity as $e){
                $dates = $e->getExpenseDate()->format('Y-m-d');
                if(!isset($ratecount[$dates])) {
                    $ratecount[$dates]['day'] = 0;
                    $ratecount[$dates]['submitted'] = 0;
                    $ratecount[$dates]['approved'] = 0;
                }
                if(array_key_exists($dates, $ratecount)){
                    $ratecount[$dates]['day'] = $e->getExpenseDate()->format('Y-m-d');
                    if($e->getExpenseStatus() == 2){
                        $ratecount[$dates]['submitted'] += 1;
                    }else{
                        $ratecount[$dates]['approved'] += 1;
                    }
                } else {
                    $ratecount[$dates]['day'] = $e->getExpenseDate()->format('Y-m-d');
                    if($e->getExpenseStatus() == 2){
                        $ratecount[$dates]['submitted'] = 0;
                    }else{
                        $ratecount[$dates]['approved'] = 0;
                    }
                }
            }
        }
        $this->data['expensescount'] = $ratecount;
        
        return $this->app->Renderer()->render("hr/homeWidget/expensesApproval.twig",$this->data,FALSE);
    }

    public function parameters($params) {
        
    }

}    
<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class branchSalesCharts implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "expensesApproval";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess_org_admin"];        
    }

    public function getWidgetDesc() {
        return "Add Claims";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        
        $bc = new \App\Core\BaseController();
        
        $month = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(3);
        $monthKays = array_keys($month);

        $start = end($monthKays);
        $end = reset($monthKays);

        $startMonth = explode("|", $start);
        $endMonth = explode("|", $end);
        
        $ratecount = [];
        if($this->app->Auth()->checkPerm("ess_org_admin")){
                                    
            $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
        }
        $branchExpense = 0;
        $entity = \entities\ExpensesQuery::create()
                ->filterByEmployeeId($employeeid)
                ->filterByExpenseDate($endMonth[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($endMonth[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                //->filterByExpenseStatus(10)
                ->find();
        if($entity){
            foreach ($entity as $e){
                $dates = $e->getEmployee()->getBranchId();
                if(!isset($ratecount[$dates])) {
                    $ratecount[$dates]['branchName'] = 0;
                    $ratecount[$dates]['branchExpenseCount'] = 0;
                    $ratecount[$dates]['branchcolor'] = 0;
                    $ratecount[$dates]['branchcurrency'] = 0;
                    
                }
                if(array_key_exists($dates, $ratecount)){
                    $ratecount[$dates]['branchName'] = $e->getEmployee()->getBranch()->getBranchname()."-".$e->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
                    $ratecount[$dates]['branchExpenseCount'] += $e->getExpenseFinalAmt();
                    $ratecount[$dates]['branchcolor'] = self::rendomcolorcode();
                    $ratecount[$dates]['branchcurrency'] = $e->getEmployee()->getOrgUnit()->getCurrencies()->getSymbol();                    
                } else {
                    $ratecount[$dates]['branchExpenseCount'] = $e->getExpenseFinalAmt();
                    
                }
            }
        }
        
        $this->data['branchExpense'] = $ratecount;
        return $this->app->Renderer()->render("hr/homeWidget/branchSalesCharts.twig",$this->data,FALSE);
    }
    static function rendomcolorcode(){
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#'.$rand[rand(0,14)].$rand[rand(0,14)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        return $color;
    }

    public function parameters($params) {
        
    }

}    
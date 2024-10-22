<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class payoutPerBudget implements \Modules\System\Interfaces\Widget 
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
        return "Payout";
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
        
        $entity = \entities\ExpensesQuery::create()
                ->filterByEmployeeId($employeeid)
                ->filterByExpenseDate($endMonth[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($endMonth[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                
                ->find();
        
        $payoutdata = array();
        
        if($entity){
        foreach ($entity as $e){

                $data = $e->getBudgetId();
                
                if(!isset($payoutdata[$e->getBudgetGroup()->getGroupName()." | ".$e->getBudgetGroup()->getGroupcode()])){
                    $payoutdata[$e->getBudgetGroup()->getGroupName()." | ".$e->getBudgetGroup()->getGroupcode()]  = 0;
                }
                    $payoutdata[$e->getBudgetGroup()->getGroupName()." | ".$e->getBudgetGroup()->getGroupcode()] += $e->getExpenseReqAmt();                                
                } 
        }
                    
                   foreach($payoutdata as $row){
                        $this->data['budget']['color'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    }


                    $this->data['budget']['labels'] = array_keys($payoutdata);

                    $this->data['budget']['data'] = array_values($payoutdata);
                    
        
                   //var_dump($this->data['budget']);exit;
        
        return $this->app->Renderer()->render("hr/homeWidget/payoutPerBudget.twig",$this->data,FALSE);
    }
   

    public function parameters($params) {
        
    }

}    
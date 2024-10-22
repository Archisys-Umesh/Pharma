<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class monthlyExpense implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $param;
    protected $data = [];
    protected $widgetName = "monthlyExpenses";
    
    public function __construct(\App\System\App $app)
    {
        
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess_branch_admin","ess_org_admin"];        
    }

    public function getWidgetDesc() {
        return "monthly expenses";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
                
        $month = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
               
                
                $month_exp = \entities\ExpensesQuery::create()
                        ->filterByEmployeeId($this->param['getEmployeeId'])
                        ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                        ->find();
                
                $monthExp = array();
                foreach($month_exp as $exp){                    
                    if(!isset($monthExp[$exp->getExpenseDate()->format('F')] )){
                        $monthExp[$exp->getExpenseDate()->format('F')]  = 0;
                    }
                    $monthExp[$exp->getExpenseDate()->format('F')] += $exp->getExpenseFinalAmt();
                }

                
                $this->data['monthlyExp']['labels'] = array_keys($monthExp);
                
                $this->data['monthlyExp']['data'] = array_values($monthExp);
        
        return $this->app->Renderer()->render("hr/profileWidget/monthlyExpense.twig",$this->data,FALSE);
    }

    public function parameters($params) {
        $this->param = $params;
    }

}    
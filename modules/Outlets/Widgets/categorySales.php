<?php declare(strict_types = 1);

namespace Modules\Outlets\Widgets;

use App\System\App;

class categorySales implements \Modules\System\Interfaces\Widget 
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
        return "category expenses";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
                
        $month = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
               
                
                $exp_id = \entities\ExpensesQuery::create()
                        ->select('ExpId')
                        ->filterByEmployeeId($this->param['getEmployeeId'])
                        ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                        ->find()->toArray();
                
                $expense = \entities\ExpenseListQuery::create()
                        ->filterByExpId($exp_id)
                        ->find();
                
                $category = \entities\Base\ExpenseMasterQuery::create()->find()->toKeyValue("expenseId","expenseName");
        
                $categoryExp = array();
                foreach($expense as $exp){                    
                    if(!isset($categoryExp[$category[$exp->getExpMasterId()]])){
                        $categoryExp[$category[$exp->getExpMasterId()]]  = 0;
                    }
                    $categoryExp[$category[$exp->getExpMasterId()]] += $exp->getExpFinalAmount();
                }

                
                foreach($categoryExp as $row){
                    $this->data['categoryExp']['color'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
                
                
                $this->data['categoryExp']['labels'] = array_keys($categoryExp);
                
                $this->data['categoryExp']['data'] = array_values($categoryExp);
                
        
        return $this->app->Renderer()->render("outlets/profileWidget/categorySales.twig",$this->data,FALSE);
    }

    public function parameters($params) {
        $this->param = $params;
    }

}    
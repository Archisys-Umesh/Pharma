<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class myExpense implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $param;
    protected $data = [];
    protected $widgetName = "myExpenses";
    
    public function __construct(\App\System\App $app)
    {
        
            $this->app = $app;	            
            
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "my expenses";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        
        //$this->app->logger()->info("myExpense Constructor");
        
        $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->param['monthCount']);
        
        if(isset($this->param['employeeId'])){
            $EmployeeId = $this->param['employeeId'];
        }else{
            $EmployeeId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
        }
        
        $i = 0;
        foreach($months as $key => $val){
        
            $month = explode('|', $key);
            
            //$team_emps =  $this->auth->getUser()->getEmployee()->getBranch()->getEmployees()->toKeyIndex("EmployeeId");
            $data = array();
            $data['totalExp'] = \entities\ExpensesQuery::create()
                            ->select('total')
                            ->filterByEmployeeId($EmployeeId)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)    
                            ->filterByExpenseStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                            ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                            ->findOne();

            
            
            $totalDays = explode('-', $month[1])[2];
            
            $availableExp = \entities\ExpensesQuery::create()                            
                            ->filterByEmployeeId($EmployeeId)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                                
                            ->filterByExpenseStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                            ->find()->count();
            
            $data['percentage'] = $this->get_percentage($totalDays,$availableExp);
            $data['days'] = $availableExp.'/'.$totalDays;
            $data['label'] = ($i==0)?"Expenses for current month":"Expenses for previous month";
            $data['month'] = $val;
            
            $this->data['expense'][] = $data;
            $i++;
        }
        if(!\Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee()))
        return $this->app->Renderer()->render("hr/homeWidget/myExpense.twig",$this->data,FALSE);
        
    }

    public function parameters($params) {
        $this->param = $params;
    }
    
    function get_percentage($total, $number)
    {
      if ( $total > 0 ) {
       return round($number / ($total / 100),2);
      } else {
        return 0;
      }
    }

}    
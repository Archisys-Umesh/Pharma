<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class myTeamExpense implements \Modules\System\Interfaces\Widget 
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
        return ["ess_branch_admin"];        
    }

    public function getWidgetDesc() {
        return "my expenses";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
                
        $time = strtotime(date( 'Y-m-01' ));
        $month_start = date('Y-m-01 00:00:01',$time);
        $month_end = date('Y-m-t 23:59:59',$time);
        
        $this->data['thisMonthExp'] = \entities\ExpensesQuery::create()
                        ->select('total')
                        ->filterByEmployeeId($this->param['getEmployeeId'])
                        ->filterByExpenseDate($month_start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month_end, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)    
                        ->filterByExpenseStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->withColumn('SUM(expense_final_amt)', 'total')
                        ->findOne();
        
        $time = strtotime(date( 'Y-m-01' )."-1 month");
        $month_start = date('Y-m-01 00:00:01',$time);
        $month_end = date('Y-m-t 23:59:59',$time);
        
        $this->data['lastMonthExp'] = \entities\ExpensesQuery::create()
                        ->select('total')
                        ->filterByEmployeeId($this->param['getEmployeeId'])
                        ->filterByExpenseDate($month_start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month_end, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                        ->filterByExpenseStatus(7, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->withColumn('SUM(expense_final_amt)', 'total')
                        ->findOne();
        
        $this->data['percentage'] = $this->get_percentage($this->data['lastMonthExp'], $this->data['thisMonthExp']);
        
      //  return $this->app->Renderer()->render("hr/homeWidget/myTeamExpense",$this->data,FALSE);
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
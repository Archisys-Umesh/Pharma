<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class totalExpense implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $param;
    protected $data = [];
    protected $widgetName = "totalExpense";
    
    public function __construct(\App\System\App $app)
    {
        
            $this->app = $app;	            
            
    }

    public function allowedKeys(): array {
        return ["ess_org_admin","ess_branch_admin"];        
    }

    public function getWidgetDesc() {
        return "total expenses";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        
        //$this->app->logger()->info("totalExpense Constructor");
        
        $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(2);
        
        $CompanyId = $this->app->Auth()->getUser()->getCompanyId();
        
        $i = 0;
        foreach($months as $key => $val){
        
            $month = explode('|', $key);
            
              if($this->app->Auth()->checkPerm("ess_branch_admin")){
                    $branch = $this->app->Auth()->getUser()->getEmployee()->getBranchId();
                    $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($branch);
                }
            $data = array();
            $totalExp = \entities\ExpensesQuery::create()
                            ->select('total')
                            ->filterByCompanyId($CompanyId)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)    
                            ->withColumn('SUM(expense_final_amt)', 'total');
            
            
             if($this->app->Auth()->checkPerm("ess_branch_admin")){
                $branch = $this->app->Auth()->getUser()->getEmployee()->getBranchId();
                $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($branch);
                $totalExp = $totalExp->filterByEmployeeId($employeeid);
            }
            
            $data['totalExp'] =  $totalExp->findOne();

            
            
            
            $data['label'] = ($i==0)?'Team expenses for current month':'Team expenses for previous month';
            $data['url'] = ($i==0)?'':'?month=lastmonth';
            $data['month'] = $val;
            
            $this->data['expense'][] = $data;
            $i++;
        }
        
        return $this->app->Renderer()->render("hr/homeWidget/totalExpense.twig",$this->data,FALSE);
        
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
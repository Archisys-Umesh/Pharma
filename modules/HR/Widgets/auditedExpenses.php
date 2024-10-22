<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class auditedExpenses implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "auditedExpenses";
    protected $param = [];
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess_audit"];        
    }

    public function getWidgetDesc() {
        return "Add Claims";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    
    public function render() {
        
        $bc = new \App\Core\BaseController();
        
        $month = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($bc->getConfig("ESS", "allowedMonths"));
        $monthKays = array_keys($month);

        //$start = end($monthKays);
        //$end = reset($monthKays);
        $ReceivedforAudit = 0;
        $Audited = 0;
        $Validated = 0;
        
        foreach($monthKays as $month)
        {
            $m = explode("|", $month);
            $startMonth = $m[0];
            $endMonth = $m[1];
            //echo $startDate." | ".$endDate; 
            $ReceivedforAudit = $ReceivedforAudit + \entities\ExpensesQuery::create()
                    ->select(["EmployeeId"])
                    ->filterByExpenseDate($startMonth, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($endMonth, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(3)
                    ->groupByEmployeeId()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->count();
           /* $Audited = $Audited + \entities\ExpensesQuery::create()
                    ->filterByExpenseDate($startMonth, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($endMonth, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(6)
                    ->groupByEmployeeId()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            $Validated = $Validated + \entities\ExpensesQuery::create()
                    ->filterByExpenseDate($startMonth, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($endMonth, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(8)
                    ->groupByEmployeeId()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            * 
            */
        }
        
        $this->data['ReceivedforAudit'] = $ReceivedforAudit;
        //$this->data['Audited'] = $Audited;
        //$this->data['Validated'] = $Validated;
        return $this->app->Renderer()->render("hr/homeWidget/auditedExpenses.twig",$this->data,FALSE);
    }

    public function parameters($params) {
        $this->param = $params;   
    }

}    
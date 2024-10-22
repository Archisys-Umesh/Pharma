<?php declare(strict_types = 1);

namespace Modules\System\Widgets;

use App\System\App;
use Modules\System\Processes\WorkflowManager;

class setupGuide implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "setupGuide";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["any"];        
    }

    public function getWidgetDesc() {
        return "Setup Guide";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        $this->data['step'] = 0;
        $bc = new \App\Core\BaseController();
        
        if($this->app->Auth()->checkPerm("ess")){
            $ExpReqs = WorkflowManager::getPendingRequestPks("Expenses",$this->app);
            $TripsReqs = WorkflowManager::getPendingRequestPks("Trips",$this->app);

            $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
            $count = \Modules\ESS\Runtime\EssHelper::pendingExpensesTripCount($employeeId,$ExpReqs,$TripsReqs);

            $expensesApprove = $count['expensesApprove'];
            $tripApprove = $count['tripApprove'];               
            if($expensesApprove > 0 || $tripApprove > 0 ){
                if(\Modules\System\Runtime\UserTriggers::checkOnly("firstTimeApproval", $this->app->Auth()->getUser()->getUserId()))
                $this->data['step'] = 4;
            }
        }
        
        
        if($this->app->Auth()->checkPerm("ess_audit")){
            
            $ReceivedforAudit = 0;
            $Audited = 0;
        
                $ReceivedforAudit = \entities\ExpensesQuery::create()
                        ->select(["EmployeeId"])                        
                        ->filterByExpenseStatus(3)
                        ->groupByEmployeeId()
                        ->findByCompanyId($this->app->Auth()->CompanyId())->count();
                
               $Audited = \entities\ExpensesQuery::create()                        
                       ->select(["EmployeeId"])  
                        ->filterByExpenseStatus(6)
                        ->groupByEmployeeId()
                        ->findByCompanyId($this->app->Auth()->CompanyId())->count();
             
             
            if($ReceivedforAudit > 0 && $Audited == 0){
                $this->data['step'] = 3;
            }
        }
        
        
        if($this->app->Auth()->checkPerm("ess_org_admin")){
             $empCount = \entities\EmployeeQuery::create()
                     ->findByCompanyId($this->app->Auth()->CompanyId())->count();
             
             $totalExpHead = \entities\ExpenseMasterQuery::create()                       
                       ->findByCompanyId($this->app->Auth()->CompanyId())->count();
             
            if($empCount == 1){
                $this->data['step'] = 1;
            }else if($totalExpHead < $bc->getConfig("System","minimumExpCount")){
                $this->data['step'] = 2;
            }
            
        }
        
        return $this->app->Renderer()->render("system/widgets/setupGuide.twig",$this->data,FALSE);
    }
    
    public function parameters($params) {
        
    }

}    
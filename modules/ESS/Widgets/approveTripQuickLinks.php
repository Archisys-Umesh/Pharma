<?php declare(strict_types = 1);

namespace Modules\ESS\Widgets;

use App\System\App;
use Modules\System\Processes\WorkflowManager;

class approveTripQuickLinks implements \Modules\System\Interfaces\Widget
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "approveTripQuickLinks";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;		
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "Approved Trips";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        $ExpReqs = WorkflowManager::getPendingRequestPks("Expenses",$this->app);
        $TripsReqs = WorkflowManager::getPendingRequestPks("Trips",$this->app);
                
        $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
        $count = \Modules\ESS\Runtime\EssHelper::pendingExpensesTripCount($employeeId,$ExpReqs,$TripsReqs);
        
        $this->data['tripApprove'] = $count['tripApprove'];
        return $this->app->Renderer()->render("ess/homeWidget/approvetripWidgetEss.twig",$this->data,false);
    }

    public function parameters($params) {
        
    }

}    
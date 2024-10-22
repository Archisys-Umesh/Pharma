<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class employeeBalance  implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "employeeBalance";
    protected $param = [];
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "Employee Balance";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        
        $advance = new \Modules\HR\Runtime\AdvanceHelper($this->app);                
        $advanceBalance = number_format($advance->getBalance($this->app->Auth()->getUser()->getEmployeeId()),2);
        
        return "<h5 class='m-t-0 m-b-5'>Current balance : $advanceBalance</h5>";
        //$this->app->Renderer()->render("hr/homeWidget/employeeOntrip",$this->data,FALSE);
    }

    public function parameters($params) {
     $this->param = $params;   
    }

}    

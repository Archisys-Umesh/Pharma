<?php declare(strict_types = 1);

namespace Modules\ESS\Widgets;

use App\System\App;

class addTripQuickLinks implements \Modules\System\Interfaces\Widget
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "addTripQuickLinks";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;		
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "Add Trips";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        if(!$this->app->Auth()->checkPerm("ess_org_admin")) {
            return $this->app->Renderer()->render("ess/homeWidget/addtripWidgetEss.twig",$this->data,false);
        }
    }

    public function parameters($params) {
        
    }

    

}    

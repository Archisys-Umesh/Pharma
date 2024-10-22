<?php declare(strict_types = 1);

namespace Modules\ESS\Widgets;

use App\System\App;

class addClaimsQuickLinks implements \Modules\System\Interfaces\Widget
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "addClaimsQuickLinks";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;		
    }

    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "Add Claims";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        if(!\Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee()))
        {
            return $this->app->Renderer()->render("ess/homeWidget/addclaimsWidgetEss.twig",$this->data,false);
        }
    }

    public function parameters($params) {
        
    }

}    
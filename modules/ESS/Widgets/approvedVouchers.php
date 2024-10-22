<?php declare(strict_types = 1);

namespace Modules\ESS\Widgets;

use App\System\App;

class approvedVouchers implements \Modules\System\Interfaces\Widget
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "approvedVouchers";
    
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;		
    }
    
    public function allowedKeys(): array {
        return ["ess"];        
    }

    public function getWidgetDesc() {
        return "Approved Vouchers";
    }

    public function getWidgetName() {
     
        return $this->widgetName;
    }

    public function render() {
        
        return $this->app->Renderer()->render("ess/badgeWidgetEss.twig",$this->data,false);
    }

    public function parameters($params) {
        
    }

}
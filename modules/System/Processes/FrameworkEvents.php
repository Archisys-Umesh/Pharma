<?php declare(strict_types = 1);

namespace Modules\System\Processes;

class FrameworkEvents extends \App\Core\Process
{
    var $auth;
    
    function __construct(\App\Utils\Auth $auth) {
        $this->auth = $auth;
    }

    public function perMenuRenderHook($menu)
    {
        $companyid = $this->auth->CompanyId();
        // check config
        // Process menu , rename, remove etc
        // Return new menu
        
        $settlement = $this->auth->getUser()->getCompany()->getPaymentsystem() == 1;
                
        
        
        foreach($menu as &$m)
        {
            
            if($settlement && $m["index"] == 7)
            {                
                $m["title"] = "Settle";
                
            }
            if($settlement && $m["index"] == 1101)
            {                
                $m['path'] = "false";                
            }
            if($settlement && $m["index"] == 1104)
            {                
                $m['path'] = "false";                
            }
            
            
        }        
        return $menu;
    }
    
}
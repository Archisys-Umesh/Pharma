<?php declare(strict_types = 1);

namespace Modules\System\Processes;


class Widgets extends \App\Core\Process
{
    protected $auth;
    
    function __construct(\App\Utils\Auth $auth) {
        $this->auth = $auth;
    }

    public function render($class,$param = [])
    {
        try {
                $reflect = new \ReflectionClass($class);                
                if(!$reflect->implementsInterface(\Modules\System\Interfaces\Widget::class))
                {
                    return $class." Does not implement Widget interface";
                }
                $injector = $GLOBALS['injector'];
                $c = $injector->make($class);
                                
                $keys = $c->allowedKeys();
                $allowed = false;
                foreach($keys as $k)
                {
                    if($this->auth->checkPerm($k))
                    {
                        $allowed = true;
                        continue;
                    }
                }                
                if($allowed)
                {                    
                    $c->parameters($param);                    
                    return $c->render();
                }                                                        
            
        }
        catch(\Exception $e)
        {                            
            return $e->getMessage();            
        }
    }
}

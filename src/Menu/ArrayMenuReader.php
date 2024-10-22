<?php declare(strict_types = 1);

namespace App\Menu;

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;

class ArrayMenuReader implements MenuReader
{
    var $menu = [];
    
    public function readMenu()
    {
        
        $menu = array();
        
        $dir = __DIR__.'/../../modules';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){
            if(is_dir($dir."/$file") && $file != "." && $file != "..") 
            {                      
                if(file_exists($dir."/$file/Menu.php")) {
                    $menu = array_merge($menu,include($dir."/$file/Menu.php"));
                }
            }                
        }
        usort($menu, function ($item1, $item2) {
            return $item1['index'] <=> $item2['index'];
        });
        
        $this->menu = $menu;
        return $menu;
        
    }
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }
    public function writeMenu($routes)
	{
            $menu = $this->menu;
                                                            
            $factory = new MenuFactory();
            
            $root[""] = $factory->createItem('My menu');
            
            foreach($menu as $m)
            {
                if($m['path'] == "")
                {
                    $root[$m['title']] = $root[$m['parent']]->addChild($m['title'], array('uri' =>"#"));
                    $root[$m['title']]->setAttribute("id", strtolower($m['title']));
                }
                else {
                    $path = "";
                    if(is_array($m['path']))
                    {
                        $url = $routes->getPath($m['path'][0],$m['path'][1]);
                        $path = $m['path'][0];
                    }
                    else 
                    {
                        $url = $routes->getPath($m['path']);
                        $path = $m['path'];
                    }
                    if($url) {
                        $root[$m['title']] = $root[$m['parent']]->addChild($m['title'], array('uri' =>$url));                        
                        $root[$m['title']]->setAttribute("id", $path);
                    }
                }
                
                if(isset($root[$m['title']]) && isset($m['icon']))
                {
                    $root[$m['title']]->setAttribute("icon", $m['icon']);
                }
            }
            
            $root = $this->cleanMenu($root);
            $root = $this->cleanMenu($root);
            return $root[""];
            
	}
        
    public function cleanMenu($root)
    {
        foreach ($root as $r => $m)
        {
          if($m->getUri() == "#" )
          {
              if(!$m->hasChildren()) {
                $m->setDisplay(false);
                $root[""]->removeChild($r);

              }
              else 
              {
                  $m->setAttribute("class", "has_sub");                      
                  $m->setLinkAttribute("class","waves-effect");
                  $m->setChildrenAttribute("class", "list-unstyled");
              }
          }
        }

        return $root;
    }
    
}

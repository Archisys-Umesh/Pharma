<?php

namespace App\Utils;

use App\Utils\Auth;

class Router
{
    private $routes; 
    private $perms;
    public function __construct() {
        
        $auth = new Auth();        
        $this->routes = $this->getRoutes();
        $this->perms = $auth->getPerms();
        
    }
    
    public static function getRoutes()
    {        
        $routes = include(dirname(__DIR__).'/Routes.php');        
        
        
        
        $dir = __DIR__.'/../../modules';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){
            if(is_dir($dir."/$file") && $file != "." && $file != "..") 
            {           
                if(file_exists($dir."/$file/Routes.php")) {
                    $routes = array_merge($routes,include($dir."/$file/Routes.php"));
                }
            }                
        }        
        $auth = new Auth();
        $perms = $auth->getPerms();
        foreach($routes as $k => $r)
        {
            if(count($r) == 4)
            {                              
                if(!in_array($r[3][1], $perms)) {
                    
                    unset($routes[$k]);
                }                                    
            }
        }       
       
        return $routes;
    }
    
    public function getPath($pathName,$a = array())
    {               
       foreach($this->routes as $r)
       {
           if(count($r) == 4)
           {
               if($r[3][0] == $pathName)
               {                                      
                   if(!in_array($r[3][1], $this->perms)) {return false;}
                           
                   $url = $r[1];                   
                   if(count($a) > 0) { 
                       foreach($a as $k => $v)
                       {
                           $url =str_replace("{".$k."}", $v,$url);
                           
                       }                                                                     
                   }
                   
                   return $url;
               }
           }
       }
       return false;
    }
    
    public static function baseUrl($str = "")
    {
        // server protocol
        $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

        // domain name
        $domain = $_SERVER['SERVER_NAME'];

        // server port
        $port = $_SERVER['SERVER_PORT'];
        $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
		
        // put em all together to get the complete base URL
        $url = "{$protocol}://{$domain}{$disp_port}";
        
        if(isset($_ENV['AppUrl']))
        {
            $url = $_ENV['AppUrl'];
        }
        return $url."/".$str;
    }
    
    public static function getNoCheckRoute($path,$a = array())
    {
        $routes = include(dirname(__DIR__).'/Routes.php');        
        $dir = __DIR__.'/../../modules';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){
            if(is_dir($dir."/$file") && $file != "." && $file != "..") 
            {           
                if(file_exists($dir."/$file/Routes.php")) {
                    $routes = array_merge($routes,include($dir."/$file/Routes.php"));
                }
            }                
        }

       foreach($routes as $r)
       {
           if(count($r) == 4)
           {
               if($r[3][0] == $path)
               {
                  $url = $r[1];                   
                   if(count($a) > 0) { 
                       foreach($a as $k => $v)
                       {
                           $url =str_replace("{".$k."}", $v,$url);
                           
                       }                                                                     
                   }
                   
                   return $url; 
               }
           }
       }
       return "#";
    }
        
}
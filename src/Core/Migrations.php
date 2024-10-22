<?php declare(strict_types = 1);

namespace App\Core;

use App\System\App;
use Http\Request;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Migrations
{
 
    protected $app;
                
    public function __construct(App $app)
    {
        $this->app = $app;
    }
    
    public function start()
    {        
        
    }
        
}
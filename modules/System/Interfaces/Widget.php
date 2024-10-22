<?php declare(strict_types = 1);

namespace Modules\System\Interfaces;

interface Widget
{
    /*
     * Widget Unique Name
     */
    public function getWidgetName();
    
    /*
     * Widget Description
     */    
    public function getWidgetDesc();    
    
    /*
     *  Allowed Keys array to validate 
     */
    public function allowedKeys() : array;
    
    /*
     * Render function 
     */
    public function render();    
    
    /*
     *  Params
    */
    public function parameters($params);    
}
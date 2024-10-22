<?php declare(strict_types = 1);

namespace Modules\System\Interfaces;

interface Document
{
    /*
     * Description : Gets list for datatable records
     */
    public function getList();
    
    /*
     * Description : Create new Records 
     */
    public function initForm($pk);
    
    /*
     * Description : Returns Level for next Action
     */
    public function setNextAction($id,$stepid);
    
    /*
     * Description : 
     */
    public function single($id);
}
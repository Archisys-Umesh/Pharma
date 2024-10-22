<?php declare(strict_types = 1);

namespace Modules\ESS\Processes;

class DemoScript extends \App\Core\Process
{
    
    public function setExpensesDemoScript()
    {        
        $entity = \entities\ExpensesQuery::create()->find();
            if($entity){
                foreach ($entity as $e){
                    $date = date('m');
                    $final = date('Y-'.$date.'-d',strtotime($e->getExpenseDate()->format('Y-m-d')));
                    
                    if($e->getExpenseLists()){
                        foreach($e->getExpenseLists() as $el){
                            $el->setExpDate($final);
                            $el->save();
                        }
                    }
                    $e->setExpenseDate($final);
                    $e->save();
                }
            }        
    }
}



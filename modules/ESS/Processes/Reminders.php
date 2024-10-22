<?php declare(strict_types = 1);

namespace Modules\ESS\Processes;

class Reminders extends \App\Core\Process
{
    
    public function sendReminderToEmps()
    {
        $reminders = \entities\HrRemindersQuery::create()
                ->find();
        if($reminders){
            foreach($reminders as $r){
                if($r->getReminderAt() == date('d')){
                    $time = $r->getReminderTime();
                    $lessTime = date("H:i:s",strtotime(date($r->getReminderTime())." -5 minutes"));
                    $greterTime = date("H:i:s",strtotime(date($r->getReminderTime())." +5 minutes"));
                    if($time >= $lessTime && $time >= $greterTime){
                        //$degid = 
                    }
                }
            }
        }
        
    }
}
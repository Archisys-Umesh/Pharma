<?php declare(strict_types = 1);

namespace Modules\System\Runtime;

class UserTriggers
{    

    public static function checkOnce($trigger,$user_id) : bool
    {
        
        if(UserTriggers::checkOnly($trigger, $user_id))
        {
            (new \entities\UserTriggers())
                    ->setUserTrigger($trigger)
                    ->setUserId($user_id)
                    ->save();
            return true;
        }
        else
        {
            return false;
        }
                
    }
    
    public static function checkOnly($trigger,$user_id) : bool
    {
        $exists = \entities\UserTriggersQuery::create()
                ->filterByUserId($user_id)
                ->filterByUserTrigger($trigger)
                ->find();
        if($exists->count() > 0)
        {
            return false;
        }
        else {
           
            return true;
        }
    }
}

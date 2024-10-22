<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Processes;

use DateTime;
use Exception;

use entities\Users;
use entities\Employee;
use entities\UsersQuery;
use entities\EmployeeQuery;
use entities\WdbSyncRequestsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;

class SyncRunner extends \App\Core\Process
{
    protected $date;
    protected $redisClient;

    public function __construct() {

            date_default_timezone_set("Asia/Calcutta");
            $timezone = new \DateTimeZone("Asia/Calcutta");
            $date = new DateTime();
            $date->setTimezone($timezone);
            $date->setTimestamp(631155600);

            $this->date = $date;

            $this->redisClient = new \Predis\Client($_ENV['REDIS_URL']."?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
        
    }

    public function runner()
    {
        while(true)
        {
            $wdbReq = WdbSyncRequestsQuery::create()->orderByCreatedAt(Criteria::ASC)->findOneByStatus("new");
            if($wdbReq != null) {

                echo "Picked up ".$wdbReq->getPrimaryKey()." for User ".$wdbReq->getUserId();
                $wdbReq->setStatus("fetch");
                $wdbReq->save();

                $user = UsersQuery::create()->findPk($wdbReq->getUserId());
                try {
                    $data = $this->builtData($user);

                    $data = json_encode($data);
                    $this->redisClient->set("WDB-".$wdbReq->getPrimaryKey(),$data);                    

                    $wdbReq->setS3Url(mb_strlen($data,"8bit"));
                    $wdbReq->setStatus("ready");
                    $wdbReq->save();

                    unset($data);
                    echo "WDB-".$wdbReq->getPrimaryKey()." Ready".PHP_EOL;

                }
                catch(Exception $e)
                {
                    $wdbReq->setStatus("new");
                    $wdbReq->setS3Url($e->getMessage());
                    $wdbReq->save();
                    echo $e->getMessage()." ".PHP_EOL;
                }
                
            }            

            $from_date = date('Y-m-d'); 
            
            $wdbReq = WdbSyncRequestsQuery::create()
                            ->filterByStatus("ready")
                            ->filterByCreatedAt($from_date,Criteria::LESS_THAN)
                            ->findOne();
            if($wdbReq != null)
            {
                
                $this->redisClient->del("WDB-".$wdbReq->getPrimaryKey());
                $wdbReq->setStatus("deleted");
                $wdbReq->save();
                echo "Removed : WDB-".$wdbReq->getPrimaryKey().PHP_EOL;
            }

            echo "WDB Request Wait".PHP_EOL;
            sleep(3);
            
        }
    }

    public function builtData(Users $user)
    {
            $recs = [];            

            $dir = __DIR__.'/../Models';
            $dh = opendir($dir);
            while (($file = readdir($dh)) !== false){

                if(!is_dir($dir."/$file") && $file != "." && $file != "..") 
                {                    

                    $className = explode(".",$file);
                    $path = "Modules\OfflineSync\Models\\".$className[0];                        

                    $class = new \ReflectionClass($path);
                    $this->pullData($class->newInstance(),$user,$this->date,$recs);                                                                                                                            
                                        
                }

            }
           

            $finalData =    [ 
                "changes" => $recs, 
                "timestamp" =>  time(),
                "schemaVersion" => 1,
                "migration" => null,                                 
                ];
        
        return $finalData;
    }

    public function pullData(OfflineModelInterface $interface,$empRec,$date,&$rec)
    {
        if($interface->canRun())
        {
            $interface->setApp($empRec);
            
            $data = $interface->doRecordsToSend($date)->toArray();

            $rec = array_merge($rec,$data);
            
        }
        
    }
}
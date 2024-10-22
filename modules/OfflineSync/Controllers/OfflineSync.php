<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Controllers;

use DateTime;
use Exception;
use DateInterval;
use App\System\App;
use App\Utils\FormMgr;
use entities\WdbSyncLog;
use entities\WdbSyncLogQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;

/**
 * Description of OfflineSync - Admin UI
 *
 * @author Chintan Parikh
 */
class OfflineSync extends \App\Core\BaseController{
   
    protected $app;
    
    protected $recs = [];


    public function __construct(App $app)
    {
            $this->app = $app;               
            date_default_timezone_set("Asia/Calcutta");
    }    


    public function PullRec($date)
    {        
            $this->recs = [];            

            $dir = __DIR__.'/../Models';
            $dh = opendir($dir);
            while (($file = readdir($dh)) !== false){

                if(!is_dir($dir."/$file") && $file != "." && $file != "..") 
                {
                    try{

                        $className = explode(".",$file);
                        $path = "Modules\OfflineSync\Models\\".$className[0];                        

                        $class = new \ReflectionClass($path);
                        $this->pullData($class->newInstance(),$date,$this->recs);                                                                                                                            

                    }
                    catch(Exception $e)
                    {
                        $this->json(["error" => $e->getMessage()]);
                        var_dump($e->getMessage());exit;
                    }
                }

            }

            $this->getRecsToDelete($date,$this->app->Auth()->getUser()->getUserId(),$this->app->Request()->getParameter("apptoken"),$this->recs);

            if(isset($_ENV['noPull']) && $_ENV['noPull'] == 1)
            {
                $this->recs = [];
            }

            $this->json([ 
                "changes" => $this->recs, 
                "timestamp" =>  time(),
                "schemaVersion" => 1,
                "migration" => null,                                 
                ]);
                                           
    }

    public function pullData(OfflineModelInterface $interface,$date,&$rec)
    {
        if($interface->canRun())
        {
            $interface->setApp($this->app->Auth()->getUser());
            
            $data = $interface->doRecordsToSend($date)->toArray();

            $rec = array_merge($rec,$data);
            
        }
        
    }
        
    public function pushRec($changes,$date)
    {
             
        $this->recs = [];
        $dir = __DIR__.'/../Models';
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false){

            if(!is_dir($dir."/$file") && $file != "." && $file != "..") 
            {
                try{

                    $className = explode(".",$file);
                    $path = "Modules\OfflineSync\Models\\".$className[0];                        

                    $class = new \ReflectionClass($path);
                    $this->pushData($class->newInstance(),$date,$changes,$this->recs);                                                                            

                }
                catch(Exception $e)
                {
                    $this->json(["error" => $e->getMessage()]);
                }
            }

        }

        
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call reco_dayplan_sync()");

        $this->json([ "status" => $this->recs]);

    }

    public function pushData(OfflineModelInterface $interface,$date,&$changes,&$recs)
    {
        
        $tableName = $interface->getTableName();
        
        if($interface->canRun() && isset($changes[$tableName]))
        {                        

            $interface->setApp($this->app->Auth()->getUser());

            $wdbTable = new WDBTable();
            
            $wdbTable->fromArray($tableName,$changes[$tableName]);
            
            $interface->doRecordsToReceive($date,$wdbTable);

            $log = $interface->getLog();
            if($log != null) {

                $recs = array_merge($recs,$log);
                
            }
            
        }
        
    }

    public function getRecsToDelete($date,$user_id,$token_id,&$rec)
    {
        $date = $date->sub(new DateInterval('PT1H30M'));
        //$from_date = date('Y-m-d h:m', strtotime("-120 minutes")); 
        $from_date = $date->sub(new DateInterval("P2D"));
        $toDelete = [];
        $createdRecs = WdbSyncLogQuery::create()
                        ->select(['SysTable','WdbKey'])
                        //->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterBySysOperation("created")
                        ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
                        ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)
                        ->filterByUserId($user_id)
                        ->filterByTokenId($token_id)
                        ->find()->toArray();
        foreach($createdRecs as &$wdblog)
        {
            if(!isset($toDelete[$wdblog['SysTable']]))
                {
                    $toDelete[$wdblog['SysTable']] = [];
                }
            
            $toDelete[$wdblog['SysTable']][] = $wdblog['WdbKey'];
        }

        unset($createdRecs);

        foreach($this->recs as $table => $ops)
        {
            if(isset($toDelete[$table]))
            {
                $this->recs[$table]["deleted"] = array_merge($ops["deleted"],$toDelete[$table]);
            }
        }
        
    }
   
    public function wdbrestore()
    {
            $token = $this->app->Request()->getParameter("apptoken");
            $systable = $this->app->Request()->getParameter("table");
            $wdblogs = WdbSyncLogQuery::create()
                        ->filterByTokenId($token)
                        ->filterByResMessage(['New Rec Created'],Criteria::NOT_IN)
                        ->filterBySysTable($systable)
                        ->filterBySysOperation('created')                        
                        ->find();
            foreach($wdblogs as $wd)
            {
                switch($wd->getSysTable()) : 
                    case "DayPlan":
                            try {

                                $rec = json_decode($wd->getSysBody(),true);

                                unset($rec["DayplanId"]); // Remove PK

                                $Dayplan = new \entities\Dayplan();
                                $Dayplan->fromArray($rec);
                                $Dayplan->setCompanyId($this->app->Auth()->CompanyId());
                                $Dayplan->save();

                                $wd->setNewpk($Dayplan->getPrimaryKey());
                                $wd->setResMessage("New Rec Created");
                                $wd->save();
                            }
                            catch(\Exception $e)
                            {             
                                
                                //$this->log[$rec["id"]] = $e->getMessage();
                                $wd->setResMessage($e->getPrevious()->getMessage());
                                $wd->save();
                            }


                        break;
                endswitch;
                    
            }
    }
}
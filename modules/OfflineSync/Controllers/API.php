<?php

declare(strict_types = 1);

namespace Modules\OfflineSync\Controllers;

use DateTime;
use App\System\App;
use entities\MediaFiles;
use App\Utils\ImageUploader;
use entities\WdbSyncRequests;
use entities\Base\TicketTypeQuery;
use entities\WdbSyncRequestsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Controllers\OfflineSync;

/**
 * Description of API
 *
 * @author Chintan Parikh
 */
class API extends \App\Core\BaseController {

    protected $app;
    protected $redisClient;

    public function __construct(App $app) {
        $this->app = $app;
        $this->redisClient = new \Predis\Client($_ENV['REDIS_URL']."?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
        ini_set('memory_limit','512M');
    }

    /**
     * @OA\Get(
     *     path="/sync/pull",
     *     tags={"Watermelon DB Bridge"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="query",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="last_pulled_at",
     *         in="query",
     *         description="last_pulled_at (time)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all ticket types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function pull() {

        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $last_pulled_at = $this->app->Request()->getParameter("last_pulled_at","null");
                $version = $this->app->Request()->getParameter("version","1");

                if($last_pulled_at == "null")
                {
                    //$from_date = date('Y-m-d', strtotime("-30 minutes")); 
                    $wdbreq = WdbSyncRequestsQuery::create()
                            ->filterByUserId($this->app->Auth()->getUser()->getUserId())
                            //->filterByCreatedAt($from_date,Criteria::GREATER_THAN)       
                            ->filterByStatus("deleted",Criteria::NOT_EQUAL)
                            ->findOne();
                    if($wdbreq == null)
                    {
                        $wdbReq = new WdbSyncRequests();
                        $wdbReq->setUserId($this->app->Auth()->getUser()->getUserId());
                        $wdbReq->setStatus("new");
                        $wdbReq->save();
                        if ($version == "2")
                        {
                            $this->apiResponse([],300,"We are preparing the system for you, Please retry in next few mins.");                        
                            return;
                        }
                        else {
                            $this->app->Response()->setHeader("Content-Type", "text/html");                
                            $this->app->Response()->setContent("We are preparing the system for you, Please retry in next few mins.");
                            $this->app->Response()->setStatusCode(300);                            
                            return;
                        }
                        
                        
                    }                    
                    else if($wdbreq->getStatus() == "ready")
                    {
                        $key = "WDB-".$wdbreq->getPrimaryKey();
                        if($this->redisClient->exists($key))
                        {
                            $data = $this->redisClient->get("WDB-".$wdbreq->getPrimaryKey());
                            $this->app->Response()->setHeader("Content-Type", "application/json");                
                            $this->app->Response()->setContent($data);
                        }
                        else 
                        {
                            $wdbreq->setStatus("deleted");
                            $wdbreq->save();
                            $this->apiResponse([],300,"Please retry in next few mins.");                                                    
                        }
                            
                        return;
                    }
                    else
                    {
                        if ($version == "2")
                        {
                            $this->apiResponse([],300,"We are preparing the system for you, Please retry in next few mins.");
                            return;
                        }
                        else {
                            $this->app->Response()->setHeader("Content-Type", "text/html");                
                            $this->app->Response()->setContent("We are preparing the system for you, Please retry in next few mins.");
                            $this->app->Response()->setStatusCode(300);
                            return;
                        }
                    }                    

                }
                else {

                    if($last_pulled_at == "null") {$last_pulled_at = 631155600;}                

                    date_default_timezone_set("Asia/Calcutta");
                    $timezone = new \DateTimeZone("Asia/Calcutta");
                    $date = new DateTime();
                    $date->setTimezone($timezone);
                    $date->setTimestamp((int)$last_pulled_at);
                                    
                    $offline = new OfflineSync($this->app);
                    $offline->PullRec($date);
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/sync/push",
     *     tags={"Watermelon DB Bridge"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all ticket types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function push() {

        //ini_set('max_execution_time',0);
        set_time_limit(1000);

        switch ($this->app->Request()->getMethod()):
            case "POST" :

                $changes_object = $this->app->Request()->getParameter("changes",[]);                

                $changes = json_decode(json_encode($changes_object), true);

                $last_pulled_at = $this->app->Request()->getParameter("lastPulledAt",631155600);
                if($last_pulled_at == "null") {$last_pulled_at = 631155600;}                

                date_default_timezone_set("Asia/Calcutta");                

                $timezone = new \DateTimeZone("Asia/Calcutta");
                $date = new DateTime();
                $date->setTimezone($timezone);
                $date->setTimestamp((int)$last_pulled_at);
                                
                $offline = new OfflineSync($this->app);

                $offline->pushRec($changes,$date);

                break;
        endswitch;
    }

    
}

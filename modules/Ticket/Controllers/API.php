<?php

declare(strict_types = 1);

namespace Modules\Ticket\Controllers;

use App\System\App;
use entities\Base\TicketType;
use entities\Base\TicketTypeQuery;
use entities\MediaFiles;
use App\Utils\ImageUploader;
use entities\Survey;
use entities\SurveySubmited;
use entities\SurveySubmitedAnswer;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Processes\WorkflowManager;
use entities\MediaFilesQuery;

/**
 * Description of API
 *
 * @author Plus91Labs-01
 */
class API extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }






    /**
     * @OA\Get(
     *     path="/api/getAllTicket",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Filter",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get tickets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getAllTicket() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $filter = $this->app->Request()->getParameter("filter");
                $ticketArray = [];
                $totalArray = [];
                if ($filter!=null){
                if($filter=="ascending_order"){
                    $tickets = \entities\TicketsQuery::create()
                     ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","CreatedAt"])
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->orderBy('Outlets.OutletName', 'asc')
                        ->find()->toArray();



                } elseif ($filter=="descending_order"){
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->orderBy('Outlets.OutletName', 'desc')
                        ->find()->toArray();


                }  elseif ($filter=="recently_ticket"){
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->orderBy('Id',Criteria::DESC)
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();


                } elseif ($filter=="open_status"){

                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->filterByStatus('Open')
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                } elseif ($filter=="close_status"){
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->filterByStatus('Close')
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                } else {
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->joinWithTicketType()
                        ->joinWithOutlets()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                }
                } else {

                    $tickets = \entities\TicketsQuery::create()
//                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType","CreatedAt"])
                        ->joinWithOutlets()
                        ->joinWithTicketType()
//                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                }


                foreach ($tickets as $ticket){
                    $ticketArray['Id'] = $ticket['Id'];
                    $ticketArray['OutletName'] = $ticket['Outlets.OutletName'];
                    $ticketArray['TicketTypeId'] = $ticket['TicketTypeId'];
                    $ticketArray['OutletId'] = $ticket['OutletId'];
                    $ticketArray['EmployeeId'] = $ticket['EmployeeId'];
                    $ticketArray['Description'] = $ticket['Description'];
                    $ticketArray['EmployeeId'] = $ticket['EmployeeId'];
                    $ticketArray['IntegrationId'] = $ticket['IntegrationId'];
                    $ticketArray['AllocatedTo'] = $ticket['AllocatedTo'];
                    $ticketArray['Status'] = $ticket['Status'];
                    $ticketArray['CreatedAt'] = $ticket['CreatedAt'];
                    $ticketType = \entities\TicketTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterById($ticket['TicketTypeId'])
                        ->findOne()->toArray();

                    $ticketArray['TicketType'] = $ticketType;
                    $replies = \entities\TicketRepliesQuery::create()

                        ->filterByTicketId($ticket['Id'])
                        ->filterByCompanyId($this->app->Auth()->CompanyId())

                        ->find()->toArray();
                    $ticketArray['TicketReplies'] = $replies;
                    $totalArray[] = $ticketArray;
                }



                $this->apiResponse($totalArray, 200, "Get tickets successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getIdByTicket",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ticket_id",
     *         in="query",
     *         description="Ticket Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get tickets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getIdByTicket() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $TicketId = $this->app->Request()->getParameter("ticket_id");
                $tickets = \entities\TicketsQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterById($TicketId)
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->joinWithTicketType()
                                ->joinWithEmployeeRelatedByEmployeeId()
                                ->find()->toArray();
                
                $replies = \entities\Base\TicketRepliesQuery::create()
                        ->filterByTicketId($TicketId)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->joinWithEmployee()
                        ->find()->toArray();
                
                $this->apiResponse(["ticket" => $tickets,"replies" => $replies], 200, "Get tickets successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/ticketFilter",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Filter",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get tickets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function ticketFilter(){
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $filter = $this->app->Request()->getParameter("filter");
                if($filter=="ascending_order"){
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType"])
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->orderBy('Outlets.OutletName', 'asc')
                        ->find()->toArray();

                } elseif ($filter=="descending_order"){
                    $tickets = \entities\TicketsQuery::create()
                        ->select(["Id","TicketTypeId","OutletId","MediaId","Description","EmployeeId","IntegrationId","AllocatedTo","Status","Outlets.OutletName","TicketType.TicketType"])
                        ->joinWithOutlets()
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->orderBy('Outlets.OutletName', 'desc')
                        ->find()->toArray();
                }  elseif ($filter=="recently_ticket"){
                    $tickets = \entities\TicketsQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->orderBy('Id',Criteria::DESC)
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                } elseif ($filter=="open_status"){

                    $tickets = \entities\TicketsQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByStatus('Open')
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                } elseif ($filter=="close_status"){
                    $tickets = \entities\TicketsQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByStatus('Close')
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                } else {
                    $tickets = \entities\TicketsQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithTicketType()
                        ->leftJoinWithTicketReplies()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                }





                $this->apiResponse(["ticket" => $tickets], 200, "Get tickets successfully!");
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/getTicketReplies",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ticket_id",
     *         in="query",
     *         description="Ticket Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get ticket replies successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTicketReplies() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $ticketId = $this->app->Request()->getParameter("ticket_id");
                
                $ticketReplies = \entities\TicketRepliesQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->joinWithTickets()
                                ->joinWithEmployee()
                                ->filterByTicketId($ticketId)
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->find()->toArray();
                $this->apiResponse($ticketReplies, 200, "Get tickets replies successfully!");
                break;
        endswitch;
    }
   

    /**
     * @OA\Post(
     *     path="/api/createTicket",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\RequestBody(
     *          required=true,
     *          description="Create Ticket",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="ticket_type_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="outlet_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="6"
     *              ),
     *              @OA\Property(
     *                  property="note", 
     *                  type="text",
     *                  format="text",
     *                  example="Create new ticekt"
     *              ),
     *              @OA\Property(
     *                  property="upload_media_id", 
     *                  type="string",
     *                  format="string",
     *                  example="25,26,29"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ticket created successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function createTicket() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $TicketTypeId = $this->app->Request()->getParameter("ticket_type_id");
                $OutletId = $this->app->Request()->getParameter("outlet_id");
                $UploadMediaId = $this->app->Request()->getParameter("upload_media_id");
                $Note = $this->app->Request()->getParameter("note");

                $ticketType =  \entities\TicketTypeQuery::create()->findOneById($TicketTypeId);

                if($ticketType == null)
                {
                    throw new \Exception("Ticket Type not found, Please check ticket ticket_type_id",400);
                }

                $allocatedTo = $ticketType->getEmployeeId();                

                $status = $this->getConfig("Ticket", "ticketStatus");

                try {

                    $ticket = new \entities\Tickets();
                    $ticket->setTicketTypeId($TicketTypeId);
                    $ticket->setOutletId($OutletId);
                    $ticket->setMediaId($UploadMediaId);
                    $ticket->setDescription($Note);
                    $ticket->setAllocatedTo($allocatedTo);
                    $ticket->setStatus($status["Open"]);
                    $ticket->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                    $ticket->setCompanyId($this->app->Auth()->CompanyId());
                    $ticket->save();

                    $this->apiResponse($ticket->toArray(), 200, "Ticket created successfully.");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Post(
     *     path="/api/addTicketReplies",
     *     tags={"Ticket API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\RequestBody(
     *          required=true,
     *          description="Add Ticket Replies",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="ticket_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),    
     *              @OA\Property(
     *                  property="comment", 
     *                  type="text",
     *                  format="text",
     *                  example="Comment"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ticket replies add successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addTicketReplies() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :

                $ticketId = $this->app->Request()->getParameter("ticket_id");                
                $comment = $this->app->Request()->getParameter("comment");

                try {
                    $ticketReplies = new \entities\TicketReplies();
                    $ticketReplies->setTicketId($ticketId);
                    $ticketReplies->setTicketReplies($comment);
                    $ticketReplies->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                    $ticketReplies->setCompanyId($this->app->Auth()->CompanyId());
                    $ticketReplies->save();

                    $this->apiResponse($ticketReplies->toArray(), 200, "Ticket replies add successfully!");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/uploadMedia",
     *     tags={"Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="offline_media_id",
     *         in="query",
     *         description="Offline Media Id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ), 
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="media",
     *                      type="string",
     *                      format="binary",
     *                      description="Upload Media"
     *                   ),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Upload successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function uploadMedia() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $offlineMediaId = $this->app->Request()->getParameter("offline_media_id");
                $companyID = $this->app->Auth()->CompanyId();
                if (!empty($_FILES["media"]["name"])) {
                    // Get file info 
                    $fileName = basename($_FILES["media"]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Allow certain file formats 
                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                    if (in_array($fileType, $allowTypes)) {
                        $image = $_FILES['media']['tmp_name'];
                        $fileMime = $_FILES["media"]["type"];
                        $imgContent = file_get_contents($image);

                        // $file = base64_encode($imgContent); 
                        $base64 = 'data:image/' . $fileMime . ';base64,' . base64_encode($imgContent);
                        $s3 = WorkflowManager::initializeS3Client();
                        $bucket = $_ENV['STACKHERO_MINIO_AWS_BUCKET'];

                        $fullPath = (new \BI\manager\FileManager())->uploadFileIntoS3($bucket, $base64, $fileName);

                        $media = new MediaFiles();
                        $media->setMediaName($fileName);
                        $media->setMediaMime($fileMime);
                        $media->setMediaData($fullPath);
                        $media->setFolderId(null);
                        $media->setCompanyId($this->app->Auth()->CompanyId());
                        $media->setIss3file(true);
                        $media->save();

                        if($media != null){
                            $offlineMedia = \entities\OfflineMediaQuery::create()
                                                ->filterByOfflineMediaId($offlineMediaId)
                                                ->findOne();
                            if($offlineMedia != null && $offlineMedia->getModuleName() != null){
                                if($offlineMedia->getModuleName() == 'SurveyQuestion'){
                                    $surveySubmitedAns = new SurveySubmitedAnswer();
                                    $surveySubmitedAns->setSurveryQuestionId($offlineMedia->getModulePrimaryKey());
                                    $surveySubmitedAns->setSurveyAnswer($media->getMediaId());  
                                    $surveySubmitedAns->save();   
                                }
                            }
                        }
                        if ($media) {
                            return $this->apiResponse(['data' => $media->getMediaId()], 200, "File uploaded successfully.");
                        } else {
                            return $this->apiResponse([], 400, "File upload failed, please try again.");
                        }
                    } else {
                        return $this->apiResponse([], 422, "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.");
                    }
                } else {
                    return $this->apiResponse([], 404, "Please select an image file to upload.");
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Post(
     *     path="/api/uploadMediaBase64",
     *     tags={"Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\RequestBody(
     *          required=true,
     *          description="Upload Media",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="folder_id", 
     *                  type="string",
     *                  format="string",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="media", 
     *                  type="array",
     *                  collectionFormat="multi", 
     *                  @OA\Items(
     *                      type="string",
     *                      example={"baase64URL"},
     *                  )
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Upload successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function uploadMediaBase64() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $medias = $this->app->Request()->getParameter("media");
                $folderId = $this->app->Request()->getParameter("folder_id");
                $companyID = $this->app->Auth()->CompanyId();
                if (!empty($medias)) {
                    $ids = array();
                    foreach ($medias as $media) {
                        $imageDecode = base64_decode($media);
                        $size = getImageSizeFromString($imageDecode);
                        if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
                            die('Base64 value is not a valid image');
                        }
                        $imageMime = $size['mime'];
                        $data = explode('/', $imageMime);
                        $fileName = uniqid() . '.' . $data[1];
                        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                        $fileType = $data[1];
                        if (in_array($fileType, $allowTypes)) {
                            $imgSize = ImageUploader::getBase64ImageSize($media);
                            $mediaSRC = 'data:' . $imageMime . ';base64,' . $media;
                            if ($imgSize < 5) {
                                $mediaFile = new MediaFiles();
                                $mediaFile->setMediaName($fileName);
                                $mediaFile->setMediaMime($imageMime);
                                $mediaFile->setMediaData($mediaSRC);
                                $mediaFile->setFolderId($folderId);
                                $mediaFile->setCompanyId($companyID);
                                $mediaFile->save();
                                array_push($ids, $mediaFile->getMediaId());
                            } else {
                                return $this->apiResponse([], 422, "Sorry, your file is too large!");
                            }
                        } else {
                            return $this->apiResponse([], 422, "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload!");
                        }
                    }
                    return $this->apiResponse($ids, 200, "File uploaded successfully!");
                } else {
                    return $this->apiResponse([], 404, "Sorry, your file was not found!");
                }
                break;
        endswitch;
    }
    
//    public function getMedia() {
//        error_reporting(0);
//        switch ($this->app->Request()->getMethod()):
//            case "GET" :
//                $MediaIds = $this->app->Request()->getParameter("media_ids", "");
//
//                $ids = explode(',', $MediaIds);
//                if (!empty($ids)) {
//                    $dataArray = array();
//                    foreach ($ids as $id) {
//                        $media = \entities\MediaFilesQuery::create()->findPk($id);
//                        $data = array(
//                            'MediaId' => $media->getMediaId(),
//                            'MediaName' => $media->getMediaName(),
//                            'MediaMime' => $media->getMediaMime(),
//                            'MediaData' => $media->getMediaData(),
//                            'MediaData' => stream_get_contents($media->getMediaData(), -1, 0),
//                        );
//                        array_push($dataArray, $data);
//                    }
//                }
//                print_r($dataArray);
//                exit;
//                break;
//        endswitch;
//    }


  ////////////////////////S3 pdf/////////////////////
   /**
     * @OA\Post(
     *     path="/api/uploadFile",
     *     tags={"Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="mediafile",
     *                      type="string",
     *                      format="binary",
     *                      description="Upload Media File"
     *                   ),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Upload successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

     public function uploadFile()
        {
            $method = $this->app->Request()->getMethod();
        
            switch ($method) {
                case "POST":
                    return $this->handlePostRequest();
                default:
                    return $this->apiResponse([], 405, "Method not allowed.");
            }
        }
    /**
     * @OA\Get(
     *     path="/api/downloadFile",
     *     tags={"Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mediaid",
     *         in="query",
     *         description="media Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     *    
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function downloadFile()
    {
        $method = $this->app->Request()->getMethod();
        switch ($method) {
            case "GET":
                $companyID = $this->app->Auth()->CompanyId();
                $mediaId = $this->app->Request()->getParameter('mediaid');
                try {

                    if ($mediaId) {
                        $mediaFilesObject = $this->getMediaFilesObject($companyID, $mediaId);
                        $mediaKey = $mediaFilesObject->getMediaData();
                        $MediaMime   = $mediaFilesObject->getMediaMime();

                        if ($MediaMime == 'application/pdf') {                           
                            $s3 = WorkflowManager::initializeS3Client(); 
                            $retrive  = $s3->getObject([
                                'Bucket'  => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                                'Key' => $mediaKey,
                            ]);

                            $metadata  = $retrive['@metadata'];
                            if (isset($metadata['headers']['x-amz-request-id'])) {
                                // $xAmzRequestId               = $metadata['headers']['x-amz-request-id'];
                                return $this->apiResponse(['pdfurl' => $metadata['effectiveUri'], 'mediatype' => $MediaMime], 200, "File download successfully.");
                            } else {
                                return $this->apiResponse([], 400, "File download failed, please try again.");
                            }
                        } else {
                            return $this->apiResponse([], 400, "File download failed, please try again. file formate not a PDF");
                        }
                    } else {
                        return $this->apiResponse([], 400, "Media object with ID $mediaId not found.");
                    }
                } catch (\Exception $e) {
                    return $this->apiResponse([], 500, "Internal Server Error");
                }
                break;
        }
    }

   /**
     * @OA\Get(
     *     path="/api/deleteFile",
     *     tags={"Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mediaid",
     *         in="query",
     *         description="media Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     *    
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function deleteFile()
    {
        $method = $this->app->Request()->getMethod();

        if ($method === "GET") {
            $companyID = $this->app->Auth()->CompanyId();
            $mediaId = $this->app->Request()->getParameter('mediaid');

            try {
                if ($mediaId) {
                    $mediaFilesObject = MediaFilesQuery::create()
                        ->filterByCompanyId($companyID)
                        ->findPk($mediaId);

                    if (!$mediaFilesObject) {
                        return $this->apiResponse([], 400, "Media object with ID $mediaId not found.");
                    }

                    $mediaKey = $mediaFilesObject->getMediaData();

                    $s3 = WorkflowManager::initializeS3Client();

                    $s3->deleteObject([
                        'Bucket' => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                        'Key'    => $mediaKey,
                    ]);

                    $mediaFilesObject->delete();

                    return $this->apiResponse(['mediaId' => $mediaId], 200, "File deleted successfully.");
                } else {
                    return $this->apiResponse([], 400, "Media ID not provided.");
                }
            } catch (\Exception $e) {
                return $this->apiResponse([], 500, "Error deleting file: " . $e->getMessage());
            }
        }

        return $this->apiResponse([], 400, "Invalid request method.");
    }


  private function handlePostRequest()
  {
      $companyID = $this->app->Auth()->CompanyId();
      $data = $this->app->Request()->getFile('mediafile');
      $mediaId = $this->app->Request()->getParameter('mediaid');


      if (empty($data)) {
          return $this->apiResponse(['data' => $data], 400, "Input data is null.");
      }

      try {
          if (!empty($data['name'])) {
              $fileName = basename($data['name']);
              $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
               $filetemp = $data['tmp_name'];                
               
               if($fileType =='pdf'){
                  $this->validateFileType($fileType);    

               }
               else{
                  return $this->apiResponse(['fileType'=>$fileType], 400, "File updated failed, please try again. file type not a PDF");                    
               }              
             // echo "jooli";die;
             $s3 = WorkflowManager::initializeS3Client();
            //var_dump($s3);die;
              $mediaKey = 0;
              if ($mediaId) {
                  $mediaFilesObject = $this->getMediaFilesObject($companyID, $mediaId);
                  $mediaKey = $mediaFilesObject->getMediaData();
                  $MediaMime   = $mediaFilesObject->getMediaMime();
                  if ($MediaMime == 'application/pdf') {
                      $updatedmediaKey = $this->updateS3Object($s3, $fileName,$filetemp,$mediaKey);
                      } else {
                          return $this->apiResponse(['mediaId'=>$mediaId], 400, "File updated failed, please try again. file formate not a PDF");
                  }
              }                

              $updatedmediaKey = $this->updateS3Object($s3, $fileName,$filetemp,$mediaKey);
              
              $media = $this->createMediaObject($fileName, $data['type'], $updatedmediaKey, $companyID, $mediaId);

              return $media
                  ? $this->apiResponse(['data' => $media->getMediaId()], 200, "File updated successfully.")
                  : $this->apiResponse([], 400, "File upload failed, please try again.");
          } else {
              return $this->apiResponse(['datanull' => $data], 404, "Please select a file to upload.");
          }
      } catch (\Exception $e) {
          return $this->apiResponse([], 500, "Internal Server Error");
      }
  }

        private function validateFileType($fileType)
        {
            $allowTypes = array('pdf');
            if (!in_array($fileType, $allowTypes)) {
                throw new \Exception("Sorry, only PDF files are allowed to upload.", 422);
            }
        }

        private function getMediaFilesObject($companyID, $mediaId)
        {
            $mediaFilesObject = MediaFilesQuery::create()
                ->filterByCompanyId($companyID)
                ->findPk($mediaId);

            if (!$mediaFilesObject) {
                throw new \Exception("Media object with ID $mediaId not found.", 400);
            }

            return $mediaFilesObject;
        }

        private function updateS3Object($s3, $fileName,$filetemp, $mediaKey = 0)
        {
            $updatedmediaKey = 'uploads/' . uniqid() . '-' . $fileName;

            if ($mediaKey !== 0) {
                $s3->deleteObject([
                    'Bucket' => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                    'Key'    => $mediaKey,
                    'SourceFile' => $filetemp,
                ]);

                $s3->putObject([
                    'Bucket' => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                    'Key'    => $updatedmediaKey,
                    'SourceFile' => $filetemp,
                ]);
            } else {

                $s3->putObject([
                    'Bucket' => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                    'Key'    => $updatedmediaKey,
                    'SourceFile' => $filetemp,
                ]);
            }


            return $updatedmediaKey;
        }

        private function createMediaObject($fileName, $fileMime, $key, $companyID, $mediaId = 0)
        {
            if ($mediaId) {
                $media = MediaFilesQuery::create()
                    ->filterByCompanyId($companyID)
                    ->findPk($mediaId);
                $media->setMediaName($fileName);
                $media->setMediaMime($fileMime);
                $media->setMediaData($key);
                $media->save();
            } else {
                $media = new MediaFiles();
                $media->setMediaName($fileName);
                $media->setMediaMime($fileMime);
                $media->setMediaData($key);
                $media->setCompanyId($companyID);
                $media->save();
            }

            return $media;
        }
    
    
}

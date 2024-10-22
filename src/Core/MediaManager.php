<?php declare(strict_types = 1);
namespace App\Core;

use App\System\App;
use Http\Request;
use App\Utils\FormMgr;
use Gumlet;
use Modules\System\Processes\WorkflowManager;

class MediaManager extends BaseController
{
    protected $app, $s3Bucket;

    public function __construct(App $app) {
        $this->s3Bucket = $_ENV['STACKHERO_MINIO_AWS_BUCKET'];
        $this->app = $app;     
    }
    
    function index()
    {
        $action = $this->app->Request()->getParameter("action");
        
        switch($action) : 
           case "":
               $this->data["inputFunction"] = $this->app->Request()->getParameter("inputFunction");
               $this->app->Renderer()->render('mediaManager/mediaManager.twig', $this->data);
               break;
           case "tree":
                $folders = \entities\Base\MediaFoldersQuery::create()->find();        
                $folderlist = [];
                $isFirst = true;
                foreach($folders as $f)
                {
                    $state = [];
                    if($isFirst)
                    {
                        $state = ["opened" => true];
                        $isFirst = false;
                    }
                    $folderlist[] = array( "text" => $f->getFolderName() , "icon" => "fa fa-folder" , "id" => $f->getPrimaryKey(),"parent" => "#","state" => $state);
                }
                $this->json($folderlist);
               break;
       endswitch;
                                        
    }
    
    function getFolderList()
    {
         $folders = \entities\Base\MediaFoldersQuery::create()
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())                
                ->orderBy("ParentId")
                ->find();
                
        $folderlist = [];
        
        foreach($folders as $f)
        {
            $folderlist[] = array( "text" => $f->getFolderName() , "iconCls" => "fa fa-folder" , "id" => $f->getPrimaryKey());
        }
        
        $folderlist[] = array("text" => "new folder" , "iconCls" => "fa fa-plus" , "id" => "-1" );
        
         $this->app->Response()->setContent(json_encode($folderlist));
    }
    
    function getFiles()
    {
        $folder_id = $this->app->Request()->getParameter("folder_id",0);
        
        $files = \entities\MediaFilesQuery::create()                
                ->select(['MediaId','MediaName'])
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())                
                ->filterByFolderId($folder_id)
                ->find()->toArray();
                
        
        $this->app->Response()->setContent(json_encode($files));
    }
    
    function media()
    {
        $fileid = $this->app->Request()->getParameter("id",0);   
        $height = $this->app->Request()->getParameter("h",false);   
        $width = $this->app->Request()->getParameter("w",false);   
        
        $key = $fileid."*".$height."*".$width;
        $base64Str = "";         
        $mediaType = "";                

        if($fileid == 0 || $fileid == "" || $fileid == null || $fileid == 'null')
        {
            $base64Str = "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";
            $mediaType = "image/jpeg";
        }
        // else if($this->app->Cache()->has($key))
        // {
        //     $obj = $this->app->Cache()->get($key);            
        //     $base64Str = $obj[0];
        //     $mediaType = $obj[1];
        // }
         else 
         {
            $file = \entities\MediaFilesQuery::create()->findPk($fileid);   
            if ($file->getIss3file()) {
                //$url = $this->getFileFromS3($file);
                $url = $_ENV['STACKHERO_MINIO_HOST'] . '/' . $this->s3Bucket . '/' . rawurlencode($file->getMediaData());

                if (!empty($url)) {
                    try {
                        $data = file_get_contents($url);
                        $base64Str = base64_encode($data);
                        $mediaType = $file->getMediaMime();
                    }
                    catch (\Exception $e) {
                        $base64Str = "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";
                        $mediaType = "image/jpeg";
                    }
                } else {
                    $base64Str = "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";
                    $mediaType = "image/jpeg";
                }
            } else {
                $base64Str = preg_replace('#data:image/[^;]+;base64,#', '', $file->getMediaData());
                $mediaType = $file->getMediaMime();
            }
        }
         
        $this->app->Cache()->set($key,[$base64Str,$mediaType],60*60*24*15);

        if (empty($height) && empty($width)) {
            $this->app->Response()->addHeader("media-type", $mediaType);
            $this->app->Response()->addHeader("Content-type", $mediaType);
            $this->app->Response()->setContent(base64_decode($base64Str));
            return;
        }
        
        
        $image = \Gumlet\ImageResize::createFromString(base64_decode($base64Str));
                
        if($height && $width)
        {
            $image->resize($width, $height);
        }        
        else if($height)
        {
            $image->resizeToHeight($height);
        }
        else if($width)
        {
            $image->resizeToWidth($width);
        }                
                
        $this->app->Response()->addHeader("media-type", $mediaType);
        $this->app->Response()->addHeader("Content-type", $mediaType);
        $this->app->Response()->setContent((string)$image);        
    }
    function deleteMedia()
    {
        $fileid = $this->app->Request()->getParameter("id",0);   
        $file = \entities\MediaFilesQuery::create()                                
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())                                
                ->findPk($fileid);
        if($file)
        {
            if ($file->getIss3file()) {
                (new \BI\manager\FileManager())->removeFileFromS3($this->s3Bucket, $file->getMediaData());
            }
            $file->delete();
            $this->json(["status"=>"1"]);
        }
        else 
        {
            $this->json(["status"=>"0"]);
        }
        
        
        
    }
    function createFolder()
    {
        $folderName = $this->app->Request()->getParameter("folderName",false);   
        
        if($folderName)
        {
            
            $newFolder = new \entities\MediaFolders();
            $newFolder->setFolderName($folderName);
            $newFolder->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
            $newFolder->save();
            
            $this->app->Response()->setContent(json_encode([$newFolder->toArray()]));
        }
        else 
        {
            $this->app->Response()->setContent(json_encode(["false"]));
        }
    }
    
    function uploadNewFile()
    {
        $folder = $this->app->Request()->getParameter("currentFolder",0);
        if(isset($_FILES))
        {
            $errors=array();
            $allowed_ext= array('jpg','jpeg','png','gif');
            $media_id = [];            
            
         foreach ($_FILES as $input => $file) {
             
                $file_tmp = $file['tmp_name'];
                $file_name = $file['name'];
                $file_size = $file['size'];
                $type = $file['type'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            
                $data = file_get_contents($file_tmp );

                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


                if(in_array($file_ext,$allowed_ext) === false)
                {
                    $errors[]=$file_name.' Extension not allowed';
                }

                if($file_size > 5242880)
                {
                    $errors[]= $file_name.'File size must be under 2mb';

                }
                if(empty($errors))
                {
                   $fullPath = (new \BI\manager\FileManager())->uploadFileIntoS3($this->s3Bucket, $base64, $file_name);

                   $media = new \entities\MediaFiles();
                   $media->setFolderId($folder);
                   $media->setMediaName($file_name);
                   $media->setMediaMime($type);
                //    $media->setMediaData($base64);
                   $media->setMediaData($fullPath);
                   $media->setCompanyId($this->app->Auth()->CompanyId());
                   $media->setIss3file(true);
                   $media->save();
                   $media_id[] = $media->getPrimaryKey();
                }                
            
            }
            
            if(count($errors) > 0)
            {
                    $this->app->Response()->setStatusCode(500);
                    $this->apiResponse($errors, 500, "Error");
            }
            else
            {                    
                    $this->apiResponse($media_id, 200, "Error");
            }   

        }
        
        else 
        {
            $this->app->Response()->setStatusCode(500);
            $this->apiResponse([], 500, "No File");
        }
    }
    
    public function FormInput($inputName = "",$caption = "Media",$mediaID = [],$limit=3)
    {
    
        if($mediaID != null && $mediaID != '' && !empty($mediaID) && $mediaID[0] > 0){          
            if (is_array($mediaID) && !is_int($mediaID[0])) {
                $mediaID = explode(',',strval($mediaID[0]));
            }
            $files = \entities\MediaFilesQuery::create()->filterByMediaId($mediaID)->find();
            foreach($files as $file){
                if($file->getMediaMime() == 'application/pdf' || $file->getIss3file()){
                    unset($mediaID[$file->getMediaId()]);
                    $s3 = WorkflowManager::initializeS3Client(); 
                    $retrive  = $s3->getObject([
                        'Bucket'  => $_ENV['STACKHERO_MINIO_AWS_BUCKET'],
                        'Key' => $file->getMediaData(),
                    ]);
        
                    $metadata  = $retrive['@metadata'];
                    if (isset($metadata['headers']['x-amz-request-id'])) {
                        array_push($mediaID,$metadata['effectiveUri']);
                    }
                }
            }
        }

        $mediaID = array_diff($mediaID,[0]);
        $mediaID = array_diff($mediaID,[""]);

        $this->data["inputName"] = $inputName;
        $this->data["MediaId"] = $mediaID;
        $this->data["Limit"] = $limit;
        $this->data["Caption"] = $caption;
        
        return $this->app->Renderer()->render("mediaManager\mediaInput.twig",$this->data,false);
    }

    private function getFileFromS3($file) {
        return (new \BI\manager\FileManager())->getFileFromS3($this->s3Bucket, $file->getMediaData());
    }
}



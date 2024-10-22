<?php declare(strict_types=1);

namespace Modules\Offers\Controllers;

use App\System\App;
use App\Utils\FormMgr;

use App\Core\MediaManager;
use entities\MediaFiles;
use entities\OrgUnitQuery;
use Modules\System\Processes\WorkflowManager;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Masters extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function offers()
    {

//        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Offers";
        $this->data['form_name'] = "Offer";
        $this->data['cols'] = [
//            "Banner" => "MediaId",
            "Org Unit" => "OrgUnit.UnitName",
            "Title" => "Title",
            "Description" => "Description",
            "Start Date" => "StartDate",
            "End Date" => "EndDate",

        ];

        $this->data['pk'] = "Id";
        $this->data['mediaCol'] = "MediaId";


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":

               /* $this->json(["data" => \entities\OffersQuery::create()
                    ->joinWithOrgUnit()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);*/

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\OffersQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;


                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;
                break;
            case "form":
                $outlettypes = \entities\OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("OutlettypeId", "OutlettypeName");
                $zones = OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");


                $f = FormMgr::formHorizontal();
                $f->add([

                    'Title' => FormMgr::text()->label('Title *')->required(),
                    'Description' => FormMgr::text()->label('Description *')->required(),
//                    'OutletTypeId' => FormMgr::select()->options($outlettypes)->label('Outlet Type'),
                    'OrgUnitId' => FormMgr::select()->options($zones)->label('Org Unit'),
                    'StartDate' => FormMgr::date()->label('StartDate')->required(),
                    'EndDate' => FormMgr::date()->label('EndDate')->required(),
                    'Image' => FormMgr::file()->label('Image')->required(),
                ]);
                $offer = new \entities\Offers();
                $this->data['form_name'] = "Add Offer";
                if ($pk > 0) {
                    $offer = \entities\OffersQuery::create()
                        ->findPk($pk);
                    $f->val($offer->toArray());
                    $this->data['form_name'] = "Edit Offer";
                }
                $media = null;
                if ($this->app->isPost() && $f->validate()) {
                    $offer->setTitle($_POST['Title']);
                    $offer->setDescription($_POST['Description']);
//                    $offer->setOutletTypeId($_POST['OutletTypeId']);
                    $offer->setOrgUnitId($_POST['OrgUnitId']);
                    $offer->setStartDate($_POST['StartDate']);
                    $offer->setEndDate($_POST['EndDate']);
                    $offer->setCompanyId($this->app->Auth()->CompanyId());

                    if (!empty($_FILES["Image"]["name"])) {
                        // Get file info
                        $fileName = basename($_FILES["Image"]["name"]);
                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                        // Allow certain file formats
                        $allowTypes = array('jpg', 'png', 'jpeg', 'gif','JPG','PNG','JPEG','GIF');
                        if (in_array($fileType, $allowTypes)) {
                            $image = $_FILES['Image']['tmp_name'];
                            $fileMime = $_FILES["Image"]["type"];
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




                        }
                    }
                    if ($media!=null){
                        $mediaId = $media->getMediaId();
                    } else {
                        $mediaId = null;
                    }
                    $offer->setMediaId($mediaId);
                    $offer->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
//                    $mediaInput = $mediaManager->FormInput("MediaId","Media",[$offer->getMediaId()],1);
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }
}

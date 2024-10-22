<?php

declare(strict_types=1);

namespace Modules\Material\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use Propel\Runtime\ActiveQuery\Criteria;


class Material extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }


    
    
    public function folders() {
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Folders";
        $this->data['form_name'] = "Folders";
        $this->data['cols'] = [
            "Icon" => "FolderIcon",
            "Parent" => "FolderParentId",
            "Name" => "FolderName",                        
        ];

        $this->data['pk'] = "FolderId";
        $this->data['mediaCol'] = "FolderIcon";

        $parentFolders = \entities\MaterialFoldersQuery::create()
                            ->filterByFolderParentId(0)
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->find();

        $res = [0 => '-TopLevel-'];
        foreach($parentFolders as $fol)
        {
        $res[$fol->getPrimaryKey()] = $fol->getFolderName();
        }

        $this->data['valKeys'] = ["FolderParentId" => $res];    

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\MaterialFoldersQuery::create();
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByFolderName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'FolderName' => FormMgr::text()->label('Name *')->required(),
                    'FolderParentId' => FormMgr::select()->options($res)->label('Parent'),                      
                ]);
                $folder = new \entities\MaterialFolders();
                $this->data['form_name'] = "Add Folder";
                if ($pk > 0) {
                    $folder = \entities\MaterialFoldersQuery::create()->findPk($pk);                    
                    $f->val($folder->toArray());
                    $this->data['form_name'] = "Edit Folder";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $folder->fromArray($_POST);
                    $folder->setCompanyId($this->app->Auth()->CompanyId());
                    $folder->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("FolderIcon", "Media", [$folder->getFolderIcon()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    
    public function files() {
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Material";
        $this->data['form_name'] = "Material";
        $this->data['cols'] = [
            "Icon" => "MediaId",
//            "Folder" => "FolderId",
            "Name" => "Name",
            "Description" => "Description",
            "Url" => "Url",
            /*"Orgunitids" => "Orgunitids",
            "Designations" => "Designations",*/
        ];

        /*$this->data['id_fields'] = [
            "Orgunitids",
            "Designations",
        ];*/

        $this->data['pk'] = "Id";
        $this->data['mediaCol'] = "MediaId";

        $materialFolders = \entities\MaterialFoldersQuery::create()               
               ->findByCompanyId($this->app->Auth()->CompanyId());
        $res = [];
        foreach($materialFolders as $folder)
        {
            $res[$folder->getPrimaryKey()] = $folder->getFolderName();
        }

        $this->data['valKeys'] = ["FolderId" => $res];       

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET)); // Extract filters (offset, limit, etc.)
                $response = [];
                $query = \entities\MaterialQuery::create();

                // Total record count
                $count = $query->count();
                $response["recordsTotal"] = $count;

                // Apply search filters
                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByName($search, Criteria::LIKE);
                }

                // Filtered record count
                $count = $query->count();
                $response["recordsFiltered"] = $count;

                // Get paginated data
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();

                // Return JSON response
                $this->json($response);
                break;
            case "form":

                $designation = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId","Designation");
                $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'Name' => FormMgr::text()->label('Name *')->required(),
                    'Description' => FormMgr::text()->label('Description'),                    
                    'Url' => FormMgr::text()->label('Url'),
                    'FolderId' => FormMgr::select()->options($res)->label('Folder'),
                    'Designations' => FormMgr::select()->options($designation)->label('Designations')->class("multi-select")->multiple("multiple"),
                    'Orgunitids' => FormMgr::select()->options($OrgUnitId)->label('OrgUnits')->class("multi-select")->multiple("multiple")
                ]);

                $material = new \entities\Material();
                $this->data['form_name'] = "Add Material";
                if ($pk > 0) {
                    $material = \entities\MaterialQuery::create()->findPk($pk);
                    $f->val($material->toArray());
                    $f["Designations"]->val(explode(",",$material->getDesignations()));
                    $f["Orgunitids"]->val(explode(",",$material->getOrgunitids()));
                    $this->data['form_name'] = "Edit Material";
                }
                if ($this->app->isPost() && $f->validate()) {
                    // Ensure file processing logic completes
                    $Designations = implode(",", $_POST['Designations']);
                    $Orgunitids = implode(",", $_POST['Orgunitids']);
//                    var_dump($Designations,$Orgunitids);exit;

                    $material->setFolderId($_POST['FolderId']);
                    $material->setDescription($_POST['Description']);
                    $material->setUrl($_POST['Url']);
                    $material->setName($_POST['Name']);

                    $material->setDesignations($Designations);
                    $material->setOrgunitids($Orgunitids);
                    $material->setCompanyId($this->app->Auth()->CompanyId());
                    $material->setMediaId($_POST['MediaId']);

                    // Save material and trigger a refresh of the grid
                    $material->save();

                    // Avoid recursive reloading
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId", "Media", [$material->getMediaId()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }


}
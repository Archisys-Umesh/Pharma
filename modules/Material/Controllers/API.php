<?php

declare(strict_types = 1);

namespace Modules\Material\Controllers;

use Http\Request;
use App\System\App;
use App\Utils\FormMgr;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;

class API extends \App\Core\BaseController {

    protected $app;
 

    public function __construct(App $app) {
        $this->app = $app; 
    }

   

    /**
     * @OA\Get(
     *     path="/api/getFoldersAndFiles",
     *     tags={"Materials"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="folder_id",
     *         in="query",
     *         description="folder_id , send 0 for top level",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Folders and Files successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getFoldersAndFiles() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $emp = $this->app->Auth()->getUser()->getEmployee();
                $folder_id = $this->app->Request()->getParameter("folder_id",0);
                if ($folder_id == 'undefined' || $folder_id == 'null') {
                    $folder_id = 0;
                }

                $folders = \entities\MaterialFoldersQuery::create()
                                ->filterByFolderParentId($folder_id)
                                ->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                $Material = \entities\MaterialQuery::create()                                
                                ->filterByFolderId($folder_id)
                                ->findByCompanyId($this->app->Auth()->CompanyId());
                $materialArray = [];
                foreach($Material as $mat)
                {
                    $designation = $emp->getDesignationId();
                    $orgunit = $emp->getOrgUnitId();

                    $orgunitSelected = explode(",",$mat->getOrgunitids());
                    $designationSelected = explode(",",$mat->getDesignations());

                    
                    if(in_array($designation,$designationSelected) && in_array($orgunit,$orgunitSelected))                    
                    {
                        array_push($materialArray,$mat->toArray());
                    
                    }
                }
                                
                // Filter by Designation and Org is pending
                $this->apiResponse([
                    "folders" => $folders,
                    "files" => $materialArray
                ], 200, "Get Folders and Files successfully!");
                break;
        endswitch;
    }
    
}
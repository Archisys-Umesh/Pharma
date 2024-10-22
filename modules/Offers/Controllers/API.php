<?php

declare(strict_types = 1);

namespace Modules\Offers\Controllers;

use App\System\App;
use App\Utils\ImageUploader;
use Propel\Runtime\ActiveQuery\Criteria;

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
     *     path="/api/getOffers",
     *     tags={"Offers API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all offers successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOffers()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $emp = $this->app->Auth()->getUser()->getEmployee();
                //$enddate = date("Y-m-d");


                    $offers = \entities\OffersQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByOrgUnitId($emp->getOrgUnitId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        //->filterByEndDate($enddate, Criteria::GREATER_EQUAL)
                        ->find()
                        ->toArray();
                    if ($offers) {
                        $this->apiResponse($offers, 200, "Get all offers successfully!");
                    } else {
                        $this->apiResponse([], 400, "Offers not found!");
                    }
                break;
        endswitch;
    }
}

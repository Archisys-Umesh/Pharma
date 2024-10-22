<?php declare(strict_types = 1);

namespace Modules\Transaction\Controllers;

use App\System\App;
use entities\CategoriesQuery;
use entities\OutletAccountDetailsQuery;
use entities\OutletsQuery;
use entities\PricebooklinesQuery;
use entities\ProductsQuery;
use Respect\Validation\Validator as v;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class API extends \App\Core\BaseController{
   
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;               
    }
    
    /**
     * @OA\Get(
     *     path="/api/getTransactionTypes",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all transaction type successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTransactionTypes() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $types = $this->getConfig("Transaction", "TransactionTypes");
                if (count($types) > 0) {
                    $this->apiResponse($types, 200, "Get all transaction type successfully!");
                } else {
                    $this->apiResponse([], 400, "Transaction type not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createStockVoucher",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Remark",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="transaction_type",
     *         in="query",
     *         description="Transaction Type",
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Transaction create successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function createStockVoucher() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("transaction_type")), "Please enter the transaction type.", "transaction_type");
                
                
                $userId = $this->app->Auth()->getUser()->getUserId();
                $companyId = $this->app->Auth()->getUser()->getCompanyId();
                $remark = $this->app->Request()->getParameter("remark");
                $description = $this->app->Request()->getParameter("description");
                $transactionType = $this->app->Request()->getParameter("transaction_type");
                
                $createSV = new \entities\StockVoucher();
                $createSV->setSvUserId($userId);
                $createSV->setSvDate(date('Y-m-d H:i:s'));
                $createSV->setCompanyId($companyId);
                $createSV->setSvRemark($remark);
                $createSV->setSvDesc($description);
                $createSV->setSvType($transactionType);
                $createSV->setTotalQty($totalQty);
                $createSV->setSvStatus('Draft');
                $createSV->save();
                
                $this->apiResponse($createSV->toArray(), 200, "Transaction create successfully!");
                break;
        endswitch;
    }
    
     /**
     * @OA\Get(
     *     path="/api/inventoryView",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *  @OA\Parameter(
     *         name="product_id",
     *         in="query",
     *         description="Product ID",
     *         @OA\Schema(type="string")
     *     ),     
     *  @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet ID",
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get all transaction type successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    
    public function inventoryView()
    {
        $product_id = $this->app->Request()->getParameter("product_id",0);
        $outlet_id = $this->app->Request()->getParameter("outlet_id");
        
        $inventory = \entities\InventoryViewQuery::create()                
                ->filterByOutletId($outlet_id)
                ->filterByCompanyId($this->app->Auth()->CompanyId());
        
        if($product_id > 0)
        {
            $inventory->filterByProductId($product_id);
        }
        
        $outletAcc = OutletAccountDetailsQuery::create()
                            ->filterByOutletId($outlet_id)
                            ->find()->getFirst();

        $priceBook = PricebooklinesQuery::create()
                        ->filterByPricebookId($outletAcc->getOutletDefaultPricebook());

        if($product_id > 0)
        {
            $priceBook->filterByProductId($product_id);
        }               


        $this->apiResponse([
            
            "inventory" => $inventory->find()->toArray(),
            "pricebook" => $priceBook->find()->toArray()
    
            ], 200, "Inventory View!");
    }
    
     /**
     * @OA\Get(
     *     path="/api/StockView",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     
     *  @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet ID",
     *         @OA\Schema(type="string")
     *     ),     
     *  @OA\Parameter(
     *         name="cat_id",
     *         in="query",
     *         description="Category ID",
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get all transaction type successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    
    public function StockView()
    {
        
        $outlet_id = $this->app->Request()->getParameter("outlet_id");
        $cat_id = $this->app->Request()->getParameter("cat_id",0);
        
        $stockView = \entities\OutletStockQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByOutletId($outlet_id)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->joinWithProducts();        
        if($cat_id > 0)
        {
            $products = ProductsQuery::create()->filterByCategoryId($cat_id)->select("Id")->find()->toArray();
            $stockView->filterByProductId($products);
        }

        $this->apiResponse($stockView->find()->toArray(), 200, "Stock View!");
    }

}

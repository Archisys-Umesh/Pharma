<?php

declare(strict_types=1);

namespace Modules\Orders\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use BI\manager\OrgManager;
use entities\Orders;
use entities\Orderlines;
use Modules\Orders\Runtime\BillingItem;
use Modules\Orders\Runtime\POSHelper;
use Propel\Runtime\ActiveQuery\Criteria;
use Respect\Validation\Rules\Decimal;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class API extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    /**
     * @OA\Post(
     *     path="/api/addOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="Create new ORDER",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="outlet_from_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="outlet_to_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="4"
     *              ),
     *              @OA\Property(
     *                  property="beat_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="4"
     *              ),
     *              @OA\Property(
     *                  property="product_line_item",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example={
     *                          {
     *                              "product_id":"1",
     *                              "qty":"3"
     *                          },
     *                          {
     *                              "product_id":"2",
     *                              "qty":"5"
     *                          },
     *                      },
     *                  )
     *              ),
     *          ),
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Order created successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addOrder() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $outletFrom = $this->app->Request()->getParameter("outlet_from_id");
                $outletTo = $this->app->Request()->getParameter("outlet_to_id");
                $lineItems = $this->app->Request()->getParameter("product_line_item");
                $beatId = $this->app->Request()->getParameter("beat_id");

                $empId = $this->app->Auth()->getUser()->getEmployeeId();
                $companyId = $this->app->Auth()->CompanyId();
                $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                $orderNumber = $helper->getOrderSequence("PO");
                $priceBookId = $helper->getPriceBook($outletFrom, $outletTo)->getPricebookId();

                $order = new Orders();
                $order->setOrderNumber($orderNumber);
                $order->setOrderType("PO");
                $order->setOutletFrom($outletFrom);
                $order->setOutletTo($outletTo);
                $order->setPricebookId($priceBookId);
                $order->setOrderDate(date("Y-m-d"));
                $order->setEmployeeId($empId);
                $order->setCompanyId($companyId);
                $order->setOrderStatus("Created");
                if ($beatId != null && $beatId != '') {
                    $order->setBeatId($beatId);
                }
                $order->save();
                \Modules\Orders\Runtime\OrderHelper::addLog($this->app, $order->getPrimaryKey(), "Order Created", "", $order->toArray());
                if ($order->getOrderId() != null) {
                    if (count($lineItems) > 0) {
                        foreach ($lineItems as $lineItem) {
                            $product = \entities\ProductsQuery::create()->filterById($lineItem->product_id)->findOne();
                            $priceBook = \entities\PricebooklinesQuery::create()->filterByPricebookId($priceBookId)->filterByProductId($lineItem->product_id)->findOne();

                            $orderline = new Orderlines();
                            $orderline->setOrderId($order->getOrderId());
                            $orderline->setProductId($lineItem->product_id);
                            $orderline->setMrp($priceBook->getMaxRetailPrice());
                            $orderline->setRate($priceBook->getSellingPrice());
                            $orderline->setQty($lineItem->qty);
                            $orderline->setUnitId($product->getUnitD());
                            $orderline->setTotalAmt($lineItem->qty * $priceBook->getSellingPrice());
                            $orderline->setCompanyId($this->app->Auth()->CompanyId());
                            $orderline->setPricebookLine($priceBook->getId());
                            $orderline->save();
                        }
                        \Modules\Orders\Runtime\OrderHelper::__CalculateOrderFigures($order->getOrderId());
                        $this->apiResponse($order->toArray(), 200, "Order created successfully!");
                    } else {
                        $this->apiResponse([], 400, "Order line item not found!");
                    }
                } else {
                    $this->apiResponse([], 400, "Order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getFrequentlyOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),   
     *     @OA\Response(
     *         response="200",
     *         description="Get frequently order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getFrequentlyOrder() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $EmpId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
                $orders = \entities\OrdersQuery::create()
                            ->select(['OrderId'])
                            ->filterByOutletFrom($outletId)
                            //->filterByEmployeeId($EmpId)
                            ->find()->toArray();
                $orderLineItems = \entities\OrderlinesQuery::create()
                            ->select(['ProductId','count'])
                            ->withColumn('count(*)','count')
                            ->filterByOrderId($orders)
                            ->groupByProductId()
                            ->orderBy("count",Criteria::DESC)
                            ->limit(5)
                            ->find()->toKeyValue("ProductId","count");
                $productIds = array_keys($orderLineItems);
                $products = \entities\ProductsQuery::create()
                            ->filterById($productIds)
                            ->find()->toArray();
                if(count($products) > 0){
                    $this->apiResponse($products, 200, "Get frequently order items successfully!");
                }else{
                    $this->apiResponse([], 400, "Get frequently order items not found!");
                }
                
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getSuggestiveOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="primary_outlet_id",
     *         in="query",
     *         description="Primary Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secondary_outlet_id",
     *         in="query",
     *         description="Secondary Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Response(
     *         response="200",
     *         description="Get suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getSuggestiveOrder() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $primaryOutletId = $this->app->Request()->getParameter("primary_outlet_id");
                $secondaryOutletId = $this->app->Request()->getParameter("secondary_outlet_id");
                if ($secondaryOutletId) {
                    $OutletStocks = \entities\OutletStockQuery::create()
                                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                    ->joinWithProducts()
                                    ->filterByOutletId($secondaryOutletId)
                                    ->filterByFreeQty(0)
                                    ->find()->toArray();
                    $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                    $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                    $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();

                    if (count($OutletStockPriceBookLines) > 0) {
                        $suggestiveOrderProducts = array();
                        foreach ($OutletStocks as $OutletStock) {
                            foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                    $data = array(
                                        'ProductId' => $OutletStock['ProductId'],
                                        'ProductName' => $OutletStock['Products']['ProductName'],
                                        'ProductSku' => $OutletStock['Products']['ProductSku'],
                                        'ProductImages' => $OutletStock['Products']['ProductImages'],
                                        'ProductQty' => $OutletStock['FreeQty'],
                                        'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                        'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                    );
                                    array_push($suggestiveOrderProducts, $data);
                                }
                            }
                        }
                        $this->apiResponse($suggestiveOrderProducts, 200, "Get suggestive order successfully!");
                    } else {
                        $this->apiResponse([], 400, "Get suggestive order product not found!");
                    }
                } else {
                    $this->apiResponse([], 404, "Outlet not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getFilterSuggestiveOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="primary_outlet_id",
     *         in="query",
     *         description="Primary Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secondary_outlet_id",
     *         in="query",
     *         description="Secondary Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="short_by",
     *         in="query",
     *         description="Short By (1=>AtoZ, 2=>ZtoA, 3=>Recently Added)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         description="Category Id",
     *         @OA\Schema(type="string")
     *     ),    
     *     @OA\Response(
     *         response="200",
     *         description="Get filter suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getFilterSuggestiveOrder() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $primaryOutletId = $this->app->Request()->getParameter("primary_outlet_id");
                $secondaryOutletId = $this->app->Request()->getParameter("secondary_outlet_id");
                $shortBy = $this->app->Request()->getParameter("short_by");
                $categoryId = $this->app->Request()->getParameter("category_id");

                if ($shortBy != NULL && $shortBy != '') {
                    switch ($shortBy):
                        case "1":
                            if ($secondaryOutletId) {
                                $OutletStocks = \entities\OutletStockQuery::create()
                                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                                ->joinWithProducts()
                                                ->filterByOutletId($secondaryOutletId)
                                                ->filterByFreeQty(0)
                                                ->find()->toArray();
                                $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                                $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                                $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();
                                if (count($OutletStockPriceBookLines) > 0) {
                                    $suggestiveOrderProducts = array();
                                    foreach ($OutletStocks as $OutletStock) {
                                        foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                            if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                                $data = array(
                                                    'ProductId' => $OutletStock['ProductId'],
                                                    'ProductName' => $OutletStock['Products']['ProductName'],
                                                    'ProductSku' => $OutletStock['Products']['ProductSku'],
                                                    'ProductImages' => $OutletStock['Products']['ProductImages'],
                                                    'ProductQty' => $OutletStock['FreeQty'],
                                                    'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                                    'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                                );
                                                array_push($suggestiveOrderProducts, $data);
                                            }
                                        }
                                    }
                                    asort($suggestiveOrderProducts);
                                    $array = array();
                                    foreach ($suggestiveOrderProducts as $suggestiveOrderProduct) {
                                        array_push($array, $suggestiveOrderProduct);
                                    }

                                    $this->apiResponse($array, 200, "Get suggestive order successfully!");
                                } else {
                                    $this->apiResponse([], 400, "Get suggestive order product not found!");
                                }
                            } else {
                                $this->apiResponse([], 404, "Outlet not found!");
                            }
                            break;
                        case "2":
                            if ($secondaryOutletId) {
                                $OutletStocks = \entities\OutletStockQuery::create()
                                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                                ->joinWithProducts()
                                                ->filterByOutletId($secondaryOutletId)
                                                ->filterByFreeQty(0)
                                                ->find()->toArray();
                                $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                                $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                                $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();
                                if (count($OutletStockPriceBookLines) > 0) {
                                    $suggestiveOrderProducts = array();
                                    foreach ($OutletStocks as $OutletStock) {
                                        foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                            if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                                $data = array(
                                                    'ProductId' => $OutletStock['ProductId'],
                                                    'ProductName' => $OutletStock['Products']['ProductName'],
                                                    'ProductSku' => $OutletStock['Products']['ProductSku'],
                                                    'ProductImages' => $OutletStock['Products']['ProductImages'],
                                                    'ProductQty' => $OutletStock['FreeQty'],
                                                    'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                                    'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                                );
                                                array_push($suggestiveOrderProducts, $data);
                                            }
                                        }
                                    }
                                    Krsort($suggestiveOrderProducts);
                                    $array = array();
                                    foreach ($suggestiveOrderProducts as $suggestiveOrderProduct) {
                                        array_push($array, $suggestiveOrderProduct);
                                    }

                                    $this->apiResponse($array, 200, "Get suggestive order successfully!");
                                } else {
                                    $this->apiResponse([], 400, "Get suggestive order product not found!");
                                }
                            } else {
                                $this->apiResponse([], 404, "Outlet not found!");
                            }
                            break;
                        case "3":
                            if ($secondaryOutletId) {
                                $OutletStocks = \entities\OutletStockQuery::create()
                                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                                ->joinWithProducts()
                                                ->filterByOutletId($secondaryOutletId)
                                                ->filterByFreeQty(0)
                                                ->useProductsQuery()
                                                ->orderById(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                                                ->endUse()
                                                ->limit(10)
                                                ->find()->toArray();
                                $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                                $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                                $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();
                                if (count($OutletStockPriceBookLines) > 0) {
                                    $suggestiveOrderProducts = array();
                                    foreach ($OutletStocks as $OutletStock) {
                                        foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                            if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                                $data = array(
                                                    'ProductId' => $OutletStock['ProductId'],
                                                    'ProductName' => $OutletStock['Products']['ProductName'],
                                                    'ProductSku' => $OutletStock['Products']['ProductSku'],
                                                    'ProductImages' => $OutletStock['Products']['ProductImages'],
                                                    'ProductQty' => $OutletStock['FreeQty'],
                                                    'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                                    'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                                );
                                                array_push($suggestiveOrderProducts, $data);
                                            }
                                        }
                                    }
                                    if (count($suggestiveOrderProducts) > 0) {
                                        $this->apiResponse($suggestiveOrderProducts, 200, "Get suggestive order successfully!");
                                    } else {
                                        $this->apiResponse([], 400, "Get suggestive order product not found!");
                                    }
                                } else {
                                    $this->apiResponse([], 400, "Get suggestive order product not found!");
                                }
                            } else {
                                $this->apiResponse([], 404, "Outlet not found!");
                            }
                            break;
                        default :
                            if ($secondaryOutletId) {
                                $OutletStocks = \entities\OutletStockQuery::create()
                                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                                ->joinWithProducts()
                                                ->filterByOutletId($secondaryOutletId)
                                                ->filterByFreeQty(0)
                                                ->find()->toArray();
                                $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                                $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                                $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();

                                if (count($OutletStockPriceBookLines) > 0) {
                                    $suggestiveOrderProducts = array();
                                    foreach ($OutletStocks as $OutletStock) {
                                        foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                            if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                                $data = array(
                                                    'ProductId' => $OutletStock['ProductId'],
                                                    'ProductName' => $OutletStock['Products']['ProductName'],
                                                    'ProductSku' => $OutletStock['Products']['ProductSku'],
                                                    'ProductImages' => $OutletStock['Products']['ProductImages'],
                                                    'ProductQty' => $OutletStock['FreeQty'],
                                                    'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                                    'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                                );
                                                array_push($suggestiveOrderProducts, $data);
                                            }
                                        }
                                    }
                                    $this->apiResponse($suggestiveOrderProducts, 200, "Get suggestive order successfully!");
                                } else {
                                    $this->apiResponse([], 400, "Get suggestive order product not found!");
                                }
                            } else {
                                $this->apiResponse([], 404, "Outlet not found!");
                            }
                            break;
                    endswitch;
                } else {
                    if ($secondaryOutletId) {
                        $OutletStocks = \entities\OutletStockQuery::create()
                                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                        ->joinWithProducts()
                                        ->filterByOutletId($secondaryOutletId)
                                        ->filterByFreeQty(0)
                                        ->useProductsQuery()
                                        ->filterByCategoryId($categoryId)
                                        ->endUse()
                                        ->find()->toArray();
                        $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                        $priceBook = $helper->getPriceBook((int) $secondaryOutletId, (int) $primaryOutletId);
                        $OutletStockPriceBookLines = $priceBook->getPricebookliness()->toArray();
                        if (count($OutletStockPriceBookLines) > 0) {
                            $suggestiveOrderProducts = array();
                            foreach ($OutletStocks as $OutletStock) {
                                foreach ($OutletStockPriceBookLines as $OutletStockPriceBookLine) {
                                    if ($OutletStock['ProductId'] == $OutletStockPriceBookLine['ProductId']) {
                                        $data = array(
                                            'ProductId' => $OutletStock['ProductId'],
                                            'ProductName' => $OutletStock['Products']['ProductName'],
                                            'ProductSku' => $OutletStock['Products']['ProductSku'],
                                            'ProductImages' => $OutletStock['Products']['ProductImages'],
                                            'ProductQty' => $OutletStock['FreeQty'],
                                            'ProductMaxRetailPrice' => $OutletStockPriceBookLine['MaxRetailPrice'],
                                            'ProductSellingPrice' => $OutletStockPriceBookLine['SellingPrice'],
                                        );
                                        array_push($suggestiveOrderProducts, $data);
                                    }
                                }
                            }
                            if (count($suggestiveOrderProducts) > 0) {
                                $this->apiResponse($suggestiveOrderProducts, 200, "Get suggestive order successfully!");
                            } else {
                                $this->apiResponse([], 400, "Get suggestive order product not found!");
                            }
                        } else {
                            $this->apiResponse([], 400, "Get suggestive order product not found!");
                        }
                    } else {
                        $this->apiResponse([], 404, "Outlet not found!");
                    }
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOrderForGRN",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Get filter suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getOrderForGRN() {
        $outlet = $this->app->Request()->getParameter("outlet_id");
        $shippingOrder = \entities\SalesViewQuery::create()
                ->filterByOutletFrom($outlet)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterBySoStatus("InTransit")
                ->find();
        $this->apiResponse($shippingOrder->toArray(), 200, "Orders in Transit");
    }

    /**
     * @OA\Get(
     *     path="/api/getShippingOrderDetails",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="soid",
     *         in="query",
     *         description="Shipping Order Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Get filter suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getShippingOrderDetails() {
        $soid = $this->app->Request()->getParameter("soid");

        $shippingOrder = \entities\ShippingorderQuery::create()
                        ->filterBySoid($soid)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->joinWithShippinglines()
                        ->find()->getFirst();

        if ($shippingOrder) {
            $sv = \entities\StockTransactionQuery::create()
                    ->filterBySvid($shippingOrder->getSvId())
                    ->filterByTranType("C")
                    ->find();

            $this->apiResponse([
                "ShippingOrder" => $shippingOrder->toArray(),
                "Stocks" => $sv->toArray()
                    ], 200, "Orders in Transit");
        } else {
            $this->apiResponse([], 400, "Details not found");
        }
    }

    /**
     * @OA\Post(
     *     path="/api/ProcessShippingOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\RequestBody(
     *          required=true,
     *          description="GRN",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="soid", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),     
     *              @OA\Property(
     *                  property="return_lines",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example={
     *                          {
     *                              "stid":"1",
     *                              "qty":"3"
     *                          },
     *                          {
     *                              "stid":"2",
     *                              "qty":"5"
     *                          },
     *                      },
     *                  )
     *              ),
     *          ),
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get filter suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function ProcessShippingOrder() {
        $soid = $this->app->Request()->getParameter("soid");
        $return_lines = $this->app->Request()->getParameter("return_lines");

        $shippingOrder = \entities\ShippingorderQuery::create()
                        ->filterBySoid($soid)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->getFirst();
        $orderHelper = new \Modules\Orders\Runtime\OrderHelper($this->app);
        if ($shippingOrder) {
            $orderHelper->confirmDeliveredShipping($shippingOrder->getPrimaryKey());
            if (count($return_lines) > 0) {
                $returnOrder = $orderHelper->createReverseShippingOrder($shippingOrder, $return_lines);
                $this->apiResponse($returnOrder->toArray(), 200, "Return Order Created");
            } else {
                $this->apiResponse([], 200, "GRN Done");
            }
        } else {
            $this->apiResponse([], 400, "Shipping Order not found");
        }
    }

    /**
     * @OA\Post(
     *     path="/api/BookRetailSale",
     *     tags={"RetailSales"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\RequestBody(
     *          required=true,
     *          description="Request Body",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="outlet_id", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),     
     *              @OA\Property(
     *                  property="salutation", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="fname", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="lname", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="email", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="mobile", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), 
     *              @OA\Property(
     *                  property="gst", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="remark", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="payment_mode", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="payment_remark", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ), @OA\Property(
     *                  property="payment_status", 
     *                  type="string", 
     *                  format="string", 
     *                  example="1"
     *              ),  
     *              @OA\Property(
     *                  property="items",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example={
     *                          {
     *                              "product_id":"1",
     *                              "serial_no":"3",
     *                              "batch_no":"",
     *                              "qty" : "",
     *                              "rate" : ""
     * 
     *                          },
     *                          {
     *                              "product_id":"1",
     *                              "serial_no":"3",
     *                              "batch_no":"",
     *                              "qty" : "",
     *                              "rate" : ""
     * 
     *                          },
     *                      },
     *                  )
     *              ),
     *          ),
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get filter suggestive order successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function BookRetailSale()
    {                
        $outlet = $this->app->Request()->getParameter("outlet_id");
        $salutation = $this->app->Request()->getParameter("salutation");
        $fname = $this->app->Request()->getParameter("fname");
        $lname = $this->app->Request()->getParameter("lname");
        $email = $this->app->Request()->getParameter("email");
        $mobile = $this->app->Request()->getParameter("mobile");
        $gst = $this->app->Request()->getParameter("gst");
        $remark = $this->app->Request()->getParameter("remark");

        $payment_mode = $this->app->Request()->getParameter("payment_mode");
        $payment_remark = $this->app->Request()->getParameter("payment_remark");
        $payment_status = $this->app->Request()->getParameter("payment_status");

        // Define Json
        $items = $this->app->Request()->getParameter("items");        

        $poshelper = new POSHelper($this->app,$outlet);
        
        $poshelper->setCustomer($salutation,$fname,$lname,$email,$mobile,$gst,$remark);
        foreach($items as $item)
        {
            $billingItem = new BillingItem();
            $billingItem->setProduct_id($item->product_id*1);
            $billingItem->setSerial_no($item->serial_no);
            $billingItem->setBatch_no($item->batch_no);
            $billingItem->setQty($item->qty*1);
            $billingItem->setRate((float)$item->rate);            

            $poshelper->additems($billingItem);
        }

        $poshelper->SubmitOrder($payment_mode,$payment_remark,$payment_status);

        $this->apiResponse([
            "Order" => $poshelper->order->toArray(),
            "Shipping" => $poshelper->shippingorder->toArray(),
        ], 200, "Order Submitted");
    }
    
    /**
     * @OA\Get(
     *     path="/api/orderDelete",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Order deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function orderDelete() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $orderID = $this->app->Request()->getParameter("order_id");
                $order = \entities\OrdersQuery::create()
                        ->filterByOrderId($orderID)
                        ->filterByOrderStatus('Created')
                        ->_or()
                        ->filterByOrderStatus('Accepted')
                        ->findOne();
                if ($order) {
                    $order->setOrderStatus('Cancelled');
                    $order->save();
                    \Modules\Orders\Runtime\OrderHelper::addLog($this->app, $order->getPrimaryKey(), "Order Cancelled", "", $order->toArray());
                    $this->apiResponse([], 200, "Order cancelled successfully!");
                } else {
                    $this->apiResponse([], 400, "You are not able to delete this order!");
                }
                break;
        endswitch;
    }

/**
     * @OA\Get(
     *     path="/api/orderMarkDelivered",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Parameter(
     *         name="media_id",
     *         in="query",
     *         description="Order Media",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Order deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function orderMarkDelivered() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $orderID = $this->app->Request()->getParameter("order_id");
                $media_id = $this->app->Request()->getParameter("media_id","");
                $order = \entities\OrdersQuery::create()
                        ->filterByOrderId($orderID)
                        ->filterByOrderStatus('Created')
                        ->_or()
                        ->filterByOrderStatus('Accepted')
                        ->findOne();
                if ($order) {
                   
                    $order->setOrderStatus("Completed");
                    $order->setOrderRerference($media_id);
                    $order->save();
                    \Modules\Orders\Runtime\OrderHelper::addLog($this->app, $order->getPrimaryKey(), "Order Completed", "", $order->toArray());
                    $this->apiResponse([], 200, "Order Completed successfully!");
                    }
                else {
                    $this->apiResponse([], 400, "You are not able to Change status for this order this order!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOrderStatus",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),          
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOrderStatus()
    {                
        $this->apiResponse($this->getConfig("Orders","orderStatus"), 200, "Order Status");
    }

    /**
     * @OA\Get(
     *     path="/api/getPrimaryOrder",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_status",
     *         in="query",
     *         description="Order Status",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ),              
     *     @OA\Response(
     *         response="200",
     *         description="Get Orders successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getPrimaryOrder()
    {                
        $orderStatus = $this->app->Request()->getParameter("order_status");
        $territoryId = $this->app->Request()->getParameter("territory_id","");
        $fromDate = $this->app->Request()->getParameter("from_date","");
        $toDate = $this->app->Request()->getParameter("to_date","");
        
        $orgManager = new OrgManager();
        if($territoryId != null || $territoryId != ''){
            $ter = \entities\TerritoriesQuery::create()
                    ->filterByTerritoryId($territoryId)
                    ->findOne();
            $underPosi = $orgManager->getUnderPositions($ter->getPositionId());
            $underPositions = array_merge([$ter->getPositionId()],$underPosi);
        }else{
            $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
            $underPositions = $orgManager->getUnderPositions($positionId);
        }
        
        $employeeIds = \entities\EmployeeQuery::create()
                            ->select(['EmployeeId'])
                            ->filterByPositionId($underPositions)
                            ->find()->toArray();

        $companyOutletTypeId = $_ENV['COMPANY_OUTLET_TYPE_ID'];

        $companyOutletIds = \entities\OutletsQuery::create()
                                ->select(['Id'])
                                ->filterByOutlettypeId($companyOutletTypeId)
                                ->find()->toArray();
        
        $orders = \entities\OrdersQuery::create()
                        ->leftJoinOutletsRelatedByOutletFrom('FromOutlet')
                        ->addAsColumn('FromOutletName', "FromOutlet.OutletName")
                        ->innerJoinOutletsRelatedByOutletTo('ToOutlet')
                        ->addAsColumn('ToOutletName', "ToOutlet.OutletName")
                        ->filterByOutletTo($companyOutletIds)
                        ->filterByOrderStatus($orderStatus)
                        ->filterByOrderDate($fromDate, Criteria::GREATER_EQUAL)
                        ->filterByOrderDate($toDate, Criteria::LESS_EQUAL)
                        ->filterByEmployeeId($employeeIds)
                        ->find()->toArray();

        if(count($orders) > 0){
            $this->apiResponse([$orders], 200, "Get Order successfully!");
        }else{
            $this->apiResponse([], 400, "Order not found!");
        }
    }
    

    /**
     * @OA\Get(
     *     path="/api/changeOrderStatus",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="order_status",
     *         in="query",
     *         description="Order Status",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_remark",
     *         in="query",
     *         description="Order Remark",
     *         @OA\Schema(type="string")
     *     ),             
     *     @OA\Response(
     *         response="200",
     *         description="Order status change successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function changeOrderStatus()
    {                
        $orderStatus = $this->app->Request()->getParameter("order_status");
        $orderId = $this->app->Request()->getParameter("order_id","");
        $orderRemark = $this->app->Request()->getParameter("order_remark","");
        
        $order = \entities\OrdersQuery::create()
                        ->filterByOrderId($orderId)
                        ->findOne();

        if($order != null || $order != ''){
            $order->setOrderStatus($orderStatus);
            if($orderRemark != null || $orderRemark != ''){
                $order->setOrderRemark($orderRemark);
            }
            $order->save();
            \Modules\Orders\Runtime\OrderHelper::addLog($this->app, $order->getPrimaryKey(), "Order ".$orderStatus, $orderRemark);
            $this->apiResponse([$order->toArray()], 200, "Order status change successfully!");
        }else{
            $this->apiResponse([], 400, "Order not found!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/orderLogs",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Order deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function orderLogs() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $orderId = $this->app->Request()->getParameter("order_id");

                $orderLog = \entities\OrderLogQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->joinWithOrders()
                                ->joinWithUsers()
                                ->filterByOrderId($orderId)
                                ->orderByOrderLogId(Criteria::DESC)
                                ->find()->toArray();
                if ($orderLog) {
                    $this->apiResponse($orderLog, 200, "Order log successfully!");
                } else {
                    $this->apiResponse([], 400, "Order log not found!");
                }
                break;
        endswitch;
    }
}


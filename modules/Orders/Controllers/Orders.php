<?php declare(strict_types = 1);

namespace Modules\Orders\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use DateTime;
use entities\Base\OrderlinesQuery;
use entities\Base\OrderLogQuery;
use entities\Base\OrdersQuery;
use entities\EmployeeQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Orders extends \App\Core\BaseController{
   
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;               
    }
    
    function primaryOrders()
    {
        $this->orders("primary");
    }
        
    
    function orders($direction){               
        ini_set('memory_limit', '-1');
    //    $datachange = $this->app->Request()->getParameter("datachange","");  
    //    if($datachange == "OutletFrom")
    //     {       
    //          $this->__ReturnParent();                        
    //          return;
    //     }
    //    if($datachange == "OrderType")
    //     {       
    //        $outlets = [];
    //        if($this->app->Request()->getParameter("OrderType") == "IN")
    //        {
    //            $outlets = $this->__getOutletsArray(true);
    //        }
    //        else 
    //        {
    //            $outlets = $this->__getOutletsArray();
    //        }
           
    //        $opt = FormMgr::select()->options($outlets)->html();
    //        $this->json(["OutletFrom" => $opt]);
    //        return;
    //     }
       $this->data['title'] = "Orders";
       $emplist = EmployeeQuery::create()
       ->filterByStatus(1)
       ->select(array('EmployeeId', 'FirstName'))  
       ->orderBy('FirstName', Criteria::ASC)
       ->find()
       ->toKeyValue('EmployeeId', 'FirstName'); 
        $newKey = '0';
        $newValue = 'All Employee';
        $newArray = array($newKey => $newValue) + $emplist;
        $f = FormMgr::form();
        $f->add([
            "emplist"  => FormMgr::select()->label("Employee")->options($newArray)->id('emplist'),
            "startDate" => FormMgr::text()->label("From Date")->id("startDate")->class('datepicker'),
            "endDate" => FormMgr::text()->label("To Date")->id("endDate")->class('datepicker'),

        ]);
        $this->data['filters'] = $f->html();

       $this->data['cols'] = [
           "OrderNumber" => "OrderNumber",           
           "OrderType" => "OrderType",           
           "OutletFromName" => "OutletFromName",
           "OutletToName" => "OutletToName",
           "OrderDatee"=>"OrderDate",           
           "OrderTotal"=>"OrderTotal",
           "Employee"=>"Employee.FirstName",
           "OrderStatus"=>"OrderStatus",
           "OrderRemark"=>"OrderRemark",
       ];
       
       $this->data['pk'] = "OrderId";                     
       $this->data['singleFunc'] = "order";
       $this->data['canEditIf'] = ["col" => "OrderStatus","val" => "-1"];
       
       $action = $this->app->Request()->getParameter("action");
       $pk = $this->app->Request()->getParameter("pk",0);
       
       switch($action) : 
           case "":
              
                // $this->data['id_fields'] = [
                //     "OutletFrom","OutletTo"
                // ];
                // $alloutlets = $this->__getOutletsArray(false);
                // $this->data['valKeys'] = [
                //     "OutletFrom" => $alloutlets,
                //     "OutletTo" => $alloutlets
                // ];
               
               $this->app->Renderer()->render("orderdataTableServerSideTemplate.twig",$this->data);
               break;
           case "list":
            $emplist = $this->app->Request()->getParameter("emplist");  
            $startDate = $this->app->Request()->getParameter("startDate",'');
            $endDate = $this->app->Request()->getParameter("endDate",'');
               $date = $startDate;
                $currentdate1 = Date('Y-m-d');
                $startgivendate = new DateTime($startDate);
                $endgivendate = new DateTime($endDate);
                $currentdate = new DateTime($currentdate1);            
                $orderTypes = ["PO","RO","IN"];
               
               extract($this->DTFilters($_GET));
               $response = [];
               $query = \entities\OrdersQuery::create()
               ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
               ->filterByCompanyId($this->app->Auth()->CompanyId())               
               ->filterByOrderType($orderTypes);
             
           
           if ($startDate != '' && $endDate != '') {
               $applyDateFilter = false;
           
               if ($currentdate1 > $startDate && $currentdate1 > $endDate) {
                   $applyDateFilter = true;
               } elseif ($startgivendate->format('Y-m-d') == $currentdate->format('Y-m-d') && $endgivendate->format('Y-m-d') == $currentdate->format('Y-m-d')) {
                   $applyDateFilter = true;
               }
           
               if ($applyDateFilter) {
                   $query = $query->filterByOrderDate($startDate, Criteria::GREATER_EQUAL)
                                  ->filterByOrderDate($endDate, Criteria::LESS_EQUAL);
               }
           
               if ($emplist != 0) {
                   $query = $query->filterByEmployeeId($emplist);
               }
           } 
           else {
               // Return an empty result set if dates are not set
               $query = \entities\OrdersQuery::create()
                   ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                   ->filterByCompanyId($this->app->Auth()->CompanyId())                   
                   ->filterByOrderType($orderTypes);                 
                   //->where('1=0'); 

                   if ($emplist != 0) {
                    $query = $query->filterByEmployeeId($emplist);
                }
           }
           
        
           
               $count = $query->count();
               $response["recordsTotal"] = $count;

               if (!empty($search)) {
                   $search = '%' . $search . '%';
                    $query = $query->filterByOrderNumber($search, Criteria::LIKE);
                    // $query = $query->useOutletQuery()
                    //     ->filterByOutletName($search, Criteria::LIKE)
                    //     ->endUse()
                    //     ->_or()
                    //     ->filterByOrderNumber($search, Criteria::LIKE);
               }

               $count = $query->count();
               $response["recordsFiltered"] = $count;
               $response['data'] = $query->joinWithEmployee()             
               ->leftJoinOutletsRelatedByOutletTo('OutletTo')
               ->addAsColumn( 'OutletToName', "OutletTo.OutletName" )
               ->innerJoinOutletsRelatedByOutletFrom('OutletFrom')
               ->addAsColumn( 'OutletFromName', "OutletFrom.OutletName" )
               ->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();            
               $this->json($response);

               break;                      
           case "form": 
                    $outlets = $this->__getOutletsArray();                                                            
                            
                    //$outlettypes = \entities\OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("OutlettypeId","OutlettypeName");
                    //$zones = \entities\ZonesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("ZoneId","ZoneName");
                    
                    $orderTypes = ["PO" => "Purchase Order",
                                   "RO" => "Return Order",
                                   "IN" => "Retail Sales"];
                    
                    $f = FormMgr::formHorizontal();
                    $f->add([                                                
                        
                        'OrderType' => FormMgr::select()->options($orderTypes)->label('Order Type')->datachange('OrderType'),
                        'OrderDate' => FormMgr::text()->label('Date')->direction("range")->class('datepicker')->dmin("-1W")->dmax("+1W"),
                        'OutletFrom' => FormMgr::select()->options($outlets)->label('Billed To')->datachange('OutletFrom'),                                                        
                        'OutletTo' => FormMgr::select()->options([])->label('Billed By')->required(),                                                        
                        'OrderRemark' => FormMgr::text()->label('Remark'),
                    ]);
                    
                    $this->data['form_name'] = "Book Sales";                    
                    
                    
                    if($this->app->isPost() && $f->validate()){
                        
                        $cnvDate = explode("/",$_POST['OrderDate']);
                        $_POST['OrderDate'] = $cnvDate[2]."-".$cnvDate[1]."-".$cnvDate[0];
            
                        $order = new \entities\Orders();                        
                        $order->fromArray($_POST);      
                        
                        $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);
                        $orderNumber = $helper->getOrderSequence($_POST['OrderType']);
                        
                        
                        $order->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                        $order->setOrderNumber($orderNumber);
                        $order->setCompanyId($this->app->Auth()->CompanyId());                        
                        $order->setPricebookId($helper->getPriceBook($order->getOutletFrom(), $order->getOutletTo())->getPricebookId());                        
                        $order->setOrderStatus("Created");
                        $order->save();                                                
                        
                        \Modules\Orders\Runtime\OrderHelper::addLog($this->app,$order->getPrimaryKey(), "Order Created", "",$order->toArray());
                        
                        $url = $this->app->Router()->getPath("order",["id"=>$order->getPrimaryKey()]);
                        $this->runModalRedirect($url);
                        return; 
                    }                                                            
                    
                    $this->data['form'] = $f->html();
                    $this->app->Renderer()->render("orders/createOrder.twig",$this->data);
               break;
       endswitch;
    }
 
    function order($id = 0)
    {   
       $action = $this->app->Request()->getParameter("action");
              
       switch($action) : 
           case "":
               $order = \entities\OrdersQuery::create()                        
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($id);
        
               $this->data['order'] = $order;
        
               $this->data['ShippingOrder'] = $order->getShippingorders();
               
               $this->data['outletFrom'] = \entities\OutletsQuery::create()->findPk($order->getOutletFrom());
               $this->data['outletTo'] = \entities\OutletsQuery::create()->findPk($order->getOutletTo());                              
               
               if($order->getOrderStatus() == "Created")
               {
                   $this->data["canEdit"] = true;
               }
               
               $this->app->Renderer()->render("orders/CreateEditOrder.twig",$this->data);
                
                break;
           case "lines":
               $olis = \entities\OrderlinesQuery::create()
                   ->joinWithProducts()
                   ->findByOrderId($id);
               $order = \entities\OrdersQuery::create()                        
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($id);
               $log = \entities\OrderLogQuery::create()
                       ->joinWithUsers()
                       ->filterByOrderId($id)
                       ->orderByLogDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                       ->find();
               $this->json([
                            "oli" => $olis->toArray(),
                            "ord" => $order->toArray(),
                            "log" => $log->toArray()
                       ]);
               break;
       endswitch;
        
    }
    
    public function addOli($id)
    {
        
        $this->data['form_name'] = "Add"; 
        $pk = $this->app->Request()->getParameter("oli",0);
        
        
        $order = \entities\OrdersQuery::create()->findPk($id);
        $this->data["order"] = $order;
        $this->data['PriceBookId'] = $order->getPricebookId();
        
        $f = FormMgr::formHorizontal();            
        $f->add([                                                

            'ProductName' => FormMgr::text()->label('Product')->id("productName"),
            'ProductId' => FormMgr::hidden()->id("ProductId"),
            'Rate' => FormMgr::number()->label('Rate')->id("Rate")->readonly(),
            'Qty' => FormMgr::number()->label('Qty')->id("Qty"),
            'TotalAmt' => FormMgr::number()->label('Subtotal')->id("Total")->readonly(),                
            'Mrp' => FormMgr::hidden()->id("Mrp"),                
            'PricebookLine' => FormMgr::hidden()->id("PricebookLine"),                
            'UnitId' => FormMgr::hidden()->id("UnitId"),                
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        
        $orderline = new \entities\Orderlines();
        if($pk > 0)
        {
            $orderline = \entities\OrderlinesQuery::create()->findPk($pk);
            $f->val($orderline->toArray());
            $f["ProductName"]->val($orderline->getProducts()->getProductName());
            $this->data['form_name'] = "Edit";
            if($order->getOrderStatus() == "Created")
            {
                $this->data['canDelete'] = true;                
            }
            else 
            {
                $this->data['noSave'] = true;                
                $f['Qty']->readonly();
                $f['Remark']->readonly();
                $f['ProductName']->readonly();
            }
            
        }
        if($this->app->isPost() && $f->validate()){
            
            if($_POST['buttonValue'] == "delete")
            {
                \Modules\Orders\Runtime\OrderHelper::addLog($this->app,$id, "OL Delete :".$orderline->getProducts()->getProductName(), "",$orderline->toArray());
                $orderline->delete();                
            }
            else 
            {
                $orderline->fromArray($_POST);                                                        
                $orderline->setCompanyId($this->app->Auth()->CompanyId());
                $orderline->setOrderId($id);            
                $orderline->save();       
                
                \Modules\Orders\Runtime\OrderHelper::addLog($this->app,$id, "Line Added/Modified :".$orderline->getProducts()->getProductName(), "",$orderline->toArray());
            }
                                    
            \Modules\Orders\Runtime\OrderHelper::__CalculateOrderFigures($id);
            
            $this->runModalScript("loadOrderLines()");
            return; 
        }

        $this->data['form'] = $f->html();        
        
        $this->app->Renderer()->render("orders/orderlinesForm.twig",$this->data);
    }
    
    public function getProducts($pricebook_id)
    {
        $q = $this->app->Request()->getParameter("term");
        $res = [];
        
        $productLines = \entities\PricebooklinesQuery::create()
                    ->filterByPricebookId($pricebook_id)
                    ->find()->toKeyIndex("ProductId");
        
        $products = \entities\ProductsQuery::create()
                ->filterByProductName($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->limit(100)
                ->find();
        
        foreach($products as $product)
        {
            if(isset($productLines[$product->getPrimaryKey()]))
            {
                $priceline = $productLines[$product->getPrimaryKey()];
                $res[] = ["label" => $product->getProductName(). " | ".$product->getPackingDesc()."| MRP :".$priceline->getMaxRetailPrice()."| PTR :".$priceline->getSellingPrice()
                        ,"value" => $priceline->toArray(),
                        "mrp" => $priceline->getMaxRetailPrice(),
                        "rate" => $priceline->getSellingPrice(),
                        "pblid" => $priceline->getPrimaryKey(),
                        "unitid" => $product->getUnitD(),
                        "id" => $product->getPrimaryKey()];
            }
            
        }        
        
        $this->json($res);
    }
    
    
    
    public function __ReturnParent()
    {
        $OutletFrom = $this->app->Request()->getParameter("OutletFrom");
        if ($OutletFrom == "") { 
            $this->app->Session()->setFlash("error", "Outlet Required"); 
        }else{

        $outletMap = \entities\Base\OutletMappingQuery::create()->findBySecondaryOutletId($OutletFrom);
        if($outletMap->count() == 0)
        {
            $this->app->Session()->setFlash("error", "No Primary Outlet mapped"); 
        }
        $primaryoutlets = [];
        foreach($outletMap as $map)
        {
            $primaryOutlet = \entities\OutletsQuery::create()->findPk($map->getPrimaryOutletId());
            $primaryoutlets[$map->getPrimaryOutletId()] = $primaryOutlet->getOutletName()." | ".$map->getPricebooks()->getPricebookName();
        }
        
        $opt = FormMgr::select()->options($primaryoutlets)->html();
        
        $this->json(["OutletTo" => $opt]);
        
        }
    }
    
    public function __getOutletsArray($endUser = false)
    {
        $alloutlets = \entities\OutletsQuery::create()
                ->joinWithOutletType()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->limit(10)
                ->find();
        
        $outlets = [];
        foreach($alloutlets as $out)
        {
            if($endUser && $out->getOutletType()->getIsoutletendcustomer() == 0)
            {
                continue;
            }
            
            $outlets[$out->getPrimaryKey()] = $out->getOutletName()." | ".$out->getOutletType()->getOutlettypeName();
        }
        return $outlets;
    }
    
    public function changeOrderStatus($order_id)
    {
        $order = \entities\OrdersQuery::create()->findPk($order_id);        
        $status = $this->getConfig("Orders","orderStatus");
        
        $stage = $this->app->Request()->getParameter("stag");
        
        $f = FormMgr::formHorizontal();            
        $f->add([                                                            
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        
        switch($stage) : 
           case "created":
               $this->data['form_name'] = "Are you sure you want to Accept the Order";
               if($this->app->isPost() && $f->validate()){
                   $remark = $this->app->Request()->getParameter("Remark","");
                    \Modules\Orders\Runtime\OrderHelper::addLog($this->app, $order->getPrimaryKey(), "Order Accepted ", $remark);
                    $order->setOrderStatus("Accepted");
                    $order->save();                
                    return;             

                }
            break;
                        
       endswitch;
                       
        $this->data['form'] = $f->html();                
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                
    }
    
    public function createShippingOrder($order_id)
    {
        $order = \entities\OrdersQuery::create()->findPk($order_id);        
        
        foreach($order->getShippingorders() as $so)
        {
            if($so->getSoStatus() == "Created")
            {
                $this->app->Session()->setFlash("error", "Cannot create new SO when ".$so->getSoNumber()." still in created state !");
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                return;
            }
        }
        
        $ShippingMode = $this->getConfig("Orders","ShippingMode");
        
        $orderHelper = new \Modules\Orders\Runtime\OrderHelper($this->app);
        
        $f = FormMgr::formHorizontal();            
        $f->add([                                                

            'ShippingOrderDate' => FormMgr::date()->label('Shipping Date'),            
            'ShippingMode' => FormMgr::select()->options($ShippingMode)->label('Shipping Mode'),
            'ShippingPartner' => FormMgr::text()->label('ShippingPartner'),
            'TrackingNumber' => FormMgr::text()->label('TrackingNumber'),            
        ]);
        
        if($this->app->isPost() && $f->validate()){
            
            $date = $this->app->Request()->getParameter("ShippingOrderDate");
            $mode = $this->app->Request()->getParameter("ShippingMode");
            $partner = $this->app->Request()->getParameter("ShippingPartner");
            $tracking = $this->app->Request()->getParameter("TrackingNumber");
            
            $so = $orderHelper->createShippingOrder($order, $date, $mode, $partner, $tracking);
            
            $this->runModalRedirect($this->app->Router()->getPath("shippingView",["id" =>$so->getPrimaryKey()]));
            
            return;
            
        }
        $this->data['form'] = $f->html();                
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
    }
    
    public function shippingView($id)
    {
       $Soid = $id;
       $action = $this->app->Request()->getParameter("action");
       $shippingorder = \entities\ShippingorderQuery::create()                        
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($Soid);
       $order = $shippingorder->getOrders();
       switch($action) : 
           case "":
             
               
               $this->data['so'] = $shippingorder;
               $this->data['order'] = $order;
               
               $this->data['outletTo'] = \entities\OutletsQuery::create()->findPk($shippingorder->getBilledbyOutlet());                                             
               $this->data['outletFrom'] = \entities\OutletsQuery::create()->findPk($shippingorder->getBilledtoOutlet());
               
               
               if($shippingorder->getSoStatus() == "Created")
               {
                   $this->data["canEdit"] = true;
               }
               
               $this->app->Renderer()->render("orders/CreateEditShipping.twig",$this->data);
                
                break;
           case "lines":
               $olis = \entities\ShippinglinesQuery::create()
                   ->joinWithProducts()
                   ->findBySoid($Soid);               
                              
               $stock = \entities\OutletStockQuery::create()
                       ->findByOutletId($order->getOutletTo())
                       ->toKeyValue("ProductId","FreeQty");
               
               $this->json([
                            "oli" => $olis->toArray(),                                           
                            "stock" => $stock
                       ]);
               break;
           case "allocations":
               
               $productid = $this->app->Request()->getParameter("productid");
               
               $trans = \entities\Base\StockTransactionQuery::create()
                       ->joinWithProducts()
                       ->filterByTranType("C")
                       ->filterBySvId($shippingorder->getSvId());               
               if($productid > 0)
               {
                   $trans->filterByProductId($productid);
                   
               }
               
               $this->json([
                            "allocations" => $trans->find()->toArray(),                                                                       
                       ]);
               break;
       endswitch;
    }
    
    public function changeShippingStatus($soid)
    {
        $order = \entities\ShippingorderQuery::create()->findPk($soid);
        $action = $this->app->Request()->getParameter("action");
                
        
        $f = FormMgr::formHorizontal();            
        $f->add([                                                            
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        
        $orderHelper = new \Modules\Orders\Runtime\OrderHelper($this->app);
        switch($action) : 
           case "allocate":
               $this->data['form_name'] = "Are you sure you want to Confirm all Allocation";
               if($this->app->isPost() && $f->validate()){
                   
                    $orderHelper->confirmAllocation($soid);                    
                    return;             

                }
            break;
        case "intransit":            
            $this->data['form_name'] = "Move out for Delivery";
            
            $ShippingMode = $this->getConfig("Orders","ShippingMode");
            
            $total = 0;
            foreach($order->getShippingliness() as $lines)
            {
                $total = $total + ($lines->getAllocatedQty() * $lines->getRate());
            }
            
            $f->add([                
                'InvoiceFile' => FormMgr::file()->label('Invoice Copy'),
                'InvoiceNumber' => FormMgr::text()->label('InvoiceNumber'),                
                'InvoiceAmount' => FormMgr::number()->val($total)->label('Invoice Amount'),                
                'ShippingMode' => FormMgr::select()->options($ShippingMode)->label('Shipping Mode'),
                'ShippingPartner' => FormMgr::text()->label('ShippingPartner'),
                'TrackingNumber' => FormMgr::text()->label('TrackingNumber'),            
                ]);            
            $f->val($order->toArray());            
            $f['InvoiceAmount']->val($total);
            
                if($this->app->isPost() && $f->validate()){
                                        
                    $order->fromArray($_POST);      
                    
                    try {
                        // If Invoice file is uploaded
                        if(isset($_FILES['InvoiceFile']))
                        {
                            $file = new \Upload\File('InvoiceFile', $this->app->Storage());
                            $new_filename = uniqid();       
                            $file->setName($new_filename);
                            $file->upload();
                            $order->setInvoiceFile($file->getNameWithExtension());
                        }
                    }
                    catch(\Exception $e){}
                    $order->setSoStatus("InTransit");
                    $order->save();
                                                          
                    return;             
                }
            
            break;
        case "delivered":
            $this->data['form_name'] = "Confirm Delivered";
            if($this->app->isPost() && $f->validate()){                
                $orderHelper->confirmDeliveredShipping($soid);                                                                            
                return;                             
            }            
            break;
        case "delivered1":
            $this->data['form_name'] = "Confirm Delivered";
            break;
       endswitch;
                       
        $this->data['form'] = $f->html();                
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
    }
    
    public function AllocateView($soid)
    {
        // Load allocation check list here and on save enter rec in SVLines
        $action = $this->app->Request()->getParameter("action");
        $solid = $this->app->Request()->getParameter("solid");
        $outletid = $this->app->Request()->getParameter("outletid");
        
        $solidRec = \entities\Base\ShippinglinesQuery::create()
                ->findPk($solid);
        
        if($solidRec->getShippingorder()->getSoStatus() != "Created") // it must be in stage created
        {
            $this->app->Session()->setFlash("error", "Allocation blocked");
            $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
            return;
        }
        if($this->app->isPost()){
            try {     
                $buttonValue = $this->app->Request()->getParameter("buttonValue"); 
                $trnHelper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
                $svid = $solidRec->getShippingorder()->getSvId();
                $totalAllocation = 0;
                if($buttonValue == "allocate") {
                    $allocation = json_decode($this->app->Request()->getParameter("allocation"));
                    

                    $out = $solidRec->getShippingorder()->getOrders()->getOutletTo();
                    $in = $solidRec->getShippingorder()->getOrders()->getOutletFrom();

                    // Clean the Vouchers 
                    $lines = \entities\Base\StockTransactionQuery::create()
                        ->filterByProductId($solidRec->getProductId())
                        ->filterBySvId($svid)
                        ->delete();
                    
                    
                    foreach($allocation as $alloc)                
                    {                                        
                        $trnHelper->allocateShippinginVocuher($svid, $out, $in, $solidRec->getProductId(), $alloc->serial, $alloc->batch, $alloc->allocate);
                        $totalAllocation = $totalAllocation + $alloc->allocate;
                    }

                    $solidRec->setAllocatedQty($totalAllocation);
                    $solidRec->save();
                }
                if($buttonValue == "delete")
                {
                    $trnHelper->unAllocateShipping($svid, $solidRec->getProductId());
                    
                    $solidRec->setAllocatedQty($totalAllocation);
                    $solidRec->save();
                }
                    
                $this->runModalScript("loadOrderLines(); refreshAllocation(".$solidRec->getProductId().")");
                return;             
            }
            catch(\Exception $e)
            {
                $this->app->Session()->setFlash("error", $e->getMessage());
            }
            
        }
        
        $inventoryView = \entities\Base\InventoryViewQuery::create()
                        ->filterByOutletId($outletid)
                        ->filterByProductId($solidRec->getProductId())
                        ->find();     
        
        $this->data['solid'] = $solidRec;
        $this->data['inventory'] = $inventoryView;        
        $this->app->Renderer()->render("orders/AllocationPopup.twig",$this->data);
        
    }
    
    public function ShippingList()
    {
        
       $this->data['title'] = "Shipping Order";
        
       $this->data['cols'] = [
           "SoNumber" => "SoNumber",           
           "ShippingOrderDate" => "ShippingOrderDate",           
           "SoStatus" => "SoStatus",
           "InvoiceNumber" => "InvoiceNumber",
           "ShippingMode"=>"ShippingMode",           
           "ShippingPartner"=>"ShippingPartner",
           "TrackingNumber"=>"TrackingNumber",           
       ];
       
       $this->data['pk'] = "Soid";                            
       $this->data['singleFunc'] = "shippingView";
       $this->data['canEditIf'] = ["col" => "SoStatus", "val" => "-1"];
       $action = $this->app->Request()->getParameter("action");
       
       $pk = $this->app->Request()->getParameter("pk",0);
              
       switch($action) : 
           case "":
                               
               $this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
               break;
           case "list":
                                            
               $this->json( ["data" => \entities\ShippingorderQuery::create()
                       ->filterByCompanyId($this->app->Auth()->CompanyId())
                       ->find()
                       ->toArray()]);
               break;                                
       endswitch;
    }
    
    function deleteOrder($order_id)
    {
        try {
            $order = OrdersQuery::create()
                ->filterByOrderStatus('Created')
                ->filterByOrderId($order_id)
                ->findOne();

            if ($order) {
                OrderlinesQuery::create()
                    ->filterByOrderId($order_id)
                    ->delete();
                OrderLogQuery::create()
                    ->filterByOrderId($order_id)
                    ->delete();
                $order->delete();
                $response['msg'] = " has been deleted successfully.";
                $this->json($response);
            } else {
                $response['msg'] = "Order not found.";
                $this->json($response);
            }
        } catch (\Exception $e) {
            return "Error deleting order: " . $e->getMessage();
        }
    }
    function printorder($order_id)
    {

        $action = $this->app->Request()->getParameter("action");

        switch ($action) :
            case "":
                $order = \entities\OrdersQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($order_id);

                $this->data['order'] = $order;

                $this->data['ShippingOrder'] = $order->getShippingorders();

                $this->data['outletFrom'] = \entities\OutletsQuery::create()->findPk($order->getOutletFrom());
                $this->data['outletTo'] = \entities\OutletsQuery::create()->findPk($order->getOutletTo());

                if ($order->getOrderStatus() == "Created") {
                    $this->data["canEdit"] = true;
                }

                $this->app->Renderer()->render("orders/CreateEditOrderPrint.twig", $this->data);

                break;
            case "lines":
                $olis = \entities\OrderlinesQuery::create()
                    ->joinWithProducts()
                    ->findByOrderId($order_id);
                $order = \entities\OrdersQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findPk($order_id);
                $log = \entities\OrderLogQuery::create()
                    ->joinWithUsers()
                    ->join('OrderLog.Users')
                    ->filterByOrderId($order_id)
                    ->orderByLogDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                    ->find();

                $this->json([
                    "oli" => $olis->toArray(),
                    "ord" => $order->toArray(),
                    "log" => $log->toArray()
                ]);
                break;
        endswitch;

    }
}
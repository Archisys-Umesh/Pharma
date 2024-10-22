<?php declare(strict_types = 1);

namespace Modules\Orders\Runtime;

use App\Utils\FormMgr;
use App\System\App;
use entities\StockVoucherQuery;
use Modules\ESS\Exceptions\InvalidArgumentException;


abstract class OrderTypes
{
    const PurchaseOrder = "PO";
    const SalesOrder = "SO";
    const ReturnOrder = "RO";
    const RetailSales = "IN";    
}

class OrderHelper
{
    protected $app;
        
    public  function __construct(App $app)
    {
        $this->app = $app;
            
    }
    
    public function getOrderSequence($ordType)
    {
        $company = $this->app->Auth()->getUser()->getCompany();
        $current_idx = $company->getOrderSeq();
        
        $newIdx = $current_idx + 1;
        
        $company->setOrderSeq($newIdx);
        $company->save();
        
        return $ordType."-". str_pad((string)$newIdx, 5, '0', STR_PAD_LEFT);
        
    }
    
     public function getShippingOrderSequence()
    {
        $ordType = "DC";
        $company = $this->app->Auth()->getUser()->getCompany();
        $current_idx = $company->getShippingorderSeq();
        
        $newIdx = $current_idx + 1;
        
        $company->setShippingorderSeq($newIdx);
        $company->save();
        
        return $ordType."-". str_pad((string)$newIdx, 5, '0', STR_PAD_LEFT);
        
    }
    
    static public function addLog($app, $order_id,$title,$desc,$data=[])
    {
        $orderLog = new \entities\OrderLog();
        
        $orderLog->setOrderId($order_id);
        $orderLog->setTitle($title);
        $orderLog->setDescription($desc);
        $orderLog->setCompanyId($app->Auth()->CompanyId());
        $orderLog->setUserId($app->Auth()->getUser()->getPrimaryKey());
        $orderLog->setData(json_encode($data));        
        
        $orderLog->save();
        
    }
    
    public function getPriceBook($outletFrom,$outletTo) : \entities\Pricebooks
    {
        $mapping = \entities\Base\OutletMappingQuery::create()
                ->filterByPrimaryOutletId($outletTo)
                ->filterBySecondaryOutletId($outletFrom)
                ->findOne();
        if($mapping){
            return $mapping->getPricebooks();
        }else{
            return false;
        }
        
    }
    
    static public function __CalculateOrderFigures($orderId)
    {
        $order = \entities\OrdersQuery::create()->findPk($orderId);
        
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $totalQty = 0;
        
        foreach($order->getOrderliness() as $lines)
        {
            $subtotal = $subtotal + ($lines->getMrp() * $lines->getQty());
            $total = $total + ($lines->getRate() * $lines->getQty());
            $totalQty = $totalQty + $lines->getQty();
            
        }
        $discount = $subtotal - $total;
        
        $order->setOrderSubtotal($subtotal);
        $order->setOrderDiscount($discount);
        $order->setOrderTotal($total);
        $order->setOrderQty($totalQty);
        $order->save();
        
    }
    
    public function createShippingOrder(\entities\Orders $order,$date,$mode,$partner,$tracking) : \entities\Shippingorder
    {
        if($order->getOrderStatus() == "Accepted")
        {
            $orderSeq = $this->getShippingOrderSequence();
            
            // Creating Voucher 
            $sv = new \entities\StockVoucher();            
            $sv->setSvUserId($this->app->Auth()->getUser()->getPrimaryKey());
            $sv->setSvDesc($orderSeq);
            $sv->setSvStatus("Draft");
            $sv->setSvType("Sales");
            $sv->setCompanyId($this->app->Auth()->CompanyId());                        
            $sv->save();
            
            
            // Creating Shipping Order
            $shippingOrder = new \entities\Shippingorder();            
            $shippingOrder->setSoNumber($orderSeq);
            $shippingOrder->setOrderId($order->getPrimaryKey());
            $shippingOrder->setShippingOrderDate($date);
            $shippingOrder->setShippingMode($mode);
            $shippingOrder->setShippingPartner($partner);
            $shippingOrder->setTrackingNumber($tracking);
            $shippingOrder->setSoStatus("Created");
            $shippingOrder->setUserId($this->app->Auth()->getUser()->getPrimaryKey());
            $shippingOrder->setCompanyId($this->app->Auth()->CompanyId());
            $shippingOrder->setSvId($sv->getPrimaryKey());            
            
            $shippingOrder->setBilledtoOutlet($order->getOutletFrom());
            $shippingOrder->setBilledbyOutlet($order->getOutletTo());
            
            
            $shippingOrder->save();
            
            // Creating Shipping Line Items
            foreach($order->getOrderliness() as $lines)
            {
                $pendingQty = $lines->getQty() - $lines->getShipQty();
                if($pendingQty > 0) {
                    $shippinglines  = new \entities\Shippinglines();
                    $shippinglines->setCompanyId($this->app->Auth()->CompanyId());
                    $shippinglines->setSoid($shippingOrder->getPrimaryKey());
                    $shippinglines->setProductId($lines->getProductId());
                    $shippinglines->setQty($pendingQty);
                    $shippinglines->setRate($lines->getRate());
                    $shippinglines->setAllocatedQty(0);
                    $shippinglines->setOrderlineId($lines->getPrimaryKey());
                    $shippinglines->save();
                }
            }
            
            $this->addLog($this->app, $order->getPrimaryKey(), "Shipping Order Created", "ID :".$shippingOrder->getPrimaryKey());
            
            return $shippingOrder;
            
        }
        else 
        {
            throw new \Exception("Invalid Order Status");
            
        }
    }
    
    public function confirmAllocation($soid)
    {
        // Change Shipping Status
        $shippingOrder = \entities\ShippingorderQuery::create()->findPk($soid);        
        $shippingOrder->setSoStatus("Allocated");
        $shippingOrder->save();                

        // Delete non allocated entries 
        \entities\ShippinglinesQuery::create()
                ->filterBySoid($soid)
                ->filterByAllocatedQty(0)
                ->delete();
                
        // update order allocation status
        $order = $shippingOrder->getOrders();                
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();        
        $serviceContainer->getConnection()->exec("call UpdateOrderAllocation(".$order->getPrimaryKey().")");
        
        // Move Stock to Intransit
        $sv = $shippingOrder->getStockVoucher();
        $sv->setSvStatus("InTransit");
        $sv->save();        
        $th = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        $th->updateStockRegister($sv->getPrimaryKey());
        
        // If no Lines Pending the Move the Order forward. 
        $pendinglines = \entities\OrderlinesQuery::create()
                ->filterByOrderId($order->getPrimaryKey())                
                ->find();
        $noLinesPending = true;
        foreach($pendinglines as $pl)
        {
            if($pl->getShipQty() < $pl->getQty() )
            {
                $noLinesPending = false;       
                continue;
            }
        }
        if($order->getOrderStatus() == "Accepted" && $noLinesPending)
        {
            $order->setOrderStatus("Executed");
            $order->save();
        }        
        $this->addLog($this->app, $order->getPrimaryKey(),"Executed" ,"Order Moved to Executed");
    }
    
    public function confirmDeliveredShipping($soid)
    {
        // Change Status
        $shippingOrder = \entities\ShippingorderQuery::create()->findPk($soid);           
        $shippingOrder->setSoStatus("Delivered");
        $shippingOrder->save();
        
        // Move Voucher
        $sv = $shippingOrder->getStockVoucher();
        $sv->setSvStatus("Active");
        $sv->save();      
        
        // Update Stock Registers
        $th = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        $th->updateStockRegister($sv->getPrimaryKey());
        
        // If no Lines Pending Shipping and all items allocated then Move the Order to completed.
        $order = $shippingOrder->getOrders();      
        $pendinglines = \entities\OrderlinesQuery::create()
                ->filterByOrderId($order->getPrimaryKey())                
                ->find();
        $noLinesPending = true;
        foreach($pendinglines as $pl)
        {
            if($pl->getShipQty() < $pl->getQty() )
            {
                $noLinesPending = false;       
                continue;
            }
        }
        
        $NoPendingShipping = \entities\ShippingorderQuery::create()
                ->filterByOrderId($shippingOrder->getOrderId())
                ->filterBySoStatus(['Created','Allocated','InTransit'])
                ->count();
        
        if($NoPendingShipping == 0)
        {            
            $order->setOrderStatus("Completed");
            $order->save();
        }
        $this->addLog($this->app, $order->getPrimaryKey(),"Complated" ,"Order Moved to Completed");
    }
    
    public function createReverseShippingOrder(\entities\Shippingorder $shippingOrder,$returnArray) : \entities\Shippingorder
    {              
        $orderSeq = 'Return:'.$shippingOrder->getSoNumber();
            
        // Creating Voucher 
        $sv = new \entities\StockVoucher();            
        $sv->setSvUserId($this->app->Auth()->getUser()->getPrimaryKey());
        $sv->setSvDesc($orderSeq);
        $sv->setSvStatus("InTransit");
        $sv->setSvType("Return");
        $sv->setCompanyId($this->app->Auth()->CompanyId());                        
        $sv->save();


        // Reversal
        $outlet_from = $shippingOrder->getOrders()->getOutletTo();
        $outlet_to = $shippingOrder->getOrders()->getOutletFrom();
        
        // Creating Shipping Order
        $newShippingOrder = new \entities\Shippingorder();            
        $newShippingOrder->setSoNumber($orderSeq);
        $newShippingOrder->setOrderId($shippingOrder->getOrderId());
        $newShippingOrder->setShippingOrderDate(date("Y-m-d"));
        $newShippingOrder->setShippingMode($shippingOrder->getShippingMode());
        $newShippingOrder->setShippingPartner($shippingOrder->getShippingPartner());
        $newShippingOrder->setTrackingNumber("");
        $newShippingOrder->setSoStatus("Created");
        $newShippingOrder->setUserId($this->app->Auth()->getUser()->getPrimaryKey());
        $newShippingOrder->setCompanyId($this->app->Auth()->CompanyId());
        $newShippingOrder->setSvId($sv->getPrimaryKey());            
        
        $newShippingOrder->setBilledtoOutlet($outlet_from);
        $newShippingOrder->setBilledbyOutlet($outlet_to);

        $newShippingOrder->save();        
        
        $tranHelper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        
        // Creating Voucher Lines 
        
        $productArray = [];
        
        foreach($returnArray as $returnLines)
        {
          $stlines = \entities\StockTransactionQuery::create()->findPk($returnLines->stid);
          $tranHelper->allocateShippinginVocuher($sv->getPrimaryKey(), $outlet_to, $outlet_from, $stlines->getProductId(), $stlines->getSerialNo(), $stlines->getBatchNo(), $returnLines->qty);
          
          if(!isset($productArray[$stlines->getProductId()])) { $productArray[$stlines->getProductId()] = 0;}
          
          $productArray[$stlines->getProductId()] = $productArray[$stlines->getProductId()] + $returnLines->qty;
          
        }
        
        // Creating Shipping Line Items
            foreach($shippingOrder->getShippingliness() as $lines)
            {
                if(isset($productArray[$lines->getProductId()]))
                {
                    $shippinglines  = new \entities\Shippinglines();
                    $shippinglines->setCompanyId($this->app->Auth()->CompanyId());
                    $shippinglines->setSoid($newShippingOrder->getPrimaryKey());
                    $shippinglines->setProductId($lines->getProductId());
                    $shippinglines->setQty($productArray[$lines->getProductId()]);
                    $shippinglines->setRate($lines->getRate()*-1);
                    $shippinglines->setAllocatedQty($productArray[$lines->getProductId()]);
                    $shippinglines->setOrderlineId($lines->getPrimaryKey());
                    $shippinglines->save();                                        
                }                
                                                    
            }
                    
        $this->addLog($this->app, $shippingOrder->getOrderId(), "Return Shipping Order Created", "ID :".$orderSeq);
            
        return $newShippingOrder;
        
    }
}
<?php declare(strict_types = 1);

namespace Modules\Orders\Runtime;

use entities\OutletTypeQuery;
use App\System\App;
use entities\InventoryViewQuery;
use entities\Orders;
use entities\Outlets;
use entities\OutletsQuery;
use entities\OutletType;
use entities\PricebooklinesQuery;
use entities\PricebooksQuery;
use entities\ProductsQuery;
use entities\Shippingorder;
use Exception;

class POSHelper
{
    protected $app;
    protected OutletType $outlet_type;
    protected Outlets $SaleOutlet;
    protected Outlets $customer;
    protected BillingItemCollection $items;
    public Orders $order;
    public Shippingorder $shippingorder;
        
    public  function __construct(App $app,$saleOutlet_id)
    {
        $this->app = $app;

        $this->outlet_type = OutletTypeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByIsoutletendcustomer(1)
                    ->filterByIsenabled(1)
                    ->findOne();
        if(!$this->outlet_type)
        {
            throw new Exception("End Customer OutletType not Created",400);
        }

        $this->SaleOutlet = OutletsQuery::create()->findPk($saleOutlet_id);
        if(!$this->SaleOutlet)
        {
            throw new Exception("End Customer Sale Outlet not found",400);
        }

        $this->items = new BillingItemCollection();
            
    }

    public function setCustomer($saluation, $fname, $lname,$email,$mobile,$gst,$remark)
    {
        $customer = OutletsQuery::create()
                    ->filterByCompanyId($this->SaleOutlet->getCompanyId())
                    ->filterByTerritoryId($this->SaleOutlet->getTerritoryId())
                    ->findByOutletContactNo($mobile)->getFirst();
        if($customer)
        {
            $this->customer = $customer;
        }
        else 
        {
            $customer = new Outlets();

            $customer->setOutletCode("Customer");
            $customer->setOutletIsdCode("+");
            $customer->setOutletName($fname .' '. $lname);
            $customer->setOutletContactName($fname .' '. $lname);
            $customer->setOutletSalutation($saluation);
            $customer->setOutletEmail($email);
            $customer->setOutletLandlineno($gst);
            $customer->setOutletAddress($remark);
            $customer->setOutletPincode("-");
            $customer->setOutletContactNo($mobile);

            $customer->setCompanyId($this->SaleOutlet->getCompanyId());
            $customer->setTerritoryId($this->SaleOutlet->getTerritoryId());
            $customer->setOutlettypeId($this->outlet_type->getPrimaryKey());
            $customer->setOutletStatus("active");

            $customer->setOutletGps($this->SaleOutlet->getOutletGps());

            $customer->save();

        }

        $this->customer = $customer;
    }

    public function additems(BillingItem $item)
    {
        $inventory = InventoryViewQuery::create()
                        ->filterByOutletId($this->SaleOutlet->getPrimaryKey())
                        ->filterByProductId($item->getProduct_id())
                        ->filterByBatchNo($item->getBatch_no())
                        ->findOne();
        if($inventory && $inventory->getAvailable() >= $item->getQty())
        {
            $this->items->add($item);            
        }
        else 
        {
            throw new exception($item->getSerial_no(). " Item not availabe in Inventory !!");
        }
    }

    public function SubmitOrder($payment_mode,$payment_remark,$payment_status)
    {
        $helper = new \Modules\Orders\Runtime\OrderHelper($this->app);

        $order = new Orders();
        $order->setOrderType("IN");
        $order->setOrderNumber($helper->getOrderSequence("IN"));
        $order->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
        $order->setCompanyId($this->app->Auth()->CompanyId());                
        $order->setPricebookId($this->SaleOutlet->getOutletAccountDetails()->getOutletDefaultPricebook());
        $order->setOutletFrom($this->customer->getPrimaryKey());
        $order->setOutletTo($this->SaleOutlet->getPrimaryKey());
        $order->setOrderDate(date("Y-m-d"));
        $order->setOrderStatus("Accepted");
        $order->save();                   

        $this->order = $order;

        $pricebook = PricebooklinesQuery::create()
                    ->findByPricebookId($this->SaleOutlet->getOutletAccountDetails()->getOutletDefaultPricebook())
                    ->toKeyIndex("ProductId");
        $products = ProductsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toKeyIndex("Id");

        \Modules\Orders\Runtime\OrderHelper::addLog($this->app,$order->getPrimaryKey(), "Order Created", "",$order->toArray());

        foreach($this->items->getOrderProducts() as $product_id => $value)
        {
            $orderline = new \entities\Orderlines();
            $orderline->setOrderId($order->getPrimaryKey());
            $orderline->setProductId($product_id);
            $orderline->setQty($value['Qty']);            
            $orderline->setRate($value['Rate']);            
            $orderline->setTotalAmt($value['Qty'] * $value['Rate']);
            $orderline->setMrp($pricebook[$product_id]->getMaxRetailPrice());
            $orderline->setPricebookLine($pricebook[$product_id]->getPrimaryKey());
            $orderline->setUnitId($products[$product_id]->getUnitD());
            $orderline->setCompanyId($this->app->Auth()->CompanyId());
            $orderline->save();
        }

        $helper->__CalculateOrderFigures($order->getPrimaryKey());
        $shippingOrder = $helper->createShippingOrder($order,date("Y-m-d"),"Retail","","");

        $shippingOrder->setPaymentMode($payment_mode);
        $shippingOrder->setPaymentRemark($payment_remark);
        $shippingOrder->setPaymentStatus($payment_status);

        $shippingOrder->save();

        $this->shippingorder = $shippingOrder;

        $trnHelper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        $svid = $shippingOrder->getSvId();
        foreach($this->items->getShippingAllocations() as $stock)
        {
            $trnHelper->allocateShippinginVocuher($svid, $order->getOutletTo(), $order->getOutletFrom(), $stock->getProduct_id(), $stock->getSerial_no(), $stock->getBatch_no(), $stock->getQty());
        }
        // Complete Allocation
        foreach($shippingOrder->getShippingliness() as $solid)
        {
            $solid->setAllocatedQty($solid->getQty());
            $solid->save();
        }
        foreach($order->getOrderliness() as $lines)
        {
            $lines->setShipQty($lines->getQty());
            $lines->save();
        }
        
        // Adjust stock 
        $helper->confirmAllocation($shippingOrder->getPrimaryKey());

        // Mark GRN
        $helper->confirmDeliveredShipping($shippingOrder->getPrimaryKey());

    }
    

}
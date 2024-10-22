<?php declare(strict_types = 1);

namespace Modules\Orders\Runtime;


use Exception;

use Modules\Orders\Runtime\BillingItem;

class BillingItemCollection 
{
   public $billingItems = [];
   public $productlines = [];

   public function add(BillingItem $item)
   {

    foreach($this->billingItems as $bi)
    {
        if($bi->getProduct_id() == $item->getProduct_id() && $bi->getSerial_no() == $item->getSerial_no())
        {
            throw new Exception("Item already exists",400);
        }        
    }
    
    $this->billingItems[] = $item;

        if(!isset($this->productlines[$item->getProduct_id()]))
        {
            $this->productlines[$item->getProduct_id()] = [
                "Qty" => 0,"Rate"=> 0
            ];
        }

        $this->productlines[$item->getProduct_id()]["Qty"] = $this->productlines[$item->getProduct_id()]["Qty"] + $item->getQty();
        $this->productlines[$item->getProduct_id()]["Rate"] = $item->getRate();
    

   }

   public function getShippingAllocations()
   {
        return $this->billingItems;
   }

   public function getOrderProducts()
   {
        return $this->productlines;
   }
  
}


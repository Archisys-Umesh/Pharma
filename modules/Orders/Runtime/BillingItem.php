<?php declare(strict_types = 1);

namespace Modules\Orders\Runtime;

use Respect\Validation\Rules\Decimal;

class BillingItem
{
   private int $product_id;
   private string $serial_no;
   private string $batch_no;
   private int $qty;
   private float $rate;   



   /**
    * Get the value of product_id
    */ 
   public function getProduct_id()
   {
      return $this->product_id;
   }

   /**
    * Set the value of product_id
    *
    * @return  self
    */ 
   public function setProduct_id($product_id)
   {
      $this->product_id = $product_id;

      return $this;
   }

   /**
    * Get the value of serial_no
    */ 
   public function getSerial_no()
   {
      return $this->serial_no;
   }

   /**
    * Set the value of serial_no
    *
    * @return  self
    */ 
   public function setSerial_no($serial_no)
   {
      $this->serial_no = $serial_no;

      return $this;
   }

   /**
    * Get the value of batch_no
    */ 
   public function getBatch_no()
   {
      return $this->batch_no;
   }

   /**
    * Set the value of batch_no
    *
    * @return  self
    */ 
   public function setBatch_no($batch_no)
   {
      $this->batch_no = $batch_no;

      return $this;
   }

   /**
    * Get the value of qty
    */ 
   public function getQty()
   {
      return $this->qty;
   }

   /**
    * Set the value of qty
    *
    * @return  self
    */ 
   public function setQty($qty)
   {
      $this->qty = $qty;

      return $this;
   }

   /**
    * Get the value of rate
    */ 
   public function getRate()
   {
      return $this->rate;
   }

   /**
    * Set the value of rate
    *
    * @return  self
    */ 
   public function setRate($rate)
   {
      $this->rate = $rate;

      return $this;
   }

}
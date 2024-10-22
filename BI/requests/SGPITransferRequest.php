<?php

namespace BI\requests;

use DateTime;


/**
 * Description of MTP Manager
 *
 * @author Chintan
 */
class SGPITransferRequest 
{

    var int $from_sgpi_account_id;
    var int $to_sgpi_account_id;
    var int $sgpi_id;
    var int $qty;
    var $remark;
    var bool $twoWay = true;
    var int $company_id;
    var $message;
    var $voucherId;


    /**
     * Get the value of from_sgpi_account_id
     */ 
    public function getFrom_sgpi_account_id()
    {
        return $this->from_sgpi_account_id;
    }

    /**
     * Set the value of from_sgpi_account_id
     *
     * @return  self
     */ 
    public function setFrom_sgpi_account_id($from_sgpi_account_id)
    {
        $this->from_sgpi_account_id = $from_sgpi_account_id;

        return $this;
    }

    /**
     * Get the value of to_sgpi_account_id
     */ 
    public function getTo_sgpi_account_id()
    {
        return $this->to_sgpi_account_id;
    }

    /**
     * Set the value of to_sgpi_account_id
     *
     * @return  self
     */ 
    public function setTo_sgpi_account_id($to_sgpi_account_id)
    {
        $this->to_sgpi_account_id = $to_sgpi_account_id;

        return $this;
    }

    /**
     * Get the value of sgpi_id
     */ 
    public function getSgpi_id()
    {
        return $this->sgpi_id;
    }

    /**
     * Set the value of sgpi_id
     *
     * @return  self
     */ 
    public function setSgpi_id($sgpi_id)
    {
        $this->sgpi_id = $sgpi_id;

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
     * Get the value of remark
     */ 
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set the value of remark
     *
     * @return  self
     */ 
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get the value of twoWay
     */ 
    public function getTwoWay()
    {
        return $this->twoWay;
    }

    /**
     * Set the value of twoWay
     *
     * @return  self
     */ 
    public function setTwoWay($twoWay)
    {
        $this->twoWay = $twoWay;

        return $this;
    }

    /**
     * Get the value of company_id
     */ 
    public function getCompany_id()
    {
        return $this->company_id;
    }

    /**
     * Set the value of company_id
     *
     * @return  self
     */ 
    public function setCompany_id($company_id)
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of voucherId
     */ 
    public function getVoucherId()
    {
        return $this->voucherId;
    }

    /**
     * Set the value of voucherId
     *
     * @return  self
     */ 
    public function setVoucherId($voucherId)
    {
        $this->voucherId = $voucherId;

        return $this;
    }
}
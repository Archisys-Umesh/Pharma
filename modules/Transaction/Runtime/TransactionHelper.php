<?php

declare(strict_types=1);

namespace Modules\Transaction\Runtime;

use App\System\App;

class TransactionHelper {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

  
   
   
     public function addTranLine($pk, $SvId, $OutletId,$tranType, $ProductId, $SerialNo, $BatchNo, $Qty, $Sku, $RefNum = null, $RefDesc = null) {
        if($OutletId != null){
            if ($pk > 0) {
                $dst = \entities\StockTransactionQuery::create()
                        ->filterByStid($pk)
                        ->findOne();
            } else {
                $dst = new \entities\StockTransaction();
            }
            $dst->setSvId($SvId);
            $dst->setSku($Sku);
            $dst->setSerialNo($SerialNo);
            $dst->setBatchNo($BatchNo);
            $dst->setQty($Qty);
            $dst->setCompanyId($this->app->Auth()->CompanyId());
            $dst->setProductId($ProductId);
            $dst->setOutletId($OutletId);
            $dst->setTranType($tranType);
            $dst->setRefNum($RefNum);
            $dst->setRefDesc($RefDesc);
            $dst->setTranDate(date('Y-m-d'));
            $dst->setCreatedUser($this->app->Auth()->getUser()->getUserId());
            $dst->save();
        }        
        
        return true;
        
    }        
    
    public function deleteTran(\entities\StockTransaction $stockTran)
    {
        $stockTran->delete();
    }
    
    public function reconsileTran($svid)
    {
        $sv = \entities\Base\StockVoucherQuery::create()->findPk($svid);
        
        $creditTrans = \entities\Base\StockTransactionQuery::create()
                        ->withColumn('SUM(Qty)', 'TotalQty')
                        ->filterBySvId($svid)
                        ->groupByProductId()
                        ->filterByTranType("C")
                        ->select(['ProductId','TotalQty'])
                        ->find()->toKeyValue('ProductId','TotalQty');
        
        $debitTrans = \entities\Base\StockTransactionQuery::create()
                        ->withColumn('SUM(Qty)', 'TotalQty')
                        ->filterBySvId($svid)
                        ->groupByProductId()
                        ->filterByTranType("D")
                        ->select(['ProductId','TotalQty'])
                        ->find()->toKeyValue('ProductId','TotalQty');
        
        foreach($creditTrans as $prd => $creditAmt)
        {
            
            if($debitTrans[$prd] != $creditAmt) 
            {                
                $sv->setSvError(1);
                $sv->save();
                return false;
            }
        }
        $sv->setSvError(0);
        $sv->save();
        return true;
    }
    
    public function updateStockRegister($svid)
    {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $outlets = \entities\StockTransactionQuery::create()
                ->select(["OutletId"])
                ->filterBySvId($svid)
                ->distinct()
                ->find()->toArray();
        foreach($outlets as $id)
        {
            $serviceContainer->getConnection()->exec("call UpdateStockRegister(".$id.",".$this->app->Auth()->CompanyId().")");
        }
        
        
    }

    
    public function allocateShippinginVocuher($SvId,$outlet_out,$outlet_in,$ProductId,$SerialNo,$BatchNo,$Qty)
    {
                
        // Debit
        $this->addTranLine(0, $SvId, $outlet_out, "D", $ProductId, $SerialNo, $BatchNo, $Qty, "", "");
        
        // Credit
        $this->addTranLine(0, $SvId, $outlet_in, "C", $ProductId, $SerialNo, $BatchNo, $Qty, "", "");
    }
    
    public function unAllocateShipping($SvId,$ProductId)
    {
         \entities\Base\StockTransactionQuery::create()
                ->filterByProductId($ProductId)
                ->filterBySvId($SvId)                
                ->delete();
    }
    
}

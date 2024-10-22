<?php

declare(strict_types=1);

namespace Modules\Transaction\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Transaction extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function transactionVoucher() {
        $this->data['title'] = "Stock Voucher";
        $this->data['form_name'] = "Voucher";
        $this->data['cols'] = [
            "Svid" => "Svid",
            "Date" => "SvDate",
            "Remark" => "SvRemark",
            "Description" => "SvDesc",
            "Type" => "SvType",
            "Status" => "SvStatus",
        ];

        $this->data['pk'] = "Svid";
        $this->data['singleFunc'] = "transaction";
        $this->data['canEditIf'] = ["col" => "SvStatus", "val" => "-1"];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\StockVoucherQuery::create()
                            ->joinWithUsers()
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->find()
                            ->toArray()]);
                break;
            case "form":
                $types = $this->getConfig("Transaction", "TransactionTypes");
                $statues = $this->getConfig("Transaction", "TransactionStatus");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'SvRemark' => FormMgr::text()->label('Remark'),
                    'SvDesc' => FormMgr::text()->label('Description'),
                    'SvType' => FormMgr::select()->options($types)->label('Stock Type')->required(),                    
                ]);
                $sv = new \entities\StockVoucher();
                $this->data['form_name'] = "Add Stock Voucher";
                if ($pk > 0) {
                    $sv = \entities\StockVoucherQuery::create()
                            ->findPk($pk);
                    $f->val($sv->toArray());
                    $this->data['form_name'] = "Edit Stock Voucher";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $sv->fromArray($_POST);
                    $sv->setSvUserId($this->app->Auth()->getUser()->getUserId());
                    $sv->setCompanyId($this->app->Auth()->CompanyId());
                    $sv->setSvStatus("Draft");
                    $sv->save();
                    $url = $this->app->Router()->getPath("transaction", ["id" => $sv->getPrimaryKey()]);
                    $this->runModalRedirect($url);
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("transaction/createTransaction.twig", $this->data);
                break;
        endswitch;
    }

    function transaction($id = 0) {
        $action = $this->app->Request()->getParameter("action");

        switch ($action) :
            case "":
                $stockVoucher = \entities\StockVoucherQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findPk($id);
                $this->data['stockVoucher'] = $stockVoucher;
                $this->app->Renderer()->render("transaction/CreateEditTransaction.twig", $this->data);

                break;
            case "lines":
                $stockTransaction = \entities\StockTransactionQuery::create()
                        ->joinWithOutlets()
                        ->joinWithProducts()                                                
                        ->orderByProductId()
                        ->orderByTranType(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                        ->findBySvId($id);
                $stockVoucher = \entities\StockVoucherQuery::create()
                        ->filterByPrimaryKey($id)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find();

                $this->json([
                    "cst" => $stockTransaction->toArray(),
                    "csv" => $stockVoucher->toArray()
                ]);
                break;       
                case "status":
                $stockVoucher = \entities\StockVoucherQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findPk($id);
                $this->data['stockVoucher'] = $stockVoucher;
                $this->app->Renderer()->render("transaction/CreateEditTransaction.twig", $this->data);

                break;
        endswitch;
    }

    public function addtransaction($id) {
        $this->data['form_name'] = "Add Transaction";
        $pk = $this->app->Request()->getParameter("st", 0);

        $stockVoucher = \entities\StockVoucherQuery::create()->findPk($id);
        $this->data["StockVoucher"] = $stockVoucher;

        $outlets = \entities\OutletsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue('Id', 'OutletName');
        $products = \entities\ProductsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue('Id', 'ProductName');
        $types = $this->getConfig("Transaction", "StockTransactionTypes");

        $f = FormMgr::formHorizontal();
        $f->add([
            'SvId' => FormMgr::hidden()->value($id)->id("StockVouchwerId"),            
            'OutletId' => FormMgr::hidden()->id("OutletId"),
            'Outlet' => FormMgr::text()->label('Outlet')->id("Outlet")->required(),
            'ProductName' => FormMgr::text()->label('Product')->id("productName")->required(),
            'ProductId' => FormMgr::hidden()->id("ProductId"),
            'Sku' => FormMgr::hidden()->id("ProductSku"),
            'SerialNo' => FormMgr::text()->label('Serial No')->id("SerialNo"),
            'BatchNo' => FormMgr::text()->label('Batch No'),
            'TranType' => FormMgr::select()->options($types)->label('Transaction Type')->required(),
            'Qty' => FormMgr::number()->label('Qty *')->id("Qty")->required(),
        ]);

        $stockTransaction = new \entities\StockTransaction();
        if ($pk > 0) {
            $stockTransaction = \entities\StockTransactionQuery::create()->findPk($pk);
            $f->val($stockTransaction->toArray());
            $f["ProductName"]->val($stockTransaction->getProducts()->getProductName());                        
            
            $f["Outlet"]->val($stockTransaction->getOutlets()->getOutletName());                        
            
            $this->data['canDelete'] = true;                
            $this->data['form_name'] = "Edit Transaction";
        }
        if ($this->app->isPost() && $f->validate()) {
            $transactionHelper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
            
            
            if($_POST['buttonValue'] == "delete")
            {                
                $transactionHelper->deleteTran($stockTransaction);                
                $this->runModalScript("TransactionLines()");
                return;
            }
            
            $SvId = $_POST['SvId'];
            $OutletId = $_POST['OutletId'];
            $TranType = $_POST['TranType'];
            $ProductId = $_POST['ProductId'];
            $SerialNo = $_POST['SerialNo'];
            $BatchNo = $_POST['BatchNo'];
            $Qty = $_POST['Qty'];
            $Sku = $_POST['Sku'];
                    
            
            $resp = $transactionHelper->addTranLine($pk,$SvId,$OutletId,$TranType,$ProductId,$SerialNo,$BatchNo,$Qty,$Sku);
            
            $this->runModalScript("TransactionLines()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("transaction/transactionForm.twig", $this->data);
    }
    
    public function getTransactionProducts() {
        $q = $this->app->Request()->getParameter("term");
        $res = [];
        $products = \entities\ProductsQuery::create()
                ->filterByProductName($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->limit(100)
                ->find();
        foreach ($products as $product) {
            if ($product->getPrimaryKey()) {
                $res[] = ["label" => $product->getProductName() . " | " . $product->getProductSku(), "unitid" => $product->getUnitD(), "id" => $product->getPrimaryKey(), "sku" => $product->getProductSku()];
            }
        }
        $this->json($res);
    }
    
    public function deleteTransaction() {
        $svid = $this->app->Request()->getParameter("svid");
        
        $sv = \entities\StockVoucherQuery::create()->findPk($svid);    
        
        if($sv->getStockTransactions() != null)
        {
            $sv->getStockTransactions()->delete();
        }
        
        $sv->delete();
        $this->json(["status"=>"ok"]);
        return true;
    }

    public function changeTranStatus($svid)
    {
        $helper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        
        if(!$helper->reconsileTran($svid)) {
         
            $this->app->Session()->setFlash("error", "Voucher does not reconsile, please make sure it does");
            $this->data['noSave'] = true;
            $this->app->Renderer()->render("modalForm.twig",$this->data);
            return;
        }
            
        $sv = \entities\StockVoucherQuery::create()->findPk($svid);
        
        $status = $this->getConfig("Transaction","TransactionStatus");
        
        $f = FormMgr::formHorizontal();            
        $f->add([                                                

            'Status' => FormMgr::select()->options($status)->label('Status')->val($sv->getSvStatus()),
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        
        if($this->app->isPost() && $f->validate()){
            
            $status = $this->app->Request()->getParameter("Status",false);
            $remark = $this->app->Request()->getParameter("Remark","");
            if($status) {
                
                $sv->setSvStatus($status);
                $sv->setSvRemark($remark);
                $sv->save();                
                $helper->updateStockRegister($svid);
                return; 
            }
            
        }
        $this->data['form'] = $f->html();                
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
    }
    
    public function transactionReco($svid)
    {
        $helper = new \Modules\Transaction\Runtime\TransactionHelper($this->app);
        $helper->updateStockRegister(5);
        //$helper->reconsileTran($svid);
    }
    

}

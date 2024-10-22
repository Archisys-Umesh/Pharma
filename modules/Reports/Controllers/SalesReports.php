<?php

declare(strict_types=1);

namespace Modules\Reports\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\CategoriesQuery;
use entities\OrdersQuery;
use entities\EmployeeQuery;
use entities\OrderViewQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\TerritoriesQuery;
use entities\OutletCheckinQuery;
use entities\ClassificationQuery;
use entities\TagsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Reports
 *
 * @author Chintan Parikh
 */
class SalesReports extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    public function OrderReport()
    {
        ini_set('memory_limit', '-1');
        $action = $this->app->Request()->getParameter("action");

        $orderTypes = ["PO" => "Purchase Order",
                                   "RO" => "Return Order",
                                   "IN" => "Retail Sales"];

        switch ($action) :
            case "":    
                $outletType = \entities\OutletTypeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByIsenabled(1)
                    ->find()
                    ->toKeyValue("OutlettypeId", "OutlettypeName");

                $catMaster = $this->__GetCategories();                
                
                
                $f = FormMgr::form();
                $f->add([
                    "Date" => FormMgr::date()->label("Date")->required(),                    
                    "outletType" => FormMgr::select()->label("From : ")->options($outletType),                    
                    ]);
                $this->data['filters'] = $f->html();
                        
                
                $this->data['cols'] = [
                    "OrderNumber" => "OrderNumber",
                    "From" => "From",  
                    "To" => "To",
                    "ToCode" => "ToCode",
                    "OrderDate" => "OrderDate",                    
                    "OutletNumber" => "OutletNumber",
                    "Classification" => "Classification",                                        
                    "Category" => "Category",
                    "Tag" => "Tag",
                    "Product" => "Product",
                    "SKU" => "SKU",
                    "Qty" => "Qty",
                    "Rate" => "Rate",
                    "Total" => "TotalAmt",
                    "TSI" => "TSI",
                    "TSICode" => "TSICode",
                    "BeatName" => "BeatName",
                    "ReportsTo" => "ReportsTo",
                    "Status" => "Status",                    
                    "Remark" => "Remark",
                    "Checkin" => "Checkin",
                    "CheckinLocation" => "CheckinLocation",
                    "CheckinLatLng" => "CheckinLatLng",
                    "CheckinRemark" => "CheckinRemark"                    
                    ];
                
                $this->data['reportname'] = "OrderItemReport";
                $this->data['title'] = "Order Item Report";
                $this->data['Rowid'] = "Rowid";
                $this->data['RowClick'] = true;
                $this->data['Download'] = true;
                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;                    
            case "result":     
                $Date = $this->app->Request()->getParameter("Date");                
                $outletType = $this->app->Request()->getParameter("outletType");                
                
                $classification = \entities\ClassificationQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())                    
                        ->find()
                        ->toKeyValue("Id", "Classification");
                
                $employeeRec = EmployeeQuery::create()
                            ->filterByCompanyId($this->app->Auth()->CompanyId())                    
                            ->filterByPositionId(0,Criteria::GREATER_THAN)
                            ->select(["PositionId","FirstName","LastName","EmployeeCode"])
                            ->find();                            
                $employee = [];
                foreach($employeeRec as $empRec)
                {
                    $employee[$empRec["PositionId"]] = $empRec["FirstName"]." ".$empRec["LastName"]." | ".$empRec["EmployeeCode"];
                }
                unset($employeeRec);

                
                

                $checkins = OutletCheckinQuery::create()
                        //->filterByOutletId($outletsFrom)                                        
                        ->filterByCheckinDate($Date,Criteria::EQUAL)                        
                        //->joinWithEmployeeRelatedByEmpId()
                        ->find();
                $checinCache = [];
                foreach($checkins as $ch)
                {
                    
                    if($ch->getBeatId() == null){continue;}
                    $index = $ch->getOutletId()."|".strtotime($ch->getCheckinDate()->format("d-M-Y"));

                    
                    if(isset($checinCache[$index]))
                    {                    
                    
                        if($checinCache[$index]["BeatId"] == $ch->getBeatId()) {continue;}                       

                        $checinCache[$index]["Checkin"] .= $ch->getCheckinTime()->format("h:i a");
                        $checinCache[$index]["CheckinLocation"] .= " | ".$ch->getCheckinAddress();
                        $checinCache[$index]["CheckinLatLng"] .= " | ".$ch->getCheckinLocation();
                        $checinCache[$index]["CheckinRemark"] .= " | ".$ch->getCheckoutRemark();
                    }
                    else 
                    {
                        $checinCache[$index] = [
                            "BeatId" => $ch->getBeatId(),
                            "Checkin" => $ch->getCheckinTime()->format("h:i a"),
                            "CheckinLocation" => $ch->getCheckinAddress(),
                            "CheckinLatLng" => $ch->getCheckinLocation(),
                            "CheckinRemark" => $ch->getCheckoutRemark()
                        ];   
                    }
                }

                unset($checkins);

                $catMaster = $this->__GetCategories();

                $orders = OrderViewQuery::create()                                                                        
                                    ->filterByOrdCompanyId($this->app->Auth()->CompanyId())
                                    ->filterByOrdOrderDate($Date,Criteria::EQUAL);
                                                                    
                $orderList = $orders->find();

                $result = [];
                
                foreach($orderList as $order)
                {
                    $reportsTo = "NA";

                    if($order->getEmpReportingTo() != null && $order->getEmpReportingTo() > 0 && isset($employee[$order->getEmpReportingTo()]))
                    {
                        $reportsTo = $employee[$order->getEmpReportingTo()];
                    }

                    
                    
                    $index = $order->getFrmId()."|".strtotime($order->getOrdOrderDate()->format("d-M-Y"));                    

                    $Checkin = "";
                    $CheckinLocation = "";
                    $CheckinLatLng = "";
                    $CheckinRemark = "";

                    if(isset($checinCache[$index]))
                    {
                        $Checkin = $checinCache[$index]["Checkin"];
                        $CheckinLocation = $checinCache[$index]["CheckinLocation"];
                        $CheckinLatLng = $checinCache[$index]["CheckinLatLng"];
                        $CheckinRemark = $checinCache[$index]["CheckinRemark"];
                    }

                    $catName = "";
                    if(isset($catMaster[$order->getCategoryId()])) { $catName = $catMaster[$order->getCategoryId()]; }
                    $tagName = "";
                    if(isset($tagMaster[$order->getTagId()])) { $tagName = $tagMaster[$order->getTagId()]; }

                    $row = [
                        "OutletNumber" => $order->getFrmOutletCode(),
                        "Classification" => $classification[$order->getFrmOutletClassification()],
                        "OrderNumber" => $order->getOrdOrderNumber(),
                        "From" => $order->getFrmOutletName(),
                        "To" => $order->getToOutletName(),
                        "ToCode" => $order->getToOutletCode(),
                        "OrderDate"=> $order->getOrdOrderDate()->format("d-M-Y"),
                        "Category" => $catName,
                        "Tag" => $tagName,
                        "Product" => $order->getProductName(),
                        "SKU" => $order->getProductSku(),
                        "Qty" => $order->getQty(),
                        "Rate" => $order->getRate(),
                        "TotalAmt" => $order->getTotalAmt(),
                        "TSI" => $order->getEmpFirstName()." ".$order->getEmpLastLogin(),
                        "TSICode" => $order->getEmpEmployeeCode(),
                        "BeatName"=> $order->getBeatBeatName(),
                        "BeatId"=> $order->getBeatBeatId(),
                        "ReportsTo" => $reportsTo,
                        "Status" => $order->getOrdOrderStatus(),
                        "Remark" => $order->getOrdOrderRemark(),
                        "Checkin" => $Checkin,
                        "CheckinLocation" => $CheckinLocation,
                        "CheckinLatLng" => $CheckinLatLng,
                        "CheckinRemark" => $CheckinRemark,
                        "Rowid" => $order->getOrdOrderId()
                    ];    

                    array_push($result,$row);

                }                
                
                unset($catMaster);
                unset($checinCache);
                unset($orderList);

                if($this->app->Request()->getParameter("download",false))
                {
                    $this->download_array_csv($result,"Orders_".$Date.".csv");
                    exit;
                }

                $this->json(["aaData"=>array_values($result)]);
                break;
            case "RowClick" :
                    $orderId = $this->app->Request()->getParameter("RowId");

                    $this->app->Response()->redirect($this->app->Router()->getPath("order",["id"=>$orderId]));

                break;
            default:
                $this->json(["aaData"=>[]]);
                break;
        endswitch;

        
    }

    function __GetCategories()
    {
        $catMaster = [];
        $catRecs = CategoriesQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())                     
            ->find()->toKeyIndex();

        $catMaster["0"] = "All";
        foreach($catRecs as $id => $catRec)
        {
            if($catRec->getCategoryParentId() == 0) { continue; }
            $str = $catRecs[$catRec->getCategoryParentId()]->getCategoryName()." --- ".$catRec->getCategoryName();
            $catMaster[$catRec->getPrimaryKey()] = $str;
        }

        return $catMaster;
    }

}
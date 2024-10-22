<?php

declare(strict_types=1);

namespace Modules\Reports\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\BeatsQuery;
use entities\BeatOutlets;
use entities\BrandCampiagnQuery;
use entities\DarViewQuery;
use entities\OrdersQuery;
use App\Core\MediaManager;
use BI\manager\OrgManager;
use BI\manager\MTPManager;
use entities\OutletsQuery;
use entities\EmployeeQuery;
use entities\AttendanceQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\AgendatypesQuery;
use entities\BeatOutletsQuery;
use entities\CheckinViewQuery;
use entities\SgpiTransactionViewQuery;
use entities\TerritoriesQuery;
use entities\ItemSalesViewQuery;
use entities\OutletCheckinQuery;
use entities\OutletMappingQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

/**
 * Description of Reports
 *
 * @author Chintan Parikh
 */
class Reports extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function SalesReport()
    {
        $action = $this->app->Request()->getParameter("action");
        $monthlist = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));

        switch ($action):
            case "":
                $this->data['monthList'] = $monthlist->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("reports/salesView.twig", $this->data);
                break;
            case "load":

                $month = explode("|", $this->app->Request()->getParameter("month", "|"));

                $salesRec = ItemSalesViewQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByDate($month[0], Criteria::GREATER_EQUAL)
                    ->filterByDate($month[1], Criteria::LESS_EQUAL)
                    ->find();
                $this->data["sales"] = $salesRec;

                $monthlist->val($this->app->Request()->getParameter("month", "|"));
                $this->data['monthList'] = $monthlist->html();
                $this->app->Renderer()->render("reports/salesView.twig", $this->data);
                break;
        endswitch;
    }

    public function TargetViewReport()
    {
        $action = $this->app->Request()->getParameter("action");
        $monthlist = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));

        switch ($action):
            case "":
                $this->data['monthList'] = $monthlist->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("reports/TargetViewReport.twig", $this->data);
                break;
            case "load":

                $month = explode("|", $this->app->Request()->getParameter("month", "|"));

                $employees = EmployeeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();

                $this->data['employees'] = $employees;

                $data = [];
                $categoryCols = [];
                $salesRec = ItemSalesViewQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByDate($month[0], Criteria::GREATER_EQUAL)
                    ->filterByDate($month[1], Criteria::LESS_EQUAL)
                    ->find();

                foreach ($salesRec as $rec) {
                    if (!isset($data[$rec->getEmployeeId()])) {
                        $data[$rec->getEmployeeId()]["TotalSales"] = 0;
                    }

                    if (!isset($data[$rec->getEmployeeId()][$rec->getCategoryName()])) {
                        $data[$rec->getEmployeeId()][$rec->getCategoryName()] = 0;
                    }
                    array_push($categoryCols, $rec->getCategoryName());

                    $data[$rec->getEmployeeId()]["TotalSales"] = $data[$rec->getEmployeeId()]["TotalSales"] + $rec->getSales();
                    $data[$rec->getEmployeeId()][$rec->getCategoryName()] = $data[$rec->getEmployeeId()][$rec->getCategoryName()] + $rec->getSales();
                }

                $this->data["sales"] = $data;
                $this->data["categories"] = array_unique($categoryCols);

                $monthlist->val($this->app->Request()->getParameter("month", "|"));
                $this->data['monthList'] = $monthlist->html();
                $this->app->Renderer()->render("reports/TargetViewReport.twig", $this->data);
                break;
        endswitch;
    }

    public function TargetViewReportOutlets()
    {
        $action = $this->app->Request()->getParameter("action");
        $monthlist = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));

        $outletTypes = OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("OutlettypeId", "OutlettypeName");

        switch ($action):
            case "":
                $this->data['monthList'] = $monthlist->html();
                $this->data['outletTypes'] = FormMgr::select()->options($outletTypes)->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("reports/TargetViewReportOutlets.twig", $this->data);
                break;
            case "load":

                $month = explode("|", $this->app->Request()->getParameter("month", "|"));

                $outletType = $this->app->Request()->getParameter("outletType");

                $outlets = OutletsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutlettypeId($outletType)
                    ->filterByOutletPotential(NULL, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->find();

                $this->data['outlets'] = $outlets;
                $data = [];
                $categoryCols = [];
                $salesRec = ItemSalesViewQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByDate($month[0], Criteria::GREATER_EQUAL)
                    ->filterByDate($month[1], Criteria::LESS_EQUAL)
                    ->filterByOutletTypeId($outletType)
                    ->filterBySales(NULL, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->find();

                foreach ($salesRec as $rec) {
                    if (!isset($data[$rec->getBilledtoOutlet()])) {
                        $data[$rec->getBilledtoOutlet()]["TotalSales"] = 0;
                    }

                    if (!isset($data[$rec->getBilledtoOutlet()][$rec->getCategoryName()])) {
                        $data[$rec->getBilledtoOutlet()][$rec->getCategoryName()] = 0;
                    }
                    array_push($categoryCols, $rec->getCategoryName());

                    $data[$rec->getBilledtoOutlet()]["TotalSales"] = $data[$rec->getBilledtoOutlet()]["TotalSales"] + $rec->getSales();
                    $data[$rec->getBilledtoOutlet()][$rec->getCategoryName()] = $data[$rec->getBilledtoOutlet()][$rec->getCategoryName()] + $rec->getSales();
                }

                $this->data["sales"] = $data;
                $this->data["categories"] = array_unique($categoryCols);

                $monthlist->val($this->app->Request()->getParameter("month", "|"));
                $this->data['monthList'] = $monthlist->html();

                $this->data['outletTypes'] = FormMgr::select()->options($outletTypes)->val($this->app->Request()->getParameter("outletType"))->html();

                $this->app->Renderer()->render("reports/TargetViewReportOutlets.twig", $this->data);
                break;
        endswitch;
    }

    function employee()
    {

        $action = $this->app->Request()->getParameter('action', "");
        
        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/employeereport.twig", $this->data);
                break;
            case "load":

                /*$employees = \entities\EmployeeQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftjoinWithDesignations()
                        ->leftjoinWithPositionsRelatedByReportingTo()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find();*/

                $employees = \entities\AttendanceQuery::create()
                    ->joinWithEmployee()
                    ->select(['AttendanceId', 'StartTime', 'EndTime', 'OutletCount', 'AttendanceDate', 'Status'])
                    ->withColumn('Employee.FirstName', 'FirstName')
                    ->withColumn('Employee.LastName', 'LastName')
                    ->orderBy('AttendanceId', 'desc')
                    ->limit(50000)
                    ->find()->toArray();
               

                $this->data['employeeList'] = $employees;
                $this->app->Renderer()->render("reports/employeereport.twig", $this->data);

                break;
        endswitch;
    }

    function attendancereport()
    {


        $attendance = \entities\Base\AttendanceQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find();

        $employee = EmployeeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find();

        $attendancereport = [];

        foreach ($attendance as $att) {

            if (!isset($attendance)) {

                $attendance = 0;
            }
        }
    }

    public function OutletReports()
    {
        $action = $this->app->Request()->getParameter("action");


        switch ($action):
            case "":
                $outletType = \entities\OutletTypeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByIsenabled(1)
                    ->find()
                    ->toKeyValue("OutlettypeId", "OutlettypeName");

                $territoryRecs = \entities\TerritoriesQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                $territorylist = [];

                foreach ($territoryRecs as $terr) {
                    $str = $terr->getZones()->getZoneName() . " - " . $terr->getTerritoryName();

                    if ($terr->getEmployeeRelatedByTerritoryHead() != null) {

                        $str .= " | " . $terr->getEmployeeRelatedByTerritoryHead()->getFirstName();
                    }

                    $territorylist[$terr->getPrimaryKey()] = $str;
                }

                $territorylist["all"] = "0";


                $classification = \entities\ClassificationQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()
                    ->toKeyValue("Id", "Classification");

                $classification["all"] = "0";

                $f = FormMgr::form();
                $f->add([
                    "outletType" => FormMgr::select()->label("Outlet Type : ")->options($outletType),
                    "territories" => FormMgr::select()->label("Territories : ")->options($territorylist),
                    "classification" => FormMgr::select()->label("Classification : ")->options($classification),
                    "outletStatus" => FormMgr::select()->label("Status : ")->options($this->getConfig("Outlets", "OutletStatus")),
                ]);
                $this->data['filters'] = $f->html();


                $this->data['cols'] = [
                    "Code" => "OutletCode",
                    "Classification" => "Classification",
                    "Territories" => "TerritoryName",
                    "Outlet Name" => "OutletName",
                    "OutletCity" => "OutletCity",
                    "OutletState" => "OutletState",
                    "Address" => "OutletAddress",
                    "Zip" => "OutletPincode",
                    "ContactNo" => "Outlet_contact_no",
                    "LandLine" => "OutletLandlineno",
                    "Primary Source" => "PrimaryOutlet",
                    "BeatName" => "BeatName",
                    "SalesExec" => "FirstName",
                    "CreatedAt" => "CreatedAt",
                    "OutletStatus" => "OutletStatus",
                    "ReportingTo" => "ReportingTo"

                ];

                $this->data['reportname'] = "OutletReport";
                $this->data['title'] = "Outlet Report";
                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "result":

                $outletType = $this->app->Request()->getParameter("outletType");
                $territories = $this->app->Request()->getParameter("territories");
                $classification = $this->app->Request()->getParameter("classification");
                $outletStatus = $this->app->Request()->getParameter("outletStatus");

                $emps = EmployeeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByPositionId(0, Criteria::GREATER_EQUAL)
                    ->find()->toKeyIndex("PositionId");

                $outlets = OutletViewQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutlettypeId($outletType)
                    ->filterByOutletStatus($outletStatus);


                if ($territories != "all") {
                    $outlets->filterByTerritoryId($territories);
                }
                if ($classification != "all") {
                    $outlets->filterByOutletClassification($classification);
                }

                $outletList = $outlets->find()->toArray();

                $result = [];

                foreach ($outletList as $outlets) {
                    $idx = $outlets['OutletCode'] . $outlets['BeatName'];

                    if (isset($result[$idx])) {
                        $result[$idx]["PrimaryOutlet"] = $result[$idx]["PrimaryOutlet"] . ", " . $outlets["PrimaryOutlet"];
                    } else {
                        if (isset($emps[$outlets["ReportingTo"]])) {
                            $empRec = $emps[$outlets["ReportingTo"]];

                            $outlets["ReportingTo"] = $empRec->getFirstName() . " " . $empRec->getLastName() . " | " . $empRec->getEmployeeCode();
                        }
                        $result[$idx] = $outlets;
                    }
                }


                //$result = $outletList;

                $this->json(["aaData" => array_values($result)]);
                break;
            default:
                $this->json(["aaData" => []]);
                break;
        endswitch;
    }

    public function AttendenceReport()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['reportname'] = "AttedenceReport";
        $this->data['title'] = "Attendance Report";

        switch ($action):
            case "":


                $employees = \entities\EmployeeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("EmployeeId", "FirstName");
                $territories = TerritoriesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("TerritoryId", "TerritoryName");
                $f = FormMgr::form();
                $f->add([
                    "date" => FormMgr::date()->label("Date")->required(),
                    "agendacontroltype" => FormMgr::text()->label("Agenda Control Type"),
                    "employee_code" => FormMgr::text()->label("Employee Code"),
                    "first_name" => FormMgr::text()->label("First Name"),
                    "outlet_name" => FormMgr::text()->label("Outlet Name"),
                    "outlet_code" => FormMgr::text()->label("Outlet Code"),
                    "agenda_name" => FormMgr::text()->label("Agenda Name"),
                    "position_name" => FormMgr::text()->label("Position Name"),
                    "town_name" => FormMgr::text()->label("Town Name"),
                    "dcr_date" => FormMgr::date()->label("DCR Date"),
                    "dcr_status" => FormMgr::text()->label("DCR Status"),
                    "unit_name" => FormMgr::text()->label("Unit Name"),
                    "sgpi_out" => FormMgr::text()->label("Sgpi Out"),
                    "ed_duration" => FormMgr::text()->label("ED Duration"),
                    "employee" => FormMgr::select()->options($employees)->label("Employee"),
                    "territory" => FormMgr::select()->options($territories)->label("Territory"),
                ]);


                $this->data['filters'] = $f->html();


                $this->data['cols'] = [
                    "DcrId" => "DcrId",
                    "Agendacontroltype" => "Agendacontroltype",
                    "EmployeeCode" => "EmployeeCode",
                    "FirstName" => "FirstName",
                    "OutletName" => "OutletName",
                    "OutletCode" => "OutletCode",
                    "Agendname" => "Agendname",
                    "PositionName" => "PositionName",
                    "Stownname" => "Stownname",
                    "DcrDate" => "DcrDate",
                    "DcrStatus" => "DcrStatus",
                    "Planned" => "Planned",
                    "UnitName" => "UnitName",
                    "Managers" => "Managers",
                    "BrandsDetailed" => "BrandsDetailed",
                    "SgpiOut" => "SgpiOut",
                    "PobTotal" => "PobTotal",
                    "EmployeeId" => "EmployeeId",
                    "EdDuration" => "EdDuration",
                    "TerritoryId" => "TerritoryId",
                ];

                $this->data['Download'] = true;
                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "result":


                $date = $this->app->Request()->getParameter("date");
                $agenda = $this->app->Request()->getParameter("agendacontroltype");
                $employeeCode = $this->app->Request()->getParameter("employee_code");
                $firstName = $this->app->Request()->getParameter("first_name");
                $outletName = $this->app->Request()->getParameter("outlet_name");
                $outletCode = $this->app->Request()->getParameter("outlet_code");
                $agendaName = $this->app->Request()->getParameter("agenda_name");
                $positionName = $this->app->Request()->getParameter("position_name");
                $townName = $this->app->Request()->getParameter("town_name");
                $dcrDate = $this->app->Request()->getParameter("dcr_date");
                $dcrStatus = $this->app->Request()->getParameter("dcr_status");
                $unitName = $this->app->Request()->getParameter("unit_name");
                $sgpiOut = $this->app->Request()->getParameter("sgpi_out");
                $employee = $this->app->Request()->getParameter("employee");
                $territory = $this->app->Request()->getParameter("territory");
                $edDuration = $this->app->Request()->getParameter("ed_duration");

                $darview = DarViewQuery::create();

                if ($date != null) {
                    $darview->filterByCreatedAt($date, Criteria::EQUAL);
                }

                if ($agenda != null) {
                    $darview->filterByAgendacontroltype($agenda);
                }
                if ($edDuration != null) {
                    $darview->filterByEdDuration($edDuration);
                }

                if ($employeeCode != null) {
                    $darview->filterByEmployeeCode($employeeCode);
                }

                if ($firstName != null) {
                    $darview->filterByFirstName($firstName);
                }

                if ($outletName != null) {
                    $darview->filterByOutletName($outletName);
                }

                if ($outletCode != null) {
                    $darview->filterByOutletName($outletCode);
                }

                if ($agendaName != null) {
                    $darview->filterByAgendname($agendaName);
                }

                if ($positionName != null) {
                    $darview->filterByPositionName($positionName);
                }

                if ($townName != null) {
                    $darview->filterByStownname($townName);
                }

                if ($dcrDate != null) {
                    $darview->filterByDcrDate($dcrDate, Criteria::EQUAL);
                }

                if ($dcrStatus != null) {
                    $darview->filterByDcrStatus($dcrStatus);
                }

                if ($unitName != null) {
                    $darview->filterByUnitName($unitName);
                }

                if ($sgpiOut != null) {
                    $darview->filterBySgpiOut($sgpiOut);
                }

                if ($employee != null) {
                    $darview->filterByEmployeeId($employee);
                }

                if ($territory != null) {
                    $darview->filterByTerritoryId($territory);
                }

                $darview = $darview->find()->toArray();


                /*$agendaTypes = AgendatypesQuery::create()
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->find()->toKeyValue("Agendaid","Agendacontroltype");

                $territory = TerritoriesQuery::create()
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->find()->toKeyValue("TerritoryId","TerritoryName");

                $employees = EmployeeQuery::create()
                            ->joinWithDesignations()
                            //->joinWithTerritoriesRelatedByTerritoryId()
                            ->select(['EmployeeId','FirstName','LastName','EmployeeCode','TerritoryId','DesignationId','Designations.Designation'])
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByTerritoryId(null,Criteria::NOT_EQUAL)
                            ->find()->toArray();

                $emplist = [];

                foreach($employees as $emp)
                {
                    $terrName = "";
                    if(isset($territory[$emp['TerritoryId']]))
                    {
                        $terrName = $territory[$emp['TerritoryId']];
                    }

                    $emplist[$emp['EmployeeId']]
                     = array_merge($emp,["TerritoryName" => $terrName]);

                }
                unset($employees);

                $attendence = AttendanceQuery::create()
                                ->joinWithEmployee()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByAttendanceDate($Date,Criteria::EQUAL)
                                ->find();

                $result = [];

                foreach($attendence as $att)
                {
                    $shiftHours = 0;
                    if($att['ShiftMins'] > 0)
                    {
                        $shiftHours = floor($att['ShiftMins']/60);
                    }

                    $index = $att['EmployeeId']."|".strtotime(date("d-M-Y",strtotime($att['AttendanceDate'])));
                    if(!isset($result[$index])) {


                        if(!isset($emplist[$att['EmployeeId']]))
                        {
                            continue;
                        }
                        $emprec = $emplist[$att['EmployeeId']];

                        $result[$index] = [
                            "Territory" => $emprec['TerritoryName'],
                            "Designation" => $emprec["Designations.Designation"],
                            "Name" => $emprec['FirstName']." ".$emprec['LastName'],
                            "Code" => $emprec['EmployeeCode'],
                            "Agenda" => (isset($agendaTypes[$att['AgendaId']]) ? $agendaTypes[$att['AgendaId']] : ""),
                            "Date" => date("d-M-Y",strtotime($att['AttendanceDate'])),
                            "InTime" => date("H:m a",strtotime($att['StartTime'])),
                            "OutTime" => ($att['EndTime'] != null ? date("H:m a",strtotime($att['EndTime']))  : ""),
                            "Status" => ($att['Status'] == 1 ? "Punched out" : "Punched-In"),
                            "ShiftTime" =>  $shiftHours,
                            "BeatId" => "",
                            "BeatNames" => "",
                            "BeatOutlets"  => 0,
                            "Visits" => 0,
                            "Orders" => 0,
                            "Outlets"=>0,
                            "Total"=>0,
                            "Open"=>0,
                            "Confirmed"=>0,
                            "Cancelled"=>0,
                        ];

                        unset($emplist[$att['EmployeeId']]);

                    }
                    else
                    {
                        $result[$index]["Agenda"] .= ",".(isset($agendaTypes[$att['AgendaId']]) ? $agendaTypes[$att['AgendaId']] : "");
                        $result[$index]["InTime"] .= ",".date("H:m a",strtotime($att['StartTime']));
                        $result[$index]["OutTime"] .= ",".($att['EndTime'] != null ? date("H:m a",strtotime($att['EndTime']))  : "");
                        $result[$index]["Status"] .= ",".($att['Status'] == 1 ? "Punched out" : "Punched-In");
                        $result[$index]["ShiftTime"] += $shiftHours;

                    }

                }

                unset($emplist);
                unset($attendence);

                $AllBeats = BeatsQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->find()
                ->toKeyValue("BeatId","BeatName");

                $BeatOutlets = BeatOutletsQuery::create()
                            ->withColumn('COUNT(*)', 'Count')
                            ->select(array('BeatId','Count'))
                            ->groupByBeatId()
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->orderByCount()->find()->toKeyValue('BeatId',"Count");

                $checkins = OutletCheckinQuery::create()
                                    ->filterByCheckinDate($Date,Criteria::EQUAL)
                                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                                    ->find();

                    foreach($checkins as $ch)
                    {
                        //echo $ch->getEmpId()."|".strtotime($ch->getCheckinDate()->format("d-M-Y")); exit;
                        $index = $ch->getEmpId()."|".strtotime($ch->getCheckinDate()->format("d-M-Y"));

                        if(isset($result[$index]))
                        {

                            if( $ch->getBeatId() != null && !str_contains($result[$index]["BeatId"],$ch->getBeatId()."")) {

                                $result[$index]["BeatId"] .= $ch->getBeatId().",";
                                $result[$index]["BeatNames"] .= $AllBeats[$ch->getBeatId()].",";
                                $result[$index]["BeatOutlets"] += $BeatOutlets[$ch->getBeatId()];

                            }

                            $result[$index]["Visits"] +=1;

                        }

                    }
                    unset($checkins);
                    unset($AllBeats);
                    unset($BeatOutlets);

                    $orders = OrdersQuery::create()
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->filterByOrderDate($Date,Criteria::EQUAL)
                                ->find();
                    $outletCache = [];
                    foreach($orders as $ord)
                        {

                            $unique = 0;
                            $uniqueOutletKey = $ord->getEmployeeId()."|".$ord->getOutletFrom();
                            if(!in_array($uniqueOutletKey,$outletCache))
                            {
                                array_push($outletCache,$uniqueOutletKey);
                                $unique = 1;
                            }
                            $index = $ord->getEmployeeId()."|".strtotime($ord->getOrderDate()->format("d-M-Y"));

                            if(isset($result[$index]))
                            {
                                $result[$index]["Orders"] += 1;
                                $result[$index]["Total"] += floor($ord->getOrderTotal()*1);
                                $result[$index]["Outlets"] +=$unique;


                                if($ord->getOrderStatus() == "Completed")
                                {
                                    $result[$index]["Confirmed"] += 1;
                                }
                                elseif($ord->getOrderStatus() == "Cancelled")
                                {
                                    $result[$index]["Cancelled"] += 1;
                                }
                                else
                                {
                                    $result[$index]["Open"] += 1;
                                }

                            }
                    }
                // Garbage Collection.
                unset($orders);
                unset($outletCache);

                if($this->app->Request()->getParameter("download",false))
                {
                    $this->download_array_csv(array_values($result),"Attendence_".$Date.".csv");
                    exit;
                }*/


                $this->json(["aaData" => $darview]);
                break;
            default:
                $this->json(["aaData" => []]);
                break;
        endswitch;
    }


    public function DarReport()
    {
        $action = $this->app->Request()->getParameter("action");

        $this->data['Title'] = 'Daily Activity Report';
        $date = $this->app->Request()->getParameter("date", date('Y-m-d'));
        $employeeId = $this->app->Request()->getParameter("employee_id");

        if ($employeeId == null) {
            $this->data['errorMsg'] = 'Employee not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }

        if ($date == null) {
            $this->data['errorMsg'] = 'Date not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }

        $this->data['date'] = date('d-m-Y', strtotime($date));
        $this->data['employee'] = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithOrgUnit()
            ->joinWithPositionsRelatedByReportingTo()
            ->joinWithGeoTowns()
            ->filterByEmployeeId((int)$employeeId)
            ->findOne();
        if ($this->data['employee'] == null && empty($this->data['employee'])) {
            $this->data['errorMsg'] = 'Employee not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }

        // if ($this->data['employee']["PositionsRelatedByReportingTo"] == null && empty($this->data['employee']["PositionsRelatedByReportingTo"])) {
        //     $this->data['errorMsg'] = 'Reporting not found!';
        //     return $this->app->Renderer()->render("error.twig", $this->data);
        // }

        // if ($this->data['employee']["PositionsRelatedByReportingTo"]["PositionId"] == null && empty($this->data['employee']["PositionsRelatedByReportingTo"]["PositionId"])) {
        //     $this->data['errorMsg'] = 'Reporting position not found!';
        //     return $this->app->Renderer()->render("error.twig", $this->data);
        // }

        $this->data['employeeManager'] = \entities\EmployeeQuery::create()
            ->filterByPositionId($this->data['employee']["PositionsRelatedByReportingTo"]["PositionId"])
            ->findOne();
        if ($this->data['employeeManager'] == null && empty($this->data['employeeManager'])) {
            $this->data['employeeManagerName'] = 'Vacant';
        } else {
            $this->data['employeeManagerName'] = $this->data['employeeManager']->getFirstName() . ' ' . $this->data['employeeManager']->getLastName();
        }






        switch ($action):
            case "":
                $darview = \entities\DarViewQuery::create()
                    ->filterByDcrDate($date)
                    ->filterByPositionId($this->data['employee']['PositionId'])
                    ->limit(250)
                    ->find()->toArray();
                break;
            case "download":
                $darview = \entities\DarViewQuery::create()
                    ->filterByDcrDate($date)
                    ->filterByPositionId($this->data['employee']['PositionId'])
                    ->find()->toArray();
                break;
        endswitch;

        if (empty($darview)) {
            $this->data['errorMsg'] = 'Employee daily activities not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }

        $dayPlanned = \entities\DayplanQuery::create()
            ->select(['GeoTowns.Stownname'])
            ->leftJoinWithGeoTowns()
            ->filterByPositionId($this->data['employee']["PositionId"])
            ->filterByTpDate($date)
            ->groupByItownid()
            ->find()->toArray();
        if (empty($dayPlanned)) {
            $this->data['errorMsg'] = 'Employee day plan not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }

        $this->data['dayplan'] = implode(",", $dayPlanned);
        $this->data['day'] = date('l', strtotime($date));

        $this->data['darData'] = array();
        foreach ($darview as $data) {
            $brandArray = array();
            if (isset($data["BrandsDetailed"])) {
                $brandIds = explode(',', $data["BrandsDetailed"]);
                foreach ($brandIds as $brandId) {
                    if ($brandId != null && $brandId != '') {
                        $brand = \entities\EdPresentationsQuery::create()
                            ->filterByPresentationId($brandId)
                            ->findOne();
                        if ($brand != null && $brand->getPresentationName() != null) {
                            array_push($brandArray, $brand->getPresentationName());
                        }
                    }
                }
            }
            $outConPo = \entities\OutletContributionPotentialQuery::create()
                ->filterByOutletId($data['OutletId'])
                ->filterByRcpaMoye(date('m-Y', strtotime($date)))
                ->findOne();
            if ($data['DcrId'] != null) {
                $dcsgpi = \entities\DailycallsSgpioutQuery::create()
                    ->filterByDailycallId($data['DcrId'])
                    ->findOne();

                if ($dcsgpi != null) {
                    $beat = \entities\BeatOutletsQuery::create()
                        ->joinWithBeats()
                        ->filterByBeatOrgOutlet($dcsgpi->getOutletOrgdataId())
                        ->findOne();

                    $beatName = $beat->getBeats()->getBeatName();
                } else {
                    $beatName = '-';
                }
            } else {
                $beatName = '-';
            }

            $brandNameArray = implode(',', $brandArray);
            if (isset($outConPo) != null && $outConPo->getPotential() != null && $outConPo->getContribution() != null) {
                $outletPotential = $outConPo->getPotential();
                $outletContribution = $outConPo->getContribution();
            } else {
                $outletPotential = 0;
                $outletContribution = 0;
            }
            if (!empty($data['Stownname'])) {
                $townName = $data['Stownname'];
            } else {
                $townName = '-';
            }

            // $dc = \entities\DailycallsQuery::create()
            //     ->filterByDcrId($data['DcrId'])
            //     ->findOne();
            // if ($dc != null) {
            //     if ($dc->getIsjw() == true) {
            //         $joint = 'Yes';
            //     } else {
            //         $joint = 'No';
            //     }
            // }

            if ($data['Managers'] == null || $data['Managers'] == '') {
                $joint = 'No';
            } else {
                $joint = 'Yes';
            }

            if ($data["BrandsDetailed"] != null && $data["BrandsDetailed"] != '') {
                $edetailing = 'Yes';
            } else {
                $edetailing = 'No';
            }
            if ($data["SgpiOut"] != null && $data["SgpiOut"] != '') {
                $sgpi = 'Yes';
            } else {
                $sgpi = 'No';
            }


            $dataArray = array(
                "Stownname" => $townName . ' / ' . $beatName,
                "OutletName" => $data['OutletName'],
                "Tags" => $data['Tags'],
                "Agenda" => $data['Agendacontroltype'] . ' / ' . $data['Agendname'],
                "JointWorking" => $joint,
                "Planned" => $data['Planned'],
                "CreatedAt" => date('d-m-Y H:i', strtotime($data['CreatedAt'])),
                "SgpiOut" => $data['SgpiOut'],
                "Brands" => $brandNameArray,
                "PobTotal" => $data['PobTotal'],
                "Potential" => $outletPotential,
                "Contribution" => $outletContribution,
                "Edetailing" => $edetailing,
                "Sgpi" => $sgpi,
            );
            array_push($this->data['darData'], $dataArray);
        }
        if (count($this->data['darData']) > 0) {
            switch ($action):
                case "":
                    $this->app->Renderer()->render("reports/DarView.twig", $this->data);
                    break;
                case "download":
                    $objPHPExcel = new Spreadsheet();
                    $objPHPExcel->getActiveSheet();


                    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Location/Account');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer Details');
                    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Tags');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Agenda');
                    $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Joint Working');
                    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Planned');
                    $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Sync Date/Time');
                    $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Input');
                    $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Brands detailed');
                    $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'POB Value');
                    $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'RCPA Potential');
                    $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'RCPA Contribution');
                    $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'E-Detailing');
                    $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'SGPI');

                    $objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);

                    $rowCount = 2;
                    $counter = 1;
                    foreach ($this->data['darData'] as $data) {
                        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter);
                        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data["Stownname"]);
                        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['OutletName']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["Tags"]);
                        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['Agenda']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['JointWorking']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["Planned"]);
                        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['CreatedAt']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['SgpiOut']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["Brands"]);
                        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['PobTotal']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Potential']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data["Contribution"]);
                        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['Edetailing']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['Sgpi']);
                        $rowCount++;
                        $counter++;
                    }

                    // $writer = new Xlsx($objPHPExcel);
                    // header('Content-Type: application/vnd.ms-excel');
                    // header('Content-Disposition: attachment;filename="DarReport.xlsx"');
                    // header('Cache-Control: max-age=0');
                    // $writer->save('php://output');

                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="DarReport.xlsx"');
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output');
                    break;
            endswitch;
        } else {
            $this->data['errorMsg'] = 'Daily activities data not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }
    }

    public function MasReport()
    {

        $action = $this->app->Request()->getParameter("action");


        $this->data['Title'] = 'Monthly Activity Summary Report';

        $month = $this->app->Request()->getParameter("month");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);

        $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

        $employeePositionCode = \entities\PositionsQuery::create()
            ->select(['PositionCode'])
            ->filterByPositionId($positionArray)
            ->find()->toArray();




        switch ($action):
            case "":
                $masReport = \entities\WriteMasQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode)
                    ->filterByMonthYear($month)
                    ->limit(250)
                    ->find()->toArray();
                break;
            case "download":
                $masReport = \entities\WriteMasQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode)
                    ->filterByMonthYear($month)
                    ->find()->toArray();
                break;
        endswitch;

        // if (empty($employee) || empty($month)) {
        //     $this->data['errorMsg'] = 'Employee and Month not found!';
        //     return $this->app->Renderer()->render("error.twig", $this->data);
        // }

        // $monthNumber = explode('-', $month);
        // $dt = \DateTime::createFromFormat('m', $monthNumber[0]);
        // $startDate = $dt->format('Y-m-1');
        // $endDate = $dt->format('Y-m-t');

        // $empData = array();
        // if (!empty($emp_position_ids)) {
        //     foreach ($emp_position_ids as $emp_position_id) {
        //         $employee = \entities\EmployeeQuery::create()
        //             ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //             ->leftJoinWithGeoTowns()
        //             ->joinWithOrgUnit()
        //             ->leftJoinWithBranch()
        //             ->filterByPositionId((int)$emp_position_id)
        //             ->find()->toArray();

        //         $townName = isset($employee[0]['GeoTowns']['Stownname']) ? $employee[0]['GeoTowns']['Stownname'] : '';

        //         // Need to check if no employee with that position id
        //         if (empty($employee)) {
        //             continue;
        //         }

        //         $position = \entities\PositionsQuery::create()->findPk($emp_position_id);
        //         $managers = $position->getCavPositionsUp();

        //         if ($managers != null) {
        //             $managerPositionIds = explode(",", $managers);
        //         } else {
        //             $managerPositionIds = null;
        //         }

        //         if ($managerPositionIds != null) {
        //             $employees = \entities\EmployeeQuery::create()
        //                 ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //                 ->leftJoinWithGeoTowns()
        //                 ->leftJoinWithPositionsRelatedByPositionId()
        //                 ->filterByPositionId($managerPositionIds)
        //                 ->find()->toArray();
        //         }


        //         if (isset($employees[2])) {
        //             $level1Employee = $employees[2]["PositionsRelatedByPositionId"]["PositionName"];
        //         } else {
        //             $level1Employee = $townName;
        //         }

        //         if (isset($employees[1])) {
        //             $level2Employee = $employees[1]["PositionsRelatedByPositionId"]["PositionName"];
        //         } else {
        //             $level2Employee = $townName;
        //         }
        //         if (isset($employees[0])) {
        //             $level3Employee = $employees[0]["PositionsRelatedByPositionId"]["PositionName"];
        //         } else {
        //             $level3Employee = $townName;
        //         }
        //         $level3 = isset($level3Employee) ? $level3Employee : null;
        //         $level2 = isset($level2Employee) ? $level2Employee : null;
        //         $level1 = isset($level1Employee) ? $level1Employee : null;

        //         $territories = \entities\PositionsQuery::create()
        //             ->filterByPositionId($employee[0]['PositionId'])
        //             ->findOne();
        //         if ($territories != null && $territories->getCavTerritories() != null) {
        //             $terExplode = explode(',', $territories->getCavTerritories());
        //         } else {
        //             $this->data['errorMsg'] = 'Territories not found!';
        //             return $this->app->Renderer()->render("error.twig", $this->data);
        //         }

        //         // FWD Calculation
        //         $date = date((int)$monthNumber[1] . '-' . (int)$monthNumber[0] . '-01'); //Current Month Year
        //         $daysinMonth = cal_days_in_month(CAL_GREGORIAN, (int)$monthNumber[0], (int)$monthNumber[1]);
        //         $sunday = 0;
        //         for ($i = 0; $i < $daysinMonth; $i++) {
        //             $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));
        //             $currentDate = DateTime::createFromFormat("Y-m-d", $day);
        //             if ($currentDate->format("N") == 7) // Sunday
        //             {
        //                 $sunday += 1;
        //             }
        //         }
        //         $holidays = \entities\HolidaysQuery::create()
        //             ->select(['HolidayDate'])
        //             ->filterByIstateid($employee[0]["Branch"]["Istateid"])
        //             ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
        //             ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
        //             ->find()->count();
        //         // $fwd = $daysinMonth - ($sunday + $holidays);

        //         // NCA Calculation
        //         $dailyCalls = \entities\DailycallsQuery::create()
        //             ->select(['DcrDate'])
        //             ->filterByPositionId($employee[0]["PositionId"])
        //             ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
        //             ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
        //             ->filterByAgendacontroltype('NCA')
        //             ->groupByDcrDate()
        //             ->find()->toArray();
        //         $nca = 0;
        //         foreach ($dailyCalls as $dailyCall) {
        //             $dailycalls = \entities\DailycallsQuery::create()
        //                 ->select(['DcrDate'])
        //                 ->filterByPositionId($employee[0]["PositionId"])
        //                 ->filterByDcrDate($dailyCall)
        //                 ->filterByAgendacontroltype('FW')
        //                 ->groupByDcrDate()
        //                 ->find()->count();

        //             if ($dailycalls > 0) {
        //                 $nca += 0.5;
        //             }
        //         }

        //         // Leave Calculation
        //         $leaves = \entities\LeaveRequestQuery::create()
        //             ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //             ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //             ->filterByEmployeeId($employee[0]['EmployeeId'])
        //             ->filterByLeaveStatus(2)
        //             ->find()->count();

        //         $dailyCallsFW = \entities\DailycallsQuery::create()
        //             ->select(['DcrDate'])
        //             ->filterByPositionId($employee[0]["PositionId"])
        //             ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
        //             ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
        //             ->filterByAgendacontroltype('FW')
        //             ->groupByDcrDate()
        //             ->find()->count();

        //         //$workingDays = $fwd - $nca - $leaves;
        //         $fwd = $dailyCallsFW - ($nca + $leaves); // this logic changes by Ayush 23-08-2023
        //         $workingDays = $daysinMonth - ($sunday + $holidays); // this logic changes by Ayush 23-08-2023

        //         // Total DR
        //         $totalDr = \entities\OutletViewQuery::create()
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByOutlettypeName('Doctor')
        //             ->find()->count();

        //         // Total DR MET
        //         $drMet = \entities\OutletVisitsViewQuery::create()
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByMoye($month)
        //             ->filterByOutlettypeName('Doctor')
        //             ->groupByOutletOrgDataId()
        //             ->find()->count();

        //         // Total DR MET As Per VF
        //         $drMetasperVF = \entities\OutletVisitsViewQuery::create()
        //             ->select(['Vfcovered'])
        //             ->withColumn('sum(vfcovered)', 'Vfcovered')
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByMoye($month)
        //             ->filterByOutlettypeName('Doctor')
        //             ->filterByVfcovered(1)
        //             ->find()->toArray();

        //         $drAsperVF = \entities\OutletVisitsViewQuery::create()
        //             ->select(['VisitFq'])
        //             ->withColumn('sum(visit_fq)', 'VisitFq')
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByMoye($month)
        //             ->filterByOutlettypeName('Doctor')
        //             ->find()->toArray();

        //         $drcaL = 0;
        //         $DRCALVisit = \entities\OutletVisitsViewQuery::create()
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByMoye($month)
        //             ->filterByOutlettypeName('Doctor')
        //             ->find();
        //         foreach ($DRCALVisit as $DRCA) {
        //             $drcaL += $DRCA->getVisits();
        //         }

        //         $drChemist = \entities\OutletVisitsViewQuery::create()
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByMoye($month)
        //             ->filterByOutlettypeName('Pharmacy')
        //             ->find()->count();
        //         $pobValue = \entities\OrdersQuery::create()
        //             ->select(['PobValue'])
        //             ->withColumn('sum(order_total)', 'PobValue')
        //             ->filterByEmployeeId($employee[0]['EmployeeId'])
        //             ->filterByOrderDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //             ->filterByOrderDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //             ->find()->toArray();
        //         $rcpaSummary = \entities\RcpaSummaryQuery::create()
        //             ->select(['RcpaOwn', 'RcpaCompetition'])
        //             ->withColumn('sum(own)', 'RcpaOwn')
        //             ->withColumn('sum(competition)', 'RcpaCompetition')
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByRcpaMoye($month)
        //             ->find()->toArray();
        //         $jwDailyCalls = \entities\DailycallsQuery::create()
        //             ->filterByPositionId($employee[0]['PositionId'])
        //             ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //             ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //             ->filterByManagers(null, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
        //             ->filterByManagers('', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
        //             ->find()->count();
        //         $jointWorking = \entities\DailycallsQuery::create()
        //             ->select(['Manager'])
        //             ->withColumn('count(managers)', 'Manager')
        //             ->filterByPositionId($employee[0]['PositionId'])
        //             ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //             ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //             ->filterByManagers(null, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
        //             ->filterByManagers('', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
        //             ->groupByDcrDate()
        //             ->find()->count();
        //         // $noOfDrCalls = \entities\DailycallsQuery::create()
        //         //     ->leftJoinWithOutletOrgData()
        //         //     ->filterByPositionId($employee[0]['PositionId'])
        //         //     ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //         //     ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //         //     ->find()->count();

        //         $dailyCallsAgenda = \entities\DailycallsQuery::create()
        //             ->select(['AgendaId'])
        //             ->filterByPositionId($employee[0]['PositionId'])
        //             ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //             ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //             ->filterByAgendacontroltype('FW', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
        //             ->find()->toArray();

        //         $agendatypes = \entities\AgendatypesQuery::create()
        //             ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
        //             ->filterByOrgunitid($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
        //             ->filterByAgendacontroltype('NCA')
        //             ->find()->toArray();

        //         $AgendaArray = array();
        //         foreach ($agendatypes as $agendatype) {
        //             if (!array_key_exists($agendatype["Agendaid"], $AgendaArray)) {
        //                 $AgendaArray[$agendatype["Agendaid"]] = 0;
        //             }
        //             $agendaTypeId = $agendatype["Agendaid"];
        //             if ($agendaTypeId) {
        //                 foreach ($dailyCallsAgenda as $dailyCallsAge) {
        //                     if ($agendaTypeId == $dailyCallsAge) {
        //                         $AgendaArray[$agendatype["Agendaid"]] += 0.5;
        //                     }
        //                 }
        //             }
        //         }


        //         $missedDrCall = $drAsperVF[0] - $drcaL;
        //         if ($missedDrCall < 0) {
        //             $missedDrCalls = 0;
        //         } else {
        //             $missedDrCalls = $missedDrCall;
        //         }

        //         if ($drcaL > 0 && $fwd > 0) {
        //             $drcalPercentage = round($drcaL / $fwd, 2);
        //         } else {
        //             $drcalPercentage = 0;
        //         }
        //         if ($drMet > 0 && $totalDr > 0) {
        //             $drcvrgPercentage = round($drMet / $totalDr * 100, 2);
        //         } else {
        //             $drcvrgPercentage = 0;
        //         }
        //         if ($drMetasperVF[0] > 0 && $totalDr > 0) {
        //             $drvfcvrgPercentage = round($drMetasperVF[0] / $totalDr * 100, 2);
        //         } else {
        //             $drvfcvrgPercentage = 0;
        //         }

        //         $data = [
        //             "OrgName" => $employee[0]['OrgUnit']["UnitName"],
        //             "REPCODE" => $employee[0]['EmployeeId'],
        //             "EmployeeCode" => $employee[0]['EmployeeCode'],
        //             "EmployeeName" => $employee[0]['FirstName'] . ' ' . $employee[0]['LastName'],
        //             "Level3" => $level3,
        //             "Level2" => $level2,
        //             "Level1" => $level1,
        //             "Location" => $townName,
        //             "MonthYear" => $month,
        //             "WorkingDays" => $workingDays,
        //             "FWD" => $fwd,
        //             "NCA" => $nca,
        //             "TotalDoctors" => $totalDr,
        //             "DrMet" => $drMet,
        //             "DrVfMet" => $drMetasperVF[0],
        //             "DRCA-L" => $drcalPercentage,
        //             "DRCVRG%" => $drcvrgPercentage,
        //             "DRVFCVRG%" => $drvfcvrgPercentage,
        //             "MISSEDDR" => $totalDr - $drMet,
        //             "MISSEDDRCALLS" => $missedDrCalls,
        //             "TOTALCHEMIST" => $drChemist,
        //             "POBValue" => isset($pobValue[0]) ? $pobValue[0] : 0,
        //             "RCPAvalueforownbrand" => isset($rcpaSummary[0]['RcpaOwn']) ? $rcpaSummary[0]['RcpaOwn'] : 0,
        //             "RCPAvalueforCompbrand" => isset($rcpaSummary[0]['RcpaCompetition']) ? $rcpaSummary[0]['RcpaCompetition'] : 0,
        //             "JOINTWORKTotalCalls" => $jwDailyCalls,
        //             "LEAVEDAYS" => $leaves,
        //             "JoinWorking" => $jointWorking,
        //             "NoDrCall" => $drcaL,
        //             "Agenda" => $AgendaArray,
        //         ];
        //         array_push($empData, $data);
        //     }
        // }

        // $agendatypes = \entities\AgendatypesQuery::create()
        //     ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
        //     ->filterByOrgunitid($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
        //     ->filterByAgendacontroltype('NCA')
        //     ->find()->toKeyValue('Agendaid', 'Agendname');
        // $this->data['AgendaControlType'] = $agendatypes;
        $this->data['EmployeeData'] = $masReport;

        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/MasView.twig", $this->data);
                break;
            case "download":

                $objPHPExcel = new Spreadsheet();
                $objPHPExcel->getActiveSheet();


                $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'BU NAME');
                $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'REPCODE');
                $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'EMPLOYEE Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'USER');
                $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Zonal Manager');
                $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Regional Manager');
                $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Area Manager');
                $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'LOCATION');
                $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'MONTH/YEAR');
                $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'FWD');
                $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Working days');
                $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'NCA');
                $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'TOTAL DOCTORS');
                $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'DR MET');
                $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Dr Met as per VF');
                $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Dr call Avg');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'DR CVRG %');
                $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'DR VF CVRG %');
                $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Missed Dr');
                $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'MISSED DR CALLS');
                $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'TOTAL CHEMIST');
                $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'POB Value');
                $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'RCPA value for own brand');
                $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'RCPA value for Comp brand');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'JOINT WORK Total Calls');
                $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'LEAVE DAYS');
                $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Joint Working');
                $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'No. of Dr Calls');
                $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Agenda');
                $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'ZM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'RM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'AM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'Employee Status');
                $objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'Employee Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('AI1', 'Employee Position Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('AJ1', 'Employee Level');

                $objPHPExcel->getActiveSheet()->getStyle("A1:AJ1")->getFont()->setBold(true);

                $rowCount = 2;
                foreach ($masReport as $data) {
                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data["OrgUnitName"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data["RepCode"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['EmployeeCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["EmployeeName"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['AmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['RmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["ZmPosition"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['Location']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['MonthYear']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["Fwd"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['WorkingDays']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Nca']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data["TotalDoctors"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['DrMet']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['DrVfMet']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data['DrcaL']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data['Drcvrg']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['Drvfcvrg']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['MissedDr']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data['MissedDrCalls']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['TotalChemist']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['PobValue']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data['RcpaValueForOwnBrand']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['RcpaValueForCompBrand']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['JointWorkTotalCalls']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data['LeaveDays']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, $data['JointWorking']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $data['NoDrCall']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $data['Agenda']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, $data['ZmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $rowCount, $data['RmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowCount, $data['AmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $rowCount, $data['EmployeeStatus']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $rowCount, $data['EmployeePositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AI' . $rowCount, $data['EmployeePositionName']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AJ' . $rowCount, $data['EmployeeLevel']);

                    $rowCount++;
                }

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="MasReport.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                break;
        endswitch;
    }

    public function RcpaBaeReportOld()
    {
        $this->data['Title'] = 'RCPA Base Report';
        $emp = $this->app->Auth()->getUser()->getEmployee();
        $month = $this->app->Request()->getParameter("month");

        if (empty($emp) || empty($month)) {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $position = \entities\PositionsQuery::create()->findPk($emp->getPositionId());

        if (empty($position)) {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $managers = $position->getCavPositionsUp();
        $managerPositionIds = explode(",", $managers);

        if (!empty($managers) && !empty($managerPositionIds) && count($managerPositionIds) > 0) {
            $managerPositionArray = array();
            foreach ($managerPositionIds as $managerPositionId) {
                $manager = \entities\PositionsQuery::create()
                    ->filterByPositionId($managerPositionId)
                    ->findOne();
                if (isset($manager) && $manager->getPositionName() != null) {
                    array_push($managerPositionArray, $manager->getPositionName());
                }
            }
        } else {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $buName = $emp->getOrgUnit()->getUnitName();
        $level3 = isset($managerPositionArray[2]) ? $managerPositionArray[2] : null;
        $level2 = isset($managerPositionArray[1]) ? $managerPositionArray[1] : null;
        $level1 = isset($managerPositionArray[0]) ? $managerPositionArray[0] : null;
        $town = $emp->getGeoTowns()->getStownname();
        $empName = $emp->getFirstName() . ' ' . $emp->getLastName();
        $empCode = $emp->getEmployeeCode();
        $empRole = $this->app->Auth()->getUser()->getRoles()->getRoleName();
        $empDesignation = $emp->getDesignations()->getDesignation();
        $months = $month;
        $brandRcpa = \entities\BrandRcpaQuery::create()
            ->select(['BrcpaId', 'OutletId', 'RetailOutletId', 'BrandId', 'Brands.BrandName', 'Brands.BrandRate', 'RcpaQty'])
            ->withColumn('sum(rcpa_value)', 'RcpaQty')
            ->joinWithBrands()
            ->joinWithOutlets()
            ->filterByEmployeeId($emp->getEmployeeId())
            ->filterByRcpaMoye($month)
            ->groupByOutletId()
            ->groupByBrandId()
            ->find()->toArray();

        // if(count($brandRcpa) == 0){
        // return $this->app->Renderer()->render("404copy.twig");
        // }

        $result = array();
        $resultArr = array();
        foreach ($brandRcpa as $brandRc) {
            $retailerOutlet = \entities\OutletsQuery::create()
                ->filterById($brandRc["RetailOutletId"])
                ->findOne();
            if ($retailerOutlet != null) {
                $retailOutletName = $retailerOutlet->getOutletName();
                $retailOutletCode = $retailerOutlet->getOutletCode();
            }
            $retailOutletName = $retailerOutlet->getOutletName();
            $retailOutletCode = $retailerOutlet->getOutletCode();
            $outlet = \entities\OutletsQuery::create()
                ->joinWithClassification()
                ->filterById($brandRc["OutletId"])
                ->findOne();
            $speciality = $outlet->getClassification()->getClassification();
            $outletView = \entities\OutletViewQuery::create()
                ->filterByOutlet_Id($brandRc["OutletId"])
                ->findOne();
            $patch = $outletView->getBeatName();
            $rcpaSummaryView = \entities\RcpaSummaryQuery::create()
                ->filterByOutletId($brandRc["BrandId"])
                ->filterByOutletId($brandRc["OutletId"])
                ->findOne();
            if (isset($rcpaSummaryView) && $rcpaSummaryView->getPotential() != null) {
                $outletBrandPotential = $rcpaSummaryView->getPotential();
            } else {
                $outletBrandPotential = 0;
            }
            $ComBrandRcpa = \entities\BrandRcpaQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithBrands()
                ->filterByEmployeeId($emp->getEmployeeId())
                ->filterByRcpaMoye($month)
                ->filterByOutletId($brandRc["OutletId"])
                ->filterByBrandId($brandRc["BrandId"])
                ->find()->toArray();
            $ownQty = 0;
            $ownValue = 0;
            $compatitorIds = array();
            foreach ($ComBrandRcpa as $ComBrandRc) {
                if ($ComBrandRc["CompetitorId"] == 0) {
                    $ownQty += $ComBrandRc["RcpaValue"];
                    $ownValue += $ComBrandRc["RcpaValue"] * $ComBrandRc['Brands']['BrandRate'];
                } else {
                    array_push($compatitorIds, $ComBrandRc["CompetitorId"]);
                }
            }
            $ComData = array();
            $compatitorUniqueIds = array_unique($compatitorIds);
            foreach ($compatitorUniqueIds as $compatitorId) {
                $compatitorsBrandRcpa = \entities\BrandRcpaQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithBrands()
                    ->filterByEmployeeId($emp->getEmployeeId())
                    ->filterByRcpaMoye($month)
                    ->filterByOutletId($brandRc["OutletId"])
                    ->filterByBrandId($brandRc["BrandId"])
                    ->filterByCompetitorId($compatitorId)
                    ->find()->toArray();
                $compQty = 0;
                $compValue = 0;
                foreach ($compatitorsBrandRcpa as $compatitorsBrandRc) {
                    $compQty += $compatitorsBrandRc["RcpaValue"];
                    $compValue += round($compatitorsBrandRc["RcpaValue"] * $compatitorsBrandRc['Brands']['BrandRate'], 2);
                }
                $compa = \entities\BrandCompetitionQuery::create()
                    ->filterByCompetitorId($compatitorId)
                    ->findOne();
                $comdata = [
                    'ComId' => $compa->getCompetitorName(),
                    'Qty' => $compQty,
                    'Value' => $compValue,
                ];
                array_push($ComData, $comdata);
            }
            asort($ComData);
            $newArray = array_slice($ComData, 0, 4, true);
            $resultData = [
                "Id" => $brandRc["BrcpaId"],
                "Bu" => $buName,
                "Level3" => $level3,
                "Level2" => $level2,
                "Level1" => $level1,
                "Location" => $town,
                "EmployeeName" => $empName,
                "EmployeeCode" => $empCode,
                "Role" => $empRole,
                "Designation" => $empDesignation,
                "Month" => $months,
                "RetailerName" => $retailOutletName,
                "RetailerCode" => $retailOutletCode,
                "Speciality" => $speciality,
                "PatchName" => $patch,
                "DoctorName" => $outlet->getOutletName(),
                "DoctorCode" => $outlet->getOutletCode(),
                "Brand" => $brandRc["Brands.BrandName"],
                "RcpaQty" => $brandRc["RcpaQty"],
                "RcpaValue" => $brandRc["RcpaQty"] * $brandRc["Brands.BrandRate"],
                "OwnQty" => $ownQty,
                "Comp1Qty" => isset($newArray[0]["Qty"]) ? $newArray[0]["Qty"] : 0,
                "Comp2Qty" => isset($newArray[1]["Qty"]) ? $newArray[1]["Qty"] : 0,
                "Comp3Qty" => isset($newArray[2]["Qty"]) ? $newArray[2]["Qty"] : 0,
                "Comp4Qty" => isset($newArray[3]["Qty"]) ? $newArray[3]["Qty"] : 0,
                "Comp5Qty" => isset($newArray[4]["Qty"]) ? $newArray[4]["Qty"] : 0,
                "OwnValue" => $ownValue,
                "Comp1Value" => isset($newArray[0]["Value"]) ? $newArray[0]["Value"] : 0,
                "Comp2Value" => isset($newArray[1]["Value"]) ? $newArray[1]["Value"] : 0,
                "Comp3Value" => isset($newArray[2]["Value"]) ? $newArray[2]["Value"] : 0,
                "Comp4Value" => isset($newArray[3]["Value"]) ? $newArray[3]["Value"] : 0,
                "Comp5Value" => isset($newArray[4]["Value"]) ? $newArray[4]["Value"] : 0,
                "TotalPotential" => $outletBrandPotential,
            ];
            $comArr = [
                "Comp1" => isset($newArray[0]["ComId"]) ? $newArray[0]["ComId"] : "Comp1",
                "Comp2" => isset($newArray[1]["ComId"]) ? $newArray[1]["ComId"] : "Comp2",
                "Comp3" => isset($newArray[2]["ComId"]) ? $newArray[2]["ComId"] : "Comp3",
                "Comp4" => isset($newArray[3]["ComId"]) ? $newArray[3]["ComId"] : "Comp4",
                "Comp5" => isset($newArray[4]["ComId"]) ? $newArray[4]["ComId"] : "Comp5",
            ];
            array_push($result, $resultData);
            array_push($resultArr, $comArr);
        }
        $this->data['RcpaData'] = $result;
        if (isset($resultArr[0])) {
            $this->data['RcpaComData'] = $resultArr[0];
        } else {
            $this->data['RcpaComData'] = [
                "Comp1" => "Comp1",
                "Comp2" => "Comp2",
                "Comp3" => "Comp3",
                "Comp4" => "Comp4",
                "Comp5" => "Comp5",
            ];
        }

        return $this->app->Renderer()->render("reports/RcpaBaseView.twig", $this->data);
    }

    public function RcpaBaeReport()
    {
        $this->data['Title'] = 'RCPA Base Report';
        $emp = $this->app->Auth()->getUser()->getEmployee();
        $month = $this->app->Request()->getParameter("month");

        if (empty($emp) || empty($month)) {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $position = \entities\PositionsQuery::create()->findPk($emp->getPositionId());

        if (empty($position)) {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $managers = $position->getCavPositionsUp();
        $managerPositionIds = explode(",", $managers);

        if (!empty($managers) && !empty($managerPositionIds) && count($managerPositionIds) > 0) {
            $managerPositionArray = array();
            foreach ($managerPositionIds as $managerPositionId) {
                $manager = \entities\PositionsQuery::create()
                    ->filterByPositionId($managerPositionId)
                    ->findOne();
                if (isset($manager) && $manager->getPositionName() != null) {
                    array_push($managerPositionArray, $manager->getPositionName());
                }
            }
        } else {
            return $this->app->Renderer()->render("404copy.twig");
        }

        $buName = $emp->getOrgUnit()->getUnitName();
        $level3 = isset($managerPositionArray[2]) ? $managerPositionArray[2] : null;
        $level2 = isset($managerPositionArray[1]) ? $managerPositionArray[1] : null;
        $level1 = isset($managerPositionArray[0]) ? $managerPositionArray[0] : null;
        $town = $emp->getGeoTowns()->getStownname();
        $empName = $emp->getFirstName() . ' ' . $emp->getLastName();
        $empCode = $emp->getEmployeeCode();
        $empRole = $this->app->Auth()->getUser()->getRoles()->getRoleName();
        $empDesignation = $emp->getDesignations()->getDesignation();
        $result = $resultArr = [];

        $brandRcpaData = \entities\BrandRcpaQuery::create()
            ->select(['OutletId', 'RetailOutletId', 'CompetitorId', 'BrandId', 'BrandName', 'BrandRate', 'RcpaQty', 'ProductId', 'ProductName', 'ProductBasePrice', 'Classification', 'BeatName', 'OutletName', 'OutletCode', 'RetailerOutletName', 'RetailerOutletCode', 'CompetitorName'])
            ->withColumn('sum(brand_rcpa.rcpa_value)', 'RcpaQty')
            ->withColumn('products.product_name', 'ProductName')
            ->withColumn('products.base_price', 'ProductBasePrice')
            ->withColumn('brands.brand_name', 'BrandName')
            ->withColumn('brands.brand_rate', 'BrandRate')
            ->withColumn('outlet_view.classification', 'Classification')
            ->withColumn('outlet_view.beat_name', 'BeatName')
            ->withColumn('outlet_view.outlet_name', 'OutletName')
            ->withColumn('outlet_view.outlet_code', 'OutletCode')
            ->withColumn('outlets.outlet_name', 'RetailerOutletName')
            ->withColumn('outlet_org_data.outlet_org_code', 'RetailerOutletCode')
            ->withColumn('brand_competition.competitor_name', 'CompetitorName')
            ->addJoin('brand_rcpa.brand_id', 'brands.brand_id', Criteria::INNER_JOIN)
            ->addJoin('brand_rcpa.outlet_id', 'outlet_view.id', Criteria::INNER_JOIN)
            ->addJoin('brand_rcpa.product_id', 'products.id', Criteria::INNER_JOIN)
            ->addJoin('brand_rcpa.competitor_id', 'brand_competition.competitor_id', Criteria::LEFT_JOIN)
            ->addjoin('brand_rcpa.retail_outlet_id', 'outlets.id', Criteria::INNER_JOIN)
            ->addjoin('brand_rcpa.retail_outlet_id', 'outlet_org_data.outlet_id', Criteria::INNER_JOIN)
            ->where('outlet_view.org_unit_id = brands.orgunitid')
            ->where('outlet_org_data.org_unit_id = brands.orgunitid')
            ->filterByEmployeeId($emp->getEmployeeId())
            ->filterByRcpaMoye($month)
            ->groupByOutletId()
            ->groupByBrandId()
            ->groupByProductId()
            ->groupByCompetitorId()
            ->find()->toArray();

        $result = $totalPotential = $competitors = [];
        $totalQty = 0;
        foreach ($brandRcpaData as $data) {
            $key = $data['BrandId'] . '|' . $data['ProductId'] . '|' . $data['OutletId'] . '|' . $data['RetailOutletId'];
            $totalPotentialKey = $data['BrandId'] . '|' . $data['ProductId'] . '|' . $data['OutletId'];
            if (!isset($result[$key])) {
                $result[$key] = [
                    "Id" => $data["BrandId"],
                    "Bu" => $buName,
                    "Level3" => $level3,
                    "Level2" => $level2,
                    "Level1" => $level1,
                    "Location" => $town,
                    "EmployeeName" => $empName,
                    "EmployeeCode" => $empCode,
                    "Role" => $empRole,
                    "Designation" => $empDesignation,
                    "Month" => $month,
                    "RetailerName" => $data['RetailerOutletName'],
                    "RetailerCode" => $data['RetailerOutletCode'],
                    "Speciality" => $data['Classification'],
                    "PatchName" => $data['BeatName'],
                    "DoctorName" => $data['OutletName'],
                    "DoctorCode" => $data['OutletCode'],
                    "Brand" => $data['BrandName'],
                    "RcpaQty" => 0,
                    "RcpaValue" => 0,
                    "OwnQty" => 0,
                    "OwnValue" => 0,
                    "Comp1Qty" => 0,
                    "Comp2Qty" => 0,
                    "Comp3Qty" => 0,
                    "Comp4Qty" => 0,
                    "Comp5Qty" => 0,
                    "Comp1Value" => 0,
                    "Comp2Value" => 0,
                    "Comp3Value" => 0,
                    "Comp4Value" => 0,
                    "Comp5Value" => 0,
                    "TotalPotential" => 0,
                    "TotalPotentialKey" => $totalPotentialKey,
                    "CompetitorData" => []
                ];
            }

            $compQty = $data["RcpaQty"];
            $compValue = $compQty * $data['ProductBasePrice'];

            if ($data['CompetitorId'] > 0) {
                $CompetitorData = $result[$key]["CompetitorData"];
                if (!isset($CompetitorData[$data['CompetitorId']])) {
                    $CompetitorData[$data['CompetitorId']] = [
                        'Name' => $data['CompetitorName'],
                        'Qty' => 0,
                        'Value' => 0
                    ];
                }

                $competitors[$data['CompetitorId']] = $data['CompetitorName'];
                $CompetitorData[$data['CompetitorId']]['Qty'] += $compQty;
                $CompetitorData[$data['CompetitorId']]['Value'] += $compValue;
                $result[$key]["CompetitorData"] = $CompetitorData;
            } else {
                $result[$key]['OwnQty'] += $compQty;
                $result[$key]['OwnValue'] += $compValue;
            }

            if (!isset($totalPotential[$totalPotentialKey])) {
                $totalPotential[$totalPotentialKey] = 0;
            }
            $totalPotential[$totalPotentialKey] += $compValue;
        }

        foreach ($result as $key => $resultData) {
            $i = 1;
            $totalComQty = $totalComValue = 0;
            foreach ($result[$key]["CompetitorData"] as $data) {
                $compKey = "Comp" . ($i++);
                $result[$key][$compKey . "Qty"] = $data['Qty'];
                $result[$key][$compKey . "Value"] = $data['Value'];

                $totalComQty += $data['Qty'];
                $totalComValue += $data['Value'];
            }
            $totalComQty += $resultData['OwnQty'];
            $totalComValue += $resultData['OwnValue'];
            $result[$key]['RcpaQty'] = $totalComQty;
            $result[$key]['RcpaValue'] = $totalComValue;
            $result[$key]['TotalPotential'] = $totalPotential[$result[$key]['TotalPotentialKey']];

            unset($result[$key]['CompetitorData']);
            unset($result[$key]['TotalPotentialKey']);
        }

        $this->data['RcpaData'] = $result;
        $this->data['RcpaComData'] = [
            "Comp1" => "Comp1",
            "Comp2" => "Comp2",
            "Comp3" => "Comp3",
            "Comp4" => "Comp4",
            "Comp5" => "Comp5",
        ];

        return $this->app->Renderer()->render("reports/RcpaBaseView.twig", $this->data);
    }

    public function EdetailingReport()
    {
        $this->data['Title'] = 'E-Detailing Report';

        $this->app->Renderer()->render("reports/RcpaBaseView.twig", $this->data);
    }

    public function DvpReport()
    {
        $action = $this->app->Request()->getParameter("action");

        $this->data['Title'] = 'DVP Report';
        $emp = $this->app->Request()->getParameter("employee_id");
        $date = $this->app->Request()->getParameter("date");
        $PositionId = $this->app->Request()->getParameter("PositionId");
        $BrandId = $this->app->Request()->getParameter("BrandId");
        $Moye = $this->app->Request()->getParameter("Moye");
        $status = $this->app->Request()->getParameter("Status");
        $territoryId = $this->app->Request()->getParameter("territoryId");
        $prescriberLevel = $this->app->Request()->getParameter("prescriberLevel");
        $flag = false;
        if ($territoryId == ''  || $territoryId == 'null') {
            $emp1 = EmployeeQuery::create()
                ->findPk($emp);
            $orgManger = OrgManager::getMyTerritories($emp1);
            $territoryId = $orgManger;
        }
        //print_r($territoryId);die;
        $prescriberdata = [];
        if ($PositionId !=  null) {
            $employeePositionCode = \entities\PositionsQuery::create()
                ->select(['PositionCode'])
                ->filterByPositionId($PositionId)
                ->findOne();
        } else {
            $employee = \entities\EmployeeQuery::create()
                ->filterByEmployeeId($emp)
                ->findOne();
            $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);

            $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

            $employeePositionCode = \entities\PositionsQuery::create()
                ->select(['PositionCode'])
                ->filterByPositionId($positionArray)
                ->find()->toArray();
        }
        switch ($action):
            case "":

                if ($BrandId != null && $status != null && $Moye != null) {
                    $pre = $this->prescriberLadder($territoryId, $BrandId, $Moye, $status);
                    if (!empty($pre['Brand'])) {
                        $prescriberdata = OutletsQuery::create()
                            ->select(['outlet_code'])
                            ->filterById($pre['Brand'])
                            ->find()->toArray();
                    }
                }
                if ($prescriberLevel != null) {
                    $pre = $this->prescriberLadder($territoryId);
                    if ($prescriberLevel == '1brandrax') {
                        if (!empty($pre['one_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])
                                ->filterById($pre['one_brand'])
                                ->find()->toArray();
                        }
                    } else if ($prescriberLevel == '2brandrax') {
                        if (!empty($pre['two_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['two_brand'])
                                ->find()->toArray();
                        }
                    } else if ($prescriberLevel == '3brandrax') {
                        if (!empty($pre['three_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['three_brand'])
                                ->find()->toArray();
                        }
                    } elseif ($prescriberLevel == 'morethantree') {
                        if (!empty($pre['more_three_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['more_three_brand'])
                                ->find()->toArray();
                        }
                    } else {
                        if (!empty($pre['no_raxers'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['no_raxers'])
                                ->find()->toArray();
                        }
                    }
                }
                $dvpReport = \entities\WriteDvpQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode)
                    ->limit(250);
                if ($Moye != null) {
                    $dvpReport->filterByMonth($Moye);
                } else {
                    $month = date('m-Y', strtotime($date));
                    $dvpReport->filterByMonth($month);
                }
                if ($date == null || $date == '') {
                    $dvpReport = $dvpReport->filterByDoctorCode($prescriberdata);
                }

                $dvpReport = $dvpReport->find()->toArray();

                break;
            case "download":

                if ($BrandId != null && $status != null && $Moye != null) {
                    $pre = $this->prescriberLadder($territoryId, $BrandId, $Moye, $status);
                    if (!empty($pre['Brand'])) {
                        $prescriberdata = OutletsQuery::create()
                            ->select(['outlet_code'])
                            ->filterById($pre['Brand'])
                            ->find()->toArray();
                    }
                }
                if ($prescriberLevel != null) {
                    $pre = $this->prescriberLadder($territoryId);
                    if ($prescriberLevel == '1brandrax') {
                        if (!empty($pre['one_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])
                                ->filterById($pre['one_brand'])
                                ->find()->toArray();
                        }
                    } else if ($prescriberLevel == '2brandrax') {
                        if (!empty($pre['two_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['two_brand'])
                                ->find()->toArray();
                        }
                    } else if ($prescriberLevel == '3brandrax') {
                        if (!empty($pre['three_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['three_brand'])
                                ->find()->toArray();
                        }
                    } elseif ($prescriberLevel == 'morethantree') {
                        if (!empty($pre['more_three_brand'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['more_three_brand'])
                                ->find()->toArray();
                        }
                    } else {
                        if (!empty($pre['no_raxers'])) {
                            $prescriberdata = OutletsQuery::create()
                                ->select(['outlet_code'])->filterById($pre['no_raxers'])
                                ->find()->toArray();
                        }
                    }
                }

                $dvpReport = \entities\WriteDvpQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode);
                if ($Moye != null) {
                    $dvpReport->filterByMonth($Moye);
                } else {
                    $month = date('m-Y', strtotime($date));
                    $dvpReport->filterByMonth($month);
                }

                if ($date == null || $date == '') {
                    $dvpReport = $dvpReport->filterByDoctorCode($prescriberdata);
                }

                $dvpReport = $dvpReport->find()->toArray();
                break;
        endswitch;


        // if (empty($emp) || empty($date)) {
        //     return $this->app->Renderer()->render("404copy.twig");
        // }

        // $month = date("m-Y", strtotime($date));
        // $lastMonth = date("m-Y", strtotime('-1 month', strtotime($date)));

        // $employee = \entities\EmployeeQuery::create()
        //     ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //     ->leftJoinWithHrUserDates()
        //     ->leftJoinWithGeoTowns()
        //     ->leftJoinWithOrgUnit()
        //     ->filterByEmployeeId($emp)
        //     ->find()->toArray();

        // $joiningDate = isset($employee[0]['HrUserDatess'][0]['JoinDate']) ? $employee[0]['HrUserDatess'][0]['JoinDate'] : '';
        // $townName = isset($employee[0]['GeoTowns']['Stownname']) ? $employee[0]['GeoTowns']['Stownname'] : '';
        // $orgUnitName = isset($employee[0]['OrgUnit']['UnitName']) ? $employee[0]['OrgUnit']['UnitName'] : '';
        // $empCode = isset($employee[0]['EmployeeCode']) ? $employee[0]['EmployeeCode'] : '';

        // if ($employee[0] != null) {

        //     $position = \entities\PositionsQuery::create()->findPk($employee[0]['PositionId']);
        //     $managers = $position->getCavPositionsUp();

        //     if ($managers != null) {
        //         $managerPositionIds = explode(",", $managers);
        //     } else {
        //         $managerPositionIds = null;
        //     }

        //     if ($managerPositionIds != null) {
        //         $employeeManagers = \entities\EmployeeQuery::create()
        //             ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //             ->leftJoinWithGeoTowns()
        //             ->leftJoinWithPositionsRelatedByPositionId()
        //             ->filterByPositionId($managerPositionIds)
        //             ->find()->toArray();
        //     }

        //     if (isset($managerPositionIds[0]) && isset($employeeManagers[0]["PositionsRelatedByPositionId"]["PositionName"]) && $managerPositionIds[0]) {
        //         $level1Employee = $employeeManagers[0]["PositionsRelatedByPositionId"]["PositionName"];
        //         $level1PositionCode = $employeeManagers[0]['PositionsRelatedByPositionId']["PositionCode"];
        //     } else {
        //         $level1Employee = $townName;
        //         $level1PositionCode = "";
        //     }

        //     if (isset($managerPositionIds[1]) && isset($employeeManagers[1]["PositionsRelatedByPositionId"]["PositionName"]) && $managerPositionIds[1]) {
        //         $level2Employee = $employeeManagers[1]["PositionsRelatedByPositionId"]["PositionName"];
        //         $level2PositionCode = $employeeManagers[1]['PositionsRelatedByPositionId']["PositionCode"];
        //     } else {
        //         $level2Employee = $townName;
        //         $level2PositionCode = "";
        //     }
        //     if (isset($managerPositionIds[2]) && isset($employeeManagers[2]["PositionsRelatedByPositionId"]["PositionName"]) && $managerPositionIds[2]) {
        //         $level3Employee = $employeeManagers[2]["PositionsRelatedByPositionId"]["PositionName"];
        //         $level3PositionCode = $employeeManagers[2]['PositionsRelatedByPositionId']["PositionCode"];
        //     } else {
        //         $level3Employee = $townName;
        //         $level3PositionCode = "";
        //     }

        //     $level3 = isset($level3Employee) ? $level3Employee : null;
        //     $level2 = isset($level2Employee) ? $level2Employee : null;
        //     $level1 = isset($level1Employee) ? $level1Employee : null;

        //     if (isset($managerPositionIds[0]) && isset($employeeManagers[0]) && $managerPositionIds[0]) {
        //         $level1EmployeePositionId = $employeeManagers[0]["PositionId"];
        //     }
        //     if (isset($managerPositionIds[1]) && isset($employeeManagers[1]) && $managerPositionIds[1]) {
        //         $level2EmployeePositionId = $employeeManagers[1]["PositionId"];
        //     }
        //     if (isset($managerPositionIds[2]) && isset($employeeManagers[2]) && $managerPositionIds[2]) {
        //         $level3EmployeePositionId = $employeeManagers[2]["PositionId"];
        //     }

        //     $level3Position = isset($level3EmployeePositionId) ? $level3EmployeePositionId : null;
        //     $level2Position = isset($level2EmployeePositionId) ? $level2EmployeePositionId : null;
        //     $level1Position = isset($level1EmployeePositionId) ? $level1EmployeePositionId : null;


        //     if ($employee[0]['Status'] != null && $employee[0]['Status'] == 1) {
        //         $status = 'Active';
        //     } else {
        //         $status = 'In Active';
        //     }


        //     $territories = \entities\PositionsQuery::create()
        //         ->filterByPositionId($employee[0]['PositionId'])
        //         ->findOne();

        //     if ($territories != null && $territories->getCavTerritories() != null) {
        //         $terExplode = explode(',', $territories->getCavTerritories());
        //     } else {
        //         $this->data['errorMsg'] = 'Territories not found!';
        //         return $this->app->Renderer()->render("error.twig", $this->data);
        //     }

        //     unset($employees);

        //     $monthExp = explode('-', $month);
        //     $fromDate = date($monthExp[1] . '-' . $monthExp[0] . '-' . '01');
        //     $toDate = date($monthExp[1] . '-' . $monthExp[0] . '-' . 't');

        //     switch ($action):
        //         case "":
        //             $outletsView = \entities\OutletViewQuery::create()
        //                 ->filterByOutlettypeName('Doctor')
        //                 ->limit(250)
        //                 ->findByTerritoryId($terExplode);
        //             break;
        //         case "download":
        //             $outletsView = \entities\OutletViewQuery::create()
        //                 ->filterByOutlettypeName('Doctor')
        //                 ->findByTerritoryId($terExplode);

        //             break;
        //     endswitch;

        //     $dailyCalls = \entities\DailycallsQuery::create()
        //         ->select(['OutletOrgDataId', 'PositionId', 'DcrDate', 'Managers', 'Count'])
        //         ->withColumn('count(outlet_org_data_id)', 'Count')
        //         ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        //         ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        //         ->filterByPositionId($employee[0]['PositionId'])
        //         ->groupByOutletOrgDataId()
        //         ->groupByDcrDate()
        //         ->find()->toArray();

        //     $mroutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
        //         ->select(['Visit', 'OutletOrgDataId'])
        //         ->withColumn('sum(visits)', 'Visit')
        //         ->filterByMoye($month)
        //         ->filterByTerritoryId($terExplode)
        //         ->filterByPositionId($employee[0]['PositionId'])
        //         ->groupByOutletOrgDataId()
        //         ->find()->toKeyValue('OutletOrgDataId', 'Visit');

        //     if ($level1Position != null) {
        //         $amOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
        //             ->select(['Visit', 'OutletOrgDataId'])
        //             ->withColumn('sum(visits)', 'Visit')
        //             ->filterByMoye($month)
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByPositionId($level1Position)
        //             ->groupByOutletOrgDataId()
        //             ->find()->toKeyValue('OutletOrgDataId', 'Visit');
        //     }

        //     if ($level2Position != null) {
        //         $rmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
        //             ->select(['Visit', 'OutletOrgDataId'])
        //             ->withColumn('sum(visits)', 'Visit')
        //             ->filterByMoye($month)
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByPositionId($level2Position)
        //             ->groupByOutletOrgDataId()
        //             ->find()->toKeyValue('OutletOrgDataId', 'Visit');
        //     }
        //     if ($level3Position != null) {
        //         $zmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
        //             ->select(['Visit', 'OutletOrgDataId'])
        //             ->withColumn('sum(visits)', 'Visit')
        //             ->filterByMoye($month)
        //             ->filterByTerritoryId($terExplode)
        //             ->filterByPositionId($level3Position)
        //             ->groupByOutletOrgDataId()
        //             ->find()->toKeyValue('OutletOrgDataId', 'Visit');
        //     }

        //     foreach ($dailyCalls as $dailyCall) {
        //         if ($dailyCall["Managers"] != null) {
        //             $empExpo = explode(',', $dailyCall["Managers"]);
        //             $employeePositions = \entities\EmployeeQuery::create()
        //                 ->select(['PositionId'])
        //                 ->filterByEmployeeId($empExpo)
        //                 ->find()->toArray();
        //             if (in_array($level1Position, $employeePositions)) {
        //                 if (isset($amOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
        //                     $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
        //                 } else {
        //                     $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
        //                 }
        //             }
        //             if (in_array($level2Position, $employeePositions)) {
        //                 if (isset($rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
        //                     $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
        //                 } else {
        //                     $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
        //                 }
        //             }
        //             if (in_array($level3Position, $employeePositions)) {
        //                 if (isset($zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
        //                     $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
        //                 } else {
        //                     $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
        //                 }
        //             }
        //         }
        //     }

        //     $topBrandArray = array();
        //     $topBrands = \entities\RcpaSummaryQuery::create()
        //         ->select(['OutletOrgId', 'BrandName'])
        //         ->filterBYRcpaMoye($month)
        //         ->groupByOutletOrgId()
        //         ->filterByTerritoryId($terExplode)
        //         ->groupByBrandName()
        //         ->find()->toArray();

        //     foreach ($topBrands as $topBrand) {
        //         if (!array_key_exists($topBrand['OutletOrgId'], $topBrandArray)) {
        //             $topBrandArray[$topBrand['OutletOrgId']] = [];
        //         }
        //     }
        //     foreach ($topBrands as $topBrand) {
        //         if (array_key_exists($topBrand['OutletOrgId'], $topBrandArray)) {
        //             array_push($topBrandArray[$topBrand['OutletOrgId']], $topBrand['BrandName']);
        //         }
        //     }
        //     unset($topBrands);

        //     $rcpaDoneArray = array();
        //     $rcpaDone = \entities\OutletVisitsViewQuery::create()
        //         ->select(['OutletOrgDataId', 'RcpaDone', 'PositionId'])
        //         ->withColumn('sum(rcpa_done)', 'RcpaDone')
        //         ->filterByMoye($month)
        //         ->groupByOutletOrgDataId()
        //         ->filterByTerritoryId($terExplode)
        //         ->groupByPositionId()
        //         ->find()->toArray();
        //     foreach ($rcpaDone as $rcpaDo) {
        //         $rcpaDoneArray[$rcpaDo['OutletOrgDataId'] . '-' . $rcpaDo['PositionId']] = $rcpaDo['RcpaDone'];
        //     }
        //     unset($rcpaDone);

        //     $rcpaRetailViewArray = array();
        //     $rcpaRetailView = \entities\RcpaRetailerViewQuery::create()
        //         ->select(['Own', 'Comp', 'Doctorid'])
        //         ->withColumn('sum(own)', 'Own')
        //         ->withColumn('sum(competition)', 'Comp')
        //         ->filterByRcpaMoye($month)
        //         ->filterByTerritoryId($terExplode)
        //         ->groupByDoctorid()
        //         ->find()->toArray();
        //     foreach ($rcpaRetailView as $rcpaRetail) {
        //         $rcpaRetailViewArray[$rcpaRetail['Doctorid']] = [
        //             'Own' => $rcpaRetail['Own'],
        //             'Comp' => $rcpaRetail['Comp'],
        //         ];
        //     }
        //     unset($rcpaRetailView);

        //     $lastRcpaRetailViewArray = array();
        //     $lastRcpaRetailView = \entities\RcpaRetailerViewQuery::create()
        //         ->select(['LastOwn', 'LastComp', 'Doctorid'])
        //         ->withColumn('sum(own)', 'LastOwn')
        //         ->withColumn('sum(competition)', 'LastComp')
        //         ->filterByRcpaMoye($lastMonth)
        //         ->filterByTerritoryId($terExplode)
        //         ->groupByDoctorid()
        //         ->find()->toArray();
        //     foreach ($lastRcpaRetailView as $lastRcpaRetail) {
        //         $lastRcpaRetailViewArray[$lastRcpaRetail['Doctorid']] = [
        //             'LastOwn' => $lastRcpaRetail['LastOwn'],
        //             'LastComp' => $lastRcpaRetail['LastComp'],
        //         ];
        //     }
        //     unset($lastRcpaRetailView);

        //     $result = array();
        //     foreach ($outletsView as $outletView) {
        //         $rcpaSummary = 0;
        //         if (isset($topBrandArray[$outletView->getOutletOrgId()])) {
        //             $brandArrayImplode = implode(',', $topBrandArray[$outletView->getOutletOrgId()]);
        //             $rcpaSummary = count($topBrandArray[$outletView->getOutletOrgId()]);
        //         } else {
        //             $brandArrayImplode = null;
        //         }

        //         if (isset($rcpaRetailViewArray[$outletView->getOutlet_Id()])) {
        //             $rcpaRetailCurrent = $rcpaRetailViewArray[$outletView->getOutlet_Id()];
        //         } else {
        //             $rcpaRetailCurrent = [];
        //         }

        //         if (isset($lastRcpaRetailViewArray[$outletView->getOutlet_Id()])) {
        //             $lastRcpaRetailView = $lastRcpaRetailViewArray[$outletView->getOutlet_Id()];
        //         } else {
        //             $lastRcpaRetailView = [];
        //         }

        //         $emp = \entities\EmployeeQuery::create()
        //             ->leftJoinWithGeoTowns()
        //             ->filterByPositionId($outletView->getPositionId())
        //             ->findOne();
        //         if ($emp != null) {
        //             if ($emp->getGeoTowns() != null) {
        //                 if ($emp->getGeoTowns() != null) {
        //                     $empTown = $emp->getGeoTowns()->getStownname();
        //                 }
        //             } else {
        //                 $empTown = null;
        //             }

        //             $empFirstName = $emp->getFirstName();
        //             $empLastName = $emp->getLastName();

        //             $empName = $empFirstName . ' ' . $empLastName;
        //         } else {
        //             $empTown = null;
        //         }

        //         $drTown = \entities\GeoTownsQuery::create()
        //             ->findOneByItownid($outletView->getItownid());
        //         if ($drTown == null) {
        //             $doctorTown = null;
        //         } else {
        //             $doctorTown = $drTown->getStownname();
        //         }

        //         if (isset($mroutletVisitViewCount[$outletView->getOutletOrgId()])) {
        //             $mrCallCount = $mroutletVisitViewCount[$outletView->getOutletOrgId()];
        //         } else {
        //             $mrCallCount = 0;
        //         }
        //         if (isset($amOutletVisitViewCount[$outletView->getOutletOrgId()])) {
        //             $amCallCount = $amOutletVisitViewCount[$outletView->getOutletOrgId()];
        //         } else {
        //             $amCallCount = 0;
        //         }
        //         if (isset($rmOutletVisitViewCount[$outletView->getOutletOrgId()])) {
        //             $rmCallCount = $rmOutletVisitViewCount[$outletView->getOutletOrgId()];
        //         } else {
        //             $rmCallCount = 0;
        //         }
        //         if (isset($zmOutletVisitViewCount[$outletView->getOutletOrgId()])) {
        //             $zmCallCount = $zmOutletVisitViewCount[$outletView->getOutletOrgId()];
        //         } else {
        //             $zmCallCount = 0;
        //         }

        //         $rcpa = 'No';
        //         if (isset($rcpaDoneArray[$outletView->getOutletOrgId() . '-' . $outletView->getPositionId()])) {
        //             if ($rcpaDoneArray[$outletView->getOutletOrgId() . '-' . $outletView->getPositionId()] > 0) {
        //                 $rcpa = 'Yes';
        //             }
        //         }

        //         $sgpiOutSummary = \entities\SgpiOutSummaryQuery::create()
        //             ->select(['Qty', 'SgpiType'])
        //             ->withColumn('sum(qty)', 'Qty')
        //             ->filterByOutletOrgdataId($outletView->getOutletOrgId())
        //             ->filterByMoye($month)
        //             ->groupBySgpiType()
        //             ->find()->toArray();

        //         if ($joiningDate != null) {
        //             $stToTimeDate = date('d-m-Y', strtotime($joiningDate));
        //             $empJoinigDate = $stToTimeDate;
        //         } else {
        //             $empJoinigDate = null;
        //         }

        //         //Sample,Gifts and Promo Calculation
        //         $sgpiDataArray = array(
        //             'samples' => 0,
        //             'gifts' => 0,
        //             'promo' => 0,
        //         );
        //         if (!empty($sgpiOutSummary)) {
        //             foreach ($sgpiOutSummary as $sgpiOutSumm) {
        //                 if (array_key_exists($sgpiOutSumm['SgpiType'], $sgpiDataArray)) {
        //                     $sgpiDataArray[$sgpiOutSumm['SgpiType']] += $sgpiOutSumm['Qty'];
        //                 }
        //             }
        //         }

        //         $empPositionCode = $position->getPositionCode();
        //         $empPositionLevel = '';
        //         if (str_starts_with($empPositionCode, '4')) {
        //             $empPositionLevel = 'Zone';
        //         } elseif (str_starts_with($empPositionCode, '3')) {
        //             $empPositionLevel = 'Region';
        //         } elseif (str_starts_with($empPositionCode, '2')) {
        //             $empPositionLevel = 'Area';
        //         } else {
        //             $empPositionLevel = 'Territory';
        //         }

        //         $data = array(
        //             'OrgUnit' => isset($orgUnitName) ? $orgUnitName : '',
        //             'EmployeeCode' => isset($empCode) ? $empCode : '',
        //             'JoiningDate' => $empJoinigDate,
        //             'EmpPositionCode' => $empPositionCode,
        //             'EmpPositionName' => $position->getPositionName(),
        //             'EmpLevel' => $empPositionLevel,
        //             'Level3' => $level3,
        //             'Level2' => $level2,
        //             'Level1' => $level1,
        //             'level3PositionCode' => $level3PositionCode,
        //             'level2PositionCode' => $level2PositionCode,
        //             'level1PositionCode' => $level1PositionCode,
        //             'Location' => isset($empTown) ? $empTown : '',
        //             'Status' => $status,
        //             'EmployeeName' => isset($empName) ? $empName : '',
        //             'DoctorName' => $outletView->getOutletName(),
        //             'DoctorCode' => $outletView->getOutletCode(),
        //             'Town' => $doctorTown,
        //             'Patch' => $outletView->getBeatName(),
        //             'Speciality' => $outletView->getClassification(),
        //             'Tags' => $outletView->getTags(),
        //             'VisitFq' => $outletView->getVisitFq(),
        //             'PrescriberClassification' => $rcpaSummary,
        //             'TopBrand' => isset($brandArrayImplode) ? $brandArrayImplode : null,
        //             'VisitDr' => $mrCallCount,
        //             'AmVisitDr' => $amCallCount,
        //             'RmVisitDr' => $rmCallCount,
        //             'ZmVisitDr' => $zmCallCount,
        //             'RcpaDone' => $rcpa,
        //             'RCPA-LM-OWN' => isset($lastRcpaRetailView['LastOwn']) ? $lastRcpaRetailView['LastOwn'] : 0,
        //             'RCPA-LM-COMP' => isset($lastRcpaRetailView['LastComp']) ? $lastRcpaRetailView['LastComp'] : 0,
        //             'RCPA-CM-OWN' => isset($rcpaRetailCurrent['Own']) ? $rcpaRetailCurrent['Own'] : 0,
        //             'RCPA-CM-COMP' => isset($rcpaRetailCurrent['Comp']) ? $rcpaRetailCurrent['Comp'] : 0,
        //             'ColumnValue' => $sgpiDataArray,
        //         );
        //         array_push($result, $data);
        //     }
        //     $this->data['Columns'] = $this->getConfig("SGPI", "SgpiType");
        $this->data['result'] = $dvpReport;
        //$this->data['month'] = $month;



        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/DvpView.twig", $this->data);
                break;
            case "download":
                $objPHPExcel = new Spreadsheet();
                $objPHPExcel->getActiveSheet();


                $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'OrgUnit');
                $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'EmployeeCode');
                $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'JoiningDate');
                $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'AmPosition');
                $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'RmPosition');
                $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'ZmPosition');
                $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Location');
                $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Status');
                $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'EmployeeName');
                $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'DoctorName');
                $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'DoctorCode');
                $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Town');
                $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Patch');
                $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Speciality');
                $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Tags');
                $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'VisitFq');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'PrescriberClassification');
                $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'TopBrand');
                $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'VisitDr');
                $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'AmVisitDr');
                $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'RmVisitDr');
                $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'ZmVisitDr');
                $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'RcpaDone');
                $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'RCPA-LM-OWN');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'RCPA-LM-COMP');
                $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'RCPA-CM-OWN');
                $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'RCPA-CM-COMP');
                $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'Sample');
                $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Gift');
                $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'Promo');

                $objPHPExcel->getActiveSheet()->getStyle("A1:AE1")->getFont()->setBold(true);

                $rowCount = 2;
                foreach ($dvpReport as $data) {
                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data["OrgUnit"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['EmployeeCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['JoiningDate']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["AmPosition"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['RmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['ZmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["Location"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['Status']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['EmployeeName']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["DoctorName"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['DoctorCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Town']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data["Patch"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['Speciality']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['Tags']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data["VisitFq"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data["PrescriberClassification"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['TopBrand']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['VisitDr']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data["AmVisitDr"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['RmVisitDr']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['ZmVisitDr']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data["RcpaDone"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['RcpaLmOwn']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['RcpaLmComp']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data["RcpaCmOwn"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, $data['RcpaCmComp']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $data['SamplesSgpi']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $data['GiftsSgpi']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, $data['PromoSgpi']);

                    /*
                    if (isset($data["ColumnValue"]['samples'])) {
                        $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $data["ColumnValue"]['samples']);
                    }
                    if (isset($data["ColumnValue"]['gifts'])) {
                        $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $data["ColumnValue"]['gifts']);
                    }
                    if (isset($data["ColumnValue"]['promo'])) {
                        $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, $data["ColumnValue"]['promo']);
                    }
                    */
                    $rowCount++;
                }

                $fileName = "Labels.xlsx";
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="DvpReport.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                break;
        endswitch;
    }

    // Discussed with chintan sir - we will render under construction page currently and needs to create a view for this report
    //return $this->app->Renderer()->render("underConstruction.twig");

    public function empSummary()
    {
        $month = $this->app->Request()->getParameter("month");
        $employees = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
        //$employees = 2585;

        $monthNumber = explode('-', $month);
        $dt = \DateTime::createFromFormat('m', $monthNumber[0]);
        $startDate = $dt->format('Y-m-1');
        $endDate = $dt->format('Y-m-t');


        $expenses = \entities\ExpensesQuery::create()
            ->leftJoinWithBudgetGroup()
            ->filterByExpenseDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($employees)
            ->find();

        $reportData = [];
        $taxArray = [];
        $claimedAmount = 0;
        $add = 0;
        $gst = 0;
        $didbyapprover = 0;
        $audididAmount = 0;
        $finalAmount = 0;
        $cmpcardAmount = 0;
        $dedAuditorAmount = 0;
        $addAuditorAmount = 0;
        $temp = 0;
        if ($expenses) {
            foreach ($expenses as $e) {
                $list = $e->getExpenseLists();
                foreach ($list as $l) {

                    if (!isset($taxArray[$l->getExpMasterId()])) {
                        $taxArray[$l->getExpMasterId()]['claimedAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['add'] = 0;
                        $taxArray[$l->getExpMasterId()]['gst'] = 0;
                        $taxArray[$l->getExpMasterId()]['didbyapprover'] = 0;
                        $taxArray[$l->getExpMasterId()]['audididAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['finalAmount'] = 0;
                    }

                    if (array_key_exists($l->getExpMasterId(), $taxArray)) {
                        $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();

                        $taxArray[$l->getExpMasterId()]['claimedAmount'] += $l->getExpIlAmount();
                        $taxArray[$l->getExpMasterId()]['add'] += $l->getExpReqAmount();
                        $taxArray[$l->getExpMasterId()]['gst'] += $l->getExpTaxAmount();
                        $taxArray[$l->getExpMasterId()]['didbyapprover'] += $l->getExpAprAmount();
                        $taxArray[$l->getExpMasterId()]['audididAmount'] += $l->getExpAuditAmount();
                        $taxArray[$l->getExpMasterId()]['finalAmount'] += $l->getExpFinalAmount();
                        if ($l->getCmpCard() == 1) {
                            $taxArray[$l->getExpMasterId()]['cmpcardAmount'] += $l->getExpFinalAmount();
                        }
                    } else {
                        $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();

                        $taxArray[$l->getExpMasterId()]['claimedAmount'] = $l->getExpIlAmount();
                        $taxArray[$l->getExpMasterId()]['add'] = $l->getExpReqAmount();
                        $taxArray[$l->getExpMasterId()]['gst'] = $l->getExpTaxAmount();
                        $taxArray[$l->getExpMasterId()]['didbyapprover'] = $l->getExpAprAmount();
                        $taxArray[$l->getExpMasterId()]['audididAmount'] = $l->getExpAuditAmount();
                        $taxArray[$l->getExpMasterId()]['finalAmount'] = $l->getExpFinalAmount();
                        if ($l->getCmpCard() == 1) {
                            $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = $l->getExpFinalAmount();
                        }
                    }

                    $claimedAmount += $l->getExpIlAmount();
                    $add += $l->getExpReqAmount();
                    $gst += $l->getExpTaxAmount();
                    $didbyapprover += $l->getExpAprAmount();

                    $temp = $l->getExpAprAmount() - $l->getExpAuditAmount();
                    if ($temp > 0 && $l->getExpAuditAmount() != 0) {
                        $dedAuditorAmount += $temp;
                    } else if ($l->getExpAuditAmount() != 0) {
                        $addAuditorAmount += $temp;
                    }

                    $audididAmount += $l->getExpAuditAmount();
                    $finalAmount += $l->getExpFinalAmount();
                    if ($l->getCmpCard() == 1) {
                        $cmpcardAmount += $l->getExpFinalAmount();
                    }
                }
            }
        }
        $emp = \entities\EmployeeQuery::create()->findPk($employees);
        if ($emp) {
            $this->data['Name'] = $emp->getFirstName() . " " . $emp->getLastName();
            $this->data['empcode'] = $emp->getEmployeeCode();
            $this->data['costnumber'] = $emp->getCostNumber();
            $this->data['Designation'] = $emp->getDesignations()->getDesignation();
            $this->data['Location'] = $emp->getBranch()->getBranchname() . " | " . $emp->getBranch()->getGeoState()->getSstatename();
            $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
        }
        //$this->data['status'] = $status;
        $this->data['heads'] = $taxArray;
        $this->data['claimedAmount'] = $claimedAmount;
        $this->data['add'] = $add;
        $this->data['gst'] = $gst;
        $this->data['didbyapprover'] = $didbyapprover;
        $this->data['audididAmount'] = $audididAmount;
        $this->data['finalAmount'] = $finalAmount;
        $this->data['addAuditorAmount'] = $addAuditorAmount;
        $this->data['dedAuditorAmount'] = $dedAuditorAmount;
        $this->data['cmpcardAmount'] = $cmpcardAmount;
        $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));

        $monthSelection->val($this->app->Request()->getParameter("month"));
        $this->data['monthList'] = $monthSelection->html();
        $this->data['month'] = $this->app->Request()->getParameter("month", "|");
        $this->data['reportname'] = date("F Y", strtotime($dt->format('Y-m-1')));
        $this->app->Renderer()->render("reports/empSummaryReports.twig", $this->data);
    }

    public function BrandCampiagnReport()
    {
        // if (isset($_GET['download']) && $_GET['download'] == 'true') {

        //     $companyId = $this->app->Auth()->CompanyId();
        //     $data = BrandCampiagnQuery::create()
        //         ->select(['BrandCampiagnId', 'CampiagnName', 'StartDate', 'EndDate', 'LockingDate', 'Type', 'Tags', 'DoctorCount', 'Planned', 'Done', 'FocusBrandId', 'ClassificationId'])
        //         ->filterByCompanyId($companyId)
        //         ->find()
        //         ->toArray();

        //     if (empty($response)) {
        //         exit; 
        //     }

        //     header('Content-Type: text/csv');
        //     header('Content-Disposition: attachment; filename="downloadCampiagnData.csv"');
        //     $output = fopen('php://output', 'w');
        //     fputcsv($output, ['BrandCampiagnId', 'CampiagnName', 'StartDate', 'EndDate', 'LockingDate', 'Type', 'Tags', 'DoctorCount', 'Planned', 'Done', 'FocusBrandId', 'ClassificationId']);

        //     // Output the data rows
        //     foreach ($response as $row) {
        //         fputcsv($output, $row);
        //     }

        //     fclose($output);
        //     exit;
        // }

        $action = $this->app->Request()->getParameter("action");
        $this->data['reportname'] = "BrandCampiagnReport";
        $this->data['title'] = "Brand Campiagn Report";


        $brands = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());

        $resBrand = ["null" => "-"];
        foreach ($brands as $b) {
            $orgUnit = $b->getOrgUnit();
            $brandName = $b->getBrandName();
            $primaryKey = $b->getPrimaryKey();
            $resBrand[$primaryKey] = $orgUnit ? $brandName . " | " . $orgUnit->getUnitName() : $brandName;
        }

        $classification = \entities\ClassificationQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
        $classi = ["null" => "-"];
        foreach ($classification as $cf) {
            $classification = $cf->getclassification();
            $primaryKey = $cf->getPrimaryKey();
            $classi[$primaryKey] = $classification;
        }

        $this->data['valKeys'] = ["ClassificationId" => $classi, "FocusBrandId" => $resBrand];

        switch ($action):
            case "":


                $types = $this->getConfig("Catalogue", "Types");
                $brands = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("BrandId", "BrandName");

                $classification = \entities\ClassificationQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Id", "Classification");
                $f = FormMgr::form();
                $f->add([
                    "campiagn_name" => FormMgr::text()->label("Campiagn Name")->required(),
                    "start_date" => FormMgr::date()->label("Start Date"),
                    "end_date" => FormMgr::date()->label("End Date"),
                    "type" => FormMgr::select()->options([0 => "--Select Type--"] + $types)->label("Types"),
                    "brand" => FormMgr::select()->options([0 => "--Select Brand--"] + $brands)->label("Brand"),
                    "classification" => FormMgr::select()->options([0 => "--Select Classification--"] + $classification)->label("Classification"),
                ]);


                $this->data['filters'] = $f->html();


                $this->data['cols'] = [
                    "BrandCampiagnId" => "BrandCampiagnId",
                    "CampiagnName" => "CampiagnName",
                    "StartDate" => "StartDate",
                    "EndDate" => "EndDate",
                    "LockingDate" => "LockingDate",
                    "Type" => "Type",
                    "Tags" => "Tags",
                    "DoctorCount" => "DoctorCount",
                    "Planned" => "Planned",
                    "Done" => "Done",
                    "FocusBrandId" => "FocusBrandId",
                    "ClassificationId" => "ClassificationId",
                    // "FocusBrandId" => "Brands.BrandName",
                    // "ClassificationId" => "Classification.Classification",
                    //                    "Action" => "Action",
                ];
                $this->data['pk'] = "BrandCampiagnId";
                $this->data['Download'] = true;
                $this->data['rowButtons'] = ["visit_plan" => "zmdi zmdi-layers", "doctor_visit" => "zmdi zmdi-eye"];
                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "init":
                extract($this->DTFilters($_GET));
                $response = [];
                // $darview = BrandCampiagnQuery::create()
                // ->select(['BrandCampiagnId','CampiagnName','StartDate','EndDate','LockingDate','Type','Tags','DoctorCount','Planned','Done','FocusBrandId','ClassificationId'])               
                // ->filterByCompanyId($this->app->Auth()->CompanyId())
                // ->filterByCampiagnType('Open');
                // $count = $darview->count();
                // $response["recordsTotal"] = $count;         
                // $count = $darview->count();
                // $response["recordsFiltered"] = $count;
                // $response['data'] = $darview->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "result":
                extract($this->DTFilters($_GET));
                $response = [];
                $campiagnName = $this->app->Request()->getParameter("campiagn_name");
                $startDate = $this->app->Request()->getParameter("start_date");
                $endDate = $this->app->Request()->getParameter("end_date");
                $type = $this->app->Request()->getParameter("type");
                $brand = $this->app->Request()->getParameter("brand");
                $classification = $this->app->Request()->getParameter("classification");

                $darview = BrandCampiagnQuery::create()
                    ->select(['BrandCampiagnId', 'CampiagnName', 'StartDate', 'EndDate', 'LockingDate', 'Type', 'Tags', 'DoctorCount', 'Planned', 'Done', 'FocusBrandId', 'ClassificationId'])

                    ->filterByCompanyId($this->app->Auth()->CompanyId());

                if ($campiagnName != null) {
                    $darview->filterByCampiagnName($campiagnName);
                }

                if ($startDate != null) {
                    $darview->filterByStartDate($startDate, Criteria::GREATER_THAN);
                }
                if ($endDate != null) {
                    $darview->filterByEndDate($endDate, Criteria::LESS_THAN);
                }

                if ($type != "0") {
                    $darview->filterByType($type);
                }

                if ($brand != "0") {
                    $darview->filterByFocusBrandId($brand);
                }

                if ($classification != "0") {
                    $darview->filterByClassificationId($classification);
                }

                $count = $darview->count();
                $response["recordsTotal"] = $count;

                $count = $darview->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $darview->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
               
                break;

        endswitch;
    }

    public function empDateWiseExpense()
    {
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployee()->getEmployeeId());

        $emp = \entities\EmployeeQuery::create()->findPk($employeeId);
        $this->data['Name'] = $emp->getFirstName() . " " . $emp->getLastName();
        $this->data['empcode'] = $emp->getEmployeeCode();
        $this->data['costnumber'] = $emp->getCostNumber();
        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
        $this->data['Location'] = $emp->getBranch()->getBranchname() . " | " . $emp->getBranch()->getGeoState()->getSstatename();
        $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();

        $status = 8;
        $expenses = \entities\ExpensesQuery::create()
            ->joinWithBudgetGroup()
            ->joinWithCurrencies()
            ->filterByExpenseStatus(1, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($employeeId)
            ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
            ->find();

        $taxArray = [];
        $basicAmount = 0;
        $addTotal = 0;
        $gstTotal = 0;
        $basicaddgst = 0;
        $diductionbyapproval = 0;
        $cmpcardAmount = 0;
        $totalBasic = 0;
        $totaltAdd = 0;
        $totaltTax = 0;
        $totalAmount = 0;
        $totalDidbyapp = 0;
        $totalPaybleAmount = 0;
        $totalCmpCard = 0;
        $netpayableamount = 0;
        $finaldidAmount = 0;
        $cmpcard = 0;
        $TripCurrencyArray = [];
        $ExpenseFinalAmopuntArray = [];
        $tempArray = [];

        if ($expenses) {
            foreach ($expenses as $e) {
                array_push($TripCurrencyArray, $e->getTripCurrency());
                $list = $e->getExpenseLists();
                $dates = $e->getExpenseDate()->format('d-m-Y');
                if (!isset($taxArray[$dates])) {
                    $taxArray[$dates]['basicAmount'] = 0;
                    $taxArray[$dates]['addTotal'] = 0;
                    $taxArray[$dates]['gstTotal'] = 0;
                    $taxArray[$dates]['basicaddgst'] = 0;
                    $taxArray[$dates]['diductionbyapproval'] = 0;
                    $taxArray[$dates]['netpayableamount'] = 0;
                    $taxArray[$dates]['cmpcardAmount'] = 0;
                    $taxArray[$dates]['finaldidAmount'] = 0;
                }

                $currencyId = $e->getTripCurrency();
                if (!isset($tempArray[$currencyId])) {
                    $tempArray[$currencyId] = $e->getCurrencies()->getName();
                    $tempArray_total[$currencyId] = 0;
                }

                foreach ($list as $l) {
                    if (array_key_exists($dates, $taxArray)) {
                        $taxArray[$dates]['basicAmount'] += $l->getExpIlAmount();
                        $taxArray[$dates]['addTotal'] += $l->getExpReqAmount();
                        $taxArray[$dates]['gstTotal'] += $l->getExpTaxAmount();
                        $taxArray[$dates]['basicaddgst'] += $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                        $taxArray[$dates]['netpayableamount'] += $l->getExpFinalAmount();
                        $taxArray[$dates]['diductionbyapproval'] += $l->getExpAprAmount();
                        if ($l->getCmpCard() == 1) {
                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                        }
                    } else {
                        $taxArray[$dates]['basicAmount'] = $l->getExpIlAmount();
                        $taxArray[$dates]['addTotal'] = $l->getExpReqAmount();
                        $taxArray[$dates]['gstTotal'] = $l->getExpTaxAmount();
                        $taxArray[$dates]['basicaddgst'] = $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                        $taxArray[$dates]['netpayableamount'] = $l->getExpFinalAmount();
                        $taxArray[$dates]['diductionbyapproval'] = $l->getExpAprAmount();
                        if ($l->getCmpCard() == 1) {
                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                        }
                    }
                    if ($l->getCmpCard() == 1) {
                        $cmpcard += $l->getExpFinalAmount();
                    }
                    if (array_key_exists($currencyId, $tempArray_total)) {
                        $tempArray_total[$currencyId] += $l->getExpFinalAmount();
                    } else {
                        $tempArray_total[$currencyId] = $l->getExpFinalAmount();
                    }
                    $netpayableamount += $l->getExpFinalAmount();
                    $finaldidAmount += ($l->getExpAprAmount() - $l->getExpFinalAmount());
                    $totalBasic += $l->getExpIlAmount();
                    $totalAmount += $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                    $abc = $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                    $totalDidbyapp += $abc - $l->getExpAprAmount();
                }

                if ($e->getexpenseTrip() > 0) {
                    $working = "On Trip";
                } else {
                    $working = "HQ";
                }
                $taxArray[$dates]['Budget'] = $e->getBudgetGroup()->getGroupcode();
                $taxArray[$dates]['exphead'] = rtrim($e->getBudgetGroup()->getGroupName(), "-");
                $taxArray[$dates]['date'] = $dates;
                $taxArray[$dates]['working'] = $working;
                $totaltAdd += $e->getExpenseAdditionalAmt();
                $totaltTax += $e->getExpenseTaxAmt();
                $totalPaybleAmount += $e->getExpenseReqAmt() + $e->getExpenseAdditionalAmt() + $e->getExpenseTaxAmt() - ($e->getExpenseReqAmt() - $e->getExpenseApprovedAmt());
            }
        }

        $aaa = 0;
        if (!empty($tempArray_total)) {
            $aaa = array_combine($tempArray, $tempArray_total);
        }

        $this->data['heads'] = $taxArray;
        $this->data['totalBasic'] = $totalBasic;
        $this->data['totaltAdd'] = $totaltAdd;
        $this->data['totaltTax'] = $totaltTax;
        //$this->data['currSelected'] = $currencyArray[$currency];
        $this->data['totalAmount'] = $totalAmount;
        $this->data['totalDidbyapp'] = $totalDidbyapp;
        $this->data['totalPaybleAmount'] = $totalPaybleAmount;
        $this->data['totalCmpCard'] = $cmpcard;
        $this->data['netpayableamount'] = $netpayableamount;
        $this->data['currSelected'] = $aaa;
        $this->data['CurrList'] = $tempArray;

        $this->app->Renderer()->render("reports/dailyReports.twig", $this->data);
    }

    public function sgpiBrnadWiseDistribution()
    {
        // Discussed with chintan sir - we will render under construction page currently and needs to create a view for this report
        //return $this->app->Renderer()->render("underConstruction.twig");

        $action = $this->app->Request()->getParameter("action");

        $this->data['Title'] = 'SGPI Distribution';

        $month = $this->app->Request()->getParameter("month");
        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());

        $employee = \entities\EmployeeQuery::create()
            ->filterByEmployeeId($employeeId)
            ->findOne();
        $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);

        $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

        $employeePositionCode = \entities\PositionsQuery::create()
            ->select(['PositionCode'])
            ->filterByPositionId($positionArray)
            ->find()->toArray();

        switch ($action):
            case "":
                $sgpiReport = \entities\WriteSgpiQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode)
                    ->filterByMonth($month)
                    ->limit(250)
                    ->find()->toArray();
                break;
            case "download":
                $sgpiReport = \entities\WriteSgpiQuery::create()
                    ->filterByEmployeePositionCode($employeePositionCode)
                    ->filterByMonth($month)
                    ->find()->toArray();
                break;
        endswitch;

        $this->data['result'] = $sgpiReport;

        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/SgpiBrandDistribution.twig", $this->data);
                break;
            case "download":
                $objPHPExcel = new Spreadsheet();
                $objPHPExcel->getActiveSheet();

                $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Division');
                $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Employee Id');
                $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Employee Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Location');
                $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Location Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Dr Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Dr Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Dr Specialty');
                $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Month');
                $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'DR Tags');
                $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Brand');
                $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'SGPI Tagged');
                $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Brand SGPI Distributed');
                $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'MR Call Done');
                $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'AM Call Done');
                $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'RM Call Done');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'ZM Call Done');
                $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'ZM Position');
                $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'RM Position');
                $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'AM Position');
                $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'ZM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'RM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'AM Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Employee Position Code');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Employee Position Name');
                $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Employee Level');

                $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setBold(true);

                $rowCount = 2;
                foreach ($sgpiReport as $data) {
                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data['Division']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['EmployeeId']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['EmployeeName']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["Location"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['LocationCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['DrCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["DrName"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['DrSpecialty']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['Month']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["DrTags"]);
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['Brand']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['SgpiTagged']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data['BrandSgpiDistributed']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['MrCallDone']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['AmCallDone']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data['RmCallDone']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data['ZmCallDone']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['ZmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['RmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data['AmPosition']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['ZmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['RmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data['AmPositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['EmployeePositionCode']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['EmployeePositionName']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data['EmployeeLevel']);

                    $rowCount++;
                }

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="SgpiBrandWiseReport.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                break;
        endswitch;
    }

    public function transactionReport()
    {
        $this->data['Title'] = 'SGPI Transaction';
        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());

        $transaction = SgpiTransactionViewQuery::create()->filterByEmployeeId($employeeId)->find()->toArray();

        $this->data['result'] = $transaction;

        $this->app->Renderer()->render("reports/SgpiTransaction.twig", $this->data);
    }

    public function employeeReports()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['reportname'] = "TerritoriesReport";
        $this->data['title'] = "Territories Report";
        $monthlist = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))->label('Months')->class('months')->id('selectMonth');
        switch ($action):
            case "":
                $f = FormMgr::form();
                $f->add([
                    "month" => $monthlist,
                ]);
                $this->data['filters'] = $f->html();
                $this->data['cols'] = [
                    "Id" => "EmployeeId",
                    "FirstName" => "FirstName",
                    "LastName" => "LastName",
                    "EmployeeCode" => "EmployeeCode",
                    "Email" => "Email",
                    "Phone" => "Phone",
                    "PositionName" => "PositionName",
                    "Designation" => "Designation",
                    "OrgUnit" => "UnitName",
                    "GeoTowns" => "Stownname",
                    "Month" => "Month",
                ];
                $this->data['rowButtons'] = ["dar_month_report" => "zmdi zmdi-layers", "dvp_month_report" => "zmdi zmdi-eye", "mas_month_report" => "zmdi zmdi-eye", "sgpi_brand_month_report" => "zmdi zmdi-eye"];
                $this->app->Renderer()->render("reports/reportViewercopy.twig", $this->data);
                break;
            case "result":
                $month = explode("|", $this->app->Request()->getParameter("month", "|"));
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $getMonth = date('m-Y', strtotime($month[0]));

                $employeePosition = \entities\PositionsQuery::create()
                    ->filterByPositionId($employee->getPositionId())
                    ->findOne();

                $terExplode = [];
                if ($employeePosition != null && $employeePosition->getCavTerritories() != null) {
                    $terExplode = explode(',', $employeePosition->getCavTerritories());
                }


                $territoriesPosition = \entities\TerritoriesQuery::create()
                    ->select(['PositionId'])
                    ->joinWithPositions()
                    ->filterByTerritoryId($terExplode)
                    ->find()->toArray();

                // $managerPositions = \entities\PositionsQuery::create()
                //                         ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                //                         ->filterByPositionId($positionExplode)
                //                         ->find()->toArray();

                // $level1Employee = $level2Employee = $level3Employee = $townName;
                // $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
                // foreach ($managerPositions as $managerPosition) {
                //     if (str_starts_with($managerPosition['PositionCode'], '4')) {
                //         $level1Employee = $managerPosition["PositionName"];
                //         $level1PositionCode = $managerPosition["PositionCode"];
                //         $level1EmployeePositionId = $managerPosition["PositionId"];
                //     } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                //         $level2Employee = $managerPosition["PositionName"];
                //         $level2PositionCode = $managerPosition["PositionCode"];
                //         $level2EmployeePositionId = $managerPosition["PositionId"];
                //     } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                //         $level3Employee = $managerPosition["PositionName"];
                //         $level3PositionCode = $managerPosition["PositionCode"];
                //         $level3EmployeePositionId = $managerPosition["PositionId"];
                //     }
                // }

                // $level3 = isset($level3Employee) ? $level3Employee : null;
                // $level2 = isset($level2Employee) ? $level2Employee : null;
                // $level1 = isset($level1Employee) ? $level1Employee : null;

                // $level3Position = isset($level3EmployeePositionId) ? $level3EmployeePositionId : null;
                // $level2Position = isset($level2EmployeePositionId) ? $level2EmployeePositionId : null;
                // $level1Position = isset($level1EmployeePositionId) ? $level1EmployeePositionId : null;



                $employeeRec = EmployeeQuery::create()
                    ->select(['EmployeeId', 'FirstName', 'LastName', 'EmployeeCode', 'Email', 'Phone', 'PositionName', 'Designation', 'UnitName', 'Stownname'])
                    ->withColumn('PositionsRelatedByPositionId.PositionName', 'PositionName')
                    ->withColumn('Designations.Designation', 'Designation')
                    ->withColumn('OrgUnit.UnitName', 'UnitName')
                    ->withColumn('GeoTowns.Stownname', 'Stownname')
                    ->leftJoinWithDesignations()
                    ->leftJoinWithPositionsRelatedByPositionId()
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithOrgUnit()
                    ->filterByStatus(1)
                    ->filterByPositionId($territoriesPosition)
                    ->find()->toArray();
                foreach ($employeeRec as &$employeeRe) {
                    $employeeRe['Month'] = $getMonth;
                }

                $this->json(["aaData" => $employeeRec, 'month' => $getMonth]);
                break;
        endswitch;
    }

    public function darReportMonth()
    {

        $employeeId = $this->app->Request()->getParameter("employee_id");
        $month = $this->app->Request()->getParameter("month");

        $monthExplode = explode('-', $month);
        $dt = \DateTime::createFromFormat('m', $monthExplode[0]);
        $startDate = $dt->format('Y-m-1');
        $endDate = $dt->format('Y-m-t');

        $this->data['month'] = $month;
        $this->data['employee'] = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithOrgUnit()
            ->leftJoinWithPositionsRelatedByReportingTo()
            ->leftJoinWithGeoTowns()
            ->filterByEmployeeId($employeeId)
            ->findOne();

        if (isset($this->data['employee']["PositionsRelatedByReportingTo"]["PositionId"])) {
            $this->data['employeeManager'] = \entities\EmployeeQuery::create()
                ->filterByPositionId($this->data['employee']["PositionsRelatedByReportingTo"]["PositionId"])
                ->findOne();
            $this->data['employeeManagerName'] = $this->data['employeeManager']->getFirstName() . ' ' . $this->data['employeeManager']->getLastName();
        } else {
            $this->data['employeeManager'] = null;
            $this->data['employeeManagerName'] = null;
        }

        $darview = \entities\DarViewQuery::create()
            ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByPositionId($this->data['employee']['PositionId'])
            ->find()->toArray();

        $this->data['darData'] = array();
        foreach ($darview as $data) {
            $brandArray = array();
            if (isset($data["BrandsDetailed"])) {
                $brandIds = explode(',', $data["BrandsDetailed"]);
                foreach ($brandIds as $brandId) {
                    if ($brandId != null && $brandId != '') {
                        $brand = \entities\EdPresentationsQuery::create()
                            ->filterByPresentationId($brandId)
                            ->findOne();
                        if ($brand != null && $brand->getPresentationName() != null) {
                            array_push($brandArray, $brand->getPresentationName());
                        }
                    }
                }
            }
            $outConPo = \entities\OutletContributionPotentialQuery::create()
                ->filterByOutletId($data['OutletId'])
                ->filterByRcpaMoye(date('m-Y', strtotime($data["DcrDate"])))
                ->findOne();
            if ($data['DcrId'] != null) {
                $dcsgpi = \entities\DailycallsSgpioutQuery::create()
                    ->filterByDailycallId($data['DcrId'])
                    ->findOne();

                if ($dcsgpi != null) {
                    $beat = \entities\BeatOutletsQuery::create()
                        ->joinWithBeats()
                        ->filterByBeatOrgOutlet($dcsgpi->getOutletOrgdataId())
                        ->findOne();

                    $beatName = $beat->getBeats()->getBeatName();
                } else {
                    $beatName = '-';
                }
            } else {
                $beatName = '-';
            }

            $brandNameArray = implode(',', $brandArray);
            if (isset($outConPo) != null && $outConPo->getPotential() != null && $outConPo->getContribution() != null) {
                $outletPotential = $outConPo->getPotential();
                $outletContribution = $outConPo->getContribution();
            } else {
                $outletPotential = 0;
                $outletContribution = 0;
            }
            if (!empty($data['Stownname'])) {
                $townName = $data['Stownname'];
            } else {
                $townName = '-';
            }

            if ($data['Managers'] == null || $data['Managers'] == '') {
                $joint = 'No';
            } else {
                $joint = 'Yes';
            }

            if ($data["BrandsDetailed"] != null && $data["BrandsDetailed"] != '') {
                $edetailing = 'Yes';
            } else {
                $edetailing = 'No';
            }
            if ($data["SgpiOut"] != null && $data["SgpiOut"] != '') {
                $sgpi = 'Yes';
            } else {
                $sgpi = 'No';
            }

            $this->data['day'] = date('l', strtotime($data["DcrDate"]));

            $dayPlanned = \entities\DayplanQuery::create()
                ->select(['GeoTowns.Stownname'])
                ->leftJoinWithGeoTowns()
                ->filterByPositionId($this->data['employee']["PositionId"])
                ->filterByTpDate($data["DcrDate"])
                ->groupByItownid()
                ->find()->toArray();

            $this->data['dayplan'] = implode(",", $dayPlanned);

            if (isset($this->data['employee']['GeoTowns']['Stownname'])) {
                $empTown = $this->data['employee']['GeoTowns']['Stownname'];
            } else {
                $empTown = null;
            }

            $dataArray = array(
                "EmployeeName" => $this->data['employee']["FirstName"] . '' . $this->data['employee']["LastName"],
                "EmployeeCode" => $this->data['employee']["EmployeeCode"],
                "OrgUnitName" => $this->data['employee']['OrgUnit']['UnitName'],
                "ReportingTo" => $this->data['employeeManagerName'],
                "Date" => $data["DcrDate"],
                "Day" => $this->data['day'],
                "Town" => $empTown,
                "LocationPlanned" => $this->data['dayplan'],
                "Stownname" => $townName . ' / ' . $beatName,
                "OutletName" => $data['OutletName'],
                "Tags" => $data['Tags'],
                "Agenda" => $data['Agendacontroltype'] . ' / ' . $data['Agendname'],
                "JointWorking" => $joint,
                "Planned" => $data['Planned'],
                "CreatedAt" => date('d-m-Y H:i', strtotime($data['CreatedAt'])),
                "SgpiOut" => $data['SgpiOut'],
                "Brands" => $brandNameArray,
                "PobTotal" => $data['PobTotal'],
                "Potential" => $outletPotential,
                "Contribution" => $outletContribution,
                "Edetailing" => $edetailing,
                "Sgpi" => $sgpi,
            );
            array_push($this->data['darData'], $dataArray);
        }


        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->getActiveSheet();


        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Location/Account');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer Details');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Tags');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Agenda');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Joint Working');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Planned');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Sync Date/Time');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Input');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Brands detailed');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'POB Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'RCPA Potential');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'RCPA Contribution');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'E-Detailing');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'SGPI');

        $objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);

        $rowCount = 2;
        $counter = 1;
        foreach ($this->data['darData'] as $data) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $counter);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data["Stownname"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['OutletName']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["Tags"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['Agenda']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['JointWorking']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["Planned"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['CreatedAt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['SgpiOut']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["Brands"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['PobTotal']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Potential']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data["Contribution"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['Edetailing']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['Sgpi']);
            $rowCount++;
            $counter++;
        }

        $fileName = 'DAR_' . $this->data['employee']["EmployeeCode"] . '_' . $month . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel); //new Xls($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function dvpReportMonth()
    {
        ini_set('memory_limit', '-1');

        $monthselected = $this->app->Request()->getParameter("month");
        $monthExp = explode('|', $monthselected);
        $month = date('m-Y', strtotime($monthExp[0]));

        $employee = $employee = $this->app->Auth()->getUser()->getEmployee();
        $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);
        $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

        $employeeCode = \entities\EmployeeQuery::create()
            ->select(['EmployeeCode'])
            ->filterByPositionId($positionArray)
            ->find()->toArray();

        $dvpReport = \entities\WriteDvpQuery::create()
            ->filterByEmployeeCode($employeeCode)
            ->filterByMonth($month)
            ->find()->toArray();


        if (count($dvpReport) > 0) {
            $result = [];
            foreach ($dvpReport as $data) {

                $result[] = [
                    "OrgUnit" => $data['OrgUnit'],
                    "EmployeeCode" => $data['EmployeeCode'],
                    "JoiningDate" => $data['JoiningDate'],
                    "AmPosition" => $data['AmPosition'],
                    "RmPosition" => $data['RmPosition'],
                    "ZmPosition" => $data['ZmPosition'],
                    "Location" => $data['Location'],
                    "Status" => $data['Status'],
                    "EmployeeName" => $data['EmployeeName'],
                    "DoctorName" => $data['DoctorName'],
                    "DoctorCode" => $data['DoctorCode'],
                    "Town" => $data['Town'],
                    "Patch"  => $data['Patch'],
                    "Speciality" => $data['Speciality'],
                    "Tags" => $data['Tags'],
                    "VisitFq" => $data['VisitFq'],
                    "PrescriberClassification" => $data['PrescriberClassification'],
                    "TopBrand" => $data['TopBrand'],
                    "VisitDr" => $data['VisitDr'],
                    "AmVisitDr" => $data['AmVisitDr'],
                    "RmVisitDr" => $data['RmVisitDr'],
                    "ZmVisitDr" => $data['ZmVisitDr'],
                    "RcpaDone" => $data['RcpaDone'],
                    "RcpaLmOwn" => $data['RcpaLmOwn'],
                    "RcpaLmComp" => $data['RcpaLmComp'],
                    "RcpaCmOwn" => $data['RcpaCmOwn'],
                    "RcpaCmComp" => $data['RcpaCmComp'],
                    "SamplesSgpi" => $data['SamplesSgpi'],
                    "GiftsSgpi" => $data['GiftsSgpi'],
                    "PromoSgpi" => $data['PromoSgpi'],
                    "ZmPositionCode" => $data['ZmPositionCode'],
                    "RmPositionCode" => $data['RmPositionCode'],
                    "AmPositionCode" => $data['AmPositionCode'],
                    "EmployeePositionCode" => $data['EmployeePositionCode'],
                    "EmployeePosition" => $data['EmployeePosition'],
                    "EmployeeLevel" => $data['EmployeeLevel'],
                    "Month" => $data['Month'],
                ];
            }
            $fileName = 'DVP_' . $employee->getEmployeeCode() . '_' . $month;
            $this->download_array_csv(array_values($result), $fileName . ".csv");
            exit;
        } else {
            $this->data['errorMsg'] = 'Data not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }




        // $objPHPExcel = new Spreadsheet();
        // $objPHPExcel->getActiveSheet();

        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'OrgUnit');
        // $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'EmployeeCode');
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'JoiningDate');
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Level3');
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Level2');
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Level1');
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Location');
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Status');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'EmployeeName');
        // $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'DoctorName');
        // $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'DoctorCode');
        // $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Town');
        // $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Patch');
        // $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Speciality');
        // $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Tags');
        // $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'VisitFq');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'PrescriberClassification');
        // $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'TopBrand');
        // $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'VisitDr');
        // $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'AmVisitDr');
        // $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'RmVisitDr');
        // $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'ZmVisitDr');
        // $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'RcpaDone');
        // $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'RCPA-LM-OWN');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'RCPA-LM-COMP');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'RCPA-CM-OWN');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'RCPA-CM-COMP');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'Sample');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Gift');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'Promo');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AE1', "ZM Position Code");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AF1', "RM Position Code");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AG1', "AM Position Code");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AH1', "Employee Position Code");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AI1', "Employee Position");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AJ1', "Employee Level");
        // $objPHPExcel->getActiveSheet()->SetCellValue('AK1', "Month");
        // $objPHPExcel->getActiveSheet()->getStyle("A1:AK1")->getFont()->setBold(true);

        // $rowCount = 2;
        // foreach ($dvpReport as $data) {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data["OrgUnit"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['EmployeeCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['JoiningDate']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["AmPosition"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['RmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['ZmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data['Location']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['Status']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['EmployeeName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["DoctorName"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['DoctorCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Town']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data["Patch"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['Speciality']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['Tags']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data["VisitFq"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data["PrescriberClassification"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['TopBrand']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['VisitDr']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data["AmVisitDr"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['RmVisitDr']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['ZmVisitDr']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data["RcpaDone"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['RcpaLmOwn']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['RcpaLmComp']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data["RcpaCmOwn"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, $data['RcpaCmComp']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $data["SamplesSgpi"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $data["GiftsSgpi"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, $data["PromoSgpi"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $rowCount, $data["ZmPositionCode"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowCount, $data["RmPositionCode"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $rowCount, $data["AmPositionCode"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $rowCount, $data["EmployeePositionCode"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AI' . $rowCount, $data["EmployeePosition"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AJ' . $rowCount, $data["EmployeeLevel"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AK' . $rowCount, $data["Month"]);

        //     $rowCount++;
        // }

        // $fileName = 'DVP_' . $employee->getEmployeeCode() . '_' . $month . '.xlsx';
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename=' . $fileName);
        // header('Cache-Control: max-age=0');
        // $writer->save('php://output');
    }


    public function masReportMonth()
    {
        ini_set('memory_limit', '-1');
        $monthselected = $this->app->Request()->getParameter("month");
        $monthExp = explode('|', $monthselected);
        $month = date('m-Y', strtotime($monthExp[0]));
        if ($this->app->Auth()->checkPerm('all_emp_perm') == false) {
            $employee = $employee = $this->app->Auth()->getUser()->getEmployee();
            $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);
            $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

            $employeeCode = \entities\EmployeeQuery::create()
                ->select(['EmployeeCode'])
                ->filterByPositionId($positionArray)
                ->find()->toArray();

            $masReport = \entities\WriteMasQuery::create()
                ->filterByEmployeeCode($employeeCode)
                ->filterByMonthYear($month)
                ->find()->toArray();
            /// print_r($masReport);die;
        } else {

            $masReport = \entities\WriteMasQuery::create()
                //->filterByEmployeeCode($employeeCode)
                ->filterByMonthYear($month)
                ->find()->toArray();
        }
        if (count($masReport) > 0) {
            $result = [];
            foreach ($masReport as $data) {

                $result[] = [
                    "OrgUnitName" => $data['OrgUnitName'],
                    "RepCode" => $data['RepCode'],
                    "EmployeeCode" => $data['EmployeeCode'],
                    "EmployeeName" => $data["EmployeeName"],
                    "AmPosition" => $data['AmPosition'],
                    "RmPosition" => $data['RmPosition'],
                    "ZmPosition" => $data["ZmPosition"],
                    "Location" => $data['Location'],
                    "MonthYear" => $data['MonthYear'],
                    "Fwd" => $data["Fwd"],
                    "WorkingDays" => $data['WorkingDays'],
                    "Nca" => $data['Nca'],
                    "TotalDoctors"  => $data['TotalDoctors'],
                    "DrMet" => $data['DrMet'],
                    "DrVfMet" => $data['DrVfMet'],
                    "DrcaL" => $data['DrcaL'],
                    "Drcvrg" => $data['Drcvrg'],
                    "Drvfcvrg" => $data['Drvfcvrg'],
                    "MissedDr" => $data['MissedDr'],
                    "MissedDrCalls" => $data['MissedDrCalls'],
                    "TotalChemist" => $data['TotalChemist'],
                    "PobValue" => $data['PobValue'],
                    "RcpaValueForOwnBrand" => $data['RcpaValueForOwnBrand'],
                    "RcpaValueForCompBrand" => $data['RcpaValueForCompBrand'],
                    "JointWorkTotalCalls" => $data['JointWorkTotalCalls'],
                    "LeaveDays" => $data['LeaveDays'],
                    "JointWorking" => $data['JointWorking'],
                    "NoDrCall" => $data['NoDrCall'],
                    "Agenda" => $data['Agenda'],
                    "ZmPositionCode" => $data['ZmPositionCode'],
                    "RmPositionCode" => $data['RmPositionCode'],
                    "AmPositionCode" => $data['AmPositionCode'],
                    "EmployeeStatus" => $data['EmployeeStatus'],
                    "EmployeePositionCode" => $data['EmployeePositionCode'],
                    "EmployeePositionName" => $data['EmployeePositionName'],
                    "EmployeeLevel" => $data['EmployeeLevel'],
                ];
            }

            $fileName = 'MAS_' . $employee->getEmployeeCode() . '_' . $month;
            $this->download_array_csv(array_values($result), $fileName . ".csv");
            exit;
        } else {
            $this->data['errorMsg'] = 'Data not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }


        // $objPHPExcel = new Spreadsheet();
        // $objPHPExcel->getActiveSheet();

        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'BU NAME');
        // $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'REPCODE');
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'EMPLOYEE Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'USER');
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Zonal Manager');
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Regional Manager');
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Area Manager');
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'LOCATION');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'MONTH/YEAR');
        // $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'FWD');
        // $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Working days');
        // $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'NCA');
        // $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'TOTAL DOCTORS');
        // $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'DR MET');
        // $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Dr Met as per VF');
        // $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Dr call Avg');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'DR CVRG %');
        // $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'DR VF CVRG %');
        // $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Missed Dr');
        // $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'MISSED DR CALLS');
        // $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'TOTAL CHEMIST');
        // $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'POB Value');
        // $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'RCPA value for own brand');
        // $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'RCPA value for Comp brand');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'JOINT WORK Total Calls');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'LEAVE DAYS');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Joint Working');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'No. of Dr Calls');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'Agenda');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'ZM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'RM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'AM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'Employee Status');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'Employee Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AI1', 'Employee Position Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('AJ1', 'Employee Level');
        // $objPHPExcel->getActiveSheet()->getStyle("A1:AJ1")->getFont()->setBold(true);

        // $rowCount = 2;
        // foreach ($masReport as $data) {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data['OrgUnitName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['RepCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['EmployeeCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data['EmployeeName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['AmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['RmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data['ZmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['Location']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['MonthYear']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data['Fwd']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['WorkingDays']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['Nca']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data['TotalDoctors']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['DrMet']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['DrVfMet']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data['DrcaL']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data['Drcvrg']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['Drvfcvrg']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['MissedDr']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data['MissedDrCalls']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['TotalChemist']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['PobValue']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data['RcpaValueForOwnBrand']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['RcpaValueForCompBrand']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['JointWorkTotalCalls']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data['LeaveDays']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, $data['JointWorking']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, $data['NoDrCall']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, $data['Agenda']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, $data['ZmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $rowCount, $data['RmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowCount, $data['AmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $rowCount, $data['EmployeeStatus']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $rowCount, $data['EmployeePositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AI' . $rowCount, $data['EmployeePositionName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('AJ' . $rowCount, $data['EmployeeLevel']);

        //     $rowCount++;
        // }

        // $fileName = 'MAS_' . $employee->getEmployeeCode() . '_' . $month . '.xlsx';
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename=' . $fileName);
        // header('Cache-Control: max-age=0');
        // $writer->save('php://output');
    }

    public function sgpiBrandReportMonth()
    {
        ini_set('memory_limit', '-1');

        $monthselected = $this->app->Request()->getParameter("month");
        $monthExp = explode('|', $monthselected);
        $month = date('m-Y', strtotime($monthExp[0]));

        $employee = $employee = $this->app->Auth()->getUser()->getEmployee();
        $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);
        $positionArray = array_merge($emp_position_ids, [$employee->getPositionId()]);

        $employeeIds = \entities\EmployeeQuery::create()
            ->select(['EmployeeId'])
            ->filterByPositionId($positionArray)
            ->find()->toArray();

        $sgpiReport = \entities\WriteSgpiQuery::create()
            ->filterByEmployeeId($employeeIds)
            ->filterByMonth($month)
            ->find()->toArray();
        if (count($sgpiReport) > 0) {
            $result = [];
            foreach ($sgpiReport as $data) {

                $result[] = [
                    "Division" => $data['Division'],
                    "EmployeeId" => $data['EmployeeId'],
                    "EmployeeName" => $data['EmployeeName'],
                    "EmployeePositionName" => $data["EmployeePositionName"],
                    "LocationCode" => $data['LocationCode'],
                    "DrCode" => $data['DrCode'],
                    "DrName" => $data["DrName"],
                    "DrSpecialty" => $data['DrSpecialty'],
                    "Month" => $data['Month'],
                    "DrTags" => $data["DrTags"],
                    "Brand" => $data['Brand'],
                    "SgpiTagged" => $data['SgpiTagged'],
                    "BrandSgpiDistributed"  => $data['BrandSgpiDistributed'],
                    "MrCallDone" => $data['MrCallDone'],
                    "AmCallDone" => $data['AmCallDone'],
                    "RmCallDone" => $data['RmCallDone'],
                    "ZmCallDone" => $data['ZmCallDone'],
                    "ZmPosition" => $data['ZmPosition'],
                    "RmPosition" => $data['RmPosition'],
                    "AmPosition" => $data['AmPosition'],
                    "ZmPositionCode" => $data['ZmPositionCode'],
                    "RmPositionCode" => $data['RmPositionCode'],
                    "AmPositionCode" => $data['AmPositionCode'],
                    "EmployeePositionCode" => $data['EmployeePositionCode'],
                    "EmployeePositionName" => $data['EmployeePositionName'],
                    "EmployeeLevel" => $data['EmployeeLevel'],
                ];
            }

            $fileName = 'SGPI_' . $employee->getEmployeeCode() . '_' . $month;
            $this->download_array_csv(array_values($result), $fileName . ".csv");
            exit;
        } else {
            $this->data['errorMsg'] = 'Data not found!';
            return $this->app->Renderer()->render("error.twig", $this->data);
        }


        // $objPHPExcel = new Spreadsheet();
        // $objPHPExcel->getActiveSheet();

        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Division');
        // $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Employee Id');
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Employee Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Location');
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Location Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Dr Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Dr Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Dr Specialty');
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Month');
        // $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'DR Tags');
        // $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Brand');
        // $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'SGPI Tagged');
        // $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Brand SGPI Distributed');
        // $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'MR Call Done');
        // $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'AM Call Done');
        // $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'RM Call Done');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'ZM Call Done');
        // $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'ZM Position');
        // $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'RM Position');
        // $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'AM Position');
        // $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'ZM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'RM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'AM Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Employee Position Code');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Employee Position Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Employee Level');

        // $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setBold(true);

        // $rowCount = 2;
        // foreach ($sgpiReport as $data) {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data['Division']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['EmployeeId']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['EmployeeName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data["EmployeePositionName"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['LocationCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['DrCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data["DrName"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['DrSpecialty']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['Month']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data["DrTags"]);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['Brand']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['SgpiTagged']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data['BrandSgpiDistributed']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['MrCallDone']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data['AmCallDone']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data['RmCallDone']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data['ZmCallDone']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $data['ZmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $data['RmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $data['AmPosition']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $data['ZmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $data['RmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $data['AmPositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $data['EmployeePositionCode']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $data['EmployeePositionName']);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $data['EmployeeLevel']);
        //     $rowCount++;
        // }

        // $fileName = 'SGPI_' . $employee->getEmployeeCode() . '_' . $month . '.xlsx';
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename=' . $fileName);
        // header('Cache-Control: max-age=0');
        // $writer->save('php://output');
    }

    public function prescriberDataReport()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['Title'] = 'Prescriber Data Report';
        $positionId = $this->app->Request()->getParameter("position_id");
        $brandId = $this->app->Request()->getParameter("brand_id");
        $moye = $this->app->Request()->getParameter("moye");
        $status = $this->app->Request()->getParameter("status");
        $rcpa = $this->app->Request()->getParameter("rcpa");
        $visits = $this->app->Request()->getParameter("visits");
        if ($positionId == '' || $positionId == null) {
            $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        }
        $data1 = [];
        $result = [];
        switch ($action):
            case "":
                if ($positionId != null && $moye != null) {
                    $positions = OrgManager::getUnderPositions($positionId);
                    $positionIds = array_merge($positions, [$positionId]);

                    $prescriberdata = \entities\PrescriberDataQuery::create()
                        ->limit(250)
                        ->filterByPositionId($positionIds)
                        ->filterByMoye($moye);
                    if ($status != null && $status != "") {
                        $prescriberdata =   $prescriberdata->filterByCmRxberCat($status);
                    }
                    if ($brandId != "" && $brandId != 'All') {
                        $prescriberdata =   $prescriberdata->filterByBrandId($brandId);
                    }
                    if ($rcpa != null && $rcpa != 'All') {
                        $prescriberdata = $prescriberdata->filterByCmRcpa($rcpa);
                    }
                    if ($visits != null &&  $visits != 'All') {
                        $prescriberdata = $prescriberdata->filterByCmVisit($visits);
                    }
                    $prescriberdata =   $prescriberdata->joinWithOutletOrgData()->find()->toArray();

                    foreach ($prescriberdata as $row) {

                        $mrLoc = \entities\EmployeeQuery::create()
                            ->filterByPositionId($row['PositionId'])
                            ->findOne();
                        if ($mrLoc) {
                            $mrlocation = \entities\GeoTownsQuery::create()
                                ->select('stownname')
                                ->filterByItownid($mrLoc->getItownid())
                                ->findOne();
                            $row['MrLocation'] = $mrlocation;
                        }


                        $unitName = \entities\OrgUnitQuery::create()
                            ->select('unit_name')
                            ->filterByOrgunitid($row['OrgunitId'])
                            ->findOne();
                        $row['UnitName'] = $unitName;

                        $doctor = \entities\OutletsQuery::create()
                            ->select(['outlet_qualification', 'outlet_code', 'outlet_name', 'itownid'])
                            ->filterById($row['OutletOrgData']['OutletId'])
                            ->findOne();
                        $row['DoctorCode'] = $doctor['outlet_code'];
                        $row['DoctorName'] = $doctor['outlet_name'];
                        $row['SPECIALITY'] = $doctor['outlet_qualification'];

                        $patch = \entities\GeoTownsQuery::create()
                            ->select('stownname')
                            ->filterByItownid($doctor['itownid'])
                            ->findOne();

                        $row['Patch'] = $patch;

                        $brand = \entities\BrandsQuery::create()
                            ->select('brand_name')
                            ->filterByBrandId($row['BrandId'])
                            ->findOne();
                        $row['Brand'] =  $brand;

                        $data1[] = $row;
                    }
                }

                break;
            case "download":
                if ($positionId != null && $moye != null) {
                    $positions = OrgManager::getUnderPositions($positionId);
                    $positionIds = array_merge($positions, [$positionId]);

                    $prescriberdata = \entities\PrescriberDataQuery::create()
                        ->filterByPositionId($positionIds)
                        ->filterByMoye($moye);
                    if ($status != null && $status != "") {
                        $prescriberdata =   $prescriberdata->filterByCmRxberCat($status);
                    }
                    if ($brandId != 'All') {
                        $prescriberdata = $prescriberdata->filterByBrandId($brandId);
                    }
                    if ($rcpa != null && $rcpa != 'All') {
                        $prescriberdata = $prescriberdata->filterByCmRcpa($rcpa);
                    }
                    if ($visits != null && $visits != 'All') {
                        $prescriberdata = $prescriberdata->filterByCmVisit($visits);
                    }
                    $prescriberdata =   $prescriberdata->joinWithOutletOrgData()->find()->toArray();

                    foreach ($prescriberdata as $row) {

                        $mrLoc = \entities\EmployeeQuery::create()
                            ->filterByPositionId($row['PositionId'])
                            ->findOne();
                        if ($mrLoc) {
                            $mrlocation = \entities\GeoTownsQuery::create()
                                ->select('stownname')
                                ->filterByItownid($mrLoc->getItownid())
                                ->findOne();
                            $row['MrLocation'] = $mrlocation;
                        }

                        $unitName = \entities\OrgUnitQuery::create()
                            ->select('unit_name')
                            ->filterByOrgunitid($row['OrgunitId'])
                            ->findOne();
                        $row['UnitName'] = $unitName;

                        $doctor = \entities\OutletsQuery::create()
                            ->select(['outlet_qualification', 'outlet_code', 'outlet_name', 'itownid'])
                            ->filterById($row['OutletOrgData']['OutletId'])
                            ->findOne();
                        $row['DoctorCode'] = $doctor['outlet_code'];
                        $row['DoctorName'] = $doctor['outlet_name'];
                        $row['SPECIALITY'] = $doctor['outlet_qualification'];

                        $patch = \entities\GeoTownsQuery::create()
                            ->select('stownname')
                            ->filterByItownid($doctor['itownid'])
                            ->findOne();

                        $row['Patch'] = $patch;

                        $brand = \entities\BrandsQuery::create()
                            ->select('brand_name')
                            ->filterByBrandId($row['BrandId'])
                            ->findOne();
                        $row['Brand'] =  $brand;

                        $data1[] = $row;
                    }
                }
                break;
        endswitch;

        $this->data['result'] = $data1;
        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/PrescriberDataView.twig", $this->data);
                break;
            case "download":

                foreach ($data1 as $data) {

                    $result[] = [
                        "UnitName" => $data['UnitName'],
                        "MrLocation" => $data['MrLocation'],
                        "DoctorCode" => $data['DoctorCode'],
                        "DoctorName" => $data['DoctorName'],
                        "SPECIALITY" => $data['SPECIALITY'],
                        "Brand" => $data['Brand'],
                        "Patch" => $data['Patch'],
                        "CutOff" => $data['CutOff'],
                        "LmRcpaValue" => $data["LmRcpaValue"],
                        "CmRcpaValue" => $data['CmRcpaValue'],
                        "LmVisit" => $data['LmVisit'],
                        "CmVisit" => $data["CmVisit"],
                        "LmRcpa" => $data["LmRcpa"],
                        "CmRcpa" => $data['CmRcpa'],
                        "CmRxberCat" => $data['CmRxberCat'],

                    ];
                }

                $fileName = 'PrescriberTallyReport';
                $this->download_array_csv(array_values($result), $fileName . ".csv");
                exit;
                break;
        endswitch;

        // if (count($this->data['prescriberData']) > 0) {
        //     switch ($action):
        //         case "":
        //             $this->app->Renderer()->render("reports/PrescriberDataView.twig", $this->data);
        //             break;
        //         case "download":

        //             break;
        //     endswitch;
        // } else {
        //     $this->data['errorMsg'] = 'Prescriber data not found!';
        //     return $this->app->Renderer()->render("error.twig", $this->data);
        // }
    }

    public function prescriberLadder($terId, $br = null, $mon = null, $sts = null)
    {
        ini_set('memory_limit', '-1');
        $classification = $this->app->Request()->getParameter("classification", "All");
        $outletTag = $this->app->Request()->getParameter("outlet_tag_id", "All");
        $date = date('m-Y');
        //print_r($date);die;

        $outletView = [];
        if ($outletTag != "All") {
            $outletView = OutletViewQuery::create()
                ->select(['Outlet_Id'])
                ->filterByTags($outletTag . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->find()->toArray();
        }

        // getting raxers outlet
        if ($classification == "All") {

            $rcpaData = \entities\RcpaSummaryQuery::create()
                ->select(['outlet_id', 'min_value', 'own', 'RcpaMoye', 'OutletClassification'])
                ->withColumn('COUNT(*)', 'count')
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($date)
                ->filterByOwn(0, Criteria::GREATER_THAN)
                ->groupByOutletId()
                ->orderBy('count');

            if ($outletTag != "All") {
                $rcpaData->filterByOutletId($outletView);
            }
            $rcpaData = $rcpaData->find()
                ->toArray();
        } else {
            $rcpaData = \entities\RcpaSummaryQuery::create()
                ->select(['outlet_id', 'min_value', 'own'])
                ->withColumn('COUNT(*)', 'count')
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($date)
                ->filterByOutletClassification($classification)
                ->filterByOwn(0, Criteria::GREATER_THAN)
                //                ->filterByOwn(null, Criteria::NOT_EQUAL)
                //                ->filterByCompetition(0)
                ->groupByOutletId()
                ->orderBy('count');

            if ($outletTag != "All") {
                $rcpaData->filterByOutletId($outletView);
            }
            $rcpaData = $rcpaData->find()
                ->toArray();
        }
        // print_r($rcpaData);die;
        $rcpas = [];
        foreach ($rcpaData as $rc) {
            if ($rc['own'] >= $rc['min_value']) {
                $rcpas[] = $rc;
            }
        }
        //        var_dump(count($rcpas));exit;

        // Initialize an empty result array
        $resultArray = [];

        // Loop through the input array
        foreach ($rcpas as $item) {
            $outletId = $item['outlet_id'];
            // If the outlet_id is already in the result array, increment the count
            if (isset($resultArray[$outletId])) {

                $resultArray[$outletId]['count'] += 1;
            } else {
                // If outlet_id is not in the result array, create a new entry
                $resultArray[$outletId] = [
                    'outlet_id' => $outletId,
                    'count' => 1,
                ];
            }
        }

        $outlets = OutletViewQuery::create()
            ->select(['id'])
            ->filterByTerritoryId($terId)->filterByOutlettypeName("Doctor");

        if ($classification != "All") {
            $outlets->filterByOutletClassification($classification);
        }

        if ($outletTag != "All") {
            $outlets->filterByOutlet_Id($outletView);
        }
        $outlets = $outlets->find()
            ->toArray();
        if ($br != null && $mon != null && $terId != null) {
            $arr = [];
            $raxers = [];
            $nonRaxers = [];
            $order = [];

            $brandData = \entities\BrandsQuery::create()
                ->filterByBrandId($br)
                ->findOne()->toArray();
            $minVal = $brandData['MinValue'];
            $array = [];
            $raxers = \entities\RcpaSummaryQuery::create()
                //->select(['outlet_id','own'])
                ->filterByBrandId($br)
                ->filterByRcpaMoye($mon)
                ->filterByOwn(0, Criteria::GREATER_THAN)
                ->filterByTerritoryId($terId);

            if ($classification != "All") {
                $raxers->filterByOutletClassification($classification);
            }

            if ($outletTag != "All") {
                $raxers->filterByOutletId($outletView);
            }

            $raxers = $raxers->find()
                ->toArray();

            $raxerData = [];
            foreach ($raxers as $rx) {
                if ($rx['Own'] >= $minVal) {
                    $raxerData[] = $rx['OutletId'];
                }
            }
            if ($sts == 'raxers') {
                $array = $raxerData;
            }
            if ($sts == 'non_raxers') {
                $array = array_diff($outlets, $raxerData);
            }
            $data1['Brand'] = $array;
        } else {

            $oneBrand = [];
            $twoBrand = [];
            $threeBrand = [];
            $moreThanThreeBrand = [];
            $totRaxers = [];
            $atRaxers = [];

            foreach ($resultArray as $d) {
                if ($d['count'] == 1) {
                    $oneBrand[] = $d['outlet_id'];
                }
                if ($d['count'] == 2) {
                    $twoBrand[] = $d['outlet_id'];
                }
                if ($d['count'] == 3) {
                    $threeBrand[] = $d['outlet_id'];
                }
                if ($d['count'] > 3) {
                    $moreThanThreeBrand[] = $d['outlet_id'];
                }
            }

            $totRaxers = array_merge($oneBrand, $twoBrand, $threeBrand, $moreThanThreeBrand);
            $atRaxers = array_values(array_diff($outlets, $totRaxers));

            $data1['total'] = $outlets;
            $data1['one_brand'] = $oneBrand;
            $data1['two_brand'] = $twoBrand;
            $data1['three_brand'] = $threeBrand;
            $data1['more_three_brand'] = $moreThanThreeBrand;
            $data1['no_raxers'] = $atRaxers;
        }
        return $data1;
    }

    public function JWReport()
    {   
        $action = $this->app->Request()->getParameter("action");
        $month = $this->app->Request()->getParameter("month");
        $positionId = $this->app->Request()->getParameter("position_id");
         
        $positionCode = \entities\PositionsQuery::create()
                        ->select('PositionCode')
                        ->filterByPositionId($positionId)
                        ->find()->toArray();
        switch ($action):
            case "":
                $JwReport = \entities\JwReportViewQuery::create()
                    ->filterByUserPositionCode($positionCode)
                    ->filterByMonthYear($month)
                    ->limit(250)
                    ->find()->toArray();
                break;
            case "download":
                $JwReport = \entities\JwReportViewQuery::create()
                    ->filterByUserPositionCode($positionCode)
                    ->filterByMonthYear($month)
                    ->limit(250)
                    ->find()->toArray();
                break;
        endswitch;
        $this->data['EmployeeData'] = $JwReport;

        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/JwView.twig", $this->data);
                break;
            case "download":
              if (count($JwReport) > 0) 
              {  
                $result = [];
                foreach ($JwReport as $data) 
                {
                    $result[] = [
                        "UserPositionCode" => $data["UserPositionCode"],
                        "UserHqName" => $data["UserHqName"],
                        "UserName" => $data['UserName'],
                        "UserEmpCode" => $data["UserEmpCode"],
                        "UserLevel" => $data['UserLevel'],
                        "JwHqName" => $data['JwHqName'],
                        "JwEmployeeName" => $data["JwEmployeeName"],
                        "JwEmpCode" => $data['JwEmpCode'],
                        "JwPositionCode" => $data['JwPositionCode'],
                        "JwEmpLevel" => $data["JwEmpLevel"],
                        "NoOfJwDaysWorked" => $data['NoOfJwDaysWorked'],
                        "NoOfCallsJw" => $data['NoOfCallsJw'],
                        "CallAverage" => $data["CallAverage"],
                        "MonthYear" => $data['MonthYear'],
                    ];
                }

                $fileName = 'Joint Working Report';
                $this->download_array_csv(array_values($result), $fileName . ".csv");
                exit;
              } else {
                $this->data['errorMsg'] = 'Data not found!';
                return $this->app->Renderer()->render("error.twig", $this->data);
              }  
            break;
        endswitch;
    }

    public function MtpDeviationReport()
    { 
        $action = $this->app->Request()->getParameter("action");
        $date = $this->app->Request()->getParameter("date");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $startDate = date("Y-m-01", strtotime($date));
        $previousDate= date('Y-m-d', strtotime($date . ' -1 day'));
        
        $emp_position_ids = \BI\manager\OrgManager::getMyPositions($employee);
        
        switch ($action):
            case "":
                $mtpReport = \entities\MtpDeviationViewQuery::create()
                    ->filterByPositionId($emp_position_ids)
                    ->filterByDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDate($previousDate, Criteria::LESS_EQUAL)
                    ->limit(250)
                    ->find()->toArray();
                    
                foreach ($mtpReport as $key => $data) // Use the index to update the array
                { 
                    // Split and trim the PlannedPatch and CoveredPatch values, handling null cases
                    $patch1 = !empty($data['PlannedPatch']) ? array_map('trim', explode(",", $data['PlannedPatch'])) : [];
                    $patch2 = !empty($data['CoveredPatch']) ? array_map('trim', explode(",", $data['CoveredPatch'])) : [];

                    // Find the intersection of the planned and covered patches
                    $intersect = array_intersect($patch1, $patch2);
                    // Calculate the number of patches in the intersection and the total planned patches
                    $countIntersect = count($intersect);
                    $countPlanned = count($patch1);
                    // Calculate the deviation percentage for patches
                    $deviation = ($countPlanned > 0) ? abs((($countIntersect / $countPlanned) * 100) - 100) : 0;  
                    // Split and trim the PlannedTown and CoveredTown values, handling null cases
                    $town1 = !empty($data['Plannedtown']) ? array_map('trim', explode(",", $data['Plannedtown'])) : [];
                    $town2 = !empty($data['Coveredtown']) ? array_map('trim', explode(",", $data['Coveredtown'])) : [];

                    // Find the intersection of the planned and covered towns
                    $intersectTown = array_intersect($town1, $town2);
                    // Calculate the number of towns in the intersection and the total planned towns
                    $countIntersectTown = count($intersectTown);
                    $countPlannedTown = count($town1);
                    // Calculate the deviation percentage for towns
                    $deviationTown = ($countPlannedTown > 0) ? abs((($countIntersectTown / $countPlannedTown) * 100) - 100) : 0;

                    $doctorPlanned = !empty($data['DoctorPlanned']) ? (int)$data['DoctorPlanned'] : 0;
                    $doctorCovered = !empty($data['DoctorCovered']) ? (int)$data['DoctorCovered'] : 0;
                    // Calculate the doctor deviation percentage
                    $doctorDeviation = ($doctorPlanned > 0) ? abs((($doctorCovered / $doctorPlanned) * 100) - 100) : 0;  
                    // Convert RetailerPlanned and RetailerCovered to integers
                    $retailerPlanned = !empty($data['RetailerPlanned']) ? (int)$data['RetailerPlanned'] : 0;
                    $retailerCovered = !empty($data['RetailerCovered']) ? (int)$data['RetailerCovered'] : 0;
                    // Calculate the retailer deviation percentage as float
                    $retailerDeviation = ($retailerPlanned > 0) ? abs((($retailerCovered / $retailerPlanned) * 100) - 100) : 0;
                    // Convert StockistPlanned and StockistCovered to integers
                    $stockistPlanned = !empty($data['StokiestPlanned']) ? (int)$data['StokiestPlanned'] : 0;
                    $stockistCovered = !empty($data['StokiestCovered']) ? (int)$data['StokiestCovered'] : 0;
                    // Calculate the stockist deviation percentage as float
                    $stockistDeviation = ($stockistPlanned > 0) ? abs((($stockistCovered / $stockistPlanned) * 100) - 100) : 0;

                    $mtpReport[$key]['PatchDeviation'] = (int)$deviation;
                    $mtpReport[$key]['TownDeviation'] = (int)$deviationTown;
                    $mtpReport[$key]['DoctorDeviation']=(int)$doctorDeviation;
                    $mtpReport[$key]['RetailerDeviation'] = (int)$retailerDeviation;
                    $mtpReport[$key]['StockistDeviation'] = (int)$stockistDeviation;

                    $leave = \entities\LeavesQuery::create()
                                ->filterByLeaveDate($data['Date'])
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->find()->toArray();
                    if(!empty($leave)) {
                        $mtpReport[$key]['ActualActivity']='Leave';
                    }                       
                }
                    
                break;
            case "download":
                
                $mtpReport = \entities\MtpDeviationViewQuery::create()
                    ->filterByPositionId($emp_position_ids)
                    ->filterByDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDate($previousDate, Criteria::LESS_EQUAL)
                    ->find()->toArray();
                    foreach ($mtpReport as $key => $data) // Use the index to update the array
                    {
                        $patch1 = !empty($data['PlannedPatch']) ? array_map('trim', explode(",", $data['PlannedPatch'])) : [];
                    $patch2 = !empty($data['CoveredPatch']) ? array_map('trim', explode(",", $data['CoveredPatch'])) : [];

                    // Find the intersection of the planned and covered patches
                    $intersect = array_intersect($patch1, $patch2);
                    // Calculate the number of patches in the intersection and the total planned patches
                    $countIntersect = count($intersect);
                    $countPlanned = count($patch1);
                    // Calculate the deviation percentage for patches
                    $deviation = ($countPlanned > 0) ? abs((($countIntersect / $countPlanned) * 100) - 100) : 0;  
                    // Split and trim the PlannedTown and CoveredTown values, handling null cases
                    $town1 = !empty($data['Plannedtown']) ? array_map('trim', explode(",", $data['Plannedtown'])) : [];
                    $town2 = !empty($data['Coveredtown']) ? array_map('trim', explode(",", $data['Coveredtown'])) : [];

                    // Find the intersection of the planned and covered towns
                    $intersectTown = array_intersect($town1, $town2);
                    // Calculate the number of towns in the intersection and the total planned towns
                    $countIntersectTown = count($intersectTown);
                    $countPlannedTown = count($town1);
                    // Calculate the deviation percentage for towns
                    $deviationTown = ($countPlannedTown > 0) ? abs((($countIntersectTown / $countPlannedTown) * 100) - 100) : 0;

                    $doctorPlanned = !empty($data['DoctorPlanned']) ? (int)$data['DoctorPlanned'] : 0;
                    $doctorCovered = !empty($data['DoctorCovered']) ? (int)$data['DoctorCovered'] : 0;
                    // Calculate the doctor deviation percentage
                    $doctorDeviation = ($doctorPlanned > 0) ? abs((($doctorCovered / $doctorPlanned) * 100) - 100) : 0;  
                    // Convert RetailerPlanned and RetailerCovered to integers
                    $retailerPlanned = !empty($data['RetailerPlanned']) ? (int)$data['RetailerPlanned'] : 0;
                    $retailerCovered = !empty($data['RetailerCovered']) ? (int)$data['RetailerCovered'] : 0;
                    // Calculate the retailer deviation percentage as float
                    $retailerDeviation = ($retailerPlanned > 0) ? abs((($retailerCovered / $retailerPlanned) * 100) - 100) : 0;
                    // Convert StockistPlanned and StockistCovered to integers
                    $stockistPlanned = !empty($data['StokiestPlanned']) ? (int)$data['StokiestPlanned'] : 0;
                    $stockistCovered = !empty($data['StokiestCovered']) ? (int)$data['StokiestCovered'] : 0;
                    // Calculate the stockist deviation percentage as float
                    $stockistDeviation = ($stockistPlanned > 0) ? abs((($stockistCovered / $stockistPlanned) * 100) - 100) : 0;

                    $mtpReport[$key]['PatchDeviation'] = (int)$deviation;
                    $mtpReport[$key]['TownDeviation'] = (int)$deviationTown;
                    $mtpReport[$key]['DoctorDeviation']=(int)$doctorDeviation;
                    $mtpReport[$key]['RetailerDeviation'] = (int)$retailerDeviation;
                    $mtpReport[$key]['StockistDeviation'] = (int)$stockistDeviation;

                    $leave = \entities\LeavesQuery::create()
                                ->filterByLeaveDate($data['Date'])
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->find()->toArray();
                    if(!empty($leave)) {
                        $mtpReport[$key]['ActualActivity']='Leave';
                    }  
                         
                    }    
                break;
        endswitch;
        $this->data['MTPData'] = $mtpReport;
        switch ($action):
            case "":
                $this->app->Renderer()->render("reports/MTPdeviationView.twig", $this->data);
                break;
            case "download":
            if (count($mtpReport) > 0) {
                $result = [];
                foreach ($mtpReport as $data) 
                {
                    $result[] = [
                        "Bu" => $data["Bu"],
                        "Level3" => $data["Level3"],
                        "Level2" => $data['Level2'],
                        "Level1" => $data["Level1"],
                        "PositionId" => $data['PositionId'],
                        "Location" => $data['Location'],
                        "Repname" => $data["Repname"],
                        "EmployeeCode" => $data['EmployeeCode'],
                        "Designation" => $data['Designation'],
                        "Date" => $data["Date"],
                        "PlannedActivity" => $data['PlannedActivity'],
                        "ActualActivity" => $data['ActualActivity'],
                        "PlannedPatch" => $data["PlannedPatch"],
                        "CoveredPatch" => $data['CoveredPatch'],
                        "PatchDeviation" => $data['PatchDeviation'],
                        "Plannedtown" => $data['Plannedtown'],
                        "Coveredtown" => $data['Coveredtown'],
                        "TownDeviation" => $data['TownDeviation'],
                        "TotalcallsMade" => $data['TotalcallsMade'],
                        "DoctorPlanned" => $data['DoctorPlanned'],
                        "DoctorCovered" => $data['DoctorCovered'],
                        "DoctorDeviation" => $data['DoctorDeviation'],
                        "RetailerPlanned" => $data['RetailerPlanned'],
                        "RetailerCovered" => $data['RetailerCovered'],
                        "RetailerDeviation" => $data['RetailerDeviation'],
                        "StokiestPlanned" => $data['StokiestPlanned'],
                        "StokiestCovered" => $data['StokiestCovered'],
                        "StockistDeviation" => $data['StockistDeviation'],
                    ];
                }

                $fileName = 'MTP Deviation Report';
                $this->download_array_csv(array_values($result), $fileName . ".csv");
                exit;
            } else {
                $this->data['errorMsg'] = 'Data not found!';
                return $this->app->Renderer()->render("error.twig", $this->data);
            } 
            break;
        endswitch;
    }
}

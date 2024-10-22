<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Modules\Reports\KoolReportModel;

use koolreport\KoolReport;
use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Transpose;

/**
 * Description of DarReport
 *
 * @author Archisys
 */
class DarReport extends KoolReport {

//    protected function settings() {
//        $darReport = \entities\DarViewQuery::create()
//                        ->filterByOutletId(41815)
//                        ->find()->toArray();
//        $dataArray = array();
//        foreach ($darReport as $darRepo) {
//            $array[] = $darRepo;
//            array_push($dataArray, $array);
//        }
//        return array(
//            "dataSources" => array(
//                "data" => array(
//                    "class" => '\koolreport\datasources\ArrayDataSource',
//                    "dataFormat" => "table",
//                    "data" => array(
//                        array("DcrId", "Agendacontroltype", "EmployeeCode", "FirstName", "OutletName", "OutletId", "OutletCode", "Agendname", "PositionId", "PositionName", "Stownname", "DcrDate", "DcrStatus", "CreatedAt", "UpdatedAt", "Planned", "UnitName", "DateTime", "BrandsDetailed", "SgpiOut", "PobTotal"),
//                        $dataArray,
//                    )
//                )
//            )
//        );
//    }
//
//    protected function setup() {
//        $this->src("data")
//                ->pipe($this->dataStore("data"));
//    }
    
    function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"pgsql:host=localhost;dbname=alembic",
                    "username"=>"postgres",
                    "password"=>"Reset@123",
                    "charset"=>"utf8"
                ),
            )
        ); 
    } 
    protected function setup()
    {
        $this->src('automaker')
        ->query("SELECT * from dar_view where outlet_id = 41815")
        ->pipe($this->dataStore("darview"));
    } 

}

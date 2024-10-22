<?php
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\datagrid\DataTables;
?>
<!--<div class="report-content">
    <div class="text-center">
        <h1>Footer Settings</h1>
        <p class="lead">Show footer and calculated aggregation</p>
    </div>
    //<?php
//    Table::create(array(
//        "dataSource"=>$this->dataStore('data'),
//        "showFooter"=>true,
//        "columns"=>array(
//            "DcrId",
//            "Agendacontroltype",
//            "EmployeeCode",
//            "FirstName",
//            "OutletName",
//            "OutletId",
//            "OutletCode",
//            "Agendname",
//            "PositionId",
//            "PositionName",
//            "Stownname",
//            "DcrDate",
//            "DcrStatus",
//            "CreatedAt",
//            "UpdatedAt",
//            "Planned",
//            "UnitName",
//            "DateTime",
//            "BrandsDetailed",
//            "SgpiOut",
//            "PobTotal"
//        ),
//        "cssClass"=>array(
//            "table"=>"table-bordered table-striped table-hover"
//        )
//    ));
//    ?>
</div>-->

<div class="report-content">
    <div class="text-center">
        <h1>DataTables</h1>
        <p class="lead">
        The minimum settings to get DataTables working
        </p>
    </div>
    
    <?php
    DataTables::create(array(
        "dataSource"=>$this->dataStore("employees"),
        "themeBase"=>"bs4", // Optional option to work with Bootsrap 4
        "cssClass"=>array(
            "table"=>"table table-striped table-bordered"
        )
    ));
    ?>
</div>
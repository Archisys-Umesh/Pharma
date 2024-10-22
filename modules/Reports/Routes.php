<?php declare(strict_types=1);

return [

    [['GET', 'POST'], '/report/salesView', ['Modules\Reports\Controllers\Reports', 'SalesReport'], ['rpt_SalesReport', 'sales_reports']],
    [['GET', 'POST'], '/report/TargetViewReport', ['Modules\Reports\Controllers\Reports', 'TargetViewReport'], ['rpt_TargetViewReport', 'target_achivement']],
    [['GET', 'POST'], '/report/TargetViewReportOutlets', ['Modules\Reports\Controllers\Reports', 'TargetViewReportOutlets'], ['rpt_TargetViewReportOutlets', 'ta_outlets']],
    [['GET', 'POST'], '/report/employeereport', ['Modules\Reports\Controllers\Reports', 'employee'], ['rpt_EmployeeReport', 'employee_report']],
    [['GET', 'POST'], '/report/AttendenceReport', ['Modules\Reports\Controllers\Reports', 'AttendenceReport'], ['RptAttendenceReport', 'attendance_report']],
    [['GET', 'POST'], '/report/BrandCampiagnReport', ['Modules\Reports\Controllers\Reports', 'BrandCampiagnReport'], ['BrandCampiagnReport', 'attendance_report']],
    [['GET', 'POST'], '/report/attendanceRpt', ['Modules\Reports\Controllers\Reports', 'attendanceRpt'], ['rpt_TargetViewReportOutlets', 'ess']],
    [['GET', 'POST'], '/report/OutletReports', ['Modules\Reports\Controllers\Reports', 'OutletReports'], ['rpt_OutletReports', 'ess']],
    [['GET', 'POST'], '/report/OrderReport', ['Modules\Reports\Controllers\SalesReports', 'OrderReport'], ['rpt_OrderReport', 'ess']],


    // APIs
    [['GET', 'POST'], '/api/getTopOutlets', ['Modules\Reports\Controllers\API', 'getTopOutlets'], ['rpt_getTopOutlets', 'ess']],
    [['GET', 'POST'], '/api/getMissedOutlets', ['Modules\Reports\Controllers\API', 'getMissedOutlets'], ['rpt_getMissedOutlets', 'ess']],
    [['GET', 'POST'], '/api/getLiquidationReport', ['Modules\Reports\Controllers\API', 'getLiquidationReport'], ['rpt_getLiquidationReport', 'ess']],


    [['GET', 'POST'], '/report/DarReport', ['Modules\Reports\Controllers\Reports', 'DarReport'], ['dar_report', 'any']],
    [['GET', 'POST'], '/report/MasReport', ['Modules\Reports\Controllers\Reports', 'MasReport'], ['mas_report', 'any']],
    [['GET', 'POST'], '/report/RcpaBaeReport', ['Modules\Reports\Controllers\Reports', 'RcpaBaeReport'], ['rcpa_base_report', 'any']],
    [['GET', 'POST'], '/report/EdetailingReport', ['Modules\Reports\Controllers\Reports', 'EdetailingReport'], ['e_detailing_report', 'any']],
    [['GET', 'POST'], '/report/DvpReport', ['Modules\Reports\Controllers\Reports', 'DvpReport'], ['dvp_report', 'any']],
    [['GET', 'POST'], '/report/transactionReport', ['Modules\Reports\Controllers\Reports', 'transactionReport'], ['transactionReport', 'any']],

    [['GET', 'POST'], '/report/empSummary', ['Modules\Reports\Controllers\Reports', 'empSummary'], ['empSummary', 'any']],
    [['GET', 'POST'], '/report/empDateWiseExpense', ['Modules\Reports\Controllers\Reports', 'empDateWiseExpense'], ['empDateWiseExpense', 'any']],
    [['GET', 'POST'], '/report/sgpiBrnadWiseDistribution', ['Modules\Reports\Controllers\Reports', 'sgpiBrnadWiseDistribution'], ['sgpiBrnadWiseDistribution_report', 'any']],


    [['GET', 'POST'], '/report/dvpReportDump', ['Modules\Reports\Controllers\Reports', 'dvpReportDump'], ['dvp_report_dump', 'any']],
    [['GET', 'POST'], '/report/masReportDump', ['Modules\Reports\Controllers\Reports', 'masReportDump'], ['mas_report_dump', 'any']],
    [['GET', 'POST'], '/report/darReportDump', ['Modules\Reports\Controllers\Reports', 'darReportDump'], ['dar_report_dump', 'any']],
    [['GET', 'POST'], '/report/sgpiBrandWiseDistributionDump', ['Modules\Reports\Controllers\Reports', 'sgpiBrandWiseDistributionDump'], ['sgpiBrnadWiseDistribution_report_dump', 'any']],

    [['GET', 'POST'], '/report/employeeReports', ['Modules\Reports\Controllers\Reports', 'employeeReports'], ['employees_reports', 'nsm_reports']],

    [['GET', 'POST'], '/report/darReportMonth', ['Modules\Reports\Controllers\Reports', 'darReportMonth'], ['dar_month_report', 'any']],
    [['GET', 'POST'], '/report/masReportMonth', ['Modules\Reports\Controllers\Reports', 'masReportMonth'], ['mas_month_report', 'any']],
    [['GET', 'POST'], '/report/dvpReportMonth', ['Modules\Reports\Controllers\Reports', 'dvpReportMonth'], ['dvp_month_report', 'any']],
    [['GET', 'POST'], '/report/sgpiBrandReportMonth', ['Modules\Reports\Controllers\Reports', 'sgpiBrandReportMonth'], ['sgpi_brand_month_report', 'any']],

    [['GET', 'POST'], '/report/prescriberDataReport', ['Modules\Reports\Controllers\Reports', 'prescriberDataReport'], ['prescriber_data_Report', 'any']],
    [['GET', 'POST'], '/report/JWReport', ['Modules\Reports\Controllers\Reports', 'JWReport'], ['jw_report', 'any']],
    [['GET', 'POST'], '/report/MtpDeviationReport', ['Modules\Reports\Controllers\Reports', 'MtpDeviationReport'], ['mtp_deviation_Report', 'any']],
    
];
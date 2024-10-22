<?php

return [
    /*Expense Document Keys*/
    [['GET','POST'], '/ess/expenses', ['Modules\ESS\Controllers\Expenses', 'getList'],['ess_expenses','expenses']],
    [['GET','POST'], '/ess/send_notification', ['Modules\ESS\Controllers\Expenses', 'sendNotification'],['send_notification','expenses']],
    [['GET','POST'], '/ess/expense_notification', ['Modules\ESS\Controllers\Expenses', 'ExpenseNotification'],['expense_notification','expenses']],
    [['GET','POST'], '/ess/expenses/{id}', ['Modules\ESS\Controllers\Expenses', 'getList'],['ess_expenses_emp','hr']],

    [['GET','POST'], '/ess/expenses/form/{id}', ['Modules\ESS\Controllers\Expenses', 'initForm'],['ess_expenseForm','ess']],
    [['GET','POST'], '/ess/expenses/single/{id}', ['Modules\ESS\Controllers\Expenses', 'single'],['ess_expenseSingle','loggedin']],
    [['GET','POST'], '/ess/multipleExpense', ['Modules\ESS\Controllers\Expenses', 'multipleExpense'],['ess_expenseMultiple','loggedin']],
    [['GET','POST'], '/hr/expenses/single/{id}', ['Modules\ESS\Controllers\Expenses', 'single'],['hr_expenseSingle','ess_audit']],
    [['GET','POST'], '/ess/expenses/actions/{id}/{stepid}', ['Modules\ESS\Controllers\Expenses', 'setNextAction'],['ess_expenseAction','ess']],
    [['GET','POST'], '/ess/expenses/changeReq/{id}', ['Modules\ESS\Controllers\Expenses', 'changeReq'],['ess_changeReq','expenses']],  

    [['GET','POST'], '/ess/notifyExpenses', ['Modules\ESS\Controllers\Expenses', 'notifyExpenses'],['ess_notifyExpenses','expenses']],

    /*Trip Document Keys*/
    [['GET','POST'], '/ess/trips', ['Modules\ESS\Controllers\Trips', 'getList'],['ess_trips','ess']],
    [['GET','POST'], '/ess/trips/{id}', ['Modules\ESS\Controllers\Trips', 'getList'],['ess_trip_emp','ess']],
    [['GET','POST'], '/ess/trips/getTripReort/{id}', ['Modules\ESS\Controllers\Trips', 'getTripReort'],['ess_trips_report','ess']],
    [['GET','POST'], '/ess/trips/form/{id}', ['Modules\ESS\Controllers\Trips', 'initForm'],['ess_tripForm','ess']],
    [['GET','POST'], '/ess/trips/single/{id}', ['Modules\ESS\Controllers\Trips', 'single'],['ess_tripSingle','loggedin']],
    [['GET','POST'], '/ess/trips/actions/{id}/{stepid}', ['Modules\ESS\Controllers\Trips', 'setNextAction'],['ess_tripAction','ess']],

    /*Leave Document Keys*/
    [['GET','POST'], '/ess/leavetypes', ['Modules\ESS\Controllers\Leaves', 'leavetypes'],['ess_leave_type','leave_requests']],

    [['GET','POST'], '/ess/leaves', ['Modules\ESS\Controllers\Leaves', 'getList'],['ess_leaves','leave_requests']],
    [['GET','POST'], '/ess/leaves/{id}', ['Modules\ESS\Controllers\Leaves', 'getList'],['ess_leave_emp','leave_requests']],
    [['GET','POST'], '/ess/leaves/getTripReort/{id}', ['Modules\ESS\Controllers\Leaves', 'getTripReort'],['ess_leaves_report','leave_requests']],
    [['GET','POST'], '/ess/leaves/form/{id}', ['Modules\ESS\Controllers\Leaves', 'initForm'],['ess_leaveForm','leave_requests']],
    [['GET','POST'], '/ess/leaves/single/{id}', ['Modules\ESS\Controllers\Leaves', 'single'],['ess_leavesingle','leave_requests']],
    [['GET','POST'], '/ess/leaves/actions/{id}/{stepid}', ['Modules\ESS\Controllers\Leaves', 'setNextAction'],['ess_leaveAction','leave_requests']],

    [['GET','POST'], '/ess/leave-configuration', ['Modules\ESS\Controllers\Leaves', 'leaveConfiguration'],['ess_leaveconfiguration','configuration']],

    [['GET','POST'], '/ess/employee/leaves', ['Modules\ESS\Controllers\Leaves', 'employeeLeaves'],['ess_employee_leaves','ess']],
    [['GET','POST'], '/ess/geoDistance', ['Modules\ESS\Controllers\Expenses', 'geoDistance'],['ess_geo_distance','ess']],

    /*Reports Document Keys*/
    [['GET','POST'], '/ess/report', ['Modules\ESS\Controllers\Report', 'claimReport'],['ess_claimReport','ess']],
    [['GET','POST'], '/ess/report/expensesReport', ['Modules\ESS\Controllers\Report', 'expensesReport'],['ess_expensesReport','ess']],
    [['GET','POST'], '/ess/report/expensesReports', ['Modules\ESS\Controllers\Report', 'expensesReports'],['ess_expensesReports','ess']],
    [['GET','POST'], '/ess/report/dailyreports', ['Modules\ESS\Controllers\Report', 'dailyreports'],['ess_dailyreports','ess']],
    
    /*API Document Keys*/
    [['GET','POST','PUT','DELETE'], '/api/login', ['Modules\ESS\Controllers\API', 'login'],['restlogin','any']],

    [['GET','POST','PUT','DELETE'], '/api/checkDatabaseURL', ['Modules\ESS\Controllers\API', 'checkDatabaseURL'],['api_checkDatabaseURL','any']],
    [['GET','POST','PUT','DELETE'], '/api/forgotpwd', ['Modules\ESS\Controllers\API', 'forgotPwd'],['api_forgotPwd','any']],

    [['GET','POST','PUT','DELETE'], '/api/getMyTeam', ['Modules\ESS\Controllers\API', 'getMyTeam'],['api_getMyTeam','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getProfile', ['Modules\ESS\Controllers\API', 'getProfile'],['api_getProfile','loggedin']],

    [['GET','POST','PUT','DELETE'], '/api/getStatus', ['Modules\ESS\Controllers\API', 'getStatus'],['api_getStatus','any']],
    [['GET','POST','PUT','DELETE'], '/api/getAllowedMonths', ['Modules\ESS\Controllers\API', 'getAllowedMonths'],['api_getAllowedMonths','ess']],
    [['GET','POST','PUT','DELETE'], '/api/gettripandio', ['Modules\ESS\Controllers\API', 'getTripandIO'],['api_getTripandIO','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getExpenses', ['Modules\ESS\Controllers\API', 'getExpenses'],['api_getExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/createExpenses[/{id}]', ['Modules\ESS\Controllers\API', 'createExpenses'],['api_createExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/expensesSubmit/{id}', ['Modules\ESS\Controllers\API', 'expensesSubmit'],['api_expensesSubmit','ess']],
    [['GET','POST','PUT','DELETE'], '/api/trip[/{id}]', ['Modules\ESS\Controllers\API', 'trip'],['api_trip','ess']],
    [['GET','POST','PUT','DELETE'], '/api/dashboard', ['Modules\ESS\Controllers\API', 'dashboard'],['api_dashboard','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getLocation', ['Modules\ESS\Controllers\API', 'getLocation'],['api_getLocation','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getcurrencies', ['Modules\ESS\Controllers\API', 'getcurrencies'],['api_getcurrencies','ess']],
    [['GET','POST','PUT','DELETE'], '/api/attachmentupload[/{id}]', ['Modules\ESS\Controllers\API', 'attachmentUpload'],['api_attachmentUpload','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getSingleTrip', ['Modules\ESS\Controllers\API', 'getSingleTrip'],['api_getSingleTrip','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getSingleExpenses', ['Modules\ESS\Controllers\API', 'getSingleExpenses'],['api_getSingleExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getExpensesMaster', ['Modules\ESS\Controllers\API', 'getExpensesMaster'],['api_getExpensesMaster','ess']],
    [['GET','POST','PUT','DELETE'], '/api/validateExpense/{id}', ['Modules\ESS\Controllers\API', 'validateExpense'],['api_validateExpense','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getNotification', ['Modules\ESS\Controllers\API', 'getNotifications'],['api_getNotifications','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeetoExpenses', ['Modules\ESS\Controllers\API', 'getEmployeetoExpenses'],['api_getEmployeetoExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/expensesApproved[/{id}]', ['Modules\ESS\Controllers\API', 'expensesApproved'],['api_expensesApproved','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getawatingApprovalExpenses', ['Modules\ESS\Controllers\API', 'getawatingApprovalExpenses'],['api_getawatingApprovalExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/tripApproveRejectCancel', ['Modules\ESS\Controllers\API', 'tripApproveRejectCancel'],['api_tripApproveRejectCancel','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getawatingApprovalTrip', ['Modules\ESS\Controllers\API', 'getawatingApprovalTrip'],['api_getawatingApprovalTrip','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getemployeeTrip', ['Modules\ESS\Controllers\API', 'getemployeeTrip'],['api_getemployeeTrip','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getemployeeTripNew', ['Modules\ESS\Controllers\API', 'getemployeeTripNew'],['api_getemployeeTrip','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getKeyRecords', ['Modules\ESS\Controllers\API', 'getKeyRecords'],['api_getKeyRecords','ess']],
    [['GET','POST','PUT','DELETE'], '/api/currencyMaster', ['Modules\ESS\Controllers\API', 'currencyMaster'],['api_currencyMaster','ess']],
    [['GET','POST','PUT','DELETE'], '/api/employeeLog', ['Modules\ESS\Controllers\API', 'employeeLog'],['api_employeeLog','ess']],
    [['GET','POST','PUT','DELETE'], '/api/appLogout', ['Modules\ESS\Controllers\API', 'appLogout'],['api_appLogout','ess']],
    [['GET','POST','PUT','DELETE'], '/api/editApprovelExpenses/{expId}', ['Modules\ESS\Controllers\API', 'editApprovelExpenses'],['api_editApprovelExpenses','ess']],
    [['GET','POST','PUT','DELETE'], '/api/attachmentDelete/{id}', ['Modules\ESS\Controllers\API', 'attachmentDelete'],['api_attachmentDelete','ess']],
    [['GET','POST','PUT','DELETE'], '/api/userLog', ['Modules\ESS\Controllers\API', 'userLog'],['api_userLog','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripStartEndDate', ['Modules\ESS\Controllers\API', 'getTripStartEndDate'],['api_getTripStartEndDate','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripStartEndDateTeamTrips', ['Modules\ESS\Controllers\API', 'getTripStartEndDateTeamTrips'],['api_getTripStartEndDateTeamTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/addMoreExp/{id}', ['Modules\ESS\Controllers\API', 'addMoreExp'],['api_addMoreExp','any']],
    [['GET','POST','PUT','DELETE'], '/api/addMoreExpPost/{id}', ['Modules\ESS\Controllers\API', 'addMoreExpPost'],['api_addMoreExpPost','any']],
    [['GET','POST','PUT','DELETE'], '/api/deleteMoreExp/{id}', ['Modules\ESS\Controllers\API', 'deleteMoreExp'],['api_deleteMoreExp','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeeRoleWise', ['Modules\ESS\Controllers\API', 'getEmployeeRoleWise'],['api_getEmployeeRoleWise','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeeDetails/{employeeid}', ['Modules\ESS\Controllers\API', 'getEmployeeDetails'],['api_getEmployeeDetails','ess']],


    /*duplicate API*/
    //[['GET','POST','PUT','DELETE'], '/api/getStatusNew', ['Modules\ESS\Controllers\API', 'getStatusNew'],['api_getStatusNew','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getAllowedMonthsNew', ['Modules\ESS\Controllers\API', 'getAllowedMonthsNew'],['api_getAllowedMonthsNew','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripandIONew', ['Modules\ESS\Controllers\API', 'getTripandIONew'],['api_getTripandIONew','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getawatingApprovalTripNew', ['Modules\ESS\Controllers\API', 'getawatingApprovalTripNew'],['api_getawatingApprovalTripNew','ess']],

    [['GET','POST','PUT','DELETE'], '/api/getawatingApprovalExpensesMonthwise', ['Modules\ESS\Controllers\API', 'getawatingApprovalExpensesMonthwise'],['api_getawatingApprovalExpensesMonthwise','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getawatingApprovalExpensesMonthwiseNew', ['Modules\ESS\Controllers\API', 'getawatingApprovalExpensesMonthwiseNew'],['api_getawatingApprovalExpensesMonthwiseNew','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getExpensesMonthwise', ['Modules\ESS\Controllers\API', 'getExpensesMonthwise'],['api_getExpensesMonthwise','any']],
    [['GET','POST','PUT','DELETE'], '/api/getExpensesLazyLoad', ['Modules\ESS\Controllers\API', 'getExpensesLazyLoad'],['api_getExpensesLazyLoad','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTrips[/{id}]', ['Modules\ESS\Controllers\API', 'getTrips'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripsLazyLoad[/{id}]', ['Modules\ESS\Controllers\API', 'getTripsLazyLoad'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/modifyTrip[/{id}]', ['Modules\ESS\Controllers\API', 'modifyTrip'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/validateTripData[/{id}]', ['Modules\ESS\Controllers\API', 'validateTripData'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripExp[/{id}]', ['Modules\ESS\Controllers\API', 'getTripExp'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/tripDelete[/{pk}]', ['Modules\ESS\Controllers\API', 'tripDelete'],['api_tripDelete','ess']],
    [['GET','POST','PUT','DELETE'], '/api/expDelete[/{id}]', ['Modules\ESS\Controllers\API', 'expDelete'],['api_tripDelete','ess']],
    [['GET','POST','PUT','DELETE'], '/api/expDeleteNew', ['Modules\ESS\Controllers\API', 'expDeleteNew'],['api_tripDelete','ess']],

    /* Advances */
    [['GET','POST'], '/api/transaction', ['Modules\ESS\Controllers\API', 'transaction'],['api_transaction','ess']],
    [['GET','POST'], '/api/balance', ['Modules\ESS\Controllers\API', 'balance'],['api_balance','ess']],


    /*API Document Keys*/
    [['GET','POST'], '/deleteExpenses/{id}', ['Modules\ESS\Controllers\Expenses', 'deleteExpenses'],['ess_deleteExpenses','ess']],
    [['GET','POST'], '/tempGstToClaimegst', ['Modules\ESS\Controllers\Expenses', 'tempGstToClaimegst'],['ess_tempGstToClaimegst','ess']],

    /*worklog*/
    [['GET','POST','PUT','DELETE'], '/api/workLog/{id}', ['Modules\ESS\Controllers\API', 'workLog'],['api_workLog','ess']],
    [['GET','POST','PUT','DELETE'], '/api/employeeWorkLogDelete/{id}', ['Modules\ESS\Controllers\API', 'employeeWorkLogDelete'],['api_employeeWorkLogDelete','ess']],

    /* Manage Employees from Mobile */
    [['GET','POST','PUT','DELETE'], '/api/GetOrgUsers', ['Modules\ESS\Controllers\API', 'GetOrgUsers'],['api_org_users','ess']],
    [['GET','POST','PUT','DELETE'], '/api/addEmployees', ['Modules\ESS\Controllers\API', 'addEmployees'],['api_addEmployees','ess']],
    [['GET','POST','PUT','DELETE'], '/api/employeeActions[/{id}]', ['Modules\ESS\Controllers\API', 'employeeActions'],['api_employeeActions','ess']],
    [['GET','POST'], '/api/register', ['Modules\ESS\Controllers\API', 'newCompanySignup'],['api_newCompanySignup','any']],
    [['GET','POST','PUT','DELETE'], '/api/getCountryList', ['Modules\ESS\Controllers\API', 'getCountryList'],['api_getCountryList','any']],

    /* V2 API */

    [['GET','POST','PUT','DELETE'], '/api/v2/getPendingActions', ['Modules\ESS\Controllers\V2', 'getPendingActions'],['v2_getPendingActions','ess']],
    [['GET','POST','PUT','DELETE'], '/api/v2/getTrips', ['Modules\ESS\Controllers\V2', 'getTrips'],['v2_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/v2/getExpenseMultiple', ['Modules\ESS\Controllers\V2', 'getExpenseMultiple'],['v2_getExpenseMultiple','ess']],
    [['GET','POST','PUT','DELETE'], '/api/v2/deleteExpenseDetailRecord', ['Modules\ESS\Controllers\V2', 'deleteExpenseDetailRecord'],['v2_getExpenseMultiple','ess']],
    [['GET','POST','PUT','DELETE'], '/api/v2/getDocLog', ['Modules\ESS\Controllers\V2', 'getDocLog'],['v2_getDocLog','ess']],


    /* New API's*/
    [['GET','POST','PUT','DELETE'], '/api/loginwithmobile', ['Modules\ESS\Controllers\API', 'loginwithmobile'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/reSentOTP', ['Modules\ESS\Controllers\API', 'reSentOTP'],['restlogin','any']],
//    [['GET','POST','PUT','DELETE'], '/api/get-user-profile', ['Modules\ESS\Controllers\API', 'getUserProfile'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/verifyOtp', ['Modules\ESS\Controllers\API', 'verifyOtp'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getUserCliams', ['Modules\ESS\Controllers\API', 'getUserCliams'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/logout', ['Modules\ESS\Controllers\API', 'logout'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/punchin', ['Modules\ESS\Controllers\API', 'punchin'],['restlogin','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/attendance_report', ['Modules\ESS\Controllers\API', 'attendanceReport'],['restlogin','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/rcpa_report', ['Modules\ESS\Controllers\API', 'repaReport'],['restlogin','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/prescriber_ladder', ['Modules\ESS\Controllers\API', 'prescriberLadder'],['restlogin','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/get_dates', ['Modules\ESS\Controllers\API', 'getDates'],['restlogin','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/rcpa_trend_report', ['Modules\ESS\Controllers\API', 'rcpaTrendReport'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/rcpa_bifurcation', ['Modules\ESS\Controllers\API', 'rcpabifurcation'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/rcpa_own_vs_competitior', ['Modules\ESS\Controllers\API', 'rcpavsownCompetitior'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/top_doctors', ['Modules\ESS\Controllers\API', 'topDoctors'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/top10Doctors', ['Modules\ESS\Controllers\API', 'top10Doctors'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/rcpa_chemist_prescription_audit', ['Modules\ESS\Controllers\API', 'retailChemistPrescriptionAudit'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/punchout', ['Modules\ESS\Controllers\API', 'punchout'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/changeAgenda', ['Modules\ESS\Controllers\API', 'changeAgenda'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/punchStatus', ['Modules\ESS\Controllers\API', 'punchStatus'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/punchStatusByDate', ['Modules\ESS\Controllers\API', 'punchStatusByDate'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getTeam', ['Modules\ESS\Controllers\API', 'getTeam'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getBirthdayReminders', ['Modules\ESS\Controllers\API', 'getBirthdayReminders'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeeTrips', ['Modules\ESS\Controllers\TripAPI', 'getEmployeeTrips'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripTypes', ['Modules\ESS\Controllers\TripAPI', 'getTripTypes'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripTaDa', ['Modules\ESS\Controllers\TripAPI', 'getTripTaDa'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/createTrip', ['Modules\ESS\Controllers\TripAPI', 'createTrip'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getIdByTrip', ['Modules\ESS\Controllers\TripAPI', 'getIdByTrip'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTodayTrips', ['Modules\ESS\Controllers\TripAPI', 'getTodayTrips'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripLocations', ['Modules\ESS\Controllers\TripAPI', 'getTripLocations'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getbudgets', ['Modules\ESS\Controllers\TripAPI', 'getbudgets'],['restlogin','ess']],

    [['GET','POST','PUT','DELETE'], '/api/verifyMediaOutletCheckin', ['Modules\ESS\Controllers\API', 'verifyMediaOutletCheckin'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/attachMediaOutletCheckin', ['Modules\ESS\Controllers\API', 'attachMediaOutletCheckin'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/verifyMediaAttendance', ['Modules\ESS\Controllers\API', 'verifyMediaAttendance'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/attachMediaAttendance', ['Modules\ESS\Controllers\API', 'attachMediaAttendance'],['restlogin','ess']],

    [['GET','POST','PUT','DELETE'], '/api/getAllTripStat', ['Modules\ESS\Controllers\API', 'getAllTripStat'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getAllExpenseStat', ['Modules\ESS\Controllers\API', 'getAllExpenseStat'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getFilterTrips', ['Modules\ESS\Controllers\TripAPI', 'getFilterTrips'],['restlogin','ess']],

    [['GET','POST','PUT','DELETE'], '/api/getEmployeeExpenses', ['Modules\ESS\Controllers\API', 'getEmployeeExpenses'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getPlaceOfWork', ['Modules\ESS\Controllers\API', 'getPlaceOfWork'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/tripCancel', ['Modules\ESS\Controllers\TripAPI', 'tripCancel'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/tripDeleteNew', ['Modules\ESS\Controllers\API', 'tripDeleteNew'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getWorkingAt', ['Modules\ESS\Controllers\TripAPI', 'getWorkingAt'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/modifyTripNew', ['Modules\ESS\Controllers\API', 'modifyTripNew'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/createExpenseListDetailss', ['Modules\ESS\Controllers\API', 'createExpenseListDetailss'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getExpenseListDetailsById', ['Modules\ESS\Controllers\API', 'getExpenseListDetailsById'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/updateExpenseListDetails', ['Modules\ESS\Controllers\API', 'updateExpenseListDetails'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/deleteExpenseListDetails', ['Modules\ESS\Controllers\API', 'deleteExpenseListDetails'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripExpenses', ['Modules\ESS\Controllers\API', 'getTripExpenses'],['api_getTrips','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getExpenseListDetails', ['Modules\ESS\Controllers\API', 'getExpenseListDetails'],['restlogin','ess']],
    [['GET','POST','PUT','DELETE'], '/api/getTripsMonthwise', ['Modules\ESS\Controllers\TripAPI', 'getTripsMonthwise'],['api_getTripsMonthwise','any']],

    [['GET','POST','PUT','DELETE'], '/api/sendTestMail', ['Modules\ESS\Controllers\API', 'sendTestMail'],['restlogin','any']],

    [['GET','POST','PUT','DELETE'], '/api/getLeaveTypes', ['Modules\ESS\Controllers\API', 'getLeaveTypes'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/createLeave', ['Modules\ESS\Controllers\API', 'createLeave'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeeLeave', ['Modules\ESS\Controllers\API', 'getEmployeeLeave'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getLeaveById', ['Modules\ESS\Controllers\API', 'getLeaveById'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeeLeaveBalance', ['Modules\ESS\Controllers\API', 'getEmployeeLeaveBalance'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getLeaveStatus', ['Modules\ESS\Controllers\API', 'getLeaveStatus'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/leaveApprove', ['Modules\ESS\Controllers\API', 'leaveApprove'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/leaveReject', ['Modules\ESS\Controllers\API', 'leaveReject'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/getEmployeePendingLeave', ['Modules\ESS\Controllers\API', 'getEmployeePendingLeave'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/punchLeave', ['Modules\ESS\Controllers\API', 'punchLeave'],['restlogin','any']],

    [['GET','POST','PUT','DELETE'], '/api/pendingLeaveCount', ['Modules\ESS\Controllers\API', 'pendingLeaveCount'],['restlogin','any']],
    [['GET','POST','PUT','DELETE'], '/api/pendingLeaveCountList', ['Modules\ESS\Controllers\API', 'pendingLeaveCountList'],['restlogin','any']],

    [['GET','POST','PUT','DELETE'], '/api/UnlockDays', ['Modules\ESS\Controllers\API', 'UnlockDays'],['UnlockDays','any']],
    [['GET','POST','PUT','DELETE'], '/api/getLockedDays', ['Modules\ESS\Controllers\API', 'getLockedDays'],['getLockedDays','any']],

    [['GET','POST','PUT','DELETE'], '/api/SendSms', ['Modules\ESS\Controllers\API', 'SendSms'],['SendSms','any']],

    [['GET','POST','PUT','DELETE'], '/api/leaveCancelled', ['Modules\ESS\Controllers\API', 'leaveCancelled'],['leaveCancelled','any']],
    [['GET','POST','PUT','DELETE'], '/api/generateExpense', ['Modules\ESS\Controllers\API', 'generateExpense'],['todayExpenseCalculation','any']],
    [['GET','POST','PUT','DELETE'], '/api/processDailyCallTowns', ['Modules\ESS\Controllers\API', 'processDailyCallTowns'],['processDailyCallTowns','any']],

    [['GET','POST','PUT','DELETE'], '/api/deleteExpenseList', ['Modules\ESS\Controllers\API', 'deleteExpenseList'],['deleteExpenseList','any']],

    [['GET','POST','PUT','DELETE'], '/api/getStartTown', ['Modules\ESS\Controllers\API', 'getStartTown'],['getStartTown','ess']],
    
    [['GET','POST','PUT','DELETE'], '/api/attendanceSummaryReport', ['Modules\ESS\Controllers\API', 'attendanceSummaryReport'],['attendanceSummaryReport','any']],
    [['GET','POST','PUT','DELETE'], '/api/employeeLeaveApproval', ['Modules\ESS\Controllers\API', 'employeeLeaveApproval'],['employeeLeaveApproval','any']],

    [['GET','POST','PUT','DELETE'], '/api/visitedTownCorrection', ['Modules\ESS\Controllers\API', 'visitedTownCorrection'],['visitedTownCorrection','any']],
    [['GET','POST','PUT','DELETE'], '/api/createLeaveWithoutAnyValidation', ['Modules\ESS\Controllers\API', 'createLeaveWithoutAnyValidation'],['createLeaveWithoutAnyValidation','any']],

    [['GET','POST','PUT','DELETE'], '/api/getWorkingDays', ['Modules\ESS\Controllers\API', 'getWorkingDays'],['getWorkingDays','any']],
    
    [['GET','POST','PUT','DELETE'], '/api/addPendingDCRRecords', ['Modules\ESS\Controllers\API', 'addPendingDCRRecords'],['addPendingDCRRecords','any']],

    [['GET','POST','PUT','DELETE'], '/api/attendance/add/end-town', ['Modules\ESS\Controllers\API', 'addEndTownToAttendances'],['addPendingDCRRecords','any']],


    [['GET','POST','PUT','DELETE'], '/api/getLeaveDeduction', ['Modules\ESS\Controllers\API', 'getLeaveDeduction'],['getLeaveDeduction','any']],
    [['GET','POST','PUT','DELETE'], '/api/getExpenseLastDates', ['Modules\ESS\Controllers\API', 'getExpenseLastDates'],['getExpenseLastDates','any']],
    [['GET','POST','PUT','DELETE'], '/api/getExpensesNew', ['Modules\ESS\Controllers\API', 'getExpensesNew'],['getExpensesNew','any']],

    /* Integration API - ORM */
    [['GET','POST','PUT','DELETE'], '/api/unlockAccount', ['Modules\ESS\Controllers\IntegrationApi', 'unlockAccount'],['unlockAccount','any']],
    [['GET','POST','PUT','DELETE'], '/api/setResignationDate', ['Modules\ESS\Controllers\IntegrationApi', 'setResignationDate'],['setResignationDate','any']],
    [['GET','POST','PUT','DELETE'], '/api/employeeReportingDetails', ['Modules\ESS\Controllers\IntegrationApi', 'employeeReportingDetails'],['employeeReportingDetails','any']],
    [['GET','POST','PUT','DELETE'], '/api/employeePendingInputInventory', ['Modules\ESS\Controllers\IntegrationApi', 'employeePendingInputInventory'],['employeePendingInputInventory','any']],

    /* Integration API - FNF */
    [['GET','POST','PUT','DELETE'], '/api/fnf/empSgpiSummary', ['Modules\ESS\Controllers\IntegrationApi', 'empSgpiSummary'],['empSgpiSummary','any']],
    [['GET','POST','PUT','DELETE'], '/api/fnf/empSgpiDetailsList', ['Modules\ESS\Controllers\IntegrationApi', 'empSgpiDetailsList'],['empSgpiDetailsList','any']],
    [['GET','POST','PUT','DELETE'], '/api/fnf/empExpenseSummary', ['Modules\ESS\Controllers\IntegrationApi', 'empExpenseSummary'],['empExpenseSummary','any']],

    /* Announcement API */
    [['GET','POST','PUT','DELETE'], '/api/announcement/read', ['Modules\ESS\Controllers\Announcements', 'readAnnouncement'],['readAnnouncement','any']],
];
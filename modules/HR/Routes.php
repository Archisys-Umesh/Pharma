<?php

declare(strict_types=1);

return [
    ['GET', '/hr/employees', ['Modules\HR\Controllers\Masters', 'employeeList'], ['hr_empList', 'employee_full_list']],
    ['GET', '/hr/employee_leave_balance', ['Modules\HR\Controllers\Masters', 'EmployeeLeaveBalance'], ['hr_empBalanceLeave', 'employee_leaves']],
    ['GET', '/hr/employees/{id}', ['Modules\HR\Controllers\Masters', 'employeeList'], ['hr_empList_opt', 'day_locked']],
    ['GET', '/hr/p', ['Modules\HR\Controllers\Masters', 'employeeSearch'], ['hr_employeeSearch', 'loggedin']],
    [['GET', 'POST'], '/hr/employeeForm/{id}', ['Modules\HR\Controllers\Masters', 'employeeForm'], ['hr_empForm', 'user_system']],
    
    [['GET', 'POST'], '/hr/dailycalls/{id}', ['Modules\HR\Controllers\DailyCalls', 'dailyCallsbyattendance'], ['hr_dailyCallsbyattendance', 'user_system']],
    [['GET', 'POST'], '/hr/delete-calls/{id}', ['Modules\HR\Controllers\DailyCalls', 'deleteCalls'], ['delete_calls', 'user_system']],

    [['GET', 'POST'], '/hr/holidays', ['Modules\HR\Controllers\Masters', 'holidays'], ['holidays', 'holiday']],
    [['GET', 'POST'], '/hr/wdbsynclog', ['Modules\HR\Controllers\Masters', 'wdbsyncLog'], ['wdbsynclog', 'wdbsynclog']],
    [['GET', 'POST'], '/hr/announcements', ['Modules\HR\Controllers\Masters', 'announcements'], ['announcements', 'announcement']],
    [['GET', 'POST'], '/hr/profileForm/{id}', ['Modules\HR\Controllers\Masters', 'profileForm'], ['hr_profileForm', 'hr_emp']],
    [['GET', 'POST'], '/hr/employeeLastLoc/{userId}', ['Modules\System\Controllers\System', 'employeeLastLoc'], ['hr_employeeLastLoc', 'any']],
    [['GET', 'POST'], '/hr/userHrAccount/{id}', ['Modules\HR\Controllers\Masters', 'userHrAccount'], ['hr_userHrAccount', 'hr']],
    [['GET', 'POST'], '/hr/employeeExp/{id}', ['Modules\HR\Controllers\Masters', 'employeeExp'], ['hr_employeeExp', 'hr']],
    [['GET', 'POST'], '/hr/employeeEdu/{id}', ['Modules\HR\Controllers\Masters', 'employeeEdu'], ['hr_employeeEdu', 'hr']],
    [['GET', 'POST'], '/hr/employeeRef/{id}', ['Modules\HR\Controllers\Masters', 'employeeRef'], ['hr_employeeRef', 'hr']],
    [['GET', 'POST'], '/hr/employeeDoc/{id}', ['Modules\HR\Controllers\Masters', 'employeeDoc'], ['hr_employeeDoc', 'hr']],
    [['GET', 'POST'], '/hr/postNewEmpDoc/{id}', ['Modules\HR\Controllers\Masters', 'postNewEmpDoc'], ['hr_postNewEmpDoc', 'hr']],
    [['GET', 'POST'], '/hr/cityCategory', ['Modules\HR\Controllers\Masters', 'cityCategory'], ['hr_cityCategory', 'city_categories']],
    [['GET', 'POST'], '/hr/cityCategoryForm/{id}', ['Modules\HR\Controllers\Masters', 'cityCategoryForm'], ['hr_cityCategoryForm', 'hr']],
    [['GET', 'POST'], '/hr/expenseMaster', ['Modules\HR\Controllers\Masters', 'expenseMaster'], ['hr_expenseMaster', 'expense_master']],
    [['GET', 'POST'], '/hr/addExpenseViaTemplate', ['Modules\HR\Controllers\Masters', 'addExpenseViaTemplate'], ['hr_addExpenseViaTemplate', 'system']],
    [['GET', 'POST'], '/hr/budgets', ['Modules\HR\Controllers\Masters', 'budgetGroups'], ['hr_budgetGroups', 'user_system']],
    [['GET', 'POST'], '/hr/manageBudget', ['Modules\HR\Controllers\Masters', 'manageBudget'], ['hr_manageBudget', 'user_system']],
    [['GET', 'POST'], '/hr/expenseRepellents', ['Modules\HR\Controllers\Masters', 'expenseRepellents'], ['hr_expenseRepellents', 'user_system']],
    [['GET', 'POST'], '/hr/pushNotification', ['Modules\HR\Controllers\Masters', 'pushNotification'], ['hr_push_notification', 'any']],
    [['GET', 'POST'], '/hr/expenseAudit', ['Modules\HR\Controllers\Audit', 'index'], ['hr_expenseAudit', 'settle']],
    [['GET', 'POST'], '/hr/moveClaims/{f}', ['Modules\HR\Controllers\Audit', 'moveClaims'], ['hr_moveClaims', 'ess_audit']],
    [['GET', 'POST'], '/hr/ioMaster', ['Modules\HR\Controllers\Masters', 'ioMaster'], ['hr_ioMaster', 'user_system']],
    [['GET', 'POST'], '/hr/auditUnitMap', ['Modules\HR\Controllers\Masters', 'auditUnitMap'], ['hr_auditUnitMap', 'user_system']],
    [['GET', 'POST'], '/hr/moveToAudit/{orgunit}', ['Modules\HR\Controllers\Audit', 'moveToAudit'], ['hr_moveToAudit', 'settle']],

    [['GET', 'POST'], '/hr/divisionExpenseAudit', ['Modules\HR\Controllers\Audit', 'divisionExpenseAudit'], ['hr_divisionExpenseAudit', 'ess_audit']],


    [['GET', 'POST'], '/hr/tripmoveToAudit', ['Modules\HR\Controllers\Audit', 'tripmoveToAudit'], ['hr_tripmoveToAudit', 'ess_audit']],
    [['GET', 'POST'], '/hr/audit', ['Modules\HR\Controllers\Audit', 'audit'], ['hr_audit', 'ess_audit']],
    [['GET', 'POST'], '/hr/auditV2', ['Modules\HR\Controllers\Audit', 'auditV2'], ['hr_audit_v2', 'ess_audit']],
    [['GET', 'POST'], '/hr/reports/expenseReport', ['Modules\HR\Controllers\Reports', 'expenseReport'], ['hr_expenseReport', 'ess_audit']],
    [['GET', 'POST'], '/hr/reports/empExpReport', ['Modules\HR\Controllers\Reports', 'empExpReport'], ['hr_empExpReport', 'ess_audit']],
    [['GET', 'POST'], '/hr/hrReminders', ['Modules\HR\Controllers\Masters', 'hrReminders'], ['hr_hrReminders', 'hr']],
    [['GET', 'POST'], '/audit/expenses/changeReq/{id}', ['Modules\ESS\Controllers\Expenses', 'changeReq'], ['audit_changeReq', 'ess_audit']],
    [['GET', 'POST'], '/hr/expRemark/{id}', ['Modules\HR\Controllers\Audit', 'expRemark'], ['hr_expRemark', 'ess_audit']],
    [['GET', 'POST'], '/hr/ffreport', ['Modules\ESS\Controllers\Report', 'claimReport'], ['hr_claimReport', 'ess_audit']],
    [['GET', 'POST'], '/hr/reports/empSummary', ['Modules\HR\Controllers\Reports', 'empSummary'], ['hr_empSummary', 'ess']],
    [['GET', 'POST'], '/hr/reports/empTrip', ['Modules\HR\Controllers\Reports', 'empTrip'], ['hr_empTrip', 'ess']],
    [['GET', 'POST'], '/hr/reports/adminReports', ['Modules\HR\Controllers\Reports', 'adminReports'], ['hr_adminReports', 'ess']],
    [['GET', 'POST'], '/hr/reports/adminEmpData', ['Modules\HR\Controllers\Reports', 'adminEmpData'], ['hr_adminEmpData', 'hr']],
    [['GET', 'POST'], '/hr/auditorFrom/{id}', ['Modules\HR\Controllers\Audit', 'auditorFrom'], ['hr_auditorFrom', 'ess_audit']],
    [['GET', 'POST'], '/hr/reports/payoutReport', ['Modules\HR\Controllers\Reports', 'payoutReport'], ['hr_payoutReport', 'ess_org_admin', 'ess_branch_admin']],
    [['GET', 'POST'], '/hr/reports/empPayoutReport/{branchId}', ['Modules\HR\Controllers\Reports', 'empPayoutReport'], ['hr_empPayoutReport', 'ess_org_admin', 'ess_branch_admin']],
    [['GET', 'POST'], '/hr/reports/budgetReport', ['Modules\HR\Controllers\Reports', 'budgetReport'], ['hr_budgetReport', 'ess_org_admin', 'ess_branch_admin']],
    [['GET', 'POST'], '/hr/reports/singleio/{id}', ['Modules\HR\Controllers\Reports', 'singleio'], ['hr_singleio', 'ess_org_admin']],
    [['GET', 'POST'], '/hr/reports/companyCardReports', ['Modules\HR\Controllers\Reports', 'companyCardReports'], ['hr_companyCardReports', 'ess_org_admin']],
    [['GET', 'POST'], '/hr/settlementAudit/{id}/{trip}', ['Modules\HR\Controllers\Audit', 'settlementAudit'], ['hr_settlementAudit', 'ess_audit']],

    [['GET', 'POST'], '/hr/expRemarkLog/{id}', ['Modules\HR\Controllers\Audit', 'expRemarkLog'], ['hr_expRemarkLog', 'ess']],
    
    [['GET', 'POST'], '/hr/attendance', ['Modules\HR\Controllers\Masters', 'attendance'], ['hr_attendance', 'hr']],
    [['GET', 'POST'], '/hr/regenerateExpense', ['Modules\HR\Controllers\Masters', 'regenerateExpense'], ['hr_regenerateExpense', 'hr']],
    [['GET', 'POST'], '/hr/editAttendance/{id}', ['Modules\HR\Controllers\Masters', 'editAttendance'], ['hr_attendance_form', 'hr']],
    [['GET', 'POST'], '/hr/employeePunchLoc', ['Modules\HR\Controllers\Masters', 'employeePunchLoc'], ['hr_employeePunchLoc', 'hr']],

    [['GET', 'POST'], '/hr/releaseDayLock', ['Modules\HR\Controllers\Masters', 'releaseDayLock'], ['hr_releaseDayLock', 'hr']],
    [['GET', 'POST'], '/hr/unlockEmp', ['Modules\HR\Controllers\Masters', 'unlockEmp'], ['hr_unlockEmp', 'hr']],
    [['GET', 'POST'], '/hr/unlockSTP', ['Modules\HR\Controllers\Masters', 'unlockSTP'], ['unlockSTP', 'hr']],

    
    [['GET', 'POST'], '/hr/eventlist', ['Modules\HR\Controllers\Masters', 'eventList'], ['hr_event_list', 'hr']],
    [['GET', 'POST'], '/hr/event/{id}', ['Modules\HR\Controllers\Masters', 'event'], ['hr_event', 'hr']],
    [['GET', 'POST'], '/hr/target/{id}', ['Modules\HR\Controllers\Masters', 'target'], ['hr_traget', 'hr']],
    [['GET', 'POST'], '/hr/userSession/{id}', ['Modules\HR\Controllers\Masters', 'getUserSession'], ['hr_userSession', 'hr']],
    [['GET', 'POST'], '/hr/getSingleExpense/{id}', ['Modules\HR\Controllers\Masters', 'getSingleExpense'], ['hr_attendance_expense', 'loggedin']],

    [['GET', 'POST'], '/hr/expenseRecal/{id}', ['Modules\HR\Controllers\Masters', 'expenseRecal'], ['hr_expense_recal', 'hr']],
    [['GET', 'POST'], '/hr/sgpi_history/{id}', ['Modules\HR\Controllers\Masters', 'sgpiHistory'], ['sgpi_history', 'any']],
    [['GET', 'POST'], '/hr/credit_sgpi_history/{id}/{empId}', ['Modules\HR\Controllers\Masters', 'creditSgpiHistory'], ['credit_sgpi_history', 'any']],
   

];


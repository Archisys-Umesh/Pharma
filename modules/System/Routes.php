<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/system/userForm/{id}', ['Modules\System\Controllers\System', 'userForm'],['sys_userForm','user_system']],
    [['GET','POST'], '/system/userResetPwd/{id}', ['Modules\System\Controllers\System', 'userResetPwd'],['sys_userResetPwd','hr']],    
    
    ['GET', '/system/employees', ['Modules\System\Controllers\System', 'employeeList'],['sys_empList','employee_full_list']],
    [['GET','POST'], '/system/masters', ['Modules\System\Controllers\System', 'masters'],['sys_masters','masters']],
    [['GET','POST'], '/system/outlettypesmodule/{id}', ['Modules\System\Controllers\System', 'outlettypesmodule'],['outlettypesmodule','system']],
    [['GET','POST'], '/system/orgStructure', ['Modules\System\Controllers\Orgstructure', 'orgStructure'],['sys_orgStructure','org_structure']],
    [['GET','POST'], '/system/postionForm/{id}', ['Modules\System\Controllers\Orgstructure', 'postionForm'],['sys_postionForm','system']],    
    [['GET','POST'], '/system/designationForm/{id}', ['Modules\System\Controllers\System', 'designationForm'],['sys_designationForm','system']],  
    [['GET','POST'], '/system/policyForm/{id}', ['Modules\System\Controllers\System', 'policyForm'],['sys_policyForm','system']],  
    [['GET','POST'], '/system/departmentForm/{id}', ['Modules\System\Controllers\System', 'departmentForm'],['sys_departmentForm','system']],    
    [['GET','POST'], '/system/branchForm/{id}', ['Modules\System\Controllers\System', 'branchForm'],['sys_branchForm','system']],    
    [['GET','POST'], '/system/locationSearch', ['Modules\System\Controllers\System', 'locationSearch'],['sys_locationSearch','loggedin']],    

    [['GET','POST'], '/system/positionSearch', ['Modules\System\Controllers\System', 'positionSearch'],['sys_positionSearch','loggedin']],    
       
    [['GET','POST'], '/system/outletTypeForm/{id}', ['Modules\System\Controllers\System', 'outletType'],['sys_outletType','system']],  
    
    [['GET','POST'], '/system/zoneForm/{id}', ['Modules\System\Controllers\System', 'zoneForm'],['sys_zoneForm','system']],  
    [['GET','POST'], '/system/eventType/{id}', ['Modules\System\Controllers\System', 'eventType'],['sys_eventType','system']],  
    [['GET','POST'], '/system/shiftType/{id}', ['Modules\System\Controllers\System', 'shiftType'],['sys_shiftType','system']],
    [['GET','POST'], '/system/ticketType/{id}', ['Modules\System\Controllers\System', 'ticketType'],['sys_ticketType','system']],
    [['GET','POST'], '/system/changeAgenda', ['Modules\System\Controllers\System', 'changeAgenda'],['sys_changeAgenda','agenda']],
    [['GET','POST'], '/outletOutComes', ['Modules\Outlets\Controllers\Outlets', 'outletOutComes'],['outlet_outcomes','system']],
//    [['GET','POST'], '/remarks', ['Modules\System\Controllers\System', 'remark'],['remark','system']],
    [['GET','POST'], '/system/policyMaster', ['Modules\System\Controllers\System', 'policyMaster'],['sys_policyMaster','system']],
    [['GET','POST'], '/system/managePolicy/{id}', ['Modules\System\Controllers\System', 'managePolicy'],['sys_managePolicy','system']],    
    [['GET','POST'], '/system/gradeMaster', ['Modules\System\Controllers\System', 'gradeMaster'],['sys_gradeMaster','grade_master']],
    [['GET','POST'], '/system/companymaster', ['Modules\System\Controllers\System', 'companymaster'],['sys_companyMaster','system']],    
    [['GET','POST'], '/system/compmaster/{id}', ['Modules\System\Controllers\System', 'compmaster'],['sys_compmaster','system']],
    [['GET','POST'], '/system/unitForm/{id}', ['Modules\System\Controllers\System', 'unitForm'],['sys_unitForm','system']],    
    [['GET','POST'], '/system/policyKeyForm', ['Modules\System\Controllers\System', 'policyKeyForm'],['sys_policyKeyForm','system']],    
    [['GET','POST'], '/system/emailTemplate', ['Modules\System\Controllers\System', 'emailTemplate'],['sys_emailTemplate','system']],    
    [['GET','POST'], '/system/configuration', ['Modules\System\Controllers\System', 'configuration'],['sys_configuration','configuration']],
    [['GET','POST'], '/system/branchSearch', ['Modules\System\Controllers\System', 'branchSearch'],['sys_branchSearch','loggedin']],
    [['GET','POST'], '/system/departmentSearch', ['Modules\System\Controllers\System', 'departmentSearch'],['sys_departmentSearch','loggedin']],
    
    [['GET','POST'], '/system/ticketType', ['Modules\System\Controllers\System', 'ticketType'],['sys_ticketType','ticket_types']],
    [['GET','POST'], '/system/systemNotification', ['Modules\System\Controllers\System', 'systemNotification'],['sys_notification','any']],
    
    
    
    [['GET','POST'], '/system/searchcountry', ['Modules\System\Controllers\System', 'searchcountry'],['sys_searchcountry','loggedin']],
    [['GET','POST'], '/system/searchstate', ['Modules\System\Controllers\System', 'searchstate'],['sys_searchstate','loggedin']],
    [['GET','POST'], '/system/employeeLastLoc/{id}', ['Modules\System\Controllers\System', 'employeeLastLoc'],['hr','system']],    
    [['GET','POST'], '/system/companyConfiguration', ['Modules\System\Controllers\System', 'companyConfiguration'],['sys_companyConfiguration','system']],
    [['GET','POST'], '/system/taConfiguration', ['Modules\System\Controllers\System', 'taConfiguration'],['ta_configuration','system']],
    /* SUPER SETTINGS */
    ['GET', '/system/users', ['Modules\System\Controllers\System', 'userList'],['sys_userList','user_master']],
    [['GET','POST'], '/system/supersettings', ['Modules\System\Controllers\System', 'superSettings'],['sys_superSettings','super_setting']],
    [['GET','POST'], '/system/currency', ['Modules\System\Controllers\System', 'currency'],['sys_currency','super_admin']],    
    [['GET','POST'], '/system/countryMaster', ['Modules\System\Controllers\System', 'countryMaster'],['sys_countryMaster','super_setting']],
    [['GET','POST'], '/system/state/{id}', ['Modules\System\Controllers\System', 'state'],['sys_state','super_setting']],
    [['GET','POST'], '/system/city/{id}', ['Modules\System\Controllers\System', 'city'],['sys_city','super_setting']],
    [['GET','POST'], '/system/towns/{id}', ['Modules\System\Controllers\System', 'towns'],['sys_towns','super_setting']],
    [['GET','POST'], '/system/companyForm/{id}', ['Modules\System\Controllers\System', 'companyForm'],['sys_companyForm','super_setting']],
    [['GET','POST'], '/system/roleForm/{id}', ['Modules\System\Controllers\System', 'roleForm'],['sys_roleForm','super_setting']],
    [['GET','POST'], '/system/languageForm/{id}', ['Modules\System\Controllers\System', 'languageForm'],['sys_languageForm','system']], 
    
    /*API Document Keys*/
    [['GET','POST','PUT','DELETE'], '/api/createOtpRequest', ['Modules\System\Controllers\API', 'createOtpRequest'],['otpRequest','any']],
    [['GET','POST','PUT','DELETE'], '/api/verifyOtpRequest', ['Modules\System\Controllers\API', 'verifyOtpRequest'],['otpRequest','any']],
    [['GET','POST','PUT','DELETE'], '/api/getAgendas', ['Modules\System\Controllers\API', 'getAgendas'],['get_changeAgenda','any']],
    [['GET','POST','PUT','DELETE'], '/api/getMtpAgendas', ['Modules\System\Controllers\API', 'getMtpAgendas'],['get_mtpAgenda','any']],
    [['GET','POST','PUT','DELETE'], '/api/getRoles', ['Modules\System\Controllers\API', 'getRoles'],['get_roles','loggedin']],

    [['GET','POST','PUT','DELETE'], '/system/doCAV/{id}', ['Modules\System\Controllers\Orgstructure', 'doCAV'],['system_doCAV','loggedin']],

    [['GET','POST','PUT','DELETE'], '/api/getPendingActions', ['Modules\System\Controllers\API', 'getPendingActions'],['system_getPendingActions','loggedin']],

    [['GET','POST','PUT','DELETE'], '/api/appFirstStart', ['Modules\System\Controllers\API', 'appFirstStart'],['system_appFirstStart','loggedin']],
    
    /* FTP Module Routes */
    [['GET','POST','PUT','DELETE'], '/system/ftp-config', ['Modules\System\Controllers\System', 'ftpConfig'],['sys_ftpconfig','system']],
    [['GET','POST','PUT','DELETE'], '/system/ftp-batches', ['Modules\System\Controllers\System', 'ftpBatches'],['sys_ftpbatches','system']],
    [['GET','POST','PUT','DELETE'], '/system/ftp-import-logs', ['Modules\System\Controllers\System', 'ftpImportLogs'],['sys_ftpimportlogs','system']],

    [['POST'], '/system/table/data', ['Modules\System\Controllers\System', 'getTableData'],['sys_table_data','any']],

    [['GET','POST','PUT','DELETE'], '/api/lockEmployee', ['Modules\System\Controllers\System', 'lockEmployee'],['sys_lockEmployee','system']],
    [['GET','POST','PUT','DELETE'], '/api/getAddressFromReverseGeocode', ['Modules\System\Controllers\API', 'getAddressFromReverseGeocode'],['sys_lockEmployee','any']],
];
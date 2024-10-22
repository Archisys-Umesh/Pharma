<?php declare(strict_types = 1);

return [
        ['path'=>'','title'=>'Settings',"parent"=>"","index" => 9,"icon" =>"zmdi zmdi-settings"],	
	['path'=>'sys_userList','title'=>'User Management',"parent"=>"Settings","index"=>901],        
        ['path'=>'sys_orgStructure','title'=>'Org-Structure',"parent"=>"Settings","index"=>902],
        ['path'=>'sys_masters','title'=>'Masters',"parent"=>"Settings","index"=>902],
        ['path'=>'sys_changeAgenda','title'=>'Agenda',"parent"=>"Settings","index" => 904],
        ['path'=>'outlet_outcomes','title'=>'Outcomes',"parent"=>"Settings","index" => 905],
        ['path'=>'remarks','title'=>'Remarks',"parent"=>"Settings","index" => 91],
        ['path'=>'','title'=>'Base Masters',"parent"=>"Settings","index" => 90,],
    //    ['path'=>'sys_currency','title'=>'Currencies',"parent"=>"Base Masters","index"=>902],
    //    ['path'=>'sys_policyMaster','title'=>'Policies',"parent"=>"Settings","index"=>903],
        ['path'=>'sys_gradeMaster','title'=>'Grade Master',"parent"=>"Settings","index"=>903],
    //    ['path'=>'sys_companyMaster','title'=>'Company Master',"parent"=>"Settings","index"=>904],
//        ['path'=>'sys_emailTemplate','title'=>'Email Template',"parent"=>"Base Masters","index"=>1011],
        ['path'=>'sys_configuration','title'=>'Configuration',"parent"=>"Settings","index"=>900],
         ['path'=>'sys_superSettings','title'=>'Super Settings',"parent"=>"Settings","index"=>909],
    //    ['path'=>'sys_cityMaster','title'=>'City Master',"parent"=>"Base Masters","index"=>9013],            
    
    ['path'=>'ess_employee_leaves','title'=>'Employee Leaves',"parent"=>"Settings","index"=>9013],
        ['path'=>'','title'=>'Reports',"parent"=>"","index" => 8,"icon" =>"zmdi zmdi-print"],
    
        ['path'=>'hr_expenseReport','title'=>'Account Instructions',"parent"=>"Reports","index"=>1101],
    
        //['path'=>'hr_payoutReport','title'=>'Payout Breakup',"parent"=>"Reports","index"=>1102],           
        //['path'=>'hr_budgetReport','title'=>'Budget Breakup',"parent"=>"Reports","index"=>1103],           
        ['path'=>'ess_claimReport','title'=>'Payment Summary',"parent"=>"Reports","index"=>1104],

    //    ['path'=>'monitorTeamView','title'=>'Team Monitor',"parent"=>"Reports","index" => 1105],
    
    //    ['path'=>'sys_ticketType','title'=>'Ticket Type',"parent"=>"Settings","index" => 1107],
        

        ['path'=>'ess_expensesReports','title'=>'Expenses Slip',"parent"=>"Reports","index"=>1104],
        //['path'=>'hr_companyCardReports','title'=>'CC Reco. List',"parent"=>"Reports","index"=>1105],
        //['path'=>'hr_empSummary','title'=>'Expenses',"parent"=>"Reports","index" => 1106],
        //['path'=>'hr_empTrip','title'=>'Trips',"parent"=>"Reports","index" => 1107],
        ['path'=>'hr_adminReports','title'=>'ESS Overview',"parent"=>"Reports","index" => 1108],
            
        ['path'=>'hr_empSummary','title'=>'Employee Summary',"parent"=>"Reports","index" => 1110],

        ['path'=>'','title'=>'FTP Settings',"parent"=>"Settings","index" => 950],
        ['path'=>'sys_ftpconfig','title'=>'Config',"parent"=>"FTP Settings","index"=>1202],    
        ['path'=>'sys_ftpbatches','title'=>'Batches',"parent"=>"FTP Settings","index"=>1202],    
        ['path'=>'sys_ftpimportlogs','title'=>'Logs',"parent"=>"FTP Settings","index"=>1202], 
        
        ['path'=>'ta_configuration','title'=>'TA Configuration',"parent"=>"Settings","index"=>1203],
        //['path'=>'sys_notification','title'=>'System Notification',"parent"=>"Settings","index"=>1204],
        
        
            

];      

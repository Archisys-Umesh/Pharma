<?php declare(strict_types=1);

return [

    ['path' => '', 'title' => 'Employees', "parent" => "", "index" => 1, "icon" => "zmdi zmdi-accounts-alt"],

    ['path' => 'hr_empList', 'title' => 'Full List', "parent" => "Employees", "index" => 415],
    ['path' => 'hr_empBalanceLeave', 'title' => 'Employee Leave Balance', "parent" => "Employees", "index" => 415],
    ['path' => ['hr_empList_opt', ['id' => 'locked']], 'title' => 'Day Locked', "parent" => "Employees", "index" => 415],
    ['path' => ['hr_empList_opt', ['id' => 'freezed']], 'title' => 'Account Locked', "parent" => "Employees", "index" => 415],

    ['path' => '', 'title' => 'Expense-Mgmt', "parent" => "", "index" => 4, "icon" => "zmdi zmdi-money"],


    ['path' => '', 'title' => 'HR Settings', "parent" => "Settings", "index" => 91],
    ['path' => 'hr_cityCategory', 'title' => 'City Categories', "parent" => "HR Settings", "index" => 402],

    ['path' => 'hr_expenseMaster', 'title' => 'Expense Master', "parent" => "Settings", "index" => 404],
    ['path' => 'holidays', 'title' => 'Holiday', "parent" => "Settings", "index" => 404],
    ['path' => 'announcements', 'title' => 'Announcement', "parent" => "Settings", "index" => 404],
    ['path' => 'wdbsynclog', 'title' => 'WDB Sync Log', "parent" => "Settings", "index" => 404],
    //    ['path'=>'hr_ioMaster','title'=>'IO Master',"parent"=>"HR Settings","index"=>405],
    //    ['path'=>'hr_budgetGroups','title'=>'Budgets',"parent"=>"Settings","index"=>406],                
    //    ['path'=>'hr_auditUnitMap','title'=>'Audit-Units',"parent"=>"HR Settings","index"=>407],        
    ['path' => 'hr_divisionExpenseAudit', 'title' => 'Audit', "parent" => "Expense-Mgmt", "index" => 407],
    //['path'=>'hr_expenseAudit','title'=>'Audit-Old',"parent"=>"HR","index"=>409],
    //['path'=>'hr_audit','title'=>'Audit remove',"parent"=>"HR","index"=>410],
    //['path'=>'','title'=>'Reports',"parent"=>"HR","index"=>411],
    //['path'=>'hr_expenseReport','title'=>'Expense Report',"parent"=>"Reports","index"=>4111],
    //['path'=>'hr_hrReminders','title'=>'Reminders',"parent"=>"HR Settings","index"=>4012],

    //['path'=>'hr_expenseReport','title'=>'Audited Expenses',"parent"=>"Reports","index"=>6004],
//        ['path'=>'','title'=>'ESS Reports',"parent"=>"","index" => 11,"icon" =>"zmdi zmdi-invert-colors"],
    //['path'=>'hr_payoutReport','title'=>'Payout Reports',"parent"=>"ESS Reports","index"=>1101],
//        ['path'=>'hr_budgetReport','title'=>'Budget Reports',"parent"=>"ESS Reports","index"=>1102],           


];

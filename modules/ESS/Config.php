<?php

return [    
    "tripType" => ["1" => "Ex-HQ","2" => "Out-Station"],  
    "tripFilters" => ['' => "All","1" => "My Approved","2" => "Pending Approval","3"=>"Closed/Cancelled","4"=>"Approval Requested"],
    "allowedMonths" => 7,
    "maxAttachments" => 1,
    "submitCurrentMonth"=> FALSE,
    "monthlySubmissions"=>FALSE,
    "ClaimAmount"=> -1, // ClaimAmount 0 Expenses expenses submit set -1
    "minimumClaimAmount"=>0.1, // expenses submit for minimum amount, ex: 0 will not submit set for 1

    "leaveType" => ["CL" => "Casual Leave","PL" => "Privilege Leave","SL" => "Sick Leave","LWP" => "Leave Without Pay", "ML" => "Maternity Leave"], //"ParentalLeave" => "Parental Leave",
    "leaveStatus" => ["Submitted" => "0","Raised" => "1","Approved" => "2","Rejected" => "3","Cancelled" => "4","Closed" => "5",],

    "tripTypes" => ["HQ" => "HQ","Ex-HQ" => "Ex-HQ","Out-Station" => "Out-Station"],
    "ExpMode" => ["Flat" => "Flat","Per-KM" => "Per-KM"],    
    
    "leaveTranMod" => ["Accuration" => "Accuration","Opening" => "Opening","Reward" => "Reward"], 
];
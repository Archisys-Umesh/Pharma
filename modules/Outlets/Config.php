<?php
return [
    
    "salutation" => ['MR'=>'MR','MRS'=>'MRS','DR'=>'DR'],
    "MaritalStatus" => ['M'=>'MARRIED','S'=>'SINGLE','D'=>'DIVORSED'],
    "VisitFq" => ["0" => "No Compliance","1" => "1.FQ","2" => "2.FQ","3" => "3.FQ"],
    "AddressName" => ["Clinic" => "Clinic","Hospital" => "Hospital","Residential" => "Residential","Commercial" => "Commercial"],
    "clasification" => ['A'=>'A','A+'=>'A+','B'=>'B','B+'=>'B+','C'=>'C','C+'=>'C+'],
    "OutletStatus" => 
    [
        "active" => "Active",
        "inactive" => "In-Active",
        "pending" => "Pending Approval",
        "Frozen" => "Frozen",        
    ],
    "MediaReason" => ['OutletCheckIn'=>'OutletCheckIn','OutletCheckOut'=>'OutletCheckOut','Grooming'=>'Grooming'],
    "VisitFrequency" => ["1" => "1 VF","2" => "2 VF","3" => "3 VF"],
    "OnBoardStatus" => [
        4 => "Approve",
        1 => "Draft",
        2 => "Submitted",
        3 => "Pending to approve",
        5 => "Rejected",
        6 => "Final Approved",
        7 => "Request Address Deleted",
        8 => "Deleted",
        9 => "In Progress",
        10 => "Executed",
    ],
    "OnBoardAddressStatus" => [
        "NewAdded" => "NewAdded",
        "Update" => "Update",
        "Delete" => "Delete",
    ],

    "PrescriberStatus" => [
        "Gain" => "Gain",
        "Loss" => "Loss",
        "2_Months_Rxer" => "2 Months Rxber",
        "Non_Rxer" => "Non Rxber",   
    ],
    
];

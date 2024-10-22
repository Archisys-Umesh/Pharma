<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/fsm/territories', ['Modules\FSM\Controllers\Masters', 'territories'],['fsm_territories','territories']],
    [['GET','POST'], '/fsm/territoryTowns/{id}', ['Modules\FSM\Controllers\Masters', 'territoryTowns'],['fsm_territoryTowns','hr']],      
    [['GET','POST'], '/fsm/beats', ['Modules\FSM\Controllers\Beats', 'beats'],['fsm_beats','beat']],
    [['GET','POST'], '/fsm/territorySearch', ['Modules\FSM\Controllers\Beats', 'territorySearch'],['fsm_territorySearch','hr']],      
    
    [['GET','POST'], '/fsm/mtp', ['Modules\FSM\Controllers\MTP', 'mtp'],['fsm_mtp','mtp']],
    [['GET','POST'], '/fsm/mtpDates/{id}', ['Modules\FSM\Controllers\MTP', 'mtpDates'],['fsm_mtpDates','hr']],      
    [['GET','POST'], '/fsm/mtpTourplan/{id}', ['Modules\FSM\Controllers\MTP', 'mtpTourplan'],['fsm_mtpTourplan','hr']],      

    [['GET','POST'], '/fsm/mtpActions/{id}', ['Modules\FSM\Controllers\MTP', 'mtpActions'],['fsm_mtpActions','hr']],      

    
    [['GET','POST'], '/fsm/beatoutlets/{id}', ['Modules\FSM\Controllers\Beats', 'beatoutlets'],['fsm_beatoutlets','hr']],      
    [['GET','POST'], '/fsm/tourplanList', ['Modules\FSM\Controllers\Beats', 'tourplanList'],['fsm_tourplanList','ess']],
    [['GET','POST'], '/fsm/material', ['Modules\FSM\Controllers\Masters', 'material'],['fsm_material','ess']],
    
    
    
    

    [['GET','POST'], '/fsm/teamview', ['Modules\FSM\Controllers\Monitor', 'TeamView'],['monitorTeamView','ess']],
    [['GET','POST'], '/fsm/mapView', ['Modules\FSM\Controllers\Monitor', 'mapView'],['monitorMapView','ess']],


    //[['GET','POST'], '/fsm/competitionMapping', ['Modules\FSM\Controllers\Masters', 'competitionMapping'],['fsm_competition','ess']],
    
    [['GET','POST'], '/fsm/getPlanActivity', ['Modules\FSM\Controllers\Beats', 'getPlanActivity'],['fsm_PlanActivity','ess']],   
    
    [['GET','POST'], '/fsm/events', ['Modules\FSM\Controllers\Events', 'getList'],['fsm_event_list','ess']],   
    [['GET','POST'], '/fsm/eventForm/{pk}', ['Modules\FSM\Controllers\Events', 'initForm'],['fsm_EventForm','ess']],   
    [['GET','POST'], '/fsm/event/{id}', ['Modules\FSM\Controllers\Events', 'single'],['fsm_EventSingle','ess']],       
    [['GET','POST'], '/fsm/event/actions/{id}/{stepid}', ['Modules\FSM\Controllers\Events', 'setNextAction'],['fsm_events_NextAction','ess']],
    
    [['GET','POST'], '/fsm/quickEventView', ['Modules\FSM\Controllers\Events', 'quickEventView'],['fsm_quickEventView','ess']],   

    [['GET','POST'], '/fsm/onBoardWindow', ['Modules\FSM\Controllers\Masters', 'onBoardWindow'],['fsm_onBoardWindow','loggedin']],
    [['GET','POST'], '/fsm/getOrgTerritories', ['Modules\FSM\Controllers\Masters', 'getOrgTerritories'],['fsm_getOrgTerritories','loggedin']],
    [['GET','POST'], '/fsm/getSelectedTerritories', ['Modules\FSM\Controllers\Masters', 'getSelectedTerritories'],['fsm_getSelectedTerritories','loggedin']],

    [['GET','POST'], '/fsm/getOrgUnitList', ['Modules\FSM\Controllers\OnBoard', 'getOrgUnitList'],['fsm_getOrgUnitList','onboard_requests']],
    [['GET','POST'], '/fsm/onBoardRequest/{orgunit}', ['Modules\FSM\Controllers\OnBoard', 'onBoardRequest'],['fsm_onBoardRequest','onboard_requests']],
    [['GET','POST'], '/fsm/onBoardRequestDetails/{id}', ['Modules\FSM\Controllers\OnBoard', 'onBoardRequestDetails'],['fsm_onBoardRequestDetails','onboard_requests']],
    [['GET','POST'], '/fsm/onBoardRequiredFields', ['Modules\FSM\Controllers\OnBoard', 'onBoardRequiredFields'],['fsm_onBoardRequiredFields','onboard_requests']],
    
    /*API Document Keys*/
    [['GET','POST','PUT','DELETE'], '/api/getTerritories', ['Modules\FSM\Controllers\API', 'getTerritories'],['territories','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/GetDefaultBeat', ['Modules\FSM\Controllers\API', 'GetDefaultBeat'],['beats','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getAllBeat', ['Modules\FSM\Controllers\API', 'getAllBeat'],['beats','loggedin']],
    
    [['GET','POST','PUT','DELETE'], '/api/generateTourPlan', ['Modules\FSM\Controllers\API', 'generateTourPlan'],['beats','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getNextMonthTourPlan', ['Modules\FSM\Controllers\API', 'getNextMonthTourPlan'],['beats','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getCurrentMonthTourPlan', ['Modules\FSM\Controllers\API', 'getCurrentMonthTourPlan'],['beats','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/updateTourPlan', ['Modules\FSM\Controllers\API', 'updateTourPlan'],['beats','loggedin']],
    
    [['GET','POST','PUT','DELETE'], '/api/getEventTypes', ['Modules\FSM\Controllers\API', 'getEventTypes'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getAllevent', ['Modules\FSM\Controllers\API', 'getAllevent'],['event','loggedin']],    
    [['GET','POST','PUT','DELETE'], '/api/getEventByID', ['Modules\FSM\Controllers\API', 'getEventByID'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/createEvent', ['Modules\FSM\Controllers\API', 'createEvent'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getAllPendingApprovalEvent', ['Modules\FSM\Controllers\API', 'getAllPendingApprovalEvent'],['event_pa','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getEventActions', ['Modules\FSM\Controllers\API', 'getEventActions'],['event_getEventActions','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/ChangeEventStatus', ['Modules\FSM\Controllers\API', 'ChangeEventStatus'],['event_ChangeEventStatus','loggedin']],
    
    
    
    [['GET','POST','PUT','DELETE'], '/api/getAllMaterial', ['Modules\FSM\Controllers\API', 'getAllMaterial'],['material','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/createCompetition', ['Modules\FSM\Controllers\API', 'createCompetition'],['competition','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getCompetitionByOutletId', ['Modules\FSM\Controllers\API', 'getCompetitionByOutletId'],['competition','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getRosterPlanOutlet', ['Modules\FSM\Controllers\API', 'getRosterPlanOutlet'],['competition','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getEventLog', ['Modules\FSM\Controllers\API', 'getEventLog'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getDesignation', ['Modules\FSM\Controllers\API', 'getDesignation'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/eventDelete', ['Modules\FSM\Controllers\API', 'eventDelete'],['event','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/eventFilter', ['Modules\FSM\Controllers\API', 'eventFilter'],['event','loggedin']],

    [['GET','POST','PUT','DELETE'], '/api/getPendingTPbyEmployee', ['Modules\FSM\Controllers\API', 'getPendingTPbyEmployee'],['getPendingTPbyEmployee','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/approveTP', ['Modules\FSM\Controllers\API', 'approveTP'],['approveTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/rejectMTP', ['Modules\FSM\Controllers\API', 'rejectMTP'],['rejectMTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getTPStates', ['Modules\FSM\Controllers\API', 'getTPStates'],['getTPStates','loggedin']],
    
    [['GET','POST'], '/api/mtp24', ['Modules\FSM\Controllers\API', 'mtp24'],['mtp24','any']],
    [['GET','POST','PUT','DELETE'], '/api/createMTP', ['Modules\FSM\Controllers\API', 'createMTP'],['createMTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getRemainingDoctor', ['Modules\FSM\Controllers\API', 'getRemainingDoctor'],['getRemainingDoctor','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getMTPList', ['Modules\FSM\Controllers\API', 'getMTPList'],['getMTPList','any']],
    [['GET','POST','PUT','DELETE'], '/api/getMtpLogById', ['Modules\FSM\Controllers\API', 'getMtpLogById'],['getMtpLogById','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getMTPListV2', ['Modules\FSM\Controllers\API', 'getMTPListV2'],['getMTPListV2','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getMtpById', ['Modules\FSM\Controllers\API', 'getMtpById'],['getMtpById','any']],
    [['GET','POST','PUT','DELETE'], '/api/getMtpByIdV2', ['Modules\FSM\Controllers\API', 'getMtpByIdV2'],['getMtpByIdV2','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/addTourPlan', ['Modules\FSM\Controllers\API', 'addTourPlan'],['addTourPlan','any']],
    [['GET','POST','PUT','DELETE'], '/api/deleteTourPlan', ['Modules\FSM\Controllers\API', 'deleteTourPlan'],['deleteTourPlan','loggedin']],  
    [['GET','POST','PUT','DELETE'], '/api/approveMTP', ['Modules\FSM\Controllers\API', 'approveMTP'],['approveMTP','loggedin']],  
    [['GET','POST','PUT','DELETE'], '/api/getMtpDayById', ['Modules\FSM\Controllers\API', 'getMtpDayById'],['getMtpDayById','loggedin']],  
    [['GET','POST','PUT','DELETE'], '/api/getBeats', ['Modules\FSM\Controllers\API', 'getBeats'],['getBeats','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getBeatById', ['Modules\FSM\Controllers\API', 'getBeatById'],['getBeatById','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/submitMTP', ['Modules\FSM\Controllers\API', 'submitMTP'],['submitMTP','any']],

    [['GET','POST','PUT','DELETE'], '/api/getMTPListNew', ['Modules\FSM\Controllers\API', 'getMTPListNew'],['getMTPListNew','any']],

    [['GET','POST','PUT','DELETE'], '/api/getCustomersByBeat', ['Modules\FSM\Controllers\API', 'getCustomersByBeat'],['getCustomersByBeat','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getCustomerForJW', ['Modules\FSM\Controllers\API', 'getCustomerForJW'],['getCustomerForJW','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getTerritoriesArray', ['Modules\FSM\Controllers\API', 'getTerritoriesArray'],['getTerritoriesArray','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getMtpTerritoriesList', ['Modules\FSM\Controllers\API', 'getMtpTerritoriesList'],['getMtpTerritoriesList','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getRequestedMTPByPosition', ['Modules\FSM\Controllers\API', 'getRequestedMTPByPosition'],['getRequestedMTPByPosition','any']],
    [['GET','POST','PUT','DELETE'], '/api/getRequestedMTPByPositionV2', ['Modules\FSM\Controllers\API', 'getRequestedMTPByPositionV2'],['getRequestedMTPByPositionV2','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/resetMTP', ['Modules\FSM\Controllers\API', 'resetMTP'],['resetMTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/doctor360hospicare', ['Modules\FSM\Controllers\API', 'doctor360Hospicare'],['resetMTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/mtpDaysDelete', ['Modules\FSM\Controllers\API', 'mtpDaysDelete'],['mtpDaysDelete','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getSTP', ['Modules\FSM\Controllers\API', 'getSTP'],['getSTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/createSTP', ['Modules\FSM\Controllers\API', 'createSTP'],['createSTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/approveSTP', ['Modules\FSM\Controllers\API', 'approveSTP'],['approveSTP','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/rejectStp', ['Modules\FSM\Controllers\API', 'rejectStp'],['rejectStp','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getStpList', ['Modules\FSM\Controllers\API', 'getStpList'],['getStpList','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getStpById', ['Modules\FSM\Controllers\API', 'getStpById'],['getStpById','loggedin']],

];
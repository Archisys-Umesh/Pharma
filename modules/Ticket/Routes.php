<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/tickets', ['Modules\Ticket\Controllers\Ticket', 'Tickets'],['ticket_list','ticket_list']],
    [['GET','POST'], '/ticket_types', ['Modules\Ticket\Controllers\Ticket', 'TicketType'],['ticket_type_list','ticket_types']],
    [['GET','POST'], '/ticketComment/{id}', ['Modules\Ticket\Controllers\Ticket', 'ticketComment'],['ticket_comment','loggedin']],
    
    /*API Document Keys*/

    /*[['GET','POST','PUT','DELETE'], '/api/getsurvey', ['Modules\Ticket\Controllers\API', 'getsurvey'],['getsurvey','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getsurveycategoies', ['Modules\Ticket\Controllers\API', 'getSurveyCategory'],['survey_category','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/surveyquestions', ['Modules\Ticket\Controllers\API', 'SurveyQuestions'],['survey_questions','any']],
    [['GET','POST','PUT','DELETE'], '/api/generatesurveybyid', ['Modules\Ticket\Controllers\API', 'generatesurveybyid'],['surveyid_generate','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getsurveyanswer', ['Modules\Ticket\Controllers\API', 'getsurveyanswer'],['survey_question','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getTicketTypes', ['Modules\Ticket\Controllers\API', 'getTicketTypes'],['Ticket','any']],*/
    [['GET','POST','PUT','DELETE'], '/api/get-user-profile', ['Modules\Ticket\Controllers\API', 'getUserProfile'],['Ticket','any']],
    [['GET','POST','PUT','DELETE'], '/api/getAllTicket', ['Modules\Ticket\Controllers\API', 'getAllTicket'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/ticketFilter', ['Modules\Ticket\Controllers\API', 'ticketFilter'],['ticket_filter','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getIdByTicket', ['Modules\Ticket\Controllers\API', 'getIdByTicket'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getOutlets', ['Modules\Ticket\Controllers\API', 'getOutlets'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/createTicket', ['Modules\Ticket\Controllers\API', 'createTicket'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getTicketReplies', ['Modules\Ticket\Controllers\API', 'getTicketReplies'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/addTicketReplies', ['Modules\Ticket\Controllers\API', 'addTicketReplies'],['Ticket','loggedin']],
    
    [['GET','POST','PUT','DELETE'], '/api/uploadMedia', ['Modules\Ticket\Controllers\API', 'uploadMedia'],['Ticket','any']],
    [['GET','POST','PUT','DELETE'], '/api/uploadMediaBase64', ['Modules\Ticket\Controllers\API', 'uploadMediaBase64'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getMedia', ['Modules\Ticket\Controllers\API', 'getMedia'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/uploadFile', ['Modules\Ticket\Controllers\API', 'uploadFile'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/downloadFile', ['Modules\Ticket\Controllers\API', 'downloadFile'],['Ticket','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/deleteFile', ['Modules\Ticket\Controllers\API', 'deleteFile'],['Ticket','loggedin']],
];
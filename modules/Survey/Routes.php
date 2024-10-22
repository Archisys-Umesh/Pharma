<?php declare(strict_types = 1);

return [
    
    [['GET','POST','PUT','DELETE'], '/survey/surveycategory', ['Modules\Survey\Controllers\Masters', 'surveyCategory'],['survey_categories','survey_category']],
    [['GET','POST','PUT','DELETE'], '/survey/surveyquestion/{id}', ['Modules\Survey\Controllers\Masters', 'surveyQuestion'],['survey_question','loggedin']],
    [['GET','POST','PUT','DELETE'], '/survey/surveyanswer/{id}', ['Modules\Survey\Controllers\Masters', 'surveyAnswer'],['survey_answer','loggedin']],
    [['GET','POST','PUT','DELETE'], '/survey/surveysubmitted', ['Modules\Survey\Controllers\Masters', 'surveySubmitted'],['survey_submitted','loggedin']],
    [['GET','POST','PUT','DELETE'], '/survey/survey', ['Modules\Survey\Controllers\Masters', 'survey'],['survey','survey']],

    [['GET','POST','PUT','DELETE'], '/api/getsurvey', ['Modules\Survey\Controllers\Apis', 'getsurvey'],['getsurvey','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getsurveycategoies', ['Modules\Survey\Controllers\Apis', 'getSurveyCategory'],['survey_category','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/surveyquestions', ['Modules\Survey\Controllers\Apis', 'SurveyQuestions'],['survey_questions','any']],
    [['GET','POST','PUT','DELETE'], '/api/generatesurveybyid', ['Modules\Survey\Controllers\Apis', 'generatesurveybyid'],['surveyid_generate','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getsurveyanswer', ['Modules\Survey\Controllers\Apis', 'getsurveyanswer'],['survey_question','loggedin']],
    [['GET','POST','PUT','DELETE'], '/api/getTicketTypes', ['Modules\Survey\Controllers\Apis', 'getTicketTypes'],['Ticket','any']]

    /*API Document Keys*/
    /* Survey Module API */
//    [['GET','POST','PUT','DELETE'], '/api/getsurvey', ['Modules\Survey\Controllers\API', 'getsurvey'],['survey','loggedin']],
//    [['GET','POST','PUT','DELETE'], '/api/generatesurveybyid', ['Modules\Survey\Controllers\API', 'generatesurveybyid'],['surveyid_generate','loggedin']],


];
<?php declare(strict_types = 1);

return [
	[['GET', 'POST'], '/home', ['Modules\Home\Controllers\Homepage', 'show'],['Home','loggedin']],	
        ['GET', '/home/{func}', ['Modules\Home\Controllers\Homepage', '__remap'],['test','tester']], // Magic Route
        [['GET', 'POST'], '/monthlyReportsforEmployee', ['Modules\Home\Controllers\Homepage', 'monthlyReportsforEmployee'],['Home','any']],	
        [['GET', 'POST'], '/createdemoexpenses', ['Modules\Home\Controllers\Homepage', 'createdemoexpenses'],['Home','any']],	
        
];

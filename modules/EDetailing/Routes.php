<?php declare(strict_types = 1);

return [

    [['GET','POST','PUT','DELETE'], '/e-detailing/presentation', ['Modules\EDetailing\Controllers\Master', 'Presentation'],['presentation','presentation']],
    [['GET','POST','PUT','DELETE'], '/e-detailing/playlist', ['Modules\EDetailing\Controllers\Master', 'Playlist'],['playlist','playlist']],
    [['GET','POST','PUT','DELETE'], '/e-detailing/reports', ['Modules\EDetailing\Controllers\Master', 'reports'],['reports','reports']],

    [['GET','POST','PUT','DELETE'], '/e-detailing/playlistType', ['Modules\EDetailing\Controllers\Master', 'playlistType'],['playlistType','playlist']],

    [['GET','POST'], '/api/getHolidayList', ['Modules\EDetailing\Controllers\API', 'getHolidayList'],['holiday','loggedin']],
    [['GET','POST'], '/api/detailingHeatMap', ['Modules\EDetailing\Controllers\API', 'detailingHeatMap'],['detailingHeatMap','loggedin']],
    [['GET','POST'], '/api/lastDoctorDetail', ['Modules\EDetailing\Controllers\API', 'lastDoctorDetail'],['lastDoctorDetail','loggedin']],
    [['GET','POST'], '/api/eDetailingBackup', ['Modules\EDetailing\Controllers\API', 'eDetailingBackup'],['eDetailingBackup','loggedin']],

    
    ];
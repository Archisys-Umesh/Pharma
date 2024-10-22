<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/material/folders', ['Modules\Material\Controllers\Material', 'folders'],['material_folders','files']],
    [['GET','POST'], '/material/files', ['Modules\Material\Controllers\Material', 'files'],['material_files','folder']],

    // API
    [['GET','POST'], '/api/getFolders', ['Modules\Material\Controllers\API', 'getFolders'],['api_getFolders','hr']],      
    [['GET','POST'], '/api/getFiles', ['Modules\Material\Controllers\API', 'getFiles'],['api_getFiles','hr']],      
    [['GET','POST'], '/api/getFoldersAndFiles', ['Modules\Material\Controllers\API', 'getFoldersAndFiles'],['api_getFoldersAndFiles','hr']],      
    
      
];
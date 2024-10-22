<?php

declare(strict_types = 1);

return [
        [['GET', 'POST'], '/', ['App\Core\Auth', 'login'], ['login', 'any']],
        [['GET', 'POST'], '/forgotPwd', ['App\Core\Auth', 'forgotPwd'], ['forgotPwd', 'any']],
        [['GET', 'POST'], '/register', ['App\Core\Auth', 'register'], ['register', 'any']],
        [['GET', 'POST'], '/getCountryForRegister', ['App\Core\Auth', 'getCountryForRegister'], ['getCountryForRegister', 'any']],
        [['GET', 'POST'], '/register_new', ['App\Core\Auth', 'register_new'], ['register_new', 'any']],
        [['GET', 'POST'], '/logout', ['App\Core\Auth', 'logout'], ['logout', 'loggedin']],
        [['GET', 'POST'], '/changepwd', ['App\Core\Auth', 'changePwd'], ['changepwd', 'loggedin']],
        [['GET', 'POST'], '/authoriseWithToken/{id}', ['App\Core\Auth', 'authoriseWithToken'], ['authoriseWithToken', 'super_admin']],
        [['GET', 'POST'], '/api', ['App\Core\Swagger', 'index'], ['api_help', 'any']],
        [['GET', 'POST'], '/api/doc', ['App\Core\Swagger', 'UI'], ['api_ui', 'any']],
        [['GET', 'POST'], '/mediamanager', ['App\Core\MediaManager', 'index'], ['media_manager', 'any']],
        [['GET', 'POST'], '/media/folderList', ['App\Core\MediaManager', 'getFolderList'], ['getFolderList', 'any']],
        [['GET', 'POST'], '/media/folder', ['App\Core\MediaManager', 'getFiles'], ['mediaFiles', 'any']],
        [['GET', 'POST'], '/media/createfolder', ['App\Core\MediaManager', 'createFolder'], ['createFolder', 'any']],
        [['GET'], '/media', ['App\Core\MediaManager', 'media'], ['media', 'any']],
        [['GET', 'POST'], '/createJsonDump', ['App\Utils\JsonDumpGenerator', 'createJsonDump'], ['jsonDump', 'loggedin']],
        [['GET', 'POST'], '/media/delete', ['App\Core\MediaManager', 'deleteMedia'], ['deleteMedia', 'loggedin']],
        [['GET', 'POST'], '/media/upload', ['App\Core\MediaManager', 'uploadNewFile'], ['uploadNewFile', 'loggedin']],
    
    
];

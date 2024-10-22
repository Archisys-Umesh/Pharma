<?php declare(strict_types = 1);

return [
    
    [['GET','POST'], '/sync/pull', ['Modules\OfflineSync\Controllers\API', 'pull'],['sync_pull','loggedin']],
    [['GET','POST'], '/sync/push', ['Modules\OfflineSync\Controllers\API', 'push'],['sync_push','loggedin']],
  
    [['GET','POST'], '/sync/restore', ['Modules\OfflineSync\Controllers\OfflineSync', 'wdbrestore'],['wdbrestore','loggedin']],
    
        
];
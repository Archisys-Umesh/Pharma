web: vendor/bin/heroku-php-nginx -C nginx_app.conf public/ 
worker: php bin/arch syncRunner
worker2: php bin/arch lowLevelWorkerRunner
worker3: php bin/arch mediumLevelWorkerRunner
worker4: php bin/arch highLevelWorkerRunner
worker5: php bin/arch highLevelMultipleWorkerRunner
worker6: php bin/arch mediumLevelMultipleWorkerRunner
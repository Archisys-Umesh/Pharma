CALL vendor\bin\propel database:reverse --namespace=entities
CALL copy /y generated-reversed-database\schema.xml schema.xml
CALL rmdir /s /q generated-reversed-database
CALL vendor\bin\propel model:build
CALL rmdir /s /q entities
CALL xcopy generated-classes\entities entities /E/H/I/C
CALL copy /y generated-conf/loadDatabase.php loadDatabase.php
CALL rmdir /s /q generated-classes generated-conf
vendor\bin\propel database:reverse --namespace=entities
rm -r schema.xml
mv generated-reversed-database/schema.xml schema.xml
rm -r generated-reversed-database

vendor\bin\propel migration:diff
vendor\bin\propel migration:migrate
rm -r generated-migrations
vendor/bin/propel model:build
rsync -avzh generated-classes/Ignis/entities/ src/entities/
rm -r generated-classes

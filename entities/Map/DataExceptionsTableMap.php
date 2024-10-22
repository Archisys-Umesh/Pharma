<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\DataExceptions;
use entities\DataExceptionsQuery;


/**
 * This class defines the structure of the 'data_exceptions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DataExceptionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DataExceptionsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'data_exceptions';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DataExceptions';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DataExceptions';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DataExceptions';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the data_exception_id field
     */
    public const COL_DATA_EXCEPTION_ID = 'data_exceptions.data_exception_id';

    /**
     * the column name for the exception_name field
     */
    public const COL_EXCEPTION_NAME = 'data_exceptions.exception_name';

    /**
     * the column name for the class_path field
     */
    public const COL_CLASS_PATH = 'data_exceptions.class_path';

    /**
     * the column name for the subject field
     */
    public const COL_SUBJECT = 'data_exceptions.subject';

    /**
     * the column name for the active field
     */
    public const COL_ACTIVE = 'data_exceptions.active';

    /**
     * the column name for the client_emails field
     */
    public const COL_CLIENT_EMAILS = 'data_exceptions.client_emails';

    /**
     * the column name for the team_emails field
     */
    public const COL_TEAM_EMAILS = 'data_exceptions.team_emails';

    /**
     * the column name for the logger_name field
     */
    public const COL_LOGGER_NAME = 'data_exceptions.logger_name';

    /**
     * the column name for the schedule_time field
     */
    public const COL_SCHEDULE_TIME = 'data_exceptions.schedule_time';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'data_exceptions.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'data_exceptions.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'data_exceptions.company_id';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['DataExceptionId', 'ExceptionName', 'ClassPath', 'Subject', 'Active', 'ClientEmails', 'TeamEmails', 'LoggerName', 'ScheduleTime', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['dataExceptionId', 'exceptionName', 'classPath', 'subject', 'active', 'clientEmails', 'teamEmails', 'loggerName', 'scheduleTime', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, DataExceptionsTableMap::COL_EXCEPTION_NAME, DataExceptionsTableMap::COL_CLASS_PATH, DataExceptionsTableMap::COL_SUBJECT, DataExceptionsTableMap::COL_ACTIVE, DataExceptionsTableMap::COL_CLIENT_EMAILS, DataExceptionsTableMap::COL_TEAM_EMAILS, DataExceptionsTableMap::COL_LOGGER_NAME, DataExceptionsTableMap::COL_SCHEDULE_TIME, DataExceptionsTableMap::COL_CREATED_AT, DataExceptionsTableMap::COL_UPDATED_AT, DataExceptionsTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['data_exception_id', 'exception_name', 'class_path', 'subject', 'active', 'client_emails', 'team_emails', 'logger_name', 'schedule_time', 'created_at', 'updated_at', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['DataExceptionId' => 0, 'ExceptionName' => 1, 'ClassPath' => 2, 'Subject' => 3, 'Active' => 4, 'ClientEmails' => 5, 'TeamEmails' => 6, 'LoggerName' => 7, 'ScheduleTime' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'CompanyId' => 11, ],
        self::TYPE_CAMELNAME     => ['dataExceptionId' => 0, 'exceptionName' => 1, 'classPath' => 2, 'subject' => 3, 'active' => 4, 'clientEmails' => 5, 'teamEmails' => 6, 'loggerName' => 7, 'scheduleTime' => 8, 'createdAt' => 9, 'updatedAt' => 10, 'companyId' => 11, ],
        self::TYPE_COLNAME       => [DataExceptionsTableMap::COL_DATA_EXCEPTION_ID => 0, DataExceptionsTableMap::COL_EXCEPTION_NAME => 1, DataExceptionsTableMap::COL_CLASS_PATH => 2, DataExceptionsTableMap::COL_SUBJECT => 3, DataExceptionsTableMap::COL_ACTIVE => 4, DataExceptionsTableMap::COL_CLIENT_EMAILS => 5, DataExceptionsTableMap::COL_TEAM_EMAILS => 6, DataExceptionsTableMap::COL_LOGGER_NAME => 7, DataExceptionsTableMap::COL_SCHEDULE_TIME => 8, DataExceptionsTableMap::COL_CREATED_AT => 9, DataExceptionsTableMap::COL_UPDATED_AT => 10, DataExceptionsTableMap::COL_COMPANY_ID => 11, ],
        self::TYPE_FIELDNAME     => ['data_exception_id' => 0, 'exception_name' => 1, 'class_path' => 2, 'subject' => 3, 'active' => 4, 'client_emails' => 5, 'team_emails' => 6, 'logger_name' => 7, 'schedule_time' => 8, 'created_at' => 9, 'updated_at' => 10, 'company_id' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DataExceptionId' => 'DATA_EXCEPTION_ID',
        'DataExceptions.DataExceptionId' => 'DATA_EXCEPTION_ID',
        'dataExceptionId' => 'DATA_EXCEPTION_ID',
        'dataExceptions.dataExceptionId' => 'DATA_EXCEPTION_ID',
        'DataExceptionsTableMap::COL_DATA_EXCEPTION_ID' => 'DATA_EXCEPTION_ID',
        'COL_DATA_EXCEPTION_ID' => 'DATA_EXCEPTION_ID',
        'data_exception_id' => 'DATA_EXCEPTION_ID',
        'data_exceptions.data_exception_id' => 'DATA_EXCEPTION_ID',
        'ExceptionName' => 'EXCEPTION_NAME',
        'DataExceptions.ExceptionName' => 'EXCEPTION_NAME',
        'exceptionName' => 'EXCEPTION_NAME',
        'dataExceptions.exceptionName' => 'EXCEPTION_NAME',
        'DataExceptionsTableMap::COL_EXCEPTION_NAME' => 'EXCEPTION_NAME',
        'COL_EXCEPTION_NAME' => 'EXCEPTION_NAME',
        'exception_name' => 'EXCEPTION_NAME',
        'data_exceptions.exception_name' => 'EXCEPTION_NAME',
        'ClassPath' => 'CLASS_PATH',
        'DataExceptions.ClassPath' => 'CLASS_PATH',
        'classPath' => 'CLASS_PATH',
        'dataExceptions.classPath' => 'CLASS_PATH',
        'DataExceptionsTableMap::COL_CLASS_PATH' => 'CLASS_PATH',
        'COL_CLASS_PATH' => 'CLASS_PATH',
        'class_path' => 'CLASS_PATH',
        'data_exceptions.class_path' => 'CLASS_PATH',
        'Subject' => 'SUBJECT',
        'DataExceptions.Subject' => 'SUBJECT',
        'subject' => 'SUBJECT',
        'dataExceptions.subject' => 'SUBJECT',
        'DataExceptionsTableMap::COL_SUBJECT' => 'SUBJECT',
        'COL_SUBJECT' => 'SUBJECT',
        'data_exceptions.subject' => 'SUBJECT',
        'Active' => 'ACTIVE',
        'DataExceptions.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'dataExceptions.active' => 'ACTIVE',
        'DataExceptionsTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'data_exceptions.active' => 'ACTIVE',
        'ClientEmails' => 'CLIENT_EMAILS',
        'DataExceptions.ClientEmails' => 'CLIENT_EMAILS',
        'clientEmails' => 'CLIENT_EMAILS',
        'dataExceptions.clientEmails' => 'CLIENT_EMAILS',
        'DataExceptionsTableMap::COL_CLIENT_EMAILS' => 'CLIENT_EMAILS',
        'COL_CLIENT_EMAILS' => 'CLIENT_EMAILS',
        'client_emails' => 'CLIENT_EMAILS',
        'data_exceptions.client_emails' => 'CLIENT_EMAILS',
        'TeamEmails' => 'TEAM_EMAILS',
        'DataExceptions.TeamEmails' => 'TEAM_EMAILS',
        'teamEmails' => 'TEAM_EMAILS',
        'dataExceptions.teamEmails' => 'TEAM_EMAILS',
        'DataExceptionsTableMap::COL_TEAM_EMAILS' => 'TEAM_EMAILS',
        'COL_TEAM_EMAILS' => 'TEAM_EMAILS',
        'team_emails' => 'TEAM_EMAILS',
        'data_exceptions.team_emails' => 'TEAM_EMAILS',
        'LoggerName' => 'LOGGER_NAME',
        'DataExceptions.LoggerName' => 'LOGGER_NAME',
        'loggerName' => 'LOGGER_NAME',
        'dataExceptions.loggerName' => 'LOGGER_NAME',
        'DataExceptionsTableMap::COL_LOGGER_NAME' => 'LOGGER_NAME',
        'COL_LOGGER_NAME' => 'LOGGER_NAME',
        'logger_name' => 'LOGGER_NAME',
        'data_exceptions.logger_name' => 'LOGGER_NAME',
        'ScheduleTime' => 'SCHEDULE_TIME',
        'DataExceptions.ScheduleTime' => 'SCHEDULE_TIME',
        'scheduleTime' => 'SCHEDULE_TIME',
        'dataExceptions.scheduleTime' => 'SCHEDULE_TIME',
        'DataExceptionsTableMap::COL_SCHEDULE_TIME' => 'SCHEDULE_TIME',
        'COL_SCHEDULE_TIME' => 'SCHEDULE_TIME',
        'schedule_time' => 'SCHEDULE_TIME',
        'data_exceptions.schedule_time' => 'SCHEDULE_TIME',
        'CreatedAt' => 'CREATED_AT',
        'DataExceptions.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dataExceptions.createdAt' => 'CREATED_AT',
        'DataExceptionsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'data_exceptions.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DataExceptions.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dataExceptions.updatedAt' => 'UPDATED_AT',
        'DataExceptionsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'data_exceptions.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'DataExceptions.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'dataExceptions.companyId' => 'COMPANY_ID',
        'DataExceptionsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'data_exceptions.company_id' => 'COMPANY_ID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('data_exceptions');
        $this->setPhpName('DataExceptions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DataExceptions');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('data_exceptions_data_exception_id_seq');
        // columns
        $this->addPrimaryKey('data_exception_id', 'DataExceptionId', 'INTEGER', true, null, null);
        $this->addColumn('exception_name', 'ExceptionName', 'VARCHAR', false, null, null);
        $this->addColumn('class_path', 'ClassPath', 'VARCHAR', false, null, null);
        $this->addColumn('subject', 'Subject', 'LONGVARCHAR', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('client_emails', 'ClientEmails', 'LONGVARCHAR', false, null, null);
        $this->addColumn('team_emails', 'TeamEmails', 'LONGVARCHAR', false, null, null);
        $this->addColumn('logger_name', 'LoggerName', 'VARCHAR', false, null, null);
        $this->addColumn('schedule_time', 'ScheduleTime', 'TIME', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('DataExceptionLogs', '\\entities\\DataExceptionLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':data_exception_id',
    1 => ':data_exception_id',
  ),
), null, null, 'DataExceptionLogss', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('DataExceptionId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? DataExceptionsTableMap::CLASS_DEFAULT : DataExceptionsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (DataExceptions object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DataExceptionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DataExceptionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DataExceptionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DataExceptionsTableMap::OM_CLASS;
            /** @var DataExceptions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DataExceptionsTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DataExceptionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DataExceptionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DataExceptions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DataExceptionsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_EXCEPTION_NAME);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_CLASS_PATH);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_SUBJECT);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_CLIENT_EMAILS);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_TEAM_EMAILS);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_LOGGER_NAME);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_SCHEDULE_TIME);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DataExceptionsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.data_exception_id');
            $criteria->addSelectColumn($alias . '.exception_name');
            $criteria->addSelectColumn($alias . '.class_path');
            $criteria->addSelectColumn($alias . '.subject');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.client_emails');
            $criteria->addSelectColumn($alias . '.team_emails');
            $criteria->addSelectColumn($alias . '.logger_name');
            $criteria->addSelectColumn($alias . '.schedule_time');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_EXCEPTION_NAME);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_CLASS_PATH);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_SUBJECT);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_CLIENT_EMAILS);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_TEAM_EMAILS);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_LOGGER_NAME);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_SCHEDULE_TIME);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DataExceptionsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.data_exception_id');
            $criteria->removeSelectColumn($alias . '.exception_name');
            $criteria->removeSelectColumn($alias . '.class_path');
            $criteria->removeSelectColumn($alias . '.subject');
            $criteria->removeSelectColumn($alias . '.active');
            $criteria->removeSelectColumn($alias . '.client_emails');
            $criteria->removeSelectColumn($alias . '.team_emails');
            $criteria->removeSelectColumn($alias . '.logger_name');
            $criteria->removeSelectColumn($alias . '.schedule_time');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(DataExceptionsTableMap::DATABASE_NAME)->getTable(DataExceptionsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DataExceptions or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DataExceptions object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DataExceptions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DataExceptionsTableMap::DATABASE_NAME);
            $criteria->add(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID, (array) $values, Criteria::IN);
        }

        $query = DataExceptionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DataExceptionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DataExceptionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the data_exceptions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DataExceptionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DataExceptions or Criteria object.
     *
     * @param mixed $criteria Criteria or DataExceptions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DataExceptions object
        }

        if ($criteria->containsKey(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID) && $criteria->keyContainsValue(DataExceptionsTableMap::COL_DATA_EXCEPTION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DataExceptionsTableMap::COL_DATA_EXCEPTION_ID.')');
        }


        // Set the correct dbName
        $query = DataExceptionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

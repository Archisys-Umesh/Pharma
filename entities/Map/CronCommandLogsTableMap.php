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
use entities\CronCommandLogs;
use entities\CronCommandLogsQuery;


/**
 * This class defines the structure of the 'cron_command_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CronCommandLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CronCommandLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'cron_command_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CronCommandLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CronCommandLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CronCommandLogs';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'cron_command_logs.id';

    /**
     * the column name for the cron_command_id field
     */
    public const COL_CRON_COMMAND_ID = 'cron_command_logs.cron_command_id';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'cron_command_logs.date';

    /**
     * the column name for the command_key field
     */
    public const COL_COMMAND_KEY = 'cron_command_logs.command_key';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'cron_command_logs.start_time';

    /**
     * the column name for the end_time field
     */
    public const COL_END_TIME = 'cron_command_logs.end_time';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'cron_command_logs.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'cron_command_logs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'cron_command_logs.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'CronCommandId', 'Date', 'CommandKey', 'StartTime', 'EndTime', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'cronCommandId', 'date', 'commandKey', 'startTime', 'endTime', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [CronCommandLogsTableMap::COL_ID, CronCommandLogsTableMap::COL_CRON_COMMAND_ID, CronCommandLogsTableMap::COL_DATE, CronCommandLogsTableMap::COL_COMMAND_KEY, CronCommandLogsTableMap::COL_START_TIME, CronCommandLogsTableMap::COL_END_TIME, CronCommandLogsTableMap::COL_COMPANY_ID, CronCommandLogsTableMap::COL_CREATED_AT, CronCommandLogsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'cron_command_id', 'date', 'command_key', 'start_time', 'end_time', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CronCommandId' => 1, 'Date' => 2, 'CommandKey' => 3, 'StartTime' => 4, 'EndTime' => 5, 'CompanyId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'cronCommandId' => 1, 'date' => 2, 'commandKey' => 3, 'startTime' => 4, 'endTime' => 5, 'companyId' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [CronCommandLogsTableMap::COL_ID => 0, CronCommandLogsTableMap::COL_CRON_COMMAND_ID => 1, CronCommandLogsTableMap::COL_DATE => 2, CronCommandLogsTableMap::COL_COMMAND_KEY => 3, CronCommandLogsTableMap::COL_START_TIME => 4, CronCommandLogsTableMap::COL_END_TIME => 5, CronCommandLogsTableMap::COL_COMPANY_ID => 6, CronCommandLogsTableMap::COL_CREATED_AT => 7, CronCommandLogsTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'cron_command_id' => 1, 'date' => 2, 'command_key' => 3, 'start_time' => 4, 'end_time' => 5, 'company_id' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CronCommandLogs.Id' => 'ID',
        'id' => 'ID',
        'cronCommandLogs.id' => 'ID',
        'CronCommandLogsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'cron_command_logs.id' => 'ID',
        'CronCommandId' => 'CRON_COMMAND_ID',
        'CronCommandLogs.CronCommandId' => 'CRON_COMMAND_ID',
        'cronCommandId' => 'CRON_COMMAND_ID',
        'cronCommandLogs.cronCommandId' => 'CRON_COMMAND_ID',
        'CronCommandLogsTableMap::COL_CRON_COMMAND_ID' => 'CRON_COMMAND_ID',
        'COL_CRON_COMMAND_ID' => 'CRON_COMMAND_ID',
        'cron_command_id' => 'CRON_COMMAND_ID',
        'cron_command_logs.cron_command_id' => 'CRON_COMMAND_ID',
        'Date' => 'DATE',
        'CronCommandLogs.Date' => 'DATE',
        'date' => 'DATE',
        'cronCommandLogs.date' => 'DATE',
        'CronCommandLogsTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'cron_command_logs.date' => 'DATE',
        'CommandKey' => 'COMMAND_KEY',
        'CronCommandLogs.CommandKey' => 'COMMAND_KEY',
        'commandKey' => 'COMMAND_KEY',
        'cronCommandLogs.commandKey' => 'COMMAND_KEY',
        'CronCommandLogsTableMap::COL_COMMAND_KEY' => 'COMMAND_KEY',
        'COL_COMMAND_KEY' => 'COMMAND_KEY',
        'command_key' => 'COMMAND_KEY',
        'cron_command_logs.command_key' => 'COMMAND_KEY',
        'StartTime' => 'START_TIME',
        'CronCommandLogs.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'cronCommandLogs.startTime' => 'START_TIME',
        'CronCommandLogsTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'cron_command_logs.start_time' => 'START_TIME',
        'EndTime' => 'END_TIME',
        'CronCommandLogs.EndTime' => 'END_TIME',
        'endTime' => 'END_TIME',
        'cronCommandLogs.endTime' => 'END_TIME',
        'CronCommandLogsTableMap::COL_END_TIME' => 'END_TIME',
        'COL_END_TIME' => 'END_TIME',
        'end_time' => 'END_TIME',
        'cron_command_logs.end_time' => 'END_TIME',
        'CompanyId' => 'COMPANY_ID',
        'CronCommandLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'cronCommandLogs.companyId' => 'COMPANY_ID',
        'CronCommandLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'cron_command_logs.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'CronCommandLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'cronCommandLogs.createdAt' => 'CREATED_AT',
        'CronCommandLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'cron_command_logs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'CronCommandLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'cronCommandLogs.updatedAt' => 'UPDATED_AT',
        'CronCommandLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'cron_command_logs.updated_at' => 'UPDATED_AT',
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
        $this->setName('cron_command_logs');
        $this->setPhpName('CronCommandLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CronCommandLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('cron_command_logs_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('cron_command_id', 'CronCommandId', 'INTEGER', 'cron_commands', 'id', false, null, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('command_key', 'CommandKey', 'VARCHAR', false, null, null);
        $this->addColumn('start_time', 'StartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('end_time', 'EndTime', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('CronCommands', '\\entities\\CronCommands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cron_command_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CronCommandLogsTableMap::CLASS_DEFAULT : CronCommandLogsTableMap::OM_CLASS;
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
     * @return array (CronCommandLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CronCommandLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CronCommandLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CronCommandLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CronCommandLogsTableMap::OM_CLASS;
            /** @var CronCommandLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CronCommandLogsTableMap::addInstanceToPool($obj, $key);
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
            $key = CronCommandLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CronCommandLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CronCommandLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CronCommandLogsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_ID);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_CRON_COMMAND_ID);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_DATE);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_COMMAND_KEY);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_START_TIME);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_END_TIME);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CronCommandLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.cron_command_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.command_key');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.end_time');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_ID);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_CRON_COMMAND_ID);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_DATE);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_COMMAND_KEY);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_END_TIME);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(CronCommandLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.cron_command_id');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.command_key');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.end_time');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(CronCommandLogsTableMap::DATABASE_NAME)->getTable(CronCommandLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CronCommandLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CronCommandLogs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CronCommandLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CronCommandLogsTableMap::DATABASE_NAME);
            $criteria->add(CronCommandLogsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CronCommandLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CronCommandLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CronCommandLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cron_command_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CronCommandLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CronCommandLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or CronCommandLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CronCommandLogs object
        }

        if ($criteria->containsKey(CronCommandLogsTableMap::COL_ID) && $criteria->keyContainsValue(CronCommandLogsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CronCommandLogsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CronCommandLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

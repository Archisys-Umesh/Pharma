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
use entities\CronCommands;
use entities\CronCommandsQuery;


/**
 * This class defines the structure of the 'cron_commands' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CronCommandsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CronCommandsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'cron_commands';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CronCommands';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CronCommands';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CronCommands';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'cron_commands.id';

    /**
     * the column name for the command_key field
     */
    public const COL_COMMAND_KEY = 'cron_commands.command_key';

    /**
     * the column name for the schedule_time field
     */
    public const COL_SCHEDULE_TIME = 'cron_commands.schedule_time';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'cron_commands.is_active';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'cron_commands.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'cron_commands.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'cron_commands.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'CommandKey', 'ScheduleTime', 'IsActive', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'commandKey', 'scheduleTime', 'isActive', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [CronCommandsTableMap::COL_ID, CronCommandsTableMap::COL_COMMAND_KEY, CronCommandsTableMap::COL_SCHEDULE_TIME, CronCommandsTableMap::COL_IS_ACTIVE, CronCommandsTableMap::COL_COMPANY_ID, CronCommandsTableMap::COL_CREATED_AT, CronCommandsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'command_key', 'schedule_time', 'is_active', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CommandKey' => 1, 'ScheduleTime' => 2, 'IsActive' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'commandKey' => 1, 'scheduleTime' => 2, 'isActive' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [CronCommandsTableMap::COL_ID => 0, CronCommandsTableMap::COL_COMMAND_KEY => 1, CronCommandsTableMap::COL_SCHEDULE_TIME => 2, CronCommandsTableMap::COL_IS_ACTIVE => 3, CronCommandsTableMap::COL_COMPANY_ID => 4, CronCommandsTableMap::COL_CREATED_AT => 5, CronCommandsTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'command_key' => 1, 'schedule_time' => 2, 'is_active' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CronCommands.Id' => 'ID',
        'id' => 'ID',
        'cronCommands.id' => 'ID',
        'CronCommandsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'cron_commands.id' => 'ID',
        'CommandKey' => 'COMMAND_KEY',
        'CronCommands.CommandKey' => 'COMMAND_KEY',
        'commandKey' => 'COMMAND_KEY',
        'cronCommands.commandKey' => 'COMMAND_KEY',
        'CronCommandsTableMap::COL_COMMAND_KEY' => 'COMMAND_KEY',
        'COL_COMMAND_KEY' => 'COMMAND_KEY',
        'command_key' => 'COMMAND_KEY',
        'cron_commands.command_key' => 'COMMAND_KEY',
        'ScheduleTime' => 'SCHEDULE_TIME',
        'CronCommands.ScheduleTime' => 'SCHEDULE_TIME',
        'scheduleTime' => 'SCHEDULE_TIME',
        'cronCommands.scheduleTime' => 'SCHEDULE_TIME',
        'CronCommandsTableMap::COL_SCHEDULE_TIME' => 'SCHEDULE_TIME',
        'COL_SCHEDULE_TIME' => 'SCHEDULE_TIME',
        'schedule_time' => 'SCHEDULE_TIME',
        'cron_commands.schedule_time' => 'SCHEDULE_TIME',
        'IsActive' => 'IS_ACTIVE',
        'CronCommands.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'cronCommands.isActive' => 'IS_ACTIVE',
        'CronCommandsTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'cron_commands.is_active' => 'IS_ACTIVE',
        'CompanyId' => 'COMPANY_ID',
        'CronCommands.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'cronCommands.companyId' => 'COMPANY_ID',
        'CronCommandsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'cron_commands.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'CronCommands.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'cronCommands.createdAt' => 'CREATED_AT',
        'CronCommandsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'cron_commands.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'CronCommands.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'cronCommands.updatedAt' => 'UPDATED_AT',
        'CronCommandsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'cron_commands.updated_at' => 'UPDATED_AT',
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
        $this->setName('cron_commands');
        $this->setPhpName('CronCommands');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CronCommands');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('cron_commands_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('command_key', 'CommandKey', 'VARCHAR', false, null, null);
        $this->addColumn('schedule_time', 'ScheduleTime', 'TIME', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, null);
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
        $this->addRelation('CronCommandLogs', '\\entities\\CronCommandLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cron_command_id',
    1 => ':id',
  ),
), null, null, 'CronCommandLogss', false);
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
        return $withPrefix ? CronCommandsTableMap::CLASS_DEFAULT : CronCommandsTableMap::OM_CLASS;
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
     * @return array (CronCommands object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CronCommandsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CronCommandsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CronCommandsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CronCommandsTableMap::OM_CLASS;
            /** @var CronCommands $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CronCommandsTableMap::addInstanceToPool($obj, $key);
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
            $key = CronCommandsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CronCommandsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CronCommands $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CronCommandsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CronCommandsTableMap::COL_ID);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_COMMAND_KEY);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_SCHEDULE_TIME);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CronCommandsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.command_key');
            $criteria->addSelectColumn($alias . '.schedule_time');
            $criteria->addSelectColumn($alias . '.is_active');
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
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_ID);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_COMMAND_KEY);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_SCHEDULE_TIME);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(CronCommandsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.command_key');
            $criteria->removeSelectColumn($alias . '.schedule_time');
            $criteria->removeSelectColumn($alias . '.is_active');
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
        return Propel::getServiceContainer()->getDatabaseMap(CronCommandsTableMap::DATABASE_NAME)->getTable(CronCommandsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CronCommands or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CronCommands object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CronCommands) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CronCommandsTableMap::DATABASE_NAME);
            $criteria->add(CronCommandsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CronCommandsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CronCommandsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CronCommandsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cron_commands table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CronCommandsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CronCommands or Criteria object.
     *
     * @param mixed $criteria Criteria or CronCommands object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CronCommandsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CronCommands object
        }

        if ($criteria->containsKey(CronCommandsTableMap::COL_ID) && $criteria->keyContainsValue(CronCommandsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CronCommandsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CronCommandsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

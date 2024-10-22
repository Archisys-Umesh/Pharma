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
use entities\UserTriggers;
use entities\UserTriggersQuery;


/**
 * This class defines the structure of the 'user_triggers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserTriggersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.UserTriggersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'user_triggers';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'UserTriggers';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\UserTriggers';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.UserTriggers';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the trigger_id field
     */
    public const COL_TRIGGER_ID = 'user_triggers.trigger_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'user_triggers.user_id';

    /**
     * the column name for the user_trigger field
     */
    public const COL_USER_TRIGGER = 'user_triggers.user_trigger';

    /**
     * the column name for the timestamp field
     */
    public const COL_TIMESTAMP = 'user_triggers.timestamp';

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
        self::TYPE_PHPNAME       => ['TriggerId', 'UserId', 'UserTrigger', 'Timestamp', ],
        self::TYPE_CAMELNAME     => ['triggerId', 'userId', 'userTrigger', 'timestamp', ],
        self::TYPE_COLNAME       => [UserTriggersTableMap::COL_TRIGGER_ID, UserTriggersTableMap::COL_USER_ID, UserTriggersTableMap::COL_USER_TRIGGER, UserTriggersTableMap::COL_TIMESTAMP, ],
        self::TYPE_FIELDNAME     => ['trigger_id', 'user_id', 'user_trigger', 'timestamp', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['TriggerId' => 0, 'UserId' => 1, 'UserTrigger' => 2, 'Timestamp' => 3, ],
        self::TYPE_CAMELNAME     => ['triggerId' => 0, 'userId' => 1, 'userTrigger' => 2, 'timestamp' => 3, ],
        self::TYPE_COLNAME       => [UserTriggersTableMap::COL_TRIGGER_ID => 0, UserTriggersTableMap::COL_USER_ID => 1, UserTriggersTableMap::COL_USER_TRIGGER => 2, UserTriggersTableMap::COL_TIMESTAMP => 3, ],
        self::TYPE_FIELDNAME     => ['trigger_id' => 0, 'user_id' => 1, 'user_trigger' => 2, 'timestamp' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TriggerId' => 'TRIGGER_ID',
        'UserTriggers.TriggerId' => 'TRIGGER_ID',
        'triggerId' => 'TRIGGER_ID',
        'userTriggers.triggerId' => 'TRIGGER_ID',
        'UserTriggersTableMap::COL_TRIGGER_ID' => 'TRIGGER_ID',
        'COL_TRIGGER_ID' => 'TRIGGER_ID',
        'trigger_id' => 'TRIGGER_ID',
        'user_triggers.trigger_id' => 'TRIGGER_ID',
        'UserId' => 'USER_ID',
        'UserTriggers.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'userTriggers.userId' => 'USER_ID',
        'UserTriggersTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'user_triggers.user_id' => 'USER_ID',
        'UserTrigger' => 'USER_TRIGGER',
        'UserTriggers.UserTrigger' => 'USER_TRIGGER',
        'userTrigger' => 'USER_TRIGGER',
        'userTriggers.userTrigger' => 'USER_TRIGGER',
        'UserTriggersTableMap::COL_USER_TRIGGER' => 'USER_TRIGGER',
        'COL_USER_TRIGGER' => 'USER_TRIGGER',
        'user_trigger' => 'USER_TRIGGER',
        'user_triggers.user_trigger' => 'USER_TRIGGER',
        'Timestamp' => 'TIMESTAMP',
        'UserTriggers.Timestamp' => 'TIMESTAMP',
        'timestamp' => 'TIMESTAMP',
        'userTriggers.timestamp' => 'TIMESTAMP',
        'UserTriggersTableMap::COL_TIMESTAMP' => 'TIMESTAMP',
        'COL_TIMESTAMP' => 'TIMESTAMP',
        'user_triggers.timestamp' => 'TIMESTAMP',
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
        $this->setName('user_triggers');
        $this->setPhpName('UserTriggers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\UserTriggers');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('user_triggers_trigger_id_seq');
        // columns
        $this->addPrimaryKey('trigger_id', 'TriggerId', 'BIGINT', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', true, null, 0);
        $this->addColumn('user_trigger', 'UserTrigger', 'VARCHAR', true, 50, '0');
        $this->addColumn('timestamp', 'Timestamp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('TriggerId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UserTriggersTableMap::CLASS_DEFAULT : UserTriggersTableMap::OM_CLASS;
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
     * @return array (UserTriggers object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserTriggersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTriggersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTriggersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTriggersTableMap::OM_CLASS;
            /** @var UserTriggers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTriggersTableMap::addInstanceToPool($obj, $key);
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
            $key = UserTriggersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTriggersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserTriggers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTriggersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserTriggersTableMap::COL_TRIGGER_ID);
            $criteria->addSelectColumn(UserTriggersTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserTriggersTableMap::COL_USER_TRIGGER);
            $criteria->addSelectColumn(UserTriggersTableMap::COL_TIMESTAMP);
        } else {
            $criteria->addSelectColumn($alias . '.trigger_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.user_trigger');
            $criteria->addSelectColumn($alias . '.timestamp');
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
            $criteria->removeSelectColumn(UserTriggersTableMap::COL_TRIGGER_ID);
            $criteria->removeSelectColumn(UserTriggersTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(UserTriggersTableMap::COL_USER_TRIGGER);
            $criteria->removeSelectColumn(UserTriggersTableMap::COL_TIMESTAMP);
        } else {
            $criteria->removeSelectColumn($alias . '.trigger_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.user_trigger');
            $criteria->removeSelectColumn($alias . '.timestamp');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserTriggersTableMap::DATABASE_NAME)->getTable(UserTriggersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserTriggers or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UserTriggers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTriggersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\UserTriggers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTriggersTableMap::DATABASE_NAME);
            $criteria->add(UserTriggersTableMap::COL_TRIGGER_ID, (array) $values, Criteria::IN);
        }

        $query = UserTriggersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTriggersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTriggersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_triggers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserTriggersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserTriggers or Criteria object.
     *
     * @param mixed $criteria Criteria or UserTriggers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTriggersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserTriggers object
        }

        if ($criteria->containsKey(UserTriggersTableMap::COL_TRIGGER_ID) && $criteria->keyContainsValue(UserTriggersTableMap::COL_TRIGGER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTriggersTableMap::COL_TRIGGER_ID.')');
        }


        // Set the correct dbName
        $query = UserTriggersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

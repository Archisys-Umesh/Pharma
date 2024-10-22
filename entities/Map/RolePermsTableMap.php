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
use entities\RolePerms;
use entities\RolePermsQuery;


/**
 * This class defines the structure of the 'role_perms' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RolePermsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RolePermsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'role_perms';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'RolePerms';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\RolePerms';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.RolePerms';

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
     * the column name for the perm_id field
     */
    public const COL_PERM_ID = 'role_perms.perm_id';

    /**
     * the column name for the perm_key field
     */
    public const COL_PERM_KEY = 'role_perms.perm_key';

    /**
     * the column name for the perm_desc field
     */
    public const COL_PERM_DESC = 'role_perms.perm_desc';

    /**
     * the column name for the perm_group field
     */
    public const COL_PERM_GROUP = 'role_perms.perm_group';

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
        self::TYPE_PHPNAME       => ['PermId', 'PermKey', 'PermDesc', 'PermGroup', ],
        self::TYPE_CAMELNAME     => ['permId', 'permKey', 'permDesc', 'permGroup', ],
        self::TYPE_COLNAME       => [RolePermsTableMap::COL_PERM_ID, RolePermsTableMap::COL_PERM_KEY, RolePermsTableMap::COL_PERM_DESC, RolePermsTableMap::COL_PERM_GROUP, ],
        self::TYPE_FIELDNAME     => ['perm_id', 'perm_key', 'perm_desc', 'perm_group', ],
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
        self::TYPE_PHPNAME       => ['PermId' => 0, 'PermKey' => 1, 'PermDesc' => 2, 'PermGroup' => 3, ],
        self::TYPE_CAMELNAME     => ['permId' => 0, 'permKey' => 1, 'permDesc' => 2, 'permGroup' => 3, ],
        self::TYPE_COLNAME       => [RolePermsTableMap::COL_PERM_ID => 0, RolePermsTableMap::COL_PERM_KEY => 1, RolePermsTableMap::COL_PERM_DESC => 2, RolePermsTableMap::COL_PERM_GROUP => 3, ],
        self::TYPE_FIELDNAME     => ['perm_id' => 0, 'perm_key' => 1, 'perm_desc' => 2, 'perm_group' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PermId' => 'PERM_ID',
        'RolePerms.PermId' => 'PERM_ID',
        'permId' => 'PERM_ID',
        'rolePerms.permId' => 'PERM_ID',
        'RolePermsTableMap::COL_PERM_ID' => 'PERM_ID',
        'COL_PERM_ID' => 'PERM_ID',
        'perm_id' => 'PERM_ID',
        'role_perms.perm_id' => 'PERM_ID',
        'PermKey' => 'PERM_KEY',
        'RolePerms.PermKey' => 'PERM_KEY',
        'permKey' => 'PERM_KEY',
        'rolePerms.permKey' => 'PERM_KEY',
        'RolePermsTableMap::COL_PERM_KEY' => 'PERM_KEY',
        'COL_PERM_KEY' => 'PERM_KEY',
        'perm_key' => 'PERM_KEY',
        'role_perms.perm_key' => 'PERM_KEY',
        'PermDesc' => 'PERM_DESC',
        'RolePerms.PermDesc' => 'PERM_DESC',
        'permDesc' => 'PERM_DESC',
        'rolePerms.permDesc' => 'PERM_DESC',
        'RolePermsTableMap::COL_PERM_DESC' => 'PERM_DESC',
        'COL_PERM_DESC' => 'PERM_DESC',
        'perm_desc' => 'PERM_DESC',
        'role_perms.perm_desc' => 'PERM_DESC',
        'PermGroup' => 'PERM_GROUP',
        'RolePerms.PermGroup' => 'PERM_GROUP',
        'permGroup' => 'PERM_GROUP',
        'rolePerms.permGroup' => 'PERM_GROUP',
        'RolePermsTableMap::COL_PERM_GROUP' => 'PERM_GROUP',
        'COL_PERM_GROUP' => 'PERM_GROUP',
        'perm_group' => 'PERM_GROUP',
        'role_perms.perm_group' => 'PERM_GROUP',
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
        $this->setName('role_perms');
        $this->setPhpName('RolePerms');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\RolePerms');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('role_perms_perm_id_seq');
        // columns
        $this->addPrimaryKey('perm_id', 'PermId', 'INTEGER', true, null, null);
        $this->addColumn('perm_key', 'PermKey', 'VARCHAR', true, null, '0');
        $this->addColumn('perm_desc', 'PermDesc', 'VARCHAR', true, null, '0');
        $this->addColumn('perm_group', 'PermGroup', 'VARCHAR', true, null, '0');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PermId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RolePermsTableMap::CLASS_DEFAULT : RolePermsTableMap::OM_CLASS;
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
     * @return array (RolePerms object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RolePermsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RolePermsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RolePermsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RolePermsTableMap::OM_CLASS;
            /** @var RolePerms $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RolePermsTableMap::addInstanceToPool($obj, $key);
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
            $key = RolePermsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RolePermsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RolePerms $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RolePermsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RolePermsTableMap::COL_PERM_ID);
            $criteria->addSelectColumn(RolePermsTableMap::COL_PERM_KEY);
            $criteria->addSelectColumn(RolePermsTableMap::COL_PERM_DESC);
            $criteria->addSelectColumn(RolePermsTableMap::COL_PERM_GROUP);
        } else {
            $criteria->addSelectColumn($alias . '.perm_id');
            $criteria->addSelectColumn($alias . '.perm_key');
            $criteria->addSelectColumn($alias . '.perm_desc');
            $criteria->addSelectColumn($alias . '.perm_group');
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
            $criteria->removeSelectColumn(RolePermsTableMap::COL_PERM_ID);
            $criteria->removeSelectColumn(RolePermsTableMap::COL_PERM_KEY);
            $criteria->removeSelectColumn(RolePermsTableMap::COL_PERM_DESC);
            $criteria->removeSelectColumn(RolePermsTableMap::COL_PERM_GROUP);
        } else {
            $criteria->removeSelectColumn($alias . '.perm_id');
            $criteria->removeSelectColumn($alias . '.perm_key');
            $criteria->removeSelectColumn($alias . '.perm_desc');
            $criteria->removeSelectColumn($alias . '.perm_group');
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
        return Propel::getServiceContainer()->getDatabaseMap(RolePermsTableMap::DATABASE_NAME)->getTable(RolePermsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a RolePerms or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or RolePerms object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RolePermsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\RolePerms) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RolePermsTableMap::DATABASE_NAME);
            $criteria->add(RolePermsTableMap::COL_PERM_ID, (array) $values, Criteria::IN);
        }

        $query = RolePermsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RolePermsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RolePermsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the role_perms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RolePermsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RolePerms or Criteria object.
     *
     * @param mixed $criteria Criteria or RolePerms object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RolePermsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RolePerms object
        }

        if ($criteria->containsKey(RolePermsTableMap::COL_PERM_ID) && $criteria->keyContainsValue(RolePermsTableMap::COL_PERM_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RolePermsTableMap::COL_PERM_ID.')');
        }


        // Set the correct dbName
        $query = RolePermsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

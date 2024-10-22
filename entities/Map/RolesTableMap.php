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
use entities\Roles;
use entities\RolesQuery;


/**
 * This class defines the structure of the 'roles' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RolesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RolesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'roles';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Roles';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Roles';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Roles';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'roles.role_id';

    /**
     * the column name for the role_name field
     */
    public const COL_ROLE_NAME = 'roles.role_name';

    /**
     * the column name for the role_private field
     */
    public const COL_ROLE_PRIVATE = 'roles.role_private';

    /**
     * the column name for the role_desc field
     */
    public const COL_ROLE_DESC = 'roles.role_desc';

    /**
     * the column name for the role_permissions field
     */
    public const COL_ROLE_PERMISSIONS = 'roles.role_permissions';

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
        self::TYPE_PHPNAME       => ['RoleId', 'RoleName', 'RolePrivate', 'RoleDesc', 'RolePermissions', ],
        self::TYPE_CAMELNAME     => ['roleId', 'roleName', 'rolePrivate', 'roleDesc', 'rolePermissions', ],
        self::TYPE_COLNAME       => [RolesTableMap::COL_ROLE_ID, RolesTableMap::COL_ROLE_NAME, RolesTableMap::COL_ROLE_PRIVATE, RolesTableMap::COL_ROLE_DESC, RolesTableMap::COL_ROLE_PERMISSIONS, ],
        self::TYPE_FIELDNAME     => ['role_id', 'role_name', 'role_private', 'role_desc', 'role_permissions', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['RoleId' => 0, 'RoleName' => 1, 'RolePrivate' => 2, 'RoleDesc' => 3, 'RolePermissions' => 4, ],
        self::TYPE_CAMELNAME     => ['roleId' => 0, 'roleName' => 1, 'rolePrivate' => 2, 'roleDesc' => 3, 'rolePermissions' => 4, ],
        self::TYPE_COLNAME       => [RolesTableMap::COL_ROLE_ID => 0, RolesTableMap::COL_ROLE_NAME => 1, RolesTableMap::COL_ROLE_PRIVATE => 2, RolesTableMap::COL_ROLE_DESC => 3, RolesTableMap::COL_ROLE_PERMISSIONS => 4, ],
        self::TYPE_FIELDNAME     => ['role_id' => 0, 'role_name' => 1, 'role_private' => 2, 'role_desc' => 3, 'role_permissions' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RoleId' => 'ROLE_ID',
        'Roles.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'roles.roleId' => 'ROLE_ID',
        'RolesTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'roles.role_id' => 'ROLE_ID',
        'RoleName' => 'ROLE_NAME',
        'Roles.RoleName' => 'ROLE_NAME',
        'roleName' => 'ROLE_NAME',
        'roles.roleName' => 'ROLE_NAME',
        'RolesTableMap::COL_ROLE_NAME' => 'ROLE_NAME',
        'COL_ROLE_NAME' => 'ROLE_NAME',
        'role_name' => 'ROLE_NAME',
        'roles.role_name' => 'ROLE_NAME',
        'RolePrivate' => 'ROLE_PRIVATE',
        'Roles.RolePrivate' => 'ROLE_PRIVATE',
        'rolePrivate' => 'ROLE_PRIVATE',
        'roles.rolePrivate' => 'ROLE_PRIVATE',
        'RolesTableMap::COL_ROLE_PRIVATE' => 'ROLE_PRIVATE',
        'COL_ROLE_PRIVATE' => 'ROLE_PRIVATE',
        'role_private' => 'ROLE_PRIVATE',
        'roles.role_private' => 'ROLE_PRIVATE',
        'RoleDesc' => 'ROLE_DESC',
        'Roles.RoleDesc' => 'ROLE_DESC',
        'roleDesc' => 'ROLE_DESC',
        'roles.roleDesc' => 'ROLE_DESC',
        'RolesTableMap::COL_ROLE_DESC' => 'ROLE_DESC',
        'COL_ROLE_DESC' => 'ROLE_DESC',
        'role_desc' => 'ROLE_DESC',
        'roles.role_desc' => 'ROLE_DESC',
        'RolePermissions' => 'ROLE_PERMISSIONS',
        'Roles.RolePermissions' => 'ROLE_PERMISSIONS',
        'rolePermissions' => 'ROLE_PERMISSIONS',
        'roles.rolePermissions' => 'ROLE_PERMISSIONS',
        'RolesTableMap::COL_ROLE_PERMISSIONS' => 'ROLE_PERMISSIONS',
        'COL_ROLE_PERMISSIONS' => 'ROLE_PERMISSIONS',
        'role_permissions' => 'ROLE_PERMISSIONS',
        'roles.role_permissions' => 'ROLE_PERMISSIONS',
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
        $this->setName('roles');
        $this->setPhpName('Roles');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Roles');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('roles_role_id_seq');
        // columns
        $this->addPrimaryKey('role_id', 'RoleId', 'INTEGER', true, null, null);
        $this->addColumn('role_name', 'RoleName', 'VARCHAR', false, null, null);
        $this->addColumn('role_private', 'RolePrivate', 'BOOLEAN', true, 1, false);
        $this->addColumn('role_desc', 'RoleDesc', 'VARCHAR', false, null, null);
        $this->addColumn('role_permissions', 'RolePermissions', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\entities\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':role_id',
  ),
), null, null, 'Userss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RolesTableMap::CLASS_DEFAULT : RolesTableMap::OM_CLASS;
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
     * @return array (Roles object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RolesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RolesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RolesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RolesTableMap::OM_CLASS;
            /** @var Roles $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RolesTableMap::addInstanceToPool($obj, $key);
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
            $key = RolesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RolesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Roles $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RolesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RolesTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(RolesTableMap::COL_ROLE_NAME);
            $criteria->addSelectColumn(RolesTableMap::COL_ROLE_PRIVATE);
            $criteria->addSelectColumn(RolesTableMap::COL_ROLE_DESC);
            $criteria->addSelectColumn(RolesTableMap::COL_ROLE_PERMISSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.role_name');
            $criteria->addSelectColumn($alias . '.role_private');
            $criteria->addSelectColumn($alias . '.role_desc');
            $criteria->addSelectColumn($alias . '.role_permissions');
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
            $criteria->removeSelectColumn(RolesTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(RolesTableMap::COL_ROLE_NAME);
            $criteria->removeSelectColumn(RolesTableMap::COL_ROLE_PRIVATE);
            $criteria->removeSelectColumn(RolesTableMap::COL_ROLE_DESC);
            $criteria->removeSelectColumn(RolesTableMap::COL_ROLE_PERMISSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.role_id');
            $criteria->removeSelectColumn($alias . '.role_name');
            $criteria->removeSelectColumn($alias . '.role_private');
            $criteria->removeSelectColumn($alias . '.role_desc');
            $criteria->removeSelectColumn($alias . '.role_permissions');
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
        return Propel::getServiceContainer()->getDatabaseMap(RolesTableMap::DATABASE_NAME)->getTable(RolesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Roles or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Roles object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Roles) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RolesTableMap::DATABASE_NAME);
            $criteria->add(RolesTableMap::COL_ROLE_ID, (array) $values, Criteria::IN);
        }

        $query = RolesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RolesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RolesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the roles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RolesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Roles or Criteria object.
     *
     * @param mixed $criteria Criteria or Roles object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RolesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Roles object
        }

        if ($criteria->containsKey(RolesTableMap::COL_ROLE_ID) && $criteria->keyContainsValue(RolesTableMap::COL_ROLE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RolesTableMap::COL_ROLE_ID.')');
        }


        // Set the correct dbName
        $query = RolesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\AuditTableData;
use entities\AuditTableDataQuery;


/**
 * This class defines the structure of the 'audit_table_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AuditTableDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.AuditTableDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'audit_table_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'AuditTableData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\AuditTableData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.AuditTableData';

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
    public const COL_ID = 'audit_table_data.id';

    /**
     * the column name for the audit_table_name field
     */
    public const COL_AUDIT_TABLE_NAME = 'audit_table_data.audit_table_name';

    /**
     * the column name for the pk_value field
     */
    public const COL_PK_VALUE = 'audit_table_data.pk_value';

    /**
     * the column name for the audit_column_name field
     */
    public const COL_AUDIT_COLUMN_NAME = 'audit_table_data.audit_column_name';

    /**
     * the column name for the old_value field
     */
    public const COL_OLD_VALUE = 'audit_table_data.old_value';

    /**
     * the column name for the new_value field
     */
    public const COL_NEW_VALUE = 'audit_table_data.new_value';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'audit_table_data.user_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'audit_table_data.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'audit_table_data.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'AuditTableName', 'PkValue', 'AuditColumnName', 'OldValue', 'NewValue', 'UserId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'auditTableName', 'pkValue', 'auditColumnName', 'oldValue', 'newValue', 'userId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [AuditTableDataTableMap::COL_ID, AuditTableDataTableMap::COL_AUDIT_TABLE_NAME, AuditTableDataTableMap::COL_PK_VALUE, AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME, AuditTableDataTableMap::COL_OLD_VALUE, AuditTableDataTableMap::COL_NEW_VALUE, AuditTableDataTableMap::COL_USER_ID, AuditTableDataTableMap::COL_CREATED_AT, AuditTableDataTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'audit_table_name', 'pk_value', 'audit_column_name', 'old_value', 'new_value', 'user_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'AuditTableName' => 1, 'PkValue' => 2, 'AuditColumnName' => 3, 'OldValue' => 4, 'NewValue' => 5, 'UserId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'auditTableName' => 1, 'pkValue' => 2, 'auditColumnName' => 3, 'oldValue' => 4, 'newValue' => 5, 'userId' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [AuditTableDataTableMap::COL_ID => 0, AuditTableDataTableMap::COL_AUDIT_TABLE_NAME => 1, AuditTableDataTableMap::COL_PK_VALUE => 2, AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME => 3, AuditTableDataTableMap::COL_OLD_VALUE => 4, AuditTableDataTableMap::COL_NEW_VALUE => 5, AuditTableDataTableMap::COL_USER_ID => 6, AuditTableDataTableMap::COL_CREATED_AT => 7, AuditTableDataTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'audit_table_name' => 1, 'pk_value' => 2, 'audit_column_name' => 3, 'old_value' => 4, 'new_value' => 5, 'user_id' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'AuditTableData.Id' => 'ID',
        'id' => 'ID',
        'auditTableData.id' => 'ID',
        'AuditTableDataTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'audit_table_data.id' => 'ID',
        'AuditTableName' => 'AUDIT_TABLE_NAME',
        'AuditTableData.AuditTableName' => 'AUDIT_TABLE_NAME',
        'auditTableName' => 'AUDIT_TABLE_NAME',
        'auditTableData.auditTableName' => 'AUDIT_TABLE_NAME',
        'AuditTableDataTableMap::COL_AUDIT_TABLE_NAME' => 'AUDIT_TABLE_NAME',
        'COL_AUDIT_TABLE_NAME' => 'AUDIT_TABLE_NAME',
        'audit_table_name' => 'AUDIT_TABLE_NAME',
        'audit_table_data.audit_table_name' => 'AUDIT_TABLE_NAME',
        'PkValue' => 'PK_VALUE',
        'AuditTableData.PkValue' => 'PK_VALUE',
        'pkValue' => 'PK_VALUE',
        'auditTableData.pkValue' => 'PK_VALUE',
        'AuditTableDataTableMap::COL_PK_VALUE' => 'PK_VALUE',
        'COL_PK_VALUE' => 'PK_VALUE',
        'pk_value' => 'PK_VALUE',
        'audit_table_data.pk_value' => 'PK_VALUE',
        'AuditColumnName' => 'AUDIT_COLUMN_NAME',
        'AuditTableData.AuditColumnName' => 'AUDIT_COLUMN_NAME',
        'auditColumnName' => 'AUDIT_COLUMN_NAME',
        'auditTableData.auditColumnName' => 'AUDIT_COLUMN_NAME',
        'AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME' => 'AUDIT_COLUMN_NAME',
        'COL_AUDIT_COLUMN_NAME' => 'AUDIT_COLUMN_NAME',
        'audit_column_name' => 'AUDIT_COLUMN_NAME',
        'audit_table_data.audit_column_name' => 'AUDIT_COLUMN_NAME',
        'OldValue' => 'OLD_VALUE',
        'AuditTableData.OldValue' => 'OLD_VALUE',
        'oldValue' => 'OLD_VALUE',
        'auditTableData.oldValue' => 'OLD_VALUE',
        'AuditTableDataTableMap::COL_OLD_VALUE' => 'OLD_VALUE',
        'COL_OLD_VALUE' => 'OLD_VALUE',
        'old_value' => 'OLD_VALUE',
        'audit_table_data.old_value' => 'OLD_VALUE',
        'NewValue' => 'NEW_VALUE',
        'AuditTableData.NewValue' => 'NEW_VALUE',
        'newValue' => 'NEW_VALUE',
        'auditTableData.newValue' => 'NEW_VALUE',
        'AuditTableDataTableMap::COL_NEW_VALUE' => 'NEW_VALUE',
        'COL_NEW_VALUE' => 'NEW_VALUE',
        'new_value' => 'NEW_VALUE',
        'audit_table_data.new_value' => 'NEW_VALUE',
        'UserId' => 'USER_ID',
        'AuditTableData.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'auditTableData.userId' => 'USER_ID',
        'AuditTableDataTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'audit_table_data.user_id' => 'USER_ID',
        'CreatedAt' => 'CREATED_AT',
        'AuditTableData.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'auditTableData.createdAt' => 'CREATED_AT',
        'AuditTableDataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'audit_table_data.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'AuditTableData.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'auditTableData.updatedAt' => 'UPDATED_AT',
        'AuditTableDataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'audit_table_data.updated_at' => 'UPDATED_AT',
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
        $this->setName('audit_table_data');
        $this->setPhpName('AuditTableData');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\AuditTableData');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('audit_table_data_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('audit_table_name', 'AuditTableName', 'VARCHAR', false, null, null);
        $this->addColumn('pk_value', 'PkValue', 'VARCHAR', false, null, null);
        $this->addColumn('audit_column_name', 'AuditColumnName', 'VARCHAR', false, null, null);
        $this->addColumn('old_value', 'OldValue', 'LONGVARCHAR', false, null, null);
        $this->addColumn('new_value', 'NewValue', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', false, null, null);
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
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
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
        return $withPrefix ? AuditTableDataTableMap::CLASS_DEFAULT : AuditTableDataTableMap::OM_CLASS;
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
     * @return array (AuditTableData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AuditTableDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AuditTableDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AuditTableDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AuditTableDataTableMap::OM_CLASS;
            /** @var AuditTableData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AuditTableDataTableMap::addInstanceToPool($obj, $key);
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
            $key = AuditTableDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AuditTableDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AuditTableData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AuditTableDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_ID);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_AUDIT_TABLE_NAME);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_PK_VALUE);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_OLD_VALUE);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_NEW_VALUE);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_USER_ID);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AuditTableDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.audit_table_name');
            $criteria->addSelectColumn($alias . '.pk_value');
            $criteria->addSelectColumn($alias . '.audit_column_name');
            $criteria->addSelectColumn($alias . '.old_value');
            $criteria->addSelectColumn($alias . '.new_value');
            $criteria->addSelectColumn($alias . '.user_id');
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
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_ID);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_AUDIT_TABLE_NAME);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_PK_VALUE);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_AUDIT_COLUMN_NAME);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_OLD_VALUE);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_NEW_VALUE);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AuditTableDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.audit_table_name');
            $criteria->removeSelectColumn($alias . '.pk_value');
            $criteria->removeSelectColumn($alias . '.audit_column_name');
            $criteria->removeSelectColumn($alias . '.old_value');
            $criteria->removeSelectColumn($alias . '.new_value');
            $criteria->removeSelectColumn($alias . '.user_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(AuditTableDataTableMap::DATABASE_NAME)->getTable(AuditTableDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a AuditTableData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or AuditTableData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AuditTableDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\AuditTableData) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AuditTableDataTableMap::DATABASE_NAME);
            $criteria->add(AuditTableDataTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AuditTableDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AuditTableDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AuditTableDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the audit_table_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AuditTableDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AuditTableData or Criteria object.
     *
     * @param mixed $criteria Criteria or AuditTableData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuditTableDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AuditTableData object
        }

        if ($criteria->containsKey(AuditTableDataTableMap::COL_ID) && $criteria->keyContainsValue(AuditTableDataTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AuditTableDataTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AuditTableDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

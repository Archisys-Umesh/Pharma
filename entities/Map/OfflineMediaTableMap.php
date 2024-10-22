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
use entities\OfflineMedia;
use entities\OfflineMediaQuery;


/**
 * This class defines the structure of the 'offline_media' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OfflineMediaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OfflineMediaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'offline_media';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OfflineMedia';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OfflineMedia';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OfflineMedia';

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
     * the column name for the offline_media_id field
     */
    public const COL_OFFLINE_MEDIA_ID = 'offline_media.offline_media_id';

    /**
     * the column name for the file_name field
     */
    public const COL_FILE_NAME = 'offline_media.file_name';

    /**
     * the column name for the file_path field
     */
    public const COL_FILE_PATH = 'offline_media.file_path';

    /**
     * the column name for the module_name field
     */
    public const COL_MODULE_NAME = 'offline_media.module_name';

    /**
     * the column name for the module_primary_key field
     */
    public const COL_MODULE_PRIMARY_KEY = 'offline_media.module_primary_key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'offline_media.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'offline_media.updated_at';

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
        self::TYPE_PHPNAME       => ['OfflineMediaId', 'FileName', 'FilePath', 'ModuleName', 'ModulePrimaryKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['offlineMediaId', 'fileName', 'filePath', 'moduleName', 'modulePrimaryKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, OfflineMediaTableMap::COL_FILE_NAME, OfflineMediaTableMap::COL_FILE_PATH, OfflineMediaTableMap::COL_MODULE_NAME, OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY, OfflineMediaTableMap::COL_CREATED_AT, OfflineMediaTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['offline_media_id', 'file_name', 'file_path', 'module_name', 'module_primary_key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['OfflineMediaId' => 0, 'FileName' => 1, 'FilePath' => 2, 'ModuleName' => 3, 'ModulePrimaryKey' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['offlineMediaId' => 0, 'fileName' => 1, 'filePath' => 2, 'moduleName' => 3, 'modulePrimaryKey' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID => 0, OfflineMediaTableMap::COL_FILE_NAME => 1, OfflineMediaTableMap::COL_FILE_PATH => 2, OfflineMediaTableMap::COL_MODULE_NAME => 3, OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY => 4, OfflineMediaTableMap::COL_CREATED_AT => 5, OfflineMediaTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['offline_media_id' => 0, 'file_name' => 1, 'file_path' => 2, 'module_name' => 3, 'module_primary_key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OfflineMediaId' => 'OFFLINE_MEDIA_ID',
        'OfflineMedia.OfflineMediaId' => 'OFFLINE_MEDIA_ID',
        'offlineMediaId' => 'OFFLINE_MEDIA_ID',
        'offlineMedia.offlineMediaId' => 'OFFLINE_MEDIA_ID',
        'OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID' => 'OFFLINE_MEDIA_ID',
        'COL_OFFLINE_MEDIA_ID' => 'OFFLINE_MEDIA_ID',
        'offline_media_id' => 'OFFLINE_MEDIA_ID',
        'offline_media.offline_media_id' => 'OFFLINE_MEDIA_ID',
        'FileName' => 'FILE_NAME',
        'OfflineMedia.FileName' => 'FILE_NAME',
        'fileName' => 'FILE_NAME',
        'offlineMedia.fileName' => 'FILE_NAME',
        'OfflineMediaTableMap::COL_FILE_NAME' => 'FILE_NAME',
        'COL_FILE_NAME' => 'FILE_NAME',
        'file_name' => 'FILE_NAME',
        'offline_media.file_name' => 'FILE_NAME',
        'FilePath' => 'FILE_PATH',
        'OfflineMedia.FilePath' => 'FILE_PATH',
        'filePath' => 'FILE_PATH',
        'offlineMedia.filePath' => 'FILE_PATH',
        'OfflineMediaTableMap::COL_FILE_PATH' => 'FILE_PATH',
        'COL_FILE_PATH' => 'FILE_PATH',
        'file_path' => 'FILE_PATH',
        'offline_media.file_path' => 'FILE_PATH',
        'ModuleName' => 'MODULE_NAME',
        'OfflineMedia.ModuleName' => 'MODULE_NAME',
        'moduleName' => 'MODULE_NAME',
        'offlineMedia.moduleName' => 'MODULE_NAME',
        'OfflineMediaTableMap::COL_MODULE_NAME' => 'MODULE_NAME',
        'COL_MODULE_NAME' => 'MODULE_NAME',
        'module_name' => 'MODULE_NAME',
        'offline_media.module_name' => 'MODULE_NAME',
        'ModulePrimaryKey' => 'MODULE_PRIMARY_KEY',
        'OfflineMedia.ModulePrimaryKey' => 'MODULE_PRIMARY_KEY',
        'modulePrimaryKey' => 'MODULE_PRIMARY_KEY',
        'offlineMedia.modulePrimaryKey' => 'MODULE_PRIMARY_KEY',
        'OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY' => 'MODULE_PRIMARY_KEY',
        'COL_MODULE_PRIMARY_KEY' => 'MODULE_PRIMARY_KEY',
        'module_primary_key' => 'MODULE_PRIMARY_KEY',
        'offline_media.module_primary_key' => 'MODULE_PRIMARY_KEY',
        'CreatedAt' => 'CREATED_AT',
        'OfflineMedia.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'offlineMedia.createdAt' => 'CREATED_AT',
        'OfflineMediaTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'offline_media.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OfflineMedia.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'offlineMedia.updatedAt' => 'UPDATED_AT',
        'OfflineMediaTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'offline_media.updated_at' => 'UPDATED_AT',
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
        $this->setName('offline_media');
        $this->setPhpName('OfflineMedia');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OfflineMedia');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('offline_media_offline_media_id_seq');
        // columns
        $this->addPrimaryKey('offline_media_id', 'OfflineMediaId', 'INTEGER', true, null, null);
        $this->addColumn('file_name', 'FileName', 'VARCHAR', false, null, null);
        $this->addColumn('file_path', 'FilePath', 'VARCHAR', false, null, null);
        $this->addColumn('module_name', 'ModuleName', 'VARCHAR', false, null, null);
        $this->addColumn('module_primary_key', 'ModulePrimaryKey', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OfflineMediaId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OfflineMediaTableMap::CLASS_DEFAULT : OfflineMediaTableMap::OM_CLASS;
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
     * @return array (OfflineMedia object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OfflineMediaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OfflineMediaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OfflineMediaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OfflineMediaTableMap::OM_CLASS;
            /** @var OfflineMedia $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OfflineMediaTableMap::addInstanceToPool($obj, $key);
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
            $key = OfflineMediaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OfflineMediaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OfflineMedia $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OfflineMediaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_FILE_NAME);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_FILE_PATH);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_MODULE_NAME);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OfflineMediaTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.offline_media_id');
            $criteria->addSelectColumn($alias . '.file_name');
            $criteria->addSelectColumn($alias . '.file_path');
            $criteria->addSelectColumn($alias . '.module_name');
            $criteria->addSelectColumn($alias . '.module_primary_key');
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
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_FILE_NAME);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_FILE_PATH);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_MODULE_NAME);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_MODULE_PRIMARY_KEY);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OfflineMediaTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.offline_media_id');
            $criteria->removeSelectColumn($alias . '.file_name');
            $criteria->removeSelectColumn($alias . '.file_path');
            $criteria->removeSelectColumn($alias . '.module_name');
            $criteria->removeSelectColumn($alias . '.module_primary_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(OfflineMediaTableMap::DATABASE_NAME)->getTable(OfflineMediaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OfflineMedia or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OfflineMedia object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OfflineMediaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OfflineMedia) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OfflineMediaTableMap::DATABASE_NAME);
            $criteria->add(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID, (array) $values, Criteria::IN);
        }

        $query = OfflineMediaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OfflineMediaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OfflineMediaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the offline_media table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OfflineMediaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OfflineMedia or Criteria object.
     *
     * @param mixed $criteria Criteria or OfflineMedia object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfflineMediaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OfflineMedia object
        }

        if ($criteria->containsKey(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID) && $criteria->keyContainsValue(OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OfflineMediaTableMap::COL_OFFLINE_MEDIA_ID.')');
        }


        // Set the correct dbName
        $query = OfflineMediaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

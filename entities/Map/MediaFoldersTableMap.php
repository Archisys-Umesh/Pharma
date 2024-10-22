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
use entities\MediaFolders;
use entities\MediaFoldersQuery;


/**
 * This class defines the structure of the 'media_folders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MediaFoldersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MediaFoldersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'media_folders';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MediaFolders';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MediaFolders';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MediaFolders';

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
     * the column name for the folder_id field
     */
    public const COL_FOLDER_ID = 'media_folders.folder_id';

    /**
     * the column name for the folder_name field
     */
    public const COL_FOLDER_NAME = 'media_folders.folder_name';

    /**
     * the column name for the parent_id field
     */
    public const COL_PARENT_ID = 'media_folders.parent_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'media_folders.company_id';

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
        self::TYPE_PHPNAME       => ['FolderId', 'FolderName', 'ParentId', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['folderId', 'folderName', 'parentId', 'companyId', ],
        self::TYPE_COLNAME       => [MediaFoldersTableMap::COL_FOLDER_ID, MediaFoldersTableMap::COL_FOLDER_NAME, MediaFoldersTableMap::COL_PARENT_ID, MediaFoldersTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['folder_id', 'folder_name', 'parent_id', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['FolderId' => 0, 'FolderName' => 1, 'ParentId' => 2, 'CompanyId' => 3, ],
        self::TYPE_CAMELNAME     => ['folderId' => 0, 'folderName' => 1, 'parentId' => 2, 'companyId' => 3, ],
        self::TYPE_COLNAME       => [MediaFoldersTableMap::COL_FOLDER_ID => 0, MediaFoldersTableMap::COL_FOLDER_NAME => 1, MediaFoldersTableMap::COL_PARENT_ID => 2, MediaFoldersTableMap::COL_COMPANY_ID => 3, ],
        self::TYPE_FIELDNAME     => ['folder_id' => 0, 'folder_name' => 1, 'parent_id' => 2, 'company_id' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FolderId' => 'FOLDER_ID',
        'MediaFolders.FolderId' => 'FOLDER_ID',
        'folderId' => 'FOLDER_ID',
        'mediaFolders.folderId' => 'FOLDER_ID',
        'MediaFoldersTableMap::COL_FOLDER_ID' => 'FOLDER_ID',
        'COL_FOLDER_ID' => 'FOLDER_ID',
        'folder_id' => 'FOLDER_ID',
        'media_folders.folder_id' => 'FOLDER_ID',
        'FolderName' => 'FOLDER_NAME',
        'MediaFolders.FolderName' => 'FOLDER_NAME',
        'folderName' => 'FOLDER_NAME',
        'mediaFolders.folderName' => 'FOLDER_NAME',
        'MediaFoldersTableMap::COL_FOLDER_NAME' => 'FOLDER_NAME',
        'COL_FOLDER_NAME' => 'FOLDER_NAME',
        'folder_name' => 'FOLDER_NAME',
        'media_folders.folder_name' => 'FOLDER_NAME',
        'ParentId' => 'PARENT_ID',
        'MediaFolders.ParentId' => 'PARENT_ID',
        'parentId' => 'PARENT_ID',
        'mediaFolders.parentId' => 'PARENT_ID',
        'MediaFoldersTableMap::COL_PARENT_ID' => 'PARENT_ID',
        'COL_PARENT_ID' => 'PARENT_ID',
        'parent_id' => 'PARENT_ID',
        'media_folders.parent_id' => 'PARENT_ID',
        'CompanyId' => 'COMPANY_ID',
        'MediaFolders.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mediaFolders.companyId' => 'COMPANY_ID',
        'MediaFoldersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'media_folders.company_id' => 'COMPANY_ID',
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
        $this->setName('media_folders');
        $this->setPhpName('MediaFolders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MediaFolders');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('media_folders_folder_id_seq');
        // columns
        $this->addPrimaryKey('folder_id', 'FolderId', 'INTEGER', true, null, null);
        $this->addColumn('folder_name', 'FolderName', 'VARCHAR', true, 100, null);
        $this->addColumn('parent_id', 'ParentId', 'INTEGER', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
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
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':folder_id',
    1 => ':folder_id',
  ),
), null, null, 'MediaFiless', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MediaFoldersTableMap::CLASS_DEFAULT : MediaFoldersTableMap::OM_CLASS;
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
     * @return array (MediaFolders object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MediaFoldersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MediaFoldersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MediaFoldersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MediaFoldersTableMap::OM_CLASS;
            /** @var MediaFolders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MediaFoldersTableMap::addInstanceToPool($obj, $key);
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
            $key = MediaFoldersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MediaFoldersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MediaFolders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MediaFoldersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MediaFoldersTableMap::COL_FOLDER_ID);
            $criteria->addSelectColumn(MediaFoldersTableMap::COL_FOLDER_NAME);
            $criteria->addSelectColumn(MediaFoldersTableMap::COL_PARENT_ID);
            $criteria->addSelectColumn(MediaFoldersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.folder_id');
            $criteria->addSelectColumn($alias . '.folder_name');
            $criteria->addSelectColumn($alias . '.parent_id');
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
            $criteria->removeSelectColumn(MediaFoldersTableMap::COL_FOLDER_ID);
            $criteria->removeSelectColumn(MediaFoldersTableMap::COL_FOLDER_NAME);
            $criteria->removeSelectColumn(MediaFoldersTableMap::COL_PARENT_ID);
            $criteria->removeSelectColumn(MediaFoldersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.folder_id');
            $criteria->removeSelectColumn($alias . '.folder_name');
            $criteria->removeSelectColumn($alias . '.parent_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(MediaFoldersTableMap::DATABASE_NAME)->getTable(MediaFoldersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MediaFolders or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MediaFolders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFoldersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MediaFolders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MediaFoldersTableMap::DATABASE_NAME);
            $criteria->add(MediaFoldersTableMap::COL_FOLDER_ID, (array) $values, Criteria::IN);
        }

        $query = MediaFoldersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MediaFoldersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MediaFoldersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the media_folders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MediaFoldersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MediaFolders or Criteria object.
     *
     * @param mixed $criteria Criteria or MediaFolders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFoldersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MediaFolders object
        }

        if ($criteria->containsKey(MediaFoldersTableMap::COL_FOLDER_ID) && $criteria->keyContainsValue(MediaFoldersTableMap::COL_FOLDER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MediaFoldersTableMap::COL_FOLDER_ID.')');
        }


        // Set the correct dbName
        $query = MediaFoldersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

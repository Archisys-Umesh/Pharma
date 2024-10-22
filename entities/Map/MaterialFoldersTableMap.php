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
use entities\MaterialFolders;
use entities\MaterialFoldersQuery;


/**
 * This class defines the structure of the 'material_folders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MaterialFoldersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MaterialFoldersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'material_folders';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MaterialFolders';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MaterialFolders';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MaterialFolders';

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
     * the column name for the folder_id field
     */
    public const COL_FOLDER_ID = 'material_folders.folder_id';

    /**
     * the column name for the folder_name field
     */
    public const COL_FOLDER_NAME = 'material_folders.folder_name';

    /**
     * the column name for the folder_parent_id field
     */
    public const COL_FOLDER_PARENT_ID = 'material_folders.folder_parent_id';

    /**
     * the column name for the folder_icon field
     */
    public const COL_FOLDER_ICON = 'material_folders.folder_icon';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'material_folders.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'material_folders.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'material_folders.company_id';

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
        self::TYPE_PHPNAME       => ['FolderId', 'FolderName', 'FolderParentId', 'FolderIcon', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['folderId', 'folderName', 'folderParentId', 'folderIcon', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [MaterialFoldersTableMap::COL_FOLDER_ID, MaterialFoldersTableMap::COL_FOLDER_NAME, MaterialFoldersTableMap::COL_FOLDER_PARENT_ID, MaterialFoldersTableMap::COL_FOLDER_ICON, MaterialFoldersTableMap::COL_CREATED_AT, MaterialFoldersTableMap::COL_UPDATED_AT, MaterialFoldersTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['folder_id', 'folder_name', 'folder_parent_id', 'folder_icon', 'created_at', 'updated_at', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['FolderId' => 0, 'FolderName' => 1, 'FolderParentId' => 2, 'FolderIcon' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'CompanyId' => 6, ],
        self::TYPE_CAMELNAME     => ['folderId' => 0, 'folderName' => 1, 'folderParentId' => 2, 'folderIcon' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'companyId' => 6, ],
        self::TYPE_COLNAME       => [MaterialFoldersTableMap::COL_FOLDER_ID => 0, MaterialFoldersTableMap::COL_FOLDER_NAME => 1, MaterialFoldersTableMap::COL_FOLDER_PARENT_ID => 2, MaterialFoldersTableMap::COL_FOLDER_ICON => 3, MaterialFoldersTableMap::COL_CREATED_AT => 4, MaterialFoldersTableMap::COL_UPDATED_AT => 5, MaterialFoldersTableMap::COL_COMPANY_ID => 6, ],
        self::TYPE_FIELDNAME     => ['folder_id' => 0, 'folder_name' => 1, 'folder_parent_id' => 2, 'folder_icon' => 3, 'created_at' => 4, 'updated_at' => 5, 'company_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FolderId' => 'FOLDER_ID',
        'MaterialFolders.FolderId' => 'FOLDER_ID',
        'folderId' => 'FOLDER_ID',
        'materialFolders.folderId' => 'FOLDER_ID',
        'MaterialFoldersTableMap::COL_FOLDER_ID' => 'FOLDER_ID',
        'COL_FOLDER_ID' => 'FOLDER_ID',
        'folder_id' => 'FOLDER_ID',
        'material_folders.folder_id' => 'FOLDER_ID',
        'FolderName' => 'FOLDER_NAME',
        'MaterialFolders.FolderName' => 'FOLDER_NAME',
        'folderName' => 'FOLDER_NAME',
        'materialFolders.folderName' => 'FOLDER_NAME',
        'MaterialFoldersTableMap::COL_FOLDER_NAME' => 'FOLDER_NAME',
        'COL_FOLDER_NAME' => 'FOLDER_NAME',
        'folder_name' => 'FOLDER_NAME',
        'material_folders.folder_name' => 'FOLDER_NAME',
        'FolderParentId' => 'FOLDER_PARENT_ID',
        'MaterialFolders.FolderParentId' => 'FOLDER_PARENT_ID',
        'folderParentId' => 'FOLDER_PARENT_ID',
        'materialFolders.folderParentId' => 'FOLDER_PARENT_ID',
        'MaterialFoldersTableMap::COL_FOLDER_PARENT_ID' => 'FOLDER_PARENT_ID',
        'COL_FOLDER_PARENT_ID' => 'FOLDER_PARENT_ID',
        'folder_parent_id' => 'FOLDER_PARENT_ID',
        'material_folders.folder_parent_id' => 'FOLDER_PARENT_ID',
        'FolderIcon' => 'FOLDER_ICON',
        'MaterialFolders.FolderIcon' => 'FOLDER_ICON',
        'folderIcon' => 'FOLDER_ICON',
        'materialFolders.folderIcon' => 'FOLDER_ICON',
        'MaterialFoldersTableMap::COL_FOLDER_ICON' => 'FOLDER_ICON',
        'COL_FOLDER_ICON' => 'FOLDER_ICON',
        'folder_icon' => 'FOLDER_ICON',
        'material_folders.folder_icon' => 'FOLDER_ICON',
        'CreatedAt' => 'CREATED_AT',
        'MaterialFolders.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'materialFolders.createdAt' => 'CREATED_AT',
        'MaterialFoldersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'material_folders.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'MaterialFolders.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'materialFolders.updatedAt' => 'UPDATED_AT',
        'MaterialFoldersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'material_folders.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'MaterialFolders.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'materialFolders.companyId' => 'COMPANY_ID',
        'MaterialFoldersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'material_folders.company_id' => 'COMPANY_ID',
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
        $this->setName('material_folders');
        $this->setPhpName('MaterialFolders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MaterialFolders');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('material_folders_folder_id_seq');
        // columns
        $this->addPrimaryKey('folder_id', 'FolderId', 'INTEGER', true, null, null);
        $this->addColumn('folder_name', 'FolderName', 'VARCHAR', false, null, null);
        $this->addColumn('folder_parent_id', 'FolderParentId', 'INTEGER', false, null, null);
        $this->addColumn('folder_icon', 'FolderIcon', 'INTEGER', false, null, null);
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
        $this->addRelation('Material', '\\entities\\Material', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':folder_id',
    1 => ':folder_id',
  ),
), null, null, 'Materials', false);
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
        return $withPrefix ? MaterialFoldersTableMap::CLASS_DEFAULT : MaterialFoldersTableMap::OM_CLASS;
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
     * @return array (MaterialFolders object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MaterialFoldersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MaterialFoldersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MaterialFoldersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MaterialFoldersTableMap::OM_CLASS;
            /** @var MaterialFolders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MaterialFoldersTableMap::addInstanceToPool($obj, $key);
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
            $key = MaterialFoldersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MaterialFoldersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MaterialFolders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MaterialFoldersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_FOLDER_ID);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_FOLDER_NAME);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_FOLDER_PARENT_ID);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_FOLDER_ICON);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(MaterialFoldersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.folder_id');
            $criteria->addSelectColumn($alias . '.folder_name');
            $criteria->addSelectColumn($alias . '.folder_parent_id');
            $criteria->addSelectColumn($alias . '.folder_icon');
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
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_FOLDER_ID);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_FOLDER_NAME);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_FOLDER_PARENT_ID);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_FOLDER_ICON);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(MaterialFoldersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.folder_id');
            $criteria->removeSelectColumn($alias . '.folder_name');
            $criteria->removeSelectColumn($alias . '.folder_parent_id');
            $criteria->removeSelectColumn($alias . '.folder_icon');
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
        return Propel::getServiceContainer()->getDatabaseMap(MaterialFoldersTableMap::DATABASE_NAME)->getTable(MaterialFoldersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MaterialFolders or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MaterialFolders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialFoldersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MaterialFolders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MaterialFoldersTableMap::DATABASE_NAME);
            $criteria->add(MaterialFoldersTableMap::COL_FOLDER_ID, (array) $values, Criteria::IN);
        }

        $query = MaterialFoldersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MaterialFoldersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MaterialFoldersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the material_folders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MaterialFoldersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MaterialFolders or Criteria object.
     *
     * @param mixed $criteria Criteria or MaterialFolders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialFoldersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MaterialFolders object
        }

        if ($criteria->containsKey(MaterialFoldersTableMap::COL_FOLDER_ID) && $criteria->keyContainsValue(MaterialFoldersTableMap::COL_FOLDER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MaterialFoldersTableMap::COL_FOLDER_ID.')');
        }


        // Set the correct dbName
        $query = MaterialFoldersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

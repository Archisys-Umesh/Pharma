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
use entities\Material;
use entities\MaterialQuery;


/**
 * This class defines the structure of the 'material' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MaterialTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MaterialTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'material';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Material';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Material';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Material';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'material.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'material.name';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'material.description';

    /**
     * the column name for the url field
     */
    public const COL_URL = 'material.url';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'material.media_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'material.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'material.updated_at';

    /**
     * the column name for the orgunitids field
     */
    public const COL_ORGUNITIDS = 'material.orgunitids';

    /**
     * the column name for the designations field
     */
    public const COL_DESIGNATIONS = 'material.designations';

    /**
     * the column name for the folder_id field
     */
    public const COL_FOLDER_ID = 'material.folder_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'material.company_id';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Description', 'Url', 'MediaId', 'CreatedAt', 'UpdatedAt', 'Orgunitids', 'Designations', 'FolderId', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'description', 'url', 'mediaId', 'createdAt', 'updatedAt', 'orgunitids', 'designations', 'folderId', 'companyId', ],
        self::TYPE_COLNAME       => [MaterialTableMap::COL_ID, MaterialTableMap::COL_NAME, MaterialTableMap::COL_DESCRIPTION, MaterialTableMap::COL_URL, MaterialTableMap::COL_MEDIA_ID, MaterialTableMap::COL_CREATED_AT, MaterialTableMap::COL_UPDATED_AT, MaterialTableMap::COL_ORGUNITIDS, MaterialTableMap::COL_DESIGNATIONS, MaterialTableMap::COL_FOLDER_ID, MaterialTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'description', 'url', 'media_id', 'created_at', 'updated_at', 'orgunitids', 'designations', 'folder_id', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Description' => 2, 'Url' => 3, 'MediaId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Orgunitids' => 7, 'Designations' => 8, 'FolderId' => 9, 'CompanyId' => 10, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'description' => 2, 'url' => 3, 'mediaId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'orgunitids' => 7, 'designations' => 8, 'folderId' => 9, 'companyId' => 10, ],
        self::TYPE_COLNAME       => [MaterialTableMap::COL_ID => 0, MaterialTableMap::COL_NAME => 1, MaterialTableMap::COL_DESCRIPTION => 2, MaterialTableMap::COL_URL => 3, MaterialTableMap::COL_MEDIA_ID => 4, MaterialTableMap::COL_CREATED_AT => 5, MaterialTableMap::COL_UPDATED_AT => 6, MaterialTableMap::COL_ORGUNITIDS => 7, MaterialTableMap::COL_DESIGNATIONS => 8, MaterialTableMap::COL_FOLDER_ID => 9, MaterialTableMap::COL_COMPANY_ID => 10, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'description' => 2, 'url' => 3, 'media_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'orgunitids' => 7, 'designations' => 8, 'folder_id' => 9, 'company_id' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Material.Id' => 'ID',
        'id' => 'ID',
        'material.id' => 'ID',
        'MaterialTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Name' => 'NAME',
        'Material.Name' => 'NAME',
        'name' => 'NAME',
        'material.name' => 'NAME',
        'MaterialTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Description' => 'DESCRIPTION',
        'Material.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'material.description' => 'DESCRIPTION',
        'MaterialTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Url' => 'URL',
        'Material.Url' => 'URL',
        'url' => 'URL',
        'material.url' => 'URL',
        'MaterialTableMap::COL_URL' => 'URL',
        'COL_URL' => 'URL',
        'MediaId' => 'MEDIA_ID',
        'Material.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'material.mediaId' => 'MEDIA_ID',
        'MaterialTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'material.media_id' => 'MEDIA_ID',
        'CreatedAt' => 'CREATED_AT',
        'Material.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'material.createdAt' => 'CREATED_AT',
        'MaterialTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'material.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Material.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'material.updatedAt' => 'UPDATED_AT',
        'MaterialTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'material.updated_at' => 'UPDATED_AT',
        'Orgunitids' => 'ORGUNITIDS',
        'Material.Orgunitids' => 'ORGUNITIDS',
        'orgunitids' => 'ORGUNITIDS',
        'material.orgunitids' => 'ORGUNITIDS',
        'MaterialTableMap::COL_ORGUNITIDS' => 'ORGUNITIDS',
        'COL_ORGUNITIDS' => 'ORGUNITIDS',
        'Designations' => 'DESIGNATIONS',
        'Material.Designations' => 'DESIGNATIONS',
        'designations' => 'DESIGNATIONS',
        'material.designations' => 'DESIGNATIONS',
        'MaterialTableMap::COL_DESIGNATIONS' => 'DESIGNATIONS',
        'COL_DESIGNATIONS' => 'DESIGNATIONS',
        'FolderId' => 'FOLDER_ID',
        'Material.FolderId' => 'FOLDER_ID',
        'folderId' => 'FOLDER_ID',
        'material.folderId' => 'FOLDER_ID',
        'MaterialTableMap::COL_FOLDER_ID' => 'FOLDER_ID',
        'COL_FOLDER_ID' => 'FOLDER_ID',
        'folder_id' => 'FOLDER_ID',
        'material.folder_id' => 'FOLDER_ID',
        'CompanyId' => 'COMPANY_ID',
        'Material.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'material.companyId' => 'COMPANY_ID',
        'MaterialTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'material.company_id' => 'COMPANY_ID',
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
        $this->setName('material');
        $this->setPhpName('Material');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Material');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('material_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, 100, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('orgunitids', 'Orgunitids', 'VARCHAR', false, null, null);
        $this->addColumn('designations', 'Designations', 'VARCHAR', false, null, null);
        $this->addForeignKey('folder_id', 'FolderId', 'INTEGER', 'material_folders', 'folder_id', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('MaterialFolders', '\\entities\\MaterialFolders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':folder_id',
    1 => ':folder_id',
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
        return $withPrefix ? MaterialTableMap::CLASS_DEFAULT : MaterialTableMap::OM_CLASS;
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
     * @return array (Material object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MaterialTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MaterialTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MaterialTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MaterialTableMap::OM_CLASS;
            /** @var Material $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MaterialTableMap::addInstanceToPool($obj, $key);
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
            $key = MaterialTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MaterialTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Material $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MaterialTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MaterialTableMap::COL_ID);
            $criteria->addSelectColumn(MaterialTableMap::COL_NAME);
            $criteria->addSelectColumn(MaterialTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(MaterialTableMap::COL_URL);
            $criteria->addSelectColumn(MaterialTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(MaterialTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MaterialTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(MaterialTableMap::COL_ORGUNITIDS);
            $criteria->addSelectColumn(MaterialTableMap::COL_DESIGNATIONS);
            $criteria->addSelectColumn(MaterialTableMap::COL_FOLDER_ID);
            $criteria->addSelectColumn(MaterialTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunitids');
            $criteria->addSelectColumn($alias . '.designations');
            $criteria->addSelectColumn($alias . '.folder_id');
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
            $criteria->removeSelectColumn(MaterialTableMap::COL_ID);
            $criteria->removeSelectColumn(MaterialTableMap::COL_NAME);
            $criteria->removeSelectColumn(MaterialTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(MaterialTableMap::COL_URL);
            $criteria->removeSelectColumn(MaterialTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(MaterialTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(MaterialTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(MaterialTableMap::COL_ORGUNITIDS);
            $criteria->removeSelectColumn(MaterialTableMap::COL_DESIGNATIONS);
            $criteria->removeSelectColumn(MaterialTableMap::COL_FOLDER_ID);
            $criteria->removeSelectColumn(MaterialTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.url');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunitids');
            $criteria->removeSelectColumn($alias . '.designations');
            $criteria->removeSelectColumn($alias . '.folder_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(MaterialTableMap::DATABASE_NAME)->getTable(MaterialTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Material or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Material object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Material) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MaterialTableMap::DATABASE_NAME);
            $criteria->add(MaterialTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = MaterialQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MaterialTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MaterialTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MaterialQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Material or Criteria object.
     *
     * @param mixed $criteria Criteria or Material object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Material object
        }

        if ($criteria->containsKey(MaterialTableMap::COL_ID) && $criteria->keyContainsValue(MaterialTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MaterialTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MaterialQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\OutletTags;
use entities\OutletTagsQuery;


/**
 * This class defines the structure of the 'outlet_tags' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletTagsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletTagsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_tags';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletTags';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletTags';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletTags';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the outlet_tag_id field
     */
    public const COL_OUTLET_TAG_ID = 'outlet_tags.outlet_tag_id';

    /**
     * the column name for the tag_name field
     */
    public const COL_TAG_NAME = 'outlet_tags.tag_name';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_tags.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_tags.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_tags.updated_at';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'outlet_tags.integration_id';

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
        self::TYPE_PHPNAME       => ['OutletTagId', 'TagName', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['outletTagId', 'tagName', 'companyId', 'createdAt', 'updatedAt', 'integrationId', ],
        self::TYPE_COLNAME       => [OutletTagsTableMap::COL_OUTLET_TAG_ID, OutletTagsTableMap::COL_TAG_NAME, OutletTagsTableMap::COL_COMPANY_ID, OutletTagsTableMap::COL_CREATED_AT, OutletTagsTableMap::COL_UPDATED_AT, OutletTagsTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['outlet_tag_id', 'tag_name', 'company_id', 'created_at', 'updated_at', 'integration_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['OutletTagId' => 0, 'TagName' => 1, 'CompanyId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'IntegrationId' => 5, ],
        self::TYPE_CAMELNAME     => ['outletTagId' => 0, 'tagName' => 1, 'companyId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'integrationId' => 5, ],
        self::TYPE_COLNAME       => [OutletTagsTableMap::COL_OUTLET_TAG_ID => 0, OutletTagsTableMap::COL_TAG_NAME => 1, OutletTagsTableMap::COL_COMPANY_ID => 2, OutletTagsTableMap::COL_CREATED_AT => 3, OutletTagsTableMap::COL_UPDATED_AT => 4, OutletTagsTableMap::COL_INTEGRATION_ID => 5, ],
        self::TYPE_FIELDNAME     => ['outlet_tag_id' => 0, 'tag_name' => 1, 'company_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'integration_id' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletTagId' => 'OUTLET_TAG_ID',
        'OutletTags.OutletTagId' => 'OUTLET_TAG_ID',
        'outletTagId' => 'OUTLET_TAG_ID',
        'outletTags.outletTagId' => 'OUTLET_TAG_ID',
        'OutletTagsTableMap::COL_OUTLET_TAG_ID' => 'OUTLET_TAG_ID',
        'COL_OUTLET_TAG_ID' => 'OUTLET_TAG_ID',
        'outlet_tag_id' => 'OUTLET_TAG_ID',
        'outlet_tags.outlet_tag_id' => 'OUTLET_TAG_ID',
        'TagName' => 'TAG_NAME',
        'OutletTags.TagName' => 'TAG_NAME',
        'tagName' => 'TAG_NAME',
        'outletTags.tagName' => 'TAG_NAME',
        'OutletTagsTableMap::COL_TAG_NAME' => 'TAG_NAME',
        'COL_TAG_NAME' => 'TAG_NAME',
        'tag_name' => 'TAG_NAME',
        'outlet_tags.tag_name' => 'TAG_NAME',
        'CompanyId' => 'COMPANY_ID',
        'OutletTags.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletTags.companyId' => 'COMPANY_ID',
        'OutletTagsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_tags.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletTags.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletTags.createdAt' => 'CREATED_AT',
        'OutletTagsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_tags.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletTags.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletTags.updatedAt' => 'UPDATED_AT',
        'OutletTagsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_tags.updated_at' => 'UPDATED_AT',
        'IntegrationId' => 'INTEGRATION_ID',
        'OutletTags.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'outletTags.integrationId' => 'INTEGRATION_ID',
        'OutletTagsTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'outlet_tags.integration_id' => 'INTEGRATION_ID',
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
        $this->setName('outlet_tags');
        $this->setPhpName('OutletTags');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletTags');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_tags_outlet_tag_id_seq');
        // columns
        $this->addPrimaryKey('outlet_tag_id', 'OutletTagId', 'INTEGER', true, null, null);
        $this->addColumn('tag_name', 'TagName', 'VARCHAR', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
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
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':tags',
    1 => ':outlet_tag_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletTagId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletTagsTableMap::CLASS_DEFAULT : OutletTagsTableMap::OM_CLASS;
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
     * @return array (OutletTags object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletTagsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletTagsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletTagsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletTagsTableMap::OM_CLASS;
            /** @var OutletTags $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletTagsTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletTagsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletTagsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletTags $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletTagsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletTagsTableMap::COL_OUTLET_TAG_ID);
            $criteria->addSelectColumn(OutletTagsTableMap::COL_TAG_NAME);
            $criteria->addSelectColumn(OutletTagsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletTagsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletTagsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletTagsTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_tag_id');
            $criteria->addSelectColumn($alias . '.tag_name');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.integration_id');
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
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_OUTLET_TAG_ID);
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_TAG_NAME);
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletTagsTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_tag_id');
            $criteria->removeSelectColumn($alias . '.tag_name');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.integration_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletTagsTableMap::DATABASE_NAME)->getTable(OutletTagsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletTags or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletTags object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTagsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletTags) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletTagsTableMap::DATABASE_NAME);
            $criteria->add(OutletTagsTableMap::COL_OUTLET_TAG_ID, (array) $values, Criteria::IN);
        }

        $query = OutletTagsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletTagsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletTagsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_tags table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletTagsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletTags or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletTags object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTagsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletTags object
        }

        if ($criteria->containsKey(OutletTagsTableMap::COL_OUTLET_TAG_ID) && $criteria->keyContainsValue(OutletTagsTableMap::COL_OUTLET_TAG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletTagsTableMap::COL_OUTLET_TAG_ID.')');
        }


        // Set the correct dbName
        $query = OutletTagsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

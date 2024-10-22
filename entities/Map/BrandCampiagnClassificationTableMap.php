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
use entities\BrandCampiagnClassification;
use entities\BrandCampiagnClassificationQuery;


/**
 * This class defines the structure of the 'brand_campiagn_classification' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCampiagnClassificationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCampiagnClassificationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_campiagn_classification';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCampiagnClassification';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCampiagnClassification';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCampiagnClassification';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the brand_campiagn_classification_id field
     */
    public const COL_BRAND_CAMPIAGN_CLASSIFICATION_ID = 'brand_campiagn_classification.brand_campiagn_classification_id';

    /**
     * the column name for the classification_id field
     */
    public const COL_CLASSIFICATION_ID = 'brand_campiagn_classification.classification_id';

    /**
     * the column name for the minimum field
     */
    public const COL_MINIMUM = 'brand_campiagn_classification.minimum';

    /**
     * the column name for the maximum field
     */
    public const COL_MAXIMUM = 'brand_campiagn_classification.maximum';

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'brand_campiagn_classification.brand_campiagn_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_campiagn_classification.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_campiagn_classification.updated_at';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'brand_campiagn_classification.comment';

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
        self::TYPE_PHPNAME       => ['BrandCampiagnClassificationId', 'ClassificationId', 'Minimum', 'Maximum', 'BrandCampiagnId', 'CreatedAt', 'UpdatedAt', 'Comment', ],
        self::TYPE_CAMELNAME     => ['brandCampiagnClassificationId', 'classificationId', 'minimum', 'maximum', 'brandCampiagnId', 'createdAt', 'updatedAt', 'comment', ],
        self::TYPE_COLNAME       => [BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID, BrandCampiagnClassificationTableMap::COL_MINIMUM, BrandCampiagnClassificationTableMap::COL_MAXIMUM, BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID, BrandCampiagnClassificationTableMap::COL_CREATED_AT, BrandCampiagnClassificationTableMap::COL_UPDATED_AT, BrandCampiagnClassificationTableMap::COL_COMMENT, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_classification_id', 'classification_id', 'minimum', 'maximum', 'brand_campiagn_id', 'created_at', 'updated_at', 'comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['BrandCampiagnClassificationId' => 0, 'ClassificationId' => 1, 'Minimum' => 2, 'Maximum' => 3, 'BrandCampiagnId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Comment' => 7, ],
        self::TYPE_CAMELNAME     => ['brandCampiagnClassificationId' => 0, 'classificationId' => 1, 'minimum' => 2, 'maximum' => 3, 'brandCampiagnId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'comment' => 7, ],
        self::TYPE_COLNAME       => [BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID => 0, BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID => 1, BrandCampiagnClassificationTableMap::COL_MINIMUM => 2, BrandCampiagnClassificationTableMap::COL_MAXIMUM => 3, BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID => 4, BrandCampiagnClassificationTableMap::COL_CREATED_AT => 5, BrandCampiagnClassificationTableMap::COL_UPDATED_AT => 6, BrandCampiagnClassificationTableMap::COL_COMMENT => 7, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_classification_id' => 0, 'classification_id' => 1, 'minimum' => 2, 'maximum' => 3, 'brand_campiagn_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'comment' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandCampiagnClassificationId' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'BrandCampiagnClassification.BrandCampiagnClassificationId' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'brandCampiagnClassificationId' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'brandCampiagnClassification.brandCampiagnClassificationId' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'COL_BRAND_CAMPIAGN_CLASSIFICATION_ID' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'brand_campiagn_classification_id' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'brand_campiagn_classification.brand_campiagn_classification_id' => 'BRAND_CAMPIAGN_CLASSIFICATION_ID',
        'ClassificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagnClassification.ClassificationId' => 'CLASSIFICATION_ID',
        'classificationId' => 'CLASSIFICATION_ID',
        'brandCampiagnClassification.classificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'classification_id' => 'CLASSIFICATION_ID',
        'brand_campiagn_classification.classification_id' => 'CLASSIFICATION_ID',
        'Minimum' => 'MINIMUM',
        'BrandCampiagnClassification.Minimum' => 'MINIMUM',
        'minimum' => 'MINIMUM',
        'brandCampiagnClassification.minimum' => 'MINIMUM',
        'BrandCampiagnClassificationTableMap::COL_MINIMUM' => 'MINIMUM',
        'COL_MINIMUM' => 'MINIMUM',
        'brand_campiagn_classification.minimum' => 'MINIMUM',
        'Maximum' => 'MAXIMUM',
        'BrandCampiagnClassification.Maximum' => 'MAXIMUM',
        'maximum' => 'MAXIMUM',
        'brandCampiagnClassification.maximum' => 'MAXIMUM',
        'BrandCampiagnClassificationTableMap::COL_MAXIMUM' => 'MAXIMUM',
        'COL_MAXIMUM' => 'MAXIMUM',
        'brand_campiagn_classification.maximum' => 'MAXIMUM',
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnClassification.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnClassification.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_classification.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCampiagnClassification.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCampiagnClassification.createdAt' => 'CREATED_AT',
        'BrandCampiagnClassificationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_campiagn_classification.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCampiagnClassification.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCampiagnClassification.updatedAt' => 'UPDATED_AT',
        'BrandCampiagnClassificationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_campiagn_classification.updated_at' => 'UPDATED_AT',
        'Comment' => 'COMMENT',
        'BrandCampiagnClassification.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'brandCampiagnClassification.comment' => 'COMMENT',
        'BrandCampiagnClassificationTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'brand_campiagn_classification.comment' => 'COMMENT',
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
        $this->setName('brand_campiagn_classification');
        $this->setPhpName('BrandCampiagnClassification');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCampiagnClassification');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_campiagn_classification_brand_campiagn_classification_id_seq');
        // columns
        $this->addPrimaryKey('brand_campiagn_classification_id', 'BrandCampiagnClassificationId', 'INTEGER', true, null, null);
        $this->addForeignKey('classification_id', 'ClassificationId', 'INTEGER', 'classification', 'id', true, null, null);
        $this->addColumn('minimum', 'Minimum', 'INTEGER', true, null, 0);
        $this->addColumn('maximum', 'Maximum', 'INTEGER', true, null, 0);
        $this->addForeignKey('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', 'brand_campiagn', 'brand_campiagn_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('comment', 'Comment', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, null, false);
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':classification_id',
    1 => ':id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandCampiagnClassificationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCampiagnClassificationTableMap::CLASS_DEFAULT : BrandCampiagnClassificationTableMap::OM_CLASS;
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
     * @return array (BrandCampiagnClassification object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCampiagnClassificationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCampiagnClassificationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCampiagnClassificationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCampiagnClassificationTableMap::OM_CLASS;
            /** @var BrandCampiagnClassification $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCampiagnClassificationTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCampiagnClassificationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCampiagnClassificationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCampiagnClassification $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCampiagnClassificationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_MINIMUM);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_MAXIMUM);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCampiagnClassificationTableMap::COL_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.brand_campiagn_classification_id');
            $criteria->addSelectColumn($alias . '.classification_id');
            $criteria->addSelectColumn($alias . '.minimum');
            $criteria->addSelectColumn($alias . '.maximum');
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.comment');
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
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_CLASSIFICATION_ID);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_MINIMUM);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_MAXIMUM);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnClassificationTableMap::COL_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_campiagn_classification_id');
            $criteria->removeSelectColumn($alias . '.classification_id');
            $criteria->removeSelectColumn($alias . '.minimum');
            $criteria->removeSelectColumn($alias . '.maximum');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.comment');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCampiagnClassificationTableMap::DATABASE_NAME)->getTable(BrandCampiagnClassificationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCampiagnClassification or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCampiagnClassification object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnClassificationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCampiagnClassification) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCampiagnClassificationTableMap::DATABASE_NAME);
            $criteria->add(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCampiagnClassificationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCampiagnClassificationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCampiagnClassificationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_campiagn_classification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCampiagnClassificationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCampiagnClassification or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCampiagnClassification object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnClassificationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCampiagnClassification object
        }

        if ($criteria->containsKey(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID) && $criteria->keyContainsValue(BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCampiagnClassificationTableMap::COL_BRAND_CAMPIAGN_CLASSIFICATION_ID.')');
        }


        // Set the correct dbName
        $query = BrandCampiagnClassificationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

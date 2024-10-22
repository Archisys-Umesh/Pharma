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
use entities\Citycategory;
use entities\CitycategoryQuery;


/**
 * This class defines the structure of the 'citycategory' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CitycategoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CitycategoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'citycategory';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Citycategory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Citycategory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Citycategory';

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
     * the column name for the citycategoryid field
     */
    public const COL_CITYCATEGORYID = 'citycategory.citycategoryid';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'citycategory.company_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'citycategory.itownid';

    /**
     * the column name for the cityname field
     */
    public const COL_CITYNAME = 'citycategory.cityname';

    /**
     * the column name for the scope field
     */
    public const COL_SCOPE = 'citycategory.scope';

    /**
     * the column name for the identity_key field
     */
    public const COL_IDENTITY_KEY = 'citycategory.identity_key';

    /**
     * the column name for the category field
     */
    public const COL_CATEGORY = 'citycategory.category';

    /**
     * the column name for the grade_id field
     */
    public const COL_GRADE_ID = 'citycategory.grade_id';

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
        self::TYPE_PHPNAME       => ['Citycategoryid', 'CompanyId', 'Itownid', 'Cityname', 'Scope', 'IdentityKey', 'Category', 'GradeId', ],
        self::TYPE_CAMELNAME     => ['citycategoryid', 'companyId', 'itownid', 'cityname', 'scope', 'identityKey', 'category', 'gradeId', ],
        self::TYPE_COLNAME       => [CitycategoryTableMap::COL_CITYCATEGORYID, CitycategoryTableMap::COL_COMPANY_ID, CitycategoryTableMap::COL_ITOWNID, CitycategoryTableMap::COL_CITYNAME, CitycategoryTableMap::COL_SCOPE, CitycategoryTableMap::COL_IDENTITY_KEY, CitycategoryTableMap::COL_CATEGORY, CitycategoryTableMap::COL_GRADE_ID, ],
        self::TYPE_FIELDNAME     => ['citycategoryid', 'company_id', 'itownid', 'cityname', 'scope', 'identity_key', 'category', 'grade_id', ],
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
        self::TYPE_PHPNAME       => ['Citycategoryid' => 0, 'CompanyId' => 1, 'Itownid' => 2, 'Cityname' => 3, 'Scope' => 4, 'IdentityKey' => 5, 'Category' => 6, 'GradeId' => 7, ],
        self::TYPE_CAMELNAME     => ['citycategoryid' => 0, 'companyId' => 1, 'itownid' => 2, 'cityname' => 3, 'scope' => 4, 'identityKey' => 5, 'category' => 6, 'gradeId' => 7, ],
        self::TYPE_COLNAME       => [CitycategoryTableMap::COL_CITYCATEGORYID => 0, CitycategoryTableMap::COL_COMPANY_ID => 1, CitycategoryTableMap::COL_ITOWNID => 2, CitycategoryTableMap::COL_CITYNAME => 3, CitycategoryTableMap::COL_SCOPE => 4, CitycategoryTableMap::COL_IDENTITY_KEY => 5, CitycategoryTableMap::COL_CATEGORY => 6, CitycategoryTableMap::COL_GRADE_ID => 7, ],
        self::TYPE_FIELDNAME     => ['citycategoryid' => 0, 'company_id' => 1, 'itownid' => 2, 'cityname' => 3, 'scope' => 4, 'identity_key' => 5, 'category' => 6, 'grade_id' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Citycategoryid' => 'CITYCATEGORYID',
        'Citycategory.Citycategoryid' => 'CITYCATEGORYID',
        'citycategoryid' => 'CITYCATEGORYID',
        'citycategory.citycategoryid' => 'CITYCATEGORYID',
        'CitycategoryTableMap::COL_CITYCATEGORYID' => 'CITYCATEGORYID',
        'COL_CITYCATEGORYID' => 'CITYCATEGORYID',
        'CompanyId' => 'COMPANY_ID',
        'Citycategory.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'citycategory.companyId' => 'COMPANY_ID',
        'CitycategoryTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'citycategory.company_id' => 'COMPANY_ID',
        'Itownid' => 'ITOWNID',
        'Citycategory.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'citycategory.itownid' => 'ITOWNID',
        'CitycategoryTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'Cityname' => 'CITYNAME',
        'Citycategory.Cityname' => 'CITYNAME',
        'cityname' => 'CITYNAME',
        'citycategory.cityname' => 'CITYNAME',
        'CitycategoryTableMap::COL_CITYNAME' => 'CITYNAME',
        'COL_CITYNAME' => 'CITYNAME',
        'Scope' => 'SCOPE',
        'Citycategory.Scope' => 'SCOPE',
        'scope' => 'SCOPE',
        'citycategory.scope' => 'SCOPE',
        'CitycategoryTableMap::COL_SCOPE' => 'SCOPE',
        'COL_SCOPE' => 'SCOPE',
        'IdentityKey' => 'IDENTITY_KEY',
        'Citycategory.IdentityKey' => 'IDENTITY_KEY',
        'identityKey' => 'IDENTITY_KEY',
        'citycategory.identityKey' => 'IDENTITY_KEY',
        'CitycategoryTableMap::COL_IDENTITY_KEY' => 'IDENTITY_KEY',
        'COL_IDENTITY_KEY' => 'IDENTITY_KEY',
        'identity_key' => 'IDENTITY_KEY',
        'citycategory.identity_key' => 'IDENTITY_KEY',
        'Category' => 'CATEGORY',
        'Citycategory.Category' => 'CATEGORY',
        'category' => 'CATEGORY',
        'citycategory.category' => 'CATEGORY',
        'CitycategoryTableMap::COL_CATEGORY' => 'CATEGORY',
        'COL_CATEGORY' => 'CATEGORY',
        'GradeId' => 'GRADE_ID',
        'Citycategory.GradeId' => 'GRADE_ID',
        'gradeId' => 'GRADE_ID',
        'citycategory.gradeId' => 'GRADE_ID',
        'CitycategoryTableMap::COL_GRADE_ID' => 'GRADE_ID',
        'COL_GRADE_ID' => 'GRADE_ID',
        'grade_id' => 'GRADE_ID',
        'citycategory.grade_id' => 'GRADE_ID',
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
        $this->setName('citycategory');
        $this->setPhpName('Citycategory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Citycategory');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('citycategory_citycategoryid_seq');
        // columns
        $this->addPrimaryKey('citycategoryid', 'Citycategoryid', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', true, null, null);
        $this->addColumn('cityname', 'Cityname', 'VARCHAR', true, 100, null);
        $this->addColumn('scope', 'Scope', 'INTEGER', true, null, 0);
        $this->addColumn('identity_key', 'IdentityKey', 'INTEGER', true, null, 0);
        $this->addColumn('category', 'Category', 'VARCHAR', true, 100, null);
        $this->addForeignKey('grade_id', 'GradeId', 'INTEGER', 'grade_master', 'gradeid', false, null, null);
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
), 'CASCADE', null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('GradeMaster', '\\entities\\GradeMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Citycategoryid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CitycategoryTableMap::CLASS_DEFAULT : CitycategoryTableMap::OM_CLASS;
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
     * @return array (Citycategory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CitycategoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CitycategoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CitycategoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CitycategoryTableMap::OM_CLASS;
            /** @var Citycategory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CitycategoryTableMap::addInstanceToPool($obj, $key);
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
            $key = CitycategoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CitycategoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Citycategory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CitycategoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CitycategoryTableMap::COL_CITYCATEGORYID);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_CITYNAME);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_SCOPE);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_IDENTITY_KEY);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_CATEGORY);
            $criteria->addSelectColumn(CitycategoryTableMap::COL_GRADE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.citycategoryid');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.cityname');
            $criteria->addSelectColumn($alias . '.scope');
            $criteria->addSelectColumn($alias . '.identity_key');
            $criteria->addSelectColumn($alias . '.category');
            $criteria->addSelectColumn($alias . '.grade_id');
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
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_CITYCATEGORYID);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_CITYNAME);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_SCOPE);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_IDENTITY_KEY);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_CATEGORY);
            $criteria->removeSelectColumn(CitycategoryTableMap::COL_GRADE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.citycategoryid');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.cityname');
            $criteria->removeSelectColumn($alias . '.scope');
            $criteria->removeSelectColumn($alias . '.identity_key');
            $criteria->removeSelectColumn($alias . '.category');
            $criteria->removeSelectColumn($alias . '.grade_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(CitycategoryTableMap::DATABASE_NAME)->getTable(CitycategoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Citycategory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Citycategory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CitycategoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Citycategory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CitycategoryTableMap::DATABASE_NAME);
            $criteria->add(CitycategoryTableMap::COL_CITYCATEGORYID, (array) $values, Criteria::IN);
        }

        $query = CitycategoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CitycategoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CitycategoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the citycategory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CitycategoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Citycategory or Criteria object.
     *
     * @param mixed $criteria Criteria or Citycategory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CitycategoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Citycategory object
        }

        if ($criteria->containsKey(CitycategoryTableMap::COL_CITYCATEGORYID) && $criteria->keyContainsValue(CitycategoryTableMap::COL_CITYCATEGORYID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CitycategoryTableMap::COL_CITYCATEGORYID.')');
        }


        // Set the correct dbName
        $query = CitycategoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

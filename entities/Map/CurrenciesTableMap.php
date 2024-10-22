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
use entities\Currencies;
use entities\CurrenciesQuery;


/**
 * This class defines the structure of the 'currencies' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CurrenciesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CurrenciesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'currencies';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Currencies';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Currencies';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Currencies';

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
     * the column name for the currency_id field
     */
    public const COL_CURRENCY_ID = 'currencies.currency_id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'currencies.name';

    /**
     * the column name for the shortcode field
     */
    public const COL_SHORTCODE = 'currencies.shortcode';

    /**
     * the column name for the symbol field
     */
    public const COL_SYMBOL = 'currencies.symbol';

    /**
     * the column name for the conversionrate field
     */
    public const COL_CONVERSIONRATE = 'currencies.conversionrate';

    /**
     * the column name for the fordate field
     */
    public const COL_FORDATE = 'currencies.fordate';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'currencies.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'currencies.updated_at';

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
        self::TYPE_PHPNAME       => ['CurrencyId', 'Name', 'Shortcode', 'Symbol', 'Conversionrate', 'Fordate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['currencyId', 'name', 'shortcode', 'symbol', 'conversionrate', 'fordate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [CurrenciesTableMap::COL_CURRENCY_ID, CurrenciesTableMap::COL_NAME, CurrenciesTableMap::COL_SHORTCODE, CurrenciesTableMap::COL_SYMBOL, CurrenciesTableMap::COL_CONVERSIONRATE, CurrenciesTableMap::COL_FORDATE, CurrenciesTableMap::COL_CREATED_AT, CurrenciesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['currency_id', 'name', 'shortcode', 'symbol', 'conversionrate', 'fordate', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['CurrencyId' => 0, 'Name' => 1, 'Shortcode' => 2, 'Symbol' => 3, 'Conversionrate' => 4, 'Fordate' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['currencyId' => 0, 'name' => 1, 'shortcode' => 2, 'symbol' => 3, 'conversionrate' => 4, 'fordate' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [CurrenciesTableMap::COL_CURRENCY_ID => 0, CurrenciesTableMap::COL_NAME => 1, CurrenciesTableMap::COL_SHORTCODE => 2, CurrenciesTableMap::COL_SYMBOL => 3, CurrenciesTableMap::COL_CONVERSIONRATE => 4, CurrenciesTableMap::COL_FORDATE => 5, CurrenciesTableMap::COL_CREATED_AT => 6, CurrenciesTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['currency_id' => 0, 'name' => 1, 'shortcode' => 2, 'symbol' => 3, 'conversionrate' => 4, 'fordate' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CurrencyId' => 'CURRENCY_ID',
        'Currencies.CurrencyId' => 'CURRENCY_ID',
        'currencyId' => 'CURRENCY_ID',
        'currencies.currencyId' => 'CURRENCY_ID',
        'CurrenciesTableMap::COL_CURRENCY_ID' => 'CURRENCY_ID',
        'COL_CURRENCY_ID' => 'CURRENCY_ID',
        'currency_id' => 'CURRENCY_ID',
        'currencies.currency_id' => 'CURRENCY_ID',
        'Name' => 'NAME',
        'Currencies.Name' => 'NAME',
        'name' => 'NAME',
        'currencies.name' => 'NAME',
        'CurrenciesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Shortcode' => 'SHORTCODE',
        'Currencies.Shortcode' => 'SHORTCODE',
        'shortcode' => 'SHORTCODE',
        'currencies.shortcode' => 'SHORTCODE',
        'CurrenciesTableMap::COL_SHORTCODE' => 'SHORTCODE',
        'COL_SHORTCODE' => 'SHORTCODE',
        'Symbol' => 'SYMBOL',
        'Currencies.Symbol' => 'SYMBOL',
        'symbol' => 'SYMBOL',
        'currencies.symbol' => 'SYMBOL',
        'CurrenciesTableMap::COL_SYMBOL' => 'SYMBOL',
        'COL_SYMBOL' => 'SYMBOL',
        'Conversionrate' => 'CONVERSIONRATE',
        'Currencies.Conversionrate' => 'CONVERSIONRATE',
        'conversionrate' => 'CONVERSIONRATE',
        'currencies.conversionrate' => 'CONVERSIONRATE',
        'CurrenciesTableMap::COL_CONVERSIONRATE' => 'CONVERSIONRATE',
        'COL_CONVERSIONRATE' => 'CONVERSIONRATE',
        'Fordate' => 'FORDATE',
        'Currencies.Fordate' => 'FORDATE',
        'fordate' => 'FORDATE',
        'currencies.fordate' => 'FORDATE',
        'CurrenciesTableMap::COL_FORDATE' => 'FORDATE',
        'COL_FORDATE' => 'FORDATE',
        'CreatedAt' => 'CREATED_AT',
        'Currencies.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'currencies.createdAt' => 'CREATED_AT',
        'CurrenciesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'currencies.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Currencies.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'currencies.updatedAt' => 'UPDATED_AT',
        'CurrenciesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'currencies.updated_at' => 'UPDATED_AT',
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
        $this->setName('currencies');
        $this->setPhpName('Currencies');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Currencies');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('currencies_currency_id_seq');
        // columns
        $this->addPrimaryKey('currency_id', 'CurrencyId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 20, null);
        $this->addColumn('shortcode', 'Shortcode', 'VARCHAR', true, 10, null);
        $this->addColumn('symbol', 'Symbol', 'VARCHAR', true, 10, null);
        $this->addColumn('conversionrate', 'Conversionrate', 'DOUBLE', true, 53, null);
        $this->addColumn('fordate', 'Fordate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_default_currency',
    1 => ':currency_id',
  ),
), null, null, 'Companies', false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':trip_currency',
    1 => ':currency_id',
  ),
), null, null, 'Expensess', false);
        $this->addRelation('GeoCountry', '\\entities\\GeoCountry', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':scurrency',
    1 => ':currency_id',
  ),
), null, null, 'GeoCountries', false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':currency_id',
    1 => ':currency_id',
  ),
), 'CASCADE', null, 'OrgUnits', false);
        $this->addRelation('PolicyMaster', '\\entities\\PolicyMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':currency_id',
    1 => ':currency_id',
  ),
), null, null, 'PolicyMasters', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to currencies     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        OrgUnitTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CurrenciesTableMap::CLASS_DEFAULT : CurrenciesTableMap::OM_CLASS;
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
     * @return array (Currencies object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CurrenciesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CurrenciesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CurrenciesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CurrenciesTableMap::OM_CLASS;
            /** @var Currencies $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CurrenciesTableMap::addInstanceToPool($obj, $key);
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
            $key = CurrenciesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CurrenciesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Currencies $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CurrenciesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CurrenciesTableMap::COL_CURRENCY_ID);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_NAME);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_SHORTCODE);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_SYMBOL);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_CONVERSIONRATE);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_FORDATE);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CurrenciesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.currency_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.shortcode');
            $criteria->addSelectColumn($alias . '.symbol');
            $criteria->addSelectColumn($alias . '.conversionrate');
            $criteria->addSelectColumn($alias . '.fordate');
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
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_CURRENCY_ID);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_NAME);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_SHORTCODE);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_SYMBOL);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_CONVERSIONRATE);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_FORDATE);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(CurrenciesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.currency_id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.shortcode');
            $criteria->removeSelectColumn($alias . '.symbol');
            $criteria->removeSelectColumn($alias . '.conversionrate');
            $criteria->removeSelectColumn($alias . '.fordate');
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
        return Propel::getServiceContainer()->getDatabaseMap(CurrenciesTableMap::DATABASE_NAME)->getTable(CurrenciesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Currencies or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Currencies object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Currencies) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CurrenciesTableMap::DATABASE_NAME);
            $criteria->add(CurrenciesTableMap::COL_CURRENCY_ID, (array) $values, Criteria::IN);
        }

        $query = CurrenciesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CurrenciesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CurrenciesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the currencies table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CurrenciesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Currencies or Criteria object.
     *
     * @param mixed $criteria Criteria or Currencies object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Currencies object
        }

        if ($criteria->containsKey(CurrenciesTableMap::COL_CURRENCY_ID) && $criteria->keyContainsValue(CurrenciesTableMap::COL_CURRENCY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CurrenciesTableMap::COL_CURRENCY_ID.')');
        }


        // Set the correct dbName
        $query = CurrenciesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

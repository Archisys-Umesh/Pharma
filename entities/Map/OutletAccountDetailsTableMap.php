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
use entities\OutletAccountDetails;
use entities\OutletAccountDetailsQuery;


/**
 * This class defines the structure of the 'outlet_account_details' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletAccountDetailsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletAccountDetailsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_account_details';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletAccountDetails';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletAccountDetails';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletAccountDetails';

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
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_account_details.outlet_id';

    /**
     * the column name for the outlet_bank_name field
     */
    public const COL_OUTLET_BANK_NAME = 'outlet_account_details.outlet_bank_name';

    /**
     * the column name for the outlet_account_no field
     */
    public const COL_OUTLET_ACCOUNT_NO = 'outlet_account_details.outlet_account_no';

    /**
     * the column name for the outlet_pan field
     */
    public const COL_OUTLET_PAN = 'outlet_account_details.outlet_pan';

    /**
     * the column name for the outlet_gst field
     */
    public const COL_OUTLET_GST = 'outlet_account_details.outlet_gst';

    /**
     * the column name for the outlet_company_name field
     */
    public const COL_OUTLET_COMPANY_NAME = 'outlet_account_details.outlet_company_name';

    /**
     * the column name for the outlet_integration_code field
     */
    public const COL_OUTLET_INTEGRATION_CODE = 'outlet_account_details.outlet_integration_code';

    /**
     * the column name for the outlet_default_pricebook field
     */
    public const COL_OUTLET_DEFAULT_PRICEBOOK = 'outlet_account_details.outlet_default_pricebook';

    /**
     * the column name for the outlet_default_category field
     */
    public const COL_OUTLET_DEFAULT_CATEGORY = 'outlet_account_details.outlet_default_category';

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
        self::TYPE_PHPNAME       => ['OutletId', 'OutletBankName', 'OutletAccountNo', 'OutletPan', 'OutletGst', 'OutletCompanyName', 'OutletIntegrationCode', 'OutletDefaultPricebook', 'OutletDefaultCategory', ],
        self::TYPE_CAMELNAME     => ['outletId', 'outletBankName', 'outletAccountNo', 'outletPan', 'outletGst', 'outletCompanyName', 'outletIntegrationCode', 'outletDefaultPricebook', 'outletDefaultCategory', ],
        self::TYPE_COLNAME       => [OutletAccountDetailsTableMap::COL_OUTLET_ID, OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME, OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO, OutletAccountDetailsTableMap::COL_OUTLET_PAN, OutletAccountDetailsTableMap::COL_OUTLET_GST, OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME, OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE, OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK, OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY, ],
        self::TYPE_FIELDNAME     => ['outlet_id', 'outlet_bank_name', 'outlet_account_no', 'outlet_pan', 'outlet_gst', 'outlet_company_name', 'outlet_integration_code', 'outlet_default_pricebook', 'outlet_default_category', ],
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
        self::TYPE_PHPNAME       => ['OutletId' => 0, 'OutletBankName' => 1, 'OutletAccountNo' => 2, 'OutletPan' => 3, 'OutletGst' => 4, 'OutletCompanyName' => 5, 'OutletIntegrationCode' => 6, 'OutletDefaultPricebook' => 7, 'OutletDefaultCategory' => 8, ],
        self::TYPE_CAMELNAME     => ['outletId' => 0, 'outletBankName' => 1, 'outletAccountNo' => 2, 'outletPan' => 3, 'outletGst' => 4, 'outletCompanyName' => 5, 'outletIntegrationCode' => 6, 'outletDefaultPricebook' => 7, 'outletDefaultCategory' => 8, ],
        self::TYPE_COLNAME       => [OutletAccountDetailsTableMap::COL_OUTLET_ID => 0, OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME => 1, OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO => 2, OutletAccountDetailsTableMap::COL_OUTLET_PAN => 3, OutletAccountDetailsTableMap::COL_OUTLET_GST => 4, OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME => 5, OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE => 6, OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK => 7, OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY => 8, ],
        self::TYPE_FIELDNAME     => ['outlet_id' => 0, 'outlet_bank_name' => 1, 'outlet_account_no' => 2, 'outlet_pan' => 3, 'outlet_gst' => 4, 'outlet_company_name' => 5, 'outlet_integration_code' => 6, 'outlet_default_pricebook' => 7, 'outlet_default_category' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletId' => 'OUTLET_ID',
        'OutletAccountDetails.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletAccountDetails.outletId' => 'OUTLET_ID',
        'OutletAccountDetailsTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_account_details.outlet_id' => 'OUTLET_ID',
        'OutletBankName' => 'OUTLET_BANK_NAME',
        'OutletAccountDetails.OutletBankName' => 'OUTLET_BANK_NAME',
        'outletBankName' => 'OUTLET_BANK_NAME',
        'outletAccountDetails.outletBankName' => 'OUTLET_BANK_NAME',
        'OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME' => 'OUTLET_BANK_NAME',
        'COL_OUTLET_BANK_NAME' => 'OUTLET_BANK_NAME',
        'outlet_bank_name' => 'OUTLET_BANK_NAME',
        'outlet_account_details.outlet_bank_name' => 'OUTLET_BANK_NAME',
        'OutletAccountNo' => 'OUTLET_ACCOUNT_NO',
        'OutletAccountDetails.OutletAccountNo' => 'OUTLET_ACCOUNT_NO',
        'outletAccountNo' => 'OUTLET_ACCOUNT_NO',
        'outletAccountDetails.outletAccountNo' => 'OUTLET_ACCOUNT_NO',
        'OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO' => 'OUTLET_ACCOUNT_NO',
        'COL_OUTLET_ACCOUNT_NO' => 'OUTLET_ACCOUNT_NO',
        'outlet_account_no' => 'OUTLET_ACCOUNT_NO',
        'outlet_account_details.outlet_account_no' => 'OUTLET_ACCOUNT_NO',
        'OutletPan' => 'OUTLET_PAN',
        'OutletAccountDetails.OutletPan' => 'OUTLET_PAN',
        'outletPan' => 'OUTLET_PAN',
        'outletAccountDetails.outletPan' => 'OUTLET_PAN',
        'OutletAccountDetailsTableMap::COL_OUTLET_PAN' => 'OUTLET_PAN',
        'COL_OUTLET_PAN' => 'OUTLET_PAN',
        'outlet_pan' => 'OUTLET_PAN',
        'outlet_account_details.outlet_pan' => 'OUTLET_PAN',
        'OutletGst' => 'OUTLET_GST',
        'OutletAccountDetails.OutletGst' => 'OUTLET_GST',
        'outletGst' => 'OUTLET_GST',
        'outletAccountDetails.outletGst' => 'OUTLET_GST',
        'OutletAccountDetailsTableMap::COL_OUTLET_GST' => 'OUTLET_GST',
        'COL_OUTLET_GST' => 'OUTLET_GST',
        'outlet_gst' => 'OUTLET_GST',
        'outlet_account_details.outlet_gst' => 'OUTLET_GST',
        'OutletCompanyName' => 'OUTLET_COMPANY_NAME',
        'OutletAccountDetails.OutletCompanyName' => 'OUTLET_COMPANY_NAME',
        'outletCompanyName' => 'OUTLET_COMPANY_NAME',
        'outletAccountDetails.outletCompanyName' => 'OUTLET_COMPANY_NAME',
        'OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME' => 'OUTLET_COMPANY_NAME',
        'COL_OUTLET_COMPANY_NAME' => 'OUTLET_COMPANY_NAME',
        'outlet_company_name' => 'OUTLET_COMPANY_NAME',
        'outlet_account_details.outlet_company_name' => 'OUTLET_COMPANY_NAME',
        'OutletIntegrationCode' => 'OUTLET_INTEGRATION_CODE',
        'OutletAccountDetails.OutletIntegrationCode' => 'OUTLET_INTEGRATION_CODE',
        'outletIntegrationCode' => 'OUTLET_INTEGRATION_CODE',
        'outletAccountDetails.outletIntegrationCode' => 'OUTLET_INTEGRATION_CODE',
        'OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE' => 'OUTLET_INTEGRATION_CODE',
        'COL_OUTLET_INTEGRATION_CODE' => 'OUTLET_INTEGRATION_CODE',
        'outlet_integration_code' => 'OUTLET_INTEGRATION_CODE',
        'outlet_account_details.outlet_integration_code' => 'OUTLET_INTEGRATION_CODE',
        'OutletDefaultPricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'OutletAccountDetails.OutletDefaultPricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'outletDefaultPricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'outletAccountDetails.outletDefaultPricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK' => 'OUTLET_DEFAULT_PRICEBOOK',
        'COL_OUTLET_DEFAULT_PRICEBOOK' => 'OUTLET_DEFAULT_PRICEBOOK',
        'outlet_default_pricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'outlet_account_details.outlet_default_pricebook' => 'OUTLET_DEFAULT_PRICEBOOK',
        'OutletDefaultCategory' => 'OUTLET_DEFAULT_CATEGORY',
        'OutletAccountDetails.OutletDefaultCategory' => 'OUTLET_DEFAULT_CATEGORY',
        'outletDefaultCategory' => 'OUTLET_DEFAULT_CATEGORY',
        'outletAccountDetails.outletDefaultCategory' => 'OUTLET_DEFAULT_CATEGORY',
        'OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY' => 'OUTLET_DEFAULT_CATEGORY',
        'COL_OUTLET_DEFAULT_CATEGORY' => 'OUTLET_DEFAULT_CATEGORY',
        'outlet_default_category' => 'OUTLET_DEFAULT_CATEGORY',
        'outlet_account_details.outlet_default_category' => 'OUTLET_DEFAULT_CATEGORY',
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
        $this->setName('outlet_account_details');
        $this->setPhpName('OutletAccountDetails');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletAccountDetails');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('outlet_id', 'OutletId', 'INTEGER' , 'outlets', 'id', true, null, null);
        $this->addColumn('outlet_bank_name', 'OutletBankName', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_account_no', 'OutletAccountNo', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_pan', 'OutletPan', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_gst', 'OutletGst', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_company_name', 'OutletCompanyName', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_integration_code', 'OutletIntegrationCode', 'VARCHAR', true, 200, '');
        $this->addColumn('outlet_default_pricebook', 'OutletDefaultPricebook', 'INTEGER', true, null, 0);
        $this->addColumn('outlet_default_category', 'OutletDefaultCategory', 'VARCHAR', true, 50, '0');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletAccountDetailsTableMap::CLASS_DEFAULT : OutletAccountDetailsTableMap::OM_CLASS;
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
     * @return array (OutletAccountDetails object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletAccountDetailsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletAccountDetailsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletAccountDetailsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletAccountDetailsTableMap::OM_CLASS;
            /** @var OutletAccountDetails $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletAccountDetailsTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletAccountDetailsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletAccountDetailsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletAccountDetails $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletAccountDetailsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_PAN);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_GST);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK);
            $criteria->addSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_bank_name');
            $criteria->addSelectColumn($alias . '.outlet_account_no');
            $criteria->addSelectColumn($alias . '.outlet_pan');
            $criteria->addSelectColumn($alias . '.outlet_gst');
            $criteria->addSelectColumn($alias . '.outlet_company_name');
            $criteria->addSelectColumn($alias . '.outlet_integration_code');
            $criteria->addSelectColumn($alias . '.outlet_default_pricebook');
            $criteria->addSelectColumn($alias . '.outlet_default_category');
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
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_PAN);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_GST);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK);
            $criteria->removeSelectColumn(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_bank_name');
            $criteria->removeSelectColumn($alias . '.outlet_account_no');
            $criteria->removeSelectColumn($alias . '.outlet_pan');
            $criteria->removeSelectColumn($alias . '.outlet_gst');
            $criteria->removeSelectColumn($alias . '.outlet_company_name');
            $criteria->removeSelectColumn($alias . '.outlet_integration_code');
            $criteria->removeSelectColumn($alias . '.outlet_default_pricebook');
            $criteria->removeSelectColumn($alias . '.outlet_default_category');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletAccountDetailsTableMap::DATABASE_NAME)->getTable(OutletAccountDetailsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletAccountDetails or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletAccountDetails object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAccountDetailsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletAccountDetails) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletAccountDetailsTableMap::DATABASE_NAME);
            $criteria->add(OutletAccountDetailsTableMap::COL_OUTLET_ID, (array) $values, Criteria::IN);
        }

        $query = OutletAccountDetailsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletAccountDetailsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletAccountDetailsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_account_details table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletAccountDetailsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletAccountDetails or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletAccountDetails object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAccountDetailsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletAccountDetails object
        }


        // Set the correct dbName
        $query = OutletAccountDetailsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

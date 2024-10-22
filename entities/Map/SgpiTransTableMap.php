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
use entities\SgpiTrans;
use entities\SgpiTransQuery;


/**
 * This class defines the structure of the 'sgpi_trans' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiTransTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiTransTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_trans';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiTrans';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiTrans';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiTrans';

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
     * the column name for the sgpi_tran_id field
     */
    public const COL_SGPI_TRAN_ID = 'sgpi_trans.sgpi_tran_id';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'sgpi_trans.sgpi_id';

    /**
     * the column name for the sgpi_account_id field
     */
    public const COL_SGPI_ACCOUNT_ID = 'sgpi_trans.sgpi_account_id';

    /**
     * the column name for the cd field
     */
    public const COL_CD = 'sgpi_trans.cd';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'sgpi_trans.qty';

    /**
     * the column name for the voucher_no field
     */
    public const COL_VOUCHER_NO = 'sgpi_trans.voucher_no';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'sgpi_trans.remark';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'sgpi_trans.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_trans.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sgpi_trans.updated_at';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'sgpi_trans.outlet_org_id';

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
        self::TYPE_PHPNAME       => ['SgpiTranId', 'SgpiId', 'SgpiAccountId', 'Cd', 'Qty', 'VoucherNo', 'Remark', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OutletOrgId', ],
        self::TYPE_CAMELNAME     => ['sgpiTranId', 'sgpiId', 'sgpiAccountId', 'cd', 'qty', 'voucherNo', 'remark', 'companyId', 'createdAt', 'updatedAt', 'outletOrgId', ],
        self::TYPE_COLNAME       => [SgpiTransTableMap::COL_SGPI_TRAN_ID, SgpiTransTableMap::COL_SGPI_ID, SgpiTransTableMap::COL_SGPI_ACCOUNT_ID, SgpiTransTableMap::COL_CD, SgpiTransTableMap::COL_QTY, SgpiTransTableMap::COL_VOUCHER_NO, SgpiTransTableMap::COL_REMARK, SgpiTransTableMap::COL_COMPANY_ID, SgpiTransTableMap::COL_CREATED_AT, SgpiTransTableMap::COL_UPDATED_AT, SgpiTransTableMap::COL_OUTLET_ORG_ID, ],
        self::TYPE_FIELDNAME     => ['sgpi_tran_id', 'sgpi_id', 'sgpi_account_id', 'cd', 'qty', 'voucher_no', 'remark', 'company_id', 'created_at', 'updated_at', 'outlet_org_id', ],
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
        self::TYPE_PHPNAME       => ['SgpiTranId' => 0, 'SgpiId' => 1, 'SgpiAccountId' => 2, 'Cd' => 3, 'Qty' => 4, 'VoucherNo' => 5, 'Remark' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'OutletOrgId' => 10, ],
        self::TYPE_CAMELNAME     => ['sgpiTranId' => 0, 'sgpiId' => 1, 'sgpiAccountId' => 2, 'cd' => 3, 'qty' => 4, 'voucherNo' => 5, 'remark' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'outletOrgId' => 10, ],
        self::TYPE_COLNAME       => [SgpiTransTableMap::COL_SGPI_TRAN_ID => 0, SgpiTransTableMap::COL_SGPI_ID => 1, SgpiTransTableMap::COL_SGPI_ACCOUNT_ID => 2, SgpiTransTableMap::COL_CD => 3, SgpiTransTableMap::COL_QTY => 4, SgpiTransTableMap::COL_VOUCHER_NO => 5, SgpiTransTableMap::COL_REMARK => 6, SgpiTransTableMap::COL_COMPANY_ID => 7, SgpiTransTableMap::COL_CREATED_AT => 8, SgpiTransTableMap::COL_UPDATED_AT => 9, SgpiTransTableMap::COL_OUTLET_ORG_ID => 10, ],
        self::TYPE_FIELDNAME     => ['sgpi_tran_id' => 0, 'sgpi_id' => 1, 'sgpi_account_id' => 2, 'cd' => 3, 'qty' => 4, 'voucher_no' => 5, 'remark' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'outlet_org_id' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiTranId' => 'SGPI_TRAN_ID',
        'SgpiTrans.SgpiTranId' => 'SGPI_TRAN_ID',
        'sgpiTranId' => 'SGPI_TRAN_ID',
        'sgpiTrans.sgpiTranId' => 'SGPI_TRAN_ID',
        'SgpiTransTableMap::COL_SGPI_TRAN_ID' => 'SGPI_TRAN_ID',
        'COL_SGPI_TRAN_ID' => 'SGPI_TRAN_ID',
        'sgpi_tran_id' => 'SGPI_TRAN_ID',
        'sgpi_trans.sgpi_tran_id' => 'SGPI_TRAN_ID',
        'SgpiId' => 'SGPI_ID',
        'SgpiTrans.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'sgpiTrans.sgpiId' => 'SGPI_ID',
        'SgpiTransTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'sgpi_trans.sgpi_id' => 'SGPI_ID',
        'SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiTrans.SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiTrans.sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiTransTableMap::COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'sgpi_trans.sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'Cd' => 'CD',
        'SgpiTrans.Cd' => 'CD',
        'cd' => 'CD',
        'sgpiTrans.cd' => 'CD',
        'SgpiTransTableMap::COL_CD' => 'CD',
        'COL_CD' => 'CD',
        'sgpi_trans.cd' => 'CD',
        'Qty' => 'QTY',
        'SgpiTrans.Qty' => 'QTY',
        'qty' => 'QTY',
        'sgpiTrans.qty' => 'QTY',
        'SgpiTransTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'sgpi_trans.qty' => 'QTY',
        'VoucherNo' => 'VOUCHER_NO',
        'SgpiTrans.VoucherNo' => 'VOUCHER_NO',
        'voucherNo' => 'VOUCHER_NO',
        'sgpiTrans.voucherNo' => 'VOUCHER_NO',
        'SgpiTransTableMap::COL_VOUCHER_NO' => 'VOUCHER_NO',
        'COL_VOUCHER_NO' => 'VOUCHER_NO',
        'voucher_no' => 'VOUCHER_NO',
        'sgpi_trans.voucher_no' => 'VOUCHER_NO',
        'Remark' => 'REMARK',
        'SgpiTrans.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'sgpiTrans.remark' => 'REMARK',
        'SgpiTransTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'sgpi_trans.remark' => 'REMARK',
        'CompanyId' => 'COMPANY_ID',
        'SgpiTrans.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'sgpiTrans.companyId' => 'COMPANY_ID',
        'SgpiTransTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'sgpi_trans.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'SgpiTrans.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sgpiTrans.createdAt' => 'CREATED_AT',
        'SgpiTransTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_trans.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SgpiTrans.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sgpiTrans.updatedAt' => 'UPDATED_AT',
        'SgpiTransTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sgpi_trans.updated_at' => 'UPDATED_AT',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'SgpiTrans.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'sgpiTrans.outletOrgId' => 'OUTLET_ORG_ID',
        'SgpiTransTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'sgpi_trans.outlet_org_id' => 'OUTLET_ORG_ID',
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
        $this->setName('sgpi_trans');
        $this->setPhpName('SgpiTrans');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiTrans');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('sgpi_trans_sgpi_tran_id_seq');
        // columns
        $this->addPrimaryKey('sgpi_tran_id', 'SgpiTranId', 'INTEGER', true, null, null);
        $this->addForeignKey('sgpi_id', 'SgpiId', 'INTEGER', 'sgpi_master', 'sgpi_id', false, null, null);
        $this->addForeignKey('sgpi_account_id', 'SgpiAccountId', 'INTEGER', 'sgpi_accounts', 'sgpi_account_id', false, null, null);
        $this->addColumn('cd', 'Cd', 'VARCHAR', false, null, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('voucher_no', 'VoucherNo', 'BIGINT', false, null, null);
        $this->addColumn('remark', 'Remark', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SgpiAccounts', '\\entities\\SgpiAccounts', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sgpi_account_id',
    1 => ':sgpi_account_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sgpi_id',
    1 => ':sgpi_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpiTranId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiTransTableMap::CLASS_DEFAULT : SgpiTransTableMap::OM_CLASS;
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
     * @return array (SgpiTrans object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiTransTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiTransTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiTransTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiTransTableMap::OM_CLASS;
            /** @var SgpiTrans $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiTransTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiTransTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiTransTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiTrans $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiTransTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiTransTableMap::COL_SGPI_TRAN_ID);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_CD);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_QTY);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_VOUCHER_NO);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_REMARK);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SgpiTransTableMap::COL_OUTLET_ORG_ID);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_tran_id');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.sgpi_account_id');
            $criteria->addSelectColumn($alias . '.cd');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.voucher_no');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
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
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_SGPI_TRAN_ID);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_CD);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_QTY);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_VOUCHER_NO);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_REMARK);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SgpiTransTableMap::COL_OUTLET_ORG_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_tran_id');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.sgpi_account_id');
            $criteria->removeSelectColumn($alias . '.cd');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.voucher_no');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiTransTableMap::DATABASE_NAME)->getTable(SgpiTransTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiTrans or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiTrans object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiTrans) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiTransTableMap::DATABASE_NAME);
            $criteria->add(SgpiTransTableMap::COL_SGPI_TRAN_ID, (array) $values, Criteria::IN);
        }

        $query = SgpiTransQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiTransTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiTransTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_trans table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiTransQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiTrans or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiTrans object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiTrans object
        }

        if ($criteria->containsKey(SgpiTransTableMap::COL_SGPI_TRAN_ID) && $criteria->keyContainsValue(SgpiTransTableMap::COL_SGPI_TRAN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SgpiTransTableMap::COL_SGPI_TRAN_ID.')');
        }


        // Set the correct dbName
        $query = SgpiTransQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\PolicyMaster;
use entities\PolicyMasterQuery;


/**
 * This class defines the structure of the 'policy_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PolicyMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PolicyMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'policy_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PolicyMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\PolicyMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.PolicyMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the policy_id field
     */
    public const COL_POLICY_ID = 'policy_master.policy_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'policy_master.company_id';

    /**
     * the column name for the policy_name field
     */
    public const COL_POLICY_NAME = 'policy_master.policy_name';

    /**
     * the column name for the policy_code field
     */
    public const COL_POLICY_CODE = 'policy_master.policy_code';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'policy_master.org_unit_id';

    /**
     * the column name for the currency_id field
     */
    public const COL_CURRENCY_ID = 'policy_master.currency_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'policy_master.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'policy_master.updated_at';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'policy_master.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'policy_master.end_date';

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
        self::TYPE_PHPNAME       => ['PolicyId', 'CompanyId', 'PolicyName', 'PolicyCode', 'OrgUnitId', 'CurrencyId', 'CreatedAt', 'UpdatedAt', 'StartDate', 'EndDate', ],
        self::TYPE_CAMELNAME     => ['policyId', 'companyId', 'policyName', 'policyCode', 'orgUnitId', 'currencyId', 'createdAt', 'updatedAt', 'startDate', 'endDate', ],
        self::TYPE_COLNAME       => [PolicyMasterTableMap::COL_POLICY_ID, PolicyMasterTableMap::COL_COMPANY_ID, PolicyMasterTableMap::COL_POLICY_NAME, PolicyMasterTableMap::COL_POLICY_CODE, PolicyMasterTableMap::COL_ORG_UNIT_ID, PolicyMasterTableMap::COL_CURRENCY_ID, PolicyMasterTableMap::COL_CREATED_AT, PolicyMasterTableMap::COL_UPDATED_AT, PolicyMasterTableMap::COL_START_DATE, PolicyMasterTableMap::COL_END_DATE, ],
        self::TYPE_FIELDNAME     => ['policy_id', 'company_id', 'policy_name', 'policy_code', 'org_unit_id', 'currency_id', 'created_at', 'updated_at', 'start_date', 'end_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['PolicyId' => 0, 'CompanyId' => 1, 'PolicyName' => 2, 'PolicyCode' => 3, 'OrgUnitId' => 4, 'CurrencyId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'StartDate' => 8, 'EndDate' => 9, ],
        self::TYPE_CAMELNAME     => ['policyId' => 0, 'companyId' => 1, 'policyName' => 2, 'policyCode' => 3, 'orgUnitId' => 4, 'currencyId' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'startDate' => 8, 'endDate' => 9, ],
        self::TYPE_COLNAME       => [PolicyMasterTableMap::COL_POLICY_ID => 0, PolicyMasterTableMap::COL_COMPANY_ID => 1, PolicyMasterTableMap::COL_POLICY_NAME => 2, PolicyMasterTableMap::COL_POLICY_CODE => 3, PolicyMasterTableMap::COL_ORG_UNIT_ID => 4, PolicyMasterTableMap::COL_CURRENCY_ID => 5, PolicyMasterTableMap::COL_CREATED_AT => 6, PolicyMasterTableMap::COL_UPDATED_AT => 7, PolicyMasterTableMap::COL_START_DATE => 8, PolicyMasterTableMap::COL_END_DATE => 9, ],
        self::TYPE_FIELDNAME     => ['policy_id' => 0, 'company_id' => 1, 'policy_name' => 2, 'policy_code' => 3, 'org_unit_id' => 4, 'currency_id' => 5, 'created_at' => 6, 'updated_at' => 7, 'start_date' => 8, 'end_date' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PolicyId' => 'POLICY_ID',
        'PolicyMaster.PolicyId' => 'POLICY_ID',
        'policyId' => 'POLICY_ID',
        'policyMaster.policyId' => 'POLICY_ID',
        'PolicyMasterTableMap::COL_POLICY_ID' => 'POLICY_ID',
        'COL_POLICY_ID' => 'POLICY_ID',
        'policy_id' => 'POLICY_ID',
        'policy_master.policy_id' => 'POLICY_ID',
        'CompanyId' => 'COMPANY_ID',
        'PolicyMaster.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'policyMaster.companyId' => 'COMPANY_ID',
        'PolicyMasterTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'policy_master.company_id' => 'COMPANY_ID',
        'PolicyName' => 'POLICY_NAME',
        'PolicyMaster.PolicyName' => 'POLICY_NAME',
        'policyName' => 'POLICY_NAME',
        'policyMaster.policyName' => 'POLICY_NAME',
        'PolicyMasterTableMap::COL_POLICY_NAME' => 'POLICY_NAME',
        'COL_POLICY_NAME' => 'POLICY_NAME',
        'policy_name' => 'POLICY_NAME',
        'policy_master.policy_name' => 'POLICY_NAME',
        'PolicyCode' => 'POLICY_CODE',
        'PolicyMaster.PolicyCode' => 'POLICY_CODE',
        'policyCode' => 'POLICY_CODE',
        'policyMaster.policyCode' => 'POLICY_CODE',
        'PolicyMasterTableMap::COL_POLICY_CODE' => 'POLICY_CODE',
        'COL_POLICY_CODE' => 'POLICY_CODE',
        'policy_code' => 'POLICY_CODE',
        'policy_master.policy_code' => 'POLICY_CODE',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'PolicyMaster.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'policyMaster.orgUnitId' => 'ORG_UNIT_ID',
        'PolicyMasterTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'policy_master.org_unit_id' => 'ORG_UNIT_ID',
        'CurrencyId' => 'CURRENCY_ID',
        'PolicyMaster.CurrencyId' => 'CURRENCY_ID',
        'currencyId' => 'CURRENCY_ID',
        'policyMaster.currencyId' => 'CURRENCY_ID',
        'PolicyMasterTableMap::COL_CURRENCY_ID' => 'CURRENCY_ID',
        'COL_CURRENCY_ID' => 'CURRENCY_ID',
        'currency_id' => 'CURRENCY_ID',
        'policy_master.currency_id' => 'CURRENCY_ID',
        'CreatedAt' => 'CREATED_AT',
        'PolicyMaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'policyMaster.createdAt' => 'CREATED_AT',
        'PolicyMasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'policy_master.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'PolicyMaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'policyMaster.updatedAt' => 'UPDATED_AT',
        'PolicyMasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'policy_master.updated_at' => 'UPDATED_AT',
        'StartDate' => 'START_DATE',
        'PolicyMaster.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'policyMaster.startDate' => 'START_DATE',
        'PolicyMasterTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'policy_master.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'PolicyMaster.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'policyMaster.endDate' => 'END_DATE',
        'PolicyMasterTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'policy_master.end_date' => 'END_DATE',
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
        $this->setName('policy_master');
        $this->setPhpName('PolicyMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\PolicyMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('policy_master_policy_id_seq');
        // columns
        $this->addPrimaryKey('policy_id', 'PolicyId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('policy_name', 'PolicyName', 'VARCHAR', true, 100, null);
        $this->addColumn('policy_code', 'PolicyCode', 'VARCHAR', true, 50, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addForeignKey('currency_id', 'CurrencyId', 'INTEGER', 'currencies', 'currency_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
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
        $this->addRelation('Currencies', '\\entities\\Currencies', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':currency_id',
    1 => ':currency_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('GradePolicy', '\\entities\\GradePolicy', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':policy_id',
    1 => ':policy_id',
  ),
), 'CASCADE', null, 'GradePolicies', false);
        $this->addRelation('PolicyRows', '\\entities\\PolicyRows', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':policy_id',
    1 => ':policy_id',
  ),
), null, null, 'PolicyRowss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to policy_master     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        GradePolicyTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PolicyId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PolicyMasterTableMap::CLASS_DEFAULT : PolicyMasterTableMap::OM_CLASS;
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
     * @return array (PolicyMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PolicyMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PolicyMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PolicyMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PolicyMasterTableMap::OM_CLASS;
            /** @var PolicyMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PolicyMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = PolicyMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PolicyMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PolicyMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PolicyMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_POLICY_ID);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_POLICY_NAME);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_POLICY_CODE);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_CURRENCY_ID);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_START_DATE);
            $criteria->addSelectColumn(PolicyMasterTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.policy_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.policy_name');
            $criteria->addSelectColumn($alias . '.policy_code');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.currency_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
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
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_POLICY_ID);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_POLICY_NAME);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_POLICY_CODE);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_CURRENCY_ID);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(PolicyMasterTableMap::COL_END_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.policy_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.policy_name');
            $criteria->removeSelectColumn($alias . '.policy_code');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.currency_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(PolicyMasterTableMap::DATABASE_NAME)->getTable(PolicyMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PolicyMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PolicyMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\PolicyMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PolicyMasterTableMap::DATABASE_NAME);
            $criteria->add(PolicyMasterTableMap::COL_POLICY_ID, (array) $values, Criteria::IN);
        }

        $query = PolicyMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PolicyMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PolicyMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the policy_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PolicyMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PolicyMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or PolicyMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PolicyMaster object
        }

        if ($criteria->containsKey(PolicyMasterTableMap::COL_POLICY_ID) && $criteria->keyContainsValue(PolicyMasterTableMap::COL_POLICY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PolicyMasterTableMap::COL_POLICY_ID.')');
        }


        // Set the correct dbName
        $query = PolicyMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\BeatOutlets;
use entities\BeatOutletsQuery;


/**
 * This class defines the structure of the 'beat_outlets' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BeatOutletsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BeatOutletsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'beat_outlets';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BeatOutlets';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BeatOutlets';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BeatOutlets';

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
     * the column name for the beat_outlet_mapid field
     */
    public const COL_BEAT_OUTLET_MAPID = 'beat_outlets.beat_outlet_mapid';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'beat_outlets.beat_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'beat_outlets.company_id';

    /**
     * the column name for the beat_org_outlet field
     */
    public const COL_BEAT_ORG_OUTLET = 'beat_outlets.beat_org_outlet';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'beat_outlets.status';

    /**
     * the column name for the active_date field
     */
    public const COL_ACTIVE_DATE = 'beat_outlets.active_date';

    /**
     * the column name for the inactive_date field
     */
    public const COL_INACTIVE_DATE = 'beat_outlets.inactive_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'beat_outlets.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'beat_outlets.updated_at';

    /**
     * the column name for the report_end_date field
     */
    public const COL_REPORT_END_DATE = 'beat_outlets.report_end_date';

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
        self::TYPE_PHPNAME       => ['BeatOutletMapid', 'BeatId', 'CompanyId', 'BeatOrgOutlet', 'Status', 'ActiveDate', 'InactiveDate', 'CreatedAt', 'UpdatedAt', 'ReportEndDate', ],
        self::TYPE_CAMELNAME     => ['beatOutletMapid', 'beatId', 'companyId', 'beatOrgOutlet', 'status', 'activeDate', 'inactiveDate', 'createdAt', 'updatedAt', 'reportEndDate', ],
        self::TYPE_COLNAME       => [BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, BeatOutletsTableMap::COL_BEAT_ID, BeatOutletsTableMap::COL_COMPANY_ID, BeatOutletsTableMap::COL_BEAT_ORG_OUTLET, BeatOutletsTableMap::COL_STATUS, BeatOutletsTableMap::COL_ACTIVE_DATE, BeatOutletsTableMap::COL_INACTIVE_DATE, BeatOutletsTableMap::COL_CREATED_AT, BeatOutletsTableMap::COL_UPDATED_AT, BeatOutletsTableMap::COL_REPORT_END_DATE, ],
        self::TYPE_FIELDNAME     => ['beat_outlet_mapid', 'beat_id', 'company_id', 'beat_org_outlet', 'status', 'active_date', 'inactive_date', 'created_at', 'updated_at', 'report_end_date', ],
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
        self::TYPE_PHPNAME       => ['BeatOutletMapid' => 0, 'BeatId' => 1, 'CompanyId' => 2, 'BeatOrgOutlet' => 3, 'Status' => 4, 'ActiveDate' => 5, 'InactiveDate' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'ReportEndDate' => 9, ],
        self::TYPE_CAMELNAME     => ['beatOutletMapid' => 0, 'beatId' => 1, 'companyId' => 2, 'beatOrgOutlet' => 3, 'status' => 4, 'activeDate' => 5, 'inactiveDate' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'reportEndDate' => 9, ],
        self::TYPE_COLNAME       => [BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID => 0, BeatOutletsTableMap::COL_BEAT_ID => 1, BeatOutletsTableMap::COL_COMPANY_ID => 2, BeatOutletsTableMap::COL_BEAT_ORG_OUTLET => 3, BeatOutletsTableMap::COL_STATUS => 4, BeatOutletsTableMap::COL_ACTIVE_DATE => 5, BeatOutletsTableMap::COL_INACTIVE_DATE => 6, BeatOutletsTableMap::COL_CREATED_AT => 7, BeatOutletsTableMap::COL_UPDATED_AT => 8, BeatOutletsTableMap::COL_REPORT_END_DATE => 9, ],
        self::TYPE_FIELDNAME     => ['beat_outlet_mapid' => 0, 'beat_id' => 1, 'company_id' => 2, 'beat_org_outlet' => 3, 'status' => 4, 'active_date' => 5, 'inactive_date' => 6, 'created_at' => 7, 'updated_at' => 8, 'report_end_date' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BeatOutletMapid' => 'BEAT_OUTLET_MAPID',
        'BeatOutlets.BeatOutletMapid' => 'BEAT_OUTLET_MAPID',
        'beatOutletMapid' => 'BEAT_OUTLET_MAPID',
        'beatOutlets.beatOutletMapid' => 'BEAT_OUTLET_MAPID',
        'BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID' => 'BEAT_OUTLET_MAPID',
        'COL_BEAT_OUTLET_MAPID' => 'BEAT_OUTLET_MAPID',
        'beat_outlet_mapid' => 'BEAT_OUTLET_MAPID',
        'beat_outlets.beat_outlet_mapid' => 'BEAT_OUTLET_MAPID',
        'BeatId' => 'BEAT_ID',
        'BeatOutlets.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'beatOutlets.beatId' => 'BEAT_ID',
        'BeatOutletsTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'beat_outlets.beat_id' => 'BEAT_ID',
        'CompanyId' => 'COMPANY_ID',
        'BeatOutlets.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'beatOutlets.companyId' => 'COMPANY_ID',
        'BeatOutletsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'beat_outlets.company_id' => 'COMPANY_ID',
        'BeatOrgOutlet' => 'BEAT_ORG_OUTLET',
        'BeatOutlets.BeatOrgOutlet' => 'BEAT_ORG_OUTLET',
        'beatOrgOutlet' => 'BEAT_ORG_OUTLET',
        'beatOutlets.beatOrgOutlet' => 'BEAT_ORG_OUTLET',
        'BeatOutletsTableMap::COL_BEAT_ORG_OUTLET' => 'BEAT_ORG_OUTLET',
        'COL_BEAT_ORG_OUTLET' => 'BEAT_ORG_OUTLET',
        'beat_org_outlet' => 'BEAT_ORG_OUTLET',
        'beat_outlets.beat_org_outlet' => 'BEAT_ORG_OUTLET',
        'Status' => 'STATUS',
        'BeatOutlets.Status' => 'STATUS',
        'status' => 'STATUS',
        'beatOutlets.status' => 'STATUS',
        'BeatOutletsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'beat_outlets.status' => 'STATUS',
        'ActiveDate' => 'ACTIVE_DATE',
        'BeatOutlets.ActiveDate' => 'ACTIVE_DATE',
        'activeDate' => 'ACTIVE_DATE',
        'beatOutlets.activeDate' => 'ACTIVE_DATE',
        'BeatOutletsTableMap::COL_ACTIVE_DATE' => 'ACTIVE_DATE',
        'COL_ACTIVE_DATE' => 'ACTIVE_DATE',
        'active_date' => 'ACTIVE_DATE',
        'beat_outlets.active_date' => 'ACTIVE_DATE',
        'InactiveDate' => 'INACTIVE_DATE',
        'BeatOutlets.InactiveDate' => 'INACTIVE_DATE',
        'inactiveDate' => 'INACTIVE_DATE',
        'beatOutlets.inactiveDate' => 'INACTIVE_DATE',
        'BeatOutletsTableMap::COL_INACTIVE_DATE' => 'INACTIVE_DATE',
        'COL_INACTIVE_DATE' => 'INACTIVE_DATE',
        'inactive_date' => 'INACTIVE_DATE',
        'beat_outlets.inactive_date' => 'INACTIVE_DATE',
        'CreatedAt' => 'CREATED_AT',
        'BeatOutlets.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'beatOutlets.createdAt' => 'CREATED_AT',
        'BeatOutletsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'beat_outlets.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BeatOutlets.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'beatOutlets.updatedAt' => 'UPDATED_AT',
        'BeatOutletsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'beat_outlets.updated_at' => 'UPDATED_AT',
        'ReportEndDate' => 'REPORT_END_DATE',
        'BeatOutlets.ReportEndDate' => 'REPORT_END_DATE',
        'reportEndDate' => 'REPORT_END_DATE',
        'beatOutlets.reportEndDate' => 'REPORT_END_DATE',
        'BeatOutletsTableMap::COL_REPORT_END_DATE' => 'REPORT_END_DATE',
        'COL_REPORT_END_DATE' => 'REPORT_END_DATE',
        'report_end_date' => 'REPORT_END_DATE',
        'beat_outlets.report_end_date' => 'REPORT_END_DATE',
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
        $this->setName('beat_outlets');
        $this->setPhpName('BeatOutlets');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BeatOutlets');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('beat_outlets_beat_outlet_mapid_seq');
        // columns
        $this->addPrimaryKey('beat_outlet_mapid', 'BeatOutletMapid', 'INTEGER', true, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('beat_org_outlet', 'BeatOrgOutlet', 'BIGINT', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, 'active');
        $this->addColumn('active_date', 'ActiveDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('inactive_date', 'InactiveDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('report_end_date', 'ReportEndDate', 'DATE', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_org_outlet',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BeatOutletMapid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BeatOutletsTableMap::CLASS_DEFAULT : BeatOutletsTableMap::OM_CLASS;
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
     * @return array (BeatOutlets object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BeatOutletsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BeatOutletsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BeatOutletsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BeatOutletsTableMap::OM_CLASS;
            /** @var BeatOutlets $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BeatOutletsTableMap::addInstanceToPool($obj, $key);
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
            $key = BeatOutletsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BeatOutletsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BeatOutlets $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BeatOutletsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_STATUS);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_ACTIVE_DATE);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_INACTIVE_DATE);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BeatOutletsTableMap::COL_REPORT_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.beat_outlet_mapid');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.beat_org_outlet');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.active_date');
            $criteria->addSelectColumn($alias . '.inactive_date');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.report_end_date');
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
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_BEAT_ORG_OUTLET);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_ACTIVE_DATE);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_INACTIVE_DATE);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BeatOutletsTableMap::COL_REPORT_END_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.beat_outlet_mapid');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.beat_org_outlet');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.active_date');
            $criteria->removeSelectColumn($alias . '.inactive_date');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.report_end_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(BeatOutletsTableMap::DATABASE_NAME)->getTable(BeatOutletsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BeatOutlets or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BeatOutlets object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatOutletsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BeatOutlets) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BeatOutletsTableMap::DATABASE_NAME);
            $criteria->add(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID, (array) $values, Criteria::IN);
        }

        $query = BeatOutletsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BeatOutletsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BeatOutletsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the beat_outlets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BeatOutletsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BeatOutlets or Criteria object.
     *
     * @param mixed $criteria Criteria or BeatOutlets object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatOutletsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BeatOutlets object
        }

        if ($criteria->containsKey(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID) && $criteria->keyContainsValue(BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BeatOutletsTableMap::COL_BEAT_OUTLET_MAPID.')');
        }


        // Set the correct dbName
        $query = BeatOutletsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

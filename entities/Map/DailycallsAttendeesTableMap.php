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
use entities\DailycallsAttendees;
use entities\DailycallsAttendeesQuery;


/**
 * This class defines the structure of the 'dailycalls_attendees' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DailycallsAttendeesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DailycallsAttendeesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'dailycalls_attendees';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DailycallsAttendees';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DailycallsAttendees';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DailycallsAttendees';

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
     * the column name for the dailycalls_attendees_id field
     */
    public const COL_DAILYCALLS_ATTENDEES_ID = 'dailycalls_attendees.dailycalls_attendees_id';

    /**
     * the column name for the brand_campaign_visit_plan_id field
     */
    public const COL_BRAND_CAMPAIGN_VISIT_PLAN_ID = 'dailycalls_attendees.brand_campaign_visit_plan_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'dailycalls_attendees.outlet_org_data_id';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'dailycalls_attendees.dcr_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'dailycalls_attendees.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'dailycalls_attendees.updated_at';

    /**
     * the column name for the planned_call field
     */
    public const COL_PLANNED_CALL = 'dailycalls_attendees.planned_call';

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
        self::TYPE_PHPNAME       => ['DailycallsAttendeesId', 'BrandCampaignVisitPlanId', 'OutletOrgDataId', 'DcrId', 'CreatedAt', 'UpdatedAt', 'PlannedCall', ],
        self::TYPE_CAMELNAME     => ['dailycallsAttendeesId', 'brandCampaignVisitPlanId', 'outletOrgDataId', 'dcrId', 'createdAt', 'updatedAt', 'plannedCall', ],
        self::TYPE_COLNAME       => [DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID, DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID, DailycallsAttendeesTableMap::COL_DCR_ID, DailycallsAttendeesTableMap::COL_CREATED_AT, DailycallsAttendeesTableMap::COL_UPDATED_AT, DailycallsAttendeesTableMap::COL_PLANNED_CALL, ],
        self::TYPE_FIELDNAME     => ['dailycalls_attendees_id', 'brand_campaign_visit_plan_id', 'outlet_org_data_id', 'dcr_id', 'created_at', 'updated_at', 'planned_call', ],
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
        self::TYPE_PHPNAME       => ['DailycallsAttendeesId' => 0, 'BrandCampaignVisitPlanId' => 1, 'OutletOrgDataId' => 2, 'DcrId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'PlannedCall' => 6, ],
        self::TYPE_CAMELNAME     => ['dailycallsAttendeesId' => 0, 'brandCampaignVisitPlanId' => 1, 'outletOrgDataId' => 2, 'dcrId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'plannedCall' => 6, ],
        self::TYPE_COLNAME       => [DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID => 0, DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID => 1, DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID => 2, DailycallsAttendeesTableMap::COL_DCR_ID => 3, DailycallsAttendeesTableMap::COL_CREATED_AT => 4, DailycallsAttendeesTableMap::COL_UPDATED_AT => 5, DailycallsAttendeesTableMap::COL_PLANNED_CALL => 6, ],
        self::TYPE_FIELDNAME     => ['dailycalls_attendees_id' => 0, 'brand_campaign_visit_plan_id' => 1, 'outlet_org_data_id' => 2, 'dcr_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'planned_call' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DailycallsAttendeesId' => 'DAILYCALLS_ATTENDEES_ID',
        'DailycallsAttendees.DailycallsAttendeesId' => 'DAILYCALLS_ATTENDEES_ID',
        'dailycallsAttendeesId' => 'DAILYCALLS_ATTENDEES_ID',
        'dailycallsAttendees.dailycallsAttendeesId' => 'DAILYCALLS_ATTENDEES_ID',
        'DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID' => 'DAILYCALLS_ATTENDEES_ID',
        'COL_DAILYCALLS_ATTENDEES_ID' => 'DAILYCALLS_ATTENDEES_ID',
        'dailycalls_attendees_id' => 'DAILYCALLS_ATTENDEES_ID',
        'dailycalls_attendees.dailycalls_attendees_id' => 'DAILYCALLS_ATTENDEES_ID',
        'BrandCampaignVisitPlanId' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'DailycallsAttendees.BrandCampaignVisitPlanId' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'brandCampaignVisitPlanId' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'dailycallsAttendees.brandCampaignVisitPlanId' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'COL_BRAND_CAMPAIGN_VISIT_PLAN_ID' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'brand_campaign_visit_plan_id' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'dailycalls_attendees.brand_campaign_visit_plan_id' => 'BRAND_CAMPAIGN_VISIT_PLAN_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'DailycallsAttendees.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'dailycallsAttendees.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'dailycalls_attendees.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'DcrId' => 'DCR_ID',
        'DailycallsAttendees.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'dailycallsAttendees.dcrId' => 'DCR_ID',
        'DailycallsAttendeesTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'dailycalls_attendees.dcr_id' => 'DCR_ID',
        'CreatedAt' => 'CREATED_AT',
        'DailycallsAttendees.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dailycallsAttendees.createdAt' => 'CREATED_AT',
        'DailycallsAttendeesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'dailycalls_attendees.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DailycallsAttendees.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dailycallsAttendees.updatedAt' => 'UPDATED_AT',
        'DailycallsAttendeesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'dailycalls_attendees.updated_at' => 'UPDATED_AT',
        'PlannedCall' => 'PLANNED_CALL',
        'DailycallsAttendees.PlannedCall' => 'PLANNED_CALL',
        'plannedCall' => 'PLANNED_CALL',
        'dailycallsAttendees.plannedCall' => 'PLANNED_CALL',
        'DailycallsAttendeesTableMap::COL_PLANNED_CALL' => 'PLANNED_CALL',
        'COL_PLANNED_CALL' => 'PLANNED_CALL',
        'planned_call' => 'PLANNED_CALL',
        'dailycalls_attendees.planned_call' => 'PLANNED_CALL',
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
        $this->setName('dailycalls_attendees');
        $this->setPhpName('DailycallsAttendees');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DailycallsAttendees');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('dailycalls_attendees_dailycalls_attendees_id_seq');
        // columns
        $this->addPrimaryKey('dailycalls_attendees_id', 'DailycallsAttendeesId', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_campaign_visit_plan_id', 'BrandCampaignVisitPlanId', 'INTEGER', 'brand_campiagn_visit_plan', 'brand_campiagn_visit_plan_id', false, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('dcr_id', 'DcrId', 'INTEGER', 'dailycalls', 'dcr_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('planned_call', 'PlannedCall', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_campaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, null, false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':dcr_id',
    1 => ':dcr_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DailycallsAttendeesId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DailycallsAttendeesTableMap::CLASS_DEFAULT : DailycallsAttendeesTableMap::OM_CLASS;
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
     * @return array (DailycallsAttendees object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DailycallsAttendeesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DailycallsAttendeesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DailycallsAttendeesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DailycallsAttendeesTableMap::OM_CLASS;
            /** @var DailycallsAttendees $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DailycallsAttendeesTableMap::addInstanceToPool($obj, $key);
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
            $key = DailycallsAttendeesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DailycallsAttendeesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DailycallsAttendees $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DailycallsAttendeesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DailycallsAttendeesTableMap::COL_PLANNED_CALL);
        } else {
            $criteria->addSelectColumn($alias . '.dailycalls_attendees_id');
            $criteria->addSelectColumn($alias . '.brand_campaign_visit_plan_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.planned_call');
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
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_BRAND_CAMPAIGN_VISIT_PLAN_ID);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DailycallsAttendeesTableMap::COL_PLANNED_CALL);
        } else {
            $criteria->removeSelectColumn($alias . '.dailycalls_attendees_id');
            $criteria->removeSelectColumn($alias . '.brand_campaign_visit_plan_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.planned_call');
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
        return Propel::getServiceContainer()->getDatabaseMap(DailycallsAttendeesTableMap::DATABASE_NAME)->getTable(DailycallsAttendeesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DailycallsAttendees or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DailycallsAttendees object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsAttendeesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DailycallsAttendees) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DailycallsAttendeesTableMap::DATABASE_NAME);
            $criteria->add(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID, (array) $values, Criteria::IN);
        }

        $query = DailycallsAttendeesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DailycallsAttendeesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DailycallsAttendeesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dailycalls_attendees table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DailycallsAttendeesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DailycallsAttendees or Criteria object.
     *
     * @param mixed $criteria Criteria or DailycallsAttendees object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsAttendeesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DailycallsAttendees object
        }

        if ($criteria->containsKey(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID) && $criteria->keyContainsValue(DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DailycallsAttendeesTableMap::COL_DAILYCALLS_ATTENDEES_ID.')');
        }


        // Set the correct dbName
        $query = DailycallsAttendeesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\BrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery;


/**
 * This class defines the structure of the 'brand_campiagn_visits' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCampiagnVisitsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCampiagnVisitsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_campiagn_visits';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCampiagnVisits';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCampiagnVisits';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCampiagnVisits';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the brand_campiagn_visit_id field
     */
    public const COL_BRAND_CAMPIAGN_VISIT_ID = 'brand_campiagn_visits.brand_campiagn_visit_id';

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'brand_campiagn_visits.brand_campiagn_id';

    /**
     * the column name for the brand_campiagn_visit_plan_id field
     */
    public const COL_BRAND_CAMPIAGN_VISIT_PLAN_ID = 'brand_campiagn_visits.brand_campiagn_visit_plan_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'brand_campiagn_visits.outlet_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_campiagn_visits.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_campiagn_visits.updated_at';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'brand_campiagn_visits.outlet_org_data_id';

    /**
     * the column name for the is_visited field
     */
    public const COL_IS_VISITED = 'brand_campiagn_visits.is_visited';

    /**
     * the column name for the visited_datetime field
     */
    public const COL_VISITED_DATETIME = 'brand_campiagn_visits.visited_datetime';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'brand_campiagn_visits.dcr_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'brand_campiagn_visits.position_id';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'brand_campiagn_visits.comment';

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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitId', 'BrandCampiagnId', 'BrandCampiagnVisitPlanId', 'OutletId', 'CreatedAt', 'UpdatedAt', 'OutletOrgDataId', 'IsVisited', 'VisitedDatetime', 'DcrId', 'PositionId', 'Comment', ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitId', 'brandCampiagnId', 'brandCampiagnVisitPlanId', 'outletId', 'createdAt', 'updatedAt', 'outletOrgDataId', 'isVisited', 'visitedDatetime', 'dcrId', 'positionId', 'comment', ],
        self::TYPE_COLNAME       => [BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID, BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, BrandCampiagnVisitsTableMap::COL_OUTLET_ID, BrandCampiagnVisitsTableMap::COL_CREATED_AT, BrandCampiagnVisitsTableMap::COL_UPDATED_AT, BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID, BrandCampiagnVisitsTableMap::COL_IS_VISITED, BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME, BrandCampiagnVisitsTableMap::COL_DCR_ID, BrandCampiagnVisitsTableMap::COL_POSITION_ID, BrandCampiagnVisitsTableMap::COL_COMMENT, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_id', 'brand_campiagn_id', 'brand_campiagn_visit_plan_id', 'outlet_id', 'created_at', 'updated_at', 'outlet_org_data_id', 'is_visited', 'visited_datetime', 'dcr_id', 'position_id', 'comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitId' => 0, 'BrandCampiagnId' => 1, 'BrandCampiagnVisitPlanId' => 2, 'OutletId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'OutletOrgDataId' => 6, 'IsVisited' => 7, 'VisitedDatetime' => 8, 'DcrId' => 9, 'PositionId' => 10, 'Comment' => 11, ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitId' => 0, 'brandCampiagnId' => 1, 'brandCampiagnVisitPlanId' => 2, 'outletId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'outletOrgDataId' => 6, 'isVisited' => 7, 'visitedDatetime' => 8, 'dcrId' => 9, 'positionId' => 10, 'comment' => 11, ],
        self::TYPE_COLNAME       => [BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID => 0, BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID => 1, BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID => 2, BrandCampiagnVisitsTableMap::COL_OUTLET_ID => 3, BrandCampiagnVisitsTableMap::COL_CREATED_AT => 4, BrandCampiagnVisitsTableMap::COL_UPDATED_AT => 5, BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID => 6, BrandCampiagnVisitsTableMap::COL_IS_VISITED => 7, BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME => 8, BrandCampiagnVisitsTableMap::COL_DCR_ID => 9, BrandCampiagnVisitsTableMap::COL_POSITION_ID => 10, BrandCampiagnVisitsTableMap::COL_COMMENT => 11, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_id' => 0, 'brand_campiagn_id' => 1, 'brand_campiagn_visit_plan_id' => 2, 'outlet_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'outlet_org_data_id' => 6, 'is_visited' => 7, 'visited_datetime' => 8, 'dcr_id' => 9, 'position_id' => 10, 'comment' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'BrandCampiagnVisits.BrandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brandCampiagnVisits.brandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID' => 'BRAND_CAMPIAGN_VISIT_ID',
        'COL_BRAND_CAMPIAGN_VISIT_ID' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brand_campiagn_visit_id' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brand_campiagn_visits.brand_campiagn_visit_id' => 'BRAND_CAMPIAGN_VISIT_ID',
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisits.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnVisits.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_visits.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'BrandCampiagnVisits.BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brandCampiagnVisits.brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brand_campiagn_visits.brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'OutletId' => 'OUTLET_ID',
        'BrandCampiagnVisits.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'brandCampiagnVisits.outletId' => 'OUTLET_ID',
        'BrandCampiagnVisitsTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'brand_campiagn_visits.outlet_id' => 'OUTLET_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCampiagnVisits.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCampiagnVisits.createdAt' => 'CREATED_AT',
        'BrandCampiagnVisitsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_campiagn_visits.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCampiagnVisits.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCampiagnVisits.updatedAt' => 'UPDATED_AT',
        'BrandCampiagnVisitsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_campiagn_visits.updated_at' => 'UPDATED_AT',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'BrandCampiagnVisits.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'brandCampiagnVisits.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'brand_campiagn_visits.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'IsVisited' => 'IS_VISITED',
        'BrandCampiagnVisits.IsVisited' => 'IS_VISITED',
        'isVisited' => 'IS_VISITED',
        'brandCampiagnVisits.isVisited' => 'IS_VISITED',
        'BrandCampiagnVisitsTableMap::COL_IS_VISITED' => 'IS_VISITED',
        'COL_IS_VISITED' => 'IS_VISITED',
        'is_visited' => 'IS_VISITED',
        'brand_campiagn_visits.is_visited' => 'IS_VISITED',
        'VisitedDatetime' => 'VISITED_DATETIME',
        'BrandCampiagnVisits.VisitedDatetime' => 'VISITED_DATETIME',
        'visitedDatetime' => 'VISITED_DATETIME',
        'brandCampiagnVisits.visitedDatetime' => 'VISITED_DATETIME',
        'BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME' => 'VISITED_DATETIME',
        'COL_VISITED_DATETIME' => 'VISITED_DATETIME',
        'visited_datetime' => 'VISITED_DATETIME',
        'brand_campiagn_visits.visited_datetime' => 'VISITED_DATETIME',
        'DcrId' => 'DCR_ID',
        'BrandCampiagnVisits.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'brandCampiagnVisits.dcrId' => 'DCR_ID',
        'BrandCampiagnVisitsTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'brand_campiagn_visits.dcr_id' => 'DCR_ID',
        'PositionId' => 'POSITION_ID',
        'BrandCampiagnVisits.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'brandCampiagnVisits.positionId' => 'POSITION_ID',
        'BrandCampiagnVisitsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'brand_campiagn_visits.position_id' => 'POSITION_ID',
        'Comment' => 'COMMENT',
        'BrandCampiagnVisits.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'brandCampiagnVisits.comment' => 'COMMENT',
        'BrandCampiagnVisitsTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'brand_campiagn_visits.comment' => 'COMMENT',
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
        $this->setName('brand_campiagn_visits');
        $this->setPhpName('BrandCampiagnVisits');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCampiagnVisits');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_campiagn_visits_brand_campiagn_visit_id_seq');
        // columns
        $this->addPrimaryKey('brand_campiagn_visit_id', 'BrandCampiagnVisitId', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', 'brand_campiagn', 'brand_campiagn_id', false, null, null);
        $this->addForeignKey('brand_campiagn_visit_plan_id', 'BrandCampiagnVisitPlanId', 'INTEGER', 'brand_campiagn_visit_plan', 'brand_campiagn_visit_plan_id', false, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('is_visited', 'IsVisited', 'BOOLEAN', false, 1, false);
        $this->addColumn('visited_datetime', 'VisitedDatetime', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('dcr_id', 'DcrId', 'INTEGER', 'dailycalls', 'dcr_id', false, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
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
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_campiagn_visit_plan_id',
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
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCampiagnVisitsTableMap::CLASS_DEFAULT : BrandCampiagnVisitsTableMap::OM_CLASS;
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
     * @return array (BrandCampiagnVisits object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCampiagnVisitsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCampiagnVisitsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCampiagnVisitsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCampiagnVisitsTableMap::OM_CLASS;
            /** @var BrandCampiagnVisits $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCampiagnVisitsTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCampiagnVisitsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCampiagnVisitsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCampiagnVisits $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCampiagnVisitsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_IS_VISITED);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitsTableMap::COL_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.brand_campiagn_visit_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.is_visited');
            $criteria->addSelectColumn($alias . '.visited_datetime');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.position_id');
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
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_IS_VISITED);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_VISITED_DATETIME);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitsTableMap::COL_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_campiagn_visit_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.is_visited');
            $criteria->removeSelectColumn($alias . '.visited_datetime');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.position_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCampiagnVisitsTableMap::DATABASE_NAME)->getTable(BrandCampiagnVisitsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCampiagnVisits or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCampiagnVisits object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCampiagnVisits) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCampiagnVisitsTableMap::DATABASE_NAME);
            $criteria->add(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCampiagnVisitsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCampiagnVisitsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCampiagnVisitsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_campiagn_visits table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCampiagnVisitsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCampiagnVisits or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCampiagnVisits object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCampiagnVisits object
        }

        if ($criteria->containsKey(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID) && $criteria->keyContainsValue(BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCampiagnVisitsTableMap::COL_BRAND_CAMPIAGN_VISIT_ID.')');
        }


        // Set the correct dbName
        $query = BrandCampiagnVisitsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

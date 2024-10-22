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
use entities\CompetitionMapping;
use entities\CompetitionMappingQuery;


/**
 * This class defines the structure of the 'competition_mapping' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CompetitionMappingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CompetitionMappingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'competition_mapping';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CompetitionMapping';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CompetitionMapping';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CompetitionMapping';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'competition_mapping.id';

    /**
     * the column name for the competition_name field
     */
    public const COL_COMPETITION_NAME = 'competition_mapping.competition_name';

    /**
     * the column name for the competition_sku field
     */
    public const COL_COMPETITION_SKU = 'competition_mapping.competition_sku';

    /**
     * the column name for the competition_mrp field
     */
    public const COL_COMPETITION_MRP = 'competition_mapping.competition_mrp';

    /**
     * the column name for the competition_features field
     */
    public const COL_COMPETITION_FEATURES = 'competition_mapping.competition_features';

    /**
     * the column name for the competition_remark field
     */
    public const COL_COMPETITION_REMARK = 'competition_mapping.competition_remark';

    /**
     * the column name for the consumer_feedback field
     */
    public const COL_CONSUMER_FEEDBACK = 'competition_mapping.consumer_feedback';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'competition_mapping.media_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'competition_mapping.company_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'competition_mapping.employee_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'competition_mapping.outlet_id';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'competition_mapping.competitor_id';

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'competition_mapping.unit_id';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'competition_mapping.qty';

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
        self::TYPE_PHPNAME       => ['Id', 'CompetitionName', 'CompetitionSku', 'CompetitionMrp', 'CompetitionFeatures', 'CompetitionRemark', 'ConsumerFeedback', 'MediaId', 'CompanyId', 'EmployeeId', 'OutletId', 'CompetitorId', 'UnitId', 'Qty', ],
        self::TYPE_CAMELNAME     => ['id', 'competitionName', 'competitionSku', 'competitionMrp', 'competitionFeatures', 'competitionRemark', 'consumerFeedback', 'mediaId', 'companyId', 'employeeId', 'outletId', 'competitorId', 'unitId', 'qty', ],
        self::TYPE_COLNAME       => [CompetitionMappingTableMap::COL_ID, CompetitionMappingTableMap::COL_COMPETITION_NAME, CompetitionMappingTableMap::COL_COMPETITION_SKU, CompetitionMappingTableMap::COL_COMPETITION_MRP, CompetitionMappingTableMap::COL_COMPETITION_FEATURES, CompetitionMappingTableMap::COL_COMPETITION_REMARK, CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK, CompetitionMappingTableMap::COL_MEDIA_ID, CompetitionMappingTableMap::COL_COMPANY_ID, CompetitionMappingTableMap::COL_EMPLOYEE_ID, CompetitionMappingTableMap::COL_OUTLET_ID, CompetitionMappingTableMap::COL_COMPETITOR_ID, CompetitionMappingTableMap::COL_UNIT_ID, CompetitionMappingTableMap::COL_QTY, ],
        self::TYPE_FIELDNAME     => ['id', 'competition_name', 'competition_sku', 'competition_mrp', 'competition_features', 'competition_remark', 'consumer_feedback', 'media_id', 'company_id', 'employee_id', 'outlet_id', 'competitor_id', 'unit_id', 'qty', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CompetitionName' => 1, 'CompetitionSku' => 2, 'CompetitionMrp' => 3, 'CompetitionFeatures' => 4, 'CompetitionRemark' => 5, 'ConsumerFeedback' => 6, 'MediaId' => 7, 'CompanyId' => 8, 'EmployeeId' => 9, 'OutletId' => 10, 'CompetitorId' => 11, 'UnitId' => 12, 'Qty' => 13, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'competitionName' => 1, 'competitionSku' => 2, 'competitionMrp' => 3, 'competitionFeatures' => 4, 'competitionRemark' => 5, 'consumerFeedback' => 6, 'mediaId' => 7, 'companyId' => 8, 'employeeId' => 9, 'outletId' => 10, 'competitorId' => 11, 'unitId' => 12, 'qty' => 13, ],
        self::TYPE_COLNAME       => [CompetitionMappingTableMap::COL_ID => 0, CompetitionMappingTableMap::COL_COMPETITION_NAME => 1, CompetitionMappingTableMap::COL_COMPETITION_SKU => 2, CompetitionMappingTableMap::COL_COMPETITION_MRP => 3, CompetitionMappingTableMap::COL_COMPETITION_FEATURES => 4, CompetitionMappingTableMap::COL_COMPETITION_REMARK => 5, CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK => 6, CompetitionMappingTableMap::COL_MEDIA_ID => 7, CompetitionMappingTableMap::COL_COMPANY_ID => 8, CompetitionMappingTableMap::COL_EMPLOYEE_ID => 9, CompetitionMappingTableMap::COL_OUTLET_ID => 10, CompetitionMappingTableMap::COL_COMPETITOR_ID => 11, CompetitionMappingTableMap::COL_UNIT_ID => 12, CompetitionMappingTableMap::COL_QTY => 13, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'competition_name' => 1, 'competition_sku' => 2, 'competition_mrp' => 3, 'competition_features' => 4, 'competition_remark' => 5, 'consumer_feedback' => 6, 'media_id' => 7, 'company_id' => 8, 'employee_id' => 9, 'outlet_id' => 10, 'competitor_id' => 11, 'unit_id' => 12, 'qty' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'CompetitionMapping.Id' => 'ID',
        'id' => 'ID',
        'competitionMapping.id' => 'ID',
        'CompetitionMappingTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'competition_mapping.id' => 'ID',
        'CompetitionName' => 'COMPETITION_NAME',
        'CompetitionMapping.CompetitionName' => 'COMPETITION_NAME',
        'competitionName' => 'COMPETITION_NAME',
        'competitionMapping.competitionName' => 'COMPETITION_NAME',
        'CompetitionMappingTableMap::COL_COMPETITION_NAME' => 'COMPETITION_NAME',
        'COL_COMPETITION_NAME' => 'COMPETITION_NAME',
        'competition_name' => 'COMPETITION_NAME',
        'competition_mapping.competition_name' => 'COMPETITION_NAME',
        'CompetitionSku' => 'COMPETITION_SKU',
        'CompetitionMapping.CompetitionSku' => 'COMPETITION_SKU',
        'competitionSku' => 'COMPETITION_SKU',
        'competitionMapping.competitionSku' => 'COMPETITION_SKU',
        'CompetitionMappingTableMap::COL_COMPETITION_SKU' => 'COMPETITION_SKU',
        'COL_COMPETITION_SKU' => 'COMPETITION_SKU',
        'competition_sku' => 'COMPETITION_SKU',
        'competition_mapping.competition_sku' => 'COMPETITION_SKU',
        'CompetitionMrp' => 'COMPETITION_MRP',
        'CompetitionMapping.CompetitionMrp' => 'COMPETITION_MRP',
        'competitionMrp' => 'COMPETITION_MRP',
        'competitionMapping.competitionMrp' => 'COMPETITION_MRP',
        'CompetitionMappingTableMap::COL_COMPETITION_MRP' => 'COMPETITION_MRP',
        'COL_COMPETITION_MRP' => 'COMPETITION_MRP',
        'competition_mrp' => 'COMPETITION_MRP',
        'competition_mapping.competition_mrp' => 'COMPETITION_MRP',
        'CompetitionFeatures' => 'COMPETITION_FEATURES',
        'CompetitionMapping.CompetitionFeatures' => 'COMPETITION_FEATURES',
        'competitionFeatures' => 'COMPETITION_FEATURES',
        'competitionMapping.competitionFeatures' => 'COMPETITION_FEATURES',
        'CompetitionMappingTableMap::COL_COMPETITION_FEATURES' => 'COMPETITION_FEATURES',
        'COL_COMPETITION_FEATURES' => 'COMPETITION_FEATURES',
        'competition_features' => 'COMPETITION_FEATURES',
        'competition_mapping.competition_features' => 'COMPETITION_FEATURES',
        'CompetitionRemark' => 'COMPETITION_REMARK',
        'CompetitionMapping.CompetitionRemark' => 'COMPETITION_REMARK',
        'competitionRemark' => 'COMPETITION_REMARK',
        'competitionMapping.competitionRemark' => 'COMPETITION_REMARK',
        'CompetitionMappingTableMap::COL_COMPETITION_REMARK' => 'COMPETITION_REMARK',
        'COL_COMPETITION_REMARK' => 'COMPETITION_REMARK',
        'competition_remark' => 'COMPETITION_REMARK',
        'competition_mapping.competition_remark' => 'COMPETITION_REMARK',
        'ConsumerFeedback' => 'CONSUMER_FEEDBACK',
        'CompetitionMapping.ConsumerFeedback' => 'CONSUMER_FEEDBACK',
        'consumerFeedback' => 'CONSUMER_FEEDBACK',
        'competitionMapping.consumerFeedback' => 'CONSUMER_FEEDBACK',
        'CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK' => 'CONSUMER_FEEDBACK',
        'COL_CONSUMER_FEEDBACK' => 'CONSUMER_FEEDBACK',
        'consumer_feedback' => 'CONSUMER_FEEDBACK',
        'competition_mapping.consumer_feedback' => 'CONSUMER_FEEDBACK',
        'MediaId' => 'MEDIA_ID',
        'CompetitionMapping.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'competitionMapping.mediaId' => 'MEDIA_ID',
        'CompetitionMappingTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'competition_mapping.media_id' => 'MEDIA_ID',
        'CompanyId' => 'COMPANY_ID',
        'CompetitionMapping.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'competitionMapping.companyId' => 'COMPANY_ID',
        'CompetitionMappingTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'competition_mapping.company_id' => 'COMPANY_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'CompetitionMapping.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'competitionMapping.employeeId' => 'EMPLOYEE_ID',
        'CompetitionMappingTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'competition_mapping.employee_id' => 'EMPLOYEE_ID',
        'OutletId' => 'OUTLET_ID',
        'CompetitionMapping.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'competitionMapping.outletId' => 'OUTLET_ID',
        'CompetitionMappingTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'competition_mapping.outlet_id' => 'OUTLET_ID',
        'CompetitorId' => 'COMPETITOR_ID',
        'CompetitionMapping.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'competitionMapping.competitorId' => 'COMPETITOR_ID',
        'CompetitionMappingTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'competition_mapping.competitor_id' => 'COMPETITOR_ID',
        'UnitId' => 'UNIT_ID',
        'CompetitionMapping.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'competitionMapping.unitId' => 'UNIT_ID',
        'CompetitionMappingTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'competition_mapping.unit_id' => 'UNIT_ID',
        'Qty' => 'QTY',
        'CompetitionMapping.Qty' => 'QTY',
        'qty' => 'QTY',
        'competitionMapping.qty' => 'QTY',
        'CompetitionMappingTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'competition_mapping.qty' => 'QTY',
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
        $this->setName('competition_mapping');
        $this->setPhpName('CompetitionMapping');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CompetitionMapping');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('competition_mapping_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('competition_name', 'CompetitionName', 'VARCHAR', false, 255, null);
        $this->addColumn('competition_sku', 'CompetitionSku', 'VARCHAR', false, 255, null);
        $this->addColumn('competition_mrp', 'CompetitionMrp', 'DECIMAL', false, 20, null);
        $this->addColumn('competition_features', 'CompetitionFeatures', 'LONGVARCHAR', false, null, null);
        $this->addColumn('competition_remark', 'CompetitionRemark', 'LONGVARCHAR', false, null, null);
        $this->addColumn('consumer_feedback', 'ConsumerFeedback', 'VARCHAR', false, 255, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, 255, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addForeignKey('competitor_id', 'CompetitorId', 'INTEGER', 'competitor', 'id', false, null, null);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unitmaster', 'unit_id', false, null, null);
        $this->addColumn('qty', 'Qty', 'DECIMAL', false, 20, null);
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
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Competitor', '\\entities\\Competitor', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':competitor_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Unitmaster', '\\entities\\Unitmaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':unit_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CompetitionMappingTableMap::CLASS_DEFAULT : CompetitionMappingTableMap::OM_CLASS;
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
     * @return array (CompetitionMapping object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CompetitionMappingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CompetitionMappingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CompetitionMappingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CompetitionMappingTableMap::OM_CLASS;
            /** @var CompetitionMapping $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CompetitionMappingTableMap::addInstanceToPool($obj, $key);
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
            $key = CompetitionMappingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CompetitionMappingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CompetitionMapping $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CompetitionMappingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_NAME);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_SKU);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_MRP);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_FEATURES);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_REMARK);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(CompetitionMappingTableMap::COL_QTY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.competition_name');
            $criteria->addSelectColumn($alias . '.competition_sku');
            $criteria->addSelectColumn($alias . '.competition_mrp');
            $criteria->addSelectColumn($alias . '.competition_features');
            $criteria->addSelectColumn($alias . '.competition_remark');
            $criteria->addSelectColumn($alias . '.consumer_feedback');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.qty');
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
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_NAME);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_SKU);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_MRP);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_FEATURES);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITION_REMARK);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(CompetitionMappingTableMap::COL_QTY);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.competition_name');
            $criteria->removeSelectColumn($alias . '.competition_sku');
            $criteria->removeSelectColumn($alias . '.competition_mrp');
            $criteria->removeSelectColumn($alias . '.competition_features');
            $criteria->removeSelectColumn($alias . '.competition_remark');
            $criteria->removeSelectColumn($alias . '.consumer_feedback');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.unit_id');
            $criteria->removeSelectColumn($alias . '.qty');
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
        return Propel::getServiceContainer()->getDatabaseMap(CompetitionMappingTableMap::DATABASE_NAME)->getTable(CompetitionMappingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CompetitionMapping or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CompetitionMapping object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CompetitionMapping) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CompetitionMappingTableMap::DATABASE_NAME);
            $criteria->add(CompetitionMappingTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CompetitionMappingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CompetitionMappingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CompetitionMappingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the competition_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CompetitionMappingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CompetitionMapping or Criteria object.
     *
     * @param mixed $criteria Criteria or CompetitionMapping object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CompetitionMapping object
        }

        if ($criteria->containsKey(CompetitionMappingTableMap::COL_ID) && $criteria->keyContainsValue(CompetitionMappingTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CompetitionMappingTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CompetitionMappingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\PrescriberTallySummary;
use entities\PrescriberTallySummaryQuery;


/**
 * This class defines the structure of the 'prescriber_tally_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PrescriberTallySummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PrescriberTallySummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'prescriber_tally_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PrescriberTallySummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\PrescriberTallySummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.PrescriberTallySummary';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the prescriber_tally_summary_id field
     */
    public const COL_PRESCRIBER_TALLY_SUMMARY_ID = 'prescriber_tally_summary.prescriber_tally_summary_id';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'prescriber_tally_summary.orgunit_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'prescriber_tally_summary.position_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'prescriber_tally_summary.territory_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'prescriber_tally_summary.brand_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'prescriber_tally_summary.moye';

    /**
     * the column name for the tagged_drs field
     */
    public const COL_TAGGED_DRS = 'prescriber_tally_summary.tagged_drs';

    /**
     * the column name for the lm_rxbers field
     */
    public const COL_LM_RXBERS = 'prescriber_tally_summary.lm_rxbers';

    /**
     * the column name for the cm_rxbers field
     */
    public const COL_CM_RXBERS = 'prescriber_tally_summary.cm_rxbers';

    /**
     * the column name for the gain field
     */
    public const COL_GAIN = 'prescriber_tally_summary.gain';

    /**
     * the column name for the loss field
     */
    public const COL_LOSS = 'prescriber_tally_summary.loss';

    /**
     * the column name for the two_month_rxber field
     */
    public const COL_TWO_MONTH_RXBER = 'prescriber_tally_summary.two_month_rxber';

    /**
     * the column name for the nonrxber field
     */
    public const COL_NONRXBER = 'prescriber_tally_summary.nonrxber';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'prescriber_tally_summary.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'prescriber_tally_summary.updated_at';

    /**
     * the column name for the cm_rcpa field
     */
    public const COL_CM_RCPA = 'prescriber_tally_summary.cm_rcpa';

    /**
     * the column name for the cm_visit field
     */
    public const COL_CM_VISIT = 'prescriber_tally_summary.cm_visit';

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
        self::TYPE_PHPNAME       => ['PrescriberTallySummaryId', 'OrgunitId', 'PositionId', 'TerritoryId', 'BrandId', 'Moye', 'TaggedDrs', 'LmRxbers', 'CmRxbers', 'Gain', 'Loss', 'TwoMonthRxber', 'Nonrxber', 'CreatedAt', 'UpdatedAt', 'CmRcpa', 'CmVisit', ],
        self::TYPE_CAMELNAME     => ['prescriberTallySummaryId', 'orgunitId', 'positionId', 'territoryId', 'brandId', 'moye', 'taggedDrs', 'lmRxbers', 'cmRxbers', 'gain', 'loss', 'twoMonthRxber', 'nonrxber', 'createdAt', 'updatedAt', 'cmRcpa', 'cmVisit', ],
        self::TYPE_COLNAME       => [PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, PrescriberTallySummaryTableMap::COL_ORGUNIT_ID, PrescriberTallySummaryTableMap::COL_POSITION_ID, PrescriberTallySummaryTableMap::COL_TERRITORY_ID, PrescriberTallySummaryTableMap::COL_BRAND_ID, PrescriberTallySummaryTableMap::COL_MOYE, PrescriberTallySummaryTableMap::COL_TAGGED_DRS, PrescriberTallySummaryTableMap::COL_LM_RXBERS, PrescriberTallySummaryTableMap::COL_CM_RXBERS, PrescriberTallySummaryTableMap::COL_GAIN, PrescriberTallySummaryTableMap::COL_LOSS, PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER, PrescriberTallySummaryTableMap::COL_NONRXBER, PrescriberTallySummaryTableMap::COL_CREATED_AT, PrescriberTallySummaryTableMap::COL_UPDATED_AT, PrescriberTallySummaryTableMap::COL_CM_RCPA, PrescriberTallySummaryTableMap::COL_CM_VISIT, ],
        self::TYPE_FIELDNAME     => ['prescriber_tally_summary_id', 'orgunit_id', 'position_id', 'territory_id', 'brand_id', 'moye', 'tagged_drs', 'lm_rxbers', 'cm_rxbers', 'gain', 'loss', 'two_month_rxber', 'nonrxber', 'created_at', 'updated_at', 'cm_rcpa', 'cm_visit', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['PrescriberTallySummaryId' => 0, 'OrgunitId' => 1, 'PositionId' => 2, 'TerritoryId' => 3, 'BrandId' => 4, 'Moye' => 5, 'TaggedDrs' => 6, 'LmRxbers' => 7, 'CmRxbers' => 8, 'Gain' => 9, 'Loss' => 10, 'TwoMonthRxber' => 11, 'Nonrxber' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'CmRcpa' => 15, 'CmVisit' => 16, ],
        self::TYPE_CAMELNAME     => ['prescriberTallySummaryId' => 0, 'orgunitId' => 1, 'positionId' => 2, 'territoryId' => 3, 'brandId' => 4, 'moye' => 5, 'taggedDrs' => 6, 'lmRxbers' => 7, 'cmRxbers' => 8, 'gain' => 9, 'loss' => 10, 'twoMonthRxber' => 11, 'nonrxber' => 12, 'createdAt' => 13, 'updatedAt' => 14, 'cmRcpa' => 15, 'cmVisit' => 16, ],
        self::TYPE_COLNAME       => [PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID => 0, PrescriberTallySummaryTableMap::COL_ORGUNIT_ID => 1, PrescriberTallySummaryTableMap::COL_POSITION_ID => 2, PrescriberTallySummaryTableMap::COL_TERRITORY_ID => 3, PrescriberTallySummaryTableMap::COL_BRAND_ID => 4, PrescriberTallySummaryTableMap::COL_MOYE => 5, PrescriberTallySummaryTableMap::COL_TAGGED_DRS => 6, PrescriberTallySummaryTableMap::COL_LM_RXBERS => 7, PrescriberTallySummaryTableMap::COL_CM_RXBERS => 8, PrescriberTallySummaryTableMap::COL_GAIN => 9, PrescriberTallySummaryTableMap::COL_LOSS => 10, PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER => 11, PrescriberTallySummaryTableMap::COL_NONRXBER => 12, PrescriberTallySummaryTableMap::COL_CREATED_AT => 13, PrescriberTallySummaryTableMap::COL_UPDATED_AT => 14, PrescriberTallySummaryTableMap::COL_CM_RCPA => 15, PrescriberTallySummaryTableMap::COL_CM_VISIT => 16, ],
        self::TYPE_FIELDNAME     => ['prescriber_tally_summary_id' => 0, 'orgunit_id' => 1, 'position_id' => 2, 'territory_id' => 3, 'brand_id' => 4, 'moye' => 5, 'tagged_drs' => 6, 'lm_rxbers' => 7, 'cm_rxbers' => 8, 'gain' => 9, 'loss' => 10, 'two_month_rxber' => 11, 'nonrxber' => 12, 'created_at' => 13, 'updated_at' => 14, 'cm_rcpa' => 15, 'cm_visit' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PrescriberTallySummaryId' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'PrescriberTallySummary.PrescriberTallySummaryId' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'prescriberTallySummaryId' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'prescriberTallySummary.prescriberTallySummaryId' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'COL_PRESCRIBER_TALLY_SUMMARY_ID' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'prescriber_tally_summary_id' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'prescriber_tally_summary.prescriber_tally_summary_id' => 'PRESCRIBER_TALLY_SUMMARY_ID',
        'OrgunitId' => 'ORGUNIT_ID',
        'PrescriberTallySummary.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'prescriberTallySummary.orgunitId' => 'ORGUNIT_ID',
        'PrescriberTallySummaryTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'prescriber_tally_summary.orgunit_id' => 'ORGUNIT_ID',
        'PositionId' => 'POSITION_ID',
        'PrescriberTallySummary.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'prescriberTallySummary.positionId' => 'POSITION_ID',
        'PrescriberTallySummaryTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'prescriber_tally_summary.position_id' => 'POSITION_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'PrescriberTallySummary.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'prescriberTallySummary.territoryId' => 'TERRITORY_ID',
        'PrescriberTallySummaryTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'prescriber_tally_summary.territory_id' => 'TERRITORY_ID',
        'BrandId' => 'BRAND_ID',
        'PrescriberTallySummary.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'prescriberTallySummary.brandId' => 'BRAND_ID',
        'PrescriberTallySummaryTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'prescriber_tally_summary.brand_id' => 'BRAND_ID',
        'Moye' => 'MOYE',
        'PrescriberTallySummary.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'prescriberTallySummary.moye' => 'MOYE',
        'PrescriberTallySummaryTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'prescriber_tally_summary.moye' => 'MOYE',
        'TaggedDrs' => 'TAGGED_DRS',
        'PrescriberTallySummary.TaggedDrs' => 'TAGGED_DRS',
        'taggedDrs' => 'TAGGED_DRS',
        'prescriberTallySummary.taggedDrs' => 'TAGGED_DRS',
        'PrescriberTallySummaryTableMap::COL_TAGGED_DRS' => 'TAGGED_DRS',
        'COL_TAGGED_DRS' => 'TAGGED_DRS',
        'tagged_drs' => 'TAGGED_DRS',
        'prescriber_tally_summary.tagged_drs' => 'TAGGED_DRS',
        'LmRxbers' => 'LM_RXBERS',
        'PrescriberTallySummary.LmRxbers' => 'LM_RXBERS',
        'lmRxbers' => 'LM_RXBERS',
        'prescriberTallySummary.lmRxbers' => 'LM_RXBERS',
        'PrescriberTallySummaryTableMap::COL_LM_RXBERS' => 'LM_RXBERS',
        'COL_LM_RXBERS' => 'LM_RXBERS',
        'lm_rxbers' => 'LM_RXBERS',
        'prescriber_tally_summary.lm_rxbers' => 'LM_RXBERS',
        'CmRxbers' => 'CM_RXBERS',
        'PrescriberTallySummary.CmRxbers' => 'CM_RXBERS',
        'cmRxbers' => 'CM_RXBERS',
        'prescriberTallySummary.cmRxbers' => 'CM_RXBERS',
        'PrescriberTallySummaryTableMap::COL_CM_RXBERS' => 'CM_RXBERS',
        'COL_CM_RXBERS' => 'CM_RXBERS',
        'cm_rxbers' => 'CM_RXBERS',
        'prescriber_tally_summary.cm_rxbers' => 'CM_RXBERS',
        'Gain' => 'GAIN',
        'PrescriberTallySummary.Gain' => 'GAIN',
        'gain' => 'GAIN',
        'prescriberTallySummary.gain' => 'GAIN',
        'PrescriberTallySummaryTableMap::COL_GAIN' => 'GAIN',
        'COL_GAIN' => 'GAIN',
        'prescriber_tally_summary.gain' => 'GAIN',
        'Loss' => 'LOSS',
        'PrescriberTallySummary.Loss' => 'LOSS',
        'loss' => 'LOSS',
        'prescriberTallySummary.loss' => 'LOSS',
        'PrescriberTallySummaryTableMap::COL_LOSS' => 'LOSS',
        'COL_LOSS' => 'LOSS',
        'prescriber_tally_summary.loss' => 'LOSS',
        'TwoMonthRxber' => 'TWO_MONTH_RXBER',
        'PrescriberTallySummary.TwoMonthRxber' => 'TWO_MONTH_RXBER',
        'twoMonthRxber' => 'TWO_MONTH_RXBER',
        'prescriberTallySummary.twoMonthRxber' => 'TWO_MONTH_RXBER',
        'PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER' => 'TWO_MONTH_RXBER',
        'COL_TWO_MONTH_RXBER' => 'TWO_MONTH_RXBER',
        'two_month_rxber' => 'TWO_MONTH_RXBER',
        'prescriber_tally_summary.two_month_rxber' => 'TWO_MONTH_RXBER',
        'Nonrxber' => 'NONRXBER',
        'PrescriberTallySummary.Nonrxber' => 'NONRXBER',
        'nonrxber' => 'NONRXBER',
        'prescriberTallySummary.nonrxber' => 'NONRXBER',
        'PrescriberTallySummaryTableMap::COL_NONRXBER' => 'NONRXBER',
        'COL_NONRXBER' => 'NONRXBER',
        'prescriber_tally_summary.nonrxber' => 'NONRXBER',
        'CreatedAt' => 'CREATED_AT',
        'PrescriberTallySummary.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'prescriberTallySummary.createdAt' => 'CREATED_AT',
        'PrescriberTallySummaryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'prescriber_tally_summary.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'PrescriberTallySummary.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'prescriberTallySummary.updatedAt' => 'UPDATED_AT',
        'PrescriberTallySummaryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'prescriber_tally_summary.updated_at' => 'UPDATED_AT',
        'CmRcpa' => 'CM_RCPA',
        'PrescriberTallySummary.CmRcpa' => 'CM_RCPA',
        'cmRcpa' => 'CM_RCPA',
        'prescriberTallySummary.cmRcpa' => 'CM_RCPA',
        'PrescriberTallySummaryTableMap::COL_CM_RCPA' => 'CM_RCPA',
        'COL_CM_RCPA' => 'CM_RCPA',
        'cm_rcpa' => 'CM_RCPA',
        'prescriber_tally_summary.cm_rcpa' => 'CM_RCPA',
        'CmVisit' => 'CM_VISIT',
        'PrescriberTallySummary.CmVisit' => 'CM_VISIT',
        'cmVisit' => 'CM_VISIT',
        'prescriberTallySummary.cmVisit' => 'CM_VISIT',
        'PrescriberTallySummaryTableMap::COL_CM_VISIT' => 'CM_VISIT',
        'COL_CM_VISIT' => 'CM_VISIT',
        'cm_visit' => 'CM_VISIT',
        'prescriber_tally_summary.cm_visit' => 'CM_VISIT',
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
        $this->setName('prescriber_tally_summary');
        $this->setPhpName('PrescriberTallySummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\PrescriberTallySummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('prescriber_tally_summary_prescriber_tally_summary_id_seq');
        // columns
        $this->addPrimaryKey('prescriber_tally_summary_id', 'PrescriberTallySummaryId', 'INTEGER', true, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', true, null, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', true, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', true, null, null);
        $this->addColumn('tagged_drs', 'TaggedDrs', 'INTEGER', false, null, null);
        $this->addColumn('lm_rxbers', 'LmRxbers', 'INTEGER', false, null, null);
        $this->addColumn('cm_rxbers', 'CmRxbers', 'INTEGER', false, null, null);
        $this->addColumn('gain', 'Gain', 'INTEGER', false, null, null);
        $this->addColumn('loss', 'Loss', 'INTEGER', false, null, null);
        $this->addColumn('two_month_rxber', 'TwoMonthRxber', 'INTEGER', false, null, null);
        $this->addColumn('nonrxber', 'Nonrxber', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('cm_rcpa', 'CmRcpa', 'VARCHAR', false, 10, null);
        $this->addColumn('cm_visit', 'CmVisit', 'VARCHAR', false, 10, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PrescriberTallySummaryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PrescriberTallySummaryTableMap::CLASS_DEFAULT : PrescriberTallySummaryTableMap::OM_CLASS;
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
     * @return array (PrescriberTallySummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PrescriberTallySummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PrescriberTallySummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PrescriberTallySummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PrescriberTallySummaryTableMap::OM_CLASS;
            /** @var PrescriberTallySummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PrescriberTallySummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = PrescriberTallySummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PrescriberTallySummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PrescriberTallySummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PrescriberTallySummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_MOYE);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_TAGGED_DRS);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_LM_RXBERS);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_CM_RXBERS);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_GAIN);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_LOSS);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_NONRXBER);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_CM_RCPA);
            $criteria->addSelectColumn(PrescriberTallySummaryTableMap::COL_CM_VISIT);
        } else {
            $criteria->addSelectColumn($alias . '.prescriber_tally_summary_id');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.tagged_drs');
            $criteria->addSelectColumn($alias . '.lm_rxbers');
            $criteria->addSelectColumn($alias . '.cm_rxbers');
            $criteria->addSelectColumn($alias . '.gain');
            $criteria->addSelectColumn($alias . '.loss');
            $criteria->addSelectColumn($alias . '.two_month_rxber');
            $criteria->addSelectColumn($alias . '.nonrxber');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.cm_rcpa');
            $criteria->addSelectColumn($alias . '.cm_visit');
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
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_MOYE);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_TAGGED_DRS);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_LM_RXBERS);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_CM_RXBERS);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_GAIN);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_LOSS);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_TWO_MONTH_RXBER);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_NONRXBER);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_CM_RCPA);
            $criteria->removeSelectColumn(PrescriberTallySummaryTableMap::COL_CM_VISIT);
        } else {
            $criteria->removeSelectColumn($alias . '.prescriber_tally_summary_id');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.tagged_drs');
            $criteria->removeSelectColumn($alias . '.lm_rxbers');
            $criteria->removeSelectColumn($alias . '.cm_rxbers');
            $criteria->removeSelectColumn($alias . '.gain');
            $criteria->removeSelectColumn($alias . '.loss');
            $criteria->removeSelectColumn($alias . '.two_month_rxber');
            $criteria->removeSelectColumn($alias . '.nonrxber');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.cm_rcpa');
            $criteria->removeSelectColumn($alias . '.cm_visit');
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
        return Propel::getServiceContainer()->getDatabaseMap(PrescriberTallySummaryTableMap::DATABASE_NAME)->getTable(PrescriberTallySummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PrescriberTallySummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PrescriberTallySummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\PrescriberTallySummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PrescriberTallySummaryTableMap::DATABASE_NAME);
            $criteria->add(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID, (array) $values, Criteria::IN);
        }

        $query = PrescriberTallySummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PrescriberTallySummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PrescriberTallySummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the prescriber_tally_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PrescriberTallySummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PrescriberTallySummary or Criteria object.
     *
     * @param mixed $criteria Criteria or PrescriberTallySummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrescriberTallySummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PrescriberTallySummary object
        }

        if ($criteria->containsKey(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID) && $criteria->keyContainsValue(PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PrescriberTallySummaryTableMap::COL_PRESCRIBER_TALLY_SUMMARY_ID.')');
        }


        // Set the correct dbName
        $query = PrescriberTallySummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

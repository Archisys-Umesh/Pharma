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
use entities\RcpaSummary;
use entities\RcpaSummaryQuery;


/**
 * This class defines the structure of the 'rcpa_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RcpaSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RcpaSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'rcpa_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'RcpaSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\RcpaSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.RcpaSummary';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'rcpa_summary.uniqueid';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'rcpa_summary.outlet_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'rcpa_summary.outlet_org_id';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'rcpa_summary.visit_fq';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'rcpa_summary.brand_id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'rcpa_summary.outlet_name';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'rcpa_summary.outlet_classification';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'rcpa_summary.territory_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'rcpa_summary.orgunitid';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'rcpa_summary.tags';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'rcpa_summary.rcpa_moye';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'rcpa_summary.brand_name';

    /**
     * the column name for the rcpa_value field
     */
    public const COL_RCPA_VALUE = 'rcpa_summary.rcpa_value';

    /**
     * the column name for the potential field
     */
    public const COL_POTENTIAL = 'rcpa_summary.potential';

    /**
     * the column name for the own field
     */
    public const COL_OWN = 'rcpa_summary.own';

    /**
     * the column name for the competition field
     */
    public const COL_COMPETITION = 'rcpa_summary.competition';

    /**
     * the column name for the lastcreated field
     */
    public const COL_LASTCREATED = 'rcpa_summary.lastcreated';

    /**
     * the column name for the lastupdated field
     */
    public const COL_LASTUPDATED = 'rcpa_summary.lastupdated';

    /**
     * the column name for the min_value field
     */
    public const COL_MIN_VALUE = 'rcpa_summary.min_value';

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
        self::TYPE_PHPNAME       => ['Uniqueid', 'OutletId', 'OutletOrgId', 'VisitFq', 'BrandId', 'OutletName', 'OutletClassification', 'TerritoryId', 'Orgunitid', 'Tags', 'RcpaMoye', 'BrandName', 'RcpaValue', 'Potential', 'Own', 'Competition', 'Lastcreated', 'Lastupdated', 'MinValue', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'outletId', 'outletOrgId', 'visitFq', 'brandId', 'outletName', 'outletClassification', 'territoryId', 'orgunitid', 'tags', 'rcpaMoye', 'brandName', 'rcpaValue', 'potential', 'own', 'competition', 'lastcreated', 'lastupdated', 'minValue', ],
        self::TYPE_COLNAME       => [RcpaSummaryTableMap::COL_UNIQUEID, RcpaSummaryTableMap::COL_OUTLET_ID, RcpaSummaryTableMap::COL_OUTLET_ORG_ID, RcpaSummaryTableMap::COL_VISIT_FQ, RcpaSummaryTableMap::COL_BRAND_ID, RcpaSummaryTableMap::COL_OUTLET_NAME, RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, RcpaSummaryTableMap::COL_TERRITORY_ID, RcpaSummaryTableMap::COL_ORGUNITID, RcpaSummaryTableMap::COL_TAGS, RcpaSummaryTableMap::COL_RCPA_MOYE, RcpaSummaryTableMap::COL_BRAND_NAME, RcpaSummaryTableMap::COL_RCPA_VALUE, RcpaSummaryTableMap::COL_POTENTIAL, RcpaSummaryTableMap::COL_OWN, RcpaSummaryTableMap::COL_COMPETITION, RcpaSummaryTableMap::COL_LASTCREATED, RcpaSummaryTableMap::COL_LASTUPDATED, RcpaSummaryTableMap::COL_MIN_VALUE, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'outlet_id', 'outlet_org_id', 'visit_fq', 'brand_id', 'outlet_name', 'outlet_classification', 'territory_id', 'orgunitid', 'tags', 'rcpa_moye', 'brand_name', 'rcpa_value', 'potential', 'own', 'competition', 'lastcreated', 'lastupdated', 'min_value', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
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
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'OutletId' => 1, 'OutletOrgId' => 2, 'VisitFq' => 3, 'BrandId' => 4, 'OutletName' => 5, 'OutletClassification' => 6, 'TerritoryId' => 7, 'Orgunitid' => 8, 'Tags' => 9, 'RcpaMoye' => 10, 'BrandName' => 11, 'RcpaValue' => 12, 'Potential' => 13, 'Own' => 14, 'Competition' => 15, 'Lastcreated' => 16, 'Lastupdated' => 17, 'MinValue' => 18, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'outletId' => 1, 'outletOrgId' => 2, 'visitFq' => 3, 'brandId' => 4, 'outletName' => 5, 'outletClassification' => 6, 'territoryId' => 7, 'orgunitid' => 8, 'tags' => 9, 'rcpaMoye' => 10, 'brandName' => 11, 'rcpaValue' => 12, 'potential' => 13, 'own' => 14, 'competition' => 15, 'lastcreated' => 16, 'lastupdated' => 17, 'minValue' => 18, ],
        self::TYPE_COLNAME       => [RcpaSummaryTableMap::COL_UNIQUEID => 0, RcpaSummaryTableMap::COL_OUTLET_ID => 1, RcpaSummaryTableMap::COL_OUTLET_ORG_ID => 2, RcpaSummaryTableMap::COL_VISIT_FQ => 3, RcpaSummaryTableMap::COL_BRAND_ID => 4, RcpaSummaryTableMap::COL_OUTLET_NAME => 5, RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION => 6, RcpaSummaryTableMap::COL_TERRITORY_ID => 7, RcpaSummaryTableMap::COL_ORGUNITID => 8, RcpaSummaryTableMap::COL_TAGS => 9, RcpaSummaryTableMap::COL_RCPA_MOYE => 10, RcpaSummaryTableMap::COL_BRAND_NAME => 11, RcpaSummaryTableMap::COL_RCPA_VALUE => 12, RcpaSummaryTableMap::COL_POTENTIAL => 13, RcpaSummaryTableMap::COL_OWN => 14, RcpaSummaryTableMap::COL_COMPETITION => 15, RcpaSummaryTableMap::COL_LASTCREATED => 16, RcpaSummaryTableMap::COL_LASTUPDATED => 17, RcpaSummaryTableMap::COL_MIN_VALUE => 18, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'outlet_id' => 1, 'outlet_org_id' => 2, 'visit_fq' => 3, 'brand_id' => 4, 'outlet_name' => 5, 'outlet_classification' => 6, 'territory_id' => 7, 'orgunitid' => 8, 'tags' => 9, 'rcpa_moye' => 10, 'brand_name' => 11, 'rcpa_value' => 12, 'potential' => 13, 'own' => 14, 'competition' => 15, 'lastcreated' => 16, 'lastupdated' => 17, 'min_value' => 18, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'RcpaSummary.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'rcpaSummary.uniqueid' => 'UNIQUEID',
        'RcpaSummaryTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'rcpa_summary.uniqueid' => 'UNIQUEID',
        'OutletId' => 'OUTLET_ID',
        'RcpaSummary.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'rcpaSummary.outletId' => 'OUTLET_ID',
        'RcpaSummaryTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'rcpa_summary.outlet_id' => 'OUTLET_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'RcpaSummary.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'rcpaSummary.outletOrgId' => 'OUTLET_ORG_ID',
        'RcpaSummaryTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'rcpa_summary.outlet_org_id' => 'OUTLET_ORG_ID',
        'VisitFq' => 'VISIT_FQ',
        'RcpaSummary.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'rcpaSummary.visitFq' => 'VISIT_FQ',
        'RcpaSummaryTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'rcpa_summary.visit_fq' => 'VISIT_FQ',
        'BrandId' => 'BRAND_ID',
        'RcpaSummary.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'rcpaSummary.brandId' => 'BRAND_ID',
        'RcpaSummaryTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'rcpa_summary.brand_id' => 'BRAND_ID',
        'OutletName' => 'OUTLET_NAME',
        'RcpaSummary.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'rcpaSummary.outletName' => 'OUTLET_NAME',
        'RcpaSummaryTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'rcpa_summary.outlet_name' => 'OUTLET_NAME',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'RcpaSummary.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'rcpaSummary.outletClassification' => 'OUTLET_CLASSIFICATION',
        'RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'rcpa_summary.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'TerritoryId' => 'TERRITORY_ID',
        'RcpaSummary.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'rcpaSummary.territoryId' => 'TERRITORY_ID',
        'RcpaSummaryTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'rcpa_summary.territory_id' => 'TERRITORY_ID',
        'Orgunitid' => 'ORGUNITID',
        'RcpaSummary.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'rcpaSummary.orgunitid' => 'ORGUNITID',
        'RcpaSummaryTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'rcpa_summary.orgunitid' => 'ORGUNITID',
        'Tags' => 'TAGS',
        'RcpaSummary.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'rcpaSummary.tags' => 'TAGS',
        'RcpaSummaryTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'rcpa_summary.tags' => 'TAGS',
        'RcpaMoye' => 'RCPA_MOYE',
        'RcpaSummary.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'rcpaSummary.rcpaMoye' => 'RCPA_MOYE',
        'RcpaSummaryTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'rcpa_summary.rcpa_moye' => 'RCPA_MOYE',
        'BrandName' => 'BRAND_NAME',
        'RcpaSummary.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'rcpaSummary.brandName' => 'BRAND_NAME',
        'RcpaSummaryTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'rcpa_summary.brand_name' => 'BRAND_NAME',
        'RcpaValue' => 'RCPA_VALUE',
        'RcpaSummary.RcpaValue' => 'RCPA_VALUE',
        'rcpaValue' => 'RCPA_VALUE',
        'rcpaSummary.rcpaValue' => 'RCPA_VALUE',
        'RcpaSummaryTableMap::COL_RCPA_VALUE' => 'RCPA_VALUE',
        'COL_RCPA_VALUE' => 'RCPA_VALUE',
        'rcpa_value' => 'RCPA_VALUE',
        'rcpa_summary.rcpa_value' => 'RCPA_VALUE',
        'Potential' => 'POTENTIAL',
        'RcpaSummary.Potential' => 'POTENTIAL',
        'potential' => 'POTENTIAL',
        'rcpaSummary.potential' => 'POTENTIAL',
        'RcpaSummaryTableMap::COL_POTENTIAL' => 'POTENTIAL',
        'COL_POTENTIAL' => 'POTENTIAL',
        'rcpa_summary.potential' => 'POTENTIAL',
        'Own' => 'OWN',
        'RcpaSummary.Own' => 'OWN',
        'own' => 'OWN',
        'rcpaSummary.own' => 'OWN',
        'RcpaSummaryTableMap::COL_OWN' => 'OWN',
        'COL_OWN' => 'OWN',
        'rcpa_summary.own' => 'OWN',
        'Competition' => 'COMPETITION',
        'RcpaSummary.Competition' => 'COMPETITION',
        'competition' => 'COMPETITION',
        'rcpaSummary.competition' => 'COMPETITION',
        'RcpaSummaryTableMap::COL_COMPETITION' => 'COMPETITION',
        'COL_COMPETITION' => 'COMPETITION',
        'rcpa_summary.competition' => 'COMPETITION',
        'Lastcreated' => 'LASTCREATED',
        'RcpaSummary.Lastcreated' => 'LASTCREATED',
        'lastcreated' => 'LASTCREATED',
        'rcpaSummary.lastcreated' => 'LASTCREATED',
        'RcpaSummaryTableMap::COL_LASTCREATED' => 'LASTCREATED',
        'COL_LASTCREATED' => 'LASTCREATED',
        'rcpa_summary.lastcreated' => 'LASTCREATED',
        'Lastupdated' => 'LASTUPDATED',
        'RcpaSummary.Lastupdated' => 'LASTUPDATED',
        'lastupdated' => 'LASTUPDATED',
        'rcpaSummary.lastupdated' => 'LASTUPDATED',
        'RcpaSummaryTableMap::COL_LASTUPDATED' => 'LASTUPDATED',
        'COL_LASTUPDATED' => 'LASTUPDATED',
        'rcpa_summary.lastupdated' => 'LASTUPDATED',
        'MinValue' => 'MIN_VALUE',
        'RcpaSummary.MinValue' => 'MIN_VALUE',
        'minValue' => 'MIN_VALUE',
        'rcpaSummary.minValue' => 'MIN_VALUE',
        'RcpaSummaryTableMap::COL_MIN_VALUE' => 'MIN_VALUE',
        'COL_MIN_VALUE' => 'MIN_VALUE',
        'min_value' => 'MIN_VALUE',
        'rcpa_summary.min_value' => 'MIN_VALUE',
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
        $this->setName('rcpa_summary');
        $this->setPhpName('RcpaSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\RcpaSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniqueid', 'Uniqueid', 'VARCHAR', true, 255, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'INTEGER', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 255, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, 255, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, 255, null);
        $this->addColumn('rcpa_value', 'RcpaValue', 'DECIMAL', false, null, null);
        $this->addColumn('potential', 'Potential', 'DECIMAL', false, null, null);
        $this->addColumn('own', 'Own', 'DECIMAL', false, null, null);
        $this->addColumn('competition', 'Competition', 'DECIMAL', false, null, null);
        $this->addColumn('lastcreated', 'Lastcreated', 'TIMESTAMP', false, null, null);
        $this->addColumn('lastupdated', 'Lastupdated', 'TIMESTAMP', false, null, null);
        $this->addColumn('min_value', 'MinValue', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RcpaSummaryTableMap::CLASS_DEFAULT : RcpaSummaryTableMap::OM_CLASS;
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
     * @return array (RcpaSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RcpaSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RcpaSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RcpaSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RcpaSummaryTableMap::OM_CLASS;
            /** @var RcpaSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RcpaSummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = RcpaSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RcpaSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RcpaSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RcpaSummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_TAGS);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_RCPA_VALUE);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_POTENTIAL);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_OWN);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_COMPETITION);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_LASTCREATED);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_LASTUPDATED);
            $criteria->addSelectColumn(RcpaSummaryTableMap::COL_MIN_VALUE);
        } else {
            $criteria->addSelectColumn($alias . '.uniqueid');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.rcpa_moye');
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.rcpa_value');
            $criteria->addSelectColumn($alias . '.potential');
            $criteria->addSelectColumn($alias . '.own');
            $criteria->addSelectColumn($alias . '.competition');
            $criteria->addSelectColumn($alias . '.lastcreated');
            $criteria->addSelectColumn($alias . '.lastupdated');
            $criteria->addSelectColumn($alias . '.min_value');
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
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_TAGS);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_RCPA_VALUE);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_POTENTIAL);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_OWN);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_COMPETITION);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_LASTCREATED);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_LASTUPDATED);
            $criteria->removeSelectColumn(RcpaSummaryTableMap::COL_MIN_VALUE);
        } else {
            $criteria->removeSelectColumn($alias . '.uniqueid');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.rcpa_moye');
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.rcpa_value');
            $criteria->removeSelectColumn($alias . '.potential');
            $criteria->removeSelectColumn($alias . '.own');
            $criteria->removeSelectColumn($alias . '.competition');
            $criteria->removeSelectColumn($alias . '.lastcreated');
            $criteria->removeSelectColumn($alias . '.lastupdated');
            $criteria->removeSelectColumn($alias . '.min_value');
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
        return Propel::getServiceContainer()->getDatabaseMap(RcpaSummaryTableMap::DATABASE_NAME)->getTable(RcpaSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a RcpaSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or RcpaSummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\RcpaSummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RcpaSummaryTableMap::DATABASE_NAME);
            $criteria->add(RcpaSummaryTableMap::COL_UNIQUEID, (array) $values, Criteria::IN);
        }

        $query = RcpaSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RcpaSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RcpaSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rcpa_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RcpaSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RcpaSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or RcpaSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RcpaSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RcpaSummary object
        }


        // Set the correct dbName
        $query = RcpaSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

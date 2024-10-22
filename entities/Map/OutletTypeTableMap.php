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
use entities\OutletType;
use entities\OutletTypeQuery;


/**
 * This class defines the structure of the 'outlet_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletType';

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
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'outlet_type.outlettype_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_type.company_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'outlet_type.outlettype_name';

    /**
     * the column name for the isoutletprimary field
     */
    public const COL_ISOUTLETPRIMARY = 'outlet_type.isoutletprimary';

    /**
     * the column name for the isoutletendcustomer field
     */
    public const COL_ISOUTLETENDCUSTOMER = 'outlet_type.isoutletendcustomer';

    /**
     * the column name for the isenabled field
     */
    public const COL_ISENABLED = 'outlet_type.isenabled';

    /**
     * the column name for the outletparent field
     */
    public const COL_OUTLETPARENT = 'outlet_type.outletparent';

    /**
     * the column name for the image_media_id field
     */
    public const COL_IMAGE_MEDIA_ID = 'outlet_type.image_media_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_type.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_type.updated_at';

    /**
     * the column name for the onboard_enabled field
     */
    public const COL_ONBOARD_ENABLED = 'outlet_type.onboard_enabled';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'outlet_type.org_unit_id';

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
        self::TYPE_PHPNAME       => ['OutlettypeId', 'CompanyId', 'OutlettypeName', 'Isoutletprimary', 'Isoutletendcustomer', 'Isenabled', 'Outletparent', 'ImageMediaId', 'CreatedAt', 'UpdatedAt', 'OnboardEnabled', 'OrgUnitId', ],
        self::TYPE_CAMELNAME     => ['outlettypeId', 'companyId', 'outlettypeName', 'isoutletprimary', 'isoutletendcustomer', 'isenabled', 'outletparent', 'imageMediaId', 'createdAt', 'updatedAt', 'onboardEnabled', 'orgUnitId', ],
        self::TYPE_COLNAME       => [OutletTypeTableMap::COL_OUTLETTYPE_ID, OutletTypeTableMap::COL_COMPANY_ID, OutletTypeTableMap::COL_OUTLETTYPE_NAME, OutletTypeTableMap::COL_ISOUTLETPRIMARY, OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER, OutletTypeTableMap::COL_ISENABLED, OutletTypeTableMap::COL_OUTLETPARENT, OutletTypeTableMap::COL_IMAGE_MEDIA_ID, OutletTypeTableMap::COL_CREATED_AT, OutletTypeTableMap::COL_UPDATED_AT, OutletTypeTableMap::COL_ONBOARD_ENABLED, OutletTypeTableMap::COL_ORG_UNIT_ID, ],
        self::TYPE_FIELDNAME     => ['outlettype_id', 'company_id', 'outlettype_name', 'isoutletprimary', 'isoutletendcustomer', 'isenabled', 'outletparent', 'image_media_id', 'created_at', 'updated_at', 'onboard_enabled', 'org_unit_id', ],
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
        self::TYPE_PHPNAME       => ['OutlettypeId' => 0, 'CompanyId' => 1, 'OutlettypeName' => 2, 'Isoutletprimary' => 3, 'Isoutletendcustomer' => 4, 'Isenabled' => 5, 'Outletparent' => 6, 'ImageMediaId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'OnboardEnabled' => 10, 'OrgUnitId' => 11, ],
        self::TYPE_CAMELNAME     => ['outlettypeId' => 0, 'companyId' => 1, 'outlettypeName' => 2, 'isoutletprimary' => 3, 'isoutletendcustomer' => 4, 'isenabled' => 5, 'outletparent' => 6, 'imageMediaId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'onboardEnabled' => 10, 'orgUnitId' => 11, ],
        self::TYPE_COLNAME       => [OutletTypeTableMap::COL_OUTLETTYPE_ID => 0, OutletTypeTableMap::COL_COMPANY_ID => 1, OutletTypeTableMap::COL_OUTLETTYPE_NAME => 2, OutletTypeTableMap::COL_ISOUTLETPRIMARY => 3, OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER => 4, OutletTypeTableMap::COL_ISENABLED => 5, OutletTypeTableMap::COL_OUTLETPARENT => 6, OutletTypeTableMap::COL_IMAGE_MEDIA_ID => 7, OutletTypeTableMap::COL_CREATED_AT => 8, OutletTypeTableMap::COL_UPDATED_AT => 9, OutletTypeTableMap::COL_ONBOARD_ENABLED => 10, OutletTypeTableMap::COL_ORG_UNIT_ID => 11, ],
        self::TYPE_FIELDNAME     => ['outlettype_id' => 0, 'company_id' => 1, 'outlettype_name' => 2, 'isoutletprimary' => 3, 'isoutletendcustomer' => 4, 'isenabled' => 5, 'outletparent' => 6, 'image_media_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'onboard_enabled' => 10, 'org_unit_id' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'OutletType.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'outletType.outlettypeId' => 'OUTLETTYPE_ID',
        'OutletTypeTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'outlet_type.outlettype_id' => 'OUTLETTYPE_ID',
        'CompanyId' => 'COMPANY_ID',
        'OutletType.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletType.companyId' => 'COMPANY_ID',
        'OutletTypeTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_type.company_id' => 'COMPANY_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'OutletType.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'outletType.outlettypeName' => 'OUTLETTYPE_NAME',
        'OutletTypeTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'outlet_type.outlettype_name' => 'OUTLETTYPE_NAME',
        'Isoutletprimary' => 'ISOUTLETPRIMARY',
        'OutletType.Isoutletprimary' => 'ISOUTLETPRIMARY',
        'isoutletprimary' => 'ISOUTLETPRIMARY',
        'outletType.isoutletprimary' => 'ISOUTLETPRIMARY',
        'OutletTypeTableMap::COL_ISOUTLETPRIMARY' => 'ISOUTLETPRIMARY',
        'COL_ISOUTLETPRIMARY' => 'ISOUTLETPRIMARY',
        'outlet_type.isoutletprimary' => 'ISOUTLETPRIMARY',
        'Isoutletendcustomer' => 'ISOUTLETENDCUSTOMER',
        'OutletType.Isoutletendcustomer' => 'ISOUTLETENDCUSTOMER',
        'isoutletendcustomer' => 'ISOUTLETENDCUSTOMER',
        'outletType.isoutletendcustomer' => 'ISOUTLETENDCUSTOMER',
        'OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER' => 'ISOUTLETENDCUSTOMER',
        'COL_ISOUTLETENDCUSTOMER' => 'ISOUTLETENDCUSTOMER',
        'outlet_type.isoutletendcustomer' => 'ISOUTLETENDCUSTOMER',
        'Isenabled' => 'ISENABLED',
        'OutletType.Isenabled' => 'ISENABLED',
        'isenabled' => 'ISENABLED',
        'outletType.isenabled' => 'ISENABLED',
        'OutletTypeTableMap::COL_ISENABLED' => 'ISENABLED',
        'COL_ISENABLED' => 'ISENABLED',
        'outlet_type.isenabled' => 'ISENABLED',
        'Outletparent' => 'OUTLETPARENT',
        'OutletType.Outletparent' => 'OUTLETPARENT',
        'outletparent' => 'OUTLETPARENT',
        'outletType.outletparent' => 'OUTLETPARENT',
        'OutletTypeTableMap::COL_OUTLETPARENT' => 'OUTLETPARENT',
        'COL_OUTLETPARENT' => 'OUTLETPARENT',
        'outlet_type.outletparent' => 'OUTLETPARENT',
        'ImageMediaId' => 'IMAGE_MEDIA_ID',
        'OutletType.ImageMediaId' => 'IMAGE_MEDIA_ID',
        'imageMediaId' => 'IMAGE_MEDIA_ID',
        'outletType.imageMediaId' => 'IMAGE_MEDIA_ID',
        'OutletTypeTableMap::COL_IMAGE_MEDIA_ID' => 'IMAGE_MEDIA_ID',
        'COL_IMAGE_MEDIA_ID' => 'IMAGE_MEDIA_ID',
        'image_media_id' => 'IMAGE_MEDIA_ID',
        'outlet_type.image_media_id' => 'IMAGE_MEDIA_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletType.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletType.createdAt' => 'CREATED_AT',
        'OutletTypeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_type.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletType.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletType.updatedAt' => 'UPDATED_AT',
        'OutletTypeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_type.updated_at' => 'UPDATED_AT',
        'OnboardEnabled' => 'ONBOARD_ENABLED',
        'OutletType.OnboardEnabled' => 'ONBOARD_ENABLED',
        'onboardEnabled' => 'ONBOARD_ENABLED',
        'outletType.onboardEnabled' => 'ONBOARD_ENABLED',
        'OutletTypeTableMap::COL_ONBOARD_ENABLED' => 'ONBOARD_ENABLED',
        'COL_ONBOARD_ENABLED' => 'ONBOARD_ENABLED',
        'onboard_enabled' => 'ONBOARD_ENABLED',
        'outlet_type.onboard_enabled' => 'ONBOARD_ENABLED',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OutletType.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'outletType.orgUnitId' => 'ORG_UNIT_ID',
        'OutletTypeTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'outlet_type.org_unit_id' => 'ORG_UNIT_ID',
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
        $this->setName('outlet_type');
        $this->setPhpName('OutletType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletType');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_type_outlettype_id_seq');
        // columns
        $this->addPrimaryKey('outlettype_id', 'OutlettypeId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', true, 50, '');
        $this->addColumn('isoutletprimary', 'Isoutletprimary', 'INTEGER', true, null, 0);
        $this->addColumn('isoutletendcustomer', 'Isoutletendcustomer', 'INTEGER', true, null, 0);
        $this->addColumn('isenabled', 'Isenabled', 'INTEGER', true, null, 0);
        $this->addColumn('outletparent', 'Outletparent', 'INTEGER', false, null, null);
        $this->addForeignKey('image_media_id', 'ImageMediaId', 'INTEGER', 'media_files', 'media_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('onboard_enabled', 'OnboardEnabled', 'BOOLEAN', false, 1, false);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'VARCHAR', true, null, null);
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
), null, null, null, false);
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':image_media_id',
    1 => ':media_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, 'BrandCampiagns', false);
        $this->addRelation('Offers', '\\entities\\Offers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'Offerss', false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'OnBoardRequests', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_sub_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OnBoardRequiredFields', '\\entities\\OnBoardRequiredFields', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'OnBoardRequiredFieldss', false);
        $this->addRelation('OutletOutcomes', '\\entities\\OutletOutcomes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'OutletOutcomess', false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, 'Outletss', false);
        $this->addRelation('Outlettypemodules', '\\entities\\Outlettypemodules', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlettypeid',
    1 => ':outlettype_id',
  ),
), null, null, 'Outlettypemoduless', false);
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, 'SgpiMasters', false);
        $this->addRelation('Survey', '\\entities\\Survey', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, 'Surveys', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletTypeTableMap::CLASS_DEFAULT : OutletTypeTableMap::OM_CLASS;
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
     * @return array (OutletType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletTypeTableMap::OM_CLASS;
            /** @var OutletType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletTypeTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_ISOUTLETPRIMARY);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_ISENABLED);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_OUTLETPARENT);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_IMAGE_MEDIA_ID);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_ONBOARD_ENABLED);
            $criteria->addSelectColumn(OutletTypeTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.isoutletprimary');
            $criteria->addSelectColumn($alias . '.isoutletendcustomer');
            $criteria->addSelectColumn($alias . '.isenabled');
            $criteria->addSelectColumn($alias . '.outletparent');
            $criteria->addSelectColumn($alias . '.image_media_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.onboard_enabled');
            $criteria->addSelectColumn($alias . '.org_unit_id');
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
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_ISOUTLETPRIMARY);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_ISOUTLETENDCUSTOMER);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_ISENABLED);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_OUTLETPARENT);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_IMAGE_MEDIA_ID);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_ONBOARD_ENABLED);
            $criteria->removeSelectColumn(OutletTypeTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.isoutletprimary');
            $criteria->removeSelectColumn($alias . '.isoutletendcustomer');
            $criteria->removeSelectColumn($alias . '.isenabled');
            $criteria->removeSelectColumn($alias . '.outletparent');
            $criteria->removeSelectColumn($alias . '.image_media_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.onboard_enabled');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletTypeTableMap::DATABASE_NAME)->getTable(OutletTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletTypeTableMap::DATABASE_NAME);
            $criteria->add(OutletTypeTableMap::COL_OUTLETTYPE_ID, (array) $values, Criteria::IN);
        }

        $query = OutletTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletType or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletType object
        }

        if ($criteria->containsKey(OutletTypeTableMap::COL_OUTLETTYPE_ID) && $criteria->keyContainsValue(OutletTypeTableMap::COL_OUTLETTYPE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletTypeTableMap::COL_OUTLETTYPE_ID.')');
        }


        // Set the correct dbName
        $query = OutletTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

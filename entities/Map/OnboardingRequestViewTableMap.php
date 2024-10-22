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
use entities\OnboardingRequestView;
use entities\OnboardingRequestViewQuery;


/**
 * This class defines the structure of the 'onboarding_request_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnboardingRequestViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnboardingRequestViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'onboarding_request_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnboardingRequestView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnboardingRequestView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnboardingRequestView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the on_board_request_id field
     */
    public const COL_ON_BOARD_REQUEST_ID = 'onboarding_request_view.on_board_request_id';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'onboarding_request_view.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'onboarding_request_view.last_name';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'onboarding_request_view.outlet_name';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'onboarding_request_view.email';

    /**
     * the column name for the mobile field
     */
    public const COL_MOBILE = 'onboarding_request_view.mobile';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'onboarding_request_view.outlet_type_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'onboarding_request_view.outlettype_name';

    /**
     * the column name for the territory field
     */
    public const COL_TERRITORY = 'onboarding_request_view.territory';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'onboarding_request_view.territory_name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'onboarding_request_view.created_at';

    /**
     * the column name for the created_by field
     */
    public const COL_CREATED_BY = 'onboarding_request_view.created_by';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'onboarding_request_view.orgunitid';

    /**
     * the column name for the unit_name field
     */
    public const COL_UNIT_NAME = 'onboarding_request_view.unit_name';

    /**
     * the column name for the approved_by field
     */
    public const COL_APPROVED_BY = 'onboarding_request_view.approved_by';

    /**
     * the column name for the approved_at field
     */
    public const COL_APPROVED_AT = 'onboarding_request_view.approved_at';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'onboarding_request_view.status';

    /**
     * the column name for the operations field
     */
    public const COL_OPERATIONS = 'onboarding_request_view.operations';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestId', 'FirstName', 'LastName', 'OutletName', 'Email', 'Mobile', 'OutletTypeId', 'OutlettypeName', 'Territory', 'TerritoryName', 'CreatedAt', 'CreatedBy', 'Orgunitid', 'UnitName', 'ApprovedBy', 'ApprovedAt', 'Status', 'Operations', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestId', 'firstName', 'lastName', 'outletName', 'email', 'mobile', 'outletTypeId', 'outlettypeName', 'territory', 'territoryName', 'createdAt', 'createdBy', 'orgunitid', 'unitName', 'approvedBy', 'approvedAt', 'status', 'operations', ],
        self::TYPE_COLNAME       => [OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, OnboardingRequestViewTableMap::COL_FIRST_NAME, OnboardingRequestViewTableMap::COL_LAST_NAME, OnboardingRequestViewTableMap::COL_OUTLET_NAME, OnboardingRequestViewTableMap::COL_EMAIL, OnboardingRequestViewTableMap::COL_MOBILE, OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID, OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME, OnboardingRequestViewTableMap::COL_TERRITORY, OnboardingRequestViewTableMap::COL_TERRITORY_NAME, OnboardingRequestViewTableMap::COL_CREATED_AT, OnboardingRequestViewTableMap::COL_CREATED_BY, OnboardingRequestViewTableMap::COL_ORGUNITID, OnboardingRequestViewTableMap::COL_UNIT_NAME, OnboardingRequestViewTableMap::COL_APPROVED_BY, OnboardingRequestViewTableMap::COL_APPROVED_AT, OnboardingRequestViewTableMap::COL_STATUS, OnboardingRequestViewTableMap::COL_OPERATIONS, ],
        self::TYPE_FIELDNAME     => ['on_board_request_id', 'first_name', 'last_name', 'outlet_name', 'email', 'mobile', 'outlet_type_id', 'outlettype_name', 'territory', 'territory_name', 'created_at', 'created_by', 'orgunitid', 'unit_name', 'approved_by', 'approved_at', 'status', 'operations', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
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
        self::TYPE_PHPNAME       => ['OnBoardRequestId' => 0, 'FirstName' => 1, 'LastName' => 2, 'OutletName' => 3, 'Email' => 4, 'Mobile' => 5, 'OutletTypeId' => 6, 'OutlettypeName' => 7, 'Territory' => 8, 'TerritoryName' => 9, 'CreatedAt' => 10, 'CreatedBy' => 11, 'Orgunitid' => 12, 'UnitName' => 13, 'ApprovedBy' => 14, 'ApprovedAt' => 15, 'Status' => 16, 'Operations' => 17, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestId' => 0, 'firstName' => 1, 'lastName' => 2, 'outletName' => 3, 'email' => 4, 'mobile' => 5, 'outletTypeId' => 6, 'outlettypeName' => 7, 'territory' => 8, 'territoryName' => 9, 'createdAt' => 10, 'createdBy' => 11, 'orgunitid' => 12, 'unitName' => 13, 'approvedBy' => 14, 'approvedAt' => 15, 'status' => 16, 'operations' => 17, ],
        self::TYPE_COLNAME       => [OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID => 0, OnboardingRequestViewTableMap::COL_FIRST_NAME => 1, OnboardingRequestViewTableMap::COL_LAST_NAME => 2, OnboardingRequestViewTableMap::COL_OUTLET_NAME => 3, OnboardingRequestViewTableMap::COL_EMAIL => 4, OnboardingRequestViewTableMap::COL_MOBILE => 5, OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID => 6, OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME => 7, OnboardingRequestViewTableMap::COL_TERRITORY => 8, OnboardingRequestViewTableMap::COL_TERRITORY_NAME => 9, OnboardingRequestViewTableMap::COL_CREATED_AT => 10, OnboardingRequestViewTableMap::COL_CREATED_BY => 11, OnboardingRequestViewTableMap::COL_ORGUNITID => 12, OnboardingRequestViewTableMap::COL_UNIT_NAME => 13, OnboardingRequestViewTableMap::COL_APPROVED_BY => 14, OnboardingRequestViewTableMap::COL_APPROVED_AT => 15, OnboardingRequestViewTableMap::COL_STATUS => 16, OnboardingRequestViewTableMap::COL_OPERATIONS => 17, ],
        self::TYPE_FIELDNAME     => ['on_board_request_id' => 0, 'first_name' => 1, 'last_name' => 2, 'outlet_name' => 3, 'email' => 4, 'mobile' => 5, 'outlet_type_id' => 6, 'outlettype_name' => 7, 'territory' => 8, 'territory_name' => 9, 'created_at' => 10, 'created_by' => 11, 'orgunitid' => 12, 'unit_name' => 13, 'approved_by' => 14, 'approved_at' => 15, 'status' => 16, 'operations' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnboardingRequestView.OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onboardingRequestView.onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'onboarding_request_view.on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'FirstName' => 'FIRST_NAME',
        'OnboardingRequestView.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'onboardingRequestView.firstName' => 'FIRST_NAME',
        'OnboardingRequestViewTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'onboarding_request_view.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'OnboardingRequestView.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'onboardingRequestView.lastName' => 'LAST_NAME',
        'OnboardingRequestViewTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'onboarding_request_view.last_name' => 'LAST_NAME',
        'OutletName' => 'OUTLET_NAME',
        'OnboardingRequestView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'onboardingRequestView.outletName' => 'OUTLET_NAME',
        'OnboardingRequestViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'onboarding_request_view.outlet_name' => 'OUTLET_NAME',
        'Email' => 'EMAIL',
        'OnboardingRequestView.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'onboardingRequestView.email' => 'EMAIL',
        'OnboardingRequestViewTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'onboarding_request_view.email' => 'EMAIL',
        'Mobile' => 'MOBILE',
        'OnboardingRequestView.Mobile' => 'MOBILE',
        'mobile' => 'MOBILE',
        'onboardingRequestView.mobile' => 'MOBILE',
        'OnboardingRequestViewTableMap::COL_MOBILE' => 'MOBILE',
        'COL_MOBILE' => 'MOBILE',
        'onboarding_request_view.mobile' => 'MOBILE',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'OnboardingRequestView.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'onboardingRequestView.outletTypeId' => 'OUTLET_TYPE_ID',
        'OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'onboarding_request_view.outlet_type_id' => 'OUTLET_TYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'OnboardingRequestView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'onboardingRequestView.outlettypeName' => 'OUTLETTYPE_NAME',
        'OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'onboarding_request_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'Territory' => 'TERRITORY',
        'OnboardingRequestView.Territory' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'onboardingRequestView.territory' => 'TERRITORY',
        'OnboardingRequestViewTableMap::COL_TERRITORY' => 'TERRITORY',
        'COL_TERRITORY' => 'TERRITORY',
        'onboarding_request_view.territory' => 'TERRITORY',
        'TerritoryName' => 'TERRITORY_NAME',
        'OnboardingRequestView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'onboardingRequestView.territoryName' => 'TERRITORY_NAME',
        'OnboardingRequestViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'onboarding_request_view.territory_name' => 'TERRITORY_NAME',
        'CreatedAt' => 'CREATED_AT',
        'OnboardingRequestView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onboardingRequestView.createdAt' => 'CREATED_AT',
        'OnboardingRequestViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'onboarding_request_view.created_at' => 'CREATED_AT',
        'CreatedBy' => 'CREATED_BY',
        'OnboardingRequestView.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'onboardingRequestView.createdBy' => 'CREATED_BY',
        'OnboardingRequestViewTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'onboarding_request_view.created_by' => 'CREATED_BY',
        'Orgunitid' => 'ORGUNITID',
        'OnboardingRequestView.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'onboardingRequestView.orgunitid' => 'ORGUNITID',
        'OnboardingRequestViewTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'onboarding_request_view.orgunitid' => 'ORGUNITID',
        'UnitName' => 'UNIT_NAME',
        'OnboardingRequestView.UnitName' => 'UNIT_NAME',
        'unitName' => 'UNIT_NAME',
        'onboardingRequestView.unitName' => 'UNIT_NAME',
        'OnboardingRequestViewTableMap::COL_UNIT_NAME' => 'UNIT_NAME',
        'COL_UNIT_NAME' => 'UNIT_NAME',
        'unit_name' => 'UNIT_NAME',
        'onboarding_request_view.unit_name' => 'UNIT_NAME',
        'ApprovedBy' => 'APPROVED_BY',
        'OnboardingRequestView.ApprovedBy' => 'APPROVED_BY',
        'approvedBy' => 'APPROVED_BY',
        'onboardingRequestView.approvedBy' => 'APPROVED_BY',
        'OnboardingRequestViewTableMap::COL_APPROVED_BY' => 'APPROVED_BY',
        'COL_APPROVED_BY' => 'APPROVED_BY',
        'approved_by' => 'APPROVED_BY',
        'onboarding_request_view.approved_by' => 'APPROVED_BY',
        'ApprovedAt' => 'APPROVED_AT',
        'OnboardingRequestView.ApprovedAt' => 'APPROVED_AT',
        'approvedAt' => 'APPROVED_AT',
        'onboardingRequestView.approvedAt' => 'APPROVED_AT',
        'OnboardingRequestViewTableMap::COL_APPROVED_AT' => 'APPROVED_AT',
        'COL_APPROVED_AT' => 'APPROVED_AT',
        'approved_at' => 'APPROVED_AT',
        'onboarding_request_view.approved_at' => 'APPROVED_AT',
        'Status' => 'STATUS',
        'OnboardingRequestView.Status' => 'STATUS',
        'status' => 'STATUS',
        'onboardingRequestView.status' => 'STATUS',
        'OnboardingRequestViewTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'onboarding_request_view.status' => 'STATUS',
        'Operations' => 'OPERATIONS',
        'OnboardingRequestView.Operations' => 'OPERATIONS',
        'operations' => 'OPERATIONS',
        'onboardingRequestView.operations' => 'OPERATIONS',
        'OnboardingRequestViewTableMap::COL_OPERATIONS' => 'OPERATIONS',
        'COL_OPERATIONS' => 'OPERATIONS',
        'onboarding_request_view.operations' => 'OPERATIONS',
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
        $this->setName('onboarding_request_view');
        $this->setPhpName('OnboardingRequestView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnboardingRequestView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('on_board_request_id', 'OnBoardRequestId', 'INTEGER', true, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, null, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, null, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_type_id', 'OutletTypeId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, null, null);
        $this->addColumn('territory', 'Territory', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'DATE', false, null, null);
        $this->addColumn('created_by', 'CreatedBy', 'VARCHAR', false, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'INTEGER', false, null, null);
        $this->addColumn('unit_name', 'UnitName', 'VARCHAR', false, null, null);
        $this->addColumn('approved_by', 'ApprovedBy', 'VARCHAR', false, null, null);
        $this->addColumn('approved_at', 'ApprovedAt', 'DATE', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addColumn('operations', 'Operations', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnboardingRequestViewTableMap::CLASS_DEFAULT : OnboardingRequestViewTableMap::OM_CLASS;
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
     * @return array (OnboardingRequestView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnboardingRequestViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnboardingRequestViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnboardingRequestViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnboardingRequestViewTableMap::OM_CLASS;
            /** @var OnboardingRequestView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnboardingRequestViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OnboardingRequestViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnboardingRequestViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnboardingRequestView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnboardingRequestViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_EMAIL);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_MOBILE);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_TERRITORY);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_UNIT_NAME);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_APPROVED_BY);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_APPROVED_AT);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_STATUS);
            $criteria->addSelectColumn(OnboardingRequestViewTableMap::COL_OPERATIONS);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_id');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.territory');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.created_by');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.unit_name');
            $criteria->addSelectColumn($alias . '.approved_by');
            $criteria->addSelectColumn($alias . '.approved_at');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.operations');
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
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_MOBILE);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_TERRITORY);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_UNIT_NAME);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_APPROVED_BY);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_APPROVED_AT);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_STATUS);
            $criteria->removeSelectColumn(OnboardingRequestViewTableMap::COL_OPERATIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_id');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.mobile');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.territory');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.created_by');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.unit_name');
            $criteria->removeSelectColumn($alias . '.approved_by');
            $criteria->removeSelectColumn($alias . '.approved_at');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.operations');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnboardingRequestViewTableMap::DATABASE_NAME)->getTable(OnboardingRequestViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnboardingRequestView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnboardingRequestView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnboardingRequestViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnboardingRequestView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnboardingRequestViewTableMap::DATABASE_NAME);
            $criteria->add(OnboardingRequestViewTableMap::COL_ON_BOARD_REQUEST_ID, (array) $values, Criteria::IN);
        }

        $query = OnboardingRequestViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnboardingRequestViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnboardingRequestViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the onboarding_request_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnboardingRequestViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnboardingRequestView or Criteria object.
     *
     * @param mixed $criteria Criteria or OnboardingRequestView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnboardingRequestViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnboardingRequestView object
        }


        // Set the correct dbName
        $query = OnboardingRequestViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

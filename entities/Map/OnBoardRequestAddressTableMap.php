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
use entities\OnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery;


/**
 * This class defines the structure of the 'on_board_request_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnBoardRequestAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnBoardRequestAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'on_board_request_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnBoardRequestAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnBoardRequestAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnBoardRequestAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the on_board_request_address_id field
     */
    public const COL_ON_BOARD_REQUEST_ADDRESS_ID = 'on_board_request_address.on_board_request_address_id';

    /**
     * the column name for the outlet_sub_type_id field
     */
    public const COL_OUTLET_SUB_TYPE_ID = 'on_board_request_address.outlet_sub_type_id';

    /**
     * the column name for the address field
     */
    public const COL_ADDRESS = 'on_board_request_address.address';

    /**
     * the column name for the landmark field
     */
    public const COL_LANDMARK = 'on_board_request_address.landmark';

    /**
     * the column name for the icityid field
     */
    public const COL_ICITYID = 'on_board_request_address.icityid';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'on_board_request_address.itownid';

    /**
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'on_board_request_address.istateid';

    /**
     * the column name for the pincode field
     */
    public const COL_PINCODE = 'on_board_request_address.pincode';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'on_board_request_address.outlet_org_data_id';

    /**
     * the column name for the speciality field
     */
    public const COL_SPECIALITY = 'on_board_request_address.speciality';

    /**
     * the column name for the potential field
     */
    public const COL_POTENTIAL = 'on_board_request_address.potential';

    /**
     * the column name for the visit_frequency field
     */
    public const COL_VISIT_FREQUENCY = 'on_board_request_address.visit_frequency';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'on_board_request_address.tags';

    /**
     * the column name for the focus_brand field
     */
    public const COL_FOCUS_BRAND = 'on_board_request_address.focus_brand';

    /**
     * the column name for the spport_documents field
     */
    public const COL_SPPORT_DOCUMENTS = 'on_board_request_address.spport_documents';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'on_board_request_address.org_unit_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'on_board_request_address.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'on_board_request_address.updated_at';

    /**
     * the column name for the address_id field
     */
    public const COL_ADDRESS_ID = 'on_board_request_address.address_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'on_board_request_address.company_id';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'on_board_request_address.beat_id';

    /**
     * the column name for the on_board_request_id field
     */
    public const COL_ON_BOARD_REQUEST_ID = 'on_board_request_address.on_board_request_id';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'on_board_request_address.status';

    /**
     * the column name for the invested_amount field
     */
    public const COL_INVESTED_AMOUNT = 'on_board_request_address.invested_amount';

    /**
     * the column name for the outlet_org_code field
     */
    public const COL_OUTLET_ORG_CODE = 'on_board_request_address.outlet_org_code';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestAddressId', 'OutletSubTypeId', 'Address', 'Landmark', 'Icityid', 'Itownid', 'Istateid', 'Pincode', 'OutletOrgDataId', 'Speciality', 'Potential', 'VisitFrequency', 'Tags', 'FocusBrand', 'SpportDocuments', 'OrgUnitId', 'CreatedAt', 'UpdatedAt', 'AddressId', 'CompanyId', 'BeatId', 'OnBoardRequestId', 'Status', 'InvestedAmount', 'OutletOrgCode', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestAddressId', 'outletSubTypeId', 'address', 'landmark', 'icityid', 'itownid', 'istateid', 'pincode', 'outletOrgDataId', 'speciality', 'potential', 'visitFrequency', 'tags', 'focusBrand', 'spportDocuments', 'orgUnitId', 'createdAt', 'updatedAt', 'addressId', 'companyId', 'beatId', 'onBoardRequestId', 'status', 'investedAmount', 'outletOrgCode', ],
        self::TYPE_COLNAME       => [OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, OnBoardRequestAddressTableMap::COL_ADDRESS, OnBoardRequestAddressTableMap::COL_LANDMARK, OnBoardRequestAddressTableMap::COL_ICITYID, OnBoardRequestAddressTableMap::COL_ITOWNID, OnBoardRequestAddressTableMap::COL_ISTATEID, OnBoardRequestAddressTableMap::COL_PINCODE, OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, OnBoardRequestAddressTableMap::COL_SPECIALITY, OnBoardRequestAddressTableMap::COL_POTENTIAL, OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY, OnBoardRequestAddressTableMap::COL_TAGS, OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS, OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, OnBoardRequestAddressTableMap::COL_CREATED_AT, OnBoardRequestAddressTableMap::COL_UPDATED_AT, OnBoardRequestAddressTableMap::COL_ADDRESS_ID, OnBoardRequestAddressTableMap::COL_COMPANY_ID, OnBoardRequestAddressTableMap::COL_BEAT_ID, OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, OnBoardRequestAddressTableMap::COL_STATUS, OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT, OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE, ],
        self::TYPE_FIELDNAME     => ['on_board_request_address_id', 'outlet_sub_type_id', 'address', 'landmark', 'icityid', 'itownid', 'istateid', 'pincode', 'outlet_org_data_id', 'speciality', 'potential', 'visit_frequency', 'tags', 'focus_brand', 'spport_documents', 'org_unit_id', 'created_at', 'updated_at', 'address_id', 'company_id', 'beat_id', 'on_board_request_id', 'status', 'invested_amount', 'outlet_org_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, ]
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
        self::TYPE_PHPNAME       => ['OnBoardRequestAddressId' => 0, 'OutletSubTypeId' => 1, 'Address' => 2, 'Landmark' => 3, 'Icityid' => 4, 'Itownid' => 5, 'Istateid' => 6, 'Pincode' => 7, 'OutletOrgDataId' => 8, 'Speciality' => 9, 'Potential' => 10, 'VisitFrequency' => 11, 'Tags' => 12, 'FocusBrand' => 13, 'SpportDocuments' => 14, 'OrgUnitId' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, 'AddressId' => 18, 'CompanyId' => 19, 'BeatId' => 20, 'OnBoardRequestId' => 21, 'Status' => 22, 'InvestedAmount' => 23, 'OutletOrgCode' => 24, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestAddressId' => 0, 'outletSubTypeId' => 1, 'address' => 2, 'landmark' => 3, 'icityid' => 4, 'itownid' => 5, 'istateid' => 6, 'pincode' => 7, 'outletOrgDataId' => 8, 'speciality' => 9, 'potential' => 10, 'visitFrequency' => 11, 'tags' => 12, 'focusBrand' => 13, 'spportDocuments' => 14, 'orgUnitId' => 15, 'createdAt' => 16, 'updatedAt' => 17, 'addressId' => 18, 'companyId' => 19, 'beatId' => 20, 'onBoardRequestId' => 21, 'status' => 22, 'investedAmount' => 23, 'outletOrgCode' => 24, ],
        self::TYPE_COLNAME       => [OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID => 0, OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID => 1, OnBoardRequestAddressTableMap::COL_ADDRESS => 2, OnBoardRequestAddressTableMap::COL_LANDMARK => 3, OnBoardRequestAddressTableMap::COL_ICITYID => 4, OnBoardRequestAddressTableMap::COL_ITOWNID => 5, OnBoardRequestAddressTableMap::COL_ISTATEID => 6, OnBoardRequestAddressTableMap::COL_PINCODE => 7, OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID => 8, OnBoardRequestAddressTableMap::COL_SPECIALITY => 9, OnBoardRequestAddressTableMap::COL_POTENTIAL => 10, OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY => 11, OnBoardRequestAddressTableMap::COL_TAGS => 12, OnBoardRequestAddressTableMap::COL_FOCUS_BRAND => 13, OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS => 14, OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID => 15, OnBoardRequestAddressTableMap::COL_CREATED_AT => 16, OnBoardRequestAddressTableMap::COL_UPDATED_AT => 17, OnBoardRequestAddressTableMap::COL_ADDRESS_ID => 18, OnBoardRequestAddressTableMap::COL_COMPANY_ID => 19, OnBoardRequestAddressTableMap::COL_BEAT_ID => 20, OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID => 21, OnBoardRequestAddressTableMap::COL_STATUS => 22, OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT => 23, OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE => 24, ],
        self::TYPE_FIELDNAME     => ['on_board_request_address_id' => 0, 'outlet_sub_type_id' => 1, 'address' => 2, 'landmark' => 3, 'icityid' => 4, 'itownid' => 5, 'istateid' => 6, 'pincode' => 7, 'outlet_org_data_id' => 8, 'speciality' => 9, 'potential' => 10, 'visit_frequency' => 11, 'tags' => 12, 'focus_brand' => 13, 'spport_documents' => 14, 'org_unit_id' => 15, 'created_at' => 16, 'updated_at' => 17, 'address_id' => 18, 'company_id' => 19, 'beat_id' => 20, 'on_board_request_id' => 21, 'status' => 22, 'invested_amount' => 23, 'outlet_org_code' => 24, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'OnBoardRequestAddress.OnBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'onBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'onBoardRequestAddress.onBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'COL_ON_BOARD_REQUEST_ADDRESS_ID' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'on_board_request_address_id' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'on_board_request_address.on_board_request_address_id' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'OutletSubTypeId' => 'OUTLET_SUB_TYPE_ID',
        'OnBoardRequestAddress.OutletSubTypeId' => 'OUTLET_SUB_TYPE_ID',
        'outletSubTypeId' => 'OUTLET_SUB_TYPE_ID',
        'onBoardRequestAddress.outletSubTypeId' => 'OUTLET_SUB_TYPE_ID',
        'OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID' => 'OUTLET_SUB_TYPE_ID',
        'COL_OUTLET_SUB_TYPE_ID' => 'OUTLET_SUB_TYPE_ID',
        'outlet_sub_type_id' => 'OUTLET_SUB_TYPE_ID',
        'on_board_request_address.outlet_sub_type_id' => 'OUTLET_SUB_TYPE_ID',
        'Address' => 'ADDRESS',
        'OnBoardRequestAddress.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'onBoardRequestAddress.address' => 'ADDRESS',
        'OnBoardRequestAddressTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'on_board_request_address.address' => 'ADDRESS',
        'Landmark' => 'LANDMARK',
        'OnBoardRequestAddress.Landmark' => 'LANDMARK',
        'landmark' => 'LANDMARK',
        'onBoardRequestAddress.landmark' => 'LANDMARK',
        'OnBoardRequestAddressTableMap::COL_LANDMARK' => 'LANDMARK',
        'COL_LANDMARK' => 'LANDMARK',
        'on_board_request_address.landmark' => 'LANDMARK',
        'Icityid' => 'ICITYID',
        'OnBoardRequestAddress.Icityid' => 'ICITYID',
        'icityid' => 'ICITYID',
        'onBoardRequestAddress.icityid' => 'ICITYID',
        'OnBoardRequestAddressTableMap::COL_ICITYID' => 'ICITYID',
        'COL_ICITYID' => 'ICITYID',
        'on_board_request_address.icityid' => 'ICITYID',
        'Itownid' => 'ITOWNID',
        'OnBoardRequestAddress.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'onBoardRequestAddress.itownid' => 'ITOWNID',
        'OnBoardRequestAddressTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'on_board_request_address.itownid' => 'ITOWNID',
        'Istateid' => 'ISTATEID',
        'OnBoardRequestAddress.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'onBoardRequestAddress.istateid' => 'ISTATEID',
        'OnBoardRequestAddressTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
        'on_board_request_address.istateid' => 'ISTATEID',
        'Pincode' => 'PINCODE',
        'OnBoardRequestAddress.Pincode' => 'PINCODE',
        'pincode' => 'PINCODE',
        'onBoardRequestAddress.pincode' => 'PINCODE',
        'OnBoardRequestAddressTableMap::COL_PINCODE' => 'PINCODE',
        'COL_PINCODE' => 'PINCODE',
        'on_board_request_address.pincode' => 'PINCODE',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OnBoardRequestAddress.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'onBoardRequestAddress.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'on_board_request_address.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'Speciality' => 'SPECIALITY',
        'OnBoardRequestAddress.Speciality' => 'SPECIALITY',
        'speciality' => 'SPECIALITY',
        'onBoardRequestAddress.speciality' => 'SPECIALITY',
        'OnBoardRequestAddressTableMap::COL_SPECIALITY' => 'SPECIALITY',
        'COL_SPECIALITY' => 'SPECIALITY',
        'on_board_request_address.speciality' => 'SPECIALITY',
        'Potential' => 'POTENTIAL',
        'OnBoardRequestAddress.Potential' => 'POTENTIAL',
        'potential' => 'POTENTIAL',
        'onBoardRequestAddress.potential' => 'POTENTIAL',
        'OnBoardRequestAddressTableMap::COL_POTENTIAL' => 'POTENTIAL',
        'COL_POTENTIAL' => 'POTENTIAL',
        'on_board_request_address.potential' => 'POTENTIAL',
        'VisitFrequency' => 'VISIT_FREQUENCY',
        'OnBoardRequestAddress.VisitFrequency' => 'VISIT_FREQUENCY',
        'visitFrequency' => 'VISIT_FREQUENCY',
        'onBoardRequestAddress.visitFrequency' => 'VISIT_FREQUENCY',
        'OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY' => 'VISIT_FREQUENCY',
        'COL_VISIT_FREQUENCY' => 'VISIT_FREQUENCY',
        'visit_frequency' => 'VISIT_FREQUENCY',
        'on_board_request_address.visit_frequency' => 'VISIT_FREQUENCY',
        'Tags' => 'TAGS',
        'OnBoardRequestAddress.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'onBoardRequestAddress.tags' => 'TAGS',
        'OnBoardRequestAddressTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'on_board_request_address.tags' => 'TAGS',
        'FocusBrand' => 'FOCUS_BRAND',
        'OnBoardRequestAddress.FocusBrand' => 'FOCUS_BRAND',
        'focusBrand' => 'FOCUS_BRAND',
        'onBoardRequestAddress.focusBrand' => 'FOCUS_BRAND',
        'OnBoardRequestAddressTableMap::COL_FOCUS_BRAND' => 'FOCUS_BRAND',
        'COL_FOCUS_BRAND' => 'FOCUS_BRAND',
        'focus_brand' => 'FOCUS_BRAND',
        'on_board_request_address.focus_brand' => 'FOCUS_BRAND',
        'SpportDocuments' => 'SPPORT_DOCUMENTS',
        'OnBoardRequestAddress.SpportDocuments' => 'SPPORT_DOCUMENTS',
        'spportDocuments' => 'SPPORT_DOCUMENTS',
        'onBoardRequestAddress.spportDocuments' => 'SPPORT_DOCUMENTS',
        'OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS' => 'SPPORT_DOCUMENTS',
        'COL_SPPORT_DOCUMENTS' => 'SPPORT_DOCUMENTS',
        'spport_documents' => 'SPPORT_DOCUMENTS',
        'on_board_request_address.spport_documents' => 'SPPORT_DOCUMENTS',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OnBoardRequestAddress.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'onBoardRequestAddress.orgUnitId' => 'ORG_UNIT_ID',
        'OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'on_board_request_address.org_unit_id' => 'ORG_UNIT_ID',
        'CreatedAt' => 'CREATED_AT',
        'OnBoardRequestAddress.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onBoardRequestAddress.createdAt' => 'CREATED_AT',
        'OnBoardRequestAddressTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'on_board_request_address.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OnBoardRequestAddress.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'onBoardRequestAddress.updatedAt' => 'UPDATED_AT',
        'OnBoardRequestAddressTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'on_board_request_address.updated_at' => 'UPDATED_AT',
        'AddressId' => 'ADDRESS_ID',
        'OnBoardRequestAddress.AddressId' => 'ADDRESS_ID',
        'addressId' => 'ADDRESS_ID',
        'onBoardRequestAddress.addressId' => 'ADDRESS_ID',
        'OnBoardRequestAddressTableMap::COL_ADDRESS_ID' => 'ADDRESS_ID',
        'COL_ADDRESS_ID' => 'ADDRESS_ID',
        'address_id' => 'ADDRESS_ID',
        'on_board_request_address.address_id' => 'ADDRESS_ID',
        'CompanyId' => 'COMPANY_ID',
        'OnBoardRequestAddress.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'onBoardRequestAddress.companyId' => 'COMPANY_ID',
        'OnBoardRequestAddressTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'on_board_request_address.company_id' => 'COMPANY_ID',
        'BeatId' => 'BEAT_ID',
        'OnBoardRequestAddress.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'onBoardRequestAddress.beatId' => 'BEAT_ID',
        'OnBoardRequestAddressTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'on_board_request_address.beat_id' => 'BEAT_ID',
        'OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestAddress.OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestAddress.onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_address.on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'Status' => 'STATUS',
        'OnBoardRequestAddress.Status' => 'STATUS',
        'status' => 'STATUS',
        'onBoardRequestAddress.status' => 'STATUS',
        'OnBoardRequestAddressTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'on_board_request_address.status' => 'STATUS',
        'InvestedAmount' => 'INVESTED_AMOUNT',
        'OnBoardRequestAddress.InvestedAmount' => 'INVESTED_AMOUNT',
        'investedAmount' => 'INVESTED_AMOUNT',
        'onBoardRequestAddress.investedAmount' => 'INVESTED_AMOUNT',
        'OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT' => 'INVESTED_AMOUNT',
        'COL_INVESTED_AMOUNT' => 'INVESTED_AMOUNT',
        'invested_amount' => 'INVESTED_AMOUNT',
        'on_board_request_address.invested_amount' => 'INVESTED_AMOUNT',
        'OutletOrgCode' => 'OUTLET_ORG_CODE',
        'OnBoardRequestAddress.OutletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgCode' => 'OUTLET_ORG_CODE',
        'onBoardRequestAddress.outletOrgCode' => 'OUTLET_ORG_CODE',
        'OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'outlet_org_code' => 'OUTLET_ORG_CODE',
        'on_board_request_address.outlet_org_code' => 'OUTLET_ORG_CODE',
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
        $this->setName('on_board_request_address');
        $this->setPhpName('OnBoardRequestAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnBoardRequestAddress');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('on_board_request_address_on_board_request_address_id_seq');
        // columns
        $this->addPrimaryKey('on_board_request_address_id', 'OnBoardRequestAddressId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_sub_type_id', 'OutletSubTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('address', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('landmark', 'Landmark', 'VARCHAR', false, null, null);
        $this->addForeignKey('icityid', 'Icityid', 'INTEGER', 'geo_city', 'icityid', false, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addForeignKey('istateid', 'Istateid', 'INTEGER', 'geo_state', 'istateid', false, null, null);
        $this->addColumn('pincode', 'Pincode', 'VARCHAR', false, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('speciality', 'Speciality', 'INTEGER', 'classification', 'id', false, null, null);
        $this->addColumn('potential', 'Potential', 'VARCHAR', false, null, null);
        $this->addColumn('visit_frequency', 'VisitFrequency', 'INTEGER', false, null, null);
        $this->addForeignKey('tags', 'Tags', 'INTEGER', 'outlet_tags', 'outlet_tag_id', false, null, null);
        $this->addForeignKey('focus_brand', 'FocusBrand', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('spport_documents', 'SpportDocuments', 'VARCHAR', false, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('address_id', 'AddressId', 'INTEGER', 'outlet_address', 'outlet_address_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', false, null, null);
        $this->addForeignKey('on_board_request_id', 'OnBoardRequestId', 'INTEGER', 'on_board_request', 'on_board_request_id', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('invested_amount', 'InvestedAmount', 'DECIMAL', false, null, 0.00);
        $this->addColumn('outlet_org_code', 'OutletOrgCode', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OutletAddress', '\\entities\\OutletAddress', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':address_id',
    1 => ':outlet_address_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':focus_brand',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':speciality',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletTags', '\\entities\\OutletTags', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':tags',
    1 => ':outlet_tag_id',
  ),
), null, null, null, false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoCity', '\\entities\\GeoCity', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':icityid',
    1 => ':icityid',
  ),
), null, null, null, false);
        $this->addRelation('GeoState', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_sub_type_id',
    1 => ':outlettype_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnBoardRequestAddressTableMap::CLASS_DEFAULT : OnBoardRequestAddressTableMap::OM_CLASS;
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
     * @return array (OnBoardRequestAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnBoardRequestAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnBoardRequestAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnBoardRequestAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnBoardRequestAddressTableMap::OM_CLASS;
            /** @var OnBoardRequestAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnBoardRequestAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = OnBoardRequestAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnBoardRequestAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnBoardRequestAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnBoardRequestAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_LANDMARK);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ICITYID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ISTATEID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_PINCODE);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_SPECIALITY);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_POTENTIAL);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_TAGS);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ADDRESS_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_STATUS);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT);
            $criteria->addSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_address_id');
            $criteria->addSelectColumn($alias . '.outlet_sub_type_id');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.landmark');
            $criteria->addSelectColumn($alias . '.icityid');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.istateid');
            $criteria->addSelectColumn($alias . '.pincode');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.speciality');
            $criteria->addSelectColumn($alias . '.potential');
            $criteria->addSelectColumn($alias . '.visit_frequency');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.focus_brand');
            $criteria->addSelectColumn($alias . '.spport_documents');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.address_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.on_board_request_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.invested_amount');
            $criteria->addSelectColumn($alias . '.outlet_org_code');
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
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_LANDMARK);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ICITYID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ISTATEID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_PINCODE);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_SPECIALITY);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_POTENTIAL);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_TAGS);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ADDRESS_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_STATUS);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT);
            $criteria->removeSelectColumn(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_address_id');
            $criteria->removeSelectColumn($alias . '.outlet_sub_type_id');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.landmark');
            $criteria->removeSelectColumn($alias . '.icityid');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.istateid');
            $criteria->removeSelectColumn($alias . '.pincode');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.speciality');
            $criteria->removeSelectColumn($alias . '.potential');
            $criteria->removeSelectColumn($alias . '.visit_frequency');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.focus_brand');
            $criteria->removeSelectColumn($alias . '.spport_documents');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.address_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.on_board_request_id');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.invested_amount');
            $criteria->removeSelectColumn($alias . '.outlet_org_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnBoardRequestAddressTableMap::DATABASE_NAME)->getTable(OnBoardRequestAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnBoardRequestAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnBoardRequestAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnBoardRequestAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnBoardRequestAddressTableMap::DATABASE_NAME);
            $criteria->add(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = OnBoardRequestAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnBoardRequestAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnBoardRequestAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the on_board_request_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnBoardRequestAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnBoardRequestAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or OnBoardRequestAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnBoardRequestAddress object
        }

        if ($criteria->containsKey(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID) && $criteria->keyContainsValue(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID.')');
        }


        // Set the correct dbName
        $query = OnBoardRequestAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

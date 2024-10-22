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
use entities\OutletView;
use entities\OutletViewQuery;


/**
 * This class defines the structure of the 'outlet_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 60;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 60;

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_view.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'outlet_view.org_unit_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'outlet_view.territory_id';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'outlet_view.beat_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'outlet_view.position_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'outlet_view.territory_name';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'outlet_view.position_name';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'outlet_view.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'outlet_view.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'outlet_view.visit_fq';

    /**
     * the column name for the comments field
     */
    public const COL_COMMENTS = 'outlet_view.comments';

    /**
     * the column name for the org_potential field
     */
    public const COL_ORG_POTENTIAL = 'outlet_view.org_potential';

    /**
     * the column name for the brand_focus field
     */
    public const COL_BRAND_FOCUS = 'outlet_view.brand_focus';

    /**
     * the column name for the customer_fq field
     */
    public const COL_CUSTOMER_FQ = 'outlet_view.customer_fq';

    /**
     * the column name for the id field
     */
    public const COL_ID = 'outlet_view.id';

    /**
     * the column name for the outlet_media_id field
     */
    public const COL_OUTLET_MEDIA_ID = 'outlet_view.outlet_media_id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'outlet_view.outlet_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'outlet_view.outlet_code';

    /**
     * the column name for the outlet_email field
     */
    public const COL_OUTLET_EMAIL = 'outlet_view.outlet_email';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'outlet_view.outlet_salutation';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'outlet_view.outlet_classification';

    /**
     * the column name for the classification field
     */
    public const COL_CLASSIFICATION = 'outlet_view.classification';

    /**
     * the column name for the outlet_opening_date field
     */
    public const COL_OUTLET_OPENING_DATE = 'outlet_view.outlet_opening_date';

    /**
     * the column name for the outlet_contact_name field
     */
    public const COL_OUTLET_CONTACT_NAME = 'outlet_view.outlet_contact_name';

    /**
     * the column name for the outlet_landlineno field
     */
    public const COL_OUTLET_LANDLINENO = 'outlet_view.outlet_landlineno';

    /**
     * the column name for the outlet_alt_landlineno field
     */
    public const COL_OUTLET_ALT_LANDLINENO = 'outlet_view.outlet_alt_landlineno';

    /**
     * the column name for the outlet_contact_bday field
     */
    public const COL_OUTLET_CONTACT_BDAY = 'outlet_view.outlet_contact_bday';

    /**
     * the column name for the outlet_contact_anniversary field
     */
    public const COL_OUTLET_CONTACT_ANNIVERSARY = 'outlet_view.outlet_contact_anniversary';

    /**
     * the column name for the outlet_isd_code field
     */
    public const COL_OUTLET_ISD_CODE = 'outlet_view.outlet_isd_code';

    /**
     * the column name for the outlet_contact_no field
     */
    public const COL_OUTLET_CONTACT_NO = 'outlet_view.outlet_contact_no';

    /**
     * the column name for the outlet_alt_contact_no field
     */
    public const COL_OUTLET_ALT_CONTACT_NO = 'outlet_view.outlet_alt_contact_no';

    /**
     * the column name for the outlet_status field
     */
    public const COL_OUTLET_STATUS = 'outlet_view.outlet_status';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'outlet_view.outlettype_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'outlet_view.outlettype_name';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_view.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_view.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_view.updated_at';

    /**
     * the column name for the outlet_otp field
     */
    public const COL_OUTLET_OTP = 'outlet_view.outlet_otp';

    /**
     * the column name for the outlet_verified field
     */
    public const COL_OUTLET_VERIFIED = 'outlet_view.outlet_verified';

    /**
     * the column name for the outlet_created_by field
     */
    public const COL_OUTLET_CREATED_BY = 'outlet_view.outlet_created_by';

    /**
     * the column name for the outlet_approved_by field
     */
    public const COL_OUTLET_APPROVED_BY = 'outlet_view.outlet_approved_by';

    /**
     * the column name for the outlet_potential field
     */
    public const COL_OUTLET_POTENTIAL = 'outlet_view.outlet_potential';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'outlet_view.integration_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'outlet_view.itownid';

    /**
     * the column name for the outlet_qualification field
     */
    public const COL_OUTLET_QUALIFICATION = 'outlet_view.outlet_qualification';

    /**
     * the column name for the outlet_regno field
     */
    public const COL_OUTLET_REGNO = 'outlet_view.outlet_regno';

    /**
     * the column name for the outlet_marital_status field
     */
    public const COL_OUTLET_MARITAL_STATUS = 'outlet_view.outlet_marital_status';

    /**
     * the column name for the outlet_media field
     */
    public const COL_OUTLET_MEDIA = 'outlet_view.outlet_media';

    /**
     * the column name for the address_name field
     */
    public const COL_ADDRESS_NAME = 'outlet_view.address_name';

    /**
     * the column name for the outlet_address field
     */
    public const COL_OUTLET_ADDRESS = 'outlet_view.outlet_address';

    /**
     * the column name for the outlet_street_name field
     */
    public const COL_OUTLET_STREET_NAME = 'outlet_view.outlet_street_name';

    /**
     * the column name for the outlet_city field
     */
    public const COL_OUTLET_CITY = 'outlet_view.outlet_city';

    /**
     * the column name for the outlet_state field
     */
    public const COL_OUTLET_STATE = 'outlet_view.outlet_state';

    /**
     * the column name for the outlet_country field
     */
    public const COL_OUTLET_COUNTRY = 'outlet_view.outlet_country';

    /**
     * the column name for the outlet_pincode field
     */
    public const COL_OUTLET_PINCODE = 'outlet_view.outlet_pincode';

    /**
     * the column name for the last_visit_date field
     */
    public const COL_LAST_VISIT_DATE = 'outlet_view.last_visit_date';

    /**
     * the column name for the last_visit_employee field
     */
    public const COL_LAST_VISIT_EMPLOYEE = 'outlet_view.last_visit_employee';

    /**
     * the column name for the outlet_org_code field
     */
    public const COL_OUTLET_ORG_CODE = 'outlet_view.outlet_org_code';

    /**
     * the column name for the sgpi_brand_map field
     */
    public const COL_SGPI_BRAND_MAP = 'outlet_view.sgpi_brand_map';

    /**
     * the column name for the sgpi_brand_id_map field
     */
    public const COL_SGPI_BRAND_ID_MAP = 'outlet_view.sgpi_brand_id_map';

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
        self::TYPE_PHPNAME       => ['OutletOrgId', 'OrgUnitId', 'TerritoryId', 'BeatId', 'PositionId', 'TerritoryName', 'PositionName', 'BeatName', 'Tags', 'VisitFq', 'Comments', 'OrgPotential', 'BrandFocus', 'CustomerFq', 'Outlet_Id', 'OutletMediaId', 'OutletName', 'OutletCode', 'OutletEmail', 'OutletSalutation', 'OutletClassification', 'Classification', 'OutletOpening_date', 'OutletContactName', 'OutletLandlineno', 'OutletAltLandlineno', 'OutletContactBday', 'OutletContactAnniversary', 'OutletIsdCode', 'OutletContactNo', 'OutletAltContactNo', 'OutletStatus', 'OutlettypeId', 'OutlettypeName', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OutletOtp', 'OutletVerified', 'OutletCreatedBy', 'OutletApprovedBy', 'OutletPotential', 'IntegrationId', 'Itownid', 'OutletQualification', 'OutletRegno', 'OutletMaritalStatus', 'OutletMedia', 'AddressName', 'OutletAddress', 'OutletStreetName', 'OutletCity', 'OutletState', 'OutletCountry', 'OutletPincode', 'LastVisitDate', 'LastVisitEmployee', 'OutletOrgCode', 'SgpiBrandMap', 'SgpiBrandIdMap', ],
        self::TYPE_CAMELNAME     => ['outletOrgId', 'orgUnitId', 'territoryId', 'beatId', 'positionId', 'territoryName', 'positionName', 'beatName', 'tags', 'visitFq', 'comments', 'orgPotential', 'brandFocus', 'customerFq', 'outlet_Id', 'outletMediaId', 'outletName', 'outletCode', 'outletEmail', 'outletSalutation', 'outletClassification', 'classification', 'outletOpening_date', 'outletContactName', 'outletLandlineno', 'outletAltLandlineno', 'outletContactBday', 'outletContactAnniversary', 'outletIsdCode', 'outletContactNo', 'outletAltContactNo', 'outletStatus', 'outlettypeId', 'outlettypeName', 'companyId', 'createdAt', 'updatedAt', 'outletOtp', 'outletVerified', 'outletCreatedBy', 'outletApprovedBy', 'outletPotential', 'integrationId', 'itownid', 'outletQualification', 'outletRegno', 'outletMaritalStatus', 'outletMedia', 'addressName', 'outletAddress', 'outletStreetName', 'outletCity', 'outletState', 'outletCountry', 'outletPincode', 'lastVisitDate', 'lastVisitEmployee', 'outletOrgCode', 'sgpiBrandMap', 'sgpiBrandIdMap', ],
        self::TYPE_COLNAME       => [OutletViewTableMap::COL_OUTLET_ORG_ID, OutletViewTableMap::COL_ORG_UNIT_ID, OutletViewTableMap::COL_TERRITORY_ID, OutletViewTableMap::COL_BEAT_ID, OutletViewTableMap::COL_POSITION_ID, OutletViewTableMap::COL_TERRITORY_NAME, OutletViewTableMap::COL_POSITION_NAME, OutletViewTableMap::COL_BEAT_NAME, OutletViewTableMap::COL_TAGS, OutletViewTableMap::COL_VISIT_FQ, OutletViewTableMap::COL_COMMENTS, OutletViewTableMap::COL_ORG_POTENTIAL, OutletViewTableMap::COL_BRAND_FOCUS, OutletViewTableMap::COL_CUSTOMER_FQ, OutletViewTableMap::COL_ID, OutletViewTableMap::COL_OUTLET_MEDIA_ID, OutletViewTableMap::COL_OUTLET_NAME, OutletViewTableMap::COL_OUTLET_CODE, OutletViewTableMap::COL_OUTLET_EMAIL, OutletViewTableMap::COL_OUTLET_SALUTATION, OutletViewTableMap::COL_OUTLET_CLASSIFICATION, OutletViewTableMap::COL_CLASSIFICATION, OutletViewTableMap::COL_OUTLET_OPENING_DATE, OutletViewTableMap::COL_OUTLET_CONTACT_NAME, OutletViewTableMap::COL_OUTLET_LANDLINENO, OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO, OutletViewTableMap::COL_OUTLET_CONTACT_BDAY, OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, OutletViewTableMap::COL_OUTLET_ISD_CODE, OutletViewTableMap::COL_OUTLET_CONTACT_NO, OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO, OutletViewTableMap::COL_OUTLET_STATUS, OutletViewTableMap::COL_OUTLETTYPE_ID, OutletViewTableMap::COL_OUTLETTYPE_NAME, OutletViewTableMap::COL_COMPANY_ID, OutletViewTableMap::COL_CREATED_AT, OutletViewTableMap::COL_UPDATED_AT, OutletViewTableMap::COL_OUTLET_OTP, OutletViewTableMap::COL_OUTLET_VERIFIED, OutletViewTableMap::COL_OUTLET_CREATED_BY, OutletViewTableMap::COL_OUTLET_APPROVED_BY, OutletViewTableMap::COL_OUTLET_POTENTIAL, OutletViewTableMap::COL_INTEGRATION_ID, OutletViewTableMap::COL_ITOWNID, OutletViewTableMap::COL_OUTLET_QUALIFICATION, OutletViewTableMap::COL_OUTLET_REGNO, OutletViewTableMap::COL_OUTLET_MARITAL_STATUS, OutletViewTableMap::COL_OUTLET_MEDIA, OutletViewTableMap::COL_ADDRESS_NAME, OutletViewTableMap::COL_OUTLET_ADDRESS, OutletViewTableMap::COL_OUTLET_STREET_NAME, OutletViewTableMap::COL_OUTLET_CITY, OutletViewTableMap::COL_OUTLET_STATE, OutletViewTableMap::COL_OUTLET_COUNTRY, OutletViewTableMap::COL_OUTLET_PINCODE, OutletViewTableMap::COL_LAST_VISIT_DATE, OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE, OutletViewTableMap::COL_OUTLET_ORG_CODE, OutletViewTableMap::COL_SGPI_BRAND_MAP, OutletViewTableMap::COL_SGPI_BRAND_ID_MAP, ],
        self::TYPE_FIELDNAME     => ['outlet_org_id', 'org_unit_id', 'territory_id', 'beat_id', 'position_id', 'territory_name', 'position_name', 'beat_name', 'tags', 'visit_fq', 'comments', 'org_potential', 'brand_focus', 'customer_fq', 'id', 'outlet_media_id', 'outlet_name', 'outlet_code', 'outlet_email', 'outlet_salutation', 'outlet_classification', 'classification', 'outlet_opening_date', 'outlet_contact_name', 'outlet_landlineno', 'outlet_alt_landlineno', 'outlet_contact_bday', 'outlet_contact_anniversary', 'outlet_isd_code', 'outlet_contact_no', 'outlet_alt_contact_no', 'outlet_status', 'outlettype_id', 'outlettype_name', 'company_id', 'created_at', 'updated_at', 'outlet_otp', 'outlet_verified', 'outlet_created_by', 'outlet_approved_by', 'outlet_potential', 'integration_id', 'itownid', 'outlet_qualification', 'outlet_regno', 'outlet_marital_status', 'outlet_media', 'address_name', 'outlet_address', 'outlet_street_name', 'outlet_city', 'outlet_state', 'outlet_country', 'outlet_pincode', 'last_visit_date', 'last_visit_employee', 'outlet_org_code', 'sgpi_brand_map', 'sgpi_brand_id_map', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, ]
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
        self::TYPE_PHPNAME       => ['OutletOrgId' => 0, 'OrgUnitId' => 1, 'TerritoryId' => 2, 'BeatId' => 3, 'PositionId' => 4, 'TerritoryName' => 5, 'PositionName' => 6, 'BeatName' => 7, 'Tags' => 8, 'VisitFq' => 9, 'Comments' => 10, 'OrgPotential' => 11, 'BrandFocus' => 12, 'CustomerFq' => 13, 'Outlet_Id' => 14, 'OutletMediaId' => 15, 'OutletName' => 16, 'OutletCode' => 17, 'OutletEmail' => 18, 'OutletSalutation' => 19, 'OutletClassification' => 20, 'Classification' => 21, 'OutletOpening_date' => 22, 'OutletContactName' => 23, 'OutletLandlineno' => 24, 'OutletAltLandlineno' => 25, 'OutletContactBday' => 26, 'OutletContactAnniversary' => 27, 'OutletIsdCode' => 28, 'OutletContactNo' => 29, 'OutletAltContactNo' => 30, 'OutletStatus' => 31, 'OutlettypeId' => 32, 'OutlettypeName' => 33, 'CompanyId' => 34, 'CreatedAt' => 35, 'UpdatedAt' => 36, 'OutletOtp' => 37, 'OutletVerified' => 38, 'OutletCreatedBy' => 39, 'OutletApprovedBy' => 40, 'OutletPotential' => 41, 'IntegrationId' => 42, 'Itownid' => 43, 'OutletQualification' => 44, 'OutletRegno' => 45, 'OutletMaritalStatus' => 46, 'OutletMedia' => 47, 'AddressName' => 48, 'OutletAddress' => 49, 'OutletStreetName' => 50, 'OutletCity' => 51, 'OutletState' => 52, 'OutletCountry' => 53, 'OutletPincode' => 54, 'LastVisitDate' => 55, 'LastVisitEmployee' => 56, 'OutletOrgCode' => 57, 'SgpiBrandMap' => 58, 'SgpiBrandIdMap' => 59, ],
        self::TYPE_CAMELNAME     => ['outletOrgId' => 0, 'orgUnitId' => 1, 'territoryId' => 2, 'beatId' => 3, 'positionId' => 4, 'territoryName' => 5, 'positionName' => 6, 'beatName' => 7, 'tags' => 8, 'visitFq' => 9, 'comments' => 10, 'orgPotential' => 11, 'brandFocus' => 12, 'customerFq' => 13, 'outlet_Id' => 14, 'outletMediaId' => 15, 'outletName' => 16, 'outletCode' => 17, 'outletEmail' => 18, 'outletSalutation' => 19, 'outletClassification' => 20, 'classification' => 21, 'outletOpening_date' => 22, 'outletContactName' => 23, 'outletLandlineno' => 24, 'outletAltLandlineno' => 25, 'outletContactBday' => 26, 'outletContactAnniversary' => 27, 'outletIsdCode' => 28, 'outletContactNo' => 29, 'outletAltContactNo' => 30, 'outletStatus' => 31, 'outlettypeId' => 32, 'outlettypeName' => 33, 'companyId' => 34, 'createdAt' => 35, 'updatedAt' => 36, 'outletOtp' => 37, 'outletVerified' => 38, 'outletCreatedBy' => 39, 'outletApprovedBy' => 40, 'outletPotential' => 41, 'integrationId' => 42, 'itownid' => 43, 'outletQualification' => 44, 'outletRegno' => 45, 'outletMaritalStatus' => 46, 'outletMedia' => 47, 'addressName' => 48, 'outletAddress' => 49, 'outletStreetName' => 50, 'outletCity' => 51, 'outletState' => 52, 'outletCountry' => 53, 'outletPincode' => 54, 'lastVisitDate' => 55, 'lastVisitEmployee' => 56, 'outletOrgCode' => 57, 'sgpiBrandMap' => 58, 'sgpiBrandIdMap' => 59, ],
        self::TYPE_COLNAME       => [OutletViewTableMap::COL_OUTLET_ORG_ID => 0, OutletViewTableMap::COL_ORG_UNIT_ID => 1, OutletViewTableMap::COL_TERRITORY_ID => 2, OutletViewTableMap::COL_BEAT_ID => 3, OutletViewTableMap::COL_POSITION_ID => 4, OutletViewTableMap::COL_TERRITORY_NAME => 5, OutletViewTableMap::COL_POSITION_NAME => 6, OutletViewTableMap::COL_BEAT_NAME => 7, OutletViewTableMap::COL_TAGS => 8, OutletViewTableMap::COL_VISIT_FQ => 9, OutletViewTableMap::COL_COMMENTS => 10, OutletViewTableMap::COL_ORG_POTENTIAL => 11, OutletViewTableMap::COL_BRAND_FOCUS => 12, OutletViewTableMap::COL_CUSTOMER_FQ => 13, OutletViewTableMap::COL_ID => 14, OutletViewTableMap::COL_OUTLET_MEDIA_ID => 15, OutletViewTableMap::COL_OUTLET_NAME => 16, OutletViewTableMap::COL_OUTLET_CODE => 17, OutletViewTableMap::COL_OUTLET_EMAIL => 18, OutletViewTableMap::COL_OUTLET_SALUTATION => 19, OutletViewTableMap::COL_OUTLET_CLASSIFICATION => 20, OutletViewTableMap::COL_CLASSIFICATION => 21, OutletViewTableMap::COL_OUTLET_OPENING_DATE => 22, OutletViewTableMap::COL_OUTLET_CONTACT_NAME => 23, OutletViewTableMap::COL_OUTLET_LANDLINENO => 24, OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO => 25, OutletViewTableMap::COL_OUTLET_CONTACT_BDAY => 26, OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY => 27, OutletViewTableMap::COL_OUTLET_ISD_CODE => 28, OutletViewTableMap::COL_OUTLET_CONTACT_NO => 29, OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO => 30, OutletViewTableMap::COL_OUTLET_STATUS => 31, OutletViewTableMap::COL_OUTLETTYPE_ID => 32, OutletViewTableMap::COL_OUTLETTYPE_NAME => 33, OutletViewTableMap::COL_COMPANY_ID => 34, OutletViewTableMap::COL_CREATED_AT => 35, OutletViewTableMap::COL_UPDATED_AT => 36, OutletViewTableMap::COL_OUTLET_OTP => 37, OutletViewTableMap::COL_OUTLET_VERIFIED => 38, OutletViewTableMap::COL_OUTLET_CREATED_BY => 39, OutletViewTableMap::COL_OUTLET_APPROVED_BY => 40, OutletViewTableMap::COL_OUTLET_POTENTIAL => 41, OutletViewTableMap::COL_INTEGRATION_ID => 42, OutletViewTableMap::COL_ITOWNID => 43, OutletViewTableMap::COL_OUTLET_QUALIFICATION => 44, OutletViewTableMap::COL_OUTLET_REGNO => 45, OutletViewTableMap::COL_OUTLET_MARITAL_STATUS => 46, OutletViewTableMap::COL_OUTLET_MEDIA => 47, OutletViewTableMap::COL_ADDRESS_NAME => 48, OutletViewTableMap::COL_OUTLET_ADDRESS => 49, OutletViewTableMap::COL_OUTLET_STREET_NAME => 50, OutletViewTableMap::COL_OUTLET_CITY => 51, OutletViewTableMap::COL_OUTLET_STATE => 52, OutletViewTableMap::COL_OUTLET_COUNTRY => 53, OutletViewTableMap::COL_OUTLET_PINCODE => 54, OutletViewTableMap::COL_LAST_VISIT_DATE => 55, OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE => 56, OutletViewTableMap::COL_OUTLET_ORG_CODE => 57, OutletViewTableMap::COL_SGPI_BRAND_MAP => 58, OutletViewTableMap::COL_SGPI_BRAND_ID_MAP => 59, ],
        self::TYPE_FIELDNAME     => ['outlet_org_id' => 0, 'org_unit_id' => 1, 'territory_id' => 2, 'beat_id' => 3, 'position_id' => 4, 'territory_name' => 5, 'position_name' => 6, 'beat_name' => 7, 'tags' => 8, 'visit_fq' => 9, 'comments' => 10, 'org_potential' => 11, 'brand_focus' => 12, 'customer_fq' => 13, 'id' => 14, 'outlet_media_id' => 15, 'outlet_name' => 16, 'outlet_code' => 17, 'outlet_email' => 18, 'outlet_salutation' => 19, 'outlet_classification' => 20, 'classification' => 21, 'outlet_opening_date' => 22, 'outlet_contact_name' => 23, 'outlet_landlineno' => 24, 'outlet_alt_landlineno' => 25, 'outlet_contact_bday' => 26, 'outlet_contact_anniversary' => 27, 'outlet_isd_code' => 28, 'outlet_contact_no' => 29, 'outlet_alt_contact_no' => 30, 'outlet_status' => 31, 'outlettype_id' => 32, 'outlettype_name' => 33, 'company_id' => 34, 'created_at' => 35, 'updated_at' => 36, 'outlet_otp' => 37, 'outlet_verified' => 38, 'outlet_created_by' => 39, 'outlet_approved_by' => 40, 'outlet_potential' => 41, 'integration_id' => 42, 'itownid' => 43, 'outlet_qualification' => 44, 'outlet_regno' => 45, 'outlet_marital_status' => 46, 'outlet_media' => 47, 'address_name' => 48, 'outlet_address' => 49, 'outlet_street_name' => 50, 'outlet_city' => 51, 'outlet_state' => 52, 'outlet_country' => 53, 'outlet_pincode' => 54, 'last_visit_date' => 55, 'last_visit_employee' => 56, 'outlet_org_code' => 57, 'sgpi_brand_map' => 58, 'sgpi_brand_id_map' => 59, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletView.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletView.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'OutletView.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'outletView.orgUnitId' => 'ORG_UNIT_ID',
        'OutletViewTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'outlet_view.org_unit_id' => 'ORG_UNIT_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'OutletView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'outletView.territoryId' => 'TERRITORY_ID',
        'OutletViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'outlet_view.territory_id' => 'TERRITORY_ID',
        'BeatId' => 'BEAT_ID',
        'OutletView.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'outletView.beatId' => 'BEAT_ID',
        'OutletViewTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'outlet_view.beat_id' => 'BEAT_ID',
        'PositionId' => 'POSITION_ID',
        'OutletView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'outletView.positionId' => 'POSITION_ID',
        'OutletViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'outlet_view.position_id' => 'POSITION_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'OutletView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'outletView.territoryName' => 'TERRITORY_NAME',
        'OutletViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'outlet_view.territory_name' => 'TERRITORY_NAME',
        'PositionName' => 'POSITION_NAME',
        'OutletView.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'outletView.positionName' => 'POSITION_NAME',
        'OutletViewTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'outlet_view.position_name' => 'POSITION_NAME',
        'BeatName' => 'BEAT_NAME',
        'OutletView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'outletView.beatName' => 'BEAT_NAME',
        'OutletViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'outlet_view.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'OutletView.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'outletView.tags' => 'TAGS',
        'OutletViewTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'outlet_view.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'OutletView.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'outletView.visitFq' => 'VISIT_FQ',
        'OutletViewTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'outlet_view.visit_fq' => 'VISIT_FQ',
        'Comments' => 'COMMENTS',
        'OutletView.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'outletView.comments' => 'COMMENTS',
        'OutletViewTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'outlet_view.comments' => 'COMMENTS',
        'OrgPotential' => 'ORG_POTENTIAL',
        'OutletView.OrgPotential' => 'ORG_POTENTIAL',
        'orgPotential' => 'ORG_POTENTIAL',
        'outletView.orgPotential' => 'ORG_POTENTIAL',
        'OutletViewTableMap::COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'org_potential' => 'ORG_POTENTIAL',
        'outlet_view.org_potential' => 'ORG_POTENTIAL',
        'BrandFocus' => 'BRAND_FOCUS',
        'OutletView.BrandFocus' => 'BRAND_FOCUS',
        'brandFocus' => 'BRAND_FOCUS',
        'outletView.brandFocus' => 'BRAND_FOCUS',
        'OutletViewTableMap::COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'brand_focus' => 'BRAND_FOCUS',
        'outlet_view.brand_focus' => 'BRAND_FOCUS',
        'CustomerFq' => 'CUSTOMER_FQ',
        'OutletView.CustomerFq' => 'CUSTOMER_FQ',
        'customerFq' => 'CUSTOMER_FQ',
        'outletView.customerFq' => 'CUSTOMER_FQ',
        'OutletViewTableMap::COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'customer_fq' => 'CUSTOMER_FQ',
        'outlet_view.customer_fq' => 'CUSTOMER_FQ',
        'Outlet_Id' => 'ID',
        'OutletView.Outlet_Id' => 'ID',
        'outlet_Id' => 'ID',
        'outletView.outlet_Id' => 'ID',
        'OutletViewTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'outlet_view.id' => 'ID',
        'OutletMediaId' => 'OUTLET_MEDIA_ID',
        'OutletView.OutletMediaId' => 'OUTLET_MEDIA_ID',
        'outletMediaId' => 'OUTLET_MEDIA_ID',
        'outletView.outletMediaId' => 'OUTLET_MEDIA_ID',
        'OutletViewTableMap::COL_OUTLET_MEDIA_ID' => 'OUTLET_MEDIA_ID',
        'COL_OUTLET_MEDIA_ID' => 'OUTLET_MEDIA_ID',
        'outlet_media_id' => 'OUTLET_MEDIA_ID',
        'outlet_view.outlet_media_id' => 'OUTLET_MEDIA_ID',
        'OutletName' => 'OUTLET_NAME',
        'OutletView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'outletView.outletName' => 'OUTLET_NAME',
        'OutletViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'outlet_view.outlet_name' => 'OUTLET_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'OutletView.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'outletView.outletCode' => 'OUTLET_CODE',
        'OutletViewTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'outlet_view.outlet_code' => 'OUTLET_CODE',
        'OutletEmail' => 'OUTLET_EMAIL',
        'OutletView.OutletEmail' => 'OUTLET_EMAIL',
        'outletEmail' => 'OUTLET_EMAIL',
        'outletView.outletEmail' => 'OUTLET_EMAIL',
        'OutletViewTableMap::COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'outlet_email' => 'OUTLET_EMAIL',
        'outlet_view.outlet_email' => 'OUTLET_EMAIL',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'OutletView.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'outletView.outletSalutation' => 'OUTLET_SALUTATION',
        'OutletViewTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'outlet_view.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'OutletView.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'outletView.outletClassification' => 'OUTLET_CLASSIFICATION',
        'OutletViewTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'outlet_view.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'Classification' => 'CLASSIFICATION',
        'OutletView.Classification' => 'CLASSIFICATION',
        'classification' => 'CLASSIFICATION',
        'outletView.classification' => 'CLASSIFICATION',
        'OutletViewTableMap::COL_CLASSIFICATION' => 'CLASSIFICATION',
        'COL_CLASSIFICATION' => 'CLASSIFICATION',
        'outlet_view.classification' => 'CLASSIFICATION',
        'OutletOpening_date' => 'OUTLET_OPENING_DATE',
        'OutletView.OutletOpening_date' => 'OUTLET_OPENING_DATE',
        'outletOpening_date' => 'OUTLET_OPENING_DATE',
        'outletView.outletOpening_date' => 'OUTLET_OPENING_DATE',
        'OutletViewTableMap::COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'outlet_view.outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'OutletContactName' => 'OUTLET_CONTACT_NAME',
        'OutletView.OutletContactName' => 'OUTLET_CONTACT_NAME',
        'outletContactName' => 'OUTLET_CONTACT_NAME',
        'outletView.outletContactName' => 'OUTLET_CONTACT_NAME',
        'OutletViewTableMap::COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'outlet_view.outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'OutletLandlineno' => 'OUTLET_LANDLINENO',
        'OutletView.OutletLandlineno' => 'OUTLET_LANDLINENO',
        'outletLandlineno' => 'OUTLET_LANDLINENO',
        'outletView.outletLandlineno' => 'OUTLET_LANDLINENO',
        'OutletViewTableMap::COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'outlet_landlineno' => 'OUTLET_LANDLINENO',
        'outlet_view.outlet_landlineno' => 'OUTLET_LANDLINENO',
        'OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletView.OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'outletView.outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'outlet_view.outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'OutletView.OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'outletView.outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'OutletViewTableMap::COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'outlet_view.outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletView.OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outletView.outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlet_view.outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletIsdCode' => 'OUTLET_ISD_CODE',
        'OutletView.OutletIsdCode' => 'OUTLET_ISD_CODE',
        'outletIsdCode' => 'OUTLET_ISD_CODE',
        'outletView.outletIsdCode' => 'OUTLET_ISD_CODE',
        'OutletViewTableMap::COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'outlet_isd_code' => 'OUTLET_ISD_CODE',
        'outlet_view.outlet_isd_code' => 'OUTLET_ISD_CODE',
        'OutletContactNo' => 'OUTLET_CONTACT_NO',
        'OutletView.OutletContactNo' => 'OUTLET_CONTACT_NO',
        'outletContactNo' => 'OUTLET_CONTACT_NO',
        'outletView.outletContactNo' => 'OUTLET_CONTACT_NO',
        'OutletViewTableMap::COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'outlet_view.outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'OutletView.OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'outletView.outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'outlet_view.outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'OutletStatus' => 'OUTLET_STATUS',
        'OutletView.OutletStatus' => 'OUTLET_STATUS',
        'outletStatus' => 'OUTLET_STATUS',
        'outletView.outletStatus' => 'OUTLET_STATUS',
        'OutletViewTableMap::COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'outlet_status' => 'OUTLET_STATUS',
        'outlet_view.outlet_status' => 'OUTLET_STATUS',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'OutletView.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'outletView.outlettypeId' => 'OUTLETTYPE_ID',
        'OutletViewTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'outlet_view.outlettype_id' => 'OUTLETTYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'OutletView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'outletView.outlettypeName' => 'OUTLETTYPE_NAME',
        'OutletViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'outlet_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'CompanyId' => 'COMPANY_ID',
        'OutletView.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletView.companyId' => 'COMPANY_ID',
        'OutletViewTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_view.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletView.createdAt' => 'CREATED_AT',
        'OutletViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_view.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletView.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletView.updatedAt' => 'UPDATED_AT',
        'OutletViewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_view.updated_at' => 'UPDATED_AT',
        'OutletOtp' => 'OUTLET_OTP',
        'OutletView.OutletOtp' => 'OUTLET_OTP',
        'outletOtp' => 'OUTLET_OTP',
        'outletView.outletOtp' => 'OUTLET_OTP',
        'OutletViewTableMap::COL_OUTLET_OTP' => 'OUTLET_OTP',
        'COL_OUTLET_OTP' => 'OUTLET_OTP',
        'outlet_otp' => 'OUTLET_OTP',
        'outlet_view.outlet_otp' => 'OUTLET_OTP',
        'OutletVerified' => 'OUTLET_VERIFIED',
        'OutletView.OutletVerified' => 'OUTLET_VERIFIED',
        'outletVerified' => 'OUTLET_VERIFIED',
        'outletView.outletVerified' => 'OUTLET_VERIFIED',
        'OutletViewTableMap::COL_OUTLET_VERIFIED' => 'OUTLET_VERIFIED',
        'COL_OUTLET_VERIFIED' => 'OUTLET_VERIFIED',
        'outlet_verified' => 'OUTLET_VERIFIED',
        'outlet_view.outlet_verified' => 'OUTLET_VERIFIED',
        'OutletCreatedBy' => 'OUTLET_CREATED_BY',
        'OutletView.OutletCreatedBy' => 'OUTLET_CREATED_BY',
        'outletCreatedBy' => 'OUTLET_CREATED_BY',
        'outletView.outletCreatedBy' => 'OUTLET_CREATED_BY',
        'OutletViewTableMap::COL_OUTLET_CREATED_BY' => 'OUTLET_CREATED_BY',
        'COL_OUTLET_CREATED_BY' => 'OUTLET_CREATED_BY',
        'outlet_created_by' => 'OUTLET_CREATED_BY',
        'outlet_view.outlet_created_by' => 'OUTLET_CREATED_BY',
        'OutletApprovedBy' => 'OUTLET_APPROVED_BY',
        'OutletView.OutletApprovedBy' => 'OUTLET_APPROVED_BY',
        'outletApprovedBy' => 'OUTLET_APPROVED_BY',
        'outletView.outletApprovedBy' => 'OUTLET_APPROVED_BY',
        'OutletViewTableMap::COL_OUTLET_APPROVED_BY' => 'OUTLET_APPROVED_BY',
        'COL_OUTLET_APPROVED_BY' => 'OUTLET_APPROVED_BY',
        'outlet_approved_by' => 'OUTLET_APPROVED_BY',
        'outlet_view.outlet_approved_by' => 'OUTLET_APPROVED_BY',
        'OutletPotential' => 'OUTLET_POTENTIAL',
        'OutletView.OutletPotential' => 'OUTLET_POTENTIAL',
        'outletPotential' => 'OUTLET_POTENTIAL',
        'outletView.outletPotential' => 'OUTLET_POTENTIAL',
        'OutletViewTableMap::COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'outlet_potential' => 'OUTLET_POTENTIAL',
        'outlet_view.outlet_potential' => 'OUTLET_POTENTIAL',
        'IntegrationId' => 'INTEGRATION_ID',
        'OutletView.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'outletView.integrationId' => 'INTEGRATION_ID',
        'OutletViewTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'outlet_view.integration_id' => 'INTEGRATION_ID',
        'Itownid' => 'ITOWNID',
        'OutletView.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'outletView.itownid' => 'ITOWNID',
        'OutletViewTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'outlet_view.itownid' => 'ITOWNID',
        'OutletQualification' => 'OUTLET_QUALIFICATION',
        'OutletView.OutletQualification' => 'OUTLET_QUALIFICATION',
        'outletQualification' => 'OUTLET_QUALIFICATION',
        'outletView.outletQualification' => 'OUTLET_QUALIFICATION',
        'OutletViewTableMap::COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'outlet_qualification' => 'OUTLET_QUALIFICATION',
        'outlet_view.outlet_qualification' => 'OUTLET_QUALIFICATION',
        'OutletRegno' => 'OUTLET_REGNO',
        'OutletView.OutletRegno' => 'OUTLET_REGNO',
        'outletRegno' => 'OUTLET_REGNO',
        'outletView.outletRegno' => 'OUTLET_REGNO',
        'OutletViewTableMap::COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'outlet_regno' => 'OUTLET_REGNO',
        'outlet_view.outlet_regno' => 'OUTLET_REGNO',
        'OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'OutletView.OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'outletView.outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'OutletViewTableMap::COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'outlet_view.outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'OutletMedia' => 'OUTLET_MEDIA',
        'OutletView.OutletMedia' => 'OUTLET_MEDIA',
        'outletMedia' => 'OUTLET_MEDIA',
        'outletView.outletMedia' => 'OUTLET_MEDIA',
        'OutletViewTableMap::COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'outlet_media' => 'OUTLET_MEDIA',
        'outlet_view.outlet_media' => 'OUTLET_MEDIA',
        'AddressName' => 'ADDRESS_NAME',
        'OutletView.AddressName' => 'ADDRESS_NAME',
        'addressName' => 'ADDRESS_NAME',
        'outletView.addressName' => 'ADDRESS_NAME',
        'OutletViewTableMap::COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'address_name' => 'ADDRESS_NAME',
        'outlet_view.address_name' => 'ADDRESS_NAME',
        'OutletAddress' => 'OUTLET_ADDRESS',
        'OutletView.OutletAddress' => 'OUTLET_ADDRESS',
        'outletAddress' => 'OUTLET_ADDRESS',
        'outletView.outletAddress' => 'OUTLET_ADDRESS',
        'OutletViewTableMap::COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'outlet_address' => 'OUTLET_ADDRESS',
        'outlet_view.outlet_address' => 'OUTLET_ADDRESS',
        'OutletStreetName' => 'OUTLET_STREET_NAME',
        'OutletView.OutletStreetName' => 'OUTLET_STREET_NAME',
        'outletStreetName' => 'OUTLET_STREET_NAME',
        'outletView.outletStreetName' => 'OUTLET_STREET_NAME',
        'OutletViewTableMap::COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'outlet_street_name' => 'OUTLET_STREET_NAME',
        'outlet_view.outlet_street_name' => 'OUTLET_STREET_NAME',
        'OutletCity' => 'OUTLET_CITY',
        'OutletView.OutletCity' => 'OUTLET_CITY',
        'outletCity' => 'OUTLET_CITY',
        'outletView.outletCity' => 'OUTLET_CITY',
        'OutletViewTableMap::COL_OUTLET_CITY' => 'OUTLET_CITY',
        'COL_OUTLET_CITY' => 'OUTLET_CITY',
        'outlet_city' => 'OUTLET_CITY',
        'outlet_view.outlet_city' => 'OUTLET_CITY',
        'OutletState' => 'OUTLET_STATE',
        'OutletView.OutletState' => 'OUTLET_STATE',
        'outletState' => 'OUTLET_STATE',
        'outletView.outletState' => 'OUTLET_STATE',
        'OutletViewTableMap::COL_OUTLET_STATE' => 'OUTLET_STATE',
        'COL_OUTLET_STATE' => 'OUTLET_STATE',
        'outlet_state' => 'OUTLET_STATE',
        'outlet_view.outlet_state' => 'OUTLET_STATE',
        'OutletCountry' => 'OUTLET_COUNTRY',
        'OutletView.OutletCountry' => 'OUTLET_COUNTRY',
        'outletCountry' => 'OUTLET_COUNTRY',
        'outletView.outletCountry' => 'OUTLET_COUNTRY',
        'OutletViewTableMap::COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'outlet_country' => 'OUTLET_COUNTRY',
        'outlet_view.outlet_country' => 'OUTLET_COUNTRY',
        'OutletPincode' => 'OUTLET_PINCODE',
        'OutletView.OutletPincode' => 'OUTLET_PINCODE',
        'outletPincode' => 'OUTLET_PINCODE',
        'outletView.outletPincode' => 'OUTLET_PINCODE',
        'OutletViewTableMap::COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'outlet_pincode' => 'OUTLET_PINCODE',
        'outlet_view.outlet_pincode' => 'OUTLET_PINCODE',
        'LastVisitDate' => 'LAST_VISIT_DATE',
        'OutletView.LastVisitDate' => 'LAST_VISIT_DATE',
        'lastVisitDate' => 'LAST_VISIT_DATE',
        'outletView.lastVisitDate' => 'LAST_VISIT_DATE',
        'OutletViewTableMap::COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'last_visit_date' => 'LAST_VISIT_DATE',
        'outlet_view.last_visit_date' => 'LAST_VISIT_DATE',
        'LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'OutletView.LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'outletView.lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'outlet_view.last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'OutletOrgCode' => 'OUTLET_ORG_CODE',
        'OutletView.OutletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgCode' => 'OUTLET_ORG_CODE',
        'outletView.outletOrgCode' => 'OUTLET_ORG_CODE',
        'OutletViewTableMap::COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'outlet_org_code' => 'OUTLET_ORG_CODE',
        'outlet_view.outlet_org_code' => 'OUTLET_ORG_CODE',
        'SgpiBrandMap' => 'SGPI_BRAND_MAP',
        'OutletView.SgpiBrandMap' => 'SGPI_BRAND_MAP',
        'sgpiBrandMap' => 'SGPI_BRAND_MAP',
        'outletView.sgpiBrandMap' => 'SGPI_BRAND_MAP',
        'OutletViewTableMap::COL_SGPI_BRAND_MAP' => 'SGPI_BRAND_MAP',
        'COL_SGPI_BRAND_MAP' => 'SGPI_BRAND_MAP',
        'sgpi_brand_map' => 'SGPI_BRAND_MAP',
        'outlet_view.sgpi_brand_map' => 'SGPI_BRAND_MAP',
        'SgpiBrandIdMap' => 'SGPI_BRAND_ID_MAP',
        'OutletView.SgpiBrandIdMap' => 'SGPI_BRAND_ID_MAP',
        'sgpiBrandIdMap' => 'SGPI_BRAND_ID_MAP',
        'outletView.sgpiBrandIdMap' => 'SGPI_BRAND_ID_MAP',
        'OutletViewTableMap::COL_SGPI_BRAND_ID_MAP' => 'SGPI_BRAND_ID_MAP',
        'COL_SGPI_BRAND_ID_MAP' => 'SGPI_BRAND_ID_MAP',
        'sgpi_brand_id_map' => 'SGPI_BRAND_ID_MAP',
        'outlet_view.sgpi_brand_id_map' => 'SGPI_BRAND_ID_MAP',
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
        $this->setName('outlet_view');
        $this->setPhpName('OutletView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('outlet_org_id', 'OutletOrgId', 'INTEGER', true, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', false, 50, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, 50, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 50, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('comments', 'Comments', 'VARCHAR', false, 50, null);
        $this->addColumn('org_potential', 'OrgPotential', 'INTEGER', false, null, null);
        $this->addColumn('brand_focus', 'BrandFocus', 'VARCHAR', false, 50, null);
        $this->addColumn('customer_fq', 'CustomerFq', 'VARCHAR', false, 50, null);
        $this->addColumn('id', 'Outlet_Id', 'INTEGER', false, null, null);
        $this->addColumn('outlet_media_id', 'OutletMediaId', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_email', 'OutletEmail', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'INTEGER', false, null, null);
        $this->addColumn('classification', 'Classification', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_opening_date', 'OutletOpening_date', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_name', 'OutletContactName', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_landlineno', 'OutletLandlineno', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_alt_landlineno', 'OutletAltLandlineno', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_contact_bday', 'OutletContactBday', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_anniversary', 'OutletContactAnniversary', 'DATE', false, null, null);
        $this->addColumn('outlet_isd_code', 'OutletIsdCode', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_contact_no', 'OutletContactNo', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_alt_contact_no', 'OutletAltContactNo', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_status', 'OutletStatus', 'VARCHAR', false, 50, null);
        $this->addColumn('outlettype_id', 'OutlettypeId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, 50, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_otp', 'OutletOtp', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_verified', 'OutletVerified', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_created_by', 'OutletCreatedBy', 'INTEGER', false, null, null);
        $this->addColumn('outlet_approved_by', 'OutletApprovedBy', 'INTEGER', false, null, null);
        $this->addColumn('outlet_potential', 'OutletPotential', 'VARCHAR', false, 50, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
        $this->addColumn('itownid', 'Itownid', 'INTEGER', false, null, null);
        $this->addColumn('outlet_qualification', 'OutletQualification', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_regno', 'OutletRegno', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_marital_status', 'OutletMaritalStatus', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_media', 'OutletMedia', 'VARCHAR', false, 50, null);
        $this->addColumn('address_name', 'AddressName', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_address', 'OutletAddress', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_street_name', 'OutletStreetName', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_city', 'OutletCity', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_state', 'OutletState', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_country', 'OutletCountry', 'VARCHAR', false, 150, null);
        $this->addColumn('outlet_pincode', 'OutletPincode', 'VARCHAR', false, 150, null);
        $this->addColumn('last_visit_date', 'LastVisitDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_visit_employee', 'LastVisitEmployee', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_code', 'OutletOrgCode', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_brand_map', 'SgpiBrandMap', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_brand_id_map', 'SgpiBrandIdMap', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletViewTableMap::CLASS_DEFAULT : OutletViewTableMap::OM_CLASS;
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
     * @return array (OutletView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletViewTableMap::OM_CLASS;
            /** @var OutletView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_TAGS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(OutletViewTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_ORG_POTENTIAL);
            $criteria->addSelectColumn(OutletViewTableMap::COL_BRAND_FOCUS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_CUSTOMER_FQ);
            $criteria->addSelectColumn(OutletViewTableMap::COL_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_MEDIA_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_EMAIL);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(OutletViewTableMap::COL_CLASSIFICATION);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_LANDLINENO);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ISD_CODE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_STATUS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletViewTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_OTP);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_VERIFIED);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CREATED_BY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_APPROVED_BY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_POTENTIAL);
            $criteria->addSelectColumn(OutletViewTableMap::COL_INTEGRATION_ID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_REGNO);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_MEDIA);
            $criteria->addSelectColumn(OutletViewTableMap::COL_ADDRESS_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_CITY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_STATE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_PINCODE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_LAST_VISIT_DATE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_OUTLET_ORG_CODE);
            $criteria->addSelectColumn(OutletViewTableMap::COL_SGPI_BRAND_MAP);
            $criteria->addSelectColumn(OutletViewTableMap::COL_SGPI_BRAND_ID_MAP);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.org_potential');
            $criteria->addSelectColumn($alias . '.brand_focus');
            $criteria->addSelectColumn($alias . '.customer_fq');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.outlet_media_id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_email');
            $criteria->addSelectColumn($alias . '.outlet_salutation');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.classification');
            $criteria->addSelectColumn($alias . '.outlet_opening_date');
            $criteria->addSelectColumn($alias . '.outlet_contact_name');
            $criteria->addSelectColumn($alias . '.outlet_landlineno');
            $criteria->addSelectColumn($alias . '.outlet_alt_landlineno');
            $criteria->addSelectColumn($alias . '.outlet_contact_bday');
            $criteria->addSelectColumn($alias . '.outlet_contact_anniversary');
            $criteria->addSelectColumn($alias . '.outlet_isd_code');
            $criteria->addSelectColumn($alias . '.outlet_contact_no');
            $criteria->addSelectColumn($alias . '.outlet_alt_contact_no');
            $criteria->addSelectColumn($alias . '.outlet_status');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlet_otp');
            $criteria->addSelectColumn($alias . '.outlet_verified');
            $criteria->addSelectColumn($alias . '.outlet_created_by');
            $criteria->addSelectColumn($alias . '.outlet_approved_by');
            $criteria->addSelectColumn($alias . '.outlet_potential');
            $criteria->addSelectColumn($alias . '.integration_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.outlet_qualification');
            $criteria->addSelectColumn($alias . '.outlet_regno');
            $criteria->addSelectColumn($alias . '.outlet_marital_status');
            $criteria->addSelectColumn($alias . '.outlet_media');
            $criteria->addSelectColumn($alias . '.address_name');
            $criteria->addSelectColumn($alias . '.outlet_address');
            $criteria->addSelectColumn($alias . '.outlet_street_name');
            $criteria->addSelectColumn($alias . '.outlet_city');
            $criteria->addSelectColumn($alias . '.outlet_state');
            $criteria->addSelectColumn($alias . '.outlet_country');
            $criteria->addSelectColumn($alias . '.outlet_pincode');
            $criteria->addSelectColumn($alias . '.last_visit_date');
            $criteria->addSelectColumn($alias . '.last_visit_employee');
            $criteria->addSelectColumn($alias . '.outlet_org_code');
            $criteria->addSelectColumn($alias . '.sgpi_brand_map');
            $criteria->addSelectColumn($alias . '.sgpi_brand_id_map');
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
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_TAGS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_ORG_POTENTIAL);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_BRAND_FOCUS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_CUSTOMER_FQ);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_MEDIA_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_EMAIL);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_CLASSIFICATION);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_LANDLINENO);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ISD_CODE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_STATUS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_OTP);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_VERIFIED);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CREATED_BY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_APPROVED_BY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_POTENTIAL);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_INTEGRATION_ID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_REGNO);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_MEDIA);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_ADDRESS_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_CITY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_STATE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_PINCODE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_LAST_VISIT_DATE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_OUTLET_ORG_CODE);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_SGPI_BRAND_MAP);
            $criteria->removeSelectColumn(OutletViewTableMap::COL_SGPI_BRAND_ID_MAP);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.org_potential');
            $criteria->removeSelectColumn($alias . '.brand_focus');
            $criteria->removeSelectColumn($alias . '.customer_fq');
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.outlet_media_id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_email');
            $criteria->removeSelectColumn($alias . '.outlet_salutation');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.classification');
            $criteria->removeSelectColumn($alias . '.outlet_opening_date');
            $criteria->removeSelectColumn($alias . '.outlet_contact_name');
            $criteria->removeSelectColumn($alias . '.outlet_landlineno');
            $criteria->removeSelectColumn($alias . '.outlet_alt_landlineno');
            $criteria->removeSelectColumn($alias . '.outlet_contact_bday');
            $criteria->removeSelectColumn($alias . '.outlet_contact_anniversary');
            $criteria->removeSelectColumn($alias . '.outlet_isd_code');
            $criteria->removeSelectColumn($alias . '.outlet_contact_no');
            $criteria->removeSelectColumn($alias . '.outlet_alt_contact_no');
            $criteria->removeSelectColumn($alias . '.outlet_status');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlet_otp');
            $criteria->removeSelectColumn($alias . '.outlet_verified');
            $criteria->removeSelectColumn($alias . '.outlet_created_by');
            $criteria->removeSelectColumn($alias . '.outlet_approved_by');
            $criteria->removeSelectColumn($alias . '.outlet_potential');
            $criteria->removeSelectColumn($alias . '.integration_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.outlet_qualification');
            $criteria->removeSelectColumn($alias . '.outlet_regno');
            $criteria->removeSelectColumn($alias . '.outlet_marital_status');
            $criteria->removeSelectColumn($alias . '.outlet_media');
            $criteria->removeSelectColumn($alias . '.address_name');
            $criteria->removeSelectColumn($alias . '.outlet_address');
            $criteria->removeSelectColumn($alias . '.outlet_street_name');
            $criteria->removeSelectColumn($alias . '.outlet_city');
            $criteria->removeSelectColumn($alias . '.outlet_state');
            $criteria->removeSelectColumn($alias . '.outlet_country');
            $criteria->removeSelectColumn($alias . '.outlet_pincode');
            $criteria->removeSelectColumn($alias . '.last_visit_date');
            $criteria->removeSelectColumn($alias . '.last_visit_employee');
            $criteria->removeSelectColumn($alias . '.outlet_org_code');
            $criteria->removeSelectColumn($alias . '.sgpi_brand_map');
            $criteria->removeSelectColumn($alias . '.sgpi_brand_id_map');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletViewTableMap::DATABASE_NAME)->getTable(OutletViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletViewTableMap::DATABASE_NAME);
            $criteria->add(OutletViewTableMap::COL_OUTLET_ORG_ID, (array) $values, Criteria::IN);
        }

        $query = OutletViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletView or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletView object
        }


        // Set the correct dbName
        $query = OutletViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

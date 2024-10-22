<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\CustomerdataView;
use entities\CustomerdataViewQuery;


/**
 * This class defines the structure of the 'customerdata_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CustomerdataViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CustomerdataViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'customerdata_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'CustomerdataView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\CustomerdataView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.CustomerdataView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 55;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 55;

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'customerdata_view.employee_code';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'customerdata_view.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'customerdata_view.last_name';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'customerdata_view.phone';

    /**
     * the column name for the position_code field
     */
    public const COL_POSITION_CODE = 'customerdata_view.position_code';

    /**
     * the column name for the ood_itownid field
     */
    public const COL_OOD_ITOWNID = 'customerdata_view.ood_itownid';

    /**
     * the column name for the ood_town_code field
     */
    public const COL_OOD_TOWN_CODE = 'customerdata_view.ood_town_code';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'customerdata_view.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'customerdata_view.org_unit_id';

    /**
     * the column name for the id field
     */
    public const COL_ID = 'customerdata_view.id';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'customerdata_view.outlet_code';

    /**
     * the column name for the outlet_org_code field
     */
    public const COL_OUTLET_ORG_CODE = 'customerdata_view.outlet_org_code';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'customerdata_view.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'customerdata_view.territory_name';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'customerdata_view.position_id';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'customerdata_view.position_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'customerdata_view.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'customerdata_view.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'customerdata_view.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'customerdata_view.visit_fq';

    /**
     * the column name for the comments field
     */
    public const COL_COMMENTS = 'customerdata_view.comments';

    /**
     * the column name for the org_potential field
     */
    public const COL_ORG_POTENTIAL = 'customerdata_view.org_potential';

    /**
     * the column name for the brand_focus field
     */
    public const COL_BRAND_FOCUS = 'customerdata_view.brand_focus';

    /**
     * the column name for the customer_fq field
     */
    public const COL_CUSTOMER_FQ = 'customerdata_view.customer_fq';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'customerdata_view.outlet_name';

    /**
     * the column name for the outlet_email field
     */
    public const COL_OUTLET_EMAIL = 'customerdata_view.outlet_email';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'customerdata_view.outlet_salutation';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'customerdata_view.outlet_classification';

    /**
     * the column name for the classification field
     */
    public const COL_CLASSIFICATION = 'customerdata_view.classification';

    /**
     * the column name for the outlet_opening_date field
     */
    public const COL_OUTLET_OPENING_DATE = 'customerdata_view.outlet_opening_date';

    /**
     * the column name for the outlet_contact_name field
     */
    public const COL_OUTLET_CONTACT_NAME = 'customerdata_view.outlet_contact_name';

    /**
     * the column name for the outlet_landlineno field
     */
    public const COL_OUTLET_LANDLINENO = 'customerdata_view.outlet_landlineno';

    /**
     * the column name for the outlet_alt_landlineno field
     */
    public const COL_OUTLET_ALT_LANDLINENO = 'customerdata_view.outlet_alt_landlineno';

    /**
     * the column name for the outlet_contact_bday field
     */
    public const COL_OUTLET_CONTACT_BDAY = 'customerdata_view.outlet_contact_bday';

    /**
     * the column name for the outlet_contact_anniversary field
     */
    public const COL_OUTLET_CONTACT_ANNIVERSARY = 'customerdata_view.outlet_contact_anniversary';

    /**
     * the column name for the outlet_isd_code field
     */
    public const COL_OUTLET_ISD_CODE = 'customerdata_view.outlet_isd_code';

    /**
     * the column name for the outlet_contact_no field
     */
    public const COL_OUTLET_CONTACT_NO = 'customerdata_view.outlet_contact_no';

    /**
     * the column name for the outlet_alt_contact_no field
     */
    public const COL_OUTLET_ALT_CONTACT_NO = 'customerdata_view.outlet_alt_contact_no';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'customerdata_view.outlettype_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'customerdata_view.outlettype_name';

    /**
     * the column name for the outlet_potential field
     */
    public const COL_OUTLET_POTENTIAL = 'customerdata_view.outlet_potential';

    /**
     * the column name for the outlet_qualification field
     */
    public const COL_OUTLET_QUALIFICATION = 'customerdata_view.outlet_qualification';

    /**
     * the column name for the outlet_regno field
     */
    public const COL_OUTLET_REGNO = 'customerdata_view.outlet_regno';

    /**
     * the column name for the outlet_marital_status field
     */
    public const COL_OUTLET_MARITAL_STATUS = 'customerdata_view.outlet_marital_status';

    /**
     * the column name for the outlet_media field
     */
    public const COL_OUTLET_MEDIA = 'customerdata_view.outlet_media';

    /**
     * the column name for the address_name field
     */
    public const COL_ADDRESS_NAME = 'customerdata_view.address_name';

    /**
     * the column name for the outlet_address field
     */
    public const COL_OUTLET_ADDRESS = 'customerdata_view.outlet_address';

    /**
     * the column name for the outlet_street_name field
     */
    public const COL_OUTLET_STREET_NAME = 'customerdata_view.outlet_street_name';

    /**
     * the column name for the outlet_city field
     */
    public const COL_OUTLET_CITY = 'customerdata_view.outlet_city';

    /**
     * the column name for the outlet_state field
     */
    public const COL_OUTLET_STATE = 'customerdata_view.outlet_state';

    /**
     * the column name for the outlet_country field
     */
    public const COL_OUTLET_COUNTRY = 'customerdata_view.outlet_country';

    /**
     * the column name for the outlet_pincode field
     */
    public const COL_OUTLET_PINCODE = 'customerdata_view.outlet_pincode';

    /**
     * the column name for the last_visit_date field
     */
    public const COL_LAST_VISIT_DATE = 'customerdata_view.last_visit_date';

    /**
     * the column name for the last_visit_employee field
     */
    public const COL_LAST_VISIT_EMPLOYEE = 'customerdata_view.last_visit_employee';

    /**
     * the column name for the outlet_status field
     */
    public const COL_OUTLET_STATUS = 'customerdata_view.outlet_status';

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
        self::TYPE_PHPNAME       => ['EmployeeCode', 'FirstName', 'LastName', 'Phone', 'PositionCode', 'OodItownid', 'OodTownCode', 'OutletOrgId', 'OrgUnitId', 'Id', 'OutletCode', 'OutletOrgCode', 'TerritoryId', 'TerritoryName', 'PositionId', 'PositionName', 'BeatId', 'BeatName', 'Tags', 'VisitFq', 'Comments', 'OrgPotential', 'BrandFocus', 'CustomerFq', 'OutletName', 'OutletEmail', 'OutletSalutation', 'OutletClassification', 'Classification', 'OutletOpeningDate', 'OutletContactName', 'OutletLandlineno', 'OutletAltLandlineno', 'OutletContactBday', 'OutletContactAnniversary', 'OutletIsdCode', 'OutletContactNo', 'OutletAltContactNo', 'outlettype_id', 'OutlettypeName', 'OutletPotential', 'OutletQualification', 'OutletRegno', 'OutletMaritalStatus', 'OutletMedia', 'AddressName', 'OutletAddress', 'OutletStreetName', 'OutletCity', 'OutletState', 'OutletCountry', 'OutletPincode', 'LastVisitDate', 'LastVisitEmployee', 'OutletStatus', ],
        self::TYPE_CAMELNAME     => ['employeeCode', 'firstName', 'lastName', 'phone', 'positionCode', 'oodItownid', 'oodTownCode', 'outletOrgId', 'orgUnitId', 'id', 'outletCode', 'outletOrgCode', 'territoryId', 'territoryName', 'positionId', 'positionName', 'beatId', 'beatName', 'tags', 'visitFq', 'comments', 'orgPotential', 'brandFocus', 'customerFq', 'outletName', 'outletEmail', 'outletSalutation', 'outletClassification', 'classification', 'outletOpeningDate', 'outletContactName', 'outletLandlineno', 'outletAltLandlineno', 'outletContactBday', 'outletContactAnniversary', 'outletIsdCode', 'outletContactNo', 'outletAltContactNo', 'outlettype_id', 'outlettypeName', 'outletPotential', 'outletQualification', 'outletRegno', 'outletMaritalStatus', 'outletMedia', 'addressName', 'outletAddress', 'outletStreetName', 'outletCity', 'outletState', 'outletCountry', 'outletPincode', 'lastVisitDate', 'lastVisitEmployee', 'outletStatus', ],
        self::TYPE_COLNAME       => [CustomerdataViewTableMap::COL_EMPLOYEE_CODE, CustomerdataViewTableMap::COL_FIRST_NAME, CustomerdataViewTableMap::COL_LAST_NAME, CustomerdataViewTableMap::COL_PHONE, CustomerdataViewTableMap::COL_POSITION_CODE, CustomerdataViewTableMap::COL_OOD_ITOWNID, CustomerdataViewTableMap::COL_OOD_TOWN_CODE, CustomerdataViewTableMap::COL_OUTLET_ORG_ID, CustomerdataViewTableMap::COL_ORG_UNIT_ID, CustomerdataViewTableMap::COL_ID, CustomerdataViewTableMap::COL_OUTLET_CODE, CustomerdataViewTableMap::COL_OUTLET_ORG_CODE, CustomerdataViewTableMap::COL_TERRITORY_ID, CustomerdataViewTableMap::COL_TERRITORY_NAME, CustomerdataViewTableMap::COL_POSITION_ID, CustomerdataViewTableMap::COL_POSITION_NAME, CustomerdataViewTableMap::COL_BEAT_ID, CustomerdataViewTableMap::COL_BEAT_NAME, CustomerdataViewTableMap::COL_TAGS, CustomerdataViewTableMap::COL_VISIT_FQ, CustomerdataViewTableMap::COL_COMMENTS, CustomerdataViewTableMap::COL_ORG_POTENTIAL, CustomerdataViewTableMap::COL_BRAND_FOCUS, CustomerdataViewTableMap::COL_CUSTOMER_FQ, CustomerdataViewTableMap::COL_OUTLET_NAME, CustomerdataViewTableMap::COL_OUTLET_EMAIL, CustomerdataViewTableMap::COL_OUTLET_SALUTATION, CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION, CustomerdataViewTableMap::COL_CLASSIFICATION, CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE, CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME, CustomerdataViewTableMap::COL_OUTLET_LANDLINENO, CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO, CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY, CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, CustomerdataViewTableMap::COL_OUTLET_ISD_CODE, CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO, CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO, CustomerdataViewTableMap::COL_OUTLETTYPE_ID, CustomerdataViewTableMap::COL_OUTLETTYPE_NAME, CustomerdataViewTableMap::COL_OUTLET_POTENTIAL, CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION, CustomerdataViewTableMap::COL_OUTLET_REGNO, CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS, CustomerdataViewTableMap::COL_OUTLET_MEDIA, CustomerdataViewTableMap::COL_ADDRESS_NAME, CustomerdataViewTableMap::COL_OUTLET_ADDRESS, CustomerdataViewTableMap::COL_OUTLET_STREET_NAME, CustomerdataViewTableMap::COL_OUTLET_CITY, CustomerdataViewTableMap::COL_OUTLET_STATE, CustomerdataViewTableMap::COL_OUTLET_COUNTRY, CustomerdataViewTableMap::COL_OUTLET_PINCODE, CustomerdataViewTableMap::COL_LAST_VISIT_DATE, CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE, CustomerdataViewTableMap::COL_OUTLET_STATUS, ],
        self::TYPE_FIELDNAME     => ['employee_code', 'first_name', 'last_name', 'phone', 'position_code', 'ood_itownid', 'ood_town_code', 'outlet_org_id', 'org_unit_id', 'id', 'outlet_code', 'outlet_org_code', 'territory_id', 'territory_name', 'position_id', 'position_name', 'beat_id', 'beat_name', 'tags', 'visit_fq', 'comments', 'org_potential', 'brand_focus', 'customer_fq', 'outlet_name', 'outlet_email', 'outlet_salutation', 'outlet_classification', 'classification', 'outlet_opening_date', 'outlet_contact_name', 'outlet_landlineno', 'outlet_alt_landlineno', 'outlet_contact_bday', 'outlet_contact_anniversary', 'outlet_isd_code', 'outlet_contact_no', 'outlet_alt_contact_no', 'outlettype_id', 'outlettype_name', 'outlet_potential', 'outlet_qualification', 'outlet_regno', 'outlet_marital_status', 'outlet_media', 'address_name', 'outlet_address', 'outlet_street_name', 'outlet_city', 'outlet_state', 'outlet_country', 'outlet_pincode', 'last_visit_date', 'last_visit_employee', 'outlet_status', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, ]
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
        self::TYPE_PHPNAME       => ['EmployeeCode' => 0, 'FirstName' => 1, 'LastName' => 2, 'Phone' => 3, 'PositionCode' => 4, 'OodItownid' => 5, 'OodTownCode' => 6, 'OutletOrgId' => 7, 'OrgUnitId' => 8, 'Id' => 9, 'OutletCode' => 10, 'OutletOrgCode' => 11, 'TerritoryId' => 12, 'TerritoryName' => 13, 'PositionId' => 14, 'PositionName' => 15, 'BeatId' => 16, 'BeatName' => 17, 'Tags' => 18, 'VisitFq' => 19, 'Comments' => 20, 'OrgPotential' => 21, 'BrandFocus' => 22, 'CustomerFq' => 23, 'OutletName' => 24, 'OutletEmail' => 25, 'OutletSalutation' => 26, 'OutletClassification' => 27, 'Classification' => 28, 'OutletOpeningDate' => 29, 'OutletContactName' => 30, 'OutletLandlineno' => 31, 'OutletAltLandlineno' => 32, 'OutletContactBday' => 33, 'OutletContactAnniversary' => 34, 'OutletIsdCode' => 35, 'OutletContactNo' => 36, 'OutletAltContactNo' => 37, 'outlettype_id' => 38, 'OutlettypeName' => 39, 'OutletPotential' => 40, 'OutletQualification' => 41, 'OutletRegno' => 42, 'OutletMaritalStatus' => 43, 'OutletMedia' => 44, 'AddressName' => 45, 'OutletAddress' => 46, 'OutletStreetName' => 47, 'OutletCity' => 48, 'OutletState' => 49, 'OutletCountry' => 50, 'OutletPincode' => 51, 'LastVisitDate' => 52, 'LastVisitEmployee' => 53, 'OutletStatus' => 54, ],
        self::TYPE_CAMELNAME     => ['employeeCode' => 0, 'firstName' => 1, 'lastName' => 2, 'phone' => 3, 'positionCode' => 4, 'oodItownid' => 5, 'oodTownCode' => 6, 'outletOrgId' => 7, 'orgUnitId' => 8, 'id' => 9, 'outletCode' => 10, 'outletOrgCode' => 11, 'territoryId' => 12, 'territoryName' => 13, 'positionId' => 14, 'positionName' => 15, 'beatId' => 16, 'beatName' => 17, 'tags' => 18, 'visitFq' => 19, 'comments' => 20, 'orgPotential' => 21, 'brandFocus' => 22, 'customerFq' => 23, 'outletName' => 24, 'outletEmail' => 25, 'outletSalutation' => 26, 'outletClassification' => 27, 'classification' => 28, 'outletOpeningDate' => 29, 'outletContactName' => 30, 'outletLandlineno' => 31, 'outletAltLandlineno' => 32, 'outletContactBday' => 33, 'outletContactAnniversary' => 34, 'outletIsdCode' => 35, 'outletContactNo' => 36, 'outletAltContactNo' => 37, 'outlettype_id' => 38, 'outlettypeName' => 39, 'outletPotential' => 40, 'outletQualification' => 41, 'outletRegno' => 42, 'outletMaritalStatus' => 43, 'outletMedia' => 44, 'addressName' => 45, 'outletAddress' => 46, 'outletStreetName' => 47, 'outletCity' => 48, 'outletState' => 49, 'outletCountry' => 50, 'outletPincode' => 51, 'lastVisitDate' => 52, 'lastVisitEmployee' => 53, 'outletStatus' => 54, ],
        self::TYPE_COLNAME       => [CustomerdataViewTableMap::COL_EMPLOYEE_CODE => 0, CustomerdataViewTableMap::COL_FIRST_NAME => 1, CustomerdataViewTableMap::COL_LAST_NAME => 2, CustomerdataViewTableMap::COL_PHONE => 3, CustomerdataViewTableMap::COL_POSITION_CODE => 4, CustomerdataViewTableMap::COL_OOD_ITOWNID => 5, CustomerdataViewTableMap::COL_OOD_TOWN_CODE => 6, CustomerdataViewTableMap::COL_OUTLET_ORG_ID => 7, CustomerdataViewTableMap::COL_ORG_UNIT_ID => 8, CustomerdataViewTableMap::COL_ID => 9, CustomerdataViewTableMap::COL_OUTLET_CODE => 10, CustomerdataViewTableMap::COL_OUTLET_ORG_CODE => 11, CustomerdataViewTableMap::COL_TERRITORY_ID => 12, CustomerdataViewTableMap::COL_TERRITORY_NAME => 13, CustomerdataViewTableMap::COL_POSITION_ID => 14, CustomerdataViewTableMap::COL_POSITION_NAME => 15, CustomerdataViewTableMap::COL_BEAT_ID => 16, CustomerdataViewTableMap::COL_BEAT_NAME => 17, CustomerdataViewTableMap::COL_TAGS => 18, CustomerdataViewTableMap::COL_VISIT_FQ => 19, CustomerdataViewTableMap::COL_COMMENTS => 20, CustomerdataViewTableMap::COL_ORG_POTENTIAL => 21, CustomerdataViewTableMap::COL_BRAND_FOCUS => 22, CustomerdataViewTableMap::COL_CUSTOMER_FQ => 23, CustomerdataViewTableMap::COL_OUTLET_NAME => 24, CustomerdataViewTableMap::COL_OUTLET_EMAIL => 25, CustomerdataViewTableMap::COL_OUTLET_SALUTATION => 26, CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION => 27, CustomerdataViewTableMap::COL_CLASSIFICATION => 28, CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE => 29, CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME => 30, CustomerdataViewTableMap::COL_OUTLET_LANDLINENO => 31, CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO => 32, CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY => 33, CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY => 34, CustomerdataViewTableMap::COL_OUTLET_ISD_CODE => 35, CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO => 36, CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO => 37, CustomerdataViewTableMap::COL_OUTLETTYPE_ID => 38, CustomerdataViewTableMap::COL_OUTLETTYPE_NAME => 39, CustomerdataViewTableMap::COL_OUTLET_POTENTIAL => 40, CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION => 41, CustomerdataViewTableMap::COL_OUTLET_REGNO => 42, CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS => 43, CustomerdataViewTableMap::COL_OUTLET_MEDIA => 44, CustomerdataViewTableMap::COL_ADDRESS_NAME => 45, CustomerdataViewTableMap::COL_OUTLET_ADDRESS => 46, CustomerdataViewTableMap::COL_OUTLET_STREET_NAME => 47, CustomerdataViewTableMap::COL_OUTLET_CITY => 48, CustomerdataViewTableMap::COL_OUTLET_STATE => 49, CustomerdataViewTableMap::COL_OUTLET_COUNTRY => 50, CustomerdataViewTableMap::COL_OUTLET_PINCODE => 51, CustomerdataViewTableMap::COL_LAST_VISIT_DATE => 52, CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE => 53, CustomerdataViewTableMap::COL_OUTLET_STATUS => 54, ],
        self::TYPE_FIELDNAME     => ['employee_code' => 0, 'first_name' => 1, 'last_name' => 2, 'phone' => 3, 'position_code' => 4, 'ood_itownid' => 5, 'ood_town_code' => 6, 'outlet_org_id' => 7, 'org_unit_id' => 8, 'id' => 9, 'outlet_code' => 10, 'outlet_org_code' => 11, 'territory_id' => 12, 'territory_name' => 13, 'position_id' => 14, 'position_name' => 15, 'beat_id' => 16, 'beat_name' => 17, 'tags' => 18, 'visit_fq' => 19, 'comments' => 20, 'org_potential' => 21, 'brand_focus' => 22, 'customer_fq' => 23, 'outlet_name' => 24, 'outlet_email' => 25, 'outlet_salutation' => 26, 'outlet_classification' => 27, 'classification' => 28, 'outlet_opening_date' => 29, 'outlet_contact_name' => 30, 'outlet_landlineno' => 31, 'outlet_alt_landlineno' => 32, 'outlet_contact_bday' => 33, 'outlet_contact_anniversary' => 34, 'outlet_isd_code' => 35, 'outlet_contact_no' => 36, 'outlet_alt_contact_no' => 37, 'outlettype_id' => 38, 'outlettype_name' => 39, 'outlet_potential' => 40, 'outlet_qualification' => 41, 'outlet_regno' => 42, 'outlet_marital_status' => 43, 'outlet_media' => 44, 'address_name' => 45, 'outlet_address' => 46, 'outlet_street_name' => 47, 'outlet_city' => 48, 'outlet_state' => 49, 'outlet_country' => 50, 'outlet_pincode' => 51, 'last_visit_date' => 52, 'last_visit_employee' => 53, 'outlet_status' => 54, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'CustomerdataView.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'customerdataView.employeeCode' => 'EMPLOYEE_CODE',
        'CustomerdataViewTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'customerdata_view.employee_code' => 'EMPLOYEE_CODE',
        'FirstName' => 'FIRST_NAME',
        'CustomerdataView.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'customerdataView.firstName' => 'FIRST_NAME',
        'CustomerdataViewTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'customerdata_view.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'CustomerdataView.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'customerdataView.lastName' => 'LAST_NAME',
        'CustomerdataViewTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'customerdata_view.last_name' => 'LAST_NAME',
        'Phone' => 'PHONE',
        'CustomerdataView.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'customerdataView.phone' => 'PHONE',
        'CustomerdataViewTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'customerdata_view.phone' => 'PHONE',
        'PositionCode' => 'POSITION_CODE',
        'CustomerdataView.PositionCode' => 'POSITION_CODE',
        'positionCode' => 'POSITION_CODE',
        'customerdataView.positionCode' => 'POSITION_CODE',
        'CustomerdataViewTableMap::COL_POSITION_CODE' => 'POSITION_CODE',
        'COL_POSITION_CODE' => 'POSITION_CODE',
        'position_code' => 'POSITION_CODE',
        'customerdata_view.position_code' => 'POSITION_CODE',
        'OodItownid' => 'OOD_ITOWNID',
        'CustomerdataView.OodItownid' => 'OOD_ITOWNID',
        'oodItownid' => 'OOD_ITOWNID',
        'customerdataView.oodItownid' => 'OOD_ITOWNID',
        'CustomerdataViewTableMap::COL_OOD_ITOWNID' => 'OOD_ITOWNID',
        'COL_OOD_ITOWNID' => 'OOD_ITOWNID',
        'ood_itownid' => 'OOD_ITOWNID',
        'customerdata_view.ood_itownid' => 'OOD_ITOWNID',
        'OodTownCode' => 'OOD_TOWN_CODE',
        'CustomerdataView.OodTownCode' => 'OOD_TOWN_CODE',
        'oodTownCode' => 'OOD_TOWN_CODE',
        'customerdataView.oodTownCode' => 'OOD_TOWN_CODE',
        'CustomerdataViewTableMap::COL_OOD_TOWN_CODE' => 'OOD_TOWN_CODE',
        'COL_OOD_TOWN_CODE' => 'OOD_TOWN_CODE',
        'ood_town_code' => 'OOD_TOWN_CODE',
        'customerdata_view.ood_town_code' => 'OOD_TOWN_CODE',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'CustomerdataView.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'customerdataView.outletOrgId' => 'OUTLET_ORG_ID',
        'CustomerdataViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'customerdata_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'CustomerdataView.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'customerdataView.orgUnitId' => 'ORG_UNIT_ID',
        'CustomerdataViewTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'customerdata_view.org_unit_id' => 'ORG_UNIT_ID',
        'Id' => 'ID',
        'CustomerdataView.Id' => 'ID',
        'id' => 'ID',
        'customerdataView.id' => 'ID',
        'CustomerdataViewTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'customerdata_view.id' => 'ID',
        'OutletCode' => 'OUTLET_CODE',
        'CustomerdataView.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'customerdataView.outletCode' => 'OUTLET_CODE',
        'CustomerdataViewTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'customerdata_view.outlet_code' => 'OUTLET_CODE',
        'OutletOrgCode' => 'OUTLET_ORG_CODE',
        'CustomerdataView.OutletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgCode' => 'OUTLET_ORG_CODE',
        'customerdataView.outletOrgCode' => 'OUTLET_ORG_CODE',
        'CustomerdataViewTableMap::COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'outlet_org_code' => 'OUTLET_ORG_CODE',
        'customerdata_view.outlet_org_code' => 'OUTLET_ORG_CODE',
        'TerritoryId' => 'TERRITORY_ID',
        'CustomerdataView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'customerdataView.territoryId' => 'TERRITORY_ID',
        'CustomerdataViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'customerdata_view.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'CustomerdataView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'customerdataView.territoryName' => 'TERRITORY_NAME',
        'CustomerdataViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'customerdata_view.territory_name' => 'TERRITORY_NAME',
        'PositionId' => 'POSITION_ID',
        'CustomerdataView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'customerdataView.positionId' => 'POSITION_ID',
        'CustomerdataViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'customerdata_view.position_id' => 'POSITION_ID',
        'PositionName' => 'POSITION_NAME',
        'CustomerdataView.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'customerdataView.positionName' => 'POSITION_NAME',
        'CustomerdataViewTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'customerdata_view.position_name' => 'POSITION_NAME',
        'BeatId' => 'BEAT_ID',
        'CustomerdataView.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'customerdataView.beatId' => 'BEAT_ID',
        'CustomerdataViewTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'customerdata_view.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'CustomerdataView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'customerdataView.beatName' => 'BEAT_NAME',
        'CustomerdataViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'customerdata_view.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'CustomerdataView.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'customerdataView.tags' => 'TAGS',
        'CustomerdataViewTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'customerdata_view.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'CustomerdataView.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'customerdataView.visitFq' => 'VISIT_FQ',
        'CustomerdataViewTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'customerdata_view.visit_fq' => 'VISIT_FQ',
        'Comments' => 'COMMENTS',
        'CustomerdataView.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'customerdataView.comments' => 'COMMENTS',
        'CustomerdataViewTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'customerdata_view.comments' => 'COMMENTS',
        'OrgPotential' => 'ORG_POTENTIAL',
        'CustomerdataView.OrgPotential' => 'ORG_POTENTIAL',
        'orgPotential' => 'ORG_POTENTIAL',
        'customerdataView.orgPotential' => 'ORG_POTENTIAL',
        'CustomerdataViewTableMap::COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'org_potential' => 'ORG_POTENTIAL',
        'customerdata_view.org_potential' => 'ORG_POTENTIAL',
        'BrandFocus' => 'BRAND_FOCUS',
        'CustomerdataView.BrandFocus' => 'BRAND_FOCUS',
        'brandFocus' => 'BRAND_FOCUS',
        'customerdataView.brandFocus' => 'BRAND_FOCUS',
        'CustomerdataViewTableMap::COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'brand_focus' => 'BRAND_FOCUS',
        'customerdata_view.brand_focus' => 'BRAND_FOCUS',
        'CustomerFq' => 'CUSTOMER_FQ',
        'CustomerdataView.CustomerFq' => 'CUSTOMER_FQ',
        'customerFq' => 'CUSTOMER_FQ',
        'customerdataView.customerFq' => 'CUSTOMER_FQ',
        'CustomerdataViewTableMap::COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'customer_fq' => 'CUSTOMER_FQ',
        'customerdata_view.customer_fq' => 'CUSTOMER_FQ',
        'OutletName' => 'OUTLET_NAME',
        'CustomerdataView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'customerdataView.outletName' => 'OUTLET_NAME',
        'CustomerdataViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'customerdata_view.outlet_name' => 'OUTLET_NAME',
        'OutletEmail' => 'OUTLET_EMAIL',
        'CustomerdataView.OutletEmail' => 'OUTLET_EMAIL',
        'outletEmail' => 'OUTLET_EMAIL',
        'customerdataView.outletEmail' => 'OUTLET_EMAIL',
        'CustomerdataViewTableMap::COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'outlet_email' => 'OUTLET_EMAIL',
        'customerdata_view.outlet_email' => 'OUTLET_EMAIL',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'CustomerdataView.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'customerdataView.outletSalutation' => 'OUTLET_SALUTATION',
        'CustomerdataViewTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'customerdata_view.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'CustomerdataView.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'customerdataView.outletClassification' => 'OUTLET_CLASSIFICATION',
        'CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'customerdata_view.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'Classification' => 'CLASSIFICATION',
        'CustomerdataView.Classification' => 'CLASSIFICATION',
        'classification' => 'CLASSIFICATION',
        'customerdataView.classification' => 'CLASSIFICATION',
        'CustomerdataViewTableMap::COL_CLASSIFICATION' => 'CLASSIFICATION',
        'COL_CLASSIFICATION' => 'CLASSIFICATION',
        'customerdata_view.classification' => 'CLASSIFICATION',
        'OutletOpeningDate' => 'OUTLET_OPENING_DATE',
        'CustomerdataView.OutletOpeningDate' => 'OUTLET_OPENING_DATE',
        'outletOpeningDate' => 'OUTLET_OPENING_DATE',
        'customerdataView.outletOpeningDate' => 'OUTLET_OPENING_DATE',
        'CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'customerdata_view.outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'OutletContactName' => 'OUTLET_CONTACT_NAME',
        'CustomerdataView.OutletContactName' => 'OUTLET_CONTACT_NAME',
        'outletContactName' => 'OUTLET_CONTACT_NAME',
        'customerdataView.outletContactName' => 'OUTLET_CONTACT_NAME',
        'CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'customerdata_view.outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'OutletLandlineno' => 'OUTLET_LANDLINENO',
        'CustomerdataView.OutletLandlineno' => 'OUTLET_LANDLINENO',
        'outletLandlineno' => 'OUTLET_LANDLINENO',
        'customerdataView.outletLandlineno' => 'OUTLET_LANDLINENO',
        'CustomerdataViewTableMap::COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'outlet_landlineno' => 'OUTLET_LANDLINENO',
        'customerdata_view.outlet_landlineno' => 'OUTLET_LANDLINENO',
        'OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'CustomerdataView.OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'customerdataView.outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'customerdata_view.outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'CustomerdataView.OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'customerdataView.outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'customerdata_view.outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'CustomerdataView.OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'customerdataView.outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'customerdata_view.outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletIsdCode' => 'OUTLET_ISD_CODE',
        'CustomerdataView.OutletIsdCode' => 'OUTLET_ISD_CODE',
        'outletIsdCode' => 'OUTLET_ISD_CODE',
        'customerdataView.outletIsdCode' => 'OUTLET_ISD_CODE',
        'CustomerdataViewTableMap::COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'outlet_isd_code' => 'OUTLET_ISD_CODE',
        'customerdata_view.outlet_isd_code' => 'OUTLET_ISD_CODE',
        'OutletContactNo' => 'OUTLET_CONTACT_NO',
        'CustomerdataView.OutletContactNo' => 'OUTLET_CONTACT_NO',
        'outletContactNo' => 'OUTLET_CONTACT_NO',
        'customerdataView.outletContactNo' => 'OUTLET_CONTACT_NO',
        'CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'customerdata_view.outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'CustomerdataView.OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'customerdataView.outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'customerdata_view.outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'CustomerdataView.outlettype_id' => 'OUTLETTYPE_ID',
        'customerdataView.outlettype_id' => 'OUTLETTYPE_ID',
        'CustomerdataViewTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'customerdata_view.outlettype_id' => 'OUTLETTYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'CustomerdataView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'customerdataView.outlettypeName' => 'OUTLETTYPE_NAME',
        'CustomerdataViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'customerdata_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'OutletPotential' => 'OUTLET_POTENTIAL',
        'CustomerdataView.OutletPotential' => 'OUTLET_POTENTIAL',
        'outletPotential' => 'OUTLET_POTENTIAL',
        'customerdataView.outletPotential' => 'OUTLET_POTENTIAL',
        'CustomerdataViewTableMap::COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'outlet_potential' => 'OUTLET_POTENTIAL',
        'customerdata_view.outlet_potential' => 'OUTLET_POTENTIAL',
        'OutletQualification' => 'OUTLET_QUALIFICATION',
        'CustomerdataView.OutletQualification' => 'OUTLET_QUALIFICATION',
        'outletQualification' => 'OUTLET_QUALIFICATION',
        'customerdataView.outletQualification' => 'OUTLET_QUALIFICATION',
        'CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'outlet_qualification' => 'OUTLET_QUALIFICATION',
        'customerdata_view.outlet_qualification' => 'OUTLET_QUALIFICATION',
        'OutletRegno' => 'OUTLET_REGNO',
        'CustomerdataView.OutletRegno' => 'OUTLET_REGNO',
        'outletRegno' => 'OUTLET_REGNO',
        'customerdataView.outletRegno' => 'OUTLET_REGNO',
        'CustomerdataViewTableMap::COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'outlet_regno' => 'OUTLET_REGNO',
        'customerdata_view.outlet_regno' => 'OUTLET_REGNO',
        'OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'CustomerdataView.OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'customerdataView.outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'customerdata_view.outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'OutletMedia' => 'OUTLET_MEDIA',
        'CustomerdataView.OutletMedia' => 'OUTLET_MEDIA',
        'outletMedia' => 'OUTLET_MEDIA',
        'customerdataView.outletMedia' => 'OUTLET_MEDIA',
        'CustomerdataViewTableMap::COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'outlet_media' => 'OUTLET_MEDIA',
        'customerdata_view.outlet_media' => 'OUTLET_MEDIA',
        'AddressName' => 'ADDRESS_NAME',
        'CustomerdataView.AddressName' => 'ADDRESS_NAME',
        'addressName' => 'ADDRESS_NAME',
        'customerdataView.addressName' => 'ADDRESS_NAME',
        'CustomerdataViewTableMap::COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'COL_ADDRESS_NAME' => 'ADDRESS_NAME',
        'address_name' => 'ADDRESS_NAME',
        'customerdata_view.address_name' => 'ADDRESS_NAME',
        'OutletAddress' => 'OUTLET_ADDRESS',
        'CustomerdataView.OutletAddress' => 'OUTLET_ADDRESS',
        'outletAddress' => 'OUTLET_ADDRESS',
        'customerdataView.outletAddress' => 'OUTLET_ADDRESS',
        'CustomerdataViewTableMap::COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'COL_OUTLET_ADDRESS' => 'OUTLET_ADDRESS',
        'outlet_address' => 'OUTLET_ADDRESS',
        'customerdata_view.outlet_address' => 'OUTLET_ADDRESS',
        'OutletStreetName' => 'OUTLET_STREET_NAME',
        'CustomerdataView.OutletStreetName' => 'OUTLET_STREET_NAME',
        'outletStreetName' => 'OUTLET_STREET_NAME',
        'customerdataView.outletStreetName' => 'OUTLET_STREET_NAME',
        'CustomerdataViewTableMap::COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'COL_OUTLET_STREET_NAME' => 'OUTLET_STREET_NAME',
        'outlet_street_name' => 'OUTLET_STREET_NAME',
        'customerdata_view.outlet_street_name' => 'OUTLET_STREET_NAME',
        'OutletCity' => 'OUTLET_CITY',
        'CustomerdataView.OutletCity' => 'OUTLET_CITY',
        'outletCity' => 'OUTLET_CITY',
        'customerdataView.outletCity' => 'OUTLET_CITY',
        'CustomerdataViewTableMap::COL_OUTLET_CITY' => 'OUTLET_CITY',
        'COL_OUTLET_CITY' => 'OUTLET_CITY',
        'outlet_city' => 'OUTLET_CITY',
        'customerdata_view.outlet_city' => 'OUTLET_CITY',
        'OutletState' => 'OUTLET_STATE',
        'CustomerdataView.OutletState' => 'OUTLET_STATE',
        'outletState' => 'OUTLET_STATE',
        'customerdataView.outletState' => 'OUTLET_STATE',
        'CustomerdataViewTableMap::COL_OUTLET_STATE' => 'OUTLET_STATE',
        'COL_OUTLET_STATE' => 'OUTLET_STATE',
        'outlet_state' => 'OUTLET_STATE',
        'customerdata_view.outlet_state' => 'OUTLET_STATE',
        'OutletCountry' => 'OUTLET_COUNTRY',
        'CustomerdataView.OutletCountry' => 'OUTLET_COUNTRY',
        'outletCountry' => 'OUTLET_COUNTRY',
        'customerdataView.outletCountry' => 'OUTLET_COUNTRY',
        'CustomerdataViewTableMap::COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'COL_OUTLET_COUNTRY' => 'OUTLET_COUNTRY',
        'outlet_country' => 'OUTLET_COUNTRY',
        'customerdata_view.outlet_country' => 'OUTLET_COUNTRY',
        'OutletPincode' => 'OUTLET_PINCODE',
        'CustomerdataView.OutletPincode' => 'OUTLET_PINCODE',
        'outletPincode' => 'OUTLET_PINCODE',
        'customerdataView.outletPincode' => 'OUTLET_PINCODE',
        'CustomerdataViewTableMap::COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'COL_OUTLET_PINCODE' => 'OUTLET_PINCODE',
        'outlet_pincode' => 'OUTLET_PINCODE',
        'customerdata_view.outlet_pincode' => 'OUTLET_PINCODE',
        'LastVisitDate' => 'LAST_VISIT_DATE',
        'CustomerdataView.LastVisitDate' => 'LAST_VISIT_DATE',
        'lastVisitDate' => 'LAST_VISIT_DATE',
        'customerdataView.lastVisitDate' => 'LAST_VISIT_DATE',
        'CustomerdataViewTableMap::COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'COL_LAST_VISIT_DATE' => 'LAST_VISIT_DATE',
        'last_visit_date' => 'LAST_VISIT_DATE',
        'customerdata_view.last_visit_date' => 'LAST_VISIT_DATE',
        'LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'CustomerdataView.LastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'customerdataView.lastVisitEmployee' => 'LAST_VISIT_EMPLOYEE',
        'CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'COL_LAST_VISIT_EMPLOYEE' => 'LAST_VISIT_EMPLOYEE',
        'last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'customerdata_view.last_visit_employee' => 'LAST_VISIT_EMPLOYEE',
        'OutletStatus' => 'OUTLET_STATUS',
        'CustomerdataView.OutletStatus' => 'OUTLET_STATUS',
        'outletStatus' => 'OUTLET_STATUS',
        'customerdataView.outletStatus' => 'OUTLET_STATUS',
        'CustomerdataViewTableMap::COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'outlet_status' => 'OUTLET_STATUS',
        'customerdata_view.outlet_status' => 'OUTLET_STATUS',
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
        $this->setName('customerdata_view');
        $this->setPhpName('CustomerdataView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\CustomerdataView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, null, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, null, null);
        $this->addColumn('position_code', 'PositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('ood_itownid', 'OodItownid', 'INTEGER', false, null, null);
        $this->addColumn('ood_town_code', 'OodTownCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('id', 'Id', 'INTEGER', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_org_code', 'OutletOrgCode', 'VARCHAR', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('comments', 'Comments', 'VARCHAR', false, null, null);
        $this->addColumn('org_potential', 'OrgPotential', 'VARCHAR', false, null, null);
        $this->addColumn('brand_focus', 'BrandFocus', 'VARCHAR', false, null, null);
        $this->addColumn('customer_fq', 'CustomerFq', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_email', 'OutletEmail', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'INTEGER', false, null, null);
        $this->addColumn('classification', 'Classification', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_opening_date', 'OutletOpeningDate', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_name', 'OutletContactName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_landlineno', 'OutletLandlineno', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_alt_landlineno', 'OutletAltLandlineno', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_contact_bday', 'OutletContactBday', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_anniversary', 'OutletContactAnniversary', 'DATE', false, null, null);
        $this->addColumn('outlet_isd_code', 'OutletIsdCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_contact_no', 'OutletContactNo', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_alt_contact_no', 'OutletAltContactNo', 'VARCHAR', false, null, null);
        $this->addColumn('outlettype_id', 'outlettype_id', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_potential', 'OutletPotential', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_qualification', 'OutletQualification', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_regno', 'OutletRegno', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_marital_status', 'OutletMaritalStatus', 'CHAR', false, 1, null);
        $this->addColumn('outlet_media', 'OutletMedia', 'VARCHAR', false, null, null);
        $this->addColumn('address_name', 'AddressName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_address', 'OutletAddress', 'LONGVARCHAR', false, null, null);
        $this->addColumn('outlet_street_name', 'OutletStreetName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_city', 'OutletCity', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_state', 'OutletState', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_country', 'OutletCountry', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_pincode', 'OutletPincode', 'VARCHAR', false, null, null);
        $this->addColumn('last_visit_date', 'LastVisitDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('last_visit_employee', 'LastVisitEmployee', 'INTEGER', false, null, null);
        $this->addColumn('outlet_status', 'OutletStatus', 'VARCHAR', false, null, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? CustomerdataViewTableMap::CLASS_DEFAULT : CustomerdataViewTableMap::OM_CLASS;
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
     * @return array (CustomerdataView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CustomerdataViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CustomerdataViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CustomerdataViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CustomerdataViewTableMap::OM_CLASS;
            /** @var CustomerdataView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CustomerdataViewTableMap::addInstanceToPool($obj, $key);
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
            $key = CustomerdataViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CustomerdataViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CustomerdataView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CustomerdataViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_PHONE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_POSITION_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OOD_ITOWNID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OOD_TOWN_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ORG_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_TAGS);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_ORG_POTENTIAL);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_BRAND_FOCUS);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_CUSTOMER_FQ);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_EMAIL);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_CLASSIFICATION);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_LANDLINENO);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ISD_CODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_POTENTIAL);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_REGNO);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_MEDIA);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_ADDRESS_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CITY);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STATE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_PINCODE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_LAST_VISIT_DATE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->addSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.position_code');
            $criteria->addSelectColumn($alias . '.ood_itownid');
            $criteria->addSelectColumn($alias . '.ood_town_code');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_org_code');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.org_potential');
            $criteria->addSelectColumn($alias . '.brand_focus');
            $criteria->addSelectColumn($alias . '.customer_fq');
            $criteria->addSelectColumn($alias . '.outlet_name');
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
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.outlet_potential');
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
            $criteria->addSelectColumn($alias . '.outlet_status');
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
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_PHONE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_POSITION_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OOD_ITOWNID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OOD_TOWN_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ORG_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_TAGS);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_ORG_POTENTIAL);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_BRAND_FOCUS);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_CUSTOMER_FQ);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_EMAIL);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_CLASSIFICATION);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_LANDLINENO);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ISD_CODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_POTENTIAL);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_REGNO);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_MEDIA);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_ADDRESS_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_ADDRESS);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STREET_NAME);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_CITY);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STATE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_COUNTRY);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_PINCODE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_LAST_VISIT_DATE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE);
            $criteria->removeSelectColumn(CustomerdataViewTableMap::COL_OUTLET_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.position_code');
            $criteria->removeSelectColumn($alias . '.ood_itownid');
            $criteria->removeSelectColumn($alias . '.ood_town_code');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_org_code');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.org_potential');
            $criteria->removeSelectColumn($alias . '.brand_focus');
            $criteria->removeSelectColumn($alias . '.customer_fq');
            $criteria->removeSelectColumn($alias . '.outlet_name');
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
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.outlet_potential');
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
            $criteria->removeSelectColumn($alias . '.outlet_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(CustomerdataViewTableMap::DATABASE_NAME)->getTable(CustomerdataViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a CustomerdataView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or CustomerdataView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerdataViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\CustomerdataView) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The CustomerdataView object has no primary key');
        }

        $query = CustomerdataViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CustomerdataViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CustomerdataViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the customerdata_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CustomerdataViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CustomerdataView or Criteria object.
     *
     * @param mixed $criteria Criteria or CustomerdataView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerdataViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CustomerdataView object
        }


        // Set the correct dbName
        $query = CustomerdataViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

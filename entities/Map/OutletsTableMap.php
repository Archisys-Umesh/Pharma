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
use entities\Outlets;
use entities\OutletsQuery;


/**
 * This class defines the structure of the 'outlets' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlets';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Outlets';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Outlets';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Outlets';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 32;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 32;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'outlets.id';

    /**
     * the column name for the outlet_media_id field
     */
    public const COL_OUTLET_MEDIA_ID = 'outlets.outlet_media_id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'outlets.outlet_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'outlets.outlet_code';

    /**
     * the column name for the outlet_email field
     */
    public const COL_OUTLET_EMAIL = 'outlets.outlet_email';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'outlets.outlet_salutation';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'outlets.outlet_classification';

    /**
     * the column name for the outlet_opening_date field
     */
    public const COL_OUTLET_OPENING_DATE = 'outlets.outlet_opening_date';

    /**
     * the column name for the outlet_contact_name field
     */
    public const COL_OUTLET_CONTACT_NAME = 'outlets.outlet_contact_name';

    /**
     * the column name for the outlet_landlineno field
     */
    public const COL_OUTLET_LANDLINENO = 'outlets.outlet_landlineno';

    /**
     * the column name for the outlet_alt_landlineno field
     */
    public const COL_OUTLET_ALT_LANDLINENO = 'outlets.outlet_alt_landlineno';

    /**
     * the column name for the outlet_contact_bday field
     */
    public const COL_OUTLET_CONTACT_BDAY = 'outlets.outlet_contact_bday';

    /**
     * the column name for the outlet_contact_anniversary field
     */
    public const COL_OUTLET_CONTACT_ANNIVERSARY = 'outlets.outlet_contact_anniversary';

    /**
     * the column name for the outlet_isd_code field
     */
    public const COL_OUTLET_ISD_CODE = 'outlets.outlet_isd_code';

    /**
     * the column name for the outlet_contact_no field
     */
    public const COL_OUTLET_CONTACT_NO = 'outlets.outlet_contact_no';

    /**
     * the column name for the outlet_alt_contact_no field
     */
    public const COL_OUTLET_ALT_CONTACT_NO = 'outlets.outlet_alt_contact_no';

    /**
     * the column name for the outlet_status field
     */
    public const COL_OUTLET_STATUS = 'outlets.outlet_status';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'outlets.outlettype_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlets.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlets.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlets.updated_at';

    /**
     * the column name for the outlet_otp field
     */
    public const COL_OUTLET_OTP = 'outlets.outlet_otp';

    /**
     * the column name for the outlet_verified field
     */
    public const COL_OUTLET_VERIFIED = 'outlets.outlet_verified';

    /**
     * the column name for the outlet_created_by field
     */
    public const COL_OUTLET_CREATED_BY = 'outlets.outlet_created_by';

    /**
     * the column name for the outlet_approved_by field
     */
    public const COL_OUTLET_APPROVED_BY = 'outlets.outlet_approved_by';

    /**
     * the column name for the outlet_potential field
     */
    public const COL_OUTLET_POTENTIAL = 'outlets.outlet_potential';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'outlets.integration_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'outlets.itownid';

    /**
     * the column name for the outlet_qualification field
     */
    public const COL_OUTLET_QUALIFICATION = 'outlets.outlet_qualification';

    /**
     * the column name for the outlet_regno field
     */
    public const COL_OUTLET_REGNO = 'outlets.outlet_regno';

    /**
     * the column name for the outlet_marital_status field
     */
    public const COL_OUTLET_MARITAL_STATUS = 'outlets.outlet_marital_status';

    /**
     * the column name for the outlet_media field
     */
    public const COL_OUTLET_MEDIA = 'outlets.outlet_media';

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
        self::TYPE_PHPNAME       => ['Id', 'OutletMediaId', 'OutletName', 'OutletCode', 'OutletEmail', 'OutletSalutation', 'OutletClassification', 'OutletOpeningDate', 'OutletContactName', 'OutletLandlineno', 'OutletAltLandlineno', 'OutletContactBday', 'OutletContactAnniversary', 'OutletIsdCode', 'OutletContactNo', 'OutletAltContactNo', 'OutletStatus', 'OutlettypeId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OutletOtp', 'OutletVerified', 'OutletCreatedBy', 'OutletApprovedBy', 'OutletPotential', 'IntegrationId', 'Itownid', 'OutletQualification', 'OutletRegno', 'OutletMaritalStatus', 'OutletMedia', ],
        self::TYPE_CAMELNAME     => ['id', 'outletMediaId', 'outletName', 'outletCode', 'outletEmail', 'outletSalutation', 'outletClassification', 'outletOpeningDate', 'outletContactName', 'outletLandlineno', 'outletAltLandlineno', 'outletContactBday', 'outletContactAnniversary', 'outletIsdCode', 'outletContactNo', 'outletAltContactNo', 'outletStatus', 'outlettypeId', 'companyId', 'createdAt', 'updatedAt', 'outletOtp', 'outletVerified', 'outletCreatedBy', 'outletApprovedBy', 'outletPotential', 'integrationId', 'itownid', 'outletQualification', 'outletRegno', 'outletMaritalStatus', 'outletMedia', ],
        self::TYPE_COLNAME       => [OutletsTableMap::COL_ID, OutletsTableMap::COL_OUTLET_MEDIA_ID, OutletsTableMap::COL_OUTLET_NAME, OutletsTableMap::COL_OUTLET_CODE, OutletsTableMap::COL_OUTLET_EMAIL, OutletsTableMap::COL_OUTLET_SALUTATION, OutletsTableMap::COL_OUTLET_CLASSIFICATION, OutletsTableMap::COL_OUTLET_OPENING_DATE, OutletsTableMap::COL_OUTLET_CONTACT_NAME, OutletsTableMap::COL_OUTLET_LANDLINENO, OutletsTableMap::COL_OUTLET_ALT_LANDLINENO, OutletsTableMap::COL_OUTLET_CONTACT_BDAY, OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, OutletsTableMap::COL_OUTLET_ISD_CODE, OutletsTableMap::COL_OUTLET_CONTACT_NO, OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO, OutletsTableMap::COL_OUTLET_STATUS, OutletsTableMap::COL_OUTLETTYPE_ID, OutletsTableMap::COL_COMPANY_ID, OutletsTableMap::COL_CREATED_AT, OutletsTableMap::COL_UPDATED_AT, OutletsTableMap::COL_OUTLET_OTP, OutletsTableMap::COL_OUTLET_VERIFIED, OutletsTableMap::COL_OUTLET_CREATED_BY, OutletsTableMap::COL_OUTLET_APPROVED_BY, OutletsTableMap::COL_OUTLET_POTENTIAL, OutletsTableMap::COL_INTEGRATION_ID, OutletsTableMap::COL_ITOWNID, OutletsTableMap::COL_OUTLET_QUALIFICATION, OutletsTableMap::COL_OUTLET_REGNO, OutletsTableMap::COL_OUTLET_MARITAL_STATUS, OutletsTableMap::COL_OUTLET_MEDIA, ],
        self::TYPE_FIELDNAME     => ['id', 'outlet_media_id', 'outlet_name', 'outlet_code', 'outlet_email', 'outlet_salutation', 'outlet_classification', 'outlet_opening_date', 'outlet_contact_name', 'outlet_landlineno', 'outlet_alt_landlineno', 'outlet_contact_bday', 'outlet_contact_anniversary', 'outlet_isd_code', 'outlet_contact_no', 'outlet_alt_contact_no', 'outlet_status', 'outlettype_id', 'company_id', 'created_at', 'updated_at', 'outlet_otp', 'outlet_verified', 'outlet_created_by', 'outlet_approved_by', 'outlet_potential', 'integration_id', 'itownid', 'outlet_qualification', 'outlet_regno', 'outlet_marital_status', 'outlet_media', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'OutletMediaId' => 1, 'OutletName' => 2, 'OutletCode' => 3, 'OutletEmail' => 4, 'OutletSalutation' => 5, 'OutletClassification' => 6, 'OutletOpeningDate' => 7, 'OutletContactName' => 8, 'OutletLandlineno' => 9, 'OutletAltLandlineno' => 10, 'OutletContactBday' => 11, 'OutletContactAnniversary' => 12, 'OutletIsdCode' => 13, 'OutletContactNo' => 14, 'OutletAltContactNo' => 15, 'OutletStatus' => 16, 'OutlettypeId' => 17, 'CompanyId' => 18, 'CreatedAt' => 19, 'UpdatedAt' => 20, 'OutletOtp' => 21, 'OutletVerified' => 22, 'OutletCreatedBy' => 23, 'OutletApprovedBy' => 24, 'OutletPotential' => 25, 'IntegrationId' => 26, 'Itownid' => 27, 'OutletQualification' => 28, 'OutletRegno' => 29, 'OutletMaritalStatus' => 30, 'OutletMedia' => 31, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'outletMediaId' => 1, 'outletName' => 2, 'outletCode' => 3, 'outletEmail' => 4, 'outletSalutation' => 5, 'outletClassification' => 6, 'outletOpeningDate' => 7, 'outletContactName' => 8, 'outletLandlineno' => 9, 'outletAltLandlineno' => 10, 'outletContactBday' => 11, 'outletContactAnniversary' => 12, 'outletIsdCode' => 13, 'outletContactNo' => 14, 'outletAltContactNo' => 15, 'outletStatus' => 16, 'outlettypeId' => 17, 'companyId' => 18, 'createdAt' => 19, 'updatedAt' => 20, 'outletOtp' => 21, 'outletVerified' => 22, 'outletCreatedBy' => 23, 'outletApprovedBy' => 24, 'outletPotential' => 25, 'integrationId' => 26, 'itownid' => 27, 'outletQualification' => 28, 'outletRegno' => 29, 'outletMaritalStatus' => 30, 'outletMedia' => 31, ],
        self::TYPE_COLNAME       => [OutletsTableMap::COL_ID => 0, OutletsTableMap::COL_OUTLET_MEDIA_ID => 1, OutletsTableMap::COL_OUTLET_NAME => 2, OutletsTableMap::COL_OUTLET_CODE => 3, OutletsTableMap::COL_OUTLET_EMAIL => 4, OutletsTableMap::COL_OUTLET_SALUTATION => 5, OutletsTableMap::COL_OUTLET_CLASSIFICATION => 6, OutletsTableMap::COL_OUTLET_OPENING_DATE => 7, OutletsTableMap::COL_OUTLET_CONTACT_NAME => 8, OutletsTableMap::COL_OUTLET_LANDLINENO => 9, OutletsTableMap::COL_OUTLET_ALT_LANDLINENO => 10, OutletsTableMap::COL_OUTLET_CONTACT_BDAY => 11, OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY => 12, OutletsTableMap::COL_OUTLET_ISD_CODE => 13, OutletsTableMap::COL_OUTLET_CONTACT_NO => 14, OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO => 15, OutletsTableMap::COL_OUTLET_STATUS => 16, OutletsTableMap::COL_OUTLETTYPE_ID => 17, OutletsTableMap::COL_COMPANY_ID => 18, OutletsTableMap::COL_CREATED_AT => 19, OutletsTableMap::COL_UPDATED_AT => 20, OutletsTableMap::COL_OUTLET_OTP => 21, OutletsTableMap::COL_OUTLET_VERIFIED => 22, OutletsTableMap::COL_OUTLET_CREATED_BY => 23, OutletsTableMap::COL_OUTLET_APPROVED_BY => 24, OutletsTableMap::COL_OUTLET_POTENTIAL => 25, OutletsTableMap::COL_INTEGRATION_ID => 26, OutletsTableMap::COL_ITOWNID => 27, OutletsTableMap::COL_OUTLET_QUALIFICATION => 28, OutletsTableMap::COL_OUTLET_REGNO => 29, OutletsTableMap::COL_OUTLET_MARITAL_STATUS => 30, OutletsTableMap::COL_OUTLET_MEDIA => 31, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'outlet_media_id' => 1, 'outlet_name' => 2, 'outlet_code' => 3, 'outlet_email' => 4, 'outlet_salutation' => 5, 'outlet_classification' => 6, 'outlet_opening_date' => 7, 'outlet_contact_name' => 8, 'outlet_landlineno' => 9, 'outlet_alt_landlineno' => 10, 'outlet_contact_bday' => 11, 'outlet_contact_anniversary' => 12, 'outlet_isd_code' => 13, 'outlet_contact_no' => 14, 'outlet_alt_contact_no' => 15, 'outlet_status' => 16, 'outlettype_id' => 17, 'company_id' => 18, 'created_at' => 19, 'updated_at' => 20, 'outlet_otp' => 21, 'outlet_verified' => 22, 'outlet_created_by' => 23, 'outlet_approved_by' => 24, 'outlet_potential' => 25, 'integration_id' => 26, 'itownid' => 27, 'outlet_qualification' => 28, 'outlet_regno' => 29, 'outlet_marital_status' => 30, 'outlet_media' => 31, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Outlets.Id' => 'ID',
        'id' => 'ID',
        'outlets.id' => 'ID',
        'OutletsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'OutletMediaId' => 'OUTLET_MEDIA_ID',
        'Outlets.OutletMediaId' => 'OUTLET_MEDIA_ID',
        'outletMediaId' => 'OUTLET_MEDIA_ID',
        'outlets.outletMediaId' => 'OUTLET_MEDIA_ID',
        'OutletsTableMap::COL_OUTLET_MEDIA_ID' => 'OUTLET_MEDIA_ID',
        'COL_OUTLET_MEDIA_ID' => 'OUTLET_MEDIA_ID',
        'outlet_media_id' => 'OUTLET_MEDIA_ID',
        'outlets.outlet_media_id' => 'OUTLET_MEDIA_ID',
        'OutletName' => 'OUTLET_NAME',
        'Outlets.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'outlets.outletName' => 'OUTLET_NAME',
        'OutletsTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'outlets.outlet_name' => 'OUTLET_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'Outlets.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'outlets.outletCode' => 'OUTLET_CODE',
        'OutletsTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'outlets.outlet_code' => 'OUTLET_CODE',
        'OutletEmail' => 'OUTLET_EMAIL',
        'Outlets.OutletEmail' => 'OUTLET_EMAIL',
        'outletEmail' => 'OUTLET_EMAIL',
        'outlets.outletEmail' => 'OUTLET_EMAIL',
        'OutletsTableMap::COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'COL_OUTLET_EMAIL' => 'OUTLET_EMAIL',
        'outlet_email' => 'OUTLET_EMAIL',
        'outlets.outlet_email' => 'OUTLET_EMAIL',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'Outlets.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'outlets.outletSalutation' => 'OUTLET_SALUTATION',
        'OutletsTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'outlets.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'Outlets.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'outlets.outletClassification' => 'OUTLET_CLASSIFICATION',
        'OutletsTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'outlets.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'OutletOpeningDate' => 'OUTLET_OPENING_DATE',
        'Outlets.OutletOpeningDate' => 'OUTLET_OPENING_DATE',
        'outletOpeningDate' => 'OUTLET_OPENING_DATE',
        'outlets.outletOpeningDate' => 'OUTLET_OPENING_DATE',
        'OutletsTableMap::COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'COL_OUTLET_OPENING_DATE' => 'OUTLET_OPENING_DATE',
        'outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'outlets.outlet_opening_date' => 'OUTLET_OPENING_DATE',
        'OutletContactName' => 'OUTLET_CONTACT_NAME',
        'Outlets.OutletContactName' => 'OUTLET_CONTACT_NAME',
        'outletContactName' => 'OUTLET_CONTACT_NAME',
        'outlets.outletContactName' => 'OUTLET_CONTACT_NAME',
        'OutletsTableMap::COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'COL_OUTLET_CONTACT_NAME' => 'OUTLET_CONTACT_NAME',
        'outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'outlets.outlet_contact_name' => 'OUTLET_CONTACT_NAME',
        'OutletLandlineno' => 'OUTLET_LANDLINENO',
        'Outlets.OutletLandlineno' => 'OUTLET_LANDLINENO',
        'outletLandlineno' => 'OUTLET_LANDLINENO',
        'outlets.outletLandlineno' => 'OUTLET_LANDLINENO',
        'OutletsTableMap::COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'COL_OUTLET_LANDLINENO' => 'OUTLET_LANDLINENO',
        'outlet_landlineno' => 'OUTLET_LANDLINENO',
        'outlets.outlet_landlineno' => 'OUTLET_LANDLINENO',
        'OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'Outlets.OutletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'outlets.outletAltLandlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletsTableMap::COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'COL_OUTLET_ALT_LANDLINENO' => 'OUTLET_ALT_LANDLINENO',
        'outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'outlets.outlet_alt_landlineno' => 'OUTLET_ALT_LANDLINENO',
        'OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'Outlets.OutletContactBday' => 'OUTLET_CONTACT_BDAY',
        'outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'outlets.outletContactBday' => 'OUTLET_CONTACT_BDAY',
        'OutletsTableMap::COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'COL_OUTLET_CONTACT_BDAY' => 'OUTLET_CONTACT_BDAY',
        'outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'outlets.outlet_contact_bday' => 'OUTLET_CONTACT_BDAY',
        'OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'Outlets.OutletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlets.outletContactAnniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'COL_OUTLET_CONTACT_ANNIVERSARY' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'outlets.outlet_contact_anniversary' => 'OUTLET_CONTACT_ANNIVERSARY',
        'OutletIsdCode' => 'OUTLET_ISD_CODE',
        'Outlets.OutletIsdCode' => 'OUTLET_ISD_CODE',
        'outletIsdCode' => 'OUTLET_ISD_CODE',
        'outlets.outletIsdCode' => 'OUTLET_ISD_CODE',
        'OutletsTableMap::COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'COL_OUTLET_ISD_CODE' => 'OUTLET_ISD_CODE',
        'outlet_isd_code' => 'OUTLET_ISD_CODE',
        'outlets.outlet_isd_code' => 'OUTLET_ISD_CODE',
        'OutletContactNo' => 'OUTLET_CONTACT_NO',
        'Outlets.OutletContactNo' => 'OUTLET_CONTACT_NO',
        'outletContactNo' => 'OUTLET_CONTACT_NO',
        'outlets.outletContactNo' => 'OUTLET_CONTACT_NO',
        'OutletsTableMap::COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'COL_OUTLET_CONTACT_NO' => 'OUTLET_CONTACT_NO',
        'outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'outlets.outlet_contact_no' => 'OUTLET_CONTACT_NO',
        'OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'Outlets.OutletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'outlets.outletAltContactNo' => 'OUTLET_ALT_CONTACT_NO',
        'OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'COL_OUTLET_ALT_CONTACT_NO' => 'OUTLET_ALT_CONTACT_NO',
        'outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'outlets.outlet_alt_contact_no' => 'OUTLET_ALT_CONTACT_NO',
        'OutletStatus' => 'OUTLET_STATUS',
        'Outlets.OutletStatus' => 'OUTLET_STATUS',
        'outletStatus' => 'OUTLET_STATUS',
        'outlets.outletStatus' => 'OUTLET_STATUS',
        'OutletsTableMap::COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'COL_OUTLET_STATUS' => 'OUTLET_STATUS',
        'outlet_status' => 'OUTLET_STATUS',
        'outlets.outlet_status' => 'OUTLET_STATUS',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'Outlets.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'outlets.outlettypeId' => 'OUTLETTYPE_ID',
        'OutletsTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'outlets.outlettype_id' => 'OUTLETTYPE_ID',
        'CompanyId' => 'COMPANY_ID',
        'Outlets.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outlets.companyId' => 'COMPANY_ID',
        'OutletsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlets.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Outlets.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outlets.createdAt' => 'CREATED_AT',
        'OutletsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlets.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Outlets.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outlets.updatedAt' => 'UPDATED_AT',
        'OutletsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlets.updated_at' => 'UPDATED_AT',
        'OutletOtp' => 'OUTLET_OTP',
        'Outlets.OutletOtp' => 'OUTLET_OTP',
        'outletOtp' => 'OUTLET_OTP',
        'outlets.outletOtp' => 'OUTLET_OTP',
        'OutletsTableMap::COL_OUTLET_OTP' => 'OUTLET_OTP',
        'COL_OUTLET_OTP' => 'OUTLET_OTP',
        'outlet_otp' => 'OUTLET_OTP',
        'outlets.outlet_otp' => 'OUTLET_OTP',
        'OutletVerified' => 'OUTLET_VERIFIED',
        'Outlets.OutletVerified' => 'OUTLET_VERIFIED',
        'outletVerified' => 'OUTLET_VERIFIED',
        'outlets.outletVerified' => 'OUTLET_VERIFIED',
        'OutletsTableMap::COL_OUTLET_VERIFIED' => 'OUTLET_VERIFIED',
        'COL_OUTLET_VERIFIED' => 'OUTLET_VERIFIED',
        'outlet_verified' => 'OUTLET_VERIFIED',
        'outlets.outlet_verified' => 'OUTLET_VERIFIED',
        'OutletCreatedBy' => 'OUTLET_CREATED_BY',
        'Outlets.OutletCreatedBy' => 'OUTLET_CREATED_BY',
        'outletCreatedBy' => 'OUTLET_CREATED_BY',
        'outlets.outletCreatedBy' => 'OUTLET_CREATED_BY',
        'OutletsTableMap::COL_OUTLET_CREATED_BY' => 'OUTLET_CREATED_BY',
        'COL_OUTLET_CREATED_BY' => 'OUTLET_CREATED_BY',
        'outlet_created_by' => 'OUTLET_CREATED_BY',
        'outlets.outlet_created_by' => 'OUTLET_CREATED_BY',
        'OutletApprovedBy' => 'OUTLET_APPROVED_BY',
        'Outlets.OutletApprovedBy' => 'OUTLET_APPROVED_BY',
        'outletApprovedBy' => 'OUTLET_APPROVED_BY',
        'outlets.outletApprovedBy' => 'OUTLET_APPROVED_BY',
        'OutletsTableMap::COL_OUTLET_APPROVED_BY' => 'OUTLET_APPROVED_BY',
        'COL_OUTLET_APPROVED_BY' => 'OUTLET_APPROVED_BY',
        'outlet_approved_by' => 'OUTLET_APPROVED_BY',
        'outlets.outlet_approved_by' => 'OUTLET_APPROVED_BY',
        'OutletPotential' => 'OUTLET_POTENTIAL',
        'Outlets.OutletPotential' => 'OUTLET_POTENTIAL',
        'outletPotential' => 'OUTLET_POTENTIAL',
        'outlets.outletPotential' => 'OUTLET_POTENTIAL',
        'OutletsTableMap::COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'COL_OUTLET_POTENTIAL' => 'OUTLET_POTENTIAL',
        'outlet_potential' => 'OUTLET_POTENTIAL',
        'outlets.outlet_potential' => 'OUTLET_POTENTIAL',
        'IntegrationId' => 'INTEGRATION_ID',
        'Outlets.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'outlets.integrationId' => 'INTEGRATION_ID',
        'OutletsTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'outlets.integration_id' => 'INTEGRATION_ID',
        'Itownid' => 'ITOWNID',
        'Outlets.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'outlets.itownid' => 'ITOWNID',
        'OutletsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'OutletQualification' => 'OUTLET_QUALIFICATION',
        'Outlets.OutletQualification' => 'OUTLET_QUALIFICATION',
        'outletQualification' => 'OUTLET_QUALIFICATION',
        'outlets.outletQualification' => 'OUTLET_QUALIFICATION',
        'OutletsTableMap::COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'COL_OUTLET_QUALIFICATION' => 'OUTLET_QUALIFICATION',
        'outlet_qualification' => 'OUTLET_QUALIFICATION',
        'outlets.outlet_qualification' => 'OUTLET_QUALIFICATION',
        'OutletRegno' => 'OUTLET_REGNO',
        'Outlets.OutletRegno' => 'OUTLET_REGNO',
        'outletRegno' => 'OUTLET_REGNO',
        'outlets.outletRegno' => 'OUTLET_REGNO',
        'OutletsTableMap::COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'COL_OUTLET_REGNO' => 'OUTLET_REGNO',
        'outlet_regno' => 'OUTLET_REGNO',
        'outlets.outlet_regno' => 'OUTLET_REGNO',
        'OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'Outlets.OutletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'outlets.outletMaritalStatus' => 'OUTLET_MARITAL_STATUS',
        'OutletsTableMap::COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'COL_OUTLET_MARITAL_STATUS' => 'OUTLET_MARITAL_STATUS',
        'outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'outlets.outlet_marital_status' => 'OUTLET_MARITAL_STATUS',
        'OutletMedia' => 'OUTLET_MEDIA',
        'Outlets.OutletMedia' => 'OUTLET_MEDIA',
        'outletMedia' => 'OUTLET_MEDIA',
        'outlets.outletMedia' => 'OUTLET_MEDIA',
        'OutletsTableMap::COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'COL_OUTLET_MEDIA' => 'OUTLET_MEDIA',
        'outlet_media' => 'OUTLET_MEDIA',
        'outlets.outlet_media' => 'OUTLET_MEDIA',
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
        $this->setName('outlets');
        $this->setPhpName('Outlets');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Outlets');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlets_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('outlet_media_id', 'OutletMediaId', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', true, 100, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', true, 50, null);
        $this->addColumn('outlet_email', 'OutletEmail', 'VARCHAR', false, 100, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, 10, null);
        $this->addForeignKey('outlet_classification', 'OutletClassification', 'INTEGER', 'classification', 'id', false, null, null);
        $this->addColumn('outlet_opening_date', 'OutletOpeningDate', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_name', 'OutletContactName', 'VARCHAR', false, 100, null);
        $this->addColumn('outlet_landlineno', 'OutletLandlineno', 'VARCHAR', false, 100, null);
        $this->addColumn('outlet_alt_landlineno', 'OutletAltLandlineno', 'VARCHAR', false, 100, null);
        $this->addColumn('outlet_contact_bday', 'OutletContactBday', 'DATE', false, null, null);
        $this->addColumn('outlet_contact_anniversary', 'OutletContactAnniversary', 'DATE', false, null, null);
        $this->addColumn('outlet_isd_code', 'OutletIsdCode', 'VARCHAR', true, 5, '+91');
        $this->addColumn('outlet_contact_no', 'OutletContactNo', 'VARCHAR', false, 15, null);
        $this->addColumn('outlet_alt_contact_no', 'OutletAltContactNo', 'VARCHAR', false, 15, null);
        $this->addColumn('outlet_status', 'OutletStatus', 'VARCHAR', true, 255, 'active');
        $this->addForeignKey('outlettype_id', 'OutlettypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_otp', 'OutletOtp', 'BIGINT', false, null, null);
        $this->addColumn('outlet_verified', 'OutletVerified', 'SMALLINT', false, null, null);
        $this->addForeignKey('outlet_created_by', 'OutletCreatedBy', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('outlet_approved_by', 'OutletApprovedBy', 'INTEGER', false, null, null);
        $this->addColumn('outlet_potential', 'OutletPotential', 'DECIMAL', false, 20, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('outlet_qualification', 'OutletQualification', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_regno', 'OutletRegno', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_marital_status', 'OutletMaritalStatus', 'CHAR', false, null, null);
        $this->addColumn('outlet_media', 'OutletMedia', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_classification',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_created_by',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnDoctors', '\\entities\\BrandCampiagnDoctors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'BrandCampiagnDoctorss', false);
        $this->addRelation('BrandCampiagnVisits', '\\entities\\BrandCampiagnVisits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'BrandCampiagnVisitss', false);
        $this->addRelation('BrandRcpa', '\\entities\\BrandRcpa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'BrandRcpas', false);
        $this->addRelation('CompetitionMapping', '\\entities\\CompetitionMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'CompetitionMappings', false);
        $this->addRelation('DailycallsSgpiout', '\\entities\\DailycallsSgpiout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'DailycallsSgpiouts', false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OnBoardRequests', false);
        $this->addRelation('OrdersRelatedByOutletFrom', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_from',
    1 => ':id',
  ),
), null, null, 'OrderssRelatedByOutletFrom', false);
        $this->addRelation('OrdersRelatedByOutletTo', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_to',
    1 => ':id',
  ),
), null, null, 'OrderssRelatedByOutletTo', false);
        $this->addRelation('OutletAccountDetails', '\\entities\\OutletAccountDetails', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletAddress', '\\entities\\OutletAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletAddresses', false);
        $this->addRelation('OutletMapping', '\\entities\\OutletMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':primary_outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletMappings', false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletOrgDatas', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('StockTransaction', '\\entities\\StockTransaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'StockTransactions', false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'SurveySubmiteds', false);
        $this->addRelation('Tickets', '\\entities\\Tickets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, 'Ticketss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to outlets     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CompetitionMappingTableMap::clearInstancePool();
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
        return $withPrefix ? OutletsTableMap::CLASS_DEFAULT : OutletsTableMap::OM_CLASS;
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
     * @return array (Outlets object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletsTableMap::OM_CLASS;
            /** @var Outlets $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletsTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Outlets $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletsTableMap::COL_ID);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_MEDIA_ID);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_EMAIL);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_LANDLINENO);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_ISD_CODE);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_STATUS);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(OutletsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_OTP);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_VERIFIED);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_CREATED_BY);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_APPROVED_BY);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_POTENTIAL);
            $criteria->addSelectColumn(OutletsTableMap::COL_INTEGRATION_ID);
            $criteria->addSelectColumn(OutletsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_REGNO);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->addSelectColumn(OutletsTableMap::COL_OUTLET_MEDIA);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.outlet_media_id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_email');
            $criteria->addSelectColumn($alias . '.outlet_salutation');
            $criteria->addSelectColumn($alias . '.outlet_classification');
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
            $criteria->removeSelectColumn(OutletsTableMap::COL_ID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_MEDIA_ID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_EMAIL);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_OPENING_DATE);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_NAME);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_LANDLINENO);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_BDAY);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_ISD_CODE);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CONTACT_NO);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_STATUS);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_OTP);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_VERIFIED);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_CREATED_BY);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_APPROVED_BY);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_POTENTIAL);
            $criteria->removeSelectColumn(OutletsTableMap::COL_INTEGRATION_ID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_QUALIFICATION);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_REGNO);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_MARITAL_STATUS);
            $criteria->removeSelectColumn(OutletsTableMap::COL_OUTLET_MEDIA);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.outlet_media_id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_email');
            $criteria->removeSelectColumn($alias . '.outlet_salutation');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletsTableMap::DATABASE_NAME)->getTable(OutletsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Outlets or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Outlets object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Outlets) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletsTableMap::DATABASE_NAME);
            $criteria->add(OutletsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OutletsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Outlets or Criteria object.
     *
     * @param mixed $criteria Criteria or Outlets object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Outlets object
        }

        if ($criteria->containsKey(OutletsTableMap::COL_ID) && $criteria->keyContainsValue(OutletsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OutletsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\BrandCampiagn;
use entities\BrandCampiagnQuery;


/**
 * This class defines the structure of the 'brand_campiagn' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCampiagnTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCampiagnTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_campiagn';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCampiagn';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCampiagn';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCampiagn';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 36;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 36;

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'brand_campiagn.brand_campiagn_id';

    /**
     * the column name for the campiagn_name field
     */
    public const COL_CAMPIAGN_NAME = 'brand_campiagn.campiagn_name';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'brand_campiagn.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'brand_campiagn.end_date';

    /**
     * the column name for the locking_date field
     */
    public const COL_LOCKING_DATE = 'brand_campiagn.locking_date';

    /**
     * the column name for the doctor_count field
     */
    public const COL_DOCTOR_COUNT = 'brand_campiagn.doctor_count';

    /**
     * the column name for the focus_brand_id field
     */
    public const COL_FOCUS_BRAND_ID = 'brand_campiagn.focus_brand_id';

    /**
     * the column name for the planned field
     */
    public const COL_PLANNED = 'brand_campiagn.planned';

    /**
     * the column name for the done field
     */
    public const COL_DONE = 'brand_campiagn.done';

    /**
     * the column name for the distributed field
     */
    public const COL_DISTRIBUTED = 'brand_campiagn.distributed';

    /**
     * the column name for the distributed_done field
     */
    public const COL_DISTRIBUTED_DONE = 'brand_campiagn.distributed_done';

    /**
     * the column name for the classification_id field
     */
    public const COL_CLASSIFICATION_ID = 'brand_campiagn.classification_id';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'brand_campiagn.description';

    /**
     * the column name for the media field
     */
    public const COL_MEDIA = 'brand_campiagn.media';

    /**
     * the column name for the material field
     */
    public const COL_MATERIAL = 'brand_campiagn.material';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'brand_campiagn.type';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'brand_campiagn.tags';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brand_campiagn.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_campiagn.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_campiagn.updated_at';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'brand_campiagn.org_unit_id';

    /**
     * the column name for the brand_campiagn_code field
     */
    public const COL_BRAND_CAMPIAGN_CODE = 'brand_campiagn.brand_campiagn_code';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'brand_campiagn.outlettype_id';

    /**
     * the column name for the classifications field
     */
    public const COL_CLASSIFICATIONS = 'brand_campiagn.classifications';

    /**
     * the column name for the focus_brands field
     */
    public const COL_FOCUS_BRANDS = 'brand_campiagn.focus_brands';

    /**
     * the column name for the minimum_per_territory field
     */
    public const COL_MINIMUM_PER_TERRITORY = 'brand_campiagn.minimum_per_territory';

    /**
     * the column name for the maximum_per_territory field
     */
    public const COL_MAXIMUM_PER_TERRITORY = 'brand_campiagn.maximum_per_territory';

    /**
     * the column name for the minimum_for_campiagn field
     */
    public const COL_MINIMUM_FOR_CAMPIAGN = 'brand_campiagn.minimum_for_campiagn';

    /**
     * the column name for the maximum_for_campiagn field
     */
    public const COL_MAXIMUM_FOR_CAMPIAGN = 'brand_campiagn.maximum_for_campiagn';

    /**
     * the column name for the is_suspended field
     */
    public const COL_IS_SUSPENDED = 'brand_campiagn.is_suspended';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'brand_campiagn.status';

    /**
     * the column name for the campiagn_type field
     */
    public const COL_CAMPIAGN_TYPE = 'brand_campiagn.campiagn_type';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'brand_campiagn.designation';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'brand_campiagn.position';

    /**
     * the column name for the sgpi_brands field
     */
    public const COL_SGPI_BRANDS = 'brand_campiagn.sgpi_brands';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'brand_campiagn.comment';

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
        self::TYPE_PHPNAME       => ['BrandCampiagnId', 'CampiagnName', 'StartDate', 'EndDate', 'LockingDate', 'DoctorCount', 'FocusBrandId', 'Planned', 'Done', 'Distributed', 'DistributedDone', 'ClassificationId', 'Description', 'Media', 'Material', 'Type', 'Tags', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OrgUnitId', 'BrandCampiagnCode', 'OutlettypeId', 'Classifications', 'FocusBrands', 'MinimumPerTerritory', 'MaximumPerTerritory', 'MinimumForCampiagn', 'MaximumForCampiagn', 'IsSuspended', 'Status', 'CampiagnType', 'Designation', 'Position', 'SgpiBrands', 'Comment', ],
        self::TYPE_CAMELNAME     => ['brandCampiagnId', 'campiagnName', 'startDate', 'endDate', 'lockingDate', 'doctorCount', 'focusBrandId', 'planned', 'done', 'distributed', 'distributedDone', 'classificationId', 'description', 'media', 'material', 'type', 'tags', 'companyId', 'createdAt', 'updatedAt', 'orgUnitId', 'brandCampiagnCode', 'outlettypeId', 'classifications', 'focusBrands', 'minimumPerTerritory', 'maximumPerTerritory', 'minimumForCampiagn', 'maximumForCampiagn', 'isSuspended', 'status', 'campiagnType', 'designation', 'position', 'sgpiBrands', 'comment', ],
        self::TYPE_COLNAME       => [BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, BrandCampiagnTableMap::COL_CAMPIAGN_NAME, BrandCampiagnTableMap::COL_START_DATE, BrandCampiagnTableMap::COL_END_DATE, BrandCampiagnTableMap::COL_LOCKING_DATE, BrandCampiagnTableMap::COL_DOCTOR_COUNT, BrandCampiagnTableMap::COL_FOCUS_BRAND_ID, BrandCampiagnTableMap::COL_PLANNED, BrandCampiagnTableMap::COL_DONE, BrandCampiagnTableMap::COL_DISTRIBUTED, BrandCampiagnTableMap::COL_DISTRIBUTED_DONE, BrandCampiagnTableMap::COL_CLASSIFICATION_ID, BrandCampiagnTableMap::COL_DESCRIPTION, BrandCampiagnTableMap::COL_MEDIA, BrandCampiagnTableMap::COL_MATERIAL, BrandCampiagnTableMap::COL_TYPE, BrandCampiagnTableMap::COL_TAGS, BrandCampiagnTableMap::COL_COMPANY_ID, BrandCampiagnTableMap::COL_CREATED_AT, BrandCampiagnTableMap::COL_UPDATED_AT, BrandCampiagnTableMap::COL_ORG_UNIT_ID, BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE, BrandCampiagnTableMap::COL_OUTLETTYPE_ID, BrandCampiagnTableMap::COL_CLASSIFICATIONS, BrandCampiagnTableMap::COL_FOCUS_BRANDS, BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY, BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY, BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN, BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN, BrandCampiagnTableMap::COL_IS_SUSPENDED, BrandCampiagnTableMap::COL_STATUS, BrandCampiagnTableMap::COL_CAMPIAGN_TYPE, BrandCampiagnTableMap::COL_DESIGNATION, BrandCampiagnTableMap::COL_POSITION, BrandCampiagnTableMap::COL_SGPI_BRANDS, BrandCampiagnTableMap::COL_COMMENT, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_id', 'campiagn_name', 'start_date', 'end_date', 'locking_date', 'doctor_count', 'focus_brand_id', 'planned', 'done', 'distributed', 'distributed_done', 'classification_id', 'description', 'media', 'material', 'type', 'tags', 'company_id', 'created_at', 'updated_at', 'org_unit_id', 'brand_campiagn_code', 'outlettype_id', 'classifications', 'focus_brands', 'minimum_per_territory', 'maximum_per_territory', 'minimum_for_campiagn', 'maximum_for_campiagn', 'is_suspended', 'status', 'campiagn_type', 'designation', 'position', 'sgpi_brands', 'comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, ]
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
        self::TYPE_PHPNAME       => ['BrandCampiagnId' => 0, 'CampiagnName' => 1, 'StartDate' => 2, 'EndDate' => 3, 'LockingDate' => 4, 'DoctorCount' => 5, 'FocusBrandId' => 6, 'Planned' => 7, 'Done' => 8, 'Distributed' => 9, 'DistributedDone' => 10, 'ClassificationId' => 11, 'Description' => 12, 'Media' => 13, 'Material' => 14, 'Type' => 15, 'Tags' => 16, 'CompanyId' => 17, 'CreatedAt' => 18, 'UpdatedAt' => 19, 'OrgUnitId' => 20, 'BrandCampiagnCode' => 21, 'OutlettypeId' => 22, 'Classifications' => 23, 'FocusBrands' => 24, 'MinimumPerTerritory' => 25, 'MaximumPerTerritory' => 26, 'MinimumForCampiagn' => 27, 'MaximumForCampiagn' => 28, 'IsSuspended' => 29, 'Status' => 30, 'CampiagnType' => 31, 'Designation' => 32, 'Position' => 33, 'SgpiBrands' => 34, 'Comment' => 35, ],
        self::TYPE_CAMELNAME     => ['brandCampiagnId' => 0, 'campiagnName' => 1, 'startDate' => 2, 'endDate' => 3, 'lockingDate' => 4, 'doctorCount' => 5, 'focusBrandId' => 6, 'planned' => 7, 'done' => 8, 'distributed' => 9, 'distributedDone' => 10, 'classificationId' => 11, 'description' => 12, 'media' => 13, 'material' => 14, 'type' => 15, 'tags' => 16, 'companyId' => 17, 'createdAt' => 18, 'updatedAt' => 19, 'orgUnitId' => 20, 'brandCampiagnCode' => 21, 'outlettypeId' => 22, 'classifications' => 23, 'focusBrands' => 24, 'minimumPerTerritory' => 25, 'maximumPerTerritory' => 26, 'minimumForCampiagn' => 27, 'maximumForCampiagn' => 28, 'isSuspended' => 29, 'status' => 30, 'campiagnType' => 31, 'designation' => 32, 'position' => 33, 'sgpiBrands' => 34, 'comment' => 35, ],
        self::TYPE_COLNAME       => [BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID => 0, BrandCampiagnTableMap::COL_CAMPIAGN_NAME => 1, BrandCampiagnTableMap::COL_START_DATE => 2, BrandCampiagnTableMap::COL_END_DATE => 3, BrandCampiagnTableMap::COL_LOCKING_DATE => 4, BrandCampiagnTableMap::COL_DOCTOR_COUNT => 5, BrandCampiagnTableMap::COL_FOCUS_BRAND_ID => 6, BrandCampiagnTableMap::COL_PLANNED => 7, BrandCampiagnTableMap::COL_DONE => 8, BrandCampiagnTableMap::COL_DISTRIBUTED => 9, BrandCampiagnTableMap::COL_DISTRIBUTED_DONE => 10, BrandCampiagnTableMap::COL_CLASSIFICATION_ID => 11, BrandCampiagnTableMap::COL_DESCRIPTION => 12, BrandCampiagnTableMap::COL_MEDIA => 13, BrandCampiagnTableMap::COL_MATERIAL => 14, BrandCampiagnTableMap::COL_TYPE => 15, BrandCampiagnTableMap::COL_TAGS => 16, BrandCampiagnTableMap::COL_COMPANY_ID => 17, BrandCampiagnTableMap::COL_CREATED_AT => 18, BrandCampiagnTableMap::COL_UPDATED_AT => 19, BrandCampiagnTableMap::COL_ORG_UNIT_ID => 20, BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE => 21, BrandCampiagnTableMap::COL_OUTLETTYPE_ID => 22, BrandCampiagnTableMap::COL_CLASSIFICATIONS => 23, BrandCampiagnTableMap::COL_FOCUS_BRANDS => 24, BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY => 25, BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY => 26, BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN => 27, BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN => 28, BrandCampiagnTableMap::COL_IS_SUSPENDED => 29, BrandCampiagnTableMap::COL_STATUS => 30, BrandCampiagnTableMap::COL_CAMPIAGN_TYPE => 31, BrandCampiagnTableMap::COL_DESIGNATION => 32, BrandCampiagnTableMap::COL_POSITION => 33, BrandCampiagnTableMap::COL_SGPI_BRANDS => 34, BrandCampiagnTableMap::COL_COMMENT => 35, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_id' => 0, 'campiagn_name' => 1, 'start_date' => 2, 'end_date' => 3, 'locking_date' => 4, 'doctor_count' => 5, 'focus_brand_id' => 6, 'planned' => 7, 'done' => 8, 'distributed' => 9, 'distributed_done' => 10, 'classification_id' => 11, 'description' => 12, 'media' => 13, 'material' => 14, 'type' => 15, 'tags' => 16, 'company_id' => 17, 'created_at' => 18, 'updated_at' => 19, 'org_unit_id' => 20, 'brand_campiagn_code' => 21, 'outlettype_id' => 22, 'classifications' => 23, 'focus_brands' => 24, 'minimum_per_territory' => 25, 'maximum_per_territory' => 26, 'minimum_for_campiagn' => 27, 'maximum_for_campiagn' => 28, 'is_suspended' => 29, 'status' => 30, 'campiagn_type' => 31, 'designation' => 32, 'position' => 33, 'sgpi_brands' => 34, 'comment' => 35, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagn.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagn.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'CampiagnName' => 'CAMPIAGN_NAME',
        'BrandCampiagn.CampiagnName' => 'CAMPIAGN_NAME',
        'campiagnName' => 'CAMPIAGN_NAME',
        'brandCampiagn.campiagnName' => 'CAMPIAGN_NAME',
        'BrandCampiagnTableMap::COL_CAMPIAGN_NAME' => 'CAMPIAGN_NAME',
        'COL_CAMPIAGN_NAME' => 'CAMPIAGN_NAME',
        'campiagn_name' => 'CAMPIAGN_NAME',
        'brand_campiagn.campiagn_name' => 'CAMPIAGN_NAME',
        'StartDate' => 'START_DATE',
        'BrandCampiagn.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'brandCampiagn.startDate' => 'START_DATE',
        'BrandCampiagnTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'brand_campiagn.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'BrandCampiagn.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'brandCampiagn.endDate' => 'END_DATE',
        'BrandCampiagnTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'brand_campiagn.end_date' => 'END_DATE',
        'LockingDate' => 'LOCKING_DATE',
        'BrandCampiagn.LockingDate' => 'LOCKING_DATE',
        'lockingDate' => 'LOCKING_DATE',
        'brandCampiagn.lockingDate' => 'LOCKING_DATE',
        'BrandCampiagnTableMap::COL_LOCKING_DATE' => 'LOCKING_DATE',
        'COL_LOCKING_DATE' => 'LOCKING_DATE',
        'locking_date' => 'LOCKING_DATE',
        'brand_campiagn.locking_date' => 'LOCKING_DATE',
        'DoctorCount' => 'DOCTOR_COUNT',
        'BrandCampiagn.DoctorCount' => 'DOCTOR_COUNT',
        'doctorCount' => 'DOCTOR_COUNT',
        'brandCampiagn.doctorCount' => 'DOCTOR_COUNT',
        'BrandCampiagnTableMap::COL_DOCTOR_COUNT' => 'DOCTOR_COUNT',
        'COL_DOCTOR_COUNT' => 'DOCTOR_COUNT',
        'doctor_count' => 'DOCTOR_COUNT',
        'brand_campiagn.doctor_count' => 'DOCTOR_COUNT',
        'FocusBrandId' => 'FOCUS_BRAND_ID',
        'BrandCampiagn.FocusBrandId' => 'FOCUS_BRAND_ID',
        'focusBrandId' => 'FOCUS_BRAND_ID',
        'brandCampiagn.focusBrandId' => 'FOCUS_BRAND_ID',
        'BrandCampiagnTableMap::COL_FOCUS_BRAND_ID' => 'FOCUS_BRAND_ID',
        'COL_FOCUS_BRAND_ID' => 'FOCUS_BRAND_ID',
        'focus_brand_id' => 'FOCUS_BRAND_ID',
        'brand_campiagn.focus_brand_id' => 'FOCUS_BRAND_ID',
        'Planned' => 'PLANNED',
        'BrandCampiagn.Planned' => 'PLANNED',
        'planned' => 'PLANNED',
        'brandCampiagn.planned' => 'PLANNED',
        'BrandCampiagnTableMap::COL_PLANNED' => 'PLANNED',
        'COL_PLANNED' => 'PLANNED',
        'brand_campiagn.planned' => 'PLANNED',
        'Done' => 'DONE',
        'BrandCampiagn.Done' => 'DONE',
        'done' => 'DONE',
        'brandCampiagn.done' => 'DONE',
        'BrandCampiagnTableMap::COL_DONE' => 'DONE',
        'COL_DONE' => 'DONE',
        'brand_campiagn.done' => 'DONE',
        'Distributed' => 'DISTRIBUTED',
        'BrandCampiagn.Distributed' => 'DISTRIBUTED',
        'distributed' => 'DISTRIBUTED',
        'brandCampiagn.distributed' => 'DISTRIBUTED',
        'BrandCampiagnTableMap::COL_DISTRIBUTED' => 'DISTRIBUTED',
        'COL_DISTRIBUTED' => 'DISTRIBUTED',
        'brand_campiagn.distributed' => 'DISTRIBUTED',
        'DistributedDone' => 'DISTRIBUTED_DONE',
        'BrandCampiagn.DistributedDone' => 'DISTRIBUTED_DONE',
        'distributedDone' => 'DISTRIBUTED_DONE',
        'brandCampiagn.distributedDone' => 'DISTRIBUTED_DONE',
        'BrandCampiagnTableMap::COL_DISTRIBUTED_DONE' => 'DISTRIBUTED_DONE',
        'COL_DISTRIBUTED_DONE' => 'DISTRIBUTED_DONE',
        'distributed_done' => 'DISTRIBUTED_DONE',
        'brand_campiagn.distributed_done' => 'DISTRIBUTED_DONE',
        'ClassificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagn.ClassificationId' => 'CLASSIFICATION_ID',
        'classificationId' => 'CLASSIFICATION_ID',
        'brandCampiagn.classificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagnTableMap::COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'classification_id' => 'CLASSIFICATION_ID',
        'brand_campiagn.classification_id' => 'CLASSIFICATION_ID',
        'Description' => 'DESCRIPTION',
        'BrandCampiagn.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'brandCampiagn.description' => 'DESCRIPTION',
        'BrandCampiagnTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'brand_campiagn.description' => 'DESCRIPTION',
        'Media' => 'MEDIA',
        'BrandCampiagn.Media' => 'MEDIA',
        'media' => 'MEDIA',
        'brandCampiagn.media' => 'MEDIA',
        'BrandCampiagnTableMap::COL_MEDIA' => 'MEDIA',
        'COL_MEDIA' => 'MEDIA',
        'brand_campiagn.media' => 'MEDIA',
        'Material' => 'MATERIAL',
        'BrandCampiagn.Material' => 'MATERIAL',
        'material' => 'MATERIAL',
        'brandCampiagn.material' => 'MATERIAL',
        'BrandCampiagnTableMap::COL_MATERIAL' => 'MATERIAL',
        'COL_MATERIAL' => 'MATERIAL',
        'brand_campiagn.material' => 'MATERIAL',
        'Type' => 'TYPE',
        'BrandCampiagn.Type' => 'TYPE',
        'type' => 'TYPE',
        'brandCampiagn.type' => 'TYPE',
        'BrandCampiagnTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'brand_campiagn.type' => 'TYPE',
        'Tags' => 'TAGS',
        'BrandCampiagn.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'brandCampiagn.tags' => 'TAGS',
        'BrandCampiagnTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'brand_campiagn.tags' => 'TAGS',
        'CompanyId' => 'COMPANY_ID',
        'BrandCampiagn.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brandCampiagn.companyId' => 'COMPANY_ID',
        'BrandCampiagnTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brand_campiagn.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCampiagn.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCampiagn.createdAt' => 'CREATED_AT',
        'BrandCampiagnTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_campiagn.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCampiagn.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCampiagn.updatedAt' => 'UPDATED_AT',
        'BrandCampiagnTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_campiagn.updated_at' => 'UPDATED_AT',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'BrandCampiagn.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'brandCampiagn.orgUnitId' => 'ORG_UNIT_ID',
        'BrandCampiagnTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'brand_campiagn.org_unit_id' => 'ORG_UNIT_ID',
        'BrandCampiagnCode' => 'BRAND_CAMPIAGN_CODE',
        'BrandCampiagn.BrandCampiagnCode' => 'BRAND_CAMPIAGN_CODE',
        'brandCampiagnCode' => 'BRAND_CAMPIAGN_CODE',
        'brandCampiagn.brandCampiagnCode' => 'BRAND_CAMPIAGN_CODE',
        'BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE' => 'BRAND_CAMPIAGN_CODE',
        'COL_BRAND_CAMPIAGN_CODE' => 'BRAND_CAMPIAGN_CODE',
        'brand_campiagn_code' => 'BRAND_CAMPIAGN_CODE',
        'brand_campiagn.brand_campiagn_code' => 'BRAND_CAMPIAGN_CODE',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'BrandCampiagn.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'brandCampiagn.outlettypeId' => 'OUTLETTYPE_ID',
        'BrandCampiagnTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'brand_campiagn.outlettype_id' => 'OUTLETTYPE_ID',
        'Classifications' => 'CLASSIFICATIONS',
        'BrandCampiagn.Classifications' => 'CLASSIFICATIONS',
        'classifications' => 'CLASSIFICATIONS',
        'brandCampiagn.classifications' => 'CLASSIFICATIONS',
        'BrandCampiagnTableMap::COL_CLASSIFICATIONS' => 'CLASSIFICATIONS',
        'COL_CLASSIFICATIONS' => 'CLASSIFICATIONS',
        'brand_campiagn.classifications' => 'CLASSIFICATIONS',
        'FocusBrands' => 'FOCUS_BRANDS',
        'BrandCampiagn.FocusBrands' => 'FOCUS_BRANDS',
        'focusBrands' => 'FOCUS_BRANDS',
        'brandCampiagn.focusBrands' => 'FOCUS_BRANDS',
        'BrandCampiagnTableMap::COL_FOCUS_BRANDS' => 'FOCUS_BRANDS',
        'COL_FOCUS_BRANDS' => 'FOCUS_BRANDS',
        'focus_brands' => 'FOCUS_BRANDS',
        'brand_campiagn.focus_brands' => 'FOCUS_BRANDS',
        'MinimumPerTerritory' => 'MINIMUM_PER_TERRITORY',
        'BrandCampiagn.MinimumPerTerritory' => 'MINIMUM_PER_TERRITORY',
        'minimumPerTerritory' => 'MINIMUM_PER_TERRITORY',
        'brandCampiagn.minimumPerTerritory' => 'MINIMUM_PER_TERRITORY',
        'BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY' => 'MINIMUM_PER_TERRITORY',
        'COL_MINIMUM_PER_TERRITORY' => 'MINIMUM_PER_TERRITORY',
        'minimum_per_territory' => 'MINIMUM_PER_TERRITORY',
        'brand_campiagn.minimum_per_territory' => 'MINIMUM_PER_TERRITORY',
        'MaximumPerTerritory' => 'MAXIMUM_PER_TERRITORY',
        'BrandCampiagn.MaximumPerTerritory' => 'MAXIMUM_PER_TERRITORY',
        'maximumPerTerritory' => 'MAXIMUM_PER_TERRITORY',
        'brandCampiagn.maximumPerTerritory' => 'MAXIMUM_PER_TERRITORY',
        'BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY' => 'MAXIMUM_PER_TERRITORY',
        'COL_MAXIMUM_PER_TERRITORY' => 'MAXIMUM_PER_TERRITORY',
        'maximum_per_territory' => 'MAXIMUM_PER_TERRITORY',
        'brand_campiagn.maximum_per_territory' => 'MAXIMUM_PER_TERRITORY',
        'MinimumForCampiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'BrandCampiagn.MinimumForCampiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'minimumForCampiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'brandCampiagn.minimumForCampiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN' => 'MINIMUM_FOR_CAMPIAGN',
        'COL_MINIMUM_FOR_CAMPIAGN' => 'MINIMUM_FOR_CAMPIAGN',
        'minimum_for_campiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'brand_campiagn.minimum_for_campiagn' => 'MINIMUM_FOR_CAMPIAGN',
        'MaximumForCampiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'BrandCampiagn.MaximumForCampiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'maximumForCampiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'brandCampiagn.maximumForCampiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN' => 'MAXIMUM_FOR_CAMPIAGN',
        'COL_MAXIMUM_FOR_CAMPIAGN' => 'MAXIMUM_FOR_CAMPIAGN',
        'maximum_for_campiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'brand_campiagn.maximum_for_campiagn' => 'MAXIMUM_FOR_CAMPIAGN',
        'IsSuspended' => 'IS_SUSPENDED',
        'BrandCampiagn.IsSuspended' => 'IS_SUSPENDED',
        'isSuspended' => 'IS_SUSPENDED',
        'brandCampiagn.isSuspended' => 'IS_SUSPENDED',
        'BrandCampiagnTableMap::COL_IS_SUSPENDED' => 'IS_SUSPENDED',
        'COL_IS_SUSPENDED' => 'IS_SUSPENDED',
        'is_suspended' => 'IS_SUSPENDED',
        'brand_campiagn.is_suspended' => 'IS_SUSPENDED',
        'Status' => 'STATUS',
        'BrandCampiagn.Status' => 'STATUS',
        'status' => 'STATUS',
        'brandCampiagn.status' => 'STATUS',
        'BrandCampiagnTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'brand_campiagn.status' => 'STATUS',
        'CampiagnType' => 'CAMPIAGN_TYPE',
        'BrandCampiagn.CampiagnType' => 'CAMPIAGN_TYPE',
        'campiagnType' => 'CAMPIAGN_TYPE',
        'brandCampiagn.campiagnType' => 'CAMPIAGN_TYPE',
        'BrandCampiagnTableMap::COL_CAMPIAGN_TYPE' => 'CAMPIAGN_TYPE',
        'COL_CAMPIAGN_TYPE' => 'CAMPIAGN_TYPE',
        'campiagn_type' => 'CAMPIAGN_TYPE',
        'brand_campiagn.campiagn_type' => 'CAMPIAGN_TYPE',
        'Designation' => 'DESIGNATION',
        'BrandCampiagn.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'brandCampiagn.designation' => 'DESIGNATION',
        'BrandCampiagnTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'brand_campiagn.designation' => 'DESIGNATION',
        'Position' => 'POSITION',
        'BrandCampiagn.Position' => 'POSITION',
        'position' => 'POSITION',
        'brandCampiagn.position' => 'POSITION',
        'BrandCampiagnTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'brand_campiagn.position' => 'POSITION',
        'SgpiBrands' => 'SGPI_BRANDS',
        'BrandCampiagn.SgpiBrands' => 'SGPI_BRANDS',
        'sgpiBrands' => 'SGPI_BRANDS',
        'brandCampiagn.sgpiBrands' => 'SGPI_BRANDS',
        'BrandCampiagnTableMap::COL_SGPI_BRANDS' => 'SGPI_BRANDS',
        'COL_SGPI_BRANDS' => 'SGPI_BRANDS',
        'sgpi_brands' => 'SGPI_BRANDS',
        'brand_campiagn.sgpi_brands' => 'SGPI_BRANDS',
        'Comment' => 'COMMENT',
        'BrandCampiagn.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'brandCampiagn.comment' => 'COMMENT',
        'BrandCampiagnTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'brand_campiagn.comment' => 'COMMENT',
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
        $this->setName('brand_campiagn');
        $this->setPhpName('BrandCampiagn');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCampiagn');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_campiagn_brand_campiagn_id_seq');
        // columns
        $this->addPrimaryKey('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', true, null, null);
        $this->addColumn('campiagn_name', 'CampiagnName', 'VARCHAR', false, null, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addColumn('locking_date', 'LockingDate', 'DATE', false, null, null);
        $this->addColumn('doctor_count', 'DoctorCount', 'INTEGER', false, null, null);
        $this->addForeignKey('focus_brand_id', 'FocusBrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('planned', 'Planned', 'VARCHAR', false, null, null);
        $this->addColumn('done', 'Done', 'VARCHAR', false, null, null);
        $this->addColumn('distributed', 'Distributed', 'VARCHAR', false, null, null);
        $this->addColumn('distributed_done', 'DistributedDone', 'VARCHAR', false, null, null);
        $this->addColumn('classification_id', 'ClassificationId', 'VARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('media', 'Media', 'VARCHAR', false, null, null);
        $this->addColumn('material', 'Material', 'VARCHAR', false, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('brand_campiagn_code', 'BrandCampiagnCode', 'VARCHAR', false, 250, null);
        $this->addForeignKey('outlettype_id', 'OutlettypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('classifications', 'Classifications', 'LONGVARCHAR', false, null, null);
        $this->addColumn('focus_brands', 'FocusBrands', 'LONGVARCHAR', false, null, null);
        $this->addColumn('minimum_per_territory', 'MinimumPerTerritory', 'INTEGER', false, null, null);
        $this->addColumn('maximum_per_territory', 'MaximumPerTerritory', 'INTEGER', false, null, null);
        $this->addColumn('minimum_for_campiagn', 'MinimumForCampiagn', 'INTEGER', false, null, 1);
        $this->addColumn('maximum_for_campiagn', 'MaximumForCampiagn', 'INTEGER', false, null, null);
        $this->addColumn('is_suspended', 'IsSuspended', 'BOOLEAN', false, 1, false);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 250, null);
        $this->addColumn('campiagn_type', 'CampiagnType', 'VARCHAR', false, null, null);
        $this->addForeignKey('designation', 'Designation', 'INTEGER', 'designations', 'designation_id', false, null, null);
        $this->addColumn('position', 'Position', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sgpi_brands', 'SgpiBrands', 'LONGVARCHAR', false, null, null);
        $this->addColumn('comment', 'Comment', 'LONGVARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Designations', '\\entities\\Designations', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':designation',
    1 => ':designation_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':focus_brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnClassification', '\\entities\\BrandCampiagnClassification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, 'BrandCampiagnClassifications', false);
        $this->addRelation('BrandCampiagnDoctors', '\\entities\\BrandCampiagnDoctors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, 'BrandCampiagnDoctorss', false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, 'BrandCampiagnVisitPlans', false);
        $this->addRelation('BrandCampiagnVisits', '\\entities\\BrandCampiagnVisits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, 'BrandCampiagnVisitss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandCampiagnId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCampiagnTableMap::CLASS_DEFAULT : BrandCampiagnTableMap::OM_CLASS;
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
     * @return array (BrandCampiagn object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCampiagnTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCampiagnTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCampiagnTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCampiagnTableMap::OM_CLASS;
            /** @var BrandCampiagn $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCampiagnTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCampiagnTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCampiagnTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCampiagn $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCampiagnTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_CAMPIAGN_NAME);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_START_DATE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_END_DATE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_LOCKING_DATE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DOCTOR_COUNT);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_PLANNED);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DONE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DISTRIBUTED);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_CLASSIFICATION_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MEDIA);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MATERIAL);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_TYPE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_TAGS);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_CLASSIFICATIONS);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_FOCUS_BRANDS);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_IS_SUSPENDED);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_STATUS);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_POSITION);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_SGPI_BRANDS);
            $criteria->addSelectColumn(BrandCampiagnTableMap::COL_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.campiagn_name');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.locking_date');
            $criteria->addSelectColumn($alias . '.doctor_count');
            $criteria->addSelectColumn($alias . '.focus_brand_id');
            $criteria->addSelectColumn($alias . '.planned');
            $criteria->addSelectColumn($alias . '.done');
            $criteria->addSelectColumn($alias . '.distributed');
            $criteria->addSelectColumn($alias . '.distributed_done');
            $criteria->addSelectColumn($alias . '.classification_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.media');
            $criteria->addSelectColumn($alias . '.material');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_code');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.classifications');
            $criteria->addSelectColumn($alias . '.focus_brands');
            $criteria->addSelectColumn($alias . '.minimum_per_territory');
            $criteria->addSelectColumn($alias . '.maximum_per_territory');
            $criteria->addSelectColumn($alias . '.minimum_for_campiagn');
            $criteria->addSelectColumn($alias . '.maximum_for_campiagn');
            $criteria->addSelectColumn($alias . '.is_suspended');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.campiagn_type');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.sgpi_brands');
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
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_CAMPIAGN_NAME);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_END_DATE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_LOCKING_DATE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DOCTOR_COUNT);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_FOCUS_BRAND_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_PLANNED);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DONE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DISTRIBUTED);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DISTRIBUTED_DONE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_CLASSIFICATION_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MEDIA);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MATERIAL);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_TYPE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_TAGS);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_CODE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_CLASSIFICATIONS);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_FOCUS_BRANDS);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MINIMUM_PER_TERRITORY);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MAXIMUM_PER_TERRITORY);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MINIMUM_FOR_CAMPIAGN);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_MAXIMUM_FOR_CAMPIAGN);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_IS_SUSPENDED);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_STATUS);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_CAMPIAGN_TYPE);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_POSITION);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_SGPI_BRANDS);
            $criteria->removeSelectColumn(BrandCampiagnTableMap::COL_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.campiagn_name');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
            $criteria->removeSelectColumn($alias . '.locking_date');
            $criteria->removeSelectColumn($alias . '.doctor_count');
            $criteria->removeSelectColumn($alias . '.focus_brand_id');
            $criteria->removeSelectColumn($alias . '.planned');
            $criteria->removeSelectColumn($alias . '.done');
            $criteria->removeSelectColumn($alias . '.distributed');
            $criteria->removeSelectColumn($alias . '.distributed_done');
            $criteria->removeSelectColumn($alias . '.classification_id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.media');
            $criteria->removeSelectColumn($alias . '.material');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_code');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.classifications');
            $criteria->removeSelectColumn($alias . '.focus_brands');
            $criteria->removeSelectColumn($alias . '.minimum_per_territory');
            $criteria->removeSelectColumn($alias . '.maximum_per_territory');
            $criteria->removeSelectColumn($alias . '.minimum_for_campiagn');
            $criteria->removeSelectColumn($alias . '.maximum_for_campiagn');
            $criteria->removeSelectColumn($alias . '.is_suspended');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.campiagn_type');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.sgpi_brands');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCampiagnTableMap::DATABASE_NAME)->getTable(BrandCampiagnTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCampiagn or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCampiagn object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCampiagn) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCampiagnTableMap::DATABASE_NAME);
            $criteria->add(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCampiagnQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCampiagnTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCampiagnTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_campiagn table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCampiagnQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCampiagn or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCampiagn object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCampiagn object
        }

        if ($criteria->containsKey(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID) && $criteria->keyContainsValue(BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCampiagnTableMap::COL_BRAND_CAMPIAGN_ID.')');
        }


        // Set the correct dbName
        $query = BrandCampiagnQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

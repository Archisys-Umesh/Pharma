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
use entities\SurveySubmited;
use entities\SurveySubmitedQuery;


/**
 * This class defines the structure of the 'survey_submited' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SurveySubmitedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SurveySubmitedTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'survey_submited';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SurveySubmited';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SurveySubmited';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SurveySubmited';

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
     * the column name for the survery_submit_id field
     */
    public const COL_SURVERY_SUBMIT_ID = 'survey_submited.survery_submit_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'survey_submited.employee_id';

    /**
     * the column name for the submit_date field
     */
    public const COL_SUBMIT_DATE = 'survey_submited.submit_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'survey_submited.company_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'survey_submited.outlet_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'survey_submited.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'survey_submited.updated_at';

    /**
     * the column name for the survey_id field
     */
    public const COL_SURVEY_ID = 'survey_submited.survey_id';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'survey_submited.dcr_id';

    /**
     * the column name for the audience_type field
     */
    public const COL_AUDIENCE_TYPE = 'survey_submited.audience_type';

    /**
     * the column name for the short_code field
     */
    public const COL_SHORT_CODE = 'survey_submited.short_code';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'survey_submited.status';

    /**
     * the column name for the for_employee_id field
     */
    public const COL_FOR_EMPLOYEE_ID = 'survey_submited.for_employee_id';

    /**
     * the column name for the brandcampaign_visit_plan_id field
     */
    public const COL_BRANDCAMPAIGN_VISIT_PLAN_ID = 'survey_submited.brandcampaign_visit_plan_id';

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
        self::TYPE_PHPNAME       => ['SurverySubmitId', 'EmployeeId', 'SubmitDate', 'CompanyId', 'OutletId', 'CreatedAt', 'UpdatedAt', 'SurveyId', 'DcrId', 'AudienceType', 'ShortCode', 'Status', 'ForEmployeeId', 'BrandcampaignVisitPlanId', ],
        self::TYPE_CAMELNAME     => ['surverySubmitId', 'employeeId', 'submitDate', 'companyId', 'outletId', 'createdAt', 'updatedAt', 'surveyId', 'dcrId', 'audienceType', 'shortCode', 'status', 'forEmployeeId', 'brandcampaignVisitPlanId', ],
        self::TYPE_COLNAME       => [SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, SurveySubmitedTableMap::COL_EMPLOYEE_ID, SurveySubmitedTableMap::COL_SUBMIT_DATE, SurveySubmitedTableMap::COL_COMPANY_ID, SurveySubmitedTableMap::COL_OUTLET_ID, SurveySubmitedTableMap::COL_CREATED_AT, SurveySubmitedTableMap::COL_UPDATED_AT, SurveySubmitedTableMap::COL_SURVEY_ID, SurveySubmitedTableMap::COL_DCR_ID, SurveySubmitedTableMap::COL_AUDIENCE_TYPE, SurveySubmitedTableMap::COL_SHORT_CODE, SurveySubmitedTableMap::COL_STATUS, SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID, SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID, ],
        self::TYPE_FIELDNAME     => ['survery_submit_id', 'employee_id', 'submit_date', 'company_id', 'outlet_id', 'created_at', 'updated_at', 'survey_id', 'dcr_id', 'audience_type', 'short_code', 'status', 'for_employee_id', 'brandcampaign_visit_plan_id', ],
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
        self::TYPE_PHPNAME       => ['SurverySubmitId' => 0, 'EmployeeId' => 1, 'SubmitDate' => 2, 'CompanyId' => 3, 'OutletId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'SurveyId' => 7, 'DcrId' => 8, 'AudienceType' => 9, 'ShortCode' => 10, 'Status' => 11, 'ForEmployeeId' => 12, 'BrandcampaignVisitPlanId' => 13, ],
        self::TYPE_CAMELNAME     => ['surverySubmitId' => 0, 'employeeId' => 1, 'submitDate' => 2, 'companyId' => 3, 'outletId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'surveyId' => 7, 'dcrId' => 8, 'audienceType' => 9, 'shortCode' => 10, 'status' => 11, 'forEmployeeId' => 12, 'brandcampaignVisitPlanId' => 13, ],
        self::TYPE_COLNAME       => [SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID => 0, SurveySubmitedTableMap::COL_EMPLOYEE_ID => 1, SurveySubmitedTableMap::COL_SUBMIT_DATE => 2, SurveySubmitedTableMap::COL_COMPANY_ID => 3, SurveySubmitedTableMap::COL_OUTLET_ID => 4, SurveySubmitedTableMap::COL_CREATED_AT => 5, SurveySubmitedTableMap::COL_UPDATED_AT => 6, SurveySubmitedTableMap::COL_SURVEY_ID => 7, SurveySubmitedTableMap::COL_DCR_ID => 8, SurveySubmitedTableMap::COL_AUDIENCE_TYPE => 9, SurveySubmitedTableMap::COL_SHORT_CODE => 10, SurveySubmitedTableMap::COL_STATUS => 11, SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID => 12, SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID => 13, ],
        self::TYPE_FIELDNAME     => ['survery_submit_id' => 0, 'employee_id' => 1, 'submit_date' => 2, 'company_id' => 3, 'outlet_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'survey_id' => 7, 'dcr_id' => 8, 'audience_type' => 9, 'short_code' => 10, 'status' => 11, 'for_employee_id' => 12, 'brandcampaign_visit_plan_id' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SurverySubmitId' => 'SURVERY_SUBMIT_ID',
        'SurveySubmited.SurverySubmitId' => 'SURVERY_SUBMIT_ID',
        'surverySubmitId' => 'SURVERY_SUBMIT_ID',
        'surveySubmited.surverySubmitId' => 'SURVERY_SUBMIT_ID',
        'SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID' => 'SURVERY_SUBMIT_ID',
        'COL_SURVERY_SUBMIT_ID' => 'SURVERY_SUBMIT_ID',
        'survery_submit_id' => 'SURVERY_SUBMIT_ID',
        'survey_submited.survery_submit_id' => 'SURVERY_SUBMIT_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'SurveySubmited.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'surveySubmited.employeeId' => 'EMPLOYEE_ID',
        'SurveySubmitedTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'survey_submited.employee_id' => 'EMPLOYEE_ID',
        'SubmitDate' => 'SUBMIT_DATE',
        'SurveySubmited.SubmitDate' => 'SUBMIT_DATE',
        'submitDate' => 'SUBMIT_DATE',
        'surveySubmited.submitDate' => 'SUBMIT_DATE',
        'SurveySubmitedTableMap::COL_SUBMIT_DATE' => 'SUBMIT_DATE',
        'COL_SUBMIT_DATE' => 'SUBMIT_DATE',
        'submit_date' => 'SUBMIT_DATE',
        'survey_submited.submit_date' => 'SUBMIT_DATE',
        'CompanyId' => 'COMPANY_ID',
        'SurveySubmited.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'surveySubmited.companyId' => 'COMPANY_ID',
        'SurveySubmitedTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'survey_submited.company_id' => 'COMPANY_ID',
        'OutletId' => 'OUTLET_ID',
        'SurveySubmited.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'surveySubmited.outletId' => 'OUTLET_ID',
        'SurveySubmitedTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'survey_submited.outlet_id' => 'OUTLET_ID',
        'CreatedAt' => 'CREATED_AT',
        'SurveySubmited.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'surveySubmited.createdAt' => 'CREATED_AT',
        'SurveySubmitedTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'survey_submited.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SurveySubmited.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'surveySubmited.updatedAt' => 'UPDATED_AT',
        'SurveySubmitedTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'survey_submited.updated_at' => 'UPDATED_AT',
        'SurveyId' => 'SURVEY_ID',
        'SurveySubmited.SurveyId' => 'SURVEY_ID',
        'surveyId' => 'SURVEY_ID',
        'surveySubmited.surveyId' => 'SURVEY_ID',
        'SurveySubmitedTableMap::COL_SURVEY_ID' => 'SURVEY_ID',
        'COL_SURVEY_ID' => 'SURVEY_ID',
        'survey_id' => 'SURVEY_ID',
        'survey_submited.survey_id' => 'SURVEY_ID',
        'DcrId' => 'DCR_ID',
        'SurveySubmited.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'surveySubmited.dcrId' => 'DCR_ID',
        'SurveySubmitedTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'survey_submited.dcr_id' => 'DCR_ID',
        'AudienceType' => 'AUDIENCE_TYPE',
        'SurveySubmited.AudienceType' => 'AUDIENCE_TYPE',
        'audienceType' => 'AUDIENCE_TYPE',
        'surveySubmited.audienceType' => 'AUDIENCE_TYPE',
        'SurveySubmitedTableMap::COL_AUDIENCE_TYPE' => 'AUDIENCE_TYPE',
        'COL_AUDIENCE_TYPE' => 'AUDIENCE_TYPE',
        'audience_type' => 'AUDIENCE_TYPE',
        'survey_submited.audience_type' => 'AUDIENCE_TYPE',
        'ShortCode' => 'SHORT_CODE',
        'SurveySubmited.ShortCode' => 'SHORT_CODE',
        'shortCode' => 'SHORT_CODE',
        'surveySubmited.shortCode' => 'SHORT_CODE',
        'SurveySubmitedTableMap::COL_SHORT_CODE' => 'SHORT_CODE',
        'COL_SHORT_CODE' => 'SHORT_CODE',
        'short_code' => 'SHORT_CODE',
        'survey_submited.short_code' => 'SHORT_CODE',
        'Status' => 'STATUS',
        'SurveySubmited.Status' => 'STATUS',
        'status' => 'STATUS',
        'surveySubmited.status' => 'STATUS',
        'SurveySubmitedTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'survey_submited.status' => 'STATUS',
        'ForEmployeeId' => 'FOR_EMPLOYEE_ID',
        'SurveySubmited.ForEmployeeId' => 'FOR_EMPLOYEE_ID',
        'forEmployeeId' => 'FOR_EMPLOYEE_ID',
        'surveySubmited.forEmployeeId' => 'FOR_EMPLOYEE_ID',
        'SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID' => 'FOR_EMPLOYEE_ID',
        'COL_FOR_EMPLOYEE_ID' => 'FOR_EMPLOYEE_ID',
        'for_employee_id' => 'FOR_EMPLOYEE_ID',
        'survey_submited.for_employee_id' => 'FOR_EMPLOYEE_ID',
        'BrandcampaignVisitPlanId' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'SurveySubmited.BrandcampaignVisitPlanId' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'brandcampaignVisitPlanId' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'surveySubmited.brandcampaignVisitPlanId' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'COL_BRANDCAMPAIGN_VISIT_PLAN_ID' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'brandcampaign_visit_plan_id' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
        'survey_submited.brandcampaign_visit_plan_id' => 'BRANDCAMPAIGN_VISIT_PLAN_ID',
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
        $this->setName('survey_submited');
        $this->setPhpName('SurveySubmited');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SurveySubmited');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('survey_submited_survery_submit_id_seq');
        // columns
        $this->addPrimaryKey('survery_submit_id', 'SurverySubmitId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('submit_date', 'SubmitDate', 'DATE', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'BIGINT', 'outlets', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('survey_id', 'SurveyId', 'BIGINT', false, null, null);
        $this->addForeignKey('dcr_id', 'DcrId', 'INTEGER', 'dailycalls', 'dcr_id', false, null, null);
        $this->addColumn('audience_type', 'AudienceType', 'VARCHAR', false, null, null);
        $this->addColumn('short_code', 'ShortCode', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('for_employee_id', 'ForEmployeeId', 'BIGINT', false, null, null);
        $this->addForeignKey('brandcampaign_visit_plan_id', 'BrandcampaignVisitPlanId', 'INTEGER', 'brand_campiagn_visit_plan', 'brand_campiagn_visit_plan_id', false, null, null);
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
), null, null, null, false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':dcr_id',
    1 => ':dcr_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brandcampaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, null, false);
        $this->addRelation('SurveySubmitedAnswer', '\\entities\\SurveySubmitedAnswer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':survey_submited_id',
    1 => ':survery_submit_id',
  ),
), null, null, 'SurveySubmitedAnswers', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SurverySubmitId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SurveySubmitedTableMap::CLASS_DEFAULT : SurveySubmitedTableMap::OM_CLASS;
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
     * @return array (SurveySubmited object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SurveySubmitedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SurveySubmitedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SurveySubmitedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SurveySubmitedTableMap::OM_CLASS;
            /** @var SurveySubmited $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SurveySubmitedTableMap::addInstanceToPool($obj, $key);
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
            $key = SurveySubmitedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SurveySubmitedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SurveySubmited $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SurveySubmitedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_SUBMIT_DATE);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_SURVEY_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_AUDIENCE_TYPE);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_SHORT_CODE);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_STATUS);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID);
            $criteria->addSelectColumn(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->addSelectColumn($alias . '.survery_submit_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.submit_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.survey_id');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.audience_type');
            $criteria->addSelectColumn($alias . '.short_code');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.for_employee_id');
            $criteria->addSelectColumn($alias . '.brandcampaign_visit_plan_id');
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
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_SUBMIT_DATE);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_SURVEY_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_AUDIENCE_TYPE);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_SHORT_CODE);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_FOR_EMPLOYEE_ID);
            $criteria->removeSelectColumn(SurveySubmitedTableMap::COL_BRANDCAMPAIGN_VISIT_PLAN_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.survery_submit_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.submit_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.survey_id');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.audience_type');
            $criteria->removeSelectColumn($alias . '.short_code');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.for_employee_id');
            $criteria->removeSelectColumn($alias . '.brandcampaign_visit_plan_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SurveySubmitedTableMap::DATABASE_NAME)->getTable(SurveySubmitedTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SurveySubmited or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SurveySubmited object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SurveySubmited) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SurveySubmitedTableMap::DATABASE_NAME);
            $criteria->add(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID, (array) $values, Criteria::IN);
        }

        $query = SurveySubmitedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SurveySubmitedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SurveySubmitedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the survey_submited table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SurveySubmitedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SurveySubmited or Criteria object.
     *
     * @param mixed $criteria Criteria or SurveySubmited object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SurveySubmited object
        }

        if ($criteria->containsKey(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID) && $criteria->keyContainsValue(SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SurveySubmitedTableMap::COL_SURVERY_SUBMIT_ID.')');
        }


        // Set the correct dbName
        $query = SurveySubmitedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

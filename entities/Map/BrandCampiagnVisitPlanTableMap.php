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
use entities\BrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery;


/**
 * This class defines the structure of the 'brand_campiagn_visit_plan' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCampiagnVisitPlanTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCampiagnVisitPlanTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_campiagn_visit_plan';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCampiagnVisitPlan';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCampiagnVisitPlan';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCampiagnVisitPlan';

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
     * the column name for the brand_campiagn_visit_plan_id field
     */
    public const COL_BRAND_CAMPIAGN_VISIT_PLAN_ID = 'brand_campiagn_visit_plan.brand_campiagn_visit_plan_id';

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'brand_campiagn_visit_plan.brand_campiagn_id';

    /**
     * the column name for the visit_plan_order field
     */
    public const COL_VISIT_PLAN_ORDER = 'brand_campiagn_visit_plan.visit_plan_order';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'brand_campiagn_visit_plan.description';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brand_campiagn_visit_plan.company_id';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'brand_campiagn_visit_plan.sgpi_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_campiagn_visit_plan.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_campiagn_visit_plan.updated_at';

    /**
     * the column name for the step_name field
     */
    public const COL_STEP_NAME = 'brand_campiagn_visit_plan.step_name';

    /**
     * the column name for the step_level field
     */
    public const COL_STEP_LEVEL = 'brand_campiagn_visit_plan.step_level';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'brand_campiagn_visit_plan.moye';

    /**
     * the column name for the sgpi_status field
     */
    public const COL_SGPI_STATUS = 'brand_campiagn_visit_plan.sgpi_status';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'brand_campiagn_visit_plan.qty';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'brand_campiagn_visit_plan.comment';

    /**
     * the column name for the agenda_type field
     */
    public const COL_AGENDA_TYPE = 'brand_campiagn_visit_plan.agenda_type';

    /**
     * the column name for the agenda_sub_type_id field
     */
    public const COL_AGENDA_SUB_TYPE_ID = 'brand_campiagn_visit_plan.agenda_sub_type_id';

    /**
     * the column name for the create_survey field
     */
    public const COL_CREATE_SURVEY = 'brand_campiagn_visit_plan.create_survey';

    /**
     * the column name for the survey_id field
     */
    public const COL_SURVEY_ID = 'brand_campiagn_visit_plan.survey_id';

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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitPlanId', 'BrandCampiagnId', 'VisitPlanOrder', 'Description', 'CompanyId', 'SgpiId', 'CreatedAt', 'UpdatedAt', 'StepName', 'StepLevel', 'Moye', 'SgpiStatus', 'Qty', 'Comment', 'AgendaType', 'AgendaSubTypeId', 'CreateSurvey', 'SurveyId', ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitPlanId', 'brandCampiagnId', 'visitPlanOrder', 'description', 'companyId', 'sgpiId', 'createdAt', 'updatedAt', 'stepName', 'stepLevel', 'moye', 'sgpiStatus', 'qty', 'comment', 'agendaType', 'agendaSubTypeId', 'createSurvey', 'surveyId', ],
        self::TYPE_COLNAME       => [BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER, BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION, BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, BrandCampiagnVisitPlanTableMap::COL_SGPI_ID, BrandCampiagnVisitPlanTableMap::COL_CREATED_AT, BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT, BrandCampiagnVisitPlanTableMap::COL_STEP_NAME, BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL, BrandCampiagnVisitPlanTableMap::COL_MOYE, BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS, BrandCampiagnVisitPlanTableMap::COL_QTY, BrandCampiagnVisitPlanTableMap::COL_COMMENT, BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE, BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY, BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_plan_id', 'brand_campiagn_id', 'visit_plan_order', 'description', 'company_id', 'sgpi_id', 'created_at', 'updated_at', 'step_name', 'step_level', 'moye', 'sgpi_status', 'qty', 'comment', 'agenda_type', 'agenda_sub_type_id', 'create_survey', 'survey_id', ],
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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitPlanId' => 0, 'BrandCampiagnId' => 1, 'VisitPlanOrder' => 2, 'Description' => 3, 'CompanyId' => 4, 'SgpiId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'StepName' => 8, 'StepLevel' => 9, 'Moye' => 10, 'SgpiStatus' => 11, 'Qty' => 12, 'Comment' => 13, 'AgendaType' => 14, 'AgendaSubTypeId' => 15, 'CreateSurvey' => 16, 'SurveyId' => 17, ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitPlanId' => 0, 'brandCampiagnId' => 1, 'visitPlanOrder' => 2, 'description' => 3, 'companyId' => 4, 'sgpiId' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'stepName' => 8, 'stepLevel' => 9, 'moye' => 10, 'sgpiStatus' => 11, 'qty' => 12, 'comment' => 13, 'agendaType' => 14, 'agendaSubTypeId' => 15, 'createSurvey' => 16, 'surveyId' => 17, ],
        self::TYPE_COLNAME       => [BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID => 0, BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID => 1, BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER => 2, BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION => 3, BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID => 4, BrandCampiagnVisitPlanTableMap::COL_SGPI_ID => 5, BrandCampiagnVisitPlanTableMap::COL_CREATED_AT => 6, BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT => 7, BrandCampiagnVisitPlanTableMap::COL_STEP_NAME => 8, BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL => 9, BrandCampiagnVisitPlanTableMap::COL_MOYE => 10, BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS => 11, BrandCampiagnVisitPlanTableMap::COL_QTY => 12, BrandCampiagnVisitPlanTableMap::COL_COMMENT => 13, BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE => 14, BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID => 15, BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY => 16, BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID => 17, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_plan_id' => 0, 'brand_campiagn_id' => 1, 'visit_plan_order' => 2, 'description' => 3, 'company_id' => 4, 'sgpi_id' => 5, 'created_at' => 6, 'updated_at' => 7, 'step_name' => 8, 'step_level' => 9, 'moye' => 10, 'sgpi_status' => 11, 'qty' => 12, 'comment' => 13, 'agenda_type' => 14, 'agenda_sub_type_id' => 15, 'create_survey' => 16, 'survey_id' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'BrandCampiagnVisitPlan.BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brandCampiagnVisitPlan.brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brand_campiagn_visit_plan.brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisitPlan.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnVisitPlan.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_visit_plan.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'VisitPlanOrder' => 'VISIT_PLAN_ORDER',
        'BrandCampiagnVisitPlan.VisitPlanOrder' => 'VISIT_PLAN_ORDER',
        'visitPlanOrder' => 'VISIT_PLAN_ORDER',
        'brandCampiagnVisitPlan.visitPlanOrder' => 'VISIT_PLAN_ORDER',
        'BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER' => 'VISIT_PLAN_ORDER',
        'COL_VISIT_PLAN_ORDER' => 'VISIT_PLAN_ORDER',
        'visit_plan_order' => 'VISIT_PLAN_ORDER',
        'brand_campiagn_visit_plan.visit_plan_order' => 'VISIT_PLAN_ORDER',
        'Description' => 'DESCRIPTION',
        'BrandCampiagnVisitPlan.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'brandCampiagnVisitPlan.description' => 'DESCRIPTION',
        'BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'brand_campiagn_visit_plan.description' => 'DESCRIPTION',
        'CompanyId' => 'COMPANY_ID',
        'BrandCampiagnVisitPlan.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brandCampiagnVisitPlan.companyId' => 'COMPANY_ID',
        'BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brand_campiagn_visit_plan.company_id' => 'COMPANY_ID',
        'SgpiId' => 'SGPI_ID',
        'BrandCampiagnVisitPlan.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'brandCampiagnVisitPlan.sgpiId' => 'SGPI_ID',
        'BrandCampiagnVisitPlanTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'brand_campiagn_visit_plan.sgpi_id' => 'SGPI_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCampiagnVisitPlan.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCampiagnVisitPlan.createdAt' => 'CREATED_AT',
        'BrandCampiagnVisitPlanTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_campiagn_visit_plan.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCampiagnVisitPlan.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCampiagnVisitPlan.updatedAt' => 'UPDATED_AT',
        'BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_campiagn_visit_plan.updated_at' => 'UPDATED_AT',
        'StepName' => 'STEP_NAME',
        'BrandCampiagnVisitPlan.StepName' => 'STEP_NAME',
        'stepName' => 'STEP_NAME',
        'brandCampiagnVisitPlan.stepName' => 'STEP_NAME',
        'BrandCampiagnVisitPlanTableMap::COL_STEP_NAME' => 'STEP_NAME',
        'COL_STEP_NAME' => 'STEP_NAME',
        'step_name' => 'STEP_NAME',
        'brand_campiagn_visit_plan.step_name' => 'STEP_NAME',
        'StepLevel' => 'STEP_LEVEL',
        'BrandCampiagnVisitPlan.StepLevel' => 'STEP_LEVEL',
        'stepLevel' => 'STEP_LEVEL',
        'brandCampiagnVisitPlan.stepLevel' => 'STEP_LEVEL',
        'BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL' => 'STEP_LEVEL',
        'COL_STEP_LEVEL' => 'STEP_LEVEL',
        'step_level' => 'STEP_LEVEL',
        'brand_campiagn_visit_plan.step_level' => 'STEP_LEVEL',
        'Moye' => 'MOYE',
        'BrandCampiagnVisitPlan.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'brandCampiagnVisitPlan.moye' => 'MOYE',
        'BrandCampiagnVisitPlanTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'brand_campiagn_visit_plan.moye' => 'MOYE',
        'SgpiStatus' => 'SGPI_STATUS',
        'BrandCampiagnVisitPlan.SgpiStatus' => 'SGPI_STATUS',
        'sgpiStatus' => 'SGPI_STATUS',
        'brandCampiagnVisitPlan.sgpiStatus' => 'SGPI_STATUS',
        'BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS' => 'SGPI_STATUS',
        'COL_SGPI_STATUS' => 'SGPI_STATUS',
        'sgpi_status' => 'SGPI_STATUS',
        'brand_campiagn_visit_plan.sgpi_status' => 'SGPI_STATUS',
        'Qty' => 'QTY',
        'BrandCampiagnVisitPlan.Qty' => 'QTY',
        'qty' => 'QTY',
        'brandCampiagnVisitPlan.qty' => 'QTY',
        'BrandCampiagnVisitPlanTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'brand_campiagn_visit_plan.qty' => 'QTY',
        'Comment' => 'COMMENT',
        'BrandCampiagnVisitPlan.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'brandCampiagnVisitPlan.comment' => 'COMMENT',
        'BrandCampiagnVisitPlanTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'brand_campiagn_visit_plan.comment' => 'COMMENT',
        'AgendaType' => 'AGENDA_TYPE',
        'BrandCampiagnVisitPlan.AgendaType' => 'AGENDA_TYPE',
        'agendaType' => 'AGENDA_TYPE',
        'brandCampiagnVisitPlan.agendaType' => 'AGENDA_TYPE',
        'BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE' => 'AGENDA_TYPE',
        'COL_AGENDA_TYPE' => 'AGENDA_TYPE',
        'agenda_type' => 'AGENDA_TYPE',
        'brand_campiagn_visit_plan.agenda_type' => 'AGENDA_TYPE',
        'AgendaSubTypeId' => 'AGENDA_SUB_TYPE_ID',
        'BrandCampiagnVisitPlan.AgendaSubTypeId' => 'AGENDA_SUB_TYPE_ID',
        'agendaSubTypeId' => 'AGENDA_SUB_TYPE_ID',
        'brandCampiagnVisitPlan.agendaSubTypeId' => 'AGENDA_SUB_TYPE_ID',
        'BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID' => 'AGENDA_SUB_TYPE_ID',
        'COL_AGENDA_SUB_TYPE_ID' => 'AGENDA_SUB_TYPE_ID',
        'agenda_sub_type_id' => 'AGENDA_SUB_TYPE_ID',
        'brand_campiagn_visit_plan.agenda_sub_type_id' => 'AGENDA_SUB_TYPE_ID',
        'CreateSurvey' => 'CREATE_SURVEY',
        'BrandCampiagnVisitPlan.CreateSurvey' => 'CREATE_SURVEY',
        'createSurvey' => 'CREATE_SURVEY',
        'brandCampiagnVisitPlan.createSurvey' => 'CREATE_SURVEY',
        'BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY' => 'CREATE_SURVEY',
        'COL_CREATE_SURVEY' => 'CREATE_SURVEY',
        'create_survey' => 'CREATE_SURVEY',
        'brand_campiagn_visit_plan.create_survey' => 'CREATE_SURVEY',
        'SurveyId' => 'SURVEY_ID',
        'BrandCampiagnVisitPlan.SurveyId' => 'SURVEY_ID',
        'surveyId' => 'SURVEY_ID',
        'brandCampiagnVisitPlan.surveyId' => 'SURVEY_ID',
        'BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID' => 'SURVEY_ID',
        'COL_SURVEY_ID' => 'SURVEY_ID',
        'survey_id' => 'SURVEY_ID',
        'brand_campiagn_visit_plan.survey_id' => 'SURVEY_ID',
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
        $this->setName('brand_campiagn_visit_plan');
        $this->setPhpName('BrandCampiagnVisitPlan');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCampiagnVisitPlan');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_campiagn_visit_plan_brand_campiagn_visit_plan_id_seq');
        // columns
        $this->addPrimaryKey('brand_campiagn_visit_plan_id', 'BrandCampiagnVisitPlanId', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', 'brand_campiagn', 'brand_campiagn_id', false, null, null);
        $this->addColumn('visit_plan_order', 'VisitPlanOrder', 'VARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('sgpi_id', 'SgpiId', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('step_name', 'StepName', 'VARCHAR', false, 250, null);
        $this->addColumn('step_level', 'StepLevel', 'INTEGER', false, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, 100, null);
        $this->addColumn('sgpi_status', 'SgpiStatus', 'BOOLEAN', false, 1, false);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('comment', 'Comment', 'LONGVARCHAR', false, null, null);
        $this->addColumn('agenda_type', 'AgendaType', 'VARCHAR', false, null, null);
        $this->addForeignKey('agenda_sub_type_id', 'AgendaSubTypeId', 'INTEGER', 'agendatypes', 'agendaid', false, null, null);
        $this->addColumn('create_survey', 'CreateSurvey', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('survey_id', 'SurveyId', 'INTEGER', 'survey', 'survey_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agenda_sub_type_id',
    1 => ':agendaid',
  ),
), null, null, null, false);
        $this->addRelation('Survey', '\\entities\\Survey', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':survey_id',
    1 => ':survey_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisits', '\\entities\\BrandCampiagnVisits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campiagn_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, 'BrandCampiagnVisitss', false);
        $this->addRelation('DailycallsAttendees', '\\entities\\DailycallsAttendees', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brand_campaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, 'DailycallsAttendeess', false);
        $this->addRelation('Dayplan', '\\entities\\Dayplan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':campaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, 'Dayplans', false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':brandcampaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, 'SurveySubmiteds', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':campaign_visit_plan_id',
    1 => ':brand_campiagn_visit_plan_id',
  ),
), null, null, 'Tourplanss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandCampiagnVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCampiagnVisitPlanTableMap::CLASS_DEFAULT : BrandCampiagnVisitPlanTableMap::OM_CLASS;
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
     * @return array (BrandCampiagnVisitPlan object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCampiagnVisitPlanTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCampiagnVisitPlanTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCampiagnVisitPlanTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCampiagnVisitPlanTableMap::OM_CLASS;
            /** @var BrandCampiagnVisitPlan $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCampiagnVisitPlanTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCampiagnVisitPlanTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCampiagnVisitPlanTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCampiagnVisitPlan $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCampiagnVisitPlanTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_MOYE);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_QTY);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_COMMENT);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY);
            $criteria->addSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.visit_plan_order');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.step_name');
            $criteria->addSelectColumn($alias . '.step_level');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.sgpi_status');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.agenda_type');
            $criteria->addSelectColumn($alias . '.agenda_sub_type_id');
            $criteria->addSelectColumn($alias . '.create_survey');
            $criteria->addSelectColumn($alias . '.survey_id');
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
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_MOYE);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_QTY);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY);
            $criteria->removeSelectColumn(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.visit_plan_order');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.step_name');
            $criteria->removeSelectColumn($alias . '.step_level');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.sgpi_status');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.agenda_type');
            $criteria->removeSelectColumn($alias . '.agenda_sub_type_id');
            $criteria->removeSelectColumn($alias . '.create_survey');
            $criteria->removeSelectColumn($alias . '.survey_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCampiagnVisitPlanTableMap::DATABASE_NAME)->getTable(BrandCampiagnVisitPlanTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCampiagnVisitPlan or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCampiagnVisitPlan object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCampiagnVisitPlan) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
            $criteria->add(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCampiagnVisitPlanQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCampiagnVisitPlanTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCampiagnVisitPlanTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_campiagn_visit_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCampiagnVisitPlanQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCampiagnVisitPlan or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCampiagnVisitPlan object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCampiagnVisitPlan object
        }

        if ($criteria->containsKey(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID) && $criteria->keyContainsValue(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID.')');
        }


        // Set the correct dbName
        $query = BrandCampiagnVisitPlanQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

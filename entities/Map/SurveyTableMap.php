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
use entities\Survey;
use entities\SurveyQuery;


/**
 * This class defines the structure of the 'survey' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SurveyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SurveyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'survey';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Survey';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Survey';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Survey';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the survey_id field
     */
    public const COL_SURVEY_ID = 'survey.survey_id';

    /**
     * the column name for the survey_name field
     */
    public const COL_SURVEY_NAME = 'survey.survey_name';

    /**
     * the column name for the survey_catid field
     */
    public const COL_SURVEY_CATID = 'survey.survey_catid';

    /**
     * the column name for the is_multiple field
     */
    public const COL_IS_MULTIPLE = 'survey.is_multiple';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'survey.status';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'survey.company_id';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'survey.outlet_type_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'survey.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'survey.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'survey.updated_at';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'survey.media_id';

    /**
     * the column name for the audience_type field
     */
    public const COL_AUDIENCE_TYPE = 'survey.audience_type';

    /**
     * the column name for the short_code field
     */
    public const COL_SHORT_CODE = 'survey.short_code';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'survey.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'survey.end_date';

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
        self::TYPE_PHPNAME       => ['SurveyId', 'SurveyName', 'SurveyCatid', 'IsMultiple', 'Status', 'CompanyId', 'OutletTypeId', 'Orgunitid', 'CreatedAt', 'UpdatedAt', 'MediaId', 'AudienceType', 'ShortCode', 'StartDate', 'EndDate', ],
        self::TYPE_CAMELNAME     => ['surveyId', 'surveyName', 'surveyCatid', 'isMultiple', 'status', 'companyId', 'outletTypeId', 'orgunitid', 'createdAt', 'updatedAt', 'mediaId', 'audienceType', 'shortCode', 'startDate', 'endDate', ],
        self::TYPE_COLNAME       => [SurveyTableMap::COL_SURVEY_ID, SurveyTableMap::COL_SURVEY_NAME, SurveyTableMap::COL_SURVEY_CATID, SurveyTableMap::COL_IS_MULTIPLE, SurveyTableMap::COL_STATUS, SurveyTableMap::COL_COMPANY_ID, SurveyTableMap::COL_OUTLET_TYPE_ID, SurveyTableMap::COL_ORGUNITID, SurveyTableMap::COL_CREATED_AT, SurveyTableMap::COL_UPDATED_AT, SurveyTableMap::COL_MEDIA_ID, SurveyTableMap::COL_AUDIENCE_TYPE, SurveyTableMap::COL_SHORT_CODE, SurveyTableMap::COL_START_DATE, SurveyTableMap::COL_END_DATE, ],
        self::TYPE_FIELDNAME     => ['survey_id', 'survey_name', 'survey_catid', 'is_multiple', 'status', 'company_id', 'outlet_type_id', 'orgunitid', 'created_at', 'updated_at', 'media_id', 'audience_type', 'short_code', 'start_date', 'end_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
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
        self::TYPE_PHPNAME       => ['SurveyId' => 0, 'SurveyName' => 1, 'SurveyCatid' => 2, 'IsMultiple' => 3, 'Status' => 4, 'CompanyId' => 5, 'OutletTypeId' => 6, 'Orgunitid' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'MediaId' => 10, 'AudienceType' => 11, 'ShortCode' => 12, 'StartDate' => 13, 'EndDate' => 14, ],
        self::TYPE_CAMELNAME     => ['surveyId' => 0, 'surveyName' => 1, 'surveyCatid' => 2, 'isMultiple' => 3, 'status' => 4, 'companyId' => 5, 'outletTypeId' => 6, 'orgunitid' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'mediaId' => 10, 'audienceType' => 11, 'shortCode' => 12, 'startDate' => 13, 'endDate' => 14, ],
        self::TYPE_COLNAME       => [SurveyTableMap::COL_SURVEY_ID => 0, SurveyTableMap::COL_SURVEY_NAME => 1, SurveyTableMap::COL_SURVEY_CATID => 2, SurveyTableMap::COL_IS_MULTIPLE => 3, SurveyTableMap::COL_STATUS => 4, SurveyTableMap::COL_COMPANY_ID => 5, SurveyTableMap::COL_OUTLET_TYPE_ID => 6, SurveyTableMap::COL_ORGUNITID => 7, SurveyTableMap::COL_CREATED_AT => 8, SurveyTableMap::COL_UPDATED_AT => 9, SurveyTableMap::COL_MEDIA_ID => 10, SurveyTableMap::COL_AUDIENCE_TYPE => 11, SurveyTableMap::COL_SHORT_CODE => 12, SurveyTableMap::COL_START_DATE => 13, SurveyTableMap::COL_END_DATE => 14, ],
        self::TYPE_FIELDNAME     => ['survey_id' => 0, 'survey_name' => 1, 'survey_catid' => 2, 'is_multiple' => 3, 'status' => 4, 'company_id' => 5, 'outlet_type_id' => 6, 'orgunitid' => 7, 'created_at' => 8, 'updated_at' => 9, 'media_id' => 10, 'audience_type' => 11, 'short_code' => 12, 'start_date' => 13, 'end_date' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SurveyId' => 'SURVEY_ID',
        'Survey.SurveyId' => 'SURVEY_ID',
        'surveyId' => 'SURVEY_ID',
        'survey.surveyId' => 'SURVEY_ID',
        'SurveyTableMap::COL_SURVEY_ID' => 'SURVEY_ID',
        'COL_SURVEY_ID' => 'SURVEY_ID',
        'survey_id' => 'SURVEY_ID',
        'survey.survey_id' => 'SURVEY_ID',
        'SurveyName' => 'SURVEY_NAME',
        'Survey.SurveyName' => 'SURVEY_NAME',
        'surveyName' => 'SURVEY_NAME',
        'survey.surveyName' => 'SURVEY_NAME',
        'SurveyTableMap::COL_SURVEY_NAME' => 'SURVEY_NAME',
        'COL_SURVEY_NAME' => 'SURVEY_NAME',
        'survey_name' => 'SURVEY_NAME',
        'survey.survey_name' => 'SURVEY_NAME',
        'SurveyCatid' => 'SURVEY_CATID',
        'Survey.SurveyCatid' => 'SURVEY_CATID',
        'surveyCatid' => 'SURVEY_CATID',
        'survey.surveyCatid' => 'SURVEY_CATID',
        'SurveyTableMap::COL_SURVEY_CATID' => 'SURVEY_CATID',
        'COL_SURVEY_CATID' => 'SURVEY_CATID',
        'survey_catid' => 'SURVEY_CATID',
        'survey.survey_catid' => 'SURVEY_CATID',
        'IsMultiple' => 'IS_MULTIPLE',
        'Survey.IsMultiple' => 'IS_MULTIPLE',
        'isMultiple' => 'IS_MULTIPLE',
        'survey.isMultiple' => 'IS_MULTIPLE',
        'SurveyTableMap::COL_IS_MULTIPLE' => 'IS_MULTIPLE',
        'COL_IS_MULTIPLE' => 'IS_MULTIPLE',
        'is_multiple' => 'IS_MULTIPLE',
        'survey.is_multiple' => 'IS_MULTIPLE',
        'Status' => 'STATUS',
        'Survey.Status' => 'STATUS',
        'status' => 'STATUS',
        'survey.status' => 'STATUS',
        'SurveyTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'CompanyId' => 'COMPANY_ID',
        'Survey.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'survey.companyId' => 'COMPANY_ID',
        'SurveyTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'survey.company_id' => 'COMPANY_ID',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'Survey.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'survey.outletTypeId' => 'OUTLET_TYPE_ID',
        'SurveyTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'survey.outlet_type_id' => 'OUTLET_TYPE_ID',
        'Orgunitid' => 'ORGUNITID',
        'Survey.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'survey.orgunitid' => 'ORGUNITID',
        'SurveyTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'Survey.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'survey.createdAt' => 'CREATED_AT',
        'SurveyTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'survey.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Survey.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'survey.updatedAt' => 'UPDATED_AT',
        'SurveyTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'survey.updated_at' => 'UPDATED_AT',
        'MediaId' => 'MEDIA_ID',
        'Survey.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'survey.mediaId' => 'MEDIA_ID',
        'SurveyTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'survey.media_id' => 'MEDIA_ID',
        'AudienceType' => 'AUDIENCE_TYPE',
        'Survey.AudienceType' => 'AUDIENCE_TYPE',
        'audienceType' => 'AUDIENCE_TYPE',
        'survey.audienceType' => 'AUDIENCE_TYPE',
        'SurveyTableMap::COL_AUDIENCE_TYPE' => 'AUDIENCE_TYPE',
        'COL_AUDIENCE_TYPE' => 'AUDIENCE_TYPE',
        'audience_type' => 'AUDIENCE_TYPE',
        'survey.audience_type' => 'AUDIENCE_TYPE',
        'ShortCode' => 'SHORT_CODE',
        'Survey.ShortCode' => 'SHORT_CODE',
        'shortCode' => 'SHORT_CODE',
        'survey.shortCode' => 'SHORT_CODE',
        'SurveyTableMap::COL_SHORT_CODE' => 'SHORT_CODE',
        'COL_SHORT_CODE' => 'SHORT_CODE',
        'short_code' => 'SHORT_CODE',
        'survey.short_code' => 'SHORT_CODE',
        'StartDate' => 'START_DATE',
        'Survey.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'survey.startDate' => 'START_DATE',
        'SurveyTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'survey.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'Survey.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'survey.endDate' => 'END_DATE',
        'SurveyTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'survey.end_date' => 'END_DATE',
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
        $this->setName('survey');
        $this->setPhpName('Survey');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Survey');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('survey_survey_id_seq');
        // columns
        $this->addPrimaryKey('survey_id', 'SurveyId', 'INTEGER', true, null, null);
        $this->addColumn('survey_name', 'SurveyName', 'VARCHAR', false, null, null);
        $this->addForeignKey('survey_catid', 'SurveyCatid', 'INTEGER', 'survey_category', 'survey_catid', false, null, null);
        $this->addColumn('is_multiple', 'IsMultiple', 'BOOLEAN', false, 1, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('outlet_type_id', 'OutletTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', true, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, null, null);
        $this->addColumn('audience_type', 'AudienceType', 'VARCHAR', false, null, null);
        $this->addColumn('short_code', 'ShortCode', 'VARCHAR', false, null, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
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
        $this->addRelation('SurveyCategory', '\\entities\\SurveyCategory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':survey_catid',
    1 => ':survey_catid',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':survey_id',
    1 => ':survey_id',
  ),
), null, null, 'BrandCampiagnVisitPlans', false);
        $this->addRelation('SurveyQuestion', '\\entities\\SurveyQuestion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':survey_id',
    1 => ':survey_id',
  ),
), null, null, 'SurveyQuestions', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SurveyId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SurveyTableMap::CLASS_DEFAULT : SurveyTableMap::OM_CLASS;
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
     * @return array (Survey object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SurveyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SurveyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SurveyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SurveyTableMap::OM_CLASS;
            /** @var Survey $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SurveyTableMap::addInstanceToPool($obj, $key);
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
            $key = SurveyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SurveyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Survey $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SurveyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SurveyTableMap::COL_SURVEY_ID);
            $criteria->addSelectColumn(SurveyTableMap::COL_SURVEY_NAME);
            $criteria->addSelectColumn(SurveyTableMap::COL_SURVEY_CATID);
            $criteria->addSelectColumn(SurveyTableMap::COL_IS_MULTIPLE);
            $criteria->addSelectColumn(SurveyTableMap::COL_STATUS);
            $criteria->addSelectColumn(SurveyTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SurveyTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(SurveyTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(SurveyTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SurveyTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SurveyTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(SurveyTableMap::COL_AUDIENCE_TYPE);
            $criteria->addSelectColumn(SurveyTableMap::COL_SHORT_CODE);
            $criteria->addSelectColumn(SurveyTableMap::COL_START_DATE);
            $criteria->addSelectColumn(SurveyTableMap::COL_END_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.survey_id');
            $criteria->addSelectColumn($alias . '.survey_name');
            $criteria->addSelectColumn($alias . '.survey_catid');
            $criteria->addSelectColumn($alias . '.is_multiple');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.audience_type');
            $criteria->addSelectColumn($alias . '.short_code');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
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
            $criteria->removeSelectColumn(SurveyTableMap::COL_SURVEY_ID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_SURVEY_NAME);
            $criteria->removeSelectColumn(SurveyTableMap::COL_SURVEY_CATID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_IS_MULTIPLE);
            $criteria->removeSelectColumn(SurveyTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SurveyTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SurveyTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SurveyTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(SurveyTableMap::COL_AUDIENCE_TYPE);
            $criteria->removeSelectColumn(SurveyTableMap::COL_SHORT_CODE);
            $criteria->removeSelectColumn(SurveyTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(SurveyTableMap::COL_END_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.survey_id');
            $criteria->removeSelectColumn($alias . '.survey_name');
            $criteria->removeSelectColumn($alias . '.survey_catid');
            $criteria->removeSelectColumn($alias . '.is_multiple');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.audience_type');
            $criteria->removeSelectColumn($alias . '.short_code');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(SurveyTableMap::DATABASE_NAME)->getTable(SurveyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Survey or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Survey object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Survey) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SurveyTableMap::DATABASE_NAME);
            $criteria->add(SurveyTableMap::COL_SURVEY_ID, (array) $values, Criteria::IN);
        }

        $query = SurveyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SurveyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SurveyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the survey table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SurveyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Survey or Criteria object.
     *
     * @param mixed $criteria Criteria or Survey object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Survey object
        }

        if ($criteria->containsKey(SurveyTableMap::COL_SURVEY_ID) && $criteria->keyContainsValue(SurveyTableMap::COL_SURVEY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SurveyTableMap::COL_SURVEY_ID.')');
        }


        // Set the correct dbName
        $query = SurveyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

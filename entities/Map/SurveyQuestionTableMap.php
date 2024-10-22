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
use entities\SurveyQuestion;
use entities\SurveyQuestionQuery;


/**
 * This class defines the structure of the 'survey_question' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SurveyQuestionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SurveyQuestionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'survey_question';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SurveyQuestion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SurveyQuestion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SurveyQuestion';

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
     * the column name for the surveyquesid field
     */
    public const COL_SURVEYQUESID = 'survey_question.surveyquesid';

    /**
     * the column name for the surveyquestype field
     */
    public const COL_SURVEYQUESTYPE = 'survey_question.surveyquestype';

    /**
     * the column name for the question field
     */
    public const COL_QUESTION = 'survey_question.question';

    /**
     * the column name for the surveyquestionopt field
     */
    public const COL_SURVEYQUESTIONOPT = 'survey_question.surveyquestionopt';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'survey_question.status';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'survey_question.company_id';

    /**
     * the column name for the survey_id field
     */
    public const COL_SURVEY_ID = 'survey_question.survey_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'survey_question.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'survey_question.updated_at';

    /**
     * the column name for the question_number field
     */
    public const COL_QUESTION_NUMBER = 'survey_question.question_number';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'survey_question.media_id';

    /**
     * the column name for the is_required field
     */
    public const COL_IS_REQUIRED = 'survey_question.is_required';

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
        self::TYPE_PHPNAME       => ['Surveyquesid', 'Surveyquestype', 'Question', 'Surveyquestionopt', 'Status', 'CompanyId', 'SurveyId', 'CreatedAt', 'UpdatedAt', 'QuestionNumber', 'MediaId', 'IsRequired', ],
        self::TYPE_CAMELNAME     => ['surveyquesid', 'surveyquestype', 'question', 'surveyquestionopt', 'status', 'companyId', 'surveyId', 'createdAt', 'updatedAt', 'questionNumber', 'mediaId', 'isRequired', ],
        self::TYPE_COLNAME       => [SurveyQuestionTableMap::COL_SURVEYQUESID, SurveyQuestionTableMap::COL_SURVEYQUESTYPE, SurveyQuestionTableMap::COL_QUESTION, SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT, SurveyQuestionTableMap::COL_STATUS, SurveyQuestionTableMap::COL_COMPANY_ID, SurveyQuestionTableMap::COL_SURVEY_ID, SurveyQuestionTableMap::COL_CREATED_AT, SurveyQuestionTableMap::COL_UPDATED_AT, SurveyQuestionTableMap::COL_QUESTION_NUMBER, SurveyQuestionTableMap::COL_MEDIA_ID, SurveyQuestionTableMap::COL_IS_REQUIRED, ],
        self::TYPE_FIELDNAME     => ['surveyquesid', 'surveyquestype', 'question', 'surveyquestionopt', 'status', 'company_id', 'survey_id', 'created_at', 'updated_at', 'question_number', 'media_id', 'is_required', ],
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
        self::TYPE_PHPNAME       => ['Surveyquesid' => 0, 'Surveyquestype' => 1, 'Question' => 2, 'Surveyquestionopt' => 3, 'Status' => 4, 'CompanyId' => 5, 'SurveyId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'QuestionNumber' => 9, 'MediaId' => 10, 'IsRequired' => 11, ],
        self::TYPE_CAMELNAME     => ['surveyquesid' => 0, 'surveyquestype' => 1, 'question' => 2, 'surveyquestionopt' => 3, 'status' => 4, 'companyId' => 5, 'surveyId' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'questionNumber' => 9, 'mediaId' => 10, 'isRequired' => 11, ],
        self::TYPE_COLNAME       => [SurveyQuestionTableMap::COL_SURVEYQUESID => 0, SurveyQuestionTableMap::COL_SURVEYQUESTYPE => 1, SurveyQuestionTableMap::COL_QUESTION => 2, SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT => 3, SurveyQuestionTableMap::COL_STATUS => 4, SurveyQuestionTableMap::COL_COMPANY_ID => 5, SurveyQuestionTableMap::COL_SURVEY_ID => 6, SurveyQuestionTableMap::COL_CREATED_AT => 7, SurveyQuestionTableMap::COL_UPDATED_AT => 8, SurveyQuestionTableMap::COL_QUESTION_NUMBER => 9, SurveyQuestionTableMap::COL_MEDIA_ID => 10, SurveyQuestionTableMap::COL_IS_REQUIRED => 11, ],
        self::TYPE_FIELDNAME     => ['surveyquesid' => 0, 'surveyquestype' => 1, 'question' => 2, 'surveyquestionopt' => 3, 'status' => 4, 'company_id' => 5, 'survey_id' => 6, 'created_at' => 7, 'updated_at' => 8, 'question_number' => 9, 'media_id' => 10, 'is_required' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Surveyquesid' => 'SURVEYQUESID',
        'SurveyQuestion.Surveyquesid' => 'SURVEYQUESID',
        'surveyquesid' => 'SURVEYQUESID',
        'surveyQuestion.surveyquesid' => 'SURVEYQUESID',
        'SurveyQuestionTableMap::COL_SURVEYQUESID' => 'SURVEYQUESID',
        'COL_SURVEYQUESID' => 'SURVEYQUESID',
        'survey_question.surveyquesid' => 'SURVEYQUESID',
        'Surveyquestype' => 'SURVEYQUESTYPE',
        'SurveyQuestion.Surveyquestype' => 'SURVEYQUESTYPE',
        'surveyquestype' => 'SURVEYQUESTYPE',
        'surveyQuestion.surveyquestype' => 'SURVEYQUESTYPE',
        'SurveyQuestionTableMap::COL_SURVEYQUESTYPE' => 'SURVEYQUESTYPE',
        'COL_SURVEYQUESTYPE' => 'SURVEYQUESTYPE',
        'survey_question.surveyquestype' => 'SURVEYQUESTYPE',
        'Question' => 'QUESTION',
        'SurveyQuestion.Question' => 'QUESTION',
        'question' => 'QUESTION',
        'surveyQuestion.question' => 'QUESTION',
        'SurveyQuestionTableMap::COL_QUESTION' => 'QUESTION',
        'COL_QUESTION' => 'QUESTION',
        'survey_question.question' => 'QUESTION',
        'Surveyquestionopt' => 'SURVEYQUESTIONOPT',
        'SurveyQuestion.Surveyquestionopt' => 'SURVEYQUESTIONOPT',
        'surveyquestionopt' => 'SURVEYQUESTIONOPT',
        'surveyQuestion.surveyquestionopt' => 'SURVEYQUESTIONOPT',
        'SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT' => 'SURVEYQUESTIONOPT',
        'COL_SURVEYQUESTIONOPT' => 'SURVEYQUESTIONOPT',
        'survey_question.surveyquestionopt' => 'SURVEYQUESTIONOPT',
        'Status' => 'STATUS',
        'SurveyQuestion.Status' => 'STATUS',
        'status' => 'STATUS',
        'surveyQuestion.status' => 'STATUS',
        'SurveyQuestionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'survey_question.status' => 'STATUS',
        'CompanyId' => 'COMPANY_ID',
        'SurveyQuestion.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'surveyQuestion.companyId' => 'COMPANY_ID',
        'SurveyQuestionTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'survey_question.company_id' => 'COMPANY_ID',
        'SurveyId' => 'SURVEY_ID',
        'SurveyQuestion.SurveyId' => 'SURVEY_ID',
        'surveyId' => 'SURVEY_ID',
        'surveyQuestion.surveyId' => 'SURVEY_ID',
        'SurveyQuestionTableMap::COL_SURVEY_ID' => 'SURVEY_ID',
        'COL_SURVEY_ID' => 'SURVEY_ID',
        'survey_id' => 'SURVEY_ID',
        'survey_question.survey_id' => 'SURVEY_ID',
        'CreatedAt' => 'CREATED_AT',
        'SurveyQuestion.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'surveyQuestion.createdAt' => 'CREATED_AT',
        'SurveyQuestionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'survey_question.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SurveyQuestion.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'surveyQuestion.updatedAt' => 'UPDATED_AT',
        'SurveyQuestionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'survey_question.updated_at' => 'UPDATED_AT',
        'QuestionNumber' => 'QUESTION_NUMBER',
        'SurveyQuestion.QuestionNumber' => 'QUESTION_NUMBER',
        'questionNumber' => 'QUESTION_NUMBER',
        'surveyQuestion.questionNumber' => 'QUESTION_NUMBER',
        'SurveyQuestionTableMap::COL_QUESTION_NUMBER' => 'QUESTION_NUMBER',
        'COL_QUESTION_NUMBER' => 'QUESTION_NUMBER',
        'question_number' => 'QUESTION_NUMBER',
        'survey_question.question_number' => 'QUESTION_NUMBER',
        'MediaId' => 'MEDIA_ID',
        'SurveyQuestion.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'surveyQuestion.mediaId' => 'MEDIA_ID',
        'SurveyQuestionTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'survey_question.media_id' => 'MEDIA_ID',
        'IsRequired' => 'IS_REQUIRED',
        'SurveyQuestion.IsRequired' => 'IS_REQUIRED',
        'isRequired' => 'IS_REQUIRED',
        'surveyQuestion.isRequired' => 'IS_REQUIRED',
        'SurveyQuestionTableMap::COL_IS_REQUIRED' => 'IS_REQUIRED',
        'COL_IS_REQUIRED' => 'IS_REQUIRED',
        'is_required' => 'IS_REQUIRED',
        'survey_question.is_required' => 'IS_REQUIRED',
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
        $this->setName('survey_question');
        $this->setPhpName('SurveyQuestion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SurveyQuestion');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('survey_question_surveyquesid_seq');
        // columns
        $this->addPrimaryKey('surveyquesid', 'Surveyquesid', 'INTEGER', true, null, null);
        $this->addColumn('surveyquestype', 'Surveyquestype', 'VARCHAR', false, null, null);
        $this->addColumn('question', 'Question', 'VARCHAR', false, null, null);
        $this->addColumn('surveyquestionopt', 'Surveyquestionopt', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('survey_id', 'SurveyId', 'INTEGER', 'survey', 'survey_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('question_number', 'QuestionNumber', 'INTEGER', false, null, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, null, null);
        $this->addColumn('is_required', 'IsRequired', 'BOOLEAN', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Survey', '\\entities\\Survey', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':survey_id',
    1 => ':survey_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('SurveySubmitedAnswer', '\\entities\\SurveySubmitedAnswer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':survery_question_id',
    1 => ':surveyquesid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Surveyquesid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SurveyQuestionTableMap::CLASS_DEFAULT : SurveyQuestionTableMap::OM_CLASS;
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
     * @return array (SurveyQuestion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SurveyQuestionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SurveyQuestionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SurveyQuestionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SurveyQuestionTableMap::OM_CLASS;
            /** @var SurveyQuestion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SurveyQuestionTableMap::addInstanceToPool($obj, $key);
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
            $key = SurveyQuestionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SurveyQuestionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SurveyQuestion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SurveyQuestionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESID);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESTYPE);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_QUESTION);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_STATUS);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_SURVEY_ID);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_QUESTION_NUMBER);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(SurveyQuestionTableMap::COL_IS_REQUIRED);
        } else {
            $criteria->addSelectColumn($alias . '.surveyquesid');
            $criteria->addSelectColumn($alias . '.surveyquestype');
            $criteria->addSelectColumn($alias . '.question');
            $criteria->addSelectColumn($alias . '.surveyquestionopt');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.survey_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.question_number');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.is_required');
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
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESID);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESTYPE);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_QUESTION);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_SURVEY_ID);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_QUESTION_NUMBER);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(SurveyQuestionTableMap::COL_IS_REQUIRED);
        } else {
            $criteria->removeSelectColumn($alias . '.surveyquesid');
            $criteria->removeSelectColumn($alias . '.surveyquestype');
            $criteria->removeSelectColumn($alias . '.question');
            $criteria->removeSelectColumn($alias . '.surveyquestionopt');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.survey_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.question_number');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.is_required');
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
        return Propel::getServiceContainer()->getDatabaseMap(SurveyQuestionTableMap::DATABASE_NAME)->getTable(SurveyQuestionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SurveyQuestion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SurveyQuestion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SurveyQuestion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SurveyQuestionTableMap::DATABASE_NAME);
            $criteria->add(SurveyQuestionTableMap::COL_SURVEYQUESID, (array) $values, Criteria::IN);
        }

        $query = SurveyQuestionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SurveyQuestionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SurveyQuestionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the survey_question table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SurveyQuestionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SurveyQuestion or Criteria object.
     *
     * @param mixed $criteria Criteria or SurveyQuestion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SurveyQuestion object
        }

        if ($criteria->containsKey(SurveyQuestionTableMap::COL_SURVEYQUESID) && $criteria->keyContainsValue(SurveyQuestionTableMap::COL_SURVEYQUESID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SurveyQuestionTableMap::COL_SURVEYQUESID.')');
        }


        // Set the correct dbName
        $query = SurveyQuestionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

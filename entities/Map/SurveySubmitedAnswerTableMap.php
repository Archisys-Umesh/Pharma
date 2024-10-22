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
use entities\SurveySubmitedAnswer;
use entities\SurveySubmitedAnswerQuery;


/**
 * This class defines the structure of the 'survey_submited_answer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SurveySubmitedAnswerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SurveySubmitedAnswerTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'survey_submited_answer';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SurveySubmitedAnswer';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SurveySubmitedAnswer';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SurveySubmitedAnswer';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the survery_submited_ans_id field
     */
    public const COL_SURVERY_SUBMITED_ANS_ID = 'survey_submited_answer.survery_submited_ans_id';

    /**
     * the column name for the survery_question_id field
     */
    public const COL_SURVERY_QUESTION_ID = 'survey_submited_answer.survery_question_id';

    /**
     * the column name for the survey_answer field
     */
    public const COL_SURVEY_ANSWER = 'survey_submited_answer.survey_answer';

    /**
     * the column name for the survey_submited_id field
     */
    public const COL_SURVEY_SUBMITED_ID = 'survey_submited_answer.survey_submited_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'survey_submited_answer.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'survey_submited_answer.updated_at';

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
        self::TYPE_PHPNAME       => ['SurverySubmitedAnsId', 'SurveryQuestionId', 'SurveyAnswer', 'SurveySubmitedId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['surverySubmitedAnsId', 'surveryQuestionId', 'surveyAnswer', 'surveySubmitedId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER, SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, SurveySubmitedAnswerTableMap::COL_CREATED_AT, SurveySubmitedAnswerTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['survery_submited_ans_id', 'survery_question_id', 'survey_answer', 'survey_submited_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['SurverySubmitedAnsId' => 0, 'SurveryQuestionId' => 1, 'SurveyAnswer' => 2, 'SurveySubmitedId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['surverySubmitedAnsId' => 0, 'surveryQuestionId' => 1, 'surveyAnswer' => 2, 'surveySubmitedId' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID => 0, SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID => 1, SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER => 2, SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID => 3, SurveySubmitedAnswerTableMap::COL_CREATED_AT => 4, SurveySubmitedAnswerTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['survery_submited_ans_id' => 0, 'survery_question_id' => 1, 'survey_answer' => 2, 'survey_submited_id' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SurverySubmitedAnsId' => 'SURVERY_SUBMITED_ANS_ID',
        'SurveySubmitedAnswer.SurverySubmitedAnsId' => 'SURVERY_SUBMITED_ANS_ID',
        'surverySubmitedAnsId' => 'SURVERY_SUBMITED_ANS_ID',
        'surveySubmitedAnswer.surverySubmitedAnsId' => 'SURVERY_SUBMITED_ANS_ID',
        'SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID' => 'SURVERY_SUBMITED_ANS_ID',
        'COL_SURVERY_SUBMITED_ANS_ID' => 'SURVERY_SUBMITED_ANS_ID',
        'survery_submited_ans_id' => 'SURVERY_SUBMITED_ANS_ID',
        'survey_submited_answer.survery_submited_ans_id' => 'SURVERY_SUBMITED_ANS_ID',
        'SurveryQuestionId' => 'SURVERY_QUESTION_ID',
        'SurveySubmitedAnswer.SurveryQuestionId' => 'SURVERY_QUESTION_ID',
        'surveryQuestionId' => 'SURVERY_QUESTION_ID',
        'surveySubmitedAnswer.surveryQuestionId' => 'SURVERY_QUESTION_ID',
        'SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID' => 'SURVERY_QUESTION_ID',
        'COL_SURVERY_QUESTION_ID' => 'SURVERY_QUESTION_ID',
        'survery_question_id' => 'SURVERY_QUESTION_ID',
        'survey_submited_answer.survery_question_id' => 'SURVERY_QUESTION_ID',
        'SurveyAnswer' => 'SURVEY_ANSWER',
        'SurveySubmitedAnswer.SurveyAnswer' => 'SURVEY_ANSWER',
        'surveyAnswer' => 'SURVEY_ANSWER',
        'surveySubmitedAnswer.surveyAnswer' => 'SURVEY_ANSWER',
        'SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER' => 'SURVEY_ANSWER',
        'COL_SURVEY_ANSWER' => 'SURVEY_ANSWER',
        'survey_answer' => 'SURVEY_ANSWER',
        'survey_submited_answer.survey_answer' => 'SURVEY_ANSWER',
        'SurveySubmitedId' => 'SURVEY_SUBMITED_ID',
        'SurveySubmitedAnswer.SurveySubmitedId' => 'SURVEY_SUBMITED_ID',
        'surveySubmitedId' => 'SURVEY_SUBMITED_ID',
        'surveySubmitedAnswer.surveySubmitedId' => 'SURVEY_SUBMITED_ID',
        'SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID' => 'SURVEY_SUBMITED_ID',
        'COL_SURVEY_SUBMITED_ID' => 'SURVEY_SUBMITED_ID',
        'survey_submited_id' => 'SURVEY_SUBMITED_ID',
        'survey_submited_answer.survey_submited_id' => 'SURVEY_SUBMITED_ID',
        'CreatedAt' => 'CREATED_AT',
        'SurveySubmitedAnswer.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'surveySubmitedAnswer.createdAt' => 'CREATED_AT',
        'SurveySubmitedAnswerTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'survey_submited_answer.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SurveySubmitedAnswer.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'surveySubmitedAnswer.updatedAt' => 'UPDATED_AT',
        'SurveySubmitedAnswerTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'survey_submited_answer.updated_at' => 'UPDATED_AT',
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
        $this->setName('survey_submited_answer');
        $this->setPhpName('SurveySubmitedAnswer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SurveySubmitedAnswer');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('survey_submited_answer_survery_submited_ans_id_seq');
        // columns
        $this->addPrimaryKey('survery_submited_ans_id', 'SurverySubmitedAnsId', 'INTEGER', true, null, null);
        $this->addForeignKey('survery_question_id', 'SurveryQuestionId', 'BIGINT', 'survey_question', 'surveyquesid', false, null, null);
        $this->addColumn('survey_answer', 'SurveyAnswer', 'VARCHAR', false, null, null);
        $this->addForeignKey('survey_submited_id', 'SurveySubmitedId', 'BIGINT', 'survey_submited', 'survery_submit_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SurveyQuestion', '\\entities\\SurveyQuestion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':survery_question_id',
    1 => ':surveyquesid',
  ),
), null, null, null, false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':survey_submited_id',
    1 => ':survery_submit_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SurverySubmitedAnsId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SurveySubmitedAnswerTableMap::CLASS_DEFAULT : SurveySubmitedAnswerTableMap::OM_CLASS;
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
     * @return array (SurveySubmitedAnswer object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SurveySubmitedAnswerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SurveySubmitedAnswerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SurveySubmitedAnswerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SurveySubmitedAnswerTableMap::OM_CLASS;
            /** @var SurveySubmitedAnswer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SurveySubmitedAnswerTableMap::addInstanceToPool($obj, $key);
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
            $key = SurveySubmitedAnswerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SurveySubmitedAnswerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SurveySubmitedAnswer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SurveySubmitedAnswerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID);
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID);
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER);
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID);
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SurveySubmitedAnswerTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.survery_submited_ans_id');
            $criteria->addSelectColumn($alias . '.survery_question_id');
            $criteria->addSelectColumn($alias . '.survey_answer');
            $criteria->addSelectColumn($alias . '.survey_submited_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID);
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID);
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER);
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID);
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SurveySubmitedAnswerTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.survery_submited_ans_id');
            $criteria->removeSelectColumn($alias . '.survery_question_id');
            $criteria->removeSelectColumn($alias . '.survey_answer');
            $criteria->removeSelectColumn($alias . '.survey_submited_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SurveySubmitedAnswerTableMap::DATABASE_NAME)->getTable(SurveySubmitedAnswerTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SurveySubmitedAnswer or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SurveySubmitedAnswer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedAnswerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SurveySubmitedAnswer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SurveySubmitedAnswerTableMap::DATABASE_NAME);
            $criteria->add(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, (array) $values, Criteria::IN);
        }

        $query = SurveySubmitedAnswerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SurveySubmitedAnswerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SurveySubmitedAnswerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the survey_submited_answer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SurveySubmitedAnswerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SurveySubmitedAnswer or Criteria object.
     *
     * @param mixed $criteria Criteria or SurveySubmitedAnswer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedAnswerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SurveySubmitedAnswer object
        }

        if ($criteria->containsKey(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID) && $criteria->keyContainsValue(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID.')');
        }


        // Set the correct dbName
        $query = SurveySubmitedAnswerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

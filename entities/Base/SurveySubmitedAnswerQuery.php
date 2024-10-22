<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\SurveySubmitedAnswer as ChildSurveySubmitedAnswer;
use entities\SurveySubmitedAnswerQuery as ChildSurveySubmitedAnswerQuery;
use entities\Map\SurveySubmitedAnswerTableMap;

/**
 * Base class that represents a query for the `survey_submited_answer` table.
 *
 * @method     ChildSurveySubmitedAnswerQuery orderBySurverySubmitedAnsId($order = Criteria::ASC) Order by the survery_submited_ans_id column
 * @method     ChildSurveySubmitedAnswerQuery orderBySurveryQuestionId($order = Criteria::ASC) Order by the survery_question_id column
 * @method     ChildSurveySubmitedAnswerQuery orderBySurveyAnswer($order = Criteria::ASC) Order by the survey_answer column
 * @method     ChildSurveySubmitedAnswerQuery orderBySurveySubmitedId($order = Criteria::ASC) Order by the survey_submited_id column
 * @method     ChildSurveySubmitedAnswerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSurveySubmitedAnswerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSurveySubmitedAnswerQuery groupBySurverySubmitedAnsId() Group by the survery_submited_ans_id column
 * @method     ChildSurveySubmitedAnswerQuery groupBySurveryQuestionId() Group by the survery_question_id column
 * @method     ChildSurveySubmitedAnswerQuery groupBySurveyAnswer() Group by the survey_answer column
 * @method     ChildSurveySubmitedAnswerQuery groupBySurveySubmitedId() Group by the survey_submited_id column
 * @method     ChildSurveySubmitedAnswerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSurveySubmitedAnswerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSurveySubmitedAnswerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSurveySubmitedAnswerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSurveySubmitedAnswerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSurveySubmitedAnswerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoinSurveyQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildSurveySubmitedAnswerQuery rightJoinSurveyQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildSurveySubmitedAnswerQuery innerJoinSurveyQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveyQuestion relation
 *
 * @method     ChildSurveySubmitedAnswerQuery joinWithSurveyQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveyQuestion relation
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoinWithSurveyQuestion() Adds a LEFT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildSurveySubmitedAnswerQuery rightJoinWithSurveyQuestion() Adds a RIGHT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildSurveySubmitedAnswerQuery innerJoinWithSurveyQuestion() Adds a INNER JOIN clause and with to the query using the SurveyQuestion relation
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildSurveySubmitedAnswerQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildSurveySubmitedAnswerQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildSurveySubmitedAnswerQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildSurveySubmitedAnswerQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildSurveySubmitedAnswerQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildSurveySubmitedAnswerQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     \entities\SurveyQuestionQuery|\entities\SurveySubmitedQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSurveySubmitedAnswer|null findOne(?ConnectionInterface $con = null) Return the first ChildSurveySubmitedAnswer matching the query
 * @method     ChildSurveySubmitedAnswer findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSurveySubmitedAnswer matching the query, or a new ChildSurveySubmitedAnswer object populated from the query conditions when no match is found
 *
 * @method     ChildSurveySubmitedAnswer|null findOneBySurverySubmitedAnsId(int $survery_submited_ans_id) Return the first ChildSurveySubmitedAnswer filtered by the survery_submited_ans_id column
 * @method     ChildSurveySubmitedAnswer|null findOneBySurveryQuestionId(string $survery_question_id) Return the first ChildSurveySubmitedAnswer filtered by the survery_question_id column
 * @method     ChildSurveySubmitedAnswer|null findOneBySurveyAnswer(string $survey_answer) Return the first ChildSurveySubmitedAnswer filtered by the survey_answer column
 * @method     ChildSurveySubmitedAnswer|null findOneBySurveySubmitedId(string $survey_submited_id) Return the first ChildSurveySubmitedAnswer filtered by the survey_submited_id column
 * @method     ChildSurveySubmitedAnswer|null findOneByCreatedAt(string $created_at) Return the first ChildSurveySubmitedAnswer filtered by the created_at column
 * @method     ChildSurveySubmitedAnswer|null findOneByUpdatedAt(string $updated_at) Return the first ChildSurveySubmitedAnswer filtered by the updated_at column
 *
 * @method     ChildSurveySubmitedAnswer requirePk($key, ?ConnectionInterface $con = null) Return the ChildSurveySubmitedAnswer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOne(?ConnectionInterface $con = null) Return the first ChildSurveySubmitedAnswer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveySubmitedAnswer requireOneBySurverySubmitedAnsId(int $survery_submited_ans_id) Return the first ChildSurveySubmitedAnswer filtered by the survery_submited_ans_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOneBySurveryQuestionId(string $survery_question_id) Return the first ChildSurveySubmitedAnswer filtered by the survery_question_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOneBySurveyAnswer(string $survey_answer) Return the first ChildSurveySubmitedAnswer filtered by the survey_answer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOneBySurveySubmitedId(string $survey_submited_id) Return the first ChildSurveySubmitedAnswer filtered by the survey_submited_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOneByCreatedAt(string $created_at) Return the first ChildSurveySubmitedAnswer filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveySubmitedAnswer requireOneByUpdatedAt(string $updated_at) Return the first ChildSurveySubmitedAnswer filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveySubmitedAnswer[]|Collection find(?ConnectionInterface $con = null) Return ChildSurveySubmitedAnswer objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> find(?ConnectionInterface $con = null) Return ChildSurveySubmitedAnswer objects based on current ModelCriteria
 *
 * @method     ChildSurveySubmitedAnswer[]|Collection findBySurverySubmitedAnsId(int|array<int> $survery_submited_ans_id) Return ChildSurveySubmitedAnswer objects filtered by the survery_submited_ans_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findBySurverySubmitedAnsId(int|array<int> $survery_submited_ans_id) Return ChildSurveySubmitedAnswer objects filtered by the survery_submited_ans_id column
 * @method     ChildSurveySubmitedAnswer[]|Collection findBySurveryQuestionId(string|array<string> $survery_question_id) Return ChildSurveySubmitedAnswer objects filtered by the survery_question_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findBySurveryQuestionId(string|array<string> $survery_question_id) Return ChildSurveySubmitedAnswer objects filtered by the survery_question_id column
 * @method     ChildSurveySubmitedAnswer[]|Collection findBySurveyAnswer(string|array<string> $survey_answer) Return ChildSurveySubmitedAnswer objects filtered by the survey_answer column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findBySurveyAnswer(string|array<string> $survey_answer) Return ChildSurveySubmitedAnswer objects filtered by the survey_answer column
 * @method     ChildSurveySubmitedAnswer[]|Collection findBySurveySubmitedId(string|array<string> $survey_submited_id) Return ChildSurveySubmitedAnswer objects filtered by the survey_submited_id column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findBySurveySubmitedId(string|array<string> $survey_submited_id) Return ChildSurveySubmitedAnswer objects filtered by the survey_submited_id column
 * @method     ChildSurveySubmitedAnswer[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSurveySubmitedAnswer objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findByCreatedAt(string|array<string> $created_at) Return ChildSurveySubmitedAnswer objects filtered by the created_at column
 * @method     ChildSurveySubmitedAnswer[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveySubmitedAnswer objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSurveySubmitedAnswer> findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveySubmitedAnswer objects filtered by the updated_at column
 *
 * @method     ChildSurveySubmitedAnswer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSurveySubmitedAnswer> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SurveySubmitedAnswerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SurveySubmitedAnswerQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SurveySubmitedAnswer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSurveySubmitedAnswerQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSurveySubmitedAnswerQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSurveySubmitedAnswerQuery) {
            return $criteria;
        }
        $query = new ChildSurveySubmitedAnswerQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSurveySubmitedAnswer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveySubmitedAnswerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SurveySubmitedAnswerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSurveySubmitedAnswer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT survery_submited_ans_id, survery_question_id, survey_answer, survey_submited_id, created_at, updated_at FROM survey_submited_answer WHERE survery_submited_ans_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSurveySubmitedAnswer $obj */
            $obj = new ChildSurveySubmitedAnswer();
            $obj->hydrate($row);
            SurveySubmitedAnswerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSurveySubmitedAnswer|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the survery_submited_ans_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurverySubmitedAnsId(1234); // WHERE survery_submited_ans_id = 1234
     * $query->filterBySurverySubmitedAnsId(array(12, 34)); // WHERE survery_submited_ans_id IN (12, 34)
     * $query->filterBySurverySubmitedAnsId(array('min' => 12)); // WHERE survery_submited_ans_id > 12
     * </code>
     *
     * @param mixed $surverySubmitedAnsId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurverySubmitedAnsId($surverySubmitedAnsId = null, ?string $comparison = null)
    {
        if (is_array($surverySubmitedAnsId)) {
            $useMinMax = false;
            if (isset($surverySubmitedAnsId['min'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $surverySubmitedAnsId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surverySubmitedAnsId['max'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $surverySubmitedAnsId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $surverySubmitedAnsId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survery_question_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveryQuestionId(1234); // WHERE survery_question_id = 1234
     * $query->filterBySurveryQuestionId(array(12, 34)); // WHERE survery_question_id IN (12, 34)
     * $query->filterBySurveryQuestionId(array('min' => 12)); // WHERE survery_question_id > 12
     * </code>
     *
     * @see       filterBySurveyQuestion()
     *
     * @param mixed $surveryQuestionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveryQuestionId($surveryQuestionId = null, ?string $comparison = null)
    {
        if (is_array($surveryQuestionId)) {
            $useMinMax = false;
            if (isset($surveryQuestionId['min'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, $surveryQuestionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveryQuestionId['max'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, $surveryQuestionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, $surveryQuestionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_answer column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyAnswer('fooValue');   // WHERE survey_answer = 'fooValue'
     * $query->filterBySurveyAnswer('%fooValue%', Criteria::LIKE); // WHERE survey_answer LIKE '%fooValue%'
     * $query->filterBySurveyAnswer(['foo', 'bar']); // WHERE survey_answer IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surveyAnswer The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyAnswer($surveyAnswer = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surveyAnswer)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_ANSWER, $surveyAnswer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_submited_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveySubmitedId(1234); // WHERE survey_submited_id = 1234
     * $query->filterBySurveySubmitedId(array(12, 34)); // WHERE survey_submited_id IN (12, 34)
     * $query->filterBySurveySubmitedId(array('min' => 12)); // WHERE survey_submited_id > 12
     * </code>
     *
     * @see       filterBySurveySubmited()
     *
     * @param mixed $surveySubmitedId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveySubmitedId($surveySubmitedId = null, ?string $comparison = null)
    {
        if (is_array($surveySubmitedId)) {
            $useMinMax = false;
            if (isset($surveySubmitedId['min'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, $surveySubmitedId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveySubmitedId['max'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, $surveySubmitedId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, $surveySubmitedId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\SurveyQuestion object
     *
     * @param \entities\SurveyQuestion|ObjectCollection $surveyQuestion The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyQuestion($surveyQuestion, ?string $comparison = null)
    {
        if ($surveyQuestion instanceof \entities\SurveyQuestion) {
            return $this
                ->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, $surveyQuestion->getSurveyquesid(), $comparison);
        } elseif ($surveyQuestion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_QUESTION_ID, $surveyQuestion->toKeyValue('PrimaryKey', 'Surveyquesid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySurveyQuestion() only accepts arguments of type \entities\SurveyQuestion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveyQuestion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveyQuestion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveyQuestion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SurveyQuestion');
        }

        return $this;
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuestionQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuestionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveyQuestion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveyQuestion', '\entities\SurveyQuestionQuery');
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @param callable(\entities\SurveyQuestionQuery):\entities\SurveyQuestionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuestionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuestionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveyQuestion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the EXISTS statement
     */
    public function useSurveyQuestionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT EXISTS query.
     *
     * @see useSurveyQuestionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyQuestionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the IN statement
     */
    public function useInSurveyQuestionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT IN query.
     *
     * @see useSurveyQuestionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuestionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SurveySubmited object
     *
     * @param \entities\SurveySubmited|ObjectCollection $surveySubmited The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveySubmited($surveySubmited, ?string $comparison = null)
    {
        if ($surveySubmited instanceof \entities\SurveySubmited) {
            return $this
                ->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, $surveySubmited->getSurverySubmitId(), $comparison);
        } elseif ($surveySubmited instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVEY_SUBMITED_ID, $surveySubmited->toKeyValue('PrimaryKey', 'SurverySubmitId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySurveySubmited() only accepts arguments of type \entities\SurveySubmited or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveySubmited relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveySubmited(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveySubmited');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SurveySubmited');
        }

        return $this;
    }

    /**
     * Use the SurveySubmited relation SurveySubmited object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveySubmitedQuery A secondary query class using the current class as primary query
     */
    public function useSurveySubmitedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveySubmited($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveySubmited', '\entities\SurveySubmitedQuery');
    }

    /**
     * Use the SurveySubmited relation SurveySubmited object
     *
     * @param callable(\entities\SurveySubmitedQuery):\entities\SurveySubmitedQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveySubmitedQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveySubmitedQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveySubmited table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the EXISTS statement
     */
    public function useSurveySubmitedExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useExistsQuery('SurveySubmited', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for a NOT EXISTS query.
     *
     * @see useSurveySubmitedExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveySubmitedNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useExistsQuery('SurveySubmited', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the IN statement
     */
    public function useInSurveySubmitedQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useInQuery('SurveySubmited', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for a NOT IN query.
     *
     * @see useSurveySubmitedInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveySubmitedQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useInQuery('SurveySubmited', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSurveySubmitedAnswer $surveySubmitedAnswer Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($surveySubmitedAnswer = null)
    {
        if ($surveySubmitedAnswer) {
            $this->addUsingAlias(SurveySubmitedAnswerTableMap::COL_SURVERY_SUBMITED_ANS_ID, $surveySubmitedAnswer->getSurverySubmitedAnsId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the survey_submited_answer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedAnswerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SurveySubmitedAnswerTableMap::clearInstancePool();
            SurveySubmitedAnswerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveySubmitedAnswerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SurveySubmitedAnswerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SurveySubmitedAnswerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SurveySubmitedAnswerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

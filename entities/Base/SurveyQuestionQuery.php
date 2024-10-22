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
use entities\SurveyQuestion as ChildSurveyQuestion;
use entities\SurveyQuestionQuery as ChildSurveyQuestionQuery;
use entities\Map\SurveyQuestionTableMap;

/**
 * Base class that represents a query for the `survey_question` table.
 *
 * @method     ChildSurveyQuestionQuery orderBySurveyquesid($order = Criteria::ASC) Order by the surveyquesid column
 * @method     ChildSurveyQuestionQuery orderBySurveyquestype($order = Criteria::ASC) Order by the surveyquestype column
 * @method     ChildSurveyQuestionQuery orderByQuestion($order = Criteria::ASC) Order by the question column
 * @method     ChildSurveyQuestionQuery orderBySurveyquestionopt($order = Criteria::ASC) Order by the surveyquestionopt column
 * @method     ChildSurveyQuestionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSurveyQuestionQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSurveyQuestionQuery orderBySurveyId($order = Criteria::ASC) Order by the survey_id column
 * @method     ChildSurveyQuestionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSurveyQuestionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSurveyQuestionQuery orderByQuestionNumber($order = Criteria::ASC) Order by the question_number column
 * @method     ChildSurveyQuestionQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildSurveyQuestionQuery orderByIsRequired($order = Criteria::ASC) Order by the is_required column
 *
 * @method     ChildSurveyQuestionQuery groupBySurveyquesid() Group by the surveyquesid column
 * @method     ChildSurveyQuestionQuery groupBySurveyquestype() Group by the surveyquestype column
 * @method     ChildSurveyQuestionQuery groupByQuestion() Group by the question column
 * @method     ChildSurveyQuestionQuery groupBySurveyquestionopt() Group by the surveyquestionopt column
 * @method     ChildSurveyQuestionQuery groupByStatus() Group by the status column
 * @method     ChildSurveyQuestionQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSurveyQuestionQuery groupBySurveyId() Group by the survey_id column
 * @method     ChildSurveyQuestionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSurveyQuestionQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSurveyQuestionQuery groupByQuestionNumber() Group by the question_number column
 * @method     ChildSurveyQuestionQuery groupByMediaId() Group by the media_id column
 * @method     ChildSurveyQuestionQuery groupByIsRequired() Group by the is_required column
 *
 * @method     ChildSurveyQuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSurveyQuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSurveyQuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSurveyQuestionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSurveyQuestionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSurveyQuestionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSurveyQuestionQuery leftJoinSurvey($relationAlias = null) Adds a LEFT JOIN clause to the query using the Survey relation
 * @method     ChildSurveyQuestionQuery rightJoinSurvey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Survey relation
 * @method     ChildSurveyQuestionQuery innerJoinSurvey($relationAlias = null) Adds a INNER JOIN clause to the query using the Survey relation
 *
 * @method     ChildSurveyQuestionQuery joinWithSurvey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Survey relation
 *
 * @method     ChildSurveyQuestionQuery leftJoinWithSurvey() Adds a LEFT JOIN clause and with to the query using the Survey relation
 * @method     ChildSurveyQuestionQuery rightJoinWithSurvey() Adds a RIGHT JOIN clause and with to the query using the Survey relation
 * @method     ChildSurveyQuestionQuery innerJoinWithSurvey() Adds a INNER JOIN clause and with to the query using the Survey relation
 *
 * @method     ChildSurveyQuestionQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSurveyQuestionQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSurveyQuestionQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSurveyQuestionQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSurveyQuestionQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveyQuestionQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSurveyQuestionQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSurveyQuestionQuery leftJoinSurveySubmitedAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveyQuestionQuery rightJoinSurveySubmitedAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveyQuestionQuery innerJoinSurveySubmitedAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmitedAnswer relation
 *
 * @method     ChildSurveyQuestionQuery joinWithSurveySubmitedAnswer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmitedAnswer relation
 *
 * @method     ChildSurveyQuestionQuery leftJoinWithSurveySubmitedAnswer() Adds a LEFT JOIN clause and with to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveyQuestionQuery rightJoinWithSurveySubmitedAnswer() Adds a RIGHT JOIN clause and with to the query using the SurveySubmitedAnswer relation
 * @method     ChildSurveyQuestionQuery innerJoinWithSurveySubmitedAnswer() Adds a INNER JOIN clause and with to the query using the SurveySubmitedAnswer relation
 *
 * @method     \entities\SurveyQuery|\entities\CompanyQuery|\entities\SurveySubmitedAnswerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSurveyQuestion|null findOne(?ConnectionInterface $con = null) Return the first ChildSurveyQuestion matching the query
 * @method     ChildSurveyQuestion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSurveyQuestion matching the query, or a new ChildSurveyQuestion object populated from the query conditions when no match is found
 *
 * @method     ChildSurveyQuestion|null findOneBySurveyquesid(int $surveyquesid) Return the first ChildSurveyQuestion filtered by the surveyquesid column
 * @method     ChildSurveyQuestion|null findOneBySurveyquestype(string $surveyquestype) Return the first ChildSurveyQuestion filtered by the surveyquestype column
 * @method     ChildSurveyQuestion|null findOneByQuestion(string $question) Return the first ChildSurveyQuestion filtered by the question column
 * @method     ChildSurveyQuestion|null findOneBySurveyquestionopt(string $surveyquestionopt) Return the first ChildSurveyQuestion filtered by the surveyquestionopt column
 * @method     ChildSurveyQuestion|null findOneByStatus(string $status) Return the first ChildSurveyQuestion filtered by the status column
 * @method     ChildSurveyQuestion|null findOneByCompanyId(int $company_id) Return the first ChildSurveyQuestion filtered by the company_id column
 * @method     ChildSurveyQuestion|null findOneBySurveyId(int $survey_id) Return the first ChildSurveyQuestion filtered by the survey_id column
 * @method     ChildSurveyQuestion|null findOneByCreatedAt(string $created_at) Return the first ChildSurveyQuestion filtered by the created_at column
 * @method     ChildSurveyQuestion|null findOneByUpdatedAt(string $updated_at) Return the first ChildSurveyQuestion filtered by the updated_at column
 * @method     ChildSurveyQuestion|null findOneByQuestionNumber(int $question_number) Return the first ChildSurveyQuestion filtered by the question_number column
 * @method     ChildSurveyQuestion|null findOneByMediaId(string $media_id) Return the first ChildSurveyQuestion filtered by the media_id column
 * @method     ChildSurveyQuestion|null findOneByIsRequired(boolean $is_required) Return the first ChildSurveyQuestion filtered by the is_required column
 *
 * @method     ChildSurveyQuestion requirePk($key, ?ConnectionInterface $con = null) Return the ChildSurveyQuestion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOne(?ConnectionInterface $con = null) Return the first ChildSurveyQuestion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveyQuestion requireOneBySurveyquesid(int $surveyquesid) Return the first ChildSurveyQuestion filtered by the surveyquesid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneBySurveyquestype(string $surveyquestype) Return the first ChildSurveyQuestion filtered by the surveyquestype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByQuestion(string $question) Return the first ChildSurveyQuestion filtered by the question column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneBySurveyquestionopt(string $surveyquestionopt) Return the first ChildSurveyQuestion filtered by the surveyquestionopt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByStatus(string $status) Return the first ChildSurveyQuestion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByCompanyId(int $company_id) Return the first ChildSurveyQuestion filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneBySurveyId(int $survey_id) Return the first ChildSurveyQuestion filtered by the survey_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByCreatedAt(string $created_at) Return the first ChildSurveyQuestion filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByUpdatedAt(string $updated_at) Return the first ChildSurveyQuestion filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByQuestionNumber(int $question_number) Return the first ChildSurveyQuestion filtered by the question_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByMediaId(string $media_id) Return the first ChildSurveyQuestion filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSurveyQuestion requireOneByIsRequired(boolean $is_required) Return the first ChildSurveyQuestion filtered by the is_required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSurveyQuestion[]|Collection find(?ConnectionInterface $con = null) Return ChildSurveyQuestion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> find(?ConnectionInterface $con = null) Return ChildSurveyQuestion objects based on current ModelCriteria
 *
 * @method     ChildSurveyQuestion[]|Collection findBySurveyquesid(int|array<int> $surveyquesid) Return ChildSurveyQuestion objects filtered by the surveyquesid column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findBySurveyquesid(int|array<int> $surveyquesid) Return ChildSurveyQuestion objects filtered by the surveyquesid column
 * @method     ChildSurveyQuestion[]|Collection findBySurveyquestype(string|array<string> $surveyquestype) Return ChildSurveyQuestion objects filtered by the surveyquestype column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findBySurveyquestype(string|array<string> $surveyquestype) Return ChildSurveyQuestion objects filtered by the surveyquestype column
 * @method     ChildSurveyQuestion[]|Collection findByQuestion(string|array<string> $question) Return ChildSurveyQuestion objects filtered by the question column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByQuestion(string|array<string> $question) Return ChildSurveyQuestion objects filtered by the question column
 * @method     ChildSurveyQuestion[]|Collection findBySurveyquestionopt(string|array<string> $surveyquestionopt) Return ChildSurveyQuestion objects filtered by the surveyquestionopt column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findBySurveyquestionopt(string|array<string> $surveyquestionopt) Return ChildSurveyQuestion objects filtered by the surveyquestionopt column
 * @method     ChildSurveyQuestion[]|Collection findByStatus(string|array<string> $status) Return ChildSurveyQuestion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByStatus(string|array<string> $status) Return ChildSurveyQuestion objects filtered by the status column
 * @method     ChildSurveyQuestion[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSurveyQuestion objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByCompanyId(int|array<int> $company_id) Return ChildSurveyQuestion objects filtered by the company_id column
 * @method     ChildSurveyQuestion[]|Collection findBySurveyId(int|array<int> $survey_id) Return ChildSurveyQuestion objects filtered by the survey_id column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findBySurveyId(int|array<int> $survey_id) Return ChildSurveyQuestion objects filtered by the survey_id column
 * @method     ChildSurveyQuestion[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSurveyQuestion objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByCreatedAt(string|array<string> $created_at) Return ChildSurveyQuestion objects filtered by the created_at column
 * @method     ChildSurveyQuestion[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveyQuestion objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByUpdatedAt(string|array<string> $updated_at) Return ChildSurveyQuestion objects filtered by the updated_at column
 * @method     ChildSurveyQuestion[]|Collection findByQuestionNumber(int|array<int> $question_number) Return ChildSurveyQuestion objects filtered by the question_number column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByQuestionNumber(int|array<int> $question_number) Return ChildSurveyQuestion objects filtered by the question_number column
 * @method     ChildSurveyQuestion[]|Collection findByMediaId(string|array<string> $media_id) Return ChildSurveyQuestion objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByMediaId(string|array<string> $media_id) Return ChildSurveyQuestion objects filtered by the media_id column
 * @method     ChildSurveyQuestion[]|Collection findByIsRequired(boolean|array<boolean> $is_required) Return ChildSurveyQuestion objects filtered by the is_required column
 * @psalm-method Collection&\Traversable<ChildSurveyQuestion> findByIsRequired(boolean|array<boolean> $is_required) Return ChildSurveyQuestion objects filtered by the is_required column
 *
 * @method     ChildSurveyQuestion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSurveyQuestion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SurveyQuestionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SurveyQuestionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SurveyQuestion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSurveyQuestionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSurveyQuestionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSurveyQuestionQuery) {
            return $criteria;
        }
        $query = new ChildSurveyQuestionQuery();
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
     * @return ChildSurveyQuestion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SurveyQuestionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSurveyQuestion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT surveyquesid, surveyquestype, question, surveyquestionopt, status, company_id, survey_id, created_at, updated_at, question_number, media_id, is_required FROM survey_question WHERE surveyquesid = :p0';
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
            /** @var ChildSurveyQuestion $obj */
            $obj = new ChildSurveyQuestion();
            $obj->hydrate($row);
            SurveyQuestionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSurveyQuestion|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the surveyquesid column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyquesid(1234); // WHERE surveyquesid = 1234
     * $query->filterBySurveyquesid(array(12, 34)); // WHERE surveyquesid IN (12, 34)
     * $query->filterBySurveyquesid(array('min' => 12)); // WHERE surveyquesid > 12
     * </code>
     *
     * @param mixed $surveyquesid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyquesid($surveyquesid = null, ?string $comparison = null)
    {
        if (is_array($surveyquesid)) {
            $useMinMax = false;
            if (isset($surveyquesid['min'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $surveyquesid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyquesid['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $surveyquesid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $surveyquesid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the surveyquestype column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyquestype('fooValue');   // WHERE surveyquestype = 'fooValue'
     * $query->filterBySurveyquestype('%fooValue%', Criteria::LIKE); // WHERE surveyquestype LIKE '%fooValue%'
     * $query->filterBySurveyquestype(['foo', 'bar']); // WHERE surveyquestype IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surveyquestype The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyquestype($surveyquestype = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surveyquestype)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESTYPE, $surveyquestype, $comparison);

        return $this;
    }

    /**
     * Filter the query on the question column
     *
     * Example usage:
     * <code>
     * $query->filterByQuestion('fooValue');   // WHERE question = 'fooValue'
     * $query->filterByQuestion('%fooValue%', Criteria::LIKE); // WHERE question LIKE '%fooValue%'
     * $query->filterByQuestion(['foo', 'bar']); // WHERE question IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $question The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuestion($question = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($question)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_QUESTION, $question, $comparison);

        return $this;
    }

    /**
     * Filter the query on the surveyquestionopt column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyquestionopt('fooValue');   // WHERE surveyquestionopt = 'fooValue'
     * $query->filterBySurveyquestionopt('%fooValue%', Criteria::LIKE); // WHERE surveyquestionopt LIKE '%fooValue%'
     * $query->filterBySurveyquestionopt(['foo', 'bar']); // WHERE surveyquestionopt IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surveyquestionopt The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyquestionopt($surveyquestionopt = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surveyquestionopt)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESTIONOPT, $surveyquestionopt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE company_id = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE company_id IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE company_id > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, ?string $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyId(1234); // WHERE survey_id = 1234
     * $query->filterBySurveyId(array(12, 34)); // WHERE survey_id IN (12, 34)
     * $query->filterBySurveyId(array('min' => 12)); // WHERE survey_id > 12
     * </code>
     *
     * @see       filterBySurvey()
     *
     * @param mixed $surveyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyId($surveyId = null, ?string $comparison = null)
    {
        if (is_array($surveyId)) {
            $useMinMax = false;
            if (isset($surveyId['min'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEY_ID, $surveyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyId['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEY_ID, $surveyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEY_ID, $surveyId, $comparison);

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
                $this->addUsingAlias(SurveyQuestionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SurveyQuestionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the question_number column
     *
     * Example usage:
     * <code>
     * $query->filterByQuestionNumber(1234); // WHERE question_number = 1234
     * $query->filterByQuestionNumber(array(12, 34)); // WHERE question_number IN (12, 34)
     * $query->filterByQuestionNumber(array('min' => 12)); // WHERE question_number > 12
     * </code>
     *
     * @param mixed $questionNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuestionNumber($questionNumber = null, ?string $comparison = null)
    {
        if (is_array($questionNumber)) {
            $useMinMax = false;
            if (isset($questionNumber['min'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_QUESTION_NUMBER, $questionNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($questionNumber['max'])) {
                $this->addUsingAlias(SurveyQuestionTableMap::COL_QUESTION_NUMBER, $questionNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_QUESTION_NUMBER, $questionNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId('fooValue');   // WHERE media_id = 'fooValue'
     * $query->filterByMediaId('%fooValue%', Criteria::LIKE); // WHERE media_id LIKE '%fooValue%'
     * $query->filterByMediaId(['foo', 'bar']); // WHERE media_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mediaId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_MEDIA_ID, $mediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_required column
     *
     * Example usage:
     * <code>
     * $query->filterByIsRequired(true); // WHERE is_required = true
     * $query->filterByIsRequired('yes'); // WHERE is_required = true
     * </code>
     *
     * @param bool|string $isRequired The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsRequired($isRequired = null, ?string $comparison = null)
    {
        if (is_string($isRequired)) {
            $isRequired = in_array(strtolower($isRequired), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SurveyQuestionTableMap::COL_IS_REQUIRED, $isRequired, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Survey object
     *
     * @param \entities\Survey|ObjectCollection $survey The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurvey($survey, ?string $comparison = null)
    {
        if ($survey instanceof \entities\Survey) {
            return $this
                ->addUsingAlias(SurveyQuestionTableMap::COL_SURVEY_ID, $survey->getSurveyId(), $comparison);
        } elseif ($survey instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveyQuestionTableMap::COL_SURVEY_ID, $survey->toKeyValue('PrimaryKey', 'SurveyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySurvey() only accepts arguments of type \entities\Survey or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Survey relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurvey(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Survey');

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
            $this->addJoinObject($join, 'Survey');
        }

        return $this;
    }

    /**
     * Use the Survey relation Survey object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurvey($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Survey', '\entities\SurveyQuery');
    }

    /**
     * Use the Survey relation Survey object
     *
     * @param callable(\entities\SurveyQuery):\entities\SurveyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Survey table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuery The inner query object of the EXISTS statement
     */
    public function useSurveyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT EXISTS query.
     *
     * @see useSurveyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Survey table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuery The inner query object of the IN statement
     */
    public function useInSurveyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT IN query.
     *
     * @see useSurveyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Company object
     *
     * @param \entities\Company|ObjectCollection $company The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($company, ?string $comparison = null)
    {
        if ($company instanceof \entities\Company) {
            return $this
                ->addUsingAlias(SurveyQuestionTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SurveyQuestionTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \entities\Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

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
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation Company object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\entities\CompanyQuery');
    }

    /**
     * Use the Company relation Company object
     *
     * @param callable(\entities\CompanyQuery):\entities\CompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompanyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Company table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT EXISTS query.
     *
     * @see useCompanyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Company table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Company table for a NOT IN query.
     *
     * @see useCompanyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SurveySubmitedAnswer object
     *
     * @param \entities\SurveySubmitedAnswer|ObjectCollection $surveySubmitedAnswer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveySubmitedAnswer($surveySubmitedAnswer, ?string $comparison = null)
    {
        if ($surveySubmitedAnswer instanceof \entities\SurveySubmitedAnswer) {
            $this
                ->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $surveySubmitedAnswer->getSurveryQuestionId(), $comparison);

            return $this;
        } elseif ($surveySubmitedAnswer instanceof ObjectCollection) {
            $this
                ->useSurveySubmitedAnswerQuery()
                ->filterByPrimaryKeys($surveySubmitedAnswer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveySubmitedAnswer() only accepts arguments of type \entities\SurveySubmitedAnswer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveySubmitedAnswer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveySubmitedAnswer(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveySubmitedAnswer');

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
            $this->addJoinObject($join, 'SurveySubmitedAnswer');
        }

        return $this;
    }

    /**
     * Use the SurveySubmitedAnswer relation SurveySubmitedAnswer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveySubmitedAnswerQuery A secondary query class using the current class as primary query
     */
    public function useSurveySubmitedAnswerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveySubmitedAnswer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveySubmitedAnswer', '\entities\SurveySubmitedAnswerQuery');
    }

    /**
     * Use the SurveySubmitedAnswer relation SurveySubmitedAnswer object
     *
     * @param callable(\entities\SurveySubmitedAnswerQuery):\entities\SurveySubmitedAnswerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveySubmitedAnswerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveySubmitedAnswerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the EXISTS statement
     */
    public function useSurveySubmitedAnswerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useExistsQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for a NOT EXISTS query.
     *
     * @see useSurveySubmitedAnswerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveySubmitedAnswerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useExistsQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the IN statement
     */
    public function useInSurveySubmitedAnswerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useInQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveySubmitedAnswer table for a NOT IN query.
     *
     * @see useSurveySubmitedAnswerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedAnswerQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveySubmitedAnswerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedAnswerQuery */
        $q = $this->useInQuery('SurveySubmitedAnswer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSurveyQuestion $surveyQuestion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($surveyQuestion = null)
    {
        if ($surveyQuestion) {
            $this->addUsingAlias(SurveyQuestionTableMap::COL_SURVEYQUESID, $surveyQuestion->getSurveyquesid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the survey_question table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SurveyQuestionTableMap::clearInstancePool();
            SurveyQuestionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SurveyQuestionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SurveyQuestionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SurveyQuestionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SurveyQuestionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

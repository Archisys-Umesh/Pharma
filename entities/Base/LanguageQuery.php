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
use entities\Language as ChildLanguage;
use entities\LanguageQuery as ChildLanguageQuery;
use entities\Map\LanguageTableMap;

/**
 * Base class that represents a query for the `language` table.
 *
 * @method     ChildLanguageQuery orderByLanguageId($order = Criteria::ASC) Order by the language_id column
 * @method     ChildLanguageQuery orderByLanguageName($order = Criteria::ASC) Order by the language_name column
 * @method     ChildLanguageQuery orderByLanguageCode($order = Criteria::ASC) Order by the language_code column
 * @method     ChildLanguageQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLanguageQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLanguageQuery groupByLanguageId() Group by the language_id column
 * @method     ChildLanguageQuery groupByLanguageName() Group by the language_name column
 * @method     ChildLanguageQuery groupByLanguageCode() Group by the language_code column
 * @method     ChildLanguageQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLanguageQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLanguageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLanguageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLanguageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLanguageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLanguageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLanguageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLanguageQuery leftJoinEdPresentations($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdPresentations relation
 * @method     ChildLanguageQuery rightJoinEdPresentations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdPresentations relation
 * @method     ChildLanguageQuery innerJoinEdPresentations($relationAlias = null) Adds a INNER JOIN clause to the query using the EdPresentations relation
 *
 * @method     ChildLanguageQuery joinWithEdPresentations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdPresentations relation
 *
 * @method     ChildLanguageQuery leftJoinWithEdPresentations() Adds a LEFT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildLanguageQuery rightJoinWithEdPresentations() Adds a RIGHT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildLanguageQuery innerJoinWithEdPresentations() Adds a INNER JOIN clause and with to the query using the EdPresentations relation
 *
 * @method     \entities\EdPresentationsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLanguage|null findOne(?ConnectionInterface $con = null) Return the first ChildLanguage matching the query
 * @method     ChildLanguage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildLanguage matching the query, or a new ChildLanguage object populated from the query conditions when no match is found
 *
 * @method     ChildLanguage|null findOneByLanguageId(int $language_id) Return the first ChildLanguage filtered by the language_id column
 * @method     ChildLanguage|null findOneByLanguageName(string $language_name) Return the first ChildLanguage filtered by the language_name column
 * @method     ChildLanguage|null findOneByLanguageCode(string $language_code) Return the first ChildLanguage filtered by the language_code column
 * @method     ChildLanguage|null findOneByCreatedAt(string $created_at) Return the first ChildLanguage filtered by the created_at column
 * @method     ChildLanguage|null findOneByUpdatedAt(string $updated_at) Return the first ChildLanguage filtered by the updated_at column
 *
 * @method     ChildLanguage requirePk($key, ?ConnectionInterface $con = null) Return the ChildLanguage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLanguage requireOne(?ConnectionInterface $con = null) Return the first ChildLanguage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLanguage requireOneByLanguageId(int $language_id) Return the first ChildLanguage filtered by the language_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLanguage requireOneByLanguageName(string $language_name) Return the first ChildLanguage filtered by the language_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLanguage requireOneByLanguageCode(string $language_code) Return the first ChildLanguage filtered by the language_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLanguage requireOneByCreatedAt(string $created_at) Return the first ChildLanguage filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLanguage requireOneByUpdatedAt(string $updated_at) Return the first ChildLanguage filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLanguage[]|Collection find(?ConnectionInterface $con = null) Return ChildLanguage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildLanguage> find(?ConnectionInterface $con = null) Return ChildLanguage objects based on current ModelCriteria
 *
 * @method     ChildLanguage[]|Collection findByLanguageId(int|array<int> $language_id) Return ChildLanguage objects filtered by the language_id column
 * @psalm-method Collection&\Traversable<ChildLanguage> findByLanguageId(int|array<int> $language_id) Return ChildLanguage objects filtered by the language_id column
 * @method     ChildLanguage[]|Collection findByLanguageName(string|array<string> $language_name) Return ChildLanguage objects filtered by the language_name column
 * @psalm-method Collection&\Traversable<ChildLanguage> findByLanguageName(string|array<string> $language_name) Return ChildLanguage objects filtered by the language_name column
 * @method     ChildLanguage[]|Collection findByLanguageCode(string|array<string> $language_code) Return ChildLanguage objects filtered by the language_code column
 * @psalm-method Collection&\Traversable<ChildLanguage> findByLanguageCode(string|array<string> $language_code) Return ChildLanguage objects filtered by the language_code column
 * @method     ChildLanguage[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildLanguage objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildLanguage> findByCreatedAt(string|array<string> $created_at) Return ChildLanguage objects filtered by the created_at column
 * @method     ChildLanguage[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildLanguage objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildLanguage> findByUpdatedAt(string|array<string> $updated_at) Return ChildLanguage objects filtered by the updated_at column
 *
 * @method     ChildLanguage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildLanguage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class LanguageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\LanguageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Language', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLanguageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLanguageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildLanguageQuery) {
            return $criteria;
        }
        $query = new ChildLanguageQuery();
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
     * @return ChildLanguage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LanguageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = LanguageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildLanguage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT language_id, language_name, language_code, created_at, updated_at FROM language WHERE language_id = :p0';
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
            /** @var ChildLanguage $obj */
            $obj = new ChildLanguage();
            $obj->hydrate($row);
            LanguageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildLanguage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the language_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguageId(1234); // WHERE language_id = 1234
     * $query->filterByLanguageId(array(12, 34)); // WHERE language_id IN (12, 34)
     * $query->filterByLanguageId(array('min' => 12)); // WHERE language_id > 12
     * </code>
     *
     * @param mixed $languageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLanguageId($languageId = null, ?string $comparison = null)
    {
        if (is_array($languageId)) {
            $useMinMax = false;
            if (isset($languageId['min'])) {
                $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $languageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($languageId['max'])) {
                $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $languageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $languageId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the language_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguageName('fooValue');   // WHERE language_name = 'fooValue'
     * $query->filterByLanguageName('%fooValue%', Criteria::LIKE); // WHERE language_name LIKE '%fooValue%'
     * $query->filterByLanguageName(['foo', 'bar']); // WHERE language_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $languageName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLanguageName($languageName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($languageName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_NAME, $languageName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the language_code column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguageCode('fooValue');   // WHERE language_code = 'fooValue'
     * $query->filterByLanguageCode('%fooValue%', Criteria::LIKE); // WHERE language_code LIKE '%fooValue%'
     * $query->filterByLanguageCode(['foo', 'bar']); // WHERE language_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $languageCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLanguageCode($languageCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($languageCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_CODE, $languageCode, $comparison);

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
                $this->addUsingAlias(LanguageTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LanguageTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LanguageTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(LanguageTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LanguageTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(LanguageTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\EdPresentations object
     *
     * @param \entities\EdPresentations|ObjectCollection $edPresentations the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPresentations($edPresentations, ?string $comparison = null)
    {
        if ($edPresentations instanceof \entities\EdPresentations) {
            $this
                ->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $edPresentations->getPresentationLanguageId(), $comparison);

            return $this;
        } elseif ($edPresentations instanceof ObjectCollection) {
            $this
                ->useEdPresentationsQuery()
                ->filterByPrimaryKeys($edPresentations->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdPresentations() only accepts arguments of type \entities\EdPresentations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdPresentations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdPresentations(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdPresentations');

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
            $this->addJoinObject($join, 'EdPresentations');
        }

        return $this;
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdPresentationsQuery A secondary query class using the current class as primary query
     */
    public function useEdPresentationsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdPresentations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdPresentations', '\entities\EdPresentationsQuery');
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @param callable(\entities\EdPresentationsQuery):\entities\EdPresentationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdPresentationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdPresentationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdPresentations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdPresentationsQuery The inner query object of the EXISTS statement
     */
    public function useEdPresentationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT EXISTS query.
     *
     * @see useEdPresentationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdPresentationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdPresentationsQuery The inner query object of the IN statement
     */
    public function useInEdPresentationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT IN query.
     *
     * @see useEdPresentationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdPresentationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildLanguage $language Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($language = null)
    {
        if ($language) {
            $this->addUsingAlias(LanguageTableMap::COL_LANGUAGE_ID, $language->getLanguageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the language table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LanguageTableMap::clearInstancePool();
            LanguageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LanguageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LanguageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LanguageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

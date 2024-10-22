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
use entities\CompetitionMapping as ChildCompetitionMapping;
use entities\CompetitionMappingQuery as ChildCompetitionMappingQuery;
use entities\Map\CompetitionMappingTableMap;

/**
 * Base class that represents a query for the `competition_mapping` table.
 *
 * @method     ChildCompetitionMappingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCompetitionMappingQuery orderByCompetitionName($order = Criteria::ASC) Order by the competition_name column
 * @method     ChildCompetitionMappingQuery orderByCompetitionSku($order = Criteria::ASC) Order by the competition_sku column
 * @method     ChildCompetitionMappingQuery orderByCompetitionMrp($order = Criteria::ASC) Order by the competition_mrp column
 * @method     ChildCompetitionMappingQuery orderByCompetitionFeatures($order = Criteria::ASC) Order by the competition_features column
 * @method     ChildCompetitionMappingQuery orderByCompetitionRemark($order = Criteria::ASC) Order by the competition_remark column
 * @method     ChildCompetitionMappingQuery orderByConsumerFeedback($order = Criteria::ASC) Order by the consumer_feedback column
 * @method     ChildCompetitionMappingQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildCompetitionMappingQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCompetitionMappingQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildCompetitionMappingQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildCompetitionMappingQuery orderByCompetitorId($order = Criteria::ASC) Order by the competitor_id column
 * @method     ChildCompetitionMappingQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildCompetitionMappingQuery orderByQty($order = Criteria::ASC) Order by the qty column
 *
 * @method     ChildCompetitionMappingQuery groupById() Group by the id column
 * @method     ChildCompetitionMappingQuery groupByCompetitionName() Group by the competition_name column
 * @method     ChildCompetitionMappingQuery groupByCompetitionSku() Group by the competition_sku column
 * @method     ChildCompetitionMappingQuery groupByCompetitionMrp() Group by the competition_mrp column
 * @method     ChildCompetitionMappingQuery groupByCompetitionFeatures() Group by the competition_features column
 * @method     ChildCompetitionMappingQuery groupByCompetitionRemark() Group by the competition_remark column
 * @method     ChildCompetitionMappingQuery groupByConsumerFeedback() Group by the consumer_feedback column
 * @method     ChildCompetitionMappingQuery groupByMediaId() Group by the media_id column
 * @method     ChildCompetitionMappingQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCompetitionMappingQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildCompetitionMappingQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildCompetitionMappingQuery groupByCompetitorId() Group by the competitor_id column
 * @method     ChildCompetitionMappingQuery groupByUnitId() Group by the unit_id column
 * @method     ChildCompetitionMappingQuery groupByQty() Group by the qty column
 *
 * @method     ChildCompetitionMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompetitionMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompetitionMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompetitionMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCompetitionMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCompetitionMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCompetitionMappingQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildCompetitionMappingQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildCompetitionMappingQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildCompetitionMappingQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildCompetitionMappingQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildCompetitionMappingQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildCompetitionMappingQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildCompetitionMappingQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildCompetitionMappingQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildCompetitionMappingQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildCompetitionMappingQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildCompetitionMappingQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildCompetitionMappingQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildCompetitionMappingQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildCompetitionMappingQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildCompetitionMappingQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinCompetitor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Competitor relation
 * @method     ChildCompetitionMappingQuery rightJoinCompetitor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Competitor relation
 * @method     ChildCompetitionMappingQuery innerJoinCompetitor($relationAlias = null) Adds a INNER JOIN clause to the query using the Competitor relation
 *
 * @method     ChildCompetitionMappingQuery joinWithCompetitor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Competitor relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinWithCompetitor() Adds a LEFT JOIN clause and with to the query using the Competitor relation
 * @method     ChildCompetitionMappingQuery rightJoinWithCompetitor() Adds a RIGHT JOIN clause and with to the query using the Competitor relation
 * @method     ChildCompetitionMappingQuery innerJoinWithCompetitor() Adds a INNER JOIN clause and with to the query using the Competitor relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinUnitmaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unitmaster relation
 * @method     ChildCompetitionMappingQuery rightJoinUnitmaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unitmaster relation
 * @method     ChildCompetitionMappingQuery innerJoinUnitmaster($relationAlias = null) Adds a INNER JOIN clause to the query using the Unitmaster relation
 *
 * @method     ChildCompetitionMappingQuery joinWithUnitmaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unitmaster relation
 *
 * @method     ChildCompetitionMappingQuery leftJoinWithUnitmaster() Adds a LEFT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildCompetitionMappingQuery rightJoinWithUnitmaster() Adds a RIGHT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildCompetitionMappingQuery innerJoinWithUnitmaster() Adds a INNER JOIN clause and with to the query using the Unitmaster relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\OutletsQuery|\entities\CompetitorQuery|\entities\UnitmasterQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCompetitionMapping|null findOne(?ConnectionInterface $con = null) Return the first ChildCompetitionMapping matching the query
 * @method     ChildCompetitionMapping findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCompetitionMapping matching the query, or a new ChildCompetitionMapping object populated from the query conditions when no match is found
 *
 * @method     ChildCompetitionMapping|null findOneById(int $id) Return the first ChildCompetitionMapping filtered by the id column
 * @method     ChildCompetitionMapping|null findOneByCompetitionName(string $competition_name) Return the first ChildCompetitionMapping filtered by the competition_name column
 * @method     ChildCompetitionMapping|null findOneByCompetitionSku(string $competition_sku) Return the first ChildCompetitionMapping filtered by the competition_sku column
 * @method     ChildCompetitionMapping|null findOneByCompetitionMrp(string $competition_mrp) Return the first ChildCompetitionMapping filtered by the competition_mrp column
 * @method     ChildCompetitionMapping|null findOneByCompetitionFeatures(string $competition_features) Return the first ChildCompetitionMapping filtered by the competition_features column
 * @method     ChildCompetitionMapping|null findOneByCompetitionRemark(string $competition_remark) Return the first ChildCompetitionMapping filtered by the competition_remark column
 * @method     ChildCompetitionMapping|null findOneByConsumerFeedback(string $consumer_feedback) Return the first ChildCompetitionMapping filtered by the consumer_feedback column
 * @method     ChildCompetitionMapping|null findOneByMediaId(string $media_id) Return the first ChildCompetitionMapping filtered by the media_id column
 * @method     ChildCompetitionMapping|null findOneByCompanyId(int $company_id) Return the first ChildCompetitionMapping filtered by the company_id column
 * @method     ChildCompetitionMapping|null findOneByEmployeeId(int $employee_id) Return the first ChildCompetitionMapping filtered by the employee_id column
 * @method     ChildCompetitionMapping|null findOneByOutletId(int $outlet_id) Return the first ChildCompetitionMapping filtered by the outlet_id column
 * @method     ChildCompetitionMapping|null findOneByCompetitorId(int $competitor_id) Return the first ChildCompetitionMapping filtered by the competitor_id column
 * @method     ChildCompetitionMapping|null findOneByUnitId(int $unit_id) Return the first ChildCompetitionMapping filtered by the unit_id column
 * @method     ChildCompetitionMapping|null findOneByQty(string $qty) Return the first ChildCompetitionMapping filtered by the qty column
 *
 * @method     ChildCompetitionMapping requirePk($key, ?ConnectionInterface $con = null) Return the ChildCompetitionMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOne(?ConnectionInterface $con = null) Return the first ChildCompetitionMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompetitionMapping requireOneById(int $id) Return the first ChildCompetitionMapping filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitionName(string $competition_name) Return the first ChildCompetitionMapping filtered by the competition_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitionSku(string $competition_sku) Return the first ChildCompetitionMapping filtered by the competition_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitionMrp(string $competition_mrp) Return the first ChildCompetitionMapping filtered by the competition_mrp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitionFeatures(string $competition_features) Return the first ChildCompetitionMapping filtered by the competition_features column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitionRemark(string $competition_remark) Return the first ChildCompetitionMapping filtered by the competition_remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByConsumerFeedback(string $consumer_feedback) Return the first ChildCompetitionMapping filtered by the consumer_feedback column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByMediaId(string $media_id) Return the first ChildCompetitionMapping filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompanyId(int $company_id) Return the first ChildCompetitionMapping filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByEmployeeId(int $employee_id) Return the first ChildCompetitionMapping filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByOutletId(int $outlet_id) Return the first ChildCompetitionMapping filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByCompetitorId(int $competitor_id) Return the first ChildCompetitionMapping filtered by the competitor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByUnitId(int $unit_id) Return the first ChildCompetitionMapping filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompetitionMapping requireOneByQty(string $qty) Return the first ChildCompetitionMapping filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompetitionMapping[]|Collection find(?ConnectionInterface $con = null) Return ChildCompetitionMapping objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> find(?ConnectionInterface $con = null) Return ChildCompetitionMapping objects based on current ModelCriteria
 *
 * @method     ChildCompetitionMapping[]|Collection findById(int|array<int> $id) Return ChildCompetitionMapping objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findById(int|array<int> $id) Return ChildCompetitionMapping objects filtered by the id column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitionName(string|array<string> $competition_name) Return ChildCompetitionMapping objects filtered by the competition_name column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitionName(string|array<string> $competition_name) Return ChildCompetitionMapping objects filtered by the competition_name column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitionSku(string|array<string> $competition_sku) Return ChildCompetitionMapping objects filtered by the competition_sku column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitionSku(string|array<string> $competition_sku) Return ChildCompetitionMapping objects filtered by the competition_sku column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitionMrp(string|array<string> $competition_mrp) Return ChildCompetitionMapping objects filtered by the competition_mrp column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitionMrp(string|array<string> $competition_mrp) Return ChildCompetitionMapping objects filtered by the competition_mrp column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitionFeatures(string|array<string> $competition_features) Return ChildCompetitionMapping objects filtered by the competition_features column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitionFeatures(string|array<string> $competition_features) Return ChildCompetitionMapping objects filtered by the competition_features column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitionRemark(string|array<string> $competition_remark) Return ChildCompetitionMapping objects filtered by the competition_remark column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitionRemark(string|array<string> $competition_remark) Return ChildCompetitionMapping objects filtered by the competition_remark column
 * @method     ChildCompetitionMapping[]|Collection findByConsumerFeedback(string|array<string> $consumer_feedback) Return ChildCompetitionMapping objects filtered by the consumer_feedback column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByConsumerFeedback(string|array<string> $consumer_feedback) Return ChildCompetitionMapping objects filtered by the consumer_feedback column
 * @method     ChildCompetitionMapping[]|Collection findByMediaId(string|array<string> $media_id) Return ChildCompetitionMapping objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByMediaId(string|array<string> $media_id) Return ChildCompetitionMapping objects filtered by the media_id column
 * @method     ChildCompetitionMapping[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCompetitionMapping objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompanyId(int|array<int> $company_id) Return ChildCompetitionMapping objects filtered by the company_id column
 * @method     ChildCompetitionMapping[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildCompetitionMapping objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByEmployeeId(int|array<int> $employee_id) Return ChildCompetitionMapping objects filtered by the employee_id column
 * @method     ChildCompetitionMapping[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildCompetitionMapping objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByOutletId(int|array<int> $outlet_id) Return ChildCompetitionMapping objects filtered by the outlet_id column
 * @method     ChildCompetitionMapping[]|Collection findByCompetitorId(int|array<int> $competitor_id) Return ChildCompetitionMapping objects filtered by the competitor_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByCompetitorId(int|array<int> $competitor_id) Return ChildCompetitionMapping objects filtered by the competitor_id column
 * @method     ChildCompetitionMapping[]|Collection findByUnitId(int|array<int> $unit_id) Return ChildCompetitionMapping objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByUnitId(int|array<int> $unit_id) Return ChildCompetitionMapping objects filtered by the unit_id column
 * @method     ChildCompetitionMapping[]|Collection findByQty(string|array<string> $qty) Return ChildCompetitionMapping objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildCompetitionMapping> findByQty(string|array<string> $qty) Return ChildCompetitionMapping objects filtered by the qty column
 *
 * @method     ChildCompetitionMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCompetitionMapping> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CompetitionMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CompetitionMappingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CompetitionMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompetitionMappingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompetitionMappingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCompetitionMappingQuery) {
            return $criteria;
        }
        $query = new ChildCompetitionMappingQuery();
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
     * @return ChildCompetitionMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CompetitionMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCompetitionMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, competition_name, competition_sku, competition_mrp, competition_features, competition_remark, consumer_feedback, media_id, company_id, employee_id, outlet_id, competitor_id, unit_id, qty FROM competition_mapping WHERE id = :p0';
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
            /** @var ChildCompetitionMapping $obj */
            $obj = new ChildCompetitionMapping();
            $obj->hydrate($row);
            CompetitionMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCompetitionMapping|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitionName('fooValue');   // WHERE competition_name = 'fooValue'
     * $query->filterByCompetitionName('%fooValue%', Criteria::LIKE); // WHERE competition_name LIKE '%fooValue%'
     * $query->filterByCompetitionName(['foo', 'bar']); // WHERE competition_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionName($competitionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_NAME, $competitionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitionSku('fooValue');   // WHERE competition_sku = 'fooValue'
     * $query->filterByCompetitionSku('%fooValue%', Criteria::LIKE); // WHERE competition_sku LIKE '%fooValue%'
     * $query->filterByCompetitionSku(['foo', 'bar']); // WHERE competition_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitionSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionSku($competitionSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitionSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_SKU, $competitionSku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition_mrp column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitionMrp(1234); // WHERE competition_mrp = 1234
     * $query->filterByCompetitionMrp(array(12, 34)); // WHERE competition_mrp IN (12, 34)
     * $query->filterByCompetitionMrp(array('min' => 12)); // WHERE competition_mrp > 12
     * </code>
     *
     * @param mixed $competitionMrp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionMrp($competitionMrp = null, ?string $comparison = null)
    {
        if (is_array($competitionMrp)) {
            $useMinMax = false;
            if (isset($competitionMrp['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_MRP, $competitionMrp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitionMrp['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_MRP, $competitionMrp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_MRP, $competitionMrp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition_features column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitionFeatures('fooValue');   // WHERE competition_features = 'fooValue'
     * $query->filterByCompetitionFeatures('%fooValue%', Criteria::LIKE); // WHERE competition_features LIKE '%fooValue%'
     * $query->filterByCompetitionFeatures(['foo', 'bar']); // WHERE competition_features IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitionFeatures The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionFeatures($competitionFeatures = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitionFeatures)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_FEATURES, $competitionFeatures, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competition_remark column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitionRemark('fooValue');   // WHERE competition_remark = 'fooValue'
     * $query->filterByCompetitionRemark('%fooValue%', Criteria::LIKE); // WHERE competition_remark LIKE '%fooValue%'
     * $query->filterByCompetitionRemark(['foo', 'bar']); // WHERE competition_remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $competitionRemark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionRemark($competitionRemark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($competitionRemark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITION_REMARK, $competitionRemark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the consumer_feedback column
     *
     * Example usage:
     * <code>
     * $query->filterByConsumerFeedback('fooValue');   // WHERE consumer_feedback = 'fooValue'
     * $query->filterByConsumerFeedback('%fooValue%', Criteria::LIKE); // WHERE consumer_feedback LIKE '%fooValue%'
     * $query->filterByConsumerFeedback(['foo', 'bar']); // WHERE consumer_feedback IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $consumerFeedback The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConsumerFeedback($consumerFeedback = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($consumerFeedback)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_CONSUMER_FEEDBACK, $consumerFeedback, $comparison);

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

        $this->addUsingAlias(CompetitionMappingTableMap::COL_MEDIA_ID, $mediaId, $comparison);

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
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE outlet_id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE outlet_id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE outlet_id > 12
     * </code>
     *
     * @see       filterByOutlets()
     *
     * @param mixed $outletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletId($outletId = null, ?string $comparison = null)
    {
        if (is_array($outletId)) {
            $useMinMax = false;
            if (isset($outletId['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the competitor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompetitorId(1234); // WHERE competitor_id = 1234
     * $query->filterByCompetitorId(array(12, 34)); // WHERE competitor_id IN (12, 34)
     * $query->filterByCompetitorId(array('min' => 12)); // WHERE competitor_id > 12
     * </code>
     *
     * @see       filterByCompetitor()
     *
     * @param mixed $competitorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitorId($competitorId = null, ?string $comparison = null)
    {
        if (is_array($competitorId)) {
            $useMinMax = false;
            if (isset($competitorId['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITOR_ID, $competitorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($competitorId['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITOR_ID, $competitorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITOR_ID, $competitorId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @see       filterByUnitmaster()
     *
     * @param mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, ?string $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_UNIT_ID, $unitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(CompetitionMappingTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompetitionMappingTableMap::COL_QTY, $qty, $comparison);

        return $this;
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
                ->addUsingAlias(CompetitionMappingTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployee() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Employee relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Employee');

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
            $this->addJoinObject($join, 'Employee');
        }

        return $this;
    }

    /**
     * Use the Employee relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployee($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Employee', '\entities\EmployeeQuery');
    }

    /**
     * Use the Employee relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('Employee', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Employee table for a NOT IN query.
     *
     * @see useEmployeeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('Employee', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutlets() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlets');

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
            $this->addJoinObject($join, 'Outlets');
        }

        return $this;
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlets', '\entities\OutletsQuery');
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT IN query.
     *
     * @see useOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Competitor object
     *
     * @param \entities\Competitor|ObjectCollection $competitor The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitor($competitor, ?string $comparison = null)
    {
        if ($competitor instanceof \entities\Competitor) {
            return $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITOR_ID, $competitor->getId(), $comparison);
        } elseif ($competitor instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_COMPETITOR_ID, $competitor->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompetitor() only accepts arguments of type \entities\Competitor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Competitor relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompetitor(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Competitor');

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
            $this->addJoinObject($join, 'Competitor');
        }

        return $this;
    }

    /**
     * Use the Competitor relation Competitor object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompetitorQuery A secondary query class using the current class as primary query
     */
    public function useCompetitorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompetitor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Competitor', '\entities\CompetitorQuery');
    }

    /**
     * Use the Competitor relation Competitor object
     *
     * @param callable(\entities\CompetitorQuery):\entities\CompetitorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompetitorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompetitorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Competitor table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompetitorQuery The inner query object of the EXISTS statement
     */
    public function useCompetitorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useExistsQuery('Competitor', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Competitor table for a NOT EXISTS query.
     *
     * @see useCompetitorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitorQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompetitorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useExistsQuery('Competitor', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Competitor table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompetitorQuery The inner query object of the IN statement
     */
    public function useInCompetitorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useInQuery('Competitor', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Competitor table for a NOT IN query.
     *
     * @see useCompetitorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitorQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompetitorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useInQuery('Competitor', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Unitmaster object
     *
     * @param \entities\Unitmaster|ObjectCollection $unitmaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitmaster($unitmaster, ?string $comparison = null)
    {
        if ($unitmaster instanceof \entities\Unitmaster) {
            return $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_UNIT_ID, $unitmaster->getUnitId(), $comparison);
        } elseif ($unitmaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompetitionMappingTableMap::COL_UNIT_ID, $unitmaster->toKeyValue('PrimaryKey', 'UnitId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUnitmaster() only accepts arguments of type \entities\Unitmaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unitmaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUnitmaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unitmaster');

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
            $this->addJoinObject($join, 'Unitmaster');
        }

        return $this;
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UnitmasterQuery A secondary query class using the current class as primary query
     */
    public function useUnitmasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUnitmaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unitmaster', '\entities\UnitmasterQuery');
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @param callable(\entities\UnitmasterQuery):\entities\UnitmasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUnitmasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUnitmasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Unitmaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UnitmasterQuery The inner query object of the EXISTS statement
     */
    public function useUnitmasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT EXISTS query.
     *
     * @see useUnitmasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useUnitmasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UnitmasterQuery The inner query object of the IN statement
     */
    public function useInUnitmasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT IN query.
     *
     * @see useUnitmasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInUnitmasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCompetitionMapping $competitionMapping Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($competitionMapping = null)
    {
        if ($competitionMapping) {
            $this->addUsingAlias(CompetitionMappingTableMap::COL_ID, $competitionMapping->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the competition_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompetitionMappingTableMap::clearInstancePool();
            CompetitionMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompetitionMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompetitionMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompetitionMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompetitionMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

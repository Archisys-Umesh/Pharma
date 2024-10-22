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
use entities\Pricebooks as ChildPricebooks;
use entities\PricebooksQuery as ChildPricebooksQuery;
use entities\Map\PricebooksTableMap;

/**
 * Base class that represents a query for the `pricebooks` table.
 *
 * @method     ChildPricebooksQuery orderByPricebookId($order = Criteria::ASC) Order by the pricebook_id column
 * @method     ChildPricebooksQuery orderByPricebookName($order = Criteria::ASC) Order by the pricebook_name column
 * @method     ChildPricebooksQuery orderByPricebookDescription($order = Criteria::ASC) Order by the pricebook_description column
 * @method     ChildPricebooksQuery orderByPricebookCode($order = Criteria::ASC) Order by the pricebook_code column
 * @method     ChildPricebooksQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPricebooksQuery orderByOrgId($order = Criteria::ASC) Order by the org_id column
 * @method     ChildPricebooksQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 *
 * @method     ChildPricebooksQuery groupByPricebookId() Group by the pricebook_id column
 * @method     ChildPricebooksQuery groupByPricebookName() Group by the pricebook_name column
 * @method     ChildPricebooksQuery groupByPricebookDescription() Group by the pricebook_description column
 * @method     ChildPricebooksQuery groupByPricebookCode() Group by the pricebook_code column
 * @method     ChildPricebooksQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPricebooksQuery groupByOrgId() Group by the org_id column
 * @method     ChildPricebooksQuery groupByIntegrationId() Group by the integration_id column
 *
 * @method     ChildPricebooksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPricebooksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPricebooksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPricebooksQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPricebooksQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPricebooksQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPricebooksQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPricebooksQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPricebooksQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPricebooksQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPricebooksQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPricebooksQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPricebooksQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPricebooksQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPricebooksQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPricebooksQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildPricebooksQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPricebooksQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPricebooksQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPricebooksQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPricebooksQuery leftJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildPricebooksQuery rightJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildPricebooksQuery innerJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     ChildPricebooksQuery joinWithOnBoardRequestOutletMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     ChildPricebooksQuery leftJoinWithOnBoardRequestOutletMapping() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildPricebooksQuery rightJoinWithOnBoardRequestOutletMapping() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildPricebooksQuery innerJoinWithOnBoardRequestOutletMapping() Adds a INNER JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     ChildPricebooksQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildPricebooksQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildPricebooksQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildPricebooksQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildPricebooksQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildPricebooksQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildPricebooksQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildPricebooksQuery leftJoinOutletMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletMapping relation
 * @method     ChildPricebooksQuery rightJoinOutletMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletMapping relation
 * @method     ChildPricebooksQuery innerJoinOutletMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletMapping relation
 *
 * @method     ChildPricebooksQuery joinWithOutletMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletMapping relation
 *
 * @method     ChildPricebooksQuery leftJoinWithOutletMapping() Adds a LEFT JOIN clause and with to the query using the OutletMapping relation
 * @method     ChildPricebooksQuery rightJoinWithOutletMapping() Adds a RIGHT JOIN clause and with to the query using the OutletMapping relation
 * @method     ChildPricebooksQuery innerJoinWithOutletMapping() Adds a INNER JOIN clause and with to the query using the OutletMapping relation
 *
 * @method     ChildPricebooksQuery leftJoinPricebooklines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildPricebooksQuery rightJoinPricebooklines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildPricebooksQuery innerJoinPricebooklines($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooklines relation
 *
 * @method     ChildPricebooksQuery joinWithPricebooklines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooklines relation
 *
 * @method     ChildPricebooksQuery leftJoinWithPricebooklines() Adds a LEFT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildPricebooksQuery rightJoinWithPricebooklines() Adds a RIGHT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildPricebooksQuery innerJoinWithPricebooklines() Adds a INNER JOIN clause and with to the query using the Pricebooklines relation
 *
 * @method     \entities\CompanyQuery|\entities\OrgUnitQuery|\entities\OnBoardRequestOutletMappingQuery|\entities\OrdersQuery|\entities\OutletMappingQuery|\entities\PricebooklinesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPricebooks|null findOne(?ConnectionInterface $con = null) Return the first ChildPricebooks matching the query
 * @method     ChildPricebooks findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPricebooks matching the query, or a new ChildPricebooks object populated from the query conditions when no match is found
 *
 * @method     ChildPricebooks|null findOneByPricebookId(int $pricebook_id) Return the first ChildPricebooks filtered by the pricebook_id column
 * @method     ChildPricebooks|null findOneByPricebookName(string $pricebook_name) Return the first ChildPricebooks filtered by the pricebook_name column
 * @method     ChildPricebooks|null findOneByPricebookDescription(string $pricebook_description) Return the first ChildPricebooks filtered by the pricebook_description column
 * @method     ChildPricebooks|null findOneByPricebookCode(string $pricebook_code) Return the first ChildPricebooks filtered by the pricebook_code column
 * @method     ChildPricebooks|null findOneByCompanyId(int $company_id) Return the first ChildPricebooks filtered by the company_id column
 * @method     ChildPricebooks|null findOneByOrgId(int $org_id) Return the first ChildPricebooks filtered by the org_id column
 * @method     ChildPricebooks|null findOneByIntegrationId(string $integration_id) Return the first ChildPricebooks filtered by the integration_id column
 *
 * @method     ChildPricebooks requirePk($key, ?ConnectionInterface $con = null) Return the ChildPricebooks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOne(?ConnectionInterface $con = null) Return the first ChildPricebooks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPricebooks requireOneByPricebookId(int $pricebook_id) Return the first ChildPricebooks filtered by the pricebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByPricebookName(string $pricebook_name) Return the first ChildPricebooks filtered by the pricebook_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByPricebookDescription(string $pricebook_description) Return the first ChildPricebooks filtered by the pricebook_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByPricebookCode(string $pricebook_code) Return the first ChildPricebooks filtered by the pricebook_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByCompanyId(int $company_id) Return the first ChildPricebooks filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByOrgId(int $org_id) Return the first ChildPricebooks filtered by the org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPricebooks requireOneByIntegrationId(string $integration_id) Return the first ChildPricebooks filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPricebooks[]|Collection find(?ConnectionInterface $con = null) Return ChildPricebooks objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPricebooks> find(?ConnectionInterface $con = null) Return ChildPricebooks objects based on current ModelCriteria
 *
 * @method     ChildPricebooks[]|Collection findByPricebookId(int|array<int> $pricebook_id) Return ChildPricebooks objects filtered by the pricebook_id column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByPricebookId(int|array<int> $pricebook_id) Return ChildPricebooks objects filtered by the pricebook_id column
 * @method     ChildPricebooks[]|Collection findByPricebookName(string|array<string> $pricebook_name) Return ChildPricebooks objects filtered by the pricebook_name column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByPricebookName(string|array<string> $pricebook_name) Return ChildPricebooks objects filtered by the pricebook_name column
 * @method     ChildPricebooks[]|Collection findByPricebookDescription(string|array<string> $pricebook_description) Return ChildPricebooks objects filtered by the pricebook_description column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByPricebookDescription(string|array<string> $pricebook_description) Return ChildPricebooks objects filtered by the pricebook_description column
 * @method     ChildPricebooks[]|Collection findByPricebookCode(string|array<string> $pricebook_code) Return ChildPricebooks objects filtered by the pricebook_code column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByPricebookCode(string|array<string> $pricebook_code) Return ChildPricebooks objects filtered by the pricebook_code column
 * @method     ChildPricebooks[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildPricebooks objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByCompanyId(int|array<int> $company_id) Return ChildPricebooks objects filtered by the company_id column
 * @method     ChildPricebooks[]|Collection findByOrgId(int|array<int> $org_id) Return ChildPricebooks objects filtered by the org_id column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByOrgId(int|array<int> $org_id) Return ChildPricebooks objects filtered by the org_id column
 * @method     ChildPricebooks[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildPricebooks objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildPricebooks> findByIntegrationId(string|array<string> $integration_id) Return ChildPricebooks objects filtered by the integration_id column
 *
 * @method     ChildPricebooks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPricebooks> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PricebooksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PricebooksQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Pricebooks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPricebooksQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPricebooksQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPricebooksQuery) {
            return $criteria;
        }
        $query = new ChildPricebooksQuery();
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
     * @return ChildPricebooks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PricebooksTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PricebooksTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPricebooks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pricebook_id, pricebook_name, pricebook_description, pricebook_code, company_id, org_id, integration_id FROM pricebooks WHERE pricebook_id = :p0';
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
            /** @var ChildPricebooks $obj */
            $obj = new ChildPricebooks();
            $obj->hydrate($row);
            PricebooksTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPricebooks|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the pricebook_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookId(1234); // WHERE pricebook_id = 1234
     * $query->filterByPricebookId(array(12, 34)); // WHERE pricebook_id IN (12, 34)
     * $query->filterByPricebookId(array('min' => 12)); // WHERE pricebook_id > 12
     * </code>
     *
     * @param mixed $pricebookId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookId($pricebookId = null, ?string $comparison = null)
    {
        if (is_array($pricebookId)) {
            $useMinMax = false;
            if (isset($pricebookId['min'])) {
                $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $pricebookId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pricebookId['max'])) {
                $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $pricebookId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $pricebookId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookName('fooValue');   // WHERE pricebook_name = 'fooValue'
     * $query->filterByPricebookName('%fooValue%', Criteria::LIKE); // WHERE pricebook_name LIKE '%fooValue%'
     * $query->filterByPricebookName(['foo', 'bar']); // WHERE pricebook_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pricebookName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookName($pricebookName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pricebookName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_NAME, $pricebookName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_description column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookDescription('fooValue');   // WHERE pricebook_description = 'fooValue'
     * $query->filterByPricebookDescription('%fooValue%', Criteria::LIKE); // WHERE pricebook_description LIKE '%fooValue%'
     * $query->filterByPricebookDescription(['foo', 'bar']); // WHERE pricebook_description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pricebookDescription The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookDescription($pricebookDescription = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pricebookDescription)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION, $pricebookDescription, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pricebook_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPricebookCode('fooValue');   // WHERE pricebook_code = 'fooValue'
     * $query->filterByPricebookCode('%fooValue%', Criteria::LIKE); // WHERE pricebook_code LIKE '%fooValue%'
     * $query->filterByPricebookCode(['foo', 'bar']); // WHERE pricebook_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pricebookCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebookCode($pricebookCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pricebookCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_CODE, $pricebookCode, $comparison);

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
                $this->addUsingAlias(PricebooksTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PricebooksTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgId(1234); // WHERE org_id = 1234
     * $query->filterByOrgId(array(12, 34)); // WHERE org_id IN (12, 34)
     * $query->filterByOrgId(array('min' => 12)); // WHERE org_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgId($orgId = null, ?string $comparison = null)
    {
        if (is_array($orgId)) {
            $useMinMax = false;
            if (isset($orgId['min'])) {
                $this->addUsingAlias(PricebooksTableMap::COL_ORG_ID, $orgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgId['max'])) {
                $this->addUsingAlias(PricebooksTableMap::COL_ORG_ID, $orgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_ORG_ID, $orgId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the integration_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIntegrationId('fooValue');   // WHERE integration_id = 'fooValue'
     * $query->filterByIntegrationId('%fooValue%', Criteria::LIKE); // WHERE integration_id LIKE '%fooValue%'
     * $query->filterByIntegrationId(['foo', 'bar']); // WHERE integration_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $integrationId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntegrationId($integrationId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($integrationId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PricebooksTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                ->addUsingAlias(PricebooksTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PricebooksTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(PricebooksTableMap::COL_ORG_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PricebooksTableMap::COL_ORG_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestOutletMapping object
     *
     * @param \entities\OnBoardRequestOutletMapping|ObjectCollection $onBoardRequestOutletMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestOutletMapping($onBoardRequestOutletMapping, ?string $comparison = null)
    {
        if ($onBoardRequestOutletMapping instanceof \entities\OnBoardRequestOutletMapping) {
            $this
                ->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $onBoardRequestOutletMapping->getPricebookId(), $comparison);

            return $this;
        } elseif ($onBoardRequestOutletMapping instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestOutletMappingQuery()
                ->filterByPrimaryKeys($onBoardRequestOutletMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestOutletMapping() only accepts arguments of type \entities\OnBoardRequestOutletMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestOutletMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestOutletMapping(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestOutletMapping');

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
            $this->addJoinObject($join, 'OnBoardRequestOutletMapping');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestOutletMapping relation OnBoardRequestOutletMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestOutletMappingQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestOutletMappingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestOutletMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestOutletMapping', '\entities\OnBoardRequestOutletMappingQuery');
    }

    /**
     * Use the OnBoardRequestOutletMapping relation OnBoardRequestOutletMapping object
     *
     * @param callable(\entities\OnBoardRequestOutletMappingQuery):\entities\OnBoardRequestOutletMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestOutletMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestOutletMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestOutletMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useExistsQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestOutletMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestOutletMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useExistsQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestOutletMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useInQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for a NOT IN query.
     *
     * @see useOnBoardRequestOutletMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestOutletMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useInQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            $this
                ->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $orders->getPricebookId(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\entities\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT IN query.
     *
     * @see useOrdersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletMapping object
     *
     * @param \entities\OutletMapping|ObjectCollection $outletMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletMapping($outletMapping, ?string $comparison = null)
    {
        if ($outletMapping instanceof \entities\OutletMapping) {
            $this
                ->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $outletMapping->getPricebookId(), $comparison);

            return $this;
        } elseif ($outletMapping instanceof ObjectCollection) {
            $this
                ->useOutletMappingQuery()
                ->filterByPrimaryKeys($outletMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletMapping() only accepts arguments of type \entities\OutletMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletMapping(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletMapping');

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
            $this->addJoinObject($join, 'OutletMapping');
        }

        return $this;
    }

    /**
     * Use the OutletMapping relation OutletMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletMappingQuery A secondary query class using the current class as primary query
     */
    public function useOutletMappingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletMapping', '\entities\OutletMappingQuery');
    }

    /**
     * Use the OutletMapping relation OutletMapping object
     *
     * @param callable(\entities\OutletMappingQuery):\entities\OutletMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletMappingQuery The inner query object of the EXISTS statement
     */
    public function useOutletMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useExistsQuery('OutletMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for a NOT EXISTS query.
     *
     * @see useOutletMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useExistsQuery('OutletMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletMappingQuery The inner query object of the IN statement
     */
    public function useInOutletMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useInQuery('OutletMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for a NOT IN query.
     *
     * @see useOutletMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useInQuery('OutletMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Pricebooklines object
     *
     * @param \entities\Pricebooklines|ObjectCollection $pricebooklines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebooklines($pricebooklines, ?string $comparison = null)
    {
        if ($pricebooklines instanceof \entities\Pricebooklines) {
            $this
                ->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $pricebooklines->getPricebookId(), $comparison);

            return $this;
        } elseif ($pricebooklines instanceof ObjectCollection) {
            $this
                ->usePricebooklinesQuery()
                ->filterByPrimaryKeys($pricebooklines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPricebooklines() only accepts arguments of type \entities\Pricebooklines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pricebooklines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPricebooklines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pricebooklines');

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
            $this->addJoinObject($join, 'Pricebooklines');
        }

        return $this;
    }

    /**
     * Use the Pricebooklines relation Pricebooklines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PricebooklinesQuery A secondary query class using the current class as primary query
     */
    public function usePricebooklinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPricebooklines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pricebooklines', '\entities\PricebooklinesQuery');
    }

    /**
     * Use the Pricebooklines relation Pricebooklines object
     *
     * @param callable(\entities\PricebooklinesQuery):\entities\PricebooklinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPricebooklinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePricebooklinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pricebooklines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PricebooklinesQuery The inner query object of the EXISTS statement
     */
    public function usePricebooklinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useExistsQuery('Pricebooklines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for a NOT EXISTS query.
     *
     * @see usePricebooklinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooklinesQuery The inner query object of the NOT EXISTS statement
     */
    public function usePricebooklinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useExistsQuery('Pricebooklines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PricebooklinesQuery The inner query object of the IN statement
     */
    public function useInPricebooklinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useInQuery('Pricebooklines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for a NOT IN query.
     *
     * @see usePricebooklinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooklinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInPricebooklinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useInQuery('Pricebooklines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPricebooks $pricebooks Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pricebooks = null)
    {
        if ($pricebooks) {
            $this->addUsingAlias(PricebooksTableMap::COL_PRICEBOOK_ID, $pricebooks->getPricebookId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pricebooks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PricebooksTableMap::clearInstancePool();
            PricebooksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PricebooksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PricebooksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PricebooksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

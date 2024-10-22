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
use entities\OutletAccountDetails as ChildOutletAccountDetails;
use entities\OutletAccountDetailsQuery as ChildOutletAccountDetailsQuery;
use entities\Map\OutletAccountDetailsTableMap;

/**
 * Base class that represents a query for the `outlet_account_details` table.
 *
 * @method     ChildOutletAccountDetailsQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletAccountDetailsQuery orderByOutletBankName($order = Criteria::ASC) Order by the outlet_bank_name column
 * @method     ChildOutletAccountDetailsQuery orderByOutletAccountNo($order = Criteria::ASC) Order by the outlet_account_no column
 * @method     ChildOutletAccountDetailsQuery orderByOutletPan($order = Criteria::ASC) Order by the outlet_pan column
 * @method     ChildOutletAccountDetailsQuery orderByOutletGst($order = Criteria::ASC) Order by the outlet_gst column
 * @method     ChildOutletAccountDetailsQuery orderByOutletCompanyName($order = Criteria::ASC) Order by the outlet_company_name column
 * @method     ChildOutletAccountDetailsQuery orderByOutletIntegrationCode($order = Criteria::ASC) Order by the outlet_integration_code column
 * @method     ChildOutletAccountDetailsQuery orderByOutletDefaultPricebook($order = Criteria::ASC) Order by the outlet_default_pricebook column
 * @method     ChildOutletAccountDetailsQuery orderByOutletDefaultCategory($order = Criteria::ASC) Order by the outlet_default_category column
 *
 * @method     ChildOutletAccountDetailsQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletAccountDetailsQuery groupByOutletBankName() Group by the outlet_bank_name column
 * @method     ChildOutletAccountDetailsQuery groupByOutletAccountNo() Group by the outlet_account_no column
 * @method     ChildOutletAccountDetailsQuery groupByOutletPan() Group by the outlet_pan column
 * @method     ChildOutletAccountDetailsQuery groupByOutletGst() Group by the outlet_gst column
 * @method     ChildOutletAccountDetailsQuery groupByOutletCompanyName() Group by the outlet_company_name column
 * @method     ChildOutletAccountDetailsQuery groupByOutletIntegrationCode() Group by the outlet_integration_code column
 * @method     ChildOutletAccountDetailsQuery groupByOutletDefaultPricebook() Group by the outlet_default_pricebook column
 * @method     ChildOutletAccountDetailsQuery groupByOutletDefaultCategory() Group by the outlet_default_category column
 *
 * @method     ChildOutletAccountDetailsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletAccountDetailsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletAccountDetailsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletAccountDetailsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletAccountDetailsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletAccountDetailsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletAccountDetailsQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletAccountDetailsQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletAccountDetailsQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletAccountDetailsQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletAccountDetailsQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletAccountDetailsQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletAccountDetailsQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     \entities\OutletsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletAccountDetails|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletAccountDetails matching the query
 * @method     ChildOutletAccountDetails findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletAccountDetails matching the query, or a new ChildOutletAccountDetails object populated from the query conditions when no match is found
 *
 * @method     ChildOutletAccountDetails|null findOneByOutletId(int $outlet_id) Return the first ChildOutletAccountDetails filtered by the outlet_id column
 * @method     ChildOutletAccountDetails|null findOneByOutletBankName(string $outlet_bank_name) Return the first ChildOutletAccountDetails filtered by the outlet_bank_name column
 * @method     ChildOutletAccountDetails|null findOneByOutletAccountNo(string $outlet_account_no) Return the first ChildOutletAccountDetails filtered by the outlet_account_no column
 * @method     ChildOutletAccountDetails|null findOneByOutletPan(string $outlet_pan) Return the first ChildOutletAccountDetails filtered by the outlet_pan column
 * @method     ChildOutletAccountDetails|null findOneByOutletGst(string $outlet_gst) Return the first ChildOutletAccountDetails filtered by the outlet_gst column
 * @method     ChildOutletAccountDetails|null findOneByOutletCompanyName(string $outlet_company_name) Return the first ChildOutletAccountDetails filtered by the outlet_company_name column
 * @method     ChildOutletAccountDetails|null findOneByOutletIntegrationCode(string $outlet_integration_code) Return the first ChildOutletAccountDetails filtered by the outlet_integration_code column
 * @method     ChildOutletAccountDetails|null findOneByOutletDefaultPricebook(int $outlet_default_pricebook) Return the first ChildOutletAccountDetails filtered by the outlet_default_pricebook column
 * @method     ChildOutletAccountDetails|null findOneByOutletDefaultCategory(string $outlet_default_category) Return the first ChildOutletAccountDetails filtered by the outlet_default_category column
 *
 * @method     ChildOutletAccountDetails requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletAccountDetails by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOne(?ConnectionInterface $con = null) Return the first ChildOutletAccountDetails matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAccountDetails requireOneByOutletId(int $outlet_id) Return the first ChildOutletAccountDetails filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletBankName(string $outlet_bank_name) Return the first ChildOutletAccountDetails filtered by the outlet_bank_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletAccountNo(string $outlet_account_no) Return the first ChildOutletAccountDetails filtered by the outlet_account_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletPan(string $outlet_pan) Return the first ChildOutletAccountDetails filtered by the outlet_pan column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletGst(string $outlet_gst) Return the first ChildOutletAccountDetails filtered by the outlet_gst column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletCompanyName(string $outlet_company_name) Return the first ChildOutletAccountDetails filtered by the outlet_company_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletIntegrationCode(string $outlet_integration_code) Return the first ChildOutletAccountDetails filtered by the outlet_integration_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletDefaultPricebook(int $outlet_default_pricebook) Return the first ChildOutletAccountDetails filtered by the outlet_default_pricebook column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletAccountDetails requireOneByOutletDefaultCategory(string $outlet_default_category) Return the first ChildOutletAccountDetails filtered by the outlet_default_category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletAccountDetails[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletAccountDetails objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> find(?ConnectionInterface $con = null) Return ChildOutletAccountDetails objects based on current ModelCriteria
 *
 * @method     ChildOutletAccountDetails[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletAccountDetails objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletId(int|array<int> $outlet_id) Return ChildOutletAccountDetails objects filtered by the outlet_id column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletBankName(string|array<string> $outlet_bank_name) Return ChildOutletAccountDetails objects filtered by the outlet_bank_name column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletBankName(string|array<string> $outlet_bank_name) Return ChildOutletAccountDetails objects filtered by the outlet_bank_name column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletAccountNo(string|array<string> $outlet_account_no) Return ChildOutletAccountDetails objects filtered by the outlet_account_no column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletAccountNo(string|array<string> $outlet_account_no) Return ChildOutletAccountDetails objects filtered by the outlet_account_no column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletPan(string|array<string> $outlet_pan) Return ChildOutletAccountDetails objects filtered by the outlet_pan column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletPan(string|array<string> $outlet_pan) Return ChildOutletAccountDetails objects filtered by the outlet_pan column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletGst(string|array<string> $outlet_gst) Return ChildOutletAccountDetails objects filtered by the outlet_gst column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletGst(string|array<string> $outlet_gst) Return ChildOutletAccountDetails objects filtered by the outlet_gst column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletCompanyName(string|array<string> $outlet_company_name) Return ChildOutletAccountDetails objects filtered by the outlet_company_name column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletCompanyName(string|array<string> $outlet_company_name) Return ChildOutletAccountDetails objects filtered by the outlet_company_name column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletIntegrationCode(string|array<string> $outlet_integration_code) Return ChildOutletAccountDetails objects filtered by the outlet_integration_code column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletIntegrationCode(string|array<string> $outlet_integration_code) Return ChildOutletAccountDetails objects filtered by the outlet_integration_code column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletDefaultPricebook(int|array<int> $outlet_default_pricebook) Return ChildOutletAccountDetails objects filtered by the outlet_default_pricebook column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletDefaultPricebook(int|array<int> $outlet_default_pricebook) Return ChildOutletAccountDetails objects filtered by the outlet_default_pricebook column
 * @method     ChildOutletAccountDetails[]|Collection findByOutletDefaultCategory(string|array<string> $outlet_default_category) Return ChildOutletAccountDetails objects filtered by the outlet_default_category column
 * @psalm-method Collection&\Traversable<ChildOutletAccountDetails> findByOutletDefaultCategory(string|array<string> $outlet_default_category) Return ChildOutletAccountDetails objects filtered by the outlet_default_category column
 *
 * @method     ChildOutletAccountDetails[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletAccountDetails> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletAccountDetailsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletAccountDetailsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletAccountDetails', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletAccountDetailsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletAccountDetailsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletAccountDetailsQuery) {
            return $criteria;
        }
        $query = new ChildOutletAccountDetailsQuery();
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
     * @return ChildOutletAccountDetails|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletAccountDetailsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletAccountDetailsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletAccountDetails A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_id, outlet_bank_name, outlet_account_no, outlet_pan, outlet_gst, outlet_company_name, outlet_integration_code, outlet_default_pricebook, outlet_default_category FROM outlet_account_details WHERE outlet_id = :p0';
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
            /** @var ChildOutletAccountDetails $obj */
            $obj = new ChildOutletAccountDetails();
            $obj->hydrate($row);
            OutletAccountDetailsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletAccountDetails|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_bank_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletBankName('fooValue');   // WHERE outlet_bank_name = 'fooValue'
     * $query->filterByOutletBankName('%fooValue%', Criteria::LIKE); // WHERE outlet_bank_name LIKE '%fooValue%'
     * $query->filterByOutletBankName(['foo', 'bar']); // WHERE outlet_bank_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletBankName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletBankName($outletBankName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletBankName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_BANK_NAME, $outletBankName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_account_no column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAccountNo('fooValue');   // WHERE outlet_account_no = 'fooValue'
     * $query->filterByOutletAccountNo('%fooValue%', Criteria::LIKE); // WHERE outlet_account_no LIKE '%fooValue%'
     * $query->filterByOutletAccountNo(['foo', 'bar']); // WHERE outlet_account_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletAccountNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAccountNo($outletAccountNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletAccountNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ACCOUNT_NO, $outletAccountNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_pan column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletPan('fooValue');   // WHERE outlet_pan = 'fooValue'
     * $query->filterByOutletPan('%fooValue%', Criteria::LIKE); // WHERE outlet_pan LIKE '%fooValue%'
     * $query->filterByOutletPan(['foo', 'bar']); // WHERE outlet_pan IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletPan The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletPan($outletPan = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletPan)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_PAN, $outletPan, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_gst column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletGst('fooValue');   // WHERE outlet_gst = 'fooValue'
     * $query->filterByOutletGst('%fooValue%', Criteria::LIKE); // WHERE outlet_gst LIKE '%fooValue%'
     * $query->filterByOutletGst(['foo', 'bar']); // WHERE outlet_gst IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletGst The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletGst($outletGst = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletGst)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_GST, $outletGst, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_company_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCompanyName('fooValue');   // WHERE outlet_company_name = 'fooValue'
     * $query->filterByOutletCompanyName('%fooValue%', Criteria::LIKE); // WHERE outlet_company_name LIKE '%fooValue%'
     * $query->filterByOutletCompanyName(['foo', 'bar']); // WHERE outlet_company_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCompanyName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCompanyName($outletCompanyName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCompanyName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_COMPANY_NAME, $outletCompanyName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_integration_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletIntegrationCode('fooValue');   // WHERE outlet_integration_code = 'fooValue'
     * $query->filterByOutletIntegrationCode('%fooValue%', Criteria::LIKE); // WHERE outlet_integration_code LIKE '%fooValue%'
     * $query->filterByOutletIntegrationCode(['foo', 'bar']); // WHERE outlet_integration_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletIntegrationCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletIntegrationCode($outletIntegrationCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletIntegrationCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_INTEGRATION_CODE, $outletIntegrationCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_default_pricebook column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletDefaultPricebook(1234); // WHERE outlet_default_pricebook = 1234
     * $query->filterByOutletDefaultPricebook(array(12, 34)); // WHERE outlet_default_pricebook IN (12, 34)
     * $query->filterByOutletDefaultPricebook(array('min' => 12)); // WHERE outlet_default_pricebook > 12
     * </code>
     *
     * @param mixed $outletDefaultPricebook The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletDefaultPricebook($outletDefaultPricebook = null, ?string $comparison = null)
    {
        if (is_array($outletDefaultPricebook)) {
            $useMinMax = false;
            if (isset($outletDefaultPricebook['min'])) {
                $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK, $outletDefaultPricebook['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletDefaultPricebook['max'])) {
                $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK, $outletDefaultPricebook['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_PRICEBOOK, $outletDefaultPricebook, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_default_category column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletDefaultCategory('fooValue');   // WHERE outlet_default_category = 'fooValue'
     * $query->filterByOutletDefaultCategory('%fooValue%', Criteria::LIKE); // WHERE outlet_default_category LIKE '%fooValue%'
     * $query->filterByOutletDefaultCategory(['foo', 'bar']); // WHERE outlet_default_category IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletDefaultCategory The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletDefaultCategory($outletDefaultCategory = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletDefaultCategory)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_DEFAULT_CATEGORY, $outletDefaultCategory, $comparison);

        return $this;
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
                ->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildOutletAccountDetails $outletAccountDetails Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletAccountDetails = null)
    {
        if ($outletAccountDetails) {
            $this->addUsingAlias(OutletAccountDetailsTableMap::COL_OUTLET_ID, $outletAccountDetails->getOutletId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_account_details table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAccountDetailsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletAccountDetailsTableMap::clearInstancePool();
            OutletAccountDetailsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletAccountDetailsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletAccountDetailsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletAccountDetailsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletAccountDetailsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

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
use entities\TicketReplies as ChildTicketReplies;
use entities\TicketRepliesQuery as ChildTicketRepliesQuery;
use entities\Map\TicketRepliesTableMap;

/**
 * Base class that represents a query for the `ticket_replies` table.
 *
 * @method     ChildTicketRepliesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTicketRepliesQuery orderByTicketId($order = Criteria::ASC) Order by the ticket_id column
 * @method     ChildTicketRepliesQuery orderByTicketReplies($order = Criteria::ASC) Order by the ticket_replies column
 * @method     ChildTicketRepliesQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildTicketRepliesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTicketRepliesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTicketRepliesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildTicketRepliesQuery orderByAttachmentUrl($order = Criteria::ASC) Order by the attachment_url column
 *
 * @method     ChildTicketRepliesQuery groupById() Group by the id column
 * @method     ChildTicketRepliesQuery groupByTicketId() Group by the ticket_id column
 * @method     ChildTicketRepliesQuery groupByTicketReplies() Group by the ticket_replies column
 * @method     ChildTicketRepliesQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildTicketRepliesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTicketRepliesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTicketRepliesQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildTicketRepliesQuery groupByAttachmentUrl() Group by the attachment_url column
 *
 * @method     ChildTicketRepliesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTicketRepliesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTicketRepliesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTicketRepliesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTicketRepliesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTicketRepliesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTicketRepliesQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildTicketRepliesQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildTicketRepliesQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildTicketRepliesQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildTicketRepliesQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildTicketRepliesQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildTicketRepliesQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildTicketRepliesQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildTicketRepliesQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildTicketRepliesQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildTicketRepliesQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildTicketRepliesQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildTicketRepliesQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildTicketRepliesQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildTicketRepliesQuery leftJoinTickets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tickets relation
 * @method     ChildTicketRepliesQuery rightJoinTickets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tickets relation
 * @method     ChildTicketRepliesQuery innerJoinTickets($relationAlias = null) Adds a INNER JOIN clause to the query using the Tickets relation
 *
 * @method     ChildTicketRepliesQuery joinWithTickets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tickets relation
 *
 * @method     ChildTicketRepliesQuery leftJoinWithTickets() Adds a LEFT JOIN clause and with to the query using the Tickets relation
 * @method     ChildTicketRepliesQuery rightJoinWithTickets() Adds a RIGHT JOIN clause and with to the query using the Tickets relation
 * @method     ChildTicketRepliesQuery innerJoinWithTickets() Adds a INNER JOIN clause and with to the query using the Tickets relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\TicketsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTicketReplies|null findOne(?ConnectionInterface $con = null) Return the first ChildTicketReplies matching the query
 * @method     ChildTicketReplies findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTicketReplies matching the query, or a new ChildTicketReplies object populated from the query conditions when no match is found
 *
 * @method     ChildTicketReplies|null findOneById(int $id) Return the first ChildTicketReplies filtered by the id column
 * @method     ChildTicketReplies|null findOneByTicketId(int $ticket_id) Return the first ChildTicketReplies filtered by the ticket_id column
 * @method     ChildTicketReplies|null findOneByTicketReplies(string $ticket_replies) Return the first ChildTicketReplies filtered by the ticket_replies column
 * @method     ChildTicketReplies|null findOneByEmployeeId(int $employee_id) Return the first ChildTicketReplies filtered by the employee_id column
 * @method     ChildTicketReplies|null findOneByCompanyId(int $company_id) Return the first ChildTicketReplies filtered by the company_id column
 * @method     ChildTicketReplies|null findOneByCreatedAt(string $created_at) Return the first ChildTicketReplies filtered by the created_at column
 * @method     ChildTicketReplies|null findOneByUpdatedAt(string $updated_at) Return the first ChildTicketReplies filtered by the updated_at column
 * @method     ChildTicketReplies|null findOneByAttachmentUrl(string $attachment_url) Return the first ChildTicketReplies filtered by the attachment_url column
 *
 * @method     ChildTicketReplies requirePk($key, ?ConnectionInterface $con = null) Return the ChildTicketReplies by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOne(?ConnectionInterface $con = null) Return the first ChildTicketReplies matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTicketReplies requireOneById(int $id) Return the first ChildTicketReplies filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByTicketId(int $ticket_id) Return the first ChildTicketReplies filtered by the ticket_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByTicketReplies(string $ticket_replies) Return the first ChildTicketReplies filtered by the ticket_replies column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByEmployeeId(int $employee_id) Return the first ChildTicketReplies filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByCompanyId(int $company_id) Return the first ChildTicketReplies filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByCreatedAt(string $created_at) Return the first ChildTicketReplies filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByUpdatedAt(string $updated_at) Return the first ChildTicketReplies filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTicketReplies requireOneByAttachmentUrl(string $attachment_url) Return the first ChildTicketReplies filtered by the attachment_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTicketReplies[]|Collection find(?ConnectionInterface $con = null) Return ChildTicketReplies objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTicketReplies> find(?ConnectionInterface $con = null) Return ChildTicketReplies objects based on current ModelCriteria
 *
 * @method     ChildTicketReplies[]|Collection findById(int|array<int> $id) Return ChildTicketReplies objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findById(int|array<int> $id) Return ChildTicketReplies objects filtered by the id column
 * @method     ChildTicketReplies[]|Collection findByTicketId(int|array<int> $ticket_id) Return ChildTicketReplies objects filtered by the ticket_id column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByTicketId(int|array<int> $ticket_id) Return ChildTicketReplies objects filtered by the ticket_id column
 * @method     ChildTicketReplies[]|Collection findByTicketReplies(string|array<string> $ticket_replies) Return ChildTicketReplies objects filtered by the ticket_replies column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByTicketReplies(string|array<string> $ticket_replies) Return ChildTicketReplies objects filtered by the ticket_replies column
 * @method     ChildTicketReplies[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildTicketReplies objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByEmployeeId(int|array<int> $employee_id) Return ChildTicketReplies objects filtered by the employee_id column
 * @method     ChildTicketReplies[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTicketReplies objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByCompanyId(int|array<int> $company_id) Return ChildTicketReplies objects filtered by the company_id column
 * @method     ChildTicketReplies[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTicketReplies objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByCreatedAt(string|array<string> $created_at) Return ChildTicketReplies objects filtered by the created_at column
 * @method     ChildTicketReplies[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTicketReplies objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByUpdatedAt(string|array<string> $updated_at) Return ChildTicketReplies objects filtered by the updated_at column
 * @method     ChildTicketReplies[]|Collection findByAttachmentUrl(string|array<string> $attachment_url) Return ChildTicketReplies objects filtered by the attachment_url column
 * @psalm-method Collection&\Traversable<ChildTicketReplies> findByAttachmentUrl(string|array<string> $attachment_url) Return ChildTicketReplies objects filtered by the attachment_url column
 *
 * @method     ChildTicketReplies[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTicketReplies> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TicketRepliesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TicketRepliesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TicketReplies', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTicketRepliesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTicketRepliesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTicketRepliesQuery) {
            return $criteria;
        }
        $query = new ChildTicketRepliesQuery();
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
     * @return ChildTicketReplies|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TicketRepliesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TicketRepliesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTicketReplies A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, ticket_id, ticket_replies, employee_id, company_id, created_at, updated_at, attachment_url FROM ticket_replies WHERE id = :p0';
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
            /** @var ChildTicketReplies $obj */
            $obj = new ChildTicketReplies();
            $obj->hydrate($row);
            TicketRepliesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTicketReplies|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ticket_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTicketId(1234); // WHERE ticket_id = 1234
     * $query->filterByTicketId(array(12, 34)); // WHERE ticket_id IN (12, 34)
     * $query->filterByTicketId(array('min' => 12)); // WHERE ticket_id > 12
     * </code>
     *
     * @see       filterByTickets()
     *
     * @param mixed $ticketId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTicketId($ticketId = null, ?string $comparison = null)
    {
        if (is_array($ticketId)) {
            $useMinMax = false;
            if (isset($ticketId['min'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_TICKET_ID, $ticketId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ticketId['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_TICKET_ID, $ticketId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_TICKET_ID, $ticketId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ticket_replies column
     *
     * Example usage:
     * <code>
     * $query->filterByTicketReplies('fooValue');   // WHERE ticket_replies = 'fooValue'
     * $query->filterByTicketReplies('%fooValue%', Criteria::LIKE); // WHERE ticket_replies LIKE '%fooValue%'
     * $query->filterByTicketReplies(['foo', 'bar']); // WHERE ticket_replies IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ticketReplies The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTicketReplies($ticketReplies = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ticketReplies)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_TICKET_REPLIES, $ticketReplies, $comparison);

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
                $this->addUsingAlias(TicketRepliesTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(TicketRepliesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(TicketRepliesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TicketRepliesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TicketRepliesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the attachment_url column
     *
     * Example usage:
     * <code>
     * $query->filterByAttachmentUrl('fooValue');   // WHERE attachment_url = 'fooValue'
     * $query->filterByAttachmentUrl('%fooValue%', Criteria::LIKE); // WHERE attachment_url LIKE '%fooValue%'
     * $query->filterByAttachmentUrl(['foo', 'bar']); // WHERE attachment_url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $attachmentUrl The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttachmentUrl($attachmentUrl = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($attachmentUrl)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TicketRepliesTableMap::COL_ATTACHMENT_URL, $attachmentUrl, $comparison);

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
                ->addUsingAlias(TicketRepliesTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TicketRepliesTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(TicketRepliesTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TicketRepliesTableMap::COL_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * Filter the query by a related \entities\Tickets object
     *
     * @param \entities\Tickets|ObjectCollection $tickets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTickets($tickets, ?string $comparison = null)
    {
        if ($tickets instanceof \entities\Tickets) {
            return $this
                ->addUsingAlias(TicketRepliesTableMap::COL_TICKET_ID, $tickets->getId(), $comparison);
        } elseif ($tickets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TicketRepliesTableMap::COL_TICKET_ID, $tickets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTickets() only accepts arguments of type \entities\Tickets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tickets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTickets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tickets');

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
            $this->addJoinObject($join, 'Tickets');
        }

        return $this;
    }

    /**
     * Use the Tickets relation Tickets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketsQuery A secondary query class using the current class as primary query
     */
    public function useTicketsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTickets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tickets', '\entities\TicketsQuery');
    }

    /**
     * Use the Tickets relation Tickets object
     *
     * @param callable(\entities\TicketsQuery):\entities\TicketsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTicketsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tickets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketsQuery The inner query object of the EXISTS statement
     */
    public function useTicketsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('Tickets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tickets table for a NOT EXISTS query.
     *
     * @see useTicketsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('Tickets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tickets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketsQuery The inner query object of the IN statement
     */
    public function useInTicketsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('Tickets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tickets table for a NOT IN query.
     *
     * @see useTicketsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('Tickets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTicketReplies $ticketReplies Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($ticketReplies = null)
    {
        if ($ticketReplies) {
            $this->addUsingAlias(TicketRepliesTableMap::COL_ID, $ticketReplies->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ticket_replies table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TicketRepliesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TicketRepliesTableMap::clearInstancePool();
            TicketRepliesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TicketRepliesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TicketRepliesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TicketRepliesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TicketRepliesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

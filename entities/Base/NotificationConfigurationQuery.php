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
use entities\NotificationConfiguration as ChildNotificationConfiguration;
use entities\NotificationConfigurationQuery as ChildNotificationConfigurationQuery;
use entities\Map\NotificationConfigurationTableMap;

/**
 * Base class that represents a query for the `notification_configuration` table.
 *
 * @method     ChildNotificationConfigurationQuery orderByNotificationConfigurationId($order = Criteria::ASC) Order by the notification_configuration_id column
 * @method     ChildNotificationConfigurationQuery orderByNotificationType($order = Criteria::ASC) Order by the notification_type column
 * @method     ChildNotificationConfigurationQuery orderByIsEnabled($order = Criteria::ASC) Order by the is_enabled column
 * @method     ChildNotificationConfigurationQuery orderByNotificationTime($order = Criteria::ASC) Order by the notification_time column
 * @method     ChildNotificationConfigurationQuery orderByNotificationSubject($order = Criteria::ASC) Order by the notification_subject column
 * @method     ChildNotificationConfigurationQuery orderByNotificationMessage($order = Criteria::ASC) Order by the notification_message column
 * @method     ChildNotificationConfigurationQuery orderByRedirectScreen($order = Criteria::ASC) Order by the redirect_screen column
 * @method     ChildNotificationConfigurationQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildNotificationConfigurationQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildNotificationConfigurationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNotificationConfigurationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildNotificationConfigurationQuery groupByNotificationConfigurationId() Group by the notification_configuration_id column
 * @method     ChildNotificationConfigurationQuery groupByNotificationType() Group by the notification_type column
 * @method     ChildNotificationConfigurationQuery groupByIsEnabled() Group by the is_enabled column
 * @method     ChildNotificationConfigurationQuery groupByNotificationTime() Group by the notification_time column
 * @method     ChildNotificationConfigurationQuery groupByNotificationSubject() Group by the notification_subject column
 * @method     ChildNotificationConfigurationQuery groupByNotificationMessage() Group by the notification_message column
 * @method     ChildNotificationConfigurationQuery groupByRedirectScreen() Group by the redirect_screen column
 * @method     ChildNotificationConfigurationQuery groupByDesignation() Group by the designation column
 * @method     ChildNotificationConfigurationQuery groupByCompanyId() Group by the company_id column
 * @method     ChildNotificationConfigurationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNotificationConfigurationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildNotificationConfigurationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationConfigurationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationConfigurationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotificationConfigurationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNotificationConfigurationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNotificationConfigurationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNotificationConfigurationQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildNotificationConfigurationQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildNotificationConfigurationQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildNotificationConfigurationQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildNotificationConfigurationQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildNotificationConfigurationQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildNotificationConfigurationQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     \entities\CompanyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNotificationConfiguration|null findOne(?ConnectionInterface $con = null) Return the first ChildNotificationConfiguration matching the query
 * @method     ChildNotificationConfiguration findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNotificationConfiguration matching the query, or a new ChildNotificationConfiguration object populated from the query conditions when no match is found
 *
 * @method     ChildNotificationConfiguration|null findOneByNotificationConfigurationId(int $notification_configuration_id) Return the first ChildNotificationConfiguration filtered by the notification_configuration_id column
 * @method     ChildNotificationConfiguration|null findOneByNotificationType(string $notification_type) Return the first ChildNotificationConfiguration filtered by the notification_type column
 * @method     ChildNotificationConfiguration|null findOneByIsEnabled(boolean $is_enabled) Return the first ChildNotificationConfiguration filtered by the is_enabled column
 * @method     ChildNotificationConfiguration|null findOneByNotificationTime(string $notification_time) Return the first ChildNotificationConfiguration filtered by the notification_time column
 * @method     ChildNotificationConfiguration|null findOneByNotificationSubject(string $notification_subject) Return the first ChildNotificationConfiguration filtered by the notification_subject column
 * @method     ChildNotificationConfiguration|null findOneByNotificationMessage(string $notification_message) Return the first ChildNotificationConfiguration filtered by the notification_message column
 * @method     ChildNotificationConfiguration|null findOneByRedirectScreen(string $redirect_screen) Return the first ChildNotificationConfiguration filtered by the redirect_screen column
 * @method     ChildNotificationConfiguration|null findOneByDesignation(string $designation) Return the first ChildNotificationConfiguration filtered by the designation column
 * @method     ChildNotificationConfiguration|null findOneByCompanyId(int $company_id) Return the first ChildNotificationConfiguration filtered by the company_id column
 * @method     ChildNotificationConfiguration|null findOneByCreatedAt(string $created_at) Return the first ChildNotificationConfiguration filtered by the created_at column
 * @method     ChildNotificationConfiguration|null findOneByUpdatedAt(string $updated_at) Return the first ChildNotificationConfiguration filtered by the updated_at column
 *
 * @method     ChildNotificationConfiguration requirePk($key, ?ConnectionInterface $con = null) Return the ChildNotificationConfiguration by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOne(?ConnectionInterface $con = null) Return the first ChildNotificationConfiguration matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationConfiguration requireOneByNotificationConfigurationId(int $notification_configuration_id) Return the first ChildNotificationConfiguration filtered by the notification_configuration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByNotificationType(string $notification_type) Return the first ChildNotificationConfiguration filtered by the notification_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByIsEnabled(boolean $is_enabled) Return the first ChildNotificationConfiguration filtered by the is_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByNotificationTime(string $notification_time) Return the first ChildNotificationConfiguration filtered by the notification_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByNotificationSubject(string $notification_subject) Return the first ChildNotificationConfiguration filtered by the notification_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByNotificationMessage(string $notification_message) Return the first ChildNotificationConfiguration filtered by the notification_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByRedirectScreen(string $redirect_screen) Return the first ChildNotificationConfiguration filtered by the redirect_screen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByDesignation(string $designation) Return the first ChildNotificationConfiguration filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByCompanyId(int $company_id) Return the first ChildNotificationConfiguration filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByCreatedAt(string $created_at) Return the first ChildNotificationConfiguration filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationConfiguration requireOneByUpdatedAt(string $updated_at) Return the first ChildNotificationConfiguration filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationConfiguration[]|Collection find(?ConnectionInterface $con = null) Return ChildNotificationConfiguration objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> find(?ConnectionInterface $con = null) Return ChildNotificationConfiguration objects based on current ModelCriteria
 *
 * @method     ChildNotificationConfiguration[]|Collection findByNotificationConfigurationId(int|array<int> $notification_configuration_id) Return ChildNotificationConfiguration objects filtered by the notification_configuration_id column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByNotificationConfigurationId(int|array<int> $notification_configuration_id) Return ChildNotificationConfiguration objects filtered by the notification_configuration_id column
 * @method     ChildNotificationConfiguration[]|Collection findByNotificationType(string|array<string> $notification_type) Return ChildNotificationConfiguration objects filtered by the notification_type column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByNotificationType(string|array<string> $notification_type) Return ChildNotificationConfiguration objects filtered by the notification_type column
 * @method     ChildNotificationConfiguration[]|Collection findByIsEnabled(boolean|array<boolean> $is_enabled) Return ChildNotificationConfiguration objects filtered by the is_enabled column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByIsEnabled(boolean|array<boolean> $is_enabled) Return ChildNotificationConfiguration objects filtered by the is_enabled column
 * @method     ChildNotificationConfiguration[]|Collection findByNotificationTime(string|array<string> $notification_time) Return ChildNotificationConfiguration objects filtered by the notification_time column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByNotificationTime(string|array<string> $notification_time) Return ChildNotificationConfiguration objects filtered by the notification_time column
 * @method     ChildNotificationConfiguration[]|Collection findByNotificationSubject(string|array<string> $notification_subject) Return ChildNotificationConfiguration objects filtered by the notification_subject column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByNotificationSubject(string|array<string> $notification_subject) Return ChildNotificationConfiguration objects filtered by the notification_subject column
 * @method     ChildNotificationConfiguration[]|Collection findByNotificationMessage(string|array<string> $notification_message) Return ChildNotificationConfiguration objects filtered by the notification_message column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByNotificationMessage(string|array<string> $notification_message) Return ChildNotificationConfiguration objects filtered by the notification_message column
 * @method     ChildNotificationConfiguration[]|Collection findByRedirectScreen(string|array<string> $redirect_screen) Return ChildNotificationConfiguration objects filtered by the redirect_screen column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByRedirectScreen(string|array<string> $redirect_screen) Return ChildNotificationConfiguration objects filtered by the redirect_screen column
 * @method     ChildNotificationConfiguration[]|Collection findByDesignation(string|array<string> $designation) Return ChildNotificationConfiguration objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByDesignation(string|array<string> $designation) Return ChildNotificationConfiguration objects filtered by the designation column
 * @method     ChildNotificationConfiguration[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildNotificationConfiguration objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByCompanyId(int|array<int> $company_id) Return ChildNotificationConfiguration objects filtered by the company_id column
 * @method     ChildNotificationConfiguration[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildNotificationConfiguration objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByCreatedAt(string|array<string> $created_at) Return ChildNotificationConfiguration objects filtered by the created_at column
 * @method     ChildNotificationConfiguration[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildNotificationConfiguration objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildNotificationConfiguration> findByUpdatedAt(string|array<string> $updated_at) Return ChildNotificationConfiguration objects filtered by the updated_at column
 *
 * @method     ChildNotificationConfiguration[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNotificationConfiguration> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NotificationConfigurationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\NotificationConfigurationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\NotificationConfiguration', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationConfigurationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationConfigurationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNotificationConfigurationQuery) {
            return $criteria;
        }
        $query = new ChildNotificationConfigurationQuery();
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
     * @return ChildNotificationConfiguration|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationConfigurationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NotificationConfigurationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNotificationConfiguration A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT notification_configuration_id, notification_type, is_enabled, notification_time, notification_subject, notification_message, redirect_screen, designation, company_id, created_at, updated_at FROM notification_configuration WHERE notification_configuration_id = :p0';
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
            /** @var ChildNotificationConfiguration $obj */
            $obj = new ChildNotificationConfiguration();
            $obj->hydrate($row);
            NotificationConfigurationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNotificationConfiguration|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the notification_configuration_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationConfigurationId(1234); // WHERE notification_configuration_id = 1234
     * $query->filterByNotificationConfigurationId(array(12, 34)); // WHERE notification_configuration_id IN (12, 34)
     * $query->filterByNotificationConfigurationId(array('min' => 12)); // WHERE notification_configuration_id > 12
     * </code>
     *
     * @param mixed $notificationConfigurationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationConfigurationId($notificationConfigurationId = null, ?string $comparison = null)
    {
        if (is_array($notificationConfigurationId)) {
            $useMinMax = false;
            if (isset($notificationConfigurationId['min'])) {
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $notificationConfigurationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notificationConfigurationId['max'])) {
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $notificationConfigurationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $notificationConfigurationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notification_type column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationType('fooValue');   // WHERE notification_type = 'fooValue'
     * $query->filterByNotificationType('%fooValue%', Criteria::LIKE); // WHERE notification_type LIKE '%fooValue%'
     * $query->filterByNotificationType(['foo', 'bar']); // WHERE notification_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notificationType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationType($notificationType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notificationType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE, $notificationType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsEnabled(true); // WHERE is_enabled = true
     * $query->filterByIsEnabled('yes'); // WHERE is_enabled = true
     * </code>
     *
     * @param bool|string $isEnabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsEnabled($isEnabled = null, ?string $comparison = null)
    {
        if (is_string($isEnabled)) {
            $isEnabled = in_array(strtolower($isEnabled), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_IS_ENABLED, $isEnabled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notification_time column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationTime('fooValue');   // WHERE notification_time = 'fooValue'
     * $query->filterByNotificationTime('%fooValue%', Criteria::LIKE); // WHERE notification_time LIKE '%fooValue%'
     * $query->filterByNotificationTime(['foo', 'bar']); // WHERE notification_time IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notificationTime The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationTime($notificationTime = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notificationTime)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_TIME, $notificationTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notification_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationSubject('fooValue');   // WHERE notification_subject = 'fooValue'
     * $query->filterByNotificationSubject('%fooValue%', Criteria::LIKE); // WHERE notification_subject LIKE '%fooValue%'
     * $query->filterByNotificationSubject(['foo', 'bar']); // WHERE notification_subject IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notificationSubject The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationSubject($notificationSubject = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notificationSubject)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT, $notificationSubject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the notification_message column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationMessage('fooValue');   // WHERE notification_message = 'fooValue'
     * $query->filterByNotificationMessage('%fooValue%', Criteria::LIKE); // WHERE notification_message LIKE '%fooValue%'
     * $query->filterByNotificationMessage(['foo', 'bar']); // WHERE notification_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $notificationMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationMessage($notificationMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notificationMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE, $notificationMessage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the redirect_screen column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectScreen('fooValue');   // WHERE redirect_screen = 'fooValue'
     * $query->filterByRedirectScreen('%fooValue%', Criteria::LIKE); // WHERE redirect_screen LIKE '%fooValue%'
     * $query->filterByRedirectScreen(['foo', 'bar']); // WHERE redirect_screen IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $redirectScreen The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRedirectScreen($redirectScreen = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($redirectScreen)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_REDIRECT_SCREEN, $redirectScreen, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignation('fooValue');   // WHERE designation = 'fooValue'
     * $query->filterByDesignation('%fooValue%', Criteria::LIKE); // WHERE designation LIKE '%fooValue%'
     * $query->filterByDesignation(['foo', 'bar']); // WHERE designation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignation($designation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_DESIGNATION, $designation, $comparison);

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
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NotificationConfigurationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationConfigurationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(NotificationConfigurationTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(NotificationConfigurationTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildNotificationConfiguration $notificationConfiguration Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($notificationConfiguration = null)
    {
        if ($notificationConfiguration) {
            $this->addUsingAlias(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, $notificationConfiguration->getNotificationConfigurationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notification_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationConfigurationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationConfigurationTableMap::clearInstancePool();
            NotificationConfigurationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationConfigurationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationConfigurationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationConfigurationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationConfigurationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

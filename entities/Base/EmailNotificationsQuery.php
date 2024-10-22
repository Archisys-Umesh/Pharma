<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\EmailNotifications as ChildEmailNotifications;
use entities\EmailNotificationsQuery as ChildEmailNotificationsQuery;
use entities\Map\EmailNotificationsTableMap;

/**
 * Base class that represents a query for the `email_notifications` table.
 *
 * @method     ChildEmailNotificationsQuery orderByEmailNotificationId($order = Criteria::ASC) Order by the email_notification_id column
 * @method     ChildEmailNotificationsQuery orderByToEmails($order = Criteria::ASC) Order by the to_emails column
 * @method     ChildEmailNotificationsQuery orderByCcEmails($order = Criteria::ASC) Order by the cc_emails column
 * @method     ChildEmailNotificationsQuery orderByBccEmails($order = Criteria::ASC) Order by the bcc_emails column
 * @method     ChildEmailNotificationsQuery orderByEmailSubject($order = Criteria::ASC) Order by the email_subject column
 * @method     ChildEmailNotificationsQuery orderByEmailBody($order = Criteria::ASC) Order by the email_body column
 * @method     ChildEmailNotificationsQuery orderByScheduleAt($order = Criteria::ASC) Order by the schedule_at column
 * @method     ChildEmailNotificationsQuery orderByEmailSentDatetime($order = Criteria::ASC) Order by the email_sent_datetime column
 * @method     ChildEmailNotificationsQuery orderByEmailSentStatus($order = Criteria::ASC) Order by the email_sent_status column
 * @method     ChildEmailNotificationsQuery orderByEmailTransId($order = Criteria::ASC) Order by the email_trans_id column
 * @method     ChildEmailNotificationsQuery orderByEmailSentAttempts($order = Criteria::ASC) Order by the email_sent_attempts column
 * @method     ChildEmailNotificationsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEmailNotificationsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEmailNotificationsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEmailNotificationsQuery orderByEmailConstants($order = Criteria::ASC) Order by the email_constants column
 * @method     ChildEmailNotificationsQuery orderByEmailType($order = Criteria::ASC) Order by the email_type column
 *
 * @method     ChildEmailNotificationsQuery groupByEmailNotificationId() Group by the email_notification_id column
 * @method     ChildEmailNotificationsQuery groupByToEmails() Group by the to_emails column
 * @method     ChildEmailNotificationsQuery groupByCcEmails() Group by the cc_emails column
 * @method     ChildEmailNotificationsQuery groupByBccEmails() Group by the bcc_emails column
 * @method     ChildEmailNotificationsQuery groupByEmailSubject() Group by the email_subject column
 * @method     ChildEmailNotificationsQuery groupByEmailBody() Group by the email_body column
 * @method     ChildEmailNotificationsQuery groupByScheduleAt() Group by the schedule_at column
 * @method     ChildEmailNotificationsQuery groupByEmailSentDatetime() Group by the email_sent_datetime column
 * @method     ChildEmailNotificationsQuery groupByEmailSentStatus() Group by the email_sent_status column
 * @method     ChildEmailNotificationsQuery groupByEmailTransId() Group by the email_trans_id column
 * @method     ChildEmailNotificationsQuery groupByEmailSentAttempts() Group by the email_sent_attempts column
 * @method     ChildEmailNotificationsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEmailNotificationsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEmailNotificationsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEmailNotificationsQuery groupByEmailConstants() Group by the email_constants column
 * @method     ChildEmailNotificationsQuery groupByEmailType() Group by the email_type column
 *
 * @method     ChildEmailNotificationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmailNotificationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmailNotificationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmailNotificationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmailNotificationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmailNotificationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmailNotifications|null findOne(?ConnectionInterface $con = null) Return the first ChildEmailNotifications matching the query
 * @method     ChildEmailNotifications findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmailNotifications matching the query, or a new ChildEmailNotifications object populated from the query conditions when no match is found
 *
 * @method     ChildEmailNotifications|null findOneByEmailNotificationId(int $email_notification_id) Return the first ChildEmailNotifications filtered by the email_notification_id column
 * @method     ChildEmailNotifications|null findOneByToEmails(string $to_emails) Return the first ChildEmailNotifications filtered by the to_emails column
 * @method     ChildEmailNotifications|null findOneByCcEmails(string $cc_emails) Return the first ChildEmailNotifications filtered by the cc_emails column
 * @method     ChildEmailNotifications|null findOneByBccEmails(string $bcc_emails) Return the first ChildEmailNotifications filtered by the bcc_emails column
 * @method     ChildEmailNotifications|null findOneByEmailSubject(string $email_subject) Return the first ChildEmailNotifications filtered by the email_subject column
 * @method     ChildEmailNotifications|null findOneByEmailBody(string $email_body) Return the first ChildEmailNotifications filtered by the email_body column
 * @method     ChildEmailNotifications|null findOneByScheduleAt(string $schedule_at) Return the first ChildEmailNotifications filtered by the schedule_at column
 * @method     ChildEmailNotifications|null findOneByEmailSentDatetime(string $email_sent_datetime) Return the first ChildEmailNotifications filtered by the email_sent_datetime column
 * @method     ChildEmailNotifications|null findOneByEmailSentStatus(boolean $email_sent_status) Return the first ChildEmailNotifications filtered by the email_sent_status column
 * @method     ChildEmailNotifications|null findOneByEmailTransId(string $email_trans_id) Return the first ChildEmailNotifications filtered by the email_trans_id column
 * @method     ChildEmailNotifications|null findOneByEmailSentAttempts(int $email_sent_attempts) Return the first ChildEmailNotifications filtered by the email_sent_attempts column
 * @method     ChildEmailNotifications|null findOneByCompanyId(int $company_id) Return the first ChildEmailNotifications filtered by the company_id column
 * @method     ChildEmailNotifications|null findOneByCreatedAt(string $created_at) Return the first ChildEmailNotifications filtered by the created_at column
 * @method     ChildEmailNotifications|null findOneByUpdatedAt(string $updated_at) Return the first ChildEmailNotifications filtered by the updated_at column
 * @method     ChildEmailNotifications|null findOneByEmailConstants(string $email_constants) Return the first ChildEmailNotifications filtered by the email_constants column
 * @method     ChildEmailNotifications|null findOneByEmailType(string $email_type) Return the first ChildEmailNotifications filtered by the email_type column
 *
 * @method     ChildEmailNotifications requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmailNotifications by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOne(?ConnectionInterface $con = null) Return the first ChildEmailNotifications matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailNotifications requireOneByEmailNotificationId(int $email_notification_id) Return the first ChildEmailNotifications filtered by the email_notification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByToEmails(string $to_emails) Return the first ChildEmailNotifications filtered by the to_emails column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByCcEmails(string $cc_emails) Return the first ChildEmailNotifications filtered by the cc_emails column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByBccEmails(string $bcc_emails) Return the first ChildEmailNotifications filtered by the bcc_emails column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailSubject(string $email_subject) Return the first ChildEmailNotifications filtered by the email_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailBody(string $email_body) Return the first ChildEmailNotifications filtered by the email_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByScheduleAt(string $schedule_at) Return the first ChildEmailNotifications filtered by the schedule_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailSentDatetime(string $email_sent_datetime) Return the first ChildEmailNotifications filtered by the email_sent_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailSentStatus(boolean $email_sent_status) Return the first ChildEmailNotifications filtered by the email_sent_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailTransId(string $email_trans_id) Return the first ChildEmailNotifications filtered by the email_trans_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailSentAttempts(int $email_sent_attempts) Return the first ChildEmailNotifications filtered by the email_sent_attempts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByCompanyId(int $company_id) Return the first ChildEmailNotifications filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByCreatedAt(string $created_at) Return the first ChildEmailNotifications filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByUpdatedAt(string $updated_at) Return the first ChildEmailNotifications filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailConstants(string $email_constants) Return the first ChildEmailNotifications filtered by the email_constants column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailNotifications requireOneByEmailType(string $email_type) Return the first ChildEmailNotifications filtered by the email_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailNotifications[]|Collection find(?ConnectionInterface $con = null) Return ChildEmailNotifications objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> find(?ConnectionInterface $con = null) Return ChildEmailNotifications objects based on current ModelCriteria
 *
 * @method     ChildEmailNotifications[]|Collection findByEmailNotificationId(int|array<int> $email_notification_id) Return ChildEmailNotifications objects filtered by the email_notification_id column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailNotificationId(int|array<int> $email_notification_id) Return ChildEmailNotifications objects filtered by the email_notification_id column
 * @method     ChildEmailNotifications[]|Collection findByToEmails(string|array<string> $to_emails) Return ChildEmailNotifications objects filtered by the to_emails column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByToEmails(string|array<string> $to_emails) Return ChildEmailNotifications objects filtered by the to_emails column
 * @method     ChildEmailNotifications[]|Collection findByCcEmails(string|array<string> $cc_emails) Return ChildEmailNotifications objects filtered by the cc_emails column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByCcEmails(string|array<string> $cc_emails) Return ChildEmailNotifications objects filtered by the cc_emails column
 * @method     ChildEmailNotifications[]|Collection findByBccEmails(string|array<string> $bcc_emails) Return ChildEmailNotifications objects filtered by the bcc_emails column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByBccEmails(string|array<string> $bcc_emails) Return ChildEmailNotifications objects filtered by the bcc_emails column
 * @method     ChildEmailNotifications[]|Collection findByEmailSubject(string|array<string> $email_subject) Return ChildEmailNotifications objects filtered by the email_subject column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailSubject(string|array<string> $email_subject) Return ChildEmailNotifications objects filtered by the email_subject column
 * @method     ChildEmailNotifications[]|Collection findByEmailBody(string|array<string> $email_body) Return ChildEmailNotifications objects filtered by the email_body column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailBody(string|array<string> $email_body) Return ChildEmailNotifications objects filtered by the email_body column
 * @method     ChildEmailNotifications[]|Collection findByScheduleAt(string|array<string> $schedule_at) Return ChildEmailNotifications objects filtered by the schedule_at column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByScheduleAt(string|array<string> $schedule_at) Return ChildEmailNotifications objects filtered by the schedule_at column
 * @method     ChildEmailNotifications[]|Collection findByEmailSentDatetime(string|array<string> $email_sent_datetime) Return ChildEmailNotifications objects filtered by the email_sent_datetime column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailSentDatetime(string|array<string> $email_sent_datetime) Return ChildEmailNotifications objects filtered by the email_sent_datetime column
 * @method     ChildEmailNotifications[]|Collection findByEmailSentStatus(boolean|array<boolean> $email_sent_status) Return ChildEmailNotifications objects filtered by the email_sent_status column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailSentStatus(boolean|array<boolean> $email_sent_status) Return ChildEmailNotifications objects filtered by the email_sent_status column
 * @method     ChildEmailNotifications[]|Collection findByEmailTransId(string|array<string> $email_trans_id) Return ChildEmailNotifications objects filtered by the email_trans_id column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailTransId(string|array<string> $email_trans_id) Return ChildEmailNotifications objects filtered by the email_trans_id column
 * @method     ChildEmailNotifications[]|Collection findByEmailSentAttempts(int|array<int> $email_sent_attempts) Return ChildEmailNotifications objects filtered by the email_sent_attempts column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailSentAttempts(int|array<int> $email_sent_attempts) Return ChildEmailNotifications objects filtered by the email_sent_attempts column
 * @method     ChildEmailNotifications[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEmailNotifications objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByCompanyId(int|array<int> $company_id) Return ChildEmailNotifications objects filtered by the company_id column
 * @method     ChildEmailNotifications[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEmailNotifications objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByCreatedAt(string|array<string> $created_at) Return ChildEmailNotifications objects filtered by the created_at column
 * @method     ChildEmailNotifications[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEmailNotifications objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByUpdatedAt(string|array<string> $updated_at) Return ChildEmailNotifications objects filtered by the updated_at column
 * @method     ChildEmailNotifications[]|Collection findByEmailConstants(string|array<string> $email_constants) Return ChildEmailNotifications objects filtered by the email_constants column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailConstants(string|array<string> $email_constants) Return ChildEmailNotifications objects filtered by the email_constants column
 * @method     ChildEmailNotifications[]|Collection findByEmailType(string|array<string> $email_type) Return ChildEmailNotifications objects filtered by the email_type column
 * @psalm-method Collection&\Traversable<ChildEmailNotifications> findByEmailType(string|array<string> $email_type) Return ChildEmailNotifications objects filtered by the email_type column
 *
 * @method     ChildEmailNotifications[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmailNotifications> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmailNotificationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmailNotificationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmailNotifications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmailNotificationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmailNotificationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmailNotificationsQuery) {
            return $criteria;
        }
        $query = new ChildEmailNotificationsQuery();
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
     * @return ChildEmailNotifications|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmailNotificationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmailNotifications A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT email_notification_id, to_emails, cc_emails, bcc_emails, email_subject, email_body, schedule_at, email_sent_datetime, email_sent_status, email_trans_id, email_sent_attempts, company_id, created_at, updated_at, email_constants, email_type FROM email_notifications WHERE email_notification_id = :p0';
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
            /** @var ChildEmailNotifications $obj */
            $obj = new ChildEmailNotifications();
            $obj->hydrate($row);
            EmailNotificationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmailNotifications|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the email_notification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailNotificationId(1234); // WHERE email_notification_id = 1234
     * $query->filterByEmailNotificationId(array(12, 34)); // WHERE email_notification_id IN (12, 34)
     * $query->filterByEmailNotificationId(array('min' => 12)); // WHERE email_notification_id > 12
     * </code>
     *
     * @param mixed $emailNotificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailNotificationId($emailNotificationId = null, ?string $comparison = null)
    {
        if (is_array($emailNotificationId)) {
            $useMinMax = false;
            if (isset($emailNotificationId['min'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $emailNotificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailNotificationId['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $emailNotificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $emailNotificationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_emails column
     *
     * Example usage:
     * <code>
     * $query->filterByToEmails('fooValue');   // WHERE to_emails = 'fooValue'
     * $query->filterByToEmails('%fooValue%', Criteria::LIKE); // WHERE to_emails LIKE '%fooValue%'
     * $query->filterByToEmails(['foo', 'bar']); // WHERE to_emails IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $toEmails The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToEmails($toEmails = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toEmails)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_TO_EMAILS, $toEmails, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cc_emails column
     *
     * Example usage:
     * <code>
     * $query->filterByCcEmails('fooValue');   // WHERE cc_emails = 'fooValue'
     * $query->filterByCcEmails('%fooValue%', Criteria::LIKE); // WHERE cc_emails LIKE '%fooValue%'
     * $query->filterByCcEmails(['foo', 'bar']); // WHERE cc_emails IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ccEmails The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCcEmails($ccEmails = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ccEmails)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_CC_EMAILS, $ccEmails, $comparison);

        return $this;
    }

    /**
     * Filter the query on the bcc_emails column
     *
     * Example usage:
     * <code>
     * $query->filterByBccEmails('fooValue');   // WHERE bcc_emails = 'fooValue'
     * $query->filterByBccEmails('%fooValue%', Criteria::LIKE); // WHERE bcc_emails LIKE '%fooValue%'
     * $query->filterByBccEmails(['foo', 'bar']); // WHERE bcc_emails IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $bccEmails The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBccEmails($bccEmails = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bccEmails)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_BCC_EMAILS, $bccEmails, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailSubject('fooValue');   // WHERE email_subject = 'fooValue'
     * $query->filterByEmailSubject('%fooValue%', Criteria::LIKE); // WHERE email_subject LIKE '%fooValue%'
     * $query->filterByEmailSubject(['foo', 'bar']); // WHERE email_subject IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $emailSubject The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailSubject($emailSubject = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailSubject)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SUBJECT, $emailSubject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_body column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailBody('fooValue');   // WHERE email_body = 'fooValue'
     * $query->filterByEmailBody('%fooValue%', Criteria::LIKE); // WHERE email_body LIKE '%fooValue%'
     * $query->filterByEmailBody(['foo', 'bar']); // WHERE email_body IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $emailBody The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailBody($emailBody = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailBody)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_BODY, $emailBody, $comparison);

        return $this;
    }

    /**
     * Filter the query on the schedule_at column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduleAt('2011-03-14'); // WHERE schedule_at = '2011-03-14'
     * $query->filterByScheduleAt('now'); // WHERE schedule_at = '2011-03-14'
     * $query->filterByScheduleAt(array('max' => 'yesterday')); // WHERE schedule_at > '2011-03-13'
     * </code>
     *
     * @param mixed $scheduleAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByScheduleAt($scheduleAt = null, ?string $comparison = null)
    {
        if (is_array($scheduleAt)) {
            $useMinMax = false;
            if (isset($scheduleAt['min'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleAt['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_sent_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailSentDatetime('2011-03-14'); // WHERE email_sent_datetime = '2011-03-14'
     * $query->filterByEmailSentDatetime('now'); // WHERE email_sent_datetime = '2011-03-14'
     * $query->filterByEmailSentDatetime(array('max' => 'yesterday')); // WHERE email_sent_datetime > '2011-03-13'
     * </code>
     *
     * @param mixed $emailSentDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailSentDatetime($emailSentDatetime = null, ?string $comparison = null)
    {
        if (is_array($emailSentDatetime)) {
            $useMinMax = false;
            if (isset($emailSentDatetime['min'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailSentDatetime['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_sent_status column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailSentStatus(true); // WHERE email_sent_status = true
     * $query->filterByEmailSentStatus('yes'); // WHERE email_sent_status = true
     * </code>
     *
     * @param bool|string $emailSentStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailSentStatus($emailSentStatus = null, ?string $comparison = null)
    {
        if (is_string($emailSentStatus)) {
            $emailSentStatus = in_array(strtolower($emailSentStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS, $emailSentStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_trans_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailTransId('fooValue');   // WHERE email_trans_id = 'fooValue'
     * $query->filterByEmailTransId('%fooValue%', Criteria::LIKE); // WHERE email_trans_id LIKE '%fooValue%'
     * $query->filterByEmailTransId(['foo', 'bar']); // WHERE email_trans_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $emailTransId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailTransId($emailTransId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailTransId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID, $emailTransId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_sent_attempts column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailSentAttempts(1234); // WHERE email_sent_attempts = 1234
     * $query->filterByEmailSentAttempts(array(12, 34)); // WHERE email_sent_attempts IN (12, 34)
     * $query->filterByEmailSentAttempts(array('min' => 12)); // WHERE email_sent_attempts > 12
     * </code>
     *
     * @param mixed $emailSentAttempts The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailSentAttempts($emailSentAttempts = null, ?string $comparison = null)
    {
        if (is_array($emailSentAttempts)) {
            $useMinMax = false;
            if (isset($emailSentAttempts['min'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailSentAttempts['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts, $comparison);

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
                $this->addUsingAlias(EmailNotificationsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(EmailNotificationsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EmailNotificationsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EmailNotificationsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_constants column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailConstants('fooValue');   // WHERE email_constants = 'fooValue'
     * $query->filterByEmailConstants('%fooValue%', Criteria::LIKE); // WHERE email_constants LIKE '%fooValue%'
     * $query->filterByEmailConstants(['foo', 'bar']); // WHERE email_constants IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $emailConstants The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailConstants($emailConstants = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailConstants)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS, $emailConstants, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email_type column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailType('fooValue');   // WHERE email_type = 'fooValue'
     * $query->filterByEmailType('%fooValue%', Criteria::LIKE); // WHERE email_type LIKE '%fooValue%'
     * $query->filterByEmailType(['foo', 'bar']); // WHERE email_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $emailType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmailType($emailType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_TYPE, $emailType, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmailNotifications $emailNotifications Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($emailNotifications = null)
    {
        if ($emailNotifications) {
            $this->addUsingAlias(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $emailNotifications->getEmailNotificationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the email_notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmailNotificationsTableMap::clearInstancePool();
            EmailNotificationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmailNotificationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmailNotificationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmailNotificationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

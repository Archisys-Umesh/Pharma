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
use entities\Notifications as ChildNotifications;
use entities\NotificationsQuery as ChildNotificationsQuery;
use entities\Map\NotificationsTableMap;

/**
 * Base class that represents a query for the `notifications` table.
 *
 * @method     ChildNotificationsQuery orderByNotificationId($order = Criteria::ASC) Order by the notification_id column
 * @method     ChildNotificationsQuery orderByToEmployeeId($order = Criteria::ASC) Order by the to_employee_id column
 * @method     ChildNotificationsQuery orderByCcEmployeeIds($order = Criteria::ASC) Order by the cc_employee_ids column
 * @method     ChildNotificationsQuery orderByTemplateKey($order = Criteria::ASC) Order by the template_key column
 * @method     ChildNotificationsQuery orderByDataDump($order = Criteria::ASC) Order by the data_dump column
 * @method     ChildNotificationsQuery orderBySendEmail($order = Criteria::ASC) Order by the send_email column
 * @method     ChildNotificationsQuery orderBySendSms($order = Criteria::ASC) Order by the send_sms column
 * @method     ChildNotificationsQuery orderBySendPush($order = Criteria::ASC) Order by the send_push column
 * @method     ChildNotificationsQuery orderByEmailSentDatetime($order = Criteria::ASC) Order by the email_sent_datetime column
 * @method     ChildNotificationsQuery orderByEmailSentStatus($order = Criteria::ASC) Order by the email_sent_status column
 * @method     ChildNotificationsQuery orderByEmailTransId($order = Criteria::ASC) Order by the email_trans_id column
 * @method     ChildNotificationsQuery orderBySmsSentDatetime($order = Criteria::ASC) Order by the sms_sent_datetime column
 * @method     ChildNotificationsQuery orderBySmsSentStatus($order = Criteria::ASC) Order by the sms_sent_status column
 * @method     ChildNotificationsQuery orderBySmsTransId($order = Criteria::ASC) Order by the sms_trans_id column
 * @method     ChildNotificationsQuery orderByPushSentDatetime($order = Criteria::ASC) Order by the push_sent_datetime column
 * @method     ChildNotificationsQuery orderByPushSentStatus($order = Criteria::ASC) Order by the push_sent_status column
 * @method     ChildNotificationsQuery orderByPushTransId($order = Criteria::ASC) Order by the push_trans_id column
 * @method     ChildNotificationsQuery orderByScheduleAt($order = Criteria::ASC) Order by the schedule_at column
 * @method     ChildNotificationsQuery orderByEmailSentAttempts($order = Criteria::ASC) Order by the email_sent_attempts column
 * @method     ChildNotificationsQuery orderBySmsSentAttempts($order = Criteria::ASC) Order by the sms_sent_attempts column
 * @method     ChildNotificationsQuery orderByPushSentAttempts($order = Criteria::ASC) Order by the push_sent_attempts column
 * @method     ChildNotificationsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildNotificationsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNotificationsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildNotificationsQuery groupByNotificationId() Group by the notification_id column
 * @method     ChildNotificationsQuery groupByToEmployeeId() Group by the to_employee_id column
 * @method     ChildNotificationsQuery groupByCcEmployeeIds() Group by the cc_employee_ids column
 * @method     ChildNotificationsQuery groupByTemplateKey() Group by the template_key column
 * @method     ChildNotificationsQuery groupByDataDump() Group by the data_dump column
 * @method     ChildNotificationsQuery groupBySendEmail() Group by the send_email column
 * @method     ChildNotificationsQuery groupBySendSms() Group by the send_sms column
 * @method     ChildNotificationsQuery groupBySendPush() Group by the send_push column
 * @method     ChildNotificationsQuery groupByEmailSentDatetime() Group by the email_sent_datetime column
 * @method     ChildNotificationsQuery groupByEmailSentStatus() Group by the email_sent_status column
 * @method     ChildNotificationsQuery groupByEmailTransId() Group by the email_trans_id column
 * @method     ChildNotificationsQuery groupBySmsSentDatetime() Group by the sms_sent_datetime column
 * @method     ChildNotificationsQuery groupBySmsSentStatus() Group by the sms_sent_status column
 * @method     ChildNotificationsQuery groupBySmsTransId() Group by the sms_trans_id column
 * @method     ChildNotificationsQuery groupByPushSentDatetime() Group by the push_sent_datetime column
 * @method     ChildNotificationsQuery groupByPushSentStatus() Group by the push_sent_status column
 * @method     ChildNotificationsQuery groupByPushTransId() Group by the push_trans_id column
 * @method     ChildNotificationsQuery groupByScheduleAt() Group by the schedule_at column
 * @method     ChildNotificationsQuery groupByEmailSentAttempts() Group by the email_sent_attempts column
 * @method     ChildNotificationsQuery groupBySmsSentAttempts() Group by the sms_sent_attempts column
 * @method     ChildNotificationsQuery groupByPushSentAttempts() Group by the push_sent_attempts column
 * @method     ChildNotificationsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildNotificationsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNotificationsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildNotificationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotificationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNotificationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNotificationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNotifications|null findOne(?ConnectionInterface $con = null) Return the first ChildNotifications matching the query
 * @method     ChildNotifications findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNotifications matching the query, or a new ChildNotifications object populated from the query conditions when no match is found
 *
 * @method     ChildNotifications|null findOneByNotificationId(string $notification_id) Return the first ChildNotifications filtered by the notification_id column
 * @method     ChildNotifications|null findOneByToEmployeeId(int $to_employee_id) Return the first ChildNotifications filtered by the to_employee_id column
 * @method     ChildNotifications|null findOneByCcEmployeeIds(string $cc_employee_ids) Return the first ChildNotifications filtered by the cc_employee_ids column
 * @method     ChildNotifications|null findOneByTemplateKey(string $template_key) Return the first ChildNotifications filtered by the template_key column
 * @method     ChildNotifications|null findOneByDataDump(string $data_dump) Return the first ChildNotifications filtered by the data_dump column
 * @method     ChildNotifications|null findOneBySendEmail(boolean $send_email) Return the first ChildNotifications filtered by the send_email column
 * @method     ChildNotifications|null findOneBySendSms(boolean $send_sms) Return the first ChildNotifications filtered by the send_sms column
 * @method     ChildNotifications|null findOneBySendPush(boolean $send_push) Return the first ChildNotifications filtered by the send_push column
 * @method     ChildNotifications|null findOneByEmailSentDatetime(string $email_sent_datetime) Return the first ChildNotifications filtered by the email_sent_datetime column
 * @method     ChildNotifications|null findOneByEmailSentStatus(boolean $email_sent_status) Return the first ChildNotifications filtered by the email_sent_status column
 * @method     ChildNotifications|null findOneByEmailTransId(string $email_trans_id) Return the first ChildNotifications filtered by the email_trans_id column
 * @method     ChildNotifications|null findOneBySmsSentDatetime(string $sms_sent_datetime) Return the first ChildNotifications filtered by the sms_sent_datetime column
 * @method     ChildNotifications|null findOneBySmsSentStatus(boolean $sms_sent_status) Return the first ChildNotifications filtered by the sms_sent_status column
 * @method     ChildNotifications|null findOneBySmsTransId(string $sms_trans_id) Return the first ChildNotifications filtered by the sms_trans_id column
 * @method     ChildNotifications|null findOneByPushSentDatetime(string $push_sent_datetime) Return the first ChildNotifications filtered by the push_sent_datetime column
 * @method     ChildNotifications|null findOneByPushSentStatus(boolean $push_sent_status) Return the first ChildNotifications filtered by the push_sent_status column
 * @method     ChildNotifications|null findOneByPushTransId(string $push_trans_id) Return the first ChildNotifications filtered by the push_trans_id column
 * @method     ChildNotifications|null findOneByScheduleAt(string $schedule_at) Return the first ChildNotifications filtered by the schedule_at column
 * @method     ChildNotifications|null findOneByEmailSentAttempts(int $email_sent_attempts) Return the first ChildNotifications filtered by the email_sent_attempts column
 * @method     ChildNotifications|null findOneBySmsSentAttempts(int $sms_sent_attempts) Return the first ChildNotifications filtered by the sms_sent_attempts column
 * @method     ChildNotifications|null findOneByPushSentAttempts(int $push_sent_attempts) Return the first ChildNotifications filtered by the push_sent_attempts column
 * @method     ChildNotifications|null findOneByCompanyId(int $company_id) Return the first ChildNotifications filtered by the company_id column
 * @method     ChildNotifications|null findOneByCreatedAt(string $created_at) Return the first ChildNotifications filtered by the created_at column
 * @method     ChildNotifications|null findOneByUpdatedAt(string $updated_at) Return the first ChildNotifications filtered by the updated_at column
 *
 * @method     ChildNotifications requirePk($key, ?ConnectionInterface $con = null) Return the ChildNotifications by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOne(?ConnectionInterface $con = null) Return the first ChildNotifications matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications requireOneByNotificationId(string $notification_id) Return the first ChildNotifications filtered by the notification_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByToEmployeeId(int $to_employee_id) Return the first ChildNotifications filtered by the to_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByCcEmployeeIds(string $cc_employee_ids) Return the first ChildNotifications filtered by the cc_employee_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByTemplateKey(string $template_key) Return the first ChildNotifications filtered by the template_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByDataDump(string $data_dump) Return the first ChildNotifications filtered by the data_dump column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySendEmail(boolean $send_email) Return the first ChildNotifications filtered by the send_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySendSms(boolean $send_sms) Return the first ChildNotifications filtered by the send_sms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySendPush(boolean $send_push) Return the first ChildNotifications filtered by the send_push column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByEmailSentDatetime(string $email_sent_datetime) Return the first ChildNotifications filtered by the email_sent_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByEmailSentStatus(boolean $email_sent_status) Return the first ChildNotifications filtered by the email_sent_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByEmailTransId(string $email_trans_id) Return the first ChildNotifications filtered by the email_trans_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySmsSentDatetime(string $sms_sent_datetime) Return the first ChildNotifications filtered by the sms_sent_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySmsSentStatus(boolean $sms_sent_status) Return the first ChildNotifications filtered by the sms_sent_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySmsTransId(string $sms_trans_id) Return the first ChildNotifications filtered by the sms_trans_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByPushSentDatetime(string $push_sent_datetime) Return the first ChildNotifications filtered by the push_sent_datetime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByPushSentStatus(boolean $push_sent_status) Return the first ChildNotifications filtered by the push_sent_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByPushTransId(string $push_trans_id) Return the first ChildNotifications filtered by the push_trans_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByScheduleAt(string $schedule_at) Return the first ChildNotifications filtered by the schedule_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByEmailSentAttempts(int $email_sent_attempts) Return the first ChildNotifications filtered by the email_sent_attempts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneBySmsSentAttempts(int $sms_sent_attempts) Return the first ChildNotifications filtered by the sms_sent_attempts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByPushSentAttempts(int $push_sent_attempts) Return the first ChildNotifications filtered by the push_sent_attempts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByCompanyId(int $company_id) Return the first ChildNotifications filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByCreatedAt(string $created_at) Return the first ChildNotifications filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByUpdatedAt(string $updated_at) Return the first ChildNotifications filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications[]|Collection find(?ConnectionInterface $con = null) Return ChildNotifications objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNotifications> find(?ConnectionInterface $con = null) Return ChildNotifications objects based on current ModelCriteria
 *
 * @method     ChildNotifications[]|Collection findByNotificationId(string|array<string> $notification_id) Return ChildNotifications objects filtered by the notification_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByNotificationId(string|array<string> $notification_id) Return ChildNotifications objects filtered by the notification_id column
 * @method     ChildNotifications[]|Collection findByToEmployeeId(int|array<int> $to_employee_id) Return ChildNotifications objects filtered by the to_employee_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByToEmployeeId(int|array<int> $to_employee_id) Return ChildNotifications objects filtered by the to_employee_id column
 * @method     ChildNotifications[]|Collection findByCcEmployeeIds(string|array<string> $cc_employee_ids) Return ChildNotifications objects filtered by the cc_employee_ids column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByCcEmployeeIds(string|array<string> $cc_employee_ids) Return ChildNotifications objects filtered by the cc_employee_ids column
 * @method     ChildNotifications[]|Collection findByTemplateKey(string|array<string> $template_key) Return ChildNotifications objects filtered by the template_key column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByTemplateKey(string|array<string> $template_key) Return ChildNotifications objects filtered by the template_key column
 * @method     ChildNotifications[]|Collection findByDataDump(string|array<string> $data_dump) Return ChildNotifications objects filtered by the data_dump column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByDataDump(string|array<string> $data_dump) Return ChildNotifications objects filtered by the data_dump column
 * @method     ChildNotifications[]|Collection findBySendEmail(boolean|array<boolean> $send_email) Return ChildNotifications objects filtered by the send_email column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySendEmail(boolean|array<boolean> $send_email) Return ChildNotifications objects filtered by the send_email column
 * @method     ChildNotifications[]|Collection findBySendSms(boolean|array<boolean> $send_sms) Return ChildNotifications objects filtered by the send_sms column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySendSms(boolean|array<boolean> $send_sms) Return ChildNotifications objects filtered by the send_sms column
 * @method     ChildNotifications[]|Collection findBySendPush(boolean|array<boolean> $send_push) Return ChildNotifications objects filtered by the send_push column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySendPush(boolean|array<boolean> $send_push) Return ChildNotifications objects filtered by the send_push column
 * @method     ChildNotifications[]|Collection findByEmailSentDatetime(string|array<string> $email_sent_datetime) Return ChildNotifications objects filtered by the email_sent_datetime column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByEmailSentDatetime(string|array<string> $email_sent_datetime) Return ChildNotifications objects filtered by the email_sent_datetime column
 * @method     ChildNotifications[]|Collection findByEmailSentStatus(boolean|array<boolean> $email_sent_status) Return ChildNotifications objects filtered by the email_sent_status column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByEmailSentStatus(boolean|array<boolean> $email_sent_status) Return ChildNotifications objects filtered by the email_sent_status column
 * @method     ChildNotifications[]|Collection findByEmailTransId(string|array<string> $email_trans_id) Return ChildNotifications objects filtered by the email_trans_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByEmailTransId(string|array<string> $email_trans_id) Return ChildNotifications objects filtered by the email_trans_id column
 * @method     ChildNotifications[]|Collection findBySmsSentDatetime(string|array<string> $sms_sent_datetime) Return ChildNotifications objects filtered by the sms_sent_datetime column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySmsSentDatetime(string|array<string> $sms_sent_datetime) Return ChildNotifications objects filtered by the sms_sent_datetime column
 * @method     ChildNotifications[]|Collection findBySmsSentStatus(boolean|array<boolean> $sms_sent_status) Return ChildNotifications objects filtered by the sms_sent_status column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySmsSentStatus(boolean|array<boolean> $sms_sent_status) Return ChildNotifications objects filtered by the sms_sent_status column
 * @method     ChildNotifications[]|Collection findBySmsTransId(string|array<string> $sms_trans_id) Return ChildNotifications objects filtered by the sms_trans_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySmsTransId(string|array<string> $sms_trans_id) Return ChildNotifications objects filtered by the sms_trans_id column
 * @method     ChildNotifications[]|Collection findByPushSentDatetime(string|array<string> $push_sent_datetime) Return ChildNotifications objects filtered by the push_sent_datetime column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByPushSentDatetime(string|array<string> $push_sent_datetime) Return ChildNotifications objects filtered by the push_sent_datetime column
 * @method     ChildNotifications[]|Collection findByPushSentStatus(boolean|array<boolean> $push_sent_status) Return ChildNotifications objects filtered by the push_sent_status column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByPushSentStatus(boolean|array<boolean> $push_sent_status) Return ChildNotifications objects filtered by the push_sent_status column
 * @method     ChildNotifications[]|Collection findByPushTransId(string|array<string> $push_trans_id) Return ChildNotifications objects filtered by the push_trans_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByPushTransId(string|array<string> $push_trans_id) Return ChildNotifications objects filtered by the push_trans_id column
 * @method     ChildNotifications[]|Collection findByScheduleAt(string|array<string> $schedule_at) Return ChildNotifications objects filtered by the schedule_at column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByScheduleAt(string|array<string> $schedule_at) Return ChildNotifications objects filtered by the schedule_at column
 * @method     ChildNotifications[]|Collection findByEmailSentAttempts(int|array<int> $email_sent_attempts) Return ChildNotifications objects filtered by the email_sent_attempts column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByEmailSentAttempts(int|array<int> $email_sent_attempts) Return ChildNotifications objects filtered by the email_sent_attempts column
 * @method     ChildNotifications[]|Collection findBySmsSentAttempts(int|array<int> $sms_sent_attempts) Return ChildNotifications objects filtered by the sms_sent_attempts column
 * @psalm-method Collection&\Traversable<ChildNotifications> findBySmsSentAttempts(int|array<int> $sms_sent_attempts) Return ChildNotifications objects filtered by the sms_sent_attempts column
 * @method     ChildNotifications[]|Collection findByPushSentAttempts(int|array<int> $push_sent_attempts) Return ChildNotifications objects filtered by the push_sent_attempts column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByPushSentAttempts(int|array<int> $push_sent_attempts) Return ChildNotifications objects filtered by the push_sent_attempts column
 * @method     ChildNotifications[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildNotifications objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByCompanyId(int|array<int> $company_id) Return ChildNotifications objects filtered by the company_id column
 * @method     ChildNotifications[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildNotifications objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByCreatedAt(string|array<string> $created_at) Return ChildNotifications objects filtered by the created_at column
 * @method     ChildNotifications[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildNotifications objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildNotifications> findByUpdatedAt(string|array<string> $updated_at) Return ChildNotifications objects filtered by the updated_at column
 *
 * @method     ChildNotifications[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNotifications> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NotificationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\NotificationsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Notifications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNotificationsQuery) {
            return $criteria;
        }
        $query = new ChildNotificationsQuery();
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NotificationsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNotifications A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT notification_id, to_employee_id, cc_employee_ids, template_key, data_dump, send_email, send_sms, send_push, email_sent_datetime, email_sent_status, email_trans_id, sms_sent_datetime, sms_sent_status, sms_trans_id, push_sent_datetime, push_sent_status, push_trans_id, schedule_at, email_sent_attempts, sms_sent_attempts, push_sent_attempts, company_id, created_at, updated_at FROM notifications WHERE notification_id = :p0';
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
            /** @var ChildNotifications $obj */
            $obj = new ChildNotifications();
            $obj->hydrate($row);
            NotificationsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the notification_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationId(1234); // WHERE notification_id = 1234
     * $query->filterByNotificationId(array(12, 34)); // WHERE notification_id IN (12, 34)
     * $query->filterByNotificationId(array('min' => 12)); // WHERE notification_id > 12
     * </code>
     *
     * @param mixed $notificationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationId($notificationId = null, ?string $comparison = null)
    {
        if (is_array($notificationId)) {
            $useMinMax = false;
            if (isset($notificationId['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $notificationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notificationId['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $notificationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $notificationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the to_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByToEmployeeId(1234); // WHERE to_employee_id = 1234
     * $query->filterByToEmployeeId(array(12, 34)); // WHERE to_employee_id IN (12, 34)
     * $query->filterByToEmployeeId(array('min' => 12)); // WHERE to_employee_id > 12
     * </code>
     *
     * @param mixed $toEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToEmployeeId($toEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($toEmployeeId)) {
            $useMinMax = false;
            if (isset($toEmployeeId['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_TO_EMPLOYEE_ID, $toEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($toEmployeeId['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_TO_EMPLOYEE_ID, $toEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_TO_EMPLOYEE_ID, $toEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cc_employee_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByCcEmployeeIds('fooValue');   // WHERE cc_employee_ids = 'fooValue'
     * $query->filterByCcEmployeeIds('%fooValue%', Criteria::LIKE); // WHERE cc_employee_ids LIKE '%fooValue%'
     * $query->filterByCcEmployeeIds(['foo', 'bar']); // WHERE cc_employee_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ccEmployeeIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCcEmployeeIds($ccEmployeeIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ccEmployeeIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_CC_EMPLOYEE_IDS, $ccEmployeeIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the template_key column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateKey('fooValue');   // WHERE template_key = 'fooValue'
     * $query->filterByTemplateKey('%fooValue%', Criteria::LIKE); // WHERE template_key LIKE '%fooValue%'
     * $query->filterByTemplateKey(['foo', 'bar']); // WHERE template_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $templateKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateKey($templateKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($templateKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_TEMPLATE_KEY, $templateKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data_dump column
     *
     * Example usage:
     * <code>
     * $query->filterByDataDump('fooValue');   // WHERE data_dump = 'fooValue'
     * $query->filterByDataDump('%fooValue%', Criteria::LIKE); // WHERE data_dump LIKE '%fooValue%'
     * $query->filterByDataDump(['foo', 'bar']); // WHERE data_dump IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dataDump The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataDump($dataDump = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dataDump)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_DATA_DUMP, $dataDump, $comparison);

        return $this;
    }

    /**
     * Filter the query on the send_email column
     *
     * Example usage:
     * <code>
     * $query->filterBySendEmail(true); // WHERE send_email = true
     * $query->filterBySendEmail('yes'); // WHERE send_email = true
     * </code>
     *
     * @param bool|string $sendEmail The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySendEmail($sendEmail = null, ?string $comparison = null)
    {
        if (is_string($sendEmail)) {
            $sendEmail = in_array(strtolower($sendEmail), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SEND_EMAIL, $sendEmail, $comparison);

        return $this;
    }

    /**
     * Filter the query on the send_sms column
     *
     * Example usage:
     * <code>
     * $query->filterBySendSms(true); // WHERE send_sms = true
     * $query->filterBySendSms('yes'); // WHERE send_sms = true
     * </code>
     *
     * @param bool|string $sendSms The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySendSms($sendSms = null, ?string $comparison = null)
    {
        if (is_string($sendSms)) {
            $sendSms = in_array(strtolower($sendSms), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SEND_SMS, $sendSms, $comparison);

        return $this;
    }

    /**
     * Filter the query on the send_push column
     *
     * Example usage:
     * <code>
     * $query->filterBySendPush(true); // WHERE send_push = true
     * $query->filterBySendPush('yes'); // WHERE send_push = true
     * </code>
     *
     * @param bool|string $sendPush The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySendPush($sendPush = null, ?string $comparison = null)
    {
        if (is_string($sendPush)) {
            $sendPush = in_array(strtolower($sendPush), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SEND_PUSH, $sendPush, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailSentDatetime['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_DATETIME, $emailSentDatetime, $comparison);

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

        $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_STATUS, $emailSentStatus, $comparison);

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

        $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_TRANS_ID, $emailTransId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_sent_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsSentDatetime('2011-03-14'); // WHERE sms_sent_datetime = '2011-03-14'
     * $query->filterBySmsSentDatetime('now'); // WHERE sms_sent_datetime = '2011-03-14'
     * $query->filterBySmsSentDatetime(array('max' => 'yesterday')); // WHERE sms_sent_datetime > '2011-03-13'
     * </code>
     *
     * @param mixed $smsSentDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsSentDatetime($smsSentDatetime = null, ?string $comparison = null)
    {
        if (is_array($smsSentDatetime)) {
            $useMinMax = false;
            if (isset($smsSentDatetime['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_DATETIME, $smsSentDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($smsSentDatetime['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_DATETIME, $smsSentDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_DATETIME, $smsSentDatetime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_sent_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsSentStatus(true); // WHERE sms_sent_status = true
     * $query->filterBySmsSentStatus('yes'); // WHERE sms_sent_status = true
     * </code>
     *
     * @param bool|string $smsSentStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsSentStatus($smsSentStatus = null, ?string $comparison = null)
    {
        if (is_string($smsSentStatus)) {
            $smsSentStatus = in_array(strtolower($smsSentStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_STATUS, $smsSentStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_trans_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsTransId('fooValue');   // WHERE sms_trans_id = 'fooValue'
     * $query->filterBySmsTransId('%fooValue%', Criteria::LIKE); // WHERE sms_trans_id LIKE '%fooValue%'
     * $query->filterBySmsTransId(['foo', 'bar']); // WHERE sms_trans_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smsTransId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsTransId($smsTransId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smsTransId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SMS_TRANS_ID, $smsTransId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_sent_datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByPushSentDatetime('2011-03-14'); // WHERE push_sent_datetime = '2011-03-14'
     * $query->filterByPushSentDatetime('now'); // WHERE push_sent_datetime = '2011-03-14'
     * $query->filterByPushSentDatetime(array('max' => 'yesterday')); // WHERE push_sent_datetime > '2011-03-13'
     * </code>
     *
     * @param mixed $pushSentDatetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushSentDatetime($pushSentDatetime = null, ?string $comparison = null)
    {
        if (is_array($pushSentDatetime)) {
            $useMinMax = false;
            if (isset($pushSentDatetime['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_DATETIME, $pushSentDatetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pushSentDatetime['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_DATETIME, $pushSentDatetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_DATETIME, $pushSentDatetime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_sent_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPushSentStatus(true); // WHERE push_sent_status = true
     * $query->filterByPushSentStatus('yes'); // WHERE push_sent_status = true
     * </code>
     *
     * @param bool|string $pushSentStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushSentStatus($pushSentStatus = null, ?string $comparison = null)
    {
        if (is_string($pushSentStatus)) {
            $pushSentStatus = in_array(strtolower($pushSentStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_STATUS, $pushSentStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_trans_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPushTransId('fooValue');   // WHERE push_trans_id = 'fooValue'
     * $query->filterByPushTransId('%fooValue%', Criteria::LIKE); // WHERE push_trans_id LIKE '%fooValue%'
     * $query->filterByPushTransId(['foo', 'bar']); // WHERE push_trans_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pushTransId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushTransId($pushTransId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushTransId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_PUSH_TRANS_ID, $pushTransId, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduleAt['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SCHEDULE_AT, $scheduleAt, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailSentAttempts['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $emailSentAttempts, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_sent_attempts column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsSentAttempts(1234); // WHERE sms_sent_attempts = 1234
     * $query->filterBySmsSentAttempts(array(12, 34)); // WHERE sms_sent_attempts IN (12, 34)
     * $query->filterBySmsSentAttempts(array('min' => 12)); // WHERE sms_sent_attempts > 12
     * </code>
     *
     * @param mixed $smsSentAttempts The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsSentAttempts($smsSentAttempts = null, ?string $comparison = null)
    {
        if (is_array($smsSentAttempts)) {
            $useMinMax = false;
            if (isset($smsSentAttempts['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS, $smsSentAttempts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($smsSentAttempts['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS, $smsSentAttempts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS, $smsSentAttempts, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_sent_attempts column
     *
     * Example usage:
     * <code>
     * $query->filterByPushSentAttempts(1234); // WHERE push_sent_attempts = 1234
     * $query->filterByPushSentAttempts(array(12, 34)); // WHERE push_sent_attempts IN (12, 34)
     * $query->filterByPushSentAttempts(array('min' => 12)); // WHERE push_sent_attempts > 12
     * </code>
     *
     * @param mixed $pushSentAttempts The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushSentAttempts($pushSentAttempts = null, ?string $comparison = null)
    {
        if (is_array($pushSentAttempts)) {
            $useMinMax = false;
            if (isset($pushSentAttempts['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS, $pushSentAttempts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pushSentAttempts['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS, $pushSentAttempts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS, $pushSentAttempts, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(NotificationsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNotifications $notifications Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($notifications = null)
    {
        if ($notifications) {
            $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATION_ID, $notifications->getNotificationId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationsTableMap::clearInstancePool();
            NotificationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

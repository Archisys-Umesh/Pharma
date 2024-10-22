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
use entities\NotificationTemplates as ChildNotificationTemplates;
use entities\NotificationTemplatesQuery as ChildNotificationTemplatesQuery;
use entities\Map\NotificationTemplatesTableMap;

/**
 * Base class that represents a query for the `notification_templates` table.
 *
 * @method     ChildNotificationTemplatesQuery orderByTemplateId($order = Criteria::ASC) Order by the template_id column
 * @method     ChildNotificationTemplatesQuery orderByTemplateKey($order = Criteria::ASC) Order by the template_key column
 * @method     ChildNotificationTemplatesQuery orderByEmailSubject($order = Criteria::ASC) Order by the email_subject column
 * @method     ChildNotificationTemplatesQuery orderByEmailBody($order = Criteria::ASC) Order by the email_body column
 * @method     ChildNotificationTemplatesQuery orderBySmsMessage($order = Criteria::ASC) Order by the sms_message column
 * @method     ChildNotificationTemplatesQuery orderBySmsTemplateId($order = Criteria::ASC) Order by the sms_template_id column
 * @method     ChildNotificationTemplatesQuery orderBySmsType($order = Criteria::ASC) Order by the sms_type column
 * @method     ChildNotificationTemplatesQuery orderBySmsDlr($order = Criteria::ASC) Order by the sms_dlr column
 * @method     ChildNotificationTemplatesQuery orderByPushTitle($order = Criteria::ASC) Order by the push_title column
 * @method     ChildNotificationTemplatesQuery orderByPushMessage($order = Criteria::ASC) Order by the push_message column
 * @method     ChildNotificationTemplatesQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildNotificationTemplatesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNotificationTemplatesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildNotificationTemplatesQuery groupByTemplateId() Group by the template_id column
 * @method     ChildNotificationTemplatesQuery groupByTemplateKey() Group by the template_key column
 * @method     ChildNotificationTemplatesQuery groupByEmailSubject() Group by the email_subject column
 * @method     ChildNotificationTemplatesQuery groupByEmailBody() Group by the email_body column
 * @method     ChildNotificationTemplatesQuery groupBySmsMessage() Group by the sms_message column
 * @method     ChildNotificationTemplatesQuery groupBySmsTemplateId() Group by the sms_template_id column
 * @method     ChildNotificationTemplatesQuery groupBySmsType() Group by the sms_type column
 * @method     ChildNotificationTemplatesQuery groupBySmsDlr() Group by the sms_dlr column
 * @method     ChildNotificationTemplatesQuery groupByPushTitle() Group by the push_title column
 * @method     ChildNotificationTemplatesQuery groupByPushMessage() Group by the push_message column
 * @method     ChildNotificationTemplatesQuery groupByCompanyId() Group by the company_id column
 * @method     ChildNotificationTemplatesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNotificationTemplatesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildNotificationTemplatesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationTemplatesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationTemplatesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotificationTemplatesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNotificationTemplatesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNotificationTemplatesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNotificationTemplates|null findOne(?ConnectionInterface $con = null) Return the first ChildNotificationTemplates matching the query
 * @method     ChildNotificationTemplates findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNotificationTemplates matching the query, or a new ChildNotificationTemplates object populated from the query conditions when no match is found
 *
 * @method     ChildNotificationTemplates|null findOneByTemplateId(int $template_id) Return the first ChildNotificationTemplates filtered by the template_id column
 * @method     ChildNotificationTemplates|null findOneByTemplateKey(string $template_key) Return the first ChildNotificationTemplates filtered by the template_key column
 * @method     ChildNotificationTemplates|null findOneByEmailSubject(string $email_subject) Return the first ChildNotificationTemplates filtered by the email_subject column
 * @method     ChildNotificationTemplates|null findOneByEmailBody(string $email_body) Return the first ChildNotificationTemplates filtered by the email_body column
 * @method     ChildNotificationTemplates|null findOneBySmsMessage(string $sms_message) Return the first ChildNotificationTemplates filtered by the sms_message column
 * @method     ChildNotificationTemplates|null findOneBySmsTemplateId(string $sms_template_id) Return the first ChildNotificationTemplates filtered by the sms_template_id column
 * @method     ChildNotificationTemplates|null findOneBySmsType(string $sms_type) Return the first ChildNotificationTemplates filtered by the sms_type column
 * @method     ChildNotificationTemplates|null findOneBySmsDlr(string $sms_dlr) Return the first ChildNotificationTemplates filtered by the sms_dlr column
 * @method     ChildNotificationTemplates|null findOneByPushTitle(string $push_title) Return the first ChildNotificationTemplates filtered by the push_title column
 * @method     ChildNotificationTemplates|null findOneByPushMessage(string $push_message) Return the first ChildNotificationTemplates filtered by the push_message column
 * @method     ChildNotificationTemplates|null findOneByCompanyId(int $company_id) Return the first ChildNotificationTemplates filtered by the company_id column
 * @method     ChildNotificationTemplates|null findOneByCreatedAt(string $created_at) Return the first ChildNotificationTemplates filtered by the created_at column
 * @method     ChildNotificationTemplates|null findOneByUpdatedAt(string $updated_at) Return the first ChildNotificationTemplates filtered by the updated_at column
 *
 * @method     ChildNotificationTemplates requirePk($key, ?ConnectionInterface $con = null) Return the ChildNotificationTemplates by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOne(?ConnectionInterface $con = null) Return the first ChildNotificationTemplates matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationTemplates requireOneByTemplateId(int $template_id) Return the first ChildNotificationTemplates filtered by the template_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByTemplateKey(string $template_key) Return the first ChildNotificationTemplates filtered by the template_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByEmailSubject(string $email_subject) Return the first ChildNotificationTemplates filtered by the email_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByEmailBody(string $email_body) Return the first ChildNotificationTemplates filtered by the email_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneBySmsMessage(string $sms_message) Return the first ChildNotificationTemplates filtered by the sms_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneBySmsTemplateId(string $sms_template_id) Return the first ChildNotificationTemplates filtered by the sms_template_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneBySmsType(string $sms_type) Return the first ChildNotificationTemplates filtered by the sms_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneBySmsDlr(string $sms_dlr) Return the first ChildNotificationTemplates filtered by the sms_dlr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByPushTitle(string $push_title) Return the first ChildNotificationTemplates filtered by the push_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByPushMessage(string $push_message) Return the first ChildNotificationTemplates filtered by the push_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByCompanyId(int $company_id) Return the first ChildNotificationTemplates filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByCreatedAt(string $created_at) Return the first ChildNotificationTemplates filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotificationTemplates requireOneByUpdatedAt(string $updated_at) Return the first ChildNotificationTemplates filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotificationTemplates[]|Collection find(?ConnectionInterface $con = null) Return ChildNotificationTemplates objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> find(?ConnectionInterface $con = null) Return ChildNotificationTemplates objects based on current ModelCriteria
 *
 * @method     ChildNotificationTemplates[]|Collection findByTemplateId(int|array<int> $template_id) Return ChildNotificationTemplates objects filtered by the template_id column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByTemplateId(int|array<int> $template_id) Return ChildNotificationTemplates objects filtered by the template_id column
 * @method     ChildNotificationTemplates[]|Collection findByTemplateKey(string|array<string> $template_key) Return ChildNotificationTemplates objects filtered by the template_key column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByTemplateKey(string|array<string> $template_key) Return ChildNotificationTemplates objects filtered by the template_key column
 * @method     ChildNotificationTemplates[]|Collection findByEmailSubject(string|array<string> $email_subject) Return ChildNotificationTemplates objects filtered by the email_subject column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByEmailSubject(string|array<string> $email_subject) Return ChildNotificationTemplates objects filtered by the email_subject column
 * @method     ChildNotificationTemplates[]|Collection findByEmailBody(string|array<string> $email_body) Return ChildNotificationTemplates objects filtered by the email_body column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByEmailBody(string|array<string> $email_body) Return ChildNotificationTemplates objects filtered by the email_body column
 * @method     ChildNotificationTemplates[]|Collection findBySmsMessage(string|array<string> $sms_message) Return ChildNotificationTemplates objects filtered by the sms_message column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findBySmsMessage(string|array<string> $sms_message) Return ChildNotificationTemplates objects filtered by the sms_message column
 * @method     ChildNotificationTemplates[]|Collection findBySmsTemplateId(string|array<string> $sms_template_id) Return ChildNotificationTemplates objects filtered by the sms_template_id column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findBySmsTemplateId(string|array<string> $sms_template_id) Return ChildNotificationTemplates objects filtered by the sms_template_id column
 * @method     ChildNotificationTemplates[]|Collection findBySmsType(string|array<string> $sms_type) Return ChildNotificationTemplates objects filtered by the sms_type column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findBySmsType(string|array<string> $sms_type) Return ChildNotificationTemplates objects filtered by the sms_type column
 * @method     ChildNotificationTemplates[]|Collection findBySmsDlr(string|array<string> $sms_dlr) Return ChildNotificationTemplates objects filtered by the sms_dlr column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findBySmsDlr(string|array<string> $sms_dlr) Return ChildNotificationTemplates objects filtered by the sms_dlr column
 * @method     ChildNotificationTemplates[]|Collection findByPushTitle(string|array<string> $push_title) Return ChildNotificationTemplates objects filtered by the push_title column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByPushTitle(string|array<string> $push_title) Return ChildNotificationTemplates objects filtered by the push_title column
 * @method     ChildNotificationTemplates[]|Collection findByPushMessage(string|array<string> $push_message) Return ChildNotificationTemplates objects filtered by the push_message column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByPushMessage(string|array<string> $push_message) Return ChildNotificationTemplates objects filtered by the push_message column
 * @method     ChildNotificationTemplates[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildNotificationTemplates objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByCompanyId(int|array<int> $company_id) Return ChildNotificationTemplates objects filtered by the company_id column
 * @method     ChildNotificationTemplates[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildNotificationTemplates objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByCreatedAt(string|array<string> $created_at) Return ChildNotificationTemplates objects filtered by the created_at column
 * @method     ChildNotificationTemplates[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildNotificationTemplates objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildNotificationTemplates> findByUpdatedAt(string|array<string> $updated_at) Return ChildNotificationTemplates objects filtered by the updated_at column
 *
 * @method     ChildNotificationTemplates[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNotificationTemplates> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NotificationTemplatesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\NotificationTemplatesQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\NotificationTemplates', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationTemplatesQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationTemplatesQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNotificationTemplatesQuery) {
            return $criteria;
        }
        $query = new ChildNotificationTemplatesQuery();
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
     * @return ChildNotificationTemplates|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NotificationTemplatesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNotificationTemplates A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT template_id, template_key, email_subject, email_body, sms_message, sms_template_id, sms_type, sms_dlr, push_title, push_message, company_id, created_at, updated_at FROM notification_templates WHERE template_id = :p0';
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
            /** @var ChildNotificationTemplates $obj */
            $obj = new ChildNotificationTemplates();
            $obj->hydrate($row);
            NotificationTemplatesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNotificationTemplates|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the template_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateId(1234); // WHERE template_id = 1234
     * $query->filterByTemplateId(array(12, 34)); // WHERE template_id IN (12, 34)
     * $query->filterByTemplateId(array('min' => 12)); // WHERE template_id > 12
     * </code>
     *
     * @param mixed $templateId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateId($templateId = null, ?string $comparison = null)
    {
        if (is_array($templateId)) {
            $useMinMax = false;
            if (isset($templateId['min'])) {
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $templateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($templateId['max'])) {
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $templateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $templateId, $comparison);

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

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_KEY, $templateKey, $comparison);

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

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT, $emailSubject, $comparison);

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

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_EMAIL_BODY, $emailBody, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_message column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsMessage('fooValue');   // WHERE sms_message = 'fooValue'
     * $query->filterBySmsMessage('%fooValue%', Criteria::LIKE); // WHERE sms_message LIKE '%fooValue%'
     * $query->filterBySmsMessage(['foo', 'bar']); // WHERE sms_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smsMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsMessage($smsMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smsMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_SMS_MESSAGE, $smsMessage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_template_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsTemplateId('fooValue');   // WHERE sms_template_id = 'fooValue'
     * $query->filterBySmsTemplateId('%fooValue%', Criteria::LIKE); // WHERE sms_template_id LIKE '%fooValue%'
     * $query->filterBySmsTemplateId(['foo', 'bar']); // WHERE sms_template_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smsTemplateId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsTemplateId($smsTemplateId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smsTemplateId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID, $smsTemplateId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_type column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsType('fooValue');   // WHERE sms_type = 'fooValue'
     * $query->filterBySmsType('%fooValue%', Criteria::LIKE); // WHERE sms_type LIKE '%fooValue%'
     * $query->filterBySmsType(['foo', 'bar']); // WHERE sms_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smsType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsType($smsType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smsType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_SMS_TYPE, $smsType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sms_dlr column
     *
     * Example usage:
     * <code>
     * $query->filterBySmsDlr('fooValue');   // WHERE sms_dlr = 'fooValue'
     * $query->filterBySmsDlr('%fooValue%', Criteria::LIKE); // WHERE sms_dlr LIKE '%fooValue%'
     * $query->filterBySmsDlr(['foo', 'bar']); // WHERE sms_dlr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $smsDlr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySmsDlr($smsDlr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($smsDlr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_SMS_DLR, $smsDlr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_title column
     *
     * Example usage:
     * <code>
     * $query->filterByPushTitle('fooValue');   // WHERE push_title = 'fooValue'
     * $query->filterByPushTitle('%fooValue%', Criteria::LIKE); // WHERE push_title LIKE '%fooValue%'
     * $query->filterByPushTitle(['foo', 'bar']); // WHERE push_title IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pushTitle The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushTitle($pushTitle = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushTitle)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_PUSH_TITLE, $pushTitle, $comparison);

        return $this;
    }

    /**
     * Filter the query on the push_message column
     *
     * Example usage:
     * <code>
     * $query->filterByPushMessage('fooValue');   // WHERE push_message = 'fooValue'
     * $query->filterByPushMessage('%fooValue%', Criteria::LIKE); // WHERE push_message LIKE '%fooValue%'
     * $query->filterByPushMessage(['foo', 'bar']); // WHERE push_message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pushMessage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPushMessage($pushMessage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pushMessage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_PUSH_MESSAGE, $pushMessage, $comparison);

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
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NotificationTemplatesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NotificationTemplatesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNotificationTemplates $notificationTemplates Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($notificationTemplates = null)
    {
        if ($notificationTemplates) {
            $this->addUsingAlias(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $notificationTemplates->getTemplateId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notification_templates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationTemplatesTableMap::clearInstancePool();
            NotificationTemplatesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationTemplatesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationTemplatesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationTemplatesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

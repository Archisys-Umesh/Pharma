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
use entities\EmailTemplate as ChildEmailTemplate;
use entities\EmailTemplateQuery as ChildEmailTemplateQuery;
use entities\Map\EmailTemplateTableMap;

/**
 * Base class that represents a query for the `email_template` table.
 *
 * @method     ChildEmailTemplateQuery orderByTemplateId($order = Criteria::ASC) Order by the template_id column
 * @method     ChildEmailTemplateQuery orderByTemplateType($order = Criteria::ASC) Order by the template_type column
 * @method     ChildEmailTemplateQuery orderByTemplateSubject($order = Criteria::ASC) Order by the template_subject column
 * @method     ChildEmailTemplateQuery orderByTemplateBody($order = Criteria::ASC) Order by the template_body column
 * @method     ChildEmailTemplateQuery orderByTemplateStatus($order = Criteria::ASC) Order by the template_status column
 *
 * @method     ChildEmailTemplateQuery groupByTemplateId() Group by the template_id column
 * @method     ChildEmailTemplateQuery groupByTemplateType() Group by the template_type column
 * @method     ChildEmailTemplateQuery groupByTemplateSubject() Group by the template_subject column
 * @method     ChildEmailTemplateQuery groupByTemplateBody() Group by the template_body column
 * @method     ChildEmailTemplateQuery groupByTemplateStatus() Group by the template_status column
 *
 * @method     ChildEmailTemplateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmailTemplateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmailTemplateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmailTemplateQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmailTemplateQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmailTemplateQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmailTemplate|null findOne(?ConnectionInterface $con = null) Return the first ChildEmailTemplate matching the query
 * @method     ChildEmailTemplate findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmailTemplate matching the query, or a new ChildEmailTemplate object populated from the query conditions when no match is found
 *
 * @method     ChildEmailTemplate|null findOneByTemplateId(int $template_id) Return the first ChildEmailTemplate filtered by the template_id column
 * @method     ChildEmailTemplate|null findOneByTemplateType(string $template_type) Return the first ChildEmailTemplate filtered by the template_type column
 * @method     ChildEmailTemplate|null findOneByTemplateSubject(string $template_subject) Return the first ChildEmailTemplate filtered by the template_subject column
 * @method     ChildEmailTemplate|null findOneByTemplateBody(string $template_body) Return the first ChildEmailTemplate filtered by the template_body column
 * @method     ChildEmailTemplate|null findOneByTemplateStatus(int $template_status) Return the first ChildEmailTemplate filtered by the template_status column
 *
 * @method     ChildEmailTemplate requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmailTemplate by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailTemplate requireOne(?ConnectionInterface $con = null) Return the first ChildEmailTemplate matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailTemplate requireOneByTemplateId(int $template_id) Return the first ChildEmailTemplate filtered by the template_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailTemplate requireOneByTemplateType(string $template_type) Return the first ChildEmailTemplate filtered by the template_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailTemplate requireOneByTemplateSubject(string $template_subject) Return the first ChildEmailTemplate filtered by the template_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailTemplate requireOneByTemplateBody(string $template_body) Return the first ChildEmailTemplate filtered by the template_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailTemplate requireOneByTemplateStatus(int $template_status) Return the first ChildEmailTemplate filtered by the template_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailTemplate[]|Collection find(?ConnectionInterface $con = null) Return ChildEmailTemplate objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> find(?ConnectionInterface $con = null) Return ChildEmailTemplate objects based on current ModelCriteria
 *
 * @method     ChildEmailTemplate[]|Collection findByTemplateId(int|array<int> $template_id) Return ChildEmailTemplate objects filtered by the template_id column
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> findByTemplateId(int|array<int> $template_id) Return ChildEmailTemplate objects filtered by the template_id column
 * @method     ChildEmailTemplate[]|Collection findByTemplateType(string|array<string> $template_type) Return ChildEmailTemplate objects filtered by the template_type column
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> findByTemplateType(string|array<string> $template_type) Return ChildEmailTemplate objects filtered by the template_type column
 * @method     ChildEmailTemplate[]|Collection findByTemplateSubject(string|array<string> $template_subject) Return ChildEmailTemplate objects filtered by the template_subject column
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> findByTemplateSubject(string|array<string> $template_subject) Return ChildEmailTemplate objects filtered by the template_subject column
 * @method     ChildEmailTemplate[]|Collection findByTemplateBody(string|array<string> $template_body) Return ChildEmailTemplate objects filtered by the template_body column
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> findByTemplateBody(string|array<string> $template_body) Return ChildEmailTemplate objects filtered by the template_body column
 * @method     ChildEmailTemplate[]|Collection findByTemplateStatus(int|array<int> $template_status) Return ChildEmailTemplate objects filtered by the template_status column
 * @psalm-method Collection&\Traversable<ChildEmailTemplate> findByTemplateStatus(int|array<int> $template_status) Return ChildEmailTemplate objects filtered by the template_status column
 *
 * @method     ChildEmailTemplate[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmailTemplate> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmailTemplateQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmailTemplateQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\EmailTemplate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmailTemplateQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmailTemplateQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmailTemplateQuery) {
            return $criteria;
        }
        $query = new ChildEmailTemplateQuery();
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
     * @return ChildEmailTemplate|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmailTemplateTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmailTemplateTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmailTemplate A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT template_id, template_type, template_subject, template_body, template_status FROM email_template WHERE template_id = :p0';
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
            /** @var ChildEmailTemplate $obj */
            $obj = new ChildEmailTemplate();
            $obj->hydrate($row);
            EmailTemplateTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmailTemplate|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $templateId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($templateId['max'])) {
                $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $templateId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $templateId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the template_type column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateType('fooValue');   // WHERE template_type = 'fooValue'
     * $query->filterByTemplateType('%fooValue%', Criteria::LIKE); // WHERE template_type LIKE '%fooValue%'
     * $query->filterByTemplateType(['foo', 'bar']); // WHERE template_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $templateType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateType($templateType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($templateType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_TYPE, $templateType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the template_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateSubject('fooValue');   // WHERE template_subject = 'fooValue'
     * $query->filterByTemplateSubject('%fooValue%', Criteria::LIKE); // WHERE template_subject LIKE '%fooValue%'
     * $query->filterByTemplateSubject(['foo', 'bar']); // WHERE template_subject IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $templateSubject The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateSubject($templateSubject = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($templateSubject)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_SUBJECT, $templateSubject, $comparison);

        return $this;
    }

    /**
     * Filter the query on the template_body column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateBody('fooValue');   // WHERE template_body = 'fooValue'
     * $query->filterByTemplateBody('%fooValue%', Criteria::LIKE); // WHERE template_body LIKE '%fooValue%'
     * $query->filterByTemplateBody(['foo', 'bar']); // WHERE template_body IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $templateBody The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateBody($templateBody = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($templateBody)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_BODY, $templateBody, $comparison);

        return $this;
    }

    /**
     * Filter the query on the template_status column
     *
     * Example usage:
     * <code>
     * $query->filterByTemplateStatus(1234); // WHERE template_status = 1234
     * $query->filterByTemplateStatus(array(12, 34)); // WHERE template_status IN (12, 34)
     * $query->filterByTemplateStatus(array('min' => 12)); // WHERE template_status > 12
     * </code>
     *
     * @param mixed $templateStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTemplateStatus($templateStatus = null, ?string $comparison = null)
    {
        if (is_array($templateStatus)) {
            $useMinMax = false;
            if (isset($templateStatus['min'])) {
                $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_STATUS, $templateStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($templateStatus['max'])) {
                $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_STATUS, $templateStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_STATUS, $templateStatus, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmailTemplate $emailTemplate Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($emailTemplate = null)
    {
        if ($emailTemplate) {
            $this->addUsingAlias(EmailTemplateTableMap::COL_TEMPLATE_ID, $emailTemplate->getTemplateId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the email_template table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailTemplateTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmailTemplateTableMap::clearInstancePool();
            EmailTemplateTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailTemplateTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmailTemplateTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmailTemplateTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmailTemplateTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

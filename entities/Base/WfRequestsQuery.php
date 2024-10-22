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
use entities\WfRequests as ChildWfRequests;
use entities\WfRequestsQuery as ChildWfRequestsQuery;
use entities\Map\WfRequestsTableMap;

/**
 * Base class that represents a query for the `wf_requests` table.
 *
 * @method     ChildWfRequestsQuery orderByWfReqId($order = Criteria::ASC) Order by the wf_req_id column
 * @method     ChildWfRequestsQuery orderByWfCompanyId($order = Criteria::ASC) Order by the wf_company_id column
 * @method     ChildWfRequestsQuery orderByWfId($order = Criteria::ASC) Order by the wf_id column
 * @method     ChildWfRequestsQuery orderByWfDocId($order = Criteria::ASC) Order by the wf_doc_id column
 * @method     ChildWfRequestsQuery orderByWfDocPk($order = Criteria::ASC) Order by the wf_doc_pk column
 * @method     ChildWfRequestsQuery orderByWfDocStatus($order = Criteria::ASC) Order by the wf_doc_status column
 * @method     ChildWfRequestsQuery orderByWfEntityName($order = Criteria::ASC) Order by the wf_entity_name column
 * @method     ChildWfRequestsQuery orderByWfOriginEmployee($order = Criteria::ASC) Order by the wf_origin_employee column
 * @method     ChildWfRequestsQuery orderByWfStepId($order = Criteria::ASC) Order by the wf_step_id column
 * @method     ChildWfRequestsQuery orderByWfStepLevel($order = Criteria::ASC) Order by the wf_step_level column
 * @method     ChildWfRequestsQuery orderByWfReqStatus($order = Criteria::ASC) Order by the wf_req_status column
 * @method     ChildWfRequestsQuery orderByWfReqEmployee($order = Criteria::ASC) Order by the wf_req_employee column
 * @method     ChildWfRequestsQuery orderByWfDesc($order = Criteria::ASC) Order by the wf_desc column
 * @method     ChildWfRequestsQuery orderByWfRoute($order = Criteria::ASC) Order by the wf_route column
 * @method     ChildWfRequestsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWfRequestsQuery orderByWfEscalationDate($order = Criteria::ASC) Order by the wf_escalation_date column
 *
 * @method     ChildWfRequestsQuery groupByWfReqId() Group by the wf_req_id column
 * @method     ChildWfRequestsQuery groupByWfCompanyId() Group by the wf_company_id column
 * @method     ChildWfRequestsQuery groupByWfId() Group by the wf_id column
 * @method     ChildWfRequestsQuery groupByWfDocId() Group by the wf_doc_id column
 * @method     ChildWfRequestsQuery groupByWfDocPk() Group by the wf_doc_pk column
 * @method     ChildWfRequestsQuery groupByWfDocStatus() Group by the wf_doc_status column
 * @method     ChildWfRequestsQuery groupByWfEntityName() Group by the wf_entity_name column
 * @method     ChildWfRequestsQuery groupByWfOriginEmployee() Group by the wf_origin_employee column
 * @method     ChildWfRequestsQuery groupByWfStepId() Group by the wf_step_id column
 * @method     ChildWfRequestsQuery groupByWfStepLevel() Group by the wf_step_level column
 * @method     ChildWfRequestsQuery groupByWfReqStatus() Group by the wf_req_status column
 * @method     ChildWfRequestsQuery groupByWfReqEmployee() Group by the wf_req_employee column
 * @method     ChildWfRequestsQuery groupByWfDesc() Group by the wf_desc column
 * @method     ChildWfRequestsQuery groupByWfRoute() Group by the wf_route column
 * @method     ChildWfRequestsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWfRequestsQuery groupByWfEscalationDate() Group by the wf_escalation_date column
 *
 * @method     ChildWfRequestsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWfRequestsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWfRequestsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWfRequestsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWfRequestsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWfRequestsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWfRequestsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildWfRequestsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildWfRequestsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildWfRequestsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildWfRequestsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildWfRequestsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildWfRequestsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildWfRequestsQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildWfRequestsQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildWfRequestsQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildWfRequestsQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildWfRequestsQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildWfRequestsQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildWfRequestsQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildWfRequestsQuery leftJoinWfDocuments($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfRequestsQuery rightJoinWfDocuments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfDocuments relation
 * @method     ChildWfRequestsQuery innerJoinWfDocuments($relationAlias = null) Adds a INNER JOIN clause to the query using the WfDocuments relation
 *
 * @method     ChildWfRequestsQuery joinWithWfDocuments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfDocuments relation
 *
 * @method     ChildWfRequestsQuery leftJoinWithWfDocuments() Adds a LEFT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfRequestsQuery rightJoinWithWfDocuments() Adds a RIGHT JOIN clause and with to the query using the WfDocuments relation
 * @method     ChildWfRequestsQuery innerJoinWithWfDocuments() Adds a INNER JOIN clause and with to the query using the WfDocuments relation
 *
 * @method     ChildWfRequestsQuery leftJoinWfMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfRequestsQuery rightJoinWfMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfMaster relation
 * @method     ChildWfRequestsQuery innerJoinWfMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the WfMaster relation
 *
 * @method     ChildWfRequestsQuery joinWithWfMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfRequestsQuery leftJoinWithWfMaster() Adds a LEFT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfRequestsQuery rightJoinWithWfMaster() Adds a RIGHT JOIN clause and with to the query using the WfMaster relation
 * @method     ChildWfRequestsQuery innerJoinWithWfMaster() Adds a INNER JOIN clause and with to the query using the WfMaster relation
 *
 * @method     ChildWfRequestsQuery leftJoinWfSteps($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfSteps relation
 * @method     ChildWfRequestsQuery rightJoinWfSteps($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfSteps relation
 * @method     ChildWfRequestsQuery innerJoinWfSteps($relationAlias = null) Adds a INNER JOIN clause to the query using the WfSteps relation
 *
 * @method     ChildWfRequestsQuery joinWithWfSteps($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfSteps relation
 *
 * @method     ChildWfRequestsQuery leftJoinWithWfSteps() Adds a LEFT JOIN clause and with to the query using the WfSteps relation
 * @method     ChildWfRequestsQuery rightJoinWithWfSteps() Adds a RIGHT JOIN clause and with to the query using the WfSteps relation
 * @method     ChildWfRequestsQuery innerJoinWithWfSteps() Adds a INNER JOIN clause and with to the query using the WfSteps relation
 *
 * @method     \entities\CompanyQuery|\entities\EmployeeQuery|\entities\WfDocumentsQuery|\entities\WfMasterQuery|\entities\WfStepsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWfRequests|null findOne(?ConnectionInterface $con = null) Return the first ChildWfRequests matching the query
 * @method     ChildWfRequests findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWfRequests matching the query, or a new ChildWfRequests object populated from the query conditions when no match is found
 *
 * @method     ChildWfRequests|null findOneByWfReqId(int $wf_req_id) Return the first ChildWfRequests filtered by the wf_req_id column
 * @method     ChildWfRequests|null findOneByWfCompanyId(int $wf_company_id) Return the first ChildWfRequests filtered by the wf_company_id column
 * @method     ChildWfRequests|null findOneByWfId(int $wf_id) Return the first ChildWfRequests filtered by the wf_id column
 * @method     ChildWfRequests|null findOneByWfDocId(int $wf_doc_id) Return the first ChildWfRequests filtered by the wf_doc_id column
 * @method     ChildWfRequests|null findOneByWfDocPk(int $wf_doc_pk) Return the first ChildWfRequests filtered by the wf_doc_pk column
 * @method     ChildWfRequests|null findOneByWfDocStatus(int $wf_doc_status) Return the first ChildWfRequests filtered by the wf_doc_status column
 * @method     ChildWfRequests|null findOneByWfEntityName(string $wf_entity_name) Return the first ChildWfRequests filtered by the wf_entity_name column
 * @method     ChildWfRequests|null findOneByWfOriginEmployee(int $wf_origin_employee) Return the first ChildWfRequests filtered by the wf_origin_employee column
 * @method     ChildWfRequests|null findOneByWfStepId(int $wf_step_id) Return the first ChildWfRequests filtered by the wf_step_id column
 * @method     ChildWfRequests|null findOneByWfStepLevel(int $wf_step_level) Return the first ChildWfRequests filtered by the wf_step_level column
 * @method     ChildWfRequests|null findOneByWfReqStatus(int $wf_req_status) Return the first ChildWfRequests filtered by the wf_req_status column
 * @method     ChildWfRequests|null findOneByWfReqEmployee(int $wf_req_employee) Return the first ChildWfRequests filtered by the wf_req_employee column
 * @method     ChildWfRequests|null findOneByWfDesc(string $wf_desc) Return the first ChildWfRequests filtered by the wf_desc column
 * @method     ChildWfRequests|null findOneByWfRoute(string $wf_route) Return the first ChildWfRequests filtered by the wf_route column
 * @method     ChildWfRequests|null findOneByCreatedAt(string $created_at) Return the first ChildWfRequests filtered by the created_at column
 * @method     ChildWfRequests|null findOneByWfEscalationDate(string $wf_escalation_date) Return the first ChildWfRequests filtered by the wf_escalation_date column
 *
 * @method     ChildWfRequests requirePk($key, ?ConnectionInterface $con = null) Return the ChildWfRequests by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOne(?ConnectionInterface $con = null) Return the first ChildWfRequests matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfRequests requireOneByWfReqId(int $wf_req_id) Return the first ChildWfRequests filtered by the wf_req_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfCompanyId(int $wf_company_id) Return the first ChildWfRequests filtered by the wf_company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfId(int $wf_id) Return the first ChildWfRequests filtered by the wf_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfDocId(int $wf_doc_id) Return the first ChildWfRequests filtered by the wf_doc_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfDocPk(int $wf_doc_pk) Return the first ChildWfRequests filtered by the wf_doc_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfDocStatus(int $wf_doc_status) Return the first ChildWfRequests filtered by the wf_doc_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfEntityName(string $wf_entity_name) Return the first ChildWfRequests filtered by the wf_entity_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfOriginEmployee(int $wf_origin_employee) Return the first ChildWfRequests filtered by the wf_origin_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfStepId(int $wf_step_id) Return the first ChildWfRequests filtered by the wf_step_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfStepLevel(int $wf_step_level) Return the first ChildWfRequests filtered by the wf_step_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfReqStatus(int $wf_req_status) Return the first ChildWfRequests filtered by the wf_req_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfReqEmployee(int $wf_req_employee) Return the first ChildWfRequests filtered by the wf_req_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfDesc(string $wf_desc) Return the first ChildWfRequests filtered by the wf_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfRoute(string $wf_route) Return the first ChildWfRequests filtered by the wf_route column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByCreatedAt(string $created_at) Return the first ChildWfRequests filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWfRequests requireOneByWfEscalationDate(string $wf_escalation_date) Return the first ChildWfRequests filtered by the wf_escalation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWfRequests[]|Collection find(?ConnectionInterface $con = null) Return ChildWfRequests objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWfRequests> find(?ConnectionInterface $con = null) Return ChildWfRequests objects based on current ModelCriteria
 *
 * @method     ChildWfRequests[]|Collection findByWfReqId(int|array<int> $wf_req_id) Return ChildWfRequests objects filtered by the wf_req_id column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfReqId(int|array<int> $wf_req_id) Return ChildWfRequests objects filtered by the wf_req_id column
 * @method     ChildWfRequests[]|Collection findByWfCompanyId(int|array<int> $wf_company_id) Return ChildWfRequests objects filtered by the wf_company_id column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfCompanyId(int|array<int> $wf_company_id) Return ChildWfRequests objects filtered by the wf_company_id column
 * @method     ChildWfRequests[]|Collection findByWfId(int|array<int> $wf_id) Return ChildWfRequests objects filtered by the wf_id column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfId(int|array<int> $wf_id) Return ChildWfRequests objects filtered by the wf_id column
 * @method     ChildWfRequests[]|Collection findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfRequests objects filtered by the wf_doc_id column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfDocId(int|array<int> $wf_doc_id) Return ChildWfRequests objects filtered by the wf_doc_id column
 * @method     ChildWfRequests[]|Collection findByWfDocPk(int|array<int> $wf_doc_pk) Return ChildWfRequests objects filtered by the wf_doc_pk column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfDocPk(int|array<int> $wf_doc_pk) Return ChildWfRequests objects filtered by the wf_doc_pk column
 * @method     ChildWfRequests[]|Collection findByWfDocStatus(int|array<int> $wf_doc_status) Return ChildWfRequests objects filtered by the wf_doc_status column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfDocStatus(int|array<int> $wf_doc_status) Return ChildWfRequests objects filtered by the wf_doc_status column
 * @method     ChildWfRequests[]|Collection findByWfEntityName(string|array<string> $wf_entity_name) Return ChildWfRequests objects filtered by the wf_entity_name column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfEntityName(string|array<string> $wf_entity_name) Return ChildWfRequests objects filtered by the wf_entity_name column
 * @method     ChildWfRequests[]|Collection findByWfOriginEmployee(int|array<int> $wf_origin_employee) Return ChildWfRequests objects filtered by the wf_origin_employee column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfOriginEmployee(int|array<int> $wf_origin_employee) Return ChildWfRequests objects filtered by the wf_origin_employee column
 * @method     ChildWfRequests[]|Collection findByWfStepId(int|array<int> $wf_step_id) Return ChildWfRequests objects filtered by the wf_step_id column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfStepId(int|array<int> $wf_step_id) Return ChildWfRequests objects filtered by the wf_step_id column
 * @method     ChildWfRequests[]|Collection findByWfStepLevel(int|array<int> $wf_step_level) Return ChildWfRequests objects filtered by the wf_step_level column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfStepLevel(int|array<int> $wf_step_level) Return ChildWfRequests objects filtered by the wf_step_level column
 * @method     ChildWfRequests[]|Collection findByWfReqStatus(int|array<int> $wf_req_status) Return ChildWfRequests objects filtered by the wf_req_status column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfReqStatus(int|array<int> $wf_req_status) Return ChildWfRequests objects filtered by the wf_req_status column
 * @method     ChildWfRequests[]|Collection findByWfReqEmployee(int|array<int> $wf_req_employee) Return ChildWfRequests objects filtered by the wf_req_employee column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfReqEmployee(int|array<int> $wf_req_employee) Return ChildWfRequests objects filtered by the wf_req_employee column
 * @method     ChildWfRequests[]|Collection findByWfDesc(string|array<string> $wf_desc) Return ChildWfRequests objects filtered by the wf_desc column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfDesc(string|array<string> $wf_desc) Return ChildWfRequests objects filtered by the wf_desc column
 * @method     ChildWfRequests[]|Collection findByWfRoute(string|array<string> $wf_route) Return ChildWfRequests objects filtered by the wf_route column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfRoute(string|array<string> $wf_route) Return ChildWfRequests objects filtered by the wf_route column
 * @method     ChildWfRequests[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWfRequests objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByCreatedAt(string|array<string> $created_at) Return ChildWfRequests objects filtered by the created_at column
 * @method     ChildWfRequests[]|Collection findByWfEscalationDate(string|array<string> $wf_escalation_date) Return ChildWfRequests objects filtered by the wf_escalation_date column
 * @psalm-method Collection&\Traversable<ChildWfRequests> findByWfEscalationDate(string|array<string> $wf_escalation_date) Return ChildWfRequests objects filtered by the wf_escalation_date column
 *
 * @method     ChildWfRequests[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWfRequests> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WfRequestsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WfRequestsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WfRequests', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWfRequestsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWfRequestsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWfRequestsQuery) {
            return $criteria;
        }
        $query = new ChildWfRequestsQuery();
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
     * @return ChildWfRequests|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WfRequestsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWfRequests A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wf_req_id, wf_company_id, wf_id, wf_doc_id, wf_doc_pk, wf_doc_status, wf_entity_name, wf_origin_employee, wf_step_id, wf_step_level, wf_req_status, wf_req_employee, wf_desc, wf_route, created_at, wf_escalation_date FROM wf_requests WHERE wf_req_id = :p0';
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
            /** @var ChildWfRequests $obj */
            $obj = new ChildWfRequests();
            $obj->hydrate($row);
            WfRequestsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWfRequests|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the wf_req_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfReqId(1234); // WHERE wf_req_id = 1234
     * $query->filterByWfReqId(array(12, 34)); // WHERE wf_req_id IN (12, 34)
     * $query->filterByWfReqId(array('min' => 12)); // WHERE wf_req_id > 12
     * </code>
     *
     * @param mixed $wfReqId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfReqId($wfReqId = null, ?string $comparison = null)
    {
        if (is_array($wfReqId)) {
            $useMinMax = false;
            if (isset($wfReqId['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $wfReqId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfReqId['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $wfReqId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $wfReqId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfCompanyId(1234); // WHERE wf_company_id = 1234
     * $query->filterByWfCompanyId(array(12, 34)); // WHERE wf_company_id IN (12, 34)
     * $query->filterByWfCompanyId(array('min' => 12)); // WHERE wf_company_id > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param mixed $wfCompanyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfCompanyId($wfCompanyId = null, ?string $comparison = null)
    {
        if (is_array($wfCompanyId)) {
            $useMinMax = false;
            if (isset($wfCompanyId['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_COMPANY_ID, $wfCompanyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfCompanyId['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_COMPANY_ID, $wfCompanyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_COMPANY_ID, $wfCompanyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfId(1234); // WHERE wf_id = 1234
     * $query->filterByWfId(array(12, 34)); // WHERE wf_id IN (12, 34)
     * $query->filterByWfId(array('min' => 12)); // WHERE wf_id > 12
     * </code>
     *
     * @see       filterByWfMaster()
     *
     * @param mixed $wfId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfId($wfId = null, ?string $comparison = null)
    {
        if (is_array($wfId)) {
            $useMinMax = false;
            if (isset($wfId['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ID, $wfId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfId['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ID, $wfId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_ID, $wfId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocId(1234); // WHERE wf_doc_id = 1234
     * $query->filterByWfDocId(array(12, 34)); // WHERE wf_doc_id IN (12, 34)
     * $query->filterByWfDocId(array('min' => 12)); // WHERE wf_doc_id > 12
     * </code>
     *
     * @see       filterByWfDocuments()
     *
     * @param mixed $wfDocId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocId($wfDocId = null, ?string $comparison = null)
    {
        if (is_array($wfDocId)) {
            $useMinMax = false;
            if (isset($wfDocId['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_ID, $wfDocId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocId['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_ID, $wfDocId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_ID, $wfDocId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocPk(1234); // WHERE wf_doc_pk = 1234
     * $query->filterByWfDocPk(array(12, 34)); // WHERE wf_doc_pk IN (12, 34)
     * $query->filterByWfDocPk(array('min' => 12)); // WHERE wf_doc_pk > 12
     * </code>
     *
     * @param mixed $wfDocPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocPk($wfDocPk = null, ?string $comparison = null)
    {
        if (is_array($wfDocPk)) {
            $useMinMax = false;
            if (isset($wfDocPk['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_PK, $wfDocPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocPk['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_PK, $wfDocPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_PK, $wfDocPk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_doc_status column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDocStatus(1234); // WHERE wf_doc_status = 1234
     * $query->filterByWfDocStatus(array(12, 34)); // WHERE wf_doc_status IN (12, 34)
     * $query->filterByWfDocStatus(array('min' => 12)); // WHERE wf_doc_status > 12
     * </code>
     *
     * @param mixed $wfDocStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocStatus($wfDocStatus = null, ?string $comparison = null)
    {
        if (is_array($wfDocStatus)) {
            $useMinMax = false;
            if (isset($wfDocStatus['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_STATUS, $wfDocStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfDocStatus['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_STATUS, $wfDocStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_STATUS, $wfDocStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_entity_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWfEntityName('fooValue');   // WHERE wf_entity_name = 'fooValue'
     * $query->filterByWfEntityName('%fooValue%', Criteria::LIKE); // WHERE wf_entity_name LIKE '%fooValue%'
     * $query->filterByWfEntityName(['foo', 'bar']); // WHERE wf_entity_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfEntityName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfEntityName($wfEntityName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfEntityName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_ENTITY_NAME, $wfEntityName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_origin_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByWfOriginEmployee(1234); // WHERE wf_origin_employee = 1234
     * $query->filterByWfOriginEmployee(array(12, 34)); // WHERE wf_origin_employee IN (12, 34)
     * $query->filterByWfOriginEmployee(array('min' => 12)); // WHERE wf_origin_employee > 12
     * </code>
     *
     * @param mixed $wfOriginEmployee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfOriginEmployee($wfOriginEmployee = null, ?string $comparison = null)
    {
        if (is_array($wfOriginEmployee)) {
            $useMinMax = false;
            if (isset($wfOriginEmployee['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE, $wfOriginEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfOriginEmployee['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE, $wfOriginEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE, $wfOriginEmployee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_step_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStepId(1234); // WHERE wf_step_id = 1234
     * $query->filterByWfStepId(array(12, 34)); // WHERE wf_step_id IN (12, 34)
     * $query->filterByWfStepId(array('min' => 12)); // WHERE wf_step_id > 12
     * </code>
     *
     * @see       filterByWfSteps()
     *
     * @param mixed $wfStepId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStepId($wfStepId = null, ?string $comparison = null)
    {
        if (is_array($wfStepId)) {
            $useMinMax = false;
            if (isset($wfStepId['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_ID, $wfStepId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfStepId['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_ID, $wfStepId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_ID, $wfStepId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_step_level column
     *
     * Example usage:
     * <code>
     * $query->filterByWfStepLevel(1234); // WHERE wf_step_level = 1234
     * $query->filterByWfStepLevel(array(12, 34)); // WHERE wf_step_level IN (12, 34)
     * $query->filterByWfStepLevel(array('min' => 12)); // WHERE wf_step_level > 12
     * </code>
     *
     * @param mixed $wfStepLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfStepLevel($wfStepLevel = null, ?string $comparison = null)
    {
        if (is_array($wfStepLevel)) {
            $useMinMax = false;
            if (isset($wfStepLevel['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_LEVEL, $wfStepLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfStepLevel['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_LEVEL, $wfStepLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_LEVEL, $wfStepLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_req_status column
     *
     * Example usage:
     * <code>
     * $query->filterByWfReqStatus(1234); // WHERE wf_req_status = 1234
     * $query->filterByWfReqStatus(array(12, 34)); // WHERE wf_req_status IN (12, 34)
     * $query->filterByWfReqStatus(array('min' => 12)); // WHERE wf_req_status > 12
     * </code>
     *
     * @param mixed $wfReqStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfReqStatus($wfReqStatus = null, ?string $comparison = null)
    {
        if (is_array($wfReqStatus)) {
            $useMinMax = false;
            if (isset($wfReqStatus['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_STATUS, $wfReqStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfReqStatus['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_STATUS, $wfReqStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_STATUS, $wfReqStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_req_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByWfReqEmployee(1234); // WHERE wf_req_employee = 1234
     * $query->filterByWfReqEmployee(array(12, 34)); // WHERE wf_req_employee IN (12, 34)
     * $query->filterByWfReqEmployee(array('min' => 12)); // WHERE wf_req_employee > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $wfReqEmployee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfReqEmployee($wfReqEmployee = null, ?string $comparison = null)
    {
        if (is_array($wfReqEmployee)) {
            $useMinMax = false;
            if (isset($wfReqEmployee['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $wfReqEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfReqEmployee['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $wfReqEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $wfReqEmployee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByWfDesc('fooValue');   // WHERE wf_desc = 'fooValue'
     * $query->filterByWfDesc('%fooValue%', Criteria::LIKE); // WHERE wf_desc LIKE '%fooValue%'
     * $query->filterByWfDesc(['foo', 'bar']); // WHERE wf_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDesc($wfDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_DESC, $wfDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_route column
     *
     * Example usage:
     * <code>
     * $query->filterByWfRoute('fooValue');   // WHERE wf_route = 'fooValue'
     * $query->filterByWfRoute('%fooValue%', Criteria::LIKE); // WHERE wf_route LIKE '%fooValue%'
     * $query->filterByWfRoute(['foo', 'bar']); // WHERE wf_route IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $wfRoute The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRoute($wfRoute = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($wfRoute)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_ROUTE, $wfRoute, $comparison);

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
                $this->addUsingAlias(WfRequestsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the wf_escalation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByWfEscalationDate('2011-03-14'); // WHERE wf_escalation_date = '2011-03-14'
     * $query->filterByWfEscalationDate('now'); // WHERE wf_escalation_date = '2011-03-14'
     * $query->filterByWfEscalationDate(array('max' => 'yesterday')); // WHERE wf_escalation_date > '2011-03-13'
     * </code>
     *
     * @param mixed $wfEscalationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfEscalationDate($wfEscalationDate = null, ?string $comparison = null)
    {
        if (is_array($wfEscalationDate)) {
            $useMinMax = false;
            if (isset($wfEscalationDate['min'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ESCALATION_DATE, $wfEscalationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wfEscalationDate['max'])) {
                $this->addUsingAlias(WfRequestsTableMap::COL_WF_ESCALATION_DATE, $wfEscalationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WfRequestsTableMap::COL_WF_ESCALATION_DATE, $wfEscalationDate, $comparison);

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
                ->addUsingAlias(WfRequestsTableMap::COL_WF_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
     * Filter the query by a related \entities\WfDocuments object
     *
     * @param \entities\WfDocuments|ObjectCollection $wfDocuments The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfDocuments($wfDocuments, ?string $comparison = null)
    {
        if ($wfDocuments instanceof \entities\WfDocuments) {
            return $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_ID, $wfDocuments->getWfDocId(), $comparison);
        } elseif ($wfDocuments instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_DOC_ID, $wfDocuments->toKeyValue('PrimaryKey', 'WfDocId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfDocuments() only accepts arguments of type \entities\WfDocuments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfDocuments relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfDocuments(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfDocuments');

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
            $this->addJoinObject($join, 'WfDocuments');
        }

        return $this;
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfDocumentsQuery A secondary query class using the current class as primary query
     */
    public function useWfDocumentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfDocuments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfDocuments', '\entities\WfDocumentsQuery');
    }

    /**
     * Use the WfDocuments relation WfDocuments object
     *
     * @param callable(\entities\WfDocumentsQuery):\entities\WfDocumentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfDocumentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfDocumentsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfDocuments table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfDocumentsQuery The inner query object of the EXISTS statement
     */
    public function useWfDocumentsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT EXISTS query.
     *
     * @see useWfDocumentsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfDocumentsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useExistsQuery('WfDocuments', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfDocumentsQuery The inner query object of the IN statement
     */
    public function useInWfDocumentsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfDocuments table for a NOT IN query.
     *
     * @see useWfDocumentsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfDocumentsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfDocumentsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfDocumentsQuery */
        $q = $this->useInQuery('WfDocuments', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfMaster object
     *
     * @param \entities\WfMaster|ObjectCollection $wfMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfMaster($wfMaster, ?string $comparison = null)
    {
        if ($wfMaster instanceof \entities\WfMaster) {
            return $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_ID, $wfMaster->getWfId(), $comparison);
        } elseif ($wfMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_ID, $wfMaster->toKeyValue('PrimaryKey', 'WfId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfMaster() only accepts arguments of type \entities\WfMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfMaster');

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
            $this->addJoinObject($join, 'WfMaster');
        }

        return $this;
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfMasterQuery A secondary query class using the current class as primary query
     */
    public function useWfMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfMaster', '\entities\WfMasterQuery');
    }

    /**
     * Use the WfMaster relation WfMaster object
     *
     * @param callable(\entities\WfMasterQuery):\entities\WfMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfMasterQuery The inner query object of the EXISTS statement
     */
    public function useWfMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT EXISTS query.
     *
     * @see useWfMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useExistsQuery('WfMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfMasterQuery The inner query object of the IN statement
     */
    public function useInWfMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfMaster table for a NOT IN query.
     *
     * @see useWfMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfMasterQuery */
        $q = $this->useInQuery('WfMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfSteps object
     *
     * @param \entities\WfSteps|ObjectCollection $wfSteps The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfSteps($wfSteps, ?string $comparison = null)
    {
        if ($wfSteps instanceof \entities\WfSteps) {
            return $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_ID, $wfSteps->getWfStepsId(), $comparison);
        } elseif ($wfSteps instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WfRequestsTableMap::COL_WF_STEP_ID, $wfSteps->toKeyValue('PrimaryKey', 'WfStepsId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWfSteps() only accepts arguments of type \entities\WfSteps or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfSteps relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfSteps(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfSteps');

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
            $this->addJoinObject($join, 'WfSteps');
        }

        return $this;
    }

    /**
     * Use the WfSteps relation WfSteps object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfStepsQuery A secondary query class using the current class as primary query
     */
    public function useWfStepsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfSteps($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfSteps', '\entities\WfStepsQuery');
    }

    /**
     * Use the WfSteps relation WfSteps object
     *
     * @param callable(\entities\WfStepsQuery):\entities\WfStepsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfStepsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfStepsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfSteps table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfStepsQuery The inner query object of the EXISTS statement
     */
    public function useWfStepsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useExistsQuery('WfSteps', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfSteps table for a NOT EXISTS query.
     *
     * @see useWfStepsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStepsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfStepsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useExistsQuery('WfSteps', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfSteps table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfStepsQuery The inner query object of the IN statement
     */
    public function useInWfStepsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useInQuery('WfSteps', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfSteps table for a NOT IN query.
     *
     * @see useWfStepsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfStepsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfStepsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfStepsQuery */
        $q = $this->useInQuery('WfSteps', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWfRequests $wfRequests Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($wfRequests = null)
    {
        if ($wfRequests) {
            $this->addUsingAlias(WfRequestsTableMap::COL_WF_REQ_ID, $wfRequests->getWfReqId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wf_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WfRequestsTableMap::clearInstancePool();
            WfRequestsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WfRequestsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WfRequestsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WfRequestsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

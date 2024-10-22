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
use entities\SystemConfigs as ChildSystemConfigs;
use entities\SystemConfigsQuery as ChildSystemConfigsQuery;
use entities\Map\SystemConfigsTableMap;

/**
 * Base class that represents a query for the `system_configs` table.
 *
 * @method     ChildSystemConfigsQuery orderByConfigId($order = Criteria::ASC) Order by the config_id column
 * @method     ChildSystemConfigsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSystemConfigsQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildSystemConfigsQuery orderByModuleName($order = Criteria::ASC) Order by the module_name column
 * @method     ChildSystemConfigsQuery orderByConfigKey($order = Criteria::ASC) Order by the config_key column
 * @method     ChildSystemConfigsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSystemConfigsQuery orderByDataType($order = Criteria::ASC) Order by the data_type column
 * @method     ChildSystemConfigsQuery orderByConfigOptions($order = Criteria::ASC) Order by the config_options column
 * @method     ChildSystemConfigsQuery orderByConfigDefault($order = Criteria::ASC) Order by the config_default column
 * @method     ChildSystemConfigsQuery orderByConfigValue($order = Criteria::ASC) Order by the config_value column
 * @method     ChildSystemConfigsQuery orderByConfigScope($order = Criteria::ASC) Order by the config_scope column
 * @method     ChildSystemConfigsQuery orderByDependentConfigKey($order = Criteria::ASC) Order by the dependent_config_key column
 * @method     ChildSystemConfigsQuery orderByDependentConfigKeyValue($order = Criteria::ASC) Order by the dependent_config_key_value column
 * @method     ChildSystemConfigsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSystemConfigsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSystemConfigsQuery orderByIsApp($order = Criteria::ASC) Order by the is_app column
 *
 * @method     ChildSystemConfigsQuery groupByConfigId() Group by the config_id column
 * @method     ChildSystemConfigsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSystemConfigsQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildSystemConfigsQuery groupByModuleName() Group by the module_name column
 * @method     ChildSystemConfigsQuery groupByConfigKey() Group by the config_key column
 * @method     ChildSystemConfigsQuery groupByDescription() Group by the description column
 * @method     ChildSystemConfigsQuery groupByDataType() Group by the data_type column
 * @method     ChildSystemConfigsQuery groupByConfigOptions() Group by the config_options column
 * @method     ChildSystemConfigsQuery groupByConfigDefault() Group by the config_default column
 * @method     ChildSystemConfigsQuery groupByConfigValue() Group by the config_value column
 * @method     ChildSystemConfigsQuery groupByConfigScope() Group by the config_scope column
 * @method     ChildSystemConfigsQuery groupByDependentConfigKey() Group by the dependent_config_key column
 * @method     ChildSystemConfigsQuery groupByDependentConfigKeyValue() Group by the dependent_config_key_value column
 * @method     ChildSystemConfigsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSystemConfigsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSystemConfigsQuery groupByIsApp() Group by the is_app column
 *
 * @method     ChildSystemConfigsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSystemConfigsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSystemConfigsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSystemConfigsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSystemConfigsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSystemConfigsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSystemConfigs|null findOne(?ConnectionInterface $con = null) Return the first ChildSystemConfigs matching the query
 * @method     ChildSystemConfigs findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSystemConfigs matching the query, or a new ChildSystemConfigs object populated from the query conditions when no match is found
 *
 * @method     ChildSystemConfigs|null findOneByConfigId(int $config_id) Return the first ChildSystemConfigs filtered by the config_id column
 * @method     ChildSystemConfigs|null findOneByCompanyId(int $company_id) Return the first ChildSystemConfigs filtered by the company_id column
 * @method     ChildSystemConfigs|null findOneByOrgunitId(int $orgunit_id) Return the first ChildSystemConfigs filtered by the orgunit_id column
 * @method     ChildSystemConfigs|null findOneByModuleName(string $module_name) Return the first ChildSystemConfigs filtered by the module_name column
 * @method     ChildSystemConfigs|null findOneByConfigKey(string $config_key) Return the first ChildSystemConfigs filtered by the config_key column
 * @method     ChildSystemConfigs|null findOneByDescription(string $description) Return the first ChildSystemConfigs filtered by the description column
 * @method     ChildSystemConfigs|null findOneByDataType(string $data_type) Return the first ChildSystemConfigs filtered by the data_type column
 * @method     ChildSystemConfigs|null findOneByConfigOptions(string $config_options) Return the first ChildSystemConfigs filtered by the config_options column
 * @method     ChildSystemConfigs|null findOneByConfigDefault(string $config_default) Return the first ChildSystemConfigs filtered by the config_default column
 * @method     ChildSystemConfigs|null findOneByConfigValue(string $config_value) Return the first ChildSystemConfigs filtered by the config_value column
 * @method     ChildSystemConfigs|null findOneByConfigScope(string $config_scope) Return the first ChildSystemConfigs filtered by the config_scope column
 * @method     ChildSystemConfigs|null findOneByDependentConfigKey(string $dependent_config_key) Return the first ChildSystemConfigs filtered by the dependent_config_key column
 * @method     ChildSystemConfigs|null findOneByDependentConfigKeyValue(string $dependent_config_key_value) Return the first ChildSystemConfigs filtered by the dependent_config_key_value column
 * @method     ChildSystemConfigs|null findOneByCreatedAt(string $created_at) Return the first ChildSystemConfigs filtered by the created_at column
 * @method     ChildSystemConfigs|null findOneByUpdatedAt(string $updated_at) Return the first ChildSystemConfigs filtered by the updated_at column
 * @method     ChildSystemConfigs|null findOneByIsApp(boolean $is_app) Return the first ChildSystemConfigs filtered by the is_app column
 *
 * @method     ChildSystemConfigs requirePk($key, ?ConnectionInterface $con = null) Return the ChildSystemConfigs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOne(?ConnectionInterface $con = null) Return the first ChildSystemConfigs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemConfigs requireOneByConfigId(int $config_id) Return the first ChildSystemConfigs filtered by the config_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByCompanyId(int $company_id) Return the first ChildSystemConfigs filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByOrgunitId(int $orgunit_id) Return the first ChildSystemConfigs filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByModuleName(string $module_name) Return the first ChildSystemConfigs filtered by the module_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByConfigKey(string $config_key) Return the first ChildSystemConfigs filtered by the config_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByDescription(string $description) Return the first ChildSystemConfigs filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByDataType(string $data_type) Return the first ChildSystemConfigs filtered by the data_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByConfigOptions(string $config_options) Return the first ChildSystemConfigs filtered by the config_options column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByConfigDefault(string $config_default) Return the first ChildSystemConfigs filtered by the config_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByConfigValue(string $config_value) Return the first ChildSystemConfigs filtered by the config_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByConfigScope(string $config_scope) Return the first ChildSystemConfigs filtered by the config_scope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByDependentConfigKey(string $dependent_config_key) Return the first ChildSystemConfigs filtered by the dependent_config_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByDependentConfigKeyValue(string $dependent_config_key_value) Return the first ChildSystemConfigs filtered by the dependent_config_key_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByCreatedAt(string $created_at) Return the first ChildSystemConfigs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByUpdatedAt(string $updated_at) Return the first ChildSystemConfigs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemConfigs requireOneByIsApp(boolean $is_app) Return the first ChildSystemConfigs filtered by the is_app column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemConfigs[]|Collection find(?ConnectionInterface $con = null) Return ChildSystemConfigs objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> find(?ConnectionInterface $con = null) Return ChildSystemConfigs objects based on current ModelCriteria
 *
 * @method     ChildSystemConfigs[]|Collection findByConfigId(int|array<int> $config_id) Return ChildSystemConfigs objects filtered by the config_id column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigId(int|array<int> $config_id) Return ChildSystemConfigs objects filtered by the config_id column
 * @method     ChildSystemConfigs[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSystemConfigs objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByCompanyId(int|array<int> $company_id) Return ChildSystemConfigs objects filtered by the company_id column
 * @method     ChildSystemConfigs[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildSystemConfigs objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByOrgunitId(int|array<int> $orgunit_id) Return ChildSystemConfigs objects filtered by the orgunit_id column
 * @method     ChildSystemConfigs[]|Collection findByModuleName(string|array<string> $module_name) Return ChildSystemConfigs objects filtered by the module_name column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByModuleName(string|array<string> $module_name) Return ChildSystemConfigs objects filtered by the module_name column
 * @method     ChildSystemConfigs[]|Collection findByConfigKey(string|array<string> $config_key) Return ChildSystemConfigs objects filtered by the config_key column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigKey(string|array<string> $config_key) Return ChildSystemConfigs objects filtered by the config_key column
 * @method     ChildSystemConfigs[]|Collection findByDescription(string|array<string> $description) Return ChildSystemConfigs objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByDescription(string|array<string> $description) Return ChildSystemConfigs objects filtered by the description column
 * @method     ChildSystemConfigs[]|Collection findByDataType(string|array<string> $data_type) Return ChildSystemConfigs objects filtered by the data_type column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByDataType(string|array<string> $data_type) Return ChildSystemConfigs objects filtered by the data_type column
 * @method     ChildSystemConfigs[]|Collection findByConfigOptions(string|array<string> $config_options) Return ChildSystemConfigs objects filtered by the config_options column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigOptions(string|array<string> $config_options) Return ChildSystemConfigs objects filtered by the config_options column
 * @method     ChildSystemConfigs[]|Collection findByConfigDefault(string|array<string> $config_default) Return ChildSystemConfigs objects filtered by the config_default column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigDefault(string|array<string> $config_default) Return ChildSystemConfigs objects filtered by the config_default column
 * @method     ChildSystemConfigs[]|Collection findByConfigValue(string|array<string> $config_value) Return ChildSystemConfigs objects filtered by the config_value column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigValue(string|array<string> $config_value) Return ChildSystemConfigs objects filtered by the config_value column
 * @method     ChildSystemConfigs[]|Collection findByConfigScope(string|array<string> $config_scope) Return ChildSystemConfigs objects filtered by the config_scope column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByConfigScope(string|array<string> $config_scope) Return ChildSystemConfigs objects filtered by the config_scope column
 * @method     ChildSystemConfigs[]|Collection findByDependentConfigKey(string|array<string> $dependent_config_key) Return ChildSystemConfigs objects filtered by the dependent_config_key column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByDependentConfigKey(string|array<string> $dependent_config_key) Return ChildSystemConfigs objects filtered by the dependent_config_key column
 * @method     ChildSystemConfigs[]|Collection findByDependentConfigKeyValue(string|array<string> $dependent_config_key_value) Return ChildSystemConfigs objects filtered by the dependent_config_key_value column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByDependentConfigKeyValue(string|array<string> $dependent_config_key_value) Return ChildSystemConfigs objects filtered by the dependent_config_key_value column
 * @method     ChildSystemConfigs[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSystemConfigs objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByCreatedAt(string|array<string> $created_at) Return ChildSystemConfigs objects filtered by the created_at column
 * @method     ChildSystemConfigs[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSystemConfigs objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByUpdatedAt(string|array<string> $updated_at) Return ChildSystemConfigs objects filtered by the updated_at column
 * @method     ChildSystemConfigs[]|Collection findByIsApp(boolean|array<boolean> $is_app) Return ChildSystemConfigs objects filtered by the is_app column
 * @psalm-method Collection&\Traversable<ChildSystemConfigs> findByIsApp(boolean|array<boolean> $is_app) Return ChildSystemConfigs objects filtered by the is_app column
 *
 * @method     ChildSystemConfigs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSystemConfigs> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SystemConfigsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SystemConfigsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SystemConfigs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSystemConfigsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSystemConfigsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSystemConfigsQuery) {
            return $criteria;
        }
        $query = new ChildSystemConfigsQuery();
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
     * @return ChildSystemConfigs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SystemConfigsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SystemConfigsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSystemConfigs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT config_id, company_id, orgunit_id, module_name, config_key, description, data_type, config_options, config_default, config_value, config_scope, dependent_config_key, dependent_config_key_value, created_at, updated_at, is_app FROM system_configs WHERE config_id = :p0';
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
            /** @var ChildSystemConfigs $obj */
            $obj = new ChildSystemConfigs();
            $obj->hydrate($row);
            SystemConfigsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSystemConfigs|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the config_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigId(1234); // WHERE config_id = 1234
     * $query->filterByConfigId(array(12, 34)); // WHERE config_id IN (12, 34)
     * $query->filterByConfigId(array('min' => 12)); // WHERE config_id > 12
     * </code>
     *
     * @param mixed $configId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigId($configId = null, ?string $comparison = null)
    {
        if (is_array($configId)) {
            $useMinMax = false;
            if (isset($configId['min'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $configId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($configId['max'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $configId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $configId, $comparison);

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
                $this->addUsingAlias(SystemConfigsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitId(1234); // WHERE orgunit_id = 1234
     * $query->filterByOrgunitId(array(12, 34)); // WHERE orgunit_id IN (12, 34)
     * $query->filterByOrgunitId(array('min' => 12)); // WHERE orgunit_id > 12
     * </code>
     *
     * @param mixed $orgunitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitId($orgunitId = null, ?string $comparison = null)
    {
        if (is_array($orgunitId)) {
            $useMinMax = false;
            if (isset($orgunitId['min'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the module_name column
     *
     * Example usage:
     * <code>
     * $query->filterByModuleName('fooValue');   // WHERE module_name = 'fooValue'
     * $query->filterByModuleName('%fooValue%', Criteria::LIKE); // WHERE module_name LIKE '%fooValue%'
     * $query->filterByModuleName(['foo', 'bar']); // WHERE module_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moduleName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByModuleName($moduleName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moduleName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_MODULE_NAME, $moduleName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the config_key column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigKey('fooValue');   // WHERE config_key = 'fooValue'
     * $query->filterByConfigKey('%fooValue%', Criteria::LIKE); // WHERE config_key LIKE '%fooValue%'
     * $query->filterByConfigKey(['foo', 'bar']); // WHERE config_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $configKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigKey($configKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_KEY, $configKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_DESCRIPTION, $description, $comparison);

        return $this;
    }

    /**
     * Filter the query on the data_type column
     *
     * Example usage:
     * <code>
     * $query->filterByDataType('fooValue');   // WHERE data_type = 'fooValue'
     * $query->filterByDataType('%fooValue%', Criteria::LIKE); // WHERE data_type LIKE '%fooValue%'
     * $query->filterByDataType(['foo', 'bar']); // WHERE data_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dataType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataType($dataType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dataType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_DATA_TYPE, $dataType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the config_options column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigOptions('fooValue');   // WHERE config_options = 'fooValue'
     * $query->filterByConfigOptions('%fooValue%', Criteria::LIKE); // WHERE config_options LIKE '%fooValue%'
     * $query->filterByConfigOptions(['foo', 'bar']); // WHERE config_options IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $configOptions The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigOptions($configOptions = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configOptions)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_OPTIONS, $configOptions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the config_default column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigDefault('fooValue');   // WHERE config_default = 'fooValue'
     * $query->filterByConfigDefault('%fooValue%', Criteria::LIKE); // WHERE config_default LIKE '%fooValue%'
     * $query->filterByConfigDefault(['foo', 'bar']); // WHERE config_default IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $configDefault The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigDefault($configDefault = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configDefault)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_DEFAULT, $configDefault, $comparison);

        return $this;
    }

    /**
     * Filter the query on the config_value column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigValue('fooValue');   // WHERE config_value = 'fooValue'
     * $query->filterByConfigValue('%fooValue%', Criteria::LIKE); // WHERE config_value LIKE '%fooValue%'
     * $query->filterByConfigValue(['foo', 'bar']); // WHERE config_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $configValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigValue($configValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_VALUE, $configValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the config_scope column
     *
     * Example usage:
     * <code>
     * $query->filterByConfigScope('fooValue');   // WHERE config_scope = 'fooValue'
     * $query->filterByConfigScope('%fooValue%', Criteria::LIKE); // WHERE config_scope LIKE '%fooValue%'
     * $query->filterByConfigScope(['foo', 'bar']); // WHERE config_scope IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $configScope The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfigScope($configScope = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($configScope)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_SCOPE, $configScope, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dependent_config_key column
     *
     * Example usage:
     * <code>
     * $query->filterByDependentConfigKey('fooValue');   // WHERE dependent_config_key = 'fooValue'
     * $query->filterByDependentConfigKey('%fooValue%', Criteria::LIKE); // WHERE dependent_config_key LIKE '%fooValue%'
     * $query->filterByDependentConfigKey(['foo', 'bar']); // WHERE dependent_config_key IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dependentConfigKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDependentConfigKey($dependentConfigKey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dependentConfigKey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY, $dependentConfigKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dependent_config_key_value column
     *
     * Example usage:
     * <code>
     * $query->filterByDependentConfigKeyValue('fooValue');   // WHERE dependent_config_key_value = 'fooValue'
     * $query->filterByDependentConfigKeyValue('%fooValue%', Criteria::LIKE); // WHERE dependent_config_key_value LIKE '%fooValue%'
     * $query->filterByDependentConfigKeyValue(['foo', 'bar']); // WHERE dependent_config_key_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dependentConfigKeyValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDependentConfigKeyValue($dependentConfigKeyValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dependentConfigKeyValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE, $dependentConfigKeyValue, $comparison);

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
                $this->addUsingAlias(SystemConfigsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SystemConfigsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SystemConfigsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_app column
     *
     * Example usage:
     * <code>
     * $query->filterByIsApp(true); // WHERE is_app = true
     * $query->filterByIsApp('yes'); // WHERE is_app = true
     * </code>
     *
     * @param bool|string $isApp The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsApp($isApp = null, ?string $comparison = null)
    {
        if (is_string($isApp)) {
            $isApp = in_array(strtolower($isApp), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(SystemConfigsTableMap::COL_IS_APP, $isApp, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSystemConfigs $systemConfigs Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($systemConfigs = null)
    {
        if ($systemConfigs) {
            $this->addUsingAlias(SystemConfigsTableMap::COL_CONFIG_ID, $systemConfigs->getConfigId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the system_configs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SystemConfigsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SystemConfigsTableMap::clearInstancePool();
            SystemConfigsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SystemConfigsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SystemConfigsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SystemConfigsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SystemConfigsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

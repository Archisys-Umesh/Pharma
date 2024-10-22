<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use entities\TerritoriesBackup as ChildTerritoriesBackup;
use entities\TerritoriesBackupQuery as ChildTerritoriesBackupQuery;
use entities\Map\TerritoriesBackupTableMap;

/**
 * Base class that represents a query for the `territories_backup` table.
 *
 * @method     ChildTerritoriesBackupQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildTerritoriesBackupQuery orderByTerritoryCode($order = Criteria::ASC) Order by the territory_code column
 * @method     ChildTerritoriesBackupQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildTerritoriesBackupQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildTerritoriesBackupQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildTerritoriesBackupQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildTerritoriesBackupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTerritoriesBackupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTerritoriesBackupQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildTerritoriesBackupQuery groupByTerritoryCode() Group by the territory_code column
 * @method     ChildTerritoriesBackupQuery groupByCompanyId() Group by the company_id column
 * @method     ChildTerritoriesBackupQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildTerritoriesBackupQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildTerritoriesBackupQuery groupByPositionId() Group by the position_id column
 * @method     ChildTerritoriesBackupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTerritoriesBackupQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTerritoriesBackupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTerritoriesBackupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTerritoriesBackupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTerritoriesBackupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTerritoriesBackupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTerritoriesBackupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTerritoriesBackup|null findOne(?ConnectionInterface $con = null) Return the first ChildTerritoriesBackup matching the query
 * @method     ChildTerritoriesBackup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTerritoriesBackup matching the query, or a new ChildTerritoriesBackup object populated from the query conditions when no match is found
 *
 * @method     ChildTerritoriesBackup|null findOneByTerritoryId(int $territory_id) Return the first ChildTerritoriesBackup filtered by the territory_id column
 * @method     ChildTerritoriesBackup|null findOneByTerritoryCode(string $territory_code) Return the first ChildTerritoriesBackup filtered by the territory_code column
 * @method     ChildTerritoriesBackup|null findOneByCompanyId(int $company_id) Return the first ChildTerritoriesBackup filtered by the company_id column
 * @method     ChildTerritoriesBackup|null findOneByTerritoryName(string $territory_name) Return the first ChildTerritoriesBackup filtered by the territory_name column
 * @method     ChildTerritoriesBackup|null findOneByOrgunitid(int $orgunitid) Return the first ChildTerritoriesBackup filtered by the orgunitid column
 * @method     ChildTerritoriesBackup|null findOneByPositionId(int $position_id) Return the first ChildTerritoriesBackup filtered by the position_id column
 * @method     ChildTerritoriesBackup|null findOneByCreatedAt(string $created_at) Return the first ChildTerritoriesBackup filtered by the created_at column
 * @method     ChildTerritoriesBackup|null findOneByUpdatedAt(string $updated_at) Return the first ChildTerritoriesBackup filtered by the updated_at column
 *
 * @method     ChildTerritoriesBackup requirePk($key, ?ConnectionInterface $con = null) Return the ChildTerritoriesBackup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOne(?ConnectionInterface $con = null) Return the first ChildTerritoriesBackup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritoriesBackup requireOneByTerritoryId(int $territory_id) Return the first ChildTerritoriesBackup filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByTerritoryCode(string $territory_code) Return the first ChildTerritoriesBackup filtered by the territory_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByCompanyId(int $company_id) Return the first ChildTerritoriesBackup filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByTerritoryName(string $territory_name) Return the first ChildTerritoriesBackup filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByOrgunitid(int $orgunitid) Return the first ChildTerritoriesBackup filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByPositionId(int $position_id) Return the first ChildTerritoriesBackup filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByCreatedAt(string $created_at) Return the first ChildTerritoriesBackup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTerritoriesBackup requireOneByUpdatedAt(string $updated_at) Return the first ChildTerritoriesBackup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTerritoriesBackup[]|Collection find(?ConnectionInterface $con = null) Return ChildTerritoriesBackup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> find(?ConnectionInterface $con = null) Return ChildTerritoriesBackup objects based on current ModelCriteria
 *
 * @method     ChildTerritoriesBackup[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildTerritoriesBackup objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByTerritoryId(int|array<int> $territory_id) Return ChildTerritoriesBackup objects filtered by the territory_id column
 * @method     ChildTerritoriesBackup[]|Collection findByTerritoryCode(string|array<string> $territory_code) Return ChildTerritoriesBackup objects filtered by the territory_code column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByTerritoryCode(string|array<string> $territory_code) Return ChildTerritoriesBackup objects filtered by the territory_code column
 * @method     ChildTerritoriesBackup[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildTerritoriesBackup objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByCompanyId(int|array<int> $company_id) Return ChildTerritoriesBackup objects filtered by the company_id column
 * @method     ChildTerritoriesBackup[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildTerritoriesBackup objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByTerritoryName(string|array<string> $territory_name) Return ChildTerritoriesBackup objects filtered by the territory_name column
 * @method     ChildTerritoriesBackup[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildTerritoriesBackup objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByOrgunitid(int|array<int> $orgunitid) Return ChildTerritoriesBackup objects filtered by the orgunitid column
 * @method     ChildTerritoriesBackup[]|Collection findByPositionId(int|array<int> $position_id) Return ChildTerritoriesBackup objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByPositionId(int|array<int> $position_id) Return ChildTerritoriesBackup objects filtered by the position_id column
 * @method     ChildTerritoriesBackup[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildTerritoriesBackup objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByCreatedAt(string|array<string> $created_at) Return ChildTerritoriesBackup objects filtered by the created_at column
 * @method     ChildTerritoriesBackup[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritoriesBackup objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildTerritoriesBackup> findByUpdatedAt(string|array<string> $updated_at) Return ChildTerritoriesBackup objects filtered by the updated_at column
 *
 * @method     ChildTerritoriesBackup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTerritoriesBackup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class TerritoriesBackupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\TerritoriesBackupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\TerritoriesBackup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTerritoriesBackupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTerritoriesBackupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTerritoriesBackupQuery) {
            return $criteria;
        }
        $query = new ChildTerritoriesBackupQuery();
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
     * @return ChildTerritoriesBackup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The TerritoriesBackup object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The TerritoriesBackup object has no primary key');
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
        throw new LogicException('The TerritoriesBackup object has no primary key');
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
        throw new LogicException('The TerritoriesBackup object has no primary key');
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_code column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryCode('fooValue');   // WHERE territory_code = 'fooValue'
     * $query->filterByTerritoryCode('%fooValue%', Criteria::LIKE); // WHERE territory_code LIKE '%fooValue%'
     * $query->filterByTerritoryCode(['foo', 'bar']); // WHERE territory_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryCode($territoryCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_TERRITORY_CODE, $territoryCode, $comparison);

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
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryName('fooValue');   // WHERE territory_name = 'fooValue'
     * $query->filterByTerritoryName('%fooValue%', Criteria::LIKE); // WHERE territory_name LIKE '%fooValue%'
     * $query->filterByTerritoryName(['foo', 'bar']); // WHERE territory_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryName($territoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionId(1234); // WHERE position_id = 1234
     * $query->filterByPositionId(array(12, 34)); // WHERE position_id IN (12, 34)
     * $query->filterByPositionId(array('min' => 12)); // WHERE position_id > 12
     * </code>
     *
     * @param mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, ?string $comparison = null)
    {
        if (is_array($positionId)) {
            $useMinMax = false;
            if (isset($positionId['min'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TerritoriesBackupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TerritoriesBackupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildTerritoriesBackup $territoriesBackup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($territoriesBackup = null)
    {
        if ($territoriesBackup) {
            throw new LogicException('TerritoriesBackup object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the territories_backup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesBackupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TerritoriesBackupTableMap::clearInstancePool();
            TerritoriesBackupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesBackupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TerritoriesBackupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TerritoriesBackupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TerritoriesBackupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

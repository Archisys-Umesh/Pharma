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
use entities\CheckInMedia as ChildCheckInMedia;
use entities\CheckInMediaQuery as ChildCheckInMediaQuery;
use entities\Map\CheckInMediaTableMap;

/**
 * Base class that represents a query for the `check_in_media` table.
 *
 * @method     ChildCheckInMediaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCheckInMediaQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildCheckInMediaQuery orderByEntityPk($order = Criteria::ASC) Order by the entity_pk column
 * @method     ChildCheckInMediaQuery orderByEntityName($order = Criteria::ASC) Order by the entity_name column
 * @method     ChildCheckInMediaQuery orderByPurpose($order = Criteria::ASC) Order by the purpose column
 * @method     ChildCheckInMediaQuery orderByGpsLocation($order = Criteria::ASC) Order by the gps_location column
 *
 * @method     ChildCheckInMediaQuery groupById() Group by the id column
 * @method     ChildCheckInMediaQuery groupByMediaId() Group by the media_id column
 * @method     ChildCheckInMediaQuery groupByEntityPk() Group by the entity_pk column
 * @method     ChildCheckInMediaQuery groupByEntityName() Group by the entity_name column
 * @method     ChildCheckInMediaQuery groupByPurpose() Group by the purpose column
 * @method     ChildCheckInMediaQuery groupByGpsLocation() Group by the gps_location column
 *
 * @method     ChildCheckInMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCheckInMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCheckInMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCheckInMediaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCheckInMediaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCheckInMediaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCheckInMediaQuery leftJoinMediaFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFiles relation
 * @method     ChildCheckInMediaQuery rightJoinMediaFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFiles relation
 * @method     ChildCheckInMediaQuery innerJoinMediaFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFiles relation
 *
 * @method     ChildCheckInMediaQuery joinWithMediaFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFiles relation
 *
 * @method     ChildCheckInMediaQuery leftJoinWithMediaFiles() Adds a LEFT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildCheckInMediaQuery rightJoinWithMediaFiles() Adds a RIGHT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildCheckInMediaQuery innerJoinWithMediaFiles() Adds a INNER JOIN clause and with to the query using the MediaFiles relation
 *
 * @method     \entities\MediaFilesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCheckInMedia|null findOne(?ConnectionInterface $con = null) Return the first ChildCheckInMedia matching the query
 * @method     ChildCheckInMedia findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCheckInMedia matching the query, or a new ChildCheckInMedia object populated from the query conditions when no match is found
 *
 * @method     ChildCheckInMedia|null findOneById(int $id) Return the first ChildCheckInMedia filtered by the id column
 * @method     ChildCheckInMedia|null findOneByMediaId(int $media_id) Return the first ChildCheckInMedia filtered by the media_id column
 * @method     ChildCheckInMedia|null findOneByEntityPk(int $entity_pk) Return the first ChildCheckInMedia filtered by the entity_pk column
 * @method     ChildCheckInMedia|null findOneByEntityName(string $entity_name) Return the first ChildCheckInMedia filtered by the entity_name column
 * @method     ChildCheckInMedia|null findOneByPurpose(string $purpose) Return the first ChildCheckInMedia filtered by the purpose column
 * @method     ChildCheckInMedia|null findOneByGpsLocation(string $gps_location) Return the first ChildCheckInMedia filtered by the gps_location column
 *
 * @method     ChildCheckInMedia requirePk($key, ?ConnectionInterface $con = null) Return the ChildCheckInMedia by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOne(?ConnectionInterface $con = null) Return the first ChildCheckInMedia matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckInMedia requireOneById(int $id) Return the first ChildCheckInMedia filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOneByMediaId(int $media_id) Return the first ChildCheckInMedia filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOneByEntityPk(int $entity_pk) Return the first ChildCheckInMedia filtered by the entity_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOneByEntityName(string $entity_name) Return the first ChildCheckInMedia filtered by the entity_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOneByPurpose(string $purpose) Return the first ChildCheckInMedia filtered by the purpose column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCheckInMedia requireOneByGpsLocation(string $gps_location) Return the first ChildCheckInMedia filtered by the gps_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCheckInMedia[]|Collection find(?ConnectionInterface $con = null) Return ChildCheckInMedia objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> find(?ConnectionInterface $con = null) Return ChildCheckInMedia objects based on current ModelCriteria
 *
 * @method     ChildCheckInMedia[]|Collection findById(int|array<int> $id) Return ChildCheckInMedia objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findById(int|array<int> $id) Return ChildCheckInMedia objects filtered by the id column
 * @method     ChildCheckInMedia[]|Collection findByMediaId(int|array<int> $media_id) Return ChildCheckInMedia objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findByMediaId(int|array<int> $media_id) Return ChildCheckInMedia objects filtered by the media_id column
 * @method     ChildCheckInMedia[]|Collection findByEntityPk(int|array<int> $entity_pk) Return ChildCheckInMedia objects filtered by the entity_pk column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findByEntityPk(int|array<int> $entity_pk) Return ChildCheckInMedia objects filtered by the entity_pk column
 * @method     ChildCheckInMedia[]|Collection findByEntityName(string|array<string> $entity_name) Return ChildCheckInMedia objects filtered by the entity_name column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findByEntityName(string|array<string> $entity_name) Return ChildCheckInMedia objects filtered by the entity_name column
 * @method     ChildCheckInMedia[]|Collection findByPurpose(string|array<string> $purpose) Return ChildCheckInMedia objects filtered by the purpose column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findByPurpose(string|array<string> $purpose) Return ChildCheckInMedia objects filtered by the purpose column
 * @method     ChildCheckInMedia[]|Collection findByGpsLocation(string|array<string> $gps_location) Return ChildCheckInMedia objects filtered by the gps_location column
 * @psalm-method Collection&\Traversable<ChildCheckInMedia> findByGpsLocation(string|array<string> $gps_location) Return ChildCheckInMedia objects filtered by the gps_location column
 *
 * @method     ChildCheckInMedia[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCheckInMedia> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CheckInMediaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CheckInMediaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CheckInMedia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCheckInMediaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCheckInMediaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCheckInMediaQuery) {
            return $criteria;
        }
        $query = new ChildCheckInMediaQuery();
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
     * @return ChildCheckInMedia|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CheckInMediaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CheckInMediaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCheckInMedia A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, media_id, entity_pk, entity_name, purpose, gps_location FROM check_in_media WHERE id = :p0';
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
            /** @var ChildCheckInMedia $obj */
            $obj = new ChildCheckInMedia();
            $obj->hydrate($row);
            CheckInMediaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCheckInMedia|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId(1234); // WHERE media_id = 1234
     * $query->filterByMediaId(array(12, 34)); // WHERE media_id IN (12, 34)
     * $query->filterByMediaId(array('min' => 12)); // WHERE media_id > 12
     * </code>
     *
     * @see       filterByMediaFiles()
     *
     * @param mixed $mediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, ?string $comparison = null)
    {
        if (is_array($mediaId)) {
            $useMinMax = false;
            if (isset($mediaId['min'])) {
                $this->addUsingAlias(CheckInMediaTableMap::COL_MEDIA_ID, $mediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediaId['max'])) {
                $this->addUsingAlias(CheckInMediaTableMap::COL_MEDIA_ID, $mediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_MEDIA_ID, $mediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the entity_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityPk(1234); // WHERE entity_pk = 1234
     * $query->filterByEntityPk(array(12, 34)); // WHERE entity_pk IN (12, 34)
     * $query->filterByEntityPk(array('min' => 12)); // WHERE entity_pk > 12
     * </code>
     *
     * @param mixed $entityPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntityPk($entityPk = null, ?string $comparison = null)
    {
        if (is_array($entityPk)) {
            $useMinMax = false;
            if (isset($entityPk['min'])) {
                $this->addUsingAlias(CheckInMediaTableMap::COL_ENTITY_PK, $entityPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entityPk['max'])) {
                $this->addUsingAlias(CheckInMediaTableMap::COL_ENTITY_PK, $entityPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_ENTITY_PK, $entityPk, $comparison);

        return $this;
    }

    /**
     * Filter the query on the entity_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityName('fooValue');   // WHERE entity_name = 'fooValue'
     * $query->filterByEntityName('%fooValue%', Criteria::LIKE); // WHERE entity_name LIKE '%fooValue%'
     * $query->filterByEntityName(['foo', 'bar']); // WHERE entity_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $entityName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEntityName($entityName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entityName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_ENTITY_NAME, $entityName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the purpose column
     *
     * Example usage:
     * <code>
     * $query->filterByPurpose('fooValue');   // WHERE purpose = 'fooValue'
     * $query->filterByPurpose('%fooValue%', Criteria::LIKE); // WHERE purpose LIKE '%fooValue%'
     * $query->filterByPurpose(['foo', 'bar']); // WHERE purpose IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $purpose The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPurpose($purpose = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($purpose)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_PURPOSE, $purpose, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gps_location column
     *
     * Example usage:
     * <code>
     * $query->filterByGpsLocation('fooValue');   // WHERE gps_location = 'fooValue'
     * $query->filterByGpsLocation('%fooValue%', Criteria::LIKE); // WHERE gps_location LIKE '%fooValue%'
     * $query->filterByGpsLocation(['foo', 'bar']); // WHERE gps_location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gpsLocation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGpsLocation($gpsLocation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gpsLocation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CheckInMediaTableMap::COL_GPS_LOCATION, $gpsLocation, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\MediaFiles object
     *
     * @param \entities\MediaFiles|ObjectCollection $mediaFiles The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFiles($mediaFiles, ?string $comparison = null)
    {
        if ($mediaFiles instanceof \entities\MediaFiles) {
            return $this
                ->addUsingAlias(CheckInMediaTableMap::COL_MEDIA_ID, $mediaFiles->getMediaId(), $comparison);
        } elseif ($mediaFiles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CheckInMediaTableMap::COL_MEDIA_ID, $mediaFiles->toKeyValue('PrimaryKey', 'MediaId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMediaFiles() only accepts arguments of type \entities\MediaFiles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFiles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFiles(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFiles');

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
            $this->addJoinObject($join, 'MediaFiles');
        }

        return $this;
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFilesQuery A secondary query class using the current class as primary query
     */
    public function useMediaFilesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMediaFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFiles', '\entities\MediaFilesQuery');
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @param callable(\entities\MediaFilesQuery):\entities\MediaFilesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFilesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMediaFilesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFiles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFilesQuery The inner query object of the EXISTS statement
     */
    public function useMediaFilesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT EXISTS query.
     *
     * @see useMediaFilesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFilesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFilesQuery The inner query object of the IN statement
     */
    public function useInMediaFilesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT IN query.
     *
     * @see useMediaFilesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFilesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCheckInMedia $checkInMedia Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($checkInMedia = null)
    {
        if ($checkInMedia) {
            $this->addUsingAlias(CheckInMediaTableMap::COL_ID, $checkInMedia->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the check_in_media table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CheckInMediaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CheckInMediaTableMap::clearInstancePool();
            CheckInMediaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CheckInMediaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CheckInMediaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CheckInMediaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CheckInMediaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

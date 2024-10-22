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
use entities\Gifts as ChildGifts;
use entities\GiftsQuery as ChildGiftsQuery;
use entities\Map\GiftsTableMap;

/**
 * Base class that represents a query for the `gifts` table.
 *
 * @method     ChildGiftsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGiftsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildGiftsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildGiftsQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method     ChildGiftsQuery orderByOffersid($order = Criteria::ASC) Order by the offersid column
 * @method     ChildGiftsQuery orderByStartdate($order = Criteria::ASC) Order by the startdate column
 * @method     ChildGiftsQuery orderByEnddate($order = Criteria::ASC) Order by the enddate column
 * @method     ChildGiftsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildGiftsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildGiftsQuery groupById() Group by the id column
 * @method     ChildGiftsQuery groupByTitle() Group by the title column
 * @method     ChildGiftsQuery groupByDescription() Group by the description column
 * @method     ChildGiftsQuery groupByMediaId() Group by the media_id column
 * @method     ChildGiftsQuery groupByOffersid() Group by the offersid column
 * @method     ChildGiftsQuery groupByStartdate() Group by the startdate column
 * @method     ChildGiftsQuery groupByEnddate() Group by the enddate column
 * @method     ChildGiftsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildGiftsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildGiftsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGiftsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGiftsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGiftsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGiftsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGiftsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGiftsQuery leftJoinMediaFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFiles relation
 * @method     ChildGiftsQuery rightJoinMediaFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFiles relation
 * @method     ChildGiftsQuery innerJoinMediaFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFiles relation
 *
 * @method     ChildGiftsQuery joinWithMediaFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFiles relation
 *
 * @method     ChildGiftsQuery leftJoinWithMediaFiles() Adds a LEFT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildGiftsQuery rightJoinWithMediaFiles() Adds a RIGHT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildGiftsQuery innerJoinWithMediaFiles() Adds a INNER JOIN clause and with to the query using the MediaFiles relation
 *
 * @method     ChildGiftsQuery leftJoinOffers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offers relation
 * @method     ChildGiftsQuery rightJoinOffers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offers relation
 * @method     ChildGiftsQuery innerJoinOffers($relationAlias = null) Adds a INNER JOIN clause to the query using the Offers relation
 *
 * @method     ChildGiftsQuery joinWithOffers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Offers relation
 *
 * @method     ChildGiftsQuery leftJoinWithOffers() Adds a LEFT JOIN clause and with to the query using the Offers relation
 * @method     ChildGiftsQuery rightJoinWithOffers() Adds a RIGHT JOIN clause and with to the query using the Offers relation
 * @method     ChildGiftsQuery innerJoinWithOffers() Adds a INNER JOIN clause and with to the query using the Offers relation
 *
 * @method     \entities\MediaFilesQuery|\entities\OffersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGifts|null findOne(?ConnectionInterface $con = null) Return the first ChildGifts matching the query
 * @method     ChildGifts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGifts matching the query, or a new ChildGifts object populated from the query conditions when no match is found
 *
 * @method     ChildGifts|null findOneById(int $id) Return the first ChildGifts filtered by the id column
 * @method     ChildGifts|null findOneByTitle(string $title) Return the first ChildGifts filtered by the title column
 * @method     ChildGifts|null findOneByDescription(string $description) Return the first ChildGifts filtered by the description column
 * @method     ChildGifts|null findOneByMediaId(int $media_id) Return the first ChildGifts filtered by the media_id column
 * @method     ChildGifts|null findOneByOffersid(int $offersid) Return the first ChildGifts filtered by the offersid column
 * @method     ChildGifts|null findOneByStartdate(string $startdate) Return the first ChildGifts filtered by the startdate column
 * @method     ChildGifts|null findOneByEnddate(string $enddate) Return the first ChildGifts filtered by the enddate column
 * @method     ChildGifts|null findOneByCreatedAt(string $created_at) Return the first ChildGifts filtered by the created_at column
 * @method     ChildGifts|null findOneByUpdatedAt(string $updated_at) Return the first ChildGifts filtered by the updated_at column
 *
 * @method     ChildGifts requirePk($key, ?ConnectionInterface $con = null) Return the ChildGifts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOne(?ConnectionInterface $con = null) Return the first ChildGifts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGifts requireOneById(int $id) Return the first ChildGifts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByTitle(string $title) Return the first ChildGifts filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByDescription(string $description) Return the first ChildGifts filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByMediaId(int $media_id) Return the first ChildGifts filtered by the media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByOffersid(int $offersid) Return the first ChildGifts filtered by the offersid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByStartdate(string $startdate) Return the first ChildGifts filtered by the startdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByEnddate(string $enddate) Return the first ChildGifts filtered by the enddate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByCreatedAt(string $created_at) Return the first ChildGifts filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGifts requireOneByUpdatedAt(string $updated_at) Return the first ChildGifts filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGifts[]|Collection find(?ConnectionInterface $con = null) Return ChildGifts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGifts> find(?ConnectionInterface $con = null) Return ChildGifts objects based on current ModelCriteria
 *
 * @method     ChildGifts[]|Collection findById(int|array<int> $id) Return ChildGifts objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildGifts> findById(int|array<int> $id) Return ChildGifts objects filtered by the id column
 * @method     ChildGifts[]|Collection findByTitle(string|array<string> $title) Return ChildGifts objects filtered by the title column
 * @psalm-method Collection&\Traversable<ChildGifts> findByTitle(string|array<string> $title) Return ChildGifts objects filtered by the title column
 * @method     ChildGifts[]|Collection findByDescription(string|array<string> $description) Return ChildGifts objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildGifts> findByDescription(string|array<string> $description) Return ChildGifts objects filtered by the description column
 * @method     ChildGifts[]|Collection findByMediaId(int|array<int> $media_id) Return ChildGifts objects filtered by the media_id column
 * @psalm-method Collection&\Traversable<ChildGifts> findByMediaId(int|array<int> $media_id) Return ChildGifts objects filtered by the media_id column
 * @method     ChildGifts[]|Collection findByOffersid(int|array<int> $offersid) Return ChildGifts objects filtered by the offersid column
 * @psalm-method Collection&\Traversable<ChildGifts> findByOffersid(int|array<int> $offersid) Return ChildGifts objects filtered by the offersid column
 * @method     ChildGifts[]|Collection findByStartdate(string|array<string> $startdate) Return ChildGifts objects filtered by the startdate column
 * @psalm-method Collection&\Traversable<ChildGifts> findByStartdate(string|array<string> $startdate) Return ChildGifts objects filtered by the startdate column
 * @method     ChildGifts[]|Collection findByEnddate(string|array<string> $enddate) Return ChildGifts objects filtered by the enddate column
 * @psalm-method Collection&\Traversable<ChildGifts> findByEnddate(string|array<string> $enddate) Return ChildGifts objects filtered by the enddate column
 * @method     ChildGifts[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildGifts objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildGifts> findByCreatedAt(string|array<string> $created_at) Return ChildGifts objects filtered by the created_at column
 * @method     ChildGifts[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildGifts objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildGifts> findByUpdatedAt(string|array<string> $updated_at) Return ChildGifts objects filtered by the updated_at column
 *
 * @method     ChildGifts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGifts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GiftsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GiftsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Gifts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGiftsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGiftsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGiftsQuery) {
            return $criteria;
        }
        $query = new ChildGiftsQuery();
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
     * @return ChildGifts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GiftsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GiftsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGifts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, description, media_id, offersid, startdate, enddate, created_at, updated_at FROM gifts WHERE id = :p0';
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
            /** @var ChildGifts $obj */
            $obj = new ChildGifts();
            $obj->hydrate($row);
            GiftsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGifts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GiftsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GiftsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(GiftsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * $query->filterByTitle(['foo', 'bar']); // WHERE title IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $title The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTitle($title = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_TITLE, $title, $comparison);

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

        $this->addUsingAlias(GiftsTableMap::COL_DESCRIPTION, $description, $comparison);

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
                $this->addUsingAlias(GiftsTableMap::COL_MEDIA_ID, $mediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediaId['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_MEDIA_ID, $mediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_MEDIA_ID, $mediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the offersid column
     *
     * Example usage:
     * <code>
     * $query->filterByOffersid(1234); // WHERE offersid = 1234
     * $query->filterByOffersid(array(12, 34)); // WHERE offersid IN (12, 34)
     * $query->filterByOffersid(array('min' => 12)); // WHERE offersid > 12
     * </code>
     *
     * @see       filterByOffers()
     *
     * @param mixed $offersid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOffersid($offersid = null, ?string $comparison = null)
    {
        if (is_array($offersid)) {
            $useMinMax = false;
            if (isset($offersid['min'])) {
                $this->addUsingAlias(GiftsTableMap::COL_OFFERSID, $offersid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($offersid['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_OFFERSID, $offersid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_OFFERSID, $offersid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the startdate column
     *
     * Example usage:
     * <code>
     * $query->filterByStartdate('2011-03-14'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartdate('now'); // WHERE startdate = '2011-03-14'
     * $query->filterByStartdate(array('max' => 'yesterday')); // WHERE startdate > '2011-03-13'
     * </code>
     *
     * @param mixed $startdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStartdate($startdate = null, ?string $comparison = null)
    {
        if (is_array($startdate)) {
            $useMinMax = false;
            if (isset($startdate['min'])) {
                $this->addUsingAlias(GiftsTableMap::COL_STARTDATE, $startdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdate['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_STARTDATE, $startdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_STARTDATE, $startdate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the enddate column
     *
     * Example usage:
     * <code>
     * $query->filterByEnddate('2011-03-14'); // WHERE enddate = '2011-03-14'
     * $query->filterByEnddate('now'); // WHERE enddate = '2011-03-14'
     * $query->filterByEnddate(array('max' => 'yesterday')); // WHERE enddate > '2011-03-13'
     * </code>
     *
     * @param mixed $enddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEnddate($enddate = null, ?string $comparison = null)
    {
        if (is_array($enddate)) {
            $useMinMax = false;
            if (isset($enddate['min'])) {
                $this->addUsingAlias(GiftsTableMap::COL_ENDDATE, $enddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddate['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_ENDDATE, $enddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_ENDDATE, $enddate, $comparison);

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
                $this->addUsingAlias(GiftsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(GiftsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(GiftsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GiftsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                ->addUsingAlias(GiftsTableMap::COL_MEDIA_ID, $mediaFiles->getMediaId(), $comparison);
        } elseif ($mediaFiles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GiftsTableMap::COL_MEDIA_ID, $mediaFiles->toKeyValue('PrimaryKey', 'MediaId'), $comparison);

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
    public function joinMediaFiles(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useMediaFilesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Offers object
     *
     * @param \entities\Offers|ObjectCollection $offers The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOffers($offers, ?string $comparison = null)
    {
        if ($offers instanceof \entities\Offers) {
            return $this
                ->addUsingAlias(GiftsTableMap::COL_OFFERSID, $offers->getId(), $comparison);
        } elseif ($offers instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GiftsTableMap::COL_OFFERSID, $offers->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOffers() only accepts arguments of type \entities\Offers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Offers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOffers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Offers');

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
            $this->addJoinObject($join, 'Offers');
        }

        return $this;
    }

    /**
     * Use the Offers relation Offers object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OffersQuery A secondary query class using the current class as primary query
     */
    public function useOffersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOffers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Offers', '\entities\OffersQuery');
    }

    /**
     * Use the Offers relation Offers object
     *
     * @param callable(\entities\OffersQuery):\entities\OffersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOffersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOffersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Offers table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OffersQuery The inner query object of the EXISTS statement
     */
    public function useOffersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT EXISTS query.
     *
     * @see useOffersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOffersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Offers table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OffersQuery The inner query object of the IN statement
     */
    public function useInOffersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT IN query.
     *
     * @see useOffersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOffersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildGifts $gifts Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($gifts = null)
    {
        if ($gifts) {
            $this->addUsingAlias(GiftsTableMap::COL_ID, $gifts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gifts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GiftsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GiftsTableMap::clearInstancePool();
            GiftsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GiftsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GiftsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GiftsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GiftsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

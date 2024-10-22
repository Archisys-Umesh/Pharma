<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\OutletContributionPotential as ChildOutletContributionPotential;
use entities\OutletContributionPotentialQuery as ChildOutletContributionPotentialQuery;
use entities\Map\OutletContributionPotentialTableMap;

/**
 * Base class that represents a query for the `outlet_contribution_potential` table.
 *
 * @method     ChildOutletContributionPotentialQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletContributionPotentialQuery orderByRcpaMoye($order = Criteria::ASC) Order by the rcpa_moye column
 * @method     ChildOutletContributionPotentialQuery orderByContribution($order = Criteria::ASC) Order by the contribution column
 * @method     ChildOutletContributionPotentialQuery orderByOther($order = Criteria::ASC) Order by the other column
 * @method     ChildOutletContributionPotentialQuery orderByPotential($order = Criteria::ASC) Order by the potential column
 * @method     ChildOutletContributionPotentialQuery orderByContributionValue($order = Criteria::ASC) Order by the contributionValue column
 * @method     ChildOutletContributionPotentialQuery orderByOtherValue($order = Criteria::ASC) Order by the otherValue column
 * @method     ChildOutletContributionPotentialQuery orderByPotentialValue($order = Criteria::ASC) Order by the potentialValue column
 *
 * @method     ChildOutletContributionPotentialQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletContributionPotentialQuery groupByRcpaMoye() Group by the rcpa_moye column
 * @method     ChildOutletContributionPotentialQuery groupByContribution() Group by the contribution column
 * @method     ChildOutletContributionPotentialQuery groupByOther() Group by the other column
 * @method     ChildOutletContributionPotentialQuery groupByPotential() Group by the potential column
 * @method     ChildOutletContributionPotentialQuery groupByContributionValue() Group by the contributionValue column
 * @method     ChildOutletContributionPotentialQuery groupByOtherValue() Group by the otherValue column
 * @method     ChildOutletContributionPotentialQuery groupByPotentialValue() Group by the potentialValue column
 *
 * @method     ChildOutletContributionPotentialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletContributionPotentialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletContributionPotentialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletContributionPotentialQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletContributionPotentialQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletContributionPotentialQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletContributionPotential|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletContributionPotential matching the query
 * @method     ChildOutletContributionPotential findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletContributionPotential matching the query, or a new ChildOutletContributionPotential object populated from the query conditions when no match is found
 *
 * @method     ChildOutletContributionPotential|null findOneByOutletId(int $outlet_id) Return the first ChildOutletContributionPotential filtered by the outlet_id column
 * @method     ChildOutletContributionPotential|null findOneByRcpaMoye(string $rcpa_moye) Return the first ChildOutletContributionPotential filtered by the rcpa_moye column
 * @method     ChildOutletContributionPotential|null findOneByContribution(int $contribution) Return the first ChildOutletContributionPotential filtered by the contribution column
 * @method     ChildOutletContributionPotential|null findOneByOther(int $other) Return the first ChildOutletContributionPotential filtered by the other column
 * @method     ChildOutletContributionPotential|null findOneByPotential(int $potential) Return the first ChildOutletContributionPotential filtered by the potential column
 * @method     ChildOutletContributionPotential|null findOneByContributionValue(string $contributionValue) Return the first ChildOutletContributionPotential filtered by the contributionValue column
 * @method     ChildOutletContributionPotential|null findOneByOtherValue(string $otherValue) Return the first ChildOutletContributionPotential filtered by the otherValue column
 * @method     ChildOutletContributionPotential|null findOneByPotentialValue(string $potentialValue) Return the first ChildOutletContributionPotential filtered by the potentialValue column
 *
 * @method     ChildOutletContributionPotential requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletContributionPotential by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOne(?ConnectionInterface $con = null) Return the first ChildOutletContributionPotential matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletContributionPotential requireOneByOutletId(int $outlet_id) Return the first ChildOutletContributionPotential filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByRcpaMoye(string $rcpa_moye) Return the first ChildOutletContributionPotential filtered by the rcpa_moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByContribution(int $contribution) Return the first ChildOutletContributionPotential filtered by the contribution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByOther(int $other) Return the first ChildOutletContributionPotential filtered by the other column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByPotential(int $potential) Return the first ChildOutletContributionPotential filtered by the potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByContributionValue(string $contributionValue) Return the first ChildOutletContributionPotential filtered by the contributionValue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByOtherValue(string $otherValue) Return the first ChildOutletContributionPotential filtered by the otherValue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletContributionPotential requireOneByPotentialValue(string $potentialValue) Return the first ChildOutletContributionPotential filtered by the potentialValue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletContributionPotential[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletContributionPotential objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> find(?ConnectionInterface $con = null) Return ChildOutletContributionPotential objects based on current ModelCriteria
 *
 * @method     ChildOutletContributionPotential[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletContributionPotential objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByOutletId(int|array<int> $outlet_id) Return ChildOutletContributionPotential objects filtered by the outlet_id column
 * @method     ChildOutletContributionPotential[]|Collection findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildOutletContributionPotential objects filtered by the rcpa_moye column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByRcpaMoye(string|array<string> $rcpa_moye) Return ChildOutletContributionPotential objects filtered by the rcpa_moye column
 * @method     ChildOutletContributionPotential[]|Collection findByContribution(int|array<int> $contribution) Return ChildOutletContributionPotential objects filtered by the contribution column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByContribution(int|array<int> $contribution) Return ChildOutletContributionPotential objects filtered by the contribution column
 * @method     ChildOutletContributionPotential[]|Collection findByOther(int|array<int> $other) Return ChildOutletContributionPotential objects filtered by the other column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByOther(int|array<int> $other) Return ChildOutletContributionPotential objects filtered by the other column
 * @method     ChildOutletContributionPotential[]|Collection findByPotential(int|array<int> $potential) Return ChildOutletContributionPotential objects filtered by the potential column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByPotential(int|array<int> $potential) Return ChildOutletContributionPotential objects filtered by the potential column
 * @method     ChildOutletContributionPotential[]|Collection findByContributionValue(string|array<string> $contributionValue) Return ChildOutletContributionPotential objects filtered by the contributionValue column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByContributionValue(string|array<string> $contributionValue) Return ChildOutletContributionPotential objects filtered by the contributionValue column
 * @method     ChildOutletContributionPotential[]|Collection findByOtherValue(string|array<string> $otherValue) Return ChildOutletContributionPotential objects filtered by the otherValue column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByOtherValue(string|array<string> $otherValue) Return ChildOutletContributionPotential objects filtered by the otherValue column
 * @method     ChildOutletContributionPotential[]|Collection findByPotentialValue(string|array<string> $potentialValue) Return ChildOutletContributionPotential objects filtered by the potentialValue column
 * @psalm-method Collection&\Traversable<ChildOutletContributionPotential> findByPotentialValue(string|array<string> $potentialValue) Return ChildOutletContributionPotential objects filtered by the potentialValue column
 *
 * @method     ChildOutletContributionPotential[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletContributionPotential> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletContributionPotentialQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletContributionPotentialQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletContributionPotential', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletContributionPotentialQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletContributionPotentialQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletContributionPotentialQuery) {
            return $criteria;
        }
        $query = new ChildOutletContributionPotentialQuery();
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
     * @return ChildOutletContributionPotential|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The OutletContributionPotential object has no primary key');
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
        throw new LogicException('The OutletContributionPotential object has no primary key');
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
        throw new LogicException('The OutletContributionPotential object has no primary key');
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
        throw new LogicException('The OutletContributionPotential object has no primary key');
    }

    /**
     * Filter the query on the outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE outlet_id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE outlet_id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE outlet_id > 12
     * </code>
     *
     * @param mixed $outletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletId($outletId = null, ?string $comparison = null)
    {
        if (is_array($outletId)) {
            $useMinMax = false;
            if (isset($outletId['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_moye column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaMoye('fooValue');   // WHERE rcpa_moye = 'fooValue'
     * $query->filterByRcpaMoye('%fooValue%', Criteria::LIKE); // WHERE rcpa_moye LIKE '%fooValue%'
     * $query->filterByRcpaMoye(['foo', 'bar']); // WHERE rcpa_moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaMoye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaMoye($rcpaMoye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaMoye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_RCPA_MOYE, $rcpaMoye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the contribution column
     *
     * Example usage:
     * <code>
     * $query->filterByContribution(1234); // WHERE contribution = 1234
     * $query->filterByContribution(array(12, 34)); // WHERE contribution IN (12, 34)
     * $query->filterByContribution(array('min' => 12)); // WHERE contribution > 12
     * </code>
     *
     * @param mixed $contribution The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContribution($contribution = null, ?string $comparison = null)
    {
        if (is_array($contribution)) {
            $useMinMax = false;
            if (isset($contribution['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTION, $contribution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contribution['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTION, $contribution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTION, $contribution, $comparison);

        return $this;
    }

    /**
     * Filter the query on the other column
     *
     * Example usage:
     * <code>
     * $query->filterByOther(1234); // WHERE other = 1234
     * $query->filterByOther(array(12, 34)); // WHERE other IN (12, 34)
     * $query->filterByOther(array('min' => 12)); // WHERE other > 12
     * </code>
     *
     * @param mixed $other The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOther($other = null, ?string $comparison = null)
    {
        if (is_array($other)) {
            $useMinMax = false;
            if (isset($other['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHER, $other['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($other['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHER, $other['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHER, $other, $comparison);

        return $this;
    }

    /**
     * Filter the query on the potential column
     *
     * Example usage:
     * <code>
     * $query->filterByPotential(1234); // WHERE potential = 1234
     * $query->filterByPotential(array(12, 34)); // WHERE potential IN (12, 34)
     * $query->filterByPotential(array('min' => 12)); // WHERE potential > 12
     * </code>
     *
     * @param mixed $potential The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPotential($potential = null, ?string $comparison = null)
    {
        if (is_array($potential)) {
            $useMinMax = false;
            if (isset($potential['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIAL, $potential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($potential['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIAL, $potential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIAL, $potential, $comparison);

        return $this;
    }

    /**
     * Filter the query on the contributionValue column
     *
     * Example usage:
     * <code>
     * $query->filterByContributionValue(1234); // WHERE contributionValue = 1234
     * $query->filterByContributionValue(array(12, 34)); // WHERE contributionValue IN (12, 34)
     * $query->filterByContributionValue(array('min' => 12)); // WHERE contributionValue > 12
     * </code>
     *
     * @param mixed $contributionValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContributionValue($contributionValue = null, ?string $comparison = null)
    {
        if (is_array($contributionValue)) {
            $useMinMax = false;
            if (isset($contributionValue['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE, $contributionValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contributionValue['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE, $contributionValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE, $contributionValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the otherValue column
     *
     * Example usage:
     * <code>
     * $query->filterByOtherValue(1234); // WHERE otherValue = 1234
     * $query->filterByOtherValue(array(12, 34)); // WHERE otherValue IN (12, 34)
     * $query->filterByOtherValue(array('min' => 12)); // WHERE otherValue > 12
     * </code>
     *
     * @param mixed $otherValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtherValue($otherValue = null, ?string $comparison = null)
    {
        if (is_array($otherValue)) {
            $useMinMax = false;
            if (isset($otherValue['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHERVALUE, $otherValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($otherValue['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHERVALUE, $otherValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_OTHERVALUE, $otherValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the potentialValue column
     *
     * Example usage:
     * <code>
     * $query->filterByPotentialValue(1234); // WHERE potentialValue = 1234
     * $query->filterByPotentialValue(array(12, 34)); // WHERE potentialValue IN (12, 34)
     * $query->filterByPotentialValue(array('min' => 12)); // WHERE potentialValue > 12
     * </code>
     *
     * @param mixed $potentialValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPotentialValue($potentialValue = null, ?string $comparison = null)
    {
        if (is_array($potentialValue)) {
            $useMinMax = false;
            if (isset($potentialValue['min'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIALVALUE, $potentialValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($potentialValue['max'])) {
                $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIALVALUE, $potentialValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletContributionPotentialTableMap::COL_POTENTIALVALUE, $potentialValue, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletContributionPotential $outletContributionPotential Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletContributionPotential = null)
    {
        if ($outletContributionPotential) {
            throw new LogicException('OutletContributionPotential object has no primary key');

        }

        return $this;
    }

}

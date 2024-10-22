<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\SgpiBrandWiseDistribution as ChildSgpiBrandWiseDistribution;
use entities\SgpiBrandWiseDistributionQuery as ChildSgpiBrandWiseDistributionQuery;
use entities\Map\SgpiBrandWiseDistributionTableMap;

/**
 * Base class that represents a query for the `sgpi_brand_wise_distribution` table.
 *
 * @method     ChildSgpiBrandWiseDistributionQuery orderBySgpiVoucherId($order = Criteria::ASC) Order by the sgpimap_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOrgDataId($order = Criteria::ASC) Order by the org_data_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderBySgpiStatus($order = Criteria::ASC) Order by the sgpi_status column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOrgPotential($order = Criteria::ASC) Order by the org_potential column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByBrandFocus($order = Criteria::ASC) Order by the brand_focus column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByCustomerFq($order = Criteria::ASC) Order by the customer_fq column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutletId($order = Criteria::ASC) Order by the id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByOutletCity($order = Criteria::ASC) Order by the outlet_city column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildSgpiBrandWiseDistributionQuery orderByBrandName($order = Criteria::ASC) Order by the brand_name column
 *
 * @method     ChildSgpiBrandWiseDistributionQuery groupBySgpiVoucherId() Group by the sgpimap_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOrgDataId() Group by the org_data_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByBrandId() Group by the brand_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupBySgpiStatus() Group by the sgpi_status column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByCompanyId() Group by the company_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByPositionId() Group by the position_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByPositionName() Group by the position_name column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByBeatId() Group by the beat_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByBeatName() Group by the beat_name column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByTags() Group by the tags column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOrgPotential() Group by the org_potential column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByBrandFocus() Group by the brand_focus column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByCustomerFq() Group by the customer_fq column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutletId() Group by the id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByItownid() Group by the itownid column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByOutletCity() Group by the outlet_city column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByClassification() Group by the classification column
 * @method     ChildSgpiBrandWiseDistributionQuery groupByBrandName() Group by the brand_name column
 *
 * @method     ChildSgpiBrandWiseDistributionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSgpiBrandWiseDistributionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSgpiBrandWiseDistributionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSgpiBrandWiseDistributionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSgpiBrandWiseDistributionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSgpiBrandWiseDistributionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSgpiBrandWiseDistribution|null findOne(?ConnectionInterface $con = null) Return the first ChildSgpiBrandWiseDistribution matching the query
 * @method     ChildSgpiBrandWiseDistribution findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSgpiBrandWiseDistribution matching the query, or a new ChildSgpiBrandWiseDistribution object populated from the query conditions when no match is found
 *
 * @method     ChildSgpiBrandWiseDistribution|null findOneBySgpiVoucherId(int $sgpimap_id) Return the first ChildSgpiBrandWiseDistribution filtered by the sgpimap_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOrgDataId(int $org_data_id) Return the first ChildSgpiBrandWiseDistribution filtered by the org_data_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByBrandId(int $brand_id) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneBySgpiStatus(string $sgpi_status) Return the first ChildSgpiBrandWiseDistribution filtered by the sgpi_status column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByCompanyId(int $company_id) Return the first ChildSgpiBrandWiseDistribution filtered by the company_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByCreatedAt(string $created_at) Return the first ChildSgpiBrandWiseDistribution filtered by the created_at column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByUpdatedAt(string $updated_at) Return the first ChildSgpiBrandWiseDistribution filtered by the updated_at column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByTerritoryId(int $territory_id) Return the first ChildSgpiBrandWiseDistribution filtered by the territory_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByTerritoryName(string $territory_name) Return the first ChildSgpiBrandWiseDistribution filtered by the territory_name column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByPositionId(int $position_id) Return the first ChildSgpiBrandWiseDistribution filtered by the position_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByPositionName(string $position_name) Return the first ChildSgpiBrandWiseDistribution filtered by the position_name column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByBeatId(int $beat_id) Return the first ChildSgpiBrandWiseDistribution filtered by the beat_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByBeatName(string $beat_name) Return the first ChildSgpiBrandWiseDistribution filtered by the beat_name column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByTags(string $tags) Return the first ChildSgpiBrandWiseDistribution filtered by the tags column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOrgPotential(string $org_potential) Return the first ChildSgpiBrandWiseDistribution filtered by the org_potential column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByBrandFocus(string $brand_focus) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_focus column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByCustomerFq(string $customer_fq) Return the first ChildSgpiBrandWiseDistribution filtered by the customer_fq column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutletId(int $id) Return the first ChildSgpiBrandWiseDistribution filtered by the id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutletName(string $outlet_name) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_name column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutletCode(string $outlet_code) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_code column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiBrandWiseDistribution filtered by the outlettype_id column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiBrandWiseDistribution filtered by the outlettype_name column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByItownid(int $itownid) Return the first ChildSgpiBrandWiseDistribution filtered by the itownid column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByOutletCity(string $outlet_city) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_city column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByClassification(string $classification) Return the first ChildSgpiBrandWiseDistribution filtered by the classification column
 * @method     ChildSgpiBrandWiseDistribution|null findOneByBrandName(string $brand_name) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_name column
 *
 * @method     ChildSgpiBrandWiseDistribution requirePk($key, ?ConnectionInterface $con = null) Return the ChildSgpiBrandWiseDistribution by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOne(?ConnectionInterface $con = null) Return the first ChildSgpiBrandWiseDistribution matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiBrandWiseDistribution requireOneBySgpiVoucherId(int $sgpimap_id) Return the first ChildSgpiBrandWiseDistribution filtered by the sgpimap_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOrgDataId(int $org_data_id) Return the first ChildSgpiBrandWiseDistribution filtered by the org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByBrandId(int $brand_id) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneBySgpiStatus(string $sgpi_status) Return the first ChildSgpiBrandWiseDistribution filtered by the sgpi_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByCompanyId(int $company_id) Return the first ChildSgpiBrandWiseDistribution filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByCreatedAt(string $created_at) Return the first ChildSgpiBrandWiseDistribution filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByUpdatedAt(string $updated_at) Return the first ChildSgpiBrandWiseDistribution filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByTerritoryId(int $territory_id) Return the first ChildSgpiBrandWiseDistribution filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByTerritoryName(string $territory_name) Return the first ChildSgpiBrandWiseDistribution filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByPositionId(int $position_id) Return the first ChildSgpiBrandWiseDistribution filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByPositionName(string $position_name) Return the first ChildSgpiBrandWiseDistribution filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByBeatId(int $beat_id) Return the first ChildSgpiBrandWiseDistribution filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByBeatName(string $beat_name) Return the first ChildSgpiBrandWiseDistribution filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByTags(string $tags) Return the first ChildSgpiBrandWiseDistribution filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOrgPotential(string $org_potential) Return the first ChildSgpiBrandWiseDistribution filtered by the org_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByBrandFocus(string $brand_focus) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_focus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByCustomerFq(string $customer_fq) Return the first ChildSgpiBrandWiseDistribution filtered by the customer_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutletId(int $id) Return the first ChildSgpiBrandWiseDistribution filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutletName(string $outlet_name) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutletCode(string $outlet_code) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutlettypeId(int $outlettype_id) Return the first ChildSgpiBrandWiseDistribution filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutlettypeName(string $outlettype_name) Return the first ChildSgpiBrandWiseDistribution filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByItownid(int $itownid) Return the first ChildSgpiBrandWiseDistribution filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByOutletCity(string $outlet_city) Return the first ChildSgpiBrandWiseDistribution filtered by the outlet_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByClassification(string $classification) Return the first ChildSgpiBrandWiseDistribution filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSgpiBrandWiseDistribution requireOneByBrandName(string $brand_name) Return the first ChildSgpiBrandWiseDistribution filtered by the brand_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSgpiBrandWiseDistribution[]|Collection find(?ConnectionInterface $con = null) Return ChildSgpiBrandWiseDistribution objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> find(?ConnectionInterface $con = null) Return ChildSgpiBrandWiseDistribution objects based on current ModelCriteria
 *
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findBySgpiVoucherId(int|array<int> $sgpimap_id) Return ChildSgpiBrandWiseDistribution objects filtered by the sgpimap_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findBySgpiVoucherId(int|array<int> $sgpimap_id) Return ChildSgpiBrandWiseDistribution objects filtered by the sgpimap_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOrgDataId(int|array<int> $org_data_id) Return ChildSgpiBrandWiseDistribution objects filtered by the org_data_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOrgDataId(int|array<int> $org_data_id) Return ChildSgpiBrandWiseDistribution objects filtered by the org_data_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByBrandId(int|array<int> $brand_id) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findBySgpiStatus(string|array<string> $sgpi_status) Return ChildSgpiBrandWiseDistribution objects filtered by the sgpi_status column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findBySgpiStatus(string|array<string> $sgpi_status) Return ChildSgpiBrandWiseDistribution objects filtered by the sgpi_status column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildSgpiBrandWiseDistribution objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByCompanyId(int|array<int> $company_id) Return ChildSgpiBrandWiseDistribution objects filtered by the company_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSgpiBrandWiseDistribution objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByCreatedAt(string|array<string> $created_at) Return ChildSgpiBrandWiseDistribution objects filtered by the created_at column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiBrandWiseDistribution objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByUpdatedAt(string|array<string> $updated_at) Return ChildSgpiBrandWiseDistribution objects filtered by the updated_at column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiBrandWiseDistribution objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByTerritoryId(int|array<int> $territory_id) Return ChildSgpiBrandWiseDistribution objects filtered by the territory_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildSgpiBrandWiseDistribution objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByTerritoryName(string|array<string> $territory_name) Return ChildSgpiBrandWiseDistribution objects filtered by the territory_name column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByPositionId(int|array<int> $position_id) Return ChildSgpiBrandWiseDistribution objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByPositionId(int|array<int> $position_id) Return ChildSgpiBrandWiseDistribution objects filtered by the position_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByPositionName(string|array<string> $position_name) Return ChildSgpiBrandWiseDistribution objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByPositionName(string|array<string> $position_name) Return ChildSgpiBrandWiseDistribution objects filtered by the position_name column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildSgpiBrandWiseDistribution objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByBeatId(int|array<int> $beat_id) Return ChildSgpiBrandWiseDistribution objects filtered by the beat_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildSgpiBrandWiseDistribution objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByBeatName(string|array<string> $beat_name) Return ChildSgpiBrandWiseDistribution objects filtered by the beat_name column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByTags(string|array<string> $tags) Return ChildSgpiBrandWiseDistribution objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByTags(string|array<string> $tags) Return ChildSgpiBrandWiseDistribution objects filtered by the tags column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOrgPotential(string|array<string> $org_potential) Return ChildSgpiBrandWiseDistribution objects filtered by the org_potential column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOrgPotential(string|array<string> $org_potential) Return ChildSgpiBrandWiseDistribution objects filtered by the org_potential column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByBrandFocus(string|array<string> $brand_focus) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_focus column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByBrandFocus(string|array<string> $brand_focus) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_focus column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByCustomerFq(string|array<string> $customer_fq) Return ChildSgpiBrandWiseDistribution objects filtered by the customer_fq column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByCustomerFq(string|array<string> $customer_fq) Return ChildSgpiBrandWiseDistribution objects filtered by the customer_fq column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutletId(int|array<int> $id) Return ChildSgpiBrandWiseDistribution objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutletId(int|array<int> $id) Return ChildSgpiBrandWiseDistribution objects filtered by the id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutletName(string|array<string> $outlet_name) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_name column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutletCode(string|array<string> $outlet_code) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_code column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiBrandWiseDistribution objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildSgpiBrandWiseDistribution objects filtered by the outlettype_id column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiBrandWiseDistribution objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildSgpiBrandWiseDistribution objects filtered by the outlettype_name column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByItownid(int|array<int> $itownid) Return ChildSgpiBrandWiseDistribution objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByItownid(int|array<int> $itownid) Return ChildSgpiBrandWiseDistribution objects filtered by the itownid column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByOutletCity(string|array<string> $outlet_city) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_city column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByOutletCity(string|array<string> $outlet_city) Return ChildSgpiBrandWiseDistribution objects filtered by the outlet_city column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByClassification(string|array<string> $classification) Return ChildSgpiBrandWiseDistribution objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByClassification(string|array<string> $classification) Return ChildSgpiBrandWiseDistribution objects filtered by the classification column
 * @method     ChildSgpiBrandWiseDistribution[]|Collection findByBrandName(string|array<string> $brand_name) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_name column
 * @psalm-method Collection&\Traversable<ChildSgpiBrandWiseDistribution> findByBrandName(string|array<string> $brand_name) Return ChildSgpiBrandWiseDistribution objects filtered by the brand_name column
 *
 * @method     ChildSgpiBrandWiseDistribution[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSgpiBrandWiseDistribution> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SgpiBrandWiseDistributionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\SgpiBrandWiseDistributionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\SgpiBrandWiseDistribution', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSgpiBrandWiseDistributionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSgpiBrandWiseDistributionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSgpiBrandWiseDistributionQuery) {
            return $criteria;
        }
        $query = new ChildSgpiBrandWiseDistributionQuery();
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
     * @return ChildSgpiBrandWiseDistribution|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');
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
        throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');
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
        throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');
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
        throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');
    }

    /**
     * Filter the query on the sgpimap_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiVoucherId(1234); // WHERE sgpimap_id = 1234
     * $query->filterBySgpiVoucherId(array(12, 34)); // WHERE sgpimap_id IN (12, 34)
     * $query->filterBySgpiVoucherId(array('min' => 12)); // WHERE sgpimap_id > 12
     * </code>
     *
     * @param mixed $sgpiVoucherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiVoucherId($sgpiVoucherId = null, ?string $comparison = null)
    {
        if (is_array($sgpiVoucherId)) {
            $useMinMax = false;
            if (isset($sgpiVoucherId['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID, $sgpiVoucherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiVoucherId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID, $sgpiVoucherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID, $sgpiVoucherId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgDataId(1234); // WHERE org_data_id = 1234
     * $query->filterByOrgDataId(array(12, 34)); // WHERE org_data_id IN (12, 34)
     * $query->filterByOrgDataId(array('min' => 12)); // WHERE org_data_id > 12
     * </code>
     *
     * @param mixed $orgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgDataId($orgDataId = null, ?string $comparison = null)
    {
        if (is_array($orgDataId)) {
            $useMinMax = false;
            if (isset($orgDataId['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID, $orgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgDataId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID, $orgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID, $orgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id > 12
     * </code>
     *
     * @param mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, ?string $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiStatus('fooValue');   // WHERE sgpi_status = 'fooValue'
     * $query->filterBySgpiStatus('%fooValue%', Criteria::LIKE); // WHERE sgpi_status LIKE '%fooValue%'
     * $query->filterBySgpiStatus(['foo', 'bar']); // WHERE sgpi_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiStatus($sgpiStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS, $sgpiStatus, $comparison);

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
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('fooValue');   // WHERE created_at = 'fooValue'
     * $query->filterByCreatedAt('%fooValue%', Criteria::LIKE); // WHERE created_at LIKE '%fooValue%'
     * $query->filterByCreatedAt(['foo', 'bar']); // WHERE created_at IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $createdAt The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($createdAt)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('fooValue');   // WHERE updated_at = 'fooValue'
     * $query->filterByUpdatedAt('%fooValue%', Criteria::LIKE); // WHERE updated_at LIKE '%fooValue%'
     * $query->filterByUpdatedAt(['foo', 'bar']); // WHERE updated_at IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $updatedAt The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($updatedAt)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
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
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionName('fooValue');   // WHERE position_name = 'fooValue'
     * $query->filterByPositionName('%fooValue%', Criteria::LIKE); // WHERE position_name LIKE '%fooValue%'
     * $query->filterByPositionName(['foo', 'bar']); // WHERE position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $positionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionName($positionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME, $positionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatId(1234); // WHERE beat_id = 1234
     * $query->filterByBeatId(array(12, 34)); // WHERE beat_id IN (12, 34)
     * $query->filterByBeatId(array('min' => 12)); // WHERE beat_id > 12
     * </code>
     *
     * @param mixed $beatId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatId($beatId = null, ?string $comparison = null)
    {
        if (is_array($beatId)) {
            $useMinMax = false;
            if (isset($beatId['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID, $beatId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatName('fooValue');   // WHERE beat_name = 'fooValue'
     * $query->filterByBeatName('%fooValue%', Criteria::LIKE); // WHERE beat_name LIKE '%fooValue%'
     * $query->filterByBeatName(['foo', 'bar']); // WHERE beat_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatName($beatName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME, $beatName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%', Criteria::LIKE); // WHERE tags LIKE '%fooValue%'
     * $query->filterByTags(['foo', 'bar']); // WHERE tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $tags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_potential column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgPotential('fooValue');   // WHERE org_potential = 'fooValue'
     * $query->filterByOrgPotential('%fooValue%', Criteria::LIKE); // WHERE org_potential LIKE '%fooValue%'
     * $query->filterByOrgPotential(['foo', 'bar']); // WHERE org_potential IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgPotential The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgPotential($orgPotential = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgPotential)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL, $orgPotential, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_focus column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandFocus('fooValue');   // WHERE brand_focus = 'fooValue'
     * $query->filterByBrandFocus('%fooValue%', Criteria::LIKE); // WHERE brand_focus LIKE '%fooValue%'
     * $query->filterByBrandFocus(['foo', 'bar']); // WHERE brand_focus IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandFocus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandFocus($brandFocus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandFocus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS, $brandFocus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the customer_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerFq('fooValue');   // WHERE customer_fq = 'fooValue'
     * $query->filterByCustomerFq('%fooValue%', Criteria::LIKE); // WHERE customer_fq LIKE '%fooValue%'
     * $query->filterByCustomerFq(['foo', 'bar']); // WHERE customer_fq IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $customerFq The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerFq($customerFq = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customerFq)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ, $customerFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE id > 12
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
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletName('fooValue');   // WHERE outlet_name = 'fooValue'
     * $query->filterByOutletName('%fooValue%', Criteria::LIKE); // WHERE outlet_name LIKE '%fooValue%'
     * $query->filterByOutletName(['foo', 'bar']); // WHERE outlet_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletName($outletName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME, $outletName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCode('fooValue');   // WHERE outlet_code = 'fooValue'
     * $query->filterByOutletCode('%fooValue%', Criteria::LIKE); // WHERE outlet_code LIKE '%fooValue%'
     * $query->filterByOutletCode(['foo', 'bar']); // WHERE outlet_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCode($outletCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeId(1234); // WHERE outlettype_id = 1234
     * $query->filterByOutlettypeId(array(12, 34)); // WHERE outlettype_id IN (12, 34)
     * $query->filterByOutlettypeId(array('min' => 12)); // WHERE outlettype_id > 12
     * </code>
     *
     * @param mixed $outlettypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeId($outlettypeId = null, ?string $comparison = null)
    {
        if (is_array($outlettypeId)) {
            $useMinMax = false;
            if (isset($outlettypeId['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByItownid(1234); // WHERE itownid = 1234
     * $query->filterByItownid(array(12, 34)); // WHERE itownid IN (12, 34)
     * $query->filterByItownid(array('min' => 12)); // WHERE itownid > 12
     * </code>
     *
     * @param mixed $itownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItownid($itownid = null, ?string $comparison = null)
    {
        if (is_array($itownid)) {
            $useMinMax = false;
            if (isset($itownid['min'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_city column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCity('fooValue');   // WHERE outlet_city = 'fooValue'
     * $query->filterByOutletCity('%fooValue%', Criteria::LIKE); // WHERE outlet_city LIKE '%fooValue%'
     * $query->filterByOutletCity(['foo', 'bar']); // WHERE outlet_city IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCity The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCity($outletCity = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCity)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY, $outletCity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification column
     *
     * Example usage:
     * <code>
     * $query->filterByClassification('fooValue');   // WHERE classification = 'fooValue'
     * $query->filterByClassification('%fooValue%', Criteria::LIKE); // WHERE classification LIKE '%fooValue%'
     * $query->filterByClassification(['foo', 'bar']); // WHERE classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION, $classification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandName('fooValue');   // WHERE brand_name = 'fooValue'
     * $query->filterByBrandName('%fooValue%', Criteria::LIKE); // WHERE brand_name LIKE '%fooValue%'
     * $query->filterByBrandName(['foo', 'bar']); // WHERE brand_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandName($brandName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME, $brandName, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSgpiBrandWiseDistribution $sgpiBrandWiseDistribution Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($sgpiBrandWiseDistribution = null)
    {
        if ($sgpiBrandWiseDistribution) {
            throw new LogicException('SgpiBrandWiseDistribution object has no primary key');

        }

        return $this;
    }

}

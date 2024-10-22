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
use entities\Products as ChildProducts;
use entities\ProductsQuery as ChildProductsQuery;
use entities\Map\ProductsTableMap;

/**
 * Base class that represents a query for the `products` table.
 *
 * @method     ChildProductsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductsQuery orderByProductName($order = Criteria::ASC) Order by the product_name column
 * @method     ChildProductsQuery orderByProductSummary($order = Criteria::ASC) Order by the product_summary column
 * @method     ChildProductsQuery orderByProductDescription($order = Criteria::ASC) Order by the product_description column
 * @method     ChildProductsQuery orderByProductSku($order = Criteria::ASC) Order by the product_sku column
 * @method     ChildProductsQuery orderByAdditionalData($order = Criteria::ASC) Order by the additional_data column
 * @method     ChildProductsQuery orderByUnitD($order = Criteria::ASC) Order by the unit_d column
 * @method     ChildProductsQuery orderByPackingDesc($order = Criteria::ASC) Order by the packing_desc column
 * @method     ChildProductsQuery orderByPackingQty($order = Criteria::ASC) Order by the packing_qty column
 * @method     ChildProductsQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildProductsQuery orderByTagId($order = Criteria::ASC) Order by the tag_id column
 * @method     ChildProductsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildProductsQuery orderByProductImages($order = Criteria::ASC) Order by the product_images column
 * @method     ChildProductsQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 * @method     ChildProductsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildProductsQuery orderByOrgunitId($order = Criteria::ASC) Order by the orgunit_id column
 * @method     ChildProductsQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method     ChildProductsQuery orderByBasePrice($order = Criteria::ASC) Order by the base_price column
 * @method     ChildProductsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildProductsQuery orderByCanDoRcpa($order = Criteria::ASC) Order by the can_do_rcpa column
 *
 * @method     ChildProductsQuery groupById() Group by the id column
 * @method     ChildProductsQuery groupByProductName() Group by the product_name column
 * @method     ChildProductsQuery groupByProductSummary() Group by the product_summary column
 * @method     ChildProductsQuery groupByProductDescription() Group by the product_description column
 * @method     ChildProductsQuery groupByProductSku() Group by the product_sku column
 * @method     ChildProductsQuery groupByAdditionalData() Group by the additional_data column
 * @method     ChildProductsQuery groupByUnitD() Group by the unit_d column
 * @method     ChildProductsQuery groupByPackingDesc() Group by the packing_desc column
 * @method     ChildProductsQuery groupByPackingQty() Group by the packing_qty column
 * @method     ChildProductsQuery groupByCategoryId() Group by the category_id column
 * @method     ChildProductsQuery groupByTagId() Group by the tag_id column
 * @method     ChildProductsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildProductsQuery groupByProductImages() Group by the product_images column
 * @method     ChildProductsQuery groupByIntegrationId() Group by the integration_id column
 * @method     ChildProductsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildProductsQuery groupByOrgunitId() Group by the orgunit_id column
 * @method     ChildProductsQuery groupByBrandId() Group by the brand_id column
 * @method     ChildProductsQuery groupByBasePrice() Group by the base_price column
 * @method     ChildProductsQuery groupByStatus() Group by the status column
 * @method     ChildProductsQuery groupByCanDoRcpa() Group by the can_do_rcpa column
 *
 * @method     ChildProductsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductsQuery leftJoinCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categories relation
 * @method     ChildProductsQuery rightJoinCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categories relation
 * @method     ChildProductsQuery innerJoinCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the Categories relation
 *
 * @method     ChildProductsQuery joinWithCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categories relation
 *
 * @method     ChildProductsQuery leftJoinWithCategories() Adds a LEFT JOIN clause and with to the query using the Categories relation
 * @method     ChildProductsQuery rightJoinWithCategories() Adds a RIGHT JOIN clause and with to the query using the Categories relation
 * @method     ChildProductsQuery innerJoinWithCategories() Adds a INNER JOIN clause and with to the query using the Categories relation
 *
 * @method     ChildProductsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildProductsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildProductsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildProductsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildProductsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildProductsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildProductsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildProductsQuery leftJoinTags($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tags relation
 * @method     ChildProductsQuery rightJoinTags($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tags relation
 * @method     ChildProductsQuery innerJoinTags($relationAlias = null) Adds a INNER JOIN clause to the query using the Tags relation
 *
 * @method     ChildProductsQuery joinWithTags($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tags relation
 *
 * @method     ChildProductsQuery leftJoinWithTags() Adds a LEFT JOIN clause and with to the query using the Tags relation
 * @method     ChildProductsQuery rightJoinWithTags() Adds a RIGHT JOIN clause and with to the query using the Tags relation
 * @method     ChildProductsQuery innerJoinWithTags() Adds a INNER JOIN clause and with to the query using the Tags relation
 *
 * @method     ChildProductsQuery leftJoinUnitmaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unitmaster relation
 * @method     ChildProductsQuery rightJoinUnitmaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unitmaster relation
 * @method     ChildProductsQuery innerJoinUnitmaster($relationAlias = null) Adds a INNER JOIN clause to the query using the Unitmaster relation
 *
 * @method     ChildProductsQuery joinWithUnitmaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unitmaster relation
 *
 * @method     ChildProductsQuery leftJoinWithUnitmaster() Adds a LEFT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildProductsQuery rightJoinWithUnitmaster() Adds a RIGHT JOIN clause and with to the query using the Unitmaster relation
 * @method     ChildProductsQuery innerJoinWithUnitmaster() Adds a INNER JOIN clause and with to the query using the Unitmaster relation
 *
 * @method     ChildProductsQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildProductsQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildProductsQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildProductsQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildProductsQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildProductsQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildProductsQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildProductsQuery leftJoinBrandCompetition($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildProductsQuery rightJoinBrandCompetition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildProductsQuery innerJoinBrandCompetition($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCompetition relation
 *
 * @method     ChildProductsQuery joinWithBrandCompetition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildProductsQuery leftJoinWithBrandCompetition() Adds a LEFT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildProductsQuery rightJoinWithBrandCompetition() Adds a RIGHT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildProductsQuery innerJoinWithBrandCompetition() Adds a INNER JOIN clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildProductsQuery leftJoinOrderlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderlines relation
 * @method     ChildProductsQuery rightJoinOrderlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderlines relation
 * @method     ChildProductsQuery innerJoinOrderlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderlines relation
 *
 * @method     ChildProductsQuery joinWithOrderlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderlines relation
 *
 * @method     ChildProductsQuery leftJoinWithOrderlines() Adds a LEFT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildProductsQuery rightJoinWithOrderlines() Adds a RIGHT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildProductsQuery innerJoinWithOrderlines() Adds a INNER JOIN clause and with to the query using the Orderlines relation
 *
 * @method     ChildProductsQuery leftJoinOutletStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStock relation
 * @method     ChildProductsQuery rightJoinOutletStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStock relation
 * @method     ChildProductsQuery innerJoinOutletStock($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStock relation
 *
 * @method     ChildProductsQuery joinWithOutletStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStock relation
 *
 * @method     ChildProductsQuery leftJoinWithOutletStock() Adds a LEFT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildProductsQuery rightJoinWithOutletStock() Adds a RIGHT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildProductsQuery innerJoinWithOutletStock() Adds a INNER JOIN clause and with to the query using the OutletStock relation
 *
 * @method     ChildProductsQuery leftJoinOutletStockOtherSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildProductsQuery rightJoinOutletStockOtherSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildProductsQuery innerJoinOutletStockOtherSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildProductsQuery joinWithOutletStockOtherSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildProductsQuery leftJoinWithOutletStockOtherSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildProductsQuery rightJoinWithOutletStockOtherSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildProductsQuery innerJoinWithOutletStockOtherSummary() Adds a INNER JOIN clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildProductsQuery leftJoinOutletStockSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildProductsQuery rightJoinOutletStockSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildProductsQuery innerJoinOutletStockSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockSummary relation
 *
 * @method     ChildProductsQuery joinWithOutletStockSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildProductsQuery leftJoinWithOutletStockSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildProductsQuery rightJoinWithOutletStockSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildProductsQuery innerJoinWithOutletStockSummary() Adds a INNER JOIN clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildProductsQuery leftJoinPricebooklines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildProductsQuery rightJoinPricebooklines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildProductsQuery innerJoinPricebooklines($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooklines relation
 *
 * @method     ChildProductsQuery joinWithPricebooklines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooklines relation
 *
 * @method     ChildProductsQuery leftJoinWithPricebooklines() Adds a LEFT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildProductsQuery rightJoinWithPricebooklines() Adds a RIGHT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildProductsQuery innerJoinWithPricebooklines() Adds a INNER JOIN clause and with to the query using the Pricebooklines relation
 *
 * @method     ChildProductsQuery leftJoinProductmedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productmedia relation
 * @method     ChildProductsQuery rightJoinProductmedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productmedia relation
 * @method     ChildProductsQuery innerJoinProductmedia($relationAlias = null) Adds a INNER JOIN clause to the query using the Productmedia relation
 *
 * @method     ChildProductsQuery joinWithProductmedia($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productmedia relation
 *
 * @method     ChildProductsQuery leftJoinWithProductmedia() Adds a LEFT JOIN clause and with to the query using the Productmedia relation
 * @method     ChildProductsQuery rightJoinWithProductmedia() Adds a RIGHT JOIN clause and with to the query using the Productmedia relation
 * @method     ChildProductsQuery innerJoinWithProductmedia() Adds a INNER JOIN clause and with to the query using the Productmedia relation
 *
 * @method     ChildProductsQuery leftJoinShippinglines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglines relation
 * @method     ChildProductsQuery rightJoinShippinglines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglines relation
 * @method     ChildProductsQuery innerJoinShippinglines($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglines relation
 *
 * @method     ChildProductsQuery joinWithShippinglines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglines relation
 *
 * @method     ChildProductsQuery leftJoinWithShippinglines() Adds a LEFT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildProductsQuery rightJoinWithShippinglines() Adds a RIGHT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildProductsQuery innerJoinWithShippinglines() Adds a INNER JOIN clause and with to the query using the Shippinglines relation
 *
 * @method     ChildProductsQuery leftJoinStockTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockTransaction relation
 * @method     ChildProductsQuery rightJoinStockTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockTransaction relation
 * @method     ChildProductsQuery innerJoinStockTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the StockTransaction relation
 *
 * @method     ChildProductsQuery joinWithStockTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockTransaction relation
 *
 * @method     ChildProductsQuery leftJoinWithStockTransaction() Adds a LEFT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildProductsQuery rightJoinWithStockTransaction() Adds a RIGHT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildProductsQuery innerJoinWithStockTransaction() Adds a INNER JOIN clause and with to the query using the StockTransaction relation
 *
 * @method     \entities\CategoriesQuery|\entities\CompanyQuery|\entities\TagsQuery|\entities\UnitmasterQuery|\entities\BrandsQuery|\entities\BrandCompetitionQuery|\entities\OrderlinesQuery|\entities\OutletStockQuery|\entities\OutletStockOtherSummaryQuery|\entities\OutletStockSummaryQuery|\entities\PricebooklinesQuery|\entities\ProductmediaQuery|\entities\ShippinglinesQuery|\entities\StockTransactionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducts|null findOne(?ConnectionInterface $con = null) Return the first ChildProducts matching the query
 * @method     ChildProducts findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProducts matching the query, or a new ChildProducts object populated from the query conditions when no match is found
 *
 * @method     ChildProducts|null findOneById(int $id) Return the first ChildProducts filtered by the id column
 * @method     ChildProducts|null findOneByProductName(string $product_name) Return the first ChildProducts filtered by the product_name column
 * @method     ChildProducts|null findOneByProductSummary(string $product_summary) Return the first ChildProducts filtered by the product_summary column
 * @method     ChildProducts|null findOneByProductDescription(string $product_description) Return the first ChildProducts filtered by the product_description column
 * @method     ChildProducts|null findOneByProductSku(string $product_sku) Return the first ChildProducts filtered by the product_sku column
 * @method     ChildProducts|null findOneByAdditionalData(string $additional_data) Return the first ChildProducts filtered by the additional_data column
 * @method     ChildProducts|null findOneByUnitD(int $unit_d) Return the first ChildProducts filtered by the unit_d column
 * @method     ChildProducts|null findOneByPackingDesc(string $packing_desc) Return the first ChildProducts filtered by the packing_desc column
 * @method     ChildProducts|null findOneByPackingQty(int $packing_qty) Return the first ChildProducts filtered by the packing_qty column
 * @method     ChildProducts|null findOneByCategoryId(int $category_id) Return the first ChildProducts filtered by the category_id column
 * @method     ChildProducts|null findOneByTagId(int $tag_id) Return the first ChildProducts filtered by the tag_id column
 * @method     ChildProducts|null findOneByCompanyId(int $company_id) Return the first ChildProducts filtered by the company_id column
 * @method     ChildProducts|null findOneByProductImages(string $product_images) Return the first ChildProducts filtered by the product_images column
 * @method     ChildProducts|null findOneByIntegrationId(string $integration_id) Return the first ChildProducts filtered by the integration_id column
 * @method     ChildProducts|null findOneByCreatedAt(string $created_at) Return the first ChildProducts filtered by the created_at column
 * @method     ChildProducts|null findOneByUpdatedAt(string $updated_at) Return the first ChildProducts filtered by the updated_at column
 * @method     ChildProducts|null findOneByOrgunitId(int $orgunit_id) Return the first ChildProducts filtered by the orgunit_id column
 * @method     ChildProducts|null findOneByBrandId(int $brand_id) Return the first ChildProducts filtered by the brand_id column
 * @method     ChildProducts|null findOneByBasePrice(string $base_price) Return the first ChildProducts filtered by the base_price column
 * @method     ChildProducts|null findOneByStatus(string $status) Return the first ChildProducts filtered by the status column
 * @method     ChildProducts|null findOneByCanDoRcpa(string $can_do_rcpa) Return the first ChildProducts filtered by the can_do_rcpa column
 *
 * @method     ChildProducts requirePk($key, ?ConnectionInterface $con = null) Return the ChildProducts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOne(?ConnectionInterface $con = null) Return the first ChildProducts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts requireOneById(int $id) Return the first ChildProducts filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductName(string $product_name) Return the first ChildProducts filtered by the product_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductSummary(string $product_summary) Return the first ChildProducts filtered by the product_summary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductDescription(string $product_description) Return the first ChildProducts filtered by the product_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductSku(string $product_sku) Return the first ChildProducts filtered by the product_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByAdditionalData(string $additional_data) Return the first ChildProducts filtered by the additional_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByUnitD(int $unit_d) Return the first ChildProducts filtered by the unit_d column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByPackingDesc(string $packing_desc) Return the first ChildProducts filtered by the packing_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByPackingQty(int $packing_qty) Return the first ChildProducts filtered by the packing_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByCategoryId(int $category_id) Return the first ChildProducts filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByTagId(int $tag_id) Return the first ChildProducts filtered by the tag_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByCompanyId(int $company_id) Return the first ChildProducts filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByProductImages(string $product_images) Return the first ChildProducts filtered by the product_images column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByIntegrationId(string $integration_id) Return the first ChildProducts filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByCreatedAt(string $created_at) Return the first ChildProducts filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByUpdatedAt(string $updated_at) Return the first ChildProducts filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByOrgunitId(int $orgunit_id) Return the first ChildProducts filtered by the orgunit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByBrandId(int $brand_id) Return the first ChildProducts filtered by the brand_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByBasePrice(string $base_price) Return the first ChildProducts filtered by the base_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByStatus(string $status) Return the first ChildProducts filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducts requireOneByCanDoRcpa(string $can_do_rcpa) Return the first ChildProducts filtered by the can_do_rcpa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducts[]|Collection find(?ConnectionInterface $con = null) Return ChildProducts objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProducts> find(?ConnectionInterface $con = null) Return ChildProducts objects based on current ModelCriteria
 *
 * @method     ChildProducts[]|Collection findById(int|array<int> $id) Return ChildProducts objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProducts> findById(int|array<int> $id) Return ChildProducts objects filtered by the id column
 * @method     ChildProducts[]|Collection findByProductName(string|array<string> $product_name) Return ChildProducts objects filtered by the product_name column
 * @psalm-method Collection&\Traversable<ChildProducts> findByProductName(string|array<string> $product_name) Return ChildProducts objects filtered by the product_name column
 * @method     ChildProducts[]|Collection findByProductSummary(string|array<string> $product_summary) Return ChildProducts objects filtered by the product_summary column
 * @psalm-method Collection&\Traversable<ChildProducts> findByProductSummary(string|array<string> $product_summary) Return ChildProducts objects filtered by the product_summary column
 * @method     ChildProducts[]|Collection findByProductDescription(string|array<string> $product_description) Return ChildProducts objects filtered by the product_description column
 * @psalm-method Collection&\Traversable<ChildProducts> findByProductDescription(string|array<string> $product_description) Return ChildProducts objects filtered by the product_description column
 * @method     ChildProducts[]|Collection findByProductSku(string|array<string> $product_sku) Return ChildProducts objects filtered by the product_sku column
 * @psalm-method Collection&\Traversable<ChildProducts> findByProductSku(string|array<string> $product_sku) Return ChildProducts objects filtered by the product_sku column
 * @method     ChildProducts[]|Collection findByAdditionalData(string|array<string> $additional_data) Return ChildProducts objects filtered by the additional_data column
 * @psalm-method Collection&\Traversable<ChildProducts> findByAdditionalData(string|array<string> $additional_data) Return ChildProducts objects filtered by the additional_data column
 * @method     ChildProducts[]|Collection findByUnitD(int|array<int> $unit_d) Return ChildProducts objects filtered by the unit_d column
 * @psalm-method Collection&\Traversable<ChildProducts> findByUnitD(int|array<int> $unit_d) Return ChildProducts objects filtered by the unit_d column
 * @method     ChildProducts[]|Collection findByPackingDesc(string|array<string> $packing_desc) Return ChildProducts objects filtered by the packing_desc column
 * @psalm-method Collection&\Traversable<ChildProducts> findByPackingDesc(string|array<string> $packing_desc) Return ChildProducts objects filtered by the packing_desc column
 * @method     ChildProducts[]|Collection findByPackingQty(int|array<int> $packing_qty) Return ChildProducts objects filtered by the packing_qty column
 * @psalm-method Collection&\Traversable<ChildProducts> findByPackingQty(int|array<int> $packing_qty) Return ChildProducts objects filtered by the packing_qty column
 * @method     ChildProducts[]|Collection findByCategoryId(int|array<int> $category_id) Return ChildProducts objects filtered by the category_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByCategoryId(int|array<int> $category_id) Return ChildProducts objects filtered by the category_id column
 * @method     ChildProducts[]|Collection findByTagId(int|array<int> $tag_id) Return ChildProducts objects filtered by the tag_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByTagId(int|array<int> $tag_id) Return ChildProducts objects filtered by the tag_id column
 * @method     ChildProducts[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildProducts objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByCompanyId(int|array<int> $company_id) Return ChildProducts objects filtered by the company_id column
 * @method     ChildProducts[]|Collection findByProductImages(string|array<string> $product_images) Return ChildProducts objects filtered by the product_images column
 * @psalm-method Collection&\Traversable<ChildProducts> findByProductImages(string|array<string> $product_images) Return ChildProducts objects filtered by the product_images column
 * @method     ChildProducts[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildProducts objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByIntegrationId(string|array<string> $integration_id) Return ChildProducts objects filtered by the integration_id column
 * @method     ChildProducts[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildProducts objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildProducts> findByCreatedAt(string|array<string> $created_at) Return ChildProducts objects filtered by the created_at column
 * @method     ChildProducts[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildProducts objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildProducts> findByUpdatedAt(string|array<string> $updated_at) Return ChildProducts objects filtered by the updated_at column
 * @method     ChildProducts[]|Collection findByOrgunitId(int|array<int> $orgunit_id) Return ChildProducts objects filtered by the orgunit_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByOrgunitId(int|array<int> $orgunit_id) Return ChildProducts objects filtered by the orgunit_id column
 * @method     ChildProducts[]|Collection findByBrandId(int|array<int> $brand_id) Return ChildProducts objects filtered by the brand_id column
 * @psalm-method Collection&\Traversable<ChildProducts> findByBrandId(int|array<int> $brand_id) Return ChildProducts objects filtered by the brand_id column
 * @method     ChildProducts[]|Collection findByBasePrice(string|array<string> $base_price) Return ChildProducts objects filtered by the base_price column
 * @psalm-method Collection&\Traversable<ChildProducts> findByBasePrice(string|array<string> $base_price) Return ChildProducts objects filtered by the base_price column
 * @method     ChildProducts[]|Collection findByStatus(string|array<string> $status) Return ChildProducts objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildProducts> findByStatus(string|array<string> $status) Return ChildProducts objects filtered by the status column
 * @method     ChildProducts[]|Collection findByCanDoRcpa(string|array<string> $can_do_rcpa) Return ChildProducts objects filtered by the can_do_rcpa column
 * @psalm-method Collection&\Traversable<ChildProducts> findByCanDoRcpa(string|array<string> $can_do_rcpa) Return ChildProducts objects filtered by the can_do_rcpa column
 *
 * @method     ChildProducts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProducts> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ProductsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ProductsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Products', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductsQuery) {
            return $criteria;
        }
        $query = new ChildProductsQuery();
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
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProducts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_name, product_summary, product_description, product_sku, additional_data, unit_d, packing_desc, packing_qty, category_id, tag_id, company_id, product_images, integration_id, created_at, updated_at, orgunit_id, brand_id, base_price, status, can_do_rcpa FROM products WHERE id = :p0';
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
            /** @var ChildProducts $obj */
            $obj = new ChildProducts();
            $obj->hydrate($row);
            ProductsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProducts|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProductsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProductsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ProductsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_name column
     *
     * Example usage:
     * <code>
     * $query->filterByProductName('fooValue');   // WHERE product_name = 'fooValue'
     * $query->filterByProductName('%fooValue%', Criteria::LIKE); // WHERE product_name LIKE '%fooValue%'
     * $query->filterByProductName(['foo', 'bar']); // WHERE product_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductName($productName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRODUCT_NAME, $productName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_summary column
     *
     * Example usage:
     * <code>
     * $query->filterByProductSummary('fooValue');   // WHERE product_summary = 'fooValue'
     * $query->filterByProductSummary('%fooValue%', Criteria::LIKE); // WHERE product_summary LIKE '%fooValue%'
     * $query->filterByProductSummary(['foo', 'bar']); // WHERE product_summary IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productSummary The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductSummary($productSummary = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productSummary)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRODUCT_SUMMARY, $productSummary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_description column
     *
     * Example usage:
     * <code>
     * $query->filterByProductDescription('fooValue');   // WHERE product_description = 'fooValue'
     * $query->filterByProductDescription('%fooValue%', Criteria::LIKE); // WHERE product_description LIKE '%fooValue%'
     * $query->filterByProductDescription(['foo', 'bar']); // WHERE product_description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productDescription The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductDescription($productDescription = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productDescription)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRODUCT_DESCRIPTION, $productDescription, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByProductSku('fooValue');   // WHERE product_sku = 'fooValue'
     * $query->filterByProductSku('%fooValue%', Criteria::LIKE); // WHERE product_sku LIKE '%fooValue%'
     * $query->filterByProductSku(['foo', 'bar']); // WHERE product_sku IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productSku The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductSku($productSku = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productSku)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRODUCT_SKU, $productSku, $comparison);

        return $this;
    }

    /**
     * Filter the query on the additional_data column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalData('fooValue');   // WHERE additional_data = 'fooValue'
     * $query->filterByAdditionalData('%fooValue%', Criteria::LIKE); // WHERE additional_data LIKE '%fooValue%'
     * $query->filterByAdditionalData(['foo', 'bar']); // WHERE additional_data IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $additionalData The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAdditionalData($additionalData = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($additionalData)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_ADDITIONAL_DATA, $additionalData, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_d column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitD(1234); // WHERE unit_d = 1234
     * $query->filterByUnitD(array(12, 34)); // WHERE unit_d IN (12, 34)
     * $query->filterByUnitD(array('min' => 12)); // WHERE unit_d > 12
     * </code>
     *
     * @see       filterByUnitmaster()
     *
     * @param mixed $unitD The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitD($unitD = null, ?string $comparison = null)
    {
        if (is_array($unitD)) {
            $useMinMax = false;
            if (isset($unitD['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_UNIT_D, $unitD['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitD['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_UNIT_D, $unitD['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_UNIT_D, $unitD, $comparison);

        return $this;
    }

    /**
     * Filter the query on the packing_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByPackingDesc('fooValue');   // WHERE packing_desc = 'fooValue'
     * $query->filterByPackingDesc('%fooValue%', Criteria::LIKE); // WHERE packing_desc LIKE '%fooValue%'
     * $query->filterByPackingDesc(['foo', 'bar']); // WHERE packing_desc IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $packingDesc The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPackingDesc($packingDesc = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($packingDesc)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PACKING_DESC, $packingDesc, $comparison);

        return $this;
    }

    /**
     * Filter the query on the packing_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByPackingQty(1234); // WHERE packing_qty = 1234
     * $query->filterByPackingQty(array(12, 34)); // WHERE packing_qty IN (12, 34)
     * $query->filterByPackingQty(array('min' => 12)); // WHERE packing_qty > 12
     * </code>
     *
     * @param mixed $packingQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPackingQty($packingQty = null, ?string $comparison = null)
    {
        if (is_array($packingQty)) {
            $useMinMax = false;
            if (isset($packingQty['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_PACKING_QTY, $packingQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packingQty['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_PACKING_QTY, $packingQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PACKING_QTY, $packingQty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategories()
     *
     * @param mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, ?string $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_CATEGORY_ID, $categoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tag_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTagId(1234); // WHERE tag_id = 1234
     * $query->filterByTagId(array(12, 34)); // WHERE tag_id IN (12, 34)
     * $query->filterByTagId(array('min' => 12)); // WHERE tag_id > 12
     * </code>
     *
     * @see       filterByTags()
     *
     * @param mixed $tagId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTagId($tagId = null, ?string $comparison = null)
    {
        if (is_array($tagId)) {
            $useMinMax = false;
            if (isset($tagId['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_TAG_ID, $tagId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tagId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_TAG_ID, $tagId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_TAG_ID, $tagId, $comparison);

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
     * @see       filterByCompany()
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
                $this->addUsingAlias(ProductsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_images column
     *
     * Example usage:
     * <code>
     * $query->filterByProductImages('fooValue');   // WHERE product_images = 'fooValue'
     * $query->filterByProductImages('%fooValue%', Criteria::LIKE); // WHERE product_images LIKE '%fooValue%'
     * $query->filterByProductImages(['foo', 'bar']); // WHERE product_images IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productImages The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductImages($productImages = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productImages)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_PRODUCT_IMAGES, $productImages, $comparison);

        return $this;
    }

    /**
     * Filter the query on the integration_id column
     *
     * Example usage:
     * <code>
     * $query->filterByIntegrationId('fooValue');   // WHERE integration_id = 'fooValue'
     * $query->filterByIntegrationId('%fooValue%', Criteria::LIKE); // WHERE integration_id LIKE '%fooValue%'
     * $query->filterByIntegrationId(['foo', 'bar']); // WHERE integration_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $integrationId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntegrationId($integrationId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($integrationId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                $this->addUsingAlias(ProductsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(ProductsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(ProductsTableMap::COL_ORGUNIT_ID, $orgunitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_ORGUNIT_ID, $orgunitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_ORGUNIT_ID, $orgunitId, $comparison);

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
     * @see       filterByBrands()
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
                $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brandId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the base_price column
     *
     * Example usage:
     * <code>
     * $query->filterByBasePrice(1234); // WHERE base_price = 1234
     * $query->filterByBasePrice(array(12, 34)); // WHERE base_price IN (12, 34)
     * $query->filterByBasePrice(array('min' => 12)); // WHERE base_price > 12
     * </code>
     *
     * @param mixed $basePrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBasePrice($basePrice = null, ?string $comparison = null)
    {
        if (is_array($basePrice)) {
            $useMinMax = false;
            if (isset($basePrice['min'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BASE_PRICE, $basePrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($basePrice['max'])) {
                $this->addUsingAlias(ProductsTableMap::COL_BASE_PRICE, $basePrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_BASE_PRICE, $basePrice, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the can_do_rcpa column
     *
     * Example usage:
     * <code>
     * $query->filterByCanDoRcpa('fooValue');   // WHERE can_do_rcpa = 'fooValue'
     * $query->filterByCanDoRcpa('%fooValue%', Criteria::LIKE); // WHERE can_do_rcpa LIKE '%fooValue%'
     * $query->filterByCanDoRcpa(['foo', 'bar']); // WHERE can_do_rcpa IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $canDoRcpa The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanDoRcpa($canDoRcpa = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($canDoRcpa)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductsTableMap::COL_CAN_DO_RCPA, $canDoRcpa, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Categories object
     *
     * @param \entities\Categories|ObjectCollection $categories The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategories($categories, ?string $comparison = null)
    {
        if ($categories instanceof \entities\Categories) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_CATEGORY_ID, $categories->getId(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_CATEGORY_ID, $categories->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCategories() only accepts arguments of type \entities\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCategories(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categories');

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
            $this->addJoinObject($join, 'Categories');
        }

        return $this;
    }

    /**
     * Use the Categories relation Categories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categories', '\entities\CategoriesQuery');
    }

    /**
     * Use the Categories relation Categories object
     *
     * @param callable(\entities\CategoriesQuery):\entities\CategoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCategoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCategoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Categories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CategoriesQuery The inner query object of the EXISTS statement
     */
    public function useCategoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CategoriesQuery */
        $q = $this->useExistsQuery('Categories', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Categories table for a NOT EXISTS query.
     *
     * @see useCategoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CategoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCategoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CategoriesQuery */
        $q = $this->useExistsQuery('Categories', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Categories table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CategoriesQuery The inner query object of the IN statement
     */
    public function useInCategoriesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CategoriesQuery */
        $q = $this->useInQuery('Categories', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Categories table for a NOT IN query.
     *
     * @see useCategoriesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CategoriesQuery The inner query object of the NOT IN statement
     */
    public function useNotInCategoriesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CategoriesQuery */
        $q = $this->useInQuery('Categories', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(ProductsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Tags object
     *
     * @param \entities\Tags|ObjectCollection $tags The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags, ?string $comparison = null)
    {
        if ($tags instanceof \entities\Tags) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_TAG_ID, $tags->getId(), $comparison);
        } elseif ($tags instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_TAG_ID, $tags->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTags() only accepts arguments of type \entities\Tags or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tags relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTags(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tags');

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
            $this->addJoinObject($join, 'Tags');
        }

        return $this;
    }

    /**
     * Use the Tags relation Tags object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TagsQuery A secondary query class using the current class as primary query
     */
    public function useTagsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTags($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tags', '\entities\TagsQuery');
    }

    /**
     * Use the Tags relation Tags object
     *
     * @param callable(\entities\TagsQuery):\entities\TagsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTagsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTagsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tags table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TagsQuery The inner query object of the EXISTS statement
     */
    public function useTagsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TagsQuery */
        $q = $this->useExistsQuery('Tags', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tags table for a NOT EXISTS query.
     *
     * @see useTagsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TagsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTagsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TagsQuery */
        $q = $this->useExistsQuery('Tags', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tags table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TagsQuery The inner query object of the IN statement
     */
    public function useInTagsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TagsQuery */
        $q = $this->useInQuery('Tags', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tags table for a NOT IN query.
     *
     * @see useTagsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TagsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTagsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TagsQuery */
        $q = $this->useInQuery('Tags', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Unitmaster object
     *
     * @param \entities\Unitmaster|ObjectCollection $unitmaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitmaster($unitmaster, ?string $comparison = null)
    {
        if ($unitmaster instanceof \entities\Unitmaster) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_UNIT_D, $unitmaster->getUnitId(), $comparison);
        } elseif ($unitmaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_UNIT_D, $unitmaster->toKeyValue('PrimaryKey', 'UnitId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUnitmaster() only accepts arguments of type \entities\Unitmaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unitmaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUnitmaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unitmaster');

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
            $this->addJoinObject($join, 'Unitmaster');
        }

        return $this;
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UnitmasterQuery A secondary query class using the current class as primary query
     */
    public function useUnitmasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUnitmaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unitmaster', '\entities\UnitmasterQuery');
    }

    /**
     * Use the Unitmaster relation Unitmaster object
     *
     * @param callable(\entities\UnitmasterQuery):\entities\UnitmasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUnitmasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUnitmasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Unitmaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UnitmasterQuery The inner query object of the EXISTS statement
     */
    public function useUnitmasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT EXISTS query.
     *
     * @see useUnitmasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useUnitmasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useExistsQuery('Unitmaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UnitmasterQuery The inner query object of the IN statement
     */
    public function useInUnitmasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Unitmaster table for a NOT IN query.
     *
     * @see useUnitmasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UnitmasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInUnitmasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UnitmasterQuery */
        $q = $this->useInQuery('Unitmaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Brands object
     *
     * @param \entities\Brands|ObjectCollection $brands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \entities\Brands) {
            return $this
                ->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductsTableMap::COL_BRAND_ID, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrands() only accepts arguments of type \entities\Brands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Brands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrands(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Brands');

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
            $this->addJoinObject($join, 'Brands');
        }

        return $this;
    }

    /**
     * Use the Brands relation Brands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandsQuery A secondary query class using the current class as primary query
     */
    public function useBrandsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Brands', '\entities\BrandsQuery');
    }

    /**
     * Use the Brands relation Brands object
     *
     * @param callable(\entities\BrandsQuery):\entities\BrandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Brands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandsQuery The inner query object of the EXISTS statement
     */
    public function useBrandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT EXISTS query.
     *
     * @see useBrandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useExistsQuery('Brands', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Brands table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandsQuery The inner query object of the IN statement
     */
    public function useInBrandsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Brands table for a NOT IN query.
     *
     * @see useBrandsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandsQuery */
        $q = $this->useInQuery('Brands', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCompetition object
     *
     * @param \entities\BrandCompetition|ObjectCollection $brandCompetition the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCompetition($brandCompetition, ?string $comparison = null)
    {
        if ($brandCompetition instanceof \entities\BrandCompetition) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $brandCompetition->getProductId(), $comparison);

            return $this;
        } elseif ($brandCompetition instanceof ObjectCollection) {
            $this
                ->useBrandCompetitionQuery()
                ->filterByPrimaryKeys($brandCompetition->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCompetition() only accepts arguments of type \entities\BrandCompetition or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCompetition relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCompetition(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCompetition');

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
            $this->addJoinObject($join, 'BrandCompetition');
        }

        return $this;
    }

    /**
     * Use the BrandCompetition relation BrandCompetition object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCompetitionQuery A secondary query class using the current class as primary query
     */
    public function useBrandCompetitionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCompetition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCompetition', '\entities\BrandCompetitionQuery');
    }

    /**
     * Use the BrandCompetition relation BrandCompetition object
     *
     * @param callable(\entities\BrandCompetitionQuery):\entities\BrandCompetitionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCompetitionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCompetitionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCompetition table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the EXISTS statement
     */
    public function useBrandCompetitionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useExistsQuery('BrandCompetition', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for a NOT EXISTS query.
     *
     * @see useBrandCompetitionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCompetitionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useExistsQuery('BrandCompetition', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the IN statement
     */
    public function useInBrandCompetitionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useInQuery('BrandCompetition', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCompetition table for a NOT IN query.
     *
     * @see useBrandCompetitionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCompetitionQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCompetitionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCompetitionQuery */
        $q = $this->useInQuery('BrandCompetition', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orderlines object
     *
     * @param \entities\Orderlines|ObjectCollection $orderlines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderlines($orderlines, ?string $comparison = null)
    {
        if ($orderlines instanceof \entities\Orderlines) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $orderlines->getProductId(), $comparison);

            return $this;
        } elseif ($orderlines instanceof ObjectCollection) {
            $this
                ->useOrderlinesQuery()
                ->filterByPrimaryKeys($orderlines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderlines() only accepts arguments of type \entities\Orderlines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orderlines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderlines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orderlines');

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
            $this->addJoinObject($join, 'Orderlines');
        }

        return $this;
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderlinesQuery A secondary query class using the current class as primary query
     */
    public function useOrderlinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderlines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orderlines', '\entities\OrderlinesQuery');
    }

    /**
     * Use the Orderlines relation Orderlines object
     *
     * @param callable(\entities\OrderlinesQuery):\entities\OrderlinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderlinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderlinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orderlines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderlinesQuery The inner query object of the EXISTS statement
     */
    public function useOrderlinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT EXISTS query.
     *
     * @see useOrderlinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderlinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useExistsQuery('Orderlines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orderlines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderlinesQuery The inner query object of the IN statement
     */
    public function useInOrderlinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orderlines table for a NOT IN query.
     *
     * @see useOrderlinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderlinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderlinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderlinesQuery */
        $q = $this->useInQuery('Orderlines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletStock object
     *
     * @param \entities\OutletStock|ObjectCollection $outletStock the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStock($outletStock, ?string $comparison = null)
    {
        if ($outletStock instanceof \entities\OutletStock) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $outletStock->getProductId(), $comparison);

            return $this;
        } elseif ($outletStock instanceof ObjectCollection) {
            $this
                ->useOutletStockQuery()
                ->filterByPrimaryKeys($outletStock->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStock() only accepts arguments of type \entities\OutletStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStock');

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
            $this->addJoinObject($join, 'OutletStock');
        }

        return $this;
    }

    /**
     * Use the OutletStock relation OutletStock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStock', '\entities\OutletStockQuery');
    }

    /**
     * Use the OutletStock relation OutletStock object
     *
     * @param callable(\entities\OutletStockQuery):\entities\OutletStockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useExistsQuery('OutletStock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStock table for a NOT EXISTS query.
     *
     * @see useOutletStockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useExistsQuery('OutletStock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockQuery The inner query object of the IN statement
     */
    public function useInOutletStockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useInQuery('OutletStock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStock table for a NOT IN query.
     *
     * @see useOutletStockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockQuery */
        $q = $this->useInQuery('OutletStock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletStockOtherSummary object
     *
     * @param \entities\OutletStockOtherSummary|ObjectCollection $outletStockOtherSummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockOtherSummary($outletStockOtherSummary, ?string $comparison = null)
    {
        if ($outletStockOtherSummary instanceof \entities\OutletStockOtherSummary) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $outletStockOtherSummary->getProductId(), $comparison);

            return $this;
        } elseif ($outletStockOtherSummary instanceof ObjectCollection) {
            $this
                ->useOutletStockOtherSummaryQuery()
                ->filterByPrimaryKeys($outletStockOtherSummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStockOtherSummary() only accepts arguments of type \entities\OutletStockOtherSummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStockOtherSummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStockOtherSummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStockOtherSummary');

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
            $this->addJoinObject($join, 'OutletStockOtherSummary');
        }

        return $this;
    }

    /**
     * Use the OutletStockOtherSummary relation OutletStockOtherSummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockOtherSummaryQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockOtherSummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStockOtherSummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStockOtherSummary', '\entities\OutletStockOtherSummaryQuery');
    }

    /**
     * Use the OutletStockOtherSummary relation OutletStockOtherSummary object
     *
     * @param callable(\entities\OutletStockOtherSummaryQuery):\entities\OutletStockOtherSummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockOtherSummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockOtherSummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockOtherSummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useExistsQuery('OutletStockOtherSummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for a NOT EXISTS query.
     *
     * @see useOutletStockOtherSummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockOtherSummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useExistsQuery('OutletStockOtherSummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the IN statement
     */
    public function useInOutletStockOtherSummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useInQuery('OutletStockOtherSummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStockOtherSummary table for a NOT IN query.
     *
     * @see useOutletStockOtherSummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockOtherSummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockOtherSummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockOtherSummaryQuery */
        $q = $this->useInQuery('OutletStockOtherSummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletStockSummary object
     *
     * @param \entities\OutletStockSummary|ObjectCollection $outletStockSummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStockSummary($outletStockSummary, ?string $comparison = null)
    {
        if ($outletStockSummary instanceof \entities\OutletStockSummary) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $outletStockSummary->getProductId(), $comparison);

            return $this;
        } elseif ($outletStockSummary instanceof ObjectCollection) {
            $this
                ->useOutletStockSummaryQuery()
                ->filterByPrimaryKeys($outletStockSummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletStockSummary() only accepts arguments of type \entities\OutletStockSummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletStockSummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletStockSummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletStockSummary');

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
            $this->addJoinObject($join, 'OutletStockSummary');
        }

        return $this;
    }

    /**
     * Use the OutletStockSummary relation OutletStockSummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletStockSummaryQuery A secondary query class using the current class as primary query
     */
    public function useOutletStockSummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletStockSummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletStockSummary', '\entities\OutletStockSummaryQuery');
    }

    /**
     * Use the OutletStockSummary relation OutletStockSummary object
     *
     * @param callable(\entities\OutletStockSummaryQuery):\entities\OutletStockSummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletStockSummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletStockSummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletStockSummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the EXISTS statement
     */
    public function useOutletStockSummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useExistsQuery('OutletStockSummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for a NOT EXISTS query.
     *
     * @see useOutletStockSummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletStockSummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useExistsQuery('OutletStockSummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the IN statement
     */
    public function useInOutletStockSummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useInQuery('OutletStockSummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletStockSummary table for a NOT IN query.
     *
     * @see useOutletStockSummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletStockSummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletStockSummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletStockSummaryQuery */
        $q = $this->useInQuery('OutletStockSummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Pricebooklines object
     *
     * @param \entities\Pricebooklines|ObjectCollection $pricebooklines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebooklines($pricebooklines, ?string $comparison = null)
    {
        if ($pricebooklines instanceof \entities\Pricebooklines) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $pricebooklines->getProductId(), $comparison);

            return $this;
        } elseif ($pricebooklines instanceof ObjectCollection) {
            $this
                ->usePricebooklinesQuery()
                ->filterByPrimaryKeys($pricebooklines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPricebooklines() only accepts arguments of type \entities\Pricebooklines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pricebooklines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPricebooklines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pricebooklines');

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
            $this->addJoinObject($join, 'Pricebooklines');
        }

        return $this;
    }

    /**
     * Use the Pricebooklines relation Pricebooklines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PricebooklinesQuery A secondary query class using the current class as primary query
     */
    public function usePricebooklinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPricebooklines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pricebooklines', '\entities\PricebooklinesQuery');
    }

    /**
     * Use the Pricebooklines relation Pricebooklines object
     *
     * @param callable(\entities\PricebooklinesQuery):\entities\PricebooklinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPricebooklinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePricebooklinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pricebooklines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PricebooklinesQuery The inner query object of the EXISTS statement
     */
    public function usePricebooklinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useExistsQuery('Pricebooklines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for a NOT EXISTS query.
     *
     * @see usePricebooklinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooklinesQuery The inner query object of the NOT EXISTS statement
     */
    public function usePricebooklinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useExistsQuery('Pricebooklines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PricebooklinesQuery The inner query object of the IN statement
     */
    public function useInPricebooklinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useInQuery('Pricebooklines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pricebooklines table for a NOT IN query.
     *
     * @see usePricebooklinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooklinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInPricebooklinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooklinesQuery */
        $q = $this->useInQuery('Pricebooklines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Productmedia object
     *
     * @param \entities\Productmedia|ObjectCollection $productmedia the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductmedia($productmedia, ?string $comparison = null)
    {
        if ($productmedia instanceof \entities\Productmedia) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $productmedia->getProductId(), $comparison);

            return $this;
        } elseif ($productmedia instanceof ObjectCollection) {
            $this
                ->useProductmediaQuery()
                ->filterByPrimaryKeys($productmedia->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductmedia() only accepts arguments of type \entities\Productmedia or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Productmedia relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductmedia(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Productmedia');

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
            $this->addJoinObject($join, 'Productmedia');
        }

        return $this;
    }

    /**
     * Use the Productmedia relation Productmedia object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductmediaQuery A secondary query class using the current class as primary query
     */
    public function useProductmediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductmedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Productmedia', '\entities\ProductmediaQuery');
    }

    /**
     * Use the Productmedia relation Productmedia object
     *
     * @param callable(\entities\ProductmediaQuery):\entities\ProductmediaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductmediaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductmediaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Productmedia table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductmediaQuery The inner query object of the EXISTS statement
     */
    public function useProductmediaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductmediaQuery */
        $q = $this->useExistsQuery('Productmedia', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Productmedia table for a NOT EXISTS query.
     *
     * @see useProductmediaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductmediaQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductmediaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductmediaQuery */
        $q = $this->useExistsQuery('Productmedia', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Productmedia table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductmediaQuery The inner query object of the IN statement
     */
    public function useInProductmediaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductmediaQuery */
        $q = $this->useInQuery('Productmedia', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Productmedia table for a NOT IN query.
     *
     * @see useProductmediaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductmediaQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductmediaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductmediaQuery */
        $q = $this->useInQuery('Productmedia', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Shippinglines object
     *
     * @param \entities\Shippinglines|ObjectCollection $shippinglines the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippinglines($shippinglines, ?string $comparison = null)
    {
        if ($shippinglines instanceof \entities\Shippinglines) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $shippinglines->getProductId(), $comparison);

            return $this;
        } elseif ($shippinglines instanceof ObjectCollection) {
            $this
                ->useShippinglinesQuery()
                ->filterByPrimaryKeys($shippinglines->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippinglines() only accepts arguments of type \entities\Shippinglines or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippinglines relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippinglines(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippinglines');

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
            $this->addJoinObject($join, 'Shippinglines');
        }

        return $this;
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippinglinesQuery A secondary query class using the current class as primary query
     */
    public function useShippinglinesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippinglines($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippinglines', '\entities\ShippinglinesQuery');
    }

    /**
     * Use the Shippinglines relation Shippinglines object
     *
     * @param callable(\entities\ShippinglinesQuery):\entities\ShippinglinesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippinglinesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippinglinesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippinglines table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippinglinesQuery The inner query object of the EXISTS statement
     */
    public function useShippinglinesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT EXISTS query.
     *
     * @see useShippinglinesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippinglinesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useExistsQuery('Shippinglines', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippinglinesQuery The inner query object of the IN statement
     */
    public function useInShippinglinesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippinglines table for a NOT IN query.
     *
     * @see useShippinglinesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippinglinesQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippinglinesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippinglinesQuery */
        $q = $this->useInQuery('Shippinglines', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\StockTransaction object
     *
     * @param \entities\StockTransaction|ObjectCollection $stockTransaction the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockTransaction($stockTransaction, ?string $comparison = null)
    {
        if ($stockTransaction instanceof \entities\StockTransaction) {
            $this
                ->addUsingAlias(ProductsTableMap::COL_ID, $stockTransaction->getProductId(), $comparison);

            return $this;
        } elseif ($stockTransaction instanceof ObjectCollection) {
            $this
                ->useStockTransactionQuery()
                ->filterByPrimaryKeys($stockTransaction->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockTransaction() only accepts arguments of type \entities\StockTransaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockTransaction relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockTransaction(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockTransaction');

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
            $this->addJoinObject($join, 'StockTransaction');
        }

        return $this;
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockTransactionQuery A secondary query class using the current class as primary query
     */
    public function useStockTransactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockTransaction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockTransaction', '\entities\StockTransactionQuery');
    }

    /**
     * Use the StockTransaction relation StockTransaction object
     *
     * @param callable(\entities\StockTransactionQuery):\entities\StockTransactionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockTransactionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockTransactionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockTransaction table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockTransactionQuery The inner query object of the EXISTS statement
     */
    public function useStockTransactionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT EXISTS query.
     *
     * @see useStockTransactionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockTransactionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useExistsQuery('StockTransaction', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockTransactionQuery The inner query object of the IN statement
     */
    public function useInStockTransactionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockTransaction table for a NOT IN query.
     *
     * @see useStockTransactionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockTransactionQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockTransactionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockTransactionQuery */
        $q = $this->useInQuery('StockTransaction', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildProducts $products Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($products = null)
    {
        if ($products) {
            $this->addUsingAlias(ProductsTableMap::COL_ID, $products->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductsTableMap::clearInstancePool();
            ProductsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

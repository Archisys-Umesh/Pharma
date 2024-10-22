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
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Map\OutletsTableMap;

/**
 * Base class that represents a query for the `outlets` table.
 *
 * @method     ChildOutletsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOutletsQuery orderByOutletMediaId($order = Criteria::ASC) Order by the outlet_media_id column
 * @method     ChildOutletsQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildOutletsQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildOutletsQuery orderByOutletEmail($order = Criteria::ASC) Order by the outlet_email column
 * @method     ChildOutletsQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildOutletsQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildOutletsQuery orderByOutletOpeningDate($order = Criteria::ASC) Order by the outlet_opening_date column
 * @method     ChildOutletsQuery orderByOutletContactName($order = Criteria::ASC) Order by the outlet_contact_name column
 * @method     ChildOutletsQuery orderByOutletLandlineno($order = Criteria::ASC) Order by the outlet_landlineno column
 * @method     ChildOutletsQuery orderByOutletAltLandlineno($order = Criteria::ASC) Order by the outlet_alt_landlineno column
 * @method     ChildOutletsQuery orderByOutletContactBday($order = Criteria::ASC) Order by the outlet_contact_bday column
 * @method     ChildOutletsQuery orderByOutletContactAnniversary($order = Criteria::ASC) Order by the outlet_contact_anniversary column
 * @method     ChildOutletsQuery orderByOutletIsdCode($order = Criteria::ASC) Order by the outlet_isd_code column
 * @method     ChildOutletsQuery orderByOutletContactNo($order = Criteria::ASC) Order by the outlet_contact_no column
 * @method     ChildOutletsQuery orderByOutletAltContactNo($order = Criteria::ASC) Order by the outlet_alt_contact_no column
 * @method     ChildOutletsQuery orderByOutletStatus($order = Criteria::ASC) Order by the outlet_status column
 * @method     ChildOutletsQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildOutletsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletsQuery orderByOutletOtp($order = Criteria::ASC) Order by the outlet_otp column
 * @method     ChildOutletsQuery orderByOutletVerified($order = Criteria::ASC) Order by the outlet_verified column
 * @method     ChildOutletsQuery orderByOutletCreatedBy($order = Criteria::ASC) Order by the outlet_created_by column
 * @method     ChildOutletsQuery orderByOutletApprovedBy($order = Criteria::ASC) Order by the outlet_approved_by column
 * @method     ChildOutletsQuery orderByOutletPotential($order = Criteria::ASC) Order by the outlet_potential column
 * @method     ChildOutletsQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 * @method     ChildOutletsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildOutletsQuery orderByOutletQualification($order = Criteria::ASC) Order by the outlet_qualification column
 * @method     ChildOutletsQuery orderByOutletRegno($order = Criteria::ASC) Order by the outlet_regno column
 * @method     ChildOutletsQuery orderByOutletMaritalStatus($order = Criteria::ASC) Order by the outlet_marital_status column
 * @method     ChildOutletsQuery orderByOutletMedia($order = Criteria::ASC) Order by the outlet_media column
 *
 * @method     ChildOutletsQuery groupById() Group by the id column
 * @method     ChildOutletsQuery groupByOutletMediaId() Group by the outlet_media_id column
 * @method     ChildOutletsQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildOutletsQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildOutletsQuery groupByOutletEmail() Group by the outlet_email column
 * @method     ChildOutletsQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildOutletsQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildOutletsQuery groupByOutletOpeningDate() Group by the outlet_opening_date column
 * @method     ChildOutletsQuery groupByOutletContactName() Group by the outlet_contact_name column
 * @method     ChildOutletsQuery groupByOutletLandlineno() Group by the outlet_landlineno column
 * @method     ChildOutletsQuery groupByOutletAltLandlineno() Group by the outlet_alt_landlineno column
 * @method     ChildOutletsQuery groupByOutletContactBday() Group by the outlet_contact_bday column
 * @method     ChildOutletsQuery groupByOutletContactAnniversary() Group by the outlet_contact_anniversary column
 * @method     ChildOutletsQuery groupByOutletIsdCode() Group by the outlet_isd_code column
 * @method     ChildOutletsQuery groupByOutletContactNo() Group by the outlet_contact_no column
 * @method     ChildOutletsQuery groupByOutletAltContactNo() Group by the outlet_alt_contact_no column
 * @method     ChildOutletsQuery groupByOutletStatus() Group by the outlet_status column
 * @method     ChildOutletsQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildOutletsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletsQuery groupByOutletOtp() Group by the outlet_otp column
 * @method     ChildOutletsQuery groupByOutletVerified() Group by the outlet_verified column
 * @method     ChildOutletsQuery groupByOutletCreatedBy() Group by the outlet_created_by column
 * @method     ChildOutletsQuery groupByOutletApprovedBy() Group by the outlet_approved_by column
 * @method     ChildOutletsQuery groupByOutletPotential() Group by the outlet_potential column
 * @method     ChildOutletsQuery groupByIntegrationId() Group by the integration_id column
 * @method     ChildOutletsQuery groupByItownid() Group by the itownid column
 * @method     ChildOutletsQuery groupByOutletQualification() Group by the outlet_qualification column
 * @method     ChildOutletsQuery groupByOutletRegno() Group by the outlet_regno column
 * @method     ChildOutletsQuery groupByOutletMaritalStatus() Group by the outlet_marital_status column
 * @method     ChildOutletsQuery groupByOutletMedia() Group by the outlet_media column
 *
 * @method     ChildOutletsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletsQuery leftJoinClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Classification relation
 * @method     ChildOutletsQuery rightJoinClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Classification relation
 * @method     ChildOutletsQuery innerJoinClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the Classification relation
 *
 * @method     ChildOutletsQuery joinWithClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Classification relation
 *
 * @method     ChildOutletsQuery leftJoinWithClassification() Adds a LEFT JOIN clause and with to the query using the Classification relation
 * @method     ChildOutletsQuery rightJoinWithClassification() Adds a RIGHT JOIN clause and with to the query using the Classification relation
 * @method     ChildOutletsQuery innerJoinWithClassification() Adds a INNER JOIN clause and with to the query using the Classification relation
 *
 * @method     ChildOutletsQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildOutletsQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildOutletsQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildOutletsQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildOutletsQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildOutletsQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildOutletsQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildOutletsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletsQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOutletsQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOutletsQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOutletsQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutletsQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOutletsQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildOutletsQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletsQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletsQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildOutletsQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletsQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletsQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletsQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletsQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletsQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletsQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletsQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletsQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletsQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletsQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletsQuery leftJoinBrandCampiagnVisits($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildOutletsQuery rightJoinBrandCampiagnVisits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildOutletsQuery innerJoinBrandCampiagnVisits($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildOutletsQuery joinWithBrandCampiagnVisits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildOutletsQuery leftJoinWithBrandCampiagnVisits() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildOutletsQuery rightJoinWithBrandCampiagnVisits() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildOutletsQuery innerJoinWithBrandCampiagnVisits() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildOutletsQuery leftJoinBrandRcpa($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildOutletsQuery rightJoinBrandRcpa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildOutletsQuery innerJoinBrandRcpa($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandRcpa relation
 *
 * @method     ChildOutletsQuery joinWithBrandRcpa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildOutletsQuery leftJoinWithBrandRcpa() Adds a LEFT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildOutletsQuery rightJoinWithBrandRcpa() Adds a RIGHT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildOutletsQuery innerJoinWithBrandRcpa() Adds a INNER JOIN clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildOutletsQuery leftJoinCompetitionMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildOutletsQuery rightJoinCompetitionMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildOutletsQuery innerJoinCompetitionMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the CompetitionMapping relation
 *
 * @method     ChildOutletsQuery joinWithCompetitionMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildOutletsQuery leftJoinWithCompetitionMapping() Adds a LEFT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildOutletsQuery rightJoinWithCompetitionMapping() Adds a RIGHT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildOutletsQuery innerJoinWithCompetitionMapping() Adds a INNER JOIN clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildOutletsQuery leftJoinDailycallsSgpiout($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildOutletsQuery rightJoinDailycallsSgpiout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildOutletsQuery innerJoinDailycallsSgpiout($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletsQuery joinWithDailycallsSgpiout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletsQuery leftJoinWithDailycallsSgpiout() Adds a LEFT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildOutletsQuery rightJoinWithDailycallsSgpiout() Adds a RIGHT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildOutletsQuery innerJoinWithDailycallsSgpiout() Adds a INNER JOIN clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletsQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOutletsQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOutletsQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletsQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletsQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOutletsQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOutletsQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOutletsQuery leftJoinOrdersRelatedByOutletFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrdersRelatedByOutletFrom relation
 * @method     ChildOutletsQuery rightJoinOrdersRelatedByOutletFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrdersRelatedByOutletFrom relation
 * @method     ChildOutletsQuery innerJoinOrdersRelatedByOutletFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the OrdersRelatedByOutletFrom relation
 *
 * @method     ChildOutletsQuery joinWithOrdersRelatedByOutletFrom($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrdersRelatedByOutletFrom relation
 *
 * @method     ChildOutletsQuery leftJoinWithOrdersRelatedByOutletFrom() Adds a LEFT JOIN clause and with to the query using the OrdersRelatedByOutletFrom relation
 * @method     ChildOutletsQuery rightJoinWithOrdersRelatedByOutletFrom() Adds a RIGHT JOIN clause and with to the query using the OrdersRelatedByOutletFrom relation
 * @method     ChildOutletsQuery innerJoinWithOrdersRelatedByOutletFrom() Adds a INNER JOIN clause and with to the query using the OrdersRelatedByOutletFrom relation
 *
 * @method     ChildOutletsQuery leftJoinOrdersRelatedByOutletTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrdersRelatedByOutletTo relation
 * @method     ChildOutletsQuery rightJoinOrdersRelatedByOutletTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrdersRelatedByOutletTo relation
 * @method     ChildOutletsQuery innerJoinOrdersRelatedByOutletTo($relationAlias = null) Adds a INNER JOIN clause to the query using the OrdersRelatedByOutletTo relation
 *
 * @method     ChildOutletsQuery joinWithOrdersRelatedByOutletTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrdersRelatedByOutletTo relation
 *
 * @method     ChildOutletsQuery leftJoinWithOrdersRelatedByOutletTo() Adds a LEFT JOIN clause and with to the query using the OrdersRelatedByOutletTo relation
 * @method     ChildOutletsQuery rightJoinWithOrdersRelatedByOutletTo() Adds a RIGHT JOIN clause and with to the query using the OrdersRelatedByOutletTo relation
 * @method     ChildOutletsQuery innerJoinWithOrdersRelatedByOutletTo() Adds a INNER JOIN clause and with to the query using the OrdersRelatedByOutletTo relation
 *
 * @method     ChildOutletsQuery leftJoinOutletAccountDetails($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAccountDetails relation
 * @method     ChildOutletsQuery rightJoinOutletAccountDetails($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAccountDetails relation
 * @method     ChildOutletsQuery innerJoinOutletAccountDetails($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAccountDetails relation
 *
 * @method     ChildOutletsQuery joinWithOutletAccountDetails($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAccountDetails relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletAccountDetails() Adds a LEFT JOIN clause and with to the query using the OutletAccountDetails relation
 * @method     ChildOutletsQuery rightJoinWithOutletAccountDetails() Adds a RIGHT JOIN clause and with to the query using the OutletAccountDetails relation
 * @method     ChildOutletsQuery innerJoinWithOutletAccountDetails() Adds a INNER JOIN clause and with to the query using the OutletAccountDetails relation
 *
 * @method     ChildOutletsQuery leftJoinOutletAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOutletsQuery rightJoinOutletAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOutletsQuery innerJoinOutletAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAddress relation
 *
 * @method     ChildOutletsQuery joinWithOutletAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletAddress() Adds a LEFT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOutletsQuery rightJoinWithOutletAddress() Adds a RIGHT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOutletsQuery innerJoinWithOutletAddress() Adds a INNER JOIN clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOutletsQuery leftJoinOutletMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletMapping relation
 * @method     ChildOutletsQuery rightJoinOutletMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletMapping relation
 * @method     ChildOutletsQuery innerJoinOutletMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletMapping relation
 *
 * @method     ChildOutletsQuery joinWithOutletMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletMapping relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletMapping() Adds a LEFT JOIN clause and with to the query using the OutletMapping relation
 * @method     ChildOutletsQuery rightJoinWithOutletMapping() Adds a RIGHT JOIN clause and with to the query using the OutletMapping relation
 * @method     ChildOutletsQuery innerJoinWithOutletMapping() Adds a INNER JOIN clause and with to the query using the OutletMapping relation
 *
 * @method     ChildOutletsQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletsQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOutletsQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildOutletsQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletsQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOutletsQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOutletsQuery leftJoinOutletStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStock relation
 * @method     ChildOutletsQuery rightJoinOutletStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStock relation
 * @method     ChildOutletsQuery innerJoinOutletStock($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStock relation
 *
 * @method     ChildOutletsQuery joinWithOutletStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStock relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletStock() Adds a LEFT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildOutletsQuery rightJoinWithOutletStock() Adds a RIGHT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildOutletsQuery innerJoinWithOutletStock() Adds a INNER JOIN clause and with to the query using the OutletStock relation
 *
 * @method     ChildOutletsQuery leftJoinOutletStockOtherSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletsQuery rightJoinOutletStockOtherSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletsQuery innerJoinOutletStockOtherSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletsQuery joinWithOutletStockOtherSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletStockOtherSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletsQuery rightJoinWithOutletStockOtherSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletsQuery innerJoinWithOutletStockOtherSummary() Adds a INNER JOIN clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletsQuery leftJoinOutletStockSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildOutletsQuery rightJoinOutletStockSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildOutletsQuery innerJoinOutletStockSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletsQuery joinWithOutletStockSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletsQuery leftJoinWithOutletStockSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildOutletsQuery rightJoinWithOutletStockSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildOutletsQuery innerJoinWithOutletStockSummary() Adds a INNER JOIN clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletsQuery leftJoinStockTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockTransaction relation
 * @method     ChildOutletsQuery rightJoinStockTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockTransaction relation
 * @method     ChildOutletsQuery innerJoinStockTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the StockTransaction relation
 *
 * @method     ChildOutletsQuery joinWithStockTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockTransaction relation
 *
 * @method     ChildOutletsQuery leftJoinWithStockTransaction() Adds a LEFT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildOutletsQuery rightJoinWithStockTransaction() Adds a RIGHT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildOutletsQuery innerJoinWithStockTransaction() Adds a INNER JOIN clause and with to the query using the StockTransaction relation
 *
 * @method     ChildOutletsQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildOutletsQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildOutletsQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildOutletsQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildOutletsQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildOutletsQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildOutletsQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildOutletsQuery leftJoinTickets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tickets relation
 * @method     ChildOutletsQuery rightJoinTickets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tickets relation
 * @method     ChildOutletsQuery innerJoinTickets($relationAlias = null) Adds a INNER JOIN clause to the query using the Tickets relation
 *
 * @method     ChildOutletsQuery joinWithTickets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tickets relation
 *
 * @method     ChildOutletsQuery leftJoinWithTickets() Adds a LEFT JOIN clause and with to the query using the Tickets relation
 * @method     ChildOutletsQuery rightJoinWithTickets() Adds a RIGHT JOIN clause and with to the query using the Tickets relation
 * @method     ChildOutletsQuery innerJoinWithTickets() Adds a INNER JOIN clause and with to the query using the Tickets relation
 *
 * @method     \entities\ClassificationQuery|\entities\EmployeeQuery|\entities\CompanyQuery|\entities\OutletTypeQuery|\entities\GeoTownsQuery|\entities\BrandCampiagnDoctorsQuery|\entities\BrandCampiagnVisitsQuery|\entities\BrandRcpaQuery|\entities\CompetitionMappingQuery|\entities\DailycallsSgpioutQuery|\entities\OnBoardRequestQuery|\entities\OrdersQuery|\entities\OrdersQuery|\entities\OutletAccountDetailsQuery|\entities\OutletAddressQuery|\entities\OutletMappingQuery|\entities\OutletOrgDataQuery|\entities\OutletStockQuery|\entities\OutletStockOtherSummaryQuery|\entities\OutletStockSummaryQuery|\entities\StockTransactionQuery|\entities\SurveySubmitedQuery|\entities\TicketsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutlets|null findOne(?ConnectionInterface $con = null) Return the first ChildOutlets matching the query
 * @method     ChildOutlets findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutlets matching the query, or a new ChildOutlets object populated from the query conditions when no match is found
 *
 * @method     ChildOutlets|null findOneById(int $id) Return the first ChildOutlets filtered by the id column
 * @method     ChildOutlets|null findOneByOutletMediaId(string $outlet_media_id) Return the first ChildOutlets filtered by the outlet_media_id column
 * @method     ChildOutlets|null findOneByOutletName(string $outlet_name) Return the first ChildOutlets filtered by the outlet_name column
 * @method     ChildOutlets|null findOneByOutletCode(string $outlet_code) Return the first ChildOutlets filtered by the outlet_code column
 * @method     ChildOutlets|null findOneByOutletEmail(string $outlet_email) Return the first ChildOutlets filtered by the outlet_email column
 * @method     ChildOutlets|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutlets filtered by the outlet_salutation column
 * @method     ChildOutlets|null findOneByOutletClassification(int $outlet_classification) Return the first ChildOutlets filtered by the outlet_classification column
 * @method     ChildOutlets|null findOneByOutletOpeningDate(string $outlet_opening_date) Return the first ChildOutlets filtered by the outlet_opening_date column
 * @method     ChildOutlets|null findOneByOutletContactName(string $outlet_contact_name) Return the first ChildOutlets filtered by the outlet_contact_name column
 * @method     ChildOutlets|null findOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildOutlets filtered by the outlet_landlineno column
 * @method     ChildOutlets|null findOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildOutlets filtered by the outlet_alt_landlineno column
 * @method     ChildOutlets|null findOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildOutlets filtered by the outlet_contact_bday column
 * @method     ChildOutlets|null findOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildOutlets filtered by the outlet_contact_anniversary column
 * @method     ChildOutlets|null findOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildOutlets filtered by the outlet_isd_code column
 * @method     ChildOutlets|null findOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutlets filtered by the outlet_contact_no column
 * @method     ChildOutlets|null findOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildOutlets filtered by the outlet_alt_contact_no column
 * @method     ChildOutlets|null findOneByOutletStatus(string $outlet_status) Return the first ChildOutlets filtered by the outlet_status column
 * @method     ChildOutlets|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildOutlets filtered by the outlettype_id column
 * @method     ChildOutlets|null findOneByCompanyId(int $company_id) Return the first ChildOutlets filtered by the company_id column
 * @method     ChildOutlets|null findOneByCreatedAt(string $created_at) Return the first ChildOutlets filtered by the created_at column
 * @method     ChildOutlets|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutlets filtered by the updated_at column
 * @method     ChildOutlets|null findOneByOutletOtp(string $outlet_otp) Return the first ChildOutlets filtered by the outlet_otp column
 * @method     ChildOutlets|null findOneByOutletVerified(int $outlet_verified) Return the first ChildOutlets filtered by the outlet_verified column
 * @method     ChildOutlets|null findOneByOutletCreatedBy(int $outlet_created_by) Return the first ChildOutlets filtered by the outlet_created_by column
 * @method     ChildOutlets|null findOneByOutletApprovedBy(int $outlet_approved_by) Return the first ChildOutlets filtered by the outlet_approved_by column
 * @method     ChildOutlets|null findOneByOutletPotential(string $outlet_potential) Return the first ChildOutlets filtered by the outlet_potential column
 * @method     ChildOutlets|null findOneByIntegrationId(string $integration_id) Return the first ChildOutlets filtered by the integration_id column
 * @method     ChildOutlets|null findOneByItownid(string $itownid) Return the first ChildOutlets filtered by the itownid column
 * @method     ChildOutlets|null findOneByOutletQualification(string $outlet_qualification) Return the first ChildOutlets filtered by the outlet_qualification column
 * @method     ChildOutlets|null findOneByOutletRegno(string $outlet_regno) Return the first ChildOutlets filtered by the outlet_regno column
 * @method     ChildOutlets|null findOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildOutlets filtered by the outlet_marital_status column
 * @method     ChildOutlets|null findOneByOutletMedia(string $outlet_media) Return the first ChildOutlets filtered by the outlet_media column
 *
 * @method     ChildOutlets requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutlets by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOne(?ConnectionInterface $con = null) Return the first ChildOutlets matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutlets requireOneById(int $id) Return the first ChildOutlets filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletMediaId(string $outlet_media_id) Return the first ChildOutlets filtered by the outlet_media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletName(string $outlet_name) Return the first ChildOutlets filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletCode(string $outlet_code) Return the first ChildOutlets filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletEmail(string $outlet_email) Return the first ChildOutlets filtered by the outlet_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutlets filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletClassification(int $outlet_classification) Return the first ChildOutlets filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletOpeningDate(string $outlet_opening_date) Return the first ChildOutlets filtered by the outlet_opening_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletContactName(string $outlet_contact_name) Return the first ChildOutlets filtered by the outlet_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildOutlets filtered by the outlet_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildOutlets filtered by the outlet_alt_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildOutlets filtered by the outlet_contact_bday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildOutlets filtered by the outlet_contact_anniversary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildOutlets filtered by the outlet_isd_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutlets filtered by the outlet_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildOutlets filtered by the outlet_alt_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletStatus(string $outlet_status) Return the first ChildOutlets filtered by the outlet_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutlettypeId(int $outlettype_id) Return the first ChildOutlets filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByCompanyId(int $company_id) Return the first ChildOutlets filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByCreatedAt(string $created_at) Return the first ChildOutlets filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByUpdatedAt(string $updated_at) Return the first ChildOutlets filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletOtp(string $outlet_otp) Return the first ChildOutlets filtered by the outlet_otp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletVerified(int $outlet_verified) Return the first ChildOutlets filtered by the outlet_verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletCreatedBy(int $outlet_created_by) Return the first ChildOutlets filtered by the outlet_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletApprovedBy(int $outlet_approved_by) Return the first ChildOutlets filtered by the outlet_approved_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletPotential(string $outlet_potential) Return the first ChildOutlets filtered by the outlet_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByIntegrationId(string $integration_id) Return the first ChildOutlets filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByItownid(string $itownid) Return the first ChildOutlets filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletQualification(string $outlet_qualification) Return the first ChildOutlets filtered by the outlet_qualification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletRegno(string $outlet_regno) Return the first ChildOutlets filtered by the outlet_regno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildOutlets filtered by the outlet_marital_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutlets requireOneByOutletMedia(string $outlet_media) Return the first ChildOutlets filtered by the outlet_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutlets[]|Collection find(?ConnectionInterface $con = null) Return ChildOutlets objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutlets> find(?ConnectionInterface $con = null) Return ChildOutlets objects based on current ModelCriteria
 *
 * @method     ChildOutlets[]|Collection findById(int|array<int> $id) Return ChildOutlets objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildOutlets> findById(int|array<int> $id) Return ChildOutlets objects filtered by the id column
 * @method     ChildOutlets[]|Collection findByOutletMediaId(string|array<string> $outlet_media_id) Return ChildOutlets objects filtered by the outlet_media_id column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletMediaId(string|array<string> $outlet_media_id) Return ChildOutlets objects filtered by the outlet_media_id column
 * @method     ChildOutlets[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildOutlets objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletName(string|array<string> $outlet_name) Return ChildOutlets objects filtered by the outlet_name column
 * @method     ChildOutlets[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildOutlets objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletCode(string|array<string> $outlet_code) Return ChildOutlets objects filtered by the outlet_code column
 * @method     ChildOutlets[]|Collection findByOutletEmail(string|array<string> $outlet_email) Return ChildOutlets objects filtered by the outlet_email column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletEmail(string|array<string> $outlet_email) Return ChildOutlets objects filtered by the outlet_email column
 * @method     ChildOutlets[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutlets objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutlets objects filtered by the outlet_salutation column
 * @method     ChildOutlets[]|Collection findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutlets objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutlets objects filtered by the outlet_classification column
 * @method     ChildOutlets[]|Collection findByOutletOpeningDate(string|array<string> $outlet_opening_date) Return ChildOutlets objects filtered by the outlet_opening_date column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletOpeningDate(string|array<string> $outlet_opening_date) Return ChildOutlets objects filtered by the outlet_opening_date column
 * @method     ChildOutlets[]|Collection findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildOutlets objects filtered by the outlet_contact_name column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildOutlets objects filtered by the outlet_contact_name column
 * @method     ChildOutlets[]|Collection findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildOutlets objects filtered by the outlet_landlineno column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildOutlets objects filtered by the outlet_landlineno column
 * @method     ChildOutlets[]|Collection findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildOutlets objects filtered by the outlet_alt_landlineno column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildOutlets objects filtered by the outlet_alt_landlineno column
 * @method     ChildOutlets[]|Collection findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildOutlets objects filtered by the outlet_contact_bday column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildOutlets objects filtered by the outlet_contact_bday column
 * @method     ChildOutlets[]|Collection findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildOutlets objects filtered by the outlet_contact_anniversary column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildOutlets objects filtered by the outlet_contact_anniversary column
 * @method     ChildOutlets[]|Collection findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildOutlets objects filtered by the outlet_isd_code column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildOutlets objects filtered by the outlet_isd_code column
 * @method     ChildOutlets[]|Collection findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutlets objects filtered by the outlet_contact_no column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutlets objects filtered by the outlet_contact_no column
 * @method     ChildOutlets[]|Collection findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildOutlets objects filtered by the outlet_alt_contact_no column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildOutlets objects filtered by the outlet_alt_contact_no column
 * @method     ChildOutlets[]|Collection findByOutletStatus(string|array<string> $outlet_status) Return ChildOutlets objects filtered by the outlet_status column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletStatus(string|array<string> $outlet_status) Return ChildOutlets objects filtered by the outlet_status column
 * @method     ChildOutlets[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutlets objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutlets objects filtered by the outlettype_id column
 * @method     ChildOutlets[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutlets objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByCompanyId(int|array<int> $company_id) Return ChildOutlets objects filtered by the company_id column
 * @method     ChildOutlets[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutlets objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByCreatedAt(string|array<string> $created_at) Return ChildOutlets objects filtered by the created_at column
 * @method     ChildOutlets[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutlets objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutlets objects filtered by the updated_at column
 * @method     ChildOutlets[]|Collection findByOutletOtp(string|array<string> $outlet_otp) Return ChildOutlets objects filtered by the outlet_otp column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletOtp(string|array<string> $outlet_otp) Return ChildOutlets objects filtered by the outlet_otp column
 * @method     ChildOutlets[]|Collection findByOutletVerified(int|array<int> $outlet_verified) Return ChildOutlets objects filtered by the outlet_verified column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletVerified(int|array<int> $outlet_verified) Return ChildOutlets objects filtered by the outlet_verified column
 * @method     ChildOutlets[]|Collection findByOutletCreatedBy(int|array<int> $outlet_created_by) Return ChildOutlets objects filtered by the outlet_created_by column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletCreatedBy(int|array<int> $outlet_created_by) Return ChildOutlets objects filtered by the outlet_created_by column
 * @method     ChildOutlets[]|Collection findByOutletApprovedBy(int|array<int> $outlet_approved_by) Return ChildOutlets objects filtered by the outlet_approved_by column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletApprovedBy(int|array<int> $outlet_approved_by) Return ChildOutlets objects filtered by the outlet_approved_by column
 * @method     ChildOutlets[]|Collection findByOutletPotential(string|array<string> $outlet_potential) Return ChildOutlets objects filtered by the outlet_potential column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletPotential(string|array<string> $outlet_potential) Return ChildOutlets objects filtered by the outlet_potential column
 * @method     ChildOutlets[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildOutlets objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByIntegrationId(string|array<string> $integration_id) Return ChildOutlets objects filtered by the integration_id column
 * @method     ChildOutlets[]|Collection findByItownid(string|array<string> $itownid) Return ChildOutlets objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByItownid(string|array<string> $itownid) Return ChildOutlets objects filtered by the itownid column
 * @method     ChildOutlets[]|Collection findByOutletQualification(string|array<string> $outlet_qualification) Return ChildOutlets objects filtered by the outlet_qualification column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletQualification(string|array<string> $outlet_qualification) Return ChildOutlets objects filtered by the outlet_qualification column
 * @method     ChildOutlets[]|Collection findByOutletRegno(string|array<string> $outlet_regno) Return ChildOutlets objects filtered by the outlet_regno column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletRegno(string|array<string> $outlet_regno) Return ChildOutlets objects filtered by the outlet_regno column
 * @method     ChildOutlets[]|Collection findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildOutlets objects filtered by the outlet_marital_status column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildOutlets objects filtered by the outlet_marital_status column
 * @method     ChildOutlets[]|Collection findByOutletMedia(string|array<string> $outlet_media) Return ChildOutlets objects filtered by the outlet_media column
 * @psalm-method Collection&\Traversable<ChildOutlets> findByOutletMedia(string|array<string> $outlet_media) Return ChildOutlets objects filtered by the outlet_media column
 *
 * @method     ChildOutlets[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutlets> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Outlets', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletsQuery) {
            return $criteria;
        }
        $query = new ChildOutletsQuery();
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
     * @return ChildOutlets|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutlets A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, outlet_media_id, outlet_name, outlet_code, outlet_email, outlet_salutation, outlet_classification, outlet_opening_date, outlet_contact_name, outlet_landlineno, outlet_alt_landlineno, outlet_contact_bday, outlet_contact_anniversary, outlet_isd_code, outlet_contact_no, outlet_alt_contact_no, outlet_status, outlettype_id, company_id, created_at, updated_at, outlet_otp, outlet_verified, outlet_created_by, outlet_approved_by, outlet_potential, integration_id, itownid, outlet_qualification, outlet_regno, outlet_marital_status, outlet_media FROM outlets WHERE id = :p0';
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
            /** @var ChildOutlets $obj */
            $obj = new ChildOutlets();
            $obj->hydrate($row);
            OutletsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutlets|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OutletsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletMediaId('fooValue');   // WHERE outlet_media_id = 'fooValue'
     * $query->filterByOutletMediaId('%fooValue%', Criteria::LIKE); // WHERE outlet_media_id LIKE '%fooValue%'
     * $query->filterByOutletMediaId(['foo', 'bar']); // WHERE outlet_media_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletMediaId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletMediaId($outletMediaId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletMediaId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_MEDIA_ID, $outletMediaId, $comparison);

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

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_email column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletEmail('fooValue');   // WHERE outlet_email = 'fooValue'
     * $query->filterByOutletEmail('%fooValue%', Criteria::LIKE); // WHERE outlet_email LIKE '%fooValue%'
     * $query->filterByOutletEmail(['foo', 'bar']); // WHERE outlet_email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletEmail The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletEmail($outletEmail = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletEmail)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_EMAIL, $outletEmail, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_salutation column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletSalutation('fooValue');   // WHERE outlet_salutation = 'fooValue'
     * $query->filterByOutletSalutation('%fooValue%', Criteria::LIKE); // WHERE outlet_salutation LIKE '%fooValue%'
     * $query->filterByOutletSalutation(['foo', 'bar']); // WHERE outlet_salutation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletSalutation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletSalutation($outletSalutation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletSalutation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletClassification(1234); // WHERE outlet_classification = 1234
     * $query->filterByOutletClassification(array(12, 34)); // WHERE outlet_classification IN (12, 34)
     * $query->filterByOutletClassification(array('min' => 12)); // WHERE outlet_classification > 12
     * </code>
     *
     * @see       filterByClassification()
     *
     * @param mixed $outletClassification The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletClassification($outletClassification = null, ?string $comparison = null)
    {
        if (is_array($outletClassification)) {
            $useMinMax = false;
            if (isset($outletClassification['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletClassification['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_opening_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOpeningDate('2011-03-14'); // WHERE outlet_opening_date = '2011-03-14'
     * $query->filterByOutletOpeningDate('now'); // WHERE outlet_opening_date = '2011-03-14'
     * $query->filterByOutletOpeningDate(array('max' => 'yesterday')); // WHERE outlet_opening_date > '2011-03-13'
     * </code>
     *
     * @param mixed $outletOpeningDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOpeningDate($outletOpeningDate = null, ?string $comparison = null)
    {
        if (is_array($outletOpeningDate)) {
            $useMinMax = false;
            if (isset($outletOpeningDate['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOpeningDate['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_contact_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletContactName('fooValue');   // WHERE outlet_contact_name = 'fooValue'
     * $query->filterByOutletContactName('%fooValue%', Criteria::LIKE); // WHERE outlet_contact_name LIKE '%fooValue%'
     * $query->filterByOutletContactName(['foo', 'bar']); // WHERE outlet_contact_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletContactName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletContactName($outletContactName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletContactName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_NAME, $outletContactName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_landlineno column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletLandlineno('fooValue');   // WHERE outlet_landlineno = 'fooValue'
     * $query->filterByOutletLandlineno('%fooValue%', Criteria::LIKE); // WHERE outlet_landlineno LIKE '%fooValue%'
     * $query->filterByOutletLandlineno(['foo', 'bar']); // WHERE outlet_landlineno IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletLandlineno The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletLandlineno($outletLandlineno = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletLandlineno)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_LANDLINENO, $outletLandlineno, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_alt_landlineno column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAltLandlineno('fooValue');   // WHERE outlet_alt_landlineno = 'fooValue'
     * $query->filterByOutletAltLandlineno('%fooValue%', Criteria::LIKE); // WHERE outlet_alt_landlineno LIKE '%fooValue%'
     * $query->filterByOutletAltLandlineno(['foo', 'bar']); // WHERE outlet_alt_landlineno IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletAltLandlineno The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAltLandlineno($outletAltLandlineno = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletAltLandlineno)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_ALT_LANDLINENO, $outletAltLandlineno, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_contact_bday column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletContactBday('2011-03-14'); // WHERE outlet_contact_bday = '2011-03-14'
     * $query->filterByOutletContactBday('now'); // WHERE outlet_contact_bday = '2011-03-14'
     * $query->filterByOutletContactBday(array('max' => 'yesterday')); // WHERE outlet_contact_bday > '2011-03-13'
     * </code>
     *
     * @param mixed $outletContactBday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletContactBday($outletContactBday = null, ?string $comparison = null)
    {
        if (is_array($outletContactBday)) {
            $useMinMax = false;
            if (isset($outletContactBday['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactBday['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_contact_anniversary column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletContactAnniversary('2011-03-14'); // WHERE outlet_contact_anniversary = '2011-03-14'
     * $query->filterByOutletContactAnniversary('now'); // WHERE outlet_contact_anniversary = '2011-03-14'
     * $query->filterByOutletContactAnniversary(array('max' => 'yesterday')); // WHERE outlet_contact_anniversary > '2011-03-13'
     * </code>
     *
     * @param mixed $outletContactAnniversary The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletContactAnniversary($outletContactAnniversary = null, ?string $comparison = null)
    {
        if (is_array($outletContactAnniversary)) {
            $useMinMax = false;
            if (isset($outletContactAnniversary['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactAnniversary['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_isd_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletIsdCode('fooValue');   // WHERE outlet_isd_code = 'fooValue'
     * $query->filterByOutletIsdCode('%fooValue%', Criteria::LIKE); // WHERE outlet_isd_code LIKE '%fooValue%'
     * $query->filterByOutletIsdCode(['foo', 'bar']); // WHERE outlet_isd_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletIsdCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletIsdCode($outletIsdCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletIsdCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_ISD_CODE, $outletIsdCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_contact_no column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletContactNo('fooValue');   // WHERE outlet_contact_no = 'fooValue'
     * $query->filterByOutletContactNo('%fooValue%', Criteria::LIKE); // WHERE outlet_contact_no LIKE '%fooValue%'
     * $query->filterByOutletContactNo(['foo', 'bar']); // WHERE outlet_contact_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletContactNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletContactNo($outletContactNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletContactNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CONTACT_NO, $outletContactNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_alt_contact_no column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAltContactNo('fooValue');   // WHERE outlet_alt_contact_no = 'fooValue'
     * $query->filterByOutletAltContactNo('%fooValue%', Criteria::LIKE); // WHERE outlet_alt_contact_no LIKE '%fooValue%'
     * $query->filterByOutletAltContactNo(['foo', 'bar']); // WHERE outlet_alt_contact_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletAltContactNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAltContactNo($outletAltContactNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletAltContactNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_ALT_CONTACT_NO, $outletAltContactNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_status column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletStatus('fooValue');   // WHERE outlet_status = 'fooValue'
     * $query->filterByOutletStatus('%fooValue%', Criteria::LIKE); // WHERE outlet_status LIKE '%fooValue%'
     * $query->filterByOutletStatus(['foo', 'bar']); // WHERE outlet_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStatus($outletStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_STATUS, $outletStatus, $comparison);

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
     * @see       filterByOutletType()
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
                $this->addUsingAlias(OutletsTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

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
                $this->addUsingAlias(OutletsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_otp column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOtp(1234); // WHERE outlet_otp = 1234
     * $query->filterByOutletOtp(array(12, 34)); // WHERE outlet_otp IN (12, 34)
     * $query->filterByOutletOtp(array('min' => 12)); // WHERE outlet_otp > 12
     * </code>
     *
     * @param mixed $outletOtp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOtp($outletOtp = null, ?string $comparison = null)
    {
        if (is_array($outletOtp)) {
            $useMinMax = false;
            if (isset($outletOtp['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OTP, $outletOtp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOtp['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OTP, $outletOtp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_OTP, $outletOtp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_verified column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletVerified(1234); // WHERE outlet_verified = 1234
     * $query->filterByOutletVerified(array(12, 34)); // WHERE outlet_verified IN (12, 34)
     * $query->filterByOutletVerified(array('min' => 12)); // WHERE outlet_verified > 12
     * </code>
     *
     * @param mixed $outletVerified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletVerified($outletVerified = null, ?string $comparison = null)
    {
        if (is_array($outletVerified)) {
            $useMinMax = false;
            if (isset($outletVerified['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_VERIFIED, $outletVerified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletVerified['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_VERIFIED, $outletVerified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_VERIFIED, $outletVerified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCreatedBy(1234); // WHERE outlet_created_by = 1234
     * $query->filterByOutletCreatedBy(array(12, 34)); // WHERE outlet_created_by IN (12, 34)
     * $query->filterByOutletCreatedBy(array('min' => 12)); // WHERE outlet_created_by > 12
     * </code>
     *
     * @see       filterByEmployee()
     *
     * @param mixed $outletCreatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCreatedBy($outletCreatedBy = null, ?string $comparison = null)
    {
        if (is_array($outletCreatedBy)) {
            $useMinMax = false;
            if (isset($outletCreatedBy['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletCreatedBy['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_approved_by column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletApprovedBy(1234); // WHERE outlet_approved_by = 1234
     * $query->filterByOutletApprovedBy(array(12, 34)); // WHERE outlet_approved_by IN (12, 34)
     * $query->filterByOutletApprovedBy(array('min' => 12)); // WHERE outlet_approved_by > 12
     * </code>
     *
     * @param mixed $outletApprovedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletApprovedBy($outletApprovedBy = null, ?string $comparison = null)
    {
        if (is_array($outletApprovedBy)) {
            $useMinMax = false;
            if (isset($outletApprovedBy['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletApprovedBy['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_potential column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletPotential(1234); // WHERE outlet_potential = 1234
     * $query->filterByOutletPotential(array(12, 34)); // WHERE outlet_potential IN (12, 34)
     * $query->filterByOutletPotential(array('min' => 12)); // WHERE outlet_potential > 12
     * </code>
     *
     * @param mixed $outletPotential The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletPotential($outletPotential = null, ?string $comparison = null)
    {
        if (is_array($outletPotential)) {
            $useMinMax = false;
            if (isset($outletPotential['min'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_POTENTIAL, $outletPotential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletPotential['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_OUTLET_POTENTIAL, $outletPotential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_POTENTIAL, $outletPotential, $comparison);

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

        $this->addUsingAlias(OutletsTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
     * @see       filterByGeoTowns()
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
                $this->addUsingAlias(OutletsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(OutletsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_qualification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletQualification('fooValue');   // WHERE outlet_qualification = 'fooValue'
     * $query->filterByOutletQualification('%fooValue%', Criteria::LIKE); // WHERE outlet_qualification LIKE '%fooValue%'
     * $query->filterByOutletQualification(['foo', 'bar']); // WHERE outlet_qualification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletQualification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletQualification($outletQualification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletQualification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_QUALIFICATION, $outletQualification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_regno column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletRegno('fooValue');   // WHERE outlet_regno = 'fooValue'
     * $query->filterByOutletRegno('%fooValue%', Criteria::LIKE); // WHERE outlet_regno LIKE '%fooValue%'
     * $query->filterByOutletRegno(['foo', 'bar']); // WHERE outlet_regno IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletRegno The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletRegno($outletRegno = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletRegno)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_REGNO, $outletRegno, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_marital_status column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletMaritalStatus('fooValue');   // WHERE outlet_marital_status = 'fooValue'
     * $query->filterByOutletMaritalStatus('%fooValue%', Criteria::LIKE); // WHERE outlet_marital_status LIKE '%fooValue%'
     * $query->filterByOutletMaritalStatus(['foo', 'bar']); // WHERE outlet_marital_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletMaritalStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletMaritalStatus($outletMaritalStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletMaritalStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_MARITAL_STATUS, $outletMaritalStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_media column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletMedia('fooValue');   // WHERE outlet_media = 'fooValue'
     * $query->filterByOutletMedia('%fooValue%', Criteria::LIKE); // WHERE outlet_media LIKE '%fooValue%'
     * $query->filterByOutletMedia(['foo', 'bar']); // WHERE outlet_media IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletMedia The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletMedia($outletMedia = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletMedia)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletsTableMap::COL_OUTLET_MEDIA, $outletMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Classification object
     *
     * @param \entities\Classification|ObjectCollection $classification The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification, ?string $comparison = null)
    {
        if ($classification instanceof \entities\Classification) {
            return $this
                ->addUsingAlias(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $classification->getId(), $comparison);
        } elseif ($classification instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletsTableMap::COL_OUTLET_CLASSIFICATION, $classification->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByClassification() only accepts arguments of type \entities\Classification or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Classification relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinClassification(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Classification');

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
            $this->addJoinObject($join, 'Classification');
        }

        return $this;
    }

    /**
     * Use the Classification relation Classification object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ClassificationQuery A secondary query class using the current class as primary query
     */
    public function useClassificationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinClassification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Classification', '\entities\ClassificationQuery');
    }

    /**
     * Use the Classification relation Classification object
     *
     * @param callable(\entities\ClassificationQuery):\entities\ClassificationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withClassificationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useClassificationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Classification table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ClassificationQuery The inner query object of the EXISTS statement
     */
    public function useClassificationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useExistsQuery('Classification', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Classification table for a NOT EXISTS query.
     *
     * @see useClassificationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ClassificationQuery The inner query object of the NOT EXISTS statement
     */
    public function useClassificationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useExistsQuery('Classification', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Classification table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ClassificationQuery The inner query object of the IN statement
     */
    public function useInClassificationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useInQuery('Classification', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Classification table for a NOT IN query.
     *
     * @see useClassificationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ClassificationQuery The inner query object of the NOT IN statement
     */
    public function useNotInClassificationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ClassificationQuery */
        $q = $this->useInQuery('Classification', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletsTableMap::COL_OUTLET_CREATED_BY, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletsTableMap::COL_OUTLET_CREATED_BY, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(OutletsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(OutletsTableMap::COL_OUTLETTYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletsTableMap::COL_OUTLETTYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutletType() only accepts arguments of type \entities\OutletType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletType');

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
            $this->addJoinObject($join, 'OutletType');
        }

        return $this;
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTypeQuery A secondary query class using the current class as primary query
     */
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletType', '\entities\OutletTypeQuery');
    }

    /**
     * Use the OutletType relation OutletType object
     *
     * @param callable(\entities\OutletTypeQuery):\entities\OutletTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTypeQuery The inner query object of the EXISTS statement
     */
    public function useOutletTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT EXISTS query.
     *
     * @see useOutletTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useExistsQuery('OutletType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTypeQuery The inner query object of the IN statement
     */
    public function useInOutletTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletType table for a NOT IN query.
     *
     * @see useOutletTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTypeQuery */
        $q = $this->useInQuery('OutletType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoTowns object
     *
     * @param \entities\GeoTowns|ObjectCollection $geoTowns The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoTowns($geoTowns, ?string $comparison = null)
    {
        if ($geoTowns instanceof \entities\GeoTowns) {
            return $this
                ->addUsingAlias(OutletsTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletsTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoTowns() only accepts arguments of type \entities\GeoTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoTowns(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoTowns');

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
            $this->addJoinObject($join, 'GeoTowns');
        }

        return $this;
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoTownsQuery A secondary query class using the current class as primary query
     */
    public function useGeoTownsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoTowns', '\entities\GeoTownsQuery');
    }

    /**
     * Use the GeoTowns relation GeoTowns object
     *
     * @param callable(\entities\GeoTownsQuery):\entities\GeoTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoTownsQuery The inner query object of the EXISTS statement
     */
    public function useGeoTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT EXISTS query.
     *
     * @see useGeoTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useExistsQuery('GeoTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoTownsQuery The inner query object of the IN statement
     */
    public function useInGeoTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoTowns table for a NOT IN query.
     *
     * @see useGeoTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoTownsQuery */
        $q = $this->useInQuery('GeoTowns', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnDoctors object
     *
     * @param \entities\BrandCampiagnDoctors|ObjectCollection $brandCampiagnDoctors the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnDoctors($brandCampiagnDoctors, ?string $comparison = null)
    {
        if ($brandCampiagnDoctors instanceof \entities\BrandCampiagnDoctors) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $brandCampiagnDoctors->getOutletId(), $comparison);

            return $this;
        } elseif ($brandCampiagnDoctors instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnDoctorsQuery()
                ->filterByPrimaryKeys($brandCampiagnDoctors->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnDoctors() only accepts arguments of type \entities\BrandCampiagnDoctors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnDoctors relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnDoctors(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnDoctors');

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
            $this->addJoinObject($join, 'BrandCampiagnDoctors');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnDoctors relation BrandCampiagnDoctors object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnDoctorsQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnDoctorsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnDoctors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnDoctors', '\entities\BrandCampiagnDoctorsQuery');
    }

    /**
     * Use the BrandCampiagnDoctors relation BrandCampiagnDoctors object
     *
     * @param callable(\entities\BrandCampiagnDoctorsQuery):\entities\BrandCampiagnDoctorsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnDoctorsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnDoctorsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnDoctorsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useExistsQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnDoctorsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnDoctorsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useExistsQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnDoctorsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useInQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnDoctors table for a NOT IN query.
     *
     * @see useBrandCampiagnDoctorsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnDoctorsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnDoctorsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnDoctorsQuery */
        $q = $this->useInQuery('BrandCampiagnDoctors', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagnVisits object
     *
     * @param \entities\BrandCampiagnVisits|ObjectCollection $brandCampiagnVisits the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisits($brandCampiagnVisits, ?string $comparison = null)
    {
        if ($brandCampiagnVisits instanceof \entities\BrandCampiagnVisits) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $brandCampiagnVisits->getOutletId(), $comparison);

            return $this;
        } elseif ($brandCampiagnVisits instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnVisitsQuery()
                ->filterByPrimaryKeys($brandCampiagnVisits->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisits() only accepts arguments of type \entities\BrandCampiagnVisits or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisits relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisits(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisits');

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
            $this->addJoinObject($join, 'BrandCampiagnVisits');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisits relation BrandCampiagnVisits object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitsQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisits($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisits', '\entities\BrandCampiagnVisitsQuery');
    }

    /**
     * Use the BrandCampiagnVisits relation BrandCampiagnVisits object
     *
     * @param callable(\entities\BrandCampiagnVisitsQuery):\entities\BrandCampiagnVisitsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisits', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisits', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useInQuery('BrandCampiagnVisits', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisits table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitsQuery */
        $q = $this->useInQuery('BrandCampiagnVisits', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\BrandRcpa object
     *
     * @param \entities\BrandRcpa|ObjectCollection $brandRcpa the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandRcpa($brandRcpa, ?string $comparison = null)
    {
        if ($brandRcpa instanceof \entities\BrandRcpa) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $brandRcpa->getOutletId(), $comparison);

            return $this;
        } elseif ($brandRcpa instanceof ObjectCollection) {
            $this
                ->useBrandRcpaQuery()
                ->filterByPrimaryKeys($brandRcpa->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandRcpa() only accepts arguments of type \entities\BrandRcpa or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandRcpa relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandRcpa(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandRcpa');

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
            $this->addJoinObject($join, 'BrandRcpa');
        }

        return $this;
    }

    /**
     * Use the BrandRcpa relation BrandRcpa object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandRcpaQuery A secondary query class using the current class as primary query
     */
    public function useBrandRcpaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandRcpa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandRcpa', '\entities\BrandRcpaQuery');
    }

    /**
     * Use the BrandRcpa relation BrandRcpa object
     *
     * @param callable(\entities\BrandRcpaQuery):\entities\BrandRcpaQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandRcpaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandRcpaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandRcpa table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandRcpaQuery The inner query object of the EXISTS statement
     */
    public function useBrandRcpaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useExistsQuery('BrandRcpa', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for a NOT EXISTS query.
     *
     * @see useBrandRcpaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandRcpaQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandRcpaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useExistsQuery('BrandRcpa', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandRcpaQuery The inner query object of the IN statement
     */
    public function useInBrandRcpaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useInQuery('BrandRcpa', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandRcpa table for a NOT IN query.
     *
     * @see useBrandRcpaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandRcpaQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandRcpaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandRcpaQuery */
        $q = $this->useInQuery('BrandRcpa', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\CompetitionMapping object
     *
     * @param \entities\CompetitionMapping|ObjectCollection $competitionMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitionMapping($competitionMapping, ?string $comparison = null)
    {
        if ($competitionMapping instanceof \entities\CompetitionMapping) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $competitionMapping->getOutletId(), $comparison);

            return $this;
        } elseif ($competitionMapping instanceof ObjectCollection) {
            $this
                ->useCompetitionMappingQuery()
                ->filterByPrimaryKeys($competitionMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompetitionMapping() only accepts arguments of type \entities\CompetitionMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompetitionMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompetitionMapping(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompetitionMapping');

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
            $this->addJoinObject($join, 'CompetitionMapping');
        }

        return $this;
    }

    /**
     * Use the CompetitionMapping relation CompetitionMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompetitionMappingQuery A secondary query class using the current class as primary query
     */
    public function useCompetitionMappingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompetitionMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompetitionMapping', '\entities\CompetitionMappingQuery');
    }

    /**
     * Use the CompetitionMapping relation CompetitionMapping object
     *
     * @param callable(\entities\CompetitionMappingQuery):\entities\CompetitionMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompetitionMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompetitionMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CompetitionMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the EXISTS statement
     */
    public function useCompetitionMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useExistsQuery('CompetitionMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for a NOT EXISTS query.
     *
     * @see useCompetitionMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompetitionMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useExistsQuery('CompetitionMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the IN statement
     */
    public function useInCompetitionMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useInQuery('CompetitionMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CompetitionMapping table for a NOT IN query.
     *
     * @see useCompetitionMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitionMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompetitionMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitionMappingQuery */
        $q = $this->useInQuery('CompetitionMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\DailycallsSgpiout object
     *
     * @param \entities\DailycallsSgpiout|ObjectCollection $dailycallsSgpiout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycallsSgpiout($dailycallsSgpiout, ?string $comparison = null)
    {
        if ($dailycallsSgpiout instanceof \entities\DailycallsSgpiout) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $dailycallsSgpiout->getOutletId(), $comparison);

            return $this;
        } elseif ($dailycallsSgpiout instanceof ObjectCollection) {
            $this
                ->useDailycallsSgpioutQuery()
                ->filterByPrimaryKeys($dailycallsSgpiout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDailycallsSgpiout() only accepts arguments of type \entities\DailycallsSgpiout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DailycallsSgpiout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycallsSgpiout(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DailycallsSgpiout');

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
            $this->addJoinObject($join, 'DailycallsSgpiout');
        }

        return $this;
    }

    /**
     * Use the DailycallsSgpiout relation DailycallsSgpiout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsSgpioutQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsSgpioutQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycallsSgpiout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DailycallsSgpiout', '\entities\DailycallsSgpioutQuery');
    }

    /**
     * Use the DailycallsSgpiout relation DailycallsSgpiout object
     *
     * @param callable(\entities\DailycallsSgpioutQuery):\entities\DailycallsSgpioutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsSgpioutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsSgpioutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DailycallsSgpiout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsSgpioutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useExistsQuery('DailycallsSgpiout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for a NOT EXISTS query.
     *
     * @see useDailycallsSgpioutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsSgpioutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useExistsQuery('DailycallsSgpiout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the IN statement
     */
    public function useInDailycallsSgpioutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useInQuery('DailycallsSgpiout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DailycallsSgpiout table for a NOT IN query.
     *
     * @see useDailycallsSgpioutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsSgpioutQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsSgpioutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsSgpioutQuery */
        $q = $this->useInQuery('DailycallsSgpiout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $onBoardRequest->getOutletId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequest() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequest(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequest');

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
            $this->addJoinObject($join, 'OnBoardRequest');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequest', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequest relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrdersRelatedByOutletFrom($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $orders->getOutletFrom(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersRelatedByOutletFromQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrdersRelatedByOutletFrom() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrdersRelatedByOutletFrom relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrdersRelatedByOutletFrom(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrdersRelatedByOutletFrom');

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
            $this->addJoinObject($join, 'OrdersRelatedByOutletFrom');
        }

        return $this;
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersRelatedByOutletFromQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrdersRelatedByOutletFrom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrdersRelatedByOutletFrom', '\entities\OrdersQuery');
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersRelatedByOutletFromQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersRelatedByOutletFromQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation to the Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersRelatedByOutletFromExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('OrdersRelatedByOutletFrom', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation to the Orders table for a NOT EXISTS query.
     *
     * @see useOrdersRelatedByOutletFromExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersRelatedByOutletFromNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('OrdersRelatedByOutletFrom', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation to the Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersRelatedByOutletFromQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('OrdersRelatedByOutletFrom', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletFrom relation to the Orders table for a NOT IN query.
     *
     * @see useOrdersRelatedByOutletFromInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersRelatedByOutletFromQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('OrdersRelatedByOutletFrom', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrdersRelatedByOutletTo($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $orders->getOutletTo(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersRelatedByOutletToQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrdersRelatedByOutletTo() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrdersRelatedByOutletTo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrdersRelatedByOutletTo(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrdersRelatedByOutletTo');

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
            $this->addJoinObject($join, 'OrdersRelatedByOutletTo');
        }

        return $this;
    }

    /**
     * Use the OrdersRelatedByOutletTo relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersRelatedByOutletToQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrdersRelatedByOutletTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrdersRelatedByOutletTo', '\entities\OrdersQuery');
    }

    /**
     * Use the OrdersRelatedByOutletTo relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersRelatedByOutletToQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersRelatedByOutletToQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OrdersRelatedByOutletTo relation to the Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersRelatedByOutletToExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('OrdersRelatedByOutletTo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletTo relation to the Orders table for a NOT EXISTS query.
     *
     * @see useOrdersRelatedByOutletToExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersRelatedByOutletToNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('OrdersRelatedByOutletTo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletTo relation to the Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersRelatedByOutletToQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('OrdersRelatedByOutletTo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OrdersRelatedByOutletTo relation to the Orders table for a NOT IN query.
     *
     * @see useOrdersRelatedByOutletToInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersRelatedByOutletToQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('OrdersRelatedByOutletTo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletAccountDetails object
     *
     * @param \entities\OutletAccountDetails|ObjectCollection $outletAccountDetails the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAccountDetails($outletAccountDetails, ?string $comparison = null)
    {
        if ($outletAccountDetails instanceof \entities\OutletAccountDetails) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletAccountDetails->getOutletId(), $comparison);

            return $this;
        } elseif ($outletAccountDetails instanceof ObjectCollection) {
            $this
                ->useOutletAccountDetailsQuery()
                ->filterByPrimaryKeys($outletAccountDetails->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletAccountDetails() only accepts arguments of type \entities\OutletAccountDetails or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletAccountDetails relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletAccountDetails(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletAccountDetails');

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
            $this->addJoinObject($join, 'OutletAccountDetails');
        }

        return $this;
    }

    /**
     * Use the OutletAccountDetails relation OutletAccountDetails object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletAccountDetailsQuery A secondary query class using the current class as primary query
     */
    public function useOutletAccountDetailsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletAccountDetails($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletAccountDetails', '\entities\OutletAccountDetailsQuery');
    }

    /**
     * Use the OutletAccountDetails relation OutletAccountDetails object
     *
     * @param callable(\entities\OutletAccountDetailsQuery):\entities\OutletAccountDetailsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletAccountDetailsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletAccountDetailsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletAccountDetails table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletAccountDetailsQuery The inner query object of the EXISTS statement
     */
    public function useOutletAccountDetailsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletAccountDetailsQuery */
        $q = $this->useExistsQuery('OutletAccountDetails', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletAccountDetails table for a NOT EXISTS query.
     *
     * @see useOutletAccountDetailsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletAccountDetailsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletAccountDetailsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletAccountDetailsQuery */
        $q = $this->useExistsQuery('OutletAccountDetails', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletAccountDetails table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletAccountDetailsQuery The inner query object of the IN statement
     */
    public function useInOutletAccountDetailsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletAccountDetailsQuery */
        $q = $this->useInQuery('OutletAccountDetails', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletAccountDetails table for a NOT IN query.
     *
     * @see useOutletAccountDetailsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletAccountDetailsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletAccountDetailsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletAccountDetailsQuery */
        $q = $this->useInQuery('OutletAccountDetails', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletAddress object
     *
     * @param \entities\OutletAddress|ObjectCollection $outletAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAddress($outletAddress, ?string $comparison = null)
    {
        if ($outletAddress instanceof \entities\OutletAddress) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletAddress->getOutletId(), $comparison);

            return $this;
        } elseif ($outletAddress instanceof ObjectCollection) {
            $this
                ->useOutletAddressQuery()
                ->filterByPrimaryKeys($outletAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletAddress() only accepts arguments of type \entities\OutletAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletAddress');

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
            $this->addJoinObject($join, 'OutletAddress');
        }

        return $this;
    }

    /**
     * Use the OutletAddress relation OutletAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletAddressQuery A secondary query class using the current class as primary query
     */
    public function useOutletAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletAddress', '\entities\OutletAddressQuery');
    }

    /**
     * Use the OutletAddress relation OutletAddress object
     *
     * @param callable(\entities\OutletAddressQuery):\entities\OutletAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletAddressQuery The inner query object of the EXISTS statement
     */
    public function useOutletAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletAddressQuery */
        $q = $this->useExistsQuery('OutletAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletAddress table for a NOT EXISTS query.
     *
     * @see useOutletAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletAddressQuery */
        $q = $this->useExistsQuery('OutletAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletAddressQuery The inner query object of the IN statement
     */
    public function useInOutletAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletAddressQuery */
        $q = $this->useInQuery('OutletAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletAddress table for a NOT IN query.
     *
     * @see useOutletAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletAddressQuery */
        $q = $this->useInQuery('OutletAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletMapping object
     *
     * @param \entities\OutletMapping|ObjectCollection $outletMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletMapping($outletMapping, ?string $comparison = null)
    {
        if ($outletMapping instanceof \entities\OutletMapping) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletMapping->getPrimaryOutletId(), $comparison);

            return $this;
        } elseif ($outletMapping instanceof ObjectCollection) {
            $this
                ->useOutletMappingQuery()
                ->filterByPrimaryKeys($outletMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletMapping() only accepts arguments of type \entities\OutletMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletMapping(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletMapping');

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
            $this->addJoinObject($join, 'OutletMapping');
        }

        return $this;
    }

    /**
     * Use the OutletMapping relation OutletMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletMappingQuery A secondary query class using the current class as primary query
     */
    public function useOutletMappingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletMapping', '\entities\OutletMappingQuery');
    }

    /**
     * Use the OutletMapping relation OutletMapping object
     *
     * @param callable(\entities\OutletMappingQuery):\entities\OutletMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletMappingQuery The inner query object of the EXISTS statement
     */
    public function useOutletMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useExistsQuery('OutletMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for a NOT EXISTS query.
     *
     * @see useOutletMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useExistsQuery('OutletMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletMappingQuery The inner query object of the IN statement
     */
    public function useInOutletMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useInQuery('OutletMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletMapping table for a NOT IN query.
     *
     * @see useOutletMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletMappingQuery */
        $q = $this->useInQuery('OutletMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOrgData object
     *
     * @param \entities\OutletOrgData|ObjectCollection $outletOrgData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgData($outletOrgData, ?string $comparison = null)
    {
        if ($outletOrgData instanceof \entities\OutletOrgData) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletOrgData->getOutletId(), $comparison);

            return $this;
        } elseif ($outletOrgData instanceof ObjectCollection) {
            $this
                ->useOutletOrgDataQuery()
                ->filterByPrimaryKeys($outletOrgData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOrgData() only accepts arguments of type \entities\OutletOrgData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOrgData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOrgData');

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
            $this->addJoinObject($join, 'OutletOrgData');
        }

        return $this;
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOrgDataQuery A secondary query class using the current class as primary query
     */
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletOrgData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOrgData', '\entities\OutletOrgDataQuery');
    }

    /**
     * Use the OutletOrgData relation OutletOrgData object
     *
     * @param callable(\entities\OutletOrgDataQuery):\entities\OutletOrgDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOrgDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletOrgDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOrgData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the EXISTS statement
     */
    public function useOutletOrgDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT EXISTS query.
     *
     * @see useOutletOrgDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOrgDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useExistsQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the IN statement
     */
    public function useInOutletOrgDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOrgData table for a NOT IN query.
     *
     * @see useOutletOrgDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOrgDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataQuery */
        $q = $this->useInQuery('OutletOrgData', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletStock->getOutletId(), $comparison);

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
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletStockOtherSummary->getOutletId(), $comparison);

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
                ->addUsingAlias(OutletsTableMap::COL_ID, $outletStockSummary->getOutletId(), $comparison);

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
                ->addUsingAlias(OutletsTableMap::COL_ID, $stockTransaction->getOutletId(), $comparison);

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
     * Filter the query by a related \entities\SurveySubmited object
     *
     * @param \entities\SurveySubmited|ObjectCollection $surveySubmited the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveySubmited($surveySubmited, ?string $comparison = null)
    {
        if ($surveySubmited instanceof \entities\SurveySubmited) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $surveySubmited->getOutletId(), $comparison);

            return $this;
        } elseif ($surveySubmited instanceof ObjectCollection) {
            $this
                ->useSurveySubmitedQuery()
                ->filterByPrimaryKeys($surveySubmited->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveySubmited() only accepts arguments of type \entities\SurveySubmited or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveySubmited relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveySubmited(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveySubmited');

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
            $this->addJoinObject($join, 'SurveySubmited');
        }

        return $this;
    }

    /**
     * Use the SurveySubmited relation SurveySubmited object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveySubmitedQuery A secondary query class using the current class as primary query
     */
    public function useSurveySubmitedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveySubmited($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveySubmited', '\entities\SurveySubmitedQuery');
    }

    /**
     * Use the SurveySubmited relation SurveySubmited object
     *
     * @param callable(\entities\SurveySubmitedQuery):\entities\SurveySubmitedQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveySubmitedQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveySubmitedQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveySubmited table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the EXISTS statement
     */
    public function useSurveySubmitedExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useExistsQuery('SurveySubmited', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for a NOT EXISTS query.
     *
     * @see useSurveySubmitedExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveySubmitedNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useExistsQuery('SurveySubmited', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the IN statement
     */
    public function useInSurveySubmitedQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useInQuery('SurveySubmited', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveySubmited table for a NOT IN query.
     *
     * @see useSurveySubmitedInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveySubmitedQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveySubmitedQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveySubmitedQuery */
        $q = $this->useInQuery('SurveySubmited', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tickets object
     *
     * @param \entities\Tickets|ObjectCollection $tickets the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTickets($tickets, ?string $comparison = null)
    {
        if ($tickets instanceof \entities\Tickets) {
            $this
                ->addUsingAlias(OutletsTableMap::COL_ID, $tickets->getOutletId(), $comparison);

            return $this;
        } elseif ($tickets instanceof ObjectCollection) {
            $this
                ->useTicketsQuery()
                ->filterByPrimaryKeys($tickets->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTickets() only accepts arguments of type \entities\Tickets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tickets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTickets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tickets');

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
            $this->addJoinObject($join, 'Tickets');
        }

        return $this;
    }

    /**
     * Use the Tickets relation Tickets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketsQuery A secondary query class using the current class as primary query
     */
    public function useTicketsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTickets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tickets', '\entities\TicketsQuery');
    }

    /**
     * Use the Tickets relation Tickets object
     *
     * @param callable(\entities\TicketsQuery):\entities\TicketsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTicketsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tickets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketsQuery The inner query object of the EXISTS statement
     */
    public function useTicketsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('Tickets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tickets table for a NOT EXISTS query.
     *
     * @see useTicketsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('Tickets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tickets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketsQuery The inner query object of the IN statement
     */
    public function useInTicketsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('Tickets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tickets table for a NOT IN query.
     *
     * @see useTicketsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('Tickets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutlets $outlets Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outlets = null)
    {
        if ($outlets) {
            $this->addUsingAlias(OutletsTableMap::COL_ID, $outlets->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletsTableMap::clearInstancePool();
            OutletsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

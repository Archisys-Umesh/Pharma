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
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Map\OutletOrgDataTableMap;

/**
 * Base class that represents a query for the `outlet_org_data` table.
 *
 * @method     ChildOutletOrgDataQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletOrgDataQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOutletOrgDataQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOutletOrgDataQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildOutletOrgDataQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildOutletOrgDataQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildOutletOrgDataQuery orderByOrgPotential($order = Criteria::ASC) Order by the org_potential column
 * @method     ChildOutletOrgDataQuery orderByBrandFocus($order = Criteria::ASC) Order by the brand_focus column
 * @method     ChildOutletOrgDataQuery orderByCustomerFq($order = Criteria::ASC) Order by the customer_fq column
 * @method     ChildOutletOrgDataQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletOrgDataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletOrgDataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletOrgDataQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildOutletOrgDataQuery orderByDefaultAddress($order = Criteria::ASC) Order by the default_address column
 * @method     ChildOutletOrgDataQuery orderByLastVisitDate($order = Criteria::ASC) Order by the last_visit_date column
 * @method     ChildOutletOrgDataQuery orderByLastVisitEmployee($order = Criteria::ASC) Order by the last_visit_employee column
 * @method     ChildOutletOrgDataQuery orderByOutletOrgCode($order = Criteria::ASC) Order by the outlet_org_code column
 * @method     ChildOutletOrgDataQuery orderByInvestedAmount($order = Criteria::ASC) Order by the invested_amount column
 *
 * @method     ChildOutletOrgDataQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletOrgDataQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOutletOrgDataQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOutletOrgDataQuery groupByTags() Group by the tags column
 * @method     ChildOutletOrgDataQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildOutletOrgDataQuery groupByComments() Group by the comments column
 * @method     ChildOutletOrgDataQuery groupByOrgPotential() Group by the org_potential column
 * @method     ChildOutletOrgDataQuery groupByBrandFocus() Group by the brand_focus column
 * @method     ChildOutletOrgDataQuery groupByCustomerFq() Group by the customer_fq column
 * @method     ChildOutletOrgDataQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletOrgDataQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletOrgDataQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletOrgDataQuery groupByItownid() Group by the itownid column
 * @method     ChildOutletOrgDataQuery groupByDefaultAddress() Group by the default_address column
 * @method     ChildOutletOrgDataQuery groupByLastVisitDate() Group by the last_visit_date column
 * @method     ChildOutletOrgDataQuery groupByLastVisitEmployee() Group by the last_visit_employee column
 * @method     ChildOutletOrgDataQuery groupByOutletOrgCode() Group by the outlet_org_code column
 * @method     ChildOutletOrgDataQuery groupByInvestedAmount() Group by the invested_amount column
 *
 * @method     ChildOutletOrgDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletOrgDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletOrgDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletOrgDataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletOrgDataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletOrgDataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletOrgDataQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOutletOrgDataQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOutletOrgDataQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOutletOrgDataQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletOrgDataQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOutletOrgDataQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletOrgDataQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOutletOrgDataQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAddress relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletAddress() Adds a LEFT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletAddress() Adds a RIGHT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletAddress() Adds a INNER JOIN clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletOrgDataQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOutletOrgDataQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletOrgDataQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOutletOrgDataQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildOutletOrgDataQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletOrgDataQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOutletOrgDataQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinBeatOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildOutletOrgDataQuery rightJoinBeatOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildOutletOrgDataQuery innerJoinBeatOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the BeatOutlets relation
 *
 * @method     ChildOutletOrgDataQuery joinWithBeatOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithBeatOutlets() Adds a LEFT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildOutletOrgDataQuery rightJoinWithBeatOutlets() Adds a RIGHT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildOutletOrgDataQuery innerJoinWithBeatOutlets() Adds a INNER JOIN clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletOrgDataQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletOrgDataQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletOrgDataQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletOrgDataQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildOutletOrgDataQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildOutletOrgDataQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildOutletOrgDataQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildOutletOrgDataQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildOutletOrgDataQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildOutletOrgDataQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinDailycallsAttendees($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildOutletOrgDataQuery rightJoinDailycallsAttendees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildOutletOrgDataQuery innerJoinDailycallsAttendees($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsAttendees relation
 *
 * @method     ChildOutletOrgDataQuery joinWithDailycallsAttendees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithDailycallsAttendees() Adds a LEFT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildOutletOrgDataQuery rightJoinWithDailycallsAttendees() Adds a RIGHT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildOutletOrgDataQuery innerJoinWithDailycallsAttendees() Adds a INNER JOIN clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinDailycallsSgpiout($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildOutletOrgDataQuery rightJoinDailycallsSgpiout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildOutletOrgDataQuery innerJoinDailycallsSgpiout($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletOrgDataQuery joinWithDailycallsSgpiout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithDailycallsSgpiout() Adds a LEFT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildOutletOrgDataQuery rightJoinWithDailycallsSgpiout() Adds a RIGHT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildOutletOrgDataQuery innerJoinWithDailycallsSgpiout() Adds a INNER JOIN clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinDayplan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dayplan relation
 * @method     ChildOutletOrgDataQuery rightJoinDayplan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dayplan relation
 * @method     ChildOutletOrgDataQuery innerJoinDayplan($relationAlias = null) Adds a INNER JOIN clause to the query using the Dayplan relation
 *
 * @method     ChildOutletOrgDataQuery joinWithDayplan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dayplan relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithDayplan() Adds a LEFT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildOutletOrgDataQuery rightJoinWithDayplan() Adds a RIGHT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildOutletOrgDataQuery innerJoinWithDayplan() Adds a INNER JOIN clause and with to the query using the Dayplan relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinEdFeedbacks($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildOutletOrgDataQuery rightJoinEdFeedbacks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildOutletOrgDataQuery innerJoinEdFeedbacks($relationAlias = null) Adds a INNER JOIN clause to the query using the EdFeedbacks relation
 *
 * @method     ChildOutletOrgDataQuery joinWithEdFeedbacks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdFeedbacks relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithEdFeedbacks() Adds a LEFT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildOutletOrgDataQuery rightJoinWithEdFeedbacks() Adds a RIGHT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildOutletOrgDataQuery innerJoinWithEdFeedbacks() Adds a INNER JOIN clause and with to the query using the EdFeedbacks relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinEdSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdSession relation
 * @method     ChildOutletOrgDataQuery rightJoinEdSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdSession relation
 * @method     ChildOutletOrgDataQuery innerJoinEdSession($relationAlias = null) Adds a INNER JOIN clause to the query using the EdSession relation
 *
 * @method     ChildOutletOrgDataQuery joinWithEdSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdSession relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithEdSession() Adds a LEFT JOIN clause and with to the query using the EdSession relation
 * @method     ChildOutletOrgDataQuery rightJoinWithEdSession() Adds a RIGHT JOIN clause and with to the query using the EdSession relation
 * @method     ChildOutletOrgDataQuery innerJoinWithEdSession() Adds a INNER JOIN clause and with to the query using the EdSession relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinEdStats($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdStats relation
 * @method     ChildOutletOrgDataQuery rightJoinEdStats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdStats relation
 * @method     ChildOutletOrgDataQuery innerJoinEdStats($relationAlias = null) Adds a INNER JOIN clause to the query using the EdStats relation
 *
 * @method     ChildOutletOrgDataQuery joinWithEdStats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdStats relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithEdStats() Adds a LEFT JOIN clause and with to the query using the EdStats relation
 * @method     ChildOutletOrgDataQuery rightJoinWithEdStats() Adds a RIGHT JOIN clause and with to the query using the EdStats relation
 * @method     ChildOutletOrgDataQuery innerJoinWithEdStats() Adds a INNER JOIN clause and with to the query using the EdStats relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletOrgDataQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletOrgDataQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletOrgNotes($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgNotes relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletOrgNotes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgNotes relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletOrgNotes($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgNotes relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletOrgNotes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgNotes relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletOrgNotes() Adds a LEFT JOIN clause and with to the query using the OutletOrgNotes relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletOrgNotes() Adds a RIGHT JOIN clause and with to the query using the OutletOrgNotes relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletOrgNotes() Adds a INNER JOIN clause and with to the query using the OutletOrgNotes relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStock relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStock relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletStock($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStock relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStock relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletStock() Adds a LEFT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletStock() Adds a RIGHT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletStock() Adds a INNER JOIN clause and with to the query using the OutletStock relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletStockOtherSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletStockOtherSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletStockOtherSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletStockOtherSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletStockOtherSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletStockOtherSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletStockOtherSummary() Adds a INNER JOIN clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletStockSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletStockSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletStockSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletStockSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletStockSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletStockSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletStockSummary() Adds a INNER JOIN clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinPrescriberData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberData relation
 * @method     ChildOutletOrgDataQuery rightJoinPrescriberData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberData relation
 * @method     ChildOutletOrgDataQuery innerJoinPrescriberData($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberData relation
 *
 * @method     ChildOutletOrgDataQuery joinWithPrescriberData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberData relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithPrescriberData() Adds a LEFT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildOutletOrgDataQuery rightJoinWithPrescriberData() Adds a RIGHT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildOutletOrgDataQuery innerJoinWithPrescriberData() Adds a INNER JOIN clause and with to the query using the PrescriberData relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinReminders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reminders relation
 * @method     ChildOutletOrgDataQuery rightJoinReminders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reminders relation
 * @method     ChildOutletOrgDataQuery innerJoinReminders($relationAlias = null) Adds a INNER JOIN clause to the query using the Reminders relation
 *
 * @method     ChildOutletOrgDataQuery joinWithReminders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reminders relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithReminders() Adds a LEFT JOIN clause and with to the query using the Reminders relation
 * @method     ChildOutletOrgDataQuery rightJoinWithReminders() Adds a RIGHT JOIN clause and with to the query using the Reminders relation
 * @method     ChildOutletOrgDataQuery innerJoinWithReminders() Adds a INNER JOIN clause and with to the query using the Reminders relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildOutletOrgDataQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildOutletOrgDataQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildOutletOrgDataQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildOutletOrgDataQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildOutletOrgDataQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinOutletOrgDataKeys($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgDataKeys relation
 * @method     ChildOutletOrgDataQuery rightJoinOutletOrgDataKeys($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgDataKeys relation
 * @method     ChildOutletOrgDataQuery innerJoinOutletOrgDataKeys($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgDataKeys relation
 *
 * @method     ChildOutletOrgDataQuery joinWithOutletOrgDataKeys($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgDataKeys relation
 *
 * @method     ChildOutletOrgDataQuery leftJoinWithOutletOrgDataKeys() Adds a LEFT JOIN clause and with to the query using the OutletOrgDataKeys relation
 * @method     ChildOutletOrgDataQuery rightJoinWithOutletOrgDataKeys() Adds a RIGHT JOIN clause and with to the query using the OutletOrgDataKeys relation
 * @method     ChildOutletOrgDataQuery innerJoinWithOutletOrgDataKeys() Adds a INNER JOIN clause and with to the query using the OutletOrgDataKeys relation
 *
 * @method     \entities\CompanyQuery|\entities\OutletsQuery|\entities\OutletAddressQuery|\entities\OrgUnitQuery|\entities\GeoTownsQuery|\entities\BeatOutletsQuery|\entities\BrandCampiagnDoctorsQuery|\entities\DailycallsQuery|\entities\DailycallsAttendeesQuery|\entities\DailycallsSgpioutQuery|\entities\DayplanQuery|\entities\EdFeedbacksQuery|\entities\EdSessionQuery|\entities\EdStatsQuery|\entities\OnBoardRequestAddressQuery|\entities\OutletOrgNotesQuery|\entities\OutletStockQuery|\entities\OutletStockOtherSummaryQuery|\entities\OutletStockSummaryQuery|\entities\PrescriberDataQuery|\entities\RemindersQuery|\entities\TourplansQuery|\entities\OutletOrgDataKeysQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOutletOrgData|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletOrgData matching the query
 * @method     ChildOutletOrgData findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletOrgData matching the query, or a new ChildOutletOrgData object populated from the query conditions when no match is found
 *
 * @method     ChildOutletOrgData|null findOneByOutletOrgId(string $outlet_org_id) Return the first ChildOutletOrgData filtered by the outlet_org_id column
 * @method     ChildOutletOrgData|null findOneByOutletId(int $outlet_id) Return the first ChildOutletOrgData filtered by the outlet_id column
 * @method     ChildOutletOrgData|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletOrgData filtered by the org_unit_id column
 * @method     ChildOutletOrgData|null findOneByTags(string $tags) Return the first ChildOutletOrgData filtered by the tags column
 * @method     ChildOutletOrgData|null findOneByVisitFq(int $visit_fq) Return the first ChildOutletOrgData filtered by the visit_fq column
 * @method     ChildOutletOrgData|null findOneByComments(string $comments) Return the first ChildOutletOrgData filtered by the comments column
 * @method     ChildOutletOrgData|null findOneByOrgPotential(string $org_potential) Return the first ChildOutletOrgData filtered by the org_potential column
 * @method     ChildOutletOrgData|null findOneByBrandFocus(string $brand_focus) Return the first ChildOutletOrgData filtered by the brand_focus column
 * @method     ChildOutletOrgData|null findOneByCustomerFq(string $customer_fq) Return the first ChildOutletOrgData filtered by the customer_fq column
 * @method     ChildOutletOrgData|null findOneByCompanyId(int $company_id) Return the first ChildOutletOrgData filtered by the company_id column
 * @method     ChildOutletOrgData|null findOneByCreatedAt(string $created_at) Return the first ChildOutletOrgData filtered by the created_at column
 * @method     ChildOutletOrgData|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletOrgData filtered by the updated_at column
 * @method     ChildOutletOrgData|null findOneByItownid(int $itownid) Return the first ChildOutletOrgData filtered by the itownid column
 * @method     ChildOutletOrgData|null findOneByDefaultAddress(int $default_address) Return the first ChildOutletOrgData filtered by the default_address column
 * @method     ChildOutletOrgData|null findOneByLastVisitDate(string $last_visit_date) Return the first ChildOutletOrgData filtered by the last_visit_date column
 * @method     ChildOutletOrgData|null findOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildOutletOrgData filtered by the last_visit_employee column
 * @method     ChildOutletOrgData|null findOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOutletOrgData filtered by the outlet_org_code column
 * @method     ChildOutletOrgData|null findOneByInvestedAmount(string $invested_amount) Return the first ChildOutletOrgData filtered by the invested_amount column
 *
 * @method     ChildOutletOrgData requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletOrgData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOne(?ConnectionInterface $con = null) Return the first ChildOutletOrgData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletOrgData requireOneByOutletOrgId(string $outlet_org_id) Return the first ChildOutletOrgData filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByOutletId(int $outlet_id) Return the first ChildOutletOrgData filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletOrgData filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByTags(string $tags) Return the first ChildOutletOrgData filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByVisitFq(int $visit_fq) Return the first ChildOutletOrgData filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByComments(string $comments) Return the first ChildOutletOrgData filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByOrgPotential(string $org_potential) Return the first ChildOutletOrgData filtered by the org_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByBrandFocus(string $brand_focus) Return the first ChildOutletOrgData filtered by the brand_focus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByCustomerFq(string $customer_fq) Return the first ChildOutletOrgData filtered by the customer_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByCompanyId(int $company_id) Return the first ChildOutletOrgData filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByCreatedAt(string $created_at) Return the first ChildOutletOrgData filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletOrgData filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByItownid(int $itownid) Return the first ChildOutletOrgData filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByDefaultAddress(int $default_address) Return the first ChildOutletOrgData filtered by the default_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByLastVisitDate(string $last_visit_date) Return the first ChildOutletOrgData filtered by the last_visit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildOutletOrgData filtered by the last_visit_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOutletOrgData filtered by the outlet_org_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletOrgData requireOneByInvestedAmount(string $invested_amount) Return the first ChildOutletOrgData filtered by the invested_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletOrgData[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletOrgData objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> find(?ConnectionInterface $con = null) Return ChildOutletOrgData objects based on current ModelCriteria
 *
 * @method     ChildOutletOrgData[]|Collection findByOutletOrgId(string|array<string> $outlet_org_id) Return ChildOutletOrgData objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByOutletOrgId(string|array<string> $outlet_org_id) Return ChildOutletOrgData objects filtered by the outlet_org_id column
 * @method     ChildOutletOrgData[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOutletOrgData objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByOutletId(int|array<int> $outlet_id) Return ChildOutletOrgData objects filtered by the outlet_id column
 * @method     ChildOutletOrgData[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletOrgData objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletOrgData objects filtered by the org_unit_id column
 * @method     ChildOutletOrgData[]|Collection findByTags(string|array<string> $tags) Return ChildOutletOrgData objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByTags(string|array<string> $tags) Return ChildOutletOrgData objects filtered by the tags column
 * @method     ChildOutletOrgData[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildOutletOrgData objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByVisitFq(int|array<int> $visit_fq) Return ChildOutletOrgData objects filtered by the visit_fq column
 * @method     ChildOutletOrgData[]|Collection findByComments(string|array<string> $comments) Return ChildOutletOrgData objects filtered by the comments column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByComments(string|array<string> $comments) Return ChildOutletOrgData objects filtered by the comments column
 * @method     ChildOutletOrgData[]|Collection findByOrgPotential(string|array<string> $org_potential) Return ChildOutletOrgData objects filtered by the org_potential column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByOrgPotential(string|array<string> $org_potential) Return ChildOutletOrgData objects filtered by the org_potential column
 * @method     ChildOutletOrgData[]|Collection findByBrandFocus(string|array<string> $brand_focus) Return ChildOutletOrgData objects filtered by the brand_focus column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByBrandFocus(string|array<string> $brand_focus) Return ChildOutletOrgData objects filtered by the brand_focus column
 * @method     ChildOutletOrgData[]|Collection findByCustomerFq(string|array<string> $customer_fq) Return ChildOutletOrgData objects filtered by the customer_fq column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByCustomerFq(string|array<string> $customer_fq) Return ChildOutletOrgData objects filtered by the customer_fq column
 * @method     ChildOutletOrgData[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletOrgData objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByCompanyId(int|array<int> $company_id) Return ChildOutletOrgData objects filtered by the company_id column
 * @method     ChildOutletOrgData[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletOrgData objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByCreatedAt(string|array<string> $created_at) Return ChildOutletOrgData objects filtered by the created_at column
 * @method     ChildOutletOrgData[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletOrgData objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletOrgData objects filtered by the updated_at column
 * @method     ChildOutletOrgData[]|Collection findByItownid(int|array<int> $itownid) Return ChildOutletOrgData objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByItownid(int|array<int> $itownid) Return ChildOutletOrgData objects filtered by the itownid column
 * @method     ChildOutletOrgData[]|Collection findByDefaultAddress(int|array<int> $default_address) Return ChildOutletOrgData objects filtered by the default_address column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByDefaultAddress(int|array<int> $default_address) Return ChildOutletOrgData objects filtered by the default_address column
 * @method     ChildOutletOrgData[]|Collection findByLastVisitDate(string|array<string> $last_visit_date) Return ChildOutletOrgData objects filtered by the last_visit_date column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByLastVisitDate(string|array<string> $last_visit_date) Return ChildOutletOrgData objects filtered by the last_visit_date column
 * @method     ChildOutletOrgData[]|Collection findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildOutletOrgData objects filtered by the last_visit_employee column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildOutletOrgData objects filtered by the last_visit_employee column
 * @method     ChildOutletOrgData[]|Collection findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOutletOrgData objects filtered by the outlet_org_code column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOutletOrgData objects filtered by the outlet_org_code column
 * @method     ChildOutletOrgData[]|Collection findByInvestedAmount(string|array<string> $invested_amount) Return ChildOutletOrgData objects filtered by the invested_amount column
 * @psalm-method Collection&\Traversable<ChildOutletOrgData> findByInvestedAmount(string|array<string> $invested_amount) Return ChildOutletOrgData objects filtered by the invested_amount column
 *
 * @method     ChildOutletOrgData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletOrgData> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletOrgDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletOrgDataQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletOrgData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletOrgDataQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletOrgDataQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletOrgDataQuery) {
            return $criteria;
        }
        $query = new ChildOutletOrgDataQuery();
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
     * @return ChildOutletOrgData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletOrgDataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletOrgData A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_org_id, outlet_id, org_unit_id, tags, visit_fq, comments, org_potential, brand_focus, customer_fq, company_id, created_at, updated_at, itownid, default_address, last_visit_date, last_visit_employee, outlet_org_code, invested_amount FROM outlet_org_data WHERE outlet_org_id = :p0';
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
            /** @var ChildOutletOrgData $obj */
            $obj = new ChildOutletOrgData();
            $obj->hydrate($row);
            OutletOrgDataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletOrgData|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgId(1234); // WHERE outlet_org_id = 1234
     * $query->filterByOutletOrgId(array(12, 34)); // WHERE outlet_org_id IN (12, 34)
     * $query->filterByOutletOrgId(array('min' => 12)); // WHERE outlet_org_id > 12
     * </code>
     *
     * @param mixed $outletOrgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgId($outletOrgId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgId)) {
            $useMinMax = false;
            if (isset($outletOrgId['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

        return $this;
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
     * @see       filterByOutlets()
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
                $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitId(1234); // WHERE org_unit_id = 1234
     * $query->filterByOrgUnitId(array(12, 34)); // WHERE org_unit_id IN (12, 34)
     * $query->filterByOrgUnitId(array('min' => 12)); // WHERE org_unit_id > 12
     * </code>
     *
     * @see       filterByOrgUnit()
     *
     * @param mixed $orgUnitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitId($orgUnitId = null, ?string $comparison = null)
    {
        if (is_array($orgUnitId)) {
            $useMinMax = false;
            if (isset($orgUnitId['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitFq(1234); // WHERE visit_fq = 1234
     * $query->filterByVisitFq(array(12, 34)); // WHERE visit_fq IN (12, 34)
     * $query->filterByVisitFq(array('min' => 12)); // WHERE visit_fq > 12
     * </code>
     *
     * @param mixed $visitFq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitFq($visitFq = null, ?string $comparison = null)
    {
        if (is_array($visitFq)) {
            $useMinMax = false;
            if (isset($visitFq['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_VISIT_FQ, $visitFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%', Criteria::LIKE); // WHERE comments LIKE '%fooValue%'
     * $query->filterByComments(['foo', 'bar']); // WHERE comments IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comments The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComments($comments = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_COMMENTS, $comments, $comparison);

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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_ORG_POTENTIAL, $orgPotential, $comparison);

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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_BRAND_FOCUS, $brandFocus, $comparison);

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

        $this->addUsingAlias(OutletOrgDataTableMap::COL_CUSTOMER_FQ, $customerFq, $comparison);

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
                $this->addUsingAlias(OutletOrgDataTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletOrgDataTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletOrgDataTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
                $this->addUsingAlias(OutletOrgDataTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the default_address column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultAddress(1234); // WHERE default_address = 1234
     * $query->filterByDefaultAddress(array(12, 34)); // WHERE default_address IN (12, 34)
     * $query->filterByDefaultAddress(array('min' => 12)); // WHERE default_address > 12
     * </code>
     *
     * @see       filterByOutletAddress()
     *
     * @param mixed $defaultAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultAddress($defaultAddress = null, ?string $comparison = null)
    {
        if (is_array($defaultAddress)) {
            $useMinMax = false;
            if (isset($defaultAddress['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $defaultAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultAddress['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $defaultAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $defaultAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_visit_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLastVisitDate('2011-03-14'); // WHERE last_visit_date = '2011-03-14'
     * $query->filterByLastVisitDate('now'); // WHERE last_visit_date = '2011-03-14'
     * $query->filterByLastVisitDate(array('max' => 'yesterday')); // WHERE last_visit_date > '2011-03-13'
     * </code>
     *
     * @param mixed $lastVisitDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastVisitDate($lastVisitDate = null, ?string $comparison = null)
    {
        if (is_array($lastVisitDate)) {
            $useMinMax = false;
            if (isset($lastVisitDate['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitDate['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_DATE, $lastVisitDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_visit_employee column
     *
     * Example usage:
     * <code>
     * $query->filterByLastVisitEmployee(1234); // WHERE last_visit_employee = 1234
     * $query->filterByLastVisitEmployee(array(12, 34)); // WHERE last_visit_employee IN (12, 34)
     * $query->filterByLastVisitEmployee(array('min' => 12)); // WHERE last_visit_employee > 12
     * </code>
     *
     * @param mixed $lastVisitEmployee The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastVisitEmployee($lastVisitEmployee = null, ?string $comparison = null)
    {
        if (is_array($lastVisitEmployee)) {
            $useMinMax = false;
            if (isset($lastVisitEmployee['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitEmployee['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgCode('fooValue');   // WHERE outlet_org_code = 'fooValue'
     * $query->filterByOutletOrgCode('%fooValue%', Criteria::LIKE); // WHERE outlet_org_code LIKE '%fooValue%'
     * $query->filterByOutletOrgCode(['foo', 'bar']); // WHERE outlet_org_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletOrgCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgCode($outletOrgCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletOrgCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_CODE, $outletOrgCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the invested_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByInvestedAmount(1234); // WHERE invested_amount = 1234
     * $query->filterByInvestedAmount(array(12, 34)); // WHERE invested_amount IN (12, 34)
     * $query->filterByInvestedAmount(array('min' => 12)); // WHERE invested_amount > 12
     * </code>
     *
     * @param mixed $investedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByInvestedAmount($investedAmount = null, ?string $comparison = null)
    {
        if (is_array($investedAmount)) {
            $useMinMax = false;
            if (isset($investedAmount['min'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_INVESTED_AMOUNT, $investedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($investedAmount['max'])) {
                $this->addUsingAlias(OutletOrgDataTableMap::COL_INVESTED_AMOUNT, $investedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletOrgDataTableMap::COL_INVESTED_AMOUNT, $investedAmount, $comparison);

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
                ->addUsingAlias(OutletOrgDataTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOutlets() only accepts arguments of type \entities\Outlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Outlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Outlets');

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
            $this->addJoinObject($join, 'Outlets');
        }

        return $this;
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletsQuery A secondary query class using the current class as primary query
     */
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Outlets', '\entities\OutletsQuery');
    }

    /**
     * Use the Outlets relation Outlets object
     *
     * @param callable(\entities\OutletsQuery):\entities\OutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Outlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletsQuery The inner query object of the EXISTS statement
     */
    public function useOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT EXISTS query.
     *
     * @see useOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useExistsQuery('Outlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Outlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletsQuery The inner query object of the IN statement
     */
    public function useInOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Outlets table for a NOT IN query.
     *
     * @see useOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletsQuery */
        $q = $this->useInQuery('Outlets', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletAddress object
     *
     * @param \entities\OutletAddress|ObjectCollection $outletAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAddress($outletAddress, ?string $comparison = null)
    {
        if ($outletAddress instanceof \entities\OutletAddress) {
            return $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $outletAddress->getOutletAddressId(), $comparison);
        } elseif ($outletAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_DEFAULT_ADDRESS, $outletAddress->toKeyValue('PrimaryKey', 'OutletAddressId'), $comparison);

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
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            return $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOrgUnit() only accepts arguments of type \entities\OrgUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrgUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrgUnit');

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
            $this->addJoinObject($join, 'OrgUnit');
        }

        return $this;
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrgUnitQuery A secondary query class using the current class as primary query
     */
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrgUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrgUnit', '\entities\OrgUnitQuery');
    }

    /**
     * Use the OrgUnit relation OrgUnit object
     *
     * @param callable(\entities\OrgUnitQuery):\entities\OrgUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrgUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrgUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrgUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrgUnitQuery The inner query object of the EXISTS statement
     */
    public function useOrgUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT EXISTS query.
     *
     * @see useOrgUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrgUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useExistsQuery('OrgUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrgUnitQuery The inner query object of the IN statement
     */
    public function useInOrgUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrgUnit table for a NOT IN query.
     *
     * @see useOrgUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrgUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrgUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrgUnitQuery */
        $q = $this->useInQuery('OrgUnit', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletOrgDataTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
     * Filter the query by a related \entities\BeatOutlets object
     *
     * @param \entities\BeatOutlets|ObjectCollection $beatOutlets the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatOutlets($beatOutlets, ?string $comparison = null)
    {
        if ($beatOutlets instanceof \entities\BeatOutlets) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $beatOutlets->getBeatOrgOutlet(), $comparison);

            return $this;
        } elseif ($beatOutlets instanceof ObjectCollection) {
            $this
                ->useBeatOutletsQuery()
                ->filterByPrimaryKeys($beatOutlets->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBeatOutlets() only accepts arguments of type \entities\BeatOutlets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BeatOutlets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBeatOutlets(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BeatOutlets');

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
            $this->addJoinObject($join, 'BeatOutlets');
        }

        return $this;
    }

    /**
     * Use the BeatOutlets relation BeatOutlets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BeatOutletsQuery A secondary query class using the current class as primary query
     */
    public function useBeatOutletsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBeatOutlets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BeatOutlets', '\entities\BeatOutletsQuery');
    }

    /**
     * Use the BeatOutlets relation BeatOutlets object
     *
     * @param callable(\entities\BeatOutletsQuery):\entities\BeatOutletsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBeatOutletsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBeatOutletsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BeatOutlets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BeatOutletsQuery The inner query object of the EXISTS statement
     */
    public function useBeatOutletsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useExistsQuery('BeatOutlets', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for a NOT EXISTS query.
     *
     * @see useBeatOutletsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatOutletsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBeatOutletsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useExistsQuery('BeatOutlets', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BeatOutletsQuery The inner query object of the IN statement
     */
    public function useInBeatOutletsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useInQuery('BeatOutlets', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BeatOutlets table for a NOT IN query.
     *
     * @see useBeatOutletsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatOutletsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBeatOutletsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatOutletsQuery */
        $q = $this->useInQuery('BeatOutlets', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $brandCampiagnDoctors->getOutletOrgDataId(), $comparison);

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
     * Filter the query by a related \entities\Dailycalls object
     *
     * @param \entities\Dailycalls|ObjectCollection $dailycalls the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycalls($dailycalls, ?string $comparison = null)
    {
        if ($dailycalls instanceof \entities\Dailycalls) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $dailycalls->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($dailycalls instanceof ObjectCollection) {
            $this
                ->useDailycallsQuery()
                ->filterByPrimaryKeys($dailycalls->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDailycalls() only accepts arguments of type \entities\Dailycalls or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dailycalls relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycalls(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dailycalls');

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
            $this->addJoinObject($join, 'Dailycalls');
        }

        return $this;
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycalls($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dailycalls', '\entities\DailycallsQuery');
    }

    /**
     * Use the Dailycalls relation Dailycalls object
     *
     * @param callable(\entities\DailycallsQuery):\entities\DailycallsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dailycalls table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT EXISTS query.
     *
     * @see useDailycallsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useExistsQuery('Dailycalls', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsQuery The inner query object of the IN statement
     */
    public function useInDailycallsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dailycalls table for a NOT IN query.
     *
     * @see useDailycallsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsQuery */
        $q = $this->useInQuery('Dailycalls', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\DailycallsAttendees object
     *
     * @param \entities\DailycallsAttendees|ObjectCollection $dailycallsAttendees the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDailycallsAttendees($dailycallsAttendees, ?string $comparison = null)
    {
        if ($dailycallsAttendees instanceof \entities\DailycallsAttendees) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $dailycallsAttendees->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($dailycallsAttendees instanceof ObjectCollection) {
            $this
                ->useDailycallsAttendeesQuery()
                ->filterByPrimaryKeys($dailycallsAttendees->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDailycallsAttendees() only accepts arguments of type \entities\DailycallsAttendees or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DailycallsAttendees relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDailycallsAttendees(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DailycallsAttendees');

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
            $this->addJoinObject($join, 'DailycallsAttendees');
        }

        return $this;
    }

    /**
     * Use the DailycallsAttendees relation DailycallsAttendees object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DailycallsAttendeesQuery A secondary query class using the current class as primary query
     */
    public function useDailycallsAttendeesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDailycallsAttendees($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DailycallsAttendees', '\entities\DailycallsAttendeesQuery');
    }

    /**
     * Use the DailycallsAttendees relation DailycallsAttendees object
     *
     * @param callable(\entities\DailycallsAttendeesQuery):\entities\DailycallsAttendeesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDailycallsAttendeesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDailycallsAttendeesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DailycallsAttendees table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DailycallsAttendeesQuery The inner query object of the EXISTS statement
     */
    public function useDailycallsAttendeesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DailycallsAttendeesQuery */
        $q = $this->useExistsQuery('DailycallsAttendees', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DailycallsAttendees table for a NOT EXISTS query.
     *
     * @see useDailycallsAttendeesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsAttendeesQuery The inner query object of the NOT EXISTS statement
     */
    public function useDailycallsAttendeesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsAttendeesQuery */
        $q = $this->useExistsQuery('DailycallsAttendees', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DailycallsAttendees table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DailycallsAttendeesQuery The inner query object of the IN statement
     */
    public function useInDailycallsAttendeesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DailycallsAttendeesQuery */
        $q = $this->useInQuery('DailycallsAttendees', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DailycallsAttendees table for a NOT IN query.
     *
     * @see useDailycallsAttendeesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DailycallsAttendeesQuery The inner query object of the NOT IN statement
     */
    public function useNotInDailycallsAttendeesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DailycallsAttendeesQuery */
        $q = $this->useInQuery('DailycallsAttendees', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $dailycallsSgpiout->getOutletOrgdataId(), $comparison);

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
     * Filter the query by a related \entities\Dayplan object
     *
     * @param \entities\Dayplan|ObjectCollection $dayplan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDayplan($dayplan, ?string $comparison = null)
    {
        if ($dayplan instanceof \entities\Dayplan) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $dayplan->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($dayplan instanceof ObjectCollection) {
            $this
                ->useDayplanQuery()
                ->filterByPrimaryKeys($dayplan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDayplan() only accepts arguments of type \entities\Dayplan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dayplan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDayplan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dayplan');

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
            $this->addJoinObject($join, 'Dayplan');
        }

        return $this;
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DayplanQuery A secondary query class using the current class as primary query
     */
    public function useDayplanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDayplan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dayplan', '\entities\DayplanQuery');
    }

    /**
     * Use the Dayplan relation Dayplan object
     *
     * @param callable(\entities\DayplanQuery):\entities\DayplanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDayplanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDayplanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Dayplan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DayplanQuery The inner query object of the EXISTS statement
     */
    public function useDayplanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT EXISTS query.
     *
     * @see useDayplanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT EXISTS statement
     */
    public function useDayplanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useExistsQuery('Dayplan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Dayplan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DayplanQuery The inner query object of the IN statement
     */
    public function useInDayplanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Dayplan table for a NOT IN query.
     *
     * @see useDayplanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DayplanQuery The inner query object of the NOT IN statement
     */
    public function useNotInDayplanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DayplanQuery */
        $q = $this->useInQuery('Dayplan', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdFeedbacks object
     *
     * @param \entities\EdFeedbacks|ObjectCollection $edFeedbacks the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdFeedbacks($edFeedbacks, ?string $comparison = null)
    {
        if ($edFeedbacks instanceof \entities\EdFeedbacks) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $edFeedbacks->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($edFeedbacks instanceof ObjectCollection) {
            $this
                ->useEdFeedbacksQuery()
                ->filterByPrimaryKeys($edFeedbacks->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdFeedbacks() only accepts arguments of type \entities\EdFeedbacks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdFeedbacks relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdFeedbacks(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdFeedbacks');

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
            $this->addJoinObject($join, 'EdFeedbacks');
        }

        return $this;
    }

    /**
     * Use the EdFeedbacks relation EdFeedbacks object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdFeedbacksQuery A secondary query class using the current class as primary query
     */
    public function useEdFeedbacksQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdFeedbacks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdFeedbacks', '\entities\EdFeedbacksQuery');
    }

    /**
     * Use the EdFeedbacks relation EdFeedbacks object
     *
     * @param callable(\entities\EdFeedbacksQuery):\entities\EdFeedbacksQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdFeedbacksQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdFeedbacksQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdFeedbacks table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the EXISTS statement
     */
    public function useEdFeedbacksExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useExistsQuery('EdFeedbacks', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for a NOT EXISTS query.
     *
     * @see useEdFeedbacksExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdFeedbacksNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useExistsQuery('EdFeedbacks', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the IN statement
     */
    public function useInEdFeedbacksQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useInQuery('EdFeedbacks', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdFeedbacks table for a NOT IN query.
     *
     * @see useEdFeedbacksInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdFeedbacksQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdFeedbacksQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdFeedbacksQuery */
        $q = $this->useInQuery('EdFeedbacks', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdSession object
     *
     * @param \entities\EdSession|ObjectCollection $edSession the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdSession($edSession, ?string $comparison = null)
    {
        if ($edSession instanceof \entities\EdSession) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $edSession->getOutletOrgId(), $comparison);

            return $this;
        } elseif ($edSession instanceof ObjectCollection) {
            $this
                ->useEdSessionQuery()
                ->filterByPrimaryKeys($edSession->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdSession() only accepts arguments of type \entities\EdSession or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdSession relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdSession(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdSession');

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
            $this->addJoinObject($join, 'EdSession');
        }

        return $this;
    }

    /**
     * Use the EdSession relation EdSession object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdSessionQuery A secondary query class using the current class as primary query
     */
    public function useEdSessionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdSession($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdSession', '\entities\EdSessionQuery');
    }

    /**
     * Use the EdSession relation EdSession object
     *
     * @param callable(\entities\EdSessionQuery):\entities\EdSessionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdSessionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdSessionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdSession table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdSessionQuery The inner query object of the EXISTS statement
     */
    public function useEdSessionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdSessionQuery */
        $q = $this->useExistsQuery('EdSession', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdSession table for a NOT EXISTS query.
     *
     * @see useEdSessionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdSessionQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdSessionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdSessionQuery */
        $q = $this->useExistsQuery('EdSession', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdSession table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdSessionQuery The inner query object of the IN statement
     */
    public function useInEdSessionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdSessionQuery */
        $q = $this->useInQuery('EdSession', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdSession table for a NOT IN query.
     *
     * @see useEdSessionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdSessionQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdSessionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdSessionQuery */
        $q = $this->useInQuery('EdSession', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdStats object
     *
     * @param \entities\EdStats|ObjectCollection $edStats the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdStats($edStats, ?string $comparison = null)
    {
        if ($edStats instanceof \entities\EdStats) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $edStats->getOutletOrgId(), $comparison);

            return $this;
        } elseif ($edStats instanceof ObjectCollection) {
            $this
                ->useEdStatsQuery()
                ->filterByPrimaryKeys($edStats->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdStats() only accepts arguments of type \entities\EdStats or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdStats relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdStats(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdStats');

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
            $this->addJoinObject($join, 'EdStats');
        }

        return $this;
    }

    /**
     * Use the EdStats relation EdStats object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdStatsQuery A secondary query class using the current class as primary query
     */
    public function useEdStatsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEdStats($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdStats', '\entities\EdStatsQuery');
    }

    /**
     * Use the EdStats relation EdStats object
     *
     * @param callable(\entities\EdStatsQuery):\entities\EdStatsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdStatsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEdStatsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdStats table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdStatsQuery The inner query object of the EXISTS statement
     */
    public function useEdStatsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useExistsQuery('EdStats', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdStats table for a NOT EXISTS query.
     *
     * @see useEdStatsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdStatsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdStatsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useExistsQuery('EdStats', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdStats table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdStatsQuery The inner query object of the IN statement
     */
    public function useInEdStatsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useInQuery('EdStats', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdStats table for a NOT IN query.
     *
     * @see useEdStatsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdStatsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdStatsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdStatsQuery */
        $q = $this->useInQuery('EdStats', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestAddress object
     *
     * @param \entities\OnBoardRequestAddress|ObjectCollection $onBoardRequestAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddress($onBoardRequestAddress, ?string $comparison = null)
    {
        if ($onBoardRequestAddress instanceof \entities\OnBoardRequestAddress) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $onBoardRequestAddress->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($onBoardRequestAddress instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestAddressQuery()
                ->filterByPrimaryKeys($onBoardRequestAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestAddress() only accepts arguments of type \entities\OnBoardRequestAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestAddress');

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
            $this->addJoinObject($join, 'OnBoardRequestAddress');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestAddressQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestAddress', '\entities\OnBoardRequestAddressQuery');
    }

    /**
     * Use the OnBoardRequestAddress relation OnBoardRequestAddress object
     *
     * @param callable(\entities\OnBoardRequestAddressQuery):\entities\OnBoardRequestAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useExistsQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestAddress table for a NOT IN query.
     *
     * @see useOnBoardRequestAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestAddressQuery */
        $q = $this->useInQuery('OnBoardRequestAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOrgNotes object
     *
     * @param \entities\OutletOrgNotes|ObjectCollection $outletOrgNotes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgNotes($outletOrgNotes, ?string $comparison = null)
    {
        if ($outletOrgNotes instanceof \entities\OutletOrgNotes) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgNotes->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($outletOrgNotes instanceof ObjectCollection) {
            $this
                ->useOutletOrgNotesQuery()
                ->filterByPrimaryKeys($outletOrgNotes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOrgNotes() only accepts arguments of type \entities\OutletOrgNotes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOrgNotes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOrgNotes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOrgNotes');

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
            $this->addJoinObject($join, 'OutletOrgNotes');
        }

        return $this;
    }

    /**
     * Use the OutletOrgNotes relation OutletOrgNotes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOrgNotesQuery A secondary query class using the current class as primary query
     */
    public function useOutletOrgNotesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletOrgNotes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOrgNotes', '\entities\OutletOrgNotesQuery');
    }

    /**
     * Use the OutletOrgNotes relation OutletOrgNotes object
     *
     * @param callable(\entities\OutletOrgNotesQuery):\entities\OutletOrgNotesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOrgNotesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletOrgNotesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOrgNotes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOrgNotesQuery The inner query object of the EXISTS statement
     */
    public function useOutletOrgNotesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOrgNotesQuery */
        $q = $this->useExistsQuery('OutletOrgNotes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOrgNotes table for a NOT EXISTS query.
     *
     * @see useOutletOrgNotesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgNotesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOrgNotesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgNotesQuery */
        $q = $this->useExistsQuery('OutletOrgNotes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOrgNotes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOrgNotesQuery The inner query object of the IN statement
     */
    public function useInOutletOrgNotesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOrgNotesQuery */
        $q = $this->useInQuery('OutletOrgNotes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOrgNotes table for a NOT IN query.
     *
     * @see useOutletOrgNotesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgNotesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOrgNotesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgNotesQuery */
        $q = $this->useInQuery('OutletOrgNotes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletStock->getOutletOrgId(), $comparison);

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
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletStockOtherSummary->getOutletOrgId(), $comparison);

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
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletStockSummary->getOutletOrgId(), $comparison);

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
     * Filter the query by a related \entities\PrescriberData object
     *
     * @param \entities\PrescriberData|ObjectCollection $prescriberData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberData($prescriberData, ?string $comparison = null)
    {
        if ($prescriberData instanceof \entities\PrescriberData) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $prescriberData->getOutletOrgId(), $comparison);

            return $this;
        } elseif ($prescriberData instanceof ObjectCollection) {
            $this
                ->usePrescriberDataQuery()
                ->filterByPrimaryKeys($prescriberData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberData() only accepts arguments of type \entities\PrescriberData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberData');

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
            $this->addJoinObject($join, 'PrescriberData');
        }

        return $this;
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberDataQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberData', '\entities\PrescriberDataQuery');
    }

    /**
     * Use the PrescriberData relation PrescriberData object
     *
     * @param callable(\entities\PrescriberDataQuery):\entities\PrescriberDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberDataQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT EXISTS query.
     *
     * @see usePrescriberDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useExistsQuery('PrescriberData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberDataQuery The inner query object of the IN statement
     */
    public function useInPrescriberDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberData table for a NOT IN query.
     *
     * @see usePrescriberDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberDataQuery */
        $q = $this->useInQuery('PrescriberData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Reminders object
     *
     * @param \entities\Reminders|ObjectCollection $reminders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReminders($reminders, ?string $comparison = null)
    {
        if ($reminders instanceof \entities\Reminders) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $reminders->getOutletOrgId(), $comparison);

            return $this;
        } elseif ($reminders instanceof ObjectCollection) {
            $this
                ->useRemindersQuery()
                ->filterByPrimaryKeys($reminders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByReminders() only accepts arguments of type \entities\Reminders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reminders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinReminders(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reminders');

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
            $this->addJoinObject($join, 'Reminders');
        }

        return $this;
    }

    /**
     * Use the Reminders relation Reminders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\RemindersQuery A secondary query class using the current class as primary query
     */
    public function useRemindersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReminders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reminders', '\entities\RemindersQuery');
    }

    /**
     * Use the Reminders relation Reminders object
     *
     * @param callable(\entities\RemindersQuery):\entities\RemindersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRemindersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useRemindersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Reminders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\RemindersQuery The inner query object of the EXISTS statement
     */
    public function useRemindersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\RemindersQuery */
        $q = $this->useExistsQuery('Reminders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Reminders table for a NOT EXISTS query.
     *
     * @see useRemindersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\RemindersQuery The inner query object of the NOT EXISTS statement
     */
    public function useRemindersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\RemindersQuery */
        $q = $this->useExistsQuery('Reminders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Reminders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\RemindersQuery The inner query object of the IN statement
     */
    public function useInRemindersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\RemindersQuery */
        $q = $this->useInQuery('Reminders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Reminders table for a NOT IN query.
     *
     * @see useRemindersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\RemindersQuery The inner query object of the NOT IN statement
     */
    public function useNotInRemindersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\RemindersQuery */
        $q = $this->useInQuery('Reminders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tourplans object
     *
     * @param \entities\Tourplans|ObjectCollection $tourplans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTourplans($tourplans, ?string $comparison = null)
    {
        if ($tourplans instanceof \entities\Tourplans) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $tourplans->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($tourplans instanceof ObjectCollection) {
            $this
                ->useTourplansQuery()
                ->filterByPrimaryKeys($tourplans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTourplans() only accepts arguments of type \entities\Tourplans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tourplans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTourplans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tourplans');

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
            $this->addJoinObject($join, 'Tourplans');
        }

        return $this;
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TourplansQuery A secondary query class using the current class as primary query
     */
    public function useTourplansQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTourplans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tourplans', '\entities\TourplansQuery');
    }

    /**
     * Use the Tourplans relation Tourplans object
     *
     * @param callable(\entities\TourplansQuery):\entities\TourplansQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTourplansQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTourplansQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Tourplans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TourplansQuery The inner query object of the EXISTS statement
     */
    public function useTourplansExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT EXISTS query.
     *
     * @see useTourplansExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT EXISTS statement
     */
    public function useTourplansNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useExistsQuery('Tourplans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Tourplans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TourplansQuery The inner query object of the IN statement
     */
    public function useInTourplansQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Tourplans table for a NOT IN query.
     *
     * @see useTourplansInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TourplansQuery The inner query object of the NOT IN statement
     */
    public function useNotInTourplansQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TourplansQuery */
        $q = $this->useInQuery('Tourplans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletOrgDataKeys object
     *
     * @param \entities\OutletOrgDataKeys|ObjectCollection $outletOrgDataKeys the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgDataKeys($outletOrgDataKeys, ?string $comparison = null)
    {
        if ($outletOrgDataKeys instanceof \entities\OutletOrgDataKeys) {
            $this
                ->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgDataKeys->getOutletOrgDataId(), $comparison);

            return $this;
        } elseif ($outletOrgDataKeys instanceof ObjectCollection) {
            $this
                ->useOutletOrgDataKeysQuery()
                ->filterByPrimaryKeys($outletOrgDataKeys->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOrgDataKeys() only accepts arguments of type \entities\OutletOrgDataKeys or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOrgDataKeys relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOrgDataKeys(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOrgDataKeys');

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
            $this->addJoinObject($join, 'OutletOrgDataKeys');
        }

        return $this;
    }

    /**
     * Use the OutletOrgDataKeys relation OutletOrgDataKeys object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOrgDataKeysQuery A secondary query class using the current class as primary query
     */
    public function useOutletOrgDataKeysQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOutletOrgDataKeys($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOrgDataKeys', '\entities\OutletOrgDataKeysQuery');
    }

    /**
     * Use the OutletOrgDataKeys relation OutletOrgDataKeys object
     *
     * @param callable(\entities\OutletOrgDataKeysQuery):\entities\OutletOrgDataKeysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOrgDataKeysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOutletOrgDataKeysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOrgDataKeys table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOrgDataKeysQuery The inner query object of the EXISTS statement
     */
    public function useOutletOrgDataKeysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOrgDataKeysQuery */
        $q = $this->useExistsQuery('OutletOrgDataKeys', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOrgDataKeys table for a NOT EXISTS query.
     *
     * @see useOutletOrgDataKeysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataKeysQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOrgDataKeysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataKeysQuery */
        $q = $this->useExistsQuery('OutletOrgDataKeys', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOrgDataKeys table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOrgDataKeysQuery The inner query object of the IN statement
     */
    public function useInOutletOrgDataKeysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOrgDataKeysQuery */
        $q = $this->useInQuery('OutletOrgDataKeys', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOrgDataKeys table for a NOT IN query.
     *
     * @see useOutletOrgDataKeysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOrgDataKeysQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOrgDataKeysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOrgDataKeysQuery */
        $q = $this->useInQuery('OutletOrgDataKeys', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletOrgData $outletOrgData Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletOrgData = null)
    {
        if ($outletOrgData) {
            $this->addUsingAlias(OutletOrgDataTableMap::COL_OUTLET_ORG_ID, $outletOrgData->getOutletOrgId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the outlet_org_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OutletOrgDataTableMap::clearInstancePool();
            OutletOrgDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OutletOrgDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OutletOrgDataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OutletOrgDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

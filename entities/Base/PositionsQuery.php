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
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\Map\PositionsTableMap;

/**
 * Base class that represents a query for the `positions` table.
 *
 * @method     ChildPositionsQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildPositionsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPositionsQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildPositionsQuery orderByPositionCode($order = Criteria::ASC) Order by the position_code column
 * @method     ChildPositionsQuery orderByReportingTo($order = Criteria::ASC) Order by the reporting_to column
 * @method     ChildPositionsQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildPositionsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPositionsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildPositionsQuery orderByCavPositionsUp($order = Criteria::ASC) Order by the cav_positions_up column
 * @method     ChildPositionsQuery orderByCavPositionsDown($order = Criteria::ASC) Order by the cav_positions_down column
 * @method     ChildPositionsQuery orderByCavTerritories($order = Criteria::ASC) Order by the cav_territories column
 * @method     ChildPositionsQuery orderByCavTowns($order = Criteria::ASC) Order by the cav_towns column
 * @method     ChildPositionsQuery orderByCavDate($order = Criteria::ASC) Order by the cav_date column
 * @method     ChildPositionsQuery orderByCavFlag($order = Criteria::ASC) Order by the cav_flag column
 * @method     ChildPositionsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildPositionsQuery orderByMtpType($order = Criteria::ASC) Order by the mtp_type column
 *
 * @method     ChildPositionsQuery groupByPositionId() Group by the position_id column
 * @method     ChildPositionsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPositionsQuery groupByPositionName() Group by the position_name column
 * @method     ChildPositionsQuery groupByPositionCode() Group by the position_code column
 * @method     ChildPositionsQuery groupByReportingTo() Group by the reporting_to column
 * @method     ChildPositionsQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildPositionsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPositionsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildPositionsQuery groupByCavPositionsUp() Group by the cav_positions_up column
 * @method     ChildPositionsQuery groupByCavPositionsDown() Group by the cav_positions_down column
 * @method     ChildPositionsQuery groupByCavTerritories() Group by the cav_territories column
 * @method     ChildPositionsQuery groupByCavTowns() Group by the cav_towns column
 * @method     ChildPositionsQuery groupByCavDate() Group by the cav_date column
 * @method     ChildPositionsQuery groupByCavFlag() Group by the cav_flag column
 * @method     ChildPositionsQuery groupByItownid() Group by the itownid column
 * @method     ChildPositionsQuery groupByMtpType() Group by the mtp_type column
 *
 * @method     ChildPositionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPositionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPositionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPositionsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPositionsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPositionsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPositionsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPositionsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPositionsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPositionsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPositionsQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPositionsQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildPositionsQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildPositionsQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPositionsQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPositionsQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildPositionsQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildPositionsQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildPositionsQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildPositionsQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildPositionsQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildPositionsQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildPositionsQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildPositionsQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildPositionsQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildPositionsQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildPositionsQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildPositionsQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildPositionsQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildPositionsQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildPositionsQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildPositionsQuery leftJoinBrandCampiagnVisits($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildPositionsQuery rightJoinBrandCampiagnVisits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildPositionsQuery innerJoinBrandCampiagnVisits($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildPositionsQuery joinWithBrandCampiagnVisits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildPositionsQuery leftJoinWithBrandCampiagnVisits() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildPositionsQuery rightJoinWithBrandCampiagnVisits() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildPositionsQuery innerJoinWithBrandCampiagnVisits() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildPositionsQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildPositionsQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildPositionsQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildPositionsQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildPositionsQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildPositionsQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildPositionsQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildPositionsQuery leftJoinEmployeeRelatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinEmployeeRelatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinEmployeeRelatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByPositionId relation
 *
 * @method     ChildPositionsQuery joinWithEmployeeRelatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinWithEmployeeRelatedByPositionId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinWithEmployeeRelatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinWithEmployeeRelatedByPositionId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinEmployeeRelatedByReportingTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByReportingTo relation
 * @method     ChildPositionsQuery rightJoinEmployeeRelatedByReportingTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByReportingTo relation
 * @method     ChildPositionsQuery innerJoinEmployeeRelatedByReportingTo($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByReportingTo relation
 *
 * @method     ChildPositionsQuery joinWithEmployeeRelatedByReportingTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByReportingTo relation
 *
 * @method     ChildPositionsQuery leftJoinWithEmployeeRelatedByReportingTo() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByReportingTo relation
 * @method     ChildPositionsQuery rightJoinWithEmployeeRelatedByReportingTo() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByReportingTo relation
 * @method     ChildPositionsQuery innerJoinWithEmployeeRelatedByReportingTo() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByReportingTo relation
 *
 * @method     ChildPositionsQuery leftJoinEmployeePositionHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeePositionHistory relation
 * @method     ChildPositionsQuery rightJoinEmployeePositionHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeePositionHistory relation
 * @method     ChildPositionsQuery innerJoinEmployeePositionHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeePositionHistory relation
 *
 * @method     ChildPositionsQuery joinWithEmployeePositionHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeePositionHistory relation
 *
 * @method     ChildPositionsQuery leftJoinWithEmployeePositionHistory() Adds a LEFT JOIN clause and with to the query using the EmployeePositionHistory relation
 * @method     ChildPositionsQuery rightJoinWithEmployeePositionHistory() Adds a RIGHT JOIN clause and with to the query using the EmployeePositionHistory relation
 * @method     ChildPositionsQuery innerJoinWithEmployeePositionHistory() Adds a INNER JOIN clause and with to the query using the EmployeePositionHistory relation
 *
 * @method     ChildPositionsQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildPositionsQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildPositionsQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildPositionsQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildPositionsQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildPositionsQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildPositionsQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestRelatedByApprovedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestRelatedByApprovedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestRelatedByApprovedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestRelatedByApprovedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestRelatedByApprovedByPositionId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestRelatedByApprovedByPositionId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestRelatedByApprovedByPositionId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestRelatedByCreatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestRelatedByCreatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestRelatedByCreatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestRelatedByCreatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestRelatedByCreatedByPositionId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestRelatedByCreatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestRelatedByCreatedByPositionId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestRelatedByFinalApprovedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestRelatedByFinalApprovedByPositionId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestRelatedByFinalApprovedByPositionId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestRelatedByFinalApprovedByPositionId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestRelatedByPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByPosition relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestRelatedByPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByPosition relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestRelatedByPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByPosition relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestRelatedByPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByPosition relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestRelatedByPosition() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByPosition relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestRelatedByPosition() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByPosition relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestRelatedByPosition() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByPosition relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestRelatedByUpdatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestRelatedByUpdatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestRelatedByUpdatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestRelatedByUpdatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestRelatedByUpdatedByPositionId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestRelatedByUpdatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestRelatedByUpdatedByPositionId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
 *
 * @method     ChildPositionsQuery leftJoinOnBoardRequestLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildPositionsQuery rightJoinOnBoardRequestLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildPositionsQuery innerJoinOnBoardRequestLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestLog relation
 *
 * @method     ChildPositionsQuery joinWithOnBoardRequestLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildPositionsQuery leftJoinWithOnBoardRequestLog() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildPositionsQuery rightJoinWithOnBoardRequestLog() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildPositionsQuery innerJoinWithOnBoardRequestLog() Adds a INNER JOIN clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildPositionsQuery leftJoinPrescriberData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberData relation
 * @method     ChildPositionsQuery rightJoinPrescriberData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberData relation
 * @method     ChildPositionsQuery innerJoinPrescriberData($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberData relation
 *
 * @method     ChildPositionsQuery joinWithPrescriberData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberData relation
 *
 * @method     ChildPositionsQuery leftJoinWithPrescriberData() Adds a LEFT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildPositionsQuery rightJoinWithPrescriberData() Adds a RIGHT JOIN clause and with to the query using the PrescriberData relation
 * @method     ChildPositionsQuery innerJoinWithPrescriberData() Adds a INNER JOIN clause and with to the query using the PrescriberData relation
 *
 * @method     ChildPositionsQuery leftJoinPrescriberTallySummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildPositionsQuery rightJoinPrescriberTallySummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PrescriberTallySummary relation
 * @method     ChildPositionsQuery innerJoinPrescriberTallySummary($relationAlias = null) Adds a INNER JOIN clause to the query using the PrescriberTallySummary relation
 *
 * @method     ChildPositionsQuery joinWithPrescriberTallySummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildPositionsQuery leftJoinWithPrescriberTallySummary() Adds a LEFT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildPositionsQuery rightJoinWithPrescriberTallySummary() Adds a RIGHT JOIN clause and with to the query using the PrescriberTallySummary relation
 * @method     ChildPositionsQuery innerJoinWithPrescriberTallySummary() Adds a INNER JOIN clause and with to the query using the PrescriberTallySummary relation
 *
 * @method     ChildPositionsQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildPositionsQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildPositionsQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildPositionsQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildPositionsQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildPositionsQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildPositionsQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildPositionsQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildPositionsQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildPositionsQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildPositionsQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildPositionsQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildPositionsQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildPositionsQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     ChildPositionsQuery leftJoinStp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stp relation
 * @method     ChildPositionsQuery rightJoinStp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stp relation
 * @method     ChildPositionsQuery innerJoinStp($relationAlias = null) Adds a INNER JOIN clause to the query using the Stp relation
 *
 * @method     ChildPositionsQuery joinWithStp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Stp relation
 *
 * @method     ChildPositionsQuery leftJoinWithStp() Adds a LEFT JOIN clause and with to the query using the Stp relation
 * @method     ChildPositionsQuery rightJoinWithStp() Adds a RIGHT JOIN clause and with to the query using the Stp relation
 * @method     ChildPositionsQuery innerJoinWithStp() Adds a INNER JOIN clause and with to the query using the Stp relation
 *
 * @method     \entities\CompanyQuery|\entities\OrgUnitQuery|\entities\GeoTownsQuery|\entities\BrandCampiagnDoctorsQuery|\entities\BrandCampiagnVisitsQuery|\entities\DailycallsQuery|\entities\EmployeeQuery|\entities\EmployeeQuery|\entities\EmployeePositionHistoryQuery|\entities\MtpQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestLogQuery|\entities\PrescriberDataQuery|\entities\PrescriberTallySummaryQuery|\entities\TerritoriesQuery|\entities\TourplansQuery|\entities\StpQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPositions|null findOne(?ConnectionInterface $con = null) Return the first ChildPositions matching the query
 * @method     ChildPositions findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPositions matching the query, or a new ChildPositions object populated from the query conditions when no match is found
 *
 * @method     ChildPositions|null findOneByPositionId(int $position_id) Return the first ChildPositions filtered by the position_id column
 * @method     ChildPositions|null findOneByCompanyId(int $company_id) Return the first ChildPositions filtered by the company_id column
 * @method     ChildPositions|null findOneByPositionName(string $position_name) Return the first ChildPositions filtered by the position_name column
 * @method     ChildPositions|null findOneByPositionCode(string $position_code) Return the first ChildPositions filtered by the position_code column
 * @method     ChildPositions|null findOneByReportingTo(int $reporting_to) Return the first ChildPositions filtered by the reporting_to column
 * @method     ChildPositions|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildPositions filtered by the org_unit_id column
 * @method     ChildPositions|null findOneByCreatedAt(string $created_at) Return the first ChildPositions filtered by the created_at column
 * @method     ChildPositions|null findOneByUpdatedAt(string $updated_at) Return the first ChildPositions filtered by the updated_at column
 * @method     ChildPositions|null findOneByCavPositionsUp(string $cav_positions_up) Return the first ChildPositions filtered by the cav_positions_up column
 * @method     ChildPositions|null findOneByCavPositionsDown(string $cav_positions_down) Return the first ChildPositions filtered by the cav_positions_down column
 * @method     ChildPositions|null findOneByCavTerritories(string $cav_territories) Return the first ChildPositions filtered by the cav_territories column
 * @method     ChildPositions|null findOneByCavTowns(string $cav_towns) Return the first ChildPositions filtered by the cav_towns column
 * @method     ChildPositions|null findOneByCavDate(string $cav_date) Return the first ChildPositions filtered by the cav_date column
 * @method     ChildPositions|null findOneByCavFlag(string $cav_flag) Return the first ChildPositions filtered by the cav_flag column
 * @method     ChildPositions|null findOneByItownid(int $itownid) Return the first ChildPositions filtered by the itownid column
 * @method     ChildPositions|null findOneByMtpType(string $mtp_type) Return the first ChildPositions filtered by the mtp_type column
 *
 * @method     ChildPositions requirePk($key, ?ConnectionInterface $con = null) Return the ChildPositions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOne(?ConnectionInterface $con = null) Return the first ChildPositions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositions requireOneByPositionId(int $position_id) Return the first ChildPositions filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCompanyId(int $company_id) Return the first ChildPositions filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByPositionName(string $position_name) Return the first ChildPositions filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByPositionCode(string $position_code) Return the first ChildPositions filtered by the position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByReportingTo(int $reporting_to) Return the first ChildPositions filtered by the reporting_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByOrgUnitId(int $org_unit_id) Return the first ChildPositions filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCreatedAt(string $created_at) Return the first ChildPositions filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByUpdatedAt(string $updated_at) Return the first ChildPositions filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavPositionsUp(string $cav_positions_up) Return the first ChildPositions filtered by the cav_positions_up column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavPositionsDown(string $cav_positions_down) Return the first ChildPositions filtered by the cav_positions_down column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavTerritories(string $cav_territories) Return the first ChildPositions filtered by the cav_territories column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavTowns(string $cav_towns) Return the first ChildPositions filtered by the cav_towns column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavDate(string $cav_date) Return the first ChildPositions filtered by the cav_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByCavFlag(string $cav_flag) Return the first ChildPositions filtered by the cav_flag column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByItownid(int $itownid) Return the first ChildPositions filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositions requireOneByMtpType(string $mtp_type) Return the first ChildPositions filtered by the mtp_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositions[]|Collection find(?ConnectionInterface $con = null) Return ChildPositions objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPositions> find(?ConnectionInterface $con = null) Return ChildPositions objects based on current ModelCriteria
 *
 * @method     ChildPositions[]|Collection findByPositionId(int|array<int> $position_id) Return ChildPositions objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildPositions> findByPositionId(int|array<int> $position_id) Return ChildPositions objects filtered by the position_id column
 * @method     ChildPositions[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildPositions objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCompanyId(int|array<int> $company_id) Return ChildPositions objects filtered by the company_id column
 * @method     ChildPositions[]|Collection findByPositionName(string|array<string> $position_name) Return ChildPositions objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildPositions> findByPositionName(string|array<string> $position_name) Return ChildPositions objects filtered by the position_name column
 * @method     ChildPositions[]|Collection findByPositionCode(string|array<string> $position_code) Return ChildPositions objects filtered by the position_code column
 * @psalm-method Collection&\Traversable<ChildPositions> findByPositionCode(string|array<string> $position_code) Return ChildPositions objects filtered by the position_code column
 * @method     ChildPositions[]|Collection findByReportingTo(int|array<int> $reporting_to) Return ChildPositions objects filtered by the reporting_to column
 * @psalm-method Collection&\Traversable<ChildPositions> findByReportingTo(int|array<int> $reporting_to) Return ChildPositions objects filtered by the reporting_to column
 * @method     ChildPositions[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildPositions objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildPositions> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildPositions objects filtered by the org_unit_id column
 * @method     ChildPositions[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildPositions objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCreatedAt(string|array<string> $created_at) Return ChildPositions objects filtered by the created_at column
 * @method     ChildPositions[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildPositions objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildPositions> findByUpdatedAt(string|array<string> $updated_at) Return ChildPositions objects filtered by the updated_at column
 * @method     ChildPositions[]|Collection findByCavPositionsUp(string|array<string> $cav_positions_up) Return ChildPositions objects filtered by the cav_positions_up column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavPositionsUp(string|array<string> $cav_positions_up) Return ChildPositions objects filtered by the cav_positions_up column
 * @method     ChildPositions[]|Collection findByCavPositionsDown(string|array<string> $cav_positions_down) Return ChildPositions objects filtered by the cav_positions_down column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavPositionsDown(string|array<string> $cav_positions_down) Return ChildPositions objects filtered by the cav_positions_down column
 * @method     ChildPositions[]|Collection findByCavTerritories(string|array<string> $cav_territories) Return ChildPositions objects filtered by the cav_territories column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavTerritories(string|array<string> $cav_territories) Return ChildPositions objects filtered by the cav_territories column
 * @method     ChildPositions[]|Collection findByCavTowns(string|array<string> $cav_towns) Return ChildPositions objects filtered by the cav_towns column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavTowns(string|array<string> $cav_towns) Return ChildPositions objects filtered by the cav_towns column
 * @method     ChildPositions[]|Collection findByCavDate(string|array<string> $cav_date) Return ChildPositions objects filtered by the cav_date column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavDate(string|array<string> $cav_date) Return ChildPositions objects filtered by the cav_date column
 * @method     ChildPositions[]|Collection findByCavFlag(string|array<string> $cav_flag) Return ChildPositions objects filtered by the cav_flag column
 * @psalm-method Collection&\Traversable<ChildPositions> findByCavFlag(string|array<string> $cav_flag) Return ChildPositions objects filtered by the cav_flag column
 * @method     ChildPositions[]|Collection findByItownid(int|array<int> $itownid) Return ChildPositions objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildPositions> findByItownid(int|array<int> $itownid) Return ChildPositions objects filtered by the itownid column
 * @method     ChildPositions[]|Collection findByMtpType(string|array<string> $mtp_type) Return ChildPositions objects filtered by the mtp_type column
 * @psalm-method Collection&\Traversable<ChildPositions> findByMtpType(string|array<string> $mtp_type) Return ChildPositions objects filtered by the mtp_type column
 *
 * @method     ChildPositions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPositions> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PositionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\PositionsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Positions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPositionsQuery) {
            return $criteria;
        }
        $query = new ChildPositionsQuery();
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
     * @return ChildPositions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PositionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPositions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT position_id, company_id, position_name, position_code, reporting_to, org_unit_id, created_at, updated_at, cav_positions_up, cav_positions_down, cav_territories, cav_towns, cav_date, cav_flag, itownid, mtp_type FROM positions WHERE position_id = :p0';
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
            /** @var ChildPositions $obj */
            $obj = new ChildPositions();
            $obj->hydrate($row);
            PositionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPositions|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $positionId, $comparison);

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
                $this->addUsingAlias(PositionsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_COMPANY_ID, $companyId, $comparison);

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

        $this->addUsingAlias(PositionsTableMap::COL_POSITION_NAME, $positionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionCode('fooValue');   // WHERE position_code = 'fooValue'
     * $query->filterByPositionCode('%fooValue%', Criteria::LIKE); // WHERE position_code LIKE '%fooValue%'
     * $query->filterByPositionCode(['foo', 'bar']); // WHERE position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $positionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionCode($positionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($positionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_POSITION_CODE, $positionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_to column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingTo(1234); // WHERE reporting_to = 1234
     * $query->filterByReportingTo(array(12, 34)); // WHERE reporting_to IN (12, 34)
     * $query->filterByReportingTo(array('min' => 12)); // WHERE reporting_to > 12
     * </code>
     *
     * @param mixed $reportingTo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingTo($reportingTo = null, ?string $comparison = null)
    {
        if (is_array($reportingTo)) {
            $useMinMax = false;
            if (isset($reportingTo['min'])) {
                $this->addUsingAlias(PositionsTableMap::COL_REPORTING_TO, $reportingTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reportingTo['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_REPORTING_TO, $reportingTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_REPORTING_TO, $reportingTo, $comparison);

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
                $this->addUsingAlias(PositionsTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(PositionsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(PositionsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_positions_up column
     *
     * Example usage:
     * <code>
     * $query->filterByCavPositionsUp('fooValue');   // WHERE cav_positions_up = 'fooValue'
     * $query->filterByCavPositionsUp('%fooValue%', Criteria::LIKE); // WHERE cav_positions_up LIKE '%fooValue%'
     * $query->filterByCavPositionsUp(['foo', 'bar']); // WHERE cav_positions_up IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavPositionsUp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavPositionsUp($cavPositionsUp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavPositionsUp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_POSITIONS_UP, $cavPositionsUp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_positions_down column
     *
     * Example usage:
     * <code>
     * $query->filterByCavPositionsDown('fooValue');   // WHERE cav_positions_down = 'fooValue'
     * $query->filterByCavPositionsDown('%fooValue%', Criteria::LIKE); // WHERE cav_positions_down LIKE '%fooValue%'
     * $query->filterByCavPositionsDown(['foo', 'bar']); // WHERE cav_positions_down IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavPositionsDown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavPositionsDown($cavPositionsDown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavPositionsDown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_POSITIONS_DOWN, $cavPositionsDown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_territories column
     *
     * Example usage:
     * <code>
     * $query->filterByCavTerritories('fooValue');   // WHERE cav_territories = 'fooValue'
     * $query->filterByCavTerritories('%fooValue%', Criteria::LIKE); // WHERE cav_territories LIKE '%fooValue%'
     * $query->filterByCavTerritories(['foo', 'bar']); // WHERE cav_territories IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavTerritories The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavTerritories($cavTerritories = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavTerritories)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_TERRITORIES, $cavTerritories, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_towns column
     *
     * Example usage:
     * <code>
     * $query->filterByCavTowns('fooValue');   // WHERE cav_towns = 'fooValue'
     * $query->filterByCavTowns('%fooValue%', Criteria::LIKE); // WHERE cav_towns LIKE '%fooValue%'
     * $query->filterByCavTowns(['foo', 'bar']); // WHERE cav_towns IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavTowns The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavTowns($cavTowns = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavTowns)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_TOWNS, $cavTowns, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCavDate('2011-03-14'); // WHERE cav_date = '2011-03-14'
     * $query->filterByCavDate('now'); // WHERE cav_date = '2011-03-14'
     * $query->filterByCavDate(array('max' => 'yesterday')); // WHERE cav_date > '2011-03-13'
     * </code>
     *
     * @param mixed $cavDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavDate($cavDate = null, ?string $comparison = null)
    {
        if (is_array($cavDate)) {
            $useMinMax = false;
            if (isset($cavDate['min'])) {
                $this->addUsingAlias(PositionsTableMap::COL_CAV_DATE, $cavDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cavDate['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_CAV_DATE, $cavDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_DATE, $cavDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cav_flag column
     *
     * Example usage:
     * <code>
     * $query->filterByCavFlag('fooValue');   // WHERE cav_flag = 'fooValue'
     * $query->filterByCavFlag('%fooValue%', Criteria::LIKE); // WHERE cav_flag LIKE '%fooValue%'
     * $query->filterByCavFlag(['foo', 'bar']); // WHERE cav_flag IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $cavFlag The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCavFlag($cavFlag = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cavFlag)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_CAV_FLAG, $cavFlag, $comparison);

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
                $this->addUsingAlias(PositionsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(PositionsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mtp_type column
     *
     * Example usage:
     * <code>
     * $query->filterByMtpType('fooValue');   // WHERE mtp_type = 'fooValue'
     * $query->filterByMtpType('%fooValue%', Criteria::LIKE); // WHERE mtp_type LIKE '%fooValue%'
     * $query->filterByMtpType(['foo', 'bar']); // WHERE mtp_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mtpType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpType($mtpType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mtpType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PositionsTableMap::COL_MTP_TYPE, $mtpType, $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PositionsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PositionsTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PositionsTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $brandCampiagnDoctors->getPositionId(), $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $brandCampiagnVisits->getPositionId(), $comparison);

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
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $dailycalls->getPositionId(), $comparison);

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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByPositionId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $employee->getPositionId(), $comparison);

            return $this;
        } elseif ($employee instanceof ObjectCollection) {
            $this
                ->useEmployeeRelatedByPositionIdQuery()
                ->filterByPrimaryKeys($employee->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByPositionId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByPositionId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByPositionId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByPositionId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByPositionId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByPositionId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByPositionId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByPositionId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByPositionId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByReportingTo($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $employee->getReportingTo(), $comparison);

            return $this;
        } elseif ($employee instanceof ObjectCollection) {
            $this
                ->useEmployeeRelatedByReportingToQuery()
                ->filterByPrimaryKeys($employee->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByReportingTo() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByReportingTo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByReportingTo(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByReportingTo');

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
            $this->addJoinObject($join, 'EmployeeRelatedByReportingTo');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByReportingToQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByReportingTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByReportingTo', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByReportingToQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByReportingToQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByReportingToExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByReportingTo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByReportingToExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByReportingToNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByReportingTo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByReportingToQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByReportingTo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByReportingTo relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByReportingToInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByReportingToQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByReportingTo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EmployeePositionHistory object
     *
     * @param \entities\EmployeePositionHistory|ObjectCollection $employeePositionHistory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionHistory($employeePositionHistory, ?string $comparison = null)
    {
        if ($employeePositionHistory instanceof \entities\EmployeePositionHistory) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $employeePositionHistory->getPositionId(), $comparison);

            return $this;
        } elseif ($employeePositionHistory instanceof ObjectCollection) {
            $this
                ->useEmployeePositionHistoryQuery()
                ->filterByPrimaryKeys($employeePositionHistory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeePositionHistory() only accepts arguments of type \entities\EmployeePositionHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeePositionHistory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeePositionHistory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeePositionHistory');

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
            $this->addJoinObject($join, 'EmployeePositionHistory');
        }

        return $this;
    }

    /**
     * Use the EmployeePositionHistory relation EmployeePositionHistory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeePositionHistoryQuery A secondary query class using the current class as primary query
     */
    public function useEmployeePositionHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeePositionHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeePositionHistory', '\entities\EmployeePositionHistoryQuery');
    }

    /**
     * Use the EmployeePositionHistory relation EmployeePositionHistory object
     *
     * @param callable(\entities\EmployeePositionHistoryQuery):\entities\EmployeePositionHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeePositionHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeePositionHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EmployeePositionHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeePositionHistoryQuery The inner query object of the EXISTS statement
     */
    public function useEmployeePositionHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeePositionHistoryQuery */
        $q = $this->useExistsQuery('EmployeePositionHistory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EmployeePositionHistory table for a NOT EXISTS query.
     *
     * @see useEmployeePositionHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeePositionHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeePositionHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeePositionHistoryQuery */
        $q = $this->useExistsQuery('EmployeePositionHistory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EmployeePositionHistory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeePositionHistoryQuery The inner query object of the IN statement
     */
    public function useInEmployeePositionHistoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeePositionHistoryQuery */
        $q = $this->useInQuery('EmployeePositionHistory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EmployeePositionHistory table for a NOT IN query.
     *
     * @see useEmployeePositionHistoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeePositionHistoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeePositionHistoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeePositionHistoryQuery */
        $q = $this->useInQuery('EmployeePositionHistory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Mtp object
     *
     * @param \entities\Mtp|ObjectCollection $mtp the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtp($mtp, ?string $comparison = null)
    {
        if ($mtp instanceof \entities\Mtp) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $mtp->getPositionId(), $comparison);

            return $this;
        } elseif ($mtp instanceof ObjectCollection) {
            $this
                ->useMtpQuery()
                ->filterByPrimaryKeys($mtp->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMtp() only accepts arguments of type \entities\Mtp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Mtp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Mtp');

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
            $this->addJoinObject($join, 'Mtp');
        }

        return $this;
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpQuery A secondary query class using the current class as primary query
     */
    public function useMtpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMtp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Mtp', '\entities\MtpQuery');
    }

    /**
     * Use the Mtp relation Mtp object
     *
     * @param callable(\entities\MtpQuery):\entities\MtpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMtpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Mtp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpQuery The inner query object of the EXISTS statement
     */
    public function useMtpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT EXISTS query.
     *
     * @see useMtpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useExistsQuery('Mtp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Mtp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpQuery The inner query object of the IN statement
     */
    public function useInMtpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Mtp table for a NOT IN query.
     *
     * @see useMtpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpQuery */
        $q = $this->useInQuery('Mtp', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByApprovedByPositionId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequest->getApprovedByPositionId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByApprovedByPositionIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByApprovedByPositionId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByApprovedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByApprovedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByApprovedByPositionId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByApprovedByPositionId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByApprovedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByApprovedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByApprovedByPositionId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByApprovedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByApprovedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByApprovedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByApprovedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByApprovedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByApprovedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByApprovedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByApprovedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByApprovedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByPositionId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByApprovedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByApprovedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByApprovedByPositionId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByCreatedByPositionId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequest->getCreatedByPositionId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByCreatedByPositionIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByCreatedByPositionId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByCreatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByCreatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByCreatedByPositionId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByCreatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByCreatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByCreatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByCreatedByPositionId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByCreatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByCreatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByCreatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByCreatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByCreatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByCreatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByCreatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByCreatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByCreatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByPositionId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByCreatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByCreatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByCreatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByFinalApprovedByPositionId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequest->getFinalApprovedByPositionId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByFinalApprovedByPositionIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByFinalApprovedByPositionId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByFinalApprovedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByFinalApprovedByPositionId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByFinalApprovedByPositionId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByFinalApprovedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByFinalApprovedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByFinalApprovedByPositionId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByFinalApprovedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByFinalApprovedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByFinalApprovedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByFinalApprovedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByFinalApprovedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByFinalApprovedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByPositionId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByFinalApprovedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByFinalApprovedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByPosition($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequest->getPosition(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByPositionQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByPosition() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByPosition relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByPosition(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByPosition');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByPosition');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByPositionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByPosition', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByPositionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByPositionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByPositionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByPosition', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByPositionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByPositionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByPosition', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByPositionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByPosition', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByPosition relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByPositionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByPositionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByPosition', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByUpdatedByPositionId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequest->getUpdatedByPositionId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByUpdatedByPositionIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByUpdatedByPositionId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByUpdatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByUpdatedByPositionId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByUpdatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByUpdatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByUpdatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByUpdatedByPositionId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByUpdatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByUpdatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByUpdatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByUpdatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByUpdatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByUpdatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByUpdatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByUpdatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByUpdatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByPositionId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByUpdatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByUpdatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByUpdatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestLog object
     *
     * @param \entities\OnBoardRequestLog|ObjectCollection $onBoardRequestLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestLog($onBoardRequestLog, ?string $comparison = null)
    {
        if ($onBoardRequestLog instanceof \entities\OnBoardRequestLog) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $onBoardRequestLog->getEmployeePositionId(), $comparison);

            return $this;
        } elseif ($onBoardRequestLog instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestLogQuery()
                ->filterByPrimaryKeys($onBoardRequestLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestLog() only accepts arguments of type \entities\OnBoardRequestLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestLog(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestLog');

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
            $this->addJoinObject($join, 'OnBoardRequestLog');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestLog relation OnBoardRequestLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestLogQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestLog', '\entities\OnBoardRequestLogQuery');
    }

    /**
     * Use the OnBoardRequestLog relation OnBoardRequestLog object
     *
     * @param callable(\entities\OnBoardRequestLogQuery):\entities\OnBoardRequestLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useExistsQuery('OnBoardRequestLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useExistsQuery('OnBoardRequestLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useInQuery('OnBoardRequestLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for a NOT IN query.
     *
     * @see useOnBoardRequestLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useInQuery('OnBoardRequestLog', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $prescriberData->getPositionId(), $comparison);

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
     * Filter the query by a related \entities\PrescriberTallySummary object
     *
     * @param \entities\PrescriberTallySummary|ObjectCollection $prescriberTallySummary the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberTallySummary($prescriberTallySummary, ?string $comparison = null)
    {
        if ($prescriberTallySummary instanceof \entities\PrescriberTallySummary) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $prescriberTallySummary->getPositionId(), $comparison);

            return $this;
        } elseif ($prescriberTallySummary instanceof ObjectCollection) {
            $this
                ->usePrescriberTallySummaryQuery()
                ->filterByPrimaryKeys($prescriberTallySummary->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPrescriberTallySummary() only accepts arguments of type \entities\PrescriberTallySummary or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PrescriberTallySummary relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPrescriberTallySummary(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PrescriberTallySummary');

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
            $this->addJoinObject($join, 'PrescriberTallySummary');
        }

        return $this;
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PrescriberTallySummaryQuery A secondary query class using the current class as primary query
     */
    public function usePrescriberTallySummaryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrescriberTallySummary($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PrescriberTallySummary', '\entities\PrescriberTallySummaryQuery');
    }

    /**
     * Use the PrescriberTallySummary relation PrescriberTallySummary object
     *
     * @param callable(\entities\PrescriberTallySummaryQuery):\entities\PrescriberTallySummaryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrescriberTallySummaryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrescriberTallySummaryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the EXISTS statement
     */
    public function usePrescriberTallySummaryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT EXISTS query.
     *
     * @see usePrescriberTallySummaryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrescriberTallySummaryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useExistsQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the IN statement
     */
    public function useInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PrescriberTallySummary table for a NOT IN query.
     *
     * @see usePrescriberTallySummaryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PrescriberTallySummaryQuery The inner query object of the NOT IN statement
     */
    public function useNotInPrescriberTallySummaryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PrescriberTallySummaryQuery */
        $q = $this->useInQuery('PrescriberTallySummary', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Territories object
     *
     * @param \entities\Territories|ObjectCollection $territories the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritories($territories, ?string $comparison = null)
    {
        if ($territories instanceof \entities\Territories) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $territories->getPositionId(), $comparison);

            return $this;
        } elseif ($territories instanceof ObjectCollection) {
            $this
                ->useTerritoriesQuery()
                ->filterByPrimaryKeys($territories->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTerritories() only accepts arguments of type \entities\Territories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Territories relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Territories');

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
            $this->addJoinObject($join, 'Territories');
        }

        return $this;
    }

    /**
     * Use the Territories relation Territories object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TerritoriesQuery A secondary query class using the current class as primary query
     */
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTerritories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Territories', '\entities\TerritoriesQuery');
    }

    /**
     * Use the Territories relation Territories object
     *
     * @param callable(\entities\TerritoriesQuery):\entities\TerritoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTerritoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTerritoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Territories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TerritoriesQuery The inner query object of the EXISTS statement
     */
    public function useTerritoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT EXISTS query.
     *
     * @see useTerritoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useTerritoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useExistsQuery('Territories', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Territories table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TerritoriesQuery The inner query object of the IN statement
     */
    public function useInTerritoriesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Territories table for a NOT IN query.
     *
     * @see useTerritoriesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoriesQuery The inner query object of the NOT IN statement
     */
    public function useNotInTerritoriesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoriesQuery */
        $q = $this->useInQuery('Territories', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $tourplans->getPositionId(), $comparison);

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
     * Filter the query by a related \entities\Stp object
     *
     * @param \entities\Stp|ObjectCollection $stp the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStp($stp, ?string $comparison = null)
    {
        if ($stp instanceof \entities\Stp) {
            $this
                ->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $stp->getPositionId(), $comparison);

            return $this;
        } elseif ($stp instanceof ObjectCollection) {
            $this
                ->useStpQuery()
                ->filterByPrimaryKeys($stp->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStp() only accepts arguments of type \entities\Stp or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Stp relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStp(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Stp');

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
            $this->addJoinObject($join, 'Stp');
        }

        return $this;
    }

    /**
     * Use the Stp relation Stp object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StpQuery A secondary query class using the current class as primary query
     */
    public function useStpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Stp', '\entities\StpQuery');
    }

    /**
     * Use the Stp relation Stp object
     *
     * @param callable(\entities\StpQuery):\entities\StpQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStpQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStpQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Stp table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StpQuery The inner query object of the EXISTS statement
     */
    public function useStpExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useExistsQuery('Stp', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Stp table for a NOT EXISTS query.
     *
     * @see useStpExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StpQuery The inner query object of the NOT EXISTS statement
     */
    public function useStpNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useExistsQuery('Stp', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Stp table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StpQuery The inner query object of the IN statement
     */
    public function useInStpQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useInQuery('Stp', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Stp table for a NOT IN query.
     *
     * @see useStpInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StpQuery The inner query object of the NOT IN statement
     */
    public function useNotInStpQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpQuery */
        $q = $this->useInQuery('Stp', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPositions $positions Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($positions = null)
    {
        if ($positions) {
            $this->addUsingAlias(PositionsTableMap::COL_POSITION_ID, $positions->getPositionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the positions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionsTableMap::clearInstancePool();
            PositionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

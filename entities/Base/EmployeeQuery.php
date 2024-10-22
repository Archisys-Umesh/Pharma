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
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Map\EmployeeTableMap;

/**
 * Base class that represents a query for the `employee` table.
 *
 * @method     ChildEmployeeQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildEmployeeQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildEmployeeQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildEmployeeQuery orderByReportingTo($order = Criteria::ASC) Order by the reporting_to column
 * @method     ChildEmployeeQuery orderByDesignationId($order = Criteria::ASC) Order by the designation_id column
 * @method     ChildEmployeeQuery orderByBranchId($order = Criteria::ASC) Order by the branch_id column
 * @method     ChildEmployeeQuery orderByGradeId($order = Criteria::ASC) Order by the grade_id column
 * @method     ChildEmployeeQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildEmployeeQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildEmployeeQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildEmployeeQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildEmployeeQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildEmployeeQuery orderByIpAddress($order = Criteria::ASC) Order by the ip_address column
 * @method     ChildEmployeeQuery orderByProfilePicture($order = Criteria::ASC) Order by the profile_picture column
 * @method     ChildEmployeeQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildEmployeeQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildEmployeeQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildEmployeeQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildEmployeeQuery orderByCostnumber($order = Criteria::ASC) Order by the costnumber column
 * @method     ChildEmployeeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEmployeeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildEmployeeQuery orderByBaseMtarget($order = Criteria::ASC) Order by the base_mtarget column
 * @method     ChildEmployeeQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 * @method     ChildEmployeeQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildEmployeeQuery orderByIslocked($order = Criteria::ASC) Order by the islocked column
 * @method     ChildEmployeeQuery orderByLockedreason($order = Criteria::ASC) Order by the lockedreason column
 * @method     ChildEmployeeQuery orderByLockeddate($order = Criteria::ASC) Order by the lockeddate column
 * @method     ChildEmployeeQuery orderByIseodcheckenabled($order = Criteria::ASC) Order by the iseodcheckenabled column
 * @method     ChildEmployeeQuery orderByEmployeeMedia($order = Criteria::ASC) Order by the employee_media column
 * @method     ChildEmployeeQuery orderByResiAddress($order = Criteria::ASC) Order by the resi_address column
 * @method     ChildEmployeeQuery orderByCanFullSync($order = Criteria::ASC) Order by the can_full_sync column
 * @method     ChildEmployeeQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildEmployeeQuery orderByEmployeeSpokenLanguage($order = Criteria::ASC) Order by the employee_spoken_language column
 * @method     ChildEmployeeQuery orderByLastUpdatedByUserId($order = Criteria::ASC) Order by the last_updated_by_user_id column
 *
 * @method     ChildEmployeeQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildEmployeeQuery groupByCompanyId() Group by the company_id column
 * @method     ChildEmployeeQuery groupByPositionId() Group by the position_id column
 * @method     ChildEmployeeQuery groupByReportingTo() Group by the reporting_to column
 * @method     ChildEmployeeQuery groupByDesignationId() Group by the designation_id column
 * @method     ChildEmployeeQuery groupByBranchId() Group by the branch_id column
 * @method     ChildEmployeeQuery groupByGradeId() Group by the grade_id column
 * @method     ChildEmployeeQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildEmployeeQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildEmployeeQuery groupByFirstName() Group by the first_name column
 * @method     ChildEmployeeQuery groupByLastName() Group by the last_name column
 * @method     ChildEmployeeQuery groupByStatus() Group by the status column
 * @method     ChildEmployeeQuery groupByIpAddress() Group by the ip_address column
 * @method     ChildEmployeeQuery groupByProfilePicture() Group by the profile_picture column
 * @method     ChildEmployeeQuery groupByEmail() Group by the email column
 * @method     ChildEmployeeQuery groupByLastLogin() Group by the last_login column
 * @method     ChildEmployeeQuery groupByPhone() Group by the phone column
 * @method     ChildEmployeeQuery groupByAddress() Group by the address column
 * @method     ChildEmployeeQuery groupByCostnumber() Group by the costnumber column
 * @method     ChildEmployeeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEmployeeQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildEmployeeQuery groupByBaseMtarget() Group by the base_mtarget column
 * @method     ChildEmployeeQuery groupByIntegrationId() Group by the integration_id column
 * @method     ChildEmployeeQuery groupByItownid() Group by the itownid column
 * @method     ChildEmployeeQuery groupByIslocked() Group by the islocked column
 * @method     ChildEmployeeQuery groupByLockedreason() Group by the lockedreason column
 * @method     ChildEmployeeQuery groupByLockeddate() Group by the lockeddate column
 * @method     ChildEmployeeQuery groupByIseodcheckenabled() Group by the iseodcheckenabled column
 * @method     ChildEmployeeQuery groupByEmployeeMedia() Group by the employee_media column
 * @method     ChildEmployeeQuery groupByResiAddress() Group by the resi_address column
 * @method     ChildEmployeeQuery groupByCanFullSync() Group by the can_full_sync column
 * @method     ChildEmployeeQuery groupByRemark() Group by the remark column
 * @method     ChildEmployeeQuery groupByEmployeeSpokenLanguage() Group by the employee_spoken_language column
 * @method     ChildEmployeeQuery groupByLastUpdatedByUserId() Group by the last_updated_by_user_id column
 *
 * @method     ChildEmployeeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmployeeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmployeeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmployeeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmployeeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmployeeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmployeeQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     ChildEmployeeQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     ChildEmployeeQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     ChildEmployeeQuery joinWithBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Branch relation
 *
 * @method     ChildEmployeeQuery leftJoinWithBranch() Adds a LEFT JOIN clause and with to the query using the Branch relation
 * @method     ChildEmployeeQuery rightJoinWithBranch() Adds a RIGHT JOIN clause and with to the query using the Branch relation
 * @method     ChildEmployeeQuery innerJoinWithBranch() Adds a INNER JOIN clause and with to the query using the Branch relation
 *
 * @method     ChildEmployeeQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildEmployeeQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildEmployeeQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildEmployeeQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildEmployeeQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildEmployeeQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildEmployeeQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildEmployeeQuery leftJoinDesignations($relationAlias = null) Adds a LEFT JOIN clause to the query using the Designations relation
 * @method     ChildEmployeeQuery rightJoinDesignations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Designations relation
 * @method     ChildEmployeeQuery innerJoinDesignations($relationAlias = null) Adds a INNER JOIN clause to the query using the Designations relation
 *
 * @method     ChildEmployeeQuery joinWithDesignations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Designations relation
 *
 * @method     ChildEmployeeQuery leftJoinWithDesignations() Adds a LEFT JOIN clause and with to the query using the Designations relation
 * @method     ChildEmployeeQuery rightJoinWithDesignations() Adds a RIGHT JOIN clause and with to the query using the Designations relation
 * @method     ChildEmployeeQuery innerJoinWithDesignations() Adds a INNER JOIN clause and with to the query using the Designations relation
 *
 * @method     ChildEmployeeQuery leftJoinGradeMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradeMaster relation
 * @method     ChildEmployeeQuery rightJoinGradeMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradeMaster relation
 * @method     ChildEmployeeQuery innerJoinGradeMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the GradeMaster relation
 *
 * @method     ChildEmployeeQuery joinWithGradeMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradeMaster relation
 *
 * @method     ChildEmployeeQuery leftJoinWithGradeMaster() Adds a LEFT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildEmployeeQuery rightJoinWithGradeMaster() Adds a RIGHT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildEmployeeQuery innerJoinWithGradeMaster() Adds a INNER JOIN clause and with to the query using the GradeMaster relation
 *
 * @method     ChildEmployeeQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEmployeeQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildEmployeeQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildEmployeeQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEmployeeQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildEmployeeQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildEmployeeQuery leftJoinPositionsRelatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByPositionId relation
 * @method     ChildEmployeeQuery rightJoinPositionsRelatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByPositionId relation
 * @method     ChildEmployeeQuery innerJoinPositionsRelatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByPositionId relation
 *
 * @method     ChildEmployeeQuery joinWithPositionsRelatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByPositionId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithPositionsRelatedByPositionId() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByPositionId relation
 * @method     ChildEmployeeQuery rightJoinWithPositionsRelatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByPositionId relation
 * @method     ChildEmployeeQuery innerJoinWithPositionsRelatedByPositionId() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByPositionId relation
 *
 * @method     ChildEmployeeQuery leftJoinPositionsRelatedByReportingTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByReportingTo relation
 * @method     ChildEmployeeQuery rightJoinPositionsRelatedByReportingTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByReportingTo relation
 * @method     ChildEmployeeQuery innerJoinPositionsRelatedByReportingTo($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByReportingTo relation
 *
 * @method     ChildEmployeeQuery joinWithPositionsRelatedByReportingTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByReportingTo relation
 *
 * @method     ChildEmployeeQuery leftJoinWithPositionsRelatedByReportingTo() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByReportingTo relation
 * @method     ChildEmployeeQuery rightJoinWithPositionsRelatedByReportingTo() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByReportingTo relation
 * @method     ChildEmployeeQuery innerJoinWithPositionsRelatedByReportingTo() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByReportingTo relation
 *
 * @method     ChildEmployeeQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildEmployeeQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildEmployeeQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildEmployeeQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildEmployeeQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildEmployeeQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildEmployeeQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildEmployeeQuery leftJoinAnnouncementEmployeeMap($relationAlias = null) Adds a LEFT JOIN clause to the query using the AnnouncementEmployeeMap relation
 * @method     ChildEmployeeQuery rightJoinAnnouncementEmployeeMap($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AnnouncementEmployeeMap relation
 * @method     ChildEmployeeQuery innerJoinAnnouncementEmployeeMap($relationAlias = null) Adds a INNER JOIN clause to the query using the AnnouncementEmployeeMap relation
 *
 * @method     ChildEmployeeQuery joinWithAnnouncementEmployeeMap($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AnnouncementEmployeeMap relation
 *
 * @method     ChildEmployeeQuery leftJoinWithAnnouncementEmployeeMap() Adds a LEFT JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 * @method     ChildEmployeeQuery rightJoinWithAnnouncementEmployeeMap() Adds a RIGHT JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 * @method     ChildEmployeeQuery innerJoinWithAnnouncementEmployeeMap() Adds a INNER JOIN clause and with to the query using the AnnouncementEmployeeMap relation
 *
 * @method     ChildEmployeeQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildEmployeeQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildEmployeeQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildEmployeeQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildEmployeeQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildEmployeeQuery leftJoinAuditEmpUnits($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuditEmpUnits relation
 * @method     ChildEmployeeQuery rightJoinAuditEmpUnits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuditEmpUnits relation
 * @method     ChildEmployeeQuery innerJoinAuditEmpUnits($relationAlias = null) Adds a INNER JOIN clause to the query using the AuditEmpUnits relation
 *
 * @method     ChildEmployeeQuery joinWithAuditEmpUnits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AuditEmpUnits relation
 *
 * @method     ChildEmployeeQuery leftJoinWithAuditEmpUnits() Adds a LEFT JOIN clause and with to the query using the AuditEmpUnits relation
 * @method     ChildEmployeeQuery rightJoinWithAuditEmpUnits() Adds a RIGHT JOIN clause and with to the query using the AuditEmpUnits relation
 * @method     ChildEmployeeQuery innerJoinWithAuditEmpUnits() Adds a INNER JOIN clause and with to the query using the AuditEmpUnits relation
 *
 * @method     ChildEmployeeQuery leftJoinBrandRcpa($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildEmployeeQuery rightJoinBrandRcpa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildEmployeeQuery innerJoinBrandRcpa($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandRcpa relation
 *
 * @method     ChildEmployeeQuery joinWithBrandRcpa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildEmployeeQuery leftJoinWithBrandRcpa() Adds a LEFT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildEmployeeQuery rightJoinWithBrandRcpa() Adds a RIGHT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildEmployeeQuery innerJoinWithBrandRcpa() Adds a INNER JOIN clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildEmployeeQuery leftJoinCompetitionMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildEmployeeQuery rightJoinCompetitionMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildEmployeeQuery innerJoinCompetitionMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the CompetitionMapping relation
 *
 * @method     ChildEmployeeQuery joinWithCompetitionMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildEmployeeQuery leftJoinWithCompetitionMapping() Adds a LEFT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildEmployeeQuery rightJoinWithCompetitionMapping() Adds a RIGHT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildEmployeeQuery innerJoinWithCompetitionMapping() Adds a INNER JOIN clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildEmployeeQuery leftJoinDailycallsSgpiout($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildEmployeeQuery rightJoinDailycallsSgpiout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildEmployeeQuery innerJoinDailycallsSgpiout($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsSgpiout relation
 *
 * @method     ChildEmployeeQuery joinWithDailycallsSgpiout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildEmployeeQuery leftJoinWithDailycallsSgpiout() Adds a LEFT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildEmployeeQuery rightJoinWithDailycallsSgpiout() Adds a RIGHT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildEmployeeQuery innerJoinWithDailycallsSgpiout() Adds a INNER JOIN clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildEmployeeQuery leftJoinEdSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdSession relation
 * @method     ChildEmployeeQuery rightJoinEdSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdSession relation
 * @method     ChildEmployeeQuery innerJoinEdSession($relationAlias = null) Adds a INNER JOIN clause to the query using the EdSession relation
 *
 * @method     ChildEmployeeQuery joinWithEdSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdSession relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEdSession() Adds a LEFT JOIN clause and with to the query using the EdSession relation
 * @method     ChildEmployeeQuery rightJoinWithEdSession() Adds a RIGHT JOIN clause and with to the query using the EdSession relation
 * @method     ChildEmployeeQuery innerJoinWithEdSession() Adds a INNER JOIN clause and with to the query using the EdSession relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeeIncentive($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeIncentive relation
 * @method     ChildEmployeeQuery rightJoinEmployeeIncentive($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeIncentive relation
 * @method     ChildEmployeeQuery innerJoinEmployeeIncentive($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeIncentive relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeeIncentive($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeIncentive relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeeIncentive() Adds a LEFT JOIN clause and with to the query using the EmployeeIncentive relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeeIncentive() Adds a RIGHT JOIN clause and with to the query using the EmployeeIncentive relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeeIncentive() Adds a INNER JOIN clause and with to the query using the EmployeeIncentive relation
 *
 * @method     ChildEmployeeQuery leftJoinEmployeePositionHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeePositionHistory relation
 * @method     ChildEmployeeQuery rightJoinEmployeePositionHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeePositionHistory relation
 * @method     ChildEmployeeQuery innerJoinEmployeePositionHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeePositionHistory relation
 *
 * @method     ChildEmployeeQuery joinWithEmployeePositionHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeePositionHistory relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEmployeePositionHistory() Adds a LEFT JOIN clause and with to the query using the EmployeePositionHistory relation
 * @method     ChildEmployeeQuery rightJoinWithEmployeePositionHistory() Adds a RIGHT JOIN clause and with to the query using the EmployeePositionHistory relation
 * @method     ChildEmployeeQuery innerJoinWithEmployeePositionHistory() Adds a INNER JOIN clause and with to the query using the EmployeePositionHistory relation
 *
 * @method     ChildEmployeeQuery leftJoinEventsRelatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinEventsRelatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinEventsRelatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EventsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithEventsRelatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEventsRelatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EventsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithEventsRelatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EventsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithEventsRelatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EventsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinEventsRelatedByApproverEmpId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventsRelatedByApproverEmpId relation
 * @method     ChildEmployeeQuery rightJoinEventsRelatedByApproverEmpId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventsRelatedByApproverEmpId relation
 * @method     ChildEmployeeQuery innerJoinEventsRelatedByApproverEmpId($relationAlias = null) Adds a INNER JOIN clause to the query using the EventsRelatedByApproverEmpId relation
 *
 * @method     ChildEmployeeQuery joinWithEventsRelatedByApproverEmpId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventsRelatedByApproverEmpId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithEventsRelatedByApproverEmpId() Adds a LEFT JOIN clause and with to the query using the EventsRelatedByApproverEmpId relation
 * @method     ChildEmployeeQuery rightJoinWithEventsRelatedByApproverEmpId() Adds a RIGHT JOIN clause and with to the query using the EventsRelatedByApproverEmpId relation
 * @method     ChildEmployeeQuery innerJoinWithEventsRelatedByApproverEmpId() Adds a INNER JOIN clause and with to the query using the EventsRelatedByApproverEmpId relation
 *
 * @method     ChildEmployeeQuery leftJoinExpensePayments($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpensePayments relation
 * @method     ChildEmployeeQuery rightJoinExpensePayments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpensePayments relation
 * @method     ChildEmployeeQuery innerJoinExpensePayments($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpensePayments relation
 *
 * @method     ChildEmployeeQuery joinWithExpensePayments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpensePayments relation
 *
 * @method     ChildEmployeeQuery leftJoinWithExpensePayments() Adds a LEFT JOIN clause and with to the query using the ExpensePayments relation
 * @method     ChildEmployeeQuery rightJoinWithExpensePayments() Adds a RIGHT JOIN clause and with to the query using the ExpensePayments relation
 * @method     ChildEmployeeQuery innerJoinWithExpensePayments() Adds a INNER JOIN clause and with to the query using the ExpensePayments relation
 *
 * @method     ChildEmployeeQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildEmployeeQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildEmployeeQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildEmployeeQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildEmployeeQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildEmployeeQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildEmployeeQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserAccount relation
 * @method     ChildEmployeeQuery rightJoinHrUserAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserAccount relation
 * @method     ChildEmployeeQuery innerJoinHrUserAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserAccount relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserAccount relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserAccount() Adds a LEFT JOIN clause and with to the query using the HrUserAccount relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserAccount() Adds a RIGHT JOIN clause and with to the query using the HrUserAccount relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserAccount() Adds a INNER JOIN clause and with to the query using the HrUserAccount relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserDates($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserDates relation
 * @method     ChildEmployeeQuery rightJoinHrUserDates($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserDates relation
 * @method     ChildEmployeeQuery innerJoinHrUserDates($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserDates relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserDates($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserDates relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserDates() Adds a LEFT JOIN clause and with to the query using the HrUserDates relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserDates() Adds a RIGHT JOIN clause and with to the query using the HrUserDates relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserDates() Adds a INNER JOIN clause and with to the query using the HrUserDates relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserDocuments($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserDocuments relation
 * @method     ChildEmployeeQuery rightJoinHrUserDocuments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserDocuments relation
 * @method     ChildEmployeeQuery innerJoinHrUserDocuments($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserDocuments relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserDocuments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserDocuments relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserDocuments() Adds a LEFT JOIN clause and with to the query using the HrUserDocuments relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserDocuments() Adds a RIGHT JOIN clause and with to the query using the HrUserDocuments relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserDocuments() Adds a INNER JOIN clause and with to the query using the HrUserDocuments relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserExperiences($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserExperiences relation
 * @method     ChildEmployeeQuery rightJoinHrUserExperiences($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserExperiences relation
 * @method     ChildEmployeeQuery innerJoinHrUserExperiences($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserExperiences relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserExperiences($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserExperiences relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserExperiences() Adds a LEFT JOIN clause and with to the query using the HrUserExperiences relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserExperiences() Adds a RIGHT JOIN clause and with to the query using the HrUserExperiences relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserExperiences() Adds a INNER JOIN clause and with to the query using the HrUserExperiences relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserQualification($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserQualification relation
 * @method     ChildEmployeeQuery rightJoinHrUserQualification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserQualification relation
 * @method     ChildEmployeeQuery innerJoinHrUserQualification($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserQualification relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserQualification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserQualification relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserQualification() Adds a LEFT JOIN clause and with to the query using the HrUserQualification relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserQualification() Adds a RIGHT JOIN clause and with to the query using the HrUserQualification relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserQualification() Adds a INNER JOIN clause and with to the query using the HrUserQualification relation
 *
 * @method     ChildEmployeeQuery leftJoinHrUserReferences($relationAlias = null) Adds a LEFT JOIN clause to the query using the HrUserReferences relation
 * @method     ChildEmployeeQuery rightJoinHrUserReferences($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HrUserReferences relation
 * @method     ChildEmployeeQuery innerJoinHrUserReferences($relationAlias = null) Adds a INNER JOIN clause to the query using the HrUserReferences relation
 *
 * @method     ChildEmployeeQuery joinWithHrUserReferences($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HrUserReferences relation
 *
 * @method     ChildEmployeeQuery leftJoinWithHrUserReferences() Adds a LEFT JOIN clause and with to the query using the HrUserReferences relation
 * @method     ChildEmployeeQuery rightJoinWithHrUserReferences() Adds a RIGHT JOIN clause and with to the query using the HrUserReferences relation
 * @method     ChildEmployeeQuery innerJoinWithHrUserReferences() Adds a INNER JOIN clause and with to the query using the HrUserReferences relation
 *
 * @method     ChildEmployeeQuery leftJoinLeaveRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeaveRequest relation
 * @method     ChildEmployeeQuery rightJoinLeaveRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeaveRequest relation
 * @method     ChildEmployeeQuery innerJoinLeaveRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the LeaveRequest relation
 *
 * @method     ChildEmployeeQuery joinWithLeaveRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LeaveRequest relation
 *
 * @method     ChildEmployeeQuery leftJoinWithLeaveRequest() Adds a LEFT JOIN clause and with to the query using the LeaveRequest relation
 * @method     ChildEmployeeQuery rightJoinWithLeaveRequest() Adds a RIGHT JOIN clause and with to the query using the LeaveRequest relation
 * @method     ChildEmployeeQuery innerJoinWithLeaveRequest() Adds a INNER JOIN clause and with to the query using the LeaveRequest relation
 *
 * @method     ChildEmployeeQuery leftJoinLeaves($relationAlias = null) Adds a LEFT JOIN clause to the query using the Leaves relation
 * @method     ChildEmployeeQuery rightJoinLeaves($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Leaves relation
 * @method     ChildEmployeeQuery innerJoinLeaves($relationAlias = null) Adds a INNER JOIN clause to the query using the Leaves relation
 *
 * @method     ChildEmployeeQuery joinWithLeaves($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Leaves relation
 *
 * @method     ChildEmployeeQuery leftJoinWithLeaves() Adds a LEFT JOIN clause and with to the query using the Leaves relation
 * @method     ChildEmployeeQuery rightJoinWithLeaves() Adds a RIGHT JOIN clause and with to the query using the Leaves relation
 * @method     ChildEmployeeQuery innerJoinWithLeaves() Adds a INNER JOIN clause and with to the query using the Leaves relation
 *
 * @method     ChildEmployeeQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildEmployeeQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildEmployeeQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildEmployeeQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildEmployeeQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildEmployeeQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildEmployeeQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     ChildEmployeeQuery leftJoinOnBoardRequestRelatedByApprovedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinOnBoardRequestRelatedByApprovedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinOnBoardRequestRelatedByApprovedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithOnBoardRequestRelatedByApprovedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOnBoardRequestRelatedByApprovedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithOnBoardRequestRelatedByApprovedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithOnBoardRequestRelatedByApprovedByEmployeeId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinOnBoardRequestRelatedByCreatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinOnBoardRequestRelatedByCreatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinOnBoardRequestRelatedByCreatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithOnBoardRequestRelatedByCreatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOnBoardRequestRelatedByCreatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithOnBoardRequestRelatedByCreatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithOnBoardRequestRelatedByCreatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinOnBoardRequestRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinOnBoardRequestRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinOnBoardRequestRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithOnBoardRequestRelatedByFinalApprovedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOnBoardRequestRelatedByFinalApprovedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithOnBoardRequestRelatedByFinalApprovedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithOnBoardRequestRelatedByFinalApprovedByEmployeeId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinOnBoardRequestRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinOnBoardRequestRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinOnBoardRequestRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithOnBoardRequestRelatedByUpdatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOnBoardRequestRelatedByUpdatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithOnBoardRequestRelatedByUpdatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithOnBoardRequestRelatedByUpdatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinOnBoardRequestLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildEmployeeQuery rightJoinOnBoardRequestLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildEmployeeQuery innerJoinOnBoardRequestLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestLog relation
 *
 * @method     ChildEmployeeQuery joinWithOnBoardRequestLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOnBoardRequestLog() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildEmployeeQuery rightJoinWithOnBoardRequestLog() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildEmployeeQuery innerJoinWithOnBoardRequestLog() Adds a INNER JOIN clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildEmployeeQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildEmployeeQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildEmployeeQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildEmployeeQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildEmployeeQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildEmployeeQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildEmployeeQuery leftJoinOtpRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the OtpRequests relation
 * @method     ChildEmployeeQuery rightJoinOtpRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OtpRequests relation
 * @method     ChildEmployeeQuery innerJoinOtpRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the OtpRequests relation
 *
 * @method     ChildEmployeeQuery joinWithOtpRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OtpRequests relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOtpRequests() Adds a LEFT JOIN clause and with to the query using the OtpRequests relation
 * @method     ChildEmployeeQuery rightJoinWithOtpRequests() Adds a RIGHT JOIN clause and with to the query using the OtpRequests relation
 * @method     ChildEmployeeQuery innerJoinWithOtpRequests() Adds a INNER JOIN clause and with to the query using the OtpRequests relation
 *
 * @method     ChildEmployeeQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildEmployeeQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildEmployeeQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildEmployeeQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildEmployeeQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildEmployeeQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildEmployeeQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildEmployeeQuery leftJoinReminders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reminders relation
 * @method     ChildEmployeeQuery rightJoinReminders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reminders relation
 * @method     ChildEmployeeQuery innerJoinReminders($relationAlias = null) Adds a INNER JOIN clause to the query using the Reminders relation
 *
 * @method     ChildEmployeeQuery joinWithReminders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reminders relation
 *
 * @method     ChildEmployeeQuery leftJoinWithReminders() Adds a LEFT JOIN clause and with to the query using the Reminders relation
 * @method     ChildEmployeeQuery rightJoinWithReminders() Adds a RIGHT JOIN clause and with to the query using the Reminders relation
 * @method     ChildEmployeeQuery innerJoinWithReminders() Adds a INNER JOIN clause and with to the query using the Reminders relation
 *
 * @method     ChildEmployeeQuery leftJoinSalaryAttendanceBackdateTrackLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalaryAttendanceBackdateTrackLog relation
 * @method     ChildEmployeeQuery rightJoinSalaryAttendanceBackdateTrackLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalaryAttendanceBackdateTrackLog relation
 * @method     ChildEmployeeQuery innerJoinSalaryAttendanceBackdateTrackLog($relationAlias = null) Adds a INNER JOIN clause to the query using the SalaryAttendanceBackdateTrackLog relation
 *
 * @method     ChildEmployeeQuery joinWithSalaryAttendanceBackdateTrackLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalaryAttendanceBackdateTrackLog relation
 *
 * @method     ChildEmployeeQuery leftJoinWithSalaryAttendanceBackdateTrackLog() Adds a LEFT JOIN clause and with to the query using the SalaryAttendanceBackdateTrackLog relation
 * @method     ChildEmployeeQuery rightJoinWithSalaryAttendanceBackdateTrackLog() Adds a RIGHT JOIN clause and with to the query using the SalaryAttendanceBackdateTrackLog relation
 * @method     ChildEmployeeQuery innerJoinWithSalaryAttendanceBackdateTrackLog() Adds a INNER JOIN clause and with to the query using the SalaryAttendanceBackdateTrackLog relation
 *
 * @method     ChildEmployeeQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildEmployeeQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildEmployeeQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildEmployeeQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildEmployeeQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildEmployeeQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildEmployeeQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildEmployeeQuery leftJoinTicketReplies($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketReplies relation
 * @method     ChildEmployeeQuery rightJoinTicketReplies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketReplies relation
 * @method     ChildEmployeeQuery innerJoinTicketReplies($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketReplies relation
 *
 * @method     ChildEmployeeQuery joinWithTicketReplies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketReplies relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTicketReplies() Adds a LEFT JOIN clause and with to the query using the TicketReplies relation
 * @method     ChildEmployeeQuery rightJoinWithTicketReplies() Adds a RIGHT JOIN clause and with to the query using the TicketReplies relation
 * @method     ChildEmployeeQuery innerJoinWithTicketReplies() Adds a INNER JOIN clause and with to the query using the TicketReplies relation
 *
 * @method     ChildEmployeeQuery leftJoinTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketType relation
 * @method     ChildEmployeeQuery rightJoinTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketType relation
 * @method     ChildEmployeeQuery innerJoinTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketType relation
 *
 * @method     ChildEmployeeQuery joinWithTicketType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketType relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTicketType() Adds a LEFT JOIN clause and with to the query using the TicketType relation
 * @method     ChildEmployeeQuery rightJoinWithTicketType() Adds a RIGHT JOIN clause and with to the query using the TicketType relation
 * @method     ChildEmployeeQuery innerJoinWithTicketType() Adds a INNER JOIN clause and with to the query using the TicketType relation
 *
 * @method     ChildEmployeeQuery leftJoinTicketsRelatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinTicketsRelatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinTicketsRelatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithTicketsRelatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTicketsRelatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the TicketsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithTicketsRelatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the TicketsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithTicketsRelatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the TicketsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinTicketsRelatedByAllocatedTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketsRelatedByAllocatedTo relation
 * @method     ChildEmployeeQuery rightJoinTicketsRelatedByAllocatedTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketsRelatedByAllocatedTo relation
 * @method     ChildEmployeeQuery innerJoinTicketsRelatedByAllocatedTo($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketsRelatedByAllocatedTo relation
 *
 * @method     ChildEmployeeQuery joinWithTicketsRelatedByAllocatedTo($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketsRelatedByAllocatedTo relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTicketsRelatedByAllocatedTo() Adds a LEFT JOIN clause and with to the query using the TicketsRelatedByAllocatedTo relation
 * @method     ChildEmployeeQuery rightJoinWithTicketsRelatedByAllocatedTo() Adds a RIGHT JOIN clause and with to the query using the TicketsRelatedByAllocatedTo relation
 * @method     ChildEmployeeQuery innerJoinWithTicketsRelatedByAllocatedTo() Adds a INNER JOIN clause and with to the query using the TicketsRelatedByAllocatedTo relation
 *
 * @method     ChildEmployeeQuery leftJoinTransactionsRelatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinTransactionsRelatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinTransactionsRelatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery joinWithTransactionsRelatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTransactionsRelatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the TransactionsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery rightJoinWithTransactionsRelatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the TransactionsRelatedByEmployeeId relation
 * @method     ChildEmployeeQuery innerJoinWithTransactionsRelatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the TransactionsRelatedByEmployeeId relation
 *
 * @method     ChildEmployeeQuery leftJoinTransactionsRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the TransactionsRelatedByCreatedBy relation
 * @method     ChildEmployeeQuery rightJoinTransactionsRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TransactionsRelatedByCreatedBy relation
 * @method     ChildEmployeeQuery innerJoinTransactionsRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the TransactionsRelatedByCreatedBy relation
 *
 * @method     ChildEmployeeQuery joinWithTransactionsRelatedByCreatedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TransactionsRelatedByCreatedBy relation
 *
 * @method     ChildEmployeeQuery leftJoinWithTransactionsRelatedByCreatedBy() Adds a LEFT JOIN clause and with to the query using the TransactionsRelatedByCreatedBy relation
 * @method     ChildEmployeeQuery rightJoinWithTransactionsRelatedByCreatedBy() Adds a RIGHT JOIN clause and with to the query using the TransactionsRelatedByCreatedBy relation
 * @method     ChildEmployeeQuery innerJoinWithTransactionsRelatedByCreatedBy() Adds a INNER JOIN clause and with to the query using the TransactionsRelatedByCreatedBy relation
 *
 * @method     ChildEmployeeQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildEmployeeQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildEmployeeQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildEmployeeQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildEmployeeQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildEmployeeQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildEmployeeQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildEmployeeQuery leftJoinWfLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfLog relation
 * @method     ChildEmployeeQuery rightJoinWfLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfLog relation
 * @method     ChildEmployeeQuery innerJoinWfLog($relationAlias = null) Adds a INNER JOIN clause to the query using the WfLog relation
 *
 * @method     ChildEmployeeQuery joinWithWfLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfLog relation
 *
 * @method     ChildEmployeeQuery leftJoinWithWfLog() Adds a LEFT JOIN clause and with to the query using the WfLog relation
 * @method     ChildEmployeeQuery rightJoinWithWfLog() Adds a RIGHT JOIN clause and with to the query using the WfLog relation
 * @method     ChildEmployeeQuery innerJoinWithWfLog() Adds a INNER JOIN clause and with to the query using the WfLog relation
 *
 * @method     ChildEmployeeQuery leftJoinWfRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfRequests relation
 * @method     ChildEmployeeQuery rightJoinWfRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfRequests relation
 * @method     ChildEmployeeQuery innerJoinWfRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the WfRequests relation
 *
 * @method     ChildEmployeeQuery joinWithWfRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfRequests relation
 *
 * @method     ChildEmployeeQuery leftJoinWithWfRequests() Adds a LEFT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildEmployeeQuery rightJoinWithWfRequests() Adds a RIGHT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildEmployeeQuery innerJoinWithWfRequests() Adds a INNER JOIN clause and with to the query using the WfRequests relation
 *
 * @method     \entities\BranchQuery|\entities\CompanyQuery|\entities\DesignationsQuery|\entities\GradeMasterQuery|\entities\OrgUnitQuery|\entities\PositionsQuery|\entities\PositionsQuery|\entities\GeoTownsQuery|\entities\AnnouncementEmployeeMapQuery|\entities\AttendanceQuery|\entities\AuditEmpUnitsQuery|\entities\BrandRcpaQuery|\entities\CompetitionMappingQuery|\entities\DailycallsSgpioutQuery|\entities\EdSessionQuery|\entities\EmployeeIncentiveQuery|\entities\EmployeePositionHistoryQuery|\entities\EventsQuery|\entities\EventsQuery|\entities\ExpensePaymentsQuery|\entities\ExpensesQuery|\entities\HrUserAccountQuery|\entities\HrUserDatesQuery|\entities\HrUserDocumentsQuery|\entities\HrUserExperiencesQuery|\entities\HrUserQualificationQuery|\entities\HrUserReferencesQuery|\entities\LeaveRequestQuery|\entities\LeavesQuery|\entities\MtpQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestLogQuery|\entities\OrdersQuery|\entities\OtpRequestsQuery|\entities\OutletsQuery|\entities\RemindersQuery|\entities\SalaryAttendanceBackdateTrackLogQuery|\entities\SurveySubmitedQuery|\entities\TicketRepliesQuery|\entities\TicketTypeQuery|\entities\TicketsQuery|\entities\TicketsQuery|\entities\TransactionsQuery|\entities\TransactionsQuery|\entities\UsersQuery|\entities\WfLogQuery|\entities\WfRequestsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmployee|null findOne(?ConnectionInterface $con = null) Return the first ChildEmployee matching the query
 * @method     ChildEmployee findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildEmployee matching the query, or a new ChildEmployee object populated from the query conditions when no match is found
 *
 * @method     ChildEmployee|null findOneByEmployeeId(int $employee_id) Return the first ChildEmployee filtered by the employee_id column
 * @method     ChildEmployee|null findOneByCompanyId(int $company_id) Return the first ChildEmployee filtered by the company_id column
 * @method     ChildEmployee|null findOneByPositionId(int $position_id) Return the first ChildEmployee filtered by the position_id column
 * @method     ChildEmployee|null findOneByReportingTo(int $reporting_to) Return the first ChildEmployee filtered by the reporting_to column
 * @method     ChildEmployee|null findOneByDesignationId(int $designation_id) Return the first ChildEmployee filtered by the designation_id column
 * @method     ChildEmployee|null findOneByBranchId(int $branch_id) Return the first ChildEmployee filtered by the branch_id column
 * @method     ChildEmployee|null findOneByGradeId(int $grade_id) Return the first ChildEmployee filtered by the grade_id column
 * @method     ChildEmployee|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildEmployee filtered by the org_unit_id column
 * @method     ChildEmployee|null findOneByEmployeeCode(string $employee_code) Return the first ChildEmployee filtered by the employee_code column
 * @method     ChildEmployee|null findOneByFirstName(string $first_name) Return the first ChildEmployee filtered by the first_name column
 * @method     ChildEmployee|null findOneByLastName(string $last_name) Return the first ChildEmployee filtered by the last_name column
 * @method     ChildEmployee|null findOneByStatus(int $status) Return the first ChildEmployee filtered by the status column
 * @method     ChildEmployee|null findOneByIpAddress(string $ip_address) Return the first ChildEmployee filtered by the ip_address column
 * @method     ChildEmployee|null findOneByProfilePicture(string $profile_picture) Return the first ChildEmployee filtered by the profile_picture column
 * @method     ChildEmployee|null findOneByEmail(string $email) Return the first ChildEmployee filtered by the email column
 * @method     ChildEmployee|null findOneByLastLogin(int $last_login) Return the first ChildEmployee filtered by the last_login column
 * @method     ChildEmployee|null findOneByPhone(string $phone) Return the first ChildEmployee filtered by the phone column
 * @method     ChildEmployee|null findOneByAddress(string $address) Return the first ChildEmployee filtered by the address column
 * @method     ChildEmployee|null findOneByCostnumber(string $costnumber) Return the first ChildEmployee filtered by the costnumber column
 * @method     ChildEmployee|null findOneByCreatedAt(string $created_at) Return the first ChildEmployee filtered by the created_at column
 * @method     ChildEmployee|null findOneByUpdatedAt(string $updated_at) Return the first ChildEmployee filtered by the updated_at column
 * @method     ChildEmployee|null findOneByBaseMtarget(string $base_mtarget) Return the first ChildEmployee filtered by the base_mtarget column
 * @method     ChildEmployee|null findOneByIntegrationId(string $integration_id) Return the first ChildEmployee filtered by the integration_id column
 * @method     ChildEmployee|null findOneByItownid(int $itownid) Return the first ChildEmployee filtered by the itownid column
 * @method     ChildEmployee|null findOneByIslocked(boolean $islocked) Return the first ChildEmployee filtered by the islocked column
 * @method     ChildEmployee|null findOneByLockedreason(string $lockedreason) Return the first ChildEmployee filtered by the lockedreason column
 * @method     ChildEmployee|null findOneByLockeddate(string $lockeddate) Return the first ChildEmployee filtered by the lockeddate column
 * @method     ChildEmployee|null findOneByIseodcheckenabled(int $iseodcheckenabled) Return the first ChildEmployee filtered by the iseodcheckenabled column
 * @method     ChildEmployee|null findOneByEmployeeMedia(int $employee_media) Return the first ChildEmployee filtered by the employee_media column
 * @method     ChildEmployee|null findOneByResiAddress(string $resi_address) Return the first ChildEmployee filtered by the resi_address column
 * @method     ChildEmployee|null findOneByCanFullSync(boolean $can_full_sync) Return the first ChildEmployee filtered by the can_full_sync column
 * @method     ChildEmployee|null findOneByRemark(string $remark) Return the first ChildEmployee filtered by the remark column
 * @method     ChildEmployee|null findOneByEmployeeSpokenLanguage(string $employee_spoken_language) Return the first ChildEmployee filtered by the employee_spoken_language column
 * @method     ChildEmployee|null findOneByLastUpdatedByUserId(int $last_updated_by_user_id) Return the first ChildEmployee filtered by the last_updated_by_user_id column
 *
 * @method     ChildEmployee requirePk($key, ?ConnectionInterface $con = null) Return the ChildEmployee by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOne(?ConnectionInterface $con = null) Return the first ChildEmployee matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee requireOneByEmployeeId(int $employee_id) Return the first ChildEmployee filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByCompanyId(int $company_id) Return the first ChildEmployee filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPositionId(int $position_id) Return the first ChildEmployee filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByReportingTo(int $reporting_to) Return the first ChildEmployee filtered by the reporting_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByDesignationId(int $designation_id) Return the first ChildEmployee filtered by the designation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByBranchId(int $branch_id) Return the first ChildEmployee filtered by the branch_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByGradeId(int $grade_id) Return the first ChildEmployee filtered by the grade_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByOrgUnitId(int $org_unit_id) Return the first ChildEmployee filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEmployeeCode(string $employee_code) Return the first ChildEmployee filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByFirstName(string $first_name) Return the first ChildEmployee filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLastName(string $last_name) Return the first ChildEmployee filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByStatus(int $status) Return the first ChildEmployee filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByIpAddress(string $ip_address) Return the first ChildEmployee filtered by the ip_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByProfilePicture(string $profile_picture) Return the first ChildEmployee filtered by the profile_picture column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEmail(string $email) Return the first ChildEmployee filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLastLogin(int $last_login) Return the first ChildEmployee filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByPhone(string $phone) Return the first ChildEmployee filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByAddress(string $address) Return the first ChildEmployee filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByCostnumber(string $costnumber) Return the first ChildEmployee filtered by the costnumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByCreatedAt(string $created_at) Return the first ChildEmployee filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByUpdatedAt(string $updated_at) Return the first ChildEmployee filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByBaseMtarget(string $base_mtarget) Return the first ChildEmployee filtered by the base_mtarget column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByIntegrationId(string $integration_id) Return the first ChildEmployee filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByItownid(int $itownid) Return the first ChildEmployee filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByIslocked(boolean $islocked) Return the first ChildEmployee filtered by the islocked column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLockedreason(string $lockedreason) Return the first ChildEmployee filtered by the lockedreason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLockeddate(string $lockeddate) Return the first ChildEmployee filtered by the lockeddate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByIseodcheckenabled(int $iseodcheckenabled) Return the first ChildEmployee filtered by the iseodcheckenabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEmployeeMedia(int $employee_media) Return the first ChildEmployee filtered by the employee_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByResiAddress(string $resi_address) Return the first ChildEmployee filtered by the resi_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByCanFullSync(boolean $can_full_sync) Return the first ChildEmployee filtered by the can_full_sync column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByRemark(string $remark) Return the first ChildEmployee filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByEmployeeSpokenLanguage(string $employee_spoken_language) Return the first ChildEmployee filtered by the employee_spoken_language column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmployee requireOneByLastUpdatedByUserId(int $last_updated_by_user_id) Return the first ChildEmployee filtered by the last_updated_by_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmployee[]|Collection find(?ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildEmployee> find(?ConnectionInterface $con = null) Return ChildEmployee objects based on current ModelCriteria
 *
 * @method     ChildEmployee[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildEmployee objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByEmployeeId(int|array<int> $employee_id) Return ChildEmployee objects filtered by the employee_id column
 * @method     ChildEmployee[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildEmployee objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByCompanyId(int|array<int> $company_id) Return ChildEmployee objects filtered by the company_id column
 * @method     ChildEmployee[]|Collection findByPositionId(int|array<int> $position_id) Return ChildEmployee objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByPositionId(int|array<int> $position_id) Return ChildEmployee objects filtered by the position_id column
 * @method     ChildEmployee[]|Collection findByReportingTo(int|array<int> $reporting_to) Return ChildEmployee objects filtered by the reporting_to column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByReportingTo(int|array<int> $reporting_to) Return ChildEmployee objects filtered by the reporting_to column
 * @method     ChildEmployee[]|Collection findByDesignationId(int|array<int> $designation_id) Return ChildEmployee objects filtered by the designation_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByDesignationId(int|array<int> $designation_id) Return ChildEmployee objects filtered by the designation_id column
 * @method     ChildEmployee[]|Collection findByBranchId(int|array<int> $branch_id) Return ChildEmployee objects filtered by the branch_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByBranchId(int|array<int> $branch_id) Return ChildEmployee objects filtered by the branch_id column
 * @method     ChildEmployee[]|Collection findByGradeId(int|array<int> $grade_id) Return ChildEmployee objects filtered by the grade_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByGradeId(int|array<int> $grade_id) Return ChildEmployee objects filtered by the grade_id column
 * @method     ChildEmployee[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildEmployee objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildEmployee objects filtered by the org_unit_id column
 * @method     ChildEmployee[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildEmployee objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByEmployeeCode(string|array<string> $employee_code) Return ChildEmployee objects filtered by the employee_code column
 * @method     ChildEmployee[]|Collection findByFirstName(string|array<string> $first_name) Return ChildEmployee objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByFirstName(string|array<string> $first_name) Return ChildEmployee objects filtered by the first_name column
 * @method     ChildEmployee[]|Collection findByLastName(string|array<string> $last_name) Return ChildEmployee objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByLastName(string|array<string> $last_name) Return ChildEmployee objects filtered by the last_name column
 * @method     ChildEmployee[]|Collection findByStatus(int|array<int> $status) Return ChildEmployee objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByStatus(int|array<int> $status) Return ChildEmployee objects filtered by the status column
 * @method     ChildEmployee[]|Collection findByIpAddress(string|array<string> $ip_address) Return ChildEmployee objects filtered by the ip_address column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByIpAddress(string|array<string> $ip_address) Return ChildEmployee objects filtered by the ip_address column
 * @method     ChildEmployee[]|Collection findByProfilePicture(string|array<string> $profile_picture) Return ChildEmployee objects filtered by the profile_picture column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByProfilePicture(string|array<string> $profile_picture) Return ChildEmployee objects filtered by the profile_picture column
 * @method     ChildEmployee[]|Collection findByEmail(string|array<string> $email) Return ChildEmployee objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByEmail(string|array<string> $email) Return ChildEmployee objects filtered by the email column
 * @method     ChildEmployee[]|Collection findByLastLogin(int|array<int> $last_login) Return ChildEmployee objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByLastLogin(int|array<int> $last_login) Return ChildEmployee objects filtered by the last_login column
 * @method     ChildEmployee[]|Collection findByPhone(string|array<string> $phone) Return ChildEmployee objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByPhone(string|array<string> $phone) Return ChildEmployee objects filtered by the phone column
 * @method     ChildEmployee[]|Collection findByAddress(string|array<string> $address) Return ChildEmployee objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByAddress(string|array<string> $address) Return ChildEmployee objects filtered by the address column
 * @method     ChildEmployee[]|Collection findByCostnumber(string|array<string> $costnumber) Return ChildEmployee objects filtered by the costnumber column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByCostnumber(string|array<string> $costnumber) Return ChildEmployee objects filtered by the costnumber column
 * @method     ChildEmployee[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildEmployee objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByCreatedAt(string|array<string> $created_at) Return ChildEmployee objects filtered by the created_at column
 * @method     ChildEmployee[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildEmployee objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByUpdatedAt(string|array<string> $updated_at) Return ChildEmployee objects filtered by the updated_at column
 * @method     ChildEmployee[]|Collection findByBaseMtarget(string|array<string> $base_mtarget) Return ChildEmployee objects filtered by the base_mtarget column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByBaseMtarget(string|array<string> $base_mtarget) Return ChildEmployee objects filtered by the base_mtarget column
 * @method     ChildEmployee[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildEmployee objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByIntegrationId(string|array<string> $integration_id) Return ChildEmployee objects filtered by the integration_id column
 * @method     ChildEmployee[]|Collection findByItownid(int|array<int> $itownid) Return ChildEmployee objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByItownid(int|array<int> $itownid) Return ChildEmployee objects filtered by the itownid column
 * @method     ChildEmployee[]|Collection findByIslocked(boolean|array<boolean> $islocked) Return ChildEmployee objects filtered by the islocked column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByIslocked(boolean|array<boolean> $islocked) Return ChildEmployee objects filtered by the islocked column
 * @method     ChildEmployee[]|Collection findByLockedreason(string|array<string> $lockedreason) Return ChildEmployee objects filtered by the lockedreason column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByLockedreason(string|array<string> $lockedreason) Return ChildEmployee objects filtered by the lockedreason column
 * @method     ChildEmployee[]|Collection findByLockeddate(string|array<string> $lockeddate) Return ChildEmployee objects filtered by the lockeddate column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByLockeddate(string|array<string> $lockeddate) Return ChildEmployee objects filtered by the lockeddate column
 * @method     ChildEmployee[]|Collection findByIseodcheckenabled(int|array<int> $iseodcheckenabled) Return ChildEmployee objects filtered by the iseodcheckenabled column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByIseodcheckenabled(int|array<int> $iseodcheckenabled) Return ChildEmployee objects filtered by the iseodcheckenabled column
 * @method     ChildEmployee[]|Collection findByEmployeeMedia(int|array<int> $employee_media) Return ChildEmployee objects filtered by the employee_media column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByEmployeeMedia(int|array<int> $employee_media) Return ChildEmployee objects filtered by the employee_media column
 * @method     ChildEmployee[]|Collection findByResiAddress(string|array<string> $resi_address) Return ChildEmployee objects filtered by the resi_address column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByResiAddress(string|array<string> $resi_address) Return ChildEmployee objects filtered by the resi_address column
 * @method     ChildEmployee[]|Collection findByCanFullSync(boolean|array<boolean> $can_full_sync) Return ChildEmployee objects filtered by the can_full_sync column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByCanFullSync(boolean|array<boolean> $can_full_sync) Return ChildEmployee objects filtered by the can_full_sync column
 * @method     ChildEmployee[]|Collection findByRemark(string|array<string> $remark) Return ChildEmployee objects filtered by the remark column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByRemark(string|array<string> $remark) Return ChildEmployee objects filtered by the remark column
 * @method     ChildEmployee[]|Collection findByEmployeeSpokenLanguage(string|array<string> $employee_spoken_language) Return ChildEmployee objects filtered by the employee_spoken_language column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByEmployeeSpokenLanguage(string|array<string> $employee_spoken_language) Return ChildEmployee objects filtered by the employee_spoken_language column
 * @method     ChildEmployee[]|Collection findByLastUpdatedByUserId(int|array<int> $last_updated_by_user_id) Return ChildEmployee objects filtered by the last_updated_by_user_id column
 * @psalm-method Collection&\Traversable<ChildEmployee> findByLastUpdatedByUserId(int|array<int> $last_updated_by_user_id) Return ChildEmployee objects filtered by the last_updated_by_user_id column
 *
 * @method     ChildEmployee[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildEmployee> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class EmployeeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\EmployeeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Employee', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmployeeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmployeeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildEmployeeQuery) {
            return $criteria;
        }
        $query = new ChildEmployeeQuery();
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmployeeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmployee A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT employee_id, company_id, position_id, reporting_to, designation_id, branch_id, grade_id, org_unit_id, employee_code, first_name, last_name, status, ip_address, profile_picture, email, last_login, phone, address, costnumber, created_at, updated_at, base_mtarget, integration_id, itownid, islocked, lockedreason, lockeddate, iseodcheckenabled, employee_media, resi_address, can_full_sync, remark, employee_spoken_language, last_updated_by_user_id FROM employee WHERE employee_id = :p0';
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
            /** @var ChildEmployee $obj */
            $obj = new ChildEmployee();
            $obj->hydrate($row);
            EmployeeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmployee|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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
                $this->addUsingAlias(EmployeeTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
     * @see       filterByPositionsRelatedByPositionId()
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
                $this->addUsingAlias(EmployeeTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_POSITION_ID, $positionId, $comparison);

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
     * @see       filterByPositionsRelatedByReportingTo()
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
                $this->addUsingAlias(EmployeeTableMap::COL_REPORTING_TO, $reportingTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reportingTo['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_REPORTING_TO, $reportingTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_REPORTING_TO, $reportingTo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignationId(1234); // WHERE designation_id = 1234
     * $query->filterByDesignationId(array(12, 34)); // WHERE designation_id IN (12, 34)
     * $query->filterByDesignationId(array('min' => 12)); // WHERE designation_id > 12
     * </code>
     *
     * @see       filterByDesignations()
     *
     * @param mixed $designationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignationId($designationId = null, ?string $comparison = null)
    {
        if (is_array($designationId)) {
            $useMinMax = false;
            if (isset($designationId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_DESIGNATION_ID, $designationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($designationId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_DESIGNATION_ID, $designationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_DESIGNATION_ID, $designationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the branch_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBranchId(1234); // WHERE branch_id = 1234
     * $query->filterByBranchId(array(12, 34)); // WHERE branch_id IN (12, 34)
     * $query->filterByBranchId(array('min' => 12)); // WHERE branch_id > 12
     * </code>
     *
     * @see       filterByBranch()
     *
     * @param mixed $branchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBranchId($branchId = null, ?string $comparison = null)
    {
        if (is_array($branchId)) {
            $useMinMax = false;
            if (isset($branchId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_BRANCH_ID, $branchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($branchId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_BRANCH_ID, $branchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_BRANCH_ID, $branchId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGradeId(1234); // WHERE grade_id = 1234
     * $query->filterByGradeId(array(12, 34)); // WHERE grade_id IN (12, 34)
     * $query->filterByGradeId(array('min' => 12)); // WHERE grade_id > 12
     * </code>
     *
     * @see       filterByGradeMaster()
     *
     * @param mixed $gradeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeId($gradeId = null, ?string $comparison = null)
    {
        if (is_array($gradeId)) {
            $useMinMax = false;
            if (isset($gradeId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_GRADE_ID, $gradeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gradeId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_GRADE_ID, $gradeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_GRADE_ID, $gradeId, $comparison);

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
                $this->addUsingAlias(EmployeeTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeCode('fooValue');   // WHERE employee_code = 'fooValue'
     * $query->filterByEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE employee_code LIKE '%fooValue%'
     * $query->filterByEmployeeCode(['foo', 'bar']); // WHERE employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeCode($employeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName(['foo', 'bar']); // WHERE first_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName(['foo', 'bar']); // WHERE last_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ip_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpAddress('fooValue');   // WHERE ip_address = 'fooValue'
     * $query->filterByIpAddress('%fooValue%', Criteria::LIKE); // WHERE ip_address LIKE '%fooValue%'
     * $query->filterByIpAddress(['foo', 'bar']); // WHERE ip_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ipAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIpAddress($ipAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_IP_ADDRESS, $ipAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the profile_picture column
     *
     * Example usage:
     * <code>
     * $query->filterByProfilePicture('fooValue');   // WHERE profile_picture = 'fooValue'
     * $query->filterByProfilePicture('%fooValue%', Criteria::LIKE); // WHERE profile_picture LIKE '%fooValue%'
     * $query->filterByProfilePicture(['foo', 'bar']); // WHERE profile_picture IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $profilePicture The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProfilePicture($profilePicture = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profilePicture)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_PROFILE_PICTURE, $profilePicture, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, ?string $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE phone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_PHONE, $phone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * $query->filterByAddress(['foo', 'bar']); // WHERE address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $address The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress($address = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the costnumber column
     *
     * Example usage:
     * <code>
     * $query->filterByCostnumber('fooValue');   // WHERE costnumber = 'fooValue'
     * $query->filterByCostnumber('%fooValue%', Criteria::LIKE); // WHERE costnumber LIKE '%fooValue%'
     * $query->filterByCostnumber(['foo', 'bar']); // WHERE costnumber IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $costnumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCostnumber($costnumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($costnumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_COSTNUMBER, $costnumber, $comparison);

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
                $this->addUsingAlias(EmployeeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(EmployeeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the base_mtarget column
     *
     * Example usage:
     * <code>
     * $query->filterByBaseMtarget(1234); // WHERE base_mtarget = 1234
     * $query->filterByBaseMtarget(array(12, 34)); // WHERE base_mtarget IN (12, 34)
     * $query->filterByBaseMtarget(array('min' => 12)); // WHERE base_mtarget > 12
     * </code>
     *
     * @param mixed $baseMtarget The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBaseMtarget($baseMtarget = null, ?string $comparison = null)
    {
        if (is_array($baseMtarget)) {
            $useMinMax = false;
            if (isset($baseMtarget['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_BASE_MTARGET, $baseMtarget['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($baseMtarget['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_BASE_MTARGET, $baseMtarget['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_BASE_MTARGET, $baseMtarget, $comparison);

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

        $this->addUsingAlias(EmployeeTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                $this->addUsingAlias(EmployeeTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the islocked column
     *
     * Example usage:
     * <code>
     * $query->filterByIslocked(true); // WHERE islocked = true
     * $query->filterByIslocked('yes'); // WHERE islocked = true
     * </code>
     *
     * @param bool|string $islocked The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIslocked($islocked = null, ?string $comparison = null)
    {
        if (is_string($islocked)) {
            $islocked = in_array(strtolower($islocked), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(EmployeeTableMap::COL_ISLOCKED, $islocked, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lockedreason column
     *
     * Example usage:
     * <code>
     * $query->filterByLockedreason('fooValue');   // WHERE lockedreason = 'fooValue'
     * $query->filterByLockedreason('%fooValue%', Criteria::LIKE); // WHERE lockedreason LIKE '%fooValue%'
     * $query->filterByLockedreason(['foo', 'bar']); // WHERE lockedreason IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lockedreason The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLockedreason($lockedreason = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lockedreason)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_LOCKEDREASON, $lockedreason, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lockeddate column
     *
     * Example usage:
     * <code>
     * $query->filterByLockeddate('2011-03-14'); // WHERE lockeddate = '2011-03-14'
     * $query->filterByLockeddate('now'); // WHERE lockeddate = '2011-03-14'
     * $query->filterByLockeddate(array('max' => 'yesterday')); // WHERE lockeddate > '2011-03-13'
     * </code>
     *
     * @param mixed $lockeddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLockeddate($lockeddate = null, ?string $comparison = null)
    {
        if (is_array($lockeddate)) {
            $useMinMax = false;
            if (isset($lockeddate['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LOCKEDDATE, $lockeddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lockeddate['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LOCKEDDATE, $lockeddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_LOCKEDDATE, $lockeddate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the iseodcheckenabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIseodcheckenabled(1234); // WHERE iseodcheckenabled = 1234
     * $query->filterByIseodcheckenabled(array(12, 34)); // WHERE iseodcheckenabled IN (12, 34)
     * $query->filterByIseodcheckenabled(array('min' => 12)); // WHERE iseodcheckenabled > 12
     * </code>
     *
     * @param mixed $iseodcheckenabled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIseodcheckenabled($iseodcheckenabled = null, ?string $comparison = null)
    {
        if (is_array($iseodcheckenabled)) {
            $useMinMax = false;
            if (isset($iseodcheckenabled['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ISEODCHECKENABLED, $iseodcheckenabled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iseodcheckenabled['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_ISEODCHECKENABLED, $iseodcheckenabled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_ISEODCHECKENABLED, $iseodcheckenabled, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_media column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeMedia(1234); // WHERE employee_media = 1234
     * $query->filterByEmployeeMedia(array(12, 34)); // WHERE employee_media IN (12, 34)
     * $query->filterByEmployeeMedia(array('min' => 12)); // WHERE employee_media > 12
     * </code>
     *
     * @param mixed $employeeMedia The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeMedia($employeeMedia = null, ?string $comparison = null)
    {
        if (is_array($employeeMedia)) {
            $useMinMax = false;
            if (isset($employeeMedia['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_MEDIA, $employeeMedia['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeMedia['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_MEDIA, $employeeMedia['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_MEDIA, $employeeMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resi_address column
     *
     * Example usage:
     * <code>
     * $query->filterByResiAddress('fooValue');   // WHERE resi_address = 'fooValue'
     * $query->filterByResiAddress('%fooValue%', Criteria::LIKE); // WHERE resi_address LIKE '%fooValue%'
     * $query->filterByResiAddress(['foo', 'bar']); // WHERE resi_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $resiAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResiAddress($resiAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resiAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_RESI_ADDRESS, $resiAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the can_full_sync column
     *
     * Example usage:
     * <code>
     * $query->filterByCanFullSync(true); // WHERE can_full_sync = true
     * $query->filterByCanFullSync('yes'); // WHERE can_full_sync = true
     * </code>
     *
     * @param bool|string $canFullSync The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanFullSync($canFullSync = null, ?string $comparison = null)
    {
        if (is_string($canFullSync)) {
            $canFullSync = in_array(strtolower($canFullSync), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(EmployeeTableMap::COL_CAN_FULL_SYNC, $canFullSync, $comparison);

        return $this;
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * $query->filterByRemark(['foo', 'bar']); // WHERE remark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $remark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRemark($remark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_REMARK, $remark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_spoken_language column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeSpokenLanguage('fooValue');   // WHERE employee_spoken_language = 'fooValue'
     * $query->filterByEmployeeSpokenLanguage('%fooValue%', Criteria::LIKE); // WHERE employee_spoken_language LIKE '%fooValue%'
     * $query->filterByEmployeeSpokenLanguage(['foo', 'bar']); // WHERE employee_spoken_language IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeSpokenLanguage The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeSpokenLanguage($employeeSpokenLanguage = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeSpokenLanguage)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE, $employeeSpokenLanguage, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_updated_by_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUpdatedByUserId(1234); // WHERE last_updated_by_user_id = 1234
     * $query->filterByLastUpdatedByUserId(array(12, 34)); // WHERE last_updated_by_user_id IN (12, 34)
     * $query->filterByLastUpdatedByUserId(array('min' => 12)); // WHERE last_updated_by_user_id > 12
     * </code>
     *
     * @param mixed $lastUpdatedByUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastUpdatedByUserId($lastUpdatedByUserId = null, ?string $comparison = null)
    {
        if (is_array($lastUpdatedByUserId)) {
            $useMinMax = false;
            if (isset($lastUpdatedByUserId['min'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID, $lastUpdatedByUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdatedByUserId['max'])) {
                $this->addUsingAlias(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID, $lastUpdatedByUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID, $lastUpdatedByUserId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Branch object
     *
     * @param \entities\Branch|ObjectCollection $branch The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBranch($branch, ?string $comparison = null)
    {
        if ($branch instanceof \entities\Branch) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_BRANCH_ID, $branch->getBranchId(), $comparison);
        } elseif ($branch instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_BRANCH_ID, $branch->toKeyValue('PrimaryKey', 'BranchId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBranch() only accepts arguments of type \entities\Branch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Branch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBranch(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Branch');

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
            $this->addJoinObject($join, 'Branch');
        }

        return $this;
    }

    /**
     * Use the Branch relation Branch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBranch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Branch', '\entities\BranchQuery');
    }

    /**
     * Use the Branch relation Branch object
     *
     * @param callable(\entities\BranchQuery):\entities\BranchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBranchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBranchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Branch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BranchQuery The inner query object of the EXISTS statement
     */
    public function useBranchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useExistsQuery('Branch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Branch table for a NOT EXISTS query.
     *
     * @see useBranchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BranchQuery The inner query object of the NOT EXISTS statement
     */
    public function useBranchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useExistsQuery('Branch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Branch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BranchQuery The inner query object of the IN statement
     */
    public function useInBranchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useInQuery('Branch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Branch table for a NOT IN query.
     *
     * @see useBranchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BranchQuery The inner query object of the NOT IN statement
     */
    public function useNotInBranchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BranchQuery */
        $q = $this->useInQuery('Branch', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Designations object
     *
     * @param \entities\Designations|ObjectCollection $designations The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignations($designations, ?string $comparison = null)
    {
        if ($designations instanceof \entities\Designations) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_DESIGNATION_ID, $designations->getDesignationId(), $comparison);
        } elseif ($designations instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_DESIGNATION_ID, $designations->toKeyValue('PrimaryKey', 'DesignationId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByDesignations() only accepts arguments of type \entities\Designations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Designations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDesignations(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Designations');

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
            $this->addJoinObject($join, 'Designations');
        }

        return $this;
    }

    /**
     * Use the Designations relation Designations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DesignationsQuery A secondary query class using the current class as primary query
     */
    public function useDesignationsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDesignations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Designations', '\entities\DesignationsQuery');
    }

    /**
     * Use the Designations relation Designations object
     *
     * @param callable(\entities\DesignationsQuery):\entities\DesignationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDesignationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDesignationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Designations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DesignationsQuery The inner query object of the EXISTS statement
     */
    public function useDesignationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useExistsQuery('Designations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Designations table for a NOT EXISTS query.
     *
     * @see useDesignationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DesignationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDesignationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useExistsQuery('Designations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Designations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DesignationsQuery The inner query object of the IN statement
     */
    public function useInDesignationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useInQuery('Designations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Designations table for a NOT IN query.
     *
     * @see useDesignationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DesignationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDesignationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DesignationsQuery */
        $q = $this->useInQuery('Designations', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GradeMaster object
     *
     * @param \entities\GradeMaster|ObjectCollection $gradeMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeMaster($gradeMaster, ?string $comparison = null)
    {
        if ($gradeMaster instanceof \entities\GradeMaster) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_GRADE_ID, $gradeMaster->getGradeid(), $comparison);
        } elseif ($gradeMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_GRADE_ID, $gradeMaster->toKeyValue('PrimaryKey', 'Gradeid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGradeMaster() only accepts arguments of type \entities\GradeMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GradeMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGradeMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GradeMaster');

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
            $this->addJoinObject($join, 'GradeMaster');
        }

        return $this;
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GradeMasterQuery A secondary query class using the current class as primary query
     */
    public function useGradeMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGradeMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GradeMaster', '\entities\GradeMasterQuery');
    }

    /**
     * Use the GradeMaster relation GradeMaster object
     *
     * @param callable(\entities\GradeMasterQuery):\entities\GradeMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGradeMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGradeMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GradeMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GradeMasterQuery The inner query object of the EXISTS statement
     */
    public function useGradeMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT EXISTS query.
     *
     * @see useGradeMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useGradeMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useExistsQuery('GradeMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GradeMasterQuery The inner query object of the IN statement
     */
    public function useInGradeMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GradeMaster table for a NOT IN query.
     *
     * @see useGradeMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GradeMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInGradeMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GradeMasterQuery */
        $q = $this->useInQuery('GradeMaster', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionsRelatedByPositionId($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByPositionId() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByPositionId');

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
            $this->addJoinObject($join, 'PositionsRelatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByPositionId relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByPositionId', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByPositionId relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByPositionId relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByPositionId relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByPositionId relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByPositionId relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionsRelatedByReportingTo($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(EmployeeTableMap::COL_REPORTING_TO, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_REPORTING_TO, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByReportingTo() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByReportingTo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByReportingTo(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByReportingTo');

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
            $this->addJoinObject($join, 'PositionsRelatedByReportingTo');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByReportingTo relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByReportingToQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByReportingTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByReportingTo', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByReportingTo relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByReportingToQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByReportingToQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByReportingTo relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByReportingToExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByReportingTo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByReportingTo relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByReportingToExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByReportingToNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByReportingTo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByReportingTo relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByReportingToQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByReportingTo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByReportingTo relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByReportingToInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByReportingToQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByReportingTo', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(EmployeeTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
     * Filter the query by a related \entities\AnnouncementEmployeeMap object
     *
     * @param \entities\AnnouncementEmployeeMap|ObjectCollection $announcementEmployeeMap the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncementEmployeeMap($announcementEmployeeMap, ?string $comparison = null)
    {
        if ($announcementEmployeeMap instanceof \entities\AnnouncementEmployeeMap) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $announcementEmployeeMap->getEmployeeId(), $comparison);

            return $this;
        } elseif ($announcementEmployeeMap instanceof ObjectCollection) {
            $this
                ->useAnnouncementEmployeeMapQuery()
                ->filterByPrimaryKeys($announcementEmployeeMap->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAnnouncementEmployeeMap() only accepts arguments of type \entities\AnnouncementEmployeeMap or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AnnouncementEmployeeMap relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAnnouncementEmployeeMap(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AnnouncementEmployeeMap');

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
            $this->addJoinObject($join, 'AnnouncementEmployeeMap');
        }

        return $this;
    }

    /**
     * Use the AnnouncementEmployeeMap relation AnnouncementEmployeeMap object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AnnouncementEmployeeMapQuery A secondary query class using the current class as primary query
     */
    public function useAnnouncementEmployeeMapQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAnnouncementEmployeeMap($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AnnouncementEmployeeMap', '\entities\AnnouncementEmployeeMapQuery');
    }

    /**
     * Use the AnnouncementEmployeeMap relation AnnouncementEmployeeMap object
     *
     * @param callable(\entities\AnnouncementEmployeeMapQuery):\entities\AnnouncementEmployeeMapQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAnnouncementEmployeeMapQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAnnouncementEmployeeMapQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the EXISTS statement
     */
    public function useAnnouncementEmployeeMapExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useExistsQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for a NOT EXISTS query.
     *
     * @see useAnnouncementEmployeeMapExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the NOT EXISTS statement
     */
    public function useAnnouncementEmployeeMapNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useExistsQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the IN statement
     */
    public function useInAnnouncementEmployeeMapQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useInQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to AnnouncementEmployeeMap table for a NOT IN query.
     *
     * @see useAnnouncementEmployeeMapInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementEmployeeMapQuery The inner query object of the NOT IN statement
     */
    public function useNotInAnnouncementEmployeeMapQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementEmployeeMapQuery */
        $q = $this->useInQuery('AnnouncementEmployeeMap', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Attendance object
     *
     * @param \entities\Attendance|ObjectCollection $attendance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttendance($attendance, ?string $comparison = null)
    {
        if ($attendance instanceof \entities\Attendance) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $attendance->getEmployeeId(), $comparison);

            return $this;
        } elseif ($attendance instanceof ObjectCollection) {
            $this
                ->useAttendanceQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAttendance() only accepts arguments of type \entities\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendance relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAttendance(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendance');

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
            $this->addJoinObject($join, 'Attendance');
        }

        return $this;
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttendance($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendance', '\entities\AttendanceQuery');
    }

    /**
     * Use the Attendance relation Attendance object
     *
     * @param callable(\entities\AttendanceQuery):\entities\AttendanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAttendanceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAttendanceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Attendance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AttendanceQuery The inner query object of the EXISTS statement
     */
    public function useAttendanceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('Attendance', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Attendance table for a NOT EXISTS query.
     *
     * @see useAttendanceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useAttendanceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('Attendance', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Attendance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AttendanceQuery The inner query object of the IN statement
     */
    public function useInAttendanceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('Attendance', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Attendance table for a NOT IN query.
     *
     * @see useAttendanceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInAttendanceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('Attendance', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\AuditEmpUnits object
     *
     * @param \entities\AuditEmpUnits|ObjectCollection $auditEmpUnits the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAuditEmpUnits($auditEmpUnits, ?string $comparison = null)
    {
        if ($auditEmpUnits instanceof \entities\AuditEmpUnits) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $auditEmpUnits->getEmployeeId(), $comparison);

            return $this;
        } elseif ($auditEmpUnits instanceof ObjectCollection) {
            $this
                ->useAuditEmpUnitsQuery()
                ->filterByPrimaryKeys($auditEmpUnits->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAuditEmpUnits() only accepts arguments of type \entities\AuditEmpUnits or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuditEmpUnits relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAuditEmpUnits(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuditEmpUnits');

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
            $this->addJoinObject($join, 'AuditEmpUnits');
        }

        return $this;
    }

    /**
     * Use the AuditEmpUnits relation AuditEmpUnits object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AuditEmpUnitsQuery A secondary query class using the current class as primary query
     */
    public function useAuditEmpUnitsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAuditEmpUnits($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuditEmpUnits', '\entities\AuditEmpUnitsQuery');
    }

    /**
     * Use the AuditEmpUnits relation AuditEmpUnits object
     *
     * @param callable(\entities\AuditEmpUnitsQuery):\entities\AuditEmpUnitsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAuditEmpUnitsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAuditEmpUnitsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to AuditEmpUnits table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AuditEmpUnitsQuery The inner query object of the EXISTS statement
     */
    public function useAuditEmpUnitsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AuditEmpUnitsQuery */
        $q = $this->useExistsQuery('AuditEmpUnits', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to AuditEmpUnits table for a NOT EXISTS query.
     *
     * @see useAuditEmpUnitsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AuditEmpUnitsQuery The inner query object of the NOT EXISTS statement
     */
    public function useAuditEmpUnitsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AuditEmpUnitsQuery */
        $q = $this->useExistsQuery('AuditEmpUnits', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to AuditEmpUnits table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AuditEmpUnitsQuery The inner query object of the IN statement
     */
    public function useInAuditEmpUnitsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AuditEmpUnitsQuery */
        $q = $this->useInQuery('AuditEmpUnits', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to AuditEmpUnits table for a NOT IN query.
     *
     * @see useAuditEmpUnitsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AuditEmpUnitsQuery The inner query object of the NOT IN statement
     */
    public function useNotInAuditEmpUnitsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AuditEmpUnitsQuery */
        $q = $this->useInQuery('AuditEmpUnits', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $brandRcpa->getEmployeeId(), $comparison);

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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $competitionMapping->getEmployeeId(), $comparison);

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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $dailycallsSgpiout->getEmployeeId(), $comparison);

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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $edSession->getEmployeeId(), $comparison);

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
     * Filter the query by a related \entities\EmployeeIncentive object
     *
     * @param \entities\EmployeeIncentive|ObjectCollection $employeeIncentive the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeIncentive($employeeIncentive, ?string $comparison = null)
    {
        if ($employeeIncentive instanceof \entities\EmployeeIncentive) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employeeIncentive->getEmployeeId(), $comparison);

            return $this;
        } elseif ($employeeIncentive instanceof ObjectCollection) {
            $this
                ->useEmployeeIncentiveQuery()
                ->filterByPrimaryKeys($employeeIncentive->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmployeeIncentive() only accepts arguments of type \entities\EmployeeIncentive or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeIncentive relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeIncentive(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeIncentive');

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
            $this->addJoinObject($join, 'EmployeeIncentive');
        }

        return $this;
    }

    /**
     * Use the EmployeeIncentive relation EmployeeIncentive object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeIncentiveQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeIncentiveQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmployeeIncentive($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeIncentive', '\entities\EmployeeIncentiveQuery');
    }

    /**
     * Use the EmployeeIncentive relation EmployeeIncentive object
     *
     * @param callable(\entities\EmployeeIncentiveQuery):\entities\EmployeeIncentiveQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeIncentiveQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmployeeIncentiveQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EmployeeIncentive table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeIncentiveQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeIncentiveExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeIncentiveQuery */
        $q = $this->useExistsQuery('EmployeeIncentive', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EmployeeIncentive table for a NOT EXISTS query.
     *
     * @see useEmployeeIncentiveExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeIncentiveQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeIncentiveNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeIncentiveQuery */
        $q = $this->useExistsQuery('EmployeeIncentive', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EmployeeIncentive table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeIncentiveQuery The inner query object of the IN statement
     */
    public function useInEmployeeIncentiveQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeIncentiveQuery */
        $q = $this->useInQuery('EmployeeIncentive', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EmployeeIncentive table for a NOT IN query.
     *
     * @see useEmployeeIncentiveInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeIncentiveQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeIncentiveQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeIncentiveQuery */
        $q = $this->useInQuery('EmployeeIncentive', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employeePositionHistory->getEmployeeId(), $comparison);

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
     * Filter the query by a related \entities\Events object
     *
     * @param \entities\Events|ObjectCollection $events the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventsRelatedByEmployeeId($events, ?string $comparison = null)
    {
        if ($events instanceof \entities\Events) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $events->getEmployeeId(), $comparison);

            return $this;
        } elseif ($events instanceof ObjectCollection) {
            $this
                ->useEventsRelatedByEmployeeIdQuery()
                ->filterByPrimaryKeys($events->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEventsRelatedByEmployeeId() only accepts arguments of type \entities\Events or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventsRelatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEventsRelatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventsRelatedByEmployeeId');

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
            $this->addJoinObject($join, 'EventsRelatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EventsRelatedByEmployeeId relation Events object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EventsQuery A secondary query class using the current class as primary query
     */
    public function useEventsRelatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventsRelatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventsRelatedByEmployeeId', '\entities\EventsQuery');
    }

    /**
     * Use the EventsRelatedByEmployeeId relation Events object
     *
     * @param callable(\entities\EventsQuery):\entities\EventsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventsRelatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEventsRelatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EventsRelatedByEmployeeId relation to the Events table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EventsQuery The inner query object of the EXISTS statement
     */
    public function useEventsRelatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('EventsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EventsRelatedByEmployeeId relation to the Events table for a NOT EXISTS query.
     *
     * @see useEventsRelatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventsRelatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('EventsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EventsRelatedByEmployeeId relation to the Events table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EventsQuery The inner query object of the IN statement
     */
    public function useInEventsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('EventsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EventsRelatedByEmployeeId relation to the Events table for a NOT IN query.
     *
     * @see useEventsRelatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('EventsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Events object
     *
     * @param \entities\Events|ObjectCollection $events the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventsRelatedByApproverEmpId($events, ?string $comparison = null)
    {
        if ($events instanceof \entities\Events) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $events->getApproverEmpId(), $comparison);

            return $this;
        } elseif ($events instanceof ObjectCollection) {
            $this
                ->useEventsRelatedByApproverEmpIdQuery()
                ->filterByPrimaryKeys($events->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEventsRelatedByApproverEmpId() only accepts arguments of type \entities\Events or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventsRelatedByApproverEmpId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEventsRelatedByApproverEmpId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventsRelatedByApproverEmpId');

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
            $this->addJoinObject($join, 'EventsRelatedByApproverEmpId');
        }

        return $this;
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation Events object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EventsQuery A secondary query class using the current class as primary query
     */
    public function useEventsRelatedByApproverEmpIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventsRelatedByApproverEmpId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventsRelatedByApproverEmpId', '\entities\EventsQuery');
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation Events object
     *
     * @param callable(\entities\EventsQuery):\entities\EventsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventsRelatedByApproverEmpIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEventsRelatedByApproverEmpIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation to the Events table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EventsQuery The inner query object of the EXISTS statement
     */
    public function useEventsRelatedByApproverEmpIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('EventsRelatedByApproverEmpId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation to the Events table for a NOT EXISTS query.
     *
     * @see useEventsRelatedByApproverEmpIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventsRelatedByApproverEmpIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('EventsRelatedByApproverEmpId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation to the Events table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EventsQuery The inner query object of the IN statement
     */
    public function useInEventsRelatedByApproverEmpIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('EventsRelatedByApproverEmpId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EventsRelatedByApproverEmpId relation to the Events table for a NOT IN query.
     *
     * @see useEventsRelatedByApproverEmpIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventsRelatedByApproverEmpIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('EventsRelatedByApproverEmpId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ExpensePayments object
     *
     * @param \entities\ExpensePayments|ObjectCollection $expensePayments the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpensePayments($expensePayments, ?string $comparison = null)
    {
        if ($expensePayments instanceof \entities\ExpensePayments) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $expensePayments->getEmployeeId(), $comparison);

            return $this;
        } elseif ($expensePayments instanceof ObjectCollection) {
            $this
                ->useExpensePaymentsQuery()
                ->filterByPrimaryKeys($expensePayments->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpensePayments() only accepts arguments of type \entities\ExpensePayments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpensePayments relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpensePayments(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpensePayments');

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
            $this->addJoinObject($join, 'ExpensePayments');
        }

        return $this;
    }

    /**
     * Use the ExpensePayments relation ExpensePayments object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensePaymentsQuery A secondary query class using the current class as primary query
     */
    public function useExpensePaymentsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpensePayments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpensePayments', '\entities\ExpensePaymentsQuery');
    }

    /**
     * Use the ExpensePayments relation ExpensePayments object
     *
     * @param callable(\entities\ExpensePaymentsQuery):\entities\ExpensePaymentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensePaymentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpensePaymentsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpensePayments table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensePaymentsQuery The inner query object of the EXISTS statement
     */
    public function useExpensePaymentsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensePaymentsQuery */
        $q = $this->useExistsQuery('ExpensePayments', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpensePayments table for a NOT EXISTS query.
     *
     * @see useExpensePaymentsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensePaymentsQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensePaymentsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensePaymentsQuery */
        $q = $this->useExistsQuery('ExpensePayments', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpensePayments table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensePaymentsQuery The inner query object of the IN statement
     */
    public function useInExpensePaymentsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensePaymentsQuery */
        $q = $this->useInQuery('ExpensePayments', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpensePayments table for a NOT IN query.
     *
     * @see useExpensePaymentsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensePaymentsQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensePaymentsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensePaymentsQuery */
        $q = $this->useInQuery('ExpensePayments', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Expenses object
     *
     * @param \entities\Expenses|ObjectCollection $expenses the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenses($expenses, ?string $comparison = null)
    {
        if ($expenses instanceof \entities\Expenses) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $expenses->getEmployeeId(), $comparison);

            return $this;
        } elseif ($expenses instanceof ObjectCollection) {
            $this
                ->useExpensesQuery()
                ->filterByPrimaryKeys($expenses->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenses() only accepts arguments of type \entities\Expenses or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Expenses relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenses(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Expenses');

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
            $this->addJoinObject($join, 'Expenses');
        }

        return $this;
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpensesQuery A secondary query class using the current class as primary query
     */
    public function useExpensesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenses($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Expenses', '\entities\ExpensesQuery');
    }

    /**
     * Use the Expenses relation Expenses object
     *
     * @param callable(\entities\ExpensesQuery):\entities\ExpensesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpensesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpensesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Expenses table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpensesQuery The inner query object of the EXISTS statement
     */
    public function useExpensesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT EXISTS query.
     *
     * @see useExpensesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpensesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useExistsQuery('Expenses', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Expenses table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpensesQuery The inner query object of the IN statement
     */
    public function useInExpensesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Expenses table for a NOT IN query.
     *
     * @see useExpensesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpensesQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpensesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpensesQuery */
        $q = $this->useInQuery('Expenses', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserAccount object
     *
     * @param \entities\HrUserAccount|ObjectCollection $hrUserAccount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserAccount($hrUserAccount, ?string $comparison = null)
    {
        if ($hrUserAccount instanceof \entities\HrUserAccount) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserAccount->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserAccount instanceof ObjectCollection) {
            $this
                ->useHrUserAccountQuery()
                ->filterByPrimaryKeys($hrUserAccount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserAccount() only accepts arguments of type \entities\HrUserAccount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserAccount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserAccount(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserAccount');

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
            $this->addJoinObject($join, 'HrUserAccount');
        }

        return $this;
    }

    /**
     * Use the HrUserAccount relation HrUserAccount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserAccountQuery A secondary query class using the current class as primary query
     */
    public function useHrUserAccountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHrUserAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserAccount', '\entities\HrUserAccountQuery');
    }

    /**
     * Use the HrUserAccount relation HrUserAccount object
     *
     * @param callable(\entities\HrUserAccountQuery):\entities\HrUserAccountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserAccountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHrUserAccountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserAccount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserAccountQuery The inner query object of the EXISTS statement
     */
    public function useHrUserAccountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserAccountQuery */
        $q = $this->useExistsQuery('HrUserAccount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserAccount table for a NOT EXISTS query.
     *
     * @see useHrUserAccountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserAccountQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserAccountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserAccountQuery */
        $q = $this->useExistsQuery('HrUserAccount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserAccount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserAccountQuery The inner query object of the IN statement
     */
    public function useInHrUserAccountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserAccountQuery */
        $q = $this->useInQuery('HrUserAccount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserAccount table for a NOT IN query.
     *
     * @see useHrUserAccountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserAccountQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserAccountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserAccountQuery */
        $q = $this->useInQuery('HrUserAccount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserDates object
     *
     * @param \entities\HrUserDates|ObjectCollection $hrUserDates the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserDates($hrUserDates, ?string $comparison = null)
    {
        if ($hrUserDates instanceof \entities\HrUserDates) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserDates->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserDates instanceof ObjectCollection) {
            $this
                ->useHrUserDatesQuery()
                ->filterByPrimaryKeys($hrUserDates->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserDates() only accepts arguments of type \entities\HrUserDates or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserDates relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserDates(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserDates');

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
            $this->addJoinObject($join, 'HrUserDates');
        }

        return $this;
    }

    /**
     * Use the HrUserDates relation HrUserDates object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserDatesQuery A secondary query class using the current class as primary query
     */
    public function useHrUserDatesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHrUserDates($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserDates', '\entities\HrUserDatesQuery');
    }

    /**
     * Use the HrUserDates relation HrUserDates object
     *
     * @param callable(\entities\HrUserDatesQuery):\entities\HrUserDatesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserDatesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHrUserDatesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserDates table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserDatesQuery The inner query object of the EXISTS statement
     */
    public function useHrUserDatesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserDatesQuery */
        $q = $this->useExistsQuery('HrUserDates', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserDates table for a NOT EXISTS query.
     *
     * @see useHrUserDatesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserDatesQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserDatesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserDatesQuery */
        $q = $this->useExistsQuery('HrUserDates', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserDates table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserDatesQuery The inner query object of the IN statement
     */
    public function useInHrUserDatesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserDatesQuery */
        $q = $this->useInQuery('HrUserDates', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserDates table for a NOT IN query.
     *
     * @see useHrUserDatesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserDatesQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserDatesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserDatesQuery */
        $q = $this->useInQuery('HrUserDates', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserDocuments object
     *
     * @param \entities\HrUserDocuments|ObjectCollection $hrUserDocuments the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserDocuments($hrUserDocuments, ?string $comparison = null)
    {
        if ($hrUserDocuments instanceof \entities\HrUserDocuments) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserDocuments->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserDocuments instanceof ObjectCollection) {
            $this
                ->useHrUserDocumentsQuery()
                ->filterByPrimaryKeys($hrUserDocuments->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserDocuments() only accepts arguments of type \entities\HrUserDocuments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserDocuments relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserDocuments(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserDocuments');

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
            $this->addJoinObject($join, 'HrUserDocuments');
        }

        return $this;
    }

    /**
     * Use the HrUserDocuments relation HrUserDocuments object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserDocumentsQuery A secondary query class using the current class as primary query
     */
    public function useHrUserDocumentsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHrUserDocuments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserDocuments', '\entities\HrUserDocumentsQuery');
    }

    /**
     * Use the HrUserDocuments relation HrUserDocuments object
     *
     * @param callable(\entities\HrUserDocumentsQuery):\entities\HrUserDocumentsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserDocumentsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHrUserDocumentsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserDocuments table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserDocumentsQuery The inner query object of the EXISTS statement
     */
    public function useHrUserDocumentsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserDocumentsQuery */
        $q = $this->useExistsQuery('HrUserDocuments', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserDocuments table for a NOT EXISTS query.
     *
     * @see useHrUserDocumentsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserDocumentsQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserDocumentsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserDocumentsQuery */
        $q = $this->useExistsQuery('HrUserDocuments', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserDocuments table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserDocumentsQuery The inner query object of the IN statement
     */
    public function useInHrUserDocumentsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserDocumentsQuery */
        $q = $this->useInQuery('HrUserDocuments', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserDocuments table for a NOT IN query.
     *
     * @see useHrUserDocumentsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserDocumentsQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserDocumentsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserDocumentsQuery */
        $q = $this->useInQuery('HrUserDocuments', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserExperiences object
     *
     * @param \entities\HrUserExperiences|ObjectCollection $hrUserExperiences the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserExperiences($hrUserExperiences, ?string $comparison = null)
    {
        if ($hrUserExperiences instanceof \entities\HrUserExperiences) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserExperiences->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserExperiences instanceof ObjectCollection) {
            $this
                ->useHrUserExperiencesQuery()
                ->filterByPrimaryKeys($hrUserExperiences->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserExperiences() only accepts arguments of type \entities\HrUserExperiences or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserExperiences relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserExperiences(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserExperiences');

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
            $this->addJoinObject($join, 'HrUserExperiences');
        }

        return $this;
    }

    /**
     * Use the HrUserExperiences relation HrUserExperiences object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserExperiencesQuery A secondary query class using the current class as primary query
     */
    public function useHrUserExperiencesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHrUserExperiences($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserExperiences', '\entities\HrUserExperiencesQuery');
    }

    /**
     * Use the HrUserExperiences relation HrUserExperiences object
     *
     * @param callable(\entities\HrUserExperiencesQuery):\entities\HrUserExperiencesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserExperiencesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHrUserExperiencesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserExperiences table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserExperiencesQuery The inner query object of the EXISTS statement
     */
    public function useHrUserExperiencesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserExperiencesQuery */
        $q = $this->useExistsQuery('HrUserExperiences', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserExperiences table for a NOT EXISTS query.
     *
     * @see useHrUserExperiencesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserExperiencesQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserExperiencesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserExperiencesQuery */
        $q = $this->useExistsQuery('HrUserExperiences', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserExperiences table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserExperiencesQuery The inner query object of the IN statement
     */
    public function useInHrUserExperiencesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserExperiencesQuery */
        $q = $this->useInQuery('HrUserExperiences', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserExperiences table for a NOT IN query.
     *
     * @see useHrUserExperiencesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserExperiencesQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserExperiencesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserExperiencesQuery */
        $q = $this->useInQuery('HrUserExperiences', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserQualification object
     *
     * @param \entities\HrUserQualification|ObjectCollection $hrUserQualification the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserQualification($hrUserQualification, ?string $comparison = null)
    {
        if ($hrUserQualification instanceof \entities\HrUserQualification) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserQualification->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserQualification instanceof ObjectCollection) {
            $this
                ->useHrUserQualificationQuery()
                ->filterByPrimaryKeys($hrUserQualification->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserQualification() only accepts arguments of type \entities\HrUserQualification or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserQualification relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserQualification(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserQualification');

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
            $this->addJoinObject($join, 'HrUserQualification');
        }

        return $this;
    }

    /**
     * Use the HrUserQualification relation HrUserQualification object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserQualificationQuery A secondary query class using the current class as primary query
     */
    public function useHrUserQualificationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHrUserQualification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserQualification', '\entities\HrUserQualificationQuery');
    }

    /**
     * Use the HrUserQualification relation HrUserQualification object
     *
     * @param callable(\entities\HrUserQualificationQuery):\entities\HrUserQualificationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserQualificationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHrUserQualificationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserQualification table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserQualificationQuery The inner query object of the EXISTS statement
     */
    public function useHrUserQualificationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserQualificationQuery */
        $q = $this->useExistsQuery('HrUserQualification', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserQualification table for a NOT EXISTS query.
     *
     * @see useHrUserQualificationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserQualificationQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserQualificationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserQualificationQuery */
        $q = $this->useExistsQuery('HrUserQualification', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserQualification table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserQualificationQuery The inner query object of the IN statement
     */
    public function useInHrUserQualificationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserQualificationQuery */
        $q = $this->useInQuery('HrUserQualification', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserQualification table for a NOT IN query.
     *
     * @see useHrUserQualificationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserQualificationQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserQualificationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserQualificationQuery */
        $q = $this->useInQuery('HrUserQualification', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\HrUserReferences object
     *
     * @param \entities\HrUserReferences|ObjectCollection $hrUserReferences the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHrUserReferences($hrUserReferences, ?string $comparison = null)
    {
        if ($hrUserReferences instanceof \entities\HrUserReferences) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $hrUserReferences->getEmployeeId(), $comparison);

            return $this;
        } elseif ($hrUserReferences instanceof ObjectCollection) {
            $this
                ->useHrUserReferencesQuery()
                ->filterByPrimaryKeys($hrUserReferences->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHrUserReferences() only accepts arguments of type \entities\HrUserReferences or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HrUserReferences relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHrUserReferences(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HrUserReferences');

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
            $this->addJoinObject($join, 'HrUserReferences');
        }

        return $this;
    }

    /**
     * Use the HrUserReferences relation HrUserReferences object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HrUserReferencesQuery A secondary query class using the current class as primary query
     */
    public function useHrUserReferencesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHrUserReferences($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HrUserReferences', '\entities\HrUserReferencesQuery');
    }

    /**
     * Use the HrUserReferences relation HrUserReferences object
     *
     * @param callable(\entities\HrUserReferencesQuery):\entities\HrUserReferencesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHrUserReferencesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHrUserReferencesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to HrUserReferences table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HrUserReferencesQuery The inner query object of the EXISTS statement
     */
    public function useHrUserReferencesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HrUserReferencesQuery */
        $q = $this->useExistsQuery('HrUserReferences', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to HrUserReferences table for a NOT EXISTS query.
     *
     * @see useHrUserReferencesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserReferencesQuery The inner query object of the NOT EXISTS statement
     */
    public function useHrUserReferencesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserReferencesQuery */
        $q = $this->useExistsQuery('HrUserReferences', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to HrUserReferences table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HrUserReferencesQuery The inner query object of the IN statement
     */
    public function useInHrUserReferencesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HrUserReferencesQuery */
        $q = $this->useInQuery('HrUserReferences', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to HrUserReferences table for a NOT IN query.
     *
     * @see useHrUserReferencesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HrUserReferencesQuery The inner query object of the NOT IN statement
     */
    public function useNotInHrUserReferencesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HrUserReferencesQuery */
        $q = $this->useInQuery('HrUserReferences', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\LeaveRequest object
     *
     * @param \entities\LeaveRequest|ObjectCollection $leaveRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveRequest($leaveRequest, ?string $comparison = null)
    {
        if ($leaveRequest instanceof \entities\LeaveRequest) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $leaveRequest->getEmployeeId(), $comparison);

            return $this;
        } elseif ($leaveRequest instanceof ObjectCollection) {
            $this
                ->useLeaveRequestQuery()
                ->filterByPrimaryKeys($leaveRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLeaveRequest() only accepts arguments of type \entities\LeaveRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeaveRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLeaveRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeaveRequest');

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
            $this->addJoinObject($join, 'LeaveRequest');
        }

        return $this;
    }

    /**
     * Use the LeaveRequest relation LeaveRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\LeaveRequestQuery A secondary query class using the current class as primary query
     */
    public function useLeaveRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLeaveRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeaveRequest', '\entities\LeaveRequestQuery');
    }

    /**
     * Use the LeaveRequest relation LeaveRequest object
     *
     * @param callable(\entities\LeaveRequestQuery):\entities\LeaveRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLeaveRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLeaveRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to LeaveRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\LeaveRequestQuery The inner query object of the EXISTS statement
     */
    public function useLeaveRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\LeaveRequestQuery */
        $q = $this->useExistsQuery('LeaveRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to LeaveRequest table for a NOT EXISTS query.
     *
     * @see useLeaveRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\LeaveRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useLeaveRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeaveRequestQuery */
        $q = $this->useExistsQuery('LeaveRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to LeaveRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\LeaveRequestQuery The inner query object of the IN statement
     */
    public function useInLeaveRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\LeaveRequestQuery */
        $q = $this->useInQuery('LeaveRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to LeaveRequest table for a NOT IN query.
     *
     * @see useLeaveRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\LeaveRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInLeaveRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeaveRequestQuery */
        $q = $this->useInQuery('LeaveRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Leaves object
     *
     * @param \entities\Leaves|ObjectCollection $leaves the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaves($leaves, ?string $comparison = null)
    {
        if ($leaves instanceof \entities\Leaves) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $leaves->getEmployeeId(), $comparison);

            return $this;
        } elseif ($leaves instanceof ObjectCollection) {
            $this
                ->useLeavesQuery()
                ->filterByPrimaryKeys($leaves->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLeaves() only accepts arguments of type \entities\Leaves or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Leaves relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLeaves(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Leaves');

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
            $this->addJoinObject($join, 'Leaves');
        }

        return $this;
    }

    /**
     * Use the Leaves relation Leaves object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\LeavesQuery A secondary query class using the current class as primary query
     */
    public function useLeavesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeaves($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Leaves', '\entities\LeavesQuery');
    }

    /**
     * Use the Leaves relation Leaves object
     *
     * @param callable(\entities\LeavesQuery):\entities\LeavesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLeavesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useLeavesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Leaves table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\LeavesQuery The inner query object of the EXISTS statement
     */
    public function useLeavesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\LeavesQuery */
        $q = $this->useExistsQuery('Leaves', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Leaves table for a NOT EXISTS query.
     *
     * @see useLeavesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\LeavesQuery The inner query object of the NOT EXISTS statement
     */
    public function useLeavesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeavesQuery */
        $q = $this->useExistsQuery('Leaves', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Leaves table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\LeavesQuery The inner query object of the IN statement
     */
    public function useInLeavesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\LeavesQuery */
        $q = $this->useInQuery('Leaves', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Leaves table for a NOT IN query.
     *
     * @see useLeavesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\LeavesQuery The inner query object of the NOT IN statement
     */
    public function useNotInLeavesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeavesQuery */
        $q = $this->useInQuery('Leaves', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $mtp->getMtpApprovedBy(), $comparison);

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
    public function joinMtp(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useMtpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
    public function filterByOnBoardRequestRelatedByApprovedByEmployeeId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $onBoardRequest->getApprovedByEmployeeId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByApprovedByEmployeeIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByApprovedByEmployeeId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByApprovedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByApprovedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByApprovedByEmployeeId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByApprovedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByApprovedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByApprovedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByApprovedByEmployeeId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByApprovedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByApprovedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByApprovedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByApprovedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByApprovedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByApprovedByEmployeeId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByApprovedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByCreatedByEmployeeId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $onBoardRequest->getCreatedByEmployeeId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByCreatedByEmployeeIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByCreatedByEmployeeId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByCreatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByCreatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByCreatedByEmployeeId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByCreatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByCreatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByCreatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByCreatedByEmployeeId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByCreatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByCreatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByCreatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByCreatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByCreatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByCreatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByCreatedByEmployeeId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByCreatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByCreatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByFinalApprovedByEmployeeId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $onBoardRequest->getFinalApprovedByEmployeeId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByFinalApprovedByEmployeeId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByFinalApprovedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByFinalApprovedByEmployeeId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByFinalApprovedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByFinalApprovedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByFinalApprovedByEmployeeId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByFinalApprovedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByFinalApprovedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByFinalApprovedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByFinalApprovedByEmployeeId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByFinalApprovedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByFinalApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByOnBoardRequestRelatedByUpdatedByEmployeeId($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $onBoardRequest->getUpdatedByEmployeeId(), $comparison);

            return $this;
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestRelatedByUpdatedByEmployeeIdQuery()
                ->filterByPrimaryKeys($onBoardRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestRelatedByUpdatedByEmployeeId() only accepts arguments of type \entities\OnBoardRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestRelatedByUpdatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestRelatedByUpdatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestRelatedByUpdatedByEmployeeId');

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
            $this->addJoinObject($join, 'OnBoardRequestRelatedByUpdatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation OnBoardRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestRelatedByUpdatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestRelatedByUpdatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestRelatedByUpdatedByEmployeeId', '\entities\OnBoardRequestQuery');
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation OnBoardRequest object
     *
     * @param callable(\entities\OnBoardRequestQuery):\entities\OnBoardRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestRelatedByUpdatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestRelatedByUpdatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation to the OnBoardRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestRelatedByUpdatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation to the OnBoardRequest table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestRelatedByUpdatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestRelatedByUpdatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useExistsQuery('OnBoardRequestRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation to the OnBoardRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestRelatedByUpdatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the OnBoardRequestRelatedByUpdatedByEmployeeId relation to the OnBoardRequest table for a NOT IN query.
     *
     * @see useOnBoardRequestRelatedByUpdatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestRelatedByUpdatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestQuery */
        $q = $this->useInQuery('OnBoardRequestRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $onBoardRequestLog->getEmployeeId(), $comparison);

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
     * Filter the query by a related \entities\Orders object
     *
     * @param \entities\Orders|ObjectCollection $orders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrders($orders, ?string $comparison = null)
    {
        if ($orders instanceof \entities\Orders) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $orders->getEmployeeId(), $comparison);

            return $this;
        } elseif ($orders instanceof ObjectCollection) {
            $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \entities\Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\entities\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\entities\OrdersQuery):\entities\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Orders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrdersQuery The inner query object of the IN statement
     */
    public function useInOrdersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Orders table for a NOT IN query.
     *
     * @see useOrdersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrdersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrdersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrdersQuery */
        $q = $this->useInQuery('Orders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OtpRequests object
     *
     * @param \entities\OtpRequests|ObjectCollection $otpRequests the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOtpRequests($otpRequests, ?string $comparison = null)
    {
        if ($otpRequests instanceof \entities\OtpRequests) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $otpRequests->getOtpRequestEmployee(), $comparison);

            return $this;
        } elseif ($otpRequests instanceof ObjectCollection) {
            $this
                ->useOtpRequestsQuery()
                ->filterByPrimaryKeys($otpRequests->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOtpRequests() only accepts arguments of type \entities\OtpRequests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OtpRequests relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOtpRequests(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OtpRequests');

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
            $this->addJoinObject($join, 'OtpRequests');
        }

        return $this;
    }

    /**
     * Use the OtpRequests relation OtpRequests object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OtpRequestsQuery A secondary query class using the current class as primary query
     */
    public function useOtpRequestsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOtpRequests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OtpRequests', '\entities\OtpRequestsQuery');
    }

    /**
     * Use the OtpRequests relation OtpRequests object
     *
     * @param callable(\entities\OtpRequestsQuery):\entities\OtpRequestsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOtpRequestsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOtpRequestsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OtpRequests table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OtpRequestsQuery The inner query object of the EXISTS statement
     */
    public function useOtpRequestsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OtpRequestsQuery */
        $q = $this->useExistsQuery('OtpRequests', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OtpRequests table for a NOT EXISTS query.
     *
     * @see useOtpRequestsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OtpRequestsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOtpRequestsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OtpRequestsQuery */
        $q = $this->useExistsQuery('OtpRequests', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OtpRequests table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OtpRequestsQuery The inner query object of the IN statement
     */
    public function useInOtpRequestsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OtpRequestsQuery */
        $q = $this->useInQuery('OtpRequests', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OtpRequests table for a NOT IN query.
     *
     * @see useOtpRequestsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OtpRequestsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOtpRequestsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OtpRequestsQuery */
        $q = $this->useInQuery('OtpRequests', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $outlets->getOutletCreatedBy(), $comparison);

            return $this;
        } elseif ($outlets instanceof ObjectCollection) {
            $this
                ->useOutletsQuery()
                ->filterByPrimaryKeys($outlets->getPrimaryKeys())
                ->endUse();

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
    public function joinOutlets(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useOutletsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $reminders->getEmployeeId(), $comparison);

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
     * Filter the query by a related \entities\SalaryAttendanceBackdateTrackLog object
     *
     * @param \entities\SalaryAttendanceBackdateTrackLog|ObjectCollection $salaryAttendanceBackdateTrackLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalaryAttendanceBackdateTrackLog($salaryAttendanceBackdateTrackLog, ?string $comparison = null)
    {
        if ($salaryAttendanceBackdateTrackLog instanceof \entities\SalaryAttendanceBackdateTrackLog) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $salaryAttendanceBackdateTrackLog->getEmployeeId(), $comparison);

            return $this;
        } elseif ($salaryAttendanceBackdateTrackLog instanceof ObjectCollection) {
            $this
                ->useSalaryAttendanceBackdateTrackLogQuery()
                ->filterByPrimaryKeys($salaryAttendanceBackdateTrackLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalaryAttendanceBackdateTrackLog() only accepts arguments of type \entities\SalaryAttendanceBackdateTrackLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalaryAttendanceBackdateTrackLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalaryAttendanceBackdateTrackLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalaryAttendanceBackdateTrackLog');

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
            $this->addJoinObject($join, 'SalaryAttendanceBackdateTrackLog');
        }

        return $this;
    }

    /**
     * Use the SalaryAttendanceBackdateTrackLog relation SalaryAttendanceBackdateTrackLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SalaryAttendanceBackdateTrackLogQuery A secondary query class using the current class as primary query
     */
    public function useSalaryAttendanceBackdateTrackLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalaryAttendanceBackdateTrackLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalaryAttendanceBackdateTrackLog', '\entities\SalaryAttendanceBackdateTrackLogQuery');
    }

    /**
     * Use the SalaryAttendanceBackdateTrackLog relation SalaryAttendanceBackdateTrackLog object
     *
     * @param callable(\entities\SalaryAttendanceBackdateTrackLogQuery):\entities\SalaryAttendanceBackdateTrackLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalaryAttendanceBackdateTrackLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalaryAttendanceBackdateTrackLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SalaryAttendanceBackdateTrackLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SalaryAttendanceBackdateTrackLogQuery The inner query object of the EXISTS statement
     */
    public function useSalaryAttendanceBackdateTrackLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SalaryAttendanceBackdateTrackLogQuery */
        $q = $this->useExistsQuery('SalaryAttendanceBackdateTrackLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SalaryAttendanceBackdateTrackLog table for a NOT EXISTS query.
     *
     * @see useSalaryAttendanceBackdateTrackLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SalaryAttendanceBackdateTrackLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalaryAttendanceBackdateTrackLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SalaryAttendanceBackdateTrackLogQuery */
        $q = $this->useExistsQuery('SalaryAttendanceBackdateTrackLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SalaryAttendanceBackdateTrackLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SalaryAttendanceBackdateTrackLogQuery The inner query object of the IN statement
     */
    public function useInSalaryAttendanceBackdateTrackLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SalaryAttendanceBackdateTrackLogQuery */
        $q = $this->useInQuery('SalaryAttendanceBackdateTrackLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SalaryAttendanceBackdateTrackLog table for a NOT IN query.
     *
     * @see useSalaryAttendanceBackdateTrackLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SalaryAttendanceBackdateTrackLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalaryAttendanceBackdateTrackLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SalaryAttendanceBackdateTrackLogQuery */
        $q = $this->useInQuery('SalaryAttendanceBackdateTrackLog', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $surveySubmited->getEmployeeId(), $comparison);

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
     * Filter the query by a related \entities\TicketReplies object
     *
     * @param \entities\TicketReplies|ObjectCollection $ticketReplies the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTicketReplies($ticketReplies, ?string $comparison = null)
    {
        if ($ticketReplies instanceof \entities\TicketReplies) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $ticketReplies->getEmployeeId(), $comparison);

            return $this;
        } elseif ($ticketReplies instanceof ObjectCollection) {
            $this
                ->useTicketRepliesQuery()
                ->filterByPrimaryKeys($ticketReplies->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTicketReplies() only accepts arguments of type \entities\TicketReplies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TicketReplies relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTicketReplies(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TicketReplies');

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
            $this->addJoinObject($join, 'TicketReplies');
        }

        return $this;
    }

    /**
     * Use the TicketReplies relation TicketReplies object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketRepliesQuery A secondary query class using the current class as primary query
     */
    public function useTicketRepliesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTicketReplies($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TicketReplies', '\entities\TicketRepliesQuery');
    }

    /**
     * Use the TicketReplies relation TicketReplies object
     *
     * @param callable(\entities\TicketRepliesQuery):\entities\TicketRepliesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketRepliesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTicketRepliesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to TicketReplies table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketRepliesQuery The inner query object of the EXISTS statement
     */
    public function useTicketRepliesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketRepliesQuery */
        $q = $this->useExistsQuery('TicketReplies', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to TicketReplies table for a NOT EXISTS query.
     *
     * @see useTicketRepliesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketRepliesQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketRepliesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketRepliesQuery */
        $q = $this->useExistsQuery('TicketReplies', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to TicketReplies table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketRepliesQuery The inner query object of the IN statement
     */
    public function useInTicketRepliesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketRepliesQuery */
        $q = $this->useInQuery('TicketReplies', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to TicketReplies table for a NOT IN query.
     *
     * @see useTicketRepliesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketRepliesQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketRepliesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketRepliesQuery */
        $q = $this->useInQuery('TicketReplies', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\TicketType object
     *
     * @param \entities\TicketType|ObjectCollection $ticketType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTicketType($ticketType, ?string $comparison = null)
    {
        if ($ticketType instanceof \entities\TicketType) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $ticketType->getEmployeeId(), $comparison);

            return $this;
        } elseif ($ticketType instanceof ObjectCollection) {
            $this
                ->useTicketTypeQuery()
                ->filterByPrimaryKeys($ticketType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTicketType() only accepts arguments of type \entities\TicketType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TicketType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTicketType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TicketType');

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
            $this->addJoinObject($join, 'TicketType');
        }

        return $this;
    }

    /**
     * Use the TicketType relation TicketType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketTypeQuery A secondary query class using the current class as primary query
     */
    public function useTicketTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTicketType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TicketType', '\entities\TicketTypeQuery');
    }

    /**
     * Use the TicketType relation TicketType object
     *
     * @param callable(\entities\TicketTypeQuery):\entities\TicketTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTicketTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to TicketType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketTypeQuery The inner query object of the EXISTS statement
     */
    public function useTicketTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketTypeQuery */
        $q = $this->useExistsQuery('TicketType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to TicketType table for a NOT EXISTS query.
     *
     * @see useTicketTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketTypeQuery */
        $q = $this->useExistsQuery('TicketType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to TicketType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketTypeQuery The inner query object of the IN statement
     */
    public function useInTicketTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketTypeQuery */
        $q = $this->useInQuery('TicketType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to TicketType table for a NOT IN query.
     *
     * @see useTicketTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketTypeQuery */
        $q = $this->useInQuery('TicketType', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByTicketsRelatedByEmployeeId($tickets, ?string $comparison = null)
    {
        if ($tickets instanceof \entities\Tickets) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $tickets->getEmployeeId(), $comparison);

            return $this;
        } elseif ($tickets instanceof ObjectCollection) {
            $this
                ->useTicketsRelatedByEmployeeIdQuery()
                ->filterByPrimaryKeys($tickets->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTicketsRelatedByEmployeeId() only accepts arguments of type \entities\Tickets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TicketsRelatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTicketsRelatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TicketsRelatedByEmployeeId');

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
            $this->addJoinObject($join, 'TicketsRelatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation Tickets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketsQuery A secondary query class using the current class as primary query
     */
    public function useTicketsRelatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTicketsRelatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TicketsRelatedByEmployeeId', '\entities\TicketsQuery');
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation Tickets object
     *
     * @param callable(\entities\TicketsQuery):\entities\TicketsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketsRelatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTicketsRelatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation to the Tickets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketsQuery The inner query object of the EXISTS statement
     */
    public function useTicketsRelatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('TicketsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation to the Tickets table for a NOT EXISTS query.
     *
     * @see useTicketsRelatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketsRelatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('TicketsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation to the Tickets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketsQuery The inner query object of the IN statement
     */
    public function useInTicketsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('TicketsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TicketsRelatedByEmployeeId relation to the Tickets table for a NOT IN query.
     *
     * @see useTicketsRelatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('TicketsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByTicketsRelatedByAllocatedTo($tickets, ?string $comparison = null)
    {
        if ($tickets instanceof \entities\Tickets) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $tickets->getAllocatedTo(), $comparison);

            return $this;
        } elseif ($tickets instanceof ObjectCollection) {
            $this
                ->useTicketsRelatedByAllocatedToQuery()
                ->filterByPrimaryKeys($tickets->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTicketsRelatedByAllocatedTo() only accepts arguments of type \entities\Tickets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TicketsRelatedByAllocatedTo relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTicketsRelatedByAllocatedTo(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TicketsRelatedByAllocatedTo');

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
            $this->addJoinObject($join, 'TicketsRelatedByAllocatedTo');
        }

        return $this;
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation Tickets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TicketsQuery A secondary query class using the current class as primary query
     */
    public function useTicketsRelatedByAllocatedToQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTicketsRelatedByAllocatedTo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TicketsRelatedByAllocatedTo', '\entities\TicketsQuery');
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation Tickets object
     *
     * @param callable(\entities\TicketsQuery):\entities\TicketsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTicketsRelatedByAllocatedToQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTicketsRelatedByAllocatedToQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation to the Tickets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TicketsQuery The inner query object of the EXISTS statement
     */
    public function useTicketsRelatedByAllocatedToExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('TicketsRelatedByAllocatedTo', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation to the Tickets table for a NOT EXISTS query.
     *
     * @see useTicketsRelatedByAllocatedToExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTicketsRelatedByAllocatedToNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useExistsQuery('TicketsRelatedByAllocatedTo', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation to the Tickets table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TicketsQuery The inner query object of the IN statement
     */
    public function useInTicketsRelatedByAllocatedToQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('TicketsRelatedByAllocatedTo', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TicketsRelatedByAllocatedTo relation to the Tickets table for a NOT IN query.
     *
     * @see useTicketsRelatedByAllocatedToInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TicketsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTicketsRelatedByAllocatedToQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TicketsQuery */
        $q = $this->useInQuery('TicketsRelatedByAllocatedTo', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Transactions object
     *
     * @param \entities\Transactions|ObjectCollection $transactions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransactionsRelatedByEmployeeId($transactions, ?string $comparison = null)
    {
        if ($transactions instanceof \entities\Transactions) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $transactions->getEmployeeId(), $comparison);

            return $this;
        } elseif ($transactions instanceof ObjectCollection) {
            $this
                ->useTransactionsRelatedByEmployeeIdQuery()
                ->filterByPrimaryKeys($transactions->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTransactionsRelatedByEmployeeId() only accepts arguments of type \entities\Transactions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransactionsRelatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTransactionsRelatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransactionsRelatedByEmployeeId');

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
            $this->addJoinObject($join, 'TransactionsRelatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation Transactions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TransactionsQuery A secondary query class using the current class as primary query
     */
    public function useTransactionsRelatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactionsRelatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionsRelatedByEmployeeId', '\entities\TransactionsQuery');
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation Transactions object
     *
     * @param callable(\entities\TransactionsQuery):\entities\TransactionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTransactionsRelatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTransactionsRelatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation to the Transactions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TransactionsQuery The inner query object of the EXISTS statement
     */
    public function useTransactionsRelatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('TransactionsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation to the Transactions table for a NOT EXISTS query.
     *
     * @see useTransactionsRelatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTransactionsRelatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('TransactionsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation to the Transactions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TransactionsQuery The inner query object of the IN statement
     */
    public function useInTransactionsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('TransactionsRelatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TransactionsRelatedByEmployeeId relation to the Transactions table for a NOT IN query.
     *
     * @see useTransactionsRelatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTransactionsRelatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('TransactionsRelatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Transactions object
     *
     * @param \entities\Transactions|ObjectCollection $transactions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransactionsRelatedByCreatedBy($transactions, ?string $comparison = null)
    {
        if ($transactions instanceof \entities\Transactions) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $transactions->getCreatedBy(), $comparison);

            return $this;
        } elseif ($transactions instanceof ObjectCollection) {
            $this
                ->useTransactionsRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($transactions->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTransactionsRelatedByCreatedBy() only accepts arguments of type \entities\Transactions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TransactionsRelatedByCreatedBy relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTransactionsRelatedByCreatedBy(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TransactionsRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'TransactionsRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation Transactions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TransactionsQuery A secondary query class using the current class as primary query
     */
    public function useTransactionsRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactionsRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TransactionsRelatedByCreatedBy', '\entities\TransactionsQuery');
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation Transactions object
     *
     * @param callable(\entities\TransactionsQuery):\entities\TransactionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTransactionsRelatedByCreatedByQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTransactionsRelatedByCreatedByQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation to the Transactions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TransactionsQuery The inner query object of the EXISTS statement
     */
    public function useTransactionsRelatedByCreatedByExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('TransactionsRelatedByCreatedBy', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation to the Transactions table for a NOT EXISTS query.
     *
     * @see useTransactionsRelatedByCreatedByExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTransactionsRelatedByCreatedByNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('TransactionsRelatedByCreatedBy', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation to the Transactions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TransactionsQuery The inner query object of the IN statement
     */
    public function useInTransactionsRelatedByCreatedByQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('TransactionsRelatedByCreatedBy', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TransactionsRelatedByCreatedBy relation to the Transactions table for a NOT IN query.
     *
     * @see useTransactionsRelatedByCreatedByInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTransactionsRelatedByCreatedByQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('TransactionsRelatedByCreatedBy', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Users object
     *
     * @param \entities\Users|ObjectCollection $users the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \entities\Users) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $users->getEmployeeId(), $comparison);

            return $this;
        } elseif ($users instanceof ObjectCollection) {
            $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \entities\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\entities\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\entities\UsersQuery):\entities\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Users table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\UsersQuery The inner query object of the IN statement
     */
    public function useInUsersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Users table for a NOT IN query.
     *
     * @see useUsersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\UsersQuery The inner query object of the NOT IN statement
     */
    public function useNotInUsersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\UsersQuery */
        $q = $this->useInQuery('Users', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfLog object
     *
     * @param \entities\WfLog|ObjectCollection $wfLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfLog($wfLog, ?string $comparison = null)
    {
        if ($wfLog instanceof \entities\WfLog) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $wfLog->getWfEmployeeId(), $comparison);

            return $this;
        } elseif ($wfLog instanceof ObjectCollection) {
            $this
                ->useWfLogQuery()
                ->filterByPrimaryKeys($wfLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfLog() only accepts arguments of type \entities\WfLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfLog');

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
            $this->addJoinObject($join, 'WfLog');
        }

        return $this;
    }

    /**
     * Use the WfLog relation WfLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfLogQuery A secondary query class using the current class as primary query
     */
    public function useWfLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfLog', '\entities\WfLogQuery');
    }

    /**
     * Use the WfLog relation WfLog object
     *
     * @param callable(\entities\WfLogQuery):\entities\WfLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfLogQuery The inner query object of the EXISTS statement
     */
    public function useWfLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useExistsQuery('WfLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfLog table for a NOT EXISTS query.
     *
     * @see useWfLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useExistsQuery('WfLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfLogQuery The inner query object of the IN statement
     */
    public function useInWfLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useInQuery('WfLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfLog table for a NOT IN query.
     *
     * @see useWfLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfLogQuery */
        $q = $this->useInQuery('WfLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\WfRequests object
     *
     * @param \entities\WfRequests|ObjectCollection $wfRequests the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWfRequests($wfRequests, ?string $comparison = null)
    {
        if ($wfRequests instanceof \entities\WfRequests) {
            $this
                ->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $wfRequests->getWfReqEmployee(), $comparison);

            return $this;
        } elseif ($wfRequests instanceof ObjectCollection) {
            $this
                ->useWfRequestsQuery()
                ->filterByPrimaryKeys($wfRequests->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWfRequests() only accepts arguments of type \entities\WfRequests or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WfRequests relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWfRequests(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WfRequests');

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
            $this->addJoinObject($join, 'WfRequests');
        }

        return $this;
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WfRequestsQuery A secondary query class using the current class as primary query
     */
    public function useWfRequestsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWfRequests($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WfRequests', '\entities\WfRequestsQuery');
    }

    /**
     * Use the WfRequests relation WfRequests object
     *
     * @param callable(\entities\WfRequestsQuery):\entities\WfRequestsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWfRequestsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWfRequestsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WfRequests table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WfRequestsQuery The inner query object of the EXISTS statement
     */
    public function useWfRequestsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT EXISTS query.
     *
     * @see useWfRequestsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT EXISTS statement
     */
    public function useWfRequestsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useExistsQuery('WfRequests', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WfRequests table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WfRequestsQuery The inner query object of the IN statement
     */
    public function useInWfRequestsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WfRequests table for a NOT IN query.
     *
     * @see useWfRequestsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WfRequestsQuery The inner query object of the NOT IN statement
     */
    public function useNotInWfRequestsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WfRequestsQuery */
        $q = $this->useInQuery('WfRequests', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildEmployee $employee Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($employee = null)
    {
        if ($employee) {
            $this->addUsingAlias(EmployeeTableMap::COL_EMPLOYEE_ID, $employee->getEmployeeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmployeeTableMap::clearInstancePool();
            EmployeeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmployeeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmployeeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmployeeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

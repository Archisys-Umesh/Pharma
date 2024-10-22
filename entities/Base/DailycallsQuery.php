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
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\Map\DailycallsTableMap;

/**
 * Base class that represents a query for the `dailycalls` table.
 *
 * @method     ChildDailycallsQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildDailycallsQuery orderByDayPlanId($order = Criteria::ASC) Order by the day_plan_id column
 * @method     ChildDailycallsQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildDailycallsQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildDailycallsQuery orderByAgendacontroltype($order = Criteria::ASC) Order by the agendacontroltype column
 * @method     ChildDailycallsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildDailycallsQuery orderByAgendaId($order = Criteria::ASC) Order by the agenda_id column
 * @method     ChildDailycallsQuery orderByIsjw($order = Criteria::ASC) Order by the isjw column
 * @method     ChildDailycallsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDailycallsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDailycallsQuery orderByDcrDate($order = Criteria::ASC) Order by the dcr_date column
 * @method     ChildDailycallsQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildDailycallsQuery orderByManagers($order = Criteria::ASC) Order by the managers column
 * @method     ChildDailycallsQuery orderBySgpiOut($order = Criteria::ASC) Order by the sgpi_out column
 * @method     ChildDailycallsQuery orderByOutletFeedback($order = Criteria::ASC) Order by the outlet_feedback column
 * @method     ChildDailycallsQuery orderByEmployeeFeedback($order = Criteria::ASC) Order by the employee_feedback column
 * @method     ChildDailycallsQuery orderByBrandsDetailed($order = Criteria::ASC) Order by the brands_detailed column
 * @method     ChildDailycallsQuery orderByNcaComments($order = Criteria::ASC) Order by the nca_comments column
 * @method     ChildDailycallsQuery orderByDeviceTime($order = Criteria::ASC) Order by the device_time column
 * @method     ChildDailycallsQuery orderByIsprocessed($order = Criteria::ASC) Order by the isprocessed column
 * @method     ChildDailycallsQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildDailycallsQuery orderByDeviceMake($order = Criteria::ASC) Order by the device_make column
 * @method     ChildDailycallsQuery orderByEdSessionId($order = Criteria::ASC) Order by the ed_session_id column
 * @method     ChildDailycallsQuery orderByDcrStatus($order = Criteria::ASC) Order by the dcr_status column
 * @method     ChildDailycallsQuery orderByRcpaDone($order = Criteria::ASC) Order by the rcpa_done column
 * @method     ChildDailycallsQuery orderByHasSgpi($order = Criteria::ASC) Order by the has_sgpi column
 * @method     ChildDailycallsQuery orderByMrEmp($order = Criteria::ASC) Order by the mr_emp column
 * @method     ChildDailycallsQuery orderByMrName($order = Criteria::ASC) Order by the mr_name column
 * @method     ChildDailycallsQuery orderByMrMediaId($order = Criteria::ASC) Order by the mr_media_id column
 * @method     ChildDailycallsQuery orderByEdDuration($order = Criteria::ASC) Order by the ed_duration column
 * @method     ChildDailycallsQuery orderByCampiagnId($order = Criteria::ASC) Order by the campiagn_id column
 * @method     ChildDailycallsQuery orderByVisitPlanId($order = Criteria::ASC) Order by the visit_plan_id column
 * @method     ChildDailycallsQuery orderByNcaAttendees($order = Criteria::ASC) Order by the nca_attendees column
 * @method     ChildDailycallsQuery orderByDcrLatLong($order = Criteria::ASC) Order by the dcr_lat_long column
 * @method     ChildDailycallsQuery orderByDcrAddress($order = Criteria::ASC) Order by the dcr_address column
 *
 * @method     ChildDailycallsQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildDailycallsQuery groupByDayPlanId() Group by the day_plan_id column
 * @method     ChildDailycallsQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildDailycallsQuery groupByPositionId() Group by the position_id column
 * @method     ChildDailycallsQuery groupByAgendacontroltype() Group by the agendacontroltype column
 * @method     ChildDailycallsQuery groupByItownid() Group by the itownid column
 * @method     ChildDailycallsQuery groupByAgendaId() Group by the agenda_id column
 * @method     ChildDailycallsQuery groupByIsjw() Group by the isjw column
 * @method     ChildDailycallsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDailycallsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDailycallsQuery groupByDcrDate() Group by the dcr_date column
 * @method     ChildDailycallsQuery groupByCompanyId() Group by the company_id column
 * @method     ChildDailycallsQuery groupByManagers() Group by the managers column
 * @method     ChildDailycallsQuery groupBySgpiOut() Group by the sgpi_out column
 * @method     ChildDailycallsQuery groupByOutletFeedback() Group by the outlet_feedback column
 * @method     ChildDailycallsQuery groupByEmployeeFeedback() Group by the employee_feedback column
 * @method     ChildDailycallsQuery groupByBrandsDetailed() Group by the brands_detailed column
 * @method     ChildDailycallsQuery groupByNcaComments() Group by the nca_comments column
 * @method     ChildDailycallsQuery groupByDeviceTime() Group by the device_time column
 * @method     ChildDailycallsQuery groupByIsprocessed() Group by the isprocessed column
 * @method     ChildDailycallsQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildDailycallsQuery groupByDeviceMake() Group by the device_make column
 * @method     ChildDailycallsQuery groupByEdSessionId() Group by the ed_session_id column
 * @method     ChildDailycallsQuery groupByDcrStatus() Group by the dcr_status column
 * @method     ChildDailycallsQuery groupByRcpaDone() Group by the rcpa_done column
 * @method     ChildDailycallsQuery groupByHasSgpi() Group by the has_sgpi column
 * @method     ChildDailycallsQuery groupByMrEmp() Group by the mr_emp column
 * @method     ChildDailycallsQuery groupByMrName() Group by the mr_name column
 * @method     ChildDailycallsQuery groupByMrMediaId() Group by the mr_media_id column
 * @method     ChildDailycallsQuery groupByEdDuration() Group by the ed_duration column
 * @method     ChildDailycallsQuery groupByCampiagnId() Group by the campiagn_id column
 * @method     ChildDailycallsQuery groupByVisitPlanId() Group by the visit_plan_id column
 * @method     ChildDailycallsQuery groupByNcaAttendees() Group by the nca_attendees column
 * @method     ChildDailycallsQuery groupByDcrLatLong() Group by the dcr_lat_long column
 * @method     ChildDailycallsQuery groupByDcrAddress() Group by the dcr_address column
 *
 * @method     ChildDailycallsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDailycallsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDailycallsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDailycallsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDailycallsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDailycallsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDailycallsQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildDailycallsQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildDailycallsQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildDailycallsQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildDailycallsQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildDailycallsQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildDailycallsQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildDailycallsQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildDailycallsQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildDailycallsQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildDailycallsQuery leftJoinAgendatypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agendatypes relation
 * @method     ChildDailycallsQuery rightJoinAgendatypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agendatypes relation
 * @method     ChildDailycallsQuery innerJoinAgendatypes($relationAlias = null) Adds a INNER JOIN clause to the query using the Agendatypes relation
 *
 * @method     ChildDailycallsQuery joinWithAgendatypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Agendatypes relation
 *
 * @method     ChildDailycallsQuery leftJoinWithAgendatypes() Adds a LEFT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildDailycallsQuery rightJoinWithAgendatypes() Adds a RIGHT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildDailycallsQuery innerJoinWithAgendatypes() Adds a INNER JOIN clause and with to the query using the Agendatypes relation
 *
 * @method     ChildDailycallsQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildDailycallsQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildDailycallsQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildDailycallsQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildDailycallsQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildDailycallsQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildDailycallsQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildDailycallsQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildDailycallsQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildDailycallsQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildDailycallsQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildDailycallsQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildDailycallsQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildDailycallsQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildDailycallsQuery leftJoinBrandCampiagnVisits($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildDailycallsQuery rightJoinBrandCampiagnVisits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildDailycallsQuery innerJoinBrandCampiagnVisits($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildDailycallsQuery joinWithBrandCampiagnVisits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildDailycallsQuery leftJoinWithBrandCampiagnVisits() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildDailycallsQuery rightJoinWithBrandCampiagnVisits() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildDailycallsQuery innerJoinWithBrandCampiagnVisits() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildDailycallsQuery leftJoinDailycallsAttendees($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildDailycallsQuery rightJoinDailycallsAttendees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildDailycallsQuery innerJoinDailycallsAttendees($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsAttendees relation
 *
 * @method     ChildDailycallsQuery joinWithDailycallsAttendees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildDailycallsQuery leftJoinWithDailycallsAttendees() Adds a LEFT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildDailycallsQuery rightJoinWithDailycallsAttendees() Adds a RIGHT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildDailycallsQuery innerJoinWithDailycallsAttendees() Adds a INNER JOIN clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildDailycallsQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildDailycallsQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildDailycallsQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildDailycallsQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildDailycallsQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildDailycallsQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildDailycallsQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     \entities\CompanyQuery|\entities\OutletOrgDataQuery|\entities\AgendatypesQuery|\entities\PositionsQuery|\entities\GeoTownsQuery|\entities\BrandCampiagnVisitsQuery|\entities\DailycallsAttendeesQuery|\entities\SurveySubmitedQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDailycalls|null findOne(?ConnectionInterface $con = null) Return the first ChildDailycalls matching the query
 * @method     ChildDailycalls findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDailycalls matching the query, or a new ChildDailycalls object populated from the query conditions when no match is found
 *
 * @method     ChildDailycalls|null findOneByDcrId(int $dcr_id) Return the first ChildDailycalls filtered by the dcr_id column
 * @method     ChildDailycalls|null findOneByDayPlanId(int $day_plan_id) Return the first ChildDailycalls filtered by the day_plan_id column
 * @method     ChildDailycalls|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildDailycalls filtered by the outlet_org_data_id column
 * @method     ChildDailycalls|null findOneByPositionId(int $position_id) Return the first ChildDailycalls filtered by the position_id column
 * @method     ChildDailycalls|null findOneByAgendacontroltype(string $agendacontroltype) Return the first ChildDailycalls filtered by the agendacontroltype column
 * @method     ChildDailycalls|null findOneByItownid(string $itownid) Return the first ChildDailycalls filtered by the itownid column
 * @method     ChildDailycalls|null findOneByAgendaId(int $agenda_id) Return the first ChildDailycalls filtered by the agenda_id column
 * @method     ChildDailycalls|null findOneByIsjw(boolean $isjw) Return the first ChildDailycalls filtered by the isjw column
 * @method     ChildDailycalls|null findOneByCreatedAt(string $created_at) Return the first ChildDailycalls filtered by the created_at column
 * @method     ChildDailycalls|null findOneByUpdatedAt(string $updated_at) Return the first ChildDailycalls filtered by the updated_at column
 * @method     ChildDailycalls|null findOneByDcrDate(string $dcr_date) Return the first ChildDailycalls filtered by the dcr_date column
 * @method     ChildDailycalls|null findOneByCompanyId(int $company_id) Return the first ChildDailycalls filtered by the company_id column
 * @method     ChildDailycalls|null findOneByManagers(string $managers) Return the first ChildDailycalls filtered by the managers column
 * @method     ChildDailycalls|null findOneBySgpiOut(string $sgpi_out) Return the first ChildDailycalls filtered by the sgpi_out column
 * @method     ChildDailycalls|null findOneByOutletFeedback(string $outlet_feedback) Return the first ChildDailycalls filtered by the outlet_feedback column
 * @method     ChildDailycalls|null findOneByEmployeeFeedback(string $employee_feedback) Return the first ChildDailycalls filtered by the employee_feedback column
 * @method     ChildDailycalls|null findOneByBrandsDetailed(string $brands_detailed) Return the first ChildDailycalls filtered by the brands_detailed column
 * @method     ChildDailycalls|null findOneByNcaComments(string $nca_comments) Return the first ChildDailycalls filtered by the nca_comments column
 * @method     ChildDailycalls|null findOneByDeviceTime(string $device_time) Return the first ChildDailycalls filtered by the device_time column
 * @method     ChildDailycalls|null findOneByIsprocessed(boolean $isprocessed) Return the first ChildDailycalls filtered by the isprocessed column
 * @method     ChildDailycalls|null findOneByEmployeeId(int $employee_id) Return the first ChildDailycalls filtered by the employee_id column
 * @method     ChildDailycalls|null findOneByDeviceMake(string $device_make) Return the first ChildDailycalls filtered by the device_make column
 * @method     ChildDailycalls|null findOneByEdSessionId(string $ed_session_id) Return the first ChildDailycalls filtered by the ed_session_id column
 * @method     ChildDailycalls|null findOneByDcrStatus(string $dcr_status) Return the first ChildDailycalls filtered by the dcr_status column
 * @method     ChildDailycalls|null findOneByRcpaDone(int $rcpa_done) Return the first ChildDailycalls filtered by the rcpa_done column
 * @method     ChildDailycalls|null findOneByHasSgpi(int $has_sgpi) Return the first ChildDailycalls filtered by the has_sgpi column
 * @method     ChildDailycalls|null findOneByMrEmp(int $mr_emp) Return the first ChildDailycalls filtered by the mr_emp column
 * @method     ChildDailycalls|null findOneByMrName(string $mr_name) Return the first ChildDailycalls filtered by the mr_name column
 * @method     ChildDailycalls|null findOneByMrMediaId(int $mr_media_id) Return the first ChildDailycalls filtered by the mr_media_id column
 * @method     ChildDailycalls|null findOneByEdDuration(int $ed_duration) Return the first ChildDailycalls filtered by the ed_duration column
 * @method     ChildDailycalls|null findOneByCampiagnId(string $campiagn_id) Return the first ChildDailycalls filtered by the campiagn_id column
 * @method     ChildDailycalls|null findOneByVisitPlanId(string $visit_plan_id) Return the first ChildDailycalls filtered by the visit_plan_id column
 * @method     ChildDailycalls|null findOneByNcaAttendees(string $nca_attendees) Return the first ChildDailycalls filtered by the nca_attendees column
 * @method     ChildDailycalls|null findOneByDcrLatLong(string $dcr_lat_long) Return the first ChildDailycalls filtered by the dcr_lat_long column
 * @method     ChildDailycalls|null findOneByDcrAddress(string $dcr_address) Return the first ChildDailycalls filtered by the dcr_address column
 *
 * @method     ChildDailycalls requirePk($key, ?ConnectionInterface $con = null) Return the ChildDailycalls by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOne(?ConnectionInterface $con = null) Return the first ChildDailycalls matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycalls requireOneByDcrId(int $dcr_id) Return the first ChildDailycalls filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDayPlanId(int $day_plan_id) Return the first ChildDailycalls filtered by the day_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildDailycalls filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByPositionId(int $position_id) Return the first ChildDailycalls filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByAgendacontroltype(string $agendacontroltype) Return the first ChildDailycalls filtered by the agendacontroltype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByItownid(string $itownid) Return the first ChildDailycalls filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByAgendaId(int $agenda_id) Return the first ChildDailycalls filtered by the agenda_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByIsjw(boolean $isjw) Return the first ChildDailycalls filtered by the isjw column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByCreatedAt(string $created_at) Return the first ChildDailycalls filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByUpdatedAt(string $updated_at) Return the first ChildDailycalls filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDcrDate(string $dcr_date) Return the first ChildDailycalls filtered by the dcr_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByCompanyId(int $company_id) Return the first ChildDailycalls filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByManagers(string $managers) Return the first ChildDailycalls filtered by the managers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneBySgpiOut(string $sgpi_out) Return the first ChildDailycalls filtered by the sgpi_out column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByOutletFeedback(string $outlet_feedback) Return the first ChildDailycalls filtered by the outlet_feedback column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByEmployeeFeedback(string $employee_feedback) Return the first ChildDailycalls filtered by the employee_feedback column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByBrandsDetailed(string $brands_detailed) Return the first ChildDailycalls filtered by the brands_detailed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByNcaComments(string $nca_comments) Return the first ChildDailycalls filtered by the nca_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDeviceTime(string $device_time) Return the first ChildDailycalls filtered by the device_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByIsprocessed(boolean $isprocessed) Return the first ChildDailycalls filtered by the isprocessed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByEmployeeId(int $employee_id) Return the first ChildDailycalls filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDeviceMake(string $device_make) Return the first ChildDailycalls filtered by the device_make column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByEdSessionId(string $ed_session_id) Return the first ChildDailycalls filtered by the ed_session_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDcrStatus(string $dcr_status) Return the first ChildDailycalls filtered by the dcr_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByRcpaDone(int $rcpa_done) Return the first ChildDailycalls filtered by the rcpa_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByHasSgpi(int $has_sgpi) Return the first ChildDailycalls filtered by the has_sgpi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByMrEmp(int $mr_emp) Return the first ChildDailycalls filtered by the mr_emp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByMrName(string $mr_name) Return the first ChildDailycalls filtered by the mr_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByMrMediaId(int $mr_media_id) Return the first ChildDailycalls filtered by the mr_media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByEdDuration(int $ed_duration) Return the first ChildDailycalls filtered by the ed_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByCampiagnId(string $campiagn_id) Return the first ChildDailycalls filtered by the campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByVisitPlanId(string $visit_plan_id) Return the first ChildDailycalls filtered by the visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByNcaAttendees(string $nca_attendees) Return the first ChildDailycalls filtered by the nca_attendees column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDcrLatLong(string $dcr_lat_long) Return the first ChildDailycalls filtered by the dcr_lat_long column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDailycalls requireOneByDcrAddress(string $dcr_address) Return the first ChildDailycalls filtered by the dcr_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDailycalls[]|Collection find(?ConnectionInterface $con = null) Return ChildDailycalls objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDailycalls> find(?ConnectionInterface $con = null) Return ChildDailycalls objects based on current ModelCriteria
 *
 * @method     ChildDailycalls[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildDailycalls objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDcrId(int|array<int> $dcr_id) Return ChildDailycalls objects filtered by the dcr_id column
 * @method     ChildDailycalls[]|Collection findByDayPlanId(int|array<int> $day_plan_id) Return ChildDailycalls objects filtered by the day_plan_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDayPlanId(int|array<int> $day_plan_id) Return ChildDailycalls objects filtered by the day_plan_id column
 * @method     ChildDailycalls[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildDailycalls objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildDailycalls objects filtered by the outlet_org_data_id column
 * @method     ChildDailycalls[]|Collection findByPositionId(int|array<int> $position_id) Return ChildDailycalls objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByPositionId(int|array<int> $position_id) Return ChildDailycalls objects filtered by the position_id column
 * @method     ChildDailycalls[]|Collection findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildDailycalls objects filtered by the agendacontroltype column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByAgendacontroltype(string|array<string> $agendacontroltype) Return ChildDailycalls objects filtered by the agendacontroltype column
 * @method     ChildDailycalls[]|Collection findByItownid(string|array<string> $itownid) Return ChildDailycalls objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByItownid(string|array<string> $itownid) Return ChildDailycalls objects filtered by the itownid column
 * @method     ChildDailycalls[]|Collection findByAgendaId(int|array<int> $agenda_id) Return ChildDailycalls objects filtered by the agenda_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByAgendaId(int|array<int> $agenda_id) Return ChildDailycalls objects filtered by the agenda_id column
 * @method     ChildDailycalls[]|Collection findByIsjw(boolean|array<boolean> $isjw) Return ChildDailycalls objects filtered by the isjw column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByIsjw(boolean|array<boolean> $isjw) Return ChildDailycalls objects filtered by the isjw column
 * @method     ChildDailycalls[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildDailycalls objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByCreatedAt(string|array<string> $created_at) Return ChildDailycalls objects filtered by the created_at column
 * @method     ChildDailycalls[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycalls objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByUpdatedAt(string|array<string> $updated_at) Return ChildDailycalls objects filtered by the updated_at column
 * @method     ChildDailycalls[]|Collection findByDcrDate(string|array<string> $dcr_date) Return ChildDailycalls objects filtered by the dcr_date column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDcrDate(string|array<string> $dcr_date) Return ChildDailycalls objects filtered by the dcr_date column
 * @method     ChildDailycalls[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildDailycalls objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByCompanyId(int|array<int> $company_id) Return ChildDailycalls objects filtered by the company_id column
 * @method     ChildDailycalls[]|Collection findByManagers(string|array<string> $managers) Return ChildDailycalls objects filtered by the managers column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByManagers(string|array<string> $managers) Return ChildDailycalls objects filtered by the managers column
 * @method     ChildDailycalls[]|Collection findBySgpiOut(string|array<string> $sgpi_out) Return ChildDailycalls objects filtered by the sgpi_out column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findBySgpiOut(string|array<string> $sgpi_out) Return ChildDailycalls objects filtered by the sgpi_out column
 * @method     ChildDailycalls[]|Collection findByOutletFeedback(string|array<string> $outlet_feedback) Return ChildDailycalls objects filtered by the outlet_feedback column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByOutletFeedback(string|array<string> $outlet_feedback) Return ChildDailycalls objects filtered by the outlet_feedback column
 * @method     ChildDailycalls[]|Collection findByEmployeeFeedback(string|array<string> $employee_feedback) Return ChildDailycalls objects filtered by the employee_feedback column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByEmployeeFeedback(string|array<string> $employee_feedback) Return ChildDailycalls objects filtered by the employee_feedback column
 * @method     ChildDailycalls[]|Collection findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildDailycalls objects filtered by the brands_detailed column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByBrandsDetailed(string|array<string> $brands_detailed) Return ChildDailycalls objects filtered by the brands_detailed column
 * @method     ChildDailycalls[]|Collection findByNcaComments(string|array<string> $nca_comments) Return ChildDailycalls objects filtered by the nca_comments column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByNcaComments(string|array<string> $nca_comments) Return ChildDailycalls objects filtered by the nca_comments column
 * @method     ChildDailycalls[]|Collection findByDeviceTime(string|array<string> $device_time) Return ChildDailycalls objects filtered by the device_time column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDeviceTime(string|array<string> $device_time) Return ChildDailycalls objects filtered by the device_time column
 * @method     ChildDailycalls[]|Collection findByIsprocessed(boolean|array<boolean> $isprocessed) Return ChildDailycalls objects filtered by the isprocessed column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByIsprocessed(boolean|array<boolean> $isprocessed) Return ChildDailycalls objects filtered by the isprocessed column
 * @method     ChildDailycalls[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildDailycalls objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByEmployeeId(int|array<int> $employee_id) Return ChildDailycalls objects filtered by the employee_id column
 * @method     ChildDailycalls[]|Collection findByDeviceMake(string|array<string> $device_make) Return ChildDailycalls objects filtered by the device_make column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDeviceMake(string|array<string> $device_make) Return ChildDailycalls objects filtered by the device_make column
 * @method     ChildDailycalls[]|Collection findByEdSessionId(string|array<string> $ed_session_id) Return ChildDailycalls objects filtered by the ed_session_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByEdSessionId(string|array<string> $ed_session_id) Return ChildDailycalls objects filtered by the ed_session_id column
 * @method     ChildDailycalls[]|Collection findByDcrStatus(string|array<string> $dcr_status) Return ChildDailycalls objects filtered by the dcr_status column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDcrStatus(string|array<string> $dcr_status) Return ChildDailycalls objects filtered by the dcr_status column
 * @method     ChildDailycalls[]|Collection findByRcpaDone(int|array<int> $rcpa_done) Return ChildDailycalls objects filtered by the rcpa_done column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByRcpaDone(int|array<int> $rcpa_done) Return ChildDailycalls objects filtered by the rcpa_done column
 * @method     ChildDailycalls[]|Collection findByHasSgpi(int|array<int> $has_sgpi) Return ChildDailycalls objects filtered by the has_sgpi column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByHasSgpi(int|array<int> $has_sgpi) Return ChildDailycalls objects filtered by the has_sgpi column
 * @method     ChildDailycalls[]|Collection findByMrEmp(int|array<int> $mr_emp) Return ChildDailycalls objects filtered by the mr_emp column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByMrEmp(int|array<int> $mr_emp) Return ChildDailycalls objects filtered by the mr_emp column
 * @method     ChildDailycalls[]|Collection findByMrName(string|array<string> $mr_name) Return ChildDailycalls objects filtered by the mr_name column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByMrName(string|array<string> $mr_name) Return ChildDailycalls objects filtered by the mr_name column
 * @method     ChildDailycalls[]|Collection findByMrMediaId(int|array<int> $mr_media_id) Return ChildDailycalls objects filtered by the mr_media_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByMrMediaId(int|array<int> $mr_media_id) Return ChildDailycalls objects filtered by the mr_media_id column
 * @method     ChildDailycalls[]|Collection findByEdDuration(int|array<int> $ed_duration) Return ChildDailycalls objects filtered by the ed_duration column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByEdDuration(int|array<int> $ed_duration) Return ChildDailycalls objects filtered by the ed_duration column
 * @method     ChildDailycalls[]|Collection findByCampiagnId(string|array<string> $campiagn_id) Return ChildDailycalls objects filtered by the campiagn_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByCampiagnId(string|array<string> $campiagn_id) Return ChildDailycalls objects filtered by the campiagn_id column
 * @method     ChildDailycalls[]|Collection findByVisitPlanId(string|array<string> $visit_plan_id) Return ChildDailycalls objects filtered by the visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByVisitPlanId(string|array<string> $visit_plan_id) Return ChildDailycalls objects filtered by the visit_plan_id column
 * @method     ChildDailycalls[]|Collection findByNcaAttendees(string|array<string> $nca_attendees) Return ChildDailycalls objects filtered by the nca_attendees column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByNcaAttendees(string|array<string> $nca_attendees) Return ChildDailycalls objects filtered by the nca_attendees column
 * @method     ChildDailycalls[]|Collection findByDcrLatLong(string|array<string> $dcr_lat_long) Return ChildDailycalls objects filtered by the dcr_lat_long column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDcrLatLong(string|array<string> $dcr_lat_long) Return ChildDailycalls objects filtered by the dcr_lat_long column
 * @method     ChildDailycalls[]|Collection findByDcrAddress(string|array<string> $dcr_address) Return ChildDailycalls objects filtered by the dcr_address column
 * @psalm-method Collection&\Traversable<ChildDailycalls> findByDcrAddress(string|array<string> $dcr_address) Return ChildDailycalls objects filtered by the dcr_address column
 *
 * @method     ChildDailycalls[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDailycalls> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DailycallsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\DailycallsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Dailycalls', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDailycallsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDailycallsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDailycallsQuery) {
            return $criteria;
        }
        $query = new ChildDailycallsQuery();
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
     * @return ChildDailycalls|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DailycallsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DailycallsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDailycalls A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT dcr_id, day_plan_id, outlet_org_data_id, position_id, agendacontroltype, itownid, agenda_id, isjw, created_at, updated_at, dcr_date, company_id, managers, sgpi_out, outlet_feedback, employee_feedback, brands_detailed, nca_comments, device_time, isprocessed, employee_id, device_make, ed_session_id, dcr_status, rcpa_done, has_sgpi, mr_emp, mr_name, mr_media_id, ed_duration, campiagn_id, visit_plan_id, nca_attendees, dcr_lat_long, dcr_address FROM dailycalls WHERE dcr_id = :p0';
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
            /** @var ChildDailycalls $obj */
            $obj = new ChildDailycalls();
            $obj->hydrate($row);
            DailycallsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDailycalls|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the dcr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrId(1234); // WHERE dcr_id = 1234
     * $query->filterByDcrId(array(12, 34)); // WHERE dcr_id IN (12, 34)
     * $query->filterByDcrId(array('min' => 12)); // WHERE dcr_id > 12
     * </code>
     *
     * @param mixed $dcrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrId($dcrId = null, ?string $comparison = null)
    {
        if (is_array($dcrId)) {
            $useMinMax = false;
            if (isset($dcrId['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $dcrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the day_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDayPlanId(1234); // WHERE day_plan_id = 1234
     * $query->filterByDayPlanId(array(12, 34)); // WHERE day_plan_id IN (12, 34)
     * $query->filterByDayPlanId(array('min' => 12)); // WHERE day_plan_id > 12
     * </code>
     *
     * @param mixed $dayPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDayPlanId($dayPlanId = null, ?string $comparison = null)
    {
        if (is_array($dayPlanId)) {
            $useMinMax = false;
            if (isset($dayPlanId['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DAY_PLAN_ID, $dayPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayPlanId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DAY_PLAN_ID, $dayPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DAY_PLAN_ID, $dayPlanId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_org_data_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOrgDataId(1234); // WHERE outlet_org_data_id = 1234
     * $query->filterByOutletOrgDataId(array(12, 34)); // WHERE outlet_org_data_id IN (12, 34)
     * $query->filterByOutletOrgDataId(array('min' => 12)); // WHERE outlet_org_data_id > 12
     * </code>
     *
     * @see       filterByOutletOrgData()
     *
     * @param mixed $outletOrgDataId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgDataId($outletOrgDataId = null, ?string $comparison = null)
    {
        if (is_array($outletOrgDataId)) {
            $useMinMax = false;
            if (isset($outletOrgDataId['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

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
     * @see       filterByPositions()
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
                $this->addUsingAlias(DailycallsTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agendacontroltype column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendacontroltype('fooValue');   // WHERE agendacontroltype = 'fooValue'
     * $query->filterByAgendacontroltype('%fooValue%', Criteria::LIKE); // WHERE agendacontroltype LIKE '%fooValue%'
     * $query->filterByAgendacontroltype(['foo', 'bar']); // WHERE agendacontroltype IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendacontroltype The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendacontroltype($agendacontroltype = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendacontroltype)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_AGENDACONTROLTYPE, $agendacontroltype, $comparison);

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
                $this->addUsingAlias(DailycallsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaId(1234); // WHERE agenda_id = 1234
     * $query->filterByAgendaId(array(12, 34)); // WHERE agenda_id IN (12, 34)
     * $query->filterByAgendaId(array('min' => 12)); // WHERE agenda_id > 12
     * </code>
     *
     * @see       filterByAgendatypes()
     *
     * @param mixed $agendaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaId($agendaId = null, ?string $comparison = null)
    {
        if (is_array($agendaId)) {
            $useMinMax = false;
            if (isset($agendaId['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_AGENDA_ID, $agendaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agendaId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_AGENDA_ID, $agendaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_AGENDA_ID, $agendaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isjw column
     *
     * Example usage:
     * <code>
     * $query->filterByIsjw(true); // WHERE isjw = true
     * $query->filterByIsjw('yes'); // WHERE isjw = true
     * </code>
     *
     * @param bool|string $isjw The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsjw($isjw = null, ?string $comparison = null)
    {
        if (is_string($isjw)) {
            $isjw = in_array(strtolower($isjw), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DailycallsTableMap::COL_ISJW, $isjw, $comparison);

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
                $this->addUsingAlias(DailycallsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(DailycallsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrDate('2011-03-14'); // WHERE dcr_date = '2011-03-14'
     * $query->filterByDcrDate('now'); // WHERE dcr_date = '2011-03-14'
     * $query->filterByDcrDate(array('max' => 'yesterday')); // WHERE dcr_date > '2011-03-13'
     * </code>
     *
     * @param mixed $dcrDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrDate($dcrDate = null, ?string $comparison = null)
    {
        if (is_array($dcrDate)) {
            $useMinMax = false;
            if (isset($dcrDate['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DCR_DATE, $dcrDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrDate['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DCR_DATE, $dcrDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_DATE, $dcrDate, $comparison);

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
                $this->addUsingAlias(DailycallsTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the managers column
     *
     * Example usage:
     * <code>
     * $query->filterByManagers('fooValue');   // WHERE managers = 'fooValue'
     * $query->filterByManagers('%fooValue%', Criteria::LIKE); // WHERE managers LIKE '%fooValue%'
     * $query->filterByManagers(['foo', 'bar']); // WHERE managers IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $managers The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManagers($managers = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($managers)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_MANAGERS, $managers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_out column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiOut('fooValue');   // WHERE sgpi_out = 'fooValue'
     * $query->filterBySgpiOut('%fooValue%', Criteria::LIKE); // WHERE sgpi_out LIKE '%fooValue%'
     * $query->filterBySgpiOut(['foo', 'bar']); // WHERE sgpi_out IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiOut The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiOut($sgpiOut = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiOut)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_SGPI_OUT, $sgpiOut, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_feedback column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletFeedback('fooValue');   // WHERE outlet_feedback = 'fooValue'
     * $query->filterByOutletFeedback('%fooValue%', Criteria::LIKE); // WHERE outlet_feedback LIKE '%fooValue%'
     * $query->filterByOutletFeedback(['foo', 'bar']); // WHERE outlet_feedback IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletFeedback The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletFeedback($outletFeedback = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletFeedback)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_OUTLET_FEEDBACK, $outletFeedback, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_feedback column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeFeedback('fooValue');   // WHERE employee_feedback = 'fooValue'
     * $query->filterByEmployeeFeedback('%fooValue%', Criteria::LIKE); // WHERE employee_feedback LIKE '%fooValue%'
     * $query->filterByEmployeeFeedback(['foo', 'bar']); // WHERE employee_feedback IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeFeedback The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeFeedback($employeeFeedback = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeFeedback)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK, $employeeFeedback, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brands_detailed column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandsDetailed('fooValue');   // WHERE brands_detailed = 'fooValue'
     * $query->filterByBrandsDetailed('%fooValue%', Criteria::LIKE); // WHERE brands_detailed LIKE '%fooValue%'
     * $query->filterByBrandsDetailed(['foo', 'bar']); // WHERE brands_detailed IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brandsDetailed The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandsDetailed($brandsDetailed = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandsDetailed)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_BRANDS_DETAILED, $brandsDetailed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nca_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByNcaComments('fooValue');   // WHERE nca_comments = 'fooValue'
     * $query->filterByNcaComments('%fooValue%', Criteria::LIKE); // WHERE nca_comments LIKE '%fooValue%'
     * $query->filterByNcaComments(['foo', 'bar']); // WHERE nca_comments IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ncaComments The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNcaComments($ncaComments = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ncaComments)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_NCA_COMMENTS, $ncaComments, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceTime('2011-03-14'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime('now'); // WHERE device_time = '2011-03-14'
     * $query->filterByDeviceTime(array('max' => 'yesterday')); // WHERE device_time > '2011-03-13'
     * </code>
     *
     * @param mixed $deviceTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceTime($deviceTime = null, ?string $comparison = null)
    {
        if (is_array($deviceTime)) {
            $useMinMax = false;
            if (isset($deviceTime['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DEVICE_TIME, $deviceTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviceTime['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_DEVICE_TIME, $deviceTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DEVICE_TIME, $deviceTime, $comparison);

        return $this;
    }

    /**
     * Filter the query on the isprocessed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsprocessed(true); // WHERE isprocessed = true
     * $query->filterByIsprocessed('yes'); // WHERE isprocessed = true
     * </code>
     *
     * @param bool|string $isprocessed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsprocessed($isprocessed = null, ?string $comparison = null)
    {
        if (is_string($isprocessed)) {
            $isprocessed = in_array(strtolower($isprocessed), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(DailycallsTableMap::COL_ISPROCESSED, $isprocessed, $comparison);

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
                $this->addUsingAlias(DailycallsTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the device_make column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceMake('fooValue');   // WHERE device_make = 'fooValue'
     * $query->filterByDeviceMake('%fooValue%', Criteria::LIKE); // WHERE device_make LIKE '%fooValue%'
     * $query->filterByDeviceMake(['foo', 'bar']); // WHERE device_make IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $deviceMake The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeviceMake($deviceMake = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceMake)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DEVICE_MAKE, $deviceMake, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_session_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEdSessionId('fooValue');   // WHERE ed_session_id = 'fooValue'
     * $query->filterByEdSessionId('%fooValue%', Criteria::LIKE); // WHERE ed_session_id LIKE '%fooValue%'
     * $query->filterByEdSessionId(['foo', 'bar']); // WHERE ed_session_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $edSessionId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdSessionId($edSessionId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($edSessionId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_ED_SESSION_ID, $edSessionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_status column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrStatus('fooValue');   // WHERE dcr_status = 'fooValue'
     * $query->filterByDcrStatus('%fooValue%', Criteria::LIKE); // WHERE dcr_status LIKE '%fooValue%'
     * $query->filterByDcrStatus(['foo', 'bar']); // WHERE dcr_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrStatus($dcrStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_STATUS, $dcrStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_done column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaDone(1234); // WHERE rcpa_done = 1234
     * $query->filterByRcpaDone(array(12, 34)); // WHERE rcpa_done IN (12, 34)
     * $query->filterByRcpaDone(array('min' => 12)); // WHERE rcpa_done > 12
     * </code>
     *
     * @param mixed $rcpaDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaDone($rcpaDone = null, ?string $comparison = null)
    {
        if (is_array($rcpaDone)) {
            $useMinMax = false;
            if (isset($rcpaDone['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_RCPA_DONE, $rcpaDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rcpaDone['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_RCPA_DONE, $rcpaDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_RCPA_DONE, $rcpaDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the has_sgpi column
     *
     * Example usage:
     * <code>
     * $query->filterByHasSgpi(1234); // WHERE has_sgpi = 1234
     * $query->filterByHasSgpi(array(12, 34)); // WHERE has_sgpi IN (12, 34)
     * $query->filterByHasSgpi(array('min' => 12)); // WHERE has_sgpi > 12
     * </code>
     *
     * @param mixed $hasSgpi The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHasSgpi($hasSgpi = null, ?string $comparison = null)
    {
        if (is_array($hasSgpi)) {
            $useMinMax = false;
            if (isset($hasSgpi['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_HAS_SGPI, $hasSgpi['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hasSgpi['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_HAS_SGPI, $hasSgpi['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_HAS_SGPI, $hasSgpi, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mr_emp column
     *
     * Example usage:
     * <code>
     * $query->filterByMrEmp(1234); // WHERE mr_emp = 1234
     * $query->filterByMrEmp(array(12, 34)); // WHERE mr_emp IN (12, 34)
     * $query->filterByMrEmp(array('min' => 12)); // WHERE mr_emp > 12
     * </code>
     *
     * @param mixed $mrEmp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrEmp($mrEmp = null, ?string $comparison = null)
    {
        if (is_array($mrEmp)) {
            $useMinMax = false;
            if (isset($mrEmp['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_MR_EMP, $mrEmp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mrEmp['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_MR_EMP, $mrEmp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_MR_EMP, $mrEmp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mr_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMrName('fooValue');   // WHERE mr_name = 'fooValue'
     * $query->filterByMrName('%fooValue%', Criteria::LIKE); // WHERE mr_name LIKE '%fooValue%'
     * $query->filterByMrName(['foo', 'bar']); // WHERE mr_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mrName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrName($mrName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mrName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_MR_NAME, $mrName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mr_media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMrMediaId(1234); // WHERE mr_media_id = 1234
     * $query->filterByMrMediaId(array(12, 34)); // WHERE mr_media_id IN (12, 34)
     * $query->filterByMrMediaId(array('min' => 12)); // WHERE mr_media_id > 12
     * </code>
     *
     * @param mixed $mrMediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrMediaId($mrMediaId = null, ?string $comparison = null)
    {
        if (is_array($mrMediaId)) {
            $useMinMax = false;
            if (isset($mrMediaId['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_MR_MEDIA_ID, $mrMediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mrMediaId['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_MR_MEDIA_ID, $mrMediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_MR_MEDIA_ID, $mrMediaId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ed_duration column
     *
     * Example usage:
     * <code>
     * $query->filterByEdDuration(1234); // WHERE ed_duration = 1234
     * $query->filterByEdDuration(array(12, 34)); // WHERE ed_duration IN (12, 34)
     * $query->filterByEdDuration(array('min' => 12)); // WHERE ed_duration > 12
     * </code>
     *
     * @param mixed $edDuration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdDuration($edDuration = null, ?string $comparison = null)
    {
        if (is_array($edDuration)) {
            $useMinMax = false;
            if (isset($edDuration['min'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_ED_DURATION, $edDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDuration['max'])) {
                $this->addUsingAlias(DailycallsTableMap::COL_ED_DURATION, $edDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_ED_DURATION, $edDuration, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campiagn_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampiagnId('fooValue');   // WHERE campiagn_id = 'fooValue'
     * $query->filterByCampiagnId('%fooValue%', Criteria::LIKE); // WHERE campiagn_id LIKE '%fooValue%'
     * $query->filterByCampiagnId(['foo', 'bar']); // WHERE campiagn_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $campiagnId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampiagnId($campiagnId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campiagnId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_CAMPIAGN_ID, $campiagnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitPlanId('fooValue');   // WHERE visit_plan_id = 'fooValue'
     * $query->filterByVisitPlanId('%fooValue%', Criteria::LIKE); // WHERE visit_plan_id LIKE '%fooValue%'
     * $query->filterByVisitPlanId(['foo', 'bar']); // WHERE visit_plan_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitPlanId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitPlanId($visitPlanId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitPlanId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_VISIT_PLAN_ID, $visitPlanId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nca_attendees column
     *
     * Example usage:
     * <code>
     * $query->filterByNcaAttendees('fooValue');   // WHERE nca_attendees = 'fooValue'
     * $query->filterByNcaAttendees('%fooValue%', Criteria::LIKE); // WHERE nca_attendees LIKE '%fooValue%'
     * $query->filterByNcaAttendees(['foo', 'bar']); // WHERE nca_attendees IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ncaAttendees The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNcaAttendees($ncaAttendees = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ncaAttendees)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_NCA_ATTENDEES, $ncaAttendees, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_lat_long column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrLatLong('fooValue');   // WHERE dcr_lat_long = 'fooValue'
     * $query->filterByDcrLatLong('%fooValue%', Criteria::LIKE); // WHERE dcr_lat_long LIKE '%fooValue%'
     * $query->filterByDcrLatLong(['foo', 'bar']); // WHERE dcr_lat_long IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrLatLong The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrLatLong($dcrLatLong = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrLatLong)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_LAT_LONG, $dcrLatLong, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcr_address column
     *
     * Example usage:
     * <code>
     * $query->filterByDcrAddress('fooValue');   // WHERE dcr_address = 'fooValue'
     * $query->filterByDcrAddress('%fooValue%', Criteria::LIKE); // WHERE dcr_address LIKE '%fooValue%'
     * $query->filterByDcrAddress(['foo', 'bar']); // WHERE dcr_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dcrAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcrAddress($dcrAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dcrAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DailycallsTableMap::COL_DCR_ADDRESS, $dcrAddress, $comparison);

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
                ->addUsingAlias(DailycallsTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\OutletOrgData object
     *
     * @param \entities\OutletOrgData|ObjectCollection $outletOrgData The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOrgData($outletOrgData, ?string $comparison = null)
    {
        if ($outletOrgData instanceof \entities\OutletOrgData) {
            return $this
                ->addUsingAlias(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
    public function joinOutletOrgData(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useOutletOrgDataQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Agendatypes object
     *
     * @param \entities\Agendatypes|ObjectCollection $agendatypes The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendatypes($agendatypes, ?string $comparison = null)
    {
        if ($agendatypes instanceof \entities\Agendatypes) {
            return $this
                ->addUsingAlias(DailycallsTableMap::COL_AGENDA_ID, $agendatypes->getAgendaid(), $comparison);
        } elseif ($agendatypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsTableMap::COL_AGENDA_ID, $agendatypes->toKeyValue('PrimaryKey', 'Agendaid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByAgendatypes() only accepts arguments of type \entities\Agendatypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Agendatypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAgendatypes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Agendatypes');

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
            $this->addJoinObject($join, 'Agendatypes');
        }

        return $this;
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AgendatypesQuery A secondary query class using the current class as primary query
     */
    public function useAgendatypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAgendatypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Agendatypes', '\entities\AgendatypesQuery');
    }

    /**
     * Use the Agendatypes relation Agendatypes object
     *
     * @param callable(\entities\AgendatypesQuery):\entities\AgendatypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAgendatypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAgendatypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Agendatypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AgendatypesQuery The inner query object of the EXISTS statement
     */
    public function useAgendatypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT EXISTS query.
     *
     * @see useAgendatypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useAgendatypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useExistsQuery('Agendatypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AgendatypesQuery The inner query object of the IN statement
     */
    public function useInAgendatypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Agendatypes table for a NOT IN query.
     *
     * @see useAgendatypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AgendatypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInAgendatypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AgendatypesQuery */
        $q = $this->useInQuery('Agendatypes', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(DailycallsTableMap::COL_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsTableMap::COL_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositions() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positions');

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
            $this->addJoinObject($join, 'Positions');
        }

        return $this;
    }

    /**
     * Use the Positions relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positions', '\entities\PositionsQuery');
    }

    /**
     * Use the Positions relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT EXISTS query.
     *
     * @see usePositionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('Positions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Positions table for a NOT IN query.
     *
     * @see usePositionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('Positions', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(DailycallsTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DailycallsTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
                ->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $brandCampiagnVisits->getDcrId(), $comparison);

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
                ->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $dailycallsAttendees->getDcrId(), $comparison);

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
                ->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $surveySubmited->getDcrId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildDailycalls $dailycalls Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($dailycalls = null)
    {
        if ($dailycalls) {
            $this->addUsingAlias(DailycallsTableMap::COL_DCR_ID, $dailycalls->getDcrId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dailycalls table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DailycallsTableMap::clearInstancePool();
            DailycallsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DailycallsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DailycallsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DailycallsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

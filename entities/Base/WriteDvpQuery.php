<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\WriteDvp as ChildWriteDvp;
use entities\WriteDvpQuery as ChildWriteDvpQuery;
use entities\Map\WriteDvpTableMap;

/**
 * Base class that represents a query for the `write_dvp` table.
 *
 * @method     ChildWriteDvpQuery orderByOrgUnit($order = Criteria::ASC) Order by the org_unit column
 * @method     ChildWriteDvpQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildWriteDvpQuery orderByJoiningDate($order = Criteria::ASC) Order by the joining_date column
 * @method     ChildWriteDvpQuery orderByAmPosition($order = Criteria::ASC) Order by the am_position column
 * @method     ChildWriteDvpQuery orderByRmPosition($order = Criteria::ASC) Order by the rm_position column
 * @method     ChildWriteDvpQuery orderByZmPosition($order = Criteria::ASC) Order by the zm_position column
 * @method     ChildWriteDvpQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildWriteDvpQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildWriteDvpQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildWriteDvpQuery orderByDoctorName($order = Criteria::ASC) Order by the doctor_name column
 * @method     ChildWriteDvpQuery orderByDoctorCode($order = Criteria::ASC) Order by the doctor_code column
 * @method     ChildWriteDvpQuery orderByTown($order = Criteria::ASC) Order by the town column
 * @method     ChildWriteDvpQuery orderByPatch($order = Criteria::ASC) Order by the patch column
 * @method     ChildWriteDvpQuery orderBySpeciality($order = Criteria::ASC) Order by the speciality column
 * @method     ChildWriteDvpQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildWriteDvpQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildWriteDvpQuery orderByPrescriberClassification($order = Criteria::ASC) Order by the prescriber_classification column
 * @method     ChildWriteDvpQuery orderByTopBrand($order = Criteria::ASC) Order by the top_brand column
 * @method     ChildWriteDvpQuery orderByVisitDr($order = Criteria::ASC) Order by the visit_dr column
 * @method     ChildWriteDvpQuery orderByAmVisitDr($order = Criteria::ASC) Order by the am_visit_dr column
 * @method     ChildWriteDvpQuery orderByRmVisitDr($order = Criteria::ASC) Order by the rm_visit_dr column
 * @method     ChildWriteDvpQuery orderByZmVisitDr($order = Criteria::ASC) Order by the zm_visit_dr column
 * @method     ChildWriteDvpQuery orderByRcpaDone($order = Criteria::ASC) Order by the rcpa_done column
 * @method     ChildWriteDvpQuery orderByRcpaLmOwn($order = Criteria::ASC) Order by the rcpa_lm_own column
 * @method     ChildWriteDvpQuery orderByRcpaLmComp($order = Criteria::ASC) Order by the rcpa_lm_comp column
 * @method     ChildWriteDvpQuery orderByRcpaCmOwn($order = Criteria::ASC) Order by the rcpa_cm_own column
 * @method     ChildWriteDvpQuery orderByRcpaCmComp($order = Criteria::ASC) Order by the rcpa_cm_comp column
 * @method     ChildWriteDvpQuery orderBySamplesSgpi($order = Criteria::ASC) Order by the samples_sgpi column
 * @method     ChildWriteDvpQuery orderByGiftsSgpi($order = Criteria::ASC) Order by the gifts_sgpi column
 * @method     ChildWriteDvpQuery orderByPromoSgpi($order = Criteria::ASC) Order by the promo_sgpi column
 * @method     ChildWriteDvpQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildWriteDvpQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildWriteDvpQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildWriteDvpQuery orderByEmployeePositionCode($order = Criteria::ASC) Order by the employee_position_code column
 * @method     ChildWriteDvpQuery orderByEmployeePosition($order = Criteria::ASC) Order by the employee_position column
 * @method     ChildWriteDvpQuery orderByEmployeeLevel($order = Criteria::ASC) Order by the employee_level column
 * @method     ChildWriteDvpQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildWriteDvpQuery orderByDvpReportId($order = Criteria::ASC) Order by the dvp_report_id column
 * @method     ChildWriteDvpQuery orderByMrDetailing($order = Criteria::ASC) Order by the mr_detailing column
 * @method     ChildWriteDvpQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWriteDvpQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildWriteDvpQuery groupByOrgUnit() Group by the org_unit column
 * @method     ChildWriteDvpQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildWriteDvpQuery groupByJoiningDate() Group by the joining_date column
 * @method     ChildWriteDvpQuery groupByAmPosition() Group by the am_position column
 * @method     ChildWriteDvpQuery groupByRmPosition() Group by the rm_position column
 * @method     ChildWriteDvpQuery groupByZmPosition() Group by the zm_position column
 * @method     ChildWriteDvpQuery groupByLocation() Group by the location column
 * @method     ChildWriteDvpQuery groupByStatus() Group by the status column
 * @method     ChildWriteDvpQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildWriteDvpQuery groupByDoctorName() Group by the doctor_name column
 * @method     ChildWriteDvpQuery groupByDoctorCode() Group by the doctor_code column
 * @method     ChildWriteDvpQuery groupByTown() Group by the town column
 * @method     ChildWriteDvpQuery groupByPatch() Group by the patch column
 * @method     ChildWriteDvpQuery groupBySpeciality() Group by the speciality column
 * @method     ChildWriteDvpQuery groupByTags() Group by the tags column
 * @method     ChildWriteDvpQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildWriteDvpQuery groupByPrescriberClassification() Group by the prescriber_classification column
 * @method     ChildWriteDvpQuery groupByTopBrand() Group by the top_brand column
 * @method     ChildWriteDvpQuery groupByVisitDr() Group by the visit_dr column
 * @method     ChildWriteDvpQuery groupByAmVisitDr() Group by the am_visit_dr column
 * @method     ChildWriteDvpQuery groupByRmVisitDr() Group by the rm_visit_dr column
 * @method     ChildWriteDvpQuery groupByZmVisitDr() Group by the zm_visit_dr column
 * @method     ChildWriteDvpQuery groupByRcpaDone() Group by the rcpa_done column
 * @method     ChildWriteDvpQuery groupByRcpaLmOwn() Group by the rcpa_lm_own column
 * @method     ChildWriteDvpQuery groupByRcpaLmComp() Group by the rcpa_lm_comp column
 * @method     ChildWriteDvpQuery groupByRcpaCmOwn() Group by the rcpa_cm_own column
 * @method     ChildWriteDvpQuery groupByRcpaCmComp() Group by the rcpa_cm_comp column
 * @method     ChildWriteDvpQuery groupBySamplesSgpi() Group by the samples_sgpi column
 * @method     ChildWriteDvpQuery groupByGiftsSgpi() Group by the gifts_sgpi column
 * @method     ChildWriteDvpQuery groupByPromoSgpi() Group by the promo_sgpi column
 * @method     ChildWriteDvpQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildWriteDvpQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildWriteDvpQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildWriteDvpQuery groupByEmployeePositionCode() Group by the employee_position_code column
 * @method     ChildWriteDvpQuery groupByEmployeePosition() Group by the employee_position column
 * @method     ChildWriteDvpQuery groupByEmployeeLevel() Group by the employee_level column
 * @method     ChildWriteDvpQuery groupByMonth() Group by the month column
 * @method     ChildWriteDvpQuery groupByDvpReportId() Group by the dvp_report_id column
 * @method     ChildWriteDvpQuery groupByMrDetailing() Group by the mr_detailing column
 * @method     ChildWriteDvpQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWriteDvpQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildWriteDvpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWriteDvpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWriteDvpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWriteDvpQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWriteDvpQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWriteDvpQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWriteDvp|null findOne(?ConnectionInterface $con = null) Return the first ChildWriteDvp matching the query
 * @method     ChildWriteDvp findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWriteDvp matching the query, or a new ChildWriteDvp object populated from the query conditions when no match is found
 *
 * @method     ChildWriteDvp|null findOneByOrgUnit(string $org_unit) Return the first ChildWriteDvp filtered by the org_unit column
 * @method     ChildWriteDvp|null findOneByEmployeeCode(string $employee_code) Return the first ChildWriteDvp filtered by the employee_code column
 * @method     ChildWriteDvp|null findOneByJoiningDate(string $joining_date) Return the first ChildWriteDvp filtered by the joining_date column
 * @method     ChildWriteDvp|null findOneByAmPosition(string $am_position) Return the first ChildWriteDvp filtered by the am_position column
 * @method     ChildWriteDvp|null findOneByRmPosition(string $rm_position) Return the first ChildWriteDvp filtered by the rm_position column
 * @method     ChildWriteDvp|null findOneByZmPosition(string $zm_position) Return the first ChildWriteDvp filtered by the zm_position column
 * @method     ChildWriteDvp|null findOneByLocation(string $location) Return the first ChildWriteDvp filtered by the location column
 * @method     ChildWriteDvp|null findOneByStatus(string $status) Return the first ChildWriteDvp filtered by the status column
 * @method     ChildWriteDvp|null findOneByEmployeeName(string $employee_name) Return the first ChildWriteDvp filtered by the employee_name column
 * @method     ChildWriteDvp|null findOneByDoctorName(string $doctor_name) Return the first ChildWriteDvp filtered by the doctor_name column
 * @method     ChildWriteDvp|null findOneByDoctorCode(string $doctor_code) Return the first ChildWriteDvp filtered by the doctor_code column
 * @method     ChildWriteDvp|null findOneByTown(string $town) Return the first ChildWriteDvp filtered by the town column
 * @method     ChildWriteDvp|null findOneByPatch(string $patch) Return the first ChildWriteDvp filtered by the patch column
 * @method     ChildWriteDvp|null findOneBySpeciality(string $speciality) Return the first ChildWriteDvp filtered by the speciality column
 * @method     ChildWriteDvp|null findOneByTags(string $tags) Return the first ChildWriteDvp filtered by the tags column
 * @method     ChildWriteDvp|null findOneByVisitFq(string $visit_fq) Return the first ChildWriteDvp filtered by the visit_fq column
 * @method     ChildWriteDvp|null findOneByPrescriberClassification(string $prescriber_classification) Return the first ChildWriteDvp filtered by the prescriber_classification column
 * @method     ChildWriteDvp|null findOneByTopBrand(string $top_brand) Return the first ChildWriteDvp filtered by the top_brand column
 * @method     ChildWriteDvp|null findOneByVisitDr(string $visit_dr) Return the first ChildWriteDvp filtered by the visit_dr column
 * @method     ChildWriteDvp|null findOneByAmVisitDr(string $am_visit_dr) Return the first ChildWriteDvp filtered by the am_visit_dr column
 * @method     ChildWriteDvp|null findOneByRmVisitDr(string $rm_visit_dr) Return the first ChildWriteDvp filtered by the rm_visit_dr column
 * @method     ChildWriteDvp|null findOneByZmVisitDr(string $zm_visit_dr) Return the first ChildWriteDvp filtered by the zm_visit_dr column
 * @method     ChildWriteDvp|null findOneByRcpaDone(string $rcpa_done) Return the first ChildWriteDvp filtered by the rcpa_done column
 * @method     ChildWriteDvp|null findOneByRcpaLmOwn(string $rcpa_lm_own) Return the first ChildWriteDvp filtered by the rcpa_lm_own column
 * @method     ChildWriteDvp|null findOneByRcpaLmComp(string $rcpa_lm_comp) Return the first ChildWriteDvp filtered by the rcpa_lm_comp column
 * @method     ChildWriteDvp|null findOneByRcpaCmOwn(string $rcpa_cm_own) Return the first ChildWriteDvp filtered by the rcpa_cm_own column
 * @method     ChildWriteDvp|null findOneByRcpaCmComp(string $rcpa_cm_comp) Return the first ChildWriteDvp filtered by the rcpa_cm_comp column
 * @method     ChildWriteDvp|null findOneBySamplesSgpi(string $samples_sgpi) Return the first ChildWriteDvp filtered by the samples_sgpi column
 * @method     ChildWriteDvp|null findOneByGiftsSgpi(string $gifts_sgpi) Return the first ChildWriteDvp filtered by the gifts_sgpi column
 * @method     ChildWriteDvp|null findOneByPromoSgpi(string $promo_sgpi) Return the first ChildWriteDvp filtered by the promo_sgpi column
 * @method     ChildWriteDvp|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildWriteDvp filtered by the zm_position_code column
 * @method     ChildWriteDvp|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildWriteDvp filtered by the rm_position_code column
 * @method     ChildWriteDvp|null findOneByAmPositionCode(string $am_position_code) Return the first ChildWriteDvp filtered by the am_position_code column
 * @method     ChildWriteDvp|null findOneByEmployeePositionCode(string $employee_position_code) Return the first ChildWriteDvp filtered by the employee_position_code column
 * @method     ChildWriteDvp|null findOneByEmployeePosition(string $employee_position) Return the first ChildWriteDvp filtered by the employee_position column
 * @method     ChildWriteDvp|null findOneByEmployeeLevel(string $employee_level) Return the first ChildWriteDvp filtered by the employee_level column
 * @method     ChildWriteDvp|null findOneByMonth(string $month) Return the first ChildWriteDvp filtered by the month column
 * @method     ChildWriteDvp|null findOneByDvpReportId(int $dvp_report_id) Return the first ChildWriteDvp filtered by the dvp_report_id column
 * @method     ChildWriteDvp|null findOneByMrDetailing(string $mr_detailing) Return the first ChildWriteDvp filtered by the mr_detailing column
 * @method     ChildWriteDvp|null findOneByCreatedAt(string $created_at) Return the first ChildWriteDvp filtered by the created_at column
 * @method     ChildWriteDvp|null findOneByUpdatedAt(string $updated_at) Return the first ChildWriteDvp filtered by the updated_at column
 *
 * @method     ChildWriteDvp requirePk($key, ?ConnectionInterface $con = null) Return the ChildWriteDvp by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOne(?ConnectionInterface $con = null) Return the first ChildWriteDvp matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteDvp requireOneByOrgUnit(string $org_unit) Return the first ChildWriteDvp filtered by the org_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByEmployeeCode(string $employee_code) Return the first ChildWriteDvp filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByJoiningDate(string $joining_date) Return the first ChildWriteDvp filtered by the joining_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByAmPosition(string $am_position) Return the first ChildWriteDvp filtered by the am_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRmPosition(string $rm_position) Return the first ChildWriteDvp filtered by the rm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByZmPosition(string $zm_position) Return the first ChildWriteDvp filtered by the zm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByLocation(string $location) Return the first ChildWriteDvp filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByStatus(string $status) Return the first ChildWriteDvp filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByEmployeeName(string $employee_name) Return the first ChildWriteDvp filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByDoctorName(string $doctor_name) Return the first ChildWriteDvp filtered by the doctor_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByDoctorCode(string $doctor_code) Return the first ChildWriteDvp filtered by the doctor_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByTown(string $town) Return the first ChildWriteDvp filtered by the town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByPatch(string $patch) Return the first ChildWriteDvp filtered by the patch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneBySpeciality(string $speciality) Return the first ChildWriteDvp filtered by the speciality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByTags(string $tags) Return the first ChildWriteDvp filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByVisitFq(string $visit_fq) Return the first ChildWriteDvp filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByPrescriberClassification(string $prescriber_classification) Return the first ChildWriteDvp filtered by the prescriber_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByTopBrand(string $top_brand) Return the first ChildWriteDvp filtered by the top_brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByVisitDr(string $visit_dr) Return the first ChildWriteDvp filtered by the visit_dr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByAmVisitDr(string $am_visit_dr) Return the first ChildWriteDvp filtered by the am_visit_dr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRmVisitDr(string $rm_visit_dr) Return the first ChildWriteDvp filtered by the rm_visit_dr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByZmVisitDr(string $zm_visit_dr) Return the first ChildWriteDvp filtered by the zm_visit_dr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRcpaDone(string $rcpa_done) Return the first ChildWriteDvp filtered by the rcpa_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRcpaLmOwn(string $rcpa_lm_own) Return the first ChildWriteDvp filtered by the rcpa_lm_own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRcpaLmComp(string $rcpa_lm_comp) Return the first ChildWriteDvp filtered by the rcpa_lm_comp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRcpaCmOwn(string $rcpa_cm_own) Return the first ChildWriteDvp filtered by the rcpa_cm_own column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRcpaCmComp(string $rcpa_cm_comp) Return the first ChildWriteDvp filtered by the rcpa_cm_comp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneBySamplesSgpi(string $samples_sgpi) Return the first ChildWriteDvp filtered by the samples_sgpi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByGiftsSgpi(string $gifts_sgpi) Return the first ChildWriteDvp filtered by the gifts_sgpi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByPromoSgpi(string $promo_sgpi) Return the first ChildWriteDvp filtered by the promo_sgpi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByZmPositionCode(string $zm_position_code) Return the first ChildWriteDvp filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByRmPositionCode(string $rm_position_code) Return the first ChildWriteDvp filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByAmPositionCode(string $am_position_code) Return the first ChildWriteDvp filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByEmployeePositionCode(string $employee_position_code) Return the first ChildWriteDvp filtered by the employee_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByEmployeePosition(string $employee_position) Return the first ChildWriteDvp filtered by the employee_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByEmployeeLevel(string $employee_level) Return the first ChildWriteDvp filtered by the employee_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByMonth(string $month) Return the first ChildWriteDvp filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByDvpReportId(int $dvp_report_id) Return the first ChildWriteDvp filtered by the dvp_report_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByMrDetailing(string $mr_detailing) Return the first ChildWriteDvp filtered by the mr_detailing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByCreatedAt(string $created_at) Return the first ChildWriteDvp filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteDvp requireOneByUpdatedAt(string $updated_at) Return the first ChildWriteDvp filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteDvp[]|Collection find(?ConnectionInterface $con = null) Return ChildWriteDvp objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWriteDvp> find(?ConnectionInterface $con = null) Return ChildWriteDvp objects based on current ModelCriteria
 *
 * @method     ChildWriteDvp[]|Collection findByOrgUnit(string|array<string> $org_unit) Return ChildWriteDvp objects filtered by the org_unit column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByOrgUnit(string|array<string> $org_unit) Return ChildWriteDvp objects filtered by the org_unit column
 * @method     ChildWriteDvp[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildWriteDvp objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByEmployeeCode(string|array<string> $employee_code) Return ChildWriteDvp objects filtered by the employee_code column
 * @method     ChildWriteDvp[]|Collection findByJoiningDate(string|array<string> $joining_date) Return ChildWriteDvp objects filtered by the joining_date column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByJoiningDate(string|array<string> $joining_date) Return ChildWriteDvp objects filtered by the joining_date column
 * @method     ChildWriteDvp[]|Collection findByAmPosition(string|array<string> $am_position) Return ChildWriteDvp objects filtered by the am_position column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByAmPosition(string|array<string> $am_position) Return ChildWriteDvp objects filtered by the am_position column
 * @method     ChildWriteDvp[]|Collection findByRmPosition(string|array<string> $rm_position) Return ChildWriteDvp objects filtered by the rm_position column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRmPosition(string|array<string> $rm_position) Return ChildWriteDvp objects filtered by the rm_position column
 * @method     ChildWriteDvp[]|Collection findByZmPosition(string|array<string> $zm_position) Return ChildWriteDvp objects filtered by the zm_position column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByZmPosition(string|array<string> $zm_position) Return ChildWriteDvp objects filtered by the zm_position column
 * @method     ChildWriteDvp[]|Collection findByLocation(string|array<string> $location) Return ChildWriteDvp objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByLocation(string|array<string> $location) Return ChildWriteDvp objects filtered by the location column
 * @method     ChildWriteDvp[]|Collection findByStatus(string|array<string> $status) Return ChildWriteDvp objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByStatus(string|array<string> $status) Return ChildWriteDvp objects filtered by the status column
 * @method     ChildWriteDvp[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildWriteDvp objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByEmployeeName(string|array<string> $employee_name) Return ChildWriteDvp objects filtered by the employee_name column
 * @method     ChildWriteDvp[]|Collection findByDoctorName(string|array<string> $doctor_name) Return ChildWriteDvp objects filtered by the doctor_name column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByDoctorName(string|array<string> $doctor_name) Return ChildWriteDvp objects filtered by the doctor_name column
 * @method     ChildWriteDvp[]|Collection findByDoctorCode(string|array<string> $doctor_code) Return ChildWriteDvp objects filtered by the doctor_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByDoctorCode(string|array<string> $doctor_code) Return ChildWriteDvp objects filtered by the doctor_code column
 * @method     ChildWriteDvp[]|Collection findByTown(string|array<string> $town) Return ChildWriteDvp objects filtered by the town column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByTown(string|array<string> $town) Return ChildWriteDvp objects filtered by the town column
 * @method     ChildWriteDvp[]|Collection findByPatch(string|array<string> $patch) Return ChildWriteDvp objects filtered by the patch column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByPatch(string|array<string> $patch) Return ChildWriteDvp objects filtered by the patch column
 * @method     ChildWriteDvp[]|Collection findBySpeciality(string|array<string> $speciality) Return ChildWriteDvp objects filtered by the speciality column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findBySpeciality(string|array<string> $speciality) Return ChildWriteDvp objects filtered by the speciality column
 * @method     ChildWriteDvp[]|Collection findByTags(string|array<string> $tags) Return ChildWriteDvp objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByTags(string|array<string> $tags) Return ChildWriteDvp objects filtered by the tags column
 * @method     ChildWriteDvp[]|Collection findByVisitFq(string|array<string> $visit_fq) Return ChildWriteDvp objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByVisitFq(string|array<string> $visit_fq) Return ChildWriteDvp objects filtered by the visit_fq column
 * @method     ChildWriteDvp[]|Collection findByPrescriberClassification(string|array<string> $prescriber_classification) Return ChildWriteDvp objects filtered by the prescriber_classification column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByPrescriberClassification(string|array<string> $prescriber_classification) Return ChildWriteDvp objects filtered by the prescriber_classification column
 * @method     ChildWriteDvp[]|Collection findByTopBrand(string|array<string> $top_brand) Return ChildWriteDvp objects filtered by the top_brand column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByTopBrand(string|array<string> $top_brand) Return ChildWriteDvp objects filtered by the top_brand column
 * @method     ChildWriteDvp[]|Collection findByVisitDr(string|array<string> $visit_dr) Return ChildWriteDvp objects filtered by the visit_dr column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByVisitDr(string|array<string> $visit_dr) Return ChildWriteDvp objects filtered by the visit_dr column
 * @method     ChildWriteDvp[]|Collection findByAmVisitDr(string|array<string> $am_visit_dr) Return ChildWriteDvp objects filtered by the am_visit_dr column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByAmVisitDr(string|array<string> $am_visit_dr) Return ChildWriteDvp objects filtered by the am_visit_dr column
 * @method     ChildWriteDvp[]|Collection findByRmVisitDr(string|array<string> $rm_visit_dr) Return ChildWriteDvp objects filtered by the rm_visit_dr column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRmVisitDr(string|array<string> $rm_visit_dr) Return ChildWriteDvp objects filtered by the rm_visit_dr column
 * @method     ChildWriteDvp[]|Collection findByZmVisitDr(string|array<string> $zm_visit_dr) Return ChildWriteDvp objects filtered by the zm_visit_dr column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByZmVisitDr(string|array<string> $zm_visit_dr) Return ChildWriteDvp objects filtered by the zm_visit_dr column
 * @method     ChildWriteDvp[]|Collection findByRcpaDone(string|array<string> $rcpa_done) Return ChildWriteDvp objects filtered by the rcpa_done column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRcpaDone(string|array<string> $rcpa_done) Return ChildWriteDvp objects filtered by the rcpa_done column
 * @method     ChildWriteDvp[]|Collection findByRcpaLmOwn(string|array<string> $rcpa_lm_own) Return ChildWriteDvp objects filtered by the rcpa_lm_own column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRcpaLmOwn(string|array<string> $rcpa_lm_own) Return ChildWriteDvp objects filtered by the rcpa_lm_own column
 * @method     ChildWriteDvp[]|Collection findByRcpaLmComp(string|array<string> $rcpa_lm_comp) Return ChildWriteDvp objects filtered by the rcpa_lm_comp column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRcpaLmComp(string|array<string> $rcpa_lm_comp) Return ChildWriteDvp objects filtered by the rcpa_lm_comp column
 * @method     ChildWriteDvp[]|Collection findByRcpaCmOwn(string|array<string> $rcpa_cm_own) Return ChildWriteDvp objects filtered by the rcpa_cm_own column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRcpaCmOwn(string|array<string> $rcpa_cm_own) Return ChildWriteDvp objects filtered by the rcpa_cm_own column
 * @method     ChildWriteDvp[]|Collection findByRcpaCmComp(string|array<string> $rcpa_cm_comp) Return ChildWriteDvp objects filtered by the rcpa_cm_comp column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRcpaCmComp(string|array<string> $rcpa_cm_comp) Return ChildWriteDvp objects filtered by the rcpa_cm_comp column
 * @method     ChildWriteDvp[]|Collection findBySamplesSgpi(string|array<string> $samples_sgpi) Return ChildWriteDvp objects filtered by the samples_sgpi column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findBySamplesSgpi(string|array<string> $samples_sgpi) Return ChildWriteDvp objects filtered by the samples_sgpi column
 * @method     ChildWriteDvp[]|Collection findByGiftsSgpi(string|array<string> $gifts_sgpi) Return ChildWriteDvp objects filtered by the gifts_sgpi column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByGiftsSgpi(string|array<string> $gifts_sgpi) Return ChildWriteDvp objects filtered by the gifts_sgpi column
 * @method     ChildWriteDvp[]|Collection findByPromoSgpi(string|array<string> $promo_sgpi) Return ChildWriteDvp objects filtered by the promo_sgpi column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByPromoSgpi(string|array<string> $promo_sgpi) Return ChildWriteDvp objects filtered by the promo_sgpi column
 * @method     ChildWriteDvp[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildWriteDvp objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildWriteDvp objects filtered by the zm_position_code column
 * @method     ChildWriteDvp[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildWriteDvp objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildWriteDvp objects filtered by the rm_position_code column
 * @method     ChildWriteDvp[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildWriteDvp objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByAmPositionCode(string|array<string> $am_position_code) Return ChildWriteDvp objects filtered by the am_position_code column
 * @method     ChildWriteDvp[]|Collection findByEmployeePositionCode(string|array<string> $employee_position_code) Return ChildWriteDvp objects filtered by the employee_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByEmployeePositionCode(string|array<string> $employee_position_code) Return ChildWriteDvp objects filtered by the employee_position_code column
 * @method     ChildWriteDvp[]|Collection findByEmployeePosition(string|array<string> $employee_position) Return ChildWriteDvp objects filtered by the employee_position column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByEmployeePosition(string|array<string> $employee_position) Return ChildWriteDvp objects filtered by the employee_position column
 * @method     ChildWriteDvp[]|Collection findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteDvp objects filtered by the employee_level column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteDvp objects filtered by the employee_level column
 * @method     ChildWriteDvp[]|Collection findByMonth(string|array<string> $month) Return ChildWriteDvp objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByMonth(string|array<string> $month) Return ChildWriteDvp objects filtered by the month column
 * @method     ChildWriteDvp[]|Collection findByDvpReportId(int|array<int> $dvp_report_id) Return ChildWriteDvp objects filtered by the dvp_report_id column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByDvpReportId(int|array<int> $dvp_report_id) Return ChildWriteDvp objects filtered by the dvp_report_id column
 * @method     ChildWriteDvp[]|Collection findByMrDetailing(string|array<string> $mr_detailing) Return ChildWriteDvp objects filtered by the mr_detailing column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByMrDetailing(string|array<string> $mr_detailing) Return ChildWriteDvp objects filtered by the mr_detailing column
 * @method     ChildWriteDvp[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWriteDvp objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByCreatedAt(string|array<string> $created_at) Return ChildWriteDvp objects filtered by the created_at column
 * @method     ChildWriteDvp[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteDvp objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWriteDvp> findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteDvp objects filtered by the updated_at column
 *
 * @method     ChildWriteDvp[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWriteDvp> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WriteDvpQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WriteDvpQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WriteDvp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWriteDvpQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWriteDvpQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWriteDvpQuery) {
            return $criteria;
        }
        $query = new ChildWriteDvpQuery();
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
     * @return ChildWriteDvp|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WriteDvpTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWriteDvp A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT org_unit, employee_code, joining_date, am_position, rm_position, zm_position, location, status, employee_name, doctor_name, doctor_code, town, patch, speciality, tags, visit_fq, prescriber_classification, top_brand, visit_dr, am_visit_dr, rm_visit_dr, zm_visit_dr, rcpa_done, rcpa_lm_own, rcpa_lm_comp, rcpa_cm_own, rcpa_cm_comp, samples_sgpi, gifts_sgpi, promo_sgpi, zm_position_code, rm_position_code, am_position_code, employee_position_code, employee_position, employee_level, month, dvp_report_id, mr_detailing, created_at, updated_at FROM write_dvp WHERE dvp_report_id = :p0';
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
            /** @var ChildWriteDvp $obj */
            $obj = new ChildWriteDvp();
            $obj->hydrate($row);
            WriteDvpTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWriteDvp|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the org_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnit('fooValue');   // WHERE org_unit = 'fooValue'
     * $query->filterByOrgUnit('%fooValue%', Criteria::LIKE); // WHERE org_unit LIKE '%fooValue%'
     * $query->filterByOrgUnit(['foo', 'bar']); // WHERE org_unit IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgUnit The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgUnit)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_ORG_UNIT, $orgUnit, $comparison);

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

        $this->addUsingAlias(WriteDvpTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joining_date column
     *
     * Example usage:
     * <code>
     * $query->filterByJoiningDate('fooValue');   // WHERE joining_date = 'fooValue'
     * $query->filterByJoiningDate('%fooValue%', Criteria::LIKE); // WHERE joining_date LIKE '%fooValue%'
     * $query->filterByJoiningDate(['foo', 'bar']); // WHERE joining_date IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $joiningDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJoiningDate($joiningDate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($joiningDate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_JOINING_DATE, $joiningDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPosition('fooValue');   // WHERE am_position = 'fooValue'
     * $query->filterByAmPosition('%fooValue%', Criteria::LIKE); // WHERE am_position LIKE '%fooValue%'
     * $query->filterByAmPosition(['foo', 'bar']); // WHERE am_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPosition($amPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_AM_POSITION, $amPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPosition('fooValue');   // WHERE rm_position = 'fooValue'
     * $query->filterByRmPosition('%fooValue%', Criteria::LIKE); // WHERE rm_position LIKE '%fooValue%'
     * $query->filterByRmPosition(['foo', 'bar']); // WHERE rm_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPosition($rmPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RM_POSITION, $rmPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPosition('fooValue');   // WHERE zm_position = 'fooValue'
     * $query->filterByZmPosition('%fooValue%', Criteria::LIKE); // WHERE zm_position LIKE '%fooValue%'
     * $query->filterByZmPosition(['foo', 'bar']); // WHERE zm_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPosition($zmPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_ZM_POSITION, $zmPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_LOCATION, $location, $comparison);

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

        $this->addUsingAlias(WriteDvpTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeName('fooValue');   // WHERE employee_name = 'fooValue'
     * $query->filterByEmployeeName('%fooValue%', Criteria::LIKE); // WHERE employee_name LIKE '%fooValue%'
     * $query->filterByEmployeeName(['foo', 'bar']); // WHERE employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeName($employeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctor_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorName('fooValue');   // WHERE doctor_name = 'fooValue'
     * $query->filterByDoctorName('%fooValue%', Criteria::LIKE); // WHERE doctor_name LIKE '%fooValue%'
     * $query->filterByDoctorName(['foo', 'bar']); // WHERE doctor_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $doctorName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorName($doctorName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($doctorName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_DOCTOR_NAME, $doctorName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the doctor_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDoctorCode('fooValue');   // WHERE doctor_code = 'fooValue'
     * $query->filterByDoctorCode('%fooValue%', Criteria::LIKE); // WHERE doctor_code LIKE '%fooValue%'
     * $query->filterByDoctorCode(['foo', 'bar']); // WHERE doctor_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $doctorCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDoctorCode($doctorCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($doctorCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_DOCTOR_CODE, $doctorCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the town column
     *
     * Example usage:
     * <code>
     * $query->filterByTown('fooValue');   // WHERE town = 'fooValue'
     * $query->filterByTown('%fooValue%', Criteria::LIKE); // WHERE town LIKE '%fooValue%'
     * $query->filterByTown(['foo', 'bar']); // WHERE town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $town The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTown($town = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($town)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_TOWN, $town, $comparison);

        return $this;
    }

    /**
     * Filter the query on the patch column
     *
     * Example usage:
     * <code>
     * $query->filterByPatch('fooValue');   // WHERE patch = 'fooValue'
     * $query->filterByPatch('%fooValue%', Criteria::LIKE); // WHERE patch LIKE '%fooValue%'
     * $query->filterByPatch(['foo', 'bar']); // WHERE patch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $patch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPatch($patch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($patch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_PATCH, $patch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the speciality column
     *
     * Example usage:
     * <code>
     * $query->filterBySpeciality('fooValue');   // WHERE speciality = 'fooValue'
     * $query->filterBySpeciality('%fooValue%', Criteria::LIKE); // WHERE speciality LIKE '%fooValue%'
     * $query->filterBySpeciality(['foo', 'bar']); // WHERE speciality IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $speciality The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpeciality($speciality = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($speciality)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_SPECIALITY, $speciality, $comparison);

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

        $this->addUsingAlias(WriteDvpTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_fq column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitFq('fooValue');   // WHERE visit_fq = 'fooValue'
     * $query->filterByVisitFq('%fooValue%', Criteria::LIKE); // WHERE visit_fq LIKE '%fooValue%'
     * $query->filterByVisitFq(['foo', 'bar']); // WHERE visit_fq IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitFq The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitFq($visitFq = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitFq)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_VISIT_FQ, $visitFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the prescriber_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByPrescriberClassification('fooValue');   // WHERE prescriber_classification = 'fooValue'
     * $query->filterByPrescriberClassification('%fooValue%', Criteria::LIKE); // WHERE prescriber_classification LIKE '%fooValue%'
     * $query->filterByPrescriberClassification(['foo', 'bar']); // WHERE prescriber_classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $prescriberClassification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrescriberClassification($prescriberClassification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prescriberClassification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION, $prescriberClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the top_brand column
     *
     * Example usage:
     * <code>
     * $query->filterByTopBrand('fooValue');   // WHERE top_brand = 'fooValue'
     * $query->filterByTopBrand('%fooValue%', Criteria::LIKE); // WHERE top_brand LIKE '%fooValue%'
     * $query->filterByTopBrand(['foo', 'bar']); // WHERE top_brand IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $topBrand The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTopBrand($topBrand = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($topBrand)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_TOP_BRAND, $topBrand, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_dr column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitDr('fooValue');   // WHERE visit_dr = 'fooValue'
     * $query->filterByVisitDr('%fooValue%', Criteria::LIKE); // WHERE visit_dr LIKE '%fooValue%'
     * $query->filterByVisitDr(['foo', 'bar']); // WHERE visit_dr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitDr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitDr($visitDr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitDr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_VISIT_DR, $visitDr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_visit_dr column
     *
     * Example usage:
     * <code>
     * $query->filterByAmVisitDr('fooValue');   // WHERE am_visit_dr = 'fooValue'
     * $query->filterByAmVisitDr('%fooValue%', Criteria::LIKE); // WHERE am_visit_dr LIKE '%fooValue%'
     * $query->filterByAmVisitDr(['foo', 'bar']); // WHERE am_visit_dr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amVisitDr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmVisitDr($amVisitDr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amVisitDr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_AM_VISIT_DR, $amVisitDr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_visit_dr column
     *
     * Example usage:
     * <code>
     * $query->filterByRmVisitDr('fooValue');   // WHERE rm_visit_dr = 'fooValue'
     * $query->filterByRmVisitDr('%fooValue%', Criteria::LIKE); // WHERE rm_visit_dr LIKE '%fooValue%'
     * $query->filterByRmVisitDr(['foo', 'bar']); // WHERE rm_visit_dr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmVisitDr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmVisitDr($rmVisitDr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmVisitDr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RM_VISIT_DR, $rmVisitDr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_visit_dr column
     *
     * Example usage:
     * <code>
     * $query->filterByZmVisitDr('fooValue');   // WHERE zm_visit_dr = 'fooValue'
     * $query->filterByZmVisitDr('%fooValue%', Criteria::LIKE); // WHERE zm_visit_dr LIKE '%fooValue%'
     * $query->filterByZmVisitDr(['foo', 'bar']); // WHERE zm_visit_dr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmVisitDr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmVisitDr($zmVisitDr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmVisitDr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_ZM_VISIT_DR, $zmVisitDr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_done column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaDone('fooValue');   // WHERE rcpa_done = 'fooValue'
     * $query->filterByRcpaDone('%fooValue%', Criteria::LIKE); // WHERE rcpa_done LIKE '%fooValue%'
     * $query->filterByRcpaDone(['foo', 'bar']); // WHERE rcpa_done IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaDone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaDone($rcpaDone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaDone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RCPA_DONE, $rcpaDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_lm_own column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaLmOwn('fooValue');   // WHERE rcpa_lm_own = 'fooValue'
     * $query->filterByRcpaLmOwn('%fooValue%', Criteria::LIKE); // WHERE rcpa_lm_own LIKE '%fooValue%'
     * $query->filterByRcpaLmOwn(['foo', 'bar']); // WHERE rcpa_lm_own IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaLmOwn The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaLmOwn($rcpaLmOwn = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaLmOwn)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RCPA_LM_OWN, $rcpaLmOwn, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_lm_comp column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaLmComp('fooValue');   // WHERE rcpa_lm_comp = 'fooValue'
     * $query->filterByRcpaLmComp('%fooValue%', Criteria::LIKE); // WHERE rcpa_lm_comp LIKE '%fooValue%'
     * $query->filterByRcpaLmComp(['foo', 'bar']); // WHERE rcpa_lm_comp IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaLmComp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaLmComp($rcpaLmComp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaLmComp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RCPA_LM_COMP, $rcpaLmComp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_cm_own column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaCmOwn('fooValue');   // WHERE rcpa_cm_own = 'fooValue'
     * $query->filterByRcpaCmOwn('%fooValue%', Criteria::LIKE); // WHERE rcpa_cm_own LIKE '%fooValue%'
     * $query->filterByRcpaCmOwn(['foo', 'bar']); // WHERE rcpa_cm_own IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaCmOwn The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaCmOwn($rcpaCmOwn = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaCmOwn)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RCPA_CM_OWN, $rcpaCmOwn, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_cm_comp column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaCmComp('fooValue');   // WHERE rcpa_cm_comp = 'fooValue'
     * $query->filterByRcpaCmComp('%fooValue%', Criteria::LIKE); // WHERE rcpa_cm_comp LIKE '%fooValue%'
     * $query->filterByRcpaCmComp(['foo', 'bar']); // WHERE rcpa_cm_comp IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaCmComp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaCmComp($rcpaCmComp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaCmComp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RCPA_CM_COMP, $rcpaCmComp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the samples_sgpi column
     *
     * Example usage:
     * <code>
     * $query->filterBySamplesSgpi('fooValue');   // WHERE samples_sgpi = 'fooValue'
     * $query->filterBySamplesSgpi('%fooValue%', Criteria::LIKE); // WHERE samples_sgpi LIKE '%fooValue%'
     * $query->filterBySamplesSgpi(['foo', 'bar']); // WHERE samples_sgpi IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $samplesSgpi The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySamplesSgpi($samplesSgpi = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($samplesSgpi)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_SAMPLES_SGPI, $samplesSgpi, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gifts_sgpi column
     *
     * Example usage:
     * <code>
     * $query->filterByGiftsSgpi('fooValue');   // WHERE gifts_sgpi = 'fooValue'
     * $query->filterByGiftsSgpi('%fooValue%', Criteria::LIKE); // WHERE gifts_sgpi LIKE '%fooValue%'
     * $query->filterByGiftsSgpi(['foo', 'bar']); // WHERE gifts_sgpi IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $giftsSgpi The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGiftsSgpi($giftsSgpi = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($giftsSgpi)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_GIFTS_SGPI, $giftsSgpi, $comparison);

        return $this;
    }

    /**
     * Filter the query on the promo_sgpi column
     *
     * Example usage:
     * <code>
     * $query->filterByPromoSgpi('fooValue');   // WHERE promo_sgpi = 'fooValue'
     * $query->filterByPromoSgpi('%fooValue%', Criteria::LIKE); // WHERE promo_sgpi LIKE '%fooValue%'
     * $query->filterByPromoSgpi(['foo', 'bar']); // WHERE promo_sgpi IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $promoSgpi The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPromoSgpi($promoSgpi = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($promoSgpi)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_PROMO_SGPI, $promoSgpi, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPositionCode('fooValue');   // WHERE zm_position_code = 'fooValue'
     * $query->filterByZmPositionCode('%fooValue%', Criteria::LIKE); // WHERE zm_position_code LIKE '%fooValue%'
     * $query->filterByZmPositionCode(['foo', 'bar']); // WHERE zm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPositionCode($zmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPositionCode('fooValue');   // WHERE rm_position_code = 'fooValue'
     * $query->filterByRmPositionCode('%fooValue%', Criteria::LIKE); // WHERE rm_position_code LIKE '%fooValue%'
     * $query->filterByRmPositionCode(['foo', 'bar']); // WHERE rm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPositionCode($rmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPositionCode('fooValue');   // WHERE am_position_code = 'fooValue'
     * $query->filterByAmPositionCode('%fooValue%', Criteria::LIKE); // WHERE am_position_code LIKE '%fooValue%'
     * $query->filterByAmPositionCode(['foo', 'bar']); // WHERE am_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPositionCode($amPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionCode('fooValue');   // WHERE employee_position_code = 'fooValue'
     * $query->filterByEmployeePositionCode('%fooValue%', Criteria::LIKE); // WHERE employee_position_code LIKE '%fooValue%'
     * $query->filterByEmployeePositionCode(['foo', 'bar']); // WHERE employee_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionCode($employeePositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE, $employeePositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePosition('fooValue');   // WHERE employee_position = 'fooValue'
     * $query->filterByEmployeePosition('%fooValue%', Criteria::LIKE); // WHERE employee_position LIKE '%fooValue%'
     * $query->filterByEmployeePosition(['foo', 'bar']); // WHERE employee_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePosition($employeePosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_EMPLOYEE_POSITION, $employeePosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_level column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeLevel('fooValue');   // WHERE employee_level = 'fooValue'
     * $query->filterByEmployeeLevel('%fooValue%', Criteria::LIKE); // WHERE employee_level LIKE '%fooValue%'
     * $query->filterByEmployeeLevel(['foo', 'bar']); // WHERE employee_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeLevel($employeeLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_EMPLOYEE_LEVEL, $employeeLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * $query->filterByMonth(['foo', 'bar']); // WHERE month IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $month The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonth($month = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dvp_report_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDvpReportId(1234); // WHERE dvp_report_id = 1234
     * $query->filterByDvpReportId(array(12, 34)); // WHERE dvp_report_id IN (12, 34)
     * $query->filterByDvpReportId(array('min' => 12)); // WHERE dvp_report_id > 12
     * </code>
     *
     * @param mixed $dvpReportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDvpReportId($dvpReportId = null, ?string $comparison = null)
    {
        if (is_array($dvpReportId)) {
            $useMinMax = false;
            if (isset($dvpReportId['min'])) {
                $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $dvpReportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dvpReportId['max'])) {
                $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $dvpReportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $dvpReportId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mr_detailing column
     *
     * Example usage:
     * <code>
     * $query->filterByMrDetailing('fooValue');   // WHERE mr_detailing = 'fooValue'
     * $query->filterByMrDetailing('%fooValue%', Criteria::LIKE); // WHERE mr_detailing LIKE '%fooValue%'
     * $query->filterByMrDetailing(['foo', 'bar']); // WHERE mr_detailing IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mrDetailing The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrDetailing($mrDetailing = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mrDetailing)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_MR_DETAILING, $mrDetailing, $comparison);

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
                $this->addUsingAlias(WriteDvpTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WriteDvpTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(WriteDvpTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WriteDvpTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteDvpTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWriteDvp $writeDvp Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($writeDvp = null)
    {
        if ($writeDvp) {
            $this->addUsingAlias(WriteDvpTableMap::COL_DVP_REPORT_ID, $writeDvp->getDvpReportId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the write_dvp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WriteDvpTableMap::clearInstancePool();
            WriteDvpTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WriteDvpTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WriteDvpTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WriteDvpTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

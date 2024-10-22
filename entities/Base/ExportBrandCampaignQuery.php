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
use entities\ExportBrandCampaign as ChildExportBrandCampaign;
use entities\ExportBrandCampaignQuery as ChildExportBrandCampaignQuery;
use entities\Map\ExportBrandCampaignTableMap;

/**
 * Base class that represents a query for the `export_brand_campaign` table.
 *
 * @method     ChildExportBrandCampaignQuery orderByBrandCampiagnVisitId($order = Criteria::ASC) Order by the brand_campiagn_visit_id column
 * @method     ChildExportBrandCampaignQuery orderByBrandCampiagnId($order = Criteria::ASC) Order by the brand_campiagn_id column
 * @method     ChildExportBrandCampaignQuery orderByBrandCampiagnVisitPlanId($order = Criteria::ASC) Order by the brand_campiagn_visit_plan_id column
 * @method     ChildExportBrandCampaignQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildExportBrandCampaignQuery orderByDcrId($order = Criteria::ASC) Order by the dcr_id column
 * @method     ChildExportBrandCampaignQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportBrandCampaignQuery orderByZmManagerBranch($order = Criteria::ASC) Order by the zm_manager_branch column
 * @method     ChildExportBrandCampaignQuery orderByZmManagerTown($order = Criteria::ASC) Order by the zm_manager_town column
 * @method     ChildExportBrandCampaignQuery orderByRmManagerBranch($order = Criteria::ASC) Order by the rm_manager_branch column
 * @method     ChildExportBrandCampaignQuery orderByRmManagerTown($order = Criteria::ASC) Order by the rm_manager_town column
 * @method     ChildExportBrandCampaignQuery orderByAmManagerBranch($order = Criteria::ASC) Order by the am_manager_branch column
 * @method     ChildExportBrandCampaignQuery orderByAmManagerTown($order = Criteria::ASC) Order by the am_manager_town column
 * @method     ChildExportBrandCampaignQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportBrandCampaignQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportBrandCampaignQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportBrandCampaignQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportBrandCampaignQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildExportBrandCampaignQuery orderByEdDuration($order = Criteria::ASC) Order by the ed_duration column
 * @method     ChildExportBrandCampaignQuery orderByCampiagnName($order = Criteria::ASC) Order by the campiagn_name column
 * @method     ChildExportBrandCampaignQuery orderByFocusBrands($order = Criteria::ASC) Order by the focus_brands column
 * @method     ChildExportBrandCampaignQuery orderByFocusBrandIds($order = Criteria::ASC) Order by the focus_brand_ids column
 * @method     ChildExportBrandCampaignQuery orderByCampaignStartDate($order = Criteria::ASC) Order by the campaign_start_date column
 * @method     ChildExportBrandCampaignQuery orderByCampaignEndDate($order = Criteria::ASC) Order by the campaign_end_date column
 * @method     ChildExportBrandCampaignQuery orderByOutletTags($order = Criteria::ASC) Order by the outlet_tags column
 * @method     ChildExportBrandCampaignQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildExportBrandCampaignQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildExportBrandCampaignQuery orderByOutletOrgCode($order = Criteria::ASC) Order by the outlet_org_code column
 * @method     ChildExportBrandCampaignQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildExportBrandCampaignQuery orderByStepNumber($order = Criteria::ASC) Order by the step_number column
 * @method     ChildExportBrandCampaignQuery orderBySgpiToBeGiven($order = Criteria::ASC) Order by the sgpi_to_be_given column
 * @method     ChildExportBrandCampaignQuery orderByVisitedDate($order = Criteria::ASC) Order by the visited_date column
 * @method     ChildExportBrandCampaignQuery orderByVisitedMonth($order = Criteria::ASC) Order by the visited_month column
 * @method     ChildExportBrandCampaignQuery orderBySgpiGiven($order = Criteria::ASC) Order by the sgpi_given column
 * @method     ChildExportBrandCampaignQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildExportBrandCampaignQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildExportBrandCampaignQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildExportBrandCampaignQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 *
 * @method     ChildExportBrandCampaignQuery groupByBrandCampiagnVisitId() Group by the brand_campiagn_visit_id column
 * @method     ChildExportBrandCampaignQuery groupByBrandCampiagnId() Group by the brand_campiagn_id column
 * @method     ChildExportBrandCampaignQuery groupByBrandCampiagnVisitPlanId() Group by the brand_campiagn_visit_plan_id column
 * @method     ChildExportBrandCampaignQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildExportBrandCampaignQuery groupByDcrId() Group by the dcr_id column
 * @method     ChildExportBrandCampaignQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportBrandCampaignQuery groupByZmManagerBranch() Group by the zm_manager_branch column
 * @method     ChildExportBrandCampaignQuery groupByZmManagerTown() Group by the zm_manager_town column
 * @method     ChildExportBrandCampaignQuery groupByRmManagerBranch() Group by the rm_manager_branch column
 * @method     ChildExportBrandCampaignQuery groupByRmManagerTown() Group by the rm_manager_town column
 * @method     ChildExportBrandCampaignQuery groupByAmManagerBranch() Group by the am_manager_branch column
 * @method     ChildExportBrandCampaignQuery groupByAmManagerTown() Group by the am_manager_town column
 * @method     ChildExportBrandCampaignQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportBrandCampaignQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportBrandCampaignQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportBrandCampaignQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportBrandCampaignQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildExportBrandCampaignQuery groupByEdDuration() Group by the ed_duration column
 * @method     ChildExportBrandCampaignQuery groupByCampiagnName() Group by the campiagn_name column
 * @method     ChildExportBrandCampaignQuery groupByFocusBrands() Group by the focus_brands column
 * @method     ChildExportBrandCampaignQuery groupByFocusBrandIds() Group by the focus_brand_ids column
 * @method     ChildExportBrandCampaignQuery groupByCampaignStartDate() Group by the campaign_start_date column
 * @method     ChildExportBrandCampaignQuery groupByCampaignEndDate() Group by the campaign_end_date column
 * @method     ChildExportBrandCampaignQuery groupByOutletTags() Group by the outlet_tags column
 * @method     ChildExportBrandCampaignQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildExportBrandCampaignQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildExportBrandCampaignQuery groupByOutletOrgCode() Group by the outlet_org_code column
 * @method     ChildExportBrandCampaignQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildExportBrandCampaignQuery groupByStepNumber() Group by the step_number column
 * @method     ChildExportBrandCampaignQuery groupBySgpiToBeGiven() Group by the sgpi_to_be_given column
 * @method     ChildExportBrandCampaignQuery groupByVisitedDate() Group by the visited_date column
 * @method     ChildExportBrandCampaignQuery groupByVisitedMonth() Group by the visited_month column
 * @method     ChildExportBrandCampaignQuery groupBySgpiGiven() Group by the sgpi_given column
 * @method     ChildExportBrandCampaignQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildExportBrandCampaignQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildExportBrandCampaignQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildExportBrandCampaignQuery groupByEmpPositionCode() Group by the emp_position_code column
 *
 * @method     ChildExportBrandCampaignQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportBrandCampaignQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportBrandCampaignQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportBrandCampaignQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportBrandCampaignQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportBrandCampaignQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportBrandCampaign|null findOne(?ConnectionInterface $con = null) Return the first ChildExportBrandCampaign matching the query
 * @method     ChildExportBrandCampaign findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportBrandCampaign matching the query, or a new ChildExportBrandCampaign object populated from the query conditions when no match is found
 *
 * @method     ChildExportBrandCampaign|null findOneByBrandCampiagnVisitId(int $brand_campiagn_visit_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_visit_id column
 * @method     ChildExportBrandCampaign|null findOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_id column
 * @method     ChildExportBrandCampaign|null findOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildExportBrandCampaign|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildExportBrandCampaign filtered by the outlet_org_data_id column
 * @method     ChildExportBrandCampaign|null findOneByDcrId(int $dcr_id) Return the first ChildExportBrandCampaign filtered by the dcr_id column
 * @method     ChildExportBrandCampaign|null findOneByBuName(string $bu_name) Return the first ChildExportBrandCampaign filtered by the bu_name column
 * @method     ChildExportBrandCampaign|null findOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportBrandCampaign filtered by the zm_manager_branch column
 * @method     ChildExportBrandCampaign|null findOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportBrandCampaign filtered by the zm_manager_town column
 * @method     ChildExportBrandCampaign|null findOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportBrandCampaign filtered by the rm_manager_branch column
 * @method     ChildExportBrandCampaign|null findOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportBrandCampaign filtered by the rm_manager_town column
 * @method     ChildExportBrandCampaign|null findOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportBrandCampaign filtered by the am_manager_branch column
 * @method     ChildExportBrandCampaign|null findOneByAmManagerTown(string $am_manager_town) Return the first ChildExportBrandCampaign filtered by the am_manager_town column
 * @method     ChildExportBrandCampaign|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportBrandCampaign filtered by the emp_position_name column
 * @method     ChildExportBrandCampaign|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportBrandCampaign filtered by the emp_branch column
 * @method     ChildExportBrandCampaign|null findOneByEmpLevel(string $emp_level) Return the first ChildExportBrandCampaign filtered by the emp_level column
 * @method     ChildExportBrandCampaign|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportBrandCampaign filtered by the employee_code column
 * @method     ChildExportBrandCampaign|null findOneByEmployeeName(string $employee_name) Return the first ChildExportBrandCampaign filtered by the employee_name column
 * @method     ChildExportBrandCampaign|null findOneByEdDuration(int $ed_duration) Return the first ChildExportBrandCampaign filtered by the ed_duration column
 * @method     ChildExportBrandCampaign|null findOneByCampiagnName(string $campiagn_name) Return the first ChildExportBrandCampaign filtered by the campiagn_name column
 * @method     ChildExportBrandCampaign|null findOneByFocusBrands(string $focus_brands) Return the first ChildExportBrandCampaign filtered by the focus_brands column
 * @method     ChildExportBrandCampaign|null findOneByFocusBrandIds(string $focus_brand_ids) Return the first ChildExportBrandCampaign filtered by the focus_brand_ids column
 * @method     ChildExportBrandCampaign|null findOneByCampaignStartDate(string $campaign_start_date) Return the first ChildExportBrandCampaign filtered by the campaign_start_date column
 * @method     ChildExportBrandCampaign|null findOneByCampaignEndDate(string $campaign_end_date) Return the first ChildExportBrandCampaign filtered by the campaign_end_date column
 * @method     ChildExportBrandCampaign|null findOneByOutletTags(string $outlet_tags) Return the first ChildExportBrandCampaign filtered by the outlet_tags column
 * @method     ChildExportBrandCampaign|null findOneByOutletName(string $outlet_name) Return the first ChildExportBrandCampaign filtered by the outlet_name column
 * @method     ChildExportBrandCampaign|null findOneByOutletCode(string $outlet_code) Return the first ChildExportBrandCampaign filtered by the outlet_code column
 * @method     ChildExportBrandCampaign|null findOneByOutletOrgCode(string $outlet_org_code) Return the first ChildExportBrandCampaign filtered by the outlet_org_code column
 * @method     ChildExportBrandCampaign|null findOneByOutletClassification(string $outlet_classification) Return the first ChildExportBrandCampaign filtered by the outlet_classification column
 * @method     ChildExportBrandCampaign|null findOneByStepNumber(int $step_number) Return the first ChildExportBrandCampaign filtered by the step_number column
 * @method     ChildExportBrandCampaign|null findOneBySgpiToBeGiven(string $sgpi_to_be_given) Return the first ChildExportBrandCampaign filtered by the sgpi_to_be_given column
 * @method     ChildExportBrandCampaign|null findOneByVisitedDate(string $visited_date) Return the first ChildExportBrandCampaign filtered by the visited_date column
 * @method     ChildExportBrandCampaign|null findOneByVisitedMonth(string $visited_month) Return the first ChildExportBrandCampaign filtered by the visited_month column
 * @method     ChildExportBrandCampaign|null findOneBySgpiGiven(string $sgpi_given) Return the first ChildExportBrandCampaign filtered by the sgpi_given column
 * @method     ChildExportBrandCampaign|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildExportBrandCampaign filtered by the zm_position_code column
 * @method     ChildExportBrandCampaign|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildExportBrandCampaign filtered by the rm_position_code column
 * @method     ChildExportBrandCampaign|null findOneByAmPositionCode(string $am_position_code) Return the first ChildExportBrandCampaign filtered by the am_position_code column
 * @method     ChildExportBrandCampaign|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportBrandCampaign filtered by the emp_position_code column
 *
 * @method     ChildExportBrandCampaign requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportBrandCampaign by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOne(?ConnectionInterface $con = null) Return the first ChildExportBrandCampaign matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportBrandCampaign requireOneByBrandCampiagnVisitId(int $brand_campiagn_visit_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_visit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildExportBrandCampaign filtered by the brand_campiagn_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildExportBrandCampaign filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByDcrId(int $dcr_id) Return the first ChildExportBrandCampaign filtered by the dcr_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByBuName(string $bu_name) Return the first ChildExportBrandCampaign filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByZmManagerBranch(string $zm_manager_branch) Return the first ChildExportBrandCampaign filtered by the zm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByZmManagerTown(string $zm_manager_town) Return the first ChildExportBrandCampaign filtered by the zm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByRmManagerBranch(string $rm_manager_branch) Return the first ChildExportBrandCampaign filtered by the rm_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByRmManagerTown(string $rm_manager_town) Return the first ChildExportBrandCampaign filtered by the rm_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByAmManagerBranch(string $am_manager_branch) Return the first ChildExportBrandCampaign filtered by the am_manager_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByAmManagerTown(string $am_manager_town) Return the first ChildExportBrandCampaign filtered by the am_manager_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportBrandCampaign filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmpBranch(string $emp_branch) Return the first ChildExportBrandCampaign filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmpLevel(string $emp_level) Return the first ChildExportBrandCampaign filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmployeeCode(string $employee_code) Return the first ChildExportBrandCampaign filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmployeeName(string $employee_name) Return the first ChildExportBrandCampaign filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEdDuration(int $ed_duration) Return the first ChildExportBrandCampaign filtered by the ed_duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByCampiagnName(string $campiagn_name) Return the first ChildExportBrandCampaign filtered by the campiagn_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByFocusBrands(string $focus_brands) Return the first ChildExportBrandCampaign filtered by the focus_brands column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByFocusBrandIds(string $focus_brand_ids) Return the first ChildExportBrandCampaign filtered by the focus_brand_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByCampaignStartDate(string $campaign_start_date) Return the first ChildExportBrandCampaign filtered by the campaign_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByCampaignEndDate(string $campaign_end_date) Return the first ChildExportBrandCampaign filtered by the campaign_end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletTags(string $outlet_tags) Return the first ChildExportBrandCampaign filtered by the outlet_tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletName(string $outlet_name) Return the first ChildExportBrandCampaign filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletCode(string $outlet_code) Return the first ChildExportBrandCampaign filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletOrgCode(string $outlet_org_code) Return the first ChildExportBrandCampaign filtered by the outlet_org_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByOutletClassification(string $outlet_classification) Return the first ChildExportBrandCampaign filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByStepNumber(int $step_number) Return the first ChildExportBrandCampaign filtered by the step_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneBySgpiToBeGiven(string $sgpi_to_be_given) Return the first ChildExportBrandCampaign filtered by the sgpi_to_be_given column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByVisitedDate(string $visited_date) Return the first ChildExportBrandCampaign filtered by the visited_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByVisitedMonth(string $visited_month) Return the first ChildExportBrandCampaign filtered by the visited_month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneBySgpiGiven(string $sgpi_given) Return the first ChildExportBrandCampaign filtered by the sgpi_given column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByZmPositionCode(string $zm_position_code) Return the first ChildExportBrandCampaign filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByRmPositionCode(string $rm_position_code) Return the first ChildExportBrandCampaign filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByAmPositionCode(string $am_position_code) Return the first ChildExportBrandCampaign filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportBrandCampaign requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportBrandCampaign filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportBrandCampaign[]|Collection find(?ConnectionInterface $con = null) Return ChildExportBrandCampaign objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> find(?ConnectionInterface $con = null) Return ChildExportBrandCampaign objects based on current ModelCriteria
 *
 * @method     ChildExportBrandCampaign[]|Collection findByBrandCampiagnVisitId(int|array<int> $brand_campiagn_visit_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_visit_id column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByBrandCampiagnVisitId(int|array<int> $brand_campiagn_visit_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_visit_id column
 * @method     ChildExportBrandCampaign[]|Collection findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_id column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_id column
 * @method     ChildExportBrandCampaign[]|Collection findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildExportBrandCampaign objects filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildExportBrandCampaign objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildExportBrandCampaign objects filtered by the outlet_org_data_id column
 * @method     ChildExportBrandCampaign[]|Collection findByDcrId(int|array<int> $dcr_id) Return ChildExportBrandCampaign objects filtered by the dcr_id column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByDcrId(int|array<int> $dcr_id) Return ChildExportBrandCampaign objects filtered by the dcr_id column
 * @method     ChildExportBrandCampaign[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportBrandCampaign objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByBuName(string|array<string> $bu_name) Return ChildExportBrandCampaign objects filtered by the bu_name column
 * @method     ChildExportBrandCampaign[]|Collection findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportBrandCampaign objects filtered by the zm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByZmManagerBranch(string|array<string> $zm_manager_branch) Return ChildExportBrandCampaign objects filtered by the zm_manager_branch column
 * @method     ChildExportBrandCampaign[]|Collection findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportBrandCampaign objects filtered by the zm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByZmManagerTown(string|array<string> $zm_manager_town) Return ChildExportBrandCampaign objects filtered by the zm_manager_town column
 * @method     ChildExportBrandCampaign[]|Collection findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportBrandCampaign objects filtered by the rm_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByRmManagerBranch(string|array<string> $rm_manager_branch) Return ChildExportBrandCampaign objects filtered by the rm_manager_branch column
 * @method     ChildExportBrandCampaign[]|Collection findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportBrandCampaign objects filtered by the rm_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByRmManagerTown(string|array<string> $rm_manager_town) Return ChildExportBrandCampaign objects filtered by the rm_manager_town column
 * @method     ChildExportBrandCampaign[]|Collection findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportBrandCampaign objects filtered by the am_manager_branch column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByAmManagerBranch(string|array<string> $am_manager_branch) Return ChildExportBrandCampaign objects filtered by the am_manager_branch column
 * @method     ChildExportBrandCampaign[]|Collection findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportBrandCampaign objects filtered by the am_manager_town column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByAmManagerTown(string|array<string> $am_manager_town) Return ChildExportBrandCampaign objects filtered by the am_manager_town column
 * @method     ChildExportBrandCampaign[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportBrandCampaign objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportBrandCampaign objects filtered by the emp_position_name column
 * @method     ChildExportBrandCampaign[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportBrandCampaign objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportBrandCampaign objects filtered by the emp_branch column
 * @method     ChildExportBrandCampaign[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportBrandCampaign objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmpLevel(string|array<string> $emp_level) Return ChildExportBrandCampaign objects filtered by the emp_level column
 * @method     ChildExportBrandCampaign[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportBrandCampaign objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportBrandCampaign objects filtered by the employee_code column
 * @method     ChildExportBrandCampaign[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildExportBrandCampaign objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmployeeName(string|array<string> $employee_name) Return ChildExportBrandCampaign objects filtered by the employee_name column
 * @method     ChildExportBrandCampaign[]|Collection findByEdDuration(int|array<int> $ed_duration) Return ChildExportBrandCampaign objects filtered by the ed_duration column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEdDuration(int|array<int> $ed_duration) Return ChildExportBrandCampaign objects filtered by the ed_duration column
 * @method     ChildExportBrandCampaign[]|Collection findByCampiagnName(string|array<string> $campiagn_name) Return ChildExportBrandCampaign objects filtered by the campiagn_name column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByCampiagnName(string|array<string> $campiagn_name) Return ChildExportBrandCampaign objects filtered by the campiagn_name column
 * @method     ChildExportBrandCampaign[]|Collection findByFocusBrands(string|array<string> $focus_brands) Return ChildExportBrandCampaign objects filtered by the focus_brands column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByFocusBrands(string|array<string> $focus_brands) Return ChildExportBrandCampaign objects filtered by the focus_brands column
 * @method     ChildExportBrandCampaign[]|Collection findByFocusBrandIds(string|array<string> $focus_brand_ids) Return ChildExportBrandCampaign objects filtered by the focus_brand_ids column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByFocusBrandIds(string|array<string> $focus_brand_ids) Return ChildExportBrandCampaign objects filtered by the focus_brand_ids column
 * @method     ChildExportBrandCampaign[]|Collection findByCampaignStartDate(string|array<string> $campaign_start_date) Return ChildExportBrandCampaign objects filtered by the campaign_start_date column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByCampaignStartDate(string|array<string> $campaign_start_date) Return ChildExportBrandCampaign objects filtered by the campaign_start_date column
 * @method     ChildExportBrandCampaign[]|Collection findByCampaignEndDate(string|array<string> $campaign_end_date) Return ChildExportBrandCampaign objects filtered by the campaign_end_date column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByCampaignEndDate(string|array<string> $campaign_end_date) Return ChildExportBrandCampaign objects filtered by the campaign_end_date column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletTags(string|array<string> $outlet_tags) Return ChildExportBrandCampaign objects filtered by the outlet_tags column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletTags(string|array<string> $outlet_tags) Return ChildExportBrandCampaign objects filtered by the outlet_tags column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildExportBrandCampaign objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletName(string|array<string> $outlet_name) Return ChildExportBrandCampaign objects filtered by the outlet_name column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildExportBrandCampaign objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletCode(string|array<string> $outlet_code) Return ChildExportBrandCampaign objects filtered by the outlet_code column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildExportBrandCampaign objects filtered by the outlet_org_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildExportBrandCampaign objects filtered by the outlet_org_code column
 * @method     ChildExportBrandCampaign[]|Collection findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportBrandCampaign objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByOutletClassification(string|array<string> $outlet_classification) Return ChildExportBrandCampaign objects filtered by the outlet_classification column
 * @method     ChildExportBrandCampaign[]|Collection findByStepNumber(int|array<int> $step_number) Return ChildExportBrandCampaign objects filtered by the step_number column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByStepNumber(int|array<int> $step_number) Return ChildExportBrandCampaign objects filtered by the step_number column
 * @method     ChildExportBrandCampaign[]|Collection findBySgpiToBeGiven(string|array<string> $sgpi_to_be_given) Return ChildExportBrandCampaign objects filtered by the sgpi_to_be_given column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findBySgpiToBeGiven(string|array<string> $sgpi_to_be_given) Return ChildExportBrandCampaign objects filtered by the sgpi_to_be_given column
 * @method     ChildExportBrandCampaign[]|Collection findByVisitedDate(string|array<string> $visited_date) Return ChildExportBrandCampaign objects filtered by the visited_date column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByVisitedDate(string|array<string> $visited_date) Return ChildExportBrandCampaign objects filtered by the visited_date column
 * @method     ChildExportBrandCampaign[]|Collection findByVisitedMonth(string|array<string> $visited_month) Return ChildExportBrandCampaign objects filtered by the visited_month column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByVisitedMonth(string|array<string> $visited_month) Return ChildExportBrandCampaign objects filtered by the visited_month column
 * @method     ChildExportBrandCampaign[]|Collection findBySgpiGiven(string|array<string> $sgpi_given) Return ChildExportBrandCampaign objects filtered by the sgpi_given column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findBySgpiGiven(string|array<string> $sgpi_given) Return ChildExportBrandCampaign objects filtered by the sgpi_given column
 * @method     ChildExportBrandCampaign[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportBrandCampaign objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildExportBrandCampaign objects filtered by the zm_position_code column
 * @method     ChildExportBrandCampaign[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportBrandCampaign objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildExportBrandCampaign objects filtered by the rm_position_code column
 * @method     ChildExportBrandCampaign[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportBrandCampaign objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByAmPositionCode(string|array<string> $am_position_code) Return ChildExportBrandCampaign objects filtered by the am_position_code column
 * @method     ChildExportBrandCampaign[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportBrandCampaign objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportBrandCampaign> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportBrandCampaign objects filtered by the emp_position_code column
 *
 * @method     ChildExportBrandCampaign[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportBrandCampaign> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportBrandCampaignQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportBrandCampaignQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportBrandCampaign', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportBrandCampaignQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportBrandCampaignQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportBrandCampaignQuery) {
            return $criteria;
        }
        $query = new ChildExportBrandCampaignQuery();
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
     * @return ChildExportBrandCampaign|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExportBrandCampaignTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExportBrandCampaignTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExportBrandCampaign A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_campiagn_visit_id, brand_campiagn_id, brand_campiagn_visit_plan_id, outlet_org_data_id, dcr_id, bu_name, zm_manager_branch, zm_manager_town, rm_manager_branch, rm_manager_town, am_manager_branch, am_manager_town, emp_position_name, emp_branch, emp_level, employee_code, employee_name, ed_duration, campiagn_name, focus_brands, focus_brand_ids, campaign_start_date, campaign_end_date, outlet_tags, outlet_name, outlet_code, outlet_org_code, outlet_classification, step_number, sgpi_to_be_given, visited_date, visited_month, sgpi_given, zm_position_code, rm_position_code, am_position_code, emp_position_code FROM export_brand_campaign WHERE brand_campiagn_visit_id = :p0';
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
            /** @var ChildExportBrandCampaign $obj */
            $obj = new ChildExportBrandCampaign();
            $obj->hydrate($row);
            ExportBrandCampaignTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExportBrandCampaign|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_visit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnVisitId(1234); // WHERE brand_campiagn_visit_id = 1234
     * $query->filterByBrandCampiagnVisitId(array(12, 34)); // WHERE brand_campiagn_visit_id IN (12, 34)
     * $query->filterByBrandCampiagnVisitId(array('min' => 12)); // WHERE brand_campiagn_visit_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnVisitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitId($brandCampiagnVisitId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnVisitId)) {
            $useMinMax = false;
            if (isset($brandCampiagnVisitId['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnVisitId['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $brandCampiagnVisitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnId(1234); // WHERE brand_campiagn_id = 1234
     * $query->filterByBrandCampiagnId(array(12, 34)); // WHERE brand_campiagn_id IN (12, 34)
     * $query->filterByBrandCampiagnId(array('min' => 12)); // WHERE brand_campiagn_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnId($brandCampiagnId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnId)) {
            $useMinMax = false;
            if (isset($brandCampiagnId['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnId['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_campiagn_visit_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandCampiagnVisitPlanId(1234); // WHERE brand_campiagn_visit_plan_id = 1234
     * $query->filterByBrandCampiagnVisitPlanId(array(12, 34)); // WHERE brand_campiagn_visit_plan_id IN (12, 34)
     * $query->filterByBrandCampiagnVisitPlanId(array('min' => 12)); // WHERE brand_campiagn_visit_plan_id > 12
     * </code>
     *
     * @param mixed $brandCampiagnVisitPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlanId($brandCampiagnVisitPlanId = null, ?string $comparison = null)
    {
        if (is_array($brandCampiagnVisitPlanId)) {
            $useMinMax = false;
            if (isset($brandCampiagnVisitPlanId['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnVisitPlanId['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId, $comparison);

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
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

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
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_DCR_ID, $dcrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcrId['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_DCR_ID, $dcrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_DCR_ID, $dcrId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the bu_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBuName('fooValue');   // WHERE bu_name = 'fooValue'
     * $query->filterByBuName('%fooValue%', Criteria::LIKE); // WHERE bu_name LIKE '%fooValue%'
     * $query->filterByBuName(['foo', 'bar']); // WHERE bu_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuName($buName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BU_NAME, $buName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByZmManagerBranch('fooValue');   // WHERE zm_manager_branch = 'fooValue'
     * $query->filterByZmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE zm_manager_branch LIKE '%fooValue%'
     * $query->filterByZmManagerBranch(['foo', 'bar']); // WHERE zm_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmManagerBranch($zmManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH, $zmManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByZmManagerTown('fooValue');   // WHERE zm_manager_town = 'fooValue'
     * $query->filterByZmManagerTown('%fooValue%', Criteria::LIKE); // WHERE zm_manager_town LIKE '%fooValue%'
     * $query->filterByZmManagerTown(['foo', 'bar']); // WHERE zm_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmManagerTown($zmManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN, $zmManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByRmManagerBranch('fooValue');   // WHERE rm_manager_branch = 'fooValue'
     * $query->filterByRmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE rm_manager_branch LIKE '%fooValue%'
     * $query->filterByRmManagerBranch(['foo', 'bar']); // WHERE rm_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmManagerBranch($rmManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH, $rmManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByRmManagerTown('fooValue');   // WHERE rm_manager_town = 'fooValue'
     * $query->filterByRmManagerTown('%fooValue%', Criteria::LIKE); // WHERE rm_manager_town LIKE '%fooValue%'
     * $query->filterByRmManagerTown(['foo', 'bar']); // WHERE rm_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmManagerTown($rmManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN, $rmManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_manager_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByAmManagerBranch('fooValue');   // WHERE am_manager_branch = 'fooValue'
     * $query->filterByAmManagerBranch('%fooValue%', Criteria::LIKE); // WHERE am_manager_branch LIKE '%fooValue%'
     * $query->filterByAmManagerBranch(['foo', 'bar']); // WHERE am_manager_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amManagerBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmManagerBranch($amManagerBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amManagerBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH, $amManagerBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_manager_town column
     *
     * Example usage:
     * <code>
     * $query->filterByAmManagerTown('fooValue');   // WHERE am_manager_town = 'fooValue'
     * $query->filterByAmManagerTown('%fooValue%', Criteria::LIKE); // WHERE am_manager_town LIKE '%fooValue%'
     * $query->filterByAmManagerTown(['foo', 'bar']); // WHERE am_manager_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amManagerTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmManagerTown($amManagerTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amManagerTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN, $amManagerTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionName('fooValue');   // WHERE emp_position_name = 'fooValue'
     * $query->filterByEmpPositionName('%fooValue%', Criteria::LIKE); // WHERE emp_position_name LIKE '%fooValue%'
     * $query->filterByEmpPositionName(['foo', 'bar']); // WHERE emp_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionName($empPositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpBranch('fooValue');   // WHERE emp_branch = 'fooValue'
     * $query->filterByEmpBranch('%fooValue%', Criteria::LIKE); // WHERE emp_branch LIKE '%fooValue%'
     * $query->filterByEmpBranch(['foo', 'bar']); // WHERE emp_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpBranch($empBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_level column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpLevel('fooValue');   // WHERE emp_level = 'fooValue'
     * $query->filterByEmpLevel('%fooValue%', Criteria::LIKE); // WHERE emp_level LIKE '%fooValue%'
     * $query->filterByEmpLevel(['foo', 'bar']); // WHERE emp_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpLevel($empLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

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
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ED_DURATION, $edDuration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edDuration['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ED_DURATION, $edDuration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ED_DURATION, $edDuration, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campiagn_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCampiagnName('fooValue');   // WHERE campiagn_name = 'fooValue'
     * $query->filterByCampiagnName('%fooValue%', Criteria::LIKE); // WHERE campiagn_name LIKE '%fooValue%'
     * $query->filterByCampiagnName(['foo', 'bar']); // WHERE campiagn_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $campiagnName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampiagnName($campiagnName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($campiagnName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME, $campiagnName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the focus_brands column
     *
     * Example usage:
     * <code>
     * $query->filterByFocusBrands('fooValue');   // WHERE focus_brands = 'fooValue'
     * $query->filterByFocusBrands('%fooValue%', Criteria::LIKE); // WHERE focus_brands LIKE '%fooValue%'
     * $query->filterByFocusBrands(['foo', 'bar']); // WHERE focus_brands IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $focusBrands The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFocusBrands($focusBrands = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($focusBrands)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_FOCUS_BRANDS, $focusBrands, $comparison);

        return $this;
    }

    /**
     * Filter the query on the focus_brand_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByFocusBrandIds('fooValue');   // WHERE focus_brand_ids = 'fooValue'
     * $query->filterByFocusBrandIds('%fooValue%', Criteria::LIKE); // WHERE focus_brand_ids LIKE '%fooValue%'
     * $query->filterByFocusBrandIds(['foo', 'bar']); // WHERE focus_brand_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $focusBrandIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFocusBrandIds($focusBrandIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($focusBrandIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS, $focusBrandIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campaign_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaignStartDate('2011-03-14'); // WHERE campaign_start_date = '2011-03-14'
     * $query->filterByCampaignStartDate('now'); // WHERE campaign_start_date = '2011-03-14'
     * $query->filterByCampaignStartDate(array('max' => 'yesterday')); // WHERE campaign_start_date > '2011-03-13'
     * </code>
     *
     * @param mixed $campaignStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampaignStartDate($campaignStartDate = null, ?string $comparison = null)
    {
        if (is_array($campaignStartDate)) {
            $useMinMax = false;
            if (isset($campaignStartDate['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE, $campaignStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignStartDate['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE, $campaignStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE, $campaignStartDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the campaign_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCampaignEndDate('2011-03-14'); // WHERE campaign_end_date = '2011-03-14'
     * $query->filterByCampaignEndDate('now'); // WHERE campaign_end_date = '2011-03-14'
     * $query->filterByCampaignEndDate(array('max' => 'yesterday')); // WHERE campaign_end_date > '2011-03-13'
     * </code>
     *
     * @param mixed $campaignEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCampaignEndDate($campaignEndDate = null, ?string $comparison = null)
    {
        if (is_array($campaignEndDate)) {
            $useMinMax = false;
            if (isset($campaignEndDate['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE, $campaignEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($campaignEndDate['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE, $campaignEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE, $campaignEndDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_tags column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTags('fooValue');   // WHERE outlet_tags = 'fooValue'
     * $query->filterByOutletTags('%fooValue%', Criteria::LIKE); // WHERE outlet_tags LIKE '%fooValue%'
     * $query->filterByOutletTags(['foo', 'bar']); // WHERE outlet_tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletTags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTags($outletTags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletTags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_TAGS, $outletTags, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE, $outletOrgCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_classification column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletClassification('fooValue');   // WHERE outlet_classification = 'fooValue'
     * $query->filterByOutletClassification('%fooValue%', Criteria::LIKE); // WHERE outlet_classification LIKE '%fooValue%'
     * $query->filterByOutletClassification(['foo', 'bar']); // WHERE outlet_classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletClassification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletClassification($outletClassification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletClassification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the step_number column
     *
     * Example usage:
     * <code>
     * $query->filterByStepNumber(1234); // WHERE step_number = 1234
     * $query->filterByStepNumber(array(12, 34)); // WHERE step_number IN (12, 34)
     * $query->filterByStepNumber(array('min' => 12)); // WHERE step_number > 12
     * </code>
     *
     * @param mixed $stepNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStepNumber($stepNumber = null, ?string $comparison = null)
    {
        if (is_array($stepNumber)) {
            $useMinMax = false;
            if (isset($stepNumber['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_STEP_NUMBER, $stepNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stepNumber['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_STEP_NUMBER, $stepNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_STEP_NUMBER, $stepNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_to_be_given column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiToBeGiven('fooValue');   // WHERE sgpi_to_be_given = 'fooValue'
     * $query->filterBySgpiToBeGiven('%fooValue%', Criteria::LIKE); // WHERE sgpi_to_be_given LIKE '%fooValue%'
     * $query->filterBySgpiToBeGiven(['foo', 'bar']); // WHERE sgpi_to_be_given IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiToBeGiven The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiToBeGiven($sgpiToBeGiven = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiToBeGiven)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN, $sgpiToBeGiven, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visited_date column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitedDate('2011-03-14'); // WHERE visited_date = '2011-03-14'
     * $query->filterByVisitedDate('now'); // WHERE visited_date = '2011-03-14'
     * $query->filterByVisitedDate(array('max' => 'yesterday')); // WHERE visited_date > '2011-03-13'
     * </code>
     *
     * @param mixed $visitedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitedDate($visitedDate = null, ?string $comparison = null)
    {
        if (is_array($visitedDate)) {
            $useMinMax = false;
            if (isset($visitedDate['min'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_VISITED_DATE, $visitedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitedDate['max'])) {
                $this->addUsingAlias(ExportBrandCampaignTableMap::COL_VISITED_DATE, $visitedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_VISITED_DATE, $visitedDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visited_month column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitedMonth('fooValue');   // WHERE visited_month = 'fooValue'
     * $query->filterByVisitedMonth('%fooValue%', Criteria::LIKE); // WHERE visited_month LIKE '%fooValue%'
     * $query->filterByVisitedMonth(['foo', 'bar']); // WHERE visited_month IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitedMonth The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitedMonth($visitedMonth = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitedMonth)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_VISITED_MONTH, $visitedMonth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_given column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiGiven('fooValue');   // WHERE sgpi_given = 'fooValue'
     * $query->filterBySgpiGiven('%fooValue%', Criteria::LIKE); // WHERE sgpi_given LIKE '%fooValue%'
     * $query->filterBySgpiGiven(['foo', 'bar']); // WHERE sgpi_given IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiGiven The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiGiven($sgpiGiven = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiGiven)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_SGPI_GIVEN, $sgpiGiven, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

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

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionCode('fooValue');   // WHERE emp_position_code = 'fooValue'
     * $query->filterByEmpPositionCode('%fooValue%', Criteria::LIKE); // WHERE emp_position_code LIKE '%fooValue%'
     * $query->filterByEmpPositionCode(['foo', 'bar']); // WHERE emp_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionCode($empPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportBrandCampaign $exportBrandCampaign Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportBrandCampaign = null)
    {
        if ($exportBrandCampaign) {
            $this->addUsingAlias(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, $exportBrandCampaign->getBrandCampiagnVisitId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

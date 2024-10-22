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
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\Map\BrandCampiagnVisitPlanTableMap;

/**
 * Base class that represents a query for the `brand_campiagn_visit_plan` table.
 *
 * @method     ChildBrandCampiagnVisitPlanQuery orderByBrandCampiagnVisitPlanId($order = Criteria::ASC) Order by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByBrandCampiagnId($order = Criteria::ASC) Order by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByVisitPlanOrder($order = Criteria::ASC) Order by the visit_plan_order column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildBrandCampiagnVisitPlanQuery orderBySgpiId($order = Criteria::ASC) Order by the sgpi_id column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByStepName($order = Criteria::ASC) Order by the step_name column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByStepLevel($order = Criteria::ASC) Order by the step_level column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByMoye($order = Criteria::ASC) Order by the moye column
 * @method     ChildBrandCampiagnVisitPlanQuery orderBySgpiStatus($order = Criteria::ASC) Order by the sgpi_status column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByAgendaType($order = Criteria::ASC) Order by the agenda_type column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByAgendaSubTypeId($order = Criteria::ASC) Order by the agenda_sub_type_id column
 * @method     ChildBrandCampiagnVisitPlanQuery orderByCreateSurvey($order = Criteria::ASC) Order by the create_survey column
 * @method     ChildBrandCampiagnVisitPlanQuery orderBySurveyId($order = Criteria::ASC) Order by the survey_id column
 *
 * @method     ChildBrandCampiagnVisitPlanQuery groupByBrandCampiagnVisitPlanId() Group by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByBrandCampiagnId() Group by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByVisitPlanOrder() Group by the visit_plan_order column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByDescription() Group by the description column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByCompanyId() Group by the company_id column
 * @method     ChildBrandCampiagnVisitPlanQuery groupBySgpiId() Group by the sgpi_id column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByStepName() Group by the step_name column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByStepLevel() Group by the step_level column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByMoye() Group by the moye column
 * @method     ChildBrandCampiagnVisitPlanQuery groupBySgpiStatus() Group by the sgpi_status column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByQty() Group by the qty column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByComment() Group by the comment column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByAgendaType() Group by the agenda_type column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByAgendaSubTypeId() Group by the agenda_sub_type_id column
 * @method     ChildBrandCampiagnVisitPlanQuery groupByCreateSurvey() Group by the create_survey column
 * @method     ChildBrandCampiagnVisitPlanQuery groupBySurveyId() Group by the survey_id column
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinAgendatypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agendatypes relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinAgendatypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agendatypes relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinAgendatypes($relationAlias = null) Adds a INNER JOIN clause to the query using the Agendatypes relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithAgendatypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Agendatypes relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithAgendatypes() Adds a LEFT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithAgendatypes() Adds a RIGHT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithAgendatypes() Adds a INNER JOIN clause and with to the query using the Agendatypes relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinSurvey($relationAlias = null) Adds a LEFT JOIN clause to the query using the Survey relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinSurvey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Survey relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinSurvey($relationAlias = null) Adds a INNER JOIN clause to the query using the Survey relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithSurvey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Survey relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithSurvey() Adds a LEFT JOIN clause and with to the query using the Survey relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithSurvey() Adds a RIGHT JOIN clause and with to the query using the Survey relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithSurvey() Adds a INNER JOIN clause and with to the query using the Survey relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinBrandCampiagnVisits($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinBrandCampiagnVisits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinBrandCampiagnVisits($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithBrandCampiagnVisits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithBrandCampiagnVisits() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithBrandCampiagnVisits() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisits relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithBrandCampiagnVisits() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisits relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinDailycallsAttendees($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinDailycallsAttendees($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsAttendees relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinDailycallsAttendees($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsAttendees relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithDailycallsAttendees($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithDailycallsAttendees() Adds a LEFT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithDailycallsAttendees() Adds a RIGHT JOIN clause and with to the query using the DailycallsAttendees relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithDailycallsAttendees() Adds a INNER JOIN clause and with to the query using the DailycallsAttendees relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinDayplan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dayplan relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinDayplan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dayplan relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinDayplan($relationAlias = null) Adds a INNER JOIN clause to the query using the Dayplan relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithDayplan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dayplan relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithDayplan() Adds a LEFT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithDayplan() Adds a RIGHT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithDayplan() Adds a INNER JOIN clause and with to the query using the Dayplan relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildBrandCampiagnVisitPlanQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildBrandCampiagnVisitPlanQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildBrandCampiagnVisitPlanQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     \entities\BrandCampiagnQuery|\entities\CompanyQuery|\entities\AgendatypesQuery|\entities\SurveyQuery|\entities\BrandCampiagnVisitsQuery|\entities\DailycallsAttendeesQuery|\entities\DayplanQuery|\entities\SurveySubmitedQuery|\entities\TourplansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBrandCampiagnVisitPlan|null findOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisitPlan matching the query
 * @method     ChildBrandCampiagnVisitPlan findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisitPlan matching the query, or a new ChildBrandCampiagnVisitPlan object populated from the query conditions when no match is found
 *
 * @method     ChildBrandCampiagnVisitPlan|null findOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildBrandCampiagnVisitPlan filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnVisitPlan filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByVisitPlanOrder(string $visit_plan_order) Return the first ChildBrandCampiagnVisitPlan filtered by the visit_plan_order column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByDescription(string $description) Return the first ChildBrandCampiagnVisitPlan filtered by the description column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByCompanyId(int $company_id) Return the first ChildBrandCampiagnVisitPlan filtered by the company_id column
 * @method     ChildBrandCampiagnVisitPlan|null findOneBySgpiId(string $sgpi_id) Return the first ChildBrandCampiagnVisitPlan filtered by the sgpi_id column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnVisitPlan filtered by the created_at column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnVisitPlan filtered by the updated_at column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByStepName(string $step_name) Return the first ChildBrandCampiagnVisitPlan filtered by the step_name column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByStepLevel(int $step_level) Return the first ChildBrandCampiagnVisitPlan filtered by the step_level column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByMoye(string $moye) Return the first ChildBrandCampiagnVisitPlan filtered by the moye column
 * @method     ChildBrandCampiagnVisitPlan|null findOneBySgpiStatus(boolean $sgpi_status) Return the first ChildBrandCampiagnVisitPlan filtered by the sgpi_status column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByQty(int $qty) Return the first ChildBrandCampiagnVisitPlan filtered by the qty column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByComment(string $comment) Return the first ChildBrandCampiagnVisitPlan filtered by the comment column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByAgendaType(string $agenda_type) Return the first ChildBrandCampiagnVisitPlan filtered by the agenda_type column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByAgendaSubTypeId(int $agenda_sub_type_id) Return the first ChildBrandCampiagnVisitPlan filtered by the agenda_sub_type_id column
 * @method     ChildBrandCampiagnVisitPlan|null findOneByCreateSurvey(boolean $create_survey) Return the first ChildBrandCampiagnVisitPlan filtered by the create_survey column
 * @method     ChildBrandCampiagnVisitPlan|null findOneBySurveyId(int $survey_id) Return the first ChildBrandCampiagnVisitPlan filtered by the survey_id column
 *
 * @method     ChildBrandCampiagnVisitPlan requirePk($key, ?ConnectionInterface $con = null) Return the ChildBrandCampiagnVisitPlan by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOne(?ConnectionInterface $con = null) Return the first ChildBrandCampiagnVisitPlan matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnVisitPlan requireOneByBrandCampiagnVisitPlanId(int $brand_campiagn_visit_plan_id) Return the first ChildBrandCampiagnVisitPlan filtered by the brand_campiagn_visit_plan_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByBrandCampiagnId(int $brand_campiagn_id) Return the first ChildBrandCampiagnVisitPlan filtered by the brand_campiagn_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByVisitPlanOrder(string $visit_plan_order) Return the first ChildBrandCampiagnVisitPlan filtered by the visit_plan_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByDescription(string $description) Return the first ChildBrandCampiagnVisitPlan filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByCompanyId(int $company_id) Return the first ChildBrandCampiagnVisitPlan filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneBySgpiId(string $sgpi_id) Return the first ChildBrandCampiagnVisitPlan filtered by the sgpi_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByCreatedAt(string $created_at) Return the first ChildBrandCampiagnVisitPlan filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByUpdatedAt(string $updated_at) Return the first ChildBrandCampiagnVisitPlan filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByStepName(string $step_name) Return the first ChildBrandCampiagnVisitPlan filtered by the step_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByStepLevel(int $step_level) Return the first ChildBrandCampiagnVisitPlan filtered by the step_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByMoye(string $moye) Return the first ChildBrandCampiagnVisitPlan filtered by the moye column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneBySgpiStatus(boolean $sgpi_status) Return the first ChildBrandCampiagnVisitPlan filtered by the sgpi_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByQty(int $qty) Return the first ChildBrandCampiagnVisitPlan filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByComment(string $comment) Return the first ChildBrandCampiagnVisitPlan filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByAgendaType(string $agenda_type) Return the first ChildBrandCampiagnVisitPlan filtered by the agenda_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByAgendaSubTypeId(int $agenda_sub_type_id) Return the first ChildBrandCampiagnVisitPlan filtered by the agenda_sub_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneByCreateSurvey(boolean $create_survey) Return the first ChildBrandCampiagnVisitPlan filtered by the create_survey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBrandCampiagnVisitPlan requireOneBySurveyId(int $survey_id) Return the first ChildBrandCampiagnVisitPlan filtered by the survey_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBrandCampiagnVisitPlan[]|Collection find(?ConnectionInterface $con = null) Return ChildBrandCampiagnVisitPlan objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> find(?ConnectionInterface $con = null) Return ChildBrandCampiagnVisitPlan objects based on current ModelCriteria
 *
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildBrandCampiagnVisitPlan objects filtered by the brand_campiagn_visit_plan_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByBrandCampiagnVisitPlanId(int|array<int> $brand_campiagn_visit_plan_id) Return ChildBrandCampiagnVisitPlan objects filtered by the brand_campiagn_visit_plan_id column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnVisitPlan objects filtered by the brand_campiagn_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByBrandCampiagnId(int|array<int> $brand_campiagn_id) Return ChildBrandCampiagnVisitPlan objects filtered by the brand_campiagn_id column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByVisitPlanOrder(string|array<string> $visit_plan_order) Return ChildBrandCampiagnVisitPlan objects filtered by the visit_plan_order column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByVisitPlanOrder(string|array<string> $visit_plan_order) Return ChildBrandCampiagnVisitPlan objects filtered by the visit_plan_order column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByDescription(string|array<string> $description) Return ChildBrandCampiagnVisitPlan objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByDescription(string|array<string> $description) Return ChildBrandCampiagnVisitPlan objects filtered by the description column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildBrandCampiagnVisitPlan objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByCompanyId(int|array<int> $company_id) Return ChildBrandCampiagnVisitPlan objects filtered by the company_id column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findBySgpiId(string|array<string> $sgpi_id) Return ChildBrandCampiagnVisitPlan objects filtered by the sgpi_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findBySgpiId(string|array<string> $sgpi_id) Return ChildBrandCampiagnVisitPlan objects filtered by the sgpi_id column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnVisitPlan objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByCreatedAt(string|array<string> $created_at) Return ChildBrandCampiagnVisitPlan objects filtered by the created_at column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnVisitPlan objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByUpdatedAt(string|array<string> $updated_at) Return ChildBrandCampiagnVisitPlan objects filtered by the updated_at column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByStepName(string|array<string> $step_name) Return ChildBrandCampiagnVisitPlan objects filtered by the step_name column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByStepName(string|array<string> $step_name) Return ChildBrandCampiagnVisitPlan objects filtered by the step_name column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByStepLevel(int|array<int> $step_level) Return ChildBrandCampiagnVisitPlan objects filtered by the step_level column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByStepLevel(int|array<int> $step_level) Return ChildBrandCampiagnVisitPlan objects filtered by the step_level column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByMoye(string|array<string> $moye) Return ChildBrandCampiagnVisitPlan objects filtered by the moye column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByMoye(string|array<string> $moye) Return ChildBrandCampiagnVisitPlan objects filtered by the moye column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildBrandCampiagnVisitPlan objects filtered by the sgpi_status column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findBySgpiStatus(boolean|array<boolean> $sgpi_status) Return ChildBrandCampiagnVisitPlan objects filtered by the sgpi_status column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByQty(int|array<int> $qty) Return ChildBrandCampiagnVisitPlan objects filtered by the qty column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByQty(int|array<int> $qty) Return ChildBrandCampiagnVisitPlan objects filtered by the qty column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByComment(string|array<string> $comment) Return ChildBrandCampiagnVisitPlan objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByComment(string|array<string> $comment) Return ChildBrandCampiagnVisitPlan objects filtered by the comment column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByAgendaType(string|array<string> $agenda_type) Return ChildBrandCampiagnVisitPlan objects filtered by the agenda_type column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByAgendaType(string|array<string> $agenda_type) Return ChildBrandCampiagnVisitPlan objects filtered by the agenda_type column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByAgendaSubTypeId(int|array<int> $agenda_sub_type_id) Return ChildBrandCampiagnVisitPlan objects filtered by the agenda_sub_type_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByAgendaSubTypeId(int|array<int> $agenda_sub_type_id) Return ChildBrandCampiagnVisitPlan objects filtered by the agenda_sub_type_id column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findByCreateSurvey(boolean|array<boolean> $create_survey) Return ChildBrandCampiagnVisitPlan objects filtered by the create_survey column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findByCreateSurvey(boolean|array<boolean> $create_survey) Return ChildBrandCampiagnVisitPlan objects filtered by the create_survey column
 * @method     ChildBrandCampiagnVisitPlan[]|Collection findBySurveyId(int|array<int> $survey_id) Return ChildBrandCampiagnVisitPlan objects filtered by the survey_id column
 * @psalm-method Collection&\Traversable<ChildBrandCampiagnVisitPlan> findBySurveyId(int|array<int> $survey_id) Return ChildBrandCampiagnVisitPlan objects filtered by the survey_id column
 *
 * @method     ChildBrandCampiagnVisitPlan[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBrandCampiagnVisitPlan> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class BrandCampiagnVisitPlanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\BrandCampiagnVisitPlanQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\BrandCampiagnVisitPlan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBrandCampiagnVisitPlanQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBrandCampiagnVisitPlanQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildBrandCampiagnVisitPlanQuery) {
            return $criteria;
        }
        $query = new ChildBrandCampiagnVisitPlanQuery();
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
     * @return ChildBrandCampiagnVisitPlan|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BrandCampiagnVisitPlanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBrandCampiagnVisitPlan A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT brand_campiagn_visit_plan_id, brand_campiagn_id, visit_plan_order, description, company_id, sgpi_id, created_at, updated_at, step_name, step_level, moye, sgpi_status, qty, comment, agenda_type, agenda_sub_type_id, create_survey, survey_id FROM brand_campiagn_visit_plan WHERE brand_campiagn_visit_plan_id = :p0';
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
            /** @var ChildBrandCampiagnVisitPlan $obj */
            $obj = new ChildBrandCampiagnVisitPlan();
            $obj->hydrate($row);
            BrandCampiagnVisitPlanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBrandCampiagnVisitPlan|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnVisitPlanId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlanId, $comparison);

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
     * @see       filterByBrandCampiagn()
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
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandCampiagnId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagnId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_plan_order column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitPlanOrder('fooValue');   // WHERE visit_plan_order = 'fooValue'
     * $query->filterByVisitPlanOrder('%fooValue%', Criteria::LIKE); // WHERE visit_plan_order LIKE '%fooValue%'
     * $query->filterByVisitPlanOrder(['foo', 'bar']); // WHERE visit_plan_order IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $visitPlanOrder The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitPlanOrder($visitPlanOrder = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visitPlanOrder)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_VISIT_PLAN_ORDER, $visitPlanOrder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription(['foo', 'bar']); // WHERE description IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $description The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription($description = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_DESCRIPTION, $description, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiId('fooValue');   // WHERE sgpi_id = 'fooValue'
     * $query->filterBySgpiId('%fooValue%', Criteria::LIKE); // WHERE sgpi_id LIKE '%fooValue%'
     * $query->filterBySgpiId(['foo', 'bar']); // WHERE sgpi_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiId($sgpiId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SGPI_ID, $sgpiId, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the step_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStepName('fooValue');   // WHERE step_name = 'fooValue'
     * $query->filterByStepName('%fooValue%', Criteria::LIKE); // WHERE step_name LIKE '%fooValue%'
     * $query->filterByStepName(['foo', 'bar']); // WHERE step_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stepName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStepName($stepName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stepName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_STEP_NAME, $stepName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the step_level column
     *
     * Example usage:
     * <code>
     * $query->filterByStepLevel(1234); // WHERE step_level = 1234
     * $query->filterByStepLevel(array(12, 34)); // WHERE step_level IN (12, 34)
     * $query->filterByStepLevel(array('min' => 12)); // WHERE step_level > 12
     * </code>
     *
     * @param mixed $stepLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStepLevel($stepLevel = null, ?string $comparison = null)
    {
        if (is_array($stepLevel)) {
            $useMinMax = false;
            if (isset($stepLevel['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL, $stepLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stepLevel['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL, $stepLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_STEP_LEVEL, $stepLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the moye column
     *
     * Example usage:
     * <code>
     * $query->filterByMoye('fooValue');   // WHERE moye = 'fooValue'
     * $query->filterByMoye('%fooValue%', Criteria::LIKE); // WHERE moye LIKE '%fooValue%'
     * $query->filterByMoye(['foo', 'bar']); // WHERE moye IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $moye The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMoye($moye = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($moye)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_MOYE, $moye, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_status column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiStatus(true); // WHERE sgpi_status = true
     * $query->filterBySgpiStatus('yes'); // WHERE sgpi_status = true
     * </code>
     *
     * @param bool|string $sgpiStatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiStatus($sgpiStatus = null, ?string $comparison = null)
    {
        if (is_string($sgpiStatus)) {
            $sgpiStatus = in_array(strtolower($sgpiStatus), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SGPI_STATUS, $sgpiStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQty($qty = null, ?string $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_QTY, $qty, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment(['foo', 'bar']); // WHERE comment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment($comment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMMENT, $comment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda_type column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaType('fooValue');   // WHERE agenda_type = 'fooValue'
     * $query->filterByAgendaType('%fooValue%', Criteria::LIKE); // WHERE agenda_type LIKE '%fooValue%'
     * $query->filterByAgendaType(['foo', 'bar']); // WHERE agenda_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agendaType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaType($agendaType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agendaType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_TYPE, $agendaType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda_sub_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAgendaSubTypeId(1234); // WHERE agenda_sub_type_id = 1234
     * $query->filterByAgendaSubTypeId(array(12, 34)); // WHERE agenda_sub_type_id IN (12, 34)
     * $query->filterByAgendaSubTypeId(array('min' => 12)); // WHERE agenda_sub_type_id > 12
     * </code>
     *
     * @see       filterByAgendatypes()
     *
     * @param mixed $agendaSubTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendaSubTypeId($agendaSubTypeId = null, ?string $comparison = null)
    {
        if (is_array($agendaSubTypeId)) {
            $useMinMax = false;
            if (isset($agendaSubTypeId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $agendaSubTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agendaSubTypeId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $agendaSubTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $agendaSubTypeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the create_survey column
     *
     * Example usage:
     * <code>
     * $query->filterByCreateSurvey(true); // WHERE create_survey = true
     * $query->filterByCreateSurvey('yes'); // WHERE create_survey = true
     * </code>
     *
     * @param bool|string $createSurvey The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreateSurvey($createSurvey = null, ?string $comparison = null)
    {
        if (is_string($createSurvey)) {
            $createSurvey = in_array(strtolower($createSurvey), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_CREATE_SURVEY, $createSurvey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the survey_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySurveyId(1234); // WHERE survey_id = 1234
     * $query->filterBySurveyId(array(12, 34)); // WHERE survey_id IN (12, 34)
     * $query->filterBySurveyId(array('min' => 12)); // WHERE survey_id > 12
     * </code>
     *
     * @see       filterBySurvey()
     *
     * @param mixed $surveyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyId($surveyId = null, ?string $comparison = null)
    {
        if (is_array($surveyId)) {
            $useMinMax = false;
            if (isset($surveyId['min'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $surveyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($surveyId['max'])) {
                $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $surveyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $surveyId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\BrandCampiagn object
     *
     * @param \entities\BrandCampiagn|ObjectCollection $brandCampiagn The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagn($brandCampiagn, ?string $comparison = null)
    {
        if ($brandCampiagn instanceof \entities\BrandCampiagn) {
            return $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->getBrandCampiagnId(), $comparison);
        } elseif ($brandCampiagn instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_ID, $brandCampiagn->toKeyValue('PrimaryKey', 'BrandCampiagnId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagn() only accepts arguments of type \entities\BrandCampiagn or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagn relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagn(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagn');

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
            $this->addJoinObject($join, 'BrandCampiagn');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagn($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagn', '\entities\BrandCampiagnQuery');
    }

    /**
     * Use the BrandCampiagn relation BrandCampiagn object
     *
     * @param callable(\entities\BrandCampiagnQuery):\entities\BrandCampiagnQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagn table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useExistsQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagn table for a NOT IN query.
     *
     * @see useBrandCampiagnInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnQuery */
        $q = $this->useInQuery('BrandCampiagn', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $agendatypes->getAgendaid(), $comparison);
        } elseif ($agendatypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_AGENDA_SUB_TYPE_ID, $agendatypes->toKeyValue('PrimaryKey', 'Agendaid'), $comparison);

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
     * Filter the query by a related \entities\Survey object
     *
     * @param \entities\Survey|ObjectCollection $survey The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurvey($survey, ?string $comparison = null)
    {
        if ($survey instanceof \entities\Survey) {
            return $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $survey->getSurveyId(), $comparison);
        } elseif ($survey instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_SURVEY_ID, $survey->toKeyValue('PrimaryKey', 'SurveyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySurvey() only accepts arguments of type \entities\Survey or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Survey relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurvey(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Survey');

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
            $this->addJoinObject($join, 'Survey');
        }

        return $this;
    }

    /**
     * Use the Survey relation Survey object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurvey($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Survey', '\entities\SurveyQuery');
    }

    /**
     * Use the Survey relation Survey object
     *
     * @param callable(\entities\SurveyQuery):\entities\SurveyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Survey table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuery The inner query object of the EXISTS statement
     */
    public function useSurveyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT EXISTS query.
     *
     * @see useSurveyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useExistsQuery('Survey', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Survey table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuery The inner query object of the IN statement
     */
    public function useInSurveyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Survey table for a NOT IN query.
     *
     * @see useSurveyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuery */
        $q = $this->useInQuery('Survey', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisits->getBrandCampiagnVisitPlanId(), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $dailycallsAttendees->getBrandCampaignVisitPlanId(), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $dayplan->getCampaignVisitPlanId(), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $surveySubmited->getBrandcampaignVisitPlanId(), $comparison);

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
                ->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $tourplans->getCampaignVisitPlanId(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildBrandCampiagnVisitPlan $brandCampiagnVisitPlan Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($brandCampiagnVisitPlan = null)
    {
        if ($brandCampiagnVisitPlan) {
            $this->addUsingAlias(BrandCampiagnVisitPlanTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, $brandCampiagnVisitPlan->getBrandCampiagnVisitPlanId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the brand_campiagn_visit_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BrandCampiagnVisitPlanTableMap::clearInstancePool();
            BrandCampiagnVisitPlanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BrandCampiagnVisitPlanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BrandCampiagnVisitPlanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BrandCampiagnVisitPlanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

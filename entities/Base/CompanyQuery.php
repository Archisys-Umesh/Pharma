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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Map\CompanyTableMap;

/**
 * Base class that represents a query for the `company` table.
 *
 * @method     ChildCompanyQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildCompanyQuery orderByCompanyCode($order = Criteria::ASC) Order by the company_code column
 * @method     ChildCompanyQuery orderByCompanyName($order = Criteria::ASC) Order by the company_name column
 * @method     ChildCompanyQuery orderByOwnerName($order = Criteria::ASC) Order by the owner_name column
 * @method     ChildCompanyQuery orderByCompanyPhoneNumber($order = Criteria::ASC) Order by the company_phone_number column
 * @method     ChildCompanyQuery orderByCompanyContactNumber($order = Criteria::ASC) Order by the company_contact_number column
 * @method     ChildCompanyQuery orderByCompanyLogo($order = Criteria::ASC) Order by the company_logo column
 * @method     ChildCompanyQuery orderByCompanyAddress1($order = Criteria::ASC) Order by the company_address_1 column
 * @method     ChildCompanyQuery orderByCompanyAddress2($order = Criteria::ASC) Order by the company_address_2 column
 * @method     ChildCompanyQuery orderByCompanyDefaultCurrency($order = Criteria::ASC) Order by the company_default_currency column
 * @method     ChildCompanyQuery orderByTimezone($order = Criteria::ASC) Order by the timezone column
 * @method     ChildCompanyQuery orderByCompanyFirstSetup($order = Criteria::ASC) Order by the company_first_setup column
 * @method     ChildCompanyQuery orderByOwnerEmail($order = Criteria::ASC) Order by the owner_email column
 * @method     ChildCompanyQuery orderByExpenseReminder($order = Criteria::ASC) Order by the expense_reminder column
 * @method     ChildCompanyQuery orderByCurrentmonthsubmit($order = Criteria::ASC) Order by the currentmonthsubmit column
 * @method     ChildCompanyQuery orderByTripapprovalreq($order = Criteria::ASC) Order by the tripapprovalreq column
 * @method     ChildCompanyQuery orderByExpenseonlyontrip($order = Criteria::ASC) Order by the expenseonlyontrip column
 * @method     ChildCompanyQuery orderByAllowbackdatedtrip($order = Criteria::ASC) Order by the allowbackdatedtrip column
 * @method     ChildCompanyQuery orderByPaymentsystem($order = Criteria::ASC) Order by the paymentsystem column
 * @method     ChildCompanyQuery orderByAutoSettle($order = Criteria::ASC) Order by the auto_settle column
 * @method     ChildCompanyQuery orderByAllowradius($order = Criteria::ASC) Order by the allowradius column
 * @method     ChildCompanyQuery orderByOrderSeq($order = Criteria::ASC) Order by the order_seq column
 * @method     ChildCompanyQuery orderByShippingorderSeq($order = Criteria::ASC) Order by the shippingorder_seq column
 * @method     ChildCompanyQuery orderByGooglemapkey($order = Criteria::ASC) Order by the googlemapkey column
 * @method     ChildCompanyQuery orderByWorkingdaysinweek($order = Criteria::ASC) Order by the workingdaysinweek column
 * @method     ChildCompanyQuery orderByAutoCalculatedTa($order = Criteria::ASC) Order by the auto_calculated_ta column
 * @method     ChildCompanyQuery orderByReportingDays($order = Criteria::ASC) Order by the reporting_days column
 * @method     ChildCompanyQuery orderByExpenseMonths($order = Criteria::ASC) Order by the expense_months column
 *
 * @method     ChildCompanyQuery groupByCompanyId() Group by the company_id column
 * @method     ChildCompanyQuery groupByCompanyCode() Group by the company_code column
 * @method     ChildCompanyQuery groupByCompanyName() Group by the company_name column
 * @method     ChildCompanyQuery groupByOwnerName() Group by the owner_name column
 * @method     ChildCompanyQuery groupByCompanyPhoneNumber() Group by the company_phone_number column
 * @method     ChildCompanyQuery groupByCompanyContactNumber() Group by the company_contact_number column
 * @method     ChildCompanyQuery groupByCompanyLogo() Group by the company_logo column
 * @method     ChildCompanyQuery groupByCompanyAddress1() Group by the company_address_1 column
 * @method     ChildCompanyQuery groupByCompanyAddress2() Group by the company_address_2 column
 * @method     ChildCompanyQuery groupByCompanyDefaultCurrency() Group by the company_default_currency column
 * @method     ChildCompanyQuery groupByTimezone() Group by the timezone column
 * @method     ChildCompanyQuery groupByCompanyFirstSetup() Group by the company_first_setup column
 * @method     ChildCompanyQuery groupByOwnerEmail() Group by the owner_email column
 * @method     ChildCompanyQuery groupByExpenseReminder() Group by the expense_reminder column
 * @method     ChildCompanyQuery groupByCurrentmonthsubmit() Group by the currentmonthsubmit column
 * @method     ChildCompanyQuery groupByTripapprovalreq() Group by the tripapprovalreq column
 * @method     ChildCompanyQuery groupByExpenseonlyontrip() Group by the expenseonlyontrip column
 * @method     ChildCompanyQuery groupByAllowbackdatedtrip() Group by the allowbackdatedtrip column
 * @method     ChildCompanyQuery groupByPaymentsystem() Group by the paymentsystem column
 * @method     ChildCompanyQuery groupByAutoSettle() Group by the auto_settle column
 * @method     ChildCompanyQuery groupByAllowradius() Group by the allowradius column
 * @method     ChildCompanyQuery groupByOrderSeq() Group by the order_seq column
 * @method     ChildCompanyQuery groupByShippingorderSeq() Group by the shippingorder_seq column
 * @method     ChildCompanyQuery groupByGooglemapkey() Group by the googlemapkey column
 * @method     ChildCompanyQuery groupByWorkingdaysinweek() Group by the workingdaysinweek column
 * @method     ChildCompanyQuery groupByAutoCalculatedTa() Group by the auto_calculated_ta column
 * @method     ChildCompanyQuery groupByReportingDays() Group by the reporting_days column
 * @method     ChildCompanyQuery groupByExpenseMonths() Group by the expense_months column
 *
 * @method     ChildCompanyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompanyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompanyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompanyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCompanyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCompanyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCompanyQuery leftJoinExpenseMasterRelatedByAutoCalculatedTa($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 * @method     ChildCompanyQuery rightJoinExpenseMasterRelatedByAutoCalculatedTa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 * @method     ChildCompanyQuery innerJoinExpenseMasterRelatedByAutoCalculatedTa($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 *
 * @method     ChildCompanyQuery joinWithExpenseMasterRelatedByAutoCalculatedTa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 *
 * @method     ChildCompanyQuery leftJoinWithExpenseMasterRelatedByAutoCalculatedTa() Adds a LEFT JOIN clause and with to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 * @method     ChildCompanyQuery rightJoinWithExpenseMasterRelatedByAutoCalculatedTa() Adds a RIGHT JOIN clause and with to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 * @method     ChildCompanyQuery innerJoinWithExpenseMasterRelatedByAutoCalculatedTa() Adds a INNER JOIN clause and with to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
 *
 * @method     ChildCompanyQuery leftJoinCurrencies($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currencies relation
 * @method     ChildCompanyQuery rightJoinCurrencies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currencies relation
 * @method     ChildCompanyQuery innerJoinCurrencies($relationAlias = null) Adds a INNER JOIN clause to the query using the Currencies relation
 *
 * @method     ChildCompanyQuery joinWithCurrencies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currencies relation
 *
 * @method     ChildCompanyQuery leftJoinWithCurrencies() Adds a LEFT JOIN clause and with to the query using the Currencies relation
 * @method     ChildCompanyQuery rightJoinWithCurrencies() Adds a RIGHT JOIN clause and with to the query using the Currencies relation
 * @method     ChildCompanyQuery innerJoinWithCurrencies() Adds a INNER JOIN clause and with to the query using the Currencies relation
 *
 * @method     ChildCompanyQuery leftJoinAgendatypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agendatypes relation
 * @method     ChildCompanyQuery rightJoinAgendatypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agendatypes relation
 * @method     ChildCompanyQuery innerJoinAgendatypes($relationAlias = null) Adds a INNER JOIN clause to the query using the Agendatypes relation
 *
 * @method     ChildCompanyQuery joinWithAgendatypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Agendatypes relation
 *
 * @method     ChildCompanyQuery leftJoinWithAgendatypes() Adds a LEFT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildCompanyQuery rightJoinWithAgendatypes() Adds a RIGHT JOIN clause and with to the query using the Agendatypes relation
 * @method     ChildCompanyQuery innerJoinWithAgendatypes() Adds a INNER JOIN clause and with to the query using the Agendatypes relation
 *
 * @method     ChildCompanyQuery leftJoinAnnouncements($relationAlias = null) Adds a LEFT JOIN clause to the query using the Announcements relation
 * @method     ChildCompanyQuery rightJoinAnnouncements($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Announcements relation
 * @method     ChildCompanyQuery innerJoinAnnouncements($relationAlias = null) Adds a INNER JOIN clause to the query using the Announcements relation
 *
 * @method     ChildCompanyQuery joinWithAnnouncements($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Announcements relation
 *
 * @method     ChildCompanyQuery leftJoinWithAnnouncements() Adds a LEFT JOIN clause and with to the query using the Announcements relation
 * @method     ChildCompanyQuery rightJoinWithAnnouncements() Adds a RIGHT JOIN clause and with to the query using the Announcements relation
 * @method     ChildCompanyQuery innerJoinWithAnnouncements() Adds a INNER JOIN clause and with to the query using the Announcements relation
 *
 * @method     ChildCompanyQuery leftJoinApiKeys($relationAlias = null) Adds a LEFT JOIN clause to the query using the ApiKeys relation
 * @method     ChildCompanyQuery rightJoinApiKeys($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ApiKeys relation
 * @method     ChildCompanyQuery innerJoinApiKeys($relationAlias = null) Adds a INNER JOIN clause to the query using the ApiKeys relation
 *
 * @method     ChildCompanyQuery joinWithApiKeys($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ApiKeys relation
 *
 * @method     ChildCompanyQuery leftJoinWithApiKeys() Adds a LEFT JOIN clause and with to the query using the ApiKeys relation
 * @method     ChildCompanyQuery rightJoinWithApiKeys() Adds a RIGHT JOIN clause and with to the query using the ApiKeys relation
 * @method     ChildCompanyQuery innerJoinWithApiKeys() Adds a INNER JOIN clause and with to the query using the ApiKeys relation
 *
 * @method     ChildCompanyQuery leftJoinAttendance($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendance relation
 * @method     ChildCompanyQuery rightJoinAttendance($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendance relation
 * @method     ChildCompanyQuery innerJoinAttendance($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendance relation
 *
 * @method     ChildCompanyQuery joinWithAttendance($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attendance relation
 *
 * @method     ChildCompanyQuery leftJoinWithAttendance() Adds a LEFT JOIN clause and with to the query using the Attendance relation
 * @method     ChildCompanyQuery rightJoinWithAttendance() Adds a RIGHT JOIN clause and with to the query using the Attendance relation
 * @method     ChildCompanyQuery innerJoinWithAttendance() Adds a INNER JOIN clause and with to the query using the Attendance relation
 *
 * @method     ChildCompanyQuery leftJoinBeatOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildCompanyQuery rightJoinBeatOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BeatOutlets relation
 * @method     ChildCompanyQuery innerJoinBeatOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the BeatOutlets relation
 *
 * @method     ChildCompanyQuery joinWithBeatOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildCompanyQuery leftJoinWithBeatOutlets() Adds a LEFT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildCompanyQuery rightJoinWithBeatOutlets() Adds a RIGHT JOIN clause and with to the query using the BeatOutlets relation
 * @method     ChildCompanyQuery innerJoinWithBeatOutlets() Adds a INNER JOIN clause and with to the query using the BeatOutlets relation
 *
 * @method     ChildCompanyQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildCompanyQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildCompanyQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildCompanyQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildCompanyQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildCompanyQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildCompanyQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildCompanyQuery leftJoinBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the Branch relation
 * @method     ChildCompanyQuery rightJoinBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Branch relation
 * @method     ChildCompanyQuery innerJoinBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the Branch relation
 *
 * @method     ChildCompanyQuery joinWithBranch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Branch relation
 *
 * @method     ChildCompanyQuery leftJoinWithBranch() Adds a LEFT JOIN clause and with to the query using the Branch relation
 * @method     ChildCompanyQuery rightJoinWithBranch() Adds a RIGHT JOIN clause and with to the query using the Branch relation
 * @method     ChildCompanyQuery innerJoinWithBranch() Adds a INNER JOIN clause and with to the query using the Branch relation
 *
 * @method     ChildCompanyQuery leftJoinBrandCampiagn($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildCompanyQuery rightJoinBrandCampiagn($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagn relation
 * @method     ChildCompanyQuery innerJoinBrandCampiagn($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagn relation
 *
 * @method     ChildCompanyQuery joinWithBrandCampiagn($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrandCampiagn() Adds a LEFT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildCompanyQuery rightJoinWithBrandCampiagn() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagn relation
 * @method     ChildCompanyQuery innerJoinWithBrandCampiagn() Adds a INNER JOIN clause and with to the query using the BrandCampiagn relation
 *
 * @method     ChildCompanyQuery leftJoinBrandCampiagnDoctors($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildCompanyQuery rightJoinBrandCampiagnDoctors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnDoctors relation
 * @method     ChildCompanyQuery innerJoinBrandCampiagnDoctors($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildCompanyQuery joinWithBrandCampiagnDoctors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrandCampiagnDoctors() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildCompanyQuery rightJoinWithBrandCampiagnDoctors() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnDoctors relation
 * @method     ChildCompanyQuery innerJoinWithBrandCampiagnDoctors() Adds a INNER JOIN clause and with to the query using the BrandCampiagnDoctors relation
 *
 * @method     ChildCompanyQuery leftJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildCompanyQuery rightJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildCompanyQuery innerJoinBrandCampiagnVisitPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildCompanyQuery joinWithBrandCampiagnVisitPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrandCampiagnVisitPlan() Adds a LEFT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildCompanyQuery rightJoinWithBrandCampiagnVisitPlan() Adds a RIGHT JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 * @method     ChildCompanyQuery innerJoinWithBrandCampiagnVisitPlan() Adds a INNER JOIN clause and with to the query using the BrandCampiagnVisitPlan relation
 *
 * @method     ChildCompanyQuery leftJoinBrandCompetition($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildCompanyQuery rightJoinBrandCompetition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandCompetition relation
 * @method     ChildCompanyQuery innerJoinBrandCompetition($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandCompetition relation
 *
 * @method     ChildCompanyQuery joinWithBrandCompetition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrandCompetition() Adds a LEFT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildCompanyQuery rightJoinWithBrandCompetition() Adds a RIGHT JOIN clause and with to the query using the BrandCompetition relation
 * @method     ChildCompanyQuery innerJoinWithBrandCompetition() Adds a INNER JOIN clause and with to the query using the BrandCompetition relation
 *
 * @method     ChildCompanyQuery leftJoinBrandRcpa($relationAlias = null) Adds a LEFT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildCompanyQuery rightJoinBrandRcpa($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BrandRcpa relation
 * @method     ChildCompanyQuery innerJoinBrandRcpa($relationAlias = null) Adds a INNER JOIN clause to the query using the BrandRcpa relation
 *
 * @method     ChildCompanyQuery joinWithBrandRcpa($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrandRcpa() Adds a LEFT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildCompanyQuery rightJoinWithBrandRcpa() Adds a RIGHT JOIN clause and with to the query using the BrandRcpa relation
 * @method     ChildCompanyQuery innerJoinWithBrandRcpa() Adds a INNER JOIN clause and with to the query using the BrandRcpa relation
 *
 * @method     ChildCompanyQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildCompanyQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildCompanyQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildCompanyQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildCompanyQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildCompanyQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildCompanyQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildCompanyQuery leftJoinBudgetGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildCompanyQuery rightJoinBudgetGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BudgetGroup relation
 * @method     ChildCompanyQuery innerJoinBudgetGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the BudgetGroup relation
 *
 * @method     ChildCompanyQuery joinWithBudgetGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildCompanyQuery leftJoinWithBudgetGroup() Adds a LEFT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildCompanyQuery rightJoinWithBudgetGroup() Adds a RIGHT JOIN clause and with to the query using the BudgetGroup relation
 * @method     ChildCompanyQuery innerJoinWithBudgetGroup() Adds a INNER JOIN clause and with to the query using the BudgetGroup relation
 *
 * @method     ChildCompanyQuery leftJoinCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categories relation
 * @method     ChildCompanyQuery rightJoinCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categories relation
 * @method     ChildCompanyQuery innerJoinCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the Categories relation
 *
 * @method     ChildCompanyQuery joinWithCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categories relation
 *
 * @method     ChildCompanyQuery leftJoinWithCategories() Adds a LEFT JOIN clause and with to the query using the Categories relation
 * @method     ChildCompanyQuery rightJoinWithCategories() Adds a RIGHT JOIN clause and with to the query using the Categories relation
 * @method     ChildCompanyQuery innerJoinWithCategories() Adds a INNER JOIN clause and with to the query using the Categories relation
 *
 * @method     ChildCompanyQuery leftJoinCheckinoutOutcomes($relationAlias = null) Adds a LEFT JOIN clause to the query using the CheckinoutOutcomes relation
 * @method     ChildCompanyQuery rightJoinCheckinoutOutcomes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CheckinoutOutcomes relation
 * @method     ChildCompanyQuery innerJoinCheckinoutOutcomes($relationAlias = null) Adds a INNER JOIN clause to the query using the CheckinoutOutcomes relation
 *
 * @method     ChildCompanyQuery joinWithCheckinoutOutcomes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CheckinoutOutcomes relation
 *
 * @method     ChildCompanyQuery leftJoinWithCheckinoutOutcomes() Adds a LEFT JOIN clause and with to the query using the CheckinoutOutcomes relation
 * @method     ChildCompanyQuery rightJoinWithCheckinoutOutcomes() Adds a RIGHT JOIN clause and with to the query using the CheckinoutOutcomes relation
 * @method     ChildCompanyQuery innerJoinWithCheckinoutOutcomes() Adds a INNER JOIN clause and with to the query using the CheckinoutOutcomes relation
 *
 * @method     ChildCompanyQuery leftJoinCitycategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Citycategory relation
 * @method     ChildCompanyQuery rightJoinCitycategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Citycategory relation
 * @method     ChildCompanyQuery innerJoinCitycategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Citycategory relation
 *
 * @method     ChildCompanyQuery joinWithCitycategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Citycategory relation
 *
 * @method     ChildCompanyQuery leftJoinWithCitycategory() Adds a LEFT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildCompanyQuery rightJoinWithCitycategory() Adds a RIGHT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildCompanyQuery innerJoinWithCitycategory() Adds a INNER JOIN clause and with to the query using the Citycategory relation
 *
 * @method     ChildCompanyQuery leftJoinClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Classification relation
 * @method     ChildCompanyQuery rightJoinClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Classification relation
 * @method     ChildCompanyQuery innerJoinClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the Classification relation
 *
 * @method     ChildCompanyQuery joinWithClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Classification relation
 *
 * @method     ChildCompanyQuery leftJoinWithClassification() Adds a LEFT JOIN clause and with to the query using the Classification relation
 * @method     ChildCompanyQuery rightJoinWithClassification() Adds a RIGHT JOIN clause and with to the query using the Classification relation
 * @method     ChildCompanyQuery innerJoinWithClassification() Adds a INNER JOIN clause and with to the query using the Classification relation
 *
 * @method     ChildCompanyQuery leftJoinCompetitionMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildCompanyQuery rightJoinCompetitionMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompetitionMapping relation
 * @method     ChildCompanyQuery innerJoinCompetitionMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the CompetitionMapping relation
 *
 * @method     ChildCompanyQuery joinWithCompetitionMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildCompanyQuery leftJoinWithCompetitionMapping() Adds a LEFT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildCompanyQuery rightJoinWithCompetitionMapping() Adds a RIGHT JOIN clause and with to the query using the CompetitionMapping relation
 * @method     ChildCompanyQuery innerJoinWithCompetitionMapping() Adds a INNER JOIN clause and with to the query using the CompetitionMapping relation
 *
 * @method     ChildCompanyQuery leftJoinCompetitor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Competitor relation
 * @method     ChildCompanyQuery rightJoinCompetitor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Competitor relation
 * @method     ChildCompanyQuery innerJoinCompetitor($relationAlias = null) Adds a INNER JOIN clause to the query using the Competitor relation
 *
 * @method     ChildCompanyQuery joinWithCompetitor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Competitor relation
 *
 * @method     ChildCompanyQuery leftJoinWithCompetitor() Adds a LEFT JOIN clause and with to the query using the Competitor relation
 * @method     ChildCompanyQuery rightJoinWithCompetitor() Adds a RIGHT JOIN clause and with to the query using the Competitor relation
 * @method     ChildCompanyQuery innerJoinWithCompetitor() Adds a INNER JOIN clause and with to the query using the Competitor relation
 *
 * @method     ChildCompanyQuery leftJoinConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the Configuration relation
 * @method     ChildCompanyQuery rightJoinConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Configuration relation
 * @method     ChildCompanyQuery innerJoinConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the Configuration relation
 *
 * @method     ChildCompanyQuery joinWithConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Configuration relation
 *
 * @method     ChildCompanyQuery leftJoinWithConfiguration() Adds a LEFT JOIN clause and with to the query using the Configuration relation
 * @method     ChildCompanyQuery rightJoinWithConfiguration() Adds a RIGHT JOIN clause and with to the query using the Configuration relation
 * @method     ChildCompanyQuery innerJoinWithConfiguration() Adds a INNER JOIN clause and with to the query using the Configuration relation
 *
 * @method     ChildCompanyQuery leftJoinCronCommandLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the CronCommandLogs relation
 * @method     ChildCompanyQuery rightJoinCronCommandLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CronCommandLogs relation
 * @method     ChildCompanyQuery innerJoinCronCommandLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the CronCommandLogs relation
 *
 * @method     ChildCompanyQuery joinWithCronCommandLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CronCommandLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithCronCommandLogs() Adds a LEFT JOIN clause and with to the query using the CronCommandLogs relation
 * @method     ChildCompanyQuery rightJoinWithCronCommandLogs() Adds a RIGHT JOIN clause and with to the query using the CronCommandLogs relation
 * @method     ChildCompanyQuery innerJoinWithCronCommandLogs() Adds a INNER JOIN clause and with to the query using the CronCommandLogs relation
 *
 * @method     ChildCompanyQuery leftJoinCronCommands($relationAlias = null) Adds a LEFT JOIN clause to the query using the CronCommands relation
 * @method     ChildCompanyQuery rightJoinCronCommands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CronCommands relation
 * @method     ChildCompanyQuery innerJoinCronCommands($relationAlias = null) Adds a INNER JOIN clause to the query using the CronCommands relation
 *
 * @method     ChildCompanyQuery joinWithCronCommands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CronCommands relation
 *
 * @method     ChildCompanyQuery leftJoinWithCronCommands() Adds a LEFT JOIN clause and with to the query using the CronCommands relation
 * @method     ChildCompanyQuery rightJoinWithCronCommands() Adds a RIGHT JOIN clause and with to the query using the CronCommands relation
 * @method     ChildCompanyQuery innerJoinWithCronCommands() Adds a INNER JOIN clause and with to the query using the CronCommands relation
 *
 * @method     ChildCompanyQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildCompanyQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildCompanyQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildCompanyQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildCompanyQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildCompanyQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildCompanyQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildCompanyQuery leftJoinDailycallsSgpiout($relationAlias = null) Adds a LEFT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildCompanyQuery rightJoinDailycallsSgpiout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DailycallsSgpiout relation
 * @method     ChildCompanyQuery innerJoinDailycallsSgpiout($relationAlias = null) Adds a INNER JOIN clause to the query using the DailycallsSgpiout relation
 *
 * @method     ChildCompanyQuery joinWithDailycallsSgpiout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildCompanyQuery leftJoinWithDailycallsSgpiout() Adds a LEFT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildCompanyQuery rightJoinWithDailycallsSgpiout() Adds a RIGHT JOIN clause and with to the query using the DailycallsSgpiout relation
 * @method     ChildCompanyQuery innerJoinWithDailycallsSgpiout() Adds a INNER JOIN clause and with to the query using the DailycallsSgpiout relation
 *
 * @method     ChildCompanyQuery leftJoinDataExceptionLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the DataExceptionLogs relation
 * @method     ChildCompanyQuery rightJoinDataExceptionLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DataExceptionLogs relation
 * @method     ChildCompanyQuery innerJoinDataExceptionLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the DataExceptionLogs relation
 *
 * @method     ChildCompanyQuery joinWithDataExceptionLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DataExceptionLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithDataExceptionLogs() Adds a LEFT JOIN clause and with to the query using the DataExceptionLogs relation
 * @method     ChildCompanyQuery rightJoinWithDataExceptionLogs() Adds a RIGHT JOIN clause and with to the query using the DataExceptionLogs relation
 * @method     ChildCompanyQuery innerJoinWithDataExceptionLogs() Adds a INNER JOIN clause and with to the query using the DataExceptionLogs relation
 *
 * @method     ChildCompanyQuery leftJoinDataExceptions($relationAlias = null) Adds a LEFT JOIN clause to the query using the DataExceptions relation
 * @method     ChildCompanyQuery rightJoinDataExceptions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DataExceptions relation
 * @method     ChildCompanyQuery innerJoinDataExceptions($relationAlias = null) Adds a INNER JOIN clause to the query using the DataExceptions relation
 *
 * @method     ChildCompanyQuery joinWithDataExceptions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DataExceptions relation
 *
 * @method     ChildCompanyQuery leftJoinWithDataExceptions() Adds a LEFT JOIN clause and with to the query using the DataExceptions relation
 * @method     ChildCompanyQuery rightJoinWithDataExceptions() Adds a RIGHT JOIN clause and with to the query using the DataExceptions relation
 * @method     ChildCompanyQuery innerJoinWithDataExceptions() Adds a INNER JOIN clause and with to the query using the DataExceptions relation
 *
 * @method     ChildCompanyQuery leftJoinDesignations($relationAlias = null) Adds a LEFT JOIN clause to the query using the Designations relation
 * @method     ChildCompanyQuery rightJoinDesignations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Designations relation
 * @method     ChildCompanyQuery innerJoinDesignations($relationAlias = null) Adds a INNER JOIN clause to the query using the Designations relation
 *
 * @method     ChildCompanyQuery joinWithDesignations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Designations relation
 *
 * @method     ChildCompanyQuery leftJoinWithDesignations() Adds a LEFT JOIN clause and with to the query using the Designations relation
 * @method     ChildCompanyQuery rightJoinWithDesignations() Adds a RIGHT JOIN clause and with to the query using the Designations relation
 * @method     ChildCompanyQuery innerJoinWithDesignations() Adds a INNER JOIN clause and with to the query using the Designations relation
 *
 * @method     ChildCompanyQuery leftJoinEdFeedbacks($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildCompanyQuery rightJoinEdFeedbacks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdFeedbacks relation
 * @method     ChildCompanyQuery innerJoinEdFeedbacks($relationAlias = null) Adds a INNER JOIN clause to the query using the EdFeedbacks relation
 *
 * @method     ChildCompanyQuery joinWithEdFeedbacks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdFeedbacks relation
 *
 * @method     ChildCompanyQuery leftJoinWithEdFeedbacks() Adds a LEFT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildCompanyQuery rightJoinWithEdFeedbacks() Adds a RIGHT JOIN clause and with to the query using the EdFeedbacks relation
 * @method     ChildCompanyQuery innerJoinWithEdFeedbacks() Adds a INNER JOIN clause and with to the query using the EdFeedbacks relation
 *
 * @method     ChildCompanyQuery leftJoinEdPlaylist($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdPlaylist relation
 * @method     ChildCompanyQuery rightJoinEdPlaylist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdPlaylist relation
 * @method     ChildCompanyQuery innerJoinEdPlaylist($relationAlias = null) Adds a INNER JOIN clause to the query using the EdPlaylist relation
 *
 * @method     ChildCompanyQuery joinWithEdPlaylist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdPlaylist relation
 *
 * @method     ChildCompanyQuery leftJoinWithEdPlaylist() Adds a LEFT JOIN clause and with to the query using the EdPlaylist relation
 * @method     ChildCompanyQuery rightJoinWithEdPlaylist() Adds a RIGHT JOIN clause and with to the query using the EdPlaylist relation
 * @method     ChildCompanyQuery innerJoinWithEdPlaylist() Adds a INNER JOIN clause and with to the query using the EdPlaylist relation
 *
 * @method     ChildCompanyQuery leftJoinEdPresentations($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdPresentations relation
 * @method     ChildCompanyQuery rightJoinEdPresentations($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdPresentations relation
 * @method     ChildCompanyQuery innerJoinEdPresentations($relationAlias = null) Adds a INNER JOIN clause to the query using the EdPresentations relation
 *
 * @method     ChildCompanyQuery joinWithEdPresentations($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdPresentations relation
 *
 * @method     ChildCompanyQuery leftJoinWithEdPresentations() Adds a LEFT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildCompanyQuery rightJoinWithEdPresentations() Adds a RIGHT JOIN clause and with to the query using the EdPresentations relation
 * @method     ChildCompanyQuery innerJoinWithEdPresentations() Adds a INNER JOIN clause and with to the query using the EdPresentations relation
 *
 * @method     ChildCompanyQuery leftJoinEdSession($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdSession relation
 * @method     ChildCompanyQuery rightJoinEdSession($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdSession relation
 * @method     ChildCompanyQuery innerJoinEdSession($relationAlias = null) Adds a INNER JOIN clause to the query using the EdSession relation
 *
 * @method     ChildCompanyQuery joinWithEdSession($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdSession relation
 *
 * @method     ChildCompanyQuery leftJoinWithEdSession() Adds a LEFT JOIN clause and with to the query using the EdSession relation
 * @method     ChildCompanyQuery rightJoinWithEdSession() Adds a RIGHT JOIN clause and with to the query using the EdSession relation
 * @method     ChildCompanyQuery innerJoinWithEdSession() Adds a INNER JOIN clause and with to the query using the EdSession relation
 *
 * @method     ChildCompanyQuery leftJoinEdStats($relationAlias = null) Adds a LEFT JOIN clause to the query using the EdStats relation
 * @method     ChildCompanyQuery rightJoinEdStats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EdStats relation
 * @method     ChildCompanyQuery innerJoinEdStats($relationAlias = null) Adds a INNER JOIN clause to the query using the EdStats relation
 *
 * @method     ChildCompanyQuery joinWithEdStats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EdStats relation
 *
 * @method     ChildCompanyQuery leftJoinWithEdStats() Adds a LEFT JOIN clause and with to the query using the EdStats relation
 * @method     ChildCompanyQuery rightJoinWithEdStats() Adds a RIGHT JOIN clause and with to the query using the EdStats relation
 * @method     ChildCompanyQuery innerJoinWithEdStats() Adds a INNER JOIN clause and with to the query using the EdStats relation
 *
 * @method     ChildCompanyQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildCompanyQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildCompanyQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildCompanyQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildCompanyQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildCompanyQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildCompanyQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildCompanyQuery leftJoinEmployeeIncentive($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeIncentive relation
 * @method     ChildCompanyQuery rightJoinEmployeeIncentive($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeIncentive relation
 * @method     ChildCompanyQuery innerJoinEmployeeIncentive($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeIncentive relation
 *
 * @method     ChildCompanyQuery joinWithEmployeeIncentive($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeIncentive relation
 *
 * @method     ChildCompanyQuery leftJoinWithEmployeeIncentive() Adds a LEFT JOIN clause and with to the query using the EmployeeIncentive relation
 * @method     ChildCompanyQuery rightJoinWithEmployeeIncentive() Adds a RIGHT JOIN clause and with to the query using the EmployeeIncentive relation
 * @method     ChildCompanyQuery innerJoinWithEmployeeIncentive() Adds a INNER JOIN clause and with to the query using the EmployeeIncentive relation
 *
 * @method     ChildCompanyQuery leftJoinEventTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventTypes relation
 * @method     ChildCompanyQuery rightJoinEventTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventTypes relation
 * @method     ChildCompanyQuery innerJoinEventTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the EventTypes relation
 *
 * @method     ChildCompanyQuery joinWithEventTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventTypes relation
 *
 * @method     ChildCompanyQuery leftJoinWithEventTypes() Adds a LEFT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildCompanyQuery rightJoinWithEventTypes() Adds a RIGHT JOIN clause and with to the query using the EventTypes relation
 * @method     ChildCompanyQuery innerJoinWithEventTypes() Adds a INNER JOIN clause and with to the query using the EventTypes relation
 *
 * @method     ChildCompanyQuery leftJoinEvents($relationAlias = null) Adds a LEFT JOIN clause to the query using the Events relation
 * @method     ChildCompanyQuery rightJoinEvents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Events relation
 * @method     ChildCompanyQuery innerJoinEvents($relationAlias = null) Adds a INNER JOIN clause to the query using the Events relation
 *
 * @method     ChildCompanyQuery joinWithEvents($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Events relation
 *
 * @method     ChildCompanyQuery leftJoinWithEvents() Adds a LEFT JOIN clause and with to the query using the Events relation
 * @method     ChildCompanyQuery rightJoinWithEvents() Adds a RIGHT JOIN clause and with to the query using the Events relation
 * @method     ChildCompanyQuery innerJoinWithEvents() Adds a INNER JOIN clause and with to the query using the Events relation
 *
 * @method     ChildCompanyQuery leftJoinExpenseList($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseList relation
 * @method     ChildCompanyQuery rightJoinExpenseList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseList relation
 * @method     ChildCompanyQuery innerJoinExpenseList($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseList relation
 *
 * @method     ChildCompanyQuery joinWithExpenseList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseList relation
 *
 * @method     ChildCompanyQuery leftJoinWithExpenseList() Adds a LEFT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildCompanyQuery rightJoinWithExpenseList() Adds a RIGHT JOIN clause and with to the query using the ExpenseList relation
 * @method     ChildCompanyQuery innerJoinWithExpenseList() Adds a INNER JOIN clause and with to the query using the ExpenseList relation
 *
 * @method     ChildCompanyQuery leftJoinExpenseMasterRelatedByCompanyId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseMasterRelatedByCompanyId relation
 * @method     ChildCompanyQuery rightJoinExpenseMasterRelatedByCompanyId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseMasterRelatedByCompanyId relation
 * @method     ChildCompanyQuery innerJoinExpenseMasterRelatedByCompanyId($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseMasterRelatedByCompanyId relation
 *
 * @method     ChildCompanyQuery joinWithExpenseMasterRelatedByCompanyId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseMasterRelatedByCompanyId relation
 *
 * @method     ChildCompanyQuery leftJoinWithExpenseMasterRelatedByCompanyId() Adds a LEFT JOIN clause and with to the query using the ExpenseMasterRelatedByCompanyId relation
 * @method     ChildCompanyQuery rightJoinWithExpenseMasterRelatedByCompanyId() Adds a RIGHT JOIN clause and with to the query using the ExpenseMasterRelatedByCompanyId relation
 * @method     ChildCompanyQuery innerJoinWithExpenseMasterRelatedByCompanyId() Adds a INNER JOIN clause and with to the query using the ExpenseMasterRelatedByCompanyId relation
 *
 * @method     ChildCompanyQuery leftJoinExpensePayments($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpensePayments relation
 * @method     ChildCompanyQuery rightJoinExpensePayments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpensePayments relation
 * @method     ChildCompanyQuery innerJoinExpensePayments($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpensePayments relation
 *
 * @method     ChildCompanyQuery joinWithExpensePayments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpensePayments relation
 *
 * @method     ChildCompanyQuery leftJoinWithExpensePayments() Adds a LEFT JOIN clause and with to the query using the ExpensePayments relation
 * @method     ChildCompanyQuery rightJoinWithExpensePayments() Adds a RIGHT JOIN clause and with to the query using the ExpensePayments relation
 * @method     ChildCompanyQuery innerJoinWithExpensePayments() Adds a INNER JOIN clause and with to the query using the ExpensePayments relation
 *
 * @method     ChildCompanyQuery leftJoinExpenses($relationAlias = null) Adds a LEFT JOIN clause to the query using the Expenses relation
 * @method     ChildCompanyQuery rightJoinExpenses($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Expenses relation
 * @method     ChildCompanyQuery innerJoinExpenses($relationAlias = null) Adds a INNER JOIN clause to the query using the Expenses relation
 *
 * @method     ChildCompanyQuery joinWithExpenses($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Expenses relation
 *
 * @method     ChildCompanyQuery leftJoinWithExpenses() Adds a LEFT JOIN clause and with to the query using the Expenses relation
 * @method     ChildCompanyQuery rightJoinWithExpenses() Adds a RIGHT JOIN clause and with to the query using the Expenses relation
 * @method     ChildCompanyQuery innerJoinWithExpenses() Adds a INNER JOIN clause and with to the query using the Expenses relation
 *
 * @method     ChildCompanyQuery leftJoinFtpConfigs($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpConfigs relation
 * @method     ChildCompanyQuery rightJoinFtpConfigs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpConfigs relation
 * @method     ChildCompanyQuery innerJoinFtpConfigs($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpConfigs relation
 *
 * @method     ChildCompanyQuery joinWithFtpConfigs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpConfigs relation
 *
 * @method     ChildCompanyQuery leftJoinWithFtpConfigs() Adds a LEFT JOIN clause and with to the query using the FtpConfigs relation
 * @method     ChildCompanyQuery rightJoinWithFtpConfigs() Adds a RIGHT JOIN clause and with to the query using the FtpConfigs relation
 * @method     ChildCompanyQuery innerJoinWithFtpConfigs() Adds a INNER JOIN clause and with to the query using the FtpConfigs relation
 *
 * @method     ChildCompanyQuery leftJoinFtpExportBatches($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpExportBatches relation
 * @method     ChildCompanyQuery rightJoinFtpExportBatches($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpExportBatches relation
 * @method     ChildCompanyQuery innerJoinFtpExportBatches($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpExportBatches relation
 *
 * @method     ChildCompanyQuery joinWithFtpExportBatches($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpExportBatches relation
 *
 * @method     ChildCompanyQuery leftJoinWithFtpExportBatches() Adds a LEFT JOIN clause and with to the query using the FtpExportBatches relation
 * @method     ChildCompanyQuery rightJoinWithFtpExportBatches() Adds a RIGHT JOIN clause and with to the query using the FtpExportBatches relation
 * @method     ChildCompanyQuery innerJoinWithFtpExportBatches() Adds a INNER JOIN clause and with to the query using the FtpExportBatches relation
 *
 * @method     ChildCompanyQuery leftJoinFtpExportLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpExportLogs relation
 * @method     ChildCompanyQuery rightJoinFtpExportLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpExportLogs relation
 * @method     ChildCompanyQuery innerJoinFtpExportLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpExportLogs relation
 *
 * @method     ChildCompanyQuery joinWithFtpExportLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpExportLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithFtpExportLogs() Adds a LEFT JOIN clause and with to the query using the FtpExportLogs relation
 * @method     ChildCompanyQuery rightJoinWithFtpExportLogs() Adds a RIGHT JOIN clause and with to the query using the FtpExportLogs relation
 * @method     ChildCompanyQuery innerJoinWithFtpExportLogs() Adds a INNER JOIN clause and with to the query using the FtpExportLogs relation
 *
 * @method     ChildCompanyQuery leftJoinFtpImportBatches($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpImportBatches relation
 * @method     ChildCompanyQuery rightJoinFtpImportBatches($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpImportBatches relation
 * @method     ChildCompanyQuery innerJoinFtpImportBatches($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpImportBatches relation
 *
 * @method     ChildCompanyQuery joinWithFtpImportBatches($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpImportBatches relation
 *
 * @method     ChildCompanyQuery leftJoinWithFtpImportBatches() Adds a LEFT JOIN clause and with to the query using the FtpImportBatches relation
 * @method     ChildCompanyQuery rightJoinWithFtpImportBatches() Adds a RIGHT JOIN clause and with to the query using the FtpImportBatches relation
 * @method     ChildCompanyQuery innerJoinWithFtpImportBatches() Adds a INNER JOIN clause and with to the query using the FtpImportBatches relation
 *
 * @method     ChildCompanyQuery leftJoinFtpImportLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the FtpImportLogs relation
 * @method     ChildCompanyQuery rightJoinFtpImportLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FtpImportLogs relation
 * @method     ChildCompanyQuery innerJoinFtpImportLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the FtpImportLogs relation
 *
 * @method     ChildCompanyQuery joinWithFtpImportLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FtpImportLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithFtpImportLogs() Adds a LEFT JOIN clause and with to the query using the FtpImportLogs relation
 * @method     ChildCompanyQuery rightJoinWithFtpImportLogs() Adds a RIGHT JOIN clause and with to the query using the FtpImportLogs relation
 * @method     ChildCompanyQuery innerJoinWithFtpImportLogs() Adds a INNER JOIN clause and with to the query using the FtpImportLogs relation
 *
 * @method     ChildCompanyQuery leftJoinGradeMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the GradeMaster relation
 * @method     ChildCompanyQuery rightJoinGradeMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GradeMaster relation
 * @method     ChildCompanyQuery innerJoinGradeMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the GradeMaster relation
 *
 * @method     ChildCompanyQuery joinWithGradeMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GradeMaster relation
 *
 * @method     ChildCompanyQuery leftJoinWithGradeMaster() Adds a LEFT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildCompanyQuery rightJoinWithGradeMaster() Adds a RIGHT JOIN clause and with to the query using the GradeMaster relation
 * @method     ChildCompanyQuery innerJoinWithGradeMaster() Adds a INNER JOIN clause and with to the query using the GradeMaster relation
 *
 * @method     ChildCompanyQuery leftJoinHolidays($relationAlias = null) Adds a LEFT JOIN clause to the query using the Holidays relation
 * @method     ChildCompanyQuery rightJoinHolidays($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Holidays relation
 * @method     ChildCompanyQuery innerJoinHolidays($relationAlias = null) Adds a INNER JOIN clause to the query using the Holidays relation
 *
 * @method     ChildCompanyQuery joinWithHolidays($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Holidays relation
 *
 * @method     ChildCompanyQuery leftJoinWithHolidays() Adds a LEFT JOIN clause and with to the query using the Holidays relation
 * @method     ChildCompanyQuery rightJoinWithHolidays() Adds a RIGHT JOIN clause and with to the query using the Holidays relation
 * @method     ChildCompanyQuery innerJoinWithHolidays() Adds a INNER JOIN clause and with to the query using the Holidays relation
 *
 * @method     ChildCompanyQuery leftJoinIntegrationApiLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the IntegrationApiLogs relation
 * @method     ChildCompanyQuery rightJoinIntegrationApiLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IntegrationApiLogs relation
 * @method     ChildCompanyQuery innerJoinIntegrationApiLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the IntegrationApiLogs relation
 *
 * @method     ChildCompanyQuery joinWithIntegrationApiLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the IntegrationApiLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithIntegrationApiLogs() Adds a LEFT JOIN clause and with to the query using the IntegrationApiLogs relation
 * @method     ChildCompanyQuery rightJoinWithIntegrationApiLogs() Adds a RIGHT JOIN clause and with to the query using the IntegrationApiLogs relation
 * @method     ChildCompanyQuery innerJoinWithIntegrationApiLogs() Adds a INNER JOIN clause and with to the query using the IntegrationApiLogs relation
 *
 * @method     ChildCompanyQuery leftJoinLeaveRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeaveRequest relation
 * @method     ChildCompanyQuery rightJoinLeaveRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeaveRequest relation
 * @method     ChildCompanyQuery innerJoinLeaveRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the LeaveRequest relation
 *
 * @method     ChildCompanyQuery joinWithLeaveRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LeaveRequest relation
 *
 * @method     ChildCompanyQuery leftJoinWithLeaveRequest() Adds a LEFT JOIN clause and with to the query using the LeaveRequest relation
 * @method     ChildCompanyQuery rightJoinWithLeaveRequest() Adds a RIGHT JOIN clause and with to the query using the LeaveRequest relation
 * @method     ChildCompanyQuery innerJoinWithLeaveRequest() Adds a INNER JOIN clause and with to the query using the LeaveRequest relation
 *
 * @method     ChildCompanyQuery leftJoinLeaves($relationAlias = null) Adds a LEFT JOIN clause to the query using the Leaves relation
 * @method     ChildCompanyQuery rightJoinLeaves($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Leaves relation
 * @method     ChildCompanyQuery innerJoinLeaves($relationAlias = null) Adds a INNER JOIN clause to the query using the Leaves relation
 *
 * @method     ChildCompanyQuery joinWithLeaves($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Leaves relation
 *
 * @method     ChildCompanyQuery leftJoinWithLeaves() Adds a LEFT JOIN clause and with to the query using the Leaves relation
 * @method     ChildCompanyQuery rightJoinWithLeaves() Adds a RIGHT JOIN clause and with to the query using the Leaves relation
 * @method     ChildCompanyQuery innerJoinWithLeaves() Adds a INNER JOIN clause and with to the query using the Leaves relation
 *
 * @method     ChildCompanyQuery leftJoinMaterialFolders($relationAlias = null) Adds a LEFT JOIN clause to the query using the MaterialFolders relation
 * @method     ChildCompanyQuery rightJoinMaterialFolders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MaterialFolders relation
 * @method     ChildCompanyQuery innerJoinMaterialFolders($relationAlias = null) Adds a INNER JOIN clause to the query using the MaterialFolders relation
 *
 * @method     ChildCompanyQuery joinWithMaterialFolders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MaterialFolders relation
 *
 * @method     ChildCompanyQuery leftJoinWithMaterialFolders() Adds a LEFT JOIN clause and with to the query using the MaterialFolders relation
 * @method     ChildCompanyQuery rightJoinWithMaterialFolders() Adds a RIGHT JOIN clause and with to the query using the MaterialFolders relation
 * @method     ChildCompanyQuery innerJoinWithMaterialFolders() Adds a INNER JOIN clause and with to the query using the MaterialFolders relation
 *
 * @method     ChildCompanyQuery leftJoinMediaFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFiles relation
 * @method     ChildCompanyQuery rightJoinMediaFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFiles relation
 * @method     ChildCompanyQuery innerJoinMediaFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFiles relation
 *
 * @method     ChildCompanyQuery joinWithMediaFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFiles relation
 *
 * @method     ChildCompanyQuery leftJoinWithMediaFiles() Adds a LEFT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildCompanyQuery rightJoinWithMediaFiles() Adds a RIGHT JOIN clause and with to the query using the MediaFiles relation
 * @method     ChildCompanyQuery innerJoinWithMediaFiles() Adds a INNER JOIN clause and with to the query using the MediaFiles relation
 *
 * @method     ChildCompanyQuery leftJoinMediaFolders($relationAlias = null) Adds a LEFT JOIN clause to the query using the MediaFolders relation
 * @method     ChildCompanyQuery rightJoinMediaFolders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MediaFolders relation
 * @method     ChildCompanyQuery innerJoinMediaFolders($relationAlias = null) Adds a INNER JOIN clause to the query using the MediaFolders relation
 *
 * @method     ChildCompanyQuery joinWithMediaFolders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MediaFolders relation
 *
 * @method     ChildCompanyQuery leftJoinWithMediaFolders() Adds a LEFT JOIN clause and with to the query using the MediaFolders relation
 * @method     ChildCompanyQuery rightJoinWithMediaFolders() Adds a RIGHT JOIN clause and with to the query using the MediaFolders relation
 * @method     ChildCompanyQuery innerJoinWithMediaFolders() Adds a INNER JOIN clause and with to the query using the MediaFolders relation
 *
 * @method     ChildCompanyQuery leftJoinMtp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Mtp relation
 * @method     ChildCompanyQuery rightJoinMtp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Mtp relation
 * @method     ChildCompanyQuery innerJoinMtp($relationAlias = null) Adds a INNER JOIN clause to the query using the Mtp relation
 *
 * @method     ChildCompanyQuery joinWithMtp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Mtp relation
 *
 * @method     ChildCompanyQuery leftJoinWithMtp() Adds a LEFT JOIN clause and with to the query using the Mtp relation
 * @method     ChildCompanyQuery rightJoinWithMtp() Adds a RIGHT JOIN clause and with to the query using the Mtp relation
 * @method     ChildCompanyQuery innerJoinWithMtp() Adds a INNER JOIN clause and with to the query using the Mtp relation
 *
 * @method     ChildCompanyQuery leftJoinMtpDay($relationAlias = null) Adds a LEFT JOIN clause to the query using the MtpDay relation
 * @method     ChildCompanyQuery rightJoinMtpDay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MtpDay relation
 * @method     ChildCompanyQuery innerJoinMtpDay($relationAlias = null) Adds a INNER JOIN clause to the query using the MtpDay relation
 *
 * @method     ChildCompanyQuery joinWithMtpDay($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MtpDay relation
 *
 * @method     ChildCompanyQuery leftJoinWithMtpDay() Adds a LEFT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildCompanyQuery rightJoinWithMtpDay() Adds a RIGHT JOIN clause and with to the query using the MtpDay relation
 * @method     ChildCompanyQuery innerJoinWithMtpDay() Adds a INNER JOIN clause and with to the query using the MtpDay relation
 *
 * @method     ChildCompanyQuery leftJoinMtpLogs($relationAlias = null) Adds a LEFT JOIN clause to the query using the MtpLogs relation
 * @method     ChildCompanyQuery rightJoinMtpLogs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MtpLogs relation
 * @method     ChildCompanyQuery innerJoinMtpLogs($relationAlias = null) Adds a INNER JOIN clause to the query using the MtpLogs relation
 *
 * @method     ChildCompanyQuery joinWithMtpLogs($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MtpLogs relation
 *
 * @method     ChildCompanyQuery leftJoinWithMtpLogs() Adds a LEFT JOIN clause and with to the query using the MtpLogs relation
 * @method     ChildCompanyQuery rightJoinWithMtpLogs() Adds a RIGHT JOIN clause and with to the query using the MtpLogs relation
 * @method     ChildCompanyQuery innerJoinWithMtpLogs() Adds a INNER JOIN clause and with to the query using the MtpLogs relation
 *
 * @method     ChildCompanyQuery leftJoinOffers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Offers relation
 * @method     ChildCompanyQuery rightJoinOffers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Offers relation
 * @method     ChildCompanyQuery innerJoinOffers($relationAlias = null) Adds a INNER JOIN clause to the query using the Offers relation
 *
 * @method     ChildCompanyQuery joinWithOffers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Offers relation
 *
 * @method     ChildCompanyQuery leftJoinWithOffers() Adds a LEFT JOIN clause and with to the query using the Offers relation
 * @method     ChildCompanyQuery rightJoinWithOffers() Adds a RIGHT JOIN clause and with to the query using the Offers relation
 * @method     ChildCompanyQuery innerJoinWithOffers() Adds a INNER JOIN clause and with to the query using the Offers relation
 *
 * @method     ChildCompanyQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildCompanyQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildCompanyQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildCompanyQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildCompanyQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildCompanyQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildCompanyQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildCompanyQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildCompanyQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildCompanyQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildCompanyQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildCompanyQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildCompanyQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildCompanyQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildCompanyQuery leftJoinOnBoardRequiredFields($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequiredFields relation
 * @method     ChildCompanyQuery rightJoinOnBoardRequiredFields($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequiredFields relation
 * @method     ChildCompanyQuery innerJoinOnBoardRequiredFields($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildCompanyQuery joinWithOnBoardRequiredFields($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildCompanyQuery leftJoinWithOnBoardRequiredFields() Adds a LEFT JOIN clause and with to the query using the OnBoardRequiredFields relation
 * @method     ChildCompanyQuery rightJoinWithOnBoardRequiredFields() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequiredFields relation
 * @method     ChildCompanyQuery innerJoinWithOnBoardRequiredFields() Adds a INNER JOIN clause and with to the query using the OnBoardRequiredFields relation
 *
 * @method     ChildCompanyQuery leftJoinOrderLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderLog relation
 * @method     ChildCompanyQuery rightJoinOrderLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderLog relation
 * @method     ChildCompanyQuery innerJoinOrderLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderLog relation
 *
 * @method     ChildCompanyQuery joinWithOrderLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderLog relation
 *
 * @method     ChildCompanyQuery leftJoinWithOrderLog() Adds a LEFT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildCompanyQuery rightJoinWithOrderLog() Adds a RIGHT JOIN clause and with to the query using the OrderLog relation
 * @method     ChildCompanyQuery innerJoinWithOrderLog() Adds a INNER JOIN clause and with to the query using the OrderLog relation
 *
 * @method     ChildCompanyQuery leftJoinOrderlines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orderlines relation
 * @method     ChildCompanyQuery rightJoinOrderlines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orderlines relation
 * @method     ChildCompanyQuery innerJoinOrderlines($relationAlias = null) Adds a INNER JOIN clause to the query using the Orderlines relation
 *
 * @method     ChildCompanyQuery joinWithOrderlines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orderlines relation
 *
 * @method     ChildCompanyQuery leftJoinWithOrderlines() Adds a LEFT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildCompanyQuery rightJoinWithOrderlines() Adds a RIGHT JOIN clause and with to the query using the Orderlines relation
 * @method     ChildCompanyQuery innerJoinWithOrderlines() Adds a INNER JOIN clause and with to the query using the Orderlines relation
 *
 * @method     ChildCompanyQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildCompanyQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildCompanyQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildCompanyQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildCompanyQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildCompanyQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildCompanyQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildCompanyQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCompanyQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildCompanyQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildCompanyQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCompanyQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCompanyQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildCompanyQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildCompanyQuery leftJoinOtpRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the OtpRequests relation
 * @method     ChildCompanyQuery rightJoinOtpRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OtpRequests relation
 * @method     ChildCompanyQuery innerJoinOtpRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the OtpRequests relation
 *
 * @method     ChildCompanyQuery joinWithOtpRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OtpRequests relation
 *
 * @method     ChildCompanyQuery leftJoinWithOtpRequests() Adds a LEFT JOIN clause and with to the query using the OtpRequests relation
 * @method     ChildCompanyQuery rightJoinWithOtpRequests() Adds a RIGHT JOIN clause and with to the query using the OtpRequests relation
 * @method     ChildCompanyQuery innerJoinWithOtpRequests() Adds a INNER JOIN clause and with to the query using the OtpRequests relation
 *
 * @method     ChildCompanyQuery leftJoinOutletAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAddress relation
 * @method     ChildCompanyQuery rightJoinOutletAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAddress relation
 * @method     ChildCompanyQuery innerJoinOutletAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAddress relation
 *
 * @method     ChildCompanyQuery joinWithOutletAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAddress relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletAddress() Adds a LEFT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildCompanyQuery rightJoinWithOutletAddress() Adds a RIGHT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildCompanyQuery innerJoinWithOutletAddress() Adds a INNER JOIN clause and with to the query using the OutletAddress relation
 *
 * @method     ChildCompanyQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildCompanyQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildCompanyQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildCompanyQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildCompanyQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildCompanyQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildCompanyQuery leftJoinOutletOrgNotes($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgNotes relation
 * @method     ChildCompanyQuery rightJoinOutletOrgNotes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgNotes relation
 * @method     ChildCompanyQuery innerJoinOutletOrgNotes($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgNotes relation
 *
 * @method     ChildCompanyQuery joinWithOutletOrgNotes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgNotes relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletOrgNotes() Adds a LEFT JOIN clause and with to the query using the OutletOrgNotes relation
 * @method     ChildCompanyQuery rightJoinWithOutletOrgNotes() Adds a RIGHT JOIN clause and with to the query using the OutletOrgNotes relation
 * @method     ChildCompanyQuery innerJoinWithOutletOrgNotes() Adds a INNER JOIN clause and with to the query using the OutletOrgNotes relation
 *
 * @method     ChildCompanyQuery leftJoinOutletOutcomes($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOutcomes relation
 * @method     ChildCompanyQuery rightJoinOutletOutcomes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOutcomes relation
 * @method     ChildCompanyQuery innerJoinOutletOutcomes($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOutcomes relation
 *
 * @method     ChildCompanyQuery joinWithOutletOutcomes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOutcomes relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletOutcomes() Adds a LEFT JOIN clause and with to the query using the OutletOutcomes relation
 * @method     ChildCompanyQuery rightJoinWithOutletOutcomes() Adds a RIGHT JOIN clause and with to the query using the OutletOutcomes relation
 * @method     ChildCompanyQuery innerJoinWithOutletOutcomes() Adds a INNER JOIN clause and with to the query using the OutletOutcomes relation
 *
 * @method     ChildCompanyQuery leftJoinOutletStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStock relation
 * @method     ChildCompanyQuery rightJoinOutletStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStock relation
 * @method     ChildCompanyQuery innerJoinOutletStock($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStock relation
 *
 * @method     ChildCompanyQuery joinWithOutletStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStock relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletStock() Adds a LEFT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildCompanyQuery rightJoinWithOutletStock() Adds a RIGHT JOIN clause and with to the query using the OutletStock relation
 * @method     ChildCompanyQuery innerJoinWithOutletStock() Adds a INNER JOIN clause and with to the query using the OutletStock relation
 *
 * @method     ChildCompanyQuery leftJoinOutletStockOtherSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildCompanyQuery rightJoinOutletStockOtherSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockOtherSummary relation
 * @method     ChildCompanyQuery innerJoinOutletStockOtherSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildCompanyQuery joinWithOutletStockOtherSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletStockOtherSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildCompanyQuery rightJoinWithOutletStockOtherSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockOtherSummary relation
 * @method     ChildCompanyQuery innerJoinWithOutletStockOtherSummary() Adds a INNER JOIN clause and with to the query using the OutletStockOtherSummary relation
 *
 * @method     ChildCompanyQuery leftJoinOutletStockSummary($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildCompanyQuery rightJoinOutletStockSummary($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletStockSummary relation
 * @method     ChildCompanyQuery innerJoinOutletStockSummary($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletStockSummary relation
 *
 * @method     ChildCompanyQuery joinWithOutletStockSummary($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletStockSummary() Adds a LEFT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildCompanyQuery rightJoinWithOutletStockSummary() Adds a RIGHT JOIN clause and with to the query using the OutletStockSummary relation
 * @method     ChildCompanyQuery innerJoinWithOutletStockSummary() Adds a INNER JOIN clause and with to the query using the OutletStockSummary relation
 *
 * @method     ChildCompanyQuery leftJoinOutletTags($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletTags relation
 * @method     ChildCompanyQuery rightJoinOutletTags($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletTags relation
 * @method     ChildCompanyQuery innerJoinOutletTags($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletTags relation
 *
 * @method     ChildCompanyQuery joinWithOutletTags($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletTags relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletTags() Adds a LEFT JOIN clause and with to the query using the OutletTags relation
 * @method     ChildCompanyQuery rightJoinWithOutletTags() Adds a RIGHT JOIN clause and with to the query using the OutletTags relation
 * @method     ChildCompanyQuery innerJoinWithOutletTags() Adds a INNER JOIN clause and with to the query using the OutletTags relation
 *
 * @method     ChildCompanyQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildCompanyQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildCompanyQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildCompanyQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildCompanyQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildCompanyQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildCompanyQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildCompanyQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildCompanyQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildCompanyQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildCompanyQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildCompanyQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildCompanyQuery leftJoinPolicyMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildCompanyQuery rightJoinPolicyMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PolicyMaster relation
 * @method     ChildCompanyQuery innerJoinPolicyMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the PolicyMaster relation
 *
 * @method     ChildCompanyQuery joinWithPolicyMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PolicyMaster relation
 *
 * @method     ChildCompanyQuery leftJoinWithPolicyMaster() Adds a LEFT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildCompanyQuery rightJoinWithPolicyMaster() Adds a RIGHT JOIN clause and with to the query using the PolicyMaster relation
 * @method     ChildCompanyQuery innerJoinWithPolicyMaster() Adds a INNER JOIN clause and with to the query using the PolicyMaster relation
 *
 * @method     ChildCompanyQuery leftJoinPolicykeys($relationAlias = null) Adds a LEFT JOIN clause to the query using the Policykeys relation
 * @method     ChildCompanyQuery rightJoinPolicykeys($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Policykeys relation
 * @method     ChildCompanyQuery innerJoinPolicykeys($relationAlias = null) Adds a INNER JOIN clause to the query using the Policykeys relation
 *
 * @method     ChildCompanyQuery joinWithPolicykeys($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Policykeys relation
 *
 * @method     ChildCompanyQuery leftJoinWithPolicykeys() Adds a LEFT JOIN clause and with to the query using the Policykeys relation
 * @method     ChildCompanyQuery rightJoinWithPolicykeys() Adds a RIGHT JOIN clause and with to the query using the Policykeys relation
 * @method     ChildCompanyQuery innerJoinWithPolicykeys() Adds a INNER JOIN clause and with to the query using the Policykeys relation
 *
 * @method     ChildCompanyQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildCompanyQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildCompanyQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildCompanyQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildCompanyQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildCompanyQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildCompanyQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildCompanyQuery leftJoinPricebooklines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildCompanyQuery rightJoinPricebooklines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooklines relation
 * @method     ChildCompanyQuery innerJoinPricebooklines($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooklines relation
 *
 * @method     ChildCompanyQuery joinWithPricebooklines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooklines relation
 *
 * @method     ChildCompanyQuery leftJoinWithPricebooklines() Adds a LEFT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildCompanyQuery rightJoinWithPricebooklines() Adds a RIGHT JOIN clause and with to the query using the Pricebooklines relation
 * @method     ChildCompanyQuery innerJoinWithPricebooklines() Adds a INNER JOIN clause and with to the query using the Pricebooklines relation
 *
 * @method     ChildCompanyQuery leftJoinPricebooks($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pricebooks relation
 * @method     ChildCompanyQuery rightJoinPricebooks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pricebooks relation
 * @method     ChildCompanyQuery innerJoinPricebooks($relationAlias = null) Adds a INNER JOIN clause to the query using the Pricebooks relation
 *
 * @method     ChildCompanyQuery joinWithPricebooks($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pricebooks relation
 *
 * @method     ChildCompanyQuery leftJoinWithPricebooks() Adds a LEFT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildCompanyQuery rightJoinWithPricebooks() Adds a RIGHT JOIN clause and with to the query using the Pricebooks relation
 * @method     ChildCompanyQuery innerJoinWithPricebooks() Adds a INNER JOIN clause and with to the query using the Pricebooks relation
 *
 * @method     ChildCompanyQuery leftJoinProducts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Products relation
 * @method     ChildCompanyQuery rightJoinProducts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Products relation
 * @method     ChildCompanyQuery innerJoinProducts($relationAlias = null) Adds a INNER JOIN clause to the query using the Products relation
 *
 * @method     ChildCompanyQuery joinWithProducts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Products relation
 *
 * @method     ChildCompanyQuery leftJoinWithProducts() Adds a LEFT JOIN clause and with to the query using the Products relation
 * @method     ChildCompanyQuery rightJoinWithProducts() Adds a RIGHT JOIN clause and with to the query using the Products relation
 * @method     ChildCompanyQuery innerJoinWithProducts() Adds a INNER JOIN clause and with to the query using the Products relation
 *
 * @method     ChildCompanyQuery leftJoinReminders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reminders relation
 * @method     ChildCompanyQuery rightJoinReminders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reminders relation
 * @method     ChildCompanyQuery innerJoinReminders($relationAlias = null) Adds a INNER JOIN clause to the query using the Reminders relation
 *
 * @method     ChildCompanyQuery joinWithReminders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reminders relation
 *
 * @method     ChildCompanyQuery leftJoinWithReminders() Adds a LEFT JOIN clause and with to the query using the Reminders relation
 * @method     ChildCompanyQuery rightJoinWithReminders() Adds a RIGHT JOIN clause and with to the query using the Reminders relation
 * @method     ChildCompanyQuery innerJoinWithReminders() Adds a INNER JOIN clause and with to the query using the Reminders relation
 *
 * @method     ChildCompanyQuery leftJoinSgpiAccounts($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiAccounts relation
 * @method     ChildCompanyQuery rightJoinSgpiAccounts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiAccounts relation
 * @method     ChildCompanyQuery innerJoinSgpiAccounts($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiAccounts relation
 *
 * @method     ChildCompanyQuery joinWithSgpiAccounts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiAccounts relation
 *
 * @method     ChildCompanyQuery leftJoinWithSgpiAccounts() Adds a LEFT JOIN clause and with to the query using the SgpiAccounts relation
 * @method     ChildCompanyQuery rightJoinWithSgpiAccounts() Adds a RIGHT JOIN clause and with to the query using the SgpiAccounts relation
 * @method     ChildCompanyQuery innerJoinWithSgpiAccounts() Adds a INNER JOIN clause and with to the query using the SgpiAccounts relation
 *
 * @method     ChildCompanyQuery leftJoinSgpiMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildCompanyQuery rightJoinSgpiMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiMaster relation
 * @method     ChildCompanyQuery innerJoinSgpiMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiMaster relation
 *
 * @method     ChildCompanyQuery joinWithSgpiMaster($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildCompanyQuery leftJoinWithSgpiMaster() Adds a LEFT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildCompanyQuery rightJoinWithSgpiMaster() Adds a RIGHT JOIN clause and with to the query using the SgpiMaster relation
 * @method     ChildCompanyQuery innerJoinWithSgpiMaster() Adds a INNER JOIN clause and with to the query using the SgpiMaster relation
 *
 * @method     ChildCompanyQuery leftJoinSgpiTrans($relationAlias = null) Adds a LEFT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildCompanyQuery rightJoinSgpiTrans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SgpiTrans relation
 * @method     ChildCompanyQuery innerJoinSgpiTrans($relationAlias = null) Adds a INNER JOIN clause to the query using the SgpiTrans relation
 *
 * @method     ChildCompanyQuery joinWithSgpiTrans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SgpiTrans relation
 *
 * @method     ChildCompanyQuery leftJoinWithSgpiTrans() Adds a LEFT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildCompanyQuery rightJoinWithSgpiTrans() Adds a RIGHT JOIN clause and with to the query using the SgpiTrans relation
 * @method     ChildCompanyQuery innerJoinWithSgpiTrans() Adds a INNER JOIN clause and with to the query using the SgpiTrans relation
 *
 * @method     ChildCompanyQuery leftJoinShiftTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShiftTypes relation
 * @method     ChildCompanyQuery rightJoinShiftTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShiftTypes relation
 * @method     ChildCompanyQuery innerJoinShiftTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the ShiftTypes relation
 *
 * @method     ChildCompanyQuery joinWithShiftTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ShiftTypes relation
 *
 * @method     ChildCompanyQuery leftJoinWithShiftTypes() Adds a LEFT JOIN clause and with to the query using the ShiftTypes relation
 * @method     ChildCompanyQuery rightJoinWithShiftTypes() Adds a RIGHT JOIN clause and with to the query using the ShiftTypes relation
 * @method     ChildCompanyQuery innerJoinWithShiftTypes() Adds a INNER JOIN clause and with to the query using the ShiftTypes relation
 *
 * @method     ChildCompanyQuery leftJoinShippinglines($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippinglines relation
 * @method     ChildCompanyQuery rightJoinShippinglines($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippinglines relation
 * @method     ChildCompanyQuery innerJoinShippinglines($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippinglines relation
 *
 * @method     ChildCompanyQuery joinWithShippinglines($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippinglines relation
 *
 * @method     ChildCompanyQuery leftJoinWithShippinglines() Adds a LEFT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildCompanyQuery rightJoinWithShippinglines() Adds a RIGHT JOIN clause and with to the query using the Shippinglines relation
 * @method     ChildCompanyQuery innerJoinWithShippinglines() Adds a INNER JOIN clause and with to the query using the Shippinglines relation
 *
 * @method     ChildCompanyQuery leftJoinShippingorder($relationAlias = null) Adds a LEFT JOIN clause to the query using the Shippingorder relation
 * @method     ChildCompanyQuery rightJoinShippingorder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Shippingorder relation
 * @method     ChildCompanyQuery innerJoinShippingorder($relationAlias = null) Adds a INNER JOIN clause to the query using the Shippingorder relation
 *
 * @method     ChildCompanyQuery joinWithShippingorder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Shippingorder relation
 *
 * @method     ChildCompanyQuery leftJoinWithShippingorder() Adds a LEFT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildCompanyQuery rightJoinWithShippingorder() Adds a RIGHT JOIN clause and with to the query using the Shippingorder relation
 * @method     ChildCompanyQuery innerJoinWithShippingorder() Adds a INNER JOIN clause and with to the query using the Shippingorder relation
 *
 * @method     ChildCompanyQuery leftJoinStockTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockTransaction relation
 * @method     ChildCompanyQuery rightJoinStockTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockTransaction relation
 * @method     ChildCompanyQuery innerJoinStockTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the StockTransaction relation
 *
 * @method     ChildCompanyQuery joinWithStockTransaction($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockTransaction relation
 *
 * @method     ChildCompanyQuery leftJoinWithStockTransaction() Adds a LEFT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildCompanyQuery rightJoinWithStockTransaction() Adds a RIGHT JOIN clause and with to the query using the StockTransaction relation
 * @method     ChildCompanyQuery innerJoinWithStockTransaction() Adds a INNER JOIN clause and with to the query using the StockTransaction relation
 *
 * @method     ChildCompanyQuery leftJoinStockVoucher($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockVoucher relation
 * @method     ChildCompanyQuery rightJoinStockVoucher($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockVoucher relation
 * @method     ChildCompanyQuery innerJoinStockVoucher($relationAlias = null) Adds a INNER JOIN clause to the query using the StockVoucher relation
 *
 * @method     ChildCompanyQuery joinWithStockVoucher($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockVoucher relation
 *
 * @method     ChildCompanyQuery leftJoinWithStockVoucher() Adds a LEFT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildCompanyQuery rightJoinWithStockVoucher() Adds a RIGHT JOIN clause and with to the query using the StockVoucher relation
 * @method     ChildCompanyQuery innerJoinWithStockVoucher() Adds a INNER JOIN clause and with to the query using the StockVoucher relation
 *
 * @method     ChildCompanyQuery leftJoinSurvey($relationAlias = null) Adds a LEFT JOIN clause to the query using the Survey relation
 * @method     ChildCompanyQuery rightJoinSurvey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Survey relation
 * @method     ChildCompanyQuery innerJoinSurvey($relationAlias = null) Adds a INNER JOIN clause to the query using the Survey relation
 *
 * @method     ChildCompanyQuery joinWithSurvey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Survey relation
 *
 * @method     ChildCompanyQuery leftJoinWithSurvey() Adds a LEFT JOIN clause and with to the query using the Survey relation
 * @method     ChildCompanyQuery rightJoinWithSurvey() Adds a RIGHT JOIN clause and with to the query using the Survey relation
 * @method     ChildCompanyQuery innerJoinWithSurvey() Adds a INNER JOIN clause and with to the query using the Survey relation
 *
 * @method     ChildCompanyQuery leftJoinSurveyCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveyCategory relation
 * @method     ChildCompanyQuery rightJoinSurveyCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveyCategory relation
 * @method     ChildCompanyQuery innerJoinSurveyCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveyCategory relation
 *
 * @method     ChildCompanyQuery joinWithSurveyCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveyCategory relation
 *
 * @method     ChildCompanyQuery leftJoinWithSurveyCategory() Adds a LEFT JOIN clause and with to the query using the SurveyCategory relation
 * @method     ChildCompanyQuery rightJoinWithSurveyCategory() Adds a RIGHT JOIN clause and with to the query using the SurveyCategory relation
 * @method     ChildCompanyQuery innerJoinWithSurveyCategory() Adds a INNER JOIN clause and with to the query using the SurveyCategory relation
 *
 * @method     ChildCompanyQuery leftJoinSurveyQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildCompanyQuery rightJoinSurveyQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveyQuestion relation
 * @method     ChildCompanyQuery innerJoinSurveyQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveyQuestion relation
 *
 * @method     ChildCompanyQuery joinWithSurveyQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveyQuestion relation
 *
 * @method     ChildCompanyQuery leftJoinWithSurveyQuestion() Adds a LEFT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildCompanyQuery rightJoinWithSurveyQuestion() Adds a RIGHT JOIN clause and with to the query using the SurveyQuestion relation
 * @method     ChildCompanyQuery innerJoinWithSurveyQuestion() Adds a INNER JOIN clause and with to the query using the SurveyQuestion relation
 *
 * @method     ChildCompanyQuery leftJoinSurveySubmited($relationAlias = null) Adds a LEFT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildCompanyQuery rightJoinSurveySubmited($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SurveySubmited relation
 * @method     ChildCompanyQuery innerJoinSurveySubmited($relationAlias = null) Adds a INNER JOIN clause to the query using the SurveySubmited relation
 *
 * @method     ChildCompanyQuery joinWithSurveySubmited($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildCompanyQuery leftJoinWithSurveySubmited() Adds a LEFT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildCompanyQuery rightJoinWithSurveySubmited() Adds a RIGHT JOIN clause and with to the query using the SurveySubmited relation
 * @method     ChildCompanyQuery innerJoinWithSurveySubmited() Adds a INNER JOIN clause and with to the query using the SurveySubmited relation
 *
 * @method     ChildCompanyQuery leftJoinTaConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the TaConfiguration relation
 * @method     ChildCompanyQuery rightJoinTaConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TaConfiguration relation
 * @method     ChildCompanyQuery innerJoinTaConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the TaConfiguration relation
 *
 * @method     ChildCompanyQuery joinWithTaConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TaConfiguration relation
 *
 * @method     ChildCompanyQuery leftJoinWithTaConfiguration() Adds a LEFT JOIN clause and with to the query using the TaConfiguration relation
 * @method     ChildCompanyQuery rightJoinWithTaConfiguration() Adds a RIGHT JOIN clause and with to the query using the TaConfiguration relation
 * @method     ChildCompanyQuery innerJoinWithTaConfiguration() Adds a INNER JOIN clause and with to the query using the TaConfiguration relation
 *
 * @method     ChildCompanyQuery leftJoinTags($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tags relation
 * @method     ChildCompanyQuery rightJoinTags($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tags relation
 * @method     ChildCompanyQuery innerJoinTags($relationAlias = null) Adds a INNER JOIN clause to the query using the Tags relation
 *
 * @method     ChildCompanyQuery joinWithTags($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tags relation
 *
 * @method     ChildCompanyQuery leftJoinWithTags() Adds a LEFT JOIN clause and with to the query using the Tags relation
 * @method     ChildCompanyQuery rightJoinWithTags() Adds a RIGHT JOIN clause and with to the query using the Tags relation
 * @method     ChildCompanyQuery innerJoinWithTags() Adds a INNER JOIN clause and with to the query using the Tags relation
 *
 * @method     ChildCompanyQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildCompanyQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildCompanyQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildCompanyQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildCompanyQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildCompanyQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildCompanyQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildCompanyQuery leftJoinTerritoryTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildCompanyQuery rightJoinTerritoryTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildCompanyQuery innerJoinTerritoryTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the TerritoryTowns relation
 *
 * @method     ChildCompanyQuery joinWithTerritoryTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildCompanyQuery leftJoinWithTerritoryTowns() Adds a LEFT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildCompanyQuery rightJoinWithTerritoryTowns() Adds a RIGHT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildCompanyQuery innerJoinWithTerritoryTowns() Adds a INNER JOIN clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildCompanyQuery leftJoinTicketReplies($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketReplies relation
 * @method     ChildCompanyQuery rightJoinTicketReplies($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketReplies relation
 * @method     ChildCompanyQuery innerJoinTicketReplies($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketReplies relation
 *
 * @method     ChildCompanyQuery joinWithTicketReplies($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketReplies relation
 *
 * @method     ChildCompanyQuery leftJoinWithTicketReplies() Adds a LEFT JOIN clause and with to the query using the TicketReplies relation
 * @method     ChildCompanyQuery rightJoinWithTicketReplies() Adds a RIGHT JOIN clause and with to the query using the TicketReplies relation
 * @method     ChildCompanyQuery innerJoinWithTicketReplies() Adds a INNER JOIN clause and with to the query using the TicketReplies relation
 *
 * @method     ChildCompanyQuery leftJoinTicketType($relationAlias = null) Adds a LEFT JOIN clause to the query using the TicketType relation
 * @method     ChildCompanyQuery rightJoinTicketType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TicketType relation
 * @method     ChildCompanyQuery innerJoinTicketType($relationAlias = null) Adds a INNER JOIN clause to the query using the TicketType relation
 *
 * @method     ChildCompanyQuery joinWithTicketType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TicketType relation
 *
 * @method     ChildCompanyQuery leftJoinWithTicketType() Adds a LEFT JOIN clause and with to the query using the TicketType relation
 * @method     ChildCompanyQuery rightJoinWithTicketType() Adds a RIGHT JOIN clause and with to the query using the TicketType relation
 * @method     ChildCompanyQuery innerJoinWithTicketType() Adds a INNER JOIN clause and with to the query using the TicketType relation
 *
 * @method     ChildCompanyQuery leftJoinTickets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tickets relation
 * @method     ChildCompanyQuery rightJoinTickets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tickets relation
 * @method     ChildCompanyQuery innerJoinTickets($relationAlias = null) Adds a INNER JOIN clause to the query using the Tickets relation
 *
 * @method     ChildCompanyQuery joinWithTickets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tickets relation
 *
 * @method     ChildCompanyQuery leftJoinWithTickets() Adds a LEFT JOIN clause and with to the query using the Tickets relation
 * @method     ChildCompanyQuery rightJoinWithTickets() Adds a RIGHT JOIN clause and with to the query using the Tickets relation
 * @method     ChildCompanyQuery innerJoinWithTickets() Adds a INNER JOIN clause and with to the query using the Tickets relation
 *
 * @method     ChildCompanyQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildCompanyQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildCompanyQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildCompanyQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildCompanyQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildCompanyQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildCompanyQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     ChildCompanyQuery leftJoinTransactions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transactions relation
 * @method     ChildCompanyQuery rightJoinTransactions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transactions relation
 * @method     ChildCompanyQuery innerJoinTransactions($relationAlias = null) Adds a INNER JOIN clause to the query using the Transactions relation
 *
 * @method     ChildCompanyQuery joinWithTransactions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Transactions relation
 *
 * @method     ChildCompanyQuery leftJoinWithTransactions() Adds a LEFT JOIN clause and with to the query using the Transactions relation
 * @method     ChildCompanyQuery rightJoinWithTransactions() Adds a RIGHT JOIN clause and with to the query using the Transactions relation
 * @method     ChildCompanyQuery innerJoinWithTransactions() Adds a INNER JOIN clause and with to the query using the Transactions relation
 *
 * @method     ChildCompanyQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildCompanyQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildCompanyQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildCompanyQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildCompanyQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildCompanyQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildCompanyQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildCompanyQuery leftJoinWdbSyncLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the WdbSyncLog relation
 * @method     ChildCompanyQuery rightJoinWdbSyncLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WdbSyncLog relation
 * @method     ChildCompanyQuery innerJoinWdbSyncLog($relationAlias = null) Adds a INNER JOIN clause to the query using the WdbSyncLog relation
 *
 * @method     ChildCompanyQuery joinWithWdbSyncLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WdbSyncLog relation
 *
 * @method     ChildCompanyQuery leftJoinWithWdbSyncLog() Adds a LEFT JOIN clause and with to the query using the WdbSyncLog relation
 * @method     ChildCompanyQuery rightJoinWithWdbSyncLog() Adds a RIGHT JOIN clause and with to the query using the WdbSyncLog relation
 * @method     ChildCompanyQuery innerJoinWithWdbSyncLog() Adds a INNER JOIN clause and with to the query using the WdbSyncLog relation
 *
 * @method     ChildCompanyQuery leftJoinWfRequests($relationAlias = null) Adds a LEFT JOIN clause to the query using the WfRequests relation
 * @method     ChildCompanyQuery rightJoinWfRequests($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WfRequests relation
 * @method     ChildCompanyQuery innerJoinWfRequests($relationAlias = null) Adds a INNER JOIN clause to the query using the WfRequests relation
 *
 * @method     ChildCompanyQuery joinWithWfRequests($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WfRequests relation
 *
 * @method     ChildCompanyQuery leftJoinWithWfRequests() Adds a LEFT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildCompanyQuery rightJoinWithWfRequests() Adds a RIGHT JOIN clause and with to the query using the WfRequests relation
 * @method     ChildCompanyQuery innerJoinWithWfRequests() Adds a INNER JOIN clause and with to the query using the WfRequests relation
 *
 * @method     ChildCompanyQuery leftJoinStp($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stp relation
 * @method     ChildCompanyQuery rightJoinStp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stp relation
 * @method     ChildCompanyQuery innerJoinStp($relationAlias = null) Adds a INNER JOIN clause to the query using the Stp relation
 *
 * @method     ChildCompanyQuery joinWithStp($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Stp relation
 *
 * @method     ChildCompanyQuery leftJoinWithStp() Adds a LEFT JOIN clause and with to the query using the Stp relation
 * @method     ChildCompanyQuery rightJoinWithStp() Adds a RIGHT JOIN clause and with to the query using the Stp relation
 * @method     ChildCompanyQuery innerJoinWithStp() Adds a INNER JOIN clause and with to the query using the Stp relation
 *
 * @method     ChildCompanyQuery leftJoinStpWeek($relationAlias = null) Adds a LEFT JOIN clause to the query using the StpWeek relation
 * @method     ChildCompanyQuery rightJoinStpWeek($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StpWeek relation
 * @method     ChildCompanyQuery innerJoinStpWeek($relationAlias = null) Adds a INNER JOIN clause to the query using the StpWeek relation
 *
 * @method     ChildCompanyQuery joinWithStpWeek($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StpWeek relation
 *
 * @method     ChildCompanyQuery leftJoinWithStpWeek() Adds a LEFT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildCompanyQuery rightJoinWithStpWeek() Adds a RIGHT JOIN clause and with to the query using the StpWeek relation
 * @method     ChildCompanyQuery innerJoinWithStpWeek() Adds a INNER JOIN clause and with to the query using the StpWeek relation
 *
 * @method     ChildCompanyQuery leftJoinOutletOrgDataKeys($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgDataKeys relation
 * @method     ChildCompanyQuery rightJoinOutletOrgDataKeys($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgDataKeys relation
 * @method     ChildCompanyQuery innerJoinOutletOrgDataKeys($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgDataKeys relation
 *
 * @method     ChildCompanyQuery joinWithOutletOrgDataKeys($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgDataKeys relation
 *
 * @method     ChildCompanyQuery leftJoinWithOutletOrgDataKeys() Adds a LEFT JOIN clause and with to the query using the OutletOrgDataKeys relation
 * @method     ChildCompanyQuery rightJoinWithOutletOrgDataKeys() Adds a RIGHT JOIN clause and with to the query using the OutletOrgDataKeys relation
 * @method     ChildCompanyQuery innerJoinWithOutletOrgDataKeys() Adds a INNER JOIN clause and with to the query using the OutletOrgDataKeys relation
 *
 * @method     ChildCompanyQuery leftJoinNotificationConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the NotificationConfiguration relation
 * @method     ChildCompanyQuery rightJoinNotificationConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NotificationConfiguration relation
 * @method     ChildCompanyQuery innerJoinNotificationConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the NotificationConfiguration relation
 *
 * @method     ChildCompanyQuery joinWithNotificationConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the NotificationConfiguration relation
 *
 * @method     ChildCompanyQuery leftJoinWithNotificationConfiguration() Adds a LEFT JOIN clause and with to the query using the NotificationConfiguration relation
 * @method     ChildCompanyQuery rightJoinWithNotificationConfiguration() Adds a RIGHT JOIN clause and with to the query using the NotificationConfiguration relation
 * @method     ChildCompanyQuery innerJoinWithNotificationConfiguration() Adds a INNER JOIN clause and with to the query using the NotificationConfiguration relation
 *
 * @method     ChildCompanyQuery leftJoinLeaveType($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeaveType relation
 * @method     ChildCompanyQuery rightJoinLeaveType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeaveType relation
 * @method     ChildCompanyQuery innerJoinLeaveType($relationAlias = null) Adds a INNER JOIN clause to the query using the LeaveType relation
 *
 * @method     ChildCompanyQuery joinWithLeaveType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LeaveType relation
 *
 * @method     ChildCompanyQuery leftJoinWithLeaveType() Adds a LEFT JOIN clause and with to the query using the LeaveType relation
 * @method     ChildCompanyQuery rightJoinWithLeaveType() Adds a RIGHT JOIN clause and with to the query using the LeaveType relation
 * @method     ChildCompanyQuery innerJoinWithLeaveType() Adds a INNER JOIN clause and with to the query using the LeaveType relation
 *
 * @method     \entities\ExpenseMasterQuery|\entities\CurrenciesQuery|\entities\AgendatypesQuery|\entities\AnnouncementsQuery|\entities\ApiKeysQuery|\entities\AttendanceQuery|\entities\BeatOutletsQuery|\entities\BeatsQuery|\entities\BranchQuery|\entities\BrandCampiagnQuery|\entities\BrandCampiagnDoctorsQuery|\entities\BrandCampiagnVisitPlanQuery|\entities\BrandCompetitionQuery|\entities\BrandRcpaQuery|\entities\BrandsQuery|\entities\BudgetGroupQuery|\entities\CategoriesQuery|\entities\CheckinoutOutcomesQuery|\entities\CitycategoryQuery|\entities\ClassificationQuery|\entities\CompetitionMappingQuery|\entities\CompetitorQuery|\entities\ConfigurationQuery|\entities\CronCommandLogsQuery|\entities\CronCommandsQuery|\entities\DailycallsQuery|\entities\DailycallsSgpioutQuery|\entities\DataExceptionLogsQuery|\entities\DataExceptionsQuery|\entities\DesignationsQuery|\entities\EdFeedbacksQuery|\entities\EdPlaylistQuery|\entities\EdPresentationsQuery|\entities\EdSessionQuery|\entities\EdStatsQuery|\entities\EmployeeQuery|\entities\EmployeeIncentiveQuery|\entities\EventTypesQuery|\entities\EventsQuery|\entities\ExpenseListQuery|\entities\ExpenseMasterQuery|\entities\ExpensePaymentsQuery|\entities\ExpensesQuery|\entities\FtpConfigsQuery|\entities\FtpExportBatchesQuery|\entities\FtpExportLogsQuery|\entities\FtpImportBatchesQuery|\entities\FtpImportLogsQuery|\entities\GradeMasterQuery|\entities\HolidaysQuery|\entities\IntegrationApiLogsQuery|\entities\LeaveRequestQuery|\entities\LeavesQuery|\entities\MaterialFoldersQuery|\entities\MediaFilesQuery|\entities\MediaFoldersQuery|\entities\MtpQuery|\entities\MtpDayQuery|\entities\MtpLogsQuery|\entities\OffersQuery|\entities\OnBoardRequestQuery|\entities\OnBoardRequestAddressQuery|\entities\OnBoardRequiredFieldsQuery|\entities\OrderLogQuery|\entities\OrderlinesQuery|\entities\OrdersQuery|\entities\OrgUnitQuery|\entities\OtpRequestsQuery|\entities\OutletAddressQuery|\entities\OutletOrgDataQuery|\entities\OutletOrgNotesQuery|\entities\OutletOutcomesQuery|\entities\OutletStockQuery|\entities\OutletStockOtherSummaryQuery|\entities\OutletStockSummaryQuery|\entities\OutletTagsQuery|\entities\OutletTypeQuery|\entities\OutletsQuery|\entities\PolicyMasterQuery|\entities\PolicykeysQuery|\entities\PositionsQuery|\entities\PricebooklinesQuery|\entities\PricebooksQuery|\entities\ProductsQuery|\entities\RemindersQuery|\entities\SgpiAccountsQuery|\entities\SgpiMasterQuery|\entities\SgpiTransQuery|\entities\ShiftTypesQuery|\entities\ShippinglinesQuery|\entities\ShippingorderQuery|\entities\StockTransactionQuery|\entities\StockVoucherQuery|\entities\SurveyQuery|\entities\SurveyCategoryQuery|\entities\SurveyQuestionQuery|\entities\SurveySubmitedQuery|\entities\TaConfigurationQuery|\entities\TagsQuery|\entities\TerritoriesQuery|\entities\TerritoryTownsQuery|\entities\TicketRepliesQuery|\entities\TicketTypeQuery|\entities\TicketsQuery|\entities\TourplansQuery|\entities\TransactionsQuery|\entities\UsersQuery|\entities\WdbSyncLogQuery|\entities\WfRequestsQuery|\entities\StpQuery|\entities\StpWeekQuery|\entities\OutletOrgDataKeysQuery|\entities\NotificationConfigurationQuery|\entities\LeaveTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCompany|null findOne(?ConnectionInterface $con = null) Return the first ChildCompany matching the query
 * @method     ChildCompany findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCompany matching the query, or a new ChildCompany object populated from the query conditions when no match is found
 *
 * @method     ChildCompany|null findOneByCompanyId(int $company_id) Return the first ChildCompany filtered by the company_id column
 * @method     ChildCompany|null findOneByCompanyCode(string $company_code) Return the first ChildCompany filtered by the company_code column
 * @method     ChildCompany|null findOneByCompanyName(string $company_name) Return the first ChildCompany filtered by the company_name column
 * @method     ChildCompany|null findOneByOwnerName(string $owner_name) Return the first ChildCompany filtered by the owner_name column
 * @method     ChildCompany|null findOneByCompanyPhoneNumber(string $company_phone_number) Return the first ChildCompany filtered by the company_phone_number column
 * @method     ChildCompany|null findOneByCompanyContactNumber(string $company_contact_number) Return the first ChildCompany filtered by the company_contact_number column
 * @method     ChildCompany|null findOneByCompanyLogo(string $company_logo) Return the first ChildCompany filtered by the company_logo column
 * @method     ChildCompany|null findOneByCompanyAddress1(string $company_address_1) Return the first ChildCompany filtered by the company_address_1 column
 * @method     ChildCompany|null findOneByCompanyAddress2(string $company_address_2) Return the first ChildCompany filtered by the company_address_2 column
 * @method     ChildCompany|null findOneByCompanyDefaultCurrency(int $company_default_currency) Return the first ChildCompany filtered by the company_default_currency column
 * @method     ChildCompany|null findOneByTimezone(string $timezone) Return the first ChildCompany filtered by the timezone column
 * @method     ChildCompany|null findOneByCompanyFirstSetup(int $company_first_setup) Return the first ChildCompany filtered by the company_first_setup column
 * @method     ChildCompany|null findOneByOwnerEmail(string $owner_email) Return the first ChildCompany filtered by the owner_email column
 * @method     ChildCompany|null findOneByExpenseReminder(int $expense_reminder) Return the first ChildCompany filtered by the expense_reminder column
 * @method     ChildCompany|null findOneByCurrentmonthsubmit(int $currentmonthsubmit) Return the first ChildCompany filtered by the currentmonthsubmit column
 * @method     ChildCompany|null findOneByTripapprovalreq(int $tripapprovalreq) Return the first ChildCompany filtered by the tripapprovalreq column
 * @method     ChildCompany|null findOneByExpenseonlyontrip(int $expenseonlyontrip) Return the first ChildCompany filtered by the expenseonlyontrip column
 * @method     ChildCompany|null findOneByAllowbackdatedtrip(int $allowbackdatedtrip) Return the first ChildCompany filtered by the allowbackdatedtrip column
 * @method     ChildCompany|null findOneByPaymentsystem(int $paymentsystem) Return the first ChildCompany filtered by the paymentsystem column
 * @method     ChildCompany|null findOneByAutoSettle(int $auto_settle) Return the first ChildCompany filtered by the auto_settle column
 * @method     ChildCompany|null findOneByAllowradius(int $allowradius) Return the first ChildCompany filtered by the allowradius column
 * @method     ChildCompany|null findOneByOrderSeq(string $order_seq) Return the first ChildCompany filtered by the order_seq column
 * @method     ChildCompany|null findOneByShippingorderSeq(string $shippingorder_seq) Return the first ChildCompany filtered by the shippingorder_seq column
 * @method     ChildCompany|null findOneByGooglemapkey(string $googlemapkey) Return the first ChildCompany filtered by the googlemapkey column
 * @method     ChildCompany|null findOneByWorkingdaysinweek(int $workingdaysinweek) Return the first ChildCompany filtered by the workingdaysinweek column
 * @method     ChildCompany|null findOneByAutoCalculatedTa(int $auto_calculated_ta) Return the first ChildCompany filtered by the auto_calculated_ta column
 * @method     ChildCompany|null findOneByReportingDays(string $reporting_days) Return the first ChildCompany filtered by the reporting_days column
 * @method     ChildCompany|null findOneByExpenseMonths(int $expense_months) Return the first ChildCompany filtered by the expense_months column
 *
 * @method     ChildCompany requirePk($key, ?ConnectionInterface $con = null) Return the ChildCompany by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOne(?ConnectionInterface $con = null) Return the first ChildCompany matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompany requireOneByCompanyId(int $company_id) Return the first ChildCompany filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyCode(string $company_code) Return the first ChildCompany filtered by the company_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyName(string $company_name) Return the first ChildCompany filtered by the company_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByOwnerName(string $owner_name) Return the first ChildCompany filtered by the owner_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyPhoneNumber(string $company_phone_number) Return the first ChildCompany filtered by the company_phone_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyContactNumber(string $company_contact_number) Return the first ChildCompany filtered by the company_contact_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyLogo(string $company_logo) Return the first ChildCompany filtered by the company_logo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyAddress1(string $company_address_1) Return the first ChildCompany filtered by the company_address_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyAddress2(string $company_address_2) Return the first ChildCompany filtered by the company_address_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyDefaultCurrency(int $company_default_currency) Return the first ChildCompany filtered by the company_default_currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByTimezone(string $timezone) Return the first ChildCompany filtered by the timezone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCompanyFirstSetup(int $company_first_setup) Return the first ChildCompany filtered by the company_first_setup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByOwnerEmail(string $owner_email) Return the first ChildCompany filtered by the owner_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByExpenseReminder(int $expense_reminder) Return the first ChildCompany filtered by the expense_reminder column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByCurrentmonthsubmit(int $currentmonthsubmit) Return the first ChildCompany filtered by the currentmonthsubmit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByTripapprovalreq(int $tripapprovalreq) Return the first ChildCompany filtered by the tripapprovalreq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByExpenseonlyontrip(int $expenseonlyontrip) Return the first ChildCompany filtered by the expenseonlyontrip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByAllowbackdatedtrip(int $allowbackdatedtrip) Return the first ChildCompany filtered by the allowbackdatedtrip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByPaymentsystem(int $paymentsystem) Return the first ChildCompany filtered by the paymentsystem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByAutoSettle(int $auto_settle) Return the first ChildCompany filtered by the auto_settle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByAllowradius(int $allowradius) Return the first ChildCompany filtered by the allowradius column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByOrderSeq(string $order_seq) Return the first ChildCompany filtered by the order_seq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByShippingorderSeq(string $shippingorder_seq) Return the first ChildCompany filtered by the shippingorder_seq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByGooglemapkey(string $googlemapkey) Return the first ChildCompany filtered by the googlemapkey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByWorkingdaysinweek(int $workingdaysinweek) Return the first ChildCompany filtered by the workingdaysinweek column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByAutoCalculatedTa(int $auto_calculated_ta) Return the first ChildCompany filtered by the auto_calculated_ta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByReportingDays(string $reporting_days) Return the first ChildCompany filtered by the reporting_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompany requireOneByExpenseMonths(int $expense_months) Return the first ChildCompany filtered by the expense_months column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompany[]|Collection find(?ConnectionInterface $con = null) Return ChildCompany objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCompany> find(?ConnectionInterface $con = null) Return ChildCompany objects based on current ModelCriteria
 *
 * @method     ChildCompany[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildCompany objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyId(int|array<int> $company_id) Return ChildCompany objects filtered by the company_id column
 * @method     ChildCompany[]|Collection findByCompanyCode(string|array<string> $company_code) Return ChildCompany objects filtered by the company_code column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyCode(string|array<string> $company_code) Return ChildCompany objects filtered by the company_code column
 * @method     ChildCompany[]|Collection findByCompanyName(string|array<string> $company_name) Return ChildCompany objects filtered by the company_name column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyName(string|array<string> $company_name) Return ChildCompany objects filtered by the company_name column
 * @method     ChildCompany[]|Collection findByOwnerName(string|array<string> $owner_name) Return ChildCompany objects filtered by the owner_name column
 * @psalm-method Collection&\Traversable<ChildCompany> findByOwnerName(string|array<string> $owner_name) Return ChildCompany objects filtered by the owner_name column
 * @method     ChildCompany[]|Collection findByCompanyPhoneNumber(string|array<string> $company_phone_number) Return ChildCompany objects filtered by the company_phone_number column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyPhoneNumber(string|array<string> $company_phone_number) Return ChildCompany objects filtered by the company_phone_number column
 * @method     ChildCompany[]|Collection findByCompanyContactNumber(string|array<string> $company_contact_number) Return ChildCompany objects filtered by the company_contact_number column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyContactNumber(string|array<string> $company_contact_number) Return ChildCompany objects filtered by the company_contact_number column
 * @method     ChildCompany[]|Collection findByCompanyLogo(string|array<string> $company_logo) Return ChildCompany objects filtered by the company_logo column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyLogo(string|array<string> $company_logo) Return ChildCompany objects filtered by the company_logo column
 * @method     ChildCompany[]|Collection findByCompanyAddress1(string|array<string> $company_address_1) Return ChildCompany objects filtered by the company_address_1 column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyAddress1(string|array<string> $company_address_1) Return ChildCompany objects filtered by the company_address_1 column
 * @method     ChildCompany[]|Collection findByCompanyAddress2(string|array<string> $company_address_2) Return ChildCompany objects filtered by the company_address_2 column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyAddress2(string|array<string> $company_address_2) Return ChildCompany objects filtered by the company_address_2 column
 * @method     ChildCompany[]|Collection findByCompanyDefaultCurrency(int|array<int> $company_default_currency) Return ChildCompany objects filtered by the company_default_currency column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyDefaultCurrency(int|array<int> $company_default_currency) Return ChildCompany objects filtered by the company_default_currency column
 * @method     ChildCompany[]|Collection findByTimezone(string|array<string> $timezone) Return ChildCompany objects filtered by the timezone column
 * @psalm-method Collection&\Traversable<ChildCompany> findByTimezone(string|array<string> $timezone) Return ChildCompany objects filtered by the timezone column
 * @method     ChildCompany[]|Collection findByCompanyFirstSetup(int|array<int> $company_first_setup) Return ChildCompany objects filtered by the company_first_setup column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCompanyFirstSetup(int|array<int> $company_first_setup) Return ChildCompany objects filtered by the company_first_setup column
 * @method     ChildCompany[]|Collection findByOwnerEmail(string|array<string> $owner_email) Return ChildCompany objects filtered by the owner_email column
 * @psalm-method Collection&\Traversable<ChildCompany> findByOwnerEmail(string|array<string> $owner_email) Return ChildCompany objects filtered by the owner_email column
 * @method     ChildCompany[]|Collection findByExpenseReminder(int|array<int> $expense_reminder) Return ChildCompany objects filtered by the expense_reminder column
 * @psalm-method Collection&\Traversable<ChildCompany> findByExpenseReminder(int|array<int> $expense_reminder) Return ChildCompany objects filtered by the expense_reminder column
 * @method     ChildCompany[]|Collection findByCurrentmonthsubmit(int|array<int> $currentmonthsubmit) Return ChildCompany objects filtered by the currentmonthsubmit column
 * @psalm-method Collection&\Traversable<ChildCompany> findByCurrentmonthsubmit(int|array<int> $currentmonthsubmit) Return ChildCompany objects filtered by the currentmonthsubmit column
 * @method     ChildCompany[]|Collection findByTripapprovalreq(int|array<int> $tripapprovalreq) Return ChildCompany objects filtered by the tripapprovalreq column
 * @psalm-method Collection&\Traversable<ChildCompany> findByTripapprovalreq(int|array<int> $tripapprovalreq) Return ChildCompany objects filtered by the tripapprovalreq column
 * @method     ChildCompany[]|Collection findByExpenseonlyontrip(int|array<int> $expenseonlyontrip) Return ChildCompany objects filtered by the expenseonlyontrip column
 * @psalm-method Collection&\Traversable<ChildCompany> findByExpenseonlyontrip(int|array<int> $expenseonlyontrip) Return ChildCompany objects filtered by the expenseonlyontrip column
 * @method     ChildCompany[]|Collection findByAllowbackdatedtrip(int|array<int> $allowbackdatedtrip) Return ChildCompany objects filtered by the allowbackdatedtrip column
 * @psalm-method Collection&\Traversable<ChildCompany> findByAllowbackdatedtrip(int|array<int> $allowbackdatedtrip) Return ChildCompany objects filtered by the allowbackdatedtrip column
 * @method     ChildCompany[]|Collection findByPaymentsystem(int|array<int> $paymentsystem) Return ChildCompany objects filtered by the paymentsystem column
 * @psalm-method Collection&\Traversable<ChildCompany> findByPaymentsystem(int|array<int> $paymentsystem) Return ChildCompany objects filtered by the paymentsystem column
 * @method     ChildCompany[]|Collection findByAutoSettle(int|array<int> $auto_settle) Return ChildCompany objects filtered by the auto_settle column
 * @psalm-method Collection&\Traversable<ChildCompany> findByAutoSettle(int|array<int> $auto_settle) Return ChildCompany objects filtered by the auto_settle column
 * @method     ChildCompany[]|Collection findByAllowradius(int|array<int> $allowradius) Return ChildCompany objects filtered by the allowradius column
 * @psalm-method Collection&\Traversable<ChildCompany> findByAllowradius(int|array<int> $allowradius) Return ChildCompany objects filtered by the allowradius column
 * @method     ChildCompany[]|Collection findByOrderSeq(string|array<string> $order_seq) Return ChildCompany objects filtered by the order_seq column
 * @psalm-method Collection&\Traversable<ChildCompany> findByOrderSeq(string|array<string> $order_seq) Return ChildCompany objects filtered by the order_seq column
 * @method     ChildCompany[]|Collection findByShippingorderSeq(string|array<string> $shippingorder_seq) Return ChildCompany objects filtered by the shippingorder_seq column
 * @psalm-method Collection&\Traversable<ChildCompany> findByShippingorderSeq(string|array<string> $shippingorder_seq) Return ChildCompany objects filtered by the shippingorder_seq column
 * @method     ChildCompany[]|Collection findByGooglemapkey(string|array<string> $googlemapkey) Return ChildCompany objects filtered by the googlemapkey column
 * @psalm-method Collection&\Traversable<ChildCompany> findByGooglemapkey(string|array<string> $googlemapkey) Return ChildCompany objects filtered by the googlemapkey column
 * @method     ChildCompany[]|Collection findByWorkingdaysinweek(int|array<int> $workingdaysinweek) Return ChildCompany objects filtered by the workingdaysinweek column
 * @psalm-method Collection&\Traversable<ChildCompany> findByWorkingdaysinweek(int|array<int> $workingdaysinweek) Return ChildCompany objects filtered by the workingdaysinweek column
 * @method     ChildCompany[]|Collection findByAutoCalculatedTa(int|array<int> $auto_calculated_ta) Return ChildCompany objects filtered by the auto_calculated_ta column
 * @psalm-method Collection&\Traversable<ChildCompany> findByAutoCalculatedTa(int|array<int> $auto_calculated_ta) Return ChildCompany objects filtered by the auto_calculated_ta column
 * @method     ChildCompany[]|Collection findByReportingDays(string|array<string> $reporting_days) Return ChildCompany objects filtered by the reporting_days column
 * @psalm-method Collection&\Traversable<ChildCompany> findByReportingDays(string|array<string> $reporting_days) Return ChildCompany objects filtered by the reporting_days column
 * @method     ChildCompany[]|Collection findByExpenseMonths(int|array<int> $expense_months) Return ChildCompany objects filtered by the expense_months column
 * @psalm-method Collection&\Traversable<ChildCompany> findByExpenseMonths(int|array<int> $expense_months) Return ChildCompany objects filtered by the expense_months column
 *
 * @method     ChildCompany[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCompany> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CompanyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CompanyQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\Company', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompanyQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompanyQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCompanyQuery) {
            return $criteria;
        }
        $query = new ChildCompanyQuery();
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
     * @return ChildCompany|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompanyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CompanyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCompany A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT company_id, company_code, company_name, owner_name, company_phone_number, company_contact_number, company_logo, company_address_1, company_address_2, company_default_currency, timezone, company_first_setup, owner_email, expense_reminder, currentmonthsubmit, tripapprovalreq, expenseonlyontrip, allowbackdatedtrip, paymentsystem, auto_settle, allowradius, order_seq, shippingorder_seq, googlemapkey, workingdaysinweek, auto_calculated_ta, reporting_days, expense_months FROM company WHERE company_id = :p0';
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
            /** @var ChildCompany $obj */
            $obj = new ChildCompany();
            $obj->hydrate($row);
            CompanyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCompany|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyCode('fooValue');   // WHERE company_code = 'fooValue'
     * $query->filterByCompanyCode('%fooValue%', Criteria::LIKE); // WHERE company_code LIKE '%fooValue%'
     * $query->filterByCompanyCode(['foo', 'bar']); // WHERE company_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyCode($companyCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_CODE, $companyCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_name column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyName('fooValue');   // WHERE company_name = 'fooValue'
     * $query->filterByCompanyName('%fooValue%', Criteria::LIKE); // WHERE company_name LIKE '%fooValue%'
     * $query->filterByCompanyName(['foo', 'bar']); // WHERE company_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyName($companyName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_NAME, $companyName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the owner_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnerName('fooValue');   // WHERE owner_name = 'fooValue'
     * $query->filterByOwnerName('%fooValue%', Criteria::LIKE); // WHERE owner_name LIKE '%fooValue%'
     * $query->filterByOwnerName(['foo', 'bar']); // WHERE owner_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ownerName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOwnerName($ownerName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ownerName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_OWNER_NAME, $ownerName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_phone_number column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyPhoneNumber('fooValue');   // WHERE company_phone_number = 'fooValue'
     * $query->filterByCompanyPhoneNumber('%fooValue%', Criteria::LIKE); // WHERE company_phone_number LIKE '%fooValue%'
     * $query->filterByCompanyPhoneNumber(['foo', 'bar']); // WHERE company_phone_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyPhoneNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyPhoneNumber($companyPhoneNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyPhoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_PHONE_NUMBER, $companyPhoneNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_contact_number column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyContactNumber('fooValue');   // WHERE company_contact_number = 'fooValue'
     * $query->filterByCompanyContactNumber('%fooValue%', Criteria::LIKE); // WHERE company_contact_number LIKE '%fooValue%'
     * $query->filterByCompanyContactNumber(['foo', 'bar']); // WHERE company_contact_number IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyContactNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyContactNumber($companyContactNumber = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyContactNumber)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_CONTACT_NUMBER, $companyContactNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_logo column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyLogo('fooValue');   // WHERE company_logo = 'fooValue'
     * $query->filterByCompanyLogo('%fooValue%', Criteria::LIKE); // WHERE company_logo LIKE '%fooValue%'
     * $query->filterByCompanyLogo(['foo', 'bar']); // WHERE company_logo IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyLogo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyLogo($companyLogo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyLogo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_LOGO, $companyLogo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_address_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyAddress1('fooValue');   // WHERE company_address_1 = 'fooValue'
     * $query->filterByCompanyAddress1('%fooValue%', Criteria::LIKE); // WHERE company_address_1 LIKE '%fooValue%'
     * $query->filterByCompanyAddress1(['foo', 'bar']); // WHERE company_address_1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyAddress1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyAddress1($companyAddress1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyAddress1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ADDRESS_1, $companyAddress1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_address_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyAddress2('fooValue');   // WHERE company_address_2 = 'fooValue'
     * $query->filterByCompanyAddress2('%fooValue%', Criteria::LIKE); // WHERE company_address_2 LIKE '%fooValue%'
     * $query->filterByCompanyAddress2(['foo', 'bar']); // WHERE company_address_2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $companyAddress2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyAddress2($companyAddress2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($companyAddress2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ADDRESS_2, $companyAddress2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_default_currency column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyDefaultCurrency(1234); // WHERE company_default_currency = 1234
     * $query->filterByCompanyDefaultCurrency(array(12, 34)); // WHERE company_default_currency IN (12, 34)
     * $query->filterByCompanyDefaultCurrency(array('min' => 12)); // WHERE company_default_currency > 12
     * </code>
     *
     * @see       filterByCurrencies()
     *
     * @param mixed $companyDefaultCurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyDefaultCurrency($companyDefaultCurrency = null, ?string $comparison = null)
    {
        if (is_array($companyDefaultCurrency)) {
            $useMinMax = false;
            if (isset($companyDefaultCurrency['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, $companyDefaultCurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyDefaultCurrency['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, $companyDefaultCurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, $companyDefaultCurrency, $comparison);

        return $this;
    }

    /**
     * Filter the query on the timezone column
     *
     * Example usage:
     * <code>
     * $query->filterByTimezone('fooValue');   // WHERE timezone = 'fooValue'
     * $query->filterByTimezone('%fooValue%', Criteria::LIKE); // WHERE timezone LIKE '%fooValue%'
     * $query->filterByTimezone(['foo', 'bar']); // WHERE timezone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $timezone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTimezone($timezone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timezone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_TIMEZONE, $timezone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the company_first_setup column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyFirstSetup(1234); // WHERE company_first_setup = 1234
     * $query->filterByCompanyFirstSetup(array(12, 34)); // WHERE company_first_setup IN (12, 34)
     * $query->filterByCompanyFirstSetup(array('min' => 12)); // WHERE company_first_setup > 12
     * </code>
     *
     * @param mixed $companyFirstSetup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyFirstSetup($companyFirstSetup = null, ?string $comparison = null)
    {
        if (is_array($companyFirstSetup)) {
            $useMinMax = false;
            if (isset($companyFirstSetup['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_FIRST_SETUP, $companyFirstSetup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyFirstSetup['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_COMPANY_FIRST_SETUP, $companyFirstSetup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_COMPANY_FIRST_SETUP, $companyFirstSetup, $comparison);

        return $this;
    }

    /**
     * Filter the query on the owner_email column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnerEmail('fooValue');   // WHERE owner_email = 'fooValue'
     * $query->filterByOwnerEmail('%fooValue%', Criteria::LIKE); // WHERE owner_email LIKE '%fooValue%'
     * $query->filterByOwnerEmail(['foo', 'bar']); // WHERE owner_email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ownerEmail The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOwnerEmail($ownerEmail = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ownerEmail)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_OWNER_EMAIL, $ownerEmail, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_reminder column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseReminder(1234); // WHERE expense_reminder = 1234
     * $query->filterByExpenseReminder(array(12, 34)); // WHERE expense_reminder IN (12, 34)
     * $query->filterByExpenseReminder(array('min' => 12)); // WHERE expense_reminder > 12
     * </code>
     *
     * @param mixed $expenseReminder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseReminder($expenseReminder = null, ?string $comparison = null)
    {
        if (is_array($expenseReminder)) {
            $useMinMax = false;
            if (isset($expenseReminder['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_REMINDER, $expenseReminder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseReminder['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_REMINDER, $expenseReminder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_REMINDER, $expenseReminder, $comparison);

        return $this;
    }

    /**
     * Filter the query on the currentmonthsubmit column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrentmonthsubmit(1234); // WHERE currentmonthsubmit = 1234
     * $query->filterByCurrentmonthsubmit(array(12, 34)); // WHERE currentmonthsubmit IN (12, 34)
     * $query->filterByCurrentmonthsubmit(array('min' => 12)); // WHERE currentmonthsubmit > 12
     * </code>
     *
     * @param mixed $currentmonthsubmit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrentmonthsubmit($currentmonthsubmit = null, ?string $comparison = null)
    {
        if (is_array($currentmonthsubmit)) {
            $useMinMax = false;
            if (isset($currentmonthsubmit['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_CURRENTMONTHSUBMIT, $currentmonthsubmit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currentmonthsubmit['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_CURRENTMONTHSUBMIT, $currentmonthsubmit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_CURRENTMONTHSUBMIT, $currentmonthsubmit, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tripapprovalreq column
     *
     * Example usage:
     * <code>
     * $query->filterByTripapprovalreq(1234); // WHERE tripapprovalreq = 1234
     * $query->filterByTripapprovalreq(array(12, 34)); // WHERE tripapprovalreq IN (12, 34)
     * $query->filterByTripapprovalreq(array('min' => 12)); // WHERE tripapprovalreq > 12
     * </code>
     *
     * @param mixed $tripapprovalreq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTripapprovalreq($tripapprovalreq = null, ?string $comparison = null)
    {
        if (is_array($tripapprovalreq)) {
            $useMinMax = false;
            if (isset($tripapprovalreq['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_TRIPAPPROVALREQ, $tripapprovalreq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tripapprovalreq['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_TRIPAPPROVALREQ, $tripapprovalreq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_TRIPAPPROVALREQ, $tripapprovalreq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expenseonlyontrip column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseonlyontrip(1234); // WHERE expenseonlyontrip = 1234
     * $query->filterByExpenseonlyontrip(array(12, 34)); // WHERE expenseonlyontrip IN (12, 34)
     * $query->filterByExpenseonlyontrip(array('min' => 12)); // WHERE expenseonlyontrip > 12
     * </code>
     *
     * @param mixed $expenseonlyontrip The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseonlyontrip($expenseonlyontrip = null, ?string $comparison = null)
    {
        if (is_array($expenseonlyontrip)) {
            $useMinMax = false;
            if (isset($expenseonlyontrip['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSEONLYONTRIP, $expenseonlyontrip['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseonlyontrip['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSEONLYONTRIP, $expenseonlyontrip['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_EXPENSEONLYONTRIP, $expenseonlyontrip, $comparison);

        return $this;
    }

    /**
     * Filter the query on the allowbackdatedtrip column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowbackdatedtrip(1234); // WHERE allowbackdatedtrip = 1234
     * $query->filterByAllowbackdatedtrip(array(12, 34)); // WHERE allowbackdatedtrip IN (12, 34)
     * $query->filterByAllowbackdatedtrip(array('min' => 12)); // WHERE allowbackdatedtrip > 12
     * </code>
     *
     * @param mixed $allowbackdatedtrip The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAllowbackdatedtrip($allowbackdatedtrip = null, ?string $comparison = null)
    {
        if (is_array($allowbackdatedtrip)) {
            $useMinMax = false;
            if (isset($allowbackdatedtrip['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ALLOWBACKDATEDTRIP, $allowbackdatedtrip['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allowbackdatedtrip['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ALLOWBACKDATEDTRIP, $allowbackdatedtrip['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_ALLOWBACKDATEDTRIP, $allowbackdatedtrip, $comparison);

        return $this;
    }

    /**
     * Filter the query on the paymentsystem column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentsystem(1234); // WHERE paymentsystem = 1234
     * $query->filterByPaymentsystem(array(12, 34)); // WHERE paymentsystem IN (12, 34)
     * $query->filterByPaymentsystem(array('min' => 12)); // WHERE paymentsystem > 12
     * </code>
     *
     * @param mixed $paymentsystem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentsystem($paymentsystem = null, ?string $comparison = null)
    {
        if (is_array($paymentsystem)) {
            $useMinMax = false;
            if (isset($paymentsystem['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_PAYMENTSYSTEM, $paymentsystem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentsystem['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_PAYMENTSYSTEM, $paymentsystem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_PAYMENTSYSTEM, $paymentsystem, $comparison);

        return $this;
    }

    /**
     * Filter the query on the auto_settle column
     *
     * Example usage:
     * <code>
     * $query->filterByAutoSettle(1234); // WHERE auto_settle = 1234
     * $query->filterByAutoSettle(array(12, 34)); // WHERE auto_settle IN (12, 34)
     * $query->filterByAutoSettle(array('min' => 12)); // WHERE auto_settle > 12
     * </code>
     *
     * @param mixed $autoSettle The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutoSettle($autoSettle = null, ?string $comparison = null)
    {
        if (is_array($autoSettle)) {
            $useMinMax = false;
            if (isset($autoSettle['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_AUTO_SETTLE, $autoSettle['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autoSettle['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_AUTO_SETTLE, $autoSettle['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_AUTO_SETTLE, $autoSettle, $comparison);

        return $this;
    }

    /**
     * Filter the query on the allowradius column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowradius(1234); // WHERE allowradius = 1234
     * $query->filterByAllowradius(array(12, 34)); // WHERE allowradius IN (12, 34)
     * $query->filterByAllowradius(array('min' => 12)); // WHERE allowradius > 12
     * </code>
     *
     * @param mixed $allowradius The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAllowradius($allowradius = null, ?string $comparison = null)
    {
        if (is_array($allowradius)) {
            $useMinMax = false;
            if (isset($allowradius['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ALLOWRADIUS, $allowradius['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allowradius['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ALLOWRADIUS, $allowradius['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_ALLOWRADIUS, $allowradius, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_seq column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderSeq(1234); // WHERE order_seq = 1234
     * $query->filterByOrderSeq(array(12, 34)); // WHERE order_seq IN (12, 34)
     * $query->filterByOrderSeq(array('min' => 12)); // WHERE order_seq > 12
     * </code>
     *
     * @param mixed $orderSeq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderSeq($orderSeq = null, ?string $comparison = null)
    {
        if (is_array($orderSeq)) {
            $useMinMax = false;
            if (isset($orderSeq['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ORDER_SEQ, $orderSeq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderSeq['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_ORDER_SEQ, $orderSeq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_ORDER_SEQ, $orderSeq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the shippingorder_seq column
     *
     * Example usage:
     * <code>
     * $query->filterByShippingorderSeq(1234); // WHERE shippingorder_seq = 1234
     * $query->filterByShippingorderSeq(array(12, 34)); // WHERE shippingorder_seq IN (12, 34)
     * $query->filterByShippingorderSeq(array('min' => 12)); // WHERE shippingorder_seq > 12
     * </code>
     *
     * @param mixed $shippingorderSeq The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorderSeq($shippingorderSeq = null, ?string $comparison = null)
    {
        if (is_array($shippingorderSeq)) {
            $useMinMax = false;
            if (isset($shippingorderSeq['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_SHIPPINGORDER_SEQ, $shippingorderSeq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($shippingorderSeq['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_SHIPPINGORDER_SEQ, $shippingorderSeq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_SHIPPINGORDER_SEQ, $shippingorderSeq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the googlemapkey column
     *
     * Example usage:
     * <code>
     * $query->filterByGooglemapkey('fooValue');   // WHERE googlemapkey = 'fooValue'
     * $query->filterByGooglemapkey('%fooValue%', Criteria::LIKE); // WHERE googlemapkey LIKE '%fooValue%'
     * $query->filterByGooglemapkey(['foo', 'bar']); // WHERE googlemapkey IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $googlemapkey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGooglemapkey($googlemapkey = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($googlemapkey)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_GOOGLEMAPKEY, $googlemapkey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the workingdaysinweek column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkingdaysinweek(1234); // WHERE workingdaysinweek = 1234
     * $query->filterByWorkingdaysinweek(array(12, 34)); // WHERE workingdaysinweek IN (12, 34)
     * $query->filterByWorkingdaysinweek(array('min' => 12)); // WHERE workingdaysinweek > 12
     * </code>
     *
     * @param mixed $workingdaysinweek The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkingdaysinweek($workingdaysinweek = null, ?string $comparison = null)
    {
        if (is_array($workingdaysinweek)) {
            $useMinMax = false;
            if (isset($workingdaysinweek['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_WORKINGDAYSINWEEK, $workingdaysinweek['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workingdaysinweek['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_WORKINGDAYSINWEEK, $workingdaysinweek['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_WORKINGDAYSINWEEK, $workingdaysinweek, $comparison);

        return $this;
    }

    /**
     * Filter the query on the auto_calculated_ta column
     *
     * Example usage:
     * <code>
     * $query->filterByAutoCalculatedTa(1234); // WHERE auto_calculated_ta = 1234
     * $query->filterByAutoCalculatedTa(array(12, 34)); // WHERE auto_calculated_ta IN (12, 34)
     * $query->filterByAutoCalculatedTa(array('min' => 12)); // WHERE auto_calculated_ta > 12
     * </code>
     *
     * @see       filterByExpenseMasterRelatedByAutoCalculatedTa()
     *
     * @param mixed $autoCalculatedTa The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAutoCalculatedTa($autoCalculatedTa = null, ?string $comparison = null)
    {
        if (is_array($autoCalculatedTa)) {
            $useMinMax = false;
            if (isset($autoCalculatedTa['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_AUTO_CALCULATED_TA, $autoCalculatedTa['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autoCalculatedTa['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_AUTO_CALCULATED_TA, $autoCalculatedTa['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_AUTO_CALCULATED_TA, $autoCalculatedTa, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_days column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingDays('fooValue');   // WHERE reporting_days = 'fooValue'
     * $query->filterByReportingDays('%fooValue%', Criteria::LIKE); // WHERE reporting_days LIKE '%fooValue%'
     * $query->filterByReportingDays(['foo', 'bar']); // WHERE reporting_days IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reportingDays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingDays($reportingDays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportingDays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_REPORTING_DAYS, $reportingDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_months column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseMonths(1234); // WHERE expense_months = 1234
     * $query->filterByExpenseMonths(array(12, 34)); // WHERE expense_months IN (12, 34)
     * $query->filterByExpenseMonths(array('min' => 12)); // WHERE expense_months > 12
     * </code>
     *
     * @param mixed $expenseMonths The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMonths($expenseMonths = null, ?string $comparison = null)
    {
        if (is_array($expenseMonths)) {
            $useMinMax = false;
            if (isset($expenseMonths['min'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_MONTHS, $expenseMonths['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expenseMonths['max'])) {
                $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_MONTHS, $expenseMonths['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CompanyTableMap::COL_EXPENSE_MONTHS, $expenseMonths, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\ExpenseMaster object
     *
     * @param \entities\ExpenseMaster|ObjectCollection $expenseMaster The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMasterRelatedByAutoCalculatedTa($expenseMaster, ?string $comparison = null)
    {
        if ($expenseMaster instanceof \entities\ExpenseMaster) {
            return $this
                ->addUsingAlias(CompanyTableMap::COL_AUTO_CALCULATED_TA, $expenseMaster->getExpenseId(), $comparison);
        } elseif ($expenseMaster instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompanyTableMap::COL_AUTO_CALCULATED_TA, $expenseMaster->toKeyValue('PrimaryKey', 'ExpenseId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByExpenseMasterRelatedByAutoCalculatedTa() only accepts arguments of type \entities\ExpenseMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseMasterRelatedByAutoCalculatedTa relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseMasterRelatedByAutoCalculatedTa(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseMasterRelatedByAutoCalculatedTa');

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
            $this->addJoinObject($join, 'ExpenseMasterRelatedByAutoCalculatedTa');
        }

        return $this;
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation ExpenseMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseMasterQuery A secondary query class using the current class as primary query
     */
    public function useExpenseMasterRelatedByAutoCalculatedTaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinExpenseMasterRelatedByAutoCalculatedTa($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseMasterRelatedByAutoCalculatedTa', '\entities\ExpenseMasterQuery');
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation ExpenseMaster object
     *
     * @param callable(\entities\ExpenseMasterQuery):\entities\ExpenseMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseMasterRelatedByAutoCalculatedTaQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useExpenseMasterRelatedByAutoCalculatedTaQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation to the ExpenseMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the EXISTS statement
     */
    public function useExpenseMasterRelatedByAutoCalculatedTaExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMasterRelatedByAutoCalculatedTa', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation to the ExpenseMaster table for a NOT EXISTS query.
     *
     * @see useExpenseMasterRelatedByAutoCalculatedTaExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseMasterRelatedByAutoCalculatedTaNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMasterRelatedByAutoCalculatedTa', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation to the ExpenseMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the IN statement
     */
    public function useInExpenseMasterRelatedByAutoCalculatedTaQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMasterRelatedByAutoCalculatedTa', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByAutoCalculatedTa relation to the ExpenseMaster table for a NOT IN query.
     *
     * @see useExpenseMasterRelatedByAutoCalculatedTaInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseMasterRelatedByAutoCalculatedTaQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMasterRelatedByAutoCalculatedTa', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Currencies object
     *
     * @param \entities\Currencies|ObjectCollection $currencies The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrencies($currencies, ?string $comparison = null)
    {
        if ($currencies instanceof \entities\Currencies) {
            return $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, $currencies->getCurrencyId(), $comparison);
        } elseif ($currencies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, $currencies->toKeyValue('PrimaryKey', 'CurrencyId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCurrencies() only accepts arguments of type \entities\Currencies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currencies relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCurrencies(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currencies');

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
            $this->addJoinObject($join, 'Currencies');
        }

        return $this;
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CurrenciesQuery A secondary query class using the current class as primary query
     */
    public function useCurrenciesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCurrencies($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currencies', '\entities\CurrenciesQuery');
    }

    /**
     * Use the Currencies relation Currencies object
     *
     * @param callable(\entities\CurrenciesQuery):\entities\CurrenciesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCurrenciesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCurrenciesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Currencies table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CurrenciesQuery The inner query object of the EXISTS statement
     */
    public function useCurrenciesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT EXISTS query.
     *
     * @see useCurrenciesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCurrenciesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useExistsQuery('Currencies', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Currencies table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CurrenciesQuery The inner query object of the IN statement
     */
    public function useInCurrenciesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Currencies table for a NOT IN query.
     *
     * @see useCurrenciesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CurrenciesQuery The inner query object of the NOT IN statement
     */
    public function useNotInCurrenciesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CurrenciesQuery */
        $q = $this->useInQuery('Currencies', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Agendatypes object
     *
     * @param \entities\Agendatypes|ObjectCollection $agendatypes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgendatypes($agendatypes, ?string $comparison = null)
    {
        if ($agendatypes instanceof \entities\Agendatypes) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $agendatypes->getCompanyId(), $comparison);

            return $this;
        } elseif ($agendatypes instanceof ObjectCollection) {
            $this
                ->useAgendatypesQuery()
                ->filterByPrimaryKeys($agendatypes->getPrimaryKeys())
                ->endUse();

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
    public function joinAgendatypes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useAgendatypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Announcements object
     *
     * @param \entities\Announcements|ObjectCollection $announcements the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnnouncements($announcements, ?string $comparison = null)
    {
        if ($announcements instanceof \entities\Announcements) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $announcements->getCompanyId(), $comparison);

            return $this;
        } elseif ($announcements instanceof ObjectCollection) {
            $this
                ->useAnnouncementsQuery()
                ->filterByPrimaryKeys($announcements->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAnnouncements() only accepts arguments of type \entities\Announcements or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Announcements relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAnnouncements(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Announcements');

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
            $this->addJoinObject($join, 'Announcements');
        }

        return $this;
    }

    /**
     * Use the Announcements relation Announcements object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AnnouncementsQuery A secondary query class using the current class as primary query
     */
    public function useAnnouncementsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAnnouncements($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Announcements', '\entities\AnnouncementsQuery');
    }

    /**
     * Use the Announcements relation Announcements object
     *
     * @param callable(\entities\AnnouncementsQuery):\entities\AnnouncementsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAnnouncementsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAnnouncementsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Announcements table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AnnouncementsQuery The inner query object of the EXISTS statement
     */
    public function useAnnouncementsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useExistsQuery('Announcements', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Announcements table for a NOT EXISTS query.
     *
     * @see useAnnouncementsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementsQuery The inner query object of the NOT EXISTS statement
     */
    public function useAnnouncementsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useExistsQuery('Announcements', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Announcements table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AnnouncementsQuery The inner query object of the IN statement
     */
    public function useInAnnouncementsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useInQuery('Announcements', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Announcements table for a NOT IN query.
     *
     * @see useAnnouncementsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AnnouncementsQuery The inner query object of the NOT IN statement
     */
    public function useNotInAnnouncementsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AnnouncementsQuery */
        $q = $this->useInQuery('Announcements', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ApiKeys object
     *
     * @param \entities\ApiKeys|ObjectCollection $apiKeys the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApiKeys($apiKeys, ?string $comparison = null)
    {
        if ($apiKeys instanceof \entities\ApiKeys) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $apiKeys->getCompanyId(), $comparison);

            return $this;
        } elseif ($apiKeys instanceof ObjectCollection) {
            $this
                ->useApiKeysQuery()
                ->filterByPrimaryKeys($apiKeys->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByApiKeys() only accepts arguments of type \entities\ApiKeys or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ApiKeys relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinApiKeys(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ApiKeys');

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
            $this->addJoinObject($join, 'ApiKeys');
        }

        return $this;
    }

    /**
     * Use the ApiKeys relation ApiKeys object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ApiKeysQuery A secondary query class using the current class as primary query
     */
    public function useApiKeysQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinApiKeys($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ApiKeys', '\entities\ApiKeysQuery');
    }

    /**
     * Use the ApiKeys relation ApiKeys object
     *
     * @param callable(\entities\ApiKeysQuery):\entities\ApiKeysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withApiKeysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useApiKeysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ApiKeys table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ApiKeysQuery The inner query object of the EXISTS statement
     */
    public function useApiKeysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ApiKeysQuery */
        $q = $this->useExistsQuery('ApiKeys', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ApiKeys table for a NOT EXISTS query.
     *
     * @see useApiKeysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ApiKeysQuery The inner query object of the NOT EXISTS statement
     */
    public function useApiKeysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ApiKeysQuery */
        $q = $this->useExistsQuery('ApiKeys', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ApiKeys table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ApiKeysQuery The inner query object of the IN statement
     */
    public function useInApiKeysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ApiKeysQuery */
        $q = $this->useInQuery('ApiKeys', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ApiKeys table for a NOT IN query.
     *
     * @see useApiKeysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ApiKeysQuery The inner query object of the NOT IN statement
     */
    public function useNotInApiKeysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ApiKeysQuery */
        $q = $this->useInQuery('ApiKeys', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $attendance->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $beatOutlets->getCompanyId(), $comparison);

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
    public function joinBeatOutlets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useBeatOutletsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Beats object
     *
     * @param \entities\Beats|ObjectCollection $beats the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeats($beats, ?string $comparison = null)
    {
        if ($beats instanceof \entities\Beats) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $beats->getCompanyId(), $comparison);

            return $this;
        } elseif ($beats instanceof ObjectCollection) {
            $this
                ->useBeatsQuery()
                ->filterByPrimaryKeys($beats->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBeats() only accepts arguments of type \entities\Beats or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Beats relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBeats(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Beats');

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
            $this->addJoinObject($join, 'Beats');
        }

        return $this;
    }

    /**
     * Use the Beats relation Beats object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BeatsQuery A secondary query class using the current class as primary query
     */
    public function useBeatsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBeats($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Beats', '\entities\BeatsQuery');
    }

    /**
     * Use the Beats relation Beats object
     *
     * @param callable(\entities\BeatsQuery):\entities\BeatsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBeatsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBeatsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Beats table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BeatsQuery The inner query object of the EXISTS statement
     */
    public function useBeatsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT EXISTS query.
     *
     * @see useBeatsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT EXISTS statement
     */
    public function useBeatsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useExistsQuery('Beats', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Beats table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BeatsQuery The inner query object of the IN statement
     */
    public function useInBeatsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Beats table for a NOT IN query.
     *
     * @see useBeatsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BeatsQuery The inner query object of the NOT IN statement
     */
    public function useNotInBeatsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BeatsQuery */
        $q = $this->useInQuery('Beats', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Branch object
     *
     * @param \entities\Branch|ObjectCollection $branch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBranch($branch, ?string $comparison = null)
    {
        if ($branch instanceof \entities\Branch) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $branch->getCompanyId(), $comparison);

            return $this;
        } elseif ($branch instanceof ObjectCollection) {
            $this
                ->useBranchQuery()
                ->filterByPrimaryKeys($branch->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\BrandCampiagn object
     *
     * @param \entities\BrandCampiagn|ObjectCollection $brandCampiagn the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagn($brandCampiagn, ?string $comparison = null)
    {
        if ($brandCampiagn instanceof \entities\BrandCampiagn) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brandCampiagn->getCompanyId(), $comparison);

            return $this;
        } elseif ($brandCampiagn instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnQuery()
                ->filterByPrimaryKeys($brandCampiagn->getPrimaryKeys())
                ->endUse();

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brandCampiagnDoctors->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\BrandCampiagnVisitPlan object
     *
     * @param \entities\BrandCampiagnVisitPlan|ObjectCollection $brandCampiagnVisitPlan the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandCampiagnVisitPlan($brandCampiagnVisitPlan, ?string $comparison = null)
    {
        if ($brandCampiagnVisitPlan instanceof \entities\BrandCampiagnVisitPlan) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brandCampiagnVisitPlan->getCompanyId(), $comparison);

            return $this;
        } elseif ($brandCampiagnVisitPlan instanceof ObjectCollection) {
            $this
                ->useBrandCampiagnVisitPlanQuery()
                ->filterByPrimaryKeys($brandCampiagnVisitPlan->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBrandCampiagnVisitPlan() only accepts arguments of type \entities\BrandCampiagnVisitPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BrandCampiagnVisitPlan relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBrandCampiagnVisitPlan(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BrandCampiagnVisitPlan');

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
            $this->addJoinObject($join, 'BrandCampiagnVisitPlan');
        }

        return $this;
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BrandCampiagnVisitPlanQuery A secondary query class using the current class as primary query
     */
    public function useBrandCampiagnVisitPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBrandCampiagnVisitPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BrandCampiagnVisitPlan', '\entities\BrandCampiagnVisitPlanQuery');
    }

    /**
     * Use the BrandCampiagnVisitPlan relation BrandCampiagnVisitPlan object
     *
     * @param callable(\entities\BrandCampiagnVisitPlanQuery):\entities\BrandCampiagnVisitPlanQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBrandCampiagnVisitPlanQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useBrandCampiagnVisitPlanQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the EXISTS statement
     */
    public function useBrandCampiagnVisitPlanExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT EXISTS query.
     *
     * @see useBrandCampiagnVisitPlanExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT EXISTS statement
     */
    public function useBrandCampiagnVisitPlanNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useExistsQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the IN statement
     */
    public function useInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BrandCampiagnVisitPlan table for a NOT IN query.
     *
     * @see useBrandCampiagnVisitPlanInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BrandCampiagnVisitPlanQuery The inner query object of the NOT IN statement
     */
    public function useNotInBrandCampiagnVisitPlanQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BrandCampiagnVisitPlanQuery */
        $q = $this->useInQuery('BrandCampiagnVisitPlan', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brandCompetition->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brandRcpa->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\Brands object
     *
     * @param \entities\Brands|ObjectCollection $brands the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \entities\Brands) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $brands->getCompanyId(), $comparison);

            return $this;
        } elseif ($brands instanceof ObjectCollection) {
            $this
                ->useBrandsQuery()
                ->filterByPrimaryKeys($brands->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\BudgetGroup object
     *
     * @param \entities\BudgetGroup|ObjectCollection $budgetGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBudgetGroup($budgetGroup, ?string $comparison = null)
    {
        if ($budgetGroup instanceof \entities\BudgetGroup) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $budgetGroup->getCompanyId(), $comparison);

            return $this;
        } elseif ($budgetGroup instanceof ObjectCollection) {
            $this
                ->useBudgetGroupQuery()
                ->filterByPrimaryKeys($budgetGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBudgetGroup() only accepts arguments of type \entities\BudgetGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BudgetGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBudgetGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BudgetGroup');

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
            $this->addJoinObject($join, 'BudgetGroup');
        }

        return $this;
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\BudgetGroupQuery A secondary query class using the current class as primary query
     */
    public function useBudgetGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBudgetGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BudgetGroup', '\entities\BudgetGroupQuery');
    }

    /**
     * Use the BudgetGroup relation BudgetGroup object
     *
     * @param callable(\entities\BudgetGroupQuery):\entities\BudgetGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBudgetGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBudgetGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to BudgetGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\BudgetGroupQuery The inner query object of the EXISTS statement
     */
    public function useBudgetGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT EXISTS query.
     *
     * @see useBudgetGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useBudgetGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useExistsQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\BudgetGroupQuery The inner query object of the IN statement
     */
    public function useInBudgetGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to BudgetGroup table for a NOT IN query.
     *
     * @see useBudgetGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\BudgetGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInBudgetGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\BudgetGroupQuery */
        $q = $this->useInQuery('BudgetGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Categories object
     *
     * @param \entities\Categories|ObjectCollection $categories the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategories($categories, ?string $comparison = null)
    {
        if ($categories instanceof \entities\Categories) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $categories->getCompanyId(), $comparison);

            return $this;
        } elseif ($categories instanceof ObjectCollection) {
            $this
                ->useCategoriesQuery()
                ->filterByPrimaryKeys($categories->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\CheckinoutOutcomes object
     *
     * @param \entities\CheckinoutOutcomes|ObjectCollection $checkinoutOutcomes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCheckinoutOutcomes($checkinoutOutcomes, ?string $comparison = null)
    {
        if ($checkinoutOutcomes instanceof \entities\CheckinoutOutcomes) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $checkinoutOutcomes->getCompanyId(), $comparison);

            return $this;
        } elseif ($checkinoutOutcomes instanceof ObjectCollection) {
            $this
                ->useCheckinoutOutcomesQuery()
                ->filterByPrimaryKeys($checkinoutOutcomes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCheckinoutOutcomes() only accepts arguments of type \entities\CheckinoutOutcomes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CheckinoutOutcomes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCheckinoutOutcomes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CheckinoutOutcomes');

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
            $this->addJoinObject($join, 'CheckinoutOutcomes');
        }

        return $this;
    }

    /**
     * Use the CheckinoutOutcomes relation CheckinoutOutcomes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CheckinoutOutcomesQuery A secondary query class using the current class as primary query
     */
    public function useCheckinoutOutcomesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCheckinoutOutcomes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CheckinoutOutcomes', '\entities\CheckinoutOutcomesQuery');
    }

    /**
     * Use the CheckinoutOutcomes relation CheckinoutOutcomes object
     *
     * @param callable(\entities\CheckinoutOutcomesQuery):\entities\CheckinoutOutcomesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCheckinoutOutcomesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCheckinoutOutcomesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CheckinoutOutcomes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CheckinoutOutcomesQuery The inner query object of the EXISTS statement
     */
    public function useCheckinoutOutcomesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CheckinoutOutcomesQuery */
        $q = $this->useExistsQuery('CheckinoutOutcomes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CheckinoutOutcomes table for a NOT EXISTS query.
     *
     * @see useCheckinoutOutcomesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CheckinoutOutcomesQuery The inner query object of the NOT EXISTS statement
     */
    public function useCheckinoutOutcomesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CheckinoutOutcomesQuery */
        $q = $this->useExistsQuery('CheckinoutOutcomes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CheckinoutOutcomes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CheckinoutOutcomesQuery The inner query object of the IN statement
     */
    public function useInCheckinoutOutcomesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CheckinoutOutcomesQuery */
        $q = $this->useInQuery('CheckinoutOutcomes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CheckinoutOutcomes table for a NOT IN query.
     *
     * @see useCheckinoutOutcomesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CheckinoutOutcomesQuery The inner query object of the NOT IN statement
     */
    public function useNotInCheckinoutOutcomesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CheckinoutOutcomesQuery */
        $q = $this->useInQuery('CheckinoutOutcomes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Citycategory object
     *
     * @param \entities\Citycategory|ObjectCollection $citycategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCitycategory($citycategory, ?string $comparison = null)
    {
        if ($citycategory instanceof \entities\Citycategory) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $citycategory->getCompanyId(), $comparison);

            return $this;
        } elseif ($citycategory instanceof ObjectCollection) {
            $this
                ->useCitycategoryQuery()
                ->filterByPrimaryKeys($citycategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCitycategory() only accepts arguments of type \entities\Citycategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Citycategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCitycategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Citycategory');

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
            $this->addJoinObject($join, 'Citycategory');
        }

        return $this;
    }

    /**
     * Use the Citycategory relation Citycategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CitycategoryQuery A secondary query class using the current class as primary query
     */
    public function useCitycategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCitycategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Citycategory', '\entities\CitycategoryQuery');
    }

    /**
     * Use the Citycategory relation Citycategory object
     *
     * @param callable(\entities\CitycategoryQuery):\entities\CitycategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCitycategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCitycategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Citycategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CitycategoryQuery The inner query object of the EXISTS statement
     */
    public function useCitycategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useExistsQuery('Citycategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Citycategory table for a NOT EXISTS query.
     *
     * @see useCitycategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CitycategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCitycategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useExistsQuery('Citycategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Citycategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CitycategoryQuery The inner query object of the IN statement
     */
    public function useInCitycategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useInQuery('Citycategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Citycategory table for a NOT IN query.
     *
     * @see useCitycategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CitycategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInCitycategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CitycategoryQuery */
        $q = $this->useInQuery('Citycategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Classification object
     *
     * @param \entities\Classification|ObjectCollection $classification the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification, ?string $comparison = null)
    {
        if ($classification instanceof \entities\Classification) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $classification->getCompanyId(), $comparison);

            return $this;
        } elseif ($classification instanceof ObjectCollection) {
            $this
                ->useClassificationQuery()
                ->filterByPrimaryKeys($classification->getPrimaryKeys())
                ->endUse();

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
    public function joinClassification(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useClassificationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $competitionMapping->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\Competitor object
     *
     * @param \entities\Competitor|ObjectCollection $competitor the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompetitor($competitor, ?string $comparison = null)
    {
        if ($competitor instanceof \entities\Competitor) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $competitor->getCompanyId(), $comparison);

            return $this;
        } elseif ($competitor instanceof ObjectCollection) {
            $this
                ->useCompetitorQuery()
                ->filterByPrimaryKeys($competitor->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompetitor() only accepts arguments of type \entities\Competitor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Competitor relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompetitor(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Competitor');

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
            $this->addJoinObject($join, 'Competitor');
        }

        return $this;
    }

    /**
     * Use the Competitor relation Competitor object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CompetitorQuery A secondary query class using the current class as primary query
     */
    public function useCompetitorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompetitor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Competitor', '\entities\CompetitorQuery');
    }

    /**
     * Use the Competitor relation Competitor object
     *
     * @param callable(\entities\CompetitorQuery):\entities\CompetitorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompetitorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompetitorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Competitor table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CompetitorQuery The inner query object of the EXISTS statement
     */
    public function useCompetitorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useExistsQuery('Competitor', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Competitor table for a NOT EXISTS query.
     *
     * @see useCompetitorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitorQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompetitorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useExistsQuery('Competitor', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Competitor table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CompetitorQuery The inner query object of the IN statement
     */
    public function useInCompetitorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useInQuery('Competitor', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Competitor table for a NOT IN query.
     *
     * @see useCompetitorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CompetitorQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompetitorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CompetitorQuery */
        $q = $this->useInQuery('Competitor', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Configuration object
     *
     * @param \entities\Configuration|ObjectCollection $configuration the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConfiguration($configuration, ?string $comparison = null)
    {
        if ($configuration instanceof \entities\Configuration) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $configuration->getCompanyId(), $comparison);

            return $this;
        } elseif ($configuration instanceof ObjectCollection) {
            $this
                ->useConfigurationQuery()
                ->filterByPrimaryKeys($configuration->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByConfiguration() only accepts arguments of type \entities\Configuration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Configuration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Configuration');

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
            $this->addJoinObject($join, 'Configuration');
        }

        return $this;
    }

    /**
     * Use the Configuration relation Configuration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Configuration', '\entities\ConfigurationQuery');
    }

    /**
     * Use the Configuration relation Configuration object
     *
     * @param callable(\entities\ConfigurationQuery):\entities\ConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Configuration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ConfigurationQuery */
        $q = $this->useExistsQuery('Configuration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Configuration table for a NOT EXISTS query.
     *
     * @see useConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ConfigurationQuery */
        $q = $this->useExistsQuery('Configuration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Configuration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ConfigurationQuery The inner query object of the IN statement
     */
    public function useInConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ConfigurationQuery */
        $q = $this->useInQuery('Configuration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Configuration table for a NOT IN query.
     *
     * @see useConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ConfigurationQuery */
        $q = $this->useInQuery('Configuration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\CronCommandLogs object
     *
     * @param \entities\CronCommandLogs|ObjectCollection $cronCommandLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCronCommandLogs($cronCommandLogs, ?string $comparison = null)
    {
        if ($cronCommandLogs instanceof \entities\CronCommandLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $cronCommandLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($cronCommandLogs instanceof ObjectCollection) {
            $this
                ->useCronCommandLogsQuery()
                ->filterByPrimaryKeys($cronCommandLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCronCommandLogs() only accepts arguments of type \entities\CronCommandLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CronCommandLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCronCommandLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CronCommandLogs');

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
            $this->addJoinObject($join, 'CronCommandLogs');
        }

        return $this;
    }

    /**
     * Use the CronCommandLogs relation CronCommandLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CronCommandLogsQuery A secondary query class using the current class as primary query
     */
    public function useCronCommandLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCronCommandLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CronCommandLogs', '\entities\CronCommandLogsQuery');
    }

    /**
     * Use the CronCommandLogs relation CronCommandLogs object
     *
     * @param callable(\entities\CronCommandLogsQuery):\entities\CronCommandLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCronCommandLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCronCommandLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CronCommandLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the EXISTS statement
     */
    public function useCronCommandLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useExistsQuery('CronCommandLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for a NOT EXISTS query.
     *
     * @see useCronCommandLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCronCommandLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useExistsQuery('CronCommandLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the IN statement
     */
    public function useInCronCommandLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useInQuery('CronCommandLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CronCommandLogs table for a NOT IN query.
     *
     * @see useCronCommandLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInCronCommandLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandLogsQuery */
        $q = $this->useInQuery('CronCommandLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\CronCommands object
     *
     * @param \entities\CronCommands|ObjectCollection $cronCommands the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCronCommands($cronCommands, ?string $comparison = null)
    {
        if ($cronCommands instanceof \entities\CronCommands) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $cronCommands->getCompanyId(), $comparison);

            return $this;
        } elseif ($cronCommands instanceof ObjectCollection) {
            $this
                ->useCronCommandsQuery()
                ->filterByPrimaryKeys($cronCommands->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCronCommands() only accepts arguments of type \entities\CronCommands or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CronCommands relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCronCommands(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CronCommands');

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
            $this->addJoinObject($join, 'CronCommands');
        }

        return $this;
    }

    /**
     * Use the CronCommands relation CronCommands object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\CronCommandsQuery A secondary query class using the current class as primary query
     */
    public function useCronCommandsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCronCommands($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CronCommands', '\entities\CronCommandsQuery');
    }

    /**
     * Use the CronCommands relation CronCommands object
     *
     * @param callable(\entities\CronCommandsQuery):\entities\CronCommandsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCronCommandsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCronCommandsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to CronCommands table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\CronCommandsQuery The inner query object of the EXISTS statement
     */
    public function useCronCommandsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useExistsQuery('CronCommands', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to CronCommands table for a NOT EXISTS query.
     *
     * @see useCronCommandsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandsQuery The inner query object of the NOT EXISTS statement
     */
    public function useCronCommandsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useExistsQuery('CronCommands', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to CronCommands table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\CronCommandsQuery The inner query object of the IN statement
     */
    public function useInCronCommandsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useInQuery('CronCommands', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to CronCommands table for a NOT IN query.
     *
     * @see useCronCommandsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\CronCommandsQuery The inner query object of the NOT IN statement
     */
    public function useNotInCronCommandsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\CronCommandsQuery */
        $q = $this->useInQuery('CronCommands', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $dailycalls->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $dailycallsSgpiout->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\DataExceptionLogs object
     *
     * @param \entities\DataExceptionLogs|ObjectCollection $dataExceptionLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptionLogs($dataExceptionLogs, ?string $comparison = null)
    {
        if ($dataExceptionLogs instanceof \entities\DataExceptionLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $dataExceptionLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($dataExceptionLogs instanceof ObjectCollection) {
            $this
                ->useDataExceptionLogsQuery()
                ->filterByPrimaryKeys($dataExceptionLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDataExceptionLogs() only accepts arguments of type \entities\DataExceptionLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DataExceptionLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDataExceptionLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DataExceptionLogs');

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
            $this->addJoinObject($join, 'DataExceptionLogs');
        }

        return $this;
    }

    /**
     * Use the DataExceptionLogs relation DataExceptionLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DataExceptionLogsQuery A secondary query class using the current class as primary query
     */
    public function useDataExceptionLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDataExceptionLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DataExceptionLogs', '\entities\DataExceptionLogsQuery');
    }

    /**
     * Use the DataExceptionLogs relation DataExceptionLogs object
     *
     * @param callable(\entities\DataExceptionLogsQuery):\entities\DataExceptionLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDataExceptionLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDataExceptionLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DataExceptionLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the EXISTS statement
     */
    public function useDataExceptionLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useExistsQuery('DataExceptionLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for a NOT EXISTS query.
     *
     * @see useDataExceptionLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDataExceptionLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useExistsQuery('DataExceptionLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the IN statement
     */
    public function useInDataExceptionLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useInQuery('DataExceptionLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DataExceptionLogs table for a NOT IN query.
     *
     * @see useDataExceptionLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDataExceptionLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionLogsQuery */
        $q = $this->useInQuery('DataExceptionLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\DataExceptions object
     *
     * @param \entities\DataExceptions|ObjectCollection $dataExceptions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataExceptions($dataExceptions, ?string $comparison = null)
    {
        if ($dataExceptions instanceof \entities\DataExceptions) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $dataExceptions->getCompanyId(), $comparison);

            return $this;
        } elseif ($dataExceptions instanceof ObjectCollection) {
            $this
                ->useDataExceptionsQuery()
                ->filterByPrimaryKeys($dataExceptions->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDataExceptions() only accepts arguments of type \entities\DataExceptions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DataExceptions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDataExceptions(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DataExceptions');

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
            $this->addJoinObject($join, 'DataExceptions');
        }

        return $this;
    }

    /**
     * Use the DataExceptions relation DataExceptions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\DataExceptionsQuery A secondary query class using the current class as primary query
     */
    public function useDataExceptionsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDataExceptions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DataExceptions', '\entities\DataExceptionsQuery');
    }

    /**
     * Use the DataExceptions relation DataExceptions object
     *
     * @param callable(\entities\DataExceptionsQuery):\entities\DataExceptionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDataExceptionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDataExceptionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DataExceptions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\DataExceptionsQuery The inner query object of the EXISTS statement
     */
    public function useDataExceptionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useExistsQuery('DataExceptions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for a NOT EXISTS query.
     *
     * @see useDataExceptionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDataExceptionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useExistsQuery('DataExceptions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\DataExceptionsQuery The inner query object of the IN statement
     */
    public function useInDataExceptionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useInQuery('DataExceptions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DataExceptions table for a NOT IN query.
     *
     * @see useDataExceptionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\DataExceptionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInDataExceptionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\DataExceptionsQuery */
        $q = $this->useInQuery('DataExceptions', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Designations object
     *
     * @param \entities\Designations|ObjectCollection $designations the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignations($designations, ?string $comparison = null)
    {
        if ($designations instanceof \entities\Designations) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $designations->getCompanyId(), $comparison);

            return $this;
        } elseif ($designations instanceof ObjectCollection) {
            $this
                ->useDesignationsQuery()
                ->filterByPrimaryKeys($designations->getPrimaryKeys())
                ->endUse();

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $edFeedbacks->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\EdPlaylist object
     *
     * @param \entities\EdPlaylist|ObjectCollection $edPlaylist the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPlaylist($edPlaylist, ?string $comparison = null)
    {
        if ($edPlaylist instanceof \entities\EdPlaylist) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $edPlaylist->getCompanyId(), $comparison);

            return $this;
        } elseif ($edPlaylist instanceof ObjectCollection) {
            $this
                ->useEdPlaylistQuery()
                ->filterByPrimaryKeys($edPlaylist->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdPlaylist() only accepts arguments of type \entities\EdPlaylist or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdPlaylist relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdPlaylist(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdPlaylist');

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
            $this->addJoinObject($join, 'EdPlaylist');
        }

        return $this;
    }

    /**
     * Use the EdPlaylist relation EdPlaylist object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdPlaylistQuery A secondary query class using the current class as primary query
     */
    public function useEdPlaylistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEdPlaylist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdPlaylist', '\entities\EdPlaylistQuery');
    }

    /**
     * Use the EdPlaylist relation EdPlaylist object
     *
     * @param callable(\entities\EdPlaylistQuery):\entities\EdPlaylistQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdPlaylistQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEdPlaylistQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdPlaylist table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdPlaylistQuery The inner query object of the EXISTS statement
     */
    public function useEdPlaylistExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdPlaylistQuery */
        $q = $this->useExistsQuery('EdPlaylist', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdPlaylist table for a NOT EXISTS query.
     *
     * @see useEdPlaylistExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPlaylistQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdPlaylistNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPlaylistQuery */
        $q = $this->useExistsQuery('EdPlaylist', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdPlaylist table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdPlaylistQuery The inner query object of the IN statement
     */
    public function useInEdPlaylistQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdPlaylistQuery */
        $q = $this->useInQuery('EdPlaylist', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdPlaylist table for a NOT IN query.
     *
     * @see useEdPlaylistInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPlaylistQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdPlaylistQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPlaylistQuery */
        $q = $this->useInQuery('EdPlaylist', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\EdPresentations object
     *
     * @param \entities\EdPresentations|ObjectCollection $edPresentations the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEdPresentations($edPresentations, ?string $comparison = null)
    {
        if ($edPresentations instanceof \entities\EdPresentations) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $edPresentations->getCompanyId(), $comparison);

            return $this;
        } elseif ($edPresentations instanceof ObjectCollection) {
            $this
                ->useEdPresentationsQuery()
                ->filterByPrimaryKeys($edPresentations->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEdPresentations() only accepts arguments of type \entities\EdPresentations or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EdPresentations relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEdPresentations(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EdPresentations');

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
            $this->addJoinObject($join, 'EdPresentations');
        }

        return $this;
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EdPresentationsQuery A secondary query class using the current class as primary query
     */
    public function useEdPresentationsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEdPresentations($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EdPresentations', '\entities\EdPresentationsQuery');
    }

    /**
     * Use the EdPresentations relation EdPresentations object
     *
     * @param callable(\entities\EdPresentationsQuery):\entities\EdPresentationsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEdPresentationsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEdPresentationsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EdPresentations table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EdPresentationsQuery The inner query object of the EXISTS statement
     */
    public function useEdPresentationsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT EXISTS query.
     *
     * @see useEdPresentationsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEdPresentationsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useExistsQuery('EdPresentations', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EdPresentationsQuery The inner query object of the IN statement
     */
    public function useInEdPresentationsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EdPresentations table for a NOT IN query.
     *
     * @see useEdPresentationsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EdPresentationsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEdPresentationsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EdPresentationsQuery */
        $q = $this->useInQuery('EdPresentations', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $edSession->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $edStats->getCompanyId(), $comparison);

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
    public function joinEdStats(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useEdStatsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployee($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $employee->getCompanyId(), $comparison);

            return $this;
        } elseif ($employee instanceof ObjectCollection) {
            $this
                ->useEmployeeQuery()
                ->filterByPrimaryKeys($employee->getPrimaryKeys())
                ->endUse();

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $employeeIncentive->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\EventTypes object
     *
     * @param \entities\EventTypes|ObjectCollection $eventTypes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEventTypes($eventTypes, ?string $comparison = null)
    {
        if ($eventTypes instanceof \entities\EventTypes) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $eventTypes->getCompanyId(), $comparison);

            return $this;
        } elseif ($eventTypes instanceof ObjectCollection) {
            $this
                ->useEventTypesQuery()
                ->filterByPrimaryKeys($eventTypes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEventTypes() only accepts arguments of type \entities\EventTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventTypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEventTypes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventTypes');

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
            $this->addJoinObject($join, 'EventTypes');
        }

        return $this;
    }

    /**
     * Use the EventTypes relation EventTypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EventTypesQuery A secondary query class using the current class as primary query
     */
    public function useEventTypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventTypes', '\entities\EventTypesQuery');
    }

    /**
     * Use the EventTypes relation EventTypes object
     *
     * @param callable(\entities\EventTypesQuery):\entities\EventTypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventTypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEventTypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to EventTypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EventTypesQuery The inner query object of the EXISTS statement
     */
    public function useEventTypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useExistsQuery('EventTypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to EventTypes table for a NOT EXISTS query.
     *
     * @see useEventTypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EventTypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventTypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useExistsQuery('EventTypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to EventTypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EventTypesQuery The inner query object of the IN statement
     */
    public function useInEventTypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useInQuery('EventTypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to EventTypes table for a NOT IN query.
     *
     * @see useEventTypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EventTypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventTypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventTypesQuery */
        $q = $this->useInQuery('EventTypes', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByEvents($events, ?string $comparison = null)
    {
        if ($events instanceof \entities\Events) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $events->getCompanyId(), $comparison);

            return $this;
        } elseif ($events instanceof ObjectCollection) {
            $this
                ->useEventsQuery()
                ->filterByPrimaryKeys($events->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEvents() only accepts arguments of type \entities\Events or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Events relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEvents(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Events');

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
            $this->addJoinObject($join, 'Events');
        }

        return $this;
    }

    /**
     * Use the Events relation Events object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EventsQuery A secondary query class using the current class as primary query
     */
    public function useEventsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEvents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Events', '\entities\EventsQuery');
    }

    /**
     * Use the Events relation Events object
     *
     * @param callable(\entities\EventsQuery):\entities\EventsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEventsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEventsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Events table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EventsQuery The inner query object of the EXISTS statement
     */
    public function useEventsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('Events', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Events table for a NOT EXISTS query.
     *
     * @see useEventsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT EXISTS statement
     */
    public function useEventsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useExistsQuery('Events', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Events table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EventsQuery The inner query object of the IN statement
     */
    public function useInEventsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('Events', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Events table for a NOT IN query.
     *
     * @see useEventsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EventsQuery The inner query object of the NOT IN statement
     */
    public function useNotInEventsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EventsQuery */
        $q = $this->useInQuery('Events', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ExpenseList object
     *
     * @param \entities\ExpenseList|ObjectCollection $expenseList the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseList($expenseList, ?string $comparison = null)
    {
        if ($expenseList instanceof \entities\ExpenseList) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $expenseList->getCompanyId(), $comparison);

            return $this;
        } elseif ($expenseList instanceof ObjectCollection) {
            $this
                ->useExpenseListQuery()
                ->filterByPrimaryKeys($expenseList->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseList() only accepts arguments of type \entities\ExpenseList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseList');

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
            $this->addJoinObject($join, 'ExpenseList');
        }

        return $this;
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseListQuery A secondary query class using the current class as primary query
     */
    public function useExpenseListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseList', '\entities\ExpenseListQuery');
    }

    /**
     * Use the ExpenseList relation ExpenseList object
     *
     * @param callable(\entities\ExpenseListQuery):\entities\ExpenseListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ExpenseList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseListQuery The inner query object of the EXISTS statement
     */
    public function useExpenseListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT EXISTS query.
     *
     * @see useExpenseListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useExistsQuery('ExpenseList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseListQuery The inner query object of the IN statement
     */
    public function useInExpenseListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ExpenseList table for a NOT IN query.
     *
     * @see useExpenseListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseListQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseListQuery */
        $q = $this->useInQuery('ExpenseList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ExpenseMaster object
     *
     * @param \entities\ExpenseMaster|ObjectCollection $expenseMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseMasterRelatedByCompanyId($expenseMaster, ?string $comparison = null)
    {
        if ($expenseMaster instanceof \entities\ExpenseMaster) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $expenseMaster->getCompanyId(), $comparison);

            return $this;
        } elseif ($expenseMaster instanceof ObjectCollection) {
            $this
                ->useExpenseMasterRelatedByCompanyIdQuery()
                ->filterByPrimaryKeys($expenseMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByExpenseMasterRelatedByCompanyId() only accepts arguments of type \entities\ExpenseMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseMasterRelatedByCompanyId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinExpenseMasterRelatedByCompanyId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseMasterRelatedByCompanyId');

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
            $this->addJoinObject($join, 'ExpenseMasterRelatedByCompanyId');
        }

        return $this;
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation ExpenseMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ExpenseMasterQuery A secondary query class using the current class as primary query
     */
    public function useExpenseMasterRelatedByCompanyIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseMasterRelatedByCompanyId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseMasterRelatedByCompanyId', '\entities\ExpenseMasterQuery');
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation ExpenseMaster object
     *
     * @param callable(\entities\ExpenseMasterQuery):\entities\ExpenseMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseMasterRelatedByCompanyIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseMasterRelatedByCompanyIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation to the ExpenseMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the EXISTS statement
     */
    public function useExpenseMasterRelatedByCompanyIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMasterRelatedByCompanyId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation to the ExpenseMaster table for a NOT EXISTS query.
     *
     * @see useExpenseMasterRelatedByCompanyIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseMasterRelatedByCompanyIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useExistsQuery('ExpenseMasterRelatedByCompanyId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation to the ExpenseMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the IN statement
     */
    public function useInExpenseMasterRelatedByCompanyIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMasterRelatedByCompanyId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ExpenseMasterRelatedByCompanyId relation to the ExpenseMaster table for a NOT IN query.
     *
     * @see useExpenseMasterRelatedByCompanyIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ExpenseMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInExpenseMasterRelatedByCompanyIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ExpenseMasterQuery */
        $q = $this->useInQuery('ExpenseMasterRelatedByCompanyId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $expensePayments->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $expenses->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\FtpConfigs object
     *
     * @param \entities\FtpConfigs|ObjectCollection $ftpConfigs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpConfigs($ftpConfigs, ?string $comparison = null)
    {
        if ($ftpConfigs instanceof \entities\FtpConfigs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ftpConfigs->getCompanyId(), $comparison);

            return $this;
        } elseif ($ftpConfigs instanceof ObjectCollection) {
            $this
                ->useFtpConfigsQuery()
                ->filterByPrimaryKeys($ftpConfigs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpConfigs() only accepts arguments of type \entities\FtpConfigs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpConfigs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpConfigs(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpConfigs');

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
            $this->addJoinObject($join, 'FtpConfigs');
        }

        return $this;
    }

    /**
     * Use the FtpConfigs relation FtpConfigs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpConfigsQuery A secondary query class using the current class as primary query
     */
    public function useFtpConfigsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFtpConfigs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpConfigs', '\entities\FtpConfigsQuery');
    }

    /**
     * Use the FtpConfigs relation FtpConfigs object
     *
     * @param callable(\entities\FtpConfigsQuery):\entities\FtpConfigsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpConfigsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useFtpConfigsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpConfigs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpConfigsQuery The inner query object of the EXISTS statement
     */
    public function useFtpConfigsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpConfigsQuery */
        $q = $this->useExistsQuery('FtpConfigs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpConfigs table for a NOT EXISTS query.
     *
     * @see useFtpConfigsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpConfigsQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpConfigsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpConfigsQuery */
        $q = $this->useExistsQuery('FtpConfigs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpConfigs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpConfigsQuery The inner query object of the IN statement
     */
    public function useInFtpConfigsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpConfigsQuery */
        $q = $this->useInQuery('FtpConfigs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpConfigs table for a NOT IN query.
     *
     * @see useFtpConfigsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpConfigsQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpConfigsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpConfigsQuery */
        $q = $this->useInQuery('FtpConfigs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\FtpExportBatches object
     *
     * @param \entities\FtpExportBatches|ObjectCollection $ftpExportBatches the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportBatches($ftpExportBatches, ?string $comparison = null)
    {
        if ($ftpExportBatches instanceof \entities\FtpExportBatches) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ftpExportBatches->getCompanyId(), $comparison);

            return $this;
        } elseif ($ftpExportBatches instanceof ObjectCollection) {
            $this
                ->useFtpExportBatchesQuery()
                ->filterByPrimaryKeys($ftpExportBatches->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpExportBatches() only accepts arguments of type \entities\FtpExportBatches or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpExportBatches relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpExportBatches(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpExportBatches');

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
            $this->addJoinObject($join, 'FtpExportBatches');
        }

        return $this;
    }

    /**
     * Use the FtpExportBatches relation FtpExportBatches object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpExportBatchesQuery A secondary query class using the current class as primary query
     */
    public function useFtpExportBatchesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpExportBatches($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpExportBatches', '\entities\FtpExportBatchesQuery');
    }

    /**
     * Use the FtpExportBatches relation FtpExportBatches object
     *
     * @param callable(\entities\FtpExportBatchesQuery):\entities\FtpExportBatchesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpExportBatchesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpExportBatchesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpExportBatches table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the EXISTS statement
     */
    public function useFtpExportBatchesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useExistsQuery('FtpExportBatches', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for a NOT EXISTS query.
     *
     * @see useFtpExportBatchesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpExportBatchesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useExistsQuery('FtpExportBatches', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the IN statement
     */
    public function useInFtpExportBatchesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useInQuery('FtpExportBatches', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpExportBatches table for a NOT IN query.
     *
     * @see useFtpExportBatchesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportBatchesQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpExportBatchesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportBatchesQuery */
        $q = $this->useInQuery('FtpExportBatches', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\FtpExportLogs object
     *
     * @param \entities\FtpExportLogs|ObjectCollection $ftpExportLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpExportLogs($ftpExportLogs, ?string $comparison = null)
    {
        if ($ftpExportLogs instanceof \entities\FtpExportLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ftpExportLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($ftpExportLogs instanceof ObjectCollection) {
            $this
                ->useFtpExportLogsQuery()
                ->filterByPrimaryKeys($ftpExportLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpExportLogs() only accepts arguments of type \entities\FtpExportLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpExportLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpExportLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpExportLogs');

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
            $this->addJoinObject($join, 'FtpExportLogs');
        }

        return $this;
    }

    /**
     * Use the FtpExportLogs relation FtpExportLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpExportLogsQuery A secondary query class using the current class as primary query
     */
    public function useFtpExportLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpExportLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpExportLogs', '\entities\FtpExportLogsQuery');
    }

    /**
     * Use the FtpExportLogs relation FtpExportLogs object
     *
     * @param callable(\entities\FtpExportLogsQuery):\entities\FtpExportLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpExportLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpExportLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpExportLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the EXISTS statement
     */
    public function useFtpExportLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useExistsQuery('FtpExportLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for a NOT EXISTS query.
     *
     * @see useFtpExportLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpExportLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useExistsQuery('FtpExportLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the IN statement
     */
    public function useInFtpExportLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useInQuery('FtpExportLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpExportLogs table for a NOT IN query.
     *
     * @see useFtpExportLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpExportLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpExportLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpExportLogsQuery */
        $q = $this->useInQuery('FtpExportLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\FtpImportBatches object
     *
     * @param \entities\FtpImportBatches|ObjectCollection $ftpImportBatches the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportBatches($ftpImportBatches, ?string $comparison = null)
    {
        if ($ftpImportBatches instanceof \entities\FtpImportBatches) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ftpImportBatches->getCompanyId(), $comparison);

            return $this;
        } elseif ($ftpImportBatches instanceof ObjectCollection) {
            $this
                ->useFtpImportBatchesQuery()
                ->filterByPrimaryKeys($ftpImportBatches->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpImportBatches() only accepts arguments of type \entities\FtpImportBatches or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpImportBatches relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpImportBatches(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpImportBatches');

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
            $this->addJoinObject($join, 'FtpImportBatches');
        }

        return $this;
    }

    /**
     * Use the FtpImportBatches relation FtpImportBatches object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpImportBatchesQuery A secondary query class using the current class as primary query
     */
    public function useFtpImportBatchesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpImportBatches($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpImportBatches', '\entities\FtpImportBatchesQuery');
    }

    /**
     * Use the FtpImportBatches relation FtpImportBatches object
     *
     * @param callable(\entities\FtpImportBatchesQuery):\entities\FtpImportBatchesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpImportBatchesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpImportBatchesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpImportBatches table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the EXISTS statement
     */
    public function useFtpImportBatchesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useExistsQuery('FtpImportBatches', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for a NOT EXISTS query.
     *
     * @see useFtpImportBatchesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpImportBatchesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useExistsQuery('FtpImportBatches', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the IN statement
     */
    public function useInFtpImportBatchesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useInQuery('FtpImportBatches', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpImportBatches table for a NOT IN query.
     *
     * @see useFtpImportBatchesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportBatchesQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpImportBatchesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportBatchesQuery */
        $q = $this->useInQuery('FtpImportBatches', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\FtpImportLogs object
     *
     * @param \entities\FtpImportLogs|ObjectCollection $ftpImportLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFtpImportLogs($ftpImportLogs, ?string $comparison = null)
    {
        if ($ftpImportLogs instanceof \entities\FtpImportLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ftpImportLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($ftpImportLogs instanceof ObjectCollection) {
            $this
                ->useFtpImportLogsQuery()
                ->filterByPrimaryKeys($ftpImportLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByFtpImportLogs() only accepts arguments of type \entities\FtpImportLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FtpImportLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFtpImportLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FtpImportLogs');

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
            $this->addJoinObject($join, 'FtpImportLogs');
        }

        return $this;
    }

    /**
     * Use the FtpImportLogs relation FtpImportLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\FtpImportLogsQuery A secondary query class using the current class as primary query
     */
    public function useFtpImportLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFtpImportLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FtpImportLogs', '\entities\FtpImportLogsQuery');
    }

    /**
     * Use the FtpImportLogs relation FtpImportLogs object
     *
     * @param callable(\entities\FtpImportLogsQuery):\entities\FtpImportLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFtpImportLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFtpImportLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to FtpImportLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the EXISTS statement
     */
    public function useFtpImportLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useExistsQuery('FtpImportLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for a NOT EXISTS query.
     *
     * @see useFtpImportLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useFtpImportLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useExistsQuery('FtpImportLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the IN statement
     */
    public function useInFtpImportLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useInQuery('FtpImportLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to FtpImportLogs table for a NOT IN query.
     *
     * @see useFtpImportLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\FtpImportLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInFtpImportLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\FtpImportLogsQuery */
        $q = $this->useInQuery('FtpImportLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GradeMaster object
     *
     * @param \entities\GradeMaster|ObjectCollection $gradeMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGradeMaster($gradeMaster, ?string $comparison = null)
    {
        if ($gradeMaster instanceof \entities\GradeMaster) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $gradeMaster->getCompanyId(), $comparison);

            return $this;
        } elseif ($gradeMaster instanceof ObjectCollection) {
            $this
                ->useGradeMasterQuery()
                ->filterByPrimaryKeys($gradeMaster->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\Holidays object
     *
     * @param \entities\Holidays|ObjectCollection $holidays the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHolidays($holidays, ?string $comparison = null)
    {
        if ($holidays instanceof \entities\Holidays) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $holidays->getCompanyId(), $comparison);

            return $this;
        } elseif ($holidays instanceof ObjectCollection) {
            $this
                ->useHolidaysQuery()
                ->filterByPrimaryKeys($holidays->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHolidays() only accepts arguments of type \entities\Holidays or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Holidays relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHolidays(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Holidays');

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
            $this->addJoinObject($join, 'Holidays');
        }

        return $this;
    }

    /**
     * Use the Holidays relation Holidays object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\HolidaysQuery A secondary query class using the current class as primary query
     */
    public function useHolidaysQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHolidays($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Holidays', '\entities\HolidaysQuery');
    }

    /**
     * Use the Holidays relation Holidays object
     *
     * @param callable(\entities\HolidaysQuery):\entities\HolidaysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHolidaysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHolidaysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Holidays table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\HolidaysQuery The inner query object of the EXISTS statement
     */
    public function useHolidaysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useExistsQuery('Holidays', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Holidays table for a NOT EXISTS query.
     *
     * @see useHolidaysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\HolidaysQuery The inner query object of the NOT EXISTS statement
     */
    public function useHolidaysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useExistsQuery('Holidays', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Holidays table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\HolidaysQuery The inner query object of the IN statement
     */
    public function useInHolidaysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useInQuery('Holidays', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Holidays table for a NOT IN query.
     *
     * @see useHolidaysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\HolidaysQuery The inner query object of the NOT IN statement
     */
    public function useNotInHolidaysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\HolidaysQuery */
        $q = $this->useInQuery('Holidays', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\IntegrationApiLogs object
     *
     * @param \entities\IntegrationApiLogs|ObjectCollection $integrationApiLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIntegrationApiLogs($integrationApiLogs, ?string $comparison = null)
    {
        if ($integrationApiLogs instanceof \entities\IntegrationApiLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $integrationApiLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($integrationApiLogs instanceof ObjectCollection) {
            $this
                ->useIntegrationApiLogsQuery()
                ->filterByPrimaryKeys($integrationApiLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByIntegrationApiLogs() only accepts arguments of type \entities\IntegrationApiLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IntegrationApiLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinIntegrationApiLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IntegrationApiLogs');

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
            $this->addJoinObject($join, 'IntegrationApiLogs');
        }

        return $this;
    }

    /**
     * Use the IntegrationApiLogs relation IntegrationApiLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\IntegrationApiLogsQuery A secondary query class using the current class as primary query
     */
    public function useIntegrationApiLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinIntegrationApiLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IntegrationApiLogs', '\entities\IntegrationApiLogsQuery');
    }

    /**
     * Use the IntegrationApiLogs relation IntegrationApiLogs object
     *
     * @param callable(\entities\IntegrationApiLogsQuery):\entities\IntegrationApiLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withIntegrationApiLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useIntegrationApiLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to IntegrationApiLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\IntegrationApiLogsQuery The inner query object of the EXISTS statement
     */
    public function useIntegrationApiLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\IntegrationApiLogsQuery */
        $q = $this->useExistsQuery('IntegrationApiLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to IntegrationApiLogs table for a NOT EXISTS query.
     *
     * @see useIntegrationApiLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\IntegrationApiLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useIntegrationApiLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\IntegrationApiLogsQuery */
        $q = $this->useExistsQuery('IntegrationApiLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to IntegrationApiLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\IntegrationApiLogsQuery The inner query object of the IN statement
     */
    public function useInIntegrationApiLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\IntegrationApiLogsQuery */
        $q = $this->useInQuery('IntegrationApiLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to IntegrationApiLogs table for a NOT IN query.
     *
     * @see useIntegrationApiLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\IntegrationApiLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInIntegrationApiLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\IntegrationApiLogsQuery */
        $q = $this->useInQuery('IntegrationApiLogs', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $leaveRequest->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $leaves->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\MaterialFolders object
     *
     * @param \entities\MaterialFolders|ObjectCollection $materialFolders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialFolders($materialFolders, ?string $comparison = null)
    {
        if ($materialFolders instanceof \entities\MaterialFolders) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $materialFolders->getCompanyId(), $comparison);

            return $this;
        } elseif ($materialFolders instanceof ObjectCollection) {
            $this
                ->useMaterialFoldersQuery()
                ->filterByPrimaryKeys($materialFolders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMaterialFolders() only accepts arguments of type \entities\MaterialFolders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MaterialFolders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMaterialFolders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MaterialFolders');

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
            $this->addJoinObject($join, 'MaterialFolders');
        }

        return $this;
    }

    /**
     * Use the MaterialFolders relation MaterialFolders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MaterialFoldersQuery A secondary query class using the current class as primary query
     */
    public function useMaterialFoldersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaterialFolders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MaterialFolders', '\entities\MaterialFoldersQuery');
    }

    /**
     * Use the MaterialFolders relation MaterialFolders object
     *
     * @param callable(\entities\MaterialFoldersQuery):\entities\MaterialFoldersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMaterialFoldersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMaterialFoldersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MaterialFolders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the EXISTS statement
     */
    public function useMaterialFoldersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useExistsQuery('MaterialFolders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for a NOT EXISTS query.
     *
     * @see useMaterialFoldersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the NOT EXISTS statement
     */
    public function useMaterialFoldersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useExistsQuery('MaterialFolders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the IN statement
     */
    public function useInMaterialFoldersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useInQuery('MaterialFolders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MaterialFolders table for a NOT IN query.
     *
     * @see useMaterialFoldersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MaterialFoldersQuery The inner query object of the NOT IN statement
     */
    public function useNotInMaterialFoldersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MaterialFoldersQuery */
        $q = $this->useInQuery('MaterialFolders', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\MediaFiles object
     *
     * @param \entities\MediaFiles|ObjectCollection $mediaFiles the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFiles($mediaFiles, ?string $comparison = null)
    {
        if ($mediaFiles instanceof \entities\MediaFiles) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $mediaFiles->getCompanyId(), $comparison);

            return $this;
        } elseif ($mediaFiles instanceof ObjectCollection) {
            $this
                ->useMediaFilesQuery()
                ->filterByPrimaryKeys($mediaFiles->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMediaFiles() only accepts arguments of type \entities\MediaFiles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFiles relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFiles(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFiles');

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
            $this->addJoinObject($join, 'MediaFiles');
        }

        return $this;
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFilesQuery A secondary query class using the current class as primary query
     */
    public function useMediaFilesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMediaFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFiles', '\entities\MediaFilesQuery');
    }

    /**
     * Use the MediaFiles relation MediaFiles object
     *
     * @param callable(\entities\MediaFilesQuery):\entities\MediaFilesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFilesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMediaFilesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFiles table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFilesQuery The inner query object of the EXISTS statement
     */
    public function useMediaFilesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT EXISTS query.
     *
     * @see useMediaFilesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFilesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useExistsQuery('MediaFiles', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFilesQuery The inner query object of the IN statement
     */
    public function useInMediaFilesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFiles table for a NOT IN query.
     *
     * @see useMediaFilesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFilesQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFilesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFilesQuery */
        $q = $this->useInQuery('MediaFiles', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\MediaFolders object
     *
     * @param \entities\MediaFolders|ObjectCollection $mediaFolders the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMediaFolders($mediaFolders, ?string $comparison = null)
    {
        if ($mediaFolders instanceof \entities\MediaFolders) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $mediaFolders->getCompanyId(), $comparison);

            return $this;
        } elseif ($mediaFolders instanceof ObjectCollection) {
            $this
                ->useMediaFoldersQuery()
                ->filterByPrimaryKeys($mediaFolders->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMediaFolders() only accepts arguments of type \entities\MediaFolders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MediaFolders relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMediaFolders(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MediaFolders');

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
            $this->addJoinObject($join, 'MediaFolders');
        }

        return $this;
    }

    /**
     * Use the MediaFolders relation MediaFolders object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MediaFoldersQuery A secondary query class using the current class as primary query
     */
    public function useMediaFoldersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMediaFolders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MediaFolders', '\entities\MediaFoldersQuery');
    }

    /**
     * Use the MediaFolders relation MediaFolders object
     *
     * @param callable(\entities\MediaFoldersQuery):\entities\MediaFoldersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMediaFoldersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMediaFoldersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MediaFolders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MediaFoldersQuery The inner query object of the EXISTS statement
     */
    public function useMediaFoldersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useExistsQuery('MediaFolders', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for a NOT EXISTS query.
     *
     * @see useMediaFoldersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFoldersQuery The inner query object of the NOT EXISTS statement
     */
    public function useMediaFoldersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useExistsQuery('MediaFolders', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MediaFoldersQuery The inner query object of the IN statement
     */
    public function useInMediaFoldersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useInQuery('MediaFolders', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MediaFolders table for a NOT IN query.
     *
     * @see useMediaFoldersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MediaFoldersQuery The inner query object of the NOT IN statement
     */
    public function useNotInMediaFoldersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MediaFoldersQuery */
        $q = $this->useInQuery('MediaFolders', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $mtp->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\MtpDay object
     *
     * @param \entities\MtpDay|ObjectCollection $mtpDay the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpDay($mtpDay, ?string $comparison = null)
    {
        if ($mtpDay instanceof \entities\MtpDay) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $mtpDay->getCompanyId(), $comparison);

            return $this;
        } elseif ($mtpDay instanceof ObjectCollection) {
            $this
                ->useMtpDayQuery()
                ->filterByPrimaryKeys($mtpDay->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMtpDay() only accepts arguments of type \entities\MtpDay or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MtpDay relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtpDay(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MtpDay');

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
            $this->addJoinObject($join, 'MtpDay');
        }

        return $this;
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpDayQuery A secondary query class using the current class as primary query
     */
    public function useMtpDayQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtpDay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MtpDay', '\entities\MtpDayQuery');
    }

    /**
     * Use the MtpDay relation MtpDay object
     *
     * @param callable(\entities\MtpDayQuery):\entities\MtpDayQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpDayQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpDayQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MtpDay table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpDayQuery The inner query object of the EXISTS statement
     */
    public function useMtpDayExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT EXISTS query.
     *
     * @see useMtpDayExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpDayNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useExistsQuery('MtpDay', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MtpDay table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpDayQuery The inner query object of the IN statement
     */
    public function useInMtpDayQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MtpDay table for a NOT IN query.
     *
     * @see useMtpDayInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpDayQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpDayQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpDayQuery */
        $q = $this->useInQuery('MtpDay', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\MtpLogs object
     *
     * @param \entities\MtpLogs|ObjectCollection $mtpLogs the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMtpLogs($mtpLogs, ?string $comparison = null)
    {
        if ($mtpLogs instanceof \entities\MtpLogs) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $mtpLogs->getCompanyId(), $comparison);

            return $this;
        } elseif ($mtpLogs instanceof ObjectCollection) {
            $this
                ->useMtpLogsQuery()
                ->filterByPrimaryKeys($mtpLogs->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMtpLogs() only accepts arguments of type \entities\MtpLogs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MtpLogs relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMtpLogs(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MtpLogs');

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
            $this->addJoinObject($join, 'MtpLogs');
        }

        return $this;
    }

    /**
     * Use the MtpLogs relation MtpLogs object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\MtpLogsQuery A secondary query class using the current class as primary query
     */
    public function useMtpLogsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMtpLogs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MtpLogs', '\entities\MtpLogsQuery');
    }

    /**
     * Use the MtpLogs relation MtpLogs object
     *
     * @param callable(\entities\MtpLogsQuery):\entities\MtpLogsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMtpLogsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMtpLogsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to MtpLogs table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\MtpLogsQuery The inner query object of the EXISTS statement
     */
    public function useMtpLogsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useExistsQuery('MtpLogs', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for a NOT EXISTS query.
     *
     * @see useMtpLogsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpLogsQuery The inner query object of the NOT EXISTS statement
     */
    public function useMtpLogsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useExistsQuery('MtpLogs', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\MtpLogsQuery The inner query object of the IN statement
     */
    public function useInMtpLogsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useInQuery('MtpLogs', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to MtpLogs table for a NOT IN query.
     *
     * @see useMtpLogsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\MtpLogsQuery The inner query object of the NOT IN statement
     */
    public function useNotInMtpLogsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\MtpLogsQuery */
        $q = $this->useInQuery('MtpLogs', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Offers object
     *
     * @param \entities\Offers|ObjectCollection $offers the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOffers($offers, ?string $comparison = null)
    {
        if ($offers instanceof \entities\Offers) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $offers->getCompanyId(), $comparison);

            return $this;
        } elseif ($offers instanceof ObjectCollection) {
            $this
                ->useOffersQuery()
                ->filterByPrimaryKeys($offers->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOffers() only accepts arguments of type \entities\Offers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Offers relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOffers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Offers');

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
            $this->addJoinObject($join, 'Offers');
        }

        return $this;
    }

    /**
     * Use the Offers relation Offers object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OffersQuery A secondary query class using the current class as primary query
     */
    public function useOffersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOffers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Offers', '\entities\OffersQuery');
    }

    /**
     * Use the Offers relation Offers object
     *
     * @param callable(\entities\OffersQuery):\entities\OffersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOffersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOffersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Offers table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OffersQuery The inner query object of the EXISTS statement
     */
    public function useOffersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT EXISTS query.
     *
     * @see useOffersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOffersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useExistsQuery('Offers', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Offers table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OffersQuery The inner query object of the IN statement
     */
    public function useInOffersQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Offers table for a NOT IN query.
     *
     * @see useOffersInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OffersQuery The inner query object of the NOT IN statement
     */
    public function useNotInOffersQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OffersQuery */
        $q = $this->useInQuery('Offers', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $onBoardRequest->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $onBoardRequestAddress->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\OnBoardRequiredFields object
     *
     * @param \entities\OnBoardRequiredFields|ObjectCollection $onBoardRequiredFields the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequiredFields($onBoardRequiredFields, ?string $comparison = null)
    {
        if ($onBoardRequiredFields instanceof \entities\OnBoardRequiredFields) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $onBoardRequiredFields->getCompanyId(), $comparison);

            return $this;
        } elseif ($onBoardRequiredFields instanceof ObjectCollection) {
            $this
                ->useOnBoardRequiredFieldsQuery()
                ->filterByPrimaryKeys($onBoardRequiredFields->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequiredFields() only accepts arguments of type \entities\OnBoardRequiredFields or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequiredFields relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequiredFields(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequiredFields');

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
            $this->addJoinObject($join, 'OnBoardRequiredFields');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequiredFields relation OnBoardRequiredFields object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequiredFieldsQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequiredFieldsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequiredFields($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequiredFields', '\entities\OnBoardRequiredFieldsQuery');
    }

    /**
     * Use the OnBoardRequiredFields relation OnBoardRequiredFields object
     *
     * @param callable(\entities\OnBoardRequiredFieldsQuery):\entities\OnBoardRequiredFieldsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequiredFieldsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequiredFieldsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequiredFieldsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useExistsQuery('OnBoardRequiredFields', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for a NOT EXISTS query.
     *
     * @see useOnBoardRequiredFieldsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequiredFieldsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useExistsQuery('OnBoardRequiredFields', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequiredFieldsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useInQuery('OnBoardRequiredFields', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequiredFields table for a NOT IN query.
     *
     * @see useOnBoardRequiredFieldsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequiredFieldsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequiredFieldsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequiredFieldsQuery */
        $q = $this->useInQuery('OnBoardRequiredFields', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OrderLog object
     *
     * @param \entities\OrderLog|ObjectCollection $orderLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderLog($orderLog, ?string $comparison = null)
    {
        if ($orderLog instanceof \entities\OrderLog) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $orderLog->getCompanyId(), $comparison);

            return $this;
        } elseif ($orderLog instanceof ObjectCollection) {
            $this
                ->useOrderLogQuery()
                ->filterByPrimaryKeys($orderLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderLog() only accepts arguments of type \entities\OrderLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderLog');

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
            $this->addJoinObject($join, 'OrderLog');
        }

        return $this;
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OrderLogQuery A secondary query class using the current class as primary query
     */
    public function useOrderLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderLog', '\entities\OrderLogQuery');
    }

    /**
     * Use the OrderLog relation OrderLog object
     *
     * @param callable(\entities\OrderLogQuery):\entities\OrderLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrderLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OrderLogQuery The inner query object of the EXISTS statement
     */
    public function useOrderLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT EXISTS query.
     *
     * @see useOrderLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useExistsQuery('OrderLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrderLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OrderLogQuery The inner query object of the IN statement
     */
    public function useInOrderLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrderLog table for a NOT IN query.
     *
     * @see useOrderLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OrderLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInOrderLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OrderLogQuery */
        $q = $this->useInQuery('OrderLog', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $orderlines->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $orders->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\OrgUnit object
     *
     * @param \entities\OrgUnit|ObjectCollection $orgUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnit($orgUnit, ?string $comparison = null)
    {
        if ($orgUnit instanceof \entities\OrgUnit) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $orgUnit->getCompanyId(), $comparison);

            return $this;
        } elseif ($orgUnit instanceof ObjectCollection) {
            $this
                ->useOrgUnitQuery()
                ->filterByPrimaryKeys($orgUnit->getPrimaryKeys())
                ->endUse();

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $otpRequests->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletAddress->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletOrgData->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletOrgNotes->getCompanyId(), $comparison);

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
    public function joinOutletOrgNotes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletOrgNotesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\OutletOutcomes object
     *
     * @param \entities\OutletOutcomes|ObjectCollection $outletOutcomes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOutcomes($outletOutcomes, ?string $comparison = null)
    {
        if ($outletOutcomes instanceof \entities\OutletOutcomes) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletOutcomes->getCompanyId(), $comparison);

            return $this;
        } elseif ($outletOutcomes instanceof ObjectCollection) {
            $this
                ->useOutletOutcomesQuery()
                ->filterByPrimaryKeys($outletOutcomes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletOutcomes() only accepts arguments of type \entities\OutletOutcomes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletOutcomes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletOutcomes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletOutcomes');

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
            $this->addJoinObject($join, 'OutletOutcomes');
        }

        return $this;
    }

    /**
     * Use the OutletOutcomes relation OutletOutcomes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletOutcomesQuery A secondary query class using the current class as primary query
     */
    public function useOutletOutcomesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletOutcomes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletOutcomes', '\entities\OutletOutcomesQuery');
    }

    /**
     * Use the OutletOutcomes relation OutletOutcomes object
     *
     * @param callable(\entities\OutletOutcomesQuery):\entities\OutletOutcomesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletOutcomesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletOutcomesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletOutcomes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the EXISTS statement
     */
    public function useOutletOutcomesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useExistsQuery('OutletOutcomes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for a NOT EXISTS query.
     *
     * @see useOutletOutcomesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletOutcomesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useExistsQuery('OutletOutcomes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the IN statement
     */
    public function useInOutletOutcomesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useInQuery('OutletOutcomes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletOutcomes table for a NOT IN query.
     *
     * @see useOutletOutcomesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletOutcomesQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletOutcomesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletOutcomesQuery */
        $q = $this->useInQuery('OutletOutcomes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletStock->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletStockOtherSummary->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletStockSummary->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\OutletTags object
     *
     * @param \entities\OutletTags|ObjectCollection $outletTags the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTags($outletTags, ?string $comparison = null)
    {
        if ($outletTags instanceof \entities\OutletTags) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletTags->getCompanyId(), $comparison);

            return $this;
        } elseif ($outletTags instanceof ObjectCollection) {
            $this
                ->useOutletTagsQuery()
                ->filterByPrimaryKeys($outletTags->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOutletTags() only accepts arguments of type \entities\OutletTags or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OutletTags relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOutletTags(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OutletTags');

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
            $this->addJoinObject($join, 'OutletTags');
        }

        return $this;
    }

    /**
     * Use the OutletTags relation OutletTags object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OutletTagsQuery A secondary query class using the current class as primary query
     */
    public function useOutletTagsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOutletTags($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OutletTags', '\entities\OutletTagsQuery');
    }

    /**
     * Use the OutletTags relation OutletTags object
     *
     * @param callable(\entities\OutletTagsQuery):\entities\OutletTagsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOutletTagsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOutletTagsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OutletTags table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OutletTagsQuery The inner query object of the EXISTS statement
     */
    public function useOutletTagsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OutletTagsQuery */
        $q = $this->useExistsQuery('OutletTags', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OutletTags table for a NOT EXISTS query.
     *
     * @see useOutletTagsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTagsQuery The inner query object of the NOT EXISTS statement
     */
    public function useOutletTagsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTagsQuery */
        $q = $this->useExistsQuery('OutletTags', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OutletTags table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OutletTagsQuery The inner query object of the IN statement
     */
    public function useInOutletTagsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OutletTagsQuery */
        $q = $this->useInQuery('OutletTags', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OutletTags table for a NOT IN query.
     *
     * @see useOutletTagsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OutletTagsQuery The inner query object of the NOT IN statement
     */
    public function useNotInOutletTagsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OutletTagsQuery */
        $q = $this->useInQuery('OutletTags', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletType->getCompanyId(), $comparison);

            return $this;
        } elseif ($outletType instanceof ObjectCollection) {
            $this
                ->useOutletTypeQuery()
                ->filterByPrimaryKeys($outletType->getPrimaryKeys())
                ->endUse();

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
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outlets->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\PolicyMaster object
     *
     * @param \entities\PolicyMaster|ObjectCollection $policyMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicyMaster($policyMaster, ?string $comparison = null)
    {
        if ($policyMaster instanceof \entities\PolicyMaster) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $policyMaster->getCompanyId(), $comparison);

            return $this;
        } elseif ($policyMaster instanceof ObjectCollection) {
            $this
                ->usePolicyMasterQuery()
                ->filterByPrimaryKeys($policyMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPolicyMaster() only accepts arguments of type \entities\PolicyMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PolicyMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPolicyMaster(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PolicyMaster');

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
            $this->addJoinObject($join, 'PolicyMaster');
        }

        return $this;
    }

    /**
     * Use the PolicyMaster relation PolicyMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PolicyMasterQuery A secondary query class using the current class as primary query
     */
    public function usePolicyMasterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPolicyMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PolicyMaster', '\entities\PolicyMasterQuery');
    }

    /**
     * Use the PolicyMaster relation PolicyMaster object
     *
     * @param callable(\entities\PolicyMasterQuery):\entities\PolicyMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPolicyMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePolicyMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PolicyMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PolicyMasterQuery The inner query object of the EXISTS statement
     */
    public function usePolicyMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useExistsQuery('PolicyMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for a NOT EXISTS query.
     *
     * @see usePolicyMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function usePolicyMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useExistsQuery('PolicyMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PolicyMasterQuery The inner query object of the IN statement
     */
    public function useInPolicyMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useInQuery('PolicyMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PolicyMaster table for a NOT IN query.
     *
     * @see usePolicyMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicyMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInPolicyMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicyMasterQuery */
        $q = $this->useInQuery('PolicyMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Policykeys object
     *
     * @param \entities\Policykeys|ObjectCollection $policykeys the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPolicykeys($policykeys, ?string $comparison = null)
    {
        if ($policykeys instanceof \entities\Policykeys) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $policykeys->getCompanyId(), $comparison);

            return $this;
        } elseif ($policykeys instanceof ObjectCollection) {
            $this
                ->usePolicykeysQuery()
                ->filterByPrimaryKeys($policykeys->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPolicykeys() only accepts arguments of type \entities\Policykeys or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Policykeys relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPolicykeys(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Policykeys');

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
            $this->addJoinObject($join, 'Policykeys');
        }

        return $this;
    }

    /**
     * Use the Policykeys relation Policykeys object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PolicykeysQuery A secondary query class using the current class as primary query
     */
    public function usePolicykeysQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPolicykeys($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Policykeys', '\entities\PolicykeysQuery');
    }

    /**
     * Use the Policykeys relation Policykeys object
     *
     * @param callable(\entities\PolicykeysQuery):\entities\PolicykeysQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPolicykeysQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePolicykeysQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Policykeys table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PolicykeysQuery The inner query object of the EXISTS statement
     */
    public function usePolicykeysExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PolicykeysQuery */
        $q = $this->useExistsQuery('Policykeys', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Policykeys table for a NOT EXISTS query.
     *
     * @see usePolicykeysExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicykeysQuery The inner query object of the NOT EXISTS statement
     */
    public function usePolicykeysNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicykeysQuery */
        $q = $this->useExistsQuery('Policykeys', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Policykeys table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PolicykeysQuery The inner query object of the IN statement
     */
    public function useInPolicykeysQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PolicykeysQuery */
        $q = $this->useInQuery('Policykeys', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Policykeys table for a NOT IN query.
     *
     * @see usePolicykeysInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PolicykeysQuery The inner query object of the NOT IN statement
     */
    public function useNotInPolicykeysQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PolicykeysQuery */
        $q = $this->useInQuery('Policykeys', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositions($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $positions->getCompanyId(), $comparison);

            return $this;
        } elseif ($positions instanceof ObjectCollection) {
            $this
                ->usePositionsQuery()
                ->filterByPrimaryKeys($positions->getPrimaryKeys())
                ->endUse();

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
    public function joinPositions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function usePositionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $pricebooklines->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\Pricebooks object
     *
     * @param \entities\Pricebooks|ObjectCollection $pricebooks the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPricebooks($pricebooks, ?string $comparison = null)
    {
        if ($pricebooks instanceof \entities\Pricebooks) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $pricebooks->getCompanyId(), $comparison);

            return $this;
        } elseif ($pricebooks instanceof ObjectCollection) {
            $this
                ->usePricebooksQuery()
                ->filterByPrimaryKeys($pricebooks->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPricebooks() only accepts arguments of type \entities\Pricebooks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pricebooks relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPricebooks(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pricebooks');

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
            $this->addJoinObject($join, 'Pricebooks');
        }

        return $this;
    }

    /**
     * Use the Pricebooks relation Pricebooks object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PricebooksQuery A secondary query class using the current class as primary query
     */
    public function usePricebooksQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPricebooks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pricebooks', '\entities\PricebooksQuery');
    }

    /**
     * Use the Pricebooks relation Pricebooks object
     *
     * @param callable(\entities\PricebooksQuery):\entities\PricebooksQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPricebooksQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePricebooksQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pricebooks table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PricebooksQuery The inner query object of the EXISTS statement
     */
    public function usePricebooksExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useExistsQuery('Pricebooks', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for a NOT EXISTS query.
     *
     * @see usePricebooksExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooksQuery The inner query object of the NOT EXISTS statement
     */
    public function usePricebooksNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useExistsQuery('Pricebooks', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PricebooksQuery The inner query object of the IN statement
     */
    public function useInPricebooksQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useInQuery('Pricebooks', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pricebooks table for a NOT IN query.
     *
     * @see usePricebooksInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PricebooksQuery The inner query object of the NOT IN statement
     */
    public function useNotInPricebooksQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PricebooksQuery */
        $q = $this->useInQuery('Pricebooks', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Products object
     *
     * @param \entities\Products|ObjectCollection $products the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducts($products, ?string $comparison = null)
    {
        if ($products instanceof \entities\Products) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $products->getCompanyId(), $comparison);

            return $this;
        } elseif ($products instanceof ObjectCollection) {
            $this
                ->useProductsQuery()
                ->filterByPrimaryKeys($products->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProducts() only accepts arguments of type \entities\Products or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Products relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Products');

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
            $this->addJoinObject($join, 'Products');
        }

        return $this;
    }

    /**
     * Use the Products relation Products object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ProductsQuery A secondary query class using the current class as primary query
     */
    public function useProductsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Products', '\entities\ProductsQuery');
    }

    /**
     * Use the Products relation Products object
     *
     * @param callable(\entities\ProductsQuery):\entities\ProductsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Products table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ProductsQuery The inner query object of the EXISTS statement
     */
    public function useProductsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT EXISTS query.
     *
     * @see useProductsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useExistsQuery('Products', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Products table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ProductsQuery The inner query object of the IN statement
     */
    public function useInProductsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Products table for a NOT IN query.
     *
     * @see useProductsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ProductsQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ProductsQuery */
        $q = $this->useInQuery('Products', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $reminders->getCompanyId(), $comparison);

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
    public function joinReminders(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useRemindersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\SgpiAccounts object
     *
     * @param \entities\SgpiAccounts|ObjectCollection $sgpiAccounts the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiAccounts($sgpiAccounts, ?string $comparison = null)
    {
        if ($sgpiAccounts instanceof \entities\SgpiAccounts) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $sgpiAccounts->getCompanyId(), $comparison);

            return $this;
        } elseif ($sgpiAccounts instanceof ObjectCollection) {
            $this
                ->useSgpiAccountsQuery()
                ->filterByPrimaryKeys($sgpiAccounts->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiAccounts() only accepts arguments of type \entities\SgpiAccounts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiAccounts relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiAccounts(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiAccounts');

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
            $this->addJoinObject($join, 'SgpiAccounts');
        }

        return $this;
    }

    /**
     * Use the SgpiAccounts relation SgpiAccounts object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiAccountsQuery A secondary query class using the current class as primary query
     */
    public function useSgpiAccountsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSgpiAccounts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiAccounts', '\entities\SgpiAccountsQuery');
    }

    /**
     * Use the SgpiAccounts relation SgpiAccounts object
     *
     * @param callable(\entities\SgpiAccountsQuery):\entities\SgpiAccountsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiAccountsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSgpiAccountsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiAccounts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the EXISTS statement
     */
    public function useSgpiAccountsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useExistsQuery('SgpiAccounts', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for a NOT EXISTS query.
     *
     * @see useSgpiAccountsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiAccountsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useExistsQuery('SgpiAccounts', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the IN statement
     */
    public function useInSgpiAccountsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useInQuery('SgpiAccounts', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiAccounts table for a NOT IN query.
     *
     * @see useSgpiAccountsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiAccountsQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiAccountsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiAccountsQuery */
        $q = $this->useInQuery('SgpiAccounts', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SgpiMaster object
     *
     * @param \entities\SgpiMaster|ObjectCollection $sgpiMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiMaster($sgpiMaster, ?string $comparison = null)
    {
        if ($sgpiMaster instanceof \entities\SgpiMaster) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $sgpiMaster->getCompanyId(), $comparison);

            return $this;
        } elseif ($sgpiMaster instanceof ObjectCollection) {
            $this
                ->useSgpiMasterQuery()
                ->filterByPrimaryKeys($sgpiMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiMaster() only accepts arguments of type \entities\SgpiMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiMaster relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiMaster(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiMaster');

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
            $this->addJoinObject($join, 'SgpiMaster');
        }

        return $this;
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiMasterQuery A secondary query class using the current class as primary query
     */
    public function useSgpiMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiMaster', '\entities\SgpiMasterQuery');
    }

    /**
     * Use the SgpiMaster relation SgpiMaster object
     *
     * @param callable(\entities\SgpiMasterQuery):\entities\SgpiMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiMasterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiMasterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiMasterQuery The inner query object of the EXISTS statement
     */
    public function useSgpiMasterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT EXISTS query.
     *
     * @see useSgpiMasterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiMasterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useExistsQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiMasterQuery The inner query object of the IN statement
     */
    public function useInSgpiMasterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiMaster table for a NOT IN query.
     *
     * @see useSgpiMasterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiMasterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiMasterQuery */
        $q = $this->useInQuery('SgpiMaster', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SgpiTrans object
     *
     * @param \entities\SgpiTrans|ObjectCollection $sgpiTrans the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiTrans($sgpiTrans, ?string $comparison = null)
    {
        if ($sgpiTrans instanceof \entities\SgpiTrans) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $sgpiTrans->getCompanyId(), $comparison);

            return $this;
        } elseif ($sgpiTrans instanceof ObjectCollection) {
            $this
                ->useSgpiTransQuery()
                ->filterByPrimaryKeys($sgpiTrans->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySgpiTrans() only accepts arguments of type \entities\SgpiTrans or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SgpiTrans relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSgpiTrans(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SgpiTrans');

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
            $this->addJoinObject($join, 'SgpiTrans');
        }

        return $this;
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SgpiTransQuery A secondary query class using the current class as primary query
     */
    public function useSgpiTransQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSgpiTrans($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SgpiTrans', '\entities\SgpiTransQuery');
    }

    /**
     * Use the SgpiTrans relation SgpiTrans object
     *
     * @param callable(\entities\SgpiTransQuery):\entities\SgpiTransQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSgpiTransQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSgpiTransQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SgpiTrans table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SgpiTransQuery The inner query object of the EXISTS statement
     */
    public function useSgpiTransExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT EXISTS query.
     *
     * @see useSgpiTransExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT EXISTS statement
     */
    public function useSgpiTransNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useExistsQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SgpiTransQuery The inner query object of the IN statement
     */
    public function useInSgpiTransQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SgpiTrans table for a NOT IN query.
     *
     * @see useSgpiTransInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SgpiTransQuery The inner query object of the NOT IN statement
     */
    public function useNotInSgpiTransQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SgpiTransQuery */
        $q = $this->useInQuery('SgpiTrans', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\ShiftTypes object
     *
     * @param \entities\ShiftTypes|ObjectCollection $shiftTypes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShiftTypes($shiftTypes, ?string $comparison = null)
    {
        if ($shiftTypes instanceof \entities\ShiftTypes) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $shiftTypes->getCompanyId(), $comparison);

            return $this;
        } elseif ($shiftTypes instanceof ObjectCollection) {
            $this
                ->useShiftTypesQuery()
                ->filterByPrimaryKeys($shiftTypes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShiftTypes() only accepts arguments of type \entities\ShiftTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ShiftTypes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShiftTypes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ShiftTypes');

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
            $this->addJoinObject($join, 'ShiftTypes');
        }

        return $this;
    }

    /**
     * Use the ShiftTypes relation ShiftTypes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShiftTypesQuery A secondary query class using the current class as primary query
     */
    public function useShiftTypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShiftTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ShiftTypes', '\entities\ShiftTypesQuery');
    }

    /**
     * Use the ShiftTypes relation ShiftTypes object
     *
     * @param callable(\entities\ShiftTypesQuery):\entities\ShiftTypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShiftTypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShiftTypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to ShiftTypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShiftTypesQuery The inner query object of the EXISTS statement
     */
    public function useShiftTypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShiftTypesQuery */
        $q = $this->useExistsQuery('ShiftTypes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to ShiftTypes table for a NOT EXISTS query.
     *
     * @see useShiftTypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShiftTypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useShiftTypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShiftTypesQuery */
        $q = $this->useExistsQuery('ShiftTypes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to ShiftTypes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShiftTypesQuery The inner query object of the IN statement
     */
    public function useInShiftTypesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShiftTypesQuery */
        $q = $this->useInQuery('ShiftTypes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to ShiftTypes table for a NOT IN query.
     *
     * @see useShiftTypesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShiftTypesQuery The inner query object of the NOT IN statement
     */
    public function useNotInShiftTypesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShiftTypesQuery */
        $q = $this->useInQuery('ShiftTypes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $shippinglines->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\Shippingorder object
     *
     * @param \entities\Shippingorder|ObjectCollection $shippingorder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByShippingorder($shippingorder, ?string $comparison = null)
    {
        if ($shippingorder instanceof \entities\Shippingorder) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $shippingorder->getCompanyId(), $comparison);

            return $this;
        } elseif ($shippingorder instanceof ObjectCollection) {
            $this
                ->useShippingorderQuery()
                ->filterByPrimaryKeys($shippingorder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByShippingorder() only accepts arguments of type \entities\Shippingorder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Shippingorder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinShippingorder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Shippingorder');

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
            $this->addJoinObject($join, 'Shippingorder');
        }

        return $this;
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\ShippingorderQuery A secondary query class using the current class as primary query
     */
    public function useShippingorderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinShippingorder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Shippingorder', '\entities\ShippingorderQuery');
    }

    /**
     * Use the Shippingorder relation Shippingorder object
     *
     * @param callable(\entities\ShippingorderQuery):\entities\ShippingorderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withShippingorderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useShippingorderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Shippingorder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\ShippingorderQuery The inner query object of the EXISTS statement
     */
    public function useShippingorderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT EXISTS query.
     *
     * @see useShippingorderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT EXISTS statement
     */
    public function useShippingorderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useExistsQuery('Shippingorder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\ShippingorderQuery The inner query object of the IN statement
     */
    public function useInShippingorderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Shippingorder table for a NOT IN query.
     *
     * @see useShippingorderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\ShippingorderQuery The inner query object of the NOT IN statement
     */
    public function useNotInShippingorderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\ShippingorderQuery */
        $q = $this->useInQuery('Shippingorder', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $stockTransaction->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\StockVoucher object
     *
     * @param \entities\StockVoucher|ObjectCollection $stockVoucher the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockVoucher($stockVoucher, ?string $comparison = null)
    {
        if ($stockVoucher instanceof \entities\StockVoucher) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $stockVoucher->getCompanyId(), $comparison);

            return $this;
        } elseif ($stockVoucher instanceof ObjectCollection) {
            $this
                ->useStockVoucherQuery()
                ->filterByPrimaryKeys($stockVoucher->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockVoucher() only accepts arguments of type \entities\StockVoucher or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockVoucher relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockVoucher(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockVoucher');

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
            $this->addJoinObject($join, 'StockVoucher');
        }

        return $this;
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StockVoucherQuery A secondary query class using the current class as primary query
     */
    public function useStockVoucherQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockVoucher($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockVoucher', '\entities\StockVoucherQuery');
    }

    /**
     * Use the StockVoucher relation StockVoucher object
     *
     * @param callable(\entities\StockVoucherQuery):\entities\StockVoucherQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockVoucherQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockVoucherQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StockVoucher table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StockVoucherQuery The inner query object of the EXISTS statement
     */
    public function useStockVoucherExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT EXISTS query.
     *
     * @see useStockVoucherExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockVoucherNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useExistsQuery('StockVoucher', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StockVoucherQuery The inner query object of the IN statement
     */
    public function useInStockVoucherQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StockVoucher table for a NOT IN query.
     *
     * @see useStockVoucherInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StockVoucherQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockVoucherQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StockVoucherQuery */
        $q = $this->useInQuery('StockVoucher', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Survey object
     *
     * @param \entities\Survey|ObjectCollection $survey the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurvey($survey, ?string $comparison = null)
    {
        if ($survey instanceof \entities\Survey) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $survey->getCompanyId(), $comparison);

            return $this;
        } elseif ($survey instanceof ObjectCollection) {
            $this
                ->useSurveyQuery()
                ->filterByPrimaryKeys($survey->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \entities\SurveyCategory object
     *
     * @param \entities\SurveyCategory|ObjectCollection $surveyCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyCategory($surveyCategory, ?string $comparison = null)
    {
        if ($surveyCategory instanceof \entities\SurveyCategory) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $surveyCategory->getCompanyId(), $comparison);

            return $this;
        } elseif ($surveyCategory instanceof ObjectCollection) {
            $this
                ->useSurveyCategoryQuery()
                ->filterByPrimaryKeys($surveyCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveyCategory() only accepts arguments of type \entities\SurveyCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveyCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveyCategory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveyCategory');

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
            $this->addJoinObject($join, 'SurveyCategory');
        }

        return $this;
    }

    /**
     * Use the SurveyCategory relation SurveyCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSurveyCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveyCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveyCategory', '\entities\SurveyCategoryQuery');
    }

    /**
     * Use the SurveyCategory relation SurveyCategory object
     *
     * @param callable(\entities\SurveyCategoryQuery):\entities\SurveyCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveyCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSurveyCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useExistsQuery('SurveyCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for a NOT EXISTS query.
     *
     * @see useSurveyCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useExistsQuery('SurveyCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the IN statement
     */
    public function useInSurveyCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useInQuery('SurveyCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveyCategory table for a NOT IN query.
     *
     * @see useSurveyCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyCategoryQuery */
        $q = $this->useInQuery('SurveyCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SurveyQuestion object
     *
     * @param \entities\SurveyQuestion|ObjectCollection $surveyQuestion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurveyQuestion($surveyQuestion, ?string $comparison = null)
    {
        if ($surveyQuestion instanceof \entities\SurveyQuestion) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $surveyQuestion->getCompanyId(), $comparison);

            return $this;
        } elseif ($surveyQuestion instanceof ObjectCollection) {
            $this
                ->useSurveyQuestionQuery()
                ->filterByPrimaryKeys($surveyQuestion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySurveyQuestion() only accepts arguments of type \entities\SurveyQuestion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SurveyQuestion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSurveyQuestion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SurveyQuestion');

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
            $this->addJoinObject($join, 'SurveyQuestion');
        }

        return $this;
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SurveyQuestionQuery A secondary query class using the current class as primary query
     */
    public function useSurveyQuestionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSurveyQuestion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SurveyQuestion', '\entities\SurveyQuestionQuery');
    }

    /**
     * Use the SurveyQuestion relation SurveyQuestion object
     *
     * @param callable(\entities\SurveyQuestionQuery):\entities\SurveyQuestionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSurveyQuestionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSurveyQuestionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SurveyQuestion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the EXISTS statement
     */
    public function useSurveyQuestionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT EXISTS query.
     *
     * @see useSurveyQuestionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSurveyQuestionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useExistsQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the IN statement
     */
    public function useInSurveyQuestionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SurveyQuestion table for a NOT IN query.
     *
     * @see useSurveyQuestionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SurveyQuestionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSurveyQuestionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SurveyQuestionQuery */
        $q = $this->useInQuery('SurveyQuestion', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $surveySubmited->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\TaConfiguration object
     *
     * @param \entities\TaConfiguration|ObjectCollection $taConfiguration the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaConfiguration($taConfiguration, ?string $comparison = null)
    {
        if ($taConfiguration instanceof \entities\TaConfiguration) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $taConfiguration->getCompanyId(), $comparison);

            return $this;
        } elseif ($taConfiguration instanceof ObjectCollection) {
            $this
                ->useTaConfigurationQuery()
                ->filterByPrimaryKeys($taConfiguration->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTaConfiguration() only accepts arguments of type \entities\TaConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TaConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTaConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TaConfiguration');

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
            $this->addJoinObject($join, 'TaConfiguration');
        }

        return $this;
    }

    /**
     * Use the TaConfiguration relation TaConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TaConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useTaConfigurationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTaConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TaConfiguration', '\entities\TaConfigurationQuery');
    }

    /**
     * Use the TaConfiguration relation TaConfiguration object
     *
     * @param callable(\entities\TaConfigurationQuery):\entities\TaConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTaConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTaConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to TaConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TaConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useTaConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TaConfigurationQuery */
        $q = $this->useExistsQuery('TaConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to TaConfiguration table for a NOT EXISTS query.
     *
     * @see useTaConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TaConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useTaConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TaConfigurationQuery */
        $q = $this->useExistsQuery('TaConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to TaConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TaConfigurationQuery The inner query object of the IN statement
     */
    public function useInTaConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TaConfigurationQuery */
        $q = $this->useInQuery('TaConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to TaConfiguration table for a NOT IN query.
     *
     * @see useTaConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TaConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInTaConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TaConfigurationQuery */
        $q = $this->useInQuery('TaConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Tags object
     *
     * @param \entities\Tags|ObjectCollection $tags the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags, ?string $comparison = null)
    {
        if ($tags instanceof \entities\Tags) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $tags->getCompanyId(), $comparison);

            return $this;
        } elseif ($tags instanceof ObjectCollection) {
            $this
                ->useTagsQuery()
                ->filterByPrimaryKeys($tags->getPrimaryKeys())
                ->endUse();

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
    public function joinTags(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useTagsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $territories->getCompanyId(), $comparison);

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
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \entities\TerritoryTowns object
     *
     * @param \entities\TerritoryTowns|ObjectCollection $territoryTowns the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryTowns($territoryTowns, ?string $comparison = null)
    {
        if ($territoryTowns instanceof \entities\TerritoryTowns) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $territoryTowns->getCompanyId(), $comparison);

            return $this;
        } elseif ($territoryTowns instanceof ObjectCollection) {
            $this
                ->useTerritoryTownsQuery()
                ->filterByPrimaryKeys($territoryTowns->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTerritoryTowns() only accepts arguments of type \entities\TerritoryTowns or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TerritoryTowns relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTerritoryTowns(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TerritoryTowns');

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
            $this->addJoinObject($join, 'TerritoryTowns');
        }

        return $this;
    }

    /**
     * Use the TerritoryTowns relation TerritoryTowns object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TerritoryTownsQuery A secondary query class using the current class as primary query
     */
    public function useTerritoryTownsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTerritoryTowns($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TerritoryTowns', '\entities\TerritoryTownsQuery');
    }

    /**
     * Use the TerritoryTowns relation TerritoryTowns object
     *
     * @param callable(\entities\TerritoryTownsQuery):\entities\TerritoryTownsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTerritoryTownsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTerritoryTownsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to TerritoryTowns table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the EXISTS statement
     */
    public function useTerritoryTownsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useExistsQuery('TerritoryTowns', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for a NOT EXISTS query.
     *
     * @see useTerritoryTownsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTerritoryTownsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useExistsQuery('TerritoryTowns', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the IN statement
     */
    public function useInTerritoryTownsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useInQuery('TerritoryTowns', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to TerritoryTowns table for a NOT IN query.
     *
     * @see useTerritoryTownsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TerritoryTownsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTerritoryTownsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TerritoryTownsQuery */
        $q = $this->useInQuery('TerritoryTowns', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ticketReplies->getCompanyId(), $comparison);

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
    public function joinTicketReplies(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useTicketRepliesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $ticketType->getCompanyId(), $comparison);

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
    public function joinTicketType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useTicketTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
    public function filterByTickets($tickets, ?string $comparison = null)
    {
        if ($tickets instanceof \entities\Tickets) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $tickets->getCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $tourplans->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\Transactions object
     *
     * @param \entities\Transactions|ObjectCollection $transactions the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTransactions($transactions, ?string $comparison = null)
    {
        if ($transactions instanceof \entities\Transactions) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $transactions->getCompanyId(), $comparison);

            return $this;
        } elseif ($transactions instanceof ObjectCollection) {
            $this
                ->useTransactionsQuery()
                ->filterByPrimaryKeys($transactions->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTransactions() only accepts arguments of type \entities\Transactions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Transactions relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTransactions(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Transactions');

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
            $this->addJoinObject($join, 'Transactions');
        }

        return $this;
    }

    /**
     * Use the Transactions relation Transactions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\TransactionsQuery A secondary query class using the current class as primary query
     */
    public function useTransactionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransactions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Transactions', '\entities\TransactionsQuery');
    }

    /**
     * Use the Transactions relation Transactions object
     *
     * @param callable(\entities\TransactionsQuery):\entities\TransactionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTransactionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTransactionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Transactions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\TransactionsQuery The inner query object of the EXISTS statement
     */
    public function useTransactionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('Transactions', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Transactions table for a NOT EXISTS query.
     *
     * @see useTransactionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useTransactionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useExistsQuery('Transactions', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Transactions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\TransactionsQuery The inner query object of the IN statement
     */
    public function useInTransactionsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('Transactions', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Transactions table for a NOT IN query.
     *
     * @see useTransactionsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\TransactionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInTransactionsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\TransactionsQuery */
        $q = $this->useInQuery('Transactions', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $users->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\WdbSyncLog object
     *
     * @param \entities\WdbSyncLog|ObjectCollection $wdbSyncLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWdbSyncLog($wdbSyncLog, ?string $comparison = null)
    {
        if ($wdbSyncLog instanceof \entities\WdbSyncLog) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $wdbSyncLog->getCompanyId(), $comparison);

            return $this;
        } elseif ($wdbSyncLog instanceof ObjectCollection) {
            $this
                ->useWdbSyncLogQuery()
                ->filterByPrimaryKeys($wdbSyncLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWdbSyncLog() only accepts arguments of type \entities\WdbSyncLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WdbSyncLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWdbSyncLog(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WdbSyncLog');

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
            $this->addJoinObject($join, 'WdbSyncLog');
        }

        return $this;
    }

    /**
     * Use the WdbSyncLog relation WdbSyncLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\WdbSyncLogQuery A secondary query class using the current class as primary query
     */
    public function useWdbSyncLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWdbSyncLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WdbSyncLog', '\entities\WdbSyncLogQuery');
    }

    /**
     * Use the WdbSyncLog relation WdbSyncLog object
     *
     * @param callable(\entities\WdbSyncLogQuery):\entities\WdbSyncLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWdbSyncLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWdbSyncLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to WdbSyncLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the EXISTS statement
     */
    public function useWdbSyncLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useExistsQuery('WdbSyncLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for a NOT EXISTS query.
     *
     * @see useWdbSyncLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useWdbSyncLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useExistsQuery('WdbSyncLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the IN statement
     */
    public function useInWdbSyncLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useInQuery('WdbSyncLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to WdbSyncLog table for a NOT IN query.
     *
     * @see useWdbSyncLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\WdbSyncLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInWdbSyncLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\WdbSyncLogQuery */
        $q = $this->useInQuery('WdbSyncLog', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $wfRequests->getWfCompanyId(), $comparison);

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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $stp->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\StpWeek object
     *
     * @param \entities\StpWeek|ObjectCollection $stpWeek the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStpWeek($stpWeek, ?string $comparison = null)
    {
        if ($stpWeek instanceof \entities\StpWeek) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $stpWeek->getCompanyId(), $comparison);

            return $this;
        } elseif ($stpWeek instanceof ObjectCollection) {
            $this
                ->useStpWeekQuery()
                ->filterByPrimaryKeys($stpWeek->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStpWeek() only accepts arguments of type \entities\StpWeek or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StpWeek relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStpWeek(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StpWeek');

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
            $this->addJoinObject($join, 'StpWeek');
        }

        return $this;
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\StpWeekQuery A secondary query class using the current class as primary query
     */
    public function useStpWeekQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStpWeek($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StpWeek', '\entities\StpWeekQuery');
    }

    /**
     * Use the StpWeek relation StpWeek object
     *
     * @param callable(\entities\StpWeekQuery):\entities\StpWeekQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStpWeekQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStpWeekQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to StpWeek table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\StpWeekQuery The inner query object of the EXISTS statement
     */
    public function useStpWeekExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT EXISTS query.
     *
     * @see useStpWeekExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT EXISTS statement
     */
    public function useStpWeekNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useExistsQuery('StpWeek', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to StpWeek table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\StpWeekQuery The inner query object of the IN statement
     */
    public function useInStpWeekQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to StpWeek table for a NOT IN query.
     *
     * @see useStpWeekInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\StpWeekQuery The inner query object of the NOT IN statement
     */
    public function useNotInStpWeekQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\StpWeekQuery */
        $q = $this->useInQuery('StpWeek', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $outletOrgDataKeys->getCompanyId(), $comparison);

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
     * Filter the query by a related \entities\NotificationConfiguration object
     *
     * @param \entities\NotificationConfiguration|ObjectCollection $notificationConfiguration the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNotificationConfiguration($notificationConfiguration, ?string $comparison = null)
    {
        if ($notificationConfiguration instanceof \entities\NotificationConfiguration) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $notificationConfiguration->getCompanyId(), $comparison);

            return $this;
        } elseif ($notificationConfiguration instanceof ObjectCollection) {
            $this
                ->useNotificationConfigurationQuery()
                ->filterByPrimaryKeys($notificationConfiguration->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByNotificationConfiguration() only accepts arguments of type \entities\NotificationConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NotificationConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNotificationConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NotificationConfiguration');

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
            $this->addJoinObject($join, 'NotificationConfiguration');
        }

        return $this;
    }

    /**
     * Use the NotificationConfiguration relation NotificationConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\NotificationConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useNotificationConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNotificationConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NotificationConfiguration', '\entities\NotificationConfigurationQuery');
    }

    /**
     * Use the NotificationConfiguration relation NotificationConfiguration object
     *
     * @param callable(\entities\NotificationConfigurationQuery):\entities\NotificationConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNotificationConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNotificationConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to NotificationConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\NotificationConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useNotificationConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\NotificationConfigurationQuery */
        $q = $this->useExistsQuery('NotificationConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to NotificationConfiguration table for a NOT EXISTS query.
     *
     * @see useNotificationConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\NotificationConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useNotificationConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\NotificationConfigurationQuery */
        $q = $this->useExistsQuery('NotificationConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to NotificationConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\NotificationConfigurationQuery The inner query object of the IN statement
     */
    public function useInNotificationConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\NotificationConfigurationQuery */
        $q = $this->useInQuery('NotificationConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to NotificationConfiguration table for a NOT IN query.
     *
     * @see useNotificationConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\NotificationConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInNotificationConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\NotificationConfigurationQuery */
        $q = $this->useInQuery('NotificationConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\LeaveType object
     *
     * @param \entities\LeaveType|ObjectCollection $leaveType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveType($leaveType, ?string $comparison = null)
    {
        if ($leaveType instanceof \entities\LeaveType) {
            $this
                ->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $leaveType->getCompanyId(), $comparison);

            return $this;
        } elseif ($leaveType instanceof ObjectCollection) {
            $this
                ->useLeaveTypeQuery()
                ->filterByPrimaryKeys($leaveType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLeaveType() only accepts arguments of type \entities\LeaveType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeaveType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLeaveType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeaveType');

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
            $this->addJoinObject($join, 'LeaveType');
        }

        return $this;
    }

    /**
     * Use the LeaveType relation LeaveType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\LeaveTypeQuery A secondary query class using the current class as primary query
     */
    public function useLeaveTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLeaveType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeaveType', '\entities\LeaveTypeQuery');
    }

    /**
     * Use the LeaveType relation LeaveType object
     *
     * @param callable(\entities\LeaveTypeQuery):\entities\LeaveTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLeaveTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLeaveTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to LeaveType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\LeaveTypeQuery The inner query object of the EXISTS statement
     */
    public function useLeaveTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\LeaveTypeQuery */
        $q = $this->useExistsQuery('LeaveType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to LeaveType table for a NOT EXISTS query.
     *
     * @see useLeaveTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\LeaveTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useLeaveTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeaveTypeQuery */
        $q = $this->useExistsQuery('LeaveType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to LeaveType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\LeaveTypeQuery The inner query object of the IN statement
     */
    public function useInLeaveTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\LeaveTypeQuery */
        $q = $this->useInQuery('LeaveType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to LeaveType table for a NOT IN query.
     *
     * @see useLeaveTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\LeaveTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInLeaveTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\LeaveTypeQuery */
        $q = $this->useInQuery('LeaveType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCompany $company Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($company = null)
    {
        if ($company) {
            $this->addUsingAlias(CompanyTableMap::COL_COMPANY_ID, $company->getCompanyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the company table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompanyTableMap::clearInstancePool();
            CompanyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompanyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompanyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompanyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

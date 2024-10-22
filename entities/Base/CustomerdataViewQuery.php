<?php

namespace entities\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use entities\CustomerdataView as ChildCustomerdataView;
use entities\CustomerdataViewQuery as ChildCustomerdataViewQuery;
use entities\Map\CustomerdataViewTableMap;

/**
 * Base class that represents a query for the `customerdata_view` table.
 *
 * @method     ChildCustomerdataViewQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildCustomerdataViewQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildCustomerdataViewQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildCustomerdataViewQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildCustomerdataViewQuery orderByPositionCode($order = Criteria::ASC) Order by the position_code column
 * @method     ChildCustomerdataViewQuery orderByOodItownid($order = Criteria::ASC) Order by the ood_itownid column
 * @method     ChildCustomerdataViewQuery orderByOodTownCode($order = Criteria::ASC) Order by the ood_town_code column
 * @method     ChildCustomerdataViewQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildCustomerdataViewQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildCustomerdataViewQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomerdataViewQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildCustomerdataViewQuery orderByOutletOrgCode($order = Criteria::ASC) Order by the outlet_org_code column
 * @method     ChildCustomerdataViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildCustomerdataViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildCustomerdataViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildCustomerdataViewQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildCustomerdataViewQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildCustomerdataViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildCustomerdataViewQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildCustomerdataViewQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildCustomerdataViewQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildCustomerdataViewQuery orderByOrgPotential($order = Criteria::ASC) Order by the org_potential column
 * @method     ChildCustomerdataViewQuery orderByBrandFocus($order = Criteria::ASC) Order by the brand_focus column
 * @method     ChildCustomerdataViewQuery orderByCustomerFq($order = Criteria::ASC) Order by the customer_fq column
 * @method     ChildCustomerdataViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildCustomerdataViewQuery orderByOutletEmail($order = Criteria::ASC) Order by the outlet_email column
 * @method     ChildCustomerdataViewQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildCustomerdataViewQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildCustomerdataViewQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildCustomerdataViewQuery orderByOutletOpeningDate($order = Criteria::ASC) Order by the outlet_opening_date column
 * @method     ChildCustomerdataViewQuery orderByOutletContactName($order = Criteria::ASC) Order by the outlet_contact_name column
 * @method     ChildCustomerdataViewQuery orderByOutletLandlineno($order = Criteria::ASC) Order by the outlet_landlineno column
 * @method     ChildCustomerdataViewQuery orderByOutletAltLandlineno($order = Criteria::ASC) Order by the outlet_alt_landlineno column
 * @method     ChildCustomerdataViewQuery orderByOutletContactBday($order = Criteria::ASC) Order by the outlet_contact_bday column
 * @method     ChildCustomerdataViewQuery orderByOutletContactAnniversary($order = Criteria::ASC) Order by the outlet_contact_anniversary column
 * @method     ChildCustomerdataViewQuery orderByOutletIsdCode($order = Criteria::ASC) Order by the outlet_isd_code column
 * @method     ChildCustomerdataViewQuery orderByOutletContactNo($order = Criteria::ASC) Order by the outlet_contact_no column
 * @method     ChildCustomerdataViewQuery orderByOutletAltContactNo($order = Criteria::ASC) Order by the outlet_alt_contact_no column
 * @method     ChildCustomerdataViewQuery orderByoutlettype_id($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildCustomerdataViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildCustomerdataViewQuery orderByOutletPotential($order = Criteria::ASC) Order by the outlet_potential column
 * @method     ChildCustomerdataViewQuery orderByOutletQualification($order = Criteria::ASC) Order by the outlet_qualification column
 * @method     ChildCustomerdataViewQuery orderByOutletRegno($order = Criteria::ASC) Order by the outlet_regno column
 * @method     ChildCustomerdataViewQuery orderByOutletMaritalStatus($order = Criteria::ASC) Order by the outlet_marital_status column
 * @method     ChildCustomerdataViewQuery orderByOutletMedia($order = Criteria::ASC) Order by the outlet_media column
 * @method     ChildCustomerdataViewQuery orderByAddressName($order = Criteria::ASC) Order by the address_name column
 * @method     ChildCustomerdataViewQuery orderByOutletAddress($order = Criteria::ASC) Order by the outlet_address column
 * @method     ChildCustomerdataViewQuery orderByOutletStreetName($order = Criteria::ASC) Order by the outlet_street_name column
 * @method     ChildCustomerdataViewQuery orderByOutletCity($order = Criteria::ASC) Order by the outlet_city column
 * @method     ChildCustomerdataViewQuery orderByOutletState($order = Criteria::ASC) Order by the outlet_state column
 * @method     ChildCustomerdataViewQuery orderByOutletCountry($order = Criteria::ASC) Order by the outlet_country column
 * @method     ChildCustomerdataViewQuery orderByOutletPincode($order = Criteria::ASC) Order by the outlet_pincode column
 * @method     ChildCustomerdataViewQuery orderByLastVisitDate($order = Criteria::ASC) Order by the last_visit_date column
 * @method     ChildCustomerdataViewQuery orderByLastVisitEmployee($order = Criteria::ASC) Order by the last_visit_employee column
 * @method     ChildCustomerdataViewQuery orderByOutletStatus($order = Criteria::ASC) Order by the outlet_status column
 *
 * @method     ChildCustomerdataViewQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildCustomerdataViewQuery groupByFirstName() Group by the first_name column
 * @method     ChildCustomerdataViewQuery groupByLastName() Group by the last_name column
 * @method     ChildCustomerdataViewQuery groupByPhone() Group by the phone column
 * @method     ChildCustomerdataViewQuery groupByPositionCode() Group by the position_code column
 * @method     ChildCustomerdataViewQuery groupByOodItownid() Group by the ood_itownid column
 * @method     ChildCustomerdataViewQuery groupByOodTownCode() Group by the ood_town_code column
 * @method     ChildCustomerdataViewQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildCustomerdataViewQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildCustomerdataViewQuery groupById() Group by the id column
 * @method     ChildCustomerdataViewQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildCustomerdataViewQuery groupByOutletOrgCode() Group by the outlet_org_code column
 * @method     ChildCustomerdataViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildCustomerdataViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildCustomerdataViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildCustomerdataViewQuery groupByPositionName() Group by the position_name column
 * @method     ChildCustomerdataViewQuery groupByBeatId() Group by the beat_id column
 * @method     ChildCustomerdataViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildCustomerdataViewQuery groupByTags() Group by the tags column
 * @method     ChildCustomerdataViewQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildCustomerdataViewQuery groupByComments() Group by the comments column
 * @method     ChildCustomerdataViewQuery groupByOrgPotential() Group by the org_potential column
 * @method     ChildCustomerdataViewQuery groupByBrandFocus() Group by the brand_focus column
 * @method     ChildCustomerdataViewQuery groupByCustomerFq() Group by the customer_fq column
 * @method     ChildCustomerdataViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildCustomerdataViewQuery groupByOutletEmail() Group by the outlet_email column
 * @method     ChildCustomerdataViewQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildCustomerdataViewQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildCustomerdataViewQuery groupByClassification() Group by the classification column
 * @method     ChildCustomerdataViewQuery groupByOutletOpeningDate() Group by the outlet_opening_date column
 * @method     ChildCustomerdataViewQuery groupByOutletContactName() Group by the outlet_contact_name column
 * @method     ChildCustomerdataViewQuery groupByOutletLandlineno() Group by the outlet_landlineno column
 * @method     ChildCustomerdataViewQuery groupByOutletAltLandlineno() Group by the outlet_alt_landlineno column
 * @method     ChildCustomerdataViewQuery groupByOutletContactBday() Group by the outlet_contact_bday column
 * @method     ChildCustomerdataViewQuery groupByOutletContactAnniversary() Group by the outlet_contact_anniversary column
 * @method     ChildCustomerdataViewQuery groupByOutletIsdCode() Group by the outlet_isd_code column
 * @method     ChildCustomerdataViewQuery groupByOutletContactNo() Group by the outlet_contact_no column
 * @method     ChildCustomerdataViewQuery groupByOutletAltContactNo() Group by the outlet_alt_contact_no column
 * @method     ChildCustomerdataViewQuery groupByoutlettype_id() Group by the outlettype_id column
 * @method     ChildCustomerdataViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildCustomerdataViewQuery groupByOutletPotential() Group by the outlet_potential column
 * @method     ChildCustomerdataViewQuery groupByOutletQualification() Group by the outlet_qualification column
 * @method     ChildCustomerdataViewQuery groupByOutletRegno() Group by the outlet_regno column
 * @method     ChildCustomerdataViewQuery groupByOutletMaritalStatus() Group by the outlet_marital_status column
 * @method     ChildCustomerdataViewQuery groupByOutletMedia() Group by the outlet_media column
 * @method     ChildCustomerdataViewQuery groupByAddressName() Group by the address_name column
 * @method     ChildCustomerdataViewQuery groupByOutletAddress() Group by the outlet_address column
 * @method     ChildCustomerdataViewQuery groupByOutletStreetName() Group by the outlet_street_name column
 * @method     ChildCustomerdataViewQuery groupByOutletCity() Group by the outlet_city column
 * @method     ChildCustomerdataViewQuery groupByOutletState() Group by the outlet_state column
 * @method     ChildCustomerdataViewQuery groupByOutletCountry() Group by the outlet_country column
 * @method     ChildCustomerdataViewQuery groupByOutletPincode() Group by the outlet_pincode column
 * @method     ChildCustomerdataViewQuery groupByLastVisitDate() Group by the last_visit_date column
 * @method     ChildCustomerdataViewQuery groupByLastVisitEmployee() Group by the last_visit_employee column
 * @method     ChildCustomerdataViewQuery groupByOutletStatus() Group by the outlet_status column
 *
 * @method     ChildCustomerdataViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomerdataViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomerdataViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomerdataViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCustomerdataViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCustomerdataViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCustomerdataView|null findOne(?ConnectionInterface $con = null) Return the first ChildCustomerdataView matching the query
 * @method     ChildCustomerdataView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCustomerdataView matching the query, or a new ChildCustomerdataView object populated from the query conditions when no match is found
 *
 * @method     ChildCustomerdataView|null findOneByEmployeeCode(string $employee_code) Return the first ChildCustomerdataView filtered by the employee_code column
 * @method     ChildCustomerdataView|null findOneByFirstName(string $first_name) Return the first ChildCustomerdataView filtered by the first_name column
 * @method     ChildCustomerdataView|null findOneByLastName(string $last_name) Return the first ChildCustomerdataView filtered by the last_name column
 * @method     ChildCustomerdataView|null findOneByPhone(string $phone) Return the first ChildCustomerdataView filtered by the phone column
 * @method     ChildCustomerdataView|null findOneByPositionCode(string $position_code) Return the first ChildCustomerdataView filtered by the position_code column
 * @method     ChildCustomerdataView|null findOneByOodItownid(int $ood_itownid) Return the first ChildCustomerdataView filtered by the ood_itownid column
 * @method     ChildCustomerdataView|null findOneByOodTownCode(string $ood_town_code) Return the first ChildCustomerdataView filtered by the ood_town_code column
 * @method     ChildCustomerdataView|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildCustomerdataView filtered by the outlet_org_id column
 * @method     ChildCustomerdataView|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildCustomerdataView filtered by the org_unit_id column
 * @method     ChildCustomerdataView|null findOneById(int $id) Return the first ChildCustomerdataView filtered by the id column
 * @method     ChildCustomerdataView|null findOneByOutletCode(string $outlet_code) Return the first ChildCustomerdataView filtered by the outlet_code column
 * @method     ChildCustomerdataView|null findOneByOutletOrgCode(string $outlet_org_code) Return the first ChildCustomerdataView filtered by the outlet_org_code column
 * @method     ChildCustomerdataView|null findOneByTerritoryId(int $territory_id) Return the first ChildCustomerdataView filtered by the territory_id column
 * @method     ChildCustomerdataView|null findOneByTerritoryName(string $territory_name) Return the first ChildCustomerdataView filtered by the territory_name column
 * @method     ChildCustomerdataView|null findOneByPositionId(int $position_id) Return the first ChildCustomerdataView filtered by the position_id column
 * @method     ChildCustomerdataView|null findOneByPositionName(string $position_name) Return the first ChildCustomerdataView filtered by the position_name column
 * @method     ChildCustomerdataView|null findOneByBeatId(int $beat_id) Return the first ChildCustomerdataView filtered by the beat_id column
 * @method     ChildCustomerdataView|null findOneByBeatName(string $beat_name) Return the first ChildCustomerdataView filtered by the beat_name column
 * @method     ChildCustomerdataView|null findOneByTags(string $tags) Return the first ChildCustomerdataView filtered by the tags column
 * @method     ChildCustomerdataView|null findOneByVisitFq(int $visit_fq) Return the first ChildCustomerdataView filtered by the visit_fq column
 * @method     ChildCustomerdataView|null findOneByComments(string $comments) Return the first ChildCustomerdataView filtered by the comments column
 * @method     ChildCustomerdataView|null findOneByOrgPotential(string $org_potential) Return the first ChildCustomerdataView filtered by the org_potential column
 * @method     ChildCustomerdataView|null findOneByBrandFocus(string $brand_focus) Return the first ChildCustomerdataView filtered by the brand_focus column
 * @method     ChildCustomerdataView|null findOneByCustomerFq(string $customer_fq) Return the first ChildCustomerdataView filtered by the customer_fq column
 * @method     ChildCustomerdataView|null findOneByOutletName(string $outlet_name) Return the first ChildCustomerdataView filtered by the outlet_name column
 * @method     ChildCustomerdataView|null findOneByOutletEmail(string $outlet_email) Return the first ChildCustomerdataView filtered by the outlet_email column
 * @method     ChildCustomerdataView|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildCustomerdataView filtered by the outlet_salutation column
 * @method     ChildCustomerdataView|null findOneByOutletClassification(int $outlet_classification) Return the first ChildCustomerdataView filtered by the outlet_classification column
 * @method     ChildCustomerdataView|null findOneByClassification(string $classification) Return the first ChildCustomerdataView filtered by the classification column
 * @method     ChildCustomerdataView|null findOneByOutletOpeningDate(string $outlet_opening_date) Return the first ChildCustomerdataView filtered by the outlet_opening_date column
 * @method     ChildCustomerdataView|null findOneByOutletContactName(string $outlet_contact_name) Return the first ChildCustomerdataView filtered by the outlet_contact_name column
 * @method     ChildCustomerdataView|null findOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildCustomerdataView filtered by the outlet_landlineno column
 * @method     ChildCustomerdataView|null findOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildCustomerdataView filtered by the outlet_alt_landlineno column
 * @method     ChildCustomerdataView|null findOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildCustomerdataView filtered by the outlet_contact_bday column
 * @method     ChildCustomerdataView|null findOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildCustomerdataView filtered by the outlet_contact_anniversary column
 * @method     ChildCustomerdataView|null findOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildCustomerdataView filtered by the outlet_isd_code column
 * @method     ChildCustomerdataView|null findOneByOutletContactNo(string $outlet_contact_no) Return the first ChildCustomerdataView filtered by the outlet_contact_no column
 * @method     ChildCustomerdataView|null findOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildCustomerdataView filtered by the outlet_alt_contact_no column
 * @method     ChildCustomerdataView|null findOneByoutlettype_id(int $outlettype_id) Return the first ChildCustomerdataView filtered by the outlettype_id column
 * @method     ChildCustomerdataView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildCustomerdataView filtered by the outlettype_name column
 * @method     ChildCustomerdataView|null findOneByOutletPotential(string $outlet_potential) Return the first ChildCustomerdataView filtered by the outlet_potential column
 * @method     ChildCustomerdataView|null findOneByOutletQualification(string $outlet_qualification) Return the first ChildCustomerdataView filtered by the outlet_qualification column
 * @method     ChildCustomerdataView|null findOneByOutletRegno(string $outlet_regno) Return the first ChildCustomerdataView filtered by the outlet_regno column
 * @method     ChildCustomerdataView|null findOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildCustomerdataView filtered by the outlet_marital_status column
 * @method     ChildCustomerdataView|null findOneByOutletMedia(string $outlet_media) Return the first ChildCustomerdataView filtered by the outlet_media column
 * @method     ChildCustomerdataView|null findOneByAddressName(string $address_name) Return the first ChildCustomerdataView filtered by the address_name column
 * @method     ChildCustomerdataView|null findOneByOutletAddress(string $outlet_address) Return the first ChildCustomerdataView filtered by the outlet_address column
 * @method     ChildCustomerdataView|null findOneByOutletStreetName(string $outlet_street_name) Return the first ChildCustomerdataView filtered by the outlet_street_name column
 * @method     ChildCustomerdataView|null findOneByOutletCity(string $outlet_city) Return the first ChildCustomerdataView filtered by the outlet_city column
 * @method     ChildCustomerdataView|null findOneByOutletState(string $outlet_state) Return the first ChildCustomerdataView filtered by the outlet_state column
 * @method     ChildCustomerdataView|null findOneByOutletCountry(string $outlet_country) Return the first ChildCustomerdataView filtered by the outlet_country column
 * @method     ChildCustomerdataView|null findOneByOutletPincode(string $outlet_pincode) Return the first ChildCustomerdataView filtered by the outlet_pincode column
 * @method     ChildCustomerdataView|null findOneByLastVisitDate(string $last_visit_date) Return the first ChildCustomerdataView filtered by the last_visit_date column
 * @method     ChildCustomerdataView|null findOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildCustomerdataView filtered by the last_visit_employee column
 * @method     ChildCustomerdataView|null findOneByOutletStatus(string $outlet_status) Return the first ChildCustomerdataView filtered by the outlet_status column
 *
 * @method     ChildCustomerdataView requirePk($key, ?ConnectionInterface $con = null) Return the ChildCustomerdataView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOne(?ConnectionInterface $con = null) Return the first ChildCustomerdataView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomerdataView requireOneByEmployeeCode(string $employee_code) Return the first ChildCustomerdataView filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByFirstName(string $first_name) Return the first ChildCustomerdataView filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByLastName(string $last_name) Return the first ChildCustomerdataView filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByPhone(string $phone) Return the first ChildCustomerdataView filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByPositionCode(string $position_code) Return the first ChildCustomerdataView filtered by the position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOodItownid(int $ood_itownid) Return the first ChildCustomerdataView filtered by the ood_itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOodTownCode(string $ood_town_code) Return the first ChildCustomerdataView filtered by the ood_town_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildCustomerdataView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOrgUnitId(int $org_unit_id) Return the first ChildCustomerdataView filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneById(int $id) Return the first ChildCustomerdataView filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletCode(string $outlet_code) Return the first ChildCustomerdataView filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletOrgCode(string $outlet_org_code) Return the first ChildCustomerdataView filtered by the outlet_org_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByTerritoryId(int $territory_id) Return the first ChildCustomerdataView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByTerritoryName(string $territory_name) Return the first ChildCustomerdataView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByPositionId(int $position_id) Return the first ChildCustomerdataView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByPositionName(string $position_name) Return the first ChildCustomerdataView filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByBeatId(int $beat_id) Return the first ChildCustomerdataView filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByBeatName(string $beat_name) Return the first ChildCustomerdataView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByTags(string $tags) Return the first ChildCustomerdataView filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByVisitFq(int $visit_fq) Return the first ChildCustomerdataView filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByComments(string $comments) Return the first ChildCustomerdataView filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOrgPotential(string $org_potential) Return the first ChildCustomerdataView filtered by the org_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByBrandFocus(string $brand_focus) Return the first ChildCustomerdataView filtered by the brand_focus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByCustomerFq(string $customer_fq) Return the first ChildCustomerdataView filtered by the customer_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletName(string $outlet_name) Return the first ChildCustomerdataView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletEmail(string $outlet_email) Return the first ChildCustomerdataView filtered by the outlet_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildCustomerdataView filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletClassification(int $outlet_classification) Return the first ChildCustomerdataView filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByClassification(string $classification) Return the first ChildCustomerdataView filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletOpeningDate(string $outlet_opening_date) Return the first ChildCustomerdataView filtered by the outlet_opening_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletContactName(string $outlet_contact_name) Return the first ChildCustomerdataView filtered by the outlet_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildCustomerdataView filtered by the outlet_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildCustomerdataView filtered by the outlet_alt_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildCustomerdataView filtered by the outlet_contact_bday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildCustomerdataView filtered by the outlet_contact_anniversary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildCustomerdataView filtered by the outlet_isd_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletContactNo(string $outlet_contact_no) Return the first ChildCustomerdataView filtered by the outlet_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildCustomerdataView filtered by the outlet_alt_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByoutlettype_id(int $outlettype_id) Return the first ChildCustomerdataView filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildCustomerdataView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletPotential(string $outlet_potential) Return the first ChildCustomerdataView filtered by the outlet_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletQualification(string $outlet_qualification) Return the first ChildCustomerdataView filtered by the outlet_qualification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletRegno(string $outlet_regno) Return the first ChildCustomerdataView filtered by the outlet_regno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildCustomerdataView filtered by the outlet_marital_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletMedia(string $outlet_media) Return the first ChildCustomerdataView filtered by the outlet_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByAddressName(string $address_name) Return the first ChildCustomerdataView filtered by the address_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletAddress(string $outlet_address) Return the first ChildCustomerdataView filtered by the outlet_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletStreetName(string $outlet_street_name) Return the first ChildCustomerdataView filtered by the outlet_street_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletCity(string $outlet_city) Return the first ChildCustomerdataView filtered by the outlet_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletState(string $outlet_state) Return the first ChildCustomerdataView filtered by the outlet_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletCountry(string $outlet_country) Return the first ChildCustomerdataView filtered by the outlet_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletPincode(string $outlet_pincode) Return the first ChildCustomerdataView filtered by the outlet_pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByLastVisitDate(string $last_visit_date) Return the first ChildCustomerdataView filtered by the last_visit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildCustomerdataView filtered by the last_visit_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomerdataView requireOneByOutletStatus(string $outlet_status) Return the first ChildCustomerdataView filtered by the outlet_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomerdataView[]|Collection find(?ConnectionInterface $con = null) Return ChildCustomerdataView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> find(?ConnectionInterface $con = null) Return ChildCustomerdataView objects based on current ModelCriteria
 *
 * @method     ChildCustomerdataView[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildCustomerdataView objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByEmployeeCode(string|array<string> $employee_code) Return ChildCustomerdataView objects filtered by the employee_code column
 * @method     ChildCustomerdataView[]|Collection findByFirstName(string|array<string> $first_name) Return ChildCustomerdataView objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByFirstName(string|array<string> $first_name) Return ChildCustomerdataView objects filtered by the first_name column
 * @method     ChildCustomerdataView[]|Collection findByLastName(string|array<string> $last_name) Return ChildCustomerdataView objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByLastName(string|array<string> $last_name) Return ChildCustomerdataView objects filtered by the last_name column
 * @method     ChildCustomerdataView[]|Collection findByPhone(string|array<string> $phone) Return ChildCustomerdataView objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByPhone(string|array<string> $phone) Return ChildCustomerdataView objects filtered by the phone column
 * @method     ChildCustomerdataView[]|Collection findByPositionCode(string|array<string> $position_code) Return ChildCustomerdataView objects filtered by the position_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByPositionCode(string|array<string> $position_code) Return ChildCustomerdataView objects filtered by the position_code column
 * @method     ChildCustomerdataView[]|Collection findByOodItownid(int|array<int> $ood_itownid) Return ChildCustomerdataView objects filtered by the ood_itownid column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOodItownid(int|array<int> $ood_itownid) Return ChildCustomerdataView objects filtered by the ood_itownid column
 * @method     ChildCustomerdataView[]|Collection findByOodTownCode(string|array<string> $ood_town_code) Return ChildCustomerdataView objects filtered by the ood_town_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOodTownCode(string|array<string> $ood_town_code) Return ChildCustomerdataView objects filtered by the ood_town_code column
 * @method     ChildCustomerdataView[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildCustomerdataView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildCustomerdataView objects filtered by the outlet_org_id column
 * @method     ChildCustomerdataView[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildCustomerdataView objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildCustomerdataView objects filtered by the org_unit_id column
 * @method     ChildCustomerdataView[]|Collection findById(int|array<int> $id) Return ChildCustomerdataView objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findById(int|array<int> $id) Return ChildCustomerdataView objects filtered by the id column
 * @method     ChildCustomerdataView[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildCustomerdataView objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletCode(string|array<string> $outlet_code) Return ChildCustomerdataView objects filtered by the outlet_code column
 * @method     ChildCustomerdataView[]|Collection findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildCustomerdataView objects filtered by the outlet_org_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildCustomerdataView objects filtered by the outlet_org_code column
 * @method     ChildCustomerdataView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildCustomerdataView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByTerritoryId(int|array<int> $territory_id) Return ChildCustomerdataView objects filtered by the territory_id column
 * @method     ChildCustomerdataView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildCustomerdataView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByTerritoryName(string|array<string> $territory_name) Return ChildCustomerdataView objects filtered by the territory_name column
 * @method     ChildCustomerdataView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildCustomerdataView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByPositionId(int|array<int> $position_id) Return ChildCustomerdataView objects filtered by the position_id column
 * @method     ChildCustomerdataView[]|Collection findByPositionName(string|array<string> $position_name) Return ChildCustomerdataView objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByPositionName(string|array<string> $position_name) Return ChildCustomerdataView objects filtered by the position_name column
 * @method     ChildCustomerdataView[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildCustomerdataView objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByBeatId(int|array<int> $beat_id) Return ChildCustomerdataView objects filtered by the beat_id column
 * @method     ChildCustomerdataView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildCustomerdataView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByBeatName(string|array<string> $beat_name) Return ChildCustomerdataView objects filtered by the beat_name column
 * @method     ChildCustomerdataView[]|Collection findByTags(string|array<string> $tags) Return ChildCustomerdataView objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByTags(string|array<string> $tags) Return ChildCustomerdataView objects filtered by the tags column
 * @method     ChildCustomerdataView[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildCustomerdataView objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByVisitFq(int|array<int> $visit_fq) Return ChildCustomerdataView objects filtered by the visit_fq column
 * @method     ChildCustomerdataView[]|Collection findByComments(string|array<string> $comments) Return ChildCustomerdataView objects filtered by the comments column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByComments(string|array<string> $comments) Return ChildCustomerdataView objects filtered by the comments column
 * @method     ChildCustomerdataView[]|Collection findByOrgPotential(string|array<string> $org_potential) Return ChildCustomerdataView objects filtered by the org_potential column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOrgPotential(string|array<string> $org_potential) Return ChildCustomerdataView objects filtered by the org_potential column
 * @method     ChildCustomerdataView[]|Collection findByBrandFocus(string|array<string> $brand_focus) Return ChildCustomerdataView objects filtered by the brand_focus column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByBrandFocus(string|array<string> $brand_focus) Return ChildCustomerdataView objects filtered by the brand_focus column
 * @method     ChildCustomerdataView[]|Collection findByCustomerFq(string|array<string> $customer_fq) Return ChildCustomerdataView objects filtered by the customer_fq column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByCustomerFq(string|array<string> $customer_fq) Return ChildCustomerdataView objects filtered by the customer_fq column
 * @method     ChildCustomerdataView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildCustomerdataView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletName(string|array<string> $outlet_name) Return ChildCustomerdataView objects filtered by the outlet_name column
 * @method     ChildCustomerdataView[]|Collection findByOutletEmail(string|array<string> $outlet_email) Return ChildCustomerdataView objects filtered by the outlet_email column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletEmail(string|array<string> $outlet_email) Return ChildCustomerdataView objects filtered by the outlet_email column
 * @method     ChildCustomerdataView[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildCustomerdataView objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildCustomerdataView objects filtered by the outlet_salutation column
 * @method     ChildCustomerdataView[]|Collection findByOutletClassification(int|array<int> $outlet_classification) Return ChildCustomerdataView objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletClassification(int|array<int> $outlet_classification) Return ChildCustomerdataView objects filtered by the outlet_classification column
 * @method     ChildCustomerdataView[]|Collection findByClassification(string|array<string> $classification) Return ChildCustomerdataView objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByClassification(string|array<string> $classification) Return ChildCustomerdataView objects filtered by the classification column
 * @method     ChildCustomerdataView[]|Collection findByOutletOpeningDate(string|array<string> $outlet_opening_date) Return ChildCustomerdataView objects filtered by the outlet_opening_date column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletOpeningDate(string|array<string> $outlet_opening_date) Return ChildCustomerdataView objects filtered by the outlet_opening_date column
 * @method     ChildCustomerdataView[]|Collection findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildCustomerdataView objects filtered by the outlet_contact_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildCustomerdataView objects filtered by the outlet_contact_name column
 * @method     ChildCustomerdataView[]|Collection findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildCustomerdataView objects filtered by the outlet_landlineno column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildCustomerdataView objects filtered by the outlet_landlineno column
 * @method     ChildCustomerdataView[]|Collection findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildCustomerdataView objects filtered by the outlet_alt_landlineno column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildCustomerdataView objects filtered by the outlet_alt_landlineno column
 * @method     ChildCustomerdataView[]|Collection findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildCustomerdataView objects filtered by the outlet_contact_bday column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildCustomerdataView objects filtered by the outlet_contact_bday column
 * @method     ChildCustomerdataView[]|Collection findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildCustomerdataView objects filtered by the outlet_contact_anniversary column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildCustomerdataView objects filtered by the outlet_contact_anniversary column
 * @method     ChildCustomerdataView[]|Collection findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildCustomerdataView objects filtered by the outlet_isd_code column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildCustomerdataView objects filtered by the outlet_isd_code column
 * @method     ChildCustomerdataView[]|Collection findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildCustomerdataView objects filtered by the outlet_contact_no column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildCustomerdataView objects filtered by the outlet_contact_no column
 * @method     ChildCustomerdataView[]|Collection findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildCustomerdataView objects filtered by the outlet_alt_contact_no column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildCustomerdataView objects filtered by the outlet_alt_contact_no column
 * @method     ChildCustomerdataView[]|Collection findByoutlettype_id(int|array<int> $outlettype_id) Return ChildCustomerdataView objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByoutlettype_id(int|array<int> $outlettype_id) Return ChildCustomerdataView objects filtered by the outlettype_id column
 * @method     ChildCustomerdataView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildCustomerdataView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildCustomerdataView objects filtered by the outlettype_name column
 * @method     ChildCustomerdataView[]|Collection findByOutletPotential(string|array<string> $outlet_potential) Return ChildCustomerdataView objects filtered by the outlet_potential column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletPotential(string|array<string> $outlet_potential) Return ChildCustomerdataView objects filtered by the outlet_potential column
 * @method     ChildCustomerdataView[]|Collection findByOutletQualification(string|array<string> $outlet_qualification) Return ChildCustomerdataView objects filtered by the outlet_qualification column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletQualification(string|array<string> $outlet_qualification) Return ChildCustomerdataView objects filtered by the outlet_qualification column
 * @method     ChildCustomerdataView[]|Collection findByOutletRegno(string|array<string> $outlet_regno) Return ChildCustomerdataView objects filtered by the outlet_regno column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletRegno(string|array<string> $outlet_regno) Return ChildCustomerdataView objects filtered by the outlet_regno column
 * @method     ChildCustomerdataView[]|Collection findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildCustomerdataView objects filtered by the outlet_marital_status column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildCustomerdataView objects filtered by the outlet_marital_status column
 * @method     ChildCustomerdataView[]|Collection findByOutletMedia(string|array<string> $outlet_media) Return ChildCustomerdataView objects filtered by the outlet_media column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletMedia(string|array<string> $outlet_media) Return ChildCustomerdataView objects filtered by the outlet_media column
 * @method     ChildCustomerdataView[]|Collection findByAddressName(string|array<string> $address_name) Return ChildCustomerdataView objects filtered by the address_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByAddressName(string|array<string> $address_name) Return ChildCustomerdataView objects filtered by the address_name column
 * @method     ChildCustomerdataView[]|Collection findByOutletAddress(string|array<string> $outlet_address) Return ChildCustomerdataView objects filtered by the outlet_address column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletAddress(string|array<string> $outlet_address) Return ChildCustomerdataView objects filtered by the outlet_address column
 * @method     ChildCustomerdataView[]|Collection findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildCustomerdataView objects filtered by the outlet_street_name column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildCustomerdataView objects filtered by the outlet_street_name column
 * @method     ChildCustomerdataView[]|Collection findByOutletCity(string|array<string> $outlet_city) Return ChildCustomerdataView objects filtered by the outlet_city column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletCity(string|array<string> $outlet_city) Return ChildCustomerdataView objects filtered by the outlet_city column
 * @method     ChildCustomerdataView[]|Collection findByOutletState(string|array<string> $outlet_state) Return ChildCustomerdataView objects filtered by the outlet_state column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletState(string|array<string> $outlet_state) Return ChildCustomerdataView objects filtered by the outlet_state column
 * @method     ChildCustomerdataView[]|Collection findByOutletCountry(string|array<string> $outlet_country) Return ChildCustomerdataView objects filtered by the outlet_country column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletCountry(string|array<string> $outlet_country) Return ChildCustomerdataView objects filtered by the outlet_country column
 * @method     ChildCustomerdataView[]|Collection findByOutletPincode(string|array<string> $outlet_pincode) Return ChildCustomerdataView objects filtered by the outlet_pincode column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletPincode(string|array<string> $outlet_pincode) Return ChildCustomerdataView objects filtered by the outlet_pincode column
 * @method     ChildCustomerdataView[]|Collection findByLastVisitDate(string|array<string> $last_visit_date) Return ChildCustomerdataView objects filtered by the last_visit_date column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByLastVisitDate(string|array<string> $last_visit_date) Return ChildCustomerdataView objects filtered by the last_visit_date column
 * @method     ChildCustomerdataView[]|Collection findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildCustomerdataView objects filtered by the last_visit_employee column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildCustomerdataView objects filtered by the last_visit_employee column
 * @method     ChildCustomerdataView[]|Collection findByOutletStatus(string|array<string> $outlet_status) Return ChildCustomerdataView objects filtered by the outlet_status column
 * @psalm-method Collection&\Traversable<ChildCustomerdataView> findByOutletStatus(string|array<string> $outlet_status) Return ChildCustomerdataView objects filtered by the outlet_status column
 *
 * @method     ChildCustomerdataView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCustomerdataView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class CustomerdataViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\CustomerdataViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\CustomerdataView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomerdataViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomerdataViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildCustomerdataViewQuery) {
            return $criteria;
        }
        $query = new ChildCustomerdataViewQuery();
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
     * @return ChildCustomerdataView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The CustomerdataView object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        throw new LogicException('The CustomerdataView object has no primary key');
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
        throw new LogicException('The CustomerdataView object has no primary key');
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
        throw new LogicException('The CustomerdataView object has no primary key');
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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_FIRST_NAME, $firstName, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_NAME, $lastName, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_PHONE, $phone, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_POSITION_CODE, $positionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ood_itownid column
     *
     * Example usage:
     * <code>
     * $query->filterByOodItownid(1234); // WHERE ood_itownid = 1234
     * $query->filterByOodItownid(array(12, 34)); // WHERE ood_itownid IN (12, 34)
     * $query->filterByOodItownid(array('min' => 12)); // WHERE ood_itownid > 12
     * </code>
     *
     * @param mixed $oodItownid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOodItownid($oodItownid = null, ?string $comparison = null)
    {
        if (is_array($oodItownid)) {
            $useMinMax = false;
            if (isset($oodItownid['min'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OOD_ITOWNID, $oodItownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($oodItownid['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OOD_ITOWNID, $oodItownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OOD_ITOWNID, $oodItownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ood_town_code column
     *
     * Example usage:
     * <code>
     * $query->filterByOodTownCode('fooValue');   // WHERE ood_town_code = 'fooValue'
     * $query->filterByOodTownCode('%fooValue%', Criteria::LIKE); // WHERE ood_town_code LIKE '%fooValue%'
     * $query->filterByOodTownCode(['foo', 'bar']); // WHERE ood_town_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $oodTownCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOodTownCode($oodTownCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oodTownCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OOD_TOWN_CODE, $oodTownCode, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ORG_CODE, $outletOrgCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryId(1234); // WHERE territory_id = 1234
     * $query->filterByTerritoryId(array(12, 34)); // WHERE territory_id IN (12, 34)
     * $query->filterByTerritoryId(array('min' => 12)); // WHERE territory_id > 12
     * </code>
     *
     * @param mixed $territoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryId($territoryId = null, ?string $comparison = null)
    {
        if (is_array($territoryId)) {
            $useMinMax = false;
            if (isset($territoryId['min'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritoryName('fooValue');   // WHERE territory_name = 'fooValue'
     * $query->filterByTerritoryName('%fooValue%', Criteria::LIKE); // WHERE territory_name LIKE '%fooValue%'
     * $query->filterByTerritoryName(['foo', 'bar']); // WHERE territory_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $territoryName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritoryName($territoryName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($territoryName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_POSITION_ID, $positionId, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_POSITION_NAME, $positionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatId(1234); // WHERE beat_id = 1234
     * $query->filterByBeatId(array(12, 34)); // WHERE beat_id IN (12, 34)
     * $query->filterByBeatId(array('min' => 12)); // WHERE beat_id > 12
     * </code>
     *
     * @param mixed $beatId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatId($beatId = null, ?string $comparison = null)
    {
        if (is_array($beatId)) {
            $useMinMax = false;
            if (isset($beatId['min'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_BEAT_ID, $beatId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the beat_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBeatName('fooValue');   // WHERE beat_name = 'fooValue'
     * $query->filterByBeatName('%fooValue%', Criteria::LIKE); // WHERE beat_name LIKE '%fooValue%'
     * $query->filterByBeatName(['foo', 'bar']); // WHERE beat_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $beatName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeatName($beatName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beatName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_TAGS, $tags, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_VISIT_FQ, $visitFq, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_COMMENTS, $comments, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_ORG_POTENTIAL, $orgPotential, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_BRAND_FOCUS, $brandFocus, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_CUSTOMER_FQ, $customerFq, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_EMAIL, $outletEmail, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletClassification['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the classification column
     *
     * Example usage:
     * <code>
     * $query->filterByClassification('fooValue');   // WHERE classification = 'fooValue'
     * $query->filterByClassification('%fooValue%', Criteria::LIKE); // WHERE classification LIKE '%fooValue%'
     * $query->filterByClassification(['foo', 'bar']); // WHERE classification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $classification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_CLASSIFICATION, $classification, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOpeningDate['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpeningDate, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NAME, $outletContactName, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_LANDLINENO, $outletLandlineno, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ALT_LANDLINENO, $outletAltLandlineno, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactBday['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactAnniversary['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ISD_CODE, $outletIsdCode, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CONTACT_NO, $outletContactNo, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ALT_CONTACT_NO, $outletAltContactNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_id column
     *
     * Example usage:
     * <code>
     * $query->filterByoutlettype_id(1234); // WHERE outlettype_id = 1234
     * $query->filterByoutlettype_id(array(12, 34)); // WHERE outlettype_id IN (12, 34)
     * $query->filterByoutlettype_id(array('min' => 12)); // WHERE outlettype_id > 12
     * </code>
     *
     * @param mixed $outlettype_id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByoutlettype_id($outlettype_id = null, ?string $comparison = null)
    {
        if (is_array($outlettype_id)) {
            $useMinMax = false;
            if (isset($outlettype_id['min'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLETTYPE_ID, $outlettype_id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettype_id['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLETTYPE_ID, $outlettype_id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLETTYPE_ID, $outlettype_id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlettype_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlettypeName('fooValue');   // WHERE outlettype_name = 'fooValue'
     * $query->filterByOutlettypeName('%fooValue%', Criteria::LIKE); // WHERE outlettype_name LIKE '%fooValue%'
     * $query->filterByOutlettypeName(['foo', 'bar']); // WHERE outlettype_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outlettypeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlettypeName($outlettypeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outlettypeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_potential column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletPotential('fooValue');   // WHERE outlet_potential = 'fooValue'
     * $query->filterByOutletPotential('%fooValue%', Criteria::LIKE); // WHERE outlet_potential LIKE '%fooValue%'
     * $query->filterByOutletPotential(['foo', 'bar']); // WHERE outlet_potential IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletPotential The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletPotential($outletPotential = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletPotential)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_POTENTIAL, $outletPotential, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_QUALIFICATION, $outletQualification, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_REGNO, $outletRegno, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_MARITAL_STATUS, $outletMaritalStatus, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_MEDIA, $outletMedia, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressName('fooValue');   // WHERE address_name = 'fooValue'
     * $query->filterByAddressName('%fooValue%', Criteria::LIKE); // WHERE address_name LIKE '%fooValue%'
     * $query->filterByAddressName(['foo', 'bar']); // WHERE address_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $addressName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddressName($addressName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_ADDRESS_NAME, $addressName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_address column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletAddress('fooValue');   // WHERE outlet_address = 'fooValue'
     * $query->filterByOutletAddress('%fooValue%', Criteria::LIKE); // WHERE outlet_address LIKE '%fooValue%'
     * $query->filterByOutletAddress(['foo', 'bar']); // WHERE outlet_address IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletAddress The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletAddress($outletAddress = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletAddress)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_ADDRESS, $outletAddress, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_street_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletStreetName('fooValue');   // WHERE outlet_street_name = 'fooValue'
     * $query->filterByOutletStreetName('%fooValue%', Criteria::LIKE); // WHERE outlet_street_name LIKE '%fooValue%'
     * $query->filterByOutletStreetName(['foo', 'bar']); // WHERE outlet_street_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletStreetName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletStreetName($outletStreetName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletStreetName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_STREET_NAME, $outletStreetName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_city column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCity('fooValue');   // WHERE outlet_city = 'fooValue'
     * $query->filterByOutletCity('%fooValue%', Criteria::LIKE); // WHERE outlet_city LIKE '%fooValue%'
     * $query->filterByOutletCity(['foo', 'bar']); // WHERE outlet_city IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCity The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCity($outletCity = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCity)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_CITY, $outletCity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_state column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletState('fooValue');   // WHERE outlet_state = 'fooValue'
     * $query->filterByOutletState('%fooValue%', Criteria::LIKE); // WHERE outlet_state LIKE '%fooValue%'
     * $query->filterByOutletState(['foo', 'bar']); // WHERE outlet_state IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletState The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletState($outletState = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletState)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_STATE, $outletState, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_country column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletCountry('fooValue');   // WHERE outlet_country = 'fooValue'
     * $query->filterByOutletCountry('%fooValue%', Criteria::LIKE); // WHERE outlet_country LIKE '%fooValue%'
     * $query->filterByOutletCountry(['foo', 'bar']); // WHERE outlet_country IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletCountry The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletCountry($outletCountry = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletCountry)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_COUNTRY, $outletCountry, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_pincode column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletPincode('fooValue');   // WHERE outlet_pincode = 'fooValue'
     * $query->filterByOutletPincode('%fooValue%', Criteria::LIKE); // WHERE outlet_pincode LIKE '%fooValue%'
     * $query->filterByOutletPincode(['foo', 'bar']); // WHERE outlet_pincode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletPincode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletPincode($outletPincode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletPincode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_PINCODE, $outletPincode, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitDate['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate, $comparison);

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
                $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitEmployee['max'])) {
                $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(CustomerdataViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee, $comparison);

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

        $this->addUsingAlias(CustomerdataViewTableMap::COL_OUTLET_STATUS, $outletStatus, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildCustomerdataView $customerdataView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($customerdataView = null)
    {
        if ($customerdataView) {
            throw new LogicException('CustomerdataView object has no primary key');

        }

        return $this;
    }

}

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
use entities\OutletView as ChildOutletView;
use entities\OutletViewQuery as ChildOutletViewQuery;
use entities\Map\OutletViewTableMap;

/**
 * Base class that represents a query for the `outlet_view` table.
 *
 * @method     ChildOutletViewQuery orderByOutletOrgId($order = Criteria::ASC) Order by the outlet_org_id column
 * @method     ChildOutletViewQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOutletViewQuery orderByTerritoryId($order = Criteria::ASC) Order by the territory_id column
 * @method     ChildOutletViewQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildOutletViewQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildOutletViewQuery orderByTerritoryName($order = Criteria::ASC) Order by the territory_name column
 * @method     ChildOutletViewQuery orderByPositionName($order = Criteria::ASC) Order by the position_name column
 * @method     ChildOutletViewQuery orderByBeatName($order = Criteria::ASC) Order by the beat_name column
 * @method     ChildOutletViewQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildOutletViewQuery orderByVisitFq($order = Criteria::ASC) Order by the visit_fq column
 * @method     ChildOutletViewQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildOutletViewQuery orderByOrgPotential($order = Criteria::ASC) Order by the org_potential column
 * @method     ChildOutletViewQuery orderByBrandFocus($order = Criteria::ASC) Order by the brand_focus column
 * @method     ChildOutletViewQuery orderByCustomerFq($order = Criteria::ASC) Order by the customer_fq column
 * @method     ChildOutletViewQuery orderByOutlet_Id($order = Criteria::ASC) Order by the id column
 * @method     ChildOutletViewQuery orderByOutletMediaId($order = Criteria::ASC) Order by the outlet_media_id column
 * @method     ChildOutletViewQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildOutletViewQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 * @method     ChildOutletViewQuery orderByOutletEmail($order = Criteria::ASC) Order by the outlet_email column
 * @method     ChildOutletViewQuery orderByOutletSalutation($order = Criteria::ASC) Order by the outlet_salutation column
 * @method     ChildOutletViewQuery orderByOutletClassification($order = Criteria::ASC) Order by the outlet_classification column
 * @method     ChildOutletViewQuery orderByClassification($order = Criteria::ASC) Order by the classification column
 * @method     ChildOutletViewQuery orderByOutletOpening_date($order = Criteria::ASC) Order by the outlet_opening_date column
 * @method     ChildOutletViewQuery orderByOutletContactName($order = Criteria::ASC) Order by the outlet_contact_name column
 * @method     ChildOutletViewQuery orderByOutletLandlineno($order = Criteria::ASC) Order by the outlet_landlineno column
 * @method     ChildOutletViewQuery orderByOutletAltLandlineno($order = Criteria::ASC) Order by the outlet_alt_landlineno column
 * @method     ChildOutletViewQuery orderByOutletContactBday($order = Criteria::ASC) Order by the outlet_contact_bday column
 * @method     ChildOutletViewQuery orderByOutletContactAnniversary($order = Criteria::ASC) Order by the outlet_contact_anniversary column
 * @method     ChildOutletViewQuery orderByOutletIsdCode($order = Criteria::ASC) Order by the outlet_isd_code column
 * @method     ChildOutletViewQuery orderByOutletContactNo($order = Criteria::ASC) Order by the outlet_contact_no column
 * @method     ChildOutletViewQuery orderByOutletAltContactNo($order = Criteria::ASC) Order by the outlet_alt_contact_no column
 * @method     ChildOutletViewQuery orderByOutletStatus($order = Criteria::ASC) Order by the outlet_status column
 * @method     ChildOutletViewQuery orderByOutlettypeId($order = Criteria::ASC) Order by the outlettype_id column
 * @method     ChildOutletViewQuery orderByOutlettypeName($order = Criteria::ASC) Order by the outlettype_name column
 * @method     ChildOutletViewQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOutletViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOutletViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOutletViewQuery orderByOutletOtp($order = Criteria::ASC) Order by the outlet_otp column
 * @method     ChildOutletViewQuery orderByOutletVerified($order = Criteria::ASC) Order by the outlet_verified column
 * @method     ChildOutletViewQuery orderByOutletCreatedBy($order = Criteria::ASC) Order by the outlet_created_by column
 * @method     ChildOutletViewQuery orderByOutletApprovedBy($order = Criteria::ASC) Order by the outlet_approved_by column
 * @method     ChildOutletViewQuery orderByOutletPotential($order = Criteria::ASC) Order by the outlet_potential column
 * @method     ChildOutletViewQuery orderByIntegrationId($order = Criteria::ASC) Order by the integration_id column
 * @method     ChildOutletViewQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildOutletViewQuery orderByOutletQualification($order = Criteria::ASC) Order by the outlet_qualification column
 * @method     ChildOutletViewQuery orderByOutletRegno($order = Criteria::ASC) Order by the outlet_regno column
 * @method     ChildOutletViewQuery orderByOutletMaritalStatus($order = Criteria::ASC) Order by the outlet_marital_status column
 * @method     ChildOutletViewQuery orderByOutletMedia($order = Criteria::ASC) Order by the outlet_media column
 * @method     ChildOutletViewQuery orderByAddressName($order = Criteria::ASC) Order by the address_name column
 * @method     ChildOutletViewQuery orderByOutletAddress($order = Criteria::ASC) Order by the outlet_address column
 * @method     ChildOutletViewQuery orderByOutletStreetName($order = Criteria::ASC) Order by the outlet_street_name column
 * @method     ChildOutletViewQuery orderByOutletCity($order = Criteria::ASC) Order by the outlet_city column
 * @method     ChildOutletViewQuery orderByOutletState($order = Criteria::ASC) Order by the outlet_state column
 * @method     ChildOutletViewQuery orderByOutletCountry($order = Criteria::ASC) Order by the outlet_country column
 * @method     ChildOutletViewQuery orderByOutletPincode($order = Criteria::ASC) Order by the outlet_pincode column
 * @method     ChildOutletViewQuery orderByLastVisitDate($order = Criteria::ASC) Order by the last_visit_date column
 * @method     ChildOutletViewQuery orderByLastVisitEmployee($order = Criteria::ASC) Order by the last_visit_employee column
 * @method     ChildOutletViewQuery orderByOutletOrgCode($order = Criteria::ASC) Order by the outlet_org_code column
 * @method     ChildOutletViewQuery orderBySgpiBrandMap($order = Criteria::ASC) Order by the sgpi_brand_map column
 * @method     ChildOutletViewQuery orderBySgpiBrandIdMap($order = Criteria::ASC) Order by the sgpi_brand_id_map column
 *
 * @method     ChildOutletViewQuery groupByOutletOrgId() Group by the outlet_org_id column
 * @method     ChildOutletViewQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOutletViewQuery groupByTerritoryId() Group by the territory_id column
 * @method     ChildOutletViewQuery groupByBeatId() Group by the beat_id column
 * @method     ChildOutletViewQuery groupByPositionId() Group by the position_id column
 * @method     ChildOutletViewQuery groupByTerritoryName() Group by the territory_name column
 * @method     ChildOutletViewQuery groupByPositionName() Group by the position_name column
 * @method     ChildOutletViewQuery groupByBeatName() Group by the beat_name column
 * @method     ChildOutletViewQuery groupByTags() Group by the tags column
 * @method     ChildOutletViewQuery groupByVisitFq() Group by the visit_fq column
 * @method     ChildOutletViewQuery groupByComments() Group by the comments column
 * @method     ChildOutletViewQuery groupByOrgPotential() Group by the org_potential column
 * @method     ChildOutletViewQuery groupByBrandFocus() Group by the brand_focus column
 * @method     ChildOutletViewQuery groupByCustomerFq() Group by the customer_fq column
 * @method     ChildOutletViewQuery groupByOutlet_Id() Group by the id column
 * @method     ChildOutletViewQuery groupByOutletMediaId() Group by the outlet_media_id column
 * @method     ChildOutletViewQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildOutletViewQuery groupByOutletCode() Group by the outlet_code column
 * @method     ChildOutletViewQuery groupByOutletEmail() Group by the outlet_email column
 * @method     ChildOutletViewQuery groupByOutletSalutation() Group by the outlet_salutation column
 * @method     ChildOutletViewQuery groupByOutletClassification() Group by the outlet_classification column
 * @method     ChildOutletViewQuery groupByClassification() Group by the classification column
 * @method     ChildOutletViewQuery groupByOutletOpening_date() Group by the outlet_opening_date column
 * @method     ChildOutletViewQuery groupByOutletContactName() Group by the outlet_contact_name column
 * @method     ChildOutletViewQuery groupByOutletLandlineno() Group by the outlet_landlineno column
 * @method     ChildOutletViewQuery groupByOutletAltLandlineno() Group by the outlet_alt_landlineno column
 * @method     ChildOutletViewQuery groupByOutletContactBday() Group by the outlet_contact_bday column
 * @method     ChildOutletViewQuery groupByOutletContactAnniversary() Group by the outlet_contact_anniversary column
 * @method     ChildOutletViewQuery groupByOutletIsdCode() Group by the outlet_isd_code column
 * @method     ChildOutletViewQuery groupByOutletContactNo() Group by the outlet_contact_no column
 * @method     ChildOutletViewQuery groupByOutletAltContactNo() Group by the outlet_alt_contact_no column
 * @method     ChildOutletViewQuery groupByOutletStatus() Group by the outlet_status column
 * @method     ChildOutletViewQuery groupByOutlettypeId() Group by the outlettype_id column
 * @method     ChildOutletViewQuery groupByOutlettypeName() Group by the outlettype_name column
 * @method     ChildOutletViewQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOutletViewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOutletViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOutletViewQuery groupByOutletOtp() Group by the outlet_otp column
 * @method     ChildOutletViewQuery groupByOutletVerified() Group by the outlet_verified column
 * @method     ChildOutletViewQuery groupByOutletCreatedBy() Group by the outlet_created_by column
 * @method     ChildOutletViewQuery groupByOutletApprovedBy() Group by the outlet_approved_by column
 * @method     ChildOutletViewQuery groupByOutletPotential() Group by the outlet_potential column
 * @method     ChildOutletViewQuery groupByIntegrationId() Group by the integration_id column
 * @method     ChildOutletViewQuery groupByItownid() Group by the itownid column
 * @method     ChildOutletViewQuery groupByOutletQualification() Group by the outlet_qualification column
 * @method     ChildOutletViewQuery groupByOutletRegno() Group by the outlet_regno column
 * @method     ChildOutletViewQuery groupByOutletMaritalStatus() Group by the outlet_marital_status column
 * @method     ChildOutletViewQuery groupByOutletMedia() Group by the outlet_media column
 * @method     ChildOutletViewQuery groupByAddressName() Group by the address_name column
 * @method     ChildOutletViewQuery groupByOutletAddress() Group by the outlet_address column
 * @method     ChildOutletViewQuery groupByOutletStreetName() Group by the outlet_street_name column
 * @method     ChildOutletViewQuery groupByOutletCity() Group by the outlet_city column
 * @method     ChildOutletViewQuery groupByOutletState() Group by the outlet_state column
 * @method     ChildOutletViewQuery groupByOutletCountry() Group by the outlet_country column
 * @method     ChildOutletViewQuery groupByOutletPincode() Group by the outlet_pincode column
 * @method     ChildOutletViewQuery groupByLastVisitDate() Group by the last_visit_date column
 * @method     ChildOutletViewQuery groupByLastVisitEmployee() Group by the last_visit_employee column
 * @method     ChildOutletViewQuery groupByOutletOrgCode() Group by the outlet_org_code column
 * @method     ChildOutletViewQuery groupBySgpiBrandMap() Group by the sgpi_brand_map column
 * @method     ChildOutletViewQuery groupBySgpiBrandIdMap() Group by the sgpi_brand_id_map column
 *
 * @method     ChildOutletViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOutletViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOutletViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOutletViewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOutletViewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOutletViewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOutletView|null findOne(?ConnectionInterface $con = null) Return the first ChildOutletView matching the query
 * @method     ChildOutletView findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOutletView matching the query, or a new ChildOutletView object populated from the query conditions when no match is found
 *
 * @method     ChildOutletView|null findOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletView filtered by the outlet_org_id column
 * @method     ChildOutletView|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletView filtered by the org_unit_id column
 * @method     ChildOutletView|null findOneByTerritoryId(int $territory_id) Return the first ChildOutletView filtered by the territory_id column
 * @method     ChildOutletView|null findOneByBeatId(int $beat_id) Return the first ChildOutletView filtered by the beat_id column
 * @method     ChildOutletView|null findOneByPositionId(int $position_id) Return the first ChildOutletView filtered by the position_id column
 * @method     ChildOutletView|null findOneByTerritoryName(string $territory_name) Return the first ChildOutletView filtered by the territory_name column
 * @method     ChildOutletView|null findOneByPositionName(string $position_name) Return the first ChildOutletView filtered by the position_name column
 * @method     ChildOutletView|null findOneByBeatName(string $beat_name) Return the first ChildOutletView filtered by the beat_name column
 * @method     ChildOutletView|null findOneByTags(string $tags) Return the first ChildOutletView filtered by the tags column
 * @method     ChildOutletView|null findOneByVisitFq(int $visit_fq) Return the first ChildOutletView filtered by the visit_fq column
 * @method     ChildOutletView|null findOneByComments(string $comments) Return the first ChildOutletView filtered by the comments column
 * @method     ChildOutletView|null findOneByOrgPotential(int $org_potential) Return the first ChildOutletView filtered by the org_potential column
 * @method     ChildOutletView|null findOneByBrandFocus(string $brand_focus) Return the first ChildOutletView filtered by the brand_focus column
 * @method     ChildOutletView|null findOneByCustomerFq(string $customer_fq) Return the first ChildOutletView filtered by the customer_fq column
 * @method     ChildOutletView|null findOneByOutlet_Id(int $id) Return the first ChildOutletView filtered by the id column
 * @method     ChildOutletView|null findOneByOutletMediaId(string $outlet_media_id) Return the first ChildOutletView filtered by the outlet_media_id column
 * @method     ChildOutletView|null findOneByOutletName(string $outlet_name) Return the first ChildOutletView filtered by the outlet_name column
 * @method     ChildOutletView|null findOneByOutletCode(string $outlet_code) Return the first ChildOutletView filtered by the outlet_code column
 * @method     ChildOutletView|null findOneByOutletEmail(string $outlet_email) Return the first ChildOutletView filtered by the outlet_email column
 * @method     ChildOutletView|null findOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutletView filtered by the outlet_salutation column
 * @method     ChildOutletView|null findOneByOutletClassification(int $outlet_classification) Return the first ChildOutletView filtered by the outlet_classification column
 * @method     ChildOutletView|null findOneByClassification(string $classification) Return the first ChildOutletView filtered by the classification column
 * @method     ChildOutletView|null findOneByOutletOpening_date(string $outlet_opening_date) Return the first ChildOutletView filtered by the outlet_opening_date column
 * @method     ChildOutletView|null findOneByOutletContactName(string $outlet_contact_name) Return the first ChildOutletView filtered by the outlet_contact_name column
 * @method     ChildOutletView|null findOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildOutletView filtered by the outlet_landlineno column
 * @method     ChildOutletView|null findOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildOutletView filtered by the outlet_alt_landlineno column
 * @method     ChildOutletView|null findOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildOutletView filtered by the outlet_contact_bday column
 * @method     ChildOutletView|null findOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildOutletView filtered by the outlet_contact_anniversary column
 * @method     ChildOutletView|null findOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildOutletView filtered by the outlet_isd_code column
 * @method     ChildOutletView|null findOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutletView filtered by the outlet_contact_no column
 * @method     ChildOutletView|null findOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildOutletView filtered by the outlet_alt_contact_no column
 * @method     ChildOutletView|null findOneByOutletStatus(string $outlet_status) Return the first ChildOutletView filtered by the outlet_status column
 * @method     ChildOutletView|null findOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletView filtered by the outlettype_id column
 * @method     ChildOutletView|null findOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletView filtered by the outlettype_name column
 * @method     ChildOutletView|null findOneByCompanyId(int $company_id) Return the first ChildOutletView filtered by the company_id column
 * @method     ChildOutletView|null findOneByCreatedAt(string $created_at) Return the first ChildOutletView filtered by the created_at column
 * @method     ChildOutletView|null findOneByUpdatedAt(string $updated_at) Return the first ChildOutletView filtered by the updated_at column
 * @method     ChildOutletView|null findOneByOutletOtp(string $outlet_otp) Return the first ChildOutletView filtered by the outlet_otp column
 * @method     ChildOutletView|null findOneByOutletVerified(string $outlet_verified) Return the first ChildOutletView filtered by the outlet_verified column
 * @method     ChildOutletView|null findOneByOutletCreatedBy(int $outlet_created_by) Return the first ChildOutletView filtered by the outlet_created_by column
 * @method     ChildOutletView|null findOneByOutletApprovedBy(int $outlet_approved_by) Return the first ChildOutletView filtered by the outlet_approved_by column
 * @method     ChildOutletView|null findOneByOutletPotential(string $outlet_potential) Return the first ChildOutletView filtered by the outlet_potential column
 * @method     ChildOutletView|null findOneByIntegrationId(string $integration_id) Return the first ChildOutletView filtered by the integration_id column
 * @method     ChildOutletView|null findOneByItownid(int $itownid) Return the first ChildOutletView filtered by the itownid column
 * @method     ChildOutletView|null findOneByOutletQualification(string $outlet_qualification) Return the first ChildOutletView filtered by the outlet_qualification column
 * @method     ChildOutletView|null findOneByOutletRegno(string $outlet_regno) Return the first ChildOutletView filtered by the outlet_regno column
 * @method     ChildOutletView|null findOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildOutletView filtered by the outlet_marital_status column
 * @method     ChildOutletView|null findOneByOutletMedia(string $outlet_media) Return the first ChildOutletView filtered by the outlet_media column
 * @method     ChildOutletView|null findOneByAddressName(string $address_name) Return the first ChildOutletView filtered by the address_name column
 * @method     ChildOutletView|null findOneByOutletAddress(string $outlet_address) Return the first ChildOutletView filtered by the outlet_address column
 * @method     ChildOutletView|null findOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletView filtered by the outlet_street_name column
 * @method     ChildOutletView|null findOneByOutletCity(string $outlet_city) Return the first ChildOutletView filtered by the outlet_city column
 * @method     ChildOutletView|null findOneByOutletState(string $outlet_state) Return the first ChildOutletView filtered by the outlet_state column
 * @method     ChildOutletView|null findOneByOutletCountry(string $outlet_country) Return the first ChildOutletView filtered by the outlet_country column
 * @method     ChildOutletView|null findOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletView filtered by the outlet_pincode column
 * @method     ChildOutletView|null findOneByLastVisitDate(string $last_visit_date) Return the first ChildOutletView filtered by the last_visit_date column
 * @method     ChildOutletView|null findOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildOutletView filtered by the last_visit_employee column
 * @method     ChildOutletView|null findOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOutletView filtered by the outlet_org_code column
 * @method     ChildOutletView|null findOneBySgpiBrandMap(string $sgpi_brand_map) Return the first ChildOutletView filtered by the sgpi_brand_map column
 * @method     ChildOutletView|null findOneBySgpiBrandIdMap(string $sgpi_brand_id_map) Return the first ChildOutletView filtered by the sgpi_brand_id_map column
 *
 * @method     ChildOutletView requirePk($key, ?ConnectionInterface $con = null) Return the ChildOutletView by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOne(?ConnectionInterface $con = null) Return the first ChildOutletView matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletView requireOneByOutletOrgId(int $outlet_org_id) Return the first ChildOutletView filtered by the outlet_org_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOutletView filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByTerritoryId(int $territory_id) Return the first ChildOutletView filtered by the territory_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByBeatId(int $beat_id) Return the first ChildOutletView filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByPositionId(int $position_id) Return the first ChildOutletView filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByTerritoryName(string $territory_name) Return the first ChildOutletView filtered by the territory_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByPositionName(string $position_name) Return the first ChildOutletView filtered by the position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByBeatName(string $beat_name) Return the first ChildOutletView filtered by the beat_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByTags(string $tags) Return the first ChildOutletView filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByVisitFq(int $visit_fq) Return the first ChildOutletView filtered by the visit_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByComments(string $comments) Return the first ChildOutletView filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOrgPotential(int $org_potential) Return the first ChildOutletView filtered by the org_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByBrandFocus(string $brand_focus) Return the first ChildOutletView filtered by the brand_focus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByCustomerFq(string $customer_fq) Return the first ChildOutletView filtered by the customer_fq column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutlet_Id(int $id) Return the first ChildOutletView filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletMediaId(string $outlet_media_id) Return the first ChildOutletView filtered by the outlet_media_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletName(string $outlet_name) Return the first ChildOutletView filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletCode(string $outlet_code) Return the first ChildOutletView filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletEmail(string $outlet_email) Return the first ChildOutletView filtered by the outlet_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletSalutation(string $outlet_salutation) Return the first ChildOutletView filtered by the outlet_salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletClassification(int $outlet_classification) Return the first ChildOutletView filtered by the outlet_classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByClassification(string $classification) Return the first ChildOutletView filtered by the classification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletOpening_date(string $outlet_opening_date) Return the first ChildOutletView filtered by the outlet_opening_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletContactName(string $outlet_contact_name) Return the first ChildOutletView filtered by the outlet_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletLandlineno(string $outlet_landlineno) Return the first ChildOutletView filtered by the outlet_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletAltLandlineno(string $outlet_alt_landlineno) Return the first ChildOutletView filtered by the outlet_alt_landlineno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletContactBday(string $outlet_contact_bday) Return the first ChildOutletView filtered by the outlet_contact_bday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletContactAnniversary(string $outlet_contact_anniversary) Return the first ChildOutletView filtered by the outlet_contact_anniversary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletIsdCode(string $outlet_isd_code) Return the first ChildOutletView filtered by the outlet_isd_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletContactNo(string $outlet_contact_no) Return the first ChildOutletView filtered by the outlet_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletAltContactNo(string $outlet_alt_contact_no) Return the first ChildOutletView filtered by the outlet_alt_contact_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletStatus(string $outlet_status) Return the first ChildOutletView filtered by the outlet_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutlettypeId(int $outlettype_id) Return the first ChildOutletView filtered by the outlettype_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutlettypeName(string $outlettype_name) Return the first ChildOutletView filtered by the outlettype_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByCompanyId(int $company_id) Return the first ChildOutletView filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByCreatedAt(string $created_at) Return the first ChildOutletView filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByUpdatedAt(string $updated_at) Return the first ChildOutletView filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletOtp(string $outlet_otp) Return the first ChildOutletView filtered by the outlet_otp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletVerified(string $outlet_verified) Return the first ChildOutletView filtered by the outlet_verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletCreatedBy(int $outlet_created_by) Return the first ChildOutletView filtered by the outlet_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletApprovedBy(int $outlet_approved_by) Return the first ChildOutletView filtered by the outlet_approved_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletPotential(string $outlet_potential) Return the first ChildOutletView filtered by the outlet_potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByIntegrationId(string $integration_id) Return the first ChildOutletView filtered by the integration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByItownid(int $itownid) Return the first ChildOutletView filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletQualification(string $outlet_qualification) Return the first ChildOutletView filtered by the outlet_qualification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletRegno(string $outlet_regno) Return the first ChildOutletView filtered by the outlet_regno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletMaritalStatus(string $outlet_marital_status) Return the first ChildOutletView filtered by the outlet_marital_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletMedia(string $outlet_media) Return the first ChildOutletView filtered by the outlet_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByAddressName(string $address_name) Return the first ChildOutletView filtered by the address_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletAddress(string $outlet_address) Return the first ChildOutletView filtered by the outlet_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletStreetName(string $outlet_street_name) Return the first ChildOutletView filtered by the outlet_street_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletCity(string $outlet_city) Return the first ChildOutletView filtered by the outlet_city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletState(string $outlet_state) Return the first ChildOutletView filtered by the outlet_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletCountry(string $outlet_country) Return the first ChildOutletView filtered by the outlet_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletPincode(string $outlet_pincode) Return the first ChildOutletView filtered by the outlet_pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByLastVisitDate(string $last_visit_date) Return the first ChildOutletView filtered by the last_visit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByLastVisitEmployee(int $last_visit_employee) Return the first ChildOutletView filtered by the last_visit_employee column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOutletView filtered by the outlet_org_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneBySgpiBrandMap(string $sgpi_brand_map) Return the first ChildOutletView filtered by the sgpi_brand_map column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOutletView requireOneBySgpiBrandIdMap(string $sgpi_brand_id_map) Return the first ChildOutletView filtered by the sgpi_brand_id_map column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOutletView[]|Collection find(?ConnectionInterface $con = null) Return ChildOutletView objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOutletView> find(?ConnectionInterface $con = null) Return ChildOutletView objects based on current ModelCriteria
 *
 * @method     ChildOutletView[]|Collection findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletView objects filtered by the outlet_org_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletOrgId(int|array<int> $outlet_org_id) Return ChildOutletView objects filtered by the outlet_org_id column
 * @method     ChildOutletView[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletView objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOutletView objects filtered by the org_unit_id column
 * @method     ChildOutletView[]|Collection findByTerritoryId(int|array<int> $territory_id) Return ChildOutletView objects filtered by the territory_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByTerritoryId(int|array<int> $territory_id) Return ChildOutletView objects filtered by the territory_id column
 * @method     ChildOutletView[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildOutletView objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByBeatId(int|array<int> $beat_id) Return ChildOutletView objects filtered by the beat_id column
 * @method     ChildOutletView[]|Collection findByPositionId(int|array<int> $position_id) Return ChildOutletView objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByPositionId(int|array<int> $position_id) Return ChildOutletView objects filtered by the position_id column
 * @method     ChildOutletView[]|Collection findByTerritoryName(string|array<string> $territory_name) Return ChildOutletView objects filtered by the territory_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByTerritoryName(string|array<string> $territory_name) Return ChildOutletView objects filtered by the territory_name column
 * @method     ChildOutletView[]|Collection findByPositionName(string|array<string> $position_name) Return ChildOutletView objects filtered by the position_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByPositionName(string|array<string> $position_name) Return ChildOutletView objects filtered by the position_name column
 * @method     ChildOutletView[]|Collection findByBeatName(string|array<string> $beat_name) Return ChildOutletView objects filtered by the beat_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByBeatName(string|array<string> $beat_name) Return ChildOutletView objects filtered by the beat_name column
 * @method     ChildOutletView[]|Collection findByTags(string|array<string> $tags) Return ChildOutletView objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByTags(string|array<string> $tags) Return ChildOutletView objects filtered by the tags column
 * @method     ChildOutletView[]|Collection findByVisitFq(int|array<int> $visit_fq) Return ChildOutletView objects filtered by the visit_fq column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByVisitFq(int|array<int> $visit_fq) Return ChildOutletView objects filtered by the visit_fq column
 * @method     ChildOutletView[]|Collection findByComments(string|array<string> $comments) Return ChildOutletView objects filtered by the comments column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByComments(string|array<string> $comments) Return ChildOutletView objects filtered by the comments column
 * @method     ChildOutletView[]|Collection findByOrgPotential(int|array<int> $org_potential) Return ChildOutletView objects filtered by the org_potential column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOrgPotential(int|array<int> $org_potential) Return ChildOutletView objects filtered by the org_potential column
 * @method     ChildOutletView[]|Collection findByBrandFocus(string|array<string> $brand_focus) Return ChildOutletView objects filtered by the brand_focus column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByBrandFocus(string|array<string> $brand_focus) Return ChildOutletView objects filtered by the brand_focus column
 * @method     ChildOutletView[]|Collection findByCustomerFq(string|array<string> $customer_fq) Return ChildOutletView objects filtered by the customer_fq column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByCustomerFq(string|array<string> $customer_fq) Return ChildOutletView objects filtered by the customer_fq column
 * @method     ChildOutletView[]|Collection findByOutlet_Id(int|array<int> $id) Return ChildOutletView objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutlet_Id(int|array<int> $id) Return ChildOutletView objects filtered by the id column
 * @method     ChildOutletView[]|Collection findByOutletMediaId(string|array<string> $outlet_media_id) Return ChildOutletView objects filtered by the outlet_media_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletMediaId(string|array<string> $outlet_media_id) Return ChildOutletView objects filtered by the outlet_media_id column
 * @method     ChildOutletView[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildOutletView objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletName(string|array<string> $outlet_name) Return ChildOutletView objects filtered by the outlet_name column
 * @method     ChildOutletView[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildOutletView objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletCode(string|array<string> $outlet_code) Return ChildOutletView objects filtered by the outlet_code column
 * @method     ChildOutletView[]|Collection findByOutletEmail(string|array<string> $outlet_email) Return ChildOutletView objects filtered by the outlet_email column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletEmail(string|array<string> $outlet_email) Return ChildOutletView objects filtered by the outlet_email column
 * @method     ChildOutletView[]|Collection findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutletView objects filtered by the outlet_salutation column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletSalutation(string|array<string> $outlet_salutation) Return ChildOutletView objects filtered by the outlet_salutation column
 * @method     ChildOutletView[]|Collection findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutletView objects filtered by the outlet_classification column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletClassification(int|array<int> $outlet_classification) Return ChildOutletView objects filtered by the outlet_classification column
 * @method     ChildOutletView[]|Collection findByClassification(string|array<string> $classification) Return ChildOutletView objects filtered by the classification column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByClassification(string|array<string> $classification) Return ChildOutletView objects filtered by the classification column
 * @method     ChildOutletView[]|Collection findByOutletOpening_date(string|array<string> $outlet_opening_date) Return ChildOutletView objects filtered by the outlet_opening_date column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletOpening_date(string|array<string> $outlet_opening_date) Return ChildOutletView objects filtered by the outlet_opening_date column
 * @method     ChildOutletView[]|Collection findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildOutletView objects filtered by the outlet_contact_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletContactName(string|array<string> $outlet_contact_name) Return ChildOutletView objects filtered by the outlet_contact_name column
 * @method     ChildOutletView[]|Collection findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildOutletView objects filtered by the outlet_landlineno column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletLandlineno(string|array<string> $outlet_landlineno) Return ChildOutletView objects filtered by the outlet_landlineno column
 * @method     ChildOutletView[]|Collection findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildOutletView objects filtered by the outlet_alt_landlineno column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletAltLandlineno(string|array<string> $outlet_alt_landlineno) Return ChildOutletView objects filtered by the outlet_alt_landlineno column
 * @method     ChildOutletView[]|Collection findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildOutletView objects filtered by the outlet_contact_bday column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletContactBday(string|array<string> $outlet_contact_bday) Return ChildOutletView objects filtered by the outlet_contact_bday column
 * @method     ChildOutletView[]|Collection findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildOutletView objects filtered by the outlet_contact_anniversary column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletContactAnniversary(string|array<string> $outlet_contact_anniversary) Return ChildOutletView objects filtered by the outlet_contact_anniversary column
 * @method     ChildOutletView[]|Collection findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildOutletView objects filtered by the outlet_isd_code column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletIsdCode(string|array<string> $outlet_isd_code) Return ChildOutletView objects filtered by the outlet_isd_code column
 * @method     ChildOutletView[]|Collection findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutletView objects filtered by the outlet_contact_no column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletContactNo(string|array<string> $outlet_contact_no) Return ChildOutletView objects filtered by the outlet_contact_no column
 * @method     ChildOutletView[]|Collection findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildOutletView objects filtered by the outlet_alt_contact_no column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletAltContactNo(string|array<string> $outlet_alt_contact_no) Return ChildOutletView objects filtered by the outlet_alt_contact_no column
 * @method     ChildOutletView[]|Collection findByOutletStatus(string|array<string> $outlet_status) Return ChildOutletView objects filtered by the outlet_status column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletStatus(string|array<string> $outlet_status) Return ChildOutletView objects filtered by the outlet_status column
 * @method     ChildOutletView[]|Collection findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletView objects filtered by the outlettype_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutlettypeId(int|array<int> $outlettype_id) Return ChildOutletView objects filtered by the outlettype_id column
 * @method     ChildOutletView[]|Collection findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletView objects filtered by the outlettype_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutlettypeName(string|array<string> $outlettype_name) Return ChildOutletView objects filtered by the outlettype_name column
 * @method     ChildOutletView[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOutletView objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByCompanyId(int|array<int> $company_id) Return ChildOutletView objects filtered by the company_id column
 * @method     ChildOutletView[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOutletView objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByCreatedAt(string|array<string> $created_at) Return ChildOutletView objects filtered by the created_at column
 * @method     ChildOutletView[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletView objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByUpdatedAt(string|array<string> $updated_at) Return ChildOutletView objects filtered by the updated_at column
 * @method     ChildOutletView[]|Collection findByOutletOtp(string|array<string> $outlet_otp) Return ChildOutletView objects filtered by the outlet_otp column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletOtp(string|array<string> $outlet_otp) Return ChildOutletView objects filtered by the outlet_otp column
 * @method     ChildOutletView[]|Collection findByOutletVerified(string|array<string> $outlet_verified) Return ChildOutletView objects filtered by the outlet_verified column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletVerified(string|array<string> $outlet_verified) Return ChildOutletView objects filtered by the outlet_verified column
 * @method     ChildOutletView[]|Collection findByOutletCreatedBy(int|array<int> $outlet_created_by) Return ChildOutletView objects filtered by the outlet_created_by column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletCreatedBy(int|array<int> $outlet_created_by) Return ChildOutletView objects filtered by the outlet_created_by column
 * @method     ChildOutletView[]|Collection findByOutletApprovedBy(int|array<int> $outlet_approved_by) Return ChildOutletView objects filtered by the outlet_approved_by column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletApprovedBy(int|array<int> $outlet_approved_by) Return ChildOutletView objects filtered by the outlet_approved_by column
 * @method     ChildOutletView[]|Collection findByOutletPotential(string|array<string> $outlet_potential) Return ChildOutletView objects filtered by the outlet_potential column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletPotential(string|array<string> $outlet_potential) Return ChildOutletView objects filtered by the outlet_potential column
 * @method     ChildOutletView[]|Collection findByIntegrationId(string|array<string> $integration_id) Return ChildOutletView objects filtered by the integration_id column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByIntegrationId(string|array<string> $integration_id) Return ChildOutletView objects filtered by the integration_id column
 * @method     ChildOutletView[]|Collection findByItownid(int|array<int> $itownid) Return ChildOutletView objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByItownid(int|array<int> $itownid) Return ChildOutletView objects filtered by the itownid column
 * @method     ChildOutletView[]|Collection findByOutletQualification(string|array<string> $outlet_qualification) Return ChildOutletView objects filtered by the outlet_qualification column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletQualification(string|array<string> $outlet_qualification) Return ChildOutletView objects filtered by the outlet_qualification column
 * @method     ChildOutletView[]|Collection findByOutletRegno(string|array<string> $outlet_regno) Return ChildOutletView objects filtered by the outlet_regno column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletRegno(string|array<string> $outlet_regno) Return ChildOutletView objects filtered by the outlet_regno column
 * @method     ChildOutletView[]|Collection findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildOutletView objects filtered by the outlet_marital_status column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletMaritalStatus(string|array<string> $outlet_marital_status) Return ChildOutletView objects filtered by the outlet_marital_status column
 * @method     ChildOutletView[]|Collection findByOutletMedia(string|array<string> $outlet_media) Return ChildOutletView objects filtered by the outlet_media column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletMedia(string|array<string> $outlet_media) Return ChildOutletView objects filtered by the outlet_media column
 * @method     ChildOutletView[]|Collection findByAddressName(string|array<string> $address_name) Return ChildOutletView objects filtered by the address_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByAddressName(string|array<string> $address_name) Return ChildOutletView objects filtered by the address_name column
 * @method     ChildOutletView[]|Collection findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletView objects filtered by the outlet_address column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletAddress(string|array<string> $outlet_address) Return ChildOutletView objects filtered by the outlet_address column
 * @method     ChildOutletView[]|Collection findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletView objects filtered by the outlet_street_name column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletStreetName(string|array<string> $outlet_street_name) Return ChildOutletView objects filtered by the outlet_street_name column
 * @method     ChildOutletView[]|Collection findByOutletCity(string|array<string> $outlet_city) Return ChildOutletView objects filtered by the outlet_city column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletCity(string|array<string> $outlet_city) Return ChildOutletView objects filtered by the outlet_city column
 * @method     ChildOutletView[]|Collection findByOutletState(string|array<string> $outlet_state) Return ChildOutletView objects filtered by the outlet_state column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletState(string|array<string> $outlet_state) Return ChildOutletView objects filtered by the outlet_state column
 * @method     ChildOutletView[]|Collection findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletView objects filtered by the outlet_country column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletCountry(string|array<string> $outlet_country) Return ChildOutletView objects filtered by the outlet_country column
 * @method     ChildOutletView[]|Collection findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletView objects filtered by the outlet_pincode column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletPincode(string|array<string> $outlet_pincode) Return ChildOutletView objects filtered by the outlet_pincode column
 * @method     ChildOutletView[]|Collection findByLastVisitDate(string|array<string> $last_visit_date) Return ChildOutletView objects filtered by the last_visit_date column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByLastVisitDate(string|array<string> $last_visit_date) Return ChildOutletView objects filtered by the last_visit_date column
 * @method     ChildOutletView[]|Collection findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildOutletView objects filtered by the last_visit_employee column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByLastVisitEmployee(int|array<int> $last_visit_employee) Return ChildOutletView objects filtered by the last_visit_employee column
 * @method     ChildOutletView[]|Collection findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOutletView objects filtered by the outlet_org_code column
 * @psalm-method Collection&\Traversable<ChildOutletView> findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOutletView objects filtered by the outlet_org_code column
 * @method     ChildOutletView[]|Collection findBySgpiBrandMap(string|array<string> $sgpi_brand_map) Return ChildOutletView objects filtered by the sgpi_brand_map column
 * @psalm-method Collection&\Traversable<ChildOutletView> findBySgpiBrandMap(string|array<string> $sgpi_brand_map) Return ChildOutletView objects filtered by the sgpi_brand_map column
 * @method     ChildOutletView[]|Collection findBySgpiBrandIdMap(string|array<string> $sgpi_brand_id_map) Return ChildOutletView objects filtered by the sgpi_brand_id_map column
 * @psalm-method Collection&\Traversable<ChildOutletView> findBySgpiBrandIdMap(string|array<string> $sgpi_brand_id_map) Return ChildOutletView objects filtered by the sgpi_brand_id_map column
 *
 * @method     ChildOutletView[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOutletView> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OutletViewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OutletViewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OutletView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOutletViewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOutletViewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOutletViewQuery) {
            return $criteria;
        }
        $query = new ChildOutletViewQuery();
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
     * @return ChildOutletView|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OutletViewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OutletViewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOutletView A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT outlet_org_id, org_unit_id, territory_id, beat_id, position_id, territory_name, position_name, beat_name, tags, visit_fq, comments, org_potential, brand_focus, customer_fq, id, outlet_media_id, outlet_name, outlet_code, outlet_email, outlet_salutation, outlet_classification, classification, outlet_opening_date, outlet_contact_name, outlet_landlineno, outlet_alt_landlineno, outlet_contact_bday, outlet_contact_anniversary, outlet_isd_code, outlet_contact_no, outlet_alt_contact_no, outlet_status, outlettype_id, outlettype_name, company_id, created_at, updated_at, outlet_otp, outlet_verified, outlet_created_by, outlet_approved_by, outlet_potential, integration_id, itownid, outlet_qualification, outlet_regno, outlet_marital_status, outlet_media, address_name, outlet_address, outlet_street_name, outlet_city, outlet_state, outlet_country, outlet_pincode, last_visit_date, last_visit_employee, outlet_org_code, sgpi_brand_map, sgpi_brand_id_map FROM outlet_view WHERE outlet_org_id = :p0';
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
            /** @var ChildOutletView $obj */
            $obj = new ChildOutletView();
            $obj->hydrate($row);
            OutletViewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOutletView|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $outletOrgId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_TERRITORY_ID, $territoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territoryId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_TERRITORY_ID, $territoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_TERRITORY_ID, $territoryId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_BEAT_ID, $beatId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_POSITION_ID, $positionId, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_TERRITORY_NAME, $territoryName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_POSITION_NAME, $positionName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_BEAT_NAME, $beatName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_TAGS, $tags, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_VISIT_FQ, $visitFq['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFq['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_VISIT_FQ, $visitFq['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_VISIT_FQ, $visitFq, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_COMMENTS, $comments, $comparison);

        return $this;
    }

    /**
     * Filter the query on the org_potential column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgPotential(1234); // WHERE org_potential = 1234
     * $query->filterByOrgPotential(array(12, 34)); // WHERE org_potential IN (12, 34)
     * $query->filterByOrgPotential(array('min' => 12)); // WHERE org_potential > 12
     * </code>
     *
     * @param mixed $orgPotential The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgPotential($orgPotential = null, ?string $comparison = null)
    {
        if (is_array($orgPotential)) {
            $useMinMax = false;
            if (isset($orgPotential['min'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ORG_POTENTIAL, $orgPotential['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgPotential['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ORG_POTENTIAL, $orgPotential['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_ORG_POTENTIAL, $orgPotential, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_BRAND_FOCUS, $brandFocus, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_CUSTOMER_FQ, $customerFq, $comparison);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutlet_Id(1234); // WHERE id = 1234
     * $query->filterByOutlet_Id(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterByOutlet_Id(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $outlet_Id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlet_Id($outlet_Id = null, ?string $comparison = null)
    {
        if (is_array($outlet_Id)) {
            $useMinMax = false;
            if (isset($outlet_Id['min'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ID, $outlet_Id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlet_Id['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ID, $outlet_Id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_ID, $outlet_Id, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_MEDIA_ID, $outletMediaId, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_EMAIL, $outletEmail, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_SALUTATION, $outletSalutation, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletClassification['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CLASSIFICATION, $outletClassification, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_CLASSIFICATION, $classification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_opening_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOpening_date('2011-03-14'); // WHERE outlet_opening_date = '2011-03-14'
     * $query->filterByOutletOpening_date('now'); // WHERE outlet_opening_date = '2011-03-14'
     * $query->filterByOutletOpening_date(array('max' => 'yesterday')); // WHERE outlet_opening_date > '2011-03-13'
     * </code>
     *
     * @param mixed $outletOpening_date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOpening_date($outletOpening_date = null, ?string $comparison = null)
    {
        if (is_array($outletOpening_date)) {
            $useMinMax = false;
            if (isset($outletOpening_date['min'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpening_date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOpening_date['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpening_date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_OPENING_DATE, $outletOpening_date, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_NAME, $outletContactName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_LANDLINENO, $outletLandlineno, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO, $outletAltLandlineno, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactBday['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY, $outletContactBday, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletContactAnniversary['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $outletContactAnniversary, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ISD_CODE, $outletIsdCode, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CONTACT_NO, $outletContactNo, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO, $outletAltContactNo, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_STATUS, $outletStatus, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outlettypeId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLETTYPE_ID, $outlettypeId, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLETTYPE_NAME, $outlettypeName, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_otp column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletOtp('fooValue');   // WHERE outlet_otp = 'fooValue'
     * $query->filterByOutletOtp('%fooValue%', Criteria::LIKE); // WHERE outlet_otp LIKE '%fooValue%'
     * $query->filterByOutletOtp(['foo', 'bar']); // WHERE outlet_otp IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletOtp The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletOtp($outletOtp = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletOtp)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_OTP, $outletOtp, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_verified column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletVerified('fooValue');   // WHERE outlet_verified = 'fooValue'
     * $query->filterByOutletVerified('%fooValue%', Criteria::LIKE); // WHERE outlet_verified LIKE '%fooValue%'
     * $query->filterByOutletVerified(['foo', 'bar']); // WHERE outlet_verified IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $outletVerified The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletVerified($outletVerified = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($outletVerified)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_VERIFIED, $outletVerified, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletCreatedBy['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CREATED_BY, $outletCreatedBy, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletApprovedBy['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_APPROVED_BY, $outletApprovedBy, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_POTENTIAL, $outletPotential, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_INTEGRATION_ID, $integrationId, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_ITOWNID, $itownid, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_QUALIFICATION, $outletQualification, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_REGNO, $outletRegno, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_MARITAL_STATUS, $outletMaritalStatus, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_MEDIA, $outletMedia, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_ADDRESS_NAME, $addressName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ADDRESS, $outletAddress, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_STREET_NAME, $outletStreetName, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_CITY, $outletCity, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_STATE, $outletState, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_COUNTRY, $outletCountry, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_PINCODE, $outletPincode, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitDate['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_DATE, $lastVisitDate, $comparison);

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
                $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastVisitEmployee['max'])) {
                $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE, $lastVisitEmployee, $comparison);

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

        $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_CODE, $outletOrgCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_brand_map column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiBrandMap('fooValue');   // WHERE sgpi_brand_map = 'fooValue'
     * $query->filterBySgpiBrandMap('%fooValue%', Criteria::LIKE); // WHERE sgpi_brand_map LIKE '%fooValue%'
     * $query->filterBySgpiBrandMap(['foo', 'bar']); // WHERE sgpi_brand_map IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiBrandMap The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiBrandMap($sgpiBrandMap = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiBrandMap)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_SGPI_BRAND_MAP, $sgpiBrandMap, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_brand_id_map column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiBrandIdMap('fooValue');   // WHERE sgpi_brand_id_map = 'fooValue'
     * $query->filterBySgpiBrandIdMap('%fooValue%', Criteria::LIKE); // WHERE sgpi_brand_id_map LIKE '%fooValue%'
     * $query->filterBySgpiBrandIdMap(['foo', 'bar']); // WHERE sgpi_brand_id_map IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiBrandIdMap The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiBrandIdMap($sgpiBrandIdMap = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiBrandIdMap)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OutletViewTableMap::COL_SGPI_BRAND_ID_MAP, $sgpiBrandIdMap, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOutletView $outletView Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($outletView = null)
    {
        if ($outletView) {
            $this->addUsingAlias(OutletViewTableMap::COL_OUTLET_ORG_ID, $outletView->getOutletOrgId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

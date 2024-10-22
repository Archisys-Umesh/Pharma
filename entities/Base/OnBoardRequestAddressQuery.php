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
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\Map\OnBoardRequestAddressTableMap;

/**
 * Base class that represents a query for the `on_board_request_address` table.
 *
 * @method     ChildOnBoardRequestAddressQuery orderByOnBoardRequestAddressId($order = Criteria::ASC) Order by the on_board_request_address_id column
 * @method     ChildOnBoardRequestAddressQuery orderByOutletSubTypeId($order = Criteria::ASC) Order by the outlet_sub_type_id column
 * @method     ChildOnBoardRequestAddressQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildOnBoardRequestAddressQuery orderByLandmark($order = Criteria::ASC) Order by the landmark column
 * @method     ChildOnBoardRequestAddressQuery orderByIcityid($order = Criteria::ASC) Order by the icityid column
 * @method     ChildOnBoardRequestAddressQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildOnBoardRequestAddressQuery orderByIstateid($order = Criteria::ASC) Order by the istateid column
 * @method     ChildOnBoardRequestAddressQuery orderByPincode($order = Criteria::ASC) Order by the pincode column
 * @method     ChildOnBoardRequestAddressQuery orderByOutletOrgDataId($order = Criteria::ASC) Order by the outlet_org_data_id column
 * @method     ChildOnBoardRequestAddressQuery orderBySpeciality($order = Criteria::ASC) Order by the speciality column
 * @method     ChildOnBoardRequestAddressQuery orderByPotential($order = Criteria::ASC) Order by the potential column
 * @method     ChildOnBoardRequestAddressQuery orderByVisitFrequency($order = Criteria::ASC) Order by the visit_frequency column
 * @method     ChildOnBoardRequestAddressQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method     ChildOnBoardRequestAddressQuery orderByFocusBrand($order = Criteria::ASC) Order by the focus_brand column
 * @method     ChildOnBoardRequestAddressQuery orderBySpportDocuments($order = Criteria::ASC) Order by the spport_documents column
 * @method     ChildOnBoardRequestAddressQuery orderByOrgUnitId($order = Criteria::ASC) Order by the org_unit_id column
 * @method     ChildOnBoardRequestAddressQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOnBoardRequestAddressQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOnBoardRequestAddressQuery orderByAddressId($order = Criteria::ASC) Order by the address_id column
 * @method     ChildOnBoardRequestAddressQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOnBoardRequestAddressQuery orderByBeatId($order = Criteria::ASC) Order by the beat_id column
 * @method     ChildOnBoardRequestAddressQuery orderByOnBoardRequestId($order = Criteria::ASC) Order by the on_board_request_id column
 * @method     ChildOnBoardRequestAddressQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOnBoardRequestAddressQuery orderByInvestedAmount($order = Criteria::ASC) Order by the invested_amount column
 * @method     ChildOnBoardRequestAddressQuery orderByOutletOrgCode($order = Criteria::ASC) Order by the outlet_org_code column
 *
 * @method     ChildOnBoardRequestAddressQuery groupByOnBoardRequestAddressId() Group by the on_board_request_address_id column
 * @method     ChildOnBoardRequestAddressQuery groupByOutletSubTypeId() Group by the outlet_sub_type_id column
 * @method     ChildOnBoardRequestAddressQuery groupByAddress() Group by the address column
 * @method     ChildOnBoardRequestAddressQuery groupByLandmark() Group by the landmark column
 * @method     ChildOnBoardRequestAddressQuery groupByIcityid() Group by the icityid column
 * @method     ChildOnBoardRequestAddressQuery groupByItownid() Group by the itownid column
 * @method     ChildOnBoardRequestAddressQuery groupByIstateid() Group by the istateid column
 * @method     ChildOnBoardRequestAddressQuery groupByPincode() Group by the pincode column
 * @method     ChildOnBoardRequestAddressQuery groupByOutletOrgDataId() Group by the outlet_org_data_id column
 * @method     ChildOnBoardRequestAddressQuery groupBySpeciality() Group by the speciality column
 * @method     ChildOnBoardRequestAddressQuery groupByPotential() Group by the potential column
 * @method     ChildOnBoardRequestAddressQuery groupByVisitFrequency() Group by the visit_frequency column
 * @method     ChildOnBoardRequestAddressQuery groupByTags() Group by the tags column
 * @method     ChildOnBoardRequestAddressQuery groupByFocusBrand() Group by the focus_brand column
 * @method     ChildOnBoardRequestAddressQuery groupBySpportDocuments() Group by the spport_documents column
 * @method     ChildOnBoardRequestAddressQuery groupByOrgUnitId() Group by the org_unit_id column
 * @method     ChildOnBoardRequestAddressQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOnBoardRequestAddressQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOnBoardRequestAddressQuery groupByAddressId() Group by the address_id column
 * @method     ChildOnBoardRequestAddressQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOnBoardRequestAddressQuery groupByBeatId() Group by the beat_id column
 * @method     ChildOnBoardRequestAddressQuery groupByOnBoardRequestId() Group by the on_board_request_id column
 * @method     ChildOnBoardRequestAddressQuery groupByStatus() Group by the status column
 * @method     ChildOnBoardRequestAddressQuery groupByInvestedAmount() Group by the invested_amount column
 * @method     ChildOnBoardRequestAddressQuery groupByOutletOrgCode() Group by the outlet_org_code column
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnBoardRequestAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnBoardRequestAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnBoardRequestAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnBoardRequestAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOutletAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOutletAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAddress relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOutletAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAddress relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOutletAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOutletAddress() Adds a LEFT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOutletAddress() Adds a RIGHT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOutletAddress() Adds a INNER JOIN clause and with to the query using the OutletAddress relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinBrands($relationAlias = null) Adds a LEFT JOIN clause to the query using the Brands relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinBrands($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Brands relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinBrands($relationAlias = null) Adds a INNER JOIN clause to the query using the Brands relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithBrands($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Brands relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithBrands() Adds a LEFT JOIN clause and with to the query using the Brands relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithBrands() Adds a RIGHT JOIN clause and with to the query using the Brands relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithBrands() Adds a INNER JOIN clause and with to the query using the Brands relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinClassification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Classification relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinClassification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Classification relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinClassification($relationAlias = null) Adds a INNER JOIN clause to the query using the Classification relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithClassification($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Classification relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithClassification() Adds a LEFT JOIN clause and with to the query using the Classification relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithClassification() Adds a RIGHT JOIN clause and with to the query using the Classification relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithClassification() Adds a INNER JOIN clause and with to the query using the Classification relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOutletTags($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletTags relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOutletTags($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletTags relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOutletTags($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletTags relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOutletTags($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletTags relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOutletTags() Adds a LEFT JOIN clause and with to the query using the OutletTags relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOutletTags() Adds a RIGHT JOIN clause and with to the query using the OutletTags relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOutletTags() Adds a INNER JOIN clause and with to the query using the OutletTags relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinGeoCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCity relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinGeoCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCity relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinGeoCity($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCity relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithGeoCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCity relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithGeoCity() Adds a LEFT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithGeoCity() Adds a RIGHT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithGeoCity() Adds a INNER JOIN clause and with to the query using the GeoCity relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinGeoState($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoState relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinGeoState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoState relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinGeoState($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoState relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithGeoState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoState relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithGeoState() Adds a LEFT JOIN clause and with to the query using the GeoState relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithGeoState() Adds a RIGHT JOIN clause and with to the query using the GeoState relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithGeoState() Adds a INNER JOIN clause and with to the query using the GeoState relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinGeoTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinGeoTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoTowns relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinGeoTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoTowns relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithGeoTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithGeoTowns() Adds a LEFT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithGeoTowns() Adds a RIGHT JOIN clause and with to the query using the GeoTowns relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithGeoTowns() Adds a INNER JOIN clause and with to the query using the GeoTowns relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOnBoardRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOnBoardRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOnBoardRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOnBoardRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOnBoardRequest() Adds a LEFT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOnBoardRequest() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequest relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOnBoardRequest() Adds a INNER JOIN clause and with to the query using the OnBoardRequest relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOrgUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOrgUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrgUnit relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOrgUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOrgUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOrgUnit() Adds a LEFT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOrgUnit() Adds a RIGHT JOIN clause and with to the query using the OrgUnit relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOrgUnit() Adds a INNER JOIN clause and with to the query using the OrgUnit relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequestAddressQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequestAddressQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequestAddressQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequestAddressQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     \entities\OutletAddressQuery|\entities\BrandsQuery|\entities\ClassificationQuery|\entities\OutletTagsQuery|\entities\BeatsQuery|\entities\CompanyQuery|\entities\GeoCityQuery|\entities\GeoStateQuery|\entities\GeoTownsQuery|\entities\OnBoardRequestQuery|\entities\OrgUnitQuery|\entities\OutletOrgDataQuery|\entities\OutletTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOnBoardRequestAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestAddress matching the query
 * @method     ChildOnBoardRequestAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestAddress matching the query, or a new ChildOnBoardRequestAddress object populated from the query conditions when no match is found
 *
 * @method     ChildOnBoardRequestAddress|null findOneByOnBoardRequestAddressId(int $on_board_request_address_id) Return the first ChildOnBoardRequestAddress filtered by the on_board_request_address_id column
 * @method     ChildOnBoardRequestAddress|null findOneByOutletSubTypeId(int $outlet_sub_type_id) Return the first ChildOnBoardRequestAddress filtered by the outlet_sub_type_id column
 * @method     ChildOnBoardRequestAddress|null findOneByAddress(string $address) Return the first ChildOnBoardRequestAddress filtered by the address column
 * @method     ChildOnBoardRequestAddress|null findOneByLandmark(string $landmark) Return the first ChildOnBoardRequestAddress filtered by the landmark column
 * @method     ChildOnBoardRequestAddress|null findOneByIcityid(int $icityid) Return the first ChildOnBoardRequestAddress filtered by the icityid column
 * @method     ChildOnBoardRequestAddress|null findOneByItownid(int $itownid) Return the first ChildOnBoardRequestAddress filtered by the itownid column
 * @method     ChildOnBoardRequestAddress|null findOneByIstateid(int $istateid) Return the first ChildOnBoardRequestAddress filtered by the istateid column
 * @method     ChildOnBoardRequestAddress|null findOneByPincode(string $pincode) Return the first ChildOnBoardRequestAddress filtered by the pincode column
 * @method     ChildOnBoardRequestAddress|null findOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildOnBoardRequestAddress filtered by the outlet_org_data_id column
 * @method     ChildOnBoardRequestAddress|null findOneBySpeciality(int $speciality) Return the first ChildOnBoardRequestAddress filtered by the speciality column
 * @method     ChildOnBoardRequestAddress|null findOneByPotential(string $potential) Return the first ChildOnBoardRequestAddress filtered by the potential column
 * @method     ChildOnBoardRequestAddress|null findOneByVisitFrequency(int $visit_frequency) Return the first ChildOnBoardRequestAddress filtered by the visit_frequency column
 * @method     ChildOnBoardRequestAddress|null findOneByTags(int $tags) Return the first ChildOnBoardRequestAddress filtered by the tags column
 * @method     ChildOnBoardRequestAddress|null findOneByFocusBrand(int $focus_brand) Return the first ChildOnBoardRequestAddress filtered by the focus_brand column
 * @method     ChildOnBoardRequestAddress|null findOneBySpportDocuments(string $spport_documents) Return the first ChildOnBoardRequestAddress filtered by the spport_documents column
 * @method     ChildOnBoardRequestAddress|null findOneByOrgUnitId(int $org_unit_id) Return the first ChildOnBoardRequestAddress filtered by the org_unit_id column
 * @method     ChildOnBoardRequestAddress|null findOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestAddress filtered by the created_at column
 * @method     ChildOnBoardRequestAddress|null findOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequestAddress filtered by the updated_at column
 * @method     ChildOnBoardRequestAddress|null findOneByAddressId(int $address_id) Return the first ChildOnBoardRequestAddress filtered by the address_id column
 * @method     ChildOnBoardRequestAddress|null findOneByCompanyId(int $company_id) Return the first ChildOnBoardRequestAddress filtered by the company_id column
 * @method     ChildOnBoardRequestAddress|null findOneByBeatId(int $beat_id) Return the first ChildOnBoardRequestAddress filtered by the beat_id column
 * @method     ChildOnBoardRequestAddress|null findOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestAddress filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestAddress|null findOneByStatus(string $status) Return the first ChildOnBoardRequestAddress filtered by the status column
 * @method     ChildOnBoardRequestAddress|null findOneByInvestedAmount(string $invested_amount) Return the first ChildOnBoardRequestAddress filtered by the invested_amount column
 * @method     ChildOnBoardRequestAddress|null findOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOnBoardRequestAddress filtered by the outlet_org_code column
 *
 * @method     ChildOnBoardRequestAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnBoardRequestAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequestAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestAddress requireOneByOnBoardRequestAddressId(int $on_board_request_address_id) Return the first ChildOnBoardRequestAddress filtered by the on_board_request_address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByOutletSubTypeId(int $outlet_sub_type_id) Return the first ChildOnBoardRequestAddress filtered by the outlet_sub_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByAddress(string $address) Return the first ChildOnBoardRequestAddress filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByLandmark(string $landmark) Return the first ChildOnBoardRequestAddress filtered by the landmark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByIcityid(int $icityid) Return the first ChildOnBoardRequestAddress filtered by the icityid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByItownid(int $itownid) Return the first ChildOnBoardRequestAddress filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByIstateid(int $istateid) Return the first ChildOnBoardRequestAddress filtered by the istateid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByPincode(string $pincode) Return the first ChildOnBoardRequestAddress filtered by the pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByOutletOrgDataId(int $outlet_org_data_id) Return the first ChildOnBoardRequestAddress filtered by the outlet_org_data_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneBySpeciality(int $speciality) Return the first ChildOnBoardRequestAddress filtered by the speciality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByPotential(string $potential) Return the first ChildOnBoardRequestAddress filtered by the potential column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByVisitFrequency(int $visit_frequency) Return the first ChildOnBoardRequestAddress filtered by the visit_frequency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByTags(int $tags) Return the first ChildOnBoardRequestAddress filtered by the tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByFocusBrand(int $focus_brand) Return the first ChildOnBoardRequestAddress filtered by the focus_brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneBySpportDocuments(string $spport_documents) Return the first ChildOnBoardRequestAddress filtered by the spport_documents column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByOrgUnitId(int $org_unit_id) Return the first ChildOnBoardRequestAddress filtered by the org_unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequestAddress filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequestAddress filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByAddressId(int $address_id) Return the first ChildOnBoardRequestAddress filtered by the address_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByCompanyId(int $company_id) Return the first ChildOnBoardRequestAddress filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByBeatId(int $beat_id) Return the first ChildOnBoardRequestAddress filtered by the beat_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequestAddress filtered by the on_board_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByStatus(string $status) Return the first ChildOnBoardRequestAddress filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByInvestedAmount(string $invested_amount) Return the first ChildOnBoardRequestAddress filtered by the invested_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequestAddress requireOneByOutletOrgCode(string $outlet_org_code) Return the first ChildOnBoardRequestAddress filtered by the outlet_org_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequestAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildOnBoardRequestAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> find(?ConnectionInterface $con = null) Return ChildOnBoardRequestAddress objects based on current ModelCriteria
 *
 * @method     ChildOnBoardRequestAddress[]|Collection findByOnBoardRequestAddressId(int|array<int> $on_board_request_address_id) Return ChildOnBoardRequestAddress objects filtered by the on_board_request_address_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOnBoardRequestAddressId(int|array<int> $on_board_request_address_id) Return ChildOnBoardRequestAddress objects filtered by the on_board_request_address_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByOutletSubTypeId(int|array<int> $outlet_sub_type_id) Return ChildOnBoardRequestAddress objects filtered by the outlet_sub_type_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOutletSubTypeId(int|array<int> $outlet_sub_type_id) Return ChildOnBoardRequestAddress objects filtered by the outlet_sub_type_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByAddress(string|array<string> $address) Return ChildOnBoardRequestAddress objects filtered by the address column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByAddress(string|array<string> $address) Return ChildOnBoardRequestAddress objects filtered by the address column
 * @method     ChildOnBoardRequestAddress[]|Collection findByLandmark(string|array<string> $landmark) Return ChildOnBoardRequestAddress objects filtered by the landmark column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByLandmark(string|array<string> $landmark) Return ChildOnBoardRequestAddress objects filtered by the landmark column
 * @method     ChildOnBoardRequestAddress[]|Collection findByIcityid(int|array<int> $icityid) Return ChildOnBoardRequestAddress objects filtered by the icityid column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByIcityid(int|array<int> $icityid) Return ChildOnBoardRequestAddress objects filtered by the icityid column
 * @method     ChildOnBoardRequestAddress[]|Collection findByItownid(int|array<int> $itownid) Return ChildOnBoardRequestAddress objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByItownid(int|array<int> $itownid) Return ChildOnBoardRequestAddress objects filtered by the itownid column
 * @method     ChildOnBoardRequestAddress[]|Collection findByIstateid(int|array<int> $istateid) Return ChildOnBoardRequestAddress objects filtered by the istateid column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByIstateid(int|array<int> $istateid) Return ChildOnBoardRequestAddress objects filtered by the istateid column
 * @method     ChildOnBoardRequestAddress[]|Collection findByPincode(string|array<string> $pincode) Return ChildOnBoardRequestAddress objects filtered by the pincode column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByPincode(string|array<string> $pincode) Return ChildOnBoardRequestAddress objects filtered by the pincode column
 * @method     ChildOnBoardRequestAddress[]|Collection findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildOnBoardRequestAddress objects filtered by the outlet_org_data_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOutletOrgDataId(int|array<int> $outlet_org_data_id) Return ChildOnBoardRequestAddress objects filtered by the outlet_org_data_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findBySpeciality(int|array<int> $speciality) Return ChildOnBoardRequestAddress objects filtered by the speciality column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findBySpeciality(int|array<int> $speciality) Return ChildOnBoardRequestAddress objects filtered by the speciality column
 * @method     ChildOnBoardRequestAddress[]|Collection findByPotential(string|array<string> $potential) Return ChildOnBoardRequestAddress objects filtered by the potential column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByPotential(string|array<string> $potential) Return ChildOnBoardRequestAddress objects filtered by the potential column
 * @method     ChildOnBoardRequestAddress[]|Collection findByVisitFrequency(int|array<int> $visit_frequency) Return ChildOnBoardRequestAddress objects filtered by the visit_frequency column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByVisitFrequency(int|array<int> $visit_frequency) Return ChildOnBoardRequestAddress objects filtered by the visit_frequency column
 * @method     ChildOnBoardRequestAddress[]|Collection findByTags(int|array<int> $tags) Return ChildOnBoardRequestAddress objects filtered by the tags column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByTags(int|array<int> $tags) Return ChildOnBoardRequestAddress objects filtered by the tags column
 * @method     ChildOnBoardRequestAddress[]|Collection findByFocusBrand(int|array<int> $focus_brand) Return ChildOnBoardRequestAddress objects filtered by the focus_brand column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByFocusBrand(int|array<int> $focus_brand) Return ChildOnBoardRequestAddress objects filtered by the focus_brand column
 * @method     ChildOnBoardRequestAddress[]|Collection findBySpportDocuments(string|array<string> $spport_documents) Return ChildOnBoardRequestAddress objects filtered by the spport_documents column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findBySpportDocuments(string|array<string> $spport_documents) Return ChildOnBoardRequestAddress objects filtered by the spport_documents column
 * @method     ChildOnBoardRequestAddress[]|Collection findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOnBoardRequestAddress objects filtered by the org_unit_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOrgUnitId(int|array<int> $org_unit_id) Return ChildOnBoardRequestAddress objects filtered by the org_unit_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestAddress objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequestAddress objects filtered by the created_at column
 * @method     ChildOnBoardRequestAddress[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequestAddress objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequestAddress objects filtered by the updated_at column
 * @method     ChildOnBoardRequestAddress[]|Collection findByAddressId(int|array<int> $address_id) Return ChildOnBoardRequestAddress objects filtered by the address_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByAddressId(int|array<int> $address_id) Return ChildOnBoardRequestAddress objects filtered by the address_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequestAddress objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequestAddress objects filtered by the company_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByBeatId(int|array<int> $beat_id) Return ChildOnBoardRequestAddress objects filtered by the beat_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByBeatId(int|array<int> $beat_id) Return ChildOnBoardRequestAddress objects filtered by the beat_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestAddress objects filtered by the on_board_request_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequestAddress objects filtered by the on_board_request_id column
 * @method     ChildOnBoardRequestAddress[]|Collection findByStatus(string|array<string> $status) Return ChildOnBoardRequestAddress objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByStatus(string|array<string> $status) Return ChildOnBoardRequestAddress objects filtered by the status column
 * @method     ChildOnBoardRequestAddress[]|Collection findByInvestedAmount(string|array<string> $invested_amount) Return ChildOnBoardRequestAddress objects filtered by the invested_amount column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByInvestedAmount(string|array<string> $invested_amount) Return ChildOnBoardRequestAddress objects filtered by the invested_amount column
 * @method     ChildOnBoardRequestAddress[]|Collection findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOnBoardRequestAddress objects filtered by the outlet_org_code column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequestAddress> findByOutletOrgCode(string|array<string> $outlet_org_code) Return ChildOnBoardRequestAddress objects filtered by the outlet_org_code column
 *
 * @method     ChildOnBoardRequestAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnBoardRequestAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnBoardRequestAddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnBoardRequestAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnBoardRequestAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnBoardRequestAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnBoardRequestAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnBoardRequestAddressQuery) {
            return $criteria;
        }
        $query = new ChildOnBoardRequestAddressQuery();
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
     * @return ChildOnBoardRequestAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnBoardRequestAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnBoardRequestAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_address_id, outlet_sub_type_id, address, landmark, icityid, itownid, istateid, pincode, outlet_org_data_id, speciality, potential, visit_frequency, tags, focus_brand, spport_documents, org_unit_id, created_at, updated_at, address_id, company_id, beat_id, on_board_request_id, status, invested_amount, outlet_org_code FROM on_board_request_address WHERE on_board_request_address_id = :p0';
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
            /** @var ChildOnBoardRequestAddress $obj */
            $obj = new ChildOnBoardRequestAddress();
            $obj->hydrate($row);
            OnBoardRequestAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnBoardRequestAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestAddressId(1234); // WHERE on_board_request_address_id = 1234
     * $query->filterByOnBoardRequestAddressId(array(12, 34)); // WHERE on_board_request_address_id IN (12, 34)
     * $query->filterByOnBoardRequestAddressId(array('min' => 12)); // WHERE on_board_request_address_id > 12
     * </code>
     *
     * @param mixed $onBoardRequestAddressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestAddressId($onBoardRequestAddressId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestAddressId)) {
            $useMinMax = false;
            if (isset($onBoardRequestAddressId['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestAddressId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddressId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_sub_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletSubTypeId(1234); // WHERE outlet_sub_type_id = 1234
     * $query->filterByOutletSubTypeId(array(12, 34)); // WHERE outlet_sub_type_id IN (12, 34)
     * $query->filterByOutletSubTypeId(array('min' => 12)); // WHERE outlet_sub_type_id > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outletSubTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletSubTypeId($outletSubTypeId = null, ?string $comparison = null)
    {
        if (is_array($outletSubTypeId)) {
            $useMinMax = false;
            if (isset($outletSubTypeId['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $outletSubTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletSubTypeId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $outletSubTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $outletSubTypeId, $comparison);

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

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS, $address, $comparison);

        return $this;
    }

    /**
     * Filter the query on the landmark column
     *
     * Example usage:
     * <code>
     * $query->filterByLandmark('fooValue');   // WHERE landmark = 'fooValue'
     * $query->filterByLandmark('%fooValue%', Criteria::LIKE); // WHERE landmark LIKE '%fooValue%'
     * $query->filterByLandmark(['foo', 'bar']); // WHERE landmark IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $landmark The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLandmark($landmark = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($landmark)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_LANDMARK, $landmark, $comparison);

        return $this;
    }

    /**
     * Filter the query on the icityid column
     *
     * Example usage:
     * <code>
     * $query->filterByIcityid(1234); // WHERE icityid = 1234
     * $query->filterByIcityid(array(12, 34)); // WHERE icityid IN (12, 34)
     * $query->filterByIcityid(array('min' => 12)); // WHERE icityid > 12
     * </code>
     *
     * @see       filterByGeoCity()
     *
     * @param mixed $icityid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIcityid($icityid = null, ?string $comparison = null)
    {
        if (is_array($icityid)) {
            $useMinMax = false;
            if (isset($icityid['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ICITYID, $icityid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($icityid['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ICITYID, $icityid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ICITYID, $icityid, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the istateid column
     *
     * Example usage:
     * <code>
     * $query->filterByIstateid(1234); // WHERE istateid = 1234
     * $query->filterByIstateid(array(12, 34)); // WHERE istateid IN (12, 34)
     * $query->filterByIstateid(array('min' => 12)); // WHERE istateid > 12
     * </code>
     *
     * @see       filterByGeoState()
     *
     * @param mixed $istateid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIstateid($istateid = null, ?string $comparison = null)
    {
        if (is_array($istateid)) {
            $useMinMax = false;
            if (isset($istateid['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ISTATEID, $istateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($istateid['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ISTATEID, $istateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ISTATEID, $istateid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pincode column
     *
     * Example usage:
     * <code>
     * $query->filterByPincode('fooValue');   // WHERE pincode = 'fooValue'
     * $query->filterByPincode('%fooValue%', Criteria::LIKE); // WHERE pincode LIKE '%fooValue%'
     * $query->filterByPincode(['foo', 'bar']); // WHERE pincode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pincode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPincode($pincode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pincode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_PINCODE, $pincode, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletOrgDataId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgDataId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the speciality column
     *
     * Example usage:
     * <code>
     * $query->filterBySpeciality(1234); // WHERE speciality = 1234
     * $query->filterBySpeciality(array(12, 34)); // WHERE speciality IN (12, 34)
     * $query->filterBySpeciality(array('min' => 12)); // WHERE speciality > 12
     * </code>
     *
     * @see       filterByClassification()
     *
     * @param mixed $speciality The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpeciality($speciality = null, ?string $comparison = null)
    {
        if (is_array($speciality)) {
            $useMinMax = false;
            if (isset($speciality['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPECIALITY, $speciality['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($speciality['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPECIALITY, $speciality['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPECIALITY, $speciality, $comparison);

        return $this;
    }

    /**
     * Filter the query on the potential column
     *
     * Example usage:
     * <code>
     * $query->filterByPotential('fooValue');   // WHERE potential = 'fooValue'
     * $query->filterByPotential('%fooValue%', Criteria::LIKE); // WHERE potential LIKE '%fooValue%'
     * $query->filterByPotential(['foo', 'bar']); // WHERE potential IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $potential The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPotential($potential = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($potential)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_POTENTIAL, $potential, $comparison);

        return $this;
    }

    /**
     * Filter the query on the visit_frequency column
     *
     * Example usage:
     * <code>
     * $query->filterByVisitFrequency(1234); // WHERE visit_frequency = 1234
     * $query->filterByVisitFrequency(array(12, 34)); // WHERE visit_frequency IN (12, 34)
     * $query->filterByVisitFrequency(array('min' => 12)); // WHERE visit_frequency > 12
     * </code>
     *
     * @param mixed $visitFrequency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVisitFrequency($visitFrequency = null, ?string $comparison = null)
    {
        if (is_array($visitFrequency)) {
            $useMinMax = false;
            if (isset($visitFrequency['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY, $visitFrequency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($visitFrequency['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY, $visitFrequency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY, $visitFrequency, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags(1234); // WHERE tags = 1234
     * $query->filterByTags(array(12, 34)); // WHERE tags IN (12, 34)
     * $query->filterByTags(array('min' => 12)); // WHERE tags > 12
     * </code>
     *
     * @see       filterByOutletTags()
     *
     * @param mixed $tags The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTags($tags = null, ?string $comparison = null)
    {
        if (is_array($tags)) {
            $useMinMax = false;
            if (isset($tags['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_TAGS, $tags['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tags['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_TAGS, $tags['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_TAGS, $tags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the focus_brand column
     *
     * Example usage:
     * <code>
     * $query->filterByFocusBrand(1234); // WHERE focus_brand = 1234
     * $query->filterByFocusBrand(array(12, 34)); // WHERE focus_brand IN (12, 34)
     * $query->filterByFocusBrand(array('min' => 12)); // WHERE focus_brand > 12
     * </code>
     *
     * @see       filterByBrands()
     *
     * @param mixed $focusBrand The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFocusBrand($focusBrand = null, ?string $comparison = null)
    {
        if (is_array($focusBrand)) {
            $useMinMax = false;
            if (isset($focusBrand['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $focusBrand['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($focusBrand['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $focusBrand['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $focusBrand, $comparison);

        return $this;
    }

    /**
     * Filter the query on the spport_documents column
     *
     * Example usage:
     * <code>
     * $query->filterBySpportDocuments('fooValue');   // WHERE spport_documents = 'fooValue'
     * $query->filterBySpportDocuments('%fooValue%', Criteria::LIKE); // WHERE spport_documents LIKE '%fooValue%'
     * $query->filterBySpportDocuments(['foo', 'bar']); // WHERE spport_documents IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $spportDocuments The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpportDocuments($spportDocuments = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($spportDocuments)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS, $spportDocuments, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $orgUnitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgUnitId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $orgUnitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $orgUnitId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the address_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressId(1234); // WHERE address_id = 1234
     * $query->filterByAddressId(array(12, 34)); // WHERE address_id IN (12, 34)
     * $query->filterByAddressId(array('min' => 12)); // WHERE address_id > 12
     * </code>
     *
     * @see       filterByOutletAddress()
     *
     * @param mixed $addressId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddressId($addressId = null, ?string $comparison = null)
    {
        if (is_array($addressId)) {
            $useMinMax = false;
            if (isset($addressId['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $addressId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $addressId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $addressId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $companyId, $comparison);

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
     * @see       filterByBeats()
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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_BEAT_ID, $beatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($beatId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_BEAT_ID, $beatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_BEAT_ID, $beatId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the on_board_request_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOnBoardRequestId(1234); // WHERE on_board_request_id = 1234
     * $query->filterByOnBoardRequestId(array(12, 34)); // WHERE on_board_request_id IN (12, 34)
     * $query->filterByOnBoardRequestId(array('min' => 12)); // WHERE on_board_request_id > 12
     * </code>
     *
     * @see       filterByOnBoardRequest()
     *
     * @param mixed $onBoardRequestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestId($onBoardRequestId = null, ?string $comparison = null)
    {
        if (is_array($onBoardRequestId)) {
            $useMinMax = false;
            if (isset($onBoardRequestId['min'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestId['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId, $comparison);

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

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT, $investedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($investedAmount['max'])) {
                $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT, $investedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT, $investedAmount, $comparison);

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

        $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE, $outletOrgCode, $comparison);

        return $this;
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
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $outletAddress->getOutletAddressId(), $comparison);
        } elseif ($outletAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $outletAddress->toKeyValue('PrimaryKey', 'OutletAddressId'), $comparison);

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
     * Filter the query by a related \entities\Brands object
     *
     * @param \entities\Brands|ObjectCollection $brands The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrands($brands, ?string $comparison = null)
    {
        if ($brands instanceof \entities\Brands) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $brands->getBrandId(), $comparison);
        } elseif ($brands instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $brands->toKeyValue('PrimaryKey', 'BrandId'), $comparison);

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
     * Filter the query by a related \entities\Classification object
     *
     * @param \entities\Classification|ObjectCollection $classification The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByClassification($classification, ?string $comparison = null)
    {
        if ($classification instanceof \entities\Classification) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPECIALITY, $classification->getId(), $comparison);
        } elseif ($classification instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_SPECIALITY, $classification->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
    public function joinClassification(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useClassificationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\OutletTags object
     *
     * @param \entities\OutletTags|ObjectCollection $outletTags The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTags($outletTags, ?string $comparison = null)
    {
        if ($outletTags instanceof \entities\OutletTags) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_TAGS, $outletTags->getOutletTagId(), $comparison);
        } elseif ($outletTags instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_TAGS, $outletTags->toKeyValue('PrimaryKey', 'OutletTagId'), $comparison);

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
     * Filter the query by a related \entities\Beats object
     *
     * @param \entities\Beats|ObjectCollection $beats The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBeats($beats, ?string $comparison = null)
    {
        if ($beats instanceof \entities\Beats) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_BEAT_ID, $beats->getBeatId(), $comparison);
        } elseif ($beats instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_BEAT_ID, $beats->toKeyValue('PrimaryKey', 'BeatId'), $comparison);

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
    public function joinBeats(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useBeatsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\GeoCity object
     *
     * @param \entities\GeoCity|ObjectCollection $geoCity The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoCity($geoCity, ?string $comparison = null)
    {
        if ($geoCity instanceof \entities\GeoCity) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ICITYID, $geoCity->getIcityid(), $comparison);
        } elseif ($geoCity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ICITYID, $geoCity->toKeyValue('PrimaryKey', 'Icityid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoCity() only accepts arguments of type \entities\GeoCity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoCity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoCity(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoCity');

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
            $this->addJoinObject($join, 'GeoCity');
        }

        return $this;
    }

    /**
     * Use the GeoCity relation GeoCity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoCityQuery A secondary query class using the current class as primary query
     */
    public function useGeoCityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoCity', '\entities\GeoCityQuery');
    }

    /**
     * Use the GeoCity relation GeoCity object
     *
     * @param callable(\entities\GeoCityQuery):\entities\GeoCityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoCityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoCityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoCity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoCityQuery The inner query object of the EXISTS statement
     */
    public function useGeoCityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useExistsQuery('GeoCity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoCity table for a NOT EXISTS query.
     *
     * @see useGeoCityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCityQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoCityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useExistsQuery('GeoCity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoCity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoCityQuery The inner query object of the IN statement
     */
    public function useInGeoCityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useInQuery('GeoCity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoCity table for a NOT IN query.
     *
     * @see useGeoCityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoCityQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoCityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoCityQuery */
        $q = $this->useInQuery('GeoCity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoState object
     *
     * @param \entities\GeoState|ObjectCollection $geoState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoState($geoState, ?string $comparison = null)
    {
        if ($geoState instanceof \entities\GeoState) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ISTATEID, $geoState->getIstateid(), $comparison);
        } elseif ($geoState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ISTATEID, $geoState->toKeyValue('PrimaryKey', 'Istateid'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGeoState() only accepts arguments of type \entities\GeoState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoState relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoState(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoState');

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
            $this->addJoinObject($join, 'GeoState');
        }

        return $this;
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoStateQuery A secondary query class using the current class as primary query
     */
    public function useGeoStateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGeoState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoState', '\entities\GeoStateQuery');
    }

    /**
     * Use the GeoState relation GeoState object
     *
     * @param callable(\entities\GeoStateQuery):\entities\GeoStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useGeoStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GeoState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoStateQuery The inner query object of the EXISTS statement
     */
    public function useGeoStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT EXISTS query.
     *
     * @see useGeoStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useExistsQuery('GeoState', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GeoState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoStateQuery The inner query object of the IN statement
     */
    public function useInGeoStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GeoState table for a NOT IN query.
     *
     * @see useGeoStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoStateQuery */
        $q = $this->useInQuery('GeoState', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ITOWNID, $geoTowns->getItownid(), $comparison);
        } elseif ($geoTowns instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ITOWNID, $geoTowns->toKeyValue('PrimaryKey', 'Itownid'), $comparison);

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
     * Filter the query by a related \entities\OnBoardRequest object
     *
     * @param \entities\OnBoardRequest|ObjectCollection $onBoardRequest The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequest($onBoardRequest, ?string $comparison = null)
    {
        if ($onBoardRequest instanceof \entities\OnBoardRequest) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->getOnBoardRequestId(), $comparison);
        } elseif ($onBoardRequest instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->toKeyValue('PrimaryKey', 'OnBoardRequestId'), $comparison);

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
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $orgUnit->getOrgunitid(), $comparison);
        } elseif ($orgUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $orgUnit->toKeyValue('PrimaryKey', 'Orgunitid'), $comparison);

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
    public function joinOrgUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useOrgUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->getOutletOrgId(), $comparison);
        } elseif ($outletOrgData instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $outletOrgData->toKeyValue('PrimaryKey', 'OutletOrgId'), $comparison);

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
     * Filter the query by a related \entities\OutletType object
     *
     * @param \entities\OutletType|ObjectCollection $outletType The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletType($outletType, ?string $comparison = null)
    {
        if ($outletType instanceof \entities\OutletType) {
            return $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

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
    public function joinOutletType(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useOutletTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Exclude object from result
     *
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onBoardRequestAddress = null)
    {
        if ($onBoardRequestAddress) {
            $this->addUsingAlias(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $onBoardRequestAddress->getOnBoardRequestAddressId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the on_board_request_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OnBoardRequestAddressTableMap::clearInstancePool();
            OnBoardRequestAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OnBoardRequestAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OnBoardRequestAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OnBoardRequestAddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

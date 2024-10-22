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
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\Map\GeoTownsTableMap;

/**
 * Base class that represents a query for the `geo_towns` table.
 *
 * @method     ChildGeoTownsQuery orderByItownid($order = Criteria::ASC) Order by the itownid column
 * @method     ChildGeoTownsQuery orderByStownname($order = Criteria::ASC) Order by the stownname column
 * @method     ChildGeoTownsQuery orderByIcityid($order = Criteria::ASC) Order by the icityid column
 * @method     ChildGeoTownsQuery orderByStowncode($order = Criteria::ASC) Order by the stowncode column
 * @method     ChildGeoTownsQuery orderByDcreateddate($order = Criteria::ASC) Order by the dcreateddate column
 * @method     ChildGeoTownsQuery orderByDmodifydate($order = Criteria::ASC) Order by the dmodifydate column
 * @method     ChildGeoTownsQuery orderBySstatus($order = Criteria::ASC) Order by the sstatus column
 * @method     ChildGeoTownsQuery orderByPincode($order = Criteria::ASC) Order by the pincode column
 *
 * @method     ChildGeoTownsQuery groupByItownid() Group by the itownid column
 * @method     ChildGeoTownsQuery groupByStownname() Group by the stownname column
 * @method     ChildGeoTownsQuery groupByIcityid() Group by the icityid column
 * @method     ChildGeoTownsQuery groupByStowncode() Group by the stowncode column
 * @method     ChildGeoTownsQuery groupByDcreateddate() Group by the dcreateddate column
 * @method     ChildGeoTownsQuery groupByDmodifydate() Group by the dmodifydate column
 * @method     ChildGeoTownsQuery groupBySstatus() Group by the sstatus column
 * @method     ChildGeoTownsQuery groupByPincode() Group by the pincode column
 *
 * @method     ChildGeoTownsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeoTownsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeoTownsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeoTownsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeoTownsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeoTownsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeoTownsQuery leftJoinGeoCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoTownsQuery rightJoinGeoCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoCity relation
 * @method     ChildGeoTownsQuery innerJoinGeoCity($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoCity relation
 *
 * @method     ChildGeoTownsQuery joinWithGeoCity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithGeoCity() Adds a LEFT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoTownsQuery rightJoinWithGeoCity() Adds a RIGHT JOIN clause and with to the query using the GeoCity relation
 * @method     ChildGeoTownsQuery innerJoinWithGeoCity() Adds a INNER JOIN clause and with to the query using the GeoCity relation
 *
 * @method     ChildGeoTownsQuery leftJoinAttendanceRelatedByEndItownid($relationAlias = null) Adds a LEFT JOIN clause to the query using the AttendanceRelatedByEndItownid relation
 * @method     ChildGeoTownsQuery rightJoinAttendanceRelatedByEndItownid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AttendanceRelatedByEndItownid relation
 * @method     ChildGeoTownsQuery innerJoinAttendanceRelatedByEndItownid($relationAlias = null) Adds a INNER JOIN clause to the query using the AttendanceRelatedByEndItownid relation
 *
 * @method     ChildGeoTownsQuery joinWithAttendanceRelatedByEndItownid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AttendanceRelatedByEndItownid relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithAttendanceRelatedByEndItownid() Adds a LEFT JOIN clause and with to the query using the AttendanceRelatedByEndItownid relation
 * @method     ChildGeoTownsQuery rightJoinWithAttendanceRelatedByEndItownid() Adds a RIGHT JOIN clause and with to the query using the AttendanceRelatedByEndItownid relation
 * @method     ChildGeoTownsQuery innerJoinWithAttendanceRelatedByEndItownid() Adds a INNER JOIN clause and with to the query using the AttendanceRelatedByEndItownid relation
 *
 * @method     ChildGeoTownsQuery leftJoinAttendanceRelatedByStartItownid($relationAlias = null) Adds a LEFT JOIN clause to the query using the AttendanceRelatedByStartItownid relation
 * @method     ChildGeoTownsQuery rightJoinAttendanceRelatedByStartItownid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AttendanceRelatedByStartItownid relation
 * @method     ChildGeoTownsQuery innerJoinAttendanceRelatedByStartItownid($relationAlias = null) Adds a INNER JOIN clause to the query using the AttendanceRelatedByStartItownid relation
 *
 * @method     ChildGeoTownsQuery joinWithAttendanceRelatedByStartItownid($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AttendanceRelatedByStartItownid relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithAttendanceRelatedByStartItownid() Adds a LEFT JOIN clause and with to the query using the AttendanceRelatedByStartItownid relation
 * @method     ChildGeoTownsQuery rightJoinWithAttendanceRelatedByStartItownid() Adds a RIGHT JOIN clause and with to the query using the AttendanceRelatedByStartItownid relation
 * @method     ChildGeoTownsQuery innerJoinWithAttendanceRelatedByStartItownid() Adds a INNER JOIN clause and with to the query using the AttendanceRelatedByStartItownid relation
 *
 * @method     ChildGeoTownsQuery leftJoinBeats($relationAlias = null) Adds a LEFT JOIN clause to the query using the Beats relation
 * @method     ChildGeoTownsQuery rightJoinBeats($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Beats relation
 * @method     ChildGeoTownsQuery innerJoinBeats($relationAlias = null) Adds a INNER JOIN clause to the query using the Beats relation
 *
 * @method     ChildGeoTownsQuery joinWithBeats($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Beats relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithBeats() Adds a LEFT JOIN clause and with to the query using the Beats relation
 * @method     ChildGeoTownsQuery rightJoinWithBeats() Adds a RIGHT JOIN clause and with to the query using the Beats relation
 * @method     ChildGeoTownsQuery innerJoinWithBeats() Adds a INNER JOIN clause and with to the query using the Beats relation
 *
 * @method     ChildGeoTownsQuery leftJoinCitycategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Citycategory relation
 * @method     ChildGeoTownsQuery rightJoinCitycategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Citycategory relation
 * @method     ChildGeoTownsQuery innerJoinCitycategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Citycategory relation
 *
 * @method     ChildGeoTownsQuery joinWithCitycategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Citycategory relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithCitycategory() Adds a LEFT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildGeoTownsQuery rightJoinWithCitycategory() Adds a RIGHT JOIN clause and with to the query using the Citycategory relation
 * @method     ChildGeoTownsQuery innerJoinWithCitycategory() Adds a INNER JOIN clause and with to the query using the Citycategory relation
 *
 * @method     ChildGeoTownsQuery leftJoinDailycalls($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dailycalls relation
 * @method     ChildGeoTownsQuery rightJoinDailycalls($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dailycalls relation
 * @method     ChildGeoTownsQuery innerJoinDailycalls($relationAlias = null) Adds a INNER JOIN clause to the query using the Dailycalls relation
 *
 * @method     ChildGeoTownsQuery joinWithDailycalls($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dailycalls relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithDailycalls() Adds a LEFT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildGeoTownsQuery rightJoinWithDailycalls() Adds a RIGHT JOIN clause and with to the query using the Dailycalls relation
 * @method     ChildGeoTownsQuery innerJoinWithDailycalls() Adds a INNER JOIN clause and with to the query using the Dailycalls relation
 *
 * @method     ChildGeoTownsQuery leftJoinDayplan($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dayplan relation
 * @method     ChildGeoTownsQuery rightJoinDayplan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dayplan relation
 * @method     ChildGeoTownsQuery innerJoinDayplan($relationAlias = null) Adds a INNER JOIN clause to the query using the Dayplan relation
 *
 * @method     ChildGeoTownsQuery joinWithDayplan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dayplan relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithDayplan() Adds a LEFT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildGeoTownsQuery rightJoinWithDayplan() Adds a RIGHT JOIN clause and with to the query using the Dayplan relation
 * @method     ChildGeoTownsQuery innerJoinWithDayplan() Adds a INNER JOIN clause and with to the query using the Dayplan relation
 *
 * @method     ChildGeoTownsQuery leftJoinEmployee($relationAlias = null) Adds a LEFT JOIN clause to the query using the Employee relation
 * @method     ChildGeoTownsQuery rightJoinEmployee($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Employee relation
 * @method     ChildGeoTownsQuery innerJoinEmployee($relationAlias = null) Adds a INNER JOIN clause to the query using the Employee relation
 *
 * @method     ChildGeoTownsQuery joinWithEmployee($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Employee relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithEmployee() Adds a LEFT JOIN clause and with to the query using the Employee relation
 * @method     ChildGeoTownsQuery rightJoinWithEmployee() Adds a RIGHT JOIN clause and with to the query using the Employee relation
 * @method     ChildGeoTownsQuery innerJoinWithEmployee() Adds a INNER JOIN clause and with to the query using the Employee relation
 *
 * @method     ChildGeoTownsQuery leftJoinGeoDistanceRelatedByFromTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoDistanceRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery rightJoinGeoDistanceRelatedByFromTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoDistanceRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery innerJoinGeoDistanceRelatedByFromTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoDistanceRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery joinWithGeoDistanceRelatedByFromTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoDistanceRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithGeoDistanceRelatedByFromTownId() Adds a LEFT JOIN clause and with to the query using the GeoDistanceRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery rightJoinWithGeoDistanceRelatedByFromTownId() Adds a RIGHT JOIN clause and with to the query using the GeoDistanceRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery innerJoinWithGeoDistanceRelatedByFromTownId() Adds a INNER JOIN clause and with to the query using the GeoDistanceRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinGeoDistanceRelatedByToTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the GeoDistanceRelatedByToTownId relation
 * @method     ChildGeoTownsQuery rightJoinGeoDistanceRelatedByToTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GeoDistanceRelatedByToTownId relation
 * @method     ChildGeoTownsQuery innerJoinGeoDistanceRelatedByToTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the GeoDistanceRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery joinWithGeoDistanceRelatedByToTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GeoDistanceRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithGeoDistanceRelatedByToTownId() Adds a LEFT JOIN clause and with to the query using the GeoDistanceRelatedByToTownId relation
 * @method     ChildGeoTownsQuery rightJoinWithGeoDistanceRelatedByToTownId() Adds a RIGHT JOIN clause and with to the query using the GeoDistanceRelatedByToTownId relation
 * @method     ChildGeoTownsQuery innerJoinWithGeoDistanceRelatedByToTownId() Adds a INNER JOIN clause and with to the query using the GeoDistanceRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoTownsQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoTownsQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoTownsQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoTownsQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildGeoTownsQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildGeoTownsQuery leftJoinOutletAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletAddress relation
 * @method     ChildGeoTownsQuery rightJoinOutletAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletAddress relation
 * @method     ChildGeoTownsQuery innerJoinOutletAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletAddress relation
 *
 * @method     ChildGeoTownsQuery joinWithOutletAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletAddress relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithOutletAddress() Adds a LEFT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildGeoTownsQuery rightJoinWithOutletAddress() Adds a RIGHT JOIN clause and with to the query using the OutletAddress relation
 * @method     ChildGeoTownsQuery innerJoinWithOutletAddress() Adds a INNER JOIN clause and with to the query using the OutletAddress relation
 *
 * @method     ChildGeoTownsQuery leftJoinOutletOrgData($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildGeoTownsQuery rightJoinOutletOrgData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletOrgData relation
 * @method     ChildGeoTownsQuery innerJoinOutletOrgData($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletOrgData relation
 *
 * @method     ChildGeoTownsQuery joinWithOutletOrgData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithOutletOrgData() Adds a LEFT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildGeoTownsQuery rightJoinWithOutletOrgData() Adds a RIGHT JOIN clause and with to the query using the OutletOrgData relation
 * @method     ChildGeoTownsQuery innerJoinWithOutletOrgData() Adds a INNER JOIN clause and with to the query using the OutletOrgData relation
 *
 * @method     ChildGeoTownsQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildGeoTownsQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildGeoTownsQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildGeoTownsQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildGeoTownsQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildGeoTownsQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildGeoTownsQuery leftJoinPositions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positions relation
 * @method     ChildGeoTownsQuery rightJoinPositions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positions relation
 * @method     ChildGeoTownsQuery innerJoinPositions($relationAlias = null) Adds a INNER JOIN clause to the query using the Positions relation
 *
 * @method     ChildGeoTownsQuery joinWithPositions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positions relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithPositions() Adds a LEFT JOIN clause and with to the query using the Positions relation
 * @method     ChildGeoTownsQuery rightJoinWithPositions() Adds a RIGHT JOIN clause and with to the query using the Positions relation
 * @method     ChildGeoTownsQuery innerJoinWithPositions() Adds a INNER JOIN clause and with to the query using the Positions relation
 *
 * @method     ChildGeoTownsQuery leftJoinSfcMasterRelatedByFromTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SfcMasterRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery rightJoinSfcMasterRelatedByFromTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SfcMasterRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery innerJoinSfcMasterRelatedByFromTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the SfcMasterRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery joinWithSfcMasterRelatedByFromTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SfcMasterRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithSfcMasterRelatedByFromTownId() Adds a LEFT JOIN clause and with to the query using the SfcMasterRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery rightJoinWithSfcMasterRelatedByFromTownId() Adds a RIGHT JOIN clause and with to the query using the SfcMasterRelatedByFromTownId relation
 * @method     ChildGeoTownsQuery innerJoinWithSfcMasterRelatedByFromTownId() Adds a INNER JOIN clause and with to the query using the SfcMasterRelatedByFromTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinSfcMasterRelatedByToTownId($relationAlias = null) Adds a LEFT JOIN clause to the query using the SfcMasterRelatedByToTownId relation
 * @method     ChildGeoTownsQuery rightJoinSfcMasterRelatedByToTownId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SfcMasterRelatedByToTownId relation
 * @method     ChildGeoTownsQuery innerJoinSfcMasterRelatedByToTownId($relationAlias = null) Adds a INNER JOIN clause to the query using the SfcMasterRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery joinWithSfcMasterRelatedByToTownId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SfcMasterRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithSfcMasterRelatedByToTownId() Adds a LEFT JOIN clause and with to the query using the SfcMasterRelatedByToTownId relation
 * @method     ChildGeoTownsQuery rightJoinWithSfcMasterRelatedByToTownId() Adds a RIGHT JOIN clause and with to the query using the SfcMasterRelatedByToTownId relation
 * @method     ChildGeoTownsQuery innerJoinWithSfcMasterRelatedByToTownId() Adds a INNER JOIN clause and with to the query using the SfcMasterRelatedByToTownId relation
 *
 * @method     ChildGeoTownsQuery leftJoinTerritoryTowns($relationAlias = null) Adds a LEFT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildGeoTownsQuery rightJoinTerritoryTowns($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TerritoryTowns relation
 * @method     ChildGeoTownsQuery innerJoinTerritoryTowns($relationAlias = null) Adds a INNER JOIN clause to the query using the TerritoryTowns relation
 *
 * @method     ChildGeoTownsQuery joinWithTerritoryTowns($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithTerritoryTowns() Adds a LEFT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildGeoTownsQuery rightJoinWithTerritoryTowns() Adds a RIGHT JOIN clause and with to the query using the TerritoryTowns relation
 * @method     ChildGeoTownsQuery innerJoinWithTerritoryTowns() Adds a INNER JOIN clause and with to the query using the TerritoryTowns relation
 *
 * @method     ChildGeoTownsQuery leftJoinTourplans($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tourplans relation
 * @method     ChildGeoTownsQuery rightJoinTourplans($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tourplans relation
 * @method     ChildGeoTownsQuery innerJoinTourplans($relationAlias = null) Adds a INNER JOIN clause to the query using the Tourplans relation
 *
 * @method     ChildGeoTownsQuery joinWithTourplans($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tourplans relation
 *
 * @method     ChildGeoTownsQuery leftJoinWithTourplans() Adds a LEFT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildGeoTownsQuery rightJoinWithTourplans() Adds a RIGHT JOIN clause and with to the query using the Tourplans relation
 * @method     ChildGeoTownsQuery innerJoinWithTourplans() Adds a INNER JOIN clause and with to the query using the Tourplans relation
 *
 * @method     \entities\GeoCityQuery|\entities\AttendanceQuery|\entities\AttendanceQuery|\entities\BeatsQuery|\entities\CitycategoryQuery|\entities\DailycallsQuery|\entities\DayplanQuery|\entities\EmployeeQuery|\entities\GeoDistanceQuery|\entities\GeoDistanceQuery|\entities\OnBoardRequestAddressQuery|\entities\OutletAddressQuery|\entities\OutletOrgDataQuery|\entities\OutletsQuery|\entities\PositionsQuery|\entities\SfcMasterQuery|\entities\SfcMasterQuery|\entities\TerritoryTownsQuery|\entities\TourplansQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeoTowns|null findOne(?ConnectionInterface $con = null) Return the first ChildGeoTowns matching the query
 * @method     ChildGeoTowns findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGeoTowns matching the query, or a new ChildGeoTowns object populated from the query conditions when no match is found
 *
 * @method     ChildGeoTowns|null findOneByItownid(string $itownid) Return the first ChildGeoTowns filtered by the itownid column
 * @method     ChildGeoTowns|null findOneByStownname(string $stownname) Return the first ChildGeoTowns filtered by the stownname column
 * @method     ChildGeoTowns|null findOneByIcityid(string $icityid) Return the first ChildGeoTowns filtered by the icityid column
 * @method     ChildGeoTowns|null findOneByStowncode(string $stowncode) Return the first ChildGeoTowns filtered by the stowncode column
 * @method     ChildGeoTowns|null findOneByDcreateddate(string $dcreateddate) Return the first ChildGeoTowns filtered by the dcreateddate column
 * @method     ChildGeoTowns|null findOneByDmodifydate(string $dmodifydate) Return the first ChildGeoTowns filtered by the dmodifydate column
 * @method     ChildGeoTowns|null findOneBySstatus(string $sstatus) Return the first ChildGeoTowns filtered by the sstatus column
 * @method     ChildGeoTowns|null findOneByPincode(string $pincode) Return the first ChildGeoTowns filtered by the pincode column
 *
 * @method     ChildGeoTowns requirePk($key, ?ConnectionInterface $con = null) Return the ChildGeoTowns by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOne(?ConnectionInterface $con = null) Return the first ChildGeoTowns matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoTowns requireOneByItownid(string $itownid) Return the first ChildGeoTowns filtered by the itownid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByStownname(string $stownname) Return the first ChildGeoTowns filtered by the stownname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByIcityid(string $icityid) Return the first ChildGeoTowns filtered by the icityid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByStowncode(string $stowncode) Return the first ChildGeoTowns filtered by the stowncode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByDcreateddate(string $dcreateddate) Return the first ChildGeoTowns filtered by the dcreateddate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByDmodifydate(string $dmodifydate) Return the first ChildGeoTowns filtered by the dmodifydate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneBySstatus(string $sstatus) Return the first ChildGeoTowns filtered by the sstatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeoTowns requireOneByPincode(string $pincode) Return the first ChildGeoTowns filtered by the pincode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeoTowns[]|Collection find(?ConnectionInterface $con = null) Return ChildGeoTowns objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGeoTowns> find(?ConnectionInterface $con = null) Return ChildGeoTowns objects based on current ModelCriteria
 *
 * @method     ChildGeoTowns[]|Collection findByItownid(string|array<string> $itownid) Return ChildGeoTowns objects filtered by the itownid column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByItownid(string|array<string> $itownid) Return ChildGeoTowns objects filtered by the itownid column
 * @method     ChildGeoTowns[]|Collection findByStownname(string|array<string> $stownname) Return ChildGeoTowns objects filtered by the stownname column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByStownname(string|array<string> $stownname) Return ChildGeoTowns objects filtered by the stownname column
 * @method     ChildGeoTowns[]|Collection findByIcityid(string|array<string> $icityid) Return ChildGeoTowns objects filtered by the icityid column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByIcityid(string|array<string> $icityid) Return ChildGeoTowns objects filtered by the icityid column
 * @method     ChildGeoTowns[]|Collection findByStowncode(string|array<string> $stowncode) Return ChildGeoTowns objects filtered by the stowncode column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByStowncode(string|array<string> $stowncode) Return ChildGeoTowns objects filtered by the stowncode column
 * @method     ChildGeoTowns[]|Collection findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoTowns objects filtered by the dcreateddate column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByDcreateddate(string|array<string> $dcreateddate) Return ChildGeoTowns objects filtered by the dcreateddate column
 * @method     ChildGeoTowns[]|Collection findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoTowns objects filtered by the dmodifydate column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByDmodifydate(string|array<string> $dmodifydate) Return ChildGeoTowns objects filtered by the dmodifydate column
 * @method     ChildGeoTowns[]|Collection findBySstatus(string|array<string> $sstatus) Return ChildGeoTowns objects filtered by the sstatus column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findBySstatus(string|array<string> $sstatus) Return ChildGeoTowns objects filtered by the sstatus column
 * @method     ChildGeoTowns[]|Collection findByPincode(string|array<string> $pincode) Return ChildGeoTowns objects filtered by the pincode column
 * @psalm-method Collection&\Traversable<ChildGeoTowns> findByPincode(string|array<string> $pincode) Return ChildGeoTowns objects filtered by the pincode column
 *
 * @method     ChildGeoTowns[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGeoTowns> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GeoTownsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\GeoTownsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\GeoTowns', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeoTownsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeoTownsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGeoTownsQuery) {
            return $criteria;
        }
        $query = new ChildGeoTownsQuery();
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
     * @return ChildGeoTowns|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GeoTownsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeoTowns A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT itownid, stownname, icityid, stowncode, dcreateddate, dmodifydate, sstatus, pincode FROM geo_towns WHERE itownid = :p0';
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
            /** @var ChildGeoTowns $obj */
            $obj = new ChildGeoTowns();
            $obj->hydrate($row);
            GeoTownsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeoTowns|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $keys, Criteria::IN);

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
                $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $itownid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itownid['max'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $itownid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $itownid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stownname column
     *
     * Example usage:
     * <code>
     * $query->filterByStownname('fooValue');   // WHERE stownname = 'fooValue'
     * $query->filterByStownname('%fooValue%', Criteria::LIKE); // WHERE stownname LIKE '%fooValue%'
     * $query->filterByStownname(['foo', 'bar']); // WHERE stownname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stownname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStownname($stownname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stownname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_STOWNNAME, $stownname, $comparison);

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
                $this->addUsingAlias(GeoTownsTableMap::COL_ICITYID, $icityid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($icityid['max'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_ICITYID, $icityid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_ICITYID, $icityid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stowncode column
     *
     * Example usage:
     * <code>
     * $query->filterByStowncode('fooValue');   // WHERE stowncode = 'fooValue'
     * $query->filterByStowncode('%fooValue%', Criteria::LIKE); // WHERE stowncode LIKE '%fooValue%'
     * $query->filterByStowncode(['foo', 'bar']); // WHERE stowncode IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stowncode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStowncode($stowncode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stowncode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_STOWNCODE, $stowncode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dcreateddate column
     *
     * Example usage:
     * <code>
     * $query->filterByDcreateddate('2011-03-14'); // WHERE dcreateddate = '2011-03-14'
     * $query->filterByDcreateddate('now'); // WHERE dcreateddate = '2011-03-14'
     * $query->filterByDcreateddate(array('max' => 'yesterday')); // WHERE dcreateddate > '2011-03-13'
     * </code>
     *
     * @param mixed $dcreateddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDcreateddate($dcreateddate = null, ?string $comparison = null)
    {
        if (is_array($dcreateddate)) {
            $useMinMax = false;
            if (isset($dcreateddate['min'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_DCREATEDDATE, $dcreateddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dcreateddate['max'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_DCREATEDDATE, $dcreateddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_DCREATEDDATE, $dcreateddate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dmodifydate column
     *
     * Example usage:
     * <code>
     * $query->filterByDmodifydate('2011-03-14'); // WHERE dmodifydate = '2011-03-14'
     * $query->filterByDmodifydate('now'); // WHERE dmodifydate = '2011-03-14'
     * $query->filterByDmodifydate(array('max' => 'yesterday')); // WHERE dmodifydate > '2011-03-13'
     * </code>
     *
     * @param mixed $dmodifydate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDmodifydate($dmodifydate = null, ?string $comparison = null)
    {
        if (is_array($dmodifydate)) {
            $useMinMax = false;
            if (isset($dmodifydate['min'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_DMODIFYDATE, $dmodifydate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dmodifydate['max'])) {
                $this->addUsingAlias(GeoTownsTableMap::COL_DMODIFYDATE, $dmodifydate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_DMODIFYDATE, $dmodifydate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sstatus column
     *
     * Example usage:
     * <code>
     * $query->filterBySstatus('fooValue');   // WHERE sstatus = 'fooValue'
     * $query->filterBySstatus('%fooValue%', Criteria::LIKE); // WHERE sstatus LIKE '%fooValue%'
     * $query->filterBySstatus(['foo', 'bar']); // WHERE sstatus IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sstatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySstatus($sstatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sstatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GeoTownsTableMap::COL_SSTATUS, $sstatus, $comparison);

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

        $this->addUsingAlias(GeoTownsTableMap::COL_PINCODE, $pincode, $comparison);

        return $this;
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
                ->addUsingAlias(GeoTownsTableMap::COL_ICITYID, $geoCity->getIcityid(), $comparison);
        } elseif ($geoCity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ICITYID, $geoCity->toKeyValue('PrimaryKey', 'Icityid'), $comparison);

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
     * Filter the query by a related \entities\Attendance object
     *
     * @param \entities\Attendance|ObjectCollection $attendance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttendanceRelatedByEndItownid($attendance, ?string $comparison = null)
    {
        if ($attendance instanceof \entities\Attendance) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $attendance->getEndItownid(), $comparison);

            return $this;
        } elseif ($attendance instanceof ObjectCollection) {
            $this
                ->useAttendanceRelatedByEndItownidQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAttendanceRelatedByEndItownid() only accepts arguments of type \entities\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AttendanceRelatedByEndItownid relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAttendanceRelatedByEndItownid(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AttendanceRelatedByEndItownid');

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
            $this->addJoinObject($join, 'AttendanceRelatedByEndItownid');
        }

        return $this;
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation Attendance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceRelatedByEndItownidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAttendanceRelatedByEndItownid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AttendanceRelatedByEndItownid', '\entities\AttendanceQuery');
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation Attendance object
     *
     * @param callable(\entities\AttendanceQuery):\entities\AttendanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAttendanceRelatedByEndItownidQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAttendanceRelatedByEndItownidQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation to the Attendance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AttendanceQuery The inner query object of the EXISTS statement
     */
    public function useAttendanceRelatedByEndItownidExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('AttendanceRelatedByEndItownid', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation to the Attendance table for a NOT EXISTS query.
     *
     * @see useAttendanceRelatedByEndItownidExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useAttendanceRelatedByEndItownidNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('AttendanceRelatedByEndItownid', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation to the Attendance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AttendanceQuery The inner query object of the IN statement
     */
    public function useInAttendanceRelatedByEndItownidQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('AttendanceRelatedByEndItownid', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the AttendanceRelatedByEndItownid relation to the Attendance table for a NOT IN query.
     *
     * @see useAttendanceRelatedByEndItownidInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInAttendanceRelatedByEndItownidQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('AttendanceRelatedByEndItownid', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByAttendanceRelatedByStartItownid($attendance, ?string $comparison = null)
    {
        if ($attendance instanceof \entities\Attendance) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $attendance->getStartItownid(), $comparison);

            return $this;
        } elseif ($attendance instanceof ObjectCollection) {
            $this
                ->useAttendanceRelatedByStartItownidQuery()
                ->filterByPrimaryKeys($attendance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAttendanceRelatedByStartItownid() only accepts arguments of type \entities\Attendance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AttendanceRelatedByStartItownid relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAttendanceRelatedByStartItownid(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AttendanceRelatedByStartItownid');

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
            $this->addJoinObject($join, 'AttendanceRelatedByStartItownid');
        }

        return $this;
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation Attendance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\AttendanceQuery A secondary query class using the current class as primary query
     */
    public function useAttendanceRelatedByStartItownidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAttendanceRelatedByStartItownid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AttendanceRelatedByStartItownid', '\entities\AttendanceQuery');
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation Attendance object
     *
     * @param callable(\entities\AttendanceQuery):\entities\AttendanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAttendanceRelatedByStartItownidQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useAttendanceRelatedByStartItownidQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation to the Attendance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\AttendanceQuery The inner query object of the EXISTS statement
     */
    public function useAttendanceRelatedByStartItownidExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('AttendanceRelatedByStartItownid', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation to the Attendance table for a NOT EXISTS query.
     *
     * @see useAttendanceRelatedByStartItownidExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useAttendanceRelatedByStartItownidNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useExistsQuery('AttendanceRelatedByStartItownid', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation to the Attendance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\AttendanceQuery The inner query object of the IN statement
     */
    public function useInAttendanceRelatedByStartItownidQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('AttendanceRelatedByStartItownid', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the AttendanceRelatedByStartItownid relation to the Attendance table for a NOT IN query.
     *
     * @see useAttendanceRelatedByStartItownidInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\AttendanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInAttendanceRelatedByStartItownidQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\AttendanceQuery */
        $q = $this->useInQuery('AttendanceRelatedByStartItownid', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $beats->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $citycategory->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $dailycalls->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $dayplan->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $employee->getItownid(), $comparison);

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
    public function joinEmployee(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmployeeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\GeoDistance object
     *
     * @param \entities\GeoDistance|ObjectCollection $geoDistance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoDistanceRelatedByFromTownId($geoDistance, ?string $comparison = null)
    {
        if ($geoDistance instanceof \entities\GeoDistance) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $geoDistance->getFromTownId(), $comparison);

            return $this;
        } elseif ($geoDistance instanceof ObjectCollection) {
            $this
                ->useGeoDistanceRelatedByFromTownIdQuery()
                ->filterByPrimaryKeys($geoDistance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGeoDistanceRelatedByFromTownId() only accepts arguments of type \entities\GeoDistance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoDistanceRelatedByFromTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoDistanceRelatedByFromTownId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoDistanceRelatedByFromTownId');

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
            $this->addJoinObject($join, 'GeoDistanceRelatedByFromTownId');
        }

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation GeoDistance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoDistanceQuery A secondary query class using the current class as primary query
     */
    public function useGeoDistanceRelatedByFromTownIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeoDistanceRelatedByFromTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoDistanceRelatedByFromTownId', '\entities\GeoDistanceQuery');
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation GeoDistance object
     *
     * @param callable(\entities\GeoDistanceQuery):\entities\GeoDistanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoDistanceRelatedByFromTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGeoDistanceRelatedByFromTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation to the GeoDistance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoDistanceQuery The inner query object of the EXISTS statement
     */
    public function useGeoDistanceRelatedByFromTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByFromTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation to the GeoDistance table for a NOT EXISTS query.
     *
     * @see useGeoDistanceRelatedByFromTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoDistanceRelatedByFromTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByFromTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation to the GeoDistance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoDistanceQuery The inner query object of the IN statement
     */
    public function useInGeoDistanceRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByFromTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByFromTownId relation to the GeoDistance table for a NOT IN query.
     *
     * @see useGeoDistanceRelatedByFromTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoDistanceRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByFromTownId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\GeoDistance object
     *
     * @param \entities\GeoDistance|ObjectCollection $geoDistance the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGeoDistanceRelatedByToTownId($geoDistance, ?string $comparison = null)
    {
        if ($geoDistance instanceof \entities\GeoDistance) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $geoDistance->getToTownId(), $comparison);

            return $this;
        } elseif ($geoDistance instanceof ObjectCollection) {
            $this
                ->useGeoDistanceRelatedByToTownIdQuery()
                ->filterByPrimaryKeys($geoDistance->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByGeoDistanceRelatedByToTownId() only accepts arguments of type \entities\GeoDistance or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GeoDistanceRelatedByToTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGeoDistanceRelatedByToTownId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GeoDistanceRelatedByToTownId');

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
            $this->addJoinObject($join, 'GeoDistanceRelatedByToTownId');
        }

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation GeoDistance object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\GeoDistanceQuery A secondary query class using the current class as primary query
     */
    public function useGeoDistanceRelatedByToTownIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeoDistanceRelatedByToTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GeoDistanceRelatedByToTownId', '\entities\GeoDistanceQuery');
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation GeoDistance object
     *
     * @param callable(\entities\GeoDistanceQuery):\entities\GeoDistanceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGeoDistanceRelatedByToTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGeoDistanceRelatedByToTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation to the GeoDistance table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\GeoDistanceQuery The inner query object of the EXISTS statement
     */
    public function useGeoDistanceRelatedByToTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByToTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation to the GeoDistance table for a NOT EXISTS query.
     *
     * @see useGeoDistanceRelatedByToTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT EXISTS statement
     */
    public function useGeoDistanceRelatedByToTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useExistsQuery('GeoDistanceRelatedByToTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation to the GeoDistance table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\GeoDistanceQuery The inner query object of the IN statement
     */
    public function useInGeoDistanceRelatedByToTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByToTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GeoDistanceRelatedByToTownId relation to the GeoDistance table for a NOT IN query.
     *
     * @see useGeoDistanceRelatedByToTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\GeoDistanceQuery The inner query object of the NOT IN statement
     */
    public function useNotInGeoDistanceRelatedByToTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\GeoDistanceQuery */
        $q = $this->useInQuery('GeoDistanceRelatedByToTownId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $onBoardRequestAddress->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $outletAddress->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $outletOrgData->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $outlets->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $positions->getItownid(), $comparison);

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
     * Filter the query by a related \entities\SfcMaster object
     *
     * @param \entities\SfcMaster|ObjectCollection $sfcMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySfcMasterRelatedByFromTownId($sfcMaster, ?string $comparison = null)
    {
        if ($sfcMaster instanceof \entities\SfcMaster) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $sfcMaster->getFromTownId(), $comparison);

            return $this;
        } elseif ($sfcMaster instanceof ObjectCollection) {
            $this
                ->useSfcMasterRelatedByFromTownIdQuery()
                ->filterByPrimaryKeys($sfcMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySfcMasterRelatedByFromTownId() only accepts arguments of type \entities\SfcMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SfcMasterRelatedByFromTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSfcMasterRelatedByFromTownId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SfcMasterRelatedByFromTownId');

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
            $this->addJoinObject($join, 'SfcMasterRelatedByFromTownId');
        }

        return $this;
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation SfcMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SfcMasterQuery A secondary query class using the current class as primary query
     */
    public function useSfcMasterRelatedByFromTownIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSfcMasterRelatedByFromTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SfcMasterRelatedByFromTownId', '\entities\SfcMasterQuery');
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation SfcMaster object
     *
     * @param callable(\entities\SfcMasterQuery):\entities\SfcMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSfcMasterRelatedByFromTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSfcMasterRelatedByFromTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation to the SfcMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SfcMasterQuery The inner query object of the EXISTS statement
     */
    public function useSfcMasterRelatedByFromTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useExistsQuery('SfcMasterRelatedByFromTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation to the SfcMaster table for a NOT EXISTS query.
     *
     * @see useSfcMasterRelatedByFromTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SfcMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSfcMasterRelatedByFromTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useExistsQuery('SfcMasterRelatedByFromTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation to the SfcMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SfcMasterQuery The inner query object of the IN statement
     */
    public function useInSfcMasterRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useInQuery('SfcMasterRelatedByFromTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByFromTownId relation to the SfcMaster table for a NOT IN query.
     *
     * @see useSfcMasterRelatedByFromTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SfcMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSfcMasterRelatedByFromTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useInQuery('SfcMasterRelatedByFromTownId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\SfcMaster object
     *
     * @param \entities\SfcMaster|ObjectCollection $sfcMaster the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySfcMasterRelatedByToTownId($sfcMaster, ?string $comparison = null)
    {
        if ($sfcMaster instanceof \entities\SfcMaster) {
            $this
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $sfcMaster->getToTownId(), $comparison);

            return $this;
        } elseif ($sfcMaster instanceof ObjectCollection) {
            $this
                ->useSfcMasterRelatedByToTownIdQuery()
                ->filterByPrimaryKeys($sfcMaster->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySfcMasterRelatedByToTownId() only accepts arguments of type \entities\SfcMaster or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SfcMasterRelatedByToTownId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSfcMasterRelatedByToTownId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SfcMasterRelatedByToTownId');

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
            $this->addJoinObject($join, 'SfcMasterRelatedByToTownId');
        }

        return $this;
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation SfcMaster object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\SfcMasterQuery A secondary query class using the current class as primary query
     */
    public function useSfcMasterRelatedByToTownIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSfcMasterRelatedByToTownId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SfcMasterRelatedByToTownId', '\entities\SfcMasterQuery');
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation SfcMaster object
     *
     * @param callable(\entities\SfcMasterQuery):\entities\SfcMasterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSfcMasterRelatedByToTownIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSfcMasterRelatedByToTownIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation to the SfcMaster table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\SfcMasterQuery The inner query object of the EXISTS statement
     */
    public function useSfcMasterRelatedByToTownIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useExistsQuery('SfcMasterRelatedByToTownId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation to the SfcMaster table for a NOT EXISTS query.
     *
     * @see useSfcMasterRelatedByToTownIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\SfcMasterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSfcMasterRelatedByToTownIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useExistsQuery('SfcMasterRelatedByToTownId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation to the SfcMaster table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\SfcMasterQuery The inner query object of the IN statement
     */
    public function useInSfcMasterRelatedByToTownIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useInQuery('SfcMasterRelatedByToTownId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SfcMasterRelatedByToTownId relation to the SfcMaster table for a NOT IN query.
     *
     * @see useSfcMasterRelatedByToTownIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\SfcMasterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSfcMasterRelatedByToTownIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\SfcMasterQuery */
        $q = $this->useInQuery('SfcMasterRelatedByToTownId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $territoryTowns->getItownid(), $comparison);

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
                ->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $tourplans->getItownid(), $comparison);

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
     * @param ChildGeoTowns $geoTowns Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($geoTowns = null)
    {
        if ($geoTowns) {
            $this->addUsingAlias(GeoTownsTableMap::COL_ITOWNID, $geoTowns->getItownid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the geo_towns table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GeoTownsTableMap::clearInstancePool();
            GeoTownsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoTownsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GeoTownsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GeoTownsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GeoTownsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

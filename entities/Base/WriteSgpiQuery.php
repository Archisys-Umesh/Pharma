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
use entities\WriteSgpi as ChildWriteSgpi;
use entities\WriteSgpiQuery as ChildWriteSgpiQuery;
use entities\Map\WriteSgpiTableMap;

/**
 * Base class that represents a query for the `write_sgpi` table.
 *
 * @method     ChildWriteSgpiQuery orderByDivision($order = Criteria::ASC) Order by the division column
 * @method     ChildWriteSgpiQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildWriteSgpiQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildWriteSgpiQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildWriteSgpiQuery orderByLocationCode($order = Criteria::ASC) Order by the location_code column
 * @method     ChildWriteSgpiQuery orderByDrCode($order = Criteria::ASC) Order by the dr_code column
 * @method     ChildWriteSgpiQuery orderByDrName($order = Criteria::ASC) Order by the dr_name column
 * @method     ChildWriteSgpiQuery orderByDrSpecialty($order = Criteria::ASC) Order by the dr_specialty column
 * @method     ChildWriteSgpiQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildWriteSgpiQuery orderByDrTags($order = Criteria::ASC) Order by the dr_tags column
 * @method     ChildWriteSgpiQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildWriteSgpiQuery orderBySgpiTagged($order = Criteria::ASC) Order by the sgpi_tagged column
 * @method     ChildWriteSgpiQuery orderByBrandSgpiDistributed($order = Criteria::ASC) Order by the brand_sgpi_distributed column
 * @method     ChildWriteSgpiQuery orderByMrCallDone($order = Criteria::ASC) Order by the mr_call_done column
 * @method     ChildWriteSgpiQuery orderByAmCallDone($order = Criteria::ASC) Order by the am_call_done column
 * @method     ChildWriteSgpiQuery orderByRmCallDone($order = Criteria::ASC) Order by the rm_call_done column
 * @method     ChildWriteSgpiQuery orderByZmCallDone($order = Criteria::ASC) Order by the zm_call_done column
 * @method     ChildWriteSgpiQuery orderByZmPosition($order = Criteria::ASC) Order by the zm_position column
 * @method     ChildWriteSgpiQuery orderByRmPosition($order = Criteria::ASC) Order by the rm_position column
 * @method     ChildWriteSgpiQuery orderByAmPosition($order = Criteria::ASC) Order by the am_position column
 * @method     ChildWriteSgpiQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildWriteSgpiQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildWriteSgpiQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildWriteSgpiQuery orderByEmployeePositionCode($order = Criteria::ASC) Order by the employee_position_code column
 * @method     ChildWriteSgpiQuery orderByEmployeePositionName($order = Criteria::ASC) Order by the employee_position_name column
 * @method     ChildWriteSgpiQuery orderByEmployeeLevel($order = Criteria::ASC) Order by the employee_level column
 * @method     ChildWriteSgpiQuery orderBySgpiReportId($order = Criteria::ASC) Order by the sgpi_report_id column
 * @method     ChildWriteSgpiQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWriteSgpiQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildWriteSgpiQuery groupByDivision() Group by the division column
 * @method     ChildWriteSgpiQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildWriteSgpiQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildWriteSgpiQuery groupByLocation() Group by the location column
 * @method     ChildWriteSgpiQuery groupByLocationCode() Group by the location_code column
 * @method     ChildWriteSgpiQuery groupByDrCode() Group by the dr_code column
 * @method     ChildWriteSgpiQuery groupByDrName() Group by the dr_name column
 * @method     ChildWriteSgpiQuery groupByDrSpecialty() Group by the dr_specialty column
 * @method     ChildWriteSgpiQuery groupByMonth() Group by the month column
 * @method     ChildWriteSgpiQuery groupByDrTags() Group by the dr_tags column
 * @method     ChildWriteSgpiQuery groupByBrand() Group by the brand column
 * @method     ChildWriteSgpiQuery groupBySgpiTagged() Group by the sgpi_tagged column
 * @method     ChildWriteSgpiQuery groupByBrandSgpiDistributed() Group by the brand_sgpi_distributed column
 * @method     ChildWriteSgpiQuery groupByMrCallDone() Group by the mr_call_done column
 * @method     ChildWriteSgpiQuery groupByAmCallDone() Group by the am_call_done column
 * @method     ChildWriteSgpiQuery groupByRmCallDone() Group by the rm_call_done column
 * @method     ChildWriteSgpiQuery groupByZmCallDone() Group by the zm_call_done column
 * @method     ChildWriteSgpiQuery groupByZmPosition() Group by the zm_position column
 * @method     ChildWriteSgpiQuery groupByRmPosition() Group by the rm_position column
 * @method     ChildWriteSgpiQuery groupByAmPosition() Group by the am_position column
 * @method     ChildWriteSgpiQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildWriteSgpiQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildWriteSgpiQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildWriteSgpiQuery groupByEmployeePositionCode() Group by the employee_position_code column
 * @method     ChildWriteSgpiQuery groupByEmployeePositionName() Group by the employee_position_name column
 * @method     ChildWriteSgpiQuery groupByEmployeeLevel() Group by the employee_level column
 * @method     ChildWriteSgpiQuery groupBySgpiReportId() Group by the sgpi_report_id column
 * @method     ChildWriteSgpiQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWriteSgpiQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildWriteSgpiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWriteSgpiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWriteSgpiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWriteSgpiQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWriteSgpiQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWriteSgpiQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWriteSgpi|null findOne(?ConnectionInterface $con = null) Return the first ChildWriteSgpi matching the query
 * @method     ChildWriteSgpi findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWriteSgpi matching the query, or a new ChildWriteSgpi object populated from the query conditions when no match is found
 *
 * @method     ChildWriteSgpi|null findOneByDivision(string $division) Return the first ChildWriteSgpi filtered by the division column
 * @method     ChildWriteSgpi|null findOneByEmployeeId(int $employee_id) Return the first ChildWriteSgpi filtered by the employee_id column
 * @method     ChildWriteSgpi|null findOneByEmployeeName(string $employee_name) Return the first ChildWriteSgpi filtered by the employee_name column
 * @method     ChildWriteSgpi|null findOneByLocation(string $location) Return the first ChildWriteSgpi filtered by the location column
 * @method     ChildWriteSgpi|null findOneByLocationCode(int $location_code) Return the first ChildWriteSgpi filtered by the location_code column
 * @method     ChildWriteSgpi|null findOneByDrCode(int $dr_code) Return the first ChildWriteSgpi filtered by the dr_code column
 * @method     ChildWriteSgpi|null findOneByDrName(string $dr_name) Return the first ChildWriteSgpi filtered by the dr_name column
 * @method     ChildWriteSgpi|null findOneByDrSpecialty(string $dr_specialty) Return the first ChildWriteSgpi filtered by the dr_specialty column
 * @method     ChildWriteSgpi|null findOneByMonth(string $month) Return the first ChildWriteSgpi filtered by the month column
 * @method     ChildWriteSgpi|null findOneByDrTags(string $dr_tags) Return the first ChildWriteSgpi filtered by the dr_tags column
 * @method     ChildWriteSgpi|null findOneByBrand(string $brand) Return the first ChildWriteSgpi filtered by the brand column
 * @method     ChildWriteSgpi|null findOneBySgpiTagged(string $sgpi_tagged) Return the first ChildWriteSgpi filtered by the sgpi_tagged column
 * @method     ChildWriteSgpi|null findOneByBrandSgpiDistributed(int $brand_sgpi_distributed) Return the first ChildWriteSgpi filtered by the brand_sgpi_distributed column
 * @method     ChildWriteSgpi|null findOneByMrCallDone(int $mr_call_done) Return the first ChildWriteSgpi filtered by the mr_call_done column
 * @method     ChildWriteSgpi|null findOneByAmCallDone(int $am_call_done) Return the first ChildWriteSgpi filtered by the am_call_done column
 * @method     ChildWriteSgpi|null findOneByRmCallDone(int $rm_call_done) Return the first ChildWriteSgpi filtered by the rm_call_done column
 * @method     ChildWriteSgpi|null findOneByZmCallDone(int $zm_call_done) Return the first ChildWriteSgpi filtered by the zm_call_done column
 * @method     ChildWriteSgpi|null findOneByZmPosition(string $zm_position) Return the first ChildWriteSgpi filtered by the zm_position column
 * @method     ChildWriteSgpi|null findOneByRmPosition(string $rm_position) Return the first ChildWriteSgpi filtered by the rm_position column
 * @method     ChildWriteSgpi|null findOneByAmPosition(string $am_position) Return the first ChildWriteSgpi filtered by the am_position column
 * @method     ChildWriteSgpi|null findOneByZmPositionCode(int $zm_position_code) Return the first ChildWriteSgpi filtered by the zm_position_code column
 * @method     ChildWriteSgpi|null findOneByRmPositionCode(int $rm_position_code) Return the first ChildWriteSgpi filtered by the rm_position_code column
 * @method     ChildWriteSgpi|null findOneByAmPositionCode(int $am_position_code) Return the first ChildWriteSgpi filtered by the am_position_code column
 * @method     ChildWriteSgpi|null findOneByEmployeePositionCode(int $employee_position_code) Return the first ChildWriteSgpi filtered by the employee_position_code column
 * @method     ChildWriteSgpi|null findOneByEmployeePositionName(string $employee_position_name) Return the first ChildWriteSgpi filtered by the employee_position_name column
 * @method     ChildWriteSgpi|null findOneByEmployeeLevel(string $employee_level) Return the first ChildWriteSgpi filtered by the employee_level column
 * @method     ChildWriteSgpi|null findOneBySgpiReportId(int $sgpi_report_id) Return the first ChildWriteSgpi filtered by the sgpi_report_id column
 * @method     ChildWriteSgpi|null findOneByCreatedAt(string $created_at) Return the first ChildWriteSgpi filtered by the created_at column
 * @method     ChildWriteSgpi|null findOneByUpdatedAt(string $updated_at) Return the first ChildWriteSgpi filtered by the updated_at column
 *
 * @method     ChildWriteSgpi requirePk($key, ?ConnectionInterface $con = null) Return the ChildWriteSgpi by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOne(?ConnectionInterface $con = null) Return the first ChildWriteSgpi matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteSgpi requireOneByDivision(string $division) Return the first ChildWriteSgpi filtered by the division column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByEmployeeId(int $employee_id) Return the first ChildWriteSgpi filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByEmployeeName(string $employee_name) Return the first ChildWriteSgpi filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByLocation(string $location) Return the first ChildWriteSgpi filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByLocationCode(int $location_code) Return the first ChildWriteSgpi filtered by the location_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByDrCode(int $dr_code) Return the first ChildWriteSgpi filtered by the dr_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByDrName(string $dr_name) Return the first ChildWriteSgpi filtered by the dr_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByDrSpecialty(string $dr_specialty) Return the first ChildWriteSgpi filtered by the dr_specialty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByMonth(string $month) Return the first ChildWriteSgpi filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByDrTags(string $dr_tags) Return the first ChildWriteSgpi filtered by the dr_tags column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByBrand(string $brand) Return the first ChildWriteSgpi filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneBySgpiTagged(string $sgpi_tagged) Return the first ChildWriteSgpi filtered by the sgpi_tagged column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByBrandSgpiDistributed(int $brand_sgpi_distributed) Return the first ChildWriteSgpi filtered by the brand_sgpi_distributed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByMrCallDone(int $mr_call_done) Return the first ChildWriteSgpi filtered by the mr_call_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByAmCallDone(int $am_call_done) Return the first ChildWriteSgpi filtered by the am_call_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByRmCallDone(int $rm_call_done) Return the first ChildWriteSgpi filtered by the rm_call_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByZmCallDone(int $zm_call_done) Return the first ChildWriteSgpi filtered by the zm_call_done column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByZmPosition(string $zm_position) Return the first ChildWriteSgpi filtered by the zm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByRmPosition(string $rm_position) Return the first ChildWriteSgpi filtered by the rm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByAmPosition(string $am_position) Return the first ChildWriteSgpi filtered by the am_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByZmPositionCode(int $zm_position_code) Return the first ChildWriteSgpi filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByRmPositionCode(int $rm_position_code) Return the first ChildWriteSgpi filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByAmPositionCode(int $am_position_code) Return the first ChildWriteSgpi filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByEmployeePositionCode(int $employee_position_code) Return the first ChildWriteSgpi filtered by the employee_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByEmployeePositionName(string $employee_position_name) Return the first ChildWriteSgpi filtered by the employee_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByEmployeeLevel(string $employee_level) Return the first ChildWriteSgpi filtered by the employee_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneBySgpiReportId(int $sgpi_report_id) Return the first ChildWriteSgpi filtered by the sgpi_report_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByCreatedAt(string $created_at) Return the first ChildWriteSgpi filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteSgpi requireOneByUpdatedAt(string $updated_at) Return the first ChildWriteSgpi filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteSgpi[]|Collection find(?ConnectionInterface $con = null) Return ChildWriteSgpi objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> find(?ConnectionInterface $con = null) Return ChildWriteSgpi objects based on current ModelCriteria
 *
 * @method     ChildWriteSgpi[]|Collection findByDivision(string|array<string> $division) Return ChildWriteSgpi objects filtered by the division column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByDivision(string|array<string> $division) Return ChildWriteSgpi objects filtered by the division column
 * @method     ChildWriteSgpi[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildWriteSgpi objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByEmployeeId(int|array<int> $employee_id) Return ChildWriteSgpi objects filtered by the employee_id column
 * @method     ChildWriteSgpi[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildWriteSgpi objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByEmployeeName(string|array<string> $employee_name) Return ChildWriteSgpi objects filtered by the employee_name column
 * @method     ChildWriteSgpi[]|Collection findByLocation(string|array<string> $location) Return ChildWriteSgpi objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByLocation(string|array<string> $location) Return ChildWriteSgpi objects filtered by the location column
 * @method     ChildWriteSgpi[]|Collection findByLocationCode(int|array<int> $location_code) Return ChildWriteSgpi objects filtered by the location_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByLocationCode(int|array<int> $location_code) Return ChildWriteSgpi objects filtered by the location_code column
 * @method     ChildWriteSgpi[]|Collection findByDrCode(int|array<int> $dr_code) Return ChildWriteSgpi objects filtered by the dr_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByDrCode(int|array<int> $dr_code) Return ChildWriteSgpi objects filtered by the dr_code column
 * @method     ChildWriteSgpi[]|Collection findByDrName(string|array<string> $dr_name) Return ChildWriteSgpi objects filtered by the dr_name column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByDrName(string|array<string> $dr_name) Return ChildWriteSgpi objects filtered by the dr_name column
 * @method     ChildWriteSgpi[]|Collection findByDrSpecialty(string|array<string> $dr_specialty) Return ChildWriteSgpi objects filtered by the dr_specialty column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByDrSpecialty(string|array<string> $dr_specialty) Return ChildWriteSgpi objects filtered by the dr_specialty column
 * @method     ChildWriteSgpi[]|Collection findByMonth(string|array<string> $month) Return ChildWriteSgpi objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByMonth(string|array<string> $month) Return ChildWriteSgpi objects filtered by the month column
 * @method     ChildWriteSgpi[]|Collection findByDrTags(string|array<string> $dr_tags) Return ChildWriteSgpi objects filtered by the dr_tags column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByDrTags(string|array<string> $dr_tags) Return ChildWriteSgpi objects filtered by the dr_tags column
 * @method     ChildWriteSgpi[]|Collection findByBrand(string|array<string> $brand) Return ChildWriteSgpi objects filtered by the brand column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByBrand(string|array<string> $brand) Return ChildWriteSgpi objects filtered by the brand column
 * @method     ChildWriteSgpi[]|Collection findBySgpiTagged(string|array<string> $sgpi_tagged) Return ChildWriteSgpi objects filtered by the sgpi_tagged column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findBySgpiTagged(string|array<string> $sgpi_tagged) Return ChildWriteSgpi objects filtered by the sgpi_tagged column
 * @method     ChildWriteSgpi[]|Collection findByBrandSgpiDistributed(int|array<int> $brand_sgpi_distributed) Return ChildWriteSgpi objects filtered by the brand_sgpi_distributed column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByBrandSgpiDistributed(int|array<int> $brand_sgpi_distributed) Return ChildWriteSgpi objects filtered by the brand_sgpi_distributed column
 * @method     ChildWriteSgpi[]|Collection findByMrCallDone(int|array<int> $mr_call_done) Return ChildWriteSgpi objects filtered by the mr_call_done column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByMrCallDone(int|array<int> $mr_call_done) Return ChildWriteSgpi objects filtered by the mr_call_done column
 * @method     ChildWriteSgpi[]|Collection findByAmCallDone(int|array<int> $am_call_done) Return ChildWriteSgpi objects filtered by the am_call_done column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByAmCallDone(int|array<int> $am_call_done) Return ChildWriteSgpi objects filtered by the am_call_done column
 * @method     ChildWriteSgpi[]|Collection findByRmCallDone(int|array<int> $rm_call_done) Return ChildWriteSgpi objects filtered by the rm_call_done column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByRmCallDone(int|array<int> $rm_call_done) Return ChildWriteSgpi objects filtered by the rm_call_done column
 * @method     ChildWriteSgpi[]|Collection findByZmCallDone(int|array<int> $zm_call_done) Return ChildWriteSgpi objects filtered by the zm_call_done column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByZmCallDone(int|array<int> $zm_call_done) Return ChildWriteSgpi objects filtered by the zm_call_done column
 * @method     ChildWriteSgpi[]|Collection findByZmPosition(string|array<string> $zm_position) Return ChildWriteSgpi objects filtered by the zm_position column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByZmPosition(string|array<string> $zm_position) Return ChildWriteSgpi objects filtered by the zm_position column
 * @method     ChildWriteSgpi[]|Collection findByRmPosition(string|array<string> $rm_position) Return ChildWriteSgpi objects filtered by the rm_position column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByRmPosition(string|array<string> $rm_position) Return ChildWriteSgpi objects filtered by the rm_position column
 * @method     ChildWriteSgpi[]|Collection findByAmPosition(string|array<string> $am_position) Return ChildWriteSgpi objects filtered by the am_position column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByAmPosition(string|array<string> $am_position) Return ChildWriteSgpi objects filtered by the am_position column
 * @method     ChildWriteSgpi[]|Collection findByZmPositionCode(int|array<int> $zm_position_code) Return ChildWriteSgpi objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByZmPositionCode(int|array<int> $zm_position_code) Return ChildWriteSgpi objects filtered by the zm_position_code column
 * @method     ChildWriteSgpi[]|Collection findByRmPositionCode(int|array<int> $rm_position_code) Return ChildWriteSgpi objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByRmPositionCode(int|array<int> $rm_position_code) Return ChildWriteSgpi objects filtered by the rm_position_code column
 * @method     ChildWriteSgpi[]|Collection findByAmPositionCode(int|array<int> $am_position_code) Return ChildWriteSgpi objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByAmPositionCode(int|array<int> $am_position_code) Return ChildWriteSgpi objects filtered by the am_position_code column
 * @method     ChildWriteSgpi[]|Collection findByEmployeePositionCode(int|array<int> $employee_position_code) Return ChildWriteSgpi objects filtered by the employee_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByEmployeePositionCode(int|array<int> $employee_position_code) Return ChildWriteSgpi objects filtered by the employee_position_code column
 * @method     ChildWriteSgpi[]|Collection findByEmployeePositionName(string|array<string> $employee_position_name) Return ChildWriteSgpi objects filtered by the employee_position_name column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByEmployeePositionName(string|array<string> $employee_position_name) Return ChildWriteSgpi objects filtered by the employee_position_name column
 * @method     ChildWriteSgpi[]|Collection findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteSgpi objects filtered by the employee_level column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteSgpi objects filtered by the employee_level column
 * @method     ChildWriteSgpi[]|Collection findBySgpiReportId(int|array<int> $sgpi_report_id) Return ChildWriteSgpi objects filtered by the sgpi_report_id column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findBySgpiReportId(int|array<int> $sgpi_report_id) Return ChildWriteSgpi objects filtered by the sgpi_report_id column
 * @method     ChildWriteSgpi[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWriteSgpi objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByCreatedAt(string|array<string> $created_at) Return ChildWriteSgpi objects filtered by the created_at column
 * @method     ChildWriteSgpi[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteSgpi objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWriteSgpi> findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteSgpi objects filtered by the updated_at column
 *
 * @method     ChildWriteSgpi[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWriteSgpi> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WriteSgpiQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WriteSgpiQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WriteSgpi', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWriteSgpiQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWriteSgpiQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWriteSgpiQuery) {
            return $criteria;
        }
        $query = new ChildWriteSgpiQuery();
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
     * @return ChildWriteSgpi|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WriteSgpiTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWriteSgpi A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT division, employee_id, employee_name, location, location_code, dr_code, dr_name, dr_specialty, month, dr_tags, brand, sgpi_tagged, brand_sgpi_distributed, mr_call_done, am_call_done, rm_call_done, zm_call_done, zm_position, rm_position, am_position, zm_position_code, rm_position_code, am_position_code, employee_position_code, employee_position_name, employee_level, sgpi_report_id, created_at, updated_at FROM write_sgpi WHERE sgpi_report_id = :p0';
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
            /** @var ChildWriteSgpi $obj */
            $obj = new ChildWriteSgpi();
            $obj->hydrate($row);
            WriteSgpiTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWriteSgpi|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the division column
     *
     * Example usage:
     * <code>
     * $query->filterByDivision('fooValue');   // WHERE division = 'fooValue'
     * $query->filterByDivision('%fooValue%', Criteria::LIKE); // WHERE division LIKE '%fooValue%'
     * $query->filterByDivision(['foo', 'bar']); // WHERE division IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $division The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDivision($division = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($division)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_DIVISION, $division, $comparison);

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
                $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location_code column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationCode(1234); // WHERE location_code = 1234
     * $query->filterByLocationCode(array(12, 34)); // WHERE location_code IN (12, 34)
     * $query->filterByLocationCode(array('min' => 12)); // WHERE location_code > 12
     * </code>
     *
     * @param mixed $locationCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocationCode($locationCode = null, ?string $comparison = null)
    {
        if (is_array($locationCode)) {
            $useMinMax = false;
            if (isset($locationCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_LOCATION_CODE, $locationCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_LOCATION_CODE, $locationCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_LOCATION_CODE, $locationCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_code column
     *
     * Example usage:
     * <code>
     * $query->filterByDrCode(1234); // WHERE dr_code = 1234
     * $query->filterByDrCode(array(12, 34)); // WHERE dr_code IN (12, 34)
     * $query->filterByDrCode(array('min' => 12)); // WHERE dr_code > 12
     * </code>
     *
     * @param mixed $drCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrCode($drCode = null, ?string $comparison = null)
    {
        if (is_array($drCode)) {
            $useMinMax = false;
            if (isset($drCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_DR_CODE, $drCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($drCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_DR_CODE, $drCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_DR_CODE, $drCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDrName('fooValue');   // WHERE dr_name = 'fooValue'
     * $query->filterByDrName('%fooValue%', Criteria::LIKE); // WHERE dr_name LIKE '%fooValue%'
     * $query->filterByDrName(['foo', 'bar']); // WHERE dr_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrName($drName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_DR_NAME, $drName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_specialty column
     *
     * Example usage:
     * <code>
     * $query->filterByDrSpecialty('fooValue');   // WHERE dr_specialty = 'fooValue'
     * $query->filterByDrSpecialty('%fooValue%', Criteria::LIKE); // WHERE dr_specialty LIKE '%fooValue%'
     * $query->filterByDrSpecialty(['foo', 'bar']); // WHERE dr_specialty IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drSpecialty The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrSpecialty($drSpecialty = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drSpecialty)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_DR_SPECIALTY, $drSpecialty, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_tags column
     *
     * Example usage:
     * <code>
     * $query->filterByDrTags('fooValue');   // WHERE dr_tags = 'fooValue'
     * $query->filterByDrTags('%fooValue%', Criteria::LIKE); // WHERE dr_tags LIKE '%fooValue%'
     * $query->filterByDrTags(['foo', 'bar']); // WHERE dr_tags IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drTags The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrTags($drTags = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drTags)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_DR_TAGS, $drTags, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand column
     *
     * Example usage:
     * <code>
     * $query->filterByBrand('fooValue');   // WHERE brand = 'fooValue'
     * $query->filterByBrand('%fooValue%', Criteria::LIKE); // WHERE brand LIKE '%fooValue%'
     * $query->filterByBrand(['foo', 'bar']); // WHERE brand IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $brand The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrand($brand = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_BRAND, $brand, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_tagged column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiTagged('fooValue');   // WHERE sgpi_tagged = 'fooValue'
     * $query->filterBySgpiTagged('%fooValue%', Criteria::LIKE); // WHERE sgpi_tagged LIKE '%fooValue%'
     * $query->filterBySgpiTagged(['foo', 'bar']); // WHERE sgpi_tagged IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $sgpiTagged The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiTagged($sgpiTagged = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sgpiTagged)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_TAGGED, $sgpiTagged, $comparison);

        return $this;
    }

    /**
     * Filter the query on the brand_sgpi_distributed column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandSgpiDistributed(1234); // WHERE brand_sgpi_distributed = 1234
     * $query->filterByBrandSgpiDistributed(array(12, 34)); // WHERE brand_sgpi_distributed IN (12, 34)
     * $query->filterByBrandSgpiDistributed(array('min' => 12)); // WHERE brand_sgpi_distributed > 12
     * </code>
     *
     * @param mixed $brandSgpiDistributed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBrandSgpiDistributed($brandSgpiDistributed = null, ?string $comparison = null)
    {
        if (is_array($brandSgpiDistributed)) {
            $useMinMax = false;
            if (isset($brandSgpiDistributed['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED, $brandSgpiDistributed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandSgpiDistributed['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED, $brandSgpiDistributed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED, $brandSgpiDistributed, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mr_call_done column
     *
     * Example usage:
     * <code>
     * $query->filterByMrCallDone(1234); // WHERE mr_call_done = 1234
     * $query->filterByMrCallDone(array(12, 34)); // WHERE mr_call_done IN (12, 34)
     * $query->filterByMrCallDone(array('min' => 12)); // WHERE mr_call_done > 12
     * </code>
     *
     * @param mixed $mrCallDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMrCallDone($mrCallDone = null, ?string $comparison = null)
    {
        if (is_array($mrCallDone)) {
            $useMinMax = false;
            if (isset($mrCallDone['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_MR_CALL_DONE, $mrCallDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mrCallDone['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_MR_CALL_DONE, $mrCallDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_MR_CALL_DONE, $mrCallDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_call_done column
     *
     * Example usage:
     * <code>
     * $query->filterByAmCallDone(1234); // WHERE am_call_done = 1234
     * $query->filterByAmCallDone(array(12, 34)); // WHERE am_call_done IN (12, 34)
     * $query->filterByAmCallDone(array('min' => 12)); // WHERE am_call_done > 12
     * </code>
     *
     * @param mixed $amCallDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmCallDone($amCallDone = null, ?string $comparison = null)
    {
        if (is_array($amCallDone)) {
            $useMinMax = false;
            if (isset($amCallDone['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_AM_CALL_DONE, $amCallDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amCallDone['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_AM_CALL_DONE, $amCallDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_AM_CALL_DONE, $amCallDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_call_done column
     *
     * Example usage:
     * <code>
     * $query->filterByRmCallDone(1234); // WHERE rm_call_done = 1234
     * $query->filterByRmCallDone(array(12, 34)); // WHERE rm_call_done IN (12, 34)
     * $query->filterByRmCallDone(array('min' => 12)); // WHERE rm_call_done > 12
     * </code>
     *
     * @param mixed $rmCallDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmCallDone($rmCallDone = null, ?string $comparison = null)
    {
        if (is_array($rmCallDone)) {
            $useMinMax = false;
            if (isset($rmCallDone['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_RM_CALL_DONE, $rmCallDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rmCallDone['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_RM_CALL_DONE, $rmCallDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_RM_CALL_DONE, $rmCallDone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_call_done column
     *
     * Example usage:
     * <code>
     * $query->filterByZmCallDone(1234); // WHERE zm_call_done = 1234
     * $query->filterByZmCallDone(array(12, 34)); // WHERE zm_call_done IN (12, 34)
     * $query->filterByZmCallDone(array('min' => 12)); // WHERE zm_call_done > 12
     * </code>
     *
     * @param mixed $zmCallDone The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmCallDone($zmCallDone = null, ?string $comparison = null)
    {
        if (is_array($zmCallDone)) {
            $useMinMax = false;
            if (isset($zmCallDone['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_CALL_DONE, $zmCallDone['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($zmCallDone['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_CALL_DONE, $zmCallDone['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_CALL_DONE, $zmCallDone, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_POSITION, $zmPosition, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_RM_POSITION, $rmPosition, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_AM_POSITION, $amPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPositionCode(1234); // WHERE zm_position_code = 1234
     * $query->filterByZmPositionCode(array(12, 34)); // WHERE zm_position_code IN (12, 34)
     * $query->filterByZmPositionCode(array('min' => 12)); // WHERE zm_position_code > 12
     * </code>
     *
     * @param mixed $zmPositionCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPositionCode($zmPositionCode = null, ?string $comparison = null)
    {
        if (is_array($zmPositionCode)) {
            $useMinMax = false;
            if (isset($zmPositionCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_POSITION_CODE, $zmPositionCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($zmPositionCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_POSITION_CODE, $zmPositionCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPositionCode(1234); // WHERE rm_position_code = 1234
     * $query->filterByRmPositionCode(array(12, 34)); // WHERE rm_position_code IN (12, 34)
     * $query->filterByRmPositionCode(array('min' => 12)); // WHERE rm_position_code > 12
     * </code>
     *
     * @param mixed $rmPositionCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPositionCode($rmPositionCode = null, ?string $comparison = null)
    {
        if (is_array($rmPositionCode)) {
            $useMinMax = false;
            if (isset($rmPositionCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_RM_POSITION_CODE, $rmPositionCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rmPositionCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_RM_POSITION_CODE, $rmPositionCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPositionCode(1234); // WHERE am_position_code = 1234
     * $query->filterByAmPositionCode(array(12, 34)); // WHERE am_position_code IN (12, 34)
     * $query->filterByAmPositionCode(array('min' => 12)); // WHERE am_position_code > 12
     * </code>
     *
     * @param mixed $amPositionCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPositionCode($amPositionCode = null, ?string $comparison = null)
    {
        if (is_array($amPositionCode)) {
            $useMinMax = false;
            if (isset($amPositionCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_AM_POSITION_CODE, $amPositionCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amPositionCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_AM_POSITION_CODE, $amPositionCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionCode(1234); // WHERE employee_position_code = 1234
     * $query->filterByEmployeePositionCode(array(12, 34)); // WHERE employee_position_code IN (12, 34)
     * $query->filterByEmployeePositionCode(array('min' => 12)); // WHERE employee_position_code > 12
     * </code>
     *
     * @param mixed $employeePositionCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionCode($employeePositionCode = null, ?string $comparison = null)
    {
        if (is_array($employeePositionCode)) {
            $useMinMax = false;
            if (isset($employeePositionCode['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE, $employeePositionCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeePositionCode['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE, $employeePositionCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE, $employeePositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionName('fooValue');   // WHERE employee_position_name = 'fooValue'
     * $query->filterByEmployeePositionName('%fooValue%', Criteria::LIKE); // WHERE employee_position_name LIKE '%fooValue%'
     * $query->filterByEmployeePositionName(['foo', 'bar']); // WHERE employee_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionName($employeePositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME, $employeePositionName, $comparison);

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

        $this->addUsingAlias(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL, $employeeLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the sgpi_report_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySgpiReportId(1234); // WHERE sgpi_report_id = 1234
     * $query->filterBySgpiReportId(array(12, 34)); // WHERE sgpi_report_id IN (12, 34)
     * $query->filterBySgpiReportId(array('min' => 12)); // WHERE sgpi_report_id > 12
     * </code>
     *
     * @param mixed $sgpiReportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySgpiReportId($sgpiReportId = null, ?string $comparison = null)
    {
        if (is_array($sgpiReportId)) {
            $useMinMax = false;
            if (isset($sgpiReportId['min'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $sgpiReportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sgpiReportId['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $sgpiReportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $sgpiReportId, $comparison);

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
                $this->addUsingAlias(WriteSgpiTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(WriteSgpiTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WriteSgpiTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteSgpiTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWriteSgpi $writeSgpi Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($writeSgpi = null)
    {
        if ($writeSgpi) {
            $this->addUsingAlias(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $writeSgpi->getSgpiReportId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the write_sgpi table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WriteSgpiTableMap::clearInstancePool();
            WriteSgpiTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WriteSgpiTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WriteSgpiTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WriteSgpiTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

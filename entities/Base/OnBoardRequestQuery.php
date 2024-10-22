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
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\Map\OnBoardRequestTableMap;

/**
 * Base class that represents a query for the `on_board_request` table.
 *
 * @method     ChildOnBoardRequestQuery orderByOnBoardRequestId($order = Criteria::ASC) Order by the on_board_request_id column
 * @method     ChildOnBoardRequestQuery orderByOutletId($order = Criteria::ASC) Order by the outlet_id column
 * @method     ChildOnBoardRequestQuery orderBySalutation($order = Criteria::ASC) Order by the salutation column
 * @method     ChildOnBoardRequestQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildOnBoardRequestQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildOnBoardRequestQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildOnBoardRequestQuery orderByMobile($order = Criteria::ASC) Order by the mobile column
 * @method     ChildOnBoardRequestQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     ChildOnBoardRequestQuery orderByDateOfBirth($order = Criteria::ASC) Order by the date_of_birth column
 * @method     ChildOnBoardRequestQuery orderByMaritalStatus($order = Criteria::ASC) Order by the marital_status column
 * @method     ChildOnBoardRequestQuery orderByDateOfAnniversary($order = Criteria::ASC) Order by the date_of_anniversary column
 * @method     ChildOnBoardRequestQuery orderByQualification($order = Criteria::ASC) Order by the qualification column
 * @method     ChildOnBoardRequestQuery orderByRegistrationNo($order = Criteria::ASC) Order by the registration_no column
 * @method     ChildOnBoardRequestQuery orderByProfilePic($order = Criteria::ASC) Order by the profile_pic column
 * @method     ChildOnBoardRequestQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOnBoardRequestQuery orderByTerritory($order = Criteria::ASC) Order by the territory column
 * @method     ChildOnBoardRequestQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     ChildOnBoardRequestQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOnBoardRequestQuery orderByCreatedByEmployeeId($order = Criteria::ASC) Order by the created_by_employee_id column
 * @method     ChildOnBoardRequestQuery orderByCreatedByPositionId($order = Criteria::ASC) Order by the created_by_position_id column
 * @method     ChildOnBoardRequestQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildOnBoardRequestQuery orderByUpdatedByEmployeeId($order = Criteria::ASC) Order by the updated_by_employee_id column
 * @method     ChildOnBoardRequestQuery orderByUpdatedByPositionId($order = Criteria::ASC) Order by the updated_by_position_id column
 * @method     ChildOnBoardRequestQuery orderByApprovedAt($order = Criteria::ASC) Order by the approved_at column
 * @method     ChildOnBoardRequestQuery orderByApprovedByEmployeeId($order = Criteria::ASC) Order by the approved_by_employee_id column
 * @method     ChildOnBoardRequestQuery orderByApprovedByPositionId($order = Criteria::ASC) Order by the approved_by_position_id column
 * @method     ChildOnBoardRequestQuery orderByFinalApprovedAt($order = Criteria::ASC) Order by the final_approved_at column
 * @method     ChildOnBoardRequestQuery orderByFinalApprovedByEmployeeId($order = Criteria::ASC) Order by the final_approved_by_employee_id column
 * @method     ChildOnBoardRequestQuery orderByFinalApprovedByPositionId($order = Criteria::ASC) Order by the final_approved_by_position_id column
 * @method     ChildOnBoardRequestQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildOnBoardRequestQuery orderByDescriptioin($order = Criteria::ASC) Order by the descriptioin column
 * @method     ChildOnBoardRequestQuery orderByOutletTypeId($order = Criteria::ASC) Order by the outlet_type_id column
 * @method     ChildOnBoardRequestQuery orderByOutletName($order = Criteria::ASC) Order by the outlet_name column
 * @method     ChildOnBoardRequestQuery orderByOutletCode($order = Criteria::ASC) Order by the outlet_code column
 *
 * @method     ChildOnBoardRequestQuery groupByOnBoardRequestId() Group by the on_board_request_id column
 * @method     ChildOnBoardRequestQuery groupByOutletId() Group by the outlet_id column
 * @method     ChildOnBoardRequestQuery groupBySalutation() Group by the salutation column
 * @method     ChildOnBoardRequestQuery groupByFirstName() Group by the first_name column
 * @method     ChildOnBoardRequestQuery groupByLastName() Group by the last_name column
 * @method     ChildOnBoardRequestQuery groupByEmail() Group by the email column
 * @method     ChildOnBoardRequestQuery groupByMobile() Group by the mobile column
 * @method     ChildOnBoardRequestQuery groupByGender() Group by the gender column
 * @method     ChildOnBoardRequestQuery groupByDateOfBirth() Group by the date_of_birth column
 * @method     ChildOnBoardRequestQuery groupByMaritalStatus() Group by the marital_status column
 * @method     ChildOnBoardRequestQuery groupByDateOfAnniversary() Group by the date_of_anniversary column
 * @method     ChildOnBoardRequestQuery groupByQualification() Group by the qualification column
 * @method     ChildOnBoardRequestQuery groupByRegistrationNo() Group by the registration_no column
 * @method     ChildOnBoardRequestQuery groupByProfilePic() Group by the profile_pic column
 * @method     ChildOnBoardRequestQuery groupByStatus() Group by the status column
 * @method     ChildOnBoardRequestQuery groupByTerritory() Group by the territory column
 * @method     ChildOnBoardRequestQuery groupByPosition() Group by the position column
 * @method     ChildOnBoardRequestQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOnBoardRequestQuery groupByCreatedByEmployeeId() Group by the created_by_employee_id column
 * @method     ChildOnBoardRequestQuery groupByCreatedByPositionId() Group by the created_by_position_id column
 * @method     ChildOnBoardRequestQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildOnBoardRequestQuery groupByUpdatedByEmployeeId() Group by the updated_by_employee_id column
 * @method     ChildOnBoardRequestQuery groupByUpdatedByPositionId() Group by the updated_by_position_id column
 * @method     ChildOnBoardRequestQuery groupByApprovedAt() Group by the approved_at column
 * @method     ChildOnBoardRequestQuery groupByApprovedByEmployeeId() Group by the approved_by_employee_id column
 * @method     ChildOnBoardRequestQuery groupByApprovedByPositionId() Group by the approved_by_position_id column
 * @method     ChildOnBoardRequestQuery groupByFinalApprovedAt() Group by the final_approved_at column
 * @method     ChildOnBoardRequestQuery groupByFinalApprovedByEmployeeId() Group by the final_approved_by_employee_id column
 * @method     ChildOnBoardRequestQuery groupByFinalApprovedByPositionId() Group by the final_approved_by_position_id column
 * @method     ChildOnBoardRequestQuery groupByCompanyId() Group by the company_id column
 * @method     ChildOnBoardRequestQuery groupByDescriptioin() Group by the descriptioin column
 * @method     ChildOnBoardRequestQuery groupByOutletTypeId() Group by the outlet_type_id column
 * @method     ChildOnBoardRequestQuery groupByOutletName() Group by the outlet_name column
 * @method     ChildOnBoardRequestQuery groupByOutletCode() Group by the outlet_code column
 *
 * @method     ChildOnBoardRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOnBoardRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOnBoardRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOnBoardRequestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOnBoardRequestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOnBoardRequestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOnBoardRequestQuery leftJoinEmployeeRelatedByApprovedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinEmployeeRelatedByApprovedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinEmployeeRelatedByApprovedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithEmployeeRelatedByApprovedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithEmployeeRelatedByApprovedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithEmployeeRelatedByApprovedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithEmployeeRelatedByApprovedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinPositionsRelatedByApprovedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinPositionsRelatedByApprovedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinPositionsRelatedByApprovedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithPositionsRelatedByApprovedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithPositionsRelatedByApprovedByPositionId() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithPositionsRelatedByApprovedByPositionId() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithPositionsRelatedByApprovedByPositionId() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequestQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildOnBoardRequestQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildOnBoardRequestQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequestQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildOnBoardRequestQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinEmployeeRelatedByCreatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinEmployeeRelatedByCreatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinEmployeeRelatedByCreatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithEmployeeRelatedByCreatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithEmployeeRelatedByCreatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithEmployeeRelatedByCreatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithEmployeeRelatedByCreatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByCreatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinPositionsRelatedByCreatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByCreatedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinPositionsRelatedByCreatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByCreatedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinPositionsRelatedByCreatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByCreatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithPositionsRelatedByCreatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByCreatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithPositionsRelatedByCreatedByPositionId() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByCreatedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithPositionsRelatedByCreatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByCreatedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithPositionsRelatedByCreatedByPositionId() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByCreatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinEmployeeRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinEmployeeRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinEmployeeRelatedByFinalApprovedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithEmployeeRelatedByFinalApprovedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithEmployeeRelatedByFinalApprovedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithEmployeeRelatedByFinalApprovedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithEmployeeRelatedByFinalApprovedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinPositionsRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinPositionsRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinPositionsRelatedByFinalApprovedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithPositionsRelatedByFinalApprovedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithPositionsRelatedByFinalApprovedByPositionId() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithPositionsRelatedByFinalApprovedByPositionId() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithPositionsRelatedByFinalApprovedByPositionId() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByFinalApprovedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinOutlets($relationAlias = null) Adds a LEFT JOIN clause to the query using the Outlets relation
 * @method     ChildOnBoardRequestQuery rightJoinOutlets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Outlets relation
 * @method     ChildOnBoardRequestQuery innerJoinOutlets($relationAlias = null) Adds a INNER JOIN clause to the query using the Outlets relation
 *
 * @method     ChildOnBoardRequestQuery joinWithOutlets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Outlets relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithOutlets() Adds a LEFT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOnBoardRequestQuery rightJoinWithOutlets() Adds a RIGHT JOIN clause and with to the query using the Outlets relation
 * @method     ChildOnBoardRequestQuery innerJoinWithOutlets() Adds a INNER JOIN clause and with to the query using the Outlets relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinOutletType($relationAlias = null) Adds a LEFT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequestQuery rightJoinOutletType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OutletType relation
 * @method     ChildOnBoardRequestQuery innerJoinOutletType($relationAlias = null) Adds a INNER JOIN clause to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequestQuery joinWithOutletType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithOutletType() Adds a LEFT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequestQuery rightJoinWithOutletType() Adds a RIGHT JOIN clause and with to the query using the OutletType relation
 * @method     ChildOnBoardRequestQuery innerJoinWithOutletType() Adds a INNER JOIN clause and with to the query using the OutletType relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinPositionsRelatedByPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByPosition relation
 * @method     ChildOnBoardRequestQuery rightJoinPositionsRelatedByPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByPosition relation
 * @method     ChildOnBoardRequestQuery innerJoinPositionsRelatedByPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByPosition relation
 *
 * @method     ChildOnBoardRequestQuery joinWithPositionsRelatedByPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByPosition relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithPositionsRelatedByPosition() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByPosition relation
 * @method     ChildOnBoardRequestQuery rightJoinWithPositionsRelatedByPosition() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByPosition relation
 * @method     ChildOnBoardRequestQuery innerJoinWithPositionsRelatedByPosition() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByPosition relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinTerritories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Territories relation
 * @method     ChildOnBoardRequestQuery rightJoinTerritories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Territories relation
 * @method     ChildOnBoardRequestQuery innerJoinTerritories($relationAlias = null) Adds a INNER JOIN clause to the query using the Territories relation
 *
 * @method     ChildOnBoardRequestQuery joinWithTerritories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Territories relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithTerritories() Adds a LEFT JOIN clause and with to the query using the Territories relation
 * @method     ChildOnBoardRequestQuery rightJoinWithTerritories() Adds a RIGHT JOIN clause and with to the query using the Territories relation
 * @method     ChildOnBoardRequestQuery innerJoinWithTerritories() Adds a INNER JOIN clause and with to the query using the Territories relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinEmployeeRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinEmployeeRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinEmployeeRelatedByUpdatedByEmployeeId($relationAlias = null) Adds a INNER JOIN clause to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithEmployeeRelatedByUpdatedByEmployeeId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithEmployeeRelatedByUpdatedByEmployeeId() Adds a LEFT JOIN clause and with to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithEmployeeRelatedByUpdatedByEmployeeId() Adds a RIGHT JOIN clause and with to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithEmployeeRelatedByUpdatedByEmployeeId() Adds a INNER JOIN clause and with to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinPositionsRelatedByUpdatedByPositionId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PositionsRelatedByUpdatedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinPositionsRelatedByUpdatedByPositionId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PositionsRelatedByUpdatedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinPositionsRelatedByUpdatedByPositionId($relationAlias = null) Adds a INNER JOIN clause to the query using the PositionsRelatedByUpdatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery joinWithPositionsRelatedByUpdatedByPositionId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PositionsRelatedByUpdatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithPositionsRelatedByUpdatedByPositionId() Adds a LEFT JOIN clause and with to the query using the PositionsRelatedByUpdatedByPositionId relation
 * @method     ChildOnBoardRequestQuery rightJoinWithPositionsRelatedByUpdatedByPositionId() Adds a RIGHT JOIN clause and with to the query using the PositionsRelatedByUpdatedByPositionId relation
 * @method     ChildOnBoardRequestQuery innerJoinWithPositionsRelatedByUpdatedByPositionId() Adds a INNER JOIN clause and with to the query using the PositionsRelatedByUpdatedByPositionId relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinOnBoardRequestAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOnBoardRequestQuery rightJoinOnBoardRequestAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestAddress relation
 * @method     ChildOnBoardRequestQuery innerJoinOnBoardRequestAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOnBoardRequestQuery joinWithOnBoardRequestAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithOnBoardRequestAddress() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOnBoardRequestQuery rightJoinWithOnBoardRequestAddress() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestAddress relation
 * @method     ChildOnBoardRequestQuery innerJoinWithOnBoardRequestAddress() Adds a INNER JOIN clause and with to the query using the OnBoardRequestAddress relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinOnBoardRequestLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildOnBoardRequestQuery rightJoinOnBoardRequestLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestLog relation
 * @method     ChildOnBoardRequestQuery innerJoinOnBoardRequestLog($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestLog relation
 *
 * @method     ChildOnBoardRequestQuery joinWithOnBoardRequestLog($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithOnBoardRequestLog() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildOnBoardRequestQuery rightJoinWithOnBoardRequestLog() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestLog relation
 * @method     ChildOnBoardRequestQuery innerJoinWithOnBoardRequestLog() Adds a INNER JOIN clause and with to the query using the OnBoardRequestLog relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildOnBoardRequestQuery rightJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildOnBoardRequestQuery innerJoinOnBoardRequestOutletMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     ChildOnBoardRequestQuery joinWithOnBoardRequestOutletMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     ChildOnBoardRequestQuery leftJoinWithOnBoardRequestOutletMapping() Adds a LEFT JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildOnBoardRequestQuery rightJoinWithOnBoardRequestOutletMapping() Adds a RIGHT JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 * @method     ChildOnBoardRequestQuery innerJoinWithOnBoardRequestOutletMapping() Adds a INNER JOIN clause and with to the query using the OnBoardRequestOutletMapping relation
 *
 * @method     \entities\EmployeeQuery|\entities\PositionsQuery|\entities\CompanyQuery|\entities\EmployeeQuery|\entities\PositionsQuery|\entities\EmployeeQuery|\entities\PositionsQuery|\entities\OutletsQuery|\entities\OutletTypeQuery|\entities\PositionsQuery|\entities\TerritoriesQuery|\entities\EmployeeQuery|\entities\PositionsQuery|\entities\OnBoardRequestAddressQuery|\entities\OnBoardRequestLogQuery|\entities\OnBoardRequestOutletMappingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOnBoardRequest|null findOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequest matching the query
 * @method     ChildOnBoardRequest findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOnBoardRequest matching the query, or a new ChildOnBoardRequest object populated from the query conditions when no match is found
 *
 * @method     ChildOnBoardRequest|null findOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequest filtered by the on_board_request_id column
 * @method     ChildOnBoardRequest|null findOneByOutletId(int $outlet_id) Return the first ChildOnBoardRequest filtered by the outlet_id column
 * @method     ChildOnBoardRequest|null findOneBySalutation(string $salutation) Return the first ChildOnBoardRequest filtered by the salutation column
 * @method     ChildOnBoardRequest|null findOneByFirstName(string $first_name) Return the first ChildOnBoardRequest filtered by the first_name column
 * @method     ChildOnBoardRequest|null findOneByLastName(string $last_name) Return the first ChildOnBoardRequest filtered by the last_name column
 * @method     ChildOnBoardRequest|null findOneByEmail(string $email) Return the first ChildOnBoardRequest filtered by the email column
 * @method     ChildOnBoardRequest|null findOneByMobile(string $mobile) Return the first ChildOnBoardRequest filtered by the mobile column
 * @method     ChildOnBoardRequest|null findOneByGender(string $gender) Return the first ChildOnBoardRequest filtered by the gender column
 * @method     ChildOnBoardRequest|null findOneByDateOfBirth(string $date_of_birth) Return the first ChildOnBoardRequest filtered by the date_of_birth column
 * @method     ChildOnBoardRequest|null findOneByMaritalStatus(string $marital_status) Return the first ChildOnBoardRequest filtered by the marital_status column
 * @method     ChildOnBoardRequest|null findOneByDateOfAnniversary(string $date_of_anniversary) Return the first ChildOnBoardRequest filtered by the date_of_anniversary column
 * @method     ChildOnBoardRequest|null findOneByQualification(string $qualification) Return the first ChildOnBoardRequest filtered by the qualification column
 * @method     ChildOnBoardRequest|null findOneByRegistrationNo(string $registration_no) Return the first ChildOnBoardRequest filtered by the registration_no column
 * @method     ChildOnBoardRequest|null findOneByProfilePic(string $profile_pic) Return the first ChildOnBoardRequest filtered by the profile_pic column
 * @method     ChildOnBoardRequest|null findOneByStatus(int $status) Return the first ChildOnBoardRequest filtered by the status column
 * @method     ChildOnBoardRequest|null findOneByTerritory(int $territory) Return the first ChildOnBoardRequest filtered by the territory column
 * @method     ChildOnBoardRequest|null findOneByPosition(int $position) Return the first ChildOnBoardRequest filtered by the position column
 * @method     ChildOnBoardRequest|null findOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequest filtered by the created_at column
 * @method     ChildOnBoardRequest|null findOneByCreatedByEmployeeId(int $created_by_employee_id) Return the first ChildOnBoardRequest filtered by the created_by_employee_id column
 * @method     ChildOnBoardRequest|null findOneByCreatedByPositionId(int $created_by_position_id) Return the first ChildOnBoardRequest filtered by the created_by_position_id column
 * @method     ChildOnBoardRequest|null findOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequest filtered by the updated_at column
 * @method     ChildOnBoardRequest|null findOneByUpdatedByEmployeeId(int $updated_by_employee_id) Return the first ChildOnBoardRequest filtered by the updated_by_employee_id column
 * @method     ChildOnBoardRequest|null findOneByUpdatedByPositionId(int $updated_by_position_id) Return the first ChildOnBoardRequest filtered by the updated_by_position_id column
 * @method     ChildOnBoardRequest|null findOneByApprovedAt(string $approved_at) Return the first ChildOnBoardRequest filtered by the approved_at column
 * @method     ChildOnBoardRequest|null findOneByApprovedByEmployeeId(int $approved_by_employee_id) Return the first ChildOnBoardRequest filtered by the approved_by_employee_id column
 * @method     ChildOnBoardRequest|null findOneByApprovedByPositionId(int $approved_by_position_id) Return the first ChildOnBoardRequest filtered by the approved_by_position_id column
 * @method     ChildOnBoardRequest|null findOneByFinalApprovedAt(string $final_approved_at) Return the first ChildOnBoardRequest filtered by the final_approved_at column
 * @method     ChildOnBoardRequest|null findOneByFinalApprovedByEmployeeId(int $final_approved_by_employee_id) Return the first ChildOnBoardRequest filtered by the final_approved_by_employee_id column
 * @method     ChildOnBoardRequest|null findOneByFinalApprovedByPositionId(int $final_approved_by_position_id) Return the first ChildOnBoardRequest filtered by the final_approved_by_position_id column
 * @method     ChildOnBoardRequest|null findOneByCompanyId(int $company_id) Return the first ChildOnBoardRequest filtered by the company_id column
 * @method     ChildOnBoardRequest|null findOneByDescriptioin(string $descriptioin) Return the first ChildOnBoardRequest filtered by the descriptioin column
 * @method     ChildOnBoardRequest|null findOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnBoardRequest filtered by the outlet_type_id column
 * @method     ChildOnBoardRequest|null findOneByOutletName(string $outlet_name) Return the first ChildOnBoardRequest filtered by the outlet_name column
 * @method     ChildOnBoardRequest|null findOneByOutletCode(string $outlet_code) Return the first ChildOnBoardRequest filtered by the outlet_code column
 *
 * @method     ChildOnBoardRequest requirePk($key, ?ConnectionInterface $con = null) Return the ChildOnBoardRequest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOne(?ConnectionInterface $con = null) Return the first ChildOnBoardRequest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequest requireOneByOnBoardRequestId(int $on_board_request_id) Return the first ChildOnBoardRequest filtered by the on_board_request_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByOutletId(int $outlet_id) Return the first ChildOnBoardRequest filtered by the outlet_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneBySalutation(string $salutation) Return the first ChildOnBoardRequest filtered by the salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByFirstName(string $first_name) Return the first ChildOnBoardRequest filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByLastName(string $last_name) Return the first ChildOnBoardRequest filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByEmail(string $email) Return the first ChildOnBoardRequest filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByMobile(string $mobile) Return the first ChildOnBoardRequest filtered by the mobile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByGender(string $gender) Return the first ChildOnBoardRequest filtered by the gender column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByDateOfBirth(string $date_of_birth) Return the first ChildOnBoardRequest filtered by the date_of_birth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByMaritalStatus(string $marital_status) Return the first ChildOnBoardRequest filtered by the marital_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByDateOfAnniversary(string $date_of_anniversary) Return the first ChildOnBoardRequest filtered by the date_of_anniversary column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByQualification(string $qualification) Return the first ChildOnBoardRequest filtered by the qualification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByRegistrationNo(string $registration_no) Return the first ChildOnBoardRequest filtered by the registration_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByProfilePic(string $profile_pic) Return the first ChildOnBoardRequest filtered by the profile_pic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByStatus(int $status) Return the first ChildOnBoardRequest filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByTerritory(int $territory) Return the first ChildOnBoardRequest filtered by the territory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByPosition(int $position) Return the first ChildOnBoardRequest filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByCreatedAt(string $created_at) Return the first ChildOnBoardRequest filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByCreatedByEmployeeId(int $created_by_employee_id) Return the first ChildOnBoardRequest filtered by the created_by_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByCreatedByPositionId(int $created_by_position_id) Return the first ChildOnBoardRequest filtered by the created_by_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByUpdatedAt(string $updated_at) Return the first ChildOnBoardRequest filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByUpdatedByEmployeeId(int $updated_by_employee_id) Return the first ChildOnBoardRequest filtered by the updated_by_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByUpdatedByPositionId(int $updated_by_position_id) Return the first ChildOnBoardRequest filtered by the updated_by_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByApprovedAt(string $approved_at) Return the first ChildOnBoardRequest filtered by the approved_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByApprovedByEmployeeId(int $approved_by_employee_id) Return the first ChildOnBoardRequest filtered by the approved_by_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByApprovedByPositionId(int $approved_by_position_id) Return the first ChildOnBoardRequest filtered by the approved_by_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByFinalApprovedAt(string $final_approved_at) Return the first ChildOnBoardRequest filtered by the final_approved_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByFinalApprovedByEmployeeId(int $final_approved_by_employee_id) Return the first ChildOnBoardRequest filtered by the final_approved_by_employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByFinalApprovedByPositionId(int $final_approved_by_position_id) Return the first ChildOnBoardRequest filtered by the final_approved_by_position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByCompanyId(int $company_id) Return the first ChildOnBoardRequest filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByDescriptioin(string $descriptioin) Return the first ChildOnBoardRequest filtered by the descriptioin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByOutletTypeId(int $outlet_type_id) Return the first ChildOnBoardRequest filtered by the outlet_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByOutletName(string $outlet_name) Return the first ChildOnBoardRequest filtered by the outlet_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOnBoardRequest requireOneByOutletCode(string $outlet_code) Return the first ChildOnBoardRequest filtered by the outlet_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOnBoardRequest[]|Collection find(?ConnectionInterface $con = null) Return ChildOnBoardRequest objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> find(?ConnectionInterface $con = null) Return ChildOnBoardRequest objects based on current ModelCriteria
 *
 * @method     ChildOnBoardRequest[]|Collection findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequest objects filtered by the on_board_request_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByOnBoardRequestId(int|array<int> $on_board_request_id) Return ChildOnBoardRequest objects filtered by the on_board_request_id column
 * @method     ChildOnBoardRequest[]|Collection findByOutletId(int|array<int> $outlet_id) Return ChildOnBoardRequest objects filtered by the outlet_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByOutletId(int|array<int> $outlet_id) Return ChildOnBoardRequest objects filtered by the outlet_id column
 * @method     ChildOnBoardRequest[]|Collection findBySalutation(string|array<string> $salutation) Return ChildOnBoardRequest objects filtered by the salutation column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findBySalutation(string|array<string> $salutation) Return ChildOnBoardRequest objects filtered by the salutation column
 * @method     ChildOnBoardRequest[]|Collection findByFirstName(string|array<string> $first_name) Return ChildOnBoardRequest objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByFirstName(string|array<string> $first_name) Return ChildOnBoardRequest objects filtered by the first_name column
 * @method     ChildOnBoardRequest[]|Collection findByLastName(string|array<string> $last_name) Return ChildOnBoardRequest objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByLastName(string|array<string> $last_name) Return ChildOnBoardRequest objects filtered by the last_name column
 * @method     ChildOnBoardRequest[]|Collection findByEmail(string|array<string> $email) Return ChildOnBoardRequest objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByEmail(string|array<string> $email) Return ChildOnBoardRequest objects filtered by the email column
 * @method     ChildOnBoardRequest[]|Collection findByMobile(string|array<string> $mobile) Return ChildOnBoardRequest objects filtered by the mobile column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByMobile(string|array<string> $mobile) Return ChildOnBoardRequest objects filtered by the mobile column
 * @method     ChildOnBoardRequest[]|Collection findByGender(string|array<string> $gender) Return ChildOnBoardRequest objects filtered by the gender column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByGender(string|array<string> $gender) Return ChildOnBoardRequest objects filtered by the gender column
 * @method     ChildOnBoardRequest[]|Collection findByDateOfBirth(string|array<string> $date_of_birth) Return ChildOnBoardRequest objects filtered by the date_of_birth column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByDateOfBirth(string|array<string> $date_of_birth) Return ChildOnBoardRequest objects filtered by the date_of_birth column
 * @method     ChildOnBoardRequest[]|Collection findByMaritalStatus(string|array<string> $marital_status) Return ChildOnBoardRequest objects filtered by the marital_status column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByMaritalStatus(string|array<string> $marital_status) Return ChildOnBoardRequest objects filtered by the marital_status column
 * @method     ChildOnBoardRequest[]|Collection findByDateOfAnniversary(string|array<string> $date_of_anniversary) Return ChildOnBoardRequest objects filtered by the date_of_anniversary column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByDateOfAnniversary(string|array<string> $date_of_anniversary) Return ChildOnBoardRequest objects filtered by the date_of_anniversary column
 * @method     ChildOnBoardRequest[]|Collection findByQualification(string|array<string> $qualification) Return ChildOnBoardRequest objects filtered by the qualification column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByQualification(string|array<string> $qualification) Return ChildOnBoardRequest objects filtered by the qualification column
 * @method     ChildOnBoardRequest[]|Collection findByRegistrationNo(string|array<string> $registration_no) Return ChildOnBoardRequest objects filtered by the registration_no column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByRegistrationNo(string|array<string> $registration_no) Return ChildOnBoardRequest objects filtered by the registration_no column
 * @method     ChildOnBoardRequest[]|Collection findByProfilePic(string|array<string> $profile_pic) Return ChildOnBoardRequest objects filtered by the profile_pic column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByProfilePic(string|array<string> $profile_pic) Return ChildOnBoardRequest objects filtered by the profile_pic column
 * @method     ChildOnBoardRequest[]|Collection findByStatus(int|array<int> $status) Return ChildOnBoardRequest objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByStatus(int|array<int> $status) Return ChildOnBoardRequest objects filtered by the status column
 * @method     ChildOnBoardRequest[]|Collection findByTerritory(int|array<int> $territory) Return ChildOnBoardRequest objects filtered by the territory column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByTerritory(int|array<int> $territory) Return ChildOnBoardRequest objects filtered by the territory column
 * @method     ChildOnBoardRequest[]|Collection findByPosition(int|array<int> $position) Return ChildOnBoardRequest objects filtered by the position column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByPosition(int|array<int> $position) Return ChildOnBoardRequest objects filtered by the position column
 * @method     ChildOnBoardRequest[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequest objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByCreatedAt(string|array<string> $created_at) Return ChildOnBoardRequest objects filtered by the created_at column
 * @method     ChildOnBoardRequest[]|Collection findByCreatedByEmployeeId(int|array<int> $created_by_employee_id) Return ChildOnBoardRequest objects filtered by the created_by_employee_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByCreatedByEmployeeId(int|array<int> $created_by_employee_id) Return ChildOnBoardRequest objects filtered by the created_by_employee_id column
 * @method     ChildOnBoardRequest[]|Collection findByCreatedByPositionId(int|array<int> $created_by_position_id) Return ChildOnBoardRequest objects filtered by the created_by_position_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByCreatedByPositionId(int|array<int> $created_by_position_id) Return ChildOnBoardRequest objects filtered by the created_by_position_id column
 * @method     ChildOnBoardRequest[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequest objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByUpdatedAt(string|array<string> $updated_at) Return ChildOnBoardRequest objects filtered by the updated_at column
 * @method     ChildOnBoardRequest[]|Collection findByUpdatedByEmployeeId(int|array<int> $updated_by_employee_id) Return ChildOnBoardRequest objects filtered by the updated_by_employee_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByUpdatedByEmployeeId(int|array<int> $updated_by_employee_id) Return ChildOnBoardRequest objects filtered by the updated_by_employee_id column
 * @method     ChildOnBoardRequest[]|Collection findByUpdatedByPositionId(int|array<int> $updated_by_position_id) Return ChildOnBoardRequest objects filtered by the updated_by_position_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByUpdatedByPositionId(int|array<int> $updated_by_position_id) Return ChildOnBoardRequest objects filtered by the updated_by_position_id column
 * @method     ChildOnBoardRequest[]|Collection findByApprovedAt(string|array<string> $approved_at) Return ChildOnBoardRequest objects filtered by the approved_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByApprovedAt(string|array<string> $approved_at) Return ChildOnBoardRequest objects filtered by the approved_at column
 * @method     ChildOnBoardRequest[]|Collection findByApprovedByEmployeeId(int|array<int> $approved_by_employee_id) Return ChildOnBoardRequest objects filtered by the approved_by_employee_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByApprovedByEmployeeId(int|array<int> $approved_by_employee_id) Return ChildOnBoardRequest objects filtered by the approved_by_employee_id column
 * @method     ChildOnBoardRequest[]|Collection findByApprovedByPositionId(int|array<int> $approved_by_position_id) Return ChildOnBoardRequest objects filtered by the approved_by_position_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByApprovedByPositionId(int|array<int> $approved_by_position_id) Return ChildOnBoardRequest objects filtered by the approved_by_position_id column
 * @method     ChildOnBoardRequest[]|Collection findByFinalApprovedAt(string|array<string> $final_approved_at) Return ChildOnBoardRequest objects filtered by the final_approved_at column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByFinalApprovedAt(string|array<string> $final_approved_at) Return ChildOnBoardRequest objects filtered by the final_approved_at column
 * @method     ChildOnBoardRequest[]|Collection findByFinalApprovedByEmployeeId(int|array<int> $final_approved_by_employee_id) Return ChildOnBoardRequest objects filtered by the final_approved_by_employee_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByFinalApprovedByEmployeeId(int|array<int> $final_approved_by_employee_id) Return ChildOnBoardRequest objects filtered by the final_approved_by_employee_id column
 * @method     ChildOnBoardRequest[]|Collection findByFinalApprovedByPositionId(int|array<int> $final_approved_by_position_id) Return ChildOnBoardRequest objects filtered by the final_approved_by_position_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByFinalApprovedByPositionId(int|array<int> $final_approved_by_position_id) Return ChildOnBoardRequest objects filtered by the final_approved_by_position_id column
 * @method     ChildOnBoardRequest[]|Collection findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequest objects filtered by the company_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByCompanyId(int|array<int> $company_id) Return ChildOnBoardRequest objects filtered by the company_id column
 * @method     ChildOnBoardRequest[]|Collection findByDescriptioin(string|array<string> $descriptioin) Return ChildOnBoardRequest objects filtered by the descriptioin column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByDescriptioin(string|array<string> $descriptioin) Return ChildOnBoardRequest objects filtered by the descriptioin column
 * @method     ChildOnBoardRequest[]|Collection findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnBoardRequest objects filtered by the outlet_type_id column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByOutletTypeId(int|array<int> $outlet_type_id) Return ChildOnBoardRequest objects filtered by the outlet_type_id column
 * @method     ChildOnBoardRequest[]|Collection findByOutletName(string|array<string> $outlet_name) Return ChildOnBoardRequest objects filtered by the outlet_name column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByOutletName(string|array<string> $outlet_name) Return ChildOnBoardRequest objects filtered by the outlet_name column
 * @method     ChildOnBoardRequest[]|Collection findByOutletCode(string|array<string> $outlet_code) Return ChildOnBoardRequest objects filtered by the outlet_code column
 * @psalm-method Collection&\Traversable<ChildOnBoardRequest> findByOutletCode(string|array<string> $outlet_code) Return ChildOnBoardRequest objects filtered by the outlet_code column
 *
 * @method     ChildOnBoardRequest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOnBoardRequest> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OnBoardRequestQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\OnBoardRequestQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\OnBoardRequest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOnBoardRequestQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOnBoardRequestQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOnBoardRequestQuery) {
            return $criteria;
        }
        $query = new ChildOnBoardRequestQuery();
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
     * @return ChildOnBoardRequest|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OnBoardRequestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOnBoardRequest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT on_board_request_id, outlet_id, salutation, first_name, last_name, email, mobile, gender, date_of_birth, marital_status, date_of_anniversary, qualification, registration_no, profile_pic, status, territory, position, created_at, created_by_employee_id, created_by_position_id, updated_at, updated_by_employee_id, updated_by_position_id, approved_at, approved_by_employee_id, approved_by_position_id, final_approved_at, final_approved_by_employee_id, final_approved_by_position_id, company_id, descriptioin, outlet_type_id, outlet_name, outlet_code FROM on_board_request WHERE on_board_request_id = :p0';
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
            /** @var ChildOnBoardRequest $obj */
            $obj = new ChildOnBoardRequest();
            $obj->hydrate($row);
            OnBoardRequestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOnBoardRequest|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($onBoardRequestId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletId(1234); // WHERE outlet_id = 1234
     * $query->filterByOutletId(array(12, 34)); // WHERE outlet_id IN (12, 34)
     * $query->filterByOutletId(array('min' => 12)); // WHERE outlet_id > 12
     * </code>
     *
     * @see       filterByOutlets()
     *
     * @param mixed $outletId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletId($outletId = null, ?string $comparison = null)
    {
        if (is_array($outletId)) {
            $useMinMax = false;
            if (isset($outletId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_ID, $outletId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_ID, $outletId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_ID, $outletId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the salutation column
     *
     * Example usage:
     * <code>
     * $query->filterBySalutation('fooValue');   // WHERE salutation = 'fooValue'
     * $query->filterBySalutation('%fooValue%', Criteria::LIKE); // WHERE salutation LIKE '%fooValue%'
     * $query->filterBySalutation(['foo', 'bar']); // WHERE salutation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $salutation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalutation($salutation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salutation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_SALUTATION, $salutation, $comparison);

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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_FIRST_NAME, $firstName, $comparison);

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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByMobile('fooValue');   // WHERE mobile = 'fooValue'
     * $query->filterByMobile('%fooValue%', Criteria::LIKE); // WHERE mobile LIKE '%fooValue%'
     * $query->filterByMobile(['foo', 'bar']); // WHERE mobile IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $mobile The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMobile($mobile = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mobile)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_MOBILE, $mobile, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gender column
     *
     * Example usage:
     * <code>
     * $query->filterByGender('fooValue');   // WHERE gender = 'fooValue'
     * $query->filterByGender('%fooValue%', Criteria::LIKE); // WHERE gender LIKE '%fooValue%'
     * $query->filterByGender(['foo', 'bar']); // WHERE gender IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gender The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGender($gender = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gender)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_GENDER, $gender, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date_of_birth column
     *
     * Example usage:
     * <code>
     * $query->filterByDateOfBirth('2011-03-14'); // WHERE date_of_birth = '2011-03-14'
     * $query->filterByDateOfBirth('now'); // WHERE date_of_birth = '2011-03-14'
     * $query->filterByDateOfBirth(array('max' => 'yesterday')); // WHERE date_of_birth > '2011-03-13'
     * </code>
     *
     * @param mixed $dateOfBirth The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDateOfBirth($dateOfBirth = null, ?string $comparison = null)
    {
        if (is_array($dateOfBirth)) {
            $useMinMax = false;
            if (isset($dateOfBirth['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_BIRTH, $dateOfBirth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateOfBirth['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_BIRTH, $dateOfBirth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_BIRTH, $dateOfBirth, $comparison);

        return $this;
    }

    /**
     * Filter the query on the marital_status column
     *
     * Example usage:
     * <code>
     * $query->filterByMaritalStatus('fooValue');   // WHERE marital_status = 'fooValue'
     * $query->filterByMaritalStatus('%fooValue%', Criteria::LIKE); // WHERE marital_status LIKE '%fooValue%'
     * $query->filterByMaritalStatus(['foo', 'bar']); // WHERE marital_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $maritalStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaritalStatus($maritalStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($maritalStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_MARITAL_STATUS, $maritalStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date_of_anniversary column
     *
     * Example usage:
     * <code>
     * $query->filterByDateOfAnniversary('2011-03-14'); // WHERE date_of_anniversary = '2011-03-14'
     * $query->filterByDateOfAnniversary('now'); // WHERE date_of_anniversary = '2011-03-14'
     * $query->filterByDateOfAnniversary(array('max' => 'yesterday')); // WHERE date_of_anniversary > '2011-03-13'
     * </code>
     *
     * @param mixed $dateOfAnniversary The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDateOfAnniversary($dateOfAnniversary = null, ?string $comparison = null)
    {
        if (is_array($dateOfAnniversary)) {
            $useMinMax = false;
            if (isset($dateOfAnniversary['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY, $dateOfAnniversary['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateOfAnniversary['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY, $dateOfAnniversary['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY, $dateOfAnniversary, $comparison);

        return $this;
    }

    /**
     * Filter the query on the qualification column
     *
     * Example usage:
     * <code>
     * $query->filterByQualification('fooValue');   // WHERE qualification = 'fooValue'
     * $query->filterByQualification('%fooValue%', Criteria::LIKE); // WHERE qualification LIKE '%fooValue%'
     * $query->filterByQualification(['foo', 'bar']); // WHERE qualification IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $qualification The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQualification($qualification = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($qualification)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_QUALIFICATION, $qualification, $comparison);

        return $this;
    }

    /**
     * Filter the query on the registration_no column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistrationNo('fooValue');   // WHERE registration_no = 'fooValue'
     * $query->filterByRegistrationNo('%fooValue%', Criteria::LIKE); // WHERE registration_no LIKE '%fooValue%'
     * $query->filterByRegistrationNo(['foo', 'bar']); // WHERE registration_no IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $registrationNo The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistrationNo($registrationNo = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($registrationNo)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_REGISTRATION_NO, $registrationNo, $comparison);

        return $this;
    }

    /**
     * Filter the query on the profile_pic column
     *
     * Example usage:
     * <code>
     * $query->filterByProfilePic('fooValue');   // WHERE profile_pic = 'fooValue'
     * $query->filterByProfilePic('%fooValue%', Criteria::LIKE); // WHERE profile_pic LIKE '%fooValue%'
     * $query->filterByProfilePic(['foo', 'bar']); // WHERE profile_pic IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $profilePic The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProfilePic($profilePic = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($profilePic)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_PROFILE_PIC, $profilePic, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the territory column
     *
     * Example usage:
     * <code>
     * $query->filterByTerritory(1234); // WHERE territory = 1234
     * $query->filterByTerritory(array(12, 34)); // WHERE territory IN (12, 34)
     * $query->filterByTerritory(array('min' => 12)); // WHERE territory > 12
     * </code>
     *
     * @see       filterByTerritories()
     *
     * @param mixed $territory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritory($territory = null, ?string $comparison = null)
    {
        if (is_array($territory)) {
            $useMinMax = false;
            if (isset($territory['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_TERRITORY, $territory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($territory['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_TERRITORY, $territory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_TERRITORY, $territory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
     * </code>
     *
     * @see       filterByPositionsRelatedByPosition()
     *
     * @param mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition($position = null, ?string $comparison = null)
    {
        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_POSITION, $position, $comparison);

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
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_by_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedByEmployeeId(1234); // WHERE created_by_employee_id = 1234
     * $query->filterByCreatedByEmployeeId(array(12, 34)); // WHERE created_by_employee_id IN (12, 34)
     * $query->filterByCreatedByEmployeeId(array('min' => 12)); // WHERE created_by_employee_id > 12
     * </code>
     *
     * @see       filterByEmployeeRelatedByCreatedByEmployeeId()
     *
     * @param mixed $createdByEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedByEmployeeId($createdByEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($createdByEmployeeId)) {
            $useMinMax = false;
            if (isset($createdByEmployeeId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $createdByEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdByEmployeeId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $createdByEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $createdByEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_by_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedByPositionId(1234); // WHERE created_by_position_id = 1234
     * $query->filterByCreatedByPositionId(array(12, 34)); // WHERE created_by_position_id IN (12, 34)
     * $query->filterByCreatedByPositionId(array('min' => 12)); // WHERE created_by_position_id > 12
     * </code>
     *
     * @see       filterByPositionsRelatedByCreatedByPositionId()
     *
     * @param mixed $createdByPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedByPositionId($createdByPositionId = null, ?string $comparison = null)
    {
        if (is_array($createdByPositionId)) {
            $useMinMax = false;
            if (isset($createdByPositionId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $createdByPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdByPositionId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $createdByPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $createdByPositionId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_by_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedByEmployeeId(1234); // WHERE updated_by_employee_id = 1234
     * $query->filterByUpdatedByEmployeeId(array(12, 34)); // WHERE updated_by_employee_id IN (12, 34)
     * $query->filterByUpdatedByEmployeeId(array('min' => 12)); // WHERE updated_by_employee_id > 12
     * </code>
     *
     * @see       filterByEmployeeRelatedByUpdatedByEmployeeId()
     *
     * @param mixed $updatedByEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedByEmployeeId($updatedByEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($updatedByEmployeeId)) {
            $useMinMax = false;
            if (isset($updatedByEmployeeId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $updatedByEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedByEmployeeId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $updatedByEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $updatedByEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_by_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedByPositionId(1234); // WHERE updated_by_position_id = 1234
     * $query->filterByUpdatedByPositionId(array(12, 34)); // WHERE updated_by_position_id IN (12, 34)
     * $query->filterByUpdatedByPositionId(array('min' => 12)); // WHERE updated_by_position_id > 12
     * </code>
     *
     * @see       filterByPositionsRelatedByUpdatedByPositionId()
     *
     * @param mixed $updatedByPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedByPositionId($updatedByPositionId = null, ?string $comparison = null)
    {
        if (is_array($updatedByPositionId)) {
            $useMinMax = false;
            if (isset($updatedByPositionId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $updatedByPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedByPositionId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $updatedByPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $updatedByPositionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_at column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedAt('2011-03-14'); // WHERE approved_at = '2011-03-14'
     * $query->filterByApprovedAt('now'); // WHERE approved_at = '2011-03-14'
     * $query->filterByApprovedAt(array('max' => 'yesterday')); // WHERE approved_at > '2011-03-13'
     * </code>
     *
     * @param mixed $approvedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedAt($approvedAt = null, ?string $comparison = null)
    {
        if (is_array($approvedAt)) {
            $useMinMax = false;
            if (isset($approvedAt['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_AT, $approvedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedAt['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_AT, $approvedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_AT, $approvedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_by_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedByEmployeeId(1234); // WHERE approved_by_employee_id = 1234
     * $query->filterByApprovedByEmployeeId(array(12, 34)); // WHERE approved_by_employee_id IN (12, 34)
     * $query->filterByApprovedByEmployeeId(array('min' => 12)); // WHERE approved_by_employee_id > 12
     * </code>
     *
     * @see       filterByEmployeeRelatedByApprovedByEmployeeId()
     *
     * @param mixed $approvedByEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedByEmployeeId($approvedByEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($approvedByEmployeeId)) {
            $useMinMax = false;
            if (isset($approvedByEmployeeId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $approvedByEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedByEmployeeId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $approvedByEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $approvedByEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_by_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedByPositionId(1234); // WHERE approved_by_position_id = 1234
     * $query->filterByApprovedByPositionId(array(12, 34)); // WHERE approved_by_position_id IN (12, 34)
     * $query->filterByApprovedByPositionId(array('min' => 12)); // WHERE approved_by_position_id > 12
     * </code>
     *
     * @see       filterByPositionsRelatedByApprovedByPositionId()
     *
     * @param mixed $approvedByPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedByPositionId($approvedByPositionId = null, ?string $comparison = null)
    {
        if (is_array($approvedByPositionId)) {
            $useMinMax = false;
            if (isset($approvedByPositionId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $approvedByPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedByPositionId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $approvedByPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $approvedByPositionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_approved_at column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalApprovedAt('2011-03-14'); // WHERE final_approved_at = '2011-03-14'
     * $query->filterByFinalApprovedAt('now'); // WHERE final_approved_at = '2011-03-14'
     * $query->filterByFinalApprovedAt(array('max' => 'yesterday')); // WHERE final_approved_at > '2011-03-13'
     * </code>
     *
     * @param mixed $finalApprovedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalApprovedAt($finalApprovedAt = null, ?string $comparison = null)
    {
        if (is_array($finalApprovedAt)) {
            $useMinMax = false;
            if (isset($finalApprovedAt['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT, $finalApprovedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalApprovedAt['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT, $finalApprovedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT, $finalApprovedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_approved_by_employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalApprovedByEmployeeId(1234); // WHERE final_approved_by_employee_id = 1234
     * $query->filterByFinalApprovedByEmployeeId(array(12, 34)); // WHERE final_approved_by_employee_id IN (12, 34)
     * $query->filterByFinalApprovedByEmployeeId(array('min' => 12)); // WHERE final_approved_by_employee_id > 12
     * </code>
     *
     * @see       filterByEmployeeRelatedByFinalApprovedByEmployeeId()
     *
     * @param mixed $finalApprovedByEmployeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalApprovedByEmployeeId($finalApprovedByEmployeeId = null, ?string $comparison = null)
    {
        if (is_array($finalApprovedByEmployeeId)) {
            $useMinMax = false;
            if (isset($finalApprovedByEmployeeId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $finalApprovedByEmployeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalApprovedByEmployeeId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $finalApprovedByEmployeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $finalApprovedByEmployeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_approved_by_position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalApprovedByPositionId(1234); // WHERE final_approved_by_position_id = 1234
     * $query->filterByFinalApprovedByPositionId(array(12, 34)); // WHERE final_approved_by_position_id IN (12, 34)
     * $query->filterByFinalApprovedByPositionId(array('min' => 12)); // WHERE final_approved_by_position_id > 12
     * </code>
     *
     * @see       filterByPositionsRelatedByFinalApprovedByPositionId()
     *
     * @param mixed $finalApprovedByPositionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalApprovedByPositionId($finalApprovedByPositionId = null, ?string $comparison = null)
    {
        if (is_array($finalApprovedByPositionId)) {
            $useMinMax = false;
            if (isset($finalApprovedByPositionId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $finalApprovedByPositionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalApprovedByPositionId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $finalApprovedByPositionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $finalApprovedByPositionId, $comparison);

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
                $this->addUsingAlias(OnBoardRequestTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_COMPANY_ID, $companyId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the descriptioin column
     *
     * Example usage:
     * <code>
     * $query->filterByDescriptioin('fooValue');   // WHERE descriptioin = 'fooValue'
     * $query->filterByDescriptioin('%fooValue%', Criteria::LIKE); // WHERE descriptioin LIKE '%fooValue%'
     * $query->filterByDescriptioin(['foo', 'bar']); // WHERE descriptioin IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $descriptioin The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescriptioin($descriptioin = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descriptioin)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_DESCRIPTIOIN, $descriptioin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the outlet_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOutletTypeId(1234); // WHERE outlet_type_id = 1234
     * $query->filterByOutletTypeId(array(12, 34)); // WHERE outlet_type_id IN (12, 34)
     * $query->filterByOutletTypeId(array('min' => 12)); // WHERE outlet_type_id > 12
     * </code>
     *
     * @see       filterByOutletType()
     *
     * @param mixed $outletTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutletTypeId($outletTypeId = null, ?string $comparison = null)
    {
        if (is_array($outletTypeId)) {
            $useMinMax = false;
            if (isset($outletTypeId['min'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($outletTypeId['max'])) {
                $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $outletTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $outletTypeId, $comparison);

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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_NAME, $outletName, $comparison);

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

        $this->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_CODE, $outletCode, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByApprovedByEmployeeId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByApprovedByEmployeeId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByApprovedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByApprovedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByApprovedByEmployeeId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByApprovedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByApprovedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByApprovedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByApprovedByEmployeeId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByApprovedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByApprovedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByApprovedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByApprovedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByApprovedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByApprovedByEmployeeId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByApprovedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByPositionsRelatedByApprovedByPositionId($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByApprovedByPositionId() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByApprovedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByApprovedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByApprovedByPositionId');

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
            $this->addJoinObject($join, 'PositionsRelatedByApprovedByPositionId');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByApprovedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByApprovedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByApprovedByPositionId', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByApprovedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByApprovedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByApprovedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByApprovedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByApprovedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByApprovedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByApprovedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByApprovedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByApprovedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByApprovedByPositionId relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByApprovedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByApprovedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByApprovedByPositionId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OnBoardRequestTableMap::COL_COMPANY_ID, $company->getCompanyId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_COMPANY_ID, $company->toKeyValue('PrimaryKey', 'CompanyId'), $comparison);

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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByCreatedByEmployeeId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByCreatedByEmployeeId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByCreatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByCreatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByCreatedByEmployeeId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByCreatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByCreatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByCreatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByCreatedByEmployeeId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByCreatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByCreatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByCreatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByCreatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByCreatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByCreatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByCreatedByEmployeeId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByCreatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByCreatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByCreatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByPositionsRelatedByCreatedByPositionId($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByCreatedByPositionId() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByCreatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByCreatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByCreatedByPositionId');

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
            $this->addJoinObject($join, 'PositionsRelatedByCreatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByCreatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByCreatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByCreatedByPositionId', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByCreatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByCreatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByCreatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByCreatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByCreatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByCreatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByCreatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByCreatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByCreatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByCreatedByPositionId relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByCreatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByCreatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByCreatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByFinalApprovedByEmployeeId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByFinalApprovedByEmployeeId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByFinalApprovedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByFinalApprovedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByFinalApprovedByEmployeeId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByFinalApprovedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByFinalApprovedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByFinalApprovedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByFinalApprovedByEmployeeId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByFinalApprovedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByFinalApprovedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByFinalApprovedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByFinalApprovedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByFinalApprovedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByFinalApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByFinalApprovedByEmployeeId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByFinalApprovedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByFinalApprovedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByFinalApprovedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByPositionsRelatedByFinalApprovedByPositionId($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByFinalApprovedByPositionId() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByFinalApprovedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByFinalApprovedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByFinalApprovedByPositionId');

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
            $this->addJoinObject($join, 'PositionsRelatedByFinalApprovedByPositionId');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByFinalApprovedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByFinalApprovedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByFinalApprovedByPositionId', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByFinalApprovedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByFinalApprovedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByFinalApprovedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByFinalApprovedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByFinalApprovedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByFinalApprovedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByFinalApprovedByPositionId relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByFinalApprovedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByFinalApprovedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByFinalApprovedByPositionId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Outlets object
     *
     * @param \entities\Outlets|ObjectCollection $outlets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOutlets($outlets, ?string $comparison = null)
    {
        if ($outlets instanceof \entities\Outlets) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_ID, $outlets->getId(), $comparison);
        } elseif ($outlets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_ID, $outlets->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $outletType->getOutlettypeId(), $comparison);
        } elseif ($outletType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $outletType->toKeyValue('PrimaryKey', 'OutlettypeId'), $comparison);

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
     * Filter the query by a related \entities\Positions object
     *
     * @param \entities\Positions|ObjectCollection $positions The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionsRelatedByPosition($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_POSITION, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_POSITION, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByPosition() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByPosition relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByPosition(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByPosition');

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
            $this->addJoinObject($join, 'PositionsRelatedByPosition');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByPosition relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByPositionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByPosition', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByPosition relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByPositionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByPositionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByPosition relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByPositionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByPosition', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByPosition relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByPositionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByPositionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByPosition', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByPosition relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByPositionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByPosition', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByPosition relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByPositionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByPositionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByPosition', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\Territories object
     *
     * @param \entities\Territories|ObjectCollection $territories The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTerritories($territories, ?string $comparison = null)
    {
        if ($territories instanceof \entities\Territories) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_TERRITORY, $territories->getTerritoryId(), $comparison);
        } elseif ($territories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_TERRITORY, $territories->toKeyValue('PrimaryKey', 'TerritoryId'), $comparison);

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
    public function joinTerritories(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useTerritoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \entities\Employee object
     *
     * @param \entities\Employee|ObjectCollection $employee The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeRelatedByUpdatedByEmployeeId($employee, ?string $comparison = null)
    {
        if ($employee instanceof \entities\Employee) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $employee->getEmployeeId(), $comparison);
        } elseif ($employee instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $employee->toKeyValue('PrimaryKey', 'EmployeeId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByEmployeeRelatedByUpdatedByEmployeeId() only accepts arguments of type \entities\Employee or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EmployeeRelatedByUpdatedByEmployeeId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmployeeRelatedByUpdatedByEmployeeId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EmployeeRelatedByUpdatedByEmployeeId');

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
            $this->addJoinObject($join, 'EmployeeRelatedByUpdatedByEmployeeId');
        }

        return $this;
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation Employee object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\EmployeeQuery A secondary query class using the current class as primary query
     */
    public function useEmployeeRelatedByUpdatedByEmployeeIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEmployeeRelatedByUpdatedByEmployeeId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EmployeeRelatedByUpdatedByEmployeeId', '\entities\EmployeeQuery');
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation Employee object
     *
     * @param callable(\entities\EmployeeQuery):\entities\EmployeeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmployeeRelatedByUpdatedByEmployeeIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useEmployeeRelatedByUpdatedByEmployeeIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation to the Employee table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\EmployeeQuery The inner query object of the EXISTS statement
     */
    public function useEmployeeRelatedByUpdatedByEmployeeIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation to the Employee table for a NOT EXISTS query.
     *
     * @see useEmployeeRelatedByUpdatedByEmployeeIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmployeeRelatedByUpdatedByEmployeeIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useExistsQuery('EmployeeRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation to the Employee table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\EmployeeQuery The inner query object of the IN statement
     */
    public function useInEmployeeRelatedByUpdatedByEmployeeIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the EmployeeRelatedByUpdatedByEmployeeId relation to the Employee table for a NOT IN query.
     *
     * @see useEmployeeRelatedByUpdatedByEmployeeIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\EmployeeQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmployeeRelatedByUpdatedByEmployeeIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\EmployeeQuery */
        $q = $this->useInQuery('EmployeeRelatedByUpdatedByEmployeeId', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByPositionsRelatedByUpdatedByPositionId($positions, ?string $comparison = null)
    {
        if ($positions instanceof \entities\Positions) {
            return $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $positions->getPositionId(), $comparison);
        } elseif ($positions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $positions->toKeyValue('PrimaryKey', 'PositionId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPositionsRelatedByUpdatedByPositionId() only accepts arguments of type \entities\Positions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PositionsRelatedByUpdatedByPositionId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPositionsRelatedByUpdatedByPositionId(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PositionsRelatedByUpdatedByPositionId');

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
            $this->addJoinObject($join, 'PositionsRelatedByUpdatedByPositionId');
        }

        return $this;
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation Positions object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\PositionsQuery A secondary query class using the current class as primary query
     */
    public function usePositionsRelatedByUpdatedByPositionIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPositionsRelatedByUpdatedByPositionId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PositionsRelatedByUpdatedByPositionId', '\entities\PositionsQuery');
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation Positions object
     *
     * @param callable(\entities\PositionsQuery):\entities\PositionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPositionsRelatedByUpdatedByPositionIdQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePositionsRelatedByUpdatedByPositionIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation to the Positions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\PositionsQuery The inner query object of the EXISTS statement
     */
    public function usePositionsRelatedByUpdatedByPositionIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByUpdatedByPositionId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation to the Positions table for a NOT EXISTS query.
     *
     * @see usePositionsRelatedByUpdatedByPositionIdExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePositionsRelatedByUpdatedByPositionIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useExistsQuery('PositionsRelatedByUpdatedByPositionId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation to the Positions table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\PositionsQuery The inner query object of the IN statement
     */
    public function useInPositionsRelatedByUpdatedByPositionIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByUpdatedByPositionId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PositionsRelatedByUpdatedByPositionId relation to the Positions table for a NOT IN query.
     *
     * @see usePositionsRelatedByUpdatedByPositionIdInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\PositionsQuery The inner query object of the NOT IN statement
     */
    public function useNotInPositionsRelatedByUpdatedByPositionIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\PositionsQuery */
        $q = $this->useInQuery('PositionsRelatedByUpdatedByPositionId', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestAddress->getOnBoardRequestId(), $comparison);

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
     * Filter the query by a related \entities\OnBoardRequestLog object
     *
     * @param \entities\OnBoardRequestLog|ObjectCollection $onBoardRequestLog the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestLog($onBoardRequestLog, ?string $comparison = null)
    {
        if ($onBoardRequestLog instanceof \entities\OnBoardRequestLog) {
            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestLog->getOnBoardRequestId(), $comparison);

            return $this;
        } elseif ($onBoardRequestLog instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestLogQuery()
                ->filterByPrimaryKeys($onBoardRequestLog->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestLog() only accepts arguments of type \entities\OnBoardRequestLog or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestLog relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestLog(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestLog');

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
            $this->addJoinObject($join, 'OnBoardRequestLog');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestLog relation OnBoardRequestLog object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestLogQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestLog', '\entities\OnBoardRequestLogQuery');
    }

    /**
     * Use the OnBoardRequestLog relation OnBoardRequestLog object
     *
     * @param callable(\entities\OnBoardRequestLogQuery):\entities\OnBoardRequestLogQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestLogQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestLogQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestLog table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestLogExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useExistsQuery('OnBoardRequestLog', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestLogExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestLogNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useExistsQuery('OnBoardRequestLog', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestLogQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useInQuery('OnBoardRequestLog', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestLog table for a NOT IN query.
     *
     * @see useOnBoardRequestLogInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestLogQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestLogQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestLogQuery */
        $q = $this->useInQuery('OnBoardRequestLog', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \entities\OnBoardRequestOutletMapping object
     *
     * @param \entities\OnBoardRequestOutletMapping|ObjectCollection $onBoardRequestOutletMapping the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOnBoardRequestOutletMapping($onBoardRequestOutletMapping, ?string $comparison = null)
    {
        if ($onBoardRequestOutletMapping instanceof \entities\OnBoardRequestOutletMapping) {
            $this
                ->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequestOutletMapping->getOnBoardRequestId(), $comparison);

            return $this;
        } elseif ($onBoardRequestOutletMapping instanceof ObjectCollection) {
            $this
                ->useOnBoardRequestOutletMappingQuery()
                ->filterByPrimaryKeys($onBoardRequestOutletMapping->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOnBoardRequestOutletMapping() only accepts arguments of type \entities\OnBoardRequestOutletMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OnBoardRequestOutletMapping relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOnBoardRequestOutletMapping(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OnBoardRequestOutletMapping');

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
            $this->addJoinObject($join, 'OnBoardRequestOutletMapping');
        }

        return $this;
    }

    /**
     * Use the OnBoardRequestOutletMapping relation OnBoardRequestOutletMapping object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \entities\OnBoardRequestOutletMappingQuery A secondary query class using the current class as primary query
     */
    public function useOnBoardRequestOutletMappingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOnBoardRequestOutletMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OnBoardRequestOutletMapping', '\entities\OnBoardRequestOutletMappingQuery');
    }

    /**
     * Use the OnBoardRequestOutletMapping relation OnBoardRequestOutletMapping object
     *
     * @param callable(\entities\OnBoardRequestOutletMappingQuery):\entities\OnBoardRequestOutletMappingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOnBoardRequestOutletMappingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOnBoardRequestOutletMappingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the EXISTS statement
     */
    public function useOnBoardRequestOutletMappingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useExistsQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for a NOT EXISTS query.
     *
     * @see useOnBoardRequestOutletMappingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the NOT EXISTS statement
     */
    public function useOnBoardRequestOutletMappingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useExistsQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the IN statement
     */
    public function useInOnBoardRequestOutletMappingQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useInQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OnBoardRequestOutletMapping table for a NOT IN query.
     *
     * @see useOnBoardRequestOutletMappingInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \entities\OnBoardRequestOutletMappingQuery The inner query object of the NOT IN statement
     */
    public function useNotInOnBoardRequestOutletMappingQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \entities\OnBoardRequestOutletMappingQuery */
        $q = $this->useInQuery('OnBoardRequestOutletMapping', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOnBoardRequest $onBoardRequest Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($onBoardRequest = null)
    {
        if ($onBoardRequest) {
            $this->addUsingAlias(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $onBoardRequest->getOnBoardRequestId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the on_board_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OnBoardRequestTableMap::clearInstancePool();
            OnBoardRequestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OnBoardRequestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OnBoardRequestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OnBoardRequestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}

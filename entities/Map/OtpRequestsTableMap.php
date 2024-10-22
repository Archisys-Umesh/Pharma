<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\OtpRequests;
use entities\OtpRequestsQuery;


/**
 * This class defines the structure of the 'otp_requests' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OtpRequestsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OtpRequestsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'otp_requests';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OtpRequests';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OtpRequests';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OtpRequests';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the otpreqid field
     */
    public const COL_OTPREQID = 'otp_requests.otpreqid';

    /**
     * the column name for the otp_req_mobile field
     */
    public const COL_OTP_REQ_MOBILE = 'otp_requests.otp_req_mobile';

    /**
     * the column name for the otp_req_countrycode field
     */
    public const COL_OTP_REQ_COUNTRYCODE = 'otp_requests.otp_req_countrycode';

    /**
     * the column name for the otp_request_reason field
     */
    public const COL_OTP_REQUEST_REASON = 'otp_requests.otp_request_reason';

    /**
     * the column name for the otp_doc_id field
     */
    public const COL_OTP_DOC_ID = 'otp_requests.otp_doc_id';

    /**
     * the column name for the otp field
     */
    public const COL_OTP = 'otp_requests.otp';

    /**
     * the column name for the otp_request_employee field
     */
    public const COL_OTP_REQUEST_EMPLOYEE = 'otp_requests.otp_request_employee';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'otp_requests.company_id';

    /**
     * the column name for the otp_req_created_date field
     */
    public const COL_OTP_REQ_CREATED_DATE = 'otp_requests.otp_req_created_date';

    /**
     * the column name for the otp_verified field
     */
    public const COL_OTP_VERIFIED = 'otp_requests.otp_verified';

    /**
     * the column name for the otp_verified_date field
     */
    public const COL_OTP_VERIFIED_DATE = 'otp_requests.otp_verified_date';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Otpreqid', 'OtpReqMobile', 'OtpReqCountrycode', 'OtpRequestReason', 'OtpDocId', 'Otp', 'OtpRequestEmployee', 'CompanyId', 'OtpReqCreatedDate', 'OtpVerified', 'OtpVerifiedDate', ],
        self::TYPE_CAMELNAME     => ['otpreqid', 'otpReqMobile', 'otpReqCountrycode', 'otpRequestReason', 'otpDocId', 'otp', 'otpRequestEmployee', 'companyId', 'otpReqCreatedDate', 'otpVerified', 'otpVerifiedDate', ],
        self::TYPE_COLNAME       => [OtpRequestsTableMap::COL_OTPREQID, OtpRequestsTableMap::COL_OTP_REQ_MOBILE, OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE, OtpRequestsTableMap::COL_OTP_REQUEST_REASON, OtpRequestsTableMap::COL_OTP_DOC_ID, OtpRequestsTableMap::COL_OTP, OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE, OtpRequestsTableMap::COL_COMPANY_ID, OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE, OtpRequestsTableMap::COL_OTP_VERIFIED, OtpRequestsTableMap::COL_OTP_VERIFIED_DATE, ],
        self::TYPE_FIELDNAME     => ['otpreqid', 'otp_req_mobile', 'otp_req_countrycode', 'otp_request_reason', 'otp_doc_id', 'otp', 'otp_request_employee', 'company_id', 'otp_req_created_date', 'otp_verified', 'otp_verified_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Otpreqid' => 0, 'OtpReqMobile' => 1, 'OtpReqCountrycode' => 2, 'OtpRequestReason' => 3, 'OtpDocId' => 4, 'Otp' => 5, 'OtpRequestEmployee' => 6, 'CompanyId' => 7, 'OtpReqCreatedDate' => 8, 'OtpVerified' => 9, 'OtpVerifiedDate' => 10, ],
        self::TYPE_CAMELNAME     => ['otpreqid' => 0, 'otpReqMobile' => 1, 'otpReqCountrycode' => 2, 'otpRequestReason' => 3, 'otpDocId' => 4, 'otp' => 5, 'otpRequestEmployee' => 6, 'companyId' => 7, 'otpReqCreatedDate' => 8, 'otpVerified' => 9, 'otpVerifiedDate' => 10, ],
        self::TYPE_COLNAME       => [OtpRequestsTableMap::COL_OTPREQID => 0, OtpRequestsTableMap::COL_OTP_REQ_MOBILE => 1, OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE => 2, OtpRequestsTableMap::COL_OTP_REQUEST_REASON => 3, OtpRequestsTableMap::COL_OTP_DOC_ID => 4, OtpRequestsTableMap::COL_OTP => 5, OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE => 6, OtpRequestsTableMap::COL_COMPANY_ID => 7, OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE => 8, OtpRequestsTableMap::COL_OTP_VERIFIED => 9, OtpRequestsTableMap::COL_OTP_VERIFIED_DATE => 10, ],
        self::TYPE_FIELDNAME     => ['otpreqid' => 0, 'otp_req_mobile' => 1, 'otp_req_countrycode' => 2, 'otp_request_reason' => 3, 'otp_doc_id' => 4, 'otp' => 5, 'otp_request_employee' => 6, 'company_id' => 7, 'otp_req_created_date' => 8, 'otp_verified' => 9, 'otp_verified_date' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Otpreqid' => 'OTPREQID',
        'OtpRequests.Otpreqid' => 'OTPREQID',
        'otpreqid' => 'OTPREQID',
        'otpRequests.otpreqid' => 'OTPREQID',
        'OtpRequestsTableMap::COL_OTPREQID' => 'OTPREQID',
        'COL_OTPREQID' => 'OTPREQID',
        'otp_requests.otpreqid' => 'OTPREQID',
        'OtpReqMobile' => 'OTP_REQ_MOBILE',
        'OtpRequests.OtpReqMobile' => 'OTP_REQ_MOBILE',
        'otpReqMobile' => 'OTP_REQ_MOBILE',
        'otpRequests.otpReqMobile' => 'OTP_REQ_MOBILE',
        'OtpRequestsTableMap::COL_OTP_REQ_MOBILE' => 'OTP_REQ_MOBILE',
        'COL_OTP_REQ_MOBILE' => 'OTP_REQ_MOBILE',
        'otp_req_mobile' => 'OTP_REQ_MOBILE',
        'otp_requests.otp_req_mobile' => 'OTP_REQ_MOBILE',
        'OtpReqCountrycode' => 'OTP_REQ_COUNTRYCODE',
        'OtpRequests.OtpReqCountrycode' => 'OTP_REQ_COUNTRYCODE',
        'otpReqCountrycode' => 'OTP_REQ_COUNTRYCODE',
        'otpRequests.otpReqCountrycode' => 'OTP_REQ_COUNTRYCODE',
        'OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE' => 'OTP_REQ_COUNTRYCODE',
        'COL_OTP_REQ_COUNTRYCODE' => 'OTP_REQ_COUNTRYCODE',
        'otp_req_countrycode' => 'OTP_REQ_COUNTRYCODE',
        'otp_requests.otp_req_countrycode' => 'OTP_REQ_COUNTRYCODE',
        'OtpRequestReason' => 'OTP_REQUEST_REASON',
        'OtpRequests.OtpRequestReason' => 'OTP_REQUEST_REASON',
        'otpRequestReason' => 'OTP_REQUEST_REASON',
        'otpRequests.otpRequestReason' => 'OTP_REQUEST_REASON',
        'OtpRequestsTableMap::COL_OTP_REQUEST_REASON' => 'OTP_REQUEST_REASON',
        'COL_OTP_REQUEST_REASON' => 'OTP_REQUEST_REASON',
        'otp_request_reason' => 'OTP_REQUEST_REASON',
        'otp_requests.otp_request_reason' => 'OTP_REQUEST_REASON',
        'OtpDocId' => 'OTP_DOC_ID',
        'OtpRequests.OtpDocId' => 'OTP_DOC_ID',
        'otpDocId' => 'OTP_DOC_ID',
        'otpRequests.otpDocId' => 'OTP_DOC_ID',
        'OtpRequestsTableMap::COL_OTP_DOC_ID' => 'OTP_DOC_ID',
        'COL_OTP_DOC_ID' => 'OTP_DOC_ID',
        'otp_doc_id' => 'OTP_DOC_ID',
        'otp_requests.otp_doc_id' => 'OTP_DOC_ID',
        'Otp' => 'OTP',
        'OtpRequests.Otp' => 'OTP',
        'otp' => 'OTP',
        'otpRequests.otp' => 'OTP',
        'OtpRequestsTableMap::COL_OTP' => 'OTP',
        'COL_OTP' => 'OTP',
        'otp_requests.otp' => 'OTP',
        'OtpRequestEmployee' => 'OTP_REQUEST_EMPLOYEE',
        'OtpRequests.OtpRequestEmployee' => 'OTP_REQUEST_EMPLOYEE',
        'otpRequestEmployee' => 'OTP_REQUEST_EMPLOYEE',
        'otpRequests.otpRequestEmployee' => 'OTP_REQUEST_EMPLOYEE',
        'OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE' => 'OTP_REQUEST_EMPLOYEE',
        'COL_OTP_REQUEST_EMPLOYEE' => 'OTP_REQUEST_EMPLOYEE',
        'otp_request_employee' => 'OTP_REQUEST_EMPLOYEE',
        'otp_requests.otp_request_employee' => 'OTP_REQUEST_EMPLOYEE',
        'CompanyId' => 'COMPANY_ID',
        'OtpRequests.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'otpRequests.companyId' => 'COMPANY_ID',
        'OtpRequestsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'otp_requests.company_id' => 'COMPANY_ID',
        'OtpReqCreatedDate' => 'OTP_REQ_CREATED_DATE',
        'OtpRequests.OtpReqCreatedDate' => 'OTP_REQ_CREATED_DATE',
        'otpReqCreatedDate' => 'OTP_REQ_CREATED_DATE',
        'otpRequests.otpReqCreatedDate' => 'OTP_REQ_CREATED_DATE',
        'OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE' => 'OTP_REQ_CREATED_DATE',
        'COL_OTP_REQ_CREATED_DATE' => 'OTP_REQ_CREATED_DATE',
        'otp_req_created_date' => 'OTP_REQ_CREATED_DATE',
        'otp_requests.otp_req_created_date' => 'OTP_REQ_CREATED_DATE',
        'OtpVerified' => 'OTP_VERIFIED',
        'OtpRequests.OtpVerified' => 'OTP_VERIFIED',
        'otpVerified' => 'OTP_VERIFIED',
        'otpRequests.otpVerified' => 'OTP_VERIFIED',
        'OtpRequestsTableMap::COL_OTP_VERIFIED' => 'OTP_VERIFIED',
        'COL_OTP_VERIFIED' => 'OTP_VERIFIED',
        'otp_verified' => 'OTP_VERIFIED',
        'otp_requests.otp_verified' => 'OTP_VERIFIED',
        'OtpVerifiedDate' => 'OTP_VERIFIED_DATE',
        'OtpRequests.OtpVerifiedDate' => 'OTP_VERIFIED_DATE',
        'otpVerifiedDate' => 'OTP_VERIFIED_DATE',
        'otpRequests.otpVerifiedDate' => 'OTP_VERIFIED_DATE',
        'OtpRequestsTableMap::COL_OTP_VERIFIED_DATE' => 'OTP_VERIFIED_DATE',
        'COL_OTP_VERIFIED_DATE' => 'OTP_VERIFIED_DATE',
        'otp_verified_date' => 'OTP_VERIFIED_DATE',
        'otp_requests.otp_verified_date' => 'OTP_VERIFIED_DATE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('otp_requests');
        $this->setPhpName('OtpRequests');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OtpRequests');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('otp_requests_otpreqid_seq');
        // columns
        $this->addPrimaryKey('otpreqid', 'Otpreqid', 'INTEGER', true, null, null);
        $this->addColumn('otp_req_mobile', 'OtpReqMobile', 'VARCHAR', true, 10, null);
        $this->addColumn('otp_req_countrycode', 'OtpReqCountrycode', 'VARCHAR', true, 10, null);
        $this->addColumn('otp_request_reason', 'OtpRequestReason', 'VARCHAR', true, 250, null);
        $this->addColumn('otp_doc_id', 'OtpDocId', 'INTEGER', true, null, 0);
        $this->addColumn('otp', 'Otp', 'INTEGER', true, null, null);
        $this->addForeignKey('otp_request_employee', 'OtpRequestEmployee', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('otp_req_created_date', 'OtpReqCreatedDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('otp_verified', 'OtpVerified', 'INTEGER', true, null, 0);
        $this->addColumn('otp_verified_date', 'OtpVerifiedDate', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':otp_request_employee',
    1 => ':employee_id',
  ),
), null, null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Otpreqid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? OtpRequestsTableMap::CLASS_DEFAULT : OtpRequestsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (OtpRequests object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OtpRequestsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OtpRequestsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OtpRequestsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OtpRequestsTableMap::OM_CLASS;
            /** @var OtpRequests $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OtpRequestsTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = OtpRequestsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OtpRequestsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OtpRequests $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OtpRequestsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTPREQID);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_MOBILE);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_REQUEST_REASON);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_DOC_ID);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_VERIFIED);
            $criteria->addSelectColumn(OtpRequestsTableMap::COL_OTP_VERIFIED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.otpreqid');
            $criteria->addSelectColumn($alias . '.otp_req_mobile');
            $criteria->addSelectColumn($alias . '.otp_req_countrycode');
            $criteria->addSelectColumn($alias . '.otp_request_reason');
            $criteria->addSelectColumn($alias . '.otp_doc_id');
            $criteria->addSelectColumn($alias . '.otp');
            $criteria->addSelectColumn($alias . '.otp_request_employee');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.otp_req_created_date');
            $criteria->addSelectColumn($alias . '.otp_verified');
            $criteria->addSelectColumn($alias . '.otp_verified_date');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTPREQID);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_MOBILE);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_COUNTRYCODE);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_REQUEST_REASON);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_DOC_ID);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_REQUEST_EMPLOYEE);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_REQ_CREATED_DATE);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_VERIFIED);
            $criteria->removeSelectColumn(OtpRequestsTableMap::COL_OTP_VERIFIED_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.otpreqid');
            $criteria->removeSelectColumn($alias . '.otp_req_mobile');
            $criteria->removeSelectColumn($alias . '.otp_req_countrycode');
            $criteria->removeSelectColumn($alias . '.otp_request_reason');
            $criteria->removeSelectColumn($alias . '.otp_doc_id');
            $criteria->removeSelectColumn($alias . '.otp');
            $criteria->removeSelectColumn($alias . '.otp_request_employee');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.otp_req_created_date');
            $criteria->removeSelectColumn($alias . '.otp_verified');
            $criteria->removeSelectColumn($alias . '.otp_verified_date');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(OtpRequestsTableMap::DATABASE_NAME)->getTable(OtpRequestsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OtpRequests or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OtpRequests object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OtpRequestsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OtpRequests) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OtpRequestsTableMap::DATABASE_NAME);
            $criteria->add(OtpRequestsTableMap::COL_OTPREQID, (array) $values, Criteria::IN);
        }

        $query = OtpRequestsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OtpRequestsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OtpRequestsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the otp_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OtpRequestsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OtpRequests or Criteria object.
     *
     * @param mixed $criteria Criteria or OtpRequests object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OtpRequestsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OtpRequests object
        }

        if ($criteria->containsKey(OtpRequestsTableMap::COL_OTPREQID) && $criteria->keyContainsValue(OtpRequestsTableMap::COL_OTPREQID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OtpRequestsTableMap::COL_OTPREQID.')');
        }


        // Set the correct dbName
        $query = OtpRequestsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

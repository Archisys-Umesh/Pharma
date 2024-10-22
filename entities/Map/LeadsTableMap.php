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
use entities\Leads;
use entities\LeadsQuery;


/**
 * This class defines the structure of the 'leads' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LeadsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LeadsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'leads';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Leads';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Leads';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Leads';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the lead_id field
     */
    public const COL_LEAD_ID = 'leads.lead_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'leads.position_id';

    /**
     * the column name for the classification_id field
     */
    public const COL_CLASSIFICATION_ID = 'leads.classification_id';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'leads.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'leads.last_name';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'leads.email';

    /**
     * the column name for the mobile field
     */
    public const COL_MOBILE = 'leads.mobile';

    /**
     * the column name for the gender field
     */
    public const COL_GENDER = 'leads.gender';

    /**
     * the column name for the dob field
     */
    public const COL_DOB = 'leads.dob';

    /**
     * the column name for the marital_status field
     */
    public const COL_MARITAL_STATUS = 'leads.marital_status';

    /**
     * the column name for the anniversary field
     */
    public const COL_ANNIVERSARY = 'leads.anniversary';

    /**
     * the column name for the education field
     */
    public const COL_EDUCATION = 'leads.education';

    /**
     * the column name for the reg_no field
     */
    public const COL_REG_NO = 'leads.reg_no';

    /**
     * the column name for the reason field
     */
    public const COL_REASON = 'leads.reason';

    /**
     * the column name for the device_timestamp field
     */
    public const COL_DEVICE_TIMESTAMP = 'leads.device_timestamp';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'leads.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'leads.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'leads.updated_at';

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
        self::TYPE_PHPNAME       => ['LeadId', 'PositionId', 'ClassificationId', 'FirstName', 'LastName', 'Email', 'Mobile', 'Gender', 'Dob', 'MaritalStatus', 'Anniversary', 'Education', 'RegNo', 'Reason', 'DeviceTimestamp', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['leadId', 'positionId', 'classificationId', 'firstName', 'lastName', 'email', 'mobile', 'gender', 'dob', 'maritalStatus', 'anniversary', 'education', 'regNo', 'reason', 'deviceTimestamp', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [LeadsTableMap::COL_LEAD_ID, LeadsTableMap::COL_POSITION_ID, LeadsTableMap::COL_CLASSIFICATION_ID, LeadsTableMap::COL_FIRST_NAME, LeadsTableMap::COL_LAST_NAME, LeadsTableMap::COL_EMAIL, LeadsTableMap::COL_MOBILE, LeadsTableMap::COL_GENDER, LeadsTableMap::COL_DOB, LeadsTableMap::COL_MARITAL_STATUS, LeadsTableMap::COL_ANNIVERSARY, LeadsTableMap::COL_EDUCATION, LeadsTableMap::COL_REG_NO, LeadsTableMap::COL_REASON, LeadsTableMap::COL_DEVICE_TIMESTAMP, LeadsTableMap::COL_COMPANY_ID, LeadsTableMap::COL_CREATED_AT, LeadsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['lead_id', 'position_id', 'classification_id', 'first_name', 'last_name', 'email', 'mobile', 'gender', 'dob', 'marital_status', 'anniversary', 'education', 'reg_no', 'reason', 'device_timestamp', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
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
        self::TYPE_PHPNAME       => ['LeadId' => 0, 'PositionId' => 1, 'ClassificationId' => 2, 'FirstName' => 3, 'LastName' => 4, 'Email' => 5, 'Mobile' => 6, 'Gender' => 7, 'Dob' => 8, 'MaritalStatus' => 9, 'Anniversary' => 10, 'Education' => 11, 'RegNo' => 12, 'Reason' => 13, 'DeviceTimestamp' => 14, 'CompanyId' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ],
        self::TYPE_CAMELNAME     => ['leadId' => 0, 'positionId' => 1, 'classificationId' => 2, 'firstName' => 3, 'lastName' => 4, 'email' => 5, 'mobile' => 6, 'gender' => 7, 'dob' => 8, 'maritalStatus' => 9, 'anniversary' => 10, 'education' => 11, 'regNo' => 12, 'reason' => 13, 'deviceTimestamp' => 14, 'companyId' => 15, 'createdAt' => 16, 'updatedAt' => 17, ],
        self::TYPE_COLNAME       => [LeadsTableMap::COL_LEAD_ID => 0, LeadsTableMap::COL_POSITION_ID => 1, LeadsTableMap::COL_CLASSIFICATION_ID => 2, LeadsTableMap::COL_FIRST_NAME => 3, LeadsTableMap::COL_LAST_NAME => 4, LeadsTableMap::COL_EMAIL => 5, LeadsTableMap::COL_MOBILE => 6, LeadsTableMap::COL_GENDER => 7, LeadsTableMap::COL_DOB => 8, LeadsTableMap::COL_MARITAL_STATUS => 9, LeadsTableMap::COL_ANNIVERSARY => 10, LeadsTableMap::COL_EDUCATION => 11, LeadsTableMap::COL_REG_NO => 12, LeadsTableMap::COL_REASON => 13, LeadsTableMap::COL_DEVICE_TIMESTAMP => 14, LeadsTableMap::COL_COMPANY_ID => 15, LeadsTableMap::COL_CREATED_AT => 16, LeadsTableMap::COL_UPDATED_AT => 17, ],
        self::TYPE_FIELDNAME     => ['lead_id' => 0, 'position_id' => 1, 'classification_id' => 2, 'first_name' => 3, 'last_name' => 4, 'email' => 5, 'mobile' => 6, 'gender' => 7, 'dob' => 8, 'marital_status' => 9, 'anniversary' => 10, 'education' => 11, 'reg_no' => 12, 'reason' => 13, 'device_timestamp' => 14, 'company_id' => 15, 'created_at' => 16, 'updated_at' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LeadId' => 'LEAD_ID',
        'Leads.LeadId' => 'LEAD_ID',
        'leadId' => 'LEAD_ID',
        'leads.leadId' => 'LEAD_ID',
        'LeadsTableMap::COL_LEAD_ID' => 'LEAD_ID',
        'COL_LEAD_ID' => 'LEAD_ID',
        'lead_id' => 'LEAD_ID',
        'leads.lead_id' => 'LEAD_ID',
        'PositionId' => 'POSITION_ID',
        'Leads.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'leads.positionId' => 'POSITION_ID',
        'LeadsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'leads.position_id' => 'POSITION_ID',
        'ClassificationId' => 'CLASSIFICATION_ID',
        'Leads.ClassificationId' => 'CLASSIFICATION_ID',
        'classificationId' => 'CLASSIFICATION_ID',
        'leads.classificationId' => 'CLASSIFICATION_ID',
        'LeadsTableMap::COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'classification_id' => 'CLASSIFICATION_ID',
        'leads.classification_id' => 'CLASSIFICATION_ID',
        'FirstName' => 'FIRST_NAME',
        'Leads.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'leads.firstName' => 'FIRST_NAME',
        'LeadsTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'leads.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'Leads.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'leads.lastName' => 'LAST_NAME',
        'LeadsTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'leads.last_name' => 'LAST_NAME',
        'Email' => 'EMAIL',
        'Leads.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'leads.email' => 'EMAIL',
        'LeadsTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'Mobile' => 'MOBILE',
        'Leads.Mobile' => 'MOBILE',
        'mobile' => 'MOBILE',
        'leads.mobile' => 'MOBILE',
        'LeadsTableMap::COL_MOBILE' => 'MOBILE',
        'COL_MOBILE' => 'MOBILE',
        'Gender' => 'GENDER',
        'Leads.Gender' => 'GENDER',
        'gender' => 'GENDER',
        'leads.gender' => 'GENDER',
        'LeadsTableMap::COL_GENDER' => 'GENDER',
        'COL_GENDER' => 'GENDER',
        'Dob' => 'DOB',
        'Leads.Dob' => 'DOB',
        'dob' => 'DOB',
        'leads.dob' => 'DOB',
        'LeadsTableMap::COL_DOB' => 'DOB',
        'COL_DOB' => 'DOB',
        'MaritalStatus' => 'MARITAL_STATUS',
        'Leads.MaritalStatus' => 'MARITAL_STATUS',
        'maritalStatus' => 'MARITAL_STATUS',
        'leads.maritalStatus' => 'MARITAL_STATUS',
        'LeadsTableMap::COL_MARITAL_STATUS' => 'MARITAL_STATUS',
        'COL_MARITAL_STATUS' => 'MARITAL_STATUS',
        'marital_status' => 'MARITAL_STATUS',
        'leads.marital_status' => 'MARITAL_STATUS',
        'Anniversary' => 'ANNIVERSARY',
        'Leads.Anniversary' => 'ANNIVERSARY',
        'anniversary' => 'ANNIVERSARY',
        'leads.anniversary' => 'ANNIVERSARY',
        'LeadsTableMap::COL_ANNIVERSARY' => 'ANNIVERSARY',
        'COL_ANNIVERSARY' => 'ANNIVERSARY',
        'Education' => 'EDUCATION',
        'Leads.Education' => 'EDUCATION',
        'education' => 'EDUCATION',
        'leads.education' => 'EDUCATION',
        'LeadsTableMap::COL_EDUCATION' => 'EDUCATION',
        'COL_EDUCATION' => 'EDUCATION',
        'RegNo' => 'REG_NO',
        'Leads.RegNo' => 'REG_NO',
        'regNo' => 'REG_NO',
        'leads.regNo' => 'REG_NO',
        'LeadsTableMap::COL_REG_NO' => 'REG_NO',
        'COL_REG_NO' => 'REG_NO',
        'reg_no' => 'REG_NO',
        'leads.reg_no' => 'REG_NO',
        'Reason' => 'REASON',
        'Leads.Reason' => 'REASON',
        'reason' => 'REASON',
        'leads.reason' => 'REASON',
        'LeadsTableMap::COL_REASON' => 'REASON',
        'COL_REASON' => 'REASON',
        'DeviceTimestamp' => 'DEVICE_TIMESTAMP',
        'Leads.DeviceTimestamp' => 'DEVICE_TIMESTAMP',
        'deviceTimestamp' => 'DEVICE_TIMESTAMP',
        'leads.deviceTimestamp' => 'DEVICE_TIMESTAMP',
        'LeadsTableMap::COL_DEVICE_TIMESTAMP' => 'DEVICE_TIMESTAMP',
        'COL_DEVICE_TIMESTAMP' => 'DEVICE_TIMESTAMP',
        'device_timestamp' => 'DEVICE_TIMESTAMP',
        'leads.device_timestamp' => 'DEVICE_TIMESTAMP',
        'CompanyId' => 'COMPANY_ID',
        'Leads.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'leads.companyId' => 'COMPANY_ID',
        'LeadsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'leads.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Leads.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'leads.createdAt' => 'CREATED_AT',
        'LeadsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'leads.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Leads.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'leads.updatedAt' => 'UPDATED_AT',
        'LeadsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'leads.updated_at' => 'UPDATED_AT',
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
        $this->setName('leads');
        $this->setPhpName('Leads');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Leads');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('leads_lead_id_seq');
        // columns
        $this->addPrimaryKey('lead_id', 'LeadId', 'INTEGER', true, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('classification_id', 'ClassificationId', 'INTEGER', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, null, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, null, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, null, null);
        $this->addColumn('gender', 'Gender', 'VARCHAR', false, null, null);
        $this->addColumn('dob', 'Dob', 'DATE', false, null, null);
        $this->addColumn('marital_status', 'MaritalStatus', 'INTEGER', false, null, null);
        $this->addColumn('anniversary', 'Anniversary', 'DATE', false, null, null);
        $this->addColumn('education', 'Education', 'VARCHAR', false, null, null);
        $this->addColumn('reg_no', 'RegNo', 'VARCHAR', false, null, null);
        $this->addColumn('reason', 'Reason', 'VARCHAR', false, null, null);
        $this->addColumn('device_timestamp', 'DeviceTimestamp', 'TIMESTAMP', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LeadId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LeadsTableMap::CLASS_DEFAULT : LeadsTableMap::OM_CLASS;
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
     * @return array (Leads object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LeadsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LeadsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LeadsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeadsTableMap::OM_CLASS;
            /** @var Leads $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LeadsTableMap::addInstanceToPool($obj, $key);
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
            $key = LeadsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LeadsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Leads $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeadsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LeadsTableMap::COL_LEAD_ID);
            $criteria->addSelectColumn(LeadsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(LeadsTableMap::COL_CLASSIFICATION_ID);
            $criteria->addSelectColumn(LeadsTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(LeadsTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(LeadsTableMap::COL_EMAIL);
            $criteria->addSelectColumn(LeadsTableMap::COL_MOBILE);
            $criteria->addSelectColumn(LeadsTableMap::COL_GENDER);
            $criteria->addSelectColumn(LeadsTableMap::COL_DOB);
            $criteria->addSelectColumn(LeadsTableMap::COL_MARITAL_STATUS);
            $criteria->addSelectColumn(LeadsTableMap::COL_ANNIVERSARY);
            $criteria->addSelectColumn(LeadsTableMap::COL_EDUCATION);
            $criteria->addSelectColumn(LeadsTableMap::COL_REG_NO);
            $criteria->addSelectColumn(LeadsTableMap::COL_REASON);
            $criteria->addSelectColumn(LeadsTableMap::COL_DEVICE_TIMESTAMP);
            $criteria->addSelectColumn(LeadsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(LeadsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LeadsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.lead_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.classification_id');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.dob');
            $criteria->addSelectColumn($alias . '.marital_status');
            $criteria->addSelectColumn($alias . '.anniversary');
            $criteria->addSelectColumn($alias . '.education');
            $criteria->addSelectColumn($alias . '.reg_no');
            $criteria->addSelectColumn($alias . '.reason');
            $criteria->addSelectColumn($alias . '.device_timestamp');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(LeadsTableMap::COL_LEAD_ID);
            $criteria->removeSelectColumn(LeadsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(LeadsTableMap::COL_CLASSIFICATION_ID);
            $criteria->removeSelectColumn(LeadsTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(LeadsTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(LeadsTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(LeadsTableMap::COL_MOBILE);
            $criteria->removeSelectColumn(LeadsTableMap::COL_GENDER);
            $criteria->removeSelectColumn(LeadsTableMap::COL_DOB);
            $criteria->removeSelectColumn(LeadsTableMap::COL_MARITAL_STATUS);
            $criteria->removeSelectColumn(LeadsTableMap::COL_ANNIVERSARY);
            $criteria->removeSelectColumn(LeadsTableMap::COL_EDUCATION);
            $criteria->removeSelectColumn(LeadsTableMap::COL_REG_NO);
            $criteria->removeSelectColumn(LeadsTableMap::COL_REASON);
            $criteria->removeSelectColumn(LeadsTableMap::COL_DEVICE_TIMESTAMP);
            $criteria->removeSelectColumn(LeadsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(LeadsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LeadsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.lead_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.classification_id');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.mobile');
            $criteria->removeSelectColumn($alias . '.gender');
            $criteria->removeSelectColumn($alias . '.dob');
            $criteria->removeSelectColumn($alias . '.marital_status');
            $criteria->removeSelectColumn($alias . '.anniversary');
            $criteria->removeSelectColumn($alias . '.education');
            $criteria->removeSelectColumn($alias . '.reg_no');
            $criteria->removeSelectColumn($alias . '.reason');
            $criteria->removeSelectColumn($alias . '.device_timestamp');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(LeadsTableMap::DATABASE_NAME)->getTable(LeadsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Leads or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Leads object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LeadsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Leads) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeadsTableMap::DATABASE_NAME);
            $criteria->add(LeadsTableMap::COL_LEAD_ID, (array) $values, Criteria::IN);
        }

        $query = LeadsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LeadsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LeadsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the leads table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LeadsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Leads or Criteria object.
     *
     * @param mixed $criteria Criteria or Leads object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeadsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Leads object
        }

        if ($criteria->containsKey(LeadsTableMap::COL_LEAD_ID) && $criteria->keyContainsValue(LeadsTableMap::COL_LEAD_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeadsTableMap::COL_LEAD_ID.')');
        }


        // Set the correct dbName
        $query = LeadsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

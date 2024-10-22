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
use entities\Mtp;
use entities\MtpQuery;


/**
 * This class defines the structure of the 'mtp' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MtpTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MtpTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'mtp';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Mtp';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Mtp';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Mtp';

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
     * the column name for the mtp_id field
     */
    public const COL_MTP_ID = 'mtp.mtp_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'mtp.position_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'mtp.company_id';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'mtp.month';

    /**
     * the column name for the mtp_status field
     */
    public const COL_MTP_STATUS = 'mtp.mtp_status';

    /**
     * the column name for the mtp_approved_by field
     */
    public const COL_MTP_APPROVED_BY = 'mtp.mtp_approved_by';

    /**
     * the column name for the approved_date field
     */
    public const COL_APPROVED_DATE = 'mtp.approved_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'mtp.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'mtp.updated_at';

    /**
     * the column name for the outlets_covered field
     */
    public const COL_OUTLETS_COVERED = 'mtp.outlets_covered';

    /**
     * the column name for the month_days field
     */
    public const COL_MONTH_DAYS = 'mtp.month_days';

    /**
     * the column name for the working_days field
     */
    public const COL_WORKING_DAYS = 'mtp.working_days';

    /**
     * the column name for the agenda_days field
     */
    public const COL_AGENDA_DAYS = 'mtp.agenda_days';

    /**
     * the column name for the total_outlets field
     */
    public const COL_TOTAL_OUTLETS = 'mtp.total_outlets';

    /**
     * the column name for the total_visits field
     */
    public const COL_TOTAL_VISITS = 'mtp.total_visits';

    /**
     * the column name for the visits_fq field
     */
    public const COL_VISITS_FQ = 'mtp.visits_fq';

    /**
     * the column name for the is_processed field
     */
    public const COL_IS_PROCESSED = 'mtp.is_processed';

    /**
     * the column name for the is_mtp_generating field
     */
    public const COL_IS_MTP_GENERATING = 'mtp.is_mtp_generating';

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
        self::TYPE_PHPNAME       => ['MtpId', 'PositionId', 'CompanyId', 'Month', 'MtpStatus', 'MtpApprovedBy', 'ApprovedDate', 'CreatedAt', 'UpdatedAt', 'OutletsCovered', 'MonthDays', 'WorkingDays', 'AgendaDays', 'TotalOutlets', 'TotalVisits', 'VisitsFq', 'IsProcessed', 'IsMtpGenerating', ],
        self::TYPE_CAMELNAME     => ['mtpId', 'positionId', 'companyId', 'month', 'mtpStatus', 'mtpApprovedBy', 'approvedDate', 'createdAt', 'updatedAt', 'outletsCovered', 'monthDays', 'workingDays', 'agendaDays', 'totalOutlets', 'totalVisits', 'visitsFq', 'isProcessed', 'isMtpGenerating', ],
        self::TYPE_COLNAME       => [MtpTableMap::COL_MTP_ID, MtpTableMap::COL_POSITION_ID, MtpTableMap::COL_COMPANY_ID, MtpTableMap::COL_MONTH, MtpTableMap::COL_MTP_STATUS, MtpTableMap::COL_MTP_APPROVED_BY, MtpTableMap::COL_APPROVED_DATE, MtpTableMap::COL_CREATED_AT, MtpTableMap::COL_UPDATED_AT, MtpTableMap::COL_OUTLETS_COVERED, MtpTableMap::COL_MONTH_DAYS, MtpTableMap::COL_WORKING_DAYS, MtpTableMap::COL_AGENDA_DAYS, MtpTableMap::COL_TOTAL_OUTLETS, MtpTableMap::COL_TOTAL_VISITS, MtpTableMap::COL_VISITS_FQ, MtpTableMap::COL_IS_PROCESSED, MtpTableMap::COL_IS_MTP_GENERATING, ],
        self::TYPE_FIELDNAME     => ['mtp_id', 'position_id', 'company_id', 'month', 'mtp_status', 'mtp_approved_by', 'approved_date', 'created_at', 'updated_at', 'outlets_covered', 'month_days', 'working_days', 'agenda_days', 'total_outlets', 'total_visits', 'visits_fq', 'is_processed', 'is_mtp_generating', ],
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
        self::TYPE_PHPNAME       => ['MtpId' => 0, 'PositionId' => 1, 'CompanyId' => 2, 'Month' => 3, 'MtpStatus' => 4, 'MtpApprovedBy' => 5, 'ApprovedDate' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'OutletsCovered' => 9, 'MonthDays' => 10, 'WorkingDays' => 11, 'AgendaDays' => 12, 'TotalOutlets' => 13, 'TotalVisits' => 14, 'VisitsFq' => 15, 'IsProcessed' => 16, 'IsMtpGenerating' => 17, ],
        self::TYPE_CAMELNAME     => ['mtpId' => 0, 'positionId' => 1, 'companyId' => 2, 'month' => 3, 'mtpStatus' => 4, 'mtpApprovedBy' => 5, 'approvedDate' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'outletsCovered' => 9, 'monthDays' => 10, 'workingDays' => 11, 'agendaDays' => 12, 'totalOutlets' => 13, 'totalVisits' => 14, 'visitsFq' => 15, 'isProcessed' => 16, 'isMtpGenerating' => 17, ],
        self::TYPE_COLNAME       => [MtpTableMap::COL_MTP_ID => 0, MtpTableMap::COL_POSITION_ID => 1, MtpTableMap::COL_COMPANY_ID => 2, MtpTableMap::COL_MONTH => 3, MtpTableMap::COL_MTP_STATUS => 4, MtpTableMap::COL_MTP_APPROVED_BY => 5, MtpTableMap::COL_APPROVED_DATE => 6, MtpTableMap::COL_CREATED_AT => 7, MtpTableMap::COL_UPDATED_AT => 8, MtpTableMap::COL_OUTLETS_COVERED => 9, MtpTableMap::COL_MONTH_DAYS => 10, MtpTableMap::COL_WORKING_DAYS => 11, MtpTableMap::COL_AGENDA_DAYS => 12, MtpTableMap::COL_TOTAL_OUTLETS => 13, MtpTableMap::COL_TOTAL_VISITS => 14, MtpTableMap::COL_VISITS_FQ => 15, MtpTableMap::COL_IS_PROCESSED => 16, MtpTableMap::COL_IS_MTP_GENERATING => 17, ],
        self::TYPE_FIELDNAME     => ['mtp_id' => 0, 'position_id' => 1, 'company_id' => 2, 'month' => 3, 'mtp_status' => 4, 'mtp_approved_by' => 5, 'approved_date' => 6, 'created_at' => 7, 'updated_at' => 8, 'outlets_covered' => 9, 'month_days' => 10, 'working_days' => 11, 'agenda_days' => 12, 'total_outlets' => 13, 'total_visits' => 14, 'visits_fq' => 15, 'is_processed' => 16, 'is_mtp_generating' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MtpId' => 'MTP_ID',
        'Mtp.MtpId' => 'MTP_ID',
        'mtpId' => 'MTP_ID',
        'mtp.mtpId' => 'MTP_ID',
        'MtpTableMap::COL_MTP_ID' => 'MTP_ID',
        'COL_MTP_ID' => 'MTP_ID',
        'mtp_id' => 'MTP_ID',
        'mtp.mtp_id' => 'MTP_ID',
        'PositionId' => 'POSITION_ID',
        'Mtp.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'mtp.positionId' => 'POSITION_ID',
        'MtpTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'mtp.position_id' => 'POSITION_ID',
        'CompanyId' => 'COMPANY_ID',
        'Mtp.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mtp.companyId' => 'COMPANY_ID',
        'MtpTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'mtp.company_id' => 'COMPANY_ID',
        'Month' => 'MONTH',
        'Mtp.Month' => 'MONTH',
        'month' => 'MONTH',
        'mtp.month' => 'MONTH',
        'MtpTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'MtpStatus' => 'MTP_STATUS',
        'Mtp.MtpStatus' => 'MTP_STATUS',
        'mtpStatus' => 'MTP_STATUS',
        'mtp.mtpStatus' => 'MTP_STATUS',
        'MtpTableMap::COL_MTP_STATUS' => 'MTP_STATUS',
        'COL_MTP_STATUS' => 'MTP_STATUS',
        'mtp_status' => 'MTP_STATUS',
        'mtp.mtp_status' => 'MTP_STATUS',
        'MtpApprovedBy' => 'MTP_APPROVED_BY',
        'Mtp.MtpApprovedBy' => 'MTP_APPROVED_BY',
        'mtpApprovedBy' => 'MTP_APPROVED_BY',
        'mtp.mtpApprovedBy' => 'MTP_APPROVED_BY',
        'MtpTableMap::COL_MTP_APPROVED_BY' => 'MTP_APPROVED_BY',
        'COL_MTP_APPROVED_BY' => 'MTP_APPROVED_BY',
        'mtp_approved_by' => 'MTP_APPROVED_BY',
        'mtp.mtp_approved_by' => 'MTP_APPROVED_BY',
        'ApprovedDate' => 'APPROVED_DATE',
        'Mtp.ApprovedDate' => 'APPROVED_DATE',
        'approvedDate' => 'APPROVED_DATE',
        'mtp.approvedDate' => 'APPROVED_DATE',
        'MtpTableMap::COL_APPROVED_DATE' => 'APPROVED_DATE',
        'COL_APPROVED_DATE' => 'APPROVED_DATE',
        'approved_date' => 'APPROVED_DATE',
        'mtp.approved_date' => 'APPROVED_DATE',
        'CreatedAt' => 'CREATED_AT',
        'Mtp.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'mtp.createdAt' => 'CREATED_AT',
        'MtpTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'mtp.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Mtp.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'mtp.updatedAt' => 'UPDATED_AT',
        'MtpTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'mtp.updated_at' => 'UPDATED_AT',
        'OutletsCovered' => 'OUTLETS_COVERED',
        'Mtp.OutletsCovered' => 'OUTLETS_COVERED',
        'outletsCovered' => 'OUTLETS_COVERED',
        'mtp.outletsCovered' => 'OUTLETS_COVERED',
        'MtpTableMap::COL_OUTLETS_COVERED' => 'OUTLETS_COVERED',
        'COL_OUTLETS_COVERED' => 'OUTLETS_COVERED',
        'outlets_covered' => 'OUTLETS_COVERED',
        'mtp.outlets_covered' => 'OUTLETS_COVERED',
        'MonthDays' => 'MONTH_DAYS',
        'Mtp.MonthDays' => 'MONTH_DAYS',
        'monthDays' => 'MONTH_DAYS',
        'mtp.monthDays' => 'MONTH_DAYS',
        'MtpTableMap::COL_MONTH_DAYS' => 'MONTH_DAYS',
        'COL_MONTH_DAYS' => 'MONTH_DAYS',
        'month_days' => 'MONTH_DAYS',
        'mtp.month_days' => 'MONTH_DAYS',
        'WorkingDays' => 'WORKING_DAYS',
        'Mtp.WorkingDays' => 'WORKING_DAYS',
        'workingDays' => 'WORKING_DAYS',
        'mtp.workingDays' => 'WORKING_DAYS',
        'MtpTableMap::COL_WORKING_DAYS' => 'WORKING_DAYS',
        'COL_WORKING_DAYS' => 'WORKING_DAYS',
        'working_days' => 'WORKING_DAYS',
        'mtp.working_days' => 'WORKING_DAYS',
        'AgendaDays' => 'AGENDA_DAYS',
        'Mtp.AgendaDays' => 'AGENDA_DAYS',
        'agendaDays' => 'AGENDA_DAYS',
        'mtp.agendaDays' => 'AGENDA_DAYS',
        'MtpTableMap::COL_AGENDA_DAYS' => 'AGENDA_DAYS',
        'COL_AGENDA_DAYS' => 'AGENDA_DAYS',
        'agenda_days' => 'AGENDA_DAYS',
        'mtp.agenda_days' => 'AGENDA_DAYS',
        'TotalOutlets' => 'TOTAL_OUTLETS',
        'Mtp.TotalOutlets' => 'TOTAL_OUTLETS',
        'totalOutlets' => 'TOTAL_OUTLETS',
        'mtp.totalOutlets' => 'TOTAL_OUTLETS',
        'MtpTableMap::COL_TOTAL_OUTLETS' => 'TOTAL_OUTLETS',
        'COL_TOTAL_OUTLETS' => 'TOTAL_OUTLETS',
        'total_outlets' => 'TOTAL_OUTLETS',
        'mtp.total_outlets' => 'TOTAL_OUTLETS',
        'TotalVisits' => 'TOTAL_VISITS',
        'Mtp.TotalVisits' => 'TOTAL_VISITS',
        'totalVisits' => 'TOTAL_VISITS',
        'mtp.totalVisits' => 'TOTAL_VISITS',
        'MtpTableMap::COL_TOTAL_VISITS' => 'TOTAL_VISITS',
        'COL_TOTAL_VISITS' => 'TOTAL_VISITS',
        'total_visits' => 'TOTAL_VISITS',
        'mtp.total_visits' => 'TOTAL_VISITS',
        'VisitsFq' => 'VISITS_FQ',
        'Mtp.VisitsFq' => 'VISITS_FQ',
        'visitsFq' => 'VISITS_FQ',
        'mtp.visitsFq' => 'VISITS_FQ',
        'MtpTableMap::COL_VISITS_FQ' => 'VISITS_FQ',
        'COL_VISITS_FQ' => 'VISITS_FQ',
        'visits_fq' => 'VISITS_FQ',
        'mtp.visits_fq' => 'VISITS_FQ',
        'IsProcessed' => 'IS_PROCESSED',
        'Mtp.IsProcessed' => 'IS_PROCESSED',
        'isProcessed' => 'IS_PROCESSED',
        'mtp.isProcessed' => 'IS_PROCESSED',
        'MtpTableMap::COL_IS_PROCESSED' => 'IS_PROCESSED',
        'COL_IS_PROCESSED' => 'IS_PROCESSED',
        'is_processed' => 'IS_PROCESSED',
        'mtp.is_processed' => 'IS_PROCESSED',
        'IsMtpGenerating' => 'IS_MTP_GENERATING',
        'Mtp.IsMtpGenerating' => 'IS_MTP_GENERATING',
        'isMtpGenerating' => 'IS_MTP_GENERATING',
        'mtp.isMtpGenerating' => 'IS_MTP_GENERATING',
        'MtpTableMap::COL_IS_MTP_GENERATING' => 'IS_MTP_GENERATING',
        'COL_IS_MTP_GENERATING' => 'IS_MTP_GENERATING',
        'is_mtp_generating' => 'IS_MTP_GENERATING',
        'mtp.is_mtp_generating' => 'IS_MTP_GENERATING',
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
        $this->setName('mtp');
        $this->setPhpName('Mtp');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Mtp');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('mtp_mtp_id_seq');
        // columns
        $this->addPrimaryKey('mtp_id', 'MtpId', 'INTEGER', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, null, null);
        $this->addColumn('mtp_status', 'MtpStatus', 'VARCHAR', false, null, null);
        $this->addForeignKey('mtp_approved_by', 'MtpApprovedBy', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('approved_date', 'ApprovedDate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlets_covered', 'OutletsCovered', 'INTEGER', false, null, null);
        $this->addColumn('month_days', 'MonthDays', 'INTEGER', false, null, null);
        $this->addColumn('working_days', 'WorkingDays', 'INTEGER', false, null, null);
        $this->addColumn('agenda_days', 'AgendaDays', 'JSON', false, null, null);
        $this->addColumn('total_outlets', 'TotalOutlets', 'JSON', false, null, null);
        $this->addColumn('total_visits', 'TotalVisits', 'INTEGER', false, null, null);
        $this->addColumn('visits_fq', 'VisitsFq', 'INTEGER', false, null, null);
        $this->addColumn('is_processed', 'IsProcessed', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_mtp_generating', 'IsMtpGenerating', 'BOOLEAN', false, 1, false);
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
    0 => ':mtp_approved_by',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('MtpDay', '\\entities\\MtpDay', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
  ),
), null, null, 'MtpDays', false);
        $this->addRelation('MtpLogs', '\\entities\\MtpLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
  ),
), null, null, 'MtpLogss', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
  ),
), null, null, 'Tourplanss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MtpTableMap::CLASS_DEFAULT : MtpTableMap::OM_CLASS;
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
     * @return array (Mtp object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MtpTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MtpTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MtpTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MtpTableMap::OM_CLASS;
            /** @var Mtp $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MtpTableMap::addInstanceToPool($obj, $key);
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
            $key = MtpTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MtpTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Mtp $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MtpTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MtpTableMap::COL_MTP_ID);
            $criteria->addSelectColumn(MtpTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(MtpTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(MtpTableMap::COL_MONTH);
            $criteria->addSelectColumn(MtpTableMap::COL_MTP_STATUS);
            $criteria->addSelectColumn(MtpTableMap::COL_MTP_APPROVED_BY);
            $criteria->addSelectColumn(MtpTableMap::COL_APPROVED_DATE);
            $criteria->addSelectColumn(MtpTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MtpTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(MtpTableMap::COL_OUTLETS_COVERED);
            $criteria->addSelectColumn(MtpTableMap::COL_MONTH_DAYS);
            $criteria->addSelectColumn(MtpTableMap::COL_WORKING_DAYS);
            $criteria->addSelectColumn(MtpTableMap::COL_AGENDA_DAYS);
            $criteria->addSelectColumn(MtpTableMap::COL_TOTAL_OUTLETS);
            $criteria->addSelectColumn(MtpTableMap::COL_TOTAL_VISITS);
            $criteria->addSelectColumn(MtpTableMap::COL_VISITS_FQ);
            $criteria->addSelectColumn(MtpTableMap::COL_IS_PROCESSED);
            $criteria->addSelectColumn(MtpTableMap::COL_IS_MTP_GENERATING);
        } else {
            $criteria->addSelectColumn($alias . '.mtp_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.mtp_status');
            $criteria->addSelectColumn($alias . '.mtp_approved_by');
            $criteria->addSelectColumn($alias . '.approved_date');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.outlets_covered');
            $criteria->addSelectColumn($alias . '.month_days');
            $criteria->addSelectColumn($alias . '.working_days');
            $criteria->addSelectColumn($alias . '.agenda_days');
            $criteria->addSelectColumn($alias . '.total_outlets');
            $criteria->addSelectColumn($alias . '.total_visits');
            $criteria->addSelectColumn($alias . '.visits_fq');
            $criteria->addSelectColumn($alias . '.is_processed');
            $criteria->addSelectColumn($alias . '.is_mtp_generating');
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
            $criteria->removeSelectColumn(MtpTableMap::COL_MTP_ID);
            $criteria->removeSelectColumn(MtpTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(MtpTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(MtpTableMap::COL_MONTH);
            $criteria->removeSelectColumn(MtpTableMap::COL_MTP_STATUS);
            $criteria->removeSelectColumn(MtpTableMap::COL_MTP_APPROVED_BY);
            $criteria->removeSelectColumn(MtpTableMap::COL_APPROVED_DATE);
            $criteria->removeSelectColumn(MtpTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(MtpTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(MtpTableMap::COL_OUTLETS_COVERED);
            $criteria->removeSelectColumn(MtpTableMap::COL_MONTH_DAYS);
            $criteria->removeSelectColumn(MtpTableMap::COL_WORKING_DAYS);
            $criteria->removeSelectColumn(MtpTableMap::COL_AGENDA_DAYS);
            $criteria->removeSelectColumn(MtpTableMap::COL_TOTAL_OUTLETS);
            $criteria->removeSelectColumn(MtpTableMap::COL_TOTAL_VISITS);
            $criteria->removeSelectColumn(MtpTableMap::COL_VISITS_FQ);
            $criteria->removeSelectColumn(MtpTableMap::COL_IS_PROCESSED);
            $criteria->removeSelectColumn(MtpTableMap::COL_IS_MTP_GENERATING);
        } else {
            $criteria->removeSelectColumn($alias . '.mtp_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.mtp_status');
            $criteria->removeSelectColumn($alias . '.mtp_approved_by');
            $criteria->removeSelectColumn($alias . '.approved_date');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.outlets_covered');
            $criteria->removeSelectColumn($alias . '.month_days');
            $criteria->removeSelectColumn($alias . '.working_days');
            $criteria->removeSelectColumn($alias . '.agenda_days');
            $criteria->removeSelectColumn($alias . '.total_outlets');
            $criteria->removeSelectColumn($alias . '.total_visits');
            $criteria->removeSelectColumn($alias . '.visits_fq');
            $criteria->removeSelectColumn($alias . '.is_processed');
            $criteria->removeSelectColumn($alias . '.is_mtp_generating');
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
        return Propel::getServiceContainer()->getDatabaseMap(MtpTableMap::DATABASE_NAME)->getTable(MtpTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Mtp or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Mtp object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Mtp) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MtpTableMap::DATABASE_NAME);
            $criteria->add(MtpTableMap::COL_MTP_ID, (array) $values, Criteria::IN);
        }

        $query = MtpQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MtpTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MtpTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mtp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MtpQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Mtp or Criteria object.
     *
     * @param mixed $criteria Criteria or Mtp object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Mtp object
        }

        if ($criteria->containsKey(MtpTableMap::COL_MTP_ID) && $criteria->keyContainsValue(MtpTableMap::COL_MTP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MtpTableMap::COL_MTP_ID.')');
        }


        // Set the correct dbName
        $query = MtpQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

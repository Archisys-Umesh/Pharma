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
use entities\WfRequests;
use entities\WfRequestsQuery;


/**
 * This class defines the structure of the 'wf_requests' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WfRequestsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WfRequestsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wf_requests';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WfRequests';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WfRequests';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WfRequests';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the wf_req_id field
     */
    public const COL_WF_REQ_ID = 'wf_requests.wf_req_id';

    /**
     * the column name for the wf_company_id field
     */
    public const COL_WF_COMPANY_ID = 'wf_requests.wf_company_id';

    /**
     * the column name for the wf_id field
     */
    public const COL_WF_ID = 'wf_requests.wf_id';

    /**
     * the column name for the wf_doc_id field
     */
    public const COL_WF_DOC_ID = 'wf_requests.wf_doc_id';

    /**
     * the column name for the wf_doc_pk field
     */
    public const COL_WF_DOC_PK = 'wf_requests.wf_doc_pk';

    /**
     * the column name for the wf_doc_status field
     */
    public const COL_WF_DOC_STATUS = 'wf_requests.wf_doc_status';

    /**
     * the column name for the wf_entity_name field
     */
    public const COL_WF_ENTITY_NAME = 'wf_requests.wf_entity_name';

    /**
     * the column name for the wf_origin_employee field
     */
    public const COL_WF_ORIGIN_EMPLOYEE = 'wf_requests.wf_origin_employee';

    /**
     * the column name for the wf_step_id field
     */
    public const COL_WF_STEP_ID = 'wf_requests.wf_step_id';

    /**
     * the column name for the wf_step_level field
     */
    public const COL_WF_STEP_LEVEL = 'wf_requests.wf_step_level';

    /**
     * the column name for the wf_req_status field
     */
    public const COL_WF_REQ_STATUS = 'wf_requests.wf_req_status';

    /**
     * the column name for the wf_req_employee field
     */
    public const COL_WF_REQ_EMPLOYEE = 'wf_requests.wf_req_employee';

    /**
     * the column name for the wf_desc field
     */
    public const COL_WF_DESC = 'wf_requests.wf_desc';

    /**
     * the column name for the wf_route field
     */
    public const COL_WF_ROUTE = 'wf_requests.wf_route';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'wf_requests.created_at';

    /**
     * the column name for the wf_escalation_date field
     */
    public const COL_WF_ESCALATION_DATE = 'wf_requests.wf_escalation_date';

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
        self::TYPE_PHPNAME       => ['WfReqId', 'WfCompanyId', 'WfId', 'WfDocId', 'WfDocPk', 'WfDocStatus', 'WfEntityName', 'WfOriginEmployee', 'WfStepId', 'WfStepLevel', 'WfReqStatus', 'WfReqEmployee', 'WfDesc', 'WfRoute', 'CreatedAt', 'WfEscalationDate', ],
        self::TYPE_CAMELNAME     => ['wfReqId', 'wfCompanyId', 'wfId', 'wfDocId', 'wfDocPk', 'wfDocStatus', 'wfEntityName', 'wfOriginEmployee', 'wfStepId', 'wfStepLevel', 'wfReqStatus', 'wfReqEmployee', 'wfDesc', 'wfRoute', 'createdAt', 'wfEscalationDate', ],
        self::TYPE_COLNAME       => [WfRequestsTableMap::COL_WF_REQ_ID, WfRequestsTableMap::COL_WF_COMPANY_ID, WfRequestsTableMap::COL_WF_ID, WfRequestsTableMap::COL_WF_DOC_ID, WfRequestsTableMap::COL_WF_DOC_PK, WfRequestsTableMap::COL_WF_DOC_STATUS, WfRequestsTableMap::COL_WF_ENTITY_NAME, WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE, WfRequestsTableMap::COL_WF_STEP_ID, WfRequestsTableMap::COL_WF_STEP_LEVEL, WfRequestsTableMap::COL_WF_REQ_STATUS, WfRequestsTableMap::COL_WF_REQ_EMPLOYEE, WfRequestsTableMap::COL_WF_DESC, WfRequestsTableMap::COL_WF_ROUTE, WfRequestsTableMap::COL_CREATED_AT, WfRequestsTableMap::COL_WF_ESCALATION_DATE, ],
        self::TYPE_FIELDNAME     => ['wf_req_id', 'wf_company_id', 'wf_id', 'wf_doc_id', 'wf_doc_pk', 'wf_doc_status', 'wf_entity_name', 'wf_origin_employee', 'wf_step_id', 'wf_step_level', 'wf_req_status', 'wf_req_employee', 'wf_desc', 'wf_route', 'created_at', 'wf_escalation_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
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
        self::TYPE_PHPNAME       => ['WfReqId' => 0, 'WfCompanyId' => 1, 'WfId' => 2, 'WfDocId' => 3, 'WfDocPk' => 4, 'WfDocStatus' => 5, 'WfEntityName' => 6, 'WfOriginEmployee' => 7, 'WfStepId' => 8, 'WfStepLevel' => 9, 'WfReqStatus' => 10, 'WfReqEmployee' => 11, 'WfDesc' => 12, 'WfRoute' => 13, 'CreatedAt' => 14, 'WfEscalationDate' => 15, ],
        self::TYPE_CAMELNAME     => ['wfReqId' => 0, 'wfCompanyId' => 1, 'wfId' => 2, 'wfDocId' => 3, 'wfDocPk' => 4, 'wfDocStatus' => 5, 'wfEntityName' => 6, 'wfOriginEmployee' => 7, 'wfStepId' => 8, 'wfStepLevel' => 9, 'wfReqStatus' => 10, 'wfReqEmployee' => 11, 'wfDesc' => 12, 'wfRoute' => 13, 'createdAt' => 14, 'wfEscalationDate' => 15, ],
        self::TYPE_COLNAME       => [WfRequestsTableMap::COL_WF_REQ_ID => 0, WfRequestsTableMap::COL_WF_COMPANY_ID => 1, WfRequestsTableMap::COL_WF_ID => 2, WfRequestsTableMap::COL_WF_DOC_ID => 3, WfRequestsTableMap::COL_WF_DOC_PK => 4, WfRequestsTableMap::COL_WF_DOC_STATUS => 5, WfRequestsTableMap::COL_WF_ENTITY_NAME => 6, WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE => 7, WfRequestsTableMap::COL_WF_STEP_ID => 8, WfRequestsTableMap::COL_WF_STEP_LEVEL => 9, WfRequestsTableMap::COL_WF_REQ_STATUS => 10, WfRequestsTableMap::COL_WF_REQ_EMPLOYEE => 11, WfRequestsTableMap::COL_WF_DESC => 12, WfRequestsTableMap::COL_WF_ROUTE => 13, WfRequestsTableMap::COL_CREATED_AT => 14, WfRequestsTableMap::COL_WF_ESCALATION_DATE => 15, ],
        self::TYPE_FIELDNAME     => ['wf_req_id' => 0, 'wf_company_id' => 1, 'wf_id' => 2, 'wf_doc_id' => 3, 'wf_doc_pk' => 4, 'wf_doc_status' => 5, 'wf_entity_name' => 6, 'wf_origin_employee' => 7, 'wf_step_id' => 8, 'wf_step_level' => 9, 'wf_req_status' => 10, 'wf_req_employee' => 11, 'wf_desc' => 12, 'wf_route' => 13, 'created_at' => 14, 'wf_escalation_date' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WfReqId' => 'WF_REQ_ID',
        'WfRequests.WfReqId' => 'WF_REQ_ID',
        'wfReqId' => 'WF_REQ_ID',
        'wfRequests.wfReqId' => 'WF_REQ_ID',
        'WfRequestsTableMap::COL_WF_REQ_ID' => 'WF_REQ_ID',
        'COL_WF_REQ_ID' => 'WF_REQ_ID',
        'wf_req_id' => 'WF_REQ_ID',
        'wf_requests.wf_req_id' => 'WF_REQ_ID',
        'WfCompanyId' => 'WF_COMPANY_ID',
        'WfRequests.WfCompanyId' => 'WF_COMPANY_ID',
        'wfCompanyId' => 'WF_COMPANY_ID',
        'wfRequests.wfCompanyId' => 'WF_COMPANY_ID',
        'WfRequestsTableMap::COL_WF_COMPANY_ID' => 'WF_COMPANY_ID',
        'COL_WF_COMPANY_ID' => 'WF_COMPANY_ID',
        'wf_company_id' => 'WF_COMPANY_ID',
        'wf_requests.wf_company_id' => 'WF_COMPANY_ID',
        'WfId' => 'WF_ID',
        'WfRequests.WfId' => 'WF_ID',
        'wfId' => 'WF_ID',
        'wfRequests.wfId' => 'WF_ID',
        'WfRequestsTableMap::COL_WF_ID' => 'WF_ID',
        'COL_WF_ID' => 'WF_ID',
        'wf_id' => 'WF_ID',
        'wf_requests.wf_id' => 'WF_ID',
        'WfDocId' => 'WF_DOC_ID',
        'WfRequests.WfDocId' => 'WF_DOC_ID',
        'wfDocId' => 'WF_DOC_ID',
        'wfRequests.wfDocId' => 'WF_DOC_ID',
        'WfRequestsTableMap::COL_WF_DOC_ID' => 'WF_DOC_ID',
        'COL_WF_DOC_ID' => 'WF_DOC_ID',
        'wf_doc_id' => 'WF_DOC_ID',
        'wf_requests.wf_doc_id' => 'WF_DOC_ID',
        'WfDocPk' => 'WF_DOC_PK',
        'WfRequests.WfDocPk' => 'WF_DOC_PK',
        'wfDocPk' => 'WF_DOC_PK',
        'wfRequests.wfDocPk' => 'WF_DOC_PK',
        'WfRequestsTableMap::COL_WF_DOC_PK' => 'WF_DOC_PK',
        'COL_WF_DOC_PK' => 'WF_DOC_PK',
        'wf_doc_pk' => 'WF_DOC_PK',
        'wf_requests.wf_doc_pk' => 'WF_DOC_PK',
        'WfDocStatus' => 'WF_DOC_STATUS',
        'WfRequests.WfDocStatus' => 'WF_DOC_STATUS',
        'wfDocStatus' => 'WF_DOC_STATUS',
        'wfRequests.wfDocStatus' => 'WF_DOC_STATUS',
        'WfRequestsTableMap::COL_WF_DOC_STATUS' => 'WF_DOC_STATUS',
        'COL_WF_DOC_STATUS' => 'WF_DOC_STATUS',
        'wf_doc_status' => 'WF_DOC_STATUS',
        'wf_requests.wf_doc_status' => 'WF_DOC_STATUS',
        'WfEntityName' => 'WF_ENTITY_NAME',
        'WfRequests.WfEntityName' => 'WF_ENTITY_NAME',
        'wfEntityName' => 'WF_ENTITY_NAME',
        'wfRequests.wfEntityName' => 'WF_ENTITY_NAME',
        'WfRequestsTableMap::COL_WF_ENTITY_NAME' => 'WF_ENTITY_NAME',
        'COL_WF_ENTITY_NAME' => 'WF_ENTITY_NAME',
        'wf_entity_name' => 'WF_ENTITY_NAME',
        'wf_requests.wf_entity_name' => 'WF_ENTITY_NAME',
        'WfOriginEmployee' => 'WF_ORIGIN_EMPLOYEE',
        'WfRequests.WfOriginEmployee' => 'WF_ORIGIN_EMPLOYEE',
        'wfOriginEmployee' => 'WF_ORIGIN_EMPLOYEE',
        'wfRequests.wfOriginEmployee' => 'WF_ORIGIN_EMPLOYEE',
        'WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE' => 'WF_ORIGIN_EMPLOYEE',
        'COL_WF_ORIGIN_EMPLOYEE' => 'WF_ORIGIN_EMPLOYEE',
        'wf_origin_employee' => 'WF_ORIGIN_EMPLOYEE',
        'wf_requests.wf_origin_employee' => 'WF_ORIGIN_EMPLOYEE',
        'WfStepId' => 'WF_STEP_ID',
        'WfRequests.WfStepId' => 'WF_STEP_ID',
        'wfStepId' => 'WF_STEP_ID',
        'wfRequests.wfStepId' => 'WF_STEP_ID',
        'WfRequestsTableMap::COL_WF_STEP_ID' => 'WF_STEP_ID',
        'COL_WF_STEP_ID' => 'WF_STEP_ID',
        'wf_step_id' => 'WF_STEP_ID',
        'wf_requests.wf_step_id' => 'WF_STEP_ID',
        'WfStepLevel' => 'WF_STEP_LEVEL',
        'WfRequests.WfStepLevel' => 'WF_STEP_LEVEL',
        'wfStepLevel' => 'WF_STEP_LEVEL',
        'wfRequests.wfStepLevel' => 'WF_STEP_LEVEL',
        'WfRequestsTableMap::COL_WF_STEP_LEVEL' => 'WF_STEP_LEVEL',
        'COL_WF_STEP_LEVEL' => 'WF_STEP_LEVEL',
        'wf_step_level' => 'WF_STEP_LEVEL',
        'wf_requests.wf_step_level' => 'WF_STEP_LEVEL',
        'WfReqStatus' => 'WF_REQ_STATUS',
        'WfRequests.WfReqStatus' => 'WF_REQ_STATUS',
        'wfReqStatus' => 'WF_REQ_STATUS',
        'wfRequests.wfReqStatus' => 'WF_REQ_STATUS',
        'WfRequestsTableMap::COL_WF_REQ_STATUS' => 'WF_REQ_STATUS',
        'COL_WF_REQ_STATUS' => 'WF_REQ_STATUS',
        'wf_req_status' => 'WF_REQ_STATUS',
        'wf_requests.wf_req_status' => 'WF_REQ_STATUS',
        'WfReqEmployee' => 'WF_REQ_EMPLOYEE',
        'WfRequests.WfReqEmployee' => 'WF_REQ_EMPLOYEE',
        'wfReqEmployee' => 'WF_REQ_EMPLOYEE',
        'wfRequests.wfReqEmployee' => 'WF_REQ_EMPLOYEE',
        'WfRequestsTableMap::COL_WF_REQ_EMPLOYEE' => 'WF_REQ_EMPLOYEE',
        'COL_WF_REQ_EMPLOYEE' => 'WF_REQ_EMPLOYEE',
        'wf_req_employee' => 'WF_REQ_EMPLOYEE',
        'wf_requests.wf_req_employee' => 'WF_REQ_EMPLOYEE',
        'WfDesc' => 'WF_DESC',
        'WfRequests.WfDesc' => 'WF_DESC',
        'wfDesc' => 'WF_DESC',
        'wfRequests.wfDesc' => 'WF_DESC',
        'WfRequestsTableMap::COL_WF_DESC' => 'WF_DESC',
        'COL_WF_DESC' => 'WF_DESC',
        'wf_desc' => 'WF_DESC',
        'wf_requests.wf_desc' => 'WF_DESC',
        'WfRoute' => 'WF_ROUTE',
        'WfRequests.WfRoute' => 'WF_ROUTE',
        'wfRoute' => 'WF_ROUTE',
        'wfRequests.wfRoute' => 'WF_ROUTE',
        'WfRequestsTableMap::COL_WF_ROUTE' => 'WF_ROUTE',
        'COL_WF_ROUTE' => 'WF_ROUTE',
        'wf_route' => 'WF_ROUTE',
        'wf_requests.wf_route' => 'WF_ROUTE',
        'CreatedAt' => 'CREATED_AT',
        'WfRequests.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'wfRequests.createdAt' => 'CREATED_AT',
        'WfRequestsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'wf_requests.created_at' => 'CREATED_AT',
        'WfEscalationDate' => 'WF_ESCALATION_DATE',
        'WfRequests.WfEscalationDate' => 'WF_ESCALATION_DATE',
        'wfEscalationDate' => 'WF_ESCALATION_DATE',
        'wfRequests.wfEscalationDate' => 'WF_ESCALATION_DATE',
        'WfRequestsTableMap::COL_WF_ESCALATION_DATE' => 'WF_ESCALATION_DATE',
        'COL_WF_ESCALATION_DATE' => 'WF_ESCALATION_DATE',
        'wf_escalation_date' => 'WF_ESCALATION_DATE',
        'wf_requests.wf_escalation_date' => 'WF_ESCALATION_DATE',
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
        $this->setName('wf_requests');
        $this->setPhpName('WfRequests');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WfRequests');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wf_requests_wf_req_id_seq');
        // columns
        $this->addPrimaryKey('wf_req_id', 'WfReqId', 'INTEGER', true, null, null);
        $this->addForeignKey('wf_company_id', 'WfCompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addForeignKey('wf_id', 'WfId', 'INTEGER', 'wf_master', 'wf_id', true, null, 0);
        $this->addForeignKey('wf_doc_id', 'WfDocId', 'INTEGER', 'wf_documents', 'wf_doc_id', true, null, 0);
        $this->addColumn('wf_doc_pk', 'WfDocPk', 'INTEGER', true, null, 0);
        $this->addColumn('wf_doc_status', 'WfDocStatus', 'INTEGER', true, null, 0);
        $this->addColumn('wf_entity_name', 'WfEntityName', 'VARCHAR', true, 50, '0');
        $this->addColumn('wf_origin_employee', 'WfOriginEmployee', 'INTEGER', true, null, 0);
        $this->addForeignKey('wf_step_id', 'WfStepId', 'INTEGER', 'wf_steps', 'wf_steps_id', true, null, 0);
        $this->addColumn('wf_step_level', 'WfStepLevel', 'INTEGER', true, null, 0);
        $this->addColumn('wf_req_status', 'WfReqStatus', 'INTEGER', true, null, 0);
        $this->addForeignKey('wf_req_employee', 'WfReqEmployee', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('wf_desc', 'WfDesc', 'VARCHAR', false, 100, null);
        $this->addColumn('wf_route', 'WfRoute', 'VARCHAR', true, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('wf_escalation_date', 'WfEscalationDate', 'DATE', false, null, null);
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
    0 => ':wf_company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_req_employee',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('WfDocuments', '\\entities\\WfDocuments', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_doc_id',
    1 => ':wf_doc_id',
  ),
), null, null, null, false);
        $this->addRelation('WfMaster', '\\entities\\WfMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_id',
    1 => ':wf_id',
  ),
), null, null, null, false);
        $this->addRelation('WfSteps', '\\entities\\WfSteps', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_step_id',
    1 => ':wf_steps_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WfReqId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WfRequestsTableMap::CLASS_DEFAULT : WfRequestsTableMap::OM_CLASS;
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
     * @return array (WfRequests object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WfRequestsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WfRequestsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WfRequestsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WfRequestsTableMap::OM_CLASS;
            /** @var WfRequests $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WfRequestsTableMap::addInstanceToPool($obj, $key);
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
            $key = WfRequestsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WfRequestsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WfRequests $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WfRequestsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_REQ_ID);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_COMPANY_ID);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_ID);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_DOC_ID);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_DOC_PK);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_DOC_STATUS);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_ENTITY_NAME);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_STEP_ID);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_STEP_LEVEL);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_REQ_STATUS);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_DESC);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_ROUTE);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WfRequestsTableMap::COL_WF_ESCALATION_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.wf_req_id');
            $criteria->addSelectColumn($alias . '.wf_company_id');
            $criteria->addSelectColumn($alias . '.wf_id');
            $criteria->addSelectColumn($alias . '.wf_doc_id');
            $criteria->addSelectColumn($alias . '.wf_doc_pk');
            $criteria->addSelectColumn($alias . '.wf_doc_status');
            $criteria->addSelectColumn($alias . '.wf_entity_name');
            $criteria->addSelectColumn($alias . '.wf_origin_employee');
            $criteria->addSelectColumn($alias . '.wf_step_id');
            $criteria->addSelectColumn($alias . '.wf_step_level');
            $criteria->addSelectColumn($alias . '.wf_req_status');
            $criteria->addSelectColumn($alias . '.wf_req_employee');
            $criteria->addSelectColumn($alias . '.wf_desc');
            $criteria->addSelectColumn($alias . '.wf_route');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.wf_escalation_date');
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
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_REQ_ID);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_COMPANY_ID);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_ID);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_DOC_ID);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_DOC_PK);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_DOC_STATUS);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_ENTITY_NAME);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_ORIGIN_EMPLOYEE);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_STEP_ID);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_STEP_LEVEL);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_REQ_STATUS);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_REQ_EMPLOYEE);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_DESC);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_ROUTE);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WfRequestsTableMap::COL_WF_ESCALATION_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.wf_req_id');
            $criteria->removeSelectColumn($alias . '.wf_company_id');
            $criteria->removeSelectColumn($alias . '.wf_id');
            $criteria->removeSelectColumn($alias . '.wf_doc_id');
            $criteria->removeSelectColumn($alias . '.wf_doc_pk');
            $criteria->removeSelectColumn($alias . '.wf_doc_status');
            $criteria->removeSelectColumn($alias . '.wf_entity_name');
            $criteria->removeSelectColumn($alias . '.wf_origin_employee');
            $criteria->removeSelectColumn($alias . '.wf_step_id');
            $criteria->removeSelectColumn($alias . '.wf_step_level');
            $criteria->removeSelectColumn($alias . '.wf_req_status');
            $criteria->removeSelectColumn($alias . '.wf_req_employee');
            $criteria->removeSelectColumn($alias . '.wf_desc');
            $criteria->removeSelectColumn($alias . '.wf_route');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.wf_escalation_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(WfRequestsTableMap::DATABASE_NAME)->getTable(WfRequestsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WfRequests or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WfRequests object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WfRequests) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WfRequestsTableMap::DATABASE_NAME);
            $criteria->add(WfRequestsTableMap::COL_WF_REQ_ID, (array) $values, Criteria::IN);
        }

        $query = WfRequestsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WfRequestsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WfRequestsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wf_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WfRequestsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WfRequests or Criteria object.
     *
     * @param mixed $criteria Criteria or WfRequests object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfRequestsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WfRequests object
        }

        if ($criteria->containsKey(WfRequestsTableMap::COL_WF_REQ_ID) && $criteria->keyContainsValue(WfRequestsTableMap::COL_WF_REQ_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WfRequestsTableMap::COL_WF_REQ_ID.')');
        }


        // Set the correct dbName
        $query = WfRequestsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

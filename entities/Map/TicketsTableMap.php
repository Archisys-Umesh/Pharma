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
use entities\Tickets;
use entities\TicketsQuery;


/**
 * This class defines the structure of the 'tickets' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TicketsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TicketsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'tickets';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Tickets';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Tickets';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Tickets';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'tickets.id';

    /**
     * the column name for the ticket_type_id field
     */
    public const COL_TICKET_TYPE_ID = 'tickets.ticket_type_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'tickets.outlet_id';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'tickets.media_id';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'tickets.description';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'tickets.status';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'tickets.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'tickets.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'tickets.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'tickets.updated_at';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'tickets.integration_id';

    /**
     * the column name for the allocated_to field
     */
    public const COL_ALLOCATED_TO = 'tickets.allocated_to';

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
        self::TYPE_PHPNAME       => ['Id', 'TicketTypeId', 'OutletId', 'MediaId', 'Description', 'Status', 'EmployeeId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'IntegrationId', 'AllocatedTo', ],
        self::TYPE_CAMELNAME     => ['id', 'ticketTypeId', 'outletId', 'mediaId', 'description', 'status', 'employeeId', 'companyId', 'createdAt', 'updatedAt', 'integrationId', 'allocatedTo', ],
        self::TYPE_COLNAME       => [TicketsTableMap::COL_ID, TicketsTableMap::COL_TICKET_TYPE_ID, TicketsTableMap::COL_OUTLET_ID, TicketsTableMap::COL_MEDIA_ID, TicketsTableMap::COL_DESCRIPTION, TicketsTableMap::COL_STATUS, TicketsTableMap::COL_EMPLOYEE_ID, TicketsTableMap::COL_COMPANY_ID, TicketsTableMap::COL_CREATED_AT, TicketsTableMap::COL_UPDATED_AT, TicketsTableMap::COL_INTEGRATION_ID, TicketsTableMap::COL_ALLOCATED_TO, ],
        self::TYPE_FIELDNAME     => ['id', 'ticket_type_id', 'outlet_id', 'media_id', 'description', 'status', 'employee_id', 'company_id', 'created_at', 'updated_at', 'integration_id', 'allocated_to', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'TicketTypeId' => 1, 'OutletId' => 2, 'MediaId' => 3, 'Description' => 4, 'Status' => 5, 'EmployeeId' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'IntegrationId' => 10, 'AllocatedTo' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'ticketTypeId' => 1, 'outletId' => 2, 'mediaId' => 3, 'description' => 4, 'status' => 5, 'employeeId' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'integrationId' => 10, 'allocatedTo' => 11, ],
        self::TYPE_COLNAME       => [TicketsTableMap::COL_ID => 0, TicketsTableMap::COL_TICKET_TYPE_ID => 1, TicketsTableMap::COL_OUTLET_ID => 2, TicketsTableMap::COL_MEDIA_ID => 3, TicketsTableMap::COL_DESCRIPTION => 4, TicketsTableMap::COL_STATUS => 5, TicketsTableMap::COL_EMPLOYEE_ID => 6, TicketsTableMap::COL_COMPANY_ID => 7, TicketsTableMap::COL_CREATED_AT => 8, TicketsTableMap::COL_UPDATED_AT => 9, TicketsTableMap::COL_INTEGRATION_ID => 10, TicketsTableMap::COL_ALLOCATED_TO => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'ticket_type_id' => 1, 'outlet_id' => 2, 'media_id' => 3, 'description' => 4, 'status' => 5, 'employee_id' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'integration_id' => 10, 'allocated_to' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Tickets.Id' => 'ID',
        'id' => 'ID',
        'tickets.id' => 'ID',
        'TicketsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'TicketTypeId' => 'TICKET_TYPE_ID',
        'Tickets.TicketTypeId' => 'TICKET_TYPE_ID',
        'ticketTypeId' => 'TICKET_TYPE_ID',
        'tickets.ticketTypeId' => 'TICKET_TYPE_ID',
        'TicketsTableMap::COL_TICKET_TYPE_ID' => 'TICKET_TYPE_ID',
        'COL_TICKET_TYPE_ID' => 'TICKET_TYPE_ID',
        'ticket_type_id' => 'TICKET_TYPE_ID',
        'tickets.ticket_type_id' => 'TICKET_TYPE_ID',
        'OutletId' => 'OUTLET_ID',
        'Tickets.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'tickets.outletId' => 'OUTLET_ID',
        'TicketsTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'tickets.outlet_id' => 'OUTLET_ID',
        'MediaId' => 'MEDIA_ID',
        'Tickets.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'tickets.mediaId' => 'MEDIA_ID',
        'TicketsTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'tickets.media_id' => 'MEDIA_ID',
        'Description' => 'DESCRIPTION',
        'Tickets.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'tickets.description' => 'DESCRIPTION',
        'TicketsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Status' => 'STATUS',
        'Tickets.Status' => 'STATUS',
        'status' => 'STATUS',
        'tickets.status' => 'STATUS',
        'TicketsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Tickets.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'tickets.employeeId' => 'EMPLOYEE_ID',
        'TicketsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'tickets.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'Tickets.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'tickets.companyId' => 'COMPANY_ID',
        'TicketsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'tickets.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Tickets.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'tickets.createdAt' => 'CREATED_AT',
        'TicketsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'tickets.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Tickets.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'tickets.updatedAt' => 'UPDATED_AT',
        'TicketsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'tickets.updated_at' => 'UPDATED_AT',
        'IntegrationId' => 'INTEGRATION_ID',
        'Tickets.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'tickets.integrationId' => 'INTEGRATION_ID',
        'TicketsTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'tickets.integration_id' => 'INTEGRATION_ID',
        'AllocatedTo' => 'ALLOCATED_TO',
        'Tickets.AllocatedTo' => 'ALLOCATED_TO',
        'allocatedTo' => 'ALLOCATED_TO',
        'tickets.allocatedTo' => 'ALLOCATED_TO',
        'TicketsTableMap::COL_ALLOCATED_TO' => 'ALLOCATED_TO',
        'COL_ALLOCATED_TO' => 'ALLOCATED_TO',
        'allocated_to' => 'ALLOCATED_TO',
        'tickets.allocated_to' => 'ALLOCATED_TO',
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
        $this->setName('tickets');
        $this->setPhpName('Tickets');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Tickets');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('tickets_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ticket_type_id', 'TicketTypeId', 'INTEGER', 'ticket_type', 'id', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, 50, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 50, 'open');
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
        $this->addForeignKey('allocated_to', 'AllocatedTo', 'INTEGER', 'employee', 'employee_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('TicketType', '\\entities\\TicketType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ticket_type_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByAllocatedTo', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':allocated_to',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('TicketReplies', '\\entities\\TicketReplies', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ticket_id',
    1 => ':id',
  ),
), null, null, 'TicketRepliess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TicketsTableMap::CLASS_DEFAULT : TicketsTableMap::OM_CLASS;
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
     * @return array (Tickets object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TicketsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TicketsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TicketsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TicketsTableMap::OM_CLASS;
            /** @var Tickets $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TicketsTableMap::addInstanceToPool($obj, $key);
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
            $key = TicketsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TicketsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Tickets $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TicketsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TicketsTableMap::COL_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_TICKET_TYPE_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(TicketsTableMap::COL_STATUS);
            $criteria->addSelectColumn(TicketsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TicketsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TicketsTableMap::COL_INTEGRATION_ID);
            $criteria->addSelectColumn(TicketsTableMap::COL_ALLOCATED_TO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.ticket_type_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.integration_id');
            $criteria->addSelectColumn($alias . '.allocated_to');
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
            $criteria->removeSelectColumn(TicketsTableMap::COL_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_TICKET_TYPE_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(TicketsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(TicketsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TicketsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TicketsTableMap::COL_INTEGRATION_ID);
            $criteria->removeSelectColumn(TicketsTableMap::COL_ALLOCATED_TO);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.ticket_type_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.integration_id');
            $criteria->removeSelectColumn($alias . '.allocated_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(TicketsTableMap::DATABASE_NAME)->getTable(TicketsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Tickets or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Tickets object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TicketsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Tickets) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TicketsTableMap::DATABASE_NAME);
            $criteria->add(TicketsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TicketsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TicketsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TicketsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tickets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TicketsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Tickets or Criteria object.
     *
     * @param mixed $criteria Criteria or Tickets object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TicketsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Tickets object
        }

        if ($criteria->containsKey(TicketsTableMap::COL_ID) && $criteria->keyContainsValue(TicketsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TicketsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TicketsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

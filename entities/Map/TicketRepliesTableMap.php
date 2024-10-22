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
use entities\TicketReplies;
use entities\TicketRepliesQuery;


/**
 * This class defines the structure of the 'ticket_replies' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TicketRepliesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TicketRepliesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ticket_replies';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TicketReplies';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TicketReplies';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TicketReplies';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'ticket_replies.id';

    /**
     * the column name for the ticket_id field
     */
    public const COL_TICKET_ID = 'ticket_replies.ticket_id';

    /**
     * the column name for the ticket_replies field
     */
    public const COL_TICKET_REPLIES = 'ticket_replies.ticket_replies';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ticket_replies.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ticket_replies.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ticket_replies.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ticket_replies.updated_at';

    /**
     * the column name for the attachment_url field
     */
    public const COL_ATTACHMENT_URL = 'ticket_replies.attachment_url';

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
        self::TYPE_PHPNAME       => ['Id', 'TicketId', 'TicketReplies', 'EmployeeId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'AttachmentUrl', ],
        self::TYPE_CAMELNAME     => ['id', 'ticketId', 'ticketReplies', 'employeeId', 'companyId', 'createdAt', 'updatedAt', 'attachmentUrl', ],
        self::TYPE_COLNAME       => [TicketRepliesTableMap::COL_ID, TicketRepliesTableMap::COL_TICKET_ID, TicketRepliesTableMap::COL_TICKET_REPLIES, TicketRepliesTableMap::COL_EMPLOYEE_ID, TicketRepliesTableMap::COL_COMPANY_ID, TicketRepliesTableMap::COL_CREATED_AT, TicketRepliesTableMap::COL_UPDATED_AT, TicketRepliesTableMap::COL_ATTACHMENT_URL, ],
        self::TYPE_FIELDNAME     => ['id', 'ticket_id', 'ticket_replies', 'employee_id', 'company_id', 'created_at', 'updated_at', 'attachment_url', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'TicketId' => 1, 'TicketReplies' => 2, 'EmployeeId' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'AttachmentUrl' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'ticketId' => 1, 'ticketReplies' => 2, 'employeeId' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'attachmentUrl' => 7, ],
        self::TYPE_COLNAME       => [TicketRepliesTableMap::COL_ID => 0, TicketRepliesTableMap::COL_TICKET_ID => 1, TicketRepliesTableMap::COL_TICKET_REPLIES => 2, TicketRepliesTableMap::COL_EMPLOYEE_ID => 3, TicketRepliesTableMap::COL_COMPANY_ID => 4, TicketRepliesTableMap::COL_CREATED_AT => 5, TicketRepliesTableMap::COL_UPDATED_AT => 6, TicketRepliesTableMap::COL_ATTACHMENT_URL => 7, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'ticket_id' => 1, 'ticket_replies' => 2, 'employee_id' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'attachment_url' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'TicketReplies.Id' => 'ID',
        'id' => 'ID',
        'ticketReplies.id' => 'ID',
        'TicketRepliesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ticket_replies.id' => 'ID',
        'TicketId' => 'TICKET_ID',
        'TicketReplies.TicketId' => 'TICKET_ID',
        'ticketId' => 'TICKET_ID',
        'ticketReplies.ticketId' => 'TICKET_ID',
        'TicketRepliesTableMap::COL_TICKET_ID' => 'TICKET_ID',
        'COL_TICKET_ID' => 'TICKET_ID',
        'ticket_id' => 'TICKET_ID',
        'ticket_replies.ticket_id' => 'TICKET_ID',
        'TicketReplies' => 'TICKET_REPLIES',
        'TicketReplies.TicketReplies' => 'TICKET_REPLIES',
        'ticketReplies' => 'TICKET_REPLIES',
        'ticketReplies.ticketReplies' => 'TICKET_REPLIES',
        'TicketRepliesTableMap::COL_TICKET_REPLIES' => 'TICKET_REPLIES',
        'COL_TICKET_REPLIES' => 'TICKET_REPLIES',
        'ticket_replies' => 'TICKET_REPLIES',
        'ticket_replies.ticket_replies' => 'TICKET_REPLIES',
        'EmployeeId' => 'EMPLOYEE_ID',
        'TicketReplies.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'ticketReplies.employeeId' => 'EMPLOYEE_ID',
        'TicketRepliesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ticket_replies.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'TicketReplies.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ticketReplies.companyId' => 'COMPANY_ID',
        'TicketRepliesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ticket_replies.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'TicketReplies.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ticketReplies.createdAt' => 'CREATED_AT',
        'TicketRepliesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ticket_replies.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TicketReplies.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'ticketReplies.updatedAt' => 'UPDATED_AT',
        'TicketRepliesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ticket_replies.updated_at' => 'UPDATED_AT',
        'AttachmentUrl' => 'ATTACHMENT_URL',
        'TicketReplies.AttachmentUrl' => 'ATTACHMENT_URL',
        'attachmentUrl' => 'ATTACHMENT_URL',
        'ticketReplies.attachmentUrl' => 'ATTACHMENT_URL',
        'TicketRepliesTableMap::COL_ATTACHMENT_URL' => 'ATTACHMENT_URL',
        'COL_ATTACHMENT_URL' => 'ATTACHMENT_URL',
        'attachment_url' => 'ATTACHMENT_URL',
        'ticket_replies.attachment_url' => 'ATTACHMENT_URL',
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
        $this->setName('ticket_replies');
        $this->setPhpName('TicketReplies');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TicketReplies');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ticket_replies_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('ticket_id', 'TicketId', 'INTEGER', 'tickets', 'id', true, null, 0);
        $this->addColumn('ticket_replies', 'TicketReplies', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('attachment_url', 'AttachmentUrl', 'VARCHAR', false, null, null);
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
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Tickets', '\\entities\\Tickets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ticket_id',
    1 => ':id',
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
        return $withPrefix ? TicketRepliesTableMap::CLASS_DEFAULT : TicketRepliesTableMap::OM_CLASS;
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
     * @return array (TicketReplies object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TicketRepliesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TicketRepliesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TicketRepliesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TicketRepliesTableMap::OM_CLASS;
            /** @var TicketReplies $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TicketRepliesTableMap::addInstanceToPool($obj, $key);
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
            $key = TicketRepliesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TicketRepliesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TicketReplies $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TicketRepliesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_ID);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_TICKET_ID);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_TICKET_REPLIES);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TicketRepliesTableMap::COL_ATTACHMENT_URL);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.ticket_id');
            $criteria->addSelectColumn($alias . '.ticket_replies');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.attachment_url');
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
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_ID);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_TICKET_ID);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_TICKET_REPLIES);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TicketRepliesTableMap::COL_ATTACHMENT_URL);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.ticket_id');
            $criteria->removeSelectColumn($alias . '.ticket_replies');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.attachment_url');
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
        return Propel::getServiceContainer()->getDatabaseMap(TicketRepliesTableMap::DATABASE_NAME)->getTable(TicketRepliesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TicketReplies or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TicketReplies object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TicketRepliesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TicketReplies) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TicketRepliesTableMap::DATABASE_NAME);
            $criteria->add(TicketRepliesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TicketRepliesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TicketRepliesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TicketRepliesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ticket_replies table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TicketRepliesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TicketReplies or Criteria object.
     *
     * @param mixed $criteria Criteria or TicketReplies object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TicketRepliesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TicketReplies object
        }

        if ($criteria->containsKey(TicketRepliesTableMap::COL_ID) && $criteria->keyContainsValue(TicketRepliesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TicketRepliesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TicketRepliesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

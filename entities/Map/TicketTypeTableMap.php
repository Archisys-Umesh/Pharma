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
use entities\TicketType;
use entities\TicketTypeQuery;


/**
 * This class defines the structure of the 'ticket_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TicketTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TicketTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ticket_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TicketType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TicketType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TicketType';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'ticket_type.id';

    /**
     * the column name for the ticket_type field
     */
    public const COL_TICKET_TYPE = 'ticket_type.ticket_type';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'ticket_type.media_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ticket_type.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ticket_type.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ticket_type.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ticket_type.employee_id';

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
        self::TYPE_PHPNAME       => ['Id', 'TicketType', 'MediaId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'EmployeeId', ],
        self::TYPE_CAMELNAME     => ['id', 'ticketType', 'mediaId', 'companyId', 'createdAt', 'updatedAt', 'employeeId', ],
        self::TYPE_COLNAME       => [TicketTypeTableMap::COL_ID, TicketTypeTableMap::COL_TICKET_TYPE, TicketTypeTableMap::COL_MEDIA_ID, TicketTypeTableMap::COL_COMPANY_ID, TicketTypeTableMap::COL_CREATED_AT, TicketTypeTableMap::COL_UPDATED_AT, TicketTypeTableMap::COL_EMPLOYEE_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'ticket_type', 'media_id', 'company_id', 'created_at', 'updated_at', 'employee_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'TicketType' => 1, 'MediaId' => 2, 'CompanyId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'EmployeeId' => 6, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'ticketType' => 1, 'mediaId' => 2, 'companyId' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'employeeId' => 6, ],
        self::TYPE_COLNAME       => [TicketTypeTableMap::COL_ID => 0, TicketTypeTableMap::COL_TICKET_TYPE => 1, TicketTypeTableMap::COL_MEDIA_ID => 2, TicketTypeTableMap::COL_COMPANY_ID => 3, TicketTypeTableMap::COL_CREATED_AT => 4, TicketTypeTableMap::COL_UPDATED_AT => 5, TicketTypeTableMap::COL_EMPLOYEE_ID => 6, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'ticket_type' => 1, 'media_id' => 2, 'company_id' => 3, 'created_at' => 4, 'updated_at' => 5, 'employee_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'TicketType.Id' => 'ID',
        'id' => 'ID',
        'ticketType.id' => 'ID',
        'TicketTypeTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ticket_type.id' => 'ID',
        'TicketType' => 'TICKET_TYPE',
        'TicketType.TicketType' => 'TICKET_TYPE',
        'ticketType' => 'TICKET_TYPE',
        'ticketType.ticketType' => 'TICKET_TYPE',
        'TicketTypeTableMap::COL_TICKET_TYPE' => 'TICKET_TYPE',
        'COL_TICKET_TYPE' => 'TICKET_TYPE',
        'ticket_type' => 'TICKET_TYPE',
        'ticket_type.ticket_type' => 'TICKET_TYPE',
        'MediaId' => 'MEDIA_ID',
        'TicketType.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'ticketType.mediaId' => 'MEDIA_ID',
        'TicketTypeTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'ticket_type.media_id' => 'MEDIA_ID',
        'CompanyId' => 'COMPANY_ID',
        'TicketType.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ticketType.companyId' => 'COMPANY_ID',
        'TicketTypeTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ticket_type.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'TicketType.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ticketType.createdAt' => 'CREATED_AT',
        'TicketTypeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ticket_type.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TicketType.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'ticketType.updatedAt' => 'UPDATED_AT',
        'TicketTypeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ticket_type.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'TicketType.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'ticketType.employeeId' => 'EMPLOYEE_ID',
        'TicketTypeTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ticket_type.employee_id' => 'EMPLOYEE_ID',
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
        $this->setName('ticket_type');
        $this->setPhpName('TicketType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TicketType');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ticket_type_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ticket_type', 'TicketType', 'LONGVARCHAR', false, null, null);
        $this->addColumn('media_id', 'MediaId', 'VARCHAR', false, 50, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
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
        $this->addRelation('Tickets', '\\entities\\Tickets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':ticket_type_id',
    1 => ':id',
  ),
), null, null, 'Ticketss', false);
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
        return $withPrefix ? TicketTypeTableMap::CLASS_DEFAULT : TicketTypeTableMap::OM_CLASS;
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
     * @return array (TicketType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TicketTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TicketTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TicketTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TicketTypeTableMap::OM_CLASS;
            /** @var TicketType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TicketTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = TicketTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TicketTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TicketType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TicketTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TicketTypeTableMap::COL_ID);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_TICKET_TYPE);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TicketTypeTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.ticket_type');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.employee_id');
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
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_ID);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_TICKET_TYPE);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TicketTypeTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.ticket_type');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.employee_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(TicketTypeTableMap::DATABASE_NAME)->getTable(TicketTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TicketType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TicketType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TicketTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TicketType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TicketTypeTableMap::DATABASE_NAME);
            $criteria->add(TicketTypeTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TicketTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TicketTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TicketTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ticket_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TicketTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TicketType or Criteria object.
     *
     * @param mixed $criteria Criteria or TicketType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TicketTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TicketType object
        }

        if ($criteria->containsKey(TicketTypeTableMap::COL_ID) && $criteria->keyContainsValue(TicketTypeTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TicketTypeTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TicketTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

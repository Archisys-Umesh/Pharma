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
use entities\OrderLog;
use entities\OrderLogQuery;


/**
 * This class defines the structure of the 'order_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OrderLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'order_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OrderLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OrderLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OrderLog';

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
     * the column name for the order_log_id field
     */
    public const COL_ORDER_LOG_ID = 'order_log.order_log_id';

    /**
     * the column name for the order_id field
     */
    public const COL_ORDER_ID = 'order_log.order_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'order_log.company_id';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'order_log.title';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'order_log.description';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'order_log.user_id';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'order_log.data';

    /**
     * the column name for the log_date field
     */
    public const COL_LOG_DATE = 'order_log.log_date';

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
        self::TYPE_PHPNAME       => ['OrderLogId', 'OrderId', 'CompanyId', 'Title', 'Description', 'UserId', 'Data', 'LogDate', ],
        self::TYPE_CAMELNAME     => ['orderLogId', 'orderId', 'companyId', 'title', 'description', 'userId', 'data', 'logDate', ],
        self::TYPE_COLNAME       => [OrderLogTableMap::COL_ORDER_LOG_ID, OrderLogTableMap::COL_ORDER_ID, OrderLogTableMap::COL_COMPANY_ID, OrderLogTableMap::COL_TITLE, OrderLogTableMap::COL_DESCRIPTION, OrderLogTableMap::COL_USER_ID, OrderLogTableMap::COL_DATA, OrderLogTableMap::COL_LOG_DATE, ],
        self::TYPE_FIELDNAME     => ['order_log_id', 'order_id', 'company_id', 'title', 'description', 'user_id', 'data', 'log_date', ],
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
        self::TYPE_PHPNAME       => ['OrderLogId' => 0, 'OrderId' => 1, 'CompanyId' => 2, 'Title' => 3, 'Description' => 4, 'UserId' => 5, 'Data' => 6, 'LogDate' => 7, ],
        self::TYPE_CAMELNAME     => ['orderLogId' => 0, 'orderId' => 1, 'companyId' => 2, 'title' => 3, 'description' => 4, 'userId' => 5, 'data' => 6, 'logDate' => 7, ],
        self::TYPE_COLNAME       => [OrderLogTableMap::COL_ORDER_LOG_ID => 0, OrderLogTableMap::COL_ORDER_ID => 1, OrderLogTableMap::COL_COMPANY_ID => 2, OrderLogTableMap::COL_TITLE => 3, OrderLogTableMap::COL_DESCRIPTION => 4, OrderLogTableMap::COL_USER_ID => 5, OrderLogTableMap::COL_DATA => 6, OrderLogTableMap::COL_LOG_DATE => 7, ],
        self::TYPE_FIELDNAME     => ['order_log_id' => 0, 'order_id' => 1, 'company_id' => 2, 'title' => 3, 'description' => 4, 'user_id' => 5, 'data' => 6, 'log_date' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrderLogId' => 'ORDER_LOG_ID',
        'OrderLog.OrderLogId' => 'ORDER_LOG_ID',
        'orderLogId' => 'ORDER_LOG_ID',
        'orderLog.orderLogId' => 'ORDER_LOG_ID',
        'OrderLogTableMap::COL_ORDER_LOG_ID' => 'ORDER_LOG_ID',
        'COL_ORDER_LOG_ID' => 'ORDER_LOG_ID',
        'order_log_id' => 'ORDER_LOG_ID',
        'order_log.order_log_id' => 'ORDER_LOG_ID',
        'OrderId' => 'ORDER_ID',
        'OrderLog.OrderId' => 'ORDER_ID',
        'orderId' => 'ORDER_ID',
        'orderLog.orderId' => 'ORDER_ID',
        'OrderLogTableMap::COL_ORDER_ID' => 'ORDER_ID',
        'COL_ORDER_ID' => 'ORDER_ID',
        'order_id' => 'ORDER_ID',
        'order_log.order_id' => 'ORDER_ID',
        'CompanyId' => 'COMPANY_ID',
        'OrderLog.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'orderLog.companyId' => 'COMPANY_ID',
        'OrderLogTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'order_log.company_id' => 'COMPANY_ID',
        'Title' => 'TITLE',
        'OrderLog.Title' => 'TITLE',
        'title' => 'TITLE',
        'orderLog.title' => 'TITLE',
        'OrderLogTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'order_log.title' => 'TITLE',
        'Description' => 'DESCRIPTION',
        'OrderLog.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'orderLog.description' => 'DESCRIPTION',
        'OrderLogTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'order_log.description' => 'DESCRIPTION',
        'UserId' => 'USER_ID',
        'OrderLog.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'orderLog.userId' => 'USER_ID',
        'OrderLogTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'order_log.user_id' => 'USER_ID',
        'Data' => 'DATA',
        'OrderLog.Data' => 'DATA',
        'data' => 'DATA',
        'orderLog.data' => 'DATA',
        'OrderLogTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'order_log.data' => 'DATA',
        'LogDate' => 'LOG_DATE',
        'OrderLog.LogDate' => 'LOG_DATE',
        'logDate' => 'LOG_DATE',
        'orderLog.logDate' => 'LOG_DATE',
        'OrderLogTableMap::COL_LOG_DATE' => 'LOG_DATE',
        'COL_LOG_DATE' => 'LOG_DATE',
        'log_date' => 'LOG_DATE',
        'order_log.log_date' => 'LOG_DATE',
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
        $this->setName('order_log');
        $this->setPhpName('OrderLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OrderLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('order_log_order_log_id_seq');
        // columns
        $this->addPrimaryKey('order_log_id', 'OrderLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('order_id', 'OrderId', 'BIGINT', 'orders', 'order_id', true, null, 0);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 250, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 250, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', false, null, null);
        $this->addColumn('data', 'Data', 'VARCHAR', false, 500, null);
        $this->addColumn('log_date', 'LogDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, null, false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OrderLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OrderLogTableMap::CLASS_DEFAULT : OrderLogTableMap::OM_CLASS;
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
     * @return array (OrderLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OrderLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderLogTableMap::OM_CLASS;
            /** @var OrderLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderLogTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrderLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderLogTableMap::COL_ORDER_LOG_ID);
            $criteria->addSelectColumn(OrderLogTableMap::COL_ORDER_ID);
            $criteria->addSelectColumn(OrderLogTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OrderLogTableMap::COL_TITLE);
            $criteria->addSelectColumn(OrderLogTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OrderLogTableMap::COL_USER_ID);
            $criteria->addSelectColumn(OrderLogTableMap::COL_DATA);
            $criteria->addSelectColumn(OrderLogTableMap::COL_LOG_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.order_log_id');
            $criteria->addSelectColumn($alias . '.order_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.log_date');
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
            $criteria->removeSelectColumn(OrderLogTableMap::COL_ORDER_LOG_ID);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_ORDER_ID);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_TITLE);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_DATA);
            $criteria->removeSelectColumn(OrderLogTableMap::COL_LOG_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.order_log_id');
            $criteria->removeSelectColumn($alias . '.order_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.log_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderLogTableMap::DATABASE_NAME)->getTable(OrderLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrderLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OrderLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OrderLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderLogTableMap::DATABASE_NAME);
            $criteria->add(OrderLogTableMap::COL_ORDER_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = OrderLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OrderLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrderLog or Criteria object.
     *
     * @param mixed $criteria Criteria or OrderLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrderLog object
        }

        if ($criteria->containsKey(OrderLogTableMap::COL_ORDER_LOG_ID) && $criteria->keyContainsValue(OrderLogTableMap::COL_ORDER_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderLogTableMap::COL_ORDER_LOG_ID.')');
        }


        // Set the correct dbName
        $query = OrderLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\IntegrationApiLogs;
use entities\IntegrationApiLogsQuery;


/**
 * This class defines the structure of the 'integration_api_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class IntegrationApiLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.IntegrationApiLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'integration_api_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'IntegrationApiLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\IntegrationApiLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.IntegrationApiLogs';

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
    public const COL_ID = 'integration_api_logs.id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'integration_api_logs.company_id';

    /**
     * the column name for the requested_params field
     */
    public const COL_REQUESTED_PARAMS = 'integration_api_logs.requested_params';

    /**
     * the column name for the response field
     */
    public const COL_RESPONSE = 'integration_api_logs.response';

    /**
     * the column name for the response_status field
     */
    public const COL_RESPONSE_STATUS = 'integration_api_logs.response_status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'integration_api_logs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'integration_api_logs.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'CompanyId', 'RequestedParams', 'Response', 'ResponseStatus', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'companyId', 'requestedParams', 'response', 'responseStatus', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [IntegrationApiLogsTableMap::COL_ID, IntegrationApiLogsTableMap::COL_COMPANY_ID, IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS, IntegrationApiLogsTableMap::COL_RESPONSE, IntegrationApiLogsTableMap::COL_RESPONSE_STATUS, IntegrationApiLogsTableMap::COL_CREATED_AT, IntegrationApiLogsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'company_id', 'requested_params', 'response', 'response_status', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'CompanyId' => 1, 'RequestedParams' => 2, 'Response' => 3, 'ResponseStatus' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'companyId' => 1, 'requestedParams' => 2, 'response' => 3, 'responseStatus' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [IntegrationApiLogsTableMap::COL_ID => 0, IntegrationApiLogsTableMap::COL_COMPANY_ID => 1, IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS => 2, IntegrationApiLogsTableMap::COL_RESPONSE => 3, IntegrationApiLogsTableMap::COL_RESPONSE_STATUS => 4, IntegrationApiLogsTableMap::COL_CREATED_AT => 5, IntegrationApiLogsTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'company_id' => 1, 'requested_params' => 2, 'response' => 3, 'response_status' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'IntegrationApiLogs.Id' => 'ID',
        'id' => 'ID',
        'integrationApiLogs.id' => 'ID',
        'IntegrationApiLogsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'integration_api_logs.id' => 'ID',
        'CompanyId' => 'COMPANY_ID',
        'IntegrationApiLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'integrationApiLogs.companyId' => 'COMPANY_ID',
        'IntegrationApiLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'integration_api_logs.company_id' => 'COMPANY_ID',
        'RequestedParams' => 'REQUESTED_PARAMS',
        'IntegrationApiLogs.RequestedParams' => 'REQUESTED_PARAMS',
        'requestedParams' => 'REQUESTED_PARAMS',
        'integrationApiLogs.requestedParams' => 'REQUESTED_PARAMS',
        'IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS' => 'REQUESTED_PARAMS',
        'COL_REQUESTED_PARAMS' => 'REQUESTED_PARAMS',
        'requested_params' => 'REQUESTED_PARAMS',
        'integration_api_logs.requested_params' => 'REQUESTED_PARAMS',
        'Response' => 'RESPONSE',
        'IntegrationApiLogs.Response' => 'RESPONSE',
        'response' => 'RESPONSE',
        'integrationApiLogs.response' => 'RESPONSE',
        'IntegrationApiLogsTableMap::COL_RESPONSE' => 'RESPONSE',
        'COL_RESPONSE' => 'RESPONSE',
        'integration_api_logs.response' => 'RESPONSE',
        'ResponseStatus' => 'RESPONSE_STATUS',
        'IntegrationApiLogs.ResponseStatus' => 'RESPONSE_STATUS',
        'responseStatus' => 'RESPONSE_STATUS',
        'integrationApiLogs.responseStatus' => 'RESPONSE_STATUS',
        'IntegrationApiLogsTableMap::COL_RESPONSE_STATUS' => 'RESPONSE_STATUS',
        'COL_RESPONSE_STATUS' => 'RESPONSE_STATUS',
        'response_status' => 'RESPONSE_STATUS',
        'integration_api_logs.response_status' => 'RESPONSE_STATUS',
        'CreatedAt' => 'CREATED_AT',
        'IntegrationApiLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'integrationApiLogs.createdAt' => 'CREATED_AT',
        'IntegrationApiLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'integration_api_logs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'IntegrationApiLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'integrationApiLogs.updatedAt' => 'UPDATED_AT',
        'IntegrationApiLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'integration_api_logs.updated_at' => 'UPDATED_AT',
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
        $this->setName('integration_api_logs');
        $this->setPhpName('IntegrationApiLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\IntegrationApiLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('integration_api_logs_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('requested_params', 'RequestedParams', 'LONGVARCHAR', false, null, null);
        $this->addColumn('response', 'Response', 'LONGVARCHAR', false, null, null);
        $this->addColumn('response_status', 'ResponseStatus', 'INTEGER', false, null, null);
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
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
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
        return $withPrefix ? IntegrationApiLogsTableMap::CLASS_DEFAULT : IntegrationApiLogsTableMap::OM_CLASS;
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
     * @return array (IntegrationApiLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = IntegrationApiLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = IntegrationApiLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + IntegrationApiLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = IntegrationApiLogsTableMap::OM_CLASS;
            /** @var IntegrationApiLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            IntegrationApiLogsTableMap::addInstanceToPool($obj, $key);
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
            $key = IntegrationApiLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = IntegrationApiLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var IntegrationApiLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                IntegrationApiLogsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_ID);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_RESPONSE);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_RESPONSE_STATUS);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(IntegrationApiLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.requested_params');
            $criteria->addSelectColumn($alias . '.response');
            $criteria->addSelectColumn($alias . '.response_status');
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
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_ID);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_REQUESTED_PARAMS);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_RESPONSE);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_RESPONSE_STATUS);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(IntegrationApiLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.requested_params');
            $criteria->removeSelectColumn($alias . '.response');
            $criteria->removeSelectColumn($alias . '.response_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(IntegrationApiLogsTableMap::DATABASE_NAME)->getTable(IntegrationApiLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a IntegrationApiLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or IntegrationApiLogs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(IntegrationApiLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\IntegrationApiLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(IntegrationApiLogsTableMap::DATABASE_NAME);
            $criteria->add(IntegrationApiLogsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = IntegrationApiLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            IntegrationApiLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                IntegrationApiLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the integration_api_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return IntegrationApiLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a IntegrationApiLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or IntegrationApiLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(IntegrationApiLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from IntegrationApiLogs object
        }

        if ($criteria->containsKey(IntegrationApiLogsTableMap::COL_ID) && $criteria->keyContainsValue(IntegrationApiLogsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.IntegrationApiLogsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = IntegrationApiLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

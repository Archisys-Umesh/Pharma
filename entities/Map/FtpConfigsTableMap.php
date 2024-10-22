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
use entities\FtpConfigs;
use entities\FtpConfigsQuery;


/**
 * This class defines the structure of the 'ftp_configs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class FtpConfigsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.FtpConfigsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ftp_configs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'FtpConfigs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\FtpConfigs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.FtpConfigs';

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
     * the column name for the ftp_config_id field
     */
    public const COL_FTP_CONFIG_ID = 'ftp_configs.ftp_config_id';

    /**
     * the column name for the host field
     */
    public const COL_HOST = 'ftp_configs.host';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'ftp_configs.username';

    /**
     * the column name for the password field
     */
    public const COL_PASSWORD = 'ftp_configs.password';

    /**
     * the column name for the port field
     */
    public const COL_PORT = 'ftp_configs.port';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ftp_configs.created_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ftp_configs.company_id';

    /**
     * the column name for the isenabled field
     */
    public const COL_ISENABLED = 'ftp_configs.isenabled';

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
        self::TYPE_PHPNAME       => ['FtpConfigId', 'Host', 'Username', 'Password', 'Port', 'CreatedAt', 'CompanyId', 'Isenabled', ],
        self::TYPE_CAMELNAME     => ['ftpConfigId', 'host', 'username', 'password', 'port', 'createdAt', 'companyId', 'isenabled', ],
        self::TYPE_COLNAME       => [FtpConfigsTableMap::COL_FTP_CONFIG_ID, FtpConfigsTableMap::COL_HOST, FtpConfigsTableMap::COL_USERNAME, FtpConfigsTableMap::COL_PASSWORD, FtpConfigsTableMap::COL_PORT, FtpConfigsTableMap::COL_CREATED_AT, FtpConfigsTableMap::COL_COMPANY_ID, FtpConfigsTableMap::COL_ISENABLED, ],
        self::TYPE_FIELDNAME     => ['ftp_config_id', 'host', 'username', 'password', 'port', 'created_at', 'company_id', 'isenabled', ],
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
        self::TYPE_PHPNAME       => ['FtpConfigId' => 0, 'Host' => 1, 'Username' => 2, 'Password' => 3, 'Port' => 4, 'CreatedAt' => 5, 'CompanyId' => 6, 'Isenabled' => 7, ],
        self::TYPE_CAMELNAME     => ['ftpConfigId' => 0, 'host' => 1, 'username' => 2, 'password' => 3, 'port' => 4, 'createdAt' => 5, 'companyId' => 6, 'isenabled' => 7, ],
        self::TYPE_COLNAME       => [FtpConfigsTableMap::COL_FTP_CONFIG_ID => 0, FtpConfigsTableMap::COL_HOST => 1, FtpConfigsTableMap::COL_USERNAME => 2, FtpConfigsTableMap::COL_PASSWORD => 3, FtpConfigsTableMap::COL_PORT => 4, FtpConfigsTableMap::COL_CREATED_AT => 5, FtpConfigsTableMap::COL_COMPANY_ID => 6, FtpConfigsTableMap::COL_ISENABLED => 7, ],
        self::TYPE_FIELDNAME     => ['ftp_config_id' => 0, 'host' => 1, 'username' => 2, 'password' => 3, 'port' => 4, 'created_at' => 5, 'company_id' => 6, 'isenabled' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FtpConfigId' => 'FTP_CONFIG_ID',
        'FtpConfigs.FtpConfigId' => 'FTP_CONFIG_ID',
        'ftpConfigId' => 'FTP_CONFIG_ID',
        'ftpConfigs.ftpConfigId' => 'FTP_CONFIG_ID',
        'FtpConfigsTableMap::COL_FTP_CONFIG_ID' => 'FTP_CONFIG_ID',
        'COL_FTP_CONFIG_ID' => 'FTP_CONFIG_ID',
        'ftp_config_id' => 'FTP_CONFIG_ID',
        'ftp_configs.ftp_config_id' => 'FTP_CONFIG_ID',
        'Host' => 'HOST',
        'FtpConfigs.Host' => 'HOST',
        'host' => 'HOST',
        'ftpConfigs.host' => 'HOST',
        'FtpConfigsTableMap::COL_HOST' => 'HOST',
        'COL_HOST' => 'HOST',
        'ftp_configs.host' => 'HOST',
        'Username' => 'USERNAME',
        'FtpConfigs.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'ftpConfigs.username' => 'USERNAME',
        'FtpConfigsTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'ftp_configs.username' => 'USERNAME',
        'Password' => 'PASSWORD',
        'FtpConfigs.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'ftpConfigs.password' => 'PASSWORD',
        'FtpConfigsTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'ftp_configs.password' => 'PASSWORD',
        'Port' => 'PORT',
        'FtpConfigs.Port' => 'PORT',
        'port' => 'PORT',
        'ftpConfigs.port' => 'PORT',
        'FtpConfigsTableMap::COL_PORT' => 'PORT',
        'COL_PORT' => 'PORT',
        'ftp_configs.port' => 'PORT',
        'CreatedAt' => 'CREATED_AT',
        'FtpConfigs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'ftpConfigs.createdAt' => 'CREATED_AT',
        'FtpConfigsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ftp_configs.created_at' => 'CREATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'FtpConfigs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'ftpConfigs.companyId' => 'COMPANY_ID',
        'FtpConfigsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ftp_configs.company_id' => 'COMPANY_ID',
        'Isenabled' => 'ISENABLED',
        'FtpConfigs.Isenabled' => 'ISENABLED',
        'isenabled' => 'ISENABLED',
        'ftpConfigs.isenabled' => 'ISENABLED',
        'FtpConfigsTableMap::COL_ISENABLED' => 'ISENABLED',
        'COL_ISENABLED' => 'ISENABLED',
        'ftp_configs.isenabled' => 'ISENABLED',
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
        $this->setName('ftp_configs');
        $this->setPhpName('FtpConfigs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\FtpConfigs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ftp_configs_ftp_config_id_seq');
        // columns
        $this->addPrimaryKey('ftp_config_id', 'FtpConfigId', 'INTEGER', true, null, null);
        $this->addColumn('host', 'Host', 'VARCHAR', false, 200, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 200, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 200, null);
        $this->addColumn('port', 'Port', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('isenabled', 'Isenabled', 'SMALLINT', false, null, 1);
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
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FtpConfigId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FtpConfigsTableMap::CLASS_DEFAULT : FtpConfigsTableMap::OM_CLASS;
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
     * @return array (FtpConfigs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = FtpConfigsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FtpConfigsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FtpConfigsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FtpConfigsTableMap::OM_CLASS;
            /** @var FtpConfigs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FtpConfigsTableMap::addInstanceToPool($obj, $key);
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
            $key = FtpConfigsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FtpConfigsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FtpConfigs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FtpConfigsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_FTP_CONFIG_ID);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_HOST);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_USERNAME);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_PORT);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(FtpConfigsTableMap::COL_ISENABLED);
        } else {
            $criteria->addSelectColumn($alias . '.ftp_config_id');
            $criteria->addSelectColumn($alias . '.host');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.port');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.isenabled');
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
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_FTP_CONFIG_ID);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_HOST);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_PORT);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(FtpConfigsTableMap::COL_ISENABLED);
        } else {
            $criteria->removeSelectColumn($alias . '.ftp_config_id');
            $criteria->removeSelectColumn($alias . '.host');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.port');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.isenabled');
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
        return Propel::getServiceContainer()->getDatabaseMap(FtpConfigsTableMap::DATABASE_NAME)->getTable(FtpConfigsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a FtpConfigs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or FtpConfigs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpConfigsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\FtpConfigs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FtpConfigsTableMap::DATABASE_NAME);
            $criteria->add(FtpConfigsTableMap::COL_FTP_CONFIG_ID, (array) $values, Criteria::IN);
        }

        $query = FtpConfigsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FtpConfigsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FtpConfigsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ftp_configs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return FtpConfigsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FtpConfigs or Criteria object.
     *
     * @param mixed $criteria Criteria or FtpConfigs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpConfigsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FtpConfigs object
        }

        if ($criteria->containsKey(FtpConfigsTableMap::COL_FTP_CONFIG_ID) && $criteria->keyContainsValue(FtpConfigsTableMap::COL_FTP_CONFIG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FtpConfigsTableMap::COL_FTP_CONFIG_ID.')');
        }


        // Set the correct dbName
        $query = FtpConfigsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\Configuration;
use entities\ConfigurationQuery;


/**
 * This class defines the structure of the 'configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Configuration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Configuration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Configuration';

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
     * the column name for the ec_id field
     */
    public const COL_EC_ID = 'configuration.ec_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'configuration.company_id';

    /**
     * the column name for the mail_from field
     */
    public const COL_MAIL_FROM = 'configuration.mail_from';

    /**
     * the column name for the from_name field
     */
    public const COL_FROM_NAME = 'configuration.from_name';

    /**
     * the column name for the admin_email field
     */
    public const COL_ADMIN_EMAIL = 'configuration.admin_email';

    /**
     * the column name for the admin_cc field
     */
    public const COL_ADMIN_CC = 'configuration.admin_cc';

    /**
     * the column name for the daily_report_emails field
     */
    public const COL_DAILY_REPORT_EMAILS = 'configuration.daily_report_emails';

    /**
     * the column name for the team_emails field
     */
    public const COL_TEAM_EMAILS = 'configuration.team_emails';

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
        self::TYPE_PHPNAME       => ['EcId', 'CompanyId', 'MailFrom', 'FromName', 'AdminEmail', 'AdminCc', 'DailyReportEmails', 'TeamEmails', ],
        self::TYPE_CAMELNAME     => ['ecId', 'companyId', 'mailFrom', 'fromName', 'adminEmail', 'adminCc', 'dailyReportEmails', 'teamEmails', ],
        self::TYPE_COLNAME       => [ConfigurationTableMap::COL_EC_ID, ConfigurationTableMap::COL_COMPANY_ID, ConfigurationTableMap::COL_MAIL_FROM, ConfigurationTableMap::COL_FROM_NAME, ConfigurationTableMap::COL_ADMIN_EMAIL, ConfigurationTableMap::COL_ADMIN_CC, ConfigurationTableMap::COL_DAILY_REPORT_EMAILS, ConfigurationTableMap::COL_TEAM_EMAILS, ],
        self::TYPE_FIELDNAME     => ['ec_id', 'company_id', 'mail_from', 'from_name', 'admin_email', 'admin_cc', 'daily_report_emails', 'team_emails', ],
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
        self::TYPE_PHPNAME       => ['EcId' => 0, 'CompanyId' => 1, 'MailFrom' => 2, 'FromName' => 3, 'AdminEmail' => 4, 'AdminCc' => 5, 'DailyReportEmails' => 6, 'TeamEmails' => 7, ],
        self::TYPE_CAMELNAME     => ['ecId' => 0, 'companyId' => 1, 'mailFrom' => 2, 'fromName' => 3, 'adminEmail' => 4, 'adminCc' => 5, 'dailyReportEmails' => 6, 'teamEmails' => 7, ],
        self::TYPE_COLNAME       => [ConfigurationTableMap::COL_EC_ID => 0, ConfigurationTableMap::COL_COMPANY_ID => 1, ConfigurationTableMap::COL_MAIL_FROM => 2, ConfigurationTableMap::COL_FROM_NAME => 3, ConfigurationTableMap::COL_ADMIN_EMAIL => 4, ConfigurationTableMap::COL_ADMIN_CC => 5, ConfigurationTableMap::COL_DAILY_REPORT_EMAILS => 6, ConfigurationTableMap::COL_TEAM_EMAILS => 7, ],
        self::TYPE_FIELDNAME     => ['ec_id' => 0, 'company_id' => 1, 'mail_from' => 2, 'from_name' => 3, 'admin_email' => 4, 'admin_cc' => 5, 'daily_report_emails' => 6, 'team_emails' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EcId' => 'EC_ID',
        'Configuration.EcId' => 'EC_ID',
        'ecId' => 'EC_ID',
        'configuration.ecId' => 'EC_ID',
        'ConfigurationTableMap::COL_EC_ID' => 'EC_ID',
        'COL_EC_ID' => 'EC_ID',
        'ec_id' => 'EC_ID',
        'configuration.ec_id' => 'EC_ID',
        'CompanyId' => 'COMPANY_ID',
        'Configuration.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'configuration.companyId' => 'COMPANY_ID',
        'ConfigurationTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'configuration.company_id' => 'COMPANY_ID',
        'MailFrom' => 'MAIL_FROM',
        'Configuration.MailFrom' => 'MAIL_FROM',
        'mailFrom' => 'MAIL_FROM',
        'configuration.mailFrom' => 'MAIL_FROM',
        'ConfigurationTableMap::COL_MAIL_FROM' => 'MAIL_FROM',
        'COL_MAIL_FROM' => 'MAIL_FROM',
        'mail_from' => 'MAIL_FROM',
        'configuration.mail_from' => 'MAIL_FROM',
        'FromName' => 'FROM_NAME',
        'Configuration.FromName' => 'FROM_NAME',
        'fromName' => 'FROM_NAME',
        'configuration.fromName' => 'FROM_NAME',
        'ConfigurationTableMap::COL_FROM_NAME' => 'FROM_NAME',
        'COL_FROM_NAME' => 'FROM_NAME',
        'from_name' => 'FROM_NAME',
        'configuration.from_name' => 'FROM_NAME',
        'AdminEmail' => 'ADMIN_EMAIL',
        'Configuration.AdminEmail' => 'ADMIN_EMAIL',
        'adminEmail' => 'ADMIN_EMAIL',
        'configuration.adminEmail' => 'ADMIN_EMAIL',
        'ConfigurationTableMap::COL_ADMIN_EMAIL' => 'ADMIN_EMAIL',
        'COL_ADMIN_EMAIL' => 'ADMIN_EMAIL',
        'admin_email' => 'ADMIN_EMAIL',
        'configuration.admin_email' => 'ADMIN_EMAIL',
        'AdminCc' => 'ADMIN_CC',
        'Configuration.AdminCc' => 'ADMIN_CC',
        'adminCc' => 'ADMIN_CC',
        'configuration.adminCc' => 'ADMIN_CC',
        'ConfigurationTableMap::COL_ADMIN_CC' => 'ADMIN_CC',
        'COL_ADMIN_CC' => 'ADMIN_CC',
        'admin_cc' => 'ADMIN_CC',
        'configuration.admin_cc' => 'ADMIN_CC',
        'DailyReportEmails' => 'DAILY_REPORT_EMAILS',
        'Configuration.DailyReportEmails' => 'DAILY_REPORT_EMAILS',
        'dailyReportEmails' => 'DAILY_REPORT_EMAILS',
        'configuration.dailyReportEmails' => 'DAILY_REPORT_EMAILS',
        'ConfigurationTableMap::COL_DAILY_REPORT_EMAILS' => 'DAILY_REPORT_EMAILS',
        'COL_DAILY_REPORT_EMAILS' => 'DAILY_REPORT_EMAILS',
        'daily_report_emails' => 'DAILY_REPORT_EMAILS',
        'configuration.daily_report_emails' => 'DAILY_REPORT_EMAILS',
        'TeamEmails' => 'TEAM_EMAILS',
        'Configuration.TeamEmails' => 'TEAM_EMAILS',
        'teamEmails' => 'TEAM_EMAILS',
        'configuration.teamEmails' => 'TEAM_EMAILS',
        'ConfigurationTableMap::COL_TEAM_EMAILS' => 'TEAM_EMAILS',
        'COL_TEAM_EMAILS' => 'TEAM_EMAILS',
        'team_emails' => 'TEAM_EMAILS',
        'configuration.team_emails' => 'TEAM_EMAILS',
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
        $this->setName('configuration');
        $this->setPhpName('Configuration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Configuration');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('configuration_ec_id_seq');
        // columns
        $this->addPrimaryKey('ec_id', 'EcId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('mail_from', 'MailFrom', 'VARCHAR', true, 255, null);
        $this->addColumn('from_name', 'FromName', 'VARCHAR', true, 255, null);
        $this->addColumn('admin_email', 'AdminEmail', 'VARCHAR', true, 255, null);
        $this->addColumn('admin_cc', 'AdminCc', 'LONGVARCHAR', true, null, null);
        $this->addColumn('daily_report_emails', 'DailyReportEmails', 'LONGVARCHAR', true, null, null);
        $this->addColumn('team_emails', 'TeamEmails', 'LONGVARCHAR', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EcId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ConfigurationTableMap::CLASS_DEFAULT : ConfigurationTableMap::OM_CLASS;
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
     * @return array (Configuration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ConfigurationTableMap::OM_CLASS;
            /** @var Configuration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = ConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Configuration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ConfigurationTableMap::COL_EC_ID);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_MAIL_FROM);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_FROM_NAME);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_ADMIN_EMAIL);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_ADMIN_CC);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_DAILY_REPORT_EMAILS);
            $criteria->addSelectColumn(ConfigurationTableMap::COL_TEAM_EMAILS);
        } else {
            $criteria->addSelectColumn($alias . '.ec_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.mail_from');
            $criteria->addSelectColumn($alias . '.from_name');
            $criteria->addSelectColumn($alias . '.admin_email');
            $criteria->addSelectColumn($alias . '.admin_cc');
            $criteria->addSelectColumn($alias . '.daily_report_emails');
            $criteria->addSelectColumn($alias . '.team_emails');
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
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_EC_ID);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_MAIL_FROM);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_FROM_NAME);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_ADMIN_EMAIL);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_ADMIN_CC);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_DAILY_REPORT_EMAILS);
            $criteria->removeSelectColumn(ConfigurationTableMap::COL_TEAM_EMAILS);
        } else {
            $criteria->removeSelectColumn($alias . '.ec_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.mail_from');
            $criteria->removeSelectColumn($alias . '.from_name');
            $criteria->removeSelectColumn($alias . '.admin_email');
            $criteria->removeSelectColumn($alias . '.admin_cc');
            $criteria->removeSelectColumn($alias . '.daily_report_emails');
            $criteria->removeSelectColumn($alias . '.team_emails');
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
        return Propel::getServiceContainer()->getDatabaseMap(ConfigurationTableMap::DATABASE_NAME)->getTable(ConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Configuration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Configuration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Configuration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ConfigurationTableMap::DATABASE_NAME);
            $criteria->add(ConfigurationTableMap::COL_EC_ID, (array) $values, Criteria::IN);
        }

        $query = ConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Configuration or Criteria object.
     *
     * @param mixed $criteria Criteria or Configuration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Configuration object
        }

        if ($criteria->containsKey(ConfigurationTableMap::COL_EC_ID) && $criteria->keyContainsValue(ConfigurationTableMap::COL_EC_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ConfigurationTableMap::COL_EC_ID.')');
        }


        // Set the correct dbName
        $query = ConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

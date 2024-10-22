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
use entities\NotificationConfiguration;
use entities\NotificationConfigurationQuery;


/**
 * This class defines the structure of the 'notification_configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NotificationConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.NotificationConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'notification_configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'NotificationConfiguration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\NotificationConfiguration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.NotificationConfiguration';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the notification_configuration_id field
     */
    public const COL_NOTIFICATION_CONFIGURATION_ID = 'notification_configuration.notification_configuration_id';

    /**
     * the column name for the notification_type field
     */
    public const COL_NOTIFICATION_TYPE = 'notification_configuration.notification_type';

    /**
     * the column name for the is_enabled field
     */
    public const COL_IS_ENABLED = 'notification_configuration.is_enabled';

    /**
     * the column name for the notification_time field
     */
    public const COL_NOTIFICATION_TIME = 'notification_configuration.notification_time';

    /**
     * the column name for the notification_subject field
     */
    public const COL_NOTIFICATION_SUBJECT = 'notification_configuration.notification_subject';

    /**
     * the column name for the notification_message field
     */
    public const COL_NOTIFICATION_MESSAGE = 'notification_configuration.notification_message';

    /**
     * the column name for the redirect_screen field
     */
    public const COL_REDIRECT_SCREEN = 'notification_configuration.redirect_screen';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'notification_configuration.designation';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'notification_configuration.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'notification_configuration.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'notification_configuration.updated_at';

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
        self::TYPE_PHPNAME       => ['NotificationConfigurationId', 'NotificationType', 'IsEnabled', 'NotificationTime', 'NotificationSubject', 'NotificationMessage', 'RedirectScreen', 'Designation', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['notificationConfigurationId', 'notificationType', 'isEnabled', 'notificationTime', 'notificationSubject', 'notificationMessage', 'redirectScreen', 'designation', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE, NotificationConfigurationTableMap::COL_IS_ENABLED, NotificationConfigurationTableMap::COL_NOTIFICATION_TIME, NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT, NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE, NotificationConfigurationTableMap::COL_REDIRECT_SCREEN, NotificationConfigurationTableMap::COL_DESIGNATION, NotificationConfigurationTableMap::COL_COMPANY_ID, NotificationConfigurationTableMap::COL_CREATED_AT, NotificationConfigurationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['notification_configuration_id', 'notification_type', 'is_enabled', 'notification_time', 'notification_subject', 'notification_message', 'redirect_screen', 'designation', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['NotificationConfigurationId' => 0, 'NotificationType' => 1, 'IsEnabled' => 2, 'NotificationTime' => 3, 'NotificationSubject' => 4, 'NotificationMessage' => 5, 'RedirectScreen' => 6, 'Designation' => 7, 'CompanyId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['notificationConfigurationId' => 0, 'notificationType' => 1, 'isEnabled' => 2, 'notificationTime' => 3, 'notificationSubject' => 4, 'notificationMessage' => 5, 'redirectScreen' => 6, 'designation' => 7, 'companyId' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID => 0, NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE => 1, NotificationConfigurationTableMap::COL_IS_ENABLED => 2, NotificationConfigurationTableMap::COL_NOTIFICATION_TIME => 3, NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT => 4, NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE => 5, NotificationConfigurationTableMap::COL_REDIRECT_SCREEN => 6, NotificationConfigurationTableMap::COL_DESIGNATION => 7, NotificationConfigurationTableMap::COL_COMPANY_ID => 8, NotificationConfigurationTableMap::COL_CREATED_AT => 9, NotificationConfigurationTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['notification_configuration_id' => 0, 'notification_type' => 1, 'is_enabled' => 2, 'notification_time' => 3, 'notification_subject' => 4, 'notification_message' => 5, 'redirect_screen' => 6, 'designation' => 7, 'company_id' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'NotificationConfigurationId' => 'NOTIFICATION_CONFIGURATION_ID',
        'NotificationConfiguration.NotificationConfigurationId' => 'NOTIFICATION_CONFIGURATION_ID',
        'notificationConfigurationId' => 'NOTIFICATION_CONFIGURATION_ID',
        'notificationConfiguration.notificationConfigurationId' => 'NOTIFICATION_CONFIGURATION_ID',
        'NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID' => 'NOTIFICATION_CONFIGURATION_ID',
        'COL_NOTIFICATION_CONFIGURATION_ID' => 'NOTIFICATION_CONFIGURATION_ID',
        'notification_configuration_id' => 'NOTIFICATION_CONFIGURATION_ID',
        'notification_configuration.notification_configuration_id' => 'NOTIFICATION_CONFIGURATION_ID',
        'NotificationType' => 'NOTIFICATION_TYPE',
        'NotificationConfiguration.NotificationType' => 'NOTIFICATION_TYPE',
        'notificationType' => 'NOTIFICATION_TYPE',
        'notificationConfiguration.notificationType' => 'NOTIFICATION_TYPE',
        'NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE' => 'NOTIFICATION_TYPE',
        'COL_NOTIFICATION_TYPE' => 'NOTIFICATION_TYPE',
        'notification_type' => 'NOTIFICATION_TYPE',
        'notification_configuration.notification_type' => 'NOTIFICATION_TYPE',
        'IsEnabled' => 'IS_ENABLED',
        'NotificationConfiguration.IsEnabled' => 'IS_ENABLED',
        'isEnabled' => 'IS_ENABLED',
        'notificationConfiguration.isEnabled' => 'IS_ENABLED',
        'NotificationConfigurationTableMap::COL_IS_ENABLED' => 'IS_ENABLED',
        'COL_IS_ENABLED' => 'IS_ENABLED',
        'is_enabled' => 'IS_ENABLED',
        'notification_configuration.is_enabled' => 'IS_ENABLED',
        'NotificationTime' => 'NOTIFICATION_TIME',
        'NotificationConfiguration.NotificationTime' => 'NOTIFICATION_TIME',
        'notificationTime' => 'NOTIFICATION_TIME',
        'notificationConfiguration.notificationTime' => 'NOTIFICATION_TIME',
        'NotificationConfigurationTableMap::COL_NOTIFICATION_TIME' => 'NOTIFICATION_TIME',
        'COL_NOTIFICATION_TIME' => 'NOTIFICATION_TIME',
        'notification_time' => 'NOTIFICATION_TIME',
        'notification_configuration.notification_time' => 'NOTIFICATION_TIME',
        'NotificationSubject' => 'NOTIFICATION_SUBJECT',
        'NotificationConfiguration.NotificationSubject' => 'NOTIFICATION_SUBJECT',
        'notificationSubject' => 'NOTIFICATION_SUBJECT',
        'notificationConfiguration.notificationSubject' => 'NOTIFICATION_SUBJECT',
        'NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT' => 'NOTIFICATION_SUBJECT',
        'COL_NOTIFICATION_SUBJECT' => 'NOTIFICATION_SUBJECT',
        'notification_subject' => 'NOTIFICATION_SUBJECT',
        'notification_configuration.notification_subject' => 'NOTIFICATION_SUBJECT',
        'NotificationMessage' => 'NOTIFICATION_MESSAGE',
        'NotificationConfiguration.NotificationMessage' => 'NOTIFICATION_MESSAGE',
        'notificationMessage' => 'NOTIFICATION_MESSAGE',
        'notificationConfiguration.notificationMessage' => 'NOTIFICATION_MESSAGE',
        'NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE' => 'NOTIFICATION_MESSAGE',
        'COL_NOTIFICATION_MESSAGE' => 'NOTIFICATION_MESSAGE',
        'notification_message' => 'NOTIFICATION_MESSAGE',
        'notification_configuration.notification_message' => 'NOTIFICATION_MESSAGE',
        'RedirectScreen' => 'REDIRECT_SCREEN',
        'NotificationConfiguration.RedirectScreen' => 'REDIRECT_SCREEN',
        'redirectScreen' => 'REDIRECT_SCREEN',
        'notificationConfiguration.redirectScreen' => 'REDIRECT_SCREEN',
        'NotificationConfigurationTableMap::COL_REDIRECT_SCREEN' => 'REDIRECT_SCREEN',
        'COL_REDIRECT_SCREEN' => 'REDIRECT_SCREEN',
        'redirect_screen' => 'REDIRECT_SCREEN',
        'notification_configuration.redirect_screen' => 'REDIRECT_SCREEN',
        'Designation' => 'DESIGNATION',
        'NotificationConfiguration.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'notificationConfiguration.designation' => 'DESIGNATION',
        'NotificationConfigurationTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'notification_configuration.designation' => 'DESIGNATION',
        'CompanyId' => 'COMPANY_ID',
        'NotificationConfiguration.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'notificationConfiguration.companyId' => 'COMPANY_ID',
        'NotificationConfigurationTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'notification_configuration.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'NotificationConfiguration.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'notificationConfiguration.createdAt' => 'CREATED_AT',
        'NotificationConfigurationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'notification_configuration.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'NotificationConfiguration.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'notificationConfiguration.updatedAt' => 'UPDATED_AT',
        'NotificationConfigurationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'notification_configuration.updated_at' => 'UPDATED_AT',
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
        $this->setName('notification_configuration');
        $this->setPhpName('NotificationConfiguration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\NotificationConfiguration');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('notification_configuration_notification_configuration_id_seq');
        // columns
        $this->addPrimaryKey('notification_configuration_id', 'NotificationConfigurationId', 'INTEGER', true, null, null);
        $this->addColumn('notification_type', 'NotificationType', 'VARCHAR', false, null, null);
        $this->addColumn('is_enabled', 'IsEnabled', 'BOOLEAN', false, 1, null);
        $this->addColumn('notification_time', 'NotificationTime', 'VARCHAR', false, null, null);
        $this->addColumn('notification_subject', 'NotificationSubject', 'VARCHAR', false, null, null);
        $this->addColumn('notification_message', 'NotificationMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('redirect_screen', 'RedirectScreen', 'VARCHAR', false, null, null);
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('NotificationConfigurationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NotificationConfigurationTableMap::CLASS_DEFAULT : NotificationConfigurationTableMap::OM_CLASS;
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
     * @return array (NotificationConfiguration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NotificationConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NotificationConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NotificationConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NotificationConfigurationTableMap::OM_CLASS;
            /** @var NotificationConfiguration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NotificationConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = NotificationConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NotificationConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NotificationConfiguration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NotificationConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_IS_ENABLED);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_TIME);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_REDIRECT_SCREEN);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(NotificationConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.notification_configuration_id');
            $criteria->addSelectColumn($alias . '.notification_type');
            $criteria->addSelectColumn($alias . '.is_enabled');
            $criteria->addSelectColumn($alias . '.notification_time');
            $criteria->addSelectColumn($alias . '.notification_subject');
            $criteria->addSelectColumn($alias . '.notification_message');
            $criteria->addSelectColumn($alias . '.redirect_screen');
            $criteria->addSelectColumn($alias . '.designation');
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
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_TYPE);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_IS_ENABLED);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_TIME);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_SUBJECT);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_NOTIFICATION_MESSAGE);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_REDIRECT_SCREEN);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(NotificationConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.notification_configuration_id');
            $criteria->removeSelectColumn($alias . '.notification_type');
            $criteria->removeSelectColumn($alias . '.is_enabled');
            $criteria->removeSelectColumn($alias . '.notification_time');
            $criteria->removeSelectColumn($alias . '.notification_subject');
            $criteria->removeSelectColumn($alias . '.notification_message');
            $criteria->removeSelectColumn($alias . '.redirect_screen');
            $criteria->removeSelectColumn($alias . '.designation');
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
        return Propel::getServiceContainer()->getDatabaseMap(NotificationConfigurationTableMap::DATABASE_NAME)->getTable(NotificationConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a NotificationConfiguration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or NotificationConfiguration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\NotificationConfiguration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NotificationConfigurationTableMap::DATABASE_NAME);
            $criteria->add(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID, (array) $values, Criteria::IN);
        }

        $query = NotificationConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NotificationConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NotificationConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the notification_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NotificationConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NotificationConfiguration or Criteria object.
     *
     * @param mixed $criteria Criteria or NotificationConfiguration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NotificationConfiguration object
        }

        if ($criteria->containsKey(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID) && $criteria->keyContainsValue(NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NotificationConfigurationTableMap::COL_NOTIFICATION_CONFIGURATION_ID.')');
        }


        // Set the correct dbName
        $query = NotificationConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

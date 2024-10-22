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
use entities\SystemConfigs;
use entities\SystemConfigsQuery;


/**
 * This class defines the structure of the 'system_configs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SystemConfigsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SystemConfigsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'system_configs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SystemConfigs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SystemConfigs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SystemConfigs';

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
     * the column name for the config_id field
     */
    public const COL_CONFIG_ID = 'system_configs.config_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'system_configs.company_id';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'system_configs.orgunit_id';

    /**
     * the column name for the module_name field
     */
    public const COL_MODULE_NAME = 'system_configs.module_name';

    /**
     * the column name for the config_key field
     */
    public const COL_CONFIG_KEY = 'system_configs.config_key';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'system_configs.description';

    /**
     * the column name for the data_type field
     */
    public const COL_DATA_TYPE = 'system_configs.data_type';

    /**
     * the column name for the config_options field
     */
    public const COL_CONFIG_OPTIONS = 'system_configs.config_options';

    /**
     * the column name for the config_default field
     */
    public const COL_CONFIG_DEFAULT = 'system_configs.config_default';

    /**
     * the column name for the config_value field
     */
    public const COL_CONFIG_VALUE = 'system_configs.config_value';

    /**
     * the column name for the config_scope field
     */
    public const COL_CONFIG_SCOPE = 'system_configs.config_scope';

    /**
     * the column name for the dependent_config_key field
     */
    public const COL_DEPENDENT_CONFIG_KEY = 'system_configs.dependent_config_key';

    /**
     * the column name for the dependent_config_key_value field
     */
    public const COL_DEPENDENT_CONFIG_KEY_VALUE = 'system_configs.dependent_config_key_value';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'system_configs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'system_configs.updated_at';

    /**
     * the column name for the is_app field
     */
    public const COL_IS_APP = 'system_configs.is_app';

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
        self::TYPE_PHPNAME       => ['ConfigId', 'CompanyId', 'OrgunitId', 'ModuleName', 'ConfigKey', 'Description', 'DataType', 'ConfigOptions', 'ConfigDefault', 'ConfigValue', 'ConfigScope', 'DependentConfigKey', 'DependentConfigKeyValue', 'CreatedAt', 'UpdatedAt', 'IsApp', ],
        self::TYPE_CAMELNAME     => ['configId', 'companyId', 'orgunitId', 'moduleName', 'configKey', 'description', 'dataType', 'configOptions', 'configDefault', 'configValue', 'configScope', 'dependentConfigKey', 'dependentConfigKeyValue', 'createdAt', 'updatedAt', 'isApp', ],
        self::TYPE_COLNAME       => [SystemConfigsTableMap::COL_CONFIG_ID, SystemConfigsTableMap::COL_COMPANY_ID, SystemConfigsTableMap::COL_ORGUNIT_ID, SystemConfigsTableMap::COL_MODULE_NAME, SystemConfigsTableMap::COL_CONFIG_KEY, SystemConfigsTableMap::COL_DESCRIPTION, SystemConfigsTableMap::COL_DATA_TYPE, SystemConfigsTableMap::COL_CONFIG_OPTIONS, SystemConfigsTableMap::COL_CONFIG_DEFAULT, SystemConfigsTableMap::COL_CONFIG_VALUE, SystemConfigsTableMap::COL_CONFIG_SCOPE, SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY, SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE, SystemConfigsTableMap::COL_CREATED_AT, SystemConfigsTableMap::COL_UPDATED_AT, SystemConfigsTableMap::COL_IS_APP, ],
        self::TYPE_FIELDNAME     => ['config_id', 'company_id', 'orgunit_id', 'module_name', 'config_key', 'description', 'data_type', 'config_options', 'config_default', 'config_value', 'config_scope', 'dependent_config_key', 'dependent_config_key_value', 'created_at', 'updated_at', 'is_app', ],
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
        self::TYPE_PHPNAME       => ['ConfigId' => 0, 'CompanyId' => 1, 'OrgunitId' => 2, 'ModuleName' => 3, 'ConfigKey' => 4, 'Description' => 5, 'DataType' => 6, 'ConfigOptions' => 7, 'ConfigDefault' => 8, 'ConfigValue' => 9, 'ConfigScope' => 10, 'DependentConfigKey' => 11, 'DependentConfigKeyValue' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'IsApp' => 15, ],
        self::TYPE_CAMELNAME     => ['configId' => 0, 'companyId' => 1, 'orgunitId' => 2, 'moduleName' => 3, 'configKey' => 4, 'description' => 5, 'dataType' => 6, 'configOptions' => 7, 'configDefault' => 8, 'configValue' => 9, 'configScope' => 10, 'dependentConfigKey' => 11, 'dependentConfigKeyValue' => 12, 'createdAt' => 13, 'updatedAt' => 14, 'isApp' => 15, ],
        self::TYPE_COLNAME       => [SystemConfigsTableMap::COL_CONFIG_ID => 0, SystemConfigsTableMap::COL_COMPANY_ID => 1, SystemConfigsTableMap::COL_ORGUNIT_ID => 2, SystemConfigsTableMap::COL_MODULE_NAME => 3, SystemConfigsTableMap::COL_CONFIG_KEY => 4, SystemConfigsTableMap::COL_DESCRIPTION => 5, SystemConfigsTableMap::COL_DATA_TYPE => 6, SystemConfigsTableMap::COL_CONFIG_OPTIONS => 7, SystemConfigsTableMap::COL_CONFIG_DEFAULT => 8, SystemConfigsTableMap::COL_CONFIG_VALUE => 9, SystemConfigsTableMap::COL_CONFIG_SCOPE => 10, SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY => 11, SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE => 12, SystemConfigsTableMap::COL_CREATED_AT => 13, SystemConfigsTableMap::COL_UPDATED_AT => 14, SystemConfigsTableMap::COL_IS_APP => 15, ],
        self::TYPE_FIELDNAME     => ['config_id' => 0, 'company_id' => 1, 'orgunit_id' => 2, 'module_name' => 3, 'config_key' => 4, 'description' => 5, 'data_type' => 6, 'config_options' => 7, 'config_default' => 8, 'config_value' => 9, 'config_scope' => 10, 'dependent_config_key' => 11, 'dependent_config_key_value' => 12, 'created_at' => 13, 'updated_at' => 14, 'is_app' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ConfigId' => 'CONFIG_ID',
        'SystemConfigs.ConfigId' => 'CONFIG_ID',
        'configId' => 'CONFIG_ID',
        'systemConfigs.configId' => 'CONFIG_ID',
        'SystemConfigsTableMap::COL_CONFIG_ID' => 'CONFIG_ID',
        'COL_CONFIG_ID' => 'CONFIG_ID',
        'config_id' => 'CONFIG_ID',
        'system_configs.config_id' => 'CONFIG_ID',
        'CompanyId' => 'COMPANY_ID',
        'SystemConfigs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'systemConfigs.companyId' => 'COMPANY_ID',
        'SystemConfigsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'system_configs.company_id' => 'COMPANY_ID',
        'OrgunitId' => 'ORGUNIT_ID',
        'SystemConfigs.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'systemConfigs.orgunitId' => 'ORGUNIT_ID',
        'SystemConfigsTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'system_configs.orgunit_id' => 'ORGUNIT_ID',
        'ModuleName' => 'MODULE_NAME',
        'SystemConfigs.ModuleName' => 'MODULE_NAME',
        'moduleName' => 'MODULE_NAME',
        'systemConfigs.moduleName' => 'MODULE_NAME',
        'SystemConfigsTableMap::COL_MODULE_NAME' => 'MODULE_NAME',
        'COL_MODULE_NAME' => 'MODULE_NAME',
        'module_name' => 'MODULE_NAME',
        'system_configs.module_name' => 'MODULE_NAME',
        'ConfigKey' => 'CONFIG_KEY',
        'SystemConfigs.ConfigKey' => 'CONFIG_KEY',
        'configKey' => 'CONFIG_KEY',
        'systemConfigs.configKey' => 'CONFIG_KEY',
        'SystemConfigsTableMap::COL_CONFIG_KEY' => 'CONFIG_KEY',
        'COL_CONFIG_KEY' => 'CONFIG_KEY',
        'config_key' => 'CONFIG_KEY',
        'system_configs.config_key' => 'CONFIG_KEY',
        'Description' => 'DESCRIPTION',
        'SystemConfigs.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'systemConfigs.description' => 'DESCRIPTION',
        'SystemConfigsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'system_configs.description' => 'DESCRIPTION',
        'DataType' => 'DATA_TYPE',
        'SystemConfigs.DataType' => 'DATA_TYPE',
        'dataType' => 'DATA_TYPE',
        'systemConfigs.dataType' => 'DATA_TYPE',
        'SystemConfigsTableMap::COL_DATA_TYPE' => 'DATA_TYPE',
        'COL_DATA_TYPE' => 'DATA_TYPE',
        'data_type' => 'DATA_TYPE',
        'system_configs.data_type' => 'DATA_TYPE',
        'ConfigOptions' => 'CONFIG_OPTIONS',
        'SystemConfigs.ConfigOptions' => 'CONFIG_OPTIONS',
        'configOptions' => 'CONFIG_OPTIONS',
        'systemConfigs.configOptions' => 'CONFIG_OPTIONS',
        'SystemConfigsTableMap::COL_CONFIG_OPTIONS' => 'CONFIG_OPTIONS',
        'COL_CONFIG_OPTIONS' => 'CONFIG_OPTIONS',
        'config_options' => 'CONFIG_OPTIONS',
        'system_configs.config_options' => 'CONFIG_OPTIONS',
        'ConfigDefault' => 'CONFIG_DEFAULT',
        'SystemConfigs.ConfigDefault' => 'CONFIG_DEFAULT',
        'configDefault' => 'CONFIG_DEFAULT',
        'systemConfigs.configDefault' => 'CONFIG_DEFAULT',
        'SystemConfigsTableMap::COL_CONFIG_DEFAULT' => 'CONFIG_DEFAULT',
        'COL_CONFIG_DEFAULT' => 'CONFIG_DEFAULT',
        'config_default' => 'CONFIG_DEFAULT',
        'system_configs.config_default' => 'CONFIG_DEFAULT',
        'ConfigValue' => 'CONFIG_VALUE',
        'SystemConfigs.ConfigValue' => 'CONFIG_VALUE',
        'configValue' => 'CONFIG_VALUE',
        'systemConfigs.configValue' => 'CONFIG_VALUE',
        'SystemConfigsTableMap::COL_CONFIG_VALUE' => 'CONFIG_VALUE',
        'COL_CONFIG_VALUE' => 'CONFIG_VALUE',
        'config_value' => 'CONFIG_VALUE',
        'system_configs.config_value' => 'CONFIG_VALUE',
        'ConfigScope' => 'CONFIG_SCOPE',
        'SystemConfigs.ConfigScope' => 'CONFIG_SCOPE',
        'configScope' => 'CONFIG_SCOPE',
        'systemConfigs.configScope' => 'CONFIG_SCOPE',
        'SystemConfigsTableMap::COL_CONFIG_SCOPE' => 'CONFIG_SCOPE',
        'COL_CONFIG_SCOPE' => 'CONFIG_SCOPE',
        'config_scope' => 'CONFIG_SCOPE',
        'system_configs.config_scope' => 'CONFIG_SCOPE',
        'DependentConfigKey' => 'DEPENDENT_CONFIG_KEY',
        'SystemConfigs.DependentConfigKey' => 'DEPENDENT_CONFIG_KEY',
        'dependentConfigKey' => 'DEPENDENT_CONFIG_KEY',
        'systemConfigs.dependentConfigKey' => 'DEPENDENT_CONFIG_KEY',
        'SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY' => 'DEPENDENT_CONFIG_KEY',
        'COL_DEPENDENT_CONFIG_KEY' => 'DEPENDENT_CONFIG_KEY',
        'dependent_config_key' => 'DEPENDENT_CONFIG_KEY',
        'system_configs.dependent_config_key' => 'DEPENDENT_CONFIG_KEY',
        'DependentConfigKeyValue' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'SystemConfigs.DependentConfigKeyValue' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'dependentConfigKeyValue' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'systemConfigs.dependentConfigKeyValue' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'COL_DEPENDENT_CONFIG_KEY_VALUE' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'dependent_config_key_value' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'system_configs.dependent_config_key_value' => 'DEPENDENT_CONFIG_KEY_VALUE',
        'CreatedAt' => 'CREATED_AT',
        'SystemConfigs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'systemConfigs.createdAt' => 'CREATED_AT',
        'SystemConfigsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'system_configs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SystemConfigs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'systemConfigs.updatedAt' => 'UPDATED_AT',
        'SystemConfigsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'system_configs.updated_at' => 'UPDATED_AT',
        'IsApp' => 'IS_APP',
        'SystemConfigs.IsApp' => 'IS_APP',
        'isApp' => 'IS_APP',
        'systemConfigs.isApp' => 'IS_APP',
        'SystemConfigsTableMap::COL_IS_APP' => 'IS_APP',
        'COL_IS_APP' => 'IS_APP',
        'is_app' => 'IS_APP',
        'system_configs.is_app' => 'IS_APP',
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
        $this->setName('system_configs');
        $this->setPhpName('SystemConfigs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SystemConfigs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('system_configs_config_id_seq');
        // columns
        $this->addPrimaryKey('config_id', 'ConfigId', 'INTEGER', true, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('orgunit_id', 'OrgunitId', 'INTEGER', false, null, null);
        $this->addColumn('module_name', 'ModuleName', 'VARCHAR', false, null, null);
        $this->addColumn('config_key', 'ConfigKey', 'VARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('data_type', 'DataType', 'VARCHAR', false, null, null);
        $this->addColumn('config_options', 'ConfigOptions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('config_default', 'ConfigDefault', 'VARCHAR', false, null, null);
        $this->addColumn('config_value', 'ConfigValue', 'VARCHAR', false, null, null);
        $this->addColumn('config_scope', 'ConfigScope', 'VARCHAR', false, null, null);
        $this->addColumn('dependent_config_key', 'DependentConfigKey', 'VARCHAR', false, null, null);
        $this->addColumn('dependent_config_key_value', 'DependentConfigKeyValue', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('is_app', 'IsApp', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ConfigId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SystemConfigsTableMap::CLASS_DEFAULT : SystemConfigsTableMap::OM_CLASS;
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
     * @return array (SystemConfigs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SystemConfigsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SystemConfigsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SystemConfigsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SystemConfigsTableMap::OM_CLASS;
            /** @var SystemConfigs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SystemConfigsTableMap::addInstanceToPool($obj, $key);
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
            $key = SystemConfigsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SystemConfigsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SystemConfigs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SystemConfigsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_ID);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_MODULE_NAME);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_KEY);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_DATA_TYPE);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_OPTIONS);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_DEFAULT);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_VALUE);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CONFIG_SCOPE);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SystemConfigsTableMap::COL_IS_APP);
        } else {
            $criteria->addSelectColumn($alias . '.config_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.module_name');
            $criteria->addSelectColumn($alias . '.config_key');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.data_type');
            $criteria->addSelectColumn($alias . '.config_options');
            $criteria->addSelectColumn($alias . '.config_default');
            $criteria->addSelectColumn($alias . '.config_value');
            $criteria->addSelectColumn($alias . '.config_scope');
            $criteria->addSelectColumn($alias . '.dependent_config_key');
            $criteria->addSelectColumn($alias . '.dependent_config_key_value');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.is_app');
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
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_ID);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_MODULE_NAME);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_KEY);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_DATA_TYPE);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_OPTIONS);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_DEFAULT);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_VALUE);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CONFIG_SCOPE);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_DEPENDENT_CONFIG_KEY_VALUE);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SystemConfigsTableMap::COL_IS_APP);
        } else {
            $criteria->removeSelectColumn($alias . '.config_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.module_name');
            $criteria->removeSelectColumn($alias . '.config_key');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.data_type');
            $criteria->removeSelectColumn($alias . '.config_options');
            $criteria->removeSelectColumn($alias . '.config_default');
            $criteria->removeSelectColumn($alias . '.config_value');
            $criteria->removeSelectColumn($alias . '.config_scope');
            $criteria->removeSelectColumn($alias . '.dependent_config_key');
            $criteria->removeSelectColumn($alias . '.dependent_config_key_value');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.is_app');
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
        return Propel::getServiceContainer()->getDatabaseMap(SystemConfigsTableMap::DATABASE_NAME)->getTable(SystemConfigsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SystemConfigs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SystemConfigs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SystemConfigsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SystemConfigs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SystemConfigsTableMap::DATABASE_NAME);
            $criteria->add(SystemConfigsTableMap::COL_CONFIG_ID, (array) $values, Criteria::IN);
        }

        $query = SystemConfigsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SystemConfigsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SystemConfigsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the system_configs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SystemConfigsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SystemConfigs or Criteria object.
     *
     * @param mixed $criteria Criteria or SystemConfigs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SystemConfigsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SystemConfigs object
        }

        if ($criteria->containsKey(SystemConfigsTableMap::COL_CONFIG_ID) && $criteria->keyContainsValue(SystemConfigsTableMap::COL_CONFIG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SystemConfigsTableMap::COL_CONFIG_ID.')');
        }


        // Set the correct dbName
        $query = SystemConfigsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\LeaveConfigurations;
use entities\LeaveConfigurationsQuery;


/**
 * This class defines the structure of the 'leave_configurations' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LeaveConfigurationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LeaveConfigurationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'leave_configurations';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'LeaveConfigurations';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\LeaveConfigurations';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.LeaveConfigurations';

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
    public const COL_ID = 'leave_configurations.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'leave_configurations.name';

    /**
     * the column name for the grade_id field
     */
    public const COL_GRADE_ID = 'leave_configurations.grade_id';

    /**
     * the column name for the leave_type field
     */
    public const COL_LEAVE_TYPE = 'leave_configurations.leave_type';

    /**
     * the column name for the policy_year field
     */
    public const COL_POLICY_YEAR = 'leave_configurations.policy_year';

    /**
     * the column name for the leave_points field
     */
    public const COL_LEAVE_POINTS = 'leave_configurations.leave_points';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'leave_configurations.is_active';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'leave_configurations.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'leave_configurations.updated_at';

    /**
     * the column name for the orgunitids field
     */
    public const COL_ORGUNITIDS = 'leave_configurations.orgunitids';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'leave_configurations.company_id';

    /**
     * the column name for the apply_date field
     */
    public const COL_APPLY_DATE = 'leave_configurations.apply_date';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'GradeId', 'LeaveType', 'PolicyYear', 'LeavePoints', 'IsActive', 'CreatedAt', 'UpdatedAt', 'Orgunitids', 'CompanyId', 'ApplyDate', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'gradeId', 'leaveType', 'policyYear', 'leavePoints', 'isActive', 'createdAt', 'updatedAt', 'orgunitids', 'companyId', 'applyDate', ],
        self::TYPE_COLNAME       => [LeaveConfigurationsTableMap::COL_ID, LeaveConfigurationsTableMap::COL_NAME, LeaveConfigurationsTableMap::COL_GRADE_ID, LeaveConfigurationsTableMap::COL_LEAVE_TYPE, LeaveConfigurationsTableMap::COL_POLICY_YEAR, LeaveConfigurationsTableMap::COL_LEAVE_POINTS, LeaveConfigurationsTableMap::COL_IS_ACTIVE, LeaveConfigurationsTableMap::COL_CREATED_AT, LeaveConfigurationsTableMap::COL_UPDATED_AT, LeaveConfigurationsTableMap::COL_ORGUNITIDS, LeaveConfigurationsTableMap::COL_COMPANY_ID, LeaveConfigurationsTableMap::COL_APPLY_DATE, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'grade_id', 'leave_type', 'policy_year', 'leave_points', 'is_active', 'created_at', 'updated_at', 'orgunitids', 'company_id', 'apply_date', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'GradeId' => 2, 'LeaveType' => 3, 'PolicyYear' => 4, 'LeavePoints' => 5, 'IsActive' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'Orgunitids' => 9, 'CompanyId' => 10, 'ApplyDate' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'gradeId' => 2, 'leaveType' => 3, 'policyYear' => 4, 'leavePoints' => 5, 'isActive' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'orgunitids' => 9, 'companyId' => 10, 'applyDate' => 11, ],
        self::TYPE_COLNAME       => [LeaveConfigurationsTableMap::COL_ID => 0, LeaveConfigurationsTableMap::COL_NAME => 1, LeaveConfigurationsTableMap::COL_GRADE_ID => 2, LeaveConfigurationsTableMap::COL_LEAVE_TYPE => 3, LeaveConfigurationsTableMap::COL_POLICY_YEAR => 4, LeaveConfigurationsTableMap::COL_LEAVE_POINTS => 5, LeaveConfigurationsTableMap::COL_IS_ACTIVE => 6, LeaveConfigurationsTableMap::COL_CREATED_AT => 7, LeaveConfigurationsTableMap::COL_UPDATED_AT => 8, LeaveConfigurationsTableMap::COL_ORGUNITIDS => 9, LeaveConfigurationsTableMap::COL_COMPANY_ID => 10, LeaveConfigurationsTableMap::COL_APPLY_DATE => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'grade_id' => 2, 'leave_type' => 3, 'policy_year' => 4, 'leave_points' => 5, 'is_active' => 6, 'created_at' => 7, 'updated_at' => 8, 'orgunitids' => 9, 'company_id' => 10, 'apply_date' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'LeaveConfigurations.Id' => 'ID',
        'id' => 'ID',
        'leaveConfigurations.id' => 'ID',
        'LeaveConfigurationsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'leave_configurations.id' => 'ID',
        'Name' => 'NAME',
        'LeaveConfigurations.Name' => 'NAME',
        'name' => 'NAME',
        'leaveConfigurations.name' => 'NAME',
        'LeaveConfigurationsTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'leave_configurations.name' => 'NAME',
        'GradeId' => 'GRADE_ID',
        'LeaveConfigurations.GradeId' => 'GRADE_ID',
        'gradeId' => 'GRADE_ID',
        'leaveConfigurations.gradeId' => 'GRADE_ID',
        'LeaveConfigurationsTableMap::COL_GRADE_ID' => 'GRADE_ID',
        'COL_GRADE_ID' => 'GRADE_ID',
        'grade_id' => 'GRADE_ID',
        'leave_configurations.grade_id' => 'GRADE_ID',
        'LeaveType' => 'LEAVE_TYPE',
        'LeaveConfigurations.LeaveType' => 'LEAVE_TYPE',
        'leaveType' => 'LEAVE_TYPE',
        'leaveConfigurations.leaveType' => 'LEAVE_TYPE',
        'LeaveConfigurationsTableMap::COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'leave_type' => 'LEAVE_TYPE',
        'leave_configurations.leave_type' => 'LEAVE_TYPE',
        'PolicyYear' => 'POLICY_YEAR',
        'LeaveConfigurations.PolicyYear' => 'POLICY_YEAR',
        'policyYear' => 'POLICY_YEAR',
        'leaveConfigurations.policyYear' => 'POLICY_YEAR',
        'LeaveConfigurationsTableMap::COL_POLICY_YEAR' => 'POLICY_YEAR',
        'COL_POLICY_YEAR' => 'POLICY_YEAR',
        'policy_year' => 'POLICY_YEAR',
        'leave_configurations.policy_year' => 'POLICY_YEAR',
        'LeavePoints' => 'LEAVE_POINTS',
        'LeaveConfigurations.LeavePoints' => 'LEAVE_POINTS',
        'leavePoints' => 'LEAVE_POINTS',
        'leaveConfigurations.leavePoints' => 'LEAVE_POINTS',
        'LeaveConfigurationsTableMap::COL_LEAVE_POINTS' => 'LEAVE_POINTS',
        'COL_LEAVE_POINTS' => 'LEAVE_POINTS',
        'leave_points' => 'LEAVE_POINTS',
        'leave_configurations.leave_points' => 'LEAVE_POINTS',
        'IsActive' => 'IS_ACTIVE',
        'LeaveConfigurations.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'leaveConfigurations.isActive' => 'IS_ACTIVE',
        'LeaveConfigurationsTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'leave_configurations.is_active' => 'IS_ACTIVE',
        'CreatedAt' => 'CREATED_AT',
        'LeaveConfigurations.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'leaveConfigurations.createdAt' => 'CREATED_AT',
        'LeaveConfigurationsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'leave_configurations.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'LeaveConfigurations.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'leaveConfigurations.updatedAt' => 'UPDATED_AT',
        'LeaveConfigurationsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'leave_configurations.updated_at' => 'UPDATED_AT',
        'Orgunitids' => 'ORGUNITIDS',
        'LeaveConfigurations.Orgunitids' => 'ORGUNITIDS',
        'orgunitids' => 'ORGUNITIDS',
        'leaveConfigurations.orgunitids' => 'ORGUNITIDS',
        'LeaveConfigurationsTableMap::COL_ORGUNITIDS' => 'ORGUNITIDS',
        'COL_ORGUNITIDS' => 'ORGUNITIDS',
        'leave_configurations.orgunitids' => 'ORGUNITIDS',
        'CompanyId' => 'COMPANY_ID',
        'LeaveConfigurations.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'leaveConfigurations.companyId' => 'COMPANY_ID',
        'LeaveConfigurationsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'leave_configurations.company_id' => 'COMPANY_ID',
        'ApplyDate' => 'APPLY_DATE',
        'LeaveConfigurations.ApplyDate' => 'APPLY_DATE',
        'applyDate' => 'APPLY_DATE',
        'leaveConfigurations.applyDate' => 'APPLY_DATE',
        'LeaveConfigurationsTableMap::COL_APPLY_DATE' => 'APPLY_DATE',
        'COL_APPLY_DATE' => 'APPLY_DATE',
        'apply_date' => 'APPLY_DATE',
        'leave_configurations.apply_date' => 'APPLY_DATE',
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
        $this->setName('leave_configurations');
        $this->setPhpName('LeaveConfigurations');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\LeaveConfigurations');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('leave_configurations_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 250, null);
        $this->addColumn('grade_id', 'GradeId', 'INTEGER', false, null, null);
        $this->addColumn('leave_type', 'LeaveType', 'VARCHAR', false, 250, null);
        $this->addColumn('policy_year', 'PolicyYear', 'INTEGER', false, null, null);
        $this->addColumn('leave_points', 'LeavePoints', 'DECIMAL', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('orgunitids', 'Orgunitids', 'LONGVARCHAR', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', true, null, null);
        $this->addColumn('apply_date', 'ApplyDate', 'DATE', false, null, null);
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
        return $withPrefix ? LeaveConfigurationsTableMap::CLASS_DEFAULT : LeaveConfigurationsTableMap::OM_CLASS;
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
     * @return array (LeaveConfigurations object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LeaveConfigurationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LeaveConfigurationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LeaveConfigurationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LeaveConfigurationsTableMap::OM_CLASS;
            /** @var LeaveConfigurations $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LeaveConfigurationsTableMap::addInstanceToPool($obj, $key);
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
            $key = LeaveConfigurationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LeaveConfigurationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var LeaveConfigurations $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LeaveConfigurationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_ID);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_NAME);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_GRADE_ID);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_LEAVE_TYPE);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_POLICY_YEAR);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_LEAVE_POINTS);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_ORGUNITIDS);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(LeaveConfigurationsTableMap::COL_APPLY_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.grade_id');
            $criteria->addSelectColumn($alias . '.leave_type');
            $criteria->addSelectColumn($alias . '.policy_year');
            $criteria->addSelectColumn($alias . '.leave_points');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunitids');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.apply_date');
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
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_ID);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_NAME);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_GRADE_ID);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_LEAVE_TYPE);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_POLICY_YEAR);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_LEAVE_POINTS);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_ORGUNITIDS);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(LeaveConfigurationsTableMap::COL_APPLY_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.grade_id');
            $criteria->removeSelectColumn($alias . '.leave_type');
            $criteria->removeSelectColumn($alias . '.policy_year');
            $criteria->removeSelectColumn($alias . '.leave_points');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunitids');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.apply_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(LeaveConfigurationsTableMap::DATABASE_NAME)->getTable(LeaveConfigurationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a LeaveConfigurations or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or LeaveConfigurations object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveConfigurationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\LeaveConfigurations) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LeaveConfigurationsTableMap::DATABASE_NAME);
            $criteria->add(LeaveConfigurationsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LeaveConfigurationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LeaveConfigurationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LeaveConfigurationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the leave_configurations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LeaveConfigurationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a LeaveConfigurations or Criteria object.
     *
     * @param mixed $criteria Criteria or LeaveConfigurations object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LeaveConfigurationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from LeaveConfigurations object
        }

        if ($criteria->containsKey(LeaveConfigurationsTableMap::COL_ID) && $criteria->keyContainsValue(LeaveConfigurationsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LeaveConfigurationsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LeaveConfigurationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

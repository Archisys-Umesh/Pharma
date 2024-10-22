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
use entities\Announcements;
use entities\AnnouncementsQuery;


/**
 * This class defines the structure of the 'announcements' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AnnouncementsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.AnnouncementsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'announcements';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Announcements';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Announcements';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Announcements';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the announcement_id field
     */
    public const COL_ANNOUNCEMENT_ID = 'announcements.announcement_id';

    /**
     * the column name for the announcement_message field
     */
    public const COL_ANNOUNCEMENT_MESSAGE = 'announcements.announcement_message';

    /**
     * the column name for the announcement_title field
     */
    public const COL_ANNOUNCEMENT_TITLE = 'announcements.announcement_title';

    /**
     * the column name for the announcement_stdate field
     */
    public const COL_ANNOUNCEMENT_STDATE = 'announcements.announcement_stdate';

    /**
     * the column name for the announcement_edate field
     */
    public const COL_ANNOUNCEMENT_EDATE = 'announcements.announcement_edate';

    /**
     * the column name for the branches field
     */
    public const COL_BRANCHES = 'announcements.branches';

    /**
     * the column name for the designations field
     */
    public const COL_DESIGNATIONS = 'announcements.designations';

    /**
     * the column name for the org_units field
     */
    public const COL_ORG_UNITS = 'announcements.org_units';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'announcements.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'announcements.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'announcements.updated_at';

    /**
     * the column name for the announcement_status field
     */
    public const COL_ANNOUNCEMENT_STATUS = 'announcements.announcement_status';

    /**
     * the column name for the announcements_url field
     */
    public const COL_ANNOUNCEMENTS_URL = 'announcements.announcements_url';

    /**
     * the column name for the is_employee_mapped field
     */
    public const COL_IS_EMPLOYEE_MAPPED = 'announcements.is_employee_mapped';

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
        self::TYPE_PHPNAME       => ['AnnouncementId', 'AnnouncementMessage', 'AnnouncementTitle', 'AnnouncementStdate', 'AnnouncementEdate', 'Branches', 'Designations', 'OrgUnits', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'AnnouncementStatus', 'AnnouncementsUrl', 'IsEmployeeMapped', ],
        self::TYPE_CAMELNAME     => ['announcementId', 'announcementMessage', 'announcementTitle', 'announcementStdate', 'announcementEdate', 'branches', 'designations', 'orgUnits', 'companyId', 'createdAt', 'updatedAt', 'announcementStatus', 'announcementsUrl', 'isEmployeeMapped', ],
        self::TYPE_COLNAME       => [AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE, AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE, AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE, AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE, AnnouncementsTableMap::COL_BRANCHES, AnnouncementsTableMap::COL_DESIGNATIONS, AnnouncementsTableMap::COL_ORG_UNITS, AnnouncementsTableMap::COL_COMPANY_ID, AnnouncementsTableMap::COL_CREATED_AT, AnnouncementsTableMap::COL_UPDATED_AT, AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS, AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL, AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED, ],
        self::TYPE_FIELDNAME     => ['announcement_id', 'announcement_message', 'announcement_title', 'announcement_stdate', 'announcement_edate', 'branches', 'designations', 'org_units', 'company_id', 'created_at', 'updated_at', 'announcement_status', 'announcements_url', 'is_employee_mapped', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['AnnouncementId' => 0, 'AnnouncementMessage' => 1, 'AnnouncementTitle' => 2, 'AnnouncementStdate' => 3, 'AnnouncementEdate' => 4, 'Branches' => 5, 'Designations' => 6, 'OrgUnits' => 7, 'CompanyId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'AnnouncementStatus' => 11, 'AnnouncementsUrl' => 12, 'IsEmployeeMapped' => 13, ],
        self::TYPE_CAMELNAME     => ['announcementId' => 0, 'announcementMessage' => 1, 'announcementTitle' => 2, 'announcementStdate' => 3, 'announcementEdate' => 4, 'branches' => 5, 'designations' => 6, 'orgUnits' => 7, 'companyId' => 8, 'createdAt' => 9, 'updatedAt' => 10, 'announcementStatus' => 11, 'announcementsUrl' => 12, 'isEmployeeMapped' => 13, ],
        self::TYPE_COLNAME       => [AnnouncementsTableMap::COL_ANNOUNCEMENT_ID => 0, AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE => 1, AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE => 2, AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE => 3, AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE => 4, AnnouncementsTableMap::COL_BRANCHES => 5, AnnouncementsTableMap::COL_DESIGNATIONS => 6, AnnouncementsTableMap::COL_ORG_UNITS => 7, AnnouncementsTableMap::COL_COMPANY_ID => 8, AnnouncementsTableMap::COL_CREATED_AT => 9, AnnouncementsTableMap::COL_UPDATED_AT => 10, AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS => 11, AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL => 12, AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED => 13, ],
        self::TYPE_FIELDNAME     => ['announcement_id' => 0, 'announcement_message' => 1, 'announcement_title' => 2, 'announcement_stdate' => 3, 'announcement_edate' => 4, 'branches' => 5, 'designations' => 6, 'org_units' => 7, 'company_id' => 8, 'created_at' => 9, 'updated_at' => 10, 'announcement_status' => 11, 'announcements_url' => 12, 'is_employee_mapped' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'AnnouncementId' => 'ANNOUNCEMENT_ID',
        'Announcements.AnnouncementId' => 'ANNOUNCEMENT_ID',
        'announcementId' => 'ANNOUNCEMENT_ID',
        'announcements.announcementId' => 'ANNOUNCEMENT_ID',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_ID' => 'ANNOUNCEMENT_ID',
        'COL_ANNOUNCEMENT_ID' => 'ANNOUNCEMENT_ID',
        'announcement_id' => 'ANNOUNCEMENT_ID',
        'announcements.announcement_id' => 'ANNOUNCEMENT_ID',
        'AnnouncementMessage' => 'ANNOUNCEMENT_MESSAGE',
        'Announcements.AnnouncementMessage' => 'ANNOUNCEMENT_MESSAGE',
        'announcementMessage' => 'ANNOUNCEMENT_MESSAGE',
        'announcements.announcementMessage' => 'ANNOUNCEMENT_MESSAGE',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE' => 'ANNOUNCEMENT_MESSAGE',
        'COL_ANNOUNCEMENT_MESSAGE' => 'ANNOUNCEMENT_MESSAGE',
        'announcement_message' => 'ANNOUNCEMENT_MESSAGE',
        'announcements.announcement_message' => 'ANNOUNCEMENT_MESSAGE',
        'AnnouncementTitle' => 'ANNOUNCEMENT_TITLE',
        'Announcements.AnnouncementTitle' => 'ANNOUNCEMENT_TITLE',
        'announcementTitle' => 'ANNOUNCEMENT_TITLE',
        'announcements.announcementTitle' => 'ANNOUNCEMENT_TITLE',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE' => 'ANNOUNCEMENT_TITLE',
        'COL_ANNOUNCEMENT_TITLE' => 'ANNOUNCEMENT_TITLE',
        'announcement_title' => 'ANNOUNCEMENT_TITLE',
        'announcements.announcement_title' => 'ANNOUNCEMENT_TITLE',
        'AnnouncementStdate' => 'ANNOUNCEMENT_STDATE',
        'Announcements.AnnouncementStdate' => 'ANNOUNCEMENT_STDATE',
        'announcementStdate' => 'ANNOUNCEMENT_STDATE',
        'announcements.announcementStdate' => 'ANNOUNCEMENT_STDATE',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE' => 'ANNOUNCEMENT_STDATE',
        'COL_ANNOUNCEMENT_STDATE' => 'ANNOUNCEMENT_STDATE',
        'announcement_stdate' => 'ANNOUNCEMENT_STDATE',
        'announcements.announcement_stdate' => 'ANNOUNCEMENT_STDATE',
        'AnnouncementEdate' => 'ANNOUNCEMENT_EDATE',
        'Announcements.AnnouncementEdate' => 'ANNOUNCEMENT_EDATE',
        'announcementEdate' => 'ANNOUNCEMENT_EDATE',
        'announcements.announcementEdate' => 'ANNOUNCEMENT_EDATE',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE' => 'ANNOUNCEMENT_EDATE',
        'COL_ANNOUNCEMENT_EDATE' => 'ANNOUNCEMENT_EDATE',
        'announcement_edate' => 'ANNOUNCEMENT_EDATE',
        'announcements.announcement_edate' => 'ANNOUNCEMENT_EDATE',
        'Branches' => 'BRANCHES',
        'Announcements.Branches' => 'BRANCHES',
        'branches' => 'BRANCHES',
        'announcements.branches' => 'BRANCHES',
        'AnnouncementsTableMap::COL_BRANCHES' => 'BRANCHES',
        'COL_BRANCHES' => 'BRANCHES',
        'Designations' => 'DESIGNATIONS',
        'Announcements.Designations' => 'DESIGNATIONS',
        'designations' => 'DESIGNATIONS',
        'announcements.designations' => 'DESIGNATIONS',
        'AnnouncementsTableMap::COL_DESIGNATIONS' => 'DESIGNATIONS',
        'COL_DESIGNATIONS' => 'DESIGNATIONS',
        'OrgUnits' => 'ORG_UNITS',
        'Announcements.OrgUnits' => 'ORG_UNITS',
        'orgUnits' => 'ORG_UNITS',
        'announcements.orgUnits' => 'ORG_UNITS',
        'AnnouncementsTableMap::COL_ORG_UNITS' => 'ORG_UNITS',
        'COL_ORG_UNITS' => 'ORG_UNITS',
        'org_units' => 'ORG_UNITS',
        'announcements.org_units' => 'ORG_UNITS',
        'CompanyId' => 'COMPANY_ID',
        'Announcements.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'announcements.companyId' => 'COMPANY_ID',
        'AnnouncementsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'announcements.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Announcements.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'announcements.createdAt' => 'CREATED_AT',
        'AnnouncementsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'announcements.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Announcements.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'announcements.updatedAt' => 'UPDATED_AT',
        'AnnouncementsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'announcements.updated_at' => 'UPDATED_AT',
        'AnnouncementStatus' => 'ANNOUNCEMENT_STATUS',
        'Announcements.AnnouncementStatus' => 'ANNOUNCEMENT_STATUS',
        'announcementStatus' => 'ANNOUNCEMENT_STATUS',
        'announcements.announcementStatus' => 'ANNOUNCEMENT_STATUS',
        'AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS' => 'ANNOUNCEMENT_STATUS',
        'COL_ANNOUNCEMENT_STATUS' => 'ANNOUNCEMENT_STATUS',
        'announcement_status' => 'ANNOUNCEMENT_STATUS',
        'announcements.announcement_status' => 'ANNOUNCEMENT_STATUS',
        'AnnouncementsUrl' => 'ANNOUNCEMENTS_URL',
        'Announcements.AnnouncementsUrl' => 'ANNOUNCEMENTS_URL',
        'announcementsUrl' => 'ANNOUNCEMENTS_URL',
        'announcements.announcementsUrl' => 'ANNOUNCEMENTS_URL',
        'AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL' => 'ANNOUNCEMENTS_URL',
        'COL_ANNOUNCEMENTS_URL' => 'ANNOUNCEMENTS_URL',
        'announcements_url' => 'ANNOUNCEMENTS_URL',
        'announcements.announcements_url' => 'ANNOUNCEMENTS_URL',
        'IsEmployeeMapped' => 'IS_EMPLOYEE_MAPPED',
        'Announcements.IsEmployeeMapped' => 'IS_EMPLOYEE_MAPPED',
        'isEmployeeMapped' => 'IS_EMPLOYEE_MAPPED',
        'announcements.isEmployeeMapped' => 'IS_EMPLOYEE_MAPPED',
        'AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED' => 'IS_EMPLOYEE_MAPPED',
        'COL_IS_EMPLOYEE_MAPPED' => 'IS_EMPLOYEE_MAPPED',
        'is_employee_mapped' => 'IS_EMPLOYEE_MAPPED',
        'announcements.is_employee_mapped' => 'IS_EMPLOYEE_MAPPED',
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
        $this->setName('announcements');
        $this->setPhpName('Announcements');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Announcements');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('announcements_announcement_id_seq');
        // columns
        $this->addPrimaryKey('announcement_id', 'AnnouncementId', 'INTEGER', true, null, null);
        $this->addColumn('announcement_message', 'AnnouncementMessage', 'VARCHAR', false, null, null);
        $this->addColumn('announcement_title', 'AnnouncementTitle', 'VARCHAR', false, null, null);
        $this->addColumn('announcement_stdate', 'AnnouncementStdate', 'DATE', false, null, null);
        $this->addColumn('announcement_edate', 'AnnouncementEdate', 'DATE', false, null, null);
        $this->addColumn('branches', 'Branches', 'VARCHAR', false, null, null);
        $this->addColumn('designations', 'Designations', 'VARCHAR', false, null, null);
        $this->addColumn('org_units', 'OrgUnits', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('announcement_status', 'AnnouncementStatus', 'VARCHAR', false, null, null);
        $this->addColumn('announcements_url', 'AnnouncementsUrl', 'VARCHAR', false, null, null);
        $this->addColumn('is_employee_mapped', 'IsEmployeeMapped', 'BOOLEAN', false, 1, true);
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
        $this->addRelation('AnnouncementEmployeeMap', '\\entities\\AnnouncementEmployeeMap', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':announcement_id',
    1 => ':announcement_id',
  ),
), null, null, 'AnnouncementEmployeeMaps', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('AnnouncementId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AnnouncementsTableMap::CLASS_DEFAULT : AnnouncementsTableMap::OM_CLASS;
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
     * @return array (Announcements object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AnnouncementsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AnnouncementsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AnnouncementsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AnnouncementsTableMap::OM_CLASS;
            /** @var Announcements $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AnnouncementsTableMap::addInstanceToPool($obj, $key);
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
            $key = AnnouncementsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AnnouncementsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Announcements $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AnnouncementsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_BRANCHES);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_DESIGNATIONS);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ORG_UNITS);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL);
            $criteria->addSelectColumn(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED);
        } else {
            $criteria->addSelectColumn($alias . '.announcement_id');
            $criteria->addSelectColumn($alias . '.announcement_message');
            $criteria->addSelectColumn($alias . '.announcement_title');
            $criteria->addSelectColumn($alias . '.announcement_stdate');
            $criteria->addSelectColumn($alias . '.announcement_edate');
            $criteria->addSelectColumn($alias . '.branches');
            $criteria->addSelectColumn($alias . '.designations');
            $criteria->addSelectColumn($alias . '.org_units');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.announcement_status');
            $criteria->addSelectColumn($alias . '.announcements_url');
            $criteria->addSelectColumn($alias . '.is_employee_mapped');
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
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_MESSAGE);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_TITLE);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_STDATE);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_EDATE);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_BRANCHES);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_DESIGNATIONS);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ORG_UNITS);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENT_STATUS);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_ANNOUNCEMENTS_URL);
            $criteria->removeSelectColumn(AnnouncementsTableMap::COL_IS_EMPLOYEE_MAPPED);
        } else {
            $criteria->removeSelectColumn($alias . '.announcement_id');
            $criteria->removeSelectColumn($alias . '.announcement_message');
            $criteria->removeSelectColumn($alias . '.announcement_title');
            $criteria->removeSelectColumn($alias . '.announcement_stdate');
            $criteria->removeSelectColumn($alias . '.announcement_edate');
            $criteria->removeSelectColumn($alias . '.branches');
            $criteria->removeSelectColumn($alias . '.designations');
            $criteria->removeSelectColumn($alias . '.org_units');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.announcement_status');
            $criteria->removeSelectColumn($alias . '.announcements_url');
            $criteria->removeSelectColumn($alias . '.is_employee_mapped');
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
        return Propel::getServiceContainer()->getDatabaseMap(AnnouncementsTableMap::DATABASE_NAME)->getTable(AnnouncementsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Announcements or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Announcements object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Announcements) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AnnouncementsTableMap::DATABASE_NAME);
            $criteria->add(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID, (array) $values, Criteria::IN);
        }

        $query = AnnouncementsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AnnouncementsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AnnouncementsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the announcements table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AnnouncementsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Announcements or Criteria object.
     *
     * @param mixed $criteria Criteria or Announcements object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnnouncementsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Announcements object
        }

        if ($criteria->containsKey(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID) && $criteria->keyContainsValue(AnnouncementsTableMap::COL_ANNOUNCEMENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AnnouncementsTableMap::COL_ANNOUNCEMENT_ID.')');
        }


        // Set the correct dbName
        $query = AnnouncementsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

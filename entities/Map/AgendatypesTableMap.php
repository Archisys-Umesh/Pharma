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
use entities\Agendatypes;
use entities\AgendatypesQuery;


/**
 * This class defines the structure of the 'agendatypes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AgendatypesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.AgendatypesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'agendatypes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Agendatypes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Agendatypes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Agendatypes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the agendaid field
     */
    public const COL_AGENDAID = 'agendatypes.agendaid';

    /**
     * the column name for the agendname field
     */
    public const COL_AGENDNAME = 'agendatypes.agendname';

    /**
     * the column name for the agendaimage field
     */
    public const COL_AGENDAIMAGE = 'agendatypes.agendaimage';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'agendatypes.agendacontroltype';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'agendatypes.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'agendatypes.orgunitid';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'agendatypes.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'agendatypes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'agendatypes.updated_at';

    /**
     * the column name for the is_private field
     */
    public const COL_IS_PRIVATE = 'agendatypes.is_private';

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
        self::TYPE_PHPNAME       => ['Agendaid', 'Agendname', 'Agendaimage', 'Agendacontroltype', 'CompanyId', 'Orgunitid', 'Status', 'CreatedAt', 'UpdatedAt', 'IsPrivate', ],
        self::TYPE_CAMELNAME     => ['agendaid', 'agendname', 'agendaimage', 'agendacontroltype', 'companyId', 'orgunitid', 'status', 'createdAt', 'updatedAt', 'isPrivate', ],
        self::TYPE_COLNAME       => [AgendatypesTableMap::COL_AGENDAID, AgendatypesTableMap::COL_AGENDNAME, AgendatypesTableMap::COL_AGENDAIMAGE, AgendatypesTableMap::COL_AGENDACONTROLTYPE, AgendatypesTableMap::COL_COMPANY_ID, AgendatypesTableMap::COL_ORGUNITID, AgendatypesTableMap::COL_STATUS, AgendatypesTableMap::COL_CREATED_AT, AgendatypesTableMap::COL_UPDATED_AT, AgendatypesTableMap::COL_IS_PRIVATE, ],
        self::TYPE_FIELDNAME     => ['agendaid', 'agendname', 'agendaimage', 'agendacontroltype', 'company_id', 'orgunitid', 'status', 'created_at', 'updated_at', 'is_private', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Agendaid' => 0, 'Agendname' => 1, 'Agendaimage' => 2, 'Agendacontroltype' => 3, 'CompanyId' => 4, 'Orgunitid' => 5, 'Status' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'IsPrivate' => 9, ],
        self::TYPE_CAMELNAME     => ['agendaid' => 0, 'agendname' => 1, 'agendaimage' => 2, 'agendacontroltype' => 3, 'companyId' => 4, 'orgunitid' => 5, 'status' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'isPrivate' => 9, ],
        self::TYPE_COLNAME       => [AgendatypesTableMap::COL_AGENDAID => 0, AgendatypesTableMap::COL_AGENDNAME => 1, AgendatypesTableMap::COL_AGENDAIMAGE => 2, AgendatypesTableMap::COL_AGENDACONTROLTYPE => 3, AgendatypesTableMap::COL_COMPANY_ID => 4, AgendatypesTableMap::COL_ORGUNITID => 5, AgendatypesTableMap::COL_STATUS => 6, AgendatypesTableMap::COL_CREATED_AT => 7, AgendatypesTableMap::COL_UPDATED_AT => 8, AgendatypesTableMap::COL_IS_PRIVATE => 9, ],
        self::TYPE_FIELDNAME     => ['agendaid' => 0, 'agendname' => 1, 'agendaimage' => 2, 'agendacontroltype' => 3, 'company_id' => 4, 'orgunitid' => 5, 'status' => 6, 'created_at' => 7, 'updated_at' => 8, 'is_private' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Agendaid' => 'AGENDAID',
        'Agendatypes.Agendaid' => 'AGENDAID',
        'agendaid' => 'AGENDAID',
        'agendatypes.agendaid' => 'AGENDAID',
        'AgendatypesTableMap::COL_AGENDAID' => 'AGENDAID',
        'COL_AGENDAID' => 'AGENDAID',
        'Agendname' => 'AGENDNAME',
        'Agendatypes.Agendname' => 'AGENDNAME',
        'agendname' => 'AGENDNAME',
        'agendatypes.agendname' => 'AGENDNAME',
        'AgendatypesTableMap::COL_AGENDNAME' => 'AGENDNAME',
        'COL_AGENDNAME' => 'AGENDNAME',
        'Agendaimage' => 'AGENDAIMAGE',
        'Agendatypes.Agendaimage' => 'AGENDAIMAGE',
        'agendaimage' => 'AGENDAIMAGE',
        'agendatypes.agendaimage' => 'AGENDAIMAGE',
        'AgendatypesTableMap::COL_AGENDAIMAGE' => 'AGENDAIMAGE',
        'COL_AGENDAIMAGE' => 'AGENDAIMAGE',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'Agendatypes.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendatypes.agendacontroltype' => 'AGENDACONTROLTYPE',
        'AgendatypesTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'CompanyId' => 'COMPANY_ID',
        'Agendatypes.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'agendatypes.companyId' => 'COMPANY_ID',
        'AgendatypesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'agendatypes.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'Agendatypes.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'agendatypes.orgunitid' => 'ORGUNITID',
        'AgendatypesTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'Status' => 'STATUS',
        'Agendatypes.Status' => 'STATUS',
        'status' => 'STATUS',
        'agendatypes.status' => 'STATUS',
        'AgendatypesTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'Agendatypes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'agendatypes.createdAt' => 'CREATED_AT',
        'AgendatypesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'agendatypes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Agendatypes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'agendatypes.updatedAt' => 'UPDATED_AT',
        'AgendatypesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'agendatypes.updated_at' => 'UPDATED_AT',
        'IsPrivate' => 'IS_PRIVATE',
        'Agendatypes.IsPrivate' => 'IS_PRIVATE',
        'isPrivate' => 'IS_PRIVATE',
        'agendatypes.isPrivate' => 'IS_PRIVATE',
        'AgendatypesTableMap::COL_IS_PRIVATE' => 'IS_PRIVATE',
        'COL_IS_PRIVATE' => 'IS_PRIVATE',
        'is_private' => 'IS_PRIVATE',
        'agendatypes.is_private' => 'IS_PRIVATE',
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
        $this->setName('agendatypes');
        $this->setPhpName('Agendatypes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Agendatypes');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('agendatypes_agendaid_seq');
        // columns
        $this->addPrimaryKey('agendaid', 'Agendaid', 'INTEGER', true, null, null);
        $this->addColumn('agendname', 'Agendname', 'VARCHAR', false, 250, null);
        $this->addForeignKey('agendaimage', 'Agendaimage', 'INTEGER', 'media_files', 'media_id', false, null, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, 50, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('is_private', 'IsPrivate', 'BOOLEAN', false, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agendaimage',
    1 => ':media_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':agenda_sub_type_id',
    1 => ':agendaid',
  ),
), null, null, 'BrandCampiagnVisitPlans', false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, 'Dailycallss', false);
        $this->addRelation('Dayplan', '\\entities\\Dayplan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, 'Dayplans', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':agenda_id',
    1 => ':agendaid',
  ),
), null, null, 'Tourplanss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Agendaid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AgendatypesTableMap::CLASS_DEFAULT : AgendatypesTableMap::OM_CLASS;
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
     * @return array (Agendatypes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AgendatypesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AgendatypesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AgendatypesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AgendatypesTableMap::OM_CLASS;
            /** @var Agendatypes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AgendatypesTableMap::addInstanceToPool($obj, $key);
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
            $key = AgendatypesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AgendatypesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Agendatypes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AgendatypesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AgendatypesTableMap::COL_AGENDAID);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_AGENDNAME);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_AGENDAIMAGE);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_STATUS);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(AgendatypesTableMap::COL_IS_PRIVATE);
        } else {
            $criteria->addSelectColumn($alias . '.agendaid');
            $criteria->addSelectColumn($alias . '.agendname');
            $criteria->addSelectColumn($alias . '.agendaimage');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.is_private');
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
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_AGENDAID);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_AGENDNAME);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_AGENDAIMAGE);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_STATUS);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(AgendatypesTableMap::COL_IS_PRIVATE);
        } else {
            $criteria->removeSelectColumn($alias . '.agendaid');
            $criteria->removeSelectColumn($alias . '.agendname');
            $criteria->removeSelectColumn($alias . '.agendaimage');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.is_private');
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
        return Propel::getServiceContainer()->getDatabaseMap(AgendatypesTableMap::DATABASE_NAME)->getTable(AgendatypesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Agendatypes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Agendatypes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Agendatypes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AgendatypesTableMap::DATABASE_NAME);
            $criteria->add(AgendatypesTableMap::COL_AGENDAID, (array) $values, Criteria::IN);
        }

        $query = AgendatypesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AgendatypesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AgendatypesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the agendatypes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AgendatypesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Agendatypes or Criteria object.
     *
     * @param mixed $criteria Criteria or Agendatypes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AgendatypesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Agendatypes object
        }

        if ($criteria->containsKey(AgendatypesTableMap::COL_AGENDAID) && $criteria->keyContainsValue(AgendatypesTableMap::COL_AGENDAID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AgendatypesTableMap::COL_AGENDAID.')');
        }


        // Set the correct dbName
        $query = AgendatypesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

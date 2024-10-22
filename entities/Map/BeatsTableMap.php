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
use entities\Beats;
use entities\BeatsQuery;


/**
 * This class defines the structure of the 'beats' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BeatsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BeatsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'beats';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Beats';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Beats';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Beats';

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
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'beats.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'beats.beat_name';

    /**
     * the column name for the beat_remark field
     */
    public const COL_BEAT_REMARK = 'beats.beat_remark';

    /**
     * the column name for the beat_code field
     */
    public const COL_BEAT_CODE = 'beats.beat_code';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'beats.territory_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'beats.company_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'beats.itownid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'beats.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'beats.updated_at';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'beats.org_unit_id';

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
        self::TYPE_PHPNAME       => ['BeatId', 'BeatName', 'BeatRemark', 'BeatCode', 'TerritoryId', 'CompanyId', 'Itownid', 'CreatedAt', 'UpdatedAt', 'OrgUnitId', ],
        self::TYPE_CAMELNAME     => ['beatId', 'beatName', 'beatRemark', 'beatCode', 'territoryId', 'companyId', 'itownid', 'createdAt', 'updatedAt', 'orgUnitId', ],
        self::TYPE_COLNAME       => [BeatsTableMap::COL_BEAT_ID, BeatsTableMap::COL_BEAT_NAME, BeatsTableMap::COL_BEAT_REMARK, BeatsTableMap::COL_BEAT_CODE, BeatsTableMap::COL_TERRITORY_ID, BeatsTableMap::COL_COMPANY_ID, BeatsTableMap::COL_ITOWNID, BeatsTableMap::COL_CREATED_AT, BeatsTableMap::COL_UPDATED_AT, BeatsTableMap::COL_ORG_UNIT_ID, ],
        self::TYPE_FIELDNAME     => ['beat_id', 'beat_name', 'beat_remark', 'beat_code', 'territory_id', 'company_id', 'itownid', 'created_at', 'updated_at', 'org_unit_id', ],
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
        self::TYPE_PHPNAME       => ['BeatId' => 0, 'BeatName' => 1, 'BeatRemark' => 2, 'BeatCode' => 3, 'TerritoryId' => 4, 'CompanyId' => 5, 'Itownid' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'OrgUnitId' => 9, ],
        self::TYPE_CAMELNAME     => ['beatId' => 0, 'beatName' => 1, 'beatRemark' => 2, 'beatCode' => 3, 'territoryId' => 4, 'companyId' => 5, 'itownid' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'orgUnitId' => 9, ],
        self::TYPE_COLNAME       => [BeatsTableMap::COL_BEAT_ID => 0, BeatsTableMap::COL_BEAT_NAME => 1, BeatsTableMap::COL_BEAT_REMARK => 2, BeatsTableMap::COL_BEAT_CODE => 3, BeatsTableMap::COL_TERRITORY_ID => 4, BeatsTableMap::COL_COMPANY_ID => 5, BeatsTableMap::COL_ITOWNID => 6, BeatsTableMap::COL_CREATED_AT => 7, BeatsTableMap::COL_UPDATED_AT => 8, BeatsTableMap::COL_ORG_UNIT_ID => 9, ],
        self::TYPE_FIELDNAME     => ['beat_id' => 0, 'beat_name' => 1, 'beat_remark' => 2, 'beat_code' => 3, 'territory_id' => 4, 'company_id' => 5, 'itownid' => 6, 'created_at' => 7, 'updated_at' => 8, 'org_unit_id' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BeatId' => 'BEAT_ID',
        'Beats.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'beats.beatId' => 'BEAT_ID',
        'BeatsTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'beats.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'Beats.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'beats.beatName' => 'BEAT_NAME',
        'BeatsTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'beats.beat_name' => 'BEAT_NAME',
        'BeatRemark' => 'BEAT_REMARK',
        'Beats.BeatRemark' => 'BEAT_REMARK',
        'beatRemark' => 'BEAT_REMARK',
        'beats.beatRemark' => 'BEAT_REMARK',
        'BeatsTableMap::COL_BEAT_REMARK' => 'BEAT_REMARK',
        'COL_BEAT_REMARK' => 'BEAT_REMARK',
        'beat_remark' => 'BEAT_REMARK',
        'beats.beat_remark' => 'BEAT_REMARK',
        'BeatCode' => 'BEAT_CODE',
        'Beats.BeatCode' => 'BEAT_CODE',
        'beatCode' => 'BEAT_CODE',
        'beats.beatCode' => 'BEAT_CODE',
        'BeatsTableMap::COL_BEAT_CODE' => 'BEAT_CODE',
        'COL_BEAT_CODE' => 'BEAT_CODE',
        'beat_code' => 'BEAT_CODE',
        'beats.beat_code' => 'BEAT_CODE',
        'TerritoryId' => 'TERRITORY_ID',
        'Beats.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'beats.territoryId' => 'TERRITORY_ID',
        'BeatsTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'beats.territory_id' => 'TERRITORY_ID',
        'CompanyId' => 'COMPANY_ID',
        'Beats.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'beats.companyId' => 'COMPANY_ID',
        'BeatsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'beats.company_id' => 'COMPANY_ID',
        'Itownid' => 'ITOWNID',
        'Beats.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'beats.itownid' => 'ITOWNID',
        'BeatsTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'CreatedAt' => 'CREATED_AT',
        'Beats.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'beats.createdAt' => 'CREATED_AT',
        'BeatsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'beats.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Beats.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'beats.updatedAt' => 'UPDATED_AT',
        'BeatsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'beats.updated_at' => 'UPDATED_AT',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'Beats.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'beats.orgUnitId' => 'ORG_UNIT_ID',
        'BeatsTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'beats.org_unit_id' => 'ORG_UNIT_ID',
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
        $this->setName('beats');
        $this->setPhpName('Beats');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Beats');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('beats_beat_id_seq');
        // columns
        $this->addPrimaryKey('beat_id', 'BeatId', 'INTEGER', true, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', true, 100, null);
        $this->addColumn('beat_remark', 'BeatRemark', 'VARCHAR', true, 100, null);
        $this->addColumn('beat_code', 'BeatCode', 'VARCHAR', true, 100, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('itownid', 'Itownid', 'BIGINT', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
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
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('BeatOutlets', '\\entities\\BeatOutlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), 'CASCADE', null, 'BeatOutletss', false);
        $this->addRelation('Dayplan', '\\entities\\Dayplan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, 'Dayplans', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, 'Tourplanss', false);
        $this->addRelation('StpWeek', '\\entities\\StpWeek', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, 'StpWeeks', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to beats     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BeatOutletsTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BeatsTableMap::CLASS_DEFAULT : BeatsTableMap::OM_CLASS;
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
     * @return array (Beats object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BeatsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BeatsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BeatsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BeatsTableMap::OM_CLASS;
            /** @var Beats $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BeatsTableMap::addInstanceToPool($obj, $key);
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
            $key = BeatsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BeatsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Beats $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BeatsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BeatsTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(BeatsTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(BeatsTableMap::COL_BEAT_REMARK);
            $criteria->addSelectColumn(BeatsTableMap::COL_BEAT_CODE);
            $criteria->addSelectColumn(BeatsTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(BeatsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BeatsTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(BeatsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BeatsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BeatsTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.beat_remark');
            $criteria->addSelectColumn($alias . '.beat_code');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.org_unit_id');
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
            $criteria->removeSelectColumn(BeatsTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(BeatsTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(BeatsTableMap::COL_BEAT_REMARK);
            $criteria->removeSelectColumn(BeatsTableMap::COL_BEAT_CODE);
            $criteria->removeSelectColumn(BeatsTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(BeatsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BeatsTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(BeatsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BeatsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BeatsTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.beat_remark');
            $criteria->removeSelectColumn($alias . '.beat_code');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BeatsTableMap::DATABASE_NAME)->getTable(BeatsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Beats or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Beats object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Beats) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BeatsTableMap::DATABASE_NAME);
            $criteria->add(BeatsTableMap::COL_BEAT_ID, (array) $values, Criteria::IN);
        }

        $query = BeatsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BeatsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BeatsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the beats table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BeatsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Beats or Criteria object.
     *
     * @param mixed $criteria Criteria or Beats object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Beats object
        }

        if ($criteria->containsKey(BeatsTableMap::COL_BEAT_ID) && $criteria->keyContainsValue(BeatsTableMap::COL_BEAT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BeatsTableMap::COL_BEAT_ID.')');
        }


        // Set the correct dbName
        $query = BeatsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

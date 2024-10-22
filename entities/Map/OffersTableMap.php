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
use entities\Offers;
use entities\OffersQuery;


/**
 * This class defines the structure of the 'offers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OffersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OffersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'offers';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Offers';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Offers';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Offers';

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
    public const COL_ID = 'offers.id';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'offers.title';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'offers.description';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'offers.media_id';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'offers.outlet_type_id';

    /**
     * the column name for the territory_ids field
     */
    public const COL_TERRITORY_IDS = 'offers.territory_ids';

    /**
     * the column name for the start_date field
     */
    public const COL_START_DATE = 'offers.start_date';

    /**
     * the column name for the end_date field
     */
    public const COL_END_DATE = 'offers.end_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'offers.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'offers.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'offers.company_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'offers.org_unit_id';

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
        self::TYPE_PHPNAME       => ['Id', 'Title', 'Description', 'MediaId', 'OutletTypeId', 'TerritoryIds', 'StartDate', 'EndDate', 'CreatedAt', 'UpdatedAt', 'CompanyId', 'OrgUnitId', ],
        self::TYPE_CAMELNAME     => ['id', 'title', 'description', 'mediaId', 'outletTypeId', 'territoryIds', 'startDate', 'endDate', 'createdAt', 'updatedAt', 'companyId', 'orgUnitId', ],
        self::TYPE_COLNAME       => [OffersTableMap::COL_ID, OffersTableMap::COL_TITLE, OffersTableMap::COL_DESCRIPTION, OffersTableMap::COL_MEDIA_ID, OffersTableMap::COL_OUTLET_TYPE_ID, OffersTableMap::COL_TERRITORY_IDS, OffersTableMap::COL_START_DATE, OffersTableMap::COL_END_DATE, OffersTableMap::COL_CREATED_AT, OffersTableMap::COL_UPDATED_AT, OffersTableMap::COL_COMPANY_ID, OffersTableMap::COL_ORG_UNIT_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'title', 'description', 'media_id', 'outlet_type_id', 'territory_ids', 'start_date', 'end_date', 'created_at', 'updated_at', 'company_id', 'org_unit_id', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Title' => 1, 'Description' => 2, 'MediaId' => 3, 'OutletTypeId' => 4, 'TerritoryIds' => 5, 'StartDate' => 6, 'EndDate' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'CompanyId' => 10, 'OrgUnitId' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'title' => 1, 'description' => 2, 'mediaId' => 3, 'outletTypeId' => 4, 'territoryIds' => 5, 'startDate' => 6, 'endDate' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'companyId' => 10, 'orgUnitId' => 11, ],
        self::TYPE_COLNAME       => [OffersTableMap::COL_ID => 0, OffersTableMap::COL_TITLE => 1, OffersTableMap::COL_DESCRIPTION => 2, OffersTableMap::COL_MEDIA_ID => 3, OffersTableMap::COL_OUTLET_TYPE_ID => 4, OffersTableMap::COL_TERRITORY_IDS => 5, OffersTableMap::COL_START_DATE => 6, OffersTableMap::COL_END_DATE => 7, OffersTableMap::COL_CREATED_AT => 8, OffersTableMap::COL_UPDATED_AT => 9, OffersTableMap::COL_COMPANY_ID => 10, OffersTableMap::COL_ORG_UNIT_ID => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'title' => 1, 'description' => 2, 'media_id' => 3, 'outlet_type_id' => 4, 'territory_ids' => 5, 'start_date' => 6, 'end_date' => 7, 'created_at' => 8, 'updated_at' => 9, 'company_id' => 10, 'org_unit_id' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Offers.Id' => 'ID',
        'id' => 'ID',
        'offers.id' => 'ID',
        'OffersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Title' => 'TITLE',
        'Offers.Title' => 'TITLE',
        'title' => 'TITLE',
        'offers.title' => 'TITLE',
        'OffersTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'Description' => 'DESCRIPTION',
        'Offers.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'offers.description' => 'DESCRIPTION',
        'OffersTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'MediaId' => 'MEDIA_ID',
        'Offers.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'offers.mediaId' => 'MEDIA_ID',
        'OffersTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'offers.media_id' => 'MEDIA_ID',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'Offers.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'offers.outletTypeId' => 'OUTLET_TYPE_ID',
        'OffersTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'offers.outlet_type_id' => 'OUTLET_TYPE_ID',
        'TerritoryIds' => 'TERRITORY_IDS',
        'Offers.TerritoryIds' => 'TERRITORY_IDS',
        'territoryIds' => 'TERRITORY_IDS',
        'offers.territoryIds' => 'TERRITORY_IDS',
        'OffersTableMap::COL_TERRITORY_IDS' => 'TERRITORY_IDS',
        'COL_TERRITORY_IDS' => 'TERRITORY_IDS',
        'territory_ids' => 'TERRITORY_IDS',
        'offers.territory_ids' => 'TERRITORY_IDS',
        'StartDate' => 'START_DATE',
        'Offers.StartDate' => 'START_DATE',
        'startDate' => 'START_DATE',
        'offers.startDate' => 'START_DATE',
        'OffersTableMap::COL_START_DATE' => 'START_DATE',
        'COL_START_DATE' => 'START_DATE',
        'start_date' => 'START_DATE',
        'offers.start_date' => 'START_DATE',
        'EndDate' => 'END_DATE',
        'Offers.EndDate' => 'END_DATE',
        'endDate' => 'END_DATE',
        'offers.endDate' => 'END_DATE',
        'OffersTableMap::COL_END_DATE' => 'END_DATE',
        'COL_END_DATE' => 'END_DATE',
        'end_date' => 'END_DATE',
        'offers.end_date' => 'END_DATE',
        'CreatedAt' => 'CREATED_AT',
        'Offers.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'offers.createdAt' => 'CREATED_AT',
        'OffersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'offers.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Offers.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'offers.updatedAt' => 'UPDATED_AT',
        'OffersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'offers.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'Offers.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'offers.companyId' => 'COMPANY_ID',
        'OffersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'offers.company_id' => 'COMPANY_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'Offers.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'offers.orgUnitId' => 'ORG_UNIT_ID',
        'OffersTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'offers.org_unit_id' => 'ORG_UNIT_ID',
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
        $this->setName('offers');
        $this->setPhpName('Offers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Offers');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('offers_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 50, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('media_id', 'MediaId', 'INTEGER', 'media_files', 'media_id', false, null, null);
        $this->addForeignKey('outlet_type_id', 'OutletTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('territory_ids', 'TerritoryIds', 'VARCHAR', false, 50, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
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
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), null, null, null, false);
        $this->addRelation('Gifts', '\\entities\\Gifts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':offersid',
    1 => ':id',
  ),
), null, null, 'Giftss', false);
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
        return $withPrefix ? OffersTableMap::CLASS_DEFAULT : OffersTableMap::OM_CLASS;
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
     * @return array (Offers object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OffersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OffersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OffersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OffersTableMap::OM_CLASS;
            /** @var Offers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OffersTableMap::addInstanceToPool($obj, $key);
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
            $key = OffersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OffersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Offers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OffersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OffersTableMap::COL_ID);
            $criteria->addSelectColumn(OffersTableMap::COL_TITLE);
            $criteria->addSelectColumn(OffersTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OffersTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(OffersTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(OffersTableMap::COL_TERRITORY_IDS);
            $criteria->addSelectColumn(OffersTableMap::COL_START_DATE);
            $criteria->addSelectColumn(OffersTableMap::COL_END_DATE);
            $criteria->addSelectColumn(OffersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OffersTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OffersTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OffersTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.territory_ids');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(OffersTableMap::COL_ID);
            $criteria->removeSelectColumn(OffersTableMap::COL_TITLE);
            $criteria->removeSelectColumn(OffersTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(OffersTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(OffersTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(OffersTableMap::COL_TERRITORY_IDS);
            $criteria->removeSelectColumn(OffersTableMap::COL_START_DATE);
            $criteria->removeSelectColumn(OffersTableMap::COL_END_DATE);
            $criteria->removeSelectColumn(OffersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OffersTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OffersTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OffersTableMap::COL_ORG_UNIT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.territory_ids');
            $criteria->removeSelectColumn($alias . '.start_date');
            $criteria->removeSelectColumn($alias . '.end_date');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OffersTableMap::DATABASE_NAME)->getTable(OffersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Offers or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Offers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OffersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Offers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OffersTableMap::DATABASE_NAME);
            $criteria->add(OffersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OffersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OffersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OffersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the offers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OffersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Offers or Criteria object.
     *
     * @param mixed $criteria Criteria or Offers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OffersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Offers object
        }

        if ($criteria->containsKey(OffersTableMap::COL_ID) && $criteria->keyContainsValue(OffersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OffersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OffersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

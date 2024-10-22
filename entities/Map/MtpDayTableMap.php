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
use entities\MtpDay;
use entities\MtpDayQuery;


/**
 * This class defines the structure of the 'mtp_day' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MtpDayTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MtpDayTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'mtp_day';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MtpDay';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MtpDay';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MtpDay';

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
     * the column name for the mtp_day_id field
     */
    public const COL_MTP_DAY_ID = 'mtp_day.mtp_day_id';

    /**
     * the column name for the mtp_day_date field
     */
    public const COL_MTP_DAY_DATE = 'mtp_day.mtp_day_date';

    /**
     * the column name for the weekday field
     */
    public const COL_WEEKDAY = 'mtp_day.weekday';

    /**
     * the column name for the weeknumber field
     */
    public const COL_WEEKNUMBER = 'mtp_day.weeknumber';

    /**
     * the column name for the mtp_id field
     */
    public const COL_MTP_ID = 'mtp_day.mtp_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'mtp_day.company_id';

    /**
     * the column name for the mtpday_remark field
     */
    public const COL_MTPDAY_REMARK = 'mtp_day.mtpday_remark';

    /**
     * the column name for the ishalfday field
     */
    public const COL_ISHALFDAY = 'mtp_day.ishalfday';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'mtp_day.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'mtp_day.updated_at';

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
        self::TYPE_PHPNAME       => ['MtpDayId', 'MtpDayDate', 'Weekday', 'Weeknumber', 'MtpId', 'CompanyId', 'MtpdayRemark', 'Ishalfday', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['mtpDayId', 'mtpDayDate', 'weekday', 'weeknumber', 'mtpId', 'companyId', 'mtpdayRemark', 'ishalfday', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [MtpDayTableMap::COL_MTP_DAY_ID, MtpDayTableMap::COL_MTP_DAY_DATE, MtpDayTableMap::COL_WEEKDAY, MtpDayTableMap::COL_WEEKNUMBER, MtpDayTableMap::COL_MTP_ID, MtpDayTableMap::COL_COMPANY_ID, MtpDayTableMap::COL_MTPDAY_REMARK, MtpDayTableMap::COL_ISHALFDAY, MtpDayTableMap::COL_CREATED_AT, MtpDayTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['mtp_day_id', 'mtp_day_date', 'weekday', 'weeknumber', 'mtp_id', 'company_id', 'mtpday_remark', 'ishalfday', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['MtpDayId' => 0, 'MtpDayDate' => 1, 'Weekday' => 2, 'Weeknumber' => 3, 'MtpId' => 4, 'CompanyId' => 5, 'MtpdayRemark' => 6, 'Ishalfday' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['mtpDayId' => 0, 'mtpDayDate' => 1, 'weekday' => 2, 'weeknumber' => 3, 'mtpId' => 4, 'companyId' => 5, 'mtpdayRemark' => 6, 'ishalfday' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [MtpDayTableMap::COL_MTP_DAY_ID => 0, MtpDayTableMap::COL_MTP_DAY_DATE => 1, MtpDayTableMap::COL_WEEKDAY => 2, MtpDayTableMap::COL_WEEKNUMBER => 3, MtpDayTableMap::COL_MTP_ID => 4, MtpDayTableMap::COL_COMPANY_ID => 5, MtpDayTableMap::COL_MTPDAY_REMARK => 6, MtpDayTableMap::COL_ISHALFDAY => 7, MtpDayTableMap::COL_CREATED_AT => 8, MtpDayTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['mtp_day_id' => 0, 'mtp_day_date' => 1, 'weekday' => 2, 'weeknumber' => 3, 'mtp_id' => 4, 'company_id' => 5, 'mtpday_remark' => 6, 'ishalfday' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MtpDayId' => 'MTP_DAY_ID',
        'MtpDay.MtpDayId' => 'MTP_DAY_ID',
        'mtpDayId' => 'MTP_DAY_ID',
        'mtpDay.mtpDayId' => 'MTP_DAY_ID',
        'MtpDayTableMap::COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'COL_MTP_DAY_ID' => 'MTP_DAY_ID',
        'mtp_day_id' => 'MTP_DAY_ID',
        'mtp_day.mtp_day_id' => 'MTP_DAY_ID',
        'MtpDayDate' => 'MTP_DAY_DATE',
        'MtpDay.MtpDayDate' => 'MTP_DAY_DATE',
        'mtpDayDate' => 'MTP_DAY_DATE',
        'mtpDay.mtpDayDate' => 'MTP_DAY_DATE',
        'MtpDayTableMap::COL_MTP_DAY_DATE' => 'MTP_DAY_DATE',
        'COL_MTP_DAY_DATE' => 'MTP_DAY_DATE',
        'mtp_day_date' => 'MTP_DAY_DATE',
        'mtp_day.mtp_day_date' => 'MTP_DAY_DATE',
        'Weekday' => 'WEEKDAY',
        'MtpDay.Weekday' => 'WEEKDAY',
        'weekday' => 'WEEKDAY',
        'mtpDay.weekday' => 'WEEKDAY',
        'MtpDayTableMap::COL_WEEKDAY' => 'WEEKDAY',
        'COL_WEEKDAY' => 'WEEKDAY',
        'mtp_day.weekday' => 'WEEKDAY',
        'Weeknumber' => 'WEEKNUMBER',
        'MtpDay.Weeknumber' => 'WEEKNUMBER',
        'weeknumber' => 'WEEKNUMBER',
        'mtpDay.weeknumber' => 'WEEKNUMBER',
        'MtpDayTableMap::COL_WEEKNUMBER' => 'WEEKNUMBER',
        'COL_WEEKNUMBER' => 'WEEKNUMBER',
        'mtp_day.weeknumber' => 'WEEKNUMBER',
        'MtpId' => 'MTP_ID',
        'MtpDay.MtpId' => 'MTP_ID',
        'mtpId' => 'MTP_ID',
        'mtpDay.mtpId' => 'MTP_ID',
        'MtpDayTableMap::COL_MTP_ID' => 'MTP_ID',
        'COL_MTP_ID' => 'MTP_ID',
        'mtp_id' => 'MTP_ID',
        'mtp_day.mtp_id' => 'MTP_ID',
        'CompanyId' => 'COMPANY_ID',
        'MtpDay.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mtpDay.companyId' => 'COMPANY_ID',
        'MtpDayTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'mtp_day.company_id' => 'COMPANY_ID',
        'MtpdayRemark' => 'MTPDAY_REMARK',
        'MtpDay.MtpdayRemark' => 'MTPDAY_REMARK',
        'mtpdayRemark' => 'MTPDAY_REMARK',
        'mtpDay.mtpdayRemark' => 'MTPDAY_REMARK',
        'MtpDayTableMap::COL_MTPDAY_REMARK' => 'MTPDAY_REMARK',
        'COL_MTPDAY_REMARK' => 'MTPDAY_REMARK',
        'mtpday_remark' => 'MTPDAY_REMARK',
        'mtp_day.mtpday_remark' => 'MTPDAY_REMARK',
        'Ishalfday' => 'ISHALFDAY',
        'MtpDay.Ishalfday' => 'ISHALFDAY',
        'ishalfday' => 'ISHALFDAY',
        'mtpDay.ishalfday' => 'ISHALFDAY',
        'MtpDayTableMap::COL_ISHALFDAY' => 'ISHALFDAY',
        'COL_ISHALFDAY' => 'ISHALFDAY',
        'mtp_day.ishalfday' => 'ISHALFDAY',
        'CreatedAt' => 'CREATED_AT',
        'MtpDay.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'mtpDay.createdAt' => 'CREATED_AT',
        'MtpDayTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'mtp_day.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'MtpDay.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'mtpDay.updatedAt' => 'UPDATED_AT',
        'MtpDayTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'mtp_day.updated_at' => 'UPDATED_AT',
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
        $this->setName('mtp_day');
        $this->setPhpName('MtpDay');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MtpDay');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('mtp_day_mtp_day_id_seq');
        // columns
        $this->addPrimaryKey('mtp_day_id', 'MtpDayId', 'INTEGER', true, null, null);
        $this->addColumn('mtp_day_date', 'MtpDayDate', 'VARCHAR', false, null, null);
        $this->addColumn('weekday', 'Weekday', 'INTEGER', false, null, null);
        $this->addColumn('weeknumber', 'Weeknumber', 'INTEGER', false, null, null);
        $this->addForeignKey('mtp_id', 'MtpId', 'INTEGER', 'mtp', 'mtp_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('mtpday_remark', 'MtpdayRemark', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ishalfday', 'Ishalfday', 'BOOLEAN', false, 1, null);
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
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
  ),
), null, null, null, false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':mtp_day_id',
    1 => ':mtp_day_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MtpDayTableMap::CLASS_DEFAULT : MtpDayTableMap::OM_CLASS;
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
     * @return array (MtpDay object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MtpDayTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MtpDayTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MtpDayTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MtpDayTableMap::OM_CLASS;
            /** @var MtpDay $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MtpDayTableMap::addInstanceToPool($obj, $key);
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
            $key = MtpDayTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MtpDayTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MtpDay $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MtpDayTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MtpDayTableMap::COL_MTP_DAY_ID);
            $criteria->addSelectColumn(MtpDayTableMap::COL_MTP_DAY_DATE);
            $criteria->addSelectColumn(MtpDayTableMap::COL_WEEKDAY);
            $criteria->addSelectColumn(MtpDayTableMap::COL_WEEKNUMBER);
            $criteria->addSelectColumn(MtpDayTableMap::COL_MTP_ID);
            $criteria->addSelectColumn(MtpDayTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(MtpDayTableMap::COL_MTPDAY_REMARK);
            $criteria->addSelectColumn(MtpDayTableMap::COL_ISHALFDAY);
            $criteria->addSelectColumn(MtpDayTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MtpDayTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.mtp_day_id');
            $criteria->addSelectColumn($alias . '.mtp_day_date');
            $criteria->addSelectColumn($alias . '.weekday');
            $criteria->addSelectColumn($alias . '.weeknumber');
            $criteria->addSelectColumn($alias . '.mtp_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.mtpday_remark');
            $criteria->addSelectColumn($alias . '.ishalfday');
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
            $criteria->removeSelectColumn(MtpDayTableMap::COL_MTP_DAY_ID);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_MTP_DAY_DATE);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_WEEKDAY);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_WEEKNUMBER);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_MTP_ID);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_MTPDAY_REMARK);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_ISHALFDAY);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(MtpDayTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.mtp_day_id');
            $criteria->removeSelectColumn($alias . '.mtp_day_date');
            $criteria->removeSelectColumn($alias . '.weekday');
            $criteria->removeSelectColumn($alias . '.weeknumber');
            $criteria->removeSelectColumn($alias . '.mtp_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.mtpday_remark');
            $criteria->removeSelectColumn($alias . '.ishalfday');
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
        return Propel::getServiceContainer()->getDatabaseMap(MtpDayTableMap::DATABASE_NAME)->getTable(MtpDayTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MtpDay or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MtpDay object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDayTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MtpDay) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MtpDayTableMap::DATABASE_NAME);
            $criteria->add(MtpDayTableMap::COL_MTP_DAY_ID, (array) $values, Criteria::IN);
        }

        $query = MtpDayQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MtpDayTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MtpDayTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mtp_day table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MtpDayQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MtpDay or Criteria object.
     *
     * @param mixed $criteria Criteria or MtpDay object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpDayTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MtpDay object
        }

        if ($criteria->containsKey(MtpDayTableMap::COL_MTP_DAY_ID) && $criteria->keyContainsValue(MtpDayTableMap::COL_MTP_DAY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MtpDayTableMap::COL_MTP_DAY_ID.')');
        }


        // Set the correct dbName
        $query = MtpDayQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

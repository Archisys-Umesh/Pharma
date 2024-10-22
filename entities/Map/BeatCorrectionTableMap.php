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
use entities\BeatCorrection;
use entities\BeatCorrectionQuery;


/**
 * This class defines the structure of the 'beat_correction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BeatCorrectionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BeatCorrectionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'beat_correction';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BeatCorrection';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BeatCorrection';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BeatCorrection';

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
     * the column name for the on_board_request_address_id field
     */
    public const COL_ON_BOARD_REQUEST_ADDRESS_ID = 'beat_correction.on_board_request_address_id';

    /**
     * the column name for the territory field
     */
    public const COL_TERRITORY = 'beat_correction.territory';

    /**
     * the column name for the obra_unit_name field
     */
    public const COL_OBRA_UNIT_NAME = 'beat_correction.obra_unit_name';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'beat_correction.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'beat_correction.last_name';

    /**
     * the column name for the address field
     */
    public const COL_ADDRESS = 'beat_correction.address';

    /**
     * the column name for the beat_unit_name field
     */
    public const COL_BEAT_UNIT_NAME = 'beat_correction.beat_unit_name';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'beat_correction.beat_name';

    /**
     * the column name for the beat_options field
     */
    public const COL_BEAT_OPTIONS = 'beat_correction.beat_options';

    /**
     * the column name for the correct_beat_name field
     */
    public const COL_CORRECT_BEAT_NAME = 'beat_correction.correct_beat_name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'beat_correction.status';

    /**
     * the column name for the beat_org_unit_id field
     */
    public const COL_BEAT_ORG_UNIT_ID = 'beat_correction.beat_org_unit_id';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestAddressId', 'Territory', 'ObraUnitName', 'FirstName', 'LastName', 'Address', 'BeatUnitName', 'BeatName', 'BeatOptions', 'CorrectBeatName', 'Status', 'BeatOrgUnitId', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestAddressId', 'territory', 'obraUnitName', 'firstName', 'lastName', 'address', 'beatUnitName', 'beatName', 'beatOptions', 'correctBeatName', 'status', 'beatOrgUnitId', ],
        self::TYPE_COLNAME       => [BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, BeatCorrectionTableMap::COL_TERRITORY, BeatCorrectionTableMap::COL_OBRA_UNIT_NAME, BeatCorrectionTableMap::COL_FIRST_NAME, BeatCorrectionTableMap::COL_LAST_NAME, BeatCorrectionTableMap::COL_ADDRESS, BeatCorrectionTableMap::COL_BEAT_UNIT_NAME, BeatCorrectionTableMap::COL_BEAT_NAME, BeatCorrectionTableMap::COL_BEAT_OPTIONS, BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME, BeatCorrectionTableMap::COL_STATUS, BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID, ],
        self::TYPE_FIELDNAME     => ['on_board_request_address_id', 'territory', 'obra_unit_name', 'first_name', 'last_name', 'address', 'beat_unit_name', 'beat_name', 'beat_options', 'correct_beat_name', 'status', 'beat_org_unit_id', ],
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
        self::TYPE_PHPNAME       => ['OnBoardRequestAddressId' => 0, 'Territory' => 1, 'ObraUnitName' => 2, 'FirstName' => 3, 'LastName' => 4, 'Address' => 5, 'BeatUnitName' => 6, 'BeatName' => 7, 'BeatOptions' => 8, 'CorrectBeatName' => 9, 'Status' => 10, 'BeatOrgUnitId' => 11, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestAddressId' => 0, 'territory' => 1, 'obraUnitName' => 2, 'firstName' => 3, 'lastName' => 4, 'address' => 5, 'beatUnitName' => 6, 'beatName' => 7, 'beatOptions' => 8, 'correctBeatName' => 9, 'status' => 10, 'beatOrgUnitId' => 11, ],
        self::TYPE_COLNAME       => [BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID => 0, BeatCorrectionTableMap::COL_TERRITORY => 1, BeatCorrectionTableMap::COL_OBRA_UNIT_NAME => 2, BeatCorrectionTableMap::COL_FIRST_NAME => 3, BeatCorrectionTableMap::COL_LAST_NAME => 4, BeatCorrectionTableMap::COL_ADDRESS => 5, BeatCorrectionTableMap::COL_BEAT_UNIT_NAME => 6, BeatCorrectionTableMap::COL_BEAT_NAME => 7, BeatCorrectionTableMap::COL_BEAT_OPTIONS => 8, BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME => 9, BeatCorrectionTableMap::COL_STATUS => 10, BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID => 11, ],
        self::TYPE_FIELDNAME     => ['on_board_request_address_id' => 0, 'territory' => 1, 'obra_unit_name' => 2, 'first_name' => 3, 'last_name' => 4, 'address' => 5, 'beat_unit_name' => 6, 'beat_name' => 7, 'beat_options' => 8, 'correct_beat_name' => 9, 'status' => 10, 'beat_org_unit_id' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'BeatCorrection.OnBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'onBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'beatCorrection.onBoardRequestAddressId' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'COL_ON_BOARD_REQUEST_ADDRESS_ID' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'on_board_request_address_id' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'beat_correction.on_board_request_address_id' => 'ON_BOARD_REQUEST_ADDRESS_ID',
        'Territory' => 'TERRITORY',
        'BeatCorrection.Territory' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'beatCorrection.territory' => 'TERRITORY',
        'BeatCorrectionTableMap::COL_TERRITORY' => 'TERRITORY',
        'COL_TERRITORY' => 'TERRITORY',
        'beat_correction.territory' => 'TERRITORY',
        'ObraUnitName' => 'OBRA_UNIT_NAME',
        'BeatCorrection.ObraUnitName' => 'OBRA_UNIT_NAME',
        'obraUnitName' => 'OBRA_UNIT_NAME',
        'beatCorrection.obraUnitName' => 'OBRA_UNIT_NAME',
        'BeatCorrectionTableMap::COL_OBRA_UNIT_NAME' => 'OBRA_UNIT_NAME',
        'COL_OBRA_UNIT_NAME' => 'OBRA_UNIT_NAME',
        'obra_unit_name' => 'OBRA_UNIT_NAME',
        'beat_correction.obra_unit_name' => 'OBRA_UNIT_NAME',
        'FirstName' => 'FIRST_NAME',
        'BeatCorrection.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'beatCorrection.firstName' => 'FIRST_NAME',
        'BeatCorrectionTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'beat_correction.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'BeatCorrection.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'beatCorrection.lastName' => 'LAST_NAME',
        'BeatCorrectionTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'beat_correction.last_name' => 'LAST_NAME',
        'Address' => 'ADDRESS',
        'BeatCorrection.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'beatCorrection.address' => 'ADDRESS',
        'BeatCorrectionTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'beat_correction.address' => 'ADDRESS',
        'BeatUnitName' => 'BEAT_UNIT_NAME',
        'BeatCorrection.BeatUnitName' => 'BEAT_UNIT_NAME',
        'beatUnitName' => 'BEAT_UNIT_NAME',
        'beatCorrection.beatUnitName' => 'BEAT_UNIT_NAME',
        'BeatCorrectionTableMap::COL_BEAT_UNIT_NAME' => 'BEAT_UNIT_NAME',
        'COL_BEAT_UNIT_NAME' => 'BEAT_UNIT_NAME',
        'beat_unit_name' => 'BEAT_UNIT_NAME',
        'beat_correction.beat_unit_name' => 'BEAT_UNIT_NAME',
        'BeatName' => 'BEAT_NAME',
        'BeatCorrection.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'beatCorrection.beatName' => 'BEAT_NAME',
        'BeatCorrectionTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'beat_correction.beat_name' => 'BEAT_NAME',
        'BeatOptions' => 'BEAT_OPTIONS',
        'BeatCorrection.BeatOptions' => 'BEAT_OPTIONS',
        'beatOptions' => 'BEAT_OPTIONS',
        'beatCorrection.beatOptions' => 'BEAT_OPTIONS',
        'BeatCorrectionTableMap::COL_BEAT_OPTIONS' => 'BEAT_OPTIONS',
        'COL_BEAT_OPTIONS' => 'BEAT_OPTIONS',
        'beat_options' => 'BEAT_OPTIONS',
        'beat_correction.beat_options' => 'BEAT_OPTIONS',
        'CorrectBeatName' => 'CORRECT_BEAT_NAME',
        'BeatCorrection.CorrectBeatName' => 'CORRECT_BEAT_NAME',
        'correctBeatName' => 'CORRECT_BEAT_NAME',
        'beatCorrection.correctBeatName' => 'CORRECT_BEAT_NAME',
        'BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME' => 'CORRECT_BEAT_NAME',
        'COL_CORRECT_BEAT_NAME' => 'CORRECT_BEAT_NAME',
        'correct_beat_name' => 'CORRECT_BEAT_NAME',
        'beat_correction.correct_beat_name' => 'CORRECT_BEAT_NAME',
        'Status' => 'STATUS',
        'BeatCorrection.Status' => 'STATUS',
        'status' => 'STATUS',
        'beatCorrection.status' => 'STATUS',
        'BeatCorrectionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'beat_correction.status' => 'STATUS',
        'BeatOrgUnitId' => 'BEAT_ORG_UNIT_ID',
        'BeatCorrection.BeatOrgUnitId' => 'BEAT_ORG_UNIT_ID',
        'beatOrgUnitId' => 'BEAT_ORG_UNIT_ID',
        'beatCorrection.beatOrgUnitId' => 'BEAT_ORG_UNIT_ID',
        'BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID' => 'BEAT_ORG_UNIT_ID',
        'COL_BEAT_ORG_UNIT_ID' => 'BEAT_ORG_UNIT_ID',
        'beat_org_unit_id' => 'BEAT_ORG_UNIT_ID',
        'beat_correction.beat_org_unit_id' => 'BEAT_ORG_UNIT_ID',
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
        $this->setName('beat_correction');
        $this->setPhpName('BeatCorrection');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BeatCorrection');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('on_board_request_address_id', 'OnBoardRequestAddressId', 'INTEGER', true, null, null);
        $this->addColumn('territory', 'Territory', 'INTEGER', false, null, null);
        $this->addColumn('obra_unit_name', 'ObraUnitName', 'VARCHAR', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, null, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, null, null);
        $this->addColumn('address', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('beat_unit_name', 'BeatUnitName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_options', 'BeatOptions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('correct_beat_name', 'CorrectBeatName', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addColumn('beat_org_unit_id', 'BeatOrgUnitId', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BeatCorrectionTableMap::CLASS_DEFAULT : BeatCorrectionTableMap::OM_CLASS;
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
     * @return array (BeatCorrection object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BeatCorrectionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BeatCorrectionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BeatCorrectionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BeatCorrectionTableMap::OM_CLASS;
            /** @var BeatCorrection $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BeatCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $key = BeatCorrectionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BeatCorrectionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BeatCorrection $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BeatCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_TERRITORY);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_BEAT_OPTIONS);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_STATUS);
            $criteria->addSelectColumn(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_address_id');
            $criteria->addSelectColumn($alias . '.territory');
            $criteria->addSelectColumn($alias . '.obra_unit_name');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.beat_unit_name');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.beat_options');
            $criteria->addSelectColumn($alias . '.correct_beat_name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.beat_org_unit_id');
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
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_TERRITORY);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_OBRA_UNIT_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_BEAT_UNIT_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_BEAT_OPTIONS);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_CORRECT_BEAT_NAME);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(BeatCorrectionTableMap::COL_BEAT_ORG_UNIT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_address_id');
            $criteria->removeSelectColumn($alias . '.territory');
            $criteria->removeSelectColumn($alias . '.obra_unit_name');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.beat_unit_name');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.beat_options');
            $criteria->removeSelectColumn($alias . '.correct_beat_name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.beat_org_unit_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BeatCorrectionTableMap::DATABASE_NAME)->getTable(BeatCorrectionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BeatCorrection or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BeatCorrection object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BeatCorrection) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BeatCorrectionTableMap::DATABASE_NAME);
            $criteria->add(BeatCorrectionTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = BeatCorrectionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BeatCorrectionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BeatCorrectionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the beat_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BeatCorrectionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BeatCorrection or Criteria object.
     *
     * @param mixed $criteria Criteria or BeatCorrection object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BeatCorrectionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BeatCorrection object
        }


        // Set the correct dbName
        $query = BeatCorrectionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

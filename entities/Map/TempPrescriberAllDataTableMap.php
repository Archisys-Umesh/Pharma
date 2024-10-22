<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\TempPrescriberAllData;
use entities\TempPrescriberAllDataQuery;


/**
 * This class defines the structure of the 'temp_prescriber_all_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TempPrescriberAllDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TempPrescriberAllDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'temp_prescriber_all_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TempPrescriberAllData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TempPrescriberAllData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TempPrescriberAllData';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the orgunit field
     */
    public const COL_ORGUNIT = 'temp_prescriber_all_data.orgunit';

    /**
     * the column name for the doctorcode field
     */
    public const COL_DOCTORCODE = 'temp_prescriber_all_data.doctorcode';

    /**
     * the column name for the brandid field
     */
    public const COL_BRANDID = 'temp_prescriber_all_data.brandid';

    /**
     * the column name for the cutoff field
     */
    public const COL_CUTOFF = 'temp_prescriber_all_data.cutoff';

    /**
     * the column name for the mon_year field
     */
    public const COL_MON_YEAR = 'temp_prescriber_all_data.mon_year';

    /**
     * the column name for the lm_rcpa_value field
     */
    public const COL_LM_RCPA_VALUE = 'temp_prescriber_all_data.lm_rcpa_value';

    /**
     * the column name for the cm_rcpa_value field
     */
    public const COL_CM_RCPA_VALUE = 'temp_prescriber_all_data.cm_rcpa_value';

    /**
     * the column name for the lm_visit field
     */
    public const COL_LM_VISIT = 'temp_prescriber_all_data.lm_visit';

    /**
     * the column name for the cm_visit field
     */
    public const COL_CM_VISIT = 'temp_prescriber_all_data.cm_visit';

    /**
     * the column name for the lm_rcpa field
     */
    public const COL_LM_RCPA = 'temp_prescriber_all_data.lm_rcpa';

    /**
     * the column name for the cm_rcpa field
     */
    public const COL_CM_RCPA = 'temp_prescriber_all_data.cm_rcpa';

    /**
     * the column name for the cm_rxber_cat field
     */
    public const COL_CM_RXBER_CAT = 'temp_prescriber_all_data.cm_rxber_cat';

    /**
     * the column name for the compute_date field
     */
    public const COL_COMPUTE_DATE = 'temp_prescriber_all_data.compute_date';

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
        self::TYPE_PHPNAME       => ['Orgunit', 'Doctorcode', 'Brandid', 'Cutoff', 'MonYear', 'LmRcpaValue', 'CmRcpaValue', 'LmVisit', 'CmVisit', 'LmRcpa', 'CmRcpa', 'CmRxberCat', 'ComputeDate', ],
        self::TYPE_CAMELNAME     => ['orgunit', 'doctorcode', 'brandid', 'cutoff', 'monYear', 'lmRcpaValue', 'cmRcpaValue', 'lmVisit', 'cmVisit', 'lmRcpa', 'cmRcpa', 'cmRxberCat', 'computeDate', ],
        self::TYPE_COLNAME       => [TempPrescriberAllDataTableMap::COL_ORGUNIT, TempPrescriberAllDataTableMap::COL_DOCTORCODE, TempPrescriberAllDataTableMap::COL_BRANDID, TempPrescriberAllDataTableMap::COL_CUTOFF, TempPrescriberAllDataTableMap::COL_MON_YEAR, TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE, TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE, TempPrescriberAllDataTableMap::COL_LM_VISIT, TempPrescriberAllDataTableMap::COL_CM_VISIT, TempPrescriberAllDataTableMap::COL_LM_RCPA, TempPrescriberAllDataTableMap::COL_CM_RCPA, TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT, TempPrescriberAllDataTableMap::COL_COMPUTE_DATE, ],
        self::TYPE_FIELDNAME     => ['orgunit', 'doctorcode', 'brandid', 'cutoff', 'mon_year', 'lm_rcpa_value', 'cm_rcpa_value', 'lm_visit', 'cm_visit', 'lm_rcpa', 'cm_rcpa', 'cm_rxber_cat', 'compute_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['Orgunit' => 0, 'Doctorcode' => 1, 'Brandid' => 2, 'Cutoff' => 3, 'MonYear' => 4, 'LmRcpaValue' => 5, 'CmRcpaValue' => 6, 'LmVisit' => 7, 'CmVisit' => 8, 'LmRcpa' => 9, 'CmRcpa' => 10, 'CmRxberCat' => 11, 'ComputeDate' => 12, ],
        self::TYPE_CAMELNAME     => ['orgunit' => 0, 'doctorcode' => 1, 'brandid' => 2, 'cutoff' => 3, 'monYear' => 4, 'lmRcpaValue' => 5, 'cmRcpaValue' => 6, 'lmVisit' => 7, 'cmVisit' => 8, 'lmRcpa' => 9, 'cmRcpa' => 10, 'cmRxberCat' => 11, 'computeDate' => 12, ],
        self::TYPE_COLNAME       => [TempPrescriberAllDataTableMap::COL_ORGUNIT => 0, TempPrescriberAllDataTableMap::COL_DOCTORCODE => 1, TempPrescriberAllDataTableMap::COL_BRANDID => 2, TempPrescriberAllDataTableMap::COL_CUTOFF => 3, TempPrescriberAllDataTableMap::COL_MON_YEAR => 4, TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE => 5, TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE => 6, TempPrescriberAllDataTableMap::COL_LM_VISIT => 7, TempPrescriberAllDataTableMap::COL_CM_VISIT => 8, TempPrescriberAllDataTableMap::COL_LM_RCPA => 9, TempPrescriberAllDataTableMap::COL_CM_RCPA => 10, TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT => 11, TempPrescriberAllDataTableMap::COL_COMPUTE_DATE => 12, ],
        self::TYPE_FIELDNAME     => ['orgunit' => 0, 'doctorcode' => 1, 'brandid' => 2, 'cutoff' => 3, 'mon_year' => 4, 'lm_rcpa_value' => 5, 'cm_rcpa_value' => 6, 'lm_visit' => 7, 'cm_visit' => 8, 'lm_rcpa' => 9, 'cm_rcpa' => 10, 'cm_rxber_cat' => 11, 'compute_date' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Orgunit' => 'ORGUNIT',
        'TempPrescriberAllData.Orgunit' => 'ORGUNIT',
        'orgunit' => 'ORGUNIT',
        'tempPrescriberAllData.orgunit' => 'ORGUNIT',
        'TempPrescriberAllDataTableMap::COL_ORGUNIT' => 'ORGUNIT',
        'COL_ORGUNIT' => 'ORGUNIT',
        'temp_prescriber_all_data.orgunit' => 'ORGUNIT',
        'Doctorcode' => 'DOCTORCODE',
        'TempPrescriberAllData.Doctorcode' => 'DOCTORCODE',
        'doctorcode' => 'DOCTORCODE',
        'tempPrescriberAllData.doctorcode' => 'DOCTORCODE',
        'TempPrescriberAllDataTableMap::COL_DOCTORCODE' => 'DOCTORCODE',
        'COL_DOCTORCODE' => 'DOCTORCODE',
        'temp_prescriber_all_data.doctorcode' => 'DOCTORCODE',
        'Brandid' => 'BRANDID',
        'TempPrescriberAllData.Brandid' => 'BRANDID',
        'brandid' => 'BRANDID',
        'tempPrescriberAllData.brandid' => 'BRANDID',
        'TempPrescriberAllDataTableMap::COL_BRANDID' => 'BRANDID',
        'COL_BRANDID' => 'BRANDID',
        'temp_prescriber_all_data.brandid' => 'BRANDID',
        'Cutoff' => 'CUTOFF',
        'TempPrescriberAllData.Cutoff' => 'CUTOFF',
        'cutoff' => 'CUTOFF',
        'tempPrescriberAllData.cutoff' => 'CUTOFF',
        'TempPrescriberAllDataTableMap::COL_CUTOFF' => 'CUTOFF',
        'COL_CUTOFF' => 'CUTOFF',
        'temp_prescriber_all_data.cutoff' => 'CUTOFF',
        'MonYear' => 'MON_YEAR',
        'TempPrescriberAllData.MonYear' => 'MON_YEAR',
        'monYear' => 'MON_YEAR',
        'tempPrescriberAllData.monYear' => 'MON_YEAR',
        'TempPrescriberAllDataTableMap::COL_MON_YEAR' => 'MON_YEAR',
        'COL_MON_YEAR' => 'MON_YEAR',
        'mon_year' => 'MON_YEAR',
        'temp_prescriber_all_data.mon_year' => 'MON_YEAR',
        'LmRcpaValue' => 'LM_RCPA_VALUE',
        'TempPrescriberAllData.LmRcpaValue' => 'LM_RCPA_VALUE',
        'lmRcpaValue' => 'LM_RCPA_VALUE',
        'tempPrescriberAllData.lmRcpaValue' => 'LM_RCPA_VALUE',
        'TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE' => 'LM_RCPA_VALUE',
        'COL_LM_RCPA_VALUE' => 'LM_RCPA_VALUE',
        'lm_rcpa_value' => 'LM_RCPA_VALUE',
        'temp_prescriber_all_data.lm_rcpa_value' => 'LM_RCPA_VALUE',
        'CmRcpaValue' => 'CM_RCPA_VALUE',
        'TempPrescriberAllData.CmRcpaValue' => 'CM_RCPA_VALUE',
        'cmRcpaValue' => 'CM_RCPA_VALUE',
        'tempPrescriberAllData.cmRcpaValue' => 'CM_RCPA_VALUE',
        'TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE' => 'CM_RCPA_VALUE',
        'COL_CM_RCPA_VALUE' => 'CM_RCPA_VALUE',
        'cm_rcpa_value' => 'CM_RCPA_VALUE',
        'temp_prescriber_all_data.cm_rcpa_value' => 'CM_RCPA_VALUE',
        'LmVisit' => 'LM_VISIT',
        'TempPrescriberAllData.LmVisit' => 'LM_VISIT',
        'lmVisit' => 'LM_VISIT',
        'tempPrescriberAllData.lmVisit' => 'LM_VISIT',
        'TempPrescriberAllDataTableMap::COL_LM_VISIT' => 'LM_VISIT',
        'COL_LM_VISIT' => 'LM_VISIT',
        'lm_visit' => 'LM_VISIT',
        'temp_prescriber_all_data.lm_visit' => 'LM_VISIT',
        'CmVisit' => 'CM_VISIT',
        'TempPrescriberAllData.CmVisit' => 'CM_VISIT',
        'cmVisit' => 'CM_VISIT',
        'tempPrescriberAllData.cmVisit' => 'CM_VISIT',
        'TempPrescriberAllDataTableMap::COL_CM_VISIT' => 'CM_VISIT',
        'COL_CM_VISIT' => 'CM_VISIT',
        'cm_visit' => 'CM_VISIT',
        'temp_prescriber_all_data.cm_visit' => 'CM_VISIT',
        'LmRcpa' => 'LM_RCPA',
        'TempPrescriberAllData.LmRcpa' => 'LM_RCPA',
        'lmRcpa' => 'LM_RCPA',
        'tempPrescriberAllData.lmRcpa' => 'LM_RCPA',
        'TempPrescriberAllDataTableMap::COL_LM_RCPA' => 'LM_RCPA',
        'COL_LM_RCPA' => 'LM_RCPA',
        'lm_rcpa' => 'LM_RCPA',
        'temp_prescriber_all_data.lm_rcpa' => 'LM_RCPA',
        'CmRcpa' => 'CM_RCPA',
        'TempPrescriberAllData.CmRcpa' => 'CM_RCPA',
        'cmRcpa' => 'CM_RCPA',
        'tempPrescriberAllData.cmRcpa' => 'CM_RCPA',
        'TempPrescriberAllDataTableMap::COL_CM_RCPA' => 'CM_RCPA',
        'COL_CM_RCPA' => 'CM_RCPA',
        'cm_rcpa' => 'CM_RCPA',
        'temp_prescriber_all_data.cm_rcpa' => 'CM_RCPA',
        'CmRxberCat' => 'CM_RXBER_CAT',
        'TempPrescriberAllData.CmRxberCat' => 'CM_RXBER_CAT',
        'cmRxberCat' => 'CM_RXBER_CAT',
        'tempPrescriberAllData.cmRxberCat' => 'CM_RXBER_CAT',
        'TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT' => 'CM_RXBER_CAT',
        'COL_CM_RXBER_CAT' => 'CM_RXBER_CAT',
        'cm_rxber_cat' => 'CM_RXBER_CAT',
        'temp_prescriber_all_data.cm_rxber_cat' => 'CM_RXBER_CAT',
        'ComputeDate' => 'COMPUTE_DATE',
        'TempPrescriberAllData.ComputeDate' => 'COMPUTE_DATE',
        'computeDate' => 'COMPUTE_DATE',
        'tempPrescriberAllData.computeDate' => 'COMPUTE_DATE',
        'TempPrescriberAllDataTableMap::COL_COMPUTE_DATE' => 'COMPUTE_DATE',
        'COL_COMPUTE_DATE' => 'COMPUTE_DATE',
        'compute_date' => 'COMPUTE_DATE',
        'temp_prescriber_all_data.compute_date' => 'COMPUTE_DATE',
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
        $this->setName('temp_prescriber_all_data');
        $this->setPhpName('TempPrescriberAllData');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TempPrescriberAllData');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('orgunit', 'Orgunit', 'VARCHAR', false, 50, null);
        $this->addColumn('doctorcode', 'Doctorcode', 'VARCHAR', false, null, null);
        $this->addColumn('brandid', 'Brandid', 'INTEGER', false, null, null);
        $this->addColumn('cutoff', 'Cutoff', 'INTEGER', false, null, null);
        $this->addColumn('mon_year', 'MonYear', 'VARCHAR', false, null, null);
        $this->addColumn('lm_rcpa_value', 'LmRcpaValue', 'REAL', false, 24, null);
        $this->addColumn('cm_rcpa_value', 'CmRcpaValue', 'REAL', false, 24, null);
        $this->addColumn('lm_visit', 'LmVisit', 'VARCHAR', false, 50, null);
        $this->addColumn('cm_visit', 'CmVisit', 'VARCHAR', false, 50, null);
        $this->addColumn('lm_rcpa', 'LmRcpa', 'VARCHAR', false, 50, null);
        $this->addColumn('cm_rcpa', 'CmRcpa', 'VARCHAR', false, 50, null);
        $this->addColumn('cm_rxber_cat', 'CmRxberCat', 'VARCHAR', false, 50, null);
        $this->addColumn('compute_date', 'ComputeDate', 'DATE', false, null, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? TempPrescriberAllDataTableMap::CLASS_DEFAULT : TempPrescriberAllDataTableMap::OM_CLASS;
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
     * @return array (TempPrescriberAllData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TempPrescriberAllDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TempPrescriberAllDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TempPrescriberAllDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TempPrescriberAllDataTableMap::OM_CLASS;
            /** @var TempPrescriberAllData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TempPrescriberAllDataTableMap::addInstanceToPool($obj, $key);
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
            $key = TempPrescriberAllDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TempPrescriberAllDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TempPrescriberAllData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TempPrescriberAllDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_ORGUNIT);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_DOCTORCODE);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_BRANDID);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_CUTOFF);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_MON_YEAR);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_LM_VISIT);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_CM_VISIT);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_LM_RCPA);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RCPA);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT);
            $criteria->addSelectColumn(TempPrescriberAllDataTableMap::COL_COMPUTE_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.orgunit');
            $criteria->addSelectColumn($alias . '.doctorcode');
            $criteria->addSelectColumn($alias . '.brandid');
            $criteria->addSelectColumn($alias . '.cutoff');
            $criteria->addSelectColumn($alias . '.mon_year');
            $criteria->addSelectColumn($alias . '.lm_rcpa_value');
            $criteria->addSelectColumn($alias . '.cm_rcpa_value');
            $criteria->addSelectColumn($alias . '.lm_visit');
            $criteria->addSelectColumn($alias . '.cm_visit');
            $criteria->addSelectColumn($alias . '.lm_rcpa');
            $criteria->addSelectColumn($alias . '.cm_rcpa');
            $criteria->addSelectColumn($alias . '.cm_rxber_cat');
            $criteria->addSelectColumn($alias . '.compute_date');
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
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_ORGUNIT);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_DOCTORCODE);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_BRANDID);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_CUTOFF);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_MON_YEAR);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_LM_RCPA_VALUE);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RCPA_VALUE);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_LM_VISIT);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_CM_VISIT);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_LM_RCPA);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RCPA);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_CM_RXBER_CAT);
            $criteria->removeSelectColumn(TempPrescriberAllDataTableMap::COL_COMPUTE_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.orgunit');
            $criteria->removeSelectColumn($alias . '.doctorcode');
            $criteria->removeSelectColumn($alias . '.brandid');
            $criteria->removeSelectColumn($alias . '.cutoff');
            $criteria->removeSelectColumn($alias . '.mon_year');
            $criteria->removeSelectColumn($alias . '.lm_rcpa_value');
            $criteria->removeSelectColumn($alias . '.cm_rcpa_value');
            $criteria->removeSelectColumn($alias . '.lm_visit');
            $criteria->removeSelectColumn($alias . '.cm_visit');
            $criteria->removeSelectColumn($alias . '.lm_rcpa');
            $criteria->removeSelectColumn($alias . '.cm_rcpa');
            $criteria->removeSelectColumn($alias . '.cm_rxber_cat');
            $criteria->removeSelectColumn($alias . '.compute_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(TempPrescriberAllDataTableMap::DATABASE_NAME)->getTable(TempPrescriberAllDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TempPrescriberAllData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TempPrescriberAllData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TempPrescriberAllDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TempPrescriberAllData) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The TempPrescriberAllData object has no primary key');
        }

        $query = TempPrescriberAllDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TempPrescriberAllDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TempPrescriberAllDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the temp_prescriber_all_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TempPrescriberAllDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TempPrescriberAllData or Criteria object.
     *
     * @param mixed $criteria Criteria or TempPrescriberAllData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempPrescriberAllDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TempPrescriberAllData object
        }


        // Set the correct dbName
        $query = TempPrescriberAllDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

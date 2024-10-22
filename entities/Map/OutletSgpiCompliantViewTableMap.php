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
use entities\OutletSgpiCompliantView;
use entities\OutletSgpiCompliantViewQuery;


/**
 * This class defines the structure of the 'outlet_sgpi_compliant_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletSgpiCompliantViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletSgpiCompliantViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_sgpi_compliant_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletSgpiCompliantView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletSgpiCompliantView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletSgpiCompliantView';

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
     * the column name for the moye field
     */
    public const COL_MOYE = 'outlet_sgpi_compliant_view.moye';

    /**
     * the column name for the org_data_id field
     */
    public const COL_ORG_DATA_ID = 'outlet_sgpi_compliant_view.org_data_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'outlet_sgpi_compliant_view.brand_id';

    /**
     * the column name for the sgpi_status field
     */
    public const COL_SGPI_STATUS = 'outlet_sgpi_compliant_view.sgpi_status';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'outlet_sgpi_compliant_view.sgpi_id';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'outlet_sgpi_compliant_view.sgpi_type';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'outlet_sgpi_compliant_view.position_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'outlet_sgpi_compliant_view.employee_id';

    /**
     * the column name for the total_qty field
     */
    public const COL_TOTAL_QTY = 'outlet_sgpi_compliant_view.total_qty';

    /**
     * the column name for the compliant field
     */
    public const COL_COMPLIANT = 'outlet_sgpi_compliant_view.compliant';

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
        self::TYPE_PHPNAME       => ['Moye', 'OrgDataId', 'BrandId', 'SgpiStatus', 'SgpiId', 'SgpiType', 'PositionId', 'EmployeeId', 'TotalQty', 'Compliant', ],
        self::TYPE_CAMELNAME     => ['moye', 'orgDataId', 'brandId', 'sgpiStatus', 'sgpiId', 'sgpiType', 'positionId', 'employeeId', 'totalQty', 'compliant', ],
        self::TYPE_COLNAME       => [OutletSgpiCompliantViewTableMap::COL_MOYE, OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID, OutletSgpiCompliantViewTableMap::COL_BRAND_ID, OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS, OutletSgpiCompliantViewTableMap::COL_SGPI_ID, OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE, OutletSgpiCompliantViewTableMap::COL_POSITION_ID, OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID, OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY, OutletSgpiCompliantViewTableMap::COL_COMPLIANT, ],
        self::TYPE_FIELDNAME     => ['moye', 'org_data_id', 'brand_id', 'sgpi_status', 'sgpi_id', 'sgpi_type', 'position_id', 'employee_id', 'total_qty', 'compliant', ],
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
        self::TYPE_PHPNAME       => ['Moye' => 0, 'OrgDataId' => 1, 'BrandId' => 2, 'SgpiStatus' => 3, 'SgpiId' => 4, 'SgpiType' => 5, 'PositionId' => 6, 'EmployeeId' => 7, 'TotalQty' => 8, 'Compliant' => 9, ],
        self::TYPE_CAMELNAME     => ['moye' => 0, 'orgDataId' => 1, 'brandId' => 2, 'sgpiStatus' => 3, 'sgpiId' => 4, 'sgpiType' => 5, 'positionId' => 6, 'employeeId' => 7, 'totalQty' => 8, 'compliant' => 9, ],
        self::TYPE_COLNAME       => [OutletSgpiCompliantViewTableMap::COL_MOYE => 0, OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID => 1, OutletSgpiCompliantViewTableMap::COL_BRAND_ID => 2, OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS => 3, OutletSgpiCompliantViewTableMap::COL_SGPI_ID => 4, OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE => 5, OutletSgpiCompliantViewTableMap::COL_POSITION_ID => 6, OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID => 7, OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY => 8, OutletSgpiCompliantViewTableMap::COL_COMPLIANT => 9, ],
        self::TYPE_FIELDNAME     => ['moye' => 0, 'org_data_id' => 1, 'brand_id' => 2, 'sgpi_status' => 3, 'sgpi_id' => 4, 'sgpi_type' => 5, 'position_id' => 6, 'employee_id' => 7, 'total_qty' => 8, 'compliant' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Moye' => 'MOYE',
        'OutletSgpiCompliantView.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'outletSgpiCompliantView.moye' => 'MOYE',
        'OutletSgpiCompliantViewTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'outlet_sgpi_compliant_view.moye' => 'MOYE',
        'OrgDataId' => 'ORG_DATA_ID',
        'OutletSgpiCompliantView.OrgDataId' => 'ORG_DATA_ID',
        'orgDataId' => 'ORG_DATA_ID',
        'outletSgpiCompliantView.orgDataId' => 'ORG_DATA_ID',
        'OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'org_data_id' => 'ORG_DATA_ID',
        'outlet_sgpi_compliant_view.org_data_id' => 'ORG_DATA_ID',
        'BrandId' => 'BRAND_ID',
        'OutletSgpiCompliantView.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'outletSgpiCompliantView.brandId' => 'BRAND_ID',
        'OutletSgpiCompliantViewTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'outlet_sgpi_compliant_view.brand_id' => 'BRAND_ID',
        'SgpiStatus' => 'SGPI_STATUS',
        'OutletSgpiCompliantView.SgpiStatus' => 'SGPI_STATUS',
        'sgpiStatus' => 'SGPI_STATUS',
        'outletSgpiCompliantView.sgpiStatus' => 'SGPI_STATUS',
        'OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS' => 'SGPI_STATUS',
        'COL_SGPI_STATUS' => 'SGPI_STATUS',
        'sgpi_status' => 'SGPI_STATUS',
        'outlet_sgpi_compliant_view.sgpi_status' => 'SGPI_STATUS',
        'SgpiId' => 'SGPI_ID',
        'OutletSgpiCompliantView.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'outletSgpiCompliantView.sgpiId' => 'SGPI_ID',
        'OutletSgpiCompliantViewTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'outlet_sgpi_compliant_view.sgpi_id' => 'SGPI_ID',
        'SgpiType' => 'SGPI_TYPE',
        'OutletSgpiCompliantView.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'outletSgpiCompliantView.sgpiType' => 'SGPI_TYPE',
        'OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'outlet_sgpi_compliant_view.sgpi_type' => 'SGPI_TYPE',
        'PositionId' => 'POSITION_ID',
        'OutletSgpiCompliantView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'outletSgpiCompliantView.positionId' => 'POSITION_ID',
        'OutletSgpiCompliantViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'outlet_sgpi_compliant_view.position_id' => 'POSITION_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'OutletSgpiCompliantView.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'outletSgpiCompliantView.employeeId' => 'EMPLOYEE_ID',
        'OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'outlet_sgpi_compliant_view.employee_id' => 'EMPLOYEE_ID',
        'TotalQty' => 'TOTAL_QTY',
        'OutletSgpiCompliantView.TotalQty' => 'TOTAL_QTY',
        'totalQty' => 'TOTAL_QTY',
        'outletSgpiCompliantView.totalQty' => 'TOTAL_QTY',
        'OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY' => 'TOTAL_QTY',
        'COL_TOTAL_QTY' => 'TOTAL_QTY',
        'total_qty' => 'TOTAL_QTY',
        'outlet_sgpi_compliant_view.total_qty' => 'TOTAL_QTY',
        'Compliant' => 'COMPLIANT',
        'OutletSgpiCompliantView.Compliant' => 'COMPLIANT',
        'compliant' => 'COMPLIANT',
        'outletSgpiCompliantView.compliant' => 'COMPLIANT',
        'OutletSgpiCompliantViewTableMap::COL_COMPLIANT' => 'COMPLIANT',
        'COL_COMPLIANT' => 'COMPLIANT',
        'outlet_sgpi_compliant_view.compliant' => 'COMPLIANT',
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
        $this->setName('outlet_sgpi_compliant_view');
        $this->setPhpName('OutletSgpiCompliantView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletSgpiCompliantView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, null, null);
        $this->addColumn('org_data_id', 'OrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_status', 'SgpiStatus', 'BOOLEAN', false, 1, null);
        $this->addColumn('sgpi_id', 'SgpiId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('total_qty', 'TotalQty', 'INTEGER', false, null, null);
        $this->addColumn('compliant', 'Compliant', 'VARCHAR', false, null, null);
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
        return $withPrefix ? OutletSgpiCompliantViewTableMap::CLASS_DEFAULT : OutletSgpiCompliantViewTableMap::OM_CLASS;
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
     * @return array (OutletSgpiCompliantView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletSgpiCompliantViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletSgpiCompliantViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletSgpiCompliantViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletSgpiCompliantViewTableMap::OM_CLASS;
            /** @var OutletSgpiCompliantView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletSgpiCompliantViewTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletSgpiCompliantViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletSgpiCompliantViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletSgpiCompliantView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletSgpiCompliantViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_MOYE);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY);
            $criteria->addSelectColumn(OutletSgpiCompliantViewTableMap::COL_COMPLIANT);
        } else {
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.org_data_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.sgpi_status');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.sgpi_type');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.total_qty');
            $criteria->addSelectColumn($alias . '.compliant');
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
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_MOYE);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_ORG_DATA_ID);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_STATUS);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_TOTAL_QTY);
            $criteria->removeSelectColumn(OutletSgpiCompliantViewTableMap::COL_COMPLIANT);
        } else {
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.org_data_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.sgpi_status');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.sgpi_type');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.total_qty');
            $criteria->removeSelectColumn($alias . '.compliant');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletSgpiCompliantViewTableMap::DATABASE_NAME)->getTable(OutletSgpiCompliantViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletSgpiCompliantView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletSgpiCompliantView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletSgpiCompliantViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletSgpiCompliantView) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The OutletSgpiCompliantView object has no primary key');
        }

        $query = OutletSgpiCompliantViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletSgpiCompliantViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletSgpiCompliantViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_sgpi_compliant_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletSgpiCompliantViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletSgpiCompliantView or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletSgpiCompliantView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletSgpiCompliantViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletSgpiCompliantView object
        }


        // Set the correct dbName
        $query = OutletSgpiCompliantViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

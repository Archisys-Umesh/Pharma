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
use entities\TerritoriesBackup;
use entities\TerritoriesBackupQuery;


/**
 * This class defines the structure of the 'territories_backup' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TerritoriesBackupTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TerritoriesBackupTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'territories_backup';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TerritoriesBackup';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TerritoriesBackup';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TerritoriesBackup';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'territories_backup.territory_id';

    /**
     * the column name for the territory_code field
     */
    public const COL_TERRITORY_CODE = 'territories_backup.territory_code';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'territories_backup.company_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'territories_backup.territory_name';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'territories_backup.orgunitid';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'territories_backup.position_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'territories_backup.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'territories_backup.updated_at';

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
        self::TYPE_PHPNAME       => ['TerritoryId', 'TerritoryCode', 'CompanyId', 'TerritoryName', 'Orgunitid', 'PositionId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['territoryId', 'territoryCode', 'companyId', 'territoryName', 'orgunitid', 'positionId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [TerritoriesBackupTableMap::COL_TERRITORY_ID, TerritoriesBackupTableMap::COL_TERRITORY_CODE, TerritoriesBackupTableMap::COL_COMPANY_ID, TerritoriesBackupTableMap::COL_TERRITORY_NAME, TerritoriesBackupTableMap::COL_ORGUNITID, TerritoriesBackupTableMap::COL_POSITION_ID, TerritoriesBackupTableMap::COL_CREATED_AT, TerritoriesBackupTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['territory_id', 'territory_code', 'company_id', 'territory_name', 'orgunitid', 'position_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['TerritoryId' => 0, 'TerritoryCode' => 1, 'CompanyId' => 2, 'TerritoryName' => 3, 'Orgunitid' => 4, 'PositionId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['territoryId' => 0, 'territoryCode' => 1, 'companyId' => 2, 'territoryName' => 3, 'orgunitid' => 4, 'positionId' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [TerritoriesBackupTableMap::COL_TERRITORY_ID => 0, TerritoriesBackupTableMap::COL_TERRITORY_CODE => 1, TerritoriesBackupTableMap::COL_COMPANY_ID => 2, TerritoriesBackupTableMap::COL_TERRITORY_NAME => 3, TerritoriesBackupTableMap::COL_ORGUNITID => 4, TerritoriesBackupTableMap::COL_POSITION_ID => 5, TerritoriesBackupTableMap::COL_CREATED_AT => 6, TerritoriesBackupTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['territory_id' => 0, 'territory_code' => 1, 'company_id' => 2, 'territory_name' => 3, 'orgunitid' => 4, 'position_id' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TerritoryId' => 'TERRITORY_ID',
        'TerritoriesBackup.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'territoriesBackup.territoryId' => 'TERRITORY_ID',
        'TerritoriesBackupTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'territories_backup.territory_id' => 'TERRITORY_ID',
        'TerritoryCode' => 'TERRITORY_CODE',
        'TerritoriesBackup.TerritoryCode' => 'TERRITORY_CODE',
        'territoryCode' => 'TERRITORY_CODE',
        'territoriesBackup.territoryCode' => 'TERRITORY_CODE',
        'TerritoriesBackupTableMap::COL_TERRITORY_CODE' => 'TERRITORY_CODE',
        'COL_TERRITORY_CODE' => 'TERRITORY_CODE',
        'territory_code' => 'TERRITORY_CODE',
        'territories_backup.territory_code' => 'TERRITORY_CODE',
        'CompanyId' => 'COMPANY_ID',
        'TerritoriesBackup.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'territoriesBackup.companyId' => 'COMPANY_ID',
        'TerritoriesBackupTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'territories_backup.company_id' => 'COMPANY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'TerritoriesBackup.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'territoriesBackup.territoryName' => 'TERRITORY_NAME',
        'TerritoriesBackupTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'territories_backup.territory_name' => 'TERRITORY_NAME',
        'Orgunitid' => 'ORGUNITID',
        'TerritoriesBackup.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'territoriesBackup.orgunitid' => 'ORGUNITID',
        'TerritoriesBackupTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'territories_backup.orgunitid' => 'ORGUNITID',
        'PositionId' => 'POSITION_ID',
        'TerritoriesBackup.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'territoriesBackup.positionId' => 'POSITION_ID',
        'TerritoriesBackupTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'territories_backup.position_id' => 'POSITION_ID',
        'CreatedAt' => 'CREATED_AT',
        'TerritoriesBackup.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'territoriesBackup.createdAt' => 'CREATED_AT',
        'TerritoriesBackupTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'territories_backup.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TerritoriesBackup.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'territoriesBackup.updatedAt' => 'UPDATED_AT',
        'TerritoriesBackupTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'territories_backup.updated_at' => 'UPDATED_AT',
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
        $this->setName('territories_backup');
        $this->setPhpName('TerritoriesBackup');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TerritoriesBackup');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_code', 'TerritoryCode', 'VARCHAR', false, 255, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        return $withPrefix ? TerritoriesBackupTableMap::CLASS_DEFAULT : TerritoriesBackupTableMap::OM_CLASS;
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
     * @return array (TerritoriesBackup object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TerritoriesBackupTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TerritoriesBackupTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TerritoriesBackupTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TerritoriesBackupTableMap::OM_CLASS;
            /** @var TerritoriesBackup $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TerritoriesBackupTableMap::addInstanceToPool($obj, $key);
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
            $key = TerritoriesBackupTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TerritoriesBackupTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TerritoriesBackup $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TerritoriesBackupTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_CODE);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TerritoriesBackupTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_code');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.position_id');
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
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_CODE);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TerritoriesBackupTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_code');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.position_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(TerritoriesBackupTableMap::DATABASE_NAME)->getTable(TerritoriesBackupTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TerritoriesBackup or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TerritoriesBackup object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesBackupTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TerritoriesBackup) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The TerritoriesBackup object has no primary key');
        }

        $query = TerritoriesBackupQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TerritoriesBackupTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TerritoriesBackupTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the territories_backup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TerritoriesBackupQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TerritoriesBackup or Criteria object.
     *
     * @param mixed $criteria Criteria or TerritoriesBackup object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TerritoriesBackupTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TerritoriesBackup object
        }


        // Set the correct dbName
        $query = TerritoriesBackupQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\Designations;
use entities\DesignationsQuery;


/**
 * This class defines the structure of the 'designations' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DesignationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DesignationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'designations';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Designations';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Designations';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Designations';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the designation_id field
     */
    public const COL_DESIGNATION_ID = 'designations.designation_id';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'designations.designation';

    /**
     * the column name for the designation_color field
     */
    public const COL_DESIGNATION_COLOR = 'designations.designation_color';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'designations.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'designations.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'designations.updated_at';

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
        self::TYPE_PHPNAME       => ['DesignationId', 'Designation', 'DesignationColor', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['designationId', 'designation', 'designationColor', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [DesignationsTableMap::COL_DESIGNATION_ID, DesignationsTableMap::COL_DESIGNATION, DesignationsTableMap::COL_DESIGNATION_COLOR, DesignationsTableMap::COL_COMPANY_ID, DesignationsTableMap::COL_CREATED_AT, DesignationsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['designation_id', 'designation', 'designation_color', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['DesignationId' => 0, 'Designation' => 1, 'DesignationColor' => 2, 'CompanyId' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['designationId' => 0, 'designation' => 1, 'designationColor' => 2, 'companyId' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [DesignationsTableMap::COL_DESIGNATION_ID => 0, DesignationsTableMap::COL_DESIGNATION => 1, DesignationsTableMap::COL_DESIGNATION_COLOR => 2, DesignationsTableMap::COL_COMPANY_ID => 3, DesignationsTableMap::COL_CREATED_AT => 4, DesignationsTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['designation_id' => 0, 'designation' => 1, 'designation_color' => 2, 'company_id' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DesignationId' => 'DESIGNATION_ID',
        'Designations.DesignationId' => 'DESIGNATION_ID',
        'designationId' => 'DESIGNATION_ID',
        'designations.designationId' => 'DESIGNATION_ID',
        'DesignationsTableMap::COL_DESIGNATION_ID' => 'DESIGNATION_ID',
        'COL_DESIGNATION_ID' => 'DESIGNATION_ID',
        'designation_id' => 'DESIGNATION_ID',
        'designations.designation_id' => 'DESIGNATION_ID',
        'Designation' => 'DESIGNATION',
        'Designations.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'designations.designation' => 'DESIGNATION',
        'DesignationsTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'DesignationColor' => 'DESIGNATION_COLOR',
        'Designations.DesignationColor' => 'DESIGNATION_COLOR',
        'designationColor' => 'DESIGNATION_COLOR',
        'designations.designationColor' => 'DESIGNATION_COLOR',
        'DesignationsTableMap::COL_DESIGNATION_COLOR' => 'DESIGNATION_COLOR',
        'COL_DESIGNATION_COLOR' => 'DESIGNATION_COLOR',
        'designation_color' => 'DESIGNATION_COLOR',
        'designations.designation_color' => 'DESIGNATION_COLOR',
        'CompanyId' => 'COMPANY_ID',
        'Designations.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'designations.companyId' => 'COMPANY_ID',
        'DesignationsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'designations.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Designations.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'designations.createdAt' => 'CREATED_AT',
        'DesignationsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'designations.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Designations.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'designations.updatedAt' => 'UPDATED_AT',
        'DesignationsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'designations.updated_at' => 'UPDATED_AT',
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
        $this->setName('designations');
        $this->setPhpName('Designations');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Designations');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('designations_designation_id_seq');
        // columns
        $this->addPrimaryKey('designation_id', 'DesignationId', 'INTEGER', true, null, null);
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, 255, null);
        $this->addColumn('designation_color', 'DesignationColor', 'VARCHAR', false, 255, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
), 'CASCADE', null, null, false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':designation',
    1 => ':designation_id',
  ),
), null, null, 'BrandCampiagns', false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':designation_id',
    1 => ':designation_id',
  ),
), null, null, 'Employees', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DesignationsTableMap::CLASS_DEFAULT : DesignationsTableMap::OM_CLASS;
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
     * @return array (Designations object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DesignationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DesignationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DesignationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DesignationsTableMap::OM_CLASS;
            /** @var Designations $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DesignationsTableMap::addInstanceToPool($obj, $key);
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
            $key = DesignationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DesignationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Designations $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DesignationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DesignationsTableMap::COL_DESIGNATION_ID);
            $criteria->addSelectColumn(DesignationsTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(DesignationsTableMap::COL_DESIGNATION_COLOR);
            $criteria->addSelectColumn(DesignationsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(DesignationsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DesignationsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.designation_id');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.designation_color');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(DesignationsTableMap::COL_DESIGNATION_ID);
            $criteria->removeSelectColumn(DesignationsTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(DesignationsTableMap::COL_DESIGNATION_COLOR);
            $criteria->removeSelectColumn(DesignationsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(DesignationsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DesignationsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.designation_id');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.designation_color');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(DesignationsTableMap::DATABASE_NAME)->getTable(DesignationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Designations or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Designations object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DesignationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Designations) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DesignationsTableMap::DATABASE_NAME);
            $criteria->add(DesignationsTableMap::COL_DESIGNATION_ID, (array) $values, Criteria::IN);
        }

        $query = DesignationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DesignationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DesignationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the designations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DesignationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Designations or Criteria object.
     *
     * @param mixed $criteria Criteria or Designations object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DesignationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Designations object
        }

        if ($criteria->containsKey(DesignationsTableMap::COL_DESIGNATION_ID) && $criteria->keyContainsValue(DesignationsTableMap::COL_DESIGNATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DesignationsTableMap::COL_DESIGNATION_ID.')');
        }


        // Set the correct dbName
        $query = DesignationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

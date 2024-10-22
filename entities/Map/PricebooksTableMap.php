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
use entities\Pricebooks;
use entities\PricebooksQuery;


/**
 * This class defines the structure of the 'pricebooks' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PricebooksTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PricebooksTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pricebooks';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Pricebooks';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Pricebooks';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Pricebooks';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the pricebook_id field
     */
    public const COL_PRICEBOOK_ID = 'pricebooks.pricebook_id';

    /**
     * the column name for the pricebook_name field
     */
    public const COL_PRICEBOOK_NAME = 'pricebooks.pricebook_name';

    /**
     * the column name for the pricebook_description field
     */
    public const COL_PRICEBOOK_DESCRIPTION = 'pricebooks.pricebook_description';

    /**
     * the column name for the pricebook_code field
     */
    public const COL_PRICEBOOK_CODE = 'pricebooks.pricebook_code';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'pricebooks.company_id';

    /**
     * the column name for the org_id field
     */
    public const COL_ORG_ID = 'pricebooks.org_id';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'pricebooks.integration_id';

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
        self::TYPE_PHPNAME       => ['PricebookId', 'PricebookName', 'PricebookDescription', 'PricebookCode', 'CompanyId', 'OrgId', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['pricebookId', 'pricebookName', 'pricebookDescription', 'pricebookCode', 'companyId', 'orgId', 'integrationId', ],
        self::TYPE_COLNAME       => [PricebooksTableMap::COL_PRICEBOOK_ID, PricebooksTableMap::COL_PRICEBOOK_NAME, PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION, PricebooksTableMap::COL_PRICEBOOK_CODE, PricebooksTableMap::COL_COMPANY_ID, PricebooksTableMap::COL_ORG_ID, PricebooksTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['pricebook_id', 'pricebook_name', 'pricebook_description', 'pricebook_code', 'company_id', 'org_id', 'integration_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['PricebookId' => 0, 'PricebookName' => 1, 'PricebookDescription' => 2, 'PricebookCode' => 3, 'CompanyId' => 4, 'OrgId' => 5, 'IntegrationId' => 6, ],
        self::TYPE_CAMELNAME     => ['pricebookId' => 0, 'pricebookName' => 1, 'pricebookDescription' => 2, 'pricebookCode' => 3, 'companyId' => 4, 'orgId' => 5, 'integrationId' => 6, ],
        self::TYPE_COLNAME       => [PricebooksTableMap::COL_PRICEBOOK_ID => 0, PricebooksTableMap::COL_PRICEBOOK_NAME => 1, PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION => 2, PricebooksTableMap::COL_PRICEBOOK_CODE => 3, PricebooksTableMap::COL_COMPANY_ID => 4, PricebooksTableMap::COL_ORG_ID => 5, PricebooksTableMap::COL_INTEGRATION_ID => 6, ],
        self::TYPE_FIELDNAME     => ['pricebook_id' => 0, 'pricebook_name' => 1, 'pricebook_description' => 2, 'pricebook_code' => 3, 'company_id' => 4, 'org_id' => 5, 'integration_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PricebookId' => 'PRICEBOOK_ID',
        'Pricebooks.PricebookId' => 'PRICEBOOK_ID',
        'pricebookId' => 'PRICEBOOK_ID',
        'pricebooks.pricebookId' => 'PRICEBOOK_ID',
        'PricebooksTableMap::COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'COL_PRICEBOOK_ID' => 'PRICEBOOK_ID',
        'pricebook_id' => 'PRICEBOOK_ID',
        'pricebooks.pricebook_id' => 'PRICEBOOK_ID',
        'PricebookName' => 'PRICEBOOK_NAME',
        'Pricebooks.PricebookName' => 'PRICEBOOK_NAME',
        'pricebookName' => 'PRICEBOOK_NAME',
        'pricebooks.pricebookName' => 'PRICEBOOK_NAME',
        'PricebooksTableMap::COL_PRICEBOOK_NAME' => 'PRICEBOOK_NAME',
        'COL_PRICEBOOK_NAME' => 'PRICEBOOK_NAME',
        'pricebook_name' => 'PRICEBOOK_NAME',
        'pricebooks.pricebook_name' => 'PRICEBOOK_NAME',
        'PricebookDescription' => 'PRICEBOOK_DESCRIPTION',
        'Pricebooks.PricebookDescription' => 'PRICEBOOK_DESCRIPTION',
        'pricebookDescription' => 'PRICEBOOK_DESCRIPTION',
        'pricebooks.pricebookDescription' => 'PRICEBOOK_DESCRIPTION',
        'PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION' => 'PRICEBOOK_DESCRIPTION',
        'COL_PRICEBOOK_DESCRIPTION' => 'PRICEBOOK_DESCRIPTION',
        'pricebook_description' => 'PRICEBOOK_DESCRIPTION',
        'pricebooks.pricebook_description' => 'PRICEBOOK_DESCRIPTION',
        'PricebookCode' => 'PRICEBOOK_CODE',
        'Pricebooks.PricebookCode' => 'PRICEBOOK_CODE',
        'pricebookCode' => 'PRICEBOOK_CODE',
        'pricebooks.pricebookCode' => 'PRICEBOOK_CODE',
        'PricebooksTableMap::COL_PRICEBOOK_CODE' => 'PRICEBOOK_CODE',
        'COL_PRICEBOOK_CODE' => 'PRICEBOOK_CODE',
        'pricebook_code' => 'PRICEBOOK_CODE',
        'pricebooks.pricebook_code' => 'PRICEBOOK_CODE',
        'CompanyId' => 'COMPANY_ID',
        'Pricebooks.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'pricebooks.companyId' => 'COMPANY_ID',
        'PricebooksTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'pricebooks.company_id' => 'COMPANY_ID',
        'OrgId' => 'ORG_ID',
        'Pricebooks.OrgId' => 'ORG_ID',
        'orgId' => 'ORG_ID',
        'pricebooks.orgId' => 'ORG_ID',
        'PricebooksTableMap::COL_ORG_ID' => 'ORG_ID',
        'COL_ORG_ID' => 'ORG_ID',
        'org_id' => 'ORG_ID',
        'pricebooks.org_id' => 'ORG_ID',
        'IntegrationId' => 'INTEGRATION_ID',
        'Pricebooks.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'pricebooks.integrationId' => 'INTEGRATION_ID',
        'PricebooksTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'pricebooks.integration_id' => 'INTEGRATION_ID',
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
        $this->setName('pricebooks');
        $this->setPhpName('Pricebooks');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Pricebooks');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pricebooks_pricebook_id_seq');
        // columns
        $this->addPrimaryKey('pricebook_id', 'PricebookId', 'INTEGER', true, null, null);
        $this->addColumn('pricebook_name', 'PricebookName', 'VARCHAR', true, 50, null);
        $this->addColumn('pricebook_description', 'PricebookDescription', 'VARCHAR', false, 200, null);
        $this->addColumn('pricebook_code', 'PricebookCode', 'VARCHAR', false, 255, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('org_id', 'OrgId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
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
    0 => ':org_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OnBoardRequestOutletMapping', '\\entities\\OnBoardRequestOutletMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
  ),
), null, null, 'OnBoardRequestOutletMappings', false);
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('OutletMapping', '\\entities\\OutletMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
  ),
), null, null, 'OutletMappings', false);
        $this->addRelation('Pricebooklines', '\\entities\\Pricebooklines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pricebook_id',
    1 => ':pricebook_id',
  ),
), null, null, 'Pricebookliness', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PricebookId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PricebooksTableMap::CLASS_DEFAULT : PricebooksTableMap::OM_CLASS;
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
     * @return array (Pricebooks object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PricebooksTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PricebooksTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PricebooksTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PricebooksTableMap::OM_CLASS;
            /** @var Pricebooks $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PricebooksTableMap::addInstanceToPool($obj, $key);
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
            $key = PricebooksTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PricebooksTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pricebooks $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PricebooksTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PricebooksTableMap::COL_PRICEBOOK_ID);
            $criteria->addSelectColumn(PricebooksTableMap::COL_PRICEBOOK_NAME);
            $criteria->addSelectColumn(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION);
            $criteria->addSelectColumn(PricebooksTableMap::COL_PRICEBOOK_CODE);
            $criteria->addSelectColumn(PricebooksTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PricebooksTableMap::COL_ORG_ID);
            $criteria->addSelectColumn(PricebooksTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.pricebook_id');
            $criteria->addSelectColumn($alias . '.pricebook_name');
            $criteria->addSelectColumn($alias . '.pricebook_description');
            $criteria->addSelectColumn($alias . '.pricebook_code');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.org_id');
            $criteria->addSelectColumn($alias . '.integration_id');
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
            $criteria->removeSelectColumn(PricebooksTableMap::COL_PRICEBOOK_ID);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_PRICEBOOK_NAME);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_PRICEBOOK_DESCRIPTION);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_PRICEBOOK_CODE);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_ORG_ID);
            $criteria->removeSelectColumn(PricebooksTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.pricebook_id');
            $criteria->removeSelectColumn($alias . '.pricebook_name');
            $criteria->removeSelectColumn($alias . '.pricebook_description');
            $criteria->removeSelectColumn($alias . '.pricebook_code');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.org_id');
            $criteria->removeSelectColumn($alias . '.integration_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PricebooksTableMap::DATABASE_NAME)->getTable(PricebooksTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pricebooks or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Pricebooks object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Pricebooks) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PricebooksTableMap::DATABASE_NAME);
            $criteria->add(PricebooksTableMap::COL_PRICEBOOK_ID, (array) $values, Criteria::IN);
        }

        $query = PricebooksQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PricebooksTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PricebooksTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pricebooks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PricebooksQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pricebooks or Criteria object.
     *
     * @param mixed $criteria Criteria or Pricebooks object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PricebooksTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pricebooks object
        }

        if ($criteria->containsKey(PricebooksTableMap::COL_PRICEBOOK_ID) && $criteria->keyContainsValue(PricebooksTableMap::COL_PRICEBOOK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PricebooksTableMap::COL_PRICEBOOK_ID.')');
        }


        // Set the correct dbName
        $query = PricebooksQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\OutletContributionPotential;
use entities\OutletContributionPotentialQuery;


/**
 * This class defines the structure of the 'outlet_contribution_potential' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletContributionPotentialTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletContributionPotentialTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_contribution_potential';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletContributionPotential';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletContributionPotential';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletContributionPotential';

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
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_contribution_potential.outlet_id';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'outlet_contribution_potential.rcpa_moye';

    /**
     * the column name for the contribution field
     */
    public const COL_CONTRIBUTION = 'outlet_contribution_potential.contribution';

    /**
     * the column name for the other field
     */
    public const COL_OTHER = 'outlet_contribution_potential.other';

    /**
     * the column name for the potential field
     */
    public const COL_POTENTIAL = 'outlet_contribution_potential.potential';

    /**
     * the column name for the contributionValue field
     */
    public const COL_CONTRIBUTIONVALUE = 'outlet_contribution_potential.contributionValue';

    /**
     * the column name for the otherValue field
     */
    public const COL_OTHERVALUE = 'outlet_contribution_potential.otherValue';

    /**
     * the column name for the potentialValue field
     */
    public const COL_POTENTIALVALUE = 'outlet_contribution_potential.potentialValue';

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
        self::TYPE_PHPNAME       => ['OutletId', 'RcpaMoye', 'Contribution', 'Other', 'Potential', 'ContributionValue', 'OtherValue', 'PotentialValue', ],
        self::TYPE_CAMELNAME     => ['outletId', 'rcpaMoye', 'contribution', 'other', 'potential', 'contributionValue', 'otherValue', 'potentialValue', ],
        self::TYPE_COLNAME       => [OutletContributionPotentialTableMap::COL_OUTLET_ID, OutletContributionPotentialTableMap::COL_RCPA_MOYE, OutletContributionPotentialTableMap::COL_CONTRIBUTION, OutletContributionPotentialTableMap::COL_OTHER, OutletContributionPotentialTableMap::COL_POTENTIAL, OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE, OutletContributionPotentialTableMap::COL_OTHERVALUE, OutletContributionPotentialTableMap::COL_POTENTIALVALUE, ],
        self::TYPE_FIELDNAME     => ['outlet_id', 'rcpa_moye', 'contribution', 'other', 'potential', 'contributionValue', 'otherValue', 'potentialValue', ],
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
        self::TYPE_PHPNAME       => ['OutletId' => 0, 'RcpaMoye' => 1, 'Contribution' => 2, 'Other' => 3, 'Potential' => 4, 'ContributionValue' => 5, 'OtherValue' => 6, 'PotentialValue' => 7, ],
        self::TYPE_CAMELNAME     => ['outletId' => 0, 'rcpaMoye' => 1, 'contribution' => 2, 'other' => 3, 'potential' => 4, 'contributionValue' => 5, 'otherValue' => 6, 'potentialValue' => 7, ],
        self::TYPE_COLNAME       => [OutletContributionPotentialTableMap::COL_OUTLET_ID => 0, OutletContributionPotentialTableMap::COL_RCPA_MOYE => 1, OutletContributionPotentialTableMap::COL_CONTRIBUTION => 2, OutletContributionPotentialTableMap::COL_OTHER => 3, OutletContributionPotentialTableMap::COL_POTENTIAL => 4, OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE => 5, OutletContributionPotentialTableMap::COL_OTHERVALUE => 6, OutletContributionPotentialTableMap::COL_POTENTIALVALUE => 7, ],
        self::TYPE_FIELDNAME     => ['outlet_id' => 0, 'rcpa_moye' => 1, 'contribution' => 2, 'other' => 3, 'potential' => 4, 'contributionValue' => 5, 'otherValue' => 6, 'potentialValue' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletId' => 'OUTLET_ID',
        'OutletContributionPotential.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletContributionPotential.outletId' => 'OUTLET_ID',
        'OutletContributionPotentialTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_contribution_potential.outlet_id' => 'OUTLET_ID',
        'RcpaMoye' => 'RCPA_MOYE',
        'OutletContributionPotential.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'outletContributionPotential.rcpaMoye' => 'RCPA_MOYE',
        'OutletContributionPotentialTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'outlet_contribution_potential.rcpa_moye' => 'RCPA_MOYE',
        'Contribution' => 'CONTRIBUTION',
        'OutletContributionPotential.Contribution' => 'CONTRIBUTION',
        'contribution' => 'CONTRIBUTION',
        'outletContributionPotential.contribution' => 'CONTRIBUTION',
        'OutletContributionPotentialTableMap::COL_CONTRIBUTION' => 'CONTRIBUTION',
        'COL_CONTRIBUTION' => 'CONTRIBUTION',
        'outlet_contribution_potential.contribution' => 'CONTRIBUTION',
        'Other' => 'OTHER',
        'OutletContributionPotential.Other' => 'OTHER',
        'other' => 'OTHER',
        'outletContributionPotential.other' => 'OTHER',
        'OutletContributionPotentialTableMap::COL_OTHER' => 'OTHER',
        'COL_OTHER' => 'OTHER',
        'outlet_contribution_potential.other' => 'OTHER',
        'Potential' => 'POTENTIAL',
        'OutletContributionPotential.Potential' => 'POTENTIAL',
        'potential' => 'POTENTIAL',
        'outletContributionPotential.potential' => 'POTENTIAL',
        'OutletContributionPotentialTableMap::COL_POTENTIAL' => 'POTENTIAL',
        'COL_POTENTIAL' => 'POTENTIAL',
        'outlet_contribution_potential.potential' => 'POTENTIAL',
        'ContributionValue' => 'CONTRIBUTIONVALUE',
        'OutletContributionPotential.ContributionValue' => 'CONTRIBUTIONVALUE',
        'contributionValue' => 'CONTRIBUTIONVALUE',
        'outletContributionPotential.contributionValue' => 'CONTRIBUTIONVALUE',
        'OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE' => 'CONTRIBUTIONVALUE',
        'COL_CONTRIBUTIONVALUE' => 'CONTRIBUTIONVALUE',
        'outlet_contribution_potential.contributionValue' => 'CONTRIBUTIONVALUE',
        'OtherValue' => 'OTHERVALUE',
        'OutletContributionPotential.OtherValue' => 'OTHERVALUE',
        'otherValue' => 'OTHERVALUE',
        'outletContributionPotential.otherValue' => 'OTHERVALUE',
        'OutletContributionPotentialTableMap::COL_OTHERVALUE' => 'OTHERVALUE',
        'COL_OTHERVALUE' => 'OTHERVALUE',
        'outlet_contribution_potential.otherValue' => 'OTHERVALUE',
        'PotentialValue' => 'POTENTIALVALUE',
        'OutletContributionPotential.PotentialValue' => 'POTENTIALVALUE',
        'potentialValue' => 'POTENTIALVALUE',
        'outletContributionPotential.potentialValue' => 'POTENTIALVALUE',
        'OutletContributionPotentialTableMap::COL_POTENTIALVALUE' => 'POTENTIALVALUE',
        'COL_POTENTIALVALUE' => 'POTENTIALVALUE',
        'outlet_contribution_potential.potentialValue' => 'POTENTIALVALUE',
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
        $this->setName('outlet_contribution_potential');
        $this->setPhpName('OutletContributionPotential');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletContributionPotential');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, 50, null);
        $this->addColumn('contribution', 'Contribution', 'INTEGER', false, null, null);
        $this->addColumn('other', 'Other', 'INTEGER', false, null, null);
        $this->addColumn('potential', 'Potential', 'INTEGER', false, null, null);
        $this->addColumn('contributionValue', 'ContributionValue', 'DECIMAL', false, null, null);
        $this->addColumn('otherValue', 'OtherValue', 'DECIMAL', false, null, null);
        $this->addColumn('potentialValue', 'PotentialValue', 'DECIMAL', false, null, null);
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
        return $withPrefix ? OutletContributionPotentialTableMap::CLASS_DEFAULT : OutletContributionPotentialTableMap::OM_CLASS;
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
     * @return array (OutletContributionPotential object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletContributionPotentialTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletContributionPotentialTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletContributionPotentialTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletContributionPotentialTableMap::OM_CLASS;
            /** @var OutletContributionPotential $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletContributionPotentialTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletContributionPotentialTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletContributionPotentialTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletContributionPotential $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletContributionPotentialTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_CONTRIBUTION);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_OTHER);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_POTENTIAL);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_OTHERVALUE);
            $criteria->addSelectColumn(OutletContributionPotentialTableMap::COL_POTENTIALVALUE);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.rcpa_moye');
            $criteria->addSelectColumn($alias . '.contribution');
            $criteria->addSelectColumn($alias . '.other');
            $criteria->addSelectColumn($alias . '.potential');
            $criteria->addSelectColumn($alias . '.contributionValue');
            $criteria->addSelectColumn($alias . '.otherValue');
            $criteria->addSelectColumn($alias . '.potentialValue');
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
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_CONTRIBUTION);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_OTHER);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_POTENTIAL);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_CONTRIBUTIONVALUE);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_OTHERVALUE);
            $criteria->removeSelectColumn(OutletContributionPotentialTableMap::COL_POTENTIALVALUE);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.rcpa_moye');
            $criteria->removeSelectColumn($alias . '.contribution');
            $criteria->removeSelectColumn($alias . '.other');
            $criteria->removeSelectColumn($alias . '.potential');
            $criteria->removeSelectColumn($alias . '.contributionValue');
            $criteria->removeSelectColumn($alias . '.otherValue');
            $criteria->removeSelectColumn($alias . '.potentialValue');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletContributionPotentialTableMap::DATABASE_NAME)->getTable(OutletContributionPotentialTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletContributionPotential or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletContributionPotential object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletContributionPotentialTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletContributionPotential) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The OutletContributionPotential object has no primary key');
        }

        $query = OutletContributionPotentialQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletContributionPotentialTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletContributionPotentialTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_contribution_potential table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletContributionPotentialQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletContributionPotential or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletContributionPotential object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletContributionPotentialTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletContributionPotential object
        }


        // Set the correct dbName
        $query = OutletContributionPotentialQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

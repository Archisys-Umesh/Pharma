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
use entities\Stp;
use entities\StpQuery;


/**
 * This class defines the structure of the 'stp' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StpTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.StpTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stp';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Stp';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Stp';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Stp';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the stp_id field
     */
    public const COL_STP_ID = 'stp.stp_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'stp.position_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'stp.company_id';

    /**
     * the column name for the stp_status field
     */
    public const COL_STP_STATUS = 'stp.stp_status';

    /**
     * the column name for the stp_approved_by field
     */
    public const COL_STP_APPROVED_BY = 'stp.stp_approved_by';

    /**
     * the column name for the approved_date field
     */
    public const COL_APPROVED_DATE = 'stp.approved_date';

    /**
     * the column name for the rejected_reason field
     */
    public const COL_REJECTED_REASON = 'stp.rejected_reason';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'stp.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'stp.updated_at';

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
        self::TYPE_PHPNAME       => ['StpId', 'PositionId', 'CompanyId', 'StpStatus', 'StpApprovedBy', 'ApprovedDate', 'RejectedReason', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['stpId', 'positionId', 'companyId', 'stpStatus', 'stpApprovedBy', 'approvedDate', 'rejectedReason', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [StpTableMap::COL_STP_ID, StpTableMap::COL_POSITION_ID, StpTableMap::COL_COMPANY_ID, StpTableMap::COL_STP_STATUS, StpTableMap::COL_STP_APPROVED_BY, StpTableMap::COL_APPROVED_DATE, StpTableMap::COL_REJECTED_REASON, StpTableMap::COL_CREATED_AT, StpTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['stp_id', 'position_id', 'company_id', 'stp_status', 'stp_approved_by', 'approved_date', 'rejected_reason', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['StpId' => 0, 'PositionId' => 1, 'CompanyId' => 2, 'StpStatus' => 3, 'StpApprovedBy' => 4, 'ApprovedDate' => 5, 'RejectedReason' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['stpId' => 0, 'positionId' => 1, 'companyId' => 2, 'stpStatus' => 3, 'stpApprovedBy' => 4, 'approvedDate' => 5, 'rejectedReason' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [StpTableMap::COL_STP_ID => 0, StpTableMap::COL_POSITION_ID => 1, StpTableMap::COL_COMPANY_ID => 2, StpTableMap::COL_STP_STATUS => 3, StpTableMap::COL_STP_APPROVED_BY => 4, StpTableMap::COL_APPROVED_DATE => 5, StpTableMap::COL_REJECTED_REASON => 6, StpTableMap::COL_CREATED_AT => 7, StpTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['stp_id' => 0, 'position_id' => 1, 'company_id' => 2, 'stp_status' => 3, 'stp_approved_by' => 4, 'approved_date' => 5, 'rejected_reason' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'StpId' => 'STP_ID',
        'Stp.StpId' => 'STP_ID',
        'stpId' => 'STP_ID',
        'stp.stpId' => 'STP_ID',
        'StpTableMap::COL_STP_ID' => 'STP_ID',
        'COL_STP_ID' => 'STP_ID',
        'stp_id' => 'STP_ID',
        'stp.stp_id' => 'STP_ID',
        'PositionId' => 'POSITION_ID',
        'Stp.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'stp.positionId' => 'POSITION_ID',
        'StpTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'stp.position_id' => 'POSITION_ID',
        'CompanyId' => 'COMPANY_ID',
        'Stp.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'stp.companyId' => 'COMPANY_ID',
        'StpTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'stp.company_id' => 'COMPANY_ID',
        'StpStatus' => 'STP_STATUS',
        'Stp.StpStatus' => 'STP_STATUS',
        'stpStatus' => 'STP_STATUS',
        'stp.stpStatus' => 'STP_STATUS',
        'StpTableMap::COL_STP_STATUS' => 'STP_STATUS',
        'COL_STP_STATUS' => 'STP_STATUS',
        'stp_status' => 'STP_STATUS',
        'stp.stp_status' => 'STP_STATUS',
        'StpApprovedBy' => 'STP_APPROVED_BY',
        'Stp.StpApprovedBy' => 'STP_APPROVED_BY',
        'stpApprovedBy' => 'STP_APPROVED_BY',
        'stp.stpApprovedBy' => 'STP_APPROVED_BY',
        'StpTableMap::COL_STP_APPROVED_BY' => 'STP_APPROVED_BY',
        'COL_STP_APPROVED_BY' => 'STP_APPROVED_BY',
        'stp_approved_by' => 'STP_APPROVED_BY',
        'stp.stp_approved_by' => 'STP_APPROVED_BY',
        'ApprovedDate' => 'APPROVED_DATE',
        'Stp.ApprovedDate' => 'APPROVED_DATE',
        'approvedDate' => 'APPROVED_DATE',
        'stp.approvedDate' => 'APPROVED_DATE',
        'StpTableMap::COL_APPROVED_DATE' => 'APPROVED_DATE',
        'COL_APPROVED_DATE' => 'APPROVED_DATE',
        'approved_date' => 'APPROVED_DATE',
        'stp.approved_date' => 'APPROVED_DATE',
        'RejectedReason' => 'REJECTED_REASON',
        'Stp.RejectedReason' => 'REJECTED_REASON',
        'rejectedReason' => 'REJECTED_REASON',
        'stp.rejectedReason' => 'REJECTED_REASON',
        'StpTableMap::COL_REJECTED_REASON' => 'REJECTED_REASON',
        'COL_REJECTED_REASON' => 'REJECTED_REASON',
        'rejected_reason' => 'REJECTED_REASON',
        'stp.rejected_reason' => 'REJECTED_REASON',
        'CreatedAt' => 'CREATED_AT',
        'Stp.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'stp.createdAt' => 'CREATED_AT',
        'StpTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'stp.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Stp.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'stp.updatedAt' => 'UPDATED_AT',
        'StpTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'stp.updated_at' => 'UPDATED_AT',
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
        $this->setName('stp');
        $this->setPhpName('Stp');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Stp');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('stp_stp_id_seq');
        // columns
        $this->addPrimaryKey('stp_id', 'StpId', 'INTEGER', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('stp_status', 'StpStatus', 'VARCHAR', false, null, null);
        $this->addColumn('stp_approved_by', 'StpApprovedBy', 'INTEGER', false, null, null);
        $this->addColumn('approved_date', 'ApprovedDate', 'DATE', false, null, null);
        $this->addColumn('rejected_reason', 'RejectedReason', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('StpWeek', '\\entities\\StpWeek', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stp_id',
    1 => ':stp_id',
  ),
), null, null, 'StpWeeks', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('StpId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? StpTableMap::CLASS_DEFAULT : StpTableMap::OM_CLASS;
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
     * @return array (Stp object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StpTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StpTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StpTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StpTableMap::OM_CLASS;
            /** @var Stp $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StpTableMap::addInstanceToPool($obj, $key);
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
            $key = StpTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StpTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Stp $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StpTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StpTableMap::COL_STP_ID);
            $criteria->addSelectColumn(StpTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(StpTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(StpTableMap::COL_STP_STATUS);
            $criteria->addSelectColumn(StpTableMap::COL_STP_APPROVED_BY);
            $criteria->addSelectColumn(StpTableMap::COL_APPROVED_DATE);
            $criteria->addSelectColumn(StpTableMap::COL_REJECTED_REASON);
            $criteria->addSelectColumn(StpTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(StpTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.stp_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.stp_status');
            $criteria->addSelectColumn($alias . '.stp_approved_by');
            $criteria->addSelectColumn($alias . '.approved_date');
            $criteria->addSelectColumn($alias . '.rejected_reason');
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
            $criteria->removeSelectColumn(StpTableMap::COL_STP_ID);
            $criteria->removeSelectColumn(StpTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(StpTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(StpTableMap::COL_STP_STATUS);
            $criteria->removeSelectColumn(StpTableMap::COL_STP_APPROVED_BY);
            $criteria->removeSelectColumn(StpTableMap::COL_APPROVED_DATE);
            $criteria->removeSelectColumn(StpTableMap::COL_REJECTED_REASON);
            $criteria->removeSelectColumn(StpTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(StpTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.stp_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.stp_status');
            $criteria->removeSelectColumn($alias . '.stp_approved_by');
            $criteria->removeSelectColumn($alias . '.approved_date');
            $criteria->removeSelectColumn($alias . '.rejected_reason');
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
        return Propel::getServiceContainer()->getDatabaseMap(StpTableMap::DATABASE_NAME)->getTable(StpTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Stp or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Stp object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Stp) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StpTableMap::DATABASE_NAME);
            $criteria->add(StpTableMap::COL_STP_ID, (array) $values, Criteria::IN);
        }

        $query = StpQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StpTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StpTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StpQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Stp or Criteria object.
     *
     * @param mixed $criteria Criteria or Stp object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StpTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Stp object
        }

        if ($criteria->containsKey(StpTableMap::COL_STP_ID) && $criteria->keyContainsValue(StpTableMap::COL_STP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StpTableMap::COL_STP_ID.')');
        }


        // Set the correct dbName
        $query = StpQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

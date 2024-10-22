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
use entities\Gifts;
use entities\GiftsQuery;


/**
 * This class defines the structure of the 'gifts' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GiftsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GiftsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'gifts';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Gifts';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Gifts';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Gifts';

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
     * the column name for the id field
     */
    public const COL_ID = 'gifts.id';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'gifts.title';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'gifts.description';

    /**
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'gifts.media_id';

    /**
     * the column name for the offersid field
     */
    public const COL_OFFERSID = 'gifts.offersid';

    /**
     * the column name for the startdate field
     */
    public const COL_STARTDATE = 'gifts.startdate';

    /**
     * the column name for the enddate field
     */
    public const COL_ENDDATE = 'gifts.enddate';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'gifts.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'gifts.updated_at';

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
        self::TYPE_PHPNAME       => ['Id', 'Title', 'Description', 'MediaId', 'Offersid', 'Startdate', 'Enddate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['id', 'title', 'description', 'mediaId', 'offersid', 'startdate', 'enddate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [GiftsTableMap::COL_ID, GiftsTableMap::COL_TITLE, GiftsTableMap::COL_DESCRIPTION, GiftsTableMap::COL_MEDIA_ID, GiftsTableMap::COL_OFFERSID, GiftsTableMap::COL_STARTDATE, GiftsTableMap::COL_ENDDATE, GiftsTableMap::COL_CREATED_AT, GiftsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id', 'title', 'description', 'media_id', 'offersid', 'startdate', 'enddate', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Title' => 1, 'Description' => 2, 'MediaId' => 3, 'Offersid' => 4, 'Startdate' => 5, 'Enddate' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'title' => 1, 'description' => 2, 'mediaId' => 3, 'offersid' => 4, 'startdate' => 5, 'enddate' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [GiftsTableMap::COL_ID => 0, GiftsTableMap::COL_TITLE => 1, GiftsTableMap::COL_DESCRIPTION => 2, GiftsTableMap::COL_MEDIA_ID => 3, GiftsTableMap::COL_OFFERSID => 4, GiftsTableMap::COL_STARTDATE => 5, GiftsTableMap::COL_ENDDATE => 6, GiftsTableMap::COL_CREATED_AT => 7, GiftsTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'title' => 1, 'description' => 2, 'media_id' => 3, 'offersid' => 4, 'startdate' => 5, 'enddate' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Gifts.Id' => 'ID',
        'id' => 'ID',
        'gifts.id' => 'ID',
        'GiftsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Title' => 'TITLE',
        'Gifts.Title' => 'TITLE',
        'title' => 'TITLE',
        'gifts.title' => 'TITLE',
        'GiftsTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'Description' => 'DESCRIPTION',
        'Gifts.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'gifts.description' => 'DESCRIPTION',
        'GiftsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'MediaId' => 'MEDIA_ID',
        'Gifts.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'gifts.mediaId' => 'MEDIA_ID',
        'GiftsTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'gifts.media_id' => 'MEDIA_ID',
        'Offersid' => 'OFFERSID',
        'Gifts.Offersid' => 'OFFERSID',
        'offersid' => 'OFFERSID',
        'gifts.offersid' => 'OFFERSID',
        'GiftsTableMap::COL_OFFERSID' => 'OFFERSID',
        'COL_OFFERSID' => 'OFFERSID',
        'Startdate' => 'STARTDATE',
        'Gifts.Startdate' => 'STARTDATE',
        'startdate' => 'STARTDATE',
        'gifts.startdate' => 'STARTDATE',
        'GiftsTableMap::COL_STARTDATE' => 'STARTDATE',
        'COL_STARTDATE' => 'STARTDATE',
        'Enddate' => 'ENDDATE',
        'Gifts.Enddate' => 'ENDDATE',
        'enddate' => 'ENDDATE',
        'gifts.enddate' => 'ENDDATE',
        'GiftsTableMap::COL_ENDDATE' => 'ENDDATE',
        'COL_ENDDATE' => 'ENDDATE',
        'CreatedAt' => 'CREATED_AT',
        'Gifts.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'gifts.createdAt' => 'CREATED_AT',
        'GiftsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'gifts.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Gifts.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'gifts.updatedAt' => 'UPDATED_AT',
        'GiftsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'gifts.updated_at' => 'UPDATED_AT',
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
        $this->setName('gifts');
        $this->setPhpName('Gifts');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Gifts');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('gifts_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 50, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('media_id', 'MediaId', 'INTEGER', 'media_files', 'media_id', false, null, null);
        $this->addForeignKey('offersid', 'Offersid', 'INTEGER', 'offers', 'id', false, null, null);
        $this->addColumn('startdate', 'Startdate', 'DATE', false, null, null);
        $this->addColumn('enddate', 'Enddate', 'DATE', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), null, null, null, false);
        $this->addRelation('Offers', '\\entities\\Offers', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':offersid',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? GiftsTableMap::CLASS_DEFAULT : GiftsTableMap::OM_CLASS;
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
     * @return array (Gifts object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GiftsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GiftsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GiftsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GiftsTableMap::OM_CLASS;
            /** @var Gifts $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GiftsTableMap::addInstanceToPool($obj, $key);
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
            $key = GiftsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GiftsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Gifts $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GiftsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GiftsTableMap::COL_ID);
            $criteria->addSelectColumn(GiftsTableMap::COL_TITLE);
            $criteria->addSelectColumn(GiftsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(GiftsTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(GiftsTableMap::COL_OFFERSID);
            $criteria->addSelectColumn(GiftsTableMap::COL_STARTDATE);
            $criteria->addSelectColumn(GiftsTableMap::COL_ENDDATE);
            $criteria->addSelectColumn(GiftsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(GiftsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.offersid');
            $criteria->addSelectColumn($alias . '.startdate');
            $criteria->addSelectColumn($alias . '.enddate');
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
            $criteria->removeSelectColumn(GiftsTableMap::COL_ID);
            $criteria->removeSelectColumn(GiftsTableMap::COL_TITLE);
            $criteria->removeSelectColumn(GiftsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(GiftsTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(GiftsTableMap::COL_OFFERSID);
            $criteria->removeSelectColumn(GiftsTableMap::COL_STARTDATE);
            $criteria->removeSelectColumn(GiftsTableMap::COL_ENDDATE);
            $criteria->removeSelectColumn(GiftsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(GiftsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.offersid');
            $criteria->removeSelectColumn($alias . '.startdate');
            $criteria->removeSelectColumn($alias . '.enddate');
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
        return Propel::getServiceContainer()->getDatabaseMap(GiftsTableMap::DATABASE_NAME)->getTable(GiftsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Gifts or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Gifts object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GiftsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Gifts) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GiftsTableMap::DATABASE_NAME);
            $criteria->add(GiftsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = GiftsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GiftsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GiftsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the gifts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GiftsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Gifts or Criteria object.
     *
     * @param mixed $criteria Criteria or Gifts object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GiftsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Gifts object
        }

        if ($criteria->containsKey(GiftsTableMap::COL_ID) && $criteria->keyContainsValue(GiftsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GiftsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = GiftsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

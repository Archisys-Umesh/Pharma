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
use entities\Language;
use entities\LanguageQuery;


/**
 * This class defines the structure of the 'language' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class LanguageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.LanguageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'language';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Language';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Language';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Language';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the language_id field
     */
    public const COL_LANGUAGE_ID = 'language.language_id';

    /**
     * the column name for the language_name field
     */
    public const COL_LANGUAGE_NAME = 'language.language_name';

    /**
     * the column name for the language_code field
     */
    public const COL_LANGUAGE_CODE = 'language.language_code';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'language.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'language.updated_at';

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
        self::TYPE_PHPNAME       => ['LanguageId', 'LanguageName', 'LanguageCode', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['languageId', 'languageName', 'languageCode', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [LanguageTableMap::COL_LANGUAGE_ID, LanguageTableMap::COL_LANGUAGE_NAME, LanguageTableMap::COL_LANGUAGE_CODE, LanguageTableMap::COL_CREATED_AT, LanguageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['language_id', 'language_name', 'language_code', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['LanguageId' => 0, 'LanguageName' => 1, 'LanguageCode' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['languageId' => 0, 'languageName' => 1, 'languageCode' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [LanguageTableMap::COL_LANGUAGE_ID => 0, LanguageTableMap::COL_LANGUAGE_NAME => 1, LanguageTableMap::COL_LANGUAGE_CODE => 2, LanguageTableMap::COL_CREATED_AT => 3, LanguageTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['language_id' => 0, 'language_name' => 1, 'language_code' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LanguageId' => 'LANGUAGE_ID',
        'Language.LanguageId' => 'LANGUAGE_ID',
        'languageId' => 'LANGUAGE_ID',
        'language.languageId' => 'LANGUAGE_ID',
        'LanguageTableMap::COL_LANGUAGE_ID' => 'LANGUAGE_ID',
        'COL_LANGUAGE_ID' => 'LANGUAGE_ID',
        'language_id' => 'LANGUAGE_ID',
        'language.language_id' => 'LANGUAGE_ID',
        'LanguageName' => 'LANGUAGE_NAME',
        'Language.LanguageName' => 'LANGUAGE_NAME',
        'languageName' => 'LANGUAGE_NAME',
        'language.languageName' => 'LANGUAGE_NAME',
        'LanguageTableMap::COL_LANGUAGE_NAME' => 'LANGUAGE_NAME',
        'COL_LANGUAGE_NAME' => 'LANGUAGE_NAME',
        'language_name' => 'LANGUAGE_NAME',
        'language.language_name' => 'LANGUAGE_NAME',
        'LanguageCode' => 'LANGUAGE_CODE',
        'Language.LanguageCode' => 'LANGUAGE_CODE',
        'languageCode' => 'LANGUAGE_CODE',
        'language.languageCode' => 'LANGUAGE_CODE',
        'LanguageTableMap::COL_LANGUAGE_CODE' => 'LANGUAGE_CODE',
        'COL_LANGUAGE_CODE' => 'LANGUAGE_CODE',
        'language_code' => 'LANGUAGE_CODE',
        'language.language_code' => 'LANGUAGE_CODE',
        'CreatedAt' => 'CREATED_AT',
        'Language.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'language.createdAt' => 'CREATED_AT',
        'LanguageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'language.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Language.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'language.updatedAt' => 'UPDATED_AT',
        'LanguageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'language.updated_at' => 'UPDATED_AT',
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
        $this->setName('language');
        $this->setPhpName('Language');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Language');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('language_language_id_seq');
        // columns
        $this->addPrimaryKey('language_id', 'LanguageId', 'INTEGER', true, null, null);
        $this->addColumn('language_name', 'LanguageName', 'VARCHAR', false, null, null);
        $this->addColumn('language_code', 'LanguageCode', 'VARCHAR', false, null, null);
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
        $this->addRelation('EdPresentations', '\\entities\\EdPresentations', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':presentation_language_id',
    1 => ':language_id',
  ),
), null, null, 'EdPresentationss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LanguageId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? LanguageTableMap::CLASS_DEFAULT : LanguageTableMap::OM_CLASS;
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
     * @return array (Language object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = LanguageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LanguageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LanguageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LanguageTableMap::OM_CLASS;
            /** @var Language $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LanguageTableMap::addInstanceToPool($obj, $key);
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
            $key = LanguageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LanguageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Language $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LanguageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LanguageTableMap::COL_LANGUAGE_ID);
            $criteria->addSelectColumn(LanguageTableMap::COL_LANGUAGE_NAME);
            $criteria->addSelectColumn(LanguageTableMap::COL_LANGUAGE_CODE);
            $criteria->addSelectColumn(LanguageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LanguageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.language_id');
            $criteria->addSelectColumn($alias . '.language_name');
            $criteria->addSelectColumn($alias . '.language_code');
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
            $criteria->removeSelectColumn(LanguageTableMap::COL_LANGUAGE_ID);
            $criteria->removeSelectColumn(LanguageTableMap::COL_LANGUAGE_NAME);
            $criteria->removeSelectColumn(LanguageTableMap::COL_LANGUAGE_CODE);
            $criteria->removeSelectColumn(LanguageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(LanguageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.language_id');
            $criteria->removeSelectColumn($alias . '.language_name');
            $criteria->removeSelectColumn($alias . '.language_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(LanguageTableMap::DATABASE_NAME)->getTable(LanguageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Language or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Language object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Language) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LanguageTableMap::DATABASE_NAME);
            $criteria->add(LanguageTableMap::COL_LANGUAGE_ID, (array) $values, Criteria::IN);
        }

        $query = LanguageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LanguageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LanguageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the language table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return LanguageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Language or Criteria object.
     *
     * @param mixed $criteria Criteria or Language object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Language object
        }

        if ($criteria->containsKey(LanguageTableMap::COL_LANGUAGE_ID) && $criteria->keyContainsValue(LanguageTableMap::COL_LANGUAGE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LanguageTableMap::COL_LANGUAGE_ID.')');
        }


        // Set the correct dbName
        $query = LanguageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

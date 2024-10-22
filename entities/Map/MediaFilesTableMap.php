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
use entities\MediaFiles;
use entities\MediaFilesQuery;


/**
 * This class defines the structure of the 'media_files' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MediaFilesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MediaFilesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'media_files';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MediaFiles';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MediaFiles';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MediaFiles';

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
     * the column name for the media_id field
     */
    public const COL_MEDIA_ID = 'media_files.media_id';

    /**
     * the column name for the media_name field
     */
    public const COL_MEDIA_NAME = 'media_files.media_name';

    /**
     * the column name for the media_mime field
     */
    public const COL_MEDIA_MIME = 'media_files.media_mime';

    /**
     * the column name for the media_data field
     */
    public const COL_MEDIA_DATA = 'media_files.media_data';

    /**
     * the column name for the folder_id field
     */
    public const COL_FOLDER_ID = 'media_files.folder_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'media_files.company_id';

    /**
     * the column name for the iss3file field
     */
    public const COL_ISS3FILE = 'media_files.iss3file';

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
        self::TYPE_PHPNAME       => ['MediaId', 'MediaName', 'MediaMime', 'MediaData', 'FolderId', 'CompanyId', 'Iss3file', ],
        self::TYPE_CAMELNAME     => ['mediaId', 'mediaName', 'mediaMime', 'mediaData', 'folderId', 'companyId', 'iss3file', ],
        self::TYPE_COLNAME       => [MediaFilesTableMap::COL_MEDIA_ID, MediaFilesTableMap::COL_MEDIA_NAME, MediaFilesTableMap::COL_MEDIA_MIME, MediaFilesTableMap::COL_MEDIA_DATA, MediaFilesTableMap::COL_FOLDER_ID, MediaFilesTableMap::COL_COMPANY_ID, MediaFilesTableMap::COL_ISS3FILE, ],
        self::TYPE_FIELDNAME     => ['media_id', 'media_name', 'media_mime', 'media_data', 'folder_id', 'company_id', 'iss3file', ],
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
        self::TYPE_PHPNAME       => ['MediaId' => 0, 'MediaName' => 1, 'MediaMime' => 2, 'MediaData' => 3, 'FolderId' => 4, 'CompanyId' => 5, 'Iss3file' => 6, ],
        self::TYPE_CAMELNAME     => ['mediaId' => 0, 'mediaName' => 1, 'mediaMime' => 2, 'mediaData' => 3, 'folderId' => 4, 'companyId' => 5, 'iss3file' => 6, ],
        self::TYPE_COLNAME       => [MediaFilesTableMap::COL_MEDIA_ID => 0, MediaFilesTableMap::COL_MEDIA_NAME => 1, MediaFilesTableMap::COL_MEDIA_MIME => 2, MediaFilesTableMap::COL_MEDIA_DATA => 3, MediaFilesTableMap::COL_FOLDER_ID => 4, MediaFilesTableMap::COL_COMPANY_ID => 5, MediaFilesTableMap::COL_ISS3FILE => 6, ],
        self::TYPE_FIELDNAME     => ['media_id' => 0, 'media_name' => 1, 'media_mime' => 2, 'media_data' => 3, 'folder_id' => 4, 'company_id' => 5, 'iss3file' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MediaId' => 'MEDIA_ID',
        'MediaFiles.MediaId' => 'MEDIA_ID',
        'mediaId' => 'MEDIA_ID',
        'mediaFiles.mediaId' => 'MEDIA_ID',
        'MediaFilesTableMap::COL_MEDIA_ID' => 'MEDIA_ID',
        'COL_MEDIA_ID' => 'MEDIA_ID',
        'media_id' => 'MEDIA_ID',
        'media_files.media_id' => 'MEDIA_ID',
        'MediaName' => 'MEDIA_NAME',
        'MediaFiles.MediaName' => 'MEDIA_NAME',
        'mediaName' => 'MEDIA_NAME',
        'mediaFiles.mediaName' => 'MEDIA_NAME',
        'MediaFilesTableMap::COL_MEDIA_NAME' => 'MEDIA_NAME',
        'COL_MEDIA_NAME' => 'MEDIA_NAME',
        'media_name' => 'MEDIA_NAME',
        'media_files.media_name' => 'MEDIA_NAME',
        'MediaMime' => 'MEDIA_MIME',
        'MediaFiles.MediaMime' => 'MEDIA_MIME',
        'mediaMime' => 'MEDIA_MIME',
        'mediaFiles.mediaMime' => 'MEDIA_MIME',
        'MediaFilesTableMap::COL_MEDIA_MIME' => 'MEDIA_MIME',
        'COL_MEDIA_MIME' => 'MEDIA_MIME',
        'media_mime' => 'MEDIA_MIME',
        'media_files.media_mime' => 'MEDIA_MIME',
        'MediaData' => 'MEDIA_DATA',
        'MediaFiles.MediaData' => 'MEDIA_DATA',
        'mediaData' => 'MEDIA_DATA',
        'mediaFiles.mediaData' => 'MEDIA_DATA',
        'MediaFilesTableMap::COL_MEDIA_DATA' => 'MEDIA_DATA',
        'COL_MEDIA_DATA' => 'MEDIA_DATA',
        'media_data' => 'MEDIA_DATA',
        'media_files.media_data' => 'MEDIA_DATA',
        'FolderId' => 'FOLDER_ID',
        'MediaFiles.FolderId' => 'FOLDER_ID',
        'folderId' => 'FOLDER_ID',
        'mediaFiles.folderId' => 'FOLDER_ID',
        'MediaFilesTableMap::COL_FOLDER_ID' => 'FOLDER_ID',
        'COL_FOLDER_ID' => 'FOLDER_ID',
        'folder_id' => 'FOLDER_ID',
        'media_files.folder_id' => 'FOLDER_ID',
        'CompanyId' => 'COMPANY_ID',
        'MediaFiles.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mediaFiles.companyId' => 'COMPANY_ID',
        'MediaFilesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'media_files.company_id' => 'COMPANY_ID',
        'Iss3file' => 'ISS3FILE',
        'MediaFiles.Iss3file' => 'ISS3FILE',
        'iss3file' => 'ISS3FILE',
        'mediaFiles.iss3file' => 'ISS3FILE',
        'MediaFilesTableMap::COL_ISS3FILE' => 'ISS3FILE',
        'COL_ISS3FILE' => 'ISS3FILE',
        'media_files.iss3file' => 'ISS3FILE',
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
        $this->setName('media_files');
        $this->setPhpName('MediaFiles');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MediaFiles');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('media_files_media_id_seq');
        // columns
        $this->addPrimaryKey('media_id', 'MediaId', 'INTEGER', true, null, null);
        $this->addColumn('media_name', 'MediaName', 'VARCHAR', true, 100, null);
        $this->addColumn('media_mime', 'MediaMime', 'VARCHAR', true, 100, null);
        $this->addColumn('media_data', 'MediaData', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('folder_id', 'FolderId', 'INTEGER', 'media_folders', 'folder_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('iss3file', 'Iss3file', 'BOOLEAN', false, 1, false);
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
        $this->addRelation('MediaFolders', '\\entities\\MediaFolders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':folder_id',
    1 => ':folder_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':agendaimage',
    1 => ':media_id',
  ),
), null, null, 'Agendatypess', false);
        $this->addRelation('CheckInMedia', '\\entities\\CheckInMedia', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), 'CASCADE', null, 'CheckInMedias', false);
        $this->addRelation('Gifts', '\\entities\\Gifts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), null, null, 'Giftss', false);
        $this->addRelation('Offers', '\\entities\\Offers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':media_id',
    1 => ':media_id',
  ),
), null, null, 'Offerss', false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':image_media_id',
    1 => ':media_id',
  ),
), null, null, 'OutletTypes', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to media_files     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CheckInMediaTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MediaFilesTableMap::CLASS_DEFAULT : MediaFilesTableMap::OM_CLASS;
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
     * @return array (MediaFiles object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MediaFilesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MediaFilesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MediaFilesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MediaFilesTableMap::OM_CLASS;
            /** @var MediaFiles $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MediaFilesTableMap::addInstanceToPool($obj, $key);
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
            $key = MediaFilesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MediaFilesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MediaFiles $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MediaFilesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MediaFilesTableMap::COL_MEDIA_ID);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_MEDIA_NAME);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_MEDIA_MIME);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_MEDIA_DATA);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_FOLDER_ID);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(MediaFilesTableMap::COL_ISS3FILE);
        } else {
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.media_name');
            $criteria->addSelectColumn($alias . '.media_mime');
            $criteria->addSelectColumn($alias . '.media_data');
            $criteria->addSelectColumn($alias . '.folder_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.iss3file');
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
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_MEDIA_ID);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_MEDIA_NAME);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_MEDIA_MIME);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_MEDIA_DATA);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_FOLDER_ID);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(MediaFilesTableMap::COL_ISS3FILE);
        } else {
            $criteria->removeSelectColumn($alias . '.media_id');
            $criteria->removeSelectColumn($alias . '.media_name');
            $criteria->removeSelectColumn($alias . '.media_mime');
            $criteria->removeSelectColumn($alias . '.media_data');
            $criteria->removeSelectColumn($alias . '.folder_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.iss3file');
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
        return Propel::getServiceContainer()->getDatabaseMap(MediaFilesTableMap::DATABASE_NAME)->getTable(MediaFilesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MediaFiles or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MediaFiles object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MediaFiles) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MediaFilesTableMap::DATABASE_NAME);
            $criteria->add(MediaFilesTableMap::COL_MEDIA_ID, (array) $values, Criteria::IN);
        }

        $query = MediaFilesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MediaFilesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MediaFilesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the media_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MediaFilesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MediaFiles or Criteria object.
     *
     * @param mixed $criteria Criteria or MediaFiles object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MediaFiles object
        }

        if ($criteria->containsKey(MediaFilesTableMap::COL_MEDIA_ID) && $criteria->keyContainsValue(MediaFilesTableMap::COL_MEDIA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MediaFilesTableMap::COL_MEDIA_ID.')');
        }


        // Set the correct dbName
        $query = MediaFilesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

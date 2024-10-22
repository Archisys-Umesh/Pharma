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
use entities\HrUserDocuments;
use entities\HrUserDocumentsQuery;


/**
 * This class defines the structure of the 'hr_user_documents' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HrUserDocumentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HrUserDocumentsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'hr_user_documents';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'HrUserDocuments';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\HrUserDocuments';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.HrUserDocuments';

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
     * the column name for the hrdo_id field
     */
    public const COL_HRDO_ID = 'hr_user_documents.hrdo_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'hr_user_documents.employee_id';

    /**
     * the column name for the document_id field
     */
    public const COL_DOCUMENT_ID = 'hr_user_documents.document_id';

    /**
     * the column name for the scanned_file_name field
     */
    public const COL_SCANNED_FILE_NAME = 'hr_user_documents.scanned_file_name';

    /**
     * the column name for the mime field
     */
    public const COL_MIME = 'hr_user_documents.mime';

    /**
     * the column name for the file_size field
     */
    public const COL_FILE_SIZE = 'hr_user_documents.file_size';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'hr_user_documents.remark';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'hr_user_documents.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'hr_user_documents.updated_at';

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
        self::TYPE_PHPNAME       => ['HrdoId', 'EmployeeId', 'DocumentId', 'ScannedFileName', 'Mime', 'FileSize', 'Remark', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['hrdoId', 'employeeId', 'documentId', 'scannedFileName', 'mime', 'fileSize', 'remark', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [HrUserDocumentsTableMap::COL_HRDO_ID, HrUserDocumentsTableMap::COL_EMPLOYEE_ID, HrUserDocumentsTableMap::COL_DOCUMENT_ID, HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME, HrUserDocumentsTableMap::COL_MIME, HrUserDocumentsTableMap::COL_FILE_SIZE, HrUserDocumentsTableMap::COL_REMARK, HrUserDocumentsTableMap::COL_CREATED_AT, HrUserDocumentsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['hrdo_id', 'employee_id', 'document_id', 'scanned_file_name', 'mime', 'file_size', 'remark', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['HrdoId' => 0, 'EmployeeId' => 1, 'DocumentId' => 2, 'ScannedFileName' => 3, 'Mime' => 4, 'FileSize' => 5, 'Remark' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['hrdoId' => 0, 'employeeId' => 1, 'documentId' => 2, 'scannedFileName' => 3, 'mime' => 4, 'fileSize' => 5, 'remark' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [HrUserDocumentsTableMap::COL_HRDO_ID => 0, HrUserDocumentsTableMap::COL_EMPLOYEE_ID => 1, HrUserDocumentsTableMap::COL_DOCUMENT_ID => 2, HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME => 3, HrUserDocumentsTableMap::COL_MIME => 4, HrUserDocumentsTableMap::COL_FILE_SIZE => 5, HrUserDocumentsTableMap::COL_REMARK => 6, HrUserDocumentsTableMap::COL_CREATED_AT => 7, HrUserDocumentsTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['hrdo_id' => 0, 'employee_id' => 1, 'document_id' => 2, 'scanned_file_name' => 3, 'mime' => 4, 'file_size' => 5, 'remark' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HrdoId' => 'HRDO_ID',
        'HrUserDocuments.HrdoId' => 'HRDO_ID',
        'hrdoId' => 'HRDO_ID',
        'hrUserDocuments.hrdoId' => 'HRDO_ID',
        'HrUserDocumentsTableMap::COL_HRDO_ID' => 'HRDO_ID',
        'COL_HRDO_ID' => 'HRDO_ID',
        'hrdo_id' => 'HRDO_ID',
        'hr_user_documents.hrdo_id' => 'HRDO_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'HrUserDocuments.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'hrUserDocuments.employeeId' => 'EMPLOYEE_ID',
        'HrUserDocumentsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'hr_user_documents.employee_id' => 'EMPLOYEE_ID',
        'DocumentId' => 'DOCUMENT_ID',
        'HrUserDocuments.DocumentId' => 'DOCUMENT_ID',
        'documentId' => 'DOCUMENT_ID',
        'hrUserDocuments.documentId' => 'DOCUMENT_ID',
        'HrUserDocumentsTableMap::COL_DOCUMENT_ID' => 'DOCUMENT_ID',
        'COL_DOCUMENT_ID' => 'DOCUMENT_ID',
        'document_id' => 'DOCUMENT_ID',
        'hr_user_documents.document_id' => 'DOCUMENT_ID',
        'ScannedFileName' => 'SCANNED_FILE_NAME',
        'HrUserDocuments.ScannedFileName' => 'SCANNED_FILE_NAME',
        'scannedFileName' => 'SCANNED_FILE_NAME',
        'hrUserDocuments.scannedFileName' => 'SCANNED_FILE_NAME',
        'HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME' => 'SCANNED_FILE_NAME',
        'COL_SCANNED_FILE_NAME' => 'SCANNED_FILE_NAME',
        'scanned_file_name' => 'SCANNED_FILE_NAME',
        'hr_user_documents.scanned_file_name' => 'SCANNED_FILE_NAME',
        'Mime' => 'MIME',
        'HrUserDocuments.Mime' => 'MIME',
        'mime' => 'MIME',
        'hrUserDocuments.mime' => 'MIME',
        'HrUserDocumentsTableMap::COL_MIME' => 'MIME',
        'COL_MIME' => 'MIME',
        'hr_user_documents.mime' => 'MIME',
        'FileSize' => 'FILE_SIZE',
        'HrUserDocuments.FileSize' => 'FILE_SIZE',
        'fileSize' => 'FILE_SIZE',
        'hrUserDocuments.fileSize' => 'FILE_SIZE',
        'HrUserDocumentsTableMap::COL_FILE_SIZE' => 'FILE_SIZE',
        'COL_FILE_SIZE' => 'FILE_SIZE',
        'file_size' => 'FILE_SIZE',
        'hr_user_documents.file_size' => 'FILE_SIZE',
        'Remark' => 'REMARK',
        'HrUserDocuments.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'hrUserDocuments.remark' => 'REMARK',
        'HrUserDocumentsTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'hr_user_documents.remark' => 'REMARK',
        'CreatedAt' => 'CREATED_AT',
        'HrUserDocuments.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'hrUserDocuments.createdAt' => 'CREATED_AT',
        'HrUserDocumentsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'hr_user_documents.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'HrUserDocuments.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'hrUserDocuments.updatedAt' => 'UPDATED_AT',
        'HrUserDocumentsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'hr_user_documents.updated_at' => 'UPDATED_AT',
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
        $this->setName('hr_user_documents');
        $this->setPhpName('HrUserDocuments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\HrUserDocuments');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('hr_user_documents_hrdo_id_seq');
        // columns
        $this->addPrimaryKey('hrdo_id', 'HrdoId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('document_id', 'DocumentId', 'VARCHAR', false, 50, null);
        $this->addColumn('scanned_file_name', 'ScannedFileName', 'VARCHAR', false, 50, null);
        $this->addColumn('mime', 'Mime', 'VARCHAR', false, 50, null);
        $this->addColumn('file_size', 'FileSize', 'VARCHAR', false, 50, null);
        $this->addColumn('remark', 'Remark', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HrdoId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HrUserDocumentsTableMap::CLASS_DEFAULT : HrUserDocumentsTableMap::OM_CLASS;
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
     * @return array (HrUserDocuments object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HrUserDocumentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HrUserDocumentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HrUserDocumentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HrUserDocumentsTableMap::OM_CLASS;
            /** @var HrUserDocuments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HrUserDocumentsTableMap::addInstanceToPool($obj, $key);
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
            $key = HrUserDocumentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HrUserDocumentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HrUserDocuments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HrUserDocumentsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_HRDO_ID);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_DOCUMENT_ID);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_MIME);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_FILE_SIZE);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_REMARK);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HrUserDocumentsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.hrdo_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.document_id');
            $criteria->addSelectColumn($alias . '.scanned_file_name');
            $criteria->addSelectColumn($alias . '.mime');
            $criteria->addSelectColumn($alias . '.file_size');
            $criteria->addSelectColumn($alias . '.remark');
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
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_HRDO_ID);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_DOCUMENT_ID);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_SCANNED_FILE_NAME);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_MIME);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_FILE_SIZE);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_REMARK);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HrUserDocumentsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.hrdo_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.document_id');
            $criteria->removeSelectColumn($alias . '.scanned_file_name');
            $criteria->removeSelectColumn($alias . '.mime');
            $criteria->removeSelectColumn($alias . '.file_size');
            $criteria->removeSelectColumn($alias . '.remark');
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
        return Propel::getServiceContainer()->getDatabaseMap(HrUserDocumentsTableMap::DATABASE_NAME)->getTable(HrUserDocumentsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HrUserDocuments or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or HrUserDocuments object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDocumentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\HrUserDocuments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HrUserDocumentsTableMap::DATABASE_NAME);
            $criteria->add(HrUserDocumentsTableMap::COL_HRDO_ID, (array) $values, Criteria::IN);
        }

        $query = HrUserDocumentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HrUserDocumentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HrUserDocumentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hr_user_documents table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HrUserDocumentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HrUserDocuments or Criteria object.
     *
     * @param mixed $criteria Criteria or HrUserDocuments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDocumentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HrUserDocuments object
        }

        if ($criteria->containsKey(HrUserDocumentsTableMap::COL_HRDO_ID) && $criteria->keyContainsValue(HrUserDocumentsTableMap::COL_HRDO_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HrUserDocumentsTableMap::COL_HRDO_ID.')');
        }


        // Set the correct dbName
        $query = HrUserDocumentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

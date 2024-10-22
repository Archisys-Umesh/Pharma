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
use entities\OutletOrgNotes;
use entities\OutletOrgNotesQuery;


/**
 * This class defines the structure of the 'outlet_org_notes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletOrgNotesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletOrgNotesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_org_notes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletOrgNotes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletOrgNotes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletOrgNotes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the outlet_org_note_id field
     */
    public const COL_OUTLET_ORG_NOTE_ID = 'outlet_org_notes.outlet_org_note_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'outlet_org_notes.outlet_org_data_id';

    /**
     * the column name for the note_date field
     */
    public const COL_NOTE_DATE = 'outlet_org_notes.note_date';

    /**
     * the column name for the note field
     */
    public const COL_NOTE = 'outlet_org_notes.note';

    /**
     * the column name for the isdeleted field
     */
    public const COL_ISDELETED = 'outlet_org_notes.isdeleted';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'outlet_org_notes.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_org_notes.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'outlet_org_notes.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_org_notes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_org_notes.updated_at';

    /**
     * the column name for the note_title field
     */
    public const COL_NOTE_TITLE = 'outlet_org_notes.note_title';

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
        self::TYPE_PHPNAME       => ['OutletOrgNoteId', 'OutletOrgDataId', 'NoteDate', 'Note', 'Isdeleted', 'EmployeeId', 'CompanyId', 'Orgunitid', 'CreatedAt', 'UpdatedAt', 'NoteTitle', ],
        self::TYPE_CAMELNAME     => ['outletOrgNoteId', 'outletOrgDataId', 'noteDate', 'note', 'isdeleted', 'employeeId', 'companyId', 'orgunitid', 'createdAt', 'updatedAt', 'noteTitle', ],
        self::TYPE_COLNAME       => [OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID, OutletOrgNotesTableMap::COL_OUTLET_ORG_DATA_ID, OutletOrgNotesTableMap::COL_NOTE_DATE, OutletOrgNotesTableMap::COL_NOTE, OutletOrgNotesTableMap::COL_ISDELETED, OutletOrgNotesTableMap::COL_EMPLOYEE_ID, OutletOrgNotesTableMap::COL_COMPANY_ID, OutletOrgNotesTableMap::COL_ORGUNITID, OutletOrgNotesTableMap::COL_CREATED_AT, OutletOrgNotesTableMap::COL_UPDATED_AT, OutletOrgNotesTableMap::COL_NOTE_TITLE, ],
        self::TYPE_FIELDNAME     => ['outlet_org_note_id', 'outlet_org_data_id', 'note_date', 'note', 'isdeleted', 'employee_id', 'company_id', 'orgunitid', 'created_at', 'updated_at', 'note_title', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['OutletOrgNoteId' => 0, 'OutletOrgDataId' => 1, 'NoteDate' => 2, 'Note' => 3, 'Isdeleted' => 4, 'EmployeeId' => 5, 'CompanyId' => 6, 'Orgunitid' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'NoteTitle' => 10, ],
        self::TYPE_CAMELNAME     => ['outletOrgNoteId' => 0, 'outletOrgDataId' => 1, 'noteDate' => 2, 'note' => 3, 'isdeleted' => 4, 'employeeId' => 5, 'companyId' => 6, 'orgunitid' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'noteTitle' => 10, ],
        self::TYPE_COLNAME       => [OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID => 0, OutletOrgNotesTableMap::COL_OUTLET_ORG_DATA_ID => 1, OutletOrgNotesTableMap::COL_NOTE_DATE => 2, OutletOrgNotesTableMap::COL_NOTE => 3, OutletOrgNotesTableMap::COL_ISDELETED => 4, OutletOrgNotesTableMap::COL_EMPLOYEE_ID => 5, OutletOrgNotesTableMap::COL_COMPANY_ID => 6, OutletOrgNotesTableMap::COL_ORGUNITID => 7, OutletOrgNotesTableMap::COL_CREATED_AT => 8, OutletOrgNotesTableMap::COL_UPDATED_AT => 9, OutletOrgNotesTableMap::COL_NOTE_TITLE => 10, ],
        self::TYPE_FIELDNAME     => ['outlet_org_note_id' => 0, 'outlet_org_data_id' => 1, 'note_date' => 2, 'note' => 3, 'isdeleted' => 4, 'employee_id' => 5, 'company_id' => 6, 'orgunitid' => 7, 'created_at' => 8, 'updated_at' => 9, 'note_title' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletOrgNoteId' => 'OUTLET_ORG_NOTE_ID',
        'OutletOrgNotes.OutletOrgNoteId' => 'OUTLET_ORG_NOTE_ID',
        'outletOrgNoteId' => 'OUTLET_ORG_NOTE_ID',
        'outletOrgNotes.outletOrgNoteId' => 'OUTLET_ORG_NOTE_ID',
        'OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID' => 'OUTLET_ORG_NOTE_ID',
        'COL_OUTLET_ORG_NOTE_ID' => 'OUTLET_ORG_NOTE_ID',
        'outlet_org_note_id' => 'OUTLET_ORG_NOTE_ID',
        'outlet_org_notes.outlet_org_note_id' => 'OUTLET_ORG_NOTE_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletOrgNotes.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgNotes.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'OutletOrgNotesTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_notes.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'NoteDate' => 'NOTE_DATE',
        'OutletOrgNotes.NoteDate' => 'NOTE_DATE',
        'noteDate' => 'NOTE_DATE',
        'outletOrgNotes.noteDate' => 'NOTE_DATE',
        'OutletOrgNotesTableMap::COL_NOTE_DATE' => 'NOTE_DATE',
        'COL_NOTE_DATE' => 'NOTE_DATE',
        'note_date' => 'NOTE_DATE',
        'outlet_org_notes.note_date' => 'NOTE_DATE',
        'Note' => 'NOTE',
        'OutletOrgNotes.Note' => 'NOTE',
        'note' => 'NOTE',
        'outletOrgNotes.note' => 'NOTE',
        'OutletOrgNotesTableMap::COL_NOTE' => 'NOTE',
        'COL_NOTE' => 'NOTE',
        'outlet_org_notes.note' => 'NOTE',
        'Isdeleted' => 'ISDELETED',
        'OutletOrgNotes.Isdeleted' => 'ISDELETED',
        'isdeleted' => 'ISDELETED',
        'outletOrgNotes.isdeleted' => 'ISDELETED',
        'OutletOrgNotesTableMap::COL_ISDELETED' => 'ISDELETED',
        'COL_ISDELETED' => 'ISDELETED',
        'outlet_org_notes.isdeleted' => 'ISDELETED',
        'EmployeeId' => 'EMPLOYEE_ID',
        'OutletOrgNotes.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'outletOrgNotes.employeeId' => 'EMPLOYEE_ID',
        'OutletOrgNotesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'outlet_org_notes.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'OutletOrgNotes.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletOrgNotes.companyId' => 'COMPANY_ID',
        'OutletOrgNotesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_org_notes.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'OutletOrgNotes.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'outletOrgNotes.orgunitid' => 'ORGUNITID',
        'OutletOrgNotesTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'outlet_org_notes.orgunitid' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'OutletOrgNotes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletOrgNotes.createdAt' => 'CREATED_AT',
        'OutletOrgNotesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_org_notes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletOrgNotes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletOrgNotes.updatedAt' => 'UPDATED_AT',
        'OutletOrgNotesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_org_notes.updated_at' => 'UPDATED_AT',
        'NoteTitle' => 'NOTE_TITLE',
        'OutletOrgNotes.NoteTitle' => 'NOTE_TITLE',
        'noteTitle' => 'NOTE_TITLE',
        'outletOrgNotes.noteTitle' => 'NOTE_TITLE',
        'OutletOrgNotesTableMap::COL_NOTE_TITLE' => 'NOTE_TITLE',
        'COL_NOTE_TITLE' => 'NOTE_TITLE',
        'note_title' => 'NOTE_TITLE',
        'outlet_org_notes.note_title' => 'NOTE_TITLE',
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
        $this->setName('outlet_org_notes');
        $this->setPhpName('OutletOrgNotes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletOrgNotes');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_org_notes_outlet_org_note_id_seq');
        // columns
        $this->addPrimaryKey('outlet_org_note_id', 'OutletOrgNoteId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addColumn('note_date', 'NoteDate', 'DATE', false, null, null);
        $this->addColumn('note', 'Note', 'VARCHAR', false, null, null);
        $this->addColumn('isdeleted', 'Isdeleted', 'BOOLEAN', false, 1, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('note_title', 'NoteTitle', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletOrgNoteId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletOrgNotesTableMap::CLASS_DEFAULT : OutletOrgNotesTableMap::OM_CLASS;
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
     * @return array (OutletOrgNotes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletOrgNotesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletOrgNotesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletOrgNotesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletOrgNotesTableMap::OM_CLASS;
            /** @var OutletOrgNotes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletOrgNotesTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletOrgNotesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletOrgNotesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletOrgNotes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletOrgNotesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_NOTE_DATE);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_NOTE);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_ISDELETED);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletOrgNotesTableMap::COL_NOTE_TITLE);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_org_note_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.note_date');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.isdeleted');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.note_title');
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
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_NOTE_DATE);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_NOTE);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_ISDELETED);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletOrgNotesTableMap::COL_NOTE_TITLE);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_org_note_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.note_date');
            $criteria->removeSelectColumn($alias . '.note');
            $criteria->removeSelectColumn($alias . '.isdeleted');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.note_title');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletOrgNotesTableMap::DATABASE_NAME)->getTable(OutletOrgNotesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletOrgNotes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletOrgNotes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgNotesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletOrgNotes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletOrgNotesTableMap::DATABASE_NAME);
            $criteria->add(OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID, (array) $values, Criteria::IN);
        }

        $query = OutletOrgNotesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletOrgNotesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletOrgNotesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_org_notes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletOrgNotesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletOrgNotes or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletOrgNotes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletOrgNotesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletOrgNotes object
        }

        if ($criteria->containsKey(OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID) && $criteria->keyContainsValue(OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletOrgNotesTableMap::COL_OUTLET_ORG_NOTE_ID.')');
        }


        // Set the correct dbName
        $query = OutletOrgNotesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

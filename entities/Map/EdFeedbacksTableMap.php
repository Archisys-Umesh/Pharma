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
use entities\EdFeedbacks;
use entities\EdFeedbacksQuery;


/**
 * This class defines the structure of the 'ed_feedbacks' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdFeedbacksTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdFeedbacksTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_feedbacks';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdFeedbacks';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdFeedbacks';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdFeedbacks';

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
     * the column name for the ed_feedback_id field
     */
    public const COL_ED_FEEDBACK_ID = 'ed_feedbacks.ed_feedback_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'ed_feedbacks.outlet_org_data_id';

    /**
     * the column name for the presentation_id field
     */
    public const COL_PRESENTATION_ID = 'ed_feedbacks.presentation_id';

    /**
     * the column name for the slide_index field
     */
    public const COL_SLIDE_INDEX = 'ed_feedbacks.slide_index';

    /**
     * the column name for the slide_name field
     */
    public const COL_SLIDE_NAME = 'ed_feedbacks.slide_name';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'ed_feedbacks.employee_id';

    /**
     * the column name for the slide_like field
     */
    public const COL_SLIDE_LIKE = 'ed_feedbacks.slide_like';

    /**
     * the column name for the ilike field
     */
    public const COL_ILIKE = 'ed_feedbacks.ilike';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_feedbacks.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_feedbacks.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_feedbacks.company_id';

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
        self::TYPE_PHPNAME       => ['EdFeedbackId', 'OutletOrgDataId', 'PresentationId', 'SlideIndex', 'SlideName', 'EmployeeId', 'SlideLike', 'Ilike', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['edFeedbackId', 'outletOrgDataId', 'presentationId', 'slideIndex', 'slideName', 'employeeId', 'slideLike', 'ilike', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID, EdFeedbacksTableMap::COL_PRESENTATION_ID, EdFeedbacksTableMap::COL_SLIDE_INDEX, EdFeedbacksTableMap::COL_SLIDE_NAME, EdFeedbacksTableMap::COL_EMPLOYEE_ID, EdFeedbacksTableMap::COL_SLIDE_LIKE, EdFeedbacksTableMap::COL_ILIKE, EdFeedbacksTableMap::COL_CREATED_AT, EdFeedbacksTableMap::COL_UPDATED_AT, EdFeedbacksTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['ed_feedback_id', 'outlet_org_data_id', 'presentation_id', 'slide_index', 'slide_name', 'employee_id', 'slide_like', 'ilike', 'created_at', 'updated_at', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['EdFeedbackId' => 0, 'OutletOrgDataId' => 1, 'PresentationId' => 2, 'SlideIndex' => 3, 'SlideName' => 4, 'EmployeeId' => 5, 'SlideLike' => 6, 'Ilike' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'CompanyId' => 10, ],
        self::TYPE_CAMELNAME     => ['edFeedbackId' => 0, 'outletOrgDataId' => 1, 'presentationId' => 2, 'slideIndex' => 3, 'slideName' => 4, 'employeeId' => 5, 'slideLike' => 6, 'ilike' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'companyId' => 10, ],
        self::TYPE_COLNAME       => [EdFeedbacksTableMap::COL_ED_FEEDBACK_ID => 0, EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID => 1, EdFeedbacksTableMap::COL_PRESENTATION_ID => 2, EdFeedbacksTableMap::COL_SLIDE_INDEX => 3, EdFeedbacksTableMap::COL_SLIDE_NAME => 4, EdFeedbacksTableMap::COL_EMPLOYEE_ID => 5, EdFeedbacksTableMap::COL_SLIDE_LIKE => 6, EdFeedbacksTableMap::COL_ILIKE => 7, EdFeedbacksTableMap::COL_CREATED_AT => 8, EdFeedbacksTableMap::COL_UPDATED_AT => 9, EdFeedbacksTableMap::COL_COMPANY_ID => 10, ],
        self::TYPE_FIELDNAME     => ['ed_feedback_id' => 0, 'outlet_org_data_id' => 1, 'presentation_id' => 2, 'slide_index' => 3, 'slide_name' => 4, 'employee_id' => 5, 'slide_like' => 6, 'ilike' => 7, 'created_at' => 8, 'updated_at' => 9, 'company_id' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EdFeedbackId' => 'ED_FEEDBACK_ID',
        'EdFeedbacks.EdFeedbackId' => 'ED_FEEDBACK_ID',
        'edFeedbackId' => 'ED_FEEDBACK_ID',
        'edFeedbacks.edFeedbackId' => 'ED_FEEDBACK_ID',
        'EdFeedbacksTableMap::COL_ED_FEEDBACK_ID' => 'ED_FEEDBACK_ID',
        'COL_ED_FEEDBACK_ID' => 'ED_FEEDBACK_ID',
        'ed_feedback_id' => 'ED_FEEDBACK_ID',
        'ed_feedbacks.ed_feedback_id' => 'ED_FEEDBACK_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'EdFeedbacks.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'edFeedbacks.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'ed_feedbacks.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'PresentationId' => 'PRESENTATION_ID',
        'EdFeedbacks.PresentationId' => 'PRESENTATION_ID',
        'presentationId' => 'PRESENTATION_ID',
        'edFeedbacks.presentationId' => 'PRESENTATION_ID',
        'EdFeedbacksTableMap::COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'presentation_id' => 'PRESENTATION_ID',
        'ed_feedbacks.presentation_id' => 'PRESENTATION_ID',
        'SlideIndex' => 'SLIDE_INDEX',
        'EdFeedbacks.SlideIndex' => 'SLIDE_INDEX',
        'slideIndex' => 'SLIDE_INDEX',
        'edFeedbacks.slideIndex' => 'SLIDE_INDEX',
        'EdFeedbacksTableMap::COL_SLIDE_INDEX' => 'SLIDE_INDEX',
        'COL_SLIDE_INDEX' => 'SLIDE_INDEX',
        'slide_index' => 'SLIDE_INDEX',
        'ed_feedbacks.slide_index' => 'SLIDE_INDEX',
        'SlideName' => 'SLIDE_NAME',
        'EdFeedbacks.SlideName' => 'SLIDE_NAME',
        'slideName' => 'SLIDE_NAME',
        'edFeedbacks.slideName' => 'SLIDE_NAME',
        'EdFeedbacksTableMap::COL_SLIDE_NAME' => 'SLIDE_NAME',
        'COL_SLIDE_NAME' => 'SLIDE_NAME',
        'slide_name' => 'SLIDE_NAME',
        'ed_feedbacks.slide_name' => 'SLIDE_NAME',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EdFeedbacks.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'edFeedbacks.employeeId' => 'EMPLOYEE_ID',
        'EdFeedbacksTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'ed_feedbacks.employee_id' => 'EMPLOYEE_ID',
        'SlideLike' => 'SLIDE_LIKE',
        'EdFeedbacks.SlideLike' => 'SLIDE_LIKE',
        'slideLike' => 'SLIDE_LIKE',
        'edFeedbacks.slideLike' => 'SLIDE_LIKE',
        'EdFeedbacksTableMap::COL_SLIDE_LIKE' => 'SLIDE_LIKE',
        'COL_SLIDE_LIKE' => 'SLIDE_LIKE',
        'slide_like' => 'SLIDE_LIKE',
        'ed_feedbacks.slide_like' => 'SLIDE_LIKE',
        'Ilike' => 'ILIKE',
        'EdFeedbacks.Ilike' => 'ILIKE',
        'ilike' => 'ILIKE',
        'edFeedbacks.ilike' => 'ILIKE',
        'EdFeedbacksTableMap::COL_ILIKE' => 'ILIKE',
        'COL_ILIKE' => 'ILIKE',
        'ed_feedbacks.ilike' => 'ILIKE',
        'CreatedAt' => 'CREATED_AT',
        'EdFeedbacks.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edFeedbacks.createdAt' => 'CREATED_AT',
        'EdFeedbacksTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_feedbacks.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdFeedbacks.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edFeedbacks.updatedAt' => 'UPDATED_AT',
        'EdFeedbacksTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_feedbacks.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'EdFeedbacks.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edFeedbacks.companyId' => 'COMPANY_ID',
        'EdFeedbacksTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_feedbacks.company_id' => 'COMPANY_ID',
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
        $this->setName('ed_feedbacks');
        $this->setPhpName('EdFeedbacks');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdFeedbacks');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ed_feedbacks_ed_feedback_id_seq');
        // columns
        $this->addPrimaryKey('ed_feedback_id', 'EdFeedbackId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addForeignKey('presentation_id', 'PresentationId', 'INTEGER', 'ed_presentations', 'presentation_id', false, null, null);
        $this->addColumn('slide_index', 'SlideIndex', 'INTEGER', false, null, null);
        $this->addColumn('slide_name', 'SlideName', 'VARCHAR', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('slide_like', 'SlideLike', 'INTEGER', false, null, null);
        $this->addColumn('ilike', 'Ilike', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('EdPresentations', '\\entities\\EdPresentations', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':presentation_id',
    1 => ':presentation_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EdFeedbackId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EdFeedbacksTableMap::CLASS_DEFAULT : EdFeedbacksTableMap::OM_CLASS;
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
     * @return array (EdFeedbacks object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdFeedbacksTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdFeedbacksTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdFeedbacksTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdFeedbacksTableMap::OM_CLASS;
            /** @var EdFeedbacks $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdFeedbacksTableMap::addInstanceToPool($obj, $key);
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
            $key = EdFeedbacksTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdFeedbacksTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdFeedbacks $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdFeedbacksTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_PRESENTATION_ID);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_SLIDE_INDEX);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_SLIDE_NAME);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_SLIDE_LIKE);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_ILIKE);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdFeedbacksTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.ed_feedback_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.presentation_id');
            $criteria->addSelectColumn($alias . '.slide_index');
            $criteria->addSelectColumn($alias . '.slide_name');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.slide_like');
            $criteria->addSelectColumn($alias . '.ilike');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_PRESENTATION_ID);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_SLIDE_INDEX);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_SLIDE_NAME);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_SLIDE_LIKE);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_ILIKE);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdFeedbacksTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.ed_feedback_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.presentation_id');
            $criteria->removeSelectColumn($alias . '.slide_index');
            $criteria->removeSelectColumn($alias . '.slide_name');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.slide_like');
            $criteria->removeSelectColumn($alias . '.ilike');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(EdFeedbacksTableMap::DATABASE_NAME)->getTable(EdFeedbacksTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdFeedbacks or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdFeedbacks object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdFeedbacksTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdFeedbacks) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EdFeedbacksTableMap::DATABASE_NAME);
            $criteria->add(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID, (array) $values, Criteria::IN);
        }

        $query = EdFeedbacksQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdFeedbacksTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdFeedbacksTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_feedbacks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdFeedbacksQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdFeedbacks or Criteria object.
     *
     * @param mixed $criteria Criteria or EdFeedbacks object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdFeedbacksTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdFeedbacks object
        }

        if ($criteria->containsKey(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID) && $criteria->keyContainsValue(EdFeedbacksTableMap::COL_ED_FEEDBACK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EdFeedbacksTableMap::COL_ED_FEEDBACK_ID.')');
        }


        // Set the correct dbName
        $query = EdFeedbacksQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

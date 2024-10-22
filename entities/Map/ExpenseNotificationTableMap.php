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
use entities\ExpenseNotification;
use entities\ExpenseNotificationQuery;


/**
 * This class defines the structure of the 'expense_notification' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseNotificationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseNotificationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_notification';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseNotification';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseNotification';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseNotification';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'expense_notification.moye';

    /**
     * the column name for the pending_for_submit field
     */
    public const COL_PENDING_FOR_SUBMIT = 'expense_notification.pending_for_submit';

    /**
     * the column name for the pending_for_approve field
     */
    public const COL_PENDING_FOR_APPROVE = 'expense_notification.pending_for_approve';

    /**
     * the column name for the pending_for_audit field
     */
    public const COL_PENDING_FOR_AUDIT = 'expense_notification.pending_for_audit';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'expense_notification.orgunit_id';

    /**
     * the column name for the unit_name field
     */
    public const COL_UNIT_NAME = 'expense_notification.unit_name';

    /**
     * the column name for the pending_punchout field
     */
    public const COL_PENDING_PUNCHOUT = 'expense_notification.pending_punchout';

    /**
     * the column name for the unique_pending_for_submit field
     */
    public const COL_UNIQUE_PENDING_FOR_SUBMIT = 'expense_notification.unique_pending_for_submit';

    /**
     * the column name for the unique_pending_for_approve field
     */
    public const COL_UNIQUE_PENDING_FOR_APPROVE = 'expense_notification.unique_pending_for_approve';

    /**
     * the column name for the unique_pending_for_submit_ids field
     */
    public const COL_UNIQUE_PENDING_FOR_SUBMIT_IDS = 'expense_notification.unique_pending_for_submit_ids';

    /**
     * the column name for the unique_pending_punchout_ids field
     */
    public const COL_UNIQUE_PENDING_PUNCHOUT_IDS = 'expense_notification.unique_pending_punchout_ids';

    /**
     * the column name for the unique_pending_approval_manager_ids field
     */
    public const COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS = 'expense_notification.unique_pending_approval_manager_ids';

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
        self::TYPE_PHPNAME       => ['Moye', 'PendingForSubmit', 'PendingForApprove', 'PendingForAudit', 'OrgunitId', 'UnitName', 'PendingPunchout', 'UniquePendingForSubmit', 'UniquePendingForApprove', 'UniquePendingForSubmitIds', 'UniquePendingPunchout', 'UniquePendingApprovalManagerIds', ],
        self::TYPE_CAMELNAME     => ['moye', 'pendingForSubmit', 'pendingForApprove', 'pendingForAudit', 'orgunitId', 'unitName', 'pendingPunchout', 'uniquePendingForSubmit', 'uniquePendingForApprove', 'uniquePendingForSubmitIds', 'uniquePendingPunchout', 'uniquePendingApprovalManagerIds', ],
        self::TYPE_COLNAME       => [ExpenseNotificationTableMap::COL_MOYE, ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT, ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE, ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT, ExpenseNotificationTableMap::COL_ORGUNIT_ID, ExpenseNotificationTableMap::COL_UNIT_NAME, ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS, ],
        self::TYPE_FIELDNAME     => ['moye', 'pending_for_submit', 'pending_for_approve', 'pending_for_audit', 'orgunit_id', 'unit_name', 'pending_punchout', 'unique_pending_for_submit', 'unique_pending_for_approve', 'unique_pending_for_submit_ids', 'unique_pending_punchout_ids', 'unique_pending_approval_manager_ids', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['Moye' => 0, 'PendingForSubmit' => 1, 'PendingForApprove' => 2, 'PendingForAudit' => 3, 'OrgunitId' => 4, 'UnitName' => 5, 'PendingPunchout' => 6, 'UniquePendingForSubmit' => 7, 'UniquePendingForApprove' => 8, 'UniquePendingForSubmitIds' => 9, 'UniquePendingPunchout' => 10, 'UniquePendingApprovalManagerIds' => 11, ],
        self::TYPE_CAMELNAME     => ['moye' => 0, 'pendingForSubmit' => 1, 'pendingForApprove' => 2, 'pendingForAudit' => 3, 'orgunitId' => 4, 'unitName' => 5, 'pendingPunchout' => 6, 'uniquePendingForSubmit' => 7, 'uniquePendingForApprove' => 8, 'uniquePendingForSubmitIds' => 9, 'uniquePendingPunchout' => 10, 'uniquePendingApprovalManagerIds' => 11, ],
        self::TYPE_COLNAME       => [ExpenseNotificationTableMap::COL_MOYE => 0, ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT => 1, ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE => 2, ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT => 3, ExpenseNotificationTableMap::COL_ORGUNIT_ID => 4, ExpenseNotificationTableMap::COL_UNIT_NAME => 5, ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT => 6, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT => 7, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE => 8, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS => 9, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS => 10, ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS => 11, ],
        self::TYPE_FIELDNAME     => ['moye' => 0, 'pending_for_submit' => 1, 'pending_for_approve' => 2, 'pending_for_audit' => 3, 'orgunit_id' => 4, 'unit_name' => 5, 'pending_punchout' => 6, 'unique_pending_for_submit' => 7, 'unique_pending_for_approve' => 8, 'unique_pending_for_submit_ids' => 9, 'unique_pending_punchout_ids' => 10, 'unique_pending_approval_manager_ids' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Moye' => 'MOYE',
        'ExpenseNotification.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'expenseNotification.moye' => 'MOYE',
        'ExpenseNotificationTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'expense_notification.moye' => 'MOYE',
        'PendingForSubmit' => 'PENDING_FOR_SUBMIT',
        'ExpenseNotification.PendingForSubmit' => 'PENDING_FOR_SUBMIT',
        'pendingForSubmit' => 'PENDING_FOR_SUBMIT',
        'expenseNotification.pendingForSubmit' => 'PENDING_FOR_SUBMIT',
        'ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT' => 'PENDING_FOR_SUBMIT',
        'COL_PENDING_FOR_SUBMIT' => 'PENDING_FOR_SUBMIT',
        'pending_for_submit' => 'PENDING_FOR_SUBMIT',
        'expense_notification.pending_for_submit' => 'PENDING_FOR_SUBMIT',
        'PendingForApprove' => 'PENDING_FOR_APPROVE',
        'ExpenseNotification.PendingForApprove' => 'PENDING_FOR_APPROVE',
        'pendingForApprove' => 'PENDING_FOR_APPROVE',
        'expenseNotification.pendingForApprove' => 'PENDING_FOR_APPROVE',
        'ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE' => 'PENDING_FOR_APPROVE',
        'COL_PENDING_FOR_APPROVE' => 'PENDING_FOR_APPROVE',
        'pending_for_approve' => 'PENDING_FOR_APPROVE',
        'expense_notification.pending_for_approve' => 'PENDING_FOR_APPROVE',
        'PendingForAudit' => 'PENDING_FOR_AUDIT',
        'ExpenseNotification.PendingForAudit' => 'PENDING_FOR_AUDIT',
        'pendingForAudit' => 'PENDING_FOR_AUDIT',
        'expenseNotification.pendingForAudit' => 'PENDING_FOR_AUDIT',
        'ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT' => 'PENDING_FOR_AUDIT',
        'COL_PENDING_FOR_AUDIT' => 'PENDING_FOR_AUDIT',
        'pending_for_audit' => 'PENDING_FOR_AUDIT',
        'expense_notification.pending_for_audit' => 'PENDING_FOR_AUDIT',
        'OrgunitId' => 'ORGUNIT_ID',
        'ExpenseNotification.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'expenseNotification.orgunitId' => 'ORGUNIT_ID',
        'ExpenseNotificationTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'expense_notification.orgunit_id' => 'ORGUNIT_ID',
        'UnitName' => 'UNIT_NAME',
        'ExpenseNotification.UnitName' => 'UNIT_NAME',
        'unitName' => 'UNIT_NAME',
        'expenseNotification.unitName' => 'UNIT_NAME',
        'ExpenseNotificationTableMap::COL_UNIT_NAME' => 'UNIT_NAME',
        'COL_UNIT_NAME' => 'UNIT_NAME',
        'unit_name' => 'UNIT_NAME',
        'expense_notification.unit_name' => 'UNIT_NAME',
        'PendingPunchout' => 'PENDING_PUNCHOUT',
        'ExpenseNotification.PendingPunchout' => 'PENDING_PUNCHOUT',
        'pendingPunchout' => 'PENDING_PUNCHOUT',
        'expenseNotification.pendingPunchout' => 'PENDING_PUNCHOUT',
        'ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT' => 'PENDING_PUNCHOUT',
        'COL_PENDING_PUNCHOUT' => 'PENDING_PUNCHOUT',
        'pending_punchout' => 'PENDING_PUNCHOUT',
        'expense_notification.pending_punchout' => 'PENDING_PUNCHOUT',
        'UniquePendingForSubmit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'ExpenseNotification.UniquePendingForSubmit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'uniquePendingForSubmit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'expenseNotification.uniquePendingForSubmit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'COL_UNIQUE_PENDING_FOR_SUBMIT' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'unique_pending_for_submit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'expense_notification.unique_pending_for_submit' => 'UNIQUE_PENDING_FOR_SUBMIT',
        'UniquePendingForApprove' => 'UNIQUE_PENDING_FOR_APPROVE',
        'ExpenseNotification.UniquePendingForApprove' => 'UNIQUE_PENDING_FOR_APPROVE',
        'uniquePendingForApprove' => 'UNIQUE_PENDING_FOR_APPROVE',
        'expenseNotification.uniquePendingForApprove' => 'UNIQUE_PENDING_FOR_APPROVE',
        'ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE' => 'UNIQUE_PENDING_FOR_APPROVE',
        'COL_UNIQUE_PENDING_FOR_APPROVE' => 'UNIQUE_PENDING_FOR_APPROVE',
        'unique_pending_for_approve' => 'UNIQUE_PENDING_FOR_APPROVE',
        'expense_notification.unique_pending_for_approve' => 'UNIQUE_PENDING_FOR_APPROVE',
        'UniquePendingForSubmitIds' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'ExpenseNotification.UniquePendingForSubmitIds' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'uniquePendingForSubmitIds' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'expenseNotification.uniquePendingForSubmitIds' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'COL_UNIQUE_PENDING_FOR_SUBMIT_IDS' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'unique_pending_for_submit_ids' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'expense_notification.unique_pending_for_submit_ids' => 'UNIQUE_PENDING_FOR_SUBMIT_IDS',
        'UniquePendingPunchout' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'ExpenseNotification.UniquePendingPunchout' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'uniquePendingPunchout' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'expenseNotification.uniquePendingPunchout' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'COL_UNIQUE_PENDING_PUNCHOUT_IDS' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'unique_pending_punchout_ids' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'expense_notification.unique_pending_punchout_ids' => 'UNIQUE_PENDING_PUNCHOUT_IDS',
        'UniquePendingApprovalManagerIds' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'ExpenseNotification.UniquePendingApprovalManagerIds' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'uniquePendingApprovalManagerIds' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'expenseNotification.uniquePendingApprovalManagerIds' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'unique_pending_approval_manager_ids' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
        'expense_notification.unique_pending_approval_manager_ids' => 'UNIQUE_PENDING_APPROVAL_MANAGER_IDS',
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
        $this->setName('expense_notification');
        $this->setPhpName('ExpenseNotification');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseNotification');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, null, null);
        $this->addColumn('pending_for_submit', 'PendingForSubmit', 'DECIMAL', false, null, null);
        $this->addColumn('pending_for_approve', 'PendingForApprove', 'DECIMAL', false, null, null);
        $this->addColumn('pending_for_audit', 'PendingForAudit', 'DECIMAL', false, null, null);
        $this->addColumn('orgunit_id', 'OrgunitId', 'INTEGER', false, null, null);
        $this->addColumn('unit_name', 'UnitName', 'VARCHAR', false, null, null);
        $this->addColumn('pending_punchout', 'PendingPunchout', 'VARCHAR', false, null, null);
        $this->addColumn('unique_pending_for_submit', 'UniquePendingForSubmit', 'VARCHAR', false, null, null);
        $this->addColumn('unique_pending_for_approve', 'UniquePendingForApprove', 'VARCHAR', false, null, null);
        $this->addColumn('unique_pending_for_submit_ids', 'UniquePendingForSubmitIds', 'VARCHAR', false, null, null);
        $this->addColumn('unique_pending_punchout_ids', 'UniquePendingPunchout', 'VARCHAR', false, null, null);
        $this->addColumn('unique_pending_approval_manager_ids', 'UniquePendingApprovalManagerIds', 'VARCHAR', false, null, null);
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
        return $withPrefix ? ExpenseNotificationTableMap::CLASS_DEFAULT : ExpenseNotificationTableMap::OM_CLASS;
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
     * @return array (ExpenseNotification object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseNotificationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseNotificationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseNotificationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseNotificationTableMap::OM_CLASS;
            /** @var ExpenseNotification $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseNotificationTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseNotificationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseNotificationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseNotification $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseNotificationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_MOYE);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIT_NAME);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS);
            $criteria->addSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS);
        } else {
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.pending_for_submit');
            $criteria->addSelectColumn($alias . '.pending_for_approve');
            $criteria->addSelectColumn($alias . '.pending_for_audit');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.unit_name');
            $criteria->addSelectColumn($alias . '.pending_punchout');
            $criteria->addSelectColumn($alias . '.unique_pending_for_submit');
            $criteria->addSelectColumn($alias . '.unique_pending_for_approve');
            $criteria->addSelectColumn($alias . '.unique_pending_for_submit_ids');
            $criteria->addSelectColumn($alias . '.unique_pending_punchout_ids');
            $criteria->addSelectColumn($alias . '.unique_pending_approval_manager_ids');
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
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_MOYE);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_SUBMIT);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_APPROVE);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_PENDING_FOR_AUDIT);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIT_NAME);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_PENDING_PUNCHOUT);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_APPROVE);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_FOR_SUBMIT_IDS);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_PUNCHOUT_IDS);
            $criteria->removeSelectColumn(ExpenseNotificationTableMap::COL_UNIQUE_PENDING_APPROVAL_MANAGER_IDS);
        } else {
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.pending_for_submit');
            $criteria->removeSelectColumn($alias . '.pending_for_approve');
            $criteria->removeSelectColumn($alias . '.pending_for_audit');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.unit_name');
            $criteria->removeSelectColumn($alias . '.pending_punchout');
            $criteria->removeSelectColumn($alias . '.unique_pending_for_submit');
            $criteria->removeSelectColumn($alias . '.unique_pending_for_approve');
            $criteria->removeSelectColumn($alias . '.unique_pending_for_submit_ids');
            $criteria->removeSelectColumn($alias . '.unique_pending_punchout_ids');
            $criteria->removeSelectColumn($alias . '.unique_pending_approval_manager_ids');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseNotificationTableMap::DATABASE_NAME)->getTable(ExpenseNotificationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseNotification or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseNotification object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseNotificationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseNotification) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExpenseNotification object has no primary key');
        }

        $query = ExpenseNotificationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseNotificationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseNotificationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_notification table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseNotificationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseNotification or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseNotification object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseNotificationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseNotification object
        }


        // Set the correct dbName
        $query = ExpenseNotificationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

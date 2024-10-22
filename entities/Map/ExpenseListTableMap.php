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
use entities\ExpenseList;
use entities\ExpenseListQuery;


/**
 * This class defines the structure of the 'expense_list' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseListTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseListTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_list';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseList';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseList';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseList';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 23;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 23;

    /**
     * the column name for the exp_list_id field
     */
    public const COL_EXP_LIST_ID = 'expense_list.exp_list_id';

    /**
     * the column name for the exp_id field
     */
    public const COL_EXP_ID = 'expense_list.exp_id';

    /**
     * the column name for the exp_master_id field
     */
    public const COL_EXP_MASTER_ID = 'expense_list.exp_master_id';

    /**
     * the column name for the exp_note field
     */
    public const COL_EXP_NOTE = 'expense_list.exp_note';

    /**
     * the column name for the exp_remark field
     */
    public const COL_EXP_REMARK = 'expense_list.exp_remark';

    /**
     * the column name for the exp_audit_remark field
     */
    public const COL_EXP_AUDIT_REMARK = 'expense_list.exp_audit_remark';

    /**
     * the column name for the exp_date field
     */
    public const COL_EXP_DATE = 'expense_list.exp_date';

    /**
     * the column name for the exp_tax_amount field
     */
    public const COL_EXP_TAX_AMOUNT = 'expense_list.exp_tax_amount';

    /**
     * the column name for the exp_claimed_tax field
     */
    public const COL_EXP_CLAIMED_TAX = 'expense_list.exp_claimed_tax';

    /**
     * the column name for the exp_test_amount field
     */
    public const COL_EXP_TEST_AMOUNT = 'expense_list.exp_test_amount';

    /**
     * the column name for the exp_rate_qty field
     */
    public const COL_EXP_RATE_QTY = 'expense_list.exp_rate_qty';

    /**
     * the column name for the exp_rate_mode field
     */
    public const COL_EXP_RATE_MODE = 'expense_list.exp_rate_mode';

    /**
     * the column name for the exp_il_amount field
     */
    public const COL_EXP_IL_AMOUNT = 'expense_list.exp_il_amount';

    /**
     * the column name for the exp_req_amount field
     */
    public const COL_EXP_REQ_AMOUNT = 'expense_list.exp_req_amount';

    /**
     * the column name for the exp_apr_amount field
     */
    public const COL_EXP_APR_AMOUNT = 'expense_list.exp_apr_amount';

    /**
     * the column name for the exp_audit_amount field
     */
    public const COL_EXP_AUDIT_AMOUNT = 'expense_list.exp_audit_amount';

    /**
     * the column name for the exp_final_amount field
     */
    public const COL_EXP_FINAL_AMOUNT = 'expense_list.exp_final_amount';

    /**
     * the column name for the exp_policy_key field
     */
    public const COL_EXP_POLICY_KEY = 'expense_list.exp_policy_key';

    /**
     * the column name for the exp_limit1 field
     */
    public const COL_EXP_LIMIT1 = 'expense_list.exp_limit1';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'expense_list.employee_id';

    /**
     * the column name for the cmp_card field
     */
    public const COL_CMP_CARD = 'expense_list.cmp_card';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'expense_list.company_id';

    /**
     * the column name for the is_readonly field
     */
    public const COL_IS_READONLY = 'expense_list.is_readonly';

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
        self::TYPE_PHPNAME       => ['ExpListId', 'ExpId', 'ExpMasterId', 'ExpNote', 'ExpRemark', 'ExpAuditRemark', 'ExpDate', 'ExpTaxAmount', 'ExpClaimedTax', 'ExpTestAmount', 'ExpRateQty', 'ExpRateMode', 'ExpIlAmount', 'ExpReqAmount', 'ExpAprAmount', 'ExpAuditAmount', 'ExpFinalAmount', 'ExpPolicyKey', 'ExpLimit1', 'EmployeeId', 'CmpCard', 'CompanyId', 'IsReadonly', ],
        self::TYPE_CAMELNAME     => ['expListId', 'expId', 'expMasterId', 'expNote', 'expRemark', 'expAuditRemark', 'expDate', 'expTaxAmount', 'expClaimedTax', 'expTestAmount', 'expRateQty', 'expRateMode', 'expIlAmount', 'expReqAmount', 'expAprAmount', 'expAuditAmount', 'expFinalAmount', 'expPolicyKey', 'expLimit1', 'employeeId', 'cmpCard', 'companyId', 'isReadonly', ],
        self::TYPE_COLNAME       => [ExpenseListTableMap::COL_EXP_LIST_ID, ExpenseListTableMap::COL_EXP_ID, ExpenseListTableMap::COL_EXP_MASTER_ID, ExpenseListTableMap::COL_EXP_NOTE, ExpenseListTableMap::COL_EXP_REMARK, ExpenseListTableMap::COL_EXP_AUDIT_REMARK, ExpenseListTableMap::COL_EXP_DATE, ExpenseListTableMap::COL_EXP_TAX_AMOUNT, ExpenseListTableMap::COL_EXP_CLAIMED_TAX, ExpenseListTableMap::COL_EXP_TEST_AMOUNT, ExpenseListTableMap::COL_EXP_RATE_QTY, ExpenseListTableMap::COL_EXP_RATE_MODE, ExpenseListTableMap::COL_EXP_IL_AMOUNT, ExpenseListTableMap::COL_EXP_REQ_AMOUNT, ExpenseListTableMap::COL_EXP_APR_AMOUNT, ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT, ExpenseListTableMap::COL_EXP_FINAL_AMOUNT, ExpenseListTableMap::COL_EXP_POLICY_KEY, ExpenseListTableMap::COL_EXP_LIMIT1, ExpenseListTableMap::COL_EMPLOYEE_ID, ExpenseListTableMap::COL_CMP_CARD, ExpenseListTableMap::COL_COMPANY_ID, ExpenseListTableMap::COL_IS_READONLY, ],
        self::TYPE_FIELDNAME     => ['exp_list_id', 'exp_id', 'exp_master_id', 'exp_note', 'exp_remark', 'exp_audit_remark', 'exp_date', 'exp_tax_amount', 'exp_claimed_tax', 'exp_test_amount', 'exp_rate_qty', 'exp_rate_mode', 'exp_il_amount', 'exp_req_amount', 'exp_apr_amount', 'exp_audit_amount', 'exp_final_amount', 'exp_policy_key', 'exp_limit1', 'employee_id', 'cmp_card', 'company_id', 'is_readonly', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
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
        self::TYPE_PHPNAME       => ['ExpListId' => 0, 'ExpId' => 1, 'ExpMasterId' => 2, 'ExpNote' => 3, 'ExpRemark' => 4, 'ExpAuditRemark' => 5, 'ExpDate' => 6, 'ExpTaxAmount' => 7, 'ExpClaimedTax' => 8, 'ExpTestAmount' => 9, 'ExpRateQty' => 10, 'ExpRateMode' => 11, 'ExpIlAmount' => 12, 'ExpReqAmount' => 13, 'ExpAprAmount' => 14, 'ExpAuditAmount' => 15, 'ExpFinalAmount' => 16, 'ExpPolicyKey' => 17, 'ExpLimit1' => 18, 'EmployeeId' => 19, 'CmpCard' => 20, 'CompanyId' => 21, 'IsReadonly' => 22, ],
        self::TYPE_CAMELNAME     => ['expListId' => 0, 'expId' => 1, 'expMasterId' => 2, 'expNote' => 3, 'expRemark' => 4, 'expAuditRemark' => 5, 'expDate' => 6, 'expTaxAmount' => 7, 'expClaimedTax' => 8, 'expTestAmount' => 9, 'expRateQty' => 10, 'expRateMode' => 11, 'expIlAmount' => 12, 'expReqAmount' => 13, 'expAprAmount' => 14, 'expAuditAmount' => 15, 'expFinalAmount' => 16, 'expPolicyKey' => 17, 'expLimit1' => 18, 'employeeId' => 19, 'cmpCard' => 20, 'companyId' => 21, 'isReadonly' => 22, ],
        self::TYPE_COLNAME       => [ExpenseListTableMap::COL_EXP_LIST_ID => 0, ExpenseListTableMap::COL_EXP_ID => 1, ExpenseListTableMap::COL_EXP_MASTER_ID => 2, ExpenseListTableMap::COL_EXP_NOTE => 3, ExpenseListTableMap::COL_EXP_REMARK => 4, ExpenseListTableMap::COL_EXP_AUDIT_REMARK => 5, ExpenseListTableMap::COL_EXP_DATE => 6, ExpenseListTableMap::COL_EXP_TAX_AMOUNT => 7, ExpenseListTableMap::COL_EXP_CLAIMED_TAX => 8, ExpenseListTableMap::COL_EXP_TEST_AMOUNT => 9, ExpenseListTableMap::COL_EXP_RATE_QTY => 10, ExpenseListTableMap::COL_EXP_RATE_MODE => 11, ExpenseListTableMap::COL_EXP_IL_AMOUNT => 12, ExpenseListTableMap::COL_EXP_REQ_AMOUNT => 13, ExpenseListTableMap::COL_EXP_APR_AMOUNT => 14, ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT => 15, ExpenseListTableMap::COL_EXP_FINAL_AMOUNT => 16, ExpenseListTableMap::COL_EXP_POLICY_KEY => 17, ExpenseListTableMap::COL_EXP_LIMIT1 => 18, ExpenseListTableMap::COL_EMPLOYEE_ID => 19, ExpenseListTableMap::COL_CMP_CARD => 20, ExpenseListTableMap::COL_COMPANY_ID => 21, ExpenseListTableMap::COL_IS_READONLY => 22, ],
        self::TYPE_FIELDNAME     => ['exp_list_id' => 0, 'exp_id' => 1, 'exp_master_id' => 2, 'exp_note' => 3, 'exp_remark' => 4, 'exp_audit_remark' => 5, 'exp_date' => 6, 'exp_tax_amount' => 7, 'exp_claimed_tax' => 8, 'exp_test_amount' => 9, 'exp_rate_qty' => 10, 'exp_rate_mode' => 11, 'exp_il_amount' => 12, 'exp_req_amount' => 13, 'exp_apr_amount' => 14, 'exp_audit_amount' => 15, 'exp_final_amount' => 16, 'exp_policy_key' => 17, 'exp_limit1' => 18, 'employee_id' => 19, 'cmp_card' => 20, 'company_id' => 21, 'is_readonly' => 22, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpListId' => 'EXP_LIST_ID',
        'ExpenseList.ExpListId' => 'EXP_LIST_ID',
        'expListId' => 'EXP_LIST_ID',
        'expenseList.expListId' => 'EXP_LIST_ID',
        'ExpenseListTableMap::COL_EXP_LIST_ID' => 'EXP_LIST_ID',
        'COL_EXP_LIST_ID' => 'EXP_LIST_ID',
        'exp_list_id' => 'EXP_LIST_ID',
        'expense_list.exp_list_id' => 'EXP_LIST_ID',
        'ExpId' => 'EXP_ID',
        'ExpenseList.ExpId' => 'EXP_ID',
        'expId' => 'EXP_ID',
        'expenseList.expId' => 'EXP_ID',
        'ExpenseListTableMap::COL_EXP_ID' => 'EXP_ID',
        'COL_EXP_ID' => 'EXP_ID',
        'exp_id' => 'EXP_ID',
        'expense_list.exp_id' => 'EXP_ID',
        'ExpMasterId' => 'EXP_MASTER_ID',
        'ExpenseList.ExpMasterId' => 'EXP_MASTER_ID',
        'expMasterId' => 'EXP_MASTER_ID',
        'expenseList.expMasterId' => 'EXP_MASTER_ID',
        'ExpenseListTableMap::COL_EXP_MASTER_ID' => 'EXP_MASTER_ID',
        'COL_EXP_MASTER_ID' => 'EXP_MASTER_ID',
        'exp_master_id' => 'EXP_MASTER_ID',
        'expense_list.exp_master_id' => 'EXP_MASTER_ID',
        'ExpNote' => 'EXP_NOTE',
        'ExpenseList.ExpNote' => 'EXP_NOTE',
        'expNote' => 'EXP_NOTE',
        'expenseList.expNote' => 'EXP_NOTE',
        'ExpenseListTableMap::COL_EXP_NOTE' => 'EXP_NOTE',
        'COL_EXP_NOTE' => 'EXP_NOTE',
        'exp_note' => 'EXP_NOTE',
        'expense_list.exp_note' => 'EXP_NOTE',
        'ExpRemark' => 'EXP_REMARK',
        'ExpenseList.ExpRemark' => 'EXP_REMARK',
        'expRemark' => 'EXP_REMARK',
        'expenseList.expRemark' => 'EXP_REMARK',
        'ExpenseListTableMap::COL_EXP_REMARK' => 'EXP_REMARK',
        'COL_EXP_REMARK' => 'EXP_REMARK',
        'exp_remark' => 'EXP_REMARK',
        'expense_list.exp_remark' => 'EXP_REMARK',
        'ExpAuditRemark' => 'EXP_AUDIT_REMARK',
        'ExpenseList.ExpAuditRemark' => 'EXP_AUDIT_REMARK',
        'expAuditRemark' => 'EXP_AUDIT_REMARK',
        'expenseList.expAuditRemark' => 'EXP_AUDIT_REMARK',
        'ExpenseListTableMap::COL_EXP_AUDIT_REMARK' => 'EXP_AUDIT_REMARK',
        'COL_EXP_AUDIT_REMARK' => 'EXP_AUDIT_REMARK',
        'exp_audit_remark' => 'EXP_AUDIT_REMARK',
        'expense_list.exp_audit_remark' => 'EXP_AUDIT_REMARK',
        'ExpDate' => 'EXP_DATE',
        'ExpenseList.ExpDate' => 'EXP_DATE',
        'expDate' => 'EXP_DATE',
        'expenseList.expDate' => 'EXP_DATE',
        'ExpenseListTableMap::COL_EXP_DATE' => 'EXP_DATE',
        'COL_EXP_DATE' => 'EXP_DATE',
        'exp_date' => 'EXP_DATE',
        'expense_list.exp_date' => 'EXP_DATE',
        'ExpTaxAmount' => 'EXP_TAX_AMOUNT',
        'ExpenseList.ExpTaxAmount' => 'EXP_TAX_AMOUNT',
        'expTaxAmount' => 'EXP_TAX_AMOUNT',
        'expenseList.expTaxAmount' => 'EXP_TAX_AMOUNT',
        'ExpenseListTableMap::COL_EXP_TAX_AMOUNT' => 'EXP_TAX_AMOUNT',
        'COL_EXP_TAX_AMOUNT' => 'EXP_TAX_AMOUNT',
        'exp_tax_amount' => 'EXP_TAX_AMOUNT',
        'expense_list.exp_tax_amount' => 'EXP_TAX_AMOUNT',
        'ExpClaimedTax' => 'EXP_CLAIMED_TAX',
        'ExpenseList.ExpClaimedTax' => 'EXP_CLAIMED_TAX',
        'expClaimedTax' => 'EXP_CLAIMED_TAX',
        'expenseList.expClaimedTax' => 'EXP_CLAIMED_TAX',
        'ExpenseListTableMap::COL_EXP_CLAIMED_TAX' => 'EXP_CLAIMED_TAX',
        'COL_EXP_CLAIMED_TAX' => 'EXP_CLAIMED_TAX',
        'exp_claimed_tax' => 'EXP_CLAIMED_TAX',
        'expense_list.exp_claimed_tax' => 'EXP_CLAIMED_TAX',
        'ExpTestAmount' => 'EXP_TEST_AMOUNT',
        'ExpenseList.ExpTestAmount' => 'EXP_TEST_AMOUNT',
        'expTestAmount' => 'EXP_TEST_AMOUNT',
        'expenseList.expTestAmount' => 'EXP_TEST_AMOUNT',
        'ExpenseListTableMap::COL_EXP_TEST_AMOUNT' => 'EXP_TEST_AMOUNT',
        'COL_EXP_TEST_AMOUNT' => 'EXP_TEST_AMOUNT',
        'exp_test_amount' => 'EXP_TEST_AMOUNT',
        'expense_list.exp_test_amount' => 'EXP_TEST_AMOUNT',
        'ExpRateQty' => 'EXP_RATE_QTY',
        'ExpenseList.ExpRateQty' => 'EXP_RATE_QTY',
        'expRateQty' => 'EXP_RATE_QTY',
        'expenseList.expRateQty' => 'EXP_RATE_QTY',
        'ExpenseListTableMap::COL_EXP_RATE_QTY' => 'EXP_RATE_QTY',
        'COL_EXP_RATE_QTY' => 'EXP_RATE_QTY',
        'exp_rate_qty' => 'EXP_RATE_QTY',
        'expense_list.exp_rate_qty' => 'EXP_RATE_QTY',
        'ExpRateMode' => 'EXP_RATE_MODE',
        'ExpenseList.ExpRateMode' => 'EXP_RATE_MODE',
        'expRateMode' => 'EXP_RATE_MODE',
        'expenseList.expRateMode' => 'EXP_RATE_MODE',
        'ExpenseListTableMap::COL_EXP_RATE_MODE' => 'EXP_RATE_MODE',
        'COL_EXP_RATE_MODE' => 'EXP_RATE_MODE',
        'exp_rate_mode' => 'EXP_RATE_MODE',
        'expense_list.exp_rate_mode' => 'EXP_RATE_MODE',
        'ExpIlAmount' => 'EXP_IL_AMOUNT',
        'ExpenseList.ExpIlAmount' => 'EXP_IL_AMOUNT',
        'expIlAmount' => 'EXP_IL_AMOUNT',
        'expenseList.expIlAmount' => 'EXP_IL_AMOUNT',
        'ExpenseListTableMap::COL_EXP_IL_AMOUNT' => 'EXP_IL_AMOUNT',
        'COL_EXP_IL_AMOUNT' => 'EXP_IL_AMOUNT',
        'exp_il_amount' => 'EXP_IL_AMOUNT',
        'expense_list.exp_il_amount' => 'EXP_IL_AMOUNT',
        'ExpReqAmount' => 'EXP_REQ_AMOUNT',
        'ExpenseList.ExpReqAmount' => 'EXP_REQ_AMOUNT',
        'expReqAmount' => 'EXP_REQ_AMOUNT',
        'expenseList.expReqAmount' => 'EXP_REQ_AMOUNT',
        'ExpenseListTableMap::COL_EXP_REQ_AMOUNT' => 'EXP_REQ_AMOUNT',
        'COL_EXP_REQ_AMOUNT' => 'EXP_REQ_AMOUNT',
        'exp_req_amount' => 'EXP_REQ_AMOUNT',
        'expense_list.exp_req_amount' => 'EXP_REQ_AMOUNT',
        'ExpAprAmount' => 'EXP_APR_AMOUNT',
        'ExpenseList.ExpAprAmount' => 'EXP_APR_AMOUNT',
        'expAprAmount' => 'EXP_APR_AMOUNT',
        'expenseList.expAprAmount' => 'EXP_APR_AMOUNT',
        'ExpenseListTableMap::COL_EXP_APR_AMOUNT' => 'EXP_APR_AMOUNT',
        'COL_EXP_APR_AMOUNT' => 'EXP_APR_AMOUNT',
        'exp_apr_amount' => 'EXP_APR_AMOUNT',
        'expense_list.exp_apr_amount' => 'EXP_APR_AMOUNT',
        'ExpAuditAmount' => 'EXP_AUDIT_AMOUNT',
        'ExpenseList.ExpAuditAmount' => 'EXP_AUDIT_AMOUNT',
        'expAuditAmount' => 'EXP_AUDIT_AMOUNT',
        'expenseList.expAuditAmount' => 'EXP_AUDIT_AMOUNT',
        'ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT' => 'EXP_AUDIT_AMOUNT',
        'COL_EXP_AUDIT_AMOUNT' => 'EXP_AUDIT_AMOUNT',
        'exp_audit_amount' => 'EXP_AUDIT_AMOUNT',
        'expense_list.exp_audit_amount' => 'EXP_AUDIT_AMOUNT',
        'ExpFinalAmount' => 'EXP_FINAL_AMOUNT',
        'ExpenseList.ExpFinalAmount' => 'EXP_FINAL_AMOUNT',
        'expFinalAmount' => 'EXP_FINAL_AMOUNT',
        'expenseList.expFinalAmount' => 'EXP_FINAL_AMOUNT',
        'ExpenseListTableMap::COL_EXP_FINAL_AMOUNT' => 'EXP_FINAL_AMOUNT',
        'COL_EXP_FINAL_AMOUNT' => 'EXP_FINAL_AMOUNT',
        'exp_final_amount' => 'EXP_FINAL_AMOUNT',
        'expense_list.exp_final_amount' => 'EXP_FINAL_AMOUNT',
        'ExpPolicyKey' => 'EXP_POLICY_KEY',
        'ExpenseList.ExpPolicyKey' => 'EXP_POLICY_KEY',
        'expPolicyKey' => 'EXP_POLICY_KEY',
        'expenseList.expPolicyKey' => 'EXP_POLICY_KEY',
        'ExpenseListTableMap::COL_EXP_POLICY_KEY' => 'EXP_POLICY_KEY',
        'COL_EXP_POLICY_KEY' => 'EXP_POLICY_KEY',
        'exp_policy_key' => 'EXP_POLICY_KEY',
        'expense_list.exp_policy_key' => 'EXP_POLICY_KEY',
        'ExpLimit1' => 'EXP_LIMIT1',
        'ExpenseList.ExpLimit1' => 'EXP_LIMIT1',
        'expLimit1' => 'EXP_LIMIT1',
        'expenseList.expLimit1' => 'EXP_LIMIT1',
        'ExpenseListTableMap::COL_EXP_LIMIT1' => 'EXP_LIMIT1',
        'COL_EXP_LIMIT1' => 'EXP_LIMIT1',
        'exp_limit1' => 'EXP_LIMIT1',
        'expense_list.exp_limit1' => 'EXP_LIMIT1',
        'EmployeeId' => 'EMPLOYEE_ID',
        'ExpenseList.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'expenseList.employeeId' => 'EMPLOYEE_ID',
        'ExpenseListTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'expense_list.employee_id' => 'EMPLOYEE_ID',
        'CmpCard' => 'CMP_CARD',
        'ExpenseList.CmpCard' => 'CMP_CARD',
        'cmpCard' => 'CMP_CARD',
        'expenseList.cmpCard' => 'CMP_CARD',
        'ExpenseListTableMap::COL_CMP_CARD' => 'CMP_CARD',
        'COL_CMP_CARD' => 'CMP_CARD',
        'cmp_card' => 'CMP_CARD',
        'expense_list.cmp_card' => 'CMP_CARD',
        'CompanyId' => 'COMPANY_ID',
        'ExpenseList.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'expenseList.companyId' => 'COMPANY_ID',
        'ExpenseListTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'expense_list.company_id' => 'COMPANY_ID',
        'IsReadonly' => 'IS_READONLY',
        'ExpenseList.IsReadonly' => 'IS_READONLY',
        'isReadonly' => 'IS_READONLY',
        'expenseList.isReadonly' => 'IS_READONLY',
        'ExpenseListTableMap::COL_IS_READONLY' => 'IS_READONLY',
        'COL_IS_READONLY' => 'IS_READONLY',
        'is_readonly' => 'IS_READONLY',
        'expense_list.is_readonly' => 'IS_READONLY',
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
        $this->setName('expense_list');
        $this->setPhpName('ExpenseList');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseList');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_list_exp_list_id_seq');
        // columns
        $this->addPrimaryKey('exp_list_id', 'ExpListId', 'INTEGER', true, null, null);
        $this->addForeignKey('exp_id', 'ExpId', 'INTEGER', 'expenses', 'exp_id', true, null, 0);
        $this->addForeignKey('exp_master_id', 'ExpMasterId', 'INTEGER', 'expense_master', 'expense_id', true, null, 0);
        $this->addColumn('exp_note', 'ExpNote', 'LONGVARCHAR', false, null, '');
        $this->addColumn('exp_remark', 'ExpRemark', 'LONGVARCHAR', false, null, '');
        $this->addColumn('exp_audit_remark', 'ExpAuditRemark', 'LONGVARCHAR', false, null, '');
        $this->addColumn('exp_date', 'ExpDate', 'DATE', true, null, null);
        $this->addColumn('exp_tax_amount', 'ExpTaxAmount', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_claimed_tax', 'ExpClaimedTax', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_test_amount', 'ExpTestAmount', 'DECIMAL', false, 10, 0.00);
        $this->addColumn('exp_rate_qty', 'ExpRateQty', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_rate_mode', 'ExpRateMode', 'VARCHAR', false, 50, null);
        $this->addColumn('exp_il_amount', 'ExpIlAmount', 'DECIMAL', false, 10, 0.00);
        $this->addColumn('exp_req_amount', 'ExpReqAmount', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_apr_amount', 'ExpAprAmount', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_audit_amount', 'ExpAuditAmount', 'DECIMAL', false, 10, null);
        $this->addColumn('exp_final_amount', 'ExpFinalAmount', 'DECIMAL', true, 10, null);
        $this->addColumn('exp_policy_key', 'ExpPolicyKey', 'VARCHAR', true, 50, null);
        $this->addColumn('exp_limit1', 'ExpLimit1', 'DECIMAL', true, 10, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', true, null, null);
        $this->addColumn('cmp_card', 'CmpCard', 'SMALLINT', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('is_readonly', 'IsReadonly', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('ExpenseMaster', '\\entities\\ExpenseMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':exp_master_id',
    1 => ':expense_id',
  ),
), null, null, null, false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
  ),
), null, null, null, false);
        $this->addRelation('ExpenseListDetails', '\\entities\\ExpenseListDetails', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':exp_list_id',
    1 => ':exp_list_id',
  ),
), null, null, 'ExpenseListDetailss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpListId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseListTableMap::CLASS_DEFAULT : ExpenseListTableMap::OM_CLASS;
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
     * @return array (ExpenseList object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseListTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseListTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseListTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseListTableMap::OM_CLASS;
            /** @var ExpenseList $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseListTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseListTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseListTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseList $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseListTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_LIST_ID);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_ID);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_MASTER_ID);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_NOTE);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_REMARK);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_AUDIT_REMARK);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_DATE);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_TAX_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_CLAIMED_TAX);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_TEST_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_RATE_QTY);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_RATE_MODE);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_IL_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_REQ_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_APR_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_POLICY_KEY);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EXP_LIMIT1);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_CMP_CARD);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ExpenseListTableMap::COL_IS_READONLY);
        } else {
            $criteria->addSelectColumn($alias . '.exp_list_id');
            $criteria->addSelectColumn($alias . '.exp_id');
            $criteria->addSelectColumn($alias . '.exp_master_id');
            $criteria->addSelectColumn($alias . '.exp_note');
            $criteria->addSelectColumn($alias . '.exp_remark');
            $criteria->addSelectColumn($alias . '.exp_audit_remark');
            $criteria->addSelectColumn($alias . '.exp_date');
            $criteria->addSelectColumn($alias . '.exp_tax_amount');
            $criteria->addSelectColumn($alias . '.exp_claimed_tax');
            $criteria->addSelectColumn($alias . '.exp_test_amount');
            $criteria->addSelectColumn($alias . '.exp_rate_qty');
            $criteria->addSelectColumn($alias . '.exp_rate_mode');
            $criteria->addSelectColumn($alias . '.exp_il_amount');
            $criteria->addSelectColumn($alias . '.exp_req_amount');
            $criteria->addSelectColumn($alias . '.exp_apr_amount');
            $criteria->addSelectColumn($alias . '.exp_audit_amount');
            $criteria->addSelectColumn($alias . '.exp_final_amount');
            $criteria->addSelectColumn($alias . '.exp_policy_key');
            $criteria->addSelectColumn($alias . '.exp_limit1');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.cmp_card');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.is_readonly');
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
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_LIST_ID);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_ID);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_MASTER_ID);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_NOTE);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_REMARK);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_AUDIT_REMARK);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_DATE);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_TAX_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_CLAIMED_TAX);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_TEST_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_RATE_QTY);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_RATE_MODE);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_IL_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_REQ_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_APR_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_AUDIT_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_FINAL_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_POLICY_KEY);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EXP_LIMIT1);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_CMP_CARD);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ExpenseListTableMap::COL_IS_READONLY);
        } else {
            $criteria->removeSelectColumn($alias . '.exp_list_id');
            $criteria->removeSelectColumn($alias . '.exp_id');
            $criteria->removeSelectColumn($alias . '.exp_master_id');
            $criteria->removeSelectColumn($alias . '.exp_note');
            $criteria->removeSelectColumn($alias . '.exp_remark');
            $criteria->removeSelectColumn($alias . '.exp_audit_remark');
            $criteria->removeSelectColumn($alias . '.exp_date');
            $criteria->removeSelectColumn($alias . '.exp_tax_amount');
            $criteria->removeSelectColumn($alias . '.exp_claimed_tax');
            $criteria->removeSelectColumn($alias . '.exp_test_amount');
            $criteria->removeSelectColumn($alias . '.exp_rate_qty');
            $criteria->removeSelectColumn($alias . '.exp_rate_mode');
            $criteria->removeSelectColumn($alias . '.exp_il_amount');
            $criteria->removeSelectColumn($alias . '.exp_req_amount');
            $criteria->removeSelectColumn($alias . '.exp_apr_amount');
            $criteria->removeSelectColumn($alias . '.exp_audit_amount');
            $criteria->removeSelectColumn($alias . '.exp_final_amount');
            $criteria->removeSelectColumn($alias . '.exp_policy_key');
            $criteria->removeSelectColumn($alias . '.exp_limit1');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.cmp_card');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.is_readonly');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseListTableMap::DATABASE_NAME)->getTable(ExpenseListTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseList or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseList object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseList) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseListTableMap::DATABASE_NAME);
            $criteria->add(ExpenseListTableMap::COL_EXP_LIST_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseListQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseListTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseListTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseListQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseList or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseList object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseList object
        }

        if ($criteria->containsKey(ExpenseListTableMap::COL_EXP_LIST_ID) && $criteria->keyContainsValue(ExpenseListTableMap::COL_EXP_LIST_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseListTableMap::COL_EXP_LIST_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseListQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

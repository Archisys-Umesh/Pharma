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
use entities\NotificationTemplates;
use entities\NotificationTemplatesQuery;


/**
 * This class defines the structure of the 'notification_templates' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NotificationTemplatesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.NotificationTemplatesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'notification_templates';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'NotificationTemplates';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\NotificationTemplates';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.NotificationTemplates';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the template_id field
     */
    public const COL_TEMPLATE_ID = 'notification_templates.template_id';

    /**
     * the column name for the template_key field
     */
    public const COL_TEMPLATE_KEY = 'notification_templates.template_key';

    /**
     * the column name for the email_subject field
     */
    public const COL_EMAIL_SUBJECT = 'notification_templates.email_subject';

    /**
     * the column name for the email_body field
     */
    public const COL_EMAIL_BODY = 'notification_templates.email_body';

    /**
     * the column name for the sms_message field
     */
    public const COL_SMS_MESSAGE = 'notification_templates.sms_message';

    /**
     * the column name for the sms_template_id field
     */
    public const COL_SMS_TEMPLATE_ID = 'notification_templates.sms_template_id';

    /**
     * the column name for the sms_type field
     */
    public const COL_SMS_TYPE = 'notification_templates.sms_type';

    /**
     * the column name for the sms_dlr field
     */
    public const COL_SMS_DLR = 'notification_templates.sms_dlr';

    /**
     * the column name for the push_title field
     */
    public const COL_PUSH_TITLE = 'notification_templates.push_title';

    /**
     * the column name for the push_message field
     */
    public const COL_PUSH_MESSAGE = 'notification_templates.push_message';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'notification_templates.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'notification_templates.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'notification_templates.updated_at';

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
        self::TYPE_PHPNAME       => ['TemplateId', 'TemplateKey', 'EmailSubject', 'EmailBody', 'SmsMessage', 'SmsTemplateId', 'SmsType', 'SmsDlr', 'PushTitle', 'PushMessage', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['templateId', 'templateKey', 'emailSubject', 'emailBody', 'smsMessage', 'smsTemplateId', 'smsType', 'smsDlr', 'pushTitle', 'pushMessage', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [NotificationTemplatesTableMap::COL_TEMPLATE_ID, NotificationTemplatesTableMap::COL_TEMPLATE_KEY, NotificationTemplatesTableMap::COL_EMAIL_SUBJECT, NotificationTemplatesTableMap::COL_EMAIL_BODY, NotificationTemplatesTableMap::COL_SMS_MESSAGE, NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID, NotificationTemplatesTableMap::COL_SMS_TYPE, NotificationTemplatesTableMap::COL_SMS_DLR, NotificationTemplatesTableMap::COL_PUSH_TITLE, NotificationTemplatesTableMap::COL_PUSH_MESSAGE, NotificationTemplatesTableMap::COL_COMPANY_ID, NotificationTemplatesTableMap::COL_CREATED_AT, NotificationTemplatesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['template_id', 'template_key', 'email_subject', 'email_body', 'sms_message', 'sms_template_id', 'sms_type', 'sms_dlr', 'push_title', 'push_message', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['TemplateId' => 0, 'TemplateKey' => 1, 'EmailSubject' => 2, 'EmailBody' => 3, 'SmsMessage' => 4, 'SmsTemplateId' => 5, 'SmsType' => 6, 'SmsDlr' => 7, 'PushTitle' => 8, 'PushMessage' => 9, 'CompanyId' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ],
        self::TYPE_CAMELNAME     => ['templateId' => 0, 'templateKey' => 1, 'emailSubject' => 2, 'emailBody' => 3, 'smsMessage' => 4, 'smsTemplateId' => 5, 'smsType' => 6, 'smsDlr' => 7, 'pushTitle' => 8, 'pushMessage' => 9, 'companyId' => 10, 'createdAt' => 11, 'updatedAt' => 12, ],
        self::TYPE_COLNAME       => [NotificationTemplatesTableMap::COL_TEMPLATE_ID => 0, NotificationTemplatesTableMap::COL_TEMPLATE_KEY => 1, NotificationTemplatesTableMap::COL_EMAIL_SUBJECT => 2, NotificationTemplatesTableMap::COL_EMAIL_BODY => 3, NotificationTemplatesTableMap::COL_SMS_MESSAGE => 4, NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID => 5, NotificationTemplatesTableMap::COL_SMS_TYPE => 6, NotificationTemplatesTableMap::COL_SMS_DLR => 7, NotificationTemplatesTableMap::COL_PUSH_TITLE => 8, NotificationTemplatesTableMap::COL_PUSH_MESSAGE => 9, NotificationTemplatesTableMap::COL_COMPANY_ID => 10, NotificationTemplatesTableMap::COL_CREATED_AT => 11, NotificationTemplatesTableMap::COL_UPDATED_AT => 12, ],
        self::TYPE_FIELDNAME     => ['template_id' => 0, 'template_key' => 1, 'email_subject' => 2, 'email_body' => 3, 'sms_message' => 4, 'sms_template_id' => 5, 'sms_type' => 6, 'sms_dlr' => 7, 'push_title' => 8, 'push_message' => 9, 'company_id' => 10, 'created_at' => 11, 'updated_at' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TemplateId' => 'TEMPLATE_ID',
        'NotificationTemplates.TemplateId' => 'TEMPLATE_ID',
        'templateId' => 'TEMPLATE_ID',
        'notificationTemplates.templateId' => 'TEMPLATE_ID',
        'NotificationTemplatesTableMap::COL_TEMPLATE_ID' => 'TEMPLATE_ID',
        'COL_TEMPLATE_ID' => 'TEMPLATE_ID',
        'template_id' => 'TEMPLATE_ID',
        'notification_templates.template_id' => 'TEMPLATE_ID',
        'TemplateKey' => 'TEMPLATE_KEY',
        'NotificationTemplates.TemplateKey' => 'TEMPLATE_KEY',
        'templateKey' => 'TEMPLATE_KEY',
        'notificationTemplates.templateKey' => 'TEMPLATE_KEY',
        'NotificationTemplatesTableMap::COL_TEMPLATE_KEY' => 'TEMPLATE_KEY',
        'COL_TEMPLATE_KEY' => 'TEMPLATE_KEY',
        'template_key' => 'TEMPLATE_KEY',
        'notification_templates.template_key' => 'TEMPLATE_KEY',
        'EmailSubject' => 'EMAIL_SUBJECT',
        'NotificationTemplates.EmailSubject' => 'EMAIL_SUBJECT',
        'emailSubject' => 'EMAIL_SUBJECT',
        'notificationTemplates.emailSubject' => 'EMAIL_SUBJECT',
        'NotificationTemplatesTableMap::COL_EMAIL_SUBJECT' => 'EMAIL_SUBJECT',
        'COL_EMAIL_SUBJECT' => 'EMAIL_SUBJECT',
        'email_subject' => 'EMAIL_SUBJECT',
        'notification_templates.email_subject' => 'EMAIL_SUBJECT',
        'EmailBody' => 'EMAIL_BODY',
        'NotificationTemplates.EmailBody' => 'EMAIL_BODY',
        'emailBody' => 'EMAIL_BODY',
        'notificationTemplates.emailBody' => 'EMAIL_BODY',
        'NotificationTemplatesTableMap::COL_EMAIL_BODY' => 'EMAIL_BODY',
        'COL_EMAIL_BODY' => 'EMAIL_BODY',
        'email_body' => 'EMAIL_BODY',
        'notification_templates.email_body' => 'EMAIL_BODY',
        'SmsMessage' => 'SMS_MESSAGE',
        'NotificationTemplates.SmsMessage' => 'SMS_MESSAGE',
        'smsMessage' => 'SMS_MESSAGE',
        'notificationTemplates.smsMessage' => 'SMS_MESSAGE',
        'NotificationTemplatesTableMap::COL_SMS_MESSAGE' => 'SMS_MESSAGE',
        'COL_SMS_MESSAGE' => 'SMS_MESSAGE',
        'sms_message' => 'SMS_MESSAGE',
        'notification_templates.sms_message' => 'SMS_MESSAGE',
        'SmsTemplateId' => 'SMS_TEMPLATE_ID',
        'NotificationTemplates.SmsTemplateId' => 'SMS_TEMPLATE_ID',
        'smsTemplateId' => 'SMS_TEMPLATE_ID',
        'notificationTemplates.smsTemplateId' => 'SMS_TEMPLATE_ID',
        'NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID' => 'SMS_TEMPLATE_ID',
        'COL_SMS_TEMPLATE_ID' => 'SMS_TEMPLATE_ID',
        'sms_template_id' => 'SMS_TEMPLATE_ID',
        'notification_templates.sms_template_id' => 'SMS_TEMPLATE_ID',
        'SmsType' => 'SMS_TYPE',
        'NotificationTemplates.SmsType' => 'SMS_TYPE',
        'smsType' => 'SMS_TYPE',
        'notificationTemplates.smsType' => 'SMS_TYPE',
        'NotificationTemplatesTableMap::COL_SMS_TYPE' => 'SMS_TYPE',
        'COL_SMS_TYPE' => 'SMS_TYPE',
        'sms_type' => 'SMS_TYPE',
        'notification_templates.sms_type' => 'SMS_TYPE',
        'SmsDlr' => 'SMS_DLR',
        'NotificationTemplates.SmsDlr' => 'SMS_DLR',
        'smsDlr' => 'SMS_DLR',
        'notificationTemplates.smsDlr' => 'SMS_DLR',
        'NotificationTemplatesTableMap::COL_SMS_DLR' => 'SMS_DLR',
        'COL_SMS_DLR' => 'SMS_DLR',
        'sms_dlr' => 'SMS_DLR',
        'notification_templates.sms_dlr' => 'SMS_DLR',
        'PushTitle' => 'PUSH_TITLE',
        'NotificationTemplates.PushTitle' => 'PUSH_TITLE',
        'pushTitle' => 'PUSH_TITLE',
        'notificationTemplates.pushTitle' => 'PUSH_TITLE',
        'NotificationTemplatesTableMap::COL_PUSH_TITLE' => 'PUSH_TITLE',
        'COL_PUSH_TITLE' => 'PUSH_TITLE',
        'push_title' => 'PUSH_TITLE',
        'notification_templates.push_title' => 'PUSH_TITLE',
        'PushMessage' => 'PUSH_MESSAGE',
        'NotificationTemplates.PushMessage' => 'PUSH_MESSAGE',
        'pushMessage' => 'PUSH_MESSAGE',
        'notificationTemplates.pushMessage' => 'PUSH_MESSAGE',
        'NotificationTemplatesTableMap::COL_PUSH_MESSAGE' => 'PUSH_MESSAGE',
        'COL_PUSH_MESSAGE' => 'PUSH_MESSAGE',
        'push_message' => 'PUSH_MESSAGE',
        'notification_templates.push_message' => 'PUSH_MESSAGE',
        'CompanyId' => 'COMPANY_ID',
        'NotificationTemplates.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'notificationTemplates.companyId' => 'COMPANY_ID',
        'NotificationTemplatesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'notification_templates.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'NotificationTemplates.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'notificationTemplates.createdAt' => 'CREATED_AT',
        'NotificationTemplatesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'notification_templates.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'NotificationTemplates.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'notificationTemplates.updatedAt' => 'UPDATED_AT',
        'NotificationTemplatesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'notification_templates.updated_at' => 'UPDATED_AT',
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
        $this->setName('notification_templates');
        $this->setPhpName('NotificationTemplates');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\NotificationTemplates');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('notification_templates_template_id_seq');
        // columns
        $this->addPrimaryKey('template_id', 'TemplateId', 'INTEGER', true, null, null);
        $this->addColumn('template_key', 'TemplateKey', 'VARCHAR', true, 250, null);
        $this->addColumn('email_subject', 'EmailSubject', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email_body', 'EmailBody', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sms_message', 'SmsMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sms_template_id', 'SmsTemplateId', 'VARCHAR', false, 250, null);
        $this->addColumn('sms_type', 'SmsType', 'VARCHAR', false, 250, null);
        $this->addColumn('sms_dlr', 'SmsDlr', 'VARCHAR', false, 250, null);
        $this->addColumn('push_title', 'PushTitle', 'LONGVARCHAR', false, null, null);
        $this->addColumn('push_message', 'PushMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NotificationTemplatesTableMap::CLASS_DEFAULT : NotificationTemplatesTableMap::OM_CLASS;
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
     * @return array (NotificationTemplates object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NotificationTemplatesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NotificationTemplatesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NotificationTemplatesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NotificationTemplatesTableMap::OM_CLASS;
            /** @var NotificationTemplates $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NotificationTemplatesTableMap::addInstanceToPool($obj, $key);
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
            $key = NotificationTemplatesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NotificationTemplatesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NotificationTemplates $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NotificationTemplatesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_TEMPLATE_ID);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_TEMPLATE_KEY);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_EMAIL_BODY);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_SMS_MESSAGE);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_SMS_TYPE);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_SMS_DLR);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_PUSH_TITLE);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_PUSH_MESSAGE);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(NotificationTemplatesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.template_id');
            $criteria->addSelectColumn($alias . '.template_key');
            $criteria->addSelectColumn($alias . '.email_subject');
            $criteria->addSelectColumn($alias . '.email_body');
            $criteria->addSelectColumn($alias . '.sms_message');
            $criteria->addSelectColumn($alias . '.sms_template_id');
            $criteria->addSelectColumn($alias . '.sms_type');
            $criteria->addSelectColumn($alias . '.sms_dlr');
            $criteria->addSelectColumn($alias . '.push_title');
            $criteria->addSelectColumn($alias . '.push_message');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_TEMPLATE_ID);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_TEMPLATE_KEY);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_EMAIL_BODY);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_SMS_MESSAGE);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_SMS_TYPE);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_SMS_DLR);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_PUSH_TITLE);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_PUSH_MESSAGE);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(NotificationTemplatesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.template_id');
            $criteria->removeSelectColumn($alias . '.template_key');
            $criteria->removeSelectColumn($alias . '.email_subject');
            $criteria->removeSelectColumn($alias . '.email_body');
            $criteria->removeSelectColumn($alias . '.sms_message');
            $criteria->removeSelectColumn($alias . '.sms_template_id');
            $criteria->removeSelectColumn($alias . '.sms_type');
            $criteria->removeSelectColumn($alias . '.sms_dlr');
            $criteria->removeSelectColumn($alias . '.push_title');
            $criteria->removeSelectColumn($alias . '.push_message');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(NotificationTemplatesTableMap::DATABASE_NAME)->getTable(NotificationTemplatesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a NotificationTemplates or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or NotificationTemplates object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\NotificationTemplates) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NotificationTemplatesTableMap::DATABASE_NAME);
            $criteria->add(NotificationTemplatesTableMap::COL_TEMPLATE_ID, (array) $values, Criteria::IN);
        }

        $query = NotificationTemplatesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NotificationTemplatesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NotificationTemplatesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the notification_templates table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NotificationTemplatesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NotificationTemplates or Criteria object.
     *
     * @param mixed $criteria Criteria or NotificationTemplates object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NotificationTemplates object
        }

        if ($criteria->containsKey(NotificationTemplatesTableMap::COL_TEMPLATE_ID) && $criteria->keyContainsValue(NotificationTemplatesTableMap::COL_TEMPLATE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NotificationTemplatesTableMap::COL_TEMPLATE_ID.')');
        }


        // Set the correct dbName
        $query = NotificationTemplatesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

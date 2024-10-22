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
use entities\EmailNotifications;
use entities\EmailNotificationsQuery;


/**
 * This class defines the structure of the 'email_notifications' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmailNotificationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmailNotificationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'email_notifications';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmailNotifications';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmailNotifications';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmailNotifications';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the email_notification_id field
     */
    public const COL_EMAIL_NOTIFICATION_ID = 'email_notifications.email_notification_id';

    /**
     * the column name for the to_emails field
     */
    public const COL_TO_EMAILS = 'email_notifications.to_emails';

    /**
     * the column name for the cc_emails field
     */
    public const COL_CC_EMAILS = 'email_notifications.cc_emails';

    /**
     * the column name for the bcc_emails field
     */
    public const COL_BCC_EMAILS = 'email_notifications.bcc_emails';

    /**
     * the column name for the email_subject field
     */
    public const COL_EMAIL_SUBJECT = 'email_notifications.email_subject';

    /**
     * the column name for the email_body field
     */
    public const COL_EMAIL_BODY = 'email_notifications.email_body';

    /**
     * the column name for the schedule_at field
     */
    public const COL_SCHEDULE_AT = 'email_notifications.schedule_at';

    /**
     * the column name for the email_sent_datetime field
     */
    public const COL_EMAIL_SENT_DATETIME = 'email_notifications.email_sent_datetime';

    /**
     * the column name for the email_sent_status field
     */
    public const COL_EMAIL_SENT_STATUS = 'email_notifications.email_sent_status';

    /**
     * the column name for the email_trans_id field
     */
    public const COL_EMAIL_TRANS_ID = 'email_notifications.email_trans_id';

    /**
     * the column name for the email_sent_attempts field
     */
    public const COL_EMAIL_SENT_ATTEMPTS = 'email_notifications.email_sent_attempts';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'email_notifications.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'email_notifications.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'email_notifications.updated_at';

    /**
     * the column name for the email_constants field
     */
    public const COL_EMAIL_CONSTANTS = 'email_notifications.email_constants';

    /**
     * the column name for the email_type field
     */
    public const COL_EMAIL_TYPE = 'email_notifications.email_type';

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
        self::TYPE_PHPNAME       => ['EmailNotificationId', 'ToEmails', 'CcEmails', 'BccEmails', 'EmailSubject', 'EmailBody', 'ScheduleAt', 'EmailSentDatetime', 'EmailSentStatus', 'EmailTransId', 'EmailSentAttempts', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'EmailConstants', 'EmailType', ],
        self::TYPE_CAMELNAME     => ['emailNotificationId', 'toEmails', 'ccEmails', 'bccEmails', 'emailSubject', 'emailBody', 'scheduleAt', 'emailSentDatetime', 'emailSentStatus', 'emailTransId', 'emailSentAttempts', 'companyId', 'createdAt', 'updatedAt', 'emailConstants', 'emailType', ],
        self::TYPE_COLNAME       => [EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, EmailNotificationsTableMap::COL_TO_EMAILS, EmailNotificationsTableMap::COL_CC_EMAILS, EmailNotificationsTableMap::COL_BCC_EMAILS, EmailNotificationsTableMap::COL_EMAIL_SUBJECT, EmailNotificationsTableMap::COL_EMAIL_BODY, EmailNotificationsTableMap::COL_SCHEDULE_AT, EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME, EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS, EmailNotificationsTableMap::COL_EMAIL_TRANS_ID, EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, EmailNotificationsTableMap::COL_COMPANY_ID, EmailNotificationsTableMap::COL_CREATED_AT, EmailNotificationsTableMap::COL_UPDATED_AT, EmailNotificationsTableMap::COL_EMAIL_CONSTANTS, EmailNotificationsTableMap::COL_EMAIL_TYPE, ],
        self::TYPE_FIELDNAME     => ['email_notification_id', 'to_emails', 'cc_emails', 'bcc_emails', 'email_subject', 'email_body', 'schedule_at', 'email_sent_datetime', 'email_sent_status', 'email_trans_id', 'email_sent_attempts', 'company_id', 'created_at', 'updated_at', 'email_constants', 'email_type', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
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
        self::TYPE_PHPNAME       => ['EmailNotificationId' => 0, 'ToEmails' => 1, 'CcEmails' => 2, 'BccEmails' => 3, 'EmailSubject' => 4, 'EmailBody' => 5, 'ScheduleAt' => 6, 'EmailSentDatetime' => 7, 'EmailSentStatus' => 8, 'EmailTransId' => 9, 'EmailSentAttempts' => 10, 'CompanyId' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, 'EmailConstants' => 14, 'EmailType' => 15, ],
        self::TYPE_CAMELNAME     => ['emailNotificationId' => 0, 'toEmails' => 1, 'ccEmails' => 2, 'bccEmails' => 3, 'emailSubject' => 4, 'emailBody' => 5, 'scheduleAt' => 6, 'emailSentDatetime' => 7, 'emailSentStatus' => 8, 'emailTransId' => 9, 'emailSentAttempts' => 10, 'companyId' => 11, 'createdAt' => 12, 'updatedAt' => 13, 'emailConstants' => 14, 'emailType' => 15, ],
        self::TYPE_COLNAME       => [EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID => 0, EmailNotificationsTableMap::COL_TO_EMAILS => 1, EmailNotificationsTableMap::COL_CC_EMAILS => 2, EmailNotificationsTableMap::COL_BCC_EMAILS => 3, EmailNotificationsTableMap::COL_EMAIL_SUBJECT => 4, EmailNotificationsTableMap::COL_EMAIL_BODY => 5, EmailNotificationsTableMap::COL_SCHEDULE_AT => 6, EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME => 7, EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS => 8, EmailNotificationsTableMap::COL_EMAIL_TRANS_ID => 9, EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS => 10, EmailNotificationsTableMap::COL_COMPANY_ID => 11, EmailNotificationsTableMap::COL_CREATED_AT => 12, EmailNotificationsTableMap::COL_UPDATED_AT => 13, EmailNotificationsTableMap::COL_EMAIL_CONSTANTS => 14, EmailNotificationsTableMap::COL_EMAIL_TYPE => 15, ],
        self::TYPE_FIELDNAME     => ['email_notification_id' => 0, 'to_emails' => 1, 'cc_emails' => 2, 'bcc_emails' => 3, 'email_subject' => 4, 'email_body' => 5, 'schedule_at' => 6, 'email_sent_datetime' => 7, 'email_sent_status' => 8, 'email_trans_id' => 9, 'email_sent_attempts' => 10, 'company_id' => 11, 'created_at' => 12, 'updated_at' => 13, 'email_constants' => 14, 'email_type' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmailNotificationId' => 'EMAIL_NOTIFICATION_ID',
        'EmailNotifications.EmailNotificationId' => 'EMAIL_NOTIFICATION_ID',
        'emailNotificationId' => 'EMAIL_NOTIFICATION_ID',
        'emailNotifications.emailNotificationId' => 'EMAIL_NOTIFICATION_ID',
        'EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID' => 'EMAIL_NOTIFICATION_ID',
        'COL_EMAIL_NOTIFICATION_ID' => 'EMAIL_NOTIFICATION_ID',
        'email_notification_id' => 'EMAIL_NOTIFICATION_ID',
        'email_notifications.email_notification_id' => 'EMAIL_NOTIFICATION_ID',
        'ToEmails' => 'TO_EMAILS',
        'EmailNotifications.ToEmails' => 'TO_EMAILS',
        'toEmails' => 'TO_EMAILS',
        'emailNotifications.toEmails' => 'TO_EMAILS',
        'EmailNotificationsTableMap::COL_TO_EMAILS' => 'TO_EMAILS',
        'COL_TO_EMAILS' => 'TO_EMAILS',
        'to_emails' => 'TO_EMAILS',
        'email_notifications.to_emails' => 'TO_EMAILS',
        'CcEmails' => 'CC_EMAILS',
        'EmailNotifications.CcEmails' => 'CC_EMAILS',
        'ccEmails' => 'CC_EMAILS',
        'emailNotifications.ccEmails' => 'CC_EMAILS',
        'EmailNotificationsTableMap::COL_CC_EMAILS' => 'CC_EMAILS',
        'COL_CC_EMAILS' => 'CC_EMAILS',
        'cc_emails' => 'CC_EMAILS',
        'email_notifications.cc_emails' => 'CC_EMAILS',
        'BccEmails' => 'BCC_EMAILS',
        'EmailNotifications.BccEmails' => 'BCC_EMAILS',
        'bccEmails' => 'BCC_EMAILS',
        'emailNotifications.bccEmails' => 'BCC_EMAILS',
        'EmailNotificationsTableMap::COL_BCC_EMAILS' => 'BCC_EMAILS',
        'COL_BCC_EMAILS' => 'BCC_EMAILS',
        'bcc_emails' => 'BCC_EMAILS',
        'email_notifications.bcc_emails' => 'BCC_EMAILS',
        'EmailSubject' => 'EMAIL_SUBJECT',
        'EmailNotifications.EmailSubject' => 'EMAIL_SUBJECT',
        'emailSubject' => 'EMAIL_SUBJECT',
        'emailNotifications.emailSubject' => 'EMAIL_SUBJECT',
        'EmailNotificationsTableMap::COL_EMAIL_SUBJECT' => 'EMAIL_SUBJECT',
        'COL_EMAIL_SUBJECT' => 'EMAIL_SUBJECT',
        'email_subject' => 'EMAIL_SUBJECT',
        'email_notifications.email_subject' => 'EMAIL_SUBJECT',
        'EmailBody' => 'EMAIL_BODY',
        'EmailNotifications.EmailBody' => 'EMAIL_BODY',
        'emailBody' => 'EMAIL_BODY',
        'emailNotifications.emailBody' => 'EMAIL_BODY',
        'EmailNotificationsTableMap::COL_EMAIL_BODY' => 'EMAIL_BODY',
        'COL_EMAIL_BODY' => 'EMAIL_BODY',
        'email_body' => 'EMAIL_BODY',
        'email_notifications.email_body' => 'EMAIL_BODY',
        'ScheduleAt' => 'SCHEDULE_AT',
        'EmailNotifications.ScheduleAt' => 'SCHEDULE_AT',
        'scheduleAt' => 'SCHEDULE_AT',
        'emailNotifications.scheduleAt' => 'SCHEDULE_AT',
        'EmailNotificationsTableMap::COL_SCHEDULE_AT' => 'SCHEDULE_AT',
        'COL_SCHEDULE_AT' => 'SCHEDULE_AT',
        'schedule_at' => 'SCHEDULE_AT',
        'email_notifications.schedule_at' => 'SCHEDULE_AT',
        'EmailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'EmailNotifications.EmailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'emailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'emailNotifications.emailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME' => 'EMAIL_SENT_DATETIME',
        'COL_EMAIL_SENT_DATETIME' => 'EMAIL_SENT_DATETIME',
        'email_sent_datetime' => 'EMAIL_SENT_DATETIME',
        'email_notifications.email_sent_datetime' => 'EMAIL_SENT_DATETIME',
        'EmailSentStatus' => 'EMAIL_SENT_STATUS',
        'EmailNotifications.EmailSentStatus' => 'EMAIL_SENT_STATUS',
        'emailSentStatus' => 'EMAIL_SENT_STATUS',
        'emailNotifications.emailSentStatus' => 'EMAIL_SENT_STATUS',
        'EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS' => 'EMAIL_SENT_STATUS',
        'COL_EMAIL_SENT_STATUS' => 'EMAIL_SENT_STATUS',
        'email_sent_status' => 'EMAIL_SENT_STATUS',
        'email_notifications.email_sent_status' => 'EMAIL_SENT_STATUS',
        'EmailTransId' => 'EMAIL_TRANS_ID',
        'EmailNotifications.EmailTransId' => 'EMAIL_TRANS_ID',
        'emailTransId' => 'EMAIL_TRANS_ID',
        'emailNotifications.emailTransId' => 'EMAIL_TRANS_ID',
        'EmailNotificationsTableMap::COL_EMAIL_TRANS_ID' => 'EMAIL_TRANS_ID',
        'COL_EMAIL_TRANS_ID' => 'EMAIL_TRANS_ID',
        'email_trans_id' => 'EMAIL_TRANS_ID',
        'email_notifications.email_trans_id' => 'EMAIL_TRANS_ID',
        'EmailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'EmailNotifications.EmailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'emailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'emailNotifications.emailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS' => 'EMAIL_SENT_ATTEMPTS',
        'COL_EMAIL_SENT_ATTEMPTS' => 'EMAIL_SENT_ATTEMPTS',
        'email_sent_attempts' => 'EMAIL_SENT_ATTEMPTS',
        'email_notifications.email_sent_attempts' => 'EMAIL_SENT_ATTEMPTS',
        'CompanyId' => 'COMPANY_ID',
        'EmailNotifications.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'emailNotifications.companyId' => 'COMPANY_ID',
        'EmailNotificationsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'email_notifications.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'EmailNotifications.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'emailNotifications.createdAt' => 'CREATED_AT',
        'EmailNotificationsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'email_notifications.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EmailNotifications.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'emailNotifications.updatedAt' => 'UPDATED_AT',
        'EmailNotificationsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'email_notifications.updated_at' => 'UPDATED_AT',
        'EmailConstants' => 'EMAIL_CONSTANTS',
        'EmailNotifications.EmailConstants' => 'EMAIL_CONSTANTS',
        'emailConstants' => 'EMAIL_CONSTANTS',
        'emailNotifications.emailConstants' => 'EMAIL_CONSTANTS',
        'EmailNotificationsTableMap::COL_EMAIL_CONSTANTS' => 'EMAIL_CONSTANTS',
        'COL_EMAIL_CONSTANTS' => 'EMAIL_CONSTANTS',
        'email_constants' => 'EMAIL_CONSTANTS',
        'email_notifications.email_constants' => 'EMAIL_CONSTANTS',
        'EmailType' => 'EMAIL_TYPE',
        'EmailNotifications.EmailType' => 'EMAIL_TYPE',
        'emailType' => 'EMAIL_TYPE',
        'emailNotifications.emailType' => 'EMAIL_TYPE',
        'EmailNotificationsTableMap::COL_EMAIL_TYPE' => 'EMAIL_TYPE',
        'COL_EMAIL_TYPE' => 'EMAIL_TYPE',
        'email_type' => 'EMAIL_TYPE',
        'email_notifications.email_type' => 'EMAIL_TYPE',
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
        $this->setName('email_notifications');
        $this->setPhpName('EmailNotifications');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmailNotifications');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('email_notifications_email_notification_id_seq');
        // columns
        $this->addPrimaryKey('email_notification_id', 'EmailNotificationId', 'INTEGER', true, null, null);
        $this->addColumn('to_emails', 'ToEmails', 'LONGVARCHAR', false, null, null);
        $this->addColumn('cc_emails', 'CcEmails', 'LONGVARCHAR', false, null, null);
        $this->addColumn('bcc_emails', 'BccEmails', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email_subject', 'EmailSubject', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email_body', 'EmailBody', 'LONGVARCHAR', false, null, null);
        $this->addColumn('schedule_at', 'ScheduleAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('email_sent_datetime', 'EmailSentDatetime', 'TIMESTAMP', false, null, null);
        $this->addColumn('email_sent_status', 'EmailSentStatus', 'BOOLEAN', false, 1, null);
        $this->addColumn('email_trans_id', 'EmailTransId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email_sent_attempts', 'EmailSentAttempts', 'INTEGER', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('email_constants', 'EmailConstants', 'LONGVARCHAR', false, null, null);
        $this->addColumn('email_type', 'EmailType', 'VARCHAR', false, 50, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmailNotificationsTableMap::CLASS_DEFAULT : EmailNotificationsTableMap::OM_CLASS;
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
     * @return array (EmailNotifications object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmailNotificationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmailNotificationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmailNotificationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmailNotificationsTableMap::OM_CLASS;
            /** @var EmailNotifications $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmailNotificationsTableMap::addInstanceToPool($obj, $key);
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
            $key = EmailNotificationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmailNotificationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmailNotifications $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmailNotificationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_TO_EMAILS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_CC_EMAILS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_BCC_EMAILS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SUBJECT);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_BODY);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_SCHEDULE_AT);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS);
            $criteria->addSelectColumn(EmailNotificationsTableMap::COL_EMAIL_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.email_notification_id');
            $criteria->addSelectColumn($alias . '.to_emails');
            $criteria->addSelectColumn($alias . '.cc_emails');
            $criteria->addSelectColumn($alias . '.bcc_emails');
            $criteria->addSelectColumn($alias . '.email_subject');
            $criteria->addSelectColumn($alias . '.email_body');
            $criteria->addSelectColumn($alias . '.schedule_at');
            $criteria->addSelectColumn($alias . '.email_sent_datetime');
            $criteria->addSelectColumn($alias . '.email_sent_status');
            $criteria->addSelectColumn($alias . '.email_trans_id');
            $criteria->addSelectColumn($alias . '.email_sent_attempts');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.email_constants');
            $criteria->addSelectColumn($alias . '.email_type');
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
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_TO_EMAILS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_CC_EMAILS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_BCC_EMAILS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SUBJECT);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_BODY);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_SCHEDULE_AT);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS);
            $criteria->removeSelectColumn(EmailNotificationsTableMap::COL_EMAIL_TYPE);
        } else {
            $criteria->removeSelectColumn($alias . '.email_notification_id');
            $criteria->removeSelectColumn($alias . '.to_emails');
            $criteria->removeSelectColumn($alias . '.cc_emails');
            $criteria->removeSelectColumn($alias . '.bcc_emails');
            $criteria->removeSelectColumn($alias . '.email_subject');
            $criteria->removeSelectColumn($alias . '.email_body');
            $criteria->removeSelectColumn($alias . '.schedule_at');
            $criteria->removeSelectColumn($alias . '.email_sent_datetime');
            $criteria->removeSelectColumn($alias . '.email_sent_status');
            $criteria->removeSelectColumn($alias . '.email_trans_id');
            $criteria->removeSelectColumn($alias . '.email_sent_attempts');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.email_constants');
            $criteria->removeSelectColumn($alias . '.email_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmailNotificationsTableMap::DATABASE_NAME)->getTable(EmailNotificationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmailNotifications or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmailNotifications object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmailNotifications) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmailNotificationsTableMap::DATABASE_NAME);
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, (array) $values, Criteria::IN);
        }

        $query = EmailNotificationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmailNotificationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmailNotificationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the email_notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmailNotificationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmailNotifications or Criteria object.
     *
     * @param mixed $criteria Criteria or EmailNotifications object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmailNotifications object
        }

        if ($criteria->containsKey(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID) && $criteria->keyContainsValue(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID.')');
        }


        // Set the correct dbName
        $query = EmailNotificationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

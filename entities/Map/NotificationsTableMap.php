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
use entities\Notifications;
use entities\NotificationsQuery;


/**
 * This class defines the structure of the 'notifications' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NotificationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.NotificationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'notifications';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Notifications';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Notifications';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Notifications';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 24;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 24;

    /**
     * the column name for the notification_id field
     */
    public const COL_NOTIFICATION_ID = 'notifications.notification_id';

    /**
     * the column name for the to_employee_id field
     */
    public const COL_TO_EMPLOYEE_ID = 'notifications.to_employee_id';

    /**
     * the column name for the cc_employee_ids field
     */
    public const COL_CC_EMPLOYEE_IDS = 'notifications.cc_employee_ids';

    /**
     * the column name for the template_key field
     */
    public const COL_TEMPLATE_KEY = 'notifications.template_key';

    /**
     * the column name for the data_dump field
     */
    public const COL_DATA_DUMP = 'notifications.data_dump';

    /**
     * the column name for the send_email field
     */
    public const COL_SEND_EMAIL = 'notifications.send_email';

    /**
     * the column name for the send_sms field
     */
    public const COL_SEND_SMS = 'notifications.send_sms';

    /**
     * the column name for the send_push field
     */
    public const COL_SEND_PUSH = 'notifications.send_push';

    /**
     * the column name for the email_sent_datetime field
     */
    public const COL_EMAIL_SENT_DATETIME = 'notifications.email_sent_datetime';

    /**
     * the column name for the email_sent_status field
     */
    public const COL_EMAIL_SENT_STATUS = 'notifications.email_sent_status';

    /**
     * the column name for the email_trans_id field
     */
    public const COL_EMAIL_TRANS_ID = 'notifications.email_trans_id';

    /**
     * the column name for the sms_sent_datetime field
     */
    public const COL_SMS_SENT_DATETIME = 'notifications.sms_sent_datetime';

    /**
     * the column name for the sms_sent_status field
     */
    public const COL_SMS_SENT_STATUS = 'notifications.sms_sent_status';

    /**
     * the column name for the sms_trans_id field
     */
    public const COL_SMS_TRANS_ID = 'notifications.sms_trans_id';

    /**
     * the column name for the push_sent_datetime field
     */
    public const COL_PUSH_SENT_DATETIME = 'notifications.push_sent_datetime';

    /**
     * the column name for the push_sent_status field
     */
    public const COL_PUSH_SENT_STATUS = 'notifications.push_sent_status';

    /**
     * the column name for the push_trans_id field
     */
    public const COL_PUSH_TRANS_ID = 'notifications.push_trans_id';

    /**
     * the column name for the schedule_at field
     */
    public const COL_SCHEDULE_AT = 'notifications.schedule_at';

    /**
     * the column name for the email_sent_attempts field
     */
    public const COL_EMAIL_SENT_ATTEMPTS = 'notifications.email_sent_attempts';

    /**
     * the column name for the sms_sent_attempts field
     */
    public const COL_SMS_SENT_ATTEMPTS = 'notifications.sms_sent_attempts';

    /**
     * the column name for the push_sent_attempts field
     */
    public const COL_PUSH_SENT_ATTEMPTS = 'notifications.push_sent_attempts';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'notifications.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'notifications.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'notifications.updated_at';

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
        self::TYPE_PHPNAME       => ['NotificationId', 'ToEmployeeId', 'CcEmployeeIds', 'TemplateKey', 'DataDump', 'SendEmail', 'SendSms', 'SendPush', 'EmailSentDatetime', 'EmailSentStatus', 'EmailTransId', 'SmsSentDatetime', 'SmsSentStatus', 'SmsTransId', 'PushSentDatetime', 'PushSentStatus', 'PushTransId', 'ScheduleAt', 'EmailSentAttempts', 'SmsSentAttempts', 'PushSentAttempts', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['notificationId', 'toEmployeeId', 'ccEmployeeIds', 'templateKey', 'dataDump', 'sendEmail', 'sendSms', 'sendPush', 'emailSentDatetime', 'emailSentStatus', 'emailTransId', 'smsSentDatetime', 'smsSentStatus', 'smsTransId', 'pushSentDatetime', 'pushSentStatus', 'pushTransId', 'scheduleAt', 'emailSentAttempts', 'smsSentAttempts', 'pushSentAttempts', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [NotificationsTableMap::COL_NOTIFICATION_ID, NotificationsTableMap::COL_TO_EMPLOYEE_ID, NotificationsTableMap::COL_CC_EMPLOYEE_IDS, NotificationsTableMap::COL_TEMPLATE_KEY, NotificationsTableMap::COL_DATA_DUMP, NotificationsTableMap::COL_SEND_EMAIL, NotificationsTableMap::COL_SEND_SMS, NotificationsTableMap::COL_SEND_PUSH, NotificationsTableMap::COL_EMAIL_SENT_DATETIME, NotificationsTableMap::COL_EMAIL_SENT_STATUS, NotificationsTableMap::COL_EMAIL_TRANS_ID, NotificationsTableMap::COL_SMS_SENT_DATETIME, NotificationsTableMap::COL_SMS_SENT_STATUS, NotificationsTableMap::COL_SMS_TRANS_ID, NotificationsTableMap::COL_PUSH_SENT_DATETIME, NotificationsTableMap::COL_PUSH_SENT_STATUS, NotificationsTableMap::COL_PUSH_TRANS_ID, NotificationsTableMap::COL_SCHEDULE_AT, NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, NotificationsTableMap::COL_SMS_SENT_ATTEMPTS, NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS, NotificationsTableMap::COL_COMPANY_ID, NotificationsTableMap::COL_CREATED_AT, NotificationsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['notification_id', 'to_employee_id', 'cc_employee_ids', 'template_key', 'data_dump', 'send_email', 'send_sms', 'send_push', 'email_sent_datetime', 'email_sent_status', 'email_trans_id', 'sms_sent_datetime', 'sms_sent_status', 'sms_trans_id', 'push_sent_datetime', 'push_sent_status', 'push_trans_id', 'schedule_at', 'email_sent_attempts', 'sms_sent_attempts', 'push_sent_attempts', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
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
        self::TYPE_PHPNAME       => ['NotificationId' => 0, 'ToEmployeeId' => 1, 'CcEmployeeIds' => 2, 'TemplateKey' => 3, 'DataDump' => 4, 'SendEmail' => 5, 'SendSms' => 6, 'SendPush' => 7, 'EmailSentDatetime' => 8, 'EmailSentStatus' => 9, 'EmailTransId' => 10, 'SmsSentDatetime' => 11, 'SmsSentStatus' => 12, 'SmsTransId' => 13, 'PushSentDatetime' => 14, 'PushSentStatus' => 15, 'PushTransId' => 16, 'ScheduleAt' => 17, 'EmailSentAttempts' => 18, 'SmsSentAttempts' => 19, 'PushSentAttempts' => 20, 'CompanyId' => 21, 'CreatedAt' => 22, 'UpdatedAt' => 23, ],
        self::TYPE_CAMELNAME     => ['notificationId' => 0, 'toEmployeeId' => 1, 'ccEmployeeIds' => 2, 'templateKey' => 3, 'dataDump' => 4, 'sendEmail' => 5, 'sendSms' => 6, 'sendPush' => 7, 'emailSentDatetime' => 8, 'emailSentStatus' => 9, 'emailTransId' => 10, 'smsSentDatetime' => 11, 'smsSentStatus' => 12, 'smsTransId' => 13, 'pushSentDatetime' => 14, 'pushSentStatus' => 15, 'pushTransId' => 16, 'scheduleAt' => 17, 'emailSentAttempts' => 18, 'smsSentAttempts' => 19, 'pushSentAttempts' => 20, 'companyId' => 21, 'createdAt' => 22, 'updatedAt' => 23, ],
        self::TYPE_COLNAME       => [NotificationsTableMap::COL_NOTIFICATION_ID => 0, NotificationsTableMap::COL_TO_EMPLOYEE_ID => 1, NotificationsTableMap::COL_CC_EMPLOYEE_IDS => 2, NotificationsTableMap::COL_TEMPLATE_KEY => 3, NotificationsTableMap::COL_DATA_DUMP => 4, NotificationsTableMap::COL_SEND_EMAIL => 5, NotificationsTableMap::COL_SEND_SMS => 6, NotificationsTableMap::COL_SEND_PUSH => 7, NotificationsTableMap::COL_EMAIL_SENT_DATETIME => 8, NotificationsTableMap::COL_EMAIL_SENT_STATUS => 9, NotificationsTableMap::COL_EMAIL_TRANS_ID => 10, NotificationsTableMap::COL_SMS_SENT_DATETIME => 11, NotificationsTableMap::COL_SMS_SENT_STATUS => 12, NotificationsTableMap::COL_SMS_TRANS_ID => 13, NotificationsTableMap::COL_PUSH_SENT_DATETIME => 14, NotificationsTableMap::COL_PUSH_SENT_STATUS => 15, NotificationsTableMap::COL_PUSH_TRANS_ID => 16, NotificationsTableMap::COL_SCHEDULE_AT => 17, NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS => 18, NotificationsTableMap::COL_SMS_SENT_ATTEMPTS => 19, NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS => 20, NotificationsTableMap::COL_COMPANY_ID => 21, NotificationsTableMap::COL_CREATED_AT => 22, NotificationsTableMap::COL_UPDATED_AT => 23, ],
        self::TYPE_FIELDNAME     => ['notification_id' => 0, 'to_employee_id' => 1, 'cc_employee_ids' => 2, 'template_key' => 3, 'data_dump' => 4, 'send_email' => 5, 'send_sms' => 6, 'send_push' => 7, 'email_sent_datetime' => 8, 'email_sent_status' => 9, 'email_trans_id' => 10, 'sms_sent_datetime' => 11, 'sms_sent_status' => 12, 'sms_trans_id' => 13, 'push_sent_datetime' => 14, 'push_sent_status' => 15, 'push_trans_id' => 16, 'schedule_at' => 17, 'email_sent_attempts' => 18, 'sms_sent_attempts' => 19, 'push_sent_attempts' => 20, 'company_id' => 21, 'created_at' => 22, 'updated_at' => 23, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'NotificationId' => 'NOTIFICATION_ID',
        'Notifications.NotificationId' => 'NOTIFICATION_ID',
        'notificationId' => 'NOTIFICATION_ID',
        'notifications.notificationId' => 'NOTIFICATION_ID',
        'NotificationsTableMap::COL_NOTIFICATION_ID' => 'NOTIFICATION_ID',
        'COL_NOTIFICATION_ID' => 'NOTIFICATION_ID',
        'notification_id' => 'NOTIFICATION_ID',
        'notifications.notification_id' => 'NOTIFICATION_ID',
        'ToEmployeeId' => 'TO_EMPLOYEE_ID',
        'Notifications.ToEmployeeId' => 'TO_EMPLOYEE_ID',
        'toEmployeeId' => 'TO_EMPLOYEE_ID',
        'notifications.toEmployeeId' => 'TO_EMPLOYEE_ID',
        'NotificationsTableMap::COL_TO_EMPLOYEE_ID' => 'TO_EMPLOYEE_ID',
        'COL_TO_EMPLOYEE_ID' => 'TO_EMPLOYEE_ID',
        'to_employee_id' => 'TO_EMPLOYEE_ID',
        'notifications.to_employee_id' => 'TO_EMPLOYEE_ID',
        'CcEmployeeIds' => 'CC_EMPLOYEE_IDS',
        'Notifications.CcEmployeeIds' => 'CC_EMPLOYEE_IDS',
        'ccEmployeeIds' => 'CC_EMPLOYEE_IDS',
        'notifications.ccEmployeeIds' => 'CC_EMPLOYEE_IDS',
        'NotificationsTableMap::COL_CC_EMPLOYEE_IDS' => 'CC_EMPLOYEE_IDS',
        'COL_CC_EMPLOYEE_IDS' => 'CC_EMPLOYEE_IDS',
        'cc_employee_ids' => 'CC_EMPLOYEE_IDS',
        'notifications.cc_employee_ids' => 'CC_EMPLOYEE_IDS',
        'TemplateKey' => 'TEMPLATE_KEY',
        'Notifications.TemplateKey' => 'TEMPLATE_KEY',
        'templateKey' => 'TEMPLATE_KEY',
        'notifications.templateKey' => 'TEMPLATE_KEY',
        'NotificationsTableMap::COL_TEMPLATE_KEY' => 'TEMPLATE_KEY',
        'COL_TEMPLATE_KEY' => 'TEMPLATE_KEY',
        'template_key' => 'TEMPLATE_KEY',
        'notifications.template_key' => 'TEMPLATE_KEY',
        'DataDump' => 'DATA_DUMP',
        'Notifications.DataDump' => 'DATA_DUMP',
        'dataDump' => 'DATA_DUMP',
        'notifications.dataDump' => 'DATA_DUMP',
        'NotificationsTableMap::COL_DATA_DUMP' => 'DATA_DUMP',
        'COL_DATA_DUMP' => 'DATA_DUMP',
        'data_dump' => 'DATA_DUMP',
        'notifications.data_dump' => 'DATA_DUMP',
        'SendEmail' => 'SEND_EMAIL',
        'Notifications.SendEmail' => 'SEND_EMAIL',
        'sendEmail' => 'SEND_EMAIL',
        'notifications.sendEmail' => 'SEND_EMAIL',
        'NotificationsTableMap::COL_SEND_EMAIL' => 'SEND_EMAIL',
        'COL_SEND_EMAIL' => 'SEND_EMAIL',
        'send_email' => 'SEND_EMAIL',
        'notifications.send_email' => 'SEND_EMAIL',
        'SendSms' => 'SEND_SMS',
        'Notifications.SendSms' => 'SEND_SMS',
        'sendSms' => 'SEND_SMS',
        'notifications.sendSms' => 'SEND_SMS',
        'NotificationsTableMap::COL_SEND_SMS' => 'SEND_SMS',
        'COL_SEND_SMS' => 'SEND_SMS',
        'send_sms' => 'SEND_SMS',
        'notifications.send_sms' => 'SEND_SMS',
        'SendPush' => 'SEND_PUSH',
        'Notifications.SendPush' => 'SEND_PUSH',
        'sendPush' => 'SEND_PUSH',
        'notifications.sendPush' => 'SEND_PUSH',
        'NotificationsTableMap::COL_SEND_PUSH' => 'SEND_PUSH',
        'COL_SEND_PUSH' => 'SEND_PUSH',
        'send_push' => 'SEND_PUSH',
        'notifications.send_push' => 'SEND_PUSH',
        'EmailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'Notifications.EmailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'emailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'notifications.emailSentDatetime' => 'EMAIL_SENT_DATETIME',
        'NotificationsTableMap::COL_EMAIL_SENT_DATETIME' => 'EMAIL_SENT_DATETIME',
        'COL_EMAIL_SENT_DATETIME' => 'EMAIL_SENT_DATETIME',
        'email_sent_datetime' => 'EMAIL_SENT_DATETIME',
        'notifications.email_sent_datetime' => 'EMAIL_SENT_DATETIME',
        'EmailSentStatus' => 'EMAIL_SENT_STATUS',
        'Notifications.EmailSentStatus' => 'EMAIL_SENT_STATUS',
        'emailSentStatus' => 'EMAIL_SENT_STATUS',
        'notifications.emailSentStatus' => 'EMAIL_SENT_STATUS',
        'NotificationsTableMap::COL_EMAIL_SENT_STATUS' => 'EMAIL_SENT_STATUS',
        'COL_EMAIL_SENT_STATUS' => 'EMAIL_SENT_STATUS',
        'email_sent_status' => 'EMAIL_SENT_STATUS',
        'notifications.email_sent_status' => 'EMAIL_SENT_STATUS',
        'EmailTransId' => 'EMAIL_TRANS_ID',
        'Notifications.EmailTransId' => 'EMAIL_TRANS_ID',
        'emailTransId' => 'EMAIL_TRANS_ID',
        'notifications.emailTransId' => 'EMAIL_TRANS_ID',
        'NotificationsTableMap::COL_EMAIL_TRANS_ID' => 'EMAIL_TRANS_ID',
        'COL_EMAIL_TRANS_ID' => 'EMAIL_TRANS_ID',
        'email_trans_id' => 'EMAIL_TRANS_ID',
        'notifications.email_trans_id' => 'EMAIL_TRANS_ID',
        'SmsSentDatetime' => 'SMS_SENT_DATETIME',
        'Notifications.SmsSentDatetime' => 'SMS_SENT_DATETIME',
        'smsSentDatetime' => 'SMS_SENT_DATETIME',
        'notifications.smsSentDatetime' => 'SMS_SENT_DATETIME',
        'NotificationsTableMap::COL_SMS_SENT_DATETIME' => 'SMS_SENT_DATETIME',
        'COL_SMS_SENT_DATETIME' => 'SMS_SENT_DATETIME',
        'sms_sent_datetime' => 'SMS_SENT_DATETIME',
        'notifications.sms_sent_datetime' => 'SMS_SENT_DATETIME',
        'SmsSentStatus' => 'SMS_SENT_STATUS',
        'Notifications.SmsSentStatus' => 'SMS_SENT_STATUS',
        'smsSentStatus' => 'SMS_SENT_STATUS',
        'notifications.smsSentStatus' => 'SMS_SENT_STATUS',
        'NotificationsTableMap::COL_SMS_SENT_STATUS' => 'SMS_SENT_STATUS',
        'COL_SMS_SENT_STATUS' => 'SMS_SENT_STATUS',
        'sms_sent_status' => 'SMS_SENT_STATUS',
        'notifications.sms_sent_status' => 'SMS_SENT_STATUS',
        'SmsTransId' => 'SMS_TRANS_ID',
        'Notifications.SmsTransId' => 'SMS_TRANS_ID',
        'smsTransId' => 'SMS_TRANS_ID',
        'notifications.smsTransId' => 'SMS_TRANS_ID',
        'NotificationsTableMap::COL_SMS_TRANS_ID' => 'SMS_TRANS_ID',
        'COL_SMS_TRANS_ID' => 'SMS_TRANS_ID',
        'sms_trans_id' => 'SMS_TRANS_ID',
        'notifications.sms_trans_id' => 'SMS_TRANS_ID',
        'PushSentDatetime' => 'PUSH_SENT_DATETIME',
        'Notifications.PushSentDatetime' => 'PUSH_SENT_DATETIME',
        'pushSentDatetime' => 'PUSH_SENT_DATETIME',
        'notifications.pushSentDatetime' => 'PUSH_SENT_DATETIME',
        'NotificationsTableMap::COL_PUSH_SENT_DATETIME' => 'PUSH_SENT_DATETIME',
        'COL_PUSH_SENT_DATETIME' => 'PUSH_SENT_DATETIME',
        'push_sent_datetime' => 'PUSH_SENT_DATETIME',
        'notifications.push_sent_datetime' => 'PUSH_SENT_DATETIME',
        'PushSentStatus' => 'PUSH_SENT_STATUS',
        'Notifications.PushSentStatus' => 'PUSH_SENT_STATUS',
        'pushSentStatus' => 'PUSH_SENT_STATUS',
        'notifications.pushSentStatus' => 'PUSH_SENT_STATUS',
        'NotificationsTableMap::COL_PUSH_SENT_STATUS' => 'PUSH_SENT_STATUS',
        'COL_PUSH_SENT_STATUS' => 'PUSH_SENT_STATUS',
        'push_sent_status' => 'PUSH_SENT_STATUS',
        'notifications.push_sent_status' => 'PUSH_SENT_STATUS',
        'PushTransId' => 'PUSH_TRANS_ID',
        'Notifications.PushTransId' => 'PUSH_TRANS_ID',
        'pushTransId' => 'PUSH_TRANS_ID',
        'notifications.pushTransId' => 'PUSH_TRANS_ID',
        'NotificationsTableMap::COL_PUSH_TRANS_ID' => 'PUSH_TRANS_ID',
        'COL_PUSH_TRANS_ID' => 'PUSH_TRANS_ID',
        'push_trans_id' => 'PUSH_TRANS_ID',
        'notifications.push_trans_id' => 'PUSH_TRANS_ID',
        'ScheduleAt' => 'SCHEDULE_AT',
        'Notifications.ScheduleAt' => 'SCHEDULE_AT',
        'scheduleAt' => 'SCHEDULE_AT',
        'notifications.scheduleAt' => 'SCHEDULE_AT',
        'NotificationsTableMap::COL_SCHEDULE_AT' => 'SCHEDULE_AT',
        'COL_SCHEDULE_AT' => 'SCHEDULE_AT',
        'schedule_at' => 'SCHEDULE_AT',
        'notifications.schedule_at' => 'SCHEDULE_AT',
        'EmailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'Notifications.EmailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'emailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'notifications.emailSentAttempts' => 'EMAIL_SENT_ATTEMPTS',
        'NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS' => 'EMAIL_SENT_ATTEMPTS',
        'COL_EMAIL_SENT_ATTEMPTS' => 'EMAIL_SENT_ATTEMPTS',
        'email_sent_attempts' => 'EMAIL_SENT_ATTEMPTS',
        'notifications.email_sent_attempts' => 'EMAIL_SENT_ATTEMPTS',
        'SmsSentAttempts' => 'SMS_SENT_ATTEMPTS',
        'Notifications.SmsSentAttempts' => 'SMS_SENT_ATTEMPTS',
        'smsSentAttempts' => 'SMS_SENT_ATTEMPTS',
        'notifications.smsSentAttempts' => 'SMS_SENT_ATTEMPTS',
        'NotificationsTableMap::COL_SMS_SENT_ATTEMPTS' => 'SMS_SENT_ATTEMPTS',
        'COL_SMS_SENT_ATTEMPTS' => 'SMS_SENT_ATTEMPTS',
        'sms_sent_attempts' => 'SMS_SENT_ATTEMPTS',
        'notifications.sms_sent_attempts' => 'SMS_SENT_ATTEMPTS',
        'PushSentAttempts' => 'PUSH_SENT_ATTEMPTS',
        'Notifications.PushSentAttempts' => 'PUSH_SENT_ATTEMPTS',
        'pushSentAttempts' => 'PUSH_SENT_ATTEMPTS',
        'notifications.pushSentAttempts' => 'PUSH_SENT_ATTEMPTS',
        'NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS' => 'PUSH_SENT_ATTEMPTS',
        'COL_PUSH_SENT_ATTEMPTS' => 'PUSH_SENT_ATTEMPTS',
        'push_sent_attempts' => 'PUSH_SENT_ATTEMPTS',
        'notifications.push_sent_attempts' => 'PUSH_SENT_ATTEMPTS',
        'CompanyId' => 'COMPANY_ID',
        'Notifications.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'notifications.companyId' => 'COMPANY_ID',
        'NotificationsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'notifications.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'Notifications.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'notifications.createdAt' => 'CREATED_AT',
        'NotificationsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'notifications.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Notifications.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'notifications.updatedAt' => 'UPDATED_AT',
        'NotificationsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'notifications.updated_at' => 'UPDATED_AT',
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
        $this->setName('notifications');
        $this->setPhpName('Notifications');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Notifications');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('notifications_notification_id_seq');
        // columns
        $this->addPrimaryKey('notification_id', 'NotificationId', 'BIGINT', true, null, null);
        $this->addColumn('to_employee_id', 'ToEmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('cc_employee_ids', 'CcEmployeeIds', 'LONGVARCHAR', false, null, null);
        $this->addColumn('template_key', 'TemplateKey', 'VARCHAR', false, 250, null);
        $this->addColumn('data_dump', 'DataDump', 'LONGVARCHAR', false, null, null);
        $this->addColumn('send_email', 'SendEmail', 'BOOLEAN', false, 1, false);
        $this->addColumn('send_sms', 'SendSms', 'BOOLEAN', false, 1, false);
        $this->addColumn('send_push', 'SendPush', 'BOOLEAN', false, 1, false);
        $this->addColumn('email_sent_datetime', 'EmailSentDatetime', 'TIMESTAMP', false, null, null);
        $this->addColumn('email_sent_status', 'EmailSentStatus', 'BOOLEAN', false, 1, false);
        $this->addColumn('email_trans_id', 'EmailTransId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sms_sent_datetime', 'SmsSentDatetime', 'TIMESTAMP', false, null, null);
        $this->addColumn('sms_sent_status', 'SmsSentStatus', 'BOOLEAN', false, 1, false);
        $this->addColumn('sms_trans_id', 'SmsTransId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('push_sent_datetime', 'PushSentDatetime', 'TIMESTAMP', false, null, null);
        $this->addColumn('push_sent_status', 'PushSentStatus', 'BOOLEAN', false, 1, false);
        $this->addColumn('push_trans_id', 'PushTransId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('schedule_at', 'ScheduleAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('email_sent_attempts', 'EmailSentAttempts', 'INTEGER', false, null, null);
        $this->addColumn('sms_sent_attempts', 'SmsSentAttempts', 'INTEGER', false, null, null);
        $this->addColumn('push_sent_attempts', 'PushSentAttempts', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NotificationsTableMap::CLASS_DEFAULT : NotificationsTableMap::OM_CLASS;
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
     * @return array (Notifications object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NotificationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NotificationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NotificationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NotificationsTableMap::OM_CLASS;
            /** @var Notifications $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NotificationsTableMap::addInstanceToPool($obj, $key);
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
            $key = NotificationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NotificationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Notifications $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NotificationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NotificationsTableMap::COL_NOTIFICATION_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_TO_EMPLOYEE_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_CC_EMPLOYEE_IDS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_TEMPLATE_KEY);
            $criteria->addSelectColumn(NotificationsTableMap::COL_DATA_DUMP);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SEND_EMAIL);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SEND_SMS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SEND_PUSH);
            $criteria->addSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_DATETIME);
            $criteria->addSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_STATUS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_EMAIL_TRANS_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SMS_SENT_DATETIME);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SMS_SENT_STATUS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SMS_TRANS_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_PUSH_SENT_DATETIME);
            $criteria->addSelectColumn(NotificationsTableMap::COL_PUSH_SENT_STATUS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_PUSH_TRANS_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SCHEDULE_AT);
            $criteria->addSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS);
            $criteria->addSelectColumn(NotificationsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(NotificationsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(NotificationsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.notification_id');
            $criteria->addSelectColumn($alias . '.to_employee_id');
            $criteria->addSelectColumn($alias . '.cc_employee_ids');
            $criteria->addSelectColumn($alias . '.template_key');
            $criteria->addSelectColumn($alias . '.data_dump');
            $criteria->addSelectColumn($alias . '.send_email');
            $criteria->addSelectColumn($alias . '.send_sms');
            $criteria->addSelectColumn($alias . '.send_push');
            $criteria->addSelectColumn($alias . '.email_sent_datetime');
            $criteria->addSelectColumn($alias . '.email_sent_status');
            $criteria->addSelectColumn($alias . '.email_trans_id');
            $criteria->addSelectColumn($alias . '.sms_sent_datetime');
            $criteria->addSelectColumn($alias . '.sms_sent_status');
            $criteria->addSelectColumn($alias . '.sms_trans_id');
            $criteria->addSelectColumn($alias . '.push_sent_datetime');
            $criteria->addSelectColumn($alias . '.push_sent_status');
            $criteria->addSelectColumn($alias . '.push_trans_id');
            $criteria->addSelectColumn($alias . '.schedule_at');
            $criteria->addSelectColumn($alias . '.email_sent_attempts');
            $criteria->addSelectColumn($alias . '.sms_sent_attempts');
            $criteria->addSelectColumn($alias . '.push_sent_attempts');
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
            $criteria->removeSelectColumn(NotificationsTableMap::COL_NOTIFICATION_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_TO_EMPLOYEE_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_CC_EMPLOYEE_IDS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_TEMPLATE_KEY);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_DATA_DUMP);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SEND_EMAIL);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SEND_SMS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SEND_PUSH);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_DATETIME);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_STATUS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_EMAIL_TRANS_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SMS_SENT_DATETIME);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SMS_SENT_STATUS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SMS_TRANS_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_PUSH_SENT_DATETIME);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_PUSH_SENT_STATUS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_PUSH_TRANS_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SCHEDULE_AT);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(NotificationsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.notification_id');
            $criteria->removeSelectColumn($alias . '.to_employee_id');
            $criteria->removeSelectColumn($alias . '.cc_employee_ids');
            $criteria->removeSelectColumn($alias . '.template_key');
            $criteria->removeSelectColumn($alias . '.data_dump');
            $criteria->removeSelectColumn($alias . '.send_email');
            $criteria->removeSelectColumn($alias . '.send_sms');
            $criteria->removeSelectColumn($alias . '.send_push');
            $criteria->removeSelectColumn($alias . '.email_sent_datetime');
            $criteria->removeSelectColumn($alias . '.email_sent_status');
            $criteria->removeSelectColumn($alias . '.email_trans_id');
            $criteria->removeSelectColumn($alias . '.sms_sent_datetime');
            $criteria->removeSelectColumn($alias . '.sms_sent_status');
            $criteria->removeSelectColumn($alias . '.sms_trans_id');
            $criteria->removeSelectColumn($alias . '.push_sent_datetime');
            $criteria->removeSelectColumn($alias . '.push_sent_status');
            $criteria->removeSelectColumn($alias . '.push_trans_id');
            $criteria->removeSelectColumn($alias . '.schedule_at');
            $criteria->removeSelectColumn($alias . '.email_sent_attempts');
            $criteria->removeSelectColumn($alias . '.sms_sent_attempts');
            $criteria->removeSelectColumn($alias . '.push_sent_attempts');
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
        return Propel::getServiceContainer()->getDatabaseMap(NotificationsTableMap::DATABASE_NAME)->getTable(NotificationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Notifications or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Notifications object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Notifications) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NotificationsTableMap::DATABASE_NAME);
            $criteria->add(NotificationsTableMap::COL_NOTIFICATION_ID, (array) $values, Criteria::IN);
        }

        $query = NotificationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NotificationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NotificationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NotificationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Notifications or Criteria object.
     *
     * @param mixed $criteria Criteria or Notifications object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Notifications object
        }

        if ($criteria->containsKey(NotificationsTableMap::COL_NOTIFICATION_ID) && $criteria->keyContainsValue(NotificationsTableMap::COL_NOTIFICATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NotificationsTableMap::COL_NOTIFICATION_ID.')');
        }


        // Set the correct dbName
        $query = NotificationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

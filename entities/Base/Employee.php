<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\AnnouncementEmployeeMap as ChildAnnouncementEmployeeMap;
use entities\AnnouncementEmployeeMapQuery as ChildAnnouncementEmployeeMapQuery;
use entities\Attendance as ChildAttendance;
use entities\AttendanceQuery as ChildAttendanceQuery;
use entities\AuditEmpUnits as ChildAuditEmpUnits;
use entities\AuditEmpUnitsQuery as ChildAuditEmpUnitsQuery;
use entities\Branch as ChildBranch;
use entities\BranchQuery as ChildBranchQuery;
use entities\BrandRcpa as ChildBrandRcpa;
use entities\BrandRcpaQuery as ChildBrandRcpaQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\CompetitionMapping as ChildCompetitionMapping;
use entities\CompetitionMappingQuery as ChildCompetitionMappingQuery;
use entities\DailycallsSgpiout as ChildDailycallsSgpiout;
use entities\DailycallsSgpioutQuery as ChildDailycallsSgpioutQuery;
use entities\Designations as ChildDesignations;
use entities\DesignationsQuery as ChildDesignationsQuery;
use entities\EdSession as ChildEdSession;
use entities\EdSessionQuery as ChildEdSessionQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeIncentive as ChildEmployeeIncentive;
use entities\EmployeeIncentiveQuery as ChildEmployeeIncentiveQuery;
use entities\EmployeePositionHistory as ChildEmployeePositionHistory;
use entities\EmployeePositionHistoryQuery as ChildEmployeePositionHistoryQuery;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Events as ChildEvents;
use entities\EventsQuery as ChildEventsQuery;
use entities\ExpensePayments as ChildExpensePayments;
use entities\ExpensePaymentsQuery as ChildExpensePaymentsQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\GradeMaster as ChildGradeMaster;
use entities\GradeMasterQuery as ChildGradeMasterQuery;
use entities\HrUserAccount as ChildHrUserAccount;
use entities\HrUserAccountQuery as ChildHrUserAccountQuery;
use entities\HrUserDates as ChildHrUserDates;
use entities\HrUserDatesQuery as ChildHrUserDatesQuery;
use entities\HrUserDocuments as ChildHrUserDocuments;
use entities\HrUserDocumentsQuery as ChildHrUserDocumentsQuery;
use entities\HrUserExperiences as ChildHrUserExperiences;
use entities\HrUserExperiencesQuery as ChildHrUserExperiencesQuery;
use entities\HrUserQualification as ChildHrUserQualification;
use entities\HrUserQualificationQuery as ChildHrUserQualificationQuery;
use entities\HrUserReferences as ChildHrUserReferences;
use entities\HrUserReferencesQuery as ChildHrUserReferencesQuery;
use entities\LeaveRequest as ChildLeaveRequest;
use entities\LeaveRequestQuery as ChildLeaveRequestQuery;
use entities\Leaves as ChildLeaves;
use entities\LeavesQuery as ChildLeavesQuery;
use entities\Mtp as ChildMtp;
use entities\MtpQuery as ChildMtpQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestLog as ChildOnBoardRequestLog;
use entities\OnBoardRequestLogQuery as ChildOnBoardRequestLogQuery;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\Orders as ChildOrders;
use entities\OrdersQuery as ChildOrdersQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OtpRequests as ChildOtpRequests;
use entities\OtpRequestsQuery as ChildOtpRequestsQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\Reminders as ChildReminders;
use entities\RemindersQuery as ChildRemindersQuery;
use entities\SalaryAttendanceBackdateTrackLog as ChildSalaryAttendanceBackdateTrackLog;
use entities\SalaryAttendanceBackdateTrackLogQuery as ChildSalaryAttendanceBackdateTrackLogQuery;
use entities\SurveySubmited as ChildSurveySubmited;
use entities\SurveySubmitedQuery as ChildSurveySubmitedQuery;
use entities\TicketReplies as ChildTicketReplies;
use entities\TicketRepliesQuery as ChildTicketRepliesQuery;
use entities\TicketType as ChildTicketType;
use entities\TicketTypeQuery as ChildTicketTypeQuery;
use entities\Tickets as ChildTickets;
use entities\TicketsQuery as ChildTicketsQuery;
use entities\Transactions as ChildTransactions;
use entities\TransactionsQuery as ChildTransactionsQuery;
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\WfLog as ChildWfLog;
use entities\WfLogQuery as ChildWfLogQuery;
use entities\WfRequests as ChildWfRequests;
use entities\WfRequestsQuery as ChildWfRequestsQuery;
use entities\Map\AnnouncementEmployeeMapTableMap;
use entities\Map\AttendanceTableMap;
use entities\Map\AuditEmpUnitsTableMap;
use entities\Map\BrandRcpaTableMap;
use entities\Map\CompetitionMappingTableMap;
use entities\Map\DailycallsSgpioutTableMap;
use entities\Map\EdSessionTableMap;
use entities\Map\EmployeeIncentiveTableMap;
use entities\Map\EmployeePositionHistoryTableMap;
use entities\Map\EmployeeTableMap;
use entities\Map\EventsTableMap;
use entities\Map\ExpensePaymentsTableMap;
use entities\Map\ExpensesTableMap;
use entities\Map\HrUserAccountTableMap;
use entities\Map\HrUserDatesTableMap;
use entities\Map\HrUserDocumentsTableMap;
use entities\Map\HrUserExperiencesTableMap;
use entities\Map\HrUserQualificationTableMap;
use entities\Map\HrUserReferencesTableMap;
use entities\Map\LeaveRequestTableMap;
use entities\Map\LeavesTableMap;
use entities\Map\MtpTableMap;
use entities\Map\OnBoardRequestLogTableMap;
use entities\Map\OnBoardRequestTableMap;
use entities\Map\OrdersTableMap;
use entities\Map\OtpRequestsTableMap;
use entities\Map\OutletsTableMap;
use entities\Map\RemindersTableMap;
use entities\Map\SalaryAttendanceBackdateTrackLogTableMap;
use entities\Map\SurveySubmitedTableMap;
use entities\Map\TicketRepliesTableMap;
use entities\Map\TicketTypeTableMap;
use entities\Map\TicketsTableMap;
use entities\Map\TransactionsTableMap;
use entities\Map\UsersTableMap;
use entities\Map\WfLogTableMap;
use entities\Map\WfRequestsTableMap;

/**
 * Base class that represents a row from the 'employee' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Employee implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\EmployeeTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the employee_id field.
     *
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the reporting_to field.
     *
     * @var        int|null
     */
    protected $reporting_to;

    /**
     * The value for the designation_id field.
     *
     * @var        int|null
     */
    protected $designation_id;

    /**
     * The value for the branch_id field.
     *
     * @var        int
     */
    protected $branch_id;

    /**
     * The value for the grade_id field.
     *
     * @var        int
     */
    protected $grade_id;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int
     */
    protected $org_unit_id;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the first_name field.
     *
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     *
     * @var        string|null
     */
    protected $last_name;

    /**
     * The value for the status field.
     *
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the ip_address field.
     *
     * @var        string|null
     */
    protected $ip_address;

    /**
     * The value for the profile_picture field.
     *
     * @var        string|null
     */
    protected $profile_picture;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the last_login field.
     *
     * @var        int|null
     */
    protected $last_login;

    /**
     * The value for the phone field.
     *
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the address field.
     *
     * @var        string|null
     */
    protected $address;

    /**
     * The value for the costnumber field.
     *
     * @var        string|null
     */
    protected $costnumber;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the base_mtarget field.
     *
     * @var        string|null
     */
    protected $base_mtarget;

    /**
     * The value for the integration_id field.
     *
     * @var        string|null
     */
    protected $integration_id;

    /**
     * The value for the itownid field.
     *
     * @var        int|null
     */
    protected $itownid;

    /**
     * The value for the islocked field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $islocked;

    /**
     * The value for the lockedreason field.
     *
     * @var        string|null
     */
    protected $lockedreason;

    /**
     * The value for the lockeddate field.
     *
     * @var        DateTime|null
     */
    protected $lockeddate;

    /**
     * The value for the iseodcheckenabled field.
     *
     * Note: this column has a database default value of: 1
     * @var        int|null
     */
    protected $iseodcheckenabled;

    /**
     * The value for the employee_media field.
     *
     * @var        int|null
     */
    protected $employee_media;

    /**
     * The value for the resi_address field.
     *
     * @var        string|null
     */
    protected $resi_address;

    /**
     * The value for the can_full_sync field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean|null
     */
    protected $can_full_sync;

    /**
     * The value for the remark field.
     *
     * @var        string|null
     */
    protected $remark;

    /**
     * The value for the employee_spoken_language field.
     *
     * @var        string|null
     */
    protected $employee_spoken_language;

    /**
     * The value for the last_updated_by_user_id field.
     *
     * @var        int|null
     */
    protected $last_updated_by_user_id;

    /**
     * @var        ChildBranch
     */
    protected $aBranch;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildDesignations
     */
    protected $aDesignations;

    /**
     * @var        ChildGradeMaster
     */
    protected $aGradeMaster;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByPositionId;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByReportingTo;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ObjectCollection|ChildAnnouncementEmployeeMap[] Collection to store aggregation of ChildAnnouncementEmployeeMap objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap> Collection to store aggregation of ChildAnnouncementEmployeeMap objects.
     */
    protected $collAnnouncementEmployeeMaps;
    protected $collAnnouncementEmployeeMapsPartial;

    /**
     * @var        ObjectCollection|ChildAttendance[] Collection to store aggregation of ChildAttendance objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance> Collection to store aggregation of ChildAttendance objects.
     */
    protected $collAttendances;
    protected $collAttendancesPartial;

    /**
     * @var        ObjectCollection|ChildAuditEmpUnits[] Collection to store aggregation of ChildAuditEmpUnits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditEmpUnits> Collection to store aggregation of ChildAuditEmpUnits objects.
     */
    protected $collAuditEmpUnitss;
    protected $collAuditEmpUnitssPartial;

    /**
     * @var        ObjectCollection|ChildBrandRcpa[] Collection to store aggregation of ChildBrandRcpa objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa> Collection to store aggregation of ChildBrandRcpa objects.
     */
    protected $collBrandRcpas;
    protected $collBrandRcpasPartial;

    /**
     * @var        ObjectCollection|ChildCompetitionMapping[] Collection to store aggregation of ChildCompetitionMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCompetitionMapping> Collection to store aggregation of ChildCompetitionMapping objects.
     */
    protected $collCompetitionMappings;
    protected $collCompetitionMappingsPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsSgpiout[] Collection to store aggregation of ChildDailycallsSgpiout objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout> Collection to store aggregation of ChildDailycallsSgpiout objects.
     */
    protected $collDailycallsSgpiouts;
    protected $collDailycallsSgpioutsPartial;

    /**
     * @var        ObjectCollection|ChildEdSession[] Collection to store aggregation of ChildEdSession objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdSession> Collection to store aggregation of ChildEdSession objects.
     */
    protected $collEdSessions;
    protected $collEdSessionsPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeIncentive[] Collection to store aggregation of ChildEmployeeIncentive objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeIncentive> Collection to store aggregation of ChildEmployeeIncentive objects.
     */
    protected $collEmployeeIncentives;
    protected $collEmployeeIncentivesPartial;

    /**
     * @var        ObjectCollection|ChildEmployeePositionHistory[] Collection to store aggregation of ChildEmployeePositionHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeePositionHistory> Collection to store aggregation of ChildEmployeePositionHistory objects.
     */
    protected $collEmployeePositionHistories;
    protected $collEmployeePositionHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildEvents[] Collection to store aggregation of ChildEvents objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEvents> Collection to store aggregation of ChildEvents objects.
     */
    protected $collEventssRelatedByEmployeeId;
    protected $collEventssRelatedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildEvents[] Collection to store aggregation of ChildEvents objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEvents> Collection to store aggregation of ChildEvents objects.
     */
    protected $collEventssRelatedByApproverEmpId;
    protected $collEventssRelatedByApproverEmpIdPartial;

    /**
     * @var        ObjectCollection|ChildExpensePayments[] Collection to store aggregation of ChildExpensePayments objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpensePayments> Collection to store aggregation of ChildExpensePayments objects.
     */
    protected $collExpensePaymentss;
    protected $collExpensePaymentssPartial;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses> Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * @var        ObjectCollection|ChildHrUserAccount[] Collection to store aggregation of ChildHrUserAccount objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserAccount> Collection to store aggregation of ChildHrUserAccount objects.
     */
    protected $collHrUserAccounts;
    protected $collHrUserAccountsPartial;

    /**
     * @var        ObjectCollection|ChildHrUserDates[] Collection to store aggregation of ChildHrUserDates objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserDates> Collection to store aggregation of ChildHrUserDates objects.
     */
    protected $collHrUserDatess;
    protected $collHrUserDatessPartial;

    /**
     * @var        ObjectCollection|ChildHrUserDocuments[] Collection to store aggregation of ChildHrUserDocuments objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserDocuments> Collection to store aggregation of ChildHrUserDocuments objects.
     */
    protected $collHrUserDocumentss;
    protected $collHrUserDocumentssPartial;

    /**
     * @var        ObjectCollection|ChildHrUserExperiences[] Collection to store aggregation of ChildHrUserExperiences objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserExperiences> Collection to store aggregation of ChildHrUserExperiences objects.
     */
    protected $collHrUserExperiencess;
    protected $collHrUserExperiencessPartial;

    /**
     * @var        ObjectCollection|ChildHrUserQualification[] Collection to store aggregation of ChildHrUserQualification objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserQualification> Collection to store aggregation of ChildHrUserQualification objects.
     */
    protected $collHrUserQualifications;
    protected $collHrUserQualificationsPartial;

    /**
     * @var        ObjectCollection|ChildHrUserReferences[] Collection to store aggregation of ChildHrUserReferences objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserReferences> Collection to store aggregation of ChildHrUserReferences objects.
     */
    protected $collHrUserReferencess;
    protected $collHrUserReferencessPartial;

    /**
     * @var        ObjectCollection|ChildLeaveRequest[] Collection to store aggregation of ChildLeaveRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLeaveRequest> Collection to store aggregation of ChildLeaveRequest objects.
     */
    protected $collLeaveRequests;
    protected $collLeaveRequestsPartial;

    /**
     * @var        ObjectCollection|ChildLeaves[] Collection to store aggregation of ChildLeaves objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildLeaves> Collection to store aggregation of ChildLeaves objects.
     */
    protected $collLeavess;
    protected $collLeavessPartial;

    /**
     * @var        ObjectCollection|ChildMtp[] Collection to store aggregation of ChildMtp objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMtp> Collection to store aggregation of ChildMtp objects.
     */
    protected $collMtps;
    protected $collMtpsPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByApprovedByEmployeeId;
    protected $collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByCreatedByEmployeeId;
    protected $collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
    protected $collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequest[] Collection to store aggregation of ChildOnBoardRequest objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest> Collection to store aggregation of ChildOnBoardRequest objects.
     */
    protected $collOnBoardRequestsRelatedByUpdatedByEmployeeId;
    protected $collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestLog[] Collection to store aggregation of ChildOnBoardRequestLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog> Collection to store aggregation of ChildOnBoardRequestLog objects.
     */
    protected $collOnBoardRequestLogs;
    protected $collOnBoardRequestLogsPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildOtpRequests[] Collection to store aggregation of ChildOtpRequests objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOtpRequests> Collection to store aggregation of ChildOtpRequests objects.
     */
    protected $collOtpRequestss;
    protected $collOtpRequestssPartial;

    /**
     * @var        ObjectCollection|ChildOutlets[] Collection to store aggregation of ChildOutlets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets> Collection to store aggregation of ChildOutlets objects.
     */
    protected $collOutletss;
    protected $collOutletssPartial;

    /**
     * @var        ObjectCollection|ChildReminders[] Collection to store aggregation of ChildReminders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReminders> Collection to store aggregation of ChildReminders objects.
     */
    protected $collReminderss;
    protected $collReminderssPartial;

    /**
     * @var        ObjectCollection|ChildSalaryAttendanceBackdateTrackLog[] Collection to store aggregation of ChildSalaryAttendanceBackdateTrackLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> Collection to store aggregation of ChildSalaryAttendanceBackdateTrackLog objects.
     */
    protected $collSalaryAttendanceBackdateTrackLogs;
    protected $collSalaryAttendanceBackdateTrackLogsPartial;

    /**
     * @var        ObjectCollection|ChildSurveySubmited[] Collection to store aggregation of ChildSurveySubmited objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited> Collection to store aggregation of ChildSurveySubmited objects.
     */
    protected $collSurveySubmiteds;
    protected $collSurveySubmitedsPartial;

    /**
     * @var        ObjectCollection|ChildTicketReplies[] Collection to store aggregation of ChildTicketReplies objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketReplies> Collection to store aggregation of ChildTicketReplies objects.
     */
    protected $collTicketRepliess;
    protected $collTicketRepliessPartial;

    /**
     * @var        ObjectCollection|ChildTicketType[] Collection to store aggregation of ChildTicketType objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketType> Collection to store aggregation of ChildTicketType objects.
     */
    protected $collTicketTypes;
    protected $collTicketTypesPartial;

    /**
     * @var        ObjectCollection|ChildTickets[] Collection to store aggregation of ChildTickets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets> Collection to store aggregation of ChildTickets objects.
     */
    protected $collTicketssRelatedByEmployeeId;
    protected $collTicketssRelatedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildTickets[] Collection to store aggregation of ChildTickets objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets> Collection to store aggregation of ChildTickets objects.
     */
    protected $collTicketssRelatedByAllocatedTo;
    protected $collTicketssRelatedByAllocatedToPartial;

    /**
     * @var        ObjectCollection|ChildTransactions[] Collection to store aggregation of ChildTransactions objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTransactions> Collection to store aggregation of ChildTransactions objects.
     */
    protected $collTransactionssRelatedByEmployeeId;
    protected $collTransactionssRelatedByEmployeeIdPartial;

    /**
     * @var        ObjectCollection|ChildTransactions[] Collection to store aggregation of ChildTransactions objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTransactions> Collection to store aggregation of ChildTransactions objects.
     */
    protected $collTransactionssRelatedByCreatedBy;
    protected $collTransactionssRelatedByCreatedByPartial;

    /**
     * @var        ObjectCollection|ChildUsers[] Collection to store aggregation of ChildUsers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers> Collection to store aggregation of ChildUsers objects.
     */
    protected $collUserss;
    protected $collUserssPartial;

    /**
     * @var        ObjectCollection|ChildWfLog[] Collection to store aggregation of ChildWfLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfLog> Collection to store aggregation of ChildWfLog objects.
     */
    protected $collWfLogs;
    protected $collWfLogsPartial;

    /**
     * @var        ObjectCollection|ChildWfRequests[] Collection to store aggregation of ChildWfRequests objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests> Collection to store aggregation of ChildWfRequests objects.
     */
    protected $collWfRequestss;
    protected $collWfRequestssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAnnouncementEmployeeMap[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap>
     */
    protected $announcementEmployeeMapsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAttendance[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAttendance>
     */
    protected $attendancesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAuditEmpUnits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditEmpUnits>
     */
    protected $auditEmpUnitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandRcpa[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandRcpa>
     */
    protected $brandRcpasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCompetitionMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCompetitionMapping>
     */
    protected $competitionMappingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsSgpiout[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsSgpiout>
     */
    protected $dailycallsSgpioutsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdSession[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdSession>
     */
    protected $edSessionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeIncentive[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeIncentive>
     */
    protected $employeeIncentivesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeePositionHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeePositionHistory>
     */
    protected $employeePositionHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEvents[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEvents>
     */
    protected $eventssRelatedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEvents[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEvents>
     */
    protected $eventssRelatedByApproverEmpIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpensePayments[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpensePayments>
     */
    protected $expensePaymentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenses>
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserAccount[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserAccount>
     */
    protected $hrUserAccountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserDates[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserDates>
     */
    protected $hrUserDatessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserDocuments[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserDocuments>
     */
    protected $hrUserDocumentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserExperiences[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserExperiences>
     */
    protected $hrUserExperiencessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserQualification[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserQualification>
     */
    protected $hrUserQualificationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHrUserReferences[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHrUserReferences>
     */
    protected $hrUserReferencessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLeaveRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLeaveRequest>
     */
    protected $leaveRequestsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLeaves[]
     * @phpstan-var ObjectCollection&\Traversable<ChildLeaves>
     */
    protected $leavessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMtp[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMtp>
     */
    protected $mtpsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequest[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequest>
     */
    protected $onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog>
     */
    protected $onBoardRequestLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOtpRequests[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOtpRequests>
     */
    protected $otpRequestssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutlets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutlets>
     */
    protected $outletssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReminders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReminders>
     */
    protected $reminderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSalaryAttendanceBackdateTrackLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSalaryAttendanceBackdateTrackLog>
     */
    protected $salaryAttendanceBackdateTrackLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveySubmited[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited>
     */
    protected $surveySubmitedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTicketReplies[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketReplies>
     */
    protected $ticketRepliessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTicketType[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTicketType>
     */
    protected $ticketTypesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTickets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets>
     */
    protected $ticketssRelatedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTickets[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTickets>
     */
    protected $ticketssRelatedByAllocatedToScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransactions[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTransactions>
     */
    protected $transactionssRelatedByEmployeeIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTransactions[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTransactions>
     */
    protected $transactionssRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers>
     */
    protected $userssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfLog>
     */
    protected $wfLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWfRequests[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWfRequests>
     */
    protected $wfRequestssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->islocked = false;
        $this->iseodcheckenabled = 1;
        $this->can_full_sync = true;
    }

    /**
     * Initializes internal state of entities\Base\Employee object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Employee</code> instance.  If
     * <code>obj</code> is an instance of <code>Employee</code>, delegates to
     * <code>equals(Employee)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [reporting_to] column value.
     *
     * @return int|null
     */
    public function getReportingTo()
    {
        return $this->reporting_to;
    }

    /**
     * Get the [designation_id] column value.
     *
     * @return int|null
     */
    public function getDesignationId()
    {
        return $this->designation_id;
    }

    /**
     * Get the [branch_id] column value.
     *
     * @return int
     */
    public function getBranchId()
    {
        return $this->branch_id;
    }

    /**
     * Get the [grade_id] column value.
     *
     * @return int
     */
    public function getGradeId()
    {
        return $this->grade_id;
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return int
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Get the [employee_code] column value.
     *
     * @return string|null
     */
    public function getEmployeeCode()
    {
        return $this->employee_code;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [status] column value.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [ip_address] column value.
     *
     * @return string|null
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Get the [profile_picture] column value.
     *
     * @return string|null
     */
    public function getProfilePicture()
    {
        return $this->profile_picture;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [last_login] column value.
     *
     * @return int|null
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [address] column value.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [costnumber] column value.
     *
     * @return string|null
     */
    public function getCostnumber()
    {
        return $this->costnumber;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [base_mtarget] column value.
     *
     * @return string|null
     */
    public function getBaseMtarget()
    {
        return $this->base_mtarget;
    }

    /**
     * Get the [integration_id] column value.
     *
     * @return string|null
     */
    public function getIntegrationId()
    {
        return $this->integration_id;
    }

    /**
     * Get the [itownid] column value.
     *
     * @return int|null
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [islocked] column value.
     *
     * @return boolean|null
     */
    public function getIslocked()
    {
        return $this->islocked;
    }

    /**
     * Get the [islocked] column value.
     *
     * @return boolean|null
     */
    public function isIslocked()
    {
        return $this->getIslocked();
    }

    /**
     * Get the [lockedreason] column value.
     *
     * @return string|null
     */
    public function getLockedreason()
    {
        return $this->lockedreason;
    }

    /**
     * Get the [optionally formatted] temporal [lockeddate] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getLockeddate($format = null)
    {
        if ($format === null) {
            return $this->lockeddate;
        } else {
            return $this->lockeddate instanceof \DateTimeInterface ? $this->lockeddate->format($format) : null;
        }
    }

    /**
     * Get the [iseodcheckenabled] column value.
     *
     * @return int|null
     */
    public function getIseodcheckenabled()
    {
        return $this->iseodcheckenabled;
    }

    /**
     * Get the [employee_media] column value.
     *
     * @return int|null
     */
    public function getEmployeeMedia()
    {
        return $this->employee_media;
    }

    /**
     * Get the [resi_address] column value.
     *
     * @return string|null
     */
    public function getResiAddress()
    {
        return $this->resi_address;
    }

    /**
     * Get the [can_full_sync] column value.
     *
     * @return boolean|null
     */
    public function getCanFullSync()
    {
        return $this->can_full_sync;
    }

    /**
     * Get the [can_full_sync] column value.
     *
     * @return boolean|null
     */
    public function isCanFullSync()
    {
        return $this->getCanFullSync();
    }

    /**
     * Get the [remark] column value.
     *
     * @return string|null
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Get the [employee_spoken_language] column value.
     *
     * @return string|null
     */
    public function getEmployeeSpokenLanguage()
    {
        return $this->employee_spoken_language;
    }

    /**
     * Get the [last_updated_by_user_id] column value.
     *
     * @return int|null
     */
    public function getLastUpdatedByUserId()
    {
        return $this->last_updated_by_user_id;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositionsRelatedByPositionId !== null && $this->aPositionsRelatedByPositionId->getPositionId() !== $v) {
            $this->aPositionsRelatedByPositionId = null;
        }

        return $this;
    }

    /**
     * Set the value of [reporting_to] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReportingTo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->reporting_to !== $v) {
            $this->reporting_to = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_REPORTING_TO] = true;
        }

        if ($this->aPositionsRelatedByReportingTo !== null && $this->aPositionsRelatedByReportingTo->getPositionId() !== $v) {
            $this->aPositionsRelatedByReportingTo = null;
        }

        return $this;
    }

    /**
     * Set the value of [designation_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDesignationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->designation_id !== $v) {
            $this->designation_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_DESIGNATION_ID] = true;
        }

        if ($this->aDesignations !== null && $this->aDesignations->getDesignationId() !== $v) {
            $this->aDesignations = null;
        }

        return $this;
    }

    /**
     * Set the value of [branch_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBranchId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->branch_id !== $v) {
            $this->branch_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_BRANCH_ID] = true;
        }

        if ($this->aBranch !== null && $this->aBranch->getBranchId() !== $v) {
            $this->aBranch = null;
        }

        return $this;
    }

    /**
     * Set the value of [grade_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGradeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->grade_id !== $v) {
            $this->grade_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_GRADE_ID] = true;
        }

        if ($this->aGradeMaster !== null && $this->aGradeMaster->getGradeid() !== $v) {
            $this->aGradeMaster = null;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ip_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIpAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip_address !== $v) {
            $this->ip_address = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_IP_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [profile_picture] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProfilePicture($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->profile_picture !== $v) {
            $this->profile_picture = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PROFILE_PICTURE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_login] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_login !== $v) {
            $this->last_login = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LAST_LOGIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [costnumber] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCostnumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->costnumber !== $v) {
            $this->costnumber = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_COSTNUMBER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [base_mtarget] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBaseMtarget($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->base_mtarget !== $v) {
            $this->base_mtarget = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_BASE_MTARGET] = true;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_INTEGRATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItownid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [islocked] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIslocked($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->islocked !== $v) {
            $this->islocked = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ISLOCKED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [lockedreason] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLockedreason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lockedreason !== $v) {
            $this->lockedreason = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LOCKEDREASON] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [lockeddate] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setLockeddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lockeddate !== null || $dt !== null) {
            if ($this->lockeddate === null || $dt === null || $dt->format("Y-m-d") !== $this->lockeddate->format("Y-m-d")) {
                $this->lockeddate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EmployeeTableMap::COL_LOCKEDDATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [iseodcheckenabled] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIseodcheckenabled($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iseodcheckenabled !== $v) {
            $this->iseodcheckenabled = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_ISEODCHECKENABLED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_media] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeMedia($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_media !== $v) {
            $this->employee_media = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EMPLOYEE_MEDIA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [resi_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setResiAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->resi_address !== $v) {
            $this->resi_address = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_RESI_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [can_full_sync] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setCanFullSync($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->can_full_sync !== $v) {
            $this->can_full_sync = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_CAN_FULL_SYNC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remark !== $v) {
            $this->remark = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_spoken_language] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeSpokenLanguage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_spoken_language !== $v) {
            $this->employee_spoken_language = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_updated_by_user_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastUpdatedByUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_updated_by_user_id !== $v) {
            $this->last_updated_by_user_id = $v;
            $this->modifiedColumns[EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->islocked !== false) {
                return false;
            }

            if ($this->iseodcheckenabled !== 1) {
                return false;
            }

            if ($this->can_full_sync !== true) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmployeeTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmployeeTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmployeeTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmployeeTableMap::translateFieldName('ReportingTo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reporting_to = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmployeeTableMap::translateFieldName('DesignationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmployeeTableMap::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->branch_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmployeeTableMap::translateFieldName('GradeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->grade_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmployeeTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EmployeeTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EmployeeTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EmployeeTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EmployeeTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EmployeeTableMap::translateFieldName('IpAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EmployeeTableMap::translateFieldName('ProfilePicture', TableMap::TYPE_PHPNAME, $indexType)];
            $this->profile_picture = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EmployeeTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EmployeeTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : EmployeeTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : EmployeeTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : EmployeeTableMap::translateFieldName('Costnumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->costnumber = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : EmployeeTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : EmployeeTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : EmployeeTableMap::translateFieldName('BaseMtarget', TableMap::TYPE_PHPNAME, $indexType)];
            $this->base_mtarget = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : EmployeeTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : EmployeeTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : EmployeeTableMap::translateFieldName('Islocked', TableMap::TYPE_PHPNAME, $indexType)];
            $this->islocked = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : EmployeeTableMap::translateFieldName('Lockedreason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lockedreason = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : EmployeeTableMap::translateFieldName('Lockeddate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lockeddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : EmployeeTableMap::translateFieldName('Iseodcheckenabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iseodcheckenabled = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : EmployeeTableMap::translateFieldName('EmployeeMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_media = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : EmployeeTableMap::translateFieldName('ResiAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resi_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : EmployeeTableMap::translateFieldName('CanFullSync', TableMap::TYPE_PHPNAME, $indexType)];
            $this->can_full_sync = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : EmployeeTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : EmployeeTableMap::translateFieldName('EmployeeSpokenLanguage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_spoken_language = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : EmployeeTableMap::translateFieldName('LastUpdatedByUserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_updated_by_user_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 34; // 34 = EmployeeTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Employee'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aPositionsRelatedByPositionId !== null && $this->position_id !== $this->aPositionsRelatedByPositionId->getPositionId()) {
            $this->aPositionsRelatedByPositionId = null;
        }
        if ($this->aPositionsRelatedByReportingTo !== null && $this->reporting_to !== $this->aPositionsRelatedByReportingTo->getPositionId()) {
            $this->aPositionsRelatedByReportingTo = null;
        }
        if ($this->aDesignations !== null && $this->designation_id !== $this->aDesignations->getDesignationId()) {
            $this->aDesignations = null;
        }
        if ($this->aBranch !== null && $this->branch_id !== $this->aBranch->getBranchId()) {
            $this->aBranch = null;
        }
        if ($this->aGradeMaster !== null && $this->grade_id !== $this->aGradeMaster->getGradeid()) {
            $this->aGradeMaster = null;
        }
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmployeeTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmployeeQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBranch = null;
            $this->aCompany = null;
            $this->aDesignations = null;
            $this->aGradeMaster = null;
            $this->aOrgUnit = null;
            $this->aPositionsRelatedByPositionId = null;
            $this->aPositionsRelatedByReportingTo = null;
            $this->aGeoTowns = null;
            $this->collAnnouncementEmployeeMaps = null;

            $this->collAttendances = null;

            $this->collAuditEmpUnitss = null;

            $this->collBrandRcpas = null;

            $this->collCompetitionMappings = null;

            $this->collDailycallsSgpiouts = null;

            $this->collEdSessions = null;

            $this->collEmployeeIncentives = null;

            $this->collEmployeePositionHistories = null;

            $this->collEventssRelatedByEmployeeId = null;

            $this->collEventssRelatedByApproverEmpId = null;

            $this->collExpensePaymentss = null;

            $this->collExpensess = null;

            $this->collHrUserAccounts = null;

            $this->collHrUserDatess = null;

            $this->collHrUserDocumentss = null;

            $this->collHrUserExperiencess = null;

            $this->collHrUserQualifications = null;

            $this->collHrUserReferencess = null;

            $this->collLeaveRequests = null;

            $this->collLeavess = null;

            $this->collMtps = null;

            $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = null;

            $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = null;

            $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = null;

            $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = null;

            $this->collOnBoardRequestLogs = null;

            $this->collOrderss = null;

            $this->collOtpRequestss = null;

            $this->collOutletss = null;

            $this->collReminderss = null;

            $this->collSalaryAttendanceBackdateTrackLogs = null;

            $this->collSurveySubmiteds = null;

            $this->collTicketRepliess = null;

            $this->collTicketTypes = null;

            $this->collTicketssRelatedByEmployeeId = null;

            $this->collTicketssRelatedByAllocatedTo = null;

            $this->collTransactionssRelatedByEmployeeId = null;

            $this->collTransactionssRelatedByCreatedBy = null;

            $this->collUserss = null;

            $this->collWfLogs = null;

            $this->collWfRequestss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Employee::setDeleted()
     * @see Employee::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmployeeQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EmployeeTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aBranch !== null) {
                if ($this->aBranch->isModified() || $this->aBranch->isNew()) {
                    $affectedRows += $this->aBranch->save($con);
                }
                $this->setBranch($this->aBranch);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aDesignations !== null) {
                if ($this->aDesignations->isModified() || $this->aDesignations->isNew()) {
                    $affectedRows += $this->aDesignations->save($con);
                }
                $this->setDesignations($this->aDesignations);
            }

            if ($this->aGradeMaster !== null) {
                if ($this->aGradeMaster->isModified() || $this->aGradeMaster->isNew()) {
                    $affectedRows += $this->aGradeMaster->save($con);
                }
                $this->setGradeMaster($this->aGradeMaster);
            }

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aPositionsRelatedByPositionId !== null) {
                if ($this->aPositionsRelatedByPositionId->isModified() || $this->aPositionsRelatedByPositionId->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByPositionId->save($con);
                }
                $this->setPositionsRelatedByPositionId($this->aPositionsRelatedByPositionId);
            }

            if ($this->aPositionsRelatedByReportingTo !== null) {
                if ($this->aPositionsRelatedByReportingTo->isModified() || $this->aPositionsRelatedByReportingTo->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByReportingTo->save($con);
                }
                $this->setPositionsRelatedByReportingTo($this->aPositionsRelatedByReportingTo);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->announcementEmployeeMapsScheduledForDeletion !== null) {
                if (!$this->announcementEmployeeMapsScheduledForDeletion->isEmpty()) {
                    foreach ($this->announcementEmployeeMapsScheduledForDeletion as $announcementEmployeeMap) {
                        // need to save related object because we set the relation to null
                        $announcementEmployeeMap->save($con);
                    }
                    $this->announcementEmployeeMapsScheduledForDeletion = null;
                }
            }

            if ($this->collAnnouncementEmployeeMaps !== null) {
                foreach ($this->collAnnouncementEmployeeMaps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->attendancesScheduledForDeletion !== null) {
                if (!$this->attendancesScheduledForDeletion->isEmpty()) {
                    \entities\AttendanceQuery::create()
                        ->filterByPrimaryKeys($this->attendancesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->attendancesScheduledForDeletion = null;
                }
            }

            if ($this->collAttendances !== null) {
                foreach ($this->collAttendances as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->auditEmpUnitssScheduledForDeletion !== null) {
                if (!$this->auditEmpUnitssScheduledForDeletion->isEmpty()) {
                    \entities\AuditEmpUnitsQuery::create()
                        ->filterByPrimaryKeys($this->auditEmpUnitssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->auditEmpUnitssScheduledForDeletion = null;
                }
            }

            if ($this->collAuditEmpUnitss !== null) {
                foreach ($this->collAuditEmpUnitss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->brandRcpasScheduledForDeletion !== null) {
                if (!$this->brandRcpasScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandRcpasScheduledForDeletion as $brandRcpa) {
                        // need to save related object because we set the relation to null
                        $brandRcpa->save($con);
                    }
                    $this->brandRcpasScheduledForDeletion = null;
                }
            }

            if ($this->collBrandRcpas !== null) {
                foreach ($this->collBrandRcpas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->competitionMappingsScheduledForDeletion !== null) {
                if (!$this->competitionMappingsScheduledForDeletion->isEmpty()) {
                    \entities\CompetitionMappingQuery::create()
                        ->filterByPrimaryKeys($this->competitionMappingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->competitionMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collCompetitionMappings !== null) {
                foreach ($this->collCompetitionMappings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dailycallsSgpioutsScheduledForDeletion !== null) {
                if (!$this->dailycallsSgpioutsScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallsSgpioutsScheduledForDeletion as $dailycallsSgpiout) {
                        // need to save related object because we set the relation to null
                        $dailycallsSgpiout->save($con);
                    }
                    $this->dailycallsSgpioutsScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallsSgpiouts !== null) {
                foreach ($this->collDailycallsSgpiouts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->edSessionsScheduledForDeletion !== null) {
                if (!$this->edSessionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->edSessionsScheduledForDeletion as $edSession) {
                        // need to save related object because we set the relation to null
                        $edSession->save($con);
                    }
                    $this->edSessionsScheduledForDeletion = null;
                }
            }

            if ($this->collEdSessions !== null) {
                foreach ($this->collEdSessions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeeIncentivesScheduledForDeletion !== null) {
                if (!$this->employeeIncentivesScheduledForDeletion->isEmpty()) {
                    \entities\EmployeeIncentiveQuery::create()
                        ->filterByPrimaryKeys($this->employeeIncentivesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeIncentivesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeIncentives !== null) {
                foreach ($this->collEmployeeIncentives as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeePositionHistoriesScheduledForDeletion !== null) {
                if (!$this->employeePositionHistoriesScheduledForDeletion->isEmpty()) {
                    \entities\EmployeePositionHistoryQuery::create()
                        ->filterByPrimaryKeys($this->employeePositionHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeePositionHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeePositionHistories !== null) {
                foreach ($this->collEmployeePositionHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventssRelatedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->eventssRelatedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->eventssRelatedByEmployeeIdScheduledForDeletion as $eventsRelatedByEmployeeId) {
                        // need to save related object because we set the relation to null
                        $eventsRelatedByEmployeeId->save($con);
                    }
                    $this->eventssRelatedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collEventssRelatedByEmployeeId !== null) {
                foreach ($this->collEventssRelatedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->eventssRelatedByApproverEmpIdScheduledForDeletion !== null) {
                if (!$this->eventssRelatedByApproverEmpIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->eventssRelatedByApproverEmpIdScheduledForDeletion as $eventsRelatedByApproverEmpId) {
                        // need to save related object because we set the relation to null
                        $eventsRelatedByApproverEmpId->save($con);
                    }
                    $this->eventssRelatedByApproverEmpIdScheduledForDeletion = null;
                }
            }

            if ($this->collEventssRelatedByApproverEmpId !== null) {
                foreach ($this->collEventssRelatedByApproverEmpId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expensePaymentssScheduledForDeletion !== null) {
                if (!$this->expensePaymentssScheduledForDeletion->isEmpty()) {
                    foreach ($this->expensePaymentssScheduledForDeletion as $expensePayments) {
                        // need to save related object because we set the relation to null
                        $expensePayments->save($con);
                    }
                    $this->expensePaymentssScheduledForDeletion = null;
                }
            }

            if ($this->collExpensePaymentss !== null) {
                foreach ($this->collExpensePaymentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expensessScheduledForDeletion !== null) {
                if (!$this->expensessScheduledForDeletion->isEmpty()) {
                    \entities\ExpensesQuery::create()
                        ->filterByPrimaryKeys($this->expensessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expensessScheduledForDeletion = null;
                }
            }

            if ($this->collExpensess !== null) {
                foreach ($this->collExpensess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserAccountsScheduledForDeletion !== null) {
                if (!$this->hrUserAccountsScheduledForDeletion->isEmpty()) {
                    foreach ($this->hrUserAccountsScheduledForDeletion as $hrUserAccount) {
                        // need to save related object because we set the relation to null
                        $hrUserAccount->save($con);
                    }
                    $this->hrUserAccountsScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserAccounts !== null) {
                foreach ($this->collHrUserAccounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserDatessScheduledForDeletion !== null) {
                if (!$this->hrUserDatessScheduledForDeletion->isEmpty()) {
                    \entities\HrUserDatesQuery::create()
                        ->filterByPrimaryKeys($this->hrUserDatessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->hrUserDatessScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserDatess !== null) {
                foreach ($this->collHrUserDatess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserDocumentssScheduledForDeletion !== null) {
                if (!$this->hrUserDocumentssScheduledForDeletion->isEmpty()) {
                    foreach ($this->hrUserDocumentssScheduledForDeletion as $hrUserDocuments) {
                        // need to save related object because we set the relation to null
                        $hrUserDocuments->save($con);
                    }
                    $this->hrUserDocumentssScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserDocumentss !== null) {
                foreach ($this->collHrUserDocumentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserExperiencessScheduledForDeletion !== null) {
                if (!$this->hrUserExperiencessScheduledForDeletion->isEmpty()) {
                    \entities\HrUserExperiencesQuery::create()
                        ->filterByPrimaryKeys($this->hrUserExperiencessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->hrUserExperiencessScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserExperiencess !== null) {
                foreach ($this->collHrUserExperiencess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserQualificationsScheduledForDeletion !== null) {
                if (!$this->hrUserQualificationsScheduledForDeletion->isEmpty()) {
                    \entities\HrUserQualificationQuery::create()
                        ->filterByPrimaryKeys($this->hrUserQualificationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->hrUserQualificationsScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserQualifications !== null) {
                foreach ($this->collHrUserQualifications as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->hrUserReferencessScheduledForDeletion !== null) {
                if (!$this->hrUserReferencessScheduledForDeletion->isEmpty()) {
                    foreach ($this->hrUserReferencessScheduledForDeletion as $hrUserReferences) {
                        // need to save related object because we set the relation to null
                        $hrUserReferences->save($con);
                    }
                    $this->hrUserReferencessScheduledForDeletion = null;
                }
            }

            if ($this->collHrUserReferencess !== null) {
                foreach ($this->collHrUserReferencess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leaveRequestsScheduledForDeletion !== null) {
                if (!$this->leaveRequestsScheduledForDeletion->isEmpty()) {
                    \entities\LeaveRequestQuery::create()
                        ->filterByPrimaryKeys($this->leaveRequestsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->leaveRequestsScheduledForDeletion = null;
                }
            }

            if ($this->collLeaveRequests !== null) {
                foreach ($this->collLeaveRequests as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leavessScheduledForDeletion !== null) {
                if (!$this->leavessScheduledForDeletion->isEmpty()) {
                    foreach ($this->leavessScheduledForDeletion as $leaves) {
                        // need to save related object because we set the relation to null
                        $leaves->save($con);
                    }
                    $this->leavessScheduledForDeletion = null;
                }
            }

            if ($this->collLeavess !== null) {
                foreach ($this->collLeavess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mtpsScheduledForDeletion !== null) {
                if (!$this->mtpsScheduledForDeletion->isEmpty()) {
                    foreach ($this->mtpsScheduledForDeletion as $mtp) {
                        // need to save related object because we set the relation to null
                        $mtp->save($con);
                    }
                    $this->mtpsScheduledForDeletion = null;
                }
            }

            if ($this->collMtps !== null) {
                foreach ($this->collMtps as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion as $onBoardRequestRelatedByApprovedByEmployeeId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByApprovedByEmployeeId->save($con);
                    }
                    $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion as $onBoardRequestRelatedByCreatedByEmployeeId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByCreatedByEmployeeId->save($con);
                    }
                    $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion as $onBoardRequestRelatedByFinalApprovedByEmployeeId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByFinalApprovedByEmployeeId->save($con);
                    }
                    $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion as $onBoardRequestRelatedByUpdatedByEmployeeId) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestRelatedByUpdatedByEmployeeId->save($con);
                    }
                    $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId !== null) {
                foreach ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->onBoardRequestLogsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestLogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestLogsScheduledForDeletion as $onBoardRequestLog) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestLog->save($con);
                    }
                    $this->onBoardRequestLogsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestLogs !== null) {
                foreach ($this->collOnBoardRequestLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssScheduledForDeletion as $orders) {
                        // need to save related object because we set the relation to null
                        $orders->save($con);
                    }
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->otpRequestssScheduledForDeletion !== null) {
                if (!$this->otpRequestssScheduledForDeletion->isEmpty()) {
                    \entities\OtpRequestsQuery::create()
                        ->filterByPrimaryKeys($this->otpRequestssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->otpRequestssScheduledForDeletion = null;
                }
            }

            if ($this->collOtpRequestss !== null) {
                foreach ($this->collOtpRequestss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletssScheduledForDeletion !== null) {
                if (!$this->outletssScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletssScheduledForDeletion as $outlets) {
                        // need to save related object because we set the relation to null
                        $outlets->save($con);
                    }
                    $this->outletssScheduledForDeletion = null;
                }
            }

            if ($this->collOutletss !== null) {
                foreach ($this->collOutletss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->reminderssScheduledForDeletion !== null) {
                if (!$this->reminderssScheduledForDeletion->isEmpty()) {
                    \entities\RemindersQuery::create()
                        ->filterByPrimaryKeys($this->reminderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reminderssScheduledForDeletion = null;
                }
            }

            if ($this->collReminderss !== null) {
                foreach ($this->collReminderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->salaryAttendanceBackdateTrackLogsScheduledForDeletion !== null) {
                if (!$this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->isEmpty()) {
                    \entities\SalaryAttendanceBackdateTrackLogQuery::create()
                        ->filterByPrimaryKeys($this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion = null;
                }
            }

            if ($this->collSalaryAttendanceBackdateTrackLogs !== null) {
                foreach ($this->collSalaryAttendanceBackdateTrackLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->surveySubmitedsScheduledForDeletion !== null) {
                if (!$this->surveySubmitedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveySubmitedsScheduledForDeletion as $surveySubmited) {
                        // need to save related object because we set the relation to null
                        $surveySubmited->save($con);
                    }
                    $this->surveySubmitedsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveySubmiteds !== null) {
                foreach ($this->collSurveySubmiteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ticketRepliessScheduledForDeletion !== null) {
                if (!$this->ticketRepliessScheduledForDeletion->isEmpty()) {
                    \entities\TicketRepliesQuery::create()
                        ->filterByPrimaryKeys($this->ticketRepliessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ticketRepliessScheduledForDeletion = null;
                }
            }

            if ($this->collTicketRepliess !== null) {
                foreach ($this->collTicketRepliess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ticketTypesScheduledForDeletion !== null) {
                if (!$this->ticketTypesScheduledForDeletion->isEmpty()) {
                    \entities\TicketTypeQuery::create()
                        ->filterByPrimaryKeys($this->ticketTypesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ticketTypesScheduledForDeletion = null;
                }
            }

            if ($this->collTicketTypes !== null) {
                foreach ($this->collTicketTypes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ticketssRelatedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->ticketssRelatedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    \entities\TicketsQuery::create()
                        ->filterByPrimaryKeys($this->ticketssRelatedByEmployeeIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ticketssRelatedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collTicketssRelatedByEmployeeId !== null) {
                foreach ($this->collTicketssRelatedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ticketssRelatedByAllocatedToScheduledForDeletion !== null) {
                if (!$this->ticketssRelatedByAllocatedToScheduledForDeletion->isEmpty()) {
                    foreach ($this->ticketssRelatedByAllocatedToScheduledForDeletion as $ticketsRelatedByAllocatedTo) {
                        // need to save related object because we set the relation to null
                        $ticketsRelatedByAllocatedTo->save($con);
                    }
                    $this->ticketssRelatedByAllocatedToScheduledForDeletion = null;
                }
            }

            if ($this->collTicketssRelatedByAllocatedTo !== null) {
                foreach ($this->collTicketssRelatedByAllocatedTo as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transactionssRelatedByEmployeeIdScheduledForDeletion !== null) {
                if (!$this->transactionssRelatedByEmployeeIdScheduledForDeletion->isEmpty()) {
                    \entities\TransactionsQuery::create()
                        ->filterByPrimaryKeys($this->transactionssRelatedByEmployeeIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionssRelatedByEmployeeIdScheduledForDeletion = null;
                }
            }

            if ($this->collTransactionssRelatedByEmployeeId !== null) {
                foreach ($this->collTransactionssRelatedByEmployeeId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->transactionssRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->transactionssRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    \entities\TransactionsQuery::create()
                        ->filterByPrimaryKeys($this->transactionssRelatedByCreatedByScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->transactionssRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collTransactionssRelatedByCreatedBy !== null) {
                foreach ($this->collTransactionssRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userssScheduledForDeletion !== null) {
                if (!$this->userssScheduledForDeletion->isEmpty()) {
                    foreach ($this->userssScheduledForDeletion as $users) {
                        // need to save related object because we set the relation to null
                        $users->save($con);
                    }
                    $this->userssScheduledForDeletion = null;
                }
            }

            if ($this->collUserss !== null) {
                foreach ($this->collUserss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->wfLogsScheduledForDeletion !== null) {
                if (!$this->wfLogsScheduledForDeletion->isEmpty()) {
                    \entities\WfLogQuery::create()
                        ->filterByPrimaryKeys($this->wfLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfLogsScheduledForDeletion = null;
                }
            }

            if ($this->collWfLogs !== null) {
                foreach ($this->collWfLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->wfRequestssScheduledForDeletion !== null) {
                if (!$this->wfRequestssScheduledForDeletion->isEmpty()) {
                    \entities\WfRequestsQuery::create()
                        ->filterByPrimaryKeys($this->wfRequestssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->wfRequestssScheduledForDeletion = null;
                }
            }

            if ($this->collWfRequestss !== null) {
                foreach ($this->collWfRequestss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[EmployeeTableMap::COL_EMPLOYEE_ID] = true;
        if (null !== $this->employee_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmployeeTableMap::COL_EMPLOYEE_ID . ')');
        }
        if (null === $this->employee_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('employee_employee_id_seq')");
                $this->employee_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_REPORTING_TO)) {
            $modifiedColumns[':p' . $index++]  = 'reporting_to';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_DESIGNATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'designation_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_BRANCH_ID)) {
            $modifiedColumns[':p' . $index++]  = 'branch_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_GRADE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'grade_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_code';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_IP_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ip_address';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PROFILE_PICTURE)) {
            $modifiedColumns[':p' . $index++]  = 'profile_picture';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COSTNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'costnumber';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_BASE_MTARGET)) {
            $modifiedColumns[':p' . $index++]  = 'base_mtarget';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_INTEGRATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'integration_id';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ISLOCKED)) {
            $modifiedColumns[':p' . $index++]  = 'islocked';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LOCKEDREASON)) {
            $modifiedColumns[':p' . $index++]  = 'lockedreason';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LOCKEDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'lockeddate';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ISEODCHECKENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'iseodcheckenabled';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'employee_media';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_RESI_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'resi_address';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CAN_FULL_SYNC)) {
            $modifiedColumns[':p' . $index++]  = 'can_full_sync';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'remark';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_spoken_language';
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'last_updated_by_user_id';
        }

        $sql = sprintf(
            'INSERT INTO employee (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'reporting_to':
                        $stmt->bindValue($identifier, $this->reporting_to, PDO::PARAM_INT);

                        break;
                    case 'designation_id':
                        $stmt->bindValue($identifier, $this->designation_id, PDO::PARAM_INT);

                        break;
                    case 'branch_id':
                        $stmt->bindValue($identifier, $this->branch_id, PDO::PARAM_INT);

                        break;
                    case 'grade_id':
                        $stmt->bindValue($identifier, $this->grade_id, PDO::PARAM_INT);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'employee_code':
                        $stmt->bindValue($identifier, $this->employee_code, PDO::PARAM_STR);

                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'ip_address':
                        $stmt->bindValue($identifier, $this->ip_address, PDO::PARAM_STR);

                        break;
                    case 'profile_picture':
                        $stmt->bindValue($identifier, $this->profile_picture, PDO::PARAM_STR);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'last_login':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);

                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);

                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);

                        break;
                    case 'costnumber':
                        $stmt->bindValue($identifier, $this->costnumber, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'base_mtarget':
                        $stmt->bindValue($identifier, $this->base_mtarget, PDO::PARAM_STR);

                        break;
                    case 'integration_id':
                        $stmt->bindValue($identifier, $this->integration_id, PDO::PARAM_STR);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'islocked':
                        $stmt->bindValue($identifier, $this->islocked, PDO::PARAM_BOOL);

                        break;
                    case 'lockedreason':
                        $stmt->bindValue($identifier, $this->lockedreason, PDO::PARAM_STR);

                        break;
                    case 'lockeddate':
                        $stmt->bindValue($identifier, $this->lockeddate ? $this->lockeddate->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'iseodcheckenabled':
                        $stmt->bindValue($identifier, $this->iseodcheckenabled, PDO::PARAM_INT);

                        break;
                    case 'employee_media':
                        $stmt->bindValue($identifier, $this->employee_media, PDO::PARAM_INT);

                        break;
                    case 'resi_address':
                        $stmt->bindValue($identifier, $this->resi_address, PDO::PARAM_STR);

                        break;
                    case 'can_full_sync':
                        $stmt->bindValue($identifier, $this->can_full_sync, PDO::PARAM_BOOL);

                        break;
                    case 'remark':
                        $stmt->bindValue($identifier, $this->remark, PDO::PARAM_STR);

                        break;
                    case 'employee_spoken_language':
                        $stmt->bindValue($identifier, $this->employee_spoken_language, PDO::PARAM_STR);

                        break;
                    case 'last_updated_by_user_id':
                        $stmt->bindValue($identifier, $this->last_updated_by_user_id, PDO::PARAM_INT);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getEmployeeId();

            case 1:
                return $this->getCompanyId();

            case 2:
                return $this->getPositionId();

            case 3:
                return $this->getReportingTo();

            case 4:
                return $this->getDesignationId();

            case 5:
                return $this->getBranchId();

            case 6:
                return $this->getGradeId();

            case 7:
                return $this->getOrgUnitId();

            case 8:
                return $this->getEmployeeCode();

            case 9:
                return $this->getFirstName();

            case 10:
                return $this->getLastName();

            case 11:
                return $this->getStatus();

            case 12:
                return $this->getIpAddress();

            case 13:
                return $this->getProfilePicture();

            case 14:
                return $this->getEmail();

            case 15:
                return $this->getLastLogin();

            case 16:
                return $this->getPhone();

            case 17:
                return $this->getAddress();

            case 18:
                return $this->getCostnumber();

            case 19:
                return $this->getCreatedAt();

            case 20:
                return $this->getUpdatedAt();

            case 21:
                return $this->getBaseMtarget();

            case 22:
                return $this->getIntegrationId();

            case 23:
                return $this->getItownid();

            case 24:
                return $this->getIslocked();

            case 25:
                return $this->getLockedreason();

            case 26:
                return $this->getLockeddate();

            case 27:
                return $this->getIseodcheckenabled();

            case 28:
                return $this->getEmployeeMedia();

            case 29:
                return $this->getResiAddress();

            case 30:
                return $this->getCanFullSync();

            case 31:
                return $this->getRemark();

            case 32:
                return $this->getEmployeeSpokenLanguage();

            case 33:
                return $this->getLastUpdatedByUserId();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Employee'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Employee'][$this->hashCode()] = true;
        $keys = EmployeeTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getEmployeeId(),
            $keys[1] => $this->getCompanyId(),
            $keys[2] => $this->getPositionId(),
            $keys[3] => $this->getReportingTo(),
            $keys[4] => $this->getDesignationId(),
            $keys[5] => $this->getBranchId(),
            $keys[6] => $this->getGradeId(),
            $keys[7] => $this->getOrgUnitId(),
            $keys[8] => $this->getEmployeeCode(),
            $keys[9] => $this->getFirstName(),
            $keys[10] => $this->getLastName(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getIpAddress(),
            $keys[13] => $this->getProfilePicture(),
            $keys[14] => $this->getEmail(),
            $keys[15] => $this->getLastLogin(),
            $keys[16] => $this->getPhone(),
            $keys[17] => $this->getAddress(),
            $keys[18] => $this->getCostnumber(),
            $keys[19] => $this->getCreatedAt(),
            $keys[20] => $this->getUpdatedAt(),
            $keys[21] => $this->getBaseMtarget(),
            $keys[22] => $this->getIntegrationId(),
            $keys[23] => $this->getItownid(),
            $keys[24] => $this->getIslocked(),
            $keys[25] => $this->getLockedreason(),
            $keys[26] => $this->getLockeddate(),
            $keys[27] => $this->getIseodcheckenabled(),
            $keys[28] => $this->getEmployeeMedia(),
            $keys[29] => $this->getResiAddress(),
            $keys[30] => $this->getCanFullSync(),
            $keys[31] => $this->getRemark(),
            $keys[32] => $this->getEmployeeSpokenLanguage(),
            $keys[33] => $this->getLastUpdatedByUserId(),
        ];
        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[26]] instanceof \DateTimeInterface) {
            $result[$keys[26]] = $result[$keys[26]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBranch) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'branch';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'branch';
                        break;
                    default:
                        $key = 'Branch';
                }

                $result[$key] = $this->aBranch->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'company';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDesignations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'designations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'designations';
                        break;
                    default:
                        $key = 'Designations';
                }

                $result[$key] = $this->aDesignations->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGradeMaster) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'gradeMaster';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'grade_master';
                        break;
                    default:
                        $key = 'GradeMaster';
                }

                $result[$key] = $this->aGradeMaster->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOrgUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orgUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'org_unit';
                        break;
                    default:
                        $key = 'OrgUnit';
                }

                $result[$key] = $this->aOrgUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByPositionId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'positions';
                        break;
                    default:
                        $key = 'Positions';
                }

                $result[$key] = $this->aPositionsRelatedByPositionId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByReportingTo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'positions';
                        break;
                    default:
                        $key = 'Positions';
                }

                $result[$key] = $this->aPositionsRelatedByReportingTo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoTowns) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoTowns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_towns';
                        break;
                    default:
                        $key = 'GeoTowns';
                }

                $result[$key] = $this->aGeoTowns->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAnnouncementEmployeeMaps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'announcementEmployeeMaps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'announcement_employee_maps';
                        break;
                    default:
                        $key = 'AnnouncementEmployeeMaps';
                }

                $result[$key] = $this->collAnnouncementEmployeeMaps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAttendances) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'attendances';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'attendances';
                        break;
                    default:
                        $key = 'Attendances';
                }

                $result[$key] = $this->collAttendances->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuditEmpUnitss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'auditEmpUnitss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'audit_emp_unitss';
                        break;
                    default:
                        $key = 'AuditEmpUnitss';
                }

                $result[$key] = $this->collAuditEmpUnitss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBrandRcpas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandRcpas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_rcpas';
                        break;
                    default:
                        $key = 'BrandRcpas';
                }

                $result[$key] = $this->collBrandRcpas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCompetitionMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'competitionMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'competition_mappings';
                        break;
                    default:
                        $key = 'CompetitionMappings';
                }

                $result[$key] = $this->collCompetitionMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDailycallsSgpiouts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallsSgpiouts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycalls_sgpiouts';
                        break;
                    default:
                        $key = 'DailycallsSgpiouts';
                }

                $result[$key] = $this->collDailycallsSgpiouts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEdSessions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edSessions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_sessions';
                        break;
                    default:
                        $key = 'EdSessions';
                }

                $result[$key] = $this->collEdSessions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeeIncentives) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeIncentives';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee_incentives';
                        break;
                    default:
                        $key = 'EmployeeIncentives';
                }

                $result[$key] = $this->collEmployeeIncentives->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeePositionHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeePositionHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee_position_histories';
                        break;
                    default:
                        $key = 'EmployeePositionHistories';
                }

                $result[$key] = $this->collEmployeePositionHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventssRelatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'eventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'eventss';
                        break;
                    default:
                        $key = 'Eventss';
                }

                $result[$key] = $this->collEventssRelatedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEventssRelatedByApproverEmpId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'eventss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'eventss';
                        break;
                    default:
                        $key = 'Eventss';
                }

                $result[$key] = $this->collEventssRelatedByApproverEmpId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpensePaymentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensePaymentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_paymentss';
                        break;
                    default:
                        $key = 'ExpensePaymentss';
                }

                $result[$key] = $this->collExpensePaymentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpensess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expensess';
                        break;
                    default:
                        $key = 'Expensess';
                }

                $result[$key] = $this->collExpensess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserAccounts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserAccounts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_accounts';
                        break;
                    default:
                        $key = 'HrUserAccounts';
                }

                $result[$key] = $this->collHrUserAccounts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserDatess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserDatess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_datess';
                        break;
                    default:
                        $key = 'HrUserDatess';
                }

                $result[$key] = $this->collHrUserDatess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserDocumentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserDocumentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_documentss';
                        break;
                    default:
                        $key = 'HrUserDocumentss';
                }

                $result[$key] = $this->collHrUserDocumentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserExperiencess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserExperiencess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_experiencess';
                        break;
                    default:
                        $key = 'HrUserExperiencess';
                }

                $result[$key] = $this->collHrUserExperiencess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserQualifications) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserQualifications';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_qualifications';
                        break;
                    default:
                        $key = 'HrUserQualifications';
                }

                $result[$key] = $this->collHrUserQualifications->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHrUserReferencess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hrUserReferencess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hr_user_referencess';
                        break;
                    default:
                        $key = 'HrUserReferencess';
                }

                $result[$key] = $this->collHrUserReferencess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeaveRequests) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'leaveRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'leave_requests';
                        break;
                    default:
                        $key = 'LeaveRequests';
                }

                $result[$key] = $this->collLeaveRequests->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeavess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'leavess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'leavess';
                        break;
                    default:
                        $key = 'Leavess';
                }

                $result[$key] = $this->collLeavess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMtps) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtps';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtps';
                        break;
                    default:
                        $key = 'Mtps';
                }

                $result[$key] = $this->collMtps->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByApprovedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByCreatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequests';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_requests';
                        break;
                    default:
                        $key = 'OnBoardRequests';
                }

                $result[$key] = $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOnBoardRequestLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_logs';
                        break;
                    default:
                        $key = 'OnBoardRequestLogs';
                }

                $result[$key] = $this->collOnBoardRequestLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOtpRequestss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'otpRequestss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'otp_requestss';
                        break;
                    default:
                        $key = 'OtpRequestss';
                }

                $result[$key] = $this->collOtpRequestss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outletss';
                        break;
                    default:
                        $key = 'Outletss';
                }

                $result[$key] = $this->collOutletss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collReminderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reminderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reminderss';
                        break;
                    default:
                        $key = 'Reminderss';
                }

                $result[$key] = $this->collReminderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSalaryAttendanceBackdateTrackLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'salaryAttendanceBackdateTrackLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'salary_attendance_backdate_track_logs';
                        break;
                    default:
                        $key = 'SalaryAttendanceBackdateTrackLogs';
                }

                $result[$key] = $this->collSalaryAttendanceBackdateTrackLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSurveySubmiteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveySubmiteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_submiteds';
                        break;
                    default:
                        $key = 'SurveySubmiteds';
                }

                $result[$key] = $this->collSurveySubmiteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTicketRepliess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketRepliess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticket_repliess';
                        break;
                    default:
                        $key = 'TicketRepliess';
                }

                $result[$key] = $this->collTicketRepliess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTicketTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticket_types';
                        break;
                    default:
                        $key = 'TicketTypes';
                }

                $result[$key] = $this->collTicketTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTicketssRelatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticketss';
                        break;
                    default:
                        $key = 'Ticketss';
                }

                $result[$key] = $this->collTicketssRelatedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTicketssRelatedByAllocatedTo) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ticketss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ticketss';
                        break;
                    default:
                        $key = 'Ticketss';
                }

                $result[$key] = $this->collTicketssRelatedByAllocatedTo->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransactionssRelatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactionss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'transactionss';
                        break;
                    default:
                        $key = 'Transactionss';
                }

                $result[$key] = $this->collTransactionssRelatedByEmployeeId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTransactionssRelatedByCreatedBy) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'transactionss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'transactionss';
                        break;
                    default:
                        $key = 'Transactionss';
                }

                $result[$key] = $this->collTransactionssRelatedByCreatedBy->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'userss';
                        break;
                    default:
                        $key = 'Userss';
                }

                $result[$key] = $this->collUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWfLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_logs';
                        break;
                    default:
                        $key = 'WfLogs';
                }

                $result[$key] = $this->collWfLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWfRequestss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wfRequestss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wf_requestss';
                        break;
                    default:
                        $key = 'WfRequestss';
                }

                $result[$key] = $this->collWfRequestss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmployeeTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEmployeeId($value);
                break;
            case 1:
                $this->setCompanyId($value);
                break;
            case 2:
                $this->setPositionId($value);
                break;
            case 3:
                $this->setReportingTo($value);
                break;
            case 4:
                $this->setDesignationId($value);
                break;
            case 5:
                $this->setBranchId($value);
                break;
            case 6:
                $this->setGradeId($value);
                break;
            case 7:
                $this->setOrgUnitId($value);
                break;
            case 8:
                $this->setEmployeeCode($value);
                break;
            case 9:
                $this->setFirstName($value);
                break;
            case 10:
                $this->setLastName($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setIpAddress($value);
                break;
            case 13:
                $this->setProfilePicture($value);
                break;
            case 14:
                $this->setEmail($value);
                break;
            case 15:
                $this->setLastLogin($value);
                break;
            case 16:
                $this->setPhone($value);
                break;
            case 17:
                $this->setAddress($value);
                break;
            case 18:
                $this->setCostnumber($value);
                break;
            case 19:
                $this->setCreatedAt($value);
                break;
            case 20:
                $this->setUpdatedAt($value);
                break;
            case 21:
                $this->setBaseMtarget($value);
                break;
            case 22:
                $this->setIntegrationId($value);
                break;
            case 23:
                $this->setItownid($value);
                break;
            case 24:
                $this->setIslocked($value);
                break;
            case 25:
                $this->setLockedreason($value);
                break;
            case 26:
                $this->setLockeddate($value);
                break;
            case 27:
                $this->setIseodcheckenabled($value);
                break;
            case 28:
                $this->setEmployeeMedia($value);
                break;
            case 29:
                $this->setResiAddress($value);
                break;
            case 30:
                $this->setCanFullSync($value);
                break;
            case 31:
                $this->setRemark($value);
                break;
            case 32:
                $this->setEmployeeSpokenLanguage($value);
                break;
            case 33:
                $this->setLastUpdatedByUserId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = EmployeeTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEmployeeId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCompanyId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPositionId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setReportingTo($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDesignationId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBranchId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setGradeId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setOrgUnitId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmployeeCode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFirstName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLastName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIpAddress($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setProfilePicture($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEmail($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setLastLogin($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPhone($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setAddress($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCostnumber($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCreatedAt($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setUpdatedAt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setBaseMtarget($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setIntegrationId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setItownid($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setIslocked($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setLockedreason($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setLockeddate($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setIseodcheckenabled($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setEmployeeMedia($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setResiAddress($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setCanFullSync($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setRemark($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setEmployeeSpokenLanguage($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setLastUpdatedByUserId($arr[$keys[33]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(EmployeeTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COMPANY_ID)) {
            $criteria->add(EmployeeTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_POSITION_ID)) {
            $criteria->add(EmployeeTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_REPORTING_TO)) {
            $criteria->add(EmployeeTableMap::COL_REPORTING_TO, $this->reporting_to);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_DESIGNATION_ID)) {
            $criteria->add(EmployeeTableMap::COL_DESIGNATION_ID, $this->designation_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_BRANCH_ID)) {
            $criteria->add(EmployeeTableMap::COL_BRANCH_ID, $this->branch_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_GRADE_ID)) {
            $criteria->add(EmployeeTableMap::COL_GRADE_ID, $this->grade_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(EmployeeTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(EmployeeTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_FIRST_NAME)) {
            $criteria->add(EmployeeTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_NAME)) {
            $criteria->add(EmployeeTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_STATUS)) {
            $criteria->add(EmployeeTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_IP_ADDRESS)) {
            $criteria->add(EmployeeTableMap::COL_IP_ADDRESS, $this->ip_address);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PROFILE_PICTURE)) {
            $criteria->add(EmployeeTableMap::COL_PROFILE_PICTURE, $this->profile_picture);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMAIL)) {
            $criteria->add(EmployeeTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_LOGIN)) {
            $criteria->add(EmployeeTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_PHONE)) {
            $criteria->add(EmployeeTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ADDRESS)) {
            $criteria->add(EmployeeTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_COSTNUMBER)) {
            $criteria->add(EmployeeTableMap::COL_COSTNUMBER, $this->costnumber);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CREATED_AT)) {
            $criteria->add(EmployeeTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_UPDATED_AT)) {
            $criteria->add(EmployeeTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_BASE_MTARGET)) {
            $criteria->add(EmployeeTableMap::COL_BASE_MTARGET, $this->base_mtarget);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(EmployeeTableMap::COL_INTEGRATION_ID, $this->integration_id);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ITOWNID)) {
            $criteria->add(EmployeeTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ISLOCKED)) {
            $criteria->add(EmployeeTableMap::COL_ISLOCKED, $this->islocked);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LOCKEDREASON)) {
            $criteria->add(EmployeeTableMap::COL_LOCKEDREASON, $this->lockedreason);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LOCKEDDATE)) {
            $criteria->add(EmployeeTableMap::COL_LOCKEDDATE, $this->lockeddate);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_ISEODCHECKENABLED)) {
            $criteria->add(EmployeeTableMap::COL_ISEODCHECKENABLED, $this->iseodcheckenabled);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_MEDIA)) {
            $criteria->add(EmployeeTableMap::COL_EMPLOYEE_MEDIA, $this->employee_media);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_RESI_ADDRESS)) {
            $criteria->add(EmployeeTableMap::COL_RESI_ADDRESS, $this->resi_address);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_CAN_FULL_SYNC)) {
            $criteria->add(EmployeeTableMap::COL_CAN_FULL_SYNC, $this->can_full_sync);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_REMARK)) {
            $criteria->add(EmployeeTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE)) {
            $criteria->add(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE, $this->employee_spoken_language);
        }
        if ($this->isColumnModified(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID)) {
            $criteria->add(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID, $this->last_updated_by_user_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildEmployeeQuery::create();
        $criteria->add(EmployeeTableMap::COL_EMPLOYEE_ID, $this->employee_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getEmployeeId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getEmployeeId();
    }

    /**
     * Generic method to set the primary key (employee_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setEmployeeId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getEmployeeId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Employee (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setReportingTo($this->getReportingTo());
        $copyObj->setDesignationId($this->getDesignationId());
        $copyObj->setBranchId($this->getBranchId());
        $copyObj->setGradeId($this->getGradeId());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIpAddress($this->getIpAddress());
        $copyObj->setProfilePicture($this->getProfilePicture());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setCostnumber($this->getCostnumber());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setBaseMtarget($this->getBaseMtarget());
        $copyObj->setIntegrationId($this->getIntegrationId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setIslocked($this->getIslocked());
        $copyObj->setLockedreason($this->getLockedreason());
        $copyObj->setLockeddate($this->getLockeddate());
        $copyObj->setIseodcheckenabled($this->getIseodcheckenabled());
        $copyObj->setEmployeeMedia($this->getEmployeeMedia());
        $copyObj->setResiAddress($this->getResiAddress());
        $copyObj->setCanFullSync($this->getCanFullSync());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setEmployeeSpokenLanguage($this->getEmployeeSpokenLanguage());
        $copyObj->setLastUpdatedByUserId($this->getLastUpdatedByUserId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAnnouncementEmployeeMaps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAnnouncementEmployeeMap($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAttendances() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAttendance($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuditEmpUnitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuditEmpUnits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBrandRcpas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandRcpa($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCompetitionMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCompetitionMapping($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsSgpiouts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsSgpiout($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEdSessions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdSession($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeIncentives() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeIncentive($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeePositionHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeePositionHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventssRelatedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventsRelatedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEventssRelatedByApproverEmpId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEventsRelatedByApproverEmpId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensePaymentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpensePayments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserAccounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserAccount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserDatess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserDates($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserDocumentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserDocuments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserExperiencess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserExperiences($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserQualifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserQualification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHrUserReferencess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHrUserReferences($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeaveRequests() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeaveRequest($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeavess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeaves($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMtps() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMtp($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByApprovedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByApprovedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByCreatedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByCreatedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByFinalApprovedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestsRelatedByUpdatedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestRelatedByUpdatedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOtpRequestss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOtpRequests($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutlets($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getReminderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReminders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSalaryAttendanceBackdateTrackLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSalaryAttendanceBackdateTrackLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveySubmiteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveySubmited($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTicketRepliess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTicketReplies($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTicketTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTicketType($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTicketssRelatedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTicketsRelatedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTicketssRelatedByAllocatedTo() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTicketsRelatedByAllocatedTo($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransactionssRelatedByEmployeeId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionsRelatedByEmployeeId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTransactionssRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTransactionsRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWfLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWfRequestss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWfRequests($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEmployeeId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \entities\Employee Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildBranch object.
     *
     * @param ChildBranch $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBranch(ChildBranch $v = null)
    {
        if ($v === null) {
            $this->setBranchId(NULL);
        } else {
            $this->setBranchId($v->getBranchId());
        }

        $this->aBranch = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBranch object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBranch object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBranch The associated ChildBranch object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBranch(?ConnectionInterface $con = null)
    {
        if ($this->aBranch === null && ($this->branch_id != 0)) {
            $this->aBranch = ChildBranchQuery::create()->findPk($this->branch_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBranch->addEmployees($this);
             */
        }

        return $this->aBranch;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param ChildCompany $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(NULL);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->company_id != 0)) {
            $this->aCompany = ChildCompanyQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addEmployees($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildDesignations object.
     *
     * @param ChildDesignations|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setDesignations(ChildDesignations $v = null)
    {
        if ($v === null) {
            $this->setDesignationId(NULL);
        } else {
            $this->setDesignationId($v->getDesignationId());
        }

        $this->aDesignations = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDesignations object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDesignations object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildDesignations|null The associated ChildDesignations object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDesignations(?ConnectionInterface $con = null)
    {
        if ($this->aDesignations === null && ($this->designation_id != 0)) {
            $this->aDesignations = ChildDesignationsQuery::create()->findPk($this->designation_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDesignations->addEmployees($this);
             */
        }

        return $this->aDesignations;
    }

    /**
     * Declares an association between this object and a ChildGradeMaster object.
     *
     * @param ChildGradeMaster $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGradeMaster(ChildGradeMaster $v = null)
    {
        if ($v === null) {
            $this->setGradeId(NULL);
        } else {
            $this->setGradeId($v->getGradeid());
        }

        $this->aGradeMaster = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGradeMaster object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGradeMaster object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGradeMaster The associated ChildGradeMaster object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGradeMaster(?ConnectionInterface $con = null)
    {
        if ($this->aGradeMaster === null && ($this->grade_id != 0)) {
            $this->aGradeMaster = ChildGradeMasterQuery::create()->findPk($this->grade_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGradeMaster->addEmployees($this);
             */
        }

        return $this->aGradeMaster;
    }

    /**
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgUnitId(NULL);
        } else {
            $this->setOrgUnitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit The associated ChildOrgUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnit(?ConnectionInterface $con = null)
    {
        if ($this->aOrgUnit === null && ($this->org_unit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->org_unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addEmployees($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByPositionId(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setPositionId(NULL);
        } else {
            $this->setPositionId($v->getPositionId());
        }

        $this->aPositionsRelatedByPositionId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployeeRelatedByPositionId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositions object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPositions|null The associated ChildPositions object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPositionsRelatedByPositionId(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByPositionId === null && ($this->position_id != 0)) {
            $this->aPositionsRelatedByPositionId = ChildPositionsQuery::create()->findPk($this->position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByPositionId->addEmployeesRelatedByPositionId($this);
             */
        }

        return $this->aPositionsRelatedByPositionId;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByReportingTo(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setReportingTo(NULL);
        } else {
            $this->setReportingTo($v->getPositionId());
        }

        $this->aPositionsRelatedByReportingTo = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployeeRelatedByReportingTo($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositions object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPositions|null The associated ChildPositions object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPositionsRelatedByReportingTo(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByReportingTo === null && ($this->reporting_to != 0)) {
            $this->aPositionsRelatedByReportingTo = ChildPositionsQuery::create()->findPk($this->reporting_to, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByReportingTo->addEmployeesRelatedByReportingTo($this);
             */
        }

        return $this->aPositionsRelatedByReportingTo;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTowns(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setItownid(NULL);
        } else {
            $this->setItownid($v->getItownid());
        }

        $this->aGeoTowns = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addEmployee($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns|null The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTowns(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTowns === null && ($this->itownid != 0)) {
            $this->aGeoTowns = ChildGeoTownsQuery::create()->findPk($this->itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTowns->addEmployees($this);
             */
        }

        return $this->aGeoTowns;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('AnnouncementEmployeeMap' === $relationName) {
            $this->initAnnouncementEmployeeMaps();
            return;
        }
        if ('Attendance' === $relationName) {
            $this->initAttendances();
            return;
        }
        if ('AuditEmpUnits' === $relationName) {
            $this->initAuditEmpUnitss();
            return;
        }
        if ('BrandRcpa' === $relationName) {
            $this->initBrandRcpas();
            return;
        }
        if ('CompetitionMapping' === $relationName) {
            $this->initCompetitionMappings();
            return;
        }
        if ('DailycallsSgpiout' === $relationName) {
            $this->initDailycallsSgpiouts();
            return;
        }
        if ('EdSession' === $relationName) {
            $this->initEdSessions();
            return;
        }
        if ('EmployeeIncentive' === $relationName) {
            $this->initEmployeeIncentives();
            return;
        }
        if ('EmployeePositionHistory' === $relationName) {
            $this->initEmployeePositionHistories();
            return;
        }
        if ('EventsRelatedByEmployeeId' === $relationName) {
            $this->initEventssRelatedByEmployeeId();
            return;
        }
        if ('EventsRelatedByApproverEmpId' === $relationName) {
            $this->initEventssRelatedByApproverEmpId();
            return;
        }
        if ('ExpensePayments' === $relationName) {
            $this->initExpensePaymentss();
            return;
        }
        if ('Expenses' === $relationName) {
            $this->initExpensess();
            return;
        }
        if ('HrUserAccount' === $relationName) {
            $this->initHrUserAccounts();
            return;
        }
        if ('HrUserDates' === $relationName) {
            $this->initHrUserDatess();
            return;
        }
        if ('HrUserDocuments' === $relationName) {
            $this->initHrUserDocumentss();
            return;
        }
        if ('HrUserExperiences' === $relationName) {
            $this->initHrUserExperiencess();
            return;
        }
        if ('HrUserQualification' === $relationName) {
            $this->initHrUserQualifications();
            return;
        }
        if ('HrUserReferences' === $relationName) {
            $this->initHrUserReferencess();
            return;
        }
        if ('LeaveRequest' === $relationName) {
            $this->initLeaveRequests();
            return;
        }
        if ('Leaves' === $relationName) {
            $this->initLeavess();
            return;
        }
        if ('Mtp' === $relationName) {
            $this->initMtps();
            return;
        }
        if ('OnBoardRequestRelatedByApprovedByEmployeeId' === $relationName) {
            $this->initOnBoardRequestsRelatedByApprovedByEmployeeId();
            return;
        }
        if ('OnBoardRequestRelatedByCreatedByEmployeeId' === $relationName) {
            $this->initOnBoardRequestsRelatedByCreatedByEmployeeId();
            return;
        }
        if ('OnBoardRequestRelatedByFinalApprovedByEmployeeId' === $relationName) {
            $this->initOnBoardRequestsRelatedByFinalApprovedByEmployeeId();
            return;
        }
        if ('OnBoardRequestRelatedByUpdatedByEmployeeId' === $relationName) {
            $this->initOnBoardRequestsRelatedByUpdatedByEmployeeId();
            return;
        }
        if ('OnBoardRequestLog' === $relationName) {
            $this->initOnBoardRequestLogs();
            return;
        }
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('OtpRequests' === $relationName) {
            $this->initOtpRequestss();
            return;
        }
        if ('Outlets' === $relationName) {
            $this->initOutletss();
            return;
        }
        if ('Reminders' === $relationName) {
            $this->initReminderss();
            return;
        }
        if ('SalaryAttendanceBackdateTrackLog' === $relationName) {
            $this->initSalaryAttendanceBackdateTrackLogs();
            return;
        }
        if ('SurveySubmited' === $relationName) {
            $this->initSurveySubmiteds();
            return;
        }
        if ('TicketReplies' === $relationName) {
            $this->initTicketRepliess();
            return;
        }
        if ('TicketType' === $relationName) {
            $this->initTicketTypes();
            return;
        }
        if ('TicketsRelatedByEmployeeId' === $relationName) {
            $this->initTicketssRelatedByEmployeeId();
            return;
        }
        if ('TicketsRelatedByAllocatedTo' === $relationName) {
            $this->initTicketssRelatedByAllocatedTo();
            return;
        }
        if ('TransactionsRelatedByEmployeeId' === $relationName) {
            $this->initTransactionssRelatedByEmployeeId();
            return;
        }
        if ('TransactionsRelatedByCreatedBy' === $relationName) {
            $this->initTransactionssRelatedByCreatedBy();
            return;
        }
        if ('Users' === $relationName) {
            $this->initUserss();
            return;
        }
        if ('WfLog' === $relationName) {
            $this->initWfLogs();
            return;
        }
        if ('WfRequests' === $relationName) {
            $this->initWfRequestss();
            return;
        }
    }

    /**
     * Clears out the collAnnouncementEmployeeMaps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAnnouncementEmployeeMaps()
     */
    public function clearAnnouncementEmployeeMaps()
    {
        $this->collAnnouncementEmployeeMaps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAnnouncementEmployeeMaps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAnnouncementEmployeeMaps($v = true): void
    {
        $this->collAnnouncementEmployeeMapsPartial = $v;
    }

    /**
     * Initializes the collAnnouncementEmployeeMaps collection.
     *
     * By default this just sets the collAnnouncementEmployeeMaps collection to an empty array (like clearcollAnnouncementEmployeeMaps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAnnouncementEmployeeMaps(bool $overrideExisting = true): void
    {
        if (null !== $this->collAnnouncementEmployeeMaps && !$overrideExisting) {
            return;
        }

        $collectionClassName = AnnouncementEmployeeMapTableMap::getTableMap()->getCollectionClassName();

        $this->collAnnouncementEmployeeMaps = new $collectionClassName;
        $this->collAnnouncementEmployeeMaps->setModel('\entities\AnnouncementEmployeeMap');
    }

    /**
     * Gets an array of ChildAnnouncementEmployeeMap objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAnnouncementEmployeeMap[] List of ChildAnnouncementEmployeeMap objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap> List of ChildAnnouncementEmployeeMap objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAnnouncementEmployeeMaps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAnnouncementEmployeeMapsPartial && !$this->isNew();
        if (null === $this->collAnnouncementEmployeeMaps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAnnouncementEmployeeMaps) {
                    $this->initAnnouncementEmployeeMaps();
                } else {
                    $collectionClassName = AnnouncementEmployeeMapTableMap::getTableMap()->getCollectionClassName();

                    $collAnnouncementEmployeeMaps = new $collectionClassName;
                    $collAnnouncementEmployeeMaps->setModel('\entities\AnnouncementEmployeeMap');

                    return $collAnnouncementEmployeeMaps;
                }
            } else {
                $collAnnouncementEmployeeMaps = ChildAnnouncementEmployeeMapQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAnnouncementEmployeeMapsPartial && count($collAnnouncementEmployeeMaps)) {
                        $this->initAnnouncementEmployeeMaps(false);

                        foreach ($collAnnouncementEmployeeMaps as $obj) {
                            if (false == $this->collAnnouncementEmployeeMaps->contains($obj)) {
                                $this->collAnnouncementEmployeeMaps->append($obj);
                            }
                        }

                        $this->collAnnouncementEmployeeMapsPartial = true;
                    }

                    return $collAnnouncementEmployeeMaps;
                }

                if ($partial && $this->collAnnouncementEmployeeMaps) {
                    foreach ($this->collAnnouncementEmployeeMaps as $obj) {
                        if ($obj->isNew()) {
                            $collAnnouncementEmployeeMaps[] = $obj;
                        }
                    }
                }

                $this->collAnnouncementEmployeeMaps = $collAnnouncementEmployeeMaps;
                $this->collAnnouncementEmployeeMapsPartial = false;
            }
        }

        return $this->collAnnouncementEmployeeMaps;
    }

    /**
     * Sets a collection of ChildAnnouncementEmployeeMap objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $announcementEmployeeMaps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAnnouncementEmployeeMaps(Collection $announcementEmployeeMaps, ?ConnectionInterface $con = null)
    {
        /** @var ChildAnnouncementEmployeeMap[] $announcementEmployeeMapsToDelete */
        $announcementEmployeeMapsToDelete = $this->getAnnouncementEmployeeMaps(new Criteria(), $con)->diff($announcementEmployeeMaps);


        $this->announcementEmployeeMapsScheduledForDeletion = $announcementEmployeeMapsToDelete;

        foreach ($announcementEmployeeMapsToDelete as $announcementEmployeeMapRemoved) {
            $announcementEmployeeMapRemoved->setEmployee(null);
        }

        $this->collAnnouncementEmployeeMaps = null;
        foreach ($announcementEmployeeMaps as $announcementEmployeeMap) {
            $this->addAnnouncementEmployeeMap($announcementEmployeeMap);
        }

        $this->collAnnouncementEmployeeMaps = $announcementEmployeeMaps;
        $this->collAnnouncementEmployeeMapsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AnnouncementEmployeeMap objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AnnouncementEmployeeMap objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAnnouncementEmployeeMaps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAnnouncementEmployeeMapsPartial && !$this->isNew();
        if (null === $this->collAnnouncementEmployeeMaps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAnnouncementEmployeeMaps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAnnouncementEmployeeMaps());
            }

            $query = ChildAnnouncementEmployeeMapQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collAnnouncementEmployeeMaps);
    }

    /**
     * Method called to associate a ChildAnnouncementEmployeeMap object to this object
     * through the ChildAnnouncementEmployeeMap foreign key attribute.
     *
     * @param ChildAnnouncementEmployeeMap $l ChildAnnouncementEmployeeMap
     * @return $this The current object (for fluent API support)
     */
    public function addAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $l)
    {
        if ($this->collAnnouncementEmployeeMaps === null) {
            $this->initAnnouncementEmployeeMaps();
            $this->collAnnouncementEmployeeMapsPartial = true;
        }

        if (!$this->collAnnouncementEmployeeMaps->contains($l)) {
            $this->doAddAnnouncementEmployeeMap($l);

            if ($this->announcementEmployeeMapsScheduledForDeletion and $this->announcementEmployeeMapsScheduledForDeletion->contains($l)) {
                $this->announcementEmployeeMapsScheduledForDeletion->remove($this->announcementEmployeeMapsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAnnouncementEmployeeMap $announcementEmployeeMap The ChildAnnouncementEmployeeMap object to add.
     */
    protected function doAddAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $announcementEmployeeMap): void
    {
        $this->collAnnouncementEmployeeMaps[]= $announcementEmployeeMap;
        $announcementEmployeeMap->setEmployee($this);
    }

    /**
     * @param ChildAnnouncementEmployeeMap $announcementEmployeeMap The ChildAnnouncementEmployeeMap object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAnnouncementEmployeeMap(ChildAnnouncementEmployeeMap $announcementEmployeeMap)
    {
        if ($this->getAnnouncementEmployeeMaps()->contains($announcementEmployeeMap)) {
            $pos = $this->collAnnouncementEmployeeMaps->search($announcementEmployeeMap);
            $this->collAnnouncementEmployeeMaps->remove($pos);
            if (null === $this->announcementEmployeeMapsScheduledForDeletion) {
                $this->announcementEmployeeMapsScheduledForDeletion = clone $this->collAnnouncementEmployeeMaps;
                $this->announcementEmployeeMapsScheduledForDeletion->clear();
            }
            $this->announcementEmployeeMapsScheduledForDeletion[]= $announcementEmployeeMap;
            $announcementEmployeeMap->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related AnnouncementEmployeeMaps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnnouncementEmployeeMap[] List of ChildAnnouncementEmployeeMap objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAnnouncementEmployeeMap}> List of ChildAnnouncementEmployeeMap objects
     */
    public function getAnnouncementEmployeeMapsJoinAnnouncements(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnnouncementEmployeeMapQuery::create(null, $criteria);
        $query->joinWith('Announcements', $joinBehavior);

        return $this->getAnnouncementEmployeeMaps($query, $con);
    }

    /**
     * Clears out the collAttendances collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAttendances()
     */
    public function clearAttendances()
    {
        $this->collAttendances = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAttendances collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAttendances($v = true): void
    {
        $this->collAttendancesPartial = $v;
    }

    /**
     * Initializes the collAttendances collection.
     *
     * By default this just sets the collAttendances collection to an empty array (like clearcollAttendances());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAttendances(bool $overrideExisting = true): void
    {
        if (null !== $this->collAttendances && !$overrideExisting) {
            return;
        }

        $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

        $this->collAttendances = new $collectionClassName;
        $this->collAttendances->setModel('\entities\Attendance');
    }

    /**
     * Gets an array of ChildAttendance objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance> List of ChildAttendance objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAttendances(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAttendances) {
                    $this->initAttendances();
                } else {
                    $collectionClassName = AttendanceTableMap::getTableMap()->getCollectionClassName();

                    $collAttendances = new $collectionClassName;
                    $collAttendances->setModel('\entities\Attendance');

                    return $collAttendances;
                }
            } else {
                $collAttendances = ChildAttendanceQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAttendancesPartial && count($collAttendances)) {
                        $this->initAttendances(false);

                        foreach ($collAttendances as $obj) {
                            if (false == $this->collAttendances->contains($obj)) {
                                $this->collAttendances->append($obj);
                            }
                        }

                        $this->collAttendancesPartial = true;
                    }

                    return $collAttendances;
                }

                if ($partial && $this->collAttendances) {
                    foreach ($this->collAttendances as $obj) {
                        if ($obj->isNew()) {
                            $collAttendances[] = $obj;
                        }
                    }
                }

                $this->collAttendances = $collAttendances;
                $this->collAttendancesPartial = false;
            }
        }

        return $this->collAttendances;
    }

    /**
     * Sets a collection of ChildAttendance objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $attendances A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAttendances(Collection $attendances, ?ConnectionInterface $con = null)
    {
        /** @var ChildAttendance[] $attendancesToDelete */
        $attendancesToDelete = $this->getAttendances(new Criteria(), $con)->diff($attendances);


        $this->attendancesScheduledForDeletion = $attendancesToDelete;

        foreach ($attendancesToDelete as $attendanceRemoved) {
            $attendanceRemoved->setEmployee(null);
        }

        $this->collAttendances = null;
        foreach ($attendances as $attendance) {
            $this->addAttendance($attendance);
        }

        $this->collAttendances = $attendances;
        $this->collAttendancesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Attendance objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Attendance objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAttendances(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAttendancesPartial && !$this->isNew();
        if (null === $this->collAttendances || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAttendances) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAttendances());
            }

            $query = ChildAttendanceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collAttendances);
    }

    /**
     * Method called to associate a ChildAttendance object to this object
     * through the ChildAttendance foreign key attribute.
     *
     * @param ChildAttendance $l ChildAttendance
     * @return $this The current object (for fluent API support)
     */
    public function addAttendance(ChildAttendance $l)
    {
        if ($this->collAttendances === null) {
            $this->initAttendances();
            $this->collAttendancesPartial = true;
        }

        if (!$this->collAttendances->contains($l)) {
            $this->doAddAttendance($l);

            if ($this->attendancesScheduledForDeletion and $this->attendancesScheduledForDeletion->contains($l)) {
                $this->attendancesScheduledForDeletion->remove($this->attendancesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAttendance $attendance The ChildAttendance object to add.
     */
    protected function doAddAttendance(ChildAttendance $attendance): void
    {
        $this->collAttendances[]= $attendance;
        $attendance->setEmployee($this);
    }

    /**
     * @param ChildAttendance $attendance The ChildAttendance object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAttendance(ChildAttendance $attendance)
    {
        if ($this->getAttendances()->contains($attendance)) {
            $pos = $this->collAttendances->search($attendance);
            $this->collAttendances->remove($pos);
            if (null === $this->attendancesScheduledForDeletion) {
                $this->attendancesScheduledForDeletion = clone $this->collAttendances;
                $this->attendancesScheduledForDeletion->clear();
            }
            $this->attendancesScheduledForDeletion[]= clone $attendance;
            $attendance->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinGeoTownsRelatedByEndItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByEndItownid', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinExpenses(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Expenses', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinGeoTownsRelatedByStartItownid(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('GeoTownsRelatedByStartItownid', $joinBehavior);

        return $this->getAttendances($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Attendances from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAttendance[] List of ChildAttendance objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAttendance}> List of ChildAttendance objects
     */
    public function getAttendancesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAttendanceQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAttendances($query, $con);
    }

    /**
     * Clears out the collAuditEmpUnitss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAuditEmpUnitss()
     */
    public function clearAuditEmpUnitss()
    {
        $this->collAuditEmpUnitss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAuditEmpUnitss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAuditEmpUnitss($v = true): void
    {
        $this->collAuditEmpUnitssPartial = $v;
    }

    /**
     * Initializes the collAuditEmpUnitss collection.
     *
     * By default this just sets the collAuditEmpUnitss collection to an empty array (like clearcollAuditEmpUnitss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuditEmpUnitss(bool $overrideExisting = true): void
    {
        if (null !== $this->collAuditEmpUnitss && !$overrideExisting) {
            return;
        }

        $collectionClassName = AuditEmpUnitsTableMap::getTableMap()->getCollectionClassName();

        $this->collAuditEmpUnitss = new $collectionClassName;
        $this->collAuditEmpUnitss->setModel('\entities\AuditEmpUnits');
    }

    /**
     * Gets an array of ChildAuditEmpUnits objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAuditEmpUnits[] List of ChildAuditEmpUnits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAuditEmpUnits> List of ChildAuditEmpUnits objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAuditEmpUnitss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAuditEmpUnitssPartial && !$this->isNew();
        if (null === $this->collAuditEmpUnitss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAuditEmpUnitss) {
                    $this->initAuditEmpUnitss();
                } else {
                    $collectionClassName = AuditEmpUnitsTableMap::getTableMap()->getCollectionClassName();

                    $collAuditEmpUnitss = new $collectionClassName;
                    $collAuditEmpUnitss->setModel('\entities\AuditEmpUnits');

                    return $collAuditEmpUnitss;
                }
            } else {
                $collAuditEmpUnitss = ChildAuditEmpUnitsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAuditEmpUnitssPartial && count($collAuditEmpUnitss)) {
                        $this->initAuditEmpUnitss(false);

                        foreach ($collAuditEmpUnitss as $obj) {
                            if (false == $this->collAuditEmpUnitss->contains($obj)) {
                                $this->collAuditEmpUnitss->append($obj);
                            }
                        }

                        $this->collAuditEmpUnitssPartial = true;
                    }

                    return $collAuditEmpUnitss;
                }

                if ($partial && $this->collAuditEmpUnitss) {
                    foreach ($this->collAuditEmpUnitss as $obj) {
                        if ($obj->isNew()) {
                            $collAuditEmpUnitss[] = $obj;
                        }
                    }
                }

                $this->collAuditEmpUnitss = $collAuditEmpUnitss;
                $this->collAuditEmpUnitssPartial = false;
            }
        }

        return $this->collAuditEmpUnitss;
    }

    /**
     * Sets a collection of ChildAuditEmpUnits objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $auditEmpUnitss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAuditEmpUnitss(Collection $auditEmpUnitss, ?ConnectionInterface $con = null)
    {
        /** @var ChildAuditEmpUnits[] $auditEmpUnitssToDelete */
        $auditEmpUnitssToDelete = $this->getAuditEmpUnitss(new Criteria(), $con)->diff($auditEmpUnitss);


        $this->auditEmpUnitssScheduledForDeletion = $auditEmpUnitssToDelete;

        foreach ($auditEmpUnitssToDelete as $auditEmpUnitsRemoved) {
            $auditEmpUnitsRemoved->setEmployee(null);
        }

        $this->collAuditEmpUnitss = null;
        foreach ($auditEmpUnitss as $auditEmpUnits) {
            $this->addAuditEmpUnits($auditEmpUnits);
        }

        $this->collAuditEmpUnitss = $auditEmpUnitss;
        $this->collAuditEmpUnitssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuditEmpUnits objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AuditEmpUnits objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAuditEmpUnitss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAuditEmpUnitssPartial && !$this->isNew();
        if (null === $this->collAuditEmpUnitss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuditEmpUnitss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuditEmpUnitss());
            }

            $query = ChildAuditEmpUnitsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collAuditEmpUnitss);
    }

    /**
     * Method called to associate a ChildAuditEmpUnits object to this object
     * through the ChildAuditEmpUnits foreign key attribute.
     *
     * @param ChildAuditEmpUnits $l ChildAuditEmpUnits
     * @return $this The current object (for fluent API support)
     */
    public function addAuditEmpUnits(ChildAuditEmpUnits $l)
    {
        if ($this->collAuditEmpUnitss === null) {
            $this->initAuditEmpUnitss();
            $this->collAuditEmpUnitssPartial = true;
        }

        if (!$this->collAuditEmpUnitss->contains($l)) {
            $this->doAddAuditEmpUnits($l);

            if ($this->auditEmpUnitssScheduledForDeletion and $this->auditEmpUnitssScheduledForDeletion->contains($l)) {
                $this->auditEmpUnitssScheduledForDeletion->remove($this->auditEmpUnitssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAuditEmpUnits $auditEmpUnits The ChildAuditEmpUnits object to add.
     */
    protected function doAddAuditEmpUnits(ChildAuditEmpUnits $auditEmpUnits): void
    {
        $this->collAuditEmpUnitss[]= $auditEmpUnits;
        $auditEmpUnits->setEmployee($this);
    }

    /**
     * @param ChildAuditEmpUnits $auditEmpUnits The ChildAuditEmpUnits object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAuditEmpUnits(ChildAuditEmpUnits $auditEmpUnits)
    {
        if ($this->getAuditEmpUnitss()->contains($auditEmpUnits)) {
            $pos = $this->collAuditEmpUnitss->search($auditEmpUnits);
            $this->collAuditEmpUnitss->remove($pos);
            if (null === $this->auditEmpUnitssScheduledForDeletion) {
                $this->auditEmpUnitssScheduledForDeletion = clone $this->collAuditEmpUnitss;
                $this->auditEmpUnitssScheduledForDeletion->clear();
            }
            $this->auditEmpUnitssScheduledForDeletion[]= clone $auditEmpUnits;
            $auditEmpUnits->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related AuditEmpUnitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAuditEmpUnits[] List of ChildAuditEmpUnits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAuditEmpUnits}> List of ChildAuditEmpUnits objects
     */
    public function getAuditEmpUnitssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAuditEmpUnitsQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getAuditEmpUnitss($query, $con);
    }

    /**
     * Clears out the collBrandRcpas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandRcpas()
     */
    public function clearBrandRcpas()
    {
        $this->collBrandRcpas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandRcpas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandRcpas($v = true): void
    {
        $this->collBrandRcpasPartial = $v;
    }

    /**
     * Initializes the collBrandRcpas collection.
     *
     * By default this just sets the collBrandRcpas collection to an empty array (like clearcollBrandRcpas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandRcpas(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandRcpas && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandRcpas = new $collectionClassName;
        $this->collBrandRcpas->setModel('\entities\BrandRcpa');
    }

    /**
     * Gets an array of ChildBrandRcpa objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa> List of ChildBrandRcpa objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandRcpas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandRcpas) {
                    $this->initBrandRcpas();
                } else {
                    $collectionClassName = BrandRcpaTableMap::getTableMap()->getCollectionClassName();

                    $collBrandRcpas = new $collectionClassName;
                    $collBrandRcpas->setModel('\entities\BrandRcpa');

                    return $collBrandRcpas;
                }
            } else {
                $collBrandRcpas = ChildBrandRcpaQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandRcpasPartial && count($collBrandRcpas)) {
                        $this->initBrandRcpas(false);

                        foreach ($collBrandRcpas as $obj) {
                            if (false == $this->collBrandRcpas->contains($obj)) {
                                $this->collBrandRcpas->append($obj);
                            }
                        }

                        $this->collBrandRcpasPartial = true;
                    }

                    return $collBrandRcpas;
                }

                if ($partial && $this->collBrandRcpas) {
                    foreach ($this->collBrandRcpas as $obj) {
                        if ($obj->isNew()) {
                            $collBrandRcpas[] = $obj;
                        }
                    }
                }

                $this->collBrandRcpas = $collBrandRcpas;
                $this->collBrandRcpasPartial = false;
            }
        }

        return $this->collBrandRcpas;
    }

    /**
     * Sets a collection of ChildBrandRcpa objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandRcpas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandRcpas(Collection $brandRcpas, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandRcpa[] $brandRcpasToDelete */
        $brandRcpasToDelete = $this->getBrandRcpas(new Criteria(), $con)->diff($brandRcpas);


        $this->brandRcpasScheduledForDeletion = $brandRcpasToDelete;

        foreach ($brandRcpasToDelete as $brandRcpaRemoved) {
            $brandRcpaRemoved->setEmployee(null);
        }

        $this->collBrandRcpas = null;
        foreach ($brandRcpas as $brandRcpa) {
            $this->addBrandRcpa($brandRcpa);
        }

        $this->collBrandRcpas = $brandRcpas;
        $this->collBrandRcpasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandRcpa objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandRcpa objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandRcpas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandRcpasPartial && !$this->isNew();
        if (null === $this->collBrandRcpas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandRcpas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandRcpas());
            }

            $query = ChildBrandRcpaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collBrandRcpas);
    }

    /**
     * Method called to associate a ChildBrandRcpa object to this object
     * through the ChildBrandRcpa foreign key attribute.
     *
     * @param ChildBrandRcpa $l ChildBrandRcpa
     * @return $this The current object (for fluent API support)
     */
    public function addBrandRcpa(ChildBrandRcpa $l)
    {
        if ($this->collBrandRcpas === null) {
            $this->initBrandRcpas();
            $this->collBrandRcpasPartial = true;
        }

        if (!$this->collBrandRcpas->contains($l)) {
            $this->doAddBrandRcpa($l);

            if ($this->brandRcpasScheduledForDeletion and $this->brandRcpasScheduledForDeletion->contains($l)) {
                $this->brandRcpasScheduledForDeletion->remove($this->brandRcpasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to add.
     */
    protected function doAddBrandRcpa(ChildBrandRcpa $brandRcpa): void
    {
        $this->collBrandRcpas[]= $brandRcpa;
        $brandRcpa->setEmployee($this);
    }

    /**
     * @param ChildBrandRcpa $brandRcpa The ChildBrandRcpa object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandRcpa(ChildBrandRcpa $brandRcpa)
    {
        if ($this->getBrandRcpas()->contains($brandRcpa)) {
            $pos = $this->collBrandRcpas->search($brandRcpa);
            $this->collBrandRcpas->remove($pos);
            if (null === $this->brandRcpasScheduledForDeletion) {
                $this->brandRcpasScheduledForDeletion = clone $this->collBrandRcpas;
                $this->brandRcpasScheduledForDeletion->clear();
            }
            $this->brandRcpasScheduledForDeletion[]= $brandRcpa;
            $brandRcpa->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related BrandRcpas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandRcpa[] List of ChildBrandRcpa objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandRcpa}> List of ChildBrandRcpa objects
     */
    public function getBrandRcpasJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandRcpaQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandRcpas($query, $con);
    }

    /**
     * Clears out the collCompetitionMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCompetitionMappings()
     */
    public function clearCompetitionMappings()
    {
        $this->collCompetitionMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCompetitionMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCompetitionMappings($v = true): void
    {
        $this->collCompetitionMappingsPartial = $v;
    }

    /**
     * Initializes the collCompetitionMappings collection.
     *
     * By default this just sets the collCompetitionMappings collection to an empty array (like clearcollCompetitionMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCompetitionMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collCompetitionMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = CompetitionMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collCompetitionMappings = new $collectionClassName;
        $this->collCompetitionMappings->setModel('\entities\CompetitionMapping');
    }

    /**
     * Gets an array of ChildCompetitionMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping> List of ChildCompetitionMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompetitionMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCompetitionMappingsPartial && !$this->isNew();
        if (null === $this->collCompetitionMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCompetitionMappings) {
                    $this->initCompetitionMappings();
                } else {
                    $collectionClassName = CompetitionMappingTableMap::getTableMap()->getCollectionClassName();

                    $collCompetitionMappings = new $collectionClassName;
                    $collCompetitionMappings->setModel('\entities\CompetitionMapping');

                    return $collCompetitionMappings;
                }
            } else {
                $collCompetitionMappings = ChildCompetitionMappingQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCompetitionMappingsPartial && count($collCompetitionMappings)) {
                        $this->initCompetitionMappings(false);

                        foreach ($collCompetitionMappings as $obj) {
                            if (false == $this->collCompetitionMappings->contains($obj)) {
                                $this->collCompetitionMappings->append($obj);
                            }
                        }

                        $this->collCompetitionMappingsPartial = true;
                    }

                    return $collCompetitionMappings;
                }

                if ($partial && $this->collCompetitionMappings) {
                    foreach ($this->collCompetitionMappings as $obj) {
                        if ($obj->isNew()) {
                            $collCompetitionMappings[] = $obj;
                        }
                    }
                }

                $this->collCompetitionMappings = $collCompetitionMappings;
                $this->collCompetitionMappingsPartial = false;
            }
        }

        return $this->collCompetitionMappings;
    }

    /**
     * Sets a collection of ChildCompetitionMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $competitionMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCompetitionMappings(Collection $competitionMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildCompetitionMapping[] $competitionMappingsToDelete */
        $competitionMappingsToDelete = $this->getCompetitionMappings(new Criteria(), $con)->diff($competitionMappings);


        $this->competitionMappingsScheduledForDeletion = $competitionMappingsToDelete;

        foreach ($competitionMappingsToDelete as $competitionMappingRemoved) {
            $competitionMappingRemoved->setEmployee(null);
        }

        $this->collCompetitionMappings = null;
        foreach ($competitionMappings as $competitionMapping) {
            $this->addCompetitionMapping($competitionMapping);
        }

        $this->collCompetitionMappings = $competitionMappings;
        $this->collCompetitionMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CompetitionMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related CompetitionMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCompetitionMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCompetitionMappingsPartial && !$this->isNew();
        if (null === $this->collCompetitionMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCompetitionMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCompetitionMappings());
            }

            $query = ChildCompetitionMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collCompetitionMappings);
    }

    /**
     * Method called to associate a ChildCompetitionMapping object to this object
     * through the ChildCompetitionMapping foreign key attribute.
     *
     * @param ChildCompetitionMapping $l ChildCompetitionMapping
     * @return $this The current object (for fluent API support)
     */
    public function addCompetitionMapping(ChildCompetitionMapping $l)
    {
        if ($this->collCompetitionMappings === null) {
            $this->initCompetitionMappings();
            $this->collCompetitionMappingsPartial = true;
        }

        if (!$this->collCompetitionMappings->contains($l)) {
            $this->doAddCompetitionMapping($l);

            if ($this->competitionMappingsScheduledForDeletion and $this->competitionMappingsScheduledForDeletion->contains($l)) {
                $this->competitionMappingsScheduledForDeletion->remove($this->competitionMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCompetitionMapping $competitionMapping The ChildCompetitionMapping object to add.
     */
    protected function doAddCompetitionMapping(ChildCompetitionMapping $competitionMapping): void
    {
        $this->collCompetitionMappings[]= $competitionMapping;
        $competitionMapping->setEmployee($this);
    }

    /**
     * @param ChildCompetitionMapping $competitionMapping The ChildCompetitionMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCompetitionMapping(ChildCompetitionMapping $competitionMapping)
    {
        if ($this->getCompetitionMappings()->contains($competitionMapping)) {
            $pos = $this->collCompetitionMappings->search($competitionMapping);
            $this->collCompetitionMappings->remove($pos);
            if (null === $this->competitionMappingsScheduledForDeletion) {
                $this->competitionMappingsScheduledForDeletion = clone $this->collCompetitionMappings;
                $this->competitionMappingsScheduledForDeletion->clear();
            }
            $this->competitionMappingsScheduledForDeletion[]= clone $competitionMapping;
            $competitionMapping->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinCompetitor(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Competitor', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related CompetitionMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCompetitionMapping[] List of ChildCompetitionMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCompetitionMapping}> List of ChildCompetitionMapping objects
     */
    public function getCompetitionMappingsJoinUnitmaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCompetitionMappingQuery::create(null, $criteria);
        $query->joinWith('Unitmaster', $joinBehavior);

        return $this->getCompetitionMappings($query, $con);
    }

    /**
     * Clears out the collDailycallsSgpiouts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallsSgpiouts()
     */
    public function clearDailycallsSgpiouts()
    {
        $this->collDailycallsSgpiouts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallsSgpiouts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallsSgpiouts($v = true): void
    {
        $this->collDailycallsSgpioutsPartial = $v;
    }

    /**
     * Initializes the collDailycallsSgpiouts collection.
     *
     * By default this just sets the collDailycallsSgpiouts collection to an empty array (like clearcollDailycallsSgpiouts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallsSgpiouts(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallsSgpiouts && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallsSgpiouts = new $collectionClassName;
        $this->collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');
    }

    /**
     * Gets an array of ChildDailycallsSgpiout objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout> List of ChildDailycallsSgpiout objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallsSgpiouts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallsSgpiouts) {
                    $this->initDailycallsSgpiouts();
                } else {
                    $collectionClassName = DailycallsSgpioutTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallsSgpiouts = new $collectionClassName;
                    $collDailycallsSgpiouts->setModel('\entities\DailycallsSgpiout');

                    return $collDailycallsSgpiouts;
                }
            } else {
                $collDailycallsSgpiouts = ChildDailycallsSgpioutQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallsSgpioutsPartial && count($collDailycallsSgpiouts)) {
                        $this->initDailycallsSgpiouts(false);

                        foreach ($collDailycallsSgpiouts as $obj) {
                            if (false == $this->collDailycallsSgpiouts->contains($obj)) {
                                $this->collDailycallsSgpiouts->append($obj);
                            }
                        }

                        $this->collDailycallsSgpioutsPartial = true;
                    }

                    return $collDailycallsSgpiouts;
                }

                if ($partial && $this->collDailycallsSgpiouts) {
                    foreach ($this->collDailycallsSgpiouts as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallsSgpiouts[] = $obj;
                        }
                    }
                }

                $this->collDailycallsSgpiouts = $collDailycallsSgpiouts;
                $this->collDailycallsSgpioutsPartial = false;
            }
        }

        return $this->collDailycallsSgpiouts;
    }

    /**
     * Sets a collection of ChildDailycallsSgpiout objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallsSgpiouts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallsSgpiouts(Collection $dailycallsSgpiouts, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycallsSgpiout[] $dailycallsSgpioutsToDelete */
        $dailycallsSgpioutsToDelete = $this->getDailycallsSgpiouts(new Criteria(), $con)->diff($dailycallsSgpiouts);


        $this->dailycallsSgpioutsScheduledForDeletion = $dailycallsSgpioutsToDelete;

        foreach ($dailycallsSgpioutsToDelete as $dailycallsSgpioutRemoved) {
            $dailycallsSgpioutRemoved->setEmployee(null);
        }

        $this->collDailycallsSgpiouts = null;
        foreach ($dailycallsSgpiouts as $dailycallsSgpiout) {
            $this->addDailycallsSgpiout($dailycallsSgpiout);
        }

        $this->collDailycallsSgpiouts = $dailycallsSgpiouts;
        $this->collDailycallsSgpioutsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DailycallsSgpiout objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DailycallsSgpiout objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallsSgpiouts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallsSgpioutsPartial && !$this->isNew();
        if (null === $this->collDailycallsSgpiouts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallsSgpiouts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallsSgpiouts());
            }

            $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collDailycallsSgpiouts);
    }

    /**
     * Method called to associate a ChildDailycallsSgpiout object to this object
     * through the ChildDailycallsSgpiout foreign key attribute.
     *
     * @param ChildDailycallsSgpiout $l ChildDailycallsSgpiout
     * @return $this The current object (for fluent API support)
     */
    public function addDailycallsSgpiout(ChildDailycallsSgpiout $l)
    {
        if ($this->collDailycallsSgpiouts === null) {
            $this->initDailycallsSgpiouts();
            $this->collDailycallsSgpioutsPartial = true;
        }

        if (!$this->collDailycallsSgpiouts->contains($l)) {
            $this->doAddDailycallsSgpiout($l);

            if ($this->dailycallsSgpioutsScheduledForDeletion and $this->dailycallsSgpioutsScheduledForDeletion->contains($l)) {
                $this->dailycallsSgpioutsScheduledForDeletion->remove($this->dailycallsSgpioutsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to add.
     */
    protected function doAddDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout): void
    {
        $this->collDailycallsSgpiouts[]= $dailycallsSgpiout;
        $dailycallsSgpiout->setEmployee($this);
    }

    /**
     * @param ChildDailycallsSgpiout $dailycallsSgpiout The ChildDailycallsSgpiout object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycallsSgpiout(ChildDailycallsSgpiout $dailycallsSgpiout)
    {
        if ($this->getDailycallsSgpiouts()->contains($dailycallsSgpiout)) {
            $pos = $this->collDailycallsSgpiouts->search($dailycallsSgpiout);
            $this->collDailycallsSgpiouts->remove($pos);
            if (null === $this->dailycallsSgpioutsScheduledForDeletion) {
                $this->dailycallsSgpioutsScheduledForDeletion = clone $this->collDailycallsSgpiouts;
                $this->dailycallsSgpioutsScheduledForDeletion->clear();
            }
            $this->dailycallsSgpioutsScheduledForDeletion[]= $dailycallsSgpiout;
            $dailycallsSgpiout->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinSgpiMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('SgpiMaster', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related DailycallsSgpiouts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsSgpiout[] List of ChildDailycallsSgpiout objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsSgpiout}> List of ChildDailycallsSgpiout objects
     */
    public function getDailycallsSgpioutsJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsSgpioutQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallsSgpiouts($query, $con);
    }

    /**
     * Clears out the collEdSessions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdSessions()
     */
    public function clearEdSessions()
    {
        $this->collEdSessions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdSessions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdSessions($v = true): void
    {
        $this->collEdSessionsPartial = $v;
    }

    /**
     * Initializes the collEdSessions collection.
     *
     * By default this just sets the collEdSessions collection to an empty array (like clearcollEdSessions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdSessions(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdSessions && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdSessionTableMap::getTableMap()->getCollectionClassName();

        $this->collEdSessions = new $collectionClassName;
        $this->collEdSessions->setModel('\entities\EdSession');
    }

    /**
     * Gets an array of ChildEdSession objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession> List of ChildEdSession objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdSessions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdSessionsPartial && !$this->isNew();
        if (null === $this->collEdSessions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdSessions) {
                    $this->initEdSessions();
                } else {
                    $collectionClassName = EdSessionTableMap::getTableMap()->getCollectionClassName();

                    $collEdSessions = new $collectionClassName;
                    $collEdSessions->setModel('\entities\EdSession');

                    return $collEdSessions;
                }
            } else {
                $collEdSessions = ChildEdSessionQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdSessionsPartial && count($collEdSessions)) {
                        $this->initEdSessions(false);

                        foreach ($collEdSessions as $obj) {
                            if (false == $this->collEdSessions->contains($obj)) {
                                $this->collEdSessions->append($obj);
                            }
                        }

                        $this->collEdSessionsPartial = true;
                    }

                    return $collEdSessions;
                }

                if ($partial && $this->collEdSessions) {
                    foreach ($this->collEdSessions as $obj) {
                        if ($obj->isNew()) {
                            $collEdSessions[] = $obj;
                        }
                    }
                }

                $this->collEdSessions = $collEdSessions;
                $this->collEdSessionsPartial = false;
            }
        }

        return $this->collEdSessions;
    }

    /**
     * Sets a collection of ChildEdSession objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edSessions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdSessions(Collection $edSessions, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdSession[] $edSessionsToDelete */
        $edSessionsToDelete = $this->getEdSessions(new Criteria(), $con)->diff($edSessions);


        $this->edSessionsScheduledForDeletion = $edSessionsToDelete;

        foreach ($edSessionsToDelete as $edSessionRemoved) {
            $edSessionRemoved->setEmployee(null);
        }

        $this->collEdSessions = null;
        foreach ($edSessions as $edSession) {
            $this->addEdSession($edSession);
        }

        $this->collEdSessions = $edSessions;
        $this->collEdSessionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdSession objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdSession objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdSessions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdSessionsPartial && !$this->isNew();
        if (null === $this->collEdSessions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdSessions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdSessions());
            }

            $query = ChildEdSessionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEdSessions);
    }

    /**
     * Method called to associate a ChildEdSession object to this object
     * through the ChildEdSession foreign key attribute.
     *
     * @param ChildEdSession $l ChildEdSession
     * @return $this The current object (for fluent API support)
     */
    public function addEdSession(ChildEdSession $l)
    {
        if ($this->collEdSessions === null) {
            $this->initEdSessions();
            $this->collEdSessionsPartial = true;
        }

        if (!$this->collEdSessions->contains($l)) {
            $this->doAddEdSession($l);

            if ($this->edSessionsScheduledForDeletion and $this->edSessionsScheduledForDeletion->contains($l)) {
                $this->edSessionsScheduledForDeletion->remove($this->edSessionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdSession $edSession The ChildEdSession object to add.
     */
    protected function doAddEdSession(ChildEdSession $edSession): void
    {
        $this->collEdSessions[]= $edSession;
        $edSession->setEmployee($this);
    }

    /**
     * @param ChildEdSession $edSession The ChildEdSession object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdSession(ChildEdSession $edSession)
    {
        if ($this->getEdSessions()->contains($edSession)) {
            $pos = $this->collEdSessions->search($edSession);
            $this->collEdSessions->remove($pos);
            if (null === $this->edSessionsScheduledForDeletion) {
                $this->edSessionsScheduledForDeletion = clone $this->collEdSessions;
                $this->edSessionsScheduledForDeletion->clear();
            }
            $this->edSessionsScheduledForDeletion[]= $edSession;
            $edSession->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EdSessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession}> List of ChildEdSession objects
     */
    public function getEdSessionsJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdSessionQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getEdSessions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EdSessions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdSession[] List of ChildEdSession objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdSession}> List of ChildEdSession objects
     */
    public function getEdSessionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdSessionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdSessions($query, $con);
    }

    /**
     * Clears out the collEmployeeIncentives collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeeIncentives()
     */
    public function clearEmployeeIncentives()
    {
        $this->collEmployeeIncentives = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeeIncentives collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeeIncentives($v = true): void
    {
        $this->collEmployeeIncentivesPartial = $v;
    }

    /**
     * Initializes the collEmployeeIncentives collection.
     *
     * By default this just sets the collEmployeeIncentives collection to an empty array (like clearcollEmployeeIncentives());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeIncentives(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeeIncentives && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeIncentiveTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeIncentives = new $collectionClassName;
        $this->collEmployeeIncentives->setModel('\entities\EmployeeIncentive');
    }

    /**
     * Gets an array of ChildEmployeeIncentive objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeeIncentive[] List of ChildEmployeeIncentive objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeeIncentive> List of ChildEmployeeIncentive objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeIncentives(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeIncentivesPartial && !$this->isNew();
        if (null === $this->collEmployeeIncentives || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeeIncentives) {
                    $this->initEmployeeIncentives();
                } else {
                    $collectionClassName = EmployeeIncentiveTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeeIncentives = new $collectionClassName;
                    $collEmployeeIncentives->setModel('\entities\EmployeeIncentive');

                    return $collEmployeeIncentives;
                }
            } else {
                $collEmployeeIncentives = ChildEmployeeIncentiveQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeIncentivesPartial && count($collEmployeeIncentives)) {
                        $this->initEmployeeIncentives(false);

                        foreach ($collEmployeeIncentives as $obj) {
                            if (false == $this->collEmployeeIncentives->contains($obj)) {
                                $this->collEmployeeIncentives->append($obj);
                            }
                        }

                        $this->collEmployeeIncentivesPartial = true;
                    }

                    return $collEmployeeIncentives;
                }

                if ($partial && $this->collEmployeeIncentives) {
                    foreach ($this->collEmployeeIncentives as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeIncentives[] = $obj;
                        }
                    }
                }

                $this->collEmployeeIncentives = $collEmployeeIncentives;
                $this->collEmployeeIncentivesPartial = false;
            }
        }

        return $this->collEmployeeIncentives;
    }

    /**
     * Sets a collection of ChildEmployeeIncentive objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeeIncentives A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeIncentives(Collection $employeeIncentives, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeIncentive[] $employeeIncentivesToDelete */
        $employeeIncentivesToDelete = $this->getEmployeeIncentives(new Criteria(), $con)->diff($employeeIncentives);


        $this->employeeIncentivesScheduledForDeletion = $employeeIncentivesToDelete;

        foreach ($employeeIncentivesToDelete as $employeeIncentiveRemoved) {
            $employeeIncentiveRemoved->setEmployee(null);
        }

        $this->collEmployeeIncentives = null;
        foreach ($employeeIncentives as $employeeIncentive) {
            $this->addEmployeeIncentive($employeeIncentive);
        }

        $this->collEmployeeIncentives = $employeeIncentives;
        $this->collEmployeeIncentivesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EmployeeIncentive objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EmployeeIncentive objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployeeIncentives(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeeIncentivesPartial && !$this->isNew();
        if (null === $this->collEmployeeIncentives || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeIncentives) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeIncentives());
            }

            $query = ChildEmployeeIncentiveQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeeIncentives);
    }

    /**
     * Method called to associate a ChildEmployeeIncentive object to this object
     * through the ChildEmployeeIncentive foreign key attribute.
     *
     * @param ChildEmployeeIncentive $l ChildEmployeeIncentive
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeeIncentive(ChildEmployeeIncentive $l)
    {
        if ($this->collEmployeeIncentives === null) {
            $this->initEmployeeIncentives();
            $this->collEmployeeIncentivesPartial = true;
        }

        if (!$this->collEmployeeIncentives->contains($l)) {
            $this->doAddEmployeeIncentive($l);

            if ($this->employeeIncentivesScheduledForDeletion and $this->employeeIncentivesScheduledForDeletion->contains($l)) {
                $this->employeeIncentivesScheduledForDeletion->remove($this->employeeIncentivesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeeIncentive $employeeIncentive The ChildEmployeeIncentive object to add.
     */
    protected function doAddEmployeeIncentive(ChildEmployeeIncentive $employeeIncentive): void
    {
        $this->collEmployeeIncentives[]= $employeeIncentive;
        $employeeIncentive->setEmployee($this);
    }

    /**
     * @param ChildEmployeeIncentive $employeeIncentive The ChildEmployeeIncentive object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeeIncentive(ChildEmployeeIncentive $employeeIncentive)
    {
        if ($this->getEmployeeIncentives()->contains($employeeIncentive)) {
            $pos = $this->collEmployeeIncentives->search($employeeIncentive);
            $this->collEmployeeIncentives->remove($pos);
            if (null === $this->employeeIncentivesScheduledForDeletion) {
                $this->employeeIncentivesScheduledForDeletion = clone $this->collEmployeeIncentives;
                $this->employeeIncentivesScheduledForDeletion->clear();
            }
            $this->employeeIncentivesScheduledForDeletion[]= clone $employeeIncentive;
            $employeeIncentive->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EmployeeIncentives from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeeIncentive[] List of ChildEmployeeIncentive objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeeIncentive}> List of ChildEmployeeIncentive objects
     */
    public function getEmployeeIncentivesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeeIncentiveQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEmployeeIncentives($query, $con);
    }

    /**
     * Clears out the collEmployeePositionHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeePositionHistories()
     */
    public function clearEmployeePositionHistories()
    {
        $this->collEmployeePositionHistories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeePositionHistories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeePositionHistories($v = true): void
    {
        $this->collEmployeePositionHistoriesPartial = $v;
    }

    /**
     * Initializes the collEmployeePositionHistories collection.
     *
     * By default this just sets the collEmployeePositionHistories collection to an empty array (like clearcollEmployeePositionHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeePositionHistories(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeePositionHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeePositionHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeePositionHistories = new $collectionClassName;
        $this->collEmployeePositionHistories->setModel('\entities\EmployeePositionHistory');
    }

    /**
     * Gets an array of ChildEmployeePositionHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeePositionHistory[] List of ChildEmployeePositionHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeePositionHistory> List of ChildEmployeePositionHistory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeePositionHistories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeePositionHistoriesPartial && !$this->isNew();
        if (null === $this->collEmployeePositionHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeePositionHistories) {
                    $this->initEmployeePositionHistories();
                } else {
                    $collectionClassName = EmployeePositionHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeePositionHistories = new $collectionClassName;
                    $collEmployeePositionHistories->setModel('\entities\EmployeePositionHistory');

                    return $collEmployeePositionHistories;
                }
            } else {
                $collEmployeePositionHistories = ChildEmployeePositionHistoryQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeePositionHistoriesPartial && count($collEmployeePositionHistories)) {
                        $this->initEmployeePositionHistories(false);

                        foreach ($collEmployeePositionHistories as $obj) {
                            if (false == $this->collEmployeePositionHistories->contains($obj)) {
                                $this->collEmployeePositionHistories->append($obj);
                            }
                        }

                        $this->collEmployeePositionHistoriesPartial = true;
                    }

                    return $collEmployeePositionHistories;
                }

                if ($partial && $this->collEmployeePositionHistories) {
                    foreach ($this->collEmployeePositionHistories as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeePositionHistories[] = $obj;
                        }
                    }
                }

                $this->collEmployeePositionHistories = $collEmployeePositionHistories;
                $this->collEmployeePositionHistoriesPartial = false;
            }
        }

        return $this->collEmployeePositionHistories;
    }

    /**
     * Sets a collection of ChildEmployeePositionHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeePositionHistories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionHistories(Collection $employeePositionHistories, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployeePositionHistory[] $employeePositionHistoriesToDelete */
        $employeePositionHistoriesToDelete = $this->getEmployeePositionHistories(new Criteria(), $con)->diff($employeePositionHistories);


        $this->employeePositionHistoriesScheduledForDeletion = $employeePositionHistoriesToDelete;

        foreach ($employeePositionHistoriesToDelete as $employeePositionHistoryRemoved) {
            $employeePositionHistoryRemoved->setEmployee(null);
        }

        $this->collEmployeePositionHistories = null;
        foreach ($employeePositionHistories as $employeePositionHistory) {
            $this->addEmployeePositionHistory($employeePositionHistory);
        }

        $this->collEmployeePositionHistories = $employeePositionHistories;
        $this->collEmployeePositionHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EmployeePositionHistory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EmployeePositionHistory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployeePositionHistories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeePositionHistoriesPartial && !$this->isNew();
        if (null === $this->collEmployeePositionHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeePositionHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeePositionHistories());
            }

            $query = ChildEmployeePositionHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collEmployeePositionHistories);
    }

    /**
     * Method called to associate a ChildEmployeePositionHistory object to this object
     * through the ChildEmployeePositionHistory foreign key attribute.
     *
     * @param ChildEmployeePositionHistory $l ChildEmployeePositionHistory
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeePositionHistory(ChildEmployeePositionHistory $l)
    {
        if ($this->collEmployeePositionHistories === null) {
            $this->initEmployeePositionHistories();
            $this->collEmployeePositionHistoriesPartial = true;
        }

        if (!$this->collEmployeePositionHistories->contains($l)) {
            $this->doAddEmployeePositionHistory($l);

            if ($this->employeePositionHistoriesScheduledForDeletion and $this->employeePositionHistoriesScheduledForDeletion->contains($l)) {
                $this->employeePositionHistoriesScheduledForDeletion->remove($this->employeePositionHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeePositionHistory $employeePositionHistory The ChildEmployeePositionHistory object to add.
     */
    protected function doAddEmployeePositionHistory(ChildEmployeePositionHistory $employeePositionHistory): void
    {
        $this->collEmployeePositionHistories[]= $employeePositionHistory;
        $employeePositionHistory->setEmployee($this);
    }

    /**
     * @param ChildEmployeePositionHistory $employeePositionHistory The ChildEmployeePositionHistory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeePositionHistory(ChildEmployeePositionHistory $employeePositionHistory)
    {
        if ($this->getEmployeePositionHistories()->contains($employeePositionHistory)) {
            $pos = $this->collEmployeePositionHistories->search($employeePositionHistory);
            $this->collEmployeePositionHistories->remove($pos);
            if (null === $this->employeePositionHistoriesScheduledForDeletion) {
                $this->employeePositionHistoriesScheduledForDeletion = clone $this->collEmployeePositionHistories;
                $this->employeePositionHistoriesScheduledForDeletion->clear();
            }
            $this->employeePositionHistoriesScheduledForDeletion[]= clone $employeePositionHistory;
            $employeePositionHistory->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EmployeePositionHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEmployeePositionHistory[] List of ChildEmployeePositionHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeePositionHistory}> List of ChildEmployeePositionHistory objects
     */
    public function getEmployeePositionHistoriesJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEmployeePositionHistoryQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getEmployeePositionHistories($query, $con);
    }

    /**
     * Clears out the collEventssRelatedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEventssRelatedByEmployeeId()
     */
    public function clearEventssRelatedByEmployeeId()
    {
        $this->collEventssRelatedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEventssRelatedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEventssRelatedByEmployeeId($v = true): void
    {
        $this->collEventssRelatedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collEventssRelatedByEmployeeId collection.
     *
     * By default this just sets the collEventssRelatedByEmployeeId collection to an empty array (like clearcollEventssRelatedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventssRelatedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collEventssRelatedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = EventsTableMap::getTableMap()->getCollectionClassName();

        $this->collEventssRelatedByEmployeeId = new $collectionClassName;
        $this->collEventssRelatedByEmployeeId->setModel('\entities\Events');
    }

    /**
     * Gets an array of ChildEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents> List of ChildEvents objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEventssRelatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEventssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collEventssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEventssRelatedByEmployeeId) {
                    $this->initEventssRelatedByEmployeeId();
                } else {
                    $collectionClassName = EventsTableMap::getTableMap()->getCollectionClassName();

                    $collEventssRelatedByEmployeeId = new $collectionClassName;
                    $collEventssRelatedByEmployeeId->setModel('\entities\Events');

                    return $collEventssRelatedByEmployeeId;
                }
            } else {
                $collEventssRelatedByEmployeeId = ChildEventsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventssRelatedByEmployeeIdPartial && count($collEventssRelatedByEmployeeId)) {
                        $this->initEventssRelatedByEmployeeId(false);

                        foreach ($collEventssRelatedByEmployeeId as $obj) {
                            if (false == $this->collEventssRelatedByEmployeeId->contains($obj)) {
                                $this->collEventssRelatedByEmployeeId->append($obj);
                            }
                        }

                        $this->collEventssRelatedByEmployeeIdPartial = true;
                    }

                    return $collEventssRelatedByEmployeeId;
                }

                if ($partial && $this->collEventssRelatedByEmployeeId) {
                    foreach ($this->collEventssRelatedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collEventssRelatedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collEventssRelatedByEmployeeId = $collEventssRelatedByEmployeeId;
                $this->collEventssRelatedByEmployeeIdPartial = false;
            }
        }

        return $this->collEventssRelatedByEmployeeId;
    }

    /**
     * Sets a collection of ChildEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $eventssRelatedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEventssRelatedByEmployeeId(Collection $eventssRelatedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildEvents[] $eventssRelatedByEmployeeIdToDelete */
        $eventssRelatedByEmployeeIdToDelete = $this->getEventssRelatedByEmployeeId(new Criteria(), $con)->diff($eventssRelatedByEmployeeId);


        $this->eventssRelatedByEmployeeIdScheduledForDeletion = $eventssRelatedByEmployeeIdToDelete;

        foreach ($eventssRelatedByEmployeeIdToDelete as $eventsRelatedByEmployeeIdRemoved) {
            $eventsRelatedByEmployeeIdRemoved->setEmployeeRelatedByEmployeeId(null);
        }

        $this->collEventssRelatedByEmployeeId = null;
        foreach ($eventssRelatedByEmployeeId as $eventsRelatedByEmployeeId) {
            $this->addEventsRelatedByEmployeeId($eventsRelatedByEmployeeId);
        }

        $this->collEventssRelatedByEmployeeId = $eventssRelatedByEmployeeId;
        $this->collEventssRelatedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Events objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Events objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEventssRelatedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEventssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collEventssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventssRelatedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventssRelatedByEmployeeId());
            }

            $query = ChildEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collEventssRelatedByEmployeeId);
    }

    /**
     * Method called to associate a ChildEvents object to this object
     * through the ChildEvents foreign key attribute.
     *
     * @param ChildEvents $l ChildEvents
     * @return $this The current object (for fluent API support)
     */
    public function addEventsRelatedByEmployeeId(ChildEvents $l)
    {
        if ($this->collEventssRelatedByEmployeeId === null) {
            $this->initEventssRelatedByEmployeeId();
            $this->collEventssRelatedByEmployeeIdPartial = true;
        }

        if (!$this->collEventssRelatedByEmployeeId->contains($l)) {
            $this->doAddEventsRelatedByEmployeeId($l);

            if ($this->eventssRelatedByEmployeeIdScheduledForDeletion and $this->eventssRelatedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->eventssRelatedByEmployeeIdScheduledForDeletion->remove($this->eventssRelatedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEvents $eventsRelatedByEmployeeId The ChildEvents object to add.
     */
    protected function doAddEventsRelatedByEmployeeId(ChildEvents $eventsRelatedByEmployeeId): void
    {
        $this->collEventssRelatedByEmployeeId[]= $eventsRelatedByEmployeeId;
        $eventsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId($this);
    }

    /**
     * @param ChildEvents $eventsRelatedByEmployeeId The ChildEvents object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEventsRelatedByEmployeeId(ChildEvents $eventsRelatedByEmployeeId)
    {
        if ($this->getEventssRelatedByEmployeeId()->contains($eventsRelatedByEmployeeId)) {
            $pos = $this->collEventssRelatedByEmployeeId->search($eventsRelatedByEmployeeId);
            $this->collEventssRelatedByEmployeeId->remove($pos);
            if (null === $this->eventssRelatedByEmployeeIdScheduledForDeletion) {
                $this->eventssRelatedByEmployeeIdScheduledForDeletion = clone $this->collEventssRelatedByEmployeeId;
                $this->eventssRelatedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->eventssRelatedByEmployeeIdScheduledForDeletion[]= $eventsRelatedByEmployeeId;
            $eventsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EventssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents}> List of ChildEvents objects
     */
    public function getEventssRelatedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEventssRelatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EventssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents}> List of ChildEvents objects
     */
    public function getEventssRelatedByEmployeeIdJoinEventTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventsQuery::create(null, $criteria);
        $query->joinWith('EventTypes', $joinBehavior);

        return $this->getEventssRelatedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collEventssRelatedByApproverEmpId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEventssRelatedByApproverEmpId()
     */
    public function clearEventssRelatedByApproverEmpId()
    {
        $this->collEventssRelatedByApproverEmpId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEventssRelatedByApproverEmpId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEventssRelatedByApproverEmpId($v = true): void
    {
        $this->collEventssRelatedByApproverEmpIdPartial = $v;
    }

    /**
     * Initializes the collEventssRelatedByApproverEmpId collection.
     *
     * By default this just sets the collEventssRelatedByApproverEmpId collection to an empty array (like clearcollEventssRelatedByApproverEmpId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEventssRelatedByApproverEmpId(bool $overrideExisting = true): void
    {
        if (null !== $this->collEventssRelatedByApproverEmpId && !$overrideExisting) {
            return;
        }

        $collectionClassName = EventsTableMap::getTableMap()->getCollectionClassName();

        $this->collEventssRelatedByApproverEmpId = new $collectionClassName;
        $this->collEventssRelatedByApproverEmpId->setModel('\entities\Events');
    }

    /**
     * Gets an array of ChildEvents objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents> List of ChildEvents objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEventssRelatedByApproverEmpId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEventssRelatedByApproverEmpIdPartial && !$this->isNew();
        if (null === $this->collEventssRelatedByApproverEmpId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEventssRelatedByApproverEmpId) {
                    $this->initEventssRelatedByApproverEmpId();
                } else {
                    $collectionClassName = EventsTableMap::getTableMap()->getCollectionClassName();

                    $collEventssRelatedByApproverEmpId = new $collectionClassName;
                    $collEventssRelatedByApproverEmpId->setModel('\entities\Events');

                    return $collEventssRelatedByApproverEmpId;
                }
            } else {
                $collEventssRelatedByApproverEmpId = ChildEventsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByApproverEmpId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEventssRelatedByApproverEmpIdPartial && count($collEventssRelatedByApproverEmpId)) {
                        $this->initEventssRelatedByApproverEmpId(false);

                        foreach ($collEventssRelatedByApproverEmpId as $obj) {
                            if (false == $this->collEventssRelatedByApproverEmpId->contains($obj)) {
                                $this->collEventssRelatedByApproverEmpId->append($obj);
                            }
                        }

                        $this->collEventssRelatedByApproverEmpIdPartial = true;
                    }

                    return $collEventssRelatedByApproverEmpId;
                }

                if ($partial && $this->collEventssRelatedByApproverEmpId) {
                    foreach ($this->collEventssRelatedByApproverEmpId as $obj) {
                        if ($obj->isNew()) {
                            $collEventssRelatedByApproverEmpId[] = $obj;
                        }
                    }
                }

                $this->collEventssRelatedByApproverEmpId = $collEventssRelatedByApproverEmpId;
                $this->collEventssRelatedByApproverEmpIdPartial = false;
            }
        }

        return $this->collEventssRelatedByApproverEmpId;
    }

    /**
     * Sets a collection of ChildEvents objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $eventssRelatedByApproverEmpId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEventssRelatedByApproverEmpId(Collection $eventssRelatedByApproverEmpId, ?ConnectionInterface $con = null)
    {
        /** @var ChildEvents[] $eventssRelatedByApproverEmpIdToDelete */
        $eventssRelatedByApproverEmpIdToDelete = $this->getEventssRelatedByApproverEmpId(new Criteria(), $con)->diff($eventssRelatedByApproverEmpId);


        $this->eventssRelatedByApproverEmpIdScheduledForDeletion = $eventssRelatedByApproverEmpIdToDelete;

        foreach ($eventssRelatedByApproverEmpIdToDelete as $eventsRelatedByApproverEmpIdRemoved) {
            $eventsRelatedByApproverEmpIdRemoved->setEmployeeRelatedByApproverEmpId(null);
        }

        $this->collEventssRelatedByApproverEmpId = null;
        foreach ($eventssRelatedByApproverEmpId as $eventsRelatedByApproverEmpId) {
            $this->addEventsRelatedByApproverEmpId($eventsRelatedByApproverEmpId);
        }

        $this->collEventssRelatedByApproverEmpId = $eventssRelatedByApproverEmpId;
        $this->collEventssRelatedByApproverEmpIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Events objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Events objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEventssRelatedByApproverEmpId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEventssRelatedByApproverEmpIdPartial && !$this->isNew();
        if (null === $this->collEventssRelatedByApproverEmpId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEventssRelatedByApproverEmpId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEventssRelatedByApproverEmpId());
            }

            $query = ChildEventsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByApproverEmpId($this)
                ->count($con);
        }

        return count($this->collEventssRelatedByApproverEmpId);
    }

    /**
     * Method called to associate a ChildEvents object to this object
     * through the ChildEvents foreign key attribute.
     *
     * @param ChildEvents $l ChildEvents
     * @return $this The current object (for fluent API support)
     */
    public function addEventsRelatedByApproverEmpId(ChildEvents $l)
    {
        if ($this->collEventssRelatedByApproverEmpId === null) {
            $this->initEventssRelatedByApproverEmpId();
            $this->collEventssRelatedByApproverEmpIdPartial = true;
        }

        if (!$this->collEventssRelatedByApproverEmpId->contains($l)) {
            $this->doAddEventsRelatedByApproverEmpId($l);

            if ($this->eventssRelatedByApproverEmpIdScheduledForDeletion and $this->eventssRelatedByApproverEmpIdScheduledForDeletion->contains($l)) {
                $this->eventssRelatedByApproverEmpIdScheduledForDeletion->remove($this->eventssRelatedByApproverEmpIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEvents $eventsRelatedByApproverEmpId The ChildEvents object to add.
     */
    protected function doAddEventsRelatedByApproverEmpId(ChildEvents $eventsRelatedByApproverEmpId): void
    {
        $this->collEventssRelatedByApproverEmpId[]= $eventsRelatedByApproverEmpId;
        $eventsRelatedByApproverEmpId->setEmployeeRelatedByApproverEmpId($this);
    }

    /**
     * @param ChildEvents $eventsRelatedByApproverEmpId The ChildEvents object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEventsRelatedByApproverEmpId(ChildEvents $eventsRelatedByApproverEmpId)
    {
        if ($this->getEventssRelatedByApproverEmpId()->contains($eventsRelatedByApproverEmpId)) {
            $pos = $this->collEventssRelatedByApproverEmpId->search($eventsRelatedByApproverEmpId);
            $this->collEventssRelatedByApproverEmpId->remove($pos);
            if (null === $this->eventssRelatedByApproverEmpIdScheduledForDeletion) {
                $this->eventssRelatedByApproverEmpIdScheduledForDeletion = clone $this->collEventssRelatedByApproverEmpId;
                $this->eventssRelatedByApproverEmpIdScheduledForDeletion->clear();
            }
            $this->eventssRelatedByApproverEmpIdScheduledForDeletion[]= $eventsRelatedByApproverEmpId;
            $eventsRelatedByApproverEmpId->setEmployeeRelatedByApproverEmpId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EventssRelatedByApproverEmpId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents}> List of ChildEvents objects
     */
    public function getEventssRelatedByApproverEmpIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEventssRelatedByApproverEmpId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related EventssRelatedByApproverEmpId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEvents[] List of ChildEvents objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEvents}> List of ChildEvents objects
     */
    public function getEventssRelatedByApproverEmpIdJoinEventTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEventsQuery::create(null, $criteria);
        $query->joinWith('EventTypes', $joinBehavior);

        return $this->getEventssRelatedByApproverEmpId($query, $con);
    }

    /**
     * Clears out the collExpensePaymentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpensePaymentss()
     */
    public function clearExpensePaymentss()
    {
        $this->collExpensePaymentss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpensePaymentss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpensePaymentss($v = true): void
    {
        $this->collExpensePaymentssPartial = $v;
    }

    /**
     * Initializes the collExpensePaymentss collection.
     *
     * By default this just sets the collExpensePaymentss collection to an empty array (like clearcollExpensePaymentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensePaymentss(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpensePaymentss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensePaymentsTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensePaymentss = new $collectionClassName;
        $this->collExpensePaymentss->setModel('\entities\ExpensePayments');
    }

    /**
     * Gets an array of ChildExpensePayments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpensePayments[] List of ChildExpensePayments objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpensePayments> List of ChildExpensePayments objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpensePaymentss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpensePaymentssPartial && !$this->isNew();
        if (null === $this->collExpensePaymentss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpensePaymentss) {
                    $this->initExpensePaymentss();
                } else {
                    $collectionClassName = ExpensePaymentsTableMap::getTableMap()->getCollectionClassName();

                    $collExpensePaymentss = new $collectionClassName;
                    $collExpensePaymentss->setModel('\entities\ExpensePayments');

                    return $collExpensePaymentss;
                }
            } else {
                $collExpensePaymentss = ChildExpensePaymentsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensePaymentssPartial && count($collExpensePaymentss)) {
                        $this->initExpensePaymentss(false);

                        foreach ($collExpensePaymentss as $obj) {
                            if (false == $this->collExpensePaymentss->contains($obj)) {
                                $this->collExpensePaymentss->append($obj);
                            }
                        }

                        $this->collExpensePaymentssPartial = true;
                    }

                    return $collExpensePaymentss;
                }

                if ($partial && $this->collExpensePaymentss) {
                    foreach ($this->collExpensePaymentss as $obj) {
                        if ($obj->isNew()) {
                            $collExpensePaymentss[] = $obj;
                        }
                    }
                }

                $this->collExpensePaymentss = $collExpensePaymentss;
                $this->collExpensePaymentssPartial = false;
            }
        }

        return $this->collExpensePaymentss;
    }

    /**
     * Sets a collection of ChildExpensePayments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expensePaymentss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpensePaymentss(Collection $expensePaymentss, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpensePayments[] $expensePaymentssToDelete */
        $expensePaymentssToDelete = $this->getExpensePaymentss(new Criteria(), $con)->diff($expensePaymentss);


        $this->expensePaymentssScheduledForDeletion = $expensePaymentssToDelete;

        foreach ($expensePaymentssToDelete as $expensePaymentsRemoved) {
            $expensePaymentsRemoved->setEmployee(null);
        }

        $this->collExpensePaymentss = null;
        foreach ($expensePaymentss as $expensePayments) {
            $this->addExpensePayments($expensePayments);
        }

        $this->collExpensePaymentss = $expensePaymentss;
        $this->collExpensePaymentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpensePayments objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ExpensePayments objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpensePaymentss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpensePaymentssPartial && !$this->isNew();
        if (null === $this->collExpensePaymentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensePaymentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensePaymentss());
            }

            $query = ChildExpensePaymentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collExpensePaymentss);
    }

    /**
     * Method called to associate a ChildExpensePayments object to this object
     * through the ChildExpensePayments foreign key attribute.
     *
     * @param ChildExpensePayments $l ChildExpensePayments
     * @return $this The current object (for fluent API support)
     */
    public function addExpensePayments(ChildExpensePayments $l)
    {
        if ($this->collExpensePaymentss === null) {
            $this->initExpensePaymentss();
            $this->collExpensePaymentssPartial = true;
        }

        if (!$this->collExpensePaymentss->contains($l)) {
            $this->doAddExpensePayments($l);

            if ($this->expensePaymentssScheduledForDeletion and $this->expensePaymentssScheduledForDeletion->contains($l)) {
                $this->expensePaymentssScheduledForDeletion->remove($this->expensePaymentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpensePayments $expensePayments The ChildExpensePayments object to add.
     */
    protected function doAddExpensePayments(ChildExpensePayments $expensePayments): void
    {
        $this->collExpensePaymentss[]= $expensePayments;
        $expensePayments->setEmployee($this);
    }

    /**
     * @param ChildExpensePayments $expensePayments The ChildExpensePayments object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpensePayments(ChildExpensePayments $expensePayments)
    {
        if ($this->getExpensePaymentss()->contains($expensePayments)) {
            $pos = $this->collExpensePaymentss->search($expensePayments);
            $this->collExpensePaymentss->remove($pos);
            if (null === $this->expensePaymentssScheduledForDeletion) {
                $this->expensePaymentssScheduledForDeletion = clone $this->collExpensePaymentss;
                $this->expensePaymentssScheduledForDeletion->clear();
            }
            $this->expensePaymentssScheduledForDeletion[]= $expensePayments;
            $expensePayments->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related ExpensePaymentss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpensePayments[] List of ChildExpensePayments objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpensePayments}> List of ChildExpensePayments objects
     */
    public function getExpensePaymentssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensePaymentsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getExpensePaymentss($query, $con);
    }

    /**
     * Clears out the collExpensess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addExpensess()
     */
    public function clearExpensess()
    {
        $this->collExpensess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collExpensess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialExpensess($v = true): void
    {
        $this->collExpensessPartial = $v;
    }

    /**
     * Initializes the collExpensess collection.
     *
     * By default this just sets the collExpensess collection to an empty array (like clearcollExpensess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensess(bool $overrideExisting = true): void
    {
        if (null !== $this->collExpensess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensess = new $collectionClassName;
        $this->collExpensess->setModel('\entities\Expenses');
    }

    /**
     * Gets an array of ChildExpenses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses> List of ChildExpenses objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpensess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpensess) {
                    $this->initExpensess();
                } else {
                    $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

                    $collExpensess = new $collectionClassName;
                    $collExpensess->setModel('\entities\Expenses');

                    return $collExpensess;
                }
            } else {
                $collExpensess = ChildExpensesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensessPartial && count($collExpensess)) {
                        $this->initExpensess(false);

                        foreach ($collExpensess as $obj) {
                            if (false == $this->collExpensess->contains($obj)) {
                                $this->collExpensess->append($obj);
                            }
                        }

                        $this->collExpensessPartial = true;
                    }

                    return $collExpensess;
                }

                if ($partial && $this->collExpensess) {
                    foreach ($this->collExpensess as $obj) {
                        if ($obj->isNew()) {
                            $collExpensess[] = $obj;
                        }
                    }
                }

                $this->collExpensess = $collExpensess;
                $this->collExpensessPartial = false;
            }
        }

        return $this->collExpensess;
    }

    /**
     * Sets a collection of ChildExpenses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $expensess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setExpensess(Collection $expensess, ?ConnectionInterface $con = null)
    {
        /** @var ChildExpenses[] $expensessToDelete */
        $expensessToDelete = $this->getExpensess(new Criteria(), $con)->diff($expensess);


        $this->expensessScheduledForDeletion = $expensessToDelete;

        foreach ($expensessToDelete as $expensesRemoved) {
            $expensesRemoved->setEmployee(null);
        }

        $this->collExpensess = null;
        foreach ($expensess as $expenses) {
            $this->addExpenses($expenses);
        }

        $this->collExpensess = $expensess;
        $this->collExpensessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Expenses objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Expenses objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countExpensess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensess());
            }

            $query = ChildExpensesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collExpensess);
    }

    /**
     * Method called to associate a ChildExpenses object to this object
     * through the ChildExpenses foreign key attribute.
     *
     * @param ChildExpenses $l ChildExpenses
     * @return $this The current object (for fluent API support)
     */
    public function addExpenses(ChildExpenses $l)
    {
        if ($this->collExpensess === null) {
            $this->initExpensess();
            $this->collExpensessPartial = true;
        }

        if (!$this->collExpensess->contains($l)) {
            $this->doAddExpenses($l);

            if ($this->expensessScheduledForDeletion and $this->expensessScheduledForDeletion->contains($l)) {
                $this->expensessScheduledForDeletion->remove($this->expensessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to add.
     */
    protected function doAddExpenses(ChildExpenses $expenses): void
    {
        $this->collExpensess[]= $expenses;
        $expenses->setEmployee($this);
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeExpenses(ChildExpenses $expenses)
    {
        if ($this->getExpensess()->contains($expenses)) {
            $pos = $this->collExpensess->search($expenses);
            $this->collExpensess->remove($pos);
            if (null === $this->expensessScheduledForDeletion) {
                $this->expensessScheduledForDeletion = clone $this->collExpensess;
                $this->expensessScheduledForDeletion->clear();
            }
            $this->expensessScheduledForDeletion[]= clone $expenses;
            $expenses->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinBudgetGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('BudgetGroup', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinCurrencies(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Currencies', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenses}> List of ChildExpenses objects
     */
    public function getExpensessJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getExpensess($query, $con);
    }

    /**
     * Clears out the collHrUserAccounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserAccounts()
     */
    public function clearHrUserAccounts()
    {
        $this->collHrUserAccounts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserAccounts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserAccounts($v = true): void
    {
        $this->collHrUserAccountsPartial = $v;
    }

    /**
     * Initializes the collHrUserAccounts collection.
     *
     * By default this just sets the collHrUserAccounts collection to an empty array (like clearcollHrUserAccounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserAccounts(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserAccounts && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserAccountTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserAccounts = new $collectionClassName;
        $this->collHrUserAccounts->setModel('\entities\HrUserAccount');
    }

    /**
     * Gets an array of ChildHrUserAccount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserAccount[] List of ChildHrUserAccount objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserAccount> List of ChildHrUserAccount objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserAccounts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserAccountsPartial && !$this->isNew();
        if (null === $this->collHrUserAccounts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserAccounts) {
                    $this->initHrUserAccounts();
                } else {
                    $collectionClassName = HrUserAccountTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserAccounts = new $collectionClassName;
                    $collHrUserAccounts->setModel('\entities\HrUserAccount');

                    return $collHrUserAccounts;
                }
            } else {
                $collHrUserAccounts = ChildHrUserAccountQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserAccountsPartial && count($collHrUserAccounts)) {
                        $this->initHrUserAccounts(false);

                        foreach ($collHrUserAccounts as $obj) {
                            if (false == $this->collHrUserAccounts->contains($obj)) {
                                $this->collHrUserAccounts->append($obj);
                            }
                        }

                        $this->collHrUserAccountsPartial = true;
                    }

                    return $collHrUserAccounts;
                }

                if ($partial && $this->collHrUserAccounts) {
                    foreach ($this->collHrUserAccounts as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserAccounts[] = $obj;
                        }
                    }
                }

                $this->collHrUserAccounts = $collHrUserAccounts;
                $this->collHrUserAccountsPartial = false;
            }
        }

        return $this->collHrUserAccounts;
    }

    /**
     * Sets a collection of ChildHrUserAccount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserAccounts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserAccounts(Collection $hrUserAccounts, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserAccount[] $hrUserAccountsToDelete */
        $hrUserAccountsToDelete = $this->getHrUserAccounts(new Criteria(), $con)->diff($hrUserAccounts);


        $this->hrUserAccountsScheduledForDeletion = $hrUserAccountsToDelete;

        foreach ($hrUserAccountsToDelete as $hrUserAccountRemoved) {
            $hrUserAccountRemoved->setEmployee(null);
        }

        $this->collHrUserAccounts = null;
        foreach ($hrUserAccounts as $hrUserAccount) {
            $this->addHrUserAccount($hrUserAccount);
        }

        $this->collHrUserAccounts = $hrUserAccounts;
        $this->collHrUserAccountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserAccount objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserAccount objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserAccounts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserAccountsPartial && !$this->isNew();
        if (null === $this->collHrUserAccounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserAccounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserAccounts());
            }

            $query = ChildHrUserAccountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserAccounts);
    }

    /**
     * Method called to associate a ChildHrUserAccount object to this object
     * through the ChildHrUserAccount foreign key attribute.
     *
     * @param ChildHrUserAccount $l ChildHrUserAccount
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserAccount(ChildHrUserAccount $l)
    {
        if ($this->collHrUserAccounts === null) {
            $this->initHrUserAccounts();
            $this->collHrUserAccountsPartial = true;
        }

        if (!$this->collHrUserAccounts->contains($l)) {
            $this->doAddHrUserAccount($l);

            if ($this->hrUserAccountsScheduledForDeletion and $this->hrUserAccountsScheduledForDeletion->contains($l)) {
                $this->hrUserAccountsScheduledForDeletion->remove($this->hrUserAccountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserAccount $hrUserAccount The ChildHrUserAccount object to add.
     */
    protected function doAddHrUserAccount(ChildHrUserAccount $hrUserAccount): void
    {
        $this->collHrUserAccounts[]= $hrUserAccount;
        $hrUserAccount->setEmployee($this);
    }

    /**
     * @param ChildHrUserAccount $hrUserAccount The ChildHrUserAccount object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserAccount(ChildHrUserAccount $hrUserAccount)
    {
        if ($this->getHrUserAccounts()->contains($hrUserAccount)) {
            $pos = $this->collHrUserAccounts->search($hrUserAccount);
            $this->collHrUserAccounts->remove($pos);
            if (null === $this->hrUserAccountsScheduledForDeletion) {
                $this->hrUserAccountsScheduledForDeletion = clone $this->collHrUserAccounts;
                $this->hrUserAccountsScheduledForDeletion->clear();
            }
            $this->hrUserAccountsScheduledForDeletion[]= $hrUserAccount;
            $hrUserAccount->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHrUserDatess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserDatess()
     */
    public function clearHrUserDatess()
    {
        $this->collHrUserDatess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserDatess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserDatess($v = true): void
    {
        $this->collHrUserDatessPartial = $v;
    }

    /**
     * Initializes the collHrUserDatess collection.
     *
     * By default this just sets the collHrUserDatess collection to an empty array (like clearcollHrUserDatess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserDatess(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserDatess && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserDatesTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserDatess = new $collectionClassName;
        $this->collHrUserDatess->setModel('\entities\HrUserDates');
    }

    /**
     * Gets an array of ChildHrUserDates objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserDates[] List of ChildHrUserDates objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserDates> List of ChildHrUserDates objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserDatess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserDatessPartial && !$this->isNew();
        if (null === $this->collHrUserDatess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserDatess) {
                    $this->initHrUserDatess();
                } else {
                    $collectionClassName = HrUserDatesTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserDatess = new $collectionClassName;
                    $collHrUserDatess->setModel('\entities\HrUserDates');

                    return $collHrUserDatess;
                }
            } else {
                $collHrUserDatess = ChildHrUserDatesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserDatessPartial && count($collHrUserDatess)) {
                        $this->initHrUserDatess(false);

                        foreach ($collHrUserDatess as $obj) {
                            if (false == $this->collHrUserDatess->contains($obj)) {
                                $this->collHrUserDatess->append($obj);
                            }
                        }

                        $this->collHrUserDatessPartial = true;
                    }

                    return $collHrUserDatess;
                }

                if ($partial && $this->collHrUserDatess) {
                    foreach ($this->collHrUserDatess as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserDatess[] = $obj;
                        }
                    }
                }

                $this->collHrUserDatess = $collHrUserDatess;
                $this->collHrUserDatessPartial = false;
            }
        }

        return $this->collHrUserDatess;
    }

    /**
     * Sets a collection of ChildHrUserDates objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserDatess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserDatess(Collection $hrUserDatess, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserDates[] $hrUserDatessToDelete */
        $hrUserDatessToDelete = $this->getHrUserDatess(new Criteria(), $con)->diff($hrUserDatess);


        $this->hrUserDatessScheduledForDeletion = $hrUserDatessToDelete;

        foreach ($hrUserDatessToDelete as $hrUserDatesRemoved) {
            $hrUserDatesRemoved->setEmployee(null);
        }

        $this->collHrUserDatess = null;
        foreach ($hrUserDatess as $hrUserDates) {
            $this->addHrUserDates($hrUserDates);
        }

        $this->collHrUserDatess = $hrUserDatess;
        $this->collHrUserDatessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserDates objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserDates objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserDatess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserDatessPartial && !$this->isNew();
        if (null === $this->collHrUserDatess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserDatess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserDatess());
            }

            $query = ChildHrUserDatesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserDatess);
    }

    /**
     * Method called to associate a ChildHrUserDates object to this object
     * through the ChildHrUserDates foreign key attribute.
     *
     * @param ChildHrUserDates $l ChildHrUserDates
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserDates(ChildHrUserDates $l)
    {
        if ($this->collHrUserDatess === null) {
            $this->initHrUserDatess();
            $this->collHrUserDatessPartial = true;
        }

        if (!$this->collHrUserDatess->contains($l)) {
            $this->doAddHrUserDates($l);

            if ($this->hrUserDatessScheduledForDeletion and $this->hrUserDatessScheduledForDeletion->contains($l)) {
                $this->hrUserDatessScheduledForDeletion->remove($this->hrUserDatessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserDates $hrUserDates The ChildHrUserDates object to add.
     */
    protected function doAddHrUserDates(ChildHrUserDates $hrUserDates): void
    {
        $this->collHrUserDatess[]= $hrUserDates;
        $hrUserDates->setEmployee($this);
    }

    /**
     * @param ChildHrUserDates $hrUserDates The ChildHrUserDates object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserDates(ChildHrUserDates $hrUserDates)
    {
        if ($this->getHrUserDatess()->contains($hrUserDates)) {
            $pos = $this->collHrUserDatess->search($hrUserDates);
            $this->collHrUserDatess->remove($pos);
            if (null === $this->hrUserDatessScheduledForDeletion) {
                $this->hrUserDatessScheduledForDeletion = clone $this->collHrUserDatess;
                $this->hrUserDatessScheduledForDeletion->clear();
            }
            $this->hrUserDatessScheduledForDeletion[]= clone $hrUserDates;
            $hrUserDates->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHrUserDocumentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserDocumentss()
     */
    public function clearHrUserDocumentss()
    {
        $this->collHrUserDocumentss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserDocumentss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserDocumentss($v = true): void
    {
        $this->collHrUserDocumentssPartial = $v;
    }

    /**
     * Initializes the collHrUserDocumentss collection.
     *
     * By default this just sets the collHrUserDocumentss collection to an empty array (like clearcollHrUserDocumentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserDocumentss(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserDocumentss && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserDocumentsTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserDocumentss = new $collectionClassName;
        $this->collHrUserDocumentss->setModel('\entities\HrUserDocuments');
    }

    /**
     * Gets an array of ChildHrUserDocuments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserDocuments[] List of ChildHrUserDocuments objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserDocuments> List of ChildHrUserDocuments objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserDocumentss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserDocumentssPartial && !$this->isNew();
        if (null === $this->collHrUserDocumentss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserDocumentss) {
                    $this->initHrUserDocumentss();
                } else {
                    $collectionClassName = HrUserDocumentsTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserDocumentss = new $collectionClassName;
                    $collHrUserDocumentss->setModel('\entities\HrUserDocuments');

                    return $collHrUserDocumentss;
                }
            } else {
                $collHrUserDocumentss = ChildHrUserDocumentsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserDocumentssPartial && count($collHrUserDocumentss)) {
                        $this->initHrUserDocumentss(false);

                        foreach ($collHrUserDocumentss as $obj) {
                            if (false == $this->collHrUserDocumentss->contains($obj)) {
                                $this->collHrUserDocumentss->append($obj);
                            }
                        }

                        $this->collHrUserDocumentssPartial = true;
                    }

                    return $collHrUserDocumentss;
                }

                if ($partial && $this->collHrUserDocumentss) {
                    foreach ($this->collHrUserDocumentss as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserDocumentss[] = $obj;
                        }
                    }
                }

                $this->collHrUserDocumentss = $collHrUserDocumentss;
                $this->collHrUserDocumentssPartial = false;
            }
        }

        return $this->collHrUserDocumentss;
    }

    /**
     * Sets a collection of ChildHrUserDocuments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserDocumentss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserDocumentss(Collection $hrUserDocumentss, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserDocuments[] $hrUserDocumentssToDelete */
        $hrUserDocumentssToDelete = $this->getHrUserDocumentss(new Criteria(), $con)->diff($hrUserDocumentss);


        $this->hrUserDocumentssScheduledForDeletion = $hrUserDocumentssToDelete;

        foreach ($hrUserDocumentssToDelete as $hrUserDocumentsRemoved) {
            $hrUserDocumentsRemoved->setEmployee(null);
        }

        $this->collHrUserDocumentss = null;
        foreach ($hrUserDocumentss as $hrUserDocuments) {
            $this->addHrUserDocuments($hrUserDocuments);
        }

        $this->collHrUserDocumentss = $hrUserDocumentss;
        $this->collHrUserDocumentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserDocuments objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserDocuments objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserDocumentss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserDocumentssPartial && !$this->isNew();
        if (null === $this->collHrUserDocumentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserDocumentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserDocumentss());
            }

            $query = ChildHrUserDocumentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserDocumentss);
    }

    /**
     * Method called to associate a ChildHrUserDocuments object to this object
     * through the ChildHrUserDocuments foreign key attribute.
     *
     * @param ChildHrUserDocuments $l ChildHrUserDocuments
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserDocuments(ChildHrUserDocuments $l)
    {
        if ($this->collHrUserDocumentss === null) {
            $this->initHrUserDocumentss();
            $this->collHrUserDocumentssPartial = true;
        }

        if (!$this->collHrUserDocumentss->contains($l)) {
            $this->doAddHrUserDocuments($l);

            if ($this->hrUserDocumentssScheduledForDeletion and $this->hrUserDocumentssScheduledForDeletion->contains($l)) {
                $this->hrUserDocumentssScheduledForDeletion->remove($this->hrUserDocumentssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserDocuments $hrUserDocuments The ChildHrUserDocuments object to add.
     */
    protected function doAddHrUserDocuments(ChildHrUserDocuments $hrUserDocuments): void
    {
        $this->collHrUserDocumentss[]= $hrUserDocuments;
        $hrUserDocuments->setEmployee($this);
    }

    /**
     * @param ChildHrUserDocuments $hrUserDocuments The ChildHrUserDocuments object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserDocuments(ChildHrUserDocuments $hrUserDocuments)
    {
        if ($this->getHrUserDocumentss()->contains($hrUserDocuments)) {
            $pos = $this->collHrUserDocumentss->search($hrUserDocuments);
            $this->collHrUserDocumentss->remove($pos);
            if (null === $this->hrUserDocumentssScheduledForDeletion) {
                $this->hrUserDocumentssScheduledForDeletion = clone $this->collHrUserDocumentss;
                $this->hrUserDocumentssScheduledForDeletion->clear();
            }
            $this->hrUserDocumentssScheduledForDeletion[]= $hrUserDocuments;
            $hrUserDocuments->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHrUserExperiencess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserExperiencess()
     */
    public function clearHrUserExperiencess()
    {
        $this->collHrUserExperiencess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserExperiencess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserExperiencess($v = true): void
    {
        $this->collHrUserExperiencessPartial = $v;
    }

    /**
     * Initializes the collHrUserExperiencess collection.
     *
     * By default this just sets the collHrUserExperiencess collection to an empty array (like clearcollHrUserExperiencess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserExperiencess(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserExperiencess && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserExperiencesTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserExperiencess = new $collectionClassName;
        $this->collHrUserExperiencess->setModel('\entities\HrUserExperiences');
    }

    /**
     * Gets an array of ChildHrUserExperiences objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserExperiences[] List of ChildHrUserExperiences objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserExperiences> List of ChildHrUserExperiences objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserExperiencess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserExperiencessPartial && !$this->isNew();
        if (null === $this->collHrUserExperiencess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserExperiencess) {
                    $this->initHrUserExperiencess();
                } else {
                    $collectionClassName = HrUserExperiencesTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserExperiencess = new $collectionClassName;
                    $collHrUserExperiencess->setModel('\entities\HrUserExperiences');

                    return $collHrUserExperiencess;
                }
            } else {
                $collHrUserExperiencess = ChildHrUserExperiencesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserExperiencessPartial && count($collHrUserExperiencess)) {
                        $this->initHrUserExperiencess(false);

                        foreach ($collHrUserExperiencess as $obj) {
                            if (false == $this->collHrUserExperiencess->contains($obj)) {
                                $this->collHrUserExperiencess->append($obj);
                            }
                        }

                        $this->collHrUserExperiencessPartial = true;
                    }

                    return $collHrUserExperiencess;
                }

                if ($partial && $this->collHrUserExperiencess) {
                    foreach ($this->collHrUserExperiencess as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserExperiencess[] = $obj;
                        }
                    }
                }

                $this->collHrUserExperiencess = $collHrUserExperiencess;
                $this->collHrUserExperiencessPartial = false;
            }
        }

        return $this->collHrUserExperiencess;
    }

    /**
     * Sets a collection of ChildHrUserExperiences objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserExperiencess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserExperiencess(Collection $hrUserExperiencess, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserExperiences[] $hrUserExperiencessToDelete */
        $hrUserExperiencessToDelete = $this->getHrUserExperiencess(new Criteria(), $con)->diff($hrUserExperiencess);


        $this->hrUserExperiencessScheduledForDeletion = $hrUserExperiencessToDelete;

        foreach ($hrUserExperiencessToDelete as $hrUserExperiencesRemoved) {
            $hrUserExperiencesRemoved->setEmployee(null);
        }

        $this->collHrUserExperiencess = null;
        foreach ($hrUserExperiencess as $hrUserExperiences) {
            $this->addHrUserExperiences($hrUserExperiences);
        }

        $this->collHrUserExperiencess = $hrUserExperiencess;
        $this->collHrUserExperiencessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserExperiences objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserExperiences objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserExperiencess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserExperiencessPartial && !$this->isNew();
        if (null === $this->collHrUserExperiencess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserExperiencess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserExperiencess());
            }

            $query = ChildHrUserExperiencesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserExperiencess);
    }

    /**
     * Method called to associate a ChildHrUserExperiences object to this object
     * through the ChildHrUserExperiences foreign key attribute.
     *
     * @param ChildHrUserExperiences $l ChildHrUserExperiences
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserExperiences(ChildHrUserExperiences $l)
    {
        if ($this->collHrUserExperiencess === null) {
            $this->initHrUserExperiencess();
            $this->collHrUserExperiencessPartial = true;
        }

        if (!$this->collHrUserExperiencess->contains($l)) {
            $this->doAddHrUserExperiences($l);

            if ($this->hrUserExperiencessScheduledForDeletion and $this->hrUserExperiencessScheduledForDeletion->contains($l)) {
                $this->hrUserExperiencessScheduledForDeletion->remove($this->hrUserExperiencessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserExperiences $hrUserExperiences The ChildHrUserExperiences object to add.
     */
    protected function doAddHrUserExperiences(ChildHrUserExperiences $hrUserExperiences): void
    {
        $this->collHrUserExperiencess[]= $hrUserExperiences;
        $hrUserExperiences->setEmployee($this);
    }

    /**
     * @param ChildHrUserExperiences $hrUserExperiences The ChildHrUserExperiences object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserExperiences(ChildHrUserExperiences $hrUserExperiences)
    {
        if ($this->getHrUserExperiencess()->contains($hrUserExperiences)) {
            $pos = $this->collHrUserExperiencess->search($hrUserExperiences);
            $this->collHrUserExperiencess->remove($pos);
            if (null === $this->hrUserExperiencessScheduledForDeletion) {
                $this->hrUserExperiencessScheduledForDeletion = clone $this->collHrUserExperiencess;
                $this->hrUserExperiencessScheduledForDeletion->clear();
            }
            $this->hrUserExperiencessScheduledForDeletion[]= clone $hrUserExperiences;
            $hrUserExperiences->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHrUserQualifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserQualifications()
     */
    public function clearHrUserQualifications()
    {
        $this->collHrUserQualifications = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserQualifications collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserQualifications($v = true): void
    {
        $this->collHrUserQualificationsPartial = $v;
    }

    /**
     * Initializes the collHrUserQualifications collection.
     *
     * By default this just sets the collHrUserQualifications collection to an empty array (like clearcollHrUserQualifications());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserQualifications(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserQualifications && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserQualificationTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserQualifications = new $collectionClassName;
        $this->collHrUserQualifications->setModel('\entities\HrUserQualification');
    }

    /**
     * Gets an array of ChildHrUserQualification objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserQualification[] List of ChildHrUserQualification objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserQualification> List of ChildHrUserQualification objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserQualifications(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserQualificationsPartial && !$this->isNew();
        if (null === $this->collHrUserQualifications || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserQualifications) {
                    $this->initHrUserQualifications();
                } else {
                    $collectionClassName = HrUserQualificationTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserQualifications = new $collectionClassName;
                    $collHrUserQualifications->setModel('\entities\HrUserQualification');

                    return $collHrUserQualifications;
                }
            } else {
                $collHrUserQualifications = ChildHrUserQualificationQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserQualificationsPartial && count($collHrUserQualifications)) {
                        $this->initHrUserQualifications(false);

                        foreach ($collHrUserQualifications as $obj) {
                            if (false == $this->collHrUserQualifications->contains($obj)) {
                                $this->collHrUserQualifications->append($obj);
                            }
                        }

                        $this->collHrUserQualificationsPartial = true;
                    }

                    return $collHrUserQualifications;
                }

                if ($partial && $this->collHrUserQualifications) {
                    foreach ($this->collHrUserQualifications as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserQualifications[] = $obj;
                        }
                    }
                }

                $this->collHrUserQualifications = $collHrUserQualifications;
                $this->collHrUserQualificationsPartial = false;
            }
        }

        return $this->collHrUserQualifications;
    }

    /**
     * Sets a collection of ChildHrUserQualification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserQualifications A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserQualifications(Collection $hrUserQualifications, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserQualification[] $hrUserQualificationsToDelete */
        $hrUserQualificationsToDelete = $this->getHrUserQualifications(new Criteria(), $con)->diff($hrUserQualifications);


        $this->hrUserQualificationsScheduledForDeletion = $hrUserQualificationsToDelete;

        foreach ($hrUserQualificationsToDelete as $hrUserQualificationRemoved) {
            $hrUserQualificationRemoved->setEmployee(null);
        }

        $this->collHrUserQualifications = null;
        foreach ($hrUserQualifications as $hrUserQualification) {
            $this->addHrUserQualification($hrUserQualification);
        }

        $this->collHrUserQualifications = $hrUserQualifications;
        $this->collHrUserQualificationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserQualification objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserQualification objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserQualifications(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserQualificationsPartial && !$this->isNew();
        if (null === $this->collHrUserQualifications || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserQualifications) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserQualifications());
            }

            $query = ChildHrUserQualificationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserQualifications);
    }

    /**
     * Method called to associate a ChildHrUserQualification object to this object
     * through the ChildHrUserQualification foreign key attribute.
     *
     * @param ChildHrUserQualification $l ChildHrUserQualification
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserQualification(ChildHrUserQualification $l)
    {
        if ($this->collHrUserQualifications === null) {
            $this->initHrUserQualifications();
            $this->collHrUserQualificationsPartial = true;
        }

        if (!$this->collHrUserQualifications->contains($l)) {
            $this->doAddHrUserQualification($l);

            if ($this->hrUserQualificationsScheduledForDeletion and $this->hrUserQualificationsScheduledForDeletion->contains($l)) {
                $this->hrUserQualificationsScheduledForDeletion->remove($this->hrUserQualificationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserQualification $hrUserQualification The ChildHrUserQualification object to add.
     */
    protected function doAddHrUserQualification(ChildHrUserQualification $hrUserQualification): void
    {
        $this->collHrUserQualifications[]= $hrUserQualification;
        $hrUserQualification->setEmployee($this);
    }

    /**
     * @param ChildHrUserQualification $hrUserQualification The ChildHrUserQualification object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserQualification(ChildHrUserQualification $hrUserQualification)
    {
        if ($this->getHrUserQualifications()->contains($hrUserQualification)) {
            $pos = $this->collHrUserQualifications->search($hrUserQualification);
            $this->collHrUserQualifications->remove($pos);
            if (null === $this->hrUserQualificationsScheduledForDeletion) {
                $this->hrUserQualificationsScheduledForDeletion = clone $this->collHrUserQualifications;
                $this->hrUserQualificationsScheduledForDeletion->clear();
            }
            $this->hrUserQualificationsScheduledForDeletion[]= clone $hrUserQualification;
            $hrUserQualification->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collHrUserReferencess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHrUserReferencess()
     */
    public function clearHrUserReferencess()
    {
        $this->collHrUserReferencess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHrUserReferencess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHrUserReferencess($v = true): void
    {
        $this->collHrUserReferencessPartial = $v;
    }

    /**
     * Initializes the collHrUserReferencess collection.
     *
     * By default this just sets the collHrUserReferencess collection to an empty array (like clearcollHrUserReferencess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHrUserReferencess(bool $overrideExisting = true): void
    {
        if (null !== $this->collHrUserReferencess && !$overrideExisting) {
            return;
        }

        $collectionClassName = HrUserReferencesTableMap::getTableMap()->getCollectionClassName();

        $this->collHrUserReferencess = new $collectionClassName;
        $this->collHrUserReferencess->setModel('\entities\HrUserReferences');
    }

    /**
     * Gets an array of ChildHrUserReferences objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHrUserReferences[] List of ChildHrUserReferences objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHrUserReferences> List of ChildHrUserReferences objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHrUserReferencess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHrUserReferencessPartial && !$this->isNew();
        if (null === $this->collHrUserReferencess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHrUserReferencess) {
                    $this->initHrUserReferencess();
                } else {
                    $collectionClassName = HrUserReferencesTableMap::getTableMap()->getCollectionClassName();

                    $collHrUserReferencess = new $collectionClassName;
                    $collHrUserReferencess->setModel('\entities\HrUserReferences');

                    return $collHrUserReferencess;
                }
            } else {
                $collHrUserReferencess = ChildHrUserReferencesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHrUserReferencessPartial && count($collHrUserReferencess)) {
                        $this->initHrUserReferencess(false);

                        foreach ($collHrUserReferencess as $obj) {
                            if (false == $this->collHrUserReferencess->contains($obj)) {
                                $this->collHrUserReferencess->append($obj);
                            }
                        }

                        $this->collHrUserReferencessPartial = true;
                    }

                    return $collHrUserReferencess;
                }

                if ($partial && $this->collHrUserReferencess) {
                    foreach ($this->collHrUserReferencess as $obj) {
                        if ($obj->isNew()) {
                            $collHrUserReferencess[] = $obj;
                        }
                    }
                }

                $this->collHrUserReferencess = $collHrUserReferencess;
                $this->collHrUserReferencessPartial = false;
            }
        }

        return $this->collHrUserReferencess;
    }

    /**
     * Sets a collection of ChildHrUserReferences objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $hrUserReferencess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHrUserReferencess(Collection $hrUserReferencess, ?ConnectionInterface $con = null)
    {
        /** @var ChildHrUserReferences[] $hrUserReferencessToDelete */
        $hrUserReferencessToDelete = $this->getHrUserReferencess(new Criteria(), $con)->diff($hrUserReferencess);


        $this->hrUserReferencessScheduledForDeletion = $hrUserReferencessToDelete;

        foreach ($hrUserReferencessToDelete as $hrUserReferencesRemoved) {
            $hrUserReferencesRemoved->setEmployee(null);
        }

        $this->collHrUserReferencess = null;
        foreach ($hrUserReferencess as $hrUserReferences) {
            $this->addHrUserReferences($hrUserReferences);
        }

        $this->collHrUserReferencess = $hrUserReferencess;
        $this->collHrUserReferencessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HrUserReferences objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HrUserReferences objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHrUserReferencess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHrUserReferencessPartial && !$this->isNew();
        if (null === $this->collHrUserReferencess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHrUserReferencess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHrUserReferencess());
            }

            $query = ChildHrUserReferencesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collHrUserReferencess);
    }

    /**
     * Method called to associate a ChildHrUserReferences object to this object
     * through the ChildHrUserReferences foreign key attribute.
     *
     * @param ChildHrUserReferences $l ChildHrUserReferences
     * @return $this The current object (for fluent API support)
     */
    public function addHrUserReferences(ChildHrUserReferences $l)
    {
        if ($this->collHrUserReferencess === null) {
            $this->initHrUserReferencess();
            $this->collHrUserReferencessPartial = true;
        }

        if (!$this->collHrUserReferencess->contains($l)) {
            $this->doAddHrUserReferences($l);

            if ($this->hrUserReferencessScheduledForDeletion and $this->hrUserReferencessScheduledForDeletion->contains($l)) {
                $this->hrUserReferencessScheduledForDeletion->remove($this->hrUserReferencessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHrUserReferences $hrUserReferences The ChildHrUserReferences object to add.
     */
    protected function doAddHrUserReferences(ChildHrUserReferences $hrUserReferences): void
    {
        $this->collHrUserReferencess[]= $hrUserReferences;
        $hrUserReferences->setEmployee($this);
    }

    /**
     * @param ChildHrUserReferences $hrUserReferences The ChildHrUserReferences object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHrUserReferences(ChildHrUserReferences $hrUserReferences)
    {
        if ($this->getHrUserReferencess()->contains($hrUserReferences)) {
            $pos = $this->collHrUserReferencess->search($hrUserReferences);
            $this->collHrUserReferencess->remove($pos);
            if (null === $this->hrUserReferencessScheduledForDeletion) {
                $this->hrUserReferencessScheduledForDeletion = clone $this->collHrUserReferencess;
                $this->hrUserReferencessScheduledForDeletion->clear();
            }
            $this->hrUserReferencessScheduledForDeletion[]= $hrUserReferences;
            $hrUserReferences->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeaveRequests collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addLeaveRequests()
     */
    public function clearLeaveRequests()
    {
        $this->collLeaveRequests = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collLeaveRequests collection loaded partially.
     *
     * @return void
     */
    public function resetPartialLeaveRequests($v = true): void
    {
        $this->collLeaveRequestsPartial = $v;
    }

    /**
     * Initializes the collLeaveRequests collection.
     *
     * By default this just sets the collLeaveRequests collection to an empty array (like clearcollLeaveRequests());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeaveRequests(bool $overrideExisting = true): void
    {
        if (null !== $this->collLeaveRequests && !$overrideExisting) {
            return;
        }

        $collectionClassName = LeaveRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collLeaveRequests = new $collectionClassName;
        $this->collLeaveRequests->setModel('\entities\LeaveRequest');
    }

    /**
     * Gets an array of ChildLeaveRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLeaveRequest[] List of ChildLeaveRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLeaveRequest> List of ChildLeaveRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLeaveRequests(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collLeaveRequestsPartial && !$this->isNew();
        if (null === $this->collLeaveRequests || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLeaveRequests) {
                    $this->initLeaveRequests();
                } else {
                    $collectionClassName = LeaveRequestTableMap::getTableMap()->getCollectionClassName();

                    $collLeaveRequests = new $collectionClassName;
                    $collLeaveRequests->setModel('\entities\LeaveRequest');

                    return $collLeaveRequests;
                }
            } else {
                $collLeaveRequests = ChildLeaveRequestQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLeaveRequestsPartial && count($collLeaveRequests)) {
                        $this->initLeaveRequests(false);

                        foreach ($collLeaveRequests as $obj) {
                            if (false == $this->collLeaveRequests->contains($obj)) {
                                $this->collLeaveRequests->append($obj);
                            }
                        }

                        $this->collLeaveRequestsPartial = true;
                    }

                    return $collLeaveRequests;
                }

                if ($partial && $this->collLeaveRequests) {
                    foreach ($this->collLeaveRequests as $obj) {
                        if ($obj->isNew()) {
                            $collLeaveRequests[] = $obj;
                        }
                    }
                }

                $this->collLeaveRequests = $collLeaveRequests;
                $this->collLeaveRequestsPartial = false;
            }
        }

        return $this->collLeaveRequests;
    }

    /**
     * Sets a collection of ChildLeaveRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $leaveRequests A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setLeaveRequests(Collection $leaveRequests, ?ConnectionInterface $con = null)
    {
        /** @var ChildLeaveRequest[] $leaveRequestsToDelete */
        $leaveRequestsToDelete = $this->getLeaveRequests(new Criteria(), $con)->diff($leaveRequests);


        $this->leaveRequestsScheduledForDeletion = $leaveRequestsToDelete;

        foreach ($leaveRequestsToDelete as $leaveRequestRemoved) {
            $leaveRequestRemoved->setEmployee(null);
        }

        $this->collLeaveRequests = null;
        foreach ($leaveRequests as $leaveRequest) {
            $this->addLeaveRequest($leaveRequest);
        }

        $this->collLeaveRequests = $leaveRequests;
        $this->collLeaveRequestsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LeaveRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related LeaveRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countLeaveRequests(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collLeaveRequestsPartial && !$this->isNew();
        if (null === $this->collLeaveRequests || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeaveRequests) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeaveRequests());
            }

            $query = ChildLeaveRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collLeaveRequests);
    }

    /**
     * Method called to associate a ChildLeaveRequest object to this object
     * through the ChildLeaveRequest foreign key attribute.
     *
     * @param ChildLeaveRequest $l ChildLeaveRequest
     * @return $this The current object (for fluent API support)
     */
    public function addLeaveRequest(ChildLeaveRequest $l)
    {
        if ($this->collLeaveRequests === null) {
            $this->initLeaveRequests();
            $this->collLeaveRequestsPartial = true;
        }

        if (!$this->collLeaveRequests->contains($l)) {
            $this->doAddLeaveRequest($l);

            if ($this->leaveRequestsScheduledForDeletion and $this->leaveRequestsScheduledForDeletion->contains($l)) {
                $this->leaveRequestsScheduledForDeletion->remove($this->leaveRequestsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLeaveRequest $leaveRequest The ChildLeaveRequest object to add.
     */
    protected function doAddLeaveRequest(ChildLeaveRequest $leaveRequest): void
    {
        $this->collLeaveRequests[]= $leaveRequest;
        $leaveRequest->setEmployee($this);
    }

    /**
     * @param ChildLeaveRequest $leaveRequest The ChildLeaveRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeLeaveRequest(ChildLeaveRequest $leaveRequest)
    {
        if ($this->getLeaveRequests()->contains($leaveRequest)) {
            $pos = $this->collLeaveRequests->search($leaveRequest);
            $this->collLeaveRequests->remove($pos);
            if (null === $this->leaveRequestsScheduledForDeletion) {
                $this->leaveRequestsScheduledForDeletion = clone $this->collLeaveRequests;
                $this->leaveRequestsScheduledForDeletion->clear();
            }
            $this->leaveRequestsScheduledForDeletion[]= clone $leaveRequest;
            $leaveRequest->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related LeaveRequests from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLeaveRequest[] List of ChildLeaveRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLeaveRequest}> List of ChildLeaveRequest objects
     */
    public function getLeaveRequestsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLeaveRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getLeaveRequests($query, $con);
    }

    /**
     * Clears out the collLeavess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addLeavess()
     */
    public function clearLeavess()
    {
        $this->collLeavess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collLeavess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialLeavess($v = true): void
    {
        $this->collLeavessPartial = $v;
    }

    /**
     * Initializes the collLeavess collection.
     *
     * By default this just sets the collLeavess collection to an empty array (like clearcollLeavess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeavess(bool $overrideExisting = true): void
    {
        if (null !== $this->collLeavess && !$overrideExisting) {
            return;
        }

        $collectionClassName = LeavesTableMap::getTableMap()->getCollectionClassName();

        $this->collLeavess = new $collectionClassName;
        $this->collLeavess->setModel('\entities\Leaves');
    }

    /**
     * Gets an array of ChildLeaves objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLeaves[] List of ChildLeaves objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLeaves> List of ChildLeaves objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLeavess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collLeavessPartial && !$this->isNew();
        if (null === $this->collLeavess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLeavess) {
                    $this->initLeavess();
                } else {
                    $collectionClassName = LeavesTableMap::getTableMap()->getCollectionClassName();

                    $collLeavess = new $collectionClassName;
                    $collLeavess->setModel('\entities\Leaves');

                    return $collLeavess;
                }
            } else {
                $collLeavess = ChildLeavesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLeavessPartial && count($collLeavess)) {
                        $this->initLeavess(false);

                        foreach ($collLeavess as $obj) {
                            if (false == $this->collLeavess->contains($obj)) {
                                $this->collLeavess->append($obj);
                            }
                        }

                        $this->collLeavessPartial = true;
                    }

                    return $collLeavess;
                }

                if ($partial && $this->collLeavess) {
                    foreach ($this->collLeavess as $obj) {
                        if ($obj->isNew()) {
                            $collLeavess[] = $obj;
                        }
                    }
                }

                $this->collLeavess = $collLeavess;
                $this->collLeavessPartial = false;
            }
        }

        return $this->collLeavess;
    }

    /**
     * Sets a collection of ChildLeaves objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $leavess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setLeavess(Collection $leavess, ?ConnectionInterface $con = null)
    {
        /** @var ChildLeaves[] $leavessToDelete */
        $leavessToDelete = $this->getLeavess(new Criteria(), $con)->diff($leavess);


        $this->leavessScheduledForDeletion = $leavessToDelete;

        foreach ($leavessToDelete as $leavesRemoved) {
            $leavesRemoved->setEmployee(null);
        }

        $this->collLeavess = null;
        foreach ($leavess as $leaves) {
            $this->addLeaves($leaves);
        }

        $this->collLeavess = $leavess;
        $this->collLeavessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Leaves objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Leaves objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countLeavess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collLeavessPartial && !$this->isNew();
        if (null === $this->collLeavess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeavess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLeavess());
            }

            $query = ChildLeavesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collLeavess);
    }

    /**
     * Method called to associate a ChildLeaves object to this object
     * through the ChildLeaves foreign key attribute.
     *
     * @param ChildLeaves $l ChildLeaves
     * @return $this The current object (for fluent API support)
     */
    public function addLeaves(ChildLeaves $l)
    {
        if ($this->collLeavess === null) {
            $this->initLeavess();
            $this->collLeavessPartial = true;
        }

        if (!$this->collLeavess->contains($l)) {
            $this->doAddLeaves($l);

            if ($this->leavessScheduledForDeletion and $this->leavessScheduledForDeletion->contains($l)) {
                $this->leavessScheduledForDeletion->remove($this->leavessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildLeaves $leaves The ChildLeaves object to add.
     */
    protected function doAddLeaves(ChildLeaves $leaves): void
    {
        $this->collLeavess[]= $leaves;
        $leaves->setEmployee($this);
    }

    /**
     * @param ChildLeaves $leaves The ChildLeaves object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeLeaves(ChildLeaves $leaves)
    {
        if ($this->getLeavess()->contains($leaves)) {
            $pos = $this->collLeavess->search($leaves);
            $this->collLeavess->remove($pos);
            if (null === $this->leavessScheduledForDeletion) {
                $this->leavessScheduledForDeletion = clone $this->collLeavess;
                $this->leavessScheduledForDeletion->clear();
            }
            $this->leavessScheduledForDeletion[]= $leaves;
            $leaves->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Leavess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLeaves[] List of ChildLeaves objects
     * @phpstan-return ObjectCollection&\Traversable<ChildLeaves}> List of ChildLeaves objects
     */
    public function getLeavessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLeavesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getLeavess($query, $con);
    }

    /**
     * Clears out the collMtps collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMtps()
     */
    public function clearMtps()
    {
        $this->collMtps = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMtps collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMtps($v = true): void
    {
        $this->collMtpsPartial = $v;
    }

    /**
     * Initializes the collMtps collection.
     *
     * By default this just sets the collMtps collection to an empty array (like clearcollMtps());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMtps(bool $overrideExisting = true): void
    {
        if (null !== $this->collMtps && !$overrideExisting) {
            return;
        }

        $collectionClassName = MtpTableMap::getTableMap()->getCollectionClassName();

        $this->collMtps = new $collectionClassName;
        $this->collMtps->setModel('\entities\Mtp');
    }

    /**
     * Gets an array of ChildMtp objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp> List of ChildMtp objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtps(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMtpsPartial && !$this->isNew();
        if (null === $this->collMtps || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMtps) {
                    $this->initMtps();
                } else {
                    $collectionClassName = MtpTableMap::getTableMap()->getCollectionClassName();

                    $collMtps = new $collectionClassName;
                    $collMtps->setModel('\entities\Mtp');

                    return $collMtps;
                }
            } else {
                $collMtps = ChildMtpQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMtpsPartial && count($collMtps)) {
                        $this->initMtps(false);

                        foreach ($collMtps as $obj) {
                            if (false == $this->collMtps->contains($obj)) {
                                $this->collMtps->append($obj);
                            }
                        }

                        $this->collMtpsPartial = true;
                    }

                    return $collMtps;
                }

                if ($partial && $this->collMtps) {
                    foreach ($this->collMtps as $obj) {
                        if ($obj->isNew()) {
                            $collMtps[] = $obj;
                        }
                    }
                }

                $this->collMtps = $collMtps;
                $this->collMtpsPartial = false;
            }
        }

        return $this->collMtps;
    }

    /**
     * Sets a collection of ChildMtp objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $mtps A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMtps(Collection $mtps, ?ConnectionInterface $con = null)
    {
        /** @var ChildMtp[] $mtpsToDelete */
        $mtpsToDelete = $this->getMtps(new Criteria(), $con)->diff($mtps);


        $this->mtpsScheduledForDeletion = $mtpsToDelete;

        foreach ($mtpsToDelete as $mtpRemoved) {
            $mtpRemoved->setEmployee(null);
        }

        $this->collMtps = null;
        foreach ($mtps as $mtp) {
            $this->addMtp($mtp);
        }

        $this->collMtps = $mtps;
        $this->collMtpsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Mtp objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Mtp objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMtps(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMtpsPartial && !$this->isNew();
        if (null === $this->collMtps || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMtps) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMtps());
            }

            $query = ChildMtpQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collMtps);
    }

    /**
     * Method called to associate a ChildMtp object to this object
     * through the ChildMtp foreign key attribute.
     *
     * @param ChildMtp $l ChildMtp
     * @return $this The current object (for fluent API support)
     */
    public function addMtp(ChildMtp $l)
    {
        if ($this->collMtps === null) {
            $this->initMtps();
            $this->collMtpsPartial = true;
        }

        if (!$this->collMtps->contains($l)) {
            $this->doAddMtp($l);

            if ($this->mtpsScheduledForDeletion and $this->mtpsScheduledForDeletion->contains($l)) {
                $this->mtpsScheduledForDeletion->remove($this->mtpsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMtp $mtp The ChildMtp object to add.
     */
    protected function doAddMtp(ChildMtp $mtp): void
    {
        $this->collMtps[]= $mtp;
        $mtp->setEmployee($this);
    }

    /**
     * @param ChildMtp $mtp The ChildMtp object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMtp(ChildMtp $mtp)
    {
        if ($this->getMtps()->contains($mtp)) {
            $pos = $this->collMtps->search($mtp);
            $this->collMtps->remove($pos);
            if (null === $this->mtpsScheduledForDeletion) {
                $this->mtpsScheduledForDeletion = clone $this->collMtps;
                $this->mtpsScheduledForDeletion->clear();
            }
            $this->mtpsScheduledForDeletion[]= $mtp;
            $mtp->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Mtps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp}> List of ChildMtp objects
     */
    public function getMtpsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getMtps($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Mtps from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtp[] List of ChildMtp objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtp}> List of ChildMtp objects
     */
    public function getMtpsJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getMtps($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByApprovedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByApprovedByEmployeeId()
     */
    public function clearOnBoardRequestsRelatedByApprovedByEmployeeId()
    {
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByApprovedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByApprovedByEmployeeId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByApprovedByEmployeeId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByApprovedByEmployeeId collection to an empty array (like clearcollOnBoardRequestsRelatedByApprovedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByApprovedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByApprovedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByApprovedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByApprovedByEmployeeId) {
                    $this->initOnBoardRequestsRelatedByApprovedByEmployeeId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByApprovedByEmployeeId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByApprovedByEmployeeId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByApprovedByEmployeeId;
                }
            } else {
                $collOnBoardRequestsRelatedByApprovedByEmployeeId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByApprovedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial && count($collOnBoardRequestsRelatedByApprovedByEmployeeId)) {
                        $this->initOnBoardRequestsRelatedByApprovedByEmployeeId(false);

                        foreach ($collOnBoardRequestsRelatedByApprovedByEmployeeId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByApprovedByEmployeeId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByApprovedByEmployeeId) {
                    foreach ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByApprovedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = $collOnBoardRequestsRelatedByApprovedByEmployeeId;
                $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByApprovedByEmployeeId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByApprovedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByApprovedByEmployeeId(Collection $onBoardRequestsRelatedByApprovedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByApprovedByEmployeeIdToDelete */
        $onBoardRequestsRelatedByApprovedByEmployeeIdToDelete = $this->getOnBoardRequestsRelatedByApprovedByEmployeeId(new Criteria(), $con)->diff($onBoardRequestsRelatedByApprovedByEmployeeId);


        $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion = $onBoardRequestsRelatedByApprovedByEmployeeIdToDelete;

        foreach ($onBoardRequestsRelatedByApprovedByEmployeeIdToDelete as $onBoardRequestRelatedByApprovedByEmployeeIdRemoved) {
            $onBoardRequestRelatedByApprovedByEmployeeIdRemoved->setEmployeeRelatedByApprovedByEmployeeId(null);
        }

        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = null;
        foreach ($onBoardRequestsRelatedByApprovedByEmployeeId as $onBoardRequestRelatedByApprovedByEmployeeId) {
            $this->addOnBoardRequestRelatedByApprovedByEmployeeId($onBoardRequestRelatedByApprovedByEmployeeId);
        }

        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = $onBoardRequestsRelatedByApprovedByEmployeeId;
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByApprovedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByApprovedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByApprovedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByApprovedByEmployeeId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByApprovedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByApprovedByEmployeeId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByApprovedByEmployeeId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId === null) {
            $this->initOnBoardRequestsRelatedByApprovedByEmployeeId();
            $this->collOnBoardRequestsRelatedByApprovedByEmployeeIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByApprovedByEmployeeId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByApprovedByEmployeeId($l);

            if ($this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion and $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByApprovedByEmployeeId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByApprovedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByApprovedByEmployeeId): void
    {
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId[]= $onBoardRequestRelatedByApprovedByEmployeeId;
        $onBoardRequestRelatedByApprovedByEmployeeId->setEmployeeRelatedByApprovedByEmployeeId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByApprovedByEmployeeId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByApprovedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByApprovedByEmployeeId)
    {
        if ($this->getOnBoardRequestsRelatedByApprovedByEmployeeId()->contains($onBoardRequestRelatedByApprovedByEmployeeId)) {
            $pos = $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->search($onBoardRequestRelatedByApprovedByEmployeeId);
            $this->collOnBoardRequestsRelatedByApprovedByEmployeeId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByApprovedByEmployeeId;
                $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByApprovedByEmployeeIdScheduledForDeletion[]= $onBoardRequestRelatedByApprovedByEmployeeId;
            $onBoardRequestRelatedByApprovedByEmployeeId->setEmployeeRelatedByApprovedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByApprovedByEmployeeIdJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByApprovedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByCreatedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByCreatedByEmployeeId()
     */
    public function clearOnBoardRequestsRelatedByCreatedByEmployeeId()
    {
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByCreatedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByCreatedByEmployeeId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByCreatedByEmployeeId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByCreatedByEmployeeId collection to an empty array (like clearcollOnBoardRequestsRelatedByCreatedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByCreatedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByCreatedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByCreatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByCreatedByEmployeeId) {
                    $this->initOnBoardRequestsRelatedByCreatedByEmployeeId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByCreatedByEmployeeId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByCreatedByEmployeeId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByCreatedByEmployeeId;
                }
            } else {
                $collOnBoardRequestsRelatedByCreatedByEmployeeId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByCreatedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial && count($collOnBoardRequestsRelatedByCreatedByEmployeeId)) {
                        $this->initOnBoardRequestsRelatedByCreatedByEmployeeId(false);

                        foreach ($collOnBoardRequestsRelatedByCreatedByEmployeeId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByCreatedByEmployeeId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByCreatedByEmployeeId) {
                    foreach ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByCreatedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = $collOnBoardRequestsRelatedByCreatedByEmployeeId;
                $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByCreatedByEmployeeId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByCreatedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByCreatedByEmployeeId(Collection $onBoardRequestsRelatedByCreatedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByCreatedByEmployeeIdToDelete */
        $onBoardRequestsRelatedByCreatedByEmployeeIdToDelete = $this->getOnBoardRequestsRelatedByCreatedByEmployeeId(new Criteria(), $con)->diff($onBoardRequestsRelatedByCreatedByEmployeeId);


        $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion = $onBoardRequestsRelatedByCreatedByEmployeeIdToDelete;

        foreach ($onBoardRequestsRelatedByCreatedByEmployeeIdToDelete as $onBoardRequestRelatedByCreatedByEmployeeIdRemoved) {
            $onBoardRequestRelatedByCreatedByEmployeeIdRemoved->setEmployeeRelatedByCreatedByEmployeeId(null);
        }

        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = null;
        foreach ($onBoardRequestsRelatedByCreatedByEmployeeId as $onBoardRequestRelatedByCreatedByEmployeeId) {
            $this->addOnBoardRequestRelatedByCreatedByEmployeeId($onBoardRequestRelatedByCreatedByEmployeeId);
        }

        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = $onBoardRequestsRelatedByCreatedByEmployeeId;
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByCreatedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByCreatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByCreatedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByCreatedByEmployeeId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByCreatedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByCreatedByEmployeeId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByCreatedByEmployeeId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId === null) {
            $this->initOnBoardRequestsRelatedByCreatedByEmployeeId();
            $this->collOnBoardRequestsRelatedByCreatedByEmployeeIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByCreatedByEmployeeId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByCreatedByEmployeeId($l);

            if ($this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion and $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByCreatedByEmployeeId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByCreatedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByCreatedByEmployeeId): void
    {
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId[]= $onBoardRequestRelatedByCreatedByEmployeeId;
        $onBoardRequestRelatedByCreatedByEmployeeId->setEmployeeRelatedByCreatedByEmployeeId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByCreatedByEmployeeId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByCreatedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByCreatedByEmployeeId)
    {
        if ($this->getOnBoardRequestsRelatedByCreatedByEmployeeId()->contains($onBoardRequestRelatedByCreatedByEmployeeId)) {
            $pos = $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->search($onBoardRequestRelatedByCreatedByEmployeeId);
            $this->collOnBoardRequestsRelatedByCreatedByEmployeeId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByCreatedByEmployeeId;
                $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByCreatedByEmployeeIdScheduledForDeletion[]= $onBoardRequestRelatedByCreatedByEmployeeId;
            $onBoardRequestRelatedByCreatedByEmployeeId->setEmployeeRelatedByCreatedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByCreatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByCreatedByEmployeeIdJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByCreatedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByFinalApprovedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByFinalApprovedByEmployeeId()
     */
    public function clearOnBoardRequestsRelatedByFinalApprovedByEmployeeId()
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByFinalApprovedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByFinalApprovedByEmployeeId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByFinalApprovedByEmployeeId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByFinalApprovedByEmployeeId collection to an empty array (like clearcollOnBoardRequestsRelatedByFinalApprovedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByFinalApprovedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId) {
                    $this->initOnBoardRequestsRelatedByFinalApprovedByEmployeeId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
                }
            } else {
                $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByFinalApprovedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial && count($collOnBoardRequestsRelatedByFinalApprovedByEmployeeId)) {
                        $this->initOnBoardRequestsRelatedByFinalApprovedByEmployeeId(false);

                        foreach ($collOnBoardRequestsRelatedByFinalApprovedByEmployeeId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId) {
                    foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = $collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
                $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByFinalApprovedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByFinalApprovedByEmployeeId(Collection $onBoardRequestsRelatedByFinalApprovedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByFinalApprovedByEmployeeIdToDelete */
        $onBoardRequestsRelatedByFinalApprovedByEmployeeIdToDelete = $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId(new Criteria(), $con)->diff($onBoardRequestsRelatedByFinalApprovedByEmployeeId);


        $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion = $onBoardRequestsRelatedByFinalApprovedByEmployeeIdToDelete;

        foreach ($onBoardRequestsRelatedByFinalApprovedByEmployeeIdToDelete as $onBoardRequestRelatedByFinalApprovedByEmployeeIdRemoved) {
            $onBoardRequestRelatedByFinalApprovedByEmployeeIdRemoved->setEmployeeRelatedByFinalApprovedByEmployeeId(null);
        }

        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = null;
        foreach ($onBoardRequestsRelatedByFinalApprovedByEmployeeId as $onBoardRequestRelatedByFinalApprovedByEmployeeId) {
            $this->addOnBoardRequestRelatedByFinalApprovedByEmployeeId($onBoardRequestRelatedByFinalApprovedByEmployeeId);
        }

        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = $onBoardRequestsRelatedByFinalApprovedByEmployeeId;
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByFinalApprovedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByFinalApprovedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByFinalApprovedByEmployeeId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId === null) {
            $this->initOnBoardRequestsRelatedByFinalApprovedByEmployeeId();
            $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByFinalApprovedByEmployeeId($l);

            if ($this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion and $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByEmployeeId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByFinalApprovedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByEmployeeId): void
    {
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId[]= $onBoardRequestRelatedByFinalApprovedByEmployeeId;
        $onBoardRequestRelatedByFinalApprovedByEmployeeId->setEmployeeRelatedByFinalApprovedByEmployeeId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByEmployeeId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByFinalApprovedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByFinalApprovedByEmployeeId)
    {
        if ($this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId()->contains($onBoardRequestRelatedByFinalApprovedByEmployeeId)) {
            $pos = $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->search($onBoardRequestRelatedByFinalApprovedByEmployeeId);
            $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId;
                $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByFinalApprovedByEmployeeIdScheduledForDeletion[]= $onBoardRequestRelatedByFinalApprovedByEmployeeId;
            $onBoardRequestRelatedByFinalApprovedByEmployeeId->setEmployeeRelatedByFinalApprovedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByFinalApprovedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByFinalApprovedByEmployeeIdJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByFinalApprovedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestsRelatedByUpdatedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestsRelatedByUpdatedByEmployeeId()
     */
    public function clearOnBoardRequestsRelatedByUpdatedByEmployeeId()
    {
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestsRelatedByUpdatedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestsRelatedByUpdatedByEmployeeId($v = true): void
    {
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestsRelatedByUpdatedByEmployeeId collection.
     *
     * By default this just sets the collOnBoardRequestsRelatedByUpdatedByEmployeeId collection to an empty array (like clearcollOnBoardRequestsRelatedByUpdatedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestsRelatedByUpdatedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = new $collectionClassName;
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->setModel('\entities\OnBoardRequest');
    }

    /**
     * Gets an array of ChildOnBoardRequest objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest> List of ChildOnBoardRequest objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId) {
                    $this->initOnBoardRequestsRelatedByUpdatedByEmployeeId();
                } else {
                    $collectionClassName = OnBoardRequestTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestsRelatedByUpdatedByEmployeeId = new $collectionClassName;
                    $collOnBoardRequestsRelatedByUpdatedByEmployeeId->setModel('\entities\OnBoardRequest');

                    return $collOnBoardRequestsRelatedByUpdatedByEmployeeId;
                }
            } else {
                $collOnBoardRequestsRelatedByUpdatedByEmployeeId = ChildOnBoardRequestQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByUpdatedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial && count($collOnBoardRequestsRelatedByUpdatedByEmployeeId)) {
                        $this->initOnBoardRequestsRelatedByUpdatedByEmployeeId(false);

                        foreach ($collOnBoardRequestsRelatedByUpdatedByEmployeeId as $obj) {
                            if (false == $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->contains($obj)) {
                                $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->append($obj);
                            }
                        }

                        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial = true;
                    }

                    return $collOnBoardRequestsRelatedByUpdatedByEmployeeId;
                }

                if ($partial && $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId) {
                    foreach ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestsRelatedByUpdatedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = $collOnBoardRequestsRelatedByUpdatedByEmployeeId;
                $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial = false;
            }
        }

        return $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId;
    }

    /**
     * Sets a collection of ChildOnBoardRequest objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestsRelatedByUpdatedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestsRelatedByUpdatedByEmployeeId(Collection $onBoardRequestsRelatedByUpdatedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequest[] $onBoardRequestsRelatedByUpdatedByEmployeeIdToDelete */
        $onBoardRequestsRelatedByUpdatedByEmployeeIdToDelete = $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId(new Criteria(), $con)->diff($onBoardRequestsRelatedByUpdatedByEmployeeId);


        $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion = $onBoardRequestsRelatedByUpdatedByEmployeeIdToDelete;

        foreach ($onBoardRequestsRelatedByUpdatedByEmployeeIdToDelete as $onBoardRequestRelatedByUpdatedByEmployeeIdRemoved) {
            $onBoardRequestRelatedByUpdatedByEmployeeIdRemoved->setEmployeeRelatedByUpdatedByEmployeeId(null);
        }

        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = null;
        foreach ($onBoardRequestsRelatedByUpdatedByEmployeeId as $onBoardRequestRelatedByUpdatedByEmployeeId) {
            $this->addOnBoardRequestRelatedByUpdatedByEmployeeId($onBoardRequestRelatedByUpdatedByEmployeeId);
        }

        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = $onBoardRequestsRelatedByUpdatedByEmployeeId;
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequest objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequest objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestsRelatedByUpdatedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestsRelatedByUpdatedByEmployeeId());
            }

            $query = ChildOnBoardRequestQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByUpdatedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId);
    }

    /**
     * Method called to associate a ChildOnBoardRequest object to this object
     * through the ChildOnBoardRequest foreign key attribute.
     *
     * @param ChildOnBoardRequest $l ChildOnBoardRequest
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestRelatedByUpdatedByEmployeeId(ChildOnBoardRequest $l)
    {
        if ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId === null) {
            $this->initOnBoardRequestsRelatedByUpdatedByEmployeeId();
            $this->collOnBoardRequestsRelatedByUpdatedByEmployeeIdPartial = true;
        }

        if (!$this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->contains($l)) {
            $this->doAddOnBoardRequestRelatedByUpdatedByEmployeeId($l);

            if ($this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion and $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion->remove($this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByEmployeeId The ChildOnBoardRequest object to add.
     */
    protected function doAddOnBoardRequestRelatedByUpdatedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByEmployeeId): void
    {
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId[]= $onBoardRequestRelatedByUpdatedByEmployeeId;
        $onBoardRequestRelatedByUpdatedByEmployeeId->setEmployeeRelatedByUpdatedByEmployeeId($this);
    }

    /**
     * @param ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByEmployeeId The ChildOnBoardRequest object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestRelatedByUpdatedByEmployeeId(ChildOnBoardRequest $onBoardRequestRelatedByUpdatedByEmployeeId)
    {
        if ($this->getOnBoardRequestsRelatedByUpdatedByEmployeeId()->contains($onBoardRequestRelatedByUpdatedByEmployeeId)) {
            $pos = $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->search($onBoardRequestRelatedByUpdatedByEmployeeId);
            $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId->remove($pos);
            if (null === $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion) {
                $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion = clone $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId;
                $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->onBoardRequestsRelatedByUpdatedByEmployeeIdScheduledForDeletion[]= $onBoardRequestRelatedByUpdatedByEmployeeId;
            $onBoardRequestRelatedByUpdatedByEmployeeId->setEmployeeRelatedByUpdatedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinPositionsRelatedByApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinPositionsRelatedByCreatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByCreatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinPositionsRelatedByFinalApprovedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByFinalApprovedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinPositionsRelatedByPosition(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByPosition', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestsRelatedByUpdatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequest[] List of ChildOnBoardRequest objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequest}> List of ChildOnBoardRequest objects
     */
    public function getOnBoardRequestsRelatedByUpdatedByEmployeeIdJoinPositionsRelatedByUpdatedByPositionId(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestQuery::create(null, $criteria);
        $query->joinWith('PositionsRelatedByUpdatedByPositionId', $joinBehavior);

        return $this->getOnBoardRequestsRelatedByUpdatedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collOnBoardRequestLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestLogs()
     */
    public function clearOnBoardRequestLogs()
    {
        $this->collOnBoardRequestLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestLogs($v = true): void
    {
        $this->collOnBoardRequestLogsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestLogs collection.
     *
     * By default this just sets the collOnBoardRequestLogs collection to an empty array (like clearcollOnBoardRequestLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestLogTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestLogs = new $collectionClassName;
        $this->collOnBoardRequestLogs->setModel('\entities\OnBoardRequestLog');
    }

    /**
     * Gets an array of ChildOnBoardRequestLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog> List of ChildOnBoardRequestLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestLogsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestLogs) {
                    $this->initOnBoardRequestLogs();
                } else {
                    $collectionClassName = OnBoardRequestLogTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestLogs = new $collectionClassName;
                    $collOnBoardRequestLogs->setModel('\entities\OnBoardRequestLog');

                    return $collOnBoardRequestLogs;
                }
            } else {
                $collOnBoardRequestLogs = ChildOnBoardRequestLogQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestLogsPartial && count($collOnBoardRequestLogs)) {
                        $this->initOnBoardRequestLogs(false);

                        foreach ($collOnBoardRequestLogs as $obj) {
                            if (false == $this->collOnBoardRequestLogs->contains($obj)) {
                                $this->collOnBoardRequestLogs->append($obj);
                            }
                        }

                        $this->collOnBoardRequestLogsPartial = true;
                    }

                    return $collOnBoardRequestLogs;
                }

                if ($partial && $this->collOnBoardRequestLogs) {
                    foreach ($this->collOnBoardRequestLogs as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestLogs[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestLogs = $collOnBoardRequestLogs;
                $this->collOnBoardRequestLogsPartial = false;
            }
        }

        return $this->collOnBoardRequestLogs;
    }

    /**
     * Sets a collection of ChildOnBoardRequestLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestLogs(Collection $onBoardRequestLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestLog[] $onBoardRequestLogsToDelete */
        $onBoardRequestLogsToDelete = $this->getOnBoardRequestLogs(new Criteria(), $con)->diff($onBoardRequestLogs);


        $this->onBoardRequestLogsScheduledForDeletion = $onBoardRequestLogsToDelete;

        foreach ($onBoardRequestLogsToDelete as $onBoardRequestLogRemoved) {
            $onBoardRequestLogRemoved->setEmployee(null);
        }

        $this->collOnBoardRequestLogs = null;
        foreach ($onBoardRequestLogs as $onBoardRequestLog) {
            $this->addOnBoardRequestLog($onBoardRequestLog);
        }

        $this->collOnBoardRequestLogs = $onBoardRequestLogs;
        $this->collOnBoardRequestLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestLogsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestLogs());
            }

            $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestLogs);
    }

    /**
     * Method called to associate a ChildOnBoardRequestLog object to this object
     * through the ChildOnBoardRequestLog foreign key attribute.
     *
     * @param ChildOnBoardRequestLog $l ChildOnBoardRequestLog
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestLog(ChildOnBoardRequestLog $l)
    {
        if ($this->collOnBoardRequestLogs === null) {
            $this->initOnBoardRequestLogs();
            $this->collOnBoardRequestLogsPartial = true;
        }

        if (!$this->collOnBoardRequestLogs->contains($l)) {
            $this->doAddOnBoardRequestLog($l);

            if ($this->onBoardRequestLogsScheduledForDeletion and $this->onBoardRequestLogsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestLogsScheduledForDeletion->remove($this->onBoardRequestLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestLog $onBoardRequestLog The ChildOnBoardRequestLog object to add.
     */
    protected function doAddOnBoardRequestLog(ChildOnBoardRequestLog $onBoardRequestLog): void
    {
        $this->collOnBoardRequestLogs[]= $onBoardRequestLog;
        $onBoardRequestLog->setEmployee($this);
    }

    /**
     * @param ChildOnBoardRequestLog $onBoardRequestLog The ChildOnBoardRequestLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestLog(ChildOnBoardRequestLog $onBoardRequestLog)
    {
        if ($this->getOnBoardRequestLogs()->contains($onBoardRequestLog)) {
            $pos = $this->collOnBoardRequestLogs->search($onBoardRequestLog);
            $this->collOnBoardRequestLogs->remove($pos);
            if (null === $this->onBoardRequestLogsScheduledForDeletion) {
                $this->onBoardRequestLogsScheduledForDeletion = clone $this->collOnBoardRequestLogs;
                $this->onBoardRequestLogsScheduledForDeletion->clear();
            }
            $this->onBoardRequestLogsScheduledForDeletion[]= $onBoardRequestLog;
            $onBoardRequestLog->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog}> List of ChildOnBoardRequestLog objects
     */
    public function getOnBoardRequestLogsJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getOnBoardRequestLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog}> List of ChildOnBoardRequestLog objects
     */
    public function getOnBoardRequestLogsJoinOnBoardRequest(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
        $query->joinWith('OnBoardRequest', $joinBehavior);

        return $this->getOnBoardRequestLogs($query, $con);
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderss($v = true): void
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\entities\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\entities\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setEmployee(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Orders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param ChildOrders $l ChildOrders
     * @return $this The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders): void
    {
        $this->collOrderss[]= $orders;
        $orders->setEmployee($this);
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= $orders;
            $orders->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletFrom(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletFrom', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOutletsRelatedByOutletTo(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OutletsRelatedByOutletTo', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinTerritories(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Territories', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOrderss($query, $con);
    }

    /**
     * Clears out the collOtpRequestss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOtpRequestss()
     */
    public function clearOtpRequestss()
    {
        $this->collOtpRequestss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOtpRequestss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOtpRequestss($v = true): void
    {
        $this->collOtpRequestssPartial = $v;
    }

    /**
     * Initializes the collOtpRequestss collection.
     *
     * By default this just sets the collOtpRequestss collection to an empty array (like clearcollOtpRequestss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOtpRequestss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOtpRequestss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OtpRequestsTableMap::getTableMap()->getCollectionClassName();

        $this->collOtpRequestss = new $collectionClassName;
        $this->collOtpRequestss->setModel('\entities\OtpRequests');
    }

    /**
     * Gets an array of ChildOtpRequests objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOtpRequests[] List of ChildOtpRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOtpRequests> List of ChildOtpRequests objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOtpRequestss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOtpRequestssPartial && !$this->isNew();
        if (null === $this->collOtpRequestss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOtpRequestss) {
                    $this->initOtpRequestss();
                } else {
                    $collectionClassName = OtpRequestsTableMap::getTableMap()->getCollectionClassName();

                    $collOtpRequestss = new $collectionClassName;
                    $collOtpRequestss->setModel('\entities\OtpRequests');

                    return $collOtpRequestss;
                }
            } else {
                $collOtpRequestss = ChildOtpRequestsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOtpRequestssPartial && count($collOtpRequestss)) {
                        $this->initOtpRequestss(false);

                        foreach ($collOtpRequestss as $obj) {
                            if (false == $this->collOtpRequestss->contains($obj)) {
                                $this->collOtpRequestss->append($obj);
                            }
                        }

                        $this->collOtpRequestssPartial = true;
                    }

                    return $collOtpRequestss;
                }

                if ($partial && $this->collOtpRequestss) {
                    foreach ($this->collOtpRequestss as $obj) {
                        if ($obj->isNew()) {
                            $collOtpRequestss[] = $obj;
                        }
                    }
                }

                $this->collOtpRequestss = $collOtpRequestss;
                $this->collOtpRequestssPartial = false;
            }
        }

        return $this->collOtpRequestss;
    }

    /**
     * Sets a collection of ChildOtpRequests objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $otpRequestss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOtpRequestss(Collection $otpRequestss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOtpRequests[] $otpRequestssToDelete */
        $otpRequestssToDelete = $this->getOtpRequestss(new Criteria(), $con)->diff($otpRequestss);


        $this->otpRequestssScheduledForDeletion = $otpRequestssToDelete;

        foreach ($otpRequestssToDelete as $otpRequestsRemoved) {
            $otpRequestsRemoved->setEmployee(null);
        }

        $this->collOtpRequestss = null;
        foreach ($otpRequestss as $otpRequests) {
            $this->addOtpRequests($otpRequests);
        }

        $this->collOtpRequestss = $otpRequestss;
        $this->collOtpRequestssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OtpRequests objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OtpRequests objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOtpRequestss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOtpRequestssPartial && !$this->isNew();
        if (null === $this->collOtpRequestss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOtpRequestss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOtpRequestss());
            }

            $query = ChildOtpRequestsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collOtpRequestss);
    }

    /**
     * Method called to associate a ChildOtpRequests object to this object
     * through the ChildOtpRequests foreign key attribute.
     *
     * @param ChildOtpRequests $l ChildOtpRequests
     * @return $this The current object (for fluent API support)
     */
    public function addOtpRequests(ChildOtpRequests $l)
    {
        if ($this->collOtpRequestss === null) {
            $this->initOtpRequestss();
            $this->collOtpRequestssPartial = true;
        }

        if (!$this->collOtpRequestss->contains($l)) {
            $this->doAddOtpRequests($l);

            if ($this->otpRequestssScheduledForDeletion and $this->otpRequestssScheduledForDeletion->contains($l)) {
                $this->otpRequestssScheduledForDeletion->remove($this->otpRequestssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOtpRequests $otpRequests The ChildOtpRequests object to add.
     */
    protected function doAddOtpRequests(ChildOtpRequests $otpRequests): void
    {
        $this->collOtpRequestss[]= $otpRequests;
        $otpRequests->setEmployee($this);
    }

    /**
     * @param ChildOtpRequests $otpRequests The ChildOtpRequests object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOtpRequests(ChildOtpRequests $otpRequests)
    {
        if ($this->getOtpRequestss()->contains($otpRequests)) {
            $pos = $this->collOtpRequestss->search($otpRequests);
            $this->collOtpRequestss->remove($pos);
            if (null === $this->otpRequestssScheduledForDeletion) {
                $this->otpRequestssScheduledForDeletion = clone $this->collOtpRequestss;
                $this->otpRequestssScheduledForDeletion->clear();
            }
            $this->otpRequestssScheduledForDeletion[]= clone $otpRequests;
            $otpRequests->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related OtpRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOtpRequests[] List of ChildOtpRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOtpRequests}> List of ChildOtpRequests objects
     */
    public function getOtpRequestssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOtpRequestsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOtpRequestss($query, $con);
    }

    /**
     * Clears out the collOutletss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletss()
     */
    public function clearOutletss()
    {
        $this->collOutletss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletss($v = true): void
    {
        $this->collOutletssPartial = $v;
    }

    /**
     * Initializes the collOutletss collection.
     *
     * By default this just sets the collOutletss collection to an empty array (like clearcollOutletss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletss = new $collectionClassName;
        $this->collOutletss->setModel('\entities\Outlets');
    }

    /**
     * Gets an array of ChildOutlets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets> List of ChildOutlets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletss) {
                    $this->initOutletss();
                } else {
                    $collectionClassName = OutletsTableMap::getTableMap()->getCollectionClassName();

                    $collOutletss = new $collectionClassName;
                    $collOutletss->setModel('\entities\Outlets');

                    return $collOutletss;
                }
            } else {
                $collOutletss = ChildOutletsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletssPartial && count($collOutletss)) {
                        $this->initOutletss(false);

                        foreach ($collOutletss as $obj) {
                            if (false == $this->collOutletss->contains($obj)) {
                                $this->collOutletss->append($obj);
                            }
                        }

                        $this->collOutletssPartial = true;
                    }

                    return $collOutletss;
                }

                if ($partial && $this->collOutletss) {
                    foreach ($this->collOutletss as $obj) {
                        if ($obj->isNew()) {
                            $collOutletss[] = $obj;
                        }
                    }
                }

                $this->collOutletss = $collOutletss;
                $this->collOutletssPartial = false;
            }
        }

        return $this->collOutletss;
    }

    /**
     * Sets a collection of ChildOutlets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletss(Collection $outletss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutlets[] $outletssToDelete */
        $outletssToDelete = $this->getOutletss(new Criteria(), $con)->diff($outletss);


        $this->outletssScheduledForDeletion = $outletssToDelete;

        foreach ($outletssToDelete as $outletsRemoved) {
            $outletsRemoved->setEmployee(null);
        }

        $this->collOutletss = null;
        foreach ($outletss as $outlets) {
            $this->addOutlets($outlets);
        }

        $this->collOutletss = $outletss;
        $this->collOutletssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Outlets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Outlets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletssPartial && !$this->isNew();
        if (null === $this->collOutletss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletss());
            }

            $query = ChildOutletsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collOutletss);
    }

    /**
     * Method called to associate a ChildOutlets object to this object
     * through the ChildOutlets foreign key attribute.
     *
     * @param ChildOutlets $l ChildOutlets
     * @return $this The current object (for fluent API support)
     */
    public function addOutlets(ChildOutlets $l)
    {
        if ($this->collOutletss === null) {
            $this->initOutletss();
            $this->collOutletssPartial = true;
        }

        if (!$this->collOutletss->contains($l)) {
            $this->doAddOutlets($l);

            if ($this->outletssScheduledForDeletion and $this->outletssScheduledForDeletion->contains($l)) {
                $this->outletssScheduledForDeletion->remove($this->outletssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to add.
     */
    protected function doAddOutlets(ChildOutlets $outlets): void
    {
        $this->collOutletss[]= $outlets;
        $outlets->setEmployee($this);
    }

    /**
     * @param ChildOutlets $outlets The ChildOutlets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutlets(ChildOutlets $outlets)
    {
        if ($this->getOutletss()->contains($outlets)) {
            $pos = $this->collOutletss->search($outlets);
            $this->collOutletss->remove($pos);
            if (null === $this->outletssScheduledForDeletion) {
                $this->outletssScheduledForDeletion = clone $this->collOutletss;
                $this->outletssScheduledForDeletion->clear();
            }
            $this->outletssScheduledForDeletion[]= $outlets;
            $outlets->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOutletss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Outletss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutlets[] List of ChildOutlets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutlets}> List of ChildOutlets objects
     */
    public function getOutletssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletsQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOutletss($query, $con);
    }

    /**
     * Clears out the collReminderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addReminderss()
     */
    public function clearReminderss()
    {
        $this->collReminderss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collReminderss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialReminderss($v = true): void
    {
        $this->collReminderssPartial = $v;
    }

    /**
     * Initializes the collReminderss collection.
     *
     * By default this just sets the collReminderss collection to an empty array (like clearcollReminderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReminderss(bool $overrideExisting = true): void
    {
        if (null !== $this->collReminderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = RemindersTableMap::getTableMap()->getCollectionClassName();

        $this->collReminderss = new $collectionClassName;
        $this->collReminderss->setModel('\entities\Reminders');
    }

    /**
     * Gets an array of ChildReminders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders> List of ChildReminders objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getReminderss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collReminderssPartial && !$this->isNew();
        if (null === $this->collReminderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReminderss) {
                    $this->initReminderss();
                } else {
                    $collectionClassName = RemindersTableMap::getTableMap()->getCollectionClassName();

                    $collReminderss = new $collectionClassName;
                    $collReminderss->setModel('\entities\Reminders');

                    return $collReminderss;
                }
            } else {
                $collReminderss = ChildRemindersQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReminderssPartial && count($collReminderss)) {
                        $this->initReminderss(false);

                        foreach ($collReminderss as $obj) {
                            if (false == $this->collReminderss->contains($obj)) {
                                $this->collReminderss->append($obj);
                            }
                        }

                        $this->collReminderssPartial = true;
                    }

                    return $collReminderss;
                }

                if ($partial && $this->collReminderss) {
                    foreach ($this->collReminderss as $obj) {
                        if ($obj->isNew()) {
                            $collReminderss[] = $obj;
                        }
                    }
                }

                $this->collReminderss = $collReminderss;
                $this->collReminderssPartial = false;
            }
        }

        return $this->collReminderss;
    }

    /**
     * Sets a collection of ChildReminders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $reminderss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setReminderss(Collection $reminderss, ?ConnectionInterface $con = null)
    {
        /** @var ChildReminders[] $reminderssToDelete */
        $reminderssToDelete = $this->getReminderss(new Criteria(), $con)->diff($reminderss);


        $this->reminderssScheduledForDeletion = $reminderssToDelete;

        foreach ($reminderssToDelete as $remindersRemoved) {
            $remindersRemoved->setEmployee(null);
        }

        $this->collReminderss = null;
        foreach ($reminderss as $reminders) {
            $this->addReminders($reminders);
        }

        $this->collReminderss = $reminderss;
        $this->collReminderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reminders objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Reminders objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countReminderss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collReminderssPartial && !$this->isNew();
        if (null === $this->collReminderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReminderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReminderss());
            }

            $query = ChildRemindersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collReminderss);
    }

    /**
     * Method called to associate a ChildReminders object to this object
     * through the ChildReminders foreign key attribute.
     *
     * @param ChildReminders $l ChildReminders
     * @return $this The current object (for fluent API support)
     */
    public function addReminders(ChildReminders $l)
    {
        if ($this->collReminderss === null) {
            $this->initReminderss();
            $this->collReminderssPartial = true;
        }

        if (!$this->collReminderss->contains($l)) {
            $this->doAddReminders($l);

            if ($this->reminderssScheduledForDeletion and $this->reminderssScheduledForDeletion->contains($l)) {
                $this->reminderssScheduledForDeletion->remove($this->reminderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReminders $reminders The ChildReminders object to add.
     */
    protected function doAddReminders(ChildReminders $reminders): void
    {
        $this->collReminderss[]= $reminders;
        $reminders->setEmployee($this);
    }

    /**
     * @param ChildReminders $reminders The ChildReminders object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeReminders(ChildReminders $reminders)
    {
        if ($this->getReminderss()->contains($reminders)) {
            $pos = $this->collReminderss->search($reminders);
            $this->collReminderss->remove($pos);
            if (null === $this->reminderssScheduledForDeletion) {
                $this->reminderssScheduledForDeletion = clone $this->collReminderss;
                $this->reminderssScheduledForDeletion->clear();
            }
            $this->reminderssScheduledForDeletion[]= clone $reminders;
            $reminders->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Reminderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders}> List of ChildReminders objects
     */
    public function getReminderssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRemindersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getReminderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Reminderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReminders[] List of ChildReminders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReminders}> List of ChildReminders objects
     */
    public function getReminderssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRemindersQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getReminderss($query, $con);
    }

    /**
     * Clears out the collSalaryAttendanceBackdateTrackLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSalaryAttendanceBackdateTrackLogs()
     */
    public function clearSalaryAttendanceBackdateTrackLogs()
    {
        $this->collSalaryAttendanceBackdateTrackLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSalaryAttendanceBackdateTrackLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSalaryAttendanceBackdateTrackLogs($v = true): void
    {
        $this->collSalaryAttendanceBackdateTrackLogsPartial = $v;
    }

    /**
     * Initializes the collSalaryAttendanceBackdateTrackLogs collection.
     *
     * By default this just sets the collSalaryAttendanceBackdateTrackLogs collection to an empty array (like clearcollSalaryAttendanceBackdateTrackLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSalaryAttendanceBackdateTrackLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collSalaryAttendanceBackdateTrackLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = SalaryAttendanceBackdateTrackLogTableMap::getTableMap()->getCollectionClassName();

        $this->collSalaryAttendanceBackdateTrackLogs = new $collectionClassName;
        $this->collSalaryAttendanceBackdateTrackLogs->setModel('\entities\SalaryAttendanceBackdateTrackLog');
    }

    /**
     * Gets an array of ChildSalaryAttendanceBackdateTrackLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSalaryAttendanceBackdateTrackLog[] List of ChildSalaryAttendanceBackdateTrackLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSalaryAttendanceBackdateTrackLog> List of ChildSalaryAttendanceBackdateTrackLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalaryAttendanceBackdateTrackLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSalaryAttendanceBackdateTrackLogsPartial && !$this->isNew();
        if (null === $this->collSalaryAttendanceBackdateTrackLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSalaryAttendanceBackdateTrackLogs) {
                    $this->initSalaryAttendanceBackdateTrackLogs();
                } else {
                    $collectionClassName = SalaryAttendanceBackdateTrackLogTableMap::getTableMap()->getCollectionClassName();

                    $collSalaryAttendanceBackdateTrackLogs = new $collectionClassName;
                    $collSalaryAttendanceBackdateTrackLogs->setModel('\entities\SalaryAttendanceBackdateTrackLog');

                    return $collSalaryAttendanceBackdateTrackLogs;
                }
            } else {
                $collSalaryAttendanceBackdateTrackLogs = ChildSalaryAttendanceBackdateTrackLogQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSalaryAttendanceBackdateTrackLogsPartial && count($collSalaryAttendanceBackdateTrackLogs)) {
                        $this->initSalaryAttendanceBackdateTrackLogs(false);

                        foreach ($collSalaryAttendanceBackdateTrackLogs as $obj) {
                            if (false == $this->collSalaryAttendanceBackdateTrackLogs->contains($obj)) {
                                $this->collSalaryAttendanceBackdateTrackLogs->append($obj);
                            }
                        }

                        $this->collSalaryAttendanceBackdateTrackLogsPartial = true;
                    }

                    return $collSalaryAttendanceBackdateTrackLogs;
                }

                if ($partial && $this->collSalaryAttendanceBackdateTrackLogs) {
                    foreach ($this->collSalaryAttendanceBackdateTrackLogs as $obj) {
                        if ($obj->isNew()) {
                            $collSalaryAttendanceBackdateTrackLogs[] = $obj;
                        }
                    }
                }

                $this->collSalaryAttendanceBackdateTrackLogs = $collSalaryAttendanceBackdateTrackLogs;
                $this->collSalaryAttendanceBackdateTrackLogsPartial = false;
            }
        }

        return $this->collSalaryAttendanceBackdateTrackLogs;
    }

    /**
     * Sets a collection of ChildSalaryAttendanceBackdateTrackLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $salaryAttendanceBackdateTrackLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSalaryAttendanceBackdateTrackLogs(Collection $salaryAttendanceBackdateTrackLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildSalaryAttendanceBackdateTrackLog[] $salaryAttendanceBackdateTrackLogsToDelete */
        $salaryAttendanceBackdateTrackLogsToDelete = $this->getSalaryAttendanceBackdateTrackLogs(new Criteria(), $con)->diff($salaryAttendanceBackdateTrackLogs);


        $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion = $salaryAttendanceBackdateTrackLogsToDelete;

        foreach ($salaryAttendanceBackdateTrackLogsToDelete as $salaryAttendanceBackdateTrackLogRemoved) {
            $salaryAttendanceBackdateTrackLogRemoved->setEmployee(null);
        }

        $this->collSalaryAttendanceBackdateTrackLogs = null;
        foreach ($salaryAttendanceBackdateTrackLogs as $salaryAttendanceBackdateTrackLog) {
            $this->addSalaryAttendanceBackdateTrackLog($salaryAttendanceBackdateTrackLog);
        }

        $this->collSalaryAttendanceBackdateTrackLogs = $salaryAttendanceBackdateTrackLogs;
        $this->collSalaryAttendanceBackdateTrackLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SalaryAttendanceBackdateTrackLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SalaryAttendanceBackdateTrackLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSalaryAttendanceBackdateTrackLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSalaryAttendanceBackdateTrackLogsPartial && !$this->isNew();
        if (null === $this->collSalaryAttendanceBackdateTrackLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSalaryAttendanceBackdateTrackLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSalaryAttendanceBackdateTrackLogs());
            }

            $query = ChildSalaryAttendanceBackdateTrackLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collSalaryAttendanceBackdateTrackLogs);
    }

    /**
     * Method called to associate a ChildSalaryAttendanceBackdateTrackLog object to this object
     * through the ChildSalaryAttendanceBackdateTrackLog foreign key attribute.
     *
     * @param ChildSalaryAttendanceBackdateTrackLog $l ChildSalaryAttendanceBackdateTrackLog
     * @return $this The current object (for fluent API support)
     */
    public function addSalaryAttendanceBackdateTrackLog(ChildSalaryAttendanceBackdateTrackLog $l)
    {
        if ($this->collSalaryAttendanceBackdateTrackLogs === null) {
            $this->initSalaryAttendanceBackdateTrackLogs();
            $this->collSalaryAttendanceBackdateTrackLogsPartial = true;
        }

        if (!$this->collSalaryAttendanceBackdateTrackLogs->contains($l)) {
            $this->doAddSalaryAttendanceBackdateTrackLog($l);

            if ($this->salaryAttendanceBackdateTrackLogsScheduledForDeletion and $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->contains($l)) {
                $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->remove($this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSalaryAttendanceBackdateTrackLog $salaryAttendanceBackdateTrackLog The ChildSalaryAttendanceBackdateTrackLog object to add.
     */
    protected function doAddSalaryAttendanceBackdateTrackLog(ChildSalaryAttendanceBackdateTrackLog $salaryAttendanceBackdateTrackLog): void
    {
        $this->collSalaryAttendanceBackdateTrackLogs[]= $salaryAttendanceBackdateTrackLog;
        $salaryAttendanceBackdateTrackLog->setEmployee($this);
    }

    /**
     * @param ChildSalaryAttendanceBackdateTrackLog $salaryAttendanceBackdateTrackLog The ChildSalaryAttendanceBackdateTrackLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSalaryAttendanceBackdateTrackLog(ChildSalaryAttendanceBackdateTrackLog $salaryAttendanceBackdateTrackLog)
    {
        if ($this->getSalaryAttendanceBackdateTrackLogs()->contains($salaryAttendanceBackdateTrackLog)) {
            $pos = $this->collSalaryAttendanceBackdateTrackLogs->search($salaryAttendanceBackdateTrackLog);
            $this->collSalaryAttendanceBackdateTrackLogs->remove($pos);
            if (null === $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion) {
                $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion = clone $this->collSalaryAttendanceBackdateTrackLogs;
                $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion->clear();
            }
            $this->salaryAttendanceBackdateTrackLogsScheduledForDeletion[]= clone $salaryAttendanceBackdateTrackLog;
            $salaryAttendanceBackdateTrackLog->setEmployee(null);
        }

        return $this;
    }

    /**
     * Clears out the collSurveySubmiteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveySubmiteds()
     */
    public function clearSurveySubmiteds()
    {
        $this->collSurveySubmiteds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveySubmiteds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveySubmiteds($v = true): void
    {
        $this->collSurveySubmitedsPartial = $v;
    }

    /**
     * Initializes the collSurveySubmiteds collection.
     *
     * By default this just sets the collSurveySubmiteds collection to an empty array (like clearcollSurveySubmiteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveySubmiteds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveySubmiteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveySubmiteds = new $collectionClassName;
        $this->collSurveySubmiteds->setModel('\entities\SurveySubmited');
    }

    /**
     * Gets an array of ChildSurveySubmited objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited> List of ChildSurveySubmited objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveySubmiteds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveySubmiteds) {
                    $this->initSurveySubmiteds();
                } else {
                    $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

                    $collSurveySubmiteds = new $collectionClassName;
                    $collSurveySubmiteds->setModel('\entities\SurveySubmited');

                    return $collSurveySubmiteds;
                }
            } else {
                $collSurveySubmiteds = ChildSurveySubmitedQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveySubmitedsPartial && count($collSurveySubmiteds)) {
                        $this->initSurveySubmiteds(false);

                        foreach ($collSurveySubmiteds as $obj) {
                            if (false == $this->collSurveySubmiteds->contains($obj)) {
                                $this->collSurveySubmiteds->append($obj);
                            }
                        }

                        $this->collSurveySubmitedsPartial = true;
                    }

                    return $collSurveySubmiteds;
                }

                if ($partial && $this->collSurveySubmiteds) {
                    foreach ($this->collSurveySubmiteds as $obj) {
                        if ($obj->isNew()) {
                            $collSurveySubmiteds[] = $obj;
                        }
                    }
                }

                $this->collSurveySubmiteds = $collSurveySubmiteds;
                $this->collSurveySubmitedsPartial = false;
            }
        }

        return $this->collSurveySubmiteds;
    }

    /**
     * Sets a collection of ChildSurveySubmited objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveySubmiteds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveySubmiteds(Collection $surveySubmiteds, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveySubmited[] $surveySubmitedsToDelete */
        $surveySubmitedsToDelete = $this->getSurveySubmiteds(new Criteria(), $con)->diff($surveySubmiteds);


        $this->surveySubmitedsScheduledForDeletion = $surveySubmitedsToDelete;

        foreach ($surveySubmitedsToDelete as $surveySubmitedRemoved) {
            $surveySubmitedRemoved->setEmployee(null);
        }

        $this->collSurveySubmiteds = null;
        foreach ($surveySubmiteds as $surveySubmited) {
            $this->addSurveySubmited($surveySubmited);
        }

        $this->collSurveySubmiteds = $surveySubmiteds;
        $this->collSurveySubmitedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveySubmited objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveySubmited objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveySubmiteds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveySubmiteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveySubmiteds());
            }

            $query = ChildSurveySubmitedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collSurveySubmiteds);
    }

    /**
     * Method called to associate a ChildSurveySubmited object to this object
     * through the ChildSurveySubmited foreign key attribute.
     *
     * @param ChildSurveySubmited $l ChildSurveySubmited
     * @return $this The current object (for fluent API support)
     */
    public function addSurveySubmited(ChildSurveySubmited $l)
    {
        if ($this->collSurveySubmiteds === null) {
            $this->initSurveySubmiteds();
            $this->collSurveySubmitedsPartial = true;
        }

        if (!$this->collSurveySubmiteds->contains($l)) {
            $this->doAddSurveySubmited($l);

            if ($this->surveySubmitedsScheduledForDeletion and $this->surveySubmitedsScheduledForDeletion->contains($l)) {
                $this->surveySubmitedsScheduledForDeletion->remove($this->surveySubmitedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to add.
     */
    protected function doAddSurveySubmited(ChildSurveySubmited $surveySubmited): void
    {
        $this->collSurveySubmiteds[]= $surveySubmited;
        $surveySubmited->setEmployee($this);
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveySubmited(ChildSurveySubmited $surveySubmited)
    {
        if ($this->getSurveySubmiteds()->contains($surveySubmited)) {
            $pos = $this->collSurveySubmiteds->search($surveySubmited);
            $this->collSurveySubmiteds->remove($pos);
            if (null === $this->surveySubmitedsScheduledForDeletion) {
                $this->surveySubmitedsScheduledForDeletion = clone $this->collSurveySubmiteds;
                $this->surveySubmitedsScheduledForDeletion->clear();
            }
            $this->surveySubmitedsScheduledForDeletion[]= $surveySubmited;
            $surveySubmited->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinDailycalls(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Dailycalls', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }

    /**
     * Clears out the collTicketRepliess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketRepliess()
     */
    public function clearTicketRepliess()
    {
        $this->collTicketRepliess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketRepliess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketRepliess($v = true): void
    {
        $this->collTicketRepliessPartial = $v;
    }

    /**
     * Initializes the collTicketRepliess collection.
     *
     * By default this just sets the collTicketRepliess collection to an empty array (like clearcollTicketRepliess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketRepliess(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketRepliess && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketRepliesTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketRepliess = new $collectionClassName;
        $this->collTicketRepliess->setModel('\entities\TicketReplies');
    }

    /**
     * Gets an array of ChildTicketReplies objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies> List of ChildTicketReplies objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketRepliess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketRepliessPartial && !$this->isNew();
        if (null === $this->collTicketRepliess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketRepliess) {
                    $this->initTicketRepliess();
                } else {
                    $collectionClassName = TicketRepliesTableMap::getTableMap()->getCollectionClassName();

                    $collTicketRepliess = new $collectionClassName;
                    $collTicketRepliess->setModel('\entities\TicketReplies');

                    return $collTicketRepliess;
                }
            } else {
                $collTicketRepliess = ChildTicketRepliesQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketRepliessPartial && count($collTicketRepliess)) {
                        $this->initTicketRepliess(false);

                        foreach ($collTicketRepliess as $obj) {
                            if (false == $this->collTicketRepliess->contains($obj)) {
                                $this->collTicketRepliess->append($obj);
                            }
                        }

                        $this->collTicketRepliessPartial = true;
                    }

                    return $collTicketRepliess;
                }

                if ($partial && $this->collTicketRepliess) {
                    foreach ($this->collTicketRepliess as $obj) {
                        if ($obj->isNew()) {
                            $collTicketRepliess[] = $obj;
                        }
                    }
                }

                $this->collTicketRepliess = $collTicketRepliess;
                $this->collTicketRepliessPartial = false;
            }
        }

        return $this->collTicketRepliess;
    }

    /**
     * Sets a collection of ChildTicketReplies objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketRepliess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketRepliess(Collection $ticketRepliess, ?ConnectionInterface $con = null)
    {
        /** @var ChildTicketReplies[] $ticketRepliessToDelete */
        $ticketRepliessToDelete = $this->getTicketRepliess(new Criteria(), $con)->diff($ticketRepliess);


        $this->ticketRepliessScheduledForDeletion = $ticketRepliessToDelete;

        foreach ($ticketRepliessToDelete as $ticketRepliesRemoved) {
            $ticketRepliesRemoved->setEmployee(null);
        }

        $this->collTicketRepliess = null;
        foreach ($ticketRepliess as $ticketReplies) {
            $this->addTicketReplies($ticketReplies);
        }

        $this->collTicketRepliess = $ticketRepliess;
        $this->collTicketRepliessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TicketReplies objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related TicketReplies objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketRepliess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketRepliessPartial && !$this->isNew();
        if (null === $this->collTicketRepliess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketRepliess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketRepliess());
            }

            $query = ChildTicketRepliesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collTicketRepliess);
    }

    /**
     * Method called to associate a ChildTicketReplies object to this object
     * through the ChildTicketReplies foreign key attribute.
     *
     * @param ChildTicketReplies $l ChildTicketReplies
     * @return $this The current object (for fluent API support)
     */
    public function addTicketReplies(ChildTicketReplies $l)
    {
        if ($this->collTicketRepliess === null) {
            $this->initTicketRepliess();
            $this->collTicketRepliessPartial = true;
        }

        if (!$this->collTicketRepliess->contains($l)) {
            $this->doAddTicketReplies($l);

            if ($this->ticketRepliessScheduledForDeletion and $this->ticketRepliessScheduledForDeletion->contains($l)) {
                $this->ticketRepliessScheduledForDeletion->remove($this->ticketRepliessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTicketReplies $ticketReplies The ChildTicketReplies object to add.
     */
    protected function doAddTicketReplies(ChildTicketReplies $ticketReplies): void
    {
        $this->collTicketRepliess[]= $ticketReplies;
        $ticketReplies->setEmployee($this);
    }

    /**
     * @param ChildTicketReplies $ticketReplies The ChildTicketReplies object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTicketReplies(ChildTicketReplies $ticketReplies)
    {
        if ($this->getTicketRepliess()->contains($ticketReplies)) {
            $pos = $this->collTicketRepliess->search($ticketReplies);
            $this->collTicketRepliess->remove($pos);
            if (null === $this->ticketRepliessScheduledForDeletion) {
                $this->ticketRepliessScheduledForDeletion = clone $this->collTicketRepliess;
                $this->ticketRepliessScheduledForDeletion->clear();
            }
            $this->ticketRepliessScheduledForDeletion[]= clone $ticketReplies;
            $ticketReplies->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketRepliess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies}> List of ChildTicketReplies objects
     */
    public function getTicketRepliessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketRepliesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketRepliess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketRepliess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTicketReplies[] List of ChildTicketReplies objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketReplies}> List of ChildTicketReplies objects
     */
    public function getTicketRepliessJoinTickets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketRepliesQuery::create(null, $criteria);
        $query->joinWith('Tickets', $joinBehavior);

        return $this->getTicketRepliess($query, $con);
    }

    /**
     * Clears out the collTicketTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketTypes()
     */
    public function clearTicketTypes()
    {
        $this->collTicketTypes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketTypes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketTypes($v = true): void
    {
        $this->collTicketTypesPartial = $v;
    }

    /**
     * Initializes the collTicketTypes collection.
     *
     * By default this just sets the collTicketTypes collection to an empty array (like clearcollTicketTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketTypes(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketTypes = new $collectionClassName;
        $this->collTicketTypes->setModel('\entities\TicketType');
    }

    /**
     * Gets an array of ChildTicketType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTicketType[] List of ChildTicketType objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketType> List of ChildTicketType objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketTypesPartial && !$this->isNew();
        if (null === $this->collTicketTypes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketTypes) {
                    $this->initTicketTypes();
                } else {
                    $collectionClassName = TicketTypeTableMap::getTableMap()->getCollectionClassName();

                    $collTicketTypes = new $collectionClassName;
                    $collTicketTypes->setModel('\entities\TicketType');

                    return $collTicketTypes;
                }
            } else {
                $collTicketTypes = ChildTicketTypeQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketTypesPartial && count($collTicketTypes)) {
                        $this->initTicketTypes(false);

                        foreach ($collTicketTypes as $obj) {
                            if (false == $this->collTicketTypes->contains($obj)) {
                                $this->collTicketTypes->append($obj);
                            }
                        }

                        $this->collTicketTypesPartial = true;
                    }

                    return $collTicketTypes;
                }

                if ($partial && $this->collTicketTypes) {
                    foreach ($this->collTicketTypes as $obj) {
                        if ($obj->isNew()) {
                            $collTicketTypes[] = $obj;
                        }
                    }
                }

                $this->collTicketTypes = $collTicketTypes;
                $this->collTicketTypesPartial = false;
            }
        }

        return $this->collTicketTypes;
    }

    /**
     * Sets a collection of ChildTicketType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketTypes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketTypes(Collection $ticketTypes, ?ConnectionInterface $con = null)
    {
        /** @var ChildTicketType[] $ticketTypesToDelete */
        $ticketTypesToDelete = $this->getTicketTypes(new Criteria(), $con)->diff($ticketTypes);


        $this->ticketTypesScheduledForDeletion = $ticketTypesToDelete;

        foreach ($ticketTypesToDelete as $ticketTypeRemoved) {
            $ticketTypeRemoved->setEmployee(null);
        }

        $this->collTicketTypes = null;
        foreach ($ticketTypes as $ticketType) {
            $this->addTicketType($ticketType);
        }

        $this->collTicketTypes = $ticketTypes;
        $this->collTicketTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TicketType objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related TicketType objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketTypes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketTypesPartial && !$this->isNew();
        if (null === $this->collTicketTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketTypes());
            }

            $query = ChildTicketTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collTicketTypes);
    }

    /**
     * Method called to associate a ChildTicketType object to this object
     * through the ChildTicketType foreign key attribute.
     *
     * @param ChildTicketType $l ChildTicketType
     * @return $this The current object (for fluent API support)
     */
    public function addTicketType(ChildTicketType $l)
    {
        if ($this->collTicketTypes === null) {
            $this->initTicketTypes();
            $this->collTicketTypesPartial = true;
        }

        if (!$this->collTicketTypes->contains($l)) {
            $this->doAddTicketType($l);

            if ($this->ticketTypesScheduledForDeletion and $this->ticketTypesScheduledForDeletion->contains($l)) {
                $this->ticketTypesScheduledForDeletion->remove($this->ticketTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTicketType $ticketType The ChildTicketType object to add.
     */
    protected function doAddTicketType(ChildTicketType $ticketType): void
    {
        $this->collTicketTypes[]= $ticketType;
        $ticketType->setEmployee($this);
    }

    /**
     * @param ChildTicketType $ticketType The ChildTicketType object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTicketType(ChildTicketType $ticketType)
    {
        if ($this->getTicketTypes()->contains($ticketType)) {
            $pos = $this->collTicketTypes->search($ticketType);
            $this->collTicketTypes->remove($pos);
            if (null === $this->ticketTypesScheduledForDeletion) {
                $this->ticketTypesScheduledForDeletion = clone $this->collTicketTypes;
                $this->ticketTypesScheduledForDeletion->clear();
            }
            $this->ticketTypesScheduledForDeletion[]= clone $ticketType;
            $ticketType->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTicketType[] List of ChildTicketType objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTicketType}> List of ChildTicketType objects
     */
    public function getTicketTypesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketTypeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketTypes($query, $con);
    }

    /**
     * Clears out the collTicketssRelatedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketssRelatedByEmployeeId()
     */
    public function clearTicketssRelatedByEmployeeId()
    {
        $this->collTicketssRelatedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketssRelatedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketssRelatedByEmployeeId($v = true): void
    {
        $this->collTicketssRelatedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collTicketssRelatedByEmployeeId collection.
     *
     * By default this just sets the collTicketssRelatedByEmployeeId collection to an empty array (like clearcollTicketssRelatedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketssRelatedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketssRelatedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketssRelatedByEmployeeId = new $collectionClassName;
        $this->collTicketssRelatedByEmployeeId->setModel('\entities\Tickets');
    }

    /**
     * Gets an array of ChildTickets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets> List of ChildTickets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketssRelatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collTicketssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketssRelatedByEmployeeId) {
                    $this->initTicketssRelatedByEmployeeId();
                } else {
                    $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

                    $collTicketssRelatedByEmployeeId = new $collectionClassName;
                    $collTicketssRelatedByEmployeeId->setModel('\entities\Tickets');

                    return $collTicketssRelatedByEmployeeId;
                }
            } else {
                $collTicketssRelatedByEmployeeId = ChildTicketsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketssRelatedByEmployeeIdPartial && count($collTicketssRelatedByEmployeeId)) {
                        $this->initTicketssRelatedByEmployeeId(false);

                        foreach ($collTicketssRelatedByEmployeeId as $obj) {
                            if (false == $this->collTicketssRelatedByEmployeeId->contains($obj)) {
                                $this->collTicketssRelatedByEmployeeId->append($obj);
                            }
                        }

                        $this->collTicketssRelatedByEmployeeIdPartial = true;
                    }

                    return $collTicketssRelatedByEmployeeId;
                }

                if ($partial && $this->collTicketssRelatedByEmployeeId) {
                    foreach ($this->collTicketssRelatedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collTicketssRelatedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collTicketssRelatedByEmployeeId = $collTicketssRelatedByEmployeeId;
                $this->collTicketssRelatedByEmployeeIdPartial = false;
            }
        }

        return $this->collTicketssRelatedByEmployeeId;
    }

    /**
     * Sets a collection of ChildTickets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketssRelatedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketssRelatedByEmployeeId(Collection $ticketssRelatedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildTickets[] $ticketssRelatedByEmployeeIdToDelete */
        $ticketssRelatedByEmployeeIdToDelete = $this->getTicketssRelatedByEmployeeId(new Criteria(), $con)->diff($ticketssRelatedByEmployeeId);


        $this->ticketssRelatedByEmployeeIdScheduledForDeletion = $ticketssRelatedByEmployeeIdToDelete;

        foreach ($ticketssRelatedByEmployeeIdToDelete as $ticketsRelatedByEmployeeIdRemoved) {
            $ticketsRelatedByEmployeeIdRemoved->setEmployeeRelatedByEmployeeId(null);
        }

        $this->collTicketssRelatedByEmployeeId = null;
        foreach ($ticketssRelatedByEmployeeId as $ticketsRelatedByEmployeeId) {
            $this->addTicketsRelatedByEmployeeId($ticketsRelatedByEmployeeId);
        }

        $this->collTicketssRelatedByEmployeeId = $ticketssRelatedByEmployeeId;
        $this->collTicketssRelatedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tickets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tickets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketssRelatedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collTicketssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketssRelatedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketssRelatedByEmployeeId());
            }

            $query = ChildTicketsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collTicketssRelatedByEmployeeId);
    }

    /**
     * Method called to associate a ChildTickets object to this object
     * through the ChildTickets foreign key attribute.
     *
     * @param ChildTickets $l ChildTickets
     * @return $this The current object (for fluent API support)
     */
    public function addTicketsRelatedByEmployeeId(ChildTickets $l)
    {
        if ($this->collTicketssRelatedByEmployeeId === null) {
            $this->initTicketssRelatedByEmployeeId();
            $this->collTicketssRelatedByEmployeeIdPartial = true;
        }

        if (!$this->collTicketssRelatedByEmployeeId->contains($l)) {
            $this->doAddTicketsRelatedByEmployeeId($l);

            if ($this->ticketssRelatedByEmployeeIdScheduledForDeletion and $this->ticketssRelatedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->ticketssRelatedByEmployeeIdScheduledForDeletion->remove($this->ticketssRelatedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTickets $ticketsRelatedByEmployeeId The ChildTickets object to add.
     */
    protected function doAddTicketsRelatedByEmployeeId(ChildTickets $ticketsRelatedByEmployeeId): void
    {
        $this->collTicketssRelatedByEmployeeId[]= $ticketsRelatedByEmployeeId;
        $ticketsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId($this);
    }

    /**
     * @param ChildTickets $ticketsRelatedByEmployeeId The ChildTickets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTicketsRelatedByEmployeeId(ChildTickets $ticketsRelatedByEmployeeId)
    {
        if ($this->getTicketssRelatedByEmployeeId()->contains($ticketsRelatedByEmployeeId)) {
            $pos = $this->collTicketssRelatedByEmployeeId->search($ticketsRelatedByEmployeeId);
            $this->collTicketssRelatedByEmployeeId->remove($pos);
            if (null === $this->ticketssRelatedByEmployeeIdScheduledForDeletion) {
                $this->ticketssRelatedByEmployeeIdScheduledForDeletion = clone $this->collTicketssRelatedByEmployeeId;
                $this->ticketssRelatedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->ticketssRelatedByEmployeeIdScheduledForDeletion[]= clone $ticketsRelatedByEmployeeId;
            $ticketsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByEmployeeIdJoinTicketType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('TicketType', $joinBehavior);

        return $this->getTicketssRelatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByEmployeeIdJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getTicketssRelatedByEmployeeId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketssRelatedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collTicketssRelatedByAllocatedTo collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTicketssRelatedByAllocatedTo()
     */
    public function clearTicketssRelatedByAllocatedTo()
    {
        $this->collTicketssRelatedByAllocatedTo = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTicketssRelatedByAllocatedTo collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTicketssRelatedByAllocatedTo($v = true): void
    {
        $this->collTicketssRelatedByAllocatedToPartial = $v;
    }

    /**
     * Initializes the collTicketssRelatedByAllocatedTo collection.
     *
     * By default this just sets the collTicketssRelatedByAllocatedTo collection to an empty array (like clearcollTicketssRelatedByAllocatedTo());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTicketssRelatedByAllocatedTo(bool $overrideExisting = true): void
    {
        if (null !== $this->collTicketssRelatedByAllocatedTo && !$overrideExisting) {
            return;
        }

        $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

        $this->collTicketssRelatedByAllocatedTo = new $collectionClassName;
        $this->collTicketssRelatedByAllocatedTo->setModel('\entities\Tickets');
    }

    /**
     * Gets an array of ChildTickets objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets> List of ChildTickets objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTicketssRelatedByAllocatedTo(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTicketssRelatedByAllocatedToPartial && !$this->isNew();
        if (null === $this->collTicketssRelatedByAllocatedTo || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTicketssRelatedByAllocatedTo) {
                    $this->initTicketssRelatedByAllocatedTo();
                } else {
                    $collectionClassName = TicketsTableMap::getTableMap()->getCollectionClassName();

                    $collTicketssRelatedByAllocatedTo = new $collectionClassName;
                    $collTicketssRelatedByAllocatedTo->setModel('\entities\Tickets');

                    return $collTicketssRelatedByAllocatedTo;
                }
            } else {
                $collTicketssRelatedByAllocatedTo = ChildTicketsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByAllocatedTo($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTicketssRelatedByAllocatedToPartial && count($collTicketssRelatedByAllocatedTo)) {
                        $this->initTicketssRelatedByAllocatedTo(false);

                        foreach ($collTicketssRelatedByAllocatedTo as $obj) {
                            if (false == $this->collTicketssRelatedByAllocatedTo->contains($obj)) {
                                $this->collTicketssRelatedByAllocatedTo->append($obj);
                            }
                        }

                        $this->collTicketssRelatedByAllocatedToPartial = true;
                    }

                    return $collTicketssRelatedByAllocatedTo;
                }

                if ($partial && $this->collTicketssRelatedByAllocatedTo) {
                    foreach ($this->collTicketssRelatedByAllocatedTo as $obj) {
                        if ($obj->isNew()) {
                            $collTicketssRelatedByAllocatedTo[] = $obj;
                        }
                    }
                }

                $this->collTicketssRelatedByAllocatedTo = $collTicketssRelatedByAllocatedTo;
                $this->collTicketssRelatedByAllocatedToPartial = false;
            }
        }

        return $this->collTicketssRelatedByAllocatedTo;
    }

    /**
     * Sets a collection of ChildTickets objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ticketssRelatedByAllocatedTo A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTicketssRelatedByAllocatedTo(Collection $ticketssRelatedByAllocatedTo, ?ConnectionInterface $con = null)
    {
        /** @var ChildTickets[] $ticketssRelatedByAllocatedToToDelete */
        $ticketssRelatedByAllocatedToToDelete = $this->getTicketssRelatedByAllocatedTo(new Criteria(), $con)->diff($ticketssRelatedByAllocatedTo);


        $this->ticketssRelatedByAllocatedToScheduledForDeletion = $ticketssRelatedByAllocatedToToDelete;

        foreach ($ticketssRelatedByAllocatedToToDelete as $ticketsRelatedByAllocatedToRemoved) {
            $ticketsRelatedByAllocatedToRemoved->setEmployeeRelatedByAllocatedTo(null);
        }

        $this->collTicketssRelatedByAllocatedTo = null;
        foreach ($ticketssRelatedByAllocatedTo as $ticketsRelatedByAllocatedTo) {
            $this->addTicketsRelatedByAllocatedTo($ticketsRelatedByAllocatedTo);
        }

        $this->collTicketssRelatedByAllocatedTo = $ticketssRelatedByAllocatedTo;
        $this->collTicketssRelatedByAllocatedToPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tickets objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tickets objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTicketssRelatedByAllocatedTo(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTicketssRelatedByAllocatedToPartial && !$this->isNew();
        if (null === $this->collTicketssRelatedByAllocatedTo || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTicketssRelatedByAllocatedTo) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTicketssRelatedByAllocatedTo());
            }

            $query = ChildTicketsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByAllocatedTo($this)
                ->count($con);
        }

        return count($this->collTicketssRelatedByAllocatedTo);
    }

    /**
     * Method called to associate a ChildTickets object to this object
     * through the ChildTickets foreign key attribute.
     *
     * @param ChildTickets $l ChildTickets
     * @return $this The current object (for fluent API support)
     */
    public function addTicketsRelatedByAllocatedTo(ChildTickets $l)
    {
        if ($this->collTicketssRelatedByAllocatedTo === null) {
            $this->initTicketssRelatedByAllocatedTo();
            $this->collTicketssRelatedByAllocatedToPartial = true;
        }

        if (!$this->collTicketssRelatedByAllocatedTo->contains($l)) {
            $this->doAddTicketsRelatedByAllocatedTo($l);

            if ($this->ticketssRelatedByAllocatedToScheduledForDeletion and $this->ticketssRelatedByAllocatedToScheduledForDeletion->contains($l)) {
                $this->ticketssRelatedByAllocatedToScheduledForDeletion->remove($this->ticketssRelatedByAllocatedToScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTickets $ticketsRelatedByAllocatedTo The ChildTickets object to add.
     */
    protected function doAddTicketsRelatedByAllocatedTo(ChildTickets $ticketsRelatedByAllocatedTo): void
    {
        $this->collTicketssRelatedByAllocatedTo[]= $ticketsRelatedByAllocatedTo;
        $ticketsRelatedByAllocatedTo->setEmployeeRelatedByAllocatedTo($this);
    }

    /**
     * @param ChildTickets $ticketsRelatedByAllocatedTo The ChildTickets object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTicketsRelatedByAllocatedTo(ChildTickets $ticketsRelatedByAllocatedTo)
    {
        if ($this->getTicketssRelatedByAllocatedTo()->contains($ticketsRelatedByAllocatedTo)) {
            $pos = $this->collTicketssRelatedByAllocatedTo->search($ticketsRelatedByAllocatedTo);
            $this->collTicketssRelatedByAllocatedTo->remove($pos);
            if (null === $this->ticketssRelatedByAllocatedToScheduledForDeletion) {
                $this->ticketssRelatedByAllocatedToScheduledForDeletion = clone $this->collTicketssRelatedByAllocatedTo;
                $this->ticketssRelatedByAllocatedToScheduledForDeletion->clear();
            }
            $this->ticketssRelatedByAllocatedToScheduledForDeletion[]= $ticketsRelatedByAllocatedTo;
            $ticketsRelatedByAllocatedTo->setEmployeeRelatedByAllocatedTo(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByAllocatedTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByAllocatedToJoinTicketType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('TicketType', $joinBehavior);

        return $this->getTicketssRelatedByAllocatedTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByAllocatedTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByAllocatedToJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getTicketssRelatedByAllocatedTo($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TicketssRelatedByAllocatedTo from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTickets[] List of ChildTickets objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTickets}> List of ChildTickets objects
     */
    public function getTicketssRelatedByAllocatedToJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTicketsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTicketssRelatedByAllocatedTo($query, $con);
    }

    /**
     * Clears out the collTransactionssRelatedByEmployeeId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTransactionssRelatedByEmployeeId()
     */
    public function clearTransactionssRelatedByEmployeeId()
    {
        $this->collTransactionssRelatedByEmployeeId = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTransactionssRelatedByEmployeeId collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTransactionssRelatedByEmployeeId($v = true): void
    {
        $this->collTransactionssRelatedByEmployeeIdPartial = $v;
    }

    /**
     * Initializes the collTransactionssRelatedByEmployeeId collection.
     *
     * By default this just sets the collTransactionssRelatedByEmployeeId collection to an empty array (like clearcollTransactionssRelatedByEmployeeId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactionssRelatedByEmployeeId(bool $overrideExisting = true): void
    {
        if (null !== $this->collTransactionssRelatedByEmployeeId && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionsTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactionssRelatedByEmployeeId = new $collectionClassName;
        $this->collTransactionssRelatedByEmployeeId->setModel('\entities\Transactions');
    }

    /**
     * Gets an array of ChildTransactions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransactions[] List of ChildTransactions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTransactions> List of ChildTransactions objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTransactionssRelatedByEmployeeId(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collTransactionssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTransactionssRelatedByEmployeeId) {
                    $this->initTransactionssRelatedByEmployeeId();
                } else {
                    $collectionClassName = TransactionsTableMap::getTableMap()->getCollectionClassName();

                    $collTransactionssRelatedByEmployeeId = new $collectionClassName;
                    $collTransactionssRelatedByEmployeeId->setModel('\entities\Transactions');

                    return $collTransactionssRelatedByEmployeeId;
                }
            } else {
                $collTransactionssRelatedByEmployeeId = ChildTransactionsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByEmployeeId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionssRelatedByEmployeeIdPartial && count($collTransactionssRelatedByEmployeeId)) {
                        $this->initTransactionssRelatedByEmployeeId(false);

                        foreach ($collTransactionssRelatedByEmployeeId as $obj) {
                            if (false == $this->collTransactionssRelatedByEmployeeId->contains($obj)) {
                                $this->collTransactionssRelatedByEmployeeId->append($obj);
                            }
                        }

                        $this->collTransactionssRelatedByEmployeeIdPartial = true;
                    }

                    return $collTransactionssRelatedByEmployeeId;
                }

                if ($partial && $this->collTransactionssRelatedByEmployeeId) {
                    foreach ($this->collTransactionssRelatedByEmployeeId as $obj) {
                        if ($obj->isNew()) {
                            $collTransactionssRelatedByEmployeeId[] = $obj;
                        }
                    }
                }

                $this->collTransactionssRelatedByEmployeeId = $collTransactionssRelatedByEmployeeId;
                $this->collTransactionssRelatedByEmployeeIdPartial = false;
            }
        }

        return $this->collTransactionssRelatedByEmployeeId;
    }

    /**
     * Sets a collection of ChildTransactions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $transactionssRelatedByEmployeeId A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTransactionssRelatedByEmployeeId(Collection $transactionssRelatedByEmployeeId, ?ConnectionInterface $con = null)
    {
        /** @var ChildTransactions[] $transactionssRelatedByEmployeeIdToDelete */
        $transactionssRelatedByEmployeeIdToDelete = $this->getTransactionssRelatedByEmployeeId(new Criteria(), $con)->diff($transactionssRelatedByEmployeeId);


        $this->transactionssRelatedByEmployeeIdScheduledForDeletion = $transactionssRelatedByEmployeeIdToDelete;

        foreach ($transactionssRelatedByEmployeeIdToDelete as $transactionsRelatedByEmployeeIdRemoved) {
            $transactionsRelatedByEmployeeIdRemoved->setEmployeeRelatedByEmployeeId(null);
        }

        $this->collTransactionssRelatedByEmployeeId = null;
        foreach ($transactionssRelatedByEmployeeId as $transactionsRelatedByEmployeeId) {
            $this->addTransactionsRelatedByEmployeeId($transactionsRelatedByEmployeeId);
        }

        $this->collTransactionssRelatedByEmployeeId = $transactionssRelatedByEmployeeId;
        $this->collTransactionssRelatedByEmployeeIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Transactions objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Transactions objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTransactionssRelatedByEmployeeId(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTransactionssRelatedByEmployeeIdPartial && !$this->isNew();
        if (null === $this->collTransactionssRelatedByEmployeeId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactionssRelatedByEmployeeId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactionssRelatedByEmployeeId());
            }

            $query = ChildTransactionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByEmployeeId($this)
                ->count($con);
        }

        return count($this->collTransactionssRelatedByEmployeeId);
    }

    /**
     * Method called to associate a ChildTransactions object to this object
     * through the ChildTransactions foreign key attribute.
     *
     * @param ChildTransactions $l ChildTransactions
     * @return $this The current object (for fluent API support)
     */
    public function addTransactionsRelatedByEmployeeId(ChildTransactions $l)
    {
        if ($this->collTransactionssRelatedByEmployeeId === null) {
            $this->initTransactionssRelatedByEmployeeId();
            $this->collTransactionssRelatedByEmployeeIdPartial = true;
        }

        if (!$this->collTransactionssRelatedByEmployeeId->contains($l)) {
            $this->doAddTransactionsRelatedByEmployeeId($l);

            if ($this->transactionssRelatedByEmployeeIdScheduledForDeletion and $this->transactionssRelatedByEmployeeIdScheduledForDeletion->contains($l)) {
                $this->transactionssRelatedByEmployeeIdScheduledForDeletion->remove($this->transactionssRelatedByEmployeeIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransactions $transactionsRelatedByEmployeeId The ChildTransactions object to add.
     */
    protected function doAddTransactionsRelatedByEmployeeId(ChildTransactions $transactionsRelatedByEmployeeId): void
    {
        $this->collTransactionssRelatedByEmployeeId[]= $transactionsRelatedByEmployeeId;
        $transactionsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId($this);
    }

    /**
     * @param ChildTransactions $transactionsRelatedByEmployeeId The ChildTransactions object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTransactionsRelatedByEmployeeId(ChildTransactions $transactionsRelatedByEmployeeId)
    {
        if ($this->getTransactionssRelatedByEmployeeId()->contains($transactionsRelatedByEmployeeId)) {
            $pos = $this->collTransactionssRelatedByEmployeeId->search($transactionsRelatedByEmployeeId);
            $this->collTransactionssRelatedByEmployeeId->remove($pos);
            if (null === $this->transactionssRelatedByEmployeeIdScheduledForDeletion) {
                $this->transactionssRelatedByEmployeeIdScheduledForDeletion = clone $this->collTransactionssRelatedByEmployeeId;
                $this->transactionssRelatedByEmployeeIdScheduledForDeletion->clear();
            }
            $this->transactionssRelatedByEmployeeIdScheduledForDeletion[]= clone $transactionsRelatedByEmployeeId;
            $transactionsRelatedByEmployeeId->setEmployeeRelatedByEmployeeId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TransactionssRelatedByEmployeeId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTransactions[] List of ChildTransactions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTransactions}> List of ChildTransactions objects
     */
    public function getTransactionssRelatedByEmployeeIdJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTransactionsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTransactionssRelatedByEmployeeId($query, $con);
    }

    /**
     * Clears out the collTransactionssRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTransactionssRelatedByCreatedBy()
     */
    public function clearTransactionssRelatedByCreatedBy()
    {
        $this->collTransactionssRelatedByCreatedBy = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTransactionssRelatedByCreatedBy collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTransactionssRelatedByCreatedBy($v = true): void
    {
        $this->collTransactionssRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collTransactionssRelatedByCreatedBy collection.
     *
     * By default this just sets the collTransactionssRelatedByCreatedBy collection to an empty array (like clearcollTransactionssRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTransactionssRelatedByCreatedBy(bool $overrideExisting = true): void
    {
        if (null !== $this->collTransactionssRelatedByCreatedBy && !$overrideExisting) {
            return;
        }

        $collectionClassName = TransactionsTableMap::getTableMap()->getCollectionClassName();

        $this->collTransactionssRelatedByCreatedBy = new $collectionClassName;
        $this->collTransactionssRelatedByCreatedBy->setModel('\entities\Transactions');
    }

    /**
     * Gets an array of ChildTransactions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTransactions[] List of ChildTransactions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTransactions> List of ChildTransactions objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTransactionssRelatedByCreatedBy(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTransactionssRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTransactionssRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTransactionssRelatedByCreatedBy) {
                    $this->initTransactionssRelatedByCreatedBy();
                } else {
                    $collectionClassName = TransactionsTableMap::getTableMap()->getCollectionClassName();

                    $collTransactionssRelatedByCreatedBy = new $collectionClassName;
                    $collTransactionssRelatedByCreatedBy->setModel('\entities\Transactions');

                    return $collTransactionssRelatedByCreatedBy;
                }
            } else {
                $collTransactionssRelatedByCreatedBy = ChildTransactionsQuery::create(null, $criteria)
                    ->filterByEmployeeRelatedByCreatedBy($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTransactionssRelatedByCreatedByPartial && count($collTransactionssRelatedByCreatedBy)) {
                        $this->initTransactionssRelatedByCreatedBy(false);

                        foreach ($collTransactionssRelatedByCreatedBy as $obj) {
                            if (false == $this->collTransactionssRelatedByCreatedBy->contains($obj)) {
                                $this->collTransactionssRelatedByCreatedBy->append($obj);
                            }
                        }

                        $this->collTransactionssRelatedByCreatedByPartial = true;
                    }

                    return $collTransactionssRelatedByCreatedBy;
                }

                if ($partial && $this->collTransactionssRelatedByCreatedBy) {
                    foreach ($this->collTransactionssRelatedByCreatedBy as $obj) {
                        if ($obj->isNew()) {
                            $collTransactionssRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collTransactionssRelatedByCreatedBy = $collTransactionssRelatedByCreatedBy;
                $this->collTransactionssRelatedByCreatedByPartial = false;
            }
        }

        return $this->collTransactionssRelatedByCreatedBy;
    }

    /**
     * Sets a collection of ChildTransactions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $transactionssRelatedByCreatedBy A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTransactionssRelatedByCreatedBy(Collection $transactionssRelatedByCreatedBy, ?ConnectionInterface $con = null)
    {
        /** @var ChildTransactions[] $transactionssRelatedByCreatedByToDelete */
        $transactionssRelatedByCreatedByToDelete = $this->getTransactionssRelatedByCreatedBy(new Criteria(), $con)->diff($transactionssRelatedByCreatedBy);


        $this->transactionssRelatedByCreatedByScheduledForDeletion = $transactionssRelatedByCreatedByToDelete;

        foreach ($transactionssRelatedByCreatedByToDelete as $transactionsRelatedByCreatedByRemoved) {
            $transactionsRelatedByCreatedByRemoved->setEmployeeRelatedByCreatedBy(null);
        }

        $this->collTransactionssRelatedByCreatedBy = null;
        foreach ($transactionssRelatedByCreatedBy as $transactionsRelatedByCreatedBy) {
            $this->addTransactionsRelatedByCreatedBy($transactionsRelatedByCreatedBy);
        }

        $this->collTransactionssRelatedByCreatedBy = $transactionssRelatedByCreatedBy;
        $this->collTransactionssRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Transactions objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Transactions objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTransactionssRelatedByCreatedBy(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTransactionssRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTransactionssRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTransactionssRelatedByCreatedBy) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTransactionssRelatedByCreatedBy());
            }

            $query = ChildTransactionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployeeRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collTransactionssRelatedByCreatedBy);
    }

    /**
     * Method called to associate a ChildTransactions object to this object
     * through the ChildTransactions foreign key attribute.
     *
     * @param ChildTransactions $l ChildTransactions
     * @return $this The current object (for fluent API support)
     */
    public function addTransactionsRelatedByCreatedBy(ChildTransactions $l)
    {
        if ($this->collTransactionssRelatedByCreatedBy === null) {
            $this->initTransactionssRelatedByCreatedBy();
            $this->collTransactionssRelatedByCreatedByPartial = true;
        }

        if (!$this->collTransactionssRelatedByCreatedBy->contains($l)) {
            $this->doAddTransactionsRelatedByCreatedBy($l);

            if ($this->transactionssRelatedByCreatedByScheduledForDeletion and $this->transactionssRelatedByCreatedByScheduledForDeletion->contains($l)) {
                $this->transactionssRelatedByCreatedByScheduledForDeletion->remove($this->transactionssRelatedByCreatedByScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTransactions $transactionsRelatedByCreatedBy The ChildTransactions object to add.
     */
    protected function doAddTransactionsRelatedByCreatedBy(ChildTransactions $transactionsRelatedByCreatedBy): void
    {
        $this->collTransactionssRelatedByCreatedBy[]= $transactionsRelatedByCreatedBy;
        $transactionsRelatedByCreatedBy->setEmployeeRelatedByCreatedBy($this);
    }

    /**
     * @param ChildTransactions $transactionsRelatedByCreatedBy The ChildTransactions object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTransactionsRelatedByCreatedBy(ChildTransactions $transactionsRelatedByCreatedBy)
    {
        if ($this->getTransactionssRelatedByCreatedBy()->contains($transactionsRelatedByCreatedBy)) {
            $pos = $this->collTransactionssRelatedByCreatedBy->search($transactionsRelatedByCreatedBy);
            $this->collTransactionssRelatedByCreatedBy->remove($pos);
            if (null === $this->transactionssRelatedByCreatedByScheduledForDeletion) {
                $this->transactionssRelatedByCreatedByScheduledForDeletion = clone $this->collTransactionssRelatedByCreatedBy;
                $this->transactionssRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->transactionssRelatedByCreatedByScheduledForDeletion[]= clone $transactionsRelatedByCreatedBy;
            $transactionsRelatedByCreatedBy->setEmployeeRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related TransactionssRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTransactions[] List of ChildTransactions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTransactions}> List of ChildTransactions objects
     */
    public function getTransactionssRelatedByCreatedByJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTransactionsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTransactionssRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserss()
     */
    public function clearUserss()
    {
        $this->collUserss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserss($v = true): void
    {
        $this->collUserssPartial = $v;
    }

    /**
     * Initializes the collUserss collection.
     *
     * By default this just sets the collUserss collection to an empty array (like clearcollUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserss(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

        $this->collUserss = new $collectionClassName;
        $this->collUserss->setModel('\entities\Users');
    }

    /**
     * Gets an array of ChildUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers> List of ChildUsers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserss) {
                    $this->initUserss();
                } else {
                    $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

                    $collUserss = new $collectionClassName;
                    $collUserss->setModel('\entities\Users');

                    return $collUserss;
                }
            } else {
                $collUserss = ChildUsersQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserssPartial && count($collUserss)) {
                        $this->initUserss(false);

                        foreach ($collUserss as $obj) {
                            if (false == $this->collUserss->contains($obj)) {
                                $this->collUserss->append($obj);
                            }
                        }

                        $this->collUserssPartial = true;
                    }

                    return $collUserss;
                }

                if ($partial && $this->collUserss) {
                    foreach ($this->collUserss as $obj) {
                        if ($obj->isNew()) {
                            $collUserss[] = $obj;
                        }
                    }
                }

                $this->collUserss = $collUserss;
                $this->collUserssPartial = false;
            }
        }

        return $this->collUserss;
    }

    /**
     * Sets a collection of ChildUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserss(Collection $userss, ?ConnectionInterface $con = null)
    {
        /** @var ChildUsers[] $userssToDelete */
        $userssToDelete = $this->getUserss(new Criteria(), $con)->diff($userss);


        $this->userssScheduledForDeletion = $userssToDelete;

        foreach ($userssToDelete as $usersRemoved) {
            $usersRemoved->setEmployee(null);
        }

        $this->collUserss = null;
        foreach ($userss as $users) {
            $this->addUsers($users);
        }

        $this->collUserss = $userss;
        $this->collUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Users objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Users objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserss());
            }

            $query = ChildUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collUserss);
    }

    /**
     * Method called to associate a ChildUsers object to this object
     * through the ChildUsers foreign key attribute.
     *
     * @param ChildUsers $l ChildUsers
     * @return $this The current object (for fluent API support)
     */
    public function addUsers(ChildUsers $l)
    {
        if ($this->collUserss === null) {
            $this->initUserss();
            $this->collUserssPartial = true;
        }

        if (!$this->collUserss->contains($l)) {
            $this->doAddUsers($l);

            if ($this->userssScheduledForDeletion and $this->userssScheduledForDeletion->contains($l)) {
                $this->userssScheduledForDeletion->remove($this->userssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsers $users The ChildUsers object to add.
     */
    protected function doAddUsers(ChildUsers $users): void
    {
        $this->collUserss[]= $users;
        $users->setEmployee($this);
    }

    /**
     * @param ChildUsers $users The ChildUsers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUsers(ChildUsers $users)
    {
        if ($this->getUserss()->contains($users)) {
            $pos = $this->collUserss->search($users);
            $this->collUserss->remove($pos);
            if (null === $this->userssScheduledForDeletion) {
                $this->userssScheduledForDeletion = clone $this->collUserss;
                $this->userssScheduledForDeletion->clear();
            }
            $this->userssScheduledForDeletion[]= $users;
            $users->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Userss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers}> List of ChildUsers objects
     */
    public function getUserssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getUserss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related Userss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers}> List of ChildUsers objects
     */
    public function getUserssJoinRoles(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsersQuery::create(null, $criteria);
        $query->joinWith('Roles', $joinBehavior);

        return $this->getUserss($query, $con);
    }

    /**
     * Clears out the collWfLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfLogs()
     */
    public function clearWfLogs()
    {
        $this->collWfLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfLogs($v = true): void
    {
        $this->collWfLogsPartial = $v;
    }

    /**
     * Initializes the collWfLogs collection.
     *
     * By default this just sets the collWfLogs collection to an empty array (like clearcollWfLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfLogTableMap::getTableMap()->getCollectionClassName();

        $this->collWfLogs = new $collectionClassName;
        $this->collWfLogs->setModel('\entities\WfLog');
    }

    /**
     * Gets an array of ChildWfLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfLog[] List of ChildWfLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfLog> List of ChildWfLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfLogsPartial && !$this->isNew();
        if (null === $this->collWfLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfLogs) {
                    $this->initWfLogs();
                } else {
                    $collectionClassName = WfLogTableMap::getTableMap()->getCollectionClassName();

                    $collWfLogs = new $collectionClassName;
                    $collWfLogs->setModel('\entities\WfLog');

                    return $collWfLogs;
                }
            } else {
                $collWfLogs = ChildWfLogQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfLogsPartial && count($collWfLogs)) {
                        $this->initWfLogs(false);

                        foreach ($collWfLogs as $obj) {
                            if (false == $this->collWfLogs->contains($obj)) {
                                $this->collWfLogs->append($obj);
                            }
                        }

                        $this->collWfLogsPartial = true;
                    }

                    return $collWfLogs;
                }

                if ($partial && $this->collWfLogs) {
                    foreach ($this->collWfLogs as $obj) {
                        if ($obj->isNew()) {
                            $collWfLogs[] = $obj;
                        }
                    }
                }

                $this->collWfLogs = $collWfLogs;
                $this->collWfLogsPartial = false;
            }
        }

        return $this->collWfLogs;
    }

    /**
     * Sets a collection of ChildWfLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfLogs(Collection $wfLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfLog[] $wfLogsToDelete */
        $wfLogsToDelete = $this->getWfLogs(new Criteria(), $con)->diff($wfLogs);


        $this->wfLogsScheduledForDeletion = $wfLogsToDelete;

        foreach ($wfLogsToDelete as $wfLogRemoved) {
            $wfLogRemoved->setEmployee(null);
        }

        $this->collWfLogs = null;
        foreach ($wfLogs as $wfLog) {
            $this->addWfLog($wfLog);
        }

        $this->collWfLogs = $wfLogs;
        $this->collWfLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfLogsPartial && !$this->isNew();
        if (null === $this->collWfLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfLogs());
            }

            $query = ChildWfLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collWfLogs);
    }

    /**
     * Method called to associate a ChildWfLog object to this object
     * through the ChildWfLog foreign key attribute.
     *
     * @param ChildWfLog $l ChildWfLog
     * @return $this The current object (for fluent API support)
     */
    public function addWfLog(ChildWfLog $l)
    {
        if ($this->collWfLogs === null) {
            $this->initWfLogs();
            $this->collWfLogsPartial = true;
        }

        if (!$this->collWfLogs->contains($l)) {
            $this->doAddWfLog($l);

            if ($this->wfLogsScheduledForDeletion and $this->wfLogsScheduledForDeletion->contains($l)) {
                $this->wfLogsScheduledForDeletion->remove($this->wfLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfLog $wfLog The ChildWfLog object to add.
     */
    protected function doAddWfLog(ChildWfLog $wfLog): void
    {
        $this->collWfLogs[]= $wfLog;
        $wfLog->setEmployee($this);
    }

    /**
     * @param ChildWfLog $wfLog The ChildWfLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfLog(ChildWfLog $wfLog)
    {
        if ($this->getWfLogs()->contains($wfLog)) {
            $pos = $this->collWfLogs->search($wfLog);
            $this->collWfLogs->remove($pos);
            if (null === $this->wfLogsScheduledForDeletion) {
                $this->wfLogsScheduledForDeletion = clone $this->collWfLogs;
                $this->wfLogsScheduledForDeletion->clear();
            }
            $this->wfLogsScheduledForDeletion[]= clone $wfLog;
            $wfLog->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related WfLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfLog[] List of ChildWfLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfLog}> List of ChildWfLog objects
     */
    public function getWfLogsJoinWfDocuments(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfLogQuery::create(null, $criteria);
        $query->joinWith('WfDocuments', $joinBehavior);

        return $this->getWfLogs($query, $con);
    }

    /**
     * Clears out the collWfRequestss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWfRequestss()
     */
    public function clearWfRequestss()
    {
        $this->collWfRequestss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWfRequestss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWfRequestss($v = true): void
    {
        $this->collWfRequestssPartial = $v;
    }

    /**
     * Initializes the collWfRequestss collection.
     *
     * By default this just sets the collWfRequestss collection to an empty array (like clearcollWfRequestss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWfRequestss(bool $overrideExisting = true): void
    {
        if (null !== $this->collWfRequestss && !$overrideExisting) {
            return;
        }

        $collectionClassName = WfRequestsTableMap::getTableMap()->getCollectionClassName();

        $this->collWfRequestss = new $collectionClassName;
        $this->collWfRequestss->setModel('\entities\WfRequests');
    }

    /**
     * Gets an array of ChildWfRequests objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEmployee is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests> List of ChildWfRequests objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWfRequestss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWfRequestssPartial && !$this->isNew();
        if (null === $this->collWfRequestss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWfRequestss) {
                    $this->initWfRequestss();
                } else {
                    $collectionClassName = WfRequestsTableMap::getTableMap()->getCollectionClassName();

                    $collWfRequestss = new $collectionClassName;
                    $collWfRequestss->setModel('\entities\WfRequests');

                    return $collWfRequestss;
                }
            } else {
                $collWfRequestss = ChildWfRequestsQuery::create(null, $criteria)
                    ->filterByEmployee($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWfRequestssPartial && count($collWfRequestss)) {
                        $this->initWfRequestss(false);

                        foreach ($collWfRequestss as $obj) {
                            if (false == $this->collWfRequestss->contains($obj)) {
                                $this->collWfRequestss->append($obj);
                            }
                        }

                        $this->collWfRequestssPartial = true;
                    }

                    return $collWfRequestss;
                }

                if ($partial && $this->collWfRequestss) {
                    foreach ($this->collWfRequestss as $obj) {
                        if ($obj->isNew()) {
                            $collWfRequestss[] = $obj;
                        }
                    }
                }

                $this->collWfRequestss = $collWfRequestss;
                $this->collWfRequestssPartial = false;
            }
        }

        return $this->collWfRequestss;
    }

    /**
     * Sets a collection of ChildWfRequests objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wfRequestss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWfRequestss(Collection $wfRequestss, ?ConnectionInterface $con = null)
    {
        /** @var ChildWfRequests[] $wfRequestssToDelete */
        $wfRequestssToDelete = $this->getWfRequestss(new Criteria(), $con)->diff($wfRequestss);


        $this->wfRequestssScheduledForDeletion = $wfRequestssToDelete;

        foreach ($wfRequestssToDelete as $wfRequestsRemoved) {
            $wfRequestsRemoved->setEmployee(null);
        }

        $this->collWfRequestss = null;
        foreach ($wfRequestss as $wfRequests) {
            $this->addWfRequests($wfRequests);
        }

        $this->collWfRequestss = $wfRequestss;
        $this->collWfRequestssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WfRequests objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WfRequests objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWfRequestss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWfRequestssPartial && !$this->isNew();
        if (null === $this->collWfRequestss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWfRequestss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWfRequestss());
            }

            $query = ChildWfRequestsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEmployee($this)
                ->count($con);
        }

        return count($this->collWfRequestss);
    }

    /**
     * Method called to associate a ChildWfRequests object to this object
     * through the ChildWfRequests foreign key attribute.
     *
     * @param ChildWfRequests $l ChildWfRequests
     * @return $this The current object (for fluent API support)
     */
    public function addWfRequests(ChildWfRequests $l)
    {
        if ($this->collWfRequestss === null) {
            $this->initWfRequestss();
            $this->collWfRequestssPartial = true;
        }

        if (!$this->collWfRequestss->contains($l)) {
            $this->doAddWfRequests($l);

            if ($this->wfRequestssScheduledForDeletion and $this->wfRequestssScheduledForDeletion->contains($l)) {
                $this->wfRequestssScheduledForDeletion->remove($this->wfRequestssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWfRequests $wfRequests The ChildWfRequests object to add.
     */
    protected function doAddWfRequests(ChildWfRequests $wfRequests): void
    {
        $this->collWfRequestss[]= $wfRequests;
        $wfRequests->setEmployee($this);
    }

    /**
     * @param ChildWfRequests $wfRequests The ChildWfRequests object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWfRequests(ChildWfRequests $wfRequests)
    {
        if ($this->getWfRequestss()->contains($wfRequests)) {
            $pos = $this->collWfRequestss->search($wfRequests);
            $this->collWfRequestss->remove($pos);
            if (null === $this->wfRequestssScheduledForDeletion) {
                $this->wfRequestssScheduledForDeletion = clone $this->collWfRequestss;
                $this->wfRequestssScheduledForDeletion->clear();
            }
            $this->wfRequestssScheduledForDeletion[]= clone $wfRequests;
            $wfRequests->setEmployee(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfDocuments(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfDocuments', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfMaster(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfMaster', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Employee is new, it will return
     * an empty collection; or if this Employee has previously
     * been saved, it will retrieve related WfRequestss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Employee.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWfRequests[] List of ChildWfRequests objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWfRequests}> List of ChildWfRequests objects
     */
    public function getWfRequestssJoinWfSteps(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWfRequestsQuery::create(null, $criteria);
        $query->joinWith('WfSteps', $joinBehavior);

        return $this->getWfRequestss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aBranch) {
            $this->aBranch->removeEmployee($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeEmployee($this);
        }
        if (null !== $this->aDesignations) {
            $this->aDesignations->removeEmployee($this);
        }
        if (null !== $this->aGradeMaster) {
            $this->aGradeMaster->removeEmployee($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeEmployee($this);
        }
        if (null !== $this->aPositionsRelatedByPositionId) {
            $this->aPositionsRelatedByPositionId->removeEmployeeRelatedByPositionId($this);
        }
        if (null !== $this->aPositionsRelatedByReportingTo) {
            $this->aPositionsRelatedByReportingTo->removeEmployeeRelatedByReportingTo($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeEmployee($this);
        }
        $this->employee_id = null;
        $this->company_id = null;
        $this->position_id = null;
        $this->reporting_to = null;
        $this->designation_id = null;
        $this->branch_id = null;
        $this->grade_id = null;
        $this->org_unit_id = null;
        $this->employee_code = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->status = null;
        $this->ip_address = null;
        $this->profile_picture = null;
        $this->email = null;
        $this->last_login = null;
        $this->phone = null;
        $this->address = null;
        $this->costnumber = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->base_mtarget = null;
        $this->integration_id = null;
        $this->itownid = null;
        $this->islocked = null;
        $this->lockedreason = null;
        $this->lockeddate = null;
        $this->iseodcheckenabled = null;
        $this->employee_media = null;
        $this->resi_address = null;
        $this->can_full_sync = null;
        $this->remark = null;
        $this->employee_spoken_language = null;
        $this->last_updated_by_user_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collAnnouncementEmployeeMaps) {
                foreach ($this->collAnnouncementEmployeeMaps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAttendances) {
                foreach ($this->collAttendances as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuditEmpUnitss) {
                foreach ($this->collAuditEmpUnitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBrandRcpas) {
                foreach ($this->collBrandRcpas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCompetitionMappings) {
                foreach ($this->collCompetitionMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsSgpiouts) {
                foreach ($this->collDailycallsSgpiouts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEdSessions) {
                foreach ($this->collEdSessions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeIncentives) {
                foreach ($this->collEmployeeIncentives as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeePositionHistories) {
                foreach ($this->collEmployeePositionHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventssRelatedByEmployeeId) {
                foreach ($this->collEventssRelatedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEventssRelatedByApproverEmpId) {
                foreach ($this->collEventssRelatedByApproverEmpId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensePaymentss) {
                foreach ($this->collExpensePaymentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserAccounts) {
                foreach ($this->collHrUserAccounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserDatess) {
                foreach ($this->collHrUserDatess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserDocumentss) {
                foreach ($this->collHrUserDocumentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserExperiencess) {
                foreach ($this->collHrUserExperiencess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserQualifications) {
                foreach ($this->collHrUserQualifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHrUserReferencess) {
                foreach ($this->collHrUserReferencess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeaveRequests) {
                foreach ($this->collLeaveRequests as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeavess) {
                foreach ($this->collLeavess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMtps) {
                foreach ($this->collMtps as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId) {
                foreach ($this->collOnBoardRequestsRelatedByApprovedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId) {
                foreach ($this->collOnBoardRequestsRelatedByCreatedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId) {
                foreach ($this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId) {
                foreach ($this->collOnBoardRequestsRelatedByUpdatedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestLogs) {
                foreach ($this->collOnBoardRequestLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOtpRequestss) {
                foreach ($this->collOtpRequestss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletss) {
                foreach ($this->collOutletss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collReminderss) {
                foreach ($this->collReminderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSalaryAttendanceBackdateTrackLogs) {
                foreach ($this->collSalaryAttendanceBackdateTrackLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveySubmiteds) {
                foreach ($this->collSurveySubmiteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTicketRepliess) {
                foreach ($this->collTicketRepliess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTicketTypes) {
                foreach ($this->collTicketTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTicketssRelatedByEmployeeId) {
                foreach ($this->collTicketssRelatedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTicketssRelatedByAllocatedTo) {
                foreach ($this->collTicketssRelatedByAllocatedTo as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransactionssRelatedByEmployeeId) {
                foreach ($this->collTransactionssRelatedByEmployeeId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTransactionssRelatedByCreatedBy) {
                foreach ($this->collTransactionssRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserss) {
                foreach ($this->collUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWfLogs) {
                foreach ($this->collWfLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWfRequestss) {
                foreach ($this->collWfRequestss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAnnouncementEmployeeMaps = null;
        $this->collAttendances = null;
        $this->collAuditEmpUnitss = null;
        $this->collBrandRcpas = null;
        $this->collCompetitionMappings = null;
        $this->collDailycallsSgpiouts = null;
        $this->collEdSessions = null;
        $this->collEmployeeIncentives = null;
        $this->collEmployeePositionHistories = null;
        $this->collEventssRelatedByEmployeeId = null;
        $this->collEventssRelatedByApproverEmpId = null;
        $this->collExpensePaymentss = null;
        $this->collExpensess = null;
        $this->collHrUserAccounts = null;
        $this->collHrUserDatess = null;
        $this->collHrUserDocumentss = null;
        $this->collHrUserExperiencess = null;
        $this->collHrUserQualifications = null;
        $this->collHrUserReferencess = null;
        $this->collLeaveRequests = null;
        $this->collLeavess = null;
        $this->collMtps = null;
        $this->collOnBoardRequestsRelatedByApprovedByEmployeeId = null;
        $this->collOnBoardRequestsRelatedByCreatedByEmployeeId = null;
        $this->collOnBoardRequestsRelatedByFinalApprovedByEmployeeId = null;
        $this->collOnBoardRequestsRelatedByUpdatedByEmployeeId = null;
        $this->collOnBoardRequestLogs = null;
        $this->collOrderss = null;
        $this->collOtpRequestss = null;
        $this->collOutletss = null;
        $this->collReminderss = null;
        $this->collSalaryAttendanceBackdateTrackLogs = null;
        $this->collSurveySubmiteds = null;
        $this->collTicketRepliess = null;
        $this->collTicketTypes = null;
        $this->collTicketssRelatedByEmployeeId = null;
        $this->collTicketssRelatedByAllocatedTo = null;
        $this->collTransactionssRelatedByEmployeeId = null;
        $this->collTransactionssRelatedByCreatedBy = null;
        $this->collUserss = null;
        $this->collWfLogs = null;
        $this->collWfRequestss = null;
        $this->aBranch = null;
        $this->aCompany = null;
        $this->aDesignations = null;
        $this->aGradeMaster = null;
        $this->aOrgUnit = null;
        $this->aPositionsRelatedByPositionId = null;
        $this->aPositionsRelatedByReportingTo = null;
        $this->aGeoTowns = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmployeeTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}

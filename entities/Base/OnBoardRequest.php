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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestAddress as ChildOnBoardRequestAddress;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OnBoardRequestLog as ChildOnBoardRequestLog;
use entities\OnBoardRequestLogQuery as ChildOnBoardRequestLogQuery;
use entities\OnBoardRequestOutletMapping as ChildOnBoardRequestOutletMapping;
use entities\OnBoardRequestOutletMappingQuery as ChildOnBoardRequestOutletMappingQuery;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Outlets as ChildOutlets;
use entities\OutletsQuery as ChildOutletsQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\Territories as ChildTerritories;
use entities\TerritoriesQuery as ChildTerritoriesQuery;
use entities\Map\OnBoardRequestAddressTableMap;
use entities\Map\OnBoardRequestLogTableMap;
use entities\Map\OnBoardRequestOutletMappingTableMap;
use entities\Map\OnBoardRequestTableMap;

/**
 * Base class that represents a row from the 'on_board_request' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OnBoardRequest implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OnBoardRequestTableMap';


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
     * The value for the on_board_request_id field.
     *
     * @var        int
     */
    protected $on_board_request_id;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the salutation field.
     *
     * @var        string|null
     */
    protected $salutation;

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
     * The value for the email field.
     *
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the mobile field.
     *
     * @var        string|null
     */
    protected $mobile;

    /**
     * The value for the gender field.
     *
     * @var        string|null
     */
    protected $gender;

    /**
     * The value for the date_of_birth field.
     *
     * @var        DateTime|null
     */
    protected $date_of_birth;

    /**
     * The value for the marital_status field.
     *
     * @var        string|null
     */
    protected $marital_status;

    /**
     * The value for the date_of_anniversary field.
     *
     * @var        DateTime|null
     */
    protected $date_of_anniversary;

    /**
     * The value for the qualification field.
     *
     * @var        string|null
     */
    protected $qualification;

    /**
     * The value for the registration_no field.
     *
     * @var        string|null
     */
    protected $registration_no;

    /**
     * The value for the profile_pic field.
     *
     * @var        string|null
     */
    protected $profile_pic;

    /**
     * The value for the status field.
     *
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the territory field.
     *
     * @var        int|null
     */
    protected $territory;

    /**
     * The value for the position field.
     *
     * @var        int|null
     */
    protected $position;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the created_by_employee_id field.
     *
     * @var        int|null
     */
    protected $created_by_employee_id;

    /**
     * The value for the created_by_position_id field.
     *
     * @var        int|null
     */
    protected $created_by_position_id;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the updated_by_employee_id field.
     *
     * @var        int|null
     */
    protected $updated_by_employee_id;

    /**
     * The value for the updated_by_position_id field.
     *
     * @var        int|null
     */
    protected $updated_by_position_id;

    /**
     * The value for the approved_at field.
     *
     * @var        DateTime|null
     */
    protected $approved_at;

    /**
     * The value for the approved_by_employee_id field.
     *
     * @var        int|null
     */
    protected $approved_by_employee_id;

    /**
     * The value for the approved_by_position_id field.
     *
     * @var        int|null
     */
    protected $approved_by_position_id;

    /**
     * The value for the final_approved_at field.
     *
     * @var        DateTime|null
     */
    protected $final_approved_at;

    /**
     * The value for the final_approved_by_employee_id field.
     *
     * @var        int|null
     */
    protected $final_approved_by_employee_id;

    /**
     * The value for the final_approved_by_position_id field.
     *
     * @var        int|null
     */
    protected $final_approved_by_position_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the descriptioin field.
     *
     * @var        string|null
     */
    protected $descriptioin;

    /**
     * The value for the outlet_type_id field.
     *
     * @var        int|null
     */
    protected $outlet_type_id;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByApprovedByEmployeeId;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByApprovedByPositionId;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByCreatedByEmployeeId;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByCreatedByPositionId;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByFinalApprovedByEmployeeId;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByFinalApprovedByPositionId;

    /**
     * @var        ChildOutlets
     */
    protected $aOutlets;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByPosition;

    /**
     * @var        ChildTerritories
     */
    protected $aTerritories;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployeeRelatedByUpdatedByEmployeeId;

    /**
     * @var        ChildPositions
     */
    protected $aPositionsRelatedByUpdatedByPositionId;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestAddress[] Collection to store aggregation of ChildOnBoardRequestAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress> Collection to store aggregation of ChildOnBoardRequestAddress objects.
     */
    protected $collOnBoardRequestAddresses;
    protected $collOnBoardRequestAddressesPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestLog[] Collection to store aggregation of ChildOnBoardRequestLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog> Collection to store aggregation of ChildOnBoardRequestLog objects.
     */
    protected $collOnBoardRequestLogs;
    protected $collOnBoardRequestLogsPartial;

    /**
     * @var        ObjectCollection|ChildOnBoardRequestOutletMapping[] Collection to store aggregation of ChildOnBoardRequestOutletMapping objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping> Collection to store aggregation of ChildOnBoardRequestOutletMapping objects.
     */
    protected $collOnBoardRequestOutletMappings;
    protected $collOnBoardRequestOutletMappingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestAddress>
     */
    protected $onBoardRequestAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestLog>
     */
    protected $onBoardRequestLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOnBoardRequestOutletMapping[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping>
     */
    protected $onBoardRequestOutletMappingsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
    }

    /**
     * Initializes internal state of entities\Base\OnBoardRequest object.
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
     * Compares this with another <code>OnBoardRequest</code> instance.  If
     * <code>obj</code> is an instance of <code>OnBoardRequest</code>, delegates to
     * <code>equals(OnBoardRequest)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [on_board_request_id] column value.
     *
     * @return int
     */
    public function getOnBoardRequestId()
    {
        return $this->on_board_request_id;
    }

    /**
     * Get the [outlet_id] column value.
     *
     * @return int|null
     */
    public function getOutletId()
    {
        return $this->outlet_id;
    }

    /**
     * Get the [salutation] column value.
     *
     * @return string|null
     */
    public function getSalutation()
    {
        return $this->salutation;
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
     * Get the [email] column value.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [mobile] column value.
     *
     * @return string|null
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Get the [gender] column value.
     *
     * @return string|null
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the [optionally formatted] temporal [date_of_birth] column value.
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
    public function getDateOfBirth($format = null)
    {
        if ($format === null) {
            return $this->date_of_birth;
        } else {
            return $this->date_of_birth instanceof \DateTimeInterface ? $this->date_of_birth->format($format) : null;
        }
    }

    /**
     * Get the [marital_status] column value.
     *
     * @return string|null
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * Get the [optionally formatted] temporal [date_of_anniversary] column value.
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
    public function getDateOfAnniversary($format = null)
    {
        if ($format === null) {
            return $this->date_of_anniversary;
        } else {
            return $this->date_of_anniversary instanceof \DateTimeInterface ? $this->date_of_anniversary->format($format) : null;
        }
    }

    /**
     * Get the [qualification] column value.
     *
     * @return string|null
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Get the [registration_no] column value.
     *
     * @return string|null
     */
    public function getRegistrationNo()
    {
        return $this->registration_no;
    }

    /**
     * Get the [profile_pic] column value.
     *
     * @return string|null
     */
    public function getProfilePic()
    {
        return $this->profile_pic;
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
     * Get the [territory] column value.
     *
     * @return int|null
     */
    public function getTerritory()
    {
        return $this->territory;
    }

    /**
     * Get the [position] column value.
     *
     * @return int|null
     */
    public function getPosition()
    {
        return $this->position;
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
     * Get the [created_by_employee_id] column value.
     *
     * @return int|null
     */
    public function getCreatedByEmployeeId()
    {
        return $this->created_by_employee_id;
    }

    /**
     * Get the [created_by_position_id] column value.
     *
     * @return int|null
     */
    public function getCreatedByPositionId()
    {
        return $this->created_by_position_id;
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
     * Get the [updated_by_employee_id] column value.
     *
     * @return int|null
     */
    public function getUpdatedByEmployeeId()
    {
        return $this->updated_by_employee_id;
    }

    /**
     * Get the [updated_by_position_id] column value.
     *
     * @return int|null
     */
    public function getUpdatedByPositionId()
    {
        return $this->updated_by_position_id;
    }

    /**
     * Get the [optionally formatted] temporal [approved_at] column value.
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
    public function getApprovedAt($format = null)
    {
        if ($format === null) {
            return $this->approved_at;
        } else {
            return $this->approved_at instanceof \DateTimeInterface ? $this->approved_at->format($format) : null;
        }
    }

    /**
     * Get the [approved_by_employee_id] column value.
     *
     * @return int|null
     */
    public function getApprovedByEmployeeId()
    {
        return $this->approved_by_employee_id;
    }

    /**
     * Get the [approved_by_position_id] column value.
     *
     * @return int|null
     */
    public function getApprovedByPositionId()
    {
        return $this->approved_by_position_id;
    }

    /**
     * Get the [optionally formatted] temporal [final_approved_at] column value.
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
    public function getFinalApprovedAt($format = null)
    {
        if ($format === null) {
            return $this->final_approved_at;
        } else {
            return $this->final_approved_at instanceof \DateTimeInterface ? $this->final_approved_at->format($format) : null;
        }
    }

    /**
     * Get the [final_approved_by_employee_id] column value.
     *
     * @return int|null
     */
    public function getFinalApprovedByEmployeeId()
    {
        return $this->final_approved_by_employee_id;
    }

    /**
     * Get the [final_approved_by_position_id] column value.
     *
     * @return int|null
     */
    public function getFinalApprovedByPositionId()
    {
        return $this->final_approved_by_position_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [descriptioin] column value.
     *
     * @return string|null
     */
    public function getDescriptioin()
    {
        return $this->descriptioin;
    }

    /**
     * Get the [outlet_type_id] column value.
     *
     * @return int|null
     */
    public function getOutletTypeId()
    {
        return $this->outlet_type_id;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [outlet_code] column value.
     *
     * @return string|null
     */
    public function getOutletCode()
    {
        return $this->outlet_code;
    }

    /**
     * Set the value of [on_board_request_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_board_request_id !== $v) {
            $this->on_board_request_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_OUTLET_ID] = true;
        }

        if ($this->aOutlets !== null && $this->aOutlets->getId() !== $v) {
            $this->aOutlets = null;
        }

        return $this;
    }

    /**
     * Set the value of [salutation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_SALUTATION] = true;
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
            $this->modifiedColumns[OnBoardRequestTableMap::COL_FIRST_NAME] = true;
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
            $this->modifiedColumns[OnBoardRequestTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mobile] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mobile !== $v) {
            $this->mobile = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_MOBILE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gender] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_GENDER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date_of_birth] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_of_birth !== null || $dt !== null) {
            if ($this->date_of_birth === null || $dt === null || $dt->format("Y-m-d") !== $this->date_of_birth->format("Y-m-d")) {
                $this->date_of_birth = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnBoardRequestTableMap::COL_DATE_OF_BIRTH] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [marital_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMaritalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->marital_status !== $v) {
            $this->marital_status = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_MARITAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date_of_anniversary] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDateOfAnniversary($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_of_anniversary !== null || $dt !== null) {
            if ($this->date_of_anniversary === null || $dt === null || $dt->format("Y-m-d") !== $this->date_of_anniversary->format("Y-m-d")) {
                $this->date_of_anniversary = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [qualification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setQualification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->qualification !== $v) {
            $this->qualification = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_QUALIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [registration_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistrationNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->registration_no !== $v) {
            $this->registration_no = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_REGISTRATION_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [profile_pic] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProfilePic($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->profile_pic !== $v) {
            $this->profile_pic = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_PROFILE_PIC] = true;
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
            $this->modifiedColumns[OnBoardRequestTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTerritory($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory !== $v) {
            $this->territory = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_TERRITORY] = true;
        }

        if ($this->aTerritories !== null && $this->aTerritories->getTerritoryId() !== $v) {
            $this->aTerritories = null;
        }

        return $this;
    }

    /**
     * Set the value of [position] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPosition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position !== $v) {
            $this->position = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_POSITION] = true;
        }

        if ($this->aPositionsRelatedByPosition !== null && $this->aPositionsRelatedByPosition->getPositionId() !== $v) {
            $this->aPositionsRelatedByPosition = null;
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
                $this->modifiedColumns[OnBoardRequestTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [created_by_employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedByEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->created_by_employee_id !== $v) {
            $this->created_by_employee_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployeeRelatedByCreatedByEmployeeId !== null && $this->aEmployeeRelatedByCreatedByEmployeeId->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByCreatedByEmployeeId = null;
        }

        return $this;
    }

    /**
     * Set the value of [created_by_position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedByPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->created_by_position_id !== $v) {
            $this->created_by_position_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID] = true;
        }

        if ($this->aPositionsRelatedByCreatedByPositionId !== null && $this->aPositionsRelatedByCreatedByPositionId->getPositionId() !== $v) {
            $this->aPositionsRelatedByCreatedByPositionId = null;
        }

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
                $this->modifiedColumns[OnBoardRequestTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [updated_by_employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedByEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->updated_by_employee_id !== $v) {
            $this->updated_by_employee_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployeeRelatedByUpdatedByEmployeeId !== null && $this->aEmployeeRelatedByUpdatedByEmployeeId->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByUpdatedByEmployeeId = null;
        }

        return $this;
    }

    /**
     * Set the value of [updated_by_position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedByPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->updated_by_position_id !== $v) {
            $this->updated_by_position_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID] = true;
        }

        if ($this->aPositionsRelatedByUpdatedByPositionId !== null && $this->aPositionsRelatedByUpdatedByPositionId->getPositionId() !== $v) {
            $this->aPositionsRelatedByUpdatedByPositionId = null;
        }

        return $this;
    }

    /**
     * Sets the value of [approved_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setApprovedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->approved_at !== null || $dt !== null) {
            if ($this->approved_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->approved_at->format("Y-m-d H:i:s.u")) {
                $this->approved_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnBoardRequestTableMap::COL_APPROVED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [approved_by_employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApprovedByEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->approved_by_employee_id !== $v) {
            $this->approved_by_employee_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployeeRelatedByApprovedByEmployeeId !== null && $this->aEmployeeRelatedByApprovedByEmployeeId->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByApprovedByEmployeeId = null;
        }

        return $this;
    }

    /**
     * Set the value of [approved_by_position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApprovedByPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->approved_by_position_id !== $v) {
            $this->approved_by_position_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID] = true;
        }

        if ($this->aPositionsRelatedByApprovedByPositionId !== null && $this->aPositionsRelatedByApprovedByPositionId->getPositionId() !== $v) {
            $this->aPositionsRelatedByApprovedByPositionId = null;
        }

        return $this;
    }

    /**
     * Sets the value of [final_approved_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setFinalApprovedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->final_approved_at !== null || $dt !== null) {
            if ($this->final_approved_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->final_approved_at->format("Y-m-d H:i:s.u")) {
                $this->final_approved_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OnBoardRequestTableMap::COL_FINAL_APPROVED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [final_approved_by_employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFinalApprovedByEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->final_approved_by_employee_id !== $v) {
            $this->final_approved_by_employee_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployeeRelatedByFinalApprovedByEmployeeId !== null && $this->aEmployeeRelatedByFinalApprovedByEmployeeId->getEmployeeId() !== $v) {
            $this->aEmployeeRelatedByFinalApprovedByEmployeeId = null;
        }

        return $this;
    }

    /**
     * Set the value of [final_approved_by_position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFinalApprovedByPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->final_approved_by_position_id !== $v) {
            $this->final_approved_by_position_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID] = true;
        }

        if ($this->aPositionsRelatedByFinalApprovedByPositionId !== null && $this->aPositionsRelatedByFinalApprovedByPositionId->getPositionId() !== $v) {
            $this->aPositionsRelatedByFinalApprovedByPositionId = null;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [descriptioin] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDescriptioin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descriptioin !== $v) {
            $this->descriptioin = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_DESCRIPTIOIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_type_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_type_id !== $v) {
            $this->outlet_type_id = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_OUTLET_TYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[OnBoardRequestTableMap::COL_OUTLET_CODE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OnBoardRequestTableMap::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_request_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OnBoardRequestTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OnBoardRequestTableMap::translateFieldName('Salutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salutation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OnBoardRequestTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OnBoardRequestTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OnBoardRequestTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OnBoardRequestTableMap::translateFieldName('Mobile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mobile = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OnBoardRequestTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OnBoardRequestTableMap::translateFieldName('DateOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_of_birth = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OnBoardRequestTableMap::translateFieldName('MaritalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->marital_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OnBoardRequestTableMap::translateFieldName('DateOfAnniversary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_of_anniversary = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OnBoardRequestTableMap::translateFieldName('Qualification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qualification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OnBoardRequestTableMap::translateFieldName('RegistrationNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registration_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OnBoardRequestTableMap::translateFieldName('ProfilePic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->profile_pic = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OnBoardRequestTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OnBoardRequestTableMap::translateFieldName('Territory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OnBoardRequestTableMap::translateFieldName('Position', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OnBoardRequestTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OnBoardRequestTableMap::translateFieldName('CreatedByEmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_by_employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OnBoardRequestTableMap::translateFieldName('CreatedByPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_by_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OnBoardRequestTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OnBoardRequestTableMap::translateFieldName('UpdatedByEmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_by_employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OnBoardRequestTableMap::translateFieldName('UpdatedByPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_by_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OnBoardRequestTableMap::translateFieldName('ApprovedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OnBoardRequestTableMap::translateFieldName('ApprovedByEmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_by_employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : OnBoardRequestTableMap::translateFieldName('ApprovedByPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_by_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : OnBoardRequestTableMap::translateFieldName('FinalApprovedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_approved_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : OnBoardRequestTableMap::translateFieldName('FinalApprovedByEmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_approved_by_employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : OnBoardRequestTableMap::translateFieldName('FinalApprovedByPositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->final_approved_by_position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : OnBoardRequestTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : OnBoardRequestTableMap::translateFieldName('Descriptioin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descriptioin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : OnBoardRequestTableMap::translateFieldName('OutletTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : OnBoardRequestTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : OnBoardRequestTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 34; // 34 = OnBoardRequestTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OnBoardRequest'), 0, $e);
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
        if ($this->aOutlets !== null && $this->outlet_id !== $this->aOutlets->getId()) {
            $this->aOutlets = null;
        }
        if ($this->aTerritories !== null && $this->territory !== $this->aTerritories->getTerritoryId()) {
            $this->aTerritories = null;
        }
        if ($this->aPositionsRelatedByPosition !== null && $this->position !== $this->aPositionsRelatedByPosition->getPositionId()) {
            $this->aPositionsRelatedByPosition = null;
        }
        if ($this->aEmployeeRelatedByCreatedByEmployeeId !== null && $this->created_by_employee_id !== $this->aEmployeeRelatedByCreatedByEmployeeId->getEmployeeId()) {
            $this->aEmployeeRelatedByCreatedByEmployeeId = null;
        }
        if ($this->aPositionsRelatedByCreatedByPositionId !== null && $this->created_by_position_id !== $this->aPositionsRelatedByCreatedByPositionId->getPositionId()) {
            $this->aPositionsRelatedByCreatedByPositionId = null;
        }
        if ($this->aEmployeeRelatedByUpdatedByEmployeeId !== null && $this->updated_by_employee_id !== $this->aEmployeeRelatedByUpdatedByEmployeeId->getEmployeeId()) {
            $this->aEmployeeRelatedByUpdatedByEmployeeId = null;
        }
        if ($this->aPositionsRelatedByUpdatedByPositionId !== null && $this->updated_by_position_id !== $this->aPositionsRelatedByUpdatedByPositionId->getPositionId()) {
            $this->aPositionsRelatedByUpdatedByPositionId = null;
        }
        if ($this->aEmployeeRelatedByApprovedByEmployeeId !== null && $this->approved_by_employee_id !== $this->aEmployeeRelatedByApprovedByEmployeeId->getEmployeeId()) {
            $this->aEmployeeRelatedByApprovedByEmployeeId = null;
        }
        if ($this->aPositionsRelatedByApprovedByPositionId !== null && $this->approved_by_position_id !== $this->aPositionsRelatedByApprovedByPositionId->getPositionId()) {
            $this->aPositionsRelatedByApprovedByPositionId = null;
        }
        if ($this->aEmployeeRelatedByFinalApprovedByEmployeeId !== null && $this->final_approved_by_employee_id !== $this->aEmployeeRelatedByFinalApprovedByEmployeeId->getEmployeeId()) {
            $this->aEmployeeRelatedByFinalApprovedByEmployeeId = null;
        }
        if ($this->aPositionsRelatedByFinalApprovedByPositionId !== null && $this->final_approved_by_position_id !== $this->aPositionsRelatedByFinalApprovedByPositionId->getPositionId()) {
            $this->aPositionsRelatedByFinalApprovedByPositionId = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOutletType !== null && $this->outlet_type_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOnBoardRequestQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmployeeRelatedByApprovedByEmployeeId = null;
            $this->aPositionsRelatedByApprovedByPositionId = null;
            $this->aCompany = null;
            $this->aEmployeeRelatedByCreatedByEmployeeId = null;
            $this->aPositionsRelatedByCreatedByPositionId = null;
            $this->aEmployeeRelatedByFinalApprovedByEmployeeId = null;
            $this->aPositionsRelatedByFinalApprovedByPositionId = null;
            $this->aOutlets = null;
            $this->aOutletType = null;
            $this->aPositionsRelatedByPosition = null;
            $this->aTerritories = null;
            $this->aEmployeeRelatedByUpdatedByEmployeeId = null;
            $this->aPositionsRelatedByUpdatedByPositionId = null;
            $this->collOnBoardRequestAddresses = null;

            $this->collOnBoardRequestLogs = null;

            $this->collOnBoardRequestOutletMappings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see OnBoardRequest::setDeleted()
     * @see OnBoardRequest::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOnBoardRequestQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
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
                OnBoardRequestTableMap::addInstanceToPool($this);
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

            if ($this->aEmployeeRelatedByApprovedByEmployeeId !== null) {
                if ($this->aEmployeeRelatedByApprovedByEmployeeId->isModified() || $this->aEmployeeRelatedByApprovedByEmployeeId->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByApprovedByEmployeeId->save($con);
                }
                $this->setEmployeeRelatedByApprovedByEmployeeId($this->aEmployeeRelatedByApprovedByEmployeeId);
            }

            if ($this->aPositionsRelatedByApprovedByPositionId !== null) {
                if ($this->aPositionsRelatedByApprovedByPositionId->isModified() || $this->aPositionsRelatedByApprovedByPositionId->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByApprovedByPositionId->save($con);
                }
                $this->setPositionsRelatedByApprovedByPositionId($this->aPositionsRelatedByApprovedByPositionId);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aEmployeeRelatedByCreatedByEmployeeId !== null) {
                if ($this->aEmployeeRelatedByCreatedByEmployeeId->isModified() || $this->aEmployeeRelatedByCreatedByEmployeeId->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByCreatedByEmployeeId->save($con);
                }
                $this->setEmployeeRelatedByCreatedByEmployeeId($this->aEmployeeRelatedByCreatedByEmployeeId);
            }

            if ($this->aPositionsRelatedByCreatedByPositionId !== null) {
                if ($this->aPositionsRelatedByCreatedByPositionId->isModified() || $this->aPositionsRelatedByCreatedByPositionId->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByCreatedByPositionId->save($con);
                }
                $this->setPositionsRelatedByCreatedByPositionId($this->aPositionsRelatedByCreatedByPositionId);
            }

            if ($this->aEmployeeRelatedByFinalApprovedByEmployeeId !== null) {
                if ($this->aEmployeeRelatedByFinalApprovedByEmployeeId->isModified() || $this->aEmployeeRelatedByFinalApprovedByEmployeeId->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByFinalApprovedByEmployeeId->save($con);
                }
                $this->setEmployeeRelatedByFinalApprovedByEmployeeId($this->aEmployeeRelatedByFinalApprovedByEmployeeId);
            }

            if ($this->aPositionsRelatedByFinalApprovedByPositionId !== null) {
                if ($this->aPositionsRelatedByFinalApprovedByPositionId->isModified() || $this->aPositionsRelatedByFinalApprovedByPositionId->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByFinalApprovedByPositionId->save($con);
                }
                $this->setPositionsRelatedByFinalApprovedByPositionId($this->aPositionsRelatedByFinalApprovedByPositionId);
            }

            if ($this->aOutlets !== null) {
                if ($this->aOutlets->isModified() || $this->aOutlets->isNew()) {
                    $affectedRows += $this->aOutlets->save($con);
                }
                $this->setOutlets($this->aOutlets);
            }

            if ($this->aOutletType !== null) {
                if ($this->aOutletType->isModified() || $this->aOutletType->isNew()) {
                    $affectedRows += $this->aOutletType->save($con);
                }
                $this->setOutletType($this->aOutletType);
            }

            if ($this->aPositionsRelatedByPosition !== null) {
                if ($this->aPositionsRelatedByPosition->isModified() || $this->aPositionsRelatedByPosition->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByPosition->save($con);
                }
                $this->setPositionsRelatedByPosition($this->aPositionsRelatedByPosition);
            }

            if ($this->aTerritories !== null) {
                if ($this->aTerritories->isModified() || $this->aTerritories->isNew()) {
                    $affectedRows += $this->aTerritories->save($con);
                }
                $this->setTerritories($this->aTerritories);
            }

            if ($this->aEmployeeRelatedByUpdatedByEmployeeId !== null) {
                if ($this->aEmployeeRelatedByUpdatedByEmployeeId->isModified() || $this->aEmployeeRelatedByUpdatedByEmployeeId->isNew()) {
                    $affectedRows += $this->aEmployeeRelatedByUpdatedByEmployeeId->save($con);
                }
                $this->setEmployeeRelatedByUpdatedByEmployeeId($this->aEmployeeRelatedByUpdatedByEmployeeId);
            }

            if ($this->aPositionsRelatedByUpdatedByPositionId !== null) {
                if ($this->aPositionsRelatedByUpdatedByPositionId->isModified() || $this->aPositionsRelatedByUpdatedByPositionId->isNew()) {
                    $affectedRows += $this->aPositionsRelatedByUpdatedByPositionId->save($con);
                }
                $this->setPositionsRelatedByUpdatedByPositionId($this->aPositionsRelatedByUpdatedByPositionId);
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

            if ($this->onBoardRequestAddressesScheduledForDeletion !== null) {
                if (!$this->onBoardRequestAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestAddressesScheduledForDeletion as $onBoardRequestAddress) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestAddress->save($con);
                    }
                    $this->onBoardRequestAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestAddresses !== null) {
                foreach ($this->collOnBoardRequestAddresses as $referrerFK) {
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

            if ($this->onBoardRequestOutletMappingsScheduledForDeletion !== null) {
                if (!$this->onBoardRequestOutletMappingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->onBoardRequestOutletMappingsScheduledForDeletion as $onBoardRequestOutletMapping) {
                        // need to save related object because we set the relation to null
                        $onBoardRequestOutletMapping->save($con);
                    }
                    $this->onBoardRequestOutletMappingsScheduledForDeletion = null;
                }
            }

            if ($this->collOnBoardRequestOutletMappings !== null) {
                foreach ($this->collOnBoardRequestOutletMappings as $referrerFK) {
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

        $this->modifiedColumns[OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID] = true;
        if (null !== $this->on_board_request_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID . ')');
        }
        if (null === $this->on_board_request_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('on_board_request_on_board_request_id_seq')");
                $this->on_board_request_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'on_board_request_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'salutation';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_MOBILE)) {
            $modifiedColumns[':p' . $index++]  = 'mobile';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DATE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'date_of_birth';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_MARITAL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'marital_status';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY)) {
            $modifiedColumns[':p' . $index++]  = 'date_of_anniversary';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_QUALIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'qualification';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_REGISTRATION_NO)) {
            $modifiedColumns[':p' . $index++]  = 'registration_no';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_PROFILE_PIC)) {
            $modifiedColumns[':p' . $index++]  = 'profile_pic';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_TERRITORY)) {
            $modifiedColumns[':p' . $index++]  = 'territory';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'position';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'created_by_employee_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'created_by_position_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by_employee_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by_position_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'approved_at';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'approved_by_employee_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'approved_by_position_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'final_approved_at';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'final_approved_by_employee_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'final_approved_by_position_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DESCRIPTIOIN)) {
            $modifiedColumns[':p' . $index++]  = 'descriptioin';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_type_id';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_name';
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_code';
        }

        $sql = sprintf(
            'INSERT INTO on_board_request (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'on_board_request_id':
                        $stmt->bindValue($identifier, $this->on_board_request_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_id':
                        $stmt->bindValue($identifier, $this->outlet_id, PDO::PARAM_INT);

                        break;
                    case 'salutation':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_STR);

                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);

                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'mobile':
                        $stmt->bindValue($identifier, $this->mobile, PDO::PARAM_STR);

                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_STR);

                        break;
                    case 'date_of_birth':
                        $stmt->bindValue($identifier, $this->date_of_birth ? $this->date_of_birth->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'marital_status':
                        $stmt->bindValue($identifier, $this->marital_status, PDO::PARAM_STR);

                        break;
                    case 'date_of_anniversary':
                        $stmt->bindValue($identifier, $this->date_of_anniversary ? $this->date_of_anniversary->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'qualification':
                        $stmt->bindValue($identifier, $this->qualification, PDO::PARAM_STR);

                        break;
                    case 'registration_no':
                        $stmt->bindValue($identifier, $this->registration_no, PDO::PARAM_STR);

                        break;
                    case 'profile_pic':
                        $stmt->bindValue($identifier, $this->profile_pic, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'territory':
                        $stmt->bindValue($identifier, $this->territory, PDO::PARAM_INT);

                        break;
                    case 'position':
                        $stmt->bindValue($identifier, $this->position, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'created_by_employee_id':
                        $stmt->bindValue($identifier, $this->created_by_employee_id, PDO::PARAM_INT);

                        break;
                    case 'created_by_position_id':
                        $stmt->bindValue($identifier, $this->created_by_position_id, PDO::PARAM_INT);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_by_employee_id':
                        $stmt->bindValue($identifier, $this->updated_by_employee_id, PDO::PARAM_INT);

                        break;
                    case 'updated_by_position_id':
                        $stmt->bindValue($identifier, $this->updated_by_position_id, PDO::PARAM_INT);

                        break;
                    case 'approved_at':
                        $stmt->bindValue($identifier, $this->approved_at ? $this->approved_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'approved_by_employee_id':
                        $stmt->bindValue($identifier, $this->approved_by_employee_id, PDO::PARAM_INT);

                        break;
                    case 'approved_by_position_id':
                        $stmt->bindValue($identifier, $this->approved_by_position_id, PDO::PARAM_INT);

                        break;
                    case 'final_approved_at':
                        $stmt->bindValue($identifier, $this->final_approved_at ? $this->final_approved_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'final_approved_by_employee_id':
                        $stmt->bindValue($identifier, $this->final_approved_by_employee_id, PDO::PARAM_INT);

                        break;
                    case 'final_approved_by_position_id':
                        $stmt->bindValue($identifier, $this->final_approved_by_position_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'descriptioin':
                        $stmt->bindValue($identifier, $this->descriptioin, PDO::PARAM_STR);

                        break;
                    case 'outlet_type_id':
                        $stmt->bindValue($identifier, $this->outlet_type_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_name':
                        $stmt->bindValue($identifier, $this->outlet_name, PDO::PARAM_STR);

                        break;
                    case 'outlet_code':
                        $stmt->bindValue($identifier, $this->outlet_code, PDO::PARAM_STR);

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
        $pos = OnBoardRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOnBoardRequestId();

            case 1:
                return $this->getOutletId();

            case 2:
                return $this->getSalutation();

            case 3:
                return $this->getFirstName();

            case 4:
                return $this->getLastName();

            case 5:
                return $this->getEmail();

            case 6:
                return $this->getMobile();

            case 7:
                return $this->getGender();

            case 8:
                return $this->getDateOfBirth();

            case 9:
                return $this->getMaritalStatus();

            case 10:
                return $this->getDateOfAnniversary();

            case 11:
                return $this->getQualification();

            case 12:
                return $this->getRegistrationNo();

            case 13:
                return $this->getProfilePic();

            case 14:
                return $this->getStatus();

            case 15:
                return $this->getTerritory();

            case 16:
                return $this->getPosition();

            case 17:
                return $this->getCreatedAt();

            case 18:
                return $this->getCreatedByEmployeeId();

            case 19:
                return $this->getCreatedByPositionId();

            case 20:
                return $this->getUpdatedAt();

            case 21:
                return $this->getUpdatedByEmployeeId();

            case 22:
                return $this->getUpdatedByPositionId();

            case 23:
                return $this->getApprovedAt();

            case 24:
                return $this->getApprovedByEmployeeId();

            case 25:
                return $this->getApprovedByPositionId();

            case 26:
                return $this->getFinalApprovedAt();

            case 27:
                return $this->getFinalApprovedByEmployeeId();

            case 28:
                return $this->getFinalApprovedByPositionId();

            case 29:
                return $this->getCompanyId();

            case 30:
                return $this->getDescriptioin();

            case 31:
                return $this->getOutletTypeId();

            case 32:
                return $this->getOutletName();

            case 33:
                return $this->getOutletCode();

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
        if (isset($alreadyDumpedObjects['OnBoardRequest'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OnBoardRequest'][$this->hashCode()] = true;
        $keys = OnBoardRequestTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOnBoardRequestId(),
            $keys[1] => $this->getOutletId(),
            $keys[2] => $this->getSalutation(),
            $keys[3] => $this->getFirstName(),
            $keys[4] => $this->getLastName(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getMobile(),
            $keys[7] => $this->getGender(),
            $keys[8] => $this->getDateOfBirth(),
            $keys[9] => $this->getMaritalStatus(),
            $keys[10] => $this->getDateOfAnniversary(),
            $keys[11] => $this->getQualification(),
            $keys[12] => $this->getRegistrationNo(),
            $keys[13] => $this->getProfilePic(),
            $keys[14] => $this->getStatus(),
            $keys[15] => $this->getTerritory(),
            $keys[16] => $this->getPosition(),
            $keys[17] => $this->getCreatedAt(),
            $keys[18] => $this->getCreatedByEmployeeId(),
            $keys[19] => $this->getCreatedByPositionId(),
            $keys[20] => $this->getUpdatedAt(),
            $keys[21] => $this->getUpdatedByEmployeeId(),
            $keys[22] => $this->getUpdatedByPositionId(),
            $keys[23] => $this->getApprovedAt(),
            $keys[24] => $this->getApprovedByEmployeeId(),
            $keys[25] => $this->getApprovedByPositionId(),
            $keys[26] => $this->getFinalApprovedAt(),
            $keys[27] => $this->getFinalApprovedByEmployeeId(),
            $keys[28] => $this->getFinalApprovedByPositionId(),
            $keys[29] => $this->getCompanyId(),
            $keys[30] => $this->getDescriptioin(),
            $keys[31] => $this->getOutletTypeId(),
            $keys[32] => $this->getOutletName(),
            $keys[33] => $this->getOutletCode(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[20]] instanceof \DateTimeInterface) {
            $result[$keys[20]] = $result[$keys[20]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[26]] instanceof \DateTimeInterface) {
            $result[$keys[26]] = $result[$keys[26]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEmployeeRelatedByApprovedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByApprovedByEmployeeId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByApprovedByPositionId) {

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

                $result[$key] = $this->aPositionsRelatedByApprovedByPositionId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aEmployeeRelatedByCreatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByCreatedByEmployeeId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByCreatedByPositionId) {

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

                $result[$key] = $this->aPositionsRelatedByCreatedByPositionId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployeeRelatedByFinalApprovedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByFinalApprovedByEmployeeId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByFinalApprovedByPositionId) {

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

                $result[$key] = $this->aPositionsRelatedByFinalApprovedByPositionId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutlets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outlets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlets';
                        break;
                    default:
                        $key = 'Outlets';
                }

                $result[$key] = $this->aOutlets->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutletType) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletType';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_type';
                        break;
                    default:
                        $key = 'OutletType';
                }

                $result[$key] = $this->aOutletType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByPosition) {

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

                $result[$key] = $this->aPositionsRelatedByPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTerritories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'territories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'territories';
                        break;
                    default:
                        $key = 'Territories';
                }

                $result[$key] = $this->aTerritories->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployeeRelatedByUpdatedByEmployeeId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployeeRelatedByUpdatedByEmployeeId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPositionsRelatedByUpdatedByPositionId) {

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

                $result[$key] = $this->aPositionsRelatedByUpdatedByPositionId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOnBoardRequestAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_addresses';
                        break;
                    default:
                        $key = 'OnBoardRequestAddresses';
                }

                $result[$key] = $this->collOnBoardRequestAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOnBoardRequestOutletMappings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequestOutletMappings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request_outlet_mappings';
                        break;
                    default:
                        $key = 'OnBoardRequestOutletMappings';
                }

                $result[$key] = $this->collOnBoardRequestOutletMappings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = OnBoardRequestTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOnBoardRequestId($value);
                break;
            case 1:
                $this->setOutletId($value);
                break;
            case 2:
                $this->setSalutation($value);
                break;
            case 3:
                $this->setFirstName($value);
                break;
            case 4:
                $this->setLastName($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setMobile($value);
                break;
            case 7:
                $this->setGender($value);
                break;
            case 8:
                $this->setDateOfBirth($value);
                break;
            case 9:
                $this->setMaritalStatus($value);
                break;
            case 10:
                $this->setDateOfAnniversary($value);
                break;
            case 11:
                $this->setQualification($value);
                break;
            case 12:
                $this->setRegistrationNo($value);
                break;
            case 13:
                $this->setProfilePic($value);
                break;
            case 14:
                $this->setStatus($value);
                break;
            case 15:
                $this->setTerritory($value);
                break;
            case 16:
                $this->setPosition($value);
                break;
            case 17:
                $this->setCreatedAt($value);
                break;
            case 18:
                $this->setCreatedByEmployeeId($value);
                break;
            case 19:
                $this->setCreatedByPositionId($value);
                break;
            case 20:
                $this->setUpdatedAt($value);
                break;
            case 21:
                $this->setUpdatedByEmployeeId($value);
                break;
            case 22:
                $this->setUpdatedByPositionId($value);
                break;
            case 23:
                $this->setApprovedAt($value);
                break;
            case 24:
                $this->setApprovedByEmployeeId($value);
                break;
            case 25:
                $this->setApprovedByPositionId($value);
                break;
            case 26:
                $this->setFinalApprovedAt($value);
                break;
            case 27:
                $this->setFinalApprovedByEmployeeId($value);
                break;
            case 28:
                $this->setFinalApprovedByPositionId($value);
                break;
            case 29:
                $this->setCompanyId($value);
                break;
            case 30:
                $this->setDescriptioin($value);
                break;
            case 31:
                $this->setOutletTypeId($value);
                break;
            case 32:
                $this->setOutletName($value);
                break;
            case 33:
                $this->setOutletCode($value);
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
        $keys = OnBoardRequestTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOnBoardRequestId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSalutation($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFirstName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLastName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMobile($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGender($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDateOfBirth($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMaritalStatus($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDateOfAnniversary($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setQualification($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setRegistrationNo($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setProfilePic($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setStatus($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setTerritory($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPosition($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCreatedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCreatedByEmployeeId($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCreatedByPositionId($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setUpdatedAt($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setUpdatedByEmployeeId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setUpdatedByPositionId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setApprovedAt($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setApprovedByEmployeeId($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setApprovedByPositionId($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setFinalApprovedAt($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setFinalApprovedByEmployeeId($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setFinalApprovedByPositionId($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setCompanyId($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setDescriptioin($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setOutletTypeId($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setOutletName($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setOutletCode($arr[$keys[33]]);
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
        $criteria = new Criteria(OnBoardRequestTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $this->on_board_request_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_SALUTATION)) {
            $criteria->add(OnBoardRequestTableMap::COL_SALUTATION, $this->salutation);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FIRST_NAME)) {
            $criteria->add(OnBoardRequestTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_LAST_NAME)) {
            $criteria->add(OnBoardRequestTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_EMAIL)) {
            $criteria->add(OnBoardRequestTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_MOBILE)) {
            $criteria->add(OnBoardRequestTableMap::COL_MOBILE, $this->mobile);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_GENDER)) {
            $criteria->add(OnBoardRequestTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DATE_OF_BIRTH)) {
            $criteria->add(OnBoardRequestTableMap::COL_DATE_OF_BIRTH, $this->date_of_birth);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_MARITAL_STATUS)) {
            $criteria->add(OnBoardRequestTableMap::COL_MARITAL_STATUS, $this->marital_status);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY)) {
            $criteria->add(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY, $this->date_of_anniversary);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_QUALIFICATION)) {
            $criteria->add(OnBoardRequestTableMap::COL_QUALIFICATION, $this->qualification);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_REGISTRATION_NO)) {
            $criteria->add(OnBoardRequestTableMap::COL_REGISTRATION_NO, $this->registration_no);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_PROFILE_PIC)) {
            $criteria->add(OnBoardRequestTableMap::COL_PROFILE_PIC, $this->profile_pic);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_STATUS)) {
            $criteria->add(OnBoardRequestTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_TERRITORY)) {
            $criteria->add(OnBoardRequestTableMap::COL_TERRITORY, $this->territory);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_POSITION)) {
            $criteria->add(OnBoardRequestTableMap::COL_POSITION, $this->position);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_AT)) {
            $criteria->add(OnBoardRequestTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, $this->created_by_employee_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, $this->created_by_position_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_AT)) {
            $criteria->add(OnBoardRequestTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, $this->updated_by_employee_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, $this->updated_by_position_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_AT)) {
            $criteria->add(OnBoardRequestTableMap::COL_APPROVED_AT, $this->approved_at);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, $this->approved_by_employee_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, $this->approved_by_position_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT)) {
            $criteria->add(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT, $this->final_approved_at);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, $this->final_approved_by_employee_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, $this->final_approved_by_position_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_COMPANY_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_DESCRIPTIOIN)) {
            $criteria->add(OnBoardRequestTableMap::COL_DESCRIPTIOIN, $this->descriptioin);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID)) {
            $criteria->add(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, $this->outlet_type_id);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_NAME)) {
            $criteria->add(OnBoardRequestTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(OnBoardRequestTableMap::COL_OUTLET_CODE)) {
            $criteria->add(OnBoardRequestTableMap::COL_OUTLET_CODE, $this->outlet_code);
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
        $criteria = ChildOnBoardRequestQuery::create();
        $criteria->add(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, $this->on_board_request_id);

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
        $validPk = null !== $this->getOnBoardRequestId();

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
        return $this->getOnBoardRequestId();
    }

    /**
     * Generic method to set the primary key (on_board_request_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOnBoardRequestId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOnBoardRequestId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OnBoardRequest (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setMobile($this->getMobile());
        $copyObj->setGender($this->getGender());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setMaritalStatus($this->getMaritalStatus());
        $copyObj->setDateOfAnniversary($this->getDateOfAnniversary());
        $copyObj->setQualification($this->getQualification());
        $copyObj->setRegistrationNo($this->getRegistrationNo());
        $copyObj->setProfilePic($this->getProfilePic());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setTerritory($this->getTerritory());
        $copyObj->setPosition($this->getPosition());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setCreatedByEmployeeId($this->getCreatedByEmployeeId());
        $copyObj->setCreatedByPositionId($this->getCreatedByPositionId());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setUpdatedByEmployeeId($this->getUpdatedByEmployeeId());
        $copyObj->setUpdatedByPositionId($this->getUpdatedByPositionId());
        $copyObj->setApprovedAt($this->getApprovedAt());
        $copyObj->setApprovedByEmployeeId($this->getApprovedByEmployeeId());
        $copyObj->setApprovedByPositionId($this->getApprovedByPositionId());
        $copyObj->setFinalApprovedAt($this->getFinalApprovedAt());
        $copyObj->setFinalApprovedByEmployeeId($this->getFinalApprovedByEmployeeId());
        $copyObj->setFinalApprovedByPositionId($this->getFinalApprovedByPositionId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setDescriptioin($this->getDescriptioin());
        $copyObj->setOutletTypeId($this->getOutletTypeId());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletCode($this->getOutletCode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOnBoardRequestAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOnBoardRequestOutletMappings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOnBoardRequestOutletMapping($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOnBoardRequestId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\OnBoardRequest Clone of current object.
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
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByApprovedByEmployeeId(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setApprovedByEmployeeId(NULL);
        } else {
            $this->setApprovedByEmployeeId($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByApprovedByEmployeeId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByApprovedByEmployeeId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByApprovedByEmployeeId(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByApprovedByEmployeeId === null && ($this->approved_by_employee_id != 0)) {
            $this->aEmployeeRelatedByApprovedByEmployeeId = ChildEmployeeQuery::create()->findPk($this->approved_by_employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByApprovedByEmployeeId->addOnBoardRequestsRelatedByApprovedByEmployeeId($this);
             */
        }

        return $this->aEmployeeRelatedByApprovedByEmployeeId;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByApprovedByPositionId(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setApprovedByPositionId(NULL);
        } else {
            $this->setApprovedByPositionId($v->getPositionId());
        }

        $this->aPositionsRelatedByApprovedByPositionId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByApprovedByPositionId($this);
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
    public function getPositionsRelatedByApprovedByPositionId(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByApprovedByPositionId === null && ($this->approved_by_position_id != 0)) {
            $this->aPositionsRelatedByApprovedByPositionId = ChildPositionsQuery::create()->findPk($this->approved_by_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByApprovedByPositionId->addOnBoardRequestsRelatedByApprovedByPositionId($this);
             */
        }

        return $this->aPositionsRelatedByApprovedByPositionId;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param ChildCompany|null $v
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
            $v->addOnBoardRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
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
                $this->aCompany->addOnBoardRequests($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByCreatedByEmployeeId(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setCreatedByEmployeeId(NULL);
        } else {
            $this->setCreatedByEmployeeId($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByCreatedByEmployeeId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByCreatedByEmployeeId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByCreatedByEmployeeId(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByCreatedByEmployeeId === null && ($this->created_by_employee_id != 0)) {
            $this->aEmployeeRelatedByCreatedByEmployeeId = ChildEmployeeQuery::create()->findPk($this->created_by_employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByCreatedByEmployeeId->addOnBoardRequestsRelatedByCreatedByEmployeeId($this);
             */
        }

        return $this->aEmployeeRelatedByCreatedByEmployeeId;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByCreatedByPositionId(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setCreatedByPositionId(NULL);
        } else {
            $this->setCreatedByPositionId($v->getPositionId());
        }

        $this->aPositionsRelatedByCreatedByPositionId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByCreatedByPositionId($this);
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
    public function getPositionsRelatedByCreatedByPositionId(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByCreatedByPositionId === null && ($this->created_by_position_id != 0)) {
            $this->aPositionsRelatedByCreatedByPositionId = ChildPositionsQuery::create()->findPk($this->created_by_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByCreatedByPositionId->addOnBoardRequestsRelatedByCreatedByPositionId($this);
             */
        }

        return $this->aPositionsRelatedByCreatedByPositionId;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByFinalApprovedByEmployeeId(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setFinalApprovedByEmployeeId(NULL);
        } else {
            $this->setFinalApprovedByEmployeeId($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByFinalApprovedByEmployeeId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByFinalApprovedByEmployeeId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByFinalApprovedByEmployeeId(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByFinalApprovedByEmployeeId === null && ($this->final_approved_by_employee_id != 0)) {
            $this->aEmployeeRelatedByFinalApprovedByEmployeeId = ChildEmployeeQuery::create()->findPk($this->final_approved_by_employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByFinalApprovedByEmployeeId->addOnBoardRequestsRelatedByFinalApprovedByEmployeeId($this);
             */
        }

        return $this->aEmployeeRelatedByFinalApprovedByEmployeeId;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByFinalApprovedByPositionId(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setFinalApprovedByPositionId(NULL);
        } else {
            $this->setFinalApprovedByPositionId($v->getPositionId());
        }

        $this->aPositionsRelatedByFinalApprovedByPositionId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByFinalApprovedByPositionId($this);
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
    public function getPositionsRelatedByFinalApprovedByPositionId(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByFinalApprovedByPositionId === null && ($this->final_approved_by_position_id != 0)) {
            $this->aPositionsRelatedByFinalApprovedByPositionId = ChildPositionsQuery::create()->findPk($this->final_approved_by_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByFinalApprovedByPositionId->addOnBoardRequestsRelatedByFinalApprovedByPositionId($this);
             */
        }

        return $this->aPositionsRelatedByFinalApprovedByPositionId;
    }

    /**
     * Declares an association between this object and a ChildOutlets object.
     *
     * @param ChildOutlets|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutlets(ChildOutlets $v = null)
    {
        if ($v === null) {
            $this->setOutletId(NULL);
        } else {
            $this->setOutletId($v->getId());
        }

        $this->aOutlets = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutlets object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutlets object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutlets|null The associated ChildOutlets object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutlets(?ConnectionInterface $con = null)
    {
        if ($this->aOutlets === null && ($this->outlet_id != 0)) {
            $this->aOutlets = ChildOutletsQuery::create()->findPk($this->outlet_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutlets->addOnBoardRequests($this);
             */
        }

        return $this->aOutlets;
    }

    /**
     * Declares an association between this object and a ChildOutletType object.
     *
     * @param ChildOutletType|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletType(ChildOutletType $v = null)
    {
        if ($v === null) {
            $this->setOutletTypeId(NULL);
        } else {
            $this->setOutletTypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletType object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletType|null The associated ChildOutletType object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletType(?ConnectionInterface $con = null)
    {
        if ($this->aOutletType === null && ($this->outlet_type_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlet_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addOnBoardRequests($this);
             */
        }

        return $this->aOutletType;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByPosition(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setPosition(NULL);
        } else {
            $this->setPosition($v->getPositionId());
        }

        $this->aPositionsRelatedByPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByPosition($this);
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
    public function getPositionsRelatedByPosition(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByPosition === null && ($this->position != 0)) {
            $this->aPositionsRelatedByPosition = ChildPositionsQuery::create()->findPk($this->position, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByPosition->addOnBoardRequestsRelatedByPosition($this);
             */
        }

        return $this->aPositionsRelatedByPosition;
    }

    /**
     * Declares an association between this object and a ChildTerritories object.
     *
     * @param ChildTerritories|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setTerritories(ChildTerritories $v = null)
    {
        if ($v === null) {
            $this->setTerritory(NULL);
        } else {
            $this->setTerritory($v->getTerritoryId());
        }

        $this->aTerritories = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTerritories object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequest($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTerritories object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildTerritories|null The associated ChildTerritories object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTerritories(?ConnectionInterface $con = null)
    {
        if ($this->aTerritories === null && ($this->territory != 0)) {
            $this->aTerritories = ChildTerritoriesQuery::create()->findPk($this->territory, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTerritories->addOnBoardRequests($this);
             */
        }

        return $this->aTerritories;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployeeRelatedByUpdatedByEmployeeId(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setUpdatedByEmployeeId(NULL);
        } else {
            $this->setUpdatedByEmployeeId($v->getEmployeeId());
        }

        $this->aEmployeeRelatedByUpdatedByEmployeeId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByUpdatedByEmployeeId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeRelatedByUpdatedByEmployeeId(?ConnectionInterface $con = null)
    {
        if ($this->aEmployeeRelatedByUpdatedByEmployeeId === null && ($this->updated_by_employee_id != 0)) {
            $this->aEmployeeRelatedByUpdatedByEmployeeId = ChildEmployeeQuery::create()->findPk($this->updated_by_employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployeeRelatedByUpdatedByEmployeeId->addOnBoardRequestsRelatedByUpdatedByEmployeeId($this);
             */
        }

        return $this->aEmployeeRelatedByUpdatedByEmployeeId;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositionsRelatedByUpdatedByPositionId(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setUpdatedByPositionId(NULL);
        } else {
            $this->setUpdatedByPositionId($v->getPositionId());
        }

        $this->aPositionsRelatedByUpdatedByPositionId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestRelatedByUpdatedByPositionId($this);
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
    public function getPositionsRelatedByUpdatedByPositionId(?ConnectionInterface $con = null)
    {
        if ($this->aPositionsRelatedByUpdatedByPositionId === null && ($this->updated_by_position_id != 0)) {
            $this->aPositionsRelatedByUpdatedByPositionId = ChildPositionsQuery::create()->findPk($this->updated_by_position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsRelatedByUpdatedByPositionId->addOnBoardRequestsRelatedByUpdatedByPositionId($this);
             */
        }

        return $this->aPositionsRelatedByUpdatedByPositionId;
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
        if ('OnBoardRequestAddress' === $relationName) {
            $this->initOnBoardRequestAddresses();
            return;
        }
        if ('OnBoardRequestLog' === $relationName) {
            $this->initOnBoardRequestLogs();
            return;
        }
        if ('OnBoardRequestOutletMapping' === $relationName) {
            $this->initOnBoardRequestOutletMappings();
            return;
        }
    }

    /**
     * Clears out the collOnBoardRequestAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestAddresses()
     */
    public function clearOnBoardRequestAddresses()
    {
        $this->collOnBoardRequestAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestAddresses($v = true): void
    {
        $this->collOnBoardRequestAddressesPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestAddresses collection.
     *
     * By default this just sets the collOnBoardRequestAddresses collection to an empty array (like clearcollOnBoardRequestAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestAddresses = new $collectionClassName;
        $this->collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');
    }

    /**
     * Gets an array of ChildOnBoardRequestAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOnBoardRequest is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress> List of ChildOnBoardRequestAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestAddresses) {
                    $this->initOnBoardRequestAddresses();
                } else {
                    $collectionClassName = OnBoardRequestAddressTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestAddresses = new $collectionClassName;
                    $collOnBoardRequestAddresses->setModel('\entities\OnBoardRequestAddress');

                    return $collOnBoardRequestAddresses;
                }
            } else {
                $collOnBoardRequestAddresses = ChildOnBoardRequestAddressQuery::create(null, $criteria)
                    ->filterByOnBoardRequest($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestAddressesPartial && count($collOnBoardRequestAddresses)) {
                        $this->initOnBoardRequestAddresses(false);

                        foreach ($collOnBoardRequestAddresses as $obj) {
                            if (false == $this->collOnBoardRequestAddresses->contains($obj)) {
                                $this->collOnBoardRequestAddresses->append($obj);
                            }
                        }

                        $this->collOnBoardRequestAddressesPartial = true;
                    }

                    return $collOnBoardRequestAddresses;
                }

                if ($partial && $this->collOnBoardRequestAddresses) {
                    foreach ($this->collOnBoardRequestAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestAddresses[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestAddresses = $collOnBoardRequestAddresses;
                $this->collOnBoardRequestAddressesPartial = false;
            }
        }

        return $this->collOnBoardRequestAddresses;
    }

    /**
     * Sets a collection of ChildOnBoardRequestAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddresses(Collection $onBoardRequestAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestAddress[] $onBoardRequestAddressesToDelete */
        $onBoardRequestAddressesToDelete = $this->getOnBoardRequestAddresses(new Criteria(), $con)->diff($onBoardRequestAddresses);


        $this->onBoardRequestAddressesScheduledForDeletion = $onBoardRequestAddressesToDelete;

        foreach ($onBoardRequestAddressesToDelete as $onBoardRequestAddressRemoved) {
            $onBoardRequestAddressRemoved->setOnBoardRequest(null);
        }

        $this->collOnBoardRequestAddresses = null;
        foreach ($onBoardRequestAddresses as $onBoardRequestAddress) {
            $this->addOnBoardRequestAddress($onBoardRequestAddress);
        }

        $this->collOnBoardRequestAddresses = $onBoardRequestAddresses;
        $this->collOnBoardRequestAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestAddressesPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestAddresses());
            }

            $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOnBoardRequest($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestAddresses);
    }

    /**
     * Method called to associate a ChildOnBoardRequestAddress object to this object
     * through the ChildOnBoardRequestAddress foreign key attribute.
     *
     * @param ChildOnBoardRequestAddress $l ChildOnBoardRequestAddress
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestAddress(ChildOnBoardRequestAddress $l)
    {
        if ($this->collOnBoardRequestAddresses === null) {
            $this->initOnBoardRequestAddresses();
            $this->collOnBoardRequestAddressesPartial = true;
        }

        if (!$this->collOnBoardRequestAddresses->contains($l)) {
            $this->doAddOnBoardRequestAddress($l);

            if ($this->onBoardRequestAddressesScheduledForDeletion and $this->onBoardRequestAddressesScheduledForDeletion->contains($l)) {
                $this->onBoardRequestAddressesScheduledForDeletion->remove($this->onBoardRequestAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to add.
     */
    protected function doAddOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress): void
    {
        $this->collOnBoardRequestAddresses[]= $onBoardRequestAddress;
        $onBoardRequestAddress->setOnBoardRequest($this);
    }

    /**
     * @param ChildOnBoardRequestAddress $onBoardRequestAddress The ChildOnBoardRequestAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestAddress(ChildOnBoardRequestAddress $onBoardRequestAddress)
    {
        if ($this->getOnBoardRequestAddresses()->contains($onBoardRequestAddress)) {
            $pos = $this->collOnBoardRequestAddresses->search($onBoardRequestAddress);
            $this->collOnBoardRequestAddresses->remove($pos);
            if (null === $this->onBoardRequestAddressesScheduledForDeletion) {
                $this->onBoardRequestAddressesScheduledForDeletion = clone $this->collOnBoardRequestAddresses;
                $this->onBoardRequestAddressesScheduledForDeletion->clear();
            }
            $this->onBoardRequestAddressesScheduledForDeletion[]= $onBoardRequestAddress;
            $onBoardRequestAddress->setOnBoardRequest(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletAddress', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBrands(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Brands', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinClassification(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Classification', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletTags(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletTags', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoCity(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoCity', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoState(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoState', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestAddress[] List of ChildOnBoardRequestAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestAddress}> List of ChildOnBoardRequestAddress objects
     */
    public function getOnBoardRequestAddressesJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestAddressQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOnBoardRequestAddresses($query, $con);
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
     * If this ChildOnBoardRequest is new, it will return
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
                    ->filterByOnBoardRequest($this)
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
            $onBoardRequestLogRemoved->setOnBoardRequest(null);
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
                ->filterByOnBoardRequest($this)
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
        $onBoardRequestLog->setOnBoardRequest($this);
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
            $onBoardRequestLog->setOnBoardRequest(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestLog[] List of ChildOnBoardRequestLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestLog}> List of ChildOnBoardRequestLog objects
     */
    public function getOnBoardRequestLogsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestLogQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getOnBoardRequestLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
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
     * Clears out the collOnBoardRequestOutletMappings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOnBoardRequestOutletMappings()
     */
    public function clearOnBoardRequestOutletMappings()
    {
        $this->collOnBoardRequestOutletMappings = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOnBoardRequestOutletMappings collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOnBoardRequestOutletMappings($v = true): void
    {
        $this->collOnBoardRequestOutletMappingsPartial = $v;
    }

    /**
     * Initializes the collOnBoardRequestOutletMappings collection.
     *
     * By default this just sets the collOnBoardRequestOutletMappings collection to an empty array (like clearcollOnBoardRequestOutletMappings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOnBoardRequestOutletMappings(bool $overrideExisting = true): void
    {
        if (null !== $this->collOnBoardRequestOutletMappings && !$overrideExisting) {
            return;
        }

        $collectionClassName = OnBoardRequestOutletMappingTableMap::getTableMap()->getCollectionClassName();

        $this->collOnBoardRequestOutletMappings = new $collectionClassName;
        $this->collOnBoardRequestOutletMappings->setModel('\entities\OnBoardRequestOutletMapping');
    }

    /**
     * Gets an array of ChildOnBoardRequestOutletMapping objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOnBoardRequest is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOnBoardRequestOutletMapping[] List of ChildOnBoardRequestOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping> List of ChildOnBoardRequestOutletMapping objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequestOutletMappings(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOnBoardRequestOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOnBoardRequestOutletMappings) {
                    $this->initOnBoardRequestOutletMappings();
                } else {
                    $collectionClassName = OnBoardRequestOutletMappingTableMap::getTableMap()->getCollectionClassName();

                    $collOnBoardRequestOutletMappings = new $collectionClassName;
                    $collOnBoardRequestOutletMappings->setModel('\entities\OnBoardRequestOutletMapping');

                    return $collOnBoardRequestOutletMappings;
                }
            } else {
                $collOnBoardRequestOutletMappings = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria)
                    ->filterByOnBoardRequest($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOnBoardRequestOutletMappingsPartial && count($collOnBoardRequestOutletMappings)) {
                        $this->initOnBoardRequestOutletMappings(false);

                        foreach ($collOnBoardRequestOutletMappings as $obj) {
                            if (false == $this->collOnBoardRequestOutletMappings->contains($obj)) {
                                $this->collOnBoardRequestOutletMappings->append($obj);
                            }
                        }

                        $this->collOnBoardRequestOutletMappingsPartial = true;
                    }

                    return $collOnBoardRequestOutletMappings;
                }

                if ($partial && $this->collOnBoardRequestOutletMappings) {
                    foreach ($this->collOnBoardRequestOutletMappings as $obj) {
                        if ($obj->isNew()) {
                            $collOnBoardRequestOutletMappings[] = $obj;
                        }
                    }
                }

                $this->collOnBoardRequestOutletMappings = $collOnBoardRequestOutletMappings;
                $this->collOnBoardRequestOutletMappingsPartial = false;
            }
        }

        return $this->collOnBoardRequestOutletMappings;
    }

    /**
     * Sets a collection of ChildOnBoardRequestOutletMapping objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $onBoardRequestOutletMappings A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestOutletMappings(Collection $onBoardRequestOutletMappings, ?ConnectionInterface $con = null)
    {
        /** @var ChildOnBoardRequestOutletMapping[] $onBoardRequestOutletMappingsToDelete */
        $onBoardRequestOutletMappingsToDelete = $this->getOnBoardRequestOutletMappings(new Criteria(), $con)->diff($onBoardRequestOutletMappings);


        $this->onBoardRequestOutletMappingsScheduledForDeletion = $onBoardRequestOutletMappingsToDelete;

        foreach ($onBoardRequestOutletMappingsToDelete as $onBoardRequestOutletMappingRemoved) {
            $onBoardRequestOutletMappingRemoved->setOnBoardRequest(null);
        }

        $this->collOnBoardRequestOutletMappings = null;
        foreach ($onBoardRequestOutletMappings as $onBoardRequestOutletMapping) {
            $this->addOnBoardRequestOutletMapping($onBoardRequestOutletMapping);
        }

        $this->collOnBoardRequestOutletMappings = $onBoardRequestOutletMappings;
        $this->collOnBoardRequestOutletMappingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OnBoardRequestOutletMapping objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OnBoardRequestOutletMapping objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOnBoardRequestOutletMappings(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOnBoardRequestOutletMappingsPartial && !$this->isNew();
        if (null === $this->collOnBoardRequestOutletMappings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOnBoardRequestOutletMappings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOnBoardRequestOutletMappings());
            }

            $query = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOnBoardRequest($this)
                ->count($con);
        }

        return count($this->collOnBoardRequestOutletMappings);
    }

    /**
     * Method called to associate a ChildOnBoardRequestOutletMapping object to this object
     * through the ChildOnBoardRequestOutletMapping foreign key attribute.
     *
     * @param ChildOnBoardRequestOutletMapping $l ChildOnBoardRequestOutletMapping
     * @return $this The current object (for fluent API support)
     */
    public function addOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $l)
    {
        if ($this->collOnBoardRequestOutletMappings === null) {
            $this->initOnBoardRequestOutletMappings();
            $this->collOnBoardRequestOutletMappingsPartial = true;
        }

        if (!$this->collOnBoardRequestOutletMappings->contains($l)) {
            $this->doAddOnBoardRequestOutletMapping($l);

            if ($this->onBoardRequestOutletMappingsScheduledForDeletion and $this->onBoardRequestOutletMappingsScheduledForDeletion->contains($l)) {
                $this->onBoardRequestOutletMappingsScheduledForDeletion->remove($this->onBoardRequestOutletMappingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping The ChildOnBoardRequestOutletMapping object to add.
     */
    protected function doAddOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping): void
    {
        $this->collOnBoardRequestOutletMappings[]= $onBoardRequestOutletMapping;
        $onBoardRequestOutletMapping->setOnBoardRequest($this);
    }

    /**
     * @param ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping The ChildOnBoardRequestOutletMapping object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOnBoardRequestOutletMapping(ChildOnBoardRequestOutletMapping $onBoardRequestOutletMapping)
    {
        if ($this->getOnBoardRequestOutletMappings()->contains($onBoardRequestOutletMapping)) {
            $pos = $this->collOnBoardRequestOutletMappings->search($onBoardRequestOutletMapping);
            $this->collOnBoardRequestOutletMappings->remove($pos);
            if (null === $this->onBoardRequestOutletMappingsScheduledForDeletion) {
                $this->onBoardRequestOutletMappingsScheduledForDeletion = clone $this->collOnBoardRequestOutletMappings;
                $this->onBoardRequestOutletMappingsScheduledForDeletion->clear();
            }
            $this->onBoardRequestOutletMappingsScheduledForDeletion[]= $onBoardRequestOutletMapping;
            $onBoardRequestOutletMapping->setOnBoardRequest(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OnBoardRequest is new, it will return
     * an empty collection; or if this OnBoardRequest has previously
     * been saved, it will retrieve related OnBoardRequestOutletMappings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OnBoardRequest.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOnBoardRequestOutletMapping[] List of ChildOnBoardRequestOutletMapping objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOnBoardRequestOutletMapping}> List of ChildOnBoardRequestOutletMapping objects
     */
    public function getOnBoardRequestOutletMappingsJoinPricebooks(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOnBoardRequestOutletMappingQuery::create(null, $criteria);
        $query->joinWith('Pricebooks', $joinBehavior);

        return $this->getOnBoardRequestOutletMappings($query, $con);
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
        if (null !== $this->aEmployeeRelatedByApprovedByEmployeeId) {
            $this->aEmployeeRelatedByApprovedByEmployeeId->removeOnBoardRequestRelatedByApprovedByEmployeeId($this);
        }
        if (null !== $this->aPositionsRelatedByApprovedByPositionId) {
            $this->aPositionsRelatedByApprovedByPositionId->removeOnBoardRequestRelatedByApprovedByPositionId($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeOnBoardRequest($this);
        }
        if (null !== $this->aEmployeeRelatedByCreatedByEmployeeId) {
            $this->aEmployeeRelatedByCreatedByEmployeeId->removeOnBoardRequestRelatedByCreatedByEmployeeId($this);
        }
        if (null !== $this->aPositionsRelatedByCreatedByPositionId) {
            $this->aPositionsRelatedByCreatedByPositionId->removeOnBoardRequestRelatedByCreatedByPositionId($this);
        }
        if (null !== $this->aEmployeeRelatedByFinalApprovedByEmployeeId) {
            $this->aEmployeeRelatedByFinalApprovedByEmployeeId->removeOnBoardRequestRelatedByFinalApprovedByEmployeeId($this);
        }
        if (null !== $this->aPositionsRelatedByFinalApprovedByPositionId) {
            $this->aPositionsRelatedByFinalApprovedByPositionId->removeOnBoardRequestRelatedByFinalApprovedByPositionId($this);
        }
        if (null !== $this->aOutlets) {
            $this->aOutlets->removeOnBoardRequest($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeOnBoardRequest($this);
        }
        if (null !== $this->aPositionsRelatedByPosition) {
            $this->aPositionsRelatedByPosition->removeOnBoardRequestRelatedByPosition($this);
        }
        if (null !== $this->aTerritories) {
            $this->aTerritories->removeOnBoardRequest($this);
        }
        if (null !== $this->aEmployeeRelatedByUpdatedByEmployeeId) {
            $this->aEmployeeRelatedByUpdatedByEmployeeId->removeOnBoardRequestRelatedByUpdatedByEmployeeId($this);
        }
        if (null !== $this->aPositionsRelatedByUpdatedByPositionId) {
            $this->aPositionsRelatedByUpdatedByPositionId->removeOnBoardRequestRelatedByUpdatedByPositionId($this);
        }
        $this->on_board_request_id = null;
        $this->outlet_id = null;
        $this->salutation = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->email = null;
        $this->mobile = null;
        $this->gender = null;
        $this->date_of_birth = null;
        $this->marital_status = null;
        $this->date_of_anniversary = null;
        $this->qualification = null;
        $this->registration_no = null;
        $this->profile_pic = null;
        $this->status = null;
        $this->territory = null;
        $this->position = null;
        $this->created_at = null;
        $this->created_by_employee_id = null;
        $this->created_by_position_id = null;
        $this->updated_at = null;
        $this->updated_by_employee_id = null;
        $this->updated_by_position_id = null;
        $this->approved_at = null;
        $this->approved_by_employee_id = null;
        $this->approved_by_position_id = null;
        $this->final_approved_at = null;
        $this->final_approved_by_employee_id = null;
        $this->final_approved_by_position_id = null;
        $this->company_id = null;
        $this->descriptioin = null;
        $this->outlet_type_id = null;
        $this->outlet_name = null;
        $this->outlet_code = null;
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
            if ($this->collOnBoardRequestAddresses) {
                foreach ($this->collOnBoardRequestAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestLogs) {
                foreach ($this->collOnBoardRequestLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOnBoardRequestOutletMappings) {
                foreach ($this->collOnBoardRequestOutletMappings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOnBoardRequestAddresses = null;
        $this->collOnBoardRequestLogs = null;
        $this->collOnBoardRequestOutletMappings = null;
        $this->aEmployeeRelatedByApprovedByEmployeeId = null;
        $this->aPositionsRelatedByApprovedByPositionId = null;
        $this->aCompany = null;
        $this->aEmployeeRelatedByCreatedByEmployeeId = null;
        $this->aPositionsRelatedByCreatedByPositionId = null;
        $this->aEmployeeRelatedByFinalApprovedByEmployeeId = null;
        $this->aPositionsRelatedByFinalApprovedByPositionId = null;
        $this->aOutlets = null;
        $this->aOutletType = null;
        $this->aPositionsRelatedByPosition = null;
        $this->aTerritories = null;
        $this->aEmployeeRelatedByUpdatedByEmployeeId = null;
        $this->aPositionsRelatedByUpdatedByPositionId = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OnBoardRequestTableMap::DEFAULT_STRING_FORMAT);
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

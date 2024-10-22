<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\OutletViewQuery as ChildOutletViewQuery;
use entities\Map\OutletViewTableMap;

/**
 * Base class that represents a row from the 'outlet_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OutletView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OutletViewTableMap';


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
     * The value for the outlet_org_id field.
     *
     * @var        int
     */
    protected $outlet_org_id;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * The value for the position_name field.
     *
     * @var        string|null
     */
    protected $position_name;

    /**
     * The value for the beat_name field.
     *
     * @var        string|null
     */
    protected $beat_name;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

    /**
     * The value for the visit_fq field.
     *
     * @var        int|null
     */
    protected $visit_fq;

    /**
     * The value for the comments field.
     *
     * @var        string|null
     */
    protected $comments;

    /**
     * The value for the org_potential field.
     *
     * @var        int|null
     */
    protected $org_potential;

    /**
     * The value for the brand_focus field.
     *
     * @var        string|null
     */
    protected $brand_focus;

    /**
     * The value for the customer_fq field.
     *
     * @var        string|null
     */
    protected $customer_fq;

    /**
     * The value for the id field.
     *
     * @var        int|null
     */
    protected $id;

    /**
     * The value for the outlet_media_id field.
     *
     * @var        string|null
     */
    protected $outlet_media_id;

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
     * The value for the outlet_email field.
     *
     * @var        string|null
     */
    protected $outlet_email;

    /**
     * The value for the outlet_salutation field.
     *
     * @var        string|null
     */
    protected $outlet_salutation;

    /**
     * The value for the outlet_classification field.
     *
     * @var        int|null
     */
    protected $outlet_classification;

    /**
     * The value for the classification field.
     *
     * @var        string|null
     */
    protected $classification;

    /**
     * The value for the outlet_opening_date field.
     *
     * @var        DateTime|null
     */
    protected $outlet_opening_date;

    /**
     * The value for the outlet_contact_name field.
     *
     * @var        string|null
     */
    protected $outlet_contact_name;

    /**
     * The value for the outlet_landlineno field.
     *
     * @var        string|null
     */
    protected $outlet_landlineno;

    /**
     * The value for the outlet_alt_landlineno field.
     *
     * @var        string|null
     */
    protected $outlet_alt_landlineno;

    /**
     * The value for the outlet_contact_bday field.
     *
     * @var        DateTime|null
     */
    protected $outlet_contact_bday;

    /**
     * The value for the outlet_contact_anniversary field.
     *
     * @var        DateTime|null
     */
    protected $outlet_contact_anniversary;

    /**
     * The value for the outlet_isd_code field.
     *
     * @var        string|null
     */
    protected $outlet_isd_code;

    /**
     * The value for the outlet_contact_no field.
     *
     * @var        string|null
     */
    protected $outlet_contact_no;

    /**
     * The value for the outlet_alt_contact_no field.
     *
     * @var        string|null
     */
    protected $outlet_alt_contact_no;

    /**
     * The value for the outlet_status field.
     *
     * @var        string|null
     */
    protected $outlet_status;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the created_at field.
     *
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
     * The value for the outlet_otp field.
     *
     * @var        string|null
     */
    protected $outlet_otp;

    /**
     * The value for the outlet_verified field.
     *
     * @var        string|null
     */
    protected $outlet_verified;

    /**
     * The value for the outlet_created_by field.
     *
     * @var        int|null
     */
    protected $outlet_created_by;

    /**
     * The value for the outlet_approved_by field.
     *
     * @var        int|null
     */
    protected $outlet_approved_by;

    /**
     * The value for the outlet_potential field.
     *
     * @var        string|null
     */
    protected $outlet_potential;

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
     * The value for the outlet_qualification field.
     *
     * @var        string|null
     */
    protected $outlet_qualification;

    /**
     * The value for the outlet_regno field.
     *
     * @var        string|null
     */
    protected $outlet_regno;

    /**
     * The value for the outlet_marital_status field.
     *
     * @var        string|null
     */
    protected $outlet_marital_status;

    /**
     * The value for the outlet_media field.
     *
     * @var        string|null
     */
    protected $outlet_media;

    /**
     * The value for the address_name field.
     *
     * @var        string|null
     */
    protected $address_name;

    /**
     * The value for the outlet_address field.
     *
     * @var        string|null
     */
    protected $outlet_address;

    /**
     * The value for the outlet_street_name field.
     *
     * @var        string|null
     */
    protected $outlet_street_name;

    /**
     * The value for the outlet_city field.
     *
     * @var        string|null
     */
    protected $outlet_city;

    /**
     * The value for the outlet_state field.
     *
     * @var        string|null
     */
    protected $outlet_state;

    /**
     * The value for the outlet_country field.
     *
     * @var        string|null
     */
    protected $outlet_country;

    /**
     * The value for the outlet_pincode field.
     *
     * @var        string|null
     */
    protected $outlet_pincode;

    /**
     * The value for the last_visit_date field.
     *
     * @var        DateTime|null
     */
    protected $last_visit_date;

    /**
     * The value for the last_visit_employee field.
     *
     * @var        int|null
     */
    protected $last_visit_employee;

    /**
     * The value for the outlet_org_code field.
     *
     * @var        string|null
     */
    protected $outlet_org_code;

    /**
     * The value for the sgpi_brand_map field.
     *
     * @var        string|null
     */
    protected $sgpi_brand_map;

    /**
     * The value for the sgpi_brand_id_map field.
     *
     * @var        string|null
     */
    protected $sgpi_brand_id_map;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\OutletView object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>OutletView</code> instance.  If
     * <code>obj</code> is an instance of <code>OutletView</code>, delegates to
     * <code>equals(OutletView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [outlet_org_id] column value.
     *
     * @return int
     */
    public function getOutletOrgId()
    {
        return $this->outlet_org_id;
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return int|null
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
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
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
    }

    /**
     * Get the [position_name] column value.
     *
     * @return string|null
     */
    public function getPositionName()
    {
        return $this->position_name;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string|null
     */
    public function getBeatName()
    {
        return $this->beat_name;
    }

    /**
     * Get the [tags] column value.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the [visit_fq] column value.
     *
     * @return int|null
     */
    public function getVisitFq()
    {
        return $this->visit_fq;
    }

    /**
     * Get the [comments] column value.
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get the [org_potential] column value.
     *
     * @return int|null
     */
    public function getOrgPotential()
    {
        return $this->org_potential;
    }

    /**
     * Get the [brand_focus] column value.
     *
     * @return string|null
     */
    public function getBrandFocus()
    {
        return $this->brand_focus;
    }

    /**
     * Get the [customer_fq] column value.
     *
     * @return string|null
     */
    public function getCustomerFq()
    {
        return $this->customer_fq;
    }

    /**
     * Get the [id] column value.
     *
     * @return int|null
     */
    public function getOutlet_Id()
    {
        return $this->id;
    }

    /**
     * Get the [outlet_media_id] column value.
     *
     * @return string|null
     */
    public function getOutletMediaId()
    {
        return $this->outlet_media_id;
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
     * Get the [outlet_email] column value.
     *
     * @return string|null
     */
    public function getOutletEmail()
    {
        return $this->outlet_email;
    }

    /**
     * Get the [outlet_salutation] column value.
     *
     * @return string|null
     */
    public function getOutletSalutation()
    {
        return $this->outlet_salutation;
    }

    /**
     * Get the [outlet_classification] column value.
     *
     * @return int|null
     */
    public function getOutletClassification()
    {
        return $this->outlet_classification;
    }

    /**
     * Get the [classification] column value.
     *
     * @return string|null
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Get the [optionally formatted] temporal [outlet_opening_date] column value.
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
    public function getOutletOpening_date($format = null)
    {
        if ($format === null) {
            return $this->outlet_opening_date;
        } else {
            return $this->outlet_opening_date instanceof \DateTimeInterface ? $this->outlet_opening_date->format($format) : null;
        }
    }

    /**
     * Get the [outlet_contact_name] column value.
     *
     * @return string|null
     */
    public function getOutletContactName()
    {
        return $this->outlet_contact_name;
    }

    /**
     * Get the [outlet_landlineno] column value.
     *
     * @return string|null
     */
    public function getOutletLandlineno()
    {
        return $this->outlet_landlineno;
    }

    /**
     * Get the [outlet_alt_landlineno] column value.
     *
     * @return string|null
     */
    public function getOutletAltLandlineno()
    {
        return $this->outlet_alt_landlineno;
    }

    /**
     * Get the [optionally formatted] temporal [outlet_contact_bday] column value.
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
    public function getOutletContactBday($format = null)
    {
        if ($format === null) {
            return $this->outlet_contact_bday;
        } else {
            return $this->outlet_contact_bday instanceof \DateTimeInterface ? $this->outlet_contact_bday->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [outlet_contact_anniversary] column value.
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
    public function getOutletContactAnniversary($format = null)
    {
        if ($format === null) {
            return $this->outlet_contact_anniversary;
        } else {
            return $this->outlet_contact_anniversary instanceof \DateTimeInterface ? $this->outlet_contact_anniversary->format($format) : null;
        }
    }

    /**
     * Get the [outlet_isd_code] column value.
     *
     * @return string|null
     */
    public function getOutletIsdCode()
    {
        return $this->outlet_isd_code;
    }

    /**
     * Get the [outlet_contact_no] column value.
     *
     * @return string|null
     */
    public function getOutletContactNo()
    {
        return $this->outlet_contact_no;
    }

    /**
     * Get the [outlet_alt_contact_no] column value.
     *
     * @return string|null
     */
    public function getOutletAltContactNo()
    {
        return $this->outlet_alt_contact_no;
    }

    /**
     * Get the [outlet_status] column value.
     *
     * @return string|null
     */
    public function getOutletStatus()
    {
        return $this->outlet_status;
    }

    /**
     * Get the [outlettype_id] column value.
     *
     * @return int|null
     */
    public function getOutlettypeId()
    {
        return $this->outlettype_id;
    }

    /**
     * Get the [outlettype_name] column value.
     *
     * @return string|null
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
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
     * Get the [outlet_otp] column value.
     *
     * @return string|null
     */
    public function getOutletOtp()
    {
        return $this->outlet_otp;
    }

    /**
     * Get the [outlet_verified] column value.
     *
     * @return string|null
     */
    public function getOutletVerified()
    {
        return $this->outlet_verified;
    }

    /**
     * Get the [outlet_created_by] column value.
     *
     * @return int|null
     */
    public function getOutletCreatedBy()
    {
        return $this->outlet_created_by;
    }

    /**
     * Get the [outlet_approved_by] column value.
     *
     * @return int|null
     */
    public function getOutletApprovedBy()
    {
        return $this->outlet_approved_by;
    }

    /**
     * Get the [outlet_potential] column value.
     *
     * @return string|null
     */
    public function getOutletPotential()
    {
        return $this->outlet_potential;
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
     * Get the [outlet_qualification] column value.
     *
     * @return string|null
     */
    public function getOutletQualification()
    {
        return $this->outlet_qualification;
    }

    /**
     * Get the [outlet_regno] column value.
     *
     * @return string|null
     */
    public function getOutletRegno()
    {
        return $this->outlet_regno;
    }

    /**
     * Get the [outlet_marital_status] column value.
     *
     * @return string|null
     */
    public function getOutletMaritalStatus()
    {
        return $this->outlet_marital_status;
    }

    /**
     * Get the [outlet_media] column value.
     *
     * @return string|null
     */
    public function getOutletMedia()
    {
        return $this->outlet_media;
    }

    /**
     * Get the [address_name] column value.
     *
     * @return string|null
     */
    public function getAddressName()
    {
        return $this->address_name;
    }

    /**
     * Get the [outlet_address] column value.
     *
     * @return string|null
     */
    public function getOutletAddress()
    {
        return $this->outlet_address;
    }

    /**
     * Get the [outlet_street_name] column value.
     *
     * @return string|null
     */
    public function getOutletStreetName()
    {
        return $this->outlet_street_name;
    }

    /**
     * Get the [outlet_city] column value.
     *
     * @return string|null
     */
    public function getOutletCity()
    {
        return $this->outlet_city;
    }

    /**
     * Get the [outlet_state] column value.
     *
     * @return string|null
     */
    public function getOutletState()
    {
        return $this->outlet_state;
    }

    /**
     * Get the [outlet_country] column value.
     *
     * @return string|null
     */
    public function getOutletCountry()
    {
        return $this->outlet_country;
    }

    /**
     * Get the [outlet_pincode] column value.
     *
     * @return string|null
     */
    public function getOutletPincode()
    {
        return $this->outlet_pincode;
    }

    /**
     * Get the [optionally formatted] temporal [last_visit_date] column value.
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
    public function getLastVisitDate($format = null)
    {
        if ($format === null) {
            return $this->last_visit_date;
        } else {
            return $this->last_visit_date instanceof \DateTimeInterface ? $this->last_visit_date->format($format) : null;
        }
    }

    /**
     * Get the [last_visit_employee] column value.
     *
     * @return int|null
     */
    public function getLastVisitEmployee()
    {
        return $this->last_visit_employee;
    }

    /**
     * Get the [outlet_org_code] column value.
     *
     * @return string|null
     */
    public function getOutletOrgCode()
    {
        return $this->outlet_org_code;
    }

    /**
     * Get the [sgpi_brand_map] column value.
     *
     * @return string|null
     */
    public function getSgpiBrandMap()
    {
        return $this->sgpi_brand_map;
    }

    /**
     * Get the [sgpi_brand_id_map] column value.
     *
     * @return string|null
     */
    public function getSgpiBrandIdMap()
    {
        return $this->sgpi_brand_id_map;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ORG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_ORG_UNIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_BEAT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_TERRITORY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_name !== $v) {
            $this->position_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_BEAT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comments] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comments !== $v) {
            $this->comments = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_COMMENTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_potential] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgPotential($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_potential !== $v) {
            $this->org_potential = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_ORG_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_focus] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandFocus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_focus !== $v) {
            $this->brand_focus = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_BRAND_FOCUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_fq] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCustomerFq($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customer_fq !== $v) {
            $this->customer_fq = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_CUSTOMER_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlet_Id($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_media_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletMediaId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_media_id !== $v) {
            $this->outlet_media_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_email !== $v) {
            $this->outlet_email = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_salutation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_salutation !== $v) {
            $this->outlet_salutation = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_SALUTATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_classification] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletClassification($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_classification !== $v) {
            $this->outlet_classification = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classification !== $v) {
            $this->classification = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [outlet_opening_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOpening_date($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_opening_date !== null || $dt !== null) {
            if ($this->outlet_opening_date === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_opening_date->format("Y-m-d")) {
                $this->outlet_opening_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_OPENING_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_contact_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletContactName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_contact_name !== $v) {
            $this->outlet_contact_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CONTACT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_landlineno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletLandlineno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_landlineno !== $v) {
            $this->outlet_landlineno = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_LANDLINENO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_alt_landlineno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletAltLandlineno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_alt_landlineno !== $v) {
            $this->outlet_alt_landlineno = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [outlet_contact_bday] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletContactBday($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_contact_bday !== null || $dt !== null) {
            if ($this->outlet_contact_bday === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_contact_bday->format("Y-m-d")) {
                $this->outlet_contact_bday = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CONTACT_BDAY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [outlet_contact_anniversary] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletContactAnniversary($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->outlet_contact_anniversary !== null || $dt !== null) {
            if ($this->outlet_contact_anniversary === null || $dt === null || $dt->format("Y-m-d") !== $this->outlet_contact_anniversary->format("Y-m-d")) {
                $this->outlet_contact_anniversary = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_isd_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletIsdCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_isd_code !== $v) {
            $this->outlet_isd_code = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ISD_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_contact_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletContactNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_contact_no !== $v) {
            $this->outlet_contact_no = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CONTACT_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_alt_contact_no] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletAltContactNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_alt_contact_no !== $v) {
            $this->outlet_alt_contact_no = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_status !== $v) {
            $this->outlet_status = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLETTYPE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_COMPANY_ID] = true;
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
    protected function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_CREATED_AT] = true;
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
    protected function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlet_otp] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOtp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_otp !== $v) {
            $this->outlet_otp = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_OTP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_verified] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletVerified($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_verified !== $v) {
            $this->outlet_verified = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_VERIFIED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_created_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCreatedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_created_by !== $v) {
            $this->outlet_created_by = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CREATED_BY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_approved_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletApprovedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_approved_by !== $v) {
            $this->outlet_approved_by = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_APPROVED_BY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_potential !== $v) {
            $this->outlet_potential = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [integration_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setIntegrationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->integration_id !== $v) {
            $this->integration_id = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_INTEGRATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setItownid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_ITOWNID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_qualification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletQualification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_qualification !== $v) {
            $this->outlet_qualification = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_QUALIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_regno] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletRegno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_regno !== $v) {
            $this->outlet_regno = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_REGNO] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_marital_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletMaritalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_marital_status !== $v) {
            $this->outlet_marital_status = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_MARITAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_media] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletMedia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_media !== $v) {
            $this->outlet_media = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_MEDIA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAddressName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_name !== $v) {
            $this->address_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_ADDRESS_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_address !== $v) {
            $this->outlet_address = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_street_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletStreetName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_street_name !== $v) {
            $this->outlet_street_name = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_STREET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_city] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_city !== $v) {
            $this->outlet_city = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_state] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_state !== $v) {
            $this->outlet_state = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_STATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_country] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_country !== $v) {
            $this->outlet_country = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_COUNTRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_pincode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletPincode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_pincode !== $v) {
            $this->outlet_pincode = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_PINCODE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [last_visit_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setLastVisitDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_visit_date !== null || $dt !== null) {
            if ($this->last_visit_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_visit_date->format("Y-m-d H:i:s.u")) {
                $this->last_visit_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OutletViewTableMap::COL_LAST_VISIT_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [last_visit_employee] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLastVisitEmployee($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_visit_employee !== $v) {
            $this->last_visit_employee = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_code !== $v) {
            $this->outlet_org_code = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_OUTLET_ORG_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_brand_map] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiBrandMap($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_brand_map !== $v) {
            $this->sgpi_brand_map = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_SGPI_BRAND_MAP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_brand_id_map] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiBrandIdMap($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_brand_id_map !== $v) {
            $this->sgpi_brand_id_map = $v;
            $this->modifiedColumns[OutletViewTableMap::COL_SGPI_BRAND_ID_MAP] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OutletViewTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OutletViewTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OutletViewTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OutletViewTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OutletViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OutletViewTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OutletViewTableMap::translateFieldName('PositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OutletViewTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OutletViewTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OutletViewTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OutletViewTableMap::translateFieldName('Comments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OutletViewTableMap::translateFieldName('OrgPotential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_potential = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OutletViewTableMap::translateFieldName('BrandFocus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_focus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OutletViewTableMap::translateFieldName('CustomerFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_fq = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OutletViewTableMap::translateFieldName('Outlet_Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OutletViewTableMap::translateFieldName('OutletMediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_media_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OutletViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OutletViewTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OutletViewTableMap::translateFieldName('OutletEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OutletViewTableMap::translateFieldName('OutletSalutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_salutation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OutletViewTableMap::translateFieldName('OutletClassification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_classification = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OutletViewTableMap::translateFieldName('Classification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OutletViewTableMap::translateFieldName('OutletOpening_date', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_opening_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OutletViewTableMap::translateFieldName('OutletContactName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OutletViewTableMap::translateFieldName('OutletLandlineno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_landlineno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : OutletViewTableMap::translateFieldName('OutletAltLandlineno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_alt_landlineno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : OutletViewTableMap::translateFieldName('OutletContactBday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_bday = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : OutletViewTableMap::translateFieldName('OutletContactAnniversary', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_anniversary = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : OutletViewTableMap::translateFieldName('OutletIsdCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_isd_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : OutletViewTableMap::translateFieldName('OutletContactNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_contact_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : OutletViewTableMap::translateFieldName('OutletAltContactNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_alt_contact_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : OutletViewTableMap::translateFieldName('OutletStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : OutletViewTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : OutletViewTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : OutletViewTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : OutletViewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : OutletViewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : OutletViewTableMap::translateFieldName('OutletOtp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_otp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : OutletViewTableMap::translateFieldName('OutletVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_verified = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : OutletViewTableMap::translateFieldName('OutletCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_created_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : OutletViewTableMap::translateFieldName('OutletApprovedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_approved_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : OutletViewTableMap::translateFieldName('OutletPotential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : OutletViewTableMap::translateFieldName('IntegrationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->integration_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : OutletViewTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : OutletViewTableMap::translateFieldName('OutletQualification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_qualification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : OutletViewTableMap::translateFieldName('OutletRegno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_regno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : OutletViewTableMap::translateFieldName('OutletMaritalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_marital_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : OutletViewTableMap::translateFieldName('OutletMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_media = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : OutletViewTableMap::translateFieldName('AddressName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : OutletViewTableMap::translateFieldName('OutletAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : OutletViewTableMap::translateFieldName('OutletStreetName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_street_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 51 + $startcol : OutletViewTableMap::translateFieldName('OutletCity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 52 + $startcol : OutletViewTableMap::translateFieldName('OutletState', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 53 + $startcol : OutletViewTableMap::translateFieldName('OutletCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 54 + $startcol : OutletViewTableMap::translateFieldName('OutletPincode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_pincode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 55 + $startcol : OutletViewTableMap::translateFieldName('LastVisitDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_visit_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 56 + $startcol : OutletViewTableMap::translateFieldName('LastVisitEmployee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_visit_employee = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 57 + $startcol : OutletViewTableMap::translateFieldName('OutletOrgCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 58 + $startcol : OutletViewTableMap::translateFieldName('SgpiBrandMap', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_brand_map = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 59 + $startcol : OutletViewTableMap::translateFieldName('SgpiBrandIdMap', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_brand_id_map = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 60; // 60 = OutletViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OutletView'), 0, $e);
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
        $pos = OutletViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOutletOrgId();

            case 1:
                return $this->getOrgUnitId();

            case 2:
                return $this->getTerritoryId();

            case 3:
                return $this->getBeatId();

            case 4:
                return $this->getPositionId();

            case 5:
                return $this->getTerritoryName();

            case 6:
                return $this->getPositionName();

            case 7:
                return $this->getBeatName();

            case 8:
                return $this->getTags();

            case 9:
                return $this->getVisitFq();

            case 10:
                return $this->getComments();

            case 11:
                return $this->getOrgPotential();

            case 12:
                return $this->getBrandFocus();

            case 13:
                return $this->getCustomerFq();

            case 14:
                return $this->getOutlet_Id();

            case 15:
                return $this->getOutletMediaId();

            case 16:
                return $this->getOutletName();

            case 17:
                return $this->getOutletCode();

            case 18:
                return $this->getOutletEmail();

            case 19:
                return $this->getOutletSalutation();

            case 20:
                return $this->getOutletClassification();

            case 21:
                return $this->getClassification();

            case 22:
                return $this->getOutletOpening_date();

            case 23:
                return $this->getOutletContactName();

            case 24:
                return $this->getOutletLandlineno();

            case 25:
                return $this->getOutletAltLandlineno();

            case 26:
                return $this->getOutletContactBday();

            case 27:
                return $this->getOutletContactAnniversary();

            case 28:
                return $this->getOutletIsdCode();

            case 29:
                return $this->getOutletContactNo();

            case 30:
                return $this->getOutletAltContactNo();

            case 31:
                return $this->getOutletStatus();

            case 32:
                return $this->getOutlettypeId();

            case 33:
                return $this->getOutlettypeName();

            case 34:
                return $this->getCompanyId();

            case 35:
                return $this->getCreatedAt();

            case 36:
                return $this->getUpdatedAt();

            case 37:
                return $this->getOutletOtp();

            case 38:
                return $this->getOutletVerified();

            case 39:
                return $this->getOutletCreatedBy();

            case 40:
                return $this->getOutletApprovedBy();

            case 41:
                return $this->getOutletPotential();

            case 42:
                return $this->getIntegrationId();

            case 43:
                return $this->getItownid();

            case 44:
                return $this->getOutletQualification();

            case 45:
                return $this->getOutletRegno();

            case 46:
                return $this->getOutletMaritalStatus();

            case 47:
                return $this->getOutletMedia();

            case 48:
                return $this->getAddressName();

            case 49:
                return $this->getOutletAddress();

            case 50:
                return $this->getOutletStreetName();

            case 51:
                return $this->getOutletCity();

            case 52:
                return $this->getOutletState();

            case 53:
                return $this->getOutletCountry();

            case 54:
                return $this->getOutletPincode();

            case 55:
                return $this->getLastVisitDate();

            case 56:
                return $this->getLastVisitEmployee();

            case 57:
                return $this->getOutletOrgCode();

            case 58:
                return $this->getSgpiBrandMap();

            case 59:
                return $this->getSgpiBrandIdMap();

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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['OutletView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OutletView'][$this->hashCode()] = true;
        $keys = OutletViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOutletOrgId(),
            $keys[1] => $this->getOrgUnitId(),
            $keys[2] => $this->getTerritoryId(),
            $keys[3] => $this->getBeatId(),
            $keys[4] => $this->getPositionId(),
            $keys[5] => $this->getTerritoryName(),
            $keys[6] => $this->getPositionName(),
            $keys[7] => $this->getBeatName(),
            $keys[8] => $this->getTags(),
            $keys[9] => $this->getVisitFq(),
            $keys[10] => $this->getComments(),
            $keys[11] => $this->getOrgPotential(),
            $keys[12] => $this->getBrandFocus(),
            $keys[13] => $this->getCustomerFq(),
            $keys[14] => $this->getOutlet_Id(),
            $keys[15] => $this->getOutletMediaId(),
            $keys[16] => $this->getOutletName(),
            $keys[17] => $this->getOutletCode(),
            $keys[18] => $this->getOutletEmail(),
            $keys[19] => $this->getOutletSalutation(),
            $keys[20] => $this->getOutletClassification(),
            $keys[21] => $this->getClassification(),
            $keys[22] => $this->getOutletOpening_date(),
            $keys[23] => $this->getOutletContactName(),
            $keys[24] => $this->getOutletLandlineno(),
            $keys[25] => $this->getOutletAltLandlineno(),
            $keys[26] => $this->getOutletContactBday(),
            $keys[27] => $this->getOutletContactAnniversary(),
            $keys[28] => $this->getOutletIsdCode(),
            $keys[29] => $this->getOutletContactNo(),
            $keys[30] => $this->getOutletAltContactNo(),
            $keys[31] => $this->getOutletStatus(),
            $keys[32] => $this->getOutlettypeId(),
            $keys[33] => $this->getOutlettypeName(),
            $keys[34] => $this->getCompanyId(),
            $keys[35] => $this->getCreatedAt(),
            $keys[36] => $this->getUpdatedAt(),
            $keys[37] => $this->getOutletOtp(),
            $keys[38] => $this->getOutletVerified(),
            $keys[39] => $this->getOutletCreatedBy(),
            $keys[40] => $this->getOutletApprovedBy(),
            $keys[41] => $this->getOutletPotential(),
            $keys[42] => $this->getIntegrationId(),
            $keys[43] => $this->getItownid(),
            $keys[44] => $this->getOutletQualification(),
            $keys[45] => $this->getOutletRegno(),
            $keys[46] => $this->getOutletMaritalStatus(),
            $keys[47] => $this->getOutletMedia(),
            $keys[48] => $this->getAddressName(),
            $keys[49] => $this->getOutletAddress(),
            $keys[50] => $this->getOutletStreetName(),
            $keys[51] => $this->getOutletCity(),
            $keys[52] => $this->getOutletState(),
            $keys[53] => $this->getOutletCountry(),
            $keys[54] => $this->getOutletPincode(),
            $keys[55] => $this->getLastVisitDate(),
            $keys[56] => $this->getLastVisitEmployee(),
            $keys[57] => $this->getOutletOrgCode(),
            $keys[58] => $this->getSgpiBrandMap(),
            $keys[59] => $this->getSgpiBrandIdMap(),
        ];
        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d');
        }

        if ($result[$keys[26]] instanceof \DateTimeInterface) {
            $result[$keys[26]] = $result[$keys[26]]->format('Y-m-d');
        }

        if ($result[$keys[27]] instanceof \DateTimeInterface) {
            $result[$keys[27]] = $result[$keys[27]]->format('Y-m-d');
        }

        if ($result[$keys[35]] instanceof \DateTimeInterface) {
            $result[$keys[35]] = $result[$keys[35]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[36]] instanceof \DateTimeInterface) {
            $result[$keys[36]] = $result[$keys[36]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[55]] instanceof \DateTimeInterface) {
            $result[$keys[55]] = $result[$keys[55]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(OutletViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(OutletViewTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_TERRITORY_ID)) {
            $criteria->add(OutletViewTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_BEAT_ID)) {
            $criteria->add(OutletViewTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_POSITION_ID)) {
            $criteria->add(OutletViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(OutletViewTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_POSITION_NAME)) {
            $criteria->add(OutletViewTableMap::COL_POSITION_NAME, $this->position_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_BEAT_NAME)) {
            $criteria->add(OutletViewTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_TAGS)) {
            $criteria->add(OutletViewTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_VISIT_FQ)) {
            $criteria->add(OutletViewTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_COMMENTS)) {
            $criteria->add(OutletViewTableMap::COL_COMMENTS, $this->comments);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_ORG_POTENTIAL)) {
            $criteria->add(OutletViewTableMap::COL_ORG_POTENTIAL, $this->org_potential);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_BRAND_FOCUS)) {
            $criteria->add(OutletViewTableMap::COL_BRAND_FOCUS, $this->brand_focus);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_CUSTOMER_FQ)) {
            $criteria->add(OutletViewTableMap::COL_CUSTOMER_FQ, $this->customer_fq);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_ID)) {
            $criteria->add(OutletViewTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_MEDIA_ID)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_MEDIA_ID, $this->outlet_media_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CODE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_EMAIL)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_EMAIL, $this->outlet_email);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_SALUTATION)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_SALUTATION, $this->outlet_salutation);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CLASSIFICATION)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CLASSIFICATION, $this->outlet_classification);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_CLASSIFICATION)) {
            $criteria->add(OutletViewTableMap::COL_CLASSIFICATION, $this->classification);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_OPENING_DATE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_OPENING_DATE, $this->outlet_opening_date);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CONTACT_NAME)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CONTACT_NAME, $this->outlet_contact_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_LANDLINENO)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_LANDLINENO, $this->outlet_landlineno);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ALT_LANDLINENO, $this->outlet_alt_landlineno);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CONTACT_BDAY, $this->outlet_contact_bday);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CONTACT_ANNIVERSARY, $this->outlet_contact_anniversary);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ISD_CODE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ISD_CODE, $this->outlet_isd_code);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CONTACT_NO)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CONTACT_NO, $this->outlet_contact_no);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ALT_CONTACT_NO, $this->outlet_alt_contact_no);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_STATUS)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_STATUS, $this->outlet_status);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(OutletViewTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(OutletViewTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_COMPANY_ID)) {
            $criteria->add(OutletViewTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_CREATED_AT)) {
            $criteria->add(OutletViewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_UPDATED_AT)) {
            $criteria->add(OutletViewTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_OTP)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_OTP, $this->outlet_otp);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_VERIFIED)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_VERIFIED, $this->outlet_verified);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CREATED_BY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CREATED_BY, $this->outlet_created_by);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_APPROVED_BY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_APPROVED_BY, $this->outlet_approved_by);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_POTENTIAL)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_POTENTIAL, $this->outlet_potential);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_INTEGRATION_ID)) {
            $criteria->add(OutletViewTableMap::COL_INTEGRATION_ID, $this->integration_id);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_ITOWNID)) {
            $criteria->add(OutletViewTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_QUALIFICATION)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_QUALIFICATION, $this->outlet_qualification);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_REGNO)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_REGNO, $this->outlet_regno);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_MARITAL_STATUS)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_MARITAL_STATUS, $this->outlet_marital_status);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_MEDIA)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_MEDIA, $this->outlet_media);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_ADDRESS_NAME)) {
            $criteria->add(OutletViewTableMap::COL_ADDRESS_NAME, $this->address_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ADDRESS)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ADDRESS, $this->outlet_address);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_STREET_NAME)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_STREET_NAME, $this->outlet_street_name);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_CITY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_CITY, $this->outlet_city);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_STATE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_STATE, $this->outlet_state);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_COUNTRY)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_COUNTRY, $this->outlet_country);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_PINCODE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_PINCODE, $this->outlet_pincode);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_LAST_VISIT_DATE)) {
            $criteria->add(OutletViewTableMap::COL_LAST_VISIT_DATE, $this->last_visit_date);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE)) {
            $criteria->add(OutletViewTableMap::COL_LAST_VISIT_EMPLOYEE, $this->last_visit_employee);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_OUTLET_ORG_CODE)) {
            $criteria->add(OutletViewTableMap::COL_OUTLET_ORG_CODE, $this->outlet_org_code);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_SGPI_BRAND_MAP)) {
            $criteria->add(OutletViewTableMap::COL_SGPI_BRAND_MAP, $this->sgpi_brand_map);
        }
        if ($this->isColumnModified(OutletViewTableMap::COL_SGPI_BRAND_ID_MAP)) {
            $criteria->add(OutletViewTableMap::COL_SGPI_BRAND_ID_MAP, $this->sgpi_brand_id_map);
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
        $criteria = ChildOutletViewQuery::create();
        $criteria->add(OutletViewTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);

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
        $validPk = null !== $this->getOutletOrgId();

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
        return $this->getOutletOrgId();
    }

    /**
     * Generic method to set the primary key (outlet_org_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOutletOrgId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOutletOrgId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OutletView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setPositionName($this->getPositionName());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setTags($this->getTags());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setComments($this->getComments());
        $copyObj->setOrgPotential($this->getOrgPotential());
        $copyObj->setBrandFocus($this->getBrandFocus());
        $copyObj->setCustomerFq($this->getCustomerFq());
        $copyObj->setOutlet_Id($this->getOutlet_Id());
        $copyObj->setOutletMediaId($this->getOutletMediaId());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setOutletEmail($this->getOutletEmail());
        $copyObj->setOutletSalutation($this->getOutletSalutation());
        $copyObj->setOutletClassification($this->getOutletClassification());
        $copyObj->setClassification($this->getClassification());
        $copyObj->setOutletOpening_date($this->getOutletOpening_date());
        $copyObj->setOutletContactName($this->getOutletContactName());
        $copyObj->setOutletLandlineno($this->getOutletLandlineno());
        $copyObj->setOutletAltLandlineno($this->getOutletAltLandlineno());
        $copyObj->setOutletContactBday($this->getOutletContactBday());
        $copyObj->setOutletContactAnniversary($this->getOutletContactAnniversary());
        $copyObj->setOutletIsdCode($this->getOutletIsdCode());
        $copyObj->setOutletContactNo($this->getOutletContactNo());
        $copyObj->setOutletAltContactNo($this->getOutletAltContactNo());
        $copyObj->setOutletStatus($this->getOutletStatus());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOutletOtp($this->getOutletOtp());
        $copyObj->setOutletVerified($this->getOutletVerified());
        $copyObj->setOutletCreatedBy($this->getOutletCreatedBy());
        $copyObj->setOutletApprovedBy($this->getOutletApprovedBy());
        $copyObj->setOutletPotential($this->getOutletPotential());
        $copyObj->setIntegrationId($this->getIntegrationId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setOutletQualification($this->getOutletQualification());
        $copyObj->setOutletRegno($this->getOutletRegno());
        $copyObj->setOutletMaritalStatus($this->getOutletMaritalStatus());
        $copyObj->setOutletMedia($this->getOutletMedia());
        $copyObj->setAddressName($this->getAddressName());
        $copyObj->setOutletAddress($this->getOutletAddress());
        $copyObj->setOutletStreetName($this->getOutletStreetName());
        $copyObj->setOutletCity($this->getOutletCity());
        $copyObj->setOutletState($this->getOutletState());
        $copyObj->setOutletCountry($this->getOutletCountry());
        $copyObj->setOutletPincode($this->getOutletPincode());
        $copyObj->setLastVisitDate($this->getLastVisitDate());
        $copyObj->setLastVisitEmployee($this->getLastVisitEmployee());
        $copyObj->setOutletOrgCode($this->getOutletOrgCode());
        $copyObj->setSgpiBrandMap($this->getSgpiBrandMap());
        $copyObj->setSgpiBrandIdMap($this->getSgpiBrandIdMap());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \entities\OutletView Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->outlet_org_id = null;
        $this->org_unit_id = null;
        $this->territory_id = null;
        $this->beat_id = null;
        $this->position_id = null;
        $this->territory_name = null;
        $this->position_name = null;
        $this->beat_name = null;
        $this->tags = null;
        $this->visit_fq = null;
        $this->comments = null;
        $this->org_potential = null;
        $this->brand_focus = null;
        $this->customer_fq = null;
        $this->id = null;
        $this->outlet_media_id = null;
        $this->outlet_name = null;
        $this->outlet_code = null;
        $this->outlet_email = null;
        $this->outlet_salutation = null;
        $this->outlet_classification = null;
        $this->classification = null;
        $this->outlet_opening_date = null;
        $this->outlet_contact_name = null;
        $this->outlet_landlineno = null;
        $this->outlet_alt_landlineno = null;
        $this->outlet_contact_bday = null;
        $this->outlet_contact_anniversary = null;
        $this->outlet_isd_code = null;
        $this->outlet_contact_no = null;
        $this->outlet_alt_contact_no = null;
        $this->outlet_status = null;
        $this->outlettype_id = null;
        $this->outlettype_name = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->outlet_otp = null;
        $this->outlet_verified = null;
        $this->outlet_created_by = null;
        $this->outlet_approved_by = null;
        $this->outlet_potential = null;
        $this->integration_id = null;
        $this->itownid = null;
        $this->outlet_qualification = null;
        $this->outlet_regno = null;
        $this->outlet_marital_status = null;
        $this->outlet_media = null;
        $this->address_name = null;
        $this->outlet_address = null;
        $this->outlet_street_name = null;
        $this->outlet_city = null;
        $this->outlet_state = null;
        $this->outlet_country = null;
        $this->outlet_pincode = null;
        $this->last_visit_date = null;
        $this->last_visit_employee = null;
        $this->outlet_org_code = null;
        $this->sgpi_brand_map = null;
        $this->sgpi_brand_id_map = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OutletViewTableMap::DEFAULT_STRING_FORMAT);
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

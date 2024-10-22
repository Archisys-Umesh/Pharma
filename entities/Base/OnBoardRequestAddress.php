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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Classification as ChildClassification;
use entities\ClassificationQuery as ChildClassificationQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\GeoCity as ChildGeoCity;
use entities\GeoCityQuery as ChildGeoCityQuery;
use entities\GeoState as ChildGeoState;
use entities\GeoStateQuery as ChildGeoStateQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OnBoardRequest as ChildOnBoardRequest;
use entities\OnBoardRequestAddressQuery as ChildOnBoardRequestAddressQuery;
use entities\OnBoardRequestQuery as ChildOnBoardRequestQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletAddress as ChildOutletAddress;
use entities\OutletAddressQuery as ChildOutletAddressQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\OutletTags as ChildOutletTags;
use entities\OutletTagsQuery as ChildOutletTagsQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Map\OnBoardRequestAddressTableMap;

/**
 * Base class that represents a row from the 'on_board_request_address' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class OnBoardRequestAddress implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\OnBoardRequestAddressTableMap';


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
     * The value for the on_board_request_address_id field.
     *
     * @var        int
     */
    protected $on_board_request_address_id;

    /**
     * The value for the outlet_sub_type_id field.
     *
     * @var        int|null
     */
    protected $outlet_sub_type_id;

    /**
     * The value for the address field.
     *
     * @var        string|null
     */
    protected $address;

    /**
     * The value for the landmark field.
     *
     * @var        string|null
     */
    protected $landmark;

    /**
     * The value for the icityid field.
     *
     * @var        int|null
     */
    protected $icityid;

    /**
     * The value for the itownid field.
     *
     * @var        int|null
     */
    protected $itownid;

    /**
     * The value for the istateid field.
     *
     * @var        int|null
     */
    protected $istateid;

    /**
     * The value for the pincode field.
     *
     * @var        string|null
     */
    protected $pincode;

    /**
     * The value for the outlet_org_data_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_data_id;

    /**
     * The value for the speciality field.
     *
     * @var        int|null
     */
    protected $speciality;

    /**
     * The value for the potential field.
     *
     * @var        string|null
     */
    protected $potential;

    /**
     * The value for the visit_frequency field.
     *
     * @var        int|null
     */
    protected $visit_frequency;

    /**
     * The value for the tags field.
     *
     * @var        int|null
     */
    protected $tags;

    /**
     * The value for the focus_brand field.
     *
     * @var        int|null
     */
    protected $focus_brand;

    /**
     * The value for the spport_documents field.
     *
     * @var        string|null
     */
    protected $spport_documents;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

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
     * The value for the address_id field.
     *
     * @var        int|null
     */
    protected $address_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the on_board_request_id field.
     *
     * @var        int|null
     */
    protected $on_board_request_id;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the invested_amount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string|null
     */
    protected $invested_amount;

    /**
     * The value for the outlet_org_code field.
     *
     * @var        string|null
     */
    protected $outlet_org_code;

    /**
     * @var        ChildOutletAddress
     */
    protected $aOutletAddress;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ChildClassification
     */
    protected $aClassification;

    /**
     * @var        ChildOutletTags
     */
    protected $aOutletTags;

    /**
     * @var        ChildBeats
     */
    protected $aBeats;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildGeoCity
     */
    protected $aGeoCity;

    /**
     * @var        ChildGeoState
     */
    protected $aGeoState;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ChildOnBoardRequest
     */
    protected $aOnBoardRequest;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildOutletOrgData
     */
    protected $aOutletOrgData;

    /**
     * @var        ChildOutletType
     */
    protected $aOutletType;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->invested_amount = '0.00';
    }

    /**
     * Initializes internal state of entities\Base\OnBoardRequestAddress object.
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
     * Compares this with another <code>OnBoardRequestAddress</code> instance.  If
     * <code>obj</code> is an instance of <code>OnBoardRequestAddress</code>, delegates to
     * <code>equals(OnBoardRequestAddress)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [on_board_request_address_id] column value.
     *
     * @return int
     */
    public function getOnBoardRequestAddressId()
    {
        return $this->on_board_request_address_id;
    }

    /**
     * Get the [outlet_sub_type_id] column value.
     *
     * @return int|null
     */
    public function getOutletSubTypeId()
    {
        return $this->outlet_sub_type_id;
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
     * Get the [landmark] column value.
     *
     * @return string|null
     */
    public function getLandmark()
    {
        return $this->landmark;
    }

    /**
     * Get the [icityid] column value.
     *
     * @return int|null
     */
    public function getIcityid()
    {
        return $this->icityid;
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
     * Get the [istateid] column value.
     *
     * @return int|null
     */
    public function getIstateid()
    {
        return $this->istateid;
    }

    /**
     * Get the [pincode] column value.
     *
     * @return string|null
     */
    public function getPincode()
    {
        return $this->pincode;
    }

    /**
     * Get the [outlet_org_data_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgDataId()
    {
        return $this->outlet_org_data_id;
    }

    /**
     * Get the [speciality] column value.
     *
     * @return int|null
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Get the [potential] column value.
     *
     * @return string|null
     */
    public function getPotential()
    {
        return $this->potential;
    }

    /**
     * Get the [visit_frequency] column value.
     *
     * @return int|null
     */
    public function getVisitFrequency()
    {
        return $this->visit_frequency;
    }

    /**
     * Get the [tags] column value.
     *
     * @return int|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the [focus_brand] column value.
     *
     * @return int|null
     */
    public function getFocusBrand()
    {
        return $this->focus_brand;
    }

    /**
     * Get the [spport_documents] column value.
     *
     * @return string|null
     */
    public function getSpportDocuments()
    {
        return $this->spport_documents;
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
     * Get the [address_id] column value.
     *
     * @return int|null
     */
    public function getAddressId()
    {
        return $this->address_id;
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
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [on_board_request_id] column value.
     *
     * @return int|null
     */
    public function getOnBoardRequestId()
    {
        return $this->on_board_request_id;
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [invested_amount] column value.
     *
     * @return string|null
     */
    public function getInvestedAmount()
    {
        return $this->invested_amount;
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
     * Set the value of [on_board_request_address_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_board_request_address_id !== $v) {
            $this->on_board_request_address_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_sub_type_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletSubTypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_sub_type_id !== $v) {
            $this->outlet_sub_type_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID] = true;
        }

        if ($this->aOutletType !== null && $this->aOutletType->getOutlettypeId() !== $v) {
            $this->aOutletType = null;
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
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [landmark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLandmark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->landmark !== $v) {
            $this->landmark = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_LANDMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [icityid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIcityid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->icityid !== $v) {
            $this->icityid = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ICITYID] = true;
        }

        if ($this->aGeoCity !== null && $this->aGeoCity->getIcityid() !== $v) {
            $this->aGeoCity = null;
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
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [istateid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIstateid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->istateid !== $v) {
            $this->istateid = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ISTATEID] = true;
        }

        if ($this->aGeoState !== null && $this->aGeoState->getIstateid() !== $v) {
            $this->aGeoState = null;
        }

        return $this;
    }

    /**
     * Set the value of [pincode] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPincode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pincode !== $v) {
            $this->pincode = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_PINCODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_data_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_data_id !== $v) {
            $this->outlet_org_data_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        if ($this->aOutletOrgData !== null && $this->aOutletOrgData->getOutletOrgId() !== $v) {
            $this->aOutletOrgData = null;
        }

        return $this;
    }

    /**
     * Set the value of [speciality] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSpeciality($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->speciality !== $v) {
            $this->speciality = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_SPECIALITY] = true;
        }

        if ($this->aClassification !== null && $this->aClassification->getId() !== $v) {
            $this->aClassification = null;
        }

        return $this;
    }

    /**
     * Set the value of [potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->potential !== $v) {
            $this->potential = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_POTENTIAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_frequency] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitFrequency($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_frequency !== $v) {
            $this->visit_frequency = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTags($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_TAGS] = true;
        }

        if ($this->aOutletTags !== null && $this->aOutletTags->getOutletTagId() !== $v) {
            $this->aOutletTags = null;
        }

        return $this;
    }

    /**
     * Set the value of [focus_brand] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFocusBrand($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->focus_brand !== $v) {
            $this->focus_brand = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_FOCUS_BRAND] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [spport_documents] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSpportDocuments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->spport_documents !== $v) {
            $this->spport_documents = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
                $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [address_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddressId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->address_id !== $v) {
            $this->address_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ADDRESS_ID] = true;
        }

        if ($this->aOutletAddress !== null && $this->aOutletAddress->getOutletAddressId() !== $v) {
            $this->aOutletAddress = null;
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
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_BEAT_ID] = true;
        }

        if ($this->aBeats !== null && $this->aBeats->getBeatId() !== $v) {
            $this->aBeats = null;
        }

        return $this;
    }

    /**
     * Set the value of [on_board_request_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOnBoardRequestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->on_board_request_id !== $v) {
            $this->on_board_request_id = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID] = true;
        }

        if ($this->aOnBoardRequest !== null && $this->aOnBoardRequest->getOnBoardRequestId() !== $v) {
            $this->aOnBoardRequest = null;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [invested_amount] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setInvestedAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invested_amount !== $v) {
            $this->invested_amount = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_code !== $v) {
            $this->outlet_org_code = $v;
            $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE] = true;
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
            if ($this->invested_amount !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OnBoardRequestAddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_request_address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OutletSubTypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_sub_type_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Landmark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->landmark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icityid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->istateid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Pincode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pincode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Speciality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->speciality = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Potential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('VisitFrequency', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_frequency = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('FocusBrand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->focus_brand = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('SpportDocuments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->spport_documents = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('AddressId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->on_board_request_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('InvestedAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->invested_amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OnBoardRequestAddressTableMap::translateFieldName('OutletOrgCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_code = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 25; // 25 = OnBoardRequestAddressTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\OnBoardRequestAddress'), 0, $e);
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
        if ($this->aOutletType !== null && $this->outlet_sub_type_id !== $this->aOutletType->getOutlettypeId()) {
            $this->aOutletType = null;
        }
        if ($this->aGeoCity !== null && $this->icityid !== $this->aGeoCity->getIcityid()) {
            $this->aGeoCity = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
        if ($this->aGeoState !== null && $this->istateid !== $this->aGeoState->getIstateid()) {
            $this->aGeoState = null;
        }
        if ($this->aOutletOrgData !== null && $this->outlet_org_data_id !== $this->aOutletOrgData->getOutletOrgId()) {
            $this->aOutletOrgData = null;
        }
        if ($this->aClassification !== null && $this->speciality !== $this->aClassification->getId()) {
            $this->aClassification = null;
        }
        if ($this->aOutletTags !== null && $this->tags !== $this->aOutletTags->getOutletTagId()) {
            $this->aOutletTags = null;
        }
        if ($this->aBrands !== null && $this->focus_brand !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
        if ($this->aOrgUnit !== null && $this->org_unit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aOutletAddress !== null && $this->address_id !== $this->aOutletAddress->getOutletAddressId()) {
            $this->aOutletAddress = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aBeats !== null && $this->beat_id !== $this->aBeats->getBeatId()) {
            $this->aBeats = null;
        }
        if ($this->aOnBoardRequest !== null && $this->on_board_request_id !== $this->aOnBoardRequest->getOnBoardRequestId()) {
            $this->aOnBoardRequest = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOnBoardRequestAddressQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOutletAddress = null;
            $this->aBrands = null;
            $this->aClassification = null;
            $this->aOutletTags = null;
            $this->aBeats = null;
            $this->aCompany = null;
            $this->aGeoCity = null;
            $this->aGeoState = null;
            $this->aGeoTowns = null;
            $this->aOnBoardRequest = null;
            $this->aOrgUnit = null;
            $this->aOutletOrgData = null;
            $this->aOutletType = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see OnBoardRequestAddress::setDeleted()
     * @see OnBoardRequestAddress::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOnBoardRequestAddressQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestAddressTableMap::DATABASE_NAME);
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
                OnBoardRequestAddressTableMap::addInstanceToPool($this);
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

            if ($this->aOutletAddress !== null) {
                if ($this->aOutletAddress->isModified() || $this->aOutletAddress->isNew()) {
                    $affectedRows += $this->aOutletAddress->save($con);
                }
                $this->setOutletAddress($this->aOutletAddress);
            }

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
            }

            if ($this->aClassification !== null) {
                if ($this->aClassification->isModified() || $this->aClassification->isNew()) {
                    $affectedRows += $this->aClassification->save($con);
                }
                $this->setClassification($this->aClassification);
            }

            if ($this->aOutletTags !== null) {
                if ($this->aOutletTags->isModified() || $this->aOutletTags->isNew()) {
                    $affectedRows += $this->aOutletTags->save($con);
                }
                $this->setOutletTags($this->aOutletTags);
            }

            if ($this->aBeats !== null) {
                if ($this->aBeats->isModified() || $this->aBeats->isNew()) {
                    $affectedRows += $this->aBeats->save($con);
                }
                $this->setBeats($this->aBeats);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aGeoCity !== null) {
                if ($this->aGeoCity->isModified() || $this->aGeoCity->isNew()) {
                    $affectedRows += $this->aGeoCity->save($con);
                }
                $this->setGeoCity($this->aGeoCity);
            }

            if ($this->aGeoState !== null) {
                if ($this->aGeoState->isModified() || $this->aGeoState->isNew()) {
                    $affectedRows += $this->aGeoState->save($con);
                }
                $this->setGeoState($this->aGeoState);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
            }

            if ($this->aOnBoardRequest !== null) {
                if ($this->aOnBoardRequest->isModified() || $this->aOnBoardRequest->isNew()) {
                    $affectedRows += $this->aOnBoardRequest->save($con);
                }
                $this->setOnBoardRequest($this->aOnBoardRequest);
            }

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aOutletOrgData !== null) {
                if ($this->aOutletOrgData->isModified() || $this->aOutletOrgData->isNew()) {
                    $affectedRows += $this->aOutletOrgData->save($con);
                }
                $this->setOutletOrgData($this->aOutletOrgData);
            }

            if ($this->aOutletType !== null) {
                if ($this->aOutletType->isModified() || $this->aOutletType->isNew()) {
                    $affectedRows += $this->aOutletType->save($con);
                }
                $this->setOutletType($this->aOutletType);
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

        $this->modifiedColumns[OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID] = true;
        if (null !== $this->on_board_request_address_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID . ')');
        }
        if (null === $this->on_board_request_address_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('on_board_request_address_on_board_request_address_id_seq')");
                $this->on_board_request_address_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'on_board_request_address_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_sub_type_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_LANDMARK)) {
            $modifiedColumns[':p' . $index++]  = 'landmark';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ICITYID)) {
            $modifiedColumns[':p' . $index++]  = 'icityid';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ISTATEID)) {
            $modifiedColumns[':p' . $index++]  = 'istateid';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_PINCODE)) {
            $modifiedColumns[':p' . $index++]  = 'pincode';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_data_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_SPECIALITY)) {
            $modifiedColumns[':p' . $index++]  = 'speciality';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_POTENTIAL)) {
            $modifiedColumns[':p' . $index++]  = 'potential';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY)) {
            $modifiedColumns[':p' . $index++]  = 'visit_frequency';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_TAGS)) {
            $modifiedColumns[':p' . $index++]  = 'tags';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'focus_brand';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'spport_documents';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'org_unit_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ADDRESS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'address_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_BEAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'on_board_request_id';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'invested_amount';
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_code';
        }

        $sql = sprintf(
            'INSERT INTO on_board_request_address (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'on_board_request_address_id':
                        $stmt->bindValue($identifier, $this->on_board_request_address_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_sub_type_id':
                        $stmt->bindValue($identifier, $this->outlet_sub_type_id, PDO::PARAM_INT);

                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);

                        break;
                    case 'landmark':
                        $stmt->bindValue($identifier, $this->landmark, PDO::PARAM_STR);

                        break;
                    case 'icityid':
                        $stmt->bindValue($identifier, $this->icityid, PDO::PARAM_INT);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'istateid':
                        $stmt->bindValue($identifier, $this->istateid, PDO::PARAM_INT);

                        break;
                    case 'pincode':
                        $stmt->bindValue($identifier, $this->pincode, PDO::PARAM_STR);

                        break;
                    case 'outlet_org_data_id':
                        $stmt->bindValue($identifier, $this->outlet_org_data_id, PDO::PARAM_INT);

                        break;
                    case 'speciality':
                        $stmt->bindValue($identifier, $this->speciality, PDO::PARAM_INT);

                        break;
                    case 'potential':
                        $stmt->bindValue($identifier, $this->potential, PDO::PARAM_STR);

                        break;
                    case 'visit_frequency':
                        $stmt->bindValue($identifier, $this->visit_frequency, PDO::PARAM_INT);

                        break;
                    case 'tags':
                        $stmt->bindValue($identifier, $this->tags, PDO::PARAM_INT);

                        break;
                    case 'focus_brand':
                        $stmt->bindValue($identifier, $this->focus_brand, PDO::PARAM_INT);

                        break;
                    case 'spport_documents':
                        $stmt->bindValue($identifier, $this->spport_documents, PDO::PARAM_STR);

                        break;
                    case 'org_unit_id':
                        $stmt->bindValue($identifier, $this->org_unit_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'address_id':
                        $stmt->bindValue($identifier, $this->address_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'beat_id':
                        $stmt->bindValue($identifier, $this->beat_id, PDO::PARAM_INT);

                        break;
                    case 'on_board_request_id':
                        $stmt->bindValue($identifier, $this->on_board_request_id, PDO::PARAM_INT);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'invested_amount':
                        $stmt->bindValue($identifier, $this->invested_amount, PDO::PARAM_STR);

                        break;
                    case 'outlet_org_code':
                        $stmt->bindValue($identifier, $this->outlet_org_code, PDO::PARAM_STR);

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
        $pos = OnBoardRequestAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getOnBoardRequestAddressId();

            case 1:
                return $this->getOutletSubTypeId();

            case 2:
                return $this->getAddress();

            case 3:
                return $this->getLandmark();

            case 4:
                return $this->getIcityid();

            case 5:
                return $this->getItownid();

            case 6:
                return $this->getIstateid();

            case 7:
                return $this->getPincode();

            case 8:
                return $this->getOutletOrgDataId();

            case 9:
                return $this->getSpeciality();

            case 10:
                return $this->getPotential();

            case 11:
                return $this->getVisitFrequency();

            case 12:
                return $this->getTags();

            case 13:
                return $this->getFocusBrand();

            case 14:
                return $this->getSpportDocuments();

            case 15:
                return $this->getOrgUnitId();

            case 16:
                return $this->getCreatedAt();

            case 17:
                return $this->getUpdatedAt();

            case 18:
                return $this->getAddressId();

            case 19:
                return $this->getCompanyId();

            case 20:
                return $this->getBeatId();

            case 21:
                return $this->getOnBoardRequestId();

            case 22:
                return $this->getStatus();

            case 23:
                return $this->getInvestedAmount();

            case 24:
                return $this->getOutletOrgCode();

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
        if (isset($alreadyDumpedObjects['OnBoardRequestAddress'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['OnBoardRequestAddress'][$this->hashCode()] = true;
        $keys = OnBoardRequestAddressTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getOnBoardRequestAddressId(),
            $keys[1] => $this->getOutletSubTypeId(),
            $keys[2] => $this->getAddress(),
            $keys[3] => $this->getLandmark(),
            $keys[4] => $this->getIcityid(),
            $keys[5] => $this->getItownid(),
            $keys[6] => $this->getIstateid(),
            $keys[7] => $this->getPincode(),
            $keys[8] => $this->getOutletOrgDataId(),
            $keys[9] => $this->getSpeciality(),
            $keys[10] => $this->getPotential(),
            $keys[11] => $this->getVisitFrequency(),
            $keys[12] => $this->getTags(),
            $keys[13] => $this->getFocusBrand(),
            $keys[14] => $this->getSpportDocuments(),
            $keys[15] => $this->getOrgUnitId(),
            $keys[16] => $this->getCreatedAt(),
            $keys[17] => $this->getUpdatedAt(),
            $keys[18] => $this->getAddressId(),
            $keys[19] => $this->getCompanyId(),
            $keys[20] => $this->getBeatId(),
            $keys[21] => $this->getOnBoardRequestId(),
            $keys[22] => $this->getStatus(),
            $keys[23] => $this->getInvestedAmount(),
            $keys[24] => $this->getOutletOrgCode(),
        ];
        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOutletAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_address';
                        break;
                    default:
                        $key = 'OutletAddress';
                }

                $result[$key] = $this->aOutletAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBrands) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brands';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brands';
                        break;
                    default:
                        $key = 'Brands';
                }

                $result[$key] = $this->aBrands->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aClassification) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'classification';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'classification';
                        break;
                    default:
                        $key = 'Classification';
                }

                $result[$key] = $this->aClassification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutletTags) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletTags';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_tags';
                        break;
                    default:
                        $key = 'OutletTags';
                }

                $result[$key] = $this->aOutletTags->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBeats) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beats';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beats';
                        break;
                    default:
                        $key = 'Beats';
                }

                $result[$key] = $this->aBeats->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aGeoCity) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoCity';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_city';
                        break;
                    default:
                        $key = 'GeoCity';
                }

                $result[$key] = $this->aGeoCity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoState) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoState';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_state';
                        break;
                    default:
                        $key = 'GeoState';
                }

                $result[$key] = $this->aGeoState->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aOnBoardRequest) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'onBoardRequest';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'on_board_request';
                        break;
                    default:
                        $key = 'OnBoardRequest';
                }

                $result[$key] = $this->aOnBoardRequest->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aOutletOrgData) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOrgData';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_org_data';
                        break;
                    default:
                        $key = 'OutletOrgData';
                }

                $result[$key] = $this->aOutletOrgData->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = OnBoardRequestAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setOnBoardRequestAddressId($value);
                break;
            case 1:
                $this->setOutletSubTypeId($value);
                break;
            case 2:
                $this->setAddress($value);
                break;
            case 3:
                $this->setLandmark($value);
                break;
            case 4:
                $this->setIcityid($value);
                break;
            case 5:
                $this->setItownid($value);
                break;
            case 6:
                $this->setIstateid($value);
                break;
            case 7:
                $this->setPincode($value);
                break;
            case 8:
                $this->setOutletOrgDataId($value);
                break;
            case 9:
                $this->setSpeciality($value);
                break;
            case 10:
                $this->setPotential($value);
                break;
            case 11:
                $this->setVisitFrequency($value);
                break;
            case 12:
                $this->setTags($value);
                break;
            case 13:
                $this->setFocusBrand($value);
                break;
            case 14:
                $this->setSpportDocuments($value);
                break;
            case 15:
                $this->setOrgUnitId($value);
                break;
            case 16:
                $this->setCreatedAt($value);
                break;
            case 17:
                $this->setUpdatedAt($value);
                break;
            case 18:
                $this->setAddressId($value);
                break;
            case 19:
                $this->setCompanyId($value);
                break;
            case 20:
                $this->setBeatId($value);
                break;
            case 21:
                $this->setOnBoardRequestId($value);
                break;
            case 22:
                $this->setStatus($value);
                break;
            case 23:
                $this->setInvestedAmount($value);
                break;
            case 24:
                $this->setOutletOrgCode($value);
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
        $keys = OnBoardRequestAddressTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOnBoardRequestAddressId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletSubTypeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAddress($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLandmark($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIcityid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setItownid($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIstateid($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPincode($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOutletOrgDataId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setSpeciality($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPotential($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setVisitFrequency($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTags($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFocusBrand($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setSpportDocuments($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setOrgUnitId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCreatedAt($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setUpdatedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setAddressId($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCompanyId($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setBeatId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setOnBoardRequestId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setStatus($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setInvestedAmount($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setOutletOrgCode($arr[$keys[24]]);
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
        $criteria = new Criteria(OnBoardRequestAddressTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $this->on_board_request_address_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_OUTLET_SUB_TYPE_ID, $this->outlet_sub_type_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ADDRESS)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_LANDMARK)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_LANDMARK, $this->landmark);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ICITYID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ICITYID, $this->icityid);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ITOWNID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ISTATEID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ISTATEID, $this->istateid);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_PINCODE)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_PINCODE, $this->pincode);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_SPECIALITY)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_SPECIALITY, $this->speciality);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_POTENTIAL)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_POTENTIAL, $this->potential);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_VISIT_FREQUENCY, $this->visit_frequency);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_TAGS)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_FOCUS_BRAND, $this->focus_brand);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_SPPORT_DOCUMENTS, $this->spport_documents);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_CREATED_AT)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_UPDATED_AT)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ADDRESS_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ADDRESS_ID, $this->address_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_COMPANY_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_BEAT_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ID, $this->on_board_request_id);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_STATUS)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_INVESTED_AMOUNT, $this->invested_amount);
        }
        if ($this->isColumnModified(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE)) {
            $criteria->add(OnBoardRequestAddressTableMap::COL_OUTLET_ORG_CODE, $this->outlet_org_code);
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
        $criteria = ChildOnBoardRequestAddressQuery::create();
        $criteria->add(OnBoardRequestAddressTableMap::COL_ON_BOARD_REQUEST_ADDRESS_ID, $this->on_board_request_address_id);

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
        $validPk = null !== $this->getOnBoardRequestAddressId();

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
        return $this->getOnBoardRequestAddressId();
    }

    /**
     * Generic method to set the primary key (on_board_request_address_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setOnBoardRequestAddressId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getOnBoardRequestAddressId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\OnBoardRequestAddress (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletSubTypeId($this->getOutletSubTypeId());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setLandmark($this->getLandmark());
        $copyObj->setIcityid($this->getIcityid());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setIstateid($this->getIstateid());
        $copyObj->setPincode($this->getPincode());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setSpeciality($this->getSpeciality());
        $copyObj->setPotential($this->getPotential());
        $copyObj->setVisitFrequency($this->getVisitFrequency());
        $copyObj->setTags($this->getTags());
        $copyObj->setFocusBrand($this->getFocusBrand());
        $copyObj->setSpportDocuments($this->getSpportDocuments());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAddressId($this->getAddressId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setOnBoardRequestId($this->getOnBoardRequestId());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setInvestedAmount($this->getInvestedAmount());
        $copyObj->setOutletOrgCode($this->getOutletOrgCode());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOnBoardRequestAddressId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\OnBoardRequestAddress Clone of current object.
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
     * Declares an association between this object and a ChildOutletAddress object.
     *
     * @param ChildOutletAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletAddress(ChildOutletAddress $v = null)
    {
        if ($v === null) {
            $this->setAddressId(NULL);
        } else {
            $this->setAddressId($v->getOutletAddressId());
        }

        $this->aOutletAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletAddress|null The associated ChildOutletAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletAddress(?ConnectionInterface $con = null)
    {
        if ($this->aOutletAddress === null && ($this->address_id != 0)) {
            $this->aOutletAddress = ChildOutletAddressQuery::create()->findPk($this->address_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletAddress->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOutletAddress;
    }

    /**
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setFocusBrand(NULL);
        } else {
            $this->setFocusBrand($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands|null The associated ChildBrands object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrands(?ConnectionInterface $con = null)
    {
        if ($this->aBrands === null && ($this->focus_brand != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->focus_brand, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aBrands;
    }

    /**
     * Declares an association between this object and a ChildClassification object.
     *
     * @param ChildClassification|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setClassification(ChildClassification $v = null)
    {
        if ($v === null) {
            $this->setSpeciality(NULL);
        } else {
            $this->setSpeciality($v->getId());
        }

        $this->aClassification = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildClassification object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildClassification object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildClassification|null The associated ChildClassification object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getClassification(?ConnectionInterface $con = null)
    {
        if ($this->aClassification === null && ($this->speciality != 0)) {
            $this->aClassification = ChildClassificationQuery::create()->findPk($this->speciality, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClassification->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aClassification;
    }

    /**
     * Declares an association between this object and a ChildOutletTags object.
     *
     * @param ChildOutletTags|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletTags(ChildOutletTags $v = null)
    {
        if ($v === null) {
            $this->setTags(NULL);
        } else {
            $this->setTags($v->getOutletTagId());
        }

        $this->aOutletTags = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletTags object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletTags object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletTags|null The associated ChildOutletTags object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletTags(?ConnectionInterface $con = null)
    {
        if ($this->aOutletTags === null && ($this->tags != 0)) {
            $this->aOutletTags = ChildOutletTagsQuery::create()->findPk($this->tags, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletTags->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOutletTags;
    }

    /**
     * Declares an association between this object and a ChildBeats object.
     *
     * @param ChildBeats|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBeats(ChildBeats $v = null)
    {
        if ($v === null) {
            $this->setBeatId(NULL);
        } else {
            $this->setBeatId($v->getBeatId());
        }

        $this->aBeats = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBeats object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBeats object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBeats|null The associated ChildBeats object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeats(?ConnectionInterface $con = null)
    {
        if ($this->aBeats === null && ($this->beat_id != 0)) {
            $this->aBeats = ChildBeatsQuery::create()->findPk($this->beat_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBeats->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aBeats;
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
            $v->addOnBoardRequestAddress($this);
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
                $this->aCompany->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildGeoCity object.
     *
     * @param ChildGeoCity|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoCity(ChildGeoCity $v = null)
    {
        if ($v === null) {
            $this->setIcityid(NULL);
        } else {
            $this->setIcityid($v->getIcityid());
        }

        $this->aGeoCity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoCity object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoCity object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoCity|null The associated ChildGeoCity object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoCity(?ConnectionInterface $con = null)
    {
        if ($this->aGeoCity === null && ($this->icityid != 0)) {
            $this->aGeoCity = ChildGeoCityQuery::create()->findPk($this->icityid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoCity->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aGeoCity;
    }

    /**
     * Declares an association between this object and a ChildGeoState object.
     *
     * @param ChildGeoState|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoState(ChildGeoState $v = null)
    {
        if ($v === null) {
            $this->setIstateid(NULL);
        } else {
            $this->setIstateid($v->getIstateid());
        }

        $this->aGeoState = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoState object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoState object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoState|null The associated ChildGeoState object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoState(?ConnectionInterface $con = null)
    {
        if ($this->aGeoState === null && ($this->istateid != 0)) {
            $this->aGeoState = ChildGeoStateQuery::create()->findPk($this->istateid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoState->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aGeoState;
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
            $v->addOnBoardRequestAddress($this);
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
                $this->aGeoTowns->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aGeoTowns;
    }

    /**
     * Declares an association between this object and a ChildOnBoardRequest object.
     *
     * @param ChildOnBoardRequest|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOnBoardRequest(ChildOnBoardRequest $v = null)
    {
        if ($v === null) {
            $this->setOnBoardRequestId(NULL);
        } else {
            $this->setOnBoardRequestId($v->getOnBoardRequestId());
        }

        $this->aOnBoardRequest = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOnBoardRequest object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOnBoardRequest object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOnBoardRequest|null The associated ChildOnBoardRequest object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOnBoardRequest(?ConnectionInterface $con = null)
    {
        if ($this->aOnBoardRequest === null && ($this->on_board_request_id != 0)) {
            $this->aOnBoardRequest = ChildOnBoardRequestQuery::create()->findPk($this->on_board_request_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOnBoardRequest->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOnBoardRequest;
    }

    /**
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit|null $v
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
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit|null The associated ChildOrgUnit object.
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
                $this->aOrgUnit->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildOutletOrgData object.
     *
     * @param ChildOutletOrgData|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletOrgData(ChildOutletOrgData $v = null)
    {
        if ($v === null) {
            $this->setOutletOrgDataId(NULL);
        } else {
            $this->setOutletOrgDataId($v->getOutletOrgId());
        }

        $this->aOutletOrgData = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletOrgData object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletOrgData object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletOrgData|null The associated ChildOutletOrgData object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOrgData(?ConnectionInterface $con = null)
    {
        if ($this->aOutletOrgData === null && ($this->outlet_org_data_id != 0)) {
            $this->aOutletOrgData = ChildOutletOrgDataQuery::create()->findPk($this->outlet_org_data_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletOrgData->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOutletOrgData;
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
            $this->setOutletSubTypeId(NULL);
        } else {
            $this->setOutletSubTypeId($v->getOutlettypeId());
        }

        $this->aOutletType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletType object, it will not be re-added.
        if ($v !== null) {
            $v->addOnBoardRequestAddress($this);
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
        if ($this->aOutletType === null && ($this->outlet_sub_type_id != 0)) {
            $this->aOutletType = ChildOutletTypeQuery::create()->findPk($this->outlet_sub_type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletType->addOnBoardRequestAddresses($this);
             */
        }

        return $this->aOutletType;
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
        if (null !== $this->aOutletAddress) {
            $this->aOutletAddress->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aClassification) {
            $this->aClassification->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aOutletTags) {
            $this->aOutletTags->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aBeats) {
            $this->aBeats->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aGeoCity) {
            $this->aGeoCity->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aGeoState) {
            $this->aGeoState->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aOnBoardRequest) {
            $this->aOnBoardRequest->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aOutletOrgData) {
            $this->aOutletOrgData->removeOnBoardRequestAddress($this);
        }
        if (null !== $this->aOutletType) {
            $this->aOutletType->removeOnBoardRequestAddress($this);
        }
        $this->on_board_request_address_id = null;
        $this->outlet_sub_type_id = null;
        $this->address = null;
        $this->landmark = null;
        $this->icityid = null;
        $this->itownid = null;
        $this->istateid = null;
        $this->pincode = null;
        $this->outlet_org_data_id = null;
        $this->speciality = null;
        $this->potential = null;
        $this->visit_frequency = null;
        $this->tags = null;
        $this->focus_brand = null;
        $this->spport_documents = null;
        $this->org_unit_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->address_id = null;
        $this->company_id = null;
        $this->beat_id = null;
        $this->on_board_request_id = null;
        $this->status = null;
        $this->invested_amount = null;
        $this->outlet_org_code = null;
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
        } // if ($deep)

        $this->aOutletAddress = null;
        $this->aBrands = null;
        $this->aClassification = null;
        $this->aOutletTags = null;
        $this->aBeats = null;
        $this->aCompany = null;
        $this->aGeoCity = null;
        $this->aGeoState = null;
        $this->aGeoTowns = null;
        $this->aOnBoardRequest = null;
        $this->aOrgUnit = null;
        $this->aOutletOrgData = null;
        $this->aOutletType = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OnBoardRequestAddressTableMap::DEFAULT_STRING_FORMAT);
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

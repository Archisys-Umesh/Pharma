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
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\EdFeedbacks as ChildEdFeedbacks;
use entities\EdFeedbacksQuery as ChildEdFeedbacksQuery;
use entities\EdPresentations as ChildEdPresentations;
use entities\EdPresentationsQuery as ChildEdPresentationsQuery;
use entities\Language as ChildLanguage;
use entities\LanguageQuery as ChildLanguageQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\Map\EdFeedbacksTableMap;
use entities\Map\EdPresentationsTableMap;

/**
 * Base class that represents a row from the 'ed_presentations' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class EdPresentations implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\EdPresentationsTableMap';


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
     * The value for the presentation_id field.
     *
     * @var        int
     */
    protected $presentation_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the presentation_name field.
     *
     * @var        string|null
     */
    protected $presentation_name;

    /**
     * The value for the presentation_media field.
     *
     * @var        int|null
     */
    protected $presentation_media;

    /**
     * The value for the presentation_zip_url field.
     *
     * @var        string|null
     */
    protected $presentation_zip_url;

    /**
     * The value for the presentation_version_id field.
     *
     * @var        string|null
     */
    protected $presentation_version_id;

    /**
     * The value for the presentation_release_date field.
     *
     * @var        DateTime|null
     */
    protected $presentation_release_date;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

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
     * The value for the orgunit_id field.
     *
     * @var        int|null
     */
    protected $orgunit_id;

    /**
     * The value for the page_count field.
     *
     * @var        string|null
     */
    protected $page_count;

    /**
     * The value for the file_size field.
     *
     * @var        string|null
     */
    protected $file_size;

    /**
     * The value for the presentation_language_id field.
     *
     * @var        int|null
     */
    protected $presentation_language_id;

    /**
     * The value for the media_url field.
     *
     * @var        string|null
     */
    protected $media_url;

    /**
     * The value for the presentation_type_name field.
     *
     * @var        string|null
     */
    protected $presentation_type_name;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildLanguage
     */
    protected $aLanguage;

    /**
     * @var        ObjectCollection|ChildEdFeedbacks[] Collection to store aggregation of ChildEdFeedbacks objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEdFeedbacks> Collection to store aggregation of ChildEdFeedbacks objects.
     */
    protected $collEdFeedbackss;
    protected $collEdFeedbackssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEdFeedbacks[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEdFeedbacks>
     */
    protected $edFeedbackssScheduledForDeletion = null;

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
     * Initializes internal state of entities\Base\EdPresentations object.
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
     * Compares this with another <code>EdPresentations</code> instance.  If
     * <code>obj</code> is an instance of <code>EdPresentations</code>, delegates to
     * <code>equals(EdPresentations)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [presentation_id] column value.
     *
     * @return int
     */
    public function getPresentationId()
    {
        return $this->presentation_id;
    }

    /**
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [presentation_name] column value.
     *
     * @return string|null
     */
    public function getPresentationName()
    {
        return $this->presentation_name;
    }

    /**
     * Get the [presentation_media] column value.
     *
     * @return int|null
     */
    public function getPresentationMedia()
    {
        return $this->presentation_media;
    }

    /**
     * Get the [presentation_zip_url] column value.
     *
     * @return string|null
     */
    public function getPresentationZipUrl()
    {
        return $this->presentation_zip_url;
    }

    /**
     * Get the [presentation_version_id] column value.
     *
     * @return string|null
     */
    public function getPresentationVersionId()
    {
        return $this->presentation_version_id;
    }

    /**
     * Get the [optionally formatted] temporal [presentation_release_date] column value.
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
    public function getPresentationReleaseDate($format = null)
    {
        if ($format === null) {
            return $this->presentation_release_date;
        } else {
            return $this->presentation_release_date instanceof \DateTimeInterface ? $this->presentation_release_date->format($format) : null;
        }
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
     * Get the [orgunit_id] column value.
     *
     * @return int|null
     */
    public function getOrgunitId()
    {
        return $this->orgunit_id;
    }

    /**
     * Get the [page_count] column value.
     *
     * @return string|null
     */
    public function getPageCount()
    {
        return $this->page_count;
    }

    /**
     * Get the [file_size] column value.
     *
     * @return string|null
     */
    public function getFileSize()
    {
        return $this->file_size;
    }

    /**
     * Get the [presentation_language_id] column value.
     *
     * @return int|null
     */
    public function getPresentationLanguageId()
    {
        return $this->presentation_language_id;
    }

    /**
     * Get the [media_url] column value.
     *
     * @return string|null
     */
    public function getMediaUrl()
    {
        return $this->media_url;
    }

    /**
     * Get the [presentation_type_name] column value.
     *
     * @return string|null
     */
    public function getPresentationTypeName()
    {
        return $this->presentation_type_name;
    }

    /**
     * Set the value of [presentation_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->presentation_id !== $v) {
            $this->presentation_id = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation_name !== $v) {
            $this->presentation_name = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_media] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationMedia($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->presentation_media !== $v) {
            $this->presentation_media = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_MEDIA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_zip_url] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationZipUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation_zip_url !== $v) {
            $this->presentation_zip_url = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_version_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationVersionId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation_version_id !== $v) {
            $this->presentation_version_id = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [presentation_release_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationReleaseDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->presentation_release_date !== null || $dt !== null) {
            if ($this->presentation_release_date === null || $dt === null || $dt->format("Y-m-d") !== $this->presentation_release_date->format("Y-m-d")) {
                $this->presentation_release_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[EdPresentationsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
                $this->modifiedColumns[EdPresentationsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[EdPresentationsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [orgunit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunit_id !== $v) {
            $this->orgunit_id = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_ORGUNIT_ID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
        }

        return $this;
    }

    /**
     * Set the value of [page_count] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPageCount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->page_count !== $v) {
            $this->page_count = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PAGE_COUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [file_size] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFileSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_size !== $v) {
            $this->file_size = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_FILE_SIZE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_language_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationLanguageId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->presentation_language_id !== $v) {
            $this->presentation_language_id = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID] = true;
        }

        if ($this->aLanguage !== null && $this->aLanguage->getLanguageId() !== $v) {
            $this->aLanguage = null;
        }

        return $this;
    }

    /**
     * Set the value of [media_url] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_url !== $v) {
            $this->media_url = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_MEDIA_URL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_type_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationTypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation_type_name !== $v) {
            $this->presentation_type_name = $v;
            $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EdPresentationsTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_media = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationZipUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_zip_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationVersionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_version_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationReleaseDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_release_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EdPresentationsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EdPresentationsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EdPresentationsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EdPresentationsTableMap::translateFieldName('OrgunitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EdPresentationsTableMap::translateFieldName('PageCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->page_count = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EdPresentationsTableMap::translateFieldName('FileSize', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_size = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationLanguageId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_language_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EdPresentationsTableMap::translateFieldName('MediaUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EdPresentationsTableMap::translateFieldName('PresentationTypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_type_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = EdPresentationsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\EdPresentations'), 0, $e);
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
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOrgUnit !== null && $this->orgunit_id !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
        }
        if ($this->aLanguage !== null && $this->presentation_language_id !== $this->aLanguage->getLanguageId()) {
            $this->aLanguage = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEdPresentationsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBrands = null;
            $this->aCompany = null;
            $this->aOrgUnit = null;
            $this->aLanguage = null;
            $this->collEdFeedbackss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see EdPresentations::setDeleted()
     * @see EdPresentations::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEdPresentationsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
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
                EdPresentationsTableMap::addInstanceToPool($this);
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

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aLanguage !== null) {
                if ($this->aLanguage->isModified() || $this->aLanguage->isNew()) {
                    $affectedRows += $this->aLanguage->save($con);
                }
                $this->setLanguage($this->aLanguage);
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

            if ($this->edFeedbackssScheduledForDeletion !== null) {
                if (!$this->edFeedbackssScheduledForDeletion->isEmpty()) {
                    foreach ($this->edFeedbackssScheduledForDeletion as $edFeedbacks) {
                        // need to save related object because we set the relation to null
                        $edFeedbacks->save($con);
                    }
                    $this->edFeedbackssScheduledForDeletion = null;
                }
            }

            if ($this->collEdFeedbackss !== null) {
                foreach ($this->collEdFeedbackss as $referrerFK) {
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

        $this->modifiedColumns[EdPresentationsTableMap::COL_PRESENTATION_ID] = true;
        if (null !== $this->presentation_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EdPresentationsTableMap::COL_PRESENTATION_ID . ')');
        }
        if (null === $this->presentation_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('ed_presentations_presentation_id_seq')");
                $this->presentation_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_name';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_media';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_zip_url';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_version_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_release_date';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_ORGUNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunit_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PAGE_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'page_count';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_FILE_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'file_size';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_language_id';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_MEDIA_URL)) {
            $modifiedColumns[':p' . $index++]  = 'media_url';
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_type_name';
        }

        $sql = sprintf(
            'INSERT INTO ed_presentations (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'presentation_id':
                        $stmt->bindValue($identifier, $this->presentation_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'presentation_name':
                        $stmt->bindValue($identifier, $this->presentation_name, PDO::PARAM_STR);

                        break;
                    case 'presentation_media':
                        $stmt->bindValue($identifier, $this->presentation_media, PDO::PARAM_INT);

                        break;
                    case 'presentation_zip_url':
                        $stmt->bindValue($identifier, $this->presentation_zip_url, PDO::PARAM_STR);

                        break;
                    case 'presentation_version_id':
                        $stmt->bindValue($identifier, $this->presentation_version_id, PDO::PARAM_STR);

                        break;
                    case 'presentation_release_date':
                        $stmt->bindValue($identifier, $this->presentation_release_date ? $this->presentation_release_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'orgunit_id':
                        $stmt->bindValue($identifier, $this->orgunit_id, PDO::PARAM_INT);

                        break;
                    case 'page_count':
                        $stmt->bindValue($identifier, $this->page_count, PDO::PARAM_STR);

                        break;
                    case 'file_size':
                        $stmt->bindValue($identifier, $this->file_size, PDO::PARAM_STR);

                        break;
                    case 'presentation_language_id':
                        $stmt->bindValue($identifier, $this->presentation_language_id, PDO::PARAM_INT);

                        break;
                    case 'media_url':
                        $stmt->bindValue($identifier, $this->media_url, PDO::PARAM_STR);

                        break;
                    case 'presentation_type_name':
                        $stmt->bindValue($identifier, $this->presentation_type_name, PDO::PARAM_STR);

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
        $pos = EdPresentationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPresentationId();

            case 1:
                return $this->getBrandId();

            case 2:
                return $this->getPresentationName();

            case 3:
                return $this->getPresentationMedia();

            case 4:
                return $this->getPresentationZipUrl();

            case 5:
                return $this->getPresentationVersionId();

            case 6:
                return $this->getPresentationReleaseDate();

            case 7:
                return $this->getCompanyId();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getOrgunitId();

            case 11:
                return $this->getPageCount();

            case 12:
                return $this->getFileSize();

            case 13:
                return $this->getPresentationLanguageId();

            case 14:
                return $this->getMediaUrl();

            case 15:
                return $this->getPresentationTypeName();

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
        if (isset($alreadyDumpedObjects['EdPresentations'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['EdPresentations'][$this->hashCode()] = true;
        $keys = EdPresentationsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getPresentationId(),
            $keys[1] => $this->getBrandId(),
            $keys[2] => $this->getPresentationName(),
            $keys[3] => $this->getPresentationMedia(),
            $keys[4] => $this->getPresentationZipUrl(),
            $keys[5] => $this->getPresentationVersionId(),
            $keys[6] => $this->getPresentationReleaseDate(),
            $keys[7] => $this->getCompanyId(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getOrgunitId(),
            $keys[11] => $this->getPageCount(),
            $keys[12] => $this->getFileSize(),
            $keys[13] => $this->getPresentationLanguageId(),
            $keys[14] => $this->getMediaUrl(),
            $keys[15] => $this->getPresentationTypeName(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aLanguage) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'language';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'language';
                        break;
                    default:
                        $key = 'Language';
                }

                $result[$key] = $this->aLanguage->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEdFeedbackss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'edFeedbackss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ed_feedbackss';
                        break;
                    default:
                        $key = 'EdFeedbackss';
                }

                $result[$key] = $this->collEdFeedbackss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = EdPresentationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPresentationId($value);
                break;
            case 1:
                $this->setBrandId($value);
                break;
            case 2:
                $this->setPresentationName($value);
                break;
            case 3:
                $this->setPresentationMedia($value);
                break;
            case 4:
                $this->setPresentationZipUrl($value);
                break;
            case 5:
                $this->setPresentationVersionId($value);
                break;
            case 6:
                $this->setPresentationReleaseDate($value);
                break;
            case 7:
                $this->setCompanyId($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setOrgunitId($value);
                break;
            case 11:
                $this->setPageCount($value);
                break;
            case 12:
                $this->setFileSize($value);
                break;
            case 13:
                $this->setPresentationLanguageId($value);
                break;
            case 14:
                $this->setMediaUrl($value);
                break;
            case 15:
                $this->setPresentationTypeName($value);
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
        $keys = EdPresentationsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPresentationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBrandId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPresentationName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPresentationMedia($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPresentationZipUrl($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPresentationVersionId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPresentationReleaseDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompanyId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOrgunitId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPageCount($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setFileSize($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPresentationLanguageId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMediaUrl($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPresentationTypeName($arr[$keys[15]]);
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
        $criteria = new Criteria(EdPresentationsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_ID, $this->presentation_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_BRAND_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_NAME)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_NAME, $this->presentation_name);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_MEDIA)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_MEDIA, $this->presentation_media);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL, $this->presentation_zip_url);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID, $this->presentation_version_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE, $this->presentation_release_date);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_COMPANY_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_CREATED_AT)) {
            $criteria->add(EdPresentationsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_UPDATED_AT)) {
            $criteria->add(EdPresentationsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_ORGUNIT_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_ORGUNIT_ID, $this->orgunit_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PAGE_COUNT)) {
            $criteria->add(EdPresentationsTableMap::COL_PAGE_COUNT, $this->page_count);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_FILE_SIZE)) {
            $criteria->add(EdPresentationsTableMap::COL_FILE_SIZE, $this->file_size);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, $this->presentation_language_id);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_MEDIA_URL)) {
            $criteria->add(EdPresentationsTableMap::COL_MEDIA_URL, $this->media_url);
        }
        if ($this->isColumnModified(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME)) {
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME, $this->presentation_type_name);
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
        $criteria = ChildEdPresentationsQuery::create();
        $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_ID, $this->presentation_id);

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
        $validPk = null !== $this->getPresentationId();

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
        return $this->getPresentationId();
    }

    /**
     * Generic method to set the primary key (presentation_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setPresentationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getPresentationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\EdPresentations (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setPresentationName($this->getPresentationName());
        $copyObj->setPresentationMedia($this->getPresentationMedia());
        $copyObj->setPresentationZipUrl($this->getPresentationZipUrl());
        $copyObj->setPresentationVersionId($this->getPresentationVersionId());
        $copyObj->setPresentationReleaseDate($this->getPresentationReleaseDate());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOrgunitId($this->getOrgunitId());
        $copyObj->setPageCount($this->getPageCount());
        $copyObj->setFileSize($this->getFileSize());
        $copyObj->setPresentationLanguageId($this->getPresentationLanguageId());
        $copyObj->setMediaUrl($this->getMediaUrl());
        $copyObj->setPresentationTypeName($this->getPresentationTypeName());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEdFeedbackss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEdFeedbacks($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPresentationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\EdPresentations Clone of current object.
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
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setBrandId(NULL);
        } else {
            $this->setBrandId($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addEdPresentations($this);
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
        if ($this->aBrands === null && ($this->brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addEdPresentationss($this);
             */
        }

        return $this->aBrands;
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
            $v->addEdPresentations($this);
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
                $this->aCompany->addEdPresentationss($this);
             */
        }

        return $this->aCompany;
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
            $this->setOrgunitId(NULL);
        } else {
            $this->setOrgunitId($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addEdPresentations($this);
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
        if ($this->aOrgUnit === null && ($this->orgunit_id != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->orgunit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addEdPresentationss($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildLanguage object.
     *
     * @param ChildLanguage|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLanguage(ChildLanguage $v = null)
    {
        if ($v === null) {
            $this->setPresentationLanguageId(NULL);
        } else {
            $this->setPresentationLanguageId($v->getLanguageId());
        }

        $this->aLanguage = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLanguage object, it will not be re-added.
        if ($v !== null) {
            $v->addEdPresentations($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLanguage object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildLanguage|null The associated ChildLanguage object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLanguage(?ConnectionInterface $con = null)
    {
        if ($this->aLanguage === null && ($this->presentation_language_id != 0)) {
            $this->aLanguage = ChildLanguageQuery::create()->findPk($this->presentation_language_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguage->addEdPresentationss($this);
             */
        }

        return $this->aLanguage;
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
        if ('EdFeedbacks' === $relationName) {
            $this->initEdFeedbackss();
            return;
        }
    }

    /**
     * Clears out the collEdFeedbackss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEdFeedbackss()
     */
    public function clearEdFeedbackss()
    {
        $this->collEdFeedbackss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEdFeedbackss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEdFeedbackss($v = true): void
    {
        $this->collEdFeedbackssPartial = $v;
    }

    /**
     * Initializes the collEdFeedbackss collection.
     *
     * By default this just sets the collEdFeedbackss collection to an empty array (like clearcollEdFeedbackss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEdFeedbackss(bool $overrideExisting = true): void
    {
        if (null !== $this->collEdFeedbackss && !$overrideExisting) {
            return;
        }

        $collectionClassName = EdFeedbacksTableMap::getTableMap()->getCollectionClassName();

        $this->collEdFeedbackss = new $collectionClassName;
        $this->collEdFeedbackss->setModel('\entities\EdFeedbacks');
    }

    /**
     * Gets an array of ChildEdFeedbacks objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildEdPresentations is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks> List of ChildEdFeedbacks objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEdFeedbackss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEdFeedbackssPartial && !$this->isNew();
        if (null === $this->collEdFeedbackss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEdFeedbackss) {
                    $this->initEdFeedbackss();
                } else {
                    $collectionClassName = EdFeedbacksTableMap::getTableMap()->getCollectionClassName();

                    $collEdFeedbackss = new $collectionClassName;
                    $collEdFeedbackss->setModel('\entities\EdFeedbacks');

                    return $collEdFeedbackss;
                }
            } else {
                $collEdFeedbackss = ChildEdFeedbacksQuery::create(null, $criteria)
                    ->filterByEdPresentations($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEdFeedbackssPartial && count($collEdFeedbackss)) {
                        $this->initEdFeedbackss(false);

                        foreach ($collEdFeedbackss as $obj) {
                            if (false == $this->collEdFeedbackss->contains($obj)) {
                                $this->collEdFeedbackss->append($obj);
                            }
                        }

                        $this->collEdFeedbackssPartial = true;
                    }

                    return $collEdFeedbackss;
                }

                if ($partial && $this->collEdFeedbackss) {
                    foreach ($this->collEdFeedbackss as $obj) {
                        if ($obj->isNew()) {
                            $collEdFeedbackss[] = $obj;
                        }
                    }
                }

                $this->collEdFeedbackss = $collEdFeedbackss;
                $this->collEdFeedbackssPartial = false;
            }
        }

        return $this->collEdFeedbackss;
    }

    /**
     * Sets a collection of ChildEdFeedbacks objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $edFeedbackss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEdFeedbackss(Collection $edFeedbackss, ?ConnectionInterface $con = null)
    {
        /** @var ChildEdFeedbacks[] $edFeedbackssToDelete */
        $edFeedbackssToDelete = $this->getEdFeedbackss(new Criteria(), $con)->diff($edFeedbackss);


        $this->edFeedbackssScheduledForDeletion = $edFeedbackssToDelete;

        foreach ($edFeedbackssToDelete as $edFeedbacksRemoved) {
            $edFeedbacksRemoved->setEdPresentations(null);
        }

        $this->collEdFeedbackss = null;
        foreach ($edFeedbackss as $edFeedbacks) {
            $this->addEdFeedbacks($edFeedbacks);
        }

        $this->collEdFeedbackss = $edFeedbackss;
        $this->collEdFeedbackssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EdFeedbacks objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EdFeedbacks objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEdFeedbackss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEdFeedbackssPartial && !$this->isNew();
        if (null === $this->collEdFeedbackss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEdFeedbackss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEdFeedbackss());
            }

            $query = ChildEdFeedbacksQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEdPresentations($this)
                ->count($con);
        }

        return count($this->collEdFeedbackss);
    }

    /**
     * Method called to associate a ChildEdFeedbacks object to this object
     * through the ChildEdFeedbacks foreign key attribute.
     *
     * @param ChildEdFeedbacks $l ChildEdFeedbacks
     * @return $this The current object (for fluent API support)
     */
    public function addEdFeedbacks(ChildEdFeedbacks $l)
    {
        if ($this->collEdFeedbackss === null) {
            $this->initEdFeedbackss();
            $this->collEdFeedbackssPartial = true;
        }

        if (!$this->collEdFeedbackss->contains($l)) {
            $this->doAddEdFeedbacks($l);

            if ($this->edFeedbackssScheduledForDeletion and $this->edFeedbackssScheduledForDeletion->contains($l)) {
                $this->edFeedbackssScheduledForDeletion->remove($this->edFeedbackssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEdFeedbacks $edFeedbacks The ChildEdFeedbacks object to add.
     */
    protected function doAddEdFeedbacks(ChildEdFeedbacks $edFeedbacks): void
    {
        $this->collEdFeedbackss[]= $edFeedbacks;
        $edFeedbacks->setEdPresentations($this);
    }

    /**
     * @param ChildEdFeedbacks $edFeedbacks The ChildEdFeedbacks object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEdFeedbacks(ChildEdFeedbacks $edFeedbacks)
    {
        if ($this->getEdFeedbackss()->contains($edFeedbacks)) {
            $pos = $this->collEdFeedbackss->search($edFeedbacks);
            $this->collEdFeedbackss->remove($pos);
            if (null === $this->edFeedbackssScheduledForDeletion) {
                $this->edFeedbackssScheduledForDeletion = clone $this->collEdFeedbackss;
                $this->edFeedbackssScheduledForDeletion->clear();
            }
            $this->edFeedbackssScheduledForDeletion[]= $edFeedbacks;
            $edFeedbacks->setEdPresentations(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this EdPresentations is new, it will return
     * an empty collection; or if this EdPresentations has previously
     * been saved, it will retrieve related EdFeedbackss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in EdPresentations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks}> List of ChildEdFeedbacks objects
     */
    public function getEdFeedbackssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdFeedbacksQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getEdFeedbackss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this EdPresentations is new, it will return
     * an empty collection; or if this EdPresentations has previously
     * been saved, it will retrieve related EdFeedbackss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in EdPresentations.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildEdFeedbacks[] List of ChildEdFeedbacks objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEdFeedbacks}> List of ChildEdFeedbacks objects
     */
    public function getEdFeedbackssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildEdFeedbacksQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getEdFeedbackss($query, $con);
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
        if (null !== $this->aBrands) {
            $this->aBrands->removeEdPresentations($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeEdPresentations($this);
        }
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeEdPresentations($this);
        }
        if (null !== $this->aLanguage) {
            $this->aLanguage->removeEdPresentations($this);
        }
        $this->presentation_id = null;
        $this->brand_id = null;
        $this->presentation_name = null;
        $this->presentation_media = null;
        $this->presentation_zip_url = null;
        $this->presentation_version_id = null;
        $this->presentation_release_date = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->orgunit_id = null;
        $this->page_count = null;
        $this->file_size = null;
        $this->presentation_language_id = null;
        $this->media_url = null;
        $this->presentation_type_name = null;
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
            if ($this->collEdFeedbackss) {
                foreach ($this->collEdFeedbackss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEdFeedbackss = null;
        $this->aBrands = null;
        $this->aCompany = null;
        $this->aOrgUnit = null;
        $this->aLanguage = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EdPresentationsTableMap::DEFAULT_STRING_FORMAT);
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

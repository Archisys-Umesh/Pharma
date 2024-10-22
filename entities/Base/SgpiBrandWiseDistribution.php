<?php

namespace entities\Base;

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
use entities\Map\SgpiBrandWiseDistributionTableMap;

/**
 * Base class that represents a row from the 'sgpi_brand_wise_distribution' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class SgpiBrandWiseDistribution implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\SgpiBrandWiseDistributionTableMap';


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
     * The value for the sgpimap_id field.
     *
     * @var        int|null
     */
    protected $sgpimap_id;

    /**
     * The value for the org_data_id field.
     *
     * @var        int|null
     */
    protected $org_data_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the sgpi_status field.
     *
     * @var        string|null
     */
    protected $sgpi_status;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the created_at field.
     *
     * @var        string|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        string|null
     */
    protected $updated_at;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the position_name field.
     *
     * @var        string|null
     */
    protected $position_name;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

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
     * The value for the org_potential field.
     *
     * @var        string|null
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
     * The value for the itownid field.
     *
     * @var        int|null
     */
    protected $itownid;

    /**
     * The value for the outlet_city field.
     *
     * @var        string|null
     */
    protected $outlet_city;

    /**
     * The value for the classification field.
     *
     * @var        string|null
     */
    protected $classification;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\SgpiBrandWiseDistribution object.
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
     * Compares this with another <code>SgpiBrandWiseDistribution</code> instance.  If
     * <code>obj</code> is an instance of <code>SgpiBrandWiseDistribution</code>, delegates to
     * <code>equals(SgpiBrandWiseDistribution)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [sgpimap_id] column value.
     *
     * @return int|null
     */
    public function getSgpiVoucherId()
    {
        return $this->sgpimap_id;
    }

    /**
     * Get the [org_data_id] column value.
     *
     * @return int|null
     */
    public function getOrgDataId()
    {
        return $this->org_data_id;
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
     * Get the [sgpi_status] column value.
     *
     * @return string|null
     */
    public function getSgpiStatus()
    {
        return $this->sgpi_status;
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
     * Get the [created_at] column value.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the [updated_at] column value.
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
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
     * Get the [position_name] column value.
     *
     * @return string|null
     */
    public function getPositionName()
    {
        return $this->position_name;
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
     * Get the [org_potential] column value.
     *
     * @return string|null
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
    public function getOutletId()
    {
        return $this->id;
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
     * Get the [itownid] column value.
     *
     * @return int|null
     */
    public function getItownid()
    {
        return $this->itownid;
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
     * Get the [classification] column value.
     *
     * @return string|null
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Get the [brand_name] column value.
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Set the value of [sgpimap_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiVoucherId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpimap_id !== $v) {
            $this->sgpimap_id = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_data_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_data_id !== $v) {
            $this->org_data_id = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_BRAND_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_status !== $v) {
            $this->sgpi_status = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [created_at] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCreatedAt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->created_at !== $v) {
            $this->created_at = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_CREATED_AT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [updated_at] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUpdatedAt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->updated_at !== $v) {
            $this->updated_at = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_POSITION_ID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_BEAT_ID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_potential] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgPotential($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->org_potential !== $v) {
            $this->org_potential = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_ID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_ITOWNID] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY] = true;
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
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_name !== $v) {
            $this->brand_name = $v;
            $this->modifiedColumns[SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpimap_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('SgpiStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('PositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OrgPotential', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_potential = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('BrandFocus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_focus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('CustomerFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_fq = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('OutletCity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('Classification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : SgpiBrandWiseDistributionTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 26; // 26 = SgpiBrandWiseDistributionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\SgpiBrandWiseDistribution'), 0, $e);
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
        $pos = SgpiBrandWiseDistributionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSgpiVoucherId();

            case 1:
                return $this->getOrgDataId();

            case 2:
                return $this->getBrandId();

            case 3:
                return $this->getSgpiStatus();

            case 4:
                return $this->getCompanyId();

            case 5:
                return $this->getCreatedAt();

            case 6:
                return $this->getUpdatedAt();

            case 7:
                return $this->getTerritoryId();

            case 8:
                return $this->getTerritoryName();

            case 9:
                return $this->getPositionId();

            case 10:
                return $this->getPositionName();

            case 11:
                return $this->getBeatId();

            case 12:
                return $this->getBeatName();

            case 13:
                return $this->getTags();

            case 14:
                return $this->getOrgPotential();

            case 15:
                return $this->getBrandFocus();

            case 16:
                return $this->getCustomerFq();

            case 17:
                return $this->getOutletId();

            case 18:
                return $this->getOutletName();

            case 19:
                return $this->getOutletCode();

            case 20:
                return $this->getOutlettypeId();

            case 21:
                return $this->getOutlettypeName();

            case 22:
                return $this->getItownid();

            case 23:
                return $this->getOutletCity();

            case 24:
                return $this->getClassification();

            case 25:
                return $this->getBrandName();

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
        if (isset($alreadyDumpedObjects['SgpiBrandWiseDistribution'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SgpiBrandWiseDistribution'][$this->hashCode()] = true;
        $keys = SgpiBrandWiseDistributionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSgpiVoucherId(),
            $keys[1] => $this->getOrgDataId(),
            $keys[2] => $this->getBrandId(),
            $keys[3] => $this->getSgpiStatus(),
            $keys[4] => $this->getCompanyId(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
            $keys[7] => $this->getTerritoryId(),
            $keys[8] => $this->getTerritoryName(),
            $keys[9] => $this->getPositionId(),
            $keys[10] => $this->getPositionName(),
            $keys[11] => $this->getBeatId(),
            $keys[12] => $this->getBeatName(),
            $keys[13] => $this->getTags(),
            $keys[14] => $this->getOrgPotential(),
            $keys[15] => $this->getBrandFocus(),
            $keys[16] => $this->getCustomerFq(),
            $keys[17] => $this->getOutletId(),
            $keys[18] => $this->getOutletName(),
            $keys[19] => $this->getOutletCode(),
            $keys[20] => $this->getOutlettypeId(),
            $keys[21] => $this->getOutlettypeName(),
            $keys[22] => $this->getItownid(),
            $keys[23] => $this->getOutletCity(),
            $keys[24] => $this->getClassification(),
            $keys[25] => $this->getBrandName(),
        ];
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
        $criteria = new Criteria(SgpiBrandWiseDistributionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID, $this->sgpimap_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID, $this->org_data_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS, $this->sgpi_status);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_CREATED_AT)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME, $this->position_name);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_TAGS)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL, $this->org_potential);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS, $this->brand_focus);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ, $this->customer_fq);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_ITOWNID)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY, $this->outlet_city);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION, $this->classification);
        }
        if ($this->isColumnModified(SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME)) {
            $criteria->add(SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME, $this->brand_name);
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
        throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return false;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\SgpiBrandWiseDistribution (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSgpiVoucherId($this->getSgpiVoucherId());
        $copyObj->setOrgDataId($this->getOrgDataId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setSgpiStatus($this->getSgpiStatus());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setPositionName($this->getPositionName());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setTags($this->getTags());
        $copyObj->setOrgPotential($this->getOrgPotential());
        $copyObj->setBrandFocus($this->getBrandFocus());
        $copyObj->setCustomerFq($this->getCustomerFq());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setOutletCity($this->getOutletCity());
        $copyObj->setClassification($this->getClassification());
        $copyObj->setBrandName($this->getBrandName());
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
     * @return \entities\SgpiBrandWiseDistribution Clone of current object.
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
        $this->sgpimap_id = null;
        $this->org_data_id = null;
        $this->brand_id = null;
        $this->sgpi_status = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->territory_id = null;
        $this->territory_name = null;
        $this->position_id = null;
        $this->position_name = null;
        $this->beat_id = null;
        $this->beat_name = null;
        $this->tags = null;
        $this->org_potential = null;
        $this->brand_focus = null;
        $this->customer_fq = null;
        $this->id = null;
        $this->outlet_name = null;
        $this->outlet_code = null;
        $this->outlettype_id = null;
        $this->outlettype_name = null;
        $this->itownid = null;
        $this->outlet_city = null;
        $this->classification = null;
        $this->brand_name = null;
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
        return (string) $this->exportTo(SgpiBrandWiseDistributionTableMap::DEFAULT_STRING_FORMAT);
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

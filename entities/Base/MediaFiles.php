<?php

namespace entities\Base;

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
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\CheckInMedia as ChildCheckInMedia;
use entities\CheckInMediaQuery as ChildCheckInMediaQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Gifts as ChildGifts;
use entities\GiftsQuery as ChildGiftsQuery;
use entities\MediaFiles as ChildMediaFiles;
use entities\MediaFilesQuery as ChildMediaFilesQuery;
use entities\MediaFolders as ChildMediaFolders;
use entities\MediaFoldersQuery as ChildMediaFoldersQuery;
use entities\Offers as ChildOffers;
use entities\OffersQuery as ChildOffersQuery;
use entities\OutletType as ChildOutletType;
use entities\OutletTypeQuery as ChildOutletTypeQuery;
use entities\Map\AgendatypesTableMap;
use entities\Map\CheckInMediaTableMap;
use entities\Map\GiftsTableMap;
use entities\Map\MediaFilesTableMap;
use entities\Map\OffersTableMap;
use entities\Map\OutletTypeTableMap;

/**
 * Base class that represents a row from the 'media_files' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class MediaFiles implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\MediaFilesTableMap';


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
     * The value for the media_id field.
     *
     * @var        int
     */
    protected $media_id;

    /**
     * The value for the media_name field.
     *
     * @var        string
     */
    protected $media_name;

    /**
     * The value for the media_mime field.
     *
     * @var        string
     */
    protected $media_mime;

    /**
     * The value for the media_data field.
     *
     * @var        string|null
     */
    protected $media_data;

    /**
     * The value for the folder_id field.
     *
     * @var        int|null
     */
    protected $folder_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the iss3file field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $iss3file;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildMediaFolders
     */
    protected $aMediaFolders;

    /**
     * @var        ObjectCollection|ChildAgendatypes[] Collection to store aggregation of ChildAgendatypes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAgendatypes> Collection to store aggregation of ChildAgendatypes objects.
     */
    protected $collAgendatypess;
    protected $collAgendatypessPartial;

    /**
     * @var        ObjectCollection|ChildCheckInMedia[] Collection to store aggregation of ChildCheckInMedia objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildCheckInMedia> Collection to store aggregation of ChildCheckInMedia objects.
     */
    protected $collCheckInMedias;
    protected $collCheckInMediasPartial;

    /**
     * @var        ObjectCollection|ChildGifts[] Collection to store aggregation of ChildGifts objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildGifts> Collection to store aggregation of ChildGifts objects.
     */
    protected $collGiftss;
    protected $collGiftssPartial;

    /**
     * @var        ObjectCollection|ChildOffers[] Collection to store aggregation of ChildOffers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers> Collection to store aggregation of ChildOffers objects.
     */
    protected $collOfferss;
    protected $collOfferssPartial;

    /**
     * @var        ObjectCollection|ChildOutletType[] Collection to store aggregation of ChildOutletType objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletType> Collection to store aggregation of ChildOutletType objects.
     */
    protected $collOutletTypes;
    protected $collOutletTypesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAgendatypes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAgendatypes>
     */
    protected $agendatypessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCheckInMedia[]
     * @phpstan-var ObjectCollection&\Traversable<ChildCheckInMedia>
     */
    protected $checkInMediasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGifts[]
     * @phpstan-var ObjectCollection&\Traversable<ChildGifts>
     */
    protected $giftssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOffers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOffers>
     */
    protected $offerssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOutletType[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOutletType>
     */
    protected $outletTypesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->iss3file = false;
    }

    /**
     * Initializes internal state of entities\Base\MediaFiles object.
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
     * Compares this with another <code>MediaFiles</code> instance.  If
     * <code>obj</code> is an instance of <code>MediaFiles</code>, delegates to
     * <code>equals(MediaFiles)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [media_id] column value.
     *
     * @return int
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Get the [media_name] column value.
     *
     * @return string
     */
    public function getMediaName()
    {
        return $this->media_name;
    }

    /**
     * Get the [media_mime] column value.
     *
     * @return string
     */
    public function getMediaMime()
    {
        return $this->media_mime;
    }

    /**
     * Get the [media_data] column value.
     *
     * @return string|null
     */
    public function getMediaData()
    {
        return $this->media_data;
    }

    /**
     * Get the [folder_id] column value.
     *
     * @return int|null
     */
    public function getFolderId()
    {
        return $this->folder_id;
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
     * Get the [iss3file] column value.
     *
     * @return boolean|null
     */
    public function getIss3file()
    {
        return $this->iss3file;
    }

    /**
     * Get the [iss3file] column value.
     *
     * @return boolean|null
     */
    public function isIss3file()
    {
        return $this->getIss3file();
    }

    /**
     * Set the value of [media_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->media_id !== $v) {
            $this->media_id = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [media_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_name !== $v) {
            $this->media_name = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_MEDIA_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [media_mime] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaMime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_mime !== $v) {
            $this->media_mime = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_MEDIA_MIME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [media_data] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMediaData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->media_data !== $v) {
            $this->media_data = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_MEDIA_DATA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [folder_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFolderId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->folder_id !== $v) {
            $this->folder_id = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_FOLDER_ID] = true;
        }

        if ($this->aMediaFolders !== null && $this->aMediaFolders->getFolderId() !== $v) {
            $this->aMediaFolders = null;
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
            $this->modifiedColumns[MediaFilesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [iss3file] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIss3file($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->iss3file !== $v) {
            $this->iss3file = $v;
            $this->modifiedColumns[MediaFilesTableMap::COL_ISS3FILE] = true;
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
            if ($this->iss3file !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MediaFilesTableMap::translateFieldName('MediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MediaFilesTableMap::translateFieldName('MediaName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MediaFilesTableMap::translateFieldName('MediaMime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_mime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MediaFilesTableMap::translateFieldName('MediaData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->media_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MediaFilesTableMap::translateFieldName('FolderId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->folder_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MediaFilesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MediaFilesTableMap::translateFieldName('Iss3file', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iss3file = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = MediaFilesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\MediaFiles'), 0, $e);
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
        if ($this->aMediaFolders !== null && $this->folder_id !== $this->aMediaFolders->getFolderId()) {
            $this->aMediaFolders = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildMediaFilesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aMediaFolders = null;
            $this->collAgendatypess = null;

            $this->collCheckInMedias = null;

            $this->collGiftss = null;

            $this->collOfferss = null;

            $this->collOutletTypes = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see MediaFiles::setDeleted()
     * @see MediaFiles::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildMediaFilesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(MediaFilesTableMap::DATABASE_NAME);
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
                MediaFilesTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aMediaFolders !== null) {
                if ($this->aMediaFolders->isModified() || $this->aMediaFolders->isNew()) {
                    $affectedRows += $this->aMediaFolders->save($con);
                }
                $this->setMediaFolders($this->aMediaFolders);
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

            if ($this->agendatypessScheduledForDeletion !== null) {
                if (!$this->agendatypessScheduledForDeletion->isEmpty()) {
                    foreach ($this->agendatypessScheduledForDeletion as $agendatypes) {
                        // need to save related object because we set the relation to null
                        $agendatypes->save($con);
                    }
                    $this->agendatypessScheduledForDeletion = null;
                }
            }

            if ($this->collAgendatypess !== null) {
                foreach ($this->collAgendatypess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->checkInMediasScheduledForDeletion !== null) {
                if (!$this->checkInMediasScheduledForDeletion->isEmpty()) {
                    \entities\CheckInMediaQuery::create()
                        ->filterByPrimaryKeys($this->checkInMediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->checkInMediasScheduledForDeletion = null;
                }
            }

            if ($this->collCheckInMedias !== null) {
                foreach ($this->collCheckInMedias as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->giftssScheduledForDeletion !== null) {
                if (!$this->giftssScheduledForDeletion->isEmpty()) {
                    foreach ($this->giftssScheduledForDeletion as $gifts) {
                        // need to save related object because we set the relation to null
                        $gifts->save($con);
                    }
                    $this->giftssScheduledForDeletion = null;
                }
            }

            if ($this->collGiftss !== null) {
                foreach ($this->collGiftss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->offerssScheduledForDeletion !== null) {
                if (!$this->offerssScheduledForDeletion->isEmpty()) {
                    foreach ($this->offerssScheduledForDeletion as $offers) {
                        // need to save related object because we set the relation to null
                        $offers->save($con);
                    }
                    $this->offerssScheduledForDeletion = null;
                }
            }

            if ($this->collOfferss !== null) {
                foreach ($this->collOfferss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->outletTypesScheduledForDeletion !== null) {
                if (!$this->outletTypesScheduledForDeletion->isEmpty()) {
                    foreach ($this->outletTypesScheduledForDeletion as $outletType) {
                        // need to save related object because we set the relation to null
                        $outletType->save($con);
                    }
                    $this->outletTypesScheduledForDeletion = null;
                }
            }

            if ($this->collOutletTypes !== null) {
                foreach ($this->collOutletTypes as $referrerFK) {
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

        $this->modifiedColumns[MediaFilesTableMap::COL_MEDIA_ID] = true;
        if (null !== $this->media_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MediaFilesTableMap::COL_MEDIA_ID . ')');
        }
        if (null === $this->media_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('media_files_media_id_seq')");
                $this->media_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'media_id';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'media_name';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_MIME)) {
            $modifiedColumns[':p' . $index++]  = 'media_mime';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'media_data';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_FOLDER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'folder_id';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_ISS3FILE)) {
            $modifiedColumns[':p' . $index++]  = 'iss3file';
        }

        $sql = sprintf(
            'INSERT INTO media_files (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'media_id':
                        $stmt->bindValue($identifier, $this->media_id, PDO::PARAM_INT);

                        break;
                    case 'media_name':
                        $stmt->bindValue($identifier, $this->media_name, PDO::PARAM_STR);

                        break;
                    case 'media_mime':
                        $stmt->bindValue($identifier, $this->media_mime, PDO::PARAM_STR);

                        break;
                    case 'media_data':
                        $stmt->bindValue($identifier, $this->media_data, PDO::PARAM_STR);

                        break;
                    case 'folder_id':
                        $stmt->bindValue($identifier, $this->folder_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'iss3file':
                        $stmt->bindValue($identifier, $this->iss3file, PDO::PARAM_BOOL);

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
        $pos = MediaFilesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMediaId();

            case 1:
                return $this->getMediaName();

            case 2:
                return $this->getMediaMime();

            case 3:
                return $this->getMediaData();

            case 4:
                return $this->getFolderId();

            case 5:
                return $this->getCompanyId();

            case 6:
                return $this->getIss3file();

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
        if (isset($alreadyDumpedObjects['MediaFiles'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['MediaFiles'][$this->hashCode()] = true;
        $keys = MediaFilesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getMediaId(),
            $keys[1] => $this->getMediaName(),
            $keys[2] => $this->getMediaMime(),
            $keys[3] => $this->getMediaData(),
            $keys[4] => $this->getFolderId(),
            $keys[5] => $this->getCompanyId(),
            $keys[6] => $this->getIss3file(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aMediaFolders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mediaFolders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'media_folders';
                        break;
                    default:
                        $key = 'MediaFolders';
                }

                $result[$key] = $this->aMediaFolders->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAgendatypess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'agendatypess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'agendatypess';
                        break;
                    default:
                        $key = 'Agendatypess';
                }

                $result[$key] = $this->collAgendatypess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCheckInMedias) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'checkInMedias';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'check_in_medias';
                        break;
                    default:
                        $key = 'CheckInMedias';
                }

                $result[$key] = $this->collCheckInMedias->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGiftss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'giftss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'giftss';
                        break;
                    default:
                        $key = 'Giftss';
                }

                $result[$key] = $this->collGiftss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOfferss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'offerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'offerss';
                        break;
                    default:
                        $key = 'Offerss';
                }

                $result[$key] = $this->collOfferss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOutletTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_types';
                        break;
                    default:
                        $key = 'OutletTypes';
                }

                $result[$key] = $this->collOutletTypes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MediaFilesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setMediaId($value);
                break;
            case 1:
                $this->setMediaName($value);
                break;
            case 2:
                $this->setMediaMime($value);
                break;
            case 3:
                $this->setMediaData($value);
                break;
            case 4:
                $this->setFolderId($value);
                break;
            case 5:
                $this->setCompanyId($value);
                break;
            case 6:
                $this->setIss3file($value);
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
        $keys = MediaFilesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMediaId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setMediaName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setMediaMime($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMediaData($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFolderId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCompanyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIss3file($arr[$keys[6]]);
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
        $criteria = new Criteria(MediaFilesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_ID)) {
            $criteria->add(MediaFilesTableMap::COL_MEDIA_ID, $this->media_id);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_NAME)) {
            $criteria->add(MediaFilesTableMap::COL_MEDIA_NAME, $this->media_name);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_MIME)) {
            $criteria->add(MediaFilesTableMap::COL_MEDIA_MIME, $this->media_mime);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_MEDIA_DATA)) {
            $criteria->add(MediaFilesTableMap::COL_MEDIA_DATA, $this->media_data);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_FOLDER_ID)) {
            $criteria->add(MediaFilesTableMap::COL_FOLDER_ID, $this->folder_id);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_COMPANY_ID)) {
            $criteria->add(MediaFilesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(MediaFilesTableMap::COL_ISS3FILE)) {
            $criteria->add(MediaFilesTableMap::COL_ISS3FILE, $this->iss3file);
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
        $criteria = ChildMediaFilesQuery::create();
        $criteria->add(MediaFilesTableMap::COL_MEDIA_ID, $this->media_id);

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
        $validPk = null !== $this->getMediaId();

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
        return $this->getMediaId();
    }

    /**
     * Generic method to set the primary key (media_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setMediaId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getMediaId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\MediaFiles (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setMediaName($this->getMediaName());
        $copyObj->setMediaMime($this->getMediaMime());
        $copyObj->setMediaData($this->getMediaData());
        $copyObj->setFolderId($this->getFolderId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setIss3file($this->getIss3file());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAgendatypess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAgendatypes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCheckInMedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCheckInMedia($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGiftss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGifts($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOfferss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOffers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOutletTypes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOutletType($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMediaId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\MediaFiles Clone of current object.
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
            $v->addMediaFiles($this);
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
                $this->aCompany->addMediaFiless($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildMediaFolders object.
     *
     * @param ChildMediaFolders|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMediaFolders(ChildMediaFolders $v = null)
    {
        if ($v === null) {
            $this->setFolderId(NULL);
        } else {
            $this->setFolderId($v->getFolderId());
        }

        $this->aMediaFolders = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMediaFolders object, it will not be re-added.
        if ($v !== null) {
            $v->addMediaFiles($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMediaFolders object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildMediaFolders|null The associated ChildMediaFolders object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMediaFolders(?ConnectionInterface $con = null)
    {
        if ($this->aMediaFolders === null && ($this->folder_id != 0)) {
            $this->aMediaFolders = ChildMediaFoldersQuery::create()->findPk($this->folder_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMediaFolders->addMediaFiless($this);
             */
        }

        return $this->aMediaFolders;
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
        if ('Agendatypes' === $relationName) {
            $this->initAgendatypess();
            return;
        }
        if ('CheckInMedia' === $relationName) {
            $this->initCheckInMedias();
            return;
        }
        if ('Gifts' === $relationName) {
            $this->initGiftss();
            return;
        }
        if ('Offers' === $relationName) {
            $this->initOfferss();
            return;
        }
        if ('OutletType' === $relationName) {
            $this->initOutletTypes();
            return;
        }
    }

    /**
     * Clears out the collAgendatypess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAgendatypess()
     */
    public function clearAgendatypess()
    {
        $this->collAgendatypess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAgendatypess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAgendatypess($v = true): void
    {
        $this->collAgendatypessPartial = $v;
    }

    /**
     * Initializes the collAgendatypess collection.
     *
     * By default this just sets the collAgendatypess collection to an empty array (like clearcollAgendatypess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAgendatypess(bool $overrideExisting = true): void
    {
        if (null !== $this->collAgendatypess && !$overrideExisting) {
            return;
        }

        $collectionClassName = AgendatypesTableMap::getTableMap()->getCollectionClassName();

        $this->collAgendatypess = new $collectionClassName;
        $this->collAgendatypess->setModel('\entities\Agendatypes');
    }

    /**
     * Gets an array of ChildAgendatypes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMediaFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes> List of ChildAgendatypes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAgendatypess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAgendatypessPartial && !$this->isNew();
        if (null === $this->collAgendatypess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAgendatypess) {
                    $this->initAgendatypess();
                } else {
                    $collectionClassName = AgendatypesTableMap::getTableMap()->getCollectionClassName();

                    $collAgendatypess = new $collectionClassName;
                    $collAgendatypess->setModel('\entities\Agendatypes');

                    return $collAgendatypess;
                }
            } else {
                $collAgendatypess = ChildAgendatypesQuery::create(null, $criteria)
                    ->filterByMediaFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAgendatypessPartial && count($collAgendatypess)) {
                        $this->initAgendatypess(false);

                        foreach ($collAgendatypess as $obj) {
                            if (false == $this->collAgendatypess->contains($obj)) {
                                $this->collAgendatypess->append($obj);
                            }
                        }

                        $this->collAgendatypessPartial = true;
                    }

                    return $collAgendatypess;
                }

                if ($partial && $this->collAgendatypess) {
                    foreach ($this->collAgendatypess as $obj) {
                        if ($obj->isNew()) {
                            $collAgendatypess[] = $obj;
                        }
                    }
                }

                $this->collAgendatypess = $collAgendatypess;
                $this->collAgendatypessPartial = false;
            }
        }

        return $this->collAgendatypess;
    }

    /**
     * Sets a collection of ChildAgendatypes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $agendatypess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAgendatypess(Collection $agendatypess, ?ConnectionInterface $con = null)
    {
        /** @var ChildAgendatypes[] $agendatypessToDelete */
        $agendatypessToDelete = $this->getAgendatypess(new Criteria(), $con)->diff($agendatypess);


        $this->agendatypessScheduledForDeletion = $agendatypessToDelete;

        foreach ($agendatypessToDelete as $agendatypesRemoved) {
            $agendatypesRemoved->setMediaFiles(null);
        }

        $this->collAgendatypess = null;
        foreach ($agendatypess as $agendatypes) {
            $this->addAgendatypes($agendatypes);
        }

        $this->collAgendatypess = $agendatypess;
        $this->collAgendatypessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Agendatypes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Agendatypes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAgendatypess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAgendatypessPartial && !$this->isNew();
        if (null === $this->collAgendatypess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAgendatypess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAgendatypess());
            }

            $query = ChildAgendatypesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMediaFiles($this)
                ->count($con);
        }

        return count($this->collAgendatypess);
    }

    /**
     * Method called to associate a ChildAgendatypes object to this object
     * through the ChildAgendatypes foreign key attribute.
     *
     * @param ChildAgendatypes $l ChildAgendatypes
     * @return $this The current object (for fluent API support)
     */
    public function addAgendatypes(ChildAgendatypes $l)
    {
        if ($this->collAgendatypess === null) {
            $this->initAgendatypess();
            $this->collAgendatypessPartial = true;
        }

        if (!$this->collAgendatypess->contains($l)) {
            $this->doAddAgendatypes($l);

            if ($this->agendatypessScheduledForDeletion and $this->agendatypessScheduledForDeletion->contains($l)) {
                $this->agendatypessScheduledForDeletion->remove($this->agendatypessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAgendatypes $agendatypes The ChildAgendatypes object to add.
     */
    protected function doAddAgendatypes(ChildAgendatypes $agendatypes): void
    {
        $this->collAgendatypess[]= $agendatypes;
        $agendatypes->setMediaFiles($this);
    }

    /**
     * @param ChildAgendatypes $agendatypes The ChildAgendatypes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAgendatypes(ChildAgendatypes $agendatypes)
    {
        if ($this->getAgendatypess()->contains($agendatypes)) {
            $pos = $this->collAgendatypess->search($agendatypes);
            $this->collAgendatypess->remove($pos);
            if (null === $this->agendatypessScheduledForDeletion) {
                $this->agendatypessScheduledForDeletion = clone $this->collAgendatypess;
                $this->agendatypessScheduledForDeletion->clear();
            }
            $this->agendatypessScheduledForDeletion[]= $agendatypes;
            $agendatypes->setMediaFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Agendatypess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes}> List of ChildAgendatypes objects
     */
    public function getAgendatypessJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAgendatypesQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getAgendatypess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Agendatypess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAgendatypes[] List of ChildAgendatypes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAgendatypes}> List of ChildAgendatypes objects
     */
    public function getAgendatypessJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAgendatypesQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getAgendatypess($query, $con);
    }

    /**
     * Clears out the collCheckInMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCheckInMedias()
     */
    public function clearCheckInMedias()
    {
        $this->collCheckInMedias = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCheckInMedias collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCheckInMedias($v = true): void
    {
        $this->collCheckInMediasPartial = $v;
    }

    /**
     * Initializes the collCheckInMedias collection.
     *
     * By default this just sets the collCheckInMedias collection to an empty array (like clearcollCheckInMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCheckInMedias(bool $overrideExisting = true): void
    {
        if (null !== $this->collCheckInMedias && !$overrideExisting) {
            return;
        }

        $collectionClassName = CheckInMediaTableMap::getTableMap()->getCollectionClassName();

        $this->collCheckInMedias = new $collectionClassName;
        $this->collCheckInMedias->setModel('\entities\CheckInMedia');
    }

    /**
     * Gets an array of ChildCheckInMedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMediaFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCheckInMedia[] List of ChildCheckInMedia objects
     * @phpstan-return ObjectCollection&\Traversable<ChildCheckInMedia> List of ChildCheckInMedia objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCheckInMedias(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCheckInMediasPartial && !$this->isNew();
        if (null === $this->collCheckInMedias || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCheckInMedias) {
                    $this->initCheckInMedias();
                } else {
                    $collectionClassName = CheckInMediaTableMap::getTableMap()->getCollectionClassName();

                    $collCheckInMedias = new $collectionClassName;
                    $collCheckInMedias->setModel('\entities\CheckInMedia');

                    return $collCheckInMedias;
                }
            } else {
                $collCheckInMedias = ChildCheckInMediaQuery::create(null, $criteria)
                    ->filterByMediaFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCheckInMediasPartial && count($collCheckInMedias)) {
                        $this->initCheckInMedias(false);

                        foreach ($collCheckInMedias as $obj) {
                            if (false == $this->collCheckInMedias->contains($obj)) {
                                $this->collCheckInMedias->append($obj);
                            }
                        }

                        $this->collCheckInMediasPartial = true;
                    }

                    return $collCheckInMedias;
                }

                if ($partial && $this->collCheckInMedias) {
                    foreach ($this->collCheckInMedias as $obj) {
                        if ($obj->isNew()) {
                            $collCheckInMedias[] = $obj;
                        }
                    }
                }

                $this->collCheckInMedias = $collCheckInMedias;
                $this->collCheckInMediasPartial = false;
            }
        }

        return $this->collCheckInMedias;
    }

    /**
     * Sets a collection of ChildCheckInMedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $checkInMedias A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCheckInMedias(Collection $checkInMedias, ?ConnectionInterface $con = null)
    {
        /** @var ChildCheckInMedia[] $checkInMediasToDelete */
        $checkInMediasToDelete = $this->getCheckInMedias(new Criteria(), $con)->diff($checkInMedias);


        $this->checkInMediasScheduledForDeletion = $checkInMediasToDelete;

        foreach ($checkInMediasToDelete as $checkInMediaRemoved) {
            $checkInMediaRemoved->setMediaFiles(null);
        }

        $this->collCheckInMedias = null;
        foreach ($checkInMedias as $checkInMedia) {
            $this->addCheckInMedia($checkInMedia);
        }

        $this->collCheckInMedias = $checkInMedias;
        $this->collCheckInMediasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CheckInMedia objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related CheckInMedia objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCheckInMedias(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCheckInMediasPartial && !$this->isNew();
        if (null === $this->collCheckInMedias || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCheckInMedias) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCheckInMedias());
            }

            $query = ChildCheckInMediaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMediaFiles($this)
                ->count($con);
        }

        return count($this->collCheckInMedias);
    }

    /**
     * Method called to associate a ChildCheckInMedia object to this object
     * through the ChildCheckInMedia foreign key attribute.
     *
     * @param ChildCheckInMedia $l ChildCheckInMedia
     * @return $this The current object (for fluent API support)
     */
    public function addCheckInMedia(ChildCheckInMedia $l)
    {
        if ($this->collCheckInMedias === null) {
            $this->initCheckInMedias();
            $this->collCheckInMediasPartial = true;
        }

        if (!$this->collCheckInMedias->contains($l)) {
            $this->doAddCheckInMedia($l);

            if ($this->checkInMediasScheduledForDeletion and $this->checkInMediasScheduledForDeletion->contains($l)) {
                $this->checkInMediasScheduledForDeletion->remove($this->checkInMediasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCheckInMedia $checkInMedia The ChildCheckInMedia object to add.
     */
    protected function doAddCheckInMedia(ChildCheckInMedia $checkInMedia): void
    {
        $this->collCheckInMedias[]= $checkInMedia;
        $checkInMedia->setMediaFiles($this);
    }

    /**
     * @param ChildCheckInMedia $checkInMedia The ChildCheckInMedia object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCheckInMedia(ChildCheckInMedia $checkInMedia)
    {
        if ($this->getCheckInMedias()->contains($checkInMedia)) {
            $pos = $this->collCheckInMedias->search($checkInMedia);
            $this->collCheckInMedias->remove($pos);
            if (null === $this->checkInMediasScheduledForDeletion) {
                $this->checkInMediasScheduledForDeletion = clone $this->collCheckInMedias;
                $this->checkInMediasScheduledForDeletion->clear();
            }
            $this->checkInMediasScheduledForDeletion[]= clone $checkInMedia;
            $checkInMedia->setMediaFiles(null);
        }

        return $this;
    }

    /**
     * Clears out the collGiftss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addGiftss()
     */
    public function clearGiftss()
    {
        $this->collGiftss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collGiftss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialGiftss($v = true): void
    {
        $this->collGiftssPartial = $v;
    }

    /**
     * Initializes the collGiftss collection.
     *
     * By default this just sets the collGiftss collection to an empty array (like clearcollGiftss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGiftss(bool $overrideExisting = true): void
    {
        if (null !== $this->collGiftss && !$overrideExisting) {
            return;
        }

        $collectionClassName = GiftsTableMap::getTableMap()->getCollectionClassName();

        $this->collGiftss = new $collectionClassName;
        $this->collGiftss->setModel('\entities\Gifts');
    }

    /**
     * Gets an array of ChildGifts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMediaFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGifts[] List of ChildGifts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGifts> List of ChildGifts objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGiftss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collGiftssPartial && !$this->isNew();
        if (null === $this->collGiftss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collGiftss) {
                    $this->initGiftss();
                } else {
                    $collectionClassName = GiftsTableMap::getTableMap()->getCollectionClassName();

                    $collGiftss = new $collectionClassName;
                    $collGiftss->setModel('\entities\Gifts');

                    return $collGiftss;
                }
            } else {
                $collGiftss = ChildGiftsQuery::create(null, $criteria)
                    ->filterByMediaFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGiftssPartial && count($collGiftss)) {
                        $this->initGiftss(false);

                        foreach ($collGiftss as $obj) {
                            if (false == $this->collGiftss->contains($obj)) {
                                $this->collGiftss->append($obj);
                            }
                        }

                        $this->collGiftssPartial = true;
                    }

                    return $collGiftss;
                }

                if ($partial && $this->collGiftss) {
                    foreach ($this->collGiftss as $obj) {
                        if ($obj->isNew()) {
                            $collGiftss[] = $obj;
                        }
                    }
                }

                $this->collGiftss = $collGiftss;
                $this->collGiftssPartial = false;
            }
        }

        return $this->collGiftss;
    }

    /**
     * Sets a collection of ChildGifts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $giftss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setGiftss(Collection $giftss, ?ConnectionInterface $con = null)
    {
        /** @var ChildGifts[] $giftssToDelete */
        $giftssToDelete = $this->getGiftss(new Criteria(), $con)->diff($giftss);


        $this->giftssScheduledForDeletion = $giftssToDelete;

        foreach ($giftssToDelete as $giftsRemoved) {
            $giftsRemoved->setMediaFiles(null);
        }

        $this->collGiftss = null;
        foreach ($giftss as $gifts) {
            $this->addGifts($gifts);
        }

        $this->collGiftss = $giftss;
        $this->collGiftssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Gifts objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Gifts objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countGiftss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collGiftssPartial && !$this->isNew();
        if (null === $this->collGiftss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGiftss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGiftss());
            }

            $query = ChildGiftsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMediaFiles($this)
                ->count($con);
        }

        return count($this->collGiftss);
    }

    /**
     * Method called to associate a ChildGifts object to this object
     * through the ChildGifts foreign key attribute.
     *
     * @param ChildGifts $l ChildGifts
     * @return $this The current object (for fluent API support)
     */
    public function addGifts(ChildGifts $l)
    {
        if ($this->collGiftss === null) {
            $this->initGiftss();
            $this->collGiftssPartial = true;
        }

        if (!$this->collGiftss->contains($l)) {
            $this->doAddGifts($l);

            if ($this->giftssScheduledForDeletion and $this->giftssScheduledForDeletion->contains($l)) {
                $this->giftssScheduledForDeletion->remove($this->giftssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGifts $gifts The ChildGifts object to add.
     */
    protected function doAddGifts(ChildGifts $gifts): void
    {
        $this->collGiftss[]= $gifts;
        $gifts->setMediaFiles($this);
    }

    /**
     * @param ChildGifts $gifts The ChildGifts object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeGifts(ChildGifts $gifts)
    {
        if ($this->getGiftss()->contains($gifts)) {
            $pos = $this->collGiftss->search($gifts);
            $this->collGiftss->remove($pos);
            if (null === $this->giftssScheduledForDeletion) {
                $this->giftssScheduledForDeletion = clone $this->collGiftss;
                $this->giftssScheduledForDeletion->clear();
            }
            $this->giftssScheduledForDeletion[]= $gifts;
            $gifts->setMediaFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Giftss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGifts[] List of ChildGifts objects
     * @phpstan-return ObjectCollection&\Traversable<ChildGifts}> List of ChildGifts objects
     */
    public function getGiftssJoinOffers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGiftsQuery::create(null, $criteria);
        $query->joinWith('Offers', $joinBehavior);

        return $this->getGiftss($query, $con);
    }

    /**
     * Clears out the collOfferss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOfferss()
     */
    public function clearOfferss()
    {
        $this->collOfferss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOfferss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOfferss($v = true): void
    {
        $this->collOfferssPartial = $v;
    }

    /**
     * Initializes the collOfferss collection.
     *
     * By default this just sets the collOfferss collection to an empty array (like clearcollOfferss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOfferss(bool $overrideExisting = true): void
    {
        if (null !== $this->collOfferss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

        $this->collOfferss = new $collectionClassName;
        $this->collOfferss->setModel('\entities\Offers');
    }

    /**
     * Gets an array of ChildOffers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMediaFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers> List of ChildOffers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOfferss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOfferss) {
                    $this->initOfferss();
                } else {
                    $collectionClassName = OffersTableMap::getTableMap()->getCollectionClassName();

                    $collOfferss = new $collectionClassName;
                    $collOfferss->setModel('\entities\Offers');

                    return $collOfferss;
                }
            } else {
                $collOfferss = ChildOffersQuery::create(null, $criteria)
                    ->filterByMediaFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOfferssPartial && count($collOfferss)) {
                        $this->initOfferss(false);

                        foreach ($collOfferss as $obj) {
                            if (false == $this->collOfferss->contains($obj)) {
                                $this->collOfferss->append($obj);
                            }
                        }

                        $this->collOfferssPartial = true;
                    }

                    return $collOfferss;
                }

                if ($partial && $this->collOfferss) {
                    foreach ($this->collOfferss as $obj) {
                        if ($obj->isNew()) {
                            $collOfferss[] = $obj;
                        }
                    }
                }

                $this->collOfferss = $collOfferss;
                $this->collOfferssPartial = false;
            }
        }

        return $this->collOfferss;
    }

    /**
     * Sets a collection of ChildOffers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $offerss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOfferss(Collection $offerss, ?ConnectionInterface $con = null)
    {
        /** @var ChildOffers[] $offerssToDelete */
        $offerssToDelete = $this->getOfferss(new Criteria(), $con)->diff($offerss);


        $this->offerssScheduledForDeletion = $offerssToDelete;

        foreach ($offerssToDelete as $offersRemoved) {
            $offersRemoved->setMediaFiles(null);
        }

        $this->collOfferss = null;
        foreach ($offerss as $offers) {
            $this->addOffers($offers);
        }

        $this->collOfferss = $offerss;
        $this->collOfferssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Offers objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Offers objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOfferss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOfferssPartial && !$this->isNew();
        if (null === $this->collOfferss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOfferss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOfferss());
            }

            $query = ChildOffersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMediaFiles($this)
                ->count($con);
        }

        return count($this->collOfferss);
    }

    /**
     * Method called to associate a ChildOffers object to this object
     * through the ChildOffers foreign key attribute.
     *
     * @param ChildOffers $l ChildOffers
     * @return $this The current object (for fluent API support)
     */
    public function addOffers(ChildOffers $l)
    {
        if ($this->collOfferss === null) {
            $this->initOfferss();
            $this->collOfferssPartial = true;
        }

        if (!$this->collOfferss->contains($l)) {
            $this->doAddOffers($l);

            if ($this->offerssScheduledForDeletion and $this->offerssScheduledForDeletion->contains($l)) {
                $this->offerssScheduledForDeletion->remove($this->offerssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to add.
     */
    protected function doAddOffers(ChildOffers $offers): void
    {
        $this->collOfferss[]= $offers;
        $offers->setMediaFiles($this);
    }

    /**
     * @param ChildOffers $offers The ChildOffers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOffers(ChildOffers $offers)
    {
        if ($this->getOfferss()->contains($offers)) {
            $pos = $this->collOfferss->search($offers);
            $this->collOfferss->remove($pos);
            if (null === $this->offerssScheduledForDeletion) {
                $this->offerssScheduledForDeletion = clone $this->collOfferss;
                $this->offerssScheduledForDeletion->clear();
            }
            $this->offerssScheduledForDeletion[]= $offers;
            $offers->setMediaFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinOrgUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('OrgUnit', $joinBehavior);

        return $this->getOfferss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related Offerss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOffers[] List of ChildOffers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOffers}> List of ChildOffers objects
     */
    public function getOfferssJoinOutletType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOffersQuery::create(null, $criteria);
        $query->joinWith('OutletType', $joinBehavior);

        return $this->getOfferss($query, $con);
    }

    /**
     * Clears out the collOutletTypes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOutletTypes()
     */
    public function clearOutletTypes()
    {
        $this->collOutletTypes = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOutletTypes collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOutletTypes($v = true): void
    {
        $this->collOutletTypesPartial = $v;
    }

    /**
     * Initializes the collOutletTypes collection.
     *
     * By default this just sets the collOutletTypes collection to an empty array (like clearcollOutletTypes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOutletTypes(bool $overrideExisting = true): void
    {
        if (null !== $this->collOutletTypes && !$overrideExisting) {
            return;
        }

        $collectionClassName = OutletTypeTableMap::getTableMap()->getCollectionClassName();

        $this->collOutletTypes = new $collectionClassName;
        $this->collOutletTypes->setModel('\entities\OutletType');
    }

    /**
     * Gets an array of ChildOutletType objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMediaFiles is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOutletType[] List of ChildOutletType objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletType> List of ChildOutletType objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletTypes(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOutletTypesPartial && !$this->isNew();
        if (null === $this->collOutletTypes || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOutletTypes) {
                    $this->initOutletTypes();
                } else {
                    $collectionClassName = OutletTypeTableMap::getTableMap()->getCollectionClassName();

                    $collOutletTypes = new $collectionClassName;
                    $collOutletTypes->setModel('\entities\OutletType');

                    return $collOutletTypes;
                }
            } else {
                $collOutletTypes = ChildOutletTypeQuery::create(null, $criteria)
                    ->filterByMediaFiles($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOutletTypesPartial && count($collOutletTypes)) {
                        $this->initOutletTypes(false);

                        foreach ($collOutletTypes as $obj) {
                            if (false == $this->collOutletTypes->contains($obj)) {
                                $this->collOutletTypes->append($obj);
                            }
                        }

                        $this->collOutletTypesPartial = true;
                    }

                    return $collOutletTypes;
                }

                if ($partial && $this->collOutletTypes) {
                    foreach ($this->collOutletTypes as $obj) {
                        if ($obj->isNew()) {
                            $collOutletTypes[] = $obj;
                        }
                    }
                }

                $this->collOutletTypes = $collOutletTypes;
                $this->collOutletTypesPartial = false;
            }
        }

        return $this->collOutletTypes;
    }

    /**
     * Sets a collection of ChildOutletType objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $outletTypes A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOutletTypes(Collection $outletTypes, ?ConnectionInterface $con = null)
    {
        /** @var ChildOutletType[] $outletTypesToDelete */
        $outletTypesToDelete = $this->getOutletTypes(new Criteria(), $con)->diff($outletTypes);


        $this->outletTypesScheduledForDeletion = $outletTypesToDelete;

        foreach ($outletTypesToDelete as $outletTypeRemoved) {
            $outletTypeRemoved->setMediaFiles(null);
        }

        $this->collOutletTypes = null;
        foreach ($outletTypes as $outletType) {
            $this->addOutletType($outletType);
        }

        $this->collOutletTypes = $outletTypes;
        $this->collOutletTypesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OutletType objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OutletType objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOutletTypes(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOutletTypesPartial && !$this->isNew();
        if (null === $this->collOutletTypes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOutletTypes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOutletTypes());
            }

            $query = ChildOutletTypeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMediaFiles($this)
                ->count($con);
        }

        return count($this->collOutletTypes);
    }

    /**
     * Method called to associate a ChildOutletType object to this object
     * through the ChildOutletType foreign key attribute.
     *
     * @param ChildOutletType $l ChildOutletType
     * @return $this The current object (for fluent API support)
     */
    public function addOutletType(ChildOutletType $l)
    {
        if ($this->collOutletTypes === null) {
            $this->initOutletTypes();
            $this->collOutletTypesPartial = true;
        }

        if (!$this->collOutletTypes->contains($l)) {
            $this->doAddOutletType($l);

            if ($this->outletTypesScheduledForDeletion and $this->outletTypesScheduledForDeletion->contains($l)) {
                $this->outletTypesScheduledForDeletion->remove($this->outletTypesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOutletType $outletType The ChildOutletType object to add.
     */
    protected function doAddOutletType(ChildOutletType $outletType): void
    {
        $this->collOutletTypes[]= $outletType;
        $outletType->setMediaFiles($this);
    }

    /**
     * @param ChildOutletType $outletType The ChildOutletType object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOutletType(ChildOutletType $outletType)
    {
        if ($this->getOutletTypes()->contains($outletType)) {
            $pos = $this->collOutletTypes->search($outletType);
            $this->collOutletTypes->remove($pos);
            if (null === $this->outletTypesScheduledForDeletion) {
                $this->outletTypesScheduledForDeletion = clone $this->collOutletTypes;
                $this->outletTypesScheduledForDeletion->clear();
            }
            $this->outletTypesScheduledForDeletion[]= $outletType;
            $outletType->setMediaFiles(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this MediaFiles is new, it will return
     * an empty collection; or if this MediaFiles has previously
     * been saved, it will retrieve related OutletTypes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in MediaFiles.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOutletType[] List of ChildOutletType objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOutletType}> List of ChildOutletType objects
     */
    public function getOutletTypesJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOutletTypeQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOutletTypes($query, $con);
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
        if (null !== $this->aCompany) {
            $this->aCompany->removeMediaFiles($this);
        }
        if (null !== $this->aMediaFolders) {
            $this->aMediaFolders->removeMediaFiles($this);
        }
        $this->media_id = null;
        $this->media_name = null;
        $this->media_mime = null;
        $this->media_data = null;
        $this->folder_id = null;
        $this->company_id = null;
        $this->iss3file = null;
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
            if ($this->collAgendatypess) {
                foreach ($this->collAgendatypess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCheckInMedias) {
                foreach ($this->collCheckInMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGiftss) {
                foreach ($this->collGiftss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOfferss) {
                foreach ($this->collOfferss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOutletTypes) {
                foreach ($this->collOutletTypes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAgendatypess = null;
        $this->collCheckInMedias = null;
        $this->collGiftss = null;
        $this->collOfferss = null;
        $this->collOutletTypes = null;
        $this->aCompany = null;
        $this->aMediaFolders = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MediaFilesTableMap::DEFAULT_STRING_FORMAT);
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

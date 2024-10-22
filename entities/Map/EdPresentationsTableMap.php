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
use entities\EdPresentations;
use entities\EdPresentationsQuery;


/**
 * This class defines the structure of the 'ed_presentations' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EdPresentationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EdPresentationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'ed_presentations';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EdPresentations';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EdPresentations';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EdPresentations';

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
     * the column name for the presentation_id field
     */
    public const COL_PRESENTATION_ID = 'ed_presentations.presentation_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'ed_presentations.brand_id';

    /**
     * the column name for the presentation_name field
     */
    public const COL_PRESENTATION_NAME = 'ed_presentations.presentation_name';

    /**
     * the column name for the presentation_media field
     */
    public const COL_PRESENTATION_MEDIA = 'ed_presentations.presentation_media';

    /**
     * the column name for the presentation_zip_url field
     */
    public const COL_PRESENTATION_ZIP_URL = 'ed_presentations.presentation_zip_url';

    /**
     * the column name for the presentation_version_id field
     */
    public const COL_PRESENTATION_VERSION_ID = 'ed_presentations.presentation_version_id';

    /**
     * the column name for the presentation_release_date field
     */
    public const COL_PRESENTATION_RELEASE_DATE = 'ed_presentations.presentation_release_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'ed_presentations.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'ed_presentations.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'ed_presentations.updated_at';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'ed_presentations.orgunit_id';

    /**
     * the column name for the page_count field
     */
    public const COL_PAGE_COUNT = 'ed_presentations.page_count';

    /**
     * the column name for the file_size field
     */
    public const COL_FILE_SIZE = 'ed_presentations.file_size';

    /**
     * the column name for the presentation_language_id field
     */
    public const COL_PRESENTATION_LANGUAGE_ID = 'ed_presentations.presentation_language_id';

    /**
     * the column name for the media_url field
     */
    public const COL_MEDIA_URL = 'ed_presentations.media_url';

    /**
     * the column name for the presentation_type_name field
     */
    public const COL_PRESENTATION_TYPE_NAME = 'ed_presentations.presentation_type_name';

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
        self::TYPE_PHPNAME       => ['PresentationId', 'BrandId', 'PresentationName', 'PresentationMedia', 'PresentationZipUrl', 'PresentationVersionId', 'PresentationReleaseDate', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'OrgunitId', 'PageCount', 'FileSize', 'PresentationLanguageId', 'MediaUrl', 'PresentationTypeName', ],
        self::TYPE_CAMELNAME     => ['presentationId', 'brandId', 'presentationName', 'presentationMedia', 'presentationZipUrl', 'presentationVersionId', 'presentationReleaseDate', 'companyId', 'createdAt', 'updatedAt', 'orgunitId', 'pageCount', 'fileSize', 'presentationLanguageId', 'mediaUrl', 'presentationTypeName', ],
        self::TYPE_COLNAME       => [EdPresentationsTableMap::COL_PRESENTATION_ID, EdPresentationsTableMap::COL_BRAND_ID, EdPresentationsTableMap::COL_PRESENTATION_NAME, EdPresentationsTableMap::COL_PRESENTATION_MEDIA, EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL, EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID, EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE, EdPresentationsTableMap::COL_COMPANY_ID, EdPresentationsTableMap::COL_CREATED_AT, EdPresentationsTableMap::COL_UPDATED_AT, EdPresentationsTableMap::COL_ORGUNIT_ID, EdPresentationsTableMap::COL_PAGE_COUNT, EdPresentationsTableMap::COL_FILE_SIZE, EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID, EdPresentationsTableMap::COL_MEDIA_URL, EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME, ],
        self::TYPE_FIELDNAME     => ['presentation_id', 'brand_id', 'presentation_name', 'presentation_media', 'presentation_zip_url', 'presentation_version_id', 'presentation_release_date', 'company_id', 'created_at', 'updated_at', 'orgunit_id', 'page_count', 'file_size', 'presentation_language_id', 'media_url', 'presentation_type_name', ],
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
        self::TYPE_PHPNAME       => ['PresentationId' => 0, 'BrandId' => 1, 'PresentationName' => 2, 'PresentationMedia' => 3, 'PresentationZipUrl' => 4, 'PresentationVersionId' => 5, 'PresentationReleaseDate' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'OrgunitId' => 10, 'PageCount' => 11, 'FileSize' => 12, 'PresentationLanguageId' => 13, 'MediaUrl' => 14, 'PresentationTypeName' => 15, ],
        self::TYPE_CAMELNAME     => ['presentationId' => 0, 'brandId' => 1, 'presentationName' => 2, 'presentationMedia' => 3, 'presentationZipUrl' => 4, 'presentationVersionId' => 5, 'presentationReleaseDate' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'orgunitId' => 10, 'pageCount' => 11, 'fileSize' => 12, 'presentationLanguageId' => 13, 'mediaUrl' => 14, 'presentationTypeName' => 15, ],
        self::TYPE_COLNAME       => [EdPresentationsTableMap::COL_PRESENTATION_ID => 0, EdPresentationsTableMap::COL_BRAND_ID => 1, EdPresentationsTableMap::COL_PRESENTATION_NAME => 2, EdPresentationsTableMap::COL_PRESENTATION_MEDIA => 3, EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL => 4, EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID => 5, EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE => 6, EdPresentationsTableMap::COL_COMPANY_ID => 7, EdPresentationsTableMap::COL_CREATED_AT => 8, EdPresentationsTableMap::COL_UPDATED_AT => 9, EdPresentationsTableMap::COL_ORGUNIT_ID => 10, EdPresentationsTableMap::COL_PAGE_COUNT => 11, EdPresentationsTableMap::COL_FILE_SIZE => 12, EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID => 13, EdPresentationsTableMap::COL_MEDIA_URL => 14, EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME => 15, ],
        self::TYPE_FIELDNAME     => ['presentation_id' => 0, 'brand_id' => 1, 'presentation_name' => 2, 'presentation_media' => 3, 'presentation_zip_url' => 4, 'presentation_version_id' => 5, 'presentation_release_date' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'orgunit_id' => 10, 'page_count' => 11, 'file_size' => 12, 'presentation_language_id' => 13, 'media_url' => 14, 'presentation_type_name' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PresentationId' => 'PRESENTATION_ID',
        'EdPresentations.PresentationId' => 'PRESENTATION_ID',
        'presentationId' => 'PRESENTATION_ID',
        'edPresentations.presentationId' => 'PRESENTATION_ID',
        'EdPresentationsTableMap::COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'COL_PRESENTATION_ID' => 'PRESENTATION_ID',
        'presentation_id' => 'PRESENTATION_ID',
        'ed_presentations.presentation_id' => 'PRESENTATION_ID',
        'BrandId' => 'BRAND_ID',
        'EdPresentations.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'edPresentations.brandId' => 'BRAND_ID',
        'EdPresentationsTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'ed_presentations.brand_id' => 'BRAND_ID',
        'PresentationName' => 'PRESENTATION_NAME',
        'EdPresentations.PresentationName' => 'PRESENTATION_NAME',
        'presentationName' => 'PRESENTATION_NAME',
        'edPresentations.presentationName' => 'PRESENTATION_NAME',
        'EdPresentationsTableMap::COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'COL_PRESENTATION_NAME' => 'PRESENTATION_NAME',
        'presentation_name' => 'PRESENTATION_NAME',
        'ed_presentations.presentation_name' => 'PRESENTATION_NAME',
        'PresentationMedia' => 'PRESENTATION_MEDIA',
        'EdPresentations.PresentationMedia' => 'PRESENTATION_MEDIA',
        'presentationMedia' => 'PRESENTATION_MEDIA',
        'edPresentations.presentationMedia' => 'PRESENTATION_MEDIA',
        'EdPresentationsTableMap::COL_PRESENTATION_MEDIA' => 'PRESENTATION_MEDIA',
        'COL_PRESENTATION_MEDIA' => 'PRESENTATION_MEDIA',
        'presentation_media' => 'PRESENTATION_MEDIA',
        'ed_presentations.presentation_media' => 'PRESENTATION_MEDIA',
        'PresentationZipUrl' => 'PRESENTATION_ZIP_URL',
        'EdPresentations.PresentationZipUrl' => 'PRESENTATION_ZIP_URL',
        'presentationZipUrl' => 'PRESENTATION_ZIP_URL',
        'edPresentations.presentationZipUrl' => 'PRESENTATION_ZIP_URL',
        'EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL' => 'PRESENTATION_ZIP_URL',
        'COL_PRESENTATION_ZIP_URL' => 'PRESENTATION_ZIP_URL',
        'presentation_zip_url' => 'PRESENTATION_ZIP_URL',
        'ed_presentations.presentation_zip_url' => 'PRESENTATION_ZIP_URL',
        'PresentationVersionId' => 'PRESENTATION_VERSION_ID',
        'EdPresentations.PresentationVersionId' => 'PRESENTATION_VERSION_ID',
        'presentationVersionId' => 'PRESENTATION_VERSION_ID',
        'edPresentations.presentationVersionId' => 'PRESENTATION_VERSION_ID',
        'EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID' => 'PRESENTATION_VERSION_ID',
        'COL_PRESENTATION_VERSION_ID' => 'PRESENTATION_VERSION_ID',
        'presentation_version_id' => 'PRESENTATION_VERSION_ID',
        'ed_presentations.presentation_version_id' => 'PRESENTATION_VERSION_ID',
        'PresentationReleaseDate' => 'PRESENTATION_RELEASE_DATE',
        'EdPresentations.PresentationReleaseDate' => 'PRESENTATION_RELEASE_DATE',
        'presentationReleaseDate' => 'PRESENTATION_RELEASE_DATE',
        'edPresentations.presentationReleaseDate' => 'PRESENTATION_RELEASE_DATE',
        'EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE' => 'PRESENTATION_RELEASE_DATE',
        'COL_PRESENTATION_RELEASE_DATE' => 'PRESENTATION_RELEASE_DATE',
        'presentation_release_date' => 'PRESENTATION_RELEASE_DATE',
        'ed_presentations.presentation_release_date' => 'PRESENTATION_RELEASE_DATE',
        'CompanyId' => 'COMPANY_ID',
        'EdPresentations.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'edPresentations.companyId' => 'COMPANY_ID',
        'EdPresentationsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'ed_presentations.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'EdPresentations.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'edPresentations.createdAt' => 'CREATED_AT',
        'EdPresentationsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'ed_presentations.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EdPresentations.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'edPresentations.updatedAt' => 'UPDATED_AT',
        'EdPresentationsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'ed_presentations.updated_at' => 'UPDATED_AT',
        'OrgunitId' => 'ORGUNIT_ID',
        'EdPresentations.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'edPresentations.orgunitId' => 'ORGUNIT_ID',
        'EdPresentationsTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'ed_presentations.orgunit_id' => 'ORGUNIT_ID',
        'PageCount' => 'PAGE_COUNT',
        'EdPresentations.PageCount' => 'PAGE_COUNT',
        'pageCount' => 'PAGE_COUNT',
        'edPresentations.pageCount' => 'PAGE_COUNT',
        'EdPresentationsTableMap::COL_PAGE_COUNT' => 'PAGE_COUNT',
        'COL_PAGE_COUNT' => 'PAGE_COUNT',
        'page_count' => 'PAGE_COUNT',
        'ed_presentations.page_count' => 'PAGE_COUNT',
        'FileSize' => 'FILE_SIZE',
        'EdPresentations.FileSize' => 'FILE_SIZE',
        'fileSize' => 'FILE_SIZE',
        'edPresentations.fileSize' => 'FILE_SIZE',
        'EdPresentationsTableMap::COL_FILE_SIZE' => 'FILE_SIZE',
        'COL_FILE_SIZE' => 'FILE_SIZE',
        'file_size' => 'FILE_SIZE',
        'ed_presentations.file_size' => 'FILE_SIZE',
        'PresentationLanguageId' => 'PRESENTATION_LANGUAGE_ID',
        'EdPresentations.PresentationLanguageId' => 'PRESENTATION_LANGUAGE_ID',
        'presentationLanguageId' => 'PRESENTATION_LANGUAGE_ID',
        'edPresentations.presentationLanguageId' => 'PRESENTATION_LANGUAGE_ID',
        'EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID' => 'PRESENTATION_LANGUAGE_ID',
        'COL_PRESENTATION_LANGUAGE_ID' => 'PRESENTATION_LANGUAGE_ID',
        'presentation_language_id' => 'PRESENTATION_LANGUAGE_ID',
        'ed_presentations.presentation_language_id' => 'PRESENTATION_LANGUAGE_ID',
        'MediaUrl' => 'MEDIA_URL',
        'EdPresentations.MediaUrl' => 'MEDIA_URL',
        'mediaUrl' => 'MEDIA_URL',
        'edPresentations.mediaUrl' => 'MEDIA_URL',
        'EdPresentationsTableMap::COL_MEDIA_URL' => 'MEDIA_URL',
        'COL_MEDIA_URL' => 'MEDIA_URL',
        'media_url' => 'MEDIA_URL',
        'ed_presentations.media_url' => 'MEDIA_URL',
        'PresentationTypeName' => 'PRESENTATION_TYPE_NAME',
        'EdPresentations.PresentationTypeName' => 'PRESENTATION_TYPE_NAME',
        'presentationTypeName' => 'PRESENTATION_TYPE_NAME',
        'edPresentations.presentationTypeName' => 'PRESENTATION_TYPE_NAME',
        'EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME' => 'PRESENTATION_TYPE_NAME',
        'COL_PRESENTATION_TYPE_NAME' => 'PRESENTATION_TYPE_NAME',
        'presentation_type_name' => 'PRESENTATION_TYPE_NAME',
        'ed_presentations.presentation_type_name' => 'PRESENTATION_TYPE_NAME',
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
        $this->setName('ed_presentations');
        $this->setPhpName('EdPresentations');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EdPresentations');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('ed_presentations_presentation_id_seq');
        // columns
        $this->addPrimaryKey('presentation_id', 'PresentationId', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('presentation_name', 'PresentationName', 'VARCHAR', false, null, null);
        $this->addColumn('presentation_media', 'PresentationMedia', 'INTEGER', false, null, null);
        $this->addColumn('presentation_zip_url', 'PresentationZipUrl', 'VARCHAR', false, null, null);
        $this->addColumn('presentation_version_id', 'PresentationVersionId', 'DECIMAL', false, null, null);
        $this->addColumn('presentation_release_date', 'PresentationReleaseDate', 'DATE', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('page_count', 'PageCount', 'VARCHAR', false, null, null);
        $this->addColumn('file_size', 'FileSize', 'VARCHAR', false, null, null);
        $this->addForeignKey('presentation_language_id', 'PresentationLanguageId', 'INTEGER', 'language', 'language_id', false, null, null);
        $this->addColumn('media_url', 'MediaUrl', 'LONGVARCHAR', false, null, null);
        $this->addColumn('presentation_type_name', 'PresentationTypeName', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Language', '\\entities\\Language', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':presentation_language_id',
    1 => ':language_id',
  ),
), null, null, null, false);
        $this->addRelation('EdFeedbacks', '\\entities\\EdFeedbacks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':presentation_id',
    1 => ':presentation_id',
  ),
), null, null, 'EdFeedbackss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EdPresentationsTableMap::CLASS_DEFAULT : EdPresentationsTableMap::OM_CLASS;
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
     * @return array (EdPresentations object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EdPresentationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EdPresentationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EdPresentationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EdPresentationsTableMap::OM_CLASS;
            /** @var EdPresentations $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EdPresentationsTableMap::addInstanceToPool($obj, $key);
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
            $key = EdPresentationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EdPresentationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EdPresentations $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EdPresentationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_NAME);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_MEDIA);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PAGE_COUNT);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_FILE_SIZE);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_MEDIA_URL);
            $criteria->addSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.presentation_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.presentation_name');
            $criteria->addSelectColumn($alias . '.presentation_media');
            $criteria->addSelectColumn($alias . '.presentation_zip_url');
            $criteria->addSelectColumn($alias . '.presentation_version_id');
            $criteria->addSelectColumn($alias . '.presentation_release_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.page_count');
            $criteria->addSelectColumn($alias . '.file_size');
            $criteria->addSelectColumn($alias . '.presentation_language_id');
            $criteria->addSelectColumn($alias . '.media_url');
            $criteria->addSelectColumn($alias . '.presentation_type_name');
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
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_NAME);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_MEDIA);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_ZIP_URL);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_VERSION_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_RELEASE_DATE);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PAGE_COUNT);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_FILE_SIZE);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_LANGUAGE_ID);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_MEDIA_URL);
            $criteria->removeSelectColumn(EdPresentationsTableMap::COL_PRESENTATION_TYPE_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.presentation_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.presentation_name');
            $criteria->removeSelectColumn($alias . '.presentation_media');
            $criteria->removeSelectColumn($alias . '.presentation_zip_url');
            $criteria->removeSelectColumn($alias . '.presentation_version_id');
            $criteria->removeSelectColumn($alias . '.presentation_release_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.page_count');
            $criteria->removeSelectColumn($alias . '.file_size');
            $criteria->removeSelectColumn($alias . '.presentation_language_id');
            $criteria->removeSelectColumn($alias . '.media_url');
            $criteria->removeSelectColumn($alias . '.presentation_type_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(EdPresentationsTableMap::DATABASE_NAME)->getTable(EdPresentationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EdPresentations or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EdPresentations object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EdPresentations) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EdPresentationsTableMap::DATABASE_NAME);
            $criteria->add(EdPresentationsTableMap::COL_PRESENTATION_ID, (array) $values, Criteria::IN);
        }

        $query = EdPresentationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EdPresentationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EdPresentationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ed_presentations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EdPresentationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EdPresentations or Criteria object.
     *
     * @param mixed $criteria Criteria or EdPresentations object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdPresentationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EdPresentations object
        }

        if ($criteria->containsKey(EdPresentationsTableMap::COL_PRESENTATION_ID) && $criteria->keyContainsValue(EdPresentationsTableMap::COL_PRESENTATION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EdPresentationsTableMap::COL_PRESENTATION_ID.')');
        }


        // Set the correct dbName
        $query = EdPresentationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

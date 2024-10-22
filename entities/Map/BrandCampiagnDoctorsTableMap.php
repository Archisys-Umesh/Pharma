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
use entities\BrandCampiagnDoctors;
use entities\BrandCampiagnDoctorsQuery;


/**
 * This class defines the structure of the 'brand_campiagn_doctors' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandCampiagnDoctorsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandCampiagnDoctorsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_campiagn_doctors';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandCampiagnDoctors';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandCampiagnDoctors';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandCampiagnDoctors';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the doctor_visit_id field
     */
    public const COL_DOCTOR_VISIT_ID = 'brand_campiagn_doctors.doctor_visit_id';

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'brand_campiagn_doctors.brand_campiagn_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'brand_campiagn_doctors.outlet_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brand_campiagn_doctors.company_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'brand_campiagn_doctors.outlet_org_data_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_campiagn_doctors.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_campiagn_doctors.updated_at';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'brand_campiagn_doctors.position_id';

    /**
     * the column name for the is_process field
     */
    public const COL_IS_PROCESS = 'brand_campiagn_doctors.is_process';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'brand_campiagn_doctors.comment';

    /**
     * the column name for the selected field
     */
    public const COL_SELECTED = 'brand_campiagn_doctors.selected';

    /**
     * the column name for the transaction_mode field
     */
    public const COL_TRANSACTION_MODE = 'brand_campiagn_doctors.transaction_mode';

    /**
     * the column name for the classification_id field
     */
    public const COL_CLASSIFICATION_ID = 'brand_campiagn_doctors.classification_id';

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
        self::TYPE_PHPNAME       => ['DoctorVisitId', 'BrandCampiagnId', 'OutletId', 'CompanyId', 'OutletOrgDataId', 'CreatedAt', 'UpdatedAt', 'PositionId', 'IsProcess', 'Comment', 'Selected', 'TransactionMode', 'ClassificationId', ],
        self::TYPE_CAMELNAME     => ['doctorVisitId', 'brandCampiagnId', 'outletId', 'companyId', 'outletOrgDataId', 'createdAt', 'updatedAt', 'positionId', 'isProcess', 'comment', 'selected', 'transactionMode', 'classificationId', ],
        self::TYPE_COLNAME       => [BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID, BrandCampiagnDoctorsTableMap::COL_BRAND_CAMPIAGN_ID, BrandCampiagnDoctorsTableMap::COL_OUTLET_ID, BrandCampiagnDoctorsTableMap::COL_COMPANY_ID, BrandCampiagnDoctorsTableMap::COL_OUTLET_ORG_DATA_ID, BrandCampiagnDoctorsTableMap::COL_CREATED_AT, BrandCampiagnDoctorsTableMap::COL_UPDATED_AT, BrandCampiagnDoctorsTableMap::COL_POSITION_ID, BrandCampiagnDoctorsTableMap::COL_IS_PROCESS, BrandCampiagnDoctorsTableMap::COL_COMMENT, BrandCampiagnDoctorsTableMap::COL_SELECTED, BrandCampiagnDoctorsTableMap::COL_TRANSACTION_MODE, BrandCampiagnDoctorsTableMap::COL_CLASSIFICATION_ID, ],
        self::TYPE_FIELDNAME     => ['doctor_visit_id', 'brand_campiagn_id', 'outlet_id', 'company_id', 'outlet_org_data_id', 'created_at', 'updated_at', 'position_id', 'is_process', 'comment', 'selected', 'transaction_mode', 'classification_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['DoctorVisitId' => 0, 'BrandCampiagnId' => 1, 'OutletId' => 2, 'CompanyId' => 3, 'OutletOrgDataId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'PositionId' => 7, 'IsProcess' => 8, 'Comment' => 9, 'Selected' => 10, 'TransactionMode' => 11, 'ClassificationId' => 12, ],
        self::TYPE_CAMELNAME     => ['doctorVisitId' => 0, 'brandCampiagnId' => 1, 'outletId' => 2, 'companyId' => 3, 'outletOrgDataId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'positionId' => 7, 'isProcess' => 8, 'comment' => 9, 'selected' => 10, 'transactionMode' => 11, 'classificationId' => 12, ],
        self::TYPE_COLNAME       => [BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID => 0, BrandCampiagnDoctorsTableMap::COL_BRAND_CAMPIAGN_ID => 1, BrandCampiagnDoctorsTableMap::COL_OUTLET_ID => 2, BrandCampiagnDoctorsTableMap::COL_COMPANY_ID => 3, BrandCampiagnDoctorsTableMap::COL_OUTLET_ORG_DATA_ID => 4, BrandCampiagnDoctorsTableMap::COL_CREATED_AT => 5, BrandCampiagnDoctorsTableMap::COL_UPDATED_AT => 6, BrandCampiagnDoctorsTableMap::COL_POSITION_ID => 7, BrandCampiagnDoctorsTableMap::COL_IS_PROCESS => 8, BrandCampiagnDoctorsTableMap::COL_COMMENT => 9, BrandCampiagnDoctorsTableMap::COL_SELECTED => 10, BrandCampiagnDoctorsTableMap::COL_TRANSACTION_MODE => 11, BrandCampiagnDoctorsTableMap::COL_CLASSIFICATION_ID => 12, ],
        self::TYPE_FIELDNAME     => ['doctor_visit_id' => 0, 'brand_campiagn_id' => 1, 'outlet_id' => 2, 'company_id' => 3, 'outlet_org_data_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'position_id' => 7, 'is_process' => 8, 'comment' => 9, 'selected' => 10, 'transaction_mode' => 11, 'classification_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DoctorVisitId' => 'DOCTOR_VISIT_ID',
        'BrandCampiagnDoctors.DoctorVisitId' => 'DOCTOR_VISIT_ID',
        'doctorVisitId' => 'DOCTOR_VISIT_ID',
        'brandCampiagnDoctors.doctorVisitId' => 'DOCTOR_VISIT_ID',
        'BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID' => 'DOCTOR_VISIT_ID',
        'COL_DOCTOR_VISIT_ID' => 'DOCTOR_VISIT_ID',
        'doctor_visit_id' => 'DOCTOR_VISIT_ID',
        'brand_campiagn_doctors.doctor_visit_id' => 'DOCTOR_VISIT_ID',
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnDoctors.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnDoctors.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnDoctorsTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_doctors.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'OutletId' => 'OUTLET_ID',
        'BrandCampiagnDoctors.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'brandCampiagnDoctors.outletId' => 'OUTLET_ID',
        'BrandCampiagnDoctorsTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'brand_campiagn_doctors.outlet_id' => 'OUTLET_ID',
        'CompanyId' => 'COMPANY_ID',
        'BrandCampiagnDoctors.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brandCampiagnDoctors.companyId' => 'COMPANY_ID',
        'BrandCampiagnDoctorsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brand_campiagn_doctors.company_id' => 'COMPANY_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'BrandCampiagnDoctors.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'brandCampiagnDoctors.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'BrandCampiagnDoctorsTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'brand_campiagn_doctors.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandCampiagnDoctors.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandCampiagnDoctors.createdAt' => 'CREATED_AT',
        'BrandCampiagnDoctorsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_campiagn_doctors.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandCampiagnDoctors.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandCampiagnDoctors.updatedAt' => 'UPDATED_AT',
        'BrandCampiagnDoctorsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_campiagn_doctors.updated_at' => 'UPDATED_AT',
        'PositionId' => 'POSITION_ID',
        'BrandCampiagnDoctors.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'brandCampiagnDoctors.positionId' => 'POSITION_ID',
        'BrandCampiagnDoctorsTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'brand_campiagn_doctors.position_id' => 'POSITION_ID',
        'IsProcess' => 'IS_PROCESS',
        'BrandCampiagnDoctors.IsProcess' => 'IS_PROCESS',
        'isProcess' => 'IS_PROCESS',
        'brandCampiagnDoctors.isProcess' => 'IS_PROCESS',
        'BrandCampiagnDoctorsTableMap::COL_IS_PROCESS' => 'IS_PROCESS',
        'COL_IS_PROCESS' => 'IS_PROCESS',
        'is_process' => 'IS_PROCESS',
        'brand_campiagn_doctors.is_process' => 'IS_PROCESS',
        'Comment' => 'COMMENT',
        'BrandCampiagnDoctors.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'brandCampiagnDoctors.comment' => 'COMMENT',
        'BrandCampiagnDoctorsTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'brand_campiagn_doctors.comment' => 'COMMENT',
        'Selected' => 'SELECTED',
        'BrandCampiagnDoctors.Selected' => 'SELECTED',
        'selected' => 'SELECTED',
        'brandCampiagnDoctors.selected' => 'SELECTED',
        'BrandCampiagnDoctorsTableMap::COL_SELECTED' => 'SELECTED',
        'COL_SELECTED' => 'SELECTED',
        'brand_campiagn_doctors.selected' => 'SELECTED',
        'TransactionMode' => 'TRANSACTION_MODE',
        'BrandCampiagnDoctors.TransactionMode' => 'TRANSACTION_MODE',
        'transactionMode' => 'TRANSACTION_MODE',
        'brandCampiagnDoctors.transactionMode' => 'TRANSACTION_MODE',
        'BrandCampiagnDoctorsTableMap::COL_TRANSACTION_MODE' => 'TRANSACTION_MODE',
        'COL_TRANSACTION_MODE' => 'TRANSACTION_MODE',
        'transaction_mode' => 'TRANSACTION_MODE',
        'brand_campiagn_doctors.transaction_mode' => 'TRANSACTION_MODE',
        'ClassificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagnDoctors.ClassificationId' => 'CLASSIFICATION_ID',
        'classificationId' => 'CLASSIFICATION_ID',
        'brandCampiagnDoctors.classificationId' => 'CLASSIFICATION_ID',
        'BrandCampiagnDoctorsTableMap::COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'COL_CLASSIFICATION_ID' => 'CLASSIFICATION_ID',
        'classification_id' => 'CLASSIFICATION_ID',
        'brand_campiagn_doctors.classification_id' => 'CLASSIFICATION_ID',
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
        $this->setName('brand_campiagn_doctors');
        $this->setPhpName('BrandCampiagnDoctors');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandCampiagnDoctors');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_campiagn_doctors_doctor_visit_id_seq');
        // columns
        $this->addPrimaryKey('doctor_visit_id', 'DoctorVisitId', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', 'brand_campiagn', 'brand_campiagn_id', false, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('is_process', 'IsProcess', 'BOOLEAN', false, 1, false);
        $this->addColumn('comment', 'Comment', 'LONGVARCHAR', false, null, null);
        $this->addColumn('selected', 'Selected', 'BOOLEAN', false, 1, false);
        $this->addColumn('transaction_mode', 'TransactionMode', 'VARCHAR', false, null, null);
        $this->addForeignKey('classification_id', 'ClassificationId', 'INTEGER', 'classification', 'id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_campiagn_id',
    1 => ':brand_campiagn_id',
  ),
), null, null, null, false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_data_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':classification_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DoctorVisitId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandCampiagnDoctorsTableMap::CLASS_DEFAULT : BrandCampiagnDoctorsTableMap::OM_CLASS;
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
     * @return array (BrandCampiagnDoctors object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandCampiagnDoctorsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandCampiagnDoctorsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandCampiagnDoctorsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandCampiagnDoctorsTableMap::OM_CLASS;
            /** @var BrandCampiagnDoctors $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandCampiagnDoctorsTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandCampiagnDoctorsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandCampiagnDoctorsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandCampiagnDoctors $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandCampiagnDoctorsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_IS_PROCESS);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_COMMENT);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_SELECTED);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_TRANSACTION_MODE);
            $criteria->addSelectColumn(BrandCampiagnDoctorsTableMap::COL_CLASSIFICATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.doctor_visit_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.is_process');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.selected');
            $criteria->addSelectColumn($alias . '.transaction_mode');
            $criteria->addSelectColumn($alias . '.classification_id');
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
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_IS_PROCESS);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_SELECTED);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_TRANSACTION_MODE);
            $criteria->removeSelectColumn(BrandCampiagnDoctorsTableMap::COL_CLASSIFICATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.doctor_visit_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.is_process');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.selected');
            $criteria->removeSelectColumn($alias . '.transaction_mode');
            $criteria->removeSelectColumn($alias . '.classification_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandCampiagnDoctorsTableMap::DATABASE_NAME)->getTable(BrandCampiagnDoctorsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandCampiagnDoctors or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandCampiagnDoctors object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnDoctorsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandCampiagnDoctors) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandCampiagnDoctorsTableMap::DATABASE_NAME);
            $criteria->add(BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID, (array) $values, Criteria::IN);
        }

        $query = BrandCampiagnDoctorsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandCampiagnDoctorsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandCampiagnDoctorsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_campiagn_doctors table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandCampiagnDoctorsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandCampiagnDoctors or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandCampiagnDoctors object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandCampiagnDoctorsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandCampiagnDoctors object
        }

        if ($criteria->containsKey(BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID) && $criteria->keyContainsValue(BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandCampiagnDoctorsTableMap::COL_DOCTOR_VISIT_ID.')');
        }


        // Set the correct dbName
        $query = BrandCampiagnDoctorsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

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
use entities\EmailTemplate;
use entities\EmailTemplateQuery;


/**
 * This class defines the structure of the 'email_template' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmailTemplateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmailTemplateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'email_template';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmailTemplate';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmailTemplate';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmailTemplate';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the template_id field
     */
    public const COL_TEMPLATE_ID = 'email_template.template_id';

    /**
     * the column name for the template_type field
     */
    public const COL_TEMPLATE_TYPE = 'email_template.template_type';

    /**
     * the column name for the template_subject field
     */
    public const COL_TEMPLATE_SUBJECT = 'email_template.template_subject';

    /**
     * the column name for the template_body field
     */
    public const COL_TEMPLATE_BODY = 'email_template.template_body';

    /**
     * the column name for the template_status field
     */
    public const COL_TEMPLATE_STATUS = 'email_template.template_status';

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
        self::TYPE_PHPNAME       => ['TemplateId', 'TemplateType', 'TemplateSubject', 'TemplateBody', 'TemplateStatus', ],
        self::TYPE_CAMELNAME     => ['templateId', 'templateType', 'templateSubject', 'templateBody', 'templateStatus', ],
        self::TYPE_COLNAME       => [EmailTemplateTableMap::COL_TEMPLATE_ID, EmailTemplateTableMap::COL_TEMPLATE_TYPE, EmailTemplateTableMap::COL_TEMPLATE_SUBJECT, EmailTemplateTableMap::COL_TEMPLATE_BODY, EmailTemplateTableMap::COL_TEMPLATE_STATUS, ],
        self::TYPE_FIELDNAME     => ['template_id', 'template_type', 'template_subject', 'template_body', 'template_status', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['TemplateId' => 0, 'TemplateType' => 1, 'TemplateSubject' => 2, 'TemplateBody' => 3, 'TemplateStatus' => 4, ],
        self::TYPE_CAMELNAME     => ['templateId' => 0, 'templateType' => 1, 'templateSubject' => 2, 'templateBody' => 3, 'templateStatus' => 4, ],
        self::TYPE_COLNAME       => [EmailTemplateTableMap::COL_TEMPLATE_ID => 0, EmailTemplateTableMap::COL_TEMPLATE_TYPE => 1, EmailTemplateTableMap::COL_TEMPLATE_SUBJECT => 2, EmailTemplateTableMap::COL_TEMPLATE_BODY => 3, EmailTemplateTableMap::COL_TEMPLATE_STATUS => 4, ],
        self::TYPE_FIELDNAME     => ['template_id' => 0, 'template_type' => 1, 'template_subject' => 2, 'template_body' => 3, 'template_status' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TemplateId' => 'TEMPLATE_ID',
        'EmailTemplate.TemplateId' => 'TEMPLATE_ID',
        'templateId' => 'TEMPLATE_ID',
        'emailTemplate.templateId' => 'TEMPLATE_ID',
        'EmailTemplateTableMap::COL_TEMPLATE_ID' => 'TEMPLATE_ID',
        'COL_TEMPLATE_ID' => 'TEMPLATE_ID',
        'template_id' => 'TEMPLATE_ID',
        'email_template.template_id' => 'TEMPLATE_ID',
        'TemplateType' => 'TEMPLATE_TYPE',
        'EmailTemplate.TemplateType' => 'TEMPLATE_TYPE',
        'templateType' => 'TEMPLATE_TYPE',
        'emailTemplate.templateType' => 'TEMPLATE_TYPE',
        'EmailTemplateTableMap::COL_TEMPLATE_TYPE' => 'TEMPLATE_TYPE',
        'COL_TEMPLATE_TYPE' => 'TEMPLATE_TYPE',
        'template_type' => 'TEMPLATE_TYPE',
        'email_template.template_type' => 'TEMPLATE_TYPE',
        'TemplateSubject' => 'TEMPLATE_SUBJECT',
        'EmailTemplate.TemplateSubject' => 'TEMPLATE_SUBJECT',
        'templateSubject' => 'TEMPLATE_SUBJECT',
        'emailTemplate.templateSubject' => 'TEMPLATE_SUBJECT',
        'EmailTemplateTableMap::COL_TEMPLATE_SUBJECT' => 'TEMPLATE_SUBJECT',
        'COL_TEMPLATE_SUBJECT' => 'TEMPLATE_SUBJECT',
        'template_subject' => 'TEMPLATE_SUBJECT',
        'email_template.template_subject' => 'TEMPLATE_SUBJECT',
        'TemplateBody' => 'TEMPLATE_BODY',
        'EmailTemplate.TemplateBody' => 'TEMPLATE_BODY',
        'templateBody' => 'TEMPLATE_BODY',
        'emailTemplate.templateBody' => 'TEMPLATE_BODY',
        'EmailTemplateTableMap::COL_TEMPLATE_BODY' => 'TEMPLATE_BODY',
        'COL_TEMPLATE_BODY' => 'TEMPLATE_BODY',
        'template_body' => 'TEMPLATE_BODY',
        'email_template.template_body' => 'TEMPLATE_BODY',
        'TemplateStatus' => 'TEMPLATE_STATUS',
        'EmailTemplate.TemplateStatus' => 'TEMPLATE_STATUS',
        'templateStatus' => 'TEMPLATE_STATUS',
        'emailTemplate.templateStatus' => 'TEMPLATE_STATUS',
        'EmailTemplateTableMap::COL_TEMPLATE_STATUS' => 'TEMPLATE_STATUS',
        'COL_TEMPLATE_STATUS' => 'TEMPLATE_STATUS',
        'template_status' => 'TEMPLATE_STATUS',
        'email_template.template_status' => 'TEMPLATE_STATUS',
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
        $this->setName('email_template');
        $this->setPhpName('EmailTemplate');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmailTemplate');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('email_template_template_id_seq');
        // columns
        $this->addPrimaryKey('template_id', 'TemplateId', 'INTEGER', true, null, null);
        $this->addColumn('template_type', 'TemplateType', 'VARCHAR', true, 255, null);
        $this->addColumn('template_subject', 'TemplateSubject', 'VARCHAR', true, 255, null);
        $this->addColumn('template_body', 'TemplateBody', 'LONGVARCHAR', true, null, null);
        $this->addColumn('template_status', 'TemplateStatus', 'INTEGER', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmailTemplateTableMap::CLASS_DEFAULT : EmailTemplateTableMap::OM_CLASS;
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
     * @return array (EmailTemplate object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmailTemplateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmailTemplateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmailTemplateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmailTemplateTableMap::OM_CLASS;
            /** @var EmailTemplate $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmailTemplateTableMap::addInstanceToPool($obj, $key);
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
            $key = EmailTemplateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmailTemplateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmailTemplate $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmailTemplateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_ID);
            $criteria->addSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_TYPE);
            $criteria->addSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_SUBJECT);
            $criteria->addSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_BODY);
            $criteria->addSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.template_id');
            $criteria->addSelectColumn($alias . '.template_type');
            $criteria->addSelectColumn($alias . '.template_subject');
            $criteria->addSelectColumn($alias . '.template_body');
            $criteria->addSelectColumn($alias . '.template_status');
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
            $criteria->removeSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_ID);
            $criteria->removeSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_TYPE);
            $criteria->removeSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_SUBJECT);
            $criteria->removeSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_BODY);
            $criteria->removeSelectColumn(EmailTemplateTableMap::COL_TEMPLATE_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.template_id');
            $criteria->removeSelectColumn($alias . '.template_type');
            $criteria->removeSelectColumn($alias . '.template_subject');
            $criteria->removeSelectColumn($alias . '.template_body');
            $criteria->removeSelectColumn($alias . '.template_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmailTemplateTableMap::DATABASE_NAME)->getTable(EmailTemplateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmailTemplate or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmailTemplate object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailTemplateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmailTemplate) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmailTemplateTableMap::DATABASE_NAME);
            $criteria->add(EmailTemplateTableMap::COL_TEMPLATE_ID, (array) $values, Criteria::IN);
        }

        $query = EmailTemplateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmailTemplateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmailTemplateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the email_template table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmailTemplateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmailTemplate or Criteria object.
     *
     * @param mixed $criteria Criteria or EmailTemplate object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailTemplateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmailTemplate object
        }

        if ($criteria->containsKey(EmailTemplateTableMap::COL_TEMPLATE_ID) && $criteria->keyContainsValue(EmailTemplateTableMap::COL_TEMPLATE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmailTemplateTableMap::COL_TEMPLATE_ID.')');
        }


        // Set the correct dbName
        $query = EmailTemplateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}

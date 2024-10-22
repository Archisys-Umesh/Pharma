<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;


/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class AgendaType implements OfflineModelInterface
{

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "AgendaTypes";
        $retunDB->idColName = "Agendaid";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         


        $retunDB->created = AgendatypesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByOrgunitid($empRec->getOrgUnitId())
            ->filterByStatus(1)
            ->find()->toArray();

        $retunDB->updated = AgendatypesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->filterByOrgunitid($empRec->getOrgUnitId())
            ->filterByStatus(1)
            ->find()->toArray();


        return $retunDB;
    }

    public function getTableName()
    {
        return "AgendaTypes";
    }

    public function doRecordsToReceive($date, WDBTable $data)
    {

    }

    // Deactivate the controller 
    public function canRun()
    {
        return true;
    }

    // Bool flag in error occured
    public function hadError()
    {

    }

    // Get array of error per record. 
    public function getErrorMessage()
    {

    }

    // Get full log 
    public function getLog()
    {

    }

}

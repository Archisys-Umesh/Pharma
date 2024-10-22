<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\OutletOrgDataKeys;
use entities\OutletStock as EntitiesOutletStock;
use entities\OutletStockQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class OutletOrgDataKey implements OfflineModelInterface {

    protected $User;
    protected $log = [];

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee(); 
        $terr = OrgManager::getMyTerritories($empRec);
        $terr = implode(',', $terr);
        $terr = !empty($terr) ? $terr : '0';

        $retunDB = new WDBTable();
        $retunDB->tableName = "OutletOrgDataKeys";
        $retunDB->idColName = "OutletOrgDataKeysId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        

        $retunDB->created = \entities\OutletOrgDataKeysQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
                                ->filterByCompanyId($empRec->getCompanyId())
                                ->addjoin('outlet_org_data_keys.outlet_org_data_id', 'outlet_view.outlet_org_id', Criteria::LEFT_JOIN)
                                ->where('outlet_view.territory_id in (' . $terr . ')')
                                ->find()->toArray();

        $retunDB->updated = \entities\OutletOrgDataKeysQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                            ->filterByCreatedAt($date,Criteria::LESS_THAN)
                            ->filterByCompanyId($empRec->getCompanyId())
                            ->addjoin('outlet_org_data_keys.outlet_org_data_id', 'outlet_view.outlet_org_id', Criteria::LEFT_JOIN)
                            ->where('outlet_view.territory_id in (' . $terr . ')')
                            ->find()->toArray();


        return $retunDB;
    }
    
    public function getTableName()
    {
        return "OutletOrgDataKeys";
    }

    public function doRecordsToReceive($date,WDBTable $data)
    {
        //
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
        return $this->log;
    }

}

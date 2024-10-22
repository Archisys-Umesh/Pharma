<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\BrandCompetitionQuery;
use entities\BrandRcpaQuery;
use entities\BrandsQuery;
use entities\EmployeeQuery;
use entities\TerritoriesQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class BrandRCPA implements OfflineModelInterface {

    
    protected $log = [];
    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "BrandRcpa";
        $retunDB->idColName = "BrcpaId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.
        /*
        $positions = OrgManager::getMyPositions($empRec);

        
        $empsid = EmployeeQuery::create()
                        ->select(["EmployeeId"])
                        ->filterByPositionId($positions)
                        ->find()->toArray();
        */
        $from_date = date('Y-m-d', strtotime("-30 days"));

        $retunDB->created = BrandRcpaQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
            //->filterByCompanyId($empRec->getCompanyId())
            ->filterByEmployeeId($empRec->getPrimaryKey())
            ->find()->toArray();

        $retunDB->updated = BrandRcpaQuery::create()
        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($from_date,Criteria::GREATER_EQUAL)       
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            //->filterByCompanyId($empRec->getCompanyId())
            ->filterByEmployeeId($empRec->getPrimaryKey())
            ->find()->toArray();


        return $retunDB;
    }
    
    public function getTableName()
    {
        return "BrandRcpa";
    }

    public function doRecordsToReceive($date,WDBTable $data)
    {
        foreach($data->created as &$created)
        {
            // is wdb key is duplicate
            if($data->isSyncDuplicate("created",$created,$this->User->getPrimaryKey(),$this->User->getCompanyId()))
            {
                continue;
            }
            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["BrcpaId"]); // Remove PK

            try {
                
                $BrandRcpa = new \entities\BrandRcpa();
                $BrandRcpa->fromArray($created);                
                $BrandRcpa->setCompanyId($this->User->getCompanyId());                
                $BrandRcpa->save();

                $wbtable->setNewpk($BrandRcpa->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

            }
            catch(\Exception $e)
            {             
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }

        foreach($data->updated as &$updated)
        {
            
            $wbtable = $data->LogUpdate("updated",$updated,
                    $this->User->getPrimaryKey(),
                    $this->User->getCompanyId());            
            try {

                $BrandRcpa = BrandRcpaQuery::create()->findPk($updated["BrcpaId"]);
                $BrandRcpa->fromArray($updated);
                $BrandRcpa->setCompanyId($this->User->getCompanyId());
                $BrandRcpa->save();
                
                $wbtable->setResMessage("Update");
                $wbtable->save();

                $this->log[$updated["id"]] = "Update";

            }
            catch(\Exception $e)
            {             
                $this->log[$updated["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getPrevious()->getMessage());
                $wbtable->save();
            }

        }


        foreach($data->deleted as $del)
        {
            $prefix = strtoupper(substr($wbtable->getSysTable(),0,3));
            $del = str_replace($prefix,"",$del);
            
            $wbtable = $data->LogUpdate("deleted",["id" => $del],
                $this->User->getPrimaryKey(),
                $this->User->getCompanyId());  

            if(!is_numeric($del))
            {                
                continue;
            }

            
            

            try {
                $BrandRcpa = BrandRcpaQuery::create()->findPk($del);
                if($BrandRcpa !=null)
                {
                    $BrandRcpa->delete();
                }

                $wbtable->setResMessage("Deleted");
                $wbtable->save();
                

            }
            catch(\Exception $e)
            {             
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getMessage());
                $wbtable->save();
            }

        }
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

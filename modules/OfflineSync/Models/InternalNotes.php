<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\AgendatypesQuery;
use entities\BeatsQuery;
use entities\CategoriesQuery;
use entities\DesignationsQuery;
use entities\OutletOrgNotesQuery;
use entities\PositionsQuery;
use entities\ProductsQuery;
use entities\Users;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class InternalNotes implements OfflineModelInterface {

      protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "OutletOrgNotes";
        $retunDB->idColName = "OutletOrgNoteId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        

        $retunDB->created = OutletOrgNotesQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
                                ->filterByOrgunitId($empRec->getOrgUnitId())                                
                                ->find()->toArray(); 
                                       
        $retunDB->updated = OutletOrgNotesQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
                                ->filterByCreatedAt($date,Criteria::LESS_THAN)
                                ->filterByOrgunitId($empRec->getOrgUnitId())                                
                                ->find()->toArray();

        return $retunDB;
    }

    public function getTableName()
    {
        return "OutletOrgNotes";
    }
    
    public function doRecordsToReceive($date,WDBTable $data)
    {
        foreach($data->created as &$created)
        {
            
            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["OutletOrgNoteId"]); // Remove PK

            try {

                $OutletOrgNotes = new \entities\OutletOrgNotes();
                $OutletOrgNotes->fromArray($created);
                $OutletOrgNotes->setCompanyId($this->User->getCompanyId());
                $OutletOrgNotes->save();

                $wbtable->setNewpk($OutletOrgNotes->getPrimaryKey());
                $wbtable->setResMessage("New Rec Created");
                $wbtable->save();

                $this->log[$created["id"]] = "Saved";

            }
            catch(\Exception $e)
            {             
                $this->log[$created["id"]] = $e->getMessage();
                $wbtable->setResMessage($e->getMessage());
                $wbtable->save();
            }

        }

        foreach($data->updated as &$updated)
        {
            
            $wbtable = $data->LogUpdate("updated",$updated,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());            
            try {

                $OutletOrgNotes = OutletOrgNotesQuery::create()->findPk($updated["OutletOrgNoteId"]);
                $OutletOrgNotes->fromArray($updated);
                $OutletOrgNotes->setCompanyId($this->User->getCompanyId());
                $OutletOrgNotes->save();
                
                $wbtable->setResMessage("Update");
                $wbtable->save();

                $this->log[$updated["id"]] = "Update";

            }
            catch(\Exception $e)
            {             
                $this->log[$updated["id"]] = $e->getMessage();
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

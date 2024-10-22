<?php declare(strict_types=1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;

use BI\manager\OrgManager;
use entities\EdPlaylistQuery;
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
class EdPlaylist implements OfflineModelInterface
{

      protected $User;
    protected $log = [];
    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date): WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "EdPlaylist";
        $retunDB->idColName = "PlaylistId";
        
        //$terr = OrgManager::getMyTerritories($empRec);

        
        $retunDB->created = EdPlaylistQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByCreatedAt($date, Criteria::GREATER_EQUAL)                            
            ->filterByOrgunitId ($empRec->getOrgUnitId())            
            ->filterByEmployeeId(null)
            ->_or()
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();

        $retunDB->updated = EdPlaylistQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByUpdatedAt($date, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date, Criteria::LESS_THAN)
            ->filterByOrgunitId ($empRec->getOrgUnitId())            
            ->filterByEmployeeId(null)
            ->_or()
            ->filterByEmployeeId($empRec->getEmployeeId())
            ->find()->toArray();
        

        return $retunDB;
    }

    public function getTableName()
    {
        return "EdPlaylist";
    }

    public function doRecordsToReceive($date,WDBTable $data)
    {
        foreach($data->created as &$created)
        {
            
            $wbtable = $data->LogUpdate("created",$created,
                        $this->User->getPrimaryKey(),
                        $this->User->getCompanyId());

            unset($created["PlaylistId"]); // Remove PK

            try {

                $EdPlaylist = new \entities\EdPlaylist();
                $EdPlaylist->fromArray($created);
                $EdPlaylist->setCompanyId($this->User->getCompanyId());
                $EdPlaylist->save();

                $wbtable->setNewpk($EdPlaylist->getPrimaryKey());
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

                $EdPlaylist = EdPlaylistQuery::create()->findPk($updated["PlaylistId"]);
                $EdPlaylist->fromArray($updated);
                $EdPlaylist->setCompanyId($this->User->getCompanyId());
                $EdPlaylist->save();
                
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

        // foreach ($data->deleted as $originalPlaylistId) {
        //     $prefix = strtoupper(substr($data->tableName,0,3));
        //     $playlistId = str_replace($prefix, '', $originalPlaylistId);

        //     if(!is_numeric($playlistId)) {
        //         continue;
        //     }

        //     $wbtable = $data->LogUpdate("deleted",['id' => $playlistId],
        //                 $this->User->getPrimaryKey(),
        //                 $this->User->getCompanyId()); 

        //     try {
        //         EdPlaylistQuery::create()
        //             ->filterByCompanyId($this->User->getCompanyId())
        //             ->filterByIscustom(true)
        //             ->filterByPlaylistId($playlistId)
        //             ->delete();

        //         $wbtable->setResMessage("Delete");
        //         $wbtable->save();

        //         $this->log[$originalPlaylistId] = "Delete";
        //     }
        //     catch(\Exception $e)
        //     {             
        //         $this->log[$originalPlaylistId] = $e->getMessage();
        //         $wbtable->setResMessage($e->getPrevious()->getMessage());
        //         $wbtable->save();
        //     }
        // }
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

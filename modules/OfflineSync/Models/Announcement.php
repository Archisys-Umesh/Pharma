<?php declare(strict_types = 1);

namespace Modules\OfflineSync\Models;

use DateTime;
use App\System\App;
use entities\Users;
use entities\BeatsQuery;
use entities\ProductsQuery;
use entities\PositionsQuery;
use entities\CategoriesQuery;
use entities\AgendatypesQuery;
use entities\DesignationsQuery;
use entities\AnnouncementsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Classes\WDBTable;
use entities\AnnouncementEmployeeMapQuery;
use Modules\OfflineSync\Interfaces\OfflineModelInterface;



/**
 * Description of OfflineSync - Model
 *
 * @author Chintan Parikh
 */
class Announcement implements OfflineModelInterface {

    protected $User;

    public function setApp(Users $user)
    {
        $this->User = $user;
    }

    public function doRecordsToSend($date) : WDBTable
    {
        $empRec = $this->User->getEmployee();
        $retunDB = new WDBTable();
        $retunDB->tableName = "Announcements";
        $retunDB->idColName = "AnnouncementId";
        // IN CASE OF MANAGER NEED TO FIND ALL POSITIONS UNDER AND SEARCH BY ARRAY.         
        
        $createdAnnouncement = AnnouncementsQuery::create()
            ->filterByCreatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find();

        $updatedAnnouncement = AnnouncementsQuery::create()
            ->filterByUpdatedAt($date,Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($date,Criteria::LESS_THAN)
            ->filterByCompanyId($empRec->getCompanyId())
            ->find();
        $branch = $empRec->getBranchId();
        $designation = $empRec->getDesignationId();
        $orgUnitId = $empRec->getOrgUnitId();
        $arr = array();
        $updatedArr = array();
        foreach ($createdAnnouncement as $announcement){

            $announcementBranches = explode(',',$announcement->getBranches());
            $announcementDesignations = explode(',',$announcement->getDesignations());
            $announcementOrgUnits = explode(',',$announcement->getOrgUnits());

            if(!in_array($branch,$announcementBranches)){
                continue;
            }
            if(!in_array($designation,$announcementDesignations)){
                continue;
            }
            if(!in_array($orgUnitId,$announcementOrgUnits)){
                continue;
            }

            $resArry = $announcement->toArray();
            /* set read status : start */
            $resArry['readAt'] = AnnouncementEmployeeMapQuery::create()
                                            ->select(['ReadAt'])
                                            ->filterByEmployeeId($empRec->getEmployeeId())
                                            ->filterByAnnouncementId($resArry['AnnouncementId'])
                                            ->findOne();
            /* set read status : end */

            $arr[] = $resArry;
        }
        foreach ($updatedAnnouncement as $announcement){

            $announcementBranches = explode(',',$announcement->getBranches());
            $announcementDesignations = explode(',',$announcement->getDesignations());
            $announcementOrgUnits = explode(',',$announcement->getOrgUnits());

            if(!in_array($branch,$announcementBranches)){
                continue;
            }
            if(!in_array($designation,$announcementDesignations)){
                continue;
            }
            if(!in_array($orgUnitId,$announcementOrgUnits)){
                continue;
            }

            $resArry = $announcement->toArray();
            /* set read status : start */
            $resArry['readAt'] = AnnouncementEmployeeMapQuery::create()
                                            ->select(['ReadAt'])
                                            ->filterByEmployeeId($empRec->getEmployeeId())
                                            ->filterByAnnouncementId($resArry['AnnouncementId'])
                                            ->findOne();
            /* set read status : end */
            
            $updatedArr[] = $resArry;
        }
        $retunDB->created = $arr;
                                       
        $retunDB->updated = $updatedArr;

        return $retunDB;
    }
    
    public function getTableName()
    {
        return "Announcements";
    }

    public function doRecordsToReceive($date,WDBTable $data)
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

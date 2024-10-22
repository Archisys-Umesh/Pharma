<?php

namespace BI\manager;

use App\System\App;
use entities\Employee;
use entities\HrUserDates;
use entities\EmployeeQuery;
use entities\PositionsQuery;
use entities\HrUserDatesQuery;
use entities\TerritoriesQuery;
use Modules\System\Controllers\Orgstructure;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Org Manager
 *
 * @author Chintan
 */

class OrgManager
{
    public static function getManagerPositions($position_id)
    {
        
        $manager = $position_id;
        $managers = [];
        while($manager > 0)
        {

        $manager = \entities\PositionsQuery::create()
                ->select(["ReportingTo"])
                ->filterByPositionId($position_id)
                ->findOne();

        if($manager > 0) {
            $managers[] = $manager;
            $position_id = $manager;                    
        }

        }

        return $managers;
    }

    Static function getUnderPositions($position_id)
    {
        $under = [$position_id];

        $positions = [];
        while(count($under) > 0)
        {

        $under = \entities\PositionsQuery::create()
                ->select(["PositionId"])
                ->filterByReportingTo($position_id)
                ->find()->toArray();


        if(count($under) > 0) {
            $positions = array_merge($positions,$under);
            $position_id = $under;                    
        }

        }

        return $positions;
    }

    public function getTerritoriesUnder($positions)
    {
       $terr =  TerritoriesQuery::create()
                ->select(["TerritoryId"])
                ->filterByPositionId($positions)
                ->find()->toArray();
        return $terr;
    }    

    public function resetCAVFlag($company_id)
    {
        PositionsQuery::create()->filterByCompanyId($company_id)->update(["CavFlag" => ""]);
    }

    public function updateCAV($company_id,$org_unit_id)
    {
        $positions = PositionsQuery::create()
                    ->filterByCompanyId($company_id)
                    ->filterByOrgUnitId($org_unit_id)
                    ->joinWithOrgUnit()
                    ->orderByReportingTo()
                    ->find();                    
        foreach($positions as $p)
        {
            echo "Calculating for ".$p->getOrgUnit()->getUnitName()." : ".$p->getPositionName()."<br/>".PHP_EOL;

            $managers = $this->getManagerPositions($p->getPrimaryKey());
            $down = $this->getUnderPositions($p->getPrimaryKey());            

            $territories = $this->getTerritoriesUnder(array_merge([$p->getPositionId()],$down));
            if($territories == null)
            {
                $territories = [];
            }

            $p->setCavPositionsUp(implode(",",$managers));
            $p->setCavPositionsDown(implode(",",$down));
            $p->setCavTerritories(implode(",",$territories));
            $p->setCavFlag("C");
            $p->setCavDate(date("Y-M-d"));
            $p->save();

            echo "----------> Manager : ".implode(",",$managers)."<br/>".PHP_EOL;
            echo "----------> Team : ".implode(",",$down)."<br/>".PHP_EOL;
            echo "----------> Terr : ".implode(",",$territories)."<br/>".PHP_EOL;

            echo " <hr/><br/>".PHP_EOL;
        }

            echo PHP_EOL."Done";
    }


    Static function getMyManagers(Employee $emp) 
    {
        
        $position = PositionsQuery::create()->findPk($emp->getPositionId());

        $managers = $position->getCavPositionsUp();        

        return explode(",",$managers);
        
    }

    Static function getMyTeam(Employee $emp) 
    {
        $position = PositionsQuery::create()->findPk($emp->getPositionId());

        $team = $position->getCavPositionsDown();

        return explode(",",$team);
        
    }

    Static function getMyTerritories(Employee $emp) 
    {

        $position = PositionsQuery::create()->findPk($emp->getPositionId());

        $terr = $position->getCavTerritories();

        $terr_array = explode(",",$terr);

        $terr_array = array_diff($terr_array,[""]);

        return $terr_array;
        
    }

    Static function getMyTerritoriesByPosition($position_id,$self=false) 
    {

        $position = PositionsQuery::create()->findPk($position_id);

        $terr = $position->getCavTerritories();        
        $terr_array = [];
        if($terr != null or $terr != "")
        {
            $terr_array = explode(",",$terr);
        }
        

        if($self)
        {
            $terr = TerritoriesQuery::create()
                        ->select(["TerritoryId"])
                        ->filterByPositionId($position_id)
                        ->find()->toArray();
            $terr_array = array_merge($terr_array,$terr);
        }

        return $terr_array;
        
    }

    Static function getMyTerritoriesByPositionVacant($position_id) 
    {

        $position = PositionsQuery::create()->findPk($position_id)->getCavPositionsDown();

        if($position == "")
        {
            return [];
        }

        $position = explode(",",$position);

        $position_occupied = EmployeeQuery::create()
                                ->select(['PositionId'])
                                ->filterByStatus(1)
                                ->filterByPositionId($position)
                                ->find()->toArray();

        // FINDS VACANT POSITIONS
        $vacant_positions = array_diff($position,$position_occupied);

        $terr = TerritoriesQuery::create()
                        ->select(['TerritoryId'])
                        ->filterByPositionId($vacant_positions)
                        ->find()->toArray();    

        return $terr;
        
    }

    Static function getMyTerritoriesByPositionNewJoines($position_id) 
    {

        
        $position = explode(",",PositionsQuery::create()->findPk($position_id)->getCavPositionsDown());        

        $position = array_diff($position,[""]);

        // NEW JOINEES ARE 6 MONTHS OR LESS
        $from_date = date('Y-m-d', strtotime("-180 days"));

        $newjoinees = HrUserDatesQuery::create()
                            ->select(['EmployeeId'])
                            ->filterbyJoinDate($from_date,Criteria::GREATER_EQUAL)
                            ->find()->toArray();

        $position_newJoined = EmployeeQuery::create()                                
                                ->select(['PositionId'])
                                ->filterByStatus(1) 
                                ->filterByEmployeeId($newjoinees)
                                ->find()->toArray();

        // FINDS NEW JOINEE
        $positions = array_intersect($position,$position_newJoined);
      
        $terr = TerritoriesQuery::create()
                        ->select(['TerritoryId'])
                        ->filterByPositionId($positions)
                        ->find()->toArray();    

         return $terr;        
    }

    
    Static function getMyPositions(Employee $emp) 
    {

        $position = PositionsQuery::create()->findPk($emp->getPositionId());

        $pos = trim($position->getCavPositionsDown());
            
        $position_array = explode(",",$pos);

        $position_array = array_diff($position_array,[""]);

        $position_array = array_merge($position_array,[$emp->getPositionId()]);

        return $position_array;
        
    }

    Static function getMyPositionsByPositionId($position_id) 
    {

        $position = PositionsQuery::create()->findPk($position_id);

        $pos = trim($position->getCavPositionsDown());
            
        $position_array = explode(",",$pos);

        $position_array = array_diff($position_array,[""]);

        $position_array = array_merge($position_array,[$position_id]);

        return $position_array;
        
    }

}
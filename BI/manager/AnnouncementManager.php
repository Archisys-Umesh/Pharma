<?php

namespace BI\manager;

use entities\AnnouncementEmployeeMap;
use entities\AnnouncementsQuery;
use entities\EmployeeQuery;
use Modules\OfflineSync\Models\Announcement;

class AnnouncementManager 
{
    public function mapEmployeeToAnnouncement() {
        echo "Checking for new announcement that needs to map with employee... : Start" . PHP_EOL;
        $announcement = AnnouncementsQuery::create()
                            ->filterByIsEmployeeMapped(false)
                            ->findOne();

        if (!empty($announcement)) {
            echo "Mapping employee for the announcement... : " . $announcement->getAnnouncementId() . PHP_EOL;

            $branches = explode(',', $announcement->getBranches());
            $designations = explode(',', $announcement->getDesignations());
            $orgUnitIds = explode(',', $announcement->getOrgUnits());

            $employees = EmployeeQuery::create()
                            ->select(['EmployeeId'])
                            ->filterByStatus(1)
                            ->filterByBranchId($branches)
                            ->filterByDesignationId($designations)
                            ->filterByOrgUnitId($orgUnitIds)
                            ->find()
                            ->toArray();
            
            foreach ($employees as $employeeId) {
                $announcementmap = new AnnouncementEmployeeMap;
                $announcementmap->setAnnouncementId($announcement->getAnnouncementId());
                $announcementmap->setEmployeeId($employeeId);
                $announcementmap->save();
            }

            $announcement->setIsEmployeeMapped(true);
            $announcement->save();
        }

        echo "Checking for new announcement that needs to map with employee... : End" . PHP_EOL;
    }
}
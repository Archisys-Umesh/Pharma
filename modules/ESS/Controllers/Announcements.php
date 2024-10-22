<?php

declare (strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use entities\AnnouncementEmployeeMapQuery;

class Announcements extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @OA\POST(
     *     path="/api/announcement/read",
     *     tags={"Announcements"},
     *     description="Read announcement",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="announcement_id",
     *         in="query",
     *         description="Announcement Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function readAnnouncement()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $announcementId = $this->app->Request()->getParameter("announcement_id");
                $employeeId = $this->app->Auth()->getUser()->getEmployeeId();

                if (!empty($announcementId) && !empty($announcementId)) {
                    $announcementMap = AnnouncementEmployeeMapQuery::create()
                                            ->filterByEmployeeId($employeeId)
                                            ->filterByAnnouncementId($announcementId)
                                            ->findOne();
                    
                    if (!empty($announcementMap)) {
                        $announcementMap->setReadAt(date('Y-m-d H:i:s'));
                        $announcementMap->save();

                        $this->apiResponse([], 200, "Read status updated.");
                    } else {
                        $this->apiResponse([], 400, 'Announcement mapping not found with the employee!');
                    }
                } else {
                    $this->apiResponse([], 400, 'Required parameters not found!');
                }

            break;
        endswitch;
    }
}
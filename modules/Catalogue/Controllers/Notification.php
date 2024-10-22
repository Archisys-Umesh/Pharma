<?php declare(strict_types=1);

namespace Modules\Catalogue\Controllers;

use entities\BrandCampiagnQuery;
use entities\EmployeeQuery;

class Notification extends \App\Core\BaseController
{
    public function startBrandCampiagnNotification(){
        $date = date('Y-m-d');

        $brandCampiagn = BrandCampiagnQuery::create()
            ->select(['CampiagnName','OrgUnitId'])
            ->filterByStartDate($date)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->groupByOrgUnitId()
            ->find()->toArray();

        foreach ($brandCampiagn as $campiagn){
            $title = "Start Brand Campiagn";
            $message = "Your ".$campiagn['CampiagnName'].' ' ."will start on".$date;

            $employees = EmployeeQuery::create()
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                ->filterByOrgUnitId($campiagn['OrgUnitId'])
                ->find()
                ->toArray();
            foreach ($employees as $emp) {
                $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
            }
        }
    }

    public function endBrandCampiagnNotification(){
        $date = date('Y-m-d');

        $brandCampiagn = BrandCampiagnQuery::create()
            ->select(['CampiagnName','OrgUnitId'])
            ->filterByEndDate($date)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->groupByOrgUnitId()
            ->find()->toArray();

        foreach ($brandCampiagn as $campiagn){
            $title = "Start Brand Campiagn";
            $message = "Your ".$campiagn['CampiagnName'].' ' ."will end on".$date;

            $employees = EmployeeQuery::create()
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                ->filterByOrgUnitId($campiagn['OrgUnitId'])
                ->find()
                ->toArray();
            foreach ($employees as $emp) {
                $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
            }
        }
    }
}
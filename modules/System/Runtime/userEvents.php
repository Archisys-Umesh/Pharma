<?php

declare(strict_types=1);

namespace Modules\System\Runtime;

class userEvents {

    protected $app;

    public function __construct(\App\System\App $app) {
        $this->app = $app;
    }

    public function welcomeEvent(\entities\Company $company, $password) {
        $data = [
            "username" => $company->getOwnerEmail(),
            "password" => $password,
            "ioslink" => _androidAppLink,
            "androidlink" => _iosAppLink,
            "baseurl" => $this->app->Router()->baseUrl()
        ];
        $bc = new \App\Core\BaseController();
        $supportEmail = $bc->getConfig("System", "supportEmail");
        $body = $this->app->Renderer()->render("email\OwnerWelcomeMail.twig", $data, false);
        //\App\Utils\Emails::sendEmailFromAdmin($company->getOwnerEmail(), 'Welcome to xPensys', $body,$supportEmail);
    }

    public function inviteUserEvent($employee, $password) {
        $data = [
            "companyName" => $employee->getCompany()->getCompanyName(),
            "username" => $employee->getEmail(),
            "password" => $password,
            "ioslink" => _androidAppLink,
            "androidlink" => _iosAppLink,
            "baseurl" => $this->app->Router()->baseUrl()
        ];
        $body = $this->app->Renderer()->render("email\welcomeMail.twig", $data, false);
        //\App\Utils\Emails::sendEmail($employee->getEmail(), 'Welcome to xPensys', $body,$employee->getCompany()->getCompanyId());
    }

    public function resetPasswordEvent(\entities\Users $user) {
        $defaultConfig = $user->getCompany()->getConfigurations()->getFirst();
        $company = $user->getCompany();
        $name = $user->getName();
        $empId = $user->getEmployee()->getEmployeeId();
        $isDefaultUser = $user->getDefaultUser();
        $data = ['username' => $name,
            'adminName' => $company->getOwnerName(),
            'url' => $this->app->Router()->baseUrl("hr/profileForm/$empId"),
            'ioslink' => _androidAppLink,
            'androidlink' => _iosAppLink,
            'baseurl' => $this->app->Router()->baseUrl()];
        $body = $this->app->Renderer()->render("email/forgotPassword.twig", $data, false);
        if ($isDefaultUser) {
            $bc = new \App\Core\BaseController();
            $to = $bc->getConfig("System", "superAdminEmail");
        } else {
            $to = $defaultConfig->getAdminEmail();
        }
        //\App\Utils\Emails::sendEmailFromAdmin($to, "Password Reset Request : $name" , $body);
    }

    public function passwordChangedEvent(\entities\Users $user, $password) {
        $name = $user->getName();
        $username = $user->getUsername();
        $companyId = $user->getCompany()->getCompanyId();
        $data = ['name' => $name,
            'username' => $username,
            'password' => $password,
            'ioslink' => _androidAppLink,
            'androidlink' => _iosAppLink,
            'baseurl' => $this->app->Router()->baseUrl()];
        $body = $this->app->Renderer()->render("email/passwordChanged.twig", $data, false);
        //\App\Utils\Emails::sendEmail($username, "Password Reset !!" , $body,$companyId);
    }

    public function extendTripEvent(\entities\Users $user, \entities\Trips $trip) {
        $name = $user->getName();
        $username = $user->getUsername();
        $companyId = $user->getCompany()->getCompanyId();
        $data = ['name' => $name,
            'username' => $username,
            'trip' => $trip,
            'ioslink' => _androidAppLink,
            'androidlink' => _iosAppLink,
            'baseurl' => $this->app->Router()->baseUrl()];
        $body = $this->app->Renderer()->render("email/extendTrip.twig", $data, false);
        //\App\Utils\Emails::sendEmail('umesh.chhatrala@archisys.in', "Trip Extension Request Received" , $body,$companyId);
    }

}

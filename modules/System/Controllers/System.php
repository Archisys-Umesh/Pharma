<?php declare(strict_types=1);

namespace Modules\System\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use entities\GeoStateQuery;
use entities\GeoTownsQuery;
use entities\OrgUnitQuery;
use entities\OutlettypemodulesQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class System extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;

    }

    public function userList()
    {

        if ($this->isAjax()) {

            if ($_GET['action'] == "user") {

                $users = \entities\UsersQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithRoles();

                if ($this->app->Auth()->checkPerm("super_admin")) {
                    $users->joinWithCompany();
                } else {
                    $users->findByCompanyId($this->app->Auth()->CompanyId());
                }

                $this->json(["data" => $users->find()->toArray()]);
            }

        } else {
            $this->app->Renderer()->render("system/userList.twig", $this->data);
        }
    }


    public function userForm($id = 0)
    {

        $roleQuery = \entities\RolesQuery::create();

        if (!$this->app->Auth()->checkPerm("super_admin")) {
            $roleQuery->filterByRolePrivate(0); // Not Private
        }

        $roles = $roleQuery->find()->toKeyValue("roleId", "roleName");


        $f = FormMgr::formHorizontal();

        if ($this->app->Auth()->checkPerm("super_admin")) {
            $companyList = [];
            $companies = \entities\Base\CompanyQuery::create()->find();
            foreach ($companies as $c) {
                $companyList[$c->getCompanyId()] = $c->getCompanyCode() . " | " . $c->getCompanyName();
            }
            $f->add(['CompanyId' => FormMgr::select()->options($companyList)->label('Company')]);
        }
        $f->add([
            'Name' => FormMgr::text()->label('Name *')->required(),
            'Username' => FormMgr::email()->label('Email *')->required(),
            'Phone' => FormMgr::number()->label('Phone *')->required(),
            'Password' => FormMgr::password()->label('Password')->set(['addon-before' => '#']),
            'RoleId' => FormMgr::select()->options($roles)->label('Role'),
            'Status' => FormMgr::select()->options($this->getConfig("System", "userStatus"))->label('Status'),

        ]);

        // Employee
        $this->data['form_name'] = "Add Users";
        if (isset($_GET['emp'])) {
            $f->add(["EmployeeId" => FormMgr::hidden()->value($_GET['emp'])]);
            $emp = \entities\EmployeeQuery::create()->findPk($_GET['emp']);
            if ($emp) {
                $f->add([
                    "Name" => FormMgr::text()->label('Name *')->required()->value($emp->getFirstName() . " " . $emp->getLastName()),
                    "Username" => FormMgr::email()->label('Email *')->required()->value($emp->getEmail()),
                    'Phone' => FormMgr::number()->label('Phone *')->required()->value($emp->getPhone()),
                ]);

            }
        } elseif ($id > 0) {
            $this->data['form_name'] = "Edit Users";
            $emps = \entities\UsersQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->select("EmployeeId")
                ->find()->toArray();

            $unmappedEmps = \entities\EmployeeQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                //->filterByEmployeeId($emps, \Propel\Runtime\ActiveQuery\Criteria::NOT_LIKE)
                ->find();
            $employes = [0 => "-"];
            foreach ($unmappedEmps as $emp) {
                $employes[$emp->getEmployeeId()] = $emp->getEmployeeCode() . " | " . $emp->getFirstName() . " " . $emp->getLastName();
            }

            $f->add([
                'EmployeeId' => FormMgr::select()->options($employes)->label('Employee'),
            ]);

        }

        $user = new \entities\Users();
        if ($id > 0) {
            $user = \entities\UsersQuery::create()->findPk($id);
            $vals = $user->toArray();
            $vals["Password"] = "";
            $adminEmail = $user->getCompany()->getOwnerEmail();
            if ($vals['Username'] == $adminEmail)
                $f->add(['RoleId' => FormMgr::select()->options($roles)->label('Role')->disabled()]);

            $f->val($vals);
            if ($user->getEmployeeId() > 0) {
                unset($f['EmployeeId']);
            }
        } else {
            $f->add([
                "emailcheck" => FormMgr::checkbox()->label('Send Welcome Email')->checked()
            ]);
        }

        if ($this->app->isPost()) {
            if ($f->validate()) {
                if (!$this->app->Auth()->checkPerm("super_admin")) // Not Super Admin
                {
                    $user->setCompanyId($this->app->Auth()->CompanyId());
                }
                $user->fromArray($_POST);
                if (isset($_POST['Password'])) {
                    $user->setPassword(md5($_POST['Password']));
                }
                $user->setPhone($_POST['Phone']);
                $user->save();

                if($_POST['Status'] == 0){
                    $empId = $user->getEmployeeId();

                    $expenses = \entities\ExpensesQuery::create()
                                        ->select('ExpId')
                                        ->filterByEmployeeId($empId)
                                        ->filterByExpenseStatus(1)
                                        ->find()->toArray();

                    $updateExp = \entities\ExpensesQuery::create()
                                        ->filterByExpId($expenses)
                                        ->update(array('ExpenseStatus' => 3));
                }
                //welcome Email
                if (isset($_GET['emp'])) {
                    if (isset($_POST['emailcheck'])) {

                        $email = $_POST['Username'];
                        $company = $user->getCompany();
                        $subject = "Welcome! To " . $company->getCompanyName();

                        $data = [
                            "Title" => $company->getCompanyName(),
                            "username" => $user->getUsername(),
                            "password" => $_POST['Password'],
                            "ioslink" => _iosAppLink,
                            "androidlink" => _androidAppLik
                        ];
                        $body = $this->app->Renderer()->render("system\welcomeMailTemplate.twig", $data, false);

                        //\App\Utils\Emails::sendEmail($email, $subject, $body);
                    }
                }


                $this->runModalScript("reloadGrid()");
                return;

            } else {
                $f->val($_POST);
            }

        }


        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function userResetPwd($id = 0)
    {
        $f = FormMgr::formHorizontal();

        $f->add([
            'Username' => FormMgr::text()->label('Email')->readonly(true),
            'Password' => FormMgr::password()->label('Password')->set(['addon-before' => '#'])->required(),
        ]);

        $user = new \entities\Users();
        if ($id > 0) {
            $user = \entities\UsersQuery::create()->findPk($id);
            $vals = $user->toArray();
            $vals["Password"] = "";
            $f->val($vals);
        }

        if ($this->app->isPost()) {

            if ($f->validate()) {
                if ($user->getEmployeeId() > 0) {
                    $event = new \Modules\System\Runtime\userEvents($this->app);
                    $event->passwordChangedEvent($user, $_POST['Password']);
                }
                $user->setPassword(md5($_POST['Password']));
                $user->save();
                $this->runModalScript("reloadGrid()");
                return;

            } else {

                $f->val($_POST);
            }

        }

        $this->data['form_name'] = "Reset Password";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

    }

    public function roleForm($id = 0)
    {
        $this->data['form_name'] = "Roles";
        $f = FormMgr::formHorizontal();

        $perkeys = \entities\RolePermsQuery::create()->find()->toKeyValue("permKey", "permDesc");
        $perkeysdata = \entities\RolePermsQuery::create()->find();
        $perm = FormMgr::group();
        $pers = array();
        foreach ($perkeys as $key => $desc) {
            $perm->add([$key => FormMgr::checkbox()
                ->label($desc)
                ->value($key)]);
            //array_push($pers, array($key =>$desc));
        }

        $f->add([
            'RoleName' => FormMgr::text()->label('Role Name *')->required(),
            'RoleDesc' => FormMgr::text()->label('Description *')->required(),
            'RolePrivate' => FormMgr::select()->options($this->getConfig("System", "userStatus"))->label('Keep Private')
        ]);

        $role = new \entities\Roles();
        $this->data['form_name'] = "Add Roles";
        if ($perkeysdata) {
            $checked = 0;
            if ($id > 0) {
                $role = \entities\RolesQuery::create()->findPk($id);
                $vals = $role->toArray();
                $checked = 0;
            }
            foreach ($perkeysdata as $key => $desc) {
                $checked = 0;
                if ($role->getRolePermissions()) {
                    $data = explode(",", $vals['RolePermissions']);
                    foreach ($data as $v) {
                        if ($desc->getPermKey() == $v) {
                            $checked = 1;
                        }

                    }
                }
                array_push($pers, array(
                    "permKey" => $desc->getPermKey(),
                    "permDesc" => $desc->getPermDesc(),
                    "checked" => $checked
                ));

            }

        }
        if ($id > 0) {
            $role = \entities\RolesQuery::create()->findPk($id);
            $vals = $role->toArray();
            $this->data['form_name'] = "Edit Roles";
            if ($vals['RolePermissions'] != "") {
                $vals['RolePermissions'] = explode(",", $vals['RolePermissions']);
                foreach ($vals['RolePermissions'] as $v) {
                    if (isset($perm[$v])) {
                        $perm[$v]->attr("checked", "checked");
                    }
                }
            }

            $f->val($vals);

        }

        $this->data['RolePermissions'] = $pers;
        if ($this->app->isPost()) {
            if ($f->validate()) {
                if (isset($_POST['RolePermissions'])) {
                    $_POST['RolePermissions'] = implode(",", $_POST['RolePermissions']);
                } else {
                    $_POST['RolePermissions'] = "";
                }
                $role->fromArray($_POST);
                $role->save();
                //$f->val($role->toArray());
                $url = $this->app->Router()->getPath("sys_superSettings");
                $this->app->Response()->redirect($url);
                return;

            } else {
                $f->val($_POST);
            }

        }


        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("system/addUserRole.twig", $this->data);
    }


    public function masters()
    {
        $companyId = $this->app->Auth()->CompanyId();

        if ($this->isAjax()) {

            if ($_GET['action'] == "tree") {

                $position = \entities\PositionsQuery::create()->orderByReportingTo()->findByCompanyId($companyId);
                $arrayCategories = [];
                $pk = $this->app->Request()->getParameter("pk", 0);

                foreach ($position as $p) {
                    $parent = $p->getReportingTo();
                    $currentEmp = [];
                    $emps = $p->getEmployeesRelatedByPositionId();
                    if ($emps->count() > 0) {
                        foreach ($emps as $e) {
                            if ($e->getStatus() == 1) {
                                array_push($currentEmp, $e->getFirstName() . " " . $e->getLastName() . '- ' . $e->getEmployeeCode());
                            }
                        }
                    }
                    if ($parent == 0) {
                        $parent = "#";
                    }
                    $arrayCategories[] = array("id" => $p->getPositionId(), "parent" => $parent, "text" => implode(",", $currentEmp) . ' - ' . $p->getPositionName() . " | " . $p->getPositionCode(), "icon" => "fa fa-folder");
                }

                $this->json($arrayCategories);
            }

            if ($_GET['action'] == "designation") {
                $this->json(array("data" => \entities\DesignationsQuery::create()->findByCompanyId($companyId)->toArray()));
            }
            if ($_GET['action'] == "branch") {
                $this->json(array("data" => \entities\BranchQuery::create()->leftJoinWithGeoState()->findByCompanyId($companyId)->toArray()));
            }


            if ($_GET['action'] == "unit") {
                ini_set('memory_limit', '-1');
                $this->json(array("data" => \entities\OrgUnitQuery::create()
                    //->joinWithCurrencies()
                    ->leftjoinWithGeoCountry()
                    ->findByCompanyId($companyId)->toArray()));
            }

            if ($_GET['action'] == "policy") {

                $dat = $this->json(array("data" => \entities\PolicyMasterQuery::create()
                    ->joinWithOrgUnit()
                    ->joinWithCurrencies()
                    ->findByCompanyId($companyId)->toArray()));

            }
            if ($_GET['action'] == "outletType") {

                $this->json(array("data" => \entities\OutletTypeQuery::create()
                    ->findByCompanyId($companyId)->toArray()));
//                $this->data['rowButtons'] = ["outlettypesmodule" => "zmdi zmdi-layers"];
            }
            if ($_GET['action'] == "language") {
                $this->json(array("data" => \entities\LanguageQuery::create()->find()->toArray()));
            }


        } else {
            $this->app->Renderer()->render("system/orgStructure.twig", $this->data);
        }
    }

    public function designationForm($id = 0)
    {
        $this->data['form_name'] = "Designation";
        $datachange = $this->app->Request()->getParameter("datachange", "");

        if ($datachange == "checkUnique") {
            $Designation = $this->app->Request()->getParameter("Designation");
            $exists = \entities\DesignationsQuery::create()
                ->filterByDesignationId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByDesignation($Designation)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($exists > 0) {
                $this->json(array("status" => false));
            } else {
                $this->json(array("status" => true));
            }
            return;
        }


        $f = FormMgr::formHorizontal();

        $f->add([
            'Designation' => FormMgr::text()->label('Name *')->required()->id('Designations')->datachange('checkUnique')->class('text-uppercase')->minlength(5)->pattern(__NOSPACE_PATERN),
            'DesignationColor' => FormMgr::select()->options($this->getConfig("System", "designationColor"))->label('Designation Color'),
        ]);

        $designation = new \entities\Designations();
        $this->data['form_name'] = "Add Designation";
        if ($id > 0) {
            $designation = \entities\DesignationsQuery::create()->findPk($id);
            $designation->setCompanyId($this->app->Auth()->CompanyId());
            $vals = $designation->toArray();
            $f->val($vals);
            $this->data['canDelete'] = true;
            $this->data['form_name'] = "Edit Designation";
        }
        if ($this->app->isPost()) {
            $otherRows = \entities\DesignationsQuery::create()
                ->filterByDesignation($_POST['Designation'])
                ->filterByDesignationId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($otherRows > 0) {
                $this->app->Session()->setFlash("error", "Sorry Designation already exists !!");
                $f->val($_POST);
            } else {
                if ($f->validate()) {
                    if ($_POST['buttonValue'] == "delete") {
                        try {

                            $designation->delete();

                        } catch (\Propel\Runtime\Exception\PropelException $ex) {
                            $this->data['form'] = $f->html();
                            $this->app->Session()->setFlash("error", "Sorry unable to delete !!");
                            $this->app->Renderer()->render("system/designationForm.twig", $this->data);
                            return;
                        }

                    } else {
                        $_POST['Designation'] = strtoupper($_POST['Designation']);
                        $designation->fromArray($_POST);
                        $designation->setCompanyId($this->app->Auth()->CompanyId());
                        $designation->save();
                    }
                    $this->runModalScript("reloadGridDesignation()");
                    return;

                } else {
                    $f->val($_POST);
                }
            }
        }


        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("system/designationForm.twig", $this->data);
    }

    public function policyForm($id = 0)
    {
        $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
        $this->data['title'] = "Policy Master";
        $this->data['form_name'] = "Policy";
        $this->data['pk'] = "PolicyId";

        $this->data['rowButtons'] = [
            "sys_managePolicy" => "zmdi zmdi-layers"
        ];


        $f = FormMgr::formHorizontal();
        $f->add([
            'PolicyName' => FormMgr::text()->label('Name *')->required(),
            'PolicyCode' => FormMgr::text()->label('ShortCode'),
            'CurrencyId' => FormMgr::select()->options($currency)->label('Currency'),
            'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('Unit'),
        ]);
        $record = new \entities\PolicyMaster();
        $this->data['form_name'] = "Add Policy";
        if ($id > 0) {
            $record = \entities\PolicyMasterQuery::create()->findPk($id);
            $f->val($record->toArray());
            $this->data['form_name'] = "Edit Policy";
        }
        if ($this->app->isPost() && $f->validate()) {

            $record->fromArray($_POST);
            $record->setCompanyId($this->app->Auth()->CompanyId());
            $record->save();
            if ($id == 0 && isset($_GET['grade_id'])) {
                (new \entities\GradePolicy())
                    ->setPolicyId($record->getPolicyId())
                    ->setGpId($_GET['grade_id'])
                    ->save();
            }
            $this->runModalScript("loadGrid()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);


    }


    function branchForm($id = 0)
    {
        $this->data['form_name'] = "Branch/HQ";
        $datachange = $this->app->Request()->getParameter("datachange", "");

        if ($datachange == "checkUniqueBranch") {
            $Branchname = $this->app->Request()->getParameter("Branchname");
            $exists = \entities\BranchQuery::create()
                ->filterByBranchId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByBranchname($Branchname)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($exists > 0) {
                $this->json(array("status" => false));
            } else {
                $this->json(array("status" => true));
            }
            return FALSE;
        }

        $States = GeoStateQuery::create()->find()->toKeyValue("Istateid", "Sstatename");
        $f = FormMgr::formHorizontal();
        $f->add([
            'Branchname' => FormMgr::text()->label('Name/HQ *')->required()->id('Branchname')->datachange('checkUniqueBranch')->class('text-uppercase')->minlength(5)->pattern(__NOSPACE_PATERN),
            'Branchcode' => FormMgr::text()->label('Branch Code *')->required()->class('text-uppercase'),
            'Istateid' => FormMgr::select()->options($States)->label('State *')->required(),
//            'Branchlocation' => FormMgr::text()->label('City')->required()->id('Branchlocation')->datatoggle("locationAutoComplete"),
        ]);

        $branch = new \entities\Branch();
        $this->data['form_name'] = "Add Branch/HQ";
        if ($id > 0) {
            $branch = \entities\BranchQuery::create()->findPk($id);
            $vals = $branch->toArray();
//            $location = $branch->getGeoCity()->getScityname()." | ".$branch->getGeoCity()->getGeoState()->getSstatename();
//            $f['Branchlocation']->sudoValue($location);
            $f->val($vals);
            $this->data['form_name'] = "Edit Branch/HQ";

        }

        if ($this->app->isPost()) {
            $otherRows = \entities\Base\BranchQuery::create()
                ->filterByBranchname($_POST['Branchname'])
                ->filterByBranchId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($otherRows > 0) {
                $this->app->Session()->setFlash("error", "Sorry Branch/HQ already exists !!");
                $f->val($_POST);
            } else {
//                if($_POST['Branchlocation'] > 0 ){
                if ($f->validate()) {
                    $_POST['Branchname'] = strtoupper($_POST['Branchname']);
                    $branch->fromArray($_POST);
                    $branch->setCompanyId($this->app->Auth()->CompanyId());
                    $branch->save();
                    $this->runModalScript("reloadBranch()");
                    return;

                } else {
                    $f->val($_POST);
                }
//                }else{
//                    $this->app->Session()->setFlash("error","Error, Please Search Location");
//                    $f->val($_POST);
//                }
            }

        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("system/branchForm.twig", $this->data);
    }

    function outletType($id = 0)
    {
//       var_dump("hii");exit;

        $this->data['form_name'] = "Outlet Type";
        $datachange = $this->app->Request()->getParameter("datachange", "");

        if ($datachange == "checkUniqueOutletType") {
            $OutlettypeName = $this->app->Request()->getParameter("OutlettypeName");
            $exists = \entities\OutletTypeQuery::create()
                ->filterByOutlettypeId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByOutlettypeName($OutlettypeName)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($exists > 0) {
                $this->json(array("status" => false));
            } else {
                $this->json(array("status" => true));
            }
            return FALSE;
        }

        $ParentOutletTypes = \entities\OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutlettypeId", "OutlettypeName");

        $ParentOutletTypes[0] = "- None -";
        if ($id > 0) {
            unset($ParentOutletTypes[$id]);
        }
        $orgUnits = OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
        $f = FormMgr::formHorizontal();
        $f->add([
            'OutlettypeName' => FormMgr::text()->label('Name *')->required()->id('OutlettypeName')->datachange('checkUniqueOutletType')->class('text-uppercase')->minlength(5)->pattern(__NOSPACE_PATERN),
            'Outletparent' => FormMgr::select()->options($ParentOutletTypes)->label('Parent'),
            'Isoutletprimary' => FormMgr::checkbox()->label('is Primary')->value(1),
            'isOutletEndCustomer' => FormMgr::checkbox()->label('is EndCustomer')->value(1),
            'isEnabled' => FormMgr::checkbox()->label('isEnabled')->checked()->value(1),
            'OrgUnitId' => FormMgr::select()->options($orgUnits)->label('Org Unit')->class("multi-select")->multiple("multiple")
        ]);

        $outletType = new \entities\OutletType();
        $this->data['form_name'] = "Add OutletType";
        if ($id > 0) {
            $outletType = \entities\OutletTypeQuery::create()->findPk($id);
            $vals = $outletType->toArray();

            if ($outletType->getIsoutletprimary() == 1) {
                $f['Isoutletprimary']->checked();
            }
            if ($outletType->getIsoutletendcustomer() == 1) {
                $f['isOutletEndCustomer']->checked();
            }
            if ($outletType->getIsenabled() == 1) {
                $f['isEnabled']->checked();
            }


            $f->val($vals);
            if ($outletType->getOrgUnitId()!=null){
                $f["OrgUnitId"]->val(explode(",", $outletType->getOrgUnitId()));
            }

            $this->data['form_name'] = "Edit OutletType";

        }

        if ($this->app->isPost()) {
            $OutlettypeName = $this->app->Request()->getParameter("OutlettypeName");
            $otherRows = \entities\OutletTypeQuery::create()
                ->filterByOutlettypeId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByOutlettypeName($OutlettypeName)
                ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            if ($otherRows > 0) {
                $this->app->Session()->setFlash("error", "Sorry Outlet Type already exists !!");
                $f->val($_POST);
            } else {

                if ($f->validate()) {
                    $_POST['OutlettypeName'] = strtoupper($_POST['OutlettypeName']);
                    $orgUnitt = implode(",",$_POST['OrgUnitId']);
                    unset($_POST['OrgUnitId']);
                    $outletType->fromArray($_POST);
                    $outletType->setCompanyId($this->app->Auth()->CompanyId());

                    $outletType->setIsoutletprimary($this->app->Request()->getParameter("Isoutletprimary", 0));
                    $outletType->setIsoutletendcustomer($this->app->Request()->getParameter("isOutletEndCustomer", 0));
                    $outletType->setIsenabled($this->app->Request()->getParameter("isEnabled", 0));
                    $outletType->setOrgUnitId($orgUnitt);


                    $outletType->save();
                    $this->runModalScript("reloadoutletGrid()");
                    return;

                } else {
                    $f->val($_POST);
                }
//                }else{
//                    $this->app->Session()->setFlash("error","Error, Please Search Location");
//                    $f->val($_POST);
//                }
            }

        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }


    function eventType($id = 0)
    {
        $this->data['form_name'] = "Add Event Type";

        $f = FormMgr::formHorizontal();
        $f->add([
            'EventTypeName' => FormMgr::text()->label('Name *')->required()->id('Event Type')->class('text-uppercase'),
        ]);

        $eventType = new \entities\EventTypes();

        if ($id > 0) {
            $eventType = \entities\EventTypesQuery::create()->findPk($id);
            $vals = $eventType->toArray();

            $f->val($vals);
            $this->data['form_name'] = "Edit Event Type";

        }

        if ($this->app->isPost()) {

            if ($f->validate()) {
                $_POST['EventTypeName'] = strtoupper($_POST['EventTypeName']);
                $eventType->fromArray($_POST);
                $eventType->setCompanyId($this->app->Auth()->CompanyId());

                $eventType->save();
                $this->runModalScript("reloadEventType()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function shiftType($id = 0)
    {
        $this->data['form_name'] = "Add Shift Type";

        $f = FormMgr::formHorizontal();
        $f->add([
            'ShiftTypeName' => FormMgr::text()->label('Name *')->required()->id('Shift Type')->class('text-uppercase'),
        ]);

        $shiftType = new \entities\ShiftTypes();

        if ($id > 0) {
            $shiftType = \entities\ShiftTypesQuery::create()->findPk($id);
            $vals = $shiftType->toArray();

            $f->val($vals);
            $this->data['form_name'] = "Edit Shift Type";

        }

        if ($this->app->isPost()) {

            if ($f->validate()) {
                $_POST['ShiftTypeName'] = strtoupper($_POST['ShiftTypeName']);
                $shiftType->fromArray($_POST);
                $shiftType->setCompanyId($this->app->Auth()->CompanyId());

                $shiftType->save();
                $this->runModalScript("reloadShiftType()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function changeAgenda()
    {

        $mediaManager = new MediaManager($this->app);

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->data['title'] = "Agenda";
                $this->data['form_name'] = "Agenda";
                $this->data['cols'] = [
                    "Agenda Image" => "Agendaimage",
                    "Agend Name" => "Agendname",
                    "Agenda Control Type" => "Agendacontroltype",
                    "OrgUnit" => "OrgUnit.UnitName",
                    "Status" => "Status"
                ];
                $this->data['pk'] = "Agendaid";
                $this->data['mediaCol'] = "Agendaimage";
                $this->data['valKeys'] = ["Status" => $this->getConfig("System", "globalStatus")];

                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\AgendatypesQuery::create()
                    ->joinWithOrgUnit()
                    ->orderByAgendaid(Criteria::DESC)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Agendname' => FormMgr::text()->label('Name *')->required()->id('AgendName')->class('text-uppercase')->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Agendacontroltype' => FormMgr::select()->options($this->getConfig("System", "AgendaControlType"))->label('Agenda Control Type'),
                    'Orgunitid' => FormMgr::select()->options($OrgUnitId)->label('OrgUnit'),
                    'Status' => FormMgr::select()->options($this->getConfig("System", "globalStatus"))->label('Status'),
                    'IsPrivate' => FormMgr::checkbox()->label('Is Private'),
                ]);
                $agendas = new \entities\Agendatypes();
                $this->data['form_name'] = "Add Agenda";
                if ($pk > 0) {
                    $agendas = \entities\AgendatypesQuery::create()
                        ->findPk($pk);
                    $f->val($agendas->toArray());
                    $this->data['form_name'] = "Edit Agenda";
                }
                if ($this->app->isPost() && $f->validate()) {
                    if(isset($_POST['IsPrivate'])){
                        $isPrivate = true;
                    }else{
                        $isPrivate = false;
                    }
                    if (!empty($_POST['Agendaimage'])) {
                        $agendas->setAgendaimage((int)$_POST['Agendaimage']);                       
                    }
                    else{                       
                        unset($_POST['Agendaimage']);
                    }
                    $agendas->fromArray($_POST);
                    $agendas->setIsPrivate($isPrivate);
                    $agendas->setCompanyId($this->app->Auth()->CompanyId());
                    $agendas->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("Agendaimage", "Media", [$agendas->getAgendaimage()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }


    function outletOutComes()
    {
        $this->data['title'] = "Outcomes";
        $this->data['form_name'] = "Outcome";
        $this->data['cols'] = [
            "Outcome" => "OutcomeName",
            "Factor" => "OutcomeFactor",
        ];
        $this->data['pk'] = "Id";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\CheckinoutOutcomesQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'OutcomeName' => FormMgr::text()->label('Name *')->required(),
                    'OutcomeFactor' => FormMgr::checkbox()->label('Factor'),
                ]);
                $checkinoutOutcomes = new \entities\CheckinoutOutcomes();
                $this->data['form_name'] = "Add Outcome";
                if ($pk > 0) {
                    $checkinoutOutcomes = \entities\CheckinoutOutcomesQuery::create()
                        ->findPk($pk);
                    $f->val($checkinoutOutcomes->toArray());
                    $this->data['form_name'] = "Edit Outcome";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $checkinoutOutcomes->fromArray($_POST);
                    $checkinoutOutcomes->setCompanyId($this->app->Auth()->CompanyId());
                    $checkinoutOutcomes->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function locationSearch()
    {
        /*$q = $this->app->Request()->getParameter("term");

        //$locations = \entities\GeolocationsQuery::create()->filterByAsciiName($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)->limit(100);
        $locations = \entities\GeoCityQuery::create()->filterByScityname($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)->limit(100)->find();

        $res = [];

        foreach($locations as $loc)
        {
         $res[] = ["label" => $loc->getScityname()." | ".$loc->getGeoState()->getSstatename(),"value" => $loc->toArray(),"id" => $loc->getPrimaryKey()];
        }

        $this->json($res);*/


        /*Org_Unit Country wise search*/
        $array = [];
        $q = $this->app->Request()->getParameter("term");


        if (strlen($q) > 1) {

            //    $locations = \entities\GeoCityQuery::create()
            //            ->filterByIcountryid($orgUnitCountry)
            //            ->filterByScityname($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
            //            ->limit(100)
            //            ->find();

            $locations = \entities\GeoTownsQuery::create()
                //->filterByIcountryid($orgUnitCountry)
                ->joinGeoCity()
                ->filterByStownname($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->limit(100)
                ->find();

            $res = [];
            if ($locations) {
                foreach ($locations as $loc) {
                    $res[] = ["label" => $loc->getStownname()
                        . " | " . $loc->getGeoCity()->getScityname()
                        . " | " . $loc->getGeoCity()->getGeoState()->getSstatename()
                        , "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
                }
            }
        }
        $this->json($res);
    }

    function currency()
    {
        $this->data['title'] = "Currencies";
        $this->data['form_name'] = "Currency";
        $this->data['cols'] = [
            "Name" => "Name",
            "ShortCode" => "Shortcode",
            "Conversion Rate" => "Conversionrate"
        ];
        $this->data['pk'] = "CurrencyId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "list":
                $this->json(["data" => \entities\CurrenciesQuery::create()
                    ->find()->toArray()]);
                break;
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Name' => FormMgr::text()->label('Name *')->required(),
                    'Shortcode' => FormMgr::text()->label('ShortCode'),
                    'Symbol' => FormMgr::text()->label('Symbol'),
                    'Conversionrate' => FormMgr::number()->min(0.01)->step("0.01")->label('Conversion Rate')
                ]);
                $currency = new \entities\Currencies();
                $this->data['form_name'] = "Add Currency";
                if ($pk > 0) {
                    $currency = \entities\CurrenciesQuery::create()->findPk($pk);
                    $f->val($currency->toArray());
                    $this->data['form_name'] = "Edit Currency";
                }
                if ($this->app->isPost()) {
                    $otherRows = \entities\CurrenciesQuery::create()
                        ->filterByName($_POST['Name'])
                        ->filterByCurrencyId($pk, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->find()->count();
                    if ($otherRows > 0) {
                        $this->app->Session()->setFlash("error", "Sorry Currencies already exists !!");
                        $f->val($_POST);
                    } else {
                        if ($f->validate()) {
                            $currency->fromArray($_POST);
                            $currency->save();
                            $this->runModalScript("loadGrid()");
                            return;
                        } else {
                            $f->val($_POST);
                        }
                    }
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function policyMaster()
    {
        $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
        $this->data['title'] = "Policy Master";
        $this->data['form_name'] = "Policy";
        $this->data['cols'] = [
            "Name" => "PolicyName",
            "Policy Code" => "PolicyCode",
            "Currency" => "Currencies.Name",
            "Unit" => "OrgUnit.UnitName",
            "StartDate" => "StartDate",
            "EndDate" => "EndDate"
        ];
        $this->data['pk'] = "PolicyId";

        $this->data['rowButtons'] = [
            "sys_managePolicy" => "zmdi zmdi-layers"
        ];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "list":

                $this->json(["data" => \entities\PolicyMasterQuery::create()
                    ->joinWithOrgUnit()
                    ->joinWithCurrencies()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'PolicyName' => FormMgr::text()->label('Name *')->required(),
                    'PolicyCode' => FormMgr::text()->label('ShortCode'),
                    'CurrencyId' => FormMgr::select()->options($currency)->label('Currency'),
                    'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('Unit'),
                    'StartDate' => FormMgr::date()->label('Start Date*')->required(),
                    'EndDate' => FormMgr::date()->label('End Date*')->required(),
                ]);
                $record = new \entities\PolicyMaster();
                $this->data['form_name'] = "Add Policy";
                if ($pk > 0) {
                    $record = \entities\PolicyMasterQuery::create()->findPk($pk);
                    $f->val($record->toArray());
                    $this->data['form_name'] = "Edit Policy";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $record->fromArray($_POST);
                    $record->setCompanyId($this->app->Auth()->CompanyId());
                    $record->save();
                    if ($pk == 0 && isset($_GET['grade_id'])) {
                        (new \entities\GradePolicy())
                            ->setPolicyId($record->getPrimaryKey())
                            ->setGradeid($_GET['grade_id'])
                            ->setStartDate($record->getStartDate())
                            ->setEndDate($record->getEndDate())
                            ->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;

    }

    function managePolicy($id)
    {

        if ($this->isAjax()) {
            $action = $this->app->Request()->getParameter("action");

            switch ($action) :
                case "list":
                    $keys = \entities\PolicykeysQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
                    $poly = \entities\PolicyRowsQuery::create()->findByPolicyId($id)->toKeyIndex("Policykey");

                    $data = [];

                    foreach ($keys as $k) {

                        $val = ["keys" => $k->getPkeys(), "group" => $k->getPgroup(), "enabled" => 0, "limit1" => 0, "limit2" => 0, "noCheck" => 0, "is_readonly" => 0];
                        if (isset($poly[$k->getPkeys()])) {
                            $val["enabled"] = 1;
                            $val["limit1"] = $poly[$k->getPkeys()]->getLimit1();
                            $val["limit2"] = $poly[$k->getPkeys()]->getLimit2();
                            $val["noCheck"] = $poly[$k->getPkeys()]->getNoCheck();
                            $val["is_readonly"] = $poly[$k->getPkeys()]->getIsReadonly();
                        }
                        array_push($data, $val);
                    }
                    $this->json(["data" => $data]);
                    break;
                case "save":

                    $data = $this->app->Request()->getParameter("data");

                    $collection = new \Propel\Runtime\Collection\ObjectCollection();
                    $collection->setModel(\entities\PolicyRows::class);
                    $keys = [];
                    foreach ($data as $d) {
                        $policyRow = new \entities\PolicyRows();
                        $policyRow->setPolicyId($id);
                        $policyRow->setPolicykey(htmlspecialchars_decode($d['keys']));
                        $policyRow->setLimit1($d['limit1']);
                        $policyRow->setLimit2($d['limit2']);
                        if ($d['noCheck'] == "true") {
                            $policyRow->setNocheck(true);
                        } else {
                            $policyRow->setNocheck(false);
                        }
                        if ($d['is_readonly'] == "true") {
                            $policyRow->setIsReadonly(true);
                        } else {
                            $policyRow->setIsReadonly(false);
                        }
                        $collection->append($policyRow);
                        array_push($keys, $d['keys']);
                    }

                    \entities\PolicyRowsQuery::create()
                        ->findByPolicyId($id)->delete();
                    $collection->save();
                    $this->json(["status" => "okay"]);

                    break;
            endswitch;

        } else {
            $this->data['pm'] = \entities\PolicyMasterQuery::create()->findPk($id);
            $this->app->Renderer()->render("system/managePolicy.twig", $this->data);
        }
    }

    function gradeMaster()
    {
        $this->data['title'] = "Grade Master";
        $this->data['cols'] = [
            "GradeName" => "GradeName",
        ];

        $this->data['pk'] = "Gradeid";


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->data["currency"] = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
                $this->app->Renderer()->render("system/gradeMaster.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\GradeMasterQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":

                $budgets = \entities\BudgetGroupQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Bgid", "GroupName");
                $led = FormMgr::select()->options($budgets)->label('Budgets')->class("multi-select")->multiple("multiple");

                $this->data['form_name'] = "Grade";
                $f = FormMgr::formHorizontal();
                $f->add([
                    'GradeName' => FormMgr::text()->label('Grade Name *')->required(),
                    'Budgets' => $led
                ]);
                $entity = new \entities\GradeMaster();
                $this->data['form_name'] = "Add Grade";
                if ($pk > 0) {
                    $entity = \entities\GradeMasterQuery::create()->findPk($pk);

                    $val = \entities\BudgetGradesQuery::create()->select("Bgid")->findByGradeId($pk)->toArray();
                    $f['Budgets']->val($val);

                    $f->val($entity->toArray());
                    $this->data['form_name'] = "Edit Grade";

                }
                if ($this->app->isPost() && $f->validate()) {
                    $entity->fromArray($_POST);
                    $entity->setCompanyId($this->app->Auth()->CompanyId());
                    $entity->save();
                    if (isset($_POST['Budgets'])) {
                        $budgets = $_POST['Budgets'];
                        \entities\BudgetGradesQuery::create()->findByGradeId($entity->getPrimaryKey())->delete();
                        foreach ($budgets as $bud) {
                            $map = new \entities\BudgetGrades();
                            $map->setBgid($bud);
                            $map->setGradeId($entity->getPrimaryKey());
                            $map->save();
                        }
                    }
                    $this->runModalScript("reloadGridGrade()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
            case "policyList":
                $grade = $this->app->Request()->getParameter("grade");
                $this->json(["data" => \entities\GradePolicyQuery::create()
                    ->joinWithPolicyMaster()
                    ->findByGradeid($grade)
                    ->toArray()]);
                break;
            case "linkAdd":
                $this->data['form_name'] = "Link-Policy";
                $policies = \entities\PolicyMasterQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toKeyValue("PolicyId", "PolicyName");
                $grade = $this->app->Request()->getParameter("grade_id");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'PolicyId' => FormMgr::select()->options($policies)->label('Policy'),
                    'Gradeid' => FormMgr::hidden()->val($grade),
                    'StartDate' => FormMgr::date()->label('Start Date*')->required(),
                    'EndDate' => FormMgr::date()->label('End Date*')->required(),

                ]);
                $entity = new \entities\GradePolicy();
                $this->data['form_name'] = "Add Link-Policy";
                if ($pk > 0) {
                    $entity = \entities\GradePolicyQuery::create()->findPk($pk);
                    $f->val($entity->toArray());
                    if ($entity->getEndDate()) {
                        //$f['EndDate']->val($entity->getEndDate()->format('d/m/Y'));
                        $this->data['form_name'] = "Edit Link-Policy";
                    }
                    $this->data['canDelete'] = true;

                }
                if ($this->app->isPost() && $f->validate()) {
                    if ($_POST['buttonValue'] == "delete") {
                        $entity->delete();
                    } else {
                        //$EndDate =  \DateTime::createFromFormat('d/m/Y',$_POST['EndDate']);
                        //unset($_POST['EndDate']);
                        //$entity->setEndDate($EndDate);
                        $entity->fromArray($_POST);
                        $entity->save();
                    }

                    $this->runModalScript("refreshPolicy()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function compmaster($id)
    {

        $pk = $id;
        $record = new \entities\Company();
        if ($pk > 0) {
            $record = \entities\CompanyQuery::create()->findPk($pk);
            $data = $record->toArray();
            $this->data['compnyData'] = $data;
        }

        $this->app->Renderer()->render("system/companyMaster.twig", $this->data);


    }

    function companymaster()
    {


        $this->data['title'] = "Company Master";
        //$this->data['form_name'] = "Company";
        $this->data['cols'] = [
            "Name" => "CompanyName",
            "City" => "AddrCity",
            "State" => "AddrState",
            "Country" => "AddrCountry",
            "Email" => "CompanyEmail"


        ];
        $this->data['pk'] = "CompanyId";
        $this->data['rowButtons'] = [
            "sys_compmaster" => "zmdi zmdi-layers"
        ];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :

            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;

            case "list":

                $data = $this->json(["data" => \entities\CompanyQuery::create()
                    ->find()->toArray()]);

                break;

//           case "form":
//                 
//                    $f = FormMgr::formHorizontal();
//                    $f->add([
//                        'CompanyName' => FormMgr::text()->label('Company Name *')->required(),                        
//                        'CompanyCode' => FormMgr::text()->label('Company Code'),
//                        'CompanyAddress1' => FormMgr::text()->label('Address line 1 *')->required(),  
//                        'CompanyAddress2' => FormMgr::text()->label('Address line 2 *')->required(),  
//                        'AddrCity' => FormMgr::text()->label('City *')->required(),  
//                        'AddrState' => FormMgr::text()->label('State *')->required(),  
//                        'AddrPincode' => FormMgr::text()->label('Postal/Zip code *')->required(),  
//                        'AddrCountry' => FormMgr::text()->label('Country *')->required(),  
//                        'OwnerName' => FormMgr::text()->label('Owner Name'),  
//                        'CompanyEmail' => FormMgr::text()->label('Email*')->required(),  
//                        'CompanyContactNumber' => FormMgr::text()->label('Contact Number'),  
//                        'CompanyPhoneNumber' => FormMgr::text()->label('Phone Number'),  
//                        'CompanyFax' => FormMgr::text()->label('Fax'),  
//                        'GstNumber' => FormMgr::text()->label('GST Number'),  
//                        'Website' => FormMgr::text()->label('Website'), 
//                        'CompanyType' => FormMgr::select()->options($CompanyType)->label('Type'),   
//                        'CompanySinceFromYear' => FormMgr::text()->label('Company since from'),  
//                        'CompanyAbout' => FormMgr::textarea()->label('About company'),  
//                        'CompanyFinancialYear' => FormMgr::text()->label('Financial year'),  
//                        'CompanyPrivacyPolicy' => FormMgr::text()->label('Privacy policy'),  
//                        
//                    ]);
//                    $record = new \entities\Company();
//                    $this->data['form_name'] = "Add Company Master";
//                    if($pk > 0)
//                    {
//                        $record = \entities\CompanyQuery::create()->findPk($pk);
//                        $f->val($record->toArray());
//                        $this->data['form_name'] = "Edit Company Master";
//                    }
//                    if($this->app->isPost() && $f->validate()){
//                        $record->fromArray($_POST);                                
//                        $record->save();
//                        $this->runModalScript("loadGrid()");
//                        return; 
//                    }                                        
//                    $this->data['form'] = $f->html();
//                    $this->app->Renderer()->render("modalCommonForm",$this->data);
//               break;
        endswitch;


    }

    function unitForm($id)
    {
        $this->data['form_name'] = "Org-Unit";
        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
        $employee = \entities\EmployeeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("EmployeeId", "FirstName");
        $country = \entities\GeoCountryQuery::create()->find()->toKeyValue("Icountryid", "Scountry");
        $positions = \entities\PositionsQuery::create()->find()->toKeyValue("PositionId", "PositionName");
        $status = $this->getConfig("System", "status");
        $exposed = $this->getConfig("System", "exposed");
        
        $f = FormMgr::formHorizontal();

        $f->add([
            'UnitName' => FormMgr::text()->label('Unit-Name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
            'CurrencyId' => FormMgr::select()->options($currency)->label('Currency'),
            'Icountryid' => FormMgr::select()->options($country)->label('Country'),
            'CanDoCustomPlaylist' => FormMgr::select()->options($status)->label('CanDoCustomPlaylist'),
            'IsExposed' => FormMgr::select()->options($exposed)->label('IsExposed'),
            'OrgunitAdminPosition' => FormMgr::select()->options($positions)->label('Admin Position'),
            'PunchinOnWeekoff' => FormMgr::checkbox()->label('PunchIn On Weekoff'),
            'PunchinOnHoliday' => FormMgr::checkbox()->label('PunchIn On Holiday'),
            'PunchinOnLeave' => FormMgr::checkbox()->label('PunchIn On Leave'),
            //'EmployeeId' => FormMgr::select()->options($employee)->label('Employee')->class("multi-select")->multiple("multiple")

        ]);

        $entity = new \entities\OrgUnit();


        $this->data['form_name'] = "Add Org-Unit";
        if ($id > 0) {
            $entity = \entities\OrgUnitQuery::create()
                ->findPk($id);
            
            $vals = $entity->toArray();
            
            //$val = \entities\AuditEmpUnitsQuery::create()->select('EmployeeId')->filterByOrgUnitId($id)->find()->toArray();
            //$f['EmployeeId']->val($val);
            //$f['EmployeeId']->sudoValue($entity->getEmployeeId())->datatoggle('CommonAutoComplete');
            $f->val($vals);

            $this->data['form_name'] = "Edit Org-Unit";
        }

        if ($this->app->isPost()) {
            $otherRows = \entities\Base\OrgUnitQuery::create()
                ->filterByUnitName($_POST['UnitName'])
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByOrgunitid($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->find()->count();

            if ($otherRows > 0) {
                $this->app->Session()->setFlash("error", "Sorry Org-Unit already exists !!");
                $f->val($_POST);
            } else {
                if ($f->validate()) {
                    
                    
                    $entity->fromArray($_POST);
                    if($_POST['CanDoCustomPlaylist'] == 1){
                        $customePlayList = true;
                    }else{
                        $customePlayList = false;
                    }
                    if($_POST['IsExposed'] == 1){
                        $isExposed = true;
                    }else{
                        $isExposed = false;
                    }

                    if(isset($_POST['PunchinOnWeekoff'])){
                        $punchOnWeekoff = true;
                    }else{
                        $punchOnWeekoff = false;
                    }
                    if(isset($_POST['PunchinOnHoliday'])){
                        $punchOnHoliday = true;
                    }else{
                        $punchOnHoliday = false;
                    }
                    if(isset($_POST['PunchinOnLeave'])){
                        $punchOnLeave = true;
                    }else{
                        $punchOnLeave = false;
                    }
                    
                    $entity->setCountryId($_POST['Icountryid']);
                    $entity->setCanDoCustomPlaylist($customePlayList);
                    $entity->setIsExposed($isExposed);
                    $entity->setPunchinOnWeekoff($punchOnWeekoff);
                    $entity->setPunchinOnHoliday($punchOnHoliday);
                    $entity->setPunchinOnLeave($punchOnLeave);
                    $entity->setCompanyId($this->app->Auth()->CompanyId());
                    $entity->save();
                    
                    if (isset($_POST['EmployeeId'])) {
                        $expids = $_POST['EmployeeId'];
                        \entities\AuditEmpUnitsQuery::create()->filterByOrgUnitId($id)->delete();
                        foreach ($expids as $exp) {
                            $auditunit = new \entities\AuditEmpUnits();
                            $auditunit->setEmployeeId($exp);
                            $auditunit->setOrgUnitId($entity->getPrimaryKey());
                            $auditunit->save();
                        }
                    }
                    $this->runModalScript("reloadUnit()");
                    return;
                } else {
                    $f->val($_POST);
                }
            }
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function policyKeyForm()
    {
        $f = FormMgr::formHorizontal();

        $f->add([
            'Pkeys' => FormMgr::text()->label('Key *')->required(),
            'Pgroup' => FormMgr::select()->options($this->getConfig("System", "PolicyGroups"))->label('Group'),

        ]);

        $entity = new \entities\Policykeys();

        if ($this->app->isPost()) {

            $Keys = \entities\PolicykeysQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findByPkeys($_POST['Pkeys']);

            if ($Keys->count() > 0) {
                $this->app->Session()->setFlash("error", "Key Already Exists");

                $f->val($_POST);

            } else {

                $entity->fromArray($_POST);
                $entity->setCompanyId($this->app->Auth()->CompanyId());
                $entity->save();
                $this->runModalScript("newKeySaved()");
                return;
            }

        }

        $this->data['form_name'] = "Add Keys";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function emailTemplate()
    {
        $this->data['title'] = "Email Template";
        $this->data['form_name'] = "Add Template";
        $this->data['cols'] = [
            "TemplateType" => "TemplateType",
            "TemplateSubject" => "TemplateSubject",
            "TemplateStatus" => "TemplateStatus"
        ];

        $status = array("1" => "Active", "0" => "In-active");

        $this->data['valKeys'] = ["TemplateStatus" => $status];

        $this->data['pk'] = "TemplateId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\EmailTemplateQuery::create()->find()->toArray()]);
                break;
            case "form":


                $f = FormMgr::formHorizontal();

                $f->add([
                    'TemplateType' => FormMgr::text()->label('Template Type'),
                    'TemplateSubject' => FormMgr::text()->label('Subject'),
                    'TemplateBody' => FormMgr::textarea()->label('Message'),
                    'TemplateStatus' => FormMgr::select()->options($status)->label('ReminderType'),

                ]);
                $template = new \entities\EmailTemplate();
                if ($pk > 0) {
                    $template = \entities\EmailTemplateQuery::create()->findPk($pk);
                    $f->val($template->toArray());
                }
                if ($this->app->isPost() && $f->validate()) {

                    $template->fromArray($_POST);
                    $template->save();

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function configuration()
    {


        $companyMaster = \entities\CompanyQuery::create()->findPk($this->app->Auth()->CompanyId());

        $f = FormMgr::formHorizontal();

        $f->add([

            'MailFrom' => FormMgr::email()->label('Mail From'),
            'FromName' => FormMgr::text()->label('From Name'),
            'AdminEmail' => FormMgr::text()->label('Admin Email'),
            'AdminCc' => FormMgr::text()->label('Other Emails')->class("Mode")->datarole("tagsinput"),
            'DailyReportEmails' => FormMgr::text()->label('Daily Report Emails')->class("Mode")->datarole("tagsinput"),

        ]);

        if ($this->isAjax()) {

            $action = $_GET['action'];

            switch ($action):

                case "updateCompanyProfile" :
                    $file = new \Upload\File('companyProfile_0', $this->app->Storage());
                    $new_filename = uniqid();
                    $file->setName($new_filename);
                    $file->upload();
                    $companyMaster->setCompanyLogo($file->getNameWithExtension());
                    $companyMaster->save();

                    break;

                case "updates":

                    $request = $this->app->Request()->getParameter();

                    return;
                    break;

            endswitch;


        }


        $configure = \entities\ConfigurationQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->getFirst();

        if ($configure) {
            $f->val($configure->toArray());
        } else {
            $configure = new \entities\Configuration();
            $configure->setCompanyId($this->app->Auth()->CompanyId());
        }
        if ($this->app->isPost() && $f->validate()) {
            $configure->fromArray($_POST);
            $configure->save();
            $f->val($_POST);
        }

        $form = FormMgr::formHorizontal();
        $form->add([

            'SyncStatus' => FormMgr::select()->options(["active" => "Active", "inactive" => "Inactive"])->label('Sync Status'),
            'HostName' => FormMgr::text()->label('Host Name *')->required(),
            'DatabseName' => FormMgr::text()->label('Database *')->required(),
            'UserName' => FormMgr::text()->label('User Name *')->required(),
            'Password' => FormMgr::password()->label('Password *')->required(),
            "Prefix" => FormMgr::text()->label('Prefix'),
            "MrpPricebookId" => FormMgr::number()->label('Mrp Pricebook Id'),

        ]);


        //var_dump($companyMaster); exit;
        $this->data['companyMaster'] = $companyMaster;
        $this->data['pkid'] = $companyMaster->getCompanyId();

        $this->data['mailer_form'] = $f->html();

        $this->app->Renderer()->render("system/configuration.twig", $this->data);
    }

    function branchSearch()
    {
        $q = $this->app->Request()->getParameter("term");

        $locations = \entities\BranchQuery::create()->filterByBranchname($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)->limit(100)->find();

        $res = [];

        foreach ($locations as $loc) {
            $res[] = ["label" => $loc->getBranchname(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
        }

        $this->json($res);
    }

    function departmentSearch()
    {
        $q = $this->app->Request()->getParameter("term");

        $locations = \entities\DepartmentsQuery::create()->filterByDepartmentName($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)->limit(100)->find();

        $res = [];

        foreach ($locations as $loc) {
            $res[] = ["label" => $loc->getDepartmentName(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
        }

        $this->json($res);
    }

    public function countryMaster()
    {

        $this->data['title'] = "Country";
        $this->data['form_name'] = "Country";
        $this->data['cols'] = [
            "Country" => "Scountry",
            "Currency" => "Currencies.Name",
        ];
        $this->data['pk'] = "Icountryid";

        //$this->data['moreButtons'] = ["State" => ["sys_state",""],"City" => ["sys_city",""]];

        $this->data['rowButtons'] = [
            "sys_state" => "zmdi zmdi-layers"
        ];


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("Account/cityMaster.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\GeoCountryQuery::create()
                    ->joinWithCurrencies()
                    ->find()->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $currencies = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
                $f->add([
                    'Scountry' => FormMgr::text()->label('Country')->required(),
                    'Scurrency' => FormMgr::select()->options($currencies)->label('Currency'),
                ]);
                $country = new \entities\GeoCountry();
                $this->data['form_name'] = "Add Country";
                if ($pk > 0) {
                    $country = \entities\GeoCountryQuery::create()->findPk($pk);
                    $f->val($country->toArray());
                    $this->data['form_name'] = "Edit Country";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $otherRows = \entities\Base\GeoCountryQuery::create()
                        ->filterByScountry($_POST['Scountry'])
                        ->filterByIcountryid($pk, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->find()->count();
                    if ($otherRows > 0) {
                        $this->app->Session()->setFlash("error", "Sorry Country already exists !!");
                        $f->val($_POST);
                    } else {
                        $this->app->Debug($_POST);
                        $country->fromArray($_POST);
                        $country->save();
                        $this->runModalScript("loadGrid()");
                        return;
                    }
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function state($id)
    {
        $country_id = $id;
        $country = \entities\GeoCountryQuery::create()->findPk($country_id);
        $countryArray = \entities\GeoCountryQuery::create()->find()->toKeyValue("Icountryid", "Scountry");
        $this->data['title'] = $country->getScountry();
        $this->data['form_name'] = "State";
        $this->data['cols'] = [
            "State" => "Sstatename",
        ];
        $this->data['pk'] = "Istateid";

        $this->data['rowButtons'] = [
            "sys_city" => "zmdi zmdi-layers"
        ];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action) :
            case "":
                $this->app->Renderer()->render("Account/cityMaster.twig", $this->data);
                break;
            case "list":
                $data = $this->json(["data" => \entities\GeoStateQuery::create()
                    ->filterByCountryId($country_id)
                    ->find()->toArray()]);

                $this->data['moreButtons1'] = 'state';

                break;
            case "form":
                $f = FormMgr::formHorizontal();
                if ($pk > 0) {
                    $f->add([
                        'Sstatename' => FormMgr::text()->label('State')->required()
                    ]);
                } else {
                    $f->add([
                        'Sstatename' => FormMgr::text()->label('State')->required(),
                        'Sstatecode' => FormMgr::text()->label('CODE')->required(),
                        /*'CountryId' => FormMgr::text()->label('Country')
                            ->datatoggle('CommonAutoComplete')
                            ->href($this->app->Router()->getPath("sys_searchcountry")),*/
                        //'CountryId' => FormMgr::select()->options($countryArray)->label('Country')->readonly(),
                    ]);
                }
                $state = new \entities\GeoState();
                $this->data['form_name'] = "Add State";
                if ($pk > 0) {
                    $state = \entities\GeoStateQuery::create()->findPk($pk);
                    $f->val($state->toArray());

                    $this->data['form_name'] = "Edit State";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $otherRows = \entities\Base\GeoStateQuery::create()
                        ->filterBySstatename($_POST['Sstatename'])
                        ->filterByIstateid($pk, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->find()->count();
                    if ($otherRows > 0) {
                        $this->app->Session()->setFlash("error", "Sorry State already exists !!");
                        $f->val($_POST);
                    } else {

                        $state->fromArray($_POST);
                        $state->setCountryId($country_id);
                        $state->save();
                        $this->runModalScript("loadGrid()");
                        return;
                    }
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function city($id)
    {
        $state_id = $id;
        $state = \entities\GeoStateQuery::create()->findPk($state_id);

        $this->data['title'] = $state->getGeoCountry()->getScountry() . " >> " . $state->getSstatename();
        $this->data['form_name'] = "Region";
        $this->data['cols'] = [
            "Region" => "Scityname",
        ];
        $this->data['pk'] = "Icityid";

        $this->data['rowButtons'] = [
            "sys_towns" => "zmdi zmdi-layers"
        ];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("Account/cityMaster.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\GeoCityQuery::create()
                    ->findByIstateid($state_id)->toArray()]);
                break;
            case "form":

                $f = FormMgr::formHorizontal();


                if ($pk > 0) {
                    $f->add([
                        'Scityname' => FormMgr::text()->label('Region')->required()
                    ]);
                } else {
                    $f->add([
                        'Scityname' => FormMgr::text()->label('Region')->required(),
                        /*   'State' => FormMgr::text()->label('State')
                            ->datatoggle('CommonAutoComplete')
                            ->href($this->app->Router()->getPath("sys_searchstate")),*/


                    ]);
                }
                $city = new \entities\GeoCity();
                $this->data['form_name'] = "Add Region";
                if ($pk > 0) {
                    $city = \entities\GeoCityQuery::create()->findPk($pk);
                    $f->val($city->toArray());
                    $this->data['form_name'] = "Edit Region";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $city->fromArray($_POST);
                    if ($pk == 0) {

                        $state = \entities\GeoStateQuery::create()->findPk($state_id);
                        $city->setIcountryid($state->getCountryId());
                        $city->setIstateid($state->getPrimaryKey());
                    }
                    $city->save();
                    $this->runModalScript("loadGrid()");
                    return;

                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

                break;
        endswitch;
    }

    public function towns($id)
    {
        $cityId = $id;
        $city = \entities\GeoCityQuery::create()->findPk($cityId);

        $this->data['title'] = $city->getGeoState()->getSstatename() . " >> " . $city->getScityname();
        $this->data['form_name'] = "Town";
        $this->data['cols'] = [
            "Town" => "Stownname",
        ];
        $this->data['pk'] = "Itownid";


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("Account/cityMaster.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => GeoTownsQuery::create()
                    ->findByIcityid($cityId)->toArray()]);
                break;
            case "form":

                $f = FormMgr::formHorizontal();


                if ($pk > 0) {
                    $f->add([
                        'Stownname' => FormMgr::text()->label('Town Name')->required(),
                        'Stowncode' => FormMgr::text()->label('Town Code')->required()
                    ]);
                } else {
                    $f->add([
                        'Stownname' => FormMgr::text()->label('Town Name')->required(),
                        'Stowncode' => FormMgr::text()->label('Town Code')->required()

                    ]);
                }
                $town = new \entities\GeoTowns();
                $this->data['form_name'] = "Add Town";
                if ($pk > 0) {
                    $town = GeoTownsQuery::create()->findPk($pk);
                    $f->val($town->toArray());
                    $this->data['form_name'] = "Edit Town";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $town->fromArray($_POST);
                    if ($pk == 0) {

                        $town->setIcityid($cityId);
                    }
                    $town->save();
                    $this->runModalScript("loadGrid()");
                    return;

                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

                break;
        endswitch;
    }


    public function viewcityMaster($Icountryid = 0)
    {
        if ($Icountryid == 0) {
            return;
        }

        $countryData = \entities\GeoCountryQuery::create()
            ->findPk($Icountryid);

        $this->data['country'] = $countryData;
        $this->data['account'] = $countryData->getCountryAccounts()->getFirst();


        $this->data['account'] = $countryData->getCountryccounts()->getFirst();

        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function searchcountry()
    {
        $q = $this->app->Request()->getParameter("term");
        $type = $this->app->Request()->getParameter("type");

        if ($type == "raw") {
            $locations = \entities\GeoCountryQuery::create()
                ->joinWithCurrencies()
                ->filterByScountry($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByIcountryid(0)
                ->limit(100)
                ->find();
        } else {
            $locations = \entities\GeoCountryQuery::create()
                ->joinWithCurrencies()
                ->filterByScountry($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByIcountryid(0, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->limit(100)
                ->find();
        }


        $res = [];

        foreach ($locations as $loc) {
            $res[] = ["label" => $loc->getScountry() . " | " . $loc->getCurrencies()->getName(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
        }

        $this->json($res);
    }

    public function searchstate()
    {
        $q = $this->app->Request()->getParameter("term");
        $type = $this->app->Request()->getParameter("type");

        if ($type == "raw") {
            $locations = \entities\GeoStateQuery::create()
                //->joinWithGeoCity()
                ->filterBySstatename($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByIstateid(0)
                ->limit(100)
                ->find();
        } else {
            $locations = \entities\GeoStateQuery::create()
                //->joinWithGeoCity()
                ->filterBySstatename($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->filterByIstateid(0, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->limit(100)
                ->find();
        }


        $res = [];

        foreach ($locations as $loc) {
            $res[] = ["label" => $loc->getSstatename() . " | " . $loc->getGeoCountry()->getScountry(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];

        }

        $this->json($res);
    }

    public function employeeLastLoc($userId)
    {


        $emp = \entities\EmployeeLogQuery::create()
            ->filterByUserId($userId)
            ->orderByLogId(\Propel\Runtime\ActiveQuery\Criteria::DESC)
            ->limit(1)
            ->findOne();
        if ($emp) {
            $this->data['form_name'] = $emp->getUsers()->getEmployee()->getFirstName() . " " . $emp->getUsers()->getEmployee()->getLastName();
            $pin = explode(",", $emp->getPin());
            $this->data['lat'] = $pin[0];
            $this->data['lng'] = $pin[1];
            $this->data['loginDevice'] = $emp->getDeviceName();
            $this->data['deviceBattery'] = $emp->getDeviceBattery();
        }
        $this->data["noSave"] = true;
        $this->app->Renderer()->render("system/employeeLastLoc.twig", $this->data);

    }

    public function companyConfiguration()
    {
        $configuration = \entities\CompanyQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->getFirst();
        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");
        $exp_reminder_status = $this->getConfig('System', 'expReminderStatus');

        $expenseMaster = \entities\ExpenseMasterQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()
            ->toKeyValue("ExpenseId", "ExpenseName");

        $mediaManager = new MediaManager($this->app);
        $f = FormMgr::formHorizontal();

        $f->add([
            'CompanyName' => FormMgr::text()->label('Company Name')->id('CompanyName'),
            'OwnerName' => FormMgr::text()->label('Authorised Signatory')->id('OwnerName'),
            'CompanyPhoneNumber' => FormMgr::text()->label('Phone Number')->id('CompanyPhoneNumber'),
            'CompanyContactNumber' => FormMgr::text()->label('Mobile')->id('CompanyContactNumber'),
            'CompanyAddress1' => FormMgr::text()->label('Address Line1')->id('CompanyAddress1'),
            'CompanyAddress2' => FormMgr::text()->label('Address Line2')->id('CompanyAddress2'),
            'CompanyDefaultCurrency' => FormMgr::select()->options($currency)->label('Default Currency'),
            'Currentmonthsubmit' => FormMgr::select()->options(["1" => "Allowed To Submmit", "0" => "Cannot Submit in Active Month"])->label('When Can Employees Submit Expenses?'),
            'ExpenseReminder' => FormMgr::select()->options($exp_reminder_status)->label('Expense Reminder'),
            'Tripapprovalreq' => FormMgr::select()->options(["1" => "Approval Mandatory", "0" => "Expenses on UnApproved Trips"])->label('Trip Approval Rule'),
            'Expenseonlyontrip' => FormMgr::select()->options(["1" => "Only While On Trip", "0" => "Any Time"])->label('When Can Expenses be Booked'),
            'Allowbackdatedtrip' => FormMgr::select()->options(["1" => "Yes", "0" => "No"])->label('Allow back dated trip ?'),
            'Paymentsystem' => FormMgr::select()->options(["1" => "Settlement based", "0" => "Audit based"])->label('Payment System'),
            'AutoSettle' => FormMgr::select()->options(["1" => "Yes", "0" => "No"])->label('Auto settle on approve ?')->id("autosettle"),
            'Allowradius' => FormMgr::number()->label('Allow Radius in Meter')->id('Allowradius'),
            'Googlemapkey' => FormMgr::text()->label('Google Map API Key')->id('GoogleMapAPIKey'),
            'Workingdaysinweek' => FormMgr::number()->label('Working Days In Week')->id('Workingdaysinweek'),
            'AutoCalculatedTa' => FormMgr::select()->options($expenseMaster)->label('Auto Calculated Ta'),
            'ReportingDays' => FormMgr::number()->label('Reporting Days')->max(180),
            'ExpenseMonths' => FormMgr::number()->label('Expense Allowed Months')->max(12),
        ]);

        $f->val($configuration->toArray());

        if ($this->app->isPost()) {

            if ($f->validate()) {
                
                unset($_POST['CompanyLogo']);
                $configuration->fromArray($_POST);

                $configuration->save();

                $f->val($configuration->toArray());
            }
        }

        $mediaInput = $mediaManager->FormInput("CompanyLogo", "Media", [$configuration->getCompanyLogo()], 1);
        $this->data['form'] = $f->html() . $mediaInput;

        $this->data["formName"] = "Basic Company Details";
        $this->app->Renderer()->render("widgetForm.twig", $this->data);
    }

    public function superSettings()
    {
        if ($this->isAjax()) {

            $action = $_GET['action'];
            if ($action == "role") {
                $this->json(["data" => \entities\RolesQuery::create()->find()->toArray()]);
            } else if ($action == "companies") {
                $this->json(["data" => \entities\CompanyQuery::create()->find()->toArray()]);
            }

        } else {
            $this->app->Renderer()->render("system/superSettings.twig", $this->data);
        }
    }

    public function companyForm($id = 0)
    {
        $this->data['form_name'] = "Company";

        $datachange = $this->app->Request()->getParameter("datachange", "");
        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");

        if ($datachange == "checkUnique") {
            $CompanyCode = $this->app->Request()->getParameter("CompanyCode");
            $exists = \entities\CompanyQuery::create()
                ->filterByCompanyId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->findByCompanyCode($CompanyCode)->count();
            if ($exists > 0) {
                $this->json(array("status" => false));
            } else {
                $this->json(array("status" => true));
            }
            return;
        }


        $f = FormMgr::formHorizontal();

        $f->add([
            'CompanyCode' => FormMgr::text()->label('CODE *')->required()->id('CompanyCode')->datachange('checkUnique')->class('text-uppercase'),
            'CompanyName' => FormMgr::text()->label('Company Name')->id('CompanyName'),
            'OwnerName' => FormMgr::text()->label('Authorised Signatory')->class("text-uppercase")->id('OwnerName'),
            'OwnerEmail' => FormMgr::email()->label('Email')->id('OwnerEmail'),
            'CompanyPhoneNumber' => FormMgr::text()->label('Phone Number')->id('CompanyPhoneNumber'),
            'CompanyContactNumber' => FormMgr::text()->label('Mobile')->id('CompanyContactNumber'),
            'CompanyAddress1' => FormMgr::text()->label('Address Line1')->id('CompanyAddress1'),
            'CompanyAddress2' => FormMgr::text()->label('Address Line2')->id('CompanyAddress2'),
            'CompanyDefaultCurrency' => FormMgr::select()->options($currency)->label('Default Currency'),
        ]);

        $company = new \entities\Company();
        $this->data['form_name'] = "Add Company";

        if ($id > 0) {
            $company = \entities\CompanyQuery::create()->findPk($id);
            $vals = $company->toArray();
            $f->val($vals);
            $this->data['form_name'] = "Edit Company";
        }

        if ($this->app->isPost()) {
            $exists = \entities\CompanyQuery::create()
                ->filterByCompanyId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->findByCompanyCode($_POST['CompanyCode'])->count();
            if ($exists > 0) {
                $this->app->Session()->setFlash("error", "Sorry Company Code already exists !!");
                $f->val($_POST);
            } else {
                if ($f->validate()) {
                    $_POST['CompanyCode'] = strtoupper($_POST['CompanyCode']);
                    $company->fromArray($_POST);
                    $company->save();

                    //welcome email

                    \Modules\HR\Runtime\HrHelper::firstDataSetup($company->getPrimaryKey(), "12345678", $this->app, 1);

                    $this->runModalScript("reloadGrid()");
                    return;

                } else {
                    $f->val($_POST);
                }
            }
        }


        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function ticketType($id = 0)
    {
        $mediaManager = new MediaManager($this->app);
        $this->data['title'] = "TicketType";
        $this->data['form_name'] = "TicketType";
        $this->data['cols'] = [
            "Icon" => "MediaId",
            "Ticket Type" => "TicketType",
        ];
        $this->data['pk'] = "id";
        $this->data['mediaCol'] = "MediaId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\TicketTypeQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'TicketType' => FormMgr::text()->label('Ticket Type *')->required()->id('TicketType')->class('text-uppercase'),
                ]);
                $ticketType = new \entities\TicketType();
                $this->data['form_name'] = "Add Ticket Type";
                if ($pk > 0) {
                    $ticketType = \entities\TicketTypeQuery::create()
                        ->findPk($pk);
                    $f->val($ticketType->toArray());
                    $this->data['form_name'] = "Edit Ticket Type";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $ticketType->fromArray($_POST);
                    $ticketType->setCompanyId($this->app->Auth()->CompanyId());
                    $ticketType->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId", "Media", [$ticketType->getMediaId()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function positionSearch()
    {
        $q = $this->app->Request()->getParameter("term");

        $positions = \entities\PositionsQuery::create()->filterByPositionName($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)->limit(100)->find();

        $res = [];

        foreach ($positions as $loc) {
            $res[] = ["label" => $loc->getPositionName() . " | " . $loc->getOrgUnit()->getUnitName(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
        }

        $this->json($res);
    }

    public function outlettypesmodule($id)
    {
        $this->data['title'] = "Outlettypemodules";
        $this->data['form_name'] = "Outlettypemodules";
        $this->data['cols'] = [
            // "Outlettypeid" => "OutletType.OutlettypeId",
            "ModuleName" => "ModuleName",
        ];

        $this->data['pk'] = "Outlettypemoduleid";

        // $brand = OutlettypemodulesQuery::create()->findPk($id);

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\OutlettypemodulesQuery::create()
                    ->filterByOutlettypeid($id)
                    ->joinOutletType()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                // $state = \entities\GeoStateQuery::create()->find()->toKeyValue("Istateid", "Sstatename");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'ModuleName' => FormMgr::text()->label('Module Name *')->required(),
                    // 'Istateid'    => FormMgr::select()->options($state)->label('States')->class("multi-select")->multiple("multiple")->required()
                ]);
                $brandCompetitior = new \entities\Outlettypemodules();
                $this->data['form_name'] = "Add OutletType Module";
                if ($pk > 0) {
                    //$brandComp = \entities\OutlettypemodulesQuery::create()->findPk($pk);
                    //$f->val($brandComp->toArray());

                    $brandCompetitior = \entities\OutlettypemodulesQuery::create()
                        ->findPk($pk);
                    $f->val($brandCompetitior->toArray());
                    $this->data['form_name'] = "Edit OutletType Module";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {
                    // var_dump($_POST['ModuleName'],$id);exit;
                    $brandCompetitior->fromArray($_POST);
                    $brandCompetitior->setOutlettypeid(intval($id));
                    $brandCompetitior->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $brandCompetitior->save();

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;

        endswitch;
    }

    public function ftpConfig($id = 0)
    {
        $this->data['title'] = "FTP Config";
        $this->data['form_name'] = "FTPConfig";
        $this->data['cols'] = [
            "Host" => "Host",
            "Username" => "Username",
            "Password" => "Password",
            "Port" => "Port",
        ];
        $this->data['pk'] = "FtpConfigId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\FtpConfigsQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Host' => FormMgr::text()->label('Host *')->required()->id('Host'),
                    'Username' => FormMgr::text()->label('Username *')->required()->id('Username'),
                    'Password' => FormMgr::text()->label('Password *')->required()->id('Password'),
                    'Port' => FormMgr::text()->label('Port *')->required()->id('Port'),
                ]);
                $ftpConfig = new \entities\FtpConfigs();
                $this->data['form_name'] = "Add FTP Config";
                if ($pk > 0) {
                    $ftpConfig = \entities\FtpConfigsQuery::create()
                        ->findPk($pk);
                    $f->val($ftpConfig->toArray());
                    $this->data['form_name'] = "Edit FTP Config";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $ftpConfig->fromArray($_POST);
                    $ftpConfig->setCompanyId($this->app->Auth()->CompanyId());
                    $ftpConfig->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function ftpBatches($id = 0)
    {
        $this->data['title'] = "FTP Batch";
        $this->data['form_name'] = "FTPBatch";
        $this->data['cols'] = [
            "Label" => "Label",
            "NextBatch" => "NextBatch",
            "FtpPath" => "FtpPath",
            "Isenabled" => "Isenabled",
        ];
        $this->data['pk'] = "FtpImportBatchId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $listData = \entities\FtpImportBatchesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                foreach ($listData as $key => $data) {
                    $listData[$key]['Isenabled'] = ($data['Isenabled'] ? 'Yes' : 'No');
                }
                $this->json(["data" => $listData]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Label' => FormMgr::text()->label('Label *')->required()->id('Label'),
                    'AttachedFunction' => FormMgr::text()->label('Attached Function *')->required()->id('AttachedFunction'),
                    'FtpPath' => FormMgr::text()->label('FtpPath *')->required()->id('FtpPath'),
                    'Isenabled' => FormMgr::checkbox()->label('Is enabled')->value(1),
                ]);
                $ftpBatch = new \entities\FtpImportBatches();
                $this->data['form_name'] = "Add FTP Batch";
                if ($pk > 0) {
                    $ftpBatch = \entities\FtpImportBatchesQuery::create()
                        ->findPk($pk);

                    if ($ftpBatch->getIsenabled() == 1) {
                        $f['Isenabled']->checked();
                    }

                    $f->val($ftpBatch->toArray());
                    $this->data['form_name'] = "Edit FTP Batch";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $ftpBatch->fromArray($_POST);
                    $ftpBatch->setCompanyId($this->app->Auth()->CompanyId());
                    $ftpBatch->setIsenabled($this->app->Request()->getParameter("Isenabled", 0));
                    $ftpBatch->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function ftpImportLogs($id = 0)
    {
        $this->data['title'] = "FTP Import Logs";
        $this->data['cols'] = [
            "FilePath" => "FilePath",
            "NoTotalRecords" => "NoTotalRecords",
            "NoSuccessfulRecords" => "NoSuccessfulRecords",
            "NoFailedRecords" => "NoFailedRecords",
            "CreatedAt" => "CreatedAt",
            "IsFileProcessed" => "IsFileProcessed",
            "ErrorMessage" => "ErrorMessage",
        ];
        $action = $this->app->Request()->getParameter("action");
        $this->data['pk'] = "FtpImportLogId";

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $listData = \entities\FtpImportLogsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                foreach ($listData as $key => $data) {
                    $listData[$key]['IsFileProcessed'] = ($data['IsFileProcessed'] ? 'Yes' : 'No');
                }
                $this->json(["data" => $listData]);
                break;
        endswitch;
    }

    public function getTableData()
    {
        $key = $this->app->Request()->getParameter("key");
        $values = $this->app->Request()->getParameter("values");
        $values = explode(',', $values);
        // print_r($values);
        // exit;
        $tableDetails = $this->getTableDetails($key);
        if (!empty($tableDetails['tableClass'])) {
            $data = ($tableDetails['tableClass'])::create()
                ->where($tableDetails['primaryKey'] . ' IN ?', $values)
                ->select($tableDetails['valueKey'])
                ->find()
                ->toArray();
            $returnValue = implode(', ', $data);
        } else {
            $returnValue = $values;
        }

        return $this->json(['value' => $returnValue]);
    }

    public function getTableDetails(String $key)
    {
        $tableDetails = ['primaryKey' => '', 'valueKey' => ''];
        switch ($key) {
            case 'Istateids':
                $tableDetails['tableClass'] = '\entities\GeoStateQuery';
                $tableDetails['primaryKey'] = 'geo_state.istateid';
                $tableDetails['valueKey'] = 'geo_state.sstatename';
                break;

            case 'OutletId':
                $tableDetails['tableClass'] = '\entities\OutletsQuery';
                $tableDetails['primaryKey'] = 'outlets.id';
                $tableDetails['valueKey'] = 'outlets.outlet_name';
                break;

            case 'RetailOutletId':
                $tableDetails['tableClass'] = '\entities\OutletsQuery';
                $tableDetails['primaryKey'] = 'outlets.id';
                $tableDetails['valueKey'] = 'outlets.outlet_name';
                break;

            case 'CompetitorId':
                $tableDetails['tableClass'] = '\entities\BrandCompetitionQuery';
                $tableDetails['primaryKey'] = 'brand_competition.competitor_id';
                $tableDetails['valueKey'] = 'brand_competition.competitor_name';
                break;

            case 'EmployeeId':
                $tableDetails['tableClass'] = '\entities\EmployeeQuery';
                $tableDetails['primaryKey'] = 'employee.employee_id';
                $tableDetails['valueKey'] = 'employee.first_name';
                break;

            case 'PositionId':
                $tableDetails['tableClass'] = '\entities\PositionsQuery';
                $tableDetails['primaryKey'] = 'positions.position_id';
                $tableDetails['valueKey'] = 'positions.position_name';
                break;

            case 'Orgunitids':
                $tableDetails['tableClass'] = '\entities\OrgUnitQuery';
                $tableDetails['primaryKey'] = 'org_unit.orgunitid';
                $tableDetails['valueKey'] = 'org_unit.unit_name';
                break;

            case 'Designations':
                $tableDetails['tableClass'] = '\entities\DesignationsQuery';
                $tableDetails['primaryKey'] = 'designations.designation_id';
                $tableDetails['valueKey'] = 'designations.designation';
                break;

            case 'Managers':
                $tableDetails['tableClass'] = '\entities\EmployeeQuery';
                $tableDetails['primaryKey'] = 'employee.employee_id';
                $tableDetails['valueKey'] = 'employee.first_name';
                break;

            case 'TerritoryId':
                $tableDetails['tableClass'] = '\entities\TerritoriesQuery';
                $tableDetails['primaryKey'] = 'territories.territory_id';
                $tableDetails['valueKey'] = 'territories.territory_name';
                break;

            case 'OutletClassification':
                $tableDetails['tableClass'] = '\entities\ClassificationQuery';
                $tableDetails['primaryKey'] = 'classification.id';
                $tableDetails['valueKey'] = 'classification.classification';
                break;

            case 'Orgunitid':
                $tableDetails['tableClass'] = '\entities\OrgUnitQuery';
                $tableDetails['primaryKey'] = 'org_unit.orgunitid';
                $tableDetails['valueKey'] = 'org_unit.unit_name';
                break;

            case 'OutletFrom':
                $tableDetails['tableClass'] = '\entities\OutletsQuery';
                $tableDetails['primaryKey'] = 'outlets.id';
                $tableDetails['valueKey'] = 'outlets.outlet_name';
                break;

            case 'OutletTo':
                $tableDetails['tableClass'] = '\entities\OutletsQuery';
                $tableDetails['primaryKey'] = 'outlets.id';
                $tableDetails['valueKey'] = 'outlets.outlet_name';
                break;


            default:
                # code...
                break;
        }

        return $tableDetails;
    }

    public function taConfiguration()
    {
        $this->data['title'] = "TA Configuration";
        $this->data['form_name'] = "TaConfiguration";
        $this->data['cols'] = [
            "FromKm" => "FromKm",
            "ToKm" => "ToKm",
            "PolicyKey" => "PolicyKey",
        ];

        $this->data['pk'] = "TaConfigId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $policyKey = \entities\PolicykeysQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Pkeys", "Pkeys");

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\TaConfigurationQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'FromKm' => FormMgr::number()->label('From Km *')->required(),
                    'ToKm' => FormMgr::number()->label('To Km *')->required(),
                    'PolicyKey' => FormMgr::select()->options($policyKey)->label('Policy Key*')->required(),
                ]);
                $taConfiguration = new \entities\TaConfiguration();
                $this->data['form_name'] = "Add TA Configuration";
                if ($pk > 0) {
                    $taConfiguration = \entities\TaConfigurationQuery::create()->findPk($pk);
                    $f->val($taConfiguration->toArray());
                    $this->data['form_name'] = "Edit TA Configuration";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $taConfiguration->fromArray($_POST);
                    $taConfiguration->setCompanyId($this->app->Auth()->CompanyId());
                    $taConfiguration->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function languageForm($id = 0)
    {
        $this->data['form_name'] = "Language";
        $datachange = $this->app->Request()->getParameter("datachange", "");

        $f = FormMgr::formHorizontal();

        $f->add([
            'LanguageName' => FormMgr::text()->label('Language Name *')->required(),
            'LanguageCode' => FormMgr::text()->label('Language Code *')->required(),
        ]);

        $language = new \entities\Language();
        $this->data['form_name'] = "Add Language";
        if ($id > 0) {
            $language = \entities\LanguageQuery::create()->findPk($id);
            $vals = $language->toArray();
            $f->val($vals);
            $this->data['canDelete'] = true;
            $this->data['form_name'] = "Edit Language";
        }
        if ($this->app->isPost() && $f->validate()) {
            if ($_POST['buttonValue'] == "delete") {
                $language->delete();
            } else {
                $language->fromArray($_POST);
                $language->save();
                $this->runModalScript("loadGrid()");
                return;
            }
            $this->runModalScript("reloadGridDesignation()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function systemNotification(){
        $this->data['title'] = "System Notification";
        $this->data['form_name'] = "SystemNotification";
        $this->data['cols'] = [
            "ToEmployeeId" => "ToEmployeeId",
            "TemplateKey" => "TemplateKey",
            "SendEmail" => "SendEmail",
            "SendSms" => "SendSms",
            "SendPush" => "SendPush",
            "EmailSentStatus" => "EmailSentStatus",
            "SmsSentStatus" => "SmsSentStatus",
            "PushSentStatus" => "PushSentStatus",
        ];

        $this->data['pk'] = "NotificationId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\NotificationsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByEmailSentStatus(false)
                    ->_or()
                    ->filterBySmsSentStatus(false)
                    ->_or()
                    ->filterByPushSentStatus(false)
                    ->find()->toArray()]);
                break;
        endswitch;
    }
}

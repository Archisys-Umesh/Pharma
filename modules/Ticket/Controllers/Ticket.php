<?php declare(strict_types = 1);

namespace Modules\Ticket\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use entities\OrgUnitQuery;
use entities\EmployeeQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use entities\TicketsQuery;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Ticket extends \App\Core\BaseController{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function TicketType(){
        $mediaManager = new MediaManager($this->app);
        $this->data['title'] = "Ticket Type";
        $this->data['form_name'] = "TicketType";
        $this->data['cols'] = [

            "Image" => "MediaId",
            "Ticket Type" => "TicketType",
            "Assign To" => "Employee.FirstName"
        ];

        $this->data['pk'] = "Id";
        $this->data['mediaCol'] = "MediaId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig",$this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\TicketTypeQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByTicketType($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithEmployee()->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();

                $f = FormMgr::formHorizontal();
                $f->add([
                    'TicketType' => FormMgr::text()->label('Ticket Type *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'EmployeeId' => FormMgr::text()->label('Employee *')->required()
                        ->datatoggle('CommonAutoComplete')
                        ->href($this->app->Router()->getPath("hr_employeeSearch")),
                ]);
                $ticket = new \entities\TicketType();
                $mediaId = [];
                $this->data['form_name'] = "Add Ticket Type";
                if($pk > 0)
                {
                    $ticket = \entities\TicketTypeQuery::create()->findPk($pk);
                    if($ticket->getMediaId() != null && strlen($ticket->getMediaId()) > 2) {
                        $mediaId = explode(",",$ticket->getMediaId());
                    }

                    $f->val($ticket->toArray());
                    $f['EmployeeId']->sudoValue($ticket->getEmployee()->getFirstName()." ".$ticket->getEmployee()->getLastName());

                    $this->data['form_name'] = "Edit Ticket Type";
                }
                if($this->app->isPost() && $f->validate()){

                    $ticket->fromArray($_POST);

                    $ticket->setCompanyId($this->app->Auth()->CompanyId());
                    $ticket->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();

                $mediaInput = $mediaManager->FormInput("MediaId","Media",$mediaId,1);
                $this->data['form'] = $form.$mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }

    function Tickets(){
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Tickets";
        $this->data['form_name'] = "Ticket";
        $this->data['cols'] = [
            "Image" => "MediaId",
            "Ticket Type" => "TicketType.TicketType",
            "Outlet" => "Outlets.OutletName",
            "Description" => "Description",
            "Status"=>"Status",
        ];
        $this->data['canEditIf'] = ["col" => "Status","val" => "Open"];
        $this->data['pk'] = "Id";
        $this->data['mediaCol'] = "MediaId";
        $this->data['rowButtons'] = ["ticket_comment" => "zmdi zmdi-layers"];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig",$this->data);
                break;
            case "list":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\TicketsQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId())->orderById("Desc");

                if($this->app->Auth()->checkPerm("admin")){
                    $query = $query->filterByAllocatedTo($empId);
                }

                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->useOutletsQuery()->filterByOutletName($search,Criteria::LIKE)->endUse()->_or()->useTicketTypeQuery()->filterByTicketType($search,Criteria::LIKE)->endUse()->_or()->filterByDescription($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOutlets()->joinWithTicketType()->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();
                $tickettypes = \entities\TicketTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Id","TicketType");
                //$outlets = \entities\OutletsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Id","OutletName");
                $status = $this->getConfig("Ticket","ticketStatus");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'TicketTypeId' => FormMgr::select()->options($tickettypes)->label('Ticket Type'),
                    'OutletId' => FormMgr::text()->label('Customer *')->required()->datatoggle('CommonAutoComplete')->href($this->app->Router()->getPath("outletAutoComplete")),
                    'Description' => FormMgr::text()->label('Description *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Status' => FormMgr::select()->options($status)->label('Status'),

                ]);
                $ticket = new \entities\Tickets();
                $this->data['form_name'] = "Add Ticket";
                if($pk > 0)
                {
                    $ticket = \entities\TicketsQuery::create()
                        ->findPk($pk);
                    $f->val($ticket->toArray());
                    $f["OutletId"]->sudoValue($ticket->getOutlets()->getOutletName());
                    $this->data['form_name'] = "Edit Ticket";
                }
                if($this->app->isPost() && $f->validate()){
                    $ticketType =  \entities\TicketTypeQuery::create()
                        ->findOneById($this->app->Request()->getParameter("TicketTypeId"));
                    if($pk == 0)  // When new Ticket
                    {
                        $ticket->fromArray($_POST);
                        $ticket->setAllocatedTo($ticketType->getEmployeeId());
                        $ticket->setEmployeeId($empId);
                        $ticket->setCompanyId($this->app->Auth()->CompanyId());
                        $ticket->save();
                        $emp = EmployeeQuery::create()->filterByEmployeeId($empId)->findOne();

                        $to = [$emp->getEmail()];
                        $subject = 'Ticket Create mail';
                        $body = "Your ticket created Successfully Please Check!";
                        \App\Utils\SendMail::smtpSendMail($to, $subject, $body);
                        $title = "Create Ticket";
                        $message = "Create Ticket Successfully";
                        $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp->getEmployeeId(), $title, $message);

                    }
                    else{
                        $ticket->fromArray($_POST);
                        $ticket->setAllocatedTo($ticketType->getEmployeeId());
                        $ticket->setCompanyId($this->app->Auth()->CompanyId());
                        $ticket->setEmployeeId($empId);
                        $ticket->save();
                    }

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("MediaId","Media",[$ticket->getMediaId()],1);
                $this->data['form'] = $form.$mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }

    public function ticketComment($id){

        $this->data['form_name'] = "TicketComment";
        $this->data['cols'] = [
            "Employee" => "Employee.FirstName",
            "Ticket Replies" => "TicketReplies",
        ];

        $ticket = \entities\TicketsQuery::create()->findPk($id);
        if($ticket->getStatus() == 'close')
        {
            $this->data['disableAdd'] = true;
        }

        $this->data['title'] = $ticket->getOutlets()->getOutletName()." | Desc: ".$ticket->getDescription()." | Status : ".$ticket->getStatus();
        $this->data['pk'] = "Id";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $this->json( ["data" => \entities\TicketRepliesQuery::create()
                    ->joinWithTickets()
                    ->joinWithEmployee()
                    ->filterByTicketId($id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $empId = $this->app->Auth()->getUser()->getEmployeeId();

                $ticket = \entities\TicketsQuery::create()->filterById($id)->findOne();
                $employeeId = $ticket->getEmployeeId();

                $f = FormMgr::formHorizontal();
                $f->add([
                    'TicketId' => FormMgr::hidden()->val($id),
                    'TicketReplies' => FormMgr::textarea()->label('Comment *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'AttachmentUrl' => FormMgr::text()->label('Attachment Url'),
                    'EmployeeId' => FormMgr::hidden()->val($empId),
                ]);
                $ticketReplies = new \entities\TicketReplies();
                $this->data['form_name'] = "Add Ticket Comment";
                if($pk > 0)
                {
                    $ticketReplies = \entities\TicketRepliesQuery::create()
                        ->findPk($pk);
                    $f->val($ticketReplies->toArray());
                    $this->data['form_name'] = "Edit Ticket Comment";
                }
                if($this->app->isPost() && $f->validate()){
                    $ticket = TicketsQuery::create()
                        ->filterById($id)
                        ->findOne();
                    $ticket->setStatus("Close");
                    $ticket->save();
                    $ticketReplies->fromArray($_POST);
                    $ticketReplies->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $ticketReplies->save();

                    $title = "Ticket".' - '.$ticketReplies->getTicketId();
                    $message = $ticketReplies->getTicketReplies();
                    $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($ticketReplies->getEmployeeId(), $title, $message);

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }



}
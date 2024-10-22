<?php

namespace Modules\ESS\Controllers;

use App\System\App;

/**
 * Description of TripAPI
 *
 * @author Plus91Labs-01
 */
class TripAPI extends \App\Core\BaseController {

    protected $app;
    private $WfDoc = "Trips";

    public function __construct(App $app) {
        $this->app = $app;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeTrips",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get employee trip list successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeTrips() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $employeeId = $this->app->Request()->getParameter("employee_id",$this->app->Auth()->getUser()->getEmployee()->getEmployeeId());
                try {
                    $records = [];
                    $records['Trips'] = \entities\TripsQuery::create()
                                    ->filterByEmployeeId($employeeId)
                                    ->find()->toArray();
                    foreach ($records['Trips'] as &$row) {
                        $row['expTotal'] = \entities\ExpensesQuery::create()
                                ->select('total')
                                ->filterByExpenseTrip($row['TripId'])
                                ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                ->findOne();
                        $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                    }
                    $grouped_array = array();
                    foreach ($records as $element) {
                        foreach ($element as $elem) {
                            $grouped_array[$elem['month']][] = $elem;
                        }
                    }
                    $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                    $this->apiResponse($grouped_array, 200, "Get employee trip list successfully!");
                } catch (Exception) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getTripTypes",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get trip types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTripTypes() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                try {
                    $this->data['TripType'] = [
                        "TripType" => $this->getConfig("ESS", "tripType")];
                    $this->apiResponse($this->data['TripType'], 200, "Get trip types successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/getWorkingAt",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="selected_date",
     *         in="query",
     *         description="Selected Date",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get trip types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getWorkingAt() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $date = $this->app->Request()->getParameter("selected_date");
                $emp = $this->app->Auth()->getUser()->getEmployeeId();
                $empp = $this->app->Auth()->getUser()->getEmployee();
                try {
                    $minDate = $date." 00:00:00";
                    $maxDate = $date." 23:59:59";
                    $wfManager = new \Modules\System\Processes\WorkflowManager();
                    $statusList = $wfManager->getStatusList("Trips");
                    $triprule = $empp->getCompany()->getTripapprovalreq();
                    $tripsQuery = \entities\TripsQuery::create()
                            ->filterByTripStartDate($maxDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByTripEndDate($minDate,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByEmployee($empp);     

                    if($triprule == 1)
                    {
                        $tripsQuery->filterByTripStatus(2);
                    }
                    $data['Trip'] = $tripsQuery->find()->toArray();
//                    $data['Trip'] = \entities\TripsQuery::create()
//                                            ->filterByTripStartDate($strDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
//                                            ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
//                                            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
//                                            ->filterByTripStatus(2)
//                                            ->find()->toArray();
                
                
                    $data['TripType'] = ["TripType" => $this->getConfig("ESS", "tripType")];
                    
                    
                    $this->apiResponse($data, 200, "Get trip types successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/getTripLocations",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="search_location",
     *         in="query",
     *         description="Search Location",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get city successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTripLocations() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $q = $this->app->Request()->getParameter("search_location");
                $orgUnitCountry = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCountryId();

                $res = [];
                if (strlen($q) >= 2) {
                    $locations = \entities\GeoCityQuery::create()
                            ->filterByIcountryid($orgUnitCountry)
                            ->filterByScityname($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                            ->limit(100)
                            ->find();
                    if ($locations) {
                        foreach ($locations as $loc) {
                            $res[] = ["label" => $loc->getScityname() . " | " . $loc->getGeoState()->getSstatename(), "value" => $loc->toArray(), "id" => $loc->getPrimaryKey()];
                        }
                    }
                    if (count($res) > 0) {
                        $this->apiResponse($res, 200, "Get city successfully!");
                    } else {
                        $this->apiResponse($res, 400, "City not found !!");
                    }
                } else {
                    $this->apiResponse($res, 400, "Please Enter Minimum 3 Characters");
                }

                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getbudgets",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get budgets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getbudgets() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                try {
                    $budgets = \entities\BudgetGroupQuery::create()
                                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                                    ->find()->toArray();
                    if (count($budgets) > 0) {
                        $this->apiResponse($budgets, 200, "Get budgets successfully!");
                    } else {
                        $this->apiResponse([], 400, "Budgets not found!");
                    }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getTripTaDa",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_location",
     *         in="query",
     *         description="Start Location",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="end_location",
     *         in="query",
     *         description="End Location",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get trip types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTripTaDa() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                try {
                    $this->data['TripType'] = [
                        "TripType" => $this->getConfig("ESS", "tripType")];
                    $this->apiResponse($this->data['TripType'], 200, "Get trip types successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createTrip",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="trip_id",
     *         in="query",
     *         description="Trip Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="trip_type_id",
     *         in="query",
     *         description="Trip Type Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_budget_id",
     *         in="query",
     *         description="Trip Budget Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Trip Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_time",
     *         in="query",
     *         description="Trip Start Time",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="Trip End Date",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="end_time",
     *         in="query",
     *         description="Trip End Time",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_origin_id",
     *         in="query",
     *         description="Trip Origin Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_origin",
     *         in="query",
     *         description="Trip Origin",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_origin_latlong",
     *         in="query",
     *         description="Trip Origin LatLong",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_destination_id",
     *         in="query",
     *         description="Trip Destination Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_destination",
     *         in="query",
     *         description="Trip Destination",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_destination_latlong",
     *         in="query",
     *         description="Trip Destination LatLong",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Remark",
     *         required=false,
     *         @OA\Schema(type="text")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function createTrip() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $user = $this->app->Auth()->getUser();
                $tripId = $this->app->Request()->getParameter("trip_id");
                $tripTypeId = $this->app->Request()->getParameter("trip_type_id");
                $budgetId = $this->app->Request()->getParameter("trip_budget_id");
                $tripStartDate = $this->app->Request()->getParameter("start_date");
                $tripStartTime = $this->app->Request()->getParameter("start_time");
                $tripEndDate = $this->app->Request()->getParameter("end_date");
                $tripEndTime = $this->app->Request()->getParameter("end_time");
                $tripOriginId = $this->app->Request()->getParameter("trip_origin_id");
                $tripOrigin = $this->app->Request()->getParameter("trip_origin");
                $tripOriginLatLong = $this->app->Request()->getParameter("trip_origin_latlong");
                $tripDestinationId = $this->app->Request()->getParameter("trip_destination_id");
                $tripDestination = $this->app->Request()->getParameter("trip_destination");
                $tripDestinationLatLong = $this->app->Request()->getParameter("trip_destination_latlong");
                $remark = $this->app->Request()->getParameter("remark", "");

                $currencyId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
                
                $TripStartDate = \DateTime::createFromFormat("Y-m-d H:i:s", $tripStartDate . " " . $tripStartTime);
                $TripEndDate = \DateTime::createFromFormat("Y-m-d H:i:s", $tripEndDate . " " . $tripEndTime);
                
                $trip = \entities\TripsQuery::create()
                        ->filterByTripStartDate($TripEndDate,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->filterByTripEndDate($TripStartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)                    
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->find()->toArray();
                
                if (count($trip) > 0 && $tripId == 0) {
                    return $this->apiResponse([], 400, "There is a trip that coincide with these dates");
                }
                try {
                    if($tripId > 0){
                        $createTrip = \entities\TripsQuery::create()
                                           ->filterByTripId($tripId)
                                           ->findOne();
                    }else{
                        
                        $createTrip = new \entities\Trips();
                    }
                    
                    $createTrip->setCompanyId($this->app->Auth()->CompanyId());
                    $createTrip->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                    $createTrip->setTripType($tripTypeId);
                    $createTrip->setTripStartDate($TripStartDate);
                    $createTrip->setTripEndDate($TripEndDate);
                    $createTrip->setTripOrigin($tripOriginId);
                    $createTrip->setTripOriginName($tripOrigin);
                    $createTrip->setTripOriginLatlong($tripOriginLatLong);
                    $createTrip->setTripDestination($tripDestinationId);
                    $createTrip->setTripDestinationName($tripDestination);
                    $createTrip->setTripDestinationLatlong($tripDestinationLatLong);
                    $createTrip->setTripReason($remark);
                    $createTrip->setTripStatus(1);
                    $createTrip->setTripCurrency($currencyId);
                    $createTrip->setBudgetId($budgetId);
                    $createTrip->save();
                    
                    $wfManager = new \Modules\System\Processes\WorkflowManager();
                    $wfManager->createLog("Trips", $createTrip, $user->getEmployee(), 0, "Trip Request Created", 0);
                    $wfManager->process("Trips", $createTrip);
                
                    $this->apiResponse($createTrip->toArray(), 200, "Create trip successfully!");
                   
                } catch (\Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getIdByTrip",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="trip_id",
     *         in="query",
     *         description="Trip Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get trip successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getIdByTrip() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $tripId = $this->app->Request()->getParameter("trip_id");
                try {
                    $data['Trips'] = \entities\TripsQuery::create()
                                    ->filterByTripId($tripId)
                                    ->find()->toArray();
                    $data['Budget'] = \entities\BudgetGroupQuery::create()
                                    ->filterByBgid($data['Trips'][0]['BudgetId'])
                                    ->find()->toArray();
                    $data["TripType"] = $this->getConfig("ESS", "tripType");
                    $this->apiResponse($data, 200, "Get trip successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getTodayTrips",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get today trip successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTodayTrips() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $employeeId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
                $companyId = $this->app->Auth()->CompanyId();
                $startDate = date('Y-m-d 00:00:00');
                $endDate = date('Y-m-d 23:59:59');
                try {
                    $data['Trips'] = \entities\TripsQuery::create()
                                    ->filterByEmployeeId($employeeId)
                                    ->filterByCompanyId($companyId)
                                    ->filterByTripStartDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                    ->filterByTripEndDate($startDate,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                    ->filterByTripStatus(2)
                                    ->find()->toArray();
                    $data["TripType"] = $this->getConfig("ESS", "tripType");
                    $this->apiResponse($data, 200, "Get today trip successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/tripCancel",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="trip_id",
     *         in="query",
     *         description="Trip Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Response(
     *         response="200",
     *         description="Trip cancelled successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function tripCancel() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $tripId = $this->app->Request()->getParameter("trip_id");
                try {
                    $trip = \entities\TripsQuery::create()->filterByTripId($tripId)->findOne();
                    $trip->setTripStatus(4);
                    $trip->save();
                    
                    $this->apiResponse($trip->toArray(), 200, "Trip cancelled successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getFilterTrips",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="short_by",
     *         in="query",
     *         description="Short By (1=>Newley Added, 2=>Current Month, 3=>Last Month, 4=>Last 3 Months)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Short By(Start Date)",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="Short By(End Date)",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get filter trip successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getFilterTrips() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $shortBy = $this->app->Request()->getParameter("short_by");
                $startDate = $this->app->Request()->getParameter("start_date");
                $endDate = $this->app->Request()->getParameter("end_date");

                $employeeId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
                $companyId = $this->app->Auth()->CompanyId();

                try {
                    if ($shortBy != null) {
                        switch ($shortBy) :
                            case "1":
                                $records = [];
                                $records['Trips'] = \entities\TripsQuery::create()
                                                ->filterByEmployeeId($employeeId)
                                                ->filterByCompanyId($companyId)
                                                ->orderByTripStartDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                                                ->setLimit(3)
                                                ->find()->toArray();
                                foreach ($records['Trips'] as &$row) {
                                    $row['expTotal'] = \entities\ExpensesQuery::create()
                                            ->select('total')
                                            ->filterByExpenseTrip($row['TripId'])
                                            ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                            ->findOne();
                                    $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                                }
                                $grouped_array = array();
                                foreach ($records as $element) {
                                    foreach ($element as $elem) {
                                        $grouped_array[$elem['month']][] = $elem;
                                    }
                                }
                                $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                                break;
                            case "2":
                                $records = [];
                                $Start = date("Y-m-01 00:00:01");
                                $End = date('Y-m-t 23:59:59');
                                $records['Trips'] = \entities\TripsQuery::create()
                                                ->filterByTripStartDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                                ->filterByTripStartDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                                ->filterByEmployeeId($employeeId)
                                                ->filterByCompanyId($companyId)
                                                ->find()->toArray();
                                foreach ($records['Trips'] as &$row) {
                                    $row['expTotal'] = \entities\ExpensesQuery::create()
                                            ->select('total')
                                            ->filterByExpenseTrip($row['TripId'])
                                            ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                            ->findOne();
                                    $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                                }
                                $grouped_array = array();
                                foreach ($records as $element) {
                                    foreach ($element as $elem) {
                                        $grouped_array[$elem['month']][] = $elem;
                                    }
                                }
                                $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                                break;
                            case "3":
                                $records = [];
                                $Start = date("Y-m-01 00:00:01", strtotime("-1 month"));
                                $End = date('Y-m-t 23:59:59', strtotime("-1 month"));
                                $records['Trips'] = \entities\TripsQuery::create()
                                                ->filterByTripStartDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                                ->filterByTripStartDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                                ->filterByEmployeeId($employeeId)
                                                ->filterByCompanyId($companyId)
                                                ->find()->toArray();
                                foreach ($records['Trips'] as &$row) {
                                    $row['expTotal'] = \entities\ExpensesQuery::create()
                                            ->select('total')
                                            ->filterByExpenseTrip($row['TripId'])
                                            ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                            ->findOne();
                                    $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                                }
                                $grouped_array = array();
                                foreach ($records as $element) {
                                    foreach ($element as $elem) {
                                        $grouped_array[$elem['month']][] = $elem;
                                    }
                                }
                                $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                                break;
                            case "4":
                                $records = [];
                                $Start = date("Y-m-01 00:00:01", strtotime("-3 months"));
                                $End = date('Y-m-t 23:59:59', strtotime("+2 months", strtotime($Start)));
                                $records['Trips'] = \entities\TripsQuery::create()
                                                ->filterByTripStartDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                                ->filterByTripStartDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                                ->filterByEmployeeId($employeeId)
                                                ->filterByCompanyId($companyId)
                                                ->find()->toArray();
                                foreach ($records['Trips'] as &$row) {
                                    $row['expTotal'] = \entities\ExpensesQuery::create()
                                            ->select('total')
                                            ->filterByExpenseTrip($row['TripId'])
                                            ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                            ->findOne();
                                    $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                                }
                                $grouped_array = array();
                                foreach ($records as $element) {
                                    foreach ($element as $elem) {
                                        $grouped_array[$elem['month']][] = $elem;
                                    }
                                }
                                $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                                break;
                            default:
                                $this->apiResponse([], 400, "Filter trip not found!");
                                break;
                        endswitch;
                    } else {
                        $Start = date("Y-m-d H:i:s", strtotime($startDate));
                        $End = date('Y-m-d H:i:s', strtotime($endDate));
                        $records['Trips'] = \entities\TripsQuery::create()
                                        ->filterByTripStartDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                        ->filterByTripStartDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                        ->filterByEmployeeId($employeeId)
                                        ->filterByCompanyId($companyId)
                                        ->find()->toArray();
                        foreach ($records['Trips'] as &$row) {
                            $row['expTotal'] = \entities\ExpensesQuery::create()
                                    ->select('total')
                                    ->filterByExpenseTrip($row['TripId'])
                                    ->withColumn('ifnull(SUM(expense_final_amt),0)', 'total')
                                    ->findOne();
                            $row['month'] = date('F Y', strtotime($row['TripStartDate']));
                        }
                        $grouped_array = array();
                        foreach ($records as $element) {
                            foreach ($element as $elem) {
                                $grouped_array[$elem['month']][] = $elem;
                            }
                        }
                        $grouped_array["TripType"] = $this->getConfig("ESS", "tripType");
                    }

                    if (count($records['Trips']) > 0) {
                        $this->apiResponse($grouped_array, 200, "Get filter trip successfully!");
                    } else {
                        $this->apiResponse([], 400, "Filter trip not found!");
                    }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Post(
     *     path="/api/getTripsMonthwise",
     *     tags={"Trips"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getTripsMonthwise() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $status = $this->app->Request()->getParameter("status");
                $employee = $this->app->Auth()->getUser()->getEmployeeId();
                //$month = explode("|",$this->app->Request()->getParameter("month","|"));
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $pendingAction = $wfManager->getPendingRequestPks($this->WfDoc, $this->app);
               
                $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();

                $trips = \Modules\ESS\Runtime\EssHelper::getTripsmonthwise($status, $employee, $getmonth['month'], $pendingAction);
                if (count($trips) > 0) {
                    $this->apiResponse(["tripcount" => count($trips), "data" => $trips], 200, "");
                } else {
                    $this->apiResponse([], 400, "Trip Not Found !!");
                }
                break;
        endswitch;
    }
}

<?php declare(strict_types = 1);

namespace Modules\Home\Controllers;

use App\System\App;


class Homepage extends \App\Core\BaseController
{	               
        protected $app;
        
	public function __construct(App $app)
	{
		$this->app = $app;		
	}
                
	public function show()
	{                                                                       
                                    
            $this->data['firstLogin'] = \Modules\System\Runtime\UserTriggers::checkOnce("firstLogin", $this->app->Auth()->getUser()->getUserId());
            $this->data['expenseMonthCount'] = $this->getConfig("HR","dashboardExpenseWidgetCount");
            $this->app->Renderer()->render('home/home.twig', $this->data);                         
	}
        
        public function test()
        {
            $data = [
			'name' => $this->app->Request()->getParameter('name', 'test interface'),
		];
		$this->app->Renderer()->render('home/home.twig', $data);
		
        }
        public function monthlyReportsforEmployee() {
            
            $month = explode("|",$this->app->Request()->getParameter("month","|"));
            
            $expenses = \entities\ExpensesQuery::create()
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(10)
                    ->findByCompanyId($this->app->Auth()->CompanyId());
    
                    $reportData = [];
                    foreach($expenses as $ex)
                    {
                        
                            $list = $ex->getExpenseLists();
                            foreach($list as $l)
                            {
                                if(!isset($reportData[$l->getEmployeeId()])) {
                                    $reportData[$l->getEmployeeId()]['cmpcard'] = 0;
                                    $reportData[$l->getEmployeeId()]['expAmount'] = 0;
                                    $reportData[$l->getEmployeeId()]['add'] = 0;
                                    $reportData[$l->getEmployeeId()]['tax'] = 0;
                                    $reportData[$l->getEmployeeId()]['expApproved'] = 0;
                                    $reportData[$l->getEmployeeId()]['expAudited'] = 0;
                                    $reportData[$l->getEmployeeId()]['paybleAmount'] = 0;
                                    $reportData[$l->getEmployeeId()]['cmpcard'] = 0;
                                    $reportData[$ex->getEmployeeId()]["Additional"] = 0;                                
                                    $reportData[$ex->getEmployeeId()]["Tax"] = 0;
                                    $reportData[$ex->getEmployeeId()]["NonReimbursable"] = 0;
                                }
                                if (array_key_exists($l->getEmployeeId(),$reportData))
                                {
                                    $reportData[$l->getEmployeeId()]['expAmount'] += $l->getExpIlAmount();
                                    $reportData[$l->getEmployeeId()]['add'] += $l->getExpReqAmount();
                                    $reportData[$l->getEmployeeId()]['tax'] += $l->getExpTaxAmount();
                                    $reportData[$l->getEmployeeId()]['expApproved'] += $l->getExpAprAmount();
                                    
                                    $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                                    $reportData[$l->getEmployeeId()]['expAudited'] += $setData;

                                    $reportData[$l->getEmployeeId()]['paybleAmount'] += $l->getExpFinalAmount();

                                    if($l->getCmpCard() == 1){
                                        $reportData[$l->getEmployeeId()]['cmpcard'] += $l->getExpFinalAmount();
                                    }
                                }else{
                                    $reportData[$l->getEmployeeId()]['expAmount'] = $l->getExpIlAmount();
                                    $reportData[$l->getEmployeeId()]['add'] = $l->getExpReqAmount();
                                    $reportData[$l->getEmployeeId()]['tax'] = $l->getExpTaxAmount();
                                    $reportData[$l->getEmployeeId()]['expApproved'] = $l->getExpAprAmount();
                                    
                                    $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                                    $reportData[$l->getEmployeeId()]['expAudited'] = $setData;

                                    $reportData[$l->getEmployeeId()]['paybleAmount'] += $l->getExpFinalAmount();

                                    if($l->getCmpCard() == 1){
                                        $reportData[$l->getEmployeeId()]['cmpcard'] += $l->getExpFinalAmount();
                                    }
                                }
                                $reportData[$l->getEmployeeId()]['expId'] = $l->getExpId();
                                $reportData[$l->getEmployeeId()]['expDate'] = $l->getExpDate()->format('d-m-Y');
                                
                            }
                            $emp = $ex->getEmployee();
                            $reportData[$l->getEmployeeId()]['Name'] = $emp->getFirstName()." ".$emp->getLastName()." | ".$emp->getEmployeeCode();
                            $reportData[$l->getEmployeeId()]['ID'] = $emp->getEmployeeId();
                            $reportData[$l->getEmployeeId()]['Designation'] = $emp->getDesignations()->getDesignation();
                            $reportData[$l->getEmployeeId()]['Branch'] = $emp->getBranch()->getBranchname();
                            $reportData[$l->getEmployeeId()]['Unit'] = $emp->getOrgUnit()->getUnitName();
                            $reportData[$l->getEmployeeId()]['Currency'] = $ex->getCurrencies()->getShortcode();
                            
                            
                            //$reportData[$ex->getEmployeeId()]["Payable"] += $ex->getExpenseFinalAmt();
                            
                            $listExp = $ex->getExpenseLists();
                            foreach($listExp as $lex)
                            {  
                                if($lex->getExpenseMaster()->getNonreimbursable() == 1)
                                {                                
                                    $reportData[$lex->getEmployeeId()]["NonReimbursable"] += $lex->getExpFinalAmount();
                                }
                                
                                $reportData[$lex->getEmployeeId()]["Additional"] += $lex->getExpReqAmount();                                
                                $reportData[$lex->getEmployeeId()]["Tax"] += $lex->getExpTaxAmount();
                            }
                        
                        
                    }
                    $array = array();
                    if(count($reportData)){
                        foreach ($reportData as $r){
                            array_push($array, array(
                                "Name"=>$r['Name'],
                                "Designation"=>$r['Designation'],
                                "Branch"=>$r['Branch'],
                                "Unit"=>$r['Unit'],
                                "Requested"=>$r['expAmount'] + $r['add'],
                                "Approved"=>$r['expApproved'] - $r['tax'],
                                "Auditor's Deducted Amount"=>$r['expApproved'] - $r['paybleAmount'],
                                "Company Card"=>$r['cmpcard'],
                                "Payble Amount"=>$r['paybleAmount']-$r['cmpcard'] - $r['Tax'],
                                "GST"=>$r['Tax'],
                                "Final Payble"=>$r['paybleAmount']-$r['cmpcard']
                            ));
                        }
                    }
                    $this->array_to_csv_download($array);
        }
        public function monthlyReportsforEmployee_old() {
            $month = explode("|",$this->app->Request()->getParameter("month","|"));
            
            $query = \entities\ExpensesQuery::create()
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByExpenseStatus(10)
                    ->findByCompanyId($this->app->Auth()->CompanyId());
            $array = array();
            $reportData = array();
            $expAmount = 0;
            if($query){
                foreach($query as $emp){
                    $list = $emp->getExpenseLists();
                    foreach($list as $l)
                    {
                        if (array_key_exists($l->getEmployeeId(),$reportData)){
                            $reportData[$l->getEmployeeId()]['expAmount'] += $l->getExpIlAmount();
                        }else{
                            $reportData[$l->getEmployeeId()]['expAmount'] = $l->getExpIlAmount();
                        }
                    }
                
                    array_push($array,array(
                        "Name"=>$emp->getEmployee()->getFirstName()." ".$emp->getEmployee()->getLastName()." | ".$emp->getEmployee()->getEmployeeCode(),
                        "Designation"=>$emp->getEmployee()->getDesignations()->getDesignation(),
                        "Branch"=> $emp->getEmployee()->getBranch()->getBranchname(),
                        "Unit"=>$emp->getEmployee()->getOrgUnit()->getUnitName(),
                        "Requested"=>$reportData[$emp->getEmployeeId()]['expAmount'],
                        "Approved"=>$reportData[$emp->getEmployeeId()]['expAmount'],
                        "Auditor's Deducted Amount"=>0,
                        "Company Card"=>0,
                        "Payble Amount"=>0,
                        "Final Payble"=>0
                    ));
                    
                }
                
                
            }
            $this->array_to_csv_download($array);
        }
        function array_to_csv_download($array) {
    
            if (count($array) == 0) {
                return null;
            }
            
            $filename = "data_export_" . date("Y-m-d") . ".csv";
            // disable caching
            $now = gmdate("D, d M Y H:i:s");
            header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
            header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
            header("Last-Modified: {$now} GMT");

            // force download  
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");

            // disposition / encoding on response body
            header("Content-Disposition: attachment;filename={$filename}");
            header("Content-Transfer-Encoding: binary");

            $df = fopen("php://output", 'w');
            
            fputcsv($df, array_keys(reset($array)));
            foreach ($array as $row) {
                fputcsv($df, $row);
            }
            fclose($df);
            die();    
        }

}

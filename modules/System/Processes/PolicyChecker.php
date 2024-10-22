<?php declare(strict_types = 1);

namespace Modules\System\Processes;

use Modules\System\Runtime\PolicyRequest;

class PolicyChecker extends \App\Core\Process
{
        
    var $emp;
    var $grade;
    var $policy;
            
    function __construct(\entities\Base\Employee $emp, $date,$currency_id) {
        
        $this->emp = $emp;
        $this->grade = $emp->getGradeMaster();
        
        $policies = \entities\GradePolicyQuery::create()
                ->filterByGradeid($emp->getGradeId())
                ->filterByStartDate($date, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByEndDate($date, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->orderByGpId(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                ->find();
        $this->policy = false;
        foreach ($policies as $p)
        {            
            if($p->getPolicyMaster()->getCurrencyId() == $currency_id)
            {
                $this->policy = $p;
            }
        }   
    }
    
    public function process(\Modules\System\Runtime\PolicyRequest $req,$isPartial = false) : \Modules\System\Runtime\PolicyRequest
    {
        
        $req->setEmployee($this->emp);
        $req->setGrade($this->grade);
        
        if(!$this->policy) // No Available Policy
        {
                $req->setValidated(true);
                $req->setStatus(1);
                $req->setLimit1(0);
                $req->setMessage("Complete byPass -No Policy available");
                return $req;
        }
        
        $req->setActivePolicy($this->policy->getPolicyMaster());
        
        $row = \entities\Base\PolicyRowsQuery::create()
                ->filterByPolicyId($req->getActivePolicy()->getPolicyId())
                ->filterByPolicykey($req->getPolicyKey())
                ->find()->getFirst();
        
        if(!$row)
        {
            /*$req->setValidated(false);
            $req->setStatus(4);
            $req->setMessage($req->getPolicyKey()." Policy Not Enabled");
             * 
             */
                // No Key so by Pass 
                $req->setValidated(true);
                $req->setStatus(1);
                $req->setLimit1(0);
                $req->setMessage("Complete ByPass - PolicyKey Not Enabled");
        }
        elseif($req->getRequestVal() == 0){
                $req->setValidated(true);
                $req->setStatus(5);
                $req->setMessage("Zero Value ByPass");                
        }
        elseif($row) {    
            
            $req->setPolicyRow($row);
            
            $req->setLimit1($row->getLimit1());   
            $req->setIsReadonly($row->getIsReadonly());                        

            if($req->getPolicyRow()->getNocheck() == 1)
            {
                $req->setValidated(true);
                $req->setStatus(1);
                $req->setMessage("Validated : NoCheck");
                return $req;            
            }

            if($req->getRequestVal() <= $req->getPolicyRow()->getLimit1() )
            {
                $req->setValidated(true);
                $req->setStatus(1);
                $req->setMessage("Validated");
            }            
            else 
            {
                $req->setValidated(false);
                $req->setStatus(3);
                $req->setMessage($req->getGrade()->getGradeName().": ".$req->getPolicyKey()." limit violation");
            }
        }
        else 
        {
                $req->setValidated(false);
                $req->setStatus(4);
                $req->setMessage($req->getPolicyKey()." Policy Not Enabled");
        }
        
        if($isPartial)
        {
            $req->setLimit1(0);
        }
        $req->setMessage($req->getMessage()." In Policy:".$req->getActivePolicy()->getPolicyName());
        return $req;
    }
    
    public function getKeyRecord($key)
    {    
        $row = false;
        if($this->policy)
        {
            $row = \entities\Base\PolicyRowsQuery::create()
                ->filterByPolicyId($this->policy->getPolicyId())
                ->filterByPolicykey($key)
                ->find()->getFirst();        
        }
        
        if($row)
        {
            return $row->getLimit1();
        }
        else 
        {
            return 0;
        }
    }
}

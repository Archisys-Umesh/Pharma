<?php declare(strict_types = 1);

namespace Modules\HR\Runtime;


class AdvanceHelper
{
    protected $app;
        
    public  function __construct(\App\System\App $app)
    {
        $this->app = $app;
            
    }
    
    public function addTransaction($employeeId,$type,$description,$date,$amount,$actualAmount = 0) : \entities\Transactions
            {
        
        $employee = \entities\EmployeeQuery::create()                
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findPk($employeeId); 
        
        $createdBy = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
        $companyId = $this->app->Auth()->getUser()->getCompanyId();
                
        $trnsaction = new \entities\Transactions();
        
        $trnsaction->setType($type)
                ->setDescription($description)
                ->setEmployeeId($employeeId)
                ->setCompanyId($companyId)
                ->setBalance($amount)
                ->setDate($date)
                ->setActualAmount($actualAmount)
                ->setCreatedBy($createdBy);
        
        $trnsaction->save();
                
        return $trnsaction;
    }
    
    public function getBalance($employeeId){
        $balance = 0.00;
        $transaction = \entities\TransactionsQuery::create()
                    ->filterbyEmployeeId($employeeId)
                    ->find();
        foreach($transaction as $t){
            $balance += $t->getBalance();
        }
        return $balance;
    }
    
    public function processPayment($employeeId,$description,$date,$fromBalanceAmount,$actualAmount){
        $balance = $this->getBalance($employeeId);
        if(($fromBalanceAmount > $actualAmount) OR ($balance < $fromBalanceAmount)){
            return false;
        }
        
        $fromBalanceAmount = $fromBalanceAmount <= 0 ? $fromBalanceAmount : -$fromBalanceAmount ;
        $actualAmount = $actualAmount <= 0 ? $actualAmount : -$actualAmount ;
        
        $this->addTransaction($employeeId, 2, $description,$date, $fromBalanceAmount,$actualAmount);
        
        return true;
    }
    
    public function canApprove($ExpId){
        
        
        $expTotal = 0;
        
        $exp = \entities\ExpensesQuery::create()
                ->filterByExpenseStatus(2)
                ->filterByExpId($ExpId)->find();
        if($exp){
            foreach($exp as $e){
                $expTotal += $e->getExpenseFinalAmt();
                $employeeId = $e->getEmployeeId();
            }

        }
        
        if($expTotal == 0){
            return false;
        }
        
        $balance = $this->getBalance($employeeId);
        
        if($balance < $expTotal){
            return false;
        }
        
        return true;
    }


    public function  addAdvance($employeeId,$description,$date,$balance) : \entities\Transactions
    {
        return $this->addTransaction($employeeId, 1, $description,$date, $balance);
        
    }

    public function  getTransactions($employeeId,$offset=0,$limit=50){
        $advance = \entities\TransactionsQuery::create()
                ->filterbyEmployeeId($employeeId)     
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->setOffset($offset)
                ->setLimit($limit)
                ->orderByDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                //->joinWithEmployeeRelatedByCreatedBy()                
                ->find();
        
        return $advance;
    }
    
}

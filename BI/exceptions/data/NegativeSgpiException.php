<?php

namespace BI\exceptions\data;

use entities\OutletViewQuery;
use entities\SgpiEmployeeBalanceQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class NegativeSgpiException extends DataException
{
    protected function setEmailBody() {
        $this->emailBody = 'email\dataExceptions\NegativeSgpi.twig';

        return $this;
    }
    
    public function handle() {
        $companyId = $this->getCompanyId();
        
        $columns = ['EmployeeCode', 'OrgUnitId', 'SgpiCode', 'Credits', 'Debits', 'Moye', 'Balance'];

        $sgpis = SgpiEmployeeBalanceQuery::create()
                    ->select($columns)
                    ->withColumn('employee.employee_code', 'EmployeeCode')
                    ->withColumn('employee.org_unit_id', 'OrgUnitId')
                    ->withColumn('sgpi_master.sgpi_code', 'SgpiCode')
                    ->addjoin('sgpi_employee_balance.sgpi_id', 'sgpi_master.sgpi_id', Criteria::INNER_JOIN)
                    ->addjoin('sgpi_employee_balance.employee_id', 'employee.employee_id', Criteria::INNER_JOIN)
                    ->filterByBalance(0, Criteria::LESS_THAN)
                    ->orderBy('UseStartDate', Criteria::DESC)
                    ->find()
                    ->toArray();

        if (count($sgpis) > 0) {
            $this->setExceptionFound(true);
            
            $emailData = ['appName' => $_ENV['APP_NAME'], 'columns' => $columns, 'data' => array_slice($sgpis, 0, 50), 'count' => count($sgpis)];
            
            $this->setEmailData($emailData);
        } else {
            $this->setExceptionFound(false);
        }

        return $this->handleException();
    }
}
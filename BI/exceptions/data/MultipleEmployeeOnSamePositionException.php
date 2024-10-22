<?php

namespace BI\exceptions\data;

use entities\EmployeeQuery;
use entities\OutletViewQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class MultipleEmployeeOnSamePositionException extends DataException
{
    protected function setEmailBody() {
        $this->emailBody = 'email\dataExceptions\MultipleEmployeeOnSamePosition.twig';

        return $this;
    }
    
    public function handle() {
        $companyId = $this->getCompanyId();
        
        $columns = ['PositionId', 'PositionCode', 'POrgUnitId', 'EmployeeCodes'];

        $positions = EmployeeQuery::create()
                        ->select($columns)
                        ->withColumn('positions.position_code', 'PositionCode')
                        ->withColumn('positions.org_unit_id', 'POrgUnitId')
                        ->withColumn("string_agg(trim(concat(employee.employee_code, '-', employee.first_name, ' ', employee.last_name)), ', ')", 'EmployeeCodes')
                        ->joinWithPositionsRelatedByPositionId()
                        ->filterByCompanyId($companyId)
                        ->filterByStatus(1)
                        ->groupByPositionId()
                        ->having('count(*) > 1')
                        ->find()
                        ->toArray();

        if (count($positions) > 0) {
            $this->setExceptionFound(true);
            
            $emailData = ['appName' => $_ENV['APP_NAME'], 'columns' => $columns, 'data' => $positions, 'count' => count($positions)];
            
            $this->setEmailData($emailData);
        } else {
            $this->setExceptionFound(false);
        }

        return $this->handleException();
    }
}
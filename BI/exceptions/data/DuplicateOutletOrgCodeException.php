<?php

namespace BI\exceptions\data;

use entities\OutletViewQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class DuplicateOutletOrgCodeException extends DataException
{
    protected function setEmailBody() {
        $this->emailBody = 'email\dataExceptions\DuplicateOutletOrgCode.twig';

        return $this;
    }
    
    public function handle() {
        $companyId = $this->getCompanyId();
        $duplicateCodes = OutletViewQuery::create()
                            ->select(['OutletCode'])
                            ->filterByCompanyId($companyId)
                            ->filterByOutletCode('341129012', Criteria::NOT_EQUAL) // remove dummy outletcode
                            ->filterByOutletStatus('active')
                            ->groupByOutletCode()
                            ->having('count(*) > 1')
                            ->find()
                            ->toArray();

        if (count($duplicateCodes) > 0) {
            $this->setExceptionFound(true);

            $columns = ['OutletCode', 'OutletOrgCode', 'OrgUnitId', 'PositionName', 'BeatName', 'OutletName'];
            $data = OutletViewQuery::create()
                        ->select($columns)
                        ->filterByCompanyId($companyId)
                        ->filterByOutletCode($duplicateCodes)
                        ->orderByOutletCode()
                        ->find()
                        ->toArray();
            
            $emailData = ['appName' => $_ENV['APP_NAME'], 'columns' => $columns, 'data' => $data, 'duplicateCount' => count($duplicateCodes)];
            
            $this->setEmailData($emailData);
        } else {
            $this->setExceptionFound(false);
        }

        return $this->handleException();
    }
}
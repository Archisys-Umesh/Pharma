<?php

namespace BI\exceptions\data;

use entities\OutletViewQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class MissingTagsException extends DataException
{
    protected function setEmailBody() {
        $this->emailBody = 'email\dataExceptions\MissingTags.twig';

        return $this;
    }
    
    public function handle() {
        $companyId = $this->getCompanyId();
        
        $columns = ['OutletCode', 'OutletOrgCode', 'OrgUnitId', 'BrandFocus'];

        $missingTags = OutletViewQuery::create()
                            ->select($columns)
                            ->filterByCompanyId($companyId)
                            ->filterByOutlettypeName('Doctor')
                            ->filterByOutletStatus('active')
                            ->filterByTags(null, Criteria::ISNULL)
                            ->find()
                            ->toArray();

        if (count($missingTags) > 0) {
            $this->setExceptionFound(true);
            
            $emailData = ['appName' => $_ENV['APP_NAME'], 'columns' => $columns, 'data' => $missingTags, 'count' => count($missingTags)];
            
            $this->setEmailData($emailData);
        } else {
            $this->setExceptionFound(false);
        }

        return $this->handleException();
    }
}
<?php

namespace BI\manager;

use entities\MtpLogs;
use entities\MtpQuery;

class MTPCreationManager
{
    public function runner() {
        echo "Checking for new mtp creation... : Start" . PHP_EOL;
        $this->checkForNewMtpCreation();
        echo "Checking for new mtp creation... : End" . PHP_EOL;
    }

    private function checkForNewMtpCreation() {
        $mtp = MtpQuery::create()->filterByMtpStatus('processing')->filterByIsMtpGenerating(false)->findOne();

        if (!empty($mtp)) {
            echo "Processing MTP... : " . $mtp->getMtpId() . PHP_EOL;

            $mtp->setIsMtpGenerating(true);
            $mtp->save();

            $this->generateMTP($mtp);

            $mtp->setIsMtpGenerating(false);
            $mtp->save();
        }
    }

    private function generateMTP($mtp) {
        $mtpType = $mtp->getPositions()->getMtpType();
        $manager = new MTPManager;

        switch ($mtpType) {
            case 'manual':
                $manager->generateMTPWithManualType($mtp);
                break;

            case 'stp':
                $manager->generateMTPWithSTPType($mtp);
                break;

            case 'smart':
                $manager->generateMTPWithSmartType($mtp);
                break;
            
            default:
                $log = new MtpLogs;
                $log->setMtpId($mtp->getMtpId());
                $log->setLogFunction('Not defined');
                $log->setLogDescription('Mtp type method not set, Please contact support team for more details!');
                $log->setDebugData(json_encode(['mtpType' => $mtpType]));
                $log->setCompanyId($mtp->$mtp->getCompanyId());
                $log->save();
                break;
        }
    }
}
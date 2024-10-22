<?php

namespace BI\manager;

use entities\MediaFilesQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Processes\WorkflowManager;

class FileManager
{
    public function uploadFileIntoS3($bucket, $file, $fileName, $path = 'uploads') {
        $fullPath = $path . '/' . uniqid() . '-' . $fileName;
        $s3 = WorkflowManager::initializeS3Client();

        $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $fullPath,
            'SourceFile' => $file,
        ]);

        unset($s3);

        return $fullPath;
    }

    public function removeFileFromS3($bucket, $path) {
        $s3 = WorkflowManager::initializeS3Client();

        $response = $s3->deleteObject([
            'Bucket' => $bucket,
            'Key'    => $path,
        ]);

        unset($s3);
    }

    public function moveToS3() {
        $medias = MediaFilesQuery::create()
                    ->filterByMediaMime('application/pdf', Criteria::NOT_EQUAL)
                    ->filterByIss3file(false)
                    ->limit(10)
                    ->find();

        foreach ($medias as $media) {
            echo $media->getMediaId() . " - Moving file to S3... : start" . PHP_EOL;
            $file = $media->getMediaData();
            $fileName = $media->getMediaName();
            $bucket = $_ENV['STACKHERO_MINIO_AWS_BUCKET'];
            $fullPath = $this->uploadFileIntoS3($bucket, $file, $fileName);

            $media->setMediaData($fullPath);
            $media->setIss3file(true);
            $media->save();
            echo $media->getMediaId() . " - Moving file to S3... : end" . PHP_EOL;
        }
    }

    public function checkForS3Files() {
        // while (true) {
            echo "Check for New files to move... : start" . PHP_EOL;
            $this->moveToS3();
            // sleep(10);
            echo "Check for New files to move... : end" . PHP_EOL;
        // }
    }

    public function getFileFromS3($bucket, $path) {
        $s3 = WorkflowManager::initializeS3Client();
        $url = $s3->getObjectUrl($bucket, $path);
        unset($s3);
        return $url;
    }
}
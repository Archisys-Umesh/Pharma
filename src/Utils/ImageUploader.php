<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

use entities\MediaFiles;

/**
 * Description of ImageUploader
 *
 * @author Archisys-33
 */
class ImageUploader {

    public static function uploadBase64Image(array $images) {
        $ids = array();
        foreach ($images as $image) {
            $imageDecode = base64_decode($image);
            $size = getImageSizeFromString($imageDecode);
            if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
                die('Base64 value is not a valid image');
            }
            $imageMime = $size['mime'];
            $data = explode('/', $imageMime);
            $fileName = uniqid() . '.' . $data[1];
            $file = "uploads/2/" . $fileName;
            $success = file_put_contents($file, $imageDecode);
            if ($success) {
                $media = new MediaFiles();
                $media->setMediaName($fileName);
                $media->setMediaMime($imageMime);
                $media->setMediaData($imageDecode);
                $media->setFolderId(null);
                $media->setCompanyId($companyID);
                $media->save();
                array_push($ids, $media->getMediaId());
            }
        }
        return $ids;
    }
    
    public static function getBase64ImageSize($base64Image){ //return memory size in B, KB, MB
    try{
        $size_in_bytes = (int) (strlen(rtrim($base64Image, '=')) * 3 / 4);
        $size_in_kb    = $size_in_bytes / 1024;
        $size_in_mb    = $size_in_kb / 1024;

        return $size_in_mb;
    }
    catch(Exception $e){
        return $e;
    }
}
}

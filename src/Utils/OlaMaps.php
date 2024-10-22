<?php

namespace App\Utils;

class OlaMaps
{

    protected $OlaApiKey;

    public function __construct()
    {
        $this->OlaApiKey = isset($_ENV['OLA_API_KEY']) ? $_ENV['OLA_API_KEY'] : "2pPsAPkfnyAJYRlhFZnZ58zgtc8n4Rkn9sVjYzAZ";
    }

    public function ReverseGeocoding($lat, $long)
    {

        $url = "https://api.olamaps.io/places/v1/reverse-geocode?latlng=" . $lat . "," . $long . "&api_key=" . $this->OlaApiKey;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        $isError = false;
        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }else{
            $dataDecode = json_decode($output);
            if (!empty($dataDecode->results) && isset($dataDecode->results[0])) {
                $formattedAddress = $dataDecode->results[0]->formatted_address;
                $latLong = $lat.','.$long;
                $zipcode = $dataDecode->results[0]->address_components[7]->long_name;
                $geoAddress = new \entities\GeoAddress();
                $geoAddress->setLatLong($latLong);
                $geoAddress->setZipcode($zipcode);
                $geoAddress->setAddress($formattedAddress);
                $geoAddress->save();
            }
        }
        curl_close($ch);
        if ($isError) {
            return array('error' => 1, 'message' => $errorMessage);
        } else {
            return array('error' => 0, 'data' => $output);
        }
    }
}

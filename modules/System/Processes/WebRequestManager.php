<?php

namespace Modules\System\Processes;

class WebRequestManager
{
    private $url, $type, $headers, $requestedData, $response;

    public function __construct() {
        $this->type = 'get';
        $this->requestedData = [];
        $this->headers = [];
    }

    public function setUrl(String $url) {
        $this->url = $url;
        return $this;
    }

    public function setType(String $type) {
        $this->type = strtolower($type);
        return $this;
    }

    public function setRequestedData(Array $requestedData) {
        $this->requestedData = $requestedData;
        $this->headers[] = 'Content-Type:application/json';
        return $this;
    }

    public function getResponse() {
        return $this->response;
    }

    public function setHeaders(Array $headers) {
        $this->headers = array_unique(array_merge($this->headers, $headers));
        return $this;
    }

    public function callRequest() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);

        if ($this->type == 'post') {
            curl_setopt($curl, CURLOPT_POST, true);
        }

        if (count($this->headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        }

        if (count($this->requestedData)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->requestedData));
        }
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $this->response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo "cURL request error : " . curl_error($curl) . PHP_EOL; 
        }
        
        curl_close($curl); 
        
        return $this->getResponse();
    }
}
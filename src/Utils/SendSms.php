<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

/**
 * Description of SendSms
 *
 * @author Archisys-33
 */
class SendSms {

    private static $API_KEY = '383945Aj0ZM8eNX635238f7P1';
    private static $SENDER_ID = "PLSLMS";
    private static $ROUTE_NO = 4;
    private static $RESPONSE_TYPE = 'json';
    private static $TEMPLATE_ID = '6361f763d6fc0503f83a2632';

    public static function sendOtpMessage($OTP, $mobileNumber, $isdCode) {
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("Your OPT is : $OTP");

        //Preparing post parameters
        $postData = array(
            'authkey' => static::$API_KEY,
            'template_id' => static::$TEMPLATE_ID,
            'mobiles' => $mobileNumber,
            'country' => $isdCode,
            'otp' => $OTP,
            'message' => $message,
            'sender' => static::$SENDER_ID,
            'route' => static::$ROUTE_NO,
            'response' => static::$RESPONSE_TYPE
        );

        $url = "https://api.msg91.com/api/v5/otp";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if ($isError) {
            return array('error' => 1, 'message' => $errorMessage);
        } else {
            return array('error' => 0);
        }
    }
    
    public static function sendRmlOtpMessage($otp,$phoneNumber){

        $environment = $_ENV['environment'];
        if($environment == "development")
        {
            return [];
        }
        $url = "http://sms6.rmlconnect.net:8080/bulksms/bulksms?username=alembic&password=Mumbai%401&type=0&dlr=1&destination=91".$phoneNumber."&source=ALMDIS&message=%20Your%20OTP%20is%20:%20".$otp.".Alembic%20&entityid=1201159193696414522&tempid=1207168015746927739";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $curl , CURLOPT_HEADER , true );
        $curl_data = curl_exec($curl);
        curl_close($curl);
        $response_data = json_decode($curl_data);
        
        return $response_data;
        
    }

    public static function sendRmlNotificationMessage($phoneNumber, $type, $dlr, $message) {
        $response = ['isSent' => false, 'transactionId' => '', 'errorMessage' => ''];
        try {
            $url = 'http://sms6.rmlconnect.net:8080/bulksms/bulksms?username=alembic&password=Mumbai%401&type=' . $type . '&dlr=' . $dlr . '&destination=91' . $phoneNumber . '&source=ALMDIS&message='. urlencode($message);
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING , '');
            curl_setopt($curl, CURLOPT_MAXREDIRS , 10);
            curl_setopt($curl, CURLOPT_TIMEOUT , 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1);

            $curl_data = curl_exec($curl);
            curl_close($curl);
            $response_data = explode('|', $curl_data);

            if ($response_data[0] == 1701) {
                $response['isSent'] = true;
                $response['transactionId'] = isset($response_data[2]) ? $response_data[2] : 'custom_' . time();
            } else {
                $response['isSent'] = false;
                $response['errorMessage'] = $response_data[0];
            }

            return $response;
        } catch (\Exception $e) {
            $response['errorMessage'] = "Error while sending an SMS : " . $e->getMessage();
            return $response;
        }
    }
    
    
   
    

}

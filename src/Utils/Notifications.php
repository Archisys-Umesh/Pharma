<?php
namespace App\Utils;


class Notifications
{
   var $notificationType;
   var $title;
   var $message;
   var $data;
   var $fcmtoken;
   var $key;
   var $fcmResponse;
   var $url;
   
   function __construct($notificationType, $message, array $data) {
       
       $this->notificationType = $notificationType;
       $this->message = $message;
       $this->data = $data;
       $this->title = _PushTitle;
       $this->key = _FCMKey;
   }

   function getNotificationType() : \App\Abstracts\NotificationType {
       return $this->notificationType;
   }

   function getTitle() {
       return $this->title;
   }

   function getMessage() {
       return $this->message;
   }

   function getData() {
       return $this->data;
   }

   function getFCMToken() {
       return $this->fcmtoken;
   }

   function getKey() {
       return $this->key;
   }

   function getFCMResponse()
   {
       return $this->fcmResponse;
   }
   function setNotificationType(\App\Abstracts\NotificationType $notificationType) {
       $this->notificationType = $notificationType;
   }

   function setTitle($title) {
       $this->title = $title;
   }

   function setMessage($message) {
       $this->message = $message;
   }

   function setData($data) {
       $this->data = $data;
   }

   function setFCMToken($fcmtoken) {
       $this->fcmtoken = $fcmtoken;
   }

   function setKey($key) {
       $this->key = $key;
   }

   function setRedirectUrl($url)
   {
       $this->url = $url;
   }
   function sendFCMNotification() {
                
       if( strlen($this->fcmtoken) > 10 )
       {
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        if($this->notificationType == \App\Abstracts\NotificationType::URLRedirect)
        {
            $data["URLRedirect"] = $this->url;
        }        
        $data = [
            "MessageType" => $this->notificationType,
            "DataContent" => $this->data
        ];
        
        
        
        
        $fields = array (
                'to' => $this->fcmtoken,
                'notification' => array (
                        "body" => $this->message,
                        "title" => $this->title,
                        "sound" => "default",
                        "alert" => "default",
                        "icon" => "",
                ),
                "priority"=> "high",
                "data" =>  $data
        );
        $fields = json_encode ( $fields );
        
        $headers = array (
                'Authorization: key=' . $this->key,
                'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );        
        curl_setopt ( $ch ,CURLOPT_SSL_VERIFYPEER, false );
        
        $result = curl_exec ( $ch );        
        curl_close ( $ch );
        $this->fcmResponse = $result;
        
        
        
        return $result;
       }
       else 
       {
           return "Invalid FCM Token";
       }
       
        
    }
    
    public function toArray()
    {
        $data = [
            "MessageType" => $this->notificationType,
            "DataContent" => $this->data
        ];
        if($this->notificationType == \App\Abstracts\NotificationType::URLRedirect)
        {
            $data["URLRedirect"] = $this->url;
        }        
        $fields = array (
                'to' => $this->fcmtoken,
                'notification' => array (
                        "body" => $this->message,
                        "title" => $this->title,
                        "sound" => "default",
                        "alert" => "default",
                        "icon" => "",
                ),
                "priority"=> "high",
                "data" =>  $data
        );
        
        return $fields;
        
    }
    
}

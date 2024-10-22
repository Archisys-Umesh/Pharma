<?php

namespace App\Utils;

class OneSignalNotification {

    public static function sendnotification($to, $title, $message, $img=null,$data=[]) {
        $msg = $message;
        $data = array_merge(["timestamp" => new \DateTime()],$data);
        $content = array(
            "en" => $msg
        );
        $headings = array(
            "en" => $title
        );

        $fields = array(
            'app_id' => '3ab7f3f8-0f4a-4728-ad6b-9ffcf8438670',
            "headings" => $headings,
            'include_player_ids' => $to,
            'large_icon' => "https://tspc-alembic.herokuapp.com/images/logo.png",
            'content_available' => true,
            'contents' => $content,
            'data' => $data
        );
        
        $headers = array(
            'Authorization: key=MTZlNjUyMGYtMmIxNS00MzlkLTljMmYtOWY4Yzk4NjI3YTk0',
            'Content-Type: application/json; charset=utf-8'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        

    }

    public static function sendNotificationPush($to, $title, $message, $data=[]) {
        $response = ['isSent' => false, 'transactionId' => '', 'errorMessage' => ''];
        try {
            $fields = [
                'app_id' => '3ab7f3f8-0f4a-4728-ad6b-9ffcf8438670',
                "headings" => [ "en" => $title ],
                'include_player_ids' => $to,
                'large_icon' => "https://tspc-alembic.herokuapp.com/images/logo.png",
                'content_available' => true,
                'contents' => [ "en" => $message ],
                'data' => array_merge(["timestamp" => new \DateTime()], $data)
            ];
            
            $headers = [
                'Authorization: key=MTZlNjUyMGYtMmIxNS00MzlkLTljMmYtOWY4Yzk4NjI3YTk0',
                'Content-Type: application/json; charset=utf-8'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            curl_close($ch);

            $response_data = json_decode($result, true);
            if (isset($response_data['errors']) && count($response_data['errors']) > 0) {
                if (isset($response_data['errors'][0])) {
                    $response['errorMessage'] = $response_data['errors'][0];
                } else {
                    $response['errorMessage'] = is_array($response_data['errors']) ? json_encode($response_data['errors']) : $response_data['errors'];
                }
            } elseif(isset($response_data['id']) && !empty($response_data['id'])) {
                $response['isSent'] = true;
                $response['transactionId'] = $response_data['id'];
            } else {
                $response['isSent'] = true;
                $response['transactionId'] = 'custom_' . time();
            }
            
            return $response;
        } catch (\Exception $e) {
            $response['errorMessage'] = "Error while sending an email : " . $e->getMessage();
            return $response;
        }
    }

}

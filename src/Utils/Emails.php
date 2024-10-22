<?php
namespace App\Utils;

use Omnimail\Email;
use Omnimail\AmazonSES;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emails
{
    public static function sendEmail($to,$subject,$body,$company_id,$cc=FALSE)
    {
        $defaultConfig = \entities\ConfigurationQuery::create()->findByCompanyId($company_id)->getFirst();
        $mailer = new AmazonSES(_AWS_SES_Access_key, _AWS_SES_Secret_key, _AWS_SES_Region, false, false);
        
        if($cc == TRUE){
            $email = new Email();
            if($defaultConfig->getAdminCc()){
                $ccMail = explode(",",$defaultConfig->getAdminCc());
                foreach ($ccMail as $c){
                    $email->addCc($c);
                }
            }
            
            $email->addTo($to)->setFrom(_defaultSender,$defaultConfig->getFromName())->setSubject($subject)
                ->setHtmlBody($body)                
                ->setReplyTo($defaultConfig->getMailFrom(),$defaultConfig->getFromName());
        }else{                 
            $email = (new \Omnimail\Email())->addTo($to)->setFrom(_defaultSender,$defaultConfig->getFromName())->setSubject($subject)
                ->setHtmlBody($body)                
                ->setReplyTo($defaultConfig->getMailFrom(),$defaultConfig->getFromName());
        }
        
        $mailer->send($email);
        
    }
    
    public static function sendEmailFromAdmin($to,$subject,$message,$bcc = '')
    {
        $mailer = new AmazonSES(_AWS_SES_Access_key, _AWS_SES_Secret_key, _AWS_SES_Region, false, false);   
        $email = new Email();
        $email
                ->addTo($to)                                
                ->setFrom(_defaultSender,"xPensys 2.0")
                ->setSubject($subject)
                ->setHtmlBody($message);
        
        if($bcc != ''){
            $email->addBcc($bcc);
        }
        
        $mailer->send($email);
    }
    
    public static function sendErrorEmail($subject,$message)
    {
        // $mailer = new AmazonSES(_AWS_SES_Access_key, _AWS_SES_Secret_key, _AWS_SES_Region, false, false);   
        // $email = new Email();
        // $email       
        //         ->addTo("umesh.chhatrala@archisys.in") 
        //         ->setFrom(_defaultSender,"xPensys")
        //         ->setSubject("Internal Error : ".$subject)
        //         ->setHtmlBody($message);
        // $mailer->send($email);

        $phpmailer = new PHPMailer(true);
        try {
            $phpmailer->isSMTP();
            $phpmailer->SMTPAuth = true;
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // ENV Credentials
            $phpmailer->Host = $_ENV["MAILERTOGO_SMTP_HOST"];
            $phpmailer->Port = intval($_ENV["MAILERTOGO_SMTP_PORT"]);
            $phpmailer->Username = $_ENV["MAILERTOGO_SMTP_USER"];
            $phpmailer->Password = $_ENV["MAILERTOGO_SMTP_PASSWORD"];
            $mailertogo_domain = $_ENV["MAILERTOGO_DOMAIN"];

            // Mail Headers
            $phpmailer->setFrom("support@{$mailertogo_domain}", "Support");
            $toEmails = ['umesh@plus91labs.com'];

            if (is_array($toEmails)) {
                foreach($toEmails as $to) {
                    $phpmailer->addAddress($to);
                }
            } else {
                $phpmailer->addAddress($toEmails);
            }


            // Message
            $phpmailer->isHTML(true);
            $phpmailer->Subject = "Internal Error : ".$subject;
            $phpmailer->Body    = $message;
            $phpmailer->send();

        } catch (\Exception $e) {
            $response['errorMessage'] = "Error while sending an email : " . $e->getMessage();
            return $response;
        }
    }

    public static function sendNotificationEmail($toEmails, $subject, $body, $ccEmails = [])
    {
        $response = ['isSent' => false, 'transactionId' => '', 'errorMessage' => ''];
        $phpmailer = new PHPMailer(true);
        try {
            $phpmailer->isSMTP();
            $phpmailer->SMTPAuth = true;
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // ENV Credentials
            $phpmailer->Host = $_ENV["MAILERTOGO_SMTP_HOST"];
            $phpmailer->Port = intval($_ENV["MAILERTOGO_SMTP_PORT"]);
            $phpmailer->Username = $_ENV["MAILERTOGO_SMTP_USER"];
            $phpmailer->Password = $_ENV["MAILERTOGO_SMTP_PASSWORD"];
            $mailertogo_domain = $_ENV["MAILERTOGO_DOMAIN"];

            // Mail Headers
            $phpmailer->setFrom("support@{$mailertogo_domain}", "Support");

            if (is_array($toEmails)) {
                foreach($toEmails as $to) {
                    $phpmailer->addAddress($to);
                }
            } else {
                $phpmailer->addAddress($toEmails);
            }

            if (count($ccEmails)) {
                foreach ($ccEmails as $ccEmail) {
                    if (!empty($ccEmail)) {
                        $phpmailer->addCC($ccEmail);
                    }
                }
            }

            // Message
            $phpmailer->isHTML(true);
            $phpmailer->Subject = $subject;
            $phpmailer->Body    = "<div>" . $body . "</div>";
            $phpmailer->AltBody = $body;

            $result = $phpmailer->send();

            $response['isSent'] = true;
            $response['transactionId'] = 'custom_' . time();
            
            return $response;
        } catch (\Exception $e) {
            $response['errorMessage'] = "Error while sending an email : " . $e->getMessage();
            return $response;
        }
    }
    
}

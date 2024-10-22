<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * Description of SendMail
 *
 * @author PlusLabs
 */
class SendMail {

    public static function smtpSendMail(array $to, $subject, $body) {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'send.one.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tssfa@truesales.in';
            $mail->Password = 'Plus123@@';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('tssfa@truesales.in', 'TrueSales');
            foreach ($to as $t) {
                $mail->addAddress($t);
            }
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $ex) {
            echo "Mail could not be sent. Mailer Error: {$ex->getMessage()}";
        }
    }

}

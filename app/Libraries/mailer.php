<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ROOTPATH . 'vendor/autoload.php';

class Mailer
{
    public static function sendOTP($to,$otp)
    {
        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'faamiizlaal@gmail.com';
            $mail->Password   = 'wmpx ffki jqfx zxql';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('faamiizlaal@gmail.com','WebGIS Influenza');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Login';
            $mail->Body    = "<h2>Kode OTP Anda</h2>
                              <h1>$otp</h1>
                              <p>Berlaku 5 menit</p>";

            $mail->send();

            return true;

        }catch(Exception $e){

            return false;

        }
    }
}
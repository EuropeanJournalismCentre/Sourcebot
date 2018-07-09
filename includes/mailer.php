<?php

// If you are not using Composer (recommended)
//require(__DIR__ . "/sendgrid-php/sendgrid-php.php");

// If you are using Composer
require '../vendor/autoload.php';

function send_mail($receiver_email, $message, $reference)
{
    $from = new SendGrid\Email(null, "no-reply@sourcebot.com");
    $subject = $reference;
    $to = new SendGrid\Email(null, $receiver_email);
    $content = new SendGrid\Content("text/html", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    error_log($response->statusCode());
    error_log($response->headers());
    error_log($response->body());
}

?>
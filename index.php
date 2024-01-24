<?php

require 'vendor/autoload.php';

use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

$factory = (new Factory)->withServiceAccount(__DIR__.'/bitress-firebase-adminsdk-sq2ip-2c4198637c.json');
$messaging = $factory->createMessaging();

$device_token = "fxCqnHUjSYasZFxOxSnLAn:APA91bE00FdypVPKEELXzAcgvrpw8Z6KQOz_lokp7Vw95XRhIHxYSNXHT82p_xVbNSfNGH5g7o36HWeQDoRR2OLX4POwdoCQej7-l4FEu_jtd5uW5d5hyHjRAFDkQ5bf_GUUwiWcsGs-";
$device_token1 = "dPVPh_D_SGa0gFokZdll2i:APA91bGTG4OrTomR0PprIgOb4VLVs4Qx4EBEpZpndo_k7riYZS_iJfWH-iAljC--qW6zE3EBv_OryQkNyhVtatpM_HNTnj8KfVQVxU7_vQRihdooJZf-e240jb9qlXhe2YR6-DFSNeQR";
$message = CloudMessage::withTarget('token', $device_token1)
    ->withData(['to' => '09568104939', 'message' => 'hahaha, testinggg']);

try {
    echo json_encode($messaging->send($message)) ;
} catch (MessagingException $e) {
    echo $e;
} catch (FirebaseException $e) {
    echo $e;
}

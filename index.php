<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

include_once 'config/Configuration.php';
include_once 'vendor/autoload.php';

$client = new Client();
$headers = [
    'Content-Type' => 'application/json',
    'Authorization' => 'Bearer ' . AUTHORIZATION_KEY
];
$body = '{
  "message": {
    "token": "'. DEVICE_TOKEN .'",
    "data": {                                                                   
      "to": "some_number_here",
      "message": "Testing message",
    }
  }
}';
$request = new Request('POST', 'https://fcm.googleapis.com/v1/projects/bitress/messages:send', $headers, $body);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();

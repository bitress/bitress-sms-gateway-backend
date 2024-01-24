<?php


use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseMessagingService
{
    private $messaging;

    public function __construct($serviceAccountPath)
    {
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        $this->messaging = $factory->createMessaging();
    }

    public function sendMessage($deviceToken, $messageData)
    {
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withData($messageData);

        try {
            $response = $this->messaging->send($message);
            if (isset($response['name'])) {
                $messageId = $response['name'];


                return json_encode([
                    'success' => true,
                    'message' => 'Message sent to the device successfully',
                    'messageId' => $messageId,
                ]);
            } else {
                return json_encode([
                    'success' => false,
                    'message' => 'Failed to get message ID from the response',
                ]);
            }
        } catch (MessagingException|FirebaseException $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

}

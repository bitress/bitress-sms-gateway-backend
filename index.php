<?php

include_once 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $deviceToken = $_POST['device_token'] ?? '';
    $message = $_POST['message'] ?? '';
    $number = $_POST['number'] ?? '';

    // Validate the input (you may want to add more validation)
    if (empty($deviceToken) || empty($message)) {
        $error = 'Device token and message are required fields.';
    } else {
        // Initialize FirebaseMessagingService with the service account path
        $serviceAccountPath = __DIR__ . '/bitress-firebase-adminsdk-sq2ip-eddb546362.json';
        $firebaseMessagingService = new FirebaseMessagingService($serviceAccountPath);

        // Prepare message data
        $messageData = ['to' => '09568104939', 'message' => $message];

        // Send the message
        $result = $firebaseMessagingService->sendMessage($deviceToken, $messageData);

        $resultArray = json_decode($result, true);

        if ($resultArray['success'] === true) {
            $success = $resultArray['message'];

        } else {
            $error = 'Error sending message: ' . $resultArray['message'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Messaging Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h3>Bitress SMS Gateway</h3>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="device_token" class="form-label">Device Token:</label>
            <input type="text" class="form-control" name="device_token" required>
            <small class="form-text text-muted">
                Enter the unique device token associated with the device where you want to send the message.
            </small>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Phone Number:</label>
            <input type="number" class="form-control" name="number" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message:</label>
            <textarea class="form-control" name="message" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<!-- Bootstrap JS (optional, if you need it) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

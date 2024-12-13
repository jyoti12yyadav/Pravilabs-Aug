<?php
header('Access-Control-Allow-Origin: https://pravilabs.in/');
header('Content-Type: text/html; charset=utf-8');

// Initialize the message variable
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $messageContent = $_POST['message'];

    $to = "care@pravilabs.in";
    $subject = "New Appointment Booking";
    $body = "Name: $name\nContact No.: $contact\nEmail ID: $email\nDate of Appointment: $date\nTime of Appointment: $time\nMessage: $messageContent";
    $headers = "From: no-reply@pravilabs.in\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Try to send the email
    if (mail($to, $subject, $body, $headers)) {
        $message = "Form submitted successfully!";
    } else {
        $message = "Failed to submit the form. Please try again.";
        error_log("Mail failed to send to $to from $email on " . date('Y-m-d H:i:s'));
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .message-container {
            background-color: #ffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .success {
            color: #283779;
        }
        .error {
            color: #e30b0b;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php
        // Display the message
        if (!empty($message)) {
            if (strpos($message, 'success') !== false) {
                echo "<h2 class='success'>$message</h2>";
            } else {
                echo "<h2 class='error'>$message</h2>";
            }
        }
        ?>
    </div>
</body>
</html>
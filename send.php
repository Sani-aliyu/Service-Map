<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    // Get form data
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Set up SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact.ServiceMap@gmail.com';
    $mail->Password = 'zsjbpbnbdsquiiob';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set email parameters
    $mail->setFrom($email, $name);
    $mail->addAddress('contact.ServiceMap@gmail.com'); // Use a fixed email address for the recipient
    $mail->isHTML(true);
    $mail->Body = "<p>Name: $name</p><p>Email: $email</p><p>Message: $message</p>";

    try {
        // Send the email
        $mail->send();

        // Display success message
        echo "
            <script>
                alert('Message sent successfully');
                document.location.href = 'contact.php';
            </script>";
    } catch (Exception $e) {
        // Display error message
        echo "
            <script>
                alert('Error: {$mail->ErrorInfo}');
            </script>";
    }
}

?>

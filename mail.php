<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"])) {
    try {
        // Your existing code to set up PHPMailer
        $mail = new PHPMailer(true);

        // Your existing code to configure PHPMailer
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sumitthakur8313@gmail.com';  // Replace with your email
        $mail->Password   = 'yymqmlpkxtjjeult';   // Replace with your email password
        $mail->SMTPSecure = 'tls';  // Use 'tls' instead of 'ssl'
        $mail->Port       = 587;

        // Your existing code to get form data
        $tname = filter_var($_POST["tname"], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $recipientEmail = filter_var($_POST["recipient_email"], FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars($_POST["message"]);
        $currentDate = filter_var($_POST["currentDate"], FILTER_SANITIZE_STRING);

// Get username from session
session_start();
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';


        // Your existing code to send email
        $mail->setFrom($email, $name);
        $mail->addAddress($recipientEmail);
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Task Form Submission';
        $mail->Body = "Task Name: $name <br> Message: $message";

        if (!$mail->send()) {
            throw new Exception("Mailer Error: {$mail->ErrorInfo}");
        }

        // Insert form data into the database using prepared statements
        include 'connect.php'; // Assuming this file contains your database connection

        $stmt = $con->prepare("INSERT INTO tform (tname, name, username, recipient_email, message, currentDate) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $tname, $name, $username, $recipientEmail, $message, $currentDate);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "
                <script> 
                    alert('Message and data were sent successfully!');
                    document.location.href = 'task.php';
                </script>
            ";
        } else {
            echo "<script>alert('Error storing data in the database.');</script>";
        }

        $stmt->close();
        $con->close();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: " . $e->getMessage();
    }
}
?>

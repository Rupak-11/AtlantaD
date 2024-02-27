<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "st474401@gmail.com";
    $subject = "New Contact Form Submission";
    $headers = "From: $email";

    // Construct the email body using HTML
    $body = "<p>Name: $name</p>";
    $body .= "<p>Email: $email</p>";
    $body .= "<p>Message: $message</p>";

    // Set the content type to HTML
    $headers .= "\r\nContent-type: text/html";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
}
?>

<?php
$to = "sreyloth97@gmail.com";      // Recipient's email address
$subject = "Test Email from PHP";  // Email subject
$message = "This is a test email sent from PHP!"; // Email body
$headers = "From: sender@sreylotoh977a.com"; // Sender's email

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}
?>

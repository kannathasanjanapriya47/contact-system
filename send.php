<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'kannathasanjanapriya47@gmail.com';   // 🔁 CHANGE
        $mail->Password = 'pbfu hqhk dnim cugv';      // 🔁 CHANGE

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // 📩 Email to Admin
        $mail->setFrom('your_email@gmail.com', 'Contact System');
        $mail->addAddress('admin@example.com'); // 🔁 CHANGE to your email

        $mail->Subject = 'New Client Query';
        $mail->Body = "Name: $name\nEmail: $email\nMessage: $message";

        $mail->send();

        // 📩 Email to Client
        $mail->clearAddresses();
        $mail->addAddress($email);

        $mail->Subject = 'Query Received';
        $mail->Body = "Hi $name,\n\nWe received your message. We will contact you soon.";

        $mail->send();

        echo "Emails sent successfully!";

    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
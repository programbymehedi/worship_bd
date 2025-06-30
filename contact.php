<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = htmlspecialchars(trim($_POST["name"]));
    $email    = htmlspecialchars(trim($_POST["email"]));
    $service  = htmlspecialchars(trim($_POST["services"]));
    $message  = htmlspecialchars(trim($_POST["message"]));

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yourgmail@gmail.com'; // your Gmail
        $mail->Password   = 'yourapppassword';     // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('yourgmail@gmail.com', 'Website Contact');
        $mail->addAddress('yourgmail@gmail.com'); // Receive to same Gmail

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New Contact Form Submission - $service";
        $mail->Body    =
            "Name: $name\n" .
            "Email: $email\n" .
            "Service: $service\n\n" .
            "Message:\n$message";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

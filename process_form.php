<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?status=error&message=Please fill all required fields correctly.");
        exit;
    }

    $to = "oluronti@gmail.com"; // CHANGE THIS to your email
    $email_subject = "New Contact Form: " . $subject;
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";
    $headers = "From:https://ogkuti.github.io/linesandmotifs/\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n"; // CHANGE noreply@yourdomain.com

    if (mail($to, $email_subject, $email_body, $headers)) {
        header("Location: contact.html?status=success&message=Your message has been sent successfully!");
    } else {
        header("Location: contact.html?status=error&message=Error sending message. Please try again.");
    }
    exit;
} else {
    header("Location: contact.html");
    exit;
}
?>

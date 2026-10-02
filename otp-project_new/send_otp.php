<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/../config/db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$email = trim($_POST["email"] ?? "");
$mailUsername = "sweekritykanji@gmail.com";
$mailPassword = "uqxr vdfk xvva nujj";

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["message"] = "Please enter a valid email address.";
    $_SESSION["message_type"] = "error";
} elseif (!$mailUsername || !$mailPassword) {
    error_log("MAIL_USERNAME or MAIL_PASSWORD is not configured.");
    $_SESSION["message"] = "Email service is not configured.";
    $_SESSION["message_type"] = "error";
} else {
    try {
        $stmt = $conn->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
        if (!$stmt) {
            throw new RuntimeException($conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $userExists = $stmt->num_rows > 0;
        $stmt->close();

        if ($userExists) {
            $resetUrl = "http://localhost/Sweekrity_PHP/Tution/basic/otp-project_new/forget_link.php";

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = $mailUsername;
            $mail->Password = $mailPassword;
            $mail->Timeout = 15;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($mailUsername, "Password Reset");
            $mail->addAddress($email);
            $mail->Subject = "Your password reset link";
            $mail->Body = "Open this page to reset your password:\n\n" . $resetUrl;
            $mail->send();
        } else {
            error_log("Password reset was requested for an email address with no matching user account.");
        }

        $_SESSION["message"] = "If $email is registered, a reset link has been sent.";
        $_SESSION["message_type"] = "success";
    } catch (\Exception $e) {
        error_log("Password reset failed: " . $e->getMessage());
        $_SESSION["message"] = "Could not send the reset email. Please try again later.";
        $_SESSION["message_type"] = "error";
    }
}

header("Location: index.php");
exit;

<?php

session_start();

$message = $_SESSION["message"] ?? "";
$messageType = $_SESSION["message_type"] ?? "";

unset($_SESSION["message"], $_SESSION["message_type"]);

?>
<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        .container {
            width: 420px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #aaa;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 5px;
            background: #4285f4;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        button:hover {
            background: #3367d6;
        }

        .verify-button {
            background: #28a745;
        }

        .verify-button:hover {
            background: #218838;
        }

        .message {
            padding: 12px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .otp-box {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .otp-input {
            text-align: center;
            font-size: 24px;
            letter-spacing: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>OTP Verification</h2>

    <?php if ($message !== ""): ?>
        <div class="message <?php echo htmlspecialchars($messageType); ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form action="send_otp.php" method="POST">
        <label for="email">Enter Gmail Address</label>
        <input
            id="email"
            type="email"
            name="email"
            placeholder="example@gmail.com"
            value="<?php echo htmlspecialchars($_SESSION["link_email"] ?? ""); ?>"
            required
        >
        <button type="submit" name="send_otp">Send OTP</button>
    </form>

    
</div>
</body>
</html>

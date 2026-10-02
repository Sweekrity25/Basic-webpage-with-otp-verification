<?php
require_once __DIR__ . "/../config/db.php";

$message = "";
$messageType = "error";
$formEmail = trim($_POST["email"] ?? "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["pass"] ?? null;
    $confirmPassword = $_POST["cpass"] ?? null;

    if ($email === "" || !is_string($password) || !is_string($confirmPassword)
        || $password === "" || $confirmPassword === "") {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $message = "Password must contain at least 6 characters.";
        $messageType = "error";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType="error";
    } else {
        try {
            $userStmt = $conn->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
            if (!$userStmt) {
                $message = "Could not check the email right now. Please try again later.";
                $messageType="error";
            } else {
                $userStmt->bind_param("s", $email);
                if (!$userStmt->execute()) {
                    $message="Could not check account email ";
                    $messageType="error";
                }
                $userStmt->store_result();
                $userExists = $userStmt->num_rows > 0;
                $userStmt->close();

                if (!$userExists) {
                    $message = "No account was found for this email address.";
                    $messageType="error";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    if ($hashedPassword === false) {
                        $message="Could not hash the new password." . $hashedPassword->error;
                       
                    }

                    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
                    if (!$updateStmt) {
                        $message="Could not prepare password update: " . $conn->error;
                    }
                    $updateStmt->bind_param("ss", $hashedPassword, $email);
                    if (!$updateStmt->execute()) {
                        $message="Could not update password: " . $updateStmt->error;

                    }
                    $updateStmt->close();

                    $message = "Password reset successful. You can now log in.";
                    $messageType = "success";
                }
            }
        } catch (\Exception $e) {
            /*error_log("Password reset failed: " . $e->getMessage());*/
            $message = "Could not reset the password. Please try again later.";
            
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            display: grid;
            place-items: center;
            background: #f2f2f2;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .reset-card {
            width: min(100%, 440px);
            padding: 36px;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            text-align: center;
        }

        .subtitle {
            margin: 0 0 28px;
            color: #777;
            text-align: center;
        }

        .message {
            margin-bottom: 20px;
            text-align: center;
        }

        .error {
            background: #ffe0e0;

            color: #c0392b;

            padding: 10px;

            border-radius: 7px;

            margin-bottom: 15px;

            text-align: center;
        }

        .success {
            background: #dff7e5;

            color: #218838;

            padding: 10px;

            border-radius: 7px;

            margin-bottom: 15px;

            text-align: center;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            color: #333;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            font: inherit;
        }

        input:focus {
            border-color: #6c5ce7;
            outline: 3px solid rgba(108, 92, 231, 0.15);
        }

        button {
            width: 100%;
            margin-top: 26px;
            padding: 14px;
            border: 0;
            border-radius: 8px;
            background: #6c5ce7;
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-weight: 700;
        }

        button:hover {
            background: #5848d6;
        }

        @media (max-width: 480px) {
            .reset-card {
                padding: 28px 22px;
            }
        }
    </style>
</head>
<body>
    <main class="reset-card">
        <h1>Reset Password</h1>
        <p class="subtitle">Choose a new password for your account.</p>

        <?php if ($message !== ""): ?>
            <p class="message <?php echo htmlspecialchars($messageType, ENT_QUOTES, "UTF-8"); ?>">
                <?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($formEmail, ENT_QUOTES, "UTF-8"); ?>"
                    required
                >

                <label for="password">Enter new password</label>
                <input id="password" type="password" name="pass" minlength="6" required>

                <label for="confirm-password">Confirm password</label>
                <input id="confirm-password" type="password" name="cpass" minlength="6" required>

                <button type="submit">Reset password</button>
        </form>
    </main>
</body>
</html>
